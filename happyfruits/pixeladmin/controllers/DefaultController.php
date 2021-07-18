<?php
/**
 * Class declaration
 */
class DefaultController extends BaseController
{
    function __construct()
    {
        $this->not_require_logged = array('login');
        parent::__construct();
        $this->load_model('Users, Charts, Shippingdetails, Assessment');
    }
    
    function index()
    {
        $page_title = 'Trang chủ';
        
        $this->data['page_title'] = $page_title;
        $js = array(
            ASSET_URL. 'js/default/default.js'
        );
        $this->_merge_data(compact("js"));
        if (Users::is_super_admin())
        {
            $this->plugins = 'highcharts, iframeautoheight, datepicker';
            $this->data['charts'] = array(
                $this->Charts->total_per_months_column_chart(),
                $this->Charts->total_orders_by_distance_column_chart()
            );
            $this->data['chart_ids'] = Charts::$chart_ids;
            $this->load_page('default/dashboard-superadmin');
        }
        else
        {
            $this->plugins = 'highcharts';
            $start_date = strtotime($this->logged_user['created_dtm'])<strtotime('-3 months')?date('d/m/Y', strtotime('-3 months')):date('d/m/Y', strtotime($this->logged_user['created_dtm']));
            $this->data['charts'] = array(
                $this->Charts->kpi_area_chart(array('start_date'=>$start_date, 'user_id'=>$this->logged_user['user_id']))
            );
            
            $shipping_records = $this->Shippingdetails->get_list(array('where' => "SUBSTR(date_time, 1, 7) = '". date('Y-m'). "'", 'users.user_id' => $this->logged_user['user_id']));
            $this->data['number_of_shipping_records'] = $shipping_records?count($shipping_records):0;
            
            $assessment_records = $this->Assessment->get_list(array('where' => "SUBSTR(assessment_date, 1, 7) = '". date('Y-m'). "'", 'users.user_id' => $this->logged_user['user_id']), 'assessment.assessment_date DESC');
            $this->data['number_of_assessment_records'] = $assessment_records?count($assessment_records):0;
            
            $kpi_score = 0;
            if($assessment_records)
                foreach($assessment_records as $r)
                {
                    $kpi_score += $r['kpi'];
                }
            $this->data['kpi_score'] = $kpi_score;
            $this->load_page('default/dashboard-member');
        }
    }
    
    function chart()
    {
        $chart_ids = get('chart_ids');
        $this->plugins = 'highcharts';
        if (Users::is_super_admin())
        {
            /* Input format dd/mm/YY (d/m/Y) */
            $start_date = get('startdate', date('d/m/Y', strtotime('-1 month')));
            $end_date = get('enddate', date('d/m/Y'));
            $filters = compact('start_date', 'end_date');
            $this->data['charts'] = $this->data['active_chart_ids'] = array();
            if (empty($chart_ids)){
                $this->data['charts'] = array(
                    $this->Charts->customers_line_chart($filters),
                    $this->Charts->top_selling_products_column_chart($filters),
                    $this->Charts->total_by_order_types_pie_chart($filters),
                    $this->Charts->total_by_days_pie_chart($filters),
                    $this->Charts->total_sales_chart($filters),
                    $this->Charts->total_orders_line_chart($filters),
                    $this->Charts->total_orders_by_time_pie_chart($filters),
                );
                $this->data['active_chart_ids'] = Charts::$chart_ids;
            }else{
                $chart_ids = explode(',', $chart_ids);
                foreach($chart_ids as $chart_id){
                    $chart = $this->Charts->render($chart_id, $filters);
                    if ($chart){
                        $this->data['charts'][] = $chart;
                        $this->data['active_chart_ids'][] = $chart_id;
                    }
                }
            }
            $this->load_page('default/charts/main', 0);
        }else
            die("You don't have permission to view this page.");
    }
    
    function login()
    {
        if ($this->is_logged)
            redirect('trang-chu');
        
        $this->plugins = 'rsa';
        $page_title = 'Đăng nhập';
        $js = array(
            ASSET_URL. 'js/default/login.js',
            ASSET_URL. 'plugins/validator/validator.js'
        );
        $this->_merge_data(compact("page_title", "js"));
        $this->load_page('default/login', 0);
    }
}
/* End of DefaultController class */
