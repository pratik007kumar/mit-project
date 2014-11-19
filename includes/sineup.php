<?php
//if(session_id()==null || session_id()==""){session_start();}
//require("../config/config.php");
//include("../admin/includes/phpfunction.php");
//?>
<!-- Modal -->
<div class="rows">
<div class="col-xs-12">
<div class="modal fade" id="EditBasicInfo" tabindex="-1">
<div class="modal-dialog lx">
<div class="modal-content">
<div class="modal-header">
    <button class="close" data-dismiss="modal" type="button">×</button>
    <h4 class="modal-title" id="myModalLabel">Registration Form</h4>
</div>
<div class="modal-body">
<div id="content" style="height:585px;">
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
    <li class="active"><a href="#red" data-toggle="tab">New User</a></li>
    <li><a href="#orange" data-toggle="tab">Doctor</a></li>
    <li><a href="#yellow" data-toggle="tab">Student</a></li>
    <li><a href="#green" data-toggle="tab">Company</a></li>
    <li><a href="#blue" data-toggle="tab">Product</a></li>
</ul>
<div id="my-tab-content" class="tab-content cnt">
<div class="tab-pane active" id="red">
    <form method="post" action="index.php">
        <div class="inner">
            <div class="bgstyle2">
                <div class="bginnerbody">
                    First Name
                </div>
                <div class="bginnerbody2">
                    <input name="f_name" id="f_name" required type="text" class="textbox2" placeholder="First Name"  />
                </div>
            </div>
            <div class="bgstyle">
                <div class="bginnerbody">
                    Last Name
                </div>
                <div class="bginnerbody2">
                    <input name="l_name" id="l_name"  type="text" class="textbox2" placeholder="Last Name" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Email
                </div>
                <div class="bginnerbody2">
                    <input name="email" id="email" required type="email" class="textbox2" placeholder="Email" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Mobile
                </div>
                <div class="bginnerbody2">
                    <input name="mobile" id="mobile" type="text" class="textbox2" placeholder="Mobile" onkeypress="return num_validate(event)" maxlength="11" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Password
                </div>
                <div class="bginnerbody2">
                    <input name="password" id="password" required type="password" class="textbox2" placeholder="Password" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Confirm Password
                </div>
                <div class="bginnerbody2">
                    <input name="conf_password" id="conf_password" required type="password" onblur="checkpass('password','conf_password')" class="textbox2" placeholder="Confirm Password" />
                </div>
            </div>



            <div class="bgstyle">
                <div class="bginnerbody">
                    Date Of  Birth
                </div>
                <div class="bginnerbody2">
                    <!--<input name="txt_user_dob"  class="textbox2" placeholder="DOB" id="txtDate" />-->
                    <input type="text" name="dob"  required data-date-format="dd-mm-yyyy" class=" textbox2 dt" placeholder="dd-mm-yyyy" id="txtDate">
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Gender
                </div>
                <div class="bginnerbody2">
                    <p>
                        <input type="radio" name="gender"  value="Male" id="RadioGroup1_0" />
                        Male
                        <input type="radio" name="gender" value="Female" id="RadioGroup1_1" />
                        Female
                        <br />
                    </p>
                </div>
            </div>



            <div class="bgstyle">
                <div class="bginnerbody">
                    Location
                </div>
                <div class="bginnerbody2">
                    <select name="state" required onchange="getcity(this,'city')" id="state" class="textbox2">
                        <?php echo getAllState(); ?>
                    </select>

                    <select name="city" id="city" required class="textbox2">

                    </select>
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Height (cm)
                </div>
                <div class="bginnerbody2">
                    <input name="height" id="height" type="text" class="textbox2" placeholder="Height" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Weight
                </div>
                <div class="bginnerbody2">
                    <input name="weight" name="weight" type="text" class="textbox2" placeholder="Weight" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Blood Group
                </div>
                <div class="bginnerbody2">
                    <select name="blood_group" class="textbox2">
                        <?php
                        $gp="";
                        $str="<option value=''>Select Blood Group </option>";
                        foreach($ARR_BLOODGROUP as $bl)
                        {
                            $str.="<option value='".$bl."' ";
                            if($gp==$bl)
                            {
                                $str.= " selected ";
                            }

                            $str.=">".$bl."</option>";
                        }
                        echo $str;
                        //echo getBloodGroup();
                        ?>
                    </select>
                </div>
            </div>


            <div class="modal-footer">
                <input type="hidden" name="user_type" id="user_type" value="1">
                <button class="btn btn-success"  type="submit" name="submit">Register</button>
            </div>
        </div>
    </form>
</div>


