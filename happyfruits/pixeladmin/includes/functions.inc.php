<?php

$last_query = '';

/**
 * Gets the users IP address
 */
function get_user_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

/**
 * Gets the IP address of the server
 */
function get_server_ip()
{
    if (!array_key_exists("SERVER_ADDR", $_SERVER)) {
        $host = gethostname();
        $ip = strtolower(trim(gethostbyname($host)));
    } else {
        $ip = $_SERVER['SERVER_ADDR'];
    }

    return $ip;
}

function post($key, $default = "")
{
    if (!array_key_exists($key, $_POST)) {
        return $default;
    }
    if (is_array($_POST[$key]) || is_object($_POST[$key]))
        return $_POST[$key];
    return is_string($_POST[$key]) ? trim($_POST[$key]) : $_POST[$key];
}

function get($key, $default = "")
{
    if (!array_key_exists($key, $_GET)) {
        return $default;
    }
    if (is_array($_GET[$key]) || is_object($_GET[$key]))
        return $_GET[$key];
    return is_string($_GET[$key]) ? trim($_GET[$key]) : $_GET[$key];
}

function request($key, $default = "")
{
    if (!array_key_exists($key, $_REQUEST)) {
        $rs = post($key, $default);
        if (!$rs)
            $rs = get($key, $default);
        return $rs;
    }
    if (is_array($_REQUEST[$key]) || is_object($_REQUEST[$key]))
        return $_REQUEST[$key];
    return is_string($_REQUEST[$key]) ? trim($_REQUEST[$key]) : $_REQUEST[$key];
}

function password_encrypt($raw_pass, $username)
{
    return substr(md5(SALT . $raw_pass . $username), 0, PASSWORD_LENGTH);
}

function set_session_val($field, $val)
{
    $_SESSION[$field] = $val;
}

function get_session_val($field, $default = '')
{
    if (isset($_SESSION[$field]))
        return $_SESSION[$field];
    return $default;
}

function delete_sesion_val($field)
{
    unset($_SESSION[$field]);
}

function set_last_error($error, $data_return = '')
{
    if (!session_id())
        session_start();
    $_SESSION['last_error'] = $error;
    $_SESSION['last_data_return'] = $data_return;
}

function get_last_error(&$data_return)
{
    $data_return = get_session_val('last_data_return');
    $error = get_session_val('last_error');
    unset($_SESSION['last_data_return']);
    unset($_SESSION['last_error']);
    return $error;
}

function set_last_message($msg)
{
    set_session_val('last_message', $msg);
}

function get_last_message()
{
    $msg = get_session_val('last_message');
    unset($_SESSION['last_message']);
    return $msg;
}


function get_last_query()
{
    global $last_query;
    return $last_query;
}

function get_g_order_items($filters = array())
{
    $sql = 'SELECT g_order_items.*, products.unit, products.name as product_name, products.english_name as product_english_name, products.unit, categories.name as category_name, categories.english_name as category_english_name
            FROM g_order_items
            INNER JOIN products ON products.product_id = g_order_items.product_id
            INNER JOIN categories ON categories.category_id = products.category_id';
    $filters['g_order_items.deleted'] = 0;
    return eModel::_do_sql($sql, $filters, array(), 'g_order_items.id');
}

function get_setting_options($lang_code = 'vi')
{
    static $settings = array(
        'vi' => array(),
        'en' => array()
    );
    if(!empty($settings[$lang_code]))
        return $settings[$lang_code];
    $_settings = eModel::_select('settings');
    $settings['vi'] = Hash::combine($_settings, '{n}.option_name', '{n}.option_value');
    $settings['en'] = Hash::combine($_settings, '{n}.option_name', '{n}.option_value_en');
    return $settings[$lang_code];
}

function get_setting($field, $default = '', $lang_code = 'vi')
{
    $settings = get_setting_options($lang_code);
    return isset($settings[$field])?$settings[$field]:$default;
}

function set_setting($field, $value, $lang_code = '')
{
    if($lang_code && strpos($lang_code, '_') === false)
        $lang_code = '_'. $lang_code;
    return eModel::_update('settings', array('option_name' => $field), array('option_value'.$lang_code => $value));
}

function add_balance($amount, $payment_type = 'cash')
{
    if (strstr($payment_type, 'cash'))
        $payment_type = 'cash';
    else
        $payment_type = 'bank_balance';
    $balance = intval(get_setting($payment_type));
    $balance += intval($amount);
    set_setting($payment_type, $balance);
}

function subtract_balance($amount, $payment_type = 'cash')
{
    if (strstr($payment_type, 'cash'))
        $payment_type = 'cash';
    else
        $payment_type = 'bank_balance';
    $balance = intval(get_setting($payment_type));
    $balance -= intval($amount);
    set_setting($payment_type, $balance);
}

function get_lastest_modified_dtm($table_names)
{
    if (empty($table_names))
        return 0;
    $dtm = '';
    if (is_array($table_names)) {
        foreach ($table_names as $name) {
            $r = eModel::_select_one($name, array('order_by' => 'modified_dtm DESC'));
            if ($r)
                $dtm .= strtotime($r['modified_dtm']);
        }
    } else {
        $r = eModel::_select_one($table_names, array('order_by' => 'modified_dtm DESC'));
        if ($r)
            $dtm .= strtotime($r['modified_dtm']);
    }
    return $dtm;
}

