<?php
error_reporting(0);//tutup error dengan val 0 , open error dengan val E_ALL
session_start(); // call the session
require_once("connection.php"); //memanggil koneksi mysql
//menampung request
$page   = isset($_GET['p']) ? $_GET['p'] : NULL; // ini untuk request halaman
$id     = isset($_GET['id']) ? $_GET['id'] : NULL; // ini untuk menampung request id

//inisialisasi variable to null value;
$view     = NULL;
$title    = NULL;
$css      = $add['css']['main']; //load all css for main page
$js       = $add['js']['main']; // load all javascript for main page
$bc		  = array(); // breadcrumb
//set default plugin for this page 
$page_in_arr  = ['bank-soal','data-soal','isi-soal',
                 'data-guru','data-siswa','data-admin','data-applikasi',
                 'data-ujian','ruang-ujian','help',
                 'kelas','mapel','jurusan','profile-sekolah']; 
                 // array yang di rekomendasikan untuk meload
                 // Fitur plugins

if(in_array($page, $page_in_arr)){
    $css   = array_merge($css, $add['css']['table']); //load data table for the halaman
    $js    = array_merge($js, $add['js']['table']); 
}

    #Control Halaman di mulai dari sini.
    switch($page){
        case strtolower('beranda'): //Halaman beranda
            $title   = "Halaman utama Applikasi ujian online versi Beta";
            $view    = "home.php";
            break;

        case strtolower('help'): //halaman petunjuk
            $title   = "Halaman Petunjuk penggunaan";
            $bc['title'] = "Petunjuk";
            $view    = "help.php";
            break;

        case strtolower('profile'): //halaman petunjuk
            $title   = "Halaman Profile Admin";
            $view    = "profile.php";
            array_push($js, "js/profile.js");
            break;

        case strtolower('bank-soal'): //Halaman bank soal
            $title  = "Manajemen data soal";
            $view   = "bank-soal.php";
            $bc['title']    = "Bank Soal";
            array_push($js, $add['js']['bank_soal'][0]);
            $js           = $js;
            $css          = $css;
            break;

        case strtolower('isi-soal')://halaman isi soal
            $title  = "Manajemen Soal";
            $view   = "isi-soal.php";
            $bc['title']    = "Isi Soal";
            $js             = array_merge($js, $add['js']['form']);
            array_push($js, $add['js']['bank_soal'][1]);
            $js           = $js;
            $css          = $css;
            break;

        case strtolower('data-ujian')://halaman data ujian
            $title  = "Manajemen Ujian";
            $view   = "dt-ujian.php";
            $bc['title']    = "Ujian";
            array_push($js, $add['js']['dt_ujian'][0]);
            $js           = $js;
            $css          = $css;
            break;

        case strtolower('ruang-ujian')://halaman monitoring ujian
            $title  = "Manajemen Ruang Ujian";
            $view   = "r-ujian.php";
            $bc['title']    = "Ruang Ujian";
            array_push($js, $add['js']['r_ujian'][0]);
            $js           = $js;
            $css          = $css;
            break;

        case strtolower('data-guru')://halaman data guru
            $title  = "Manajemen data guru";
            $view   = "dt-guru.php";
            $bc['title']    = "Data guru";
            array_push($js, $add['js']['dt_guru'][0]);
            $js           = $js;
            $css          = $css;
            break;

        case strtolower('data-siswa')://data siswa
            $title  = "Manajemen data siswa";
            $view   = "dt-siswa.php";
            $bc['title']    = "Data Siswa";
            array_push($js, $add['js']['dt_siswa'][0]);
            $js           = $js;
            $css          = $css;
            break;


        //data master
        case strtolower('kelas'):
            $title  = "Manajemen Kelas";
            $view   = "dt-kelas.php";
            $bc['title']    = "Data Kelas";
            array_push($js, $add['js']['dt_kelas'][0]);
            $js           = $js;
            $css          = $css;
            break;
        case strtolower('mapel'):
            $title  = "Manajemen Mapel";
            $view   = "dt-mapel.php";
            $bc['title']    = "Data Mapel";
            array_push($js, $add['js']['dt_mapel'][0]);
            $js           = $js;
            $css          = $css;
            break;
        case strtolower('jurusan'):
            $title  = "Manajemen Jurusan";
            $view   = "dt-jurusan.php";
            $bc['title']    = "Data Jurusan";
            array_push($js, $add['js']['dt_jurusan'][0]);
            $js           = $js;
            $css          = $css;
            break;

        case 'logout':
            header('location:logout.php');
            break;
        //default halaman
        default:
            $title   = "Halaman utama applikasi ujian online ";
            $view    = "home.php";
            array_push($js, "plugins/timer.js");
            break;


    }
?>
