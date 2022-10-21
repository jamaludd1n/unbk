<?php
	/*
	| @author dede jamaludin 
	| 05/05/2021 
	| ini merupakan file koneksi yang menghubungkan system apps ke database server mysql
	*/ 
	$config = require_once("config.php"); //memanggil configurasi apps/db/dev
	$add    = require_once("resources.php"); //memanggil resources plugin
	require_once("function.php"); // this line is for call the fungsi tambahan;
	/*
	| buat object baru untuk koneksi ke database dengan nama conn
	*/
	$conn = new mysqli(
			$config['db']['host'],
			$config['db']['user'],
			$config['db']['pass'],
			$config['db']['db'],
			$config['db']['port']
		);
	/*
	| cek koneksi
	*/
	if($conn->connect_errno):
	  die($config['pesan']['error']['koneksi']).$conn->connect_error();
	#else:
	  #echo $config['pesan']['success']['koneksi'];
	endif;
	
	require_once("cetak.inc.php");
 ?>