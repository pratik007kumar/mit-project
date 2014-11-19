<?php error_reporting(0);
if (session_id() == null || session_id() == "") {
    session_start();
}
require("config/config.php");
include("admin/includes/phpfunction.php");

$id="";
if(isset($_SESSION['id']) && $_SESSION['id']!="")
{

    $id=trim($_SESSION['id']);
}
if(isset($_GET['id'])&& $_GET['id']!="")
{
    $id=trim($_GET['id']);
}

if(isset($_SESSION['id']) && $_SESSION['id']!="")
{

    if(trim($_SESSION['id'])!=trim($id))
   {

        setview($id);
    }
}
$profile_img=SITE_URL."images/temp120.jpg";

if($id!="")
{

$row=getUserById($id);

 
if(trim($row['id'])!="" && trim($row['photo'])!="" )
{   $coverimage=IMAGE_URL."coverimage/org/".trim($row['coverImage']);
    $profile_img=IMAGE_URL."profile/120/".trim($row['photo']);

    if(!file_exists($profile_img))
    {
        $profile_img=SITE_URL."images/temp120.jpg";
    }else{
        $profile_img=SITE_URL."uploades/profile/120/".$row['photo'];
    }
    if(!file_exists($coverimage))
    {
$coverimage="#ff";       
// $profile_img=SITE_URL."images/temp120.jpg";
    }else{//coverimage\org
        $coverimage="url('".SITE_URL."uploades/coverimage/org/".$row['coverImage']."')";
    }
    
}else
{

    $msg=encrypt_decrypt('There is Some Error.!!',true);
  //  echo "<script>location.href='404.php?i=".$msg."';</script>";
}
}else{

    $msg=encrypt_decrypt('There is Some Error.!!',true);
   // echo "<script>location.href='404.php?i=".$msg."';</script>";
}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>MITSIM</title>
 <?php  include("includes/maincss.php"); ?>


    
    <!-- Custom styles for this template -->
<!--    <script src="js/jquery-1.3.0.min.js" type="text/javascript"></script>-->

    <link rel="stylesheet" href="<?=SITE_URL?>assets/crop-avatar/css/cropper.min.css">
    <link rel="stylesheet" href="<?=SITE_URL?>assets/crop-avatar/css/crop-avatar.css">
    <link rel="stylesheet" href="<?=SITE_URL?>css/uploadimage.css">
    <link rel="stylesheet" href="<?=SITE_URL?>css/bootstrap-lightbox.min.css">
    <link href="<?=SITE_URL?>css/profile.css" rel="stylesheet" type="text/css" />
    

    <style>
        a{
            cursor:pointer;
        }
        .tree2 ul {
            list-style: none;
            margin-left:-40px;
        }
        .tree2 li a {
            line-height: 25px;
        }
        .tree2 ul li ul li p{color:Black; font-family:Century Gothic; font-size:13px;}
        .tree2 > ul > li > a {
            color: #027EA2;
            display: block;
            font-weight: normal;
            position: relative;
            text-decoration: none;
            font-family:Century Gothic;
        }
        .tree2 li.parent > a {
            padding: 0 0 0 28px;
        }
        .tree2 li.parent > a:before {
            background-image: url("<?=SITE_URL?>images/plus_minus_icons2.png");
            background-position: 25px center;
            content: "";
            display: block;
            height: 21px;
            left: 0;
            position: absolute;
            top: 2px;
            vertical-align: middle;
            width: 23px;
        }

        .tree2 ul li.active > a:before {
            background-position: 0 center;
        }
        .tree2 ul li ul {
            /*border-left: 1px solid #D9DADB;*/
            display: none;
            margin: 0 0 0 12px;
            overflow: hidden;
            padding: 0 0 0 25px;
        }
        .tree2 ul li ul li {
            position: relative;
        }
        .tree2 ul li ul li:before {
            /*border-bottom: 1px dashed #E2E2E3;*/
            content: "";
            left: -20px;
            position: absolute;
            top: 12px;
            width: 15px;
        }
        #wrapper {
            margin: 0 auto;
            width: 300px;
        }
    </style>

</head>

<body>
<div class='backdiv'>
<div class='backl' style=""></div> 
<div class='backR' style=""></div>
</div>


<div style="" class='main-body-div'>

<div class="main">

    <?php include("includes/header_menu.php"); ?>
