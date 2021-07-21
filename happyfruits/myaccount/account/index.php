<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
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
                        <h1>Account</h1>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><span>Account</span></li>
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
                        <span class="logout"><a href="#">Logout</a></span>
                    </h1>
                    <hr>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="order-history">
                                <h2 class="h4 mb-4">Order History</h2>
                                <!--Show order history-->
                                <p>You haven't placed any orders yet.</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="account-details">
                                <h2 class="h4 mb-4">Account Details</h2>
                                <!--Show account details-->
                                <h3 class="h5">Vĩnh võ</h3>
                                <p>Company_name(Công ty ....)</p>
                                <p>Address (Bình Mỹ)</p>
                                <p>City (Hồ Chí Minh)</p>
                                <p>... Các thông tin address theo thiết kế database</p>
                                <p><a href="address.html">View Address (2)</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>