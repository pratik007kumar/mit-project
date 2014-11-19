<?php
$username ="root";
$password ="";
$hostname = "localhost"; 
$databaseName="mitsim_db";
$dbhandle = mysql_connect($hostname, $username, $password)  or die("Unable to connect to MySQL");
$con=mysql_select_db($databaseName)or die("Unable to connect to database");


define('BASE_URL', 'http://localhost');
define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/MITSIM/');

define('IMAGE_URL',$_SERVER["DOCUMENT_ROOT"]."/MITSIM/uploades/");


?>