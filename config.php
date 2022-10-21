<?php 
return [
		/*
		| Baris di bawah ini merupakan baris untuk mengatur applikasi
		| seperti mengatur nama applikasi, folder, url, dan lain2
		*/

		'app' => [
			'nama'	   => 'Sistem Informasi Ujian Online berbasi Web',
			'dir'	   => 'unbk',//ini juga rubah sesuai folder
		    'url' 	   => 'http://localhost/unbk', //edit url disini 
		    'index'	   => 'main.php', //jangan di rubah atau app error
		    'timezone' => 'Asia/Jakarta',
		    'sekolah'  => [
		    	'nama' 		=> 'SMK AL-AMIN TANJUNGJAYA',
		    	'alamat' 	=> 'Jln. Cibunigeulis Desa Sukasenang Kec. Tanjungjaya Kab. Tasikmalaya',
		    	'nss'		=> 402021216049,
		    	'npsn'		=> 20258084,
		    	'email'		=> 'smkalamintanjungjaya@gmail.com',
		    	'kepsek'	=> 'Dede Jamaludin' //just a dream wkwk wkwk 
		    ],
		    'created'		=> '2021-05-04 21:45:40'
		],

		/*
		| Baris di bawah ini merupakan baris untuk mengatur koneksi
		| database dengan driver mysqli, silahkan sesuaikan datanya
		*/

		'db' => [
			'host'   => 'localhost',
			'user' 	   => 'root',
			'pass' => '',
			'db'  => 'db_ujianku',
			'port' 	   => 3306
		],
		

		    #Baris dibawah ini merupakan baris untuk memberikan pesan dalam applikasi
		    'pesan'    => [
		    	'success' => [
		    		'login' 	=> 'Selamat anda berhasil login !',
		    		'tambah'	=> 'Data berhasil di tambahkan !',
		    		'edit'		=> 'Data berhasil di ubah !',
		    		'hapus' 	=> 'Data berhasil di hapus !',
		    		'koneksi'   => 'Koneksi berhasil !'
		    	],
		    	'error'   => [
		    		'login'		=> 'Maaf data yang anda masukan salah !',
		    		'tambah'    => 'Data gagal di tambahkan !',
		    		'edit' 		=> 'Data gagal di ubah !',
		    		'hapus'		=> 'Data gagal di hapus !',
		    		'koneksi'   => 'Koneksi gagal !'
		    	]		    				
		    ],
		    #baris ini khusus untuk author applikasi, silahkan sesuaikan
		    'dev'      => [
		    	'nama' 		=> 'Dede Jamaludin',
		    	'email'		=> 'dedejamaludin1@gmail.com',
		    	'phone' 	=> '+6282124153410',
		    	'facebook'  => 'http://web.facebook.com/dj.waalker',
		    	'github' 	=> '@devtaskio'
		    ],

		    'envinfo' => [
		    	'Versi PHP' => phpversion(),
		    	'User Agent' => $_SERVER['HTTP_USER_AGENT'],
		    	'Sistem Operasi' => getenv("OS"),
		    	'Architecture' => getenv('PROCESSOR_ARCHITECTURE')
		    ],

		    //system recomended
		    'spek' => [
		    	'Web Server <code>PHP  Version 7 or higher </code>',
		    	'Database Server <code> MariaDB MySQL 5.0 </code>',
		    	'Extension <code>MySQLI </code>'
		    ],

		    //Help guide for apps 
		    'petunjuk' => [
		    	'Buat <b>jurusan</b>, silahkan isi dengan nama jurusan di sekolahnya masing-masing seperti <b>RPL/TKJ/IPA/IPS</b> dll.',
		    	'Buat Kelas, silahkan dengan nama kelas seperti kelas <b> X/XI/XII </b>',
		    	'Buat Mata Pelajaran, silahkan isi dengan Mapel yang tersedia seperti <b>Bahasa Indonesia, Bahasa Inggris, Produktif </b> dll',
		    	'Buat Data Guru dan Data Siswa, silahkan masukan data guru/Siswa seperti <b>NIP/NIS, Nama Lengkap</b> dll.',
		    	'Buat Paket Soal, Silahkan isi dengan memilih paket <b>Mapel, kelas, jumlah soal, kkm, dan waktu pengerjaan dalam menit </b>. Paket soal ini hanya akan ready jika admin sudah mengisi bank soal dengan jumlah yang sesuai jumlah soal pada paket soal. jika kurang maka status akan not ready jadi usahakan isi soal terlebih dahulu setelah pembuatan paket ini.',
		    	'Buat Soal/Bank soal, untuk mengisi soal pada paket soal silahkan klik menu panah kanan pada paket soal, kemudian tunggu halaman akan di alihkan pada halaman bank soal. ikuti panduan selanjutnya',
		    	'Buat Kelas Ujian, silahkan pilih guru pengawas dan  paket soal yang tersedia, kemudian berikan<b> kode ujian, No. Registrasi, dan Password  </b> kepada siswa untuk dapat mengikuti ujian, siswa hanya akan dapat mengikuti ujian jika status data/kode aktif. pastikan kode ujian aktif dan pastikan juga siswa aktif ',
		    	'Admin juga dapat memantau siswa yang sedang dan atau sudah melaksanakan ujian di halaman monitoring dengan menekan tombol direction right. dan admin juga dapat melihat hasil ujian berdasarkan <b>siswa, kelas, dan jurusan</b>',
		    	'Cetak atau download hasil ujian',
		    	'Selesai'
		    ]


];
/*
| filename config.php
| This file included for project Ujian Online Native version of PHP
| author dede jamaludin
| dibuat pada 04/05/2021 21:45
*/
 ?>