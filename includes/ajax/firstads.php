<?php error_reporting(0);
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
?>

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
    $data .="<li><div class='accordion-indiv'>".$row['causes']."</div></li>";
    $data .="</ul>";
    $data .="</li>";

    $data .="<li><a>Risk Factor</a>";
    $data .="<ul>";
    $data .="<li><div class='accordion-indiv'>".$row['risk_factor']."</div></li>";
    $data .="</ul>";
    $data .="</li>";

    $data .="<li><a>Treatment</a>";
    $data .="<ul>";
    $data .="<li><div class='accordion-indiv'>".$row['treatment']."</div></li>";
    $data .="</ul>";
    $data .="</li>";
    $data .="</ul>";
    $data .="</div>";
    
     $sesimg=SITE_URL."images/temp40.jpg";

                       if(isset($_SESSION['id']) && $_SESSION['id']!="")
                        {
                            $sesdetails=getUserById($_SESSION['id']);
                            $sesimg=IMAGE_URL."profile/40/".$sesdetails['photo'];

                            if(!file_exists($sesimg))
                            {
                                $sesimg=SITE_URL."images/temp40.jpg";
                            }else{
                                $sesimg=SITE_URL."uploades/profile/40/".$sesdetails['photo'];
                            }
                        }
                        


$data .= '
        <div class="panel1" id="com'.$i.'" style="float:left;">
            <div class="pnl-comment">
                <div class="input-group">
                    <div class="div-box"><img src="'.$sesimg.'" alt=""   /></div>
                    <div class="comment-frm"> <form id="cfm'.$i.'" method="post" action="#" onsubmit="return makecomment('.$i.')"  >
                            <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message'.$i.'">
                            <input type="hidden" id="id" name="id" value="'.$row['id'].'">
                            <input type="hidden" id="type" name="type" value="farstads">
                            <input id="bt'.$i.'"   type="submit" style="width: 0px !important; height: 0px !important; border: none;"/>
                        </form>
                    </div>
                </div>
                <div class="actionBox">
                    <ul class="commentList" id="clist'.$i.'">';
                $data  .=    getComment('farstads',$row['id']);
                  $data  .= '  </ul>
               </div>
                 </div>
                   </div>';


  //  $data .="<div class='input-group'>";
   // $data .="<div class='input-group-addon div-box'><img src='images/temp1.jpg' alt='' /></div>";
    //$data .="<input class='form-control' placeholder='Say something...'>";
    //$data .="</div>";
   // $data .="</div>";
    $data .="</div>";
    $data .="</div>";
    $data .="</div>";
    echo $data;
}
?>
                            