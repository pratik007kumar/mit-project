<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");

$row=mysql_fetch_array( mysql_query("SELECT * FROM `admin` WHERE `password`=md5('".$_POST['oldpass']."')" ));

if($row[0]!="")
{
    if(mysql_query("UPDATE `admin` SET `password` = MD5( '".$_POST['newpass']."' ) WHERE `admin`.`id` ='".$row['id']."';"))
    {
    echo "Password Change Success !!";
    }else{ echo "Unable to Change Password !!";}
}
else{
    echo "Current Password not Match";
}

?>