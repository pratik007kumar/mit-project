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

    if(storeUpdate($dataArr))
    { echo("Update Successfully !!"); }
    else
    {echo "Unable to Update Try Again !!";}


}else{
$storeDetails=getStoreById($_POST['id']);
?>
                    <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="control-group ">
                                    <div class="controls">
                                        <label>Store Name</label>
                                        <input type="hidden" id="uid" value="<?=$storeDetails['id'];?>">
                                        <input name="uname"  value="<?=$storeDetails['name'];?>" class="form-control" id="uname" type="text" placeholder="Store Name"   required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="control-group ">
                                    <div class="controls">
                                        <label>Category</label>
                                        <select  class="form-control" name="ucategory" id="ucategory" required>
                                            <?php echo getAllCategory('store',$storeDetails['category']);?>
                                        </select>

                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="control-group ">
                                                <div class="controls">
                                                    <label>Address</label>
                                                    <input name="uaddress" value="<?=$storeDetails['address'];?>" class="form-control" id="uaddress" type="text" placeholder="Address"  >
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label>State</label>
                                                    <select  class="form-control" name="ustate" id="ustate" onchange="getcity(this,'ucity')">
                                                        <?php echo getAllState($storeDetails['state']);?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="control-group ">
                                                <div class="controls">
                                                    <label>City</label>
                                                    <select  class="form-control" name="ucity" id="ucity" required="required">
                                                        <?php
                                                        echo getAllCityById($storeDetails['city'] ,$storeDetails['state']);
                                                        ?>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label>Pin Code</label>
                                                    <input name="upin"  value="<?=$storeDetails['pin'];?>" class="form-control" id="upin" type="text" placeholder="Pin Code"  maxlength="10"  required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label>Phone No</label>
                                                    <input name="uphno" value="<?=$storeDetails['phno'];?>"  class="form-control" id="uphno" type="text" maxlength="10"   placeholder="Phone No"   required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label>Website</label>
                                                    <input name="website"  class="form-control" id="uwebsite" type="text"   value="<?=$storeDetails['website'];?>"     placeholder="Website" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label>Stars</label>
                                                    <input name="urating" value="<?=$storeDetails['rating'];?>"  class="form-control" id="urating" type="text" maxlength="10"   placeholder="Phone No"   required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="control-group">

                                                    <label>Like</label>

                                                <div class="controls">

                                                    <input name="ulike" value="<?=$storeDetails['like'];?>"  class="form-control" id="ulike" type="text" maxlength="10"   placeholder="Phone No"   required>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
<?php } ?>