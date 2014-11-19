<?php if(session_id()==null || session_id()==""){session_start();}
echo "Inserting Record in Database..";
require("../../config/config.php");
require("../includes/phpfunction.php");
$dataArr=array();
$dataArr=$_POST;

$msg="";
if(symptomsAdd($dataArr)){$msg= "Symptoms Created Successfully !!";}else{ $msg="Unable to Create Symptoms. Try Again";}
$_SESSION['msgSuccess']=$msg;
echo"<script>location.href='../symptoms.php';</script>";
?>