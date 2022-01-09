<?php
require_once('BaseController.php');
require_once(EFRUIT_ABSOLUTE_PATH. "PHPMailer/sender.php");
/**
 * Class declaration
 */
class CronController extends BaseController
{
    function __construct()
    {
        $this->require_logged = 0;
        parent::__construct();
    }
    
    function update_customers()
    {
    	ini_set('max_execution_time', 0);
        return eModel::_do_sql("UPDATE customers c SET c.total_paid = (SELECT SUM(o.total) FROM orders o WHERE o.customer_id = c.customer_id AND o.deleted = 0 AND o.status = 'Completed' GROUP BY o.customer_id)");
    }

    function sync_phpBB_users()
    {
	    $this->load_model('Users, PhpBBUsers');
	    ini_set('max_execution_time', 0);
	    $users = $this->Users->get_list(array('deleted' => 0, 'enabled' => 1));
	    if (!empty($users)){
		    foreach($users as $user){
			    $data = array(
				    'user_type' => $user['type_id'] == SUPER_ADMIN_TYPE_ID?3:0,
				    'group_id' => $user['type_id'] == SUPER_ADMIN_TYPE_ID?5:2,
				    'username' => $user['username'],
				    'username_clean' => $user['username'],
				    'user_password' => '$ef$'.$user['password'],
				    'user_email' => $user['email'],
				    'user_new' => 0,
				    'user_style' => 1,
				    'from_efruit' => $user['user_id']
			    );
			    $bb_user = $this->PhpBBUsers->select_one(array('username' => $user['username']));
			    if ($bb_user){
				    $this->PhpBBUsers->update($bb_user['user_id'], $data);
			    }else{
			    	$data['user_permissions'] = '00000000000v667wt0\nhwby9w000000\nm6awadqmx0qo\nm6b8xhqmx0qo\nzik0zjqmx0qo';
				    $this->PhpBBUsers->insert($data);
			    }
			    echo 'Synced user '.$user['username']."<br/>\n";
		    }
	    }

	    $bb_users = $this->PhpBBUsers->get_list(array('where' => 'from_efruit != 0 AND user_type != 1 AND user_type != 2'));
	    if (!empty($bb_users)){
	    	foreach($bb_users as $bb_user){
	    		$user = $this->Users->select_one(array('username' => $bb_user['username']));
				if (empty($user) || $user['enabled'] == 0){
					/* Inactive user */
					$this->PhpBBUsers->update($bb_user['user_id'], array('user_type' => 1));
					echo 'Set user '.$bb_user['username']." to inactive status<br/>\n";
				}elseif($user['deleted'] == 1){
					/* Ignore user */
					$this->PhpBBUsers->update($bb_user['user_id'], array('user_type' => 2));
					echo 'Set user '.$bb_user['username']." to ignore status<br/>\n";
				}
		    }
	    }
    }

    function midnight_jobs()
    {
	    /* First day of month */
	    if (intval(date('d')) == 1){
		    set_setting('stt', 0);
	    }
	    echo 'Done';
    }
}
/* End of CronController class */
