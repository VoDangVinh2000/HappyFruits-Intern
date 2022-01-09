<?php
/** 
*
* acp/modules [Vietnamese]
*
* @package language
* @version 1.19
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
	'ACP_MODULE_MANAGEMENT_EXPLAIN'	=> 'Công cụ này cho phép bạn quản lí tất cả các loại nhóm và gói chức năng trong hệ thống. Cần lưu ý rằng bảng quản trị có cấu trúc trình đơn đến ba cấp (Nhóm chức năng -> Nhóm chức năng -> Gói chức năng) nhờ đó mà các gói chức năng khác có cấu trúc trình đơn hai cấp (Nhóm chức năng -> Gói chức năng) mới được giữ lại bên trong. Hãy cẩn thận vì bạn có thể làm hư hỏng toàn bộ các trình đơn trong bảng quản trị và mất chức năng điều khiển nếu bạn vô hiệu hay xóa các gói chức năng có nhiệm vụ quản lí cho các gói chức năng khác và cả chính nó.',
	'ADD_MODULE'					=> 'Thêm gói chức năng',
	'ADD_MODULE_CONFIRM'			=> 'Bạn có chắc chắn muốn thêm vào gói chức năng với chế độ đã chọn?',
	'ADD_MODULE_TITLE'				=> 'Thêm vào gói chức năng',

	'CANNOT_REMOVE_MODULE'	=> 'Không thể gỡ bỏ gói chức năng này vì nó có chứa nhiều mục con. Hãy gở bỏ hoặc di chuyển tất cả các mục con trước khi thực hiện yêu cầu này.',
	'CATEGORY'				=> 'Nhóm chức năng',
	'CHOOSE_MODE'			=> 'Chọn chế độ gói chức năng',
	'CHOOSE_MODE_EXPLAIN'	=> 'Chọn những chế độ mà gói chức năng được sử dụng.',
	'CHOOSE_MODULE'			=> 'Chọn gói chức năng',
	'CHOOSE_MODULE_EXPLAIN'	=> 'Chọn tập tin được thực thi bởi gói chức năng này.',
	'CREATE_MODULE'			=> 'Tạo gói chức năng mới',

	'DEACTIVATED_MODULE'	=> 'Gói chức năng đã ngưng kích hoạt',
	'DELETE_MODULE'			=> 'Xóa gói chức năng',
	'DELETE_MODULE_CONFIRM'	=> 'Bạn có chắc chắn muốn gỡ bỏ gói chức năng này?',

	'EDIT_MODULE'			=> 'Sửa gói chức năng',
	'EDIT_MODULE_EXPLAIN'	=> 'Bạn có thể thay đổi lại thiết lập của gói chức năng tại đây.',

	'HIDDEN_MODULE'			=> 'Gói chức năng ẩn',

	'MODULE'					=> 'Gói chức năng',
	'MODULE_ADDED'				=> 'Gói chức năng đã được tạo thành công.',
	'MODULE_DELETED'			=> 'Gói chức năng đã được gỡ bỏ thành công.',
	'MODULE_DISPLAYED'			=> 'Gói chức năng đã hiển thị',
	'MODULE_DISPLAYED_EXPLAIN'	=> 'Nếu bạn không muốn hiển thị gói chức năng này nhưng vẫn muốn sử dụng chức năng của nó, hãy chọn không hiển thị gói chức năng tại đây.',
	'MODULE_EDITED'				=> 'Gói chức năng đã được sửa thành công.',
	'MODULE_ENABLED'			=> 'Gói chức năng đã kích hoạt',
	'MODULE_LANGNAME'			=> 'Tên ngôn ngữ gói chức năng',
	'MODULE_LANGNAME_EXPLAIN'	=> 'Nhập vào tên ngôn ngữ mà gói chức năng sẽ được hiển thị. Sử dụng tên hằng ngôn ngữ để nhập vào nếu tên này đã được xác trong tập tin ngôn ngữ.',
	'MODULE_TYPE'				=> 'Loại gói chức năng',

	'NO_CATEGORY_TO_MODULE'	=> 'Không thể thay đổi nhóm chức năng trở thành gói chức năng. Hãy gở bỏ hoặc di chuyển tất cả các mục con trước khi thực hiện yêu cầu này.',
	'NO_MODULE'				=> 'Không tìm thấy gói chức năng.',
	'NO_MODULE_ID'			=> 'Không có gói chức năng nào được xác định.',
	'NO_MODULE_LANGNAME'	=> 'Không có tên ngôn ngữ gói chức năng nào được xác định.',
	'NO_PARENT'				=> 'Không có thư mục chính',

	'PARENT'				=> 'Thư mục chính',
	'PARENT_NO_EXIST'		=> 'Thư mục chính không tồn tại.',

	'SELECT_MODULE'			=> 'Chọn một gói chức năng',
));
