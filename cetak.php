<?php 
require_once("connection.php");
$p   = isset($_GET['p']) ? strval($_GET['p']) : NULL;
$mod = isset($_GET['mod']) ? strval($_GET['mod']) : NULL;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$html 	  = NULL;
switch ($p) {
	case 'ruang-ujian':
		if($mod === "monitor"){
			//code monitor filter cetak
      $data = [
        'id_kelas' => intval($_GET['id_kelas']),
        'id_jurusan' => intval($_GET['id_jurusan']),
        'id_ujian' => intval($id), 
      ];
      $tipe = strtoupper($_GET['status']) === "D" ? TRUE : FALSE;
      laporanSiswa($data, $html, $tipe);
		}else{
			//details
      $tipe = strtoupper($_GET['status']) === "D" ? TRUE : FALSE;
			laporanSiswaID($id, $html, $tipe);
		}
		# code...
		break;
  case 'data-guru':
    laporanGuru($html);
    //CODE
    break;
  case 'data-siswa':
      $data = [
        'id_kelas' => intval($_GET['id_kelas']),
        'id_jurusan' => intval($_GET['id_jurusan'])
      ];
    laporanFullSiswa($data, $html);
    //CODE
    break;
  case 'bank-soal':
    laporanPaket(['id_kelas' => intval($_GET['id_kelas'])], $html);
    //CODE
    break;
  case 'data-ujian':
    laporanUjian($html);
    //CODE
    break;
	
	default:
		# code...
		break;
}


function laporanSiswaID($id, $html, $tipe){
	global $conn;
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

                      WHERE tbl_ruang_ujian.id_siswa='".$id."'")->fetch_object();
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

		$gender = strval($d->gender) === "L" ? "Laki-Laki" : "Perempuan";
		$kelas_jurusan = strtoupper($d->kelas)." / ". strtoupper($d->jurusan);
$html = $html;
$html .= "<h1>Laporan </h1>";
$html .= "<table class='table table-bordered'>
        <tr>
          <td>Tanggal & Waktu </td>
          <td>:</td>
          <td>$d->tgl_waktu</td>
        </tr>
        <tr>
          <td>Kode?Paket </td>
          <td>:</td>
          <td>$d->kode / $d->paket</td>
        </tr>
        <tr>
          <td>Guru Pengawas </td>
          <td>:</td>
          <td>$d->pengawas</td>
        </tr>
        <tr>
          <td>NIS</td>
          <td>:</td>
          <td>$d->nis</td>
        </tr>
        <tr>
          <td>Nama Lengkap </td>
          <td>:</td>
          <td>$d->nama</td>
        </tr>
        <tr>
          <td>Jenis Kelamin </td>
          <td>:</td>
          <td>$gender</td>
        </tr>
        <tr>
          <td>Kelas/Jurusan </td>
          <td>:</td>
          <td>$kelas_jurusan</td>
        </tr>
        <tr>
          <td>Total Nilai </td>
          <td>:</td>
          <td>$d->nilai</td>
        </tr>
        <tr>
          <td>Total Benar </td>
          <td>:</td>
          <td>$d->jml_benar</td>
        </tr>
        <tr>
          <td>Total Salah </td>
          <td>:</td>
          <td>$d->jml_salah</td>
        </tr>
        <tr>
          <td>Jumlah Soal </td>
          <td>:</td>
          <td>$d->jumlah_soal</td>
        </tr>
        <tr>
          <td>KKM </td>
          <td>:</td>
          <td>$d->kkm</td>
        </tr>
        <tr>
          <td>Durasi Waktu </td>
          <td>:</td>
          <td>$d->waktu Menit</td>
        </tr>
        <tr>
          <td>Rangking </td>
          <td>:</td>
          <td>$posisi </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td>:</td>
          <td>$d->keterangan</td>
        </tr>
        <tr>
          <td colspan='3'>
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
      </table>";

	$cetak = new Cetak("Laporan hasil ujian ( ".$d->nama." ) | ".$d->tgl_waktu, $tipe);
	$cetak->_loadHtml($html);
	$cetak->setPaper("A4", "portrait");
	$cetak->render();
	$cetak->ok();
}


