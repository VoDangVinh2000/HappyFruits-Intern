<?php
/** 
*
* memberlist [Vietnamese]
*
* @package language
* @version 1.53
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
	'ABOUT_USER'		=> 'Thông tin cá nhân',
	'ACTIVE_IN_FORUM'	=> 'Chuyên mục hoạt động tích cực',
	'ACTIVE_IN_TOPIC'	=> 'Chủ đề hoạt động tích cực',
	'ADD_FOE'			=> 'Chặn thêm người',
	'ADD_FRIEND'		=> 'Thêm bạn bè',
	'AFTER'				=> 'Sau',
	'ALL'				=> 'Tất cả',

	'BEFORE'	=> 'Trước',

	'CC_SENDER'		=> 'Gửi bản sao của email này cho tôi.',
	'CONTACT_ADMIN'	=> 'Liên hệ người quản trị',

	'DEST_LANG'			=> 'Ngôn ngữ',
	'DEST_LANG_EXPLAIN'	=> 'Chọn một ngôn ngữ thích hợp cho người nhận tin nhắn này.',

	'EDIT_PROFILE'			=> 'Sửa thông tin cá nhân',
	'EMAIL_BODY_EXPLAIN'	=> 'Email này sẽ được gửi dưới dạng văn bản thuần túy, vì thế bạn đừng sử dụng bất cứ thẻ HTML hay BBCode nào trong nội dung email này. Địa chỉ hồi âm của email này sẽ được thiết lập là địa chỉ email của bạn.',
	'EMAIL_DISABLED'		=> 'Xin lỗi, tất cả chức năng liên quan đến email trong hệ thống đã bị vô hiệu.',
	'EMAIL_SENT'			=> 'Email đã được gửi thành công.',
	'EMAIL_TOPIC_EXPLAIN'	=> 'Email này sẽ được gửi dưới dạng văn bản thuần túy, vì thế bạn đừng sử dụng bất cứ thẻ HTML hay BBCode nào trong nội dung email này. Lưu ý rằng thông tin về chủ đề này sẽ được đính kèm trong nội dung email. Địa chỉ hồi âm của email này sẽ được thiết lập là địa chỉ email của bạn.',
	'EMPTY_ADDRESS_EMAIL'	=> 'Bạn phải nhập địa chỉ email hợp lệ của người nhận.',
	'EMPTY_MESSAGE_EMAIL'	=> 'Bạn phải nhập nội dung cho email.',
	'EMPTY_MESSAGE_IM'		=> 'Bạn phải nhập nội dung cho tin nhắn.',
	'EMPTY_NAME_EMAIL'		=> 'Bạn phải nhập tên của người nhận.',
	'EMPTY_SENDER_EMAIL'	=> 'Bạn phải nhập địa chỉ email hợp lệ.',
	'EMPTY_SENDER_NAME'		=> 'Bạn phải nhập tên mình.',
	'EMPTY_SUBJECT_EMAIL'	=> 'Bạn phải nhập tiêu đề cho email.',
	'EQUAL_TO'				=> 'Bằng',

	'FIND_USERNAME_EXPLAIN'	=> 'Công cụ này sẽ giúp bạn tìm kiếm những thành viên xác định trong hệ thống. Bạn không cần phải điền đầy đủ thông tin trong tất cả các mục bên dưới. Sử dụng dấu * để tìm kiếm những thành viên có tến giống nhau một phần nào đó. Khi nhập thông tin về ngày tháng bạn cần sử dụng định dạng <kbd>YYYY-MM-DD</kbd>. Ví dụ: <samp>2004-02-29</samp>. Đánh dấu chọn trong phần đánh dấu để chọn một hay nhiều tên tài khoản. Những tên tài khoản khác nhau có thể được chọn tùy thuộc vào bảng được liệt kê. Bấm vào nút <strong>Chọn đánh dấu</strong> nếu có để quay về bảng điều khiển trước.',
	'FLOOD_EMAIL_LIMIT'		=> 'Bạn không thể gửi email vào thời điểm này. Hãy thử lại sau vài phút nữa!',

	'GROUP_LEADER'			=> 'Trưởng nhóm',

	'HIDE_MEMBER_SEARCH'	=> 'Ẩn tìm kiếm thành viên',

	'IM_ADD_CONTACT'	=> 'Thêm thành viên',
	'IM_DOWNLOAD_APP'	=> 'Tải về ứng dụng',
	'IM_JABBER'			=> 'Lưu ý rằng các thành viên có thể chọn không nhận những tin nhắn nhanh mà họ không mong muốn.',
	'IM_JABBER_SUBJECT'	=> 'Đây là tin nhắn thông báo tự động, xin đừng trả lời! Tin nhắn từ thành viên <strong>%1$s</strong> trong %2$s.',
	'IM_MESSAGE'		=> 'Nội dung tin nhắn nhanh',
	'IM_NAME'			=> 'Tên của bạn',
	'IM_NO_DATA'		=> 'Không có thông tin liên hệ phù hợp nào về thành viên này.',
	'IM_NO_JABBER'		=> 'Xin lỗi, chức năng gửi tin nhắn trực tiếp đến các thành viên sử dụng Jabber không được hỗ trợ trên diễn đàn này. Bạn sẽ cần phải cài đặt ứng dụng <strong>Jabber</strong> trên máy tính của mình để liên hệ với người nhận trên.',
	'IM_RECIPIENT'		=> 'Người nhận',
	'IM_SEND'			=> 'Gửi tin nhắn',
	'IM_SEND_MESSAGE'	=> 'Gửi tin nhắn',
	'IM_SENT_JABBER'	=> 'Tin nhắn của bạn đến <strong>%1$s</strong> đã được gửi thành công.',
	'IM_USER'			=> 'Gửi tin nhắn nhanh',

	'LAST_ACTIVE'				=> 'Lần hoạt động trước',
	'LESS_THAN'					=> 'Ít hơn',
	'LIST_USERS'				=> array(
		1	=> '%d thành viên',
		2	=> '%d thành viên',
	),
	'LOGIN_EXPLAIN_TEAM'		=> 'Bạn phải đăng nhập để xem danh sách ban điều hành.',
	'LOGIN_EXPLAIN_MEMBERLIST'	=> 'Bạn phải đăng nhập để xem danh sách thành viên.',
	'LOGIN_EXPLAIN_SEARCHUSER'	=> 'Bạn phải đăng nhập để tìm kiếm thành viên.',	
	'LOGIN_EXPLAIN_VIEWPROFILE'	=> 'Bạn phải đăng nhập để xem thông tin cá nhân của thành viên.',

	'MANAGE_GROUP'	=> 'Quản lí nhóm',
	'MORE_THAN'		=> 'Nhiều hơn',

	'NO_CONTACT_FORM'	=> 'Thông tin liên hệ người quản trị đã bị vô hiệu.',
	'NO_CONTACT_PAGE'	=> 'Trang liên hệ người quản trị đã bị vô hiệu.',
	'NO_EMAIL'			=> 'Bạn không được phép gửi email đến thành viên này.',
	'NO_VIEW_USERS'		=> 'Bạn không được phép xem danh sách thành viên hay thông tin cá nhân của thành viên.',

	'ORDER'	=> 'Thứ tự',
	'OTHER'	=> 'Thông tin khác',

	'POST_IP'	=> 'Gửi bài từ địa chỉ IP/Tên miền',

	'REAL_NAME'				=> 'Tên người nhận',
	'RECIPIENT'				=> 'Người nhận',
	'REMOVE_FOE'			=> 'Gỡ bỏ chặn',
	'REMOVE_FRIEND'			=> 'Gỡ bỏ bạn bè',

	'SELECT_MARKED'			=> 'Chọn đánh dấu',
	'SELECT_SORT_METHOD'	=> 'Chọn cách sắp xếp',
	'SENDER_EMAIL_ADDRESS'	=> 'Địa chỉ email của bạn',
	'SENDER_NAME'			=> 'Tên bạn',
	'SEND_ICQ_MESSAGE'		=> 'Gửi tin nhắn ICQ',
	'SEND_IM'				=> 'Nhắn tin nhanh',
	'SEND_JABBER_MESSAGE'	=> 'Gửi tin nhắn Jabber',
	'SEND_MESSAGE'			=> 'Tin nhắn',
	'SEND_YIM_MESSAGE'		=> 'Gửi tin nhắn YIM',
	'SORT_EMAIL'			=> 'Địa chỉ email',
	'SORT_LAST_ACTIVE'		=> 'Lần hoạt động trước',
	'SORT_POST_COUNT'		=> 'Số bài viết',

	'USERNAME_BEGINS_WITH'	=> 'Tên tài khoản bắt đầu bằng',
	'USER_ADMIN'			=> 'Quản trị viên',
	'USER_BAN'				=> 'Bảng cấm',
	'USER_FORUM'			=> 'Thống kê thành viên',
	'USER_LAST_REMINDED'	=> array(
		0	=> 'Hiện tại chưa bị nhắc nhở.',
		1	=> 'Đã bị nhắc nhở %1$d lần.<br />» %2$s',
		2	=> 'Đã bị nhắc nhở %1$d lần.<br />» %2$s',
	),
	'USER_ONLINE'			=> 'Đang trực tuyến',
	'USER_PRESENCE'			=> 'Hiện diện',
	'USERS_PER_PAGE'		=> 'Số lượng thành viên mỗi trang',

	'VIEWING_PROFILE'			=> 'Thông tin cá nhân của %s',
	'VIEW_FACEBOOK_PROFILE'		=> 'Xem trang Facebook',
	'VIEW_SKYPE_PROFILE'		=> 'Xem trang Skype',
	'VIEW_TWITTER_PROFILE'		=> 'Xem trang Twitter',
	'VIEW_YOUTUBE_CHANNEL'		=> 'Xem kênh YouTube',
	'VIEW_GOOGLEPLUS_PROFILE'	=> 'Xem trang Google+',
));

?>