<?php
/**
*
* app [Vietnamese]
*
* @package language
* @version 1.01
* @copyright (c) 2013 nedka
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

/**
* DEVELOPERS PLEASE NOTE
*
* All language files should use UTF-8 as their encoding and the files must not contain a BOM.
*
* Placeholders can now contain order information, e.g. instead of
* 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
* translators to re-order the output of data while ensuring it remains correct
*
* You do not need this where single placeholders are used, e.g. 'Message %d' is fine
* equally where a string contains only two placeholders which are used to wrap text
* in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
*
* Some characters you may want to copy & paste:
* ’ » “ ” …
*/

$lang = array_merge($lang, array(
	'CONTROLLER_ARGUMENT_VALUE_MISSING'	=> 'Thiếu giá trị khai báo cho tham số #%1$s: <strong>%3$s</strong> trong lớp <strong>%2$s</strong>',
	'CONTROLLER_NOT_SPECIFIED'			=> 'Không có lớp điều khiển nào được xác định.',
	'CONTROLLER_METHOD_NOT_SPECIFIED'	=> 'Không có phương thức nào xác định trong lớp điều khiển.',
	'CONTROLLER_SERVICE_UNDEFINED'		=> 'Dịch vụ cho lớp điều khiển “<strong>%s</strong>” không được xác định trong <samp>./config/services.yml</samp>.',
));
