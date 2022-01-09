    <div id="content-wrapper">
        <div id="page-wrapper">
            <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID tài khoản không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> người dùng</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form id="frmUser" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="username" class="control-label">Tài khoản *</label>
                            <?php if ($id):?>
                                <input type="text" class="form-control" id="username" disabled="" value="<?=getvalue($obj, 'username')?>"/>
                            <?php else: ?>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" data-minlength="4" required="" data-error="Vui lòng nhập tài khoản" />
                                <span class="help-block with-errors">Tài khoản phải có ít nhất 4 ký tự.</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Mật khẩu <?=$id?'':'*'?></label>
                            <input type="password" <?=$id?'':'required=""'?> placeholder="Mật khẩu" id="password" name="password" class="form-control" data-minlength="5" data-error="Vui lòng nhập mật khẩu"/>
                            <span class="help-block with-errors">Mật khẩu phải có ít nhất 5 ký tự.</span>
                        </div>
                        <div class="form-group">
                            <label for="fullname" class="control-label">Họ Tên *</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ Tên" required="" data-error="Vui lòng nhập họ tên" value="<?=getvalue($obj, 'fullname')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="Vui lòng nhập email chính xác" required="" value="<?=getvalue($obj, 'email')?>"/>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="type_id" class="control-label">Loại *</label>
                            <?php echo html_select($user_types, 'type_id', 'type_name', 'name="type_id" class="form-control" id="type_id"', null, getvalue($obj, 'type_id', MEMBER_TYPE_ID));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="type_id" class="control-label">Cửa hàng *</label>
                            <?php echo html_select($branches, 'id', 'branch_name', 'name="branch_id" class="form-control" id="branch_id" data-error="Vui lòng chọn chi nhánh" required=""', null, getvalue($obj, 'branch_id', 1));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="rate_per_hour" class="control-label">Lương/giờ (1000VNĐ) *</label>
                            <input type="text" class="form-control number" id="rate_per_hour" name="rate_per_hour" placeholder="Lương theo giờ" required="" maxlength="2" data-error="Vui lòng nhập lương theo giờ" value="<?=getvalue($obj, 'rate_per_hour')?>"/>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="mobile_number" class="control-label">Số điện thoại</label>
                            <input type="text" class="form-control number-with-space" id="mobile_number" name="mobile_number" placeholder="Số điện thoại" value="<?=getvalue($logged_user, 'mobile_number')?>" />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="is_fulltime" name="is_fulltime" value="1" <?=getvalue($obj, 'is_fulltime')?'checked=""':''?> />
                            <label for="is_fulltime">Làm Fulltime</label>
                            <div class="help-block with-errors">Khi chọn thì Phụ cấp tiền ăn sẽ được thêm khi tính lương.</div>
                        </div>
                        <div class="form-group">
                            <label for="salary_per_month" class="control-label">Lương cố định</label>
                            <input style="width: 120px;text-align: right;" type="text" class="form-control number inline" id="salary_per_month" name="salary_per_month" value="<?=getvalue($obj, 'salary_per_month', 0)?>" />
                            <span class="form-currency">.000đ</span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="parking_fee" class="control-label">Phí giữ xe mặc định</label>
                            <input style="width: 60px;text-align: right;" type="text" class="form-control number inline" id="parking_fee" name="parking_fee" value="<?=getvalue($obj, 'parking_fee', 0)?>" />
                            <span class="form-currency">.000đ</span>
                            <div class="help-block with-errors">Hiển thị mặc định trên màn hình đánh giá của user.</div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="need_deposit" name="need_deposit" value="1" <?=getvalue($obj, 'need_deposit')?'checked=""':''?> />
                            <label for="need_deposit">Còn cọc lương</label>
                        </div>
                        <div class="form-group hours_deposit_container <?=getvalue($obj, 'need_deposit')?'':'hidden'?>">
                            <label for="hours_deposit" class="control-label">Số giờ cần giữ cọc *</label>
                            <input type="text" class="form-control float" id="hours_deposit" name="hours_deposit" placeholder="Số giờ cần giữ cọc" maxlength="3" data-error="Vui lòng nhập số giờ cần giữ cọc" value="<?=getvalue($obj, 'hours_deposit')?>"/>
                            <div class="help-block with-errors">Nhập tổng giờ cần giữ cọc (ví dụ: 16 cho 2 ngày 8 giờ) để cho nhân viên tính lương theo giờ</div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="do_shipping" name="do_shipping" value="1" <?=getvalue($obj, 'do_shipping')?'checked=""':''?> />
                            <label for="do_shipping">Giao hàng</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="enabled" name="enabled" value="1"  <?=getvalue($obj, 'enabled')?'checked=""':''?>/>
                            <label for="enabled">Đang hoạt động</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label for="description" class="control-label">Ghi chú</label>
                        <textarea class="form-control" id="description" name="description" ><?=getvalue($obj, 'description')?></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['users']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_user"/>
                            <input type="hidden" name="user_id" id="user_id" value="<?=$id?>"/>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.row -->
            <?php endif;?>
        </div>
        <!-- /#page-wrapper -->
    </div><!-- /#content-wrapper -->