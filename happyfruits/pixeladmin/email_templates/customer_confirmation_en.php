<?php
$order = $controller->Orders->select_one(array('code' => $code));
if (!$order)
    $error_msg = 'Your order code is invalid.';
if (empty($error_msg))
{
    $order_items = $controller->Orders->get_full_order_items($order, $error_msg);
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
    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
    <html>
    <head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head>
    <body>
    <p>Dear Sir/Madam,</p>
    <p>Thanks for your order, you can edit the order via this <a href="<?=frontend_url()?>sua-don-hang/<?=$code?>">link</a> (or <a href="<?=ROOT_URL?>sua/<?=$code?>">this link</a>).</p>
    <?=get_booker_details($customer, 'en') ?>
    <p><b style="font-size: 20px;">Shipping details</b><br/>
        <?php if(!empty($order['prebooking_discount'])):?>
            Expected delivery time: <?=date('H:i M jS Y', strtotime($order['delivery_date']))?><br />
        <?php endif;?>
        Receiver: <?=$customer->fullname?><br/>
        Address: <?=get_booking_address($customer, 'en')?><?=!empty($customer->distance)?" ({$customer->distance}km)":''?><br />
        Phone number: <?=$customer->mobile?><br />
        Email: <?=$customer->email?>
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
        <p><b style="font-size: 20px;">Description</b><br/>
            <?php echo str_replace("\n",'<br/>', $des);?>
        </p>
    <?php endif; ?>
    <?php if(!empty($customer->company_name) && !empty($customer->company_address)):?>
        <p><b style="font-size: 20px;">VAT Invoice Information</b><br/>
            Company name: <?=$customer->company_name?><br />
            Tax Identification Number : <?=!empty($customer->company_tax_code)?$customer->company_tax_code:''?><br/>
            Company address: <?=$customer->company_address?><br/>
            <i style="font-style: italic;">E-invoice will be sent to your email at the end of the day. Please check your inbox or your spam folder.</i>

        </p>
    <?php endif; ?>
    <p><b style="font-size: 20px;">Order details - <?=$code?></b></p>
    <table cellspacing="0" cellpadding="0" style="border-collapse: collapse;border-spacing: 0;">
        <thead>
        <tr>
            <th style="border: 1px solid #888;padding: 5px 10px;">Category</th>
            <th style="border: 1px solid #888;padding: 5px 10px;">Name</th>
            <th style="border: 1px solid #888;padding: 5px 10px;">Qty</th>
            <th style="border: 1px solid #888;padding: 5px 10px;">Price</th>
            <th style="border: 1px solid #888;padding: 5px 10px;">Total amount</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($order_items as $item):
            ?>
            <tr>
                <td style="border: 1px solid #888;padding: 5px 10px;"><?=$item['category_english_name']?></td>
                <td style="border: 1px solid #888;padding: 5px 10px;">
                    <span><?=(!empty($item['code'])?$item['code']. ' - ':'').$item['product_english_name']?></span>
                    <?php if ($item['total_sub_items']):?>
                        <div style="font-size: 12px;font-style: italic;">
                            <p>&nbsp;<?php foreach($item['sub_items'] as $sub_item): ?><span><?=$sub_item['product_english_name']?><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?></p>
                        </div>
                    <?php endif;?>
                    <?php if ($item['box_items']):?>
                        <div style="font-size: 12px;font-style: italic;">
                            <p>&nbsp;<?php foreach($item['box_items'] as $box_item): ?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <?=$box_item['product_english_name']?><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?></p>
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
            <td colspan="2" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Subtotal</td>
            <td style="border: 1px solid #888;padding: 5px 10px;"><?=$order['quantity']?></td>
            <td style="border: 1px solid #888;padding: 5px 10px;">&nbsp;</td>
            <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;"><?=number_format($order['subtotal'], 3, '.', '.')?><sup>đ</sup></td>
        </tr>
        <?php if($order['discount']):?>
            <tr>
                <td colspan="4" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Discount</td>
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
                <td colspan="4" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Shipping fee</td>
                <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;"><?=number_format($order['shipping_fee'], 3, '.', '.')?><sup>đ</sup></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="4" style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Total</td>
            <td style="text-align: right;border: 1px solid #888;padding: 5px 10px;font-weight: bold;font-size:22px;"><?=number_format($order['total'], 3, '.', '.')?><sup>đ</sup></td>
        </tr>
        </tfoot>
    </table>
    <?php if(isset($order['payment_method']) && ($order['payment_method'] == 'bank' || $order['payment_method'] == 'moca' || $order['payment_method'] == 'zalopay' || $order['payment_method'] == 'vnpay')):?>
        <p>
            <b style="font-size: 20px;">
                Payment method: <?=$order['payment_method']=='bank'?'Banking':''?><?=$order['payment_method']=='moca'?'Via Moca':''?><?=$order['payment_method']=='zalopay'?'Via Zalo Pay':''?><?=$order['payment_method']=='vnpay'?'Via VN Pay':''?>
            </b>
        </p>
    <?php endif; ?>
    <p>Thank you for ordering with us.</p>
    <br />
    <p>
        <span style="font-size: 20px;font-weight: bold;line-height: 30px;"><?=get_setting('english_site_name')?></span><br />
        <b>Address:</b> <?=getvalue($branch, 'en_address', $branch['branch_address'])?><br />
        <b>Phone:</b> <?=getvalue($branch, 'phone_number')?><br />
        <b>Email:</b> <a href="mailto:info@<?=DOMAIN_NAME?>" style="text-decoration: none;">info@<?=DOMAIN_NAME?></a><br />
        <b>Website:</b> <a href="www.<?=DOMAIN_NAME?>" style="text-decoration: none;">www.<?=DOMAIN_NAME?></a>
    </p>
    </body>
    </html>
<?php endif;?>