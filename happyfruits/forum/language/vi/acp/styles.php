<?php
/** 
*
* acp/styles [Vietnamese]
*
* @package language
* @version 1.67
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
	'ACP_STYLES_EXPLAIN'	=> 'Với công cụ này, bạn có thể quản lí các giao diện hiện có trên hệ thống. Bạn có thể thay đổi các giao diện, xóa, ngưng kích hoạt, kích hoạt lại hay cài đặt những giao diện mới. Bạn cũng có thể xem trước một giao diện sẽ trông như thế nào khi cài đặt trên hệ thống. Bên cạnh đó, thông tin về số lượng người dùng lựa chọn mỗi giao diện cũng được cung cấp bên dưới. Thiết lập thay thế giao diện mặc định của người dùng không nằm tại đây.',

	'BROWSE_STYLES_DATABASE'	=> 'Tìm giao diện',

	'CANNOT_BE_INSTALLED'		=> 'Không thể cài đặt',
	'CONFIRM_UNINSTALL_STYLES'	=> 'Bạn có chắc chắn muốn gỡ bỏ giao diện đã chọn?',
	'COPYRIGHT'					=> 'Bản quyền',

	'DEACTIVATE_DEFAULT'			=> 'Bạn không thể ngưng kích hoạt giao diện mặc định.',
	'DELETE_FROM_FS'				=> 'Xóa từ hệ thống tập tin giao diện',
	'DELETE_STYLE_FILES_FAILED'		=> 'Có lỗi xảy ra khi xóa giao diện “%s”.',
	'DELETE_STYLE_FILES_SUCCESS'	=> 'Các tập tin của giao diện “%s” đã được xóa hết.',
	'DETAILS'						=> 'Chi tiết',

	'INHERITING_FROM'			=> 'Kế thừa từ',
	'INSTALL_STYLE'				=> 'Cài đặt giao diện',
	'INSTALL_STYLES'			=> 'Cài đặt các giao diện',
	'INSTALL_STYLES_EXPLAIN'	=> 'Với công cụ này, bạn có thể cài đặt các giao diện mới cho hệ thống.<br />Nếu giao diện bạn đang muốn cài không được liệt kê trong danh sách bên dưới, hãy kiểm tra xem bạn đã cài đặt giao diện đó chưa. Nếu chưa, hãy chắc chắn rằng bạn đã tải lên gói giao diện hợp lệ.',
	'INVALID_STYLE_ID'			=> 'Mã ID giao diện không hợp lệ.',

	'NO_MATCHING_STYLES_FOUND'	=> 'Không có giao diện nào trùng khớp với truy vấn của bạn.',
	'NO_UNINSTALLED_STYLE'		=> 'Không có giao diện nào được gỡ bỏ.',

	'PURGED_CACHE'	=> 'Bộ đệm đã được dọn sạch.',

	'REQUIRES_STYLE'	=> 'Giao diện này yêu cầu giao diện khác là “%s” phải được cài đặt trước.',

	'STYLE_ACTIVATE'							=> 'Kích hoạt',
	'STYLE_ACTIVE'								=> 'Đang sử dụng',
	'STYLE_DEACTIVATE'							=> 'Ngưng kích hoạt',
	'STYLE_DEFAULT'								=> 'Chọn làm giao diện mặc định',
	'STYLE_DEFAULT_CHANGE_INACTIVE'				=> 'Bạn phải kích hoạt giao diện trước khi chọn làm giao diện mặc định.',
	'STYLE_ERR_INVALID_PARENT'					=> 'Giao diện kế thừa không hợp lệ.',
	'STYLE_ERR_NAME_EXIST'						=> 'Tên giao diện này đã được sử dụng.',
	'STYLE_ERR_STYLE_NAME'						=> 'Bạn phải nhập tên cho giao diện này.',
	'STYLE_INSTALLED'							=> 'Giao diện “%s” đã được cài đặt thành công.',
	'STYLE_INSTALLED_RETURN_INSTALLED_STYLES'	=> 'Quay về danh sách giao diện đã cài',
	'STYLE_INSTALLED_RETURN_UNINSTALLED_STYLES'	=> 'Cài thêm giao diện khác',
	'STYLE_NAME'								=> 'Tên giao diện',
	'STYLE_NAME_RESERVED'						=> 'Giao diện “%s” không thể cài đặt vì tên này dành riêng cho hệ thống sử dụng.',
	'STYLE_NOT_INSTALLED'						=> 'Giao diện “%s” chưa được cài đặt.',
	'STYLE_PATH'								=> 'Đường dẫn giao diện',
	'STYLE_UNINSTALL'							=> 'Gỡ bỏ',
	'STYLE_UNINSTALL_DEPENDENT'					=> 'Không thể gỡ bỏ giao diện “%s” vì nó đang được các giao diện khác sử dụng kế thừa lại.',
	'STYLE_UNINSTALLED'							=> 'Giao diện “%s” đã được gỡ bỏ thành công.',
	'STYLE_USED_BY'								=> 'Số người sử dụng (Bao gồm máy tìm kiếm)',
	'STYLE_VERSION'								=> 'Phiên bản giao diện',

	'UNINSTALL_DEFAULT'	=> 'Bạn không thể gỡ bỏ giao diện mặc định.',
));
