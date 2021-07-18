                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-inventorylist">
                            <thead>
                                <tr>
                                    <th>Tên hàng hóa</th>
	                                <th>Số lượng</th>
                                    <th>Loại</th>
                                    <th>Kho</th>
                                    <th>Ngày nhập gần đây</th>
                                    <th>Ngày xuất gần đây</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($inventory_records)): ?>
                                    <?php foreach($inventory_records as $item):?>
                                <tr id="<?=$item['item_id']?>">
                                    <td><?=$item['code']. ' - '.$item['name']?></td>
	                                <td>
		                                <?php
		                                $quantity_text = formatQuantity($item['quantity']). ' '. $item['unit'];
		                                if ($item['has_quantity_in_details'] && $item['quantity_in_details'])
			                                $quantity_text .= ' - '. formatQuantity($item['quantity_in_details']). ' '. $item['unit_in_details'];
		                                echo $quantity_text;
		                                ?>
		                                <?php if ($item['quantity'] < $item['warning_quanity']):?><i class="fa fa-warning warning-color"></i><?php endif;?>
	                                </td>
                                    <td><?=$item['type_name']?></td>
                                    <td><?=$item['warehouse_name']?></td>
                                    <td data-value="<?=empty($item['last_import_date'])?0:strtotime($item['last_import_date'])?>"><?=empty($item['last_import_date'])?'Không xác định':date('d/m/Y H:i:s', strtotime($item['last_import_date']))?></td>
                                    <td data-value="<?=empty($item['last_export_date'])?0:strtotime($item['last_export_date'])?>"><?=empty($item['last_export_date'])?'Không xác định':date('d/m/Y H:i:s', strtotime($item['last_export_date']))?></td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>