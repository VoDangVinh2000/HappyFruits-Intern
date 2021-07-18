<?php
    /* 1 (for Monday) through 7 (for Sunday) */
    $working_time = array(
        '1' => array('start' => '8:00', 'end' => '21:30'),
        '2' => array('start' => '8:00', 'end' => '21:30'),
        '3' => array('start' => '8:00', 'end' => '21:30'),
        '4' => array('start' => '8:00', 'end' => '21:30'),
        '5' => array('start' => '8:00', 'end' => '21:30'),
        '6' => array('start' => '8:00', 'end' => '21:30'),
        '7' => array('start' => '8:00', 'end' => '21:30')
    );
    
    $today = date('Y-m-d');
    $start_time = strtotime($today. ' '. $working_time[date('N')]['start']);
    $end_time = strtotime($today. ' '. $working_time[date('N')]['end']);
    $is_off = 0;
    if ($start_time > time()  ||  time() > $end_time)
        $is_off = 1;

    $working_time2 = array(
        '1' => array('start' => '8:00', 'end' => '17:00'),
        '2' => array('start' => '8:00', 'end' => '17:00'),
        '3' => array('start' => '8:00', 'end' => '17:00'),
        '4' => array('start' => '8:00', 'end' => '17:00'),
        '5' => array('start' => '8:00', 'end' => '17:00'),
        '6' => array('start' => '8:00', 'end' => '13:30'),
        '7' => array('start' => '12:00', 'end' => '12:00')
    );

    $start_time2 = strtotime($today. ' '. $working_time2[date('N')]['start']);
    $end_time2 = strtotime($today. ' '. $working_time2[date('N')]['end']);
    $is_off2 = 0;
    if ($start_time2 > time()  ||  time() > $end_time2)
        $is_off2 = 1;

	$is_off2 = 1;