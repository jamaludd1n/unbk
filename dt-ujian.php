
<?php 
if(strval($_SESSION['SES_LOGIN_LEVEL']) === "admin"):
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $mod = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    if($mod == "edit") :
        $row    = $conn->query("SELECT 
            tbl_ujian.*
            FROM tbl_ujian 
            LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
            LEFT JOIN tbl_jurusan ON tbl_jurusan.id_jurusan = tbl_ujian.id_jurusan
            WHERE tbl_ujian.id = '".$id."' 
            ")->fetch_object();
            $idp    = $row->id_paket;
            $idj    = $row->id_jurusan;
            $is_active = $row->is_active;
            $is_tampilkanHasilDiSiswa = $row->is_tampilkanHasilDiSiswa;
            $guru = $row->guru_pengawas;

        ?>
<div class="card">
    <div class="header">
        <i class="material-icons">edit</i>
        	<span style='font-size:25px; font-family:gergia'>  Edit Record</span>
        
			<a href="<?= site_url('data-ujian');?>" class="btn btn-default btn-sm pull-right">
					<i class="material-icons">undo</i>
			</a>
    </div>
    <div class="body">
        <form id="fedit">
            <div class="row clearfix">
                <div class="col-md-3 form-control-label">
                    <label for="guru">Guru Pengawas</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <select id="id_guru" name="id_guru" class="form-control show-tick">
                            <option value="null">
                                PILIH GURU PENGAWAS
                            </option>
                            <?php 
                            $res = $conn->query("SELECT * FROM tbl_guru");
                            while($r = $res->fetch_object()):
                                $selected = $guru === $r->id_guru ? "selected" : "";
                            ?>
                            <option value="<?= ($r->id_guru);?>" <?= $selected ?>> <?= strtoupper($r->nama);?></option>
                            <?php 
                            endwhile; 
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="paket">Paket Soal</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                    	<input type="hidden" name="id" value="<?= $id?>"> 
                        <select name="id_paket" class="form-control show-tick">
                                <?php 
                                    $res = $conn->query("SELECT * FROM tbl_paket 
                                            LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_paket.id_kelas");
                                    while($r = $res->fetch_object()):
                                        $cek = $idp === $r->id_paket ? "selected" : "";
                                 ?>
                                <option value="<?= $r->id_paket;?>" <?= $cek ?>><?= strtoupper($r->paket. " ".$r->kelas);?></option>
                                <?php 
                                    endwhile; 
                                ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="kelas">Jurusan</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                            <select name="id_jurusan" class="form-control show-tick">
                                <?php 
                                    $re = $conn->query("SELECT * FROM tbl_jurusan");
                                    while($ro = $re->fetch_object()):
                                        $l = $idj === $ro->id_jurusan ? "selected" : "";
                                 ?>
                                <option value="<?= $ro->id_jurusan;?>" <?= $l ?>><?= strtoupper($ro->kd_jurusan." | ".$ro->jurusan);?></option>
                                <?php 
                                    endwhile; 
                                ?>
                            </select>
                    </div>
                </div>
            </div>


            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="status">Tampilkan hasil di siswa ? </label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                            <div class="switch">
                            <?php $c = $is_tampilkanHasilDiSiswa == 1 ? "checked" : ""; ?>
                                <label>
                                    <input name="is_tampilkanHasilDiSiswa" value="<?= $is_tampilkanHasilDiSiswa ?>" type="checkbox" <?= $c ?>>
                                    <span class="lever switch-col-indigo"></span>
                                </label>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="status">Status </label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                            <div class="switch">
                            <?php $ck = $is_active == 1 ? "checked" : ""; ?>
                                <label>
                                    <input name="is_active" value="<?= $is_active ?>" type="checkbox" <?= $ck ?>>
                                    <span class="lever switch-col-indigo"></span>
                                </label>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="btn">&nbsp; </label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="pull-right">
                        	<a href="<?= site_url('data-ujian')?>" class="btn bg-grey btn-lg">
                        		BATAL
                        	</a>
                            <button class="btn btn-lg bg-indigo" type="submit">
                                SIMPAN
                            </button>
                        </div>
                    </div>
                </div>
            </div>
                    
        </form>
<!-- #funct -->
    </div>
</div>
<?php 
    else:
 ?>



<div class="card  animated slideInRight">
	<div class="body" id="k">
		<p>
			<h4 class="text-center">PANDUAN MANAJEMEN DATA UJIAN/RUANG UJIAN</h4>
            <ul>
                <li>Untuk menambah data ujian admin harus terlebih dahulu mengisi paket soal dan bank soal</li>
                <li>Kelas ujian hanya akan aktif jika  paket soal memiliki bank soal</li>
                <li>admin bisa mereset kode ujian (kode ini merupakan token untuk siswa) hati-hati2 jika sedang ujian berlangsung jangan main klik-klik saja </li>
                <li>Admin bisa memantau siswa dan ruang ujian yang sedang aktif/berlangsung *harap jangan asal klik-klik karna akan berpengaruh pada pelaksanaan ujian</li>
            </ul>
		</p>
	</div>
</div>
<div class="card  animated slideInUp">
	<div class="body">
		 <table id="data-ujian" class="table  table-striped table-hover dataTable" width="100%">
			<thead>
				<tr>
					<th class="hide">ID</th>
					<th scope="row">No</th>
					<th>Kode</th>
					<th>Paket</th>
					<th>Kelas/Jurusan</th>
                    <th>Guru Pengawas</th>
                    <th>Status</th>
					<th>
						Action
					</th>
                    <th class="hide">status_</th>
				</tr>
			</thead>
			<tbody class="table-striped">
				
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Dialogs ====================================================================================================================== -->
            <!-- Default Size -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    	<form id="ftambah">
	                        <div class="modal-header bg-indigo " style="padding-bottom:20px;">
	                            <h4 class="modal-title" id="label">
	                            	<i class='material-icons'>add</i>
	                            	<strong>Tambah data</strong>
	                            </h4>
	                        </div>
	                        <div class="modal-body">
	                           <!-- coontent -->
                               <div id="content_">
								<br>

                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" type="text" name="kode" value="<?= kode_acak() ?>" readonly>
                                            </div>														
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                        <div class="form-group"> 
                                            <select id="id_guru" name="id_guru" class="form-control show-tick">
                                                    <option value="null">
                                                        PILIH GURU PENGAWAS
                                                    </option>
                                                    <?php 
                                                        $res = $conn->query("SELECT * FROM tbl_guru");
                                                        while($r = $res->fetch_object()):
                                                     ?>
                                                    <option value="<?= ($r->id_guru);?>"> <?= strtoupper($r->nama);?></option>
                                                    <?php 
                                                        endwhile; 
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group"> 
								        <input type="hidden" name="id" value="0"/>
								            <select id="id_paket" name="id_paket" class="form-control show-tick">
													<option value="null">
														PILIH PAKET SOAL
													</option>
								                    <?php 
								                        $res = $conn->query("SELECT 
                                                        tbl_paket.id_paket, tbl_paket.paket, tbl_kelas.kelas 
                                                        FROM tbl_paket LEFT JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_paket.id_kelas
                                                        WHERE is_active = '1'
                                                        ");
								                        while($r = $res->fetch_object()):
								                     ?>
								                    <option value="<?= strtoupper($r->id_paket);?>"> <?= strtoupper($r->paket." ".$r->kelas);?></option>
								                    <?php 
								                        endwhile; 
								                    ?>
								            </select>
								        </div>
								    </div>
								</div>
                                
								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group"> 
								            <select id="id_jurusan" name="id_jurusan" class="form-control show-tick">
													<option value="null">
														PILIH JURUSAN
													</option>
								                    <?php 
								                        $res = $conn->query("SELECT * FROM tbl_jurusan");
								                        while($r = $res->fetch_object()):
								                     ?>
								                    <option value="<?= ($r->id_jurusan);?>"> <?= strtoupper($r->kd_jurusan." | ".$r->jurusan);?></option>
								                    <?php 
								                        endwhile; 
								                    ?>
								            </select>
								        </div>
								    </div>
								</div>

                                						
								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group">
								                <div class="switch m-t-10">
								                    <label>Tampilkan hasil di siswa ? 
                                                        <input name="is_tampilkanHasilDiSiswa" value="" type="checkbox"><span class="lever switch-col-blue"></span>
                                                    </label>
                                                    <label>Status 
                                                        <input name="is_active" value="" type="checkbox"><span class="lever switch-col-blue"></span>
                                                    </label>
								                </div>
								        </div>
								    </div>
								</div>
                                
                                </div> <!-- content_ -->
	                        </div>
	                        <div class="modal-footer">
	                            <button type="submit" class="btn bg-indigo btn-lg waves-effect">
	                            	SAVE CHANGES
	                            </button>
	                            <button id="close" type="button" class="btn btn-lg bg-grey waves-effect" data-dismiss="modal">
	                            	CLOSE
	                            </button>
                                <button type="reset" class="reset hide">reset</button>
	                        </div>
	                    </form>
                    </div>
                </div>
            </div>
  <?php 
  	endif;
else:
    header('location:pages/examples/404.html');
endif;
   ?>