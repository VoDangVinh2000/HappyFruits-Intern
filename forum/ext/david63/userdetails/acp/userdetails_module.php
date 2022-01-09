<?php
/**
*
* @package User Details Extension
* @copyright (c) 2016 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\userdetails\acp;

class userdetails_module
{
	public $tpl_name;
	var $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $request;

		$page = $request->variable('page', '');

		$mode = ($request->is_set_post('display')) ? 'display' : '';
		$mode = ($request->is_set_post('csv')) ? 'csv' : $mode;
		$mode = ($request->is_set_post('clear_filters')) ? 'clear_filters' : $mode;
		$mode = ($request->is_set_post('back')) ? 'back' : $mode;
		$mode = ($request->is_set_post('sort')) ? 'sort' : $mode;

		$mode = ($page == 'page') ? 'display' : $mode;

		// Get an instance of the admin controller
		$data_controller = $phpbb_container->get('david63.userdetails.data.controller');

		// Make the $u_action url available in the admin controller
		$data_controller->set_page_url($this->u_action);

		// Start the processing
		switch ($mode)
		{
			case 'display':
			case 'sort':
				// No break
			case 'clear_filters':
				$this->tpl_name = 'user_details';
				// No break
			case 'csv':
				$this->page_title = $phpbb_container->get('language')->lang('ACP_USER_DETAILS');
				$data_controller->display_output($mode);
			break;

			case 'back':
			default:
				$this->tpl_name		= 'user_details_select';
				$this->page_title	= $phpbb_container->get('language')->lang('ACP_USER_DETAILS');
				$data_controller->select_output();
			break;
		}
	}
}
