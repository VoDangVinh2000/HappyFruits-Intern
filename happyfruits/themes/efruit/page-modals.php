<?php
$pre_order_time = env('PREORDER_TIME', array(
    'start' => '08:00',
    'end' => '21:30'
));
$this->load_partial('product-modals');
?>
<style>
    form#frmOrder label.error{display: none !important;}
</style>
<!-- <div id="ui-wizard-modal" class="modal fade modal-order" data-backdrop="static" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" style="margin: 2% auto 0;">
        <div class="modal-header">
            <button data-dismiss="modal" class="close">×</button>
            <h3 style="font-weight: bold; display: inline-block;" ng-show="total">
                <span bind-translate="Xác nhận đơn hàng">Xác nhận đơn hàng</span>
                <span class="delivery_datetime" style="font-size: 16px; color: #383838;"></span>
                <div style="color: #383838;" class="input-group datetimepicker datetimepicker2" data-maxDate="<?=strtotime('+1 year', strtotime(date('Y-m-d')))?>" data-minDate="<?=strtotime('+1 day', strtotime(date('Y-m-d')))?>" data-defaultDate="<?=strtotime('+1 day', strtotime(date('Y-m-d 9:00')))?>" >
                    <input type='text' style="display: none;" class="form-control"/>
                    <span class="input-group-addon btn btn-success" ng-show="step < 3"><span bind-translate="Thay đổi">Thay đổi</span></span>
                </div>
            </h3>
            <h3 ng-hide="total" bind-translate="Vui lòng chọn món.">Vui lòng chọn món.</h3>
        </div>
        <div class="modal-content" ng-show="total">
            <div class="wizard ui-wizard-example">
                <div ng-hide="total <= 0 || step > 1">
                    <div class="table-responsive" style="max-height: 400px; overflow: auto;">
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
                                <td class="hidden-md hidden-lg">
                                    <div ng-bind-html="settings.language=='en'?orderItem.english_name:orderItem.name|efruit_break_line"></div>
                                    <div>
                                        <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple normal-choices" multiple="multiple">
                                            <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected">{{(settings.language=='en'?sub_product.english_name:sub_product.name) + (sub_product.price>0?' - ' + sub_product.price + 'k':'')}}</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="hidden-xs hidden-sm">
                                    <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple normal-choices" multiple="multiple">
                                        <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected" >{{(settings.language=='en'?sub_product.english_name:sub_product.name) + (sub_product.price>0?' - ' + sub_product.price + 'k':'')}}</option>
                                    </select>
                                </td>
                                <td><input type="text" class="input-sm form-control number" only-number name="quantity" min="0" maxlength="3" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)" /></td>
                                <td>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span><span ng-show="orderItem.promotion_price > 0"  bind-translate="KM">KM</span></td>
                                <td class="hidden-xs hidden-sm">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></td>
                                <td><a class="btn btn-sm btn-danger" href="" ng-click="removeItem(orderItem.key)"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="m10">
                        <textarea ng-show="total" class="form-control" ng-model="description" placeholder="{{__('Ghi chú khi pha chế')}}"></textarea><br />
                        <div class="row">
                            <div class="col-sm-6"><p class="txt-bold font16"><span bind-translate="Tổng cộng">Tổng cộng</span> {{ totalQuantity }} <span bind-translate="phần">phần</span> - {{(total-shipping_fee)*1000|efruit_money}}<sup>đ</sup></p></div>
                            <div class="col-sm-6 text-right-sm"><button ng-click="nextStep()" class="btn btn-success wizard-next-step-btn"><span bind-translate="Nhập thông tin giao hàng">Nhập thông tin giao hàng</span> <i class="fa fa-angle-right"></i></button></div>
                        </div>
                    </div>
                </div>
                <div id="step2" ng-show="step == 2">
                    <form style="margin-bottom: 10px;" method="post" id="frmOrder" name="frmOrder">
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
                                        <br/>Vui lòng nhấn F5 để tải lại trang hoặc sử dụng trình duyệt khác.
                                        <br/>Ngoài ra, bạn cũng có thể đặt hàng qua điện thoại: <?=getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15')?>
                                        <br/>Mong bạn thông cảm về sự cố này. Xin cám ơn.
                                    </p>
                                    <p class="efruit-en" style="margin: 100px 10px 0;color: red;text-align: center">
                                        Map cannot be loaded.
                                        <br/>Please press F5 to refresh or use another browser.<br />
                                        <br/>You can also order via mobile: <?=getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15')?>
                                        <br/>Sorry for this disadvantage. Thank you.
                                    </p>
                                </div>
                                <p style="font-size: 90%;font-style: italic;padding-left: 10px;">* <span bind-translate="Kéo dấu đỏ để chọn lại vị trí của bạn">Kéo dấu đỏ để chọn lại vị trí của bạn</span></p>
                            </div>
                            <?php if (env('NEED_BOOKER_DETAILS')):?>
                            <div class="block-add-address">
                                <div class="col-sm-12 col-md-12">
                                    <h5 class="txt-bold font16" bind-translate="Thông tin người đặt">Thông tin người đặt</h5>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group">
                                        <input placeholder="{{__('Họ và tên')}}" type="text" class="form-control" ng-model="customer.booker_fullname" name="fullname" required="required" />
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group">
                                        <input placeholder="{{__('SĐT')}}" type="text" class="form-control" only-number ng-model="customer.booker_mobile" ng-change="checkShippingFee()" name="mobile" maxlength="12" minlength="10" required="required" />
                                        <i class="fa fa-phone fa-rotate-90"></i>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group">
                                        <input placeholder="Email" type="email" class="form-control email" ng-model="customer.email" name="email" required="required" />
                                        <i class="fa fa-envelope" style="font-size: 9px;"></i>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <textarea class="form-control mt10" rows="2" ng-model="customer.message_to_receiver" placeholder="{{__('Thông điệp gửi người nhận')}}."></textarea>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <br/>
                            <?php endif; ?>
                            <div class="block-add-address">
                                <?php if (env('NEED_BOOKER_DETAILS')):?>
                                <div class="col-sm-12 col-md-12">
                                    <h5 class="txt-bold font16" bind-translate="Thông tin người nhận">Thông tin người nhận</h5>
                                </div>
                                <?php endif; ?>
                                <div class="col-sm-12 col-md-12">
                                    <div class="input-group">
                                        <input placeholder="{{__('Địa chỉ')}}" type="text" class="form-control" id="customer_address" ng-model="customer.address" name="address" required="required" />
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 district-container hidden">
                                    <div class="input-group">
                                        <?=html_select_district('form-control', "-- {{__('Quận')}} *", 'ng-model="customer.district" j-change id="district_selector"', 1)?>
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group">
                                        <input placeholder="{{__('Họ và tên')}}" type="text" class="form-control" ng-model="customer.fullname" name="fullname" required="required" />
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group">
                                        <input placeholder="{{__('SĐT')}}" type="text" class="form-control" only-number ng-model="customer.mobile" ng-change="checkShippingFee()" name="mobile" maxlength="12" minlength="10" required="required" />
                                        <i class="fa fa-phone fa-rotate-90"></i>
                                    </div>
                                </div>
                                <?php if (!env('NEED_BOOKER_DETAILS')):?>
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group">
                                        <input placeholder="Email" type="email" class="form-control email" ng-model="customer.email" name="email" required="required" />
                                        <i class="fa fa-envelope" style="font-size: 9px;"></i>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-sm-12 col-md-6">
                                    <div class="custom-checkbox-with-tick" style="margin-top: 5px;">
                                        <input type="checkbox" id="remember_info" ng-checked="customer.is_remember" ng-click="save_customer_info()"/>
                                        <label for="remember_info" bind-translate="Ghi nhớ">Ghi nhớ</label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <input type="text" style="width: 0; height: 1px; visibility: hidden;" ng-model="customer.lat" id="customer_lat" value="" />
                            <input type="text" style="width: 0; height: 1px; visibility: hidden;" ng-model="customer.lng" id="customer_lng" value="" />
                            <input type="text" style="width: 0; height: 1px; visibility: hidden;" j-change ng-model="customer.distance" id="distance" value="" />
                            <input type="text" style="width: 0; height: 1px; visibility: hidden;" j-change ng-model="customer.district" id="district" value="" />
                            <input type="hidden" name="branch_id" id="branch_id" value="" />
                        </div>
                        <div class="col-lg-6 col-md-6 no-padding" >
                            <div class="col-sm-12">
                                <div class="form_errors" ng-hide="validateShipping()">
                                    <span ng-show="customer.distance<=<?=MAX_DISTANCE?>">{{__('Xin lỗi. Tổng đơn hàng thấp nhất là 50.000đ')}}. {{__('Vui lòng đặt hàng thêm')}}.</span>
                                    <span ng-show="customer.distance><?=MAX_DISTANCE?>">{{__('Xin lỗi. Cửa hàng không phục vụ ở khoảng cách lớn hơn')}} <?=MAX_DISTANCE?>km.</span>
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
                                        <input type="text" class="promotion_code_input" placeholder="{{__('Nhập mã khuyến mãi')}}" ng-model="promotion_code" />&nbsp;<a class="btn btn-success" tabindex="-1" href="" bind-translate="Áp dụng" ng-click="checkPromotionCode($event)" >Áp dụng</a>
                                    </div>
                                </div>
                                <div class="row mt10" ng-if="validForShipping">
                                    <div class="col-xs-8 col-sm-6"><span bind-translate="Phí giao hàng">Phí giao hàng</span>&nbsp;<span class="distance green-text"></span> <a href="<?=get_theme_assets_url(). '/img/new-shipping-fee.png?t='. date('Ymd')?>" class="fancybox" rel="shipping-fee"><span style="color: #fff;background: #999;padding: 2px 5px;border-radius: 10px;font-size: 12px;font-weight: bold;">?</span></a></div>
                                    <div class="col-xs-4 col-sm-6 text-right"><span ng-hide="customer.free_ship && shipping_fee > 0">&nbsp;{{shipping_fee*1000|efruit_money}}<sup>đ</sup></span><span class="strike" ng-show="customer.free_ship && shipping_fee > 0">&nbsp;{{shipping_fee*1000|efruit_money}}<sup>đ</sup></span></div>
                                </div>
                                <div class="row mt10">
                                    <div class="col-xs-6 col-sm-6 txt-bold font18"><span bind-translate="Tổng cộng">Tổng cộng</span></div>
                                    <div class="col-xs-6 col-sm-6 text-right txt-bold font18">{{(subtotal-discount_amount+shipping_fee + VAT*(subtotal-discount_amount))*1000|efruit_money}}<sup>đ</sup></div>
                                </div>
                                <div class="row mt10">
                                    <div class="col-sm-12">
                                        <div class="custom-checkbox-with-tick inline-block">
                                            <input type="checkbox" autocomplete="off" ng-model="has_VAT" id="has_VAT" value="1" ng-change="checkVAT()"/><label for="has_VAT" bind-translate="Hóa đơn VAT (+10%)">Hóa đơn VAT</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-add-address" ng-if="has_VAT">
                                    <div class="col-sm-12 col-md-12"><p style="color: red;" class="small">{{ __('Hóa đơn điện tử sẽ được gửi vào buổi tối cuối ngày') }}.</p></div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="input-group">
                                            <input placeholder="{{__('Tên công ty')}}" type="text" class="form-control" id="company_name" ng-model="customer.company_name" name="address" required="required" />
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="input-group">
                                            <input placeholder="{{__('Mã số thuế')}}" type="text" class="form-control" id="company_tax_code" ng-model="customer.company_tax_code" name="company_tax_code" maxlength="15" minlength="10" required="required" />
                                            <i class="fa fa-barcode"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="input-group">
                                            <input placeholder="{{__('Địa chỉ công ty')}}" type="text" class="form-control" id="company_address" ng-model="customer.company_address" name="company_address" required="required" />
                                            <i class="fa fa-map-marker"></i>
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
                                        </select>
                                        <textarea class="form-control mt10" ng-model="shipping_description" placeholder="{{__('Ghi chú khi giao hàng')}}."></textarea>
                                    </div>
                                    <div class="col-sm-6 mt10" ng-show="payment_method=='bank'">
                                        <span class="efruit-vi">Ngân hàng Viet Capital (TMCP Bản Việt): 8007041016590<br/>Chi nhánh HCM<br/>CTK: NGÔ THị KIỀU OANH</span>
                                        <span class="efruit-en">Viet Capital Bank: 8007041016590<br/>Branch: Ho Chi Minh<br/>Account Holder: NGÔ THị KIỀU OANH</span>
                                    </div>
                                    <div class="col-sm-6 mt10 text-center" ng-show="payment_method=='moca'">
                                        <a href="<?=get_theme_assets_url()?>img/moca.png" class="fancybox" rel="payment-method-moca"><img loading="lazy" width="120" alt="0906808247" src="<?=get_theme_assets_url()?>img/moca.png" /></a><br/>
                                        <span class="small" bind-translate="Nhấn vào ảnh để xem rõ hơn">Nhấn vào ảnh để xem rõ hơn</span>
                                    </div>
                                    <div class="col-sm-6 mt10 text-center" ng-show="payment_method=='zalopay'">
                                        <a href="<?=get_theme_assets_url()?>img/zalopay.jpg" class="fancybox" rel="payment-method-zalopay"><img loading="lazy" width="120" alt="0934130134" src="<?=get_theme_assets_url()?>img/zalopay.jpg" /></a><br/>
                                        <span class="small" bind-translate="Nhấn vào ảnh để xem rõ hơn">Nhấn vào ảnh để xem rõ hơn</span>
                                    </div>
                                    <div class="col-sm-6 mt10 text-center" ng-show="payment_method=='vnpay'">
                                        <a href="<?=get_theme_assets_url()?>img/vnpay.png" class="fancybox" rel="payment-method-vnpay"><img loading="lazy" width="120" alt="" src="<?=get_theme_assets_url()?>img/vnpay.png" /></a><br/>
                                        <span class="small" bind-translate="Nhấn vào ảnh để xem rõ hơn">Nhấn vào ảnh để xem rõ hơn</span>
                                    </div>
                                </div>
                                <div class="custom-checkbox-with-tick mt10">
                                    <input type="checkbox" autocomplete="off" ng-model="accept_terms" id="accept_terms" checked value="1"/>
                                    <label for="accept_terms">
                                        <span class="efruit-vi">Tôi đồng ý với các <a href="/vi/chinh-sach-quy-dinh-chung">chính sách và điều khoản</a> của cửa hàng.</span>
                                        <span class="efruit-en">I agree with the <a href="/vi/chinh-sach-quy-dinh-chung">terms and policies</a>.</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-6 col-md-3 text-center mb10-md">
                            <button ng-click="previousStep()" class="btn btn-info wizard-prev-step-btn full-width"><i class="fa fa-angle-left"></i> <span bind-translate="Xem đơn hàng">Xem đơn hàng</span></button>
                        </div>
                        <div class="col-xs-6 col-md-9 text-center">
                            <button ng-disabled="frmOrder.$invalid || minTotalError || customer.distance <= 0 || !accept_terms" ng-click="nextStep()" class="btn btn-success wizard-next-step-btn full-width"><i class="fa fa-check"></i> <span>{{ btnBookOrEditLabel }}</span><span class="pull-right hidden-xs">{{(subtotal-discount_amount+shipping_fee + VAT*(subtotal-discount_amount))*1000|efruit_money}}<sup>đ</sup></span></button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                    <div ng-if="step == 2">
                        <script type="text/javascript">
                            if (typeof initObj == 'function')
                            {
                                initializeGmap();
                                if (document.getElementById('customer_lat').value)
                                    findNearestBranch(new google.maps.LatLng(document.getElementById('customer_lat').value, document.getElementById('customer_lng').value));
                                else if(document.getElementById('customer_address').value)
                                    GetDistance();
                            }
                        </script>
                    </div>
                </div>
                <div ng-hide="step < 3" class="m10">
                    <p>
                        <span bind-translate="Cảm ơn bạn đã đặt hàng">Cảm ơn bạn đã đặt hàng</span>.
                        <br/><span bind-translate="Mã đơn hàng của bạn là:">Mã đơn hàng của bạn là: </span> <span style="font-weight: bold; font-size: 150%;">{{code}}</span>.
                        <br/><span bind-translate="Bạn có thể xem lại đơn hàng tại">Bạn có thể xem lại đơn hàng tại</span> <a target="_blank" href="<?=frontend_url()?>don-hang/{{code}}"><?=frontend_url()?>don-hang/{{code}}</a>.
                        <br/><span class="efruit-vi">Cửa hàng sẽ liên hệ xác nhận sớm nhất, nếu bạn cần thêm thông tin hoặc được phục vụ nhanh nhất vui lòng liên hệ hotline: <?=getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15')?></span>
                        <span class="efruit-en">We will call you to confirm the order, if you need further information please contact us via hotline number <?=getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15')?></span>.
                    </p>
                    <button class="btn btn-info" href="" ng-click="bookNewOrder()"><i class="fa fa-refresh"></i> <span bind-translate="Đặt hàng mới">Đặt hàng mới</span></button>&nbsp;
                    <button class="btn btn-success" href="" ng-click="step=1"><i class="fa fa-edit"></i> <span bind-translate="Sửa đơn hàng">Sửa đơn hàng</span></button>
                </div>
            </div> <!-- / .wizard -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> 
