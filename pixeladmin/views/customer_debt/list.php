<?php $total_money = 0; ?>
<table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-mainlist">
    <thead>
    <tr>
        <th style="min-width: 130px;">Ngày thanh toán</th>
        <th>Mã đơn hàng</th>
        <th style="min-width: 80px;">Số tiền</th>
        <th style="min-width: 60px;">Nhân viên</th>
        <th>Tình trạng</th>
        <th>Nội dung</th>
        <th style="width:80px" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
    </tr>
    </thead>
    <tbody>
    <?php if ($debts): ?>
        <?php foreach ($debts as $item):
            $is_editable = Customerdebts::is_editable($item['id']);
            $total_money += $item['amount'];
            ?>
            <tr id="<?= $item['id'] ?>">
                <td data-value="<?= strtotime($item['payment_date']) ?>">
                    <?php if ($is_editable): ?>
                        <a href="<?= BASE_URL . $URIs['customer_debts'] ?>/<?= $item['id'] ?>"><?= date('d/m/Y H:i:s', strtotime($item['payment_date'])) ?></a>
                    <?php else: ?>
                        <?= date('d/m/Y H:i:s', strtotime($item['payment_date'])) ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($item['order_code']): $shipping_info = json_decode($item['shipping_info'], true) ?>
                        <a target="_blank"
                           href="<?= ROOT_URL ?>in/<?= $item['order_code'] ?>"><?= $item['order_code'] ?></a>
                        <?php if (!empty($shipping_info)): ?>
                            <p><?= $shipping_info['fullname'] ?><?= !empty($shipping_info['mobile']) ? ' - ' . $shipping_info['mobile'] : '' ?></p>
                            <p><?= $shipping_info['address'] ?></p>
                        <?php endif; ?>
                    <?php else: ?>
                        Không có mã đơn hàng
                    <?php endif; ?>
                </td>
                <td data-value="<?= $item['amount'] ?>"><input type="text" style="width: 80px;text-align: right;"
                                                               maxlength="8" value="<?= $item['amount'] ?>"
                                                               class="amount"/></td>
                <td><?= $item['fullname'] ?></td>
                <td><?= get_customer_debt_status($item['status']) ?></td>
                <td>
                    <?php echo word_limiter($item['description'], 20); ?>
                </td>
                <td class="center not_filter">
                    <?php if ($is_editable): ?>
                        <a href="#" data-id="<?= $item['id'] ?>" data-user-id="<?= $item['user_id'] ?>"
                           data-amount="<?= $item['amount'] ?>" class="btn btn-sm btn-success add-payment"
                           title="Cập nhật thanh toán"><i class="fa fa-check"></i></a>
                        <a target="_blank" href="<?= BASE_URL . $URIs['customer_debts'] ?>/<?= $item['id'] ?>"
                           class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash-o"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<input type="hidden" id="total_money" value="<?= number_format($total_money, 0, '.', '.') ?>"/>