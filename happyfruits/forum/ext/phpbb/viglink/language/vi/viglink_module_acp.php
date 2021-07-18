<?php
/**
*
* ext/phpbb/viglink/viglink_module_acp [Vietnamese]
*
* @package language
* @version 1.00
* @copyright (c) 2017 nedka
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
	'ACP_VIGLINK_SETTINGS'			=> 'Thiết lập VigLink',
	'ACP_VIGLINK_SETTINGS_EXPLAIN'	=> 'VigLink là dịch vụ bên ngoài nhúng các liên kết tài trợ vào nội dung liên quan do thành viên gửi bài mà không làm ảnh hưởng đến chúng. Khi có người bấm vào xem và mua sản phẩm, người bán trả phí cho VigLink và một phần trong số đó được quyên góp cho dự án phpBB. Khi chọn bật VigLink và quyên góp cho dự án phpBB là bạn đã ủng hộ cho nhóm phát triển chúng tôi rất nhiều để tiếp tục hoàn thiện và phát triển phần mềm này.',
	'ACP_VIGLINK_SETTINGS_CHANGE'	=> 'Bạn có thể thay đổi quyết định này bất kỳ lúc nào tại trang <a href="%1$s">thiết lập VigLink</a>.',
	'ACP_VIGLINK_SUPPORT_EXPLAIN'	=> 'Bạn sẽ không bị chuyển tới trang này nữa nếu bạn thiết lập tùy chọn mình mong muốn bên dưới.',
	'ACP_VIGLINK_ENABLE'			=> 'Bật VigLink',
	'ACP_VIGLINK_ENABLE_EXPLAIN'	=> 'Sử dụng dịch vụ của VigLink.',
	'ACP_VIGLINK_EARNINGS'			=> 'Giữ lại tiền bạn kiếm được (tùy chọn)',
	'ACP_VIGLINK_EARNINGS_EXPLAIN'  => 'Bạn có thể giữ lại tiền mình kiếm được bằng cách đăng ký một tài khoản VigLink để chuyển đổi.',
	'ACP_VIGLINK_DISABLED_PHPBB'	=> 'Dịch vụ của VigLink đã bị vô hiệu bởi phpBB.',
	'ACP_VIGLINK_CLAIM'				=> 'Giữ lại tiền bạn kiếm được',
	'ACP_VIGLINK_CLAIM_EXPLAIN'		=> 'Bạn có thể giữ lại tiền mình kiếm được thông qua các liên kết tài trợ của VigLink, thay vì quyên góp nó cho dự án phpBB. Để quản lý tài khoản của mình, hãy đăng ký một tài khoản VigLink và bấm vào “Đổi tài khoản”.',
	'ACP_VIGLINK_CONVERT_ACCOUNT'	=> 'Đổi tài khoản',
	'ACP_VIGLINK_NO_CONVERT_LINK'	=> 'Không thể truy cập liên kết đổi tài khoản VigLink.'
));
