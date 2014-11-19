<?php
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
//print_r($_POST);
if($_POST['count']=="1")
{
    $isrow=getisfollow($_POST['type'],$_POST['id']);
    if($isrow['id']!="")
    {
        unfollow($isrow['id'],1);
    }else{

        $sql="INSERT INTO `follows` (`id`, `type`, `follow_id`, `user_id`) VALUES (NULL, "; //'', '', '');"
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
    $row= getisfollow($_POST['type'],$_POST['id']);
    unfollow($row['id'],0);
}
