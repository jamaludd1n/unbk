
<?php 
if(strval($_SESSION['SES_LOGIN_LEVEL']) === "admin"):
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $mod = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    if($mod === "details"):
  $d = $conn->query("SELECT 
                      tbl_ujian.kode,
                      tbl_siswa.nis, tbl_siswa.nama,tbl_siswa.id_siswa,
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

                      WHERE tbl_ruang_ujian.id='".$id."'")->fetch_object();
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
<div class="card">
	<div class="header clearfix">

		<a href="#" onclick="window.history.back()" class="btn btn-default  pull-left">
			<i class="material-icons">undo</i>
		</a>
    <a href="" data-id="<?= $d->id_siswa ?>"  class="btn btn-default  pull-right print">
      <i class="material-icons">print</i>
    </a>
    <a href="" data-id="<?= $d->id_siswa ?>"  class="btn btn-success  pull-right download">
      <i class="material-icons">file_download</i>
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
</div>
<?php else: ?>
<div class="card">
	<div class="body">
		<p>
            <h4 class="text-center">PANDUAN RUANG UJIAN</h4>
            <ul>
                <li>Disini admin hanya dapat memantap jalanya ujian</li>
                <li>Admin dapat melihat siswa yang sedang melaksanakan ujian atau pun yang sudah</li>
                <li>Admin dapat mencetak report hasil ujian berdasarkan filter data yang disediakan </li>
            </ul>
		</p>
	</div>
</div>
<div class="card">
	<div class="body">
		 <table id="ruang-ujian" class="table  table-striped table-hover dataTable" width="100%">
			<thead>
				<tr>
					<th class="hide">ID</th>
					<th scope="row">No</th>
                    <th>Nama Lengkap</th>
					<th>Kode/Paket</th>
					<th>Kelas/Jurusan</th>
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
                      <form id="print_download">
                          <div class="modal-header bg-indigo " style="padding-bottom:20px;">
                              <h4 class="modal-title" id="label">
                                <i class='material-icons'>local_bar</i>
                                <strong>FILTER </strong>
                              </h4>
                          </div>
                        <div class="modal-body">
                                     <!-- coontent -->
                        <br>
                                    
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <div class="form-group">
                              <div class="form-line">
                                <input type="hidden" class="tipe" name="status" value="d">
                                <?php 
                                  $p = $conn->query("SELECT tbl_paket.paket , tbl_ujian.kode
                                                    FROM tbl_ujian
                                                    LEFT JOIN tbl_paket ON tbl_paket.id_paket = tbl_ujian.id_paket
                                                    WHERE tbl_ujian.id='".$_GET['id']."'
                                                    ")->fetch_object();

                                ?>
                                  <input class="form-control input-lg" type="text" readonly value="<?= $p->kode;?> | <?= $p->paket;?>" required>
                              </div>                            
                                </div>
                            </div>
                        </div>


                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                        <div class="form-group">
                                <select name="id_kelas" id="id_kelas" class="form-control show-tick" required>
                                <option value="">
                                  PILIH KELAS
                                </option>
                                    <?php 
                                        $re = $conn->query("SELECT * FROM tbl_kelas");
                                        while($ro = $re->fetch_object()):
                                     ?>
                                    <option value="<?= $ro->id_kelas;?>" ><?= strtoupper($ro->kelas);?></option>
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
                          <select id="id_jurusan" name="id_jurusan" class="form-control show-tick" required>
                          <option value="">
                            PILIH JURUSAN
                          </option>
                                    <?php 
                                        $res = $conn->query("SELECT * FROM tbl_jurusan");
                                        while($r = $res->fetch_object()):
                                     ?>
                                    <option value="<?= $r->id_jurusan;?>"> <?= strtoupper($r->jurusan);?></option>
                                    <?php 
                                        endwhile; 
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                          </div>
                          <div class="modal-footer">
                              <button type="submit" class="btn bg-indigo btn-lg waves-effect btn-modal">
                                SAVE CHANGES
                              </button>
                              <button id="close" type="button" class="btn btn-lg bg-grey waves-effect" data-dismiss="modal">
                                CLOSE
                              </button>
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