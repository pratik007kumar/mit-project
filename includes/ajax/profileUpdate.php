<?php error_reporting(0);

if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
$post=  safe($_POST);
$sql="UPDATE `users` SET ";
if($_POST['type']=='s')
{
    
    $sql.="`summary` = '<pre>".$post['value']."</pre>'";
}
if($_POST['type']=='a')
{
    
    $sql.="`article` = '<pre>".$post['value']."</pre>'";
}
if($_POST['type']=='r')
{
    
    $sql.="`recommendation` = '<pre>".$post['value']."</pre>'";
}

$sql.=" WHERE `users`.`id` = ".$_SESSION['id'].";";

if(mysql_query($sql))
{
    echo 1;
}





?>