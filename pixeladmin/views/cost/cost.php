    <div id="content-wrapper">
        <div id="page-wrapper">
            <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID bản lưu chi phí không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> bản lưu chi phí</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmMain" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                        <div class="form-group">
                            <label for="date_time" class="control-label">Ngày *</label>
                            <div class="input-group date" id="datetimepicker" data-maxDate="<?=strtotime('+1 day')?>" data-minDate="<?=strtotime('-1 month')?>" data-defaultDate="<?=strtotime(getvalue($obj, 'date_time', date('Y-m-d H:i')))?>" >
                                <input type='text' id="date_time" name="date_time" class="form-control"/>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
	                    <div class="form-group">
		                    <label for="name" class="control-label">Tên *</label>
		                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên" required="" data-error="Tên bản lưu" value="<?=getvalue($obj, 'name')?>" />
		                    <div class="help-block with-errors"></div>
	                    </div>
                        <div class="form-group">
                            <label for="type_id" class="control-label">Loại *</label>
                            <?php echo html_select($types, 'id', 'name', 'name="type_id" class="form-control" id="type_id"', null, getvalue($obj, 'type_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="control-label">Số tiền *</label>
	                        <input type="text" class="form-control number normal inline" id="amount" name="amount" placeholder="Số tiền" required="" data-error="Vui lòng nhập số tiền" maxlength="8" value="<?=getvalue($obj, 'amount', 0)?>" />
                            <div class="help-block with-errors"></div>
                        </div>
	                    <div class="form-group">
		                    <label for="payment_type" class="control-label">Loại tiền</label>
		                    <?php echo html_select_payment_type('name="payment_type" class="form-control" id="payment_type"', null, getvalue($obj, 'payment_type'));?>
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
                            <a href="<?=BASE_URL. $URIs['costs']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_cost"/>
                            <input type="hidden" name="cost_id" id="cost_id" value="<?=$id?>"/>
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