    <div id="content-wrapper">
        <div id="page-wrapper">
            <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID công nợ khách hàng không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> công nợ khách hàng</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmMain" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
	                    <div class="form-group">
		                    <label for="name" class="control-label">Tên *</label>
		                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên" required="" data-error="Tên bản lưu" value="<?=getvalue($obj, 'name')?>" />
		                    <div class="help-block with-errors"></div>
	                    </div>
                        <div class="form-group">
                            <label for="amount" class="control-label">Tiền công nợ *</label>
	                        <input type="text" class="form-control number normal inline" id="amount" name="amount" placeholder="Tiền công nợ" required="" data-error="Vui lòng nhập số tiền" maxlength="8" value="<?=getvalue($obj, 'amount', 0)?>" />
                            <div class="help-block with-errors"></div>
                        </div>
	                    <?php if(Users::is_admin()):?>
                        <div class="form-group">
                            <label for="user_id" class="control-label">Nhân viên *</label>
                            <?php echo html_select($members, 'user_id', 'fullname', 'name="user_id" class="form-control" id="user_id"', null, getvalue($obj, 'user_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
	                    <?php else: ?>
		                    <input type="hidden" name="user_id" value="<?=getvalue($obj, 'user_id', $logged_user['user_id'])?>"/>
	                    <?php endif;?>
	                    <div class="form-group">
		                    <label for="status" class="control-label">Tình trạng *</label>
		                    <?php echo html_select_customer_debt_status('name="status" class="form-control" id="status"', null, getvalue($obj, 'status'));?>
		                    <div class="help-block with-errors"></div>
	                    </div>
	                    <div class="paid" style="display: none;">
		                    <h4>Đã thanh toán</h4>
		                    <div class="form-group">
			                    <label for="payment_date" class="control-label">Ngày thanh toán *</label>
			                    <div class="input-group date" id="datetimepicker" data-maxDate="<?=strtotime('+1 day')?>" data-minDate="<?=strtotime('-1 month')?>" data-defaultDate="<?=strtotime(getvalue($obj, 'date_time', date('Y-m-d H:i')))?>" >
				                    <input type='text' id="payment_date" name="payment_date" class="form-control"/>
				                    <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
			                    </div>
			                    <div class="help-block with-errors"></div>
		                    </div>
		                    <div class="form-group">
			                    <label for="payment_type" class="control-label">Loại thanh toán</label>
			                    <?php echo html_select_payment_type('name="payment_type" class="form-control" id="payment_type"', null, getvalue($obj, 'payment_type'));?>
			                    <div class="help-block with-errors"></div>
		                    </div>
		                    <div class="form-group">
			                    <label for="paid_amount" class="control-label">Tiền thanh toán</label>
			                    <input type="text" class="form-control number normal inline" id="paid_amount" name="paid_amount" placeholder="Tiền thanh toán" maxlength="8" value="<?=getvalue($obj, 'paid_amount', 0)?>" />
			                    <div class="help-block with-errors"></div>
		                    </div>
	                    </div>
	                    <?php if(count($branches) > 1): ?>
                        <div class="form-group">
                            <label for="user_id" class="control-label">Cửa hàng *</label>
                            <?php echo html_select($branches, 'id', 'branch_name', 'name="branch_id" class="form-control" id="branch_id"', null, getvalue($obj, 'branch_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
		                <?php else: ?>
		                    <input type="hidden" name="branch_id" value="<?=$branches[0]['id']?>"/>
		                <?php endif; ?>
                        <div class="form-group">
                            <label class="control-label" for="description">Nội dung</label>
                            <textarea class="form-control" id="description" name="description" rows="2" cols="30"><?=getvalue($obj, 'description')?></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['customer_debts']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_debt"/>
                            <input type="hidden" name="debt_id" id="debt_id" value="<?=$id?>"/>
                        </div>
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php endif;?>
        </div>
        <!-- /#page-wrapper -->
    </div><!-- /#content-wrapper -->