<?php
/**
 * Class declaration
 */
class InventoryController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Users, Inventory, Inventoryimport, Inventoryimportdetails, Inventoryexport, Inventoryexportdetails, Inventoryitemdetails, Providers');
        $this->data['is_fruit'] = 0;
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/inventory/index.js'
        );
        $page_title = 'Quản lý kho';
        
        $filters = array('inventory.warehouse_id' => RAW_INVENTORY_ID, 'inventory_item_types.is_fruit' => '0');
        $inventory_records = $this->Inventory->get_inventory_records($filters);
        $warehouses = $this->Inventory->get_warehouses();
        $item_types = $this->Inventoryitemdetails->get_item_types();

        $this->_merge_data(compact("js", "page_title", "inventory_records", "warehouses", "item_types", "filters"));
        $this->load_page('inventory/index');
    }
    
    function import_list()
    {
        $this->plugins = 'dataTables, datepicker, tooltipster';
        $js = array(
            ASSET_URL. 'js/inventory/import/index.js'
        );
        $page_title = 'Phiếu nhập kho';
        
        $import_records = $this->Inventoryimport->get_inventory_import_records(array('where' => "inventory_import.import_date BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'", 'is_fruit' => '0'));
        $users = $this->Users->get_list(array(), 'inventory');
        $warehouses = $this->Inventory->get_warehouses();
	    $providers = $this->Providers->get_list(array('where' => 'type > 0'));
        
        $this->data['inventory_import_details_model'] = $this->Inventoryimportdetails;
        $this->_merge_data(compact("js", "page_title", "import_records", "warehouses", "users", "providers"));
        $this->load_page('inventory/import/index');
    }
    
    function edit_import_record()
    {
        $this->plugins = 'datepicker, jquery-ui, icheck';
        $js = array(
            ASSET_URL. 'js/inventory/import/edit.js'
        );
        $page_title = 'Sửa phiếu nhập kho';

	    $id = get('id');
	    $import_record = $this->Inventoryimport->get_details($id);
	    if (!$import_record){
		    set_last_error("Mã phiếu nhập không chính xác");
		    redirect('/quan-ly-kho/phieu-nhap');
	    }

        $details = array();
        if ($id)
	        $records = $this->Inventoryimportdetails->get_records(array('inventory_import.id' => $id));
	    if ($records){
		    $page_title .= " - $id";
		    foreach($records as $r){
			    $details[$r['item_id']] = $r;
		    }
	    }
	    $import_record = $this->Inventoryimport->get_details($id);
        $inventory_items = $this->Inventoryitemdetails->get_list();
	    $creator = $this->Users->get_details($import_record['user_id']);
        $item_types = $this->Inventoryitemdetails->get_item_types();  
        $warehouses = $this->Inventory->get_warehouses();
	    $cashiers = $this->Users->get_cashiers();
	    $providers = $this->Providers->get_list(array('where' => 'type > 0'));
        
        $this->_merge_data(compact("js", "page_title", "id", "details", "inventory_items", "item_types", "warehouses", "providers", "cashiers", "import_record", "creator"));
        $this->load_page('inventory/import/edit');
    }
    
    function add_import_record()
    {
        $this->plugins = 'datepicker, jquery-ui, icheck';
        $js = array(
            ASSET_URL. 'js/inventory/import/add.js'
        );
        $page_title = 'Thêm phiếu nhập kho';
        
        $inventory_items = $this->Inventoryitemdetails->get_list();   
        $item_types = $this->Inventoryitemdetails->get_item_types();  
        $warehouses = $this->Inventory->get_warehouses();
	    $cashiers = $this->Users->get_cashiers();
	    $providers = $this->Providers->get_list(array('where' => 'type > 0'));
        
        $this->_merge_data(compact("js", "page_title", "inventory_items", "item_types", "warehouses", "providers", "cashiers"));
        $this->load_page('inventory/import/add');
    }
    
    function export_list()
    {
        $this->plugins = 'dataTables, datepicker, tooltipster';
        $js = array(
            ASSET_URL. 'js/inventory/export/index.js'
        );
        $page_title = 'Phiếu xuất kho';
        
        $export_records = $this->Inventoryexport->get_inventory_export_records(array('where' => "inventory_export.export_date BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'", 'is_fruit' => '0'));
        $users = $this->Users->get_list(array(), 'quan-ly-kho');
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
        $page_title = 'Sửa phiếu xuất kho';
        
        $id = get('id');
        $details = null;
        if ($id)
            $details = $this->Inventoryexportdetails->get_records(array('inventory_export.id' => $id));
        if ($details)
            $page_title .= " - $id";
            
        $inventory_items = $this->Inventoryitemdetails->get_list();   
        $item_types = $this->Inventoryitemdetails->get_item_types();  
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
        $page_title = 'Thêm phiếu xuất kho';
        
        $inventory_items = $this->Inventoryitemdetails->get_list();   
        $item_types = $this->Inventoryitemdetails->get_item_types();  
        $warehouses = $this->Inventory->get_warehouses();
        
        $this->_merge_data(compact("js", "page_title", "inventory_items", "item_types", "warehouses"));
        $this->load_page('inventory/export/add');
    }
    
    function item_list()
    {
        $this->plugins = 'dataTables';
        $js = array(
            ASSET_URL. 'js/inventory/item/index.js'
        );
        $page_title = 'Quản lý hàng hóa kho';
        $items = $this->Inventoryitemdetails->get_list();
        $item_types = $this->Inventoryitemdetails->get_item_types(); 
        $this->_merge_data(compact("js", "page_title", "items", "item_types"));
        $this->load_page('inventory/item/index');
    }
    
    function add_inventory_item()
    {
        $this->plugins = 'validator, icheck';
        $js = array(
            ASSET_URL. 'js/inventory/item/item.js'
        );
        $page_title = 'Thêm hàng hóa';
        $id = $obj = null;
        $item_types = $this->Inventoryitemdetails->get_item_types(); 
        $this->_merge_data(compact("js", "page_title", "obj", "item_types", "id"));
        $this->load_page('inventory/item/item');
    }
    
    function edit_inventory_item()
    {
        $this->plugins = 'validator, icheck';
        $js = array(
            ASSET_URL. 'js/inventory/item/item.js'
        );
        $page_title = 'Sửa thông tin hàng hóa';
        
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Inventoryitemdetails->get_details($id, array('deleted' => 0));
        $item_types = $this->Inventoryitemdetails->get_item_types(); 
        
        $this->_merge_data(compact("js", "page_title", "obj", "item_types", "id"));
        $this->load_page('inventory/item/item');
    }

	function check_list()
	{
		$this->plugins = 'dataTables, datepicker, tooltipster';
		$js = array(
			ASSET_URL. 'js/inventory/check/index.js'
		);
		$page_title = 'Phiếu kiểm kê hàng hóa';

		$export_records = $this->Inventoryexport->get_inventory_export_records(array('where' => "inventory_export.export_date BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'", 'is_fruit' => '0'));
		$users = $this->Users->get_list(array(), 'inventory');
		$warehouses = $this->Inventory->get_warehouses();

		$this->data['inventory_export_details_model'] = $this->Inventoryexportdetails;
		$this->_merge_data(compact("js", "page_title", "export_records", "warehouses", "users"));
		$this->load_page('inventory/check/index');
	}

	function edit_check_record()
	{
		$this->plugins = 'datepicker, jquery-ui';
		$js = array(
			ASSET_URL. 'js/inventory/check/edit.js'
		);
		$page_title = 'Sửa phiếu kiểm kê hàng hóa';

		$id = get('id');
		$export_record = $this->Inventoryexport->get_details($id);
		if (!$export_record){
			set_last_error("Mã phiếu kiểm kê không chính xác");
			redirect('/quan-ly-kho/phieu-nhap');
		}

		$details = array();
		$records = null;
		if ($id)
			$records = $this->Inventoryexportdetails->get_records(array('inventory_export.id' => $id));
		if ($records){
			$page_title .= " - $id";
			foreach($records as $r){
				$details[$r['item_id']] = $r;
				$type_id = $r['type_id'];
			}
		}
		$filters = array();
		if (!empty($type_id))
			$filters['type_id'] = $type_id;
		$inventory_items = $this->Inventoryitemdetails->get_list($filters);
		$item_types = $this->Inventoryitemdetails->get_item_types();
		$warehouses = $this->Inventory->get_warehouses();

		$this->_merge_data(compact("js", "page_title", "id", "details", "inventory_items", "item_types", "warehouses", "export_record"));
		$this->load_page('inventory/check/edit');
	}

	function add_check_record()
	{
		$this->plugins = 'datepicker, jquery-ui, growl';
		$js = array(
			ASSET_URL. 'js/inventory/check/add.js'
		);
		$page_title = 'Thêm phiếu kiểm kê hàng hóa';

		$filters = array('type_id' => MATERIAL_INVENTORY_ITEM_TYPE_ID);
		$inventory_items = $this->Inventoryitemdetails->get_list($filters);
		$item_types = $this->Inventoryitemdetails->get_item_types();
		$warehouses = $this->Inventory->get_warehouses();

		$this->_merge_data(compact("js", "page_title", "inventory_items", "item_types", "warehouses"));
		$this->load_page('inventory/check/add');
	}
}
/* End of InventoryController class */
