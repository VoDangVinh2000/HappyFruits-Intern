<?php
/**
 * Class declaration
 */

require_once (ABSOLUTE_PATH."/includes/foody/Foody.php");

class FoodyController extends BaseController
{
    private $foody = null;

    public function __construct()
    {
        $this->require_logged = 0;
        parent::__construct();
        $this->foody = new Foody();
        $this->load_model('Customers, Orders, Vouchers, Products, Prices');
    }

    private function _add_order($foody_order, $foody_order_details, $status = 'In Process')
    {
        if (isset($foody_order_details['order_status']))
            unset($foody_order_details['order_status']);
        $unique_key = md5(json_encode($foody_order_details));
        $is_prepaid = $foody_order['pay_to_merchant']['type'] == 6 && $foody_order['pay_to_merchant']['state'] == 2 ? 1 : 0;
        $customer_id = $this->Customers->get_id_or_create($foody_order['deliver_address']['name'], $foody_order['deliver_address']['address'], FOODY_CUSTOMER_TYPE_ID, $foody_order['deliver_address']['orderer_phone']);
        $data = array(
            'branch_id' => LHP_BRANCH_ID,
            'type_id' => ORDER_TYPE_FOODY_ID,
            'customer_id' => $customer_id,
            'quantity' => $foody_order['items']['total_count'],
            'subtotal' => $foody_order_details['order_value_detail']['value'] / 1000.0,
            'total' => $foody_order_details['total_value_detail']['value'] / 1000.0,
            'discount' => ($foody_order_details['order_value_detail']['value'] - $foody_order_details['total_value_detail']['value']) / 1000.0,
            'code' => $foody_order['code'],
            'created_dtm' => $foody_order_details['order_time'],
            'pickup_time' => isset($foody_order_details['pick_time']) ? $foody_order_details['pick_time'] : $foody_order_details['deliver_time'],
            'delivery_date' => $foody_order_details['deliver_time'],
            'is_prepaid' => $is_prepaid,
            'status' => $status,
            'shipping_info' => json_encode(array(
                'fullname' => $foody_order['deliver_address']['name'],
                'address' => $foody_order['deliver_address']['address'],
                'distance' => str_replace(' km', '', $foody_order['distance']),
                'mobile' => $foody_order['deliver_address']['orderer_phone'],
                'shipper_name' => $foody_order['assignee']['name'],
                'shipper_phone' => $foody_order['assignee']['phone'],
                'order_code' => $foody_order['code']
            ), JSON_UNESCAPED_UNICODE),
            'unique_key' => $unique_key,
            'compressed_data' => gzcompress(json_encode(array('group_items' => $foody_order_details['group_items']), JSON_UNESCAPED_UNICODE)),
            'description' => !empty($foody_order_details['note']) ? $foody_order_details['note'] : null
        );
        $order_id = $this->Orders->insert($data);
        if($order_id && !empty($foody_order_details['group_items']))
            $this->_add_order_items($order_id, $foody_order_details['group_items'], $foody_order_details['order_time']);

        if ($is_prepaid) {
            $foody_payment = $this->Vouchers->get_foody_payment($foody_order['code']);
            if ($foody_payment) {
                $this->Vouchers->update($foody_payment['id'], array('amount' => $data['total'], 'date_time' => $data['delivery_date']));
            } else {
                $payment_voucher_data = array(
                    'branch_id' => LHP_BRANCH_ID,
                    'type' => 'payment',
                    'description' => 'Đơn hàng Foody #' . $foody_order['code'] . (!empty($foody_order['deliver_address']['name']) ? ' - ' . $foody_order['deliver_address']['name'] : ''),
                    'amount' => $data['total'],
                    'user_id' => $this->logged_user ? $this->logged_user['user_id'] : 1
                );
                $payment_voucher_data['date_time'] = $data['delivery_date'];
                $payment_voucher_data['created_dtm'] = date('Y-m-d H:i:s');
                $this->Vouchers->insert($payment_voucher_data);
            }
        }
    }

