<?php 
require_once 'config/inc.php';
$link=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSOWRD,DB_NAME);
if(mysqli_connect_errno()){
	die('No Connection available now '.mysqli_connect_errno());
}
session_start();
date_default_timezone_set('UTC');
$rand=rand(1000,9999);
$rand1=sha1("$rand");
$rand2=md5("$rand");

require_once "functions.php";
?>
