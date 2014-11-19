<?php if(session_id()==null || session_id()==""){session_start();}

require("../config/config.php");
if(isset($_SESSION['username'] ) && isset($_SESSION['usertype']) && $_SESSION['usertype']=="admin")
{
    echo "<script>location.href='index.php'</script>";
}

if(isset($_POST['submit'])){
    session_unset();
    session_destroy();

//    echo "<pre>";
//    print_r($_POST);
//    exit;
    if(session_id()==null || session_id()==""){session_start();}
    $errors = '';
    $uName=mysql_real_escape_string($_POST['username']);
    $password=mysql_real_escape_string($_POST['password']);
    if($uName='' || empty($uName)){
        $errors .= "\nPlease Enter User Name.";
    }
    if($password='' || empty($password)){
        $errors .= "\nPlease Enter Password.";
    }
     $sql="SELECT * FROM `admin` WHERE `username`='".$_POST['username']."' AND `password`=md5('".$_POST['password']."')";
    $result=mysql_query($sql)  or  die("error");

    $row=mysql_fetch_array($result);

    if($row['id']!=""){

        $_SESSION['username']=$row['username'];
        $_SESSION['usertype']="admin";
        echo "Redirecting to dashbord...";
         echo "<script>location.href='index.php'</script>";
    }else{
        $errors .="\nInvalid Login";
    }
}


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome-4.1.0/css/font-awesome.min.css" />

    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script type="text/javascript" src="js/jquery-1.11.0.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Admin Login</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                     alt="">
                <form class="form-signin" method="post">
                    <input type="text" name="username" class="form-control" placeholder="User Name" required autofocus>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">
                        Sign in</button>
<!--                    <label class="checkbox pull-left">-->
<!--                        <input type="checkbox" value="remember-me">-->
<!--                        Remember me-->
<!--                    </label>-->

                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>