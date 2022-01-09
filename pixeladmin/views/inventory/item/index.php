    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive" id="list_container">
                        <?php $controlerObj->load_view("inventory/item/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Loại hàng: 
                                <?php echo html_select($item_types, 'id', 'type_name', 'id="filter_type_id" class="form-control"', 'Tất cả');?>
                            </li>
	                        <?php if (empty($is_fruit)):?>
                            <li>
                                <a href="<?=BASE_URL. $URIs['inventory_item']?>/them" class="btn btn-success"><i class="fa fa-plus"></i> Thêm hàng hóa</a>
                            </li>
	                        <?php else:?>
                                <li>Kho:
                                    <?php echo html_select($warehouses, 'id', 'name', ' id="filter_warehouse_id" class="form-control"', 'Tất cả'); ?>
                                </li>
		                        <li>
			                        <a href="<?=BASE_URL. $URIs['inventory_item_fruits']?>/them" class="btn btn-success"><i class="fa fa-plus"></i> Thêm danh mục trái cây</a>
		                        </li>
	                        <?php endif; ?>
                        </ul>
                        <div class="clear"></div>
                        <input type="hidden" id="filterString" value="" />
                        <input type="hidden" id="is_fruit" value="<?=empty($is_fruit)?0:1?>" />
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