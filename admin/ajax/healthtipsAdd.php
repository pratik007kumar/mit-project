<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");
$dataArr=array();
$dataArr=$_POST;
if(healthtipsAdd($dataArr)){echo "Health tips Created Successfully !!";}else{ echo("Unable to Create Health tips. Try Again");}
?>