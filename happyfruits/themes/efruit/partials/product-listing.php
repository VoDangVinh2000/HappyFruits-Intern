<?php
if (!empty($cat_products) || !empty($products_in_tags)) :
    if (empty($number_of_cols)) {
        $number_of_cols = Hash::get($obj, 'config.number_of_cols_in_frontend', 4);
    }
?>
    <div class="row">
        <div class="col-sm-9  no-padding">
            <div class="product-listing <?= empty($class) ? '' : $class ?>">
                <?php if (!empty($heading)) : ?>
                    <h1 class="title center" style="margin: 30px;" bind-translate="<?= $heading ?>"><?= $heading ?></h1>
                <?php endif; ?>
                <div class="container" style="width: 100%;">
                    <div class="row gy-2">
                        <?php
                        $counter = 0;
                        $viewed_products = array();
                        if (!empty($cat_products)) :
                            foreach ($cat_products as $item) :
                                $viewed_products[$item['product_id']] = true;
                                $counter++;
                                $need_hide = !empty($showMore) && $counter > NUMBER_OF_ITEMS_PER_PAGE;
                        ?>
                                <div class="product-item col-md-4 col-sm-4 col-6">
                                    <?php $this->load_partial('product-item-box', array('item' => $item)); ?>
                                </div>
                                <?php
                            endforeach;
                        endif;

                        if (!empty($products_in_tags)) :
                            foreach ($products_in_tags as $tag_id => $items) :
                                foreach ($items as $item) {
                                    if (!empty($viewed_products[$item['product_id']])) continue;
                                    $viewed_products[$item['product_id']] = true;
                                    $counter++;
                                    $need_hide = !empty($showMore) && $counter > NUMBER_OF_ITEMS_PER_PAGE;
                                ?>
                                    <div class="product-item col-md-4 col-sm-4 col-6">
                                        <?php $this->load_partial('product-item-box', array('item' => $item)); ?>
                                    </div>
                    </div>
                </div>
    <?php
                                }
                            endforeach;
                        endif;
                        $total_products = count($viewed_products);
    ?>
            </div>
        </div>
    </div>
    </div>
    <div class="col-sm-3  nopadding cart-navi hidden-xs ">
        <div class="efruit-cart efruitjs border border-darkgray">
            <div class="cart-header">
                <h2 class="inline-block" bind-translate="Giỏ hàng">Giỏ hàng</h2>
            </div>
            <div class="now-order-card-group ">
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
            <button class="btn btn-order btn-success" ng-click="showPopupStep2()" id="showPopup" data-target="#ui-wizard-modal" data-toggle="modal"><i class="fa fa-check-circle"></i> {{ btnBookOrEditLabel }}</button>
        </div>
    </div>
    </div>
    <?php if (!empty($showMore) && $total_products > NUMBER_OF_ITEMS_PER_PAGE) : ?>
        <div class="clearfix"></div>
        <div class="search-more">
            <div style="background: #fff;text-align: center;font-size: 1rem;" id="more" data-page="1" bind-translate="Xem thêm">Xem thêm</div>
        </div>
    <?php endif; ?>
    </div>
<?php endif; ?>