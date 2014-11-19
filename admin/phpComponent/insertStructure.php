<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");
require("../includes/ImageManipulator.php");

echo "Loding...";


if(isset($_POST['submit']))
{
    if (!checkImageType($_FILES["icon"]["type"]) )
    {$_SESSION['msgSuccess']="Icon Image Must Be an Image file(.jpg,.png)";}
  //  else if (!checkImageType($_FILES["image"]["type"]) )
  //  {$_SESSION['msgSuccess']="Image Must Be an Image file(.jpg,.png)";}
    else
    {
        $imgprefixIcon= $imgprefix=time();
        $tmpIconName  = $_FILES['icon']['tmp_name'];
        $imgprefixIcon.=$_FILES['icon']['name'];

        move_uploaded_file($tmpIconName, "../../uploades/structures/icon/" . $imgprefixIcon);



        $img = "../../uploades/structures/icon/" . $imgprefixIcon; // File image location
        $newfilename ="../../uploades/structures/icon/" . $imgprefixIcon; // New file name for thumb
        $w = 50;
        $h =50;

        $thumbnail = resize($img, $w, $h, $newfilename);

      //  img_resize( $tmpIconName , 50 , "../../uploades/structures/icon/" , $imgprefix.".png");

        $tmpImageName  = $_FILES['image']['tmp_name'];
       // img_resize( $tmpImageName , 1024 , "../../uploades/structures/images/" , $imgprefix.".jpg");
      //  $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
      //  $name = $_FILES["pictures"]["name"][$key];
      //  move_uploaded_file($tmp_name, "$uploads_dir/$name");
         move_uploaded_file($tmpImageName, "../../uploades/structures/images/" . $imgprefix.$_FILES['image']['tmp_name']);

        $dataArr=array();
        $dataArr['category']=$_POST['category'];
        $dataArr['name']=$_POST['name'];
        $dataArr['icon']=$imgprefixIcon;
        $dataArr['images']=$imgprefix.$_FILES['image']['tmp_name'];
        if(insertStructure($dataArr)){$_SESSION['msgSuccess']= "Record Save Successfully !!";}else{ $_SESSION['msgSuccess']= "Unable to Save Record. Try Again" ;}
       echo("<script> location.href='../structure.php'</script>");

    }
}
else
{   echo("<script> location.href='../index.php'</script>");}