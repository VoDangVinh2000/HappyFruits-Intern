<?php
    if(!empty($order)):
        $customer = json_decode($order['shipping_info']);
        if(empty($class))
            $class = 'col-md-10 col-xs-12 col-md-offset-1';
?>
    <div class="row">
        <div class="<?=$class?>">
            <p class="text-center">
                <span class="efruit-vi badge"><?=date('d/m/Y', strtotime($order['delivery_date']))?></span>
                <span class="efruit-en efruitjs badge"><?=date('M d, Y', strtotime($order['delivery_date']))?></span>
                <span class="badge <?=get_id(getvalue($order, 'status'))?>" bind-translate="<?=get_status_string(getvalue($order, 'status'))?>"><?=get_status_string(getvalue($order, 'status'))?></span>
            </p>
            <?php if(!empty($show_buttons)):?>
            <p class="text-center">
                <?php if (empty($order['is_locked']) && can_edit_order($order)):?>
                    <a target="_blank" class="btn btn-sm btn-danger" href="/vi/sua-don-hang/<?=getvalue($order, 'code', $order['id'])?>" bind-translate="Sửa đơn hàng">Sửa đơn hàng</a>
                <?php endif;?>
                <?php if ($order['status'] == 'Completed'):?>
                    <a target="_blank" class="btn btn-sm btn-success" href="/vi/danh-gia/<?=getvalue($order, 'code', $order['id'])?>" bind-translate="Đánh giá đơn hàng">Đánh giá đơn hàng</a>
                <?php endif;?>
            </p>
            <?php endif;?>
        </div>
    </div>
    <div class="row">
        <div class="<?=$class?>" >
            <?php if(!empty($order_items)):?>
                <div class="order-list row"  >
                    <?php foreach($order_items as $item):?>
                        <div class="order-item">
                            <span class="order-item-number fw-bold">Số lượng : <?=formatQuantity($item['quantity'])?></span>
                            <div class="order-item-info">
                                <div class="order-item-name">
                                    <span class="txt-bold">
                                        <span class="efruit-vi text-center"><?=$item['code'].' - '.$item['product_name']?></span>
                                        <span class="efruit-en efruitjs"><?=$item['code'].' - '.$item['product_english_name']?></span>
                                        &nbsp;
                                    </span>
                                    <?php if ($item['total_sub_items']):?>
                                        <span class="note-toping">
                                            [<?php foreach($item['sub_items'] as $sub_item):?><span><span class="efruit-vi"><?=$sub_item['product_name']?></span><span class="efruit-en efruitjs"><?=$sub_item['product_english_name']?></span><?=$sub_item == end($item['sub_items'])?'':', '?></span><?php endforeach; ?>]
                                        </span>
                                    <?php endif;?>
                                </div>
                                <?php if ($item['box_items']):?>
                                    <span class="order-item-note">
                                        <?php foreach($item['box_items'] as $box_item):?><span><?=formatQuantity($box_item['quantity'])?><?=$box_item['unit']?> <span class="efruit-vi"><?=$box_item['product_name']?></span><span class="efruit-en efruitjs"><?=$box_item['product_english_name']?></span><?=$box_item == end($item['box_items'])?'':', '?></span><?php endforeach; ?>
                                    </span>
                                <?php endif;?>
                                <?php if ($item['description']): ?>
                                    <div class="order-item-note">
                                        <span><?=$item['description']?></span>
                                    </div>
                                <?php endif;?>
                            </div>
                            <div class="order-item-price"><?=number_format($item['final_price']*$item['quantity'], 3, '.', '.')?><sup>đ</sup></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif;?>
            <div class="row mt10">
                <div class="col-md-2 col-sm-2"><span bind-translate="Tổng cộng">Tổng cộng</span> <span class="txt-bold font16"><?=formatQuantity($order['quantity'])?></span> <span bind-translate="phần">phần</span></div>
                <div class="col-md-2 col-sm-2 fw-bold"><?=number_format($order['subtotal'],3,'.','.')?><sup>đ</sup></div>
            </div>
            <?php if($order['discount'] > 0):?>
                <div class="row mt10">
                    <div class="col-md-2 col-sm-2"><span bind-translate="Chiết khấu">Chiết khấu</span><?=!empty($order['promotion_code'])?' ('.$order['promotion_code'].')':' ('.round($order['discount']/$order['subtotal']*100).'%)'?></div>
                    <div class="col-md-2 col-sm-2 fw-bold"><?=$order['discount']>0?('-'.number_format($order['discount'], 3, '.', '.')):'0'?><sup>đ</sup></div>
                </div>
            <?php endif;?>
            <?php if($order['VAT'] > 0):?>
                <div class="row mt10">
                    <div class="col-md-2 col-sm-2">VAT (<?=$order['VAT']*100?>%)</div>
                    <div class="col-md-2 col-sm-2 fw-bold"><?=number_format($order['VAT']*($order['subtotal']-$order['discount']), 3, '.', '.')?><sup>đ</sup></div>
                </div>
            <?php endif;?>
            <?php if($order['shipping_fee']):?>
                <div class="row mt10">
                    <div class="col-md-2 col-sm-2"><span bind-translate="Phí giao hàng">Phí giao hàng</span>&nbsp;<span class="distance green-text"></span></div>
                    <div class="col-md-2 col-sm-2 fw-bold"><?=number_format($order['shipping_fee'], 3, '.', '.')?><sup>đ</sup></span></div>
                </div>
            <?php endif;?>
            <div class="row mt10 mb10">
                <div class="col-md-2 col-sm-2 fs-5"><span bind-translate="Tổng cộng">Tổng cộng</span></div>
                <div class="col-md-2 col-sm-2 fw-bold fs-5"><?=number_format($order['total'], 3, '.', '.')?><sup>đ</sup></div>
            </div>

            <?php if($order['description']):?>
                <div>
                    <h2 bind-translate="Ghi chú">Ghi chú</h2>
                    <p><?=nl2br($order['description'])?></p>
                </div>
            <?php endif; ?>
            <?php if($order['is_prepaid']):?>
                <?php if($order['payment_method']!='pay_later' && $order['payment_method']!='other'): ?>
                    <h2 class="bold efruitjs">{{ __('<?=get_payment_method_string($order['payment_method'])?>') }} <span class="glyphicon glyphicon-ok"></span></h2>
                <?php endif;?>
            <?php elseif($order['payment_date']):?>
                <h2 class="bold">{{ __('Thanh toán sau, vào ngày') }} <?=date('d/m/Y', strtotime($order['payment_date']))?>.</h2>
            <?php endif;?>
            <?php if ($customer && !empty($show_extra)):?>
                <div class="clear"></div><br/>
                <?php if (!empty($customer->booker_mobile) && $customer->booker_mobile != $customer->mobile): ?>
                    <h2 bind-translate="Thông tin người đặt">Thông tin người đặt</h2>
                    <p>
                        <span class="bold" bind-translate="Họ và tên">Họ và tên</span>: <?=$customer->booker_fullname?><br/>
                        <span class="bold" bind-translate="SĐT">SĐT</span>: <?=$customer->booker_mobile?><br/>
                        <?php if (!empty($customer->message_to_receiver)): ?>
                        <span class="bold" bind-translate="Thông điệp gửi người nhận">Thông điệp gửi người nhận</span>: <?=$customer->message_to_receiver?>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>
                <h2 bind-translate="Thông tin giao hàng">Thông tin giao hàng</h2>
                <p>
                    <span class="bold" bind-translate="Họ và tên">Họ và tên</span>: <?=$customer->fullname?><br/>
                    <span class="bold" bind-translate="SĐT">SĐT</span>: <?=$customer->mobile?><br/>
                    <span class="bold" bind-translate="Địa chỉ">Địa chỉ</span>: <?=!empty($customer->place)?"$customer->place, ":''?><?=$customer->address?><?=!empty($customer->ward)?", phường $customer->ward":''?><?=!empty($customer->district)?", quận $customer->district":''?>
                    <?php if (!empty($customer->lat) && !empty($customer->lng)):?>
                        <br />
                        <a target="_blank" id="view_map" href="http://maps.google.com/maps?f=d&saddr=<?=$main_branch['lat']?>,<?=$main_branch['lng']?>&daddr=<?=$customer->lat?>,<?=$customer->lng?>"><span bind-translate="Xem trên Google Map">Xem trên Google Map</span></a>
                    <?php endif;?>
                    <?php if (!empty($customer->building)):?><br/><span class="bold" bind-translate="Tòa nhà">Tòa nhà</span>: <?=$customer->building?><?php endif; ?>
                </p>
                <?php if(!empty($customer->ex_description) || !empty($customer->description)):?>
                <p>
                    <span class="bold" bind-translate="Ghi chú">Ghi chú</span>:
                    <?=nl2br(!empty($customer->description)?$customer->description:$customer->ex_description)?>
                </p>
                <?php endif;?>
                <?php if(!empty($customer->company_name) && !empty($customer->company_address)):?>
                    <br/>
                    <h2 bind-translate="Thông tin hóa đơn">Thông tin hóa đơn</h2>
                    <p>
                        <span class="bold" bind-translate="Tên công ty">Tên công ty</span>: <?=$customer->company_name?><br/>
                        <span class="bold" bind-translate="Mã số thuế">Mã số thuế</span>: <?=!empty($customer->company_tax_code)?$customer->company_tax_code:''?><br/>
                        <span class="bold" bind-translate="Địa chỉ công ty">Địa chỉ công ty</span>: <?=$customer->company_address?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>