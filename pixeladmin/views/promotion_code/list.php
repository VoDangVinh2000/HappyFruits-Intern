                    <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-promotioncodelist">
                        <thead>
                            <tr>
                                <th style="min-width: 130px;">Ngày bắt đầu</th>
                                <th style="min-width: 130px;">Ngày kết thúc</th>
                                <th style="min-width: 80px;">Mã</th>
                                <th style="min-width: 130px;">Giảm</th>
                                <th>Ghi chú</th>
                                <th style="width:120px" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($promotion_codes): ?>
                                <?php foreach($promotion_codes as $item):?>
                            <tr id="<?=$item['id']?>">
                                <td data-value="<?=strtotime($item['start_date'])?>"><?=date('d/m/Y H:i:s', strtotime($item['start_date']))?></td>
                                <td data-value="<?=strtotime($item['end_date'])?>"><?=date('d/m/Y H:i:s', strtotime($item['end_date']))?></td>
                                <td><?=$item['code']?></td>
                                <td><?=$item['discount']*100?>%</td>
                                <td class="has_tooltip">
                                    <span><?php echo word_limiter($item['description'], 20);?></span>
                                    <div class="hidden tooltip_content">
                                        <p style="margin-bottom: 0;"><?=str_replace("\n",'<br/>', $item['description'])?></p>
                                    </div>
                                </td>
                                <td class="center not_filter">
                                    <a target="_blank" href="<?=BASE_URL. $URIs['promotion_codes']?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                    <?php if (Users::can_access('promotioncode', 'delete')):?>
                                    <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    <?php endif;?>
                                </td>
                            </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
