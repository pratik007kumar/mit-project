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
$msg="";
    if(firstaidsUpdate($dataArr))
    { $msg= "Update Successfully !!"; }
    else
    {$msg= "Unable to Update Try Again !!";}
    $_SESSION['msgSuccess']=$msg;
echo"<script>location.href='../firstaids.php';</script>";
echo "Connecting to database..";
}
else
{
    $row=getfirstaidsById($_POST['did']);
    ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <label>First Aids Name</label>
                    <input type="hidden" name="id" id="id" value="<?=$row['id'];?>">
                    <input type="hidden" name="update" id="update" value="1">
                    <input name="name"  value="<?=$row['name'];?>" class="form-control" id="name" type="text" placeholder="First Aids Name"   required>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="control-group ">
                <div class="controls">
                    <label>Causes</label>
                    <textarea name="causes" id="causes1" class="form-control"><?=$row['causes'];?></textarea>
                    <script type="text/javascript">

                                        // This is a check for the CKEditor class. If not defined, the paths must be checked.
                                        if ( typeof CKEDITOR == 'undefined' )
                                        {
                                            document.write('' ) ;
                                        }
                                        else
                                        {
                                            var editor = CKEDITOR.replace( 'causes1' );
                                            //editor.setData( '' );

                                            // Just call CKFinder.setupCKEditor and pass the CKEditor instance as the first argument.
                                            // The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
                                            //     CKFinder.setupCKEditor( editor, 'ckfinder/' ) ;



                                          //  KCFinder.setupCKEditor( editor, { basePath : '<?php echo SITE_URL;?>admin/ck/kcfinder-3.12', id:'123', startupPath : "Images:/img/", startupFolderExpanded : true, rememberLastFolder : false } ) ;

                                            // It is also possible to pass an object with selected CKFinder properties as a second argument.
                                            // CKFinder.setupCKEditor( editor, { basePath : '../', skin : 'v1' } ) ;
                                        }

                                    </script>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="control-group">
                <div class="controls">
                    <label>Risk Factor</label>
                    <textarea name="risk_factor" class="form-control" id="risk_factor1"><?=$row['risk_factor'];?></textarea>
                   <script>
                     if ( typeof CKEDITOR == 'undefined' )
                                        {
                                            document.write('' ) ;
                                        }
                                        else
                                        {
                                            var editor = CKEDITOR.replace( 'risk_factor1' );
                                        }
                    </script>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="control-group">
                <div class="controls">
                    <label>Treatment</label>
                    <textarea name="treatment" class="form-control" id="treatment1"><?=$row['treatment'];?></textarea>
                    <script>
                     if ( typeof CKEDITOR == 'undefined' )
                                        {
                                            document.write('' ) ;
                                        }
                                        else
                                        {
                                            var editor = CKEDITOR.replace( 'treatment1' );
                                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>