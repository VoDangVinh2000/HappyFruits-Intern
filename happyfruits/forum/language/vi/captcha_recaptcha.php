<?php
/**
*
* captcha_recaptcha [Vietnamese]
*
* @package language
* @version 1.08
* @copyright (c) 2009 nedka
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
	'CAPTCHA_RECAPTCHA'	=> 'reCaptcha',

	'RECAPTCHA_EXPLAIN'			=> 'Nhằm ngăn cản các chương trình nhập liệu tự động, bạn hãy vui lòng giải quyết bài kiểm tra sau.',
	'RECAPTCHA_INCORRECT'		=> 'Bạn không vượt qua được bài kiểm tra nhập liệu.',
	'RECAPTCHA_LANG'			=> 'vi',
	'RECAPTCHA_NOSCRIPT'		=> 'Vui lòng bật JavaScript trên trình duyệt để tiếp tục.',
	'RECAPTCHA_NOT_AVAILABLE'	=> 'Để sử dụng được reCaptcha, bạn phải tạo tài khoản tại trang <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'RECAPTCHA_PRIVATE'			=> 'Khóa reCaptcha cá nhân',
	'RECAPTCHA_PRIVATE_EXPLAIN'	=> 'Khóa sử dụng reCaptcha cá nhân mà bạn được cung cấp. Các khóa này được cung cấp tại trang <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'RECAPTCHA_PUBLIC'			=> 'Khóa reCaptcha công cộng',
	'RECAPTCHA_PUBLIC_EXPLAIN'	=> 'Khóa sử dụng reCaptcha công cộng mà bạn được cung cấp. Các khóa này được cung cấp tại trang <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
));
