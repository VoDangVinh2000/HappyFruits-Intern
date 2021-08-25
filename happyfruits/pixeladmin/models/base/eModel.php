<?php

/**
 *
 * -------------------------------------------------------
 * Classname:        eModel
 * Generation date:  15/01/2015
 * Description:      base model
 * -------------------------------------------------------
 *
 */



/**
 * Class declaration
 * 
 */
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once EFRUIT_ABSOLUTE_PATH .'/PHPMailer/PHPMailer.php';
require_once EFRUIT_ABSOLUTE_PATH .'/PHPMailer/Exception.php';
require_once EFRUIT_ABSOLUTE_PATH .'/PHPMailer/OAuth.php';
require_once EFRUIT_ABSOLUTE_PATH .'/PHPMailer/POP3.php';
require_once EFRUIT_ABSOLUTE_PATH .'/PHPMailer/SMTP.php';
class eModel
{
    var $dbh; // Instance of PDO handler    
    var $table_name = '';
    var $primary_key = '';
    var $class_name = '';
    static $group_by = '';
    static $order_by = '';
    static $limit = '';
    static $offset = 0;

    function __construct()
    {
        global $dbh;
        $this->dbh = $dbh;
        self::$group_by = '';
        self::$order_by = '';
        self::$limit = '';
        self::$offset = 0;
    }

    static function _set_last_query($query)
    {
        global $last_query;
        $last_query = $query;
    }

    static function _insert($table_name, $data = array())
    {
        global $dbh;
        $fields = implode(',', array_keys($data));

        $values_str = '';
        foreach ($data as $f => $v) {
            if ($values_str)
                $values_str .= ', ';
            if (is_array($v))
                $values_str .= $v[0];
            else
                $values_str .= ":$f";
        }

        $insert_sql = "INSERT INTO $table_name($fields) VALUES($values_str)";

        self::_set_last_query($insert_sql);

        $stmt = $dbh->prepare($insert_sql);

        foreach ($data as $f => $v) {
            if (!is_array($v))
                $stmt->bindParam(":$f", $data[$f]);
        }
        if ($stmt->execute())
            return $dbh->lastInsertId();
        else
            return false;
    }

    static function send($content, $nTo, $mTo)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mail sử dụng SMTP
            $mail->Mailer = 'smtp';
            $mail->Host = 'smtp.gmail.com';  // Chỉ định máy chủ SMTP chính và dự phòng
            $mail->SMTPAuth = true;                               // Kích hoạt xác thực SMTP
            $mail->Username = 'cua2k5zubai@gmail.com';                 // SMTP username
            $mail->Password = 'Thuongdaklak021001';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Kích hoạt mã TLS, `ssl` also accepted
            $mail->Port = 465;                                 // Cổng TCP để kết nối với

            //Recipients
            $mail->setFrom('cua2k5zubai@gmail.com', 'Happy Fruits');
            $mail->addAddress($mTo, $nTo);     // Add a recipient
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject =  "Forgot password";
            $mail->Body    = $content;
            $mail->AltBody = '';

