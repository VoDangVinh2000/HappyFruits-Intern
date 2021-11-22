<div class="content">
    <div class="cart-modal" style="overflow-y:auto; opacity:1;">
        <div class="cart-lightbox"></div>
        <!-- <div class="inner">
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
                            <div class="col-sm-6 ">
                                <button type="button" class="btn wizard-next-step-btn " id="show-cart" data-target="#ui-wizard-modal" data-toggle="modal">
                                    <span class="efruit-en">View Cart</span>
                                    <span class="efruit-vi">Xem giỏ hàng</span>
                                    <i class="fa fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


        <div class="modal-dialog" style="margin-top: 0px;">
            <div class="modal-header" style="padding: 0px 20px;">
                <h3 style="font-weight: bold; display: inline-block;font-size:20px;" ng-show="total">
                    <span bind-translate="Xác nhận đơn hàng">Xác nhận đơn hàng</span>
                    <span class="delivery_datetime" style="font-size: 16px; color: #383838;"></span>
                    <div style="color: #383838;" class="input-group datetimepicker datetimepicker2" data-maxDate="<?= strtotime('+1 year', strtotime(date('Y-m-d'))) ?>" data-minDate="<?= strtotime('+1 day', strtotime(date('Y-m-d'))) ?>" data-defaultDate="<?= strtotime('+1 day', strtotime(date('Y-m-d 9:00'))) ?>">
                        <input type='text' style="display: none;" class="form-control" />
                        <!-- <span class="input-group-addon btn btn-success" ng-show="step < 3"><span bind-translate="Thay đổi">Thay đổi</span></span> -->
                    </div>
                </h3>
                <h3 ng-hide="total" bind-translate="Vui lòng chọn món.">Vui lòng chọn món.</h3>
                <button data-dismiss="modal" style="border: none; opacity: 1;font-size: 30px;background: none;" class="close">×</button>
            </div>

            <div class="modal-content" ng-show="total">
                <div class="wizard ui-wizard-example">
                    <div ng-hide="total <= 0 || step > 1">
                        <div class="table-responsive" style="max-height: 400px; overflow: auto;">
                            <table class="table table-striped" ng-show="subtotal">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th bind-translate="Tên món">Tên món</th>
                                        <!-- <th class="d-none d-sm-block" bind-translate="Tùy chọn">Tùy chọn</th> -->
                                        <th bind-translate="Tùy chọn">Tùy chọn</th>
                                        <th style="min-width: 50px;" bind-translate="SL">SL</th>
                                        <th bind-translate="Giá">Giá</th>
                                        <!-- <th class="d-none d-sm-block" bind-translate="Thành tiền">Thành tiền</th> -->
                                        <th bind-translate="Thành tiền">Thành tiền</th>
                                        <th style="width:50px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="orderItem in orderedItems">
                                        <td>{{ $index+1 }}</td>
                                        <td>{{orderItem.code}} - {{ settings.language=='en'?orderItem.english_name:orderItem.name }}
                                            <div ng-show="orderItem.custom.taste != 6 || orderItem.custom.description" class="sub_product">
                                                <p>&nbsp;<span ng-show="orderItem.custom.taste != 6">{{__(tasteOptions[orderItem.custom.taste])}}.</span><span ng-show="orderItem.custom.description">&nbsp;{{orderItem.custom.description}}.</span></p>
                                            </div>
                                            <div ng-show="orderedBoxes[orderItem.product_id]" class="sub_product">
                                                <span ng-repeat="(item_id, box_item) in orderedBoxes[orderItem.product_id]">{{box_item.quantity}}{{box_item.unit}} {{ settings.language=='en'?items[item_id].english_name:items[item_id].name }}{{$last ? '' : ', '}}</span>
                                            </div>
                                        </td>
                                        <!-- <td class="hidden-md hidden-lg">
                                                <div ng-bind-html="settings.language=='en'?orderItem.english_name:orderItem.name|efruit_break_line"></div>
                                                <div>
                                                    <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple normal-choices" multiple="multiple">
                                                        <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected">{{(settings.language=='en'?sub_product.english_name:sub_product.name) + (sub_product.price>0?' - ' + sub_product.price + 'k':'')}}</option>
                                                    </select>
                                                </div>
                                            </td> -->
                                        <!-- <td class="d-none d-sm-block">
                                            <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple normal-choices" multiple="multiple">
                                                <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected">{{(settings.language=='en'?sub_product.english_name:sub_product.name) + (sub_product.price>0?' - ' + sub_product.price + 'k':'')}}</option>
                                            </select>
                                        </td> -->
                                        <td>
                                            <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple normal-choices" multiple="multiple">
                                                <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected">{{(settings.language=='en'?sub_product.english_name:sub_product.name) + (sub_product.price>0?' - ' + sub_product.price + 'k':'')}}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="input-sm form-control number" only-number name="quantity" min="0" maxlength="3" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)" />
                                        </td>

                                        <td>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span><span ng-show="orderItem.promotion_price > 0" bind-translate="KM">KM</span></td>
                                        <!-- <td class="d-none d-sm-block">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></td> -->
                                        <td>{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></td>
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
                                <div class="col-sm-6 text-right-sm"><button ng-click="nextStep()" class="btn btn-success wizard-next-step-btn"><span bind-translate="Nhập thông tin giao hàng">Nhập thông tin giao hàng</span> <i class="fa fa-angle-right"></i></button></div>
                            </div>
                        </div>
                    </div>
                    <div id="step2" ng-show="step == 2">
                        <form style="margin-bottom: 10px;display: flex;flex-wrap: wrap;" method="post" id="frmOrder" name="frmOrder" class="ng-pristine ng-invalid ng-invalid-required" abineguid="BB4DF9D21E60404C8F2ABF93943FC365" novalidate="novalidate">
                            <div class="col-lg-6 col-md-6 no-padding" id="distance_calculator">
                                <div class="map-container" style="position: relative;">
                                    <div id="customControl" class="hidden-xs" style="padding: 5px;background: #fff;opacity: 0.9;font-size: 12px; position: absolute; top: 0; right: 11px;z-index: 10;">
                                        <span><span bind-translate="Khoảng cách">Khoảng cách</span>: <b class="green-text">{{customer.distance}}km</b></span>
                                        <span ng-show="validForShipping" style="margin-left:15px;"><span bind-translate="Phí giao hàng">Phí giao hàng</span>:<b class="green-text">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></b></span>
                                        <span ng-show="freeShipFrom > 0 && customer.distance<=11" style="margin-left:15px;"><span bind-translate="Giao miễn phí từ">Giao miễn phí từ</span>:<b class="green-text">{{freeShipFrom*1000|efruit_money}}<sup>đ</sup></b></span>
                                    </div>
                                    <div id="map_canvas" style="height: 250px;">
                                        <p class="efruit-vi" style="margin: 100px 10px 0;color: red;text-align: center">
                                            Không tải được bản đồ.
                                            <br />Vui lòng nhấn F5 để tải lại trang hoặc sử dụng trình duyệt khác.
                                            <br />Ngoài ra, bạn cũng có thể đặt hàng qua điện thoại: <?= getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15') ?>
                                            <br />Mong bạn thông cảm về sự cố này. Xin cám ơn.
                                        </p>
                                        <p class="efruit-en" style="margin: 100px 10px 0;color: red;text-align: center">
                                            Map cannot be loaded.
                                            <br />Please press F5 to refresh or use another browser.<br />
                                            <br />You can also order via mobile: <?= getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15') ?>
                                            <br />Sorry for this disadvantage. Thank you.
                                        </p>
                                    </div>
                                    <p style="font-size: 90%;font-style: italic;padding-left: 10px;">* <span bind-translate="Kéo dấu đỏ để chọn lại vị trí của bạn">Kéo dấu đỏ để chọn lại vị trí của bạn</span></p>
                                </div>
                                <?php if (env('NEED_BOOKER_DETAILS')) : ?>
                                    <div class="block-add-address" style="padding: 0 11px;">
                                        <div class="col-sm-12 col-md-12">
                                            <h5 class="txt-bold font16" bind-translate="Thông tin người đặt">Thông tin người đặt</h5>
                                        </div>
                                        <div class="col-add-address" style="display: flex;">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="input-group">
                                                    <input placeholder="{{__('Họ và tên')}}" style="font-size: 15px;" type="text" class="form-control" ng-model="customer.booker_fullname" name="fullname" required="required" />

                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="input-group">
                                                    <?php if (isset($_SESSION['user_account'])) { ?>
                                                        <input placeholder="<?= $_SESSION['user_account'][0]['mobile_account'] ?>" type="text" class="form-control" only-number ng-model="customer.booker_mobile" ng-change="checkShippingFee()" name="mobile" maxlength="12" minlength="10" required="required" style="margin-left: 10px;" />
                                                    <?php } else { ?>
                                                        <input placeholder="SĐT" type="text" class="form-control" only-number ng-model="customer.booker_mobile" ng-change="checkShippingFee()" name="mobile" maxlength="12" minlength="10" required="required" style="margin-left: 10px;" />
                                                        <!-- <input placeholder="SĐT" type="text" class="form-control ng-dirty ng-valid ng-valid-required error" only-number="" ng-model="customer.booker_mobile" ng-change="checkShippingFee()" name="mobile" maxlength="12" minlength="10" required="required"> -->

                                                    <?php } ?>
                                                    <!-- <input placeholder="{{__('SĐT')}}" type="text"  style="font-size: 15px;" class="form-control" only-number ng-model="customer.booker_mobile" ng-change="checkShippingFee()" name="mobile" maxlength="12" minlength="10" required="required" /> -->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="input-group">
                                                <!-- <input placeholder="Email" type="email" style="font-size: 15px;" class="form-control email" ng-model="customer.email" name="email" required="required" /> -->
                                                <?php if (isset($_SESSION['user_account'])) { ?>
                                                    <input placeholder="<?= $_SESSION['user_account'][0]['email_account'] ?>" type="email" class="form-control email mt10" ng-model="customer.email" name="email" required="required" />
                                                <?php } else { ?>
                                                    <input placeholder="Email" type="email" class="form-control email mt10" ng-model="customer.email" name="email" required="required" />
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <textarea class="form-control mt10" rows="2" ng-model="customer.message_to_receiver" placeholder="{{__('Thông điệp gửi người nhận')}}."></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <br />
                                <?php endif; ?>
                                <div class="block-add-address" style="padding: 0 11px;">
                                    <?php if (env('NEED_BOOKER_DETAILS')) : ?>
                                        <div class="col-sm-12 col-md-12">
                                            <h5 class="txt-bold font16" bind-translate="Thông tin người nhận">Thông tin người nhận</h5>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="input-group">
                                            <input placeholder="{{__('Địa chỉ')}}" style="font-size: 15px;margin-bottom:10px" type="text" class="form-control" id="customer_address" ng-model="customer.address" name="address" required="required" />

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 district-container hidden">
                                        <div class="input-group" style="margin-bottom: 10px;">
                                            <?= html_select_district('form-control', "-- {{__('Quận')}} *", 'ng-model="customer.district" j-change id="district_selector"', 1) ?>

                                        </div>
                                    </div>
                                    <div class="col-blocl-address" style="display: flex;">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="input-group">
                                                <input placeholder="{{__('Họ và tên')}}" type="text" style="font-size: 15px;" class="form-control" ng-model="customer.fullname" name="fullname" required="required" />

                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="input-group">
                                                <input placeholder="{{__('SĐT')}}" type="text" style="font-size: 15px;margin-left:10px;" class="form-control" only-number ng-model="customer.mobile" ng-change="checkShippingFee()" name="mobile" maxlength="12" minlength="10" required="required" />
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (!env('NEED_BOOKER_DETAILS')) : ?>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="input-group">
                                                <input placeholder="Email" type="email" style="font-size: 15px;" class="form-control email" ng-model="customer.email" name="email" required="required" />

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="custom-checkbox-with-tick" style="margin-top: 5px;">
                                            <input type="checkbox" id="remember_info" ng-checked="customer.is_remember" ng-click="save_customer_info()" />
                                            <label for="remember_info" bind-translate="Ghi nhớ">Ghi nhớ</label>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <input type="text" style="width: 0; height: 1px; visibility: hidden;" ng-model="customer.lat" id="customer_lat" value="" class="ng-pristine ng-valid">
                                <input type="text" style="width: 0; height: 1px; visibility: hidden;" ng-model="customer.lng" id="customer_lng" value="" class="ng-pristine ng-valid">
                                <input type="text" style="width: 0; height: 1px; visibility: hidden;" j-change="" ng-model="customer.distance" id="distance" value="" class="ng-pristine ng-valid">
                                <input type="text" style="width: 0; height: 1px; visibility: hidden;" j-change="" ng-model="customer.district" id="district" value="" class="ng-pristine ng-valid">
                                <input type="hidden" name="branch_id" id="branch_id" value="">
                            </div>
                            <div class="col-lg-6 col-md-6 no-padding">
                                <div class="col-sm-12" style="padding: 0 11px;">
                                    <div class="form_errors" ng-hide="validateShipping()">
                                        <span ng-show="customer.distance<=<?= MAX_DISTANCE ?>">{{__('Xin lỗi. Tổng đơn hàng thấp nhất là 50.000đ')}}. {{__('Vui lòng đặt hàng thêm')}}.</span>
                                        <span ng-show="customer.distance><?= MAX_DISTANCE ?>">{{__('Xin lỗi. Cửa hàng không phục vụ ở khoảng cách lớn hơn')}} <?= MAX_DISTANCE ?>km.</span>
                                    </div>
                                    <div class="order-list hidden-xs">
                                        <div class="order-item" ng-repeat="orderItem in orderedItems">
                                            <span class="order-item-number">{{orderItem.quantity}}</span>
                                            <div class="order-item-info">
                                                <div class="order-item-name">
                                                    <span class="txt-bold">{{orderItem.code}} - {{ settings.language=='en'?orderItem.english_name:orderItem.name }}&nbsp;</span>
                                                    <span ng-show="orderItem.total_selected_sub" class="note-toping">
                                                        [<span ng-repeat="sp in orderItem.selected_sub_products">{{sp.name}}{{$last ? '' : ', '}}</span>]
                                                    </span>
                                                </div>
                                                <div ng-show="orderItem.custom.taste != 6 || orderItem.custom.description" class="order-item-note">
                                                    <span ng-show="orderItem.custom.taste != 6">{{__(tasteOptions[orderItem.custom.taste])}}.</span><span ng-show="orderItem.custom.description">&nbsp;{{orderItem.custom.description}}.</span>
                                                </div>
                                                <div ng-show="orderedBoxes[orderItem.product_id]" class="sub_product">
                                                    <span ng-repeat="(item_id, box_item) in orderedBoxes[orderItem.product_id]">{{box_item.quantity}}{{box_item.unit}} {{ settings.language=='en'?items[item_id].english_name:items[item_id].name }}{{$last ? '' : ', '}}</span>
                                                </div>
                                            </div>
                                            <div class="order-item-price">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></div>
                                        </div>
                                    </div>
                                    <div class="row mt10">
                                        <div class="col-xs-6 col-sm-6"><span bind-translate="Tổng cộng">Tổng cộng</span> <span class="txt-bold font16">{{ totalQuantity }}</span> <span bind-translate="phần">phần</span></div>
                                        <div class="col-xs-6 col-sm-6 txt-bold text-right">{{(subtotal)*1000|efruit_money}}<sup>đ</sup></div>
                                    </div>
                                    <div class="row mt10" ng-if="discount_amount">
                                        <div class="col-xs-6 col-sm-6"><span bind-translate="Chiết khấu">Chiết khấu</span><span ng-show="discount_amount"> ({{discount*100}}%)</span></div>
                                        <div class="col-xs-6 col-sm-6 text-right">-{{discount_amount*1000|efruit_money}}<sup>đ</sup></div>
                                    </div>
                                    <div class="row mt10" ng-if="has_VAT">
                                        <div class="col-xs-6 col-sm-6">VAT (10%)</div>
                                        <div class="col-xs-6 col-sm-6 text-right">{{VAT*(subtotal-discount_amount)*1000|efruit_money}}<sup>đ</sup></div>
                                    </div>
                                    <div class="promotion_section row mt10">
                                        <div class="col-sm-4"><span bind-translate="Mã giảm giá">Mã giảm giá</span></div>
                                        <div class="col-sm-8 text-right">
                                            <input type="text" class="promotion_code_input" placeholder="{{__('Nhập mã khuyến mãi')}}" ng-model="promotion_code" />&nbsp;<a class="btn btn-success" tabindex="-1" href="" bind-translate="Áp dụng" ng-click="checkPromotionCode($event)">Áp dụng</a>
                                        </div>
                                    </div>
                                    <div class="row mt10" ng-if="validForShipping">
                                        <div class="col-xs-8 col-sm-6"><span bind-translate="Phí giao hàng">Phí giao hàng</span>&nbsp;<span class="distance green-text"></span> <a href="<?= get_theme_assets_url() . '/img/new-shipping-fee.png?t=' . date('Ymd') ?>" class="fancybox" rel="shipping-fee"><span style="color: #fff;background: #999;padding: 2px 5px;border-radius: 10px;font-size: 12px;font-weight: bold;">?</span></a></div>
                                        <div class="col-xs-4 col-sm-6 text-right"><span ng-hide="customer.free_ship && shipping_fee > 0">&nbsp;{{shipping_fee*1000|efruit_money}}<sup>đ</sup></span><span class="strike" ng-show="customer.free_ship && shipping_fee > 0">&nbsp;{{shipping_fee*1000|efruit_money}}<sup>đ</sup></span></div>
                                    </div>
                                    <div class="row mt10">
                                        <div class="col-xs-6 col-sm-6 txt-bold font18"><span bind-translate="Tổng cộng">Tổng cộng</span></div>
                                        <div class="col-xs-6 col-sm-6 text-right txt-bold font18">{{(subtotal-discount_amount+shipping_fee + VAT*(subtotal-discount_amount))*1000|efruit_money}}<sup>đ</sup></div>
                                    </div>
                                    <div class="row mt10">
                                        <div class="col-sm-12">
                                            <div class="custom-checkbox-with-tick inline-block">
                                                <input type="checkbox" autocomplete="off" ng-model="has_VAT" id="has_VAT" value="1" ng-change="checkVAT()" /><label for="has_VAT" bind-translate="Hóa đơn VAT (+10%)">Hóa đơn VAT</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-add-address" ng-if="has_VAT">
                                        <div class="col-sm-12 col-md-12">
                                            <p style="color: red;font-size: 15px;" class="small">{{ __('Hóa đơn điện tử sẽ được gửi vào buổi tối cuối ngày') }}.</p>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="input-group">
                                                <input placeholder="{{__('Tên công ty')}}" style="font-size: 15px;margin-bottom:10px" type="text" class="form-control" id="company_name" ng-model="customer.company_name" name="address" required="required" />

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="input-group">
                                                <input placeholder="{{__('Mã số thuế')}}" style="font-size: 15px;margin-bottom:10px" type="text" class="form-control" id="company_tax_code" ng-model="customer.company_tax_code" name="company_tax_code" maxlength="15" minlength="10" required="required" />

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="input-group">
                                                <input placeholder="{{__('Địa chỉ công ty')}}" style="font-size: 15px;" type="text" class="form-control" id="company_address" ng-model="customer.company_address" name="company_address" required="required" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div ng-class="{'col-sm-6': payment_method != 'cod','col-sm-12': payment_method == 'cod'}">
                                            <select class="form-control mt10" ng-model="payment_method">
                                                <option value="cod" selected>{{__('Thanh toán khi nhận hàng')}}</option>
                                                <option value="bank">{{__('Chuyển khoản')}}</option>
                                                <option value="moca">{{__('Thanh toán qua Moca')}}</option>
                                                <option value="zalopay">{{__('Thanh toán qua Zalo Pay')}}</option>
                                                <option value="vnpay">{{__('Thanh toán qua VN Pay')}}</option>
                                                <option value="momo">{{__('Thanh toán qua Momo')}}</option>
                                            </select>
                                            <textarea class="form-control mt10" ng-model="shipping_description" placeholder="{{__('Ghi chú khi giao hàng')}}."></textarea>
                                        </div>
                                        <div class="col-sm-6 mt10" ng-show="payment_method=='bank'">
                                            <span class="efruit-vi">Ngân hàng Viet Capital (TMCP Bản Việt): 8007041016590<br />Chi nhánh HCM<br />CTK: NGÔ THị KIỀU OANH</span>
                                            <span class="efruit-en">Viet Capital Bank: 8007041016590<br />Branch: Ho Chi Minh<br />Account Holder: NGÔ THị KIỀU OANH</span>
                                        </div>
                                        <div class="col-sm-6 mt10 text-center" ng-show="payment_method=='moca'">
                                            <a href="<?= get_theme_assets_url() ?>img/moca.png" class="fancybox" rel="payment-method-moca"><img loading="lazy" width="120" alt="0906808247" src="<?= get_theme_assets_url() ?>img/moca.png" /></a><br />
                                            <span class="small" bind-translate="Nhấn vào ảnh để xem rõ hơn">Nhấn vào ảnh để xem rõ hơn</span>
                                        </div>
                                        <div class="col-sm-6 mt10 text-center" ng-show="payment_method=='zalopay'">
                                            <a href="<?= get_theme_assets_url() ?>img/zalopay.jpg" class="fancybox" rel="payment-method-zalopay"><img loading="lazy" width="120" alt="0934130134" src="<?= get_theme_assets_url() ?>img/zalopay.jpg" /></a><br />
                                            <span class="small" bind-translate="Nhấn vào ảnh để xem rõ hơn">Nhấn vào ảnh để xem rõ hơn</span>
                                        </div>
                                        <div class="col-sm-6 mt10 text-center" ng-show="payment_method=='vnpay'">
                                            <a href="<?= get_theme_assets_url() ?>img/vnpay.png" class="fancybox" rel="payment-method-vnpay"><img loading="lazy" width="120" alt="" src="<?= get_theme_assets_url() ?>img/vnpay.png" /></a><br />
                                            <span class="small" bind-translate="Nhấn vào ảnh để xem rõ hơn">Nhấn vào ảnh để xem rõ hơn</span>
                                        </div>
                                        <div class="col-sm-6 mt10 text-center" ng-show="payment_method=='momo'">
                                            <a href="<?= get_theme_assets_url() ?>img/momo.jpg" class="fancybox" rel="payment-method-momo"><img loading="lazy" width="120" alt="" src="<?= get_theme_assets_url() ?>img/momo.jpg" /></a><br />
                                            <span class="small" bind-translate="Nhấn vào ảnh để xem rõ hơn">Nhấn vào ảnh để xem rõ hơn</span>
                                        </div>
                                    </div>
                                    <div class="custom-checkbox-with-tick mt10">
                                        <input type="checkbox" autocomplete="off" ng-model="accept_terms" id="accept_terms" checked value="1" />
                                        <label for="accept_terms">
                                            <span class="efruit-vi">Tôi đồng ý với các <a href="/vi/chinh-sach-quy-dinh-chung">chính sách và điều khoản</a> của cửa hàng.</span>
                                            <span class="efruit-en">I agree with the <a href="/vi/chinh-sach-quy-dinh-chung">terms and policies</a>.</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-xs-6 col-md-3 text-center mb10-md" style="padding: 0 11px;">
                                <button ng-click="previousStep()" class="btn btn-info wizard-prev-step-btn full-width"><i class="fa fa-angle-left"></i> <span bind-translate="Xem đơn hàng">Xem đơn hàng</span></button>
                            </div>
                            <div class="col-xs-6 col-md-9 text-center" style="padding: 0 11px;">
                                <button ng-disabled="frmOrder.$invalid || minTotalError || customer.distance <= 0 || !accept_terms" ng-click="nextStep()" class="btn btn-success wizard-next-step-btn full-width" disabled="disabled"><i class="fa fa-check"></i> <span class="ng-binding">Đặt hàng</span><span class="pull-right hidden-xs ng-binding">{{(total-shipping_fee)*1000|efruit_money}}<sup>đ</sup></span></button>
                            </div>
                            <div class="clearfix"></div>
                        </form>

                        <div ng-if="step == 2">
                            <script type="text/javascript">
                                if (typeof initObj == 'function') {
                                    initializeGmap();
                                    if (document.getElementById('customer_lat').value)
                                        findNearestBranch(new google.maps.LatLng(document.getElementById('customer_lat').value, document.getElementById('customer_lng').value));
                                    else if (document.getElementById('customer_address').value)
                                        GetDistance();
                                }
                            </script>
                        </div>
                    </div>
                    <div ng-hide="step < 3" class="m10">
                        <p>
                            <span bind-translate="Cảm ơn bạn đã đặt hàng">Cảm ơn bạn đã đặt hàng</span>.
                            <br /><span bind-translate="Mã đơn hàng của bạn là:">Mã đơn hàng của bạn là: </span> <span style="font-weight: bold; font-size: 150%;">{{code}}</span>.
                            <br /><span bind-translate="Bạn có thể xem lại đơn hàng tại">Bạn có thể xem lại đơn hàng tại</span> <a target="_blank" href="<?= frontend_url() ?>don-hang/{{code}}"><?= frontend_url() ?>don-hang/{{code}}</a>.
                            <br /><span class="efruit-vi">Cửa hàng sẽ liên hệ xác nhận sớm nhất, nếu bạn cần thêm thông tin hoặc được phục vụ nhanh nhất vui lòng liên hệ hotline: <?= getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15') ?></span>
                            <span class="efruit-en">We will call you to confirm the order, if you need further information please contact us via hotline number <?= getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15') ?></span>.
                        </p>
                        <button class="btn btn-info" href="" ng-click="bookNewOrder()"><i class="fa fa-refresh"></i> <span bind-translate="Đặt hàng mới">Đặt hàng mới</span></button>&nbsp;
                        <button class="btn btn-success" href="" ng-click="step=1"><i class="fa fa-edit"></i> <span bind-translate="Sửa đơn hàng">Sửa đơn hàng</span></button>
                    </div>
                </div> <!-- / .wizard -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->


    </div>
</div>
