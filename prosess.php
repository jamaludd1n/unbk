<?php 
	require_once("connection.php");session_start();
	$p = isset($_POST['p']) ? strtolower($_POST['p']) : NULL;
	$m = isset($_POST['mod']) ? strtolower($_POST['mod']) : NULL;
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	switch ($p) {
		case 'bank-soal':
				prosesPaket($m, intval($_POST['id_paket']));
			break;

		case 'isi-soal':
			if($m === "update-status"):
				$sts = intval($_POST['is_active']) == 1 ? 0 : 1;
				isActive("tbl_banksoal", array(
										'is_active'=>$sts,
										'id_user' => $_SESSION['SES_LOGIN']),
								  array(
										'key' => 'id_bank',
										'val' => $_POST['id'])
						);
			else:
				prosesSoal($m, $id);
			endif;
			break;

		case 'data-ujian':
			if($m === "update-kode"){
				global $conn;
				$conn->query("UPDATE tbl_ujian SET 
						kode='".kode_acak()."', 
						id_user='".$data['id_user']."', 
						updated_at='".date('Y-m-d H:i:s')."' 
						WHERE id='".$id."'");
			}
			elseif ($m === "update-status") {
				$sts = intval($_POST['is_active']) == 1 ? 0 : 1;
				isActive("tbl_ujian", array(
										'is_active'=>$sts,
										'id_user' => $_SESSION['SES_LOGIN']),
								  array(
										'key' => 'id',
										'val' => $_POST['id'])
						);
			}
			else{
				prosesUjian($m, $id);
			}
			break;
		case 'ruang-ujian':
			if($m === "update-status") {
				$sts = intval($_POST['is_active']) == 1 ? 0 : 1;
				isActive("tbl_ruang_ujian", array(
										'is_active'=>$sts,
										'id_user' => $_SESSION['SES_LOGIN']),
								  array(
										'key' => 'id',
										'val' => $_POST['id'])
						);
			}
			else{
					global $conn;$msg = array();
					$sql = "DELETE FROM tbl_ruang_ujian
							WHERE id='".$id."'
							";
					$conn->autocommit(false);
					if($conn->query($sql) === TRUE):
						$msg[] = "success";
						$msg[] = $config['pesan']['success']['hapus'];
					else:
						$msg[] = "error";
						$msg[] = $config['pesan']['error']['hapus'].$conn->error;
					endif;
					$conn->commit();
					$conn->rollback();
					$conn->close();
					echo json_encode($msg);
			}
			break;

		case 'quiz':
			if($m === "tmp_jawaban"):
				global $conn;
				//cek dulu 
				$sql = $conn->query("SELECT * FROM tbl_tmp WHERE no='".intval(trim($_POST['number']))."'");
				if($sql->num_rows >= 1):
					//update
					$u = "UPDATE tbl_tmp SET 
							jawaban='".strval(trim($_POST['j']))."'
							WHERE no='".intval(trim($_POST['number']))."'
							AND id_paket='".$_POST['id_paket']."'
							AND id_soal='".$_POST['id_bank']."'
						 ";
					if($conn->query($u) === TRUE){
						echo "Berhasil di update";
					}else{
						echo "Gagal update";
					}
				else:
					//insert
					$q = "INSERT INTO tbl_tmp(no,id_paket,id_soal,jawaban,id_siswa)
							VALUES(
								'".intval(trim($_POST['number']))."',
								'".intval(trim($_POST['id_paket']))."',
								'".intval(trim($_POST['id_bank']))."',
								'".strval(trim($_POST['j']))."',
								'".intval(trim($_POST['id_siswa']))."'
								)
							";
					if($conn->query($q) === TRUE){
						echo "berhasil disimpan";
					}else{
						echo "Gagal menyimpan".$conn->error;
					}
				endif;
			elseif($m === "selesai"):
				global $conn; 
				//TAMPUNG DATA SUBMIT
				$id_bank = trim($_POST['id_bank']);
				$id_paket = trim($_POST['id_paket']);
				$id_siswa = trim($_POST['id_siswa']);
				$sisaWaktu = trim($_POST['sisa_waktu']);

				//tampilkan data dari tbl_tmp kemudian bandingkan dan hapus data di tmp;
				$dt_tmp = $conn->query("SELECT tbl_tmp.* , tbl_koreksi.* , 
										SUM( IF(tbl_tmp.jawaban = tbl_koreksi.jawaban,TRUE,FALSE) ) AS jml_benar, 
										SUM( IF(tbl_tmp.jawaban != tbl_koreksi.jawaban,TRUE,FALSE) ) AS jml_salah 
										FROM tbl_tmp
										LEFT JOIN tbl_koreksi 
										ON tbl_koreksi.id_banksoal = tbl_tmp.id_soal
										WHERE id_siswa='".$id_siswa."'
										");
				$dt_paket = $conn->query("SELECT tbl_paket.*, tbl_banksoal.* , tbl_koreksi.*
										 FROM tbl_paket
										 LEFT JOIN tbl_banksoal ON tbl_banksoal.id_paket = tbl_paket.id_paket
										 LEFT JOIN tbl_koreksi ON tbl_koreksi.id_banksoal = tbl_banksoal.id_bank
										 WHERE tbl_banksoal.id_paket='".$id_paket."'");
					$row = $dt_tmp->fetch_object();
					$row_paket = $dt_paket->fetch_object();
						$kkm = $row_paket->kkm;
						$score_for_one_soal = ceil( 100 / $row_paket->jumlah_soal );
						$score = $row->jml_benar * $score_for_one_soal;
						$status = $score <= $kkm ? "TIDAK LULUS" : "LULUS";
						//update tabel ujian
						$up = "UPDATE tbl_ruang_ujian 
							   SET is_active='1',
							   	   nilai='".$score."',
							   	   jml_benar='".$row->jml_benar."',
							   	   jml_salah='".$row->jml_salah."',
							   	   keterangan='".$status."',
							   	   tgl_waktu='".$_POST['waktu_mulai']."'
							   	WHERE id_siswa='".$id_siswa."'
							   ";
						if($conn->query($up) === TRUE):
							//echo "Berhasil";
							//cek apakah siswa dapat melihat hasil ?
							$conn->query("DELETE FROM tbl_tmp WHERE id_siswa='".$id_siswa."'");
							$cekk = $conn->query("SELECT is_tampilkanHasilDiSiswa 
												FROM tbl_ujian WHERE id='".trim($_POST['id_ujian'])."'")->fetch_object();
							if(intval($cekk->is_tampilkanHasilDiSiswa) === 1){
								echo "quiz.php?p=show-result";
							}else{
								echo "quiz.php?p=destroy";
							}
							//delete data tbl_tmp
							
						else:
							echo "quiz.php?p=start";
						endif;

			else:
				echo "string";//nothing to action
			endif;
			break;

		case 'data-siswa':
			if($m === "update-status"):
				session_start();
				$sts = intval($_POST['is_active']) == 1 ? 0 : 1;
				isActive("tbl_siswa", array(
										'is_active'=>$sts,
										'id_user' => $_SESSION['SES_LOGIN']),
								  array(
										'key' => 'id_siswa',
										'val' => $_POST['id_siswa'])
						);
			else:
				prosesSiswa($m, @$_POST['id_siswa']);
			endif;
			break;

		case 'data-guru':
			if($m === "update-status"):
				$sts = intval($_POST['is_active']) == 1 ? 0 : 1;
				isActive("tbl_guru", array(
										'is_active'=>$sts,
										'id_user' => $_SESSION['SES_LOGIN']),
								  array(
										'key' => 'id_guru',
										'val' => $_POST['id_guru'])
						);
						
			else:
				prosesGuru($m, @$_POST['id_guru']);
			endif;
			break;
		case 'reset':
			if($m === "guru"){
				resetPassword("tbl_guru", $_POST['id']);
			}
			else{
				//siswa
				resetPassword("tbl_siswa", $_POST['id']);
			}
			break;
		//DATA MENU MASTER
		case 'kelas':
			prosesKelas($m, $id);
			break;
		case 'mapel':
			prosesMapel($m, $id);
			break;
		case 'jurusan':
			prosesJurusan($m, $id);
			break;
		//END
			
		default:
			header('location:pages/examples/404.html');
			break;
	}


	function prosesMenu($mod, $id){
		global $conn, $config;
		$msg = array();
		$is_active = array_key_exists("is_active", $_POST) ? 1 : 0;
		if($mod === "tambah"):
			$sql = "INSERT INTO tbl_menu (id,nama,url,icon,is_admin,is_ops,is_active,id_user,updated_at)
					VALUES(
						NULL,
						'".@$_POST['nama']."',
						'".@$_POST['url']."',
						'".@$_POST['icon']."',
						'".@$_POST['is_admin']."',
						'".@$_POST['is_ops']."',
						'".$is_active."',
						3,
						'".@$_SESSION['SES_LOGIN']."',
						'".date('Y-m-d H:i:s')."'
					)
					";

			$conn->autocommit(false);
			if($conn->query($sql) === TRUE){
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['tambah'].$conn->affected_rows;
			}else{
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['tambah'].$conn->error;
			}
			$conn->commit();
			$conn->rollback();
			$conn->close();
		elseif($mod === "edit"):
			$sql = "UPDATE tbl_menu SET
					nama = '".@$_POST['nama']."',
					url = '".@$_POST['url']."',
					icon = '".@$_POST['icom']."',
					is_admin = '".@$_POST['is_admin']."',
					is_ops = '".@$_POST['is_ops']."',
					is_active='".$is_active."',
					id_user='".$_SESSION['SES_LOGIN']."',
					updated_at='".date('Y-m-d H:i:s')."'
					WHERE id='".$id."'
				   ";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['edit'].$conn->affected_rows;
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['edit'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
			
		else:
			$sql = "DELETE FROM tbl_guru
					WHERE id='".$id."'
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
		endif;

		echo json_encode($msg);
	}

	function resetPassword($tbl, $id){
		global $conn;
		$msg = array();
		if($tbl === "tbl_guru"){
			$sql = "UPDATE tbl_guru SET 
					pass=12345678,
					id_user='".$_SESSION['SES_LOGIN']."', 
					updated_at='".date('Y-m-d H:i:s')."'
					WHERE id_guru='".$id."'
					";
					$conn->autocommit(false);
					if($conn->query($sql) === TRUE){
						$msg[] = "success";
						$msg[] = "Password berhasil di reset !";
					}else{
						$msg[] = "error";
						$msg[] = "Password gagal di reset !";
					}
					$conn->commit();
					$conn->rollback();
					$conn->close();
		}else{
			//siswa
			$sql = "UPDATE tbl_siswa SET 
			pwd=12345678, 
			id_user='".$_SESSION['SES_LOGIN']."', 
			updated_at='".date('Y-m-d H:i:s')."'
			WHERE id_siswa='".$id."'
			";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE){
				$msg[] = "success";
				$msg[] = "Password berhasil di reset !";
			}else{
				$msg[] = "error";
				$msg[] = "Password gagal di reset !";
			}
			$conn->commit();
			$conn->rollback();
			$conn->close();
		}
		echo json_encode( $msg );
	}

	function prosesPaket($m = "", $varid){
		global $conn, $config;
		$msg = array();
		if($m === "tambah"){
			//tambah
			$query = "INSERT INTO 
					tbl_paket (id_paket,paket,id_kelas,jumlah_soal,kkm,waktu,id_user,created_at,updated_at)
					VALUES(
					NULL,
					'".$_POST['paket']."',
					'".$_POST['id_kelas']."',
					'".$_POST['jumlah']."',
					'".$_POST['kkm']."',
					'".$_POST['waktu']."',
					'".$_SESSION['SES_LOGIN']."',
					'".date('Y-m-d H:i:s')."',
					'".date('Y-m-d H:i:s')."'
					)
					";
			if($conn->query($query) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['tambah'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['tambah'].$conn->error;
			endif;
			$conn->close();
		}elseif ($m === "edit") {
			//edit
			$sql = "UPDATE tbl_paket SET 
					paket='".$_POST['paket']."',
					id_kelas='".$_POST['id_kelas']."',
					jumlah_soal='".$_POST['jumlah']."',
					kkm='".$_POST['kkm']."',
					waktu='".$_POST['waktu']."',
					id_user='".$_SESSION['SES_LOGIN']."',
					updated_at='".date('Y-m-d H:i:s')."' WHERE id_paket='".$varid."'";
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['edit'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['edit'].$conn->error;
			endif;
			$conn->close();
		}else{
			//delete di banksoal kemudian delete di paket
			$sql = "DELETE tbl_banksoal.*, tbl_koreksi.*, tbl_paket.*
					FROM tbl_banksoal
					RIGHT JOIN tbl_koreksi ON tbl_banksoal.id_bank = tbl_koreksi.id_banksoal
					RIGHT JOIN tbl_paket ON tbl_banksoal.id_paket = tbl_paket.id_paket
					WHERE tbl_paket.id_paket='".$varid."'
					";
			//jika success delete paket
			//$sql = "DELETE FROM tbl_paket WHERE id_paket='".$varid."'";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();

		}
		echo json_encode($msg);
	}#paket

	function prosesSoal($modul = "", $id = ""){
		global $conn, $config;
		$msg = array();
		
		if($modul === "create"):
		
			$sql = "INSERT INTO tbl_banksoal
					(id_bank, id_paket, q,a,b,c,d,e, id_user, is_active, created_at, updated_at)
					VALUES(
						NULL,
						'".@$_POST['id_paket']."',
						'".htmlspecialchars(@$_POST['q'],ENT_HTML5)."',
						'".htmlspecialchars(@$_POST['a'],ENT_HTML5)."',
						'".htmlspecialchars(@$_POST['b'],ENT_HTML5)."',
						'".htmlspecialchars(@$_POST['c'],ENT_HTML5)."',
						'".htmlspecialchars(@$_POST['d'],ENT_HTML5)."',
						'".htmlspecialchars(@$_POST['e'],ENT_HTML5)."',
						1,
						'".$_SESSION['SES_LOGIN']."',
						'".date('Y-m-d H:i:s')."',
						'".date('Y-m-d H:i:s')."'
					)
				   ";
				   $conn->autocommit(FALSE);
				   $pesan = $ps = "";
				if($conn->query($sql) === TRUE):
					$save = $conn->query("INSERT INTO 
										  tbl_koreksi(id_jawaban, id_banksoal,jawaban)
										  VALUES(NULL,'".$conn->insert_id."','".@$_POST['j']."')
										");
						if($save === TRUE):
							$pesan = "jawaban berhasil disimpan !";
						else:
							$ps = "Gagal menyimpan jawaban !".$conn->error;
						endif;
					$msg[] = "success";
					$msg[] = $config['pesan']['success']['tambah']." | ".$pesan .$ps;
				else:
					$msg[] = "error";
					$msg[] = $config['pesan']['error']['tambah'].$conn->error;
				endif;
				$conn->commit();
				$conn->rollback();
				$conn->close();

		elseif($modul === "edit"):
			$sql   = "UPDATE tbl_banksoal SET
					  q='".htmlspecialchars(@$_POST['q'],ENT_HTML5)."',
					  a='".htmlspecialchars(@$_POST['a'],ENT_HTML5)."',
					  b='".htmlspecialchars(@$_POST['b'],ENT_HTML5)."',
					  c='".htmlspecialchars(@$_POST['c'],ENT_HTML5)."',
					  d='".htmlspecialchars(@$_POST['d'],ENT_HTML5)."',
					  e='".htmlspecialchars(@$_POST['e'],ENT_HTML5)."',
					  id_user='".$_SESSION['SES_LOGIN']."',
					  updated_at='".date('Y-m-d H:i:s')."'
					  WHERE id_bank = '".$_POST['id_bank']."'
					 ";
				   $conn->autocommit(FALSE);
				   $pesan = $ps = "";
				if($conn->query($sql) === TRUE):
					$save = $conn->query("UPDATE tbl_koreksi 
										  SET jawaban = '".$_POST['j']."'
										  WHERE id_banksoal='".$_POST['id_bank']."'
										 ");
						if($save === TRUE):
							$pesan = "jawaban berhasil di ubah !";
						else:
							$ps = "Gagal mengubah jawaban !".$conn->error;
						endif;
					$msg[] = "success";
					$msg[] = $config['pesan']['success']['edit']." | ".$pesan .$ps;
				else:
					$msg[] = "error";
					$msg[] = $config['pesan']['error']['edit'].$conn->error;
				endif;
				$conn->commit();
				$conn->rollback();
				$conn->close();
		else : 
			$sql = "DELETE tbl_banksoal, tbl_koreksi
					FROM tbl_banksoal, tbl_koreksi  
					WHERE tbl_koreksi.id_banksoal= tbl_banksoal.id_bank
					AND tbl_banksoal.id_bank='".$_POST['id_bank']."'
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();

		endif;

		echo json_encode($msg);
	}
//ujian
	function prosesUjian($mod = "" , $id = ""){
		global $conn, $config;
		$msg = array();
		$is_active = array_key_exists("is_active", $_POST) ? 1 : 0;
		$is_tampilkanHasilDiSiswa = array_key_exists("is_tampilkanHasilDiSiswa", $_POST) ? 1 : 0;
		if( $mod === "tambah"):
			$sql   = "INSERT INTO tbl_ujian
						(kode,guru_pengawas,id_paket,id_jurusan,is_active,is_tampilkanHasilDiSiswa,id_user,updated_at,created_at)
						VALUES(
							'".trim(@$_POST['kode'])."',
							'".trim(@$_POST['id_guru'])."',
							'".trim(@$_POST['id_paket'])."',
							'".trim(@$_POST['id_jurusan'])."',
							'".$is_active."',
							'".$is_tampilkanHasilDiSiswa."',
							'".@$_SESSION['SES_LOGIN']."',
							'".date('Y-m-d H:i:s')."',
							'".date('Y-m-d H:i:s')."'
						)
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE){
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['tambah'].$conn->affected_rows;
			}else{
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['tambah'].$conn->error;
			}
			$conn->commit();
			$conn->rollback();
			$conn->close();
		elseif( $mod === "edit"):
			$query = "UPDATE  tbl_ujian SET 
						guru_pengawas='".@$_POST['id_guru']."',
						id_paket='".@$_POST['id_paket']."',
						id_jurusan='".@$_POST['id_jurusan']."',
						is_active='".$is_active."',
						is_tampilkanHasilDiSiswa='".$is_tampilkanHasilDiSiswa."',
						id_user='".$_SESSION['SES_LOGIN']."',
						updated_at='".date('Y-m-d H:i:s')."'
						WHERE id='".$id."'
			";
			$conn->autocommit(false);
			if($conn->query($query) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['edit'].$conn->affected_rows;
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['edit'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
			
		else: 
			$sql = "DELETE tbl_ujian.*, tbl_ruang_ujian.* FROM tbl_ujian
					LEFT JOIN tbl_ruang_ujian ON tbl_ruang_ujian.id_ujian = tbl_ujian.id
					WHERE tbl_ujian.id='".$id."'
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
		endif;

		echo json_encode( $msg );
	}
//siswa
	function prosesSiswa($mod = "" , $id = ""){
		global $conn, $config;
		$msg = array();
		$is_active = array_key_exists("is_active", $_POST) ? 1 : 0;
		if( $mod === "tambah"):
			$jur    = explode("|", trim(@$_POST['jurusan']));
			$noreg  = "U".substr($_POST['nis'], 0,3).kode_acak();
			$pwd    = kode_acak()."\$".substr($_POST['nama'], 0,2);
			
			$sql   = "INSERT INTO tbl_siswa
						(id_siswa,nis,nama,noreg,pwd,id_kelas,id_jurusan,is_active,id_level,id_user,updated_at,created_at)
						VALUES(
							NULL,
							'".trim(@$_POST['nis'])."',
							'".trim(@$_POST['nama'])."',
							'".$noreg."',
							'".$pwd."',
							'".trim(@$_POST['id_kelas'])."',
							'".$jur[0]."',
							'".$is_active."',
							4,
							'".@$_SESSION['SES_LOGIN']."',
							'".date('Y-m-d H:i:s')."',
							'".date('Y-m-d H:i:s')."'
						)
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE){
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['tambah'].$conn->affected_rows;
			}else{
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['tambah'].$conn->error;
			}
			$conn->commit();
			$conn->rollback();
			$conn->close();
		elseif( $mod === "edit"):
			$jur    = explode("|", trim(@$_POST['jurusan']));
			$query = "UPDATE  tbl_siswa SET 
						nis='".@$_POST['nis']."',
						nama='".@$_POST['nama']."',
						id_gender='".@$_POST['gender']."',
						alamat='".@$_POST['alamat']."',
						no_tlp='".@$_POST['no_tlp']."',
						id_kelas='".@$_POST['id_kelas']."',
						id_jurusan='".$jur[0]."',
						is_active='".$is_active."',
						id_user='".$_SESSION['SES_LOGIN']."',
						updated_at='".date('Y-m-d H:i:s')."'
						WHERE id_siswa='".$id."'
			";
			$conn->autocommit(false);
			if($conn->query($query) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['edit'].$conn->affected_rows;
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['edit'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
			
		else: 
			$sql = "DELETE FROM tbl_siswa
					WHERE id_siswa='".$id."'
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
		endif;

		echo json_encode( $msg );
	}
	
	function isActive($tbl = "", $data=array(), $where = array()){
		global $conn;$msg=array();
		$sql = "UPDATE $tbl SET 
						is_active='".$data['is_active']."', 
						id_user='".$data['id_user']."', 
						updated_at='".date('Y-m-d H:i:s')."' 
						WHERE ".$where['key']."='".$where['val']."'";
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = "Berhasil merubah status ";
			else:
				$msg[] = "error";
				$msg[] = "Gagal merubah status".$conn->error;
			endif;
			echo json_encode($msg);
	}

	function prosesGuru($mod, $id){
		global $conn, $config;
		$msg = array();
		$is_active = array_key_exists("is_active", $_POST) ? 1 : 0;
		if($mod === "tambah"):
			$pass = kode_acak()."\$".substr($_POST['nama'], 0,2);
			$sql = "INSERT INTO tbl_guru (id_guru,nip,nama,pass,is_active,id_level,id_user,created_at,updated_at)
					VALUES(
						NULL,
						'".@$_POST['nip']."',
						'".@$_POST['nama']."',
						'".$pass."',
						'".$is_active."',
						3,
						'".@$_SESSION['SES_LOGIN']."',
						'".date('Y-m-d H:i:s')."',
						'".date('Y-m-d H:i:s')."'
					)
					";

			$conn->autocommit(false);
			if($conn->query($sql) === TRUE){
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['tambah'].$conn->affected_rows;
			}else{
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['tambah'].$conn->error;
			}
			$conn->commit();
			$conn->rollback();
			$conn->close();
		elseif($mod === "edit"):
			$sql = "UPDATE tbl_guru SET
					nip = '".@$_POST['nip']."',
					nama = '".@$_POST['nama']."',
					id_gender='".@$_POST['gender']."',
					alamat='".@$_POST['alamat']."',
					no_tlp='".@$_POST['no_tlp']."',
					is_active='".$is_active."',
					id_user='".$_SESSION['SES_LOGIN']."',
					updated_at='".date('Y-m-d H:i:s')."'
					WHERE id_guru='".$id."'
				   ";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['edit'].$conn->affected_rows;
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['edit'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
			
		else:
			$sql = "DELETE FROM tbl_guru
					WHERE id_guru='".$id."'
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
		endif;

		echo json_encode($msg);
	}

	//mennu master
	function prosesKelas($mod, $id){
		global $conn, $config;
		$msg = array();
		if($mod === "tambah"):
			$sql = "INSERT INTO tbl_kelas (id_kelas,kelas,id_user,created_at,updated_at)
					VALUES(
						NULL,
						'".trim($_POST['kelas'])."',
						'".@$_SESSION['SES_LOGIN']."',
						'".date('Y-m-d H:i:s')."',
						'".date('Y-m-d H:i:s')."'
					)
					";

			$conn->autocommit(false);
			if($conn->query($sql) === TRUE){
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['tambah'].$conn->affected_rows;
			}else{
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['tambah'].$conn->error;
			}
			$conn->commit();
			$conn->rollback();
			$conn->close();
		elseif($mod === "edit"):
			$sql = "UPDATE tbl_kelas SET
					kelas='".trim($_POST['kelas'])."',
					updated_at='".date('Y-m-d H:i:s')."',
					id_user='".$_SESSION['SES_LOGIN']."'
					WHERE id_kelas='".$id."'
				   ";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['edit'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['edit'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
			
		else:
			$sql = "DELETE FROM tbl_kelas
					WHERE id_kelas='".$id."'
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
		endif;

		echo json_encode($msg);
	}
	//mapel
	function prosesMapel($mod, $id){
		global $conn, $config;
		$msg = array();
		if($mod === "tambah"):
			$sql = "INSERT INTO tbl_mapel (id_mapel,mapel,id_user,created_at,updated_at)
					VALUES(
						NULL,
						'".trim($_POST['mapel'])."',
						'".@$_SESSION['SES_LOGIN']."',
						'".date('Y-m-d H:i:s')."',
						'".date('Y-m-d H:i:s')."'
					)
					";

			$conn->autocommit(false);
			if($conn->query($sql) === TRUE){
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['tambah'].$conn->affected_rows;
			}else{
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['tambah'].$conn->error;
			}
			$conn->commit();
			$conn->rollback();
			$conn->close();
		elseif($mod === "edit"):
			$sql = "UPDATE tbl_mapel SET
					mapel = '".trim($_POST['mapel'])."',
					id_user='".$_SESSION['SES_LOGIN']."',
					updated_at='".date('Y-m-d H:i:s')."'
					WHERE id_mapel='".$id."'
				   ";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['edit'].$conn->affected_rows;
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['edit'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
			
		else:
			$sql = "DELETE FROM tbl_mapel
					WHERE id_mapel='".$id."'
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
		endif;

		echo json_encode($msg);
	}
	//jurusan
	
	function prosesJurusan($mod, $id){
		global $conn, $config;
		$msg = array();
		if($mod === "tambah"):
			$sql = "INSERT INTO tbl_jurusan (kd_jurusan,jurusan,id_user,created_at,updated_at)
					VALUES(
						'".trim($_POST['kd_jurusan'])."',
						'".trim($_POST['jurusan'])."',
						'".@$_SESSION['SES_LOGIN']."',
						'".date('Y-m-d H:i:s')."',
						'".date('Y-m-d H:i:s')."'
					)
					";

			$conn->autocommit(false);
			if($conn->query($sql) === TRUE){
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['tambah'].$conn->affected_rows;
			}else{
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['tambah'].$conn->error;
			}
			$conn->commit();
			$conn->rollback();
			$conn->close();
		elseif($mod === "edit"):
			$sql = "UPDATE tbl_jurusan SET
					kd_jurusan = '".trim(@$_POST['kd_jurusan'])."',
					jurusan = '".trim($_POST['jurusan'])."',
					id_user='".$_SESSION['SES_LOGIN']."',
					updated_at='".date('Y-m-d H:i:s')."'
					WHERE id_jurusan='".$id."'
				   ";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['edit'].$conn->affected_rows;
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['edit'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
			
		else:
			$sql = "DELETE FROM tbl_jurusan
					WHERE id_jurusan='".$id."'
					";
			$conn->autocommit(false);
			if($conn->query($sql) === TRUE):
				$msg[] = "success";
				$msg[] = $config['pesan']['success']['hapus'];
			else:
				$msg[] = "error";
				$msg[] = $config['pesan']['error']['hapus'].$conn->error;
			endif;
			$conn->commit();
			$conn->rollback();
			$conn->close();
		endif;

		echo json_encode($msg);
	}
 ?>

