<?php 
    include("includes/order.inc.php");
    $title = "Đặt hàng";
    $main_js = 'app';
    include("includes/header.inc.php");
	$is_local_order = 0;
?>
  <body>
    <?php include("includes/language_bar.inc.php");?>
    <div class="container-fluid" style="display: none;" ng-show="step==1">
      <div class="row">
        <?php include("includes/sidebar.inc.php");?>
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
          <!--
          <a class="shipping" href="" data-toggle="modal" data-target="#myModal">Chi tiết giao hàng</a>
          -->
          <div class="hidden-sm hidden-md hidden-lg"><br /></div>
          <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;{{__('Đặt hàng')}}&nbsp;<span style="font-size: 18px;" class="hidden-xs glyphicon glyphicon-info-sign" data-placement="right" title="{{__('Nhấn chuột vào menu để chọn món')}}"></span></h1>
          <div class="ie_warning" style="display: none;">{{__('Trình duyệt IE của bạn không tương thích với website, nếu có thể vui lòng nâng cấp trình duyệt hoặc chuyển sang trình duyệt khác. Xin cảm ơn.')}}</div>
          <input type="text" class="form-control search-control" auto ng-model="search" placeholder="{{__('Nhập từ khóa để chọn món nhanh')}}" />
          <h3 class="sub-header">{{__('Đơn hàng')}}</h3>
          <?php include("includes/booking_table.inc.php");?>
          <h4 ng-hide="total">{{__('Vui lòng chọn món.')}}</h4>
          <textarea ng-show="total" class="form-control" ng-model="description" placeholder="{{__('Ghi chú khi pha chế')}}"></textarea><br />
          <a ng-show="total" class="btn btn-success" href="" ng-click="nextStep()"><i class="fa fa-check"></i> {{__('Đặt hàng')}}</a>
        </div>
      </div>
    </div>
    <div class="container-fluid" ng-show="step==2" style="display: none;">
      <div class="row">
        <div class="col-sm-4 col-md-3 sidebar" style="padding: 10px 5px 10px 10px;">
            <h4 class="bold">{{__('Đơn hàng')}}</h4>
            <?php include("includes/order_summary.inc.php");?>
        </div>
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
            <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;{{__('Thông tin giao hàng')}}</h1>
            <div class="hidden-sm hidden-md hidden-lg">
                <table class="order_summary">
                    <tbody>
                        <tr>
                            <td>{{__('Số lượng')}}: </td>
                            <td style="text-align: right;">{{totalQuantity}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Tổng')}}: </td>
                            <td style="text-align: right;">{{subtotal|efruit_money}}.000<sup>đ</sup></td>
                        </tr>
                        <tr ng-show="discount_amount">
                            <td>{{__('Chiết khấu')}}: </td>
                            <td style="text-align: right;">-{{discount_amount*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                        <tr ng-show="validForShipping">
                            <td>{{__('Phí giao hàng')}} <span class="distance green-text"></span>: </td>
                            <td style="text-align: right;"><span ng-hide="customer.free_ship && shipping_fee > 0">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></span><strike ng-show="customer.free_ship && shipping_fee > 0">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></strike></td>
                        </tr>
                        <tr ng-show="validForShipping || discount_amount">
                            <td class="bold">{{__('Tổng cộng')}}: </td>
                            <td style="text-align: right;font-size: 120%">{{total*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                    </tbody>
                </table>
                <br />
            </div>
            <div class="form_errors col-md-6" ng-hide="validateShipping()">
                <span>{{__('Tổng đơn hàng thấp nhất để giao hàng với khoảng cách')}} {{customer.distance}}km {{__('là')}} {{minTotal}}.000<sup>đ</sup>. {{__('Vui lòng đặt hàng thêm')}}.</span>
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
    <?php if (!empty($is_off)):?>
    <!-- Working time modal -->
    <div id="notification_area" style="display: none;">
        <a class="icon" href="">
            <span class="badge">1</span>
            <span class="warning"><i class="fa fa-warning"></i></span>
        </a>
    </div>
    <div id="myNotificationModal" tabindex="-1" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <a style="display: inline;" class="modal-close"></a>
          <div class="left">
            <img src="<?=SITE_URL?>images/closed.png"/>
		  </div>
          <div class="description">
            <p style="margin: 0;">{{__('Hiện cửa hàng đã tạm nghỉ.')}}</p>
            <table style="border-spacing:0;border-collapse:collapse;">
                <tr>
                    <td>{{__('Giờ mở cửa:')}}</td>
                    <td>&nbsp;{{__('9h - 22h (Thứ 2 - Thứ 7)')}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>{{__('12h - 22h (Chủ nhật)')}}</td>
                </tr>
            </table>
            <p>{{__('Quý khách có nhu cầu đặt online vui lòng ghi chú giờ hẹn giao đến.')}}<br />
            {{__('Cửa hàng sẽ kiểm tra và liên lạc sớm nhất.')}}<br />
            {{__('Chân thành cảm ơn.')}}</p>
          </div>
        </div>
      </div>
    </div>
    <?php endif;?>
    <?php include("includes/shipping_details.inc.php");?>
    <?php include("includes/loading_elements.inc.php");?>
    <?php include("includes/settings_bar.inc.php");?>
    <?php include("includes/modals2.inc.php");?>
    <input type="hidden" id="referer" value="<?php echo isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:''?>"/>
    <script>
        $(document).ready(function(){
            $('#change_captcha').click(function(e){
                e.preventDefault();
                $('#captcha').attr('src', '<?=ROOT_URL?>get-captcha?' + Math.random());
                $('#captcha').focus();
            });
            
            var referer = $('#referer').val();
            pushEvent('Đến từ', referer.length?referer:'Không xác định', navigator.userAgent);
        });
    </script>
    <?php  include("includes/footer.php");?>