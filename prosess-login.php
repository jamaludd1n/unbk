
<?php
#include connection
include_once('connection.php');
$p = isset($_POST['p']) ? trim(strval($_POST['p'])) : NULL;
if($p === "admin") :
    //tampung data
    $txtUser  = trim($_POST['username']);
    $txtPwd   = trim($_POST['password']);
    $pwd      = ($txtPwd);
    //temukan data BERDASARKAN FORM INPUT
    $sql  = "SELECT tbl_level.level,tbl_level.id_level,
     tbl_user.id_users,tbl_user.password,tbl_user.username,tbl_user.nama
            FROM tbl_user 
            LEFT JOIN tbl_level ON tbl_level.id_level = tbl_user.level
            WHERE tbl_user.username='".$txtUser."' AND tbl_user.password='".$pwd."'";
    $query = $conn->query($sql);
    $data  = $query->fetch_object();
    
    //jika data ditemukan >=1
    $msg = array();
    if($query->num_rows >= 1):
      session_start();
      $_SESSION['SES_LOGIN_LEVEL'] = $data->level; // 1 for admin
      $_SESSION['SES_LOGIN'] = $data->id_level; // 1 for admin
  		$_SESSION['SES_USER']  = $data->username;
      $_SESSION['SES_USER_ID']  = $data->id_users;
      $_SESSION['NAMA']   = $data->nama;
        $msg[] = "bg-green|".$config['pesan']['success']['login']."|main.php?p=dashboard";
    else :
      $msg[] = "bg-red|".$config['pesan']['error']['login']."|index.php?p=login_gagal";
    endif; 
    echo json_encode(
      $msg
    );
elseif($p === "siswa"):
  $noreg = trim($_POST['noreg']);
  $pwd   = trim($_POST['pwd']);
  $sql  = $conn->query("
      SELECT noreg, pwd, nama, id_siswa,is_active, id_kelas, id_level FROM tbl_siswa WHERE noreg='".$noreg."' AND pwd='".$pwd."'
      AND is_active='1'  
    ");
  $row = $sql->fetch_object();
  if($sql->num_rows >= 1):
      session_start();
      $_SESSION['SES_LOGIN_SISWA'] = $row->id_siswa;
      $_SESSION['SES_NAMA']  = $row->nama;
      $_SESSION['SES_USER']  = $row->noreg;
      $_SESSION['KELAS']     = $row->id_kelas;
      $_SESSION['SES_LOGIN'] = $row->id_level; // 4 for siswa
  
      $msg[] = "bg-green|".$config['pesan']['success']['login']."|login-siswa.php?p=verifikasi-data";
    else :
      $msg[] = "bg-red|".$config['pesan']['error']['login']." atau akun anda di non aktifkan, untuk lebih lanjut minta bantuan petugas|login-siswa.php?p=login_gagal";
    endif; 
    echo json_encode(
      $msg
    );
elseif($p === "verifikasi-data"):
	$q = $conn->query("SELECT
							tbl_ujian.kode,tbl_ujian.id,
							tbl_paket.paket,
							tbl_jurusan.jurusan,
							tbl_kelas.kelas
						FROM tbl_ujian
						LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
						LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_paket.id_kelas
						LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_ujian.id_jurusan
						WHERE tbl_ujian.is_active = '1'
						AND tbl_ujian.kode ='".trim($_POST['token'])."'");
	$rw = $q->fetch_object();
	if($q->num_rows >= 1):
		session_start();
		$_SESSION['token_ujian'] = $rw->kode;
    $_SESSION['id_ujian'] = $rw->id;

		  $msg[] = "bg-green|Data berhasil diverifikasi , selanjutnya silahkan verifikasi tes terlebih dahulu !|login-siswa.php?p=verifikasi-tes";
    else :
      $msg[] = "bg-red|Gagal verifikasi data silahkan minta bantuan kepada petugas , token telah di non-aktifkan !|login-siswa.php?p=verifikasi-data&status=gagal-verifikasi-data";
    endif; 
    echo json_encode(
      $msg
    );
elseif($p === "verifikasi-tes"):
  session_start();
  $_SESSION['paket_id'] = trim($_POST['id_paket']);
  $w = explode(" ", trim($_POST['durasi_waktu'])); //membuang kata Menit
  $_SESSION['durasi_waktu'] = $w[0];
  $_SESSION['waktu_mulai'] = $_POST['waktu_mulai'];
    $cek = $conn->query("SELECT * FROM tbl_ruang_ujian 
            WHERE id_siswa='".trim(intval($_POST['id_siswa']))."'
            AND is_active='1'
            ")->num_rows;
    if($cek < 1):
          $sql = $conn->query("INSERT INTO tbl_ruang_ujian (id_siswa,id_ujian,is_active,created_at,updated_at)
                  VALUES(
                      '".trim($_POST['id_siswa'])."',
                      '".trim($_POST['id_ujian'])."',
                      '1',
                      '".date('Y-m-d H:i:s')."',
                      '".date('Y-m-d H:i:s')."'
                    )
          ");
        $msg[] = "bg-green|Data berhasil diverifikasi , Harap tunggu sebentar halaman akan segera di alihkan !|quiz.php?p=start";         
    else:
        $msg[] = "bg-red|Gagal diverifikasi anda sudah pernah melakukan test sebelumnya , Silahkan meminta bantuan petugas ! !|quiz.php?p=start";
    endif;
  echo json_encode(
      $msg
    );
else:
    echo "Nothing";
endif;
?>
