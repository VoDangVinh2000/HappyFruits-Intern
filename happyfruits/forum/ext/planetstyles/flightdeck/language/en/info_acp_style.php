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
	'ACP_STYLE_SETTINGS_TITLE'		=> 'Flight Deck (Control Panel)',
	'ACP_STYLE_SETTINGS_SETTINGS'	=> 'Theme Settings',
));
