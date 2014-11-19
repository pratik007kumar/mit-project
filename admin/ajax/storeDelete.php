<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/12/14
 * Time: 4:32 PM
 */
if(isset($_POST['id']))
{

    if(storeDelete($_POST['id']))
    { echo("Delete Successfully !!"); }
    else
    {echo "Unable to Delete Try Again !!";}


}
?>