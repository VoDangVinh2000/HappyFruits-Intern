<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html>
<head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head>
<body>
    <p>Chào bạn,</p>
    <p><?=$member['fullname']?> vừa thêm <b>phiếu <?=$data['type']=='payment'?'chi':'thu'?></b> cho <b><?=$branch_name?></b> với nội dung như sau:</p>
    <p>
    Tổng tiền: <?=number_format($data['amount'], 3, '.', '.')?><sup>đ</sup><br/>
    Nội dung: <?=$data['description']?><br />
    </p>
    <p>Thời gian tạo: <?=date('d/m/Y H:i:s', strtotime($data['date_time']))?></p>
    <p>
        <span style="font-size: 20px;font-weight: bold;line-height: 30px;"><?=get_setting('site_name')?></span><br />
        <b>Địa chỉ:</b> <?=getvalue($branch, 'branch_address')?><br />
        <b>Số điện thoại:</b> <?=getvalue($branch, 'phone_number')?><br />
        <b>Email:</b> <a href="mailto:info@<?=DOMAIN_NAME?>" style="text-decoration: none;">info@<?=DOMAIN_NAME?></a><br />
        <b>Website:</b> <a href="www.<?=DOMAIN_NAME?>" style="text-decoration: none;">www.<?=DOMAIN_NAME?></a>
    </p>
</body>
</html>