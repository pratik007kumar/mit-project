                                <?php error_reporting(0); if(session_id()==null || session_id()==""){session_start();}
require("config/config.php");
include("admin/includes/phpfunction.php");
require_once("includes/userLoginClass.php");
$user = new User();
 
//echo encrypt_decrypt('VBoykNtAAYZ6u%20ZzuEJ4xIVJQxcfE7F8fXfOM0zPwIA%3D',false);
//exit;

//checking cookies
//print_r($_COOKIE);

//$user->checkCookies();

//checking session
$user->checkSession();
$msgSucc="";
if(isset($_SESSION['msgSuccess']) && $_SESSION['msgSuccess']!=""){ $msgSucc=$_SESSION['msgSuccess']; $_SESSION['msgSuccess']="";}

if(isset($_POST['login']) )
{

    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

//printarray($_POST);
//if file index.php get post data
        if($_POST) {
            //checked that post using function check_login (from file class.php)
            $login = $user->check_login($_POST['username'], $_POST['password']);
            //if checklist remember me
            if(isset($_POST['remember'])) {
                //setcookies
                $user->setCookies($_POST['username']);
            }
            //if user has login
            if($login) {
                //if true, redirect to admin.php
             $user_details=getUserByEmail($_POST['username']);
                if($user_details['status']!='0'){

                echo "<script>location.href='".SITE_URL."profile.php';</script>";
                }else
                {
                    $_SESSION['err_msg'] = "Your Account is not Active Check inbox and follow link !";
                }

                //header("location: admin.php");
            } else {
                //if false, we must login again.
                 $_SESSION['err_msg'] = "Sorry Email or password is wrong!!";
            }

        }


    }

}

