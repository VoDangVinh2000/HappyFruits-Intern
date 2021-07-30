<div class="content">
        <!-- <div class="banner-area">
            <div class="title">
                <h1>Your Shopping Cart</h1>
            </div>
        </div> -->
        <div class="container tablet-screen">
            <div class="product-area">
                <div class="cart-table">
                    <div style="overflow-x: auto;">
                        <table class="cart-wishlist-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="#"><img src="<?= get_theme_assets_url() ?>img/products/product-58-540x720_compact.jpg"
                                                alt="Fish Cut Out Set - red"></a>
                                    </td>
                                    <td class="pro-title">
                                        <div class="pro-title-content">
                                            <a href="#">Fish Cut Out Set</a>
                                            <span>red</span>
                                        </div>
                                    </td>
                                    <td class="pro-price">
                                        <div class="amount">
                                            <span class="money">$39.00</span>
                                        </div>
                                    </td>
                                    <td class="pro-quantity ">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <button id="down" class="btn-default" onclick=" down('0')"><span
                                                        class="glyphicon glyphicon-minus">(-)</span></button>
                                                <input type="text" name="myNumber" id="myNumber"
                                                    class="form-control input-number" value="1" />

                                                <button id="up" class="btn-default" onclick="up('10')"><span
                                                        class="glyphicon glyphicon-plus">(+)</span></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal">
                                        <div class="amount">
                                            <span class="money">$39.00</span>
                                        </div>
                                    </td>
                                    <td class="pro-remove">
                                        <a href="#">×</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="#"><img src="<?= get_theme_assets_url() ?>img/products/product-58-540x720_compact.jpg"
                                                alt="Fish Cut Out Set - red"></a>
                                    </td>
                                    <td class="pro-title">
                                        <a href="#">Fish Cut Out Set</a>
                                        <span>red</span>
                                    </td>
                                    <td class="pro-price">
                                        <div class="amount">
                                            <span class="money">$39.00</span>
                                        </div>
                                    </td>
                                    <td class="pro-quantity ">
                                        <div class="form-group">
                                            <div class="input-group">

                                                <button id="down" class="btn-default" onclick=" down('0')"><span
                                                        class="glyphicon glyphicon-minus">(-)</span></button>

                                                <input type="text" name="myNumber" id="myNumber"
                                                    class="form-control input-number" value="1" />

                                                <button id="up" class="btn-default" onclick="up('10')"><span
                                                        class="glyphicon glyphicon-plus">(+)</span></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal">
                                        <div class="amount">
                                            <span class="money">$39.00</span>
                                        </div>
                                    </td>
                                    <td class="pro-remove">
                                        <a href="#">×</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="#"><img src="<?= get_theme_assets_url() ?>img/products/product-58-540x720_compact.jpg"
                                                alt="Fish Cut Out Set - red"></a>
                                    </td>
                                    <td class="pro-title">
                                        <a href="#">Fish Cut Out Set</a>
                                        <span>red</span>
                                    </td>
                                    <td class="pro-price">
                                        <div class="amount">
                                            <span class="money">$39.00</span>
                                        </div>
                                    </td>
                                    <td class="pro-quantity ">
                                        <div class="form-group">
                                            <div class="input-group">

                                                <button id="down" class="btn-default" onclick=" down('0')"><span
                                                        class="glyphicon glyphicon-minus">(-)</span></button>

                                                <input type="text" name="myNumber" id="myNumber"
                                                    class="form-control input-number" value="1" />

                                                <button id="up" class="btn-default" onclick="up('10')"><span
                                                        class="glyphicon glyphicon-plus">(+)</span></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal">
                                        <div class="amount">
                                            <span class="money">$39.00</span>
                                        </div>
                                    </td>
                                    <td class="pro-remove">
                                        <a href="#">×</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-lg-12 col-12">
                    <div class="cart-buttons">
                        <input class="mybtn btn-light btn-hover-dark mr-3 mb-3" name="update" type="submit"
                            value="Update Cart" />
                        <a class="mybtn btn-dark btn-outline-hover-dark mr-3 mb-3" href="#">Continue Shopping</a>
                        <a class="mybtn btn-dark btn-outline-hover-dark mb-3" href="#">Clear Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container moblie-screen">
            <div class="cart-total">
                <h3>Cart Totals</h3>
                <table>
                    <tbody>
                        <tr class="cart-subtotal">
                            <th class="word-bold">Subtotal</th>
                            <td>
                                <span class="amount">
                                    <span id="bk-cart-subtotal-price">
                                        <span class=money>$78.00</span>
                                    </span>
                                </span>
                            </td>
                        </tr>
                        <tr class="order-total">
                            <th class="word-bold">Total</th>
                            <td>
                                <span class="amount">
                                    <span id="bk-cart-subtotal-price">
                                        <span class=money>$78.00</span>
                                    </span>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="mybtn btn-payment" name="checkout">Proceed to Checkout</button>
            </div>
        </div>
    </div>





































<!-- <div class="efruit-cart efruitjs">
    <div class="cart-header">
        <h2 class="inline-block" bind-translate="Giỏ hàng">Giỏ hàng</h2> -->



        <!-- comment old
        <button class="cart-stats"><span class="txt-bold">{{totalQuantity}}</span>&nbsp;{{__('phần')}}&nbsp;-&nbsp;<span class="txt-bold">1</span>&nbsp;{{__('người')}}</button>
        <button class="btn-reset" bind-translate="Xóa">Xóa</button>
        <div class="btn-order-group" data-toggle="modal" data-target="#share-order-group-modal" bind-translate="Đặt theo nhóm">Đặt theo nhóm</div>
        <div class="create-order">{{__('Đơn hàng tạo bởi')}} <span class="txt-blue">bạn</span></div>
        -->



    <!-- </div> -->



    <!-- <div class="now-order-card-group">
        <div class="search-control"><input type="text" class="form-control" auto ng-model="search" placeholder="{{__('Nhập từ khóa để chọn món nhanh')}}" /></div>
        <div class="order-card-person"> -->



            <!-- comment old
            <div class="order-card-user">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="user-name">Hieu Nguyen Thanh</div>
                    </div>
                    <div class="col-auto">{{totalQuantity}} món</div>
                </div>
            </div>
            -->


<!-- 
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
                        <span class="note-topping" ng-show="orderedBoxes[orderItem.product_id]"><br/>
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
    <br/>
    <div class="row-cart txt-center input-note"><span bind-translate="Quý khách có nhu cầu xuất hóa đơn đỏ, cửa hàng sẽ thêm 10% VAT.">Quý khách có nhu cầu xuất hóa đơn đỏ, cửa hàng sẽ thêm 10% VAT.</span></div>
    <button class="btn btn-order btn-success" ng-click="showPopupStep2()" data-target="#ui-wizard-modal" data-toggle="modal"><i class="fa fa-check-circle"></i> {{ btnBookOrEditLabel }}</button>
</div> -->