<!--    <a href="includes/logout.php">Logout</a>-->
    <div class="main-div">
    <div class="div-prf-body" style="width:1000px; background: #fff;">
        <div class="div-align" id="crop-avatar">
            <div class="div-profile" id="coverimage-div" style=" background-size:cover !important; background:<?php echo $coverimage;?>"><?php //background:url('images/wall-img.png') center;?>
                <div class="profile-image  <?php  if(isset($_SESSION['id'])&& $_SESSION['id']==$row['id']){?> avatar-view" title="Change the Profile<?php }else{ echo '"';} ?> " ><img src="<?=$profile_img;?>"/></div>

              <?php  if(isset($_SESSION['id'])&& $_SESSION['id']==$row['id']){?>
                <!-- Cropping modal -->
                <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:800px;">
                        <div class="modal-content">
                            <form id="uploadfrm" class="avatar-form" method="post" action="<?=SITE_URL?>assets/crop-avatar/crop-avatar.php" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="avatar-modal-label">Change Profile Image</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="avatar-body">

                                        <!-- Upload image and data -->
                                        <div class="avatar-upload">
                                            <input class="avatar-src" name="avatar_src" type="hidden">
                                            <input class="avatar-data" name="avatar_data" type="hidden">
                                            <label for="avatarInput">Local upload</label>
                                            <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                        </div>

                                        <!-- Crop and preview -->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="avatar-wrapper"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="avatar-preview preview-lg"></div>
                                                <div class="avatar-preview preview-md"></div>
                                                <div class="avatar-preview preview-sm"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary avatar-save" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal -->
                <!-- Loading state -->
                <div class="loading" tabindex="-1" role="img" aria-label="Loading"></div>
                <?php }
              ?>
            </div>
            <div class="div-prfname">
                <div class="div-prf-name">
                    <div class="div-name"><?= sentence_cap(" ",$row['f_name']." ".$row['l_name']);?></div>
                    <div class="div-name-center"><i class="fa fa-star clr"></i>&nbsp;<i class="fa fa-star  clr"></i>&nbsp;<i class="fa fa-star  clr"></i>&nbsp;<i class="fa fa-star-half-empty  clr"></i>&nbsp;<i class="fa fa-star-o  clr"></i></div>
                    <div class="div-name-right">
                         <?php

                      $str=' <a  class="prf-follow" id=\'followid\' ';
                          if(isset($_SESSION['id']) && $_SESSION['id']!="" )
                            {

                                $ro=getisfollow('users',$row['id']);
                                if($ro['id']!="")
                                {
                                    $str.=  '   href="javascript:" >Following '; //'  onclick="homefollows(\'0\',\''.$row['id'].'\',\'users\',\'users'.$i.'\')"  ';
                                }else{
                                    $str.= ' href="javascript:"  onclick="homefollows(\'1\',\''.$row['id'].'\',\'users\',\'followid\')">Follow  ';
                                }
                            }else{

                                $str.= 'href="#login" data-toggle="modal">Follow ' ;
                            }
                            $str.='   </a >';
                            if(isset($_SESSION['id']) && $_SESSION['id']!="" && $_SESSION['id'] ==$row['id'] )
                            {
                            $str='<a  class="prf-follow" id="" href="#cover-modal" data-toggle="modal" >Change Cover</a>';
                            //cover image uploader modal
                            ?>
                        <div class="modal fade" id="cover-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="width:400px;">
                            <div class="modal-content">
                                
                                <form enctype="multipart/form-data" name='coverform' role="form" id="coverform" method="post" action="<?=SITE_URL?>includes/ajax/coverimageupload.php">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="avatar-modal-label">Change Cover Image</h4>
                                </div>
                                    <div class="modal-body">
                                        <div class="form-group">
					<input class='file' type="file" class="form-control" name="image" id="images" placeholder="Please choose your image">
					<span class="help-block"></span>
                                        </div>
                                        <div id="loader" style="display: none;">
                                                Please wait image uploading to server....
                                        </div>
                                    </div>
                               <div class="modal-footer">
                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                    <input type="submit" value="Upload" name="image_upload" id="image_upload" class="btn btn-info"/>
                                </div>
				
				
			</form>
                            </div>
                        </div>
                        </div>
                            
                            
                            <?php
                            }
                        echo $str;
                        

                         ?>
