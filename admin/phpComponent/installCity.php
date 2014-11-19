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
    $inputFileName ='allcity.xlsx';

    try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }


    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

    $c=0;
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["A"]),'1'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){

        if(insertcity(trim($allDataInSheet[$i]["B"]),'2'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["C"]),'3'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["D"]),'4'))
        { $c++;}

    }
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["E"]),'5'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["F"]),'6'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["G"]),'7'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["H"]),'8'))
        { $c++;}

    }
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["I"]),'9'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["J"]),'10'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["K"]),'11'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["L"]),'12'))
        { $c++;}

    }
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["M"]),'13'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["N"]),'14'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["O"]),'15'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["P"]),'16'))
        { $c++;}

    }
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["Q"]),'17'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["R"]),'18'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["S"]),'19'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["T"]),'20'))
        { $c++;}

    }
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["U"]),'21'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["V"]),'22'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["W"]),'23'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["X"]),'24'))
        { $c++;}

    }
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["Y"]),'25'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["Z"]),'26'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AA"]),'27'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AB"]),'28'))
        { $c++;}

    }
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AC"]),'29'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AD"]),'30'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AE"]),'31'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AF"]),'32'))
        { $c++;}

    }
    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AG"]),'33'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AH"]),'34'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AI"]),'35'))
        { $c++;}

    }

    for($i=2;$i<=$arrayCount;$i++){
        if(insertcity(trim($allDataInSheet[$i]["AJ"]),'36'))
        { $c++;}

    }


}
function insertcity($name,$state_id)
{
    //if()

    if($name!=""){
        $name=substr($name,0,strlen($name)-2);
        echo $name."<br>";
    $sql="INSERT INTO `city` (`id`, `name`,`state_id`) VALUES (NULL, '".$name."','".$state_id."');";
    if(mysql_query($sql)) {return true;}else{return false;}
    }
    }
?>












