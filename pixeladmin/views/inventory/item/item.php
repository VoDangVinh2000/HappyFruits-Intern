<div id="content-wrapper">
    <div id="page-wrapper">
        <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID <?=$is_fruit?'trái cây':'hàng hóa'?> không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> <?=$is_fruit?'trái cây':'hàng hóa'?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form id="frmItem" data-toggle="validator" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="type_id" class="control-label">Loại <?=$is_fruit?'trái cây':'hàng'?> *</label>
                            <?php echo html_select($item_types, 'id', 'type_name', 'name="type_id" required="" id="type_id" class="form-control"', '-- Chọn', getvalue($obj, 'type_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <?php if($is_fruit):?>
                            <div class="form-group">
                                <label for="category_id" class="control-label">Phân loại</label>
                                <?php echo html_select($item_categories, 'id', 'category_name', 'name="category_id" id="category_id" class="form-control"', '-- Chọn', getvalue($obj, 'category_id'));?>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="warehouse_id" class="control-label">Kho</label>
                                <?php echo html_select($warehouses, 'id', 'name', 'name="warehouse_id" id="warehouse_id" class="form-control"', null, getvalue($obj, 'warehouse_id'));?>
                                <div class="help-block with-errors"></div>
                            </div>
                        <?php else:?>
                            <input type="hidden" name="category_id" value="<?=getvalue($obj, 'category_id')?>"/>
                            <input type="hidden" name="warehouse_id" value="<?=getvalue($obj, 'warehouse_id')?>"/>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="name" class="control-label">Tên *</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên hàng hóa" required="" data-error="Vui lòng nhập tên hàng hóa" value="<?=getvalue($obj, 'name')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="code" class="control-label">Mã * <span style="color: red; font-weight: normal; font-size: 90%;">(Chữ IN HOA không dấu)</span></label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Mã" required="" data-error="Vui lòng nhập mã hàng" value="<?=getvalue($obj, 'code')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="unit" class="control-label">Đơn vị tính *</label>
                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Đơn vị tính" required="" data-error="Vui lòng nhập đơn vị tính" value="<?=getvalue($obj, 'unit')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="unit" class="control-label">Đơn giá *</label>
                            <input type="text" class="form-control" id="default_price" name="default_price" placeholder="Đơn giá" required="" data-error="Vui lòng nhập đơn giá" value="<?=getvalue($obj, 'default_price')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="warning_quanity" class="control-label">Số lượng cảnh báo *</label>
                            <input type="text" class="form-control float" id="warning_quanity" name="warning_quanity" placeholder="Số lượng cảnh báo" required="" data-error="Vui lòng nhập số lượng cảnh báo" value="<?=formatQuantity(getvalue($obj, 'warning_quanity', WARNING_QUANTITY))?>" />
                            <div class="help-block with-errors">Hàng hóa có số lượng dưới giá trị này sẽ được cảnh báo</div>
                        </div>
                        <div class="form-group">
                            <label for="required_quantity" class="control-label">Số lượng cần</label>
                            <input type="text" class="form-control float" id="required_quantity" name="required_quantity" placeholder="Số lượng cần" value="<?=formatQuantity(getvalue($obj, 'required_quantity'))?>" />
                            <div class="help-block with-errors">Số lượng cần thiết của hàng hóa</div>
                        </div>
                        <?php if (empty($is_fruit)):?>
                        <div class="form-group">
                            <label for="quantity_in_details" class="control-label">Số lượng chi tiết</label>
                            <input type="text" class="form-control float" id="quantity_in_details" name="quantity_in_details" placeholder="Số lượng chi tiết" value="<?=formatQuantity(getvalue($obj, 'quantity_in_details'))?>" />
                            <div class="help-block">Ví dụ 1 bọc ống hút có 30 cái. Nhập: 30</div>
                        </div>
                        <div class="form-group">
                            <label for="unit_in_details" class="control-label">Đơn vị chi tiết</label>
                            <input type="text" class="form-control" id="unit_in_details" name="unit_in_details" placeholder="Đơn vị chi tiết" value="<?=getvalue($obj, 'unit_in_details')?>" />
                            <div class="help-block">Ví dụ 1 bọc ống hút có 30 cái. Nhập: cái</div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <input type="checkbox" id="enabled" name="enabled" value="1"  <?=getvalue($obj, 'enabled')?'checked=""':''?>/>
                            <label for="enabled">Đang hoạt động</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. (empty($is_fruit)?$URIs['inventory_item']:$URIs['inventory_item_fruits'])?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_inventory_item"/>
                            <input type="hidden" name="item_id" id="item_id" value="<?=$id?>"/>
                            <input type="hidden" id="is_fruit" name="is_fruit" value="<?=empty($is_fruit)?0:1?>" />
                        </div>

                    </div>
                </form>
            </div>
            <!-- /.row -->
        <?php endif;?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->