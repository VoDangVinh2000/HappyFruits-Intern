<?php 
    //kiểm tra nếu ko có thông tin đăng nhập thì chuyển về trang đăng nhập
    if(isset($_SESSION['user_account'])){} 
    else {
        echo "<script>window.location.href='/vi/dang-nhap'</script>";
    }
?>
<div class="my-account">
    <div class="container">
        <div class="container-my-account">
            <!--********
                Về district của profile ở dưới chỗ select, hãy qua function.inc.php tìm đến hàm html_select_district()
            !-->
            <!-- <div class="row">
                <div class="col-md-6"><h1>My Account</h1></div>
                <div class="col-md-6"><a href="">Logout</a></div>
            </div> -->
            <!-- <h1>
                My Account
                
                <span class="logout-title"><a href="/account/logout">Logout</a></span>
            </h1> -->
            
            <h1 class="efruit-vi">Tài khoản của tôi
                <span class="logout-title"><a href="/logoutCustomer">Đăng xuất</a></span>
                
            </h1>
            <h1 class="efruit-en" >My Account
                <span class="logout-title"><a href="/logoutCustomer">Logout</a></span>
            </h1>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <div class="return-to-account">
                        <!--Show order history-->
                        <p  class="efruit-vi"><a href="#return">Quay lại chi tiết tài khoản.</a></p>
                        <p  class="efruit-en"><a href="#return">Return to Account Details.</a></p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="profile-details">
                        <h2 class="mb-4 efruit-vi">Hồ sơ của bạn</h2>
                        <h2 class="mb-4 efruit-en">Your Profile</h2>
                        <!--Show account details-->
                        <p class="efruit-vi">Họ tên: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['customer_name'];?></p>
                        <p class="efruit-vi">Email: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['email'];?></p>
                        <p class="efruit-vi">Số điện thoại: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['mobile'];?></p>
                        <p class="efruit-vi">Quận (Huyện): <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['district'];?></p>
                        <p class="efruit-vi">Địa chỉ: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['address'];?></p>
                        <p class="efruit-vi">Tòa nhà: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['building'];?></p>
                        <p class="efruit-vi">Tên công ty: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_name'];?></p>
                        <p class="efruit-vi">Mã số thuế: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_tax_code'];?></p>
                        <p class="efruit-vi">Địa chỉ công ty: <?php //if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_address'];?></p>
                        
                        <p class="efruit-en">Full name: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['customer_name'];?></p>
                        <p class="efruit-en">Email: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['email'];?></p>
                        <p class="efruit-en">Phone number: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['mobile'];?></p>
                        <p class="efruit-en">District: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['district'];?></p>
                        <p class="efruit-en">Address: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['address'];?></p>
                        <p class="efruit-en">Building: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['building'];?></p>
                        <p class="efruit-en">Company name: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_name'];?></p>
                        <p class="efruit-en">Tax code: <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_tax_code'];?></p>
                        <p class="efruit-en">Company address: <?php //if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_address'];?></p>
                        <!-- <p>Khoảng cách (km) : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['distance'];?></p> -->
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
                                    <div class="fullname-profile">
                                        <h4 class="h6 efruit-vi" style="font-weight: 400;">Họ tên</h4>
                                        <h4 class="h6 efruit-en" style="font-weight: 400;">Full name</h4>
                                        <input type="text"
                                         pattern="^([a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$" 
                                         name="fullname" autocapitalize="words" value="<?php if(isset($_SESSION['user_account'])) 
                                         echo $_SESSION['user_account'][0]['customer_name'];?>" title="Name cannot contain numbers and special characters" required>          
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="email-profile">
                                        <h4 class="h6" style="font-weight: 400;">Email</h4>
                                        <input type="email" pattern="^[a-zA-Z0-9][a-zA-Z0-9_\.]{3,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$" 
                                        name="email" autocapitalize="words" required
                                        value="<?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['email'];?>">
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
                                        <input type="text" pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b" name="phone-number" 
                                        autocapitalize="words" value="<?php if(isset($_SESSION['user_account'])) 
                                        echo $_SESSION['user_account'][0]['mobile'];?>" title="The phone number consists of only 10 
                                        numbers and cannot contain any characters other than numbers" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="address-profile">
                                        <h4 class="h6 efruit-vi" style="font-weight: 400;">Địa chỉ</h4>
                                        <h4 class="h6 efruit-en" style="font-weight: 400;">Address</h4>
                                        <input type="text" name="address" autocapitalize="words" value="<?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['address'];?>" title="no special characters" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-form-edit">
                                <div class="col">
                                    <div class="district-profile form-group">
                                        <h4 class="h6 efruit-vi" style="font-weight: 400;">Quận (Huyện)</h4>
                                        <h4 class="h6 efruit-en" style="font-weight: 400;">District</h4>
                                        <?php echo(html_select_district($class = 'required', $empty_text = "Chọn", $extra = "", 
                                              $is_multiple_language = false, $selected = $_SESSION['user_account'][0]['district'])) ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="building-profile">
                                        <h4 class="h6 efruit-vi" style="font-weight: 400;">Tòa nhà (nếu có)</h4>
                                        <h4 class="h6 efruit-en" style="font-weight: 400;">Building (if any)</h4>
                                        <input type="text" name="building" autocapitalize="words" value="<?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['building'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-form-edit">
                                <div class="col">
                                    <div class="company-name-profile">
                                        <h4 class="h6 efruit-vi" style="font-weight: 400;">Tên công ty (nếu có)</h4>
                                        <h4 class="h6 efruit-en" style="font-weight: 400;">Copany name (if any)</h4>
                                        <input type="text" name="company-name" autocapitalize="words" value="<?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_name'];?>"> 
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="company-tax-code-profile">
                                        <h4 class="h6 efruit-vi" style="font-weight: 400;">Mã số thuế (nếu có)</h4>
                                        <h4 class="h6 efruit-en" style="font-weight: 400;">Tax code (if any)</h4>
                                        <input type="text" name="company-tax-code" autocapitalize="words" value="<?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_tax_code'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-form-edit">
                                <div class="col">
                                    <div class="company-name-profile">
                                        <h4 class="h6 efruit-vi" style="font-weight: 400;">Địa chỉ công ty (nếu có)</h4>
                                        <h4 class="h6 efruit-en" style="font-weight: 400;">Company address (if any)</h4>
                                        <input type="text" name="company-address" autocapitalize="words" value="<?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_address'];?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- <div class="company-tax-code-profile">
                                        <h4 class="h6" style="font-weight: 400;">Khoảng cách</h4>
                                        <input type="text" name="distance" autocapitalize="words" value="<?php //if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['distance'];?>">
                                    </div> -->
                                </div>
                            </div>
                            <div class="row row-form-edit">
                                
                                <div class="col-md">
                                    <!-- <input type="submit" value="Submit"> -->
                                    <div class="submit-button">
                            <!-- <input type="submit" value="Đăng ký" name="dang-ky" class="btnRegister efruit-vi"> -->
                                        <button name="register" class="efruit-en" type="submit">Submit</button>
                                        <button name="dang-ky" class="efruit-vi" type="submit">Gửi</button>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="cancel-profile">
                                        <button class="efruit-en" type="button" onclick="cancelProfile()"  name="cancel-form-profile-edit">Cancel</button>
                                        <button class="efruit-vi" type="button" onclick="cancelProfile()"  name="cancel-form-profile-edit">Hủy</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                        <!-- <div class="row">
                            <div class="col-md">
                                <div class="cancel-profile">
                                    <button type="button" onclick="cancelProfile()"  name="cancel-form-profile-edit">Cancel</button>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="submit-profile">
                                    <button type="button" name="submit-form-profile-edit">Submit</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>