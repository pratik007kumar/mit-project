<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");

if(isset($_POST['update']))
{
    $dataArr=array();
    $dataArr=$_POST;
$msg="";
    if(symptomsUpdate($dataArr))
    { $msg=("Update Successfully !!"); }
    else
    {$msg= "Unable to Update Try Again !!";}
    $_SESSION['msgSuccess']=$msg;
    echo"<script>location.href='../symptoms.php';</script>";

}else{
$row=getSymptomsById($_POST['did']);
?>

<div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="control-group ">
                                <div class="controls">
                                    <input type="hidden" name="id" value="<?=$row['id'];?>">
                                    <input type="hidden" name="update" value="<?=$row['id'];?>">
                                    <input name="name"  class="form-control" id="name" value="<?= $row['name'];?>" type="text" placeholder="Symptoms Name"   required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="control-group ">
                                <div class="controls">
                                    <select  class="form-control" name="category" id="category" required>
                                        <?php echo getAllCategory('symptoms',$row['category']);?>
</select>

</div>
</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
    <div class="control-group ">
        <div class="controls">
<!--            <script type="text/javascript" src="--><?php //echo SITE_URL;?><!--admin/ck/ckeditor/ckeditor.js"></script>-->
            <textarea id="ueditor1" name="description" rows="5" cols="80"><?= $row['description'];?> </textarea>
            <script type="text/javascript">

                // This is a check for the CKEditor class. If not defined, the paths must be checked.
                if ( typeof CKEDITOR == 'undefined' )
                {
                    document.write(
                        '<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
                            'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
                            'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
                            'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
                            'value (line 32).' ) ;
                }
                else
                {
                    var editor = CKEDITOR.replace( 'ueditor1' );
                }

            </script>
        </div>
    </div>
</div>

</div>
<?php } ?>