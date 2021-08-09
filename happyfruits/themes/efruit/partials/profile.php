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
            
            <h1>My Account
                <span class="logout-title"><a href="/logoutCustomer">Logout</a></span>
            </h1>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <div class="return-to-account">
                        <!--Show order history-->
                        <p><a href="#return">Return to Account Details.</a></p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="profile-details">
                        <h2 class="mb-4">Your Profile</h2>
                        <!--Show account details-->
                        <p>Họ tên <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['customer_name'];?></p>
                        <p>Email : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['email'];?></p>
                        <p>Số điện thoại : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['mobile'];?></p>
                        <p>Quận : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['district'];?></p>
                        <p>Địa chỉ : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['address'];?></p>
                        <p>Tòa nhà : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['building'];?></p>
                        <p>Tên công ty : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_name'];?></p>
                        <p>Mã số thuế : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_tax_code'];?></p>
                        <p>Địa chỉ công ty (nếu có) : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['company_address'];?></p>
                        <p>Khoảng cách (km) : <?php if(isset($_SESSION['user_account'])) echo $_SESSION['user_account'][0]['distance'];?></p>
                        <li>
                            <a href="#edit" style="background-color: #72a499;color:white;padding:7px;border-radius: 5px;" id="a-editProfile">Edit </a>
                        </li>
                    </div>
                    <div class="form-edit-profile" id="form-edit-profile">
                        <h2 class="mb-4">Profile Edit</h2>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col">
                                    <div class="fullname-profile">
                                        <h4 class="h6" style="font-weight: 400;">Họ tên</h4>
                                        <input type="text" name="fullname-profie" autocapitalize="words">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="email-profile">
                                        <h4 class="h6" style="font-weight: 400;">Email</h4>
                                        <input type="email" name="email-profile" autocapitalize="words">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="phone-profile">
                                        <h4 class="h6" style="font-weight: 400;">Số điện thoại</h4>
                                        <input type="text" name="phone-address" autocapitalize="words">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="address-profile">
                                        <h4 class="h6" style="font-weight: 400;">Địa chỉ</h4>
                                        <input type="text" name="address-profile" autocapitalize="words">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="district-profile form-group">
                                        <h4 class="h6" style="font-weight: 400;">Quận</h4>
                                        <select class="form-control" style="max-width:50%" >
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="building-profile">
                                        <h4 class="h6" style="font-weight: 400;">Tòa nhà (nếu có)</h4>
                                        <input type="text" name="building-profile" autocapitalize="words">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="company-name-profile">
                                        <h4 class="h6" style="font-weight: 400;">Tên công ty (nếu có)</h4>
                                        <input type="text" name="company-name-profile" autocapitalize="words">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="company-tax-code-profile">
                                        <h4 class="h6" style="font-weight: 400;">Mã số thuế (nếu có)</h4>
                                        <input type="text" name="company-tax-code-profile" autocapitalize="words">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="company-name-profile">
                                        <h4 class="h6" style="font-weight: 400;">Địa chỉ công ty (nếu có)</h4>
                                        <input type="text" name="company-name-profile" autocapitalize="words">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="company-tax-code-profile">
                                        <h4 class="h6" style="font-weight: 400;">Khoảng cách</h4>
                                        <input type="text" name="company-tax-code-profile" autocapitalize="words">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md">
                                <div class="cancel-profile">
                                    <button type="button" onclick="cancelProfile()"  name="cancel-form-profile-edit">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>