<div class="my-account">
    <div class="container">
        <div class="container-my-account">
            <h1>
                My Account
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
                        <p>Họ tên (Đăng Vĩnh)</p>
                        <p>Email : ...</p>
                        <p>Số điện thoại : ...</p>
                        <p>Quận : ...</p>
                        <p>Địa chỉ : ...</p>
                        <p>Tòa nhà : ...</p>
                        <p>Tên công ty : ...</p>
                        <p>Mã số thuế : ...</p>
                        <p>Địa chỉ công ty (nếu có) : ...</p>
                        <p>Khoảng cách (km) : ...</p>
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