<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html>
<head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head>
<body>
    <p>Chào bạn,</p>
    <p>Nhân viên <?=$member['fullname']?> vừa tạm ứng <?=number_format($amount, 3, '.', '.')?>đ.</p>
    <p>Thời gian gửi: <?=date('d/m/Y H:i:s')?></p>
    <p>
        <span style="font-size: 20px;font-weight: bold;line-height: 30px;"><?=get_setting('site_name')?></span><br />
        <b>Địa chỉ:</b> <?=getvalue($branch, 'branch_address')?><br />
        <b>Số điện thoại:</b> <?=getvalue($branch, 'phone_number')?><br />
        <b>Email:</b> <a href="mailto:info@<?=DOMAIN_NAME?>" style="text-decoration: none;">info@<?=DOMAIN_NAME?></a><br />
        <b>Website:</b> <a href="www.<?=DOMAIN_NAME?>" style="text-decoration: none;">www.<?=DOMAIN_NAME?></a>
    </p>
</body>
</html>