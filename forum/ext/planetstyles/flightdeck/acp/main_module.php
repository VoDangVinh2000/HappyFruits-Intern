<?php

namespace planetstyles\flightdeck\acp;

class main_module
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $root_path;

	/** @var string */
	public $u_action;

	public function main()
	{
		global $phpbb_container, $phpbb_root_path;

		$this->cache = $phpbb_container->get('cache.driver');
		$this->config = $phpbb_container->get('config');
		$this->config_text = $phpbb_container->get('config_text');
		$this->request = $phpbb_container->get('request');
		$this->template = $phpbb_container->get('template');
		$this->user = $phpbb_container->get('user');
		$this->root_path = $phpbb_root_path;

		$this->user->add_lang_ext('planetstyles/flightdeck', 'acp_style_settings');
		$this->tpl_name = 'acp_style_settings_body';
		$this->page_title = $this->user->lang('ACP_STYLE_SETTINGS_TITLE');
		add_form_key('planetstyles/flightdeck');

		try
		{
			$style_settings = $this->load_json_data();
		}
		catch (\phpbb\exception\runtime_exception $e)
		{
			$style_settings = array();
		}

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('planetstyles/flightdeck'))
			{
				trigger_error('FORM_INVALID');
			}

			$this->config->set('style_settings_logo_path', $this->request->variable('style_settings_logo_path', ''));
			$this->config->set('style_settings_logo_width', $this->request->variable('style_settings_logo_width', 0));
			$this->config->set('style_settings_logo_height', $this->request->variable('style_settings_logo_height', 0));
			
			// Start PS-Test
			$this->config->set('style_settings_header_path', $this->request->variable('style_settings_header_path', ''));
			$this->config->set('style_settings_favicon_path', $this->request->variable('style_settings_favicon_path', ''));
			// End PS-Test

			foreach ($style_settings as $style_setting)
			{
				$this->config->set('style_settings_config_' . $style_setting['name'], $this->request->variable($style_setting['name'], ''));
			}

			$this->cache->destroy('_style_settings_html_data');
			$this->config_text->set_array(array(
				'style_settings_html_1' => $this->request->variable('style_settings_html_1', ''),
				'style_settings_html_2' => $this->request->variable('style_settings_html_2', ''),
				'style_settings_html_3' => $this->request->variable('style_settings_html_3', ''),
				'style_settings_html_4' => $this->request->variable('style_settings_html_4', ''),
			));
			

			$file = $this->request->file('style_settings_logo_upload');
			if ($file['error'] == UPLOAD_ERR_OK)
			{
				$destination = 'ext/planetstyles/flightdeck/store/';
				if (!$this->upload($file, $this->root_path . $destination))
				{
					trigger_error($this->user->lang('STYLE_SETTINGS_LOGO_ERROR', $file['name']) . adm_back_link($this->u_action), E_USER_WARNING);
				}
				$this->config->set('style_settings_logo_path', $destination . $file['name']);
			}
			else if ($file['error'] != UPLOAD_ERR_NO_FILE)
			{
				trigger_error($this->user->lang('STYLE_SETTINGS_LOGO_ERROR', $file['name']) . adm_back_link($this->u_action), E_USER_WARNING);
			}
			
			// Start PS-Test
			$file = $this->request->file('style_settings_header_upload');
			if ($file['error'] == UPLOAD_ERR_OK)
			{
				$destination = 'ext/planetstyles/flightdeck/store/';
				if (!$this->upload($file, $this->root_path . $destination))
				{
					trigger_error($this->user->lang('STYLE_SETTINGS_HEADER_ERROR', $file['name']) . adm_back_link($this->u_action), E_USER_WARNING);
				}
				$this->config->set('style_settings_header_path', $destination . $file['name']);
			}
			else if ($file['error'] != UPLOAD_ERR_NO_FILE)
			{
				trigger_error($this->user->lang('STYLE_SETTINGS_HEADER_ERROR', $file['name']) . adm_back_link($this->u_action), E_USER_WARNING);
			}
			

			// Favicon
			$file = $this->request->file('style_settings_favicon_upload');
			if ($file['error'] == UPLOAD_ERR_OK)
			{
				$destination = 'ext/planetstyles/flightdeck/store/';
				if (!$this->upload($file, $this->root_path . $destination))
				{
					trigger_error($this->user->lang('STYLE_SETTINGS_FAVICON_ERROR', $file['name']) . adm_back_link($this->u_action), E_USER_WARNING);
				}
				$this->config->set('style_settings_favicon_path', $destination . $file['name']);
			}
			else if ($file['error'] != UPLOAD_ERR_NO_FILE)
			{
				trigger_error($this->user->lang('STYLE_SETTINGS_HEADER_ERROR', $file['name']) . adm_back_link($this->u_action), E_USER_WARNING);
			}			
			// End PS-Test

			trigger_error($this->user->lang('STYLE_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		foreach ($style_settings as $name => $data)
		{
			$config_name = 'style_settings_config_' . $data['name'];
			$this->template->assign_block_vars('style_settings_config', array(
				'VALUE' 		=> $this->config->offsetExists($config_name) ? $this->config->offsetGet($config_name) : 0,
				'OPTIONS'		=> isset($data['values']) ? $data['values'] : null,
				'LABEL'			=> $name,
				'LABEL_EXPLAIN'	=> $this->user->lang('STYLE_SETTINGS_CONFIG_EXPLAIN', strtoupper($config_name)),
				'CONFIG_NAME'	=> $data['name'],
				'LABEL_HELP'	=> $data['help'],
				'S_BOOL'		=> $data['type'] === 'bool',
				'S_LIST'		=> $data['type'] === 'list',
				'S_STRING'		=> $data['type'] === 'string',
			));
		}

		$html_code_block_data = $this->config_text->get_array(array(
			'style_settings_html_1',
			'style_settings_html_2',
			'style_settings_html_3',
			'style_settings_html_4',
		));

		ksort($html_code_block_data);
		$index = 0;
		foreach ($html_code_block_data as $key => $data)
		{
			$this->template->assign_block_vars('style_settings_html', array(
				'VALUE' 		=> $data,
				'NAME'			=> 'style_settings_html_' . ++$index,
				'LABEL'			=> $this->user->lang('STYLE_SETTINGS_HTML', $index),
				'LABEL_EXPLAIN'	=> $this->user->lang('STYLE_SETTINGS_HTML_EXPLAIN', $index),
			));
		}

		$this->template->assign_vars(array(
			'STYLE_SETTINGS_LOGO_PATH'		=> $this->config->offsetGet('style_settings_logo_path'),
			'STYLE_SETTINGS_LOGO_WIDTH'		=> $this->config->offsetGet('style_settings_logo_width'),
			'STYLE_SETTINGS_LOGO_HEIGHT'	=> $this->config->offsetGet('style_settings_logo_height'),
			
			// Start PS-Test
			'STYLE_SETTINGS_HEADER_PATH'		=> $this->config->offsetGet('style_settings_header_path'),
			'STYLE_SETTINGS_FAVICON_PATH'		=> $this->config->offsetGet('style_settings_favicon_path'),
			// End PS-Test
					

			'U_ACTION'						=> $this->u_action,
		));
	}

	/**
	 * Return decoded JSON data from a JSON file
	 *
	 * @return array JSON data
	 * @throws \phpbb\exception\runtime_exception
	 * @access protected
	 */
	protected function load_json_data()
	{
		$json_file = $this->root_path . 'ext/planetstyles/flightdeck/styles/style_config.json';

		if (!file_exists($json_file))
		{
			throw new \phpbb\exception\runtime_exception('FILE_NOT_FOUND', array($json_file));
		}

		if (!($file_contents = file_get_contents($json_file)))
		{
			throw new \phpbb\exception\runtime_exception('FILE_CONTENT_ERR', array($json_file));
		}

		if (($json_data = json_decode($file_contents, true)) === null)
		{
			throw new \phpbb\exception\runtime_exception('FILE_JSON_DECODE_ERR', array($json_file));
		}

		return $json_data;
	}


	/**
	 * Upload the file to the given directory
	 *
	 * @param array  $fp       File pointer data
	 * @param string $location Path to directory where to upload
	 *
	 * @return bool True if upload was successful, false otherwise
	 * @access protected
	 */
	protected function upload($fp, $location)
	{
		if ($this->allowedExtension($fp['name']) && $this->allowedSize($fp['size']))
		{
			$destination = $location . basename($fp['name']);
			if (move_uploaded_file($fp['tmp_name'], $destination))
			{
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if file is allowed by its extension
	 *
	 * @param string $filename File name
	 *
	 * @return bool True if file ext is allowed, false otherwise
	 * @access protected
	 */
	protected function allowedExtension($filename)
	{
		return in_array($this->getExtension($filename), array('gif', 'jpeg', 'jpg', 'png', 'svg'), true);
	}

	/**
	 * Check file size in Mb, against php.ini upload_max_filesize setting
	 *
	 * @param string $filesize File size
	 *
	 * @return bool True if file size is allowed, false otherwise
	 * @access protected
	 */
	protected function allowedSize($filesize)
	{
		return ($filesize < ((int) ini_get('upload_max_filesize')) * 1000000);
	}

	/**
	 * Get file extension
	 *
	 * @param string $filename Name of file
	 *
	 * @return string File's extension or nothing if not found
	 * @access protected
	 */
	protected function getExtension($filename)
	{
		if (strpos($filename, '.') === false)
		{
			return '';
		}

		$parts = explode('.', $filename);
		return strtolower(array_pop($parts));
	}
}
