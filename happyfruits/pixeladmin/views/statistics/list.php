                        <?php
                            $quantities = getvalue($statistics_data, 'sold_quantities');
                            $orders_totals = getvalue($statistics_data, 'orders_totals');
                            $number_of_orders = getvalue($statistics_data, 'number_of_orders');
                            $totals_quantities = array();
                            $total_quantity = array();
                        ?>
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-statisticslist">
                            <thead>
                                <tr>
                                    <th>Nhóm</th>
                                    <th style="width: 200px;">Tên</th>
                                    <?php foreach ($order_types as $type):
                                        $totals_quantities[$type['id']] = 0;
                                    ?>
                                    <th><?=$type['type_name']?></th>
                                    <?php endforeach;?>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($quantities): ?>
                                    <?php foreach($quantities as $key => $item):
                                        $total_quantity[$key] = 0;
                                        $names = explode('|', $key);
                                        $category_name_without_utf8 = remove_unicode($names[0]);
                                        $product_name_without_utf8 = remove_unicode($names[1]);
                                    ?>
                                <tr>
                                    <td><?=$names[0]?><span class="hidden">nhomhang<?=$category_name_without_utf8?></span></td>
                                    <td><?=$names[1]?><span class="hidden"><?=$product_name_without_utf8?></span></td>
                                    <?php foreach ($order_types as $type):
                                        $quantity = !empty($item[$type['id']])?$item[$type['id']]:0;
                                        $totals_quantities[$type['id']] += $quantity;
                                        $total_quantity[$key] += $quantity;
                                    ?>
                                    <td class="center"><?=$quantity?></td>
                                    <?php endforeach;?>
                                    <th><?=$total_quantity[$key]?></th>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                            <?php if(!empty($quantities) || !empty($orders_totals)): ?>
                            <tfoot>
                                <?php if(!empty($quantities)):?>
                                <tr>
                                    <td colspan="2" style="text-align: center; font-weight: bold;font-size: 110%;">Tổng số lượng</td>
                                    <?php foreach ($order_types as $type):?>
                                    <td class="center" style="font-weight: bold;font-size: 110%;"><?=formatQuantity($totals_quantities[$type['id']])?></td>
                                    <?php endforeach;?>
                                    <td class="center" style="font-weight: bold;font-size: 110%;"><?=array_sum($total_quantity)?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(!empty($orders_totals)):?>
                                <tr><td colspan="<?=count($order_types) + 3?>">&nbsp;</td></tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; font-weight: bold;font-size: 110%;">Tổng đơn hàng</td>
                                    <?php foreach ($order_types as $type):?>
                                    <td class="center" style="font-weight: bold;font-size: 110%;"><?=getvalue($number_of_orders, $type['id'], 0)?></td>
                                    <?php endforeach;?>
                                    <td class="center" style="font-weight: bold;font-size: 110%;"><?=array_sum($number_of_orders)?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; font-weight: bold;font-size: 110%;">Tổng doanh số</td>
                                    <?php foreach ($order_types as $type):?>
                                    <td class="center" style="font-weight: bold;font-size: 110%;"><?=number_format(getvalue($orders_totals, $type['id'], 0), 3, '.', '.')?>đ</td>
                                    <?php endforeach;?>
                                    <td class="center" style="font-weight: bold;font-size: 110%;"><?=number_format(array_sum($orders_totals), 3, '.', '.')?>đ</td>
                                </tr>
                                <?php endif;?>
                        	</tfoot>
                            <?php endif;?>
                        </table>