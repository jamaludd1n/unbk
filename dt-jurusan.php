
<?php 
if(strval($_SESSION['SES_LOGIN_LEVEL']) === "admin" || strval($_SESSION['SES_LOGIN_LEVEL']) === "operator"):
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $mod = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    if($mod == "edit") :
		$sql = $conn->query("SELECT * FROM tbl_jurusan WHERE id_jurusan='".$id."'")->fetch_object();
        ?>
<div class="card">
    <div class="header">
        <i class="material-icons">edit</i>
        	<span style='font-size:25px; font-family:gergia'>  Edit Record</span>
        
			<a href="<?= site_url('jurusan');?>" class="btn bg-indigo btn-sm pull-right">
					<i class="material-icons">undo</i>
			</a>
    </div>
    <div class="body">
        <form id="fedit">

        	<div class="row clearfix">
        		<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
        			<div class="form-group">
        				<div class="form-line">
        					<input type="hidden" value="<?= $id ?>" name="id">
        					<input class="form-control input-lg" type="text" name="kd_jurusan" value="<?= $sql->kd_jurusan?>" required>
						</div>														
			       </div>
			    </div>
			</div>
			<div class="row clearfix">
        		<div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
        			<div class="form-group">
        				<div class="form-line">
        					<input type="hidden" value="<?= $id ?>" name="id_jurusan">
        					<input class="form-control input-lg" type="text" name="jurusan" value="<?= $sql->jurusan?>" required>
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
                        	<a href="<?= site_url('jurusan')?>" class="btn bg-grey btn-lg">
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



<div class="card">
	<div class="body">
		 <table id="data-jurusan" class="table table-striped table-hover dataTable" width="100%">
			<thead>
				<tr>
					<th class="hide">ID</th>
					<th>No</th>
					<th>Jurusan</th>
					<th class="text-center">
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
								<br>
														
								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group">
											<div class="form-line">
												<input type="hidden" name="id" value="0">
											    <input class="form-control input-lg" type="text" name="kd_jurusan" placeholder="Kode :" required>
											</div>														
								        </div>
								    </div>
								</div>				
								<div class="row clearfix">
								    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
								        <div class="form-group">
											<div class="form-line">
												<input type="hidden" name="id" value="0">
											    <input class="form-control input-lg" type="text" name="jurusan" placeholder="jurusan :" required>
											</div>														
								        </div>
								    </div>
								</div>
								
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