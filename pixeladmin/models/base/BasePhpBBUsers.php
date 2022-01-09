<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BasePhpBBUsers
 * Generation date:  04/08/2018
 * Table name:       phpbb_users
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BasePhpBBUsers extends eModel
{
    /**
     * Attribute declaration
     */
    var $user_id;  /* Primary key */
    var $user_type;    /* tinyint(2) */
    var $group_id;    /* mediumint(8) unsigned */
    var $user_permissions;    /* mediumtext */
    var $user_perm_from;    /* mediumint(8) unsigned */
    var $user_ip;    /* varchar(40) */
    var $user_regdate;    /* int(11) unsigned */
    var $username;    /* varchar(255) */
    var $username_clean;    /* varchar(255) */
    var $user_password;    /* varchar(255) */
    var $user_passchg;    /* int(11) unsigned */
    var $user_email;    /* varchar(100) */
    var $user_email_hash;    /* bigint(20) */
    var $user_birthday;    /* varchar(10) */
    var $user_lastvisit;    /* int(11) unsigned */
    var $user_lastmark;    /* int(11) unsigned */
    var $user_lastpost_time;    /* int(11) unsigned */
    var $user_lastpage;    /* varchar(200) */
    var $user_last_confirm_key;    /* varchar(10) */
    var $user_last_search;    /* int(11) unsigned */
    var $user_warnings;    /* tinyint(4) */
    var $user_last_warning;    /* int(11) unsigned */
    var $user_login_attempts;    /* tinyint(4) */
    var $user_inactive_reason;    /* tinyint(2) */
    var $user_inactive_time;    /* int(11) unsigned */
    var $user_posts;    /* mediumint(8) unsigned */
    var $user_lang;    /* varchar(30) */
    var $user_timezone;    /* varchar(100) */
    var $user_dateformat;    /* varchar(64) */
    var $user_style;    /* mediumint(8) unsigned */
    var $user_rank;    /* mediumint(8) unsigned */
    var $user_colour;    /* varchar(6) */
    var $user_new_privmsg;    /* int(4) */
    var $user_unread_privmsg;    /* int(4) */
    var $user_last_privmsg;    /* int(11) unsigned */
    var $user_message_rules;    /* tinyint(1) unsigned */
    var $user_full_folder;    /* int(11) */
    var $user_emailtime;    /* int(11) unsigned */
    var $user_topic_show_days;    /* smallint(4) unsigned */
    var $user_topic_sortby_type;    /* varchar(1) */
    var $user_topic_sortby_dir;    /* varchar(1) */
    var $user_post_show_days;    /* smallint(4) unsigned */
    var $user_post_sortby_type;    /* varchar(1) */
    var $user_post_sortby_dir;    /* varchar(1) */
    var $user_notify;    /* tinyint(1) unsigned */
    var $user_notify_pm;    /* tinyint(1) unsigned */
    var $user_notify_type;    /* tinyint(4) */
    var $user_allow_pm;    /* tinyint(1) unsigned */
    var $user_allow_viewonline;    /* tinyint(1) unsigned */
    var $user_allow_viewemail;    /* tinyint(1) unsigned */
    var $user_allow_massemail;    /* tinyint(1) unsigned */
    var $user_options;    /* int(11) unsigned */
    var $user_avatar;    /* varchar(255) */
    var $user_avatar_type;    /* varchar(255) */
    var $user_avatar_width;    /* smallint(4) unsigned */
    var $user_avatar_height;    /* smallint(4) unsigned */
    var $user_sig;    /* mediumtext */
    var $user_sig_bbcode_uid;    /* varchar(8) */
    var $user_sig_bbcode_bitfield;    /* varchar(255) */
    var $user_jabber;    /* varchar(255) */
    var $user_actkey;    /* varchar(32) */
    var $user_newpasswd;    /* varchar(255) */
    var $user_form_salt;    /* varchar(32) */
    var $user_new;    /* tinyint(1) unsigned */
    var $user_reminded;    /* tinyint(4) */
    var $user_reminded_time;    /* int(11) unsigned */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'phpbb_users';
        $this->primary_key = 'user_id';
    }

    /**
     * Getter methods
     */ 

    function get_user_id()
    {
        return $this->user_id;
    }

    function get_user_type()
    {
        return $this->user_type;
    }

    function get_group_id()
    {
        return $this->group_id;
    }

    function get_user_permissions()
    {
        return $this->user_permissions;
    }

    function get_user_perm_from()
    {
        return $this->user_perm_from;
    }

    function get_user_ip()
    {
        return $this->user_ip;
    }

    function get_user_regdate()
    {
        return $this->user_regdate;
    }

    function get_username()
    {
        return $this->username;
    }

    function get_username_clean()
    {
        return $this->username_clean;
    }

    function get_user_password()
    {
        return $this->user_password;
    }

    function get_user_passchg()
    {
        return $this->user_passchg;
    }

    function get_user_email()
    {
        return $this->user_email;
    }

    function get_user_email_hash()
    {
        return $this->user_email_hash;
    }

    function get_user_birthday()
    {
        return $this->user_birthday;
    }

    function get_user_lastvisit()
    {
        return $this->user_lastvisit;
    }

    function get_user_lastmark()
    {
        return $this->user_lastmark;
    }

    function get_user_lastpost_time()
    {
        return $this->user_lastpost_time;
    }

    function get_user_lastpage()
    {
        return $this->user_lastpage;
    }

    function get_user_last_confirm_key()
    {
        return $this->user_last_confirm_key;
    }

    function get_user_last_search()
    {
        return $this->user_last_search;
    }

    function get_user_warnings()
    {
        return $this->user_warnings;
    }

    function get_user_last_warning()
    {
        return $this->user_last_warning;
    }

    function get_user_login_attempts()
    {
        return $this->user_login_attempts;
    }

    function get_user_inactive_reason()
    {
        return $this->user_inactive_reason;
    }

    function get_user_inactive_time()
    {
        return $this->user_inactive_time;
    }

    function get_user_posts()
    {
        return $this->user_posts;
    }

    function get_user_lang()
    {
        return $this->user_lang;
    }

    function get_user_timezone()
    {
        return $this->user_timezone;
    }

    function get_user_dateformat()
    {
        return $this->user_dateformat;
    }

    function get_user_style()
    {
        return $this->user_style;
    }

    function get_user_rank()
    {
        return $this->user_rank;
    }

    function get_user_colour()
    {
        return $this->user_colour;
    }

    function get_user_new_privmsg()
    {
        return $this->user_new_privmsg;
    }

    function get_user_unread_privmsg()
    {
        return $this->user_unread_privmsg;
    }

    function get_user_last_privmsg()
    {
        return $this->user_last_privmsg;
    }

    function get_user_message_rules()
    {
        return $this->user_message_rules;
    }

    function get_user_full_folder()
    {
        return $this->user_full_folder;
    }

    function get_user_emailtime()
    {
        return $this->user_emailtime;
    }

    function get_user_topic_show_days()
    {
        return $this->user_topic_show_days;
    }

    function get_user_topic_sortby_type()
    {
        return $this->user_topic_sortby_type;
    }

    function get_user_topic_sortby_dir()
    {
        return $this->user_topic_sortby_dir;
    }

    function get_user_post_show_days()
    {
        return $this->user_post_show_days;
    }

    function get_user_post_sortby_type()
    {
        return $this->user_post_sortby_type;
    }

    function get_user_post_sortby_dir()
    {
        return $this->user_post_sortby_dir;
    }

    function get_user_notify()
    {
        return $this->user_notify;
    }

    function get_user_notify_pm()
    {
        return $this->user_notify_pm;
    }

    function get_user_notify_type()
    {
        return $this->user_notify_type;
    }

    function get_user_allow_pm()
    {
        return $this->user_allow_pm;
    }

    function get_user_allow_viewonline()
    {
        return $this->user_allow_viewonline;
    }

    function get_user_allow_viewemail()
    {
        return $this->user_allow_viewemail;
    }

    function get_user_allow_massemail()
    {
        return $this->user_allow_massemail;
    }

    function get_user_options()
    {
        return $this->user_options;
    }

    function get_user_avatar()
    {
        return $this->user_avatar;
    }

    function get_user_avatar_type()
    {
        return $this->user_avatar_type;
    }

    function get_user_avatar_width()
    {
        return $this->user_avatar_width;
    }

    function get_user_avatar_height()
    {
        return $this->user_avatar_height;
    }

    function get_user_sig()
    {
        return $this->user_sig;
    }

    function get_user_sig_bbcode_uid()
    {
        return $this->user_sig_bbcode_uid;
    }

    function get_user_sig_bbcode_bitfield()
    {
        return $this->user_sig_bbcode_bitfield;
    }

    function get_user_jabber()
    {
        return $this->user_jabber;
    }

    function get_user_actkey()
    {
        return $this->user_actkey;
    }

    function get_user_newpasswd()
    {
        return $this->user_newpasswd;
    }

    function get_user_form_salt()
    {
        return $this->user_form_salt;
    }

    function get_user_new()
    {
        return $this->user_new;
    }

    function get_user_reminded()
    {
        return $this->user_reminded;
    }

    function get_user_reminded_time()
    {
        return $this->user_reminded_time;
    }

    /**
     * Setter methods
     */

    function set_user_id($val)
    {
        $this->user_id =  $val;
    }

    function set_user_type($val)
    {
        $this->user_type =  $val;
    }

    function set_group_id($val)
    {
        $this->group_id =  $val;
    }

    function set_user_permissions($val)
    {
        $this->user_permissions =  $val;
    }

    function set_user_perm_from($val)
    {
        $this->user_perm_from =  $val;
    }

    function set_user_ip($val)
    {
        $this->user_ip =  $val;
    }

    function set_user_regdate($val)
    {
        $this->user_regdate =  $val;
    }

    function set_username($val)
    {
        $this->username =  $val;
    }

    function set_username_clean($val)
    {
        $this->username_clean =  $val;
    }

    function set_user_password($val)
    {
        $this->user_password =  $val;
    }

    function set_user_passchg($val)
    {
        $this->user_passchg =  $val;
    }

    function set_user_email($val)
    {
        $this->user_email =  $val;
    }

    function set_user_email_hash($val)
    {
        $this->user_email_hash =  $val;
    }

    function set_user_birthday($val)
    {
        $this->user_birthday =  $val;
    }

    function set_user_lastvisit($val)
    {
        $this->user_lastvisit =  $val;
    }

    function set_user_lastmark($val)
    {
        $this->user_lastmark =  $val;
    }

    function set_user_lastpost_time($val)
    {
        $this->user_lastpost_time =  $val;
    }

    function set_user_lastpage($val)
    {
        $this->user_lastpage =  $val;
    }

    function set_user_last_confirm_key($val)
    {
        $this->user_last_confirm_key =  $val;
    }

    function set_user_last_search($val)
    {
        $this->user_last_search =  $val;
    }

    function set_user_warnings($val)
    {
        $this->user_warnings =  $val;
    }

    function set_user_last_warning($val)
    {
        $this->user_last_warning =  $val;
    }

    function set_user_login_attempts($val)
    {
        $this->user_login_attempts =  $val;
    }

    function set_user_inactive_reason($val)
    {
        $this->user_inactive_reason =  $val;
    }

    function set_user_inactive_time($val)
    {
        $this->user_inactive_time =  $val;
    }

    function set_user_posts($val)
    {
        $this->user_posts =  $val;
    }

    function set_user_lang($val)
    {
        $this->user_lang =  $val;
    }

    function set_user_timezone($val)
    {
        $this->user_timezone =  $val;
    }

    function set_user_dateformat($val)
    {
        $this->user_dateformat =  $val;
    }

    function set_user_style($val)
    {
        $this->user_style =  $val;
    }

    function set_user_rank($val)
    {
        $this->user_rank =  $val;
    }

    function set_user_colour($val)
    {
        $this->user_colour =  $val;
    }

    function set_user_new_privmsg($val)
    {
        $this->user_new_privmsg =  $val;
    }

    function set_user_unread_privmsg($val)
    {
        $this->user_unread_privmsg =  $val;
    }

    function set_user_last_privmsg($val)
    {
        $this->user_last_privmsg =  $val;
    }

    function set_user_message_rules($val)
    {
        $this->user_message_rules =  $val;
    }

    function set_user_full_folder($val)
    {
        $this->user_full_folder =  $val;
    }

    function set_user_emailtime($val)
    {
        $this->user_emailtime =  $val;
    }

    function set_user_topic_show_days($val)
    {
        $this->user_topic_show_days =  $val;
    }

    function set_user_topic_sortby_type($val)
    {
        $this->user_topic_sortby_type =  $val;
    }

    function set_user_topic_sortby_dir($val)
    {
        $this->user_topic_sortby_dir =  $val;
    }

    function set_user_post_show_days($val)
    {
        $this->user_post_show_days =  $val;
    }

    function set_user_post_sortby_type($val)
    {
        $this->user_post_sortby_type =  $val;
    }

    function set_user_post_sortby_dir($val)
    {
        $this->user_post_sortby_dir =  $val;
    }

    function set_user_notify($val)
    {
        $this->user_notify =  $val;
    }

    function set_user_notify_pm($val)
    {
        $this->user_notify_pm =  $val;
    }

    function set_user_notify_type($val)
    {
        $this->user_notify_type =  $val;
    }

    function set_user_allow_pm($val)
    {
        $this->user_allow_pm =  $val;
    }

    function set_user_allow_viewonline($val)
    {
        $this->user_allow_viewonline =  $val;
    }

    function set_user_allow_viewemail($val)
    {
        $this->user_allow_viewemail =  $val;
    }

    function set_user_allow_massemail($val)
    {
        $this->user_allow_massemail =  $val;
    }

    function set_user_options($val)
    {
        $this->user_options =  $val;
    }

    function set_user_avatar($val)
    {
        $this->user_avatar =  $val;
    }

    function set_user_avatar_type($val)
    {
        $this->user_avatar_type =  $val;
    }

    function set_user_avatar_width($val)
    {
        $this->user_avatar_width =  $val;
    }

    function set_user_avatar_height($val)
    {
        $this->user_avatar_height =  $val;
    }

    function set_user_sig($val)
    {
        $this->user_sig =  $val;
    }

    function set_user_sig_bbcode_uid($val)
    {
        $this->user_sig_bbcode_uid =  $val;
    }

    function set_user_sig_bbcode_bitfield($val)
    {
        $this->user_sig_bbcode_bitfield =  $val;
    }

    function set_user_jabber($val)
    {
        $this->user_jabber =  $val;
    }

    function set_user_actkey($val)
    {
        $this->user_actkey =  $val;
    }

    function set_user_newpasswd($val)
    {
        $this->user_newpasswd =  $val;
    }

    function set_user_form_salt($val)
    {
        $this->user_form_salt =  $val;
    }

    function set_user_new($val)
    {
        $this->user_new =  $val;
    }

    function set_user_reminded($val)
    {
        $this->user_reminded =  $val;
    }

    function set_user_reminded_time($val)
    {
        $this->user_reminded_time =  $val;
    }

}
/* End of generated class */
