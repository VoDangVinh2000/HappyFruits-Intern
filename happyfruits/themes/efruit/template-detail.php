<?php if (empty($id) || empty($product)) {
    echo  "<script>window.location.href='/vi'</script>";
} ?>
<?php
if (isset($product['sell_price'])) {
    $oldPrice =  $product['sell_price'] * 1000;
    //$newPrice =  $product['promotion_price'] * 1000;
} else {
    echo  "<script>window.location.href='/vi'</script>";
}
?>
<?php $this->load_theme_file('page-header.php') ?>
<div class="container mb-5">
    <div class="row">
        <div class="col-md-6">
            <div class="product-gallery">
                <div class="row gy-2">
                    <?php
                    if ($product['image'] == "") {
                    ?>
                        <div class="col-12">
                            <a href="<?php echo $imageDefault ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $imageDefault ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo $imageDefault ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $imageDefault ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo $imageDefault ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $imageDefault ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                    <?php } else { ?>
                        <div class="col-12">
                            <a href="<?php echo $product['image'] ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo $product['image_sub1'] ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $product['image_sub1'] ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo $product['image_sub2'] ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $product['image_sub2'] ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 product-detail">
            <h1 class="product-title mb-3">
                <span class="product-name efruit-vi"><?php echo $product['name'] ?></span> <span class="product-sku"></span>
                <span class="product-name efruit-en"><?php echo $product['english_name'] ?></span>
                <p class="product-sku efruit-vi">Mã - <?php echo $product['code'] ?></p>
                <p class="product-sku efruit-en">Code - <?php echo $product['code'] ?></p>
            </h1>
            <div class="product-price">
                <span class="price"> <span bind-translate="Giá">Giá</span> :</span>
                <?php if (empty($product['is_box'])) : ?>
                    <?php if ($product['sell_price'] > 0) : ?>
                        <?php if ($product['promotion_price'] == 0) : ?>
                            <a href="javascript:void(0);" class="price"><?= number_format($product['sell_price'] * 1000) ?><sup>đ</sup></a>
                        <?php else : ?>
                            <a href="javascript:void(0);">
                                <span class="delete-price"><?= number_format($product['sell_price'] * 1000) ?><sup>đ</sup></span>
                                <span class="price"><?= number_format($product['promotion_price'] * 1000) ?><sup>đ</sup></span>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <form action="#" method="POST">

                <?php if (!empty($product['enabled']) && empty($product['not_deliver'])) : ?>
                    <button class="btn-shop" type="button" ng-click="showProduct(<?= $product['product_id'] ?>, $event)" ng-click="saveSelectedItemToCart()">
                        <div class="button-content-wrapper">
                            <span class="button-text efruit-vi"> THÊM GIỎ HÀNG</span>
                            <span class="button-text efruit-en"> ADD TO CARD</span>
                        </div>
                    </button>
                <?php elseif (empty($product['enabled'])) : ?>
                    <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                <?php endif; ?>
                <!-- <p class="product-price text-bold" style="font-size: 22px;" ng-show="selectedItem.promotion_price == 0 && selectedItem.price > 0"><span bind-translate="Giá">Giá</span>:&nbsp;{{selectedItem.price*1000|efruit_money}}<sup>đ</sup></p> -->
            </form>
            <div class="product-description mt-3 fs-5">
                <p class=" efruit-vi"><?= $product['description'] ?></p>
                <p class=" efruit-en"><?= $product['description_en'] ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <h3 class="section-heading efruit-vi"><span>Sản phẩm liên quan</span></h3>
    <h3 class="section-heading efruit-en"><span>Related products</span></h3>
    <div class="row">
        <?php
        $counter = 0;
        if (!empty($relateProducts)) {
            foreach ($relateProducts as $item) {
                $counter++;
                if ($counter >= 5) {
                    break;
                }
        ?>
                <?php
                if (!empty($item)) {
                ?>
                    <?php
                    if ($item['image'] == "") {
                    ?>
                        <div class="col-md-3 col-6">
                            <div style="margin-bottom: 15px;" class="product-cat-<?= $item['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                                <a href="/vi/detail/<?= $item['product_id'] ?>" ng-click="showProduct(<?= $item['product_id'] ?>, $event, 1)" class="y-image">
                                    <img width="320" height="320" alt="<?= $item['code'] ?>" src="<?= $item['image'] ? get_image_url($item['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                    <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                </a>
                                <div class="y-info">
                                    <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $item['code'] ?> - <span class="product_name efruit-vi"><?= $item['name'] ?></span><span class="product_name efruit-en"><?= $item['english_name'] ?></span></a></h3>
                                    <?php if (empty($item['is_box'])) : ?>
                                        <?php if ($item['price'] > 0) : ?>
                                            <?php if ($item['promotion_price'] == 0) : ?>
                                                <a class="y-source"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></a>
                                            <?php else : ?>
                                                <a class="y-source"><span class="old-price"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($item['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($item['description']) : ?>
                                        <p class="y-ingredients efruit-vi"><?= $item['description'] ?></p>
                                        <p class="y-ingredients efruit-en"><?= $item['description_en'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($item['enabled']) && empty($item['not_deliver'])) : ?>
                                    <div ng-click="showProduct(<?= $item['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                <?php elseif (empty($item['enabled'])) : ?>
                                    <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                <?php endif; ?>
                                <?php $this->load_partial('product-ribbon', array('item' => $item)); ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-3 col-6">
                            <div style="margin-bottom: 15px;" class="product-cat-<?= $item['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                                <a href="/vi/detail/<?= $item['product_id'] ?>" ng-click="showProduct(<?= $item['product_id'] ?>, $event, 1)" class="y-image">
                                    <img width="320" height="320" alt="<?= $item['code'] ?>" src="<?= $item['image'] ? get_image_url($item['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                    <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                </a>
                                <div class="y-info">
                                    <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $item['code'] ?> - <span class="product_name efruit-vi"><?= $item['name'] ?></span><span class="product_name efruit-en"><?= $item['english_name'] ?></span></a></h3>
                                    <?php if (empty($item['is_box'])) : ?>
                                        <?php if ($item['price'] > 0) : ?>
                                            <?php if ($item['promotion_price'] == 0) : ?>
                                                <a class="y-source"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></a>
                                            <?php else : ?>
                                                <a class="y-source"><span class="old-price"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($item['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($item['description']) : ?>
                                        <p class="y-ingredients efruit-vi"><?= $item['description'] ?></p>
                                        <p class="y-ingredients efruit-en"><?= $item['description_en'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($item['enabled']) && empty($item['not_deliver'])) : ?>
                                    <div ng-click="showProduct(<?= $item['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                <?php elseif (empty($item['enabled'])) : ?>
                                    <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                <?php endif; ?>
                                <?php $this->load_partial('product-ribbon', array('item' => $item)); ?>
                            </div>
                        </div>
                    <?php } ?>
        <?php  }
            }
        }
        ?>
    </div>
</div>
<?php $this->load_theme_file('page-footer.php') ?>