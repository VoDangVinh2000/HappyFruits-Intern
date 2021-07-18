<div class="efruit-cart efruitjs">
    <div class="cart-header">
        <h2 class="inline-block" bind-translate="Giỏ hàng">Giỏ hàng</h2>
        <!--
        <button class="cart-stats"><span class="txt-bold">{{totalQuantity}}</span>&nbsp;{{__('phần')}}&nbsp;-&nbsp;<span class="txt-bold">1</span>&nbsp;{{__('người')}}</button>
        <button class="btn-reset" bind-translate="Xóa">Xóa</button>
        <div class="btn-order-group" data-toggle="modal" data-target="#share-order-group-modal" bind-translate="Đặt theo nhóm">Đặt theo nhóm</div>
        <div class="create-order">{{__('Đơn hàng tạo bởi')}} <span class="txt-blue">bạn</span></div>
        -->
    </div>
    <div class="now-order-card-group">
        <div class="search-control"><input type="text" class="form-control" auto ng-model="search" placeholder="{{__('Nhập từ khóa để chọn món nhanh')}}" /></div>
        <div class="order-card-person">
            <!--
            <div class="order-card-user">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="user-name">Hieu Nguyen Thanh</div>
                    </div>
                    <div class="col-auto">{{totalQuantity}} món</div>
                </div>
            </div>
            -->
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
</div>