function laporanSiswa($data= array(), $html= "", $tipe =FALSE){
  global $conn;
  $d = $conn->query("SELECT 
                      tbl_siswa.nis, tbl_siswa.nama,
                      tbl_ruang_ujian.nilai, tbl_ruang_ujian.jml_benar, tbl_ruang_ujian.jml_salah,
                      tbl_paket.kkm,tbl_paket.waktu,tbl_paket.jumlah_soal,tbl_paket.paket,
                      tbl_ruang_ujian.keterangan, tbl_ruang_ujian.tgl_waktu,
                      tbl_kelas.kelas,
                      tbl_jurusan.jurusan,
                      tbl_gender.gender
                      FROM tbl_ruang_ujian 
                      LEFT JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_ruang_ujian.id_siswa
                      LEFT JOIN tbl_gender ON tbl_gender.id = tbl_siswa.id_gender
                      LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                      LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_siswa.id_jurusan
                      LEFT JOIN tbl_ujian ON tbl_ujian.id = tbl_ruang_ujian.id_ujian
                      LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
                      WHERE tbl_ruang_ujian.id_ujian='".$data['id_ujian']."'
                      AND tbl_jurusan.id_jurusan ='".$data['id_jurusan']."'
                      AND tbl_kelas.id_kelas = '".$data['id_kelas']."'
                      ORDER BY tbl_ruang_ujian.nilai DESC
                      ");
    $kls_ = $conn->query("SELECT tbl_kelas.kelas 
                          FROM tbl_kelas 
                          WHERE id_kelas='".$data['id_kelas']."'")->fetch_object()->kelas;

    $jur = $conn->query("SELECT tbl_jurusan.jurusan 
                          FROM tbl_jurusan 
                          WHERE id_jurusan='".$data['id_jurusan']."'")->fetch_object()->jurusan;
    $html = $html;
    $html .= "<h3>Laporan Ujian Online Siswa</h3><h5> Kelas $kls_ Jurusan $jur </h5>";
    $html .= "<table class='table table-bordered'>
          <thead>
            <tr>
              <th>No</th>
              <th>NIS</th>
              <th>Nama Lengkap</th>
              <th>Jenis Kelamin</th>
              <th>Rangking</th>
              <th>Paket/Mapel</th>
              <th>Total Nilai</th>
              <th>Total Benar</th>
              <th>Total Salah</th>
              <th>Jumlah Soal</th>
              <th>KKM</th>
              <th>Keterangan</th>
            </tr></thead><tbody>";
            $no=0;
    while($row = $d->fetch_object()):
      $gender = strval($row->gender) === "L" ? "Laki-Laki" : "Perempuan";
      $tgl = $row->tgl_waktu;
      $no++; 
      $html .= "
              <tr>
                 <td>$no</td>
                 <td>$row->nis</td>
                 <td>$row->nama</td> 
                 <td>$gender</td> 
                 <td>$no</td> 
                 <td>$row->paket</td> 
                 <td>$row->nilai</td> 
                 <td>$row->jml_benar</td> 
                 <td>$row->jml_salah</td> 
                 <td>$row->jumlah_soal</td>
                 <td>$row->kkm</td> 
                 <td>$row->keterangan</td>   
              </tr>
              ";
    endwhile;
    $html .= "</tbody></table>";
    //cetak ke layar
    $cetak = new Cetak("Laporan hasil ujian ".$tgl, $tipe);
    $cetak->_loadHtml($html);
    $cetak->setPaper("A4", "landscape");
    $cetak->render();
    $cetak->ok();
 }


function laporanFullSiswa($data= array(), $html= ""){
  global $conn;
  $d = $conn->query("SELECT 
                      tbl_siswa.*,
                      tbl_kelas.kelas,
                      tbl_jurusan.jurusan,
                      tbl_gender.gender
                      FROM tbl_siswa 
                      LEFT JOIN tbl_gender ON tbl_gender.id = tbl_siswa.id_gender
                      LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                      LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_siswa.id_jurusan
                      WHERE tbl_siswa.id_jurusan ='".$data['id_jurusan']."'
                      AND tbl_siswa.id_kelas = '".$data['id_kelas']."'
                      ");
    $kls_ = $conn->query("SELECT tbl_kelas.kelas 
                          FROM tbl_kelas 
                          WHERE id_kelas='".$data['id_kelas']."'")->fetch_object()->kelas;

    $jur = $conn->query("SELECT tbl_jurusan.jurusan 
                          FROM tbl_jurusan 
                          WHERE id_jurusan='".$data['id_jurusan']."'")->fetch_object()->jurusan;
    $html = $html;
    $html .= "<h3>Laporan Data Siswa</h3><h5> Kelas $kls_ Jurusan $jur </h5>";
    $html .= "<table class='table table-bordered'>
          <thead>
            <tr>
              <th>No</th>
              <th>NIS</th>
              <th>Nama Lengkap</th>
              <th>Jenis Kelamin</th>
              <th>Alamat</th>
              <th>No. Telepon</th>
              <th>Kelas</th>
              <th>Jurusan</th>
              <th>No. Registrasi</th>
              <th>Password</th>
            </tr></thead><tbody>";
            $no=0;
    while($row = $d->fetch_object()):
      $gender = strval($row->gender) === "L" ? "Laki-Laki" : "Perempuan";
      $no++; 
      $html .= "
              <tr>
                 <td>$no</td>
                 <td>$row->nis</td>
                 <td>$row->nama</td> 
                 <td>$gender</td> 
                 <td>$row->alamat</td> 
                 <td>$row->no_tlp</td> 
                 <td>$row->kelas</td> 
                 <td>$row->jurusan</td> 
                 <td>$row->noreg</td> 
                 <td>$row->pwd</td>
              </tr>
              ";
    endwhile;
    $html .= "</tbody></table>";
    //cetak ke layar
    $cetak = new Cetak("Laporan Data Siswa ".date('Y-m-d'), FALSE);
    $cetak->_loadHtml($html);
    $cetak->setPaper("A4", "landscape");
    $cetak->render();
    $cetak->ok();
 }



function laporanGuru($html= ""){
  global $conn;
  $d = $conn->query("SELECT 
                      tbl_guru.*,
                      tbl_gender.gender
                      FROM tbl_guru 
                      LEFT JOIN tbl_gender ON tbl_gender.id = tbl_guru.id_gender
                      WHERE 1
                      ");
    $html = $html;
    $html .= "<h3>Laporan Data Guru</h3><br>";
    $html .= "<table class='table table-bordered'>
          <thead>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama Lengkap</th>
              <th>Jenis Kelamin</th>
              <th>Alamat</th>
              <th>No. Telepon</th>
              <th>Password</th>
            </tr>
            </thead>
            <tbody>";
            $no=0;
    while($row = $d->fetch_object()):
      $gender = strval($row->gender) === "L" ? "Laki-Laki" : "Perempuan";
      $no++; 
      $html .= "
              <tr>
                 <td>$no</td>
                 <td>$row->nip</td>
                 <td>$row->nama</td> 
                 <td>$gender</td> 
                 <td>$row->alamat</td> 
                 <td>$row->no_tlp</td> 
                 <td>$row->pass</td>
              </tr>
              ";
    endwhile;
    $html .= "</tbody>
    </table>";
    //cetak ke layar
    $cetak = new Cetak("Laporan Data Guru ".date('Y-m-d'), FALSE);
    $cetak->__loadHtml($html);
    $cetak->setPaper("A4", "landscape");
    $cetak->render();
    $cetak->ok();
 }

function laporanPaket($data = [], $html= ""){
  global $conn;
  $d = $conn->query("SELECT tbl_kelas.kelas, tbl_paket.* 
                    FROM tbl_paket 
                    LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_paket.id_kelas
                    WHERE tbl_paket.id_kelas='".$data['id_kelas']."'");
    $html = $html;
    $html .= "<h3>Laporan Data Paket Soal</h3><br>";
    $html .= "<table class='table table-bordered'>
          <thead>
            <tr>
              <th>No</th>
              <th>Paket/Mapel</th>
              <th>Kelas</th>
              <th>Jumlah Soal</th>
              <th>KKM</th>
              <th>Waktu pengerjaan</th>
            </tr></thead><tbody>";
            $no=0;
    while($row = $d->fetch_object()):
      $no++; 
      $html .= "
              <tr>
                 <td>$no</td>
                 <td>$row->paket</td>
                 <td>$row->kelas</td> 
                 <td>$row->jumlah_soal</td> 
                 <td>$row->kkm</td> 
                 <td>$row->waktu Menit</td>
              </tr>
              ";
    endwhile;
    $html .= "</tbody></table>";
    //cetak ke layar
    $cetak = new Cetak("Laporan Data Paket/Mapel ".date('Y-m-d'), FALSE);
    $cetak->_loadHtml($html);
    $cetak->setPaper("A4", "landscape");
    $cetak->render();
    $cetak->ok();
 }


function laporanUjian($html= ""){
  global $conn;
  $d = $conn->query("SELECT 
                      tbl_ujian.kode,
                      tbl_guru.nama,tbl_jurusan.jurusan,
                      tbl_paket.paket
                      FROM tbl_ujian 
                      LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_ujian.id_jurusan
                      LEFT JOIN tbl_guru ON tbl_guru.id_guru = tbl_ujian.guru_pengawas
                      LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
                      WHERE 1
                      ");
    $html = $html;
    $html .= "<h3>Laporan Data Ujian</h3><br>";
    $html .= "<table class='table table-bordered'>
          <thead>
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Guru Pengawas</th>
              <th>Nama Paket </th>
              <th>Jurusan</th>
            </tr></thead><tbody>";
            $no=0;
    while($row = $d->fetch_object()):
      $no++; 
      $html .= "
              <tr>
                 <td>$no</td>
                 <td>$row->kode</td>
                 <td>$row->nama</td> 
                 <td>$row->paket</td> 
                 <td>$row->jurusan</td>
              </tr>
              ";
    endwhile;
    $html .= "</tbody></table>";
    //cetak ke layar
    $cetak = new Cetak("Laporan Data Ujian ".date('Y-m-d'), FALSE);
    $cetak->_loadHtml($html);
    $cetak->setPaper("A4", "landscape");
    $cetak->render();
    $cetak->ok();
 }

/*
* eND oF FILE 
*/
 ?>
