<?php
//kiểm tra nếu ko có thông tin đăng nhập thì chuyển về trang đăng nhập
if (isset($_SESSION['user_account'])) {
} else {
    echo "<script>window.location.href='/vi/dang-nhap'</script>";
}
?>
<div class="my-account">
    <div class="container">
        <div class="container-my-account">

            <h1 class="efruit-vi">Tài khoản của tôi
                <span class="logout-title"><a href="/logoutCustomer">Đăng xuất</a></span>

            </h1>
            <h1 class="efruit-en">My Account
                <span class="logout-title"><a href="/logoutCustomer">Logout</a></span>
            </h1>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <div class="return-to-account">
                        <!--Show order history-->
                        
                        <h3>Lịch sử đặt hàng</h3>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th class="scope">Ngày đặt</th>
                                    <th class="scope">Hóa đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($history_order_code)){
                                    foreach ($history_order_code as $array) { 
                                    ?>
                                <td><?= $array['ngayTao'] ?></td>
                                <td> <a href="/vi/don-hang/<?= $array['code'] ?>"><?= $array['code'] ?></a></td>
                                <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="profile-details">
                        <h2 class="mb-4 efruit-vi">Hồ sơ của bạn</h2>
                        <h2 class="mb-4 efruit-en">Your Profile</h2>
                        <!--Show account details-->
                        <p class="efruit-vi">Email: <?php if (isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['email']; ?></p>
                        <p class="efruit-vi">Số điện thoại: <?php if (isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['mobile_account']; ?></p>
                        <p class="efruit-en">Email: <?php if (isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['email']; ?></p>
                        <p class="efruit-en">Phone number: <?php if (isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['mobile']; ?></p>
                        <li>
                            <a class="efruit-en" href="#edit" style="background-color: #72a499;color:white;padding:7px;border-radius: 5px;" id="a-editProfile">Edit </a>
                            <a class="efruit-vi" href="#edit" style="background-color: #72a499;color:white;padding:7px;border-radius: 5px;" id="a-editProfile">Chỉnh sửa </a>
                        </li>
                    </div>
                    <div class="form-edit-profile" id="form-edit-profile">
                        <h2 class="mb-4 efruit-en">Profile Edit</h2>
                        <h2 class="mb-4 efruit-vi">Chỉnh sửa hồ sơ</h2>
                        <form action="/edit-info-account-customer" method="post">
                            <div class="row row-form-edit">
                                <div class="col">
                                    <div class="email-profile">
                                        <h4 class="h6" style="font-weight: 400;">Email</h4>
                                        <input type="email" pattern="^[a-zA-Z0-9][a-zA-Z0-9_\.]{3,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$" name="email" autocapitalize="words" required value="<?php if (isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['email']; ?>">
                                        <div class="error">
                                            <?php
                                            if (isset($_COOKIE['error_email'])) {
                                                echo $_COOKIE['error_email'] . "</br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-form-edit">
                                <div class="col">
                                    <div class="phone-profile">
                                        <h4 class="h6 efruit-vi" style="font-weight: 400;">Số điện thoại</h4>
                                        <h4 class="h6 efruit-en" style="font-weight: 400;">Phone number</h4>
                                        <input type="text" pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b" name="phone-number" autocapitalize="words" value="<?php if (isset($_SESSION['user_account']))
                                                                                                                                                            echo $_SESSION['user_account'][0]['mobile_account']; ?>" title="The phone number consists of only 10 
                                        numbers and cannot contain any characters other than numbers" required>
                                    </div>
                                </div>
                            </div>
            
                            <div class="row row-form-edit">

                                <div class="col-md">
                                    <div class="submit-button">
                                        <button name="register" class="efruit-en" type="submit">Submit</button>
                                        <button name="dang-ky" class="efruit-vi" type="submit">Gửi</button>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="cancel-profile">
                                        <button class="efruit-en" type="button" onclick="cancelProfile()" name="cancel-form-profile-edit">Cancel</button>
                                        <button class="efruit-vi" type="button" onclick="cancelProfile()" name="cancel-form-profile-edit">Hủy</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>