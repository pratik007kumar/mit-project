<?php

if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");

include("../../admin/includes/phpfunction.php");

if(isset($_POST))

{

    $dataarr=$_POST;
    $email=$_POST['email'];
    $user=getUserByEmail($email);

    if($user['id']!=""){
         $newpass=  time();
       $sql="UPDATE `users` SET `password` = '".md5($newpass)."' WHERE `id` ='".$user['id']."';";
        mysql_query($sql);

//veryfication mail  function ();

  // echo $activation =md5($_POST['password']);// encrypt_decrypt($var,true);

        $to = $_POST['email'];
        $subject = "Forget Password:";
        $headers = "From: noreplay@mitsim.com " ;//. strip_tags($_POST['req-email']) . "\r\n";
        $headers .= "Reply-To:noreplay@mitsim.com ";//. strip_tags($_POST['req-email']) . "\r\n";
       // $headers .= "CC: susan@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $body = "Dear User, <br/> <br/>
                Welcome to MITSIM.<br>
                Email:".$email."<br>
               Your New Password:".$newpass." <br/>";
        //$body .="Please click this link to activate your account: " . BASE_URL . "verify.php?activation=".$var."&v=".$activation;

    $body .="
            Warm Regards, <br>
            Admin, <br>
            www.MITSIM.com";




        mail($to, $subject, $body, $headers);

        //send mail





        $msg='      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="alert alert-success">

                  <a class="close" data-dismiss="alert">×</a>

                 <strong>Success!</strong> <br> Your new Password is generated Succesfully.<br>Please check your email.

            </div>

            </div>';

    }else{$msg='      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="alert alert-success">

                  <a class="close" data-dismiss="alert">×</a>

                 <strong>Error!</strong> Not a vaild Email.

            </div>

            </div>';}

    echo $msg;

}else

{

    echo "<script>location.href='".SITE_URL."404.php';</script>";

}