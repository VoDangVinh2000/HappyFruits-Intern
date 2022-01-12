<?php
//Biến tiles này được nhận tại trang function.php, được truyền qua dòng code $con
//ntroller->_merge_data("tiles")
//Khi các sản phẩm không có ảnh thì sử dụng ảnh này

$settings = get_setting_options();
$content_2 = $settings['about_us_content2'];
$content_2_en = "Being one of  the first professional fruit gift services in HCM, and is a reputable unit providing gift services for enterprises.";
// var_dump($all_block_home_page);
$block_1 = $all_block_home_page[0];
$block_2 = $all_block_home_page[1];
$block_3 = $all_block_home_page[2];
$block_4 = $all_block_home_page[3];

?>

<!-- product category 1-->
<div class="container">
    <div class="product-main-home-page my-3">
        <div class="category-home-page">
            <!-- <div class="product-item"> -->
            <div class="top-img">
                <a href="<?= $block_1['category']['href'] ?>">
                    <img src="<?= $block_1['category']['image'] ?>" alt="">
                </a>
                <div class="category-desc">
                    <span class="efruit-vi">
                        <p><?= $block_1['category']['description'] ?></p>
                    </span>
                    <span class="efruit-en">
                        <p><?= $block_1['category']['description'] ?></p>
                    </span>
                </div>
            </div>
            <div class="category-caption">
                <h3 class="efruit-vi"><span><?= $block_1['category']['text'] ?></span></h3>
                <h3 class="efruit-en"><span><?= $block_1['category']['en_text'] ?></span></h3>
                <a class="btn-shop" href="<?= $block_1['category']['href'] ?>">
                    <div class="button-content-wrapper">
                        <span class="button-text">SHOP NOW</span>
                    </div>
                </a>
            </div>

            <!-- </div> -->
        </div>

        <!-- <div class="col-md-6 "> -->
        <div class="product-itemm">
            <!-- <div class="product-item"> -->
            <div class="row gy-2">
                <?php
                // var_dump($block_1['category']);
                // var_dump($block_1['products']);
                // var_dump($gioTraiCay);
                foreach ($block_1['products'] as $arrayIndex) :
                    $array_block_1 = $arrayIndex[0];
                ?>

                    <div class="col-md-6 col-6">
                        <div style="margin-bottom: 15px;" class="product-cat-<?= $array_block_1['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                            <a href="/vi/detail/<?= $array_block_1['product_id'] ?>" ng-click="showProduct(<?= $array_block_1['product_id'] ?>, $event, 1)" class="y-image">
                                <?php if ($array_block_1['image'] == "") : ?>
                                    <img width="320" height="320" alt="<?= $array_block_1['code'] ?>" src="<?= $array_block_1['image'] ? get_image_url($array_block_1['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                <?php else : ?>
                                    <img alt="<?= $array_block_1['code'] ?>" src="<?= get_image_url($array_block_1['image'], 'square-small') ?>" class="recipe-image" />
                                <?php endif; ?>
                                <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                            </a>
                            <div class="y-info">
                                <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array_block_1['code'] ?> - <span class="product_name efruit-vi"><?= $array_block_1['name'] ?></span><span class="product_name efruit-en"><?= $array_block_1['english_name'] ?></span></a></h3>

                                <?php if (empty($array_block_1['is_box'])) : ?>
                                    <?php if ($array_block_1['price'] > 0) : ?>
                                        <?php if ($array_block_1['promotion_price'] == 0) : ?>
                                            <a class="y-source"><?= number_format($array_block_1['price'] * 1000) ?><sup>đ</sup></a>
                                        <?php else : ?>
                                            <a class="y-source"><span class="old-price"><?= number_format($array_block_1['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array_block_1['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($array_block_1['description']) : ?>
                                    <p class="y-ingredients efruit-vi"><?= $array_block_1['description'] ?></p>
                                    <p class="y-ingredients efruit-en"><?= $array_block_1['description_en'] ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($array_block_1['enabled']) && empty($array_block_1['not_deliver'])) : ?>
                                <div ng-click="showProduct(<?= $array_block_1['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                            <?php elseif (empty($array_block_1['enabled'])) : ?>
                                <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                            <?php endif; ?>
                            <?php $this->load_partial('product-ribbon', array('item' => $array_block_1)); ?>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
            <!-- </div> -->

        </div>
        <!-- </div> -->
    </div>
</div>

<!-- product category 2-->
<div class="container">
    <div class="product-main-home-page my-3">
        <!-- products -->
        <div class="product-itemm">
            <div class="row gy-2">
                <?php
                // $hopTraiCay
                foreach ($block_2['products'] as $arrayIndex) :
                    $array_block_2 = $arrayIndex[0];
                ?>
                    <div class="col-md-6 col-6">
                        <div style="margin-bottom: 15px;" class="product-cat-<?= $array_block_2['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                            <a href="/vi/detail/<?= $array_block_2['product_id'] ?>" ng-click="showProduct(<?= $array_block_2['product_id'] ?>, $event, 1)" class="y-image">
                                <?php if ($array_block_2['image'] == "") : ?>
                                    <img width="320" height="320" alt="<?= $array_block_2['code'] ?>" src="<?= $array_block_2['image'] ? get_image_url($array_block_2['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                <?php else : ?>
                                    <img alt="<?= $array_block_2['code'] ?>" src="<?= get_image_url($array_block_2['image'], 'square-small') ?>" class="recipe-image" />
                                <?php endif; ?>
                                <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                            </a>
                            <div class="y-info">
                                <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array_block_2['code'] ?> - <span class="product_name efruit-vi"><?= $array_block_2['name'] ?></span><span class="product_name efruit-en"><?= $array_block_2['english_name'] ?></span></a></h3>
                                <?php if (empty($array_block_2['is_box'])) : ?>
                                    <?php if ($array_block_2['price'] > 0) : ?>
                                        <?php if ($array_block_2['promotion_price'] == 0) : ?>
                                            <a class="y-source"><?= number_format($array_block_2['price'] * 1000) ?><sup>đ</sup></a>
                                        <?php else : ?>
                                            <a class="y-source"><span class="old-price"><?= number_format($array_block_2['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array_block_2['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($array_block_2['description']) : ?>
                                    <p class="y-ingredients efruit-vi"><?= $array_block_2['description'] ?></p>
                                    <p class="y-ingredients efruit-en"><?= $array_block_2['description_en'] ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($array_block_2['enabled']) && empty($array_block_2['not_deliver'])) : ?>
                                <div ng-click="showProduct(<?= $array_block_2['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                            <?php elseif (empty($array_block_2['enabled'])) : ?>
                                <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                            <?php endif; ?>
                            <?php $this->load_partial('product-ribbon', array('item' => $array_block_2)); ?>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
        <!-- Category -->
        <div class="category-home-page">
            <div class="top-img">
                <a href="<?= $block_2['category']['href'] ?>">
                    <img src="<?= $block_2['category']['image'] ?>" alt="">
                </a>
                <div class="category-desc">
                    <span class="efruit-vi">
                        <p><?= $block_2['category']['description'] ?></p>
                    </span>
                    <span class="efruit-en">
                        <p><?= $block_2['category']['description'] ?></p>
                    </span>
                </div>
            </div>
            <div class="category-caption">
                <h3 class="efruit-vi"><span><?= $block_2['category']['text'] ?></span></h3>
                <h3 class="efruit-en"><span><?= $block_2['category']['en_text'] ?></span></h3>
                <a class="btn-shop" href="<?= $block_2['category']['href'] ?>">
                    <div class="button-content-wrapper">
                        <span class="button-text">SHOP NOW</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- product category 3-->
<div class="container my-3">
    <div class="row g-0 category-full">
        <div class="col-md-6">
            <div class="category-caption">
                <h3 class="efruit-vi"><span><?= $block_3['category']['text'] ?></span></h3>
                <h3 class="efruit-en"><span><?= $block_3['category']['en_text'] ?></span></h3>
                <span class="efruit-vi">
                    <p><?= $block_3['category']['description'] ?></p>
                </span>
                <span class="efruit-en">
                    <p><?= $block_3['category']['description'] ?></p>
                </span>
                <a class="btn-shop" href="<?= $block_3['category']['href'] ?>">
                    <div class="button-content-wrapper">
                        <span class="button-text">SHOP NOW</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="category-home-page">
                <div class="top-img">
                    <a href="<?= $block_3['category']['href'] ?>">
                        <img src="<?= $block_3['category']['image'] ?>" alt="">
                    </a>
                </div>
            </div>

        </div>
    </div>


    <div class="row mt-2 gy-2">
        <?php
        // $hoaTraiCay
        foreach ($block_2['products'] as $arrayIndex) :
            $array_block_4 = $arrayIndex[0];
        ?>
            <div class="col-md-3 col-6">
                <div style="margin-bottom: 15px;" class="product-cat-<?= $array_block_4['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>

                    <a href="/vi/detail/<?= $array_block_4['product_id'] ?>" ng-click="showProduct(<?= $array_block_4['product_id'] ?>, $event, 1)" class="y-image">
                        <?php if ($array_block_4['image'] == "") : ?>
                            <img width="320" height="320" alt="<?= $array_block_4['code'] ?>" src="<?= $array_block_4['image'] ? get_image_url($array_block_4['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                        <?php else : ?>
                            <img alt="<?= $array_block_4['code'] ?>" src="<?= get_image_url($array_block_4['image'], 'square-small') ?>" class="recipe-image" />
                        <?php endif; ?>
                        <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                    </a>
                    <div class="y-info">
                        <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $array_block_4['code'] ?> - <span class="product_name efruit-vi"><?= $array_block_4['name'] ?></span><span class="product_name efruit-en"><?= $array_block_4['english_name'] ?></span></a></h3>
                        <?php if (empty($array_block_4['is_box'])) : ?>
                            <?php if ($array_block_4['price'] > 0) : ?>
                                <?php if ($array_block_4['promotion_price'] == 0) : ?>
                                    <a class="y-source"><?= number_format($array_block_4['price'] * 1000) ?><sup>đ</sup></a>
                                <?php else : ?>
                                    <a class="y-source"><span class="old-price"><?= number_format($array_block_4['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($array_block_4['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($array_block_4['description']) : ?>
                            <p class="y-ingredients efruit-vi"><?= $array_block_4['description'] ?></p>
                            <p class="y-ingredients efruit-en"><?= $array_block_4['description_en'] ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($array_block_4['enabled']) && empty($array_block_4['not_deliver'])) : ?>
                        <div ng-click="showProduct(<?= $array_block_4['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                    <?php elseif (empty($array_block_4['enabled'])) : ?>
                        <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                    <?php endif; ?>
                    <?php $this->load_partial('product-ribbon', array('item' => $array_block_4)); ?>
                </div>
            </div>

        <?php endforeach; ?>
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