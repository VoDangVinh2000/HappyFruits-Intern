                        <?php
                            $total = 0;
                            $number_of_records = 0;
                        ?>
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-shippinglist">
                            <thead>
                                <tr>
                                    <?php if (!Users::is_member()):?>
                                    <th style="width: 70px;">Nhân viên</th>
                                    <?php endif;?>
                                    <th style="width: 75px;">Thời gian</th>
                                    <th>Thông tin giao hàng</th>
                                    <th style="width: 100px;">Tổng hóa đơn</th>
                                    <th style="width: 60px;">Số phần</th>
                                    <th style="width: 30px;">Km</th>
                                    <th style="width: 30px;" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($shipping_details)): ?>
                                    <?php 
                                        foreach($shipping_details as $item):
                                            $number_of_records++;
                                            $total += $item['total'];
                                            if (!empty($item['customer_id']))
                                                $shipping_info = $item['address'].($item['district']?', Q'.$item['district']:'').' - '.$item['mobile'];
                                            else
                                                $shipping_info = $item['description'];
                                            $code = $item['code']?$item['code']:$item['order_id'];
                                    ?>
                                <tr id="<?=$item['id']?>">
                                    <?php if (!Users::is_member()):?>
                                    <td><?=$item['username']?></td>
                                    <?php endif;?>
                                    <td class="center"><?=date('Y-m-d', strtotime($item['date_time']))?></td>
                                    <td>
                                        <?php if ($code):?>
                                        <a href="<?=ROOT_URL. 'in/'.$code?>" target="_blank"><?=$shipping_info?></a>
                                        <?php else:?>
                                        <?=$shipping_info?>
                                        <?php endif;?>
                                    </td>
                                    <?php if (Users::can_access($view, 'edit')):?>
                                    <td data-value="<?=$item['total']?>"><input type="text" style="width: 40px;text-align: right;" maxlength="4" value="<?=$item['total']?>" class="total" />.000</td>
                                    <td><input style="width: 50px;" type="text" value="<?=$item['number_of_dishes']?>" class="number_of_dishes" maxlength="3" /></td>
                                    <td><input style="width: 30px;" type="text" value="<?=$item['distance']?>" class="distance" maxlength="5" /></td>
                                    <?php else:?>
                                    <td data-value="<?=$item['total']?>"><?=number_format($item['total'], '3', '.', '.')?></td>
                                    <td><?=$item['number_of_dishes']?></td>
                                    <td><?=$item['distance']?></td>
                                    <?php endif;?>
                                    <td class="center not_filter">
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <input type="hidden" id="shipping_total" value="<?=number_format($total,3,'.','.')?>" />
                        <input type="hidden" id="number_of_records" value="<?=$number_of_records?>" />