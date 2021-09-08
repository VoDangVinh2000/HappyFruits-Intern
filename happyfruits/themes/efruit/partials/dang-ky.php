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
                            <input id="username" pattern="[a-zA-Z0-9]{6,}" title="Username must have minimum length is 6, no special characters" type="text" name="username_en" class="input-account" autocapitalize="words" autofocus placeholder="Username" required>
                            <p class="efruit-en suggest-message">Username must have limited 6 characters, no special characters.</p>
                            <p class="efruit-vi suggest-message">Tên đăng nhập có ít nhất 6 kí tự, không chứa kí tự đặc biệt.</p>
                            <div class="error">
                                <?php
                                if (isset($_COOKIE['error_username'])) {
                                    echo $_COOKIE['error_username'] . "</br>";
                                    echo `<p class="efruit-en"></p>
                                <p class="efruit-vi"></p>`;
                                }
                                ?>
                            </div>

                            <div class="password-wrapper">

                                <input pattern="(?=.*\d)(?=.*[A-Za-z])(?!.*\s).{8,}" title="Password must have limited one number, one alphabetic characters and minimum length is 8" autocomplete="on" id="password" type="password" name="password_en" class="input-account" autocapitalize="words" placeholder="Password" required>
                                <i class="fas fa-eye" id="btnShowPass"></i>
                            </div>
                            <p class="efruit-en">Password must have limited one number and at least 5 characters.</p>
                            <p class="efruit-vi">Mật khẩu phải có một số, một kí tự chữ cái và tối thiểu 5 kí tự</p>
                            <input id="phone" type="number" name="phone_en" class="input-account" autocapitalize="words" placeholder="Phone" required>
                                <!--aaa!-->
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
                        <a class="efruit-en" href="/vi">Return to Store</a>
                        <a class="efruit-vi" href="/vi">Quay lại trang chủ</a>
                        <div class="link-to-login">
                            <span class="efruit-en">Already have an account?</span>
                            <span class="efruit-vi">Bạn đã có tài khoản?</span>
                            <a href="/vi/dang-nhap" class="efruit-en">Sign in</a>
                            <a href="/vi/dang-nhap" class="efruit-vi">Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>