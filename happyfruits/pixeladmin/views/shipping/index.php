    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter_section">
                        <ul>
                            <li><a class="btn btn-info" href="#" data-toggle="modal" data-target="#salary_for_delivery">Bảng tính lương giao hàng</a></li>
                        </ul>
                        <div class="clear"></div>
                        <?php if(Users::is_member()):?>
                        <p style="font-size: 90%; font-style: italic;">Thông tin giao hàng của tháng trước sẽ không hiển thị sau ngày 15 của tháng hiện tại.</p>
                        <?php endif;?>
                    </div>
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("shipping/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                    <?php if($filter_keyword):?>
	                    <li>
		                    <a id="filter_search" class="btn btn-success"><i class="fa fa-search"></i>&nbsp;Tìm</a>
	                    </li>
	                    <li>
		                    <a id="filter_back" class="btn btn-info"><i class="fa fa-undo"></i>&nbsp;Trở lại danh sách</a>
	                    </li>
                    <?php else:?>
	                    <?php if(Users::is_member()):?>
		                    <li>Tháng:
			                    <select id="filter_month" class="form-control">
				                    <?php
				                    $m = date('m');
				                    if ($m == 1):
					                    ?>
					                    <?php if(date('d') < 15):?>
					                    <option value="12">12/<?=date('Y')-1?></option>
				                    <?php endif;?>
					                    <option value="1" selected="selected">01/<?=date('Y')?></option>
				                    <?php else:?>
					                    <?php if(date('d') < 15):?>
						                    <option value="<?=$m-1?>"><?=$m-1?></option>
					                    <?php endif;?>
					                    <option value="<?=$m?>" selected="selected"><?=$m?></option>
				                    <?php endif;?>
			                    </select>
		                    </li>
	                    <?php else:?>
		                    <?php if(!$filter_keyword):?>
			                    <li>Tháng:
				                    <?php echo html_select_month('id="filter_month" class="form-control"', 'Tất cả', $filter_keyword?'':date('m')) ?>
			                    </li>
			                    <?php if ($members && Users::can_access($view, 'filter')):?>
				                    <li>Năm:
					                    <?php echo html_select_year('id="filter_year" class="form-control"', 'Tất cả', $filter_keyword?'':date('Y')) ?>
				                    </li>
				                    <li>Tên: <?php echo html_select($members, 'user_id', 'fullname', ' id="filter_member" class="form-control"', 'Tất cả'); ?></li>
			                    <?php else:?>
				                    <input type="hidden" id="filter_year" name="filter_year" value="<?=date('Y')?>" />
				                    <input type="hidden" id="filter_member" name="filter_member" value="<?=$logged_user['user_id']?>" />
			                    <?php endif;?>
			                    <?php if (0 && Users::can_access($view, 'view_summary')):?>
				                    <li><div class="summary"><span>Số đơn hàng: </span><span class="number_of_records"></span></div></li>
				                    <li><div class="summary"><span>Tổng: </span><span class="shipping_total"></span>đ</div></li>
			                    <?php endif;?>
		                    <?php endif;?>
	                    <?php endif;?>
                    <?php endif;?>
                        </ul>
                        <input type="hidden" id="filterString" value="<?=$filter_keyword?>" />
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->
    <div class="modal modal-alert modal-success fade" id="salary_for_delivery" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header medium-header">
					<i class="fa fa-info-circle"></i>
				</div>
				<div class="modal-title"><h2>Bảng tính lương giao hàng</h2></div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Số phần</h2>
                            <?php
                            $new_table = array();
                            $headers = array();
                            foreach($shipping_cost as $key => $row)
                            {
                                $headers[] = $key;
                                foreach($row as $k => $v)
                                {
                                    if (!isset($new_table[$k]))
                                        $new_table[$k] = array();
                                    $new_table[$k][$key] = $v;
                                }
                            }
                            ?>
                            <table class="border middle">
                                <?php if(count($new_table) > 1):?>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <?php foreach ($new_table as $k => $v):?>
                                            <th>&gt <?=$k?>km</th>
                                        <?php endforeach;?>
                                    </tr>
                                <?php endif; ?>
                                <?php foreach($headers as $h):?>
                                    <tr>
                                        <th>Đơn hàng &gt <?=$h?> phần/kg</th>
                                        <?php foreach ($new_table as $k => $v):?>
                                            <td><?=$v[$h]?>k</td>
                                        <?php endforeach;?>
                                    </tr>
                                <?php endforeach;?>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h2>Hộp/giỏ quà tặng</h2>
                            <table class="border middle">
                                <?php foreach($shipping_cost2 as $min_total => $value):?>
                                    <tr>
                                        <th>Hộp/giỏ quà tặng  &gt <?=$min_total?>k</th>
                                        <td><?=$value?>k</td>
                                    </tr>
                                <?php endforeach;?>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <p>Cập nhật số phần tương ứng ở cột trái khi giao giỏ/ hộp quà.</p>
                    <p>
                        Ngoài bảng tính trên, còn có phụ cấp xăng theo công thức:<br/>
                        <b>Số km đi được theo đơn (thống kê tổng trên hệ thống trong tháng) x 2 chia 40 * giá xăng.</b>
                    </p>
                </div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-success" type="button">Đóng</button>
				</div>
			</div> <!-- / .modal-content -->
		</div> <!-- / .modal-dialog -->
	</div>