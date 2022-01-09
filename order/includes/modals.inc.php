    <?php
        $active_users = eModel::_select('users', array('deleted' => 0, 'enabled' => 1, 'where'=>'type_id IN (3,4,5)', 'order_by' => 'fullname'));
        $branches = eModel::_select('branches', array('deleted' => 0, 'enabled' => 1));
    ?>
    <!-- Modals -->
    <div class="modal fade frmCreateVouchers" id="createPaymentVouchers" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-header" style="background: #5cb85c; color: #fff;">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
					<h2 class="modal-title">Phiếu chi</h2>
				</div>
                <div class="modal-body">
                    <form class="not-print" name="frmCreatePaymentVouchers" id="frmCreatePaymentVouchers" method="post" action="">
	                    <div style="text-align: left;">Nhân viên: <span class="user_fullname"><?=$logged_user?$logged_user['fullname']:'không xác định'?></span></div><br />
	                    <select id="payment_shift_id" class="form-control">
		                    <option value="1">Ca 1</option>
		                    <option value="2">Ca 2</option>
	                    </select>
	                    <?php echo html_select($branches, 'id', 'branch_name', 'id="payment_branch" class="form-control"') ?>
                        <select id="payment_type" required="required" class="form-control">
                            <option value="">-- Loại phiếu chi</option>
                            <option value="p8">Đơn hàng</option>
	                        <option value="p7">Tiền Ship</option>
                            <option value="p1">Tiền nước - 16k</option>
                            <option value="p2">Chành xe - 5k</option>
                            <option value="p3">Hủy hóa đơn</option>
                            <option value="p4">Nhập hàng</option>
                            <option value="p5">Tạm ứng</option>
                            <option value="p6">Chi thu mua</option>
                            <option value="p10">Khác</option>
                        </select>
                        <input style="display: none;" type="text" required="required" placeholder="Mã hóa đơn" id="order_code" class="form-control number required for_p3" autocomplete="off" />
                        <select style="display: none;" id="reason" required="required" class="form-control for_p3">
                            <option value="">-- Lý do</option>
                            <option value="r1">Trùng</option>
                            <option value="r2">Hết món, báo đổi nhưng khách muốn hủy</option>
                            <option value="r3">Chọn sai món</option>
                            <option value="r4">Đang giao</option>
	                        <option value="r5">Confirm trễ khách hủy</option>
	                        <option value="r6">Đã làm giao tới trễ khách hủy</option>
                            <option value="r10">Khác</option>
                        </select>
	                    <select style="display: none;" id="ship_type" required="required" class="form-control for_p7">
		                    <option value="">-- Dịch vụ</option>
		                    <option value="s1">Lalamove</option>
		                    <option value="s2">Ahamove</option>
		                    <option value="s3">Grab</option>
		                    <option value="s4">Uber</option>
		                    <option value="s10">Khác</option>
	                    </select>
                        <select style="display: none;" id="p8_reason" required="required" class="form-control for_p8">
                            <option value="">-- Lý do</option>
                            <option value="t1">Ship Now</option>
                            <option value="t2">Grabpay Moca</option>
                            <option value="t3">Ship chưa trả</option>
                            <option value="t4">Đã thanh toán</option>
                            <option value="t5">Thanh toán sau</option>
                        </select>
                        <input style="display: none;" type="text" required="required" placeholder="Mã HĐ trùng" id="order_code_2" class="form-control required for_r1 second_level_option" autocomplete="off" />
                        <input style="display: none;" type="text" required="required" placeholder="Lý do" id="text_reason" class="form-control required for_r1 second_level_option" autocomplete="off" />
	                    <input style="display: none;" type="text" required="required" placeholder="Dịch vụ" id="other_ship" class="form-control required for_s10 second_level_option" autocomplete="off" />
                        <input style="display: none;" type="text" required="required" placeholder="Tên hàng" id="product_name" class="form-control required for_p4" autocomplete="off" />
                        <input style="display: none;" type="text" required="required" placeholder="Số lượng (kg, thùng, hộp..)" id="product_number" class="form-control required for_p4" autocomplete="off" />
                        <select style="display: none;" id="member_id" required="required" class="form-control for_p5 for_p6 for_r4 second_level_option">
                            <option value="">-- Nhân viên</option>
                            <?php
                                if ($active_users):
                                    foreach($active_users as $u):
                            ?>
                            <option value="<?=$u['user_id']?>"><?=$u['fullname']?></option>
                            <?php 
                                    endforeach;
                                endif;
                            ?> 
                        </select>
	                    <input style="display: none;" type="text" required="required" placeholder="Mã HĐ" id="order_code_3" class="form-control required for_p7 for_p8" autocomplete="off" />
                        <div class="input-group">
                            <input type="text" required="required" placeholder="Tổng tiền" id="voucher_amount" class="form-control number no-margin required" autocomplete="off" />
                            <span class="input-group-addon">.000</span>
                        </div>
                        <textarea style="display: none;" id="voucher_description" placeholder="Nội dung" class="form-control required" style="height: 150px;"></textarea>
                        <a style="display: none;" href="" class="btn btn-info" id="print_payment_voucher"><i class="fa fa-print"></i> In</a>
                        <a href="" class="btn btn-success" id="savePaymentVoucher"><i class="fa fa-save"></i> <span>Lưu</span></a>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                    </form>
                    <table class="vouchers_data" style="display: none;">
                        <tr><td style="font-size: 16px; font-weight: bold;">Tạm ứng</td></tr>
                        <tr><td>Nhân viên: <span class="member_name"></span></td></tr>
                        <tr><td>Số tiền: <span class="amount"></span>.000đ</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade frmCreateVouchers" id="createReceiptVouchers" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-header" style="background: #5cb85c; color: #fff;">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
					<h2 class="modal-title">Phiếu thu</h2>
				</div>
                <div class="modal-body">
                    <form name="frmCreateReceiptVouchers" id="frmCreateReceiptVouchers" method="post" action="">
	                    <div style="text-align: left;">Nhân viên: <span class="user_fullname"><?=$logged_user?$logged_user['fullname']:'không xác định'?></span></div><br />
	                    <select id="receipt_shift_id" class="form-control">
		                    <option value="1">Ca 1</option>
		                    <option value="2">Ca 2</option>
	                    </select>
	                    <?php echo html_select($branches, 'id', 'branch_name', 'id="receipt_branch" class="form-control"') ?>
                        <select id="receipt_type" required="required" class="form-control">
                            <option value="">-- Loại phiếu thu</option>
                            <option value="rt6">Tiền thu mua</option>
                            <option value="rt1">Hóa đơn giao hàng</option>
                            <option value="rt2">Hóa đơn mang về</option>
                            <option value="rt3">Hóa đơn tại chỗ</option>
                            <option value="rt4">Tổng kết ca 1</option>
                            <option value="rt5">Tổng kết ca 2</option>
                            <option value="rt10">Khác</option>
                        </select>
                        <select style="display: none;" id="member_id" required="required" class="form-control for_rt123">
                            <option value="">-- Nhân viên xử lý</option>
                            <?php
                                if ($active_users):
                                    foreach($active_users as $u):
                            ?>
                            <option value="<?=$u['user_id']?>"><?=$u['fullname']?></option>
                            <?php 
                                    endforeach;
                                endif;
                            ?> 
                        </select>
                        <div  style="display: none;" class="form-group for_rt45">
                            <div class="input-group date" id="datetimepickerReceiptVoucher" data-maxDate="<?=strtotime(date('Y-m-d'))?>" data-minDate="<?=strtotime(date('Y-m-d') .' - 7 days')?>" data-defaultDate="<?=strtotime(date('Y-m-d'))?>">
                                <input type="text" id="datepicker_value" class="form-control no-margin" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" required="required" placeholder="Tổng tiền" id="voucher_amount" class="form-control number no-margin required" autocomplete="off" />
                            <span class="input-group-addon">.000</span>
                        </div>
                        <textarea style="display: none;" id="voucher_description" placeholder="Nội dung" class="form-control required" style="height: 150px;"></textarea>
                        <a href="" class="btn btn-success" id="saveReceiptVoucher"><i class="fa fa-save"></i> <span>Lưu</span></a>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="finishShift" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-header" style="background: #5cb85c; color: #fff;">
					<button aria-hidden="true" data-dismiss="modal" class="close not-print" type="button">×</button>
					<h2 class="modal-title">Kết ca</h2>
                    <h1 class="printing modal-title"></h1>
				</div>
                <div class="modal-body" style="font-size:  16px;text-align: left;"></div>
                <div class="modal-footer">
                    <?php echo html_select($branches, 'id', 'branch_name', 'id="finish_branch" class="not-print form-control pull-left" style="width: 150px;max-width: 50%;"') ?>
                    <select id="shift_id" class="form-control not-print  pull-left" style="width: 100px;max-width: 50%;margin-left: 10px;">
                        <option value="1">Ca 1</option>
                        <option value="2">Ca 2</option>
                    </select>
                    <div class="clear not-print"></div>
                    <span>Nhân viên: <span class="user_fullname"><?=$logged_user?$logged_user['fullname']:'không xác định'?></span></span>
					<a onclick="window.print();" href="" class="btn btn-info not-print" id="print_shift_data"><i class="fa fa-print"></i> In</a>
                    <a href="" class="btn btn-success not-print" id="agree_shift_data"><i class="fa fa-check"></i> <span>Kết ca</span></a>
                    <button data-dismiss="modal" class="btn btn-default not-print" type="button">Đóng</button>
				</div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="loginFromFrontend" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-header" style="background: #5cb85c; color: #fff;">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
					<h2 class="modal-title">Đăng nhập</h2>
				</div>
                <div class="modal-body" style="font-size:  16px;text-align: left;">
                    <form id="loginFrm" action="" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Tài khoản" name="username" id="username" type="text" maxlength="40"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Mật khẩu" name="password" id="password" type="password" value="" maxlength="40"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="submitLogin" class="btn btn-success"><i class="fa fa-sign-in"></i>&nbsp;<span>Đăng nhập</span></button>
                                <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    