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

    if(clinicsUpdate($dataArr))
    { echo("Update Successfully !!"); }
    else
    {echo "Unable to Update Try Again !!";}


}else{
    $row=getClinicsById($_POST['did']);
    ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <label>Clinic/Hospitals Name</label>
                    <input type="hidden" name="id" id="id" value="<?=$row['id'];?>">
                    <input type="hidden" name="update" id="update" value="1">
                    <input name="name"  value="<?=$row['name'];?>" class="form-control" id="name" type="text" placeholder="Clinic/Hospitals Name"   required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <label>Category</label>
                    <select  class="form-control" name="category" id="category" required>
                        <?php echo getAllCategory('clinics',$row['category']);?>
                    </select>

                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <label>Address</label>
                    <input name="address" value="<?=$row['address'];?>" class="form-control" id="address" type="text" placeholder="Address"  >
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group">
                <div class="controls">
                    <label>State</label>
                    <select  class="form-control" name="state" id="state" onchange="getcity(this,'ucity')">
                        <?php echo getAllState($row['state']);?>
                    </select>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <label>City</label>
                    <select  class="form-control" name="city" id="ucity" required="required">
                        <?php
                        echo getAllCityById($row['city'] ,$row['state']);
                        ?>

                    </select>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group">
                <div class="controls">
                    <label>Pin Code</label>
                    <input name="pin"  value="<?=$row['pin'];?>" class="form-control" id="pin" type="text" placeholder="Pin Code"  maxlength="10"  required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group">
                <div class="controls">
                    <label>Phone No</label>
                    <input name="phno" value="<?=$row['phno'];?>"  class="form-control" id="phno" type="text" maxlength="15"   placeholder="Phone No"   required>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="control-group">
                <div class="controls">
                    <label>Website</label>
                    <input name="website"  class="form-control" id="website" type="text"   value="<?=$row['website'];?>"     placeholder="Website" >
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group">
                <div class="controls">
                    <label>Stars</label>
                    <input name="stars" value="<?=$row['stars'];?>"  class="form-control" id="stars" type="text" maxlength="10"   placeholder="Phone No"   required>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group">

                <label>Like</label>

                <div class="controls">

                    <input name="like" value="<?=$row['like'];?>"  class="form-control" id="like" type="text" maxlength="10"   placeholder="Phone No"   required>
                </div>
            </div>
        </div>
    </div>
<?php } ?>