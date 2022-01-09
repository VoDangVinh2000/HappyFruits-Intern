<script>
    var inventory_items = [];
    <?php if(!empty($inventory_items)): ?>
    <?php foreach ($inventory_items as $item):?>
    inventory_items.push(
        {
            id: '<?=$item['id']?>',
            code: '<?=$item['code']?>',
            name: '<?=$item['name']?>',
            unit: '<?=$item['unit']?>',
            type_id: '<?=$item['type_id']?>',
            value: '<?=$item['name']?>',
            label: '<?=$item['code']. ' - '. $item['name']?>'
        }
    );
    <?php endforeach; ?>
    <?php endif;?>
</script>
<div id="content-wrapper">
    <div id="page-wrapper">
        <?php if (!$id || !$details):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID phiếu xuất <?=$is_fruit?'trái cây':'kho'?> không chính xác!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php else:
            $first_record = $details[0];
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-upload"></i> Phiếu xuất <?=$is_fruit?'trái cây':'kho'?> - Mã <?=getvalue($first_record, 'id')?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <?php $controlerObj->load_view('elements/messages'); ?>
                    <div class="note note-warning">
                        <p>* Vui lòng chọn mã hàng từ danh sách.</p>
                    </div>
                    <form id="frmExportInventory" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                        <div class="form-group col-lg-4 col-md-4">
                            <label class="control-label">Nguời xuất</label>
                            <input class="form-control" value="<?=$logged_user['fullname']?>" readonly=""/>
                            <input type="hidden" value="<?=$logged_user['user_id']?>" name="user_id"/>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 padding-left">
                            <label for="export_date" class="control-label">Ngày *</label>
                            <input class="form-control" id="export_date" name="export_date" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=date('d/m/Y', strtotime('-1 year'))?>" data-date-enddate="<?=date('d/m/Y')?>" value="<?=date('d/m/Y', strtotime($first_record['export_date']))?>" readonly=""/>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="warehouse_id" class="control-label">Kho *</label>
                            <?php echo html_select($warehouses, 'id', 'name', 'name="warehouse_id" disabled="" required="" class="form-control" id="warehouse_id"', null, getvalue($first_record, '$first_record'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 padding-left">
                            <label for="item_type_id" class="control-label">Loại hàng *</label>
                            <?php echo html_select($item_types, 'id', 'type_name', 'name="item_type_id" disabled="" class="form-control" id="item_type_id"', null, getvalue($first_record, 'type_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="clear"></div>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-export">
                            <thead>
                            <tr>
                                <th style="width: 120px;">Mã hàng *</th>
                                <th style="width: 350px;">Thông tin</th>
                                <th style="width: 120px;">Số lượng *</th>
                                <th style="width: 120px;">SL chi tiết</th>
                                <th>Ghi chú</th>
                                <th style="width: 85px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($details as $item):?>
                                <tr>
                                    <td><input type="text" disabled="" class="form-control item_code" id="item_code" name="item_code[]" placeholder="Mã hàng" value="<?=getvalue($item, 'code')?>"/></td>
                                    <td class="details">
                                        <?php
                                        $details = $item['name']. ' - '. $item['unit'];
                                        if (getvalue($item, 'unit_in_details'))
                                            $details .= ' - '. $item['unit_in_details'];
                                        echo $details;
                                        ?>
                                    </td>
                                    <td><input type="text" disabled="" class="form-control float" id="item_quantity" name="item_quantity[]" placeholder="Số lượng" value="<?=getvalue($item, 'quantity')?>"/></td>
                                    <td><input type="text" disabled=""  class="form-control float" id="item_quantity_in_details" name="item_quantity_in_details[]" placeholder="SL chi tiết" value="<?=getvalue($item, 'quantity_in_details')?>"/></td>
                                    <td><input type="text" disabled="" class="form-control" id="item_description" name="item_description[]" placeholder="Ghi chú" value="<?=getvalue($item, 'detail_description')?>"/></td>
                                    <td>
                                        <input type="hidden" name="item_id[]" id="item_id" value="<?=getvalue($item, 'item_id')?>"/>
                                        <a href="#" style="display: none;" class="add_row btn btn-sm" title="Thêm dòng"><i class="fa fa-plus"></i></a>
                                        <a href="#" style="display: none;" class="remove_row btn btn-sm" title="Xóa dòng"><i class="fa fa-minus"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label class="control-label" for="description">Ghi chú</label>
                            <textarea class="form-control" disabled="" id="description" name="description" rows="2" cols="30"><?=getvalue($first_record, 'description')?></textarea>
                        </div><div class="form-group">
                            <button id="edit" type="button" class="btn btn-warning"><i class="fa fa-edit"></i> Sửa</button>
                            <button id="delete" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Xóa</span></button>
                            <button id="submit" style="display: none;" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['inventory_export']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" id="export_id" name="export_id" value="<?=$id?>"/>
                            <input type="hidden" name="action" value="admin_edit_export_inventory"/>
                            <input type="hidden" id="is_fruit" name="is_fruit" value="<?=empty($is_fruit)?0:1?>" />
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