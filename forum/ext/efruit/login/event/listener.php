<?php
/**
 *
 * @package phpBB Extension - efruit login
 * @copyright (c) 2018 nthieu - 2018-08-05
 *
 */

namespace efruit\login\event;

use efruit\login\helpers\model_helper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var string phpbb_root_path */
	protected $phpbb_root_path;

	/** @var string php_ext */
	protected $php_ext;

	protected $user_model;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template		$template				Template object
	 * @param \phpbb\request\request		$request				Request object
	 * @param \phpbb\path_helper			$path_helper			Controller helper object
	 * @param string						$phpbb_root_path		phpbb_root_path
	 * @param string						$php_ext				php_ext
	 * @access public
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\request\request $request, \phpbb\path_helper $path_helper, $phpbb_root_path, $php_ext)
	{
		$this->template = $template;
		$this->request = $request;
		$this->path_helper = $path_helper;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->in_viewtopic = false;
		$this->user_model = new model_helper('users');
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'core.auth_login_session_create_before'     => 'auth_login_session_create_before',
			'core.session_kill_after'                   => 'session_kill_after'
		);
	}

	/**
	 * Login on efruit
	 *
	 * @param	object	$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function auth_login_session_create_before($event)
	{
		$efruit_user = $this->user_model->select_one(array('username' => $event['username']));
		if ($efruit_user && $efruit_user['deleted'] == 0 && $efruit_user['enabled'] == 1){
			if (!session_id())
				session_start();
			if (empty($_SESSION['user']))
				$_SESSION['user'] = $efruit_user;
		}
	}

	public function session_kill_after($event)
	{
		unset($_SESSION['user']);
	}
}
