<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Salaryadvances
 * Generation date:  19/04/2016
 * Baseclass:        BaseSalaryadvances
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseSalaryadvances.php');

/**
 * Class declaration
 */
class Salaryadvances extends BaseSalaryadvances
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Salaryadvances';
    }
    
    function get_list($filters = array(), $order_by = 'salary_advances.date_time DESC')
    {
        $sql = "SELECT salary_advances.*, users.fullname
                FROM salary_advances 
                INNER JOIN users ON users.user_id = salary_advances.user_id";
        return self::_do_sql($sql, $filters, array(), $order_by);
    }
    
    function get_total_amount($user_id, $filters = array())
    {
        $f = array('select' => 'SUM(amount) as total_amount');
        if (!empty($filters)){
            extract($filters);
            if ($filter_day && $filter_month && $filter_year)
            {
                $filter_date = sprintf('%d-%02d-%02d', $filter_year, $filter_month, $filter_day);
                $f['where'] = " DATE(date_time) = '$filter_date' ";
            }
            elseif($filter_month && $filter_year)
            {
                //$f['where'] = " MONTH(date_time) = '$filter_month' AND YEAR(date_time) = '$filter_year'";
                /* From 6th of selected month to 5th of next month */
                $from_date = sprintf('%d-%02d-06', $filter_year, $filter_month);
                $next_month = $filter_month + 1;
                if ($next_month > 12){
                    $next_month = $next_month - 12;
                    $to_date = sprintf('%d-%02d-06',($filter_year+1),$next_month);
                }else{
                    $to_date = sprintf('%d-%02d-06',$filter_year,$next_month);
                }
                $f['where'] = " DATE(date_time) >= '$from_date' AND DATE(date_time) < '$to_date'";
            }
        }
        $f['user_id'] = $user_id;
        $total = $this->select_one($f);
        return $total?$total['total_amount']:0;
    }
}
/* End of generated class */
