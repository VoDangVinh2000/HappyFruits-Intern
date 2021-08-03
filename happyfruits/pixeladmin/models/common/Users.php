<?php
require_once(ABSOLUTE_PATH . 'models/base/BaseUsers.php');

define('KIMTUYET_USER_ID', 79);
define('KIEUOANH_USER_ID', 61);
define('THUYDUONG_USER_ID', 127);
define('THUYLINH_USER_ID', 159);
define('NGOCHUE_USER_ID', 156);
define('BANHANG1_USER_ID', 154);
define('BANHANG2_USER_ID', 158);
define('CHITHANH_USER_ID', 80);
define('NGUYENKHANH_USER_ID', 168);
/**
 * Class declaration
 */
class Users extends BaseUsers
{
    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Users';
    }

    static function do_login($user, $admin_logged_as_member = 0)
    {
        if (!session_id())
            session_start();
        set_session_val('user', $user);
        if (!$admin_logged_as_member) {
            $user_ip = get_user_ip();
            self::_insert('logs', array('user_id' => $user['user_id'], 'ip_address' => $user_ip, 'login_time' => array('NOW()')));
        } else
            set_session_val('admin_logged_as_member', 1);
    }

    static function do_logout()
    {
        $user_id = self::get_userdata('user_id');
        $update_sql = "UPDATE logs SET logout_time = NOW() WHERE login_time = (SELECT * FROM (SELECT MAX(l.login_time) FROM logs l WHERE l.user_id = '$user_id') as temp)";
        self::_do_sql($update_sql);
        if (session_id())
            session_destroy();
    }

    static function get_logged_user()
    {
        return get_session_val('user');
    }

    static function get_userdata($fieldname, $default = '')
    {
        $user = get_session_val('user');
        if (!empty($user) && !empty($user[$fieldname]))
            return $user[$fieldname];
        return $default;
    }

    static function is_logged()
    {
        return self::get_userdata('user_id');
    }

    static function is_admin_logged_as_member()
    {
        return get_session_val('admin_logged_as_member');
    }

    static function is_super_admin($user_id = '')
    {
        if ($user_id)
            $user = self::_select_one('users', array('user_id' => $user_id, 'deleted' => 0));
        else
            $user = get_session_val('user');
        return (!empty($user) && !empty($user['type_id']) && $user['type_id'] == SUPER_ADMIN_TYPE_ID);
    }

    static function is_admin($user_id = '')
    {
        if ($user_id)
            $user = self::_select_one('users', array('user_id' => $user_id, 'deleted' => 0));
        else
            $user = get_session_val('user');
        return (!empty($user) && !empty($user['type_id']) && in_array($user['type_id'], array(ADMIN_TYPE_ID, SUPER_ADMIN_TYPE_ID)));
    }

    static function is_member($user_id = '')
    {
        if ($user_id)
            $user = self::_select_one('users', array('user_id' => $user_id, 'deleted' => 0));
        else
            $user = get_session_val('user');
        return (!empty($user) && !empty($user['type_id']) && in_array($user['type_id'], array(MEMBER_TYPE_ID, SHIFT_LEADER_1_TYPE_ID, SHIFT_LEADER_2_TYPE_ID)));
    }

    static function is_shift_leader($user_id = '')
    {
        if ($user_id)
            $user = self::_select_one('users', array('user_id' => $user_id, 'deleted' => 0));
        else
            $user = get_session_val('user');
        return (!empty($user) && !empty($user['type_id']) && in_array($user['type_id'], array(SHIFT_LEADER_1_TYPE_ID, SHIFT_LEADER_2_TYPE_ID)));
    }

    static function is_group1($user_id = '')
    {
        if (empty($user_id)) {
            $user = get_session_val('user');
            $user_id = $user['user_id'];
        }

        return in_array($user_id, env("GROUP1_USER_IDS", array(THUYLINH_USER_ID, NGOCHUE_USER_ID, NGUYENKHANH_USER_ID)));
    }

    static function is_group2($user_id = '')
    {
        if (empty($user_id)) {
            $user = get_session_val('user');
            $user_id = $user['user_id'];
        }
        return in_array($user_id, env("GROUP2_USER_IDS", array(KIEUOANH_USER_ID)));
    }

    static function is_sales_group($user_id = '')
    {
        if (empty($user_id)) {
            $user = get_session_val('user');
            $user_id = $user['user_id'];
        }
        return in_array($user_id, env("SALES_GROUP_USER_IDS", array(KIMTUYET_USER_ID, NGUYENKHANH_USER_ID)));
    }

    static function is_designs_group($user_id = '')
    {
        if (empty($user_id)) {
            $user = get_session_val('user');
            $user_id = $user['user_id'];
        }
        return in_array($user_id, env("DESIGN_GROUP_USER_IDS", array(CHITHANH_USER_ID)));
    }

    static function is_public_group($user_id = '')
    {
        if (empty($user_id)) {
            $user = get_session_val('user');
            $user_id = $user['user_id'];
        }
        return in_array($user_id, env("PUBLIC_GROUP_USER_IDS", array(BANHANG1_USER_ID, BANHANG2_USER_ID)));
    }

    static function do_shipping($user_id = '')
    {
        if ($user_id)
            $user = self::_select_one('users', array('user_id' => $user_id, 'deleted' => 0));
        else
            $user = get_session_val('user');
        return (!empty($user) && !empty($user['do_shipping']) && $user['do_shipping'] == 1);
    }

    static function is_fulltime($user_id = '')
    {
        if ($user_id)
            $user = self::_select_one('users', array('user_id' => $user_id, 'deleted' => 0));
        else
            $user = get_session_val('user');
        return !empty($user) && !empty($user['is_fulltime']);
    }

    static function can_access($section, $action = '', $user_id = '')
    {
        if (empty($user_id)) {
            $user = get_session_val('user');
            if ($user)
                $user_id = $user['user_id'];
        }
        switch ($section) {
            case 'error':
            case 'postback':
                return 1;
                break;
            case 'default':
                switch ($action) {
                    case 'index':
                        return self::is_logged();
                        break;
                    case 'login':
                        return 1;
                        break;
                    case 'chart':
                        return self::is_super_admin($user_id);
                        break;
                }
                break;
            case 'user':
                switch ($action) {
                    case 'index':
                    case 'edit':
                    case 'add':
                        return self::is_admin($user_id) || self::is_admin_logged_as_member() || in_array($user_id, array(THUYDUONG_USER_ID));
                        break;
                    case 'profile':
                        return self::is_member($user_id);
                        break;
                }
                break;
            case 'customer':
                switch ($action) {
                    case 'index':
                        //return self::is_super_admin($user_id) || (self::is_member($user_id) && strtotime(self::get_userdata('created_dtm').' + 2 months') <= time());
                        return self::is_super_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'edit':
                    case 'add':
                    case 'modify':
                        return self::is_super_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'view_report':
                        return self::is_super_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'register':
                        return 1;
                    break;
                    case 'loginCustomer':
                        return 1;
                    break;
                }
                break;
            case 'customerdebt':
                switch ($action) {
                    case 'index':
                    case 'done':
                    case 'edit':
                    case 'add':
                    case 'delete':
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'view_summary':
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                }
                break;
            case 'assessment':
                switch ($action) {
                    case 'index':
                    case 'add_working_time':
                        return self::is_admin($user_id) || self::is_member($user_id);
                        break;
                    case 'edit':
                        return self::is_admin($user_id);
                    case 'add':
                        return self::is_admin($user_id) || self::is_member($user_id);
                        break;
                    case 'add_new_for_member':
                        return self::is_admin($user_id);
                        break;
                    case 'filter':
                        return self::is_admin($user_id);
                        break;
                    case 'view_report':
                        return self::is_admin($user_id);
                        break;
                    case 'calculate_kpi':
                        return self::is_super_admin($user_id);
                        break;
                }
                break;
            case 'shipping':
                switch ($action) {
                    case 'index':
                        return self::is_admin($user_id) || self::do_shipping($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                    case 'add':
                        return self::is_admin($user_id) || self::do_shipping($user_id);
                        break;
                    case 'add_new_for_member':
                        return self::is_admin($user_id);
                        break;
                    case 'filter':
                        return self::is_admin($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                        break;
                    case 'edit':
                        return self::is_admin($user_id);
                        break;
                    case 'fees':
                        return self::is_admin($user_id);
                        break;
                    case 'statistics':
                        return self::is_super_admin($user_id);
                        break;
                    case 'search':
                        return self::is_admin($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                        break;
                }
                break;
            case 'category':
                switch ($action) {
                    case 'index':
                    case 'edit':
                    case 'add':
                        return self::is_admin($user_id);
                        break;
                    case 'manage_images':
                        return self::is_super_admin($user_id) || self::is_sales_group($user_id) || self::is_designs_group($user_id);
                        break;
                }
                break;
            case 'product':
                switch ($action) {
                    case 'index':
                        return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_designs_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id) || self::is_public_group($user_id);
                        break;
                    case 'edit':
                    case 'add':
                    case 'manage':
                        return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_designs_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id) || self::is_public_group($user_id);
                        break;
                    case 'delete':
                        return self::is_admin($user_id);
                        break;
                    case 'manage_images':
                        return self::is_super_admin($user_id) || self::is_sales_group($user_id) || self::is_designs_group($user_id) || self::is_group1($user_id);
                        break;
                    case 'components':
                        return self::is_admin($user_id);
                        break;
                }
                break;
            case 'price':
                switch ($action) {
                    case 'index':
                        return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id) || self::is_public_group($user_id);
                        break;
                }
                break;
            case 'order':
                switch ($action) {
                    case 'index':
                        return self::is_admin($user_id) || self::is_shift_leader($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                        break;
                    case 'view_all':
                        return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                    case 'filter':
                        return self::is_admin($user_id) || self::is_shift_leader($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                        break;
                    case 'edit_note':
                        return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id);
                    case 'filter_all_dates':
                        return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                        break;
                    case 'filter_all_dates_in_3_months':
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'filter_branch':
                        return self::is_admin($user_id) || self::is_shift_leader($user_id);
                    case 'view_summary':
                        return self::is_admin($user_id) || self::is_shift_leader($user_id);
                        break;
                    case 'edit':
                        return self::is_admin($user_id) || self::is_shift_leader($user_id);
                    case 'delete':
                        return self::is_super_admin($user_id);
                        break;
                    case 'manage':
                        return self::is_logged();
                        break;
                    case 'add_note':
                        return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                        break;
                    case 'find':
                        return self::is_super_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'view_email':
                        return self::is_admin($user_id) || self::is_group2($user_id) || self::is_sales_group($user_id);
                        break;
                }
                break;
            case 'statistics':
                switch ($action) {
                    case 'index':
                        return self::is_super_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'chart':
                        return self::is_super_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'view_report':
                        return self::is_admin($user_id);
                }
                break;
            case 'provider':
                return self::is_admin($user_id) || self::is_shift_leader($user_id) || self::is_sales_group($user_id) || self::is_group2($user_id);
                break;
            case 'inventoryfruits':
                switch ($action) {
                    case 'send_warning_email':
                        return 1;
                    default:
                        return self::is_admin($user_id) || self::is_shift_leader($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                }
            case 'inventory':
                return self::is_admin($user_id) || self::is_shift_leader($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                break;
            case 'voucher':
                switch ($action) {
                    case 'index':
                        return self::is_admin($user_id) || self::is_shift_leader($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                    case 'edit':
                        return self::is_admin($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                    case 'add':
                        return self::is_admin($user_id);
                        break;
                    case 'delete':
                        return self::is_super_admin($user_id) || self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'handle_all_branches':
                        return self::is_super_admin($user_id);
                        break;
                }
                break;
            case 'document':
                switch ($action) {
                    case 'index':
                    case 'view':
                        return 1;
                    case 'edit':
                    case 'add':
                    case 'modify':
                        return self::is_admin($user_id);
                        break;
                }
                break;
            case 'frontend':
                switch ($action) {
                    case 'modify_shift_data':
                        return self::is_admin($user_id) || self::is_shift_leader($user_id);
                    default:
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                }

                break;
            case 'frontend-mangement':
                return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_designs_group($user_id) || self::is_group2($user_id);
                break;
            case 'image':
                return self::get_userdata('user_id') == 1 || self::is_sales_group($user_id) || self::is_designs_group($user_id);
                break;
            case 'page':
                switch ($action) {
                    case 'index':
                    case 'edit':
                    case 'add':
                    case 'modify':
                        return self::is_super_admin($user_id);
                        break;
                    case 'view':
                        return 1;
                }
                break;
            case 'tag':
                switch ($action) {
                    case 'index':
                        return self::get_userdata('user_id') == 1 || self::is_group2($user_id) || self::is_designs_group($user_id);
                        break;
                }
                break;
            case 'IP':
                switch ($action) {
                    case 'add':
                        return self::is_admin($user_id) || self::is_shift_leader($user_id);
                        break;
                }
                break;
            case 'announcement':
                switch ($action) {
                    case 'index':
                    case 'add':
                    case 'edit':
                        return self::get_userdata('user_id') == 1 || self::is_sales_group($user_id) || self::is_designs_group($user_id) || self::is_group2($user_id);
                        break;
                }
                break;
            case 'gallery':
                switch ($action) {
                    case 'index':
                        return self::get_userdata('user_id') == 1 || self::is_sales_group($user_id) || self::is_designs_group($user_id);
                        break;
                }
                break;
            case 'salaryadvance':
                switch ($action) {
                    case 'index':
                    case 'edit':
                    case 'add':
                    case 'delete':
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                }
                break;
            case 'setting':
                return self::is_admin($user_id);
                break;
            case 'promotioncode':
                return self::is_admin($user_id) || self::is_sales_group($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                break;
            case 'branch':
                return self::is_super_admin($user_id);
                break;
            case 'payment':
                switch ($action) {
                    case 'manage':
                        return self::is_admin($user_id) || self::is_group1($user_id) || self::is_group2($user_id);
                }
                break;
            case 'cost':
                switch ($action) {
                    case 'index':
                    case 'edit':
                    case 'add':
                    case 'delete':
                    case 'type':
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'view_report':
                    case 'view_summary':
                        return self::is_admin($user_id);
                        break;
                }
                break;
            case 'debt':
                switch ($action) {
                    case 'index':
                    case 'done':
                    case 'edit':
                    case 'add':
                    case 'delete':
                    case 'type':
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'view_summary':
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                    case 'add_payment':
                        return self::is_admin($user_id) || self::is_group2($user_id);
                        break;
                }
                break;
        }
        return self::get_userdata('user_id') == 1;
    }

    static function can($action, $section, $user_id = '')
    {
        return self::can_access($section, $action, $user_id);
    }

    static function cannot($action, $section, $user_id = '')
    {
        return !self::can_access($section, $action, $user_id);
    }

    function get_list($filters = array(), $view = '', $action = '')
    {
        $sql = 'SELECT users.*, user_types.type_name FROM users INNER JOIN user_types ON users.type_id = user_types.type_id';
        $rs = self::_do_select_sql($sql, $filters);
        if (empty($view) || !$rs)
            return $rs;
        else {
            $return_arr = array();
            foreach ($rs as $user) {
                if (!self::can_access($view, $action, $user['user_id']))
                    continue;
                $return_arr[] = $user;
            }
        }
        return $return_arr;
    }

    function get_user_types($filters = array())
    {
        return self::_select('user_types', $filters, 'type_id DESC');
    }

    function get_members($filters = array())
    {
        $filters = array_merge(array(
            'users.enabled' => '1',
            'users.deleted' => '0',
            'where' => 'users.type_id > 2',
            'order_by' => 'fullname'
        ), $filters);
        return $this->get_list($filters);
    }

    function get_cashiers($filters = array())
    {
        $filters = array_merge(array(
            'users.enabled' => '1',
            'users.deleted' => '0',
            'order_by' => 'fullname'
        ), $filters);
        return $this->get_list($filters, 'payment', 'manage');
    }
}
/* End of users class */