            $mail->send();
            return true;
        } catch (Exception $e) {
            
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    static function _update($table_name, $where_params = array(), $set_params = array())
    {
        $update_sql = "UPDATE $table_name";
        return self::_do_sql($update_sql, $where_params, $set_params);
    }

    static function _delete($table_name, $where_params = array())
    {
        $delete_sql = "DELETE FROM $table_name";
        return self::_do_sql($delete_sql, $where_params);
    }



    static function _select($table_name, $params = array())
    {
        if (isset($params['select'])) {
            $select_str = $params['select'];
            unset($params['select']);
        } else
            $select_str = '*';

        $join_str = '';
        if (isset($params['join'])) {
            $join_str .= $params['join'];
            unset($params['join']);
        }
        if (isset($params['order_by'])) {
            self::$order_by = $params['order_by'];
            unset($params['order_by']);
        }
        if (isset($params['group_by'])) {
            self::$group_by = $params['group_by'];
            unset($params['group_by']);
        }
        if (isset($params['limit'])) {
            self::$limit = $params['limit'];
            unset($params['limit']);
        }
        if (isset($params['offset'])) {
            self::$offset = $params['offset'];
            unset($params['offset']);
        }

        $select_sql = "SELECT $select_str FROM $table_name $join_str";
        return self::_do_sql($select_sql, $params, array());
    }

    static function _select_one($table_name, $params = array())
    {
        $params['limit'] = 1;
        $items = self::_select($table_name, $params);
        if ($items)
            return $items[0];
        return '';
    }



    static function _do_select_sql($sql, $filters = array())
    {
        if (strpos($sql, 'SELECT') === 0) {
            if (isset($filters['order_by'])) {
                self::$order_by = $filters['order_by'];
                unset($filters['order_by']);
            }
            if (isset($filters['group_by'])) {
                self::$group_by = $filters['group_by'];
                unset($filters['group_by']);
            }
            if (isset($filters['limit'])) {
                self::$limit = $filters['limit'];
                unset($filters['limit']);
            }
            if (isset($filters['offset'])) {
                self::$offset = $filters['offset'];
                unset($filters['offset']);
            }
            return self::_do_sql($sql, $filters, array());
        }
        return null;
    }

    static function _do_sql($sql = '', $where_params = array(), $set_params = array(), $order_by = '', $group_by = '')
    {
        
        $sql = trim($sql);
        $set_str = '';
        if (!empty($set_params)) {
            foreach ($set_params as $f => $v) {
                if ($set_str)
                    $set_str .= ', ';
                if ($f == 'set')
                    $set_str .= "$v";
                else {
                    $field = trim(str_replace('.', '_', $f));
                    $set_str .= "$f = :$field";
                }
            }
        }
        if ($set_str)
            $sql .= ' SET ' . $set_str;

        $where_str = '';
        if (!empty($where_params)) {
            foreach ($where_params as $f => $v) {
                if ($where_str)
                    $where_str .= ' AND ';
                if ($f == 'where')
                    $where_str .= "($v)";
                else if ($f == 'or') {
                    if (is_array($v) && !empty($v)) {
                        $or_str = '';
                        foreach ($v as $k_or => $v_or) {
                            if ($or_str)
                                $or_str .= ' OR ';
                            $field = str_replace('.', '_', $k_or);
                            $or_str .= "$k_or = :$field";
                        }
                        $where_str .= " ( $or_str )";
                    }
                } else {
                    $field = str_replace('.', '_', $f);
                    $where_str .= "$f = :$field";
                }
            }
        }
        if ($where_str)
            $sql .= ' WHERE ' . $where_str;

        if (strpos($sql, 'SELECT') === 0) {
            if (self::$group_by)
                $sql .= " GROUP BY " . self::$group_by;
            elseif ($group_by)
                $sql .= " GROUP BY " . $group_by;

            if (self::$order_by)
                $sql .= " ORDER BY " . self::$order_by;
            elseif ($order_by)
                $sql .= " ORDER BY " . $order_by;

            if (self::$limit) {
                $sql .= " LIMIT " . self::$limit . " OFFSET " . self::$offset;
            }
        }

        self::_set_last_query($sql);
        self::$group_by = '';
        self::$order_by = '';
        self::$limit = '';
        self::$offset = 0;

        global $dbh;
        $stmt = $dbh->prepare($sql);

        if (!empty($set_params)) {

            foreach ($set_params as $f => $v) {
                //Do NOT use the $v variable there
                if ($f != 'set') {
                    $field = trim(str_replace('.', '_', $f));
                    $stmt->bindParam(":$field", $set_params[$f]);
                }
            }
        }

        if (!empty($where_params)) {

            foreach ($where_params as $f => $v) {
                //Do NOT use the $v variable there
                if ($f == 'or') {
                    if (is_array($v) && !empty($v)) {
                        foreach ($v as $k_or => $v_or) {
                            $field = str_replace('.', '_', $k_or);
                            $stmt->bindParam(":$field", $v[$k_or]);
                        }
                    }
                } elseif ($f != 'where') {
                    $field = str_replace('.', '_', $f);
                    $stmt->bindParam(":$field", $where_params[$f]);
                }
            }
        }
        try {
            $r = $stmt->execute();
        } catch (PDOException $ex) {
            debug($sql . "\n" . $ex->getMessage());
        }

        if (strpos($sql, 'SELECT') === 0) {
            //echo var_dump($stmt);
            if ($stmt->rowCount() > 0)
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            else
                return '';
        }
        return $r;
    }

    function set_group_by($val)
    {
        $this->group_by = $val;
    }

    function set_order_by($val)
    {
        $this->order_by = $val;
    }

    function set_limit($val)
    {
        $this->limit = $val;
    }

    function get_details($id, $filters = array())
    {
        $filters = array_merge($filters, array($this->primary_key => $id));
        return self::_select_one($this->table_name, $filters);
    }

    function get_list($params = array())
    {
        return self::_select($this->table_name, $params);
    }

    static function matchRegexUrl($url)
    {
        $strURL = remove_unicode($url);
        $strURL = preg_replace("/[^A-Z0-9a-z-]/", '', strtolower($strURL));
        return $strURL;
    }
    static function matchRegex_SearchProducts($key)
    {
        /**$strURL = preg_replace("/[!@#$%^&*()-_=+\/|*?><.,{}'']/", '', strtolower($key)); */
        $key = remove_unicode($key);
        $strURL = preg_replace("/[!@#$%^&*()_=+\/|*?><.,{}'']/", '', strtolower($key));
        return $strURL;
    }
    function insert($data = array())
    {
        $result =  self::_insert($this->table_name, $data);
        if ($result) {
            $row = $this->get_details($result);
            $this->after_insert($row);
        }
        return $result;
    }

    function update($where_params = array(), $set_params = array())
    {
        if (!empty($where_params) && !is_array($where_params))
            $where_params = array($this->primary_key => $where_params);
        $old = $this->select_one($where_params);
        $result = self::_update($this->table_name, $where_params, $set_params);
        if ($result) {
            $new = $this->select_one($where_params);
            $this->after_update($old, $new);
        }
        return $result;
    }

    function delete($where_params = array())
    {
        if (!empty($where_params) && !is_array($where_params))
            $where_params = array($this->primary_key => $where_params);
        if (empty($where_params))
            return false;
        $result = self::_delete($this->table_name, $where_params);
    }

    public function select($params = array())
    {
        return self::_select($this->table_name, $params);
    }

    function select_one($params = array())
    {
        return self::_select_one($this->table_name, $params);
    }

    function get_max_sequence_number($params = array())
    {
        $params['select'] = "MAX(sequence_number) as max";
        $params['deleted'] = 0;
        $obj = $this->select_one($params);
        return $obj ? $obj['max'] : 0;
    }

    function after_update($old, $new)
    {
        return true;
    }
    function after_insert($row)
    {
        return true;
    }
}
/* End of eModel class */
