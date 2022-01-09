<?php
/**
*
* plupload [Vietnamese]
*
* @package language
* @version 1.02
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
	'PLUPLOAD_ADD_FILES'			=> 'Thêm tập tin',
	'PLUPLOAD_ADD_FILES_TO_QUEUE'	=> 'Thêm tập tin vào hàng chờ và bấm nút <strong>“Bắt đầu tải lên hàng chờ”</strong> để tải lên hết toàn bộ.',
	'PLUPLOAD_ALREADY_QUEUED'		=> 'Tập tin %s đã có trong hàng chờ.',
	'PLUPLOAD_CLOSE'				=> 'Đóng',
	'PLUPLOAD_DRAG'					=> 'Kéo thả tập tin vào đây.',
	'PLUPLOAD_DRAG_TEXTAREA'		=> 'Bạn có thể đính kèm nhanh tập tin bằng cách kéo thả vào khung soạn thảo.',
	'PLUPLOAD_DUPLICATE_ERROR'		=> 'Lỗi trùng tập tin.',
	'PLUPLOAD_ERR_FILE_COUNT'		=> 'Lỗi đếm tập tin.',
	'PLUPLOAD_ERR_FILE_INVALID_EXT'	=> 'Phần mở rộng tập tin không hợp lệ:',
	'PLUPLOAD_ERR_FILE_TOO_LARGE'	=> 'Dung lượng tập tin quá lớn:',
	'PLUPLOAD_ERR_INPUT'			=> 'Có lỗi khi mở dữ liệu nhập.',
	'PLUPLOAD_ERR_MOVE_UPLOADED'	=> 'Có lỗi khi di chuyển tập tin đã tải lên.',
	'PLUPLOAD_ERR_OUTPUT'			=> 'Có lỗi khi mở dữ liệu xuất.',
	'PLUPLOAD_ERR_RUNTIME_MEMORY'	=> 'Tiến trình xử lí đã vượt quá dung lượng bộ nhớ.',
	'PLUPLOAD_ERR_UPLOAD_URL'		=> 'Địa chỉ URL tải lên bị lỗi hoặc không tồn tại.',
	'PLUPLOAD_EXTENSION_ERROR'		=> 'Lỗi loại tập tin.',
	'PLUPLOAD_FILE'					=> 'Tập tin: %s',
	'PLUPLOAD_FILE_DETAILS'			=> 'Tập tin: %s, dung lượng: %d, dung lượng tối đa: %d',
	'PLUPLOAD_FILENAME'				=> 'Tên tập tin',
	'PLUPLOAD_FILES_QUEUED'			=> '%d tập tin đang chờ',
	'PLUPLOAD_GENERIC_ERROR'		=> 'Lỗi tổng quát.',
	'PLUPLOAD_HTTP_ERROR'			=> 'Lỗi HTTP.',
	'PLUPLOAD_IMAGE_FORMAT'			=> 'Định dạng hình ảnh bị lỗi hoặc không được hỗ trợ.',
	'PLUPLOAD_INIT_ERROR'			=> 'Lỗi khởi tạo.',
	'PLUPLOAD_IO_ERROR'				=> 'Lỗi nhập/xuất.',
	'PLUPLOAD_NOT_APPLICABLE'		=> 'Không sẵn sàng',
	'PLUPLOAD_SECURITY_ERROR'		=> 'Lỗi bảo mật.',
	'PLUPLOAD_SELECT_FILES'			=> 'Chọn tập tin',
	'PLUPLOAD_SIZE'					=> 'Dung lượng',
	'PLUPLOAD_SIZE_ERROR'			=> 'Lỗi dung lượng tập tin.',
	'PLUPLOAD_STATUS'				=> 'Trạng thái',
	'PLUPLOAD_START_UPLOAD'			=> 'Bắt đầu tải lên',
	'PLUPLOAD_START_CURRENT_UPLOAD'	=> 'Bắt đầu tải lên hàng chờ',
	'PLUPLOAD_STOP_UPLOAD'			=> 'Ngừng tải lên',
	'PLUPLOAD_STOP_CURRENT_UPLOAD'	=> 'Ngừng tập tin đang tải lên',
	// Note: This string is formatted independently by plupload and so does not
	// use the same formatting rules as normal phpBB translation strings
	'PLUPLOAD_UPLOADED'				=> 'Đã tải lên %d/%d tập tin',
));
