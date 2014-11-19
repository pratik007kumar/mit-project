<?php
if(session_id()==null || session_id()==""){session_start();}
require("../../config/config.php");
include("../../admin/includes/phpfunction.php");
//include("paginate.php");
$id=isset($_POST['id'])?$_POST['id']:"";

            $sql="SELECT * FROM `structure` where  status='1'    And id='".$id."'";

           $row = mysql_fetch_array(mysql_query($sql));
           ?>
            <h2 class="page-heading"><?= sentence_cap(" ",$row['name']);?></h2>

            <div class="content" id="td_content" style="background: none;">
                <div class="structure-image"><img src="uploades/structures/images/<?=$row['images'];?>" alt=" Searching Image "/></div>
                <div class="structure-text"> <?= sentence_cap(" ",$row['details']);?>  </div>


            </div>


