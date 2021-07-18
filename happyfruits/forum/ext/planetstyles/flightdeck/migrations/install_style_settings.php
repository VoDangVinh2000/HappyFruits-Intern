<?php

namespace planetstyles\flightdeck\migrations;

class install_style_settings extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\gold');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('style_settings_logo_path', '')),
			array('config.add', array('style_settings_logo_width', '')),
			array('config.add', array('style_settings_logo_height', '')),
			
			// PS- Test
			array('config.add', array('style_settings_header_path', '')),
			array('config.add', array('style_settings_favicon_path', '')),

			array('config_text.add', array('style_settings_html_1', '')),
			array('config_text.add', array('style_settings_html_2', '')),
			array('config_text.add', array('style_settings_html_3', '')),
			array('config_text.add', array('style_settings_html_4', '')),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_STYLE_SETTINGS_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_STYLE_SETTINGS_TITLE',
				array(
					'module_basename'	=> '\planetstyles\flightdeck\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}

	public function revert_data()
	{
		return array(
			array('custom', array(array($this, 'clean_style_configs'))),
		);
	}

	public function clean_style_configs()
	{
		foreach ($this->config as $key => $value)
		{
			if (strpos($key, 'style_settings_config_') === 0)
			{
				$this->config->delete($key);
			}
		}
	}
}
