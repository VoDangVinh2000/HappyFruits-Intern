<?php
//Biến tiles này được nhận tại trang function.php, được truyền qua dòng code $con
//ntroller->_merge_data("tiles")

//Khi các sản phẩm không có ảnh thì sử dụng ảnh này

?>

<!-- product category 1-->
<div class="container">
    <div class="row">
        <?php if (!empty($tiles)) {
            foreach ($tiles as $array) {
                if ($array['cat'] == 14) {
        ?>
                    <div class="col-md-6 product-item">
                        <div class="top-img">
                            <img src="<?= $array['image'] ?>" alt="test">
                            <div class="category-caption">
                                <h3><span><?= $array['text'] ?></span></h3>
                                <a class="btn-shop" href="<?= $array['href'] ?>">
                                    <div class="button-content-wrapper">
                                        <span class="button-text">SHOP NOW</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
        <?php }
            }
        } ?>
        <div class="col-md-6 ">
            <div class="row">
                <?php
                $dem = 0;
                if (!empty($gioTraiCay)) {
                    foreach ($gioTraiCay as $array) {
                        $dem++;
                        if ($dem <= 4) {
                            //If này kiểm tra nếu ảnh của sản phẩm không có hoặc null thì lấy ảnh default
                            //Biến imageDefault được merge từ trang functions.php
                            if ($array['image'] == "") {
                ?>
                                <div class="col-md-6">
                                    <div class="product-item">
                                        <div class="product-photo">
                                            <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                                <img src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>">
                                            </a>
                                            <a class="btn-shop btn-cart" href="">
                                                <div class="button-content-wrapper">
                                                    <span class="button-text">THÊM GIỎ HÀNG</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12 col-lg-8 col-8 product-name">
                                                <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] ?>"><?= $array['name']
                                                                                                                            ?></a>
                                            </div>
                                            <div class="col-md-12 col-lg-4 col-4">
                                                <div class="product-price">
                                                    <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6">
                                    <div class="product-item">
                                        <div class="product-photo">
                                            <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                                <img src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>">
                                            </a>
                                            <a class="btn-shop btn-cart" href="">
                                                <div class="button-content-wrapper">
                                                    <span class="button-text">THÊM GIỎ HÀNG</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12 col-lg-8 col-8 product-name">
                                                <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?> "><?= $array['name']
                                                                                                                            ?></a>
                                            </div>
                                            <div class="col-md-12 col-lg-4 col-4">
                                                <div class="product-price">
                                                    <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php }
                        }
                    }
                } ?>

            </div>
        </div>
    </div>
</div>

<!-- product category 2-->
<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <div class="row">
                <?php
                $dem2 = 0;
                if (!empty($hopTraiCay)) {
                    foreach ($hopTraiCay as $array) {
                        $dem2++;
                        if ($dem2 <= 4) {
                            if ($array['image'] == "") {
                ?>
                                <div class="col-md-6">
                                    <div class="product-item">
                                        <div class="product-photo">
                                            <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                                <img src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                            <a class="btn-shop btn-cart" href="#">
                                                <div class="button-content-wrapper">
                                                    <span class="button-text" bind-translate="Thêm giỏ hàng">Thêm giỏ hàng</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12 col-lg-8 col-8 product-name">
                                                <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                            </div>
                                            <div class="col-md-12 col-lg-4 col-4">
                                                <div class="product-price">
                                                    <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6">
                                    <div class="product-item">
                                        <div class="product-photo">
                                            <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                                <img src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>"></a>
                                            <a class="btn-shop btn-cart" href="#">
                                                <div class="button-content-wrapper">
                                                    <span class="button-text" bind-translate="Thêm giỏ hàng">Thêm giỏ hàng</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12 col-lg-8 col-8 product-name">
                                                <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                            </div>
                                            <div class="col-md-12 col-lg-4 col-4">
                                                <div class="product-price">
                                                    <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php }
                        }
                    }
                } ?>
            </div>
        </div>
        <?php if (!empty($tiles)) {
            foreach ($tiles as $array) {
                if ($array['cat'] == 15) {
        ?>
                    <div class="col-md-6 product-item">
                        <div class="top-img">
                            <img src="<?= $array['image'] ?>" alt="test">
                            <div class="category-caption">
                                <h3><span><?= $array['text'] ?></span></h3>
                                <a class="btn-shop" href="<?= $array['href'] ?>">
                                    <div class="button-content-wrapper">
                                        <span class="button-text">SHOP NOW</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
        <?php }
            }
        } ?>
    </div>
