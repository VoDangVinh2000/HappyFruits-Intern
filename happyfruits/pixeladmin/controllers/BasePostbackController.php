<?php
/**
 * Class declaration
 */
class BasePostbackController extends BaseController
{
    var $action = '';
    var $representation_of_days = array('Mon' => 'T2', 'Tue' => 'T3', 'Wed' => 'T4', 'Thu' => 'T5', 'Fri' => 'T6', 'Sat' => 'T7', 'Sun' => 'CN');
    var $columns = array(' ', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z');
    var $beginTransaction = 0;
    var $return = array();
    
    function __construct()
    {
        $this->require_logged = 0;
        parent::__construct();
    }
    
    function _send()
    {
        echo json_encode($this->return);
        die;
    }
    
    function _error($msg, $code = 'ERROR')
    {
        $this->return["status"] = $code;
        $this->return["message"] = $msg;
        $this->_rollBackTransaction();
        $this->_send();
    }
    
    function _ok($msg = '')
    {
        $this->return["status"] = "OK";
        $this->return["message"] = $msg;
        $this->_commitTransaction();
        $this->_send();
    }
    
    function _set_last_error($error, $data_return = '')
    {
        $this->_rollBackTransaction();
        set_last_error($error, $data_return);
    }
    
    function _set_last_message($msg)
    {
        $this->_commitTransaction();
        set_last_message($msg);
    }
    
    function _beginTransaction()
    {
        $this->dbh->beginTransaction();
        $this->beginTransaction = 1;
    }
    
    function _commitTransaction()
    {
        if ($this->beginTransaction)
        {
            $this->dbh->commit();
            $this->beginTransaction = 0;
        }
    }
    
    function _rollBackTransaction()
    {
        if ($this->beginTransaction)
        {
            $this->dbh->rollBack();
            $this->beginTransaction = 0;
        }
    }
}
/* End of BasePostbackController class */
