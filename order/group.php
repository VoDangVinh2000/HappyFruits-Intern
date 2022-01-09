<?php
    include("includes/order.inc.php");

    $code = get('g_code');
    $active_group = eModel::_select_one('g_booking', array('g_code' => $code));
    $error_msg = $g_item_code = '';
    if (!$active_group)
        $error_msg = 'Mã nhóm không chính xác.';

    $title = "Đặt hàng nhóm ". ($error_msg?'':$code);
    $main_js = 'group';
    $extra_js = "var g_code = '".$code."'; var order_code = '".$active_group['order_code']."';";
    include("includes/header.inc.php");
?>
  <body>
    <input type="hidden" value="<?=md5($code)?>" id="g_code" />
    <div class="container-fluid" ng-show="step==0" style="display: none;">
      <div class="row">
        <div class="col-sm-12 col-md-12 main">
            <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Đặt hàng nhóm - <?=$code?></h1>
            <p>Thông tin đặt hàng nhóm của bạn.
            <div class="table-responsive" style="padding: 0;">
                <table class="table table-striped" ng-show="subtotal">
                  <thead>
                    <tr>
                      <th>Tên món</th>
                      <th class="hidden-xs hidden-sm">Ghi chú</th>
                      <th>SL</th>
                      <th>Giá</th>
                      <th class="hidden-xs">Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="orderItem in orderedItems">
                      <td>
                        <div ng-bind-html="orderItem.name|efruit_break_line"></div>
                        <div class="sub_product" ng-show="orderItem.total_selected_sub">
                            <p style="margin-bottom: 0;">Thêm <span ng-repeat="sp in orderItem.selected_sub_products">{{sp.name|sub_product_name}}{{$last ? '' : ', '}}</span></p>
                        </div>
                      </td>
                      <td class="hidden-xs hidden-sm">{{orderItem.description}}</td>
                      <td>{{orderItem.quantity}}</td>
                      <td>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span></td>
                      <td class="hidden-xs">{{ orderItem.final_price*orderItem.quantity|efruit_money }}.000<sup>đ</sup></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="total">
                      <td>Tổng</td>
                      <td class="hidden-xs"></td>
                      <td>{{totalQuantity}}</td>
                      <td class="hidden-xs"></td>
                      <td>{{subtotal|efruit_money}}.000<sup>đ</sup></td>
                    </tr>
                    <tr class="total">
                      <td>Chiết khấu</td>
                      <td class="hidden-xs"></td>
                      <td></td>
                      <td class="hidden-xs"></td>
                      <td><span ng-show="discount_amount">-{{discount_amount*1000|efruit_money}}</span><span ng-show="discount_amount==0">0</span><sup>đ</sup></td>
                    </tr>
                    <tr class="total">
                      <td>Tổng cộng</td>
                      <td class="hidden-xs"></td>
                      <td></td>
                      <td class="hidden-xs"></td>
                      <td colspan="2">{{(total-shipping_fee)*1000|efruit_money}}<sup>đ</sup></td>
                    </tr>
                  </tfoot>
                </table>
                <h3 ng-hide="subtotal">Chưa có thành viên nào đặt hàng.</h3>
            </div>
            <div class="clear"></div>
            <br/>Bạn có thể sửa lại thông tin đặt hàng của bạn tại <a href="<?=ROOT_URL?>dat-hang-nhom/<?=$code?>" target="_blank">đây</a>.
            <br />Chỉ có nhóm trưởng được phép gửi toàn bộ đơn hàng.
        </div>
      </div>
    </div>
    <div class="container-fluid" <?=$error_msg?'':'style="display: none;"'?> ng-show="step==1">
      <div class="row">
        <?php if($error_msg):?>
        <div class="col-sm-12 col-md-12 main">
            <h1 class="page-header"><a href="<?=ROOT_URL_WITHOUT_SLASH?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Đặt hàng nhóm - <?=$code?></h1>
            <h4 class="sub-header"><?=$error_msg?></h4>
        </div>
        <?php
            else:
                include("includes/sidebar.inc.php");
        ?>
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
          <a class="shipping" href="" data-toggle="modal" data-target="#myModal">Chi tiết giao hàng</a>
          <div class="hidden-sm hidden-md hidden-lg"><br /></div>
          <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Đặt hàng nhóm - <?=$code?></h1>
          <div class="ie_warning" style="display: none;">Trình duyệt IE của bạn không tương thích với website, nếu có thể vui lòng nâng cấp trình duyệt hoặc chuyển sang trình duyệt khác. Xin cảm ơn.</div>
          <input type="text" class="form-control search-control" auto ng-model="search" placeholder="Nhập từ khóa để chọn món nhanh" />
          <br />
          <div class="table-responsive">
            <table class="table table-striped" ng-show="subtotal">
              <thead>
                <tr>
                  <th>Tên món</th>
                  <th class="hidden-xs hidden-sm">Ghi chú</th>
                  <th class="hidden-xs hidden-sm">Thêm</th>
                  <th style="min-width: 50px;">SL</th>
                  <th>Giá</th>
                  <th class="hidden-xs hidden-sm">Thành tiền</th>
                  <th style="width:50px;"></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="orderItem in orderedItems">
                  <td class="hidden-xs hidden-sm">{{ orderItem.name }}</td>
                  <td class="hidden-xs hidden-sm"><input type="text" class="input-sm form-control" ng-model="orderItem.description" value="{{orderItem.description}}"/></td>
                  <td class="hidden-md hidden-lg">
                    <div ng-bind-html="orderItem.name|efruit_break_line"></div>
                    <div>
                        <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple" multiple="multiple">
                            <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected">{{sub_product.name|sub_product_name}} - {{sub_product.price}}k</option>
                        </select>
                    </div>
                  </td>
                  <td class="hidden-xs hidden-sm">
                    <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple" multiple="multiple">
                        <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected" >{{sub_product.name|sub_product_name}} - {{sub_product.price}}k</option>
                    </select>
                  </td>
                  <td><input type="text" class="input-sm form-control number" only-number name="quantity" min="0" maxlength="3" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)" /></td>
                  <td>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span></td>
                  <td class="hidden-xs hidden-sm">{{ orderItem.final_price*orderItem.quantity|efruit_money }}.000<sup>đ</sup></td>
                  <td><a class="btn btn-sm btn-danger" href="" ng-click="removeItem(orderItem.key)"><i class="fa fa-trash-o"></i><span class="hidden-xs hidden-sm"> Xóa</span></a></td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>Tổng</td>
                  <td>{{totalQuantity}}</td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2">{{subtotal|efruit_money}}.000<sup>đ</sup></td>
                </tr>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>Chiết khấu<span ng-show="discount_amount"> ({{discount*100}}%)</span>&nbsp;<span style="font-size: 14px;color: #6cc357;" data-placement="right" class="hidden-xs glyphicon glyphicon-info-sign" data-original-title="{{discount_description}}"></span></td>
                  <td></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2"><span ng-show="discount_amount">-{{discount_amount*1000|efruit_money}}</span><span ng-show="discount_amount==0">0</span><sup>đ</sup></td>
                </tr>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>Tổng cộng</td>
                  <td></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2">{{(total-shipping_fee)*1000|efruit_money}}<sup>đ</sup></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <h4 ng-hide="total">Vui lòng chọn món.</h4>
          <textarea ng-show="total" class="form-control" ng-model="description" placeholder="Ghi chú"></textarea><br />
          <a ng-show="total" class="btn btn-success" href="" ng-click="nextStep()"><i class="fa fa-check"></i> Đặt hàng</a>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if(!$error_msg):?>
    <div class="container-fluid" ng-show="step==2" style="display: none;">
      <div class="row">
        <div class="col-sm-4 col-md-3 sidebar" style="padding: 10px 5px 10px 10px;">
            <h4 class="bold">Đơn hàng</h4>
            <?php include("includes/order_summary.inc.php");?>
        </div>
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
            <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Thông tin giao hàng</h1>
            <div class="hidden-sm hidden-md hidden-lg">
                <table class="order_summary">
                    <tbody>
                        <tr>
                            <td>Số lượng: </td>
                            <td style="text-align: right;">{{totalQuantity}}</td>
                        </tr>
                        <tr>
                            <td>Tổng: </td>
                            <td style="text-align: right;">{{subtotal|efruit_money}}.000<sup>đ</sup></td>
                        </tr>
                        <tr ng-show="discount_amount">
                            <td>Chiết khấu: </td>
                            <td style="text-align: right;">-{{discount_amount*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                        <tr ng-show="validForShipping">
                            <td>Phí giao hàng: </td>
                            <td style="text-align: right;">{{shipping_fee|efruit_money}}<span ng-show="shipping_fee">.000</span><sup>đ</sup></td>
                        </tr>
                        <tr ng-show="validForShipping || discount_amount">
                            <td class="bold">Thành tiền: </td>
                            <td style="text-align: right;font-size: 120%">{{total*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                    </tbody>
                </table>
                <br />
            </div>
            <div class="form_errors col-md-6" ng-hide="validateShipping()">
                <span>Tổng đơn hàng thấp nhất có thể phục vụ ở quận {{customer.district}} là {{shipping_details.min}}.000 <sup>đ</sup>. Vui lòng đặt hàng thêm.</span>
            </div>
            <div class="clear"></div>
            <form action="" method="post" id="frmOrder" name="frmOrder" class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon">{{__('Họ tên')}} *</span>
                    <input type="text" class="form-control" ng-model="customer.fullname" name="fullname" required="required" />
                </div>
                <div class="input-group">
                    <span class="input-group-addon">{{__('SĐT')}} *</span>
                    <input type="text" class="form-control" only-number ng-model="customer.mobile" ng-change="checkShippingFee()" name="mobile" maxlength="12" minlength="10" required="required" />
                    <span ng-show="customer.free_ship" class="input-group-addon free-ship">Free ship</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">{{__('Email')}} *</span>
                    <input type="email" class="form-control email" ng-model="customer.email" name="email" required="required" />
                </div>
                <div class="input-group">
                    <span class="input-group-addon">{{__('Quận')}} *</span>
                    <?=html_select_district('form-control', "-- {{__('Chọn')}}", 'ng-model="customer.district" required="required"', 1)?>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">{{__('Địa chỉ')}} *</span>
                    <input type="text" id="customer_address" class="form-control" ng-model="customer.address" name="address" required="required" />
                    <span class="input-group-addon get-distance"><a id="get_distance" class="btn btn-warning" href="">{{__('Tìm')}}</a></span>
                </div>
                <textarea class="form-control" ng-model="customer.description" placeholder="{{__('Ghi chú khi giao hàng')}}."></textarea>
                <input type="checkbox" id="remember_info" ng-checked="customer.is_remember" ng-click="save_customer_info()"/>&nbsp;<label style="font-weight: normal;color: #555;margin-bottom: 10px;" for="remember_info">{{__('Ghi nhớ thông tin')}}</label>&nbsp;<span style="color: #555;" class="hidden-xs glyphicon glyphicon-info-sign" data-placement="top" title="{{__('Thông tin giao hàng sẽ được lưu lại trên trình duyệt, bạn không phải nhập lại vào lần đặt hàng sau.')}}"></span>
                <div class="clear"></div>
                <img id="captcha"/>
                <a id="change_captcha" tabindex="-1" href="#">{{__('Đổi mã bảo vệ.')}}</a><br />
                <input type="text" id="captcha_input" class="form-control" name="<?=CAPTCHA_NAME;?>" ng-model="captcha" placeholder="{{__('Mã bảo vệ')}} *" maxlength="4" required="required" />
                <input type="text" style="width: 0px; visibility: hidden;" ng-model="customer.lat" id="customer_lat" value="" />
                <input type="text" style="width: 0px; visibility: hidden;" ng-model="customer.lng" id="customer_lng" value="" />
                <input type="text" style="width: 0px; visibility: hidden;" j-change ng-model="customer.distance" id="distance" value="0" />
            </form>
            <div class="col-lg-6 col-md-6" id="distance_calculator">
                <div id="customControl" style="padding: 5px;background: #fff;opacity: 0.9;font-size: 12px; position: absolute; top: 0; right: 11px;z-index: 10;">
                    <span><span>{{__('Khoảng cách')}}</span>: <b class="green-text">{{customer.distance}}km</b></span>
                    <span ng-show="validForShipping" style="margin-left:15px;"><span>{{__('Phí giao hàng')}}</span>:<b class="green-text">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></b></span>
                    <span ng-show="freeShipFrom > 0 && customer.distance<=11" style="margin-left:15px;"><span>{{__('Giao miễn phí từ')}}</span>:<b class="green-text">{{freeShipFrom*1000|efruit_money}}<sup>đ</sup></b></span>
                </div>
                <div id="map_canvas" style="height: 400px;"></div><br />
                <p class="header">{{__('Kéo dấu đỏ để chọn lại vị trí của bạn')}}</p>
            </div>
            <div class="clear"></div>
            <div class="col-md-6" style="padding-left: 0;">
                <a class="btn btn-info" href="" ng-click="previousStep()"><i class="fa fa-angle-left"></i> {{__('Quay lại')}}</a>
                <a class="btn btn-success" ng-disabled="frmOrder.$invalid || minTotalError || customer.distance <= 0" href="" ng-click="nextStep()"><i class="fa fa-check"></i> {{__('Đặt hàng')}}</a>
            </div>
            <div class="clear"></div><br />
            <p>* {{__('Quý khách vui lòng nhập đủ thông tin và vị trí giao hàng chính xác, xin cảm ơn.')}}</p>
            <div ng-if="step == 2">
                <script type="text/javascript">
                    if (typeof initObj == 'function')
                    {
                        initializeGmap();
                        if (document.getElementById('customer_lat').value)
                            calcRoute(default_point, new google.maps.LatLng(document.getElementById('customer_lat').value, document.getElementById('customer_lng').value));
                        else if(document.getElementById('customer_address').value)
                            GetDistance();
                    }
                </script>
            </div>
        </div>
      </div>
    </div>
    <div class="container-fluid" ng-show="step==3" style="display: none;">
        <div class="row">
            <div class="col-sm-12 col-md-12 main">
                <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;{{__('Hoàn tất')}}</h1>
                <p>{{__('Mã đơn hàng của bạn là:')}} <span style="font-weight: bold; font-size: 150%;">{{code}}</span>.
                    <br/>{{__('Bạn có thể xem lại đơn hàng tại')}} <a href="<?=ROOT_URL?>dat-hang/{{code}}"><?=ROOT_URL?>dat-hang/{{code}}</a>.
                    <br/>{{__('Vui lòng gọi điện thoại đến cửa hàng (0938.70.70.15 hoặc 0906.70.70.15) để được phục vụ nhanh nhất')}}.</p>
                <a class="btn btn-info" href="" ng-click="reset()"><i class="fa fa-refresh"></i> {{__('Đặt hàng mới')}}</a>&nbsp;
                <a class="btn btn-success" href="" ng-click="step=1"><i class="fa fa-edit"></i> {{__('Sửa đơn hàng')}}</a>
            </div>
        </div>
    </div>
    <?php include("includes/shipping_details.inc.php");?>
    <?php include("includes/loading_elements.inc.php");?>
    <?php include("includes/settings_bar.inc.php");?>
    <script>
        $(document).ready(function(){
            $('#change_captcha').click(function(e){
                e.preventDefault();
                $('#captcha').attr('src', '<?=ROOT_URL?>get-captcha?' + Math.random());
                $('#captcha').focus();
            });
        });
    </script>
    <?php  include("includes/footer.php");?>
    <?php else:?>
    <?php  include("includes/footer_without_angularjs.php");?>
    <?php endif; ?>
