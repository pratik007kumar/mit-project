<?php
if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");

include("../../admin/includes/phpfunction.php");
include ("../phpfunprofile.php");
if(isset($_POST))
{
    mysql_query("DELETE FROM `imagetbl` WHERE `id`='".$_POST['id']."'");
    
}
?>1