<?php
    $packages_options = get_package_options();
?>
<style>
#fruitPackageFrm{
    background: rgba(88, 183, 32, 0.8);
    max-width: 310px;
    margin: 0 auto;
}
    #fruitPackageFrm .form-control{
        -webkit-appearance:none;
        -moz-appearance:none;
        appearance:none;
        border:0;
        width: calc( 100% - 4px );
        margin: 1px 2px;
        font-size: 14px;
        border-radius: 0;
        min-height: 32px;
        display: inline-block;
    }
    #fruitPackageFrm .form-control.error{
        margin-bottom: 1px;
    }
    #fruitPackageFrm .heading{
        text-align: center;
        padding: 6px;
        margin: 0;
        color: #fff !important;
        font-size: 22px;
        line-height: 24px;
    }
    #fruitPackageFrm .btn-submit{
        width: 100%;
        background: none;
        font-size: 110%;
    }
    form#fruitPackageFrm label.error{
        margin-top: 0;
        margin-left: 2px;
        text-align: left;
        background: white;
        padding: 5px 10px;
        margin-right: 2px;
        margin-bottom: 0;
    }
    #fruitPackageFrm .select2-container .select2-choice{
        border: none;
        line-height: 18px;
        padding: 6px 8px;
        height: 32px;
        display: table;
        font-size: 14px;
    }
    #fruitPackageFrm .select2-container .select2-choice>.select2-chosen{
        display: table-cell;
        vertical-align: middle;
    }
    #fruitPackageFrm .select2-container .select2-choice .select2-arrow b{
        padding-top: 6px;
    }
    #fruitPackageFrm.floating{
        position: absolute;
        left: 20px;
    }
</style>
<script>
    var packages = '<?=json_encode($packages_options['products'])?>';
</script>
<form class="efruitjs float-form" id="fruitPackageFrm" method="post" name="contact" action="">
    <h2 class="heading" bind-translate="Đăng ký đặt hàng">Đăng ký đặt hàng</h2>
    <select id="p_package" name="p_package" class="form-control">
        <option value="">{{__('Vui lòng chọn gói đặt hàng')}}</option>
        <?php foreach($packages_options['products'] as $opt => $package):?>
            <option value="<?=$opt?>" data-package="<?=json_encode($package)?>">{{__('<?=$package['name']?>')}}</option>
        <?php endforeach; ?>
    </select>
    <div class="package_info hidden" style="padding: 0 10px;background: white;margin: 2px;font-size: 12px;">
        <span><b bind-translate="Giá">Giá</b>: <b><span class="package_price">1.170.000</span> vnđ/<span bind-translate="tháng">tháng</span></b> <span bind-translate="gồm">gồm</span> <span class="package_quantity">--</span> <span class="package_unit">--</span> <span class="package_volume">--</span></span><br/>
        <span class="e-note" bind-translate="Chưa bao gồm chai/hũ thủy tinh.">Chưa bao gồm chai/hũ thủy tinh.</span>
    </div>
    <select id="p_quantity" name="p_quantity" class="form-control">
        <option value="">{{__('Số lượng')}}</option>
        <?php for($i = 1; $i <= 10; $i++):?>
            <option value="<?=$i?>"><?=$i?></option>
        <?php endfor; ?>
        <option value="11">&gt; 10</option>
    </select>
    <input id="p_name" name="p_name" type="text" class="form-control required" maxlength="60" placeholder="{{__('Họ tên')}} *" />
    <input id="p_mobile" name="p_mobile" type="text" class="form-control required" maxlength="15" placeholder="{{__('Số điện thoại')}} *" />
    <input id="p_email" name="p_email" type="text" class="form-control required email" maxlength="120" placeholder="Email *" />
    <input id="p_address" name="p_address" type="text" class="form-control" maxlength="255" placeholder="{{__('Địa chỉ')}}" />
    <select id="p_shipping_fee" name="p_shipping_fee" class="form-control">
        <option value="">{{__('Hình thức nhận hàng')}}</option>
        <?php foreach($packages_options['shipping_fees'] as $opt => $lbl):?>
            <option value="<?=$opt?>">{{__('<?=$lbl?>')}}</option>
        <?php endforeach; ?>
    </select>
    <select id="p_delivery_time" name="p_delivery_time" class="form-control">
        <option value="">{{__('Thời gian giao hàng')}}</option>
        <?php foreach($packages_options['delivery_time'] as $opt => $lbl):?>
            <option value="<?=$opt?>">{{__('<?=$lbl?>')}}</option>
        <?php endforeach; ?>
    </select>
    <select id="p_payment_method" name="p_payment_method" class="form-control">
        <option value="">{{__('Hình thức thanh toán')}}</option>
        <?php foreach($packages_options['payment_methods'] as $opt => $lbl):?>
            <option value="<?=$opt?>">{{__('<?=$lbl?>')}}</option>
        <?php endforeach; ?>
    </select>
    <select id="p_bottle_return" name="p_bottle_return" class="form-control">
        <option value="">{{__('Hình thức trả chai')}}</option>
        <?php foreach($packages_options['bottle_return'] as $opt => $lbl):?>
            <option value="<?=$opt?>">{{__('<?=$lbl?>')}}</option>
        <?php endforeach; ?>
    </select>
    <textarea id="p_message" class="form-control" name="p_message" rows="3" placeholder="{{__('Yêu cầu khác')}}"></textarea>
    <input type="hidden" value="send_package_request" name="action"/>
    <input type="text" class="honey" value="" name="<?php echo md5("smcf-info@". DOMAIN_NAME . date("WY"));?>"/>
    <input type="hidden" name="token" value="<?php echo md5("smcf-info@". DOMAIN_NAME . date("WY"));?>"/>
    <button type="button" class="btn btn-success btn-submit"><i class="fa fa-envelope"></i> <span bind-translate="Đặt hàng">Đặt hàng</span></button>
</form>