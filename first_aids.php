<?php
if (session_id() == null || session_id() == "") {
    session_start();
}
require("config/config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>MITSIM</title>

    <?php include("includes/css_js.php"); ?>
    <?php include("includes/paginate.php"); ?>
    <link href="css/profile.css" rel="stylesheet" type="text/css" />


    <script src="js/jquery-1.3.0.min.js" type="text/javascript"></script>

     <script type="text/javascript">
         $(document).ready(function () {
             $('.tree li').each(function () {
                 if ($(this).children('ul').length > 0) {
                     $(this).addClass('parent');
                 }
             });

             $('.tree li.parent > a').click(function () {
                 $(this).parent().toggleClass('active');
                 $(this).parent().children('ul').slideToggle('fast');
             });

             $('#all').click(function () {

                 $('.tree li').each(function () {
                     $(this).toggleClass('active');
                     $(this).children('ul').slideToggle('fast');
                 });
             });

         });
     </script>

</head>

<body>


<div class="main">

    <?php include("includes/header_menu.php"); ?>

    <div style="width:1024px; height:auto; margin:0 auto;">
    
        <div class="sidebar">
            <div class="main-nav">
                <div class="menu">
                    <input id="Button1" type="text" class="txtsearch"/>
                </div>
            </div>
            <br>
            <br>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="javascript:;"><i class="fa fa-home"></i> Flash</a>
                    </li>

                    <li>
                        <a href="javascript:;"><i class="fa fa-heart"></i> Create Strips</a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="fa fa-fw fa-eye"></i> Favourites</a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="fa fa-fw fa-eyedropper"></i> First Aids</a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="fa fa-heart"></i> Privacy Settings</a>
                    </li>
                    
                </ul>
            </div>
        </div>

        				<div class="divright" id="disp">
							<?php
                                $sql = "Select * from first_aids where status='1' order by id asc";
                                $query = mysql_query($sql) or die(mysql_error()); 
                                $i=0;
                                while($row = mysql_fetch_array($query))
                                {
                                    $i++;
                                    $data = "<div class='panel-group' id='accordion'>";
                                    $data .="<div class='panel panel-default pnl'>";
                                    $data .="<div class='panel-heading'>";
                                    $data .="<h4 class='accordion-toggle tgl panel-title' data-toggle='collapse' data-parent='#' href='#".$i."'>
                                    <a class='accordion-toggle tgl' data-toggle='collapse' data-parent='#' href='#".$i."'>&nbsp;&nbsp;".$row['name']."</a></h4>";
                                    $data .="</div>";
                                    $data .="<div id='".$i."' class='panel-collapse collapse'>";
                                    $data .="<div class='panel-body'>";
                                    $data .="<div class='tree'>";
                                    $data .="<ul>";
                                    $data .="<li><a>Causes</a>";
                                    $data .="<ul>";
                                    $data .="<li><p>".$row['causes']."</p></li>";
                                    $data .="</ul>";
                                    $data .="</li>";
                                    
                                    $data .="<li><a>Risk Factor</a>";
                                    $data .="<ul>";
                                    $data .="<li><p>".$row['risk_factor']."</p></li>";
                                    $data .="</ul>";
                                    $data .="</li>";
                                    
                                    $data .="<li><a>Treatment</a>";
                                    $data .="<ul>";
                                    $data .="<li><p>".$row['treatment']."</p></li>";
                                    $data .="</ul>";
                                    $data .="</li>";
                                    $data .="</ul>";
                                    $data .="</div>";
                                    
                                    $data .="<div class='input-group'>";
                                    $data .="<div class='input-group-addon div-box'><img src='images/temp1.jpg' alt='' /></div>";
                                    $data .="<input class='form-control' placeholder='Say something...'>";
                                    $data .="</div>";
                                    $data .="</div>";
                                    $data .="</div>";
                                    $data .="</div>";
                                    $data .="</div>";
                                    echo $data;
                                }
                            ?>
		           
</html>