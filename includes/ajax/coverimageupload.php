<?php
if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");

include("../../admin/includes/phpfunction.php");
include ("../phpfunprofile.php");
$data = array();
if( isset( $_POST['image_upload'] ) && !empty( $_FILES['image'] ))
{
    
    
     if (!checkImageType($_FILES["image"]["type"]) )
    {$data['error']="Image Must Be an Image file(.jpg,.png)";}
    else
    {
        $imgprefixIcon= $imgprefix=time();
        $tmpImageName  = $_FILES['image']['tmp_name'];
        img_resize( $tmpImageName , 1000 , "../../uploades/coverimage/org/" , $imgprefix.".jpg");
        img_resize( $tmpImageName , 150 , "../../uploades/coverimage/thumb/" , $imgprefix.".jpg");

        $dataArr=array();
        $dataArr['id']=$_SESSION['id'];
        $dataArr['coverimage']=$imgprefix.".jpg";
       
        if(updateCoverImage($dataArr))
            {
            $data['success']=1;
            $data['src']=$imgprefix.".jpg";
            
            }else{ 
                $_SESSION['msgSuccess']= "Unable to Save Record. Try Again" ;
                
            }
            
      

    }
}
echo json_encode($data);