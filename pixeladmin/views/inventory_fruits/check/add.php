<div id="content-wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><i class="fa fa-download"></i> Thêm phiếu kiểm kê trái cây</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php $controlerObj->load_view('elements/messages'); ?>
                <form class="one-line" id="frmCheckInventory" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                    <div class="form-group col-lg-4 col-md-4">
                        <label class="control-label">Nguời lập</label>
                        <input class="form-control" value="<?=$logged_user['fullname']?>" readonly=""/>
                        <input type="hidden" value="<?=$logged_user['user_id']?>" name="user_id"/>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 padding-left">
                        <label for="export_date" class="control-label">Ngày *</label>
                        <input class="form-control" id="export_date" name="export_date" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=date('d/m/Y', strtotime('-1 year'))?>" data-date-enddate="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" readonly=""/>
                    </div>
                    <div class="form-group col-lg-4 col-md-4">
                        <label for="warehouse_id" class="control-label">Kho *</label>
                        <?php echo html_select($warehouses, 'id', 'name', 'name="warehouse_id" required="" class="form-control" id="warehouse_id"', null, RAW_INVENTORY_ID);?>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="clear"></div>
                    <table class="table table-bordered table-hover" id="dataTables-check">
                        <thead>
                        <tr class="heading">
                            <th style="width: 200px;">Tên hàng</th>
                            <th style="width: 120px;">Số lượng *</th>
                            <th>Ghi chú</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            $current_type_id = 0;
                            foreach ($inventory_items as $item):
                                if ($current_type_id != $item['type_id']):
                        ?>
                            <tr class="heading"><th colspan="3" style="text-align: left;vertical-align: middle;background: none;"><h3><?=$item['type_name']?></h3></th></tr>
                        <?php
                                    $current_type_id = $item['type_id'];
                                endif;
                        ?>
                            <tr class="warehouse_<?=$item['warehouse_id']?>" <?=$item['warehouse_id']!=RAW_INVENTORY_ID?'style="display: none;"':''?>>
                                <td>
                                    <input type="hidden" name="item_code[]" value="<?=$item['code']?>"/>
                                    <input type="hidden" name="item_name[]" value="<?=$item['name']?>"/>
                                    <input type="hidden" name="item_id[]" id="item_id" value="<?=$item['id']?>"/>
                                    <?=$item['code']. ' - '.$item['name']?>
                                </td>
                                <td><input style="display: inline;width: 60px;" type="text" class="form-control float" id="item_quantity" name="item_quantity[]" placeholder="SL"/>&nbsp;<?=$item['unit']?></td>
                                <td><input type="text" class="form-control" id="item_description" name="item_description[]" placeholder="Ghi chú"/></td>
                            </tr>
                        <?php
                                $i++;
                            endforeach;
                        ?>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label class="control-label" for="description">Ghi chú</label>
                        <textarea class="form-control" id="description" name="description" rows="2" cols="30"></textarea>
                    </div>
	                <div class="form-group">
                        <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                        <a href="<?=BASE_URL. $URIs['inventory_import_fruits']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                        <input type="hidden" name="action" value="admin_check_inventory_fruits"/>
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