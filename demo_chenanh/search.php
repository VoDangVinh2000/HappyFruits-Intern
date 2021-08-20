<?php
include 'functions.php';

spl_autoload_register(function ($class) {
    require 'models/' . $class . '.php';
});
$loaiModel = new loaiModel;
$anhNoiBatModel = new anhNoiBatModel;
$paginatorModel = new paginatorModel;
$path = "public/imagesAnhNoiBat/" . $anhNoiBatModel->getTrangThai_1();
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
if (!isset($_GET['page'])) {
    $pageCurrent = 1;
} else {
    if ($_GET['page'] < 1) {
        $pageCurrent = 1;
    } else {
        $pageCurrent = ceil($_GET['page']);
    }
}
if(!isset($_GET['search']) || $_GET['search'] == ""){
    echo "<script>window.location.href='index.php'</script>";
}
?>


<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>
<div class="col-md-9">
    <div class="main-header">
        <div class="row">
            <div class="col-md-7">
                <div style="text-align:center" class="paginator">
                    <?php if (isset($search)) { ?>
                        <?php
                        echo $paginatorModel->paginatorIndexCustomer_Search($pageCurrent,$search);
                        ?>
                    <?php } ?>
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
    </div>
    <div class="show-product-main">
        <div class="row">
            <?php foreach ($paginatorModel->paginatorSearch_Customer($pageCurrent,$search) as $array) { ?>
                <div class="col-md-4">
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
<?php include 'include/footer.php' ?>