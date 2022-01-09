    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("inventory/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Kho: 
                                <?php echo html_select($warehouses, 'id', 'name', ' id="filter_warehouse" class="form-control"', 'Tất cả', $filters['inventory.warehouse_id']); ?>
                            </li>
                            <li>Loại hàng: 
                                <?php echo html_select($item_types, 'id', 'type_name', ' id="filter_type_id" class="form-control"', 'Tất cả'); ?>
                            </li>
                            <?php if (empty($is_fruit)):?>
                            <li>
                                <a href="<?=BASE_URL. $URIs['inventory_import']?>/them" class="btn btn-success"><i class="fa fa-download"></i> Nhập kho</a>
                            </li>
                            <li>
                                <a href="<?=BASE_URL. $URIs['inventory_export']?>/them" class="btn btn-success"><i class="fa fa-upload"></i> Xuất kho</a>
                            </li>
                            <?php else:?>
                            <li>
                                <a href="<?=BASE_URL. $URIs['inventory_import_fruits']?>/them" class="btn btn-success"><i class="fa fa-download"></i> Nhập trái cây</a>
                            </li>
                            <li>
                                <a href="<?=BASE_URL. $URIs['inventory_check_fruits']?>/them" class="btn btn-success"><i class="fa fa-upload"></i> Kiểm kê trái cây</a>
                            </li>
                            <li>
	                            <a href="<?=BASE_URL. $URIs['inventory_item_fruits']?>/them" class="btn btn-success"><i class="fa fa-plus"></i> Thêm trái cây</a>
                            </li>
                            <?php endif; ?>
                            <input type="hidden" id="is_fruit" value="<?=empty($is_fruit)?0:1?>" />
                        </ul>                  
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->