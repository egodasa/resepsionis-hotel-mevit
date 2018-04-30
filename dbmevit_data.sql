-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

TRUNCATE `pengaturan`;
INSERT INTO `pengaturan` (`id`, `pengaturan`) VALUES
(1,	'{\"extra_bed\": 150000}');

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

TRUNCATE `tb_pernah_pesan`;

TRUNCATE `tb_pesan`;
INSERT INTO `tb_pesan` (`id_pesan`, `tgl_checkin`, `tgl_checkout`, `no_identitas`, `nm_pemesan`, `kontak`, `kewarganegaraan`) VALUES
('1523258969014',	'2018-04-09 14:29:29',	'2018-04-10 14:29:00',	'313123123',	'sdsdeds',	'232232',	'WNI'),
('1523259718325',	'2018-05-09 14:41:58',	'2018-05-10 14:41:00',	'1231312312',	'dadaw',	'31311123',	'WNI'),
('1523259901436',	'2018-06-09 14:45:01',	'2018-06-10 14:45:00',	'131312',	'eewew',	'32132121',	'WNI');

TRUNCATE `tb_pesan_detail`;
INSERT INTO `tb_pesan_detail` (`id_pdetail`, `id_pesan`, `id_kamar`, `jumlah_orang`, `total_harga`) VALUES
(3,	'1523258969014',	4,	2,	425000),
(4,	'1523259718325',	1,	2,	450000),
(5,	'1523259901436',	2,	2,	450000),
(6,	'1523259901436',	5,	3,	575000);

TRUNCATE `tb_tipe_kamar`;
INSERT INTO `tb_tipe_kamar` (`id_tkamar`, `nm_tkamar`, `hrg_tkamar`, `kapasitas`) VALUES
(4,	'Junior Suite',	450000,	2),
(5,	'Super Deluxe',	425000,	2),
(6,	'Deluxe',	375000,	2),
(7,	'Superior',	300000,	2),
(8,	'Standart',	275000,	2);

TRUNCATE `tb_user`;
INSERT INTO `tb_user` (`id_user`, `username`, `password`, `status`, `tipe`) VALUES
(4,	'admin',	'*4ACFE3202A5FF5CF467898FC58AAB1D615029441',	1,	'Admin'),
(5,	'resepsionis',	'*AE10FA862CD285BEF08CFB66D3CFED6F508FD5C1',	1,	'Resepsionis'),
(6,	'manajer',	'*82586FD06B0649061D04584A682AD855E4FEA19D',	1,	'Manajer');

-- 2018-04-24 08:06:08
