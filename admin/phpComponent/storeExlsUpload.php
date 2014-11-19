<?php if(session_id()==null || session_id()==""){session_start();}

require("../../config/config.php");
require("../includes/phpfunction.php");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/13/14
 * Time: 1:33 PM
 */
echo "Storing Data in  Database...";
//echo "<pre>";
//print_r($_POST);
$uploadedStatus = 0;
if ( isset($_POST["submit"]) ) {
    if ( isset($_FILES["file"])) {
//if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else {
            if (file_exists($_FILES["file"]["name"])) {
                unlink($_FILES["file"]["name"]);
            }
            $storagename = time()."_".date('d-m-Y')."_"."Store.xlsx";
            move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
            $uploadedStatus = 1;
        }
    } else {
        echo "No file selected <br />";
    }
}

if($uploadedStatus)
{
    /************************ YOUR DATABASE CONNECTION END HERE  ****************************/


    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/Classes/');
    include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
    $inputFileName =$storagename;// 'discussdesk.xlsx';

    try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }


    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

$c=0;
    for($i=2;$i<=$arrayCount;$i++){
   $dataArr=array();
        $dataArr['name']=trim($allDataInSheet[$i]["A"]);
        $dataArr['address']=trim($allDataInSheet[$i]["B"]);
        $dataArr['city']=trim($allDataInSheet[$i]["C"]) !="" ? getCityByName(trim(sentence_cap(" ",$allDataInSheet[$i]["C"]))):"";
        $dataArr['state']=trim($allDataInSheet[$i]["D"]) !="" ? getStateByName(trim(sentence_cap(" ",$allDataInSheet[$i]["D"]))):"";
        $dataArr['pin']=trim($allDataInSheet[$i]["E"]);
        $dataArr['phno']=trim($allDataInSheet[$i]["F"]);
        $dataArr['website']=trim($allDataInSheet[$i]["G"]);
        $dataArr['category']=getCategoryIdByName('store',trim($allDataInSheet[$i]["H"]));

//echo "<pre>";
//       print_r($dataArr);
 //    exit;

        if($dataArr['name']!=""){
        if(insertStore($dataArr))
        { $c++;}
        }

//        $query = "SELECT name FROM YOUR_TABLE WHERE name = '".$userName."' and email = '".$userMobile."'";
//        $sql = mysql_query($query);
//        $recResult = mysql_fetch_array($sql);
//        $existName = $recResult["name"];
//        if($existName=="") {
//            $insertTable= mysql_query("insert into YOUR_TABLE (name, email) values('".$userName."', '".$userMobile."');");
//
//
//            $msg = 'Record has been added. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
//        } else {
//            $msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
//        }
    }


}
if($c)
{
       $_SESSION['msgSuccess']= $c." New  Record Inserted Successfully !!";
    echo("<script> location.href='../store.php'</script>");
}
?>