    private function _add_order_items($order_id, $group_items, $created_dtm)
    {
        if(!empty($group_items)){
            foreach($group_items as $foody_group)
            {
                foreach ($foody_group['items']['order_dish'] as $foody_item)
                {
                    $product_code = $this->_get_product_code($foody_item['dish']['name']);
                    $product = $this->Products->select_one(array('code' => $product_code));
                    /* Check product code */
                    if(empty($product))
                        continue;
                    $price = $this->Prices->select_one(array('type_id' => 3, 'product_id' => $product['product_id']));
                    /* Check product price */
                    if($price['price'] != floatval($foody_item['price']['value']/1000)){
                        $this->_debug('Foody price does not match for product code: '. $product_code. ' - '. $price['price'] . ' vs '.floatval($foody_item['price']['value']/1000));
                    }

                    $order_items = array();
                    $order_items['order_id'] = $order_id;
                    $order_items['product_id'] = $product['product_id'];
                    $order_items['quantity'] = $foody_item['quantity'];
                    $order_items['description'] = $foody_item['note'];
                    $order_items['price'] = floatval($foody_item['price']['value']/1000);
                    $order_items['total'] = $order_items['price']*$order_items['quantity'];
                    $order_items['created_dtm'] = $created_dtm;
                    $item_id = eModel::_insert('order_items', $order_items);

                    $options = $foody_item['options'];
                    if (!empty($options)) {
                        $sub_item_ids = array();
                        $sub_products = $this->Products->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"), -1);
                        if($sub_products){
                            foreach($sub_products as $s_p)
                                $sub_item_ids[$s_p['name']] = $s_p['product_id'];
                        }
                        foreach ($options as $option) {
                            foreach($option['attributes'] as $att){
                                if(!isset($sub_item_ids[$att['name']]))
                                    continue;
                                $order_sub_items = array();
                                $order_sub_items['order_id'] = $order_id;
                                $order_sub_items['belongs_to'] = $item_id;
                                $order_sub_items['product_id'] = $sub_item_ids[$att['name']];
                                $order_sub_items['quantity'] = $att['quantity'];
                                /* Total of sub items is added to product total */
                                $order_sub_items['price'] = 0;
                                $order_sub_items['total'] = 0;
                                $order_sub_items['created_dtm'] = $created_dtm;
                                eModel::_insert('order_items', $order_sub_items);
                            }
                        }
                    }
                }
            }
        }
    }

    private function _update_order($efruit_order, $foody_order, $foody_order_details, $status = 'In Process', $need_voucher = false)
    {
        if (isset($foody_order_details['order_status']))
            unset($foody_order_details['order_status']);
        $unique_key = md5(json_encode($foody_order_details));
        $is_prepaid = $foody_order['pay_to_merchant']['type'] == 6 && $foody_order['pay_to_merchant']['state'] == 2 ? 1 : 0;
        $data = array(
            'quantity' => $foody_order['items']['total_count'],
            'subtotal' => $foody_order_details['order_value_detail']['value'] / 1000.0,
            'total' => $foody_order_details['total_value_detail']['value'] / 1000.0,
            'discount' => ($foody_order_details['order_value_detail']['value'] - $foody_order_details['total_value_detail']['value']) / 1000.0,
            'pickup_time' => isset($foody_order_details['pick_time']) ? $foody_order_details['pick_time'] : $foody_order_details['deliver_time'],
            'delivery_date' => $foody_order_details['deliver_time'],
            'is_prepaid' => $is_prepaid,
            'status' => $status,
            'shipping_info' => json_encode(array(
                'fullname' => $foody_order['deliver_address']['name'],
                'address' => $foody_order['deliver_address']['address'],
                'distance' => str_replace(' km', '', $foody_order['distance']),
                'mobile' => $foody_order['deliver_address']['orderer_phone'],
                'shipper_name' => $foody_order['assignee']['name'],
                'shipper_phone' => $foody_order['assignee']['phone'],
                'order_code' => $foody_order['code']
            ), JSON_UNESCAPED_UNICODE),
            'unique_key' => $unique_key,
            'compressed_data' => gzcompress(json_encode(array('group_items' => $foody_order_details['group_items']), JSON_UNESCAPED_UNICODE)),
            'description' => !empty($foody_order_details['note']) ? $foody_order_details['note'] : null
        );
        $this->Orders->update($efruit_order['id'], $data);

        if($efruit_order && !empty($foody_order_details['group_items']))
            $this->_update_order_items($efruit_order['id'], $foody_order_details['group_items'], $foody_order_details['order_time']);

        if ($is_prepaid || $need_voucher) {
            $foody_payment = $this->Vouchers->get_foody_payment($foody_order['code']);
            if ($foody_payment) {
                $this->Vouchers->update($foody_payment['id'], array('amount' => $data['total'], 'date_time' => $data['delivery_date']));
            } else {
                $payment_voucher_data = array(
                    'branch_id' => LHP_BRANCH_ID,
                    'type' => 'payment',
                    'description' => 'Đơn hàng Foody #' . $foody_order['code'] . (!empty($foody_order['deliver_address']['name']) ? ' - ' . $foody_order['deliver_address']['name'] : ''),
                    'amount' => $data['total'],
                    'user_id' => $this->logged_user ? $this->logged_user['user_id'] : 1
                );
                $payment_voucher_data['date_time'] = $data['delivery_date'];
                $payment_voucher_data['created_dtm'] = date('Y-m-d H:i:s');
                $this->Vouchers->insert($payment_voucher_data);
            }
        }
    }

