<?php
if (!empty($item)) : ?>
    <div style="margin-bottom: 15px;" class="product-cat-<?= $item['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
        <a href="/vi/detail/<?= $item['product_id'] ?>" ng-click="showProduct(<?= $item['product_id'] ?>, $event, 1)" class="y-image">
            <img width="320" height="320" alt="<?= $item['code'] ?>" src="<?= $item['image'] ? get_image_url($item['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
            <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
        </a>
        <div class="y-info">
            <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;" href="javascript:void(0);" ng-click="showProduct(<?= $item['product_id'] ?>, $event, 1)"><?= $item['code'] ?> - <span class="product_name efruit-vi"><?= $item['name'] ?></span><span class="product_name efruit-en"><?= $item['english_name'] ?></span></a></h3>
            <?php if (empty($item['is_box'])) : ?>
                <?php if ($item['price'] > 0) : ?>
                    <?php if ($item['promotion_price'] == 0) : ?>
                        <a href="javascript:void(0);" class="y-source"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></a>
                    <?php else : ?>
                        <a href="javascript:void(0);" class="y-source"><span class="old-price"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($item['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
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
<?php endif; ?>