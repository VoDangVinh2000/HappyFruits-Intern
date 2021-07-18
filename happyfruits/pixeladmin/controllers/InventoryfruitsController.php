<?php
/**
 * Class declaration
 */

require_once(EFRUIT_ABSOLUTE_PATH. "PHPMailer/sender.php");

class InventoryfruitsController extends BaseController
{
    function __construct()
    {
	    $this->not_require_logged = array('send_warning_email');
        parent::__construct();
        $this->load_model('Users, Inventory, Inventoryimport, Inventoryimportdetails, Inventoryexport, Inventoryexportdetails, Inventoryitemdetails, Providers');
        $this->data['is_fruit'] = 1;
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/inventory/index.js'
        );
        $page_title = 'Quản lý trái cây';
        
        $filters = array('inventory.warehouse_id' => RAW_INVENTORY_ID, 'inventory_item_types.is_fruit' => '1');
        $inventory_records = $this->Inventory->get_inventory_records($filters);
        $warehouses = $this->Inventory->get_warehouses();
        $item_types = $this->Inventoryitemdetails->get_fruits_types();

        $this->_merge_data(compact("js", "page_title", "inventory_records", "warehouses", "item_types", "filters"));
        $this->load_page('inventory/index');
    }
    
    function import_list()
    {
        $this->plugins = 'dataTables, datepicker, tooltipster';
        $js = array(
            ASSET_URL. 'js/inventory/import/index.js'
        );
        $page_title = 'Phiếu nhập trái cây';

        $import_records = $this->Inventoryimport->get_inventory_import_records(array('where' => "inventory_import.import_date BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'", 'is_fruit' => '1'));
        $users = $this->Users->get_list(array(), 'inventoryfruits');
        $warehouses = $this->Inventory->get_warehouses();
	    $providers = $this->Providers->get_list(array('type' => 0));
        
        $this->data['inventory_import_details_model'] = $this->Inventoryimportdetails;
        $this->_merge_data(compact("js", "page_title", "import_records", "warehouses", "users", "providers"));
        $this->load_page('inventory/import/index');
    }
    
    function edit_import_record()
    {
        $this->plugins = 'datepicker, jquery-ui, icheck';
        $js = array(
            ASSET_URL. 'js/inventory_fruits/import/edit.js'
        );
        $page_title = 'Sửa phiếu nhập trái cây';
        
        $id = get('id');
	    $import_record = $this->Inventoryimport->get_details($id);
	    if (!$import_record){
		    set_last_error("Mã phiếu nhập không chính xác");
		    redirect('/quan-ly-trai-cay/phieu-nhap');
	    }

        $details = array();
	    $records = null;
        if ($id)
	        $records = $this->Inventoryimportdetails->get_records(array('inventory_import.id' => $id));
        if ($records){
	        $page_title .= " - $id";
	        foreach($records as $r){
		        $details[$r['item_id']] = $r;
	        }
        }
        $import_record = $this->Inventoryimport->get_details($id);
	    $creator = $this->Users->get_details($import_record['user_id']);
        $inventory_items = $this->Inventoryitemdetails->get_fruits_list();
        $item_types = $this->Inventoryitemdetails->get_fruits_types();
        $warehouses = $this->Inventory->get_warehouses();
	    $cashiers = $this->Users->get_cashiers();
	    $providers = $this->Providers->get_list(array('type' => 0));
        
        $this->_merge_data(compact("js", "page_title", "id", "details", "inventory_items", "item_types", "warehouses", "cashiers", "import_record", "providers", 'creator'));
        $this->load_page('inventory_fruits/import/edit');
    }
    
    function add_import_record()
    {
        $this->plugins = 'datepicker, jquery-ui, icheck';
        $js = array(
            ASSET_URL. 'js/inventory_fruits/import/add.js'
        );
        $page_title = 'Thêm phiếu nhập trái cây';
        
        $inventory_items = $this->Inventoryitemdetails->get_fruits_list();
        $item_types = $this->Inventoryitemdetails->get_fruits_types();
        $warehouses = $this->Inventory->get_warehouses();
	    $cashiers = $this->Users->get_cashiers();
	    $providers = $this->Providers->get_list(array('type' => 0));

        $this->_merge_data(compact("js", "page_title", "inventory_items", "item_types", "warehouses", "cashiers", "providers"));
        $this->load_page('inventory_fruits/import/add');
    }
    
    function export_list()
    {
        $this->plugins = 'dataTables, datepicker, tooltipster';
        $js = array(
            ASSET_URL. 'js/inventory/export/index.js'
        );
        $page_title = 'Phiếu xuất trái cây';
        
        $export_records = $this->Inventoryexport->get_inventory_export_records(array('where' => "inventory_export.export_date BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'", 'is_fruit' => '1'));
        $users = $this->Users->get_list(array(), 'inventory');
        $warehouses = $this->Inventory->get_warehouses();
        
        $this->data['inventory_export_details_model'] = $this->Inventoryexportdetails;
        $this->_merge_data(compact("js", "page_title", "export_records", "warehouses", "users"));
        $this->load_page('inventory/export/index');
    }
    
    function edit_export_record()
    {
        $this->plugins = 'datepicker, jquery-ui';
        $js = array(
            ASSET_URL. 'js/inventory/export/edit.js'
        );
        $page_title = 'Sửa phiếu xuất trái cây';
        
        $id = get('id');
        $details = null;
        if ($id)
            $details = $this->Inventoryexportdetails->get_records(array('inventory_export.id' => $id));
        if ($details)
            $page_title .= " - $id";
            
        $inventory_items = $this->Inventoryitemdetails->get_fruits_list();
        $item_types = $this->Inventoryitemdetails->get_fruits_types();
        $warehouses = $this->Inventory->get_warehouses();
        
        $this->_merge_data(compact("js", "page_title", "id", "details", "inventory_items", "item_types", "warehouses"));
        $this->load_page('inventory/export/edit');
    }
    
    function add_export_record()
    {
        $this->plugins = 'datepicker, jquery-ui, growl';
        $js = array(
            ASSET_URL. 'js/inventory/export/add.js'
        );
        $page_title = 'Thêm phiếu xuất trái cây';
        
        $inventory_items = $this->Inventoryitemdetails->get_fruits_list();
        $item_types = $this->Inventoryitemdetails->get_fruits_types();
        $warehouses = $this->Inventory->get_warehouses();
        
        $this->_merge_data(compact("js", "page_title", "inventory_items", "item_types", "warehouses"));
        $this->load_page('inventory/export/add');
    }

	function check_list()
	{
		$this->plugins = 'dataTables, datepicker, tooltipster';
		$js = array(
			ASSET_URL. 'js/inventory_fruits/check/index.js'
		);
		$page_title = 'Phiếu kiểm kê trái cây';

		$export_records = $this->Inventoryexport->get_inventory_export_records(array('where' => "inventory_export.export_date BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'", 'is_fruit' => '1'));
		$users = $this->Users->get_list(array(), 'inventory');
		$warehouses = $this->Inventory->get_warehouses();

		$this->data['inventory_export_details_model'] = $this->Inventoryexportdetails;
		$this->_merge_data(compact("js", "page_title", "export_records", "warehouses", "users"));
		$this->load_page('inventory_fruits/check/index');
	}

	function edit_check_record()
	{
		$this->plugins = 'datepicker, jquery-ui';
		$js = array(
			ASSET_URL. 'js/inventory_fruits/check/edit.js'
		);
		$page_title = 'Sửa phiếu kiểm kê trái cây';

		$id = get('id');
		$export_record = $this->Inventoryexport->get_details($id);
		if (!$export_record){
			set_last_error("Mã phiếu kiểm kê không chính xác");
			redirect('/quan-ly-trai-cay/phieu-nhap');
		}

		$details = array();
		$records = null;
		if ($id)
			$records = $this->Inventoryexportdetails->get_records(array('inventory_export.id' => $id));
		if ($records){
			$page_title .= " - $id";
			foreach($records as $r){
				$details[$r['item_id']] = $r;
			}
		}

		$counts = $this->Inventoryitemdetails->get_fruits_type_count();
		$types_count = array();
		foreach($counts as $r){
			$types_count[$r['type_id']] = $r['num_of_records'];
		}

		$inventory_items = $this->Inventoryitemdetails->get_fruits_list();
		$item_types = $this->Inventoryitemdetails->get_fruits_types();
		$warehouses = $this->Inventory->get_warehouses();

		$this->_merge_data(compact("js", "page_title", "id", "details", "inventory_items", "item_types", "warehouses", "export_record", "types_count"));
		$this->load_page('inventory_fruits/check/edit');
	}

	function add_check_record()
	{
		$this->plugins = 'datepicker, jquery-ui, growl';
		$js = array(
			ASSET_URL. 'js/inventory_fruits/check/add.js'
		);
		$page_title = 'Thêm phiếu kiểm kê trái cây';

		$inventory_items = $this->Inventoryitemdetails->get_fruits_list();
		$item_types = $this->Inventoryitemdetails->get_fruits_types();
		$warehouses = $this->Inventory->get_warehouses();
		$counts = $this->Inventoryitemdetails->get_fruits_type_count();
		$types_count = array();
		foreach($counts as $r){
			$types_count[$r['type_id']] = $r['num_of_records'];
		}

		$this->_merge_data(compact("js", "page_title", "inventory_items", "item_types", "warehouses", "types_count"));
		$this->load_page('inventory_fruits/check/add');
	}
    
    function item_list()
    {
        $this->plugins = 'dataTables';
        $js = array(
            ASSET_URL. 'js/inventory/item/index.js'
        );
        $page_title = 'Quản lý danh mục trái cây';
        $items = $this->Inventoryitemdetails->get_fruits_list(array('enabled' => -1));
        $item_types = $this->Inventoryitemdetails->get_fruits_types();
        $warehouses = $this->Inventory->get_warehouses();
        $this->_merge_data(compact("js", "page_title", "items", "item_types", "warehouses"));
        $this->load_page('inventory/item/index');
    }
    
    function add_inventory_item()
    {
        $this->plugins = 'validator, icheck';
        $js = array(
            ASSET_URL. 'js/inventory/item/item.js'
        );
        $page_title = 'Thêm danh mục trái cây';
        $id = $obj = null;
        $item_types = $this->Inventoryitemdetails->get_fruits_types();
	    $item_categories = $this->Inventoryitemdetails->get_fruit_categories();
        $warehouses = $this->Inventory->get_warehouses();

        $this->_merge_data(compact("js", "page_title", "obj", "item_types", "item_categories", "warehouses", "id"));
        $this->load_page('inventory/item/item');
    }
    
    function edit_inventory_item()
    {
        $this->plugins = 'validator, icheck';
        $js = array(
            ASSET_URL. 'js/inventory/item/item.js'
        );
        $page_title = 'Sửa thông tin trái cây';
        
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Inventoryitemdetails->get_details($id, array('deleted' => 0));
        $item_types = $this->Inventoryitemdetails->get_fruits_types();
	    $item_categories = $this->Inventoryitemdetails->get_fruit_categories();
        $warehouses = $this->Inventory->get_warehouses();
        
        $this->_merge_data(compact("js", "page_title", "obj", "item_types", "item_categories", "warehouses", "id"));
        $this->load_page('inventory/item/item');
    }

    function send_warning_email()
    {
    	$warehouses = $this->Inventory->get_warehouses();
	    if ($warehouses){
	    	foreach($warehouses as $w){
			    $filters = array('inventory.warehouse_id' => $w['id'], 'inventory_item_types.is_fruit' => '1');
			    $inventory_records = $this->Inventory->get_warning_records($filters);
			    if (!empty($inventory_records)){
				    $body = include2string(ABSOLUTE_PATH.'email_templates/inventory_warning.php', array('inventory_records' => $inventory_records, 'warehouse_name' => $w['name']));
				    SendMail('sender@'. DOMAIN_NAME, SYSTEM_EMAIL, get_setting('site_name'). ' - Cảnh báo tồn kho trái cây', $body, get_setting('site_name'). ' - Shop management system');
			    }

			    $filters = array('inventory.warehouse_id' => $w['id'], 'inventory_item_types.is_fruit' => '0');
			    $inventory_records = $this->Inventory->get_warning_records($filters);
			    if (!empty($inventory_records)){
				    $body = include2string(ABSOLUTE_PATH.'email_templates/inventory_warning.php', array('inventory_records' => $inventory_records, 'warehouse_name' => $w['name']));
				    SendMail('sender@'. DOMAIN_NAME, SYSTEM_EMAIL, get_setting('site_name'). ' - Cảnh báo tồn kho hàng hóa', $body, get_setting('site_name'). ' - Shop management system');
			    }
		    }
	    }
    }
}
/* End of InventoryfruitsController class */
