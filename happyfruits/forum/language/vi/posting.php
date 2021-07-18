<?php
/** 
*
* posting [Vietnamese]
*
* @package language
* @version 1.62
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
	'ADD_ATTACHMENT'			=> 'Tải lên tập tin đính kèm',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Nếu bạn muốn đính kèm một hay nhiều tập tin trong bài viết, hãy sử dụng công cụ bên dưới.',
	'ADD_FILE'					=> 'Thêm tập tin',
	'ADD_POLL'					=> 'Tạo bình chọn',
	'ADD_POLL_EXPLAIN'			=> 'Nếu bạn không muốn thêm vào một bình chọn trong chủ đề của mình, hãy để trống phần này.',
	'ALREADY_DELETED'			=> 'Xin lỗi, bài viết này vừa bị xóa.',
	'ATTACH_DISK_FULL'			=> 'Dung lượng lưu trữ của hệ thống không còn đủ để gửi tập tin đính kèm.',
	'ATTACH_QUOTA_REACHED'		=> 'Xin lỗi, dung lượng cấp phép tải lên cho diễn đàn đã hết.',
	'ATTACH_SIG'				=> 'Đính kèm chữ ký cá nhân (Chữ ký có thể thay đổi trong phần thiết lập cá nhân)',

	'BBCODE_A_HELP'			=> 'Đính kèm tập tin cùng dòng: [attachment=]tên_tập_tin.loại_tập_tin[/attachment]',
	'BBCODE_B_HELP'			=> 'Chữ in đậm: [b]văn bản[/b]',
	'BBCODE_C_HELP'			=> 'Hiển thị mã: [code]mã nguồn[/code]',
	'BBCODE_D_HELP'			=> 'Chèn Flash: [flash=chiều rộng,chiều cao]http://địa_chỉ_URL_tập_tin_Flash[/flash]',
	'BBCODE_F_HELP'			=> 'Kích thước văn bản: [size=85]văn bản[/size]',
	'BBCODE_IS_OFF'			=> '%sBBCode%s đang <em>TẮT</em>',
	'BBCODE_IS_ON'			=> '%sBBCode%s đang <em>BẬT</em>',
	'BBCODE_I_HELP'			=> 'Chữ in nghiêng: [i]văn bản[/i]',
	'BBCODE_L_HELP'			=> 'Tạo danh sách: [list][*]văn bản[/list]',
	'BBCODE_LISTITEM_HELP'	=> 'Mục liệt kê: [*]văn bản',
	'BBCODE_O_HELP'			=> 'Tạo danh sách theo thứ tự: [list=1][*]Dòng đầu tiên[/list] hoặc [list=a][*]Mục a[/list]',
	'BBCODE_P_HELP'			=> 'Chèn hình: [img]http://địa_chỉ_URL_hình_ảnh[/img]',
	'BBCODE_Q_HELP'			=> 'Trích dẫn văn bản: [quote]văn bản[/quote]',
	'BBCODE_S_HELP'			=> 'Màu chữ: [color=red]văn bản[/color] hoặc [color=#FF0000]văn bản[/color]',
	'BBCODE_U_HELP'			=> 'Chữ gạch chân: [u]văn bản[/u]',
	'BBCODE_W_HELP'			=> 'Chèn địa chỉ URL: [url]http://địa_chỉ_URL[/url] hoặc [url=http://địa_chỉ_URL]Tên liên kết[/url] (Phím tắt: Alt + W)',
	'BBCODE_Y_HELP'			=> 'Danh sách: Tạo danh sách liệt kê các mục',
	'BUMP_ERROR'			=> 'Bạn không thể đẩy chủ đề này lên ngay sau bài viết mình vừa gửi.',

	'CANNOT_DELETE_REPLIED'		=> 'Xin lỗi, bạn chỉ có thể xóa những bài viết chưa được trả lời.',
	'CANNOT_EDIT_POST_LOCKED'	=> 'Bài viết này đã bị khóa. Bạn không thể sửa bài viết này.',
	'CANNOT_EDIT_TIME'			=> 'Bạn không còn có thể sửa hay xóa bài viết này.',
	'CANNOT_POST_ANNOUNCE'		=> 'Xin lỗi, bạn không thể tạo thông báo.',
	'CANNOT_POST_STICKY'		=> 'Xin lỗi, bạn không thể tạo chú ý.',
	'CHANGE_TOPIC_TO'			=> 'Thay đổi loại chủ đề thành',
	'CHARS_POST_CONTAINS'		=> array(
		1	=> 'Bài viết của bạn dài %1$d ký tự.',
		2	=> 'Bài viết của bạn dài %1$d ký tự.',
	),
	'CHARS_SIG_CONTAINS'		=> array(
		1	=> 'Chữ ký của bạn dài %1$d ký tự.',
		2	=> 'Chữ ký của bạn dài %1$d ký tự.',
	),
	'CLOSE_TAGS'				=> 'Đóng đuôi lệnh trong các thẻ BBCode',
	'CURRENT_TOPIC'				=> 'Chủ đề hiện tại',

	'DELETE_FILE'						=> 'Xóa tập tin',
	'DELETE_MESSAGE'					=> 'Xóa bài viết',
	'DELETE_MESSAGE_CONFIRM'			=> 'Bạn có chắc chắn muốn xóa bài viết này?',
	'DELETE_OWN_POSTS'					=> 'Xin lỗi, bạn chỉ có thể xóa những bài viết của chính mình.',
	'DELETE_PERMANENTLY'				=> 'Xóa vĩnh viễn',
	'DELETE_POST_CONFIRM'				=> 'Bạn có chắc chắn muốn xóa bài viết này?',
	'DELETE_POST_PERMANENTLY_CONFIRM'	=> 'Bạn có chắc chắn muốn xóa <strong>vĩnh viễn</strong> bài viết này?',
	'DELETE_POST_PERMANENTLY'	=> array(
		1	=> 'Xóa vĩnh viễn bài viết này và không thể phục hồi',
		2	=> 'Xóa vĩnh viễn %1$d bài viết đã chọn và không thể phục hồi',
	),
	'DELETE_POSTS_CONFIRM'				=> 'Bạn có chắc chắn muốn xóa những bài viết đã chọn?',
	'DELETE_POSTS_PERMANENTLY_CONFIRM'	=> 'Bạn có chắc chắn muốn xóa <strong>vĩnh viễn</strong> những bài viết này?',
	'DELETE_REASON'						=> 'Lý do xóa bài',
	'DELETE_REASON_EXPLAIN'				=> 'Chỉ có điều hành viên mới xem được lý do xóa bài.',
	'DELETE_POST_WARN'					=> 'Xóa bài viết này',
	'DELETE_TOPIC_CONFIRM'				=> 'Bạn có chắc chắn muốn xóa chủ đề này?',
	'DELETE_TOPIC_PERMANENTLY'	=> array(
		1	=> 'Xóa vĩnh viễn chủ đề này và không thể phục hồi',
		2	=> 'Xóa vĩnh viễn %1$d chủ đề đã chọn và không thể phục hồi',
	),
	'DELETE_TOPIC_PERMANENTLY_CONFIRM'	=> 'Bạn có chắc chắn muốn xóa <strong>vĩnh viễn</strong> chủ đề này?',
	'DELETE_TOPICS_CONFIRM'				=> 'Bạn có chắc chắn muốn xóa những chủ đề đã chọn?',
	'DELETE_TOPICS_PERMANENTLY_CONFIRM'	=> 'Bạn có chắc chắn muốn xóa <strong>vĩnh viễn</strong> những chủ đề này?',
	'DISABLE_BBCODE'					=> 'Tắt các thẻ BBCode',
	'DISABLE_MAGIC_URL'					=> 'Không tự động nhận dạng các địa chỉ URL',
	'DISABLE_SMILIES'					=> 'Tắt biểu tượng vui',
	'DISALLOWED_CONTENT'				=> 'Tập tin bạn vừa tải lên bị từ chối bởi vì nội dung tập tin này đã được xác định có mục đích tấn công hệ thống.',
	'DISALLOWED_EXTENSION'				=> 'Loại tập tin “%s” không được phép sử dụng.',
	'DRAFT_LOADED'						=> 'Bản nháp đã được nạp vào phần nội dung, bạn có thể hoàn tất bài viết của mình ngay bây giờ.<br />Bản nháp của bạn sẽ được xóa sau khi bạn gửi xong bài viết này.',
	'DRAFT_LOADED_PM'					=> 'Bản nháp đã được nạp vào phần nội dung, bạn có thể hoàn tất tin nhắn của mình ngay bây giờ.<br />Bản nháp của bạn sẽ được xóa sau khi bạn gửi xong tin nhắn này.',
	'DRAFT_SAVED'						=> 'Bản nháp đã được lưu thành công.',
	'DRAFT_TITLE'						=> 'Tiêu đề nháp',

	'EDIT_REASON'				=> 'Lý do sửa bài viết này',
	'EMPTY_FILEUPLOAD'			=> 'Tập tin bạn vừa tải lên là tập tin rỗng.',
	'EMPTY_MESSAGE'				=> 'Bạn phải nhập nội dung cho bài viết.',
	'EMPTY_REMOTE_DATA'			=> 'Không thể tải lên tập tin, bạn hãy cố gắng tự tải lên tập tin này.',

	'FLASH_IS_OFF'				=> 'Thẻ [flash] đang <em>TẮT</em>',
	'FLASH_IS_ON'				=> 'Thẻ [flash] đang <em>BẬT</em>',
	'FLOOD_ERROR'				=> 'Bạn không thể gửi liên tục nhiều bài viết cùng lúc được.',
	'FONT_COLOR'				=> 'Màu chữ',
	'FONT_COLOR_HIDE'			=> 'Ẩn màu chữ',
	'FONT_HUGE'					=> 'Lớn nhất',
	'FONT_LARGE'				=> 'Lớn vừa',
	'FONT_NORMAL'				=> 'Bình thường',
	'FONT_SIZE'					=> 'Kích thước',
	'FONT_SMALL'				=> 'Nhỏ vừa',
	'FONT_TINY'					=> 'Nhỏ nhất',

	'GENERAL_UPLOAD_ERROR'		=> 'Không thể tải lên tập tin đính kèm đến “%s”.',

	'IMAGES_ARE_OFF'			=> 'Thẻ [img] đang <em>TẮT</em>',
	'IMAGES_ARE_ON'				=> 'Thẻ [img] đang <em>BẬT</em>',
	'INVALID_FILENAME'			=> '“%s” là một tên tập tin không hợp lệ.',

	'LOAD'						=> 'Nạp',
	'LOAD_DRAFT'				=> 'Nạp bản nháp',
	'LOAD_DRAFT_EXPLAIN'		=> 'Với công cụ này, bạn có thể chọn cho mình bản nháp để tiếp tục soạn bài viết. Bài viết hiện tại của bạn sẽ được hủy bỏ và tất cả nội dung trong bài viết sẽ được xóa. Xem, sửa và xóa những bản nháp trong bảng thiết lập cá nhân của mình.',
	'LOGIN_EXPLAIN_BUMP'		=> 'Bạn phải đăng nhập để đẩy các chủ đề trong chuyên mục này.',
	'LOGIN_EXPLAIN_DELETE'		=> 'Bạn phải đăng nhập để xóa các bài viết trong chuyên mục này.',
	'LOGIN_EXPLAIN_POST'		=> 'Bạn phải đăng nhập để gửi bài trong chuyên mục này.',
	'LOGIN_EXPLAIN_QUOTE'		=> 'Bạn phải đăng nhập để trích dẫn các bài viết trong chuyên mục này.',
	'LOGIN_EXPLAIN_REPLY'		=> 'Bạn phải đăng nhập để trả lời các chủ đề trong chuyên mục này.',

	'MAX_FONT_SIZE_EXCEEDED'	=> 'Bạn chỉ được phép tăng kích cỡ phông chữ đến %d.',
	'MAX_FLASH_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Chiều cao tập tin Flash bạn tải lên không được quá %d px.',
		2	=> 'Chiều cao tập tin Flash bạn tải lên không được quá %d px.',
	),
	'MAX_FLASH_WIDTH_EXCEEDED'	=> array(
		1	=> 'Chiều rộng tập tin Flash bạn tải lên không được quá %d px.',
		2	=> 'Chiều rộng tập tin Flash bạn tải lên không được quá %d px.',
	),
	'MAX_IMG_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Chiều cao hình bạn tải lên không được quá %1$d px.',
		2	=> 'Chiều cao hình bạn tải lên không được quá %1$d px.',
	),
	'MAX_IMG_WIDTH_EXCEEDED'	=> array(
		1	=> 'Chiều rộng hình bạn tải lên không được quá %d px.',
		2	=> 'Chiều rộng hình bạn tải lên không được quá %d px.',
	),
	'MESSAGE_BODY_EXPLAIN'		=> array(
		0	=> '', // zero means no limit, so we don't view a message here.
		1	=> 'Nhập nội dung tại đây, nội dung không được vượt quá <strong>%d</strong> ký tự.',
		2	=> 'Nhập nội dung tại đây, nội dung không được vượt quá <strong>%d</strong> ký tự.',
	),
	'MESSAGE_DELETED'			=> 'Bài viết này đã được xóa thành công.',
	'MORE_SMILIES'				=> 'Xem toàn bộ',

	'NOTIFY_REPLY'				=> 'Thông báo cho tôi khi có bài trả lời',
	'NOT_UPLOADED'				=> 'Không thể tải lên tập tin.',
	'NO_DELETE_POLL_OPTIONS'	=> 'Bạn không thể xóa những đối tượng bình chọn đang có.',
	'NO_PM_ICON'				=> 'Không dùng',
	'NO_POLL_TITLE'				=> 'Bạn chưa nhập câu hỏi bình chọn.',
	'NO_POST'					=> 'Bài viết bạn vừa yêu cầu không tồn tại.',
	'NO_POST_MODE'				=> 'Không xác định chế độ bài viết.',
	'NO_TEMP_DIR'				=> 'Không tìm thấy thư mục tạm hoặc thư mục này không thể ghi.',

	'PARTIAL_UPLOAD'			=> 'Tập tin đính kèm vừa chọn chỉ được tải lên một phần và chưa hoàn chỉnh.',
	'PHP_UPLOAD_STOPPED'		=> 'Phần mở rộng PHP đã dừng tiến trình tải lên tập tin.',
	'PHP_SIZE_NA'				=> 'Dung lượng tập tin đính kèm quá lớn.<br />Không thể xác định dung lượng tập tin tối đa xác lập bởi PHP trong tập tin <code>php.ini</code>.',
	'PHP_SIZE_OVERRUN'			=> 'Dung lượng tập tin đính kèm quá lớn, dung lượng tập tin được phép tải lên tối đa là %1$d %2$s.<br />Dung lượng tối đa này được xác lập trong tập tin <strong>php.ini</strong> và không thể tự thay đổi.',
	'PLACE_INLINE'				=> 'Đặt trong dòng',
	'POLL_DELETE'				=> 'Xóa bình chọn',
	'POLL_FOR'					=> 'Thời gian bình chọn',
	'POLL_FOR_EXPLAIN'			=> 'Nhập số <strong>0</strong> cho bình chọn không giới hạn thời gian.',
	'POLL_MAX_OPTIONS'			=> 'Lựa chọn tối đa của mỗi người dùng',
	'POLL_MAX_OPTIONS_EXPLAIN'	=> 'Đây là số lựa chọn tối đa mà mỗi người dùng tham gia bình chọn có thể thực hiện.',
	'POLL_OPTIONS'				=> 'Đối tượng bình chọn',
	'POLL_OPTIONS_EXPLAIN'		=> array(
		1	=> 'Đặt mỗi đối tượng bình chọn trong một dòng mới. Bạn chỉ có thể tạo <strong>%d</strong> đối tượng bình chọn.',
		2	=> 'Đặt mỗi đối tượng bình chọn trong một dòng mới. Bạn có thể tạo đến <strong>%d</strong> đối tượng bình chọn.',
	),
	'POLL_OPTIONS_EDIT_EXPLAIN'	=> array(
		1	=> 'Đặt mỗi đối tượng bình chọn trong một dòng mới. Bạn chỉ có thể tạo <strong>%d</strong> đối tượng bình chọn. Nếu bạn gỡ gỏ hay thêm vào những đối tượng bình chọn thì tất cả kết quả bình chọn trước sẽ được tạo lại từ đầu.',
		2	=> 'Đặt mỗi đối tượng bình chọn trong một dòng mới. Bạn có thể tạo đến <strong>%d</strong> đối tượng bình chọn. Nếu bạn gỡ gỏ hay thêm vào những đối tượng bình chọn thì tất cả kết quả bình chọn trước sẽ được tạo lại từ đầu.',
	),
	'POLL_QUESTION'				=> 'Câu hỏi bình chọn',
	'POLL_TITLE_TOO_LONG'		=> 'Tên bình chọn không được vượt quá <strong>100</strong> ký tự.',
	'POLL_TITLE_COMP_TOO_LONG'	=> 'Độ dài tên bình chọn thực tế của bạn quá lớn, hãy vui lòng bỏ bớt các thẻ BBCode hay biểu tượng vui.',
	'POLL_VOTE_CHANGE'			=> 'Cho phép bình chọn lại',
	'POLL_VOTE_CHANGE_EXPLAIN'	=> 'Nếu lựa chọn này được bật, người dùng có thể thay đổi lựa chọn mà họ đã tham gia bình chọn.',
	'POSTED_ATTACHMENTS'		=> 'Tập tin đã được đính kèm',
	'POST_APPROVAL_NOTIFY'		=> 'Bạn sẽ được thông báo khi bài viết của mình được duyệt.',
	'POST_CONFIRMATION'			=> 'Xác nhận bài viết',
	'POST_CONFIRM_EXPLAIN'		=> 'Để ngăn chặn những bài viết được tự động gửi vào hàng loạt, hệ thống yêu cầu bạn phải nhập vào một đoạn mã xác nhận. Mã xác nhận được hiển thị trong hình bên dưới mà bạn nhìn thấy. Nếu bạn gặp vấn đề về thị lực hoặc không thể nhìn thấy đoạn mã này vì một lý do nào đó, hãy liên hệ với %sngười quản trị%s.',
	'POST_DELETED'				=> 'Bài viết đã được xóa thành công.',
	'POST_EDITED'				=> 'Bài viết đã được sửa thành công.',
	'POST_EDITED_MOD'			=> 'Bài viết đã được sửa thành công nhưng vẫn cần phải được duyệt lại bởi một điều hành viên trước khi mọi người có thể xem được.',
	'POST_GLOBAL'				=> 'Thông báo chung',
	'POST_ICON'					=> 'Biểu tượng bài viết',
	'POST_NORMAL'				=> 'Bài viết bình thường',
	'POST_REVIEW'				=> 'Xem lại bài viết',
	'POST_REVIEW_EDIT'			=> 'Xem lại bài viết được sửa',
	'POST_REVIEW_EDIT_EXPLAIN'	=> 'Nội dung bài viết này đã được thay đổi bởi một người dùng khác trong khi bạn đang chỉnh sửa. Bạn nên xem lại nội dung của phiên bản hiện tại và điều chỉnh những thay đổi của mình.',
	'POST_REVIEW_EXPLAIN'		=> 'Có ít nhất một bài viết mới được gửi trong chủ đề này. Có thể bạn muốn xem lại nội dung của nó trước khi tiếp tục gửi bài trả lời.',
	'POST_STORED'				=> 'Bài viết này đã được gửi thành công.',
	'POST_STORED_MOD'			=> 'Bài viết này đã được gửi thành công nhưng vẫn cần phải được duyệt lại bởi một điều hành viên trước khi mọi người có thể xem được.',
	'POST_TOPIC_AS'				=> 'Tạo chủ đề dưới dạng',
	'PROGRESS_BAR'				=> 'Thanh tiến trình',

	'QUOTE_DEPTH_EXCEEDED'	=> array(
		1	=> 'Bạn chỉ có thể trích dẫn lại <strong>%d</strong> bài trong một bài viết.',
		2	=> 'Bạn chỉ có thể trích dẫn lại <strong>%d</strong> bài trong một bài viết.',
	),
	'QUOTE_NO_NESTING'		=> 'Bạn chỉ được phép trích dẫn mỗi lần một bài viết.',

	'REMOTE_UPLOAD_TIMEOUT'	=> 'Tập tin vừa chọn không tải lên thành công vì vượt quá thời gian xử lí.',

	'SAVE'							=> 'Lưu',
	'SAVE_DATE'						=> 'Đã lưu vào ngày',
	'SAVE_DRAFT'					=> 'Lưu bản nháp',
	'SAVE_DRAFT_CONFIRM'			=> 'Lưu ý rằng bạn chỉ có thể lưu vào bản nháp tiêu đề và nội dung của bài viết, bất kì các thành phần khác sẽ được gỡ bỏ. Bạn có chắc chắn muốn lưu bản nháp của mình ngay bây giờ?',	
	'SMILIES'						=> 'Biểu tượng vui',
	'SMILIES_ARE_OFF'				=> 'Biểu tượng vui đang <em>TẮT</em>',
	'SMILIES_ARE_ON'				=> 'Biểu tượng vui đang <em>BẬT</em>',
	'STICKY_ANNOUNCE_TIME_LIMIT'	=> 'Thời gian hiển thị chủ đề dưới dạng đặc biệt',
	'STICK_TOPIC_FOR'				=> 'Đánh dấu quan trọng cho chủ đề trong',
	'STICK_TOPIC_FOR_EXPLAIN'		=> 'Nhập số <strong>0</strong> cho chú ý hay thông báo không giới hạn thời gian. Lưu ý rằng con số này có liên quan đến ngày tháng gửi bài.',
	'STYLES_TIP'					=> 'Chú ý: Bạn có thể chọn nhanh đoạn văn bản rồi bấm vào những nút bên trên.',

	'TOO_FEW_CHARS'				=> 'Nội dung bài viết của bạn quá ngắn.',
	'TOO_FEW_CHARS_LIMIT'		=> array(
		1	=> 'Bạn cần nhập vào ít nhất %1$d ký tự.',
		2	=> 'Bạn cần nhập vào ít nhất %1$d ký tự.',
	),
	'TOO_FEW_POLL_OPTIONS'		=> 'Bạn phải tạo ít nhất hai đối tượng bình chọn.',
	'TOO_MANY_ATTACHMENTS'		=> 'Không thể gửi thêm tập tin đính kèm nào khác, số lượng tập tin tối đa cho phép đính kèm là <strong>%d</strong>.',
	'TOO_MANY_CHARS'			=> 'Nội dung bài viết của bạn quá dài.',
	'TOO_MANY_CHARS_LIMIT'		=> array(
		2	=> 'Nội dung không được dài quá %1$d ký tự.',
	),
	'TOO_MANY_POLL_OPTIONS'		=> 'Bạn đã tạo quá nhiều đối tượng bình chọn.',
	'TOO_MANY_SMILIES'			=> 'Bài viết của bạn sử dụng quá nhiều biểu tượng vui. Số lượng biểu tượng vui tối đa cho phép sử dụng trong mỗi bài viết là <strong>%d</strong>.',
	'TOO_MANY_URLS'				=> 'Bài viết của bạn có quá nhiều địa chỉ URL. Số lượng địa chỉ URL tối đa được phép sử dụng trong mỗi bài viết là <strong>%d</strong>.',
	'TOO_MANY_USER_OPTIONS'		=> 'Bạn không thể xác định số đối tượng bình chọn tối đa cho mỗi người dùng nhiều hơn số lượng đối tượng bình chọn hiện có trong bình chọn này',
	'TOPIC_BUMPED'				=> 'Chủ đề đã được đẩy lên thành công.',

	'UNAUTHORISED_BBCODE'				=> 'Bạn không thể sử dụng những thẻ BBCode sau: “%s”.',
	'UNGLOBALISE_EXPLAIN'				=> 'Để chuyển đổi chủ đề này từ loại thông báo quan trọng thành chủ đề bình thường, bạn cần phải chọn chuyên mục chứa chủ đề này.',
	'UNSUPPORTED_CHARACTERS_MESSAGE'	=> 'Nội dung có chứa những ký tự không hỗ trợ:<br />%s',
	'UNSUPPORTED_CHARACTERS_SUBJECT'	=> 'Tiêu đề có chứa những ký tự không hỗ trợ:<br />%s',
	'UPDATE_COMMENT'					=> 'Cập nhật chú thích',
	'URL_INVALID'						=> 'Địa chỉ URL bạn nhập không chính xác.',
	'URL_NOT_FOUND'						=> 'Không thể tìm thấy tập tin vừa chọn.',
	'URL_IS_OFF'						=> 'Thẻ [url] đang <em>TẮT</em>',
	'URL_IS_ON'							=> 'Thẻ [url] đang <em>BẬT</em>',
	'USER_CANNOT_BUMP'					=> 'Bạn không thể đẩy chủ đề lên trong chuyên mục này.',
	'USER_CANNOT_DELETE'				=> 'Bạn không thể xóa bài viết trong chuyên mục này.',
	'USER_CANNOT_EDIT'					=> 'Bạn không thể sửa bài viết trong chuyên mục này.',
	'USER_CANNOT_REPLY'					=> 'Bạn không thể trả lời bài viết trong chuyên mục này.',
	'USER_CANNOT_FORUM_POST'			=> 'Bạn không thể thực hiện các thao tác gửi bài trong chuyên mục này vì loại chủ đề này không hỗ trợ.',	

	'VIEW_MESSAGE'			=> '%sXem bài viết vừa gửi%s',
	'VIEW_PRIVATE_MESSAGE'	=> '%sXem tin nhắn vừa gửi%s',

	'WRONG_FILESIZE'	=> 'Dung lượng tập tin đính kèm quá lớn, dung lượng tối đa cho phép là %1$d %2$s.',
	'WRONG_SIZE'		=> 'Kích thước hình ảnh vừa chọn rộng %5$d và cao %6$d. Kích thước hình ảnh phải rộng ít nhất %1$d và cao ít nhất %2$d cũng như không được phép rộng quá %3$d và cao quá %4$d.',
));
