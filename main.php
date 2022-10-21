<?php 
    require("control.php"); 
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= isset($title) ? $title : "Dashboard Applikasi Ujian Online";?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

   <?php 
       if(!empty($css)):
           foreach($css as $style):
   ?>
           <link rel="stylesheet" href="<?= url($style);?>"/>
   <?php   
           echo "\n";
           endforeach;
       endif;
   ?>
</head>

<body class="theme-deep-purple">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="?p=beranda">
                    <?= strtoupper($_SESSION['SES_LOGIN_LEVEL']) ?>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">1</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Belum di bikin logikanya </h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?= site_url('profile')?>">
                            <i class="material-icons">account_circle</i>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php" onclick="return alert('apakah anda yakin akan keluar ?') ">
                            <i class="material-icons">input</i>
                        </a>
                    </li>
                    <!-- #END# Notifications -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- MENU KIRI -->
            <?php require_once('menu.php'); ?>
            <!-- #MENU -->
        </aside>
        <!-- #END# Left Sidebar -->>
    </section>

    <section class="content">
        <div class="container-fluid" style="margin-top:-3%">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body"  style="padding:10px; padding-bottom:2px;">
                            <!--breadcrum -->
                            <ol class="breadcrumb" style="font-size:20px">
                                <?php 
                                    if(isset($bc['title'])) :
                                 ?>
                                    <li class="">
                                        <a href="<?= url("main.php?p=beranda") ?>">
                                         Home
                                        </a>
                                    </li>
                                    <li class="active">
                                        <?= isset($bc['title']) ? trim($bc['title']) : " ";?>
                                    </li>
                                <?php else: ?>
                                    <li class="active">
                                        Home
                                    </li>
                                <?php endif; ?>
                            </ol>
                            <!-- end -->
                        </div>
                    </div>
                </div>
            </div>

        <!--
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
        -->

        <!-- ISI HALAMAN -->


            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <!--
                    <div class="card">
                        <div class="body">
                            
                        </div>
                    </div>
                    -->
                    <?php require(
                            $view
                            );
                    ?>
                </div>
            </div>

        <!-- AKHIR HALAMAN -->

        </div>
    </section>

       <?php 
           if(!empty($js)):
               foreach($js as $script):
       ?>
               <script src="<?= url($script);?>"></script>
       <?php   
               echo "\n";
               endforeach;
           endif;
       ?>

    <!-- Plugins -->
    <!-- Demo Js -->
    
  <script>
    //NProgress.done();
  </script>
</body>

</html>


<script type="text/javascript">
 $(document).ready(function(){
  var date = $("#tgl");
  var time = $("#waktu");
  var hour,minute,second,day,month,year= null;
  var days   = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum\'aT","Sabtu"];
  var months = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

  var ampm = "AM";
    setInterval(function(){
        //for time
        hour     = new Date().getHours();
        minute   = new Date().getMinutes();
        second   = new Date().getSeconds();

        if(hour < 10){
          hour   = "0"+hour;
        }
        if(minute <10){
          minute = "0"+minute;
        }
        if(second <10){
          second = "0"+second;
        }
      time.text(hour+":"+minute+":"+second);
      //for date
      day = new Date().getDay();
      month = new Date().getMonth();
      date.text(days[day].toUpperCase()+", "+new Date().getDate()+" "+months[month].toUpperCase()+" "+new Date().getFullYear());
    },100);
 });
</script>
