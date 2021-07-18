<?php

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'STYLE_SETTINGS_LOGO'				=> 'Logos &amp; Header Background',
	'STYLE_SETTINGS_LOGO_EXPLAIN'		=> '',
	'STYLE_SETTINGS_LOGO_UPLOAD'		=> 'Logo image upload',
	'STYLE_SETTINGS_LOGO_UPLOAD_EXPLAIN'=> 'Upload a logo image. The logo location below will automatically be filled in when an image is uploaded. Accepted formats: gif, jpg, png, svg.',
	'STYLE_SETTINGS_LOGO_PATH'			=> 'Logo image location',
	'STYLE_SETTINGS_LOGO_PATH_EXPLAIN'	=> 'This will be filled in automatically. Delete and submit to remove logo.',
	'STYLE_SETTINGS_LOGO_WIDTH'			=> 'Logo width',
	'STYLE_SETTINGS_LOGO_WIDTH_EXPLAIN'	=> 'Leave blank to use default logo size',	
	'STYLE_SETTINGS_LOGO_HEIGHT'		=> 'Logo height',
	'STYLE_SETTINGS_LOGO_HEIGHT_EXPLAIN'	=> 'Leave blank to use default logo size',	
	'STYLE_SETTINGS_LOGO_ERROR'			=> 'The logo file %s failed to upload.',
	
	'STYLE_SETTINGS_HEADER_ERROR'			=> 'The header file %s failed to upload.',
	'STYLE_SETTINGS_HEADER_UPLOAD'		=> 'Header background upload.',
	'STYLE_SETTINGS_HEADER_UPLOAD_EXPLAIN'	=> 'Upload a header image (leave blank to use theme accent colour as background). The header location below will automatically be filled in when an image is uploaded.',
	'STYLE_SETTINGS_HEADER_PATH'			=> 'Header image location',
	'STYLE_SETTINGS_HEADER_PATH_EXPLAIN'	=> 'This will be filled in automatically. Delete and submit to remove header image.',
	
	'STYLE_SETTINGS_FAVICON_ERROR'			=> 'The favicon file %s failed to upload.',
	'STYLE_SETTINGS_FAVICON_UPLOAD'		=> 'Favicon upload.',
	'STYLE_SETTINGS_FAVICON_EXPLAIN'	=> 'Upload a favicon. Square images strongly recommended.',
	'STYLE_SETTINGS_FAVICON_PATH'			=> 'Favicon image location',
	'STYLE_SETTINGS_FAVICON_PATH_EXPLAIN'	=> 'This will be filled in automatically. Delete and submit to remove favicon.',	

	'STYLE_SETTINGS_HTML_CODE'			=> 'HTML code blocks',
	'STYLE_SETTINGS_HTML'				=> 'Custom HTML code block #%d',
	'STYLE_SETTINGS_HTML_EXPLAIN'		=> 'Uses the template var <samp>{STYLE_SETTINGS_HTML_%d}</samp>',

	'STYLE_SETTINGS_CONFIG'				=> 'Style Settings',
	'STYLE_SETTINGS_CONFIG_EXPLAIN'		=> 'Uses the template var <samp>{%s}</samp>',

	'STYLE_SETTINGS_SAVED'				=> 'Style settings have been saved.',
));
