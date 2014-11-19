<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");
$dataArr=array();
$dataArr=$_POST;
//$dataArr['category']='store';
//$row=getStoreByName($dataArr['name']);
//if($row['id']=="")
//{
if(insertStore($dataArr)){echo "Store Created Successfully !!";}else{ echo("Unable to Create Store. Try Again");}
//}
//echo "Store name is not Available !!"

?>