-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2021 at 05:25 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujianku`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banksoal`
--

CREATE TABLE `tbl_banksoal` (
  `id_bank` int(11) NOT NULL,
  `id_paket` int(5) NOT NULL,
  `q` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `id_user` int(5) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_banksoal`
--

INSERT INTO `tbl_banksoal` (`id_bank`, `id_paket`, `q`, `a`, `b`, `c`, `d`, `e`, `id_user`, `is_active`, `created_at`, `updated_at`) VALUES
(21, 10, '&lt;p&gt;Siapakah founder applikasi ini :v ?&lt;/p&gt;', '&lt;p&gt;You&lt;/p&gt;', '&lt;p&gt;Me&lt;/p&gt;', '&lt;p&gt;I&lt;/p&gt;', '&lt;p&gt;Love&lt;/p&gt;', '&lt;p&gt;not You&lt;/p&gt;', 1, '1', '2021-05-22 09:50:27', '2021-05-25 03:04:25'),
(22, 10, '&lt;p&gt;Perhatikan gambar dibawah ini !&lt;/p&gt;\r\n&lt;p&gt;&lt;img src=\"images/img_soal/2016.jpg\" alt=\"\" width=\"200\" height=\"228\" /&gt;&lt;/p&gt;\r\n&lt;p&gt;Tahun berapakah gambar di atas di ambil !&lt;/p&gt;', '&lt;p&gt;2016&lt;/p&gt;', '&lt;p&gt;2017&lt;/p&gt;', '&lt;p&gt;2018&lt;/p&gt;', '&lt;p&gt;2019&lt;/p&gt;', '&lt;p&gt;2020&lt;/p&gt;', 1, '1', '2021-05-22 09:52:18', '2021-05-22 09:52:18'),
(23, 10, '&lt;p&gt;&lt;img src=\"images/img_soal/IMG_20181101_221739.jpg\" alt=\"\" width=\"300\" height=\"405\" /&gt;&lt;/p&gt;\r\n&lt;p&gt;Foto di atas merupakan foto yang di ambil ketika berada di kantin sebuah sekolah,&lt;/p&gt;\r\n&lt;p&gt;saat dia sedang berjualan seblak wkwkwk .&lt;/p&gt;\r\n&lt;p&gt;di manakah sekolah itu berada dan tahun berpa ?&lt;/p&gt;', '&lt;p&gt;tasikmalaya 2017&lt;/p&gt;', '&lt;p&gt;tasikmalaya 2019&lt;/p&gt;', '&lt;p&gt;Cilegon, 2019&lt;/p&gt;', '&lt;p&gt;Cilegon, 2020&lt;/p&gt;', '&lt;p&gt;Bandung, 2021&lt;/p&gt;', 1, '1', '2021-05-22 09:54:41', '2021-05-22 09:54:41'),
(24, 10, '&lt;p&gt;&lt;img src=\"images/img_soal/IMG-20210328-WA0002.jpg\" alt=\"\" width=\"400\" height=\"221\" /&gt;&lt;/p&gt;\r\n&lt;p&gt;Siapakah dia ?&lt;/p&gt;', '&lt;p&gt;Mantan Pacar&lt;/p&gt;', '&lt;p&gt;Mantan murid&lt;/p&gt;', '&lt;p&gt;mantan client&lt;/p&gt;', '&lt;p&gt;teman&lt;/p&gt;', '&lt;p&gt;murid dan mantan wkwk&lt;/p&gt;', 1, '1', '2021-05-22 09:56:42', '2021-05-22 09:56:42'),
(25, 10, '&lt;p&gt;&lt;img src=\"images/img_soal/20141017-024.jpg\" alt=\"\" width=\"200\" height=\"267\" /&gt;&lt;/p&gt;\r\n&lt;p&gt;Siapakah yang telam membuatku kecewa ?&lt;/p&gt;', '&lt;p&gt;Dia yang sedang memegang boneka&lt;/p&gt;', '&lt;p&gt;Dia yang sedang main hp&lt;/p&gt;', '&lt;p&gt;Dia yang pergi tanpa pamit seperti anda&amp;nbsp;&lt;/p&gt;', '&lt;p&gt;my-self&amp;nbsp;&lt;/p&gt;', '&lt;p&gt;no one else&lt;/p&gt;', 1, '1', '2021-05-22 10:02:37', '2021-05-22 10:02:37'),
(26, 8, '&lt;p&gt;&lt;img src=\"images/img_soal/Screenshot (244).png\" alt=\"\" width=\"400\" height=\"225\" /&gt;&lt;/p&gt;\r\n&lt;p&gt;gdfsfgjjhklj&lt;/p&gt;', '&lt;p&gt;ghgfjh&lt;/p&gt;', '&lt;p&gt;gfhgfh&lt;/p&gt;', '&lt;p&gt;fghfh&lt;/p&gt;', '&lt;p&gt;fghfh&lt;/p&gt;', '&lt;p&gt;fghf&lt;/p&gt;', 1, '1', '2021-05-23 15:32:21', '2021-05-23 15:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gender`
--

CREATE TABLE `tbl_gender` (
  `id` int(2) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gender`
--

INSERT INTO `tbl_gender` (`id`, `gender`, `keterangan`) VALUES
(1, 'L', 'LAKI-LAKI'),
(2, 'P', 'PEREMPUAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_gender` int(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `id_level` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guru`
--

INSERT INTO `tbl_guru` (`id_guru`, `nip`, `nama`, `id_gender`, `alamat`, `no_tlp`, `pass`, `is_active`, `id_level`, `id_user`, `created_at`, `updated_at`) VALUES
(4, '400010001', 'dede jamaludin, S. Teler', 0, '', '', 'XtQ392$de', '1', 3, 1, '2021-05-22 09:30:42', '2021-05-23 17:13:37'),
(5, '400010002', 'dede jamaludin, S. Manis', 0, '', '', 'EoT629$de', '1', 3, 1, '2021-05-22 09:31:11', '2021-05-23 17:13:37'),
(6, '400010003', 'Jamaludin, S. Kocok', 0, '', '', 'RnK669$Ja', '1', 3, 2, '2021-05-22 09:31:35', '2021-06-01 05:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `kd_jurusan` int(11) NOT NULL,
  `jurusan` varchar(25) NOT NULL,
  `id_user` int(5) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `kd_jurusan`, `jurusan`, `id_user`, `updated_at`, `created_at`) VALUES
(1, 2071, 'RPL', 0, '2016-02-04 11:25:16', '2016-03-01 11:25:12'),
(2, 2072, 'MM', 0, '2016-02-09 11:33:37', '2016-02-09 11:33:40'),
(3, 2073, 'TKJ', 1, '2021-05-19 08:52:58', '2021-05-19 08:52:58'),
(4, 2074, 'SIJA', 1, '2021-05-19 08:53:33', '2021-05-19 08:53:33'),
(10, 1001, 'TKR', 1, '2021-05-19 09:00:31', '2021-05-19 09:00:16'),
(11, 1020, 'OTOMOTIF', 1, '2021-05-19 09:01:00', '2021-05-19 09:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id_kelas`, `kelas`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'X', 1, '2016-01-01 04:37:09', '2016-01-01 04:37:09'),
(2, 'XI', 1, '2016-01-01 04:37:09', '2016-01-01 04:37:09'),
(4, 'XII', 1, '2021-05-19 00:57:42', '2021-05-19 00:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_koreksi`
--

CREATE TABLE `tbl_koreksi` (
  `id_jawaban` int(11) NOT NULL,
  `id_banksoal` int(11) NOT NULL,
  `jawaban` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_koreksi`
--

INSERT INTO `tbl_koreksi` (`id_jawaban`, `id_banksoal`, `jawaban`) VALUES
(21, 21, 'd'),
(22, 22, 'a'),
(23, 23, 'c'),
(24, 24, 'e'),
(25, 25, 'd'),
(26, 26, 'b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE `tbl_level` (
  `id_level` int(5) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`id_level`, `level`) VALUES
(1, 'admin'),
(2, 'operator'),
(3, 'guru'),
(4, 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_listsoal`
--

CREATE TABLE `tbl_listsoal` (
  `id_listsoal` int(100) NOT NULL,
  `id_soal` int(10) NOT NULL,
  `pertanyaan` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `jawaban` varchar(10) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_listsoal`
--

INSERT INTO `tbl_listsoal` (`id_listsoal`, `id_soal`, `pertanyaan`, `a`, `b`, `c`, `d`, `e`, `jawaban`, `updated_at`, `created_at`) VALUES
(371, 5, 'apa maksud gambar dibawah?', 'orang sukses terus belajar', 'orang sukses tidak pernah tidur', 'orang sukses punya laptop', 'orang sukses sudah sukses', '', 'a', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(372, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sadsadsadafgwae', 'fdasfdasfdsfds dwfgdgdg', 'dsfdsaf df', 'fd dfgdasgdg', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(373, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'dajfcdnjk njkdnfjkda djaknfjka', 'jkfndajkf ajdfnjkdfnjk', ' fkjndajknfjkandfjknajkdf', 'jkdsanfdjkaf jkadnfjknajkfn jdkafnjkdanjkfnkjdanfkjnjdkafn', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(374, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'karena lorem ipsum itu dolor sit amet dan sudah pasti amet amet', 'jkdasnjkfnjkasdfnkjnadf jadnfjkn', 'jkfnadjknfjkdafnndjk', 'jfkdnfjknadjkf jkanfjknjkaf jkanjkfnajkdfnjkdn', '', 'd', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(375, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'jkw djkjkdnjksanjkdnjkansjkd jdansjkd', 'jkdnajskdnjk ajksdnjkansdjk', 'jdnjksad ', 'jndjkasndjknak', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(376, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ' jknjknjknsajd ajskndjksa djknasjkndjknasd', 'sadansdnjkn dkjasndjk asdjkasnjkdjkanjk', 'ndjksanjkdkd', 'asdakjsdnasd', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(377, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in ', 'sakjdnsjkandjk', 'jasdnjkadnjkdnaskjfk', 'ndjksanjkandfjanjkfnjkanfjk', 'jkndaksfjka', '', 'b', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(378, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'askfjkasfnjkasfn afsasfa', 'asdfadsfa afdsafdafvdsaf', 'safafafha fjakfadnfjk', 'afadjfaf', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(379, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'dasjkfnjknajkdfnjka', 'afeadfadsf', 'asfasfv basfeasd bdafasfeaesfaesfr', 'safsafdasfa', '', 'a', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(380, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'dafadfjadk', 'dsada', 'asdasdasdsadasd', 'sadasdadsd', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(381, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'asdasdfasdas', 'asdasdasdsadas asvsavf', 'asdasdas', 'asdasdad', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(382, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'asdasdasd', 'asdasdasvasdsadsa sad', 'sadasdas', 'sadasdas asdasd sadasda', '', 'a', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(383, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sadfas', 'sadsadsa asdsad', 'sadsad', 'sadsadasd', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(384, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sadfasdfdsb dsafasf', 'safcasdfa', 'asdadsasvb sadfasdf', 'sadasdasd', '', 'b', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(385, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'safdasd', 'safasfasfasvfasfsafvsafdasdfsafasdva sadas', 'sadsadsa sadsad', 'asdasdasdasd sadsad', '', 'b', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(386, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'asdasd', 'sadasdsadsa savsa', 'asdsadsadasdasdsad', 'sadasd', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(387, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sadasd', 'sadasdsa sadasd', 'sadasd sadas', 'sadsadsadas sadasdasd asdasdasd', '', 'a', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(388, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sadsadasdsadsad', 'sadasda asdsa asdsad', 'sdasadas asdsadasd', 'sadasdasdassadsa asd', '', 'b', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(389, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sadadasdasdasdasd', 'sadsadsa sadas', 'sadsadsa', 'sadsadsadsa safdsadsad', '', 'c', '2016-03-19 11:55:02', '2016-03-19 11:55:02'),
(390, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sadsadasd asdhhnkjasdjkas dkjasndjknasjkdnksad', 'sadfsaf', 'safasfdas', 'dfassafas', '', 'c', '2016-03-19 11:55:03', '2016-03-19 11:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mapel`
--

CREATE TABLE `tbl_mapel` (
  `id_mapel` int(11) NOT NULL,
  `mapel` varchar(25) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mapel`
--

INSERT INTO `tbl_mapel` (`id_mapel`, `mapel`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'MATEMATIKA', 1, '2021-05-19 09:01:50', '2021-05-19 09:01:50'),
(2, 'BAHASA INGGRIS', 1, '2021-05-19 09:01:57', '2021-05-19 09:01:57'),
(3, 'BAHASA INDONESIA', 1, '2021-05-19 09:02:19', '2021-05-19 09:02:19'),
(4, 'IPA', 1, '2021-05-19 09:02:31', '2021-05-19 09:02:31'),
(6, 'PRODUKTIF', 1, '2021-05-19 09:02:59', '2021-05-19 09:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `id_paket` int(11) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `jumlah_soal` int(5) NOT NULL,
  `kkm` int(5) NOT NULL,
  `waktu` int(5) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `id_user` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_paket`
--

INSERT INTO `tbl_paket` (`id_paket`, `paket`, `id_kelas`, `jumlah_soal`, `kkm`, `waktu`, `is_active`, `id_user`, `created_at`, `updated_at`) VALUES
(8, 'MATEMATIKA', 4, 40, 75, 120, '0', 1, '2021-05-22 09:32:03', '2021-05-22 09:32:03'),
(9, 'BAHASA INGGRIS', 4, 60, 80, 120, '0', 1, '2021-05-22 09:32:26', '2021-05-22 09:32:26'),
(10, 'PRODUKTIF', 4, 5, 90, 45, '1', 1, '2021-05-22 09:36:57', '2021-05-22 09:38:14'),
(11, 'BAHASA INDONESIA', 4, 55, 85, 90, '0', 1, '2021-05-22 09:37:35', '2021-05-22 09:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruang_ujian`
--

CREATE TABLE `tbl_ruang_ujian` (
  `id` int(11) NOT NULL,
  `id_siswa` int(5) NOT NULL,
  `id_ujian` int(5) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `id_level` int(5) NOT NULL,
  `tgl_waktu` datetime NOT NULL,
  `star_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `nilai` int(11) NOT NULL,
  `jml_benar` int(11) NOT NULL,
  `jml_salah` int(11) NOT NULL,
  `keterangan` enum('LULUS','TIDAK LULUS') NOT NULL,
  `id_user` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ruang_ujian`
--

INSERT INTO `tbl_ruang_ujian` (`id`, `id_siswa`, `id_ujian`, `is_active`, `id_level`, `tgl_waktu`, `star_time`, `end_time`, `nilai`, `jml_benar`, `jml_salah`, `keterangan`, `id_user`, `created_at`, `updated_at`) VALUES
(30, 8, 15, '1', 0, '2021-05-23 17:00:36', '2021-05-25 01:06:08', '2021-05-25 01:06:08', 60, 3, 2, 'TIDAK LULUS', 1, '2021-05-23 17:00:44', '2021-05-31 07:00:25'),
(31, 7, 15, '1', 0, '2021-05-23 17:24:11', '2021-05-25 01:06:08', '2021-05-25 01:06:08', 20, 1, 4, 'TIDAK LULUS', 1, '2021-05-23 17:24:14', '2021-05-31 06:59:57'),
(35, 9, 15, '1', 0, '2021-05-31 09:37:03', '2021-05-31 07:37:05', '2021-05-31 07:37:05', 60, 3, 2, 'TIDAK LULUS', 0, '2021-05-31 09:37:05', '2021-05-31 09:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_gender` int(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `noreg` varchar(100) NOT NULL,
  `pwd` varchar(25) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 aktif 0 tidak aktif',
  `id_level` int(5) NOT NULL,
  `id_user` int(6) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `nis`, `nama`, `id_gender`, `alamat`, `no_tlp`, `noreg`, `pwd`, `id_kelas`, `id_jurusan`, `is_active`, `id_level`, `id_user`, `updated_at`, `created_at`) VALUES
(7, '202112341', 'dede jamaludin', 1, '', '', 'U202NhI654', 'ThM852$de', 4, 1, '1', 4, 1, '2021-05-23 16:58:16', '2021-05-22 09:25:04'),
(8, '202112342', 'Jamaludin', 1, '', '', 'U202SrU262', 'ZhK203$Ja', 4, 1, '1', 4, 1, '2021-05-23 16:59:04', '2021-05-22 09:25:50'),
(9, '202112343', 'Abdul Jamal', 1, '', '', 'U202NtQ607', 'FdD889$Ab', 4, 1, '1', 4, 1, '2021-05-24 15:03:08', '2021-05-22 09:26:29'),
(10, '202112344', 'Abdul Jokowi', 1, '', '', 'U202XfE806', 'JjU380$Ab', 4, 1, '1', 4, 1, '2021-05-24 15:03:43', '2021-05-22 09:27:03'),
(11, '20021001', 'Mark Zuck', 0, '', '', 'U200ZoE986', 'YeB495$Ma', 1, 1, '1', 4, 1, '2021-05-22 09:28:27', '2021-05-22 09:28:27'),
(12, '20021002', 'Elon Mask', 0, '', '', 'U200CbE946', 'VjR608$El', 1, 1, '1', 4, 1, '2021-05-22 09:28:55', '2021-05-22 09:28:49'),
(13, '20021003', 'Jack Ma', 0, '', '', 'U200QiN124', 'VsT692$Ja', 1, 1, '1', 4, 1, '2021-05-22 09:29:19', '2021-05-22 09:29:19'),
(14, '20021004', 'Lary Page', 0, '', '', 'U200EvT241', 'PxZ146$La', 2, 1, '1', 4, 1, '2021-05-22 09:29:49', '2021-05-22 09:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tmp`
--

CREATE TABLE `tbl_tmp` (
  `id` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `id_paket` int(5) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` varchar(5) NOT NULL,
  `id_siswa` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ujian`
--

CREATE TABLE `tbl_ujian` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_ujian` varchar(100) NOT NULL,
  `guru_pengawas` int(5) NOT NULL,
  `id_paket` int(5) NOT NULL,
  `id_jurusan` int(5) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `is_tampilkanHasilDiSiswa` enum('0','1') NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_user` int(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ujian`
--

INSERT INTO `tbl_ujian` (`id`, `kode`, `nama_ujian`, `guru_pengawas`, `id_paket`, `id_jurusan`, `is_active`, `is_tampilkanHasilDiSiswa`, `keterangan`, `id_user`, `created_at`, `updated_at`) VALUES
(15, 'XiO282', '', 6, 10, 1, '1', '1', '', 1, '2021-05-22 10:03:49', '2021-05-23 17:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(5) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `nama`, `username`, `password`, `level`, `status`, `photo`) VALUES
(1, 'dede jamaludin', 'admin', 'admin', 1, '1', 'images/IMG_20210221_145301_599.jpg'),
(2, 'jamaludin', 'dj', '1', 2, '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_banksoal`
--
ALTER TABLE `tbl_banksoal`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tbl_koreksi`
--
ALTER TABLE `tbl_koreksi`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tbl_listsoal`
--
ALTER TABLE `tbl_listsoal`
  ADD PRIMARY KEY (`id_listsoal`);

--
-- Indexes for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `tbl_ruang_ujian`
--
ALTER TABLE `tbl_ruang_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tbl_tmp`
--
ALTER TABLE `tbl_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ujian`
--
ALTER TABLE `tbl_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_banksoal`
--
ALTER TABLE `tbl_banksoal`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_koreksi`
--
ALTER TABLE `tbl_koreksi`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_listsoal`
--
ALTER TABLE `tbl_listsoal`
  MODIFY `id_listsoal` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_ruang_ujian`
--
ALTER TABLE `tbl_ruang_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_tmp`
--
ALTER TABLE `tbl_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_ujian`
--
ALTER TABLE `tbl_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
