<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");

include("../../admin/includes/phpfunction.php");

$sql="UPDATE `users` SET  ";

if($_POST['type']=='e')
{
   $sql.=" `showemail`='".$_POST['value']."' ";
    if($_POST['value']=='0')
         {                                    
        echo '<button class="btn btn-default" onclick="settingChang(\'e\',this,\'1\')">Hide</button>';
    }
    else {
    echo '<button class="btn btn-success" onclick="settingChang(\'e\',this,\'0\')">Show</button>';     

    }
}
if($_POST['type']=='m')
{
     $sql.=" `showmobile`='".$_POST['value']."' ";
    if($_POST['value']=='0')
     {                                    
        echo '<button class="btn btn-default" onclick="settingChang(\'m\',this,\'1\')">Hide</button>';
    }
    else {
    echo '<button class="btn btn-success" onclick="settingChang(\'m\',this,\'0\')">Show</button>';     

    }
}
    

$sql.=" WHERE `id` ='".$_SESSION['id']."';";
    mysql_query($sql);
    

?>