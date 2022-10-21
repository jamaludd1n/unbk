<?php require_once("connection.php");
    $getmod = isset($_GET['p']) ? $_GET['p'] : NULL;
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Halaman login siswa</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
           <link rel="stylesheet" href="css/iconfont/material-icons.css"/>
   
           <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css"/>
   
           <link rel="stylesheet" href="plugins/mdl/material.min.css"/>
   
           <link rel="stylesheet" href="plugins/node-waves/waves.css"/>
   
           <link rel="stylesheet" href="plugins/animate-css/animate.css"/>
   
           <link rel="stylesheet" href="plugins/material-design-preloader/md-preloader.css"/>
   
           <link rel="stylesheet" href="plugins/bootstrap-select/css/bootstrap-select.css"/>
   
           <link rel="stylesheet" href="plugins/sweetalert/sweetalert.css"/>
   
           <link rel="stylesheet" href="css/style.css"/>
   
           <link rel="stylesheet" href="css/themes/all-themes.css"/>
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
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#">
                	<?= !empty($_SESSION['SES_NAMA']) ? $_SESSION['SES_NAMA'] : "SISWA"; ?>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#">
                            <i class="material-icons">account_circle</i>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="material-icons">input</i>
                        </a>
                    </li>
                    <!-- #END# Notifications -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
<!-- zona test siswa --> 
<?php
if(!empty($_SESSION['SES_LOGIN']) && intval($_SESSION['SES_LOGIN']) === 4):
    if($getmod == "verifikasi-data"):
    	$sql = $conn->query("SELECT * FROM tbl_siswa WHERE id_siswa='".$_SESSION['SES_LOGIN_SISWA']."'")->fetch_object();
?>   
<div class="container-fluid" style="margin-top:6%">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
        	<form id="data">
            <div class="card  animated slideInDown">
                <div class="header bg-info" style="padding-top:10px; padding-bottom:10px;">
                    <h2 style="color:#555">Konfirmasi Data Peserta</h2>
                </div>
                <div class="body">
                    <label for="nis">NIS</label>
                    <div class="form-group">
                        <div class="form-line">
                        	<input type="hidden" value="<?= $sql->id_siswa;?>" name="id_siswa">
                            <input type="text" name="nis" value="<?= $sql->nis ?>" readonly="" class="form-control">
                        </div>
                    </div>


                    <label for="nis">Nama Lengkap</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="nama" value="<?= strtoupper($sql->nama)?>" readonly="" class="form-control">
                        </div>
                    </div>
                    <label for="nis">Mata Ujian</label>
                    <div class="form-group">
                        <div class="form-line">
                            <marquee direction="left"  height="20px" scrollamount="2" class="text-danger">
                                
                        	<?php 
							$sqlQuery = "SELECT
											tbl_paket.paket,
											tbl_jurusan.jurusan,
											tbl_kelas.kelas
										FROM tbl_ujian
										LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
										LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_paket.id_kelas
										LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_ujian.id_jurusan
										WHERE tbl_ujian.is_active = '1' AND tbl_paket.id_kelas='".$_SESSION['KELAS']."'
										";
										$row = $conn->query($sqlQuery);
                                        $disable = ""; $x = "none";
                                        if($row->num_rows >=1):
                                            while($r = $row->fetch_object()):
                                                echo " ( ".$r->jurusan." | ".$r->paket." | ".$r->kelas." ) ";
                                            endwhile;
                                        else:
                                            $disable = "disabled";
                                            $x = "inline";
                                            echo "TIDAK ADA PAKET YANG TERSEDIA UNTUK ANDA ! | SILAHKAN HUBUNGI PETUGAS";
                                        endif;
                        	?>         
                            </marquee>
                        </div>
                    </div>

                    <label for="nis">Kode/Token</label>
                    <div class="form-group form-float">
                        <div class="form-line" style="width:150px;">
                            <input type="text" id="token" name="token" value="" <?= $disable?>  class="form-control" required>
                        </div>
                    </div>

                    <div class="clearfix">
                        <div class="col-md-4 col-md-offset-8">
                            <a href="logout.php" class="btn btn-lg btn-default" style="display:<?= $x ?>; position:relative;top:5px;">BATAL</a>
                            <button class="btn bg-green pull-right btn-lg waves-effect" type="submit" <?= $disable?>>
                                SUBMIT
                            </button>  
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
      </div>
