                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-feeslist">
                            <thead>
                                <tr>
                                    <th>Phường</th>
                                    <th>Tổng tối thiểu</th>
                                    <th>Phí giao hàng</th>
                                    <th>Tổng giao miễn phí</th>
                                    <th class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($fee_details)): ?>
                                    <?php  
                                        $wards = getvalue($fee_details, 'wards');
                                        if ($wards):
                                            foreach($wards as $w => $item):
                                    ?>
                                <tr id="<?=$w?>">
                                    <td><?=$w?></td>
                                    <td><input type="text" maxlength="3" class="ward_min number" value="<?=getvalue($item, 'ward_min')?>"/></td>
                                    <td><input type="text" maxlength="2" class="ward_fee number" value="<?=getvalue($item, 'ward_fee')?>"/></td>
                                    <td><input type="text" maxlength="3" class="ward_free_ship number" value="<?=getvalue($item, 'ward_free_ship')?>"/></td>
                                    <td class="center">
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <input type="hidden" id="district_min" value="<?=isset($fee_details)?getvalue($fee_details, 'min'):''?>" />
                        <input type="hidden" id="district_fee" value="<?=isset($fee_details)?getvalue($fee_details, 'fee'):''?>" />
                        <input type="hidden" id="district_free_ship" value="<?=isset($fee_details)?getvalue($fee_details, 'free_ship'):''?>" />