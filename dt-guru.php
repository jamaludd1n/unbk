
<?php 
if(strval($_SESSION['SES_LOGIN_LEVEL']) === "admin" || strval($_SESSION['SES_LOGIN_LEVEL']) === "operator"):
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $mod = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    if($mod == "edit") :
		$sql = $conn->query("SELECT * FROM tbl_guru WHERE id_guru='".$id."'")->fetch_object();
		$is_active = $sql->is_active;
		$gender    = $sql->id_gender; 
        ?>
<div class="card">
    <div class="header">
        <i class="material-icons">edit</i>
        	<span style='font-size:25px; font-family:gergia'>  Edit Record</span>
        
			<a href="<?= site_url('data-guru');?>" class="btn bg-indigo btn-sm pull-right">
					<i class="material-icons">undo</i>
			</a>
    </div>
    <div class="body">
        <form id="fedit">
        	<div class="col-md-6">
        		<div class="row clearfix">
					<div class="col-md-12 col-sm-8 col-xs-7">
					<label>NIP</label>
						<div class="form-group">
							<div class="form-line">
								<input type="hidden" value="<?= $id ?>" name="id_guru">
								<input class="form-control" type="number" name="nip" value="<?= $sql->nip?>" required>
							</div>														
						</div>
					</div>
				</div>
				
				<div class="row clearfix">
					<div class="col-md-12 col-sm-8 col-xs-7">
					<label>Nama Lengkap</label>
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" name="nama" value="<?= $sql->nama;?>" required>
							</div>														
						</div>
					</div>
				</div>						
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

			</div><!-- colom -->
			<div class="col-md-6">			
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
                        	<a href="<?= site_url('data-guru')?>" class="btn bg-grey btn-lg">
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
			<h4 class="text-center">PANDUAN MANAJEMEN DATA GURU</h4>
			<ul type="disk">
				<li>
					Disini admin bisa menambah, mengedit, dan menghapus akun guru
				</li>
				<li>Disini juga admin bisa meng-aktifkan dan menon-aktifkan akun guru</li>
				<li>Untuk menambah akun guru cukup mengisikan <b>NIP</b> dan Nama lengkap </li>
				<li>Guru bisa masuk ke applikasi ini dengan menggunakan NIP dan password </li>
				<li>Password guru akan otomatis dibuatkan oleh system dan guru bisa meminta  admin untuk meresetnya ke 12345678</li>
			</ul>
		</p>
	</div>
</div>
<div class="card animated slideInUp">
	<div class="body">
		 <table id="data-guru" class="table table-striped table-hover dataTable" width="100%">
			<thead>
				<tr>
					<th class="hide">ID</th>
					<th>No</th>
					<th>NIP</th>
					<th>Nama Lengkap</th>
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
												<input type="hidden" name="id" value="0">
											    <input class="form-control input-lg" type="number" name="nip" placeholder="NIP :" required>
											</div>														
								        </div>
								    </div>
								</div>
														
								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group">
											<div class="form-line">
											    <input class="form-control input-lg" type="text" name="nama" placeholder="Nama Lengkap : " required>
											</div>														
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
  <?php 
  	endif;
  	
else:
    header('location:pages/examples/404.html');
endif;
   ?>