</div>
<?php 
    elseif($getmod === "verifikasi-tes"):	
    	$q = $conn->query("SELECT
								tbl_ujian.kode,tbl_ujian.nama_ujian,tbl_ujian.id,
								tbl_paket.paket,tbl_paket.waktu,tbl_paket.id_paket,
								tbl_jurusan.jurusan,
								tbl_kelas.kelas
							FROM tbl_ujian
							LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
							LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_paket.id_kelas
							LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_ujian.id_jurusan
							WHERE tbl_ujian.is_active = '1'
							AND tbl_ujian.kode ='".trim($_SESSION['token_ujian'])."'")->fetch_object();
                            

?>
<!-- test starting --> 


<div class="container-fluid" style="margin-top:7%">
      <div class="row">
        <form id="tes">
        <div class="col-md-8">
        	<div class="card  animated slideInRight">
                <div class="header bg-info" style="padding-bottom:10px; padding-top:10px;">
                    <h2 style="color:#655">Konfirmasi Tes</h2>
                </div>
                <div class="body">
                    <label for="nis">Nama Tes</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="hidden" name="id_siswa" value="<?= $_SESSION['SES_LOGIN_SISWA']; ?>">
                        	<input type="hidden" name="id_ujian" value="<?= $q->id?>">
                            <input type="text" value="<?= !empty($q->nama_ujian) ? $q->nama_ujian : 'Penilaian Akhir Sekolah';?>" name="nama_tes" value="" readonly="" class="form-control">
                        </div>
                    </div>
                    <label for="nis">Sub Tes</label>
                    <div class="form-group">
                        <div class="form-line">
                            <marquee direction="up"  height="20px" scrollamount="3" class="text-danger">
                               <?= $q->paket." | ".$q->kelas;?>
                            </marquee>
                            <input type="hidden" name="id_paket" value="<?= $q->id_paket ?>" readonly="" class="form-control">
                        </div>
                    </div>
                    <label for="tgl">Tanggal</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="tgl" value="<?= date('Y/m/d'); ?>" readonly="" class="form-control">
                        </div>
                    </div>
                    <label for="waktu">Waktu</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="waktu_mulai" value="<?= date('Y-m-d H:i:s'); ?>" readonly="" class="form-control">
                        </div>
                    </div>
                    <label for="nis">Alokasi Waktu</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="durasi_waktu" value="<?= $q->waktu ?> Menit" readonly="" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 clearfix">
            <div class="card  animated slideInLeft">
                <div class="body bg-warning">
                    <p>
                        Tombol mulai hanya akan aktif apabila waktu
                        sekarang sudah melewati waktu test. Tekan tombol F5 untuk merefresh halaman   
                    </p>
                </div>
            </div>
                    <button class="btn btn-block bg-red btn-lg" type="submit">MULAI</button>
        </div>
      </form>
      </div>
</div>


<!-- login -->
<?php 
	endif;
else: ?>
<div class="container-fluid" style="margin-top:6%">
      <div class="row">
        <div class="col-md-4 col-md-offset-4" >
            <div class="card animated slideInUp">
                <form id="sign">
                <div class="header text-center">
                        <i class="material-icons" style="font-size:40px;position:relative;top:7px;">school</i>
                        <strong style="font-size:25px;">
                            LOGIN SISWA
                        </strong>
                </div>
                <div class="body">
                    <div class="alert text-center" style="background:rgba(200,200,200,0.2);">
                        <strong id="msg" style="color:#666">Login dengan No. Reg dan Password </strong>
                    </div>
                    <div class="form-group form-float">
                        <div class="col-md-12">
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                                <div class="form-line">
                                    <input type="text" name="noreg" class="form-control" placeholder="No. Reg :" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="col-md-12">
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                                <div class="form-line">
                                    <input type="password" name="pwd" class="form-control" placeholder="Password :" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float clearfix">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block waves-effect" style="background:linear-gradient(60deg, deeppink, crimson);color:#FFF">
                                <i class="material-icons">input</i>
                                SUBMIT
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

      </div>
</div>
<?php endif;?>
<!-- zona javascript -->
                <script src="plugins/jquery/jquery.min.js"></script>
       
               <script src="plugins/bootstrap/js/bootstrap.js"></script>
       
               <script src="plugins/mdl/material.min.js"></script>
       
               <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
       
               <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
       
               <script src="plugins/jquery-validation/jquery.validate.js"></script>
       
               <script src="plugins/node-waves/waves.js"></script>
       
               <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
       
               <script src="plugins/sweetalert/sweetalert.min.js"></script>
       
               <script src="js/admin.js"></script>
               <script src="js/sign-in-siswa.js"></script>

    <!-- Plugins -->
    <!-- Demo Js -->
    
  <script>
    window.onload = function(){
        window.localStorage.clear();
    }

    if(window.event.keyCode === 112){
        window.location.href= "admin";
    }
  </script>
</body>

</html>
