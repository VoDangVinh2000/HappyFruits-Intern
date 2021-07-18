                    <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-salaryadvanceslist">
                        <thead>
                            <tr>
                                <th style="min-width: 100px;">Ngày</th>
                                <th style="min-width: 60px;">Số tiền x1000</th>
                                <th  style="min-width: 60px;">Nhân viên</th>
                                <th>Nội dung</th>
                                <th style="width:60px" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($records): ?>
                                <?php foreach($records as $item):?>
                            <tr id="<?=$item['id']?>">
                                <td data-value="<?=strtotime($item['date_time'])?>"><a href="<?=BASE_URL. $URIs['salary_advances']?>/<?=$item['id']?>"><?=date('d/m/Y H:i:s', strtotime($item['date_time']))?></a></td>
                                <td data-value="<?=$item['amount']?>"><input type="text" style="width: 40px;text-align: right;" maxlength="4" value="<?=$item['amount']?>" class="amount" /></td>
                                <td><?=$item['fullname']?></td>
                                <td class="has_tooltip">
                                    <span><?php echo word_limiter($item['description'], 20);?></span>
                                    <div class="hidden tooltip_content">
                                        <p style="margin-bottom: 0;"><?=str_replace("\n",'<br/>', $item['description'])?></p>
                                    </div>
                                </td>
                                <td class="center not_filter">
                                    <a target="_blank" href="<?=BASE_URL. $URIs['salary_advances']?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                    <?php if (Users::can_access('salaryadvance', 'delete')):?>
                                    <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    <?php endif;?>
                                </td>
                            </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
