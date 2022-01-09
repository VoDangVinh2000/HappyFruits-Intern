<div class="customer-account">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="form-account">
                    <div class="header-create-account">
                        <h2 class="efruit-en bold fs-6">Create Account</h2>
                        <h2 class="efruit-vi bold fs-6">Tạo tài khoản</h2>
                        <p h2 class="efruit-en bold fs-6">Please Register using account detail bellow.</p>
                        <p h2 class="efruit-vi bold fs-6">Đăng ký các thông tin bên dưới</p>
                    </div>

                    <!--Form action register ***-->
                    <form action="/register" method="post">
                        <div class="main-create-account-fillout">
                            <div class="username-input">
                                <div class="title-input-register">
                                    <span class="efruit-vi bold fs-6">Tên đăng nhập</span>
                                    <span class="efruit-en bold fs-6">Username</span>
                                </div>
                                <div class="input-register">
                                    <input id="username" pattern="[a-zA-Z0-9]{6,}" title="Username must have minimum length is 6, no special characters" type="text" name="username_en" class="input-account" autocapitalize="words" autofocus required>
                                </div>
                            </div>
                            <p class="efruit-en suggest-message">Username must have limited 6 characters, no special characters.</p>
                            <p class="efruit-vi suggest-message">Tên đăng nhập có ít nhất 6 kí tự, không chứa kí tự đặc biệt.</p>
                            <div class="error">
                                <?php
                                if (isset($_COOKIE['error_username'])) { ?>
                                    <p class="efruit-vi">Đã có username. Vui lòng chọn username khác.</p>
                                    <p class="efruit-en">This username has been already . Please log in account</p>
                                <?php }?>
                            </div>

                            <div class="password-wrapper">
                                <div class="username-input">
                                    <div class="title-input-register">
                                        <span class="efruit-vi bold fs-6">Mật khẩu</span>
                                        <span class="efruit-en bold fs-6">Password</span>
                                    </div>
                                    <div class="input-register">
                                        <input pattern="(?=.*\d)(?=.*[A-Za-z])(?!.*\s).{4,}" title="Password must have limited one number, one alphabetic characters and minimum length is 5" autocomplete="on" id="password" type="password" name="password_en" class="input-account" autocapitalize="words" required>
                                        <i class="fas fa-eye" id="btnShowPass"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="efruit-en">Password must have limited one number, one alphabetic characters and minimum length is 5</p>
                            <p class="efruit-vi">Mật khẩu phải có một số, một kí tự chữ cái và tối thiểu 5 kí tự</p>

                            <div class="username-input">
                                <div class="title-input-register">
                                    <span class="efruit-vi bold fs-6">Số điện thoại</span>
                                    <span class="efruit-en bold fs-6">Phone</span>
                                </div>
                                <div class="input-register">
                                <input id="phone" type="number" name="phone_en" class="input-account" autocapitalize="words" required>
                                </div>
                            </div>
                            <!--aaa!-->
                            <div class="username-input">
                                <div class="title-input-register">
                                    <span class="bold fs-6">Email</span>
                                </div>
                                <div class="input-register">
                                    <input id="email" type="email" name="email" class="input-account" autocapitalize="words" required>
                                </div>
                            </div>
                            <div class="error">
                                <?php
                                if (isset($_COOKIE['error_email'])) { ?>
                                    <p class="efruit-vi">Đã có email. Vui lòng chọn email khác.</p>
                                    <p class="efruit-en">This email has been already . Please log in account</p>
                                <?php }?>
                            </div>
                        </div>

                        <div class="input-submit-account">
                            <input type="submit" value="Create" name="register" class="btnRegister efruit-en">
                            <input type="submit" value="Đăng ký" name="dang-ky" class="btnRegister efruit-vi">
                        </div>
                    </form>

                    <div class="end-form-createaccount">
                        <a class="efruit-en bold fs-6" href="/vi">Return to Store</a>
                        <a class="efruit-vi bold fs-6" href="/vi">Quay lại trang chủ</a>
                        <div class="link-to-login">
                            <span class="efruit-en bold fs-6">Already have an account?</span>
                            <span class="efruit-vi bold fs-6">Bạn đã có tài khoản?</span>
                            <a href="/vi/dang-nhap" class="efruit-en bold fs-6">Sign in</a>
                            <a href="/vi/dang-nhap" class="efruit-vi bold fs-6">Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>