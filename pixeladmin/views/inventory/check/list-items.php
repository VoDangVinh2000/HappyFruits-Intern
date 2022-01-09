<table class="table table-striped table-bordered table-hover" id="dataTables-check">
    <thead>
    <tr>
        <th style="width: 30px;">STT</th>
        <th style="width: 200px;">Tên hàng</th>
        <th style="width: 120px;">Số lượng *</th>
        <th>Ghi chú</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($inventory_items):
    $i = 1;
    foreach ($inventory_items as $item):?>
        <tr>
            <td><?=sprintf('%02d', $i)?></td>
            <td>
                <input type="hidden" name="item_id[]" id="item_id" value="<?=$item['id']?>"/>
                <?=$item['code']. ' - '.$item['name']?>
            </td>
            <td><input style="display: inline;width: 60px;" type="text" class="form-control float" id="item_quantity" <?php if(!empty($editing)) echo 'disabled';?> name="item_quantity[]" placeholder="SL" value="<?=isset($details[$item['id']])?$details[$item['id']]['remain_quantity']:''?>"/>&nbsp;<?=$item['unit']?></td>
            <td><input type="text" class="form-control" id="item_description" <?php if(!empty($editing)) echo 'disabled';?> name="item_description[]" placeholder="Ghi chú" value="<?=isset($details[$item['id']])?$details[$item['id']]['detail_description']:''?>"/></td>
        </tr>
        <?php $i++; endforeach; ?>
    <?php else:?>
        <tr><td colspan="4">Chưa có hàng hóa. Vui lòng thêm.</td></tr>
    <?php endif;?>
    </tbody>
</table>