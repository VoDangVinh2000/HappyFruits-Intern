        <script type="text/javascript">var $pem = '<?=KEY_PUBLIC?>';</script>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div style="padding: 0 20px;">
                        <h2 class="font-utm">Vui lòng đăng nhập</h2>
                    </div>
                    <div class="panel-body">
                        <?php $controlerObj->load_view('elements/messages'); ?>
                        <form id="loginFrm" class="allow_enter" data-toggle="validator" role="form" action="<?=BASE_URL?>xu-ly" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Tài khoản" name="username" id="username" type="text" autofocus required maxlength="40"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu" id="password" type="password" value="" required maxlength="40"/>
                                    <input name="password" id="e-password" type="hidden" value=""/>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-sign-in"></i>&nbsp;<span>Đăng nhập</span></button>
                                </div>
                            </fieldset>
                            <input type="hidden" value="login" name="action"/>
                            <input type="text" class="honey" value="" name="honey"/>
                            <input type="hidden" name="token" value="<?php echo md5("info@". DOMAIN_NAME . date("WY"));?>"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>