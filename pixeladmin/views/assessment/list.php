                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-assessmentlist">
                            <thead>
                                <tr>
                                    <?php if (Users::is_member()):?>
                                    <th>Ngày</th>
                                    <th>Tiến độ</th>
                                    <th>Tập trung</th>
                                    <th>Vi phạm</th>
                                    <th>Bị nhắc nhở</th>
                                    <th>Hỏng vật dụng</th>
                                    <th>Chuyên cần</th>
                                    <th>Chấm công</th>
                                    <th class="not_filter">Ghi chú</th>
                                    <?php else:?>
                                    <th>Ngày</th>
                                    <th>Username</th>
                                    <th>Vi phạm</th>
                                    <th>Bị nhắc nhở</th>
                                    <th>Chuyên cần</th>
                                    <th>Chấm công</th>
                                    <th>Ghi chú</th>
                                    <th class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                    <?php endif;?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $total_working_time = 0;
                                    if($assessments): 
                                        $weekdays = array('1'=>'T2', '2'=>'T3', '3'=>'T4', '4'=>'T5', '5'=>'T6', '6'=>'T7', '7'=>'CN');
                                        foreach($assessments as $a):
                                            foreach($a as $field => $val)
                                                $$field = getvalue($a, $field);
                                            $weekday = $weekdays[date('N', strtotime($assessment_date))];
	                                        $a_s = getvalue(unserialize(ASSIDUOUSNESS_ARR), $assiduousness);
	                                        if($minutes_late > 0){
		                                        $a_s .= " (".formatQuantity($minutes_late)." phút)";
	                                        }
	                                        if($overtime>0){
	                                        	if ($a_s)
		                                            $a_s .= ' - ';
		                                        $a_s .= 'Tăng ca';
	                                        }
                                    ?>
                                <tr id="<?=$assessment_id?>">
                                    <?php if (Users::is_member()):
                                        $total_working_time += floatval($working_time) + floatval($overtime);
                                    ?>
                                    <td class="center"><?=$weekday.' '.date('d/m', strtotime($assessment_date))?></td>
                                    <td class="center"><?php echo $working_time?getvalue(unserialize(WORK_PROCESS_ARR), $work_process):'-';?></td>
                                    <td class="center"><?php echo $working_time?getvalue(unserialize(CONCENTRATION_ARR), $concentration):'-';?></td>
                                    <td class="center"><?php echo $working_time?getvalue(unserialize(RULES_VIOLATION_ARR), $rules_violation):'-';?></td>
                                    <td class="center"><?php echo $working_time?getvalue(unserialize(BEING_PROMPTED_ARR), $being_prompted):'-';?></td>
                                    <td class="center"><?php echo $breaking_things&&$working_time?$breaking_things:'-';?></td>
                                    <td class="center"><?php echo $a_s;?></td>
                                    <td class="center"><?php echo (Users::is_fulltime($user_id)?'Full':$working_time). ($overtime>0?" + $overtime":'');?></td>
                                    <td class="has_tooltip">
                                        <span><?php echo word_limiter($description, 5);?></span>
                                        <div class="hidden tooltip_content">
                                            <p><?php echo $description;?></p>
                                        </div>
                                    </td>
                                    <?php else:?>
                                    <td class="center"><?=$weekday.' '.date('d/m', strtotime($assessment_date))?></td>
                                    <td class="username">
                                        <span><?=$username?></span>
                                        <div class="hidden tooltip_content">
                                            <ul>
                                                <li>Tiến độ: <?php echo $working_time?getvalue(unserialize(WORK_PROCESS_ARR), $work_process):'-';?></li>
                                                <li>Tập trung: <?php echo $working_time?getvalue(unserialize(CONCENTRATION_ARR), $concentration):'-';?></li>
                                                <li>Hỏng vật dụng: <?php echo $breaking_things&&$working_time?$breaking_things:'-';?></li>
                                                <li>KPI: <?php echo $kpi;?></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="center"><?php echo $working_time?getvalue(unserialize(RULES_VIOLATION_ARR), $rules_violation):'-';?></td>
                                    <td class="center"><?php echo $working_time?getvalue(unserialize(BEING_PROMPTED_ARR), $being_prompted):'-';?></td>
                                    <td class="center"><?php echo $a_s;?></td>
                                    <td class="center"><?php echo (Users::is_fulltime($user_id)?'Full':$working_time). ($overtime>0?" + $overtime":'');?></td>
                                    <td class="has_tooltip">
                                        <span><?php echo word_limiter($description, 5);?></span>
                                        <div class="hidden tooltip_content">
                                            <p><?php echo $description;?></p>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a target="_blank" href="<?=BASE_URL. $URIs['assessment']?>/<?=$assessment_id?>" class="btn btn-sm btn-warning" title="Sửa đánh giá"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <?php endif;?>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <?php if (Users::is_member()):?>
                        <input type="hidden" id="total_working_time" value="<?=$total_working_time?>" />
                        <?php endif;?>