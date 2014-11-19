<?php
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
//print_r($_POST);
if($_POST['count']=="1")
{
    $isrow=getisfavourite($_POST['type'],$_POST['id']);
    if($isrow['id']!="")
    {
        unfavourite($isrow['id'],1);
    }else{

        $sql="INSERT INTO `favourite` (`id`, `type`, `favourite_id`, `user_id`) VALUES (NULL, "; //'', '', '');"
//        if($_POST['type']=="store")
//        {
//            $sql.="'store' ,";
//        }
        $sql.="'".$_POST['type']."','".$_POST['id']."','".$_SESSION['id']."') ";

        //echo $sql;
        mysql_query($sql);
        //echo mysqlmysql_insert_id();
    }
}
else{
    $row= getisfavourite($_POST['type'],$_POST['id']);
    unfavourite($row['id'],0);
}
