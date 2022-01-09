<div id="content-wrapper">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					<i class="fa fa-plus"></i> Thêm chấm công<br/>
					<p style="font-size: 14px; font-style: italic;margin: 10px 0 0 0;">Vui lòng tự đánh giá trung thực mỗi ngày.</p>
				</h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<form id="frmAssessment" data-toggle="validator" role="form" method="post" action="<?=BASE_URL?>xu-ly">
					<div class="form-group col-lg-6 col-md-6">
						<label for="assessment_date" class="control-label">Ngày</label>
						<input class="form-control" size="16" id="assessment_date" name="assessment_date" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=Users::is_super_admin()?date('d/m/Y', strtotime('-3 months')):date('d/m/Y', strtotime('-10 days'))?>" data-date-enddate="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" readonly=""/>
					</div>
					<div class="clear"></div>
					<div class="form-group col-lg-6 col-md-6 hide-when-off">
						<?php if(Users::is_fulltime()): ?>
							<label class="control-label">Chấm công *</label><br />
							<label>Fulltime</label>
							<input type="hidden" name="working_time" value="9" />
						<?php else: ?>
							<label class="control-label">Chấm công (Partime)*</label><br />
							<label class="normal" for="working_time">Số giờ/ngày</label>
							<input type="text" maxlength="5" class="form-control float normal inline" id="working_time" name="working_time" required="" data-error="Vui lòng số giờ làm việc" />
							<div class="help-block with-errors"></div>
						<?php endif; ?>
					</div>
					<div class="form-group col-lg-6 col-md-6 hide-when-off">
						<label class="control-label">Tăng ca (giờ)</label><br />
						<input type="text" maxlength="4" class="form-control float normal inline" id="overtime" name="overtime" value="0" />
					</div>
					<div class="clear"></div>
					<div class="form-group col-lg-6 col-md-6 hide-when-off">
						<label class="control-label" for="has_parked">Giữ xe</label>&nbsp;<input type="checkbox" name="has_parked" id="has_parked" value="1"/>
						<div style="display: inline;margin-left: 15px;" class="parking_fee_container hidden"><label class="control-label">Phí * </label><input type="input" name="parking_fee" id="parking_fee" style="width: 60px !important;text-align: right;" required="" class="form-control normal number inline" value="<?=getvalue($obj, 'parking_fee', 0)?>" /><span class="form-currency">.000đ</span></div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<label class="control-label" for="description">Ghi chú</label>
						<textarea class="form-control" id="description" name="description" rows="2" cols="30"></textarea>
					</div>
					<div class="form-group">
						<button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
						<a href="<?=BASE_URL. $URIs['assessment']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
						<input type="hidden" name="action" value="add_working_time"/>
						<input type="hidden" name="user_id" id="user_id" value="<?=$logged_user['user_id']?>"/>
						<input type="hidden" name="has_allowance" value="<?=getvalue($logged_user, 'is_fulltime')?1:0?>" />
					</div>
				</form>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->