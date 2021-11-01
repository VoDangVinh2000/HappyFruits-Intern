<?php
//Biến tiles này được nhận tại trang function.php, được truyền qua dòng code $con
//ntroller->_merge_data("tiles")
//Khi các sản phẩm không có ảnh thì sử dụng ảnh này

$settings = get_setting_options();
$content_2 = $settings['about_us_content2'];
$content_2_en = "Being one of  the first professional fruit gift services in HCM, and is a reputable unit providing gift services for enterprises.";
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
                            <div class="category-desc">
                                <span class="efruit-vi">
                                    <p><?= $array['description'] ?></p>
                                </span>
                                <span class="efruit-en">
                                    <p><?= $array['description'] ?></p>
                                </span>
                            </div>
                            <div class="category-caption">
                                <h3 class="efruit-vi"><span><?= $array['text'] ?></span></h3>
                                <h3 class="efruit-en"><span><?= $array['en_text'] ?></span></h3>
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
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="product-item">
                                        <div class="product-photo">
                                            <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                                <img width="320" height="320" src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>">
                                            </a>

                                            <a class="btn-shop btn-cart" href="">
                                                <div class="button-content-wrapper">
                                                    <span class="button-text efruit-vi">Chi tiết</span>
                                                    <span class="button-text efruit-en">Detail</span>
                                                </div>
                                            </a>
                                            <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span style="opacity: 1;" class="yum"></span></div>
                                        </div>
                                        <div class="product-info" style="margin-top: 12px;">
                                            <!-- <div class="row mt-2"> -->
                                            <div class="col-7 product-name">
                                                <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                                <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                            </div>
                                            <div class="col-5">
                                                <div class="product-price">
                                                    <?php if (empty($array['is_box'])) : ?>
                                                        <?php if ($array['price'] > 0) : ?>
                                                            <?php if ($array['promotion_price'] == 0) : ?>
                                                                <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                            <?php else : ?>
                                                                <a href="javascript:void(0);">
                                                                    <span class="delete-price"> <?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                                    <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                        <?php if (!empty($array['ribbon_left'])) : ?>
                                            <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($array['ribbon_right'])) : ?>
                                            <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="product-item">
                                        <div class="product-photo">
                                            <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                                <img width="320" height="320" src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>">
                                            </a>
                                            <a class="btn-shop btn-cart" href="">
                                                <div class="button-content-wrapper">
                                                    <span class="button-text efruit-vi">Chi tiết</span>
                                                    <span class="button-text efruit-en">Detail</span>
                                                </div>
                                            </a>
                                            <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                                <span style="opacity: 1;" class="yum"></span>
                                            </div>

                                        </div>
                                        <div class="product-info" style="margin-top: 12px;">
                                            <!-- <div class="row mt-2"> -->
                                            <div class="col-7 product-name">
                                                <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                                <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                            </div>
                                            <div class="col-5">
                                                <div class="product-price">
                                                    <?php if (empty($array['is_box'])) : ?>
                                                        <?php if ($array['price'] > 0) : ?>
                                                            <?php if ($array['promotion_price'] == 0) : ?>
                                                                <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                            <?php else : ?>
                                                                <a href="javascript:void(0);">
                                                                    <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                                    <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                        <?php if (!empty($array['ribbon_left'])) : ?>
                                            <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($array['ribbon_right'])) : ?>
                                            <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                        <?php endif; ?>
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
        <div class="col-md-6">
            <div class="row">
                <?php
                $dem2 = 0;
                if (!empty($hopTraiCay)) {
                    foreach ($hopTraiCay as $array) {
                        $dem2++;
                        if ($dem2 <= 4) {
                            if ($array['image'] == "") {
                ?>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="product-item">
                                        <div class="product-photo">
                                            <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                                <img width="320" height="320"  src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                            <a class="btn-shop btn-cart" href="#">
                                                <div class="button-content-wrapper">
                                                    <span class="button-text efruit-vi">Chi tiết</span>
                                                    <span class="button-text efruit-en">Detail</span>
                                                </div>
                                            </a>
                                            <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                                <span style="opacity: 1;" class="yum"></span>
                                            </div>
                                        </div>
                                        <div class="product-info" style="margin-top: 12px;">
                                            <!-- <div class="row mt-2"> -->
                                            <div class="col-7 product-name">
                                                <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                                <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                            </div>
                                            <div class="col-5">
                                                <div class="product-price">
                                                    <?php if (empty($array['is_box'])) : ?>
                                                        <?php if ($array['price'] > 0) : ?>
                                                            <?php if ($array['promotion_price'] == 0) : ?>
                                                                <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                            <?php else : ?>
                                                                <a href="javascript:void(0);">
                                                                    <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                                    <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                        <?php if (!empty($array['ribbon_left'])) : ?>
                                            <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($array['ribbon_right'])) : ?>
                                            <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="product-item">
                                        <div class="product-photo">
                                            <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                                <img width="320" height="320" src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>"></a>
                                            <a class="btn-shop btn-cart" href="#">
                                                <div class="button-content-wrapper">
                                                    <span class="button-text efruit-vi">Chi tiết</span>
                                                    <span class="button-text efruit-en">Detail</span>
                                                </div>
                                            </a>
                                            <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                                <span style="opacity: 1;" class="yum"></span>
                                            </div>
                                        </div>
                                        <div class="product-info" style="margin-top: 12px;">
                                            <!-- <div class="row mt-2"> -->
                                            <div class="col-7 product-name">
                                                <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                                <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                            </div>
                                            <div class="col-5">
                                                <div class="product-price">
                                                    <?php if (empty($array['is_box'])) : ?>
                                                        <?php if ($array['price'] > 0) : ?>
                                                            <?php if ($array['promotion_price'] == 0) : ?>
                                                                <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                            <?php else : ?>
                                                                <a href="javascript:void(0);">
                                                                    <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                                    <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                        <?php if (!empty($array['ribbon_left'])) : ?>
                                            <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($array['ribbon_right'])) : ?>
                                            <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                        <?php endif; ?>
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
                            <img width="320" height="320" src="<?= $array['image'] ?>" alt="test">
                            <div class="category-desc">
                                <span class="efruit-vi">
                                    <p><?= $array['description'] ?></p>
                                </span>
                                <span class="efruit-en">
                                    <p><?= $array['description'] ?></p>
                                </span>
                            </div>
                            <div class="category-caption">
                                <h3 class="efruit-vi"><span><?= $array['text'] ?></span></h3>
                                <h3 class="efruit-en"><span><?= $array['en_text'] ?></span></h3>
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
            foreach ($tiles as $array) {
                if ($array['cat'] == 8) {
        ?>
                    <div class="col-md-6">
                        <div class="category-caption">
                            <h3 class="efruit-vi"><span><?= $array['text'] ?></span></h3>
                            <h3 class="efruit-en"><span><?= $array['en_text'] ?></span></h3>
                            <span class="efruit-vi">
                                <p><?= $array['description'] ?></p>
                            </span>
                            <span class="efruit-en">
                                <p><?= $array['description'] ?></p>
                            </span>
                            <a class="btn-shop" href="<?= $array['href'] ?>">
                                <div class="button-content-wrapper">
                                    <span class="button-text">SHOP NOW</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 product-item item-center">
                        <div class="top-img"><img src="<?= $array['image']  ?>" alt="test">
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
                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="/vi/detail/<?php echo $array['product_id']  . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img  width="320" height="320" src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text efruit-vi">Chi tiết</span>
                                            <span class="button-text efruit-en">Detail</span>
                                        </div>
                                    </a>
                                    <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                        <span style="opacity: 1;" class="yum"></span>
                                    </div>
                                </div>
                                <div class="product-info" style="margin-top: 12px;">
                                    <!-- <div class="row mt-2"> -->
                                    <div class="col-7 product-name">
                                        <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                        <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                    </div>
                                    <div class="col-5">
                                        <div class="product-price">
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);">
                                                            <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                            <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <?php if (!empty($array['ribbon_left'])) : ?>
                                    <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($array['ribbon_right'])) : ?>
                                    <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img  width="320" height="320" src="<?= $array['image'] ?>" alt=""></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text efruit-vi">Chi tiết</span>
                                            <span class="button-text efruit-en">Detail</span>
                                        </div>
                                    </a>
                                    <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                        <span style="opacity: 1;" class="yum"></span>
                                    </div>
                                </div>
                                <div class="product-info" style="margin-top: 12px;">
                                    <!-- <div class="row mt-2"> -->
                                    <div class="col-7 product-name">
                                        <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                        <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                    </div>
                                    <div class="col-5">
                                        <div class="product-price">
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);">
                                                            <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                            <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <?php if (!empty($array['ribbon_left'])) : ?>
                                    <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($array['ribbon_right'])) : ?>
                                    <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                <?php endif; ?>
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
    <?php if (!empty($tiles)) {
        foreach ($tiles as $array) {
            if ($array['cat'] == 6) {
    ?>
                <h3 class="section-heading efruit-vi"><span><?= $array['text'] ?><span></h3>
                <h3 class="section-heading efruit-en"><span><?= $array['en_text'] ?><span></h3>
    <?php }
        }
    } ?>
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
                                    <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img width="320" height="320" class="owl-lazy" data-src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text efruit-vi">Chi tiết</span>
                                            <span class="button-text efruit-en">Detail</span>
                                        </div>
                                    </a>
                                    <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                        <span style="opacity: 1;" class="yum"></span>
                                    </div>
                                </div>
                                <div class="product-info" style="margin-top: 12px;">
                                    <!-- <div class="row mt-2"> -->
                                    <div class="col-7 product-name">
                                        <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                        <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                    </div>
                                    <div class="col-5">
                                        <div class="product-price">
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);">
                                                            <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                            <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <?php if (!empty($array['ribbon_left'])) : ?>
                                    <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($array['ribbon_right'])) : ?>
                                    <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
        </div>
    <?php } else { ?>
        <div class="ms-2 me-2">
            <div class="product-item">
                <div class="product-photo">
                    <a href="/vi/detail/<?php echo $array['product_id']  . "/" . url_slug($array['name']) ?>" class="photo-link">
                        <img  width="320" height="320" class="owl-lazy" data-src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>"></a>
                    <a class="btn-shop btn-cart" href="#">
                        <div class="button-content-wrapper">
                            <span class="button-text efruit-vi">Chi tiết</span>
                            <span class="button-text efruit-en">Detail</span>
                        </div>
                    </a>
                    <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                        <span style="opacity: 1;" class="yum"></span>
                    </div>
                </div>
                <div class="product-info" style="margin-top: 12px;">
                    <!-- <div class="row mt-2"> -->
                    <div class="col-7 product-name">
                        <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                        <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                    </div>
                    <div class="col-5">
                        <div class="product-price">
                            <?php if (empty($array['is_box'])) : ?>
                                <?php if ($array['price'] > 0) : ?>
                                    <?php if ($array['promotion_price'] == 0) : ?>
                                        <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                    <?php else : ?>
                                        <a href="javascript:void(0);">
                                            <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                            <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <?php if (!empty($array['ribbon_left'])) : ?>
                    <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                <?php endif; ?>
                <?php if (!empty($array['ribbon_right'])) : ?>
                    <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                <?php endif; ?>
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
    <?php if (!empty($tiles)) {
        foreach ($tiles as $array) {
            if ($array['cat'] == 12) {
    ?>
                <h3 class="section-heading efruit-vi"><span><?= $array['text'] ?><span></h3>
                <h3 class="section-heading efruit-en"><span><?= $array['en_text'] ?><span></h3>
    <?php }
        }
    } ?>
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            <?php
            if (!empty($traiCayNhap)) {
                foreach ($traiCayNhap as $array) {
                    if ($array['image'] == "") {
            ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img  width="320" height="320" class="owl-lazy" data-src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text efruit-vi">Chi tiết</span>
                                            <span class="button-text efruit-en">Detail</span>
                                        </div>
                                    </a>
                                    <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                        <span style="opacity: 1;" class="yum"></span>
                                    </div>
                                </div>
                                <div class="product-info" style="margin-top: 12px;">
                                    <!-- <div class="row mt-2"> -->
                                    <div class="col-7 product-name">
                                        <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                        <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                    </div>
                                    <div class="col-5">
                                        <div class="product-price">
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);">
                                                            <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                            <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <?php if (!empty($array['ribbon_left'])) : ?>
                                    <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($array['ribbon_right'])) : ?>
                                    <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="/vi/detail/<?php echo $array['product_id']  . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img  width="320" height="320" class="owl-lazy" data-src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text efruit-vi">Chi tiết</span>
                                            <span class="button-text efruit-en">Detail</span>
                                        </div>
                                    </a>
                                    <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                        <span style="opacity: 1;" class="yum"></span>
                                    </div>
                                </div>
                                <div class="product-info" style="margin-top: 12px;">
                                    <!-- <div class="row mt-2"> -->
                                    <div class="col-7 product-name">
                                        <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                        <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                    </div>
                                    <div class="col-5">
                                        <div class="product-price">
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);">
                                                            <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                            <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <?php if (!empty($array['ribbon_left'])) : ?>
                                    <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($array['ribbon_right'])) : ?>
                                    <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                <?php endif; ?>
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
    <?php if (!empty($tiles)) {
        foreach ($tiles as $array) {
            if ($array['cat'] == 7) {
    ?>
                <h3 class="section-heading efruit-vi"><span><?= $array['text'] ?><span></h3>
                <h3 class="section-heading efruit-en"><span><?= $array['en_text'] ?><span></h3>
    <?php }
        }
    } ?>
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            <?php
            if (!empty($sanPhamKhac)) {
                foreach ($sanPhamKhac as $array) {
                    if ($array['image'] == null) {
            ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img  width="320" height="320" class="owl-lazy" data-src="<?php echo $imageDefault ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text efruit-vi">Chi tiết</span>
                                            <span class="button-text efruit-en">Detail</span>
                                        </div>
                                    </a>
                                    <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                        <span style="opacity: 1;" class="yum"></span>
                                    </div>
                                </div>
                                <div class="product-info" style="margin-top: 12px;">
                                    <!-- <div class="row mt-2"> -->
                                    <div class="col-9 product-name">
                                        <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                        <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                    </div>
                                    <div class="col-3">
                                        <div class="product-price">
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);">
                                                            <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                            <span class="price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <?php if (!empty($array['ribbon_left'])) : ?>
                                    <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($array['ribbon_right'])) : ?>
                                    <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="ms-2 me-2">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name']) ?>" class="photo-link">
                                        <img  width="320" height="320" class="owl-lazy" data-src="<?php echo $array['image'] ?>" alt="<?php echo $array['code'] ?>"></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text efruit-vi">Chi tiết</span>
                                            <span class="button-text efruit-en">Detail</span>
                                        </div>
                                    </a>
                                    <div ng-click="showProduct(<?php echo $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart">
                                        <span style="opacity: 1;" class="yum"></span>
                                    </div>
                                </div>
                                <div class="product-info" style="margin-top: 12px;">
                                    <!-- <div class="row mt-2"> -->
                                    <div class="col-9 product-name">
                                        <a class=" efruit-vi" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['name'] ?></a>
                                        <a class=" efruit-en" href="/vi/detail/<?php echo $array['product_id'] . "/" . url_slug($array['name'])  ?>"><?= $array['english_name'] ?></a>
                                    </div>
                                    <div class="col-3">
                                        <div class="product-price">
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a href="javascript:void(0);" class="price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);">
                                                            <span class="delete-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span>
                                                            <span class="price"><?= number_format($item['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <?php if (!empty($array['ribbon_left'])) : ?>
                                    <div class="half-circle-ribbon ribbon-left" <?= $array['ribbon_left_color'] ? 'style="background: ' . $array['ribbon_left_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_left_color'] . ';"' : '' ?>><?= $array['ribbon_left'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($array['ribbon_right'])) : ?>
                                    <div class="half-circle-ribbon" <?= $array['ribbon_right_color'] ? 'style="background: ' . $array['ribbon_right_color'] . ';box-shadow: 0 0 0 3px ' . $array['ribbon_right_color'] . ';"' : '' ?>><?= $array['ribbon_right'] ?></div>
                                <?php endif; ?>

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