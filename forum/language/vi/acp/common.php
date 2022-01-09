<?php
/** 
*
* acp/common [Vietnamese]
*
* @package language
* @version 1.120
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

// Common
$lang = array_merge($lang, array(
	'ACP_ADMINISTRATORS'		=> 'Cấp phép quản trị viên',
	'ACP_ADMIN_LOGS'			=> 'Ghi nhận quản trị viên',
	'ACP_ADMIN_ROLES'			=> 'Nhiệm vụ quản trị viên',
	'ACP_ATTACHMENTS'			=> 'Tập tin đính kèm',
	'ACP_ATTACHMENT_SETTINGS'	=> 'Thiết lập tập tin đính kèm',
	'ACP_AUTH_SETTINGS'			=> 'Thiết lập xác thực',
	'ACP_AUTOMATION'			=> 'Tự động hoá',
	'ACP_AVATAR_SETTINGS'		=> 'Thiết lập hình đại diện',

	'ACP_BACKUP'				=> 'Sao lưu',
	'ACP_BAN'					=> 'Danh sách cấm',
	'ACP_BAN_EMAILS'			=> 'Cấm địa chỉ email',
	'ACP_BAN_IPS'				=> 'Cấm địa chỉ IP',
	'ACP_BAN_USERNAMES'			=> 'Cấm người dùng',
	'ACP_BBCODES'				=> 'Tùy biến thẻ BBCode',
	'ACP_BOARD_CONFIGURATION'	=> 'Cấu hình hệ thống',
	'ACP_BOARD_FEATURES'		=> 'Thiết lập chức năng hệ thống',
	'ACP_BOARD_MANAGEMENT'		=> 'Quản lí hệ thống',
	'ACP_BOARD_SETTINGS'		=> 'Thiết lập hệ thống',
	'ACP_BOTS'					=> 'Quản lí máy tìm kiếm',

	'ACP_CAPTCHA'				=> 'Kiểm tra nhập liệu tự động',

	'ACP_CAT_CUSTOMISE'			=> 'Tùy biến',
	'ACP_CAT_DATABASE'			=> 'Cơ sở dữ liệu',
	'ACP_CAT_DOT_MODS'			=> 'Phần mở rộng',
	'ACP_CAT_FORUMS'			=> 'Chuyên mục',
	'ACP_CAT_GENERAL'			=> 'Tổng quát',
	'ACP_CAT_MAINTENANCE'		=> 'Bảo trì',
	'ACP_CAT_PERMISSIONS'		=> 'Cấp phép',
	'ACP_CAT_POSTING'			=> 'Gửi bài',
	'ACP_CAT_STYLES'			=> 'Giao diện',
	'ACP_CAT_SYSTEM'			=> 'Hệ thống',
	'ACP_CAT_USERGROUP'			=> 'Người dùng &amp; nhóm',
	'ACP_CAT_USERS'				=> 'Người dùng',
	'ACP_CLIENT_COMMUNICATION'	=> 'Ứng dụng truyền thông',
	'ACP_COOKIE_SETTINGS'		=> 'Thiết lập cookie',
	'ACP_CONTACT'				=> 'Trang liên hệ',
	'ACP_CONTACT_SETTINGS'		=> 'Thiết lập trang liên hệ',
	'ACP_CRITICAL_LOGS'			=> 'Ghi nhận lỗi',
	'ACP_CUSTOM_PROFILE_FIELDS'	=> 'Tùy biến mục thông tin cá nhân',

	'ACP_DATABASE'				=> 'Quản lí cơ sở dữ liệu',
	'ACP_DISALLOW'				=> 'Cấm sử dụng',
	'ACP_DISALLOW_USERNAMES'	=> 'Tên tài khoản cấm sử dụng',

	'ACP_EMAIL_SETTINGS'		=> 'Thiết lập email',
	'ACP_EXTENSION_GROUPS'		=> 'Quản lí nhóm tập tin đính kèm',
	'ACP_EXTENSION_MANAGEMENT'	=> 'Quản lí phần mở rộng tập tin',
	'ACP_EXTENSIONS'			=> 'Quản lí phần mở rộng',

	'ACP_FORUM_BASED_PERMISSIONS'	=> 'Cấp phép cho chuyên mục',
	'ACP_FORUM_LOGS'				=> 'Ghi nhận chuyên mục',
	'ACP_FORUM_MANAGEMENT'			=> 'Quản lí chuyên mục',
	'ACP_FORUM_MODERATORS'			=> 'Cấp phép điều hành viên cho chuyên mục',
	'ACP_FORUM_PERMISSIONS'			=> 'Cấp phép chuyên mục',
	'ACP_FORUM_PERMISSIONS_COPY'	=> 'Sao chép cấp phép chuyên mục',
	'ACP_FORUM_ROLES'				=> 'Nhiệm vụ chuyên mục',

	'ACP_GENERAL_CONFIGURATION'		=> 'Cấu hình tổng quát',
	'ACP_GENERAL_TASKS'				=> 'Thao tác tổng quát',
	'ACP_GLOBAL_MODERATORS'			=> 'Cấp phép điều hành viên chính',
	'ACP_GLOBAL_PERMISSIONS'		=> 'Cấp phép chung',	
	'ACP_GROUPS'					=> 'Nhóm',
	'ACP_GROUPS_FORUM_PERMISSIONS'	=> 'Cấp phép chuyên mục cho nhóm',
	'ACP_GROUPS_MANAGE'				=> 'Quản lí nhóm',
	'ACP_GROUPS_MANAGEMENT'			=> 'Quản lí nhóm',
	'ACP_GROUPS_PERMISSIONS'		=> 'Cấp phép nhóm',
	'ACP_GROUPS_POSITION'			=> 'Quản lí vị trí nhóm',

	'ACP_HELP_PHPBB'	=> 'Giúp đỡ phpBB',

	'ACP_ICONS'				=> 'Biểu tượng bài viết',
	'ACP_ICONS_SMILIES'		=> 'Biểu tượng bài viết/biểu tượng vui',
	'ACP_INACTIVE_USERS'	=> 'Tài khoản chưa kích hoạt',
	'ACP_INDEX'				=> 'Bảng quản trị',

	'ACP_JABBER_SETTINGS'	=> 'Thiết lập Jabber',

	'ACP_LANGUAGE'			=> 'Quản lí ngôn ngữ',
	'ACP_LANGUAGE_PACKS'	=> 'Ngôn ngữ',
	'ACP_LOAD_SETTINGS'		=> 'Thiết lập nạp trang',
	'ACP_LOGGING'			=> 'Ghi nhận',

	'ACP_MAIN'							=> 'Bảng quản trị',
	'ACP_MANAGE_ATTACHMENTS'			=> 'Quản lí tập tin đính kèm',
	'ACP_MANAGE_ATTACHMENTS_EXPLAIN'	=> 'Với công cụ này, bạn có thể xem danh sách và chọn xóa các tập tin đính kèm theo bài viết hay tin nhắn.',
	'ACP_MANAGE_EXTENSIONS'				=> 'Quản lí loại tập tin đính kèm',
	'ACP_MANAGE_FORUMS'					=> 'Quản lí chuyên mục',
	'ACP_MANAGE_RANKS'					=> 'Quản lí danh hiệu',
	'ACP_MANAGE_REASONS'				=> 'Quản lí báo cáo/lý do từ chối',
	'ACP_MANAGE_USERS'					=> 'Quản lí người dùng',
	'ACP_MASS_EMAIL'					=> 'Gửi email người dùng',
	'ACP_MESSAGES'						=> 'Bài viết',
	'ACP_MESSAGE_SETTINGS'				=> 'Thiết lập tin nhắn',
	'ACP_MODULE_MANAGEMENT'				=> 'Quản lí gói chức năng',
	'ACP_MOD_LOGS'						=> 'Ghi nhận điều hành viên',
	'ACP_MOD_ROLES'						=> 'Nhiệm vụ điều hành viên',

	'ACP_NO_ITEMS'	=> 'Chưa có mục nào.',

	'ACP_ORPHAN_ATTACHMENTS'	=> 'Tập tin đính kèm không sử dụng',

	'ACP_PERMISSIONS'		=> 'Cấp phép',
	'ACP_PERMISSION_MASKS'	=> 'Danh sách cấp phép',
	'ACP_PERMISSION_ROLES'	=> 'Cấp phép nhiệm vụ',
	'ACP_PERMISSION_TRACE'	=> 'Dò theo cấp phép',
	'ACP_PHP_INFO'			=> 'Thông tin PHP',
	'ACP_POST_SETTINGS'		=> 'Thiết lập gửi bài',
	'ACP_PRUNE_FORUMS'		=> 'Dọn dẹp chuyên mục',
	'ACP_PRUNE_USERS'		=> 'Dọn dẹp tài khoản',
	'ACP_PRUNING'			=> 'Dọn dẹp',

	'ACP_QUICK_ACCESS'	=> 'Truy cập nhanh',

	'ACP_RANKS'				=> 'Danh hiệu',
	'ACP_REASONS'			=> 'Báo cáo/lý do từ chối',
	'ACP_REGISTER_SETTINGS'	=> 'Thiết lập đăng ký tài khoản',

	'ACP_RESTORE'	=> 'Phục hồi',

	'ACP_FEED'			=> 'Quản lí tin nhanh',
	'ACP_FEED_SETTINGS'	=> 'Thiết lập tin nhanh',

	'ACP_SEARCH'				=> 'Cấu hình tìm kiếm',
	'ACP_SEARCH_INDEX'			=> 'Chỉ mục tìm kiếm',
	'ACP_SEARCH_SETTINGS'		=> 'Thiết lập tìm kiếm',

	'ACP_SECURITY_SETTINGS'		=> 'Thiết lập bảo mật',
	'ACP_SERVER_CONFIGURATION'	=> 'Cấu hình máy chủ',
	'ACP_SERVER_SETTINGS'		=> 'Thiết lập máy chủ',
	'ACP_SIGNATURE_SETTINGS'	=> 'Thiết lập chữ ký cá nhân',
	'ACP_SMILIES'				=> 'Biểu tượng vui',
	'ACP_STYLE_MANAGEMENT'		=> 'Quản lí giao diện',
	'ACP_STYLES'				=> 'Giao diện',
	'ACP_STYLES_CACHE'			=> 'Xóa bộ đệm',
	'ACP_STYLES_INSTALL'		=> 'Cài đặt giao diện',

	'ACP_SUBMIT_CHANGES'	=> 'Lưu thay đổi',

	'ACP_TEMPLATES'	=> 'Khuôn mẫu',
	'ACP_THEMES'	=> 'Kiểu dáng',

	'ACP_UPDATE'					=> 'Cập nhật',
	'ACP_USERS_FORUM_PERMISSIONS'	=> 'Cấp phép chuyên mục cho người dùng',
	'ACP_USERS_LOGS'				=> 'Ghi nhận người dùng',
	'ACP_USERS_PERMISSIONS'			=> 'Cấp phép người dùng',
	'ACP_USER_ATTACH'				=> 'Tập tin đính kèm',
	'ACP_USER_AVATAR'				=> 'Hình đại diện',
	'ACP_USER_FEEDBACK'				=> 'Phản hồi',
	'ACP_USER_GROUPS'				=> 'Nhóm',
	'ACP_USER_MANAGEMENT'			=> 'Quản lí người dùng',
	'ACP_USER_OVERVIEW'				=> 'Tổng quan',
	'ACP_USER_PERM'					=> 'Cấp phép người dùng',
	'ACP_USER_PREFS'				=> 'Thiết lập cá nhân',
	'ACP_USER_PROFILE'				=> 'Thông tin cá nhân',
	'ACP_USER_RANK'					=> 'Danh hiệu',
	'ACP_USER_ROLES'				=> 'Nhiệm vụ người dùng',
	'ACP_USER_SECURITY'				=> 'Bảo mật tài khoản',
	'ACP_USER_SIG'					=> 'Chữ ký cá nhân',
	'ACP_USER_WARNINGS'				=> 'Cảnh cáo',

	'ACP_VC_SETTINGS'					=> 'Thiết lập mã xác nhận',
	'ACP_VC_CAPTCHA_DISPLAY'			=> 'Xem trước mã xác nhận',	
	'ACP_VERSION_CHECK'					=> 'Kiểm tra cập nhật',
	'ACP_VIEW_ADMIN_PERMISSIONS'		=> 'Xem cấp phép quản trị viên',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS'	=> 'Xem cấp phép chuyên mục cho điều hành viên',
	'ACP_VIEW_FORUM_PERMISSIONS'		=> 'Xem cấp phép chuyên mục',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS'	=> 'Xem cấp phép điều hành viên chính',
	'ACP_VIEW_USER_PERMISSIONS'			=> 'Xem cấp phép người dùng',

	'ACP_WORDS'	=> 'Kiểm duyệt từ',

	'ACTION'		=> 'Thao tác',
	'ACTIONS'		=> 'Các thao tác',
	'ACTIVATE'		=> 'Kích hoạt',
	'ADD'			=> 'Thêm',
	'ADMIN'			=> 'Quản trị viên',
	'ADMIN_INDEX'	=> 'Trang quản trị',
	'ADMIN_PANEL'	=> 'Bảng quản trị',

	'ADM_LOGOUT'		=> 'Thoát quản trị',
	'ADM_LOGGED_OUT'	=> 'Bạn đã thoát khỏi bảng quản trị thành công.',

	'BACK'	=> 'Quay lại',

	'CANNOT_CHANGE_FILE_GROUP'			=> 'Không thể đổi nhóm quản lý tập tin',
	'CANNOT_CHANGE_FILE_PERMISSIONS'	=> 'Không thể đổi cấp phép tập tin',
	'CANNOT_COPY_FILES'					=> 'Không thể sao chép tập tin',
	'CANNOT_CREATE_SYMLINK'				=> 'Không thể tạo liên kết tắt',
	'CANNOT_DELETE_FILES'				=> 'Không thể xóa tập tin',
	'CANNOT_DUMP_FILE'					=> 'Không thể ghi tập tin',
	'CANNOT_MIRROR_DIRECTORY'			=> 'Không thể sao chép thư mục',
	'CANNOT_RENAME_FILE'				=> 'Không thể đổi tên tập tin',
	'CANNOT_TOUCH_FILES'				=> 'Không thể kiểm tra tập tin tồn tại',
	'CONTAINER_EXCEPTION' 				=> 'Hệ thống phpBB đã gặp lỗi vì một phần mở rộng đã cài đặt. Tất cả phần mở rộng sẽ tạm thời bị vô hiệu. Hãy thử xóa hết dữ liệu tạm. Tất cả phần mở rộng sẽ được tự động khôi phục một khi lỗi này không còn. Ghé thăm <a href="https://www.phpbb.com/support">phpBB.com</a> để được hỗ trợ nếu bạn không thể giải quyết rắc rối này.',
	'COLOUR_SWATCH'						=> 'Bảng mã màu',
	'CONFIG_UPDATED'					=> 'Cấu hình hệ thống đã được cập nhật thành công.',
	'CRON_LOCK_ERROR'					=> 'Không thể tiến hành khóa thao tác hẹn giờ.',
	'CRON_NO_SUCH_TASK'					=> 'Không tìm thấy thao tác “%s”.',
	'CRON_NO_TASK'						=> 'Không có thao tác hẹn giờ nào cần chạy lúc này.',
	'CRON_NO_TASKS'						=> 'Không có thao tác hẹn giờ nào.',
	'CURRENT_VERSION'					=> 'Phiên bản hiện tại',

	'DEACTIVATE'				=> 'Ngưng kích hoạt',
	'DIRECTORY_DOES_NOT_EXIST'	=> 'Đường dẫn bạn nhập “%s” không tồn tại.',
	'DIRECTORY_NOT_DIR'			=> 'Đường dẫn bạn nhập “%s” không phải là một thư mục.',
	'DIRECTORY_NOT_WRITABLE'	=> 'Đường dẫn bạn nhập “%s” không thể ghi.',
	'DISABLE'					=> 'Vô hiệu',
	'DOWNLOAD'					=> 'Tải về',
	'DOWNLOAD_AS'				=> 'Tải về dưới dạng',
	'DOWNLOAD_STORE'			=> 'Tải về hoặc lưu trữ tập tin',
	'DOWNLOAD_STORE_EXPLAIN'	=> 'Bạn có thể tải về trực tiếp tập tin hoặc lưu trữ lại trong thư mục <samp>store/</samp> của hệ thống.',
	'DOWNLOADS'          		=> 'Lượt tải về',

	'EDIT'				=> 'Sửa',
	'ENABLE'			=> 'Bật',
	'EXCEPTION'			=> 'Ngoại lệ',
	'EXPORT_DOWNLOAD'	=> 'Tải về',
	'EXPORT_STORE'		=> 'Lưu trữ',

	'GENERAL_OPTIONS'	=> 'Tùy chọn tổng quát',
	'GENERAL_SETTINGS'	=> 'Thiết lập tổng quát',
	'GLOBAL_MASK'		=> 'Danh sách cấp phép chung',

	'INSTALL'		=> 'Cài đặt',
	'IP'			=> 'Địa chỉ IP',
	'IP_HOSTNAME'	=> 'Địa chỉ IP hoặc tên miền',

	'LATEST_VERSION'				=> 'Phiên bản mới nhất',
	'LOAD_NOTIFICATIONS'			=> 'Hiện thông báo hệ thống',
	'LOAD_NOTIFICATIONS_EXPLAIN'	=> 'Hiển thị thông báo từ hệ thống đến người dùng tại đầu mỗi trang.',
	'LOGGED_IN_AS'					=> 'Bạn đã đăng nhập dưới tên:',
	'LOGIN_ADMIN'					=> 'Bạn phải được cấp phép trong hệ thống để truy cập vào bảng quản trị.',
	'LOGIN_ADMIN_CONFIRM'			=> 'Để chuyển đến bảng quản trị, bạn cần phải xác thực lại tài khoản của mình trong hệ thống.',
	'LOGIN_ADMIN_SUCCESS'			=> 'Bạn đã xác thực thành công với hệ thống và sẽ được chuyển đến bảng quản trị ngay bây giờ.',
	'LOOK_UP_FORUM'					=> 'Chọn một chuyên mục',
	'LOOK_UP_FORUMS_EXPLAIN'		=> 'Bạn có thể chọn nhiều hơn một chuyên mục.',

	'MANAGE'			=> 'Quản lí',
	'MENU_TOGGLE'		=> 'Ẩn/Hiện trình đơn',
	'MORE'				=> 'Chi tiết', // Hiện tại chưa sử dụng
	'MORE_INFORMATION'	=> 'Chi tiết »',
	'MOVE_DOWN'			=> 'Chuyển xuống',
	'MOVE_UP'			=> 'Chuyển lên',

	'NOTIFY'				=> 'Thông báo',
	'NO_ADMIN'				=> 'Bạn không được cấp phép để quản lí hệ thống.',
	'NO_EMAILS_DEFINED'		=> 'Không có địa chỉ email hợp lệ nào được tìm thấy.',
	'NO_FILES_TO_DELETE'	=> 'Tập tin đính kèm bạn chọn xóa không tồn tại.',
	'NO_PASSWORD_SUPPLIED'	=> 'Bạn cần phải nhập mật khẩu của mình để truy cập vào bảng quản trị.',

	'OFF'	=> 'Tắt',
	'ON'	=> 'Bật',

	'PARSE_BBCODE'						=> 'Sử dụng BBCode',
	'PARSE_SMILIES'						=> 'Sử dụng biểu tượng vui',
	'PARSE_URLS'						=> 'Nhận dạng liên kết',
	'PERMISSIONS_TRANSFERRED'			=> 'Thiết lập cấp phép đã được chuyển',
	'PERMISSIONS_TRANSFERRED_EXPLAIN'	=> 'Bạn hiện đang có những thiết lập cấp phép từ “%1$s”. Bạn có thể truy cập vào hệ thống với thiết lập cấp phép người dùng này nhưng không thể truy cập được vào bảng quản trị bởi vì những thiết lập cấp phép dành cho người quản trị không được chuyển đến bạn. Bạn cũng có thể <a href="%2$s"><strong>phục hồi lại thiết lập cấp phép của mình</strong></a> bất cứ lúc nào bạn muốn.',
	'PROCEED_TO_ACP'					=> '%sChuyển đến bảng quản trị%s',

	'RELEASE_ANNOUNCEMENT'	=> 'Thông báo phát hành',
	'REMIND'				=> 'Nhắc nhở',
	'REPARSE_LOCK_ERROR'	=> 'Thao tác xử lý lại nội dung đã được chạy trên một tiến trình khác.',
	'RESYNC'				=> 'Đồng bộ hóa',
	'RUNNING_TASK'			=> 'Đang chạy thao tác: %s.',

	'SELECT_ANONYMOUS'	=> 'Chọn tài khoản khách',
	'SELECT_OPTION'		=> 'Chọn các mục tùy chọn',

	'SETTING_TOO_LOW'		=> 'Giá trị bạn nhập cho thiết lập “%1$s” quá thấp. Giá trị tối thiểu cho phép là <strong>%2$d</strong>.',
	'SETTING_TOO_BIG'		=> 'Giá trị bạn nhập cho thiết lập “%1$s” quá lớn. Giá trị tối đa cho phép là <strong>%2$d</strong>.',
	'SETTING_TOO_LONG'		=> 'Giá trị bạn nhập cho thiết lập “%1$s” quá dài. Độ dài tối đa cho phép là <strong>%2$d</strong>.',
	'SETTING_TOO_SHORT'		=> 'Giá trị bạn nhập cho thiết lập “%1$s” quá ngắn. Độ dài tối thiểu cho phép là <strong>%2$d</strong>.',

	'SHOW_ALL_OPERATIONS'	=> 'Hiện tất cả thao tác',

	'TASKS_NOT_READY'	=> 'Thao tác chưa sẵn sàng:',
	'TASKS_READY'		=> 'Thao tác sẵn sàng:',
	'TOTAL_SIZE'		=> 'Tổng dung lượng',

	'UCP'					=> 'Bảng thiết lập cá nhân',
	'USERNAMES_EXPLAIN'		=> 'Nhập vào mỗi tên tài khoản trên một hàng riêng.',
	'USER_CONTROL_PANEL'	=> 'Bảng thiết lập cá nhân',
	'UPDATE_NEEDED'			=> 'Phiên bản phpBB chưa cập nhật.',
	'UPDATE_NOT_NEEDED'		=> 'Không có phiên bản mới.',
	'UPDATES_AVAILABLE'		=> 'Phiên bản mới:',

	'WARNING'				=> 'Cảnh báo',
));

// PHP info
$lang = array_merge($lang, array(
	'ACP_PHP_INFO_EXPLAIN'	=> 'Trang này liệt kê các thông tin về phiên bản PHP hiện tại được cài đặt trên máy chủ của bạn. Trang này cũng đính kèm thông tin chi tiết về các gói chức năng đã được cài đặt và nạp cùng với PHP, những biến PHP sẵn có và những thiết lập PHP mặc định. Thông tin này có thể hữu ích cho bạn nếu bạn đang giải quyết những rắc rối mà mình gặp phải với hệ thống. Cần lưu ý rằng có một vài công ty cung cấp dịch vụ lưu trữ Web sẽ hạn chế những thông tin về PHP được hiển thị trong đây vì lý do bảo mật. Một lời khuyên dành cho bạn là đừng bao giờ cung cấp cho người khác biết những thông tin trên trang này ngoại trừ khi bạn đang yêu cầu hỗ trợ từ các thành viên trong  <a href="https://www.phpbb.com/about/team/">nhóm hỗ trợ chính thức</a> của diễn đàn phpBB.',

	'NO_PHPINFO_AVAILABLE'	=> 'Thông tin cấu hình PHP trên máy chủ của bạn không thể thu thập được. Hàm <code>phpinfo()</code> đã bị vô hiệu vì lý do bảo mật.',
));

// Logs
$lang = array_merge($lang, array(
	'ACP_ADMIN_LOGS_EXPLAIN'	=> 'Danh sách này liệt kê tất cả những thao tác được thực hiện bởi các quản trị viên. Bạn có thể sắp xếp theo tên tài khoản, ngày tháng, địa chỉ IP hay thao tác. Nếu bạn được cấp phép, bạn có thể xóa từng bản ghi nhận thao tác cá nhân hay toàn bộ ghi nhận trong đây.',
	'ACP_CRITICAL_LOGS_EXPLAIN'	=> 'Danh sách này liệt kê tất cả những thao tác được thực hiện bởi chính hệ thống. Việc ghi nhận này sẽ cung cấp cho bạn thông tin nếu như bạn đang giải quyết các rắc rối gặp phải với hệ thống, ví dụ như việc gửi email từ hệ thống. Bạn có thể sắp xếp theo tên tài khoản, ngày tháng, địa chỉ IP hay thao tác. Nếu bạn được cấp phép, bạn có thể xóa từng bản ghi nhận thao tác cá nhân hay toàn bộ ghi nhận trong đây.',
	'ACP_MOD_LOGS_EXPLAIN'		=> 'Danh sách này liệt kê tất cả những thao tác được thực hiện trong chuyên mục, chủ đề và bài viết đối với người dùng bởi các điều hành viên, bao gồm cả lệnh cấm. Bạn có thể sắp xếp theo tên tài khoản, ngày tháng, địa chỉ IP hay thao tác. Nếu bạn được cấp phép, bạn cũng có thể xóa từng bản ghi nhận thao tác cá nhân hay toàn bộ ghi nhận trong đây.',
	'ACP_USERS_LOGS_EXPLAIN'	=> 'Đây là danh sách ghi nhận các thao tác của những người dùng trong hệ thống (báo cáo, cảnh báo và ghi chú về người dùng).',
	'ALL_ENTRIES'				=> 'Tất cả các mục',

	'DISPLAY_LOG'	=> 'Hiển thị những mục ghi nhận cách đây',

	'NO_ENTRIES'	=> 'Không có mục ghi nhận nào trong khoảng thời gian này.',

	'SORT_IP'		=> 'Địa chỉ IP',
	'SORT_DATE'		=> 'Ngày tháng',
	'SORT_ACTION'	=> 'Thao tác ghi nhận',
));

// Index page
$lang = array_merge($lang, array(
	'ADMIN_INTRO'				=> 'Cám ơn bạn đã chọn sử dụng phpBB cho hệ thống của mình. Trang này sẽ cho bạn cái nhìn tổng quan về các giá trị thống kê khác nhau trong hệ thống. Các liên kết trong trình đơn bên trái sẽ cho phép bạn điều khiển và cấu hình toàn bộ hệ thống với kinh nghiệm quản lí của mình. Mỗi trang sẽ có hướng dẫn riêng cách sử dụng từng loại công cụ.',
	'ADMIN_LOG'					=> 'Những thao tác quản trị đã ghi nhận',
	'ADMIN_LOG_INDEX_EXPLAIN'	=> 'Đây là 5 thao tác mới nhất được thực hiện bởi các quản trị viên. Bạn có thể xem danh sách đầy đủ trong phần ghi nhận thao tác tại trình đơn tương ứng hoặc liên kết dưới đây.',
	'AVATAR_DIR_SIZE'			=> 'Dung lượng thư mục hình đại diện',

	'BOARD_STARTED'		=> 'Ngày bắt đầu hoạt động',
	'BOARD_VERSION'		=> 'Phiên bản hệ thống',

	'DATABASE_SERVER_INFO'	=> 'Máy chủ cơ sở dữ liệu',
	'DATABASE_SIZE'			=> 'Dung lượng cơ sở dữ liệu',

	// Enviroment configuration checks, mbstring related
	'ERROR_MBSTRING_FUNC_OVERLOAD'					=> 'Hàm chức năng quá tải đã được cấu hình sai',
	'ERROR_MBSTRING_FUNC_OVERLOAD_EXPLAIN'			=> 'Biến <var>mbstring.func_overload</var> phải được thiết lập là 0 hoặc 4. Bạn có thể kiểm tra giá trị hiện tại từ trang <samp>cấu hình PHP</samp>.',
	'ERROR_MBSTRING_ENCODING_TRANSLATION'			=> 'Mã hóa ký tự rõ ràng đã được cấu hình sai',
	'ERROR_MBSTRING_ENCODING_TRANSLATION_EXPLAIN'	=> 'Biến <var>mbstring.encoding_translation</var> phải được thiết lập là 0. Bạn có thể kiểm tra giá trị hiện tại từ trang <samp>cấu hình PHP</samp>.',
	'ERROR_MBSTRING_HTTP_INPUT'						=> 'Chuyển đổi ký tự nhập vào bằng HTTP đã được cấu hình sai',
	'ERROR_MBSTRING_HTTP_INPUT_EXPLAIN'				=> 'Biến <var>mbstring.http_input</var> phải được thiết lập là <samp>pass</samp>. Bạn có thể kiểm tra giá trị hiện tại từ trang <samp>cấu hình PHP</samp>.',
	'ERROR_MBSTRING_HTTP_OUTPUT'					=> 'Chuyển đổi ký tự xuất ra bằng HTTP đã được cấu hình sai',
	'ERROR_MBSTRING_HTTP_OUTPUT_EXPLAIN'			=> 'Biến <var>mbstring.http_output</var> phải được thiết lập là <samp>pass</samp>. Bạn có thể kiểm tra giá trị hiện tại từ trang <samp>cấu hình PHP</samp>.',

	'FILES_PER_DAY'		=> 'Số tập tin đính kèm/ngày',
	'FORUM_STATS'		=> 'Thống kê hệ thống',

	'GZIP_COMPRESSION'	=> 'Chế độ nén Gzip',

	'NO_SEARCH_INDEX'	=> 'Phương pháp tìm kiếm đang dùng chưa được lập chỉ mục.<br />Vui lòng tạo chỉ mục cho “%1$s” trong phần %2$schỉ mục tìm kiếm%3$s.',
	'NOT_AVAILABLE'		=> 'Không có sẵn',
	'NUMBER_FILES'		=> 'Số tập tin đính kèm',
	'NUMBER_POSTS'		=> 'Số bài viết',
	'NUMBER_TOPICS'		=> 'Số chủ đề',
	'NUMBER_USERS'		=> 'Số thành viên',
	'NUMBER_ORPHAN'		=> 'Số tập tin đính kèm không sử dụng',

	'PHP_VERSION'		=> 'Phiên bản PHP',
	'PHP_VERSION_OLD'	=> 'Phiên bản PHP trên máy chủ (%1$s) không còn được hỗ trợ bởi các phiên bản phpBB sau này. Phiên bản PHP tối thiểu yêu cầu là %2$s. %3$sChi tiết%4$s',

	'POSTS_PER_DAY'		=> 'Số bài viết/ngày',

	'PURGE_CACHE'			=> 'Dọn sạch bộ đệm',
	'PURGE_CACHE_CONFIRM'	=> 'Bạn có chắc chắn muốn dọn sạch bộ đệm?',
	'PURGE_CACHE_EXPLAIN'	=> 'Dọn sạch tất cả các thành phần có liên quan đến bộ đệm, bao gồm tất cả các tập tin khuôn mẫu và lệnh truy xuất SQL đã được tạo bộ đệm.',
	'PURGE_CACHE_SUCCESS'	=> 'Bộ đệm đã được dọn sạch thành công.',

	'PURGE_SESSIONS'			=> 'Dọn sạch phiên đăng nhập',
	'PURGE_SESSIONS_CONFIRM'	=> 'Bạn có chắc chắn muốn dọn sạch tất cả phiên đăng nhập? Mọi người dùng đều sẽ mất trạng thái đăng nhập vào hệ thống.',
	'PURGE_SESSIONS_EXPLAIN'	=> 'Dọn sạch tất cả phiên đăng nhập. Thao tác này sẽ xóa hết trạng thái đăng nhập của người dùng bằng cách dọn sạch bảng dữ liệu phiên đăng nhập.',
	'PURGE_SESSIONS_SUCCESS'	=> 'Phiên đăng nhập đã được dọn sạch thành công.',

	'RESET_DATE'					=> 'Tạo lại ngày hệ thống bắt đầu hoạt động mới',
	'RESET_DATE_CONFIRM'			=> 'Bạn có chắc chắn muốn tạo lại ngày hệ thống bắt đầu hoạt động mới?',
	'RESET_DATE_SUCCESS'			=> 'Ngày hệ thống bắt đầu hoạt động đã được tạo mới.',
	'RESET_ONLINE'					=> 'Tạo lại số lượng người dùng trực tuyến đông nhất',
	'RESET_ONLINE_CONFIRM'			=> 'Bạn có chắc chắn muốn tạo lại thông tin số lượng người dùng trực tuyến đông nhất?',
	'RESET_ONLINE_SUCCESS'			=> 'Thông tin người dùng trực tuyến đã được tạo mới',
	'RESYNC_POSTCOUNTS'				=> 'Đồng bộ hóa bộ đếm số bài viết',
	'RESYNC_POSTCOUNTS_EXPLAIN'		=> 'Chỉ những bài viết còn hiệu hữu trong diễn đàn mới được tính vào bộ đếm. Những bài viết đã được dọn dẹp sẽ không được tính.',
	'RESYNC_POSTCOUNTS_CONFIRM'		=> 'Bạn có chắc chắn muốn đồng bộ hóa lại bộ đếm số bài viết?',
	'RESYNC_POSTCOUNTS_SUCCESS'		=> 'Bộ đếm số bài viết đã được đồng bộ hóa.',
	'RESYNC_POST_MARKING'			=> 'Đồng bộ hóa những chủ đề đã đánh dấu',
	'RESYNC_POST_MARKING_CONFIRM'	=> 'Bạn có chắc chắn muốn đồng bộ hóa lại những chủ đề đã đánh dấu?',
	'RESYNC_POST_MARKING_EXPLAIN'	=> 'Đầu tiên là tất cả các chủ đề không được đánh dấu và sau đó đánh dấu chính xác những chủ đề không còn bất cứ bài viết nào được gửi trong suốt 6 tháng qua.',
	'RESYNC_POST_MARKING_SUCCESS'	=> 'Chủ đề đã đánh dấu đã được đồng bộ hóa.',
	'RESYNC_STATS'					=> 'Đồng bộ hóa thông tin thống kê',
	'RESYNC_STATS_CONFIRM'			=> 'Bạn có chắc chắn muốn đồng bộ hóa thông tin thống kê?',
	'RESYNC_STATS_EXPLAIN'			=> 'Đếm lại tổng số chủ đề, bài viết, tài khoản người dùng và tập tin đính kèm trong hệ thống.',
	'RESYNC_STATS_SUCCESS'			=> 'Thông tin thống kê đã được đồng bộ hóa',
	'RUN'							=> 'Chạy',

	'STATISTIC'					=> 'Thống kê',
	'STATISTIC_RESYNC_OPTIONS'	=> 'Đồng bộ hóa hoặc tạo mới lại thông tin thống kê',

	'TIMEZONE_INVALID'	=> 'Múi giờ bạn chọn không hợp lệ.',
	'TIMEZONE_SELECTED'	=> '(đang chọn)',
	'TOPICS_PER_DAY'	=> 'Số chủ đề/ngày',

	'UPLOAD_DIR_SIZE'	=> 'Tổng dung lượng tập tin đính kèm',
	'USERS_PER_DAY'		=> 'Số người dùng/ngày',

	'VALUE'							=> 'Giá trị',
	'VERSIONCHECK_FAIL'				=> 'Không thể nhận được thông tin phiên bản mới nhất.',
	'VERSIONCHECK_FORCE_UPDATE'		=> 'Kiểm tra lại phiên bản',
	'VERSION_CHECK'					=> 'Kiểm tra phiên bản',
	'VERSION_CHECK_EXPLAIN'			=> 'Kiểm tra phiên bản phpBB mới.',
	'VERSIONCHECK_INVALID_ENTRY'	=> 'Dữ liệu phiên bản mới chứa đối tượng không hỗ trợ.',
	'VERSIONCHECK_INVALID_URL'		=> 'Dữ liệu phiên bản mới chứa liên kết không hợp lệ.',
	'VERSIONCHECK_INVALID_VERSION'	=> 'Dữ liệu phiên bản mới chứa số phiên bản không hợp lệ.',
	'VERSION_NOT_UP_TO_DATE_ACP'	=> 'Bản cài đặt phpBB này đã cũ.<br />Bên dưới là thông báo phát hành của phiên bản mới nhất kèm hướng dẫn cho bạn cập nhật.',
	'VERSION_NOT_UP_TO_DATE_TITLE'	=> 'Bản cài đặt phpBB này đã cũ.',
	'VERSION_UP_TO_DATE_ACP'		=> 'Bản cài đặt phpBB này là mới nhất. Hiện tại không có cập nhật nào.',
	'VIEW_ADMIN_LOG'				=> 'Xem ghi nhận về quản trị viên',
	'VIEW_INACTIVE_USERS'			=> 'Xem các tài khoản chưa kích hoạt',

	'WELCOME_PHPBB'			=> 'phpBB xin chào bạn!',
	'WRITABLE_CONFIG'		=> 'Tập tin cấu hình của bạn (config.php) hiện tại đang được cấp phép có thể ghi với mọi người dùng. Chúng tôi khuyến cáo bạn phải thay đổi ngay cấp phép cho tập tin này thành <strong>640</strong> hoặc ít nhất là <strong>644</strong> (Ví dụ: <a href="http://en.wikipedia.org/wiki/Chmod" rel="external">CHMOD</a> 640 cho tập tin config.php).',
));

// Inactive Users
$lang = array_merge($lang, array(
	'INACTIVE_DATE'					=> 'Ngày chưa kích hoạt',
	'INACTIVE_REASON'				=> 'Lý do chưa kích hoạt',
	'INACTIVE_REASON_MANUAL'		=> 'Tài khoản đã bị ngưng kích hoạt bởi quản trị viên',
	'INACTIVE_REASON_PROFILE'		=> 'Đã thay đổi thông tin cá nhân',
	'INACTIVE_REASON_REGISTER'		=> 'Tài khoản mới đăng ký',
	'INACTIVE_REASON_REMIND'		=> 'Đã được yêu cầu kích hoạt lại tài khoản',
	'INACTIVE_REASON_UNKNOWN'		=> 'Không biết',
	'INACTIVE_USERS'				=> 'Tài khoản chưa kích hoạt',
	'INACTIVE_USERS_EXPLAIN'		=> 'Dưới đây là danh sách các tài khoản đã đăng ký nhưng chưa được kích hoạt. Bạn có thể kích hoạt, xóa tài khoản của họ hay nhắc nhở bằng email những người dùng này nếu bạn muốn.',
	'INACTIVE_USERS_EXPLAIN_INDEX'	=> 'Dưới đây là danh sách 10 tài khoản vừa mới đăng ký nhưng chưa kích hoạt. Tài khoản chưa kích hoạt vì việc kích hoạt được yêu cầu khi đăng ký nhưng những người dùng này chưa tiến hành kích hoạt, hoặc họ bị ngưng kích hoạt bởi một quản trị viên. Liên kết bên dưới sẽ cho bạn xem danh sách tất cả các tài khoản này và bạn có thể kích hoạt, xóa hay nhắc nhở kích hoạt (qua email) những người dùng này.',

	'NO_INACTIVE_USERS'	=> 'Không có tài khoản nào chưa kích hoạt',

	'SORT_INACTIVE'			=> 'Ngày ngưng kích hoạt',
	'SORT_LAST_VISIT'		=> 'Lần ghé thăm trước',
	'SORT_REASON'			=> 'Lý do',
	'SORT_REG_DATE'			=> 'Ngày đăng ký',
	'SORT_LAST_REMINDER'	=> 'Lần nhắc nhở cuối',
	'SORT_REMINDER'			=> 'Ngày gửi nhắc nhở',

	'USER_IS_INACTIVE'	=> 'Tài khoản chưa kích hoạt',
));

// Help support phpBB page
$lang = array_merge($lang, array(
	'EXPLAIN_SEND_STATISTICS'	=> 'Bạn hãy vui lòng gửi thông tin thống kê về máy chủ và cấu hình hệ thống phpBB của mình đến nhóm phát triển phpBB để chúng tôi thống kê việc sử dụng. Tất cả thông tin cá nhân về bạn hay website của bạn đều được <strong>loại bỏ</strong> và dữ liệu thống kê gửi đến được <strong>ẩn hoàn toàn</strong>. Chúng tôi sẽ dựa vào thông tin này để quyết định những thay đổi trong các phiên bản phpBB sắp tới. Kết quả thống kê được công bố rộng rãi cũng như chúng tôi có thể chia sẻ thông tin này với dự án PHP - ngôn ngữ lập trình dùng để viết phpBB.',
	'EXPLAIN_SHOW_STATISTICS'	=> 'Nhấp vào nút bên dưới, bạn có thể xem trước tất cả các biến thống kê sẽ được gửi đến chúng tôi.',
	'DONT_SEND_STATISTICS'		=> 'Quay về bảng quản trị nếu bạn không muốn gửi thông tin thống kê cho nhóm phát triển phpBB.',
	'GO_ACP_MAIN'				=> 'Chuyển đến trang chính bảng quản trị',
	'HIDE_STATISTICS'			=> 'Ẩn chi tiết',
	'SEND_STATISTICS'			=> 'Gửi thống kê',
	'SEND_STATISTICS_LONG'		=> 'Gửi dữ liệu thống kê',
	'SHOW_STATISTICS'			=> 'Hiện chi tiết',
	'THANKS_SEND_STATISTICS'	=> 'Cám ơn bạn đã gửi thông tin cho chúng tôi.',
	'FAIL_SEND_STATISTICS'		=> 'Có lỗi trong quá trình gửi dữ liệu.',
));

// Log Entries
$lang = array_merge($lang, array(
	'LOG_ACL_ADD_USER_GLOBAL_U_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa cấp phép của các tài khoản</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_U_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa cấp phép của các nhóm</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_M_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa cấp phép điều hành viên chính của các tài khoản</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_M_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa cấp phép điều hành viên chính của các nhóm</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_A_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa cấp phép quản trị viên của các tài khoản</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_A_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa cấp phép quản trị viên của các nhóm</strong><br />» %s',

	'LOG_ACL_ADD_ADMIN_GLOBAL_A_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa quản trị viên</strong><br />» %s',
	'LOG_ACL_ADD_MOD_GLOBAL_M_'			=> '<strong>Đã thêm vào hoặc chỉnh sửa điều hành viên chính</strong><br />» %s',

	'LOG_ACL_ADD_USER_LOCAL_F_'			=> '<strong>Đã thêm vào hoặc chỉnh sửa quyền truy cập chuyên mục của người dùng</strong> từ %1$s<br />» %2$s',
	'LOG_ACL_ADD_USER_LOCAL_M_'			=> '<strong>Đã thêm vào hoặc chỉnh sửa quyền truy cập và quản lí chuyên mục của người dùng</strong> từ %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_F_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa quyền truy cập chuyên mục của các nhóm</strong> từ %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_M_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa quyền truy cập và quản lí chuyên mục của các nhóm</strong> từ %1$s<br />» %2$s',

	'LOG_ACL_ADD_MOD_LOCAL_M_'			=> '<strong>Đã thêm vào hoặc chỉnh sửa điều hành viên</strong> từ %1$s<br />» %2$s',
	'LOG_ACL_ADD_FORUM_LOCAL_F_'		=> '<strong>Đã thêm vào hoặc chỉnh sửa cấp phép chuyên mục</strong> từ %1$s<br />» %2$s',

	'LOG_ACL_DEL_ADMIN_GLOBAL_A_'		=> '<strong>Đã gỡ bỏ quản trị viên</strong><br />» %s',
	'LOG_ACL_DEL_MOD_GLOBAL_M_'			=> '<strong>Đã gỡ bỏ điều hành viên chính</strong><br />» %s',
	'LOG_ACL_DEL_MOD_LOCAL_M_'			=> '<strong>Đã gỡ bỏ điều hành viên</strong> từ %1$s<br />» %2$s',
	'LOG_ACL_DEL_FORUM_LOCAL_F_'		=> '<strong>Đã gỡ bỏ cấp phép chuyên mục dành cho người dùng/nhóm</strong> từ %1$s<br />» %2$s',

	'LOG_ACL_TRANSFER_PERMISSIONS'		=> '<strong>Thiết lập cấp phép đã được chuyển từ</strong><br />» %s',
	'LOG_ACL_RESTORE_PERMISSIONS'		=> '<strong>Thiết lập cấp phép đã được khôi phục kể từ khi chuyển thiết lập cấp phép từ</strong><br />» %s',

	'LOG_ADMIN_AUTH_FAIL'		=> '<strong>Đăng nhập thất bại vào bảng quản trị</strong>',
	'LOG_ADMIN_AUTH_SUCCESS'	=> '<strong>Đăng nhập thành công vào bảng quản trị</strong>',

	'LOG_ATTACHMENTS_DELETED'	=> '<strong>Đã gỡ bỏ những tập tin đính kèm của tài khoản</strong><br />» %s',

	'LOG_ATTACH_EXT_ADD'		=> '<strong>Đã thêm vào hoặc chỉnh sửa loại tập tin đính kèm</strong><br />» %s',
	'LOG_ATTACH_EXT_DEL'		=> '<strong>Đã gỡ bỏ loại tập tin đính kèm</strong><br />» %s',
	'LOG_ATTACH_EXT_UPDATE'		=> '<strong>Đã cập nhật loại tập tin đính kèm</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_ADD'	=> '<strong>Đã thêm vào nhóm tập tin đính kèm</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_EDIT'	=> '<strong>Đã chỉnh sửa nhóm tập tin đính kèm</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_DEL'	=> '<strong>Đã gỡ bỏ nhóm tập tin đính kèm</strong><br />» %s',
	'LOG_ATTACH_FILEUPLOAD'		=> '<strong>Tập tin đính kèm không sử dụng đã được đính kèm vào bài viết</strong><br />» Số ID %1$d - %2$s',
	'LOG_ATTACH_ORPHAN_DEL'		=> '<strong>Những tập tin đính kèm không sử dụng đã được xóa</strong><br />» %s',

	'LOG_BAN_EXCLUDE_USER'	=> '<strong>Đã loại trừ tài khoản khỏi danh sách cấm</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_EXCLUDE_IP'	=> '<strong>Đã loại trừ địa chỉ IP khỏi danh sách cấm</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_EXCLUDE_EMAIL' => '<strong>Đã loại trừ địa chỉ email khỏi danh sách cấm</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_USER'			=> '<strong>Đã cấm tài khoản</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_IP'			=> '<strong>Đã cấm địa chỉ IP</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_EMAIL'			=> '<strong>Đã cấm địa chỉ email</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_UNBAN_USER'		=> '<strong>Đã ngưng cấm tài khoản</strong><br />» %s',
	'LOG_UNBAN_IP'			=> '<strong>Đã ngưng cấm địa chỉ IP</strong><br />» %s',
	'LOG_UNBAN_EMAIL'		=> '<strong>Đã ngưng cấm địa chỉ email</strong><br />» %s',

	'LOG_BBCODE_ADD'		=> '<strong>Đã thêm vào thẻ BBCode mới</strong><br />» %s',
	'LOG_BBCODE_EDIT'		=> '<strong>Đã chỉnh sửa thẻ BBCode</strong><br />» %s',
	'LOG_BBCODE_DELETE'		=> '<strong>Đã xóa thẻ BBCode</strong><br />» %s',

	'LOG_BOT_ADDED'		=> '<strong>Máy tìm kiếm mới đã được tạo</strong><br />» %s',
	'LOG_BOT_DELETE'	=> '<strong>Đã xóa Bot</strong><br />» %s',
	'LOG_BOT_UPDATED'	=> '<strong>Bot đã được cập nhật</strong><br />» %s',

	'LOG_CLEAR_ADMIN'		=> '<strong>Đã xóa ghi nhận của quản trị viên</strong>',
	'LOG_CLEAR_CRITICAL'	=> '<strong>Đã xóa ghi nhận lỗi</strong>',
	'LOG_CLEAR_MOD'			=> '<strong>Đã xóa ghi nhận của điều hành viên</strong>',
	'LOG_CLEAR_USER'		=> '<strong>Đã xóa ghi nhận của người dùng</strong><br />» %s',
	'LOG_CLEAR_USERS'		=> '<strong>Đã xóa những ghi nhận của người dùng</strong>',

	'LOG_CONFIG_ATTACH'			=> '<strong>Đã thay đổi thiết lập đính kèm tập tin</strong>',
	'LOG_CONFIG_AUTH'			=> '<strong>Đã thay đổi thiết lập xác thực</strong>',
	'LOG_CONFIG_AVATAR'			=> '<strong>Đã thay đổi thiết lập hình đại diện</strong>',
	'LOG_CONFIG_COOKIE'			=> '<strong>Đã thay đổi thiết lập cookie</strong>',
	'LOG_CONFIG_EMAIL'			=> '<strong>Đã thay đổi thiết lập email</strong>',
	'LOG_CONFIG_FEATURES'		=> '<strong>Đã thay đổi thiết lập chức năng của hệ thống</strong>',
	'LOG_CONFIG_LOAD'			=> '<strong>Đã thay đổi thiết lập nạp trang</strong>',
	'LOG_CONFIG_MESSAGE'		=> '<strong>Đã thay đổi thiết lập tin nhắn</strong>',
	'LOG_CONFIG_POST'			=> '<strong>Đã thay đổi thiết lập gửi bài</strong>',
	'LOG_CONFIG_REGISTRATION'	=> '<strong>Đã thay đổi thiết lập đăng ký tài khoản</strong>',
	'LOG_CONFIG_FEED'			=> '<strong>Đã thay đổi thiết lập tin nhanh</strong>',
	'LOG_CONFIG_SEARCH'			=> '<strong>Đã thay đổi thiết lập tìm kiếm</strong>',
	'LOG_CONFIG_SECURITY'		=> '<strong>Đã thay đổi thiết lập bảo mật</strong>',
	'LOG_CONFIG_SERVER'			=> '<strong>Đã thay đổi thiết lập máy chủ</strong>',
	'LOG_CONFIG_SETTINGS'		=> '<strong>Đã thay đổi thiết lập hệ thống</strong>',
	'LOG_CONFIG_SIGNATURE'		=> '<strong>Đã thay đổi thiết lập chữ ký cá nhân</strong>',
	'LOG_CONFIG_VISUAL'			=> '<strong>Đã thay đổi thiết lập kiểm tra nhập liệu tự động</strong>',

	'LOG_APPROVE_TOPIC'			=> '<strong>Đã duyệt chủ đề</strong><br />» %s',
	'LOG_BUMP_TOPIC'			=> '<strong>Người dùng đã đẩy chủ đề lên</strong><br />» %s',
	'LOG_DELETE_POST'			=> '<strong>Đã xóa bài viết “%1$s” gửi bởi “%2$s” vì lý do</strong><br />» %3$s',
	'LOG_DELETE_SHADOW_TOPIC'	=> '<strong>Đã xóa liên kết đến chủ đề cũ</strong><br />» %s',
	'LOG_DELETE_TOPIC'			=> '<strong>Đã xóa chủ đề “%1$s” gửi bởi “%2$s” vì lý do</strong><br />» %3$s',
	'LOG_FORK'					=> '<strong>Đã sao chép chủ đề</strong><br />» từ %s',
	'LOG_LOCK'					=> '<strong>Đã khóa chủ đề</strong><br />» %s',
	'LOG_LOCK_POST'				=> '<strong>Đã khóa bài viết</strong><br />» %s',
	'LOG_MERGE'					=> '<strong>Đã nhập chung bài viết</strong> sang chủ đề<br />» %s',
	'LOG_MOVE'					=> '<strong>Đã di chuyển chủ đề</strong><br />» từ %1$s sang %2$s',
	'LOG_MOVED_TOPIC'			=> '<strong>Đã di chuyển chủ đề</strong><br />» %s',
	'LOG_PM_REPORT_CLOSED'		=> '<strong>Đã kết thúc báo cáo tin nhắn</strong><br />» %s',
	'LOG_PM_REPORT_DELETED'		=> '<strong>Đã xóa báo cáo tin nhắn</strong><br />» %s',
	'LOG_POST_APPROVED'			=> '<strong>Đã duyệt bài viết</strong><br />» %s',
	'LOG_POST_DISAPPROVED'		=> '<strong>Đã từ chối bài viết “%1$s” gửi bởi “%3$s” vì lý do</strong><br />» %2$s',
	'LOG_POST_EDITED'			=> '<strong>Đã sửa bài viết “%1$s” gửi bởi “%2$s” vì lý do</strong><br />» %3$s',
	'LOG_POST_RESTORED'			=> '<strong>Đã phục hồi bài viết</strong><br />» %s',
	'LOG_REPORT_CLOSED'			=> '<strong>Đã kết thúc báo cáo</strong><br />» %s',
	'LOG_REPORT_DELETED'		=> '<strong>Đã xóa báo cáo</strong><br />» %s',
	'LOG_RESTORE_TOPIC'			=> '<strong>Đã phục hồi chủ đề “%1$s” gửi bởi</strong><br />» %2$s',
	'LOG_SOFTDELETE_POST'		=> '<strong>Đã xóa nháp bài viết “%1$s” gửi bởi “%2$s” vì lý do</strong><br />» %3$s',
	'LOG_SOFTDELETE_TOPIC'		=> '<strong>Đã xóa nháp chủ đề “%1$s” gửi bởi “%2$s” vì lý do</strong><br />» %3$s',
	'LOG_SPLIT_DESTINATION'		=> '<strong>Đã di chuyển các bài viết được chia nhỏ</strong><br />» đến %s',
	'LOG_SPLIT_SOURCE'			=> '<strong>Các bài viết được chia nhỏ</strong><br />» từ %s',

	'LOG_TOPIC_APPROVED'		=> '<strong>Đã duyệt chủ đề</strong><br />» %s',
	'LOG_TOPIC_RESTORED'		=> '<strong>Đã phục hồi chủ đề</strong><br />» %s',
	'LOG_TOPIC_DISAPPROVED'		=> '<strong>Đã từ chối chủ đề “%1$s” gửi bởi “%3$s” vì lý do</strong><br />» %2$s',
	'LOG_TOPIC_RESYNC'			=> '<strong>Đã đồng bộ lại bộ đếm số chủ đề</strong><br />» %s',
	'LOG_TOPIC_TYPE_CHANGED'	=> '<strong>Đã thay đổi loại chủ đề</strong><br />» %s',
	'LOG_UNLOCK'				=> '<strong>Đã mở khóa chủ đề</strong><br />» %s',
	'LOG_UNLOCK_POST'			=> '<strong>Đã mở khóa bài viết</strong><br />» %s',

	'LOG_DISALLOW_ADD'		=> '<strong>Đã thêm vào tên tài khoản bị cấm</strong><br />» %s',
	'LOG_DISALLOW_DELETE'	=> '<strong>Đã xóa tên tài khoản bị cấm</strong>',

	'LOG_DB_BACKUP'			=> '<strong>Đã sao lưu cơ sở dữ liệu</strong>',
	'LOG_DB_DELETE'			=> '<strong>Đã xóa bản sao lưu cơ sở dữ liệu</strong>',
	'LOG_DB_RESTORE'		=> '<strong>Đã khôi phục bản sao lưu dữ liệu</strong>',

	'LOG_DOWNLOAD_EXCLUDE_IP'	=> '<strong>Đã loại trừ địa chỉ IP/Tên miền từ danh sách cho phép tải về</strong><br />» %s',
	'LOG_DOWNLOAD_IP'			=> '<strong>Đã thêm vào địa chỉ IP/Tên miền từ danh sách cho phép tải về</strong><br />» %s',
	'LOG_DOWNLOAD_REMOVE_IP'	=> '<strong>Đã gỡ bỏ địa chỉ IP/Tên miền từ danh sách cho phép tải về</strong><br />» %s',

	'LOG_ERROR_CAPTCHA'	=> '<strong>Lỗi mã xác nhận</strong><br />» %s',
	'LOG_ERROR_JABBER'	=> '<strong>Lỗi Jabber</strong><br />» %s',
	'LOG_ERROR_EMAIL'	=> '<strong>Lỗi email</strong><br />» %s',
	'LOG_EXT_DISABLE'	=> '<strong>Phần mở rộng bị vô hiệu</strong><br />» %s',
	'LOG_EXT_ENABLE'	=> '<strong>Phần mở rộng được bật</strong><br />» %s',
	'LOG_EXT_PURGE'		=> '<strong>Đã xóa dữ liệu của phần mở rộng</strong><br />» %s',
	'LOG_EXT_UPDATE'	=> '<strong>Đã cập nhật phần mở rộng</strong><br />» %s',

	'LOG_FORUM_ADD'							=> '<strong>Đã tạo chuyên mục mới</strong><br />» %s',
	'LOG_FORUM_COPIED_PERMISSIONS'			=> '<strong>Đã sao chép cấp phép chuyên mục</strong> từ %1$s<br />» %2$s',
	'LOG_FORUM_DEL_FORUM'					=> '<strong>Đã xóa chuyên mục</strong><br />» %s',
	'LOG_FORUM_DEL_FORUMS'					=> '<strong>Đã xóa chuyên mục và toàn bộ chuyên mục con</strong><br />» %s',
	'LOG_FORUM_DEL_MOVE_FORUMS'				=> '<strong>Đã xóa chuyên mục và di chuyển toàn bộ chuyên mục con</strong> đến %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS'				=> '<strong>Đã xóa chuyên mục và di chuyển toàn bộ bài viết</strong> đến %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_FORUMS'		=> '<strong>Đã xóa chuyên mục và toàn bộ chuyên mục con, đã di chuyển toàn bộ bài viết</strong> đến %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_MOVE_FORUMS'	=> '<strong>Đã xóa chuyên mục, đã di chuyển toàn bộ bài viết</strong> đến %1$s <strong>và toàn bộ chuyên mục con</strong> đến %2$s<br />» %3$s',
	'LOG_FORUM_DEL_POSTS'					=> '<strong>Đã xóa chuyên mục và toàn bộ bài viết</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_FORUMS'			=> '<strong>Đã xóa chuyên mục, toàn bộ chuyên mục con và bài viết</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_MOVE_FORUMS'		=> '<strong>Đã xóa chuyên mục và toàn bộ bài viết, đã di chuyển toàn bộ chuyên mục con</strong> đến %1$s<br />» %2$s',
	'LOG_FORUM_EDIT'						=> '<strong>Đã chỉnh sửa thông tin chuyên mục</strong><br />» %s',
	'LOG_FORUM_MOVE_DOWN'					=> '<strong>Đã di chuyển chuyên mục</strong> %1$s <strong>xuống dưới</strong> %2$s',
	'LOG_FORUM_MOVE_UP'						=> '<strong>Đã di chuyển chuyên mục</strong> %1$s <strong>lên trên</strong> %2$s',
	'LOG_FORUM_SYNC'						=> '<strong>Đã đồng bộ lại chuyên mục</strong><br />» %s',

	'LOG_GENERAL_ERROR'	=> '<strong>Lỗi tổng quát:</strong> %1$s<br />» %2$s',

	'LOG_GROUP_CREATED'		=> '<strong>Nhóm mới đã được tạo</strong><br />» %s',
	'LOG_GROUP_DEFAULTS'	=> '<strong>Đã chọn “%1$s” là nhóm mặc định cho các người dùng</strong><br />» %2$s',
	'LOG_GROUP_DELETE'		=> '<strong>Nhóm đã được xóa</strong><br />» %s',
	'LOG_GROUP_DEMOTED'		=> '<strong>Người điều hành đã được giáng chức trong nhóm</strong> %1$s<br />» %2$s',
	'LOG_GROUP_PROMOTED'	=> '<strong>Người dùng đã được thăng chức người điều hành trong nhóm</strong> %1$s<br />» %2$s',
	'LOG_GROUP_REMOVE'		=> '<strong>Thành viên đã được gỡ bỏ khỏi nhóm</strong> %1$s<br />» %2$s',
	'LOG_GROUP_UPDATED'		=> '<strong>Thông tin về nhóm đã được cập nhật</strong><br />» %s',
	'LOG_MODS_ADDED'		=> '<strong>Đã thêm vào người điều hành mới trong nhóm</strong> %1$s<br />» %2$s',
	'LOG_USERS_ADDED'		=> '<strong>Đã thêm vào thành viên mới trong nhóm</strong> %1$s<br />» %2$s',
	'LOG_USERS_APPROVED'	=> '<strong>Thành viên được chấp thuận tham gia vào nhóm</strong> %1$s<br />» %2$s',
	'LOG_USERS_PENDING'		=> '<strong>Thành viên gửi yêu cầu tham gia vào nhóm “%1$s” và đang chờ chấp thuận</strong><br />» %2$s',

	'LOG_IMAGE_GENERATION_ERROR'	=> '<strong>Lỗi khi tạo hình ảnh</strong><br />» Lỗi trong %1$s tại dòng %2$s: %3$s',

	'LOG_INACTIVE_ACTIVATE'	=> '<strong>Đã kích hoạt những tài khoản chưa kích hoạt</strong><br />» %s',
	'LOG_INACTIVE_DELETE'	=> '<strong>Đã xóa những tài khoản chưa kích hoạt</strong><br />» %s',
	'LOG_INACTIVE_REMIND'	=> '<strong>Đã gửi email nhắc nhở đến những tài khoản chưa kích hoạt</strong><br />» %s',
	'LOG_INSTALL_CONVERTED'	=> '<strong>Đã chuyển đổi từ hệ thống %1$s sang hệ thống phpBB %2$s</strong>',
	'LOG_INSTALL_INSTALLED'	=> '<strong>Đã cài đặt hệ thống phpBB %s</strong>',

	'LOG_IP_BROWSER_FORWARDED_CHECK'	=> '<strong>Không thể kiểm tra địa chỉ IP/trình duyệt/X_FORWARDED_FOR trong phiên đăng nhập này</strong><br />» Địa chỉ IP của tài khoản “<em>%1$s</em>” đã được kiểm tra lại trong phiên đăng nhập này với kết quả là “<em>%2$s</em>”, chuỗi định danh trình duyệt “<em>%3$s</em>” đã được kiểm tra lại trong phiên đăng nhập này với kết quả là “<em>%4$s</em>” và giá trị chuỗi X_FORWARDED_FOR “<em>%5$s</em>” đã được kiểm tra lại trong phiên đăng nhập này với kết quả là “<em>%6$s</em>”.',

	'LOG_JAB_CHANGED'			=> '<strong>Tài khoản Jabber đã được thay đổi</strong>',
	'LOG_JAB_PASSCHG'			=> '<strong>Mật khẩu tài khoản Jabber đã được thay đổi</strong>',
	'LOG_JAB_REGISTER'			=> '<strong>Tài khoản Jabber đã được đăng ký</strong>',
	'LOG_JAB_SETTINGS_CHANGED'	=> '<strong>Thiết lập Jabber đã được thay đổi</strong>',

	'LOG_LANGUAGE_PACK_DELETED'		=> '<strong>Đã xóa ngôn ngữ</strong><br />» %s',
	'LOG_LANGUAGE_PACK_INSTALLED'	=> '<strong>Đã cài đặt ngôn ngữ</strong><br />» %s',
	'LOG_LANGUAGE_PACK_UPDATED'		=> '<strong>Đã cập nhật thông tin về ngôn ngữ</strong><br />» %s',
	'LOG_LANGUAGE_FILE_REPLACED'	=> '<strong>Đã thay thế ngôn ngữ</strong><br />» %s',
	'LOG_LANGUAGE_FILE_SUBMITTED'	=> '<strong>Đã cập nhật tập tin ngôn ngữ và đã được đặt trong thư mục lưu trữ</strong><br />» %s',

	'LOG_MASS_EMAIL'		=> '<strong>Đã gửi email số lượng lớn đến người dùng</strong><br />» %s',

	'LOG_MCP_CHANGE_POSTER'	=> '<strong>Đã thay đổi người gửi trong chủ đề “%1$s”</strong><br />» từ %2$s thành %3$s',

	'LOG_MODULE_DISABLE'	=> '<strong>Gói chức năng đã được vô hiệu</strong><br />» %s',
	'LOG_MODULE_ENABLE'		=> '<strong>Gói chức năng đã được kích hoạt</strong><br />» %s',
	'LOG_MODULE_MOVE_DOWN'	=> '<strong>Gói chức năng đã được di chuyển xuống</strong><br />» %1$s xuống dưới %2$s',
	'LOG_MODULE_MOVE_UP'	=> '<strong>Gói chức năng đã được di chuyển lên</strong><br />» %1$s lên trên %2$s',
	'LOG_MODULE_REMOVED'	=> '<strong>Gói chức năng đã được gỡ bỏ</strong><br />» %s',
	'LOG_MODULE_ADD'		=> '<strong>Gói chức năng đã được thêm vào</strong><br />» %s',
	'LOG_MODULE_EDIT'		=> '<strong>Gói chức năng đã được chỉnh sửa</strong><br />» %s',

	'LOG_A_ROLE_ADD'		=> '<strong>Nhiệm vụ quản trị viên đã được thêm vào</strong><br />» %s',
	'LOG_A_ROLE_EDIT'		=> '<strong>Nhiệm vụ quản trị viên đã được chỉnh sửa</strong><br />» %s',
	'LOG_A_ROLE_REMOVED'	=> '<strong>Nhiệm vụ quản trị viên đã được gỡ bỏ</strong><br />» %s',
	'LOG_F_ROLE_ADD'		=> '<strong>Nhiệm vụ chuyên mục đã được thêm vào</strong><br />» %s',
	'LOG_F_ROLE_EDIT'		=> '<strong>Nhiệm vụ chuyên mục đã được chỉnh sửa</strong><br />» %s',
	'LOG_F_ROLE_REMOVED'	=> '<strong>Nhiệm vụ chuyên mục đã được gỡ bỏ</strong><br />» %s',
	'LOG_M_ROLE_ADD'		=> '<strong>Nhiệm vụ điều hành viên đã được thêm vào</strong><br />» %s',
	'LOG_M_ROLE_EDIT'		=> '<strong>Nhiệm vụ điều hành viên đã được chỉnh sửa</strong><br />» %s',
	'LOG_M_ROLE_REMOVED'	=> '<strong>Nhiệm vụ điều hành viên đã được gỡ bỏ</strong><br />» %s',
	'LOG_U_ROLE_ADD'		=> '<strong>Nhiệm vụ người dùng đã được thêm vào</strong><br />» %s',
	'LOG_U_ROLE_EDIT'		=> '<strong>Nhiệm vụ người dùng đã được chỉnh sửa</strong><br />» %s',
	'LOG_U_ROLE_REMOVED'	=> '<strong>Nhiệm vụ người dùng đã được gỡ bỏ</strong><br />» %s',

	'LOG_PLUPLOAD_TIDY_FAILED'	=> '<strong>Không thể mở “%1$s” để xử lí, hãy kiểm tra lại cấp phép.</strong><br />Ngoại lệ: %2$s<br />Theo dấu: %3$s',

	'LOG_PROFILE_FIELD_ACTIVATE'	=> '<strong>Mục thông tin cá nhân đã được kích hoạt</strong><br />» %s',
	'LOG_PROFILE_FIELD_CREATE'		=> '<strong>Mục thông tin cá nhân đã được thêm vào</strong><br />» %s',
	'LOG_PROFILE_FIELD_DEACTIVATE'	=> '<strong>Mục thông tin cá nhân đã được ngưng kích hoạt</strong><br />» %s',
	'LOG_PROFILE_FIELD_EDIT'		=> '<strong>Mục thông tin cá nhân đã được thay đổi</strong><br />» %s',
	'LOG_PROFILE_FIELD_REMOVED'		=> '<strong>Mục thông tin cá nhân đã được gỡ bỏ</strong><br />» %s',

	'LOG_PRUNE'					=> '<strong>Đã dọn dẹp chuyên mục</strong><br />» %s',
	'LOG_AUTO_PRUNE'			=> '<strong>Đã dọn dẹp tự động chuyên mục</strong><br />» %s',
	'LOG_PRUNE_SHADOW'			=> '<strong>Đã dọn dẹp tự động các liên kết đến chủ đề cũ</strong><br />» %s',
	'LOG_PRUNE_USER_DEAC'		=> '<strong>Tài khoản đã được ngưng kích hoạt</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_DEL'	=> '<strong>Tài khoản đã được dọn dẹp và toàn bộ bài viết đã bị xóa</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_ANON'	=> '<strong>Tài khoản đã được dọn dẹp và toàn bộ bài viết được giữ lại</strong><br />» %s',

	'LOG_PURGE_CACHE'		=> '<strong>Đã dọn sạch bộ đệm</strong>',
	'LOG_PURGE_SESSIONS'	=> '<strong>Đã dọn sạch phiên đăng nhập</strong>',

	'LOG_RANK_ADDED'		=> '<strong>Đã thêm vào danh hiệu mới</strong><br />» %s',
	'LOG_RANK_REMOVED'		=> '<strong>Đã gỡ bỏ danh hiệu</strong><br />» %s',
	'LOG_RANK_UPDATED'		=> '<strong>Đã cập nhật danh hiệu</strong><br />» %s',

	'LOG_REASON_ADDED'		=> '<strong>Đã thêm vào báo cáo/lý do từ chối</strong><br />» %s',
	'LOG_REASON_REMOVED'	=> '<strong>Đã gỡ bỏ báo cáo/lý do từ chối</strong><br />» %s',
	'LOG_REASON_UPDATED'	=> '<strong>Đã cập nhật báo cáo/lý do từ chối</strong><br />» %s',

	'LOG_REFERER_INVALID'		=> '<strong>Kiểm tra tham chiếu thất bại</strong><br />» Tham chiếu là “<em>%1$s</em>”. Yêu cầu đã bị từ chối và phiên đăng nhập bị hủy bỏ.',
	'LOG_RESET_DATE'			=> '<strong>Ngày hệ thống bắt đầu hoạt động đã được tạo lại</strong>',
	'LOG_RESET_ONLINE'			=> '<strong>Thông tin người dùng trực tuyến đã được tạo lại</strong>',
	'LOG_RESYNC_FILES_STATS'	=> '<strong>Thống kê tập tin đính kèm đã được đồng bộ lại</strong>',
	'LOG_RESYNC_POSTCOUNTS'		=> '<strong>Bộ đếm số bài viết đã được đồng bộ lại</strong>',
	'LOG_RESYNC_POST_MARKING'	=> '<strong>Những chủ đề được đánh dấu đã được đồng bộ lại</strong>',
	'LOG_RESYNC_STATS'			=> '<strong>Trạng thái chủ đề, bài viết và tài khoản người dùng đã được đồng bộ lại</strong>',

	'LOG_SEARCH_INDEX_CREATED'	=> '<strong>Đã tạo chỉ mục tìm kiếm cho</strong><br />» %s',
	'LOG_SEARCH_INDEX_REMOVED'	=> '<strong>Đã gỡ bỏ chỉ mục tìm kiếm của</strong><br />» %s',
	'LOG_SPHINX_ERROR'			=> '<strong>Lỗi Sphinx</strong><br />» %s',
	'LOG_STYLE_ADD'				=> '<strong>Đã thêm vào giao diện mới</strong><br />» %s',
	'LOG_STYLE_DELETE'			=> '<strong>Đã xóa giao diện</strong><br />» %s',
	'LOG_STYLE_EDIT_DETAILS'	=> '<strong>Đã chỉnh sửa giao diện</strong><br />» %s',
	'LOG_STYLE_EXPORT'			=> '<strong>Đã xuất giao diện</strong><br />» %s',

	// @deprecated 3.1
	'LOG_TEMPLATE_ADD_DB'			=> '<strong>Đã thêm vào khuôn mẫu mới trong cơ sở dữ liệu</strong><br />» %s',
	// @deprecated 3.1
	'LOG_TEMPLATE_ADD_FS'			=> '<strong>Đã thêm vào khuôn mẫu mới trong hệ thống tập tin giao diện</strong><br />» %s',
	'LOG_TEMPLATE_CACHE_CLEARED'	=> '<strong>Đã xóa những tập tin khuôn mẫu được tạo bộ đệm <em>%1$s</em></strong><br />» %2$s',
	'LOG_TEMPLATE_DELETE'			=> '<strong>Đã xóa khuôn mẫu</strong><br />» %s',
	'LOG_TEMPLATE_EDIT'				=> '<strong>Đã chỉnh sửa khuôn mẫu <em>%1$s</em></strong><br />» %2$s',
	'LOG_TEMPLATE_EDIT_DETAILS'		=> '<strong>Đã chỉnh sửa thông tin khuôn mẫu</strong><br />» %s',
	'LOG_TEMPLATE_EXPORT'			=> '<strong>Đã xuất khuôn mẫu</strong><br />» %s',
	// @deprecated 3.1
	'LOG_TEMPLATE_REFRESHED'		=> '<strong>Đã nạp lại khuôn mẫu</strong><br />» %s',

	// @deprecated 3.1
	'LOG_THEME_ADD_DB'			=> '<strong>Đã thêm vào kiểu dáng mới trong cơ sở dữ liệu</strong><br />» %s',
	// @deprecated 3.1
	'LOG_THEME_ADD_FS'			=> '<strong>Đã thêm vào kiểu dáng mới trong hệ thống tập tin giao diện</strong><br />» %s',
	'LOG_THEME_DELETE'			=> '<strong>Kiểu dáng đã được xóa</strong><br />» %s',
	'LOG_THEME_EDIT_DETAILS'	=> '<strong>Đã chỉnh sửa thông tin kiểu dáng</strong><br />» %s',
	'LOG_THEME_EDIT'			=> '<strong>Đã chỉnh sửa kiểu dáng <em>%1$s</em></strong>',
	'LOG_THEME_EDIT_FILE'		=> '<strong>Đã chỉnh sửa kiểu dáng <em>%1$s</em></strong><br />» Tập tin đã chỉnh sửa <em>%2$s</em>',
	'LOG_THEME_EXPORT'			=> '<strong>Đã xuất kiểu dáng</strong><br />» %s',
	// @deprecated 3.1
	'LOG_THEME_REFRESHED'		=> '<strong>Đã nạp lại kiểu dáng</strong><br />» %s',

	'LOG_UPDATE_DATABASE'	=> '<strong>Đã cập nhật cơ sở dữ liệu từ phiên bản %1$s lên phiên bản %2$s</strong>',
	'LOG_UPDATE_PHPBB'		=> '<strong>Đã cập nhật hệ thống phpBB từ phiên bản %1$s lên phiên bản %2$s</strong>',

	'LOG_USER_ACTIVE'		=> '<strong>Tài khoản đã được kích hoạt</strong><br />» %s',
	'LOG_USER_BAN_USER'		=> '<strong>Đã cấm tài khoản thông qua phần quản lí người dùng</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_BAN_IP'		=> '<strong>Đã cấm địa chỉ IP thông qua phần quản lí người dùng</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_BAN_EMAIL'	=> '<strong>Đã cấm địa chỉ email thông qua phần quản lí người dùng</strong> vì lý do “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_DELETED'		=> '<strong>Đã xóa tài khoản</strong><br />» %s',
	'LOG_USER_DEL_ATTACH'	=> '<strong>Đã gỡ bỏ toàn bộ tập tin đính kèm được gửi bởi</strong><br />» %s',
	'LOG_USER_DEL_AVATAR'	=> '<strong>Đã gỡ bỏ hình đại diện của tài khoản</strong><br />» %s',
	'LOG_USER_DEL_OUTBOX'	=> '<strong>Đã dọn sạch hộp thư chuyển đi của tài khoản</strong><br />» %s',
	'LOG_USER_DEL_POSTS'	=> '<strong>Đã gỡ bỏ toàn bộ bài viết được gửi bởi</strong><br />» %s',
	'LOG_USER_DEL_SIG'		=> '<strong>Đã gỡ bỏ chữ ký cá nhân của tài khoản</strong><br />» %s',
	'LOG_USER_INACTIVE'		=> '<strong>Tài khoản đã được ngưng kích hoạt</strong><br />» %s',
	'LOG_USER_MOVE_POSTS'	=> '<strong>Đã di chuyển bài viết của người dùng</strong><br />» bài viết gửi bởi “%1$s” sang chuyên mục “%2$s”',
	'LOG_USER_NEW_PASSWORD'	=> '<strong>Đã thay đổi mật khẩu của tài khoản</strong><br />» %s',
	'LOG_USER_REACTIVATE'	=> '<strong>Đã yêu cầu người dùng kích hoạt lại tài khoản</strong><br />» %s',
	'LOG_USER_REMOVED_NR'	=> '<strong>Đã gỡ bỏ trạng thái mới đăng ký cho tài khoản</strong><br />» %s',
	'LOG_USER_UPDATE_EMAIL'	=> '<strong>Tài khoản “%1$s” đã thay đổi địa chỉ email</strong><br />» từ “%2$s” thành “%3$s”',
	'LOG_USER_UPDATE_NAME'	=> '<strong>Đã thay đổi tên tài khoản</strong><br />» từ “%1$s” sang “%2$s”',
	'LOG_USER_USER_UPDATE'	=> '<strong>Đã cập nhật thông tin về tài khoản</strong><br />» %s',

	'LOG_USER_ACTIVE_USER'		=> '<strong>Tài khoản người dùng đã được kích hoạt</strong>',
	'LOG_USER_DEL_AVATAR_USER'	=> '<strong>Hình đại diện của người dùng đã được gỡ bỏ</strong>',
	'LOG_USER_DEL_SIG_USER'		=> '<strong>Chữ ký cá nhân của người dùng đã được gỡ bỏ</strong>',
	'LOG_USER_FEEDBACK'			=> '<strong>Đã thêm phản hồi người dùng</strong><br />» %s',
	'LOG_USER_GENERAL'			=> '<strong>Đã thêm vào mục:</strong><br />» %s',
	'LOG_USER_INACTIVE_USER'	=> '<strong>Tài khoản người dùng đã ngưng kích hoạt</strong>',
	'LOG_USER_LOCK'				=> '<strong>Người dùng đã khóa chủ đề của mình</strong><br />» %s',
	'LOG_USER_MOVE_POSTS_USER'	=> '<strong>Đã di chuyển tất cả bài viết đến chuyên mục</strong><br />» %s',
	'LOG_USER_REACTIVATE_USER'	=> '<strong>Đã yêu cầu kích hoạt lại tài khoản người dùng</strong>',
	'LOG_USER_UNLOCK'			=> '<strong>Người dùng đã mở khóa chủ đề của mình</strong><br />» %s',
	'LOG_USER_WARNING'			=> '<strong>Đã thêm cảnh cáo người dùng</strong><br />» %s',
	'LOG_USER_WARNING_BODY'		=> '<strong>Những cảnh cáo dành cho người dùng này</strong><br />» %s',

	'LOG_USER_GROUP_CHANGE'			=> '<strong>Thành viên đã thay đổi nhóm mặc định</strong><br />» %s',
	'LOG_USER_GROUP_DEMOTE'			=> '<strong>Thành viên đã bị giáng chức người điều hành từ nhóm</strong><br />» %s',
	'LOG_USER_GROUP_JOIN'			=> '<strong>Thành viên đã tham gia vào nhóm</strong><br />» %s',
	'LOG_USER_GROUP_JOIN_PENDING'	=> '<strong>Thành viên đã tham gia vào nhóm và đang chờ quyết định chấp thuận</strong><br />» %s',
	'LOG_USER_GROUP_RESIGN'			=> '<strong>Người dùng đã từ bỏ tư cách thành viên trong nhóm</strong><br />» %s',

	'LOG_WARNING_DELETED'		=> '<strong>Đã xóa cảnh cáo người dùng</strong><br />» %s',
	'LOG_WARNINGS_DELETED'		=> array(
		1 => '<strong>Đã xóa cảnh cáo người dùng</strong><br />» %1$s',
		2 => '<strong>Đã xóa %2$d cảnh cáo người dùng</strong><br />» %1$s', // Example: '<strong>Deleted 2 user warnings</strong><br />» username'
	),
	'LOG_WARNINGS_DELETED_ALL'	=> '<strong>Đã xóa hết cảnh cáo người dùng</strong><br />» %s',

	'LOG_WORD_ADD'		=> '<strong>Đã thêm từ kiểm duyệt</strong><br />» %s',
	'LOG_WORD_DELETE'	=> '<strong>Đã xóa từ kiểm duyệt</strong><br />» %s',
	'LOG_WORD_EDIT'		=> '<strong>Đã sửa từ kiểm duyệt</strong><br />» %s',
));
