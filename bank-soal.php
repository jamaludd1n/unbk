
<?php 
if(strval($_SESSION['SES_LOGIN_LEVEL']) === "admin" || strval($_SESSION['SES_LOGIN_LEVEL']) === "operator"):
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $mod = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    if($mod == "edit") :
        $row    = $conn->query("SELECT  
            tbl_paket.*,
            tbl_kelas.id_kelas, tbl_kelas.kelas
            FROM tbl_paket 
            LEFT JOIN tbl_kelas 
            ON tbl_paket.id_kelas = tbl_kelas.id_kelas 
            WHERE tbl_paket.id_paket = '".$id."' 
            ")->fetch_object();

            $idp    = $row->id_paket;
            $paket = $row->paket;
            $kelas = $row->id_kelas;
            $jml      = $row->jumlah_soal;
            $kkm      = $row->kkm;
            $waktu    = $row->waktu;
            $now       = date("Y-m-d H:i:s");
            $id_user   = $_SESSION['SES_LOGIN'];

        ?>
<div class="card">
    <div class="header">
        <i class="material-icons">edit</i>
        	<span style='font-size:25px; font-family:gergia'>  Edit Record</span>
        
			<a href="<?= site_url('bank-soal');?>" class="btn btn-default btn-sm pull-right">
					<i class="material-icons">undo</i>
			</a>
    </div>
    <div class="body">
        <form id="fedit">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="paket">Paket Soal</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                    	<input type="hidden" name="id_paket" value="<?= $idp?>"> 
                        <select name="paket" class="form-control show-tick">
                                <?php 
                                    $res = $conn->query("SELECT * FROM tbl_mapel");
                                    while($r = $res->fetch_object()):
                                        if(strtolower($paket) === strtolower($r->mapel)):
                                            $cek = "selected";
                                        else:
                                            $cek = "";
                                        endif;
                                 ?>
                                <option value="<?= strtoupper($r->mapel);?>" <?= $cek ?>><?= strtoupper($r->mapel);?></option>
                                <?php 
                                    endwhile; 
                                ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="kelas">Kelas</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                            <select name="id_kelas" class="form-control show-tick">
                                <?php 
                                    $re = $conn->query("SELECT * FROM tbl_kelas");
                                    while($ro = $re->fetch_object()):
                                        if(intval($kelas) === intval($ro->id_kelas)):
                                            $c = "selected";
                                        else:
                                            $c = "";
                                        endif;
                                 ?>
                                <option value="<?= $ro->id_kelas;?>" <?= $c ?>><?= strtoupper($ro->kelas);?></option>
                                <?php 
                                    endwhile; 
                                ?>
                            </select>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="jumlah">Jumlah Soal</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                            <select name="jumlah" class="form-control show-tick">
                                <?php
                                    for($i = 5; $i <= 200; $i+=5 ):
                                        if($i === intval($jml)):
                                            $x = "selected";
                                        else:
                                            $x = "";
                                        endif;
                                 ?>
                                <option value="<?= $i;?>" <?= $x ?>><?= ($i);?></option>
                                <?php 
                                    endfor; 
                                ?>
                            </select>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="kkm">KKM</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                            <select name="kkm" class="form-control show-tick">
                                <?php
                                    for($i = 10; $i <= 100; $i++ ):
                                        if($i === intval($kkm)):
                                            $z = "selected";
                                        else:
                                            $z = "";
                                        endif;
                                 ?>
                                <option value="<?= $i;?>" <?= $z ?>><?= ($i);?></option>
                                <?php 
                                    endfor; 
                                ?>
                            </select>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                    <label for="waktu">Waktu </label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="form-group">
                            <select name="waktu" class="form-control show-tick">
                                <?php
                                    for($i = 5; $i <= 240; $i+=5 ):
                                        if($i === intval($waktu)):
                                            $y = "selected";
                                        else:
                                            $y = "";
                                        endif;
                                 ?>
                                <option value="<?= $i;?>" <?= $y ?>><?= ($i)." Menit";?></option>
                                <?php 
                                    endfor; 
                                ?>
                            </select>
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
                        	<a href="<?= site_url('bank-soal')?>" class="btn bg-grey btn-lg">
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



<div class="card animated slideInRight">
	<div class="body" id="k">
		<p>
			<h4 class="text-center">PANDUAN MANAJEMEN DATA SOAL DAN PAKET SOAL</h4>
            <ul>
                <li>
                    Untuk menambahkan Paket Soal , admin harus mengisi data mata pelajaran dan kelas
                </li>
                <li>Kemudian isi data seperti KKM, Durasi Waktu, juga jumlah soal yang akan diberikan</li>
                <li>
                    Paket soal hanya akan aktif jika jumlah soal sama dengan jumlah soal paket dan atau lebih.
                </li>
            </ul>
		</p>
	</div>
</div>
<div class="card  animated slideInUp">
	<div class="body">
		 <table id="bank-soal" class="table  table-striped table-hover dataTable" width="100%">
			<thead>
				<tr>
					<th class="hide">ID</th>
					<th>No</th>
					<th>Paket</th>
					<th>Kelas</th>
					<th>Jumlah</th>
					<th>Waktu</th>
                    <th>Status</th>
					<th>
						Action
					</th>
				</tr>
			</thead>
			<tbody>
				
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
								        <input type="hidden" name="id_paket" value="0"/>
								            <select id="paket" name="paket" class="form-control show-tick">
													<option value="null">
														PILIH PAKET SOAL
													</option>
								                    <?php 
								                        $res = $conn->query("SELECT * FROM tbl_mapel");
								                        while($r = $res->fetch_object()):
								                     ?>
								                    <option value="<?= strtoupper($r->mapel);?>"> <?= strtoupper($r->mapel);?></option>
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
								                <select name="id_kelas" id="id_kelas" class="form-control show-tick">
													<option value="null">
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
											<div class="form-line">
											    <input class="form-control" type="number" name="jumlah" placeholder="jumlah:">
											</div>														
								        </div>
								    </div>
								</div>
														
								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group">
											<div class="form-line">
											    <input class="form-control" type="number" name="kkm" placeholder="KKM :">
											</div>														
								        </div>
								    </div>
								</div>
														
								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group">
											<div class="form-line">
											    <input class="form-control" type="number" name="waktu" placeholder="Waktu mengerjakan (menit)">
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


             <!-- modal report --> 
            <!-- Modal Dialogs ====================================================================================================================== -->
            <!-- Default Size -->
            <div class="modal fade" id="modalReport" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form id="report-data-paket">
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