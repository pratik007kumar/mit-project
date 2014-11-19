<?php error_reporting(0);
if (session_id() == null || session_id() == "") {
    session_start();
}
require("config/config.php");
include("admin/includes/phpfunction.php");
$msg="";
if(isset($_GET['activation']) && $_GET['activation'] !="")
{


$vpcode="";

//echo  $vpcode=rawurlencode($_GET['activation']);
//echo "<br>". $email=encrypt_decrypt(rawurlencode($_GET['activation']),false);
//  exit;
$email=$_GET['activation'];
  $row=getUserById(trim($email));   
    if($row['id']!="")
    {
        if($row['status']!='1')
        {
        if(activeuser($row['id']))
        {
            $msg=' Your account Activate Successfully !!<br>
                        <a href="index.php" class=" btn btn-info"> Click to Login</a>';
        }else
        {
            $msg=' Unable to Activate Your Account.<br> Try again!!<br>
                        <a href="index.php" class=" btn btn-info"> Home</a>';

        }
        }else
        {
            $msg='Your account is All Ready Activate !!<br>
                        <a href="index.php" class=" btn btn-info"> Click to Login</a>';
        }

    }else{
        $msg=' Unable to Activate Your Account.<br> Try again!!<br>
                        <a href="index.php" class=" btn btn-info"> Home</a>';}
}
else{
    $msg=' Unable to Activate Your Account.<br> Try again!!<br>
                        <a href="index.php" class=" btn btn-info"> Home</a>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>MITSIM</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    </head>
<body style="background:#1C262F; ">
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="width: 400px; margin: 100px auto;">
                    <div class="jumbotron" style="height: 200px; padding: 20px 0px; width: 100%; text-align: center;">

                       <?=$msg;?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>





                            
                            
                            
                            
                            
                            