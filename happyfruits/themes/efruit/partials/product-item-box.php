<?php
if (!empty($item)) :?>
    <div style="margin-bottom: 15px;" class="product-cat-<?= $item['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
        <div class="product-item">
            <div class="product-photo">
                <a href="/vi/detail/<?php echo $item['product_id'] . "/" . url_slug($item['name']) ?>" class="photo-link">
                    <img alt="<?= $item['code'] ?>" src="<?= $item['image'] ? get_image_url($item['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>"></a>
                    
                <?php if (!empty($item['enabled']) && empty($item['not_deliver'])) : ?>
                    <a class="btn-shop btn-cart" href="#">
                        <div ng-click="showProduct(<?= $item['product_id'] ?>, $event)" class="button-content-wrapper">
                            <span class="button-text efruit-vi">Chi tiết</span>
                            <span class="button-text efruit-en">Detail</span>
                        </div>
                    </a>
                <?php endif; ?>
                <div ng-click="showProduct(<?php echo $item['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>

            </div>
            <div class="row mt-2">
                <div class="col-8 product-name">
                    <a class=" efruit-vi" href="/vi/detail/<?php echo $item['product_id'] ?>"><?= $item['name'] ?></a>
                    <a class=" efruit-en" href="/vi/detail/<?php echo $item['product_id'] ?>"><?= $item['english_name'] ?></a>
                </div>
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
    </div>
<?php endif; ?>