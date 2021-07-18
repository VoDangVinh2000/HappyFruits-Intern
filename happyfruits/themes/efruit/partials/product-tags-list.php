<div class="browse-box">
    <div class="browse-tabs efruitjs">
        <div class="tab-wrapper">
            <ul class="tab-dropdown hidden-lg hidden-md hidden-sm"  style="display: none;">
                <li class="active">
                    <span class="y-select small">
                      <select id="tab-dropdown" ng-model="current_tag" ng-change="setTag()">
                          <?php
                          if (!empty($main_tags)):
                              foreach($main_tags as $item):
                                  ?>
                                  <option value="<?=$item['tag_id']?>">{{ settings.language=='en'?'<?=$item['english_name']?>':'<?=$item['tag_name']?>' }}</option>
                              <?php
                              endforeach;
                          endif;
                          ?>
                      </select>
                    </span>
                </li>
            </ul>
            <ul class="tab-list hidden-xs" style="max-width: 100%;" ng-show="current_tag!=0">
                <?php
                if (!empty($main_tags)): $css_max_width = 'style="max-width: ' . (100/count($tags)) . '%"';
                    foreach($main_tags as $item):
                ?>
                    <li <?=$css_max_width?> ng-class="{active:current_tag==<?=$item['tag_id']?>}"><a <?=$item['is_main']?'class="is_main"':''?> ng-click="setTag(<?=$item['tag_id']?>, '<?=$item['image']?>')" href="javascript:void(0);"><i <?=$item['icon_color']?('style="color: '.$item['icon_color'].';"'):''?> class="fa <?=$item['icon']?>"></i> {{ settings.language=='en'?'<?=$item['english_name']?>':'<?=$item['tag_name']?>' }}</a></li>
                <?php
                    endforeach;
                endif;
                ?>
            </ul>
        </div>
    </div>
    <div class="cards efruitjs" id="cards" ng-show="current_tag!='menu' && current_tag!=0" masonry>
        <div ng-repeat='product in products[current_tag]' id="{{product.product_id}}" class="y-grid-card animate has-image compact masonry-brick" ng-class="{not_deliver:product.not_deliver==1}" on-ready>
            <a href="javascript:void(0);" ng-click="showProduct(product.product_id, $event, 1)" class="y-image">
                <img width="320" height="320" alt="{{product.code}} - {{ settings.language=='en'?product.english_name:product.name }}" ng-src="{{getImagePath(product)}}" class="recipe-image" />
                <img width="320" height="320" alt="gradient-background" src="<?=get_theme_assets_url()?>img/card-gradient.png" class="gradient" />
            </a>
            <div class="y-info">
                <h3 class="y-title"><a href="javascript:void(0);" ng-click="showProduct(product.product_id, $event, 1)">{{product.code}} - {{ settings.language=='en'?product.english_name:product.name }}</a></h3>
                <a ng-show="product.promotion_price == 0 && product.price > 0" href="javascript:void(0);" class="y-source">{{product.price*1000|efruit_money}}<sup>đ</sup></a>
                <a ng-show="product.promotion_price != 0 && product.price > 0" href="javascript:void(0);" class="y-source"><span class="old-price">{{product.price*1000|efruit_money}}<sup>đ</sup></span>  <span class="new-price">{{product.promotion_price*1000|efruit_money}}<sup>đ</sup></span></a>
                <p ng-show="product.description" class="y-ingredients" ng-bind-html="(settings.language=='en' && product.description_en)?product.description_en:product.description|break_line"></p>
            </div>
            <div ng-show="product.enabled" ng-click="showProduct(product.product_id, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
            <div ng-show="product.enabled != 1"><img alt="sold-out" src="<?=get_theme_assets_url()?>img/sold_out.png" class="sold_out efruit-vi"/><img alt="sold-out" class="sold_out efruit-en" src="<?=get_theme_assets_url()?>img/sold_out_en.png" /></div>
            <div ng-show="product.ribbon_left" class="half-circle-ribbon ribbon-left" ng-style="{'background-color': product.ribbon_left_color, 'box-shadow': '0 0 0 3px ' + product.ribbon_right_color}">{{product.ribbon_left}}</div>
            <div ng-show="product.ribbon_right" class="half-circle-ribbon" ng-style="{'background-color': product.ribbon_right_color, 'box-shadow': '0 0 0 3px ' + product.ribbon_right_color}">{{product.ribbon_right}}</div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="efruitjs" id="cards_loading" ng-show="current_tag!='menu' && current_tag!=0 && is_loading" style="text-align: center;background: #fff;"><img alt="loading" height="120" src="<?=get_theme_assets_url()?>img/efruit_loading.gif" /></div>
    <div ng-show="current_tag!='menu' && page[current_tag]>=1 && !no_more_page[current_tag] && is_loading == 0" class="search-more hidden">
        <div style="background: #fff;" id="more" ng-click="loadMore(1)" bind-translate="Xem thêm"></div>
    </div>
</div>