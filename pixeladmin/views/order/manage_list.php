                <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-orderlist">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th style="max-width: 350px;">Khách hàng</th>
                            <th>KC</th>
                            <th style="width: 150px;">Nơi giao hàng</th>
                            <th style="width: 120px;" class="not_filter">Tình trạng</th>
                            <th style="width: 120px;" class="not_filter">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($orders): ?>
                            <?php  
                                foreach($orders as $item):
                                    $code = $item['code']?$item['code']:$item['id'];
                                    $booking_info = $item['shipping_info']?json_decode($item['shipping_info']):null;
                                    $delivery_date = $item['delivery_date']?$item['delivery_date']:$item['created_dtm'];
                                    $pickup_time = $item['pickup_time']?$item['pickup_time']:$delivery_date;
                                    $is_tomorrow = strtotime(date('Y-m-d', strtotime($delivery_date))) > strtotime(date('Y-m-d'));
	                                $last_modified_dtm = Orders::get_last_modified_order_items($item['id']);
                                    $is_recent_order = $last_modified_dtm?strtotime($last_modified_dtm . ' + 5 minutes') >= time():false;
	                                $branch_id = getvalue($item, 'branch_id');
	                                if ($branch_id){
		                                $branch_lat = isset($branches[$branch_id])?$branches[$branch_id]['lat']:DEFAULT_LAT;
		                                $branch_lng = isset($branches[$branch_id])?$branches[$branch_id]['lng']:DEFAULT_LNG;
	                                }else{
		                                $branch_lat = DEFAULT_LAT;
		                                $branch_lng = DEFAULT_LNG;
	                                }

                            ?>

                        <tr class="branch_<?=getvalue($item, 'branch_id', 'all')?> type_<?=getvalue($item, 'type_id')?> <?=$is_recent_order?'recent':''?>" id="<?=$item['id']?>">
                            <?php if (getvalue($item, 'hide_on_management_screen')):?>
                            <td colspan="6">
                                <?=$is_tomorrow?'<span style="color: red;">[NGÀY MAI]</span>':''?>
	                            <?=$is_recent_order?'<span style="color: red;">Cập nhật '.getTimeDiffInMinutes($item['modified_dtm']).' phút trước</span><br/>':''?>
	                            <a class="order_code" target="_blank" href="<?=ROOT_URL. 'in/'.$code?>"><?=$code?></a>
	                            <?="SL: <b>".formatQuantity($item['quantity']).'</b> - Tổng: <b>'.number_format($item['total'], 3, '.', '.').'đ</b>'?>
                                Lấy hàng lúc: <b><?=date('d/m H:i', strtotime($pickup_time))?></b><br/>
                                Giao lúc: <b><?=date('d/m H:i', strtotime($delivery_date))?></b>
                                <?php if($booking_info):?>- ĐC: <?=get_booking_address($booking_info)?><?php endif;?> -
                                <?php echo '<span style="font-size: 1.2em;font-weight: bold;">'.get_status_string(getvalue($item, 'status')).'</span> ('.($item['shipper_name']?$item['shipper_name']:'<span style="color: red;">'.(getvalue($item, 'need_customer_details')?'Chưa chọn shipper':getvalue($item, 'type_name')).'</span>').')'; ?>
                                <button title="Hiển thị" class="btn btn-info show_on_management_screen"><i class="fa fa-eye"></i> Hiển thị</button>
                            </td>
                            <?php else:?>
                            <td class="center">
                                <?=$is_tomorrow?'<span style="color: red;">[NGÀY MAI]</span><br/>':''?>
	                            <?=$is_recent_order?'<span style="color: red;">Cập nhật '.getTimeDiffInMinutes($item['modified_dtm']).' phút trước</span><br/>':''?>
	                            <a class="order_code" target="_blank" href="<?=ROOT_URL. 'in/'.$code?>"><?=$code?></a><br />
	                            <?="SL: <b>".formatQuantity($item['quantity']). '</b>'.(getvalue($item, 'need_customer_details')?(' - Ship: <b>'. ($item['shipping_fee']?$item['shipping_fee'].'.000đ':'0đ').'</b>'):'').' - Tổng: <b>'.number_format($item['total'], 3, '.', '.').'đ</b>'?>
                                <br/>Lấy hàng lúc: <b><?=date('d/m H:i', strtotime($pickup_time))?></b>
                                <br/>Giao lúc: <b><?=date('d/m H:i', strtotime($delivery_date))?></b>
                            </td>
                            <td style="word-wrap: break-word;">
                                <?php if($booking_info):?>
                                    <?php if (isset($booking_info->fullname)):?>
                                    <?=$booking_info->fullname?>,
                                        <?php if (!empty($booking_info->lat)):?>
                                        <input type="hidden" id="lat_<?=$item['id']?>" value="<?=$booking_info->lat?>" />
                                        <input type="hidden" id="lng_<?=$item['id']?>" value="<?=$booking_info->lng?>" />
                                        <a target="_blank" href="http://maps.google.com/maps?f=d&saddr=<?=$branch_lat?>,<?=$branch_lng?>&daddr=<?=$booking_info->lat?>,<?=$booking_info->lng?>"><?=get_booking_address($booking_info)?></a>
                                        <?php else:?>
                                            <?=get_booking_address($booking_info)?>
                                        <?php endif;?>
                                    <?=!empty($booking_info->mobile)?' - '.$booking_info->mobile:''?>
                                    <?php endif;?>
                                <?php else:?>
	                                <?php echo getvalue($item, 'table_name')?getvalue($item, 'table_name'):''?>
                                <?php endif;?>
	                            <?php if ($item['description']):?>
		                            <br />
		                            <b>Ghi chú: </b><br /><?=nl2br($item['description'])?>
	                            <?php endif;?>
	                            <?php if(!empty($item['efruit_note'])):?>
									<br />
		                            <b>Nội bộ: </b><br /><?=nl2br($item['efruit_note'])?>
	                            <?php endif;?>
                            </td>
                            <td class="center">
                                <?php echo isset($booking_info->distance)?$booking_info->distance.'km':'N/A'?>
                                <span class="nearby"></span>
                            </td>
                            <td class="center">
                                <?php if (Users::can('view_all', 'order') && count($branches) > 1):?>
                                    <?php if (!$branch_id) echo '<div style="color: red;margin: 5px 0;">Chưa chọn cửa hàng</div>'; ?>
                                <?php echo html_select($branches, 'id', 'branch_name', 'class="branch form-control"', '-- Chọn', $branch_id)?>
                                <?php endif; ?>
                                <?php if (getvalue($item, 'need_customer_details') == 0): ?>
                                    <b><?=getvalue($item, 'type_name')?></b>
                                <?php else:?>
                                <div style="margin: 5px 0;">Nhân viên giao:</div>
                                <?php echo html_select_shipper('fullname', 'class="shipper form-control" style="margin-bottom: 5px;"', '-- Chọn', getvalue($item, 'shipper_id'))?>
	                                <div id="service_fee_container_<?=$item['id']?>" class="input-group" <?=$item['shipper_type_id'] == SHIP_SERVICE_TYPE_ID?'':'style="display: none;"'?>>
		                                <span class="input-group-addon">Phí</span>
		                                <input id="service_fee_<?=$item['id']?>" type="text" style="width: 80px;display:" value="<?=getvalue($item, 'service_fee', 0)*1000?>" class="service_fee form-control" data-order-id="<?=$item['id']?>"/>
	                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="center">
                                <div style="font-size: 1em;font-weight: bold;"><?=get_status_string(getvalue($item, 'status'))?></div>
                            </td>
                            <td class="center actions">
                                <div class="controls">
                                    <?php /*<a href="#" title="Ẩn khỏi danh sách" class="hide_from_list">Ẩn</a>&nbsp;|&nbsp; */ ?>
                                    <a href="#" title="Rút gọn" class="hide_on_management_screen">Rút gọn</a>&nbsp;&nbsp;
                                </div>
                                <?php
                                    $status = getvalue($item, 'status');
                                    if ($status){
                                        switch($status){
                                            case 'Pending':
                                                echo '<button class="btn btn-info" data-target="Wait for Staff Confirm"><i class="fa fa fa-phone"></i> Đã xác nhận</button><br/>';
                                                break;
	                                        case 'Wait for Staff Confirm':
		                                        echo '<button class="btn btn-info" data-target="In Process"><i class="fa fa fa-phone"></i> Nhân viên xác nhận</button><br/>';
	                                        	break;
                                            case 'In Process':
                                            	echo '<button class="btn btn-info" data-target="Process Completed"><i class="fa fa fa-gift"></i> Xong thành phẩm</button><br/>';
                                                break;
                                            case 'Process Completed':
	                                            if (getvalue($item, 'need_customer_details'))
		                                            echo '<button class="btn btn-info" data-target="Shipping"><i class="fa fa fa-bicycle"></i> Đang giao</button><br/>';
												else
													echo '<button title="Đóng đơn hàng" class="btn btn-success" data-target="Completed"><i class="fa fa fa-check"></i> Hoàn tất</button><br/>';
                                                break;
                                            case 'Shipping':
                                                echo '<button title="Đơn hàng đã giao" class="btn btn-success" data-target="Completed"><i class="fa fa fa-check"></i> Đã giao</button><br/>';
                                        }
                                    }
                                ?>
                            </td>
                            <?php endif;?>
                        </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>