<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Assessment
 * Generation date:  20/01/2015
 * Baseclass:        BaseAssessment
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseAssessment.php');

/**
 * Class declaration
 */
class Assessment extends BaseAssessment
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Assessment';
    }
    
    function get_list($filters = array(), $order_by = '')
    {
        $sql = 'SELECT assessment.*, users.fullname, users.username, users.rate_per_hour, users.need_deposit, users.hours_deposit, users.salary_per_month, users.is_fulltime
        FROM assessment 
        INNER JOIN users ON users.user_id = assessment.user_id AND users.enabled = 1 
            AND users.type_id IN ('.MEMBER_TYPE_ID.','.SHIFT_LEADER_1_TYPE_ID.','.SHIFT_LEADER_2_TYPE_ID.')';
        return $this->_do_sql($sql, $filters, array(), $order_by);
    }
    
    function get_late_assessment_in_month($user_id)
    {
        $sql = 'SELECT COUNT(*) as times FROM assessment';
        $filters = array('user_id' => $user_id, 'is_late' => 1, 'where' => "SUBSTR(assessment_date, 1, 7) = '". date('Y-m'). "'");
        $rs = $this->_do_sql($sql, $filters);
        if ($rs)
            return $rs[0]['times'];
        return 0;
    }
    
    function calculate_kpi($assessment_id = '')
    {
        if (!empty($assessment_id))
        {
            global $kpi_scores;
            $kpi = 0;
            if (is_numeric($assessment_id))
                $assessment = $this->get_details($assessment_id);
            else if(is_array($assessment_id))
                $assessment = $assessment_id;
            if (!empty($assessment))
            {
                $kpi = 10;
                if ($assessment['breaking_things'])
                    $kpi = $kpi - 2;
                /*
                if ($assessment['overtime'] > 0)
                    $kpi += $assessment['overtime'];
                */
                foreach($kpi_scores as $name => $s)
                {
                    if (isset($s[$assessment[$name]]))
                        $kpi += $s[$assessment[$name]];
                }
                $this->update($assessment_id, array('kpi'=>$kpi));
            }
            return $kpi;
        }
        else
        {
            $assessments = $this->get_list();
            foreach($assessments as $item)
                $this->calculate_kpi($item['assessment_id']);
            return count($assessments);
        }
    }
}
/* End of generated class */
