<?php
/** 
*
* groups [Vietnamese]
*
* @package language
* @version 1.27
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
	'ALREADY_DEFAULT_GROUP'		=> 'Nhóm vừa chọn đã được thiết lập là nhóm mặc định.',
	'ALREADY_IN_GROUP'			=> 'Bạn đã là thành viên trong nhóm vừa chọn.',
	'ALREADY_IN_GROUP_PENDING'	=> 'Bạn đã gửi yêu cầu tham gia vào nhóm này rồi.',

	'CANNOT_JOIN_GROUP'		=> 'Bạn không thể tham gia vào nhóm này. Bạn chỉ có thể tham gia vào những nhóm tự do.',
	'CANNOT_RESIGN_GROUP'	=> 'Bạn không thể rút ra khỏi nhóm này. Bạn chỉ có thể rút ra khỏi những nhóm tự do.',
	'CHANGED_DEFAULT_GROUP'	=> 'Đã thay đổi nhóm mặc định thành công.',
	
	'GROUP_AVATAR'						=> 'Hình đại diện của nhóm',
	'GROUP_CHANGE_DEFAULT'				=> 'Bạn có chắc chắn muốn thay đổi tư cách thành viên mặc định của nhóm “%s”?',
	'GROUP_CLOSED'						=> 'Nhóm đã cố định',
	'GROUP_DESC'						=> 'Giới thiệu về nhóm',
	'GROUP_HIDDEN'						=> 'Nhóm ẩn',
	'GROUP_INFORMATION'					=> 'Thông tin về nhóm',
	'GROUP_IS_CLOSED'					=> 'Đây là một nhóm đã cố định, những thành viên mới chỉ có thể tham gia vào nhóm bởi sự cho phép của trưởng nhóm.',
	'GROUP_IS_FREE'						=> 'Đây là một nhóm hoàn toàn tự do, tất cả thành viên mới đều được chào đón.',
	'GROUP_IS_HIDDEN'					=> 'Đây là một nhóm ẩn, chỉ có những thành viên của nhóm này mới xem được tư cách thành viên của mình trong nhóm.',
	'GROUP_IS_OPEN'						=> 'Đây là một nhóm tự do, những thành viên mới có thể thoải mái tham gia vào nhóm.',
	'GROUP_IS_SPECIAL'					=> 'Đây là một nhóm đặc biệt, những nhóm đặc biệt này được điều hành bởi chính người quản trị.',
	'GROUP_JOIN'						=> 'Tham gia vào nhóm này',
	'GROUP_JOIN_CONFIRM'				=> 'Bạn có chắc chắn muốn tham gia vào nhóm vừa chọn?',
	'GROUP_JOIN_PENDING'				=> 'Gửi yêu cầu tham gia vào nhóm này',
	'GROUP_JOIN_PENDING_CONFIRM'		=> 'Bạn có chắc chắn muốn gửi yêu cầu tham gia vào nhóm vừa chọn?',
	'GROUP_JOINED'						=> 'Bạn đã tham gia thành công vào nhóm vừa chọn.',
	'GROUP_JOINED_PENDING'				=> 'Bạn đã gửi yêu cầu tham gia vào nhóm thành công. Hãy vui lòng chờ đợi cho đến khi trưởng nhóm chấp thuận tư cách thành viên của bạn.',
	'GROUP_LIST'						=> 'Quản lí thành viên',	
	'GROUP_MEMBERS'						=> 'Các thành viên trong nhóm',
	'GROUP_NAME'						=> 'Tên nhóm',
	'GROUP_OPEN'						=> 'Nhóm tự do',
	'GROUP_RANK'						=> 'Danh hiệu của nhóm',
	'GROUP_RESIGN_MEMBERSHIP'			=> 'Rút ra khỏi nhóm',
	'GROUP_RESIGN_MEMBERSHIP_CONFIRM'	=> 'Bạn có chắc chắn muốn rút ra không làm thành viên của nhóm vừa chọn?',
	'GROUP_RESIGN_PENDING'				=> 'Rút ra khỏi nhóm đang chờ quyết định',
	'GROUP_RESIGN_PENDING_CONFIRM'		=> 'Bạn có chắc chắn muốn rút lại yêu cầu tham gia vào nhóm vừa chọn?',
	'GROUP_RESIGNED_MEMBERSHIP'			=> 'Bạn đã rút ra khỏi nhóm vừa chọn thành công.',
	'GROUP_RESIGNED_PENDING'			=> 'Yêu cầu tham gia vào nhóm vừa chọn của bạn đã được rút lại thành công.',
	'GROUP_TYPE'						=> 'Loại nhóm',
	'GROUP_UNDISCLOSED'					=> 'Nhóm ẩn',
	'FORUM_UNDISCLOSED'					=> 'Chuyên mục ẩn đang điều hành',

	'LOGIN_EXPLAIN_GROUP'	=> 'Bạn cần đăng nhập để xem thông tin chi tiết về nhóm.',
	
	'NO_LEADERS'					=> 'Bạn không phải là người điều hành của bất kì nhóm nào.',
	'NOT_LEADER_OF_GROUP'			=> 'Yêu cầu không được thực hiện vì bạn không phải là người điều hành của nhóm vừa chọn.',
	'NOT_MEMBER_OF_GROUP'			=> 'Yêu cầu không được thực hiện vì bạn không phải là thành viên của nhóm vừa chọn hoặc tư cách thành viên của bạn trong nhóm này vẫn chưa được chấp thuận.',
	'NOT_RESIGN_FROM_DEFAULT_GROUP'	=> 'Bạn không được chấp thuận để rút ra khỏi nhóm mặc định của mình.',

	'PRIMARY_GROUP'		=> 'Nhóm chính',

	'REMOVE_SELECTED'	=> 'Gỡ bỏ đánh dấu',

	'USER_GROUP_CHANGE'			=> 'Từ nhóm “%1$s” trở thành nhóm “%2$s”',
	'USER_GROUP_DEMOTE'			=> 'Giáng chức trưởng nhóm',
	'USER_GROUP_DEMOTE_CONFIRM'	=> 'Bạn có chắc chắn muốn giáng chức trưởng nhóm vừa chọn?',
	'USER_GROUP_DEMOTED'		=> 'Đã giáng chức trưởng nhóm thành công.',
));
