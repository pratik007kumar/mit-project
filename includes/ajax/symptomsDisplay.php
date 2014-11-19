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
$countsql="SELECT count(id) FROM `symptoms` where";
if($cat!="*")
{$countsql.=" category='".$cat."'   and ";}
$countsql.="  status='1'";
$count=mysql_fetch_array(mysql_query($countsql));
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


$sql="SELECT * FROM `symptoms` where";
if($cat!="*")
{$sql.=" category='".$cat."'   and ";}
$sql.="  status='1' LIMIT ".$start." , ". $per_page  ;

$result = mysql_query($sql);
?>
    <h2 class="page-heading">
        <?php if($cat!="*"){
            echo  sentence_cap(" ",getCategoryNameById('symptoms',$cat));
        }else{
            echo "A to Z";
        }
        ?>
    </h2>
<?php
$i=1;

if($count['0']==0)
{
    echo '<div class="content" id="1" style="width: 100%; color: #9e9e9e;text-align: center;"><h2><i>No Record Find..! </i></h2></div>';
}
while($row=mysql_fetch_array($result))
{
    $i++;
    ?>


    <div class="content" id="1">
        <div class="div-pic"><img src="images/temp.jpg" alt="" /></div>
        <div class="profile-nm"><?=$row['name'];?></div>
        <div class="div-pic-content">
            <?=$row['description'];?>

            <!--                 <a href="#">more</a>-->
            <div class="div-like">
                <ul>
                    <li id="likes<?=$i;?>"><a  <?php
                        if(isset($_SESSION['id']) && $_SESSION['id']!="")
                        {
                            $ro=getislike('store',$row['id']);
                            if($ro['id']!="")
                            {
                                echo 'href="javascript:" onclick="like(\'0\',\''.$row['id'].'\',\'symptoms\',\'likes'.$i.'\')" >Unlike</a>';
                            }else{
                                echo 'href="javascript:" onclick="like(\'1\',\''.$row['id'].'\',\'symptoms\',\'likes'.$i.'\')" >Like</a>';
                            }
                        }else{

                            echo 'href="#login" data-toggle="modal" >Like</a>' ;
                        }
                        ?></li>
                    <li id="recommend<?=$i;?>"><a
                        <?php
                        if(isset($_SESSION['id']) && $_SESSION['id']!="")
                        {

                            echo ' href="javascript:" onclick="emailmodal(\'symptoms\',\''.$row['id'].'\')">Recommend</a>';

                        }else{

                            echo ' href="#login" data-toggle="modal" >Recommend</a>' ;
                        }
                        ?></li>

                    <li><a class="comment_button"
                            <?php
                            if(isset($_SESSION['id']) && $_SESSION['id']!="")
                            {

                                echo ' href="javascript:"  onclick="showcommentbox(\'com'.$i.'\')" ';

                            }else{

                                echo ' href="#login" data-toggle="modal" ' ;
                            }
                            ?>
                            >Comment</a></li>
                </ul>
            </div>

            <div class="panel1" id="com<?=$i?>">
                <div class="pnl-comment">
                    <div class="input-group">
                        <div class="div-box"><img src="images/temp1.jpg" alt=""   /></div>
                        <div class="comment-frm"> <form id="cfm<?=$i?>" method="post" action="#" onsubmit="return makecomment(<?=$i?>)"  >
                                <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message<?=$i?>">
                                <input type="hidden" id="id" name="id" value="<?=$row['id']?>">
                                <input type="hidden" id="type" name="type" value="symptoms">
                                <input id="bt<?=$i?>"   type="submit" style="width: 0px !important; height: 0px !important; border: none;"/>
                            </form>
                        </div>
                    </div>
                    <div class="actionBox">
                        <ul class="commentList" id="clist<?=$i?>">
                            <?=getComment('symptoms',$row['id']);?>
                        </ul>
                    </div>

                </div>
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