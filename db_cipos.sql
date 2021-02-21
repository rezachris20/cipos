/*
 Navicat Premium Data Transfer

 Source Server         : My Local
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : db_cipos

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 21/02/2021 17:47:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_barang
-- ----------------------------
DROP TABLE IF EXISTS `tb_barang`;
CREATE TABLE `tb_barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barcode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_barang
-- ----------------------------
INSERT INTO `tb_barang` VALUES (1, 'A0000000001', 'Mie Ayam', 'PCS', 10000, 6, 20000, 10000, 'miayam.jpg');
INSERT INTO `tb_barang` VALUES (2, 'A0000000002', 'Sayur Asem', 'PCS', 4000, 13, 8000, 4000, 'sayur_asem.jpg');
INSERT INTO `tb_barang` VALUES (3, 'A0000000003', 'Martabak', 'PCS', 23000, 6, 35000, 12000, 'martabak.jpg');
INSERT INTO `tb_barang` VALUES (4, 'A0000000004', 'Sate Ayam', 'PCS', 5000, 100, 7000, 2000, 'sate.jpg');
INSERT INTO `tb_barang` VALUES (5, 'A0000000005', 'Indomie Telor', 'PCS', 5000, 9, 10000, 5000, 'indomie.jpg');
INSERT INTO `tb_barang` VALUES (6, 'A0000000006', 'Bakso', 'PCS', 5000, 8, 15000, 10000, 'bakso.jpg');

-- ----------------------------
-- Table structure for tb_kustomer
-- ----------------------------
DROP TABLE IF EXISTS `tb_kustomer`;
CREATE TABLE `tb_kustomer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idmarketing` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_marketing
-- ----------------------------
DROP TABLE IF EXISTS `tb_marketing`;
CREATE TABLE `tb_marketing`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengguna`;
CREATE TABLE `tb_pengguna`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pengguna
-- ----------------------------
INSERT INTO `tb_pengguna` VALUES (4, 'admin', 'Reza Chrismardianto', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'cozyvape.png');
INSERT INTO `tb_pengguna` VALUES (5, 'kasir', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir', 'abc2.png');
INSERT INTO `tb_pengguna` VALUES (6, 'tes', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'admin', 'Koala.jpg');

-- ----------------------------
-- Table structure for tb_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `tb_penjualan`;
CREATE TABLE `tb_penjualan`  (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_penjualan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_barcode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `profit_penjualan` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `status` int(11) NOT NULL,
  `id_pelanggan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_penjualan_detail
-- ----------------------------
DROP TABLE IF EXISTS `tb_penjualan_detail`;
CREATE TABLE `tb_penjualan_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_penjualan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sub_total` int(11) NOT NULL,
  `total_diskon` int(11) NOT NULL,
  `total_all` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `total_kembali` int(11) NOT NULL,
  `idkustomer` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_supplier
-- ----------------------------
DROP TABLE IF EXISTS `tb_supplier`;
CREATE TABLE `tb_supplier`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Triggers structure for table tb_penjualan
-- ----------------------------
DROP TRIGGER IF EXISTS `jual`;
delimiter ;;
CREATE TRIGGER `jual` AFTER INSERT ON `tb_penjualan` FOR EACH ROW begin
update tb_barang set stok = stok-new.jumlah
where kode_barcode = new.kode_barcode;
end
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
