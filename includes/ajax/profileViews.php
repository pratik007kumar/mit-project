<?php error_reporting(0);
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
$per_page=25;
$start=0;
if(isset($_POST['start']))
{
    $start=$_POST['start'];
}

$sqllikes="SELECT id FROM `viewes` where  status='1' And viewer_id='".$_POST['id']."' order By id desc  LIMIT ".$start." , ". $per_page ;
$result = mysql_query($sqllikes);
$i=0;
$count =mysql_num_rows($result);
while($row=mysql_fetch_array($result))
{

    $data=getViewesbox($i,$row['id']);
    echo $data;
    $i++;

}

if($count>"30"){
    echo ' <input type="button"  id="morebtn" class="btn btn-info" onclick="showProfileViewes()" style="width: 100%;" value="View More">';
}
