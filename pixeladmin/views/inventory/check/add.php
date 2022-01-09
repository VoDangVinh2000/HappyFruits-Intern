<div id="content-wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><i class="fa fa-download"></i> Thêm phiếu kiểm kê hàng hóa</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php $controlerObj->load_view('elements/messages'); ?>
                <form class="one-line" id="frmCheckInventory" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                    <div class="form-group col-lg-3 col-md-3">
                        <label class="control-label">Nguời lập</label>
                        <input class="form-control" value="<?=$logged_user['fullname']?>" readonly=""/>
                        <input type="hidden" value="<?=$logged_user['user_id']?>" name="user_id"/>
                    </div>
                    <div class="form-group col-lg-3 col-md-3">
                        <label for="export_date" class="control-label">Ngày *</label>
                        <input class="form-control" id="export_date" name="export_date" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=date('d/m/Y', strtotime('-1 year'))?>" data-date-enddate="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" readonly=""/>
                    </div>
                    <div class="form-group col-lg-3 col-md-3">
                        <label for="type_id" class="control-label">Loại hàng *</label>
                        <?php echo html_select($item_types, 'id', 'type_name', 'id="type_id" class="form-control"', null, MATERIAL_INVENTORY_ITEM_TYPE_ID);?>
                    </div>
                    <div class="form-group col-lg-3 col-md-3">
                        <label for="warehouse_id" class="control-label">Kho *</label>
                        <?php echo html_select($warehouses, 'id', 'name', 'name="warehouse_id" required="" class="form-control" id="warehouse_id"', null, RAW_INVENTORY_ID);?>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="clear"></div>
                    <div id="table-container"><?php include('list-items.php'); ?></div>
                    <div class="form-group">
                        <label class="control-label" for="description">Ghi chú</label>
                        <textarea class="form-control" id="description" name="description" rows="2" cols="30"></textarea>
                    </div>
	                <div class="form-group">
                        <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                        <a href="<?=BASE_URL. $URIs['inventory_import_fruits']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                        <input type="hidden" name="action" value="admin_check_inventory"/>
                    </div>
                </form>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->