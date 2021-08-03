<div class="customer-account">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="form-account">
                    <div class="header-create-account">
                        <h2 class="efruit-en">Create Account</h2>
                        <h2 class="efruit-vi">Tạo tài khoản</h2>
                        <p h2 class="efruit-en">Please Register using account detail bellow.</p>
                        <p h2 class="efruit-vi">Đăng ký các thông tin bên dưới</p>
                    </div>

                    <!--Form action register-->
                    <form action="/register" method="post">
                        <div class="main-create-account-fillout">
                            <div class="error-fillout-createaccount">
                            </div>
                            <input id="username" pattern="[a-zA-Z0-9]{6,}" title="Username must have minimum length is 6" type="text" name="username_en" class="input-account " autocapitalize="words" autofocus placeholder="Username" required>
                            <div class="error">
                                <?php
                                if (isset($_COOKIE['error_username'])) {
                                    echo $_COOKIE['error_username'] . "</br>";
                                }
                                ?>
                            </div>

                            <div class="password-wrapper">
                                <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}" title="Password must have limited one number, one uppercase letter, one lowercase letter and minimum length is 8" id="password" type="password" name="password_en" class="input-account" autocapitalize="words" placeholder="Password" required>
                                <i class="fas fa-eye" id="btnShowPass"></i>
                            </div>

                            <input id="phone" type="number" name="phone_en" class="input-account" autocapitalize="words" placeholder="Phone number" required>

                            <input id="email" type="email" name="email" class="input-account" autocapitalize="words" placeholder="Email" required>
                            <div class="error">
                                <?php
                                if (isset($_COOKIE['error_email'])) {
                                    echo $_COOKIE['error_email'] . "</br>";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="input-submit-account">
                            <input type="submit" value="Create" name="register" class="btnRegister efruit-en">
                            <input type="submit" value="Đăng ký" name="dang-ky" class="btnRegister efruit-vi">
                        </div>
                    </form>

                    <div class="end-form-createaccount">
                        <a class="efruit-en" href="<?= frontend_url() ?>">Return to Store</a>
                        <a class="efruit-vi" href="<?= frontend_url() ?>">Quay lại trang chủ</a>
                        <div class="link-to-login">
                            <span class="efruit-en">Already have an account?</span>
                            <span class="efruit-vi">Bạn đã có tài khoản?</span>
                            <a href="<?= frontend_url() ?>/dang-nhap" class="efruit-en">Sign in</a>
                            <a href="<?= frontend_url() ?>/dang-nhap" class="efruit-vi">Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>