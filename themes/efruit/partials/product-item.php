<?php if(!empty($item)):?>
<div class="product-cat-<?=$item['category_id']?> y-grid-card animate has-image compact" ng-show="layout==0" on-ready>
    <a href="javascript:void(0);" ng-click="showProduct(<?=$item['product_id']?>, $event, 1)" class="y-image">
        <img width="320" height="320" alt="<?=$item['code']?>" src="<?=$item['image']?get_image_url($item['image'], 'x-small'):get_child_theme_assets_url().'img/default-product-image.png'?>" class="recipe-image" />
        <img width="320" height="320" alt="gradient-background" src="<?=get_theme_assets_url()?>img/card-gradient.png" class="gradient" />
    </a>
    <div class="y-info">
        <h3 class="y-title" style="font-size: 15px;"><a style="text-overflow: inherit;white-space: unset;" href="javascript:void(0);" ng-click="showProduct(<?=$item['product_id']?>, $event, 1)"><?=$item['code']?> - <span class="product_name efruit-vi"><?=$item['name']?></span><span class="product_name efruit-en"><?=$item['english_name']?></span></a></h3>
        <?php if($item['price'] > 0):?>
            <?php if($item['promotion_price'] == 0):?>
                <a href="javascript:void(0);" class="y-source"><?=number_format($item['price']*1000)?><sup>đ</sup></a>
            <?php else:?>
                <a href="javascript:void(0);" class="y-source"><span class="old-price"><?=number_format($item['price']*1000)?><sup>đ</sup></span>  <span class="new-price"><?=number_format($item['promotion_price']*1000)?><sup>đ</sup></span></a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($item['description']):?>
            <p class="y-ingredients efruit-vi"><?=$item['description']?></p>
            <p class="y-ingredients efruit-en"><?=$item['description_en']?></p>
        <?php endif; ?>
    </div>
    <?php if (!empty($item['enabled']) && empty($item['not_deliver'])):?>
        <div ng-click="showProduct(<?=$item['product_id']?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
    <?php elseif(empty($item['enabled'])):?>
        <div><img loading="lazy" alt="sold-out" src="<?=get_theme_assets_url()?>img/sold_out.png" class="sold_out efruit-vi"/><img loading="lazy" alt="sold-out" class="sold_out efruit-en" src="<?=get_theme_assets_url()?>img/sold_out_en.png" /></div>
    <?php endif; ?>
    <?php $this->load_partial('product-ribbon', array('item' => $item)); ?>
</div>
<table ng-show="layout==1" class="product-cat-<?=$item['category_id']?> product-container <?=$item['enabled']?'':'disabled'?>">
    <tr>
        <td class="td-image" align="center" valign="top">
            <a class="product-image <?=$item['image']?'fancybox':''?>" rel="product-images" href="<?php echo $item['image']?valid_url($item['image']):'javascript:void(0);'?>">
                <?php if($item['image']):?>
                    <img loading="lazy" height="80" src="<?=get_image_url($item['image'], 'square-small')?>" />
                <?php else:?>
                    <img loading="lazy" height="80" src="<?=get_theme_assets_url()?>img/small-logo.png">
                <?php endif; ?>
            </a>
        </td>
        <td class="td-name" align="left" valign="middle">
            <?php if (!empty($item['free_choice'])):?>
            <a class="product-info" href="javascript:void(0);" ng-click="showProduct(<?=$item['product_id']?>, $event)" >
            <?php else:?>
            <a class="product-info <?=strlen($item['name'])>94?'long-name':'' ?>" href="javascript:void(0);" ng-click="showProduct(<?=$item['product_id']?>, $event, 1)" ng-right-click="removeItem(<?=$item['product_id']?>,1)" >
                <?php endif; ?>
                <span class="product_name efruit-vi"><span itemprop="name"><?=$item['code']?> - <?=$item['name']?></span></span>
                <span class="product_name efruit-en"><span itemprop="english_name"><?=$item['code']?> - <?=$item['english_name']?></span></span>
                <span ng-show="quantityOfItem[<?=$item['product_id']?>]" class="badge">{{quantityOfItem[<?=$item['product_id']?>]}}</span>
                <?php if(!$item['enabled']):?>
                    <img loading="lazy" class="sold_out efruit-vi" alt="sold-out" src="<?=get_theme_assets_url()?>img/sold_out.png" />
                    <img loading="lazy" class="sold_out efruit-en" alt="sold-out" src="<?=get_theme_assets_url()?>img/sold_out_en.png" />
                <?php endif;?>
            </a>
            <div>
                <p class="product_description efruit-vi"><?=$item['description']?></p>
                <p class="product_description efruit-en"><?=$item['description_en']?></p>
            </div>
        </td>
        <td class="td-price" align="right" valign="middle">
            <div class="product-price">
                <span class="price"><?=$item['promotion_price']>0?('<span itemprop="price" class="old-price hidden-xs">'.$item['price'].'.000đ</span> '. $item['promotion_price'].'.000đ'):('<span itemprop="price">'.$item['price'].'.000đ</span>')?></span>
                <?php if (!empty($item['enabled'])):?>
                    <div ng-click="showProduct(<?=$item['product_id']?>, $event)" class="btn-booking add-to-cart">{{ __('Đặt hàng')}} <img loading="lazy" height="12" src="<?=get_theme_assets_url()?>img/cart-12x12.png" /></div>
                <?php endif;?>
            </div>
        </td>
    </tr>
</table>
<?php endif; ?>