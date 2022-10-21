<?php 
	/*
	* @author  dede jamaludin	
	* Fungsi ini untuk membuat kode acak string
	* return all function module 
	* return @string
	*/ 

	function kode_acak(){
		$str = 
			chr( rand(ord("A"), ord("Z")) ).
			chr( rand(ord("a"), ord("z")) ).
			chr( rand(ord("Z"), ord("A")) ).
			mt_rand( 100,1000 );
			return $str;
	}
	
	#modul tambahan
	function url($source = ""){
			global $config;
				if (!empty($source)){
					return $config['app']['url']."/".$source;	
					exit;
				}
		}
	function site_url($page=""){
		global $config;
		return url($config['app']['index']."?p=".$page);
	}
	function current_url($str = ""){
		$url = "";
		if(!empty($str)){
			$url .= "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].$str; 
		}else{
			$url .= "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		}
		return $url;
	}
		//redirect page
		function redirect($url = ""){
			if(!empty($url)){
				return "<script> window.location='$url'</script>";
				exit;
			}
		}
	#modul untuk membolak balik date sql and php
	# Using -
			# ex : 2016-12-12 (Y-M-D) FROM (D-M-Y)
		function stripSQL($str=""){
			$ex = explode('-', $str);
			if(count($ex) >= 1){
				$data = $ex[2]."-".$ex[1]."-".$ex[0];
				return $data;
				exit;
			}
		}
		//slash sql date
		function slashSQL($str=""){
			$ex = explode('/', $str);
			if(count($ex) >= 1){
				$data = $ex[2]."-".$ex[1]."-".$ex[0];
				return $data;
				exit;
			}
		}



		# using strip for sql datetime(Y-M-D H:M:S) FROM (D-M-Y H:M:S)
		function stripSQL_datetime($datetime){
			$myDateTime = explode(" ",$datetime);
			if(count($myDateTime) == 2):
				$cDateTime = $this->stripSQL(trim($myDateTime[0]," "))." ".trim($myDateTime[1]," ");
				return $cDateTime;
			endif;
		}

		function generateCode($conn, $tbl, $inisial) {
			$db 	= $conn;
			$angka 	= 0;
			$query 	= $db->query("SELECT * FROM $tbl");
			$get 	= $query->fetch_field(); //get ALL
			$len    = $get->length; //ambil jmlh panjang kode
			$maxField = $db->query("SELECT MAX($get->name)FROM $tbl");
			$data 	  = $maxField->fetch_array(MYSQLI_NUM);

			# CEK ADA DATA ATAU TIDAK DIBARIS PERTAMA 
			if ($data[0] == "") {
				$angka 	= 0;
			}
			else {
				$angka  = substr($data[0], strlen($inisial)); 
				// set nilai angka dengan data di atas
				/*
				* contoh String KS0001
				* length inisial = 2 (KS)
				* KS0001 - 2 = 0001
				*
				*/
			}
			$angka++; //berikan 1 untuk angka
			$angka = strval($angka);
			$mid   = NULL;
			for ($i=1; $i <= ($len - strlen($inisial) - strlen($angka)) ; $i++) { 
				$mid = $mid ."0";
			}
			return $inisial.$mid.$angka;
		}

		/*
	* return @string
	*/
	function cetak(){
		return "<script>window.print()</script>";
	}

	function include_file ($url = []){
		if(!is_array($url)){
			return include_once($url);
		}
		if(count($url) > 1 ){
			for($i = 0; $i < count($url); $i++){
				return include($url[$i]);
			}
		}else{
			return include_once($url[0]);	
		}
	}

 ?>