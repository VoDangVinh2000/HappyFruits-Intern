<div class="content">
    <!-- <div class="banner-area">
            <div class="title">
                <h1>Your Shopping Cart</h1>
            </div>
        </div> -->
    <div class="container tablet-screen pt-5" ng-show="total">
        <div class="product-area">
            <div class="cart-table">
                <div style="overflow-x: auto;" ng-hide="total <= 0 || step > 1">
                    <table class="table table-striped" ng-show="subtotal">
                        <thead>
                            <tr>
                                <th class="hidden-xs hidden-sm">#</th>
                                <th bind-translate="Tên món">Tên món</th>
                                <th class="hidden-xs hidden-sm" bind-translate="Tùy chọn">Tùy chọn</th>
                                <th style="min-width: 50px;" bind-translate="SL">SL</th>
                                <th bind-translate="Giá">Giá</th>
                                <th class="hidden-xs hidden-sm" bind-translate="Thành tiền">Thành tiền</th>
                                <th style="width:50px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="orderItem in orderedItems">
                                <td class="hidden-xs hidden-sm">{{ $index+1 }}</td>
                                <td class="hidden-xs hidden-sm">{{orderItem.code}} - {{ settings.language=='en'?orderItem.english_name:orderItem.name }}
                                    <div ng-show="orderItem.custom.taste != 6 || orderItem.custom.description" class="sub_product">
                                        <p>&nbsp;<span ng-show="orderItem.custom.taste != 6">{{__(tasteOptions[orderItem.custom.taste])}}.</span><span ng-show="orderItem.custom.description">&nbsp;{{orderItem.custom.description}}.</span></p>
                                    </div>
                                    <div ng-show="orderedBoxes[orderItem.product_id]" class="sub_product">
                                        <span ng-repeat="(item_id, box_item) in orderedBoxes[orderItem.product_id]">{{box_item.quantity}}{{box_item.unit}} {{ settings.language=='en'?items[item_id].english_name:items[item_id].name }}{{$last ? '' : ', '}}</span>
                                    </div>
                                </td>
                                <td class="hidden-xs hidden-sm">
                                    <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple normal-choices" multiple="multiple">
                                        <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected">{{(settings.language=='en'?sub_product.english_name:sub_product.name) + (sub_product.price>0?' - ' + sub_product.price + 'k':'')}}</option>
                                    </select>
                                </td>
                                <!-- <td><input type="text" class="input-sm form-control number" only-number name="quantity" min="0" maxlength="3" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)" /></td> -->
                                <td><input aria-label="quantity form-control" class="input-qty" only-number name="quantity" max="100" min="0" name="" type="number" value="1" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)"></td>
                                <td>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span><span ng-show="orderItem.promotion_price > 0" bind-translate="KM">KM</span></td>
                                <td class="hidden-xs hidden-sm">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></td>
                                <td><a class="btn btn-sm btn-danger" href="" ng-click="removeItem(orderItem.key)"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="m10">
                    <textarea ng-show="total" class="form-control" ng-model="description" placeholder="{{__('Ghi chú khi pha chế')}}"></textarea><br />
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="txt-bold font16"><span bind-translate="Tổng cộng">Tổng cộng</span> {{ totalQuantity }} <span bind-translate="phần">phần</span> - {{(total-shipping_fee)*1000|efruit_money}}<sup>đ</sup></p>
                        </div>
                        <!-- <div class="col-sm-6 text-right-sm"><button ng-click="nextStep()" class="btn btn-success wizard-next-step-btn"><span bind-translate="Nhập thông tin giao hàng">Nhập thông tin giao hàng</span> <i class="fa fa-angle-right"></i></button></div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-12 mt-5">
                <div class="cart-buttons">
                    <!-- <input class="mybtn btn-light btn-hover-dark mr-3 mb-3 efruit-vi" name="update" type="submit" value="cập nhật giỏ hàng" />
                    <input class="mybtn btn-light btn-hover-dark mr-3 mb-3 efruit-en" name="update" type="submit" value="Update Cart" /> -->
                    <a class="mybtn btn-dark btn-outline-hover-dark efruit-vi" href="/vi">Tiếp tục mua sắm</a>
                    <a class="mybtn btn-dark btn-outline-hover-dark efruit-en" href="/vi">Continue Shopping</a>
                    <!-- <a class="mybtn btn-dark btn-outline-hover-dark mb-3 efruit-en" href="#">Clear Cart</a>
                    <a class="mybtn btn-dark btn-outline-hover-dark mb-3 efruit-vi" href="#">Xóa giỏ hàng</a> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="cart-total">
            <h3 class="efruit-vi">Tổng tiền giỏ hàng</h3>
            <h3 class="efruit-en">Cart Totals</h3>
            <table class="table table-striped">
                <tbody>
                    <!-- <tr class="cart-subtotal">
                        <th class="word-bold efruit-vi">Giá Sản Phẩm</th>
                        <th class="word-bold efruit-en">Subtotal</th>
                        <td>
                            <span class="amount">
                                <span id="bk-cart-subtotal-price">
                                    <span class=money>{{ orderItem.final_price }}</span>
                                </span>
                            </span>
                        </td>
                    </tr> -->
                    <tr class="order-total">
                        <th class="word-bold efruit-vi">Tổng Giá</th>
                        <th class="word-bold efruit-en">
                            <p class="txt-bold font16"><span bind-translate="Tổng cộng">Tổng cộng</span> {{ totalQuantity }} <span bind-translate="phần">phần</span>
                        </th>
                        <td>
                            <span class="amount">
                                <span id="bk-cart-subtotal-price">
                                    <span class=money>{{(total-shipping_fee)*1000|efruit_money}}<sup>đ</sup></span>
                                </span>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="col-sm-6 text-right-sm"><button ng-click="nextStep()" class="btn btn-success wizard-next-step-btn"><span bind-translate="Nhập thông tin giao hàng">Nhập thông tin giao hàng</span> <i class="fa fa-angle-right"></i></button></div> -->
            <button type="button" onclick="window.location.href='/vi/shipping'" class="mybtn btn-payment efruit-vi" name="checkout">Nhập thông tin giao hàng <i class="fa fa-angle-right"></i></button></button>
            <button type="button" onclick="window.location.href='/vi/shipping'" class="mybtn btn-payment efruit-en" name="checkout">Enter shipping your detail<i class="fa fa-angle-right"></i></button></button>
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