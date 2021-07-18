<?php
include("includes/order.inc.php");
include("includes/auth_for_selling.inc.php");
$title = "Bán hàng";
$main_js = 'selling';
// Overidden css loaded files
$css = array(
    array('href' => SITE_URL. "css/selling.css"),
    array('href' => SITE_URL. "js/bootstrap-datetimepicker/bootstrap-datetimepicker.css"),
    array('href' => SITE_URL. "css/print_selling_v2.css", "media" => "print")
);
$js = array(
    array('src' => SITE_URL. 'js/jquery.key.js'),
    array('src' => SITE_URL. 'js/rsa/jsbn.js'),
    array('src' => SITE_URL. 'js/rsa/rsa.js')
);

$table_names = array('LD01', 'L01', 'L02', 'L03', 'BC01', 'BC02', 'SV01', 'SV02', 'VH01', 'VH02');
$order_types = eModel::_select('order_types', array('deleted' => 0, 'order_by' => 'sequence_number'));
$is_selling = 1;
include("includes/header.inc.php");
?>
<body class="<?=$logged_user?'logged-users':'anonymous'?>" >
<div class="hidden_when_printing">
    <nav role="navigation" class="navbar navbar-default navbar-fixed-top col-sm-offset-4 col-md-9 col-md-offset-3" style="position: relative;">
        <div class="container" style="width: auto;">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img class="logo" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/>
            </div>
            <div class="navbar-collapse collapse" id="navbar" aria-expanded="false" style="height: 0.8px;">
                <ul class="nav navbar-nav">
                    <?php foreach($order_types as $t):?>
                        <li ng-class="{active:current_order_type.id==<?=$t['id']?>}">
                            <a ng-click="changeOrderType(<?=$t['id']?>)" href="">
                                <?=$t['type_name']?>
                                <span class="badge" ng-show="quantityInOrderType[<?=$t['id']?>]">{{quantityInOrderType[<?=$t['id']?>]}}</span>
                            </a>
                        </li>
                    <?php endforeach;?>
                    <li class="dropdown for_logged_users">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Chức năng <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a id="logoutBtn" href="#">Đăng xuất (<span class="user_fullname"></span>)</a></li>
                            <li><a class="can_modify_shift_data" href="" data-toggle="modal" data-target="#createPaymentVouchers">Tạo phiếu chi</a></li>
                            <li><a class="can_modify_shift_data" href="" data-toggle="modal" data-target="#createReceiptVouchers">Tạo phiếu thu</a></li>
                            <li><a class="can_modify_shift_data" href="" data-toggle="modal" data-target="#finishShift">Kết ca</a></li>
                            <?php /*<li><a href="" ng-click="toggleSoldOut()" >{{ (settings.hideSoldOut == 1)?'Hiện':'Ẩn'}} món tạm hết</a></li>*/ ?>
                        </ul>
                    </li>
                    <li class="for_anonymous">
                        <a data-toggle="modal" data-target="#loginFromFrontend" href=""><i class="fa fa-sign-in"></i> <span>Đăng nhập</span></a>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container-fluid" style="display: none;">
        <div class="row">
            <?php include("includes/selling_sidebar.inc.php");?>
            <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
                <?php foreach($order_types as $t):?>
                    <ul class="nav nav-pills" ng-class="{hidden:current_order_type.id!=<?=$t['id']?>}" >
                        <?php if ($t['id'] == 1):?>
                            <?php foreach($table_names as $table_key):?>
                                <li ng-class="{active:current_order.key=='<?=$table_key?>', has_order:orders[current_order_type.id]['<?=$table_key?>'].total}"><a href="" ng-click="switchTable('<?=$table_key?>')"><?=$table_key?></a></li>
                            <?php endforeach;?>
                        <?php else:?>
                            <li ng-repeat="order in orders[<?=$t['id']?>]" ng-class="{active:current_order.key==order.key}"><a href="" ng-click="switchOrder(order)">{{order.time}}</a></li>
                            <li><a style="padding: 10px 15px;" href="" ng-click="newOrder()"><i class="fa fa-plus"></i></a></li>
                        <?php endif; ?>
                    </ul>
                <?php endforeach;?>
                <div class="ie_warning" style="display: none;">Trình duyệt IE của bạn không tương thích với website, nếu có thể vui lòng nâng cấp trình duyệt hoặc chuyển sang trình duyệt khác. Xin cảm ơn.</div>
                <input type="text" class="form-control search-control hidden-sm hidden-md hidden-lg" auto ng-model="search" placeholder="Nhập từ khóa để chọn món nhanh" />
                <h3 class="sub-header" ng-hide="shipping.active">Đơn hàng</h3>
                <div class="table-responsive">
                    <table class="table table-striped" ng-show="current_order.totalQuantity">
                        <thead>
                        <tr>
                            <th>Tên món</th>
                            <th class="hidden-xs hidden-sm">Ghi chú</th>
                            <th class="hidden-xs hidden-sm">Tùy chọn</th>
                            <th style="min-width: 60px;">SL</th>
                            <th>Giá</th>
                            <th class="hidden-xs hidden-sm">Thành tiền</th>
                            <th style="width:80px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="orderItem in current_order.orderedItems">
                            <td class="hidden-xs hidden-sm">{{ orderItem.code }} - {{ orderItem.name }}</td>
                            <td class="hidden-xs hidden-sm"><input type="text" class="input-sm form-control" ng-model="orderItem.description" ng-blur="saveOrdersToLocal()"/></td>
                            <td class="hidden-md hidden-lg">
                                <div ng-bind-html="orderItem.name|efruit_break_line"></div>
                                <div>
                                    <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple" multiple="multiple">
                                        <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}">{{sub_product.name}} - {{sub_product.price}}k</option>
                                    </select>
                                </div>
                            </td>
                            <td class="hidden-xs hidden-sm">
                                <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple" multiple="multiple">
                                    <option ng-repeat="sub_product in orderItem.sub_products" ng-disabled="!canModifyOrder()" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected">{{sub_product.name}} - {{sub_product.price}}k</option>
                                </select>
                            </td>
                            <td><input type="text" class="input-sm form-control float" only-float name="quantity" min="0" maxlength="6" ng-model="orderItem.quantity" ng-readonly="!canModifyOrder()" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)" /></td>
                            <td><span ng-show="orderItem.promotion_price > 0 && current_order_type.id <= 3">KM </span>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span></td>
                            <td class="hidden-xs hidden-sm">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></td>
                            <td><a title="Không in nhãn" class="btn btn-sm hidden-xs hidden-sm btn-info" ng-class="{'btn-info':orderItem.label_print==1,'btn-danger':orderItem.label_print==0}" href="" ng-click="toggleLabelPrint(orderItem.key)"><i class="fa fa-ban"></i></a>&nbsp;<a title="In nhãn này" class="btn btn-sm btn-info hidden-xs hidden-sm" href="" ng-click="printLabelCustom(orderItem.unique_key)"><i class="fa fa-print"></i></a>&nbsp;<a title="Xóa" class="btn btn-sm btn-danger" href="" ng-show="canModifyOrder()" ng-click="removeItem(orderItem.key)"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="total">
                            <td class="hidden-xs hidden-sm"></td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td>Tổng</td>
                            <td>{{current_order.totalQuantity}}</td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td colspan="2">{{current_order.subtotal*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                        <tr class="total">
                            <td class="hidden-xs hidden-sm"></td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td>Chiết khấu</td>
                            <td><input class="form-control" type="text" style="width: 45px;display: inherit;padding: 6px;" maxlength="5" ng-model="current_order.discount_rate" ng-blur="validateDiscountRate()" ng-change="updateTotal(1)" ng-readonly="!canModifyOrder()" only-float />%</td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td colspan="2"><input class="form-control" type="text" style="width: 80px;display: inline;padding: 6px;" ng-model="current_order.discount_amount" ng-blur="validateDiscountAmount()" ng-change="updateTotal(0)" ng-readonly="!canModifyOrder()" only-float />đ</td>
                        </tr>
                        <tr class="total" ng-show="current_order_type.id!=STAY_TYPE">
                            <td class="hidden-xs hidden-sm"></td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td colspan="2">VAT&nbsp;
                                <div class="custom-radio-with-tick inline">
                                    <input type="radio" id="vat_10" ng-model="current_order.VAT" value="0.1" ng-click="updateTotal(0)">
                                    <label style="cursor: pointer;font-weight: normal;" for="vat_10">10%</label>
                                </div>&nbsp;
                                <div class="custom-radio-with-tick inline">
                                    <input type="radio" id="vat_5" ng-model="current_order.VAT" value="0.05" ng-click="updateTotal(0)">
                                    <label style="cursor: pointer;font-weight: normal;" for="vat_5">5%</label>
                                </div>
                                &nbsp;
                                <div class="custom-radio-with-tick inline">
                                    <input type="radio" id="vat_0" ng-model="current_order.VAT" value="0" ng-click="updateTotal(0)">
                                    <label style="cursor: pointer;font-weight: normal;" for="vat_0">0%</label>
                                </div>
                            </td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td colspan="2">{{is3rdPartyServices()?current_order.VAT*current_order.subtotal*1000:current_order.VAT*(current_order.subtotal-current_order.discount_amount)*1000|efruit_money}}đ</td>
                        </tr>
                        <tr class="total" ng-show="current_order_type.need_customer_details > 0">
                            <td class="hidden-xs hidden-sm"></td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td>Phí giao hàng <span ng-show="current_order_type.need_customer_details > 0" class="green-text">{{current_order.customer.distance + 'km'}}</span></td>
                            <td></td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td colspan="2"><span ng-hide="current_order_type.need_customer_details > 0 && current_order.customer.free_ship && current_order.shipping_fee > 0">{{current_order.shipping_fee*1000|efruit_money}}<sup>đ</sup></span><strike ng-show="current_order_type.need_customer_details > 0 && current_order.customer.free_ship && current_order.shipping_fee > 0">{{current_order.shipping_fee*1000|efruit_money}}<sup>đ</sup></strike></td>
                        </tr>
                        <tr class="total">
                            <td class="hidden-xs hidden-sm"></td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td>Tổng cộng</td>
                            <td></td>
                            <td class="hidden-xs hidden-sm"></td>
                            <td colspan="2" style="font-size: 120%;">{{current_order.total*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <h4 ng-hide="current_order.totalQuantity || shipping.active" >Vui lòng chọn món.</h4>
                <div class="big-buttons text-right" ng-show="current_order.totalQuantity && current_order_type.need_customer_details == 0" >
                    <a class="btn btn-default" ng-class="{'btn-success': current_order.payment_method=='cod'}" href="javascript:void(0);" ng-click="setPaymentMedthod('cod')">Tiền mặt</a>
                    <a class="btn btn-default" ng-class="{'btn-success': current_order.payment_method=='moca'}" href="javascript:void(0);" ng-click="setPaymentMedthod('moca')">Moca</a>
                    <a class="btn btn-default" ng-class="{'btn-success': current_order.payment_method=='zalopay'}" href="javascript:void(0);" ng-click="setPaymentMedthod('zalopay')">Zalo Pay</a>
                    <a class="btn btn-default" ng-class="{'btn-success': current_order.payment_method=='vnpay'}" href="javascript:void(0);" ng-click="setPaymentMedthod('vnpay')">VN Pay</a>
                    <a class="btn btn-default" ng-class="{'btn-success': current_order.payment_method=='shipnow'}" href="javascript:void(0);" ng-click="setPaymentMedthod('shipnow')">Shipnow</a>
                    <a class="btn btn-default" ng-class="{'btn-success': current_order.payment_method=='pay_later'}" href="javascript:void(0);" ng-click="setPaymentMedthod('pay_later')">Trả sau</a>
                    <a class="btn btn-default" ng-class="{'btn-success': current_order.payment_method=='bank'}" href="javascript:void(0);" ng-click="setPaymentMedthod('bank')" style="font-size: 12px;padding: 12px 10px;">Chuyển<br/>khoản</a>
                </div>
                <br/>
                <div class="col-md-6" style="padding: 0;">
                    <div ng-hide="shipping.active || !current_order.totalQuantity">
                        <?php if (count($branches) > 1): ?>
                            <select class="form-control" ng-model="current_order.branch_id" ng-show="current_order_type.id == 8">
                                <?php foreach($branches as $b):?>
                                    <option value="<?=$b['id']?>"><?=$b['branch_name']?></option>
                                <?php endforeach; ?>
                            </select>
                            <br/>
                        <?php endif; ?>
                        <div ng-show="current_order.totalQuantity && hasExchangePointProgram()" class="input-group mobile-container">
                            <h3 class="sub-header" style="margin-top:10px;">Khách hàng</h3>
                            <div class="customer-info" ng-show="current_order.customer.id">
                                <p><b>Tích lũy:</b> <span style="font-size: 120%;" class="total_point">0</span>đ | <span style="font-size: 120%;" class="number_of_order">0</span> <b>Gần nhất:</b> <span class="last_order_dtm">-</span> (<span style="font-size: 120%;" class="number_of_days">0</span> ngày)</p>
                                <p><b>Ghi chú:</b> <span class="last_note">-</span></p>
                            </div>
                            <div class="input-group mobile-container">
                                <input type="text" class="form-control" auto-customers only-number ng-model="current_order.customer.mobile" name="mobile" placeholder="Số điện thoại" maxlength="12" minlength="10" />
                                <span ng-show="current_order.customer.id != ''" class="input-group-addon clear-customer"><a id="clear_customer" ng-click="resetCurrentCustomer()" class="btn btn-danger" href="">Xóa</a></span>
                            </div>
                            <input type="text" style="margin-bottom: 10px !important;" class="form-control" auto-customers ng-model="current_order.customer.fullname" name="fullname" placeholder="Họ và tên" />
                            <div class="input-group ex_description-container">
                                <span class="input-group-addon">Ghi chú (nội bộ)</span>
                                <input class="form-control private-section" ng-model="current_order.customer.ex_description" placeholder="Ghi chú khách hàng (nội bộ)" />
                            </div>
                            <div class="input-group exchange_points-container">
                                <span class="input-group-addon">Điểm tích lũy</span>
                                <input type="text" class="form-control" ng-model="current_order.customer.exchange_points" name="exchange_points" disabled="disabled" placeholder="0" />
                                <span ng-show="current_order.customer.exchange_points >= 30 && current_order.point_converting == 0" class="input-group-addon convert-buttons"><a id="convert_points" ng-click="convertPoint()" class="btn btn-warning" href="">Đổi</a></span>
                                <span ng-show="current_order.point_converting > 0" class="input-group-addon convert-buttons"><a id="undo_convert_points" ng-click="undoConvertPoint()" class="btn btn-danger" href="">Hủy đổi</a></span>
                            </div>
                        </div>
                        <textarea style="margin-bottom: 10px;" ng-show="current_order.totalQuantity && !is3rdPartyServices()" class="form-control" ng-model="current_order.description" placeholder="Ghi chú đơn hàng"></textarea>
                        <div class="form_errors" ng-hide="validateShipping()">
                            <span ng-show="current_order_type.need_customer_details > 0 && current_order.customer.distance<=<?=MAX_DISTANCE?>">Tổng đơn hàng thấp nhất để giao hàng với khoảng cách {{current_order.customer.distance}}km là {{current_order.minTotal}}.000<sup>đ</sup>. Vui lòng đặt hàng thêm.</span>
                            <span ng-show="current_order_type.need_customer_details > 0 && current_order.customer.distance><?=MAX_DISTANCE?>">Ngoài vùng phục vụ. Vui lòng thương lượng phí ship.</span>
                        </div>
                        <form action="" method="post" id="frmOrder" name="frmOrder">
                            <div ng-show="current_order_type.need_customer_details == 1 && current_order.totalQuantity > 0">
                                <h3 class="sub-header" style="margin-top:10px;">Khách hàng</h3>
                                <div class="customer-info" ng-hide="shipping.active && current_order.customer.id">
                                    <p><b>Tổng:</b> <span style="font-size: 120%;" class="total_paid">0</span>đ | <span style="font-size: 120%;" class="number_of_order">0</span> <b>Gần nhất:</b> <span class="last_order_dtm">-</span> (<span style="font-size: 120%;" class="number_of_days">0</span> ngày)</p>
                                    <p><b>Ghi chú:</b> <span class="last_note">-</span></p>
                                </div>
                                <?php if (env('NEED_BOOKER_DETAILS')):?>
                                    <div class="input-group mobile-container">
                                        <input type="text" class="form-control" auto-customers only-number ng-model="current_order.customer.booker_mobile" name="booker_mobile" placeholder="SĐT người đặt *" maxlength="12" minlength="10" required="required" />
                                        <span ng-show="current_order.customer.free_ship && current_order_type.need_customer_details > 0" class="input-group-addon free-ship">Free ship</span>
                                        <span ng-show="current_order.customer.id != ''" class="input-group-addon clear-customer"><a id="clear_customer" ng-click="resetCurrentCustomer()" class="btn btn-danger" href="">Xóa</a></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" class="form-control" auto-customers ng-model="current_order.customer.booker_fullname" name="booker_fullname" placeholder="Họ tên người đặt *" required="required" /></div>
                                        <div class="col-md-6"><input type="email" class="form-control" ng-model="current_order.customer.email" name="email" placeholder="Email" /></div>
                                    </div>

                                    <input type="text" class="form-control" only-number ng-model="current_order.customer.mobile" name="mobile" placeholder="SĐT người nhận" maxlength="12" />
                                    <input type="text" style="margin-bottom: 10px !important;" class="form-control" auto-customers ng-model="current_order.customer.fullname" name="fullname" placeholder="Họ tên người nhận" />
                                <?php else: ?>
                                    <div class="input-group mobile-container">
                                        <input type="text" class="form-control" auto-customers only-number ng-model="current_order.customer.mobile" name="mobile" placeholder="Số điện thoại *" maxlength="12" minlength="10" required="required" />
                                        <span ng-show="current_order.customer.free_ship && current_order_type.need_customer_details > 0" class="input-group-addon free-ship">Free ship</span>
                                        <span ng-show="current_order.customer.id != ''" class="input-group-addon clear-customer"><a id="clear_customer" ng-click="resetCurrentCustomer()" class="btn btn-danger" href="">Xóa</a></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" class="form-control" auto-customers ng-model="current_order.customer.fullname" name="fullname" placeholder="Họ và tên *" required="required" /></div>
                                        <div class="col-md-6"><input type="email" class="form-control" ng-model="current_order.customer.email" name="email" placeholder="Email" /></div>
                                    </div>
                                <?php endif; ?>
                                <div class="input-group ex_description-container">
                                    <span class="input-group-addon">Ghi chú (nội bộ)</span>
                                    <input class="form-control private-section" ng-model="current_order.customer.ex_description" placeholder="Ghi chú khách hàng (nội bộ)" />
                                </div>
                                <div class="input-group address-container">
                                    <input type="text" class="form-control" auto-customers ng-model="current_order.customer.address" name="address" placeholder="Địa chỉ *" required="required" />
                                    <span ng-show="current_order_type.need_customer_details > 0" class="input-group-addon get-distance"><a id="get_distance" class="btn btn-warning" href="">Tìm</a></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><?=html_select_district('form-control', '-- Quận *', 'ng-model="current_order.customer.district" required="required"')?></div>
                                    <div class="col-md-8"><input type="text" class="form-control" ng-model="current_order.customer.building" name="building" placeholder="Tòa nhà" /></div>
                                </div>
                                <div ng-show="current_order.VAT > 0">
                                    <input type="text" class="form-control" ng-model="current_order.customer.company_tax_code" auto-companies name="company_tax_code" placeholder="Mã số thuế *" required="required" />
                                    <input type="text" class="form-control" ng-model="current_order.customer.company_name" name="company_name" placeholder="Tên công ty *" required="required" />
                                    <input type="text" class="form-control" ng-model="current_order.customer.company_address" name="company_address" placeholder="Địa chỉ công ty *" required="required" />
                                </div>
                            </div>
                            <div ng-show="current_order_type.need_customer_details == 1 && current_order.totalQuantity > 0">
                                <?php if (count($branches) > 1): ?>
                                    <select class="form-control" ng-model="current_order.branch_id" required="required" id="branch_id" name="branch_id">
                                        <?php foreach($branches as $b):?>
                                            <option value="<?=$b['id']?>"><?=$b['branch_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                                <textarea class="form-control" ng-model="current_order.customer.description" placeholder="Ghi chú khi giao hàng."></textarea>
                                <p ng-show="current_order.customer.distance<=0" style="color: red;font-size: 90%;font-style: italic;">Chưa tìm vị trí - khoảng cách bằng 0.</p>
                            </div>
                            <div ng-show="is3rdPartyServices() && current_order.totalQuantity > 0">
                                <h3 class="sub-header" style="margin-top:10px;">Khách hàng</h3>
                                <input type="text" class="form-control" ng-model="current_order.customer.fullname" name="fullname" placeholder="Họ và tên" />
                                <input type="text" class="form-control" ng-model="current_order.customer.address" name="address" placeholder="Địa chỉ" />
                                <div ng-show="isFoody()" class="custom-checkbox-with-tick">
                                    <input type="checkbox" id="is_prepaid" ng-model="current_order.is_prepaid" ng-click="saveOrdersToLocal()">
                                    <label style="cursor: pointer;font-weight: normal;" for="is_prepaid">&nbsp;&nbsp;Đã thanh toán Airpay</label>
                                </div><br/>
                                <textarea ng-show="current_order.totalQuantity" class="form-control" ng-model="current_order.description" placeholder="Ghi chú đơn hàng"></textarea><br />
                            </div>
                        </form>
                        <div class="buttons" ng-show="current_order_type.need_customer_details > 0">
                            <a id="print_label" ng-show="current_order.totalQuantity" class="btn btn-success" href="" ng-click="printLabel()"><i class="fa fa-print"></i> In nhãn</a>
                            <a id="print_receipt" ng-show="current_order.totalQuantity" class="btn btn-success" href="" ng-click="printReceipt()"><i class="fa fa-print"></i> Pha chế (F8)</a>
                            <a id="print_bill" ng-show="current_order.totalQuantity" ng-disabled="current_order.validForShipping == 0" class="btn btn-success" href="" ng-click="printBill()"><i class="fa fa-print"></i> Thanh toán (F9)</a>
                            <!--<a id="order_done" ng-show="current_order.totalQuantity && current_order.status==ACTIVE && current_order_type.id!=DELIVERY_TYPE" ng-disabled="current_order.validForShipping == 0" class="btn btn-warning" href="" ng-click="orderDone()"><i class="fa fa-check"></i> Gửi pha chế</a>-->
                            <a id="save_order" ng-show="current_order.totalQuantity && current_order.status==PRINTED" ng-disabled="current_order.validForShipping == 0" class="btn btn-info" href="" ng-click="saveOrder()"><i class="fa fa-save"></i> Lưu (F4)</a>
                            <a id="delete_order" ng-show="current_order.created_dtm > 0 && current_order.status==ACTIVE && canModifyOrder()" class="btn btn-danger" href="" ng-click="deleteOrder()"><i class="fa fa-trash-o"></i> Hủy (F3)</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div ng-show="current_order_type.id != STAY_TYPE && current_order.totalQuantity > 0" class="col-md-6">
                            <div class="input-group shipping_in-container">
                                <span class="input-group-addon ng-binding">Th.gian lấy</span>
                                <input type="text" size="16" id="pickuptimePicker" ng-model="current_order.pickup_time" name="pickup_time" class="form-control" data-maxDate="<?=strtotime('+1 year', strtotime(date('Y-m-d')))?>" data-minDate="<?=strtotime(date('Y-m-d'))?>" data-defaultDate="<?=time()?>"/>
                            </div>
                        </div>
                        <div ng-show="current_order_type.id != STAY_TYPE && current_order.totalQuantity > 0" class="col-md-6">
                            <div class="input-group shipping_in-container">
                                <span class="input-group-addon ng-binding">Th.gian giao</span>
                                <input type="text" size="16" id="deliverydatePicker" ng-model="current_order.delivery_date" name="delivery_date" class="form-control" data-maxDate="<?=strtotime('+1 year', strtotime(date('Y-m-d')))?>" data-minDate="<?=strtotime(date('Y-m-d'))?>" data-defaultDate="<?=strtotime('+30 minutes')?>"/>
                            </div>
                        </div>
                        <div ng-show="current_order_type.id != STAY_TYPE && current_order.totalQuantity > 0" class="col-md-6">
                            <?php echo html_select_array(get_payment_methods_options(), 'ng-model="current_order.payment_method" class="form-control" style="margin-bottom: 10px;"')?>
                        </div>
                        <div ng-show="current_order.totalQuantity" class="col-md-6">
                            <input type="text" class="form-control" ng-show="current_order.payment_method == 'cod' && current_order_type.need_customer_details > 0" ng-model="current_order.customer.payment" name="payment" placeholder="Mệnh giá tiền" />
                            <div class="input-group shipping_in-container" ng-show="current_order.payment_method == 'pay_later'">
                                <span class="input-group-addon ng-binding">Th.gian TT</span>
                                <input type="text" size="16" id="paymentdatePicker" ng-model="current_order.payment_date" name="payment_date" class="form-control" data-maxDate="<?=strtotime('+1 year', strtotime(date('Y-m-d')))?>" data-minDate="<?=strtotime(date('Y-m-d'))?>" data-defaultDate="<?=time()?>"/>
                            </div>
                            <div class="input-group ex_description-container" ng-show="current_order.payment_method == 'other'">
                                <span class="input-group-addon ng-binding">Chi tiết</span>
                                <input class="form-control private-section" ng-model="current_order.payment_description" placeholder="Ghi chú thanh toán" />
                            </div>
                        </div>
                    </div>
                    <div ng-show="current_order_type.need_customer_details == 0 && current_order.totalQuantity">
                        <div class="big-buttons square-buttons" ng-show="current_order.totalQuantity">
                            <a id="print_bill" ng-disabled="current_order.validForShipping == 0" class="btn btn-success" href="" ng-click="printBill()"><i class="fa fa-print"></i> Thanh toán (F9)</a>
                            <a id="print_receipt" class="btn btn-success" href="" ng-click="printReceipt()"><i class="fa fa-print"></i> Pha chế (F8)</a>
                            <a id="print_label" class="btn btn-success" href="" ng-click="printLabel()"><i class="fa fa-print"></i> In nhãn</a>
                            <a id="save_order" ng-show="current_order.status==PRINTED" ng-disabled="current_order.validForShipping == 0" class="btn btn-info" href="" ng-click="saveOrder()"><i class="fa fa-save"></i> Lưu (F4)</a>
                            <a id="delete_order" ng-show="current_order.created_dtm > 0 && current_order.status==ACTIVE && canModifyOrder()" class="btn btn-danger" href="" ng-click="deleteOrder()"><i class="fa fa-trash-o"></i> Hủy (F3)</a>
                            <div ng-show="current_order_type.id == STAY_TYPE && current_order.totalQuantity && current_order.status==ACTIVE" class="btn-group">
                                <button style="padding: 10px;width: 100%;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Đổi bàn sang <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach($table_names as $table_key):?>
                                        <li><a ng-hide="current_order.key=='<?=$table_key?>'" ng-click="swapTo('<?=$table_key?>')" href=""><?=$table_key?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="distance_calculator" ng-class="{visible:(current_order_type.need_customer_details > 0 && current_order.totalQuantity > 0) || shipping.active}">
                        <p class="header" ng-hide="shipping.active">
                        <div class="input-group distance-container" ng-class="{visible:current_order_type.need_customer_details > 0 && current_order.totalQuantity > 0}">
                            <span class="input-group-addon">Khoảng cách</span>
                            <input class="form-control" type="text" j-change ng-model="current_order.customer.distance" id="distance" value="" placeholder="Khoảng cách"/>
                            <span ng-show="current_order.customer.lat" class="view_map input-group-addon" ng-class="{valid:current_order.customer.is_locked}"><a target="_blank" id="view_map" href="http://maps.google.com/maps?f=d&saddr=10.773170,106.671384&daddr={{current_order.customer.lat}},{{current_order.customer.lng}}">Xem trên Google</a></span>
                        </div>
                        </p>
                        <div id="customControl" style="padding: 5px;background: #fff;opacity: 1;font-size: 12px; z-index: 10;" ng-hide="shipping.active">
                            <span><span>{{__('Khoảng cách')}}</span>: <b class="green-text">{{current_order.customer.distance}}km</b></span>
                            <span ng-show="current_order.validForShipping" style="margin-left:15px;"><span>{{__('Phí giao hàng')}}</span>:<b class="green-text">{{current_order.shipping_fee*1000|efruit_money}}<sup>đ</sup></b></span>
                            <span ng-show="current_order.freeShipFrom > 0 && current_order.customer.distance<=<?=MAX_DISTANCE?>" style="margin-left:15px;"><span>{{__('Giao miễn phí từ')}}</span>:<b class="green-text">{{current_order.freeShipFrom*1000|efruit_money}}<sup>đ</sup></b></span>
                        </div>
                        <div id="map_canvas" style="height: 350px;"></div><br />
                        <span class="on-map-address"></span>
                    </div>
                </div>
                <div ng-show="current_order_type.need_customer_details == 0 && !current_order.totalQuantity">
                    <a ng-show="current_order.created_dtm > 0 && current_order.status==ACTIVE && canModifyOrder()" class="btn btn-danger" href="" ng-click="deleteOrder()"><i class="fa fa-trash-o"></i> Hủy (F3)</a>
                </div>
                <div class="clear"></div>
                <input type="text" style="width: 0px; visibility: hidden;" ng-model="current_order.customer.lat" id="customer_lat" value="" />
                <input type="text" style="width: 0px; visibility: hidden;" ng-model="current_order.customer.lng" id="customer_lng" value="" />
            </div>
        </div>
    </div>
</div>
<div class="printing">
    <div class="container-fluid w80mm hidden_when_printing_receipt hidden_when_printing_label" style="display: none;">
        <div class="row">
            <div class="col-sm-12 col-md-12 main">
                <img style="float: left;width: 22%;" src="<?=get_child_theme_assets_url()?>img/small-logo.png" />
                <div style="float: left;width: 78%" class="header">
                    <h2 class="bold"><?=get_setting('site_name')?></h2>
                    <p class="smallsize"><?=getvalue($main_branch, 'short_address')?></p>
                    <p class="smallsize"><?=getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15')?></p>
                    <p class="smallsize"><?=str_replace('https://', '', get_setting('facebook_link'))?></p>
                    <p class="smallsize">www.<?=DOMAIN_NAME?></p>
                </div>
                <div class="clear"></div>
                <p>&nbsp;</p>
                <div class="header">
                    <h1 class="bold">PHIẾU THANH TOÁN<br/><span ng-show="current_order_type.id == FOODY_TYPE">Foody&nbsp;</span>{{current_order.code}}</h1>
                </div>
                <div>
                    <p class="smallsize acenter"><span class="bold">Thời gian lấy:</span> {{current_order.pickup_time}}</p>
                    <p class="smallsize acenter"><span class="bold">Thời gian giao:</span> {{current_order.delivery_date}}</p>
                    <table class="table order_items table-striped">
                        <thead>
                        <tr>
                            <th>Tên món</th>
                            <th>T.Tiền</th>
                        </tr>
                        </thead>
                        <tbody ng-repeat="orderItem in current_order.orderedItems">
                        <tr>
                            <td colspan="2">
	                            {{orderItem.code}} - {{orderItem.name}}
                                <div class="sub_product" ng-show="orderItem.total_selected_sub">
                                    <p style="margin-bottom: 0;"><span ng-repeat="sp in orderItem.selected_sub_products">{{sp.name}}{{$last ? '' : ', '}}</span></p>
                                </div>
                                <div class="order_item_description" ng-show="orderItem.description">
                                    <p style="margin-bottom: 0;">-- {{orderItem.description}}</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{orderItem.quantity}} x {{orderItem.final_price*1000|efruit_money}}<span ng-show="orderItem.promotion_price >0"> KM</span></td>
                            <td class="aright">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}</td>
                        </tr>
                        </tbody>
                        <tbody>
                        <tr class="total">
                            <td>Tổng số lượng: {{current_order.totalQuantity}}</td>
                            <td></td>
                        </tr>
                        <tr class="total" ng-show="current_order.discount_amount > 0">
                            <td>Chiết khấu <span>{{current_order.discount_rate}}%</span></td>
                            <td class="aright">-{{current_order.discount_amount}}</td>
                        </tr>
                        <tr class="total" ng-show="current_order.shipping_fee">
                            <td>Phí giao hàng <span ng-show="current_order_type.need_customer_details > 0">{{current_order.customer.distance + 'km'}}</span></td>
                            <td class="aright">{{current_order.shipping_fee}}.000</td>
                        </tr>
                        <tr class="total" ng-show="current_order.VAT > 0">
                            <td>VAT <span>{{current_order.VAT*100}}%</span></td>
                            <td class="aright">{{is3rdPartyServices()?current_order.VAT*current_order.subtotal*1000:current_order.VAT*(current_order.subtotal-current_order.discount_amount)*1000|efruit_money}}</td>
                        </tr>
                        <tr class="total">
                            <td class="aright largesize">Thành tiền:&nbsp;</td>
                            <td class="aright largesize">{{current_order.total*1000|efruit_money}}</td>
                        </tr>
                        <tr class="total">
                            <td class="aright largesize" colspan="2">
                                <span ng-show="isPrePaid()">Đã thanh toán.</span>
                                <span ng-show="current_order.payment_method == 'pay_later'">Thanh toán sau.</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clear"></div>

                    <div ng-show="current_order.description">
                        <h2 class="bold">Ghi chú đơn hàng</h2>
                        <p ng-bind-html="current_order.description|break_line"></p>
                        <br />
                    </div>
                    <div class="clear"></div>
                    <div ng-show="current_order.customer.booker_mobile && current_order.customer.booker_mobile != current_order.customer.mobile">
                        <table class="customer col-md-6">
                            <tbody>
                            <tr>
                                <td><span class="bold">Người đặt:</span> {{current_order.customer.booker_fullname}} - {{current_order.customer.booker_mobile}}</td>
                            </tr>
                            <tr ng-show="current_order.customer.message_to_receiver">
                                <td colspan="2"><span class="bold">Thông điệp:</span> {{current_order.customer.message_to_receiver}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div ng-show="current_order.customer.mobile || current_order.customer.address">
                        <table class="customer col-md-6">
                            <tbody>
                            <tr ng-show="current_order.customer.fullname">
                                <td><span class="bold">Người nhận:</span> {{current_order.customer.fullname}}</td>
                            </tr>
                            <tr ng-show="current_order.customer.mobile">
                                <td><span class="bold">SĐT:</span> {{current_order.customer.mobile}}</td>
                            </tr>
                            <tr ng-show="current_order.customer.address">
                                <td>
	                                <span class="bold">Địa chỉ:</span> {{current_order.customer.address}}<span ng-show="current_order.customer.ward">, phường {{current_order.customer.ward}}</span>, quận {{current_order.customer.district}}
                                    <span ng-show="current_order.customer.building"><br/>Tòa nhà: {{current_order.customer.building}}</span>
                                </td>
                            </tr>
                            <tr ng-show="current_order.customer.description">
                                <td><span class="bold">Ghi chú:</span> <p style="display: inline;"  ng-bind-html="current_order.customer.description|break_line"></p></td>
                            </tr>
                            <tr ng-show="current_order.customer.payment">
                                <td><span class="bold">Mệnh giá tiền:</span> {{current_order.customer.payment}}</td>
                            </tr>
                            <tr ng-show="hasExchangePointProgram()">
                                <td><span class="bold">Điểm tích lũy:</span> {{current_order.customer.new_exchange_points}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
	                <div class="clear"></div>
	                <div ng-show="current_order.VAT > 0">
		                <table class="customer col-md-6">
			                <tbody>
			                <tr>
				                <td><span class="bold">Tên công ty:</span> {{current_order.customer.company_name}}</td>
			                </tr>
			                <tr>
				                <td><span class="bold">MST</span> {{current_order.customer.company_tax_code}}</td>
			                </tr>
			                <tr>
				                <td><span class="bold">Địa chỉ công ty:</span> {{current_order.customer.company_address}}</td>
			                </tr>
			                </tbody>
		                </table>
	                </div>
                    <br />
                    <p class="acenter">------------------------</p>
                    <h2 class="acenter">Cám ơn quý khách!<br/>Hẹn gặp lại :)</h2>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid w80mm print-receipt hidden_when_printing_bill hidden_when_printing_label" style="display: none;">
        <div class="row">
            <div class="col-sm-12 col-md-12 main">
                <div class="header">
                    <h1 class="bold" style="font-size: 34px;">{{ current_order.seq_no }}</h1>
                    <h1 class="bold">PHA CHẾ <span ng-show="current_order_type.id == FOODY_TYPE">Foody&nbsp;</span><br/>{{current_order.code}}</h1>
                </div>
                <div>
                    <p class="smallsize acenter">Giờ lấy hàng: <span>{{current_order.pickup_time}}</span></p>
                    <p class="smallsize acenter">Giờ in: <span id="receipt_printing_datetime"></span></p>
                    <div class="clear"></div>
                    <div ng-show="current_order.description">
                        <br />
                        <h2 style="padding: 0;margin: 0;" class="bold">Ghi chú pha chế</h2>
                        <p style="font-size: 125%;" ng-bind-html="current_order.description|break_line"></p>
	                </div>
                    <div ng-show="current_order.customer.ex_description">
                        <br />
                        <p style="font-size: 125%;" ng-bind-html="current_order.customer.ex_description|break_line"></p>
                    </div>
                    <table class="table order_items table-striped">
                        <thead>
                        <tr>
                            <th>Tên món</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="orderItem in current_order.orderedItems" ng-class="{page_break:$index==15}">
                            <td>
	                            {{orderItem.code}} - {{orderItem.name}}
                                <div class="sub_product" ng-show="orderItem.total_selected_sub">
                                    <p style="margin-bottom: 0;"><span ng-repeat="sp in orderItem.selected_sub_products">{{sp.name}}{{$last ? '' : ', '}}</span></p>
                                </div>
                                <div class="sub_product" ng-show="orderItem.components">
                                    <p style="margin-bottom: 0;"><span ng-repeat="comp in orderItem.components">{{comp.name}}{{$last ? '' : ', '}}</span></p>
                                </div>
                                <div class="order_item_description" ng-show="orderItem.description">
                                    <p style="margin-bottom: 0;">-- {{orderItem.description}}</p>
                                </div>
                                <br ng-show="!orderItem.total_selected_sub && !orderItem.description"/>
                                <div class="aright" style="padding-right: 10px;">x{{orderItem.quantity}}</div>
                            </td>
                        </tr>
                        <tr class="total ">
                            <td>Tổng SL: {{current_order.totalQuantity}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clear"></div>
                    <div class="clear"></div>
                    <div ng-show="current_order.customer.booker_mobile && current_order.customer.booker_mobile != current_order.customer.mobile">
                        <table class="customer col-md-6">
                            <tbody>
                            <tr>
                                <td><span class="bold">Người đặt:</span> {{current_order.customer.booker_fullname}} - {{current_order.customer.booker_mobile}}</td>
                            </tr>
                            <tr ng-show="current_order.customer.message_to_receiver">
                                <td colspan="2"><span class="bold">Thông điệp:</span> {{current_order.customer.message_to_receiver}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div ng-show="current_order.customer.mobile || current_order.customer.address">
                        <table class="customer col-md-6">
                            <tbody>
                            <tr ng-show="current_order.customer.fullname">
                                <td><span class="bold">Người nhận:</span> {{current_order.customer.fullname}}</td>
                            </tr>
                            <tr ng-show="current_order.customer.mobile">
                                <td><span class="bold">SĐT:</span> {{current_order.customer.mobile}}</td>
                            </tr>
                            <td colspan="4" ng-show="current_order.customer.address">
	                            <span class="bold">Địa chỉ:</span> {{current_order.customer.address}}<span ng-show="current_order.customer.ward">, phường {{current_order.customer.ward}}</span>, quận {{current_order.customer.district}}
	                            <span ng-show="current_order.customer.building"><br/>Tòa nhà: {{current_order.customer.building}}</span>
                            </td>
                            <tr ng-show="current_order.customer.description">
                                <td colspan="4"><span class="bold">Ghi chú:</span> <p style="display: inline;"  ng-bind-html="current_order.customer.description|break_line"></p></td>
                            </tr>
                            <tr ng-show="current_order.customer.payment || current_order.payment_description">
                                <td><span class="bold">Thanh toán:</span><span ng-show="current_order.customer.payment"> mệnh giá {{current_order.customer.payment}}</span><span ng-show="current_order.payment_description"> {{current_order.payment_description}}</span></td>
                            </tr>
                            <tr>
                                <td><span class="bold">Thời gian giao:</span> {{current_order.delivery_date}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div ng-show="isPrePaid()">
                        <h2 class="bold">Đã thanh toán.</h2>
                    </div>
                    <div ng-show="current_order.payment_method == 'pay_later'">
                        <h2 class="bold">Thanh toán sau.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div ng-if="printing_label==1" class="container-fluid hidden_when_printing_receipt hidden_when_printing_bill" style="display: none;">
		<div class="row">
			<div class="col-sm-12 col-md-12 main">
				<div ng-repeat="orderItem in current_order.orderedItems" ng-if="orderItem.label_print==1">
					<div ng-repeat="n in [] | range:orderItem.quantity" class="label-item {{orderItem.unique_key}}" style="width: 50mm; height: 30mm; word-wrap: break-word; font-size:12px;overflow: hidden;">
                        <span style="font-size: 13px;font-weight: bold;"><span ng-show="current_order.seq_no">[{{current_order.seq_no}}]&nbsp;</span>{{orderItem.code + ' - ' + orderItem.name | cut:true:100:'..'}}</span>
						<div class="sub_product" ng-show="orderItem.total_selected_sub">
							<p style="margin-bottom: 0; font-size: 11px;"><span ng-repeat="sp in orderItem.selected_sub_products">{{sp.name}}{{$last ? '' : ', '}}</span></p>
						</div>
						<div class="order_item_description" ng-show="orderItem.description">
							<p style="margin-bottom: 0; font-size: 11px;">-- {{orderItem.description}}</p>
						</div>
						<br/>
						<div style="font-size: 10px;">
							<div style="text-align: center;font-size: 9px;">-----<?=DOMAIN_NAME?>-----</div>
							<div class="order_item_description"><span stype="float: left;" ng-show="current_order.order_id">{{current_order.code?current_order.code:current_order.order_id}}</span><span style="float: right;">{{$index+1}}/{{orderItem.quantity | formatQuanity}}</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("includes/modals.inc.php");?>
<?php include("includes/loading_elements.inc.php");?>
<input type="hidden" id="referer" value="<?php echo isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:''?>"/>
<script>
    var $pem = '<?=KEY_PUBLIC?>';
    var max_distance = <?=MAX_DISTANCE?>;
    $(document).ready(function(){
        $('#change_captcha').click(function(e){
            e.preventDefault();
            $('#captcha').attr('src', '<?=ROOT_URL?>get-captcha?' + Math.random());
            $('#captcha').focus();
        });

        $.key('f3', function() {
            $('#delete_order').click();
        });
        $.key('f4', function() {
            $('#save_order').click();
        });
        $.key('f8', function() {
            $('#print_receipt').click();
        });
        $.key('f9', function() {
            $('#print_bill').click();
        });
        //var referer = $('#referer').val();
        //pushEvent('Đến từ', referer.length?referer:'Không xác định', navigator.userAgent);
    });
</script>
<?php include("includes/footer.php");?>