<div class="tab-pane" id="orange">
<div class="inner" >
<form method="post" action="index.php">
<div class="bgstyle2">
    <div class="bginnerbody">
        Name
    </div>
    <div class="bginnerbody2">
        <input name="f_name" id="f_name" required type="text" class="textbox2" placeholder="Name"  />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Email
    </div>
    <div class="bginnerbody2">
        <input name="email" id="email" required type="email" class="textbox2" placeholder="Email" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Password
    </div>
    <div class="bginnerbody2">
        <input name="password" id="dpassword" required type="password" class="textbox2" placeholder="Password" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Confirm Password
    </div>
    <div class="bginnerbody2">
        <input name="conf_password" id="dconf_password" required type="password" onblur="checkpass('dpassword','dconf_password')" class="textbox2" placeholder="Confirm Password" />
    </div>
</div>




<div class="bgstyle">
    <div class="bginnerbody">
        DOB
    </div>
    <div class="bginnerbody2">
        <input type="text" name="dob"  required data-date-format="dd-mm-yyyy" class="dt textbox2" placeholder="dd-mm-yyyy" id="txtDate">
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Gender
    </div>
    <div class="bginnerbody2">
        <p>

            <input type="radio" name="gender"  value="Male" id="RadioGroup1_0" />
            Male
            <input type="radio" name="gender" value="Female" id="RadioGroup1_1" />
            Female
            <br />
        </p>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Address
    </div>
    <div class="bginnerbody">
        <input name="address1" type="text" class="textbox2" placeholder="Address" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Location
    </div>
    <div class="bginnerbody2">
        <select name="state" required onchange="getcity(this,'dcity')" id="state" class="textbox2">
            <?php echo getAllState(); ?>
        </select>

        <select name="city" id="dcity" required class="textbox2">

        </select>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Height (cm)
    </div>
    <div class="bginnerbody2">
        <input name="height" id="height" type="text" class="textbox2" placeholder="Height" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Weight
    </div>
    <div class="bginnerbody2">
        <input name="weight" name="weight" type="text" class="textbox2" placeholder="Weight" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Blood Group
    </div>
    <div class="bginnerbody2">
        <select name="blood_group" class="textbox2">
            <?php
            $gp="";
            $str="<option value=''>Select Blood Group </option>";
            foreach($ARR_BLOODGROUP as $bl)
            {
                $str.="<option value='".$bl."' ";
                if($gp==$bl)
                {
                    $str.= " selected ";
                }

                $str.=">".$bl."</option>";
            }
            echo $str;
            //echo getBloodGroup();
            ?>
        </select>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Specialization
    </div>
    <div class="bginnerbody2">
        <select name="specialization" class="textbox2" id="ddl_spcl" onchange='onOther(this,"spcother");'>


            <?php
            $sp="";
            $str="<option value=''>Select Specialization </option>";
            $i=0;
            foreach($ARR_Specialization as $spc)
            {
                $str.="<option value='".$spc."' ";
                if($sp==$spc)
                {

                    $str.= " selected ";
                    $i++;
                }

                $str.=">".$spc."</option>";
            }
            $str.="<option value='o' >Other</option>";

            if($sp!="" && $i==0)
            {
                $str.="<option value='".$sp."' selected >".$sp."</option>";
            }

            echo $str;
            ?>

        </select>

        <input type="text" id="spcother" name="spcother" class="textbox2" style="display:none; width: 180px !important; float: right;  "/>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Qualification/Certification
    </div>
    <div class="bginnerbody2">
        <select name="qualification" class="textbox2"  onchange='javascript:onOther(this,"quaother");'>
            <?php
            $qu="";
            $str="<option value=''>Select Qualification </option>";
            $i=0;
            foreach($Arr_Qualification as $qua)
            {
                $str.="<option value='".$qua."' ";
                if($qu==$qua)
                {

                    $str.= " selected ";
                    $i++;
                }

                $str.=">".$qua."</option>";
            }
            $str.="<option value='o' >Other</option>";

            if($qu!="" && $i==0)
            {
                $str.="<option value='".$qu."' selected >".$qu."</option>";
            }

            echo $str;
            ?>

        </select>
        <input type="text" id="quaother" name="quaother" class="textbox2" style="display:none; width:180px !important; float: right; "/>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Experience/Service Information
    </div>
    <div class="bginnerbody2">
        <input name="experience" type="text" class="textbox2" placeholder="Experience/Service Information" />
    </div>
</div>

<div class="modal-footer">
    <input type="hidden" name="user_type" id="user_type" value="2">
    <button class="btn btn-success" name="submit"  type="submit">Register</button>
</div>
</form>
</div>

</div>



<div class="tab-pane" id="yellow">

