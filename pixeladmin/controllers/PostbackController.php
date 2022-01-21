<?php


require_once(EFRUIT_ABSOLUTE_PATH . "PHPMailer/sender.php");
require_once('BasePostbackController.php');
/**
 * Class declaration
 */
class PostbackController extends BasePostbackController
{
    function __construct()
    {
        ini_set("display_errors", 1);
        $this->require_logged = 0;
        parent::__construct();

        $this->action = request('action');
        $not_require_logged = array('login');
        if (!in_array($this->action, $not_require_logged) && !$this->is_logged) {
            /* AJAX check  */
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                /* special ajax here */
                $this->_error('Bạn vui lòng đăng nhập lại!', 'INVALID_SESSION');
            } else
                redirect('dang-nhap');
        }
        $this->load_model('*');
        $this->boolean_fields = array(
            'enabled',
            'do_shipping', 'is_fulltime', 'need_deposit',
            'is_locked',
            'allow_delivery',
            'has_invoice',
            'is_additional', 'not_deliver', 'free_choice', 'is_hidden', 'show_components_on_frontend', 'is_box', 'can_be_added_to_box',
            'is_main',
            'temporary_close', 'has_sales_time',
            'has_voucher_form'
        );
        $this->price_fields = array(
            'base_price', 'promotion_price'
        );
    }


    function _export($objPHPExcel, $filename)
    {
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $file_path = ABSOLUTE_PATH . '/export/' . $filename . '.xlsx';
        $objWriter->save($file_path);
        if (file_exists($file_path)) {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            echo file_get_contents($file_path);
        }
    }

    function index()
    {
        $this->_error('Lỗi! Vui lòng liên hệ admin!!');
    }

    function login()
    {
        $username = post('username');
        $passed_password = post('password');
        $honey = isset($_POST["honey"]) && $_POST["honey"] == '';
        if (!$honey) {
            //Autobot detected
            exit;
        }
        $decode_password = base64_decode($passed_password);
        /* decrypt */
        if (openssl_private_decrypt($decode_password, $decrypted_password, openssl_pkey_get_private(KEY_PRIVATE, KEY_PASSPHRASE))) {
            // expecting sha1password+timestamp
            if (strlen($decrypted_password) < 13) return false;
            // extract password
            $pass_lenth = strlen($decrypted_password) - 13;
            $password = substr($decrypted_password, 0, $pass_lenth);
            // extract stamp, stamp has milliseconds and is bigger than int
            $stamp = substr($decrypted_password, $pass_lenth);
            // extract timestamp, timestamp is in seconds, and is an int
            $timestamp = substr($stamp, 0, strlen($stamp) - 3);
            if (!is_numeric($timestamp)) return false;
            // check timestamp
            if (abs(time() - (int)$timestamp) > 300) {
                $this->_set_last_error('Thời gian chờ hơn 5 phút. Vui lòng đăng nhập lại.');
                redirect('dang-nhap');
            }
        } else
            $password = $passed_password;
        set_session_val('e_password', generate_secure_id(base64_encode($password), 3, 0));
        $encrypted_pass = password_encrypt($password, strtolower($username));
        $user = $this->Users->select_one(array('username' => $username, 'password' => $encrypted_pass));
        if (!$user) {
            //No user found
            $this->_set_last_error('Tài khoản hoặc mật khẩu không đúng!!');
            redirect('dang-nhap');
        }
        if ($user['enabled'] == 0) {
            $this->_set_last_error('Tài khoản đã ngưng hoạt động!!');
            redirect('dang-nhap');
        }
        if ($user['deleted'] == 1) {
            $this->_set_last_error('Tài khoản đã bị xóa!!');
            redirect('dang-nhap');
        }
        Users::do_login($user);
        $this->phpBB_login($username, $password, $user['type_id'] == SUPER_ADMIN_TYPE_ID);
        $redirect_link = get_session_val('redirect_link');
        delete_sesion_val('redirect_link');
        if ($redirect_link)
            redirect($redirect_link);
        else
            redirect('don-hang');
    }



    function logout()
    {
        Users::do_logout();
        global $user;
        if (!empty($user) && $user->data['user_id'] != ANONYMOUS) {
            $user->session_kill();
        }
        redirect('dang-nhap');
    }

    function login_as_user()
    {
        $user_id = post('user_id');
        if ($user_id && is_numeric($user_id)) {
            $user = $this->Users->get_details($user_id);
            if ($user) {
                Users::do_login($user, 1);
                $this->_ok();
            } else
                $this->_error('Invalid user id!');
        } else
            $this->_error('Invalid user id!');
    }

    function admin_edit()
    {
        global $primary_keys;
        $id = post('id');
        if (empty($id))
            $this->_error('ID không hợp lệ. Không thể lưu!!');

        $this->_beginTransaction();

        $field = post('field');
        $value = post('value');
        $table_name = post('table_name');
        $data = array($field => $value);
        switch ($table_name) {
            case 'customers':
                if ($field == 'mobile') {
                    if (strpos($value, '0') !== 0)
                        $value = '0' . $value;
                } elseif ($field == 'customer_name' || $field == 'address') {
                    $value = capitalize($value);
                }
                break;
            case 'categories':
            case 'products':
                if ($field == 'name') {
                    $data['name_without_utf8'] = remove_unicode($value);
                    //$data['code'] = get_code($data['name_without_utf8']);
                }
                break;
            case 'prices':
                if ($field == 'price') {
                    $ids = explode('_', $id);
                    if (count($ids) == 2) {
                        $where_params = array(
                            'product_id' => $ids[0],
                            'type_id' => $ids[1],
                            'deleted' => '0'
                        );
                        $existed = eModel::_select($table_name, $where_params);
                        if ($existed)
                            $success = eModel::_update($table_name, $where_params, array('price' => $value));
                        else {
                            $params = $where_params;
                            $params['price'] = $value;
                            $params['created_dtm'] = date('Y-m-d H:i:s');;
                            $success = eModel::_insert($table_name, $params);
                        }
                        if (!$success)
                            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

                        $product = $this->Products->get_details($ids[0]);
                        if ($product && $product['is_additional']) {
                            $belongs_to = substr($product['belongs_to'], 1, strlen($product['belongs_to']) - 2);
                            if ($belongs_to)
                                eModel::_update('products', array('where' => "product_id IN ($belongs_to)"), array('set' => 'modified_dtm = NOW()'));
                        }

                        //save_setting('order_items_update_time', time());
                    } elseif (USING_SAME_PRICE) {
                        $success = $this->_admin_update_single_price($id, $value);
                        if (!$success)
                            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
                    } else
                        $this->_error('ID không hợp lệ. Không thể lưu!!');
                }
                $this->_ok();
                break;
            case 'vouchers':
                if ($field == 'amount') {
                    $data['amount'] = floatval($value) / 1000.0;
                }
                break;
            case 'orders':
                if ($field == 'service_fee') {
                    if (floatval($value) >= 1000)
                        $value = floatval($value) / 1000.0;
                    $data['service_fee'] = $value;
                    $order = $this->Orders->get_details($id);
                    if ($order) {
                        /* Create voucher - force to assign to branch 1 */
                        $shipper = $this->Users->get_details($order['shipper_id']);
                        $description = 'Tiền ship' . (!empty($shipper['fullname']) ? ' - ' . $shipper['fullname'] : '') . ' - Hóa đơn ' . $order['code'];
                        $existed_voucher = $this->Vouchers->select_one(array(
                            'branch_id' => LHP_BRANCH_ID,
                            'type' => 'payment',
                            'where' => "description like 'Tiền ship %' AND description like '%" . $order['code'] . "'"
                        ));
                        $where_arr = array();
                        $where_arr['order_id'] = $order['id'];
                        $where_arr['user_id'] = $this->logged_user['user_id'];
                        $existed_shipping = $this->Shippingdetails->select_one($where_arr);
                        if ($data['service_fee'] > 0) {
                            if ($existed_voucher) {
                                $payment_voucher_data = array(
                                    'description' => $description,
                                    'amount' => $data['service_fee'],
                                    'user_id' => $this->logged_user['user_id']
                                );
                                $this->Vouchers->update($existed_voucher['id'], $payment_voucher_data);
                            } else {
                                $payment_voucher_data = array(
                                    'branch_id' => LHP_BRANCH_ID,
                                    'type' => 'payment',
                                    'description' => $description,
                                    'amount' => $data['service_fee'],
                                    'user_id' => $this->logged_user['user_id']
                                );
                                $payment_voucher_data['date_time'] = $payment_voucher_data['created_dtm'] = date('Y-m-d H:i:s');
                                $this->Vouchers->insert($payment_voucher_data);
                            }
                            $shipping_info = $order['shipping_info'] ? json_decode($order['shipping_info'], true) : null;
                            if ($shipping_info) {
                                $shipping_data = array(
                                    'user_id' => $order['shipper_id'],
                                    'customer_id' => $order['customer_id'],
                                    'order_id' => $order['id'],
                                    'distance' => $shipping_info['distance'],
                                    'number_of_dishes' => $order['quantity'],
                                    'total' => $order['total'],
                                    'branch_id' => $order['branch_id'],
                                    'date_time' => $order['delivery_date'],
                                    'description' => $data['service_fee'],
                                    'created_by' => $this->logged_user['user_id']
                                );
                                if ($existed_shipping) {
                                    $this->Shippingdetails->update($existed_shipping['id'], $shipping_data);
                                } else {
                                    $shipping_data['created_dtm'] = date('Y-m-d H:i:s');
                                    $this->Shippingdetails->insert($shipping_data);
                                    $this->Orders->update($order['id'], array('is_shipped' => $order['is_shipped'] + 1));
                                }
                            }
                            $cost_data = array(
                                'name' => $description,
                                'type_id' => SHIPPING_COST_TYPE_ID,
                                'date_time' => $order['delivery_date'],
                                'amount' => $data['service_fee'] <= 1000 ? $data['service_fee'] * 1000 : $data['service_fee'],
                                'payment_type' => 'cash',
                                'user_id' => $this->logged_user['user_id'],
                                'order_id' => $order['id'],
                                'created_by' => $this->logged_user['user_id'],
                                'created_dtm' => date('Y-m-d H:i:s')
                            );

                            $existed_cost = $this->Costs->get_details_by_order_id($cost_data['order_id']);
                            if (empty($existed_cost)) {
                                if ($this->Costs->insert($cost_data))
                                    subtract_balance($data['service_fee'], 'cash');
                            } else {
                                if ($this->Costs->update($existed_cost['id'], $cost_data)) {
                                    add_balance($existed_cost['amount'], $existed_cost['payment_type']);
                                    subtract_balance($data['service_fee'], 'cash');
                                }
                            }
                        } elseif ($existed_voucher) {
                            $this->Vouchers->delete($existed_voucher['id']);
                            if ($existed_shipping && !empty($existed_shipping['id']))
                                $this->Shippingdetails->delete($existed_shipping['id']);
                            $this->Orders->update($order['id'], array('is_shipped' => $order['is_shipped'] - 1));
                            $cost = $this->Costs->get_details_by_order_id($order['id']);
                            if ($cost) {
                                add_balance($cost['amount'], $cost['payment_type']);
                                $this->Costs->delete($cost['id']);
                            }
                        }
                    }
                } elseif ($field == 'shipper_id') {
                    $order = $this->Orders->get_details($id);
                    if ($order) {
                        if ($order['customer_id'])
                            $customer = $this->Customers->get_details($order['customer_id']);
                        $shipper = $this->Users->get_details($value);

                        $existed_voucher = $this->Vouchers->select_one(array(
                            'branch_id' => LHP_BRANCH_ID,
                            'type' => 'payment',
                            'where' => "description like 'Đơn hàng #" . $order['code'] . "%'"
                        ));

                        if ($shipper && $shipper['user_id'] == SHIPNOW_USER_ID) {
                            if ($existed_voucher) {
                                $this->Vouchers->update($existed_voucher['id'], array(
                                    'amount' => $order['total'],
                                    'user_id' => $this->logged_user['user_id'] ? $this->logged_user['user_id'] : 1
                                ));
                            } else {
                                $payment_voucher_data = array(
                                    'branch_id' => LHP_BRANCH_ID,
                                    'type' => 'payment',
                                    'description' => 'Đơn hàng #' . $order['code'] . (!empty($customer['fullname']) ? ' - ' . $customer['fullname'] : '') . ' - ' . get_payment_method_string('shipnow'),
                                    'amount' => $order['total'],
                                    'user_id' => $this->logged_user['user_id'] ? $this->logged_user['user_id'] : 1
                                );
                                $payment_voucher_data['date_time'] = $payment_voucher_data['created_dtm'] = empty($order['delivery_date']) ? date('Y-m-d H:i:s') : $order['delivery_date'];
                                $this->Vouchers->insert($payment_voucher_data);
                            }
                            if ($order['is_prepaid'] == 0) {
                                $data['is_prepaid'] = 1;
                                $data['payment_method'] = 'shipnow';
                            }
                        } else {
                            if ($existed_voucher) {
                                $this->Vouchers->delete($existed_voucher['id']);
                            }
                            if ($order['is_prepaid'] == 1 && $order['payment_method'] == 'shipnow') {
                                $data['is_prepaid'] = 0;
                                $data['payment_method'] = 'cod';
                            }
                        }
                    }
                }
                break;
            case 'costs':
                if ($field == 'amount') {
                    $cost = $this->Costs->get_details($id);
                    $diff = intval($data['amount']) - intval($cost['amount']);
                    if ($diff > 0) {
                        subtract_balance($diff, $cost['payment_type']);
                    } else if ($diff < 0) {
                        add_balance(-1 * $diff, $cost['payment_type']);
                    }
                }
                break;
        }
        $primary_key = !empty($primary_keys[$table_name]) ? $primary_keys[$table_name] : 'id';
        $success = eModel::_update($table_name, array($primary_key => $id), $data);
        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        if ($table_name == 'users') {
            $this->update_phpBB_user($id, $data);
        }
        $this->_ok();
    }

    function admin_delete()
    {
        $id = post('id');
        if (empty($id) || !is_numeric($id))
            $this->_error('ID không hợp lệ. Không thể xóa!!');

        $this->_beginTransaction();

        global $primary_keys;
        $table_name = post('table_name');
        $primary_key = !empty($primary_keys[$table_name]) ? $primary_keys[$table_name] : 'id';
        switch ($table_name) {
            case 'assessment':
            case 'shipping_details':
            case 'salary_advances':
            case 'promotion_codes':
                $deleted = eModel::_delete($table_name, array($primary_key => $id));
                break;
            case 'users':
                if ($id == $this->logged_user['user_id'])
                    $this->_error('Không thể xóa chính tài khoản của mình!!');
                $deleted = eModel::_update($table_name, array($primary_key => $id), array('deleted' => '1', 'enabled' => '0'));
                break;
            case 'branches':
            case 'categories':
            case 'pages':
            case 'announcements':
                $deleted = eModel::_update($table_name, array($primary_key => $id), array('deleted' => '1', 'enabled' => '0'));
                break;
            case 'products':
                $deleted = eModel::_update($table_name, array($primary_key => $id), array('deleted' => '1', 'enabled' => '0', 'is_hidden' => '1'));
                $product_exists = $this->Products->get_details($id);
                if ($product_exists) {
                    if ($product_exists['is_additional']) {
                        $belongs_to = substr($product_exists['belongs_to'], 1, strlen($product_exists['belongs_to']) - 1);
                        $ids = array_filter(explode(',', $belongs_to));
                        if (!empty($ids))
                            $this->Products->update(array('where' => 'products.product_id IN (' . implode(',', $ids) . ')'), array('modified_dtm' => date('Y-m-d H:i:s')));
                    }
                }
                break;
            case 'prices':
                $deleted = eModel::_update($table_name, array('product_id' => $id), array('deleted' => '1'));
                break;
            case 'orders':
                $deleted = eModel::_update($table_name, array($primary_key => $id), array('deleted' => '1', 'status' => 'Failed'));
                break;
            default:
                $deleted = eModel::_update($table_name, array($primary_key => $id), array('deleted' => '1'));
                break;
        }
        if (!$deleted)
            $this->_error('Có lỗi xảy ra. Không thể xóa!!');
        if ($table_name == 'users') {
            $this->update_phpBB_user($id, array('deleted' => '1'));
        } else if ($table_name == 'costs') {
            /* Soft delete then we can get the details when it is deleted */
            $cost = $this->Costs->get_details($id);
            add_balance($cost['amount'], $cost['payment_type']);
        }
        $this->_ok();
    }

    function admin_update_user()
    {
        $this->_beginTransaction();
        $user_id = post('user_id');
        $fields = array(
            'username', 'fullname', 'email', 'type_id', 'enabled', 'do_shipping',
            'rate_per_hour', 'mobile_number', 'branch_id',
            'is_fulltime', 'parking_fee', 'need_deposit', 'hours_deposit', 'salary_per_month',
            'description'
        );
        $required_fields = array('fullname', 'type_id', 'branch_id', 'rate_per_hour');
        if (!$user_id)
            $required_fields[] = 'username';
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $password = post('password');
        $data['username'] = strtolower($data['username']);

        if (empty($data['need_deposit']))
            $data['hours_deposit'] = 0;

        if (intval($data['parking_fee']) > 1000)
            $data['parking_fee'] = $data['parking_fee'] / 1000;

        if (intval($data['salary_per_month']) > 1000000)
            $data['salary_per_month'] = $data['salary_per_month'] / 1000;

        if ($user_id) {
            $user = $this->Users->get_details($user_id);
            if (!$user)
                $this->_error('Mã người dùng không hợp lệ!!');
            if ($password)
                $data['password'] = password_encrypt($password, $user['username']);
            unset($data['username']);
            $success = $this->Users->update($user_id, $data);
        } else {
            if (empty($password))
                $this->_error('Vui lòng nhập mật khẩu!!');
            else
                $data['password'] = password_encrypt($password, $data['username']);
            $user_exists = $this->Users->select(array('username' => $data['username']));
            if (!$user_exists) {
                $data['created_dtm'] = date('Y-m-d H:i:s');;
                $success = $this->Users->insert($data);
            } else
                $this->_error('Username đã được sử dụng. Vui lòng nhập username khác!!');
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

        $this->return["status"] = "OK";
        $this->return["message"] = '';
        $this->_commitTransaction();

        if ($user_id)
            $this->update_phpBB_user($user_id, $data);
        elseif (is_numeric($success))
            $this->update_phpBB_user($success, $data);
        $this->_send();
    }

    function update_user()
    {
        $this->_beginTransaction();
        $fields = array('fullname', 'email', 'mobile_number');
        $data = array();
        foreach ($fields as $f)
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
        $user_id = post('user_id');
        $password = post('password');
        if ($password) {
            $data['password'] = password_encrypt($password, $this->logged_user['username']);
        }
        if ($user_id) {
            $success = $this->Users->update($user_id, $data);
        } else {
            $this->_error('Có lỗi xảy ra, vui lòng đăng nhập lại!!');
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

        if ($user_id == $this->logged_user['user_id']) {
            $user = $this->Users->get_details($user_id);
            set_session_val('user', $user);
        }
        $this->update_phpBB_user($user_id, $data);
        $this->_ok();
    }

    function admin_update_customer()
    {
        $this->_beginTransaction();
        $fields = array('customer_name', 'address', 'district', 'type_id', 'mobile', 'description', 'distance', 'lat', 'lng', 'email', 'is_locked', 'company_name', 'company_tax_code', 'company_address');
        $required_fields = array('customer_name', 'address', 'district', 'type_id', 'mobile', 'distance');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        if (strpos($data['mobile'], '0') !== 0)
            $data['mobile'] = '0' . $data['mobile'];

        if (intval($data['mobile']) == 0)
            $data['mobile'] = 0;

        $data['customer_name'] = capitalize($data['customer_name']);
        $data['address'] = capitalize($data['address']);

        $data['modified_by'] = $this->logged_user['user_id'];
        $customer_id = post('customer_id');
        if ($customer_id) {
            $success = $this->Customers->update($customer_id, $data);
        } else {
            $customer_existed = $this->Customers->select(array('mobile' => $data['mobile'], 'deleted' => 0));
            if (!$customer_existed || $data['mobile'] == 0) {
                $data['created_dtm'] = date('Y-m-d H:i:s');;
                $success = $this->Customers->insert($data);
            } else
                $this->_error('Số điện thoại đã được sử dụng. Vui lòng kiểm tra lại!!');
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_search_customer()
    {
        $filter_district = post('filter_district');
        $filter_arr = array();
        if ($filter_district)
            $filter_arr['customers.district'] = $filter_district;
        $this->data['customers'] = $this->Customers->get_list($filter_arr);
        $this->return['html'] = $this->load_view('customer/list', 1);
        $this->_ok();
    }

    function admin_export_customer()
    {
        $filter_keyword = post("filter_keyword");
        $filter_district = post("filter_district");
        $filter_type = post("filter_type");
        $filter_products = post("filter_products");

        $columns = array(
            0 => 'customer_name',
            1 => 'address',
            2 => 'last_order_dtm',
            3 => 'mobile',
            4 => 'distance',
            5 => 'number_of_order',
            6 => 'total_paid',
            7 => 'free_ship',
            8 => 'action'
        );


        $sorting_index = post('sorting_index');

        $sorting_field = $sorting_index && isset($columns[$sorting_index]) ? $columns[$sorting_index] : '';
        $direction = post('sorting_dir', 'ASC');

        $filter_array = array();
        if ($filter_district) {
            $filter_array['customers.district'] = $filter_district;
        }
        if ($filter_type) {
            $filter_array['customers.type_id'] = $filter_type;
        }
        $where = array();
        if ($filter_products) {
            $order_items = $this->Orders->get_order_items(array('where' => 'order_items.product_id IN (' . $filter_products . ')'));
            if ($order_items) {
                $customer_ids = array_unique(array_values(Hash::extract($order_items, '{n}.customer_id')));
                $where[] = 'customers.customer_id IN (' . implode(',', $customer_ids) . ')';
            } else {
                $this->_error('Không có khách hàng nào phù hợp với điều kiện.');
            }
        }
        if ($filter_keyword) {
            $search_str = "LOWER(customer_name) LIKE '%$filter_keyword%' OR LOWER(address) LIKE '%$filter_keyword%' OR mobile LIKE '%$filter_keyword%'";
            $where[] = "($search_str)";
        }
        if ($where)
            $filter_array['where'] = implode(' AND ', $where);

        $order_by = '';
        if ($sorting_field)
            $order_by = $sorting_field . (!empty($direction) ? ' ' . $direction : '');

        $checking = post('checking');
        $customers = $this->Customers->get_list($filter_array, $order_by);

        if ($checking) {
            if ($customers)
                $this->_ok();
            else
                $this->_error('Không có khách hàng nào phù hợp với điều kiện.');
        } else {
            if ($customers) {
                $columns = $this->columns;
                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();
                // Set document properties
                $objPHPExcel->getProperties()->setCreator(get_setting('site_name') . " Manager")
                    ->setLastModifiedBy(get_setting('site_name') . " Manager")
                    ->setTitle("Office 2007 XLSX Customer Export Document")
                    ->setSubject("Office 2007 XLSX Customer Export Document")
                    ->setDescription("Customer export document for Office 2007 XLSX, generated using PHP classes at " . DOMAIN_NAME . ".")
                    ->setKeywords("office 2007 openxml php customer export")
                    ->setCategory("Customer export");

                $header_text = array('Tên', 'Địa chỉ', 'Điện thoại', 'Email', 'Khoảng cách', 'Số đơn hàng', 'Tích lũy');
                $number_of_columns = count($header_text);
                for ($col_index = 1; $col_index <= $number_of_columns; $col_index++)
                    $objPHPExcel->getActiveSheet()->getColumnDimension($columns[$col_index])->setAutoSize(true);

                $col_index = 1;
                foreach ($header_text as $header)
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . '1', $header);


                $row_index = 2;
                foreach ($customers as $record) {
                    $col_index = 1;
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['customer_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, str_replace(",", "-", $record['address']) . ($record['district'] ? " - Q." . $record['district'] : ''));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['mobile']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['email']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['distance']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['number_of_order']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index++, $record['total_paid'] ? $record['total_paid'] * 1000 : '0');
                }
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Danh sách khách hàng - ' . date('Ymd'));


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $filename = "danhsachkhachhang_" . date('Ymd');
                $this->_export($objPHPExcel, $filename);
            }
        }
        exit;
    }

    function admin_get_customers()
    {
        global $URIs;
        $columns = array(
            0 => 'customer_name',
            1 => 'address',
            2 => 'last_order_dtm',
            3 => 'mobile',
            4 => 'distance',
            5 => 'number_of_order',
            6 => 'total_paid',
            7 => 'free_ship',
            8 => 'action'
        );

        $sorting_field = isset(post('order')[0]['column']) ? $columns[post('order')[0]['column']] : '';
        $direction = isset(post('order')[0]['dir']) ? post('order')[0]['dir'] : 'ASC';
        $length = post("length", 0);
        $start = post("start", 0);

        $filter_keyword = post("filter_keyword");
        $filter_district = post("filter_district");
        $filter_type = post("filter_type");
        $filter_products = post("filter_products");

        $filter_array = array();
        if ($filter_district) {
            $filter_array['customers.district'] = $filter_district;
        }
        if ($filter_type) {
            $filter_array['customers.type_id'] = $filter_type;
        }
        $where = array();
        if ($filter_products && is_array($filter_products)) {
            $order_items = $this->Orders->get_order_items(array('where' => 'order_items.product_id IN (' . implode(',', $filter_products) . ')'));
            if ($order_items) {
                $customer_ids = array_unique(array_values(Hash::extract($order_items, '{n}.customer_id')));
                $where[] = 'customers.customer_id IN (' . implode(',', $customer_ids) . ')';
            } else {
                $draw = intval(post("draw"));
                $result = array(
                    "draw" => $draw,
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array()
                );
                echo json_encode($result);
                die;
            }
        }
        if ($filter_keyword) {
            $search_str = "LOWER(customer_name) LIKE '%$filter_keyword%' OR LOWER(address) LIKE '%$filter_keyword%' OR mobile LIKE '%$filter_keyword%'";
            $where[] = "($search_str)";
        }
        if ($where)
            $filter_array['where'] = implode(' AND ', $where);

        $order_by = '';
        if ($sorting_field)
            $order_by = $sorting_field . (!empty($direction) ? ' ' . $direction : '');
        $customers = $this->Customers->get_list($filter_array, $order_by);
        $last_query = get_last_query();
        $count_all = !empty($customers) ? count($customers) : 0;
        $data = array();
        if ($count_all) {
            for ($i = $start; $i < $start + $length; $i++) {
                if (empty($customers[$i]))
                    continue;
                $item = $customers[$i];
                $address = $item['address'] . ($item['district'] ? ", Q." . $item['district'] : '');
                $days = 9999;
                if ($item['last_order_dtm']) {
                    $days = ceil((time() - strtotime($item['last_order_dtm'])) / (60 * 60 * 24));
                }
                $html = '';
                if (!empty($item['lat']) && !empty($item['lng']))
                    $html = '<a target="_blank" href="http://maps.google.com/maps?f=d&saddr=' . DEFAULT_LAT . ',' . DEFAULT_LNG . '&daddr=' . $item['lat'] . ',' . $item['lng'] . '" class="btn btn-sm btn-info" title="Hiển thị đường đi"><i class="fa fa-map-marker"></i></a>';
                if (Users::can_access('customer', 'modify')) {
                    $html .= '&nbsp;<a target="_blank" href="' . BASE_URL . $URIs['customers'] . '/' . $item['customer_id'] . '" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>&nbsp;<a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>';
                }
                $data[] = array(
                    '<input data-id="' . $item['customer_id'] . '" type="text" value="' . $item['customer_name'] . '" class="customer_name" />',
                    '<span>' . $address . '<br />' . $item['email'] . '</span>',
                    $days == 9999 ? '-' : "$days ngày",
                    '<input data-id="' . $item['customer_id'] . '" type="text" value="' . $item['mobile'] . '" class="mobile" />',
                    '<input data-id="' . $item['customer_id'] . '" type="text" value="' . $item['distance'] . '" class="distance" />',
                    '<a target="_blank" href="' . BASE_URL . $URIs['orders'] . '/tim/customer_id-' . $item['customer_id'] . '">' . 'Chi tiết' . '</a>',
                    $item['total_paid'] ? number_format($item['total_paid'], 0, ',', '.') . '.000' : '0',
                    '<div class="custom-checkbox-with-tick small">
                        <input data-id="' . $item['customer_id'] . '" id="free_ship_' . $item['customer_id'] . '" type="checkbox" value="1" class="free_ship" ' . (getvalue($item, 'free_ship') ? 'checked="checked"' : '') . ' autocomplete="off"/>
                        <label for="free_ship_' . $item['customer_id'] . '">&nbsp;</label>
                    </div>',
                    $html
                );
            }
        }

        $draw = intval(post("draw"));
        $result = array(
            "query" => $last_query,
            "draw" => $draw,
            "recordsTotal" => $count_all,
            "recordsFiltered" => $count_all,
            "data" => $data
        );
        echo json_encode($result);
        die;
    }

    function admin_search_assessment()
    {
        $filter_day = post('filter_day');
        $filter_month = post('filter_month');
        $filter_year = post('filter_year');
        $filter_member = post('filter_member');
        $filter_arr = array();
        if ($filter_day && $filter_month && $filter_year) {
            $filter_date = "$filter_year-$filter_month-$filter_day";
            $filter_arr = array('assessment_date' => $filter_date);
        } elseif ($filter_month && $filter_year) {
            $filter_arr = array('where' => "MONTH(assessment_date) = '$filter_month' AND YEAR(assessment_date) = '$filter_year'");
        }
        if ($filter_member && is_numeric($filter_member))
            $filter_arr['assessment.user_id'] = $filter_member;
        $this->data['assessments'] = $this->Assessment->get_list($filter_arr, 'assessment.assessment_date DESC');
        $this->return['html'] = $this->load_view('assessment/list', 1);
        $this->_ok();
    }

    function admin_export_working_time()
    {
        $filter_day = post('filter_day');
        $filter_month = post('filter_month');
        $filter_year = post('filter_year');
        $filter_member = post('filter_member');
        $filter_arr = array();
        if ($filter_day && $filter_month && $filter_year) {
            $filter_date = "$filter_year-$filter_month-$filter_day";
            $filter_arr = array('assessment_date' => $filter_date);
        } elseif ($filter_month && $filter_year) {
            $filter_arr = array('where' => "MONTH(assessment_date) = '$filter_month' AND YEAR(assessment_date) = '$filter_year'");
        }
        if ($filter_member && is_numeric($filter_member))
            $filter_arr['assessment.user_id'] = $filter_member;
        $assessments = $this->Assessment->get_list($filter_arr);
        $checking = post('checking');
        if ($checking) {
            if ($assessments)
                $this->_ok();
            else
                $this->_error('Không có dữ liệu nào phù hợp với điều kiện.');
        } else {
            if ($assessments) {
                require_once(ABSOLUTE_PATH . 'models/common/Shippingdetails.php');
                $sd_ = new Shippingdetails();

                $user_details = array();
                $data = array();
                foreach ($assessments as $record) {
                    $user_id = $record['user_id'];
                    if (!array_key_exists($user_id, $user_details)) {
                        $salary_for_delivery = $sd_->get_salary_for_delivery($user_id, compact('filter_year', 'filter_month', 'filter_day'));
                        $salary_in_advances = $this->Salaryadvances->get_total_amount($user_id, compact('filter_year', 'filter_month', 'filter_day'));
                        $shipped_orders = $sd_->shipped_by($user_id, compact('filter_year', 'filter_month', 'filter_day'));
                        $user_details[$user_id] = array(
                            'kpi' => 0,
                            'salary_for_delivery' => $salary_for_delivery,
                            'salary_in_advances' => $salary_in_advances,
                            'name' => $record['fullname'],
                            'rate_per_hour' => $record['rate_per_hour'],
                            'overtime' => 0,
                            'parking_fee' => 0,
                            'hours_deposit' => $record['hours_deposit'],
                            'salary_per_month' => $record['salary_per_month'],
                            'total_shipped_orders' => empty($shipped_orders) || !is_array($shipped_orders) ? 0 : count($shipped_orders),
                            'allowance' => 0,
                            'need_deposit' => !empty($record['need_deposit']),
                            'is_fulltime' => !empty($record['is_fulltime']),
                            'minutes_late' => 0
                        );
                    }
                    $user_details[$user_id]['kpi'] += $record['kpi'];
                    $data[$record['fullname']][$record['assessment_date']] = $record['working_time'];
                    $user_details[$user_id]['overtime'] += floatval(preg_replace("/[^0-9]/", "", $record['overtime']));
                    $user_details[$user_id]['parking_fee'] += $record['parking_fee'];
                    $user_details[$user_id]['minutes_late'] += $record['minutes_late'];
                    if ($record['is_fulltime'] && $record['working_time'] > 0)
                        $user_details[$user_id]['allowance'] += 20;
                }

                $numberFormat = '#,##0';
                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();
                // Set document properties
                $objPHPExcel->getProperties()->setCreator(get_setting('site_name') . " Manager")
                    ->setLastModifiedBy(get_setting('site_name') . " Manager")
                    ->setTitle(get_setting('site_name') . " Manager - Bảng chấm công")
                    ->setSubject(get_setting('site_name') . " Manager - Bảng chấm công")
                    ->setKeywords(get_setting('site_name') . " manager bảng chấm công")
                    ->setCategory("Bảng chấm công");

                $columns = $this->columns;
                $representation_of_days = $this->representation_of_days;
                $number_of_columns = count($user_details) + 1;
                for ($col_index = 1; $col_index <= $number_of_columns; $col_index++)
                    $objPHPExcel->getActiveSheet()->getColumnDimension($columns[$col_index])->setAutoSize(true);

                //skip the top left cell
                $col_index = 2;
                foreach ($user_details as $detail) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . '1', $detail['name']);
                }

                $row_index = 2;
                $col_index = 1;
                $month_year = "$filter_year-$filter_month";
                $start_day = 1;
                $last_day = date('t', strtotime($month_year));
                if ($filter_day) {
                    $start_day = $last_day = $filter_day;
                }
                for ($i = $start_day; $i <= $last_day; $i++) {
                    $col_index = 1;
                    $short_day = $representation_of_days[date('D', strtotime("$month_year-$i"))];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, sprintf($short_day . ' %02d/' . date("m", strtotime($month_year)) . ' ', $i));
                    foreach ($user_details as $detail) {
                        $n = $detail['name'];
                        $format = sprintf("%04d-%02d-%02d", $filter_year, $filter_month, $i);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, getvalue($data[$n], date($format)));
                    }
                    $row_index++;
                }
                $col_index = 1;
                $total_hour_row_index = $row_index;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Tổng giờ');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, "=SUM({$col}2:{$col}" . ($row_index - 1) . ")");
                    $col_index++;
                }

                $row_index++;
                $col_index = 1;
                $total_ot_row_index = $row_index;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Giờ tăng ca');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, $detail['overtime']);
                    $col_index++;
                }

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Số phút đi trễ/về sớm');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, $detail['minutes_late']);
                    $col_index++;
                }

                $row_index++;
                $start_sum_row = $row_index;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Lương');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    if ($detail['is_fulltime']) {
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, $detail['salary_per_month'] * 1000);
                    } else {
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, "={$col}{$total_hour_row_index}*" . ($detail['rate_per_hour'] * 1000));
                    }
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($columns[$col_index])->setWidth(12);

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Lương tăng/giảm ca');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, "={$col}{$total_ot_row_index}*" . ($detail['rate_per_hour'] * 1000));
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Giao hàng');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, $detail['salary_for_delivery'] * 1000);
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Phụ cấp giao hàng');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, $detail['total_shipped_orders'] > 100 ? 100000 : 0);
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                /*
                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, 'Phụ cấp ăn trưa');
                foreach($user_details as $detail)
                {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col.$row_index, $detail['allowance']*1000);
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col.$row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index].$row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index].$row_index)->getNumberFormat()->setFormatCode($numberFormat);
                */

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Thưởng');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, 0);
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Tiền giữ xe');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, $detail['parking_fee'] * 1000);
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Tạm ứng');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, -$detail['salary_in_advances'] * 1000);
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Cọc lương');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    if ($detail['need_deposit']) {
                        if ($detail['salary_per_month'])
                            $val = round($detail['salary_per_month'] / get_setting('working_days_in_months') * 2 * 1000);
                        else
                            $val = $detail['hours_deposit'] * $detail['rate_per_hour'] * 1000;
                    } else {
                        $val = 0;
                    }
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, -1 * $val);
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Khác');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, 0);
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                $row_index++;
                $end_sum_row = $row_index - 1;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'Tổng cộng');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, "=SUM({$col}{$start_sum_row}:{$col}{$end_sum_row})");
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle($col . $row_index)->getNumberFormat()->setFormatCode($numberFormat);
                    $col_index++;
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index] . $row_index, "=SUM(B{$row_index}:{$col}{$row_index})");
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($columns[$col_index] . $row_index)->getNumberFormat()->setFormatCode($numberFormat);

                $row_index++;
                $col_index = 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, 'KPI');
                foreach ($user_details as $detail) {
                    $col = $columns[$col_index];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row_index, $detail['kpi']);
                    $col_index++;
                }

                $extra_info = (isset($filter_date) ? date('Ymd', strtotime($filter_date)) : date('Ym', strtotime("$filter_year-$filter_month"))) . ($filter_member ? "_" . $filter_member : '');
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Bảng chấm công - ' . $extra_info);


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $filename = "bangchamcong_" . $extra_info;
                $this->_export($objPHPExcel, $filename);
            }
        }
        exit;
    }

    function admin_export_assessment()
    {
        $filter_day = post('filter_day');
        $filter_month = post('filter_month');
        $filter_year = post('filter_year');
        $filter_member = post('filter_member');
        $filter_arr = array();
        if ($filter_day && $filter_month && $filter_year) {
            $filter_date = "$filter_year-$filter_month-$filter_day";
            $filter_arr = array('assessment_date' => $filter_date);
        } elseif ($filter_month && $filter_year) {
            $filter_arr = array('where' => "MONTH(assessment_date) = '$filter_month' AND YEAR(assessment_date) = '$filter_year'");
        }
        if ($filter_member && is_numeric($filter_member))
            $filter_arr['assessment.user_id'] = $filter_member;
        $assessments = $this->Assessment->get_list($filter_arr, 'fullname, assessment_date');
        $checking = post('checking');
        if ($checking) {
            if ($assessments)
                $this->_ok();
            else
                $this->_error('Không có đánh giá nào phù hợp với điều kiện.');
        } else {
            if ($assessments) {
                $columns = $this->columns;
                $representation_of_days = $this->representation_of_days;
                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();
                // Set document properties
                $objPHPExcel->getProperties()->setCreator(get_setting('site_name') . " Manager")
                    ->setLastModifiedBy(get_setting('site_name') . " Manager")
                    ->setTitle(get_setting('site_name') . " Manager - Bảng đánh giá")
                    ->setSubject(get_setting('site_name') . " Manager - Bảng đánh giá")
                    ->setKeywords("bảng đánh giá")
                    ->setCategory("Bảng đánh giá");

                $header_text = array('Ngày', 'Tên', 'Tiến độ', 'Tập trung', 'Vi phạm nội quy', 'Quản lý nhắc nhở', 'Hỏng vật dụng', 'Chuyên cần', 'Chấm công', 'Tăng ca', 'KPI', 'Ghi chú');
                $number_of_columns = count($header_text);
                for ($col_index = 1; $col_index <= $number_of_columns; $col_index++)
                    $objPHPExcel->getActiveSheet()->getColumnDimension($columns[$col_index])->setAutoSize(true);

                $col_index = 1;
                foreach ($header_text as $header)
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . '1', $header);

                $row_index = 2;

                $month_year = "$filter_year-$filter_month";
                foreach ($assessments as $record) {
                    $col_index = 1;
                    $short_day = $representation_of_days[date('D', strtotime($record['assessment_date']))];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $short_day . ' ' . date('d/m', strtotime($record['assessment_date'])));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['fullname']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, getvalue(unserialize(WORK_PROCESS_ARR), $record['work_process']));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, getvalue(unserialize(CONCENTRATION_ARR), $record['concentration']));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, getvalue(unserialize(RULES_VIOLATION_ARR), $record['rules_violation']));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, getvalue(unserialize(BEING_PROMPTED_ARR), $record['being_prompted']));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['breaking_things']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, getvalue(unserialize(ASSIDUOUSNESS_ARR), $record['assiduousness']));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['working_time']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['overtime']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $record['kpi']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index++, $record['description']);
                }

                $extra_info = (isset($filter_date) ? date('Ymd', strtotime($filter_date)) : date('Ym', strtotime("$filter_year-$filter_month"))) . ($filter_member ? "_" . $filter_member : '');

                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Bảng đánh giá - ' . $extra_info);


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $filename = "bangdanhgia_" . $extra_info;
                $this->_export($objPHPExcel, $filename);
            }
        }
        exit;
    }

    function do_assessment()
    {
        $fields = array(
            'user_id',
            'assessment_date',
            'work_process',
            'overtime',
            'concentration',
            'disconcentrated',
            'rules_violation',
            'violated_rule',
            'being_prompted',
            'breaking_things',
            'assiduousness',
            'working_time',
            'description',
            'parking_fee',
            'minutes_late'
        );
        $data = array();
        foreach ($fields as $f)
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');

        $assessment_id = post('assessment_id');
        $is_ajax = post('ajax');

        $break_things = post('break_things');
        if (!$break_things)
            $data['breaking_things'] = null;

        if (!post('has_parked', 0))
            $data['parking_fee'] = 0;
        elseif ($data['parking_fee'] > 1000)
            $data['parking_fee'] = $data['parking_fee'] / 1000;

        $data['has_allowance'] = post('has_allowance', 0);
        $data['self_criticism'] = post('self_criticism', 0);

        if ($data['assiduousness'] == 'off_w_permission' || $data['assiduousness'] == 'off_wt_permission' || $data['assiduousness'] == 'off_by_manager') {
            $data['work_process'] = 'good';
            $data['concentration'] = 1;
            $data['disconcentrated'] = null;
            $data['rules_violation'] = 0;
            $data['violated_rule'] = null;
            $data['self_criticism'] = 0;
            $data['being_prompted'] = 0;
            $data['breaking_things'] = null;
            $data['working_time'] = 0;
            $data['overtime'] = 0;
            $data['parking_fee'] = 0;
            $data['minutes_late'] = 0;
        } else {
            $data['working_time'] = str_replace(',', '.', $data['working_time']);
            if (!is_numeric($data['working_time'])) {
                if ($is_ajax)
                    $this->_error('Số giờ làm việc phải là số hợp lệ (ví dụ: 4, 3.75).');
                else {
                    $this->_set_last_error('Số giờ làm việc phải là số hợp lệ (ví dụ: 4, 3.75).', $data);
                    redirect('danh-gia');
                }
            }
        }
        if (empty($data['minutes_late']))
            $data['minutes_late'] = 0;

        if ($data['assessment_date'])
            $data['assessment_date'] = convert_to_iso_datetime($data['assessment_date']);

        $times_to_do_assessment_late = MAX_TIMES_TO_DO_ASSESSMENT_LATE - $this->Assessment->get_late_assessment_in_month($data['user_id']);
        if ((Users::is_member() && $times_to_do_assessment_late <= 0) || empty($data['assessment_date']))
            $data['assessment_date'] = date('Y-m-d');
        else if (strtotime($data['assessment_date']) < strtotime(date('Y-m-d')) && Users::is_member() && $times_to_do_assessment_late > 0)
            $data['is_late'] = 1;

        // Calculate the KPI
        $data['kpi'] = $this->Assessment->calculate_kpi($data);
        $this->_beginTransaction();
        if (!$assessment_id) {
            $existed = $this->Assessment->select(array('assessment_date' => $data['assessment_date'], 'user_id' => $data['user_id']));
            if (!$existed) {
                //Insert assessment
                $data['created_dtm'] = date('Y-m-d H:i:s');
                $data['created_by'] = Users::get_userdata('user_id');
                $data['ip_address'] = get_user_ip();
                $success = $this->Assessment->insert($data);
                if (!$success)
                    if ($is_ajax)
                        $this->_error('Không thể lưu bảng đánh giá!! Vui lòng thử lại.');
                    else
                        $this->_set_last_error('Không thể lưu bảng đánh giá!! Vui lòng thử lại.', $data);
                if ($is_ajax)
                    $this->_ok('Đánh giá đã được lưu.');
                else
                    $this->_set_last_message('Đánh giá đã được lưu.');
            } else {
                if ($is_ajax)
                    $this->_error('Đã đánh giá cho ngày ' . date('d/m/Y', strtotime($data['assessment_date'])) . '!!');
                else
                    $this->_set_last_error('Đã đánh giá cho ngày này!!', $data);
            }
            redirect('danh-gia');
        } else {
            $existed = $this->Assessment->get_details($assessment_id);
            if (!$existed) {
                if ($is_ajax)
                    $this->_error('Bảng đánh giá không hợp lệ. Vui lòng thử lại!');
                else
                    $this->_set_last_error('Bảng đánh giá không hợp lệ. Vui lòng thử lại!', $data);
            }

            unset($data['assessment_date']);
            $success = $this->Assessment->update($assessment_id, $data);

            if (!$success) {
                if ($is_ajax)
                    $this->_error('Không thể lưu bảng đánh giá!! Vui lòng thử lại.');
                else
                    $this->_set_last_error('Không thể lưu bảng đánh giá!! Vui lòng thử lại.', $data);
            }
            if ($is_ajax)
                $this->_ok('Đánh giá đã được lưu.');
            else
                $this->_set_last_message('Đánh giá đã được lưu.');
            redirect('quan-ly-danh-gia');
        }
    }

    function add_working_time()
    {
        $fields = array(
            'user_id',
            'assessment_date',
            'overtime',
            'working_time',
            'description',
            'parking_fee'
        );
        $data = array();
        foreach ($fields as $f)
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');

        $assessment_id = post('assessment_id');
        $is_ajax = post('ajax');

        $data['assiduousness'] = null;
        $data['work_process'] = 'good';
        $data['concentration'] = 0;
        $data['rules_violation'] = 1;
        $data['being_prompted'] = 1;
        $data['breaking_things'] = null;
        $data['has_allowance'] = post('has_allowance', 0);
        if ($data['assessment_date'])
            $data['assessment_date'] = convert_to_iso_datetime($data['assessment_date']);

        if (!post('has_parked', 0))
            $data['parking_fee'] = 0;
        elseif ($data['parking_fee'] > 1000)
            $data['parking_fee'] = $data['parking_fee'] / 1000;

        // Calculate the KPI
        $data['kpi'] = $this->Assessment->calculate_kpi($data);
        $this->_beginTransaction();
        if (!$assessment_id) {
            $existed = $this->Assessment->select(array('assessment_date' => $data['assessment_date'], 'user_id' => $data['user_id']));
            if (!$existed) {
                //Insert assessment
                $data['created_dtm'] = date('Y-m-d H:i:s');
                $data['created_by'] = Users::get_userdata('user_id');
                $data['ip_address'] = get_user_ip();
                $success = $this->Assessment->insert($data);
                if (!$success)
                    if ($is_ajax)
                        $this->_error('Không thể lưu bảng đánh giá!! Vui lòng thử lại.');
                    else
                        $this->_set_last_error('Không thể lưu bảng đánh giá!! Vui lòng thử lại.', $data);
                if ($is_ajax)
                    $this->_ok('Đánh giá đã được lưu.');
                else
                    $this->_set_last_message('Đánh giá đã được lưu.');
            } else {
                if ($is_ajax)
                    $this->_error('Đã đánh giá cho ngày ' . date('d/m/Y', strtotime($data['assessment_date'])) . '!!');
                else
                    $this->_set_last_error('Đã đánh giá cho ngày này!!', $data);
            }
            redirect('danh-gia');
        } else {
            $existed = $this->Assessment->get_details($assessment_id);
            if (!$existed) {
                if ($is_ajax)
                    $this->_error('Bảng đánh giá không hợp lệ. Vui lòng thử lại!');
                else
                    $this->_set_last_error('Bảng đánh giá không hợp lệ. Vui lòng thử lại!', $data);
            }

            unset($data['assessment_date']);
            $success = $this->Assessment->update($assessment_id, $data);

            if (!$success) {
                if ($is_ajax)
                    $this->_error('Không thể lưu bảng đánh giá!! Vui lòng thử lại.');
                else
                    $this->_set_last_error('Không thể lưu bảng đánh giá!! Vui lòng thử lại.', $data);
            }
            if ($is_ajax)
                $this->_ok('Đánh giá đã được lưu.');
            else
                $this->_set_last_message('Đánh giá đã được lưu.');
            redirect('quan-ly-danh-gia');
        }
    }

    function admin_search_shipping()
    {
        $filter_arr = array();
        if (Users::is_member()) {
            $filter_month = post('filter_month');
            if (date('m') == 1 && $filter_month == 12)
                $filter_arr = array('where' => "MONTH(date_time) = '12' AND YEAR(date_time) = '" . (date('Y') - 1) . "'");
            else
                $filter_arr = array('where' => "MONTH(date_time) = '$filter_month' AND YEAR(date_time) = '" . date('Y') . "'");
            $filter_arr['users.user_id'] = Users::get_userdata('user_id');
        } else {
            $filter_month = post('filter_month');
            $filter_year = post('filter_year');
            $filter_member = post('filter_member');

            if ($filter_month && $filter_year) {
                $filter_arr = array('where' => "MONTH(date_time) = '$filter_month' AND YEAR(date_time) = '$filter_year'");
            } elseif ($filter_month) {
                $filter_arr = array('where' => "MONTH(date_time) = '$filter_month'");
            } elseif ($filter_year) {
                $filter_arr = array('where' => "YEAR(date_time) = '$filter_year'");
            }

            if ($filter_member && is_numeric($filter_member))
                $filter_arr['users.user_id'] = $filter_member;
        }

        $this->data['shipping_details'] = $this->Shippingdetails->get_list($filter_arr);
        $this->return['html'] = $this->load_view('shipping/list', 1);
        $this->_ok();
    }

    function admin_shipping_statistics_filter()
    {
        $start_date = post('filter_start_date');
        $end_date = post('filter_end_date');
        $member_id = post('filter_member');
        if ($start_date)
            $start_date = convert_to_iso_datetime($start_date);
        if ($end_date)
            $end_date = convert_to_iso_datetime($end_date);
        $this->data['statistics_data'] = $this->Shippingdetails->get_statistics_data(compact('start_date', 'end_date', 'member_id'));
        $this->return['html'] = $this->load_view('shipping/statistics_list', 1);
        $this->_ok();
    }

    function create_shipping_record()
    {
        $this->_beginTransaction();
        $fields = array('user_id', 'customer_id', 'distance', 'number_of_dishes', 'total', 'description', 'date_time', 'branch_id');
        $required_fields = array('user_id', 'distance', 'number_of_dishes', 'total', 'date_time');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $customer_data = array();
        $customer_data['lat'] = post('lat');
        $customer_data['lng'] = post('lng');
        $customer_data['distance'] = post('distance');

        $customer_name = post('customer');
        $address = capitalize(post('address'));
        if ($customer_name)
            $customer_data['customer_name'] = capitalize($customer_name);
        else
            $customer_data['customer_name'] = customer_name_from_address($address);
        $customer_data['type_id'] = post('customer_type_id');

        if (empty($data['customer_id'])) {
            $customer_data['mobile'] = post('mobile');
            if (strpos($customer_data['mobile'], '0') !== 0)
                $customer_data['mobile'] = '0' . $customer_data['mobile'];

            if (intval($customer_data['mobile']) == 0)
                $customer_data['mobile'] = 0;

            /*    
            if ($customer_data['mobile'] != 0)
            {
                $customer_existed = select("customers", array('mobile'=>$customer_data['mobile']));
                if($customer_existed)
                    error('Số điện thoại đã được sử dụng. Vui lòng chọn khách hàng trong danh sách!!');
            }
            */

            if ($customer_data['mobile'] != 0) {
                //Create new customer
                $customer_data['address'] = $address;
                $customer_data['district'] = post('district');
                //$customer_data['total_paid'] = $data['total'];
                $customer_data['modified_by'] = Users::get_userdata('user_id');
                $customer_data['created_dtm'] = date('Y-m-d H:i:s');;

                if (!$customer_data['lat'] || !$customer_data['lng']) {
                    $geo = get_geo($customer_data['address'] . ' Quận ' . $customer_data['district']);

                    if (!$geo) {
                        $geo = get_geo($customer_data['address'] . ' Hồ Chí Minh');
                        if ($geo) {
                            $county = $geo->getCounty();
                            $county = str_replace('Quận', '', $county);
                            $county = str_replace('District', '', $county);
                            $customer_data['district'] = trim($county);
                        }
                    }
                    if ($geo) {
                        $customer_data['lat'] = $geo->getLatitude();
                        $customer_data['lng'] = $geo->getLongitude();
                    }
                }

                $return['lat'] = isset($customer_data['lat']) ? $customer_data['lat'] : '';
                $return['lng'] = isset($customer_data['lng']) ? $customer_data['lng'] : '';
                $data['customer_id'] = $this->Customers->insert($customer_data);
                if (!$data['customer_id'])
                    $this->_error('Không thể tạo khách hàng mới. Vui lòng liên hệ admin!!');
            } else {
                $data['customer_id'] = 0;
                $data['description'] = '[LH] ' . $customer_name . ' - ' . $address . ', quận ' . post('district');
                if (post('description'))
                    $data['description'] .= ' - ' . post('description');
            }
        } else {
            $existed_customer = $this->Customers->get_details($data['customer_id']);
            if ($existed_customer) {
                //Update existed customer
                if ($existed_customer['is_locked']) {
                    //Lat/Lng is locked, cannot update
                    unset($customer_data['lat']);
                    unset($customer_data['lng']);
                }
                //$customer_data['total_paid'] = $existed_customer['total_paid'] + $data['total'];
                $customer_data['district'] = post('h_district');
                if ($address != $existed_customer['address']) {
                    $customer_data['description'] = $existed_customer['description'] . "\n" . $existed_customer['address'];
                    $customer_data['address'] = $address;
                }

                $customer_data['modified_by'] = Users::get_userdata('user_id');
                $this->Customers->update($data['customer_id'], $customer_data);
            } else
                $this->_error('Thông tin khách hàng không chính xác. Vui lòng kiểm tra lại!!');
        }

        if ($data['date_time'])
            $data['date_time'] = convert_to_iso_datetime($data['date_time']);

        if ($data['date_time'])
            $data['date_time'] .= ' ' . date('H:i:s');
        else
            $data['date_time'] = date('Y-m-d H:i:s');;
        $data['created_dtm'] = date('Y-m-d H:i:s');;
        $data['created_by'] = $this->logged_user['user_id'];
        $data['ip_address'] = get_user_ip();
        $order_id = post('order_id');
        if ($order_id) {
            $where_arr = array();
            $where_arr['order_id'] = $order_id;
            $where_arr['user_id'] = $data['user_id'];
            $existed_shipping = $this->Shippingdetails->select_one($where_arr);
            if ($existed_shipping)
                $this->_error('Bạn đã nhập thông tin giao hàng cho đơn hàng này rồi!!');
            $data['order_id'] = $order_id;
        }

        $success = $this->Shippingdetails->insert($data);
        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu thông tin giao hàng!!');

        if (!empty($existed_customer)) {
            $where_arr = array();
            $where_arr['id'] = $order_id;
            $where_arr['deleted'] = 0;
            $where_arr['where'] = "DATE(delivery_date) = DATE('" . $data['date_time'] . "')";
            $order = $this->Orders->select_one($where_arr);
            if ($order)
                $this->Orders->update($order['id'], array('is_shipped' => $order['is_shipped'] + 1, 'status' => 'Completed'));
            else
                $this->_error('Không tìm thấy đơn hàng cho ngày đã chọn!!');
        }
        $this->_ok();
    }

    function admin_update_category()
    {
        $action_type = post('action_type');
        $category_id = post('category_id');
        if (!empty($_FILES['files'])) {
            $category_exists = $this->Categories->get_details($category_id);
            if (!$category_exists)
                $this->_error('Mã nhóm hàng không chính xác. Vui lòng liên hệ quản trị!!');


            require_once(ABSOLUTE_PATH . 'includes/jqueryfileupload/UploadHandler.php');
            $upload_handler = new UploadHandler(
                array(
                    'upload_dir' => get_upload_path(),
                    'upload_url' => get_upload_url(),
                    'print_response' => false
                )
            );
            $response = $upload_handler->get_response();
            if (!empty($response['files']) && is_array($response['files'])) {
                foreach ($response['files'] as $index => $uploaded_file) {
                    $image_id = $this->Files->insert(array(
                        'type' => 'category_image',
                        'filename' => $uploaded_file->name,
                        'path' => str_replace(ROOT_URL, '', $uploaded_file->url),
                        'foreign_id' => $category_id,
                        'created_by' => $this->logged_user['user_id'],
                        'created_dtm' => date('Y-m-d H:i:s')
                    ));
                    $response['files'][$index]->image_id = $image_id;
                }
            }
            echo json_encode($response);
        } elseif ($action_type == 'remove_category_image') {
            $image_id = post('image_id');
            if (empty($image_id) || !is_numeric($image_id))
                $this->_error('Mã hình ảnh không đúng. Vui lòng tải lại trang!!');

            $image_data = $this->Files->get_details($image_id);
            if (!$image_data)
                $this->_error('Mã hình ảnh không đúng. Vui lòng tải lại trang!!');

            require_once(ABSOLUTE_PATH . 'includes/jqueryfileupload/UploadHandler.php');
            $upload_handler = new UploadHandler(array(), false);

            $file_path = get_image_path($image_data);
            $success = is_file($file_path) && unlink($file_path);
            if ($success) {
                $this->_beginTransaction();
                $this->Files->delete($image_id);
                foreach ($upload_handler->get_image_versions() as $version => $options) {
                    if (!empty($version)) {
                        $file = get_image_path($image_data, $version);
                        if (is_file($file))
                            unlink($file);
                    }
                }
            }
            if (!$success)
                $this->_error('Không tìm thấy ảnh!!');
            $this->_ok();
        } else {
            $this->_beginTransaction();
            $fields = array('name', 'description', 'parent_id', 'enabled', 'sequence_number', 'allow_delivery', 'english_name', 'image');
            $required_fields = array('name', 'english_name');
            $data = array();
            foreach ($fields as $f) {
                $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
                if (in_array($f, $required_fields) && empty($data[$f]))
                    $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
            }
            if (empty($data['name']))
                $this->_error('Tên nhóm hàng không thể trống. Vui lòng nhập lại!!');

            $category_id = post('category_id');
            if ($category_id) {
                $success = $this->Categories->update($category_id, $data);
            } else {
                $category_exists = $this->Categories->select(array('name' => $data['name']));
                if (!$category_exists) {
                    $data['name_without_utf8'] = remove_unicode($data['name']);
                    $data['code'] = get_code($data['name_without_utf8']);
                    $data['created_dtm'] = date('Y-m-d H:i:s');;
                    $success = $this->Categories->insert($data);
                } else
                    $this->_error('Tên nhóm hàng đã được sử dụng. Vui lòng nhập tên khác!!');
            }

            if (!$success)
                $this->_error('Có lỗi xảy ra. Không thể lưu!!');
            $this->_ok();
        }
    }

    function admin_search_product()
    {
        $filter_category = post('filter_category');
        $filter_type = post('filter_type');
        $filter_arr = array();
        if ($filter_category)
            $filter_arr['products.category_id'] = $filter_category;
        if ($filter_type) {
            if ($filter_type == 1) // Main products
                $filter_arr['products.is_additional'] = "0";
            elseif ($filter_type == 2) // Additional products
                $filter_arr['products.is_additional'] = "1";
        }
        $this->data['products'] = $this->Products->get_list($filter_arr, -1);
        $this->return['html'] = $this->load_view('product/list', 1);
        $this->_ok();
    }

    /**Search products for the block home page */
    function admin_search_product_blockhomepage()
    {
        $filter_category = post('filter_category');
        $filter_type = post('filter_type');
        $filter_arr = array();
        if ($filter_category)
            $filter_arr['products.category_id'] = $filter_category;
        if ($filter_type) {
            if ($filter_type == 1) // Main products
                $filter_arr['products.is_additional'] = "0";
            elseif ($filter_type == 2) // Additional products
                $filter_arr['products.is_additional'] = "1";
        }
        $this->data['products'] = $this->Products->get_list($filter_arr, -1);
        $this->return['html'] = $this->load_view('block_homepage/tabledata_search/list_product', 1);
        $this->_ok();
    }

    function admin_update_product()
    {
        $action_type = post('action_type');
        $product_id = post('product_id');
        if (!empty($_FILES['files'])) {
            $product_exists = $this->Products->get_details($product_id);
            if (!$product_exists)
                $this->_error('Mã hàng hóa không chính xác. Vui lòng liên hệ quản trị!!');


            require_once(ABSOLUTE_PATH . 'includes/jqueryfileupload/UploadHandler.php');
            $upload_handler = new UploadHandler(
                array(
                    'upload_dir' => get_upload_path(),
                    'upload_url' => get_upload_url(),
                    'print_response' => false
                )
            );
            $response = $upload_handler->get_response();
            if (!empty($response['files']) && is_array($response['files'])) {
                foreach ($response['files'] as $index => $uploaded_file) {
                    $image_id = $this->Files->insert(array(
                        'type' => 'product_image',
                        'filename' => $uploaded_file->name,
                        'path' => str_replace(ROOT_URL, '', $uploaded_file->url),
                        'foreign_id' => $product_id,
                        'created_by' => $this->logged_user['user_id'],
                        'created_dtm' => date('Y-m-d H:i:s')
                    ));
                    $response['files'][$index]->image_id = $image_id;
                }
            }
            echo json_encode($response);
        } elseif ($action_type == 'remove_product_image') {
            $image_id = post('image_id');
            if (empty($image_id) || !is_numeric($image_id))
                $this->_error('Mã hình ảnh không đúng. Vui lòng tải lại trang!!');

            $image_data = $this->Files->get_details($image_id);
            if (!$image_data)
                $this->_error('Mã hình ảnh không đúng. Vui lòng tải lại trang!!');

            require_once(ABSOLUTE_PATH . 'includes/jqueryfileupload/UploadHandler.php');
            $upload_handler = new UploadHandler(array(), false);

            $file_path = get_image_path($image_data);
            $success = is_file($file_path) && unlink($file_path);
            if ($success) {
                $this->_beginTransaction();
                $this->Files->delete($image_id);
                foreach ($upload_handler->get_image_versions() as $version => $options) {
                    if (!empty($version)) {
                        $file = get_image_path($image_data, $version);
                        if (is_file($file))
                            unlink($file);
                    }
                }
            }
            if (!$success)
                $this->_error('Không tìm thấy ảnh!!');
            $this->_ok();
        } else {
            $this->_beginTransaction();
            $fields = array(
                'name', 'code', 'description', 'description_en', 'unit', 'category_id',
                'enabled', 'free_choice', 'sequence_number', 'is_hidden', 'english_name', 'image', 'image_sub1', 'image_sub2',
                'is_additional', 'is_box', 'box_discount_rate', 'can_be_added_to_box', 'base_price', 'promotion_price', 'type', 'not_deliver', 'show_components_on_frontend',
                'ribbon_left', 'ribbon_left_color', 'ribbon_right', 'ribbon_right_color'
            );
            $required_fields = array('name', 'english_name');
            $data = array();
            foreach ($fields as $f) {
                $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
                if (in_array($f, $required_fields) && empty($data[$f]))
                    $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
                if (in_array($f, $this->price_fields) && $data[$f] == '') {
                    $data[$f] = 0;
                }
                if ($f == 'type' && $data[$f] == '')
                    unset($data[$f]);
            }
            if (empty($data['name']))
                $this->_error('Tên hàng hóa không thể trống. Vui lòng nhập lại!!');
            elseif (empty($data['category_id']))
                $this->_error('Nhóm hàng hóa không thể trống. Vui lòng nhập lại!!');

            if (empty($data['ribbon_left'])) {
                $data['ribbon_left'] = $data['ribbon_left_color'] = null;
            }
            if (empty($data['ribbon_right'])) {
                $data['ribbon_right'] = $data['ribbon_right_color'] = null;
            }

            if ($product_id) {
                $product_exists = $this->Products->get_details($product_id);
                if (!$product_exists)
                    $this->_error('Mã hàng hóa không chính xác. Vui lòng liên hệ quản trị!!');
                $update_modified_time = 0;
                if ($product_exists['category_id'] == $data['category_id']) {
                    //If same category, update additional products
                    if ($data['is_additional']) {
                        $belongs_to = substr($product_exists['belongs_to'], 1, strlen($product_exists['belongs_to']) - 1);
                        $ids = array_filter(explode(',', $belongs_to));
                        if (!empty($ids))
                            $this->Products->update(array('where' => 'products.product_id IN (' . implode(',', $ids) . ')'), array('modified_dtm' => date('Y-m-d H:i:s')));
                    } else {
                        $options = $this->Products->get_list(array('products.is_additional' => "1", 'products.category_id' => $data['category_id']));
                        if ($options) {
                            foreach ($options as $item) {
                                if (post('add_' . $item['product_id'])) {
                                    if (!strstr($item['belongs_to'], ",$product_id,")) {
                                        $belongs_to = $item['belongs_to'] ? $item['belongs_to'] . "$product_id," : $item['belongs_to'] . ",$product_id,";
                                        $this->Products->update($item['product_id'], array('belongs_to' => $belongs_to));
                                        $update_modified_time = 1;
                                    }
                                } else {
                                    if (strstr($item['belongs_to'], ",$product_id,")) {
                                        $item['belongs_to'] = str_replace("$product_id,", '', $item['belongs_to']);
                                        if ($item['belongs_to'] == ',')
                                            $item['belongs_to'] = '';
                                        $this->Products->update($item['product_id'], array('belongs_to' => $item['belongs_to']));
                                        $update_modified_time = 1;
                                    }
                                }
                            }
                        }
                    }
                }
                $success = $this->Products->update($product_id, $data);

                $ids = post('item_id');
                if (!empty($ids)) {
                    $quantity = post('item_amount');
                    $active = post('item_active');
                    $important = post('item_important');
                    $number_of_rows = count($ids);
                    $valid_ids = array();
                    for ($i = 0; $i < $number_of_rows; $i++) {
                        $item_id = $ids[$i];
                        if (empty($item_id))
                            continue;
                        if (!is_numeric($quantity[$i]) || $quantity[$i] <= 0)
                            $quantity[$i] = 1;

                        if (empty($item_id)) {
                            $this->_error("Mã hàng hóa không xác định ở thành phần " . ($i + 1) . ". Vui lòng kiểm tra lại.");
                        } else {
                            $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                            if (!$existed_item) {
                                $this->_error("Mã hàng hóa không xác định ở thành phần " . ($i + 1) . ". Vui lòng kiểm tra lại.");
                            }
                        }

                        $component = $this->ProductComponents->select_one(array('product_id' => $product_id, 'item_id' => $item_id));
                        if ($component) {
                            //Updating component record
                            $this->ProductComponents->update(array(
                                'product_id' => $product_id,
                                'item_id' => $item_id
                            ), array(
                                'amount' => $quantity[$i],
                                'active' => $active[$i],
                                'important' => $important[$i]
                            ));
                        } else {
                            //Adding component record
                            $this->ProductComponents->insert(array(
                                'product_id' => $product_id,
                                'item_id' => $item_id,
                                'amount' => $quantity[$i],
                                'active' => $active[$i],
                                'important' => $important[$i],
                                'created_dtm' => date('Y-m-d H:i:s')
                            ));
                        }
                        $valid_ids[] = $item_id;
                    }
                    /* Remove components */
                    if (!empty($valid_ids))
                        $this->ProductComponents->delete_components(array(
                            'product_id' => $product_id,
                            'where' => 'item_id NOT IN(' . implode(',', $valid_ids) . ')'
                        ));

                    $this->Products->update($product_id, array('modified_dtm' => date('Y-m-d H:i:s')));
                }

                $box_item_ids = post('box_item_id');
                if (!empty($box_item_ids)) {
                    $box_item_quantity = post('box_item_amount');
                    $number_of_rows = count($box_item_ids);
                    $valid_ids = array();
                    for ($i = 0; $i < $number_of_rows; $i++) {
                        $box_item_id = $box_item_ids[$i];
                        if (empty($box_item_id))
                            continue;
                        if (!is_numeric($box_item_quantity[$i]) || $box_item_quantity[$i] <= 0)
                            $box_item_quantity[$i] = 1;

                        if (empty($box_item_id)) {
                            $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng kiểm tra lại.");
                        } else {
                            $existed_box_item = $this->Products->get_details($box_item_id);
                            if (!$existed_box_item) {
                                $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng kiểm tra lại.");
                            }
                        }

                        $box_item = $this->ProductsInBoxes->select_one(array('box_id' => $product_id, 'item_id' => $box_item_id));
                        if ($box_item) {
                            //Updating component record
                            $this->ProductsInBoxes->update(array(
                                'box_id' => $product_id,
                                'item_id' => $box_item_id
                            ), array(
                                'amount' => $box_item_quantity[$i]
                            ));
                        } else {
                            //Adding component record
                            $this->ProductsInBoxes->insert(array(
                                'box_id' => $product_id,
                                'item_id' => $box_item_id,
                                'amount' => $box_item_quantity[$i],
                                'created_dtm' => date('Y-m-d H:i:s')
                            ));
                        }
                        $valid_ids[] = $box_item_id;
                    }
                    /* Remove box items */
                    if (!empty($valid_ids))
                        $this->ProductsInBoxes->delete_products(array(
                            'box_id' => $product_id,
                            'where' => 'item_id NOT IN(' . implode(',', $valid_ids) . ')'
                        ));

                    $this->Products->update($product_id, array('modified_dtm' => date('Y-m-d H:i:s')));
                }
            } else {
                $product_exists = $this->Products->select(array('name' => $data['name'], 'category_id' => $data['category_id']));
                if (!$product_exists) {
                    $data['name_without_utf8'] = remove_unicode($data['name']);
                    if (empty($data['code']))
                        $data['code'] = get_code($data['name_without_utf8']);
                    $data['created_dtm'] = date('Y-m-d H:i:s');;
                    $product_id = $success = $this->Products->insert($data);
                    $is_new = 1;
                } else
                    $this->_error('Tên hàng hóa đã được sử dụng. Vui lòng nhập tên khác!!');
            }

            if (!$success) {
                $this->return['data'] = $data;
                $this->return['last_query'] = get_last_query();
                $this->_error('Có lỗi xảy ra. Không thể lưu!!');
            }
            if (post('sell_price')) {
                $this->_admin_update_single_price($product_id, post('sell_price'));
            }
            if (!empty($is_new))
                $this->return['redirect_url'] = BASE_URL . 'hang-hoa/' . $product_id;
            $this->_ok();
        }
    }

    function admin_search_price()
    {
        $filter_category = post('filter_category');
        $filter_arr = array();
        if ($filter_category)
            $filter_arr['products.category_id'] = $filter_category;
        $this->data['products'] = $this->Products->get_list($filter_arr, -1);
        $this->data['prices'] = $this->Prices->get_array($filter_arr);
        $this->data['price_types'] = $this->Prices->get_price_types();
        $this->return['html'] = $this->load_view('price/list', 1);
        $this->_ok();
    }

    function admin_search_orders()
    {
        $filter_type = post('filter_type');
        $filter_branch = post('filter_branch');
        $filter_shift = post('filter_shift');
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $filter_vat = post('filter_vat');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if (Users::is_shift_leader() && !Users::can('filter', 'order')) {
            $filter_start_date = $filter_end_date = date('Y-m-d');
            if ($this->logged_user['type_id'] == SHIFT_LEADER_1_TYPE_ID)
                $filter_shift = 1;
            elseif ($this->logged_user['type_id'] == SHIFT_LEADER_2_TYPE_ID)
                $filter_shift = 2;
        }
        $where_str = '';
        $start_h = '00:00:00';
        $end_h = '23:59:59';
        if ($filter_shift) {
            if ($filter_shift == 1) {
                $end_h = SHIFT_SEPARATOR_TIME . ':00';
            } else if ($filter_shift == 2) {
                $start_h = SHIFT_SEPARATOR_TIME . ':01';
            }
        }

        if ($filter_start_date && $filter_end_date)
            $where_str = "(orders.delivery_date BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59') AND (DATE_FORMAT(orders.delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
        else if ($filter_start_date)
            $where_str = "(orders.delivery_date >= '$filter_start_date' AND (DATE_FORMAT(orders.delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
        else if ($filter_end_date)
            $where_str = "(orders.delivery_date <= '$filter_end_date 23:59:59' AND (DATE_FORMAT(orders.delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";


        $filter_arr = array();
        if ($filter_vat == 1)
            $where_str .= ($where_str ? ' AND ' : '') . ' orders.VAT > 0';
        elseif ($filter_vat === '0')
            $where_str .= ($where_str ? ' AND ' : '') . ' (orders.VAT = 0 OR orders.VAT IS NULL)';
        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_type)
            $filter_arr['orders.type_id'] = $filter_type;
        if (Users::can('view_all', 'order')) {
            if ($filter_branch)
                $filter_arr['orders.branch_id'] = $filter_branch;
        } else
            $filter_arr['orders.branch_id'] = $this->logged_user['branch_id'];
        $this->data['orders'] = $this->Orders->get_list($filter_arr, 'orders.delivery_date DESC');
        $this->return['query'] = get_last_query();
        $this->return['html'] = $this->load_view('order/list', 1);
        $this->_ok();
    }

    function admin_reload_processing_orders()
    {
        $last_update = post('last_update');
        $new_online_order = null;
        if (empty($last_update))
            $last_update = date('Y-m-d') . ' 00:00:00';
        else
            $new_online_order = $this->Orders->get_list(array('where' => "(DATE(orders.delivery_date) = '" . date('Y-m-d') . "' OR DATE(orders.delivery_date) = '" . date('Y-m-d', strtotime('+1 day')) . "') AND orders.code LIKE 'e%' AND orders.created_dtm >= '$last_update'"), 'orders.created_dtm DESC');
        $now = date('Y-m-d H:i:s');
        $has_update = $this->Orders->get_list(array('where' => "(DATE(orders.delivery_date) = '" . date('Y-m-d') . "' OR DATE(orders.delivery_date) = '" . date('Y-m-d', strtotime('+1 day')) . "' OR DATE(orders.delivery_date) = '" . date('Y-m-d', strtotime('-1 day')) . "') AND orders.modified_dtm >= '$last_update'"), 'orders.delivery_date ASC');
        $this->return['last_update'] = $now;
        $branches = $this->Branches->get_list();
        $notes = $html_notes = array();
        foreach ($branches as $index => $b) {
            $notes[$b['id']] = $b['note_on_processing_screen'];
            $html_notes[$b['id']] = nl2br($b['note_on_processing_screen']);
        }

        $this->return['make_a_ding'] = 0;
        if ($new_online_order)
            $make_a_ding = 1;
        else
            $make_a_ding = post('make_a_ding');
        $dtm = time();
        if ($make_a_ding) {
            set_setting('ding_time', $dtm + 30);
        } else {
            $make_a_ding = get_setting('ding_time');
            if ($make_a_ding > $dtm && $make_a_ding <= $dtm + 30)
                $this->return['make_a_ding'] = 1;
        }

        $this->return['notes'] = $notes;
        $this->return['html_notes'] = $html_notes;
        if ($has_update) {
            $conditions = array('where' => "(DATE(orders.delivery_date) = '" . date('Y-m-d') . "' OR DATE(orders.delivery_date) = '" . date('Y-m-d', strtotime('+1 day')) . "' OR DATE(orders.delivery_date) = '" . date('Y-m-d', strtotime('-1 day')) . "') AND status NOT IN ('Completed', 'Failed')");
            /*
	        if (!Users::can('view_all', 'order'))
                $conditions['orders.branch_id'] = $this->logged_user['branch_id'];
            */
            $this->data['orders'] = $this->Orders->get_list($conditions, 'orders.delivery_date ASC');
            $this->data['branches'] = $this->Branches->get_list();
            $this->data['shippers'] = $this->Users->get_members(array('users.do_shipping' => 1));
            $this->return['html'] = $this->load_view('order/manage_list', 1);
        } else
            $this->return['html'] = '';

        $this->_ok();
    }

    function admin_overload_in_period()
    {
        $period = post('period');
        if (!is_numeric($period))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin!!');
        set_setting('overload_in_period', $period ? date('Y-m-d H:i:s', strtotime("+$period minutes")) : 0);
        $this->_ok();
    }

    function load_orders_for_adding_shipping_record()
    {
        $date = post('date');
        if ($date)
            $isodate = convert_to_iso_datetime($date);
        if (empty($isodate))
            $this->_error('Ngày không hợp lệ.');
        $customers = $this->Orders->get_customers(array('where' => "orders.`status` != 'Failed' AND DATE(orders.delivery_date) = '$isodate'", 'is_shipped' => 0), 'orders.delivery_date DESC');
        if (!$customers)
            $this->_error("Không có hóa đơn giao hàng trống trong ngày $date.");
        $cus_arr = array();
        foreach ($customers as $item) {
            $customer_name = $item['customer_name'];
            $address = $item['address'];
            $district = $item['district'];
            $distance = $item['distance'];
            $lat = $item['lat'];
            $lng = $item['lng'];
            $shipping_info = json_decode($item['shipping_info']);
            if ($shipping_info) {
                $lat = getValue($shipping_info, 'lat', '');
                $lng = getValue($shipping_info, 'lng', '');
                if ($shipping_info->address != $address) {
                    $address = $shipping_info->address;
                    $distance = getValue($shipping_info, 'distance', '');
                }
                if ($shipping_info->district != $district) {
                    $district = $shipping_info->district;
                    $distance = getValue($shipping_info, 'distance', '');
                }
                if ($shipping_info->fullname != $customer_name)
                    $customer_name = $shipping_info->fullname;
            }

            $cus_arr[$item['order_id']] = array(
                'branch_id' => $item['branch_id'],
                'mobile' => $item['mobile'],
                'address' => $address,
                'district' => $district,
                'customer_name' => $customer_name,
                'customer_id' => $item['customer_id'],
                'distance' => $distance,
                'lat' => $lat,
                'lng' => $lng,
                'type_id' => $item['type_id'],
                'is_locked' => $item['is_locked'],
                'number_of_dishes' => $item['quantity'],
                'total' => $item['total']
            );
        }
        $this->return['customers'] = $cus_arr;
        $this->_ok();
    }

    private function __get_statistic_data()
    {
        $filter_start_date = urldecode(post('filter_start_date'));
        $filter_end_date = urldecode(post('filter_end_date'));
        $filter_category = post('filter_category');
        $filter_shift = post('filter_shift');
        $filter_branch = post('filter_branch');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        $where_str = '';
        $start_h = '00:00:00';
        $end_h = '23:59:59';
        if ($filter_shift) {
            if ($filter_shift == 1) {
                $end_h = SHIFT_SEPARATOR_TIME . ':00';
            } else if ($filter_shift == 2) {
                $start_h = SHIFT_SEPARATOR_TIME . ':01';
            }
        }

        if ($filter_start_date && $filter_end_date)
            $where_str = "(orders.delivery_date BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59') AND (DATE_FORMAT(orders.delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
        else if ($filter_start_date)
            $where_str = "orders.delivery_date >= '$filter_start_date' AND (DATE_FORMAT(orders.delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
        else if ($filter_end_date)
            $where_str = "orders.delivery_date <= '$filter_end_date 23:59:59' AND (DATE_FORMAT(orders.delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";

        $filter_arr = array();
        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_category)
            $filter_arr['products.category_id'] = $filter_category;
        if ($filter_branch)
            $filter_arr['orders.branch_id'] = $filter_branch;
        $this->data['statistics_data'] = $this->Orders->get_statistics_data($filter_arr);
        $this->data['order_types'] = $this->Orders->get_order_types(array('show_in_statistics' => 1));
        $this->data['sum_of_foody_quantities'] = Orders::get_total_quatity_of_foody($where_str ? array('where' => $where_str) : array());
    }

    function admin_statistics_filter()
    {
        $this->__get_statistic_data();
        $this->return['html'] = $this->load_view('statistics/list', 1);
        $this->_ok();
    }

    function admin_export_statistic_data()
    {
        $this->__get_statistic_data();
        $statistics_data = $this->data['statistics_data'];
        $checking = post('checking');
        if ($checking) {
            if (!empty($statistics_data))
                $this->_ok();
            else
                $this->_error('Không có dữ liệu phù hợp với điều kiện.');
        } else {
            if (!empty($statistics_data)) {
                $order_types = $this->data['order_types'];
                $quantities = getvalue($statistics_data, 'sold_quantities');
                $totals_quantities = array();
                $total_quantity = array();

                $columns = $this->columns;
                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();
                // Set document properties
                $objPHPExcel->getProperties()->setCreator(get_setting('site_name') . " Manager")
                    ->setLastModifiedBy(get_setting('site_name') . " Manager")
                    ->setTitle("Office 2007 XLSX Customer Export Document")
                    ->setSubject("Office 2007 XLSX Customer Export Document")
                    ->setDescription("Customer export document for Office 2007 XLSX, generated using PHP classes at " . DOMAIN_NAME . ".")
                    ->setKeywords("office 2007 openxml php customer export")
                    ->setCategory("Sold report");

                $header_text = array('Nhóm', 'Tên');
                foreach ($order_types as $type) {
                    $totals_quantities[$type['id']] = 0;
                    $header_text[] = $type['type_name'];
                }
                $header_text[] = 'Tổng';

                $number_of_columns = count($header_text);
                for ($col_index = 1; $col_index <= $number_of_columns; $col_index++)
                    $objPHPExcel->getActiveSheet()->getColumnDimension($columns[$col_index])->setAutoSize(true);

                $col_index = 1;
                foreach ($header_text as $header) {
                    $objPHPExcel->getActiveSheet()->getStyle($columns[$col_index] . '1')->getFont()->setBold(true);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . '1', $header);
                }

                $row_index = 2;
                if ($quantities) {
                    $cat_name = null;
                    $total_sold_in_cat = 0;
                    foreach ($quantities as $key => $item) {
                        $total_quantity[$key] = 0;
                        $showing_cat_name = '';
                        $names = explode('|', $key);

                        if ($cat_name != $names[0]) {
                            /* Start to write item for new category */
                            if ($cat_name !== null) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $row_index, 'Tổng trong nhóm');
                                $objPHPExcel->getActiveSheet()->getStyle('A' . $row_index)->getFont()->setBold(true);
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index - 1] . $row_index, $total_sold_in_cat);
                                $objPHPExcel->getActiveSheet()->getStyle($columns[$col_index - 1] . $row_index)->getFont()->setBold(true);
                                $row_index += 2;
                                $total_sold_in_cat = 0;
                            }
                            $cat_name = $showing_cat_name = $names[0];
                        }

                        $col_index = 1;
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $showing_cat_name);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $names[1]);
                        foreach ($order_types as $type) {
                            $quantity = !empty($item[$type['id']]) ? $item[$type['id']] : 0;
                            $totals_quantities[$type['id']] += $quantity;
                            $total_quantity[$key] += $quantity;
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index, $quantity);
                        }
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++] . $row_index++, $total_quantity[$key]);
                        $total_sold_in_cat += $total_quantity[$key];
                    }
                    if ($total_sold_in_cat) {
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $row_index, 'Tổng trong nhóm');
                        $objPHPExcel->getActiveSheet()->getStyle('A' . $row_index)->getFont()->setBold(true);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index - 1] . $row_index, $total_sold_in_cat);
                        $objPHPExcel->getActiveSheet()->getStyle($columns[$col_index - 1] . $row_index)->getFont()->setBold(true);
                    }
                }
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Số lượng bán hàng - ' . date('Ymd'));


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $filename = "soluongban_" . date('Ymd');
                $this->_export($objPHPExcel, $filename);
            }
        }
        exit;
    }

    function admin_search_inventory()
    {
        $filter_warehouse = post('filter_warehouse');
        $filter_type_id = post('filter_type_id');
        $is_fruit = post('is_fruit');
        $filter_arr = array();
        if ($filter_warehouse)
            $filter_arr['inventory.warehouse_id'] = $filter_warehouse;
        if ($filter_type_id)
            $filter_arr['inventory_item_details.type_id'] = $filter_type_id;
        if ($is_fruit)
            $filter_arr['inventory_item_types.is_fruit'] = 1;
        else
            $filter_arr['inventory_item_types.is_fruit'] = 0;
        $this->data['inventory_records'] = $this->Inventory->get_inventory_records($filter_arr);
        $this->return['html'] = $this->load_view('inventory/list', 1);
        $this->_ok();
    }

    function admin_search_inventory_import()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $filter_member = post('filter_member');
        $filter_warehouse = post('filter_warehouse');
        $filter_provider = post('filter_provider');
        $is_fruit = post('is_fruit');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "inventory_import.import_date BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "inventory_import.import_date >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "inventory_import.import_date <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_member)
            $filter_arr['inventory_import.user_id'] = $filter_member;
        if ($filter_warehouse)
            $filter_arr['inventory_import.warehouse_id'] = $filter_warehouse;
        if ($filter_provider)
            $filter_arr['inventory_import_details.provider_id'] = $filter_provider;
        if ($is_fruit)
            $filter_arr['inventory_import.is_fruit'] = 1;
        else
            $filter_arr['inventory_import.is_fruit'] = 0;
        $this->data['is_fruit'] = $is_fruit ? 1 : 0;
        $this->data['inventory_import_details_model'] = $this->Inventoryimportdetails;
        $this->data['import_records'] = $this->Inventoryimport->get_inventory_import_records($filter_arr);
        $this->return['html'] = $this->load_view('inventory/import/list', 1);
        $this->_ok();
    }

    function admin_import_inventory()
    {
        $this->_beginTransaction();
        $fields = array('user_id', 'import_date', 'warehouse_id', 'has_invoice');
        $required_fields = array('user_id', 'import_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['import_date'] = convert_to_iso_datetime($data['import_date']);
        if ($data['import_date'])
            $data['import_date'] .= ' ' . date('H:i:s');
        else
            $data['import_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = 0;
        $data['payment_status'] = post('payment_status');
        $data['payment_date'] = post('payment_date');
        $data['payment_date'] = convert_to_iso_datetime($data['payment_date']);
        if ($data['payment_date'])
            $data['payment_date'] .= ' ' . date('H:i:s');
        else
            $data['payment_date'] = $data['created_dtm'];
        $data['cashier_id'] = post('cashier_id', null);
        $data['shipping_fee'] = post('shipping_fee', 0);
        $import_id = $this->Inventoryimport->insert($data);
        if (!$import_id)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu nhập kho!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $price = post('item_price');
        $description = post('item_description');
        $provider = post('item_provider');

        $quantity_in_details = array();
        $total = 0;
        $number_of_rows = count($ids);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]) || $quantity[$i] <= 0)
                continue;
            if (!is_numeric($price[$i]) || $price[$i] < 0)
                $this->_error("Đơn giá ở dòng " . ($i + 1) . " không chính xác!");

            if (empty($item_id)) {
                $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng liên hệ admin.");
            } else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                if (!$existed_item) {
                    $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng liên hệ admin.");
                }
                $quantity_in_details[$item_id] = $existed_item['quantity_in_details'];
            }

            //Update inventory import details
            $this->Inventoryimportdetails->insert(array(
                'import_id' => $import_id,
                'item_id' => $item_id,
                'quantity' => $quantity[$i],
                'price' => $price[$i],
                'provider_id' => !empty($provider[$i]) ? $provider[$i] : 0,
                'total' => $quantity[$i] * $price[$i],
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            $total += $quantity[$i] * $price[$i];

            //Update inventory
            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
            if ($existed_record) {
                $update_quantity = $existed_record['quantity'] + $quantity[$i];
                $update_data = array();
                if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id]) {
                    // We need to re-calculator the quantity if we update the quantity_in_details
                    $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] + $quantity_in_details[$item_id] * $quantity[$i];
                    $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                }
                $update_data['quantity'] = $update_quantity;
                $this->Inventory->update($existed_record['id'], $update_data);
            } else {
                $this->Inventory->insert(array(
                    'warehouse_id' => $data['warehouse_id'],
                    'item_id' => $item_id,
                    'quantity' => $quantity[$i],
                    'quantity_in_details' => !empty($quantity_in_details[$item_id]) ? ($quantity_in_details[$item_id] * $quantity[$i]) : null,
                    'created_dtm' => $data['created_dtm']
                ));
            }
        }
        $total += $data['shipping_fee'];
        $this->Inventoryimport->update($import_id, array('total' => $total));
        if (strstr($data['payment_status'], 'paid')) {
            $payment_type = $data['payment_status'] == 'paid_by_cash' ? 'cash' : 'bank_balance';
            $this->Costs->insert(array(
                'name' => "Chi phí phiếu nhập kho #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                'type_id' => INVENTORY_COST_TYPE_ID,
                'date_time' => $data['import_date'],
                'amount' => $total,
                'payment_type' => $payment_type,
                'user_id' => $data['user_id'],
                'import_id' => $import_id,
                'created_by' => $this->logged_user['user_id'],
                'created_dtm' => $data['created_dtm']
            ));
            subtract_balance($total, $payment_type);
        } else if ($data['payment_status'] = 'pending') {
            $this->Debts->insert(array(
                'name' => "Công nợ phiếu nhập kho #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                'type_id' => INVENTORY_DEBT_TYPE_ID,
                'payment_date' => $data['payment_date'],
                'amount' => $total,
                'user_id' => $data['user_id'],
                'import_id' => $import_id,
                'created_by' => $this->logged_user['user_id'],
                'created_dtm' => $data['created_dtm']
            ));
        }
        $this->_set_last_message('Phiếu nhập kho đã được lưu.');
        $this->_ok();
    }

    function admin_edit_import_inventory()
    {
        $this->_beginTransaction();
        $import_id = post('import_id');
        $import_record = $this->Inventoryimport->get_details($import_id);
        if (!$import_record)
            $this->_error('Mã phiếu nhập không chính xác!');

        $details = $this->Inventoryimportdetails->get_records(array('inventory_import.id' => $import_id));
        if (!$details)
            $this->_error('Mã phiếu nhập không chính xác!');

        $quantity_in_details = array();
        //Store the subtracting quantities
        $removing_quantities = array();
        $item_names = array();
        foreach ($details as $r) {
            if (empty($removing_quantities[$r['item_id']]))
                $removing_quantities[$r['item_id']] = 0;
            $removing_quantities[$r['item_id']] += $r['quantity'];
            $quantity_in_details[$r['item_id']] = $r['quantity_in_details'];
            $item_names[$r['item_id']] = $r['name'];
        }

        //Delete the import details records
        if (!$this->Inventoryimportdetails->delete_import_details(array('import_id' => $import_id)))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER aeii');


        $fields = array('user_id', 'import_date', 'warehouse_id', 'has_invoice');
        $required_fields = array('user_id', 'import_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['import_date'] = convert_to_iso_datetime($data['import_date']);
        if ($data['import_date'])
            $data['import_date'] .= ' ' . date('H:i:s');
        else
            $data['import_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = 1;
        $data['payment_status'] = post('payment_status');
        $data['payment_date'] = post('payment_date');
        $data['payment_date'] = convert_to_iso_datetime($data['payment_date']);
        if ($data['payment_date'])
            $data['payment_date'] .= ' ' . date('H:i:s');
        else
            $data['payment_date'] = $data['created_dtm'];
        $data['cashier_id'] = post('cashier_id', null);
        $data['shipping_fee'] = post('shipping_fee', 0);
        $rs = $this->Inventoryimport->update($import_id, $data);
        if (!$rs)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu nhập kho!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $price = post('item_price');
        $description = post('item_description');
        $provider = post('item_provider');

        $new_quantity = array();
        $total = 0;
        $number_of_rows = count($ids);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]) || $quantity[$i] <= 0)
                continue;
            if (!is_numeric($price[$i]) || $price[$i] < 0)
                $this->_error("Đơn giá ở dòng " . ($i + 1) . " không chính xác!");

            if (empty($item_id)) {
                $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng liên hệ admin.");
            } else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                $item_names[$item_id] = $existed_item['name'];
                if (!$existed_item) {
                    $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng liên hệ admin.");
                }
                $quantity_in_details[$item_id] = $existed_item['quantity_in_details'];
            }

            //Update inventory import details
            $this->Inventoryimportdetails->insert(array(
                'import_id' => $import_id,
                'item_id' => $item_id,
                'quantity' => $quantity[$i],
                'price' => $price[$i],
                'provider_id' => !empty($provider[$i]) ? $provider[$i] : 0,
                'total' => $quantity[$i] * $price[$i],
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            $total += $quantity[$i] * $price[$i];
            $new_quantity[$item_id] = $quantity[$i];

            if ($import_record['warehouse_id'] != $data['warehouse_id']) {
                //Update inventory
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $update_quantity = $existed_record['quantity'] + $quantity[$i];
                    $update_data = array();
                    if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id]) {
                        // We need to re-calculator the quantity if we update the quantity_in_details
                        $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] + $quantity_in_details[$item_id] * $quantity[$i];
                        $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                    }
                    $update_data['quantity'] = $update_quantity;
                    $this->Inventory->update($existed_record['id'], $update_data);
                } else {
                    $this->Inventory->insert(array(
                        'warehouse_id' => $data['warehouse_id'],
                        'item_id' => $item_id,
                        'quantity' => $quantity[$i],
                        'quantity_in_details' => !empty($quantity_in_details[$item_id]) ? ($quantity_in_details[$item_id] * $quantity[$i]) : null,
                        'created_dtm' => $data['created_dtm']
                    ));
                }
            }
        }

        //Update inventory
        if ($import_record['warehouse_id'] == $data['warehouse_id']) {
            foreach ($removing_quantities as $item_id => $quantity) {
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $import_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    if (isset($new_quantity[$item_id])) {
                        $new_q = $new_quantity[$item_id];
                        unset($new_quantity[$item_id]);
                    } else {
                        $new_q = 0;
                    }
                    $update_quantity =  $existed_record['quantity'] + $new_q - $removing_quantities[$item_id];
                    if ($update_quantity >= 0) {
                        $update_data = array();
                        if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id] > 0) {
                            // We need to re-calculator the quantity if we update the quantity_in_details
                            $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] + $quantity_in_details[$item_id] * ($new_q - $removing_quantities[$item_id]);
                            if ($update_data['quantity_in_details'] < 0)
                                $this->_error("Số lượng chi tiết của " . $item_names[$item_id] . " (ID $item_id) không hợp lệ (kho thiếu " . abs($update_data['quantity_in_details']) . ")");
                            $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                        }
                        $update_data['quantity'] = $update_quantity;
                        $this->Inventory->update($existed_record['id'], $update_data);
                    } else
                        $this->_error("Số lượng hàng hóa " . $item_names[$item_id] . " (ID $item_id) không đủ (thiếu " . abs($update_quantity) . ")");
                } else
                    $this->_error("Không tìm thấy hàng hóa " . $item_names[$item_id] . " (ID $item_id) trong kho hàng.");
            }
            if (!empty($new_quantity)) {
                foreach ($new_quantity as $item_id => $quantity) {
                    $existed_record = $this->Inventory->select_one(array('warehouse_id' => $import_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                    if ($existed_record) {
                        if ($quantity >= 0) {
                            $update_data = array();
                            $update_quantity = $quantity;
                            if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id] > 0) {
                                // We need to re-calculator the quantity if we update the quantity_in_details
                                $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] + $quantity_in_details[$item_id] * $quantity;
                                $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                            }
                            $update_data['quantity'] = $update_quantity;
                            $this->Inventory->update($existed_record['id'], $update_data);
                        } else
                            $this->_error("Số lượng hàng hóa " . $item_names[$item_id] . " (ID $item_id) không hợp lệ");
                    } else {
                        $this->Inventory->insert(array(
                            'warehouse_id' => $data['warehouse_id'],
                            'item_id' => $item_id,
                            'quantity' => $quantity,
                            'quantity_in_details' => !empty($quantity_in_details[$item_id]) ? ($quantity_in_details[$item_id] * $quantity) : null,
                            'created_dtm' => $data['created_dtm']
                        ));
                    }
                }
            }
        } else {
            foreach ($removing_quantities as $item_id => $quantity) {
                /* Subtract values in old warehouse */
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $import_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $update_quantity = $existed_record['quantity'] - $quantity;
                    if ($update_quantity >= 0) {
                        $update_data = array();
                        if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id]) {
                            // We need to re-calculator the quantity if we update the quantity_in_details
                            $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] - $quantity_in_details[$item_id] * $quantity;
                            $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                        }
                        $update_data['quantity'] = $update_quantity;
                        $this->Inventory->update($existed_record['id'], $update_data);
                    } else
                        $this->_error("Số lượng hàng hóa " . $item_names[$item_id] . " (ID $item_id) không đủ (thiếu " . abs($update_quantity) . ")");
                } else
                    $this->_error("Không tìm thấy hàng hóa " . $item_names[$item_id] . " (ID $item_id) trong kho hàng.");
            }
        }
        $total += $data['shipping_fee'];
        $this->Inventoryimport->update($import_id, array('total' => $total));
        $cost = $this->Costs->get_details_by_import_id($import_id);
        $debt = $this->Debts->get_details_by_import_id($import_id);
        if (strstr($data['payment_status'], 'paid')) {
            $payment_type = $data['payment_status'] == 'paid_by_cash' ? 'cash' : 'bank_balance';
            if ($debt)
                $this->Debts->delete($debt['id']);
            if ($cost) {
                $this->Costs->update($cost['id'], array(
                    'name' => "Chi phí phiếu nhập kho #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                    'date_time' => $data['created_dtm'],
                    'amount' => $total,
                    'user_id' => $data['user_id'],
                    'payment_type' => $payment_type
                ));
                add_balance($cost['amount'], $cost['payment_type']);
            } else {
                $this->Costs->insert(array(
                    'name' => "Chi phí phiếu nhập kho #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                    'type_id' => INVENTORY_COST_TYPE_ID,
                    'date_time' => $data['import_date'],
                    'amount' => $total,
                    'payment_type' => $payment_type,
                    'user_id' => $data['user_id'],
                    'import_id' => $import_id,
                    'created_by' => $this->logged_user['user_id'],
                    'created_dtm' => $data['created_dtm']
                ));
            }
            subtract_balance($total, $payment_type);
        } else if ($data['payment_status'] == 'pending') {
            if ($cost) {
                add_balance($cost['amount'], $cost['payment_type']);
                $this->Costs->delete($cost['id']);
            }

            if ($debt) {
                $this->Debts->update($debt['id'], array(
                    'name' => "Công nợ phiếu nhập #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                    'payment_date' => $data['payment_date'],
                    'amount' => $total,
                    'user_id' => $data['user_id']
                ));
            } else {
                $this->Debts->insert(array(
                    'name' => "Công nợ phiếu nhập kho #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                    'type_id' => INVENTORY_DEBT_TYPE_ID,
                    'payment_date' => $data['payment_date'],
                    'amount' => $total,
                    'user_id' => $data['user_id'],
                    'import_id' => $import_id,
                    'created_by' => $this->logged_user['user_id'],
                    'created_dtm' => $data['created_dtm']
                ));
            }
        }
        $this->_set_last_message('Phiếu nhập kho đã được sửa.');
        $this->_ok();
    }

    function admin_delete_import_inventory()
    {
        $this->_beginTransaction();
        $import_id = post('import_id');
        $warehouse_id = post('warehouse_id');

        $details = $this->Inventoryimportdetails->get_records(array('inventory_import.id' => $import_id));
        if (!$details)
            $this->_error('Mã phiếu nhập không chính xác!');

        //Store the subtracting quantities
        $removing_quantities = array();
        foreach ($details as $r) {
            if (empty($removing_quantities[$r['item_id']]))
                $removing_quantities[$r['item_id']] = 0;
            $removing_quantities[$r['item_id']] += $r['quantity'];
        }

        //Update inventory
        foreach ($removing_quantities as $item_id => $quantity) {
            $inventory_item = $this->Inventoryitemdetails->get_details($item_id);
            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $warehouse_id, 'item_id' => $item_id, 'deleted' => 0));
            if ($existed_record) {
                $update_quantity =  $existed_record['quantity'] - $removing_quantities[$item_id];
                if ($update_quantity >= 0) {
                    $update_data = array();
                    if (!empty($inventory_item['quantity_in_details'])) {
                        // We need to re-calculator the quantity if we update the quantity_in_details
                        $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] - $inventory_item['quantity_in_details'] * $removing_quantities[$item_id];
                        if ($update_data['quantity_in_details'] < 0)
                            $this->_error("Số lượng chi tiết của " . $inventory_item['name'] . " (ID " . $inventory_item['id'] . ") không hợp lệ (kho thiếu " . abs($update_data['quantity_in_details']) . ")");
                        $update_quantity = intval($update_data['quantity_in_details'] / $inventory_item['quantity_in_details']);
                    }
                    $update_data['quantity'] = $update_quantity;
                    $this->Inventory->update($existed_record['id'], $update_data);
                } else
                    $this->_error("Số lượng hàng hóa " . $inventory_item['name'] . " (ID " . $inventory_item['id'] . ") không đủ để hủy phiếu nhập này.");
            } else
                $this->_error("Không tìm thấy hàng hóa  " . $inventory_item['name'] . " (ID " . $inventory_item['id'] . ") trong kho hàng.");
        }

        //Delete the import details records
        if (!$this->Inventoryimportdetails->delete_import_details(array('import_id' => $import_id)))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER adiid');

        //Delete the import record
        if (!$this->Inventoryimport->delete($import_id))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER adiii');

        $this->_set_last_message("Phiếu nhập kho với ID $import_id đã được xóa.");
        $this->_ok();
    }

    function admin_import_inventory_fruits()
    {
        $this->_beginTransaction();
        $fields = array('user_id', 'import_date', 'warehouse_id', 'has_invoice');
        $required_fields = array('user_id', 'import_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['import_date'] = convert_to_iso_datetime($data['import_date']);
        if ($data['import_date'])
            $data['import_date'] .= ' ' . date('H:i:s');
        else
            $data['import_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = 1;
        $data['payment_status'] = post('payment_status');
        $data['payment_date'] = post('payment_date');
        $data['payment_date'] = convert_to_iso_datetime($data['payment_date']);
        if ($data['payment_date'])
            $data['payment_date'] .= ' ' . date('H:i:s');
        else
            $data['payment_date'] = $data['created_dtm'];
        $data['cashier_id'] = post('cashier_id', null);
        $data['shipping_fee'] = post('shipping_fee', 0);
        $import_id = $this->Inventoryimport->insert($data);
        if (!$import_id)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu nhập kho!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $price = post('item_price');
        $description = post('item_description');
        $provider = post('item_provider');

        $total = 0;
        $number_of_rows = count($ids);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]) || $quantity[$i] <= 0)
                continue;
            if (!is_numeric($price[$i]) || $price[$i] < 0)
                $this->_error("Đơn giá ở dòng " . ($i + 1) . " không chính xác!");

            if (empty($item_id)) {
                $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng liên hệ admin.");
            } else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                if (!$existed_item) {
                    $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng liên hệ admin.");
                }
            }

            //Update inventory import details
            $this->Inventoryimportdetails->insert(array(
                'import_id' => $import_id,
                'item_id' => $item_id,
                'quantity' => $quantity[$i],
                'price' => $price[$i],
                'provider_id' => !empty($provider[$i]) ? $provider[$i] : 0,
                'total' => $quantity[$i] * $price[$i],
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            $total += $quantity[$i] * $price[$i];

            //Update inventory
            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
            if ($existed_record) {
                $update_quantity = $existed_record['quantity'] + $quantity[$i];
                $update_data = array();
                $update_data['quantity'] = $update_quantity;
                $this->Inventory->update($existed_record['id'], $update_data);
            } else {
                $this->Inventory->insert(array(
                    'warehouse_id' => $data['warehouse_id'],
                    'item_id' => $item_id,
                    'quantity' => $quantity[$i],
                    'quantity_in_details' => null,
                    'created_dtm' => $data['created_dtm']
                ));
            }
        }
        $total += $data['shipping_fee'];
        $this->Inventoryimport->update($import_id, array('total' => $total));
        if (strstr($data['payment_status'], 'paid')) {
            $payment_type = $data['payment_status'] == 'paid_by_cash' ? 'cash' : 'bank_balance';
            $this->Costs->insert(array(
                'name' => "Chi phí phiếu nhập trái cây #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                'type_id' => FRUIT_COST_TYPE_ID,
                'date_time' => $data['import_date'],
                'amount' => $total,
                'payment_type' => $payment_type,
                'user_id' => $data['user_id'],
                'import_id' => $import_id,
                'created_by' => $this->logged_user['user_id'],
                'created_dtm' => $data['created_dtm']
            ));
            subtract_balance($total, $payment_type);
        } else if ($data['payment_status'] = 'pending') {
            $this->Debts->insert(array(
                'name' => "Công nợ phiếu nhập trái cây #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                'type_id' => FRUIT_DEBT_TYPE_ID,
                'payment_date' => $data['payment_date'],
                'amount' => $total,
                'user_id' => $data['user_id'],
                'import_id' => $import_id,
                'created_by' => $this->logged_user['user_id'],
                'created_dtm' => $data['created_dtm']
            ));
        }
        $this->_set_last_message('Phiếu nhập trái cây đã được lưu.');
        $this->_ok();
    }

    function admin_edit_import_inventory_fruits()
    {
        $this->_beginTransaction();
        $import_id = post('import_id');
        $import_record = $this->Inventoryimport->get_details($import_id);
        if (!$import_record)
            $this->_error('Mã phiếu nhập không chính xác!');

        $details = $this->Inventoryimportdetails->get_records(array('inventory_import.id' => $import_id));
        if (!$details)
            $this->_error('Mã phiếu nhập không chính xác!');

        //Store the subtracting quantities
        $removing_quantities = array();
        $item_names = array();
        foreach ($details as $r) {
            if (empty($removing_quantities[$r['item_id']]))
                $removing_quantities[$r['item_id']] = 0;
            $removing_quantities[$r['item_id']] += $r['quantity'];
            $item_names[$r['item_id']] = $r['name'];
        }

        //Delete the import details records
        if (!$this->Inventoryimportdetails->delete_import_details(array('import_id' => $import_id)))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER aeii');


        $fields = array('user_id', 'import_date', 'warehouse_id', 'has_invoice');
        $required_fields = array('user_id', 'import_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['import_date'] = convert_to_iso_datetime($data['import_date']);
        if ($data['import_date'])
            $data['import_date'] .= ' ' . date('H:i:s');
        else
            $data['import_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = 1;
        $data['payment_status'] = post('payment_status');
        $data['payment_date'] = post('payment_date');
        $data['payment_date'] = convert_to_iso_datetime($data['payment_date']);
        if ($data['payment_date'])
            $data['payment_date'] .= ' ' . date('H:i:s');
        else
            $data['payment_date'] = $data['created_dtm'];
        $data['cashier_id'] = post('cashier_id', null);
        $data['shipping_fee'] = post('shipping_fee', 0);
        $rs = $this->Inventoryimport->update($import_id, $data);
        if (!$rs)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu nhập kho!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $price = post('item_price');
        $description = post('item_description');
        $provider = post('item_provider');

        $new_quantity = array();
        $total = 0;
        $number_of_rows = count($ids);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]) || $quantity[$i] <= 0)
                continue;
            if (!is_numeric($price[$i]) || $price[$i] < 0)
                $this->_error("Đơn giá ở dòng " . ($i + 1) . " không chính xác!");

            if (empty($item_id)) {
                $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng liên hệ admin.");
            } else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                $item_names[$item_id] = $existed_item['name'];
                if (!$existed_item) {
                    $this->_error("Mã hàng hóa không xác định ở dòng " . ($i + 1) . ". Vui lòng liên hệ admin.");
                }
            }

            //Update inventory import details
            $this->Inventoryimportdetails->insert(array(
                'import_id' => $import_id,
                'item_id' => $item_id,
                'quantity' => $quantity[$i],
                'price' => $price[$i],
                'provider_id' => !empty($provider[$i]) ? $provider[$i] : 0,
                'total' => $quantity[$i] * $price[$i],
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            $total += $quantity[$i] * $price[$i];
            $new_quantity[$item_id] = $quantity[$i];

            if ($import_record['warehouse_id'] != $data['warehouse_id']) {
                //Update inventory
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $update_quantity = $existed_record['quantity'] + $quantity[$i];
                    $update_data = array();
                    $update_data['quantity'] = $update_quantity;
                    $this->Inventory->update($existed_record['id'], $update_data);
                } else {
                    $this->Inventory->insert(array(
                        'warehouse_id' => $data['warehouse_id'],
                        'item_id' => $item_id,
                        'quantity' => $quantity[$i],
                        'quantity_in_details' => null,
                        'created_dtm' => $data['created_dtm']
                    ));
                }
            }
        }

        //Update inventory
        if ($import_record['warehouse_id'] == $data['warehouse_id']) {
            foreach ($removing_quantities as $item_id => $quantity) {
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $import_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    if (isset($new_quantity[$item_id])) {
                        $new_q = $new_quantity[$item_id];
                        unset($new_quantity[$item_id]);
                    } else {
                        $new_q = 0;
                    }
                    $update_quantity =  $existed_record['quantity'] + $new_q - $removing_quantities[$item_id];
                    if ($update_quantity >= 0) {
                        $update_data = array();
                        $update_data['quantity'] = $update_quantity;
                        $this->Inventory->update($existed_record['id'], $update_data);
                    } else
                        $this->_error("Số lượng trái cây " . $item_names[$item_id] . " (ID $item_id) không đủ (thiếu " . abs($update_quantity) . ")");
                } else
                    $this->_error("Không tìm thấy trái cây " . $item_names[$item_id] . " (ID $item_id) trong kho hàng.");
            }
            if (!empty($new_quantity)) {
                foreach ($new_quantity as $item_id => $quantity) {
                    $existed_record = $this->Inventory->select_one(array('warehouse_id' => $import_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                    if ($existed_record) {
                        if ($quantity >= 0) {
                            $update_data = array();
                            $update_data['quantity'] = $quantity;
                            $this->Inventory->update($existed_record['id'], $update_data);
                        } else
                            $this->_error("Số lượng trái cây " . $item_names[$item_id] . " (ID $item_id) không hợp lệ");
                    } else {
                        $this->Inventory->insert(array(
                            'warehouse_id' => $data['warehouse_id'],
                            'item_id' => $item_id,
                            'quantity' => $quantity,
                            'quantity_in_details' => null,
                            'created_dtm' => $data['created_dtm']
                        ));
                    }
                }
            }
        } else {
            foreach ($removing_quantities as $item_id => $quantity) {
                /* Subtract values in old warehouse */
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $import_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $update_quantity = $existed_record['quantity'] - $quantity;
                    if ($update_quantity >= 0) {
                        $update_data = array();
                        $update_data['quantity'] = $update_quantity;
                        $this->Inventory->update($existed_record['id'], $update_data);
                    } else
                        $this->_error("Số lượng trái cây " . $item_names[$item_id] . " (ID $item_id) không đủ (thiếu " . abs($update_quantity) . ")");
                } else
                    $this->_error("Không tìm thấy trái cây " . $item_names[$item_id] . " (ID $item_id) trong kho hàng.");
            }
        }
        $total += $data['shipping_fee'];
        $this->Inventoryimport->update($import_id, array('total' => $total));
        $cost = $this->Costs->get_details_by_import_id($import_id);
        $debt = $this->Debts->get_details_by_import_id($import_id);
        if (strstr($data['payment_status'], 'paid')) {
            $payment_type = $data['payment_status'] == 'paid_by_cash' ? 'cash' : 'bank_balance';
            if ($debt)
                $this->Debts->delete($debt['id']);
            if ($cost) {
                $this->Costs->update($cost['id'], array(
                    'name' => "Chi phí phiếu nhập trái cây #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                    'date_time' => $data['import_date'],
                    'amount' => $total,
                    'user_id' => $data['user_id'],
                    'payment_type' => $payment_type
                ));
                add_balance($cost['amount'], $cost['payment_type']);
            } else {
                $this->Costs->insert(array(
                    'name' => "Chi phí phiếu nhập trái cây #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                    'type_id' => FRUIT_COST_TYPE_ID,
                    'date_time' => $data['created_dtm'],
                    'amount' => $total,
                    'payment_type' => $payment_type,
                    'user_id' => $data['user_id'],
                    'import_id' => $import_id,
                    'created_by' => $this->logged_user['user_id'],
                    'created_dtm' => $data['created_dtm']
                ));
            }
            subtract_balance($total, $payment_type);
        } else if ($data['payment_status'] == 'pending') {
            if ($cost) {
                add_balance($cost['amount'], $cost['payment_type']);
                $this->Costs->delete($cost['id']);
            }

            if ($debt) {
                $this->Debts->update($debt['id'], array(
                    'name' => "Công nợ phiếu nhập trái cây #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                    'payment_date' => $data['payment_date'],
                    'amount' => $total,
                    'user_id' => $data['user_id']
                ));
            } else {
                $this->Debts->insert(array(
                    'name' => "Công nợ phiếu nhập trái cây #$import_id - " . date('d/m/Y', strtotime($data['created_dtm'])),
                    'type_id' => FRUIT_DEBT_TYPE_ID,
                    'payment_date' => $data['payment_date'],
                    'amount' => $total,
                    'user_id' => $data['user_id'],
                    'import_id' => $import_id,
                    'created_by' => $this->logged_user['user_id'],
                    'created_dtm' => $data['created_dtm']
                ));
            }
        }
        $this->_set_last_message('Phiếu nhập trái cây đã được lưu.');
        $this->_ok();
    }

    function admin_search_inventory_export()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $filter_member = post('filter_member');
        $filter_warehouse = post('filter_warehouse');
        $is_fruit = post('is_fruit');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "inventory_export.export_date BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "inventory_export.export_date >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "inventory_export.export_date <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_member)
            $filter_arr['inventory_export.user_id'] = $filter_member;
        if ($filter_warehouse)
            $filter_arr['inventory_export.warehouse_id'] = $filter_warehouse;
        if ($is_fruit)
            $filter_arr['inventory_export.is_fruit'] = 1;
        else
            $filter_arr['inventory_export.is_fruit'] = 0;
        $this->data['is_fruit'] = $is_fruit ? 1 : 0;
        $this->data['inventory_export_details_model'] = $this->Inventoryexportdetails;
        $this->data['export_records'] = $this->Inventoryexport->get_inventory_export_records($filter_arr);
        $this->return['html'] = $this->load_view('inventory/export/list', 1);
        $this->_ok();
    }

    function admin_export_inventory()
    {
        $this->_beginTransaction();
        $fields = $required_fields = array('user_id', 'export_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['export_date'] = convert_to_iso_datetime($data['export_date']);
        if ($data['export_date'])
            $data['export_date'] .= ' ' . date('H:i:s');
        else
            $data['export_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = post('is_fruit', 0);
        $export_id = $this->Inventoryexport->insert($data);
        if (!$export_id)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu xuất kho!!');

        $item_codes = post('item_code');
        if (!$item_codes)
            $this->_error('Vui lòng nhập đầy đủ thông tin hàng hóa!!');

        $item_type_id = post('item_type_id');
        if (!$item_type_id)
            $this->_error('Vui lòng nhập chọn loại hàng xuất!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $quantity_in_details_e = post('item_quantity_in_details');
        $description = post('item_description');
        $quantity_in_details = array();
        $item_names = array();

        $number_of_rows = count($item_codes);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];

            $item_data = array('type_id' => $item_type_id);
            if (!is_numeric($quantity[$i]))
                $this->_error("Số lượng ở dòng " . ($i + 1) . " không chính xác!");

            if (!empty($quantity_in_details_e[$i]) && !is_numeric($quantity_in_details_e[$i]))
                $this->_error("Số lượng chi tiết ở dòng " . ($i + 1) . " không chính xác!");

            if (empty($item_id))
                $this->_error('Vui lòng chọn hàng xuất từ danh sách. Lỗi dòng ' . ($i + 1) . '!!');
            else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                if ($existed_item) {
                    $quantity_in_details[$item_id] = $existed_item['quantity_in_details'];
                    $item_names[$item_id] = $existed_item['name'];
                } else
                    $this->_error('Thông tin hàng hóa không chính xác. Lỗi dòng ' . ($i + 1) . '!!');
            }

            //Update inventory export details
            $this->Inventoryexportdetails->insert(array(
                'export_id' => $export_id,
                'item_id' => $item_id,
                'quantity' => $quantity[$i],
                'quantity_in_details' => !empty($quantity_in_details_e[$i]) ? $quantity_in_details_e[$i] : null,
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            //Update inventory
            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
            if ($existed_record) {
                $update_quantity = $existed_record['quantity'] - $quantity[$i];
                if ($update_quantity < 0)
                    $this->_error('Số lượng hàng trong kho không đủ. Lỗi dòng ' . ($i + 1) . '!!');
                else {
                    $update_data = array();
                    if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id] > 0) {
                        // We need to re-calculator the quantity if we update the quantity_in_details
                        $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] - $quantity_in_details_e[$i] - $quantity[$i] * $quantity_in_details[$item_id];
                        if ($update_data['quantity_in_details'] < 0)
                            $this->_error("Số lượng chi tiết của " . $item_names[$item_id] . " (ID " . $item_id . ") không hợp lệ (xuất dư " . abs($update_data['quantity_in_details']) . ")");
                        $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                    }
                    $update_data['quantity'] = $update_quantity;
                    $this->Inventory->update($existed_record['id'], $update_data);
                }
            } else {
                $this->_error("Không tìm thấy hàng hóa  " . $item_names[$item_id] . " (ID " . $item_id . ") trong kho hàng.");
            }
        }
        $this->_set_last_message('Phiếu xuất kho đã được lưu.');
        $this->_ok();
    }

    function admin_edit_export_inventory()
    {
        $this->_beginTransaction();
        $export_id = post('export_id');

        $export_record = $this->Inventoryexport->get_details($export_id);
        if (!$export_record)
            $this->_error('Mã phiếu xuất không chính xác!');

        $details = $this->Inventoryexportdetails->get_records(array('inventory_export.id' => $export_id));
        if (!$details)
            error('Mã phiếu xuất không chính xác!');

        //Store the adding quantities
        $quantity_in_details = array();
        $item_names = array();
        $adding_quantities = array();
        $adding_quantities_in_details = array();
        foreach ($details as $r) {
            if (empty($adding_quantities[$r['item_id']]))
                $adding_quantities[$r['item_id']] = 0;
            $adding_quantities[$r['item_id']] += $r['quantity'];
            if (empty($adding_quantities_in_details[$r['item_id']]))
                $adding_quantities_in_details[$r['item_id']] = 0;
            $adding_quantities_in_details[$r['item_id']] += $r['quantity_in_details'];
            $quantity_in_details[$r['item_id']] = $r['default_quantity_in_details'];
            $item_names[$r['item_id']] = $r['name'];
        }

        //Delete the import details records
        if (!$this->Inventoryexportdetails->delete_export_details(array('export_id' => $export_id)))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER aeei');

        $fields = $required_fields = array('user_id', 'export_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['export_date'] = convert_to_iso_datetime($data['export_date']);
        if ($data['export_date'])
            $data['export_date'] .= ' ' . date('H:i:s');
        else
            $data['export_date'] = date('Y-m-d H:i:s');

        $data['description'] = post('description');
        $rs = $this->Inventoryexport->update($export_id, $data);
        if (!$rs)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu xuất kho!!');

        $item_codes = post('item_code');
        if (!$item_codes)
            $this->_error('Vui lòng nhập đầy đủ thông tin hàng hóa!!');

        $item_type_id = post('item_type_id');
        if (!$item_type_id)
            $this->_error('Vui lòng nhập chọn loại hàng xuất!!');

        $created_dtm = date('Y-m-d H:i:s');
        $new_quantity = array();
        $new_quantity_in_details = array();

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $quantity_in_details_e = post('item_quantity_in_details');
        $description = post('item_description');

        $number_of_rows = count($item_codes);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]))
                $this->_error("Số lượng hàng hóa ở dòng " . ($i + 1) . " không chính xác!");

            if (!empty($quantity_in_details_e[$i]) && !is_numeric($quantity_in_details_e[$i]))
                $this->_error("Số lượng chi tiết ở dòng " . ($i + 1) . " không chính xác!");

            if (empty($item_id))
                $this->_error('Vui lòng chọn hàng xuất từ danh sách. Lỗi dòng ' . ($i + 1) . '!!');
            else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                if ($existed_item) {
                    $quantity_in_details[$item_id] = $existed_item['quantity_in_details'];
                    $item_names[$item_id] = $existed_item['name'];
                } else
                    $this->_error('Thông tin hàng hóa không chính xác. Lỗi dòng ' . ($i + 1) . '!!');
            }

            //Update inventory export details
            $this->Inventoryexportdetails->insert(array(
                'export_id' => $export_id,
                'item_id' => $item_id,
                'quantity' => $quantity[$i],
                'quantity_in_details' => !empty($quantity_in_details_e[$i]) ? $quantity_in_details_e[$i] : null,
                'description' => $description[$i],
                'created_dtm' => $created_dtm
            ));

            $new_quantity[$item_id] = $quantity[$i];
            $new_quantity_in_details[$item_id] = $quantity_in_details_e[$i];

            if ($export_record['warehouse_id'] != $data['warehouse_id']) {
                //Update inventory
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $update_quantity = $existed_record['quantity'] - $quantity[$i];
                    if ($update_quantity < 0)
                        $this->_error('Số lượng hàng trong kho không đủ. Lỗi dòng ' . ($i + 1) . '!!');
                    else {
                        $update_data = array();
                        if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id] > 0) {
                            // We need to re-calculator the quantity if we update the quantity_in_details
                            $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] - $quantity_in_details_e[$i] - $quantity[$i] * $quantity_in_details[$item_id];
                            if ($update_data['quantity_in_details'] < 0)
                                $this->_error("Số lượng chi tiết của " . $item_names[$item_id] . " (ID " . $item_id . ") không hợp lệ (xuất dư " . abs($update_data['quantity_in_details']) . ")");
                            $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                        }
                        $update_data['quantity'] = $update_quantity;
                        $this->Inventory->update($existed_record['id'], $update_data);
                    }
                } else {
                    $this->Inventory->insert(array(
                        'warehouse_id' => $data['warehouse_id'],
                        'item_id' => $item_id,
                        'quantity' => $quantity[$i],
                        'quantity_in_details' => !empty($quantity_in_details[$item_id]) ? ($quantity_in_details[$item_id] * $quantity[$i]) : null,
                        'created_dtm' => $data['created_dtm']
                    ));
                }
            }
        }

        //Update inventory
        if ($export_record['warehouse_id'] == $data['warehouse_id']) {
            foreach ($adding_quantities as $item_id => $quantity) {
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    if (isset($new_quantity[$item_id])) {
                        $new_q = $new_quantity[$item_id];
                        unset($new_quantity[$item_id]);
                    } else {
                        $new_q = 0;
                    }
                    $update_quantity = $existed_record['quantity'] - $new_q + $adding_quantities[$item_id];
                    if ($update_quantity >= 0) {
                        $update_data = array();
                        if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id] > 0) {
                            // We need to re-calculator the quantity if we update the quantity_in_details
                            $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] - $new_quantity_in_details[$item_id] + $adding_quantities_in_details[$item_id] + ($adding_quantities[$item_id] - $new_q) * $quantity_in_details[$item_id];
                            if ($update_data['quantity_in_details'] < 0)
                                $this->_error("Số lượng chi tiết của " . $item_names[$item_id] . " (ID " . $item_id . ") không hợp lệ (xuất dư " . abs($update_data['quantity_in_details']) . ")");
                            $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                        }
                        $update_data['quantity'] = $update_quantity;
                        $this->Inventory->update($existed_record['id'], $update_data);
                    } else
                        $this->_error("Số lượng hàng hóa " . $item_names[$item_id] . " (ID $item_id) không hợp lệ (xuất dư " . abs($update_quantity) . ")");
                } else
                    $this->_error("Không tìm thấy hàng hóa " . $item_names[$item_id] . " (ID $item_id) trong kho hàng.");
            }
            if (!empty($new_quantity)) {
                foreach ($new_quantity as $item_id => $quantity) {
                    $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                    if ($existed_record) {
                        $update_quantity = $existed_record['quantity'] - $quantity;
                        if ($update_quantity >= 0) {
                            $update_data = array();
                            if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id] > 0) {
                                // We need to re-calculator the quantity if we update the quantity_in_details
                                $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] - $new_quantity_in_details[$item_id] + $adding_quantities_in_details[$item_id] + ($adding_quantities[$item_id] - $new_q) * $quantity_in_details[$item_id];
                                if ($update_data['quantity_in_details'] < 0)
                                    $this->_error("Số lượng chi tiết của " . $item_names[$item_id] . " (ID " . $item_id . ") không hợp lệ (xuất dư " . abs($update_data['quantity_in_details']) . ")");
                                $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                            }
                            $update_data['quantity'] = $update_quantity;
                            $this->Inventory->update($existed_record['id'], $update_data);
                        } else
                            $this->_error("Số lượng hàng hóa " . $item_names[$item_id] . " (ID $item_id) không hợp lệ (xuất dư " . abs($update_quantity) . ")");
                    } else {
                        $this->Inventory->insert(array(
                            'warehouse_id' => $data['warehouse_id'],
                            'item_id' => $item_id,
                            'quantity' => $quantity,
                            'quantity_in_details' => !empty($quantity_in_details[$item_id]) ? ($quantity_in_details[$item_id] * $quantity) : null,
                            'created_dtm' => $data['created_dtm']
                        ));
                    }
                }
            }
        } else {
            /* Add values to old warehouse */
            foreach ($adding_quantities as $item_id => $quantity) {
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $update_quantity = $existed_record['quantity'] + $adding_quantities[$item_id];
                    if ($update_quantity >= 0) {
                        $update_data = array();
                        if (!empty($quantity_in_details[$item_id]) && $quantity_in_details[$item_id] > 0) {
                            // We need to re-calculator the quantity if we update the quantity_in_details
                            $update_data['quantity_in_details'] = $existed_record['quantity_in_details']  + $adding_quantities_in_details[$item_id] + $adding_quantities[$item_id] * $quantity_in_details[$item_id];
                            if ($update_data['quantity_in_details'] < 0)
                                $this->_error("Số lượng chi tiết của " . $item_names[$item_id] . " (ID " . $item_id . ") không hợp lệ (xuất dư " . abs($update_data['quantity_in_details']) . ")");
                            $update_quantity = intval($update_data['quantity_in_details'] / $quantity_in_details[$item_id]);
                        }
                        $update_data['quantity'] = $update_quantity;
                        $this->Inventory->update($existed_record['id'], $update_data);
                    } else
                        $this->_error("Số lượng hàng hóa " . $item_names[$item_id] . " (ID $item_id) không hợp lệ (xuất dư " . abs($update_quantity) . ")");
                } else {
                    $this->Inventory->insert(array(
                        'warehouse_id' => $export_record['warehouse_id'],
                        'item_id' => $item_id,
                        'quantity' => $quantity,
                        'quantity_in_details' => !empty($quantity_in_details[$item_id]) ? ($quantity_in_details[$item_id] * $quantity) : null,
                        'created_dtm' => $data['created_dtm']
                    ));
                }
            }
        }

        $this->_set_last_message('Phiếu xuất kho đã được sửa.');
        $this->_ok();
    }

    function admin_delete_export_inventory()
    {
        $this->_beginTransaction();
        $export_id = post('export_id');
        $warehouse_id = post('warehouse_id');

        $details = $this->Inventoryexportdetails->get_records(array('inventory_export.id' => $export_id));
        if (!$details)
            $this->_error('Mã phiếu xuất không chính xác!');

        //Store the addding quantities
        $adding_quantities = array();
        $adding_quantities_in_details = array();
        foreach ($details as $r) {
            if (empty($adding_quantities[$r['item_id']]))
                $adding_quantities[$r['item_id']] = 0;
            $adding_quantities[$r['item_id']] += $r['quantity'] > 0 ? $r['quantity'] : 0;
            if (empty($adding_quantities_in_details[$r['item_id']]))
                $adding_quantities_in_details[$r['item_id']] = 0;
            $adding_quantities_in_details[$r['item_id']] += $r['quantity_in_details'] > 0 ? $r['quantity_in_details'] : 0;
        }

        //Update inventory
        foreach ($adding_quantities as $item_id => $quantity) {
            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $warehouse_id, 'item_id' => $item_id, 'deleted' => 0));
            if ($existed_record) {
                $inventory_item = $this->Inventoryitemdetails->get_details($item_id);
                $update_quantity =  $existed_record['quantity'] + $adding_quantities[$item_id];
                $update_data = array();
                if (!empty($inventory_item['quantity_in_details'])) {
                    // We need to re-calculator the quantity if we update the quantity_in_details                    
                    $update_data['quantity_in_details'] = $existed_record['quantity_in_details'] + $adding_quantities_in_details[$item_id] + $adding_quantities[$item_id] * $inventory_item['quantity_in_details'];
                    $update_quantity = intval($update_data['quantity_in_details'] / $inventory_item['quantity_in_details']);
                }
                $update_data['quantity'] = $update_quantity;
                $this->Inventory->update($existed_record['id'], $update_data);
            } else {
                $this->Inventory->insert(array(
                    'warehouse_id' => $warehouse_id,
                    'item_id' => $item_id,
                    'quantity' => $quantity,
                    'quantity_in_details' => !empty($inventory_item['quantity_in_details']) ? ($inventory_item['quantity_in_details'] * $quantity) : null,
                    'created_dtm' => date('Y-m-d H:i:s')
                ));
            }
        }

        //Delete the export details records
        if (!$this->Inventoryexportdetails->delete_export_details(array('export_id' => $export_id)))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER adied');

        //Delete the export record
        if (!$this->Inventoryexport->delete($export_id))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER adiie');

        $this->_set_last_message("Phiếu xuất kho với ID $export_id đã được xóa.");
        $this->_ok();
    }

    function admin_check_inventory()
    {
        $this->_beginTransaction();
        $fields = $required_fields = array('user_id', 'export_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['export_date'] = convert_to_iso_datetime($data['export_date']);
        if ($data['export_date'])
            $data['export_date'] .= ' ' . date('H:i:s');
        else
            $data['export_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = 0;
        $export_id = $this->Inventoryexport->insert($data);
        if (!$export_id)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu kiểm kê!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $description = post('item_description');
        $item_names = array();

        $number_of_rows = count($ids);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]))
                continue;

            if (empty($item_id))
                $this->_error('Vui lòng chọn hàng xuất từ danh sách. Lỗi dòng ' . ($i + 1) . '!!');
            else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                if ($existed_item) {
                    $quantity_in_details[$item_id] = $existed_item['quantity_in_details'];
                    $item_names[$item_id] = $existed_item['name'];
                } else
                    $this->_error('Thông tin hàng hóa không chính xác. Lỗi dòng ' . ($i + 1) . '!!');
            }

            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
            if (!$existed_record) {
                $inventory_id = $this->Inventory->insert(array(
                    'warehouse_id' => $data['warehouse_id'],
                    'item_id' => $item_id,
                    'created_dtm' => date('Y-m-d H:i:s')
                ));
                $existed_record = $this->Inventory->get_details($inventory_id);
            }

            //Update inventory export details
            $this->Inventoryexportdetails->insert(array(
                'export_id' => $export_id,
                'item_id' => $item_id,
                'quantity' => $existed_record['quantity'] - $quantity[$i],
                'quantity_in_details' => null,
                'remain_quantity' => $quantity[$i],
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            //Update inventory
            $this->Inventory->update($existed_record['id'], array('quantity' => $quantity[$i]));
        }
        $this->_set_last_message('Phiếu kiểm kê đã được lưu.');
        $this->_ok();
    }

    function admin_edit_check_inventory()
    {
        $this->_beginTransaction();
        $export_id = post('export_id');

        $export_record = $this->Inventoryexport->get_details($export_id);
        $details = $this->Inventoryexportdetails->get_records(array('inventory_export.id' => $export_id));
        if (!$details)
            error('Mã phiếu kiểm kê không chính xác!');

        //Store the adding quantities
        $item_names = array();
        $adding_quantities = array();
        foreach ($details as $r) {
            if (empty($adding_quantities[$r['item_id']]))
                $adding_quantities[$r['item_id']] = 0;
            $adding_quantities[$r['item_id']] += $r['quantity'];
            $item_names[$r['item_id']] = $r['name'];
        }

        //Delete the import details records
        if (!$this->Inventoryexportdetails->delete_export_details(array('export_id' => $export_id)))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER aeei');


        $fields = $required_fields = array('user_id', 'export_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['export_date'] = convert_to_iso_datetime($data['export_date']);
        if ($data['export_date'])
            $data['export_date'] .= ' ' . date('H:i:s');
        else
            $data['export_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = 0;
        $success = $this->Inventoryexport->update($export_id, $data);
        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu kiểm kê!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $description = post('item_description');
        $item_names = array();

        $number_of_rows = count($ids);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]))
                continue;

            if (empty($item_id))
                $this->_error('Vui lòng chọn hàng xuất từ danh sách. Lỗi dòng ' . ($i + 1) . '!!');
            else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                if ($existed_item) {
                    $quantity_in_details[$item_id] = $existed_item['quantity_in_details'];
                    $item_names[$item_id] = $existed_item['name'];
                } else
                    $this->_error('Thông tin hàng hóa không chính xác. Lỗi dòng ' . ($i + 1) . '!!');
            }

            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
            if (!$existed_record) {
                $inventory_id = $this->Inventory->insert(array(
                    'warehouse_id' => $data['warehouse_id'],
                    'item_id' => $item_id,
                    'created_dtm' => date('Y-m-d H:i:s')
                ));
                $existed_record = $this->Inventory->get_details($inventory_id);
            }

            $add_quantities = isset($adding_quantities[$item_id]) ? $adding_quantities[$item_id] : 0;

            //Update inventory export details
            $this->Inventoryexportdetails->insert(array(
                'export_id' => $export_id,
                'item_id' => $item_id,
                'quantity' => $add_quantities + $existed_record['quantity'] - $quantity[$i],
                'remain_quantity' => $quantity[$i],
                'quantity_in_details' => null,
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            $new_quantity[$item_id] = $quantity[$i];

            //Update inventory
            if ($export_record['warehouse_id'] != $data['warehouse_id'])
                $this->Inventory->update($existed_record['id'], array('quantity' => $quantity[$i]));
        }

        //Update inventory
        if ($export_record['warehouse_id'] == $data['warehouse_id']) {
            foreach ($adding_quantities as $item_id => $quantity) {
                if (isset($new_quantity[$item_id])) {
                    $new_q = $new_quantity[$item_id];
                    unset($new_quantity[$item_id]);
                } else {
                    $new_q = 0;
                }
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $this->Inventory->update($existed_record['id'], array('quantity' => $new_q));
                } else {
                    $this->Inventory->insert(array(
                        'warehouse_id' => $export_record['warehouse_id'],
                        'item_id' => $item_id,
                        'created_dtm' => date('Y-m-d H:i:s'),
                        'quantity' => $new_q
                    ));
                }
            }
            if (!empty($new_quantity)) {
                foreach ($new_quantity as $item_id => $quantity) {
                    $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                    if ($existed_record) {
                        $this->Inventory->update($existed_record['id'], array('quantity' => $quantity));
                    } else {
                        $this->Inventory->insert(array(
                            'warehouse_id' => $export_record['warehouse_id'],
                            'item_id' => $item_id,
                            'created_dtm' => date('Y-m-d H:i:s'),
                            'quantity' => $quantity
                        ));
                    }
                }
            }
        } else {
            /* Add values to old warehouse */
            foreach ($adding_quantities as $item_id => $quantity) {
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $update_quantity = $existed_record['quantity'] + $adding_quantities[$item_id];
                    $update_data = array();
                    $update_data['quantity'] = $update_quantity;
                    $this->Inventory->update($existed_record['id'], $update_data);
                } else {
                    $this->Inventory->insert(array(
                        'warehouse_id' => $export_record['warehouse_id'],
                        'item_id' => $item_id,
                        'quantity' => $quantity,
                        'quantity_in_details' => null,
                        'created_dtm' => $data['created_dtm']
                    ));
                }
            }
        }

        $this->_set_last_message('Phiếu kiểm kê đã được lưu.');
        $this->_ok();
    }

    function load_inventory_items_for_checking()
    {
        $type_id = post('type_id');
        $filters = array('type_id' => $type_id);
        $this->data['inventory_items'] = $this->Inventoryitemdetails->get_list($filters);
        $this->return['html'] = $this->load_view('inventory/check/list-items', 1);
        $this->_ok();
    }

    function admin_search_check_inventory()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $filter_member = post('filter_member');
        $filter_warehouse = post('filter_warehouse');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "inventory_export.export_date BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "inventory_export.export_date >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "inventory_export.export_date <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_member)
            $filter_arr['inventory_export.user_id'] = $filter_member;
        if ($filter_warehouse)
            $filter_arr['inventory_export.warehouse_id'] = $filter_warehouse;
        $filter_arr['inventory_export.is_fruit'] = 0;
        $this->data['is_fruit'] = 0;
        $this->data['inventory_export_details_model'] = $this->Inventoryexportdetails;
        $this->data['export_records'] = $this->Inventoryexport->get_inventory_export_records($filter_arr);
        $this->return['html'] = $this->load_view('inventory/check/list', 1);
        $this->_ok();
    }

    function admin_check_inventory_fruits()
    {
        $this->_beginTransaction();
        $fields = $required_fields = array('user_id', 'export_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['export_date'] = convert_to_iso_datetime($data['export_date']);
        if ($data['export_date'])
            $data['export_date'] .= ' ' . date('H:i:s');
        else
            $data['export_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = 1;
        $export_id = $this->Inventoryexport->insert($data);
        if (!$export_id)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu kiểm kê!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $description = post('item_description');
        $item_names = array();

        $number_of_rows = count($ids);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]))
                continue;

            if (empty($item_id))
                $this->_error('Vui lòng chọn hàng xuất từ danh sách. Lỗi dòng ' . ($i + 1) . '!!');
            else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                if ($existed_item) {
                    $quantity_in_details[$item_id] = $existed_item['quantity_in_details'];
                    $item_names[$item_id] = $existed_item['name'];
                } else
                    $this->_error('Thông tin hàng hóa không chính xác. Lỗi dòng ' . ($i + 1) . '!!');
            }

            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
            /* We do not tight the rules anymore
			if (!$existed_record)
				$this->_error("Không tìm thấy trái cây  ".$item_names[$item_id]." (ID ".$item_id.") trong kho hàng. Vui lòng thêm danh mục trái cây.");
			if ($existed_record['quantity'] < $quantity[$i])
				$this->_error('Số lượng trái cây trong kho thấp hơn số lượng kiểm kê. Lỗi dòng '.($i+1).'!!');
			*/
            if (!$existed_record) {
                $inventory_id = $this->Inventory->insert(array(
                    'warehouse_id' => $data['warehouse_id'],
                    'item_id' => $item_id,
                    'created_dtm' => date('Y-m-d H:i:s')
                ));
                $existed_record = $this->Inventory->get_details($inventory_id);
            }

            //Update inventory export details
            $this->Inventoryexportdetails->insert(array(
                'export_id' => $export_id,
                'item_id' => $item_id,
                'quantity' => $existed_record['quantity'] - $quantity[$i],
                'quantity_in_details' => null,
                'remain_quantity' => $quantity[$i],
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            //Update inventory
            $this->Inventory->update($existed_record['id'], array('quantity' => $quantity[$i]));
        }
        $this->_set_last_message('Phiếu kiểm kê đã được lưu.');
        $this->_ok();
    }

    function admin_edit_check_inventory_fruits()
    {
        $this->_beginTransaction();
        $export_id = post('export_id');

        $export_record = $this->Inventoryexport->get_details($export_id);
        $details = $this->Inventoryexportdetails->get_records(array('inventory_export.id' => $export_id));
        if (!$details)
            error('Mã phiếu kiểm kê không chính xác!');

        //Store the adding quantities
        $item_names = array();
        $adding_quantities = array();
        foreach ($details as $r) {
            if (empty($adding_quantities[$r['item_id']]))
                $adding_quantities[$r['item_id']] = 0;
            $adding_quantities[$r['item_id']] += $r['quantity'];
            $item_names[$r['item_id']] = $r['name'];
        }

        //Delete the import details records
        if (!$this->Inventoryexportdetails->delete_export_details(array('export_id' => $export_id)))
            $this->_error('Có lỗi xảy ra. Vui lòng liên hệ admin! - Mã lỗi: ER aeei');


        $fields = $required_fields = array('user_id', 'export_date', 'warehouse_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        $data['export_date'] = convert_to_iso_datetime($data['export_date']);
        if ($data['export_date'])
            $data['export_date'] .= ' ' . date('H:i:s');
        else
            $data['export_date'] = date('Y-m-d H:i:s');

        $data['created_dtm'] = date('Y-m-d H:i:s');
        $data['description'] = post('description');
        $data['is_fruit'] = 1;
        $success = $this->Inventoryexport->update($export_id, $data);
        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu phiếu kiểm kê!!');

        $ids = post('item_id');
        $quantity = post('item_quantity');
        $description = post('item_description');
        $item_names = array();

        $number_of_rows = count($ids);
        for ($i = 0; $i < $number_of_rows; $i++) {
            $item_id = $ids[$i];
            if (!is_numeric($quantity[$i]))
                continue;

            if (empty($item_id))
                $this->_error('Vui lòng chọn hàng xuất từ danh sách. Lỗi dòng ' . ($i + 1) . '!!');
            else {
                $existed_item = $this->Inventoryitemdetails->get_details($item_id);
                if ($existed_item) {
                    $quantity_in_details[$item_id] = $existed_item['quantity_in_details'];
                    $item_names[$item_id] = $existed_item['name'];
                } else
                    $this->_error('Thông tin hàng hóa không chính xác. Lỗi dòng ' . ($i + 1) . '!!');
            }

            $existed_record = $this->Inventory->select_one(array('warehouse_id' => $data['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
            /* We do not tight the rules anymore
			if (!$existed_record)
				$this->_error("Không tìm thấy trái cây  ".$item_names[$item_id]." (ID ".$item_id.") trong kho. Vui lòng nhập hàng.");
			*/
            if (!$existed_record) {
                $inventory_id = $this->Inventory->insert(array(
                    'warehouse_id' => $data['warehouse_id'],
                    'item_id' => $item_id,
                    'created_dtm' => date('Y-m-d H:i:s')
                ));
                $existed_record = $this->Inventory->get_details($inventory_id);
            }

            $add_quantities = isset($adding_quantities[$item_id]) ? $adding_quantities[$item_id] : 0;

            /* We do not tight the rules anymore
			if ($add_quantities + $existed_record['quantity'] < $quantity[$i])
				$this->_error('Số lượng trái cây trong kho thấp hơn số lượng kiểm kê. Lỗi dòng '.($i+1).' ('. $item_names[$item_id] .')!!');
			*/

            //Update inventory export details
            $this->Inventoryexportdetails->insert(array(
                'export_id' => $export_id,
                'item_id' => $item_id,
                'quantity' => $add_quantities + $existed_record['quantity'] - $quantity[$i],
                'remain_quantity' => $quantity[$i],
                'quantity_in_details' => null,
                'description' => $description[$i],
                'created_dtm' => $data['created_dtm']
            ));

            $new_quantity[$item_id] = $quantity[$i];

            //Update inventory
            if ($export_record['warehouse_id'] != $data['warehouse_id'])
                $this->Inventory->update($existed_record['id'], array('quantity' => $quantity[$i]));
        }

        //Update inventory
        if ($export_record['warehouse_id'] == $data['warehouse_id']) {
            foreach ($adding_quantities as $item_id => $quantity) {
                if (isset($new_quantity[$item_id])) {
                    $new_q = $new_quantity[$item_id];
                    unset($new_quantity[$item_id]);
                } else {
                    $new_q = 0;
                }
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $this->Inventory->update($existed_record['id'], array('quantity' => $new_q));
                } else {
                    /* We do not tight the rules anymore
					$this->_error("Không tìm thấy trái cây " . $item_names[$item_id] . " (ID $item_id) trong kho. Vui lòng nhập hàng.");
					*/
                    $this->Inventory->insert(array(
                        'warehouse_id' => $export_record['warehouse_id'],
                        'item_id' => $item_id,
                        'created_dtm' => date('Y-m-d H:i:s'),
                        'quantity' => $new_q
                    ));
                }
            }
            if (!empty($new_quantity)) {
                foreach ($new_quantity as $item_id => $quantity) {
                    $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                    if ($existed_record) {
                        $this->Inventory->update($existed_record['id'], array('quantity' => $quantity));
                    } else {
                        /* We do not tight the rules anymore
						$this->_error("Không tìm thấy trái cây " . $item_names[$item_id] . " (ID $item_id) trong kho. Vui lòng nhập hàng.");
						*/
                        $this->Inventory->insert(array(
                            'warehouse_id' => $export_record['warehouse_id'],
                            'item_id' => $item_id,
                            'created_dtm' => date('Y-m-d H:i:s'),
                            'quantity' => $quantity
                        ));
                    }
                }
            }
        } else {
            /* Add values to old warehouse */
            foreach ($adding_quantities as $item_id => $quantity) {
                $existed_record = $this->Inventory->select_one(array('warehouse_id' => $export_record['warehouse_id'], 'item_id' => $item_id, 'deleted' => 0));
                if ($existed_record) {
                    $update_quantity = $existed_record['quantity'] + $adding_quantities[$item_id];
                    /* We do not tight the rules anymore
					if ($update_quantity >= 0) {
						$update_data = array();
						$update_data['quantity'] = $update_quantity;
						$this->Inventory->update($existed_record['id'], $update_data);
					} else
						$this->_error("Số lượng trái cây " . $item_names[$item_id] . " (ID $item_id) không hợp lệ (xuất dư " . abs($update_quantity) . ")");
					*/
                    $update_data = array();
                    $update_data['quantity'] = $update_quantity;
                    $this->Inventory->update($existed_record['id'], $update_data);
                } else {
                    $this->Inventory->insert(array(
                        'warehouse_id' => $export_record['warehouse_id'],
                        'item_id' => $item_id,
                        'quantity' => $quantity,
                        'quantity_in_details' => null,
                        'created_dtm' => $data['created_dtm']
                    ));
                }
            }
        }

        $this->_set_last_message('Phiếu kiểm kê đã được lưu.');
        $this->_ok();
    }

    function admin_search_check_inventory_fruits()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $filter_member = post('filter_member');
        $filter_warehouse = post('filter_warehouse');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "inventory_export.export_date BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "inventory_export.export_date >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "inventory_export.export_date <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_member)
            $filter_arr['inventory_export.user_id'] = $filter_member;
        if ($filter_warehouse)
            $filter_arr['inventory_export.warehouse_id'] = $filter_warehouse;
        $filter_arr['inventory_export.is_fruit'] = 1;
        $this->data['is_fruit'] = 1;
        $this->data['inventory_export_details_model'] = $this->Inventoryexportdetails;
        $this->data['export_records'] = $this->Inventoryexport->get_inventory_export_records($filter_arr);
        $this->return['html'] = $this->load_view('inventory_fruits/check/list', 1);
        $this->_ok();
    }

    function admin_search_inventory_item()
    {
        $filter_type_id = post('filter_type_id');
        $filter_warehouse_id = post('filter_warehouse_id');
        $filter_arr = array();
        if ($filter_type_id)
            $filter_arr['inventory_item_details.type_id'] = $filter_type_id;
        if ($filter_warehouse_id)
            $filter_arr['inventory_item_details.warehouse_id'] = $filter_warehouse_id;
        if (post('is_fruit')) {
            $this->data['items'] = $this->Inventoryitemdetails->get_fruits_list($filter_arr);
            $this->data['item_types'] = $this->Inventoryitemdetails->get_fruits_types();
            $this->data['is_fruit'] = 1;
        } else {
            $this->data['items'] = $this->Inventoryitemdetails->get_list($filter_arr);
            $this->data['item_types'] = $this->Inventoryitemdetails->get_item_types();
            $this->data['is_fruit'] = 0;
        }
        $this->return['html'] = $this->load_view('inventory/item/list', 1);
        $this->_ok();
    }

    function admin_search_inventory_item_for_quick_management()
    {
        $filter_type_id = post('filter_type_id');
        $filter_arr = array();
        if ($filter_type_id)
            $filter_arr['inventory_item_details.type_id'] = $filter_type_id;
        $this->data['items'] = $this->Inventoryitemdetails->get_fruits_list($filter_arr);
        $this->data['item_types'] = $this->Inventoryitemdetails->get_fruits_types();
        $this->data['is_fruit'] = 1;
        $this->return['html'] = $this->load_view('product/manage/list', 1);
        $this->_ok();
    }

    function admin_update_inventory_item()
    {
        $this->_beginTransaction();
        $fields = array('name', 'code', 'unit', 'default_price', 'quantity_in_details', 'unit_in_details', 'type_id', 'category_id', 'warehouse_id', 'enabled', 'warning_quanity', 'required_quantity');
        $required_fields = array('name', 'unit', 'type_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        if (empty($data['name']))
            $this->_error('Tên hàng hóa không thể trống. Vui lòng nhập lại!!');
        elseif (empty($data['type_id']))
            $this->_error('Loại hàng hóa không thể trống. Vui lòng nhập lại!!');

        $item_id = post('item_id');
        if ($item_id) {
            $success = $this->Inventoryitemdetails->update($item_id, $data);
        } else {
            $item_exists = $this->Inventoryitemdetails->select(array('name' => $data['name'], 'code' => $data['code'], 'unit' => $data['unit']));
            if (!$item_exists) {
                $data['created_dtm'] = date('Y-m-d H:i:s');;
                $success = $this->Inventoryitemdetails->insert($data);
            } else
                $this->_error('Tên hàng hóa đã được sử dụng. Vui lòng nhập tên khác!!');
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_search_voucher()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $filter_type = post('filter_type');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "vouchers.date_time BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "vouchers.date_time >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "vouchers.date_time <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_type)
            $filter_arr['vouchers.type'] = $filter_type;
        $this->data['vouchers'] = $this->Vouchers->get_list($filter_arr);
        $this->return['html'] = $this->load_view('voucher/list', 1);
        $this->_ok();
    }

    function admin_update_voucher()
    {
        $this->_beginTransaction();
        $voucher_id = post('voucher_id');
        $fields = $required_fields = array('date_time', 'type', 'amount', 'user_id', 'description');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $data['date_time'] = convert_to_iso_datetime($data['date_time'], 'd/m/Y H:i');
        $data['amount'] = floatval($data['amount']) / 1000.0;
        if ($voucher_id) {
            $success = $this->Vouchers->update($voucher_id, $data);
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $this->Vouchers->insert($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_search_cost()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $filter_type = post('filter_type');
        $filter_provider = post('filter_provider');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "costs.date_time BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "costs.date_time >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "costs.date_time <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_type)
            $filter_arr['costs.type_id'] = $filter_type;
        if ($filter_provider)
            $filter_arr['inventory_import_details.provider_id'] = $filter_provider;
        $this->data['costs'] = $this->Costs->get_list($filter_arr);
        $this->return['html'] = $this->load_view('cost/list', 1);
        $this->_ok();
    }

    function admin_update_cost()
    {
        $this->_beginTransaction();
        $cost_id = post('cost_id');
        $fields = array('date_time', 'name', 'type_id', 'amount', 'user_id', 'description', 'payment_type');
        $required_fields = array('date_time', 'name', 'type_id', 'amount', 'user_id');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $data['date_time'] = convert_to_iso_datetime($data['date_time'], 'd/m/Y H:i');

        $paid_amount = intval(post('amount'));

        if ($cost_id) {
            $cost = $this->Costs->get_details($cost_id);
            add_balance($cost['amount'], $cost['payment_type']);
            $success = $this->Costs->update($cost_id, $data);
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $cost_id = $this->Costs->insert($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

        subtract_balance($paid_amount, $data['payment_type']);

        $this->_ok();
    }

    function admin_update_cost_type()
    {
        $this->_beginTransaction();
        $cost_type_id = post('cost_type_id');
        $fields = array('name', 'description');
        $required_fields = array('name');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        if ($cost_type_id) {
            $success = $this->Costs->update_type($cost_type_id, $data);
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $this->Costs->insert_type($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_search_debt()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $filter_type = post('filter_type');
        $filter_provider = post('filter_provider');
        $is_done = post('is_done');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "debts.payment_date BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "debts.payment_date >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "debts.payment_date <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($filter_type)
            $filter_arr['debts.type_id'] = $filter_type;
        if ($filter_provider)
            $filter_arr['inventory_import_details.provider_id'] = $filter_provider;
        if ($is_done)
            $filter_arr['debts.status'] = 'paid';
        else
            $filter_arr['where'] .= " AND debts.status != 'paid'";
        $this->data['debts'] = $this->Debts->get_list($filter_arr);
        $this->return['html'] = $this->load_view($is_done ? 'debt/done_list' : 'debt/list', 1);
        $this->_ok();
    }

    function admin_update_debt()
    {
        $this->_beginTransaction();
        $debt_id = post('debt_id');
        $fields = array('payment_date', 'name', 'type_id', 'amount', 'user_id', 'description', 'status', 'payment_type', 'paid_amount');
        $required_fields = array('payment_date', 'name', 'type_id', 'amount', 'user_id', 'status');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $data['payment_date'] = convert_to_iso_datetime($data['payment_date'], 'd/m/Y H:i');
        if ($debt_id) {
            $success = $this->Debts->update($debt_id, $data);
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $debt_id = $this->Debts->insert($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

        $paid_amount = post('paid_amount');
        $payment_type = post('payment_type', 'cash');
        $debt = $this->Debts->get_details($debt_id);
        $cost = $this->Costs->get_details_by_debt_id($debt_id);
        if ($data['status'] == 'paid') {
            if ($cost) {
                $this->Costs->update($cost['id'], array(
                    'type_id' => $debt['type_id'],
                    'amount' => $paid_amount,
                    'user_id' => post('user_id'),
                    'payment_type' => $payment_type
                ));
                add_balance($cost['amount'], $cost['payment_type']);
            } else {
                $now = date('Y-m-d H:i:s');
                $import = $this->Inventoryimport->get_details($debt['import_id']);
                /* We will use import date as primary cost date */
                $this->Costs->insert(array(
                    'name' => 'Chi phí từ công nợ #' . $debt_id,
                    'type_id' => $debt['type_id'],
                    'date_time' => $import['import_date'],
                    'amount' => $paid_amount,
                    'payment_type' => $payment_type,
                    'user_id' => post('user_id'),
                    'import_id' => $debt['import_id'],
                    'debt_id' => $debt_id,
                    'created_by' => $this->logged_user['user_id'],
                    'created_dtm' => $now
                ));
            }
            subtract_balance($paid_amount, $payment_type);
        } else if ($data['status'] == 'pending') {
            if ($cost) {
                add_balance($cost['amount'], $cost['payment_type']);
                $this->Costs->delete($cost['id']);
            }
        }

        $this->_ok();
    }

    function admin_update_debt_type()
    {
        $this->_beginTransaction();
        $debt_type_id = post('debt_type_id');
        $fields = array('name', 'description');
        $required_fields = array('name');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        if ($debt_type_id) {
            $success = $this->Debts->update_type($debt_type_id, $data);
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $this->Debts->insert_type($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_update_cost_from_debt()
    {
        $debt_id = post('debt_id');
        if (empty($debt_id)) {
            $this->_error('ID công nợ không chính xác.');
        }
        $debt = $this->Debts->get_details($debt_id);
        if (empty($debt)) {
            $this->_error('ID công nợ không chính xác.');
        }
        $this->_beginTransaction();
        $payment_type = post('payment_type');
        $paid_amount = intval(post('paid_amount'));
        $now = date('Y-m-d H:i:s');
        $data = array(
            'status' => 'paid',
            'paid_amount' => $paid_amount,
            'payment_type' => $payment_type,
            'payment_date' => $now
        );

        if (!$this->Debts->update($debt_id, $data))
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

        $cost = $this->Costs->get_details_by_debt_id($debt_id);
        if ($cost) {
            $this->Costs->update($cost['id'], array(
                'type_id' => $debt['type_id'],
                'amount' => $paid_amount,
                'user_id' => post('user_id'),
                'payment_type' => $payment_type
            ));
            add_balance($cost['amount'], $cost['payment_type']);
        } else {
            $import = $this->Inventoryimport->get_details($debt['import_id']);
            /* We will use import date as primary cost date */
            $this->Costs->insert(array(
                'name' => 'Chi phí từ công nợ #' . $debt_id,
                'type_id' => $debt['type_id'],
                'date_time' => $import['import_date'],
                'amount' => $paid_amount,
                'payment_type' => $payment_type,
                'user_id' => post('user_id'),
                'import_id' => $debt['import_id'],
                'debt_id' => $debt_id,
                'created_by' => $this->logged_user['user_id'],
                'created_dtm' => $now
            ));
        }
        subtract_balance($paid_amount, $payment_type);
        $this->_ok();
    }

    function admin_search_customer_debt()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        $is_done = post('is_done');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "customer_debts.payment_date BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "customer_debts.payment_date >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "customer_debts.payment_date <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        if ($is_done)
            $filter_arr['customer_debts.status'] = 'paid';
        else
            $filter_arr['where'] .= " AND customer_debts.status != 'paid'";
        $this->data['debts'] = $this->Customerdebts->get_list($filter_arr);
        $this->return['html'] = $this->load_view('customer_debt/list', 1);
        $this->_ok();
    }

    function admin_update_customer_debt()
    {
        $this->_beginTransaction();
        $debt_id = post('debt_id');
        $fields = array('payment_date', 'name', 'amount', 'user_id', 'description', 'status', 'payment_type', 'paid_amount');
        $required_fields = array('payment_date', 'name', 'amount', 'user_id', 'status');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $data['payment_date'] = convert_to_iso_datetime($data['payment_date'], 'd/m/Y H:i');
        if ($debt_id) {
            $debt = $this->Customerdebts->get_details($debt_id);
            $success = $this->Customerdebts->update($debt_id, $data);
            if ($success) {
                if ($debt['status'] == 'paid') {
                    subtract_balance($debt['amount'], $debt['payment_type']);
                }
            }
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $debt_id = $this->Customerdebts->insert($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

        if ($data['status'] == 'paid') {
            add_balance(post('paid_amount'), post('payment_type', 'cash'));
        }

        $this->_ok();
    }

    function admin_finish_customer_debt()
    {
        $debt_id = post('debt_id');
        if (empty($debt_id)) {
            $this->_error('ID công nợ khách hàng không chính xác.');
        }
        $debt = $this->Customerdebts->get_details($debt_id);
        if (empty($debt)) {
            $this->_error('ID công nợ khách hàng không chính xác.');
        }
        $this->_beginTransaction();
        $payment_type = post('payment_type');
        $paid_amount = intval(post('paid_amount'));
        $now = date('Y-m-d H:i:s');
        $data = array(
            'status' => 'paid',
            'paid_amount' => $paid_amount,
            'payment_type' => $payment_type,
            'payment_date' => $now
        );

        $debt = $this->Customerdebts->get_details($debt_id);

        if (!$this->Customerdebts->update($debt_id, $data))
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

        if ($debt['status'] == 'paid') {
            subtract_balance($debt['amount'], $debt['payment_type']);
        }

        add_balance($paid_amount, $payment_type);
        $this->_ok();
    }

    function admin_update_document()
    {
        $this->_beginTransaction();
        $fields = array('name', 'code', 'description');
        $required_fields = array('name');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $content = post('content');
        $document_id = post('document_id');
        $filename = '';
        if ($document_id) {
            $doc = $this->Documents->get_details($document_id);
            if (!$doc)
                $this->_error('Có lỗi xảy ra. Vui lòng tải lại trang!!');
            $filename = $doc['filename'];
            $success = $this->Documents->update($document_id, $data);
        } else {
            $document_exists = $this->Documents->select(array('code' => $data['code']));
            if (!$document_exists) {
                $filename = $data['filename'] = $data['code'] . '.html';
                $data['created_by'] = $this->logged_user['user_id'];
                $data['created_dtm'] = date('Y-m-d H:i:s');
                $success = $this->Documents->insert($data);
            } else
                $this->_error('Mã tài liệu đã được sử dụng. Vui lòng nhập mã khác!!');
        }

        if (!$filename || file_put_contents(DOCUMENT_FILES_PATH . $filename, $content) === false)
            $this->_error('Có lỗi xảy ra. Không thể lưu dữ liệu vào tập tin!!');

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    private function _get_config($configFields)
    {
        $config = array();
        if (!empty($configFields) && is_array($configFields)) {
            foreach ($configFields as $f => $default) {
                $config[$f] = post('config_' . $f, $default);
            }
        }
        return json_encode($config);
    }

    function admin_update_page()
    {
        $fields = array('page_title', 'page_code', 'page_template', 'page_body', 'extra_data', 'header_image');
        $required_fields = array('page_title', 'page_code');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $data['config'] = $this->_get_config(Pages::$configFields);
        $slide_image = post('slide_image');
        $slide_url = post('slide_url');
        $slide_content = post('slide_content');
        $slide_images = array();
        if (!empty($slide_image)) {
            for ($i = 0; $i < count($slide_image); $i++) {
                if (empty($slide_image[$i])) continue;
                /* Skip the slide_color_INDEX as zero index */
                $slide_color = post('slide_color_' . ($i - 1), 'green');
                $slide_images[] = array(
                    'image' => $slide_image[$i],
                    'url' => !empty($slide_url[$i]) ? $slide_url[$i] : '',
                    'content' => !empty($slide_content[$i]) ? $slide_content[$i] : '',
                    'color' => $slide_color
                );
            }
        }
        $data['slide_images'] = json_encode($slide_images);

        $product_cat_ids = post('product_cat_ids');
        if (empty($product_cat_ids))
            $data['product_cat_ids'] = null;
        else
            $data['product_cat_ids'] = is_array($product_cat_ids) ? implode(',', $product_cat_ids) : $product_cat_ids;

        $tag_ids = post('tag_ids');
        if (empty($tag_ids))
            $data['tag_ids'] = null;
        else
            $data['tag_ids'] = is_array($tag_ids) ? implode(',', $tag_ids) : $tag_ids;

        $this->_beginTransaction();
        $page_id = post('page_id');
        if ($page_id) {
            $page = $this->Pages->get_details($page_id);
            if (!$page)
                $this->_error('Mã trang không chính xác. Vui lòng tải lại trang!!');
            $success = $this->Pages->update($page_id, $data);
        } else {
            $page_exists = $this->Pages->select(array('page_code' => $data['page_code']));
            if (!$page_exists) {
                $data['created_by'] = $this->logged_user['user_id'];
                $data['created_dtm'] = date('Y-m-d H:i:s');
                $success = $this->Pages->insert($data);
            } else
                $this->_error('Mã trang đã được sử dụng. Vui lòng nhập mã khác!!');
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_save_page()
    {
        $page_id = post('page_id');
        if ($page_id) {
            $page_id = retrieve_id($page_id);
            $page = $this->Pages->get_details($page_id);
            if (!$page)
                $this->_error('Mã trang không chính xác. Không thể lưu!!');
            $page_body = post('page_body');
            if ($this->Pages->update($page_id, array('page_body' => $page_body)))
                $this->_ok('Nội dung trang đã được lưu');
            else
                $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        } else {
            $this->_error('Mã trang không chính xác. Không thể lưu!!');
        }
    }

    function admin_update_tag()
    {
        $tag_id = post('tag_id');
        $fields = array('tag_name', 'english_name', 'tag_code', 'icon', 'icon_color', 'image', 'description', 'is_main');
        $required_fields = array('tag_name');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $this->_beginTransaction();
        if ($tag_id) {
            $success = $this->Tags->update($tag_id, $data);
        } else {
            $existed_tag = $this->Tags->select_one(array('tag_name' => $data['tag_name']));
            if ($existed_tag)
                $this->_error('Tên nhóm đã có. Vui lòng nhập tên khác.');
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $this->Tags->insert($data);
            $this->return['inserted_id'] = $success;
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');

        $this->_ok();
    }

    function load_tag_details()
    {
        $tag_id = post('tag_id');
        if (!is_numeric($tag_id))
            $this->_error('ID nhóm không hợp lệ.');
        $tag = $this->Tags->get_details($tag_id);
        if (!$tag)
            $this->_error('ID nhóm không hợp lệ.');
        $this->return['tag_name'] = $tag['tag_name'];
        $this->return['english_name'] = $tag['english_name'];
        $this->return['tag_code'] = $tag['tag_code'];
        $this->return['icon'] = $tag['icon'];
        $this->return['icon_color'] = $tag['icon_color'];
        $this->return['image'] = $tag['image'];
        $this->return['is_main'] = $tag['is_main'];
        $this->return['description'] = $tag['description'];
        $this->_ok();
    }

    function search_product_in_tag()
    {
        $tag_id = post('tag_id');
        if (!is_numeric($tag_id))
            $this->_error('ID nhóm không hợp lệ.');
        $products = $this->Productsintags->get_full_list(array('tag_id' => $tag_id));
        if ($products) {
            $this->return['products'] = array();
            foreach ($products as $index => $item)
                $this->return['products'][$index] = array('id' => $item['id'], 'product_name' => $item['product_name'], 'category_name' => $item['category_name']);
        }
        $this->_ok();
    }

    function admin_add_product_to_tag()
    {
        $tag_id = post('tag_id');
        if (!is_numeric($tag_id))
            $this->_error('ID nhóm không hợp lệ.');
        $product_ids = post('product_ids');
        if (empty($product_ids))
            $this->_error('Vui lòng chọn sản phẩm cần thêm.');
        if (!is_array($product_ids))
            $this->_error('ID sản phẩm không hợp lệ, vui lòng chọn lại.');
        $max_sequence_number = $this->Productsintags->get_max_sequence_number(array('tag_id' => $tag_id));
        $this->_beginTransaction();
        $this->return['products'] = array();
        $this->return['existed'] = array();
        $index = 0;
        foreach ($product_ids as $product_id) {
            $product = $this->Products->get_full_details($product_id);
            if ($product) {
                $existed = $this->Productsintags->select_one(array('tag_id' => $tag_id, 'product_id' => $product_id, 'deleted' => 0));
                if (!$existed) {
                    $max_sequence_number++;
                    $inserted_id = $this->Productsintags->insert(array(
                        'tag_id' => $tag_id,
                        'product_id' => $product_id,
                        'sequence_number' => $max_sequence_number,
                        'created_dtm' => date('Y-m-d H:i:s')
                    ));
                    if ($inserted_id)
                        $this->return['products'][$index++] = array('id' => $inserted_id, 'product_name' => $product['name'], 'category_name' => $product['category_name']);
                } else {
                    $this->return['existed'][] = $product['name'] . ' đã có trong danh sách.';
                }
            }
        }
        $this->return['existed'] = implode('<br/>', $this->return['existed']);
        $this->_ok();
    }

    function admin_update_products_in_tag()
    {
        $tag_id = post('tag_id');
        if (!is_numeric($tag_id))
            $this->_error('ID nhóm không hợp lệ.');
        $ids = post('ids');
        if (empty($ids))
            $ids = array();
        $items = $this->Productsintags->get_full_list(array('tag_id' => $tag_id));
        $sequence_numbers = array();
        $i = 1;
        foreach ($ids as $id)
            $sequence_numbers[$id] = $i++;

        $this->_beginTransaction();
        foreach ($items as $item) {
            if (in_array($item['id'], $ids)) {
                $this->Productsintags->update($item['id'], array('sequence_number' => $sequence_numbers[$item['id']]));
            } else {
                //remove
                $this->Productsintags->delete($item['id']);
            }
        }
        $this->_ok();
    }

    function admin_add_image_to_gallery()
    {
        $gallery_id = post('gallery_id', GALLERY_ID);
        $image_ids = post('image_ids');
        if (empty($image_ids))
            $this->_error('Vui lòng chọn ảnh cần thêm.');
        if (!is_array($image_ids))
            $this->_error('ID ảnh không hợp lệ, vui lòng chọn lại.');
        $max_sequence_number = $this->ImagesInGallery->get_max_sequence_number(array('gallery_id' => $gallery_id));
        $this->_beginTransaction();
        $this->return['images'] = array();
        $this->return['existed'] = array();
        $index = 0;
        foreach ($image_ids as $image_id) {
            $image = $this->Files->get_details($image_id);
            if ($image) {
                $existed = $this->ImagesInGallery->select_one(array('gallery_id' => $gallery_id, 'image_id' => $image_id, 'deleted' => 0));
                if (!$existed) {
                    $max_sequence_number++;
                    $inserted_id = $this->ImagesInGallery->insert(array(
                        'gallery_id' => $gallery_id,
                        'image_id' => $image_id,
                        'sequence_number' => $max_sequence_number,
                        'created_dtm' => date('Y-m-d H:i:s')
                    ));
                    if ($inserted_id)
                        $this->return['images'][$index++] = array('id' => $inserted_id, 'filename' => $image['filename'], 'path' => get_image_url($image, 'thumbnail'));
                } else {
                    $this->return['existed'][] = $image['filename'] . ' đã có trong danh sách.';
                }
            }
        }
        $this->return['existed'] = implode('<br/>', $this->return['existed']);
        $this->_ok();
    }

    function admin_update_images_in_gallery()
    {
        $gallery_id = post('gallery_id', GALLERY_ID);
        $ids = post('ids');
        if (empty($ids))
            $ids = array();
        $items = $this->ImagesInGallery->get_full_list(array('gallery_id' => $gallery_id));
        $sequence_numbers = array();
        $i = 1;
        foreach ($ids as $id)
            $sequence_numbers[$id] = $i++;

        $this->_beginTransaction();
        foreach ($items as $item) {
            if (in_array($item['id'], $ids)) {
                $this->ImagesInGallery->update($item['id'], array('sequence_number' => $sequence_numbers[$item['id']]));
            } else {
                //remove
                $this->ImagesInGallery->delete($item['id']);
            }
        }
        $this->_ok();
    }

    function admin_search_shipping_fees_with_wards()
    {
        $type = post('filter_type');
        $district = post('filter_district');
        $details = eModel::_select_one('shipping_fees_with_wards', array('id' => $type));
        if ($details) {
            $data = json_decode($details['fee'], true);
            if (isset($data[$district])) {
                $this->data['fee_details'] = $data[$district];
                $this->return['html'] = $this->load_view('shipping/fees_list_with_wards', 1);
                $this->return['fee_details'] = $data[$district];
            }
        }
        $this->_ok();
    }

    function admin_update_shipping_fees_with_wards()
    {
        $type = post('type');
        $id = post('id');
        $details = eModel::_select_one('shipping_fees_with_wards', array('id' => $id));
        if (!$details)
            $this->_error('ID không chính xác.');
        $district = post('district');
        switch ($type) {
            case 'update_district_min':
                $value = post('value');
                $fees = json_decode($details['fee'], true);
                if (empty($fees[$district]))
                    $fees[$district] = array('min' => $value);
                else
                    $fees[$district]['min'] = $value;
                $this->_beginTransaction();
                eModel::_update('shipping_fees_with_wards', array('id' => $id), array('fee' => json_encode($fees)));
                break;
            case 'update_district_fee':
                $value = post('value');
                $fees = json_decode($details['fee'], true);
                if (empty($fees[$district]))
                    $fees[$district] = array('fee' => $value);
                else
                    $fees[$district]['fee'] = $value;
                $this->_beginTransaction();
                eModel::_update('shipping_fees_with_wards', array('id' => $id), array('fee' => json_encode($fees)));
                break;
            case 'update_district_free_ship':
                $value = post('value');
                $fees = json_decode($details['fee'], true);
                if (empty($fees[$district]))
                    $fees[$district] = array('free_ship' => $value);
                else
                    $fees[$district]['free_ship'] = $value;
                $this->_beginTransaction();
                eModel::_update('shipping_fees_with_wards', array('id' => $id), array('fee' => json_encode($fees)));
                break;
            case 'update_ward':
                $ward_data = array(
                    'ward_min' => post('ward_min'),
                    'ward_fee' => post('ward_fee'),
                    'ward_free_ship' => post('ward_free_ship'),
                );
                $fees = json_decode($details['fee'], true);

                $ward_name = post('ward_name');
                if (empty($ward_name))
                    $this->_error('Tên phường không hợp lệ.');

                if (empty($fees[$district]))
                    $fees[$district] = array('wards' => array());
                elseif (empty($fees[$district]['wards']))
                    $fees[$district]['wards'] = array();

                $ward_name = explode(',', $ward_name);
                foreach ($ward_name as $name) {
                    $name = trim($name);
                    $fees[$district]['wards'][$name] = $ward_data;
                }
                $this->_beginTransaction();
                eModel::_update('shipping_fees_with_wards', array('id' => $id), array('fee' => json_encode($fees)));

                $this->data['fee_details'] = $fees[$district];
                $this->return['html'] = $this->load_view('shipping/fees_list_with_wards', 1);
                $this->return['fee_details'] = $fees[$district];
                break;
            case 'delete_ward':
                $ward_name = post('ward_name');
                $fees = json_decode($details['fee'], true);
                if (!empty($fees[$district]) && !empty($fees[$district]['wards']) && isset($fees[$district]['wards'][$ward_name]))
                    unset($fees[$district]['wards'][$ward_name]);
                $this->_beginTransaction();
                eModel::_update('shipping_fees_with_wards', array('id' => $id), array('fee' => json_encode($fees)));

                $this->data['fee_details'] = $fees[$district];
                $this->return['html'] = $this->load_view('shipping/fees_list_with_wards', 1);
                $this->return['fee_details'] = $fees[$district];
                break;
        }
        $this->_ok();
    }

    function admin_search_shipping_fees()
    {
        $district = post('filter_district');
        $filters = array();
        if ($district)
            $filters['district'] = $district;
        $this->data['items'] = eModel::_select('shipping_fees', $filters);
        $this->return['html'] = $this->load_view('shipping/fees_list', 1);
        $this->_ok();
    }

    function admin_update_shipping_fees()
    {
        $type = post('type');
        $id = post('id');
        $district = post('district');
        switch ($type) {
            case 'delete_district':
                $details = eModel::_select_one('shipping_fees', array('id' => $id));
                if (!$details)
                    $this->_error('ID không chính xác.');
                $this->_beginTransaction();
                eModel::_delete('shipping_fees', array('id' => $id));
                break;
            case 'add_district':
                $this->_beginTransaction();
                $now = date('Y-m-d H:i:s');
                if (is_array($district)) {
                    foreach ($district as $d) {
                        eModel::_insert('shipping_fees', array(
                            'district' => $d,
                            'min_total' => post('min_total'),
                            'fee' => post('fee'),
                            'created_dtm' => $now
                        ));
                    }
                } else {
                    eModel::_insert('shipping_fees', array(
                        'district' => $district,
                        'min_total' => post('min_total'),
                        'fee' => post('fee'),
                        'created_dtm' => $now
                    ));
                }

                break;
        }
        $this->_ok();
    }

    function admin_upload_image()
    {
        if (!empty($_FILES['upload'])) {
            require_once(ABSOLUTE_PATH . 'includes/jqueryfileupload/UploadHandler.php');
            $upload_handler = new UploadHandler(
                array(
                    'upload_dir' => get_upload_path(),
                    'upload_url' => get_upload_url(),
                    'param_name' => 'upload',
                    'print_response' => false
                )
            );
            $response = $upload_handler->get_response();
            if (!empty($response['upload']) && is_array($response['upload'])) {
                foreach ($response['upload'] as $index => $uploaded_file) {
                    $image_id = $this->Files->insert(array(
                        'type' => 'upload_image',
                        'filename' => $uploaded_file->name,
                        'path' => str_replace(ROOT_URL, '', $uploaded_file->url),
                        'foreign_id' => '0',
                        'created_by' => $this->logged_user['user_id'],
                        'created_dtm' => date('Y-m-d H:i:s')
                    ));
                    $response['upload'][$index]->image_id = $image_id;
                }
            }
            $redirect_to = post('redirect_to');
            if ($redirect_to) {
                redirect($redirect_to);
            } else if (!empty($response)) {
                echo $response['upload'][0]->url;
            } else
                echo "Cannot upload file.";
            exit;
        }
    }

    function admin_view_images()
    {
        $this->data['images'] = $this->Files->get_list(array('order_by' => 'created_dtm DESC'));
        $this->load_file(ABSOLUTE_PATH . 'assets/plugins/ckeditor/plugins/imageuploader/imgbrowser.php');
    }

    function optimize_all_images()
    {
        $output = get('output', 0);
        $offset = get('offset', -1);
        $limit = get('limit', 0);
        $params = array('order_by' => 'created_dtm DESC');
        if ($offset > -1 && $limit) {
            $params['offset'] = $offset;
            $params['limit'] = $limit;
        }
        $images = $this->Files->get_list($params);

        if (!empty($images)) {
            require_once(ABSOLUTE_PATH . 'includes/jqueryfileupload/UploadHandler.php');
            $upload_handler = new UploadHandler(array(), false);
            foreach ($images as $image_data) {
                $image_path = get_upload_path() . $image_data['filename'];
                if (file_exists($image_path)) {
                    if (!$upload_handler->is_valid_image_file($image_path))
                        continue;
                    $upload_handler->runImageOptimizer($image_path);
                    if ($output)
                        echo $image_path . '<br/>';
                } else {
                    $image_path = get_image_path($image_data);
                    if (file_exists($image_path)) {
                        if (!$upload_handler->is_valid_image_file($image_path))
                            continue;
                        $upload_handler->runImageOptimizer($image_path);
                        if ($output)
                            echo $image_path . '<br/>';
                    }
                }

                foreach ($upload_handler->get_image_versions() as $version => $options) {
                    if (!empty($version)) {
                        $file_version_path = get_image_path($image_data, $version);
                        if (file_exists($file_version_path)) {
                            $upload_handler->runImageOptimizer($file_version_path);
                            if ($output)
                                echo $file_version_path . '<br/>';
                        }
                    }
                }
            }
        }
    }

    function admin_delete_image()
    {
        $image_id = post('image_id');
        if (empty($image_id) || !is_numeric($image_id))
            $this->_error('Mã hình ảnh không đúng. Vui lòng tải lại trang!!');

        $image_data = $this->Files->get_details($image_id);
        if (!$image_data)
            $this->_error('Mã hình ảnh không đúng. Vui lòng tải lại trang!!');

        require_once(ABSOLUTE_PATH . 'includes/jqueryfileupload/UploadHandler.php');
        $upload_handler = new UploadHandler(array(), false);

        $file_path = get_image_path($image_data);
        $success = is_file($file_path) && unlink($file_path);
        foreach ($upload_handler->get_image_versions() as $version => $options) {
            if (!empty($version)) {
                $file = get_image_path($image_data, $version);
                if (is_file($file))
                    unlink($file);
            }
        }

        $this->Files->delete($image_id);
        $this->_ok();
    }

    function generate_new_images()
    {
        if (get('code') != 'ef2013')
            return;
        $type = get('type');
        $files = $this->Files->get_list(array('order_by' => 'id'));
        $count = 0;
        if ($files) {
            require_once(ABSOLUTE_PATH . 'includes/jqueryfileupload/UploadHandler.php');
            $upload_handler = new UploadHandler(array(
                'upload_dir' => get_upload_path(),
                'upload_url' => get_upload_url(),
                'param_name' => 'upload',
                'print_response' => false
            ), false);

            foreach ($files as $f) {
                foreach ($upload_handler->get_image_versions() as $version => $options) {
                    if (!empty($version)) {
                        if (!empty($type) && $version != $type)
                            continue;

                        $file_path = get_image_path($f, $version);
                        if (!file_exists($file_path)) {
                            try {
                                $success = $upload_handler->gd_create_scaled_image($f['filename'], $version, $options);
                                $count++;
                            } catch (Exception  $e) {
                                // Do nothing
                                echo "Cannot create /$version/" . $f['filename'] . '<br/>';
                            }
                        }
                    }
                }
            }
        }
        if ($count)
            echo "$count images are created.";
        else
            echo 'No images are created.';
    }

    function add_ip()
    {
        $user = Users::get_logged_user();
        if (!$user)
            die('Bạn chưa đăng nhập, vui lòng đăng nhập.');
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
            $existed = eModel::_select_one('allowed_ips', array('ip' => $ip));
            if ($existed)
                echo "<h2>IP của bạn " . $ip . " đã có trong danh sách cho phép.</h2>";
            else if (eModel::_insert('allowed_ips', array('ip' => $ip, 'user_id' => $user['user_id'], 'created_dtm' => date('Y-m-d H:i:s'))))
                echo "<h2>IP của bạn " . $ip . " đã được thêm vào danh sách cho phép.</h2>";
        }
        die;
    }

    function admin_update_announcement()
    {
        $fields = array(
            'name', 'start_dtm', 'end_dtm', 'temporary_close',
            'has_sales_time', 'start_sales_time', 'end_sales_time',
            'is_promotion', 'promotion_image', 'promotion_link',
            'enabled', 'image', 'content', 'content_en'
        );
        $required_fields = array('name', 'content');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
            if (in_array($f, array('start_dtm', 'end_dtm'))) {
                if ($data[$f]) {
                    $data[$f] = convert_to_iso_datetime($data[$f]);
                    if ($f == 'start_dtm') {
                        $start_time = post('start_time');
                        if ($start_time)
                            $data[$f] .= " $start_time:00";
                        else
                            $data[$f] .= " 00:00:00";
                    } elseif ($f == 'end_dtm') {
                        $end_time = post('end_time');
                        if ($end_time)
                            $data[$f] .= " $end_time:00";
                        else
                            $data[$f] .= " 23:59:00";
                    }
                } else
                    $data[$f] = null;
            } else if (in_array($f, array('start_sales_time', 'end_sales_time'))) {
                $data[$f] .= ':00';
            }
        }
        $this->_beginTransaction();
        $id = post('id');
        if ($id) {
            $announcement = $this->Announcements->get_details($id);
            if (!$announcement)
                $this->_error('Mã thông báo không chính xác. Vui lòng tải lại trang!!');
            $success = $this->Announcements->update($id, $data);
        } else {
            $data['created_by'] = $this->logged_user['user_id'];
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $this->Announcements->insert($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function manage_backend()
    {
        set_session_val('is_frontend', 0);
        redirect();
    }

    function manage_frontend()
    {
        set_session_val('is_frontend', 1);
        redirect();
    }

    function switch_menu()
    {
        $menu_type = get('menu_type');
        if (empty($menu_type))
            $menu_type = 'general';
        else {
            $menu_code = array(
                'chung' => 'general',
                'hang-ban' => 'selling',
                'kho' => 'inventory',
                'khach-hang' => 'customer',
                'nhan-su' => 'staff',
                'giao-dien' => 'frontend'
            );
            $menu_type = isset($menu_code[$menu_type]) ? $menu_code[$menu_type] : 'general';
        }
        set_session_val('menu_type', $menu_type);
        redirect();
    }

    function admin_search_salary_advance()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "salary_advances.date_time BETWEEN '$filter_start_date' AND '$filter_end_date 23:59:59'";
        else if ($filter_start_date)
            $where_str = "salary_advances.date_time >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "salary_advances.date_time <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        $this->data['records'] = $this->Salaryadvances->get_list($filter_arr);
        $this->return['html'] = $this->load_view('salary_advance/list', 1);
        $this->_ok();
    }

    function admin_update_salary_advance()
    {
        $this->_beginTransaction();
        $salary_advance_id = post('salary_advance_id');
        $fields = $required_fields = array('date_time', 'amount', 'user_id');
        $fields[] = 'description';
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $data['date_time'] = convert_to_iso_datetime($data['date_time'], 'd/m/Y H:i');
        $data['created_by'] = Users::get_userdata('user_id');;
        if ($salary_advance_id) {
            $success = $this->Salaryadvances->update($salary_advance_id, $data);
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $this->Salaryadvances->insert($data);
            $assigned_member = $this->Users->get_details($data['user_id']);
            if (!empty($assigned_member['email'])) {
                $body = include2string(ABSOLUTE_PATH . 'email_templates/salary_advances_notification_member.php', array('amount' => $data['amount'], 'member' => $assigned_member));
                SendMail('sender@' . DOMAIN_NAME, $assigned_member['email'], get_setting('site_name') . ' - Thông tin tạm ứng', $body, get_setting('site_name') . ' - Shop management system');
            }
            if ($success && !empty($assigned_member)) {
                $body = include2string(ABSOLUTE_PATH . 'email_templates/salary_advances_notification_admin.php', array('amount' => $data['amount'], 'member' => $assigned_member));
                SendMail('sender@' . DOMAIN_NAME, 'hr@' . DOMAIN_NAME, get_setting('site_name') . ' - Thông tin tạm ứng', $body, get_setting('site_name') . ' - Shop management system');
            }
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_update_settings()
    {
        $data = array();
        $settings = eModel::_select('settings', array('is_hide' => 0));
        if ($settings) {
            $this->_beginTransaction();
            foreach ($settings as $s) {
                $val = post($s['option_name'], '-1');
                if ($val != -1) {
                    $success = set_setting($s['option_name'], $val);
                    if (!$success)
                        $this->_error('Có lỗi xảy ra. Không thể lưu!!');
                } elseif ($s['field_type'] == 'boolean') {
                    $success = set_setting($s['option_name'], 0);
                    if (!$success)
                        $this->_error('Có lỗi xảy ra. Không thể lưu!!');
                }
                $val = post($s['option_name'] . '_en', '-1');
                if ($val != -1) {
                    $success = set_setting($s['option_name'], $val, 'en');
                    if (!$success)
                        $this->_error('Có lỗi xảy ra. Không thể lưu!!');
                }
            }
        }
        $this->_ok();
    }

    function admin_search_promotion_codes()
    {
        $filter_start_date = post('filter_start_date');
        $filter_end_date = post('filter_end_date');
        if ($filter_start_date)
            $filter_start_date = convert_to_iso_datetime($filter_start_date);
        if ($filter_end_date)
            $filter_end_date = convert_to_iso_datetime($filter_end_date);

        if ($filter_start_date && $filter_end_date)
            $where_str = "((start_date <= '$filter_start_date' AND end_date >= '$filter_start_date 23:59:59') OR (start_date >= '$filter_start_date' AND start_date <= '$filter_end_date 23:59:59'))";
        else if ($filter_start_date)
            $where_str = "start_date >= '$filter_start_date'";
        else if ($filter_end_date)
            $where_str = "end_date <= '$filter_end_date 23:59:59'";

        $filter_arr = array();

        if ($where_str)
            $filter_arr['where'] = $where_str;
        $this->data['promotion_codes'] = $this->Promotioncodes->get_list($filter_arr);
        $this->return['html'] = $this->load_view('promotion_code/list', 1);
        $this->_ok();
    }

    function admin_update_promotion_code()
    {
        $this->_beginTransaction();
        $promotion_code_id = post('promotion_code_id');
        $fields = $required_fields = array('start_date', 'end_date', 'discount', 'code');
        $fields[] = 'description';
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
            if ($f == 'discount') {
                $data[$f] = $data[$f] / 100;
                if ($data[$f] <= 0 || $data[$f] > 1)
                    $this->_error('Giá trị giảm giá không hợp lệ (phải lớn hơn 0 và nhỏ 100)');
            }
        }
        $data['start_date'] = convert_to_iso_datetime($data['start_date'], 'd/m/Y H:i');
        $data['end_date'] = convert_to_iso_datetime($data['end_date'], 'd/m/Y H:i');
        if ($promotion_code_id) {
            $success = $this->Promotioncodes->update($promotion_code_id, $data);
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $this->Promotioncodes->insert($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_generate_promotion_code()
    {
        $code = random_string(5, 0, 1);
        while ($existed_code = $this->Promotioncodes->select(array('code' => $code))) {
            $code = random_string(5, 0, 1);
        }
        $this->return['code'] = $code;
        $this->_ok();
    }

    function admin_update_branch()
    {
        $this->_beginTransaction();
        $fields = $required_fields = array('branch_name', 'branch_address', 'short_address', 'en_address', 'phone_number', 'lat', 'lng');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }
        $data['branch_address'] = capitalize($data['branch_address']);
        $data['modified_by'] = $this->logged_user['user_id'];
        $branch_id = post('branch_id', LHP_BRANCH_ID);
        if ($branch_id) {
            $success = $this->Branches->update($branch_id, $data);
        } else {
            $data['created_dtm'] = date('Y-m-d H:i:s');
            $success = $this->Branches->insert($data);
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_save_note_for_processing_screen()
    {
        $note = post('note');
        $branch_id = post('branch_id', LHP_BRANCH_ID);
        $where_arr = array();
        if ($branch_id)
            $where_arr['id'] = $branch_id;
        $this->Branches->update($where_arr, array('note_on_processing_screen' => $note));
        $this->return["branch_id"] = $branch_id;
        $this->return["note"] = nl2br($note);
        $this->_ok();
    }

    function admin_assign_order_to_branch()
    {
        $order_id = post('order_id');
        $branch_id = post('branch_id');
        if (empty($branch_id))
            $branch_id = LHP_BRANCH_ID;
        $in_process = post('in_process');
        $distance = post('distance', -1);
        $update_data = array('branch_id' => $branch_id);
        if ($in_process)
            $update_data['status'] = 'In Process';
        $order = $this->Orders->get_details($order_id);

        if (!empty($order['shipping_info'])) {
            $booking_info = json_decode($order['shipping_info']);
            if ($distance > 0) {
                $total = $order['total'] - $order['shipping_fee'];
                $new_fee = cal_shipping_fee($total, isset($booking_info['district']) ? $booking_info['district'] : null, $distance);
                $update_data['total'] = $total + $new_fee;
                $update_data['shipping_fee'] = $new_fee;
            }
            if ($booking_info && $distance > 0) {
                $booking_info->distance = $distance;
                $update_data['shipping_info'] = json_encode($booking_info, JSON_UNESCAPED_UNICODE);
            }
        }

        $this->Orders->update(array('id' => $order_id), $update_data);
        if ($branch_id == LHP_BRANCH_ID && $this->logged_user['branch_id'] != LHP_BRANCH_ID) {
            if ($order['code'] && $order['code'] != $order['id']) {
                $in_process = $order['status'] == 'In Process';
                if ($in_process && 0) {
                    /* Send an email to order2 mail box*/
                    $subject = 'Đơn hàng đã xác nhận - ' . $order['code'];
                    $params = array(
                        'order' => $order,
                        'controller' => $this
                    );
                    $body = include2string(ABSOLUTE_PATH . 'email_templates/admin_assign_order_notification.php', $params);
                    $to_mails = 'order2@' . DOMAIN_NAME;
                    SendMail('sender@' . DOMAIN_NAME, $to_mails, $subject, $body, get_setting('site_name') . ' - Order online');
                }
            }
        }
        $this->_ok();
    }

    function admin_update_provider()
    {
        $this->_beginTransaction();
        $fields = array(
            'provider_name', 'provider_type', 'provider_address', 'mobile', 'description', 'lat', 'lng', 'email',
            'bank_name', 'bank_account_name', 'bank_account_number', 'type', 'company_name', 'company_tax_code', 'company_address', 'VAT_rate'
        );
        $required_fields = array('provider_name', 'provider_type', 'provider_address', 'mobile');
        $data = array();
        foreach ($fields as $f) {
            $data[$f] = post($f, in_array($f, $this->boolean_fields) ? 0 : '');
            if (in_array($f, $required_fields) && empty($data[$f]))
                $this->_error('Vui lòng nhập đầy đủ thông tin bắt buộc!!');
        }

        if (strpos($data['mobile'], '0') !== 0)
            $data['mobile'] = '0' . $data['mobile'];

        if (intval($data['mobile']) == 0)
            $data['mobile'] = 0;

        $data['provider_name'] = capitalize($data['provider_name']);
        $data['provider_address'] = capitalize($data['provider_address']);
        $provider_id = post('provider_id');
        if ($provider_id) {
            $success = $this->Providers->update($provider_id, $data);
        } else {
            $customer_existed = $this->Providers->select(array('mobile' => $data['mobile'], 'deleted' => 0));
            if (!$customer_existed || $data['mobile'] == 0) {
                $data['created_dtm'] = date('Y-m-d H:i:s');;
                $success = $this->Providers->insert($data);
            } else
                $this->_error('Số điện thoại đã được sử dụng. Vui lòng kiểm tra lại!!');
        }

        if (!$success)
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        $this->_ok();
    }

    function admin_update_efruit_note()
    {
        $order_id = post('pk');
        $order = $this->Orders->get_details($order_id);
        if ($order) {
            $note = urldecode(post('value'));
            $this->Orders->update($order_id, array('efruit_note' => $note));
            $customer = $this->Customers->get_details($order['customer_id']);
            if ($customer) {
                if (strtotime($customer['last_order_dtm']) <= strtotime($order['delivery_date'])) {
                    $this->Customers->update($order['customer_id'], array('last_note' => $note, 'last_order_dtm' => $order['delivery_date']));
                }
            }
        } else {
            $this->_error('Có lỗi xảy ra. Không thể lưu!!');
        }
        $this->_ok();
    }

    function update_phpBB_user($user_id, $updated_data)
    {
        if (!defined('SSO_FORUM') || !SSO_FORUM)
            return;
        $user = $this->Users->get_details($user_id);
        if ($user) {
            $user = array_merge($user, $updated_data);
            $data = array(
                'user_type' => $user['type_id'] == SUPER_ADMIN_TYPE_ID ? 3 : 0,
                'group_id' => $user['type_id'] == SUPER_ADMIN_TYPE_ID ? 5 : 2,
                'username' => $user['username'],
                'username_clean' => $user['username'],
                'user_password' => '$ef$' . $user['password'],
                'user_email' => $user['email'],
                'user_new' => 0,
                'user_style' => 1,
                'from_efruit' => $user_id
            );
            if ($user['deleted']) {
                /* Ignore user */
                $data['user_type'] = 2;
            }
            if ($user['enabled'] == 0) {
                /* Inactive user */
                $data['user_type'] = 1;
            }
            $bb_user = $this->PhpBBUsers->select_one(array('username' => $user['username']));
            if ($bb_user) {
                $this->PhpBBUsers->update($bb_user['user_id'], $data);
            } else {
                $data['user_sig'] = '';
                $data['user_permissions'] = '00000000000v667wt0\nhwby9w000000\nm6awadqmx0qo\nm6b8xhqmx0qo\nzik0zjqmx0qo';
                $this->PhpBBUsers->insert($data);
            }
        }
    }

    function phpBB_login($username, $password, $admin = false)
    {
        if (!defined('SSO_FORUM') || !SSO_FORUM)
            return;
        global $user, $auth, $phpbb_log;
        if (empty($user)) {
            return false;
        }

        // Make sure user->setup() has been called
        if (!$user->is_setup()) {
            $user->setup();
        }

        if ($user->data['user_id'] == ANONYMOUS) {
            $admin         = ($admin) ? 1 : 0;
            $viewonline = 1;

            // If authentication is successful we redirect user to previous page
            $result = $auth->login($username, $password, 1, $viewonline, $admin);

            // If admin authentication and login, we will log if it was a success or not...
            // We also break the operation on the first non-success login - it could be argued that the user already knows
            if ($admin) {
                if ($result['status'] == LOGIN_SUCCESS) {
                    $phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_ADMIN_AUTH_SUCCESS');
                } else {
                    // Only log the failed attempt if a real user tried to.
                    // anonymous/inactive users are never able to go to the ACP even if they have the relevant permissions
                    if ($user->data['is_registered']) {
                        $phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_ADMIN_AUTH_FAIL');
                    }
                }
            }
            // Something failed, determine what...
            if ($result['status'] == LOGIN_BREAK) {
                trigger_error($result['error_msg']);
            }
        }
    }

    function login_forum()
    {
        global $user, $auth;
        if (empty($user)) {
            redirect(ROOT_URL . 'forum');
        }
        $username = $this->logged_user['username'];
        $password = base64_decode(retrieve_id(get_session_val('e_password')));
        $admin = $this->logged_user['type_id'] == SUPER_ADMIN_TYPE_ID;

        // Make sure user->setup() has been called
        if (!$user->is_setup()) {
            $user->setup();
        }

        if ($user->data['user_id'] == ANONYMOUS) {
            $admin         = ($admin) ? 1 : 0;
            $viewonline = 1;
            $result = $auth->login($username, $password, 1, $viewonline, $admin);
            if ($result['status'] == LOGIN_SUCCESS) {
                redirect(ROOT_URL . 'forum');
            } else {
                set_last_error('Không thể đăng nhập forum', null);
                redirect(BASE_URL);
            }
        } else {
            redirect(ROOT_URL . 'forum');
        }
    }

    function admin_update_out_of_stock()
    {
        $id = post('id');
        if (empty($id))
            $this->_error('ID không hợp lệ. Không thể lưu!!');

        $item = $this->Inventoryitemdetails->get_details($id);
        if (empty($id))
            $this->_error('ID không chính xác. Không thể lưu!!');

        $this->_beginTransaction();
        $value = post('value');
        $rs = $this->Inventoryitemdetails->update($id, array('out_of_stock' => $value));
        if (!$rs)
            $this->_error('Không thể lưu. Vui lòng liên hệ admin!!');

        if ($value) {
            $this->ProductComponents->update(array(
                'item_id' => $id
            ), array(
                'active' => 0
            ));

            /* Get all important components */
            $components = $this->ProductComponents->get_components(array(
                'important' => 1,
                'item_id' => $id
            ));
            if ($components) {
                foreach ($components as $comp) {
                    $this->Products->update($comp['product_id'], array(
                        'enabled' => 0
                    ));
                }
            }
            /* Check if all components are out of stock */
            $sql = 'SELECT DISTINCT product_id 
                FROM product_components 
                WHERE product_id NOT IN(SELECT pc.product_id FROM product_components pc WHERE product_components.product_id = pc.product_id AND pc.active = 1)';
            $rs = eModel::_do_sql($sql);
            if ($rs) {
                foreach ($rs as $row) {
                    $this->Products->update($row['product_id'], array(
                        'enabled' => 0
                    ));
                }
            }
        } else {
            $this->ProductComponents->update(array(
                'item_id' => $id,
                'important' => 1,
            ), array(
                'active' => 1
            ));
            /* Check if all important components are active */
            $sql = 'SELECT DISTINCT product_id 
                FROM product_components 
                WHERE important = 1 AND active = 1 
                AND product_id NOT IN(SELECT pc.product_id FROM product_components pc WHERE product_components.product_id = pc.product_id AND pc.important = 1 AND pc.active = 0)';
            $rs = eModel::_do_sql($sql);
            if ($rs) {
                foreach ($rs as $row) {
                    $this->Products->update($row['product_id'], array(
                        'enabled' => 1,
                        'hidden' => 0
                    ));
                }
            }
        }
        $this->_ok();
    }

    private function _admin_update_single_price($product_id, $price)
    {
        $price_table_name = 'prices';
        $where_params = array(
            'product_id' => $product_id,
            'deleted' => '0'
        );
        $existed = eModel::_select($price_table_name, $where_params);
        if ($existed)
            $success = eModel::_update($price_table_name, $where_params, array('price' => $price));
        else {
            $price_types = $this->Prices->get_price_types();
            if (!empty($price_types)) {
                $now = date('Y-m-d H:i:s');
                $params = $where_params;
                $params['price'] = $price;
                $params['created_dtm'] = $now;
                foreach ($price_types as $price_type) {
                    $params['type_id'] = $price_type['type_id'];
                    $success = eModel::_insert($price_table_name, $params);
                }
            }
        }
        if (!$success)
            return false;

        $product = $this->Products->get_details($product_id);
        if ($product && $product['is_additional']) {
            $belongs_to = substr($product['belongs_to'], 1, strlen($product['belongs_to']) - 2);
            if ($belongs_to)
                eModel::_update('products', array('where' => "product_id IN ($belongs_to)"), array('set' => 'modified_dtm = NOW()'));
        }

        return true;
    }

    function admin_load_menu()
    {
        $menu_id = post('menu_id');
        if (!is_numeric($menu_id))
            $this->_error('ID menu không hợp lệ.');
        $menu = $this->Menus->get_details($menu_id);

        if ($menu)
            $this->return['menu'] = $menu;
        else
            $this->_error('ID menu không hợp lệ.');
        $this->_ok();
    }

    function admin_save_menu()
    {
        $menu_id = post('menu_id');
        if (!is_numeric($menu_id))
            $this->_error('ID menu không hợp lệ.');
        $success = $this->Menus->update($menu_id, array('items' => post('items')));
        if (!$success) {
            $this->_error('Có lỗi xảy ra. Không thể lưu menu.');
        }
        $this->_ok();
    }

    function admin_save_blockhome()
    {
        $type_theme = post('type_block');
        $category_id = post('category_id');
        $product_id = post('product_id');


        if ($type_theme !== '3') {
            if (empty($product_id)) {
                $this->_error('Có ít nhất 1 sản phẩm được chọn.');
            }

            foreach ($product_id as $item) {
                if (!is_numeric($item)) {
                    $this->_error('Product id không hợp lệ.');
                }
            }
        } else {
            $product_id = null;
        }
        if (!is_numeric($type_theme) && !is_numeric($category_id)) {
            $this->_error('Mẫu id và loại id không hợp lệ.');
        }
        //Truy vấn xem dữ liệu có hay chưa, nếu chưa thì thêm mới, ngược lại thì update
        $table_name = "block_homepage";
        $where_params = array(
            'type_block' => $type_theme,
            // 'category_id' => $category_id
        );
        $dataOld = eModel::_select($table_name, $where_params);
        $arrayProducts = [];
        //Nếu dataOld là null
        if (empty($dataOld)) {
            $products_id = null;
            if ($product_id !== null) {
                foreach ($product_id as $item) {
                    array_push($arrayProducts, $item);
                }
                $products_id = json_encode($arrayProducts);
            }
            $success = $this->Blockhomepage->insert(array(
                'type_block' => $type_theme,
                'category_id' => $category_id,
                'products_id' =>  $products_id,
            ));
        }

        //Ngược lại 
        else {

            $products_id = null;
            if ($product_id !== null) {
                foreach ($product_id as $item) {
                    array_push($arrayProducts, $item);
                }
                $products_id = json_encode($arrayProducts);
            }

            if (strlen($category_id) === 0) {
                $category_id = null;
            }
            $arrayData = array(
                'category_id' => $category_id,
                'products_id' =>  $products_id,
            );
            $this->Blockhomepage->update($dataOld[0]['id'], $arrayData);
        }
        $this->_ok();
    }


    function admin_add_new_blockhomepage()
    {
        $type_theme = post('type_block');
        $category_id = post('category_id');
        $product_id = post('product_id');


        if ($type_theme !== '3') {
            if (empty($product_id)) {
                $this->_error('Có ít nhất 1 sản phẩm được chọn.');
            }

            foreach ($product_id as $item) {
                if (!is_numeric($item)) {
                    $this->_error('Product id không hợp lệ.');
                }
            }
        } else {
            $product_id = null;
        }
        if (!is_numeric($type_theme) && !is_numeric($category_id)) {
            $this->_error('Mẫu id và loại id không hợp lệ.');
        }
        //Truy vấn xem dữ liệu có hay chưa, nếu chưa thì thêm mới, ngược lại thì update
        $table_name = "block_homepage";
        $where_params = array(
            'type_block' => $type_theme,
            // 'category_id' => $category_id
        );
        $dataOld = eModel::_select($table_name, $where_params);
        $arrayProducts = [];
        //Nếu dataOld là null
        if (empty($dataOld)) {
            $products_id = null;
            if ($product_id !== null) {
                foreach ($product_id as $item) {
                    array_push($arrayProducts, $item);
                }
                $products_id = json_encode($arrayProducts);
            }
            $success = $this->Blockhomepage->insert(array(
                'type_block' => $type_theme,
                'category_id' => $category_id,
                'products_id' =>  $products_id,
            ));
        }

        //Ngược lại 
        else {

            $products_id = null;
            if ($product_id !== null) {
                foreach ($product_id as $item) {
                    array_push($arrayProducts, $item);
                }
                $products_id = json_encode($arrayProducts);
            }

            if (strlen($category_id) === 0) {
                $category_id = null;
            }
            $arrayData = array(
                'category_id' => $category_id,
                'products_id' =>  $products_id,
            );
            $this->Blockhomepage->update($dataOld[0]['id'], $arrayData);
        }
        $this->_ok();
    }
}
/* End of PostbackController class */
