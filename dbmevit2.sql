-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: dbmevit
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary table structure for view `daftar_kamar`
--

DROP TABLE IF EXISTS `daftar_kamar`;
/*!50001 DROP VIEW IF EXISTS `daftar_kamar`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `daftar_kamar` AS SELECT 
 1 AS `id_kamar`,
 1 AS `no_kamar`,
 1 AS `id_tkamar`,
 1 AS `status_kamar`,
 1 AS `nm_tkamar`,
 1 AS `hrg_tkamar`,
 1 AS `kapasitas`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `pengaturan`
--

DROP TABLE IF EXISTS `pengaturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengaturan` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaturan`
--

LOCK TABLES `pengaturan` WRITE;
/*!40000 ALTER TABLE `pengaturan` DISABLE KEYS */;
INSERT INTO `pengaturan` VALUES (1,'{\"extra_bed\": 150000}');
/*!40000 ALTER TABLE `pengaturan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_daftar_kamar`
--

DROP TABLE IF EXISTS `tb_daftar_kamar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_daftar_kamar` (
  `id_kamar` int(11) NOT NULL AUTO_INCREMENT,
  `no_kamar` varchar(10) NOT NULL,
  `id_tkamar` int(11) NOT NULL,
  `status_kamar` enum('Kosong','Sedang Dipakai','Perbaikan') NOT NULL,
  PRIMARY KEY (`id_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_daftar_kamar`
--

LOCK TABLES `tb_daftar_kamar` WRITE;
/*!40000 ALTER TABLE `tb_daftar_kamar` DISABLE KEYS */;
INSERT INTO `tb_daftar_kamar` VALUES (1,'JS1',4,'Kosong'),(2,'JS2',4,'Kosong'),(3,'JS3',4,'Kosong'),(4,'SD1',5,'Sedang Dipakai'),(5,'SD2',5,'Sedang Dipakai'),(6,'S1',8,'Kosong'),(7,'JS4',4,'Kosong'),(8,'D1',6,'Kosong'),(9,'D2',6,'Kosong'),(10,'SP1',7,'Kosong'),(11,'SP2',7,'Kosong'),(12,'SP3',7,'Kosong'),(13,'ST1',8,'Kosong'),(14,'ST2',8,'Kosong'),(15,'ST3',8,'Kosong');
/*!40000 ALTER TABLE `tb_daftar_kamar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pernah_pesan`
--

DROP TABLE IF EXISTS `tb_pernah_pesan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pernah_pesan` (
  `no_ktp` varchar(20) NOT NULL,
  `nm_pemesan` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kontak` varchar(30) NOT NULL,
  PRIMARY KEY (`no_ktp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pernah_pesan`
--

LOCK TABLES `tb_pernah_pesan` WRITE;
/*!40000 ALTER TABLE `tb_pernah_pesan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pernah_pesan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pesan`
--

DROP TABLE IF EXISTS `tb_pesan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pesan`
--

LOCK TABLES `tb_pesan` WRITE;
/*!40000 ALTER TABLE `tb_pesan` DISABLE KEYS */;
INSERT INTO `tb_pesan` VALUES ('1523258969014','2018-04-09 14:29:29','2018-04-10 14:29:00','313123123','sdsdeds','232232','WNI'),('1523259718325','2018-05-09 14:41:58','2018-05-10 14:41:00','1231312312','dadaw','31311123','WNI'),('1523259901436','2018-06-09 14:45:01','2018-06-10 14:45:00','131312','eewew','32132121','WNI');
/*!40000 ALTER TABLE `tb_pesan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pesan_detail`
--

DROP TABLE IF EXISTS `tb_pesan_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pesan_detail` (
  `id_pdetail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` varchar(20) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  PRIMARY KEY (`id_pdetail`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pesan_detail`
--

LOCK TABLES `tb_pesan_detail` WRITE;
/*!40000 ALTER TABLE `tb_pesan_detail` DISABLE KEYS */;
INSERT INTO `tb_pesan_detail` VALUES (3,'1523258969014',4,2,425000),(4,'1523259718325',1,2,450000),(5,'1523259901436',2,2,450000),(6,'1523259901436',5,3,575000);
/*!40000 ALTER TABLE `tb_pesan_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `kamarDipakai` AFTER INSERT ON `tb_pesan_detail` FOR EACH ROW
update tb_daftar_kamar set status_kamar = 'Sedang Dipakai' where id_kamar = new.id_kamar */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tb_tipe_kamar`
--

DROP TABLE IF EXISTS `tb_tipe_kamar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tipe_kamar` (
  `id_tkamar` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tkamar` varchar(50) NOT NULL,
  `hrg_tkamar` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_tkamar`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipe_kamar`
--

LOCK TABLES `tb_tipe_kamar` WRITE;
/*!40000 ALTER TABLE `tb_tipe_kamar` DISABLE KEYS */;
INSERT INTO `tb_tipe_kamar` VALUES (4,'Junior Suite',450000,2),(5,'Super Deluxe',425000,2),(6,'Deluxe',375000,2),(7,'Superior',300000,2),(8,'Standart',275000,2);
/*!40000 ALTER TABLE `tb_tipe_kamar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `tipe` enum('Admin','Resepsionis','Manajer') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES (4,'admin','*4ACFE3202A5FF5CF467898FC58AAB1D615029441',1,'Admin'),(5,'resepsionis','*AE10FA862CD285BEF08CFB66D3CFED6F508FD5C1',1,'Resepsionis'),(6,'manajer','*82586FD06B0649061D04584A682AD855E4FEA19D',1,'Manajer');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `daftar_kamar`
--

/*!50001 DROP VIEW IF EXISTS `daftar_kamar`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `daftar_kamar` AS select `a`.`id_kamar` AS `id_kamar`,`a`.`no_kamar` AS `no_kamar`,`a`.`id_tkamar` AS `id_tkamar`,`a`.`status_kamar` AS `status_kamar`,`b`.`nm_tkamar` AS `nm_tkamar`,`b`.`hrg_tkamar` AS `hrg_tkamar`,`b`.`kapasitas` AS `kapasitas` from (`tb_daftar_kamar` `a` join `tb_tipe_kamar` `b` on((`a`.`id_tkamar` = `b`.`id_tkamar`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-15 21:15:08
