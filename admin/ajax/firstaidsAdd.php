<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");
$dataArr=array();
$dataArr=$_POST;
$msg="";
if(firstaidsAdd($dataArr)){ 
    $msg= "First Aids Created Successfully !!";

}else{ 
    $msg="Unable to Create First Aids. Try Again";
    
}
$_SESSION['msgSuccess']=$msg;
echo"<script>location.href='../firstaids.php';</script>";
?>