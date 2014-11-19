<?php //error_reporting(0);
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
?>
<div>
                            <?php   
                            $userArr=getUserById($_SESSION['id']);?>
                            <h2 class="page-heading">Privacy & Setting</h2>
                            <div class="content">
                                
                                <div class="col-lg-12" style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-lg-6"><label> Email</lable> </div>
                                        <div class="col-lg-3 " id="se">
                                        <?php
                                            if($userArr['showemail'])
                                            {
                                                echo '<button class="btn btn-success" onclick="settingChang(\'e\',this,\'0\')">Show</button>';
                                            }
                                            else {
                                               
                                                echo '<button class="btn btn-default" onclick="settingChang(\'e\',this,\'1\')">Hide</button>';
                                                
                                            
                                            }
                                        ?>
                                        </div >
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-lg-6"><label> Mobile No </lable> </div>
                                        <div class="col-lg-3" id="sm">
                                            <?php
                                            if($userArr['showmobile'])
                                             {
                                               
                                                 echo '<button class="btn btn-success" onclick="settingChang(\'m\',this,\'0\')">Show</button>';     
                                            }
                                            else {
                                           
                                           echo '<button class="btn btn-default" onclick="settingChang(\'m\',this,\'1\')">Hide</button>';     
                                            }
                                        ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                                </div>
                            </div>
                            <h2 class="page-heading" style="padding-top:20px; "> Change Password</h2>
                            <div class="content">
                                
                                <div class="col-lg-12" style="padding: 10px;">
                                    
                                    <form method="post" onsubmit="return " id="frm">
             
            
                                <div class="row">
                                    <div class="control-group col-lg-12 " >
                                        <label for="current_password" class="control-label">Current Password</label>
                                        <div class="controls ">
                                            <input name="current_password" id="current_password" type="password" class="form-control" required="required">
                                        </div>
                                    </div>
                                    <div class="control-group col-lg-12 ">
                                        <label for="new_password" class="control-label">New Password</label>
                                        <div class="controls">
                                            <input name="new_password" id="new_password" type="password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="control-group col-lg-12 ">
                                        <label for="confirm_password" class="control-label">Confirm Password</label>
                                        <div class="controls">
                                            <input name="confirm_password" id="confirm_password" type="password" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12">

                                    <button type="submit"  class="btn btn-primary pull-right" onclick="changepassword(this);" >Change Password</button>
                                </div>
                                </form>
                                
                                    
                                
                        </div>                     