
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../public/css/stylePageAccount.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <!--Banner -->
        <div class="bread-section">
            <div class="inside-bread-section">
                <div class="container container-section">
                    <div class="title">
                        <h1>Profile</h1>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><span>Profile</span></li>
                        </ul>
                    </div>
                    <div class="section-img">
                        <img src="../public/images/6165.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
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
                                <h2 class="mb-4">Your Information</h2>
                                <!--Show account details-->
                                <h3 class="h5">Họ tên (Đăng Vĩnh)</h3>
                                <p>Số điện thoại : ...</p>
                                <p>Email : ...</p>
                                <p>Quận : ....</p>
                                <p>Địa chỉ : ...</p>
                                <p></p>
                                <p>Tòa nhà (nếu có) : ...</p>
                                <p>Tên công ty (nếu có) : ...</p>
                                <p>Mã số thuế (nếu có) : ...</p>
                                <p>Địa chỉ công ty (nếu có) : ...</p>
                                <p>Khoảng cách (km) : ...</p>
                                <li>
                                    <a href="#edit" id="a-profileEdit">Edit </a>
                                    |
                                    <a href="#delete">Delete</a>
                                </li>
                            </div>
                            <div class="form-profile-edit" id="form-profile-edit">
                                <h2 class="mb-4">Profile Edit</h2>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col">
                                            <div class="fullname-profile">
                                                <h4 class="h6" style="font-weight: 600;">Họ tên</h4>
                                                <input type="text" class="form-control" autofocus name="fullname-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="phone-profile">
                                                <h4 class="h6" style="font-weight: 600;">Số điện thoại</h4>
                                                <input type="text" class="form-control" autofocus name="phone-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="email-profile">
                                                <h4 class="h6" style="font-weight: 600;">Email</h4>
                                                <input class="form-control" type="text" name="email-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="district-profile">
                                                <h4 class="h6" style="font-weight: 600;">Quận</h4>
                                                <input class="form-control" type="text" name="district-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="address-profile">
                                            <h4 class="h6" style="font-weight: 600;">Địa chỉ</h4>
                                                <input class="form-control" type="text" name="address-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="building-profile">
                                                <h4 class="h6" style="font-weight: 600;">Tòa nhà (nếu có)</h4>
                                                <input class="form-control" type="text" name="building-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="company-name-profile">
                                            <h4 class="h6" style="font-weight: 600;">Tên công ty (nếu có)</h4>
                                                <input class="form-control" type="text" name="company-name-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="company-tax-code-profile">
                                                <h4 class="h6" style="font-weight: 600;">Mã số thuế (nếu có)</h4>
                                                <input class="form-control" type="text" name="company-tax-code-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="company-address-profile">
                                            <h4 class="h6" style="font-weight: 600;">Địa chỉ công ty (nếu có)</h4>
                                                <input class="form-control" type="text" name="company-address-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="distance-profile">
                                                <h4 class="h6" style="font-weight: 600;">Khoảng cách (km)</h4>
                                                <input class="form-control" disabled type="text" name="company-tax-code-profile"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-edit">
                                         <input type="submit" class="btn btn-success" value="Save" name="submitEdit">
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="cancel-profile">
                                            <button type="button" name="cancel-form-profile-edit">Cancel</button>
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
</body>
<script src="../public/js/jsPageAccount.js"></script>
</html>