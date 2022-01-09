<?php
/**
*
* acp/permissions_phpbb (phpBB Permission Set) [Vietnamese]
*
* @package language
* @version 2.07
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

/**
*	EXTENSION-DEVELOPERS PLEASE NOTE
*
*	You are able to put your permission sets into your extension.
*	The permissions logic should be added via the 'core.permissions' event.
*	You can easily add new permission categories, types and permissions, by
*	simply merging them into the respective arrays.
*	The respective language strings should be added into a language file, that
*	start with 'permissions_', so they are automatically loaded within the ACP.
*/

$lang = array_merge($lang, array(
	'ACL_CAT_ACTIONS'		=> 'Thao tác',
	'ACL_CAT_CONTENT'		=> 'Nội dung',
	'ACL_CAT_FORUMS'		=> 'Chuyên mục',
	'ACL_CAT_MISC'			=> 'Khác',
	'ACL_CAT_PERMISSIONS'	=> 'Cấp phép',
	'ACL_CAT_PM'			=> 'Tin nhắn',
	'ACL_CAT_POLLS'			=> 'Bình chọn',
	'ACL_CAT_POST'			=> 'Bài viết',
	'ACL_CAT_POST_ACTIONS'	=> 'Thao tác bài viết',
	'ACL_CAT_POSTING'		=> 'Gửi bài',
	'ACL_CAT_PROFILE'		=> 'Cá nhân',
	'ACL_CAT_SETTINGS'		=> 'Thiết lập',
	'ACL_CAT_TOPIC_ACTIONS'	=> 'Thao tác chủ đề',
	'ACL_CAT_USER_GROUP'	=> 'Người dùng &amp; Nhóm',
));

// User Permissions
$lang = array_merge($lang, array(
	'ACL_U_VIEWPROFILE'		=> 'Xem thông tin cá nhân, danh sách thành viên và ai đang trực tuyến',
	'ACL_U_CHGNAME'			=> 'Đổi tên tài khoản',
	'ACL_U_CHGPASSWD'		=> 'Đổi mật khẩu',
	'ACL_U_CHGEMAIL'		=> 'Đổi địa chỉ email',
	'ACL_U_CHGAVATAR'		=> 'Đổi hình đại diện',
	'ACL_U_CHGGRP'			=> 'Đổi nhóm mặc định',
	'ACL_U_CHGPROFILEINFO'	=> 'Đổi thông tin cá nhân',

	'ACL_U_ATTACH'		=> 'Đính kèm tập tin',
	'ACL_U_DOWNLOAD'	=> 'Tải về tập tin',
	'ACL_U_SAVEDRAFTS'	=> 'Lưu bản nháp',
	'ACL_U_CHGCENSORS'	=> 'Bỏ qua kiểm duyệt từ',
	'ACL_U_SIG'			=> 'Sử dụng chữ ký cá nhân',

	'ACL_U_SENDPM'			=> 'Gửi tin nhắn',
	'ACL_U_MASSPM'			=> 'Gửi tin nhắn cho nhiều người',
	'ACL_U_MASSPM_GROUP'	=> 'Gửi tin nhắn cho nhóm',
	'ACL_U_READPM'			=> 'Xem tin nhắn',
	'ACL_U_PM_EDIT'			=> 'Sửa tin nhắn của mình',
	'ACL_U_PM_DELETE'		=> 'Xóa tin nhắn của mình',
	'ACL_U_PM_FORWARD'		=> 'Chuyển tiếp tin nhắn',
	'ACL_U_PM_EMAILPM'		=> 'Gửi email tin nhắn',
	'ACL_U_PM_PRINTPM'		=> 'In tin nhắn',
	'ACL_U_PM_ATTACH'		=> 'Đính kèm tập tin trong tin nhắn',
	'ACL_U_PM_DOWNLOAD'		=> 'Tải về tập tin trong tin nhắn',
	'ACL_U_PM_BBCODE'		=> 'Sử dụng BBCode trong tin nhắn',
	'ACL_U_PM_SMILIES'		=> 'Sử dụng biểu tượng vui trong tin nhắn',
	'ACL_U_PM_IMG'			=> 'Sử dụng thẻ [img] trong tin nhắn',
	'ACL_U_PM_FLASH'		=> 'Sử dụng thẻ [flash] trong tin nhắn',

	'ACL_U_SENDEMAIL'	=> 'Gửi email',
	'ACL_U_SENDIM'		=> 'Gửi tin nhanh',
	'ACL_U_IGNOREFLOOD'	=> 'Không giới hạn thời gian tương tác',
	'ACL_U_HIDEONLINE'	=> 'Ẩn trạng thái trực tuyến',
	'ACL_U_VIEWONLINE'	=> 'Xem thành viên ẩn',
	'ACL_U_SEARCH'		=> 'Tìm kiếm',
));

