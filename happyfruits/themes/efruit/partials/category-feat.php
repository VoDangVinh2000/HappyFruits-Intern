<?php
$settings = get_setting_options();
$content_2 = $settings['about_us_content2'];
if (!mempty($content_2)) :
    $f = $content_2;
    $block_indexes = $f;
    
?>
    <!-- cai nay la ham -->
    <?php if (!empty($tiles)) :
        
        ?>
        <div class="c-home__cat-feat" id="categories">
            <div class="o-wrapper">
                <div class="o-layout o-layout--large">
                    <div class="row">

                        <div class="col-md-6 product-item">
                            <div class="top-img">
                                <img src="<?= get_theme_assets_url() ?>img/giftboxfilledwithwhitepinkflowersripefruitsdarkbackground120225427-1e.jpg" alt="test">
                                <div class="category-caption">
                                    <h3 class="efruit-vi"><span>Hamper - <?= $tiles[0]['short_text'] ?></span></h3>
                                    <h3 class="efruit-en efruitjs"><span>Hamper - <?= $tiles[0]['en_text'] ?></span></h3>
                                    <a class="btn-shop" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text  efruit-vi">Xem menu</span>
                                            <span class="button-text  efruit-en">SHOP NOW</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-6">
                            <div class="product-item">
                                <?php if (!empty($item)) { ?>
                                    <div class="product-photo">
                                        <a href="javascript:void(0);" ng-click="showProduct(<?= $item[$tiles[0]] ?>, $event, 1)" class="photo-link">
                                            <img alt="<?= $item['code'] ?>" src="<?= $item['image'] ? get_image_url($item['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>"></a>
                                        <?php if (!empty($item['enabled']) && empty($item['not_deliver'])) : ?>
                                            <a class="btn-shop btn-cart" href="#">
                                                <div ng-click="showProduct(<?= $item['product_id'] ?>, $event)" class="button-content-wrapper">
                                                    <span class="button-text">THÊM GIỎ HÀNG</span>
                                                </div>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-8 product-name"><a href="javascript:void(0);" ng-click="showProduct(<?= $item['product_id'] ?>, $event, 1)"><?= $item['code'] ?> - <span class="product_name efruit-vi"><?= $item['name'] ?><span class="product_name efruit-en"><?= $item['english_name'] ?></span></a> </div>
                                        <div class="col-4">
                                            <div class="product-price">
                                                <?php if (empty($item['is_box'])) : ?>
                                                    <?php if ($item['price'] > 0) : ?>
                                                        <?php if ($item['promotion_price'] == 0) : ?>
                                                            <a href="javascript:void(0);" class="price"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></a>
                                                        <?php else : ?>
                                                            <a href="javascript:void(0);" class="delete-price"><span class="delete-price"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></span> <span class="price"><?= number_format($item['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        <?php } else {
                                    echo "khong ton tai";
                                }; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php endif; ?>


    <?php if (!empty($tiles)) : ?>
        <div class="c-home__cat-feat" id="categories">
            <div class="o-wrapper">
                <div class="o-layout o-layout--large">
                    <div class="row">

                        <div class="col-md-6 col-6">
                            <div class="product-item">
                                <div class="product-photo">
                                    <a href="#" class="photo-link">
                                        <img src="./public/images/z2042703109463c2033227b2ef306715a1908d02872621.jpg" alt=""></a>
                                    <a class="btn-shop btn-cart" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text">THÊM GIỎ HÀNG</span>
                                        </div>
                                    </a>
                                    <!-- <span class="onsale">
                                    SALE!
                                </span> -->
                                </div>
                                <div class="row mt-2">
                                    <div class="col-8 product-name"><a href="#">Hộp Mix Berry Nho</a> </div>
                                    <div class="col-4">
                                        <div class="product-price">
                                            <span class="price">2.050.000₫</span>
                                            <span class="delete-price">2.050.000₫</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 product-item">
                            <div class="top-img">
                                <img src="<?= get_theme_assets_url() ?>img/fruitbox1.jpeg" alt="test">
                                <div class="category-caption">
                                    <h3 class="efruit-vi"><span>Hamper - <?= $tiles[1]['short_text'] ?></span></h3>
                                    <h3 class="efruit-en efruitjs"><span>Hamper - <?= $tiles[1]['en_text'] ?></span></h3>
                                    <a class="btn-shop" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text  efruit-vi">Xem menu</span>
                                            <span class="button-text  efruit-en">SHOP NOW</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($tiles)) : ?>
        <div class="c-home__cat-feat" id="categories">
            <div class="o-wrapper">
                <div class="o-layout o-layout--large">

                    <div class=" mt-5">
                        <div class="row g-0 category-full">
                            <div class="col-md-6">
                                <div class="category-caption">
                                    <h3 class="efruit-vi"><span>Hamper - <?= $tiles[2]['short_text'] ?></span></h3>
                                    <h3 class="efruit-en efruitjs"><span>Hamper - <?= $tiles[2]['en_text'] ?></span></h3>
                                    <p class="efruit-vi"><?= $block_indexes ?></p>

                                    <a class="btn-shop" href="#">
                                        <div class="button-content-wrapper">
                                            <span class="button-text  efruit-vi">Xem menu</span>
                                            <span class="button-text  efruit-en">SHOP NOW</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="top-img">
                                    <img src="<?= get_theme_assets_url() ?>img/fruitbox2.jpeg" alt="test">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <//?php foreach ($tiles as $tile) :
                        ?>
                    <//?php endforeach; ?> -->

                </div>
            </div>

            <!-- <div class="container mt-5">
                <div class="row g-0 category-full">
                    <div class="col-md-6">
                        <div class="category-caption">
                            <h3 class="efruit-vi"><span>Hamper - <? //= $tile['short_text'] 
                                                                    ?></span></h3>
                            <h3 class="efruit-en efruitjs"><span>Hamper - <? //= $tile['en_text'] 
                                                                            ?></span></h3>
                                <p class="efruit-vi"><//?//= $block_indexes ?></p>
                            
                            <a class="btn-shop" href="#">
                                <div class="button-content-wrapper">
                                    <span class="button-text  efruit-vi">Xem menu</span>
                                    <span class="button-text  efruit-en">SHOP NOW</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-img">
                            <img src="<? //= get_theme_assets_url() 
                                        ?>img/fruitbox2.jpeg" alt="test">
                        </div>
                    </div>
                </div>
            </div> -->




            <!-- <div class="o-layout__item u-lap-wide-one-third u-lap-one-half c-product-feat o-color--milk">
                <a href="<? //= $tile['href'] 
                            ?>" class="c-product-feat__container">
                    <div class="c-product-feat__bg" style="background-image: url(<? //= get_image_url($tile['image'], 'medium') 
                                                                                    ?>)"></div>
                    <div class="c-product-feat__icon hidden-xs">
                        <h3 class="efruit-vi"><? //= $tile['short_text'] 
                                                ?></h3>
                        <h3 class="efruit-en efruitjs"><? //= $tile['en_text'] 
                                                        ?></h3>
                    </div>
                    <div class="c-product-feat__bg-over o-color-bgt-20"></div>
                    <div class="c-product-feat__content">
                        <h3><? //= $tile['en_text'] 
                            ?></h3>
                        <p><? //= $tile['description'] 
                            ?></p>
                        <span class="o-btn efruit-vi">Xem menu</span>
                        <span class="o-btn efruit-en">Learn more</span>
                    </div>
                </a>
            </div> -->
        </div>
    <?php endif; ?>
<?php endif; ?>