if(isset($_POST['submit']))
{
 //printarray($_POST);
    //`id`
   $user_details=getUserByEmail($_POST['email']);
    if($user_details['id']!="")
    {
        $_SESSION['err_msg']="User all ready created with same Email ! Try other email to create new Account. ";

        echo"<script>location.href='index.php';</script>";
    }else{

    $dataArr=array();
    $dataArr['user_type']=isset($_POST['user_type'])?$_POST['user_type']:"";
    $dataArr['f_name']=isset($_POST['f_name'])?$_POST['f_name']:"";
    $dataArr['l_name']=isset($_POST['l_name'])?$_POST['l_name']:"";
    $dataArr['email']=isset($_POST['email'])?$_POST['email']:"";
    $dataArr['password']=isset($_POST['password'])? md5($_POST['password']):"";
    $dataArr['photo']=isset($_POST['photo'])?$_POST['photo']:"";
    $dataArr['mobile']=isset($_POST['mobile'])?$_POST['mobile']:"";
    $dataArr['address1']=isset($_POST['address1'])?$_POST['address1'] :"";
    $dataArr['address2']=isset($_POST['address2'])?$_POST['address2'] :"";
    $dataArr['state']=isset($_POST['state'])?$_POST['state'] :"";
    $dataArr['city']=isset($_POST['city'])?$_POST['city'] :"";
    $dataArr['zip']=isset($_POST['zip'])?$_POST['zip'] :"";
    $dataArr['phone_no']=isset($_POST['phone_no'])?$_POST['phone_no'] :"";
    $dataArr['fax_no']=isset($_POST['fax_no'])?$_POST['fax_no'] :"";
    $dataArr['website']=isset($_POST['website'])? $_POST['website'] :"";
    $dataArr['dob']=isset($_POST['dob'])?  date('Y-m-d',strtotime($_POST['dob'])) : date('Y-m-d');

      $dataArr['gender']=isset($_POST['gender'])? $_POST['gender'] :"";
    $dataArr['height']=isset($_POST['height'])?$_POST['height'] :"";
    $dataArr['weigth']=isset($_POST['weigth'])?$_POST['weigth'] :"";
    $dataArr['blood_group']=isset($_POST['blood_group'])?$_POST['blood_group'] :"";
    $dataArr['specialization']=isset($_POST['specialization'])?$_POST['specialization'] :"";
    if($dataArr['specialization']=='o')
        {$dataArr['specialization']=$_POST['spcother'];}

    $dataArr['qualification']=isset($_POST['qualification'])?$_POST['qualification'] :"";
        if($dataArr['qualification']=='o')
        {$dataArr['qualification']=$_POST['quaother'];}

    $dataArr['experience']=isset($_POST['experience'])? $_POST['experience']:"";
    $dataArr['registration_no']=isset($_POST['registration_no'])?$_POST['registration_no'] :"";
    $dataArr['department']=isset($_POST['department'])?$_POST['department'] :"";
    $dataArr['indications']=isset($_POST['indications'])?$_POST['indications'] :"";
    $dataArr['color']=isset($_POST['color'])? $_POST['color'] :"";
    $dataArr['strength']=isset($_POST['strength'])?$_POST['strength'] :"";
    $dataArr['status']=0;

    $var=insertuser($dataArr);
if($var)
{

//veryfication mail  function ();

   echo $activation =md5($_POST['password']);// encrypt_decrypt($var,true);

        $to = $_POST['email'];
        $subject = "Email verification:";
        $headers = "From: noreplay@mitsim.com " ;//. strip_tags($_POST['req-email']) . "\r\n";
        $headers .= "Reply-To:noreplay@mitsim.com ";//. strip_tags($_POST['req-email']) . "\r\n";
       // $headers .= "CC: susan@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $body = "Dear User, <br/> <br/>
                Welcome to MITSIM  We  thank you for registering with us.<br>
                We need to make sure you are human. Please verify your email and get started using your Website account. <br/>";
        $body .="Please click this link to activate your account: " . BASE_URL . "verify.php?activation=".$var."&v=".$activation;

    $body .="
            Warm Regards, <br>
            Admin, <br>
            www.MITSIM.com";




        mail($to, $subject, $body, $headers);



    $login = $user->check_login($_POST['email'], $_POST['password']);
    if($login) {
        //if true, redirect to admin.php
       echo "<script>location.href='".SITE_URL."profile.php?id=".$_SESSION['id']."&cd=".encrypt_decrypt($_SESSION['id'],true)."';</script>";
        //header("location: admin.php");
    } else {
        //if false, we must login again.
        $_SESSION['err_msg'] = "Sorry Email or password is wrong!!";
    }
//echo"<script>location.href='profile.php?id=".$var."@".$dataArr['f_name']."';</script>";

}
    }

   //  printarray($dataArr);
    //exit;
}else{
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MITSIM</title>
<meta name="keywords" content="Mitsim" />
<link rel="stylesheet" href="css/style.css" />
<link href="css/bootstrap.css" rel="stylesheet"/>
<link href="assets/css/datepicker.css" rel="stylesheet">
<link href="assets/css/bootstrap-dialog.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/signin.css" rel="stylesheet"/>

<style>
    body.modal-open .datepicker {
    z-index: 1200 !important;
}
</style>

</head>

<body style="background: none !important;">
<?php 
include("includes/ajax/forgetpassword.php");
?>

<section style="background-image:url(images/singup1.jpg); background-repeat:no-repeat; height: 15vh; min-height: 100px; ">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                <form method="post" action="index.php" class="form-inline" >
                <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right">

                    <div class="row" style="width:700px; float:right; margin-top: 20px">

                        <div class="align">
                            <input name="username" type="email" required class="textbox3" placeholder="Email" />
                            <div class="pull-right">
                                <a href="#forgetPassword" data-toggle="modal" class="forgetpassword" >Forget Password &nbsp; &nbsp;</a>
                            </div>
                        </div>
                        <div class="align1">
                            <input name="password" type="password" required class="textbox3" placeholder="Password" />
                             <div class="  forgetpassword text-left"> 
                                 <input name="remember" class="check" type="checkbox" /> Keep Logged In 
                             </div>
                        </div>
                        <div class="align2">
                            <input name="login" type="submit" value="Sign In" class="button_example"/>
                        </div>
                        <div class="align2">
                            <input name="txtpwd" type="button" value="Sign Up" data-target="#EditBasicInfo" data-toggle="modal" class="button_example"/>
                        </div>

                    </div>
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">


                       
                            
                            
                        
                        
                    </div>
                        </div>

                </div>
                </form>

        </div>

    </div>

</section>

<section style="margin-top: 100px; height: 54vh; ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  text-center ">
                <img src="images/mitsim-logo.png" alt="" /><br /><br /><br />
                <div style="margin: 0 auto; width: 550px;">
                <form method="get" action="home.php" class="form-inline">
                    <input type="text" class="textbox" name="sh" placeholder="Hospitals Clinic Store know by your locations" >
                    <button type="submit" class="btn btn-info">Search</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
</section>
<section style="margin-top: 10vh; ">

<div class="footer">Copyright @ 2014 MITSIM</div>
    </section>



<!--<script src="assets/js/jquery.js" type="text/javascript"></script>-->
<!--<script src="js/bootstrap.min.js" type="text/javascript"></script>-->
<!--<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>-->

<!---->

<!---->
<!---->
<!--<script type="text/javascript" src="js/mainjs.js"></script>-->

<?php include('includes/mainjs.php');?>
<script src="assets/js/bootstrap-dialog.min.js" type="text/javascript"></script>
<script src="assets/js/bootbox.min.js" type="text/javascript"></script>
<script src="assets/js/bootbox.js" type="text/javascript"></script>
<?php errorMessage();  ?>

<?php include('includes/sineup.php');?>
</body>

</html>
<?php } ?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            