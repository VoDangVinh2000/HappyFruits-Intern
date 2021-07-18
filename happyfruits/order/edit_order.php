<?php 
    include("includes/order.inc.php");
    
    $code = get('code');
    $order = $models->order->get_order($code);
    $error_msg = '';
    if (!$order)
        $error_msg = 'Mã đơn hàng không chính xác.';
	/*
    if (!empty($order['is_shipped']))
        $error_msg = 'Đơn hàng đã được giao.';
	*/
    if (!empty($order['is_locked']) && !$error_msg)
        $error_msg = 'Đơn hàng đã khóa. Vui lòng liên hệ cửa hàng (0938.70.70.15 hoặc 0906.70.70.15)';
    if (!empty($order['deleted']))
        $error_msg = 'Đơn hàng đã xóa. Vui lòng liên hệ cửa hàng (0938.70.70.15 hoặc 0906.70.70.15)';
        
    $title = "Sửa đơn hàng";
    $main_js = 'edit_order';
	if (empty($error_msg)){
		$extra_js = "var ORDER_CODE = '".$code."', processing_branch_index = ".($order['branch_id']-1).";";
		$is_local_order = ($order['type_id'] == ORDER_TYPE_FOODY_ID || $code == $order['id'] || substr($code, 0, 1) != 'e')?1:0;
		$order_type = eModel::_select_one('order_types', array('id' => $order['type_id']));
		$need_customer_details = $order_type['need_customer_details'];
	}
    include("includes/header.inc.php");
