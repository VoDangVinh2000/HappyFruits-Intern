<?php
    $findus_options = array(
        'friend' => 'Bạn bè',
        'facebook' => 'Facebook',
        'google' => 'Google',
        'email' => 'Email',
        'online' => 'Quảng cáo online',
        'broucher' => 'Tờ rơi',
        'other' => 'Khác'
    );
    $receive_options = array(
        'at_shop' => 'Voucher giấy tại cửa hàng',
        'when_booking' => 'Voucher giấy khi có đặt hàng online',
        'email' => 'Voucher điện tử qua email'
    );
?>
<style>
#voucherRequestFrm{
    background: rgba(88, 183, 32, 0.8);
    max-width: 310px;
    margin: 0 auto;
}
    #voucherRequestFrm .form-control{
        -webkit-appearance:none;
        -moz-appearance:none;
        appearance:none;
        border:0;
        width: calc( 100% - 4px );
        margin: 2px;
        font-size: 14px;
        border-radius: 0;
        min-height: 40px;
    }
    #voucherRequestFrm .form-control.error{
        margin-bottom: 1px;
    }
    #voucherRequestFrm .heading{
        text-align: center;
        padding: 12px 24px;
        margin: 0;
        color: #fff !important;
    }
    #voucherRequestFrm .btn-submit{
        width: 100%;
        background: none;
        font-size: 110%;
    }
    form#voucherRequestFrm label.error{
        margin-top: 0;
        margin-left: 2px;
        text-align: left;
        background: white;
        padding: 5px 10px;
        margin-right: 2px;
        margin-bottom: 0;
    }
</style>
<form class="efruitjs" id="voucherRequestFrm" method="post" name="contact" action="">
    <h2 class="heading" bind-translate="Đăng ký nhận voucher">Đăng ký nhận voucher</h2>
    <input id="v_name" name="v_name" type="text" class="form-control required" maxlength="60" placeholder="{{__('Họ tên')}} *" />
    <input id="v_email" name="v_email" type="text" class="form-control required email" maxlength="120" placeholder="Email *" />
    <input id="v_mobile" name="v_mobile" type="text" class="form-control required" maxlength="15" placeholder="{{__('Số điện thoại')}} *" />
    <input id="v_company" name="v_company" type="text" class="form-control" maxlength="255" placeholder="{{__('Công ty')}}" />
    <input id="v_address" name="v_address" type="text" class="form-control" maxlength="255" placeholder="{{__('Địa chỉ')}}" />
    <select id="v_findus" name="v_findus" class="form-control" style="padding-left: 5px;">
        <option value="">{{__('Bạn biết đến chúng tôi qua kênh nào?')}}</option>
        <?php foreach($findus_options as $opt => $lbl):?>
            <option value="<?=$opt?>">{{__('<?=$lbl?>')}}</option>
        <?php endforeach; ?>
    </select>
    <select id="v_recieve" name="v_recieve" class="form-control" style="padding-left: 5px;">
        <option value="">{{__('Bạn muốn nhận voucher bằng cách nào?')}}</option>
        <?php foreach($receive_options as $opt => $lbl):?>
            <option value="<?=$opt?>">{{__('<?=$lbl?>')}}</option>
        <?php endforeach; ?>
    </select>
    <textarea id="v_message" class="form-control" name="v_message" rows="10" cols="0" placeholder="{{__('Yêu cầu khác')}}"></textarea>
    <input type="hidden" value="send_voucher_request" name="action"/>
    <input type="text" class="honey" value="" name="<?php echo md5("smcf-info@". DOMAIN_NAME . date("WY"));?>"/>
    <input type="hidden" name="token" value="<?php echo md5("smcf-info@". DOMAIN_NAME . date("WY"));?>"/>
    <button type="button" class="btn btn-success btn-submit"><i class="fa fa-envelope"></i> <span bind-translate="Gửi">Gửi</span></button>
</form>