    private function _update_order_items($order_id, $group_items, $created_dtm)
    {
        if(!empty($group_items)){
            // Remove all old order items
            eModel::_delete('order_items', array('order_id' => $order_id));
            foreach($group_items as $foody_group)
            {
                foreach ($foody_group['items']['order_dish'] as $foody_item)
                {
                    $product_code = $this->_get_product_code($foody_item['dish']['name']);
                    $product = $this->Products->select_one(array('code' => $product_code));
                    /* Check product code */
                    if(empty($product))
                        continue;
                    $price = $this->Prices->select_one(array('type_id' => 3, 'product_id' => $product['product_id']));
                    /* Check product price */
                    if($price['price'] != floatval($foody_item['price']['value']/1000)){
                        $this->_debug('Foody price does not match for product code: '. $product_code. ' - '. $price['price'] . ' vs '.floatval($foody_item['price']['value']/1000));
                    }

                    $order_items = array();
                    $order_items['order_id'] = $order_id;
                    $order_items['product_id'] = $product['product_id'];
                    $order_items['quantity'] = $foody_item['quantity'];
                    $order_items['description'] = $foody_item['note'];
                    $order_items['price'] = floatval($foody_item['price']['value']/1000);
                    $order_items['total'] = $order_items['price']*$order_items['quantity'];
                    $order_items['created_dtm'] = $created_dtm;
                    $item_id = eModel::_insert('order_items', $order_items);

                    $options = $foody_item['options'];
                    if (!empty($options)) {
                        $sub_item_ids = array();
                        $sub_products = $this->Products->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"), -1);
                        if($sub_products){
                            foreach($sub_products as $s_p)
                                $sub_item_ids[$s_p['name']] = $s_p['product_id'];
                        }
                        foreach ($options as $option) {
                            foreach($option['attributes'] as $att){
                                if(!isset($sub_item_ids[$att['name']]))
                                    continue;
                                $order_sub_items = array();
                                $order_sub_items['order_id'] = $order_id;
                                $order_sub_items['belongs_to'] = $item_id;
                                $order_sub_items['product_id'] = $sub_item_ids[$att['name']];
                                $order_sub_items['quantity'] = $att['quantity'];
                                /* Total of sub items is added to product total */
                                $order_sub_items['price'] = 0;
                                $order_sub_items['total'] = 0;
                                $order_sub_items['created_dtm'] = $created_dtm;
                                eModel::_insert('order_items', $order_sub_items);
                            }
                        }
                    }
                }
            }
        }
    }

