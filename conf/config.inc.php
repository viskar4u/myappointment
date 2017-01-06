<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(1);
//error_reporting(1);
ini_set("display_errors", "On");

define("APP_PATH", "./"); 






define("BASE_URL","http://localhost/mydoc/service/ui/app/");  
define("WEB_ROOT","http://localhost/mydoc/");
define("SLIM_ROOT","http://localhost/mydoc/");

define("DB_PREFIX", "scad_");

//Mail Server Setting
define("MAIL_USERNAME", "");
define("MAIL_PASSWORD", "");
define("FROM_ADDRESS", "");
define("FROM_NAME", "");
define("MAIL_HOST", "");
define("MAIL_PORT", "");




$dbusername = "root";
$dbpassword = "";
$hostname = "localhost:3306";


$db = "mydoc";

define("host",$hostname); 
define("dbusername",$dbusername); 
define("dbname",$db);
define("dbpassword",$dbpassword); 

include_once APP_PATH."lib/ezSQL/ez_sql_core.php";
include_once APP_PATH."lib/ezSQL/ez_sql_mysql.php";
require_once APP_PATH."service/data/class.mysqldb.php";

$scad = new mysqldb();

?>