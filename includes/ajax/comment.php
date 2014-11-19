<?php
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");

if(isset($_POST))
{
   // echo '<pre>';
   // print_r($_POST);
   if(commentInsert($_POST)){
   echo getComment($_POST['type'],$_POST['id']);
   }
}

