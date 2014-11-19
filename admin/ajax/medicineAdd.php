<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");
$dataArr=array();
$dataArr=$_POST;
 //$dataArr['description']=$_POST['description']!=""? "<pre>".$_POST['description']."</pre>":"";
//$row=getStoreByName($dataArr['name']);
//if($row['id']=="")
//{
if(insertMedicine($dataArr)){echo "Medicine Add Successfully !!";}else{ echo("Unable to Create Store. Try Again");}
//}
//echo "Store name is not Available !!"

?>