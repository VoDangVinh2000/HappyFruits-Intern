
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address</title>
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
                        <h1>Addresses</h1>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><span>Addresses</span></li>
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
                        <span class="addAdress"><a href="#addAdress" id="a-addAddress">Add a New Address</a></span>
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
                            <div class="form-add-address" id="form-add-address">
                                <h2>Add a New Address</h2>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col">
                                            <div class="firstName-Address">
                                                <h4 class="h6" style="font-weight: 600;">First Name</h4>
                                                <input type="text" autofocus name="firstname-address"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="lastName-Address">
                                                <h4 class="h6" style="font-weight: 600;">Last Name</h4>
                                                <input type="text" autofocus name="lastname-address"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="company-address">
                                                <h4 class="h6" style="font-weight: 600;">Company</h4>
                                                <input class="form-control" type="text" name="companyAddress"
                                                    autocapitalize="words">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="address1">
                                                <h4 class="h6" style="font-weight: 600;">Address 1</h4>
                                                <input class="form-control" type="text" name="address1"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="address2">
                                                <h4 class="h6" style="font-weight: 600;">Address 2</h4>
                                                <input class="form-control" type="text" name="address2"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="city-address">
                                                <h4 class="h6" style="font-weight: 600;">City</h4>
                                                <input type="text" name="cityAddress" autocapitalize="words">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="phone-address">
                                                <h4 class="h6" style="font-weight: 600;">Phone</h4>
                                                <input type="text" name="phoneAddress" autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="add-address-submit">
                                                <input type="submit" value="Add Address" name="submitAddresss">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="cancel-address">
                                            <button type="button" name="cancel-form-add-address">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="address-details">
                                <h2 class="mb-4">Your Address</h2>
                                <!--Show account details-->
                                <h3 class="h5">Họ tên (Đăng Vĩnh)</h3>
                                <p>Company_name(Công ty ....)</p>
                                <p>Address (Bình Mỹ)</p>
                                <p>City (Hồ Chí Minh)</p>
                                <p>... Các thông tin address theo thiết kế database</p>
                                <li>
                                    <a href="#edit" id="a-editAddress">Edit </a>
                                    |
                                    <a href="#delete">Delete</a>
                                </li>
                            </div>
                            <div class="form-edit-address" id="form-edit-address">
                                <h2 class="mb-4">Edit Address</h2>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col">
                                            <div class="firstName-Address">
                                                <h4 class="h6" style="font-weight: 600;">First Name</h4>
                                                <input type="text" autofocus name="firstname-address"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="lastName-Address">
                                                <h4 class="h6" style="font-weight: 600;">Last Name</h4>
                                                <input type="text" autofocus name="lastname-address"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="company-address">
                                                <h4 class="h6" style="font-weight: 600;">Company</h4>
                                                <input class="form-control" type="text" name="companyAddress"
                                                    autocapitalize="words">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="address1">
                                                <h4 class="h6" style="font-weight: 600;">Address 1</h4>
                                                <input class="form-control" type="text" name="address1"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="address2">
                                                <h4 class="h6" style="font-weight: 600;">Address 2</h4>
                                                <input class="form-control" type="text" name="address2"
                                                    autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="city-address">
                                                <h4 class="h6" style="font-weight: 600;">City</h4>
                                                <input type="text" name="cityAddress" autocapitalize="words">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="phone-address">
                                                <h4 class="h6" style="font-weight: 600;">Phone</h4>
                                                <input type="text" name="phoneAddress" autocapitalize="words">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="add-address-submit">
                                                <input type="submit" value="Add Address" name="submitAddresss">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="cancel-address">
                                            <button type="button" name="cancel-form-edit-address">Cancel</button>
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