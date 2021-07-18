                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-pricelist">
                            <thead>
                                <tr>
                                    <th>Nhóm</th>
                                    <th>Mã hàng</th>
                                    <th>Tên</th>
                                    <?php if(USING_SAME_PRICE):?>
                                        <th class="not_filter" style="width: 100px;">Giá</th>
                                    <?php else:?>
                                        <?php foreach($price_types as $type):?>
                                        <th class="not_filter" style="width: 100px;"><?=$type['type_name']?></th>
                                        <?php endforeach;?>
                                    <?php endif; ?>
                                    <th class="not_filter"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($products): ?>
                                <?php foreach($products as $item):?>
                            <tr id="<?=$item['product_id']?>">
                                <td><?=$item['category_name']?></td>
                                <td><?=$item['code']?></td>
                                <td><?=$item['name']?></td>
                                <?php
                                    if(USING_SAME_PRICE):
                                        $price_item = getvalue($prices, $item['product_id'].'_1');
                                ?>
                                    <td><input type="text" class="price number" id="<?=$item['product_id']?>" value="<?=getvalue($price_item, 'price')?>"/></td>
                                <?php
                                    else:
                                        foreach($price_types as $type):
                                            $k = $item['product_id'].'_'.$type['type_id'];
                                            $price_item = getvalue($prices, $k);
                                ?>
                                <td><input type="text" class="price number" id="<?=$k?>" value="<?=getvalue($price_item, 'price')?>"/></td>
                                <?php
                                        endforeach;
                                    endif;
                                ?>
                                <td class="center">
                                    <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                            </tbody>
                        </table>
