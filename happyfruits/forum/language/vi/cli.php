<?php
/** 
*
* cli [Vietnamese]
*
* @package language
* @version 1.05
* @copyright (c) 2014 nedka
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
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
	'CLI_CONFIG_CANNOT_CACHED'			=> 'Bật tùy chọn này nếu mục cấu hình có sự thay đổi giá trị liên tục, không cần tạo bộ đệm.',
	'CLI_CONFIG_CURRENT'				=> 'Giá trị hiện tại của mục cấu hình, nhập vào số nhị phân 0 hoặc 1',
	'CLI_CONFIG_DELETE_SUCCESS'			=> 'Đã xóa mục cấu hình %s thành công.',
	'CLI_CONFIG_NEW'					=> 'Giá trị khởi tạo của mục cấu hình, nhập vào số nhị phân 0 hoặc 1',
	'CLI_CONFIG_NOT_EXISTS'				=> 'Mục cấu hình %s không tồn tại',
	'CLI_CONFIG_OPTION_NAME'			=> 'Tên hiển thị của mục cấu hình',
	'CLI_CONFIG_PRINT_WITHOUT_NEWLINE'	=> 'Bật tùy chọn này nếu giá trị mục cấu hình không kèm theo một dòng mới ở cuối.',
	'CLI_CONFIG_INCREMENT_BY'			=> 'Giá trị tăng thêm',
	'CLI_CONFIG_INCREMENT_SUCCESS'		=> 'Đã tăng thêm giá trị cho mục cấu hình %s thành công',
	'CLI_CONFIG_SET_FAILURE'			=> 'Không thể cập nhật mục cấu hình %s',
	'CLI_CONFIG_SET_SUCCESS'			=> 'Đã cập nhật mục cấu hình %s thành công',

	'CLI_DESCRIPTION_CRON_LIST'							=> 'In danh sách tất cả thao tác hẹn giờ.',
	'CLI_DESCRIPTION_CRON_RUN'							=> 'Chạy tất cả thao tác sẵn sàng.',
	'CLI_DESCRIPTION_CRON_RUN_ARGUMENT_1'				=> 'Tên thao tác đang chạy',
	'CLI_DESCRIPTION_DB_LIST'							=> 'Liệt kê tất cả dữ liệu nâng cấp có sẵn và đã cài đặt.',
	'CLI_DESCRIPTION_DB_MIGRATE'						=> 'Cập nhật cơ sở dữ liệu dựa trên dữ liệu thay đổi.',
	'CLI_DESCRIPTION_DB_REVERT'							=> 'Phục hồi lại thao tác nâng cấp dữ liệu.',
	'CLI_DESCRIPTION_DELETE_CONFIG'						=> 'Xóa một mục cấu hình',
	'CLI_DESCRIPTION_DISABLE_EXTENSION'					=> 'Vô hiệu phần mở rộng xác định.',
	'CLI_DESCRIPTION_ENABLE_EXTENSION'					=> 'Cài đặt phần mở rộng xác định.',
	'CLI_DESCRIPTION_FIND_MIGRATIONS'					=> 'Tìm dữ liệu thay đổi không bị phụ thuộc.',
	'CLI_DESCRIPTION_FIX_LEFT_RIGHT_IDS'				=> 'Sửa cấu trúc cây phân nhánh cho các chuyên mục và gói chức năng.',
	'CLI_DESCRIPTION_GET_CONFIG'						=> 'In giá trị một mục cấu hình',
	'CLI_DESCRIPTION_INCREMENT_CONFIG'					=> 'Tăng thêm giá trị số nguyên một mục cấu hình',
	'CLI_DESCRIPTION_LIST_EXTENSIONS'					=> 'In danh sách tất cả phần mở rộng có trong cơ sở dữ liệu và hệ thống tập tin.',
	'CLI_DESCRIPTION_OPTION_ENV'						=> 'Tên biến môi trường.',
	'CLI_DESCRIPTION_OPTION_SAFE_MODE'					=> 'Chạy chế độ an toàn (không sử dụng phần mở rộng).',
	'CLI_DESCRIPTION_OPTION_SHELL'						=> 'Chạy dòng lệnh.',
	'CLI_DESCRIPTION_PURGE_EXTENSION'					=> 'Xóa dữ liệu phần mở rộng xác định.',
	'CLI_DESCRIPTION_RECALCULATE_EMAIL_HASH'			=> 'Tạo lại chuỗi mã hóa cho cột dữ liệu user_email_hash trong bảng người dùng.',
	'CLI_DESCRIPTION_REPARSER_LIST'						=> 'Liệt kê tất cả loại nội dung có thể tiến hành xử lý lại.',
	'CLI_DESCRIPTION_REPARSER_AVAILABLE'				=> 'Các lệnh xử lý lại nội dung có sẵn:',
	'CLI_DESCRIPTION_REPARSER_REPARSE'					=> 'Xử lý lại các nội dung chứa BBCode với trình xử lý văn bản hiện tại.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_ARG_1'			=> 'Loại nội dung bạn muốn xử lý lại. Để trống nghĩa là xử lý hết mọi thứ.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_DRY_RUN'		=> 'Không lưu lại thay đổi trên dữ liệu, chỉ xuất ra kết quả nếu áp dụng',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MIN'	=> 'Giá trị ID thấp nhất tiến hành xử lý',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MAX'	=> 'Giá trị ID cao nhất tiến hành xử lý',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_SIZE'	=> 'Số dòng dữ liệu xử lý cùng lúc',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RESUME'		=> 'Xử lý tiếp nội dung tại nơi mà lần thực thi trước đã dừng',
	'CLI_DESCRIPTION_SET_ATOMIC_CONFIG'					=> 'Chỉ cập nhật lại giá trị cho mục cấu hình nếu giá trị cũ trùng với giá trị nhập vào',
	'CLI_DESCRIPTION_SET_CONFIG'						=> 'Gán giá trị một mục cấu hình',
	'CLI_DESCRIPTION_THUMBNAIL_DELETE'					=> 'Xóa hết hình thu nhỏ.',
	'CLI_DESCRIPTION_THUMBNAIL_GENERATE'				=> 'Tạo tất cả hình thu nhỏ bị thiếu.',
	'CLI_DESCRIPTION_THUMBNAIL_RECREATE'				=> 'Tạo lại tất cả hình thu nhỏ.',
	'CLI_DESCRIPTION_UPDATE_CHECK'						=> 'Kiểm tra phiên bản phpBB mới.',
	'CLI_DESCRIPTION_UPDATE_CHECK_ARGUMENT_1'			=> 'Tên phần mở rộng muốn kiểm tra cập nhật (Nếu nhập “all” sẽ kiểm tra tất cả phần mở rộng)',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_CACHE'			=> 'Chạy lệnh kiểm tra với dữ liệu tạm.',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_STABILITY'		=> 'Thay đổi tùy chọn kiểm tra giữa phiên bản ổn định và đang phát triển.',
	'CLI_DESCRIPTION_UPDATE_HASH_BCRYPT'				=> 'Chuyển đổi chuỗi mã hóa mật khẩu cũ sang bcrypt.',
	'CLI_DESCRIPTION_USER_ACTIVATE'						=> 'Kích hoạt hoặc dừng kích hoạt tài khoản.',
	'CLI_DESCRIPTION_USER_ACTIVATE_USERNAME'			=> 'Tên tài khoản muốn kích hoạt.',
	'CLI_DESCRIPTION_USER_ACTIVATE_DEACTIVATE'			=> 'Dừng kích hoạt tài khoản',
	'CLI_DESCRIPTION_USER_ACTIVATE_ACTIVE'				=> 'Tài khoản này đã kích hoạt rồi.',
	'CLI_DESCRIPTION_USER_ACTIVATE_INACTIVE'			=> 'Tài khoản này đã dừng kích hoạt rồi.',
	'CLI_DESCRIPTION_USER_ADD'							=> 'Thêm người dùng mới.',
	'CLI_DESCRIPTION_USER_ADD_OPTION_USERNAME'			=> 'Tên tài khoản',
	'CLI_DESCRIPTION_USER_ADD_OPTION_PASSWORD'			=> 'Mật khẩu',
	'CLI_DESCRIPTION_USER_ADD_OPTION_EMAIL'				=> 'Địa chỉ email',
	'CLI_DESCRIPTION_USER_ADD_OPTION_NOTIFY'			=> 'Gửi email kích hoạt tài khoản (mặc định không gửi)',
	'CLI_DESCRIPTION_USER_DELETE'						=> 'Xóa tài khoản người dùng.',
	'CLI_DESCRIPTION_USER_DELETE_USERNAME'				=> 'Tên tài khoản muốn xóa',
	'CLI_DESCRIPTION_USER_DELETE_OPTION_POSTS'			=> 'Xóa hết bài viết của người dùng. Không bật tùy chọn này, các bài viết sẽ được giữ lại.',
	'CLI_DESCRIPTION_USER_RECLEAN'						=> 'Xử lý lại tên tài khoản dùng cho tìm kiếm.',

	'CLI_ERROR_INVALID_STABILITY'	=> '“%s” chỉ có thể thiết lập giá trị là “stable” hoặc “unstable”.',
	'CLI_EXTENSION_DISABLE_FAILURE'	=> 'Không thể vô hiệu phần mở rộng %s',
	'CLI_EXTENSION_DISABLE_SUCCESS'	=> 'Đã vô hiệu phần mở rộng %s thành công',
	'CLI_EXTENSION_DISABLED'		=> 'Phần mở rộng %s chưa cài đặt',
	'CLI_EXTENSION_ENABLE_FAILURE'	=> 'Không thể cài đặt phần mở rộng %s',
	'CLI_EXTENSION_ENABLE_SUCCESS'	=> 'Đã cài đặt phần mở rộng %s thành công',
	'CLI_EXTENSION_ENABLED'			=> 'Phần mở rộng %s đã cài đặt',
	'CLI_EXTENSION_NAME'			=> 'Tên phần mở rộng',
	'CLI_EXTENSION_NOT_ENABLEABLE'	=> 'Phần mở rộng %s không thể cài đặt.',
	'CLI_EXTENSION_NOT_EXIST'		=> 'Phần mở rộng %s không tồn tại',
	'CLI_EXTENSION_NOT_FOUND'		=> 'Không có phần mở rộng nào.',
	'CLI_EXTENSION_PURGE_FAILURE'	=> 'Không thể xóa dữ liệu của phần mở rộng %s',
	'CLI_EXTENSION_PURGE_SUCCESS'	=> 'Đã xóa dữ liệu của phần mở rộng %s thành công',
	'CLI_EXTENSION_UPDATE_FAILURE'	=> 'Không thể cập nhật phần mở rộng %s',
	'CLI_EXTENSION_UPDATE_SUCCESS'	=> 'Đã cập nhật phần mở rộng %s thành công',
	'CLI_EXTENSIONS_AVAILABLE'		=> 'Chưa cài đặt',
	'CLI_EXTENSIONS_DISABLED'		=> 'Đã vô hiệu',
	'CLI_EXTENSIONS_ENABLED'		=> 'Đã cài đặt',

	'CLI_FIXUP_FIX_LEFT_RIGHT_IDS_SUCCESS'		=> 'Đã sửa lại cấu trúc cây phân nhánh cho các chuyên mục và gói chức năng.',
	'CLI_FIXUP_RECALCULATE_EMAIL_HASH_SUCCESS'	=> 'Đã tạo lại chuỗi mã hóa cho địa chỉ email.',
	'CLI_FIXUP_UPDATE_HASH_BCRYPT_SUCCESS'		=> 'Đã chuyển đổi chuỗi mã hóa mật khẩu cũ sang bcrypt.',

	'CLI_MIGRATION_NAME'			=> 'Tên dữ liệu nâng cấp dạng namespace đầy đủ (dùng đấu / thay vì \ để tránh rắc rối).',
	'CLI_MIGRATIONS_AVAILABLE'		=> 'Dữ liệu nâng cấp có sẵn',
	'CLI_MIGRATIONS_INSTALLED'		=> 'Dữ liệu nâng cấp đã cài đặt',
	'CLI_MIGRATIONS_ONLY_AVAILABLE'	=> 'Chỉ hiện dữ liệu nâng cấp có sẵn',
	'CLI_MIGRATIONS_EMPTY'			=> 'Không có dữ liệu nâng cấp nào.',

	'CLI_REPARSER_REPARSE_REPARSING'		=> 'Đang xử lý %1$s (dãy %2$d..%3$d)',
	'CLI_REPARSER_REPARSE_REPARSING_START'	=> 'Đang xử lý %s...',
	'CLI_REPARSER_REPARSE_SUCCESS'			=> 'Đã xử lý thành công',

	// In all the case %1$s is the logical name of the file and %2$s the real name on the filesystem
	// eg: big_image.png (2_a51529ae7932008cf8454a95af84cacd) generated.
	'CLI_THUMBNAIL_DELETED'			=> 'Đã xóa %1$s (%2$s).',
	'CLI_THUMBNAIL_DELETING'		=> 'Đang xóa hình thu nhỏ',
	'CLI_THUMBNAIL_SKIPPED'			=> 'Đã bỏ qua %1$s (%2$s).',
	'CLI_THUMBNAIL_GENERATED'		=> 'Đã tạo lại %1$s (%2$s).',
	'CLI_THUMBNAIL_GENERATING'		=> 'Đang tạo hình thu nhỏ',
	'CLI_THUMBNAIL_GENERATING_DONE'	=> 'Đã tạo lại tất cả hình thu nhỏ.',
	'CLI_THUMBNAIL_DELETING_DONE'	=> 'Đã xóa hết hình thu nhỏ.',

	'CLI_THUMBNAIL_NOTHING_TO_GENERATE'	=> 'Không có hình đính kèm nào để tạo hình thu nhỏ.',
	'CLI_THUMBNAIL_NOTHING_TO_DELETE'	=> 'Không có hình thu nhỏ nào để xóa.',

	'CLI_USER_ADD_SUCCESS'		=> 'Đã thêm tài khoản %s thành công.',
	'CLI_USER_DELETE_CONFIRM'	=> 'Bạn chắc chắn muốn xóa ‘%s’? [y/N]',
	'CLI_USER_RECLEAN_START'	=> 'Tạo lại tên tài khoản dùng cho tìm kiếm',
	'CLI_USER_RECLEAN_DONE'		=> [
		0	=> 'Đã tạo lại thành công. Không có tên tài khoản nào cần tạo lại.',
		1	=> 'Đã tạo lại thành công. %d tên tài khoản đã tạo lại.',
		2	=> 'Đã tạo lại thành công. %d tên tài khoản đã tạo lại.',
	],
));

// Additional help for commands.
$lang = array_merge($lang, array(
	'CLI_HELP_CRON_RUN'			=> $lang['CLI_DESCRIPTION_CRON_RUN'] . ' Xác định thêm tên thao tác, hệ thống sẽ chỉ chạy mỗi thao tác đó mà thôi.',
	'CLI_HELP_USER_ACTIVATE'	=> 'Kích hoạt tài khoản người dùng, hoặc sử dụng tùy chọn <info>--deactivate</info> để dừng kích hoạt. Để gửi email yêu cầu người dùng kích hoạt, hãy thêm vào tùy chọn <info>--send-email</info>.',
	'CLI_HELP_USER_ADD'			=> 'Dòng lệnh <info>%command.name%</info> dùng để tạo một tài khoản mới. Nếu không thêm vào các tùy chọn, bạn sẽ được yêu cầu nhập từng mục một. Để gửi email yêu cầu người dùng kích hoạt, hãy thêm vào tùy chọn <info>--send-email</info>.',
	'CLI_HELP_USER_RECLEAN'		=> 'Xử lý tên tài khoản của người dùng để dễ dàng cho chức năng tìm kiếm tên họ. Dạng này không phân biệt hoa thường, được chuẩn hóa NFC và chỉ dùng các ký tự trong bảng mã ASCII.',
));
