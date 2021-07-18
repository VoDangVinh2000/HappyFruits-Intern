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
                price: '<?=$item['default_price']?>',
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
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-download"></i> Thêm phiếu nhập <?=$is_fruit?'trái cây':'kho'?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <?php $controlerObj->load_view('elements/messages'); ?>
                    <form id="frmImportInventory" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                      <div class="form-group col-lg-4 col-md-4">
                        <label class="control-label">Nguời nhập</label>
                        <input class="form-control" value="<?=$logged_user['fullname']?>" readonly=""/>
                        <input type="hidden" value="<?=$logged_user['user_id']?>" name="user_id"/>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 padding-left">
                        <label for="import_date" class="control-label">Ngày *</label>
                        <input class="form-control" id="import_date" name="import_date" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=date('d/m/Y', strtotime('-1 year'))?>" data-date-enddate="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" readonly=""/>
                      </div>
                      <div class="clear"></div>
                      <div class="form-group col-lg-4 col-md-4">
                        <label for="warehouse_id" class="control-label">Kho *</label>
                        <?php echo html_select($warehouses, 'id', 'name', 'name="warehouse_id" required="" class="form-control" id="warehouse_id"', null, RAW_INVENTORY_ID);?>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 padding-left">
                        <label for="item_type_id" class="control-label">Loại hàng *</label>
                        <?php echo html_select($item_types, 'id', 'type_name', 'name="item_type_id" class="form-control" id="item_type_id"');?>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="clear"></div>
                      <table class="table table-striped table-bordered table-hover" id="dataTables-import">
                        <thead>
                            <tr>
                                <th style="width: 120px;">Mã hàng *</th>
                                <th style="width: 250px;">Tên hàng *</th>
	                            <th style="width: 200px;">Nơi nhập</th>
                                <th style="width: 100px;">Đơn vị *</th>
                                <th style="width: 120px;">Số lượng *</th>
                                <th style="width: 150px;">Đơn giá *</th>
                                <th>Ghi chú</th>
                                <th style="width: 85px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control item_code" id="item_code" name="item_code[]" placeholder="Mã hàng"/></td>
                                <td><input type="text" class="form-control item_name" id="item_name" name="item_name[]" placeholder="Tên hàng"/></td>
	                            <td><?=html_select($providers, 'id', 'provider_name', 'class="form-control" name="item_provider[]"', 'Nhà cung cấp')?></td>
                                <td><input type="text" class="form-control" id="item_unit" name="item_unit[]" placeholder="Đơn vị"/></td>
                                <td><input type="text" class="form-control float" id="item_quantity" name="item_quantity[]" placeholder="Số lượng"/></td>
                                <td><input type="text" class="form-control float inline" id="item_price" name="item_price[]" placeholder="0"/><span></span></td>
                                <td><input type="text" class="form-control" id="item_description" name="item_description[]" placeholder="Ghi chú"/></td>
                                <td>
                                    <input type="hidden" name="item_id[]" id="item_id" value=""/>
                                    <a href="#" class="add_row btn btn-sm" title="Thêm dòng"><i class="fa fa-plus"></i></a>
                                    <a href="#" class="remove_row btn btn-sm" title="Xóa dòng"><i class="fa fa-minus"></i></a></td>
                            </tr>
                        </tbody>
                      </table>
                      <div class="form-group">
                        <label class="control-label" for="description">Ghi chú</label>
                        <textarea class="form-control" id="description" name="description" rows="2" cols="30"></textarea>
                      </div><div class="form-group">
                        <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                        <a href="<?=BASE_URL. $URIs['inventory_import']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                        <input type="hidden" name="action" value="admin_import_inventory"/>
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