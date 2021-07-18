<?php

namespace planetstyles\flightdeck\acp;

class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\planetstyles\flightdeck\acp\main_module',
			'title'		=> 'ACP_STYLE_SETTINGS_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'ACP_STYLE_SETTINGS_SETTINGS',
					'auth'	=> 'ext_planetstyles/flightdeck && acl_a_board',
					'cat'	=> array('ACP_STYLE_SETTINGS_TITLE')
				),
			),
		);
	}
}
