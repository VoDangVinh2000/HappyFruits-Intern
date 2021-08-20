<?php 
    session_start();    
    if(isset($_SESSION['taiKhoan'])){
        $user = $_SESSION['taiKhoan'];
    }
    else{
        header('location:../../login.php');
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
    <link rel="stylesheet" href="../public/css/style.css">
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
                                <a class="dropdown-item" href="../dangxuat.php">Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-9"> 
                    <div class="">
                        <p>404 not found</p>
                    </div>
                </div> -->
            </div>
        </div><br>