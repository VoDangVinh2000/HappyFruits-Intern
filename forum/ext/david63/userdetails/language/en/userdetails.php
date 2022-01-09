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
// ’ » « “ ” …
//

$lang = array_merge($lang, array(
	'ACP_USER_DETAILS'			=> 'User details',
	'ALL'						=> 'All',

	'CLEAR_FILTER'				=> ' Clear filters ',

	'DEFAULT_STYLE'				=> '<strong>** %1$s **</strong>',

	'ERROR_EXPLAIN'				=> '<strong>Note:</strong> Any attributes that are surrounded by “<strong>**</strong>” indicates that this attribute for the user is missing from the database, or is invalid.',

	'FILTER_BY'					=> 'Filter by',

	'HASH'						=> '#',

	'NO_ATTRIBUTES_SELECTED'	=> 'No attributes selected',
	'NO_DATA'					=> 'The request has not created any data to output',
	'NO_GROUP'					=> '<strong>** No group **</strong>',
	'NO_VISIT'					=> 'Never visited',

	'OTHER'						=> 'Other',

	'TOTAL_USERS'				=> 'Total users',

	'UD_BACK'					=> ' « Back to select ',
	'UD_GO'						=> ' Sort/Filter ',
	'USER_ALLOW_PM'				=> 'Allow PM',
	'USER_ALLOW_VIEWONLINE'		=> 'View online',
	'USER_ALLOW_VIEWEMAIL'		=> 'View email',
	'USER_ALLOW_MASSEMAIL'		=> 'Mass email',
	'USER_AOL'					=> 'AOL',
	'USER_AVATAR'				=> 'Avatar',
	'USER_AVATAR_TYPE'			=> 'Avatar type',
	'USER_BIRTHDAY'				=> 'Birthday',
	'USER_DATE_FORMAT'			=> 'Date format',
	'USER_DETAILS_DISPLAY'		=> 'This is the display of the user attributes that you have selected.',
	'USER_EMAIL'				=> 'Email',
	'USER_EMAILTIME'			=> 'Email time',
	'USER_GROUP'				=> 'Group',
	'USER_ID'					=> 'User id',
	'USER_INACTIVE_REASON'		=> 'Inactive reason',
	'USER_INACTIVE_TIME'		=> 'Inactive time',
	'USER_IP'					=> 'User ip',
	'USER_JABBER'				=> 'Jabber',
	'USER_LANG'					=> 'Language',
	'USER_LASTMARK'				=> 'Last mark',
	'USER_LAST_PAGE'			=> 'Last page',
	'USER_LAST_PRIVMSG'			=> 'Last private message',
	'USER_LAST_SEARCH'			=> 'Last search',
	'USER_LAST_WARNING'			=> 'Last warning',
	'USER_LASTPOST_TIME'		=> 'Last post time',
	'USER_LASTVISIT'			=> 'Last visit',
	'USER_LOGIN_ATTEMPTS'		=> 'Login attempts',
	'USER_NEW_PRIVMSG'			=> 'New private messages',
	'USER_NOTIFY'				=> 'Notify post',
	'USER_NOTIFY_PM'			=> 'Notify PM',
	'USER_NOTIFY_TYPE'			=> 'Notify type',
	'USER_PASS_CHANGE'			=> 'Password change',
	'USER_POSTS'				=> 'Posts',
	'USER_RANK'					=> 'Rank',
	'USER_REGDATE'				=> 'Regdate',
	'USER_SIG'					=> 'Signature',
	'USER_STYLE'				=> 'Style',
	'USER_TIMEZONE'				=> 'Timezone',
	'USER_TYPE'					=> 'User type',
	'USER_UNREAD_PRIVMSG'		=> 'Unread private messages',
	'USER_WARNINGS'				=> 'Warnings',
	'VERSION'					=> 'Version',

	// Translators - set these to whatever is most appropriate in your language
	// These are used to populate the filter keys
	'START_CHARACTER'	=> 'A',
	'END_CHARACTER'		=> 'Z',

	'avatar_type' => array(
		AVATAR_UPLOAD				=> 'Uploaded avatar',
		AVATAR_REMOTE				=> 'Remote avatar',
		AVATAR_GALLERY				=> 'Gallery avatar',
		'avatar.driver.gravatar'	=> 'Gravatar',
	),

	'inactive_type' => array(
		INACTIVE_REGISTER	=> 'Newly registered account',
		INACTIVE_PROFILE	=> 'Profile details changed',
		INACTIVE_MANUAL		=> 'Account deactivated by administrator',
		INACTIVE_REMIND		=> 'Forced user account reactivation',
	),

	'month_types' => array(
		'1'  => 'January',
		'2'  => 'February',
		'3'  => 'March',
		'4'  => 'April',
		'5'  => 'May',
		'6'  => 'June',
		'7'  => 'July',
		'8'  => 'August',
		'9'  => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December',
	),

	'notify_type' => array(
		NOTIFY_EMAIL	=> 'Email',
		NOTIFY_IM		=> 'Jabber',
		NOTIFY_BOTH		=> 'E-mail & Jabber',
	),

	'user_type' => array(
		USER_NORMAL 	=> 'Normal',
		USER_INACTIVE	=> 'Inactive',
		USER_IGNORE 	=> 'Ignoreed',
		USER_FOUNDER 	=> 'Founder',
	),
));
