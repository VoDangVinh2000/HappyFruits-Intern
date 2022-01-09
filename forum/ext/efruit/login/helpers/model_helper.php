<?php
namespace efruit\login\helpers;

class model_helper
{
	static $dbh; // Instance of PDO handler
    var $table_name = '';
    var $primary_key = '';
    var $class_name = '';
    static $group_by = '';
    static $order_by = '';
    static $limit = '';
    static $offset = 0;
            
    function __construct($table_name = '')
    {
	    $host = 'localhost';
	    $dbname = 'efruit_db';
	    $user = 'efruit_db';
	    $pass = 'FvVP7y4ZeRNS';

	    $dbh = new \PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
	    if(!$dbh) {
		    die("Connection to MySQL failed");
	    }
	    $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	    $dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
	    $dbh->exec("SET NAMES 'utf8';");
        self::$dbh = $dbh;

        self::$group_by = '';
        self::$order_by = '';
        self::$limit = '';
        self::$offset = 0;
	    $this->table_name = $table_name;
    }
    
    static function _set_last_query($query)
    {
        global $last_query;
        $last_query = $query;
    }
    
    static function _insert($table_name, $data = array())
    {
        $fields = implode(',', array_keys($data));
        
        $values_str = '';
        foreach($data as $f => $v)
        {
            if ($values_str)
                $values_str .= ', ';
            if (is_array($v))
                $values_str .= $v[0];
            else
                $values_str .= ":$f";
        }
        
        $insert_sql = "INSERT INTO $table_name($fields) VALUES($values_str)";
        
        self::_set_last_query($insert_sql);
        
        $stmt = self::$dbh->prepare($insert_sql);
        
        foreach($data as $f => $v)
        {
            if (!is_array($v))
                $stmt->bindParam(":$f", $data[$f]);
        }
        if ($stmt->execute())
            return self::$dbh->lastInsertId();
        else
            return false;
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
        if (isset($params['select']))
        {
            $select_str = $params['select'];
            unset($params['select']);
        }
        else
            $select_str = '*';
        
        $join_str = '';
        if (isset($params['join']))
        {
            $join_str .= $params['join'];
            unset($params['join']);
        }
        if (isset($params['order_by']))
        {
            self::$order_by = $params['order_by'];
            unset($params['order_by']);
        }
        if (isset($params['group_by']))
        {
            self::$group_by = $params['group_by'];
            unset($params['group_by']);
        }
        if (isset($params['limit']))
        {
            self::$limit = $params['limit'];
            unset($params['limit']);
        }
        if (isset($params['offset']))
        {
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
        if (strpos($sql, 'SELECT')===0)
        {
            if (isset($filters['order_by']))
            {
                self::$order_by = $filters['order_by'];
                unset($filters['order_by']);
            }
            if (isset($filters['group_by']))
            {
                self::$group_by = $filters['group_by'];
                unset($filters['group_by']);
            }
            if (isset($filters['limit']))
            {
                self::$limit = $filters['limit'];
                unset($filters['limit']);
            }
            if (isset($filters['offset']))
            {
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
        if (!empty($set_params))
        {
            foreach($set_params as $f => $v)
            {
                if ($set_str)
                    $set_str .= ', ';
                if ($f == 'set')
                    $set_str .= "$v";
                else
                {
                    $field = str_replace('.', '_', $f);                                          
                    $set_str .= "$f = :$field";
                }
                    
            }
        }
        if ($set_str)
            $sql .= ' SET '. $set_str;
        
        $where_str = '';
        if (!empty($where_params))
        {
            foreach($where_params as $f => $v)
            {
                if ($where_str)
                    $where_str .= ' AND ';
                if ($f == 'where')
                    $where_str .= "($v)";
                elseif ($f == 'or')
                {
                    if (is_array($v) && !empty($v))
                    {
                        $or_str = '';
                        foreach($v as $k_or => $v_or)
                        {    
                            if ($or_str)
                                $or_str .= ' OR ';
                            $field = str_replace('.', '_', $k_or);                                           
                            $or_str .= "$k_or = :$field";
                        }
                        $where_str .= " ( $or_str )";
                    }
                }
                else
                {
                    $field = str_replace('.', '_', $f);                                              
                    $where_str .= "$f = :$field";
                }
                    
            }
        }
        if ($where_str)
            $sql .= ' WHERE '. $where_str;
        
        if (strpos($sql, 'SELECT')===0)
        {
            if (self::$group_by)
                $sql .= " GROUP BY ". self::$group_by;
            elseif ($group_by)
                $sql .= " GROUP BY ". $group_by;
            
            if (self::$order_by)
                $sql .= " ORDER BY ". self::$order_by;
            elseif ($order_by)
                $sql .= " ORDER BY ". $order_by;
                
            if (self::$limit){
                $sql .= " LIMIT ". self::$limit." OFFSET ". self::$offset;
            }
        }
            
        self::_set_last_query($sql);
        self::$group_by = '';
        self::$order_by = '';
        self::$limit = '';
        self::$offset = 0;

        $stmt = self::$dbh->prepare($sql);
        
        if (!empty($set_params))
        {
            
            foreach($set_params as $f => $v)
            {
                //Do NOT use the $v variable there
                if ($f != 'set')
                {
                    $field = str_replace('.', '_', $f);
                    $stmt->bindParam(":$field", $set_params[$f]);
                }
            }
        }
        
        if (!empty($where_params))
        {
            
            foreach($where_params as $f => $v)
            {
                //Do NOT use the $v variable there
                if ($f == 'or')
                {
                    if (is_array($v) && !empty($v))
                    {
                        foreach($v as $k_or => $v_or)
                        {
                            $field = str_replace('.', '_', $k_or);           
                            $stmt->bindParam(":$field", $v[$k_or]);
                        }
                    }
                }
                elseif ($f != 'where')
                {
                    $field = str_replace('.', '_', $f);
                    $stmt->bindParam(":$field", $where_params[$f]);
                }
            }
        }
        try {
            $r = $stmt->execute();
        } catch(PDOException $ex) {
            debug($sql. "\n". $ex->getMessage());
        }
        
        if (strpos($sql, 'SELECT')===0)
        {
            //echo var_dump($stmt);
            if ($stmt->rowCount() >0)
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
    
    function insert($data = array())
    {
        return self::_insert($this->table_name, $data);
    }
    
    function update($where_params = array(), $set_params = array())
    {
        if (!empty($where_params) && !is_array($where_params))
            $where_params = array($this->primary_key => $where_params);
        return self::_update($this->table_name, $where_params, $set_params);
    }
    
    function delete($where_params = array())
    {
        if (!empty($where_params) && !is_array($where_params))
            $where_params = array($this->primary_key => $where_params);
        return self::_delete($this->table_name, $where_params);
    }
    
    function select($params = array())
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
        return $obj?$obj['max']:0;
    }
}
/* End of eModel class */
