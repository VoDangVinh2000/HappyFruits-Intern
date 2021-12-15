<table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-block-productlist">
    <thead>
        <tr>
            <th style="width: 60px;" class="not_filter">Thứ tự</th>
            <th style="width: 40px;">Mã</th>
            <th>Tên</th>
            <th>Tên tiếng Anh</th>
            <th style="width: 50px;">ĐVT</th>
            <th style="width: 100px;">Chọn các sản phẩm sẽ hiển thị</th>
            <th style="width: 0;" class="not_filter"></th>
            <th style="width: 0;" class="not_filter"></th>
            <?php if (Users::can('edit', 'product')) : ?>
                <th style="width: 0;" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
            <?php else : ?>
                <th style="display: none;"></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if ($products) : ?>
            <?php foreach ($products as $item) : ?>
                <tr id="<?= $item['product_id'] ?>">
                    <?php if (Users::can('edit', 'product')) : ?>
                        <td style="max-width: 60px;"><input type="text" style="text-align: center;" value="<?= formatQuantity($item['sequence_number']) ?>" class="sequence_number" /></td>
                        <td class="fullwidth"><input type="text" value="<?= $item['code'] ?>" class="code" /></td>
                        <td class="fullwidth"><input type="text" value="<?= $item['name'] ?>" class="name" /><span class="hidden"><?= $item['name_without_utf8'] ?></span></td>
                        <td class="fullwidth"><input type="text" value="<?= $item['english_name'] ?>" class="english_name" /></td>
                        <td class="fullwidth"><input type="text" style="text-align: center;" value="<?= $item['unit'] ?>" class="unit" /></td>
                        <td class="fullwidth">
                            <input type="checkbox" name="" id="">
                        </td>
                        <td class="center"></td>
                        <td class="center"></td>
                        <td class="center"></td>
                    <?php else : ?>
                        <td class="center"><?= formatQuantity($item['sequence_number']) ?></td>
                        <td class="center"><?= $item['code'] ?></td>
                        <td class="fullwidth"><?= $item['name'] ?></td>
                        <td class="fullwidth"><?= $item['english_name'] ?></td>
                        <td class="center"><?= $item['unit'] ?></td>
                        <td class="fullwidth">
                            <input type="checkbox" name="" id="">
                        </td>
                        <td class="center"></td>
                        <td class="center"></td>
                        <td style="display: none;" class="center"></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>