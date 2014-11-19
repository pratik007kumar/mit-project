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
$countsql="SELECT count(id) FROM `medicine` where";
if($cat!="*")
{$countsql.=" category='".$cat."'   and ";}
$countsql.="  status='1'";
$count=mysql_fetch_array(mysql_query($countsql));
$total_results =$count['0'] ; //289
//echo $total_results;exit;
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


$sql="SELECT * FROM `medicine` where";
if($cat!="*")
{$sql.=" category='".$cat."'   and ";}
$sql.="  status='1' LIMIT ".$start." , ". $per_page  ;

$result = mysql_query($sql);
?>
<h2 class="page-heading">
<?php if($cat!="*"){
    echo  sentence_cap(" ",getCategoryNameById('medicine',$cat));
    }else{
    echo "A to Z";
}
    ?>
</h2>
<?php
while($row=mysql_fetch_array($result))
{
    $description="";
    $description.=$row['description']!=""?$row['description']:'';
    ?>

    <div class="data-div" id="td_content">
        <div class="default-image"><img src="images/temp.jpg" alt=""/></div>
        <div class="blue-heading">  <?= sentence_cap(" ",$row['name']);?><br> <span><?=sentence_cap(" ",$row['company']);?></span>  </div>
        <div class="address-box">
            <?=$description;?>
            <ul>
                <li><a href="#">Like</a></li>
                <li><a href="#"><i class="fa fa-fw fa-star star-color"></i>25 </a></li>
            </ul>


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