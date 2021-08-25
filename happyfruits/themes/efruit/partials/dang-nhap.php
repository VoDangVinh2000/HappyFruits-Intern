<div class="container-customer-account">
    <div class="customer-account">
        <div class="container">
            <div class="row ">
                <!-- <div class="container-form"> -->
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    <div class="form-account">
                        <div class="header-create-account">
                            <h2 class="efruit-vi">Đăng Nhập</h2>
                            <h2 class="efruit-en">Login</h2>
                            <p class="efruit-vi">Vui lòng nhập đầy đủ thông tin của bạn.</p>
                            <p class="efruit-en">Please login using account detail bellow.</p>
                        </div>

                        <div class="error notification-error">
                            <?php
                            if (isset($_COOKIE['error_email'])) {
                                echo $_COOKIE['error_email'] . "</br>";
                            }

                            ?>
                        </div>
                        <div class="notification-success">
                            <?php
                            if (isset($_COOKIE['send_mail_success'])) {
                                echo $_COOKIE['send_mail_success'] . "</br>";
                            }
                            ?>
                        </div>

                        <!--Form action-login-->
                        <form action="/loginCustomer" method="post">
                            <div class="main-create-account-fillout">
                                <input type="text" title="Username must have minimum length is 6, no special characters" class="input-account" name="username" autocapitalize="words" placeholder="Username" required>
                                <!-- <p class="efruit-en">Username must have minimum length is 6, no special characters</p>
                                <p class="efruit-vi">Tên đăng nhập có ít nhất 6 kí tự, không chứa kí tự đặc biệt.</p> -->

                                <input type="password" class="input-account" name="password" autocapitalize="words" placeholder="Password" title="Password must have limited one number, one uppercase letter, one lowercase letter and minimum length is 8" required>
                                <!-- <p class="efruit-en">Password must have limited one number, one uppercase letter, one lowercase letter and minimum length is 8 .</p>
                                <p class="efruit-vi">Mật khẩu có ít nhất 1 số, 1 chữ thường, 1 chữ in hoa và tối đa 8 ký tự .</p> -->
                                <div class="error">
                                    <?php
                                    if (isset($_COOKIE['error_username_password'])) {
                                        echo $_COOKIE['error_username_password'] . "</br>";
                                    }
                                    if (isset($_COOKIE['error_acount_does_not_exist'])) {
                                        echo $_COOKIE['error_acount_does_not_exist'] . "</br>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="div-action-button">
                                <div class="input-submit-account">
                                    <input type="submit" value="Sign In" name="login">
                                    <a class="efruit-vi" href="#recover" id="forgotpassword">Quên mật khẩu?</a>
                                    <a class="efruit-en" href="#recover" id="forgotpassword">Forgot your password?</a>
                                </div>
                            </div>
                        </form>

                        <div class="end-form-createaccount">
                            <a class="efruit-vi" href="/vi/dang-ky">Tạo tài khoản</a>
                            <a class="efruit-en" href="/vi/dang-ky">Create Account</a>
                        </div>
                    </div>

                    <br><br>
                    <!--Forgot pasword-->
                    <div class="form-forgot">
                        <div class="header-create-account">
                            <h2 class="efruit-vi">Đặt lại mật khẩu của bạn</h2>
                            <h2 class="efruit-en">Reset Your Password</h2>
                            <p class="efruit-vi">Chúng tôi sẽ gửi cho bạn một email để đặt lại mật khẩu của bạn.</p>
                            <p class="efruit-en">We will send you an email to reset your password.</p>
                        </div>
                        <form action="/forgot-pass" method="post">
                            <div class="main-create-account-fillout">
                                <input type="email" name="email" class="input-account" autocapitalize="words" placeholder="Email">

                            </div>
                            <div class="div-action-button">
                                <div class="input-submit-account">
                                    <input type="submit" value="Submit">
                                    <a class="efruit-vi" href="#recover" id="cancelFormForgot">Hủy</a>
                                    <a class="efruit-en" href="#recover" id="cancelFormForgot">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
</div>