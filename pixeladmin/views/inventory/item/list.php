                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-itemlist">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên</th>
                                    <th>Đơn vị</th>
                                    <th>Đơn giá</th>
                                    <th>SL cảnh báo</th>
	                                <th>SL cần</th>
                                    <th>Loại</th>
                                    <th style="width: 80px;" class="not_filter"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($items): ?>
                                    <?php foreach($items as $item):?>
                                <tr id="<?=$item['id']?>">
                                    <td><?=$item['code']?></td>
                                    <td><input type="text" value="<?=$item['name']?>" class="name" /></td>
                                    <td><input style="width: 80px;margin: 0 auto;display: block;text-align: center;" type="text" value="<?=$item['unit']?>" class="unit" /></td>
                                    <td><input style="width: 80px;margin: 0 auto;display: block;text-align: center;" type="text" value="<?=$item['default_price']?>" class="default_price" /></td>
                                    <td><input style="width: 80px;margin: 0 auto;display: block;text-align: center;" type="text" value="<?=formatQuantity($item['warning_quanity'])?>" class="warning_quanity" /></td>
	                                <td><input style="width: 80px;margin: 0 auto;display: block;text-align: center;" type="text" value="<?=formatQuantity($item['required_quantity'])?>" class="required_quantity" /></td>
                                    <td><?=$item['type_name']?></td>
                                    <td class="center">
                                        <a href="<?=BASE_URL. (empty($is_fruit)?$URIs['inventory_item']:$URIs['inventory_item_fruits'])?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>