<?php
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
//include("paginate.php");
$cat=isset($_POST['cat'])?$_POST['cat']:"";


$per_page = 20;
//            if(isset($_GET['all']))
//            {$per_page = 10000;}

$show_page ="";

$count=mysql_fetch_array(mysql_query("SELECT count(id) FROM `clinics` where category='".$cat."'   and  status='1'"));
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

if (isset($_POST['page']) && $_POST['page'] !="" ) {
    $show_page = $_POST['page'];

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
if (isset($_POST['page']) && $_POST['page'] !="" ) {
    $page = intval($_POST['page']);
}
$tpages = $total_pages;
if ($page <= 0) {
    $page = 1;
}
$sql="SELECT * FROM `clinics` where category='".$cat."' And status='1' order By rand()  LIMIT ".$start." , ". $per_page  ;

$result = mysql_query($sql);
?>
    <h2 class="page-heading"> <?php

    if($cat=='26'){echo "24/7  Hospitals" ;} else{  echo sentence_cap(" ",getCategoryNameById('clinics',$cat));}?>
    </h2>
<?php
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

    <div class="data-div"
         id="td_content">
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
    echo paginate($cat, $show_page, $total_pages);
}
?>
    <!--            <li><a href="store.php?all=1"> All </a></li>-->
<?php
echo "</ul></div>";
?>


<?php

function paginate($cat, $page, $tpages) {
    $adjacents = $tpages;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<li> <a href='javascript:;' >".$prevlabel."</a># \n</li>";
    } elseif ($page == 2) {
        $out.="<li><a href='javascript:;' onclick=\"storeView('".$cat."','".$page."')\" >".$prevlabel."</a>\n</li>";
    } else {
        $out.="<li><a  href='javascript:;' onclick=\"storeView('".$cat."','".($page-1)."')\" >".$prevlabel."</a>\n</li>";
    }
    $pmin=($page>$adjacents)?($page - $adjacents):1;
    $pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li class=\"active\"><a href='javascript:;'>".$i."</a></li>\n";
        } elseif ($i == 1) {
            $out.= "<li  ><a href='javascript:;' onclick=\"storeView('".$cat."','".$i."')\"  >".$i."</a>\n</li>";
        } else {
            $out.= "<li><a href='javascript:;' onclick=\"storeView('".$cat."','".($i)."')\" >".$i. "</a>\n</li>";
        }
    }

    if ($page<($tpages - $adjacents)) {
        $out.= "<li><a style='font-size:11px' href='javascript:;' onclick=\"storeView('".$cat."','".($tpages)."')\"  >" .$tpages."</a>\n</li>";
    }
    // next
    if ($page < $tpages) {
        $out.= "<li><a href='javascript:;' onclick=\"storeView('".$cat."','".($page + 1)."')\" >".$nextlabel."</a>\n</li>";
    } else {
        $out.= "<li><a href='javascript:;' > ".$nextlabel." \n</a></li>";
    }
    $out.= "";
    return $out;
}