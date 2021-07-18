<?php
/** 
*
* acp/bots [Vietnamese]
*
* @package language
* @version 1.20
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

// Bot settings
$lang = array_merge($lang, array(
	'BOTS'				=> 'Quản lí máy tìm kiếm',
	'BOTS_EXPLAIN'		=> '“Bot”, “Spider” hay “Crawler” là những cỗ máy tự động thường được sử dụng trong các dịch vụ tìm kiếm để cập nhật chỉ mục tìm kiếm trong cơ sở dữ liệu của họ. Hiếm khi những loại này sử dụng phiên đăng nhập thích hợp vì thế thường làm cho kết quả trong các bộ đếm của hệ thống sai lệch khi đếm số lượt người ghé thăm website, đếm tăng thêm số lượng không chính xác và thỉnh thoảng không thể lập chỉ mục cho website chính xác. Với công cụ này, bạn có thể xác định một loại người dùng đặc biệt gồm những máy tìm kiếm này để khắc phục những rắc rối kể trên.',
	'BOT_ACTIVATE'		=> 'Kích hoạt',
	'BOT_ACTIVE'		=> 'Máy tìm kiếm được kích hoạt',
	'BOT_ADD'			=> 'Thêm máy tìm kiếm',
	'BOT_ADDED'			=> 'Máy tìm kiếm mới đã được thêm vào thành công.',
	'BOT_AGENT'			=> 'Kết quả xác định máy tìm kiếm',
	'BOT_AGENT_EXPLAIN'	=> 'Một chuỗi kết quả định danh máy tìm kiếm trong trình duyệt, những chuỗi không hoàn chỉnh vẫn được phép sử dụng.',
	'BOT_DEACTIVATE'	=> 'Ngưng kích hoạt',
	'BOT_DELETED'		=> 'Máy tìm kiếm đã được xóa thành công.',
	'BOT_EDIT'			=> 'Sửa máy tìm kiếm',
	'BOT_EDIT_EXPLAIN'	=> 'Với công cụ này, bạn có thể thêm vào một máy tìm kiếm mới hay chỉnh sửa một máy tìm kiếm sẵn có. Bạn có thể xác định một chuỗi định danh, có thể cộng thêm với một hay nhiều địa chỉ IP, thậm chí là một vùng trong địa chỉ IP để làm kết quả định danh máy tìm kiếm. Hãy cẩn thận trong việc xác định kết quả định danh máy tìm kiếm bằng chuỗi hay địa chỉ IP. Bạn cũng có thể chọn giao diện và ngôn ngữ riêng trong hệ thống cho máy tìm kiếm khi ghé thăm website. Bạn sẽ tiết kiệm được nhiều băng thông website của mình bằng cách chọn một giao diện đơn giản không nạp quá nhiều hình ảnh cho máy tìm kiếm. Bạn cũng phải nhớ thiết lập cấp phép thích hợp cho những loại máy tìm kiếm đặc biệt này.',
	'BOT_LANG'			=> 'Ngôn ngữ dành cho máy tìm kiếm',
	'BOT_LANG_EXPLAIN'	=> 'Chọn ngôn ngữ hiện tại xác định cho máy tìm kiếm trong trình duyệt.',
	'BOT_LAST_VISIT'	=> 'Lần ghé thăm trước',
	'BOT_IP'			=> 'Địa chỉ IP của máy tìm kiếm',
	'BOT_IP_EXPLAIN'	=> 'Địa chỉ IP không hoàn chỉnh vẫn được chấp nhận sử dụng, ngăn cách các địa chỉ IP với nhau bằng dấu phẩy.',
	'BOT_NAME'			=> 'Tên máy tìm kiếm',
	'BOT_NAME_EXPLAIN'	=> 'Chỉ sử dụng để quản lí thông tin của bạn.',
	'BOT_NAME_TAKEN'	=> 'Tên này đã được sử dụng trong hệ thống và không thể dùng để đặt tên cho máy tìm kiếm.',
	'BOT_NEVER'			=> 'Chưa bao giờ',
	'BOT_STYLE'			=> 'Giao diện dành cho máy tìm kiếm',
	'BOT_STYLE_EXPLAIN'	=> 'Chọn giao diện của hệ thống mà bạn muốn sử dụng cho máy tìm kiếm.',
	'BOT_UPDATED'		=> 'Máy tìm kiếm hiện tại đã được cập nhật thành công.',

	'ERR_BOT_AGENT_MATCHES_UA'	=> 'Máy tìm kiếm mà bạn vừa cung cấp tương tự với một trong những máy tìm kiếm đã được sử dụng. Hãy điều chỉnh lại định danh cho máy tìm kiếm này.',
	'ERR_BOT_NO_IP'				=> 'Địa chỉ IP mà bạn nhập không hợp lệ hoặc do tên miền này không thể sử dụng được.',
	'ERR_BOT_NO_MATCHES'		=> 'Bạn phải khai báo ít nhất là một kết quả định danh hoặc địa chỉ IP cho kết quả xác định của máy tìm kiếm này.',

	'NO_BOT'		=> 'Không thể tìm thấy bất kì máy tìm kiếm nào với số ID đã xác định',
	'NO_BOT_GROUP'	=> 'Không thể tìm thấy nhóm máy tìm kiếm đặc biệt.',
));
