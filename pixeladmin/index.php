<?php
	include("includes/main.inc.php");

	/* phpBB */
    if(defined('SSO_FORUM') && SSO_FORUM){
        define('IN_PHPBB', true);
       /// define('PHPBB_ROOT_PATH',PHPBB_ROOT_PATH);
        $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : EFRUIT_ABSOLUTE_PATH.'forum/';
       // echo phpversion();
        $phpEx = substr(strrchr(__FILE__, '.'), 1);
        include($phpbb_root_path . 'common.' . $phpEx);

        // Start session management
        $user->session_begin();
        $auth->acl($user->data);
        $user->setup();
        $request->enable_super_globals();
    }else{
        $user = null;
    }
	/* End phpBB */
    
    $controllerName = get('controller');
    if (empty($controllerName))
        $controllerName = 'default';
        
    $controllerClassName = ucfirst($controllerName).'Controller';
    
    $controllerPath = ABSOLUTE_PATH. "controllers/$controllerClassName.php";
    if(!file_exists($controllerPath))
        throw new Exception("Invalid controller $controllerPath");
    
    $actionName = request('action');
    if (empty($actionName))
        $actionName = 'index';
    
    require_once($controllerPath);
    
    $controlerObj = new $controllerClassName();
    $controlerObj->$actionName();
?>