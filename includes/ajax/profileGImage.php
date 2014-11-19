<?php
if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");

include("../../admin/includes/phpfunction.php");
include ("../phpfunprofile.php");
$data = array();
if( isset( $_POST ) && !empty( $_FILES['image'] ))
{
    
    
     if (!checkImageType($_FILES["image"]["type"]) )
    {$data['error']="Image Must Be an Image file(.jpg,.png)";}
    else
    {
        $imgprefixIcon= $imgprefix=time();
        $tmpImageName  = $_FILES['image']['tmp_name'];
        img_resize( $tmpImageName , 1024 , "../../uploades/images/" , $imgprefix.".jpg");
        img_resize( $tmpImageName , 150 , "../../uploades/images/thumb/" , $imgprefix.".jpg");

        $dataArr=array();
        $dataArr['id']=
        $dataArr['coverimage']=
       
          $arr['image']="";
           $arr['src']=$imgprefix.".jpg";
           $arr['discription']="";
           $arr['type']='g';
           $arr['album_id']='';
           $arr['userid']=$_SESSION['id'];
          if(addimage($arr))
          { 
               $data['success']=1;
            $data['src']=$imgprefix.".jpg"; 
            $src=SITE_URL."uploades/images/thumb/".$imgprefix.".jpg";
        $srcb=SITE_URL."uploades/images/".$imgprefix.".jpg";
      $row= mysql_fetch_array(mysql_query("SELECT max(id) FROM `imagetbl`"));
            $data['data']='
        
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" style=" margin-bottom: 15px" id="imgx'.$row['0'].'">
            <a class="fancybox-button" rel="fancybox-button" href="'.$srcb.'" title="">
            <img src="'.$src.'" class="img-thumbnail" style="height: 100px; width: 100% !important;" >
            </a>
            <div style="height:20px; width: 100%;">
                <span class="pull-left text-center " style="font-size:12px;">'.date('m-d-Y g:i A', time()).'</span>
            
            <span class="pull-right" style="cursor: pointer" title="Delete" onclick="delimg('.$row['0'].')"><i class="fa fa-trash"></i></span>
             
            </div>
        </div>';
           } 
          
         else{ 
                $_SESSION['msgSuccess']= "Unable to Save Record. Try Again" ;
                
            }
            
      

    }
}
echo json_encode($data);