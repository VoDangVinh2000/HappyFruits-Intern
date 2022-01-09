<?php
/**
*
* @package User Details Extension
* @copyright (c) 2016 david63
* @license GNU General Public License, version 2 (GPL-2.0)
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'USER_DETAILS_SELECT'			=> '&bull;&nbsp;From here you can select the User attributes that you want to display.<br />&bull;&nbsp;Be aware that the number of attributes selected may not fit on the page correctly (this will be dependant on the browser width).',

	'ATTRIBUTE'						=> 'Attribute',
	'ATTRIBUTE_EXPLAIN'				=> 'Attribute description',
	'SIZE'							=> 'Attribute column size',
	'CAN_FILTER'					=> 'Can filter',
	'CLEAR_ATTRIB'					=> 'Clear attributes',
	'CSV'							=> 'CSV export',

	'USER_ALLOW_PM_EXPLAIN'			=> 'Allow other users to send this user a private message.',
	'USER_ALLOW_VIEWONLINE_EXPLAIN'	=> 'Does the user hide their online status?',
	'USER_ALLOW_VIEWEMAIL_EXPLAIN'	=> 'Can a user contact this user by email?',
	'USER_ALLOW_MASSEMAIL_EXPLAIN'	=> 'Can the user be contacted by mass email from an Admin?',
	'USER_AOL_EXPLAIN'				=> 'The user’s AOL address.',
	'USER_AVATAR_EXPLAIN'			=> 'Display the user’s avatar.',
	'USER_AVATAR_TYPE_EXPLAIN'		=> 'The user’s avatar type.',
	'USER_BIRTHDAY_EXPLAIN'			=> 'The user’s date of birth, if entered, and age.',
	'USER_DATE_FORMAT_EXPLAIN'		=> 'The format in which the user sees the date & time.',
	'USER_EMAIL_EXPLAIN'			=> 'The user’s email address.',
	'USER_EMAILTIME_EXPLAIN'		=> 'The date & time of the user’s last email.',
	'USER_GROUP_EXPLAIN'			=> 'The user’s default group.',
	'USER_ID_EXPLAIN'				=> 'The user’s id on this board.',
	'USER_INACTIVE_REASON_EXPLAIN'	=> 'The reason why this user’s account is inactive.',
	'USER_INACTIVE_TIME_EXPLAIN'	=> 'The date & time that the user’s account became inactive.',
	'USER_IP_EXPLAIN'				=> 'The user’s ip address upon registration on this board.',
	'USER_JABBER_EXPLAIN'			=> 'The user’s Jabber address.',
	'USER_LANG_EXPLAIN'				=> 'The user’s language.',
	'USER_LASTMARK_EXPLAIN'			=> 'The last time that the user marked all forums as read.',
	'USER_LAST_PAGE_EXPLAIN'		=> 'The last page that the user visited.',
	'USER_LAST_PRIVMSG_EXPLAIN'		=> 'The date & time of the user’s last private message.',
	'USER_LAST_SEARCH_EXPLAIN'		=> 'The date & time that the user last used the search.',
	'USER_LAST_WARNING_EXPLAIN'		=> 'The date that the user received their last warning.',
	'USER_LASTPOST_TIME_EXPLAIN'	=> 'The date & time that the user last posted on this board.',
	'USER_LASTVISIT_EXPLAIN'		=> 'The date & time of the user’s last visit to this board.',
	'USER_LOGIN_ATTEMPTS_EXPLAIN'	=> 'The number of failed login attempts that the user has made.',
	'USER_NEW_PRIVMSG_EXPLAIN'		=> 'The number of new private messages that the user has.',
	'USER_NOTIFY_EXPLAIN'			=> 'Does the user receive notifications for new posts in forums that they are subscribed to?',
	'USER_NOTIFY_PM_EXPLAIN'		=> 'Does the user receive notifications for PM’s?',
	'USER_NOTIFY_TYPE_EXPLAIN'		=> 'What type of notifications does the user receive?',
	'USER_PASS_CHANGE_EXPLAIN'		=> 'The date when the user’s password is due to be changed.',
	'USER_POSTS_EXPLAIN'			=> 'The number of posts that the user has made on this board.',
	'USER_RANK_EXPLAIN'				=> 'The user’s rank.',
	'USER_REGDATE_EXPLAIN'			=> 'The date that the user registered on this board.',
	'USER_SIG_EXPLAIN'				=> 'Display the user’s signature.',
	'USER_STYLE_EXPLAIN'			=> 'The user’s style.<br />NOTE: This may not be the style that the user sees - it depends on whether override user style has been set at board level.',
	'USER_TIMEZONE_EXPLAIN'			=> 'The user’s timezone.',
	'USER_TYPE_EXPLAIN'				=> 'The user’s type.',
	'USER_UNREAD_PRIVMSG_EXPLAIN'	=> 'The number of unread private messages that the user has.',
	'USER_WARNINGS_EXPLAIN'			=> 'The number of warnings that the user has been given.',
));