<!--                        <div class="prf-follow">Follow</div>-->
                        <div class="prf-follow-edit"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="div-profile-body">
            <div class="div-profile-body-left">
                <ul>
                    <li id="m1" class="" onclick="activeProfile(this);">&nbsp;<i class="fa fa-home nm"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" onclick="showprofileGeneral('<?=$row['id'];?>')" >General</a></li>
                    <li id="m6" class="" onclick="activeProfile(this);">&nbsp;<i class="fa fa-image nm"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" onclick="showprofileImages('<?=$row['id'];?>')" >Images</a></li>
                    <li id="m2" onclick="activeProfile(this);" >&nbsp;<i class="fa fa-thumbs-o-up nm"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" onclick="showProfilelike('<?=$row['id'];?>','1')">  Likes (<?=getalllikeUserID($row['id'])?>)</a></li>
                    <li id="m3" onclick="activeProfile(this);">&nbsp;<i class="fa fa-heart nm"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" onclick="showfavouritelike('<?=$row['id'];?>','1')"> Favourites(<?=getallfavouriteUserID($row['id'])?>)</a></li>
                    <li id="m4" onclick="activeProfile(this);">&nbsp;<i class="fa fa-location-arrow nm"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" onclick="showProfileFollow('<?=$row['id'];?>','1')"> Following</a></li>
                    <li id="m5" onclick="activeProfile(this);">&nbsp;<i class="fa fa-eye nm"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" onclick="showProfileViewes('<?=$row['id'];?>','1')">Viewed (<?=getallviewesUserID($row['id'])?>)</a></li>
                </ul>
            </div>

            <div class="div-profile-body-right" id="disp">






                <input type="hidden" id="counter" value="26">



            <?php
            $per_page=25;
            $start=0;
            if(isset($_GET['start']))
            {
                $start=$_GET['start'];
            }



            $sqlfollow="SELECT id,created FROM `follows` where  status='1' And user_id='".$id."' order By id desc  LIMIT ".$start." , ". $per_page ;
            $sqlrecommend="SELECT id,created FROM `recommend` where  status='1' And user_id='".$id."' order By id desc LIMIT ".$start." , ". $per_page ;
            $sqlusers_post="SELECT id,created FROM `users_post` where  status='1' And userid='".$id."' order By id desc  LIMIT ".$start." , ". $per_page ;

         //   $sqlcomment="SELECT * FROM `comment` where  status='1' And comment_by_id='".$id."' order By id desc  LIMIT ".$start." , ". $per_page ;





            $displayArr=array();
            $i=0;
                //$sqlfollow
                $result = mysql_query($sqlfollow);
                while($row=mysql_fetch_array($result))
                {
                     $tim=  strtotime($row['created']);
                    $displayArr[$tim]['type']='follow';
                    $data=getfollowbox($i,$row['id']);
                   $displayArr[$tim]['data']=$data;
                    $i++;

                }

                //$sqlrecommend
//
                $result = mysql_query($sqlrecommend);
                while ($row = mysql_fetch_array($result)) {
                        $tim=  strtotime($row['created']);
                    $displayArr[$tim]['type'] = 'recommend';
                    $data = getRecommendbox($i, $row['id']);
                    $displayArr[$tim]['data'] = $data;
                    $displayArr[$tim]['dt'] = $row['created'];
                    $i++;
                }


               // $sqlusers_post
                $result = mysql_query($sqlusers_post);

                while ($row = mysql_fetch_array($result)) {
                    $tim=  strtotime($row['created']);
                    $displayArr[$tim]['type'] = 'users_post';

                    $data = getUsers_postbox($i, $row['id']);

                    $displayArr[$tim]['data'] = $data;
                     $displayArr[$tim]['dt'] = $row['created'];

                    $i++;
                }


           // $sqlcomment
//            $result = mysql_query($sqlcomment);
//            while($row=mysql_fetch_array($result))
//            {
//                $displayArr[$i]['type']='users_post';
//                $data=getcommentbox($i,$row['id']);
//                $displayArr[$i]['data']=$data;
//                $i++;
//
//            }






            //            foreach($displayArr as $data)
            //            {
            //                echo $data['data'];
            //            }

            $count = count($displayArr);
           /* $randarr=array();
            for ($i = 0; $i <= $count; $i++) {
                $x = rand(0, $count);

                if(in_array($x, $randarr))
                {
                    continue;
                }else{$randarr[$i]=$x;

                    if($x<$count)
                    {
                    echo $displayArr[$x]['data'];
                    }
                }

            }*/
            krsort($displayArr);
//printarray(  $displayArr );
//echo '<pre>';
foreach ($displayArr as $i => $row)
{
    //printarray($row);
    echo $row['data'];
}
intbm();
if($count>"30"){
    echo ' <input type="button"  id="morebtn" class="btn btn-info" onclick="showProfilemore(0,'.$id.')" style="width: 100%;" value="View More">';
}
            ?>





            </div>
        </div>
    </div>
    </div>
</div>

</div>


<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
<?php include('includes/mainjs.php');?>

<script src="<?=SITE_URL?>assets/crop-avatar/js/cropper.min.js"></script>
<script src="<?=SITE_URL?>assets/crop-avatar/js/crop-avatar.js"></script>
<script src="<?=SITE_URL?>js/jquery.form.min.js"></script>
<script src="<?=SITE_URL?>js/ajaximageupload.js"></script>
<script src="<?=SITE_URL?>js/profieimage.js"></script>
<script src="<?=SITE_URL?>js/bootstrap-lightbox.min.js"></script>


</body>
</html>

                            