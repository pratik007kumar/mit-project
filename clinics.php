<?php error_reporting(0);
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
     <link href="css/profile.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div class='backdiv'>
<div class='backl' style=""></div> 
<div class='backR' style=""></div>
</div>


<div style="" class='main-body-div'>

<div class="main">

<?php include("includes/header_menu.php"); ?>

<div class="main-div">
    <div class="sidebar" style="width:339px;  padding-left: -10px;">
        <div class="main-nav">
            <div class="menu">
                <form method="get" action="#" id="sehfrm">
                    <input id="sh" name="sh" value="<?php  if(isset($_GET['sh']) && $_GET['sh']!=""){echo $_GET['sh']; }?>"  type="text" class="txtsearch" onblur="document.getElementById('sehfrm').submit();"/>
                    <input id="sh"   type="submit" style="width: 0px !important;visibility: hidden; height: 0px !important; border: none;"/>
                </form>
            </div>
        </div>
        <br>
        <br>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">

                <li>
                    <a href="javascript:;" onclick="clinicsView('23','0')"><i class="fa fa-fw fa-h-square"></i> &nbsp;Top Hospitals</a>
                </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('24','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;Private Hospitals</a>
                </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('25','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;Govt. Hospitals</a>
                </li>
               <li>
                    <a href="javascript:;" onclick="clinicsView('26','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;24/7  Hospitals</a>
               </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('27','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;Clinics</a>
                </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('28','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;Eye Care</a>
                </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('29','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;Bone Specialist</a>
                </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('30','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;Dentist</a>
                </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('31','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;Child Specialist</a>
                </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('32','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;Patho Lab</a>
                </li>
                <li>
                    <a href="javascript:;" onclick="clinicsView('33','0')"><i class="fa fa-fw fa-h-square"></i>	&nbsp;X-Ray Centre</a>
                </li>
                <li>
                    <a href="clinics.php"><i class="fa fa-fw fa-h-square"></i> &nbsp;All</a>
                </li>




            </ul>
        </div>
    </div>

    <div class="div-profile-body-right" style="width:676px;" id="disp">

        <?php
        $per_page = 20;
        if(isset($_GET['all']))
        {$per_page = 10000;}

        $show_page ="";
        $sqlC="SELECT count(id) FROM `clinics` where  status='1'";
        if(isset($_GET['sh']) && $_GET['sh']!="")
        {
            $_GET['sh']=" ".$_GET['sh'];
            $txtarr=explode(" ",$_GET['sh']);
            $tx1="";
            foreach($txtarr as $tx)
            {
                $tx1.=getCityByName($tx)!=""?" ".getCityByName($tx):"";
                $tx1.=getStateByName($tx)!=""?" ".getStateByName($tx):"";



            }
            $txt=$tx1!=""?$tx1:"";
            $txt.= $_GET['sh'];
            $sqlC = "SELECT  count(id) FROM `clinics` WHERE `status`='1' And MATCH (`name`, `address`, `city`, `state`, `website`, `phno`) AGAINST ('".$txt."' IN BOOLEAN MODE);";


        }
        //if id is set
         if(isset($_GET['i']) && $_GET['i']!="")
        {
            $sqlC = "SELECT  count(id) FROM `clinics` WHERE `status`='1' and id='".$_GET['i']."'"; 
        }
        $count=mysql_fetch_array(mysql_query( $sqlC));
        $total_results =$count['0'] ; //289
        if($total_results=="0"){
            echo
            '
              <div class="content" id="td_content">
              <h1 style="color: #32789C;">
              No Record Found !!
              </h1>
              </div>
            ';
        }
        $total_pages = ceil($total_results / $per_page); //29

        if (isset($_GET['page'])) {
            $show_page = $_GET['page'];

            if ($show_page > 0 && $show_page <= $total_pages) {
                $start = ($show_page - 1) * $per_page;
                $end = $start + $per_page;
            } else {
                // error - show first set of results
                $start = 0;
                $end = $per_page;
            }
        } else {
            // if page isn't set, show first set of results
            $start = 0;
            $end = $per_page; //10
        }
        $page = 0;
        if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
        }
        $tpages = $total_pages;
        if ($page <= 0) {
            $page = 1;
        }
        $sql="SELECT * FROM `clinics` where  status='1' order By rand()  LIMIT ".$start." , ". $per_page  ;

        if(isset($_GET['sh']) && $_GET['sh']!="")
        {
            $txtarr=explode(" "," ".$_GET['sh']);
            $tx1="";
            foreach($txtarr as $tx)
            {
                $tx1.=getCityByName($tx)!=""?" ".getCityByName($tx):"";
                $tx1.=getStateByName($tx)!=""?" ".getStateByName($tx):"";



            }
            $txt=$tx1!=""?$tx1:"";
            $txt.= $_GET['sh'];
            $sql = "SELECT  * FROM `clinics` WHERE `status`='1' And MATCH (`name`, `address`, `city`, `state`, `website`, `phno`) AGAINST ('".$txt."' IN BOOLEAN MODE) LIMIT  0,1000";


        }
        if(isset($_GET['i']) && $_GET['i']!="")
        {
            $sql = "SELECT  * FROM `clinics` WHERE `status`='1' and id='".$_GET['i']."'"; 
        }

        $result = mysql_query($sql);
$i=0;

        while($row=mysql_fetch_array($result))
        {
            $address="";
            $address.=$row['address']!=""?$row['address']:'';
            $address.=$row['state']!=""?", ".getStateByID($row['state']):'';
            $address.=$row['city']!=""?", ".getCityByID($row['city']):'';
            $address.=$row['pin']!=""?"-".$row['pin']:'';
            $address.="<br>";
            $address.=$row['phno']!=""?" <i class='fa fa-phone'></i> ".$row['phno']:'';
            $address.=$row['website']!=""?" <i class='fa fa-desktop'></i> ".$row['website']:'';


            $allfollow=getallfavourite('clinics',$row['id']);
            $i++;

            ?>

            <div class="data-div" id="td_content">
                <div class="default-image"><img src="images/temp.jpg" alt=""/></div>
                <div class="blue-heading">  <?= sentence_cap(" ",$row['name']);?>  </div>
                <div class="address-box">
                    <?=$address;?>

                        <div class="div-like">
                            <ul>
                                <li id="likes<?=$i;?>"><a  <?php
                                    if(isset($_SESSION['id']) && $_SESSION['id']!="")
                                    {
                                        $ro=getislike('clinics',$row['id']);
                                        if($ro['id']!="")
                                        {
                                            echo 'href="javascript:" onclick="like(\'0\',\''.$row['id'].'\',\'clinics\',\'likes'.$i.'\')" >Unlike</a>';
                                        }else{
                                            echo 'href="javascript:" onclick="like(\'1\',\''.$row['id'].'\',\'clinics\',\'likes'.$i.'\')" >Like</a>';
                                        }
                                    }else{

                                        echo 'href="#login" data-toggle="modal" >Like</a>' ;
                                    }
                                    ?></li>
                                <li id="recommend<?=$i;?>"><a
                                    <?php
                                    if(isset($_SESSION['id']) && $_SESSION['id']!="")
                                    {

                                        echo ' href="javascript:" onclick="emailmodal(\'clinics\',\''.$row['id'].'\')">Recommend</a>';

                                    }else{

                                        echo ' href="#login" data-toggle="modal" >Recommend</a>' ;
                                    }
                                    ?></li>
                                <li id="follow<?=$i;?>"><a <?php
                                    if(isset($_SESSION['id']) && $_SESSION['id']!="")
                                    {

                                        $ro=getisfavourite('clinics',$row['id']);
                                        if($ro['id']!="")
                                        {
                                            echo 'href="javascript:" onclick="favourite(\'0\',\''.$row['id'].'\',\'clinics\',\'follow'.$i.'\','.$allfollow.')" ><i class="fa fa-fw fa-star star-color"></i> '.$allfollow.'</a>';
                                        }else{
                                            echo 'href="javascript:" onclick="favourite(\'1\',\''.$row['id'].'\',\'clinics\',\'follow'.$i.'\','.$allfollow.')" ><i class="fa fa-fw fa-star star-color"></i> '.$allfollow.' </a>';
                                        }
                                    }else{

                                        echo 'href="#login" data-toggle="modal" ><i class="fa fa-fw fa-star star-color"></i> '.$allfollow.' </a>' ;
                                    }
                                    ?>
                                </li>

                            </ul>
                        </div>




                </div>

            </div>
        <?php } ?>


        <?php
        $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;

        echo '<div class="pagination"><ul>';
        if ($total_pages > 1) {
            echo paginate($reload, $show_page, $total_pages);
        }
        ?>
        <!--            <li><a href="store.php?all=1"> All </a></li>-->
        <?php
        echo "</ul></div>";
        ?>

    </div>
</div>

</div>

</div>


</body>
</html>

                            