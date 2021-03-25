/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.13-MariaDB : Database - ci4_auth_jwt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ci4_auth_jwt` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ci4_auth_jwt`;

/*Table structure for table `unit` */

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit` (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `id_cluster` int(11) NOT NULL,
  `nomor_rumah` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tipe_rmh` varchar(50) DEFAULT NULL,
  `jml_kmr_tdr` int(11) DEFAULT NULL,
  `jml_kmr_mnd` int(11) DEFAULT NULL,
  `luas_tanah` double DEFAULT NULL,
  `luas_bangunan` double DEFAULT NULL,
  `sertifikat` varchar(50) DEFAULT NULL,
  `tahun_pembuatan` year(4) DEFAULT NULL,
  `jenis_lantai` varchar(100) DEFAULT NULL,
  `dinding` varchar(100) DEFAULT NULL,
  `sanitair` varchar(100) DEFAULT NULL,
  `atap` varchar(100) DEFAULT NULL,
  `rangka_atap` varchar(100) DEFAULT NULL,
  `kusen_jendela` varchar(100) DEFAULT NULL,
  `pondasi` varchar(100) DEFAULT NULL,
  `listrik` varchar(50) DEFAULT NULL,
  `lantai` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `longitude` varchar(200) DEFAULT NULL,
  `latitude` varchar(200) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `komisi` double DEFAULT NULL,
  `pajak_penjual` double DEFAULT NULL,
  `pajak_ppn` double DEFAULT NULL,
  `pajak_pembeli` double DEFAULT NULL,
  `biaya_lain` double DEFAULT NULL,
  `tot_harga` double DEFAULT NULL,
  `status` enum('Avail','BF','Sold','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

/*Data for the table `unit` */

insert  into `unit`(`id`,`kode`,`id_cluster`,`nomor_rumah`,`nama`,`tipe_rmh`,`jml_kmr_tdr`,`jml_kmr_mnd`,`luas_tanah`,`luas_bangunan`,`sertifikat`,`tahun_pembuatan`,`jenis_lantai`,`dinding`,`sanitair`,`atap`,`rangka_atap`,`kusen_jendela`,`pondasi`,`listrik`,`lantai`,`alamat`,`description`,`longitude`,`latitude`,`project_id`,`harga`,`diskon`,`komisi`,`pajak_penjual`,`pajak_ppn`,`pajak_pembeli`,`biaya_lain`,`tot_harga`,`status`,`created_at`,`update_at`) values (1,'A001',1,1,'Griya Cakra','193/55',3,2,193,55,'SHM',2020,'Granit','Baja Ringan / Habel 10CM','Closet & Shower Set','Genteng Keramik','Baja Ringan','Kayu Solid / Alumunium','Beton Bertulang','1300','1','Jalan ABC','Perumahan yang dekat dengan akses jalan raya bogor','-','-',0,0,0,0,0,NULL,0,0,0,'Avail','2021-03-20 00:43:23',NULL);

/*Table structure for table `unit_image` */

DROP TABLE IF EXISTS `unit_image`;

CREATE TABLE `unit_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` int(11) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=utf8mb4;

/*Data for the table `unit_image` */

insert  into `unit_image`(`id`,`id_unit`,`file_path`,`created_at`,`updated_at`) values (1,1,'gambar.jpg','2021-03-20 10:06:45','2021-03-20 10:06:53');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `tipe` enum('admin','agent') NOT NULL,
  `noktp` varchar(50) NOT NULL,
  `no_telp1` varchar(50) NOT NULL,
  `no_telp2` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `email1` varchar(50) NOT NULL,
  `email2` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `wa` varchar(100) DEFAULT NULL,
  `youtube` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `company` varchar(50) NOT NULL,
  `id_user_access` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`nama`,`password`,`tipe`,`noktp`,`no_telp1`,`no_telp2`,`alamat`,`email1`,`email2`,`facebook`,`instagram`,`wa`,`youtube`,`foto`,`company`,`id_user_access`,`created_at`,`update_at`) values (1,'is','is','75ab6909a8c176947f338cda6700bc83b61144f4','admin','123','1','2','jl abc','@1','@2','','',NULL,'','a.jpg','global institute',0,'2021-03-20 00:00:00','2021-03-20 00:00:00'),(2,'yudi','yudi','75ab6909a8c176947f338cda6700bc83b61144f4','admin','123','1','2','jl abc','iswahyudi@stmikglobal.ac.id','iswahyudi@stmikglobal.ac.id','','',NULL,'','foto.jpg','global institute',0,'2021-03-20 00:00:00','2021-03-20 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
