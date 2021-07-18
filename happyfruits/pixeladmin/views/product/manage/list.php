                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-itemlist">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên</th>
                                    <th>Đơn vị</th>
                                    <th>Loại</th>
                                    <th style="width: 80px;" class="not_filter">Hết hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($items): ?>
                                    <?php foreach($items as $item):?>
                                <tr id="<?=$item['id']?>">
                                    <td><?=$item['code']?></td>
                                    <td><?=$item['name']?></td>
                                    <td><?=$item['unit']?></td><td><?=$item['type_name']?></td>
                                    <td class="center">
                                        <div class="custom-checkbox-with-tick">
                                            <input id="out_of_stock_<?=$item['id']?>" type="checkbox" value="1" class="out_of_stock" <?=getvalue($item, 'out_of_stock')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="out_of_stock_<?=$item['id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>