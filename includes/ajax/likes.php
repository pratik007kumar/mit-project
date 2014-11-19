<?php
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
//print_r($_POST);
if($_POST['count']=="1")
{
    $isrow=getislike($_POST['type'],$_POST['id']);

    if($isrow['id']!="")
    {
        unlike($isrow['id'],1);
    }else{

    $sql="INSERT INTO `likes` (`id`, `type`, `liked_id`, `user_id`) VALUES (NULL, "; //'', '', '');"
//    if($_POST['type']=="store")
//    {
//    $sql.="'store' ,";
//    }
//        if($_POST['type']=="symptoms")
//        {
//            $sql.="'symptoms' ,";
//        }
//        if($_POST['type']=="clinics")
//        {
//            $sql.="'clinics' ,";
//        }


        $sql.="'".$_POST['type']."','".$_POST['id']."','".$_SESSION['id']."') ";

    //echo $sql;
    mysql_query($sql);
    //echo mysqlmysql_insert_id();
    }
}
else{
 $row= getislike($_POST['type'],$_POST['id']);
    print_r($row);
    unlike($row['id'],0);
}
