
<?php 
if(strval($_SESSION['SES_LOGIN_LEVEL']) === "admin" || strval($_SESSION['SES_LOGIN_LEVEL']) === "operator"):
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $mod = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    if($mod == "edit") :
		$sql = $conn->query("SELECT * FROM tbl_siswa WHERE id_siswa='".$id."'")->fetch_object();
		$id_kelas = $sql->id_kelas;
		$jur 	 = $sql->id_jurusan;
		$is_active = $sql->is_active;
		$gender = $sql->id_gender;
        ?>
<div class="card">
    <div class="header">
        <i class="material-icons">edit</i>
        	<span style='font-size:25px; font-family:gergia'>  Edit Record</span>
        
			<a href="<?= site_url('data-siswa');?>" class="btn bg-indigo btn-sm pull-right">
					<i class="material-icons">undo</i>
			</a>
    </div>
    <div class="body">
        <form id="fedit">
			<div class="col-md-6">
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
					<label>NIS</label>
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="number" name="nis" value="<?= $sql->nis?>" required>
							</div>														
						</div>
					</div>
				</div>
														
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
					<label> Nama Lengkap </label>
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" name="nama" value="<?= $sql->nama;?>" required>
							</div>														
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
						<div class="form-group">
						<label>Kelas </label>
							<select name="id_kelas" id="id_kelas" class="form-control show-tick" required>
								<option value="null">
									PILIH KELAS
								</option>
								<?php 
								$re = $conn->query("SELECT * FROM tbl_kelas");
								while($ro = $re->fetch_object()):
									$cek = $id_kelas === $ro->id_kelas ? "selected" : "";
								?>
								<option value="<?= $ro->id_kelas;?>" <?= $cek ?>>
								<?= strtoupper($ro->kelas);?>
								</option>
								<?php 
								endwhile; 
								?>
								</select>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
						<label>Jurusan</label>
						<div class="form-group"> 
							<input type="hidden" name="id_siswa" value="<?= $id ?>"/>
							<select id="jurusan" name="jurusan" class="form-control show-tick" required>
								<option value="null">
									PILIH JURUSAN
								</option>
								<?php 
								$res = $conn->query("SELECT * FROM tbl_jurusan");
								while($r = $res->fetch_object()):
									$sel = $jur === $r->id_jurusan ? "selected" : "";
								?>
								<option value="<?= $r->id_jurusan."|". $r->kd_jurusan."|".strtoupper($r->jurusan);?>" <?= $sel ?>>
								<?= strtoupper($r->jurusan);?>
								</option>
								<?php 
								endwhile; 
								?>
							</select>
						</div>
					</div>
				</div>					
				
			</div><!-- colom 1 -->		

			<div class="col-md-6">						
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
						<label>Jenis Kelamin</label>
						<div class="form-group">
							<div class="form-line">
	                            <div class="demo-radio-button">
	                            	<?php 
	                            		$gen = $conn->query("SELECT * FROM tbl_gender");
	                            		while($gt = $gen->fetch_object()):
	                            			$checked = $gender === $gt->id ? "checked" : "";
	                            	 ?>
	                                <input name="gender" value="<?= $gt->id?>" type="radio" id="<?= $gt->gender?>" class="radio-col-indigo" <?= $checked?>/>
	                                <label for="<?= $gt->gender;?>"><?= $gt->keterangan?></label>
	                            <?php endwhile;?>
	                            </div>
							</div>														
						</div>
					</div>
				</div>						
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
						<label>Alamat</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" name="alamat" value="<?= $sql->alamat?>">
							</div>														
						</div>
					</div>
				</div>						
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
						<label>No. Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" name="no_tlp" value="<?= $sql->no_tlp?>">
							</div>														
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="switch m-t-10">
								<?php $ck = $is_active == 1 ? "checked" : "";?>
								<label>Status 
                                	<input name="is_active" value="<?= $is_active?>" type="checkbox" <?= $ck?>>
									<span class="lever switch-col-blue"></span>
                                </label>
							</div>
						</div>
					</div>
				</div>

			</div>			
								

            <div class="row clearfix">
                <div class="col-md-4 col-md-offset-8">
                    <div class="form-group">
                        <div class="pull-right">
                        	<a href="<?= site_url('data-siswa')?>" class="btn bg-grey btn-lg">
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
			<h4 class="text-center">MANAJEMEN AKUN/DATA SISWA</h4>
			<ul>
				<li>Admin bisa melakukan operasi crud (Create, Read, Update dan Delete) pada akun siswa</li>
				<li>Admin bisa menon-aktifkan akun siswa, sehingga siswa tidak dapat login tanpa izin admin</li>
				<li>Untuk menambahkan akun siswa cukup mengisi NIS, Nama lengkap, kelas dan jurusan</li>
			</ul>
		</p>
	</div>
</div>
<div class="card  animated slideInUp">
	<div class="body">
		 <table id="data-siswa" class="table table-striped table-hover dataTable" width="100%">
			<thead>
				<tr>
					<th class="hide">ID</th>
					<th>No</th>
					<th>NIS</th>
					<th>NO. REG</th>
					<th>Nama Lengkap</th>
					<th>Kelas</th>
                    <th>Status</th>
                    <th>Password</th>
					<th class="text-center">
						Action
					</th>
					<th class="hide">status</th>
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
											<div class="form-line">
											    <input class="form-control" type="number" name="nis" placeholder="NIS :" required>
											</div>														
								        </div>
								    </div>
								</div>
														
								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group">
											<div class="form-line">
											    <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap : " required>
											</div>														
								        </div>
								    </div>
								</div>

								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group">
								                <select name="id_kelas" id="id_kelas" class="form-control show-tick" required>
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
								        <input type="hidden" name="id_siswa" value="0"/>
								            <select id="jurusan" name="jurusan" class="form-control show-tick" required>
													<option value="null">
														PILIH JURUSAN
													</option>
								                    <?php 
								                        $res = $conn->query("SELECT * FROM tbl_jurusan");
								                        while($r = $res->fetch_object()):
								                     ?>
								                    <option value="<?= $r->id_jurusan."|". $r->kd_jurusan."|".strtoupper($r->jurusan);?>"> <?= strtoupper($r->jurusan);?></option>
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
								                    <label>Status 
                                                    <input name="is_active" value="" type="checkbox"><span class="lever switch-col-blue" required></span>
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


            <!-- modal report --> 
            <!-- Modal Dialogs ====================================================================================================================== -->
            <!-- Default Size -->
            <div class="modal fade" id="modalReport" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form id="report-data-siswa">
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