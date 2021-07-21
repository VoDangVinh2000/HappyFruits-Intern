<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <!--Main Account-->
    <div class="main">
          <!--Banner -->
        <div class="bread-section">
            <div class="inside-bread-section">
                <div class="container container-section">
                    <div class="title">
                        <h1>Create Account</h1>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><span>Create Account</span></li>
                        </ul>
                    </div>
                    <div class="section-img">
                        <img src="../public/images/6165.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="customer-account">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                        <div class="form-account">
                            <div class="header-create-account">
                                <h2>Create Account</h2>
                                <p>Please Register using account detail bellow.</p>
                            </div>
                            <!--Form action register-->
                            <form action="" method="post">
                                <div class="main-create-account-fillout">
                                    <div class="error-fillout-createaccount">
                                    </div>
                                    <input type="text" name="firstname" id="input-full" autocapitalize="words" autofocus
                                        placeholder="First Name" required>
                                    <label for=""></label>
                                    <input type="text" name="lastname" id="input-full" autocapitalize="words"
                                        placeholder="Last Name" required>
                                    <label for=""></label>
                                    <input type="email" name="email" id="input-full" autocapitalize="words"
                                        placeholder="Email" required>
                                    <label for=""></label>
                                    <input type="password" name="password" id="input-full" autocapitalize="words"
                                        placeholder="Password" required>
                                </div>
                                <div class="input-submit-account">
                                    <input type="submit" value="Create">
                                </div>
                            </form>
                            <div class="end-form-createaccount">
                                <a href="#">Return to Store</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="public/js/jsPageAccount.js"></script>

</html>