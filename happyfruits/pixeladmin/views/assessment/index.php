    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter_section">
                        <ul>
                            <?php if (Users::can('view_report', 'assessment')):?>
                            <li><a id="export_assessment" class="btn btn-success"><i class="fa fa-cloud-download"></i> Xuất đánh giá</a></li>
                            <li><a id="export_working_time" class="btn btn-success"><i class="fa fa-cloud-download"></i> Xuất chấm công</a></li>
                            <?php endif;?>
                            <?php if(Users::is_member()):
                                $times_to_do_assessment_late = MAX_TIMES_TO_DO_ASSESSMENT_LATE - $assessmentmodel->get_late_assessment_in_month($logged_user['user_id']);
                                if (!empty($times_to_do_assessment_late)):
                            ?>
                            <li><a class="btn btn-success" title="Mỗi tháng có <?=MAX_TIMES_TO_DO_ASSESSMENT_LATE?> lần thêm đánh giá trễ, thời gian trễ không quá 7 ngày." href="<?=BASE_URL. $URIs['assessment'].'/them-tre'?>" id="add_assessment_late" class="btn">Thêm trễ (<?=$times_to_do_assessment_late?>)</a></li>
                            <?php endif;?>
                            <li><a class="btn btn-success" title="Thêm chấm công, phí giữ xe, phụ cấp trễ không quá 10 ngày (KPI - 6)" href="<?=BASE_URL. $URIs['assessment'].'/them-cham-cong'?>" id="add_working_time" class="btn">Thêm chấm công</a></li>
                            <?php endif; ?>
                            <li><a class="btn btn-info" href="#" data-toggle="modal" data-target="#how_we_calculate_kpi">Cách tính chỉ số KPI</a></li>
                            <li><a class="btn btn-info" href="#" data-toggle="modal" data-target="#how_to_do_assessment">Hướng dẫn đánh giá</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("assessment/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <?php if (Users::can('filter', 'assessment')):?>
                            <li>
                                Ngày: <?php echo html_select_day('id="filter_day" class="form-control filter_day"', 'Tất cả', date('d')) ?>
                            </li>
                            <?php else:?>
                            <input type="hidden" id="filter_day" name="filter_day" value="" />
                            <?php endif;?>
                            <li>Tháng: 
                                <?php echo html_select_month('id="filter_month" class="form-control"', null, date('m')) ?>
                            </li>
                            <li>Năm: 
                                <?php echo html_select_year('id="filter_year" class="form-control"', null, date('Y')) ?>
                            </li>
                            <?php if (Users::can('filter', 'assessment')):?>
                                <?php if ($members):?>
                            <li>Tên: <?php echo html_select($members, 'user_id', 'fullname', ' id="filter_member" class="form-control"', 'Tất cả'); ?></li>
                                <?php endif;?>
                            <?php else:?>
                            <input type="hidden" id="filter_member" name="filter_member" value="<?=$logged_user['user_id']?>" />
                            <?php endif;?>
                            <?php if(Users::is_member()):?>
                            <li><div class="summary"><span>Tổng giờ làm: </span><span class="total_working_time"></span></div></li>
                            <?php endif;?>
                        </ul>
                        <div class="clear"></div>
                        <input type="hidden" id="filterString" value="" />
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
    <div class="modal modal-alert modal-success fade" id="how_we_calculate_kpi" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header medium-header">
					<i class="fa fa-info-circle"></i>
				</div>
				<div class="modal-title"><h2>Cách tính chỉ số KPI</h2></div>
				<div class="modal-body" style="font-size: 15px;">
                    <p>Mỗi ngày, nhân viên sẽ có 10 điểm</p>
                    <table class="border middle">
                        <tr><td>Tiến độ công việc chưa tốt</td><td class="center" style="width: 40px;">-2</td></tr>
                        <tr><td>Vi phạm nội quy</td><td class="center">-2</td></tr>
                        <tr><td>Làm hỏng vật dụng</td><td class="center">-2</td></tr>
                        <tr><td>Không tập trung trong công việc</td><td class="center">-2</td></tr>
                        <tr><td>Quản lý nhắc nhở</td><td class="center">-2</td></tr>
                        <tr><td colspan="2" class="bold">Chuyên cần</td></tr>
                        <tr><td>Đi trễ</td><td class="center">-2</td></tr>
                        <tr><td>Về sớm</td><td class="center">-2</td></tr>
                        <tr><td>Nghỉ có phép</td><td class="center">-5</td></tr>
                        <tr><td>Nghỉ không phép</td><td class="center">-10</td></tr>
                    </table>
                </div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-success" type="button">Đóng</button>
				</div>
			</div> <!-- / .modal-content -->
		</div> <!-- / .modal-dialog -->
	</div>
    <div class="modal modal-alert modal-success fade" id="how_to_do_assessment" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header medium-header">
					<i class="fa fa-info-circle"></i>
				</div>
				<div class="modal-title"><h2>Hướng dẫn đánh giá</h2></div>
				<div class="modal-body" style="text-align: left !important;font-size: 15px;">
                    <p><b>1. Tự giác đánh giá đúng/đủ mỗi ngày</b></p>
                    <p><b>2. Ngày Off:</b></p>
                    <p>- Off theo lịch cửa hàng xếp: Nghỉ có phép.</p>
                    <p>- Nghỉ xin phép đã duyệt, nghỉ gấp có báo trước 5h vào ca: Nghỉ có phép.</p>
                    <p>- Nghỉ không xin phép, nghỉ gấp không báo trước 5h vào ca: Nghỉ không phép.</p>
                    <p>- Ngày lễ/ ngày off toàn quán: Quán nghỉ.</p>
                    <p><b>3. Thêm trễ:</b></p>
                    <p>- Mỗi tháng có 3 lần thêm đánh giá trễ.</p>
                    <p>- Có thể thêm lại giờ làm việc, phí giữ xe của ngày <b>chưa</b> chấm công trong vòng 10 ngày. KPI <b>bị trừ 6</b> (chưa tập trung, có vi phạm và bị nhắc nhở) trong ngày đó.</p>
                </div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-success" type="button">Đóng</button>
				</div>
			</div> <!-- / .modal-content -->
		</div> <!-- / .modal-dialog -->
	</div>
