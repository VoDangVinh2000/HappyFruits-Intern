<?php $total_money = 0; ?>
<table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-mainlist">
    <thead>
    <tr>
        <th>Thời hạn thanh toán</th>
        <th>Ngày nhập</th>
        <th>Nhà cung cấp</th>
        <th>Nội dung</th>
        <th style="min-width: 80px;">Loại</th>
        <th style="min-width: 80px;">Số tiền</th>
        <th style="min-width: 60px;">Nhân viên</th>
        <th>Tình trạng</th>
        <th style="width:80px" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
    </tr>
    </thead>
    <tbody>
    <?php if ($debts): ?>
        <?php foreach ($debts as $item):
            $is_editable = Debts::is_editable($item['id']);
            $total_money += $item['amount'];
            ?>
            <tr id="<?= $item['id'] ?>">
                <td data-value="<?= strtotime($item['payment_date']) ?>">
                    <?php if ($is_editable): ?>
                        <a href="<?= BASE_URL . $URIs['debts'] ?>/<?= $item['id'] ?>"><?= date('d/m/Y H:i:s', strtotime($item['payment_date'])) ?></a>
                    <?php else: ?>
                        <?= date('d/m/Y H:i:s', strtotime($item['payment_date'])) ?>
                    <?php endif; ?>
                </td>
                <td data-value="<?= strtotime($item['created_dtm']) ?>">
                    <?= date('d/m/Y H:i:s', strtotime($item['created_dtm'])) ?>
                </td>
                <td><?= Debts::getProvidersName($item['id']); ?><?= empty($item['has_invoice']) ? '' : ' <span style="color: red;">Có hóa đơn</span>' ?></td>
                <td>
                    <?php if (!empty($item['import_id'])): ?>
                        <a target="_blank"
                           href="<?= BASE_URL . $URIs['inventory_import_fruits'] ?>/<?= $item['import_id'] ?>"><?php echo 'Phiếu nhập #' . $item['import_id']; ?></a>
                        <br/>
                    <?php endif; ?>
                    <?php echo word_limiter($item['description'], 20); ?>
                </td>
                <td><?= $item['debt_type'] ?></td>
                <td data-value="<?= $item['amount'] ?>"><input type="text" style="width: 80px;text-align: right;"
                                                               maxlength="8" value="<?= $item['amount'] ?>"
                                                               class="amount"/></td>
                <td><?= $item['fullname'] ?></td>
                <td><?= get_debt_status($item['status']) ?></td>
                <td class="center not_filter">
                    <?php if ($is_editable): ?>
                        <?php if (Users::can('add_payment', 'debt')): ?>
                            <a href="#" data-id="<?= $item['id'] ?>" data-user-id="<?= $item['user_id'] ?>"
                               data-amount="<?= $item['amount'] ?>" class="btn btn-sm btn-success add-payment"
                               title="Cập nhật thanh toán"><i class="fa fa-check"></i></a>
                        <?php endif; ?>
                        <a target="_blank" href="<?= BASE_URL . $URIs['debts'] ?>/<?= $item['id'] ?>"
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