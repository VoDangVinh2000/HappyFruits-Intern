<?php
include("includes/order.inc.php");
$logged_user = Users::get_logged_user();
if(empty($logged_user))
    die('Bạn chưa đăng nhập.');
$version = VERSION;
$code = get('code');
$order = $models->order->select_one(array('code' => $code, 'deleted' => 0));
if (!$order){
    $order = $models->order->get_details($code);
    if (!$order)
        die('Mã đơn hàng không chính xác.');
    if ($order['deleted'])
        die('Đơn hàng đã bị xóa. Vui lòng liên hệ admin.');
    if (!empty($order['code']))
        $code = $order['code'];
}

$seq_no = get_seq_no($code);
$branch = eModel::_select_one('branches', array('id' => $order['branch_id']));
$order_items = $models->order->get_order_items(array('order_id' => $order['id'], 'where' => "(order_items.belongs_to IS NULL OR order_items.belongs_to = '')"));
$is_online_foody_order = 0;
if ($order['type_id'] == ORDER_TYPE_FOODY_ID){
    if(!empty($order['extra']))
        $foody_details = json_decode($order['extra'], true);
    elseif(!empty($order['compressed_data']))
        $foody_details = json_decode(gzuncompress($order['compressed_data']), true);
    //var_dump($foody_details);
    $is_online_foody_order = 1;
}else if(empty($order_items)){
    die('Dữ liệu bị lỗi. Vui lòng liên hệ admin.');
}

if ($order['subtotal'] <= 0)
    die('Dữ liệu lỗi. Tổng đơn hàng là: '. $order['subtotal']);

$customer = json_decode($order['shipping_info']);
$data = array();
if (!empty($order_items) && $order['type_id'] != ORDER_TYPE_FOODY_ID){
    foreach($order_items as $item)
    {
        $item['final_price'] = $item['price'];
        $order_sub_items = $models->order->get_order_items(array('order_id' => $order['id'], 'order_items.belongs_to' => $item['id']));
        if ($order_sub_items)
        {
            foreach($order_sub_items as $sub_item){
                $item['sub_items'][$sub_item['id']] = $sub_item;
                $item['final_price'] += $sub_item['price'];
            }
        }
        else
            $item['sub_items'] = array();

        /* Get components */
        $components = $models->product_component->get_components(array('product_components.product_id' => $item['product_id'], 'active' => 1));
        if($components)
            $item['components'] = $components;
        else
            $item['components'] = array();

        $item['total_sub_items'] = $order_sub_items?count($order_sub_items):0;

        if(!empty($item['is_box'])){
            $order_box_items = $models->order->get_order_box_items(array('order_item_id' => $item['id']));
            $item['box_items'] = empty($order_box_items)?0:$order_box_items;
        }else{
            $item['box_items'] = 0;
        }

        $data['order_items'][$item['id']] = $item;
    }
}else if (!empty($foody_details)){
    foreach($foody_details['group_items'] as $foody_group)
    {
        foreach ($foody_group['items']['order_dish'] as $foody_item)
        {
            $options = $foody_item['options'];
            $item = array(
                'id' => $foody_item['id'],
                'code' => $foody_item['id'],
                'quantity' => $foody_item['quantity'],
                'price' => floatval($foody_item['original_price']['value']/1000),
                'discount' => 0,
                'description' => $foody_item['note'],
                'product_description' => null,
                'product_name' => $foody_item['dish']['name'],
                'category_name' => $foody_group['group_name']?$foody_group['group_name']:'Foody Web',
                'final_price' => floatval($foody_item['price']['value']/1000),
                'sub_items' => null,
                'total_sub_items' => 0,
                'box_items' => 0
            );
            if (!empty($options)){
                $item['sub_items'] = array();
                foreach($options as $option){
                    $att_name = array();
                    foreach($option['attributes'] as $att)
                        $att_name[] = $att['name'];
                    $item['sub_items'][] = array('product_name' => $option['name'].': '.implode(',', $att_name)) ;
                }
                $item['total_sub_items'] = count($options);
            }
            $item['components'] = array();
            $data['order_items'][$item['id']] = $item;
        }
    }
}

extract($data);
$order_type = eModel::_select_one('order_types', array('id' => $order['type_id']));