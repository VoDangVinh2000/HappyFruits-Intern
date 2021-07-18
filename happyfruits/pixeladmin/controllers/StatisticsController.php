<?php
/**
 * Class declaration
 */
class StatisticsController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Charts, Categories, Orders, Branches');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker, iframeautoheight, download';
        $js = array(
            ASSET_URL. 'js/statistics/index.js'
        );
        $page_title = 'Thống kê hàng hóa đã bán';
	    $where_str = "orders.delivery_date BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')." 23:59:59'";
        $statistics_data = $this->Orders->get_statistics_data(array('where' => $where_str));
	    $sum_of_foody_quantities = Orders::get_total_quatity_of_foody(array('where' => $where_str));
        $order_types = $this->Orders->get_order_types(array('show_in_statistics' => 1));
        //Only get the sub-categories
        $all_categories = $this->Categories->select(array('where' => 'parent_id <> 0'));
        $branches = $this->Branches->get_list();
        
        $this->_merge_data(compact("js", "page_title", "orders", "statistics_data", "sum_of_foody_quantities", "all_categories", "order_types", "branches"));
        $this->load_page('statistics/index');
    }
    
    function chart()
    {
        $this->plugins = 'highcharts';
        /* Input format dd/mm/YY (d/m/Y) */
        $start_date = get('startdate', date('d/m/Y'));
        $end_date = get('enddate', date('d/m/Y'));
        $shift = get('shift');
        $branch_id = get('branch_id');
        $filters = compact('start_date', 'end_date', 'shift', 'branch_id');
        $this->data['charts'] = array(
            $this->Charts->total_by_order_types_pie_chart($filters),
            $this->Charts->number_of_order_by_types_pie_chart($filters)
        );
        $this->load_page('statistics/charts/main', 0);
    }
}
/* End of StatisticsController class */
