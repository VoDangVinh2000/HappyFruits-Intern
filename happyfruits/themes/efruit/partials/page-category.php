<div class="container-fluid mt5">
    <div class="row">
        <div class="col-sm-9 ">
            <div class="row">
                <?php
                if (!empty($choose_mega_menu)) {
                    if (!empty($get_product_with_mega_menu)) {
                        $arrProducts = array($get_product_with_mega_menu);
                        foreach ($arrProducts as $value) {
                            for ($i = 0; $i < count($value); $i++) {
                                if ($value[$i]['image'] == "") {
                ?>
                                    <div class="product-item col-md-4 col-6">
                                        <div style="margin-bottom: 15px;" class="product-cat-<?= $value[$i]['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                                            <a href="/vi/detail/<?= $value[$i]['product_id'] ?>" ng-click="showProduct(<?= $value[$i]['product_id'] ?>, $event, 1)" class="y-image">
                                                <img width="320" height="320" alt="<?= $value[$i]['code'] ?>" src="<?= $value[$i]['image'] ? get_image_url($value[$i]['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                                <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                            </a>
                                            <div class="y-info">
                                                <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $value[$i]['code'] ?> - <span class="product_name efruit-vi"><?= $value[$i]['name'] ?></span><span class="product_name efruit-en"><?= $value[$i]['english_name'] ?></span></a></h3>
                                                <?php if (empty($value[$i]['is_box'])) : ?>
                                                    <?php if ($value[$i]['price'] > 0) : ?>
                                                        <?php if ($value[$i]['promotion_price'] == 0) : ?>
                                                            <a class="y-source"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></a>
                                                        <?php else : ?>
                                                            <a class="y-source"><span class="old-price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($value[$i]['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($value[$i]['description']) : ?>
                                                    <p class="y-ingredients efruit-vi"><?= $value[$i]['description'] ?></p>
                                                    <p class="y-ingredients efruit-en"><?= $value[$i]['description_en'] ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <?php if (!empty($value[$i]['enabled']) && empty($value[$i]['not_deliver'])) : ?>
                                                <div ng-click="showProduct(<?= $value[$i]['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                            <?php elseif (empty($value[$i]['enabled'])) : ?>
                                                <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                            <?php endif; ?>
                                            <?php $this->load_partial('product-ribbon', array('item' => $value[$i])); ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class=" product-item col-md-4 col-6">
                                        <div style="margin-bottom: 15px;" class="product-cat-<?= $value[$i]['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                                            <a href="/vi/detail/<?= $value[$i]['product_id'] ?>" ng-click="showProduct(<?= $value[$i]['product_id'] ?>, $event, 1)" class="y-image">
                                                <img width="320" height="320" alt="<?= $value[$i]['code'] ?>" src="<?= $value[$i]['image'] ? get_image_url($value[$i]['image'], 'square-small') : get_child_theme_assets_url() . 'img/default-product-image.png' ?>" class="recipe-image" />
                                                <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                            </a>
                                            <div class="y-info">
                                                <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $value[$i]['code'] ?> - <span class="product_name efruit-vi"><?= $value[$i]['name'] ?></span><span class="product_name efruit-en"><?= $value[$i]['english_name'] ?></span></a></h3>
                                                <?php if (empty($value[$i]['is_box'])) : ?>
                                                    <?php if ($value[$i]['price'] > 0) : ?>
                                                        <?php if ($value[$i]['promotion_price'] == 0) : ?>
                                                            <a class="y-source"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></a>
                                                        <?php else : ?>
                                                            <a class="y-source"><span class="old-price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($value[$i]['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($value[$i]['description']) : ?>
                                                    <p class="y-ingredients efruit-vi"><?= $value[$i]['description'] ?></p>
                                                    <p class="y-ingredients efruit-en"><?= $value[$i]['description_en'] ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <?php if (!empty($value[$i]['enabled']) && empty($value[$i]['not_deliver'])) : ?>
                                                <div ng-click="showProduct(<?= $value[$i]['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                            <?php elseif (empty($value[$i]['enabled'])) : ?>
                                                <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                            <?php endif; ?>
                                            <?php $this->load_partial('product-ribbon', array('item' => $value[$i])); ?>
                                        </div>
                                    </div>
                <?php }
                            }
                        }
                    } else {
                        //Nếu không có sản phẩm nào 
                        echo "<h3 class='efruit-vi text-center'>Hiện chưa có sản phẩm tương thích.</h3>
                      <h3 class='efruit-en text-center'>There are no compatible products.</h3>
                        ";
                    }
                } ?>
            </div>
        </div>
        <div class="col-sm-3  cart-navi hidden-xs">
            <div class="efruit-cart efruitjs">
                <div class="cart-header">
                    <h2 class="inline-block" bind-translate="Giỏ hàng">Giỏ hàng</h2>
                </div>
                <div class="now-order-card-group">
                    <div class="search-control"><input type="text" class="form-control" auto ng-model="search" placeholder="{{__('Nhập từ khóa để chọn món nhanh')}}" /></div>
                    <div class="order-card-person">
                        <div class="order-card-groups">
                            <div class="order-card-item" ng-repeat="orderItem in orderedItems">
                                <div class="clearfix">
                                    <button class="fa fa-plus-square" ng-click="increaseQuantity(orderItem.key)"></button><span class="number-oder">{{orderItem.quantity}}</span><button class="fa fa-minus-square" ng-click="decreaseQuantity(orderItem.key)"></button>
                                    <a href="javascript:void(0);" ng-click="editOrderedItem(orderItem.key)" class="name-order"> {{orderItem.code}} - {{ settings.language=='en'?orderItem.english_name:orderItem.name }}</a>
                                    <span class="note-topping" ng-show="orderItem.total_selected_sub"> -
                                        <span class="sub_product">
                                            <span ng-repeat="sp in orderItem.selected_sub_products">{{sp.name}}{{$last ? '' : ', '}}</span>
                                        </span>
                                    </span>
                                    <span class="note-topping" ng-show="orderedBoxes[orderItem.product_id]"><br />
                                        <span class="sub_product">
                                            <span ng-repeat="(item_id, box_item) in orderedBoxes[orderItem.product_id]">{{box_item.quantity}}{{box_item.unit}} {{ settings.language=='en'?items[item_id].english_name:items[item_id].name }}{{$last ? '' : ', '}}</span>
                                        </span>
                                    </span>
                                </div>
                                <div class="note-order">
                                    <input type="text" id="txtNote" placeholder="{{__('Thêm ghi chú')}}..." value="" ng-model="orderItem.custom.description"><span class="price-order">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-cart">
                    <div class="row">
                        <div class="col" bind-translate="Tổng">Tổng</div>
                        <div class="col-auto"><span class="txt-bold">{{subtotal*1000|efruit_money}}<sup>đ</sup></span>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row-cart txt-center input-note"><span bind-translate="Quý khách có nhu cầu xuất hóa đơn đỏ, cửa hàng sẽ thêm 10% VAT.">Quý khách có nhu cầu xuất hóa đơn đỏ, cửa hàng sẽ thêm 10% VAT.</span></div>
                <!-- ng-click="showPopupStep2()" !-->
                <button class="btn btn-order btn-success" id="showPopup" data-target="#ui-wizard-modal" data-toggle="modal"><i class="fa fa-check-circle"></i> {{ btnBookOrEditLabel }}</button>
            </div>
        </div>
    </div>
</div>