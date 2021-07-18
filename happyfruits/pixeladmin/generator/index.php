<?php
include("resources/class.database.php");
$database = new Database();


if(empty($_REQUEST["f"]))
{
?>

<font face="Arial" size="3">
    <b>PHP MYSQL Class Generator</b>
</font>

<font face="Arial" size="2">
        <form action="" method="POST" name="FORMGEN">
        1) Select Table Name: 
        <br/>
        <select name="tablename">
        <?php
            $database->OpenLink();
            $tablelist = $database->link->query("SHOW TABLES FROM ".$database->database);
	        while($row = mysqli_fetch_array($tablelist))
	        {
		        print "<option value=\"$row[0]\">$row[0]</option>";
	        }
        ?>
        </select>
        <p>
            2) Type Class Name (ex. "test"): <br/>
            <input type="text" name="classname" size="50" value=""/>
        </p>
        <p>
            3) Type Name of Key Field: <br/>
            <input type="text" name="keyname" value="" size="50"/>
        </p>
        <br/>
        <font size=1>
        (Name of key-field with type number with autoincrement!)
        </font>
        <p>
            <input type="submit" name="s1" value="Generate Class"/>
            <input type="hidden" name="f" value="formshowed"/>
        </p>
</form>
</font>
<p>
<?php
} else {

// fill parameters from form
$table = $_REQUEST["tablename"];
$classname = $_REQUEST["classname"];
$classname = ucfirst(str_replace('_', '', $classname));
$class = "Base" . $classname;
$key = $_REQUEST["keyname"];

$dir = dirname(__DIR__);

$filename = $dir . "/models/base/" . $class . ".php";

// if file exists, then delete it
if(file_exists($filename))
{
    unlink($filename);
}

// open file in insert mode
$file = fopen($filename, "w+");
$filedate = date("d/m/Y");
$c = "";
$c = "<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        $class
 * Generation date:  $filedate
 * Table name:       $table
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class $class extends eModel
{
    /**
     * Attribute declaration
     */
    var $$key;  /* Primary key */
";

$sql = "SHOW COLUMNS FROM $table;";
$database->query($sql);
$result = $database->result;


while ($row = mysqli_fetch_row($result))
{
    $col = $row[0];
    $type = $row[1];
    if($col!=$key)
    {

$c.= "    var $$col;    /* $type */
";
    }
} // endwhile
$c.= '
    function __construct()
    {
        parent::__construct();
        $this->table_name = '."'$table'".';
        $this->primary_key = '."'$key'".';
    }
';

$c.="
    /**
     * Getter methods
     */ 
";
// GETTER
$database->query($sql);
$result = $database->result;
while ($row = mysqli_fetch_row($result))
{
$col=$row[0];
$mname = "get_" . $col . "()";
$mthis = "$" . "this->" . $col;
$c.="
    function $mname
    {
        return $mthis;
    }
";
}


$c.="
    /**
     * Setter methods
     */
";
// SETTER
$database->query($sql);
$result = $database->result;
while ($row = mysqli_fetch_row($result))
{
$col=$row[0];
$val = "$" . "val";
$mname = "set_" . $col . "($" . "val)";
$mthis = "$" . "this->" . $col . " = ";
$c.="
    function $mname
    {
        $mthis $val;
    }
";
}
$c.= "
}
/* End of generated class */
";
fwrite($file, $c);

$common_filename = $dir . "/models/common/" . $classname . ".php";
// if file exists, then delete it
if(file_exists($common_filename))
{
    die("Common file $common_filename existed!!");
}

// open file in insert mode
$file = fopen($common_filename, "w+");
$c = "";
$c = "<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        $classname
 * Generation date:  $filedate
 * Baseclass:        $class
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/$class.php');

/**
 * Class declaration
 */
class $classname extends $class
{
";
$c.= '
    function __construct()
    {
        parent::__construct();
        $this->class_name = '."'$classname'".';
    }
}
/* End of generated class */
';
fwrite($file, $c);

print "
<font face=\"Arial\" size=\"3\"><b>
PHP MYSQL Class Generator
</b>
<p>
<font face=\"Arial\" size=\"2\"><b>
Class '$class' successfully generated as file '$filename'!<br/>
Class '$classname' successfully generated as file '$common_filename'!
<p>
<a href=\"javascript:history.back();\">
back
</a>

</b></font>
";
?>
<?php
} // endif
?>