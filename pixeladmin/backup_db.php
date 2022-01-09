<?php
/**
 * This file contains the Backup_Database class wich performs
 * a partial or complete backup of any given MySQL database
 * @author Daniel López Azaña <http://www.daniloaz.com-->
 * @version 1.0
 */

// Report all errors
error_reporting(-1);

/**
 * The Backup_Database class
 */
class Backup_Database {
    /**
     * Host where database is located
     */
    var $host = '';

    /**
     * Username used to connect to database
     */
    var $username = '';

    /**
     * Password used to connect to database
     */
    var $passwd = '';

    /**
     * Database to backup
     */
    var $dbName = '';

    /**
     * Database charset
     */
    var $charset = '';
    
    /**
     * Connection
     */
    var $conn = '';
    /**
     * Constructor initializes database
     */
    function Backup_Database($host, $username, $passwd, $dbName, $charset = 'utf8')
    {
        $this->host     = $host;
        $this->username = $username;
        $this->passwd   = $passwd;
        $this->dbName   = $dbName;
        $this->charset  = $charset;
        
        $this->initializeDatabase();
    }

    protected function initializeDatabase()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->passwd, $this->dbName);
        if (! mysqli_set_charset ($this->conn, $this->charset))
        {
            mysqli_query($this->conn, 'SET NAMES '.$this->charset);
        }
        /*edit by Vinh*/
        return $this->conn;
    }

    /**
     * Backup the whole database or just some tables
     * Use '*' for whole database or 'table1 table2 table3...'
     * @param string $tables
     */
    public function backupTables($tables = '*', $outputDir = '.', $file_name = '', $compressed = 0)
    {
        try
        {
            /**
            * Tables to export
            */
            if($tables == '*')
            {
                $tables = array();
                // $result = mysqli_query($this->conn, 'SHOW TABLES');
                /*edit by Vinh*/
                $result = mysqli_query($this->initializeDatabase, 'SHOW TABLES');
                while($row = mysqli_fetch_row($result))
                {
                    $tables[] = $row[0];
                }
            }
            else
            {
                $tables = is_array($tables) ? $tables : explode(',',$tables);
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS '.$this->dbName.";\n\n";
            $sql .= 'USE '.$this->dbName.";\n\n";
            $this->saveFile($sql, $outputDir, $file_name);
            
            /**
            * Iterate tables
            */
            foreach($tables as $table)
            {
                //echo "Backing up ".$table." table...";
                /*edit by Vinh* */
                // $result = mysqli_query($this->conn, 'SELECT * FROM '.$table);
                $result = mysqli_query($this->initializeDatabase, 'SELECT * FROM '.$table);
                $numFields = mysqli_num_fields($result);

                $sql = 'DROP TABLE IF EXISTS '.$table.';';
                $row2 = mysqli_fetch_row(mysqli_query($this->initializeDatabase, 'SHOW CREATE TABLE '.$table));
                $sql.= "\n\n".$row2[1].";\n\n";

                for ($i = 0; $i < $numFields; $i++) 
                {
                    while($row = mysqli_fetch_row($result))
                    {
                        $sql .= 'INSERT INTO '.$table.' VALUES(';
                        for($j=0; $j<$numFields; $j++) 
                        {
                            $row[$j] = addslashes($row[$j]);
                            $row[$j] = str_replace("\n","\\n",$row[$j]);
                            if (isset($row[$j]))
                            {
                                $sql .= '"'.$row[$j].'"' ;
                            }
                            else
                            {
                                $sql.= '""';
                            }

                            if ($j < ($numFields-1))
                            {
                                $sql .= ',';
                            }
                        }

                        $sql.= ");\n";
                    }
                }

                $sql.="\n\n\n";
                if (!$this->saveFile($sql, $outputDir, $file_name))
                    return false;
                //echo " OK<br/>";
            }
            if ($compressed)
                $this->compressFile($outputDir, $file_name);
            
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * Save SQL to file
     * @param string $sql
     */
    protected function saveFile(&$sql, $outputDir = '.', $file_name = '')
    {
        if (!$sql) return false;

        try
        {
            if (empty($file_name))
                $file_name = 'db-backup-'.$this->dbName.'-'.date("Ymd-His", time()).'.sql';
            $handle = fopen($outputDir.$file_name,'a');
            fwrite($handle, $sql);
            fclose($handle);
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            return false;
        }

        return true;
    }
    
    /**
     * Zip a file
     * @param string $outputDir
     * @param string $filename
     */
    protected function compressFile($outputDir = '.', $file_name = '')
    {
        try
        {
            if (empty($file_name))
                $file_name = 'db-backup-'.$this->dbName.'-'.date("Ymd-His", time()).'.sql';
            if (file_exists($outputDir.$file_name))
            {
                $zip = new ZipArchive();
                if ($zip->open($outputDir.$file_name.'.zip', ZipArchive::CREATE)===TRUE) {
                    $zip->addFile($outputDir.$file_name, $file_name);
                    $zip->close();
                    @unlink($outputDir.$file_name);
                }
            }
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            return false;
        }

        return true;
    }
}

?>