    public function get_orders()
    {
        $this->dbh->beginTransaction();
        $updated_items = 0;
        $begin_date = $end_date = date('Y-m-d');
        $data = array(
            'status' => 1,
            'from_date' => $begin_date,
            'to_date' => $end_date
        );
        $pending_orders = $this->foody->getOrders($data);

        if (!empty($pending_orders)) {
            foreach ($pending_orders as $foody_order) {
                $foody_order_details = $this->foody->getOrderDetails($foody_order['code']);
                unset($foody_order_details['order_status']);
                $unique_key = md5(json_encode($foody_order_details));
                $efruit_order = $this->Orders->get_foody_order($foody_order['code']);
                if (empty($efruit_order)) {
                    $this->_add_order($foody_order, $foody_order_details, 'Wait for Staff Confirm');
                    $updated_items++;
                } else if ($efruit_order['unique_key'] != $unique_key) {
                    $this->_update_order($efruit_order, $foody_order, $foody_order_details, 'Wait for Staff Confirm');
                    $updated_items++;
                }
            }
        }
        echo 'Fetch ' . $updated_items . " pending order(s).\n";

        $updated_items = 0;
        $data = array(
            'status' => 4,
            'from_date' => $begin_date,
            'to_date' => $end_date
        );
        $inprocess_orders = $this->foody->getOrders($data);
        if (!empty($inprocess_orders)) {
            foreach ($inprocess_orders as $foody_order) {
                $foody_order_details = $this->foody->getOrderDetails($foody_order['code']);
                unset($foody_order_details['order_status']);
                $unique_key = md5(json_encode($foody_order_details));
                $efruit_order = $this->Orders->get_foody_order($foody_order['code']);
                if (!empty($efruit_order) && ($efruit_order['status'] != 'In Process' || $efruit_order['unique_key'] != $unique_key)) {
                    $this->_update_order($efruit_order, $foody_order, $foody_order_details, 'In Process');
                    $updated_items++;
                } elseif (empty($efruit_order)) {
                    $this->_add_order($foody_order, $foody_order_details, 'In Process');
                    $updated_items++;
                }
            }
        }
        echo 'Fetch ' . $updated_items . " in-process order(s).\n";

        $updated_items = 0;
        $data = array(
            'status' => 2,
            'from_date' => $begin_date,
            'to_date' => $end_date
        );
        $completed_orders = $this->foody->getOrders($data);
        if (!empty($completed_orders)) {
            foreach ($completed_orders as $foody_order) {
                $foody_order_details = $this->foody->getOrderDetails($foody_order['code']);
                $efruit_order = $this->Orders->get_foody_order($foody_order['code']);
                if (!empty($efruit_order) && $efruit_order['status'] != 'Completed') {
                    if ($foody_order_details['order_status'] == 6 || $foody_order_details['order_status'] == 7) {
                        $this->_update_order($efruit_order, $foody_order, $foody_order_details, 'Completed');
                        $updated_items++;
                    }
                } elseif (empty($efruit_order)) {
                    $this->_add_order($foody_order, $foody_order_details, 'Completed');
                    $updated_items++;
                }
            }
        }
        echo 'Fetch ' . $updated_items . " completed order(s).\n";

        $data = array(
            'status' => 3,
            'from_date' => $begin_date,
            'to_date' => $end_date
        );
        $canceled_orders = $this->foody->getOrders($data);
        if (!empty($canceled_orders)) {
            foreach ($canceled_orders as $foody_order) {
                $foody_order_details = $this->foody->getOrderDetails($foody_order['code']);
                $efruit_order = $this->Orders->get_foody_order($foody_order['code']);
                if (!empty($efruit_order) && $efruit_order['status'] != 'Failed') {
                    //$this->Orders->update($efruit_order['id'], array('status'=>'Failed'));
                    $this->_update_order($efruit_order, $foody_order, $foody_order_details, 'Failed', true);
                }
            }
        }
        $this->dbh->commit();

    }

    private function _parseDate($str, $output_format = 'Y-m-d H:i:s')
    {
        $dtm_in_milisecs = str_replace(array('/Date(', ')/'), '', $str);
        return date($output_format, $dtm_in_milisecs / 1000);
    }

    public function login(){
        echo $this->foody->login();
    }

    public function compress_data(){
        $sql ="SELECT id, extra FROM orders WHERE extra IS NOT NULL";
        $rs = eModel::_do_sql($sql);
        if(!empty($rs)){
            foreach($rs as $row){
                $encoded_data = $row['extra'];
                $ok = eModel::_update('orders', array('id' => $row['id']), array('compressed_data' => gzcompress($encoded_data), 'extra' => NULL));
                if($ok)
                    echo 'Extra data of order #'.$row['id']. ' is compressed.<br/>';
                else
                    echo 'Cannot compress extra data of order #'.$row['id']. '.<br/>';
            }
        }
    }

    private function _debug($msg)
    {
        $fp = fopen('foody_debug.txt', 'a');
        fwrite($fp, $msg . "\n");
        fclose($fp);
    }

    private function _get_product_code($product_name){
        $arr = explode('-', $product_name, 2);
        return trim($arr[0]);
    }
}
/* End of FoodyController class */
