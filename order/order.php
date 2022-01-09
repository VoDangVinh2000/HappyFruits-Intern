<?php
include("includes/order.inc.php");
$error_msg = '';
$is_prebook = 0;
$is_group = 0;
$code = get('code');
$order = $models->order->select_one(array('code' => $code, 'deleted' => 0));
if (!$order){
    $order = $models->order->get_details($code);
    if (!$order)
        $error_msg  = 'Mã đơn hàng không chính xác.';
    if (empty($error_msg) && $order['deleted'])
        $error_msg = 'Đơn hàng đã bị xóa. Vui lòng liên hệ admin.';
}
if (empty($error_msg))
{
    $order_items = $models->order->get_full_order_items($order, $error_msg);
    $branch = $models->branch->get_details($order['branch_id']);
    if (empty($error_msg))
    {
        $customer = json_decode($order['shipping_info']);
        $data = array();
        $data['order'] = $order;
        $data['order_items'] = $order_items;
        $data['customer'] = $customer;
        extract($data);
    }
    $created_date = substr($order['created_dtm'], 0, 10);
    $delivery_date = substr($order['delivery_date'], 0, 10);
    if (strtotime($delivery_date) > strtotime($created_date) && PRE_BOOKING_DISCOUNT == number_format($order['discount']/$order['subtotal'], 2)){
        $is_prebook = 1;
    }
    if(substr($code, 0, 1) == 'g')
        $is_group = 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="efruit" ng-controller="eFruitController as eFruit">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title ng-bind="<?="__('Đơn hàng') + ' - ".get_setting('site_name')."'"?>">Đơn hàng - <?=get_setting('site_name')?></title>

    <link rel="shortcut icon" href="<?=get_child_theme_assets_url()?>img/favicon.ico"/>
    <link rel="image_src" href="<?=get_child_theme_assets_url()?>img/main_logo.png" />

    <!-- Bootstrap core CSS -->
    <link href="<?=SITE_URL?>css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?=SITE_URL?>css/booking.css<?='?v='.VERSION?>" rel="stylesheet" />
    <style>h3{margin: 0;}</style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=SITE_URL?>js/html5shiv.min.js"></script>
    <script src="<?=SITE_URL?>js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 main">
            <?php if(empty($error_msg)):?>
                <div class="header_right hidden-xs">
                    {{__('Ngày cập nhật')}}: <?=date('d/m/Y H:i:s', strtotime($order['modified_dtm']))?>
                    <?php if (empty($order['is_shipped'])):?>
                        <a class="btn btn-danger" href="<?=ROOT_URL?>sua/<?=$code?>" >{{__('Đổi món')}}</a>
                    <?php endif;?>
                </div>
                <div class="hidden-sm hidden-md hidden-lg" style="text-align: right;font-size:10px;">
                    {{__('Ngày cập nhật')}}: <?=date('d/m/Y H:i:s', strtotime($order['modified_dtm']))?>
                    <?php if (empty($order['is_shipped']) && empty($order['is_locked'])):?>
                        <a class="btn btn-danger" href="<?=ROOT_URL?>sua/<?=$code?>" >{{__('Đổi món')}}</a>
                    <?php endif;?>
                </div>
            <?php endif ;?>
            <h1 class="page-header"><a href="<?=ROOT_URL_WITHOUT_SLASH?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;{{__('Đơn hàng')}} - <?=$code?></h1>
            <?php if($error_msg):?>
                <h3 class="sub-header">{{__('<?=$error_msg?>')}}</h3>
            <?php else:?>
                <div>
                    <h4 class="bold">{{__('Thông tin giao hàng')}}</h4>
                    <table class="col-sm-6 col-xs-12">
                        <tbody>
                        <tr><td style="min-width: 130px;">{{__('Tên khách hàng')}}</td><td><?=$customer->fullname?></td></tr>
                        <tr><td>{{__('Số điện thoại')}}</td><td><?=$customer->mobile?></td></tr>
                        <tr><td>{{__('Email')}}</td><td><?=$customer->email?></td></tr>
                        <tr><td>{{__('Địa chỉ')}}</td><td><?=$customer->address?></td></tr>
                        <tr><td>{{__('Khu vực')}}</td><td><?php if (!empty($customer->ward)):?>{{__('Phường')}} <?=$customer->ward?>, <?php endif; ?>{{__('Quận')}} <?=$customer->district?>
                                <?php if (!empty($customer->lat)):?>
                                    <?php if($branch):?>
                                        <a target="_blank" id="view_map" href="http://maps.google.com/maps?f=d&saddr=<?=$branch['lat']?>,<?=$branch['lng']?>&daddr=<?=$customer->lat?>,<?=$customer->lng?>">{{__('Xem đường đi')}}</a>
                                    <?php else: ?>
                                        <a target="_blank" id="view_map" href="http://maps.google.com/maps?f=d&saddr=10.773170,106.671384&daddr=<?=$customer->lat?>,<?=$customer->lng?>">{{__('Xem đường đi')}}</a>
                                    <?php endif; ?>
                                <?php endif;?>
                            </td></tr>
                        <tr><td>{{__('Thời gian giao hàng')}}</td><td><?=date('H:i d/m/Y', strtotime($order['delivery_date']))?></td></tr>
                        </tbody>
                    </table>
                    <div class="clear"></div><br />
                    <h4 class="bold">{{__('Đơn hàng')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="hidden-xs">{{__('Nhóm hàng')}}</th>
                                <th>{{__('Tên món')}}</th>
                                <th>{{__('SL')}}</th>
                                <th>{{__('Giá')}}</th>
                                <th class="hidden-xs">{{__('Thành tiền')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($order_items as $item):
                                ?>
                                <tr>
                                    <td class="hidden-xs"><span ng-show="settings.language != 'en'"><?=$item['category_name']?></span><span ng-show="settings.language == 'en'"><?=$item['category_english_name']?></span></td>
                                    <td ng-show="settings.language != 'en'">
                                        <span class="hidden-xs hidden-sm"><?=$item['code']. ' - '. $item['product_name']?></span>
                                        <span class="hidden-md hidden-lg"><?=break_line($item['product_name'])?></span>
                                        <?php if ($item['total_sub_items']):?>
                                            <div class="sub_product">
                                                <p><?php foreach($item['sub_items'] as $sub_item): ?><span><?=$sub_item['product_name']?><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?></p>
                                            </div>
                                        <?php endif;?>
                                        <?php if ($item['box_items']):?>
                                            <div class="sub_product">
                                                <p><?php foreach($item['box_items'] as $box_item):?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <?=$box_item['product_name']?><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?></p>
                                            </div>
                                        <?php endif;?>
                                        <?php if($is_group): ?>
                                            <div class="sub_product"><?=$item['description']?></div>
                                        <?php endif;?>
                                    </td>
                                    <td ng-show="settings.language == 'en'">
                                        <span class="hidden-xs hidden-sm"><?=$item['product_english_name']?></span>
                                        <span class="hidden-md hidden-lg"><?=break_line($item['product_english_name'])?></span>
                                        <?php if ($item['total_sub_items']):?>
                                            <div class="sub_product">
                                                <p><?php foreach($item['sub_items'] as $sub_item): ?><span><?=$sub_item['product_english_name']?><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?></p>
                                            </div>
                                        <?php endif;?>
                                        <?php if ($item['box_items']):?>
                                            <div class="sub_product">
                                                <p><?php foreach($item['box_items'] as $box_item):?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <?=$box_item['product_name']?><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?></p>
                                            </div>
                                        <?php endif;?>
                                        <?php if($is_group): ?>
                                            <div class="sub_product"><?=$item['description']?></div>
                                        <?php endif;?>
                                    </td>
                                    <td><?=formatQuantity($item['quantity'])?></td>
                                    <td><?=$item['final_price']?>.000<sup>đ</sup></td>
                                    <td class="hidden-xs"><?=$item['final_price']*$item['quantity']?>.000<sup>đ</sup></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                            <tfoot>
                            <tr class="total">
                                <td>{{__('Tổng')}}</td>
                                <td class="hidden-xs"></td>
                                <td><?=formatQuantity($order['quantity'])?></td>
                                <td class="hidden-xs"></td>
                                <td><?=number_format($order['subtotal'],3,'.','.')?><sup>đ</sup></td>
                            </tr>
                            <?php if($order['discount'] > 0):?>
                                <tr class="total">
                                    <td>{{__('Chiết khấu')}} <?=number_format($order['discount']/$order['subtotal']*100, 0)?>%<?=!empty($order['promotion_code'])?" ({{__('Áp dụng mã KM')}})":''?></td>
                                    <td class="hidden-xs"></td>
                                    <td></td>
                                    <td class="hidden-xs"></td>
                                    <td>-<?=number_format($order['discount'], 3, '.', '.')?><sup>đ</sup></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($order['VAT'] > 0):?>
                                <tr class="total">
                                    <td>VAT(<?=$order['VAT']*100?>%)</td>
                                    <td class="hidden-xs"></td>
                                    <td></td>
                                    <td class="hidden-xs"></td>
                                    <td><?=number_format($order['VAT']*$order['subtotal'], 3, '.', '.')?><sup>đ</sup></td>
                                </tr>
                            <?php endif; ?>
                            <tr class="total">
                                <td>{{__('Phí giao hàng')}} <?=!empty($customer->distance)?$customer->distance.'km':''?></td>
                                <td class="hidden-xs"></td>
                                <td></td>
                                <td class="hidden-xs"></td>
                                <td><?=$order['shipping_fee']?number_format($order['shipping_fee'], 3, '.', '.'):'0'?><sup>đ</sup></td>
                            </tr>
                            <tr class="total">
                                <td>{{__('Tổng cộng')}}</td>
                                <td class="hidden-xs"></td>
                                <td></td>
                                <td class="hidden-xs"></td>
                                <td><?=number_format($order['total'], 3, '.', '.')?><sup>đ</sup></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php if($order['description'] || !empty($customer->description)):?>
                        <div>
                            <h3 class="sub-header">{{__('Ghi chú')}}</h3>
                            <?php if($order['description']):?>
                                <p><?=str_replace("\n",'. ', $order['description'])?></p>
                            <?php endif;?>
                            <?php if(!empty($customer->description)):?>
                                <p><?=str_replace("\n",'. ', $customer->description)?></p>
                            <?php endif;?>
                        </div>
                    <?php endif;?>
                    <?php if(!empty($customer->company_name) && !empty($customer->company_address)):?>
                        <div class="clear"></div>
                        <table class="col-xs-12">
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
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
<script src="<?=SITE_URL?>js/jquery.min.js"></script>
<script src="<?=SITE_URL?>js/bootstrap.min.js"></script>
<script src="<?=SITE_URL?>js/angular.min.js"></script>
<script src="<?=SITE_URL?>js/jstorage.js"></script>
<script src="<?=SITE_URL?>js/bootstrap-multiselect.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=SITE_URL?>js/ie10-viewport-bug-workaround.js"></script>
<script src="<?=SITE_URL?>js/services.ef.js<?='?v='.VERSION?>"></script>
<script src="<?=SITE_URL?>js/order.js<?='?v='.VERSION?>"></script>
</body>
</html>
