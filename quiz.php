<?php 
    require_once("control-quiz.php");
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= isset($title) ? $title : "Selamat datang di halaman applikasi ujian online";?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

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
   <style type="text/css">
       .sticky {
           position: fixed;
           top:0;
           width:100%;
           z-index: 10;
       }
   </style>
</head>

<body class="theme-deep-purple">
    <button class="hide" id="timeout">finish</button>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-indigo" stroke-width="4" />
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
<div class="container-fluid" style="margin-top:5%">

       <?php 
          $jml = 0; //this for right list number
          $p = isset($_GET['p']) ? $_GET['p'] : "";
          if($p === "start"):
            if( array_key_exists("paket_id", $_SESSION) ) :
       ?>
      <div class="card  animated slideInDown">
       <div class="header" id="header">
        <strong style="font-size:30px">
            <span class="label label-default">SOAL NO. </span>
            <span class="label bg-indigo">
            	<?= isset($_GET['no']) ? intval($_GET['no']) : 1; ?>
            </span>
        </strong>
        <strong  class="pull-right" style="font-size:30px;" id="time">
            <span class="label bg-grey">WAKTU TERSISA </span>
            <span class="label bg-pink">
            <?php 

                $limitakhir = 1;
                $id = isset($_GET['no']) ? intval($_GET['no']) : 0;
                if(empty($id)){
                  $id = 1;
                  $limitawal = 0;
                }else{
                  $limitawal = ($id - 1) * $limitakhir;
                }
                $no = 0 + $limitawal;
                
                date_default_timezone_set("Asia/Jakarta");
                $durasi_waktu = $_SESSION['durasi_waktu']; //durasi yang diberikan kepada student
                $waktu_mulai = strtotime($_SESSION['waktu_mulai']); //waktu ketika student mulai ujian
                $now  = time(); //waktu saat  ini
                $selisih = $now - $waktu_mulai;
                $sisa_durasi = $durasi_waktu - strtotime($selisih, $now);
            ?>
              <strong class="waktu_server" id="<?= $durasi_waktu; ?>">
                00:00:00
              </strong>
            </span>
        </strong>
        <div class="clearfix"></div>
       </div>
       <!-- start -->
       <div class="body" style="font-size:20px;">
       		<?php 
       			$sql = $conn->query("
       				SELECT * FROM tbl_banksoal WHERE id_paket='".intval($_SESSION['paket_id'])."' LIMIT ".$limitawal.",".$limitakhir."");
       			while($row = $sql->fetch_object()):
              $id_bank = $row->id_bank;
       		 ?>
        	<div class="box-soal" style="border:2px solid #ddd; padding:20px;">
            <form id="kirim">
              <input type="hidden" name="id_bank" value="<?= $id_bank ?>">
              <input type="hidden" name="number" value="<?= $id ?>">
              <input type="hidden" name="id_siswa" value="<?= $_SESSION['SES_LOGIN_SISWA']; ?>">
              <input type="hidden" name="id_paket" value="<?= $_SESSION['paket_id']; ?>">
              <input type="hidden" name="waktu_mulai" value="<?= $_SESSION['waktu_mulai']; ?>">
              <input type="hidden" name="id_ujian" value="<?= $_SESSION['id_ujian']; ?>">
        		<p>
                <?= htmlspecialchars_decode($row->q) ?>
            </p>
            <?php 
              $jw = $conn->query("SELECT * FROM tbl_tmp WHERE no='".$id."'
                 AND id_soal ='".$id_bank."' 
                 AND id_siswa ='".$_SESSION['SES_LOGIN_SISWA']."'
                 AND id_paket='".intval($_SESSION['paket_id'])."'");
              $checkedA = $checkedB = $checkedC = $checkedD = $checkedE = "";
              while($ooo = $jw->fetch_object()):
                $checkedA = strtoupper($ooo->jawaban) === "A" ? "checked" : "";
                $checkedB = strtoupper($ooo->jawaban) === "B" ? "checked" : "";
                $checkedC = strtoupper($ooo->jawaban) === "C" ? "checked" : "";
                $checkedD = strtoupper($ooo->jawaban) === "D" ? "checked" : "";
                $checkedE = strtoupper($ooo->jawaban) === "E" ? "checked" : "";
              endwhile;;
            ?>
            <style type="text/css">
               ol.pilihan > li{
                list-style-type: upper-latin;
               }
               ol.pilihan > li > .radio-col-green{
                position: relative;
                margin-left: -42px;
               }
            </style>
            <p>
              <ol  class="pilihan">
                <li>
                  <input name="j" value="a" type="radio" id="ja" class="radio-col-green" <?= $checkedA; ?>/>
                  <label for="ja"><?= htmlspecialchars_decode($row->a)?></label>  
                </li>
                <li>
                  <input name="j" value="b" type="radio" id="jb" class="radio-col-green" <?= $checkedB; ?>/>
                  <label for="jb"><?= htmlspecialchars_decode($row->b)?></label>  
                </li>
                <li>
                  <input name="j" value="c" type="radio" id="jc" class="radio-col-green" <?= $checkedC; ?>/>
                  <label for="jc"><?= htmlspecialchars_decode($row->c)?></label>  
                </li>
                <li>
                  <input name="j" value="d" type="radio" id="jd" class="radio-col-green" <?= $checkedD; ?>/>
                  <label for="jd"><?= htmlspecialchars_decode($row->d)?></label>                  
                </li>
                <li>
                  <input name="j" value="e" type="radio" id="je" class="radio-col-green" <?= $checkedE; ?>/>
                  <label for="je"><?= htmlspecialchars_decode($row->e)?></label>  
                </li>
              </ol>
            </p>

            </form>
        	</div>

        <?php endwhile;?>
        <!-- \END -->
       </div>
       <div class="footer">
       	<div class="row clearfix">
	       	<div class="col-md-12">
	       	   <?php $jml = $conn->query("SELECT * FROM tbl_banksoal WHERE id_paket='".intval($_SESSION['paket_id'])."'")->num_rows; ?>
	       		    <a href="?p=start&no=<?= $id !== 1 ? $id - 1 : 1; ?>" class="btn btn-lg bg-blue-grey pull-left m-l-20" id="sebelumnya">SEBELUMNYA  </a>
            <?php if($id === $jml):?>
	       		    <a href="?p=start&no=<?= $id !== $jml ? $id + 1 : $jml ?>" class="btn btn-lg bg-green pull-right m-r-20" id="selesai">
                <i class="material-icons">send</i>
                SELESAI
                </a>
            <?php else:?>
                <a href="?p=start&no=<?= $id !== $jml ? $id + 1 : $jml ?>" class="btn btn-lg bg-blue pull-right m-r-20" id="selanjutnya">SELANJUTNYA</a>
            <?php endif?>           
	       	</div>
       	</div>
       	<br><br>
       </div>
        <!-- ending -->
      </div> <!-- body -->
</div>


<style type="text/css">
	.no-quiz{
		z-index: 99999;
		position: fixed;
		right: 0;
		top: 25%;
	}
	.box-no-quiz{
		position: relative;
	}
	.box-no-quiz > .card{
		height: 60vh;
		width: 24vw;
		overflow-x: hidden;
	}
  .btn-no{
    position: absolute;
    right: 105%;
  }
	.no-question{
		height: 50px;
		width:48px;
		border: 2px solid #222;
		font-weight: bold;
		margin: 10px;
		float: left;
    padding: 10px;
	}
  .no-question > a{
    color: indigo;
  }
	.no-question > a:hover{
		text-decoration: none;
	}
</style>
<div class="no-quiz">
	<div class="box-no-quiz">
		<a href="" class="btn btn-default btn-no">
			<strong class="tombol">
				<i class="material-icons" style="font-size:30px;">chevron_left</i>
				<span style="position:relative;top:-6px;">DAFTAR SOAL</span>
			</strong>
			<strong class="tombol" style="display:none">
				<i class="material-icons" style="font-size:30px;">chevron_right</i>
			</strong>
		</a>
		<div class="card box-slide animated">
			<div class="body">
				<div class="icon-button-demo" style="margin-top:5px;">
					<?php 
						for($i=1; $i<=$jml; $i++):
              $bg = $col = "";
              $q = $conn->query("SELECT * FROM tbl_tmp WHERE no='".$i."' AND jawaban !=''");
              if($q->num_rows >= 1):
                $row = $q->fetch_object();
                //$bg = intval($row->no) !== $i ? "bg-success" : "bg-info";
                //$col = intval($row->no) === $i ? "#FFF" : "";
                $bg = "bg-light-green"; $col = "#FFF";
              else:
                $bg = "btn-default";
              endif;
					 ?>
					<button class="btn  no-question <?= $bg ?> " style="font-size:20px;">
						<a class="btn" href="?p=start&no=<?=$i?>" style="color:<?= $col ?>"><?= $i ?></a>
					</button>
				<?php endfor; ?>
                </div>
			</div>
			<div class="footer clearfix">
				
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<div class="alert alert-warning" style="margin-top:8px">
  SESSION PAKET TIDAK TERDAFTAR. SILAHKAN LOGIN <a href="login-siswa.php"> DISINI</a>
</div>
<?php 
    endif;
  elseif( (strval($p) === "show-result") && array_key_exists("SES_LOGIN_SISWA", $_SESSION)): 
  $d = $conn->query("SELECT 
                      tbl_ujian.kode,
                      tbl_siswa.nis, tbl_siswa.nama,
                      tbl_ruang_ujian.nilai, tbl_ruang_ujian.jml_benar, tbl_ruang_ujian.jml_salah,
                      tbl_paket.kkm,tbl_paket.waktu,tbl_paket.jumlah_soal,tbl_paket.id_paket,tbl_paket.paket,
                      tbl_ruang_ujian.keterangan, tbl_ruang_ujian.tgl_waktu,
                      tbl_guru.nama AS pengawas,
                      tbl_kelas.kelas,tbl_kelas.id_kelas,
                      tbl_jurusan.jurusan,tbl_jurusan.id_jurusan,
                      tbl_gender.gender
                      FROM tbl_ruang_ujian 
                      LEFT JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_ruang_ujian.id_siswa
                      LEFT JOIN tbl_gender ON tbl_gender.id = tbl_siswa.id_gender
                      LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                      LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_siswa.id_jurusan
                      LEFT JOIN tbl_ujian ON tbl_ujian.id = tbl_ruang_ujian.id_ujian
                      LEFT JOIN tbl_guru ON tbl_guru.id_guru = tbl_ujian.guru_pengawas
                      LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket

                      WHERE tbl_ruang_ujian.id_siswa='".$_SESSION['SES_LOGIN_SISWA']."'")->fetch_object();
    $getRangking = $conn->query("
            SELECT nilai 
                      FROM tbl_ruang_ujian 
                      LEFT JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_ruang_ujian.id_siswa
                      LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                      LEFT JOIN tbl_ujian ON tbl_ujian.id = tbl_ruang_ujian.id_ujian
                      LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
                      LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_ujian.id_jurusan
                      WHERE tbl_paket.id_kelas = '".$d->id_kelas."' 
                      AND tbl_paket.id_paket='".$d->id_paket."'
                      AND tbl_jurusan.id_jurusan = '".$d->id_jurusan."'
                      ORDER BY tbl_ruang_ujian.nilai DESC
    ");
    $rangking = [];
    while($row = $getRangking->fetch_object()):
      $rangking[] = $row->nilai;
    endwhile;
    $posisi = array_search($d->nilai, $rangking)+1;
            ?>
<div class="card" style="margin-top:8px">
  <div class="header clearfix">
    <h2 class="text-center" style="font-size:30px;">
      Result :
    </h2>
    <a href="" data-id="<?= $_SESSION['SES_LOGIN_SISWA']?>"  class="btn btn-success  pull-right download">
      <i class="material-icons">file_download</i>
    </a>
    <a href="" data-id="<?= $_SESSION['SES_LOGIN_SISWA']?>"  class="btn btn-default  pull-right download">
      <i class="material-icons">print</i>
    </a>
  </div>
  <div class="body">
    <center>
      <table class="table table-striped" style="width:60%;font-size:15px;padding:30px">
        <tr>
          <td>Tanggal & Waktu </td>
          <td>:</td>
          <td><?= $d->tgl_waktu?></td>
        </tr>
        <tr>
          <td>Kode/Paket </td>
          <td>:</td>
          <td><?= $d->kode?> / <?= strtoupper($d->paket)?></td>
        </tr>
        <tr>
          <td>Guru Pengawas </td>
          <td>:</td>
          <td><?= $d->pengawas?></td>
        </tr>
        <tr>
          <td>NIS</td>
          <td>:</td>
          <td><?= $d->nis?></td>
        </tr>
        <tr>
          <td>Nama Lengkap </td>
          <td>:</td>
          <td><?= $d->nama?></td>
        </tr>
        <tr>
          <td>Jenis Kelamin </td>
          <td>:</td>
          <td><?= strval($d->gender) === "L" ? "Laki-Laki" : "Perempuan";?></td>
        </tr>
        <tr>
        <tr>
          <td>Kelas/Jurusan </td>
          <td>:</td>
          <td><?= strtoupper($d->kelas) ." / ". strtoupper($d->jurusan)?></td>
        </tr>
        <tr>
          <td>Total Nilai </td>
          <td>:</td>
          <td><?= $d->nilai?></td>
        </tr>
        <tr>
          <td>Total Benar </td>
          <td>:</td>
          <td><?= $d->jml_benar?></td>
        </tr>
        <tr>
          <td>Total Salah </td>
          <td>:</td>
          <td><?= $d->jml_salah?></td>
        </tr>
        <tr>
          <td>Jumlah Soal </td>
          <td>:</td>
          <td><?= $d->jumlah_soal?></td>
        </tr>
        <tr>
          <td>KKM </td>
          <td>:</td>
          <td><?= $d->kkm?></td>
        </tr>
        <tr>
          <td>Durasi Waktu </td>
          <td>:</td>
          <td><?= $d->waktu?></td>
        </tr>
        <tr>
          <td>Rangking </td>
          <td>:</td>
          <td><?= $posisi?></td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td>:</td>
          <td><?= $d->keterangan?></td>
        </tr>
        <tr>
          <td colspan="3">
            <p>
              Format penilaian : <br>
              <code>Nilai  = (100/jumlah_soal) * jml_benar</code>
            </p>
            <p>
              Format Keterangan : <br>
              <code> 
                  Nilai <= KKM = TIDAK LULUS
                   &nbsp; | &nbsp;
                  Nilai >= KKM =  LULUS
              </code>
            </p>
          </td>
        </tr>
      </table>
    </center>
  </div>
</div>

<?php else: ?>
  <script>
      setTimeout(function(){window.location.href = 'logout.php';},1000);
  </script>
<?php endif;?>
<!-- zona javascript -->

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
  
    $(".download").click(function(e){
      e.preventDefault();
      var id = $(this).data("id");
      var href = window.location.href;
      var src = href.split(window.location.pathname);
      var url = "cetak.php?p=ruang-ujian&mod=details&status=d&id="+id;
      var option = "width="+screen.availWidth+", height="+screen.availHeight;
      window.open(url, "Halaman print", option);
  });

    $(".print").click(function(e){
      e.preventDefault();
      var id = $(this).data("id");
      var href = window.location.href;
      var src = href.split(window.location.pathname);
      var url = "cetak.php?p=ruang-ujian&mod=details&status=p&id="+id;
      var option = "width="+screen.availWidth+", height="+screen.availHeight;
      window.open(url, "Halaman print", option);
  });
</script>