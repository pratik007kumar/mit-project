<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");

include("../../admin/includes/phpfunction.php");

$row=mysql_fetch_array( mysql_query("SELECT * FROM `users` WHERE `password`=md5('".$_POST['oldpass']."') AND `id`='".$_SESSION['id']."'"  ));

if($row[0]!="")
{
    if(mysql_query("UPDATE `users` SET `password` = MD5( '".$_POST['newpass']."' ) WHERE `id` ='".$_SESSION['id']."';"))
    {
    echo "Password Change Success !!";
    }else{ echo "Unable to Change Password !!";}
}
else{
    echo "Current Password not Match";
}

?>