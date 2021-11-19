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
    <div class="product-main-home-page my-3">
        <div class="category-home-page">
            <?php if (!empty($tiles)) {
                foreach ($tiles as $array) {
                    if ($array['cat'] == 14) {
            ?>
                        <!-- <div class="product-item"> -->
                        <div class="top-img">
                            <!-- <img src="<? #= $array['image'] 
                                            ?>" alt="test"> -->
                            <a href="<?= $array['href'] ?>">
                                <img src="<?= $array['image'] ?>" alt="">
                            </a>
                            <div class="category-desc">
                                <span class="efruit-vi">
                                    <p><?= $array['description'] ?></p>
                                </span>
                                <span class="efruit-en">
                                    <p><?= $array['description'] ?></p>
                                </span>
                            </div>
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

                        <!-- </div> -->
            <?php }
                }
            } ?>
        </div>

        <!-- <div class="col-md-6 "> -->
        <div class="product-itemm">
            <!-- <div class="product-item"> -->
            <div class="row gy-2">
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
                                <div class="col-md-6 col-6">
                                    <div style="margin-bottom: 15px;" class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                        <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                            <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                            <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                        </a>
                                        <div class="y-info">
                                            <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($array['description']) : ?>
                                                <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                                <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                            <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                        <?php elseif (empty($array['enabled'])) : ?>
                                            <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                        <?php endif; ?>
                                        <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6 col-6">
                                    <div style="margin-bottom: 15px;" class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                                        <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                            <img  alt="<?= $array['code'] ?>" src="<?= get_image_url($array['image'], 'square-small') ?>" class="recipe-image" />
                                            <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                        </a>
                                        <div class="y-info">
                                            <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($array['description']) : ?>
                                                <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                                <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                            <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                        <?php elseif (empty($array['enabled'])) : ?>
                                            <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                        <?php endif; ?>
                                        <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
                                    </div>
                                </div>
                <?php }
                        }
                    }
                } ?>
            </div>
            <!-- </div> -->



        </div>
        <!-- </div> -->
    </div>
</div>

