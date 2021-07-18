                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-shippingstatisticslist">
                            <thead>
                                <tr>
                                    <th>Tài khoản</th>
                                    <th>Tên</th>
                                    <th>Tổng số Km</th>
                                    <th>Tổng số hóa đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($statistics_data)): 
                                        foreach($statistics_data as $item):
                                ?>
                                <tr>
                                    <td><?=$item['username']?></td>
                                    <td><?=$item['fullname']?></td>
                                    <td class="center" data-value="<?=$item['total_distance']?>"><?=number_format($item['total_distance'], '2')?></td>
                                    <td class="center" ><?=$item['total_order']?></td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>