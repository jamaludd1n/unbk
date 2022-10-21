<?php 
	/*
	* author dede jamaludin
	* this file is for controling data table. 
	* after geting data from database and return json file.
 	*/
	error_reporting(E_ALL);
	require_once("connection.php");
	$page = isset($_GET['p']) ? trim(strtolower($_GET['p'])) : NULL;
	switch ($page) {
		case 'bank-soal':
			echo showPaketSoal();
			break;

		case 'isi-soal':
			echo showBankSoal($_GET['id']);
			break;
			
	    case 'data-ujian':
			echo showUjian();
			break;
			
	    case 'ruang-ujian':
			echo showRuangUjian();
			break;
		
	    case 'data-guru':
			echo showGuru();
			break;

	    case 'data-siswa':
			echo showSiswa();
			break;

		//case master
	    case 'kelas':
			echo showKelas();
			break;
	    case 'mapel':
			echo showMapel();
			break;
	    case 'jurusan':
			echo showJurusan();
			break;

		default:
			header('location:pages/examples/404.html');
			break;
	}
	// Paket Soal
	function showPaketSoal(){
		global $conn;
		$sqlQuery = "SELECT tbl_kelas.kelas, tbl_paket.* 
					 FROM tbl_paket 
					 LEFT JOIN tbl_kelas 
					 ON tbl_paket.id_kelas=tbl_kelas.id_kelas";
		$result = $conn->query($sqlQuery);
			//#server
		$no = 1;
		$row = array();
		$btn_aksi = null;
		while ( $r = $result->fetch_object() )
		{	
			$hapus = "<a href='#' title='Hapus data !' class='btn bg-red waves-effect hapus' id='".$r->id_paket."'><i class='material-icons'>delete</i></a>";
			$edit  = "<a href='".site_url('bank-soal&mod=edit&id=').$r->id_paket."' class='btn bg-blue waves-effect edit' id='".$r->id_paket."'><i class='material-icons'>edit</i></a>";
			$isi   = "<a href='".site_url('isi-soal&id=').$r->id_paket."' class='btn bg-green waves-effect isi' id='".$r->id_paket."'> <i class='material-icons'>filter_1</i></a>";
			$btn_aksi = $hapus ." ".$edit." ".$isi;


			$ready  = $conn->query("SELECT COUNT(*) AS jumlahSoalReady FROM tbl_banksoal
								WHERE id_paket = '".$r->id_paket."' AND is_active='1'
								")->fetch_object();

			if($ready->jumlahSoalReady === $r->jumlah_soal){
				$conn->query("UPDATE tbl_paket SET is_active='1' WHERE id_paket='".$r->id_paket."'");
			}
			$row[] = array(
				0 => $r->id_paket,
				1 => $no++,
				2 => strtoupper($r->paket),
				3 => $r->kelas,
				4 => $r->jumlah_soal." Soal",
				5 => $r->waktu." Menit",
				6 => ( ($ready->jumlahSoalReady === $r->jumlah_soal) ? "<i style='font-size:15px' class='btn btn-success btn-sm' disabled>Ready</i>" : "<i class='btn btn-danger btn-sm' disabled>Not Ready</i>"),
				7 => $btn_aksi

			);
		}


		$output = array(
			"draw" => null,
			"recordsTotal" => $result->num_rows,
			"recordsFiltered" => $result->num_rows,
			'data' => $row
		);
		
		return json_encode( $output );
	}
	# paket soal

	#banksoal
	function showBankSoal($id){
		$data = array();
		global $conn;
		$sql = $conn->query("SELECT * FROM tbl_banksoal WHERE id_paket='".$id."'");
			$i = 1;
			while($soal = $sql->fetch_object()):
				$q = "<div id='soal_'>".htmlspecialchars_decode($soal->q)."</div>";
				$a = "
				<ol type='A'>
				<li>". htmlspecialchars_decode($soal->a)."</li>
				<li>". htmlspecialchars_decode($soal->b)."</li>
				<li>". htmlspecialchars_decode($soal->c)."</li>
				<li>". htmlspecialchars_decode($soal->d)."</li>
				<li>". htmlspecialchars_decode($soal->e)."</li>
				</ol>
				";
				$icon  = intval($soal->is_active) === 1 ? "visibility" : "visibility_off"; 
				$bg  = intval($soal->is_active) === 1 ? "bg-green" : "bg-blue-grey"; 
				$act = "
					<a href='#' id='".$soal->id_bank ."' class='btn $bg waves-effect is_active'>
						<i class='material-icons'>".$icon."</i>
					</a>
					<a href=".site_url('isi-soal&mod=edit&id_bank='.$soal->id_bank)."  class='btn bg-blue btn-sm'>
						<i class='material-icons'>edit</i>
					</a>
					<a href='' id='".$soal->id_bank ."'  class='btn bg-red btn-sm hapus'>
						<i class='material-icons'>delete</i>
					</a>
				";
				$data[] = array(
					0 => $soal->id_bank,
					1 => "<strong class='label bg-primary'>".$i++."</strong>",
					2 => $q."<br>".$a,
					3 => $act,
					4 => $soal->is_active
				);
			endwhile;
		$output = array(
			"draw" => null,
			"recordsTotal" => $sql->num_rows,
			"recordsFiltered" => $sql->num_rows,
			'data' => $data
		);
		return json_encode( $output ); 
	}

	//ujian
	function showUjian(){
		global $conn;
		$sqlQuery = "SELECT 
						tbl_ujian.id, tbl_ujian.kode, tbl_ujian.is_active,
						tbl_paket.paket,
						tbl_jurusan.jurusan,
						tbl_kelas.kelas,
						tbl_guru.nama
					FROM tbl_ujian
					LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
					LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_paket.id_kelas
					LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_ujian.id_jurusan
					LEFT JOIN tbl_guru ON tbl_guru.id_guru = tbl_ujian.guru_pengawas
					";
		$result = $conn->query($sqlQuery);
			//#server
		$no = 1;
		$row = array();
		$btn_aksi = null;
		while ( $r = $result->fetch_object() )
		{	$active = "
					<a href='#' id='".$r->id ."' class='btn bg-green waves-effect waves-circle waves-float btn-circle is_active'>
						<i class='material-icons'>repeat</i>
					</a>";
			$hapus = "<a href='#' class='btn bg-red waves-effect waves-circle waves-float btn-circle hapus' id='".$r->id."'>
						<i class='material-icons'>delete</i>
					</a>";
			$edit  = "<a href='".site_url('data-ujian&mod=edit&id=').$r->id."' 
						class='btn bg-blue waves-effect waves-circle waves-float btn-circle edit' id='".$r->id."'>
						<i class='material-icons'>edit</i>
					 </a>";
			$more  = "<a href='".site_url('ruang-ujian&mod=monitor&id=').$r->id."' 
						class='btn bg-deep-purple waves-effect waves-circle waves-float btn-circle more' id='".$r->id."'>
						<i class='material-icons'>arrow_forward</i>
					 </a>";
			$btn_aksi = $active." ". $hapus ." ".$edit." ".$more;
			$btn   = "<a href='#' class='btn  bg-indigo waves-effect waves-circle waves-float btn-circle renew' id='".$r->id."'>
						<i class='material-icons'>autorenew</i>
					  </a>";
			$row[] = array(
				0 => $r->id,
				1 => $no++,
				2 => $btn." ".$r->kode,
				3 => strtoupper($r->paket),
				4 => $r->kelas." / ".strtoupper($r->jurusan),
				5 => strtoupper($r->nama),
				6 =>  ( (intval($r->is_active) === 1) ? "<i style='font-size:15px' class='btn btn-success btn-sm' disabled>Active</i>" : "<i class='btn btn-danger btn-sm' disabled>Not Active</i>"),
				7 => $btn_aksi,
				8 => $r->is_active

			);
		}


		$output = array(
			"draw" => null,
			"recordsTotal" => $result->num_rows,
			"recordsFiltered" => $result->num_rows,
			'data' => $row
		);
		
		return json_encode( $output );
	}

	//ruang ujian 
	function showRuangUjian(){
		global $conn;
		$sqlQuery = "SELECT 
						tbl_ruang_ujian.id, tbl_ujian.kode, tbl_ruang_ujian.is_active,
						tbl_paket.paket,
						tbl_jurusan.jurusan,
						tbl_kelas.kelas,
						tbl_siswa.nama, tbl_siswa.id_siswa
					FROM tbl_ruang_ujian
					LEFT JOIN tbl_ujian ON tbl_ujian.id = tbl_ruang_ujian.id_ujian
					LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
					LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_paket.id_kelas
					LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_ujian.id_jurusan
					LEFT JOIN tbl_siswa ON tbl_ruang_ujian.id_siswa = tbl_siswa.id_siswa
					";
		$result = $conn->query($sqlQuery);
			//#server
		$no = 1;
		$row = array();
		$btn_aksi = null;
		while ( $r = $result->fetch_object() )
		{	$active = "
					<a href='#' id='".$r->id ."' class='btn bg-green waves-effect waves-circle waves-float btn-circle is_active'>
						<i class='material-icons'>repeat</i>
					</a>";
			$hapus = "<a href='#' class='btn bg-red waves-effect waves-circle waves-float btn-circle hapus' id='".$r->id."'>
						<i class='material-icons'>delete</i>
					</a>";
			$more  = "<a href='".site_url('ruang-ujian&mod=details&id=').$r->id."' 
						class='btn bg-deep-purple waves-effect waves-circle waves-float btn-circle more' id='".$r->id."'>
						<i class='material-icons'>arrow_forward</i>
					 </a>";
			$btn_aksi = $active." ". $hapus ." ".$more;
			$row[] = array(
				0 => $r->id,
				1 => $no++,
				2 => strtoupper($r->nama),
				3 => $r->kode." / ".strtoupper($r->paket),
				4 => $r->kelas." / ".strtoupper($r->jurusan),
				5 =>  ( (intval($r->is_active) === 1) ? "<i style='font-size:15px' class='btn btn-success btn-sm' disabled>Active</i>" : "<i class='btn btn-danger btn-sm' disabled>Not Active</i>"),
				6 => $btn_aksi,
				7 => $r->is_active

			);
		}


		$output = array(
			"draw" => null,
			"recordsTotal" => $result->num_rows,
			"recordsFiltered" => $result->num_rows,
			'data' => $row
		);
		
		return json_encode( $output );
	}
	//siswa
	function showSiswa(){
		$data = array();
		global $conn;

		$sql = $conn->query("SELECT tbl_siswa.id_siswa,tbl_siswa.nis, tbl_siswa.nama, 
					 tbl_siswa.noreg,tbl_siswa.pwd,tbl_siswa.is_active,
					 tbl_kelas.kelas, tbl_jurusan.jurusan 
				FROM tbl_siswa 
				LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
				LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_siswa.id_jurusan
				WHERE 1
				");
		$i = 1;
		while($row = $sql->fetch_object()){
		
			$act = "
				<a href='#' id='".$row->id_siswa ."' class='btn bg-green btn-sm is_active'>
					<i class='material-icons'>repeat</i>
				</a>
				<a href=".site_url('data-siswa&mod=edit&id='.$row->id_siswa)."  class='btn bg-blue btn-sm edit'>
					<i class='material-icons'>edit</i>
				</a>
				<a href='#' id='".$row->id_siswa ."'  class='btn bg-red btn-sm hapus'>
					<i class='material-icons'>delete</i>
				</a>
			";
			
			$link_reset = "<a href='#' id='".$row->id_siswa ."' class='btn btn-warning btn-sm reset-pass'>
								 <i class='material-icons'>autorenew</i>
							</a>
							<a href='#' id='".$row->pwd ."' class='btn btn-info btn-sm lihat-pass'>
								 <i class='material-icons'>visibility</i>
							</a>";
				$data[] = array(
				0 => $row->id_siswa,
				1 => $i++,
				2 => $row->nis,
				3 => $row->noreg,
				4 => strtoupper($row->nama),
				5 => $row->kelas ." | ".$row->jurusan,
				6 => ( (intval($row->is_active) === 1) ? "<i style='font-size:15px' class='btn btn-success btn-sm' disabled>Active</i>" : "<i class='btn btn-danger btn-sm' disabled>Not Active</i>"),
				7 => $link_reset,
				8 => $act  ,
				9 => $row->is_active
			);
		}		
		$output = array(
			"draw" => null,
			"recordsTotal" => $sql->num_rows,
			"recordsFiltered" => $sql->num_rows,
			'data' => $data
		);
		return json_encode( $output ); 
	}

	function showGuru(){
		$data = array();
		global $conn;

		$sql = $conn->query("SELECT * FROM tbl_guru");
		$i = 1;
		while($row = $sql->fetch_object()){
		
			$act = "<a href='#' id='".$row->id_guru ."' class='btn bg-green btn-sm is_active'>
						<i class='material-icons'>repeat</i>
					</a>
					<a href=".site_url('data-guru&mod=edit&id='.$row->id_guru)."  class='btn bg-blue btn-sm edit'>
						<i class='material-icons'>edit</i>
					</a>
					<a href='#' id='".$row->id_guru."'  class='btn bg-red btn-sm hapus'>
						<i class='material-icons'>delete</i>
					</a>
				";
			$link_reset = "<a href='#' id='".$row->id_guru ."' class='btn btn-warning btn-sm reset-pass'>
								 <i class='material-icons'>autorenew</i>
							</a>
							<a href='#' id='".$row->pass ."' class='btn btn-info btn-sm lihat-pass'>
								 <i class='material-icons'>visibility</i>
							</a>";
				$data[] = array(
				0 => $row->id_guru,
				1 => $i++,
				2 => $row->nip,
				3 => strtoupper($row->nama),
				4 => ( (intval($row->is_active) === 1) ? "<i style='font-size:15px' class='btn btn-success btn-sm' disabled>Active</i>" : "<i class='btn btn-danger btn-sm' disabled>Not Active</i>"),
				5 => $link_reset,
				6 => $act  ,
				7 => $row->is_active
			);
		}		
		$output = array(
			"draw" => null,
			"recordsTotal" => $sql->num_rows,
			"recordsFiltered" => $sql->num_rows,
			'data' => $data
		);
		return json_encode( $output ); 
	}

	//Baris untuk menu master 
	function showKelas(){
		global $conn;
		$sqlQuery = "SELECT * FROM tbl_kelas";
		$result = $conn->query($sqlQuery);
			//#server
		$no = 1;
		$row = array();
		$btn_aksi = null;
		while ( $r = $result->fetch_object() )
		{
			$hapus = "<a href='#' class='btn bg-red waves-effect hapus' id='".$r->id_kelas."'>HAPUS</a>";
			$edit  = "<a href='".site_url('kelas&mod=edit&id=').$r->id_kelas."' class='btn bg-blue waves-effect edit' id='".$r->id_kelas."'>UBAH</a>";
			$btn_aksi = $hapus ." ".$edit;
			$row[] = array(
				0 => $r->id_kelas,
				1 => $no++,
				2 => strtoupper($r->kelas),
				3 => $btn_aksi

			);
		}


		$output = array(
			"draw" => null,
			"recordsTotal" => $result->num_rows,
			"recordsFiltered" => $result->num_rows,
			'data' => $row
		);
		
		return json_encode( $output );
	}

	//mapel
	function showMapel(){
		global $conn;
		$sqlQuery = "SELECT * FROM tbl_mapel";
		$result = $conn->query($sqlQuery);
			//#server
		$no = 1;
		$row = array();
		$btn_aksi = null;
		while ( $r = $result->fetch_object() )
		{
			$hapus = "<a href='#' class='btn bg-red waves-effect hapus' id='".$r->id_mapel."'>HAPUS</a>";
			$edit  = "<a href='".site_url('mapel&mod=edit&id=').$r->id_mapel."' class='btn bg-blue waves-effect edit' id='".$r->id_mapel."'>UBAH</a>";
			$btn_aksi = $hapus ." ".$edit;
			$row[] = array(
				0 => $r->id_mapel,
				1 => $no++,
				2 => strtoupper($r->mapel),
				3 => $btn_aksi

			);
		}


		$output = array(
			"draw" => null,
			"recordsTotal" => $result->num_rows,
			"recordsFiltered" => $result->num_rows,
			'data' => $row
		);
		
		return json_encode( $output );
	}
	//jurusan
	function showJurusan(){
		global $conn;
		$sqlQuery = "SELECT * FROM tbl_jurusan";
		$result = $conn->query($sqlQuery);
			//#server
		$no = 1;
		$row = array();
		$btn_aksi = null;
		while ( $r = $result->fetch_object() )
		{
			$hapus = "<a href='#' class='btn bg-red waves-effect hapus' id='".$r->id_jurusan."'>HAPUS</a>";
			$edit  = "<a href='".site_url('jurusan&mod=edit&id=').$r->id_jurusan."' class='btn bg-blue waves-effect edit' id='".$r->id_jurusan."'>UBAH</a>";
			$btn_aksi = $hapus ." ".$edit;
			$row[] = array(
				0 => $r->id_jurusan,
				1 => $no++,
				2 => $r->kd_jurusan." | ".strtoupper($r->jurusan),
				3 => $btn_aksi

			);
		}


		$output = array(
			"draw" => null,
			"recordsTotal" => $result->num_rows,
			"recordsFiltered" => $result->num_rows,
			'data' => $row
		);
		
		return json_encode( $output );
	}
 ?>