<div id="content-wrapper">
    <div id="page-wrapper">
        <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID nhà cung cấp không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> nhà cung cấp</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmProvider" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
	                    <div class="form-group">
                            <label for="provider_name" class="control-label">Tên *</label>
                            <input type="text" class="form-control" id="provider_name" name="provider_name" placeholder="Tên" required="" data-error="Vui lòng nhập tên" value="<?=getvalue($obj, 'provider_name')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
	                    <div class="form-group">
		                    <label for="provider_type" class="control-label">Loại nhà cung cấp*</label>
		                    <?php echo html_select_provider_types('name="provider_type" required="" id="provider_type" class="form-control"', '-- Chọn', getvalue($obj, 'provider_type'));?>
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <div class="form-group">
		                    <label for="type_id" class="control-label">Cung cấp *</label>
		                    <?php echo html_select_array($types, 'name="type" required="" id="type" class="form-control"', '-- Chọn', getvalue($obj, 'type'));?>
		                    <div class="help-block with-errors"></div>
	                    </div>
                        <div class="form-group">
                            <label for="address" class="control-label">Địa chỉ *</label>
                            <input type="text" class="form-control" id="provider_address" name="provider_address" placeholder="Địa chỉ" required="" data-error="Vui lòng nhập địa chỉ" value="<?=getvalue($obj, 'provider_address')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="control-label">Số điện thoại *</label>
                            <input type="text" class="form-control number" id="mobile" name="mobile" placeholder="Số điện thoại" required="" data-error="Vui lòng nhập số điện thoại" data-minlength="10" data-minlength-error="Vui lòng nhập ít nhất 10 số" maxlength="12" value="<?=getvalue($obj, 'mobile')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="Vui lòng nhập email chính xác" value="<?=getvalue($obj, 'email')?>"/>
                            <div class="help-block with-errors"></div>
                        </div>
	                    <h3>Ngân hàng</h3>
	                    <div class="form-group">
		                    <label for="bank_name" class="control-label">Tên ngân hàng</label>
		                    <input type="bank_name" class="form-control" id="bank_name" name="bank_name" placeholder="Tên ngân hàng"  value="<?=getvalue($obj, 'bank_name')?>"/>
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <div class="form-group">
		                    <label for="bank_account_name" class="control-label">Tên người nhận</label>
		                    <input type="bank_account_name" class="form-control" id="bank_account_name" name="bank_account_name" placeholder="Tên người nhận"  value="<?=getvalue($obj, 'bank_account_name')?>"/>
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <div class="form-group">
		                    <label for="bank_account_number" class="control-label">Số tài khoản</label>
		                    <input type="bank_account_number" class="form-control" id="bank_account_number" name="bank_account_number" placeholder="Số tài khoản"  value="<?=getvalue($obj, 'bank_account_number')?>"/>
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <h3>Thông tin hóa đơn</h3>
	                    <div class="form-group">
		                    <label for="company_name" class="control-label">Tên công ty</label>
		                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Tên công ty" value="<?=getvalue($obj, 'company_name')?>" />
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <div class="form-group">
		                    <label for="company_tax_code" class="control-label">Mã số thuế</label>
		                    <input type="text" class="form-control" id="company_tax_code" name="company_tax_code" placeholder="Mã số thuê" value="<?=getvalue($obj, 'company_tax_code')?>" />
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <div class="form-group">
		                    <label for="company_address" class="control-label">Địa chỉ công ty</label>
		                    <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Địa chỉ công ty" value="<?=getvalue($obj, 'company_address')?>" />
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <div class="form-group">
		                    <label for="VAT_rate" class="control-label">Hệ số VAT (5, 10)</label>
		                    <input type="text" class="form-control number" id="VAT_rate" name="VAT_rate" placeholder="Hệ số VAT (%)" value="<?=getvalue($obj, 'VAT_rate')?>" />
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <h3>Khác</h3>
                        <div class="form-group">
                            <label for="description" class="control-label">Ghi chú</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Ghi chú"><?=getvalue($obj, 'description')?></textarea>
                        </div>
                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['providers']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_provider"/>
                            <input type="hidden" name="provider_id" id="provider_id" value="<?=$id?>"/>
                            <input type="hidden" name="lat" id="lat" value="<?=getvalue($obj, 'lat')?>"/>
                            <input type="hidden" name="lng" id="lng" value="<?=getvalue($obj, 'lng')?>"/>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div id="map_canvas" style="height: 450px;"></div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php endif;?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->
