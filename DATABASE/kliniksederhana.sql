/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.6.12-MariaDB-0ubuntu0.22.04.1 : Database - kliniksederhana
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `jenis` */

DROP TABLE IF EXISTS `jenis`;

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jenis` varchar(35) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `jenis` */

insert  into `jenis`(`id_jenis`,`nm_jenis`) values 
(1,'Generik'),
(2,'Paten');

/*Table structure for table `obat` */

DROP TABLE IF EXISTS `obat`;

CREATE TABLE `obat` (
  `kode_obat` varchar(35) NOT NULL,
  `nm_obat` varchar(200) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`kode_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `obat` */

insert  into `obat`(`kode_obat`,`nm_obat`,`id_jenis`,`harga`,`stok`) values 
('232323','Obat Pilek',2,2000,3000);

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pengguna` varchar(200) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `pengguna` */

insert  into `pengguna`(`id_pengguna`,`nm_pengguna`,`username`,`password`) values 
(1,'Firman Santosa','admin','21232f297a57a5a743894a0e4a801fc3');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `no_transaksi` varchar(35) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `grandtotal` double NOT NULL,
  `bayar` double NOT NULL,
  `kembali` double NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `transaksi` */

insert  into `transaksi`(`no_transaksi`,`tgl_transaksi`,`grandtotal`,`bayar`,`kembali`,`id_pengguna`) values 
('230414.TRANS.00001','2023-04-14 22:43:31',6000,10000,4000,1);

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(35) NOT NULL,
  `kode_obat` varchar(35) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `transaksi_detail` */

insert  into `transaksi_detail`(`id_detail`,`no_transaksi`,`kode_obat`,`qty`,`total`) values 
(2,'230414.TRANS.00001','232323',3,6000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
