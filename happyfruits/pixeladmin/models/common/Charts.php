<?php
/* http://www.goncaloqueiros.net/highcharts.php */

require_once(ABSOLUTE_PATH. 'includes/highcharts/Highchart.php');
require_once(ABSOLUTE_PATH. 'models/common/Orders.php');
require_once(ABSOLUTE_PATH. 'models/common/Costs.php');

/**
 * Class declaration
 */
class Charts
{
    var $class_name;
    var $filters;
    var $start_date;
    var $end_date;
    var $start_date_lbl;
    var $end_date_lbl;
    var $start_tt;
    var $end_tt;
    var $start_date_arr = array();
    var $end_date_arr = array();
    static $cached = array();
    var $day_of_week_lbl = array('', 'Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7');
    var $excluding_cat_ids = array(CAKES_CAT_ID, RAW_FRUIT_CAT_ID);

    public static $chart_ids = array(
        'customers' => array(
            'name' => 'Khách hàng',
            'charts' => array(
                'customers_line_chart' => 'col-lg-12'
            )
        ),
        'products' => array(
            'name' => 'Sản phẩm',
            'charts' => array(
                'top_selling_products_column_chart' => 'col-lg-12'
            )
        ),
        'sales' => array(
            'name' => 'Doanh số chi tiết',
            'charts' => array(
                'total_sales_chart' => 'col-lg-12',
                'total_by_order_types_pie_chart' => 'col-lg-6',
                'total_by_days_pie_chart' => 'col-lg-6'
            )
        ),
        'orders' => array(
            'name' => 'Đơn hàng chi tiết',
            'charts' => array(
                'total_orders_line_chart' => 'col-lg-12',
                'total_orders_by_time_pie_chart' => 'col-lg-12'
            )
        ),
        'raw_fruits' => array(
            'name' => 'Trái cây Kg',
            'charts' => array(
                'raw_fruit_total_per_months_column_chart' => 'col-lg-12 no-filter',
                'raw_fruit_total_per_weeks_column_chart' => 'col-lg-12',
                'raw_fruit_total_sales_chart' => 'col-lg-12'
            )
        ),
        'cakes_and_other' => array(
            'name' => 'Bánh Tea Break và Ăn Vặt',
            'charts' => array(
                'cakes_total_per_months_column_chart' => 'col-lg-12 no-filter',
                'cakes_total_per_weeks_column_chart' => 'col-lg-12',
                'cakes_total_sales_chart' => 'col-lg-12'
            )
        ),
    );

    public static $charts_config = array(
        'raw_fruit_total_per_months_column_chart' => array(
            'type' => 'get_total_per_months_chart_by_category',
            'cat_id' => RAW_FRUIT_CAT_ID,
            'cat_name' => 'Trái cây Kg'
        ),
        'raw_fruit_total_per_weeks_column_chart' => array(
            'type' => 'get_total_per_weeks_chart_by_category',
            'cat_id' => RAW_FRUIT_CAT_ID,
            'cat_name' => 'Trái cây Kg'
        ),
        'raw_fruit_total_sales_chart' => array(
            'type' => 'get_total_sales_chart_by_category',
            'cat_id' => RAW_FRUIT_CAT_ID,
            'cat_name' => 'Trái cây Kg'
        ),
        'cakes_total_per_months_column_chart' => array(
            'type' => 'get_total_per_months_chart_by_category',
            'cat_id' => CAKES_CAT_ID,
            'cat_name' => 'Bánh và Ăn vặt'
        ),
        'cakes_total_per_weeks_column_chart' => array(
            'type' => 'get_total_per_weeks_chart_by_category',
            'cat_id' => CAKES_CAT_ID,
            'cat_name' => 'Bánh và Ăn vặt'
        ),
        'cakes_total_sales_chart' => array(
            'type' => 'get_total_sales_chart_by_category',
            'cat_id' => CAKES_CAT_ID,
            'cat_name' => 'Bánh và Ăn vặt'
        ),
    );

    function __construct()
    {
        $this->class_name = 'Charts';
        $this->order = new Orders();
        $this->order_types = $this->order->get_order_types(array('show_in_statistics' => 1));

	    $this->cost = new Costs();
	    $this->cost_types = $this->cost->get_types();
    }
    
    function _get_cached($key)
    {
        return isset(self::$cached[$key])?self::$cached[$key]:null;
    }
    
    function _set_cached($key, $val)
    {
        self::$cached[$key] = $val;
    }
    
    function _get_key($type = '')
    {
        return md5($this->start_tt.$this->end_tt.$type);
    }
    
    function _get_dates($filters = array())
    {
        $this->filters = $filters;
        $this->start_date = START_DATE;
        if (!empty($filters['start_date']))
            $this->start_date = convert_to_iso_datetime($filters['start_date']);
        $this->end_date = date('Y-m-d');
        if (!empty($filters['end_date']))
            $this->end_date = convert_to_iso_datetime($filters['end_date']);
        $this->start_tt = strtotime($this->start_date);
        $this->end_tt = strtotime($this->end_date);
        $this->start_date_lbl = date('d/m/Y', $this->start_tt);
        $this->end_date_lbl = date('d/m/Y', $this->end_tt);
        $this->start_date_arr = explode('-', $this->start_date);
        $this->end_date_arr = explode('-', $this->end_date);
    }

    /* Week will start from Monday to Sunday*/
    function _get_first_date_of_week($timestam, $format = 'Y-m-d')
    {
        $processing_date = date('Y-m-d', $timestam);
        $w_day = date('w', $timestam) - 1;
        if($w_day < 0)
            $w_day = 6;
        return date($format, strtotime($processing_date." -$w_day days"));


    }

    function _get_last_date_of_week($timestam, $format = 'Y-m-d')
    {
        $processing_date = date('Y-m-d', $timestam);
        $w_day = date('w', $timestam) - 1;
        if($w_day < 0)
            $w_day = 6;
        $w_day = 6 - $w_day;
        return date($format, strtotime($processing_date." -$w_day days"));
    }
    
    function _get_filter_date_string($field = 'td.db_date', $start_date = '', $end_date = '')
    {
        if(empty($start_date))
            $start_date = $this->start_date;
        if(empty($end_date))
            $end_date = $this->end_date;

        $where_str = '';
        if (!empty($this->filters['shift']) && strstr($field, 'delivery_date'))
        {
            $start_h = '00:00:00';
            $end_h = '23:59:59';
            if ($this->filters['shift'])
            {
                if ($this->filters['shift'] == 1)
                {
                    $end_h = SHIFT_SEPARATOR_TIME.':00';
                }
                else if($this->filters['shift'] == 2)
                {
                    $start_h = SHIFT_SEPARATOR_TIME.':01';
                }
            }
            if ($start_date && $end_date)
                $where_str = "($field BETWEEN '$start_date' AND '$end_date 23:59:59') AND (DATE_FORMAT($field,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
            else if($start_date)
                $where_str = "$field >= '$start_date' AND (DATE_FORMAT($field,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
            else if($end_date)
                $where_str = "$field <= '$end_date 23:59:59' AND (DATE_FORMAT($field,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
            
        }
        else
        {
            if ($start_date && $end_date)
                $where_str = "$field >= '$start_date 00:00:00' AND $field <= '$end_date 23:59:00'";
            else if($start_date)
                $where_str = "$field >= '$start_date 00:00:00'";
            else if($end_date)
                $where_str = "$field <= '$end_date 23:59:00'";
        }
        if (!empty($this->filters['branch_id']))
            $where_str .= ($where_str?' AND ':''). 'branch_id = '.$this->filters['branch_id'];
        return $where_str;
    }
    
