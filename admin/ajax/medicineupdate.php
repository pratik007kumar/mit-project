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
    $dataArr=$_POST;
   // $dataArr['description']=$_POST['description']!=""? "<pre>".$_POST['description']."</pre>":"";
    if(medicineUpdate($dataArr))
    { echo("Update Successfully !!"); }
    else
    {echo "Unable to Update Try Again !!";}


}elseif(isset($_POST['did'])){
   $row=getMedicineById($_POST['did']);
    ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <input type="hidden" id="id" name="id" value="<?=$row['id'];?>">
                    <input type="hidden" id="update" name="update" value="<?=$row['id'];?>">

                    <input name="name" value="<?=$row['name'];?>"  class="form-control" id="name" type="text" placeholder="Medicine Name"   required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <select  class="form-control" name="category" id="category" required>
                        <?php echo getAllCategory('medicine',$row['category']);?>
                    </select>

                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <input name="company" class="form-control" value="<?=$row['company'];?>" id="company" type="text" placeholder="Company"  >
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <textarea name="description" id="description" class="form-control" placeholder="Description"><?= $row['description'];?></textarea>

                </div>
            </div>
        </div>

    </div>
<?php }
?>