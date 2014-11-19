<?php
if (session_id() == null || session_id() == "") {session_start();}

//profile Page
 function updateCoverImage($imgArr) 
{
     $sql="UPDATE `users` SET `coverImage`='".$imgArr['coverimage']."' WHERE `id`='".$imgArr['id']."'";
       if (mysql_query($sql)) {
           $arr['image']="";
           $arr['src']=$imgArr['coverimage'];
           $arr['discription']="";
           $arr['type']='c';
           $arr['album_id']='';
           $arr['userid']=$imgArr['id'];
          if(addimage($arr))
          {  return true;     } else {    return false;   }
    } else {        return false;    }
}
function addimage($arr)
{
    $sql="INSERT INTO `imagetbl`(`image`, `src`, `discription`, `type`, `album_id`, `userid`) VALUES
        ('".$arr['image']."','".$arr['src']."','".$arr['discription']."','".$arr['type']."','".$arr['album_id']."','".$arr['userid']."') 
        ";
       if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}