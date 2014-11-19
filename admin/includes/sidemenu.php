<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <?php  $filename=basename($_SERVER['PHP_SELF']);?>
        <li <?php if($filename=="index.php"){echo 'class="active"'; }?> >
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li <?php if($filename=="store.php"){echo 'class="active"'; }?>>
            <a href="store.php"><i class="fa fa-fw fa-bar-chart-o"></i> Store</a>
        </li>
        <li <?php if($filename=="medicine.php"){echo 'class="active"'; }?>>
            <a href="medicine.php"><i class="fa fa-fw fa-medkit"></i> Medicine </a>
        </li>
        <li  <?php if($filename=="structure.php"){echo 'class="active"'; }?>>
            <a href="structure.php"><i class="fa fa-fw fa-table"></i> Structure</a>
        </li>

        <li <?php if($filename=="clinics.php"){echo 'class="active"'; }?>>
            <a href="clinics.php"><i class="fa fa-fw fa-hospital-o"></i> Clinics/Hospitals</a>
        </li>
        <li <?php if($filename=="symptoms.php"){echo 'class="active"'; }?>>
            <a href="symptoms.php"><i class="fa fa-fw fa-heart"></i> Symptoms</a>
        </li>
        <li <?php if($filename=="firstaids.php"){echo 'class="active"'; }?>>
            <a href="firstaids.php"><i class="fa fa-fw fa-heart"></i> First Aids</a>
        </li>
        <li <?php if($filename=="health_tips.php"){echo 'class="active"'; }?>>
            <a href="health_tips.php"><i class="fa fa-fw fa-heart"></i> Health Tips</a>
        </li>


    </ul>
</div>
<!-- /.navbar-collapse -->