// Forum Permissions
$lang = array_merge($lang, array(
	'ACL_F_LIST'		=> 'Nhìn thấy chuyên mục',
	'ACL_F_LIST_TOPICS' => 'Nhìn thấy chủ đề',
	'ACL_F_READ'		=> 'Xem chuyên mục',
	'ACL_F_SEARCH'		=> 'Tìm kiếm trong chuyên mục',
	'ACL_F_SUBSCRIBE'	=> 'Theo dõi chuyên mục',
	'ACL_F_PRINT'		=> 'In chủ đề',
	'ACL_F_EMAIL'		=> 'Gửi email chủ đề',
	'ACL_F_BUMP'		=> 'Đẩy chủ đề lên',
	'ACL_F_USER_LOCK'	=> 'Khóa chủ đề của mình',
	'ACL_F_DOWNLOAD'	=> 'Tải về tập tin',
	'ACL_F_REPORT'		=> 'Báo cáo bài viết',

	'ACL_F_POST'			=> 'Tạo chủ đề mới',
	'ACL_F_STICKY'			=> 'Tạo chú ý',
	'ACL_F_ANNOUNCE'		=> 'Tạo thông báo',
	'ACL_F_ANNOUNCE_GLOBAL'	=> 'Tạo thông báo chung',
	'ACL_F_REPLY'			=> 'Trả lời chủ đề',
	'ACL_F_EDIT'			=> 'Sửa bài viết của mình',
	'ACL_F_DELETE'			=> 'Xóa vĩnh viễn bài viết của mình',
	'ACL_F_SOFTDELETE'		=> 'Xóa nháp bài viết của mình<br /><em>Điều hành viên được cấp phép có thể phục hồi lại bài viết đã bị xóa nháp.</em>',
	'ACL_F_IGNOREFLOOD'		=> 'Không giới hạn thời gian gửi bài',
	'ACL_F_POSTCOUNT'		=> 'Cộng vào số bài viết<br /><em>Thiết lập này chỉ có tác dụng với những bài viết mới sau này.</em>',
	'ACL_F_NOAPPROVE'		=> 'Gửi bài không cần kiểm duyệt',

	'ACL_F_ATTACH'		=> 'Đính kèm tập tin',
	'ACL_F_ICONS'		=> 'Sử dụng biểu tượng bài viết',
	'ACL_F_BBCODE'		=> 'Sử dụng thẻ BBCode',
	'ACL_F_FLASH'		=> 'Sử dụng thẻ [flash]',
	'ACL_F_IMG'			=> 'Sử dụng thẻ [img]',
	'ACL_F_SIGS'		=> 'Sử dụng chữ ký cá nhân',
	'ACL_F_SMILIES'		=> 'Sử dụng biểu tượng vui',

	'ACL_F_POLL'		=> 'Tạo bình chọn',
	'ACL_F_VOTE'		=> 'Tham gia bình chọn',
	'ACL_F_VOTECHG'		=> 'Thay đổi bình chọn đang hiệu lực',
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'ACL_M_EDIT'		=> 'Sửa bài viết',
	'ACL_M_DELETE'		=> 'Xóa vĩnh viễn bài viết',
	'ACL_M_SOFTDELETE'	=> 'Xóa nháp bài viết<br /><em>Điều hành viên được cấp phép có thể phục hồi lại bài viết đã bị xóa nháp.</em>',
	'ACL_M_APPROVE'		=> 'Kiểm duyệt và phục hồi bài biết',
	'ACL_M_REPORT'		=> 'Đóng và xóa báo cáo',
	'ACL_M_CHGPOSTER'	=> 'Đổi người gửi bài',

	'ACL_M_MOVE'	=> 'Di chuyển chủ đề',
	'ACL_M_LOCK'	=> 'Khóa chủ đề',
	'ACL_M_SPLIT'	=> 'Chia nhỏ chủ đề',
	'ACL_M_MERGE'	=> 'Nhập chung chủ đề',

	'ACL_M_INFO'		=> 'Xem thông tin bài viết',
	'ACL_M_WARN'		=> 'Đưa ra cảnh cáo<br /><em>Thiết lập này không thể gán riêng cho từng chuyên mục.</em>', // This moderator setting is only global (and not local)
	'ACL_M_BAN'			=> 'Quản lí lệnh cấm<br /><em>Thiết lập này không thể gán riêng cho từng chuyên mục.</em>', // This moderator setting is only global (and not local)
	'ACL_M_PM_REPORT'	=> 'Đóng và xóa báo cáo tin nhắn<br /><em>Thiết lập này không thể gán riêng cho từng chuyên mục.</em>', // This moderator setting is only global (and not local)
));

