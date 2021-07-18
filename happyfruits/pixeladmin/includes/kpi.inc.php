<?php
    define("WORK_PROCESS_ARR", serialize(array('good'=>'Hoàn thành', 'bad'=>'Chưa tốt')));
    define("CONCENTRATION_ARR", serialize(array('1'=>'Tốt', '0'=>'Chưa')));
    define("RULES_VIOLATION_ARR", serialize(array('0'=>'Không', '1'=>'Có')));
    define("BEING_PROMPTED_ARR", serialize(array('1'=>'Có', '0'=>'Không')));
    define("ASSIDUOUSNESS_ARR", serialize(array('work_late'=>'Đi trễ', 'finish_soon'=>'Về sớm', 'off_w_permission'=>'Nghỉ có phép', 'off_wt_permission'=>'Nghỉ không phép', 'off_by_manager'=>'Quán nghỉ')));
    
    $kpi_scores = array(
        'work_process' => array('good' => 0, 'bad' => -2),
        'concentration' => array(0 => -2, 1 => 0),
        'rules_violation' => array(0 => 0, 1 => -2),
        'being_prompted' => array(0 => 0, 1 => -2),
        'assiduousness' => array('work_late' => -2, 'finish_soon' => -2, 'off_w_permission' => -5, 'off_wt_permission' => -10, 'off_by_manager' => 0)
    );