<?php
/**
*
* captcha_qa [Vietnamese]
*
* @package language
* @version 1.10
* @copyright (c) 2009 nedka
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
	'ANSWER'			=> 'Trả lời',
	'ANSWERS_EXPLAIN'	=> 'Vui lòng nhập mỗi phương án trả lời trên một dòng mới.',

	'CAPTCHA_QA'				=> 'Hỏi &amp; Đáp',
	'CONFIRM_QUESTION'			=> 'Câu hỏi',
	'CONFIRM_QUESTION_EXPLAIN'	=> 'Câu hỏi trên dùng để ngăn chặn các chương trình nhập liệu tự động.',
	'CONFIRM_QUESTION_MISSING'	=> 'Không tìm thấy dữ liệu dùng cho câu hỏi xác nhận. Vui lòng liên hệ người quản trị.',
	'CONFIRM_QUESTION_WRONG'	=> 'Bạn đã trả lời sai câu hỏi xác nhận.',

	'EDIT_QUESTION'	=> 'Sửa câu hỏi',

	'QA_ERROR_MSG'				=> 'Vui lòng điền đủ thông tin được yêu cầu và nhập ít nhất một phương án trả lời.',
	'QA_LAST_QUESTION'			=> 'Bạn không thể xóa tất cả câu hỏi khi phần mở rộng này còn được kích hoạt.',
	'QUESTION_ANSWERS'			=> 'Phương án trả lời',
	'QUESTION_DELETED'			=> 'Câu hỏi đã được xóa thành công.',
	'QUESTION_LANG'				=> 'Ngôn ngữ',
	'QUESTION_LANG_EXPLAIN'		=> 'Ngôn ngữ dùng cho câu hỏi và các phương án trả lời.',
	'QUESTION_STRICT'			=> 'Kiểm tra chặt chẽ',
	'QUESTION_STRICT_EXPLAIN'	=> 'Bật tùy chọn này để kiểm tra phân biệt hoa thường, dấu chấm câu và khoảng trắng.',
	'QUESTION_TEXT'				=> 'Câu hỏi',
	'QUESTION_TEXT_EXPLAIN'		=> 'Câu hỏi xác nhận dùng để kiểm tra người dùng.',
	'QUESTIONS'					=> 'Các câu hỏi',
	'QUESTIONS_EXPLAIN'			=> 'Trong mỗi trang nhập liệu có bật chức năng kiểm tra này, người dùng sẽ phải trả lời một trong những câu hỏi đã được thiết lập sẵn. Để sử dụng phần mở rộng này, phải có ít nhất một câu hỏi được thiết lập với ngôn ngữ mặc định của hệ thống. Các câu hỏi nên dễ dàng cho người dùng trả lời nhưng tránh thông dụng vì chương trình tự động có thể truy vấn tìm kiếm thông qua Google. Sử dụng số lượng câu hỏi đa dạng và thường xuyên thay đổi sẽ giúp việc ngăn chặn đạt kết quả tốt. Nếu câu hỏi yêu cầu phân biệt hoa thường, xác định rõ dấu chấm câu hay khoảng trắng, hãy sử dụng tùy chọn kiểm tra chặt chẽ.',
));
