<?php if(!empty($_POST)):
	//upload foto 
	if(is_file($_FILES['file']['tmp_name'])){
		move_uploaded_file($_FILES['file']['tmp_name'], "images/".basename($_FILES['file']['name']));
	}
	$sql = "UPDATE tbl_user SET
			nama='".trim($_POST['nama'])."',
			username='".trim($_POST['username'])."',
			password='".trim($_POST['password'])."',
			photo='images/".basename($_FILES['file']['name'])."'
			WHERE id_users='".intval(trim($_POST['id']))."'
		";
	$msg = $type = "";
	if($conn->query($sql) === TRUE):
		$msg = "BERHASIL DI PERBARUI !";
		$type = "success";
	else:
		$msg = "GAGAL DI PERBARUI !";
		$type = "danger";
	endif;
?>
		<div class="alert alert-<?= $type ?> animated slideInRight">
			<?= $msg; ?>
		</div>
<?php else: ?>
	<div class="alert alert-info">
		<strong>Data Profile anda !</strong>
	</div>
<?php endif; ?>

<?php 

	$sql = $conn->query("SELECT tbl_level.level, tbl_user.nama,tbl_user.password,tbl_user.photo, tbl_user.username
	 FROM tbl_user 
		LEFT JOIN tbl_level ON tbl_level.id_level = tbl_user.level
		WHERE tbl_user.id_users='".$_SESSION['SES_USER_ID']."'")->fetch_object();

 ?>
<div class="card animated slideInUp">
    <div class="body">
        <form action="<?PHP $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
        	<div class="col-md-6">
				<div class="row clearfix">
					<div class="col-md-12 col-sm-8 col-xs-7">
					<label>Nama Lengkap</label>
						<div class="form-group">
							<div class="form-line">
								<input type="hidden" name="id" value="<?= $_SESSION['SES_USER_ID'] ?>">
								<input class="form-control" type="text" name="nama" value="<?= $sql->nama;?>" required>
							</div>														
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12 col-sm-8 col-xs-7">
					<label>Username</label>
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" name="username" value="<?= $sql->username;?>" required>
							</div>														
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12 col-sm-8 col-xs-7">
					<label>Password</label>
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" name="password" value="<?= $sql->password;?>" required>
							</div>														
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12 col-sm-8 col-xs-7">
					<label>Level</label>
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" readonly value="<?= $sql->level;?>" required>
							</div>														
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row clearfix">
					<div class="col-md-12 col-sm-8 col-xs-7">
					<label>Photo Profile</label>
						<div class="form-group">
							<div class="form-line">
								<img src="<?= $sql->photo?>" width="200" height="200" class="img">
								<br>
								<label class="btn btn-danger" style="margin-top:10px;cursor:hand">
									<i class="material-icons">photo</i>
									Ganti Profile
								</label>
								<input type="file" accept="image/*" class="file" name="file" style="z-index:10; position:relative;opacity:0;top:-50px;width:100%;height:50px;cursor:pointer">
							</div>														
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12 col-sm-8 col-xs-7">
					<label>&nbsp;</label>
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-lg bg-indigo pull-right">SIMPAN</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>					
</div>