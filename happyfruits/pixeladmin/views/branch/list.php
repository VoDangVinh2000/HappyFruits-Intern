                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-customerlist">
                            <thead>
                                <tr>
                                    <th>Tên chi nhánh</th>
                                    <th>Địa chỉ</th>
                                    <th class="not_filter" style="width: 100px;">Latitude</th>
                                    <th class="not_filter" style="width: 100px;">Longitude</th>
                                    <th class="not_filter" style="width: 70px;">Hoạt động</th>
                                    <th class="not_filter" style="width: 90px;"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($branches): ?>
                                    <?php foreach($branches as $item): ?>
                                <tr id="<?=$item['id']?>">
                                    <td class="fullwidth"><input type="text" value="<?=$item['branch_name']?>" class="branch_name" /><span hidden=""><?=remove_unicode($item['branch_name'])?></span></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['branch_address']?>" class="branch_address" /><span hidden=""><?=remove_unicode($item['branch_address'])?></span></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['lat']?>" class="lat" /></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['lng']?>" class="lng" /></td>
                                    <td class="center">
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="enabled_<?=$item['id']?>" type="checkbox" value="1" class="enabled" <?=getvalue($item, 'enabled')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="enabled_<?=$item['id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a target="_blank" href="http://www.google.com/maps/search/<?=$item['lat'].',+'.$item['lng']?>" class="btn btn-sm btn-info" title="Hiển thị vị trí"><i class="fa fa-map-marker"></i></a>
                                        <?php if(Users::can_access('branch', 'modify')):?>
                                        <a target="_blank" href="<?=BASE_URL. $URIs['branches']?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                        <?php if($item['id']!=1){?>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                        <?php }?>
                                        <?php endif;?>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>