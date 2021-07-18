<?php

namespace planetstyles\flightdeck\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface $cache       Cache driver interface
	 * @param \phpbb\config\config                 $config      Config object
	 * @param \phpbb\config\db_text                $config_text DB text object
	 * @param \phpbb\template\template             $template    Template object
	 * @access public
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\template\template $template)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->template = $template;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header' => 'load_style_settings_data',
		);
	}

	/**
	 * Load style settings data
	 *
	 * @return null
	 * @access public
	 */
	public function load_style_settings_data()
	{
		$this->get_style_configs();

		$html_code_data = $this->get_html_code();

		$this->template->assign_vars(array(
			'FORUM_LOGO'			=> $this->get_forum_logo(),
			'FORUM_HEADER'			=> $this->get_forum_header(),
			'FORUM_FAVICON'			=> $this->get_forum_favicon(),

			'STYLE_SETTINGS_HTML_1'	=> $html_code_data['style_settings_html_1'],
			'STYLE_SETTINGS_HTML_2'	=> $html_code_data['style_settings_html_2'],
			'STYLE_SETTINGS_HTML_3'	=> $html_code_data['style_settings_html_3'],
			'STYLE_SETTINGS_HTML_4'	=> $html_code_data['style_settings_html_4'],
		));
	}

	/**
	 * Get the forum logo IMG tag
	 *
	 * @return string
	 */
	protected function get_forum_logo()
	{
		$logo_src    = $this->config['style_settings_logo_path'];
		$logo_width  = $this->config['style_settings_logo_width'] ? ' width="' . $this->config['style_settings_logo_width'] . '"' : '';
		$logo_height = $this->config['style_settings_logo_height'] ? ' height="' . $this->config['style_settings_logo_height'] . '"' : '';

		return $logo_src ? '<img src="' . generate_board_url() . '/' . $logo_src . '"' . $logo_width . $logo_height . ' alt="">' : '';
	}
	
	/**
	 * Get the forum header image
	 *
	 * @return string
	 */
	protected function get_forum_header()
	{
		$header_src    = $this->config['style_settings_header_path'];

		return $header_src ? generate_board_url() . '/' . $header_src  : '';
	}
	
	/**
	 * Get the forum favicon
	 *
	 * @return string
	 */
	protected function get_forum_favicon()
	{
		$favicon_src    = $this->config['style_settings_favicon_path'];

		return $favicon_src ? generate_board_url() . '/' . $favicon_src  : '';
	}	

	/**
	 * Get the HTML code blocks as an array
	 *
	 * @return array
	 */
	protected function get_html_code()
	{
		if (($html_code_data = $this->cache->get('_style_settings_html_data')) === false)
		{
			$html_code_data = $this->config_text->get_array(array(
				'style_settings_html_1',
				'style_settings_html_2',
				'style_settings_html_3',
				'style_settings_html_4',
			));

			$this->cache->put('_style_settings_html_data', $html_code_data);
		}

		return array_map('htmlspecialchars_decode', $html_code_data);
	}

	/**
	 * Get the style settings and output them to the template
	 */
	protected function get_style_configs()
	{
		foreach ($this->config as $key => $value)
		{
			if (strpos($key, 'style_settings_config_') === 0)
			{
				$this->template->assign_var(strtoupper($key), $value);
			}
		}
	}
}
