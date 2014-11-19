 <?php if(session_id()==null || session_id()==""){session_start();}
require("../config/config.php");
include("../admin/includes/phpfunction.php");
 require_once("userLoginClass.php");
 $user = new User();
 //checking cookies

 $user->session_logout();

?>
