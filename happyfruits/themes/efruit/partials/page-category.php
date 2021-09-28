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
                                    <div class="col-md-4 col-sm-6 col-6">
                                        <div class="product-item">
                                            <div class="product-photo">
                                                <a href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name']) ?>" class="photo-link">
                                                    <img src="<?php echo $imageDefault ?>" alt="<?php echo $value[$i]['code'] ?>">
                                                </a>
                                                <a class="btn-shop btn-cart" href="">
                                                    <div class="button-content-wrapper">
                                                        <span class="button-text efruit-vi">Chi tiết</span>
                                                        <span class="button-text efruit-en">Detail</span>
                                                    </div>
                                                </a>
                                                <div ng-click="showProduct(<?php echo $value[$i]['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                            </div>
                                            <div class="product-info" style="margin-top: 12px;">
                                                <!-- <div class="row mt-2"> -->
                                                <div class="col-7 product-name">
                                                    <a class=" efruit-vi" href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name'])  ?>"><?= $value[$i]['name'] ?></a>
                                                    <a class=" efruit-en" href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name'])  ?>"><?= $value[$i]['english_name'] ?></a>
                                                </div>
                                                <div class="col-5">
                                                    <div class="product-price">
                                                        <?php if (empty($value[$i]['is_box'])) : ?>
                                                            <?php if ($value[$i]['price'] > 0) : ?>
                                                                <?php if ($value[$i]['promotion_price'] == 0) : ?>
                                                                    <a href="javascript:void(0);" class="price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></a>
                                                                <?php else : ?>
                                                                    <a href="javascript:void(0);">
                                                                        <span class="delete-price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></span>
                                                                        <span class="price"><?= number_format($value[$i]['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-4 col-sm-6 col-6">
                                        <div class="product-item">
                                            <div class="product-photo">
                                                <a href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name']) ?>" class="photo-link">
                                                    <img src="<?php echo $value[$i]['image'] ?>" alt="<?php echo $value[$i]['code'] ?>">
                                                </a>
                                                <a class="btn-shop btn-cart" href="">
                                                    <div class="button-content-wrapper">
                                                        <span class="button-text efruit-vi">Chi tiết</span>
                                                        <span class="button-text efruit-en">Detail</span>
                                                    </div>
                                                </a>
                                                <div ng-click="showProduct(<?php echo $value[$i]['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                            </div>
                                            <div class="product-info" style="margin-top: 12px;">
                                                <!-- <div class="row mt-2"> -->
                                                <div class="col-7 product-name">
                                                    <a class=" efruit-vi" href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name'])  ?>"><?= $value[$i]['name'] ?></a>
                                                    <a class=" efruit-en" href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name'])  ?>"><?= $value[$i]['english_name'] ?></a>
                                                </div>
                                                <div class="col-5">
                                                    <div class="product-price">
                                                        <?php if (empty($value[$i]['is_box'])) : ?>
                                                            <?php if ($value[$i]['price'] > 0) : ?>
                                                                <?php if ($value[$i]['promotion_price'] == 0) : ?>
                                                                    <a href="javascript:void(0);" class="price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></a>
                                                                <?php else : ?>
                                                                    <a href="javascript:void(0);">
                                                                        <span class="delete-price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></span>
                                                                        <span class="price"><?= number_format($value[$i]['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <!-- </div> -->
                                            </div>
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
        <div class="col-sm-3  cart-navi padding-sm hidden-xs">
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