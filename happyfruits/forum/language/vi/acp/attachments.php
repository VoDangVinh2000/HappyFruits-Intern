<?php
/** 
*
* acp/attachments [Vietnamese]
*
* @package language
* @version 1.35
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
	'ACP_ATTACHMENT_SETTINGS_EXPLAIN'	=> 'Với công cụ này, bạn có thay đổi những thiết lập chính về chức năng đính kèm tập tin và những nhóm tập tin kết hợp trong hệ thống.',
	'ACP_EXTENSION_GROUPS_EXPLAIN'		=> 'Với công cụ này, bạn có thể thêm vào, xóa, chỉnh sửa hoặc vô hiệu những nhóm tập tin được phép đính kèm. Bạn cũng có thể sử dụng những tùy chọn khác như chỉ định một loại nhóm tập tin đặc biệt, thay đổi cơ chế tải về của các tập tin và xác định biểu tượng tập tin cho từng loại nhóm tập tin hiển thị trong phần tải về tập tin đính kèm.',
	'ACP_MANAGE_EXTENSIONS_EXPLAIN'		=> 'Với công cụ này, bạn có thể quản lí những loại tập tin đã được cho phép sử dụng khi đính kèm tập tin trong hệ thống. Để kích hoạt những loại tập tin này, hãy tham khảo bảng quản lí các loại nhóm tập tin. Chúng tôi khuyên bạn không nên thêm vào những loại tập tin mã nguồn như <code>php</code>, <code>php3</code>, <code>php4</code>, <code>phtml</code>, <code>pl</code>, <code>cgi</code>, <code>py</code>, <code>rb</code>, <code>asp</code>, <code>aspx</code> và những loại khác giống như thế…',
	'ACP_ORPHAN_ATTACHMENTS_EXPLAIN'	=> 'Với công cụ này, bạn có thể phát hiện những tập tin đính kèm không được sử dụng trong bất kì bài viết nào. Hầu hết điều này xảy ra khi người dùng tải lên xong tập tin nhưng lại không gửi kèm vào bài viết nữa. Bạn có thể xóa những tập tin này hoặc đính kèm chúng vào những bài viết hiện có. Việc đính kèm tập tin vào bài viết yêu cầu bạn phải xác định chính xác số ID của bài viết và bạn phải tự mình xác định số ID này. Thao tác này sẽ thêm tập tin đính kèm đã được tải lên vào bài viết hiện có mà bạn chọn.',
	'ADD_EXTENSION'						=> 'Thêm loại tập tin',
	'ADD_EXTENSION_GROUP'				=> 'Thêm nhóm tập tin',
	'ADMIN_UPLOAD_ERROR'				=> 'Có lỗi xảy ra trong khi đính kèm tập tin: “%s”.',
	'ALLOWED_FORUMS'					=> 'Chuyên mục được phép đính kèm tập tin',
	'ALLOWED_FORUMS_EXPLAIN'			=> 'Cho phép người dùng có thể đính kèm những loại tập tin trong các chuyên mục được chọn hoặc tất cả các chuyên mục.',
	'ALLOWED_IN_PM_POST'				=> 'Cho phép',
	'ALLOW_ATTACHMENTS'					=> 'Cho phép đính kèm tập tin',
	'ALLOW_ALL_FORUMS'					=> 'Cho phép đính kèm tập tin trong tất cả các chuyên mục',
	'ALLOW_IN_PM'						=> 'Cho phép trong tin nhắn',
	'ALLOW_PM_ATTACHMENTS'				=> 'Cho phép sử dụng tập tin đính kèm trong tin nhắn',
	'ALLOW_SELECTED_FORUMS'				=> 'Chỉ những chuyên mục được chọn bên dưới',
	'ASSIGNED_EXTENSIONS'				=> 'Loại tập tin đã chỉ định',
	'ASSIGNED_GROUP'					=> 'Nhóm tập tin đã chỉ định',
	'ATTACH_EXTENSIONS_URL'				=> 'Loại tập tin',
	'ATTACH_EXT_GROUPS_URL'				=> 'Nhóm tập tin',
	'ATTACH_ID'							=> 'Số ID tập tin',
	'ATTACH_MAX_FILESIZE'				=> 'Dung lượng tập tin tối đa',
	'ATTACH_MAX_FILESIZE_EXPLAIN'		=> 'Dung lượng đính kèm tập tin tối đa cho phép của mỗi tập tin. Nhập số <strong>0</strong> để hạn chế dung lượng tập tin thông qua cấu hình PHP.',
	'ATTACH_MAX_PM_FILESIZE'			=> 'Dung lượng tập tin tối đa trong tin nhắn',
	'ATTACH_MAX_PM_FILESIZE_EXPLAIN'	=> 'Dung lượng tối đa được phép sử dụng cho mỗi tập tin được đính kèm trong tin nhắn. Nhập số <strong>0</strong> để không hạn chế dung lượng này.',
	'ATTACH_ORPHAN_URL'					=> 'Tập tin đính kèm không được sử dụng',
	'ATTACH_POST_ID'					=> 'Số ID bài viết',
	'ATTACH_POST_TYPE'					=> 'Loại bài viết',
	'ATTACH_QUOTA'						=> 'Tổng dung lượng đính kèm tập tin',
	'ATTACH_QUOTA_EXPLAIN'				=> 'Tổng dung lượng tối đa cho phép của tất cả các tập tin đính kèm trong diễn đàn. Nhập số <strong>0</strong> để không hạn chế dung lượng tập tin.',
	'ATTACH_TO_POST'					=> 'Đính kèm tập tin vào bài viết',

	'CAT_FLASH_FILES'			=> 'Nhóm tập tin Flash',
	'CAT_IMAGES'				=> 'Nhóm tập tin hình ảnh',
	'CHECK_CONTENT'				=> 'Kiểm tra các tập tin đính kèm',
	'CHECK_CONTENT_EXPLAIN'		=> 'Một vài trình duyệt có thể bị đánh lừa bằng những loại tập tin nguy hiểm với phần mở rộng không bình thường từ việc tải lên các tập tin. Tùy chọn này sẽ giúp bạn yên tâm rằng những tập tin như thế sẽ bị chặn ngay từ đầu.',
	'CREATE_GROUP'				=> 'Tạo nhóm tập tin mới',
	'CREATE_THUMBNAIL'			=> 'Tạo hình thu nhỏ',
	'CREATE_THUMBNAIL_EXPLAIN'	=> 'Tạo hình thu nhỏ cho tất cả các loại tập tin hình ảnh.',

	'DEFINE_ALLOWED_IPS'			=> 'Xác định địa chỉ IP/tên miền cho phép đính kèm tập tin',
	'DEFINE_DISALLOWED_IPS'			=> 'Xác định địa chỉ IP/tên miền cấm đính kèm tập tin',
	'DOWNLOAD_ADD_IPS_EXPLAIN'		=> 'Để xác định nhiều địa chỉ IP hay tên miền khác nhau, bạn hãy nhập mỗi địa chỉ IP hay tên miền trong một dòng. Để xác định một dãy địa chỉ IP, bắt đầu và kết thúc bằng dấu gạch nối (-), xác định những địa chỉ IP cùng dãy bằng dấu sao (*).',
	'DOWNLOAD_REMOVE_IPS_EXPLAIN'	=> 'Bạn có thể gỡ bỏ hoặc ngưng loại trừ nhiều địa chỉ IP hay tên miền cùng lúc trong một thao tác bằng cách kết hợp hiệu quả chuột và bàn phím từ máy tính và trình duyệt. Những địa chỉ IP hay tên miền bị loại trừ được đánh dấu bằng màu nền xám.',
	'DISPLAY_INLINED'				=> 'Hiển thị hình ảnh trong bài viết',
	'DISPLAY_INLINED_EXPLAIN'		=> 'Nếu bạn tắt tùy chọn này, những hình ảnh được đính kèm sẽ hiển thị như liên kết.',
	'DISPLAY_ORDER'					=> 'Hiển thị tập tin đính kèm theo thứ tự',
	'DISPLAY_ORDER_EXPLAIN'			=> 'Hiển thị những tập tin đính kèm theo thứ tự thời gian.',

	'EDIT_EXTENSION_GROUP'			=> 'Sửa nhóm tập tin',
	'EXCLUDE_ENTERED_IP'			=> 'Bật tùy chọn này để loại trừ những địa chỉ IP/tên miền được nhập vào.',
	'EXCLUDE_FROM_ALLOWED_IP'		=> 'Loại trừ từ những địa chỉ IP/tên miền cho phép',
	'EXCLUDE_FROM_DISALLOWED_IP'	=> 'Loại trừ từ những địa chỉ IP/tên miền đã cấm',
	'EXTENSIONS_UPDATED'			=> 'Loại tập tin đã được cập nhật thành công.',
	'EXTENSION_EXIST'				=> 'Loại tập tin “%s” đã được sử dụng.',
	'EXTENSION_GROUP'				=> 'Nhóm tập tin',
	'EXTENSION_GROUPS'				=> 'Nhóm tập tin',
	'EXTENSION_GROUP_DELETED'		=> 'Nhóm tập tin đã được xóa thành công.',
	'EXTENSION_GROUP_EXIST'			=> 'Nhóm tập tin “%s” đã được sử dụng.',

	'EXT_GROUP_ARCHIVES'			=> 'Tập tin lưu trữ',
	'EXT_GROUP_DOCUMENTS'			=> 'Tập tin văn bản',
	'EXT_GROUP_DOWNLOADABLE_FILES'	=> 'Tập tin cho tải về',
	'EXT_GROUP_FLASH_FILES'			=> 'Tập tin Flash',
	'EXT_GROUP_IMAGES'				=> 'Tập tin hình ảnh',
	'EXT_GROUP_PLAIN_TEXT'			=> 'Tập tin văn bản thuần túy',

	'FILES_GONE'		=> 'Một vài tập tin đính kèm bạn chọn xóa không tồn tại trên máy chủ. Có thể chúng vừa bị xóa nhưng thời gian phản hồi trễ dẫn đến ghi nhận sai. Những tập tin hiện diện còn lại đều đã được xóa.',
	'FILES_STATS_WRONG'	=> 'Dữ liệu thống kê tập tin đính kèm trên hệ thống dường như không chính xác và cần được đồng bộ lại. Giá trị ghi nhận trên thực tế: số tập tin đính kèm = %1$d, tổng dung lượng tập tin đính kèm = %2$s.<br />Bấm %3$svào đây%4$s để đồng bộ lại.',

	'GO_TO_EXTENSIONS'	=> 'Chuyển đến phần quản lí loại tập tin',
	'GROUP_NAME'		=> 'Tên nhóm tập tin',

	'IMAGE_LINK_SIZE'			=> 'Kích thước hình ảnh sẽ hiển thị như liên kết',
	'IMAGE_LINK_SIZE_EXPLAIN'	=> 'Hiển thị những hình ảnh được đính kèm như là một liên kết văn bản trong dòng nếu kích thước hình ảnh lớn hơn kích thước đã chọn. Thiết lập <strong>0 Pixel x 0 Pixel</strong> để vô hiệu chức năng này.',
	'IMAGICK_PATH'				=> 'Đường dẫn đến chương trình ImageMagick',
	'IMAGICK_PATH_EXPLAIN'		=> 'Đường dẫn chính xác đến ứng dụng chuyển đổi hình ảnh ImageMagick trên máy chủ, ví dụ như <samp>/usr/bin/</samp>.',

	'MAX_ATTACHMENTS'				=> 'Số tập tin đính kèm tối đa trong mỗi bài viết',
	'MAX_ATTACHMENTS_PM'			=> 'Số tập tin đính kèm tối đa trong mỗi tin nhắn',
	'MAX_EXTGROUP_FILESIZE'			=> 'Dung lượng tập tin tối đa',
	'MAX_IMAGE_SIZE'				=> 'Kích thước hình ảnh tối đa',
	'MAX_IMAGE_SIZE_EXPLAIN'		=> 'Kích thước tối đa cho những hình ảnh được đính kèm. Thiết lập <strong>0 Pixel x 0 Pixel</strong> để vô hiệu việc kiểm tra kích thước hình ảnh đính kèm.',
	'MAX_THUMB_WIDTH'				=> 'Chiều rộng/cao hình thu nhỏ tối đa',
	'MAX_THUMB_WIDTH_EXPLAIN'		=> 'Hình thu nhỏ được tạo ra sẽ có chiều rộng không vượt quá giá trị được thiết lập ở đây.',
	'MIN_THUMB_FILESIZE'			=> 'Dung lượng tập tin tạo hình thu nhỏ tối thiểu',
	'MIN_THUMB_FILESIZE_EXPLAIN'	=> 'Không tạo hình thu nhỏ cho những tập tin có dung lượng lớn hơn mức dung lượng này.',
	'MODE_INLINE'					=> 'Trực tuyến',
	'MODE_PHYSICAL'					=> 'Vật lý',

	'NOT_ALLOWED_IN_PM'			=> 'Chỉ cho phép trong bài viết',
	'NOT_ALLOWED_IN_PM_POST'	=> 'Không cho phép',
	'NOT_ASSIGNED'				=> 'Không chỉ định',
	'NO_ATTACHMENTS'			=> 'Không có tập tin nào vào thời điểm này.',
	'NO_EXT_GROUP'				=> 'Không có nhóm tập tin nào',
	'NO_EXT_GROUP_NAME'			=> 'Bạn chưa nhập tên nhóm tập tin',
	'NO_EXT_GROUP_SPECIFIED'	=> 'Không có nhóm tập tin nào được xác định.',
	'NO_FILE_CAT'				=> 'Không có loại tập tin nào',	
	'NO_IMAGE'					=> 'Không có hình ảnh',
	'NO_THUMBNAIL_SUPPORT'		=> 'Chức năng hỗ trợ tạo hình thu nhỏ đã bị vô hiệu. Nếu bạn muốn sử dụng chức năng này, thư viện GD hoặc chương trình Imagemagick phải được cài đặt trên máy chủ của bạn. Tất cả chúng đều không thể tìm thấy.',
	'NO_UPLOAD_DIR'				=> 'Thư mục tải lên vừa chọn không tồn tại.',
	'NO_WRITE_UPLOAD'			=> 'Thư mục tải lên vừa chọn không được cấp phép có thể ghi trên máy chủ. Bạn hãy vui lòng thay đổi thiết lập cấp phép có thể ghi cho thư mục này trên máy chủ.',

	'ONLY_ALLOWED_IN_PM'	=> 'Chỉ đồng ý trong tin nhắn',
	'ORDER_ALLOW_DENY'		=> 'Đồng ý',
	'ORDER_DENY_ALLOW'		=> 'Từ chối',

	'REMOVE_ALLOWED_IPS'			=> 'Gỡ bỏ hoặc ngưng loại trừ những địa chỉ IP/tên miền <em>đã cho phép</em>',
	'REMOVE_DISALLOWED_IPS'			=> 'Gỡ bỏ hoặc ngưng loại trừ những địa chỉ IP/tên miền <em>đã bị cấm</em>',
	'RESYNC_FILES_STATS_CONFIRM'	=> 'Bạn có chắc chắn muốn đồng bộ lại dữ liệu thống kê tập tin đính kèm?',

	'SEARCH_IMAGICK'				=> 'Tìm kiếm ứng dụng ImageMagick',
	'SECURE_ALLOW_DENY'				=> 'Danh sách đồng ý/từ chối',
	'SECURE_ALLOW_DENY_EXPLAIN'		=> 'Thay đổi cách xử lí mặc định khi chế độ tải về an toàn được bật của danh sách đồng ý/từ chối với một <strong>danh sách trắng</strong> (Đồng ý) hoặc một <strong>danh sách đen</strong> (Từ chối).',
	'SECURE_DOWNLOADS'				=> 'Bật chế độ tải về an toàn',
	'SECURE_DOWNLOADS_EXPLAIN'		=> 'Nếu bật tùy chọn này, việc cho phép tải về tập tin sẽ giới hạn trong những địa chỉ IP/tên miền mà bạn chỉ định.',
	'SECURE_DOWNLOAD_NOTICE'		=> 'Chế độ tải về an toàn không được bật. Những thiết lập bên dưới chỉ có tác dụng nếu như bạn bật chế độ tải về an toàn.',
	'SECURE_DOWNLOAD_UPDATE_SUCCESS'=> 'Danh sách địa chỉ IP/tên miền đã được cập nhật thành công.',
	'SECURE_EMPTY_REFERRER'			=> 'Cho phép sử dụng tham chiếu địa chỉ trống',
	'SECURE_EMPTY_REFERRER_EXPLAIN'	=> 'Chế độ tải về an toàn dựa trên những tham chiếu địa chỉ của máy chủ. Bạn có muốn bỏ qua tham chiếu địa chỉ cho chế độ tải về an toàn?',
	'SETTINGS_CAT_IMAGES'			=> 'Thiết lập nhóm tập tin hình ảnh',
	'SPECIAL_CATEGORY'				=> 'Nhóm tập tin đặc biệt',
	'SPECIAL_CATEGORY_EXPLAIN'		=> 'Nhóm tập tin đặc biệt là những loại tập tin xuất hiện đặc biệt trong bài viết.',
	'SUCCESSFULLY_UPLOADED'			=> 'Đã tải lên thành công.',
	'SUCCESS_EXTENSION_GROUP_ADD'	=> 'Nhóm tập tin đã được tạo thành công.',
	'SUCCESS_EXTENSION_GROUP_EDIT'	=> 'Nhóm tập tin đã được cập nhật thành công.',

	'UPLOADING_FILES'				=> 'Đang tải lên tập tin',
	'UPLOADING_FILE_TO'				=> 'Đang tải lên tập tin “%1$s” đến bài viết có số ID “%2$d”…',
	'UPLOAD_DENIED_FORUM'			=> 'Bạn không được cấp phép để tải lên tập tin đến chuyên mục “%s”.',
	'UPLOAD_DIR'					=> 'Thư mục tập tin đính kèm',
	'UPLOAD_DIR_EXPLAIN'			=> 'Thư mục chứa những tập tin đính kèm được tải lên trong hệ thống. Lưu ý rằng nếu bạn thay đổi thư mục này trong khi trong thư mục đã có những tập tin đính kèm được tải lên, bạn cần phải tự mình sao chép những tập tin này đến vị trí thư mục mới đã chọn.',
	'UPLOAD_ICON'					=> 'Biểu tượng tập tin',
	'UPLOAD_NOT_DIR'				=> 'Thư mục tải lên vừa chọn không phải là địa chỉ của một thư mục.',
));
