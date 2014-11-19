<?php
if (session_id() == null || session_id() == "") {
    session_start();
}
require("config/config.php");
include("admin/includes/phpfunction.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>MITSIM</title>
    <?php include("includes/css_js.php"); ?>
    <?php include("includes/paginate.php"); ?>

</head>

<body>


<div class="main">

<?php include("includes/header_menu.php"); ?>

<div style="width:1024px; height:auto; margin:0 auto;">
    <div class="sidebar">
<!--        <div class="main-nav">-->
<!--            <div class="menu">-->
<!--                <input id="Button1" type="text" class="txtsearch"/>-->
<!--            </div>-->
<!--        </div>-->
<!--        <br>-->
<!--        <br>-->


    </div>

    <div class="divright" id="disp">



            <div class="data-div" id="td_content">
            <h2 style="color: #000; text-align: center;">
                <i class="fa fa-eye-slash  "></i>
                There is Some Error.!!
            </h2>
                <br>

<!--                <a href="index.php" class="btn btn-info"> <i class="fa fa-arrow-left"></i> Home </a>-->
            </div>


    </div>
</div>

</div>


</body>
</html>