<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/23/14
 * Time: 2:26 PM
 */

class User
{
    //private variabel for session data
    private $user;
    //function for check username and password
    function check_login($username, $password) {
        //get username value and save to private variabel
        $this->user = $username;
        //checked username and password
        //echo "SELECT id FROM `users` WHERE `email`='".$username."' and `password`=md5('".$password."')";
        //exit;
        $row=mysql_fetch_array(mysql_query("SELECT id,f_name FROM `users` WHERE `email`='".$username."' and `password`=md5('".$password."')"));
        if($row['id']!=""){
 //       if($username = "admin" && $password = "password") {
            //if username and password true, then create session.
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['f_name']=$row['f_name'];

            return true;
        } else {
            //if username and password false
            return false;
        }
    }

    //function for set cookies 1 hour
    function setCookies($user) {
        setcookie("user", $user, time()+3600,"/");
    }

    //function for checking cookies
    function checkCookies() {

        if(isset($_COOKIE)) {
            if(isset($_COOKIE['user']) && $_COOKIE['user']!="a") {
                $_SESSION['login'] = true;
                $_SESSION['id'] = $_COOKIE['user'];
            }
        }
        //print_r($_COOKIE['user']);exit;
    }

    //function for checking session
    function checkSession() {
        //if user has login and session has not been removed
        if(isset($_SESSION['login'])) {
            //redirect to file admin.php and don't need login again
          //  header("location: admin.php");
            echo "<script>location.href='".SITE_URL."profile.php?id=".encrypt_decrypt($_SESSION['id'],true)."';</script>";
        }
    }

    //function for delete sessions
    function session_logout() {
        unset($_SESSION['login']);
        unset($_SESSION['id']);
        unset($_COOKIE['user']);

        //delete all sessions
        session_destroy();
        //delete cookie
        setcookie('user', "", -1, '/');
       //  setcookie ("user", "", time() - 3600);

      //  setcookie ('user', "", time() - 3600, "/", "", 1);
        //redirect to form login
        //header("location: index.php");
       echo "<script>location.href='".SITE_URL."index.php';</script>";

    }
}