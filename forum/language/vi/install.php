<?php
/**
*
* install [Vietnamese]
*
* @package language
* @version 1.125
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
	'ACP_LINK'					=> 'Chuyển đến <a href="%1$s">bảng quản trị</a>',
	'ADMIN_CONFIG'				=> 'Cấu hình tài khoản quản trị viên',
	'ADMIN_PASSWORD'			=> 'Mật khẩu của quản trị viên',
	'ADMIN_PASSWORD_CONFIRM'	=> 'Xác nhận mật khẩu quản trị viên',
	'ADMIN_PASSWORD_EXPLAIN'	=> 'Mật khẩu không được phép ít hơn <strong>6</strong> ký tự và vượt quá <strong>30</strong> ký tự.',
	'ADMIN_USERNAME'			=> 'Tên tài khoản của người quản trị',
	'ADMIN_USERNAME_EXPLAIN'	=> 'Tên tài khoản không được phép ít hơn <strong>3</strong> ký tự và vượt quá <strong>20</strong> ký tự.',
	'ALL_FILES_DIFFED'			=> 'Tất cả tập tin chỉnh sửa đã được cập nhật thay đổi.',
	'AUTHOR_NOTES'				=> 'Ghi chú của tác giả<br />» %s',
	'AVAILABLE_CONVERTORS'		=> 'Những chuyển đổi có sẵn',

	'BOARD_CONFIG'		=> 'Thiết lập diễn đàn',
	'BOARD_DESCRIPTION'	=> 'Giới thiệu',
	'BOARD_NAME'		=> 'Tên diễn đàn',

	'CHECK_TABLE_PREFIX'				=> 'Hãy kiểm tra tiền tố của mỗi tên bảng dữ liệu rồi thử lại.',
	'CLEAN_VERIFY'						=> 'Đang dọn dẹp và kiểm tra cấu trúc cơ sở dữ liệu lần cuối',
	'CLI_CONFIG_FILE'					=> 'Tập tin cấu hình',
	'CLI_INSTALL_BOARD'					=> 'Cài đặt phpBB',
	'CLI_INSTALL_SHOW_CONFIG'			=> 'Hiện tập tin cấu hình được dùng',
	'CLI_INSTALL_VALIDATE_CONFIG'		=> 'Kiểm tra tập tin cấu hình',
	'CLI_UPDATE_BOARD'					=> 'Cập nhật phpBB',
	'CONFIG_BOARD_EMAIL_SIG'			=> 'Chân thành cám ơn - Người quản lí',
	'CONFIG_CONVERT'					=> 'Đang chuyển đổi cấu hình hệ thống',
	'CONFIG_PHPBB_EMPTY'				=> 'Biến số cấu hình của hệ thống phpBB cho “%s” còn để trống.',
	'CONFIG_SITE_DESC'					=> 'Giới thiệu về website của bạn',
	'CONFIG_SITENAME'					=> 'yourdomain.com',
	'CONFIGURATION_VALID'				=> 'Tập tin cấu hình hợp lệ',
	'CONTINUE_CONVERT'					=> 'Tiếp tục chuyển đổi',
	'CONTINUE_CONVERT_BODY'				=> 'Một chuyển đổi hệ thống trước đã được xác định. Bây giờ bạn có thể lựa chọn giữa việc bắt đầu một chuyển đổi hệ thống mới hoặc tiếp tục với chuyển đổi hệ thống trước.',
	'CONTINUE_LAST'						=> 'Tiếp tục câu lệnh trước',
	'CONTINUE_OLD_CONVERSION'			=> 'Tiếp tục chuyển đổi hệ thống đã tiến hành',
	'CONV_ERROR_ATTACH_FTP_DIR'			=> 'Thiết lập tải lên bằng FTP cho các tập tin đính kèm được bật trong hệ thống cũ. Bạn hãy vui lòng tắt thiết lập tải lên bằng FTP và chắc chắn rằng một thư mục hợp lệ chứa các tập tin đính kèm tải lên đã được xác định. Sau đó, hãy sao chép tất cả các tập tin đính kèm đến một thư mục mới trên Web có thể truy cập được. Nếu bạn đã hoàn tất xong việc này, hãy khởi động lại công cụ chuyển đổi.',
	'CONV_ERROR_CONFIG_EMPTY'			=> 'Không có thông tin cấu hình nào sẵn có cho quá trình chuyển đổi.',
	'CONV_ERROR_COULD_NOT_READ'			=> 'Không thể truy cập/đọc “%s”.',
	'CONV_ERROR_FORUM_ACCESS'			=> 'Không thể nhận thông tin cho phép truy cập chuyên mục.',
	'CONV_ERROR_GET_CATEGORIES'			=> 'Không thể nhận thông tin về các nhóm chuyên mục.',
	'CONV_ERROR_GET_CONFIG'				=> 'Không thể nhận thông tin cấu hình hệ thống.',
	'CONV_ERROR_GROUP_ACCESS'			=> 'Không thể nhận được thông tin xác thực nhóm.',
	'CONV_ERROR_INCONSISTENT_GROUPS'	=> 'Mâu thuẫn trong bảng dữ liệu <var>_groups</var> đã được phát hiện trong hàm thực thi <code>add_bots()</code>. Bạn cần phải thêm vào tất cả các nhóm đặc biệt nếu muốn tự mình thực hiện.',
	'CONV_ERROR_INSERT_BOT'				=> 'Không thể chèn thêm máy tìm kiếm vào bảng dữ liệu <var>_users</var>.',
	'CONV_ERROR_INSERT_BOTGROUP'		=> 'Không thể chèn thêm máy tìm kiếm vào bảng dữ liệu <var>_bots</var>.',
	'CONV_ERROR_INSERT_USER_GROUP'		=> 'Không thể chèn thêm người dùng vào bảng dữ liệu <var>_user_group</var>.',
	'CONV_ERROR_MESSAGE_PARSER'			=> 'Lỗi xử lí nội dung bài viết',
	'CONV_ERROR_NO_AVATAR_PATH'			=> 'Lưu ý dành cho những người phát triển: bạn phải xác định <code>$convertor[\'avatar_path\']</code> để sử dụng %s.',
	'CONV_ERROR_NO_FORUM_PATH'			=> 'Đường dẫn đến thư mục cài đặt hệ thống chưa được xác định.',
	'CONV_ERROR_NO_GALLERY_PATH'		=> 'Lưu ý dành cho những người phát triển: bạn phải xác định <code>$convertor[\'avatar_gallery_path\']</code> để sử dụng %s.',
	'CONV_ERROR_NO_GROUP'				=> 'Nhóm “%1$s” không thể tìm thấy trong %2$s.',
	'CONV_ERROR_NO_RANKS_PATH'			=> 'Lưu ý dành cho những người phát triển: bạn phải xác định <code>$convertor[\'ranks_path\']</code> để sử dụng %s.',
	'CONV_ERROR_NO_SMILIES_PATH'		=> 'Lưu ý dành cho những người phát triển: bạn phải xác định <code>$convertor[\'smilies_path\']</code> để sử dụng %s.',
	'CONV_ERROR_NO_UPLOAD_DIR'			=> 'Lưu ý dành cho những người phát triển: bạn phải xác định <code>$convertor[\'upload_path\']</code> để sử dụng %s.',
	'CONV_ERROR_PERM_SETTING'			=> 'Không thể chèn thêm/cập nhật thiết lập cấp phép.',
	'CONV_ERROR_PM_COUNT'				=> 'Không thể chọn thư mục để đếm số lượng tin nhắn.',
	'CONV_ERROR_REPLACE_CATEGORY'		=> 'Không thể chèn thêm chuyên mục mới để thay thế cho nhóm chuyên mục cũ.',
	'CONV_ERROR_REPLACE_FORUM'			=> 'Không thể chèn thêm chuyên mục mới để thay thế cho chuyên mục cũ.',
	'CONV_ERROR_USER_ACCESS'			=> 'Không thể nhận được thông tin xác thực người dùng.',
	'CONV_ERROR_WRONG_GROUP'			=> 'Nhóm không chính xác “%1$s” đã được chỉ định trong %2$s.',
	'CONV_OPTIONS_BODY'					=> 'Trang này thu thập những thông tin cần cho việc truy cập vào hệ thống nguồn. Bạn hãy nhập vào những thông tin chi tiết về cơ sở dữ liệu của hệ thống cũ mà bạn đã cài đặt. Công cụ chuyển đổi sẽ không thay đổi bất cứ thứ gì trong cơ sở dữ liệu mà bạn cung cấp. Hệ thống nguồn nên được tạm ngưng hoạt động để việc chuyển đổi diễn ra được suôn sẻ.',
	'CONV_SAVED_MESSAGES'				=> 'Nội dung đã lưu',
	'CONVERT'							=> 'Chuyển đổi',
	'CONVERT_COMPLETE'					=> 'Việc chuyển đổi đã hoàn tất',
	'CONVERT_COMPLETE_EXPLAIN'			=> 'Bạn đã chuyển đổi thành công hệ thống của mình sang hệ thống phpBB 3.2. Bạn có thể đăng nhập ngay bây giờ và <a href="../">truy cập vào hệ thống</a> của mình. Hãy chắc chắn rằng những thiết lập hệ thống đã được chuyển đổi sang chính xác trước khi bạn cho hệ thống hoạt động bằng cách xóa thư mục cài đặt đi. Bạn luôn được giúp đỡ từ cộng đồng trực tuyến trong việc sử dụng phpBB với <a href="https://www.phpbb.com/support/docs/en/3.2/ug/">tài liệu hướng dẫn sử dụng</a> và <a href="https://www.phpbb.com/community/viewforum.php?f=466">diễn đàn hỗ trợ</a>.',
	'CONVERT_INTRO'						=> 'Chào mừng bạn đã đến với công cụ phpBB Unified Convertor Framework',
	'CONVERT_INTRO_BODY'				=> 'Với công cụ này, bạn có thể chuyển đổi dữ liệu từ những hệ thống khác phpBB đã cài đặt trước đây sang hệ thống phpBB. Danh sách bên dưới liệt kê tất cả các gói chức năng chuyển đổi có sẵn hiện tại. Nếu như danh sách này không có gói chức năng chuyển đổi cho hệ thống mà bạn đang sử dụng, hãy ghé thăm trang chủ của chúng tôi để tải về và tìm hiểu nhiều thông tin hơn về các gói chức năng chuyển đổi sẵn có tại đây.',
	'CONVERT_NEW_CONVERSION'			=> 'Chuyển đổi mới',
	'CONVERT_NOT_EXIST'					=> 'Chuyển đổi vừa chọn không tồn tại.',
	'CONVERT_OPTIONS'					=> 'Tùy chọn',
	'COULD_NOT_FIND_PATH'				=> 'Không thể tìm thấy đường dẫn đến thư mục cài đặt hệ thống. Hãy kiểm tra thiết lập của bạn rồi thử lại.<br />» <strong>%s</strong> đã được xác định là đường dẫn nguồn.',

	'DATABASE_VERSION'							=> 'Phiên bản dữ liệu',
	'DB_CONFIG'									=> 'Cấu hình cơ sở dữ liệu',
	'DB_ERR_INSERT'								=> 'Có lỗi trong khi tiến hành truy vấn <code>INSERT</code>.',
	'DB_ERR_LAST'								=> 'Có lỗi trong khi tiến hành <var>query_last</var>.',
	'DB_ERR_QUERY_FIRST'						=> 'Có lỗi trong khi thực thi <var>query_first</var>.',
	'DB_ERR_QUERY_FIRST_TABLE'					=> 'Có lỗi trong khi thực thi <var>query_first</var>, %s (“%s”).',
	'DB_ERR_SELECT'								=> 'Có lỗi trong khi tiến hành truy vấn <code>SELECT</code>.',
	'DB_HOST'									=> 'Tên miền hoặc địa chỉ DSN của máy chủ cơ sở dữ liệu',
	'DB_HOST_EXPLAIN'							=> 'DSN là tên viết tắt của <strong>Data Source Name</strong> và chỉ được sử dụng khi bạn chọn cài đặt với ODBC. Trên PostgreSQL, sử dụng <samp>localhost</samp> để kết nối đến máy chủ thông qua giao thức tên miền UNIX và <samp>127.0.0.1</samp> để kết nối thông qua TCP. Với SQLite, bạn phải nhập đường dẫn đầy đủ đến tập tin cơ sở dữ liệu.',
	'DB_NAME'									=> 'Tên cơ sở dữ liệu',
	'DB_OPTION_MSSQL_ODBC'						=> 'MSSQL Server 2000+ qua ODBC',
	'DB_OPTION_MSSQLNATIVE'						=> 'MSSQL Server 2005+',
	'DB_OPTION_MYSQL'							=> 'MySQL',
	'DB_OPTION_MYSQLI'							=> 'MySQLi',
	'DB_OPTION_ORACLE'							=> 'Oracle',
	'DB_OPTION_POSTGRES'						=> 'PostgreSQL',
	'DB_OPTION_SQLITE3'							=> 'SQLite 3',
	'DB_PASSWORD'								=> 'Mật khẩu kết nối cơ sở dữ liệu',
	'DB_PORT'									=> 'Cổng máy chủ cơ sở dữ liệu',
	'DB_PORT_EXPLAIN'							=> 'Để trống mục này nếu như bạn không biết cổng tiêu chuẩn đang được sử dụng của máy chủ.',
	'DB_USERNAME'								=> 'Tên đăng nhập cơ sở dữ liệu',
	'DBMS'										=> 'Loại cơ sở dữ liệu',
	'DEFAULT_INSTALL_POST'						=> 'Đây là bài viết mẫu được tạo ra trong quá trình cài đặt hệ thống của bạn. Mọi thứ dường như đang hoạt động tốt. Bạn có thể xóa bài viết này nếu thích và tiếp tục công việc thiết lập hệ thống. Trong suốt quá trình thực thi cài đặt, nhóm chuyên mục và chuyên mục mẫu này đã được cấp phép hợp lệ sẵn cho các nhóm người dùng như: quản trị viên, điều hành viên, máy tìm kiếm, khách, người dùng đã đăng ký và người dùng theo điều khoản COPPA. Bạn cũng có thể xóa nhóm chuyên mục nháp và chuyên mục nháp này nhưng đừng quên cấp phép lại chuyên mục mỗi khi tạo mới sau này cho những nhóm người dùng bên trên. Chúng tôi khuyên bạn nên đổi tên nhóm chuyên mục nháp và chuyên mục nháp này. Sau đó, mỗi khi tạo mới chuyên mục, bạn hãy chọn sao chép thiết lập cấp phép từ chúng. Chúc vui vẻ!',
	'DEFAULT_LANGUAGE'							=> 'Ngôn ngữ mặc định',
	'DEFAULT_PREFIX_IS'							=> 'Công cụ chuyển đổi không thể tìm thấy những bảng dữ liệu với tên tiền tố mà bạn đã xác định. Hãy chắc chắn rằng bạn đã nhập thông tin chính xác về hệ thống mà bạn đang muốn chuyển đổi. Tiền tố mỗi tên bảng dữ liệu mặc định cho <strong>%1$s</strong> là <strong>%2$s</strong>.',
	'DEV_NO_TEST_FILE'							=> 'Không có giá trị nào được xác định cho biến <var>test_file</var> của gói chức năng chuyển đổi. Nếu bạn là người sử dụng gói chức năng chuyển đổi này, bạn không nên xem lỗi này mà hãy báo cáo cho tác giả của gói chức năng chuyển đổi. Còn nếu bạn là tác giả của gói chức năng chuyển đổi này, bạn phải xác định tên của một tập tin tồn tại trong thư mục nguồn của hệ thống để kiểm tra chính xác đường dẫn.',
	'DIRECTORY_NOT_EXISTS'						=> 'Thư mục không tồn tại',
	'DIRECTORY_NOT_EXISTS_EXPLAIN'				=> 'Để cài đặt phpBB, thư mục %1$s phải tồn tại.',
	'DIRECTORY_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Chúng tôi khuyến cáo thư mục %1$s nên tồn tại để tránh rắc rối sau này.',
	'DIRECTORY_NOT_WRITABLE'					=> 'Thư mục không thể ghi',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN'			=> 'Để cài đặt phpBB, thư mục %1$s directory phải ghi được.',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Chúng tôi khuyến cáo thư mục %1$s nên ghi được để tránh rắc rối sau này.',
	'DONE'										=> 'Hoàn tất',
	'DOWNLOAD'									=> 'Tải về',
	'DOWNLOAD_CONFLICTS'						=> 'Tải về bản lưu xung đột đã nhập chung',
	'DOWNLOAD_CONFLICTS_EXPLAIN'				=> 'Dò tìm ra &lt;&lt;&lt; những xung đột được phát hiện',
	'DOWNLOAD_UPDATE_METHOD'					=> 'Tải về các tập tin đã chỉnh sửa được lưu trữ',
	'DOWNLOAD_UPDATE_METHOD_EXPLAIN'			=> 'Sau khi đã tải về, bạn nên giải nén tập tin được lưu trữ ra. Bạn sẽ tìm thấy những tập tin đã được chỉnh sửa và đây là những tập tin bạn cần phải tự mình tải lên. Hãy tải chúng lên thư mục định vị tương ứng trong thư mục cài đặt hệ thống phpBB. Sau khi hoàn tất quá trình tải các tập tin lên, bạn có thể tiếp tục quá trình cập nhật.',

	'EMAIL_CONFIG'	=> 'Cấu hình email',

	'FILE_ALREADY_UP_TO_DATE'				=> 'Tập tin đã được cập nhật mới nhất.',
	'FILE_DIFF_NOT_ALLOWED'					=> 'Tập tin không được phép so sánh mã nguồn.',
	'FILE_DIFFER_ERROR_FILE_CANNOT_BE_READ'	=> 'Không thể mở tập tin %s để so sánh.',
	'FILE_NOT_EXISTS'						=> 'Tập tin không tồn tại',
	'FILE_NOT_EXISTS_EXPLAIN'				=> 'Để cài đặt phpBB, tập tin %1$s phải tồn tại.',
	'FILE_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Chúng tôi khuyến cáo tập tin %1$s nên tồn tại để tránh rắc rối sau này.',
	'FILE_NOT_WRITABLE'						=> 'Tập tin không thể ghi',
	'FILE_NOT_WRITABLE_EXPLAIN'				=> 'Để cài đặt phpBB, tập tin %1$s phải ghi được.',
	'FILE_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Chúng tôi khuyến cáo tập tin %1$s nên ghi được để tránh rắc rối sau này.',
	'FILE_USED'								=> 'Thông tin được sử dụng từ',
	'FILES_CONFLICT'						=> 'Những tập tin xung đột',
	'FILES_CONFLICT_EXPLAIN'				=> 'Những tập tin bên dưới đã được chỉnh sửa và không còn là những tập tin gốc của hệ thống phpBB phiên bản cũ. Hệ thống phpBB đã xác định rằng những tập tin này sẽ tạo ra xung đột nếu bạn cố gắng nhập chung chúng lại với nhau. Bạn hãy vui lòng kiểm tra lại các xung đột xuất hiện và cố gắng tự mình giải quyết các xung đột đó hoặc tiếp tục việc cập nhật bằng cách lựa chọn phương pháp nhập chung như trên. Nếu bạn tự mình giải quyết các xung đột, hãy kiểm tra lại các tập tin sau khi bạn đã chỉnh sửa chúng. Bạn cũng có thể lựa chọn phương pháp nhập chung mà mình thích sử dụng cho riêng mỗi tập tin. Phương pháp đầu tiên sẽ cho kết quả một tập tin mà trong đó những dòng mã nguồn gây xung đột trong các tập tin cũ của bạn sẽ bị loại bỏ, phương pháp còn lại sẽ cho kết quả một tập tin đã loại bỏ những thay đổi từ tập tin mới.',
	'FILES_DELETED'							=> 'Những tập tin đã xóa',
	'FILES_DELETED_EXPLAIN'					=> 'Những tập tin bên dưới không còn được sử dụng trong phiên bản mới và cần được xóa khỏi bản cài đặt hiện tại.',
	'FILES_MODIFIED'						=> 'Những tập tin đã chỉnh sửa',
	'FILES_MODIFIED_EXPLAIN'				=> 'Những tập tin bên dưới đã được chỉnh sửa và không còn là những tập tin gốc của hệ thống phpBB phiên bản cũ. Tập tin đã cập nhật là tập tin được nhập chung giữa những chỉnh sửa mã nguồn của bạn với tập tin mới.',
	'FILES_NEW'								=> 'Những tập tin mới',
	'FILES_NEW_CONFLICT'					=> 'Những tập tin xung đột mới',
	'FILES_NEW_CONFLICT_EXPLAIN'			=> 'Những tập tin bên dưới là tập tin mới trong phiên bản phpBB mới nhất nhưng hệ thống đã xác định rằng có một tập tin cùng tên như vậy trong cùng vị trí thư mục định vị. Tập tin này sẽ được thay thế bằng một tập tin mới.',
	'FILES_NEW_EXPLAIN'						=> 'Những tập tin bên dưới hiện tại không có trong bản cài đặt của bạn. Chúng sẽ được thêm vào bản cài đặt này.',
	'FILES_NOT_MODIFIED'					=> 'Những tập tin chưa chỉnh sửa',
	'FILES_NOT_MODIFIED_EXPLAIN'			=> 'Những tập tin bên dưới không được chỉnh sửa và là những tập tin gốc của hệ thống phpBB phiên bản cũ mà bạn đang tiến hành cập nhật lên phiên bản mới.',
	'FILES_UP_TO_DATE'						=> 'Những tập tin đã được cập nhật',
	'FILES_UP_TO_DATE_EXPLAIN'				=> 'Những tập tin bên dưới đã được cập nhật đến phiên bản mới nhất và bạn không cần phải cập nhật lại chúng.',
	'FILES_VERSION'							=> 'Phiên bản tập tin',
	'FILLING_TABLE'							=> 'Điền vào bảng dữ liệu <strong>%s</strong>',
	'FILLING_TABLES'						=> 'Bảng dữ liệu điền vào',
	'FINAL_STEP'							=> 'Thực thi bước cuối cùng',
	'FORUM_PATH'							=> 'Đường dẫn hệ thống',
	'FORUM_PATH_EXPLAIN'					=> 'Đường dẫn đến thư mục gốc cài đặt hệ thống phpBB trên máy chủ của bạn',
	'FORUMS_FIRST_CATEGORY'					=> 'Nhóm chuyên mục nháp',
	'FORUMS_TEST_FORUM_DESC'				=> 'Nội dung giới thiệu của chuyên mục nháp.',
	'FORUMS_TEST_FORUM_TITLE'				=> 'Chuyên mục nháp',
	'FTP_SETTINGS'							=> 'Thiết lập FTP',

	'INCOMPATIBLE_UPDATE_FILES'		=> 'Những tập tin cập nhật đã được tìm thấy nhưng không tương thích với phiên bản phpBB mà bạn đang sử dụng. Phiên bản phpBB mà bạn đã cài đặt là <strong>%1$s</strong> trong khi tập tin cập nhật dành cho việc cập nhật hệ thống phpBB từ phiên bản <strong>%2$s</strong> lên phiên bản <strong>%3$s</strong>.',
	'INLINE_UPDATE_SUCCESSFUL'		=> 'Đã cập nhật cơ sở dữ liệu thành công.',
	'INST_ERR_DB_CONNECT'			=> 'Không thể kết nối đến cơ sở dữ liệu, bạn hãy xem thông báo lỗi bên dưới để biết lý do.',
	'INST_ERR_DB_FORUM_PATH'		=> 'Tập tin cơ sở dữ liệu vừa chọn đang nằm trong thư mục cài đặt của hệ thống. Bạn không nên để tập tin này trong các thư mục của máy chủ.',
	'INST_ERR_DB_INVALID_PREFIX'	=> 'Tiền tố bạn nhập không hợp lệ. Nó phải bắt đầu bằng một chữ cái và chỉ chứa chữ cái, số và dấu gạch dưới.',
	'INST_ERR_DB_NO_ERROR'			=> 'Không có thông báo lỗi nào được đưa ra.',
	'INST_ERR_DB_NO_MYSQLI'			=> 'Phiên bản MySQL được cài đặt trên máy chủ không tương thích với tùy chọn “MySQL với phần mở rộng MySQLi” mà bạn vừa chọn. Hãy thử thay thế bằng tùy chọn “MySQL” để tiếp tục.',
	'INST_ERR_DB_NO_NAME'			=> 'Bạn chưa nhập tên cơ sở dữ liệu.',
	'INST_ERR_DB_NO_ORACLE'			=> 'Phiên bản Oracle được cài đặt trên máy chủ yêu cầu bạn phải thiết lập thông số <var>NLS_CHARACTERSET</var> thành <var>UTF-8</var>. Bạn hãy vui lòng nâng cấp hệ thống lên phiên bản 9.2+ hoặc chỉ cần thay đổi lại thông số trên.',
	'INST_ERR_DB_NO_POSTGRES'		=> 'Cơ sở dữ liệu vừa chọn không được tạo ra trong chế độ mã hóa <var>UNICODE</var> hoặc <var>UTF-8</var>. Bạn hãy vui lòng cài đặt lại với một cơ sở dữ liệu được mã hóa theo <var>UNICODE</var> hoặc <var>UTF-8</var>.',
	'INST_ERR_DB_NO_SQLITE3'		=> 'Phiên bản phần mở rộng SQLite được cài đặt trên máy chủ đã quá cũ. Vui lòng nâng cấp ít nhất đến phiên bản 3.6.15.',
	'INST_ERR_DB_NO_WRITABLE'		=> 'Cơ sở dữ liệu và thư mục chứa chúng phải ghi được.',
	'INST_ERR_EMAIL_INVALID'		=> 'Địa chỉ email bạn nhập không hợp lệ.',
	'INST_ERR_MISSING_DATA'			=> 'Bạn phải điền đầy đủ thông tin trong phần này.',
	'INST_ERR_NO_DB'				=> 'Không thể nạp gói chức năng PHP cho loại cơ sở dữ liệu đã chọn.',
	'INST_ERR_PASSWORD_MISMATCH'	=> 'Mật khẩu bạn nhập không phù hợp.',
	'INST_ERR_PASSWORD_TOO_LONG'	=> 'Mật khẩu bạn nhập quá dài. Mật khẩu không được phép vượt quá <strong>30</strong> ký tự.',
	'INST_ERR_PASSWORD_TOO_SHORT'	=> 'Mật khẩu bạn nhập quá ngắn. Mật khẩu không được phép ít hơn <strong>6</strong> ký tự.',
	'INST_ERR_PREFIX'				=> 'Tiền tố của mỗi tên bảng dữ liệu bạn vừa xác định đã được sử dụng, hãy vui lòng chọn một tên khác.',
	'INST_ERR_PREFIX_TOO_LONG'		=> 'Tiền tố của mỗi tên bảng dữ liệu bạn vừa xác định quá dài. Số ký tự tối đa được phép sử dụng là <strong>%d</strong>.',
	'INST_ERR_USER_TOO_LONG'		=> 'Tên tài khoản bạn nhập quá dài. Số ký tự tối đa được phép sử dụng là <strong>20</strong>.',
	'INST_ERR_USER_TOO_SHORT'		=> 'Tên tài khoản bạn nhập quá ngắn. Số kú tự tối thiểu phải sử dụng là <strong>3</strong>.',
	'INST_SCHEMA_FILE_NOT_WRITABLE'	=> 'Tập tin cấu trúc dữ liệu không thể ghi',
	'INSTALL_INTRO'					=> 'Chuẩn bị trước khi cài đặt',
	'INSTALL_INTRO_BODY'			=> 'Với công cụ này, bạn sẽ bắt đầu quá trình cài đặt hệ thống phpBB3 trên máy chủ của mình.</p><p>Để bắt đầu cài đặt, bạn phải cung cấp cho công cụ cài đặt những thông tin về cơ sở dữ liệu của mình. Nếu bạn không biết thông tin về cơ sở dữ liệu này, hãy vui lòng liên hệ với nhà cung cấp dịch vụ lưu trữ Web của bạn và yêu cầu họ cung cấp cho bạn. Bạn sẽ không thể tiếp tục cài đặt mà thiếu những thông tin này. Bạn cần biết:</p>

	<ul>
		<li>Loại cơ sở dữ liệu - hệ quản trị cơ sở dữ liệu mà bạn sẽ sử dụng cho hệ thống.</li>
		<li>Tên miền hoặc địa chỉ DSN của máy chủ cơ sở dữ liệu - địa chỉ của máy chủ cơ sở dữ liệu.</li>
		<li>Cổng máy chủ cơ sở dữ liệu - cổng của máy chủ cơ sở dữ liệu đang chạy. Đa số khi cài đặt thì mục này không cần thiết.</li>
		<li>Tên cơ sở dữ liệu - tên của gói cơ sở dữ liệu mà bạn đang dùng để cài đặt trên máy chủ.</li>
		<li>Tên đăng nhập và mật khẩu kết nối đến cơ sở dữ liệu - thông tin đăng nhập để truy cập vào cơ sở dữ liệu.</li>
	</ul>

	<p><strong>Lưu ý:</strong> Nếu bạn cài đặt hệ thống với SQLite, bạn nên nhập vào đường dẫn đầy đủ đến tập tin cơ sở dữ liệu của bạn trong phần thông tin về địa chỉ DSN cũng như để trống phần tên đăng nhập và mật khẩu kết nối đến cơ sở dữ liệu. Vì lý do bảo mật, bạn phải chắc chắn rằng tập tin cơ sở dữ liệu lưu trữ trong thư mục trên máy chủ đó không thể truy cập được từ trình duyệt.</p>

	<p>Hệ thống phpBB hỗ trợ các hệ quản trị cơ sở dữ liệu dưới đây:</p>
	<ul>
		<li>MySQL 3.23 trở lên (hỗ trợ MySQLi)</li>
		<li>PostgreSQL 8.3+</li>
		<li>SQLite 3.6.15+</li>
		<li>MS SQL Server 2000 trở lên (trực tiếp hoặc thông qua ODBC)</li>
		<li>MS SQL Server 2005 trở lên (tự nhiên)</li>
		<li>Oracle</li>
	</ul>

	<p>Trong những hệ quản trị cơ sở dữ liệu được hỗ trợ bên trên, chỉ những loại nào có sẵn trên máy chủ của bạn mới được hiển thị trong tùy chọn khi cài đặt.',
	'INSTALL_PANEL'					=> 'Bảng cài đặt',
	'INSTALL_PHPBB_INSTALLED'		=> 'phpBB đã cài đặt rồi.',
	'INSTALL_PHPBB_NOT_INSTALLED'	=> 'phpBB chưa được cài đặt.',
	'INSTALL_TEST'					=> 'Kiểm tra lại',
	'INSTALLER_CONFIG_NOT_WRITABLE'	=> 'Tập tin cấu hình cài đặt không thể ghi.',
	'INSTALLER_FINISHED'			=> 'Đã cài đặt thành công',
	'INTRODUCTION_BODY'				=> 'Chào mừng bạn bước vào thế giới phpBB3!<br /><br />phpBB® là phần mềm diễn đàn mã nguồn mở được sử dụng rộng rãi trên thế giới. phpBB3 là dòng phiên bản mới nhất từ khi phần mềm này được phát hành lần đầu vào năm 2000. Giống như những phiên bản trước, phpBB3 có rất nhiều chức năng hữu ích, giao diện người dùng thân thiện và được hỗ trợ tận tình bởi các thành viên trong ban điều hành phpBB. phpBB3 cải thiện những gì phpBB2 đã có và bổ sung thêm những chức năng thông dụng được yêu cầu từ người dùng mà chưa hề có trong các phiên bản trước. Chúng tôi hi vọng nó sẽ đáp ứng được sự mong chờ của bạn.<br /><br />Hệ thống cài đặt này sẽ hướng dẫn bạn từng bước cài đặt phpBB3, cập nhật đến phiên bản phpBB3 mới nhất từ các bản phát hành cũ và tuyệt vời hơn là chuyển đổi đến phpBB3 từ các hệ thống diễn đàn khác (bao gồm cả phpBB2). Để khám phá nhiều hơn về phpBB3, chúng tôi khuyên bạn nên đọc qua <a href="../docs/INSTALL.html">tài liệu cài đặt</a>.<br /><br />Để xem bản quyền của phpBB3 hay muốn tìm hiểu về việc hỗ trợ và quan điểm phát triển của chúng tôi về sản phẩm này, bạn có thể chọn xem các mục tương ứng từ trình đơn. Để tiếp tục, hãy vui lòng chọn thao tác bạn muốn thực hiện.',
	'INTRODUCTION_TITLE'			=> 'Giới thiệu',
	'INVALID_YAML_FILE'				=> 'Không thể xử lý tập tin YAML %1$s',

	'LICENSE_TITLE'	=> 'Giấy phép nguồn mở GPL',

	'MAKE_FOLDER_WRITABLE'			=> 'Hãy chắc chắn rằng thư mục này đã có sẵn trong hệ thống và có thể ghi được trên máy chủ rồi thử lại:<br />»<strong>%s</strong>.',
	'MAKE_FOLDERS_WRITABLE'			=> 'Hãy chắc chắn rằng những thư mục này đã có sẵn trong hệ thống và có thể ghi được trên máy chủ rồi thử lại:<br />»<strong>%s</strong>.',
	'MENU_INTRO'					=> 'Giới thiệu',
	'MENU_LICENSE'					=> 'Giấy phép',
	'MENU_OVERVIEW'					=> 'Tổng quan',
	'MENU_SUPPORT'					=> 'Hỗ trợ',
	'MISSING_DATA'					=> 'Tập tin cấu hình bị thiếu dữ liệu hoặc chứa thiết lập không hợp lệ.',
	'MISSING_FILE'					=> 'Không thể truy cập tập tin %1$s',
	'MODULE_NOT_FOUND'				=> 'Không tìm thấy gói chức năng',
	'MODULE_NOT_FOUND_DESCRIPTION'	=> 'Không tìm thấy gói chức năng vì dịch vụ %s chưa được chỉ định.',

	'NAMING_CONFLICT'				=> 'Xung đột trong việc đặt tên: “%s” và “%s” đều là tên không được phép sử dụng<br /><br />%s',
	'NO_CONVERTORS'					=> 'Không chuyển đổi nào có sẵn đề sử dụng.',
	'NO_TABLES_FOUND'				=> 'Không tìm thấy bảng dữ liệu nào.',
	'NO_UPDATE_FILES_UP_TO_DATE'	=> 'Phiên bản phpBB của bạn là phiên bản mới nhất hiện tại. Bạn không cần sử dụng đến công cụ cập nhật. Nếu bạn muốn thực hiện kiểm tra lại toàn bộ các tập tin của bạn, hãy chắc chắn rằng bạn đã tải lên những tập tin cập nhật chính xác.',
	'NOT_UNDERSTAND'				=> 'Không hiểu %s #%d, bảng dữ liệu “%s” (“%s”)',

	'OLD_UPDATE_FILES'	=> 'Những tập tin cập nhật này là dành cho phiên bản cũ. Những tập tin cập nhật này được xác định là dành cho việc cập nhật hệ thống phpBB từ phiên bản %1$s lên phiên bản %2$s trong khi phiên bản phpBB mới nhất là %3$s.',

	'PACKAGE_VERSION'					=> 'Phiên bản đóng gói',
	'PCRE_UTF_SUPPORT'					=> 'Hỗ trợ UTF-8 trong PCRE',
	'PCRE_UTF_SUPPORT_EXPLAIN'			=> 'Không thể sử dụng phpBB với phiên bản PHP không hỗ trợ UTF-8 thông qua phần mở rộng PCRE.',
	'PHP_GETIMAGESIZE_SUPPORT'			=> 'Hàm PHP getimagesize() được yêu cầu',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'	=> 'Đảm bảo cho hệ thống phpBB hoạt động ổn định.',
	'PHP_JSON_SUPPORT'					=> 'Hỗ trợ JSON cho PHP',
	'PHP_JSON_SUPPORT_EXPLAIN'			=> 'Để các chức năng của hệ thống phpBB hoạt động chính xác, phần mở rộng JSON phải đi kèm với bản cài đặt PHP trên máy chủ.',
	'PHP_SUPPORTED_DB'					=> 'Loại cơ sở dữ liệu được hỗ trợ',
	'PHP_SUPPORTED_DB_EXPLAIN'			=> 'Máy chủ của bạn ít nhất phải hỗ trợ một loại cơ sở dữ liệu tương thích với PHP. Nếu không có bất cứ gói chức năng cơ sở dữ liệu nào có sẵn để sử dụng, bạn nên liên hệ với nhà cung cấp dịch vụ lưu trữ Web của mình hoặc xem lại tài liệu cài đặt PHP để tìm thấy lời khuyên.',
	'PHP_VERSION_REQD'					=> 'Phiên bản PHP',
	'PHP_VERSION_REQD_EXPLAIN'			=> 'phpBB yêu cầu phiên bản PHP 5.4.0 trở lên.',
	'PHP_XML_SUPPORT'					=> 'Hỗ trợ XML/DOM cho PHP',
	'PHP_XML_SUPPORT_EXPLAIN'			=> 'Đảm bảo cho hệ thống phpBB hoạt động ổn định.',
	'PRE_CONVERT_COMPLETE'				=> 'Các bước chuyển đổi nhỏ đã hoàn tất. Bạn đang bắt đầu tiến trình chuyển đổi quan trọng. Lưu ý rằng có thể bạn sẽ phải tự điều chỉnh một vài thứ. Sau khi chuyển đổi xong, hãy kiểm tra thật kỹ lưỡng các thiết lập cấp phép được gán, tạo lại chỉ mục tìm kiếm và chắc chắn đã sao chép đủ hết các tập tin dữ liệu thành viên. Ví dụ như hình đại diện và biểu tượng vui.',
	'PRE_CONVERT_COMPLETE'				=> 'Tất cả các bước kiểm tra trước việc chuyển đổi đã hoàn tất. Bây giờ bạn thực sự bắt đầu việc chuyển đổi hệ thống. Lưu ý rằng bạn có thể phải tự mình điều chỉnh lại một vài thiết lập. Sau khi chuyển đổi, bạn hãy kiểm tra lại cẩn thận những thiết lập cấp phép đã được chỉ định, tạo lại chỉ mục tìm kiếm mới cho hệ thống của bạn nếu cần thiết và bạn cũng phải chắc chắn rằng những tập tin đã được sao chép chính xác, ví dụ như những tập tin hình đại diện và biểu tượng vui.',
	'PREPROCESS_STEP'					=> 'Đang thực thi quá trình kiểm tra trước các <var>function/query</var>',
	'PROCESS_LAST'						=> 'Tiến hành lệnh thực thi trước',

	'RANKS_SITE_ADMIN_TITLE'	=> 'Quản trị viên',
	'REFRESH_PAGE'				=> 'Nạp lại trang để tiếp tục việc chuyển đổi',
	'REFRESH_PAGE_EXPLAIN'		=> 'Nếu bạn bật tùy chọn này, công cụ chuyển đổi sẽ tự động nạp lại trang để tiếp tục quá trình chuyển đổi hệ thống sau khi hoàn thành xong mỗi bước. Nếu đây là lần đầu tiên bạn thực hiện việc chuyển đổi hệ thống nhằm mục đích kiểm tra thử và xác định bất kì lỗi nào có thể xảy ra trước, chúng tôi đề nghị bạn đừng nên bật tùy chọn này.',
	'REPORT_OFF_TOPIC'			=> 'Bài viết có nội dung không phù hợp.',
	'REPORT_OTHER'				=> 'Bài viết đã báo cáo không phải vì các lý do đã liệt kê ở trên, bạn hãy tự nhập vào thông tin giới thiệu chi tiết.',
	'REPORT_SPAM'				=> 'Bài viết chỉ nhằm mục đích quảng cáo cho một website hay các sản phẩm khác.',
	'REPORT_WAREZ'				=> 'Bài viết có chứa các liên kết liên quan đến những phần mềm sao chép trái pháp luật.',
	'RETEST_REQUIREMENTS'		=> 'Kiểm tra lại yêu cầu',

	'SCRIPT_PATH'						=> 'Đường dẫn',
	'SCRIPT_PATH_EXPLAIN'				=> 'Đường dẫn đến thư mục cài đặt hệ thống phpBB, xác định bởi tên miền, ví dụ như <samp>/phpBB3</samp>.',
	'SELECT_DOWNLOAD_FORMAT'			=> 'Chọn định dạng tập tin tải về',
	'SELECT_LANG'						=> 'Chọn ngôn ngữ',
	'SERVER_CONFIG'						=> 'Cấu hình máy chủ',
	'SKIP_MODULE'						=> 'Bỏ qua gói chức năng “%s”',
	'SKIP_TASK'							=> 'Bỏ qua thao tác “%s”',
	'SMILIES_ARROW'						=> 'Nhìn nè',
	'SMILIES_CONFUSED'					=> 'Nghe ai giờ',
	'SMILIES_COOL'						=> 'Yêu đời quá',
	'SMILIES_CRYING'					=> 'Hu hu',
	'SMILIES_EMARRASSED'				=> 'Ngại quá',
	'SMILIES_EVIL'						=> 'Điên rồi nha',
	'SMILIES_EXCLAMATION'				=> 'Bó tay',
	'SMILIES_GEEK'						=> 'Đồ lập dị',
	'SMILIES_IDEA'						=> 'Tui nghĩ vậy',
	'SMILIES_LAUGHING'					=> 'Ha ha',
	'SMILIES_MAD'						=> 'Đừng chọc à',
	'SMILIES_MR_GREEN'					=> 'Gớm quá',
	'SMILIES_NEUTRAL'					=> 'Miễn bàn',
	'SMILIES_QUESTION'					=> 'Hiểu chết liền',
	'SMILIES_RAZZ'						=> 'Chế giễu',
	'SMILIES_ROLLING_EYES'				=> 'Cưng ơi',
	'SMILIES_SAD'						=> 'Chán',
	'SMILIES_SHOCKED'					=> 'Sốc quá',
	'SMILIES_SMILE'						=> 'Hi hi',
	'SMILIES_SURPRISED'					=> 'Má ơi',
	'SMILIES_TWISTED_EVIL'				=> 'He he',
	'SMILIES_UBER_GEEK'					=> 'Đồ gà',
	'SMILIES_VERY_HAPPY'				=> 'Là lá la',
	'SMILIES_WINK'						=> 'Hiểu chưa cưng',
	'SOFTWARE'							=> 'Phần mềm diễn đàn',
	'SPECIFY_OPTIONS'					=> 'Xác định tùy chọn chuyển đổi',
	'STAGE_ADMINISTRATOR'				=> 'Thông tin về quản trị viên',
	'STAGE_DATABASE'					=> 'Thiết lập cơ sở dữ liệu',
	'STAGE_IN_PROGRESS'					=> 'Quá trình chuyển đổi đang được tiến hành',
	'STAGE_INSTALL'						=> 'Đang cài đặt',
	'STAGE_OBTAIN_DATA'					=> 'Nhập dữ liệu cài đặt',
	'STAGE_REQUIREMENTS'				=> 'Kiểm tra yêu cầu',
	'STAGE_SETTINGS'					=> 'Thiết lập',
	'STAGE_UPDATE_DATABASE'				=> 'Cập nhật cơ sở dữ liệu',
	'STAGE_UPDATE_FILES'				=> 'Cập nhật tập tin',
	'STARTING_CONVERT'					=> 'Bắt đầu tiến hành chuyển đổi',
	'STEP_PERCENT_COMPLETED'			=> 'Bước <strong>%d</strong> trong tổng số <strong>%d</strong> bước',
	'SUB_INTRO'							=> 'Giới thiệu',
	'SUPPORT_BODY'						=> 'Việc hỗ trợ được cung cấp đầy đủ cho bản phát hành chuẩn hiện tại của phpBB3, hoàn toàn miễn phí và phi lợi nhuận. Việc hỗ trợ này bao gồm:</p><ul><li>Cài đặt.</li><li>Cấu hình.</li><li>Các câu hỏi chuyên môn.</li><li>Các rắc rối liên quan đến những lỗi tiềm tàng trong phần mềm.</li><li>Cập nhật từ các phiên bản RC (Release Candidate) đến bản phát hành chuẩn mới nhất.</li><li>Nâng cấp từ phpBB 2.0.x lên phpBB3.</li><li>Chuyển đổi từ phần mềm diễn đàn khác sang phpBB3 (vui lòng xem qua chuyên mục <a href="https://www.phpbb.com/community/viewforum.php?f=65">Các công cụ chuyển đổi</a>).</li></ul><p>Chúng tôi khuyến cáo nếu bạn vẫn còn sử dụng các phiên bản thử nghiệm (Beta) của phpBB3 hãy thay thế ngay những bản cài đặt này bằng một bản chuẩn của phiên bản mới nhất.</p><h2>Các gói mở rộng / Giao diện</h2><p>Về những câu hỏi liên quan đến các gói mở rộng, bạn hãy vui lòng gửi trong chuyên mục <a href="https://www.phpbb.com/community/viewforum.php?f=451">Các gói mở rộng</a> thích hợp.<br />Về những câu hỏi liên quan đến giao diện, khuôn mẫu và kiểu dáng, hãy vui lòng gửi trong chuyên mục <a href="https://www.phpbb.com/community/viewforum.php?f=471">Giao diện</a> thích hợp.<br /><br />Nếu câu hỏi của bạn có liên quan đến một công cụ xác định, hãy vui lòng gửi trực tiếp trong chủ đề đã dành cho công cụ đó.</p><h2>Hỗ trợ sử dụng</h2><p><a href="https://www.phpbb.com/community/viewtopic.php?f=14&amp;t=571070">Giới thiệu chào mừng đến với phpBB</a><br /><a href="https://www.phpbb.com/support/">Khu vực hỗ trợ</a><br /><a href="https://www.phpbb.com/support/docs/en/3.1/ug/quickstart/">Tài liệu cho người mới bắt đầu</a><br /><br />Để chắc chắn bạn luôn sử dụng phiên bản mới nhất và nắm bắt các tin tức mới nhất của phần mềm này, tại sao bạn không tham gia vào <a href="https://www.phpbb.com/support/">danh sách thông báo qua email</a> của chúng tôi?<br /><br />',
	'SUPPORT_TITLE'						=> 'Hỗ trợ',
	'SYNC_FORUMS'						=> 'Bắt đầu đồng bộ hóa các chuyên mục',
	'SYNC_POST_COUNT'					=> 'Đang đồng bộ <var>post_counts</var>',
	'SYNC_POST_COUNT_ID'				=> 'Đang đồng bộ <var>post_counts</var> từ <var>mục</var> %1$s đến %2$s.',
	'SYNC_TOPIC_ID'						=> 'Đang đồng bộ những chủ đề có <var>topic_id</var> từ <strong>%1$s</strong> đến <strong>%2$s</strong>.',
	'SYNC_TOPICS'						=> 'Bắt đầu đồng bộ hóa các chủ đề',

	'TABLE_PREFIX'						=> 'Tiền tố cho mỗi bảng dữ liệu',
	'TABLE_PREFIX_EXPLAIN'				=> 'Tiền tố là phần ký tự xuất hiện đầu trước mỗi tên bảng dữ liệu. Nó phải bắt đầu bằng một chữ cái và chỉ chứa chữ cái, số và dấu gạch dưới.',
	'TABLE_PREFIX_SAME'					=> 'Tiền tố trước tên mỗi bảng dữ liệu đã được sử dụng bởi hệ thống mà bạn đang muốn chuyển đổi sang phpBB.<br />» Tiền tố đã được xác định là “%s”.',
	'TABLES_MISSING'					=> 'Không thể tìm thấy những bảng dữ liệu sau<br />» <strong>%s</strong>.',
	'TASK_ADD_BOTS'						=> 'Đang tạo máy tìm kiếm',
	'TASK_ADD_CONFIG_SETTINGS'			=> 'Đang tạo mục cấu hình',
	'TASK_ADD_DEFAULT_DATA'				=> 'Đang tạo dữ liệu mặc định',
	'TASK_ADD_LANGUAGES'				=> 'Đang cài đặt gói ngôn ngữ',
	'TASK_ADD_MODULES'					=> 'Đang cài đặt gói chức năng',
	'TASK_CLASS_NOT_FOUND'				=> 'Tên định danh dịch vụ cài đặt không hợp lệ. Tên dịch vụ “%1$s” được dùng, nhưng lại khai báo namespace là “%2$s”. Để biết thêm thông tin, hãy tham khảo tài liệu về <var>task_interface</var>.',
	'TASK_CREATE_CONFIG_FILE'			=> 'Đang tạo tập tin cấu hình',
	'TASK_CREATE_DATABASE_SCHEMA_FILE'	=> 'Đang tạo tập tin cấu trúc dữ liệu',
	'TASK_CREATE_SEARCH_INDEX'			=> 'Đang tạo chỉ mục tìm kiếm',
	'TASK_CREATE_TABLES'				=> 'Đang tạo bảng dữ liệu',
	'TASK_INSTALL_EXTENSIONS'			=> 'Đang cài đặt phần mở rộng đi kèm',
	'TASK_NOT_FOUND'					=> 'Không tìm thấy thao tác',
	'TASK_NOT_FOUND_DESCRIPTION'		=> 'Không tìm thấy thao tác vì dịch vụ %s chưa được chỉ định.',
	'TASK_NOTIFY_USER'					=> 'Đang gửi email thông báo',
	'TASK_POPULATE_MIGRATIONS'			=> 'Đang xử lý dữ liệu nâng cấp',
	'TASK_SERVICE_INSTALLER_MISSING'	=> 'Tất cả dịch vụ liên quan cài đặt nên khởi tạo với “installer”',
	'TASK_SETUP_DATABASE'				=> 'Đang thiết lập cơ sở dữ liệu',
	'TASK_UPDATE_EXTENSIONS'			=> 'Đang cập nhật phần mở rộng',
	'TIMEOUT_DETECTED_MESSAGE'			=> 'Quá thời gian chờ đợi cài đặt. Bạn có thể thử tải lại trang này, dù nó có thể gây gián đoạn dữ liệu. Chúng tôi khuyên bạn nên tăng thời gian chờ xử lý của PHP hoặc sử dụng giao diện dòng lệnh thay thế.',
	'TIMEOUT_DETECTED_TITLE'			=> 'Quá thời gian chờ đợi cài đặt',
	'TOGGLE_DISPLAY'					=> 'Hiện/Ẩn danh sách tập tin',
	'TOPICS_TOPIC_TITLE'				=> 'Chào mừng bạn đến với phpBB',

	'UPDATE_CHECK_FILES'				=> 'Kiểm tra tập tin cần cập nhật',
	'UPDATE_CONTINUE_FILE_UPDATE'		=> 'Cập nhật tập tin',
	'UPDATE_CONTINUE_UPDATE_PROCESS'	=> 'Tiếp tục tiền trình cập nhật',
	'UPDATE_FILE_DIFF'					=> 'Đang so sánh tập tin thay đổi',
	'UPDATE_FILE_METHOD'				=> 'Phương thức cập nhật tập tin',
	'UPDATE_FILE_METHOD_DOWNLOAD'		=> 'Tải về tập tin đã chỉnh sửa',
	'UPDATE_FILE_METHOD_FILESYSTEM'		=> 'Cập nhật trực tiếp tập tin (Tự động)',
	'UPDATE_FILE_METHOD_FTP'			=> 'Cập nhật tập tin qua FTP (Tự động)',
	'UPDATE_FILE_METHOD_TITLE'			=> 'Phương thức cập nhật tập tin',
	'UPDATE_FILE_UPDATER_HAS_FAILED'	=> 'Có lỗi khi cập nhật tập tin “%1$s”. Công cụ cài đặt sẽ cố gắng khôi phục lại “%2$s”.',
	'UPDATE_FILE_UPDATERS_HAVE_FAILED'	=> 'Có lỗi khi cập nhật tập tin. Không có cách nào để khôi phục lại.',
	'UPDATE_FILES_NOT_FOUND'			=> 'Không tìm thấy thư mục cập nhật. Hãy chắc chắn bạn đã tải lên đầy đủ.',
	'UPDATE_INCOMPLETE'					=> 'Bản cài đặt phpBB của bạn chưa được cập nhật hoàn tất.',
	'UPDATE_INCOMPLETE_EXPLAIN'			=> '<h1>Cập nhật chưa hoàn tất</h1>
		<p>Hệ thống phát hiện lần cập nhật cuối của bạn chưa hoàn tất. Vui lòng chạy công cụ <a href="%1$s" title="%1$s">cập nhật cơ sở dữ liệu</a>, chọn mục <em>Chỉ cập nhật dữ liệu</em> và bấm thực thi. Đừng quên xóa thư mục “install” sau khi đã cập nhật thành công.</p>',
	'UPDATE_INCOMPLETE_MORE'			=> 'Vui lòng thực hiện theo hướng dẫn bên dưới để sữa lỗi này.',
	'UPDATE_INSTALLATION'				=> 'Cập nhật bản cài đặt của phpBB',
	'UPDATE_INSTALLATION_EXPLAIN'		=> 'Với tùy chọn này, bạn có thể cập nhật cho bản cài đặt phpBB của mình lên phiên bản mới nhất của phpBB.<br />Trong suốt quá trình thực thi, tất cả các tập tin của bạn sẽ được kiểm tra để đảm bảo tính toàn bộ chưa được chỉnh sửa mã nguồn. Bạn cũng có thể xem trước tất cả thay đổi mã nguồn và tập tin trước khi bắt đầu cập nhật.<br /><br />Tập tin được cập nhật hoàn tất có thể bằng hai cách.</p><h2>Tự mình cập nhật</h2><p>Với phương pháp cập nhật này, bạn chỉ việc tải về những tập tin mà bạn đã chỉnh sửa cá nhân so với tập tin gốc của hệ thống. Điều này giúp bạn không bị mất đi các tập tin mà mình đã chỉnh sửa. Sau khi đã tải về máy thành công, bạn cần phải tự mình tải lên lại những tập tin này đến thư mục định vị chính xác của chúng trong thư mục cài đặt hệ thống phpBB. Khi đã tải lên xong, bạn có thể tiến hành kiểm tra lại các tập tin này để chắc chắn rằng mình đã tải chúng lên đúng thư mục định vị trong hệ thống.</p><h2>Cập nhật tự động với FTP</h2><p>Phương pháp này tương tự như phương pháp đầu tiên nhưng bạn không cần phải tải về những tập tin đã chỉnh sửa rồi phải tải chúng lên trở lại thư mục định vị trong hệ thống. Quá trình này sẽ được thực hiện tự động cho bạn. Ngoài ra, để sử dụng được phương pháp cập nhật này, bạn phải cung cấp thông tin chính xác về tài khoản FTP của mình khi được hệ thống yêu cầu. Sau khi hoàn tất, bạn sẽ được chuyển đến công cụ kiểm tra tập tin để chắc chắn rằng mọi thứ đã được cập nhật chính xác. Cuối cùng, bạn sẽ được chuyển đến công cụ cập nhật cơ sở dữ liệu để hoàn tất toàn bộ quá trình cập nhật cho hệ thống.',
	'UPDATE_INSTRUCTIONS'				=> '

		<h1>Thông báo phát hành</h1>

		<p>Bạn hãy vui lòng xem qua thông báo phát hành của phiên bản phpBB mới nhất trước khi bạn tiếp tục tiến hành việc cập nhật của mình bởi vì nó có nhiều thông tin hữu ích dành cho bạn. Thông báo này cũng đính kèm liên kết tải về phiên bản phpBB mới nhất cũng như những thay đổi kể từ phiên bản trước.</p>

		<br />

		<h1>Làm thế nào để cập nhật bản cài đặt phpBB3 của bạn với gói cập nhật tự động?</h1>

		<p>Khuyến cáo bạn rằng đây là cách cập nhật bản cài đặt phpBB3 chỉ hợp lệ với gói cập nhật tự động. Bạn cũng có thể cập nhật bản cài đặt phpBB3 của mình bằng những phương pháp khác đã được liệt kê trong tài liệu <samp>INSTALL.html</samp>. Những bước tiến hành cập nhật tự động hệ thống như sau:</p>

		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Chuyển đến trang <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">tải về phpBB</a> và chọn “Gói cập nhật tự động”.<br /><br /></li>
			<li>Giải nén tập tin vừa tải về.<br /><br /></li>
			<li>Xóa thư mục “vendor” cũ trên hệ thống tập tin. Sau đó tải 2 thư mục “install” và “vendor” đã giải nén ở trên lên máy chủ (chung thư mục với tập tin <samp>config.php</samp>).<br /><br /></li>
		</ul>

		<p>Sau khi đã tải lên xong, hệ thống của bạn sẽ tạm ngưng hoạt động đối với các người dùng bình thường trong suốt thời gian thư mục cài đặt hệ thống mà bạn đã tải lên còn hiện diện.<br /><br />
		<strong><a href="%1$s" title="%1$s">Bây giờ, bạn hãy bắt đầu tiến hành cập nhật bằng cách duyệt thư mục cài đặt hệ thống từ trình duyệt của mình</a>.</strong><br />
		<br />
		Sau đó, bạn sẽ được hướng dẫn từng bước để tiến hành cập nhật. Bạn sẽ chỉ được thông báo một lần duy nhất khi việc cập nhật hoàn tất.</p>
	',
	'UPDATE_RECHECK_UPDATE_FILES'		=> 'Kiểm tra lại tập tin',
	'UPDATE_TOPICS_POSTED'				=> 'Đang tạo thông tin cho các chủ đề đã gửi',
	'UPDATE_TOPICS_POSTED_ERR'			=> 'Có một lỗi xảy ra trong khi tạo thông tin cho các chủ đề đã gửi. Bạn có thể thử lại một lần nữa bước này trong bảng quản trị sau khi quá trình chuyển đổi hoàn tất.',
	'UPDATE_TYPE'						=> 'Đối tượng cập nhật',
	'UPDATE_TYPE_ALL'					=> 'Cập nhật tập tin và dữ liệu',
	'UPDATE_TYPE_DB_ONLY'				=> 'Chỉ cập nhật dữ liệu',
	'UPDATE_UPDATING_FILES'				=> 'Đang cập nhật tập tin',
	'UPGRADE_INSTRUCTIONS'				=> 'Phiên bản <strong>%1$s</strong> cùng chức năng mới đã được phát hành. Hãy xem qua <a href="%2$s" title="%2$s"><strong>thông báo phát hành</strong></a> để tìm hiểu về những chức năng này và cách cập nhật dễ nhất cho bạn.',

	'VERSION'	=> 'Phiên bản',
));
