                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-feeslist">
                            <thead>
                                <tr>
                                    <th>Quận</th>
                                    <th>Tổng tối thiểu</th>
                                    <th>Phí giao hàng</th>
                                    <th class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($items)): ?>
                                    <?php
                                        foreach($items as $item):
                                    ?>
                                <tr id="<?=$item['id']?>">
                                    <td><?=getvalue($item, 'district')?></td>
                                    <td><input type="text" maxlength="3" class="min_total" value="<?=getvalue($item, 'min_total')?>"/></td>
                                    <td><input type="text" maxlength="2" class="fee" value="<?=getvalue($item, 'fee')?>"/></td>
                                    <td class="center">
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>