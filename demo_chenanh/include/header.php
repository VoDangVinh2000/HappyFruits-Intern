<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="Shop giày dép">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
<div class="modal fade" id="formDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controllers/controlGiayDep.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body" id="modal-body-delete">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo-header">
                        <h1>CTNShop</h1>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="header-nav">
                        <ul class="ul-header">
                            <li><a class="active" href="<?= "index.php" ?>">Trang chủ</a></li>
                            <li><a href="">Zalo : 0353777964</a></li>
                            <li><a href="https://www.facebook.com/chuvan.truong">Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- <h3 style="text-align:center">Chào mừng bạn đến với shop giầy dép của chúng tôi!</h3> -->
        <marquee behavior="" direction="">Chào mừng bạn đến với shop giày dép của chúng tôi!</marquee>
        <div class="animation-nb">
            <?php if (isset($path)) { ?>
                <img class="anh-animation" style="width:200px;height:220px;background-size: cover;" src="<?= $path ?>" alt="">
            <?php } ?>
        </div>
    </div>