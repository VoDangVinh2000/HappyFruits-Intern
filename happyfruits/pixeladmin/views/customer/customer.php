<div id="content-wrapper">
	<div id="page-wrapper">
		<?php if ($id && !$obj):?>
		
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header"><i class="fa fa-warning"></i> ID khách hàng không đúng!!</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		<?php else:?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id ? 'Thêm':'Sửa thông tin'?> khách hàng</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<form id="frmCustomer" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
						<div class="form-group">
							<label for="customer_name" class="control-label">Họ Tên *</label>
							<input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Họ Tên" required="" data-error="Vui lòng nhập họ tên" value="<?=getvalue($obj, 'customer_name')?>" />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="mobile" class="control-label">Số điện thoại *</label>
							<input type="text" class="form-control number" id="mobile" name="mobile" placeholder="Số điện thoại" required="" data-error="Vui lòng nhập số điện thoại" data-minlength="10" data-minlength-error="Vui lòng nhập ít nhất 10 số" maxlength="12" value="<?=getvalue($obj, 'mobile')?>" />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="type_id" class="control-label">Quận *</label>
							<?php echo html_select_district('form-control', 'Chọn', 'required="" data-error="Vui lòng chọn quận"', false, getvalue($obj, 'district'));?>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Địa chỉ *</label>
							<input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" required="" data-error="Vui lòng nhập địa chỉ" value="<?=getvalue($obj, 'address')?>" />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Tòa nhà</label>
							<input type="text" class="form-control" id="building" name="building" placeholder="Tòa nhà" value="<?=getvalue($obj, 'building')?>" />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Tên công ty</label>
							<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Tên công ty" value="<?=getvalue($obj, 'company_name')?>" />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Mã số thuế</label>
							<input type="text" class="form-control" id="company_tax_code" name="company_tax_code" placeholder="Mã số thuê" value="<?=getvalue($obj, 'company_tax_code')?>" />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Địa chỉ công ty</label>
							<input type="text" class="form-control" id="company_address" name="company_address" placeholder="Địa chỉ công ty" value="<?=getvalue($obj, 'company_address')?>" />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="distance" class="control-label">Khoảng cách (km) *</label>
							<input type="text" class="form-control float" id="distance" name="distance" placeholder="Khoảng cách" required="" data-error="Vui lòng nhập khoảng cách" maxlength="6" value="<?=getvalue($obj, 'distance')?>" />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="Vui lòng nhập email chính xác" value="<?=getvalue($obj, 'email')?>"/>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="type_id" class="control-label">Loại *</label>
							<?php echo html_select($customer_types, 'type_id', 'long_name', 'name="type_id" class="form-control" id="type_id"', null, getvalue($obj, 'type_id'));?>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<input type="checkbox" id="is_locked" name="is_locked" value="1"  <?=getvalue($obj, 'is_locked')?'checked=""':''?>/>
							<label for="is_locked">Khóa vị trí</label>
							<div class="help-block">Chọn khi vị trí của khách hàng đã chính xác.</div>
						</div>
						<div class="form-group">
							<label for="description" class="control-label">Ghi chú</label>
							<textarea class="form-control" id="description" name="description" placeholder="Ghi chú"><?=getvalue($obj, 'description')?></textarea>
						</div>
						<div class="form-group">
							<button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
							<a href="<?=BASE_URL. $URIs['customers']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
							<input type="hidden" name="action" value="admin_update_customer"/>
							<input type="hidden" name="customer_id" id="customer_id" value="<?=$id?>"/>
							<input type="hidden" name="lat" id="lat" value="<?=getvalue($obj, 'lat')?>"/>
							<input type="hidden" name="lng" id="lng" value="<?=getvalue($obj, 'lng')?>"/>
						</div>
					</form>
				</div>
				<div class="col-lg-6 col-md-6">
					<div id="map_canvas" style="height: 450px;"></div>
					<br />
					<button id="view_route" type="button" class="btn btn-warning">Đường đi</button>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		<?php endif;?>
	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->
