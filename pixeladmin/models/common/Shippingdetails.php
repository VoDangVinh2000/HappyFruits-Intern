<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Shippingdetails
 * Generation date:  20/01/2015
 * Baseclass:        BaseShippingdetails
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseShippingdetails.php');

/**
 * Class declaration
 */
class Shippingdetails extends BaseShippingdetails
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Shippingdetails';
    }
    
    function get_list($filters = array(), $order_by = 'date_time desc')
    {
        $sql = 'SELECT shipping_details.*, customers.customer_name, customers.address, customers.district, customers.mobile, users.username, orders.code
                FROM shipping_details 
                LEFT JOIN customers ON customers.customer_id = shipping_details.customer_id 
                INNER JOIN users ON users.user_id = shipping_details.user_id
                LEFT JOIN orders ON orders.id = shipping_details.order_id AND orders.deleted = 0';
        return self::_do_sql($sql, $filters, '', $order_by);
    }
    
    function get_salary_for_delivery($user_id, $filter = array())
    {
        global $shipping_cost, $shipping_cost2;
        $rs = 0;
        
        $shipping_details = $this->shipped_by($user_id, $filter);

        if ($shipping_details)
        {
            foreach($shipping_details as $item)
            {
                $number_of_dishes = $item['number_of_dishes'];
                if ($number_of_dishes == 1) {
                    foreach($shipping_cost2 as $min_total => $value)
                    {
                        if ($item['total'] >= $min_total)
                        {
                            $rs += $value;
                            break;
                        }
                    }
                } else {
                    $distance = $item['distance'];
                    $distance_table = '';
                    foreach($shipping_cost as $min_dishes => $row)
                    {
                        if ($number_of_dishes >= $min_dishes)
                        {
                            $distance_table = $row;
                            break;
                        }
                    }
                    if ($distance_table)
                    {
                        foreach($distance_table as $min_distance => $value)
                        {
                            if ($distance >= $min_distance)
                            {
                                $rs += $value;
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $rs;
    }
    
    function get_statistics_data($filters)
    {
        extract($filters);
        if ($start_date && $end_date)
            $where_str = "shipping_details.created_dtm >= '$start_date 00:00:00' AND shipping_details.created_dtm <= '$end_date 23:59:00'";
        else if($start_date)
            $where_str = "shipping_details.created_dtm >= '$start_date 00:00:00'";
        else if($end_date)
            $where_str = "shipping_details.created_dtm <= '$end_date 23:59:00'";
        else
            $where_str = '1=1';
            
        if (!empty($member_id))
            $where_str .= " AND shipping_details.user_id = $member_id";
        $sql = "SELECT shipping_details.user_id, users.username, users.fullname, SUM(shipping_details.distance) AS total_distance, COUNT(shipping_details.id) AS total_order 
                FROM shipping_details
                INNER JOIN users ON users.user_id = shipping_details.user_id
                WHERE $where_str
                GROUP BY shipping_details.user_id
                ORDER BY total_distance DESC";
        return self::_do_sql($sql);
    }

    function shipped_by($user_id, $filter = array())
    {
        $filter_arr = array('user_id' => $user_id);
        if (!empty($filter)){
            extract($filter);
            if ($filter_day && $filter_month && $filter_year)
            {
                $filter_date = "$filter_year-$filter_month-$filter_day";
                $filter_arr['where'] = " MONTH(date_time) = '$filter_date' ";
            }
            elseif($filter_month && $filter_year)
            {
                $filter_arr['where'] = " MONTH(date_time) = '$filter_month' AND YEAR(date_time) = '$filter_year'";
            }
        }

        return $this->select($filter_arr);
    }
}
/* End of generated class */
