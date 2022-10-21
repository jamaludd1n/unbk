<?php
error_reporting(E_ALL);//tutup error dengan val 0 , open error dengan val E_ALL
session_start(); // call the session
require_once("connection.php"); //memanggil koneksi mysql
//menampung request
$page   = isset($_GET['p']) ? $_GET['p'] : NULL;
$id     = isset($_GET['id']) ? $_GET['id'] : NULL;

//inisialisasi variable to null value;
$title    = NULL;
$css      = $add['css']['main'];
$js       = $add['js']['main'];

//find the page
    switch($page){
        case strtolower('start'):
            $title   = "Selamat datang di halaman ujian online";
            array_push($js, "plugins/timer.js");//tambahkan timer plugins
            array_push($js, "js/quiz.js");
            break;
        //default halaman
        default:
            $title   = "Selamat datang di halaman ujian online";
            break;


    }
?>