<div role="dialog" tabindex="-1" class="modal fade in" id="modal-notices" aria-hidden="false">
    <div class="modal-dialog normal-dialog">
        <div class="modal-content"  style="background: rgba(56,56,56,0.8);">
            <div class="modal-header" style="background: none;padding: 0;">
                <button style="margin: 0 5px 0;color: #fff;" aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <?php
                if (!empty($announcements)):
                    foreach($announcements as $ann):
                        if (($ann['start_dtm'] && strtotime($ann['start_dtm']) > time())
                            || ($ann['end_dtm'] && strtotime($ann['end_dtm']) < time()))
                            continue;
                        ?>
                        <div class="message row<?=$ann['temporary_close']?' close-temporary':''?>">
                            <?php if ($ann['image']):?>
                                <div class="col-md-6"><img loading="lazy" alt="hinh-thong-bao" style="width: 100%;" src="<?=valid_url($ann['image'])?>"/><br /><br /></div>
                                <div class="col-md-6"><div class="efruit-vi"><?=$ann['content']?></div><div class="efruit-en"><?=$ann['content_en']?></div></div>
                            <?php else:?>
                                <div class="col-md-12"><div class="efruit-vi"><?=$ann['content']?></div><div class="efruit-en"><?=$ann['content_en']?></div></div>
                            <?php endif;?>
                            <?php if ($ann['start_dtm']):?>
                                <input type="hidden" class="starttime" value="<?=strtotime($ann['start_dtm'])?>" />
                            <?php endif; ?>
                            <?php if ($ann['end_dtm']):?>
                                <input type="hidden" class="endtime" value="<?=strtotime($ann['end_dtm'])?>" />
                            <?php endif; ?>
                        </div>
                    <?php
                    endforeach;
                endif;
                ?>
                <?php
                global $is_off;
                if (!empty($is_off)):
                    ?>
                    <div class="message row close-everyday">
                        <div class="col-md-4"><img loading="lazy" alt="we-are-closed" style="width: 100%;" src="<?=get_theme_assets_url()?>img/closed.png"/></div>
                        <div class="col-md-8">
                            <h2 style="color: #51bd36;font-weight: bold;" class="modal-title">{{__('Hiện ngoài giờ phục vụ.')}}</h2>
                            <p>{{__('Giờ mở cửa:')}} 8h - 22h<br />{{__('Giờ giao hàng:')}} 8h30 - 21h30
                            </p>
                            <p>{{__('Quý khách có nhu cầu đặt online vui lòng ghi chú giờ hẹn giao đến.')}}<br />
                                {{__('Chúng tôi sẽ kiểm tra và liên lạc sớm nhất.')}}<br />
                                {{__('Chân thành cảm ơn.')}}</p>
                        </div>
                    </div>
                <?php else:?>
                    <?php
                    $period = get_setting('overload_in_period');
                    if (!empty($period) && strtotime($period) > time()):
                        ?>
                        <div class="message row">
                            <div class="col-md-4"><img loading="lazy" alt="we-are-overload" style="width: 100%;" src="<?=get_theme_assets_url()?>img/overload.jpg"/></div>
                            <div class="col-md-8">
                                <h2 style="color: #51bd36;font-weight: bold;" class="modal-title">{{__('Cửa hàng hiện đang quá tải dịch vụ.')}}</h2>
                                <p>{{__('Để đảm bảo dịch vụ cửa hàng xin phép tạm ngưng nhận đơn hàng.')}}
                                    <br />{{__('Quý khách có thể đặt món trước và được phục vụ sau')}} <span style="color: red;"><?php echo date('H', strtotime($period)) ?>:<?php echo date('i', strtotime($period)) ?></span></p>
                                <p>{{__('Xin chân thành cảm ơn và mong quý khách thông cảm.')}}<br />
                                    {{__('Thương chúc an vui.')}}</p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div role="dialog" tabindex="-1" class="modal fade in" data-backdrop="static" id="modal-pre-booking" aria-hidden="false">
    <div class="modal-dialog normal-dialog">
        <div class="modal-content"  style="background: rgba(56,56,56,0.8);">
            <div class="modal-body">
                <div class="message row">
                    <div class="col-md-4" style="text-align: center;"><img loading="lazy" alt="discount" src="<?=get_theme_assets_url()?>img/discount.png" style="width: 100%;max-width: 200px;"/></div>
                    <div class="col-md-8">
                        <h2 class="modal-title efruit-vi" style="color: #51bd36;font-weight: bold;">Đặt hàng Online trước để nhận khuyến mãi.</h2>
                        <h2 class="modal-title efruit-en" style="color: #51bd36;font-weight: bold;">Preorder online to get discount.</h2>
                        <p class="preorder-1day" style="color: #fff;">
                            <span class="efruit-vi">Đặt trước 1 ngày: giảm <?=intval(PRE_BOOKING_DISCOUNT_2*100)?>% tổng hóa đơn</span>
                            <span class="efruit-en">1 day pre-order: <?=intval(PRE_BOOKING_DISCOUNT_2*100)?>% discount</span>
                        </p>
                        <p class="preorder-1days" style="color: #fff;">
                            <span class="efruit-vi">Đặt trước 2 ngày trở lên: giảm <?=intval(PRE_BOOKING_DISCOUNT*100)?>% tổng hóa đơn</span>
                            <span class="efruit-en">2 days pre-order: <?=intval(PRE_BOOKING_DISCOUNT*100)?>% discount</span>
                        </p>
                        <p style="color: #fff;">{{ printf(__('Thời gian giao hàng từ %s đến %s mỗi ngày'), '<?=$pre_order_time["start"]?>', '<?=$pre_order_time["end"]?>') }}.</p>
                        <div class="form-group">
                            <label class="control-label" style="color: #fff;">{{__('Chương trình chỉ áp dụng khi đặt Online tại website')}}</label>
                            <label for="date_time" class="control-label" style="color: #fff;">{{__('Vui lòng chọn thời gian giao hàng')}} *</label>
                            <div class="input-group datetimepicker" id="datetimepicker" data-maxDate="<?=strtotime('+1 year', strtotime(date('Y-m-d')))?>" data-minDate="<?=strtotime('+1 day', strtotime(date('Y-m-d')))?>" data-defaultDate="<?=strtotime('+1 day', strtotime(date('Y-m-d '. $pre_order_time["start"])))?>" >
                                <input type='text' id="date_time" name="date_time" class="form-control"/>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                        <button id="setPreBookDate" disabled="" style="margin-bottom: 5px;" class="btn btn-success" ng-click="setPreBookDate()" ><i class="fa fa-check"></i> {{__('Xác nhận và chọn món')}}</button>
                        <button style="margin-bottom: 5px;" class="btn btn-info" ng-click="clearPreBookDate()"><i class="fa fa-times"></i> {{__('Hủy')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div role="dialog" tabindex="-1" class="modal fade in dark-bg" id="modal-order-flow" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content" style="background: rgba(56,56,56,0.8);">
            <div class="modal-header" style="background: none;">
                <button style="margin: -10px 0px 0 0;color: #fff;" aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body" style="padding-top: 0;">
                <div class="row  row-fluid">
                    <div class="col-sm-12">
                        <div class="row shipping_process">
                            <?php
                                $shipping_fee_des = get_setting('general_shiping_fee_description');
                                $payment_des = get_setting('general_payment_description');
                                $stripped_des = filter_var(strip_tags($shipping_fee_des), FILTER_VALIDATE_URL);
                                $is_image = $stripped_des && in_array(pathinfo($stripped_des, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'));
                            ?>
                            <div class="<?=$is_image?'col-sm-8':'col-sm-6'?>">
                                <div class="des-wrapper">
                                    <p><img loading="lazy" height="83" alt="shipping-icon" src="<?=get_theme_assets_url()?>img/shipping-icon.png" /></p>
                                    <h3 style="color: #51bd36;font-weight: bold;">{{__('Phí giao hàng')}}</h3>
                                    <?php if($is_image): ?>
                                    <a href="<?=$stripped_des. '?t='. date('Ymd')?>" class="fancybox" rel="shipping-fee-1"><img loading="lazy" src="<?=$stripped_des. '?t='. date('Ymd')?>"></a>
                                    <?php else: ?>
                                        <br />
                                        <div class="efruit-vi"><?=$shipping_fee_des?></div>
                                        <div class="efruit-en"><?=get_setting('general_shiping_fee_description', $shipping_fee_des, 'en')?></div>
                                    <?php endif; ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="<?=$is_image?'col-sm-4':'col-sm-6'?>">
                                <div class="des-wrapper">
                                    <p style="line-height: 83px;"><img loading="lazy" height="40" alt="vnd-icon" src="<?=get_theme_assets_url()?>img/vnd-icon.png" /></p>
                                    <h3 style="color: #51bd36;font-weight: bold;">{{__('Thanh toán')}}</h3>
                                    <br />
                                    <div class="efruit-vi"><?=$payment_des?></div>
                                    <div class="efruit-en"><?=get_setting('general_payment_description', $payment_des, 'en')?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
<div id="live-dialog" class="efruitjs">
    <a href="#openpanel" class="open"><span><img loading="lazy" src="<?=get_theme_assets_url()?>img/gift.gif" width="55" /></span></a>
    <a href="#closepanel" class="close"><span><i class="fa fa-times"></i></span></a>
    <div id="live-dialog-container">
        <div class="live-dialog-box">
            <?php
            if (!empty($sales_anns)):
                foreach($sales_anns as $d):
                    if (($d['start_dtm'] && strtotime($d['start_dtm']) > time())
                        || ($d['end_dtm'] && strtotime($d['end_dtm']) < time())
                        || ($d['start_sales_time'] && strtotime($d['start_sales_time']) > time())
                        || ($d['end_sales_time'] && strtotime($d['end_sales_time']) < time())
                    )
                        continue;
                    ?>
                    <div class="golden-time-row row">
                        <?php if ($d['image']):?>
                            <div class="col-md-12"><img loading="lazy" alt="hinh-thong-bao" style="width: 100%;" src="<?=$d['image']?>"/></div>
                            <div class="col-md-12"><div class="efruit-vi"><?=$d['content']?></div><div class="efruit-en"><?=$d['content_en']?></div></div>
                        <?php else:?>
                            <div class="col-md-12 efruit-vi"><div class="efruit-vi"><?=$d['content']?></div><div class="efruit-en"><?=$d['content_en']?></div></div>
                        <?php endif;?>
                        <?php if ($d['start_dtm']):?>
                            <input type="hidden" class="starttime" value="<?=strtotime($d['start_dtm'])?>" />
                        <?php endif; ?>
                        <?php if ($d['end_dtm']):?>
                            <input type="hidden" class="endtime" value="<?=strtotime($d['end_dtm'])?>" />
                        <?php endif; ?>
                        <div class="col-md-12">
                            {{__('Thời gian còn lại')}}: <span data-countdown="<?=date('Y/m/d').' '.$d['end_sales_time']?>"></span>
                        </div>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>
<div id="efruit_phone_div" class="efruit-phone efruit-green efruit-active">
    <a href="tel:0938707015 " target="_top" class="" title="Gọi">
        <div class="efruit-ph-circle"></div>
        <div class="efruit-ph-circle-fill"></div>
        <div class="efruit-ph-img-circle"></div>
    </a>
</div>
<div class="modal fade modal-share-order-group" data-backdrop="static" id="share-order-group-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog normal-dialog" role="document">
        <div class="modal-content"><span class="close" data-dismiss="modal">x</span>
            <div class="modal-header">Chia sẻ với nhóm của bạn</div>
            <div class="modal-body">
                <div class="group-share-left">
                    <div id="share-order-group-qr-code" style="height: 128px; width: 128px;" height="160" width="160"></div>
                    <p><a href="<?=ROOT_URL?>vi/?e=I809CECN5N" rel="noopener noreferrer" target="_blank">Mở tab mới</a></p>
                </div>
                <div class="group-share-content">
                    <h5 class="group-share-title">Sao chép link và gửi cho nhóm</h5>
                    <input type="text" readonly="" style="background-color: rgb(255, 255, 255);" value="<?=ROOT_URL?>vi/?e=I809CECN5N">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>