    function _get_total_sales_data()
    {
        $key = $this->_get_key('total_sales');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array(
                'total' => array(),
                'Tổng đơn hàng' => array(),
            );
            if ($this->order_types)
                foreach($this->order_types as $type)
                    $data[$type['type_name']] = array();

            $where_str = $this->_get_filter_date_string();
            $sql = "SELECT td.db_date, SUM(orders.total - orders.VAT*orders.total) as total,
                            COUNT(orders.id) as number_of_orders";
            if ($this->order_types)
                foreach($this->order_types as $type)
                    $sql .= ', COUNT(IF(orders.type_id='.$type['id'].',1,NULL)) as number_of_type'.$type['id'].'';
              
            $sql .=" FROM time_dimension td 
                    LEFT JOIN orders ON DATE(orders.delivery_date) = td.db_date AND (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed'
                    WHERE $where_str
                    GROUP BY td.db_date 
                    ORDER BY td.db_date";
            $rs = eModel::_do_sql($sql);

            if ($rs)
            {
                /* Excluding categories */
                $sql = "SELECT td.db_date, SUM(order_items.total - orders.discount/orders.total*order_items.total) as total
                    FROM time_dimension td 
                    INNER JOIN orders ON DATE(orders.delivery_date) = td.db_date AND (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed'
                    INNER JOIN order_items ON order_items.order_id = orders.id AND order_items.deleted = 0
                    INNER JOIN products ON products.product_id = order_items.product_id AND products.category_id IN (".implode(',', $this->excluding_cat_ids).") 
                    WHERE $where_str
                    GROUP BY td.db_date 
                    ORDER BY td.db_date";
                $rs_excluding_total = eModel::_do_sql($sql);
                $total_excl = array();
                if($rs_excluding_total){
                    foreach($rs_excluding_total as $r_raw)
                    {
                        $total_excl[$r_raw['db_date']] = floatval($r_raw['total']);
                    }
                }
                foreach($rs as $r)
                {
                    $total = $r['total'] - (isset($total_excl[$r['db_date']])?$total_excl[$r['db_date']]:0);
                    $data['total'][] = round($total*1000);
                    $data['Tổng đơn hàng'][] = intval($r['number_of_orders']);
                    if ($this->order_types)
                        foreach($this->order_types as $type)
                            $data[$type['type_name']][] = intval($r['number_of_type'.$type['id']]);
                }  
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }
    
    function get_total_by_order_types_data()
    {
        $key = $this->_get_key('total_by_order_types');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array();
            $where_str = $this->_get_filter_date_string('orders.delivery_date');
            $sql = "SELECT order_types.type_name, SUM(orders.total - orders.VAT*orders.total) as total
                    FROM order_types 
                    LEFT JOIN orders ON orders.type_id = order_types.id AND order_types.deleted = 0  AND (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed'
                    WHERE $where_str
                    GROUP BY order_types.id 
                    ORDER BY order_types.sequence_number";
            $rs = eModel::_do_sql($sql);
            if ($rs)
                $data = $rs;
            $this->_set_cached($key, $data);
            return $data;
        }
    }
    
    function get_total_by_days_data()
    {
        $key = $this->_get_key('total_by_days');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array();
            $where_str = $this->_get_filter_date_string('orders.delivery_date');
            $sql = "SELECT  DAYOFWEEK(orders.delivery_date) as day_of_week, SUM(orders.total - orders.VAT*orders.total) as total
                    FROM orders
                    WHERE $where_str AND orders.deleted = 0  AND orders.`status` != 'Failed'
                    GROUP BY DAYOFWEEK(orders.delivery_date)";
            $rs = eModel::_do_sql($sql);
            if ($rs)
                $data = $rs;
            $this->_set_cached($key, $data);
            return $data;
        }
    }
    
    function get_top_selling_products_data($limit = 20)
    {
        $key = $this->_get_key('top_selling_products');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array();
            $where_str = $this->_get_filter_date_string('order_items.created_dtm');
            $sql = "SELECT products.name, SUM(order_items.quantity) as number_of_products
                    FROM products 
                    LEFT JOIN order_items ON order_items.product_id = products.product_id AND products.deleted = 0 AND (order_items.deleted = 0 OR ISNULL(order_items.deleted)) 
                    LEFt JOIN orders ON orders.id = order_items.order_id AND orders.`status` != 'Failed'
                    WHERE $where_str
                    GROUP BY products.product_id 
                    ORDER BY number_of_products DESC
                    LIMIT $limit";
            $rs = eModel::_do_sql($sql);
            
            if ($rs)
            {
                foreach($rs as $r)
                    $data[] = array($r['name'], intval($r['number_of_products']));
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }
    
    function get_kpi_data()
    {
        $key = $this->_get_key('kpi');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $where_str = $this->_get_filter_date_string();
            $data = array();
            $sql = "SELECT td.db_date, assessment.kpi
                    FROM time_dimension td 
                    LEFT JOIN assessment ON assessment.assessment_date = td.db_date AND assessment.user_id = ".$this->filters['user_id']."
                    WHERE $where_str
                    ORDER BY td.db_date";
            $rs = eModel::_do_sql($sql);
            if ($rs)
            {
                foreach($rs as $r)
                {
                    $data[] = $r['kpi']?intval($r['kpi']):0;
                }
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }
    
    function _get_total_per_months_data()
    {
        $key = $this->_get_key('total_per_months');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array(
                0 => array(),
                1 => array(),
                2 => array(),
                3 => array(),
                4 => array(),
                'other' => array()
            );
            $start_tt = $this->start_tt;
            while($start_tt <= $this->end_tt)
            {
                $month = date('n', $start_tt).'/'.date('Y', $start_tt);
                $start_tt = strtotime('+1 month', $start_tt);
                $data[0][$month] = 0;
                $data[1][$month] = 0;
                $data[2][$month] = 0;
                $data[3][$month] = 0;
                $data[4][$month] = 0;
                $data['other'][$month] = 0;
            }
            $where_str = $this->_get_filter_date_string('orders.delivery_date');
            $sql = "SELECT order_types.id as type, MONTH(orders.delivery_date) as month, YEAR(orders.delivery_date) as year, SUM(orders.total - orders.VAT*orders.total) as total
                    FROM orders 
                    INNER JOIN order_types ON orders.type_id = order_types.id
                    WHERE (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed' AND $where_str
                    GROUP BY order_types.id, MONTH(orders.delivery_date), YEAR(orders.delivery_date)";
            $rs = eModel::_do_sql($sql);
            if ($rs)
            {
                /* Excluding categories */
                $sql = "SELECT order_types.id as type, MONTH(orders.delivery_date) as month, YEAR(orders.delivery_date) as year, SUM(order_items.total - orders.discount/orders.total*order_items.total) as total
                    FROM orders 
                    INNER JOIN order_types ON orders.type_id = order_types.id
                    INNER JOIN order_items ON order_items.order_id = orders.id AND order_items.deleted = 0
                    INNER JOIN products ON products.product_id = order_items.product_id AND products.category_id IN (".implode(',', $this->excluding_cat_ids).") 
                    WHERE (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed' AND $where_str
                    GROUP BY order_types.id, MONTH(orders.delivery_date), YEAR(orders.delivery_date)";
                $rs_excluding_total = eModel::_do_sql($sql);
                $total_excl = array(
                    0 => array()
                );
                if($rs_excluding_total){
                    foreach($rs_excluding_total as $record)
                    {
                        if(!isset($total_excl[$record['type']]))
                            $total_excl[$record['type']] = array();
                        if(!isset($total_excl[$record['type']][$record['month'].'/'.$record['year']]))
                            $total_excl[$record['type']][$record['month'].'/'.$record['year']] = 0;
                        $total_excl[$record['type']][$record['month'].'/'.$record['year']] += floatval($record['total']);
                        if(!isset($total_excl[0][$record['month'].'/'.$record['year']]))
                            $total_excl[0][$record['month'].'/'.$record['year']] = 0;
                        $total_excl[0][$record['month'].'/'.$record['year']] += floatval($record['total']);
                    }
                }

                foreach($rs as $record)
                {
                    $total_excl_r = !empty($total_excl[$record['type']][$record['month'].'/'.$record['year']])?$total_excl[$record['type']][$record['month'].'/'.$record['year']]:0;
                    $total = round(($record['total'] - $total_excl_r)*1000);
                    if ($record['type'] <= 3)
                        $data[$record['type']][$record['month'].'/'.$record['year']] = $total;
                    elseif($record['type'] == 8)
                        $data[4][$record['month'].'/'.$record['year']] = $total;
                    else
                        $data['other'][$record['month'].'/'.$record['year']] += $total;
                    $data[0][$record['month'].'/'.$record['year']] += $total;
                }
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }
    
    function _get_customers_data()
    {
        $key = $this->_get_key('customers');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array();
            $where_str = $this->_get_filter_date_string();
            $sql = "SELECT td.db_date ,
                        COUNT(IF(customers.created_dtm IS NOT NULL AND DATE(customers.created_dtm)<td.db_date,1,NULL)) as number_of_old_customer ,
                        COUNT(IF(DATE(customers.created_dtm)=td.db_date,1,NULL)) as number_of_new_customer
                    FROM time_dimension td 
                    LEFT JOIN orders ON DATE(orders.delivery_date) = td.db_date AND (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed'
                    LEFT JOIN customers ON customers.customer_id = orders.customer_id AND (customers.deleted = 0 OR ISNULL(customers.deleted))
                    WHERE $where_str
                    GROUP BY td.db_date 
                    ORDER BY td.db_date";
            $rs = eModel::_do_sql($sql);
            
            if ($rs)
            {
                $data = array(
                    'Khách hàng cũ' => array(),
                    'Khách hàng mới' => array(),
                );
                foreach($rs as $r)
                {
                    $data['Khách hàng cũ'][] = floatval($r['number_of_old_customer']);
                    $data['Khách hàng  mới'][] = intval($r['number_of_new_customer']);
                }  
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }  
    
    function _get_number_of_order_by_types_data()
    {
        $key = $this->_get_key('number_of_order_by_types');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array();
            $where_str = $this->_get_filter_date_string('orders.delivery_date');
            $sql = "SELECT order_types.type_name, COUNT(orders.id) as total
                    FROM order_types 
                    LEFT JOIN orders ON orders.type_id = order_types.id AND order_types.deleted = 0 AND (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed'
                    WHERE $where_str
                    GROUP BY order_types.id 
                    ORDER BY order_types.sequence_number";
            $rs = eModel::_do_sql($sql);
            if ($rs)
                $data = $rs;
            $this->_set_cached($key, $data);
            return $data;
        }
    }  
    
    function total_sales_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = 'total_sales_chart';
        $chart->chart->zoomType = 'x';
        $chart->chart->spacingRight = 20;
        $chart->title->text = "Doanh số từ $this->start_date_lbl đến $this->end_date_lbl";
        $chart->subtitle->text = new HighchartJsExpr("'Nhấn và kéo để phóng to xem chi tiết'");
        $chart->xAxis->type = 'datetime';
        $chart->xAxis->maxZoom = 14 * 24 * 3600000; // fourteen days
        $chart->xAxis->title->text = null;
        $chart->yAxis->title->text = 'Doanh số';
        $chart->yAxis->min = 0;
        $chart->yAxis->startOnTick = false;
        $chart->yAxis->showFirstLabel = false;
        $chart->tooltip->shared = true;
        $chart->legend->enabled = false;
        $chart->plotOptions->area->fillColor->linearGradient = array(
            0,
            0,
            0,
            300
        );
        $chart->plotOptions->area->fillColor->stops = array(
            array(
                0,
                new HighchartJsExpr("Highcharts.getOptions().colors[0]")
            ),
            array(
                1,
                new HighchartJsExpr("Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')")
            )
        );
        $chart->plotOptions->area->lineWidth = 1;
        $chart->plotOptions->area->marker->enabled = false;
        $chart->plotOptions->area->marker->states->hover->enabled = true;
        $chart->plotOptions->area->marker->states->hover->radius = 5;
        $chart->plotOptions->area->shadow = false;
        $chart->plotOptions->area->states->hover->lineWidth = 1;
        
        $pointInterval = 24 * 3600 * 1000;
        $pointStart = new HighchartJsExpr("Date.UTC(".$this->start_date_arr[0].", ".($this->start_date_arr[1]-1).", ".$this->start_date_arr[2].")");
        $sales_data = $this->_get_total_sales_data();
        
        $chart->series[] = array(
            'type' => 'area',
            'name' => 'Doanh số',
            'pointInterval' => $pointInterval,
            'pointStart' => $pointStart,
            'data' => $sales_data['total']
        );
        return $chart;
    }
    
    function total_orders_line_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = 'total_orders_line_chart';
        $chart->chart->zoomType = 'x';
        $chart->chart->spacingRight = 20;
        $chart->title->text = "Đơn hàng từ $this->start_date_lbl đến $this->end_date_lbl";
        $chart->subtitle->text = new HighchartJsExpr("'Nhấn và kéo để phóng to xem chi tiết'");
        $chart->xAxis->type = 'datetime';
        $chart->xAxis->maxZoom = 14 * 24 * 3600000; // fourteen days
        $chart->xAxis->title->text = null;
        $chart->yAxis->title->text = 'Số đơn hàng';
        $chart->yAxis->min = 0;
        $chart->yAxis->startOnTick = false;
        $chart->yAxis->showFirstLabel = false;
        $chart->tooltip->shared = true;
        $chart->legend->enabled = true;
        
        $pointInterval = 24 * 3600 * 1000;
        $pointStart = new HighchartJsExpr("Date.UTC(".$this->start_date_arr[0].", ".($this->start_date_arr[1]-1).", ".$this->start_date_arr[2].")");
        $data = $this->_get_total_sales_data();
        if ($data)
        {
            unset($data['total']);
            foreach($data as $key => $values)
            {
                $chart->series[] = array(
                    'type' => 'line',
                    'name' => $key,
                    'pointInterval' => $pointInterval,
                    'pointStart' => $pointStart,
                    'data' => $data[$key]
                );
            }
        }
        return $chart;
    }
    
    function total_by_order_types_pie_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();
        
        $chart->chart->renderTo = "total_by_order_types_pie_chart";
        $chart->chart->plotBackgroundColor = null;
        $chart->chart->plotBorderWidth = null;
        $chart->chart->plotShadow = false;
        $chart->chart->type = 'pie';
        $chart->chart->options3d = array(
            'enabled' => true,
            'alpha' => 45,
            'beta' => 0
        );
        if ($this->start_date_lbl != $this->end_date_lbl)
            $chart->title->text = "Doanh số theo loại đơn hàng từ $this->start_date_lbl đến $this->end_date_lbl";
        else
            $chart->title->text = "Doanh số theo loại đơn hàng ngày $this->start_date_lbl";
        
        $chart->tooltip->pointFormat = '<b>{point.name}</b>: {point.y} | {point.percentage:.2f} %';
        
        $chart->plotOptions->pie->allowPointSelect = 1;
        $chart->plotOptions->pie->cursor = "pointer";
        $chart->plotOptions->pie->depth = 35;
        $chart->plotOptions->pie->dataLabels->enabled = 1;
        $chart->plotOptions->pie->dataLabels->color = "#000000";
        $chart->plotOptions->pie->dataLabels->connectorColor = "#000000";
        $chart->plotOptions->pie->dataLabels->format = '<b>{point.name}</b>: {point.percentage:.2f} %';
        
        $chart->series[] = array(
            'type' => "pie",
            'name' => "Theo loại"
        );
        
        $data = $this->get_total_by_order_types_data();
        if ($data)
        {
            $chart->series[0]->data = array();
            $series_data = array();
            $sum = 0;
            foreach($data as $row){
                $sum += intval($row['total']);
                $series_data[] = array($row['type_name'], intval($row['total']));
            }
            if($sum)
                $chart->series[0]->data = $series_data;
        }
        return $chart;
    }
    
    function total_by_days_pie_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();
        
        $chart->chart->renderTo = "total_by_days_pie_chart";
        $chart->chart->plotBackgroundColor = null;
        $chart->chart->plotBorderWidth = null;
        $chart->chart->plotShadow = false;
        $chart->chart->options3d = array(
            'enabled' => true,
            'alpha' => 45,
            'beta' => 0
        );
        $chart->title->text = "Doanh số theo ngày trong tuần từ $this->start_date_lbl đến $this->end_date_lbl";
        
        $chart->tooltip->pointFormat = '<b>{point.name}</b>: {point.y} | {point.percentage:.2f} %';
        
        $chart->plotOptions->pie->allowPointSelect = 1;
        $chart->plotOptions->pie->cursor = "pointer";
        $chart->plotOptions->pie->depth = 35;
        $chart->plotOptions->pie->dataLabels->enabled = 1;
        $chart->plotOptions->pie->dataLabels->color = "#000000";
        $chart->plotOptions->pie->dataLabels->connectorColor = "#000000";
        $chart->plotOptions->pie->dataLabels->format = '<b>{point.name}</b>: {point.percentage:.2f} %';
        
        $chart->series[] = array(
            'type' => "pie",
            'name' => "Theo ngày"
        );
        
        $data = $this->get_total_by_days_data();
        if ($data)
        {
            $chart->series[0]->data = array();
            $series_data = array();
            $sum = 0;
            foreach($data as $row){
                $sum += intval($row['total']);
                $series_data[] = array($this->day_of_week_lbl[$row['day_of_week']], intval($row['total']));
            }
            if($sum)
                $chart->series[0]->data = $series_data;
        }
        return $chart;
    }
    
    function top_selling_products_column_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();

        $chart->chart->renderTo = "top_selling_products_column_chart";
        $chart->chart->type = "column";
        $chart->chart->margin = array(
            50,
            50,
            100,
            80
        );
        $chart->title->text = "20 hàng hóa bán nhiều nhất từ $this->start_date_lbl đến $this->end_date_lbl";
        
        $chart->xAxis->type = 'category';
        $chart->xAxis->labels->rotation = - 45;
        $chart->xAxis->labels->align = "right";
        $chart->xAxis->labels->style->font = "normal 13px Verdana, sans-serif";
        $chart->yAxis->min = 0;
        $chart->yAxis->title->text = "Số lượng bán";
        $chart->legend->enabled = false;
        
        $chart->tooltip->pointFormat = "Số lượng: <b>{point.y}</b>";
        
        $chart->series[] = array(
            'name' => 'Population',
            'data' => $this->get_top_selling_products_data(),
            'dataLabels' => array(
                'enabled' => true,
                'rotation' => - 90,
                'color' => '#FFFFFF',
                'align' => 'right',
                'x' => - 3,
                'y' => 10,
                'formatter' => new HighchartJsExpr(
                    "function() {return this.y;}"),
                'style' => array(
                    'font' => 'normal 13px Verdana, sans-serif'
                )
            )
        );
        return $chart;
    }
    
    function kpi_area_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = 'kpi_area_chart';
        $chart->chart->zoomType = 'x';
        $chart->chart->spacingRight = 20;
        $chart->title->text = "Điểm KPI từ $this->start_date_lbl đến $this->end_date_lbl";
        $chart->subtitle->text = new HighchartJsExpr("'Nhấn và kéo để phóng to xem chi tiết'");
        $chart->xAxis->type = 'datetime';
        $chart->xAxis->maxZoom = 31 * 24 * 3600000; 
        $chart->xAxis->title->text = null;
        $chart->yAxis->title->text = 'Điểm KPI';
        $chart->yAxis->min = 0;
        $chart->yAxis->startOnTick = false;
        $chart->yAxis->showFirstLabel = false;
        $chart->tooltip->shared = true;
        $chart->legend->enabled = false;
        $chart->plotOptions->area->fillColor->linearGradient = array(
            0,
            0,
            0,
            300
        );
        $chart->plotOptions->area->fillColor->stops = array(
            array(
                0,
                new HighchartJsExpr("Highcharts.getOptions().colors[0]")
            ),
            array(
                1,
                new HighchartJsExpr("Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')")
            )
        );
        $chart->plotOptions->area->lineWidth = 1;
        $chart->plotOptions->area->marker->enabled = false;
        $chart->plotOptions->area->marker->states->hover->enabled = true;
        $chart->plotOptions->area->marker->states->hover->radius = 5;
        $chart->plotOptions->area->shadow = false;
        $chart->plotOptions->area->states->hover->lineWidth = 1;
        
        $pointInterval = 24 * 3600 * 1000;
        $pointStart = new HighchartJsExpr("Date.UTC(".$this->start_date_arr[0].", ".($this->start_date_arr[1]-1).", ".$this->start_date_arr[2].")");
        $data = $this->get_kpi_data();
        
        $chart->series[] = array(
            'type' => 'line',
            'name' => 'Điểm KPI',
            'pointInterval' => $pointInterval,
            'pointStart' => $pointStart,
            'data' => $data
        );
        return $chart;
    }
    
    function total_per_months_column_chart($filters = array())
    {
        $filters['start_date'] = date('1/m/Y', strtotime('-11 month'));
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = "total_per_months_column_chart";
        $chart->chart->type = "column";
        $chart->title->text = "Doanh số theo tháng từ $this->start_date_lbl đến $this->end_date_lbl";
        
        $months = array();
        $start_tt = $this->start_tt;
        while($start_tt <= $this->end_tt){
            $months[] = date('m', $start_tt).'/'.date('Y', $start_tt);
            $start_tt = strtotime('+1 month', $start_tt);
        }
        $chart->xAxis->categories = $months;
        $chart->yAxis->min = 0;
        $chart->yAxis->title->text = "Doanh số";
        $chart->legend->layout = "vertical";
        $chart->legend->backgroundColor = "#FFFFFF";
        $chart->legend->align = "left";
        $chart->legend->verticalAlign = "top";
        $chart->legend->x = 100;
        $chart->legend->y = 70;
        $chart->legend->floating = 1;
        $chart->legend->shadow = 1;

        $chart->plotOptions->column->pointPadding = 0.2;
        $chart->plotOptions->column->borderWidth = 0;
        
        $data = $this->_get_total_per_months_data();
        $chart->series[] = array(
            'name' => "Tổng",
            'data' => array_values($data[0])
        );
        $chart->series[] = array(
            'name' => "Tại chỗ",
            'data' => array_values($data[1])
        );
        
        $chart->series[] = array(
            'name' => "Mang về",
            'data' => array_values($data[2])
        );
        
        $chart->series[] = array(
            'name' => "Giao hàng",
            'data' => array_values($data[3])
        );

        $chart->series[] = array(
            'name' => "Foody",
            'data' => array_values($data[4])
        );
        
        $chart->series[] = array(
            'name' => "Khác",
            'data' => array_values($data['other'])
        );
        return $chart;
    }
    
    function customers_line_chart($filters = array())
    {
        $filters['start_date'] = date('d/m/Y', strtotime('-1 month'));
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = 'customers_line_chart';
        $chart->chart->zoomType = 'x';
        $chart->chart->spacingRight = 20;
        $chart->title->text = "Khách hàng từ $this->start_date_lbl đến $this->end_date_lbl";
        $chart->subtitle->text = new HighchartJsExpr("'Nhấn và kéo để phóng to xem chi tiết'");
        $chart->xAxis->type = 'datetime';
        $chart->xAxis->maxZoom = 14 * 24 * 3600000; // fourteen days
        $chart->xAxis->title->text = null;
        $chart->yAxis->title->text = 'Số khách hàng';
        $chart->yAxis->min = 0;
        $chart->yAxis->startOnTick = false;
        $chart->yAxis->showFirstLabel = false;
        $chart->tooltip->shared = true;
        $chart->legend->enabled = false;
        
        $pointInterval = 24 * 3600 * 1000;
        $pointStart = new HighchartJsExpr("Date.UTC(".$this->start_date_arr[0].", ".($this->start_date_arr[1]-1).", ".$this->start_date_arr[2].")");
        $data = $this->_get_customers_data($filters);
        if ($data)
        {
            foreach($data as $key => $values)
            {
                $chart->series[] = array(
                    'type' => 'line',
                    'name' => $key,
                    'pointInterval' => $pointInterval,
                    'pointStart' => $pointStart,
                    'data' => $data[$key]
                );
            }
        }
        return $chart;
    }
    
    function number_of_order_by_types_pie_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();
        
        $chart->chart->renderTo = "number_of_order_types_pie_chart";
        $chart->chart->plotBackgroundColor = null;
        $chart->chart->plotBorderWidth = null;
        $chart->chart->plotShadow = false;
        $chart->chart->options3d = array(
            'enabled' => true,
            'alpha' => 45,
            'beta' => 0
        );
        if ($this->start_date_lbl != $this->end_date_lbl)
            $chart->title->text = "Đơn hàng từ $this->start_date_lbl đến $this->end_date_lbl";
        else
            $chart->title->text = "Đơn hàng ngày $this->start_date_lbl";
        
        $chart->tooltip->pointFormat = '<b>{point.name}</b>: {point.y} | {point.percentage:.2f} %';
        
        $chart->plotOptions->pie->allowPointSelect = 1;
        $chart->plotOptions->pie->cursor = "pointer";
        $chart->plotOptions->pie->depth = 35;
        $chart->plotOptions->pie->dataLabels->enabled = 1;
        $chart->plotOptions->pie->dataLabels->color = "#000000";
        $chart->plotOptions->pie->dataLabels->connectorColor = "#000000";
        $chart->plotOptions->pie->dataLabels->format = '<b>{point.name}</b>: {point.percentage:.2f} %';
        
        $chart->series[] = array(
            'type' => "pie",
            'name' => "Theo loại"
        );
        
        $data = $this->_get_number_of_order_by_types_data();
        if ($data)
        {
            $chart->series[0]->data = array();
            $series_data = array();
            $sum = 0;
            foreach($data as $row){
                $sum += intval($row['total']);
                $series_data[] = array($row['type_name'], intval($row['total']));
            }
            if($sum)
                $chart->series[0]->data = $series_data;
        }
        return $chart;
    }

    function _get_total_orders_by_time_data()
    {
        $key = $this->_get_key('total_orders_by_time');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array();
            $where_str = $this->_get_filter_date_string('orders.delivery_date');
            $time_ranges = array(
                'Trước 10h' => array('start' => '08:00:00', 'end' => '10:00:00'),
                '10h - 12h' => array('start' => '10:00:01', 'end' => '12:00:00'),
                '12h - 13h30' => array('start' => '12:00:01', 'end' => '13:30:00'),
                '13h30 - 16h' => array('start' => '13:30:01', 'end' => '16:00:00'),
                '16h - 17h30' => array('start' => '16:00:01', 'end' => '17:30:00'),
                'Sau 17h30' => array('start' => '17:30:01', 'end' => '23:30:00'),
            );
            foreach($time_ranges as $name => $range){
                $start = $range['start'];
                $end = $range['end'];
                $sql = "SELECT  COUNT(*) total_order
                    FROM orders
                    WHERE $where_str AND orders.deleted = 0 AND orders.`status` != 'Failed' AND orders.type_id = 3 AND (TIME(orders.delivery_date) BETWEEN '$start' AND '$end')";
                $rs = eModel::_do_sql($sql);
                if ($rs)
                    $data[$name] = $rs[0]['total_order'];
                else
                    $data[$name] = 0;
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }

    function total_orders_by_time_pie_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();

        $chart->chart->renderTo = "total_orders_by_time_pie_chart";
        $chart->chart->plotBackgroundColor = null;
        $chart->chart->plotBorderWidth = null;
        $chart->chart->plotShadow = false;
        $chart->chart->options3d = array(
            'enabled' => true,
            'alpha' => 45,
            'beta' => 0
        );
        $chart->title->text = "Đơn giao hàng theo giờ từ $this->start_date_lbl đến $this->end_date_lbl";

        $chart->tooltip->pointFormat = '<b>{point.name}</b>: {point.y} | {point.percentage:.2f} %';

        $chart->plotOptions->pie->allowPointSelect = 1;
        $chart->plotOptions->pie->cursor = "pointer";
        $chart->plotOptions->pie->depth = 35;
        $chart->plotOptions->pie->dataLabels->enabled = 1;
        $chart->plotOptions->pie->dataLabels->color = "#000000";
        $chart->plotOptions->pie->dataLabels->connectorColor = "#000000";
        $chart->plotOptions->pie->dataLabels->format = '<b>{point.name}</b>: {point.percentage:.2f} %';

        $chart->series[] = array(
            'type' => "pie",
            'name' => "Theo giờ"
        );

        $data = $this->_get_total_orders_by_time_data();
        if ($data)
        {
            $chart->series[0]->data = array();
            $series_data = array();
            $sum = 0;
            foreach($data as $name => $total_orders){
                $total = intval($total_orders);
                if (!$total) continue;
                $sum += $total;
                $series_data[] = array($name, $total);
            }
            $chart->series[0]->data = $series_data;
        }
        return $chart;
    }

    function _get_total_orders_by_distance_data()
    {
        $key = $this->_get_key('total_orders_by_distance');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $ranges = array(
                'Dưới 1km' => array('min' => 0, 'max' => 1),
                '1km - 3km' => array('min' => 1, 'max' => 3),
                '3km - 5km' => array('min' => 3, 'max' => 5),
                '5km - 7km' => array('min' => 5, 'max' => 7),
                'Trên 7km' => array('min' => 7, 'max' => 20),
            );
            $data = array();
            foreach($ranges as $name => $r){
                $data[$name] = array();
            }
            $start_tt = $this->start_tt;
            while($start_tt <= $this->end_tt)
            {
                $month = date('n', $start_tt).'/'.date('Y', $start_tt);
                $start_tt = strtotime('+1 month', $start_tt);
                foreach($ranges as $name => $r){
                    $data[$name][$month] = 0;
                }
            }
            $where_str = $this->_get_filter_date_string('shipping_details.date_time');
            foreach($ranges as $name => $r) {
                $min = $r['min'];
                $max = $r['max'];
                $sql = "SELECT MONTH(shipping_details.date_time) as month, YEAR(shipping_details.date_time) as year, COUNT(shipping_details.id) as total_shipped_orders
                    FROM shipping_details
                    WHERE $where_str AND shipping_details.distance >= $min AND shipping_details.distance < $max
                    GROUP BY MONTH(shipping_details.date_time), YEAR(shipping_details.date_time)";
                $rs = eModel::_do_sql($sql);
                if ($rs) {
                    foreach ($rs as $record) {
                        $data[$name][$record['month'] . '/' . $record['year']] += intval($record['total_shipped_orders']);
                    }
                }
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }

    function total_orders_by_distance_column_chart($filters = array())
    {
        $filters['start_date'] = date('1/m/Y', strtotime('-11 month'));
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = "total_orders_by_distance_column_chart";
        $chart->chart->type = "column";
        $chart->title->text = "Đơn hàng theo khoảng cách từ $this->start_date_lbl đến $this->end_date_lbl";

        $months = array();
        $start_tt = $this->start_tt;
        while($start_tt <= $this->end_tt){
            $months[] = date('m', $start_tt).'/'.date('Y', $start_tt);
            $start_tt = strtotime('+1 month', $start_tt);
        }
        $chart->xAxis->categories = $months;
        $chart->yAxis->min = 0;
        $chart->yAxis->title->text = "Số đơn hàng";
        $chart->legend->layout = "vertical";
        $chart->legend->backgroundColor = "#FFFFFF";
        $chart->legend->align = "left";
        $chart->legend->verticalAlign = "top";
        $chart->legend->x = 100;
        $chart->legend->y = 70;
        $chart->legend->floating = 1;
        $chart->legend->shadow = 1;

        $chart->plotOptions->column->pointPadding = 0.2;
        $chart->plotOptions->column->borderWidth = 0;

        $data = $this->_get_total_orders_by_distance_data();
        foreach($data as $name => $total_order_values){
            $chart->series[] = array(
                'name' => $name,
                'data' => array_values($total_order_values)
            );
        }
        return $chart;
    }


	function _get_costs_by_time_data()
	{
		$key = $this->_get_key('costs_by_time');
		$data = $this->_get_cached($key);
		if ($data !== null)
			return $data;
		else
		{
			$data = array();
			/*
			$where_str1 = $this->_get_filter_date_string('date_time');
            $where_str2 = $this->_get_filter_date_string('import_date');
			$sql = "SELECT cost_types.name, SUM(costs.amount) as total
                    FROM cost_types 
                    LEFT JOIN costs ON costs.type_id = cost_types.id 
                    LEFT JOIN inventory_import ON inventory_import.id = costs.import_id 
                    WHERE (import_date IS NULL AND $where_str1 ) OR (import_date IS NOT NULL AND $where_str2 )
                    GROUP BY cost_types.id 
                    ORDER BY total DESC";
			$rs = eModel::_do_sql($sql);
			*/
            $where_str = $this->_get_filter_date_string('date_time');
            $sql = "SELECT cost_types.name, SUM(costs.amount) as total
                    FROM cost_types 
                    LEFT JOIN costs ON costs.type_id = cost_types.id 
                    LEFT JOIN inventory_import ON inventory_import.id = costs.import_id 
                    WHERE $where_str AND costs.deleted = 0 
                    GROUP BY cost_types.id 
                    ORDER BY total DESC";
            $rs = eModel::_do_sql($sql);
			if ($rs)
				$data = $rs;
			$this->_set_cached($key, $data);
			return $data;
		}
	}

	function costs_by_time_pie_chart($filters = array())
	{
		$this->_get_dates($filters);
		$chart = new Highchart();

		$chart->chart->renderTo = "costs_by_time_pie_chart";
		$chart->chart->plotBackgroundColor = null;
		$chart->chart->plotBorderWidth = null;
		$chart->chart->plotShadow = false;
		$chart->chart->options3d = array(
			'enabled' => true,
			'alpha' => 45,
			'beta' => 0
		);
		if ($this->start_date_lbl != $this->end_date_lbl)
			$chart->title->text = "Chi phí từ $this->start_date_lbl đến $this->end_date_lbl";
		else
			$chart->title->text = "Chi phí ngày $this->start_date_lbl";

		$chart->tooltip->pointFormat = '<b>{point.name}</b>: {point.y} | {point.percentage:.2f} %';

		$chart->plotOptions->pie->allowPointSelect = 1;
		$chart->plotOptions->pie->cursor = "pointer";
		$chart->plotOptions->pie->depth = 35;
		$chart->plotOptions->pie->dataLabels->enabled = 1;
		$chart->plotOptions->pie->dataLabels->color = "#000000";
		$chart->plotOptions->pie->dataLabels->connectorColor = "#000000";
		$chart->plotOptions->pie->dataLabels->format = '<b>{point.name}</b>: {point.percentage:.2f} %';

		$chart->series[] = array(
			'type' => "pie",
			'name' => "Theo thời gian"
		);

		$data = $this->_get_costs_by_time_data();
		if ($data)
		{
            $chart->series[0]->data = array();
            $series_data = array();
            $sum = 0;
            foreach($data as $row){
                $sum += intval($row['total']);
                $series_data[] = array($row['name'], intval($row['total']));
            }
            if($sum)
                $chart->series[0]->data = $series_data;
		}
		return $chart;
	}
	
	function _get_total_costs_per_months_data()
	{
		$key = $this->_get_key('total_costs_per_months');
		$data = $this->_get_cached($key);
		if ($data !== null)
			return $data;
		else
		{
			$data = array(0 => array());
			if ($this->cost_types){
				foreach($this->cost_types as $type){
					$data[$type['id']] = array();
				}
			}
			$start_tt = $this->start_tt;
			while($start_tt <= $this->end_tt)
			{
				$month = date('n', $start_tt).'/'.date('Y', $start_tt);
				$start_tt = strtotime('+1 month', $start_tt);
				$data[0][$month] = 0;
				if ($this->cost_types){
					foreach($this->cost_types as $type){
						$data[$type['id']][$month] = 0;
					}
				}
			}
			$where_str = $this->_get_filter_date_string('date_time');
			$sql = "SELECT cost_types.id, MONTH(costs.date_time) as month, YEAR(costs.date_time) as year, SUM(costs.amount) as total
                    FROM cost_types 
                    LEFT JOIN costs ON costs.type_id = cost_types.id 
                    LEFT JOIN inventory_import ON inventory_import.id = costs.import_id 
                    WHERE $where_str
                    GROUP BY cost_types.id, MONTH(date_time), YEAR(date_time)";
			$rs = eModel::_do_sql($sql);
			if ($rs)
			{
				foreach($rs as $record)
				{
					$data[$record['id']][$record['month'].'/'.$record['year']] += floatval($record['total']);
					$data[0][$record['month'].'/'.$record['year']] += floatval($record['total']);
				}
			}
			$this->_set_cached($key, $data);
			return $data;
		}
	}

	function total_costs_per_months_column_chart($filters = array())
	{
		$filters['start_date'] = date('1/m/Y', strtotime('-11 month'));
		$this->_get_dates($filters);
		$chart = new Highchart();
		$chart->chart->renderTo = "total_costs_per_months_column_chart";
		$chart->chart->type = "column";
		$chart->title->text = "Chi phí theo tháng từ $this->start_date_lbl đến $this->end_date_lbl";

		$months = array();
		$start_tt = $this->start_tt;
		while($start_tt <= $this->end_tt){
			$months[] = date('m', $start_tt).'/'.date('Y', $start_tt);
			$start_tt = strtotime('+1 month', $start_tt);
		}
		$chart->xAxis->categories = $months;
		$chart->yAxis->min = 0;
		$chart->yAxis->title->text = "Chi phí";
		$chart->legend->layout = "vertical";
		$chart->legend->backgroundColor = "#FFFFFF";
		$chart->legend->align = "left";
		$chart->legend->verticalAlign = "top";
		$chart->legend->x = 100;
		$chart->legend->y = 70;
		$chart->legend->floating = 1;
		$chart->legend->shadow = 1;

		$chart->plotOptions->column->pointPadding = 0.2;
		$chart->plotOptions->column->borderWidth = 0;

		$data = $this->_get_total_costs_per_months_data();
		$chart->series[] = array(
			'name' => "Tổng",
			'data' => array_values($data[0])
		);
		if ($this->cost_types){
			foreach($this->cost_types as $type){
				$chart->series[] = array(
					'name' => $type['name'],
					'data' => array_values($data[$type['id']])
				);
			}
		}
		return $chart;
	}

    function _get_fruit_costs_by_time_data()
    {
        $key = $this->_get_key('fruit_costs_by_time');
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array();
            /*
            $where_str1 = $this->_get_filter_date_string('date_time');
            $where_str2 = $this->_get_filter_date_string('import_date');
            $sql = "SELECT cost_types.name, SUM(costs.amount) as total
                    FROM cost_types
                    LEFT JOIN costs ON costs.type_id = cost_types.id
                    LEFT JOIN inventory_import ON inventory_import.id = costs.import_id
                    WHERE (import_date IS NULL AND $where_str1 ) OR (import_date IS NOT NULL AND $where_str2 )
                    GROUP BY cost_types.id
                    ORDER BY total DESC";
            $rs = eModel::_do_sql($sql);
            */
            $where_str = $this->_get_filter_date_string('import_date');
            $sql = "SELECT inventory_item_details.name, SUM(inventory_import_details.total) as total
                    FROM inventory_import_details 
                    INNER JOIN inventory_import ON inventory_import.id = inventory_import_details.import_id
                    INNER JOIN inventory_item_details ON inventory_item_details.id = inventory_import_details.item_id
                    INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id
                    WHERE $where_str AND inventory_import.deleted = 0 AND inventory_import_details.deleted = 0 
                    AND inventory_item_types.is_fruit = 1 AND inventory_item_details.enabled = 1
                    GROUP BY inventory_item_details.id 
                    ORDER BY total DESC";
            $rs = eModel::_do_sql($sql);
            if ($rs)
                $data = $rs;
            $this->_set_cached($key, $data);
            return $data;
        }
    }

    function fruit_costs_by_time_pie_chart($filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();

        $chart->chart->renderTo = "fruit_costs_by_time_pie_chart";
        $chart->chart->plotBackgroundColor = null;
        $chart->chart->plotBorderWidth = null;
        $chart->chart->plotShadow = false;
        $chart->chart->options3d = array(
            'enabled' => true,
            'alpha' => 45,
            'beta' => 0
        );
        if ($this->start_date_lbl != $this->end_date_lbl)
            $chart->title->text = "Chi phí trái cây từ $this->start_date_lbl đến $this->end_date_lbl";
        else
            $chart->title->text = "Chi phí trái cây ngày $this->start_date_lbl";

        $chart->tooltip->pointFormat = '<b>{point.name}</b>: {point.y} | {point.percentage:.2f} %';

        $chart->plotOptions->pie->allowPointSelect = 1;
        $chart->plotOptions->pie->cursor = "pointer";
        $chart->plotOptions->pie->depth = 35;
        $chart->plotOptions->pie->dataLabels->enabled = 1;
        $chart->plotOptions->pie->dataLabels->color = "#000000";
        $chart->plotOptions->pie->dataLabels->connectorColor = "#000000";
        $chart->plotOptions->pie->dataLabels->format = '<b>{point.name}</b>: {point.percentage:.2f} %';

        $chart->series[] = array(
            'type' => "pie",
            'name' => "Theo thời gian"
        );

        $data = $this->_get_fruit_costs_by_time_data();
        if ($data)
        {
            $chart->series[0]->data = array();
            $series_data = array();
            $sum = 0;
            foreach($data as $row){
                $sum += intval($row['total']);
                $series_data[] = array($row['name'], intval($row['total']));
            }
            if($sum)
                $chart->series[0]->data = $series_data;
        }
        return $chart;
    }

    function _get_total_sales_data_by_category($chart_code, $cat_id)
    {
        $key = $this->_get_key($chart_code);
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = $data = array(
                'total' => array(),
            );;
            $where_str = $this->_get_filter_date_string();
            $sql_dates = "SELECT td.db_date  
                    FROM time_dimension td 
                    WHERE $where_str
                    GROUP BY td.db_date 
                    ORDER BY td.db_date";
            $rs_dates = eModel::_do_sql($sql_dates);

            $sql = "SELECT td.db_date, SUM(order_items.total - orders.discount/orders.total*order_items.total) as total 
                    FROM time_dimension td 
                    INNER JOIN orders ON DATE(orders.delivery_date) = td.db_date AND (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed'
                    INNER JOIN order_items ON order_items.order_id = orders.id AND order_items.deleted = 0
                    INNER JOIN products ON products.product_id = order_items.product_id AND products.category_id = $cat_id  
                    WHERE $where_str
                    GROUP BY td.db_date 
                    ORDER BY td.db_date";
            $rs = eModel::_do_sql($sql);

            if ($rs)
            {
                $total = array();
                $data = array(
                    'total' => array(),
                );
                foreach($rs as $r)
                {
                    $total[$r['db_date']] = floatval($r['total']);
                }
                foreach($rs_dates as $r_date){
                    if(!isset($total[$r_date['db_date']]))
                        $data['total'][] = 0;
                    else
                        $data['total'][] = round($total[$r_date['db_date']]*1000);
                }
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }

    function get_total_sales_chart_by_category($chart_id, $config, $filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = $chart_id;
        $chart->chart->zoomType = 'x';
        $chart->chart->spacingRight = 20;
        $chart->title->text = "Doanh số ".$config['cat_name']." từ $this->start_date_lbl đến $this->end_date_lbl";
        $chart->subtitle->text = new HighchartJsExpr("'Nhấn và kéo để phóng to xem chi tiết'");
        $chart->xAxis->type = 'datetime';
        $chart->xAxis->maxZoom = 14 * 24 * 3600000; // fourteen days
        $chart->xAxis->title->text = null;
        $chart->yAxis->title->text = 'Doanh số';
        $chart->yAxis->min = 0;
        $chart->yAxis->startOnTick = false;
        $chart->yAxis->showFirstLabel = false;
        $chart->tooltip->shared = true;
        $chart->legend->enabled = false;
        $chart->plotOptions->area->fillColor->linearGradient = array(
            0,
            0,
            0,
            300
        );
        $chart->plotOptions->area->fillColor->stops = array(
            array(
                0,
                new HighchartJsExpr("Highcharts.getOptions().colors[0]")
            ),
            array(
                1,
                new HighchartJsExpr("Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')")
            )
        );
        $chart->plotOptions->area->lineWidth = 1;
        $chart->plotOptions->area->marker->enabled = false;
        $chart->plotOptions->area->marker->states->hover->enabled = true;
        $chart->plotOptions->area->marker->states->hover->radius = 5;
        $chart->plotOptions->area->shadow = false;
        $chart->plotOptions->area->states->hover->lineWidth = 1;

        $pointInterval = 24 * 3600 * 1000;
        $pointStart = new HighchartJsExpr("Date.UTC(".$this->start_date_arr[0].", ".($this->start_date_arr[1]-1).", ".$this->start_date_arr[2].")");
        $sales_data = $this->_get_total_sales_data_by_category($chart_id, $config['cat_id']);

        $chart->series[] = array(
            'type' => 'area',
            'name' => 'Doanh số',
            'pointInterval' => $pointInterval,
            'pointStart' => $pointStart,
            'data' => $sales_data['total']
        );
        return $chart;
    }

    function _get_total_per_months_data_by_category($chart_code, $cat_id)
    {
        $key = $this->_get_key($chart_code);
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array(
                0 => array(),
                1 => array(),
                2 => array(),
                3 => array()
            );
            $start_tt = $this->start_tt;
            while($start_tt <= $this->end_tt)
            {
                $month = date('n', $start_tt).'/'.date('Y', $start_tt);
                $start_tt = strtotime('+1 month', $start_tt);
                $data[0][$month] = 0;
                $data[1][$month] = 0;
                $data[2][$month] = 0;
                $data[3][$month] = 0;
            }
            $where_str = $this->_get_filter_date_string('orders.delivery_date');
            $sql = "SELECT order_types.id as type, MONTH(orders.delivery_date) as month, YEAR(orders.delivery_date) as year, SUM(order_items.total - orders.discount/orders.total*order_items.total) as total
                    FROM orders 
                    INNER JOIN order_types ON orders.type_id = order_types.id
                    INNER JOIN order_items ON order_items.order_id = orders.id AND order_items.deleted = 0
                    INNER JOIN products ON products.product_id = order_items.product_id AND products.category_id = $cat_id 
                    WHERE (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed' AND $where_str
                    GROUP BY order_types.id, MONTH(orders.delivery_date), YEAR(orders.delivery_date)";
            $rs = eModel::_do_sql($sql);
            if ($rs)
            {
                foreach($rs as $record)
                {
                    if ($record['type'] <= 3)
                        $data[$record['type']][$record['month'].'/'.$record['year']] = round($record['total']*1000);
                    $data[0][$record['month'].'/'.$record['year']] += round($record['total']*1000);
                }
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }

    function get_total_per_months_chart_by_category($chart_id, $config, $extra_filters = array())
    {
        $filters['start_date'] = date('1/m/Y', strtotime('-11 month'));
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = $chart_id;
        $chart->chart->type = "column";
        $chart->title->text = "Doanh số ".$config['cat_name']." theo tháng từ $this->start_date_lbl đến $this->end_date_lbl";

        $months = array();
        $start_tt = $this->start_tt;
        while($start_tt <= $this->end_tt){
            $months[] = date('m', $start_tt).'/'.date('Y', $start_tt);
            $start_tt = strtotime('+1 month', $start_tt);
        }
        $chart->xAxis->categories = $months;
        $chart->yAxis->min = 0;
        $chart->yAxis->title->text = "Doanh số";
        $chart->legend->layout = "vertical";
        $chart->legend->backgroundColor = "#FFFFFF";
        $chart->legend->align = "left";
        $chart->legend->verticalAlign = "top";
        $chart->legend->x = 100;
        $chart->legend->y = 70;
        $chart->legend->floating = 1;
        $chart->legend->shadow = 1;

        $chart->plotOptions->column->pointPadding = 0.2;
        $chart->plotOptions->column->borderWidth = 0;

        $data = $this->_get_total_per_months_data_by_category($chart_id, $config['cat_id']);
        $chart->series[] = array(
            'name' => "Tổng",
            'data' => array_values($data[0])
        );
        $chart->series[] = array(
            'name' => "Tại chỗ",
            'data' => array_values($data[1])
        );

        $chart->series[] = array(
            'name' => "Mang về",
            'data' => array_values($data[2])
        );

        $chart->series[] = array(
            'name' => "Giao hàng",
            'data' => array_values($data[3])
        );
        return $chart;
    }

    function _get_total_per_weeks_data_by_category($chart_code, $cat_id)
    {
        $key = $this->_get_key($chart_code);
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        else
        {
            $data = array();
            $start_tt = $this->start_tt;
            $start_date_of_week = $this->_get_first_date_of_week($start_tt);
            $start_tt = strtotime($start_date_of_week);
            $end_tt = strtotime('+6 days', $start_tt);

            while($start_tt <= $this->end_tt)
            {
                $week = date('d/m', $start_tt).' - '.date('d/m', $end_tt);
                $data[$week] = 0;

                $where_str = $this->_get_filter_date_string('orders.delivery_date', date('Y-m-d', $start_tt), date('Y-m-d', $end_tt));
                $sql = "SELECT SUM(order_items.total - orders.discount/orders.total*order_items.total) as total
                    FROM orders 
                    INNER JOIN order_types ON orders.type_id = order_types.id
                    INNER JOIN order_items ON order_items.order_id = orders.id AND order_items.deleted = 0
                    INNER JOIN products ON products.product_id = order_items.product_id AND products.category_id = $cat_id 
                    WHERE (orders.deleted = 0 OR ISNULL(orders.deleted)) AND orders.`status` != 'Failed' AND $where_str";
                $rs = eModel::_do_sql($sql);
                if ($rs)
                {
                    foreach($rs as $record)
                    {
                        $data[$week] += round($record['total']*1000);
                    }
                }
                $start_tt = strtotime('+1 week', $start_tt);
                $end_tt = strtotime('+1 week', $end_tt);
            }
            $this->_set_cached($key, $data);
            return $data;
        }
    }

    function get_total_per_weeks_chart_by_category($chart_id, $config, $filters = array())
    {
        $this->_get_dates($filters);
        $chart = new Highchart();
        $chart->chart->renderTo = $chart_id;
        $chart->chart->type = "column";
        $chart->title->text = "Doanh số ".$config['cat_name']." theo tuần từ $this->start_date_lbl đến $this->end_date_lbl";

        $weeks = array();
        $start_tt = $this->start_tt;
        $start_date_of_week = $this->_get_first_date_of_week($start_tt);
        $start_tt = strtotime($start_date_of_week);
        $end_tt = $end_tt = strtotime('+6 days', $start_tt);
        while($start_tt <= $this->end_tt){
            $weeks[] = date('d/m', $start_tt).' - '.date('d/m', $end_tt);
            $start_tt = strtotime('+1 week', $start_tt);
            $end_tt = strtotime('+1 week', $end_tt);
        }
        $chart->xAxis->categories = $weeks;
        $chart->yAxis->min = 0;
        $chart->yAxis->title->text = "Doanh số";
        $chart->legend->layout = "vertical";
        $chart->legend->backgroundColor = "#FFFFFF";
        $chart->legend->align = "left";
        $chart->legend->verticalAlign = "top";
        $chart->legend->x = 100;
        $chart->legend->y = 70;
        $chart->legend->floating = 1;
        $chart->legend->shadow = 1;
        $chart->legend->enabled = false;

        $chart->plotOptions->column->pointPadding = 0.2;
        $chart->plotOptions->column->borderWidth = 0;

        $data = $this->_get_total_per_weeks_data_by_category($chart_id, $config['cat_id']);
        $chart->series[] = array(
            'name' => "Tổng bán",
            'data' => array_values($data)
        );
        return $chart;
    }

    function render($chart_id, $filters)
    {
        if (!strstr($chart_id, '_chart'))
            $chart_id .= '_chart';
        $chart = null;
        if(method_exists($this, $chart_id)){
            $chart = call_user_func( array($this, $chart_id), $filters);
        }else if(!empty(self::$charts_config[$chart_id])){
            $config =self::$charts_config[$chart_id];
            if(method_exists($this, $config['type']))
                $chart = call_user_func( array($this, $config['type']), $chart_id, $config, $filters);
        }
        return $chart;
    }
}
