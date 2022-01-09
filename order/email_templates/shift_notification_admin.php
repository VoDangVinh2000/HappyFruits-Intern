<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html>
<head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head>
<body>
    <p>Chào bạn,</p>
    <p><?=$member['fullname']?> vừa kết ca <?=$shift?> ngày <?=date('d/m/Y')?> cho <b><?=$branch_name?></b> với thông tin sau:</p>
    <table cellspacing="0" cellpadding="0" style="border-collapse: collapse;border-spacing: 0;">
      <tbody>
        <tr>
          <th style="border: 1px solid #888;padding: 5px 10px;text-align:left;">Tổng bán</th>
          <th style="border: 1px solid #888;padding: 5px 10px;text-align:right;"><?=number_format($total, 3, '.', '.')?><sup>đ</sup></th>
        </tr>
      <?php 
        $total_payment = $total_receipt = 0;
        $payment_html = $receipt_html = '';
        if (!empty($vouchers))
        {
            foreach($vouchers as $v)
            {
                if ($v['type'] == 'payment')
                {
                    $payment_html .= '<tr>
                      <td style="border: 1px solid #888;padding: 5px 10px;text-align:left;"> - '.$v['description'].'</td>
                      <td style="border: 1px solid #888;padding: 5px 10px;text-align:right;">'.number_format($v['amount'], 3, '.', '.').'<sup>đ</sup></td>
                    </tr>';
                    $total_payment += $v['amount'];
                }
                else
                {
                    $receipt_html .= '<tr>
                      <td style="border: 1px solid #888;padding: 5px 10px;text-align:left;"> - '.$v['description'].'</td>
                      <td style="border: 1px solid #888;padding: 5px 10px;text-align:right;">'.number_format($v['amount'], 3, '.', '.').'<sup>đ</sup></td>
                    </tr>';
                    $total_receipt += $v['amount'];
                }
            }
        }
      ?>
        <tr>
          <th style="border: 1px solid #888;padding: 5px 10px;text-align:left;">Tổng chi</th>
          <th style="border: 1px solid #888;padding: 5px 10px;text-align:right;"><?=number_format($total_payment, 3, '.', '.')?><sup>đ</sup></th>
        </tr>
        <?php echo $payment_html;?>
        <tr>
          <th style="border: 1px solid #888;padding: 5px 10px;text-align:left;">Tổng thu</th>
          <th style="border: 1px solid #888;padding: 5px 10px;text-align:right;"><?=number_format($total_receipt, 3, '.', '.')?><sup>đ</sup></th>
        </tr>
        <?php echo $receipt_html;?>
      </tbody>
      <tfoot>
        <tr>
          <th style="border: 1px solid #888;padding: 5px 10px;font-weight: bold;">Tổng cộng</th>
          <th style="text-align: right;border: 1px solid #888;padding: 5px 10px;font-weight: bold;font-size:22px;"><?=number_format($total - $total_payment + $total_receipt, 3, '.', '.')?><sup>đ</sup></th>
        </tr>
      </tfoot>
    </table>
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