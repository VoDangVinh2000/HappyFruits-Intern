                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-productlist">
                            <thead>
                                <tr>
                                    <th style="width: 60px;" class="not_filter">Thứ tự</th>
                                    <th style="width: 40px;">Mã</th>
                                    <th>Tên</th>
                                    <th>Tên tiếng Anh</th>
                                    <th style="width: 50px;">ĐVT</th>
                                    <th style="width: 50px;">Giá KM</th>
                                    <th style="width: 75px;" class="not_filter">Còn bán</th>
                                    <th style="width: 35px;" class="not_filter">Ẩn</th>
                                    <?php if (Users::can('edit', 'product')):?>
                                    <th style="width: 70px;" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                    <?php else:?>
                                    <th style="display: none;"></th>
                                    <?php endif;?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($products): ?>
                                    <?php foreach($products as $item):?>
                                <tr id="<?=$item['product_id']?>">
                                    <?php if (Users::can('edit', 'product')):?>
                                    <td style="max-width: 60px;"><input type="text" style="text-align: center;" value="<?=formatQuantity($item['sequence_number'])?>" class="sequence_number" /></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['code']?>" class="code" /></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['name']?>" class="name" /><span class="hidden"><?=$item['name_without_utf8']?></span></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['english_name']?>" class="english_name" /></td>
                                    <td class="fullwidth"><input type="text" style="text-align: center;" value="<?=$item['unit']?>" class="unit" /></td>
                                    <td class="fullwidth"><input type="text" style="text-align: center;" value="<?=$item['promotion_price']?>" class="promotion_price" /></td>
                                    <td class="center">
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="enabled_<?=$item['product_id']?>" type="checkbox" value="1" class="enabled" <?=getvalue($item, 'enabled')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="enabled_<?=$item['product_id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="is_hidden_<?=$item['product_id']?>" type="checkbox" value="1" class="is_hidden" <?=getvalue($item, 'is_hidden')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="is_hidden_<?=$item['product_id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="center">
                                    <a target="_blank" title="Xem" class="view_item btn btn-sm btn-info" href="http://www.localhost/vi/detail/<?=$item['product_id']?>"><i class="fa fa-newspaper-o"></i></a>
                                        <a target="_blank" href="<?=BASE_URL. $URIs['products']?>/<?=$item['product_id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                        <?php if (Users::can('delete', 'product')):?>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                         <?php endif;?>
                                    </td>
                                    <?php else:?>
                                    <td class="center"><?=formatQuantity($item['sequence_number'])?></td>
                                    <td class="center"><?=$item['code']?></td>
                                    <td class="fullwidth"><?=$item['name']?></td>
                                    <td class="fullwidth"><?=$item['english_name']?></td>
                                    <td class="center"><?=$item['unit']?></td>
                                    <td class="fullwidth"><input type="text" style="text-align: center;" value="<?=$item['promotion_price']?>" class="promotion_price" /></td>
                                    <td class="center">
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="enabled_<?=$item['product_id']?>" type="checkbox" value="1" class="enabled" <?=getvalue($item, 'enabled')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="enabled_<?=$item['product_id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="is_hidden_<?=$item['product_id']?>" type="checkbox" value="1" class="is_hidden" <?=getvalue($item, 'is_hidden')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="is_hidden_<?=$item['product_id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td style="display: none;" class="center"></td>
                                    <?php endif;?>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
