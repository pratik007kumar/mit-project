
<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");

if(isset($_POST['id']))
{
    echo getAllCityById("",$_POST['id']);
}