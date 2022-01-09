<table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-block-productlist">
    <thead>
        <tr>
            <!-- <th></th> -->
            <th style="width:15px" class="not_filter">Thứ tự</th>
            <th style="width:15px">Mã</th>
            <th style="width:100px">Tên</th>
            <th style="width:100px">Tên tiếng Anh</th>
            <th>Ảnh</th>
            <th>Chọn các sản phẩm sẽ hiển thị</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($products) : ?>
            <?php foreach ($products as $item) : ?>
                <tr id="<?= $item['product_id'] ?>">
                    <!-- <td><input type="hidden" name="product_id[]" value="<?= $item['product_id'] ?>"></td> -->
                    <td style="max-width: 40px;"><input type="text" style="text-align: center;" value="<?= formatQuantity($item['sequence_number']) ?>" class="sequence_number" /></td>
                    <td class="fullwidth text-center"><input type="text" value="<?= $item['code'] ?>" class="code" /></td>
                    <td class="fullwidth name"><input type="text" value="<?= $item['name'] ?>" class="name" /><span class="hidden"><?= $item['name_without_utf8'] ?></span></td>
                    <td class="fullwidth"><input type="text" value="<?= $item['english_name'] ?>" class="english_name" /></td>
                    <td class="fullwidth">
                        <img style="display: block;margin: 0 auto;" width="30" height="30" alt="<?= $item['code'] ?>" src="<?= get_image_url($item['image'], 'square-small') ?>" class="recipe-image" />
                    </td>
                    <td class="fullwidth">
                        <input class="form-control" type="checkbox" name="products_show[]" class="products_show">
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>