                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-importlist">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">Mã</th>
                                    <th style="width: 100px;">Người nhập</th>
                                    <th style="width: 200px;">Ngày</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Chi tiết</th>
                                    <th>Ghi chú</th>
                                    <th style="width: 80px;" class="not_filter"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($import_records)): ?>
                                    <?php 
                                        foreach($import_records as $item):?>
                                <tr id="<?=$item['id']?>">
                                    <td class="center"><?=$item['id']?></td>
                                    <td class="center"><?=$item['fullname']?></td>
                                    <td data-value="<?=strtotime($item['import_date'])?>" class="center"><?=date('d/m/Y H:i:s', strtotime($item['import_date']))?></td>
                                    <td><?=Inventoryimport::getProvidersName($item['id'])?></td>
                                    <td class="has_tooltip">
                                        <?php 
                                            $details = $inventory_import_details_model->get_list(array('import_id' => $item['id']));
                                            $text = '';
                                            $more = '';
                                            if ($details)
                                            {
                                                $line = 0;
                                                foreach($details as $d)
                                                {
                                                    if ($more)
                                                        $more .= '<br/>';
                                                    $more .= formatQuantity($d['quantity']). ' ' . $d['unit']. ' ' . $d['name'];
                                                    $line++;
                                                    if ($line <= 2)
                                                        $text = $more;
                                                    else if ($line == 3)
                                                        $text .= '&#8230;';
                                                }
                                            }
                                        ?>
                                        <span><?=$text;?></span>
                                        <div class="hidden tooltip_content">
                                            <p><?=$more;?></p>
                                        </div>
                                    </td>
                                    <td><?=get_payment_status($item['payment_status'])?><?=$item['description']?'<br/>'.$item['description']:''?></td>
                                    <td class="center not_filter">
                                        <a href="<?=BASE_URL. (empty($is_fruit)?$URIs['inventory_import']:$URIs['inventory_import_fruits'])?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Xem chi tiết"><i class="fa fa-navicon"></i> Chi tiết</a>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>