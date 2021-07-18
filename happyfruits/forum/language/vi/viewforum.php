<?php
/** 
*
* viewforum [Vietnamese]
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

$lang = array_merge($lang, array(
	'ACTIVE_TOPICS'			=> 'Chủ đề sôi nổi',
	'ANNOUNCEMENTS'			=> 'Thông báo',

	'FORUM_PERMISSIONS'		=> 'Cấp phép chuyên mục',

	'ICON_ANNOUNCEMENT'		=> 'Thông báo',
	'ICON_STICKY'			=> 'Chú ý',

	'LOGIN_NOTIFY_FORUM'	=> 'Hãy vui lòng đăng nhập để xem chuyên mục này.',

	'MARK_TOPICS_READ'		=> 'Đánh dấu đã xem tất cả chủ đề',

	'NEW_POSTS_HOT'				=> 'Có bài viết mới [ Nhiều người xem ]', // Not used anymore
	'NEW_POSTS_LOCKED'			=> 'Có bài viết mới [ Đã khóa ]', // Not used anymore
	'NO_FORUMS_IN_CATEGORY'		=> 'Không có chuyên mục nào.',
	'NO_NEW_POSTS_HOT'			=> 'Không có bài viết mới [ Nhiều người xem ]', // Not used anymore
	'NO_NEW_POSTS_LOCKED'		=> 'Không có bài viết mới [ Đã khóa ]', // Not used anymore
	'NO_READ_ACCESS'			=> 'Bạn không được cấp phép để xem các chủ đề trong chuyên mục này.',
	'NO_UNREAD_POSTS_HOT'		=> 'Không có bài viết chưa xem [ Nhiều người xem ]',
	'NO_UNREAD_POSTS_LOCKED'	=> 'Không có bài viết chưa xem [ Đã khóa ]',

	'POST_FORUM_LOCKED'		=> 'Chuyên mục đã bị khóa',

	'TOPICS_MARKED'			=> 'Những chủ đề trong chuyên mục này đã được đánh dấu xem rồi.',

	'UNREAD_POSTS_HOT'		=> 'Bài viết chưa xem [ Nhiều người xem ]',
	'UNREAD_POSTS_LOCKED'	=> 'Bài viết chưa xem [ Đã khóa ]',

	'VIEW_FORUM'			=> 'Xem chuyên mục',
	'VIEW_FORUM_TOPICS'		=> array(
		1	=> '%d topic',
		2	=> '%d topics',
	),
));