// Admin Permissions
$lang = array_merge($lang, array(
	'ACL_A_BOARD'		=> 'Thiết lập hệ thống, kiểm tra cập nhật',
	'ACL_A_SERVER'		=> 'Thiết lập máy chủ',
	'ACL_A_JABBER'		=> 'Thiết lập Jabber',
	'ACL_A_PHPINFO'		=> 'Xem thông tin PHP',

	'ACL_A_FORUM'		=> 'Quản lí chuyên mục',
	'ACL_A_FORUMADD'	=> 'Tạo chuyên mục mới',
	'ACL_A_FORUMDEL'	=> 'Xóa chuyên mục',
	'ACL_A_PRUNE'		=> 'Dọn dẹp chuyên mục',

	'ACL_A_ICONS'		=> 'Quản lí biểu tượng bài viết, biểu tượng vui',
	'ACL_A_WORDS'		=> 'Quản lí từ kiểm duyệt',
	'ACL_A_BBCODE'		=> 'Quản lí thẻ BBCode',
	'ACL_A_ATTACH'		=> 'Thiết lập tập tin đính kèm',

	'ACL_A_USER'		=> 'Quản lí người dùng<br /><em>Thiết lập này bao gồm tùy chọn xem tên định danh trình duyệt của người dùng.</em>',
	'ACL_A_USERDEL'		=> 'Xóa, dọn dẹp tài khoản',
	'ACL_A_GROUP'		=> 'Quản lí nhóm',
	'ACL_A_GROUPADD'	=> 'Tạo nhóm mới',
	'ACL_A_GROUPDEL'	=> 'Xóa nhóm',
	'ACL_A_RANKS'		=> 'Quản lí danh hiệu',
	'ACL_A_PROFILE'		=> 'Quản lí thông tin cá nhân tùy biến',
	'ACL_A_NAMES'		=> 'Quản lí tên tài khoản cấm sử dụng',
	'ACL_A_BAN'			=> 'Cấm tài khoản người dùng',

	'ACL_A_VIEWAUTH'	=> 'Xem thiết lập cấp phép',
	'ACL_A_AUTHGROUPS'	=> 'Cấp phép cho nhóm',
	'ACL_A_AUTHUSERS'	=> 'Cấp phép cho người dùng',
	'ACL_A_FAUTH'		=> 'Cấp phép cho chuyên mục',
	'ACL_A_MAUTH'		=> 'Cấp phép chức năng điều hành viên',
	'ACL_A_AAUTH'		=> 'Cấp phép chức năng quản trị viên',
	'ACL_A_UAUTH'		=> 'Cấp phép chức năng người dùng',
	'ACL_A_ROLES'		=> 'Quản lí nhiệm vụ cấp phép',
	'ACL_A_SWITCHPERM'	=> 'Sử dụng cấp phép từ người dùng khác',

	'ACL_A_STYLES'		=> 'Quản lí giao diện',
	'ACL_A_EXTENSIONS'	=> 'Quản lí phần mở rộng',
	'ACL_A_VIEWLOGS'	=> 'Xem ghi nhận',
	'ACL_A_CLEARLOGS'	=> 'Xóa ghi nhận',
	'ACL_A_MODULES'		=> 'Quản lí gói chức năng',
	'ACL_A_LANGUAGE'	=> 'Quản lí ngôn ngữ',
	'ACL_A_EMAIL'		=> 'Gửi email thông báo người dùng',
	'ACL_A_BOTS'		=> 'Quản lí máy tìm kiếm',
	'ACL_A_REASONS'		=> 'Quản lí báo cáo, lý do từ chối',
	'ACL_A_BACKUP'		=> 'Sao lưu, phục hồi cơ sở dữ liệu',
	'ACL_A_SEARCH'		=> 'Thiết lập tìm kiếm',
));
