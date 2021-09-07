<?php
$pre_order_time = env('PREORDER_TIME', array(
    'start' => '08:00',
    'end' => '21:30'
));
$this->load_partial('product-modals');
?>
<style>
    form#frmOrder label.error {
        display: none !important;
    }
</style>
<div role="dialog" tabindex="-1" class="modal fade in" id="modal-notices" aria-hidden="false">
    <div class="modal-dialog normal-dialog">
        <div class="modal-content" style="background: rgba(56,56,56,0.8);">
            <div class="modal-header" style="background: none;padding: 0;">
                <button style="margin: 0 5px 0;color: #fff;" aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <?php
                if (!empty($announcements)) :
                    foreach ($announcements as $ann) :
                        if (($ann['start_dtm'] && strtotime($ann['start_dtm']) > time())
                            || ($ann['end_dtm'] && strtotime($ann['end_dtm']) < time())
                        )
                            continue;
                ?>
                        <div class="message row<?= $ann['temporary_close'] ? ' close-temporary' : '' ?>">
                            <?php if ($ann['image']) : ?>
                                <div class="col-md-6"><img loading="lazy" alt="hinh-thong-bao" style="width: 100%;" src="<?= valid_url($ann['image']) ?>" /><br /><br /></div>
                                <div class="col-md-6">
                                    <div class="efruit-vi"><?= $ann['content'] ?></div>
                                    <div class="efruit-en"><?= $ann['content_en'] ?></div>
                                </div>
                            <?php else : ?>
                                <div class="col-md-12">
                                    <div class="efruit-vi"><?= $ann['content'] ?></div>
                                    <div class="efruit-en"><?= $ann['content_en'] ?></div>
                                </div>
                            <?php endif; ?>
                            <?php if ($ann['start_dtm']) : ?>
                                <input type="hidden" class="starttime" value="<?= strtotime($ann['start_dtm']) ?>" />
                            <?php endif; ?>
                            <?php if ($ann['end_dtm']) : ?>
                                <input type="hidden" class="endtime" value="<?= strtotime($ann['end_dtm']) ?>" />
                            <?php endif; ?>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
                <?php
                global $is_off;
                if (!empty($is_off)) :
                ?>
                    <div class="message row close-everyday">
                        <div class="col-md-4"><img loading="lazy" alt="we-are-closed" style="width: 100%;" src="<?= get_theme_assets_url() ?>img/closed.png" /></div>
                        <div class="col-md-8">
                            <h2 style="color: #51bd36;font-weight: bold;" class="modal-title">{{__('Hiện ngoài giờ phục vụ.')}}</h2>
                            <p>{{__('Giờ mở cửa:')}} 8h - 22h<br />{{__('Giờ giao hàng:')}} 8h30 - 21h30
                            </p>
                            <p>{{__('Quý khách có nhu cầu đặt online vui lòng ghi chú giờ hẹn giao đến.')}}<br />
                                {{__('Chúng tôi sẽ kiểm tra và liên lạc sớm nhất.')}}<br />
                                {{__('Chân thành cảm ơn.')}}
                            </p>
                        </div>
                    </div>
                <?php else : ?>
                    <?php
                    $period = get_setting('overload_in_period');
                    if (!empty($period) && strtotime($period) > time()) :
                    ?>
                        <div class="message row">
                            <div class="col-md-4"><img loading="lazy" alt="we-are-overload" style="width: 100%;" src="<?= get_theme_assets_url() ?>img/overload.jpg" /></div>
                            <div class="col-md-8">
                                <h2 style="color: #51bd36;font-weight: bold;" class="modal-title">{{__('Cửa hàng hiện đang quá tải dịch vụ.')}}</h2>
                                <p>{{__('Để đảm bảo dịch vụ cửa hàng xin phép tạm ngưng nhận đơn hàng.')}}
                                    <br />{{__('Quý khách có thể đặt món trước và được phục vụ sau')}} <span style="color: red;"><?php echo date('H', strtotime($period)) ?>:<?php echo date('i', strtotime($period)) ?></span>
                                </p>
                                <p>{{__('Xin chân thành cảm ơn và mong quý khách thông cảm.')}}<br />
                                    {{__('Thương chúc an vui.')}}
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div role="dialog" tabindex="-1" class="modal fade in" data-backdrop="static" id="modal-pre-booking" aria-hidden="false">
    <div class="modal-dialog normal-dialog">
        <div class="modal-content" style="background: rgba(56,56,56,0.8);">
            <div class="modal-body">
                <div class="message row">
                    <div class="col-md-4" style="text-align: center;"><img loading="lazy" alt="discount" src="<?= get_theme_assets_url() ?>img/discount.png" style="width: 100%;max-width: 200px;" /></div>
                    <div class="col-md-8">
                        <h2 class="modal-title efruit-vi" style="color: #51bd36;font-weight: bold;">Đặt hàng Online trước để nhận khuyến mãi.</h2>
                        <h2 class="modal-title efruit-en" style="color: #51bd36;font-weight: bold;">Preorder online to get discount.</h2>
                        <p class="preorder-1day" style="color: #fff;">
                            <span class="efruit-vi">Đặt trước 1 ngày: giảm <?= intval(PRE_BOOKING_DISCOUNT_2 * 100) ?>% tổng hóa đơn</span>
                            <span class="efruit-en">1 day pre-order: <?= intval(PRE_BOOKING_DISCOUNT_2 * 100) ?>% discount</span>
                        </p>
                        <p class="preorder-1days" style="color: #fff;">
                            <span class="efruit-vi">Đặt trước 2 ngày trở lên: giảm <?= intval(PRE_BOOKING_DISCOUNT * 100) ?>% tổng hóa đơn</span>
                            <span class="efruit-en">2 days pre-order: <?= intval(PRE_BOOKING_DISCOUNT * 100) ?>% discount</span>
                        </p>
                        <p style="color: #fff;">{{ printf(__('Thời gian giao hàng từ %s đến %s mỗi ngày'), '<?= $pre_order_time["start"] ?>', '<?= $pre_order_time["end"] ?>') }}.</p>
                        <div class="form-group">
                            <label class="control-label" style="color: #fff;">{{__('Chương trình chỉ áp dụng khi đặt Online tại website')}}</label>
                            <label for="date_time" class="control-label" style="color: #fff;">{{__('Vui lòng chọn thời gian giao hàng')}} *</label>
                            <div class="input-group datetimepicker" id="datetimepicker" data-maxDate="<?= strtotime('+1 year', strtotime(date('Y-m-d'))) ?>" data-minDate="<?= strtotime('+1 day', strtotime(date('Y-m-d'))) ?>" data-defaultDate="<?= strtotime('+1 day', strtotime(date('Y-m-d ' . $pre_order_time["start"]))) ?>">
                                <input type='text' id="date_time" name="date_time" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <button id="setPreBookDate" disabled="" style="margin-bottom: 5px;" class="btn btn-success" ng-click="setPreBookDate()"><i class="fa fa-check"></i> {{__('Xác nhận và chọn món')}}</button>
                        <button style="margin-bottom: 5px;" class="btn btn-info" ng-click="clearPreBookDate()"><i class="fa fa-times"></i> {{__('Hủy')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div role="dialog" tabindex="-1" class="modal fade in dark-bg" id="modal-order-flow" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: rgba(56,56,56,0.8);">
            <div class="modal-header" style="background: none;">
                <button style="margin: -10px 0px 0 0;color: #fff;display:none" aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body" style="padding-top: 0;">
                <div class="row  row-fluid">
                    <div class="col-sm-12">
                        <div class="row shipping_process">
                            <?php
                            $shipping_fee_des = get_setting('general_shiping_fee_description');
                            $payment_des = get_setting('general_payment_description');
                            $stripped_des = filter_var(strip_tags($shipping_fee_des), FILTER_VALIDATE_URL);
                            $is_image = $stripped_des && in_array(pathinfo($stripped_des, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'));
                            ?>
                            <div class="<?= $is_image ? 'col-sm-8' : 'col-sm-6' ?>">
                                <div class="des-wrapper">
                                    <p><img loading="lazy" height="83" alt="shipping-icon" src="<?= get_theme_assets_url() ?>img/shipping-icon.png" /></p>
                                    <h3 style="color: #51bd36;font-weight: bold;">{{__('Phí giao hàng')}}</h3>
                                    <?php if ($is_image) : ?>
                                        <a href="<?= $stripped_des . '?t=' . date('Ymd') ?>" class="fancybox" rel="shipping-fee-1"><img loading="lazy" src="<?= $stripped_des . '?t=' . date('Ymd') ?>"></a>
                                    <?php else : ?>
                                        <br />
                                        <div class="efruit-vi"><?= $shipping_fee_des ?></div>
                                        <div class="efruit-en"><?= get_setting('general_shiping_fee_description', $shipping_fee_des, 'en') ?></div>
                                    <?php endif; ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="<?= $is_image ? 'col-sm-4' : 'col-sm-6' ?>">
                                <div class="des-wrapper">
                                    <p style="line-height: 83px;"><img loading="lazy" height="40" alt="vnd-icon" src="<?= get_theme_assets_url() ?>img/vnd-icon.png" /></p>
                                    <h3 style="color: #51bd36;font-weight: bold;">{{__('Thanh toán')}}</h3>
                                    <br />
                                    <div class="efruit-vi"><?= $payment_des ?></div>
                                    <div class="efruit-en"><?= get_setting('general_payment_description', $payment_des, 'en') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
<div id="live-dialog" class="efruitjs">
    <a href="#openpanel" class="open"><span><img loading="lazy" src="<?= get_theme_assets_url() ?>img/gift.gif" width="55" /></span></a>
    <a href="#closepanel" class="close"><span><i class="fa fa-times"></i></span></a>
    <div id="live-dialog-container">
        <div class="live-dialog-box">
            <?php
            if (!empty($sales_anns)) :
                foreach ($sales_anns as $d) :
                    if (($d['start_dtm'] && strtotime($d['start_dtm']) > time())
                        || ($d['end_dtm'] && strtotime($d['end_dtm']) < time())
                        || ($d['start_sales_time'] && strtotime($d['start_sales_time']) > time())
                        || ($d['end_sales_time'] && strtotime($d['end_sales_time']) < time())
                    )
                        continue;
            ?>
                    <div class="golden-time-row row">
                        <?php if ($d['image']) : ?>
                            <div class="col-md-12"><img loading="lazy" alt="hinh-thong-bao" style="width: 100%;" src="<?= $d['image'] ?>" /></div>
                            <div class="col-md-12">
                                <div class="efruit-vi"><?= $d['content'] ?></div>
                                <div class="efruit-en"><?= $d['content_en'] ?></div>
                            </div>
                        <?php else : ?>
                            <div class="col-md-12 efruit-vi">
                                <div class="efruit-vi"><?= $d['content'] ?></div>
                                <div class="efruit-en"><?= $d['content_en'] ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if ($d['start_dtm']) : ?>
                            <input type="hidden" class="starttime" value="<?= strtotime($d['start_dtm']) ?>" />
                        <?php endif; ?>
                        <?php if ($d['end_dtm']) : ?>
                            <input type="hidden" class="endtime" value="<?= strtotime($d['end_dtm']) ?>" />
                        <?php endif; ?>
                        <div class="col-md-12">
                            {{__('Thời gian còn lại')}}: <span data-countdown="<?= date('Y/m/d') . ' ' . $d['end_sales_time'] ?>"></span>
                        </div>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>
<div id="efruit_phone_div" class="efruit-phone efruit-green efruit-active">
    <a href="tel:0938707015 " target="_top" class="" title="Gọi">
        <div class="efruit-ph-circle"></div>
        <div class="efruit-ph-circle-fill"></div>
        <div class="efruit-ph-img-circle"></div>
    </a>
</div>
<div class="modal fade modal-share-order-group" data-backdrop="static" id="share-order-group-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog normal-dialog" role="document">
        <div class="modal-content"><span class="close" data-dismiss="modal">x</span>
            <div class="modal-header">Chia sẻ với nhóm của bạn</div>
            <div class="modal-body">
                <div class="group-share-left">
                    <div id="share-order-group-qr-code" style="height: 128px; width: 128px;" height="160" width="160"></div>
                    <p><a href="<?= ROOT_URL ?>vi/?e=I809CECN5N" rel="noopener noreferrer" target="_blank">Mở tab mới</a></p>
                </div>
                <div class="group-share-content">
                    <h5 class="group-share-title">Sao chép link và gửi cho nhóm</h5>
                    <input type="text" readonly="" style="background-color: rgb(255, 255, 255);" value="<?= ROOT_URL ?>vi/?e=I809CECN5N">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>