function get_current_url()
{
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
    return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function redirect($url = '')
{
    if (empty($url)) {
        if (get_session_val('is_frontend')) {
            if (Users::can_access('tag', 'index'))
                $url = 'quan-ly-nhom';
            elseif (Users::can_access('announcement', 'index'))
                $url = 'quan-ly-thong-bao';
        }

        if (Users::is_super_admin()) {
            $new_url = '';
            $menu_type = get_session_val('menu_type', 'general');
            global $menu_items;
            foreach ($menu_items as $code => $config) {
                if ($new_url)
                    break;
                if ($config['menu_type'] != $menu_type)
                    continue;
                if (!empty($config['sub_menu_items'])) {
                    foreach ($config['sub_menu_items'] as $s_code => $s_config)
                        if (Users::can_access($code, $s_code)) {
                            $new_url = $s_config['url'];
                            break;
                        }

                } else {
                    if (Users::can_access($code, 'index')) {
                        $new_url = $config['url'];
                        break;
                    }
                }
            }
            if ($new_url)
                $url = $new_url;
        }
    }
    if (empty($url)) {
        $url = BASE_URL;
    }
    if (!strstr($url, 'http'))
        $url = BASE_URL . $url;
    header('Location: ' . $url);
    exit;
}

function get_geo($address)
{
    require_once 'geocoder/autoload.php';
    $adapter = new \Geocoder\HttpAdapter\CurlHttpAdapter();
    $chain = new \Geocoder\Provider\ChainProvider(array(
        new \Geocoder\Provider\FreeGeoIpProvider($adapter),
        new \Geocoder\Provider\HostIpProvider($adapter),
        new \Geocoder\Provider\GoogleMapsProvider($adapter),
    ));
    $geocoder = new \Geocoder\Geocoder();
    $geocoder->registerProvider($chain);
    try {
        return $geocoder->geocode($address);
    } catch (Exception $e) {
        return false;
    }
    return false;
}

function getDrivingDistance($lat1, $lng1, $lat2, $lng2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . "," . $lng1 . "&destinations=" . $lat2 . "," . $lng2 . "&mode=driving";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

    //return array('distance' => $dist, 'time' => $time);
    return $dist;
}

function getDistanceFromBranch($lat, $lng, $branch_id)
{
    $branch = eModel::_select_one('branches', array('id' => $branch_id));
    if ($branch) {
        return getDrivingDistance($branch['lat'], $branch['lng'], $lat, $lng);
    }
    return -1;
}

function beginTransaction()
{
    global $dbh;
    global $beginTransaction;
    $dbh->beginTransaction();
    $beginTransaction = 1;
}

function _commitTransaction()
{
    global $dbh;
    global $beginTransaction;
    if (!empty($beginTransaction)) {
        $dbh->commit();
        $beginTransaction = 0;
    }
}

function _rollBackTransaction()
{
    global $dbh;
    global $beginTransaction;
    if (!empty($beginTransaction)) {
        $dbh->rollBack();
        $beginTransaction = 0;
    }
}

function send($arr = '')
{
    if (empty($arr)) {
        global $return;
        $arr = $return;
    }
    echo json_encode($arr);
    die;
}

function error($msg, $code = 'ERROR')
{
    global $return;
    $return["status"] = $code;
    $return["message"] = $msg;
    _rollBackTransaction();
    send($return);
}

function ok($msg = '')
{
    global $return;
    $return["status"] = "OK";
    $return["message"] = $msg;
    _commitTransaction();
    send($return);
}

function debug($msg)
{
    $fp = fopen('debug.txt', 'a');
    fwrite($fp, $msg . "\n");
    fclose($fp);
}

function dbImportSQLFile($filepath)
{
    global $dbh;
    if (!file_exists($filepath))
        return false;
    $sql = file_get_contents($filepath);
    $sentences = explode(';', $sql);
    if (empty($sentences))
        return false;
    $rs = true;
    foreach ($sentences as $s) {
        $s = trim($s);
        if (!empty($s)) {
            try {
                $result = $dbh->query($s);
                if (!$result) {
                    debug("An error occurred whilst trying to run to query: $s in $filepath");
                    $rs = false;
                }
            } catch (Exception $e) {
                debug($s) . "\n";
                debug($e->getMessage());
                return false;
            }
        }
    }
    return $rs;
}

function getvalue($arr, $field, $default = null)
{
    if (!empty($arr)) {
        if (is_array($arr) && isset($arr[$field]))
            return $arr[$field];
        elseif (is_object($arr) && isset($arr->$field))
            return $arr->$field;
    }
    return $default;
}

function include2string($path, $data)
{
    $branch = eModel::_select_one('branches', array('id' => LHP_BRANCH_ID));
    extract($data);
    ob_start();
    include($path);
    return ob_get_clean();
}

function cleanDataForExcel(&$str)
{
    // escape tab characters
    $str = preg_replace("/\t/", "\\t", $str);
    // escape new lines
    $str = preg_replace("/\r?\n/", "\\n", $str);
    // convert 't' and 'f' to boolean values
    if ($str == 't') $str = 'TRUE';
    if ($str == 'f') $str = 'FALSE';
    // force certain number/date formats to be imported as strings
    if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
        $str = "'$str";
    }
    // escape fields that include double quotes
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

function capitalize($str, $lower_rest_parts = false, $encoding = 'UTF-8')
{
    $words = explode(' ', $str);
    $return_str = '';
    foreach ($words as $word) {
        $word = trim($word);
        if ($return_str)
            $return_str .= ' ';
        if ($lower_rest_parts)
            $return_str .= mb_strtoupper(mb_substr($word, 0, 1, $encoding), $encoding) . mb_strtolower(mb_substr($word, 1, mb_strlen($word), $encoding), $encoding);
        else
            $return_str .= mb_strtoupper(mb_substr($word, 0, 1, $encoding), $encoding) . mb_substr($word, 1, mb_strlen($word), $encoding);
    }
    return $return_str;
}

function e_ucfirst($str, $encoding = 'UTF-8')
{
    return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding) . mb_strtolower(mb_substr($str, 1, mb_strlen($str), $encoding), $encoding);
}

function customer_name_from_address($address)
{
    $customer_name = '';
    $words = explode(' ', $address);
    foreach ($words as $w) {
        if ($customer_name == '')
            $customer_name = $w . ' ';
        else {
            $customer_name .= mb_substr($w, 0, 1, 'UTF-8');
        }
    }
    return trim($customer_name);
}

function force_download($file)
{
    if (file_exists($file)) {
        if (FALSE !== ($handler = fopen($file, 'r'))) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: chunked'); //changed to chunked
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');

            //Send the content in chunks
            while (false !== ($chunk = fread($handler, 4096))) {
                echo $chunk;
            }
        }
        return 1;
    }
    return 0;
}

if (!function_exists('word_limiter')) {
    function word_limiter($str, $limit = 100, $end_char = '&#8230;')
    {
        if (trim($str) == '') {
            return $str;
        }
        preg_match('/^\s*+(?:\S++\s*+){1,' . (int)$limit . '}/', $str, $matches);
        if (strlen($str) == strlen($matches[0])) {
            $end_char = '';
        }
        return rtrim($matches[0]) . $end_char;
    }
}

