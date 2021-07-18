<style>
    label.control-label{font-size: 16px;}
</style>
<div id="content-wrapper">
	<div id="page-wrapper">
		<?php if (!$id || !$obj):?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header"><i class="fa fa-warning"></i> ID bảng đánh giá không đúng!!</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		<?php else:?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">
						<i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> đánh giá<br/>
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
							<input class="form-control" size="16" id="assessment_date" name="assessment_date" type="text" data-date-format="dd/mm/yyyy" value="<?=getvalue($obj, 'assessment_date')?date('d/m/Y', strtotime($obj['assessment_date'])):''?>" readonly=""/>
						</div>
						<div class="clear"></div>
						<div class="form-group col-lg-6 col-md-6">
							<label class="control-label">Nhân viên</label>
							<input class="form-control" type="text" value="<?=getvalue($obj, 'fullname')?>" readonly=""/>
						</div>
						<div class="clear"></div>
						<div class="form-group">
							<label class="control-label">Chuyên cần</label><br />
							<?php
							$assiduousness = unserialize(ASSIDUOUSNESS_ARR);
							foreach($assiduousness as $value => $label):
								?>
								<label class="normal" for="assiduousness_<?=$value?>"><?=$label?></label> <input type="radio" name="assiduousness" id="assiduousness_<?=$value?>" value="<?=$value?>" <?php echo getvalue($obj, 'assiduousness')==$value?'checked="checked"':'' ?>/>
								&nbsp;&nbsp;&nbsp;
							<?php endforeach; ?>
							<div class="<?=intval(getvalue($obj, 'minutes_late'))?'':'hidden'?> minutes_late_container" style="margin-top: 10px;">
								<label class="normal" for="minutes_late">Số phút *</label> <input type="input" name="minutes_late" id="minutes_late" class="form-control normal inline" value="<?=formatQuantity(getvalue($obj, 'minutes_late'))?>" />
							</div>
						</div>
						<div class="form-group hide-when-off">
							<label class="control-label">Tiến độ công việc được phân công<span class="required"> *</span></label><br />
							<?php
							$work_process = unserialize(WORK_PROCESS_ARR);
							foreach($work_process as $value => $label):
								?>
								<label class="normal" for="work_process_<?=$value?>"><?=$label?></label> <input type="radio" name="work_process" id="work_process_<?=$value?>" value="<?=$value?>" <?php echo getvalue($obj, 'work_process')==$value?'checked="checked"':'' ?>/>
								&nbsp;&nbsp;&nbsp;
							<?php endforeach; ?>
						</div>
                        <div class="form-group hide-when-off">
                            <label class="control-label">"Trót quên" nội quy<span class="required"> *</span></label><br />
                            <?php
                            $rules_violation = unserialize(RULES_VIOLATION_ARR);
                            foreach($rules_violation as $value => $label):
                                ?>
                                <label class="normal" for="rules_violation_<?=$value?>"><?=$label?></label> <input type="radio" name="rules_violation" id="rules_violation_<?=$value?>" value="<?=$value?>" <?php echo getvalue($obj, 'rules_violation')==$value?'checked="checked"':'' ?>/>
                                &nbsp;&nbsp;&nbsp;
                            <?php endforeach; ?>
                            <div class="<?=getvalue($obj, 'violated_rule')?'':'hidden'?> violated-rule-container" style="margin-top: 10px;">
                                <label class="normal" for="violated_rule">Nội quy vi phạm *</label> <input type="input" name="violated_rule" id="violated_rule" class="form-control normal inline" value="<?=getvalue($obj, 'violated_rule')?>" /><br/><br/>
                                <label class="normal" for="self_criticism">Đã làm bản tự kiểm</label> <input type="checkbox" name="self_criticism" id="self_criticism" class="form-control normal inline" value="1" <?php echo getvalue($obj, 'self_criticism')==1?'checked="checked"':'' ?>/>
                            </div>
                        </div>
                        <div class="form-group hide-when-off">
                            <label class="control-label">Quản lý có nhắc nhở<span class="required"> *</span></label><br />
                            <?php
                            $being_prompted = unserialize(BEING_PROMPTED_ARR);
                            foreach($being_prompted as $value => $label):
                                ?>
                                <label class="normal" for="being_prompted_<?=$value?>"><?=$label?></label> <input type="radio" name="being_prompted" id="being_prompted_<?=$value?>" value="<?=$value?>" <?php echo getvalue($obj, 'being_prompted')==$value?'checked="checked"':'' ?>/>
                                &nbsp;&nbsp;&nbsp;
                            <?php endforeach; ?>
                        </div>
						<div class="form-group hide-when-off">
							<label class="control-label">Tập trung công việc<span class="required"> *</span></label><br />
							<?php
							$concentration = unserialize(CONCENTRATION_ARR);
							foreach($concentration as $value => $label):
								?>
								<label class="normal" for="concentration_<?=$value?>"><?=$label?></label> <input type="radio" name="concentration" id="concentration_<?=$value?>" value="<?=$value?>" <?php echo getvalue($obj, 'concentration')==$value?'checked="checked"':'' ?>/>
								&nbsp;&nbsp;&nbsp;
							<?php endforeach; ?>
                            <div class="<?=getvalue($obj, 'disconcentrated')?'':'hidden'?> disconcentrated-container" style="margin-top: 10px;">
                                <label class="normal" for="disconcentrated">Vấn đề chưa tập trung *</label> <input type="input" name="disconcentrated" id="disconcentrated" class="form-control normal inline" value="<?=getvalue($obj, 'disconcentrated')?>" />
                            </div>
						</div>

						<div class="form-group hide-when-off">
							<label class="control-label">Làm hỏng vật dụng</label><br />
							<label class="normal" for="breaking_things_no">Không</label> <input type="radio" name="break_things" id="breaking_things_no" value="0" <?php echo getvalue($obj, 'breaking_things')?'':'checked="checked"' ?> />
							&nbsp;&nbsp;&nbsp;
							<label class="normal" for="breaking_things_yes">Có</label> <input type="radio" name="break_things" id="breaking_things_yes" value="1" <?php echo getvalue($obj, 'breaking_things')?'checked="checked"':'' ?> />
							<div class="<?=getvalue($obj, 'breaking_things')?'':'hidden'?>" style="margin-top: 10px;">
								<label class="normal" for="breaking_things">Tên vật dụng *</label> <input type="input" name="breaking_things" id="breaking_things" class="form-control normal inline" value="<?php echo getvalue($obj, 'breaking_things')?>" />
							</div>
						</div>

						<div class="clear"></div>
						<div class="form-group col-lg-6 col-md-6 hide-when-off">
							<?php if(Users::is_fulltime(getvalue($obj, 'user_id'))): ?>
								<label class="control-label">Chấm công *</label><br />
								<label>Fulltime</label>
								<input type="hidden" name="working_time" value="<?=getvalue($obj, 'working_time')?>" />
							<?php else: ?>
								<label class="control-label">Chấm công (Partime) *</label><br />
								<label class="normal" for="working_time">Số giờ/ngày</label>
								<input type="text" class="form-control float normal inline" id="working_time" name="working_time" maxlength="4" required="" data-error="Vui lòng số giờ làm việc" value="<?=getvalue($obj, 'working_time')?>" />
								<div class="help-block with-errors"></div>
							<?php endif; ?>
						</div>
						<div class="form-group col-lg-6 col-md-6 hide-when-off">
							<label class="control-label">Tăng ca (giờ)</label><br />
							<input type="text" maxlength="4" class="form-control float normal inline" id="overtime" name="overtime" value="<?=getvalue($obj, 'overtime')?>" />
						</div>
						<div class="clear"></div>
						<div class="form-group col-lg-6 col-md-6 hide-when-off">
							<label class="control-label" for="has_parked">Giữ xe</label>&nbsp;<input type="checkbox" name="has_parked" id="has_parked" value="1" <?=getvalue($obj, 'parking_fee')?'checked="checked"':''?>/>
							<div style="display: inline;margin-left: 15px;" class="parking_fee_container <?=getvalue($obj, 'parking_fee')?'':'hidden'?>"><label class="control-label">Phí * </label><input type="input" name="parking_fee" id="parking_fee" style="width: 60px !important;text-align: right;" required="" class="form-control normal number inline" value="<?=getvalue($obj, 'parking_fee', 0)?>" /><span class="form-currency">.000đ</span></div>
						</div>
						<div class="clear"></div>
						<div class="form-group">
							<label class="control-label" for="description">Ghi chú</label>
							<textarea class="form-control" id="description" name="description" rows="2" cols="30"><?=getvalue($obj, 'description')?></textarea>
						</div>
						<div class="form-group">
							<button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
							<a href="<?=BASE_URL. $URIs['assessment']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
							<input type="hidden" name="action" value="do_assessment"/>
							<input type="hidden" name="user_id" id="user_id" value="<?=getvalue($obj, 'user_id')?>"/>
							<input type="hidden" name="assessment_id" id="assessment_id" value="<?=$id?>"/>
							<input type="hidden" name="has_allowance" value="<?=getvalue($logged_user, 'is_fulltime')?1:0?>" />
						</div>
					</form>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		<?php endif;?>
	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->
