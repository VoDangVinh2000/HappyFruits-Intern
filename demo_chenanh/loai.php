<?php
include 'functions.php';
spl_autoload_register(function ($class) {
    require 'models/' . $class . '.php';
});
$loaiModel = new loaiModel;
$id = 0;
$anhNoiBatModel = new anhNoiBatModel;
$path = "public/imagesAnhNoiBat/" . $anhNoiBatModel->getTrangThai_1();
if (!isset($_GET['page'])) {
    $pageCurrent = 1;
} else {
    if ($_GET['page'] < 1) {
        $pageCurrent = 1;
    } else {
        $pageCurrent = ceil($_GET['page']);
    }
}
if (isset($_GET['category'])) {
    $id = $_GET['category'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="modal fade bd-example-modal-xl" id="formDetail" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="text-align: center;overflow:hidden;overflow:auto">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-detail" id="modal-body-detail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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
                            <li><a href="?">Zalo : 0353777964</a></li>
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
    <div class="main-show">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar-main">
                        <button type="button" class="btn btn-primary">Chọn giá cả</button>
                        <ul class="menu-giaca">
                            <li><a href="chooseQuery.php?Price=Full">Full giá</a></li>
                            <li><a href="chooseQuery.php?Price=1">0 vnd - 250.000 vnd</a></li>
                            <li><a href="chooseQuery.php?Price=2">250.000 vnd - 500.000 vnd</a></li>
                            <li><a href="chooseQuery.php?Price=3">500.000 vnd - 1 triệu vnd</a></li>
                            <li><a href="chooseQuery.php?Price=4">Trên 1 triệu</a></li>

                        </ul>
                        <button type="button" class="btn btn-primary">Chọn loại giày dép</button>
                        <ul class="menu-loaigiay">
                            <?php foreach ($loaiModel->layTatCaLoai() as $array) { ?>
                                <li><a href="loai.php?category=<?= $array['ID_LoaiGiayDep'] ?>"><?= $array['TenLoai'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">

                    <div class="row">
                        <div class="col-md-7">
                            <div style="text-align:center;" class="paginator">
                                <?php
                                echo $loaiModel->paginatorLoaiIndex($pageCurrent, $id);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="div-search-main">
                                <form action="search.php" method="get" class="form-search-main" style="display:flex">
                                    <input type="text" name="search" id="" class="form-control" placeholder="Tìm kiếm">
                                    <button type="submit" class="btn btn-success form-control">Tìm kiếm</button>
                                </form>
                            </div>

                        </div>

                    </div>
                    <div class="show-product-main">
                        <div class="row">
                            <?php foreach ($loaiModel->paginatorLoai($pageCurrent, $id) as $array) { ?>
                                <div class="col-md-4">
                                    <input type="hidden" name="idGiayDep" value="<?= $array['ID_GiayDep'] ?>">
                                    <div class="products-distance">
                                        <div class="products-distance-2">
                                            <div class="front-details">
                                                <img src="public/images/<?= $array['Anh'] ?>" alt="">
                                            </div>
                                            <div class="back-details">
                                                <button type="button" name="btnDetail" class="btn btn-primary" data-toggle="modal" data-target="#formDetail">
                                                    Chi tiết
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><br>
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-dark text-mute">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <!-- Right -->
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Cửa hàng giày dép Chu Trường
                        </h6>
                        <p>
                            <!-- Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit. -->
                        </p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>
                        <p><i class="fas fa-home me-3"></i></p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            Chutruongd2k5@gmail.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i>0353777964</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:Chu Truong
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>
<script src="public/js/shoe.js"></script>