                    <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-voucherlist">
                        <thead>
                            <tr>
                                <th style="min-width: 130px;">Ngày</th>
                                <th style="min-width: 80px;">Loại</th>
                                <th style="min-width: 80px;">Số tiền</th>
                                <th  style="min-width: 60px;">Nhân viên</th>
                                <th  style="min-width: 60px;">Cửa hàng</th>
                                <th>Nội dung</th>
                                <th style="width:60px" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($vouchers): ?>
                                <?php foreach($vouchers as $item):
                                    $is_ediable = Vouchers::is_editable($item['id']);
                                ?>
                            <tr id="<?=$item['id']?>">
                                <td>
                                    <?php if ($is_ediable):?>
                                    <a href="<?=BASE_URL. $URIs['vouchers']?>/<?=$item['id']?>"><?=date('d/m/Y H:i:s', strtotime($item['date_time']))?></a>
                                    <?php else:?>
                                    <?=date('d/m/Y H:i:s', strtotime($item['date_time']))?>
                                    <?php endif;?>
                                </td>
                                <td><?=$item['voucher_type']?></td>
                                <td data-value="<?=$item['amount']?>"><input type="text" style="width: 80px;text-align: right;" maxlength="8" value="<?=intval($item['amount']*1000)?>" class="amount" /></td>
                                <td><?=$item['fullname']?></td>
                                <td><?=$item['branch_name']?></td>
                                <td class="has_tooltip">
                                    <span><?php echo word_limiter($item['description'], 20);?></span>
                                    <div class="hidden tooltip_content">
                                        <p style="margin-bottom: 0;"><?=str_replace("\n",'<br/>', $item['description'])?></p>
                                    </div>
                                </td>
                                <td class="center not_filter">
                                    <?php if ($is_ediable):?>
                                    <a target="_blank" href="<?=BASE_URL. $URIs['vouchers']?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                        <?php if(Users::can('delete', 'voucher')):?>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                        <?php endif;?>
                                    <?php endif;?>
                                </td>
                            </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
