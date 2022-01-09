<?php
/** 
*
* acp/users [Vietnamese]
*
* @package language
* @version 1.37
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
	'ADMIN_SIG_PREVIEW'		=> 'Xem trước chữ ký cá nhân',
	'AT_LEAST_ONE_FOUNDER'	=> 'Bạn không thể thay đổi người sáng lập này trở thành một người dùng bình thường. Trong hệ thống chỉ cần ít nhất một người dùng là người sáng lập được chọn. Nếu bạn muốn thay đổi người sáng lập này thành các người dùng khác thì trước hết bạn phải là một người sáng lập.',
	
	'BAN_ALREADY_ENTERED'	=> 'Lệnh cấm đã được nhập vào thành công trước đây. Danh sách cấm sẽ không cần cập nhật.',
	'BAN_SUCCESSFUL'		=> 'Lệnh cấm đã được thực hiện thành công.',

	'CANNOT_BAN_ANONYMOUS'			=> 'Bạn không thể cấm tài khoản khách. Thiết lập cấp phép dành cho khách nằm trong phần <strong>Cấp phép</strong>.',
	'CANNOT_BAN_FOUNDER'			=> 'Bạn không thể cấm tài khoản của người sáng lập.',
	'CANNOT_BAN_YOURSELF'			=> 'Bạn không thể cấm tài khoản của chính mình.',
	'CANNOT_DEACTIVATE_BOT'			=> 'Bạn không thể ngưng kích hoạt tài khoản của máy tìm kiếm. Hãy vui lòng ngưng kích hoạt từng máy tìm kiếm trong trang quản lí chúng.',
	'CANNOT_DEACTIVATE_FOUNDER'		=> 'Bạn không thể ngưng kích hoạt tài khoản của người sáng lập.',
	'CANNOT_DEACTIVATE_YOURSELF'	=> 'Bạn không thể ngưng kích hoạt tài khoản của chính mình.',
	'CANNOT_FORCE_REACT_BOT'		=> 'Bạn không thể yêu cầu kích hoạt lại tài khoản của máy tìm kiếm. Hãy vui lòng kích hoạt lại từng máy tìm kiếm trong trang quản lí chúng.',
	'CANNOT_FORCE_REACT_FOUNDER'	=> 'Bạn không thể yêu cầu kích hoạt lại tài khoản của người sáng lập.',
	'CANNOT_FORCE_REACT_YOURSELF'	=> 'Bạn không thể yêu cầu kích hoạt lại tài khoản của chính mình.',
	'CANNOT_REMOVE_ANONYMOUS'		=> 'Bạn không thể gỡ bỏ tài khoản của khách.',
	'CANNOT_REMOVE_FOUNDER'			=> 'Bạn không thể gỡ bỏ tài khoản người sáng lập.',
	'CANNOT_REMOVE_YOURSELF'		=> 'Bạn không thể gỡ bỏ tài khoản người dùng của chính mình.',
	'CANNOT_SET_FOUNDER_IGNORED'	=> 'Bạn không thể tăng cấp những người dùng bị cấm trở thành người sáng lập.',
	'CANNOT_SET_FOUNDER_INACTIVE'	=> 'Bạn cần phải kích hoạt tài khoản của người dùng trước khi bạn tăng cấp cho người dùng này trở thành người sáng lập và chỉ có những người dùng đã kích hoạt mới có thể tăng cấp được.',
	'CONFIRM_EMAIL_EXPLAIN'			=> 'Bạn chỉ cần xác nhận lại địa chỉ email nếu bạn muốn thay đổi địa chỉ email của người dùng.',

	'DELETE_POSTS'			=> 'Xóa bài viết',
	'DELETE_USER'			=> 'Xóa người dùng',
	'DELETE_USER_EXPLAIN'	=> 'Lưu ý rằng việc xóa người dùng này là xóa vĩnh viễn và không thể phục hồi lại. Những tin nhắn cá nhân mà người dùng này đã gửi nhưng người nhận chưa xem cũng sẽ được xóa khỏi hộp thư nhận của họ.',

	'FORCE_REACTIVATION_SUCCESS'	=> 'Việc yêu cầu người dùng kích hoạt lại tài khoản của mình đã được thực hiện thành công.',
	'FOUNDER'						=> 'Người sáng lập',
	'FOUNDER_EXPLAIN'				=> 'Người sáng lập có tất cả quyền hạn của quản trị viên và không bao giờ bị cấm, xóa hay thay đổi bởi bất kì người dùng nào.',

	'GROUP_APPROVE'		=> 'Chấp nhận thành viên',
	'GROUP_DEFAULT'		=> 'Chọn làm nhóm thành viên mặc định',
	'GROUP_DELETE'		=> 'Gỡ bỏ thành viên khỏi nhóm',
	'GROUP_DEMOTE'		=> 'Giáng chức trưởng nhóm',
	'GROUP_PROMOTE'		=> 'Thăng chức thành trưởng nhóm',

	'IP_WHOIS_FOR'			=> 'Tra cứu địa chỉ IP cho %s',

	'LAST_ACTIVE'			=> 'Lần hoạt động trước',

	'MOVE_POSTS_EXPLAIN'	=> 'Hãy chọn chuyên mục mà bạn muốn di chuyển tất cả các bài viết của người dùng này đến.',

	'NO_SPECIAL_RANK'		=> 'Không có danh hiệu đặc biệt nào được chỉ định',
	'NO_WARNINGS'			=> 'Không có cảnh cáo nào.',
	'NOT_MANAGE_FOUNDER'	=> 'Bạn đang cố gắng quản lí một người dùng là người sáng lập. Chỉ có những người sáng lập mới được phép quản lí lẫn nhau.',

	'QUICK_TOOLS'			=> 'Công cụ nhanh',

	'REGISTERED'			=> 'Người dùng đã đăng ký',
	'REGISTERED_IP'			=> 'Đã đăng ký từ địa chỉ IP',
	'RETAIN_POSTS'			=> 'Những bài viết còn lại',

	'SELECT_FORM'			=> 'Chọn bảng',
	'SELECT_USER'			=> 'Chọn người dùng',

	'USER_ADMIN'					=> 'Quản lí người dùng',
	'USER_ADMIN_ACTIVATE'			=> 'Kích hoạt tài khoản',
	'USER_ADMIN_ACTIVATED'			=> 'Tài khoản người dùng đã được kích hoạt thành công.',
	'USER_ADMIN_AVATAR_REMOVED'		=> 'Hình đại diện của người dùng đã được gỡ bỏ thành công.',
	'USER_ADMIN_BAN_EMAIL'			=> 'Cấm địa chỉ email',
	'USER_ADMIN_BAN_EMAIL_REASON'	=> 'Những địa chỉ email đã bị cấm từ phần quản lí người dùng',
	'USER_ADMIN_BAN_IP'				=> 'Cấm địa chỉ IP',
	'USER_ADMIN_BAN_IP_REASON'		=> 'Những địa chỉ IP đã bị cấm từ phần quản lí người dùng',
	'USER_ADMIN_BAN_NAME_REASON'	=> 'Tên tài khoản đã bị cấm từ phần quản lí người dùng',
	'USER_ADMIN_BAN_USER'			=> 'Cấm tài khoản',
	'USER_ADMIN_DEACTIVATE'			=> 'Ngưng kích hoạt tài khoản',
	'USER_ADMIN_DEACTIVED'			=> 'Tài khoản người dùng đã được ngưng kích hoạt thành công.',
	'USER_ADMIN_DEL_ATTACH'			=> 'Xóa tất cả tập tin đính kèm của người dùng này',
	'USER_ADMIN_DEL_AVATAR'			=> 'Xóa hình đại diện của người dùng này',
	'USER_ADMIN_DEL_OUTBOX'			=> 'Dọn sạch hộp thư chuyển đi',
	'USER_ADMIN_DEL_POSTS'			=> 'Xóa tất cả bài viết của người dùng này',
	'USER_ADMIN_DEL_SIG'			=> 'Xóa chữ ký cá nhân của người dùng này',
	'USER_ADMIN_EXPLAIN'			=> 'Với công cụ này, bạn có thể thay đổi thông tin cá nhân của các người dùng cũng như những tùy chọn hay thiết lập cá nhân của họ.',
	'USER_ADMIN_FORCE'				=> 'Yêu cầu người dùng này kích hoạt lại tài khoản của mình',
	'USER_ADMIN_LEAVE_NR'			=> 'Gỡ bỏ khỏi nhóm “Người dùng mới đăng ký”',
	'USER_ADMIN_MOVE_POSTS'			=> 'Di chuyển tất cả bài viết của người dùng này',
	'USER_ADMIN_SIG_REMOVED'		=> 'Đã gỡ bỏ thành công chữ ký cá nhân của người dùng này.',
	'USER_ATTACHMENTS_REMOVED'		=> 'Đã gỡ bỏ thành công tất cả tập tin đính kèm của người dùng này.',
	'USER_AVATAR_NOT_ALLOWED'		=> 'Hình đại diện không được hiển thị vì chức năng này đã bị vô hiệu.',
	'USER_AVATAR_UPDATED'			=> 'Đã cập nhật thành công hình đại diện của người dùng này.',
	'USER_AVATAR_TYPE_NOT_ALLOWED'	=> 'Hình đại diện hiện tại không được hiển thị vì loại hình này không được phép dùng.',
	'USER_CUSTOM_PROFILE_FIELDS'	=> 'Mục thông tin cá nhân tùy biến',
	'USER_DELETED'					=> 'Tài khoản của người dùng này đã được xóa thành công.',
	'USER_GROUP_ADD'				=> 'Thêm người dùng này vào',
	'USER_GROUP_NORMAL'				=> 'Nhóm do người dùng chỉ định, là thành viên của nhóm',
	'USER_GROUP_PENDING'			=> 'Nhóm đang trong chế độ chờ quyết định',
	'USER_GROUP_SPECIAL'			=> 'Nhóm đã được chỉ định trước, là thành viên của nhóm',
	'USER_LIFTED_NR'				=> 'Đã gỡ bỏ thành công trạng thái mới đăng ký cho người dùng này.',
	'USER_NO_ATTACHMENTS'			=> 'Chưa đính kèm bất kì tập tin nào.',
	'USER_NO_POSTS_TO_DELETE'		=> 'Người dùng không có bài viết nào để giữ lại hay xóa.',
	'USER_OUTBOX_EMPTIED'			=> 'Đã dọn sạch thành công hộp thư chuyển đi của người dùng này.',
	'USER_OUTBOX_EMPTY'				=> 'Không có tin nhắn nào trong hộp thư chuyển đi của người dùng này.',
	'USER_OVERVIEW_UPDATED'			=> 'Thông tin chi tiết về người dùng đã được cập nhật thành công.',
	'USER_POSTS_DELETED'			=> 'Đã gỡ bỏ thành công tất cả bài viết của người dùng này.',
	'USER_POSTS_MOVED'				=> 'Đã di chuyển thành công tất cả bài viết của người dùng này đến chuyên mục được chọn.',
	'USER_PREFS_UPDATED'			=> 'Thiết lập cá nhân của người dùng đã được cập nhật thành công.',
	'USER_PROFILE'					=> 'Thông tin cá nhân của người dùng',
	'USER_PROFILE_UPDATED'			=> 'Thông tin cá nhân của người dùng đã được cập nhật thành công.',
	'USER_RANK'						=> 'Danh hiệu cá nhân',
	'USER_RANK_UPDATED'				=> 'Danh hiệu của người dùng đã được cập nhật thành công.',
	'USER_SIG_UPDATED'				=> 'Chữ ký cá nhân của người dùng đã được cập nhật thành công.',
	'USER_WARNING_LOG_DELETED'		=> 'Không nhận được cảnh cáo nào. Có thể bản ghi cảnh cáo đã bị xóa.',
	'USER_TOOLS'					=> 'Công cụ đơn giản',
));
