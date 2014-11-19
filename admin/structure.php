<?php if(session_id()==null || session_id()==""){session_start();}

require("../config/config.php");
require("includes/phpfunction.php");
$msgSucc="";
if(isset($_SESSION['msgSuccess']) && $_SESSION['msgSuccess']!=""){ $msgSucc=$_SESSION['msgSuccess']; $_SESSION['msgSuccess']="";}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Dashboard  </title>

    <?php include('includes/styles.php');?>
    <?php include('includes/paginate.php');?>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">


        <?php
        include('includes/header.php');
        include('includes/sidemenu.php');
        ?>

    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Structure
<!--                        <small>Subheading</small>-->
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Structure
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <?php
            $per_page = 20;
            if(isset($_GET['all']))
            {$per_page = 10000;}

            $show_page ="";
            $sql="SELECT * FROM `structure` where  status='1'  ORDER BY id DESC";
            $result = mysql_query($sql);
            $total_results = mysql_num_rows($result); //289
            //echo $total_results;exit;
            $total_pages = ceil($total_results / $per_page); //29

            if (isset($_GET['page'])) {
                $show_page = $_GET['page'];

                if ($show_page > 0 && $show_page <= $total_pages) {
                    $start = ($show_page - 1) * $per_page;
                    $end = $start + $per_page;
                } else {
                    // error - show first set of results
                    $start = 0;
                    $end = $per_page;
                }
            } else {
                // if page isn't set, show first set of results
                $start = 0;
                $end = $per_page; //10
            }
            $page = 0;
            if (isset($_GET['page'])) {
                $page = intval($_GET['page']);
            }
            $tpages = $total_pages;
            if ($page <= 0) {
                $page = 1;
            }


            ?>

            <div class="row">
                <?php if($msgSucc!=""){
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success">
                            <a class="close" data-dismiss="alert">×</a>
                            <strong>Success!</strong> <?php echo $msgSucc; $msgSucc="";?>.
                        </div>
                    </div>
                <?php }?>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i>  Structure
                                <span class="pull-right">
                                <?php
                                if ($total_results == 0) {
                                    echo "Total Store:0";
                                } else {
                                    if ($end < $total_results) {
                                        echo "Showing Results : " . $start . " - " . $end . " out of " . $total_results;
                                    } else {
                                        echo "Showing Results : " . $start . " - " . $total_results . " out of " . $total_results;
                                    }
                                }
                                ?></span>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <form method="post" action="phpComponent/insertStructure.php" enctype="multipart/form-data"  >
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="control-group ">
                                            <div class="controls">
                                                <label>Category</label>
                                                <select name="category" id="category"   class="form-control" required>
                                                    <option value="">Select Category </option>
                                                    <?php
                                                    foreach($ARR_STRUCTURE_CATEGORY as $cat)
                                                    {
                                                        echo "<option value='".$cat."'>".$cat.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="control-group ">
                                            <div class="controls">
                                                <label>Tiltle</label>
                                                <input type="text" name="name" id="name"  class="form-control" required value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div class="control-group ">
                                            <div class="controls">
                                                <label>Icon Image</label>
                                                <input type="file" name="icon" id="icon"   class="btn btn-block"  onchange="checkImageFile(this)" style="margin: 5px 0px; "  required value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div class="control-group ">
                                            <div class="controls">
                                                <label>Image</label>
                                                <input type="file" name="image" id="image"   class="btn btn-block"  onchange="checkImageFile(this)" style="margin: 5px 0px; "  required value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div class="control-group ">
                                            <div class="controls">

                                                <button type="submit" name="submit" class="btn btn-info"  style="margin: 25px 0px 0px 0px; " ><i class="fa fa-save"></i> Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    </form>
                            </div>
                            </div>
                        <div class="panel-body">

<!--                            <button class="btn btn-info" data-toggle="modal"  data-target="#addStore" style="margin: 10px 0px; "><i class="fa fa-plus"></i> Add Store</button>-->
<!--                            <button class="btn btn-info" data-toggle="modal"  data-target="#updateExls" style="margin: 10px 0px; "><i class="fa fa-upload"></i> Upload Excel File </button>-->
<!--                            <a href="lib/Store.xlsx" target="_blank" class="btn btn-success "     style="margin: 10px 0px; "><i class="fa fa-download"></i> Download Sample Excel File </a>-->

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Icon</th>
                                        <th>Image</th>

                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sl=$start;
                                    for ($i = $start; $i < $end; $i++) {
                                        // make sure that PHP doesn't try to show results that don't exist
                                        if ($i == $total_results) {
                                            break;
                                        }
                                        $id = mysql_result($result, $i, 'id');

                                        ?>
                                        <tr>
                                            <td><?=$sl+1;?></td>
                                            <td><?=mysql_result($result, $i,'category' );?></td>
                                            <td> <?=mysql_result($result, $i,'name' );?></td>
                                            <td><img src="../uploades/structures/icon/<?=mysql_result($result, $i,'icon' );?>" style='width:30;'></td>
                                            <td><a href="../uploades/structures/images/<?=mysql_result($result, $i,'images' );?>" target="_blank">Image</a> </td>

                                            <td>
                                                <button class="btn btn-info" onclick="updateStructre('<?=$id;?>')" title="Edit" > <i class="fa fa-edit"></i> </button>
                                                <button class="btn btn-danger" onclick="structureDelete('<?=$id;?>')" title="Delete"> <i class="fa fa-trash-o"></i> </button>
                                            </td>

                                        </tr>
                                        <?php
                                        $sl++;
                                    }

                                    ?>
                                    </tbody>
                                </table>

                                <?php
                                $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;

                                echo '<div class="pagination"><ul>';
                                if ($total_pages > 1) {
                                    echo paginate($reload, $show_page, $total_pages);
                                }
                                ?>
                                <li><a href="store.php?all=1"> All </a></li>
                                <?php
                                echo "</ul></div>";
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<div class="modal fade bs-example-modal-sm" id="updateStructre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="width: 500px;">

        <div class="modal-content">
            <form method="post"  id="addstore" action="ajax/structureUpdate.php"  enctype="multipart/form-data" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"> Update Structure </h4>
                </div>
                <div class="modal-body form-horizontal" id="updatebody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit"  name="update"  id="update" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

include('includes/footer.php');
include('includes/basejs.php');
?>

</body>

</html>
