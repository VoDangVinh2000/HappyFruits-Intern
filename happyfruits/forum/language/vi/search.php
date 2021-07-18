<?php
/** 
*
* search [Vietnamese]
*
* @package language
* @version 1.36
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
	'ALL_AVAILABLE'	=> 'Tất cả',
	'ALL_RESULTS'	=> 'Tất cả',

	'DISPLAY_RESULTS'	=> 'Xem kết quả dưới dạng',

	'FOUND_SEARCH_MATCHES'		=> array(
		1	=> 'Chỉ tìm thấy <strong>%d</strong> kết quả',
		2	=> 'Đã tìm thấy <strong>%d</strong> kết quả',
	),
	'FOUND_MORE_SEARCH_MATCHES'	=> array(
		1	=> 'Đã tìm thấy nhiều hơn <strong>%d</strong> kết quả',
		2	=> 'Đã tìm thấy nhiều hơn <strong>%d</strong> kết quả',
	),

	'GLOBAL'			=> 'Thông báo chung',
	'GO_TO_SEARCH_ADV'	=> 'Chọn tìm kiếm nâng cao',

	'IGNORED_TERMS'			=> 'không được phép sử dụng',
	'IGNORED_TERMS_EXPLAIN'	=> 'Những từ khóa tìm kiếm của bạn dưới đây không được phép sử dụng bởi vì chúng là những từ phổ biến: <strong>%s</strong>.',

	'JUMP_TO_POST'	=> 'Chuyển đến bài viết',

	'LOGIN_EXPLAIN_EGOSEARCH'		=> 'Hệ thống yêu cầu bạn phải đăng nhập vào để xem những bài viết của mình.',
	'LOGIN_EXPLAIN_UNREADSEARCH'	=> 'Hệ thống yêu cầu bạn phải đăng nhập vào để tìm những bài viết chưa xem của mình.',
	'LOGIN_EXPLAIN_NEWPOSTS'		=> 'Hệ thống yêu cầu bạn phải đăng nhập vào để xem những bài viết mới kể từ lần ghé thăm trước.',

	'MAX_NUM_SEARCH_KEYWORDS_REFINE'	=> array(
		1	=> 'Bạn đã dùng quá nhiều từ khóa để tìm. Vui lòng đừng nhập nhiều hơn <strong>%1$d</strong> từ.',
		2	=> 'Bạn đã dùng quá nhiều từ khóa để tìm. Vui lòng đừng nhập nhiều hơn <strong>%1$d</strong> từ.',
	),

	'NO_KEYWORDS'			=> 'Bạn phải xác định ít nhất một từ khóa để thực hiện tìm kiếm. Mỗi từ khóa phải có ít nhất là <strong>%d</strong> và không được nhiều quá <strong>%d</strong>, không tính dấu *.',
	'NO_RECENT_SEARCHES'	=> 'Không có yêu cầu tìm kiếm nào gần đây.',
	'NO_SEARCH'				=> 'Xin lỗi, bạn không được phép sử dụng công cụ tìm kiếm trong hệ thống.',
	'NO_SEARCH_LOAD'		=> 'Xin lỗi, bạn không thể tìm kiếm tại thời điểm này. Máy chủ đang bị quá tải, hãy vui lòng quay lại sau.',
	'NO_SEARCH_RESULTS'		=> 'Không tìm thấy kết quả nào.',
	'NO_SEARCH_TIME'		=> array(
		1	=> 'Xin lỗi, bạn không thể tiếp tục tìm kiếm ngay lúc này. Hãy thử lại sau %d giây.',
		2	=> 'Xin lỗi, bạn không thể tiếp tục tìm kiếm ngay lúc này. Hãy thử lại sau %d giây.',
	),
	'NO_SEARCH_UNREADS'		=> 'Xin lỗi, chức năng tìm những bài viết chưa xem đã bị vô hiệu trên diễn đàn.',
	'WORD_IN_NO_POST'		=> 'Không tìm thấy kết quả bởi vì từ khóa <strong>%s</strong> không có trong bất cứ bài viết nào.',
	'WORDS_IN_NO_POST'		=> 'Không tìm thấy kết quả bởi vì những từ khóa <strong>%s</strong> không có trong bất cứ bài viết nào.',

	'POST_CHARACTERS'			=> 'ký tự của bài viết',
	'PHRASE_SEARCH_DISABLED'	=> 'Chức năng tìm theo cụm từ chính xác đã bị vô hiệu.',

	'RECENT_SEARCHES'		=> 'Những tìm kiếm gần đây',
	'RESULT_DAYS'			=> 'Giới hạn kết quả tìm được cách đây',
	'RESULT_SORT'			=> 'Sắp xếp kết quả tìm được theo',
	'RETURN_FIRST'			=> 'Xem trước nội dung trong khoảng',

	'SEARCHED_FOR'				=> 'Điều kiện tìm đã sử dụng',
	'SEARCHED_TOPIC'			=> 'Chủ đề đã tìm',
	'SEARCHED_QUERY'			=> 'Từ khóa đã tìm',
	'SEARCH_ALL_TERMS'			=> 'Tìm theo tất cả điều kiện hoặc sử dụng truy vấn đã nhập',
	'SEARCH_ANY_TERMS'			=> 'Tìm theo bất kì điều kiện nào',
	'SEARCH_AUTHOR'				=> 'Tìm theo người gửi',
	'SEARCH_AUTHOR_EXPLAIN'		=> 'Sử dụng dấu * để tìm những người gửi có tên giống nhau một phần nào đó.',
	'SEARCH_FIRST_POST'			=> 'Chỉ tìm bài viết đầu tiên trong các chủ đề',
	'SEARCH_FORUMS'				=> 'Tìm trong các chuyên mục',
	'SEARCH_FORUMS_EXPLAIN'		=> 'Chọn một hoặc nhiều chuyên mục mà bạn muốn thực hiện tìm trong phạm vi đó. Các chuyên mục con sẽ được thực hiện tìm tự động nếu bạn không vô hiệu trong tùy chọn “Tìm trong các chuyên mục con” bên dưới.',
	'SEARCH_IN_RESULTS'			=> 'Tìm trong những kết quả này',
	'SEARCH_KEYWORDS_EXPLAIN'	=> 'Đặt dấu <strong>+</strong> trước từ khóa mà bạn thực sự muốn tìm và dấu <strong>-</strong> trước từ khóa mà bạn không muốn hiển thị trong kết quả tìm được. Nhập một danh sách từ khóa tìm kiếm ngăn cách nhau bởi dấu <strong>|</strong> trong dấu ngoặc đơn nếu bạn muốn mỗi kết quả tìm thấy chứa ít nhất một trong những từ khóa này. Sử dụng dấu <strong>*</strong> để tìm những từ khóa giống nhau theo một số ký tự.',
	'SEARCH_MSG_ONLY'			=> 'Chỉ tìm trong nội dung bài viết',
	'SEARCH_OPTIONS'			=> 'Tùy chọn tìm kiếm',
	'SEARCH_QUERY'				=> 'Truy vấn tìm kiếm',
	'SEARCH_SUBFORUMS'			=> 'Tìm trong các chuyên mục con',
	'SEARCH_TITLE_MSG'			=> 'Tìm trong tiêu đề và nội dung bài viết',
	'SEARCH_TITLE_ONLY'			=> 'Chỉ tìm trong tiêu đề bài viết',
	'SEARCH_WITHIN'				=> 'Tìm trong',
	'SORT_ASCENDING'			=> 'Tăng dần',
	'SORT_AUTHOR'				=> 'Tác giả',
	'SORT_DESCENDING'			=> 'Giảm dần',
	'SORT_FORUM'				=> 'Chuyên mục',
	'SORT_POST_SUBJECT'			=> 'Tiêu đề bài viết',
	'SORT_TIME'					=> 'Ngày gửi bài',
	'SPHINX_SEARCH_FAILED'		=> 'Không tìm thấy kết quả: %s',
	'SPHINX_SEARCH_FAILED_LOG'	=> 'Xin lỗi, thao tác tìm kiếm không thể tiến hành. Lỗi gây ra đã được ghi nhận vào hệ thống.',

	'TOO_FEW_AUTHOR_CHARS'	=> array(
		1	=> 'Bạn phải xác định ít nhất là <strong>%d</strong> ký tự trong phần tên tác giả.',
		2	=> 'Bạn phải xác định ít nhất là <strong>%d</strong> ký tự trong phần tên tác giả.',
	),
));
