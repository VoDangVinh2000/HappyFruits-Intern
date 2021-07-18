<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseAssessment
 * Generation date:  20/01/2015
 * Table name:       assessment
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseAssessment extends eModel
{
    /**
     * Attribute declaration
     */
    var $assessment_id;  /* Primary key */
    var $user_id;    /* int(11) */
    var $assessment_date;    /* date */
    var $work_process;    /* enum('good','bad') */
    var $concentration;    /* tinyint(1) */
    var $rules_violation;    /* tinyint(1) */
    var $being_prompted;    /* tinyint(1) */
    var $breaking_things;    /* varchar(255) */
    var $assiduousness;    /* enum('work_late','finish_soon','off_w_permission','off_wt_permission','off_by_manager') */
    var $working_time;    /* varchar(6) */
    var $description;    /* varchar(255) */
    var $kpi;    /* int(5) */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $ip_address;    /* varchar(20) */
    var $is_late;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'assessment';
        $this->primary_key = 'assessment_id';
    }

    /**
     * Getter methods
     */ 

    function get_assessment_id()
    {
        return $this->assessment_id;
    }

    function get_user_id()
    {
        return $this->user_id;
    }

    function get_assessment_date()
    {
        return $this->assessment_date;
    }

    function get_work_process()
    {
        return $this->work_process;
    }

    function get_concentration()
    {
        return $this->concentration;
    }

    function get_rules_violation()
    {
        return $this->rules_violation;
    }

    function get_being_prompted()
    {
        return $this->being_prompted;
    }

    function get_breaking_things()
    {
        return $this->breaking_things;
    }

    function get_assiduousness()
    {
        return $this->assiduousness;
    }

    function get_working_time()
    {
        return $this->working_time;
    }

    function get_description()
    {
        return $this->description;
    }

    function get_kpi()
    {
        return $this->kpi;
    }

    function get_created_by()
    {
        return $this->created_by;
    }

    function get_created_dtm()
    {
        return $this->created_dtm;
    }

    function get_modified_dtm()
    {
        return $this->modified_dtm;
    }

    function get_ip_address()
    {
        return $this->ip_address;
    }

    function get_is_late()
    {
        return $this->is_late;
    }

    /**
     * Setter methods
     */

    function set_assessment_id($val)
    {
        $this->assessment_id =  $val;
    }

    function set_user_id($val)
    {
        $this->user_id =  $val;
    }

    function set_assessment_date($val)
    {
        $this->assessment_date =  $val;
    }

    function set_work_process($val)
    {
        $this->work_process =  $val;
    }

    function set_concentration($val)
    {
        $this->concentration =  $val;
    }

    function set_rules_violation($val)
    {
        $this->rules_violation =  $val;
    }

    function set_being_prompted($val)
    {
        $this->being_prompted =  $val;
    }

    function set_breaking_things($val)
    {
        $this->breaking_things =  $val;
    }

    function set_assiduousness($val)
    {
        $this->assiduousness =  $val;
    }

    function set_working_time($val)
    {
        $this->working_time =  $val;
    }

    function set_description($val)
    {
        $this->description =  $val;
    }

    function set_kpi($val)
    {
        $this->kpi =  $val;
    }

    function set_created_by($val)
    {
        $this->created_by =  $val;
    }

    function set_created_dtm($val)
    {
        $this->created_dtm =  $val;
    }

    function set_modified_dtm($val)
    {
        $this->modified_dtm =  $val;
    }

    function set_ip_address($val)
    {
        $this->ip_address =  $val;
    }

    function set_is_late($val)
    {
        $this->is_late =  $val;
    }

}
/* End of generated class */
