<?php
global $models;
$order = $models->order->select_one(array('code' => $code));
if (!$order)
    $error_msg = 'Mã đơn hàng không chính xác.';
if (empty($error_msg))
{
    $order_items = $models->order->get_full_order_items($order, $error_msg);
    if (empty($error_msg))
    {
        $customer = json_decode($order['shipping_info']);
        $data = array();
        $data['order'] = $order;
        $data['customer'] = $customer;
        extract($data);
    }
}
if (empty($error_msg)):
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
    <html>
    <head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head>
    <body>
    <p>Chào bạn,</p>
    <p><?=get_setting('short_site_name')?> gửi bạn thông tin đơn hàng đã đặt, bạn có thể sửa lại đơn hàng tại <a href="<?=ROOT_URL?>sua/<?=$code?>">đây</a>.</p>
    <?=get_booker_details($customer) ?>
    <p><b style="font-size: 20px;">Thông tin giao hàng</b><br/>
        Thời gian giao hàng: <?=date('H:i d/m/Y', strtotime($order['delivery_date']))?><br />
        Tên người nhận: <?=$customer->fullname?><br/>
        Địa chỉ: <?=get_booking_address($customer)?><?=!empty($customer->distance)?" ({$customer->distance}km)":''?><br />
        Số điện thoại: <?=$customer->mobile?><br />
        Email: <?=$customer->email?>
        <?php if($order['is_prepaid']):?>
            <br/><b>Đã thanh toán.</b>
        <?php elseif($order['payment_date']):?>
            <br/><b>Thanh toán sau, vào ngày <?=date('d/m/Y', strtotime($order['payment_date']))?>.</b>
        <?php endif;?>
    </p>
    <?php
    $des = $description;
    if (!empty($customer->description))
    {
        if ($des)
            $des .= '<br/>---<br/>';
        $des .= $customer->description;
    }
    if ($des):
        ?>
        <p><b style="font-size: 20px;">Ghi chú</b><br/>
            <?php echo str_replace("\n",'<br/>', $des);?>
        </p>
    <?php endif; ?>
    <?php if(!empty($customer->company_name) && !empty($customer->company_address)):?>
        <p><b style="font-size: 20px;">Thông tin hóa đơn</b><br/>
            Tên công ty: <?=$customer->company_name?><br />
            MST: <?=!empty($customer->company_tax_code)?$customer->company_tax_code:''?><br/>
            Địa chỉ công ty: <?=$customer->company_address?><br/>
            <i style="font-style: italic;">Hóa đơn điện tử được gửi vào buổi tối cuối ngày sau khi đơn hàng giao hoàn thành. Quý khách vui lòng kiểm tra hộp mail (hoặc spam) để nhận hóa đơn.</i>
        </p>
    <?php endif; ?>
    <p><b style="font-size: 20px;">Thông tin đơn hàng - <?=$code?></b></p>
    <table cellspacing="0" cellpadding="0" style="border-collapse: collapse;border-spacing: 0;">
        <thead>
        <tr>
            <th style="border: 1px solid #888;padding: 5px 10px;">Nhóm hàng</th>
            <th style="border: 1px solid #888;padding: 5px 10px;">Tên món</th>
            <th style="border: 1px solid #888;padding: 5px 10px;">SL</th>
            <th style="border: 1px solid #888;padding: 5px 10px;">Giá</th>
            <th style="border: 1px solid #888;padding: 5px 10px;">Thành tiền</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($order_items as $item):
            ?>
            <tr>
                <td style="border: 1px solid #888;padding: 5px 10px;"><?=$item['category_name']?></td>
                <td style="border: 1px solid #888;padding: 5px 10px;">
                    <span><?=(!empty($item['code'])?$item['code']. ' - ':'').$item['product_name']?></span>
                    <?php if ($item['total_sub_items']):?>
                        <div style="font-size: 12px;font-style: italic;">
                            <p>&nbsp;<?php foreach($item['sub_items'] as $sub_item): ?><span><?=$sub_item['product_name']?><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?></p>
                        </div>
                    <?php endif;?>
                    <?php if ($item['box_items']):?>
                        <div style="font-size: 12px;font-style: italic;">
                            <p>&nbsp;<?php foreach($item['box_items'] as $box_item): ?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <?=$box_item['product_name']?><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?></p>
                        </div>
                    <?php endif;?>
                </td>
                <td style="border: 1px solid #888;padding: 5px 10px;"><?=$item['quantity']?></td>
                <td style="border: 1px solid #888;padding: 5px 10px;"><?=number_format($item['final_price'], 3, '.', '.')?><sup>đ</sup></td>
                <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;"><?=number_format($item['final_price']*$item['quantity'], 3, '.', '.')?><sup>đ</sup></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Tổng</td>
            <td style="border: 1px solid #888;padding: 5px 10px;"><?=$order['quantity']?></td>
            <td style="border: 1px solid #888;padding: 5px 10px;">&nbsp;</td>
            <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;"><?=number_format($order['subtotal'], 3, '.', '.')?><sup>đ</sup></td>
        </tr>
        <?php if($order['discount'] > 0):?>
            <tr>
                <td colspan="4" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Chiết khấu<?=!empty($order['promotion_code'])?' (Mã KM '.$order['promotion_code'].')':''?></td>
                <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;"><?=$order['discount']>0?('-'.number_format($order['discount'], 3, '.', '.')):'0'?><sup>đ</sup></td>
            </tr>
        <?php endif; ?>
        <?php if($order['VAT'] > 0):?>
            <tr>
                <td colspan="4" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">VAT(<?=$order['VAT']*100?>%)</td>
                <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;"><?=number_format($order['VAT']*($order['subtotal']-$order['discount']), 3, '.', '.')?><sup>đ</sup></td>
            </tr>
        <?php endif; ?>
        <?php if($order['shipping_fee']):?>
            <tr>
                <td colspan="4" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Phí giao hàng</td>
                <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;"><?=number_format($order['shipping_fee'], 3, '.', '.')?><sup>đ</sup></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="4" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Tổng cộng</td>
            <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;font-weight: bold;font-size:22px;"><?=number_format($order['total'], 3, '.', '.')?><sup>đ</sup></td>
        </tr>
        </tfoot>
    </table>
    <?php if(isset($order['payment_method'])):?>
    <p><b style="font-size: 20px;"><?=get_payment_method_string($order['payment_method'])?>.</b></p>
    <?php endif; ?>
    <p><?=get_setting('short_site_name')?> xin cảm ơn bạn đã đặt hàng.</p>
    <br />
    <p>
        <span style="font-size: 20px;font-weight: bold;line-height: 30px;"><?=get_setting('site_name')?></span><br />
        <b>Địa chỉ:</b> <?=getvalue($branch, 'branch_address')?><br />
        <b>Số điện thoại:</b> <?=getvalue($branch, 'phone_number')?><br />
        <b>Email:</b> <a href="mailto:info@<?=DOMAIN_NAME?>" style="text-decoration: none;">info@<?=DOMAIN_NAME?></a><br />
        <b>Website:</b> <a href="www.<?=DOMAIN_NAME?>" style="text-decoration: none;">www.<?=DOMAIN_NAME?></a>
    </p>
    </body>
    </html>
<?php endif;?>