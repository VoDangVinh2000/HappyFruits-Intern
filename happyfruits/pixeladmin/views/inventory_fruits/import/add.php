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
			type_name: '<?=$item['type_name']?>',
			value: '<?=$item['name']?>',
			label: '<?=$item['code']. ' - '. $item['name']?>',
		}
	);
	<?php endforeach; ?>
	<?php endif;?>
</script>
<div id="content-wrapper">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header"><i class="fa fa-download"></i> Thêm phiếu nhập trái cây</h2>
				<p style="margin-bottom: 20px;color: red;">
					KHÔNG nhập trái cây có giá và không giá trong cùng 1 phiếu nhập.<br/>
					KHÔNG nhập các loại trái cây đã thanh toán và chưa thanh toán trong cùng 1 phiếu.<br/>
					Tình trạng thanh toán là lưu công nợ thì tiền nhập hàng sẽ được lưu vào phần quản lý công nợ.<br/>
					Chỉ lưu công nợ cho 1 nhà cung cấp (nơi nhập).<br/>
                    Chọn đúng THỜI GIAN thanh toán công nợ thực tế cho từng nơi đặt hàng.
				</p>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<?php $controlerObj->load_view('elements/messages'); ?>
				<form id="frmImportInventory" role="form" method="post" class="one-line" action="<?=BASE_URL?>xu-ly">
					<div class="form-group col-lg-4 col-md-4">
						<label class="control-label">Nguời nhập</label>
						<input class="form-control" value="<?=$logged_user['fullname']?>" readonly=""/>
						<input type="hidden" value="<?=$logged_user['user_id']?>" name="user_id"/>
					</div>
					<div class="form-group col-lg-4 col-md-4">
						<label for="import_date" class="control-label">Ngày *</label>
						<input class="form-control" id="import_date" name="import_date" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=date('d/m/Y', strtotime('-1 year'))?>" data-date-enddate="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" readonly=""/>
					</div>
					<div class="form-group col-lg-4 col-md-4">
						<label for="warehouse_id" class="control-label">Kho *</label>
						<?php echo html_select($warehouses, 'id', 'name', 'name="warehouse_id" required="" class="form-control" id="warehouse_id"', null, RAW_INVENTORY_ID);?>
						<div class="help-block with-errors"></div>
					</div>
					<div class="clear"></div>
					<table class="table table-striped table-bordered table-hover" id="dataTables-import">
						<thead>
						<tr>
							<th style="width: 120px;">Mã *</th>
							<th style="width: 250px;">Trái cây *</th>
							<th style="width: 200px;">Nơi nhập</th>
							<th style="width: 120px;">Số lượng *</th>
							<th style="width: 150px;">Đơn giá *</th>
							<th>Ghi chú</th>
							<th style="width: 85px;"></th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td><input type="text" class="form-control item_code" id="item_code" name="item_code[]" placeholder="Mã hàng"/></td>
							<td><div class="item_info"></div></td>
							<td><?=html_select($providers, 'id', 'provider_name', 'class="form-control" name="item_provider[]"', 'Nhà cung cấp')?></td>
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
						<label for="total" class="control-label">Tiền ship hàng từ tỉnh *</label>
						<input type="text" class="form-control number" required="" id="shipping_fee" name="shipping_fee" placeholder="Tiền giao hàng" maxlength="8" value="0" />
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="total" class="control-label">Tiền nhập hàng</label>
						<input type="text" class="form-control number" id="total" disabled placeholder="Tiền nhập hàng" data-minlength="6"  maxlength="8" />
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<input type="checkbox" id="has_invoice" name="has_invoice" value="1"/>
						<label for="has_invoice">Có hóa đơn đỏ</label>
					</div>
					<div class="form-group">
						<label for="payment_status" class="control-label">Tình trạng thanh toán *</label>
						<?php echo html_select_payment_status('name="payment_status" required="" class="form-control" id="payment_status"');?>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group cashier-group" style="display: none;">
						<label class="control-label">Nhân viên thanh toán *</label>
						<?php echo html_select($cashiers, 'user_id', 'fullname', 'name="cashier_id" class="form-control" id="cashier_id"', '- Chưa chọn');?>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="payment_date" class="control-label">Ngày thanh toán*</label>
						<input class="form-control" id="payment_date" name="payment_date" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=date('d/m/Y')?>" data-date-enddate="<?=date('d/m/Y', strtotime('+3 months'))?>" value="<?=date('d/m/Y')?>" readonly=""/>
					</div>
					<div class="form-group">
						<label class="control-label" for="description">Ghi chú</label>
						<textarea class="form-control" id="description" name="description" rows="2" cols="30"></textarea>
					</div><div class="form-group">
						<button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
						<a href="<?=BASE_URL. $URIs['inventory_import_fruits']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
						<input type="hidden" name="action" value="admin_import_inventory_fruits"/>
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