<!--Medical Student -->
<div class="inner" >
<form method="post" action="index.php">
<div class="bgstyle2">
    <div class="bginnerbody">
        Name
    </div>
    <div class="bginnerbody2">
        <input name="f_name" id="f_name" required type="text" class="textbox2" placeholder="Name"  />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Email
    </div>
    <div class="bginnerbody2">
        <input name="email" id="email" required type="email" class="textbox2" placeholder="Email" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Password
    </div>
    <div class="bginnerbody2">
        <input name="password" id="spassword" required type="password" class="textbox2" placeholder="Password" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Confirm Password
    </div>
    <div class="bginnerbody2">
        <input name="conf_password" id="sconf_password" required type="password" onblur="checkpass('spassword','sconf_password')" class="textbox2" placeholder="Confirm Password" />
    </div>
</div>




<div class="bgstyle">
    <div class="bginnerbody">
        DOB
    </div>
    <div class="bginnerbody2">
        <input type="text" name="dob"  required data-date-format="dd-mm-yyyy" class="dt textbox2" placeholder="dd-mm-yyyy" id="txtDate">
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Gender
    </div>
    <div class="bginnerbody2">
        <p>

            <input type="radio" name="gender"  value="Male" id="RadioGroup1_0" />
            Male
            <input type="radio" name="gender" value="Female" id="RadioGroup1_1" />
            Female
            <br />
        </p>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Address
    </div>
    <div class="bginnerbody">
        <input name="address1" type="text" class="textbox2" placeholder="Address" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Location
    </div>
    <div class="bginnerbody2">
        <select name="state" required onchange="getcity(this,'scity')" id="state" class="textbox2">
            <?php echo getAllState(); ?>
        </select>

        <select name="city" id="scity" required class="textbox2">

        </select>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Height (cm)
    </div>
    <div class="bginnerbody2">
        <input name="height" id="height" type="text" class="textbox2" placeholder="Height" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Weight
    </div>
    <div class="bginnerbody2">
        <input name="weight" name="weight" type="text" class="textbox2" placeholder="Weight" />
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Blood Group
    </div>
    <div class="bginnerbody2">
        <select name="blood_group" class="textbox2">
            <?php
            $gp="";
            $str="<option value=''>Select Blood Group </option>";
            foreach($ARR_BLOODGROUP as $bl)
            {
                $str.="<option value='".$bl."' ";
                if($gp==$bl)
                {
                    $str.= " selected ";
                }

                $str.=">".$bl."</option>";
            }
            echo $str;
            //echo getBloodGroup();
            ?>
        </select>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Specialization
    </div>
    <div class="bginnerbody2">
        <select name="specialization" class="textbox2" id="ddl_spcl" onchange='onOther(this,"sspcother");'>


            <?php
            $sp="";
            $str="<option value=''>Select Specialization </option>";
            $i=0;
            foreach($ARR_Specialization as $spc)
            {
                $str.="<option value='".$spc."' ";
                if($sp==$spc)
                {

                    $str.= " selected ";
                    $i++;
                }

                $str.=">".$spc."</option>";
            }
            $str.="<option value='o' >Other</option>";

            if($sp!="" && $i==0)
            {
                $str.="<option value='".$sp."' selected >".$sp."</option>";
            }

            echo $str;
            ?>

        </select>

        <input type="text" id="sspcother" name="spcother" class="textbox2" style="display:none; width: 180px !important; float: right;  "/>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Qualification/Certification
    </div>
    <div class="bginnerbody2">
        <select name="qualification" class="textbox2"  onchange='javascript:onOther(this,"squaother");'>
            <?php
            $qu="";
            $str="<option value=''>Select Qualification </option>";
            $i=0;
            foreach($Arr_Qualification as $qua)
            {
                $str.="<option value='".$qua."' ";
                if($qu==$qua)
                {

                    $str.= " selected ";
                    $i++;
                }

                $str.=">".$qua."</option>";
            }
            $str.="<option value='o' >Other</option>";

            if($qu!="" && $i==0)
            {
                $str.="<option value='".$qu."' selected >".$qu."</option>";
            }

            echo $str;
            ?>

        </select>
        <input type="text" id="squaother" name="quaother" class="textbox2" style="display:none; width:180px !important; float: right; "/>
    </div>
</div>

<div class="bgstyle">
    <div class="bginnerbody">
        Experience/Service Information
    </div>
    <div class="bginnerbody2">
        <input name="experience" type="text" class="textbox2" placeholder="Experience/Service Information" />
    </div>
</div>

<div class="modal-footer">
    <input type="hidden" name="user_type" id="user_type" value="3">
    <button class="btn btn-success" name="submit"  type="submit">Register</button>
</div>
</form>
</div>

<!--End Medical Student -->
</div>



