
<?php 
if(strval($_SESSION['SES_LOGIN_LEVEL']) === "admin" || strval($_SESSION['SES_LOGIN_LEVEL']) === "operator"):
	$mod = isset($_GET['mod']) ? $_GET['mod'] : NULL;
	if($mod === "create"):
 ?>
	<div class="card">
		<div class="body">
			<div class="text-center">
				<h1 id="title">TAMBAH DATA </h1>
				<?php
					$sql = $conn->query("SELECT tbl_paket.*, tbl_banksoal.* 
										 FROM tbl_banksoal 
										 RIGHT JOIN tbl_paket 
										 ON tbl_banksoal.id_paket =  tbl_paket.id_paket
										 WHERE tbl_paket.id_paket='".$id."'");
					$row = $sql->fetch_object();
					$jm  = $conn->query("SELECT COUNT(*) AS jumlah_data 
										 FROM tbl_banksoal 
										 WHERE id_paket='".$id."'")->fetch_object();
					$no  = "";
					if($jm->jumlah_data < 1):
						$no = 1;
					else :
						$rw = $jm->jumlah_data;
						$no = $rw + 1; 
					endif;
				?>
				<p>
					<strong>PTS. <?= strtoupper($row->paket);?></strong>
				</p>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="header">	
        	<span style='font-size:25px; font-family:gergia'> 
				NO. <strong><?= $no ?></strong></span>
			<a href="<?= site_url('isi-soal&id=').$_GET['id'];?>" class="btn bg-indigo btn-sm pull-right">
					<i class="material-icons">undo</i>
			</a>
		</div>
		<div class="body">
			<form id="ftambah-soal">
				<div class="form-group form-float">
					<div class="form-inline">
						<p>
							<strong class="label bg-indigo">Pertanyaan </strong>
						</p>
						<input type="hidden" name="id_paket" value="<?= $id; ?>">
						<input type="hidden" name="p" value="<?= $_GET['p']?>">
						<input type="hidden" name="mod" value="<?= $mod;?>">
						<input type="hidden" name="id_bank" value="">
						<textarea id="q" name="q" class="form-control" required>
						</textarea>	
					</div>
				</div>

				<div class="form-group form-float">
					<div class="form-inline">
						<p>
							<strong class="label bg-indigo">Jawaban A</strong>
						</p>
						<textarea id="a" name="a" class="form-control" required></textarea>	
					</div>
				</div>
				<div class="form-group form-float">
					<div class="form-inline">
						<p>
							<strong class="label bg-indigo">Jawaban B</strong>	
						</p>
						<textarea id="b" name="b" class="form-control" required></textarea>	
					</div>
				</div>
				<div class="form-group form-float">
					<div class="form-inline">
						<p>
							<strong class="label bg-indigo">Jawaban C</strong>
						</p>
						<textarea id="c" name="c" class="form-control" required></textarea>	
					</div>
				</div>
				<div class="form-group form-float">
					<div class="form-inline">
						<p>
							<strong class="label bg-indigo">Jawaban D</strong>
						</p>
						<textarea id="d" name="d" class="form-control" required></textarea>	
					</div>
				</div>
				<div class="form-group form-float">
					<div class="form-inline">
						<p>
							<strong class="label bg-indigo">Jawaban E</strong>
						</p>
						<textarea id="e" name="e" class="form-control" required></textarea>	
					</div>
				</div>
				<div class="form-group">
					<div class="form-inline">
						<p>
							<strong class="label bg-indigo">Kunci Jawaban</strong>
						</p>
						<div class="col-md-9 col-md-offset-1">
                            <div class="demo-radio-button">
                                <input name="j" value="a" type="radio" id="ja" class="with-gap radio-col-indigo" />
                                <label for="ja">A</label>
                                <input name="j" value="b" type="radio" id="jb" class="with-gap radio-col-deep-purple" />
                                <label for="jb">B</label>
                                <input name="j" value="c" type="radio" id="jc" class="with-gap radio-col-purple" />
                                <label for="jc">C</label>
                                <input name="j" value="d" type="radio" id="jd" class="with-gap radio-col-pink" />
                                <label for="jd">D</label>
                                <input name="j" value="e" type="radio" id="je" class="with-gap radio-col-red" />
                                <label for="je">E</label>
                            </div>
						</div>
					</div>
				</div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="status">&nbsp; </label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="pull-right">
                        	<a href="#" onclick="window.history.back()" class="btn bg-grey btn-lg">
                        		BATAL
                        	</a>
                            <button class="btn bg-indigo btn-lg" type="submit">
                                SIMPAN
                            </button>
                        </div>
                    </div>
                </div>
            </div>
			</form>
		</div>
	</div>
<?php 
	elseif($mod === "edit"):
 ?>
 <div class="card">
	 <div class="body">
		 <div class="text-center">
			 <h1 id="title">EDIT DATA SOAL</h1>
			 <?php
				 $row = $conn->query("SELECT * FROM tbl_banksoal 
				 					  WHERE id_bank='".$_GET['id_bank']."'")->fetch_object();
			 ?>
		 </div>
	 </div>
 </div>

 <div class="card">
		<div class="header">	
			<a href="#" onclick="window.history.back()" class="btn bg-indigo btn-sm pull-right">
					<i class="material-icons">undo</i>
			</a>
		</div>
	 <div class="body">
		 <form id="fedit-soal">
			 <div class="form-group">
				 <div class="form-inline">
					 <p>
						 <strong class="label bg-indigo">Pertanyaan </strong>
					 </p>
					 <input type="hidden" name="id_paket" value="<?= $id; ?>">
					 <input type="hidden" name="p" value="<?= $_GET['p']?>">
					 <input type="hidden" name="mod" value="<?= $mod;?>">
					 <input type="hidden" name="id_bank" value="<?= $_GET['id_bank'] ?>">
					 <input type="hidden" name="is_active" value="<?= $row->is_active?>">
					 <textarea id="q" name="q" class="form-control">
					 	<?= htmlspecialchars_decode($row->q)?>
					 </textarea>	
				 </div>
			 </div>


			 <div class="form-group">
				 <div class="form-inline">
					 <p>
						 <strong class="label bg-indigo">Jawaban A</strong>
					 </p>
					 <textarea id="a" name="a" class="form-control">
					 <?= htmlspecialchars_decode($row->a)?>
					 </textarea>	
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="form-inline">
					 <p>
						 <strong class="label bg-indigo">Jawaban B</strong>	
					 </p>
					 <textarea id="b" name="b" class="form-control">
					 <?= htmlspecialchars_decode($row->b)?>
					 </textarea>	
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="form-inline">
					 <p>
						 <strong class="label bg-indigo">Jawaban C</strong>
					 </p>
					 <textarea id="c" name="c" class="form-control">
					 <?= htmlspecialchars_decode($row->c)?>
					 </textarea>	
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="form-inline">
					 <p>
						 <strong class="label bg-indigo">Jawaban D</strong>
					 </p>
					 <textarea id="d" name="d" class="form-control">
					 <?= htmlspecialchars_decode($row->d)?>
					 </textarea>	
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="form-inline">
					 <p>
						 <strong class="label bg-indigo">Jawaban E</strong>
					 </p>
					 <textarea id="e" name="e" class="form-control">
					 <?= htmlspecialchars_decode($row->e)?>
					 </textarea>	
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="form-inline">
					 <p>
						 <strong class="label bg-indigo">Kunci Jawaban</strong>
					 </p>
					 <div class="col-md-9 col-md-offset-1">
						 <div class="demo-radio-button">
						 <?php
						  $dt  = $conn->query("SELECT * FROM tbl_koreksi WHERE id_banksoal='".$_GET['id_bank']."'")->fetch_object(); 
						  $val = ['a','b','c','d','e'];
						  for($i=0; $i<count($val); $i++):
							if($dt->jawaban == $val[$i]){
								$cek = "checked";
							}else{
								$cek = ""; 
							}
						 ?>
						 	<input name="j" value="<?=$val[$i]?>" type="radio" id="j<?=$val[$i]?>" class="with-gap radio-col-indigo" <?=$cek?>/>
							<label for="j<?=$val[$i]?>"><?=strtoupper($val[$i])?></label>
						<?php endfor; ?>
						 </div>
					 </div>
				 </div>
			 </div>

		 <div class="row clearfix">
			 <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
				 <label for="status">&nbsp; </label>
			 </div>
			 <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
				 <div class="form-group">
					 <div class="pull-right">
						 <a href="#" onclick="window.history.back()" class="btn bg-grey btn-lg">
							 BATAL
						 </a>
						 <button class="btn bg-indigo btn-lg" type="submit">
							 SIMPAN
						 </button>
					 </div>
				 </div>
			 </div>
		 </div>
		 </form>
	 </div>
 </div>
<?php 
	else:
 ?>
<div class="card">
	<div class="body">
		<div class="text-center">
		<?php 
			$query = $conn->query("SELECT tbl_paket.*, tbl_banksoal.* , tbl_kelas.*
								FROM tbl_banksoal 
								RIGHT JOIN tbl_paket ON tbl_banksoal.id_paket = tbl_paket.id_paket 
								RIGHT JOIN tbl_kelas ON tbl_paket.id_kelas=tbl_kelas.id_kelas
								WHERE tbl_paket.id_paket ='".$id."'");
							$row =	$query->fetch_object();	
								
			$jmlAktif = $conn->query("SELECT COUNT(is_active) AS jumlah_aktif 
									 FROM tbl_banksoal 
									 WHERE id_paket='".$id."'
									 ")->fetch_object();
		?>
			<h2>PTS. <?= $row->paket?></h2>
			<p>
				Pilihan Ganda : <strong class="label bg-blue"><?= $row->jumlah_soal ?> Soal</strong> 
				&nbsp; &nbsp; | &nbsp; &nbsp;
				Aktif : <strong class="label bg-blue"><?= $jmlAktif->jumlah_aktif ?> Soal</strong>
				&nbsp; &nbsp; | &nbsp; &nbsp;
				Waktu : <strong class="label bg-blue"><?= $row->waktu ?> Menit</strong>
				&nbsp; &nbsp; | &nbsp; &nbsp;
				Kelas : <strong class="label bg-blue"><?= $row->kelas?></strong>
			</p>
		</div>
	</div>
</div>
<div class="card">
	<div class="body">
		<span style="font-size:25px">Daftar soal ujian</span>
			<a href="<?= current_url('&mod=create');?>" class="btn bg-indigo btn-sm">
					<i class="material-icons">add</i>
			</a>
			<a href="<?= site_url('bank-soal');?>" class="btn bg-black btn-sm pull-right">
					<i class="material-icons">undo</i>
			</a>
			<input type="hidden" class="id_paket" value="<?= $_GET['id']?>">
			
				<style>
					.justify{
						text-align:justify;
						text-justify:trim;
					}
				</style>
		 	<table id="isi-soal" class="table dataTable" style="border:none" width="100%">
			<thead>
				<tr>
					<th class="hide">ID</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th class="hide">sts</th>
				</tr>
			</thead>
			<tbody>
				<!-- data loaded here -->
			</tbody>
		</table>
		<!-- card body -->
	</div>	
</div>
<?php 
	endif;
else:
    header('location:pages/examples/404.html');
endif;
 ?>