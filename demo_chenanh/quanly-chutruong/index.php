<?php
session_start();
if (isset($_SESSION['taiKhoan'])) {
    $user = $_SESSION['taiKhoan'];
} else {
    echo "<script>window.location.href='../login.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./public/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="header">
            <div class="row">
                <div class="col-md-9">
                    <div class="menu-info">
                        <p>SHOE SERVICES</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-right-header">
                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <?php echo $_SESSION['taiKhoan'] ?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="./dangxuat.php">Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="main-bottom-header">
            <!-- <div class="container-fluid"> -->
            <div class="row">
                <div class="col-md-3">
                    <div class="side-bar">
                        <i class="fa fa-user-circle-o"></i>
                        <h3>User : <?= $_SESSION['taiKhoan'] ?></h3>
                        <ul>
                            <li><a href="index.php">Tổng quan</a></li>
                            <li><a href="view/giaydep.php">Giày dép</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Trạng thái</a></li>
                            <li><a href="#">Kho</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="main-right">
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <footer>
            <p>Footer</p>
        </footer>
    </div>
</body>

</html>