<?php

/**
 *
 * -------------------------------------------------------
 * Classname:        Customers
 * Generation date:  18/01/2015
 * Baseclass:        BaseCustomers
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH . 'models/base/BaseCustomers.php');

/**
 * Class declaration
 */
class Customers extends BaseCustomers
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Customers';
    }

    function get_list($filters = array(), $order_by = 'customer_name')
    {
        $sql = 'SELECT customers.*, customer_types.short_name as short_type, customer_types.long_name as long_type, COUNT(orders.id) as number_of_order
                FROM customers 
                INNER JOIN orders ON orders.customer_id = customers.customer_id
                INNER JOIN customer_types ON customer_types.type_id = customers.type_id';
        $filters['customers.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), $order_by, 'customers.customer_id');
    }

    function get_list_for_selling($filters = array(), $order_by = 'customer_name')
    {
        $sql = 'SELECT customers.customer_id, customers.customer_name, customers.address, customers.district, customers.description,
                      customers.mobile, customers.email, customers.lat, customers.lng, customers.is_locked, customers.free_ship, customers.deleted,
                      customers.building, customers.total_paid, customers.last_note, customers.company_name, customers.company_tax_code, customers.company_address, 
                      customers.exchange_points, COUNT(orders.id) as number_of_order, DATE_FORMAT(customers.last_order_dtm,"%d/%m/%Y %H:%i") as last_order_dtm
                FROM customers
                INNER JOIN orders ON orders.customer_id = customers.customer_id';
        return self::_do_sql($sql, $filters, array(), $order_by, 'customers.customer_id');
    }

    function get_customer_types($filters = array(), $deleted = 0)
    {
        if ($deleted != -1)
            $filters['deleted'] = $deleted;
        return self::_select('customer_types', $filters, 'type_id');
    }

    function get_list_customer_email_account($email)
    {
        $order_by = 'customers.email';
        $email = eModel::matchRegexEmail($email);
        $sql = "SELECT customers.* FROM customers WHERE BINARY(email_account) = '" . $email . "'    ";
        $filters = "";
        return self::_do_sql($sql, $filters, array(), $order_by);
    }

    function get_list_customer_username($username)
    {
        $order_by = 'customers.username';
        $username = eModel::matchRegexLogin($username);
        var_dump($username);
        $sql = "SELECT customers.* FROM customers WHERE BINARY(username) = '" . $username . "' ";
        $filters = "";
        return self::_do_sql($sql, $filters, array(), $order_by);
    }

    function get_list_customer_email_username($email, $username)
    {
        $filters = "";
        $order_by = '';
        $email = eModel::matchRegexEmail($email);
        $username = eModel::matchRegexLogin($username);
        $sql = "SELECT customers.* FROM customers WHERE BINARY(email) = '" . $email . "' OR BINARY(username) = '" . $username . "'   ";
        return self::_do_sql($sql, $filters, array(), $order_by);
    }


    function get_customerID($username)
    {
        $order_by = 'customers.customer_id';
        $username = eModel::matchRegexLogin($username);
        $sql = "SELECT customers.* FROM customers WHERE BINARY(username) = '" . $username . "' ";
        $filters = "";
        $result = self::_do_select_sql($sql, $filters, array(), $order_by);
        $customer_id = 0;
        if(!empty($result)){
            foreach ($result as $key) {
                $customer_id = $key['customer_id'];
            }
            return $customer_id;
        }
        else{
            return $customer_id;
        }
        //  return self::_do_sql($sql, $filters, array(), $order_by);
    }

    //Hàm thực hiện việc tìm kiếm xem cột mobile đó select ra username và lấy customer_id   
    function get_listOrder_mobile_username($mobile){
        $order_by = 'customers.customer_id';
        $sql = "SELECT customers.* FROM customers WHERE mobile = '" . $mobile . "' ";
        $filters = "";
        $result = self::_do_select_sql($sql, $filters, array(), $order_by);
        $customer_id = 0;
        if(!empty($result)){
            foreach ($result as $key) {
                if(!empty($key['username'])){
                    $customer_id = $key['customer_id'];
                    return $customer_id;
                }
            }
            return $customer_id;
        }
        else{
            return $customer_id;
        }
        //  return self::_do_sql($sql, $filters, array(), $order_by);
    }


    function get_history_order_customer_completed()
    {
        if (isset($_SESSION['user_account'][0]['customer_id'])) {
            $id = $_SESSION['user_account'][0]['customer_id'];
            $order_by = '';
            $sql = "SELECT orders.created_dtm as ngayTao, orders.code as code FROM `customers` INNER JOIN orders 
            ON orders.customer_id = customers.customer_id 
            WHERE orders.customer_id = '" . $id . "' AND orders.status = 'Completed' ORDER BY orders.created_dtm DESC ";
            if (!empty($sql)) {
                $filters = "";
                return self::_do_sql($sql, $filters, array(), $order_by);
            } else {
                echo "<script>window.location.href='/vi'</script>";
            }
        } else {
            return null;
        }
    }

    function get_history_order_customer_unfinished(){
        if (isset($_SESSION['user_account'][0]['customer_id'])) {
            $id = $_SESSION['user_account'][0]['customer_id'];
            $order_by = '';
            $sql = "SELECT orders.created_dtm as ngayTao, orders.code as code FROM `customers` INNER JOIN orders 
            ON orders.customer_id = customers.customer_id 
            WHERE orders.customer_id = '" . $id . "' AND orders.status != 'Completed' ORDER BY orders.created_dtm ASC ";
            if (!empty($sql)) {
                $filters = "";
                return self::_do_sql($sql, $filters, array(), $order_by);
            } else {
                echo "<script>window.location.href='/vi'</script>";
            }
        } else {
            return null;
        }
    }


    /* Foody customers */
    function get_id_or_create($name, $address, $customer_type_id = '', $mobile = '')
    {
        $filters = array(
            'customer_name' => $name,
            'address' => $address
        );
        if ($customer_type_id)
            $filters['type_id'] = $customer_type_id;
        $customer = $this->select_one($filters);
        if ($customer)
            return $customer['customer_id'];
        $data = array(
            'customer_name' => $name,
            'address' => $address,
            'created_dtm' => date('Y-m-d H:i:s')
        );
        if ($mobile)
            $data['mobile'] = $mobile;
        if ($customer_type_id)
            $data['type_id'] = $customer_type_id;
        $customer_id = $this->insert($data);
        return $customer_id ? $customer_id : null;
    }
}
/* End of generated class */
