<?php
	if(isset($_POST["submit"]))	{
		$config_file_content='<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(1);
//error_reporting(1);
ini_set("display_errors", "On");

define("APP_PATH", "./"); 






define("BASE_URL","'.$_POST["hostname"].'/service/ui/app/");  
define("WEB_ROOT","'.$_POST["hostname"].'/");
define("SLIM_ROOT","'.$_POST["hostname"].'/");

define("DB_PREFIX", "scad_");

//Mail Server Setting
define("MAIL_USERNAME", "'.$_POST["mail_user_name"].'");
define("MAIL_PASSWORD", "'.$_POST["mail_password"].'");
define("FROM_ADDRESS", "'.$_POST["from_address"].'");
define("FROM_NAME", "'.$_POST["from_name"].'");
define("MAIL_HOST", "'.$_POST["mail_host_name"].'");
define("MAIL_PORT", "'.$_POST["mail_port"].'");




$dbusername = "'.$_POST["db_user_name"].'";
$dbpassword = "'.$_POST["db_password"].'";
$hostname = "'.$_POST["db_hostname"].'";


$db = "'.$_POST["db_name"].'";

define("host",$hostname); 
define("dbusername",$dbusername); 
define("dbname",$db);
define("dbpassword",$dbpassword); 

include_once APP_PATH."lib/ezSQL/ez_sql_core.php";
include_once APP_PATH."lib/ezSQL/ez_sql_mysql.php";
require_once APP_PATH."service/data/class.mysqldb.php";

$scad = new mysqldb();

?>';
$my_file = 'conf/config.inc.php';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
fwrite($handle, $config_file_content);

$js_content='var SITEURL = "'.$_POST["hostname"].'/index.php/";
var SITEURL1 = "'.$_POST["hostname"].'/"';
$my_file = 'conf/config.js';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
fwrite($handle, $js_content);
	}
?>
<html>
<head>
	<style>
	html,body{width:100%;height:100%;overflow: hidden;}
	.container{width:60%;margin: 0 auto;background: #cdcdcd;padding: 25px}
	.container form {padding: 10px;}
	.container a{width: 100%;clear:both;}
	form input{padding: 10px}
	</style>
</head>
<body>
	<div class="container">
		<div class='field-row'>
			<?php

// Name of the file
$filename = 'mysql_dump.sql';
// MySQL host
 $mysql_host = $_POST["db_hostname"];
// MySQL username
 $mysql_username = $_POST["db_user_name"];
// MySQL password
 $mysql_password = $_POST["db_password"];
// Database name
 $mysql_database = $_POST["db_name"];

// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
$status=false;
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    if(mysql_query($templine))
    {
    	$status=true;
    } else{
     print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    }
    // Reset temp variable to empty
    $templine = '';
}
}
if($status){ echo 'Database Imported successfully';
	echo '<br/>User URL : '.$_POST["hostname"].'/index.php <a target="_blank" href="'.$_POST["hostname"].'/index.php">User panel</a></br>
	Admin URL : '.$_POST["hostname"].'/index.php/admin <a target="_blank" href="'.$_POST["hostname"].'/index.php/admin">Admin panel</a>';
	echo 'successfully files are replaced.Please delete <ul><li>installer.php</li><li>installer_dump.php</li>';
}
?>
		</div>
		<!--<div class="field-row">Dumping success!!!</div>
			<div class="field-row"><a href='<?php echo $_POST["hostname"]."/index.php";?>'>Click here to go frontend</a></div>
		-->
		</div>
	</body>
	</html>