<div class="tab-pane" id="green">
    <form method="post" action="index.php">
        <div class="inner">
            <div class="bgstyle2">
                <div class="bginnerbody">
                    Company Name
                </div>
                <div class="bginnerbody2">
                    <input name="f_name" type="text" class="textbox2" placeholder="Company Name" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Email
                </div>
                <div class="bginnerbody2">
                    <input name="email" id="email" required type="email" class="textbox2" placeholder="Email" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Password
                </div>
                <div class="bginnerbody2">
                    <input name="password" id="Cpassword" required type="password" class="textbox2" placeholder="Password" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Confirm Password
                </div>
                <div class="bginnerbody2">
                    <input name="conf_password" id="Cconf_password" required type="password" onblur="checkpass('Cpassword','Cconf_password')" class="textbox2" placeholder="Confirm Password" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Address 1
                </div>
                <div class="bginnerbody2">
                    <textarea name="address1" cols="40" rows="4" class="textarea"></textarea>
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Address 2
                </div>
                <div class="bginnerbody2">
                    <textarea name="address2" cols="40" rows="4" class="textarea"></textarea>
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    State
                </div>
                <div class="bginnerbody2">
                    <select name="state" required onchange="getcity(this,'Ccity')" id="state" class="textbox2">
                        <?php echo getAllState(); ?>
                    </select>


                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    City
                </div>
                <div class="bginnerbody2">
                    <select name="city" id="Ccity" required class="textbox2">

                    </select>
                </div>
            </div>


            <div class="bgstyle">
                <div class="bginnerbody">
                    Zip
                </div>
                <div class="bginnerbody2">
                    <input name="zip" type="text" class="textbox2" placeholder="Zip" onkeypress="return num_validate(event)" maxlength="6" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Phone
                </div>
                <div class="bginnerbody2">
                    <input name="phone_no" type="text" class="textbox2" placeholder="Phone" onkeypress="return num_validate(event)" maxlength="11" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Fax
                </div>
                <div class="bginnerbody2">
                    <input name="fax_no" type="text" class="textbox2" placeholder="Fax" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Website
                </div>
                <div class="bginnerbody2">
                    <input name="website" type="text" class="textbox2" placeholder="Website" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Registration No.
                </div>
                <div class="bginnerbody2">
                    <input name="registration_no" type="text" class="textbox2" placeholder="Registration No" />
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="user_type" id="user_type" value="4">
                <button class="btn btn-success" name="submit"  type="submit">Register</button>
            </div>
        </div>

    </form>
</div>
<div class="tab-pane" id="blue">
    <form method="post" action="index.php">
        <div class="inner">
            <div class="bgstyle2">
                <div class="bginnerbody">
                    Product Name
                </div>
                <div class="bginnerbody2">
                    <input name="f_name" type="text" class="textbox2" placeholder="Product Name" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Email
                </div>
                <div class="bginnerbody2">
                    <input name="email" id="email" required type="email" class="textbox2" placeholder="Email" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Password
                </div>
                <div class="bginnerbody2">
                    <input name="password" id="Ppassword" required type="password" class="textbox2" placeholder="Password" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Confirm Password
                </div>
                <div class="bginnerbody2">
                    <input name="conf_password" id="Pconf_password" required type="password" onblur="checkpass('Ppassword','Pconf_password')" class="textbox2" placeholder="Confirm Password" />
                </div>
            </div>


            <div class="bgstyle">
                <div class="bginnerbody">
                    Department
                </div>
                <div class="bginnerbody2">
                    <select name="department" class="textbox2">

                        <?php
                        $qu="";
                        $str="<option value=''>Select Department </option>";
                        $i=0;
                        foreach($ARR_Department as $qua)
                        {
                            $str.="<option value='".$qua."' ";
                            if($qu==$qua)
                            {

                                $str.= " selected ";
                                $i++;
                            }

                            $str.=">".$qua."</option>";
                        }
                        $str.="<option value='o' >Other</option>";

                        if($qu!="" && $i==0)
                        {
                            $str.="<option value='".$qu."' selected >".$qu."</option>";
                        }

                        echo $str;
                        ?>

                    </select>
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Indications
                </div>
                <div class="bginnerbody2">
                    <input name="indications" type="text" class="textbox2" placeholder="Indications" />
                </div>
            </div>


            <div class="bgstyle">
                <div class="bginnerbody">
                    Color
                </div>
                <div class="bginnerbody2">
                    <input name="color" type="text" class="textbox2" placeholder="Color" />
                </div>
            </div>

            <div class="bgstyle">
                <div class="bginnerbody">
                    Strength(s)
                </div>
                <div class="bginnerbody2">
                    <input name="strength" type="text" class="textbox2" placeholder="(e.g: 100 mg/ml)" />
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="user_type" id="user_type" value="5">
                <button class="btn btn-success" name="submit"  type="submit">Register</button>
            </div>
        </div>
    </form>
</div>
</div>

</div>
</div>

</div>
</div>
</div>
</div>
</div>