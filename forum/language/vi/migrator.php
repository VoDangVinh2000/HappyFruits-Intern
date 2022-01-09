<?php
/**
*
* migrator [Vietnamese]
*
* @package language
* @version 1.03
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
	'CONFIG_NOT_EXIST'	=> 'Mục cấu hình “%s” không tồn tại.',

	'GROUP_NOT_EXIST'	=> 'Nhóm “%s” không tồn tại.',

	'MIGRATION_APPLY_DEPENDENCIES'					=> 'Áp dụng phụ thuộc từ %s.',
	'MIGRATION_DATA_DONE'							=> 'Dữ liệu đã hoàn tất: %1$s; Thời gian: %2$.2f giây',
	'MIGRATION_DATA_IN_PROGRESS'					=> 'Dữ liệu đang cập nhật: %1$s; Thời gian: %2$.2f giây',
	'MIGRATION_DATA_RUNNING'						=> 'Dữ liệu đang xử lí: %s.',
	'MIGRATION_EFFECTIVELY_INSTALLED'				=> 'Các nâng cấp đã thực hiện trên hệ thống (không cần áp dụng lại): %s',
	'MIGRATION_EXCEPTION_ERROR'						=> 'Có lỗi xảy ra trong khi thực hiện yêu cầu và ngoại lệ trong mã xuất hiện. Những thay đổi đã thực hiện trên hệ thống trước khi gặp lỗi này đã được phục hồi lại như ban đầu. Bạn nên kiểm tra lại hệ thống để đảm bảo không xảy ra lỗi.',
	'MIGRATION_INVALID_DATA_CUSTOM_NOT_CALLABLE'	=> 'Dữ liệu nâng cấp không hợp lệ. Hàm gọi tùy biến không thể sử dụng.',
	'MIGRATION_INVALID_DATA_MISSING_CONDITION'		=> 'Dữ liệu nâng cấp không hợp lệ. Điều kiện kiểm tra bị khai báo thiếu.',
	'MIGRATION_INVALID_DATA_MISSING_STEP'			=> 'Dữ liệu nâng cấp không hợp lệ. Hàm gọi sử dụng cho bước nâng cấp bị khai báo thiếu.',
	'MIGRATION_INVALID_DATA_UNDEFINED_METHOD'		=> 'Dữ liệu nâng cấp không hợp lệ. Không xác định phương pháp nâng cấp.',
	'MIGRATION_INVALID_DATA_UNDEFINED_TOOL'			=> 'Dữ liệu nâng cấp không hợp lệ. Không xác định công cụ sử dụng.',
	'MIGRATION_INVALID_DATA_UNKNOWN_TYPE'			=> 'Dữ liệu nâng cấp không hợp lệ. Không xác định loại hình nâng cấp.',
	'MIGRATION_NOT_FULFILLABLE'						=> 'Việc nâng cấp “%s” không thực thi toàn vẹn, đã bỏ qua thao tác “%2$s”.',
	'MIGRATION_NOT_INSTALLED'						=> 'Dữ liệu nâng cấp “%s” không được cài đặt.',
	'MIGRATION_NOT_VALID'							=> '%s không phải thao tác nâng cấp hợp lệ.',
	'MIGRATION_REVERT_DATA_DONE'					=> 'Dữ liệu đã phục hồi: %1$s; Thời gian: %2$.2f giây',
	'MIGRATION_REVERT_DATA_IN_PROGRESS'				=> 'Đang phục hồi dữ liệu: %1$s; Thời gian: %2$.2f giây',
	'MIGRATION_REVERT_DATA_RUNNING'					=> 'Đang phục hồi dữ liệu: %s.',
	'MIGRATION_REVERT_SCHEMA_DONE'					=> 'Cấu trúc dữ liệu đã phục hồi: %1$s; Thời gian: %2$.2f giây',
	'MIGRATION_REVERT_SCHEMA_IN_PROGRESS'			=> 'Đang phục hồi cấu trúc dữ liệu: %1$s; Thời gian: %2$.2f giây',
	'MIGRATION_REVERT_SCHEMA_RUNNING'				=> 'Đang phục hồi cấu trúc dữ liệu: %s.',
	'MIGRATION_SCHEMA_DONE'							=> 'Cấu trúc dữ liệu đã hoàn tất: %1$s; Thời gian: %2$.2f giây',
	'MIGRATION_SCHEMA_IN_PROGRESS'					=> 'Cấu trúc đang cập nhật: %1$s; Thời gian: %2$.2f giây',
	'MIGRATION_SCHEMA_RUNNING'						=> 'Cấu trúc dữ liệu đang xử lí: %s.',
	'MODULE_ERROR'									=> 'Có lỗi xuất hiện trong khi thêm vào gói chức năng: %s',
	'MODULE_EXISTS'									=> 'Gói chức năng đã tồn tại: %s',
	'MODULE_EXIST_MULTIPLE'							=> 'Một vài gói chức năng đã sử dụng tên danh mục khai báo: %s. Sừ dụng từ khóa “before/after” để xác định rõ nơi đặt gói chức năng.',
	'MODULE_INFO_FILE_NOT_EXIST'					=> 'Tập tin cài đặt của gói chức năng đã yêu cầu bị thiếu: %2$s',
	'MODULE_NOT_EXIST'								=> 'Gói chức năng đã yêu cầu không tồn tại: %s',

	'PARENT_MODULE_FIND_ERROR'	=> 'Không tìm thấy danh mục chứa gói chức năng: %s',
	'PERMISSION_NOT_EXIST'		=> 'Thiết lập cấp phép “%s” không tồn tại.',

	'ROLE_NOT_EXIST'	=> 'Nhiệm vụ cấp phép “%s” không tồn tại.',
));
