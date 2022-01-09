<?php
/** 
*
* acp/language [Vietnamese]
*
* @package language
* @version 1.27
* @copyright (c) 2006 nedka
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
	'ACP_FILES'						=> 'Tập tin ngôn ngữ dùng trong bảng quản trị',
	'ACP_LANGUAGE_PACKS_EXPLAIN'	=> 'Bảng điều khiển này sẽ giúp bạn cài đặt hoặc gỡ bỏ các ngôn ngữ trong hệ thống. Ngôn ngữ mặc định được đánh dấu bằng một dấu sao (*).',

	'BROWSE_LANGUAGE_PACKS_DATABASE'	=> 'Tìm gói ngôn ngữ',

	'DELETE_LANGUAGE_CONFIRM'	=> 'Bạn có chắc chắn muốn xóa “%s”?',

	'INSTALLED_LANGUAGE_PACKS'	=> 'Những ngôn ngữ đã cài đặt',

	'LANGUAGE_DETAILS_UPDATED'			=> 'Thông tin chi tiết về ngôn ngữ đã được cập nhật thành công.',
	'LANGUAGE_PACK_ALREADY_INSTALLED'	=> 'Ngôn ngữ này đã được cài đặt.',
	'LANGUAGE_PACK_CPF_UPDATE'			=> 'Biến ngôn ngữ của các mục thông tin cá nhân tùy biến đã được sao chép từ ngôn ngữ mặc định. Hãy thay đổi chúng nếu cần thiết.',
	'LANGUAGE_PACK_DELETED'				=> 'Ngôn ngữ “%s” đã được gỡ bỏ thành công. Tất cả người dùng đang sử dụng ngôn ngữ này sẽ được tự động thay bằng ngôn ngữ mặc định của hệ thống.',
	'LANGUAGE_PACK_DETAILS'				=> 'Thông tin chi tiết về ngôn ngữ',
	'LANGUAGE_PACK_INSTALLED'			=> 'Ngôn ngữ “%s” đã được cài đặt thành công.',
	'LANGUAGE_PACK_ISO'					=> 'Mã ISO',
	'LANGUAGE_PACK_LOCALNAME'			=> 'Tên địa phương',
	'LANGUAGE_PACK_NAME'				=> 'Tên',
	'LANGUAGE_PACK_NOT_EXIST'			=> 'Ngôn ngữ vừa chọn không tồn tại.',
	'LANGUAGE_PACK_USED_BY'				=> 'Số người sử dụng (Bao gồm máy tìm kiếm)',
	'LANGUAGE_VARIABLE'					=> 'Biến ngôn ngữ',
	'LANG_AUTHOR'						=> 'Người dịch',
	'LANG_ENGLISH_NAME'					=> 'Tên tiếng Anh',
	'LANG_ISO_CODE'						=> 'Mã ISO',
	'LANG_LOCAL_NAME'					=> 'Tên hệ thống',

	'MISSING_LANG_FILES'		=> 'Tập tin ngôn ngữ bị thiếu',
	'MISSING_LANG_VARIABLES'	=> 'Biến ngôn ngữ bị thiếu',

	'NO_FILE_SELECTED'				=> 'Bạn chưa xác định một tập tin ngôn ngữ.',
	'NO_LANG_ID'					=> 'Bạn chưa xác định ngôn ngữ.',
	'NO_REMOVE_DEFAULT_LANG'		=> 'Bạn không thể gõ bỏ ngôn ngữ mặc định.<br />Nếu bạn muốn gõ bỏ ngôn ngữ này, trước hết hãy thay đổi ngôn ngữ mặc định của hệ thống.',
	'NO_UNINSTALLED_LANGUAGE_PACKS'	=> 'Không có ngôn ngữ nào được gỡ bỏ',

	'THOSE_MISSING_LANG_FILES'		=> 'Những tập tin ngôn ngữ dưới đây bị thiếu trong thư mục “%s”',
	'THOSE_MISSING_LANG_VARIABLES'	=> 'Những biến ngôn ngữ dưới đây bị thiếu trong gói ngôn ngữ “%s”',

	'UNINSTALLED_LANGUAGE_PACKS'	=> 'Những ngôn ngữ chưa sử dụng',
));