<!-- product category 2-->
<div class="container">
    <div class="product-main-home-page my-3">
        <div class="product-itemm">
            <div class="row gy-2">
                <?php
                $dem2 = 0;
                if (!empty($hopTraiCay)) {
                    foreach ($hopTraiCay as $array) {
                        $dem2++;
                        if ($dem2 <= 4) {
                            if ($array['image'] == "") {
                ?>
                                <div class="col-md-6 col-6">
                                    <div style="margin-bottom: 15px;" class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                        <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                            <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                            <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                        </a>
                                        <div class="y-info">
                                            <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($array['description']) : ?>
                                                <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                                <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                            <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                        <?php elseif (empty($array['enabled'])) : ?>
                                            <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                        <?php endif; ?>
                                        <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class=" product-item col-md-6 col-6">
                                    <div style="margin-bottom: 15px;" class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                        <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                            <img alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                            <img alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                        </a>
                                        <div class="y-info">
                                            <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                            <?php if (empty($array['is_box'])) : ?>
                                                <?php if ($array['price'] > 0) : ?>
                                                    <?php if ($array['promotion_price'] == 0) : ?>
                                                        <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                    <?php else : ?>
                                                        <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($array['description']) : ?>
                                                <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                                <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                            <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                        <?php elseif (empty($array['enabled'])) : ?>
                                            <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                        <?php endif; ?>
                                        <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
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
                    <div class="category-home-page">
                        <div class="top-img">
                            <!-- <img src="<? #= $array['image'] 
                                            ?>" alt="test"> -->
                            <a href="<?= $array['href'] ?>">
                                <img src="<?= $array['image'] ?>" alt="">
                            </a>
                            <div class="category-desc">
                                <span class="efruit-vi">
                                    <p><?= $array['description'] ?></p>
                                </span>
                                <span class="efruit-en">
                                    <p><?= $array['description'] ?></p>
                                </span>
                            </div>
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
        <?php }
            }
        } ?>
    </div>
</div>

<!-- product category 3-->
<div class="container my-3">
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
                    <div class="col-md-6">
                        <div class="category-home-page">
                            <div class="top-img">
                                <a href="<?= $array['href'] ?>">
                                    <img src="<?= $array['image'] ?>" alt="">
                                </a>
                            </div>
                        </div>

                    </div>
        <?php }
            }
        } ?>
    </div>


    <div class="row mt-2">
        <?php
        $dem3 = 0;
        if (!empty($hoaTraiCay)) {
            foreach ($hoaTraiCay as $array) {
                $dem3++;
                if ($dem3 <= 4) {
                    if ($array['image'] == "") {
        ?>
                        <div class="col-md-3 col-6">
                            <div style="margin-bottom: 15px;" class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                    <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                    <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                </a>
                                <div class="y-info">
                                    <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                    <?php if (empty($array['is_box'])) : ?>
                                        <?php if ($array['price'] > 0) : ?>
                                            <?php if ($array['promotion_price'] == 0) : ?>
                                                <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                            <?php else : ?>
                                                <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($array['description']) : ?>
                                        <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                        <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                    <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                <?php elseif (empty($array['enabled'])) : ?>
                                    <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                <?php endif; ?>
                                <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-3 col-6">
                            <div style="margin-bottom: 15px;" class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                    <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                    <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                </a>
                                <div class="y-info">
                                    <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                    <?php if (empty($array['is_box'])) : ?>
                                        <?php if ($array['price'] > 0) : ?>
                                            <?php if ($array['promotion_price'] == 0) : ?>
                                                <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                            <?php else : ?>
                                                <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($array['description']) : ?>
                                        <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                        <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                    <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                <?php elseif (empty($array['enabled'])) : ?>
                                    <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                <?php endif; ?>
                                <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
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
                            <div class="col-md-6 col-6">
                                <div style="margin-bottom: 15px; " class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                    <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                        <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($value[$i]['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" />
                                        <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                    </a>
                                    <div class="y-info">
                                        <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                        <?php if (empty($array['is_box'])) : ?>
                                            <?php if ($array['price'] > 0) : ?>
                                                <?php if ($array['promotion_price'] == 0) : ?>
                                                    <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                <?php else : ?>
                                                    <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($array['description']) : ?>
                                            <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                            <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                        <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                    <?php elseif (empty($array['enabled'])) : ?>
                                        <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                    <?php endif; ?>
                                    <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
                                </div>
                            </div>
                        </div>
        </div>
    <?php } else { ?>
        <div class="ms-2 me-2">
            <!-- <div class=" product-item"> -->
                <div style="margin-bottom: 15px; " class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                    <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                        <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                        <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                    </a>
                    <div class="y-info">
                        <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                        <?php if (empty($array['is_box'])) : ?>
                            <?php if ($array['price'] > 0) : ?>
                                <?php if ($array['promotion_price'] == 0) : ?>
                                    <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                <?php else : ?>
                                    <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($array['description']) : ?>
                            <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                            <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                        <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                    <?php elseif (empty($array['enabled'])) : ?>
                        <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                    <?php endif; ?>
                    <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
                </div>
            <!-- </div> -->
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
                            <div class=" product-item">
                                <div style="margin-bottom: 15px; " class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                    <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                        <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                        <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                    </a>
                                    <div class="y-info">
                                        <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                        <?php if (empty($array['is_box'])) : ?>
                                            <?php if ($array['price'] > 0) : ?>
                                                <?php if ($array['promotion_price'] == 0) : ?>
                                                    <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                <?php else : ?>
                                                    <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($array['description']) : ?>
                                            <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                            <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                        <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                    <?php elseif (empty($array['enabled'])) : ?>
                                        <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                    <?php endif; ?>
                                    <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="ms-2 me-2">
                            <div class=" product-item">
                                <div style="margin-bottom: 15px;" class="product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                    <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                        <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                        <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                    </a>
                                    <div class="y-info">
                                        <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                        <?php if (empty($array['is_box'])) : ?>
                                            <?php if ($array['price'] > 0) : ?>
                                                <?php if ($array['promotion_price'] == 0) : ?>
                                                    <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                <?php else : ?>
                                                    <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($array['description']) : ?>
                                            <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                            <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                        <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                    <?php elseif (empty($array['enabled'])) : ?>
                                        <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                    <?php endif; ?>
                                    <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
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
                            <div class=" product-item">
                                <div style="margin-bottom: 15px;" class=" width product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                    <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                        <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                        <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                    </a>
                                    <div class="y-info">
                                        <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                        <?php if (empty($array['is_box'])) : ?>
                                            <?php if ($array['price'] > 0) : ?>
                                                <?php if ($array['promotion_price'] == 0) : ?>
                                                    <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                <?php else : ?>
                                                    <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($array['description']) : ?>
                                            <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                            <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                        <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                    <?php elseif (empty($array['enabled'])) : ?>
                                        <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                    <?php endif; ?>
                                    <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="ms-2 me-2">
                            <div class=" product-item">
                                <div style="margin-bottom: 15px;" class=" product-cat-<?= $array['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                                    <a href="/vi/detail/<?= $array['product_id'] ?>" ng-click="showProduct(<?= $array['product_id'] ?>, $event, 1)" class="y-image">
                                        <img width="320" height="320" alt="<?= $array['code'] ?>" src="<?= $array['image'] ? get_image_url($array['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                        <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                    </a>
                                    <div class="y-info">
                                        <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array['code'] ?> - <span class="product_name efruit-vi"><?= $array['name'] ?></span><span class="product_name efruit-en"><?= $array['english_name'] ?></span></a></h3>
                                        <?php if (empty($array['is_box'])) : ?>
                                            <?php if ($array['price'] > 0) : ?>
                                                <?php if ($array['promotion_price'] == 0) : ?>
                                                    <a class="y-source"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></a>
                                                <?php else : ?>
                                                    <a class="y-source"><span class="old-price"><?= number_format($array['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($array['description']) : ?>
                                            <p class="y-ingredients efruit-vi"><?= $array['description'] ?></p>
                                            <p class="y-ingredients efruit-en"><?= $array['description_en'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($array['enabled']) && empty($array['not_deliver'])) : ?>
                                        <div ng-click="showProduct(<?= $array['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                    <?php elseif (empty($array['enabled'])) : ?>
                                        <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                    <?php endif; ?>
                                    <?php $this->load_partial('product-ribbon', array('item' => $array)); ?>
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