function html_select_district($class = 'required', $empty_text = "Chọn", $extra = "", $is_multiple_language = false, $selected = '')
{
    
    if (!$is_multiple_language) {
        $id = 'id="district"';
        if (strstr($extra, ' id="'))
            $id = '';
        $name = 'name="district"';
        if (strstr($extra, ' name="'))
            $name = '';
        $html = '<select class="' . $class . '" ' . $extra . ' ' . $id . ' ' . $name . 'required >
                <option value="">' . $empty_text . '</option>
                <option value="Thành phố Thủ Đức" ' . ($selected == 'Thành phố Thủ Đức' ? 'selected=""' : '') . ' title="Thanh pho Thu Duc">Thành phố Thủ Đức</option>

                <option value="1" ' . ($selected == 1 ? 'selected=""' : '') . ' title="1">Quận 1</option>
                 
                <option value="3" ' . ($selected == 3 ? 'selected=""' : '') . ' title="3">Quận 3</option>
                <option value="4" ' . ($selected == 4 ? 'selected=""' : '') . ' title="4">Quận 4</option>
                <option value="5" ' . ($selected == 5 ? 'selected=""' : '') . ' title="5">Quận 5</option>
                <option value="6" ' . ($selected == 6 ? 'selected=""' : '') . ' title="6">Quận 6</option>
                <option value="7" ' . ($selected == 7 ? 'selected=""' : '') . ' title="7">Quận 7</option>
                <option value="8" ' . ($selected == 8 ? 'selected=""' : '') . ' title="8">Quận 8</option>
                
                <option value="10" ' . ($selected == 10 ? 'selected=""' : '') . ' title="10">Quận 10</option>
                <option value="11" ' . ($selected == 11 ? 'selected=""' : '') . ' title="11">Quận 11</option>
                <option value="12" ' . ($selected == 12 ? 'selected=""' : '') . ' title="11">Quận 12</option>
                <option value="Bình Chánh" ' . ($selected == 'Bình Chánh' ? 'selected=""' : '') . ' title="Binh Chanh">Huyện Bình Chánh</option>
                <option value="Bình Tân" ' . ($selected == 'Bình Tân' ? 'selected=""' : '') . ' title="Binh Tan">Quận Bình Tân</option>
                <option value="Bình Thạnh" ' . ($selected == 'Bình Thạnh' ? 'selected=""' : '') . ' title="Binh Thanh">Quận Bình Thạnh</option>
                <option value="Hóc Môn" ' . ($selected == 'Hóc Môn' ? 'selected=""' : '') . ' title="Hoc Mon">Huyện Hóc Môn</option>
                <option value="Gò Vấp" ' . ($selected == 'Gò Vấp' ? 'selected=""' : '') . ' title="Go Vap">Quận Gò Vấp</option>
                <option value="Phú Nhuận" ' . ($selected == 'Phú Nhuận' ? 'selected=""' : '') . ' title="Phu Nhuan">Quận Phú Nhuận</option>
                <option value="Tân Bình" ' . ($selected == 'Tân Bình' ? 'selected=""' : '') . ' title="Tan Binh">Quận Tân Bình</option>
                <option value="Tân Phú" ' . ($selected == 'Tân Phú' ? 'selected=""' : '') . ' title="Tan Phu">Quận Tân Phú</option>

                <option value="Nhà Bè" ' . ($selected == 'Nhà Bè' ? 'selected=""' : '') . ' title="Nha Be">Huyện Nhà Bè</option>
            </select>';
    } 
    else {
        $id = 'id="district"';
        if (strstr($extra, ' id="'))
            $id = '';
        $name = 'name="district"';
        if (strstr($extra, ' name="'))
            $name = '';
        $html = '<select class="' . $class . '" ' . $extra . ' ' . $id . ' ' . $name . ' >
                <option value="">' . $empty_text . '</option>
                <option value="Thành phố Thủ Đức" title="Thanh pho Thu Duc">{{__(\'Thành phố Thủ Đức\')}} </option>

                <option value="1" title="1">{{__(\'Quận\')}} 1</option>
                
                <option value="3" title="3">{{__(\'Quận\')}} 3</option>
                <option value="4" title="4">{{__(\'Quận\')}} 4</option>
                <option value="5" title="5">{{__(\'Quận\')}} 5</option>
                <option value="6" title="6">{{__(\'Quận\')}} 6</option>
                <option value="7" title="7">{{__(\'Quận\')}} 7</option>
                <option value="8" title="8">{{__(\'Quận\')}} 8</option>

                <option value="10" title="10">{{__(\'Quận\')}} 10</option>
                <option value="11" title="11">{{__(\'Quận\')}} 11</option>
                <option value="12" title="12">{{__(\'Quận\')}} 11</option>
                <option value="Bình Chánh" title="Binh Chanh">{{__(\'Huyện Bình Chánh\')}} </option>
                <option value="Bình Tân" title="Binh Tan">{{__(\'Quận Bình Tân\')}}</option>
                <option value="Bình Thạnh" title="Binh Thanh">{{__(\'Quận Bình Thạnh\')}}</option>
                <option value="Hóc Môn" title="Hoc Mon">{{__(\'Huyện Hóc Môn\')}}</option>
                <option value="Gò Vấp" title="Go Vap">{{__(\'Quận Gò Vấp\')}} </option>
                <option value="Phú Nhuận" title="Phu Nhuan">{{__(\'Quận Phú Nhuận\')}}</option>
                <option value="Tân Bình" title="Tan Binh">{{__(\'Quận Tân Bình\')}}</option>
                <option value="Tân Phú" title="Tan Phu">{{__(\'Quận Tân Phú\')}}</option>

                <option value="Nhà Bè" title="Nha Be">{{__(\'Huyện Nhà Bè\')}}</option>
            </select>';
    }
    return $html; 
}

function html_select_day($attribute, $empty_label = null, $selected = '')
{
    $source = array();
    for ($i = 1; $i <= 31; $i++) {
        $item['value'] = $i;
        $item['label'] = sprintf('%02d', $i);
        $source[] = $item;
    }
    return html_select($source, 'value', 'label', $attribute, $empty_label, $selected);
}

function html_select_month($attribute, $empty_label = null, $selected = '')
{
    $source = array();
    for ($i = 1; $i <= 12; $i++) {
        $item['value'] = $i;
        $item['label'] = sprintf('%02d', $i);
        $source[] = $item;
    }
    return html_select($source, 'value', 'label', $attribute, $empty_label, $selected);
}

function html_select_year($attribute, $empty_label = null, $selected = '')
{
    $source = array();
    for ($i = date('Y') - 2; $i <= date('Y'); $i++) {
        $item['value'] = $item['label'] = $i;
        $source[] = $item;
    }
    return html_select($source, 'value', 'label', $attribute, $empty_label, $selected);
}

function html_select_array($source_array, $attribute, $empty_label = null, $selected = '')
{
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $value => $label) {
            $selected_attr = ($value == $selected) ? 'selected = "selected"' : '';
            $html .= '   <option value="' . $value . '" ' . $selected_attr . '>' . $label . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function html_select($source_array, $value_field, $label_field, $attribute, $empty_label = null, $selected = '')
{
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $item) {
            if (!is_array($selected))
                $selected_attr = ($item[$value_field] == $selected) ? 'selected = "selected"' : '';
            else
                $selected_attr = in_array($item[$value_field], $selected) ? 'selected = "selected"' : '';
            $html .= '   <option value="' . $item[$value_field] . '" ' . $selected_attr . '>' . $item[$label_field] . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function html_select_optgroup($source_array, $value_field, $label_field, $opt_field, $attribute, $empty_label = null, $selected = '')
{
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    $groups = array();
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $item) {
            if (!isset($groups[$item[$opt_field]]))
                $groups[$item[$opt_field]] = array();
            $groups[$item[$opt_field]][] = $item;
        }

        foreach ($groups as $opt_label => $items) {
            $html .= ' <optgroup label="' . $opt_label . '">';
            foreach ($items as $item) {
                $selected_attr = ($item[$value_field] == $selected) ? 'selected = "selected"' : '';
                if (is_array($label_field)) {
                    $labels = array();
                    foreach($label_field as $f) {
                        $labels[] = $item[$f];
                    }
                    $label = implode(' - ', $labels);
                } else {
                    $label = $item[$label_field];
                }

                $html .= '   <option value="' . $item[$value_field] . '" ' . $selected_attr . '>' . $label . '</option>';
            }
            $html .= ' </optgroup>';
        }
    }
    $html .= '</select>';
    return $html;
}

 function remove_unicode($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
    return $str;
}

function get_code($str, $upper_case = 1)
{
    $str = remove_unicode($str);
    $str = preg_replace("/[^a-zA-Z0-9 ]/", "", $str);
    //Gets first characters of words
    $rs = '';
    $words = explode(' ', $str);
    foreach ($words as $w) {
        $rs .= substr($w, 0, 1);
    }
    if ($upper_case)
        $rs = strtoupper($rs);
    return $rs;
}

function get_id($str)
{
    $str = remove_unicode($str);
    $str = preg_replace("/[^a-zA-Z0-9 ]/", "", strtolower($str));
    return str_replace(' ', '_', $str);
}

function sanitize_string($str, $excluded_keywords = '')
{
    $str = remove_unicode($str);
    $str = preg_replace("/[^a-zA-Z0-9$excluded_keywords ]/", "", strtolower($str));
    return str_replace(' ', '-', $str);
}


function break_line($input, $end_line = '<br/>')
{
    $limit_length = 30;
    $s = $input;
    if (strlen($input) > $limit_length) {
        $line = '';
        $s = '';
        $words = explode(' ', $input);

        for ($i = 0; $i < sizeof($words); $i++) {
            if ($line)
                $line .= ' ';
            $temp = $line . $words[$i];
            if (strlen($temp) > $limit_length) {
                if ($s)
                    $s .= $end_line;
                $s .= $line;
                $line = $words[$i];
            } else
                $line = $temp;
        }
        if ($s)
            $s .= $end_line;
        $s .= $line;
    }
    return $s;
}

function random_string($length = 4, $only_number = 0, $only_alphabetic = 0)
{
    if ($only_number)
        $letters = '1234567890123456789012345678901234567890';
    else if ($only_alphabetic)
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';
    else
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    return substr(str_shuffle($letters), 0, $length);
}

function get_mail_body($order_type = 'foodpanda ')
{
    $imap = imap_open("{imap.efruit.vn:143/novalidate-cert}INBOX", "orders@efruit.vn", "mikjuji9k");
    $rs = imap_search($imap, 'SUBJECT "' . $order_type . '" SINCE "1 November 2014"');
    rsort($rs);
    $body = imap_body($imap, $rs[0]);
    imap_close($imap);
    return imap_qprint($body);
}

/* Input format dd/mm/yyyy */
function convert_to_iso_datetime($input, $input_format = '')
{
    if (empty($input))
        return null;
    if (empty($input_format)) {
        $d = explode('/', $input);
        if (count($d) != 3)
            return null;
        return $d[2] . '-' . $d[1] . '-' . $d[0];
    } else {
        $myDateTime = DateTime::createFromFormat($input_format, $input);
        return $myDateTime->format('Y-m-d H:i:s');
    }
    return null;
}

function get_directory_list($directory)
{
    // create an array to hold directory list
    $results = array();
    // create a handler for the directory
    $handler = opendir($directory);
    // open directory and walk through the filenames
    while ($file = readdir($handler)) {
        // if file isn't this directory or its parent, add it to the results
        if ($file != "." && $file != "..") {
            $results[] = $file;
        }
    }
    // tidy up: close the handler
    closedir($handler);
    // done!
    return $results;
}

function get_upload_path()
{
    $upload_path = EFRUIT_ABSOLUTE_PATH . 'uploads/';
    if (!file_exists($upload_path))
        mkdir($upload_path, 0777);
    /*
    $upload_path .= date('Y'). '/';
    if (!file_exists($upload_path))
        mkdir($upload_path, 0777);
    $upload_path .= date('m'). '/';
    if (!file_exists($upload_path))
        mkdir($upload_path, 0777);
    */
    return $upload_path;
}

function get_uploads_path_intern(){
    $upload_path = 'uploads/';
    // if (!file_exists($upload_path))
    //     mkdir($upload_path, 0777);
    return $upload_path;
}

function get_upload_url()
{
    return ROOT_URL . 'uploads/';
    //return ROOT_URL. 'uploads/'. date('Y'). '/'. date('m'). '/';
}

function get_image_path($image_data, $return_type = '')
{
    $path_parts = pathinfo($image_data['path']);
    if ($return_type)
        return EFRUIT_ABSOLUTE_PATH . $path_parts['dirname'] . "/$return_type/" . $path_parts['basename'];
    return EFRUIT_ABSOLUTE_PATH . "/" . $image_data['path'];
}

function get_image_url($image_data, $return_type = '')
{
    if (is_array($image_data)) {
        $path_parts = pathinfo($image_data['path']);
        if ($return_type)
            return ROOT_URL . $path_parts['dirname'] . "/$return_type/" . $image_data['filename'];
        return ROOT_URL . $path_parts['dirname'] . "/" . $image_data['filename'];
    } else if (is_string($image_data) && strstr($image_data, DOMAIN_NAME)) {
        if (!$return_type)
            return $image_data;
        $path_parts = pathinfo($image_data);
        if (strstr($image_data, 'http')) {
            return valid_url($path_parts['dirname'] . "/$return_type/" . $path_parts['basename']);
        }
        if (strstr($image_data, DOMAIN_NAME))
            return $path_parts['dirname'] . "/$return_type/" . $path_parts['basename'];
        return ROOT_URL . $path_parts['dirname'] . "/$return_type/" . $path_parts['basename'];
    }
    return $image_data;
}

function valid_url($url)
{
    if (strstr(ROOT_URL, 'https') && !strstr($url, 'https')) {
        return str_replace('http', 'https', $url);
    }
    return $url;
}

function generate_secure_id($id, $length = 3, $only_number = 1)
{
    return random_string($length, $only_number) . $id . random_string($length, $only_number);
}

function retrieve_id($text, $length = 3)
{
    return substr($text, $length, strlen($text) - $length * 2);
}

// Validate email address format in case client-side validation "fails"
function validate_email($email)
{
    $at = strrpos($email, "@");

    // Make sure the at (@) sybmol exists and
    // it is not the first or last character
    if ($at && ($at < 1 || ($at + 1) == strlen($email)))
        return false;

    // Make sure there aren't multiple periods together
    if (preg_match("/(\.{2,})/", $email))
        return false;

    // Break up the local and domain portions
    $local = substr($email, 0, $at);
    $domain = substr($email, $at + 1);


    // Check lengths
    $locLen = strlen($local);
    $domLen = strlen($domain);
    if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255)
        return false;

    // Make sure local and domain don't start with or end with a period
    if (preg_match("/(^\.|\.$)/", $local) || preg_match("/(^\.|\.$)/", $domain))
        return false;

    // Check for quoted-string addresses
    // Since almost anything is allowed in a quoted-string address,
    // we're just going to let them go through
    if (!preg_match('/^"(.+)"$/', $local)) {
        // It's a dot-string address...check for valid characters
        if (!preg_match('/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local))
            return false;
    }

    // Make sure domain contains only valid characters and at least one period
    if (!preg_match("/^[-a-zA-Z0-9\.]*$/", $domain) || !strpos($domain, "."))
        return false;

    /*    
    // include SMTP Email Validation Class
    require_once('smtp_validateEmail.class.php');
    
    // an optional sender
    $sender = 'sender@'. DOMAIN_NAME;
    // instantiate the class
    $SMTP_Validator = new SMTP_validateEmail();;
    // do the validation
    $results = $SMTP_Validator->validate(array($email), $sender);
    // check result
    if (!$results[$email]) {
        return false;
    }
    */
    return true;
}

function get_theme_dir()
{
    return EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . '/';
}

function get_theme_assets_dir()
{
    return get_theme_dir() . 'assets/';
}

function get_theme_url()
{
    return ROOT_URL . 'themes/' . ACTIVE_THEME . '/';
}

function get_theme_assets_url()
{
    return get_theme_url() . 'assets/';
}

function get_child_theme_assets_url()
{
    if ($child = env('CHILD_THEME')) {
        return get_theme_url() . 'child/' . $child. '/assets/';
    }
    return get_theme_url() . 'assets/';
}

function get_admin_theme_assets_url()
{
    $admin_theme_url = BASE_URL;
    if ($child = env('CHILD_THEME')) {
        return $admin_theme_url . 'child/' . $child. '/assets/';
    }
    return $admin_theme_url . 'assets/';
}

/**
 * @desc The invokeContentMethods method scans HTML code for PHP method markers and replaces the
 * marker with the resulting HTML that the php method creates (if the php method exists).
 * E.g. the marker [[PHP_myFunction]] would invoke the helper method myFunction and the marker
 * would be replaced with the resulting html.
 */
function invokeContentMethods($content, &$controler)
{
    // Find any instances in the text that match the pattern [[xx]]  (where x are digits)
    if (preg_match_all('/<p>?(.*)\[\[PHP_[\w()]+]\]?(<\/span>)<\/p>/', $content, $matchsets, PREG_PATTERN_ORDER)) {
        $matches = $matchsets[0];
        // Loop through all matches
        foreach ($matches as $match) {
            $search_term_length = 6;

            // Extrack out the block name (the value within the square brackets).
            $pos_start = strpos($match, "[[");
            $pos = strpos($match, "]", 2);

            // Extract out the method name (the value within the square brackets).

            if (($pos_start >= 0) && ($pos > 0)) {
                $search_term_length += $pos_start;
                $methodName = substr($match, $search_term_length, $pos - $search_term_length);

                $params = "";

                $pos_bracket = strrpos($methodName, "(");
                if ($pos_bracket > 0) {
                    $params = substr($methodName, $pos_bracket + 1, strlen($methodName) - ($pos_bracket + 2));
                    $methodName = substr($methodName, 0, $pos_bracket);
                }

                if (function_exists($methodName)) {
                    if ($params != "") {
                        $new_content = $methodName($params, $controler);
                    } else {
                        $new_content = $methodName($controler);
                    }

                    // Substitute the block marker with the actual block HTML
                    $content = str_replace($match, $new_content, $content);
                }
            }
        }
    }
    // Replace the content.
    return $content;
}

function minifyJS($js_files, $output_name = 'e')
{
    require_once "minify/jsmin.php";
    $js_dir = get_theme_assets_dir() . 'js/';
    $one_file_content = '';
    foreach ($js_files as $j_f) {
        $path = '';
        $j_f = str_replace(get_theme_assets_url(), get_theme_assets_dir(), $j_f);
        if (file_exists($j_f))
            $path = $j_f;
        else if (file_exists($js_dir . $j_f))
            $path = $js_dir . $j_f;
        if ($path) {
            $one_file_content .= "\n" . file_get_contents($path);
        }
    }
    $folder_path = pathinfo(get_theme_assets_dir() . $output_name, PATHINFO_DIRNAME);
    if (!file_exists($folder_path)) {
        mkdir($folder_path, 0777);
    }
    file_put_contents(get_theme_assets_dir() . $output_name . '.min.js', "\xEF\xBB\xBF" . JSMin::minify($one_file_content));
}

function minifyCSS($css_files, $output_name = 'e')
{
    require_once "minify/cssmin.php";

    $css_dir = get_theme_assets_dir() . 'css/';
    $one_file_content = '';
    foreach ($css_files as $f) {
        $path = '';
        $f = str_replace(get_theme_assets_url(), get_theme_assets_dir(), $f);
        if (file_exists($f))
            $path = $f;
        else if (file_exists($css_dir . $f))
            $path = $css_dir . $f;
        if ($path) {
            $one_file_content .= "\n" . file_get_contents($path);
        }
    }
    // Minify via CssMin adapter function
    $result = CssMin::minify($one_file_content);
    $folder_path = pathinfo(get_theme_assets_dir() . $output_name, PATHINFO_DIRNAME);
    if (!file_exists($folder_path)) {
        mkdir($folder_path, 0777);
    }
    file_put_contents(get_theme_assets_dir() . $output_name . '.min.css', $result);
}

function loadJS($url)
{
    $context = stream_context_create(array('http' => array('Content-Type' => 'text/javascript', 'enable_cache' => true, 'enable_optimistic_cache' => true, 'read_cache_expiry_seconds' => 86400,)));
    echo file_get_contents($url, false, $context);
}

/* For pre-booking */
function is_valid_delivery_time($delivery_datetime, $is_edit = 0)
{
    $pre_order_time = env('PREORDER_TIME', array(
        'start' => '08:00',
        'end' => '21:30'
    ));
    $pre_start = explode(':', $pre_order_time['start']);
    $pre_end = explode(':', $pre_order_time['end']);
    $startHour = $pre_start[0];
    $startMinute = $pre_start[1];
    $endHour = $pre_end[0];
    $endMinute = $pre_end[1];
    if (empty($delivery_datetime))
        return false;
    if (empty($is_edit)) {
        if ($delivery_datetime < strtotime('+1 day', strtotime(date('Y-m-d'))))
            return false;
        $hour = intval(date('H', $delivery_datetime));
        $minute = intval(date('i', $delivery_datetime));
        if ($hour < $startHour)
            return false;
        else if ($hour == $startHour && $minute < $startMinute)
            return false;
        else if ($hour > $endHour)
            return false;
        else if ($hour == $endHour && $minute > $endMinute)
            return false;
        return true;
    } else {
        if ($delivery_datetime < strtotime(date('Y-m-d')))
            return false;
        $hour = intval(date('H', $delivery_datetime));
        $minute = intval(date('i', $delivery_datetime));
        if ($hour < $startHour)
            return false;
        else if ($hour == $startHour && $minute < $startMinute)
            return false;
        else if ($hour > $endHour)
            return false;
        else if ($hour == $endHour && $minute > $endMinute)
            return false;
        return true;
    }
}

function get_shift_id($iso_datetime = '')
{
    if (empty($iso_datetime))
        $time = date('H:i:s');
    else
        $time = date('H:i:s', strtotime($iso_datetime));
    if ('00:00:00' <= $time && $time <= SHIFT_SEPARATOR_TIME . ':00')
        return 1;
    return 2;
}

function get_status_string($status)
{
    $statuses = get_status_options();
    return isset($statuses[$status]) ? $statuses[$status] : '';
}

function get_status_options()
{
    return array(
        'Pending' => 'Chờ xác nhận',
        'Wait for Staff Confirm' => 'Chờ nhân viên xác nhận',
        'In Process' => 'Đang thực hiện',
        'Process Completed' => 'Pha chế xong',
        'Shipping' => 'Đang giao hàng',
        'Completed' => 'Hoàn thành',
        'On Hold' => 'Tạm dừng',
        'Failed' => 'Đã hủy'
    );
}

function get_status_text($status)
{
    $options = get_status_options();
    return isset($options[$status])?$options[$status]:$status;
}

function can_edit_order($order)
{
    if (empty($order) || empty($order['status']))
        return false;
    return in_array($order['status'], array('Pending', 'Wait for Staff Confirm', 'In Process'));
}

function get_payment_method_string($method_code)
{
    $methods = get_payment_methods_options();
    return isset($methods[$method_code]) ? $methods[$method_code] : '';
}

function get_payment_methods_options()
{
    return array(
        'cod' => 'Thanh toán khi nhận hàng',
        'bank' => 'Chuyển khoản ngân hàng',
        'shipnow' => 'Thanh toán qua Ship Now',
        'moca' => 'Thanh toán qua Moca',
        'zalopay' => 'Thanh toán qua Zalo Pay',
        'vnpay' => 'Thanh toán qua VN Pay',
        'pay_later' => 'Thanh toán sau',
        'other' => 'Hình thức thanh toán khác',
        'momo' => "Thanh toán qua Momo",
    );
}

function is_prepaid_order($payment_method)
{
    return !empty($payment_method) && in_array($payment_method, array('bank', 'moca', 'zalopay', 'vnpay', 'shipnow','momo'));
}

function branch_2_is_off()
{
    global $is_off2;
    return $is_off2;
}

function get_shipping_fee($current_total, $distance)
{
    global $shipping_fees;
    $fees = $shipping_fees[0];
    $minTotal = $fee = 0;
    if (!empty($distance)) {
        if ($fees) {
            foreach ($fees as $d => $v) {
                $min = intval($d);
                if ($current_total >= $min) {
                    $minTotal = $min;
                    $distance_table = $v;
                    break;
                }
            }
            if (!empty($distance_table)) {
                foreach ($distance_table as $d => $v) {
                    if ($distance >= floatval($d)) {
                        $fee = intval($v);
                        break;
                    }
                }
            }
        }
        /* Finding minTotal value */
        if ($fee == -1) {
            foreach ($fees as $d => $v) {
                $f = -1;
                $minTotal = intval($d);
                foreach ($v as $t => $sf) {
                    if ($distance >= floatval($t)) {
                        $f = intval($sf);
                    } else
                        break;
                }
                if ($f > -1)
                    break;
            }
        }
    }
    return [$fee, $minTotal];
}

function isInt($val)
{
    return intval($val) == $val;
}

function formatQuantity($val, $decimals = 1)
{
    if ($val === null)
        return '';
    if (isInt($val))
        return intval($val);
    return number_format($val, $decimals);
}

function getTimeDiffInMinutes($date1, $date2 = null)
{
    $to_time = strtotime($date1);
    if (empty($date2))
        $date2 = date('Y-m-d H:i:s');
    $from_time = strtotime($date2);
    return round(abs($to_time - $from_time) / 60);
}

function html_select_shipper($label_field, $attribute, $empty_label = null, $selected = '')
{
    $source_array = eModel::_select('users', array('do_shipping' => 1, 'enabled' => 1, 'deleted' => 0, 'where' => 'type_id > 2', 'order_by' => 'fullname'));
    if (empty($source_array))
        return '';
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $item) {
            $selected_attr = ($item['user_id'] == $selected) ? 'selected = "selected"' : '';
            $html .= '   <option data-is-ship-service="' . ($item['type_id'] == SHIP_SERVICE_TYPE_ID ? 1 : 0) . '" value="' . $item['user_id'] . '" ' . $selected_attr . '>' . $item[$label_field] . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function html_select_payment_status($attribute, $empty_label = null, $selected = '')
{
    $source_array = array(
        'pending' => 'Lưu công nợ',
        'paid_by_cash' => 'Đã thanh toán tiền mặt',
        'paid_via_bank' => 'Đã thanh toán chuyển khoản'
    );
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $value => $label) {
            $selected_attr = ($value == $selected) ? 'selected = "selected"' : '';
            $html .= '   <option value="' . $value . '" ' . $selected_attr . '>' . $label . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function get_payment_status($status_code)
{
    $statuses_array = array(
        'pending' => 'Lưu công nợ',
        'paid_by_cash' => 'Đã thanh toán tiền mặt',
        'paid_via_bank' => 'Đã thanh toán chuyển khoản'
    );
    return isset($statuses_array[$status_code]) ? $statuses_array[$status_code] : '';
}

function html_select_debt_status($attribute, $empty_label = null, $selected = '')
{
    $source_array = array(
        'pending' => 'Chưa thanh toán',
        'paid' => 'Đã thanh toán',
        'period' => 'Thanh toán có kỳ hạn'
    );
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $value => $label) {
            $selected_attr = ($value == $selected) ? 'selected = "selected"' : '';
            $html .= '   <option value="' . $value . '" ' . $selected_attr . '>' . $label . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function get_debt_status($status_code)
{
    $statuses_array = array(
        'pending' => 'Chưa thanh toán',
        'paid' => 'Đã thanh toán',
        'period' => 'Thanh toán có kỳ hạn'
    );
    return isset($statuses_array[$status_code]) ? $statuses_array[$status_code] : '';
}

function html_select_customer_debt_status($attribute, $empty_label = null, $selected = '')
{
    $source_array = array(
        'pending' => 'Chưa thanh toán',
        'paid' => 'Đã thanh toán'
    );
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $value => $label) {
            $selected_attr = ($value == $selected) ? 'selected = "selected"' : '';
            $html .= '   <option value="' . $value . '" ' . $selected_attr . '>' . $label . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function get_customer_debt_status($status_code)
{
    $statuses_array = array(
        'pending' => 'Chưa thanh toán',
        'paid' => 'Đã thanh toán'
    );
    return isset($statuses_array[$status_code]) ? $statuses_array[$status_code] : '';
}

function html_select_payment_type($attribute, $empty_label = null, $selected = '')
{
    $source_array = array(
        'cash' => 'Tiền mặt',
        'bank_balance' => 'Chuyển khoản',
    );
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $value => $label) {
            $selected_attr = ($value == $selected) ? 'selected = "selected"' : '';
            $html .= '   <option value="' . $value . '" ' . $selected_attr . '>' . $label . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function html_select_provider_types($attribute, $empty_label = null, $selected = '')
{
    $source_array = array(
        '1' => 'Nhà vườn',
        '2' => 'Công ty',
        '3' => 'Thương lái'
    );
    $html = '<select ' . $attribute . '>';
    if ($empty_label !== null)
        $html .= '   <option value="">' . $empty_label . '</option>';
    if (is_array($source_array) && !empty($source_array)) {
        foreach ($source_array as $value => $label) {
            $selected_attr = ($value == $selected) ? 'selected = "selected"' : '';
            $html .= '   <option value="' . $value . '" ' . $selected_attr . '>' . $label . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function get_provider_type($type_id)
{
    $source_array = array(
        '1' => 'Nhà vườn',
        '2' => 'Công ty',
        '3' => 'Thương lái'
    );
    return isset($source_array[$type_id]) ? $source_array[$type_id] : '';
}

function get_next_id($prefix = '')
{
    /*
    $stt = get_setting('stt');
    if (empty($stt)){
        $rs = eModel::_select_one('orders',
            array(
                'select' => 'COUNT(id) as count',
                'where' => "created_dtm >= '".date('Y-m-01')."' AND created_dtm <= '".date('Y-m-t')."'",
                'order_by' => 'id desc'
            )
        );
        if ($rs)
            $stt = intval($rs['count']) + 1;
    }else{
        $stt = intval($stt) + 1;
    }
    set_setting('stt', $stt);
    */
    $rs = eModel::_select_one('orders',
        array(
            'select' => 'COUNT(id) as count',
            'where' => "`code` IS NOT NULL AND created_dtm >= '" . date('Y-m-d') . "' AND created_dtm <= '" . date('Y-m-d') . " 23:59:59'",
        )
    );
    if ($rs)
        $stt_day = intval($rs['count']) + 1;
    else
        $stt_day = rand(0, 99);
    $rs = eModel::_select_one('orders',
        array(
            'select' => 'COUNT(id) as count',
            'where' => "`code` IS NOT NULL AND created_dtm >= '" . date('Y-m-01') . " 00:00:00' AND created_dtm <= '" . date('Y-m-t') . " 23:59:59'"
        )
    );
    if ($rs)
        $stt = intval($rs['count']) + 1;
    else
        $stt = 1;

    return $prefix . sprintf('%02d', $stt_day) . sprintf('%02d', rand(0, 99)) . '-' . date('m') . sprintf('%04d', $stt);
}

function get_order_code($order_type)
{
    $prefixes = array(
        ORDER_TYPE_STAY_ID => 'TC',
        ORDER_TYPE_TAKEAWAY_ID => 'MV',
        ORDER_TYPE_DELIVERY_ID => 'GH',
        ORDER_TYPE_FOODY_ID => 'FD',
        ORDER_TYPE_GRABFOOD_ID => 'GF',
        ORDER_TYPE_GOFOOD_ID => 'GO',
        ORDER_TYPE_BAEMIN_ID => 'BM'
    );
    if (isset($prefixes[$order_type]))
        return get_next_id($prefixes[$order_type]);
    return get_next_id();
}

function get_seq_no($code)
{
    $length = strlen($code);
    $first_letter = substr($code, 0, 1);
    if (is_numeric($first_letter))
        $seq_no = substr($code, $length - 4, 4);
    else if ($first_letter == 'e' || $first_letter == 'g')
        $seq_no = substr($code, 1, 2);
    else
        $seq_no = substr($code, 2, 2);
    return $seq_no;
}

function get_new_shipping_fees()
{
    $shipping_fees = eModel::_select('shipping_fees', array('order_by' => 'min_total DESC'));
    if ($shipping_fees) {
        $rs = array();
        foreach ($shipping_fees as $sf) {
            if (empty($rs[$sf['district']]))
                $rs[$sf['district']] = array();

            $rs[$sf['district']][$sf['min_total']] = $sf['fee'];
        }
        return $rs;
    } else
        return '';
}

function cal_shipping_fee($amount, $district, $distance)
{
    if (empty($distance))
        return 0;
    $distance = ceil($distance);
    $multiplier = 5;
    $fee_table = get_new_shipping_fees();
    if (!isset($fee_table[$district]))
        return $distance * $multiplier;

    $shipping_fee = $distance * $multiplier;
    foreach ($fee_table[$district] as $min_total => $fee) {
        if ($amount >= $min_total) {
            $shipping_fee = $fee;
            break;
        }
    }
    return $shipping_fee;
}

function get_booking_address($booking_info, $lang_code = 'vi')
{
    if (empty($booking_info) || empty($booking_info->address))
        return null;
    $address = $booking_info->address;
    if ($lang_code == 'en') {
        if (!strstr($address, 'Ward') && !strstr($address, 'ward') && !empty($booking_info->ward)) {
            $address .= ", Ward " . $booking_info->ward;
        }
        if (!strstr($address, 'District') && !strstr($address, 'district') && !empty($booking_info->district)) {
            $address .= ", District " . $booking_info->district;
        }
    } else {
        if (!strstr($address, 'Phường') && !strstr($address, 'phường') && !empty($booking_info->ward)) {
            $address .= ", Phường " . $booking_info->ward;
        }
        if (!strstr($address, 'Quận') && !strstr($address, 'quận') && !empty($booking_info->district)) {
            $address .= ", Quận " . $booking_info->district;
        }
    }

    return $address;
}

function get_booker_details($booking_info, $lang_code = 'vi') {
    $rs = null;
    if (empty($booking_info))
        return $rs;
    if (!empty($booking_info->booker_mobile) && $booking_info->booker_mobile != $booking_info->mobile) {
        if ($lang_code == 'en') {
            $rs = '<p><b style="font-size: 20px;">Booker details</b><br/>';
            $rs .= 'Fullname: '.$booking_info->booker_fullname.'<br/>';
            $rs .= 'Phone number: '.$booking_info->booker_mobile.'<br/>';
            if (!empty($booking_info->message_to_receiver))
                $rs .= 'Message to receiver: '.$booking_info->booker_fullname;
            $rs .= '</p>';
        } else {
            $rs = '<p><b style="font-size: 20px;">Thông tin người đặt</b><br/>';
            $rs .= 'Họ và tên: '.$booking_info->booker_fullname.'<br/>';
            $rs .= 'Số điện thoại: '.$booking_info->booker_mobile.'<br/>';
            if (!empty($booking_info->message_to_receiver))
                $rs .= 'Thông điệp gửi người nhận: '.$booking_info->booker_fullname;
            $rs .= '</p>';
        }
    }
    return $rs;
}

$tran_matrix = array(
    'Mã đơn hàng không chính xác.' => 'Your order code is invalid.',
    'Dữ liệu bị lỗi. Vui lòng liên hệ chúng tôi.' => 'Unknown error. Please contact to us.',
    'Dữ liệu bị lỗi. Vui lòng liên hệ chúng tôi. [E1]' => 'Unknown error. Please contact to us. [E1]'
);
/* Vietnamese to Engish */
function _e($text)
{
    global $tran_matrix;
    return isset($tran_matrix[$text]) ? $tran_matrix[$text] : $text;
}

function get_taste_options()
{
    return array(
        0 => 'Không đường',
        1 => 'Không sữa',
        2 => 'Không đường sữa',
        3 => 'Ít ngọt',
        4 => 'Ngọt vừa',
        5 => 'Ngọt nhiều',
        6 => 'Bình thường'
    );
}

function frontend_url($uri = '', $lang_code = 'vi')
{
    return ROOT_URL . $lang_code . '/' . $uri;
}

function get_package_options()
{
    return array(
        'products' => array(
            'detox' => array(
                'name' => 'Juice Detox',
                'price' => 1078000,
                'quantity' => 22,
                'unit' => 'chai',
                'volume' => '310ml'
            ),
            'meal' => array(
                'name' => 'Meal Smoothies',
                'price' => 1078000,
                'quantity' => 22,
                'unit' => 'phần',
                'volume' => '500ml'
            ),
            'salad' => array(
                'name' => 'Fruit Salad',
                'price' => 1078000,
                'quantity' => 22,
                'unit' => 'phần',
                'volume' => '500ml'
            ),
            'mix' => array(
                'name' => 'Gói Kết hợp',
                'price' => 1078000,
                'quantity' => 22,
                'unit' => 'phần',
                'volume' => ''
            ),
            'home' => array(
                'name' => 'Gói rau củ quả',
                'price' => 990000,
                'quantity' => 22,
                'unit' => 'phần',
                'volume' => ''
            ),
            'trial' => array(
                'name' => 'Gói dùng thử 1 tuần sản phẩm',
                'price' => 245000,
                'quantity' => 5,
                'unit' => 'phần',
                'volume' => ''
            )
        ),
        'shipping_fees' => array(
            '0' => 'Nhận tại cửa hàng',
            '100' => 'Giao trong bán kính 3km: 100k/gói',
            '250' => 'Giao trong bán kính 3km-7km: 250k/gói'
        ),
        'delivery_time' => array(
            '7:00 - 8:00',
            '9:00 - 10:00',
            '10:00 - 11:00',
            '14:00 - 15:00',
            '15:00 - 16:00',
            '16:00 - 17:00',
            '17:00 - 18:00'
        ),
        'payment_methods' => array(
            'cod' => 'Thanh toán khi nhận hàng',
            'bank' => 'Chuyển khoản ngân hàng',
            'moca' => 'Thanh toán qua Moca',
            'zalopay' => 'Thanh toán qua Zalo Pay',
            'vnpay' => 'Thanh toán qua VN Pay',
            'momo' => 'Thanh toán qua MoMo',
        ),
        'bottle_return' => array(
            'yes' => 'Trả lại chai/hũ, không phát sinh chi phí',
            'no' => 'Không trả chai/hũ, + 200k/gói'
        )
    );
}

function mempty()
{
    foreach(func_get_args() as $arg)
        if(empty($arg))
            continue;
        else
            return false;
    return true;
}