    <div id="content-wrapper">
        <div id="page-wrapper">
            <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID phiếu thu chi không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> phiếu thu chi</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmVoucher" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
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
                            <label for="type_id" class="control-label">Loại *</label>
                            <?php echo html_select($types, 'code', 'name', 'name="type" class="form-control" id="type"', null, getvalue($obj, 'type'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="control-label">Số tiền *</label>
	                        <input type="text" class="form-control number normal inline" id="amount" name="amount" placeholder="Số tiền" required="" data-error="Vui lòng nhập số tiền" maxlength="8" value="<?=intval(getvalue($obj, 'amount', 0)*1000)?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="control-label">Nhân viên *</label>
                            <?php echo html_select($members, 'user_id', 'fullname', 'name="user_id" class="form-control" id="user_id"', null, getvalue($obj, 'user_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="control-label">Cửa hàng *</label>
                            <?php echo html_select($branches, 'id', 'branch_name', 'name="branch_id" class="form-control" id="branch_id"', null, getvalue($obj, 'branch_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Nội dung *</label>
                            <textarea class="form-control" id="description" name="description" rows="2" required="" cols="30" data-error="Vui lòng nhập nội dung phiếu thu"><?=getvalue($obj, 'description')?></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['vouchers']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_voucher"/>
                            <input type="hidden" name="voucher_id" id="voucher_id" value="<?=$id?>"/>
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