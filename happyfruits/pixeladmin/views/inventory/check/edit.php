<div id="content-wrapper">
    <div id="page-wrapper">
        <?php if (!$id || empty($inventory_items)):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID phiếu kiểm kê hàng hóa không chính xác!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-download"></i> Phiếu kiểm kê hàng hóa - Mã <?=getvalue($export_record, 'id')?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <?php $controlerObj->load_view('elements/messages'); ?>
                    <form id="frmCheckInventory" role="form" method="post" class="one-line" action="<?=BASE_URL?>xu-ly">
                        <div class="form-group col-lg-4 col-md-4">
                            <label class="control-label">Nguời lập</label>
                            <input class="form-control" value="<?=$logged_user['fullname']?>" readonly=""/>
                            <input type="hidden" value="<?=$logged_user['user_id']?>" name="user_id"/>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 padding-left">
                            <label for="export_date" class="control-label">Ngày *</label>
                            <input class="form-control" id="export_date" name="export_date" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=date('d/m/Y', strtotime('-1 year'))?>" data-date-enddate="<?=date('d/m/Y')?>" value="<?=date('d/m/Y', strtotime($export_record['export_date']))?>" readonly=""/>
                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="warehouse_id" class="control-label">Kho *</label>
                            <?php echo html_select($warehouses, 'id', 'name', 'name="warehouse_id" disabled="" required="" class="form-control" id="warehouse_id"', null, getvalue($export_record, 'warehouse_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="clear"></div>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-check">
                            <thead>
                            <tr>
                                <th style="width: 30px;">STT</th>
                                <th style="width: 120px;">Loại</th>
                                <th style="width: 200px;">Tên hàng</th>
                                <th style="width: 120px;">Số lượng *</th>
                                <th>Ghi chú</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($inventory_items as $item):?>
                                <tr>
                                    <td><?=sprintf('%02d', $i)?></td>
                                    <?php if ($i == 1):?>
                                    <td style="vertical-align: middle;" rowspan="<?=count($inventory_items)?>"><?=$item['type_name']?></td>
                                    <?php endif;?>
                                    <td>
                                        <input type="hidden" name="item_id[]" id="item_id" value="<?=$item['id']?>"/>
                                        <?=$item['name']?>
                                    </td>
                                    <td><input style="display: inline;width: 60px;" type="text" class="form-control float" id="item_quantity" disabled name="item_quantity[]" placeholder="SL" value="<?=isset($details[$item['id']])?$details[$item['id']]['remain_quantity']:''?>"/>&nbsp;<?=$item['unit']?></td>
                                    <td><input type="text" class="form-control" id="item_description" disabled name="item_description[]" placeholder="Ghi chú" value="<?=isset($details[$item['id']])?$details[$item['id']]['detail_description']:''?>"/></td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label class="control-label" for="description">Ghi chú</label>
                            <textarea class="form-control" disabled="" id="description" name="description" rows="2" cols="30"><?=getvalue($export_record, 'description')?></textarea>
                        </div><div class="form-group">
                            <button id="edit" type="button" class="btn btn-warning"><i class="fa fa-edit"></i> Sửa</button>
                            <button id="delete" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Xóa</span></button>
                            <button id="submit" style="display: none;" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['inventory_import_fruits']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" id="export_id" name="export_id" value="<?=$id?>"/>
                            <input type="hidden" name="action" value="admin_edit_check_inventory"/>
                        </div>
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php endif;?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->