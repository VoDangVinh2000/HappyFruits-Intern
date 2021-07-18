<?php include("includes/print.inc.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="efruit" ng-controller="eFruitController as eFruit" id="ng-app" xmlns:ng="<?=ROOT_URL?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Chi tiết đơn hàng - <?=get_setting('site_name')?></title>

    <link rel="shortcut icon" href="<?=get_child_theme_assets_url()?>img/favicon.ico"/>
    <link rel="image_src" href="<?=get_child_theme_assets_url()?>img/main_logo.png" />

	<!-- Bootstrap core CSS -->
	<link href="<?=SITE_URL?>css/bootstrap.min.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="<?=SITE_URL?>css/booking.css<?='?v='.$version?>" rel="stylesheet" />
	<link href="<?=SITE_URL?>js/bootstrap-datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet"   />

	<link href="<?=SITE_URL?>css/font-awesome.css" rel="stylesheet" />
	<style>
		h2{font-size: 20px;}
		table { page-break-inside:auto }
		tr    { page-break-inside:avoid; page-break-after:auto }
		thead { display:table-header-group }
		tfoot { display:table-footer-group }
		.page_break{ page-break-before: always }
		table.order_items .quantity{min-width: 85px;}
	</style>
	<link id="printing_style" href="<?=SITE_URL?>css/print_v2.css<?='?v='.$version?>" rel="stylesheet" media="print" />

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?=SITE_URL?>js/html5shiv.min.js"></script>
	<script src="<?=SITE_URL?>js/respond.min.js"></script>
	<![endif]-->
	<script>
		var code = '<?=$code?>';
		var base_url = '<?=SITE_URL?>';
		var version = '<?=VERSION?>';
        var domain_name = '<?=DOMAIN_NAME?>';
		var day_arr = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
		var no_print_ids = [];
		function setPrintingTime(id){
			var now = new Date();
			var date = now.getDate();
			if (date < 10)
				date = '0' + date.toString();
			var month = now.getMonth() + 1;
			if (month < 10)
				month = '0' + month.toString();
			var hour = now.getHours();
			if (hour < 10)
				hour = '0' + hour.toString();
			var minute = now.getMinutes();
			if (minute < 10)
				minute = '0' + minute.toString();
			var dt = day_arr[now.getDay()] + ' ' + date + '/' + month + '/' + now.getFullYear() + ' ' + hour + ':' + minute;
			document.getElementById(id).innerHTML = dt;

		}
		function print_bill(){
			var main_content = document.getElementById("main_content");
			var classes = main_content.getAttribute('class');
			classes = classes.replace(' printing_receipt','');
			classes = classes.replace(' printing_label','');
            classes = classes.replace(' w80mm','');
			main_content.setAttribute('class', classes + ' w80mm');
			var discount_amount = parseFloat($('#discount_amount').html());
			if (discount_amount == 0)
				$('#discount_amount').parent().parent().hide();
			//setPrintingTime('bill_printing_datetime');
            setTimeout(function(){
                window.print();
            }, 500);
			$('#discount_amount').parent().parent().show();
			return false;
		}
		function print_receipt(){
			var main_content = document.getElementById("main_content");
			var classes = main_content.getAttribute('class');
			classes = classes.replace(' printing_label','');
            classes = classes.replace(' w80mm','');
			if (classes.indexOf('printing_receipt') == -1){
				classes += ' printing_receipt';
			}
			main_content.setAttribute('class', classes + ' w80mm');
			setPrintingTime('receipt_printing_datetime');
            setTimeout(function(){
                window.print();
            }, 500);
			return false;
		}
		function print_label(){
			var main_content = document.getElementById("main_content");
			var classes = main_content.getAttribute('class');
			classes = classes.replace(' printing_receipt','');
            classes = classes.replace(' w80mm','');
			if (classes.indexOf('printing_label') == -1){
				classes += ' printing_label';
			}
			main_content.setAttribute('class', classes);

            var scope = angular.element($('[ng-app]')).scope();
            scope.$apply(function(){
                scope.printing_label = 1;
                setTimeout(function(){
                    $('.no-print.btn-danger').each(function(){
                        var order_item_id = $(this).attr('data-item-id');
                        $('.printing .label-item.item-'+order_item_id).addClass('no-print');
                    });
                    window.print();
                }, 500);
            });
			return false;
		}
		function print_label_custom(order_item_id){
			var main_content = document.getElementById("main_content");
			var classes = main_content.getAttribute('class');
			classes = classes.replace(' printing_receipt','');
			if (classes.indexOf('printing_label') == -1){
				classes += ' printing_label';
			}
			main_content.setAttribute('class', classes);

            var scope = angular.element($('[ng-app]')).scope();
            scope.$apply(function(){
                scope.printing_label = 1;
                setTimeout(function(){
                    $('.printing .label-item').hide();
                    $('.printing .label-item.item-'+order_item_id).show();
                    if ($('.printing .label-item.item-'+order_item_id).length == 0)
                        $('.printing .label-item.item-' + order_item_id).css('height', '22mm');
                    window.print();
                    $('.printing .label-item').css('height', '30mm');
                    $('.printing .label-item').show();
                }, 500);
            });
			return false;
		}

        window.onafterprint = function(e){
            var scope = angular.element($('[ng-app]')).scope();
            scope.$apply(function(){
                scope.printing_label = 0;
            });
        };
	</script>
</head>
<body>
<div class="container-fluid" id="main_content" style="display: none;">
	<div class="row">
		<div class="col-sm-12 col-md-12 main w80mm hidden_when_printing">
			<div class="header_right">
				<?php if (empty($order['is_locked']) && $order['status'] != 'Completed' && !$is_online_foody_order):?>
					<a target="_blank" class="btn btn-danger" href="<?=ROOT_URL?>sua/<?=$code?>" >Đổi món</a>
				<?php endif;?>
				<a ng-show="need_to_save" class="btn btn-success" href="" ng-click="saveOrder()" >Lưu</a>
				<a id="print_label" class="btn btn-success" href="#" onclick="print_label();return false;">In nhãn</a>
				<a id="print_bill" ng-show="!need_to_save" class="btn btn-success" href="#" onclick="print_bill();return false;">In phiếu thanh toán</a>
				<a id="print_receipt" class="btn btn-success" href="#" onclick="print_receipt();return false;">In pha chế</a>
				<?php /* <a id="lock_order" class="btn btn-warning" href="" ng-click="lockOrder()" ><span ng-show="order.is_locked">Mở khóa</span><span ng-hide="order.is_locked">Khóa</span></a> */ ?>
			</div>
			<div class="hidden-vs hidden-sm hidden-md hidden-lg"><br /><br /></div>
			<h1 class="page-header"><img height="40" src="<?=get_child_theme_assets_url()?>img/small-logo.png" style="float: left;">&nbsp;Đơn hàng - <?=$code?> - <?=$order_type['type_name']?></h1>
			<div>
				<div class="row">
					<div class="col-sm-12 col-md-3">Giờ tạo: <?=date('d/m/Y H:i:s', strtotime($order['created_dtm']))?></div>
					<div class="col-sm-12 col-md-3">Cửa hàng giao: <?=$branch['branch_name']?></div>
				</div>
				<div class="row">
					<?php if($is_online_foody_order):?>
						<div class="col-sm-12 col-md-3">
                            Thời gian lấy: <?=date('d/m/Y H:i:s', strtotime($order['pickup_time']))?><br/>
                            Thời gian giao: <?=date('d/m/Y H:i:s', strtotime($order['delivery_date']))?>
                        </div>
					<?php else: ?>
						<?php if (!empty($customer) || in_array($order['type_id'], array(ORDER_TYPE_TAKEAWAY_ID, ORDER_TYPE_FOODY_ID))):?>
                            <?php if (strtotime(date('Y-m-d'). ' -7 day') < strtotime($order['created_dtm']) || strtotime(date('Y-m-d'). ' -1 day') < strtotime($order['pickup_time'])): ?>
                                <div class="col-sm-12 col-md-3">Thời gian lấy: <input type="text" size="16" style="width: 180px;" id="datetimepicker2" name="pickup_time" class="form-control" data-maxDate="<?=strtotime('+1 year', strtotime(date('Y-m-d')))?>" data-minDate="<?=strtotime($order['delivery_date'])<strtotime(date('Y-m-d'). ' -1 day')?strtotime($order['delivery_date']):strtotime(date('Y-m-d'). ' -1 day')?>" data-defaultDate="<?=strtotime($order['pickup_time'])?>"/></div>
                            <?php endif;?>
                            <?php if (strtotime(date('Y-m-d'). ' -7 day') < strtotime($order['created_dtm']) || strtotime(date('Y-m-d'). ' -1 day') < strtotime($order['delivery_date'])): ?>
								<div class="col-sm-12 col-md-3">Thời gian giao: <input type="text" size="16" style="width: 180px;" id="datetimepicker" name="delivery_date" class="form-control" data-maxDate="<?=strtotime('+1 year', strtotime(date('Y-m-d')))?>" data-minDate="<?=strtotime($order['delivery_date'])<strtotime(date('Y-m-d'). ' -1 day')?strtotime($order['delivery_date']):strtotime(date('Y-m-d'). ' -1 day')?>" data-defaultDate="<?=strtotime($order['delivery_date'])?>"/></div>
							<?php endif;?>
						<?php endif;?>
					<?php endif;?>
					<div class="col-sm-12 col-md-3">Tình trạng: <?php echo html_select_array(get_status_options(), 'id="order_status" class="form-control"', null, $order['status'])?></div>
				</div>
				<div class="clear"></div>
				<table class="table order_items table-striped">
					<thead>
					<tr>
						<th class="hidden-xs">Nhóm hàng</th>
						<th>Tên món</th>
						<th>Ghi chú</th>
						<th class="quantity">SL</th>
						<th style="min-width: 80px;">Giá</th>
						<th>T.Tiền</th>
					</tr>
					</thead>
					<tbody>
					<?php
					foreach($order_items as $item):
						?>
						<tr>
							<td class="hidden-xs"><?=$item['category_name']?></td>
							<td><?=$is_online_foody_order?$item['product_name']:$item['code']. ' - '. $item['product_name']?>
								<?php if ($item['total_sub_items']):?>
									<div class="sub_product">
										<p>&nbsp;<?php foreach($item['sub_items'] as $sub_item):?><span><?=$sub_item['product_name']?><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?></p>
									</div>
								<?php endif;?>
                                <?php if ($item['box_items']):?>
                                    <div class="sub_product">
                                        <p>&nbsp;<?php foreach($item['box_items'] as $box_item):?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <?=$box_item['product_name']?><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?></p>
                                    </div>
                                <?php endif;?>
								<?php if ($item['description']): ?>
									<div class="order_item_description printing">
										<p>-- <?=$item['description']?></p>
									</div>
								<?php endif;?>
							</td>
							<td><?=$item['description']?></td>
							<td class="acenter"><?=formatQuantity($item['quantity'])?></td>
							<td class="acenter"><?=$item['final_price']?>.000</td>
							<td class="aright"><?=number_format($item['final_price']*$item['quantity'],3,'.','.')?>&nbsp;<a title="Không in nhãn" data-item-id="<?=$item['id']?>" class="btn btn-sm hidden-xs hidden-sm btn-info no-print" href="#"><i class="fa fa-ban"></i></a>&nbsp;<a class="btn btn-sm btn-info hidden-xs hidden-sm" href="" onClick="print_label_custom(<?=$item['id']?>)"><i class="fa fa-print"></i></a></td>
						</tr>
					<?php endforeach; ?>
					<tr class="total">
						<td>Tổng</td>
						<td class="hidden-xs"></td>
						<td></td>
						<td class="acenter"><?=formatQuantity($order['quantity'])?></td>
						<td></td>
						<td class="aright"><?=number_format($order['subtotal'],3,'.','.')?></td>
					</tr>
					<?php if($is_online_foody_order):?>
						<tr class="total">
							<td>Chiết khấu</td>
							<td class="hidden-xs"></td>
							<td></td>
							<td></td>
							<td>
								<span><?=number_format($order['discount']/$order['subtotal']*100, 2)?>%</span>
							</td>
							<td class="aright">
								<span><?=number_format($order['discount'],3,'.','.')?></span>
							</td>
						</tr>
					<?php else:?>
					<tr class="total">
						<td>Chiết khấu<?=!empty($order['promotion_code'])?' (Áp dụng mã KM)':''?></td>
						<td class="hidden-xs"></td>
						<td></td>
						<td></td>
						<td>
							<?php if (empty($order['is_shipped'])):?>
								<div><input type="text" style="width: 45px;" maxlength="5" ng-model="discount_rate" ng-blur="validateDiscountRate()" ng-change="updateTotal(1)" only-float />%</div>
							<?php else:?>
								<span><?=number_format($order['discount']/$order['subtotal']*100, 2)?>%</span>
							<?php endif;?>
						</td>
						<td class="aright">
							<?php if (empty($order['is_shipped'])):?>
								<div><input type="text" style="width: 80px;" ng-model="discount_amount" ng-blur="validateDiscountAmount()" ng-change="updateTotal(0)" only-float /></div>
							<?php else:?>
								<span><?=number_format($order['discount'],3,'.','.')?></span>
							<?php endif;?>
						</td>
					</tr>
					<tr class="total">
						<td>VAT</td>
						<td class="hidden-xs"></td>
						<td></td>
						<td colspan="2">
                            <div class="custom-radio-with-tick inline">
                                <input type="radio" id="vat_10" ng-model="VAT" value="0.1" ng-click="setVAT(0.1)">
                                <label style="cursor: pointer;font-weight: normal;" for="vat_10">10%</label>
                            </div>&nbsp;
                            <div class="custom-radio-with-tick inline">
                                <input type="radio" id="vat_5" ng-model="VAT" value="0.05" ng-click="setVAT(0.05)">
                                <label style="cursor: pointer;font-weight: normal;" for="vat_5">5%</label>
                            </div>
                            &nbsp;
                            <div class="custom-radio-with-tick inline">
                                <input type="radio" id="vat_0" ng-model="VAT" value="0" ng-click="setVAT(0)">
                                <label style="cursor: pointer;font-weight: normal;" for="vat_0">0%</label>
                            </div>
                        </td>
						<td class="aright">{{(order.subtotal-discount_amount)*VAT*1000|efruit_money}}</td>
					</tr>
					<?php if($order['shipping_fee']):?>
						<tr class="total">
							<td>Phí giao hàng <?=!empty($customer->distance)?$customer->distance.'km':''?></td>
							<td class="hidden-xs"></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="aright"><?=$order['shipping_fee'].'.000'?></td>
						</tr>
					<?php endif;?>
					<?php endif; ?>
					<tr class="total">
						<td colspan="3" class="aright largesize">Thành tiền:&nbsp;</td>
						<td class="hidden-xs"></td>
						<td></td>
						<td class="aright largesize">{{order.total*1000|efruit_money}}</td>
					</tr>
					</tbody>
				</table>
				<div class="clear"></div>
				<?php if($order['description']):?>
					<div>
						<h2 class="bold">Ghi chú đơn hàng</h2>
						<p><?=nl2br($order['description'])?></p>
					</div>
				<?php endif; ?>
				<?php if($order['is_prepaid']):?>
                    <?php if($is_online_foody_order):?>
                        <h2 class="bold">Đã thanh toán qua Airpay <span class="glyphicon glyphicon-ok"></span></h2>
                    <?php elseif($order['payment_method']!='pay_later' && $order['payment_method']!='other'): ?>
                        <h2 class="bold"><?=get_payment_method_string($order['payment_method'])?> <span class="glyphicon glyphicon-ok"></span></h2>
                    <?php endif;?>
				<?php elseif($order['payment_date']):?>
					<h2 class="bold">Thanh toán sau, vào ngày <?=date('d/m/Y', strtotime($order['payment_date']))?>.</h2>
				<?php endif;?>
				<?php if ($is_online_foody_order):?>
					<div class="clear"></div>
					<h2 class="bold">Thông tin giao hàng</h2>
					<table class="customer col-md-6">
						<tbody>
						<tr>
							<td><span class="bold">Người nhận:</span> <?=$customer->fullname?><?=isset($customer->mobile)?' - '.$customer->mobile:''?></td>
						</tr>
						<tr>
							<td><span class="bold">Địa chỉ:</span> <?=!empty($customer->place)?"$customer->place, ":''?><?=get_booking_address($customer)?></td>
						</tr>
						<tr>
							<td><span class="bold">Khoảng cách:</span> <?=$customer->distance?>km</td>
						</tr>
						<tr>
							<td><span class="bold">Shipper:</span> <?=$customer->shipper_name?> - <?=$customer->shipper_phone?></td>
						</tr>
						</tbody>
					</table>
				<?php elseif ($customer):?>
                    <div class="clear"></div>
					<h2 class="bold">Thông tin giao hàng</h2>
                    <?php if (!empty($customer->booker_mobile)): ?>
                        <table class="customer col-md-6">
                            <tbody>
                            <tr>
                                <td><span class="bold">Người đặt:</span> <?=$customer->booker_fullname?> - <?=$customer->booker_mobile?></td>
                            </tr>
                            <?php if (!empty($customer->message_to_receiver)): ?>
                                <tr>
                                    <td colspan="2"><span class="bold">Thông điệp:</span> <?=$customer->message_to_receiver?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="clear"></div>
                    <?php endif; ?>
					<table class="customer col-md-6">
						<tbody>
						<tr>
							<td><span class="bold">Người nhận:</span> <?=$customer->fullname?></td>
							<td><span class="bold">SĐT:</span> <?=$customer->mobile?></td>
						</tr>
						<tr>
							<td><span class="bold">Địa chỉ:</span> <?=!empty($customer->place)?"$customer->place, ":''?><?=get_booking_address($customer)?>
								<?php if (!empty($customer->lat) && !empty($customer->lng)):?>
									<br />
									<a target="_blank" id="view_map" href="http://maps.google.com/maps?f=d&saddr=<?=$branch['lat']?>,<?=$branch['lng']?>&daddr=<?=$customer->lat?>,<?=$customer->lng?>">Xem trên Google</a>
								<?php endif;?>
								<?php if (!empty($customer->building)):?><br/>Tòa nhà: <?=$customer->building?><?php endif; ?>
							</td>
							<td>
								<?php if(!empty($customer->payment)):?>
									<span class="bold">Mệnh giá tiền thanh toán:</span> <?=is_numeric($customer->payment)?number_format($customer->payment, 0):$customer->payment?>
								<?php endif;?>
							</td>
						</tr>
						<?php if(!empty($customer->ex_description) || !empty($customer->description)):?>
							<tr>
								<td colspan="2"><span class="bold">Ghi chú:</span> <p style="display: inline;"><?=nl2br(!empty($customer->description)?$customer->description:$customer->ex_description)?></p></td>
							</tr>
						<?php endif; ?>
						<?php if(!empty($customer->company_name) && !empty($customer->company_address)):?>
						<tr ng-show="VAT">
							<td colspan="2">
								<h4 class="bold">Thông tin hóa đơn</h4>
								<p style="display: inline;">
									Tên công ty: <?=$customer->company_name?><br/>
									MST: <?=!empty($customer->company_tax_code)?$customer->company_tax_code:''?><br/>
									Địa chỉ công ty: <?=$customer->company_address?>
								</p>
							</td>
						</tr>
						<?php endif; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 main printing w80mm hidden_when_printing_receipt hidden_when_printing_label">
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
                <h1 class="bold">PHIẾU THANH TOÁN<br/><?=$is_online_foody_order?'Foody ':''?><?=$code?></h1>
            </div>
			<p>
                <p class="smallsize acenter"><span class="bold">Thời gian lấy:</span> <span class="pickup_time"><?=date('d/m/Y H:i', strtotime($order['pickup_time']))?></span></p>
                <?php if (!$is_online_foody_order && $customer):?>
                    <p class="smallsize acenter"><span class="bold">Thời gian giao:</span> <span class="delivery_datetime"><?=date('d/m/Y H:i', strtotime($order['delivery_date']))?></span></p>
                <?php endif; ?>
                <table class="table order_items table-striped">
					<thead>
					<tr>
						<th>Tên món</th>
						<th>T.Tiền</th>
					</tr>
					</thead>
					<tbody>
					<?php
					foreach($order_items as $item):
						?>
						<tr>
							<td colspan="2"><?=$is_online_foody_order?$item['product_name']:$item['code']. ' - '. $item['product_name']?>
								<?php if ($item['total_sub_items']):?>
									<div class="sub_product">
										<p>&nbsp;<?php foreach($item['sub_items'] as $sub_item): ?><span><?=$sub_item['product_name']?><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?></p>
									</div>
								<?php endif;?>
                                <?php if ($item['box_items']):?>
                                    <div class="sub_product">
                                        <p>&nbsp;<?php foreach($item['box_items'] as $box_item):?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <?=$box_item['product_name']?><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?></p>
                                    </div>
                                <?php endif;?>
								<?php if ($item['description']):?>
									<div class="order_item_description printing">
										<p>-- <?=$item['description']?></p>
									</div>
								<?php endif;?>
							</td>
						</tr>
						<tr>
							<td><?=formatQuantity($item['quantity'])?> x <?=number_format($item['final_price'],3,'.','.')?></td>
							<td class="aright price"><?=number_format($item['final_price']*$item['quantity'],3,'.','.')?></td>
						</tr>
					<?php endforeach; ?>
					<tr class="total">
						<td colspan="2">Tổng số lượng: <span class="price"><?=formatQuantity($order['quantity'])?></span></td>
					</tr>
					<tr class="total">
						<td>Tổng</td>
						<td class="aright price"><?=number_format($order['subtotal'],3,'.','.')?></td>
					</tr>
					<tr class="total" ng-show="discount_amount > 0">
						<td>Chiết khấu <span class="printing">{{discount_rate}}%</span></td>
						<td class="aright price">
							<span class="printing" id="discount_amount">-{{discount_amount*1000|efruit_money}}</span>
						</td>
					</tr>
					<tr ng-show="VAT" class="total">
						<td>VAT {{VAT*100}}%</td>
						<td class="aright price">{{(order.subtotal-discount_amount)*VAT*1000|efruit_money}}</td>
					</tr>
					<?php if($order['shipping_fee']):?>
						<tr class="total">
							<td>Phí giao hàng</td>
							<td class="aright price"><?=$order['shipping_fee'].'.000'?></td>
						</tr>
					<?php endif;?>
					<tr class="total">
						<td class="aright largesize">Thành tiền:&nbsp;</td>
						<td class="aright largesize">{{order.total*1000|efruit_money}}</td>
					</tr>
                    <tr class="total">
                        <td class="aright largesize" colspan="2">
                            <?php if($order['is_prepaid']):?>
                                <?php if($is_online_foody_order):?>
                                    <span>Đã thanh toán qua Airpay.</span>
                                <?php elseif($order['payment_method']!='pay_later' && $order['payment_method']!='other'): ?>
                                    <span><?=get_payment_method_string($order['payment_method'])?>.</span>
                                <?php endif;?>
                            <?php endif;?>
                        </td>
                    </tr>
					</tbody>
				</table>
				<div class="clear"></div>
				<?php if($order['payment_date']):?>
					<h2 class="bold">Thanh toán sau, vào ngày <?=date('d/m/Y', strtotime($order['payment_date']))?>.</h2>
				<?php endif;?>
				<?php if($order['description']):?>
					<div>
						<h2 class="bold">Ghi chú đơn hàng</h2>
						<p><?=str_replace("\n",'<br/>', $order['description'])?></p>
					</div>
					<br />
				<?php endif; ?>
				<?php if ($is_online_foody_order):?>
					<div class="clear"></div>
					<table class="customer col-md-6">
						<tbody>
						<tr>
							<td><span class="bold">Người nhận:</span> <?=$customer->fullname?><?=isset($customer->mobile)?' - '.$customer->mobile:''?></td>
						</tr>
						<tr>
							<td><span class="bold">Địa chỉ:</span> <?=!empty($customer->place)?"$customer->place, ":''?><?=get_booking_address($customer)?></td>
						</tr>
						<tr>
							<td><span class="bold">Shipper:</span> <?=$customer->shipper_name?> - <?=$customer->shipper_phone?></td>
						</tr>
						</tbody>
					</table>
				<?php elseif ($customer):?>
					<div class="clear"></div>
                    <?php if (!empty($customer->booker_mobile)): ?>
                        <table class="customer col-md-6">
                            <tbody>
                            <tr>
                                <td><span class="bold">Người đặt:</span> <?=$customer->booker_fullname?> - <?=$customer->booker_mobile?></td>
                            </tr>
                            <?php if (!empty($customer->message_to_receiver)): ?>
                            <tr>
                                <td colspan="2"><span class="bold">Thông điệp:</span> <?=$customer->message_to_receiver?></td>
                            </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="clear"></div>
                    <?php endif; ?>
					<table class="customer col-md-6">
						<tbody>
						<tr>
							<td><span class="bold">Người nhận:</span> <?=$customer->fullname?></td>
						</tr>
						<tr><td><span class="bold">SĐT:</span> <?=$customer->mobile?></td></tr>
						<tr>
							<td>
								<span class="bold">Địa chỉ:</span> <?=get_booking_address($customer)?>
								<?php if (!empty($customer->building)):?><br/>Tòa nhà: <?=$customer->building?><?php endif; ?>
							</td>
						</tr>
                        <?php if(!empty($customer->description)): ?>
                            <tr>
                                <td><span class="bold">Ghi chú:</span> <?=nl2br( $customer->description)?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if(!empty($customer->payment)): ?>
                        <tr>
                            <td><span class="bold">Mệnh giá tiền:</span> <?=$customer->payment?></td>
                        </tr>
                        <?php endif; ?>
						</tbody>
					</table>
				<?php endif; ?>
				<?php if(!empty($customer->company_name) && !empty($customer->company_address)):?>
					<div class="clear"></div>
					<table class="customer col-md-6" ng-show="VAT">
						<tbody>
							<tr>
								<td colspan="2">
									<h4 class="bold">Thông tin hóa đơn</h4>
									<p style="display: inline;">
										<span class="bold">Tên công ty:</span> <?=$customer->company_name?><br/>
										<span class="bold">MST:</span> <?=!empty($customer->company_tax_code)?$customer->company_tax_code:''?><br/>
										<span class="bold">Địa chỉ công ty:</span> <?=$customer->company_address?>
									</p>
								</td>
							</tr>
						</tbody>
					</table>
				<?php endif; ?>
				<p class="acenter">------------------------</p>
				<h2 class="acenter">Cám ơn quý khách!<br/>Hẹn gặp lại :)</h2>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 main printing w80mm print-receipt hidden_when_printing_bill hidden_when_printing_label">
			<div class="header">
                <h1 class="bold" style="font-size: 34px;"><?=$seq_no?></h1>
				<h1 class="bold" style="font-size: 16px;">PHA CHẾ <?=$is_online_foody_order?'Foody ':''?><br/><?=$code?></h1>
			</div>
			<div>
                <p class="smallsize acenter">Giờ in: <span id="receipt_printing_datetime"><?=date('H:i:s')?></span></p>
                <p class="smallsize acenter">Giờ lấy hàng:</span> <span class="pickup_time"><?=date('d/m/Y H:i', strtotime($order['pickup_time']))?></p>
                <?php if($order['description']):?>
					<br />
					<div>
						<h2 style="padding: 0;margin: 0;" class="bold">Ghi chú pha chế</h2>
						<p style="font-size: 125%;"><?=nl2br($order['description'])?></p>
					</div>
				<?php endif; ?>
                <?php if(!empty($customer->ex_description)):?>
                    <br />
                    <div>
                        <h2 style="padding: 0;margin: 0;" class="bold">Ghi chú nội bộ</h2>
                        <p style="font-size: 125%;"><?=nl2br($customer->ex_description)?></p>
                    </div>
                <?php endif; ?>
				<table class="table order_items table-striped">
					<thead>
					<tr>
						<th>Món</th>
					</tr>
					</thead>
					<tbody>
					<?php
					foreach($order_items as $item):
						?>
						<tr>
							<td><?=$is_online_foody_order?$item['product_name']:$item['code']. ' - '. $item['product_name']?>
								<?php if ($item['total_sub_items']):?>
									<div class="sub_product">
										<p>&nbsp;<?php foreach($item['sub_items'] as $sub_item): ?><span><?=$sub_item['product_name']?><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?></p>
									</div>
								<?php endif;?>
                                <?php if (!empty($item['components'])):?>
                                <div class="sub_product">
                                    <p>&nbsp;<?php foreach($item['components'] as $comp): ?><span><?=$comp['name']?><?=$comp == end($item['components'])?'':', '?></span><?php endforeach; ?></p>
                                </div>
                                <?php endif;?>
                                <?php if ($item['box_items']):?>
                                    <div class="sub_product">
                                        <p>&nbsp;<?php foreach($item['box_items'] as $box_item):?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <?=$box_item['product_name']?><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?></p>
                                    </div>
                                <?php endif;?>
								<?php if ($item['description']):?>
									<div class="order_item_description printing">
										<p>-- <?=$item['description']?></p>
									</div>
								<?php endif;?>
								<?php if (!$item['total_sub_items'] && $item['description']) echo '<br/>';?>
								<div class="aright" style="padding-right: 10px;">x<?=formatQuantity($item['quantity'])?></div>
							</td>
						</tr>
					<?php endforeach; ?>
					<tr class="total">
						<td>Tổng SL: <?=formatQuantity($order['quantity'])?></td>
					</tr>
					</tbody>
				</table>
				<div class="clear"></div>
				<?php if ($is_online_foody_order):?>
					<div class="clear"></div>
					<table class="customer col-md-6">
						<tbody>
						<tr>
							<td><span class="bold">Người nhận:</span> <?=$customer->fullname?><?=isset($customer->mobile)?' - '.$customer->mobile:''?></td>
						</tr>
						<tr>
							<td><span class="bold">Địa chỉ:</span> <?=!empty($customer->place)?"$customer->place, ":''?><?=$customer->address?><?=!empty($customer->ward)?", phường $customer->ward":''?><?=!empty($customer->district)?", quận $customer->district":''?></td>
						</tr>
						<tr>
							<td><span class="bold">Shipper:</span> <?=$customer->shipper_name?> - <?=$customer->shipper_phone?></td>
						</tr>
                        <tr>
                            <td><span class="bold">Thời gian giao dự kiến:</span> <span class="delivery_datetime"><?=date('d/m/Y H:i', strtotime($order['delivery_date']))?></span></td>
                        </tr>
						</tbody>
					</table>
				<?php elseif($customer):?>
					<div class="clear"></div>
                    <?php if (!empty($customer->booker_mobile)): ?>
                        <table class="customer col-md-6">
                            <tbody>
                            <tr>
                                <td><span class="bold">Người đặt:</span> <?=$customer->booker_fullname?> - <?=$customer->booker_mobile?></td>
                            </tr>
                            <?php if (!empty($customer->message_to_receiver)): ?>
                            <tr>
                                <td colspan="2"><span class="bold">Thông điệp:</span> <?=$customer->message_to_receiver?></td>
                            </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="clear"></div>
                    <?php endif; ?>
					<table class="customer col-md-6">
						<tbody>
						<tr>
							<td><span class="bold">Người nhận:</span> <?=$customer->fullname?></td>
						</tr>
						<tr><td><span class="bold">SĐT:</span> <?=$customer->mobile?></td></tr>
						<td>
							<span class="bold">Địa chỉ:</span> <?=get_booking_address($customer)?>
							<?php if (!empty($customer->building)):?><br/>Tòa nhà: <?=$customer->building?><?php endif; ?>
						</td>
                        <?php if(!empty($customer->description)):?>
                            <tr>
                                <td><span class="bold">Ghi chú:</span> <?=nl2br($customer->description)?></td>
                            </tr>
                        <?php endif; ?>
						<tr>
							<td><span class="bold">Thời gian giao hàng:</span> <span class="delivery_datetime"><?=date('d/m/Y H:i', strtotime($order['delivery_date']))?></span></td>
						</tr>
						</tbody>
					</table>
				<?php endif; ?>
                <?php if($order['is_prepaid']):?>
                    <?php if($is_online_foody_order):?>
                        <h2 class="bold">Đã thanh toán qua Airpay.</h2>
                    <?php elseif($order['payment_method']!='pay_later' && $order['payment_method']!='other'): ?>
                        <h2 class="bold"><?=get_payment_method_string($order['payment_method'])?>.</h2>
                    <?php endif;?>
                <?php elseif($order['payment_date']):?>
                    <h2 class="bold">Thanh toán sau, vào ngày <?=date('d/m/Y', strtotime($order['payment_date']))?>.</h2>
                <?php endif;?>
			</div>
		</div>
		<div ng-if="printing_label==1"  class="col-sm-12 col-md-12 main printing hidden_when_printing_receipt hidden_when_printing_bill">
			<div>
				<?php
					foreach($order_items as $item):
						$loop = 1;
						if (intval($item['quantity']) == $item['quantity'])
							$loop = $item['quantity'];
						for($i = 0; $i < $item['quantity']; $i++):
				?>
				<div class="label-item item-<?=$item['id']?>" style="width: 50mm; height: 30mm; word-wrap: break-word; font-size:12px;overflow: hidden;">
					<span style="font-size: 13px;font-weight: bold;">[<?=$seq_no?>] <?=word_limiter($is_online_foody_order?$item['product_name']:$item['code']. ' - '. $item['product_name'], 100, '..')?></span>
					<?php if ($item['total_sub_items']):?>
						<div class="sub_product">
							<p style="margin-bottom: 0; font-size: 11px;"><?php foreach($item['sub_items'] as $sub_item): ?><span><?=$sub_item['product_name']?><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?></p>
						</div>
					<?php endif;?>
                    <?php if ($item['box_items']):?>
                        <div class="sub_product">
                            <p style="margin-bottom: 0; font-size: 11px;"><?php foreach($item['box_items'] as $box_item):?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <?=$box_item['product_name']?><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?></p>
                        </div>
                    <?php endif;?>
					<?php if ($item['description']):?>
						<div class="order_item_description printing">
							<p style="margin-bottom: 0; font-size: 11px;">-- <?=$item['description']?></p>
						</div>
					<?php endif;?>
					<div style="font-size: 10px;">
						<div style="text-align: center;font-size: 9px;">-----<?=DOMAIN_NAME?>-----</div>
						<div class="order_item_description"><span style="float: left;"><?=$code?></span><span class="delivery_datetime" style="float: right;"><?=($i+1).'/'.formatQuantity($item['quantity'])?></span></div>
					</div>
				</div>
				<?php
						endfor;
					endforeach;
				?>
			</div>
		</div>
	</div>
</div>
<div class="jar_loading" style="width: 100px;margin: 10% auto 0;">
	<img width="100" src="<?=SITE_URL?>images/jar_loading.gif" />
</div>
<div id="loading" class="hidden">
	<img src="<?=SITE_URL?>images/loading.gif" border="0" width="64" height="64" alt="Đang thực hiện, vui lòng chờ." />
</div>
<script src="<?=SITE_URL?>js/jquery.min.js"></script>
<script src="<?=SITE_URL?>js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=SITE_URL?>js/bootstrap-datetimepicker/moment-with-locales.min.js"></script>
<script src="<?=SITE_URL?>js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="<?=SITE_URL?>js/ie10-viewport-bug-workaround.js"></script>
<script src="<?=SITE_URL?>js/angular.min.js"></script>
<script src="<?=SITE_URL?>js/directives.js<?='?v='.VERSION?>"></script>
<script src="<?=SITE_URL?>js/filters.js<?='?v='.VERSION?>"></script>
<script src="<?=SITE_URL?>js/services.js<?='?v='.VERSION?>"></script>
<script src="<?=SITE_URL?>js/print.js<?='?v='.VERSION?>"></script>
</body>
</html>
