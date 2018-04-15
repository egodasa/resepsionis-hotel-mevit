CREATE TABLE `tb_daftar_kamar` (
  `id_kamar` int(11) NOT NULL AUTO_INCREMENT,
  `no_kamar` varchar(10) NOT NULL,
  `id_tkamar` int(11) NOT NULL,
  `status_kamar` enum('Kosong','Sedang Dipakai','Perbaikan') NOT NULL,
  PRIMARY KEY (`id_kamar`)
);

CREATE TABLE `tb_pesan` (
  `id_pesan` varchar(20) NOT NULL,
  `tgl_checkin` datetime NOT NULL,
  `tgl_checkout` datetime NOT NULL,
  `no_identitas` varchar(50) NOT NULL,
  `nm_pemesan` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `kewarganegaraan` varchar(5) NOT NULL,
  PRIMARY KEY (`id_pesan`)
);
CREATE TABLE `tb_pesan_detail` (
  `id_pdetail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` varchar(20) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  PRIMARY KEY (`id_pdetail`)
);
CREATE TABLE `tb_tipe_kamar` (
  `id_tkamar` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tkamar` varchar(50) NOT NULL,
  `hrg_tkamar` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_tkamar`)
);
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `tipe` enum('Admin','Resepsionis','Manajer') NOT NULL,
  PRIMARY KEY (`id_user`)
);

create VIEW `daftar_kamar` AS select 
`a`.`id_kamar` AS `id_kamar`,
`a`.`no_kamar` AS `no_kamar`,
`a`.`id_tkamar` AS `id_tkamar`,
`a`.`status_kamar` AS `status_kamar`,
`b`.`nm_tkamar` AS `nm_tkamar`,
`b`.`hrg_tkamar` AS `hrg_tkamar`,
`b`.`kapasitas` AS `kapasitas` 
from (`tb_daftar_kamar` `a` join
 `tb_tipe_kamar` `b` on((`a`.`id_tkamar` = `b`.`id_tkamar`);
