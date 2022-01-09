<?php
/**
 * Class declaration
 */
class CostController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Users, Costs, Providers, Charts, Orders, Categories, Branches');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/cost/index.js'
        );
        $page_title = 'Quản lý chi phí';
        $costs = $this->Costs->get_list(array('where' => "DATE(costs.date_time) >= '".date('Y-m-1')."'"));
        $types = $this->Costs->get_types();
	    $providers = $this->Providers->get_list();

        $this->_merge_data(compact("js", "page_title", "costs", "types", "providers"));
        $this->load_page('cost/index');
    }
    
    function edit()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/cost/cost.js'
        );
        $page_title = 'Sửa bảng lưu chi phí';
        $id = get('id');
        if (!Costs::is_editable($id)){
            set_last_error("Bạn không có quyền sửa bản lưu chi phí #$id.");
            redirect();
        }        
        $obj = null;
        if ($id)
            $obj = $this->Costs->get_details($id);
        $types = $this->Costs->get_types();
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "types", "members", "branches", "id"));
        $this->load_page('cost/cost');
    }
    
    function add()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/cost/cost.js'
        );
        $page_title = 'Thêm chi phí';
        $id = $obj = null;
        $types = $this->Costs->get_types();
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "types", "members", "branches", "id"));
        $this->load_page('cost/cost');
    }

    function types_list()
    {
	    $this->plugins = 'dataTables, datepicker';
	    $js = array(
		    ASSET_URL. 'js/cost/types.js'
	    );
	    $page_title = 'Quản lý loại chi phí';
	    $types = $this->Costs->get_types();
	    $this->_merge_data(compact("js", "page_title", "types"));
	    $this->load_page('cost/types');
    }

	function edit_type()
	{
		$this->plugins = 'bootstrap-datetimepicker, validator';
		$js = array(
			ASSET_URL. 'js/cost/type.js'
		);
		$page_title = 'Sửa loại chi phí';
		$id = get('id');
		if (!Users::can_access('cost', 'type')){
			set_last_error("Bạn không có quyền sửa loại chi phí #$id.");
			redirect();
		}
		$obj = null;
		if ($id)
			$obj = $this->Costs->get_type_details($id);
		$this->_merge_data(compact("js", "page_title", "obj", "id"));
		$this->load_page('cost/type');
	}

	function add_type()
	{
		$this->plugins = 'bootstrap-datetimepicker, validator';
		$js = array(
			ASSET_URL. 'js/cost/type.js'
		);
		$page_title = 'Thêm loại chi phí';
		$id = $obj = null;
		$this->_merge_data(compact("js", "page_title", "obj", "id"));
		$this->load_page('cost/type');
	}

	function view_report()
	{
		$this->plugins = 'highcharts, iframeautoheight, datepicker';
		$js = array(
			ASSET_URL. 'js/cost/report.js'
		);
		$page_title = 'Thống kê chi phí';
		$this->data['chart_ids'] = array(
			'total_costs_per_months_column_chart' => array('class' => 'col-lg-12', 'has_filter' => 0),
			'costs_by_time_pie_chart' => array('class' => 'col-lg-12', 'has_filter' => 1),
            'fruit_costs_by_time_pie_chart' => array('class' => 'col-lg-12', 'has_filter' => 1)
		);
		$this->_merge_data(compact("js", "page_title"));
		$this->load_page('cost/report');
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
					$this->Charts->costs_by_time_pie_chart($filters),
				);
				$this->data['active_chart_ids'] = Charts::$chart_ids;
			}else{
				$chart_ids = explode(',', $chart_ids);
				foreach($chart_ids as $chart_id){
					if (!strstr($chart_id, '_chart'))
						$chart_id .= '_chart';

					if (method_exists($this->Charts,$chart_id)){
						$this->data['charts'][] = call_user_func( array($this->Charts,$chart_id), $filters);
						$this->data['active_chart_ids'][] = $chart_id;
					}
				}
			}
			$this->load_page('cost/charts/main', 0);
		}else
			die("You don't have permission to view this page.");
	}
}
/* End of CostController class */
