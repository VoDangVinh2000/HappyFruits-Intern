<div class="content">
    <div class="cart-modal">
        <div class="cart-lightbox"></div>
        <div class="offcanvas-cart">
            <div class="inner">
                <div class="head">
                    <span class="title" bind-translate="Giỏ hàng">Giỏ hàng</span>
                    <button class="offcanvas-close">×</button>
                </div>
                <div class="customScroll">
                    <div class="cart-empty-title">
                        <h4 ng-hide="total" bind-translate="Vui lòng chọn món.">Vui lòng chọn món.</h4>
                    </div>
                </div>
                <div ng-hide="total <= 0 || step > 1">
                    <div class="table-responsive" style="max-height: 400px; overflow: auto;">
                        <table class="table table-striped" ng-show="subtotal">
                            <thead>
                                <tr>
                                    <th class="hidden-xs hidden-sm">#</th>
                                    <th bind-translate="Tên món">Tên món</th>
                                    <th style="min-width: 50px;" bind-translate="SL">SL</th>
                                    <th bind-translate="Giá">Giá</th>
                                    <th class="hidden-xs hidden-sm" bind-translate="Thành tiền">Thành tiền</th>
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
                                    <td><input type="text" class="input-sm form-control number" only-number name="quantity" min="0" maxlength="3" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)" /></td>
                                    <td>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span><span ng-show="orderItem.promotion_price > 0" bind-translate="KM">KM</span></td>
                                    <td class="hidden-xs hidden-sm">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="m10">
                        <div class="row">
                            <div class="col-sm-6 "><button type="button" onclick="window.location.href='/vi/cart'" class="btn wizard-next-step-btn ">
                                <span class="efruit-en">View Cart</span><span class="efruit-vi">Xem giỏ hàng</span><i class="fa fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>