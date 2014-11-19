<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");

include("../../admin/includes/phpfunction.php");

$row=getUserById($_POST['id'])

?>
<div class="content" >
    
    <div class="row" style="padding: 15px 15px 15px 0px;">
        <span id="fst"></span>
        <?php 
        $sql="SELECT `id`, `src`,`created` FROM `imagetbl` WHERE `type`='g' And `userid`='".$_POST['id']."' order by created desc";
        $result=  mysql_query($sql);
        while ($row=  mysql_fetch_array($result))
        {
            $src=IMAGE_URL."/images/".trim($row['src']);
            $srcb=IMAGE_URL."/images/".trim($row['src']);

    if(!file_exists($src)&& !file_exists($srcb) )
    {
       // $profile_img=SITE_URL."images/temp120.jpg";
    }else{
        $src=SITE_URL."uploades/images/thumb/".$row['src'];
        $srcb=SITE_URL."uploades/images/".$row['src'];
    
            ?>
        
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" style=" margin-bottom: 15px" id="imgx<?=$row['id']?>">
            <a class="fancybox-button" rel="fancybox-button" href="<?=$srcb?>" title="">
            <img src="<?=$src?>" class="img-thumbnail" style="height: 100px; width: 100% !important;" >
            </a>
            <div style="height:20px; width: 100%;">
                <span class="pull-left text-center " style="font-size:12px;"><?=date('m-d-Y g:i A',  strtotime($row['created']))?></span>
            <?php if(isset($_SESSION['id']) && $_SESSION['id']!="" && $_SESSION['id'] ==$_POST['id'] )
                            {?>
            <span class="pull-right" style="cursor: pointer" title="Delete" onclick="delimg(<?=$row['id']?>)"><i class="fa fa-trash"></i></span>
                            <?php } ?>
            </div>
        </div>
            <?php 
    }
        }
        ?>
    </div>
    
    
</div>
