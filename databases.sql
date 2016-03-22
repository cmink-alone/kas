-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06 Mar 2016 pada 18.52
-- Versi Server: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pembukuan_uang_kas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` int(255) NOT NULL,
  `nama` tinytext NOT NULL,
  `nik_anggota` int(11) DEFAULT NULL,
  `tempat` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(14) NOT NULL,
  `email` text,
  `foto` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `nik_anggota`, `tempat`, `tgl_lahir`, `jk`, `email`, `foto`) VALUES
(1, '11', 11, '11', '2016-03-01', 'laki-laki', 'aang.firmansyah@gmail.com', '11.jpg');

--
-- Trigger `anggota`
--
DELIMITER $$
CREATE TRIGGER `ANGGOTA_insert` AFTER INSERT ON `anggota`
 FOR EACH ROW begin 
insert into keanggotaan (nik_anggota,keanggotaan) values (NEW.nik_anggota,0);
insert into logs (waktu,keterangan,nik_anggota)values(now(),'Menambahkan anggota',new.nik_anggota);
insert into login (id_anggota,user,password) VALUES (new.id_anggota,new.nik_anggota,md5('P4ssword'));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayar_kas`
--

CREATE TABLE IF NOT EXISTS `bayar_kas` (
  `id_bayar_kas` bigint(255) NOT NULL,
  `nik_anggota` int(11) NOT NULL,
  `tanggal_bayar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tahun` int(11) DEFAULT NULL,
  `bayar_bulan` int(2) DEFAULT NULL,
  `membayar` int(100) DEFAULT NULL,
  `status` text,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `bayar_kas`
--
DELIMITER $$
CREATE TRIGGER `BAYAR_KAS_insert` AFTER INSERT ON `bayar_kas`
 FOR EACH ROW begin
delete from telat_bayar where nik=new.nik_anggota and tahun=new.tahun and bulan=new.bayar_bulan;
insert into pesan (dari,foto,judul,pesan,buat,id1,id2) values ('admin','admin.png','Pembayaran', new.bayar_bulan, new.nik_anggota, new.tahun, new.id_bayar_kas);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dana_pengeluaran`
--

CREATE TABLE IF NOT EXISTS `dana_pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nik_anggota` int(11) NOT NULL DEFAULT '0',
  `kategori` text NOT NULL,
  `besaran` int(11) NOT NULL DEFAULT '0',
  `keterangan` text,
  `internal_external` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `dana_pengeluaran`
--
DELIMITER $$
CREATE TRIGGER `dana_pengeluran_INSERT` AFTER INSERT ON `dana_pengeluaran`
 FOR EACH ROW begin
insert into logs (logs.keterangan, logs.nik_anggota) values (concat("Pengeluran : kat[",new.kategori,"]Rp.[",new.besaran,"]ket[",new.keterangan,"]i(1)ex(0)[",new.internal_external,"]"),new.nik_anggota);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_bayaran`
--
CREATE TABLE IF NOT EXISTS `data_bayaran` (
`nik_anggota` int(11)
,`nama` tinytext
,`tahun` int(11)
,`bayar_bulan` int(2)
,`membayar` int(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_pengeluaran`
--
CREATE TABLE IF NOT EXISTS `data_pengeluaran` (
`nik_anggota` int(11)
,`tanggal` date
,`nama` tinytext
,`kategori` text
,`besaran` int(11)
,`keterangan` text
,`internal_external` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_pesan`
--
CREATE TABLE IF NOT EXISTS `detail_pesan` (
`id` int(11)
,`dari` tinytext
,`foto` char(10)
,`judul` char(20)
,`pesan` text
,`buat` char(20)
,`waktu` datetime
,`terbaca` char(1)
,`id1` int(11)
,`id2` int(11)
,`id_bayar_kas` bigint(255)
,`nik_anggota` int(11)
,`tanggal_bayar` datetime
,`tahun` int(11)
,`bayar_bulan` int(2)
,`membayar` int(100)
,`status` text
,`keterangan` text
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE IF NOT EXISTS `donasi` (
  `id_donasi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `donasi` int(11) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `donasi`
--

INSERT INTO `donasi` (`id_donasi`, `tanggal`, `nama`, `alamat`, `donasi`, `keterangan`) VALUES
(1, '2016-06-07', 'Dian Saputra', 'jl. sukawati kebayoran baru-Jakarta Selatan,', 1000000, 'khusus untuk Anggota'),
(2, '2017-08-02', '2', 'd', 11111, 'df'),
(3, '2016-08-02', 'dfsf', 'fdsfds', 222, 'fdsf');

--
-- Trigger `donasi`
--
DELIMITER $$
CREATE TRIGGER `DONASI_delete` AFTER DELETE ON `donasi`
 FOR EACH ROW begin
insert into logs (keterangan,nik_anggota) values(concat ("#HAPUS_DONASI ,",OLD.tanggal,"|",OLD.nama,"|",OLD.alamat,"|",OLD.donasi,"|",OLD.keterangan),-1);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DONASI_insert` AFTER INSERT ON `donasi`
 FOR EACH ROW begin
insert into logs (keterangan,nik_anggota) values(concat ("#TAMBAH_DONASI ,",new.tanggal,"|",new.nama,"|",new.alamat,"|",new.donasi,"|",new.keterangan),-1);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pengeluaran`
--

CREATE TABLE IF NOT EXISTS `kategori_pengeluaran` (
  `id_kat_pengeluaran` int(11) NOT NULL,
  `nama_kategori` text NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_pengeluaran`
--

INSERT INTO `kategori_pengeluaran` (`id_kat_pengeluaran`, `nama_kategori`, `pengeluaran`, `keterangan`) VALUES
(44, 'sunatan', 10000, '---'),
(49, 'MENIKAH', 10000, 'karyawan Kopkarla');

--
-- Trigger `kategori_pengeluaran`
--
DELIMITER $$
CREATE TRIGGER `delete_kategori_keanggotaan` AFTER DELETE ON `kategori_pengeluaran`
 FOR EACH ROW begin
insert into logs (keterangan, nik_anggota) values (concat("Menghapus kategori pengeluaran [",old.nama_kategori,"][",old.pengeluaran,"]"),old.id_kat_pengeluaran);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_kategori_pengeluaran` AFTER INSERT ON `kategori_pengeluaran`
 FOR EACH ROW begin
insert into logs (keterangan,nik_anggota) values(concat('Menambahkan kategori pengeluaran[',new.nama_kategori,'][',new.pengeluaran,']'),new.id_kat_pengeluaran);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_kategori_pengeluaran` AFTER UPDATE ON `kategori_pengeluaran`
 FOR EACH ROW begin
insert into logs (keterangan, nik_anggota) values (concat("perbarui kategori pengeluaran [",old.nama_kategori," -> ",old.pengeluaran, "] => [",new.nama_kategori," -> ",new.pengeluaran,"]" ),new.id_kat_pengeluaran);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keanggotaan`
--

CREATE TABLE IF NOT EXISTS `keanggotaan` (
  `nik_anggota` int(11) NOT NULL,
  `keanggotaan` int(5) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `ef_bulan` smallint(6) DEFAULT NULL,
  `ef_tahun` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keanggotaan`
--

INSERT INTO `keanggotaan` (`nik_anggota`, `keanggotaan`, `tanggal`, `ef_bulan`, `ef_tahun`) VALUES
(11, 1, '2016-03-07', 1, 2016);

--
-- Trigger `keanggotaan`
--
DELIMITER $$
CREATE TRIGGER `keanggotaan_update` AFTER UPDATE ON `keanggotaan`
 FOR EACH ROW begin
insert into logs values(null,now(),concat('update keanggotaan [',new.keanggotaan,']'),new.nik_anggota);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `keanggotaan_aktif`
--
CREATE TABLE IF NOT EXISTS `keanggotaan_aktif` (
`id_anggota` int(255)
,`nama` tinytext
,`nik_anggota` int(11)
,`tempat` varchar(25)
,`tgl_lahir` date
,`jk` varchar(14)
,`email` text
,`foto` varchar(15)
,`keanggotaan` int(5)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id_anggota` int(255) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_anggota`, `user`, `password`) VALUES
(-1, 'administrator', '431301000c51954230c969f2e04c3add'),
(1, '11', '431301000c51954230c969f2e04c3add');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id_log` double NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterangan` text NOT NULL,
  `nik_anggota` int(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id_log`, `waktu`, `keterangan`, `nik_anggota`) VALUES
(1, '2016-03-07 00:00:03', 'Menambahkan anggota', 11),
(2, '2016-03-07 00:00:11', 'update keanggotaan [1]', 11);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pemasukan_anggota`
--
CREATE TABLE IF NOT EXISTS `pemasukan_anggota` (
`total_pembayaran` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pembayar_telat`
--
CREATE TABLE IF NOT EXISTS `pembayar_telat` (
`id` bigint(20)
,`nik` bigint(20)
,`tahun` int(11)
,`bulan` int(11)
,`bayar` int(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran_ext`
--

CREATE TABLE IF NOT EXISTS `pengeluaran_ext` (
  `id` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `keperluan` text NOT NULL,
  `dana` int(11) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id` int(11) NOT NULL,
  `dari` tinytext NOT NULL,
  `foto` char(10) NOT NULL,
  `judul` char(20) NOT NULL,
  `pesan` text NOT NULL,
  `buat` char(20) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `terbaca` char(1) NOT NULL DEFAULT 't',
  `id1` int(11) DEFAULT NULL,
  `id2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id_setting` int(11) NOT NULL,
  `bayaran` int(11) NOT NULL,
  `denda` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `set_bulanan_kas`
--

CREATE TABLE IF NOT EXISTS `set_bulanan_kas` (
  `id` int(11) NOT NULL,
  `tahun` int(4) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `bayar` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `set_bulanan_kas`
--

INSERT INTO `set_bulanan_kas` (`id`, `tahun`, `bulan`, `bayar`) VALUES
(2, 2013, 1, 0),
(3, 2013, 2, 0),
(4, 2013, 3, 0),
(5, 2013, 4, 0),
(6, 2013, 5, 0),
(7, 2013, 6, 0),
(8, 2013, 7, 0),
(9, 2013, 8, 0),
(10, 2014, 1, 0),
(11, 2013, 9, 0),
(12, 2014, 2, 0),
(13, 2013, 10, 0),
(14, 2014, 3, 0),
(15, 2013, 11, 0),
(16, 2014, 4, 0),
(17, 2013, 12, 0),
(18, 2014, 5, 0),
(19, 2014, 6, 0),
(20, 2015, 1, 0),
(21, 2014, 7, 0),
(22, 2015, 2, 0),
(23, 2014, 8, 0),
(24, 2015, 3, 0),
(25, 2014, 9, 0),
(26, 2015, 4, 0),
(27, 2014, 10, 0),
(28, 2015, 5, 0),
(29, 2014, 11, 0),
(30, 2015, 6, 0),
(31, 2014, 12, 0),
(32, 2015, 7, 0),
(33, 2015, 8, 0),
(34, 2015, 9, 0),
(35, 2015, 10, 0),
(36, 2015, 11, 0),
(37, 2015, 12, 0),
(38, 2016, 1, 1000),
(39, 2016, 2, 1000),
(40, 2016, 3, 1000),
(41, 2016, 4, 1000),
(42, 2016, 5, 1000),
(43, 2016, 6, 1000),
(44, 2016, 7, 1000),
(45, 2016, 8, 1000),
(46, 2016, 9, 1000),
(47, 2016, 10, 1000),
(48, 2016, 11, 1000),
(49, 2016, 12, 1000),
(50, 2017, 1, 0),
(51, 2017, 2, 0),
(52, 2017, 3, 0),
(53, 2017, 4, 0),
(54, 2017, 5, 0),
(55, 2017, 6, 0),
(56, 2017, 7, 0),
(57, 2017, 8, 0),
(58, 2017, 9, 0),
(59, 2017, 10, 0),
(60, 2017, 11, 0),
(61, 2017, 12, 0);

--
-- Trigger `set_bulanan_kas`
--
DELIMITER $$
CREATE TRIGGER `SET_PENGELUARAN_KAS_update` AFTER UPDATE ON `set_bulanan_kas`
 FOR EACH ROW begin
insert into logs (keterangan,nik_anggota) values (concat("#perubahan iuaran bulanan", old.tahun),old.id);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_bulanan_kas_INSERT` AFTER INSERT ON `set_bulanan_kas`
 FOR EACH ROW begin

insert into logs (keterangan,nik_anggota) values(concat('#add tahun ',new.tahun),-1);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tabel_login`
--
CREATE TABLE IF NOT EXISTS `tabel_login` (
`id_anggota` int(255)
,`nama` tinytext
,`user` varchar(20)
,`password` text
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `telat_bayar`
--

CREATE TABLE IF NOT EXISTS `telat_bayar` (
  `id` bigint(20) NOT NULL,
  `nik` bigint(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `telat_bayar`
--

INSERT INTO `telat_bayar` (`id`, `nik`, `tahun`, `bulan`) VALUES
(1, 11, 2016, 1),
(11, 11, 2016, 2),
(12, 11, 2016, 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_donasi`
--
CREATE TABLE IF NOT EXISTS `total_donasi` (
`total_donasi` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_pemasukan_perbulan`
--
CREATE TABLE IF NOT EXISTS `total_pemasukan_perbulan` (
`tahun` int(11)
,`bayar_bulan` int(2)
,`total` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_pengeluaran_anggota`
--
CREATE TABLE IF NOT EXISTS `total_pengeluaran_anggota` (
`total_pengeluaran_ang` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_pengeluaran_ext`
--
CREATE TABLE IF NOT EXISTS `total_pengeluaran_ext` (
`tot_pengeluaran_ext` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `data_bayaran`
--
DROP TABLE IF EXISTS `data_bayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_bayaran` AS select `anggota`.`nik_anggota` AS `nik_anggota`,`anggota`.`nama` AS `nama`,`bayar_kas`.`tahun` AS `tahun`,`bayar_kas`.`bayar_bulan` AS `bayar_bulan`,`bayar_kas`.`membayar` AS `membayar` from (`bayar_kas` join `anggota` on((`anggota`.`nik_anggota` = `bayar_kas`.`nik_anggota`)));

-- --------------------------------------------------------

--
-- Struktur untuk view `data_pengeluaran`
--
DROP TABLE IF EXISTS `data_pengeluaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pengeluaran` AS select `dana_pengeluaran`.`nik_anggota` AS `nik_anggota`,`dana_pengeluaran`.`tanggal` AS `tanggal`,`anggota`.`nama` AS `nama`,`dana_pengeluaran`.`kategori` AS `kategori`,`dana_pengeluaran`.`besaran` AS `besaran`,`dana_pengeluaran`.`keterangan` AS `keterangan`,`dana_pengeluaran`.`internal_external` AS `internal_external` from (`dana_pengeluaran` left join `anggota` on((`dana_pengeluaran`.`nik_anggota` = `anggota`.`nik_anggota`)));

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_pesan`
--
DROP TABLE IF EXISTS `detail_pesan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_pesan` AS select `pesan`.`id` AS `id`,`pesan`.`dari` AS `dari`,`pesan`.`foto` AS `foto`,`pesan`.`judul` AS `judul`,`pesan`.`pesan` AS `pesan`,`pesan`.`buat` AS `buat`,`pesan`.`waktu` AS `waktu`,`pesan`.`terbaca` AS `terbaca`,`pesan`.`id1` AS `id1`,`pesan`.`id2` AS `id2`,`bayar_kas`.`id_bayar_kas` AS `id_bayar_kas`,`bayar_kas`.`nik_anggota` AS `nik_anggota`,`bayar_kas`.`tanggal_bayar` AS `tanggal_bayar`,`bayar_kas`.`tahun` AS `tahun`,`bayar_kas`.`bayar_bulan` AS `bayar_bulan`,`bayar_kas`.`membayar` AS `membayar`,`bayar_kas`.`status` AS `status`,`bayar_kas`.`keterangan` AS `keterangan` from (`pesan` join `bayar_kas` on((`pesan`.`id2` = `bayar_kas`.`id_bayar_kas`)));

-- --------------------------------------------------------

--
-- Struktur untuk view `keanggotaan_aktif`
--
DROP TABLE IF EXISTS `keanggotaan_aktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `keanggotaan_aktif` AS select `anggota`.`id_anggota` AS `id_anggota`,`anggota`.`nama` AS `nama`,`anggota`.`nik_anggota` AS `nik_anggota`,`anggota`.`tempat` AS `tempat`,`anggota`.`tgl_lahir` AS `tgl_lahir`,`anggota`.`jk` AS `jk`,`anggota`.`email` AS `email`,`anggota`.`foto` AS `foto`,`keanggotaan`.`keanggotaan` AS `keanggotaan` from (`keanggotaan` left join `anggota` on((`anggota`.`nik_anggota` = `keanggotaan`.`nik_anggota`))) where (`keanggotaan`.`keanggotaan` = '1');

-- --------------------------------------------------------

--
-- Struktur untuk view `pemasukan_anggota`
--
DROP TABLE IF EXISTS `pemasukan_anggota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pemasukan_anggota` AS select sum(`bayar_kas`.`membayar`) AS `total_pembayaran` from `bayar_kas`;

-- --------------------------------------------------------

--
-- Struktur untuk view `pembayar_telat`
--
DROP TABLE IF EXISTS `pembayar_telat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pembayar_telat` AS select `telat_bayar`.`id` AS `id`,`telat_bayar`.`nik` AS `nik`,`telat_bayar`.`tahun` AS `tahun`,`telat_bayar`.`bulan` AS `bulan`,`set_bulanan_kas`.`bayar` AS `bayar` from (`telat_bayar` join `set_bulanan_kas` on(((`telat_bayar`.`tahun` = `set_bulanan_kas`.`tahun`) and (`telat_bayar`.`bulan` = `set_bulanan_kas`.`bulan`))));

-- --------------------------------------------------------

--
-- Struktur untuk view `tabel_login`
--
DROP TABLE IF EXISTS `tabel_login`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tabel_login` AS (select `anggota`.`id_anggota` AS `id_anggota`,`anggota`.`nama` AS `nama`,`login`.`user` AS `user`,`login`.`password` AS `password` from (`anggota` join `login` on((`anggota`.`id_anggota` = `login`.`id_anggota`))));

-- --------------------------------------------------------

--
-- Struktur untuk view `total_donasi`
--
DROP TABLE IF EXISTS `total_donasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_donasi` AS select sum(`donasi`.`donasi`) AS `total_donasi` from `donasi`;

-- --------------------------------------------------------

--
-- Struktur untuk view `total_pemasukan_perbulan`
--
DROP TABLE IF EXISTS `total_pemasukan_perbulan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_pemasukan_perbulan` AS select `data_bayaran`.`tahun` AS `tahun`,`data_bayaran`.`bayar_bulan` AS `bayar_bulan`,sum(`data_bayaran`.`membayar`) AS `total` from `data_bayaran` where (`data_bayaran`.`tahun` = 2016) group by `data_bayaran`.`bayar_bulan` order by `data_bayaran`.`bayar_bulan`;

-- --------------------------------------------------------

--
-- Struktur untuk view `total_pengeluaran_anggota`
--
DROP TABLE IF EXISTS `total_pengeluaran_anggota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_pengeluaran_anggota` AS select sum(`dana_pengeluaran`.`besaran`) AS `total_pengeluaran_ang` from `dana_pengeluaran`;

-- --------------------------------------------------------

--
-- Struktur untuk view `total_pengeluaran_ext`
--
DROP TABLE IF EXISTS `total_pengeluaran_ext`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_pengeluaran_ext` AS select sum(`pengeluaran_ext`.`dana`) AS `tot_pengeluaran_ext` from `pengeluaran_ext`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`), ADD UNIQUE KEY `Index 2` (`nik_anggota`);

--
-- Indexes for table `bayar_kas`
--
ALTER TABLE `bayar_kas`
  ADD PRIMARY KEY (`id_bayar_kas`);

--
-- Indexes for table `dana_pengeluaran`
--
ALTER TABLE `dana_pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id_donasi`);

--
-- Indexes for table `kategori_pengeluaran`
--
ALTER TABLE `kategori_pengeluaran`
  ADD PRIMARY KEY (`id_kat_pengeluaran`);

--
-- Indexes for table `keanggotaan`
--
ALTER TABLE `keanggotaan`
  ADD PRIMARY KEY (`nik_anggota`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `pengeluaran_ext`
--
ALTER TABLE `pengeluaran_ext`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `set_bulanan_kas`
--
ALTER TABLE `set_bulanan_kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telat_bayar`
--
ALTER TABLE `telat_bayar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bayar_kas`
--
ALTER TABLE `bayar_kas`
  MODIFY `id_bayar_kas` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dana_pengeluaran`
--
ALTER TABLE `dana_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori_pengeluaran`
--
ALTER TABLE `kategori_pengeluaran`
  MODIFY `id_kat_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengeluaran_ext`
--
ALTER TABLE `pengeluaran_ext`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `set_bulanan_kas`
--
ALTER TABLE `set_bulanan_kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `telat_bayar`
--
ALTER TABLE `telat_bayar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
