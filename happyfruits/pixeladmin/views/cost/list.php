<?php $total_money = 0; ?>
<table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-mainlist">
    <thead>
    <tr>
        <th>Chi phí cho ngày</th>
        <th>Nhà cung cấp</th>
        <th>Nội dung</th>
        <th style="min-width: 80px;">Loại</th>
        <th style="min-width: 80px;">Số tiền</th>
        <th style="min-width: 60px;">Nhân viên</th>
        <th>Ngày tạo</th>
        <th style="width:60px" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
    </tr>
    </thead>
    <tbody>
    <?php if ($costs): $total_money = 0; ?>
        <?php foreach ($costs as $item):
            $is_ediable = Costs::is_editable($item['id']);
            $total_money += $item['amount'];
            ?>
            <tr id="<?= $item['id'] ?>">
                <td data-value="<?= strtotime($item['date_time']) ?>">
                    <?php if ($is_ediable): ?>
                        <a href="<?= BASE_URL . $URIs['costs'] ?>/<?= $item['id'] ?>"><?= date('d/m/Y H:i:s', strtotime($item['date_time'])) ?></a>
                    <?php else: ?>
                        <?= date('d/m/Y H:i:s', strtotime($item['date_time'])) ?>
                    <?php endif; ?>
                </td>
                <td><?= Costs::getProvidersName($item['id']); ?></td>
                <td>
                    <?php if (!empty($item['import_id'])): ?>
                        <a target="_blank"
                           href="<?= BASE_URL . $URIs['inventory_import_fruits'] ?>/<?= $item['import_id'] ?>"><?php echo 'Phiếu nhập #' . $item['import_id']; ?></a>
                        <br/>
                    <?php endif; ?>
                    <?php if (!empty($item['debt_id'])): ?>
                        <a target="_blank"
                           href="<?= BASE_URL . $URIs['debts'] ?>/<?= $item['debt_id'] ?>"><?php echo 'Công nợ #' . $item['debt_id']; ?></a>
                        <br/>
                    <?php endif; ?>
                    <?php if (!empty($item['order_id'])): ?>
                        <a target="_blank" href="<?= ROOT_URL . 'in/' . $item['order_id'] ?>"><?= $item['name'] ?></a>
                        <br/>
                    <?php endif; ?>
                    <?php echo word_limiter($item['description'], 20); ?>
                </td>
                <td><?= $item['cost_type'] ?></td>
                <td data-value="<?= $item['amount'] ?>"><input type="text" style="width: 80px;text-align: right;"
                                                               maxlength="8" value="<?= $item['amount'] ?>"
                                                               class="amount"/></td>
                <td><?= $item['fullname'] ?></td>
                <td data-value="<?= strtotime($item['created_dtm']) ?>">
                    <?= date('d/m/Y H:i:s', strtotime($item['created_dtm'])) ?>
                </td>
                <td class="center not_filter">
                    <?php if ($is_ediable): ?>
                        <a target="_blank" href="<?= BASE_URL . $URIs['costs'] ?>/<?= $item['id'] ?>"
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