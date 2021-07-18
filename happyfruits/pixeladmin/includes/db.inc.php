<?php
    $domain_name = strtolower($_SERVER["SERVER_NAME"]);
    $server_ip = get_server_ip();
    define("MYSQL_HOST", env("MYSQL_HOST", "localhost"));
    define("MYSQL_DBNAME", env("MYSQL_DBNAME", "happyfruit_db"));
    define("MYSQL_USER", env("MYSQL_USER", "efruit_db"));
    define("MYSQL_PASS", env("MYSQL_PASS", "x7VsY7uC27QL"));
    // define("MYSQL_HOST", "localhost");
    // define("MYSQL_DBNAME", "happyfruit_db");
    // define("MYSQL_USER", "efruit_db");
    // define("MYSQL_PASS", "x7VsY7uC27QL");
    // Server specific settings
    if($server_ip == "127.0.0.1") {
        define("IS_LOCAL", 1);
        define("IS_LIVE", 0);
    } else {
        define("IS_LOCAL", 0);
        define("IS_LIVE", 1);
    }

    $scheme = (isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS'])?'https://':'http://';
    define("DOMAIN_NAME", env("DOMAIN_NAME", str_replace('www.', '', $domain_name)));
    define("ROOT_URL_WITHOUT_SLASH", $scheme.$domain_name);
    define("ROOT_URL", ROOT_URL_WITHOUT_SLASH."/");
    define("BASE_URL", ROOT_URL_WITHOUT_SLASH."/pixeladmin/");
    
    define('DB_UPDATE_PATH', ABSOLUTE_PATH.'updates/');
    
    define('DB_BACKUP_PATH', ABSOLUTE_PATH.'backup_db/');
    define('DB_LATEST_BACKUP_DATE', ABSOLUTE_PATH. 'backup_db/latest.dat');
    
    $dbh = new PDO('mysql:host=localhost' . ';dbname=' . MYSQL_DBNAME, MYSQL_USER, MYSQL_PASS);
    if(!$dbh) {
        die("Connection to MySQL failed");
    }
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->exec("SET NAMES 'utf8';"); 
    
    $version = get_setting('db_version');
    if (empty($version))
        $version = 0;

    if ($version != DB_VERSION)
    {
        foreach (glob(DB_UPDATE_PATH."*.sql") as $filename) 
        {
            $v = basename($filename, ".sql");
            if (floatval($v) <= DB_VERSION && floatval($v) > $version)
            {
                $success = dbImportSQLFile(DB_UPDATE_PATH. $v.'.sql', $dbh);
                if ($success)
                    set_setting('db_version', DB_VERSION);
                else
                    break;
            } 
        }  
    }
    
    if (IS_LIVE && 0)
    {
        /* Do not backup database from here */
        if (file_exists(DB_LATEST_BACKUP_DATE))
            $latest_datetime = file_get_contents(DB_LATEST_BACKUP_DATE);
        if (empty($latest_datetime) || strtotime($latest_datetime . ' +10 hours') < time())
        {
            require_once ABSOLUTE_PATH. 'backup_db.php';
            $backupDatabase = new Backup_Database(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DBNAME);
            $status = $backupDatabase->backupTables('*', DB_BACKUP_PATH, MYSQL_DBNAME.date('_Ymd_His').'.sql', 1);
            
            if ($status)
            {
                // Update latest date of backup db
                try
                {
                    $handle = fopen(DB_LATEST_BACKUP_DATE, 'w');
                    fwrite($handle, date('Y-m-d H:i:s'));
                    fclose($handle);
                }
                catch (Exception $e)
                {
                    //var_dump($e->getMessage());
                    return false;
                }
            }
        }
    }
    
    $primary_keys = array(
        'assessment' => 'assessment_id',
        'categories' => 'category_id',
        'customer_types' => 'type_id',
        'customers' => 'customer_id',
        'products' => 'product_id',
        'user_types' => 'type_id',
        'users' => 'user_id',
        'price_types' => 'type_id',
        'pages' => 'page_id',
        'tags' => 'tag_id'
    );