?>
  <body>
    <?php include("includes/language_bar.inc.php");?>
    <div class="container-fluid" <?=$error_msg?'':'style="display: none;"'?> ng-show="step==1">
      <div class="row">
        <?php if($error_msg):?>
        <div class="col-sm-12 col-md-12 main">
            <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Đơn hàng - <?=$code?></h1>
            <h4 class="sub-header"><?=$error_msg?></h4>
        </div>
        <?php 
            else:
                include("includes/sidebar.inc.php");
        ?>
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
          <!--
          <a class="shipping" href="" data-toggle="modal" data-target="#myModal">Chi tiết giao hàng</a>
          -->
          <div class="hidden-sm hidden-md hidden-lg"><br /></div>
          <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;{{__('Sửa đơn hàng')}} - <?=$code?></h1>
          <div class="ie_warning" style="display: none;">{{__('Trình duyệt IE của bạn không tương thích với website, nếu có thể vui lòng nâng cấp trình duyệt hoặc chuyển sang trình duyệt khác. Xin cảm ơn.')}}</div>
          <input type="text" class="form-control search-control" auto ng-model="search" placeholder="{{__('Nhập từ khóa để chọn món nhanh')}}" />
          <br />
          <?php include("includes/booking_table.inc.php");?>
          <h4 ng-hide="total">{{__('Vui lòng chọn món.')}}</h4>
          <textarea ng-show="total" class="form-control" ng-model="description" placeholder="{{__('Ghi chú khi pha chế')}}"></textarea><br />
          <a ng-show="total" class="btn btn-success" href="" ng-click="nextStep()"><i class="fa fa-check"></i> {{__('Lưu')}}</a>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if(!$error_msg):?>
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
                            <td style="text-align: right;">{{subtotal*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                        <tr ng-show="discount_amount">
                            <td>{{__('Chiết khấu')}}<span ng-show="discount_amount"> ({{discount*100}}%)</span>: </td>
                            <td style="text-align: right;">-{{discount_amount*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                        <tr ng-show="VAT > 0">
                            <td>VAT({{ VAT*100 }}%): </td>
                            <td style="text-align: right;">{{VAT*(subtotal-discount_amount)*1000|efruit_money}}<sup>đ</sup></td>
                        </tr>
                        <tr ng-show="validForShipping">
                            <td>{{__('Phí giao hàng')}} <span class="distance green-text"></span>: </td>
                            <td style="text-align: right;"><span ng-hide="customer.free_ship && shipping_fee > 0">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></span><strike ng-show="customer.free_ship && shipping_fee > 0">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></strike></td>
                        </tr>
                        <tr ng-show="validForShipping || discount_amount">
                            <td class="bold">{{__('Thành tiền')}}: </td>
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
                <?php if ($need_customer_details) :?>
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
                        <span class="input-group-addon">{{__('Email')}}</span>
                        <input type="email" class="form-control email" ng-model="customer.email" name="email" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">{{__('Quận')}} *</span>
                        <?=html_select_district('form-control', "-- {{__('Chọn')}}", 'ng-model="customer.district" required="required"', 1)?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">{{__('Địa chỉ')}} *</span>
                        <input type="text" class="form-control" id="customer_address" ng-model="customer.address" name="address" required="required" />
                        <span class="input-group-addon get-distance"><a id="get_distance" class="btn btn-warning" href="">{{__('Tìm')}}</a></span>
                    </div>
	                <?php if ($is_local_order):?>
		                <div class="input-group">
			                <span class="input-group-addon">{{__('Tòa nhà')}}</span>
			                <input type="text" class="form-control" id="customer_building" ng-model="customer.building" name="building" />
		                </div>
		                <div class="input-group">
			                <span class="input-group-addon">{{__('Mệnh giá thanh toán')}}</span>
			                <input type="text" class="form-control" id="customer_payment" ng-model="customer.payment" name="payment" />
		                </div>
	                <?php endif; ?>
                    <div class="input-group">
                        <span class="input-group-addon">{{__('Thanh toán')}} *</span>
                        <select class="form-control" ng-model="payment_method">
                            <option value="cod" selected>{{__('Thanh toán khi nhận hàng')}}</option>
                            <option value="bank">{{__('Chuyển khoản')}}</option>
                            <option value="moca">{{__('Thanh toán qua Moca')}}</option>
                            <option value="zalopay">{{__('Thanh toán qua Zalo Pay')}}</option>
                            <option value="vnpay">{{__('Thanh toán qua VN Pay')}}</option>
                        </select>
                    </div>
                    <div class="input-group" ng-show="VAT > 0">
                        <span class="input-group-addon">{{__('Tên công ty')}}</span>
                        <input type="text" class="form-control" id="customer_company_name" ng-model="customer.company_name" name="building" />
                    </div>
                    <div class="input-group" ng-show="VAT > 0">
                        <span class="input-group-addon">{{__('Mã số thuế')}}</span>
                        <input type="text" class="form-control" id="customer_company_tax_code" ng-model="customer.company_tax_code" name="building" />
                    </div>
                    <div class="input-group" ng-show="VAT > 0">
                        <span class="input-group-addon">{{__('Địa chỉ công ty')}}</span>
                        <input type="text" class="form-control" id="customer_company_address" ng-model="customer.company_address" name="building" />
                    </div>
                    <?php if($order['prebooking_discount']):?>
                    <div ng-show="is_prebook" class="input-group datetimepicker">
                        <span class="input-group-addon">{{__('Giờ giao')}}</span>
                        <input type='text' id="datetimepicker" name="date_time" class="form-control" data-maxDate="<?=strtotime('+1 year', strtotime(date('Y-m-d', strtotime($order['created_dtm']))))?>" data-minDate="<?=strtotime('+1 day', strtotime(date('Y-m-d', strtotime($order['created_dtm']))))?>" data-defaultDate="<?=strtotime($order['delivery_date'])?>"/>
                    </div>
                    <?php endif;?>
                    <textarea style="margin-bottom: 3px;" class="form-control" ng-model="customer.description" placeholder="{{__('Ghi chú khi giao hàng')}}."></textarea>
                    <div class="clear"></div>
                    <img id="captcha"/>
                    <a id="change_captcha" tabindex="-1" href="#">{{__('Đổi mã bảo vệ.')}}</a><br />
                    <input type="text" id="captcha_input" class="form-control" name="<?=CAPTCHA_NAME;?>" ng-model="captcha" placeholder="{{__('Mã bảo vệ')}} *" maxlength="4" required="required" />
                    <input type="text" style="width: 0px; visibility: hidden;" ng-model="customer.lat" id="customer_lat" value="" />
                    <input type="text" style="width: 0px; visibility: hidden;" ng-model="customer.lng" id="customer_lng" value="" />
                    <input type="text" style="width: 0px; visibility: hidden;" j-change ng-model="customer.distance" id="distance" value="" />
                <?php else:?>
                    <textarea style="margin-bottom: 3px;" class="form-control" ng-model="customer.description" placeholder="{{__('Ghi chú khi giao hàng')}}."></textarea>
                <?php endif;?>
                <input type="hidden" name="branch_id" id="branch_id" value="<?=$order['branch_id']?>" />
                <input type="hidden" name="is_local" id="is_local" value="<?=$is_local_order?>" />
                <input type="hidden" name="need_customer_details" id="need_customer_details" value="<?=$need_customer_details?>" />
            </form>
            <?php if ($need_customer_details) :?>
            <div class="col-lg-6 col-md-6" id="distance_calculator">
                <div id="customControl" style="padding: 5px;background: #fff;opacity: 0.9;font-size: 12px; position: absolute; top: 0; right: 11px;z-index: 10;">
                    <span><span>{{__('Khoảng cách')}}</span>: <b class="green-text">{{customer.distance}}km</b></span>
                    <span ng-show="validForShipping" style="margin-left:15px;"><span>{{__('Phí giao hàng')}}</span>:<b class="green-text">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></b></span>
                    <span ng-show="freeShipFrom > 0 && customer.distance<=11" style="margin-left:15px;"><span>{{__('Giao miễn phí từ')}}</span>:<b class="green-text">{{freeShipFrom*1000|efruit_money}}<sup>đ</sup></b></span>
                </div>
                <div id="map_canvas" style="height: 400px;"></div><br />
                <p class="header">{{__('Kéo dấu đỏ để chọn lại vị trí của bạn')}}</p>
            </div>
            <?php endif; ?>
            <div class="clear"></div>
            <div class="col-md-6" style="padding-left: 0;">
                <a class="btn btn-info" href="" ng-click="previousStep()"><i class="fa fa-angle-left"></i> {{__('Quay lại')}}</a>
                <a class="btn btn-success" <?php if ($need_customer_details): ?>ng-disabled="frmOrder.$invalid || minTotalError || customer.distance <= 0"<?php endif; ?> href="" ng-click="nextStep()"><i class="fa fa-check"></i> {{__('Lưu')}}</a>
            </div>
            <div class="clear"></div><br />
            <?php if ($need_customer_details) :?>
            <p>* {{__('Quý khách vui lòng nhập đủ thông tin và vị trí giao hàng chính xác, xin cảm ơn.')}}</p>
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
            <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="container-fluid" ng-show="step==3" style="display: none;">
      <div class="row">
        <div class="col-sm-12 col-md-12 main">
            <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;{{__('Hoàn tất')}}</h1>
            <?php if (!$is_local_order && empty($logged_user)) :?>
            <p>{{__('Đơn hàng của bạn đã được sửa.')}}
            <br/>{{__('Bạn có thể xem lại đơn hàng tại')}} <a href="<?=ROOT_URL?>dat-hang/{{code}}"><?=ROOT_URL?>dat-hang/{{code}}</a>.
            <br/>{{__('Vui lòng gọi điện thoại đến cửa hàng (0938.70.70.15 hoặc 0906.70.70.15) để được phục vụ nhanh nhất')}}.</p>
            <a class="btn btn-info" href="<?=ROOT_URL?>dat-hang/"><i class="fa fa-refresh"></i> {{__('Đặt hàng mới')}}</a>&nbsp;
            <?php else:?>
                <p>Đơn hàng đã được sửa. <br/>Xem và in lại đơn hàng tại <a href="<?=ROOT_URL?>in/{{code}}"><?=ROOT_URL?>in/{{code}}</a>.</p>
            <?php endif;?>
            <a class="btn btn-success" href="" ng-click="step=1"><i class="fa fa-edit"></i> {{__('Sửa đơn hàng')}}</a>
        </div>
      </div>
    </div>
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
        });
    </script>
    <?php  include("includes/footer.php");?>
    <?php else:?>
    <?php  include("includes/footer_without_angularjs.php");?>
    <?php endif; ?>
