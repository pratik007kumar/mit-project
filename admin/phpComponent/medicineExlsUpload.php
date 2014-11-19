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
            $storagename = time()."_".date('d-m-Y')."_"."Medicine.xlsx";
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
        $dataArr['company']=trim($allDataInSheet[$i]["B"]);
        $dataArr['description']=trim($allDataInSheet[$i]["C"]);
        $dataArr['category']=getCategoryIdByName('medicine',trim($allDataInSheet[$i]["D"]));
        if($dataArr['name']!=""){
            if(insertMedicine($dataArr))
            { $c++;}
        }




}
if($c)
{
    $_SESSION['msgSuccess']= $c." New  Record Inserted Successfully !!";
    echo("<script> location.href='../medicine.php'</script>");
}
}
?>