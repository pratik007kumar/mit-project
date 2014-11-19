<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/12/14
 * Time: 4:32 PM
 */
if(isset($_POST['update']))
{
    $dataArr=array();

    //$dataArr=$_POST;
    //echo "<pre>";
    $dataArr['id']=$_POST['uid'];
    $dataArr['name']=$_POST['uname'];
    $dataArr['category']=$_POST['ucategory'];
    $dataArr['details']=$_POST['details']!=""?"<pre>".$_POST['details']."</pre>":"";
    $datarow=getStructreById($dataArr['id']);
    $imgprefix=time();
    if($_FILES['uimage']['name']!="")
    {
        $tmpImageName  = $_FILES['uimage']['tmp_name'];
        img_resize( $tmpImageName , 1024 , "../../uploades/structures/images/" , $imgprefix.".jpg");
       // echo SITE_URL."uploades/structures/images/".$datarow['images'];
        if(file_exists(SITE_URL."uploades/structures/images/".$datarow['images']))
        {
        unlink(SITE_URL."uploades/structures/images/".$datarow['images']);
        }
        $dataArr['images']=$imgprefix.".jpg";

    }else{
        $dataArr['images']=$datarow['images'];
    }
    if($_FILES['uicon']['name']!="")
    {
        $tmpIconName  = $_FILES['uicon']['tmp_name'];
       // img_resize( $tmpIconName , 50 , "../../uploades/structures/icon/" , $imgprefix.".png");
        $imgprefix.=$_FILES['uicon']['name'];

        move_uploaded_file($tmpIconName, "../../uploades/structures/icon/" . $imgprefix);



        $img = "../../uploades/structures/icon/" . $imgprefix; // File image location
        $newfilename ="../../uploades/structures/icon/" . $imgprefix; // New file name for thumb
        $w = 50;
        $h =50;

        $thumbnail = resize($img, $w, $h, $newfilename);

       // echo "<img src='".$thumbnail."'>";
      //  resize(25,"../../uploades/structures/icon/" . $imgprefix,"../../uploades/structures/icon/" . $imgprefix);

        if(file_exists(SITE_URL."uploades/structures/icon/".$datarow['icon']))
        {
        unlink( SITE_URL."uploades/structures/icon/".$datarow['icon']);
        }
        $dataArr['icon']=$imgprefix;//$imgprefix;//.".png";
    }
    else{
        $dataArr['icon']=$datarow['icon'];
    }
   // echo '<img src="'.$newfilename.'">';


    if(structreUpdate($dataArr))

    { echo("Update Successfully !!");
    echo "<script> location.href='../structure.php';</script>";
    }
   else
    {echo "Unable to Update Try Again !!";}


}else{
$details=getStructreById($_POST['id']);
?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="control-group ">
                                <div class="controls">
                                    <label>Category</label>
                                    <select name="ucategory" id="ucategory"   class="form-control" required>
                                        <option value="">Select Category </option>
                                        <?php
                                        foreach($ARR_STRUCTURE_CATEGORY as $cat)
                                        {
                                            echo "<option value='".$cat."' ";
                                            if($details['category']==$cat){ echo ' selected ';}
                                           echo ">".$cat.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="control-group ">
                                    <div class="controls">
                                        <label>Title</label>
                                        <input type="hidden" id="uid" name="uid" value="<?=$details['id'];?>">
                                        <input name="uname"  value="<?=$details['name'];?>" class="form-control" id="uname" type="text" placeholder="Store Name"   required>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                 <div class="control-group ">
                                     <div class="controls">
                                         <label>Icon Image</label><br>
                                         <img src="../uploades/structures/icon/<?=$details['icon'];?>" style='width:30;' class="img-thumbnail">
                                         <input type="file" name="uicon" id="uicon"   class="btn btn-block"  onchange="checkImageFile(this)" style="margin: 5px 0px; "    value="" >
                                     </div>
                                 </div>

                                <label>Image</label>
                                 <img src="../uploades/structures/images/<?=$details['images'];?>" class="img-thumbnail">
                                  <input type="file" name="uimage" id="uimage"   class="btn btn-block"  onchange="checkImageFile(this)" style="margin: 5px 0px; "    value="" >
                             </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="control-group ">
                                <div class="controls">
                                    <label>Description</label>
                                    <textarea name="details" id="details" class="form-control" rows="18"><?=substr($details['details'],5,strlen($details['details'])-11);?></textarea>
                                </div>
                            </div>
                        </div>


                                        </div>
<?php } ?>