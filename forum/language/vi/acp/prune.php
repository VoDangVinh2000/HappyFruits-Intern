<?php
/** 
*
* acp/prune [Vietnamese]
*
* @package language
* @version 1.23
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

// User pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_USERS_EXPLAIN'	=> 'Sử dụng công cụ này, bạn có thể xóa hoặc ngưng kích hoạt các tài khoản trong hệ thống. Những tài khoản này có thể được lọc theo nhiều cách: theo số bài viết, lần ghé thăm trước… Điều kiện dọn dẹp có thể kết hợp với nhau để giới hạn chính xác những tài khoản cần dọn dẹp. Ví dụ, bạn có thể dọn sạch những tài khoản có ít hơn 10 bài viết và không còn ghé thăm từ ngày 01/01/2002. Sử dụng dấu * để thay thế cho bất kì đoạn ký tự nào. Ngoài ra, bạn có thể bỏ qua toàn bộ điều kiện dọn dẹp bằng cách nhập vào trực tiếp danh sách các tài khoản vào khung bên dưới, mỗi tên tài khoản trên một dòng mới. Hãy cẩn thận với công cụ này! Khi một tài khoản đã bị xóa bạn không thể phục hồi lại được.',

	'CRITERIA'	=> 'Điều kiện',

	'DEACTIVATE_DELETE'			=> 'Ngưng kích hoạt hoặc xóa',
	'DEACTIVATE_DELETE_EXPLAIN'	=> 'Chọn ngưng kích hoạt tài khoản hay xóa tài khoản hoàn toàn. Lưu ý rằng tài khoản khi đã bị xóa thì không thể phục hồi lại được.',
	'DELETE_USERS'				=> 'Xóa',
	'DELETE_USER_POSTS'			=> 'Xóa bài viết của những tài khoản đã dọn dẹp',
	'DELETE_USER_POSTS_EXPLAIN' => 'Gỡ bỏ những bài viết được gửi bởi các tài khoản đã bị xóa, sẽ không có tác dụng nếu tài khoản chưa được kích hoạt.',

	'JOINED_EXPLAIN'			=> 'Nhập vào ngày tham gia theo định dạng ngày tháng <kbd>YYYY-MM-DD</kbd>. Bạn có thể sử dụng cả hai mục thông tin để thiết lập một khoảng thời gian, hoặc để trống cho thời gian không giới hạn.',

	'LAST_ACTIVE_EXPLAIN'		=> 'Nhập vào ngày ghé thăm trước theo định dạng ngày tháng <kbd>YYYY-MM-DD</kbd>. Nhập vào <kbd>0000-00-00</kbd> để dọn dẹp những tài khoản chưa bao giờ đăng nhập, lúc này điều kiện <em>Trước</em> và <em>Sau</em> sẽ vô hiệu.',

	'POSTS_ON_QUEUE'				=> 'Bài viết chờ duyệt',
	'PRUNE_USERS_GROUP_EXPLAIN'		=> 'Giới hạn số người dùng trong nhóm đã chọn.',
	'PRUNE_USERS_GROUP_NONE'		=> 'Tất cả nhóm',
	'PRUNE_USERS_LIST'				=> 'Những tài khoản được dọn dẹp',
	'PRUNE_USERS_LIST_DELETE'		=> 'Với những điều kiện đã chọn cho thao tác dọn dẹp, các tài khoản sau đây sẽ bị gỡ bỏ. Bạn có thể loại bỏ từng tài khoản riêng lẻ khỏi danh sách xóa bằng việc bỏ dấu chọn trước tên tài khoản của họ.',
	'PRUNE_USERS_LIST_DEACTIVATE'	=> 'Với những điều kiện đã chọn cho thao tác dọn dẹp, các tài khoản sau đây sẽ bị ngưng kích hoạt. Bạn có thể loại bỏ từng tài khoản riêng lẻ khỏi danh sách ngưng kích hoạt bằng việc bỏ dấu chọn trước tên tài khoản của họ.',

	'SELECT_USERS_EXPLAIN'		=> 'Nhập vào những tên tài khoản xác định tại đây. Những tên tài khoản này được sử dụng để thiết lập trong các tùy chọn bên dưới. Bạn không thể dọn dẹp tài khoản là người sáng lập.',

	'USER_DEACTIVATE_SUCCESS'	=> 'Những tài khoản vừa chọn đã được ngưng kích hoạt thành công.',
	'USER_DELETE_SUCCESS'		=> 'Những tài khoản vừa chọn đã được xóa thành công.',
	'USER_PRUNE_FAILURE'		=> 'Không có tài khoản nào nằm trong những điều kiện mà bạn đã chọn.',

	'WRONG_ACTIVE_JOINED_DATE'	=> 'Ngày tháng bạn nhập không chính xác, nó phải nằm trong định dạng <kbd>YYYY-MM-DD</kbd>.',
));

// Forum Pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_FORUMS_EXPLAIN'	=> 'Với công cụ này, bạn có thể xóa bất kì chủ đề nào không có bài viết mới hoặc không hề được xem qua trong vòng số ngày mà bạn đã chọn. Nếu bạn không nhập số ngày thì tất cả các chủ đề sẽ bị xóa. Mặc định, công cụ này sẽ không gỡ bỏ những chủ đề có các bình chọn chưa hoặc không kết thúc cũng như đối với các chú ý hay thông báo.',

	'FORUM_PRUNE'		=> 'Dọn dẹp chuyên mục',

	'NO_PRUNE'			=> 'Không có chuyên mục nào được dọn dẹp.',

	'SELECTED_FORUM'	=> 'Chuyên mục đã chọn',
	'SELECTED_FORUMS'	=> 'Những chuyên mục đã chọn',

	'POSTS_PRUNED'					=> 'Những bài viết đã dọn dẹp',
	'PRUNE_ANNOUNCEMENTS'			=> 'Dọn dẹp thông báo',
	'PRUNE_FINISHED_POLLS'			=> 'Dọn dẹp bình chọn đã kết thúc',
	'PRUNE_FINISHED_POLLS_EXPLAIN'	=> 'Gỡ bỏ những chủ đề có các bình chọn đã kết thúc.',
	'PRUNE_FORUM_CONFIRM'			=> 'Bạn có chắc chắn muốn dọn dẹp các chuyên mục đã chọn với những thiết lập được xác định? Việc gỡ bỏ chỉ thực hiện một lần và sẽ không có cách nào cho bạn khôi phục lại các chủ đề và bài viết đã được dọn dẹp.',
	'PRUNE_NOT_POSTED'				=> 'Số ngày kể từ lần gửi bài mới nhất',
	'PRUNE_NOT_VIEWED'				=> 'Số ngày kể từ lần xem mới nhất',
	'PRUNE_OLD_POLLS'				=> 'Dọn dẹp bình chọn cũ',
	'PRUNE_OLD_POLLS_EXPLAIN'		=> 'Gỡ bỏ những chủ đề có các bình chọn không được ai tham gia.',
	'PRUNE_STICKY'					=> 'Dọn dẹp chú ý',
	'PRUNE_SUCCESS'					=> 'Việc dọn dẹp chuyên mục đã thành công.',

	'TOPICS_PRUNED'		=> 'Những chủ đề đã dọn dẹp',
));
