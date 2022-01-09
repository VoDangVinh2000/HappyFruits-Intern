                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-exportlist">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">Mã</th>
                                    <th style="width: 100px;">Người xuất</th>
                                    <th style="width: 200px;">Ngày</th>
                                    <th style="width: 100px;">Kho xuất</th>
                                    <th>Chi tiết</th>
                                    <th>Ghi chú</th>
                                    <th style="width: 80px;" class="not_filter"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($export_records)): ?>
                                    <?php 
                                        foreach($export_records as $item):?>
                                <tr id="<?=$item['id']?>">
                                    <td class="center"><?=$item['id']?></td>
                                    <td class="center"><?=$item['fullname']?></td>
                                    <td data-value="<?=strtotime($item['export_date'])?>" class="center"><?=date('d/m/Y H:i:s', strtotime($item['export_date']))?></td>
                                    <td><?=$item['warehouse_name']?></td>
                                    <td class="has_tooltip">
                                        <?php 
                                            $details = $inventory_export_details_model->get_list(array('export_id' => $item['id']));
                                            $text = '';
                                            $more = '';
                                            if ($details)
                                            {
                                                $line = 0;
                                                foreach($details as $d)
                                                {
                                                    if ($more)
                                                        $more .= '<br/>';
                                                    $line_content = '';
                                                    if (floatval($d['quantity']))
                                                        $line_content .= $d['quantity']. ' ' . $d['unit'];
                                                    if (floatval($d['quantity_in_details']))
                                                    {
                                                        if ($line_content)
                                                            $line_content .= " - ";
                                                        $line_content .= intval($d['quantity_in_details']). ' ' . $d['unit_in_details'];
                                                    }
                                                    $line_content .= ' '. $d['name'];
                                                    
                                                    $more .= $line_content;
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
                                    <th><?=$item['description']?></th>
                                    <td class="center not_filter">
                                        <a href="<?=BASE_URL. (empty($is_fruit)?$URIs['inventory_export']:$URIs['inventory_export_fruits'])?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Xem chi tiết"><i class="fa fa-navicon"></i> Chi tiết</a>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>