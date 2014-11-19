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


if(1)
{
    /************************ YOUR DATABASE CONNECTION END HERE  ****************************/


    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/Classes/');
    include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
    $inputFileName ='allstate.xlsx';

    try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }


    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

    $c=0;
    for($i=2;$i<=$arrayCount;$i++){

        if(insertstate(trim($allDataInSheet[$i]["A"])))
        { $c++;}

}

}
function insertstate($name)
{
    $sql="INSERT INTO `state` (`id`, `name`) VALUES (NULL, '".$name."');";
    if(mysql_query($sql)) {return true;}else{return false;}
}
?>


