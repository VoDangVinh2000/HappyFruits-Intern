                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-providerlist">
                            <thead>
                                <tr>
                                    <th style="width: 160px;min-width: 160px;">Tên</th>
	                                <th style="width: 80px;">Loại</th>
                                    <th style="max-width: 400px;">Địa chỉ</th>
                                    <th style="width: 80px;">Điện thoại</th>
                                    <th>Ghi chú</th>
	                                <th>Ngân hàng</th>
                                    <th class="not_filter" style="width: 80px;"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($providers): ?>
                                    <?php foreach($providers as $item):?>
                                <tr id="<?=$item['id']?>">
                                    <td class="fullwidth"><input type="text" value="<?=$item['provider_name']?>" class="provider_name" /><span hidden=""><?=remove_unicode($item['provider_name'])?></span></td>
	                                <td class="fullwidth"><?=get_provider_type($item['provider_type'])?> - <?=isset($types[$item['type']])?$types[$item['type']]:'Không xác định'?></td>
	                                <td class="fullwidth"><input type="text" value="<?=$item['provider_address']?>" class="provider_address" /><span hidden=""><?=remove_unicode($item['provider_address'])?></span></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['mobile']?>" class="mobile" /></td>
	                                <td class="fullwidth"><input type="text" value="<?=$item['description']?>" class="description" /></td>
	                                <td>
		                                <?=$item['bank_name']?><br/>
		                                <?=$item['bank_account_name']?><br/>
		                                <?=$item['bank_account_number']?>
	                                </td>
                                    <td class="center">
                                        <input type="hidden" class="lat" value="<?=$item['lat']?>" />
                                        <input type="hidden" class="lng" value="<?=$item['lng']?>" />
                                        <a target="_blank" href="http://maps.google.com/maps?q=<?=$item['lat'].','.$item['lng']?>" class="btn btn-sm btn-info" title="Hiển thị vị trí"><i class="fa fa-map-marker"></i></a>
                                        <?php if(Users::can('modify', 'provider')):?>
                                        <a target="_blank" href="<?=BASE_URL. $URIs['providers']?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                        <?php endif;?>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>