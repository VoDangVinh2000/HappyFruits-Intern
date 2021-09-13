                        <?php
                            $hide = Users::can('edit', 'order') || Users::can('delete', 'order')?'':'style="display: none;"';
                            $total = 0;
                            $number_of_records = 0;
                        ?>
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-orderlist">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Loại</th>
	                                <th>SL</th>
	                                <th>Tổng</th>
	                                <th>Giảm</th>
                                    <th style="width: 50px;">Ngày</th>
                                    <th>Khách hàng</th>
                                    <th>VAT</th>
                                    <th class="not_filter" style="width: 30px;">Đã giao</th>
                                    <th <?=$hide?> class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($orders): ?>
                                    <?php
                                        foreach($orders as $item):
                                            $number_of_records++;
                                            $total += $item['total'];
                                            $code = $item['code']?$item['code']:$item['id'];
                                            $booking_info = json_decode($item['shipping_info']);
                                            $delivery_date = $item['delivery_date']?$item['delivery_date']:$item['created_dtm'];
                                    ?>
                                <tr id="<?=$item['id']?>">
                                    <td class="center">
	                                    <a target="_blank" href="<?=ROOT_URL. 'in/'.$code?>"><?=$code?></a>
	                                    <?php if($item['status'] == 'Failed'):?><br/>(Hủy)<?php endif; ?>
	                                </td>
                                    <td class="center"><?=$item['type_name']?></td>
	                                <td class="center"><?=$item['quantity']?></td>
	                                <td class="center" data-value="<?=$item['total']*1000?>"><?=number_format($item['total'], 3, '.', '.')?>đ</td>
	                                <td class="center"><?=$item['discount'] > 0?number_format($item['discount'], 3, '.', '.'):'0'?>đ</td>
                                    <td class="center" data-value="<?=strtotime($delivery_date)?>"><?=date('d/m H:i', strtotime($delivery_date))?></td>
                                    <td class="has_tooltip">
                                    <?php if (isset($booking_info->fullname)):?>
                                        <a target="_blank" href="<?=BASE_URL. $URIs['customers']?>/tim/<?=$item['customer_mobile']?>"><?=$booking_info->fullname?></a> <?=get_booking_address($booking_info)?>
	                                    <?php if(!empty($booking_info->mobile)):?>
		                                    - <a target="_blank" href="<?=BASE_URL. $URIs['orders']?>/tim/sdt-<?=$booking_info->mobile?>"><?=$booking_info->mobile?></a>
	                                    <?php endif;?>
                                        <?php if (Users::can('view_email', 'order') && !empty($booking_info->email)) {echo '<br/>Email: '.$booking_info->email;} ?>
                                        <?php if (!empty($booking_info->builiding)):?>
                                        <br />
                                        <b>Tòa nhà: </b><?=$booking_info->builiding?>
                                        <?php endif;?>
                                    <?php /*
	                                    <div class="efruit_note" data-pk="<?=$item['id']?>" data-type="textarea" data-toggle="manual" data-title="Nhập ghi chú" data-placement="top"><?=getvalue($item, 'efruit_note')?></div>
	                                    <a href="#" class="edit-note" data-id="<?=$item['id']?>"><i class="fa fa-pencil" style="padding-right: 5px"></i>[ghi chú]</a>
                                     */ ?>
                                    <?php endif;?>
                                    <?php if($item['payment_method'] != 'cod'):?>
                                    <div style="font-size: 90%;"><b><?=get_payment_method_string($item['payment_method'])?></b>&nbsp;<span class="glyphicon glyphicon-ok"></span></div>
                                    <?php endif;?>
                                    <?php if(is_numeric($item['score'])):?>
                                        <div>
                                        <?php for($i = 0; $i <= $item['score']; $i++):?>
                                            <i style="color: #ebc671;" class="fa fa-star fa-2x" aria-hidden="true"></i>
                                        <?php endfor; ?>
                                        </div>
                                        <?php if(!empty($item['feedback'])):?>
                                        <div><?=nl2br($item['feedback'])?></div>
                                        <?php endif;?>
                                    <?php endif;?>
                                    </td>
                                    <td class="center"><?=$item['VAT']>0?'Có':''?></td>
                                    <td class="center">
                                        <?php if ($item['need_customer_details'] && $item['status'] != 'Failed'):?>
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="is_shipped_<?=$item['id']?>" type="checkbox" value="1" class="is_shipped" <?=getvalue($item, 'is_shipped')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="is_shipped_<?=$item['id']?>">&nbsp;</label>
                                        </div>
                                        <?php endif;?>
                                    </td>
                                    <td <?=$hide?> class="center">
                                        <?php if (Users::can('edit', 'order')):?>
                                        <a target="_blank" href="<?=ROOT_URL.'sua/'. $item['code']?>" class="edit_item btn btn-sm btn-warning" title="Sửa"><i class="fa fa-edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (Users::can('delete', 'order')):?>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <input type="hidden" id="order_total" value="<?=number_format($total,3,'.','.')?>" />
                        <input type="hidden" id="number_of_records" value="<?=$number_of_records?>" />