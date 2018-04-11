-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP VIEW IF EXISTS `daftar_kamar`;
CREATE TABLE `daftar_kamar` (`id_kamar` int(11), `no_kamar` varchar(10), `id_tkamar` int(11), `status_kamar` enum('Kosong','Sedang Dipakai','Perbaikan'), `nm_tkamar` varchar(50), `hrg_tkamar` int(11), `kapasitas` int(11));


DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengaturan` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

TRUNCATE `pengaturan`;
INSERT INTO `pengaturan` (`id`, `pengaturan`) VALUES
(1,	'{\"extra_bed\": 150000}');

DROP TABLE IF EXISTS `tb_daftar_kamar`;
CREATE TABLE `tb_daftar_kamar` (
  `id_kamar` int(11) NOT NULL AUTO_INCREMENT,
  `no_kamar` varchar(10) NOT NULL,
  `id_tkamar` int(11) NOT NULL,
  `status_kamar` enum('Kosong','Sedang Dipakai','Perbaikan') NOT NULL,
  PRIMARY KEY (`id_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

TRUNCATE `tb_daftar_kamar`;
INSERT INTO `tb_daftar_kamar` (`id_kamar`, `no_kamar`, `id_tkamar`, `status_kamar`) VALUES
(1,	'JS1',	4,	'Kosong'),
(2,	'JS2',	4,	'Kosong'),
(3,	'JS3',	4,	'Kosong'),
(4,	'SD1',	5,	'Sedang Dipakai'),
(5,	'SD2',	5,	'Sedang Dipakai'),
(6,	'S1',	8,	'Kosong'),
(7,	'JS4',	4,	'Kosong'),
(8,	'D1',	6,	'Kosong'),
(9,	'D2',	6,	'Kosong'),
(10,	'SP1',	7,	'Kosong'),
(11,	'SP2',	7,	'Kosong'),
(12,	'SP3',	7,	'Kosong'),
(13,	'ST1',	8,	'Kosong'),
(14,	'ST2',	8,	'Kosong'),
(15,	'ST3',	8,	'Kosong');

DROP TABLE IF EXISTS `tb_pernah_pesan`;
CREATE TABLE `tb_pernah_pesan` (
  `no_ktp` varchar(20) NOT NULL,
  `nm_pemesan` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kontak` varchar(30) NOT NULL,
  PRIMARY KEY (`no_ktp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `tb_pernah_pesan`;

DROP TABLE IF EXISTS `tb_pesan`;
CREATE TABLE `tb_pesan` (
  `id_pesan` varchar(20) NOT NULL,
  `tgl_checkin` datetime NOT NULL,
  `tgl_checkout` datetime NOT NULL,
  `no_identitas` varchar(50) NOT NULL,
  `nm_pemesan` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `kewarganegaraan` varchar(5) NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `tb_pesan`;
INSERT INTO `tb_pesan` (`id_pesan`, `tgl_checkin`, `tgl_checkout`, `no_identitas`, `nm_pemesan`, `kontak`, `kewarganegaraan`) VALUES
('1523258969014',	'2018-04-09 14:29:29',	'2018-04-10 14:29:00',	'313123123',	'sdsdeds',	'232232',	'WNI'),
('1523259718325',	'2018-04-09 14:41:58',	'2018-04-10 14:41:00',	'1231312312',	'dadaw',	'31311123',	'WNI'),
('1523259901436',	'2018-04-09 14:45:01',	'2018-04-10 14:45:00',	'131312',	'eewew',	'32132121',	'WNI');

DROP TABLE IF EXISTS `tb_pesan_detail`;
CREATE TABLE `tb_pesan_detail` (
  `id_pdetail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` varchar(20) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  PRIMARY KEY (`id_pdetail`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

TRUNCATE `tb_pesan_detail`;
INSERT INTO `tb_pesan_detail` (`id_pdetail`, `id_pesan`, `id_kamar`, `jumlah_orang`, `total_harga`) VALUES
(3,	'1523258969014',	4,	2,	425000),
(4,	'1523259718325',	1,	2,	450000),
(5,	'1523259901436',	2,	2,	450000),
(6,	'1523259901436',	5,	3,	575000);

DELIMITER ;;

CREATE TRIGGER `kamarDipakai` AFTER INSERT ON `tb_pesan_detail` FOR EACH ROW
update tb_daftar_kamar set status_kamar = 'Sedang Dipakai' where id_kamar = new.id_kamar;;

DELIMITER ;

DROP TABLE IF EXISTS `tb_tipe_kamar`;
CREATE TABLE `tb_tipe_kamar` (
  `id_tkamar` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tkamar` varchar(50) NOT NULL,
  `hrg_tkamar` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_tkamar`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

TRUNCATE `tb_tipe_kamar`;
INSERT INTO `tb_tipe_kamar` (`id_tkamar`, `nm_tkamar`, `hrg_tkamar`, `kapasitas`) VALUES
(4,	'Junior Suite',	450000,	2),
(5,	'Super Deluxe',	425000,	2),
(6,	'Deluxe',	375000,	2),
(7,	'Superior',	300000,	2),
(8,	'Standart',	275000,	2);

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `tipe` enum('Admin','Resepsionis') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

TRUNCATE `tb_user`;
INSERT INTO `tb_user` (`id_user`, `username`, `password`, `status`, `tipe`) VALUES
(4,	'admin',	'*4ACFE3202A5FF5CF467898FC58AAB1D615029441',	1,	'Admin'),
(5,	'resep',	'*9325ECF1A162D274B05EF6F8A556057633C1A209',	1,	'Resepsionis');

DROP TABLE IF EXISTS `daftar_kamar`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `daftar_kamar` AS select `a`.`id_kamar` AS `id_kamar`,`a`.`no_kamar` AS `no_kamar`,`a`.`id_tkamar` AS `id_tkamar`,`a`.`status_kamar` AS `status_kamar`,`b`.`nm_tkamar` AS `nm_tkamar`,`b`.`hrg_tkamar` AS `hrg_tkamar`,`b`.`kapasitas` AS `kapasitas` from (`tb_daftar_kamar` `a` join `tb_tipe_kamar` `b` on((`a`.`id_tkamar` = `b`.`id_tkamar`)));

-- 2018-04-11 15:09:33