</div>

<!-- product category 3-->
<div class="container mt-5">
    <div class="row g-0 category-full">
        <?php if (!empty($tiles)) {
            $settings = get_setting_options();
            $content_2 = $settings['about_us_content2'];
            foreach ($tiles as $array) {
                if ($array['cat'] == 8) {
        ?>
                    <div class="col-md-6">
                        <div class="category-caption">
                            <h3><span><?= $array['text'] ?></span></h3>
                            <p><?= $content_2 ?></p>
                            <a class="btn-shop" href="<?= $array['href'] ?>">
                                <div class="button-content-wrapper">
                                    <span class="button-text">SHOP NOW</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-img">
                            <img src="<?= $array['image']  ?>" alt="test">
                        </div>
                    </div>
        <?php }
            }
        } ?>
    </div>
    <div class="row">
        <?php
        $dem3 = 0;
        if (!empty($hoaTraiCay)) {
            foreach ($hoaTraiCay as $array) {
                $dem3++;
                if ($dem3 <= 4) {
                    if ($array['image'] == "") {
        ?>
                        <div class="col-md-3 col-sm-3">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id']  . "/" . url_slug($array['name'])?>" class="photo-link">
                                        <img src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 col-lg-8 col-8 product-name">
                                        <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-4">
                                        <div class="product-price">
                                            <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>' ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-3 col-sm-3">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img src="<?= $array['image'] ?>" alt=""></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 col-lg-8 col-8 product-name">
                                        <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-4">
                                        <div class="product-price">
                                            <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>' ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        <?php }
                }
            }
        } ?>
    </div>
</div>


<!-- product category 4 -->
<!-- Top content -->
<div class="container my-5">
    <h3 class="section-heading "><span>Trái cây đặc sản Việt</span></h3>
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            <?php
            //$dem4 = 0;
            if (!empty($traiCayDacSanViet)) {
                foreach ($traiCayDacSanViet as $array) {
                    //$dem4++;
                    if ($array['image'] == "") {
            ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 col-lg-8 col-8 product-name"><a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-4">
                                        <div class="product-price">
                                            <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>'; ?></span>
                                            <!-- <span class="delete-price">2.050.000₫</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id']  . "/" . url_slug($array['name'])?>" class="photo-link">
                                        <img src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 col-lg-8 col-8 product-name">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-4">
                                        <div class="product-price">
                                            <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>'; ?></span>
                                            <!-- <span class="delete-price">2.050.000₫</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            }  ?>
        </div>
    </div>
</div>


<!-- product category 5 -->
<!-- Top content -->

<div class="container my-5">
    <h3 class="section-heading "><span>Trái cây nhập</span></h3>
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            <?php
            //$dem5 = 0;
            if (!empty($traiCayNhap)) {
                foreach ($traiCayNhap as $array) {
                    //$dem5++;
                    if ($array['image'] == "") {
            ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 col-lg-8 col-8 product-name"><a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-4">
                                        <div class="product-price">
                                            <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>'; ?></span>
                                            <!-- <span class="delete-price">2.050.000₫</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id']  . "/" . url_slug($array['name'])?>" class="photo-link">
                                        <img src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 col-lg-8 col-8 product-name"><a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-4">
                                        <div class="product-price">
                                            <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>'; ?></span>
                                            <!-- <span class="delete-price">2.050.000₫</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            }  ?>
        </div>
    </div>
</div>


<!-- product category 6 -->
<!-- Top content -->
<div class="container my-5">
    <h3 class="section-heading "><span>Sản phẩm khác</span></h3>
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            <?php
            //$dem5 = 0;
            if (!empty($sanPhamKhac)) {
                foreach ($sanPhamKhac as $array) {
                    //$dem4++;
                    if ($array['image'] == null) {

            ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 col-lg-8 col-8 product-name"><a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-4">
                                        <div class="product-price">
                                            <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>'; ?></span>
                                            <!-- <span class="delete-price">2.050.000₫</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 col-lg-8 col-8 product-name">
                                    <a href="<?= frontend_url() ?>detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>"><?= $array['name'] ?></a>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-4">
                                        <div class="product-price">
                                            <span class="price"><?= number_format($array['price'] * 1000) . '<sup>đ</sup>'; ?></span>
                                            <!-- <span class="delete-price">2.050.000₫</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>