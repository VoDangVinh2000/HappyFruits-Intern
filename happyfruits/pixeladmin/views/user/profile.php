    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmUser" data-toggle="validator" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                      <div class="form-group">
                        <label for="username" class="control-label">Tài khoản</label>
                        <input type="text" class="form-control" id="username" disabled="" value="<?=getvalue($logged_user, 'username')?>"/>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="password">Mật khẩu</label>
                          <input type="password" id="password" name="password" class="form-control" data-minlength="5" />
                          <span class="help-block">Mật khẩu phải có ít nhất 5 ký tự.</span>
                      </div>
                      <div class="form-group">
                        <label for="fullname" class="control-label">Họ Tên *</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ Tên" required="" data-error="Vui lòng nhập họ tên" value="<?=getvalue($logged_user, 'fullname')?>" />
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="control-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="Vui lòng nhập email chính xác" required="" value="<?=getvalue($logged_user, 'email')?>"/>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="mobile_number" class="control-label">Số điện thoại</label>
                        <input type="text" class="form-control number-with-space" id="mobile_number" name="mobile_number" placeholder="Số điện thoại" value="<?=getvalue($logged_user, 'mobile_number')?>" />
                      </div>
                      <div class="form-group">
                        <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                        <a href="<?=BASE_URL?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại trang chủ</a>
                        <input type="hidden" name="action" value="update_user"/>
                        <input type="hidden" name="user_id" id="user_id" value="<?=$logged_user['user_id']?>"/>
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