/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : pickup

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-01-19 17:11:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pickup_additional_service
-- ----------------------------
DROP TABLE IF EXISTS `pickup_additional_service`;
CREATE TABLE `pickup_additional_service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` text,
  `price` int(11) DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_additional_service
-- ----------------------------
INSERT INTO `pickup_additional_service` VALUES ('1', '儿童座椅', '后排儿童座椅', '50', '1', '2018-01-05 10:13:27', '2018-01-05 10:13:27', null);
INSERT INTO `pickup_additional_service` VALUES ('2', '老人服务', '扶上车扶下车扶上楼', '10', '0', '2018-01-05 10:35:29', '2018-01-05 10:35:29', null);
INSERT INTO `pickup_additional_service` VALUES ('3', '午餐', '提供免费午餐', '20', '1', '2018-01-05 10:36:13', '2018-01-05 10:36:13', null);

-- ----------------------------
-- Table structure for pickup_additional_service_price
-- ----------------------------
DROP TABLE IF EXISTS `pickup_additional_service_price`;
CREATE TABLE `pickup_additional_service_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `additional_service` int(10) unsigned DEFAULT NULL,
  `price` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_additional_service_price
-- ----------------------------
INSERT INTO `pickup_additional_service_price` VALUES ('2', '3', '1', null, null, null);
INSERT INTO `pickup_additional_service_price` VALUES ('3', '1', '1', null, null, null);
INSERT INTO `pickup_additional_service_price` VALUES ('4', '1', '3', null, null, null);
INSERT INTO `pickup_additional_service_price` VALUES ('5', '3', '3', null, null, null);

-- ----------------------------
-- Table structure for pickup_admin
-- ----------------------------
DROP TABLE IF EXISTS `pickup_admin`;
CREATE TABLE `pickup_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `account` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `is_supper_admin` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_admin
-- ----------------------------
INSERT INTO `pickup_admin` VALUES ('1', 'admin2', 'admin2', 'eyJpdiI6IlpHbGFUMXIrZ3lsUUdPeCtWeVZkdVE9PSIsInZhbHVlIjoiZlRLMDd5NXZ3QjdqT0pZanhrM1JDdz09IiwibWFjIjoiNGNhMzllNjlmY2ZmM2UyZTBkMTZhODljMDZiN2M4ZDRjYjBkZGI0MTQwMjY0Y2I2ZjEzOGZkNmM1N2RmNWZiZCJ9', '1', '1', null, null, null);
INSERT INTO `pickup_admin` VALUES ('2', 'wudaiyu@13512685663', '13512685663', 'eyJpdiI6IjdsdU0ybGNnS1wvRm1sbXR3QnlCYmlBPT0iLCJ2YWx1ZSI6IlBLcHMyXC9QTEl1WUdKTk9uSUZ0MGN3PT0iLCJtYWMiOiI0ZTY5YzJhYzg0ZTI1MTU1ZjI4ZjI4OGQwMTc4MmEzYWQ0ZGJjZjAyNjFkY2EwMGU0Y2YzMTdjZmViZDMyYjM0In0=', '1', '0', '2018-01-04 15:21:40', '2018-01-04 15:21:40', null);
INSERT INTO `pickup_admin` VALUES ('3', 'chaoyuzhou@13512688888', '13512688888', 'eyJpdiI6IjIwNUJrMDc4RUd5ZDU3eGVHOGp6Tmc9PSIsInZhbHVlIjoicDdobkVSSFNhaDNNaFhCQklKUENqQT09IiwibWFjIjoiZWE0NzczMTI1ZGE1NDEwMjBjNDE1YTE5NDBlNjRhNTJiMzY2NjE0OWQ4Y2Q3YTAwZWU4MWVlODZjNmI2NzE5NiJ9', '1', '0', '2018-01-04 15:22:24', '2018-01-04 15:22:24', null);

-- ----------------------------
-- Table structure for pickup_admin_store
-- ----------------------------
DROP TABLE IF EXISTS `pickup_admin_store`;
CREATE TABLE `pickup_admin_store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store` int(11) unsigned DEFAULT NULL,
  `admin` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted-at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_admin_store
-- ----------------------------
INSERT INTO `pickup_admin_store` VALUES ('1', '1', '1', '2018-01-04 10:33:16', '2018-01-04 10:33:18', null);
INSERT INTO `pickup_admin_store` VALUES ('2', '2', '1', '2018-01-04 11:05:48', '2018-01-04 11:05:48', null);
INSERT INTO `pickup_admin_store` VALUES ('3', '1', '2', null, null, null);
INSERT INTO `pickup_admin_store` VALUES ('4', '1', '3', null, null, null);

-- ----------------------------
-- Table structure for pickup_car
-- ----------------------------
DROP TABLE IF EXISTS `pickup_car`;
CREATE TABLE `pickup_car` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `car_patt` int(11) unsigned DEFAULT NULL,
  `license_plate` varchar(50) DEFAULT NULL,
  `km` double(11,2) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `store` int(11) unsigned DEFAULT NULL,
  `search_key` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_car
-- ----------------------------
INSERT INTO `pickup_car` VALUES ('1', '1', '黑C1234', '789.00', '蓝', '1', '5', '黑C1234heiC1234hC', '2018-01-05 08:48:34', '2018-01-19 14:46:54', null);
INSERT INTO `pickup_car` VALUES ('2', '1', '黑C5555', '666.00', '香槟金', '1', '5', '黑C5555heiC5555hC', '2018-01-05 08:49:49', '2018-01-19 14:47:04', null);
INSERT INTO `pickup_car` VALUES ('5', '1', '黑C7777', '60.00', '蓝色', '1', '5', '黑C7777heiC7777hC', '2018-01-06 11:14:50', '2018-01-19 14:47:06', null);
INSERT INTO `pickup_car` VALUES ('6', '3', '黑E8888', '999.00', '黑', '1', '5', '黑E8888heiE8888hE', '2018-01-06 11:16:33', '2018-01-19 14:47:08', null);
INSERT INTO `pickup_car` VALUES ('7', '2', '测试车辆', '777.00', '黑色', '1', '1', '测试车辆嘉年华福特ceshicheliangjianianhuafutecscljnhft', '2018-01-19 14:53:06', '2018-01-19 14:53:06', null);
INSERT INTO `pickup_car` VALUES ('8', '2', '123456', '666.00', '紫色', '1', '1', '123456嘉年华福特123456jianianhuafute1jnhft', '2018-01-19 14:53:50', '2018-01-19 14:53:50', null);

-- ----------------------------
-- Table structure for pickup_card_type
-- ----------------------------
DROP TABLE IF EXISTS `pickup_card_type`;
CREATE TABLE `pickup_card_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_card_type
-- ----------------------------
INSERT INTO `pickup_card_type` VALUES ('1', '身份证', null, null, null);
INSERT INTO `pickup_card_type` VALUES ('2', '护照', null, null, null);
INSERT INTO `pickup_card_type` VALUES ('3', '军官证', null, null, null);
INSERT INTO `pickup_card_type` VALUES ('4', '港澳通行证', null, null, null);
INSERT INTO `pickup_card_type` VALUES ('5', '台胞证', null, null, null);
INSERT INTO `pickup_card_type` VALUES ('6', '回乡证', null, null, null);

-- ----------------------------
-- Table structure for pickup_car_com
-- ----------------------------
DROP TABLE IF EXISTS `pickup_car_com`;
CREATE TABLE `pickup_car_com` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `sort` char(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_car_com
-- ----------------------------
INSERT INTO `pickup_car_com` VALUES ('1', '福特', '1', 'ft', '2018-01-04 11:26:08', '2018-01-04 11:26:08', null);
INSERT INTO `pickup_car_com` VALUES ('2', '雪佛兰', '1', 'xfl', '2018-01-04 11:29:08', '2018-01-04 11:29:08', null);
INSERT INTO `pickup_car_com` VALUES ('3', '大众', '1', 'dz', '2018-01-04 11:30:06', '2018-01-04 11:30:06', null);
INSERT INTO `pickup_car_com` VALUES ('4', '兰博基尼', '1', 'lbjn', '2018-01-04 11:30:52', '2018-01-04 11:30:52', null);
INSERT INTO `pickup_car_com` VALUES ('5', '保时捷', '1', 'bsj', '2018-01-04 12:05:17', '2018-01-04 12:05:17', null);

-- ----------------------------
-- Table structure for pickup_car_model
-- ----------------------------
DROP TABLE IF EXISTS `pickup_car_model`;
CREATE TABLE `pickup_car_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pickup_car_model
-- ----------------------------
INSERT INTO `pickup_car_model` VALUES ('1', '两厢车', null, null, null);
INSERT INTO `pickup_car_model` VALUES ('4', '三厢车', '2018-01-03 08:40:24', '2018-01-03 08:40:24', null);
INSERT INTO `pickup_car_model` VALUES ('5', '皮卡', '2018-01-04 12:05:27', '2018-01-04 12:05:27', null);

-- ----------------------------
-- Table structure for pickup_car_patt
-- ----------------------------
DROP TABLE IF EXISTS `pickup_car_patt`;
CREATE TABLE `pickup_car_patt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com` int(11) unsigned DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `site` int(11) DEFAULT NULL,
  `luggage` int(11) DEFAULT NULL,
  `model` int(11) DEFAULT NULL,
  `tag` int(11) DEFAULT NULL,
  `fuel_tank_capacity` int(11) DEFAULT NULL,
  `car_type` int(11) unsigned DEFAULT NULL,
  `transmission` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `displacement` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_car_patt
-- ----------------------------
INSERT INTO `pickup_car_patt` VALUES ('1', '1', '野马', '2', '1', '1', null, '54', '4', '1', '/storage/app/upload/zYqxT5iSTtHbNbg8y7siiSQPxECkWfDCpFdGqbas.jpeg', null, '1', '2018-01-05 08:47:18', '2018-01-10 14:43:27', null);
INSERT INTO `pickup_car_patt` VALUES ('2', '1', '嘉年华', '4', '2', '4', null, '50', '1', '1', '/storage/app/upload/5BIZbnqNpXfsnuk7lgZrVrRVF2cqaVVIewQKnKia.jpeg', null, '1', '2018-01-05 10:52:17', '2018-01-10 14:44:17', null);
INSERT INTO `pickup_car_patt` VALUES ('3', '1', '锐界', '5', '6', '4', null, '60', '2', '2', '/storage/app/upload/gdTBhN4j2JOYJWZl2PwoyxEukHdwveJAV6wn6A83.jpeg', null, '1', '2018-01-06 11:15:59', '2018-01-10 14:44:52', null);

-- ----------------------------
-- Table structure for pickup_car_type
-- ----------------------------
DROP TABLE IF EXISTS `pickup_car_type`;
CREATE TABLE `pickup_car_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_car_type
-- ----------------------------
INSERT INTO `pickup_car_type` VALUES ('1', '经济型', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('2', '舒适型', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('3', '商务型', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('4', '豪华型', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('5', '奢华型', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('6', '10座中巴', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('7', '20座中巴', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('8', '35座大巴', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('9', '45座大巴', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('10', '53座大巴', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('11', 'GL8', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('12', '8座中巴', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('13', '25座大巴', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('14', '30座大巴', '1', null, null, null);
INSERT INTO `pickup_car_type` VALUES ('15', '15座中巴', '1', null, null, null);

-- ----------------------------
-- Table structure for pickup_city
-- ----------------------------
DROP TABLE IF EXISTS `pickup_city`;
CREATE TABLE `pickup_city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`(191))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pickup_city
-- ----------------------------
INSERT INTO `pickup_city` VALUES ('1', '哈尔滨市', '230100', '2018-01-03 07:18:28', '2018-01-03 07:18:28', null);
INSERT INTO `pickup_city` VALUES ('4', '北京城区', '2', '2018-01-19 15:47:55', '2018-01-19 15:47:55', null);

-- ----------------------------
-- Table structure for pickup_code
-- ----------------------------
DROP TABLE IF EXISTS `pickup_code`;
CREATE TABLE `pickup_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(255) NOT NULL DEFAULT '',
  `col` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT '',
  `index` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `default` varchar(255) NOT NULL DEFAULT '',
  `from_table` varchar(255) NOT NULL DEFAULT '',
  `f_name` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=446 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pickup_code
-- ----------------------------
INSERT INTO `pickup_code` VALUES ('230', 'pay_method', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-02 06:53:56', '2018-01-02 06:53:56', null);
INSERT INTO `pickup_code` VALUES ('231', 'pay_method', 'name', '名称', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:53:56', '2018-01-02 06:53:56', null);
INSERT INTO `pickup_code` VALUES ('232', 'pay_method', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:53:56', '2018-01-02 06:53:56', null);
INSERT INTO `pickup_code` VALUES ('233', 'pay_method', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:53:56', '2018-01-02 06:53:56', null);
INSERT INTO `pickup_code` VALUES ('234', 'pay_method', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:53:56', '2018-01-02 06:53:56', null);
INSERT INTO `pickup_code` VALUES ('235', 'store', 'id', 'id', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('236', 'store', 'name', '门店名称', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('237', 'store', 'person', '联系人', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('238', 'store', 'phone', '联系人手机', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('239', 'store', 'open_time', '开门时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('240', 'store', 'close_time', '关门时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('241', 'store', 'location_poi', '地理坐标', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('242', 'store', 'location_name', '详细地址', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('243', 'store', 'city', '城市', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('244', 'store', 'type', '类型', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('245', 'store', 'rent_pre', '租金加价百分比', 'number', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('246', 'store', 'fee', '手续加价百分比', 'number', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('247', 'store', 'minimal_advance_booking_time', '最小提前预定时间', 'number', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('248', 'store', 'the_larges_ advance_scheduled _time', '最大提前预定时间', 'number', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('249', 'store', 'payment_method', '支付方式', 'select', '1', '1', '1', '', 'pay_method', 'name', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('250', 'store', 'store', '所属门店', 'number', '0', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('251', 'store', 'diff_store_rank', '异门店还车等级', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('252', 'store', 'status', '状态', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('253', 'store', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('254', 'store', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('255', 'store', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:55:35', '2018-01-02 06:55:35', null);
INSERT INTO `pickup_code` VALUES ('256', 'car_com', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-02 06:56:05', '2018-01-02 06:56:05', null);
INSERT INTO `pickup_code` VALUES ('257', 'car_com', 'name', '名称', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:56:05', '2018-01-02 06:56:05', null);
INSERT INTO `pickup_code` VALUES ('258', 'car_com', 'status', '状态', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:56:06', '2018-01-02 06:56:06', null);
INSERT INTO `pickup_code` VALUES ('259', 'car_com', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:56:06', '2018-01-02 06:56:06', null);
INSERT INTO `pickup_code` VALUES ('260', 'car_com', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:56:06', '2018-01-02 06:56:06', null);
INSERT INTO `pickup_code` VALUES ('261', 'car_com', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:56:06', '2018-01-02 06:56:06', null);
INSERT INTO `pickup_code` VALUES ('262', 'car_type', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-02 06:56:43', '2018-01-02 06:56:43', null);
INSERT INTO `pickup_code` VALUES ('263', 'car_type', 'name', '车组名称', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:56:43', '2018-01-02 06:56:43', null);
INSERT INTO `pickup_code` VALUES ('264', 'car_type', 'status', '状态', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:56:43', '2018-01-02 06:56:43', null);
INSERT INTO `pickup_code` VALUES ('265', 'car_type', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:56:43', '2018-01-02 06:56:43', null);
INSERT INTO `pickup_code` VALUES ('266', 'car_type', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:56:43', '2018-01-02 06:56:43', null);
INSERT INTO `pickup_code` VALUES ('267', 'car_type', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:56:43', '2018-01-02 06:56:43', null);
INSERT INTO `pickup_code` VALUES ('268', 'car_model', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-02 06:59:27', '2018-01-02 06:59:27', null);
INSERT INTO `pickup_code` VALUES ('269', 'car_model', 'name', '名称', 'text', '1', '1', '1', '', '', '', '2018-01-02 06:59:27', '2018-01-02 06:59:27', null);
INSERT INTO `pickup_code` VALUES ('270', 'car_model', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:59:27', '2018-01-02 06:59:27', null);
INSERT INTO `pickup_code` VALUES ('271', 'car_model', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:59:27', '2018-01-02 06:59:27', null);
INSERT INTO `pickup_code` VALUES ('272', 'car_model', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 06:59:27', '2018-01-02 06:59:27', null);
INSERT INTO `pickup_code` VALUES ('273', 'car_patt', 'id', 'id', 'text', '1', '1', '1', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('274', 'car_patt', 'com', '车辆品牌', 'text', '1', '1', '1', '', 'car_com', 'name', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('275', 'car_patt', 'name', '车辆型号名', 'text', '1', '1', '1', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('276', 'car_patt', 'site', '乘坐人数', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('277', 'car_patt', 'luggage', '行李箱数', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('278', 'car_patt', 'model', '厢式', 'select', '1', '1', '1', '', 'car_model', 'name', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('279', 'car_patt', 'tag', '标签', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('280', 'car_patt', 'fuel_tank_capacity', '油箱容量', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('281', 'car_patt', 'car_type', '车辆类型', 'select', '1', '1', '1', '', 'car_type', 'name', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('282', 'car_patt', 'transmission', '变速箱类型', 'select', '1', '1', '1', '', 'car_transmission', 'name', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('283', 'car_patt', 'status', '状态', 'text', '1', '1', '1', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('284', 'car_patt', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('285', 'car_patt', 'udpated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('286', 'car_patt', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:02:07', '2018-01-02 07:02:07', null);
INSERT INTO `pickup_code` VALUES ('287', 'car', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('288', 'car', 'car_patt', '车辆型号', 'select', '1', '1', '1', '', 'car_patt', 'name', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('289', 'car', 'license_plate', '车辆牌照', 'text', '1', '1', '1', '', '', '', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('290', 'car', 'km', '行驶公里数', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('291', 'car', 'color', '颜色', 'text', '1', '1', '1', '', '', '', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('292', 'car', 'status', '状态', 'text', '1', '1', '1', '', '', '', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('293', 'car', 'store', '所属门店', 'text', '1', '1', '1', '', 'store', 'name', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('294', 'car', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('295', 'car', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('296', 'car', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:04:01', '2018-01-02 07:04:01', null);
INSERT INTO `pickup_code` VALUES ('297', 'price', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('298', 'price', 'car_patt', '车辆型号', 'select', '1', '1', '1', '', 'car_patt', 'name', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('299', 'price', 'basic_service_fee', '基础服务费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('300', 'price', 'service_fee', '服务费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('301', 'price', 'ultra_hour_fee', '超小时费/每小时', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('302', 'price', 'ultra_km_fee', '长公里费/每公里', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('303', 'price', 'pre_authorization_fee', '基础授权费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('304', 'price', 'Illegal_deposit', '违章押金', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('305', 'price', 'off_site_fee', '异地还车费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('306', 'price', 'night_give_fee', '夜间取车费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('307', 'price', 'night_return_fee', '夜间还车费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('308', 'price', 'night_start_time', '夜间开始时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('309', 'price', 'night_end_time', '夜间结束时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('310', 'price', 'platform', '平台', 'select', '1', '1', '1', '', 'platform', 'name', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('311', 'price', 'status', '状态', 'text', '1', '1', '1', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('312', 'price', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('313', 'price', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('314', 'price', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:06:48', '2018-01-02 07:06:48', null);
INSERT INTO `pickup_code` VALUES ('315', 'price_info', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('316', 'price_info', 'price', '订单价格', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('317', 'price_info', 'basic_service_fee', '基础服务费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('318', 'price_info', 'service_fee', '服务费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('319', 'price_info', 'ultra_hour_fee', '超小时费/每小时', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('320', 'price_info', 'ultra_km_fee', '超公里费/每公里', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('321', 'price_info', 'pre_authorization_fee', '基础授权费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('322', 'price_info', 'Illegal_deposit', '违章押金', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('323', 'price_info', 'off_site_fee', '异地还车费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('324', 'price_info', 'night_pickup_fee', '夜间取车费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('325', 'price_info', 'night_return_fee', '夜间换车费', 'number', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('326', 'price_info', 'night_start', '夜间开始时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('327', 'price_info', 'night_end', '夜间结束时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('328', 'price_info', 'platform', '平台', 'text', '1', '1', '1', '', '', '', '2018-01-02 07:09:11', '2018-01-02 07:09:11', null);
INSERT INTO `pickup_code` VALUES ('329', 'price_info', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:09:12', '2018-01-02 07:09:12', null);
INSERT INTO `pickup_code` VALUES ('330', 'price_info', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:09:12', '2018-01-02 07:09:12', null);
INSERT INTO `pickup_code` VALUES ('331', 'price_info', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-02 07:09:12', '2018-01-02 07:09:12', null);
INSERT INTO `pickup_code` VALUES ('332', 'order', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('333', 'order', 'oth_order_id', '第三方单号', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('334', 'order', 'platform', '平台', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('335', 'order', 'price', '订单价格', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('336', 'order', 'car', '车辆id', 'select', '1', '1', '1', '', 'car', 'license_plate', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('337', 'order', 'license_plate', '车辆牌照', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('338', 'order', 'store', '门店', 'text', '1', '1', '1', '', 'store', 'name', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('339', 'order', 'city', '城市', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('340', 'order', 'pickup_store', '取车门店', 'text', '1', '1', '1', '', 'store', 'name', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('341', 'order', 'return_store', '还车门店', 'text', '1', '1', '1', '', 'store', 'name', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('342', 'order', 'pickup_time', '取车时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('343', 'order', 'return_time', '还车时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('344', 'order', 'coupon_code', '优惠码', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('345', 'order', 'coupon_price', '优惠价格', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('346', 'order', 'use_name', '用户姓名', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:28', '2018-01-03 01:04:28', null);
INSERT INTO `pickup_code` VALUES ('347', 'order', 'use_phone', '用户手机', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('348', 'order', 'card_type', '证件类型', 'select', '1', '1', '1', '', 'card', 'name', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('349', 'order', 'card_no', '证件编号', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('350', 'order', 'price_mark', '价格标记', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('351', 'order', 'cancel_time', '取消时间', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('352', 'order', 'cancel_price', '损失（取消）费用', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('353', 'order', 'pay_status', '支付状态', 'select', '1', '1', '1', '', 'status', 'name', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('354', 'order', 'status', '订单状态', 'text', '1', '1', '1', '', 'status', 'name', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('355', 'order', 'status_ref', '状态详情', 'select', '1', '1', '1', '', 'status_ref', 'created_at', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('356', 'order', 'created_at', '创建时间', 'dateTime', '1', '0', '0', '', '', '', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('357', 'order', 'updated_at', '更新时间', 'dateTime', '1', '0', '0', '', '', '', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('358', 'order', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:04:29', '2018-01-03 01:04:29', null);
INSERT INTO `pickup_code` VALUES ('359', 'status', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 01:04:59', '2018-01-03 01:04:59', null);
INSERT INTO `pickup_code` VALUES ('360', 'status', 'name', '名', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:59', '2018-01-03 01:04:59', null);
INSERT INTO `pickup_code` VALUES ('361', 'status', 'type', '类型', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:04:59', '2018-01-03 01:04:59', null);
INSERT INTO `pickup_code` VALUES ('362', 'status', 'created_at', '', 'dateTime', '0', '0', '0', '', '', '', '2018-01-03 01:04:59', '2018-01-03 01:04:59', null);
INSERT INTO `pickup_code` VALUES ('363', 'status', 'updated_at', '', 'dateTime', '0', '0', '0', '', '', '', '2018-01-03 01:04:59', '2018-01-03 01:04:59', null);
INSERT INTO `pickup_code` VALUES ('364', 'status', 'deleted_at', '', 'dateTime', '0', '0', '0', '', '', '', '2018-01-03 01:04:59', '2018-01-03 01:04:59', null);
INSERT INTO `pickup_code` VALUES ('365', 'price_float', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('366', 'price_float', 'price', '价格', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('367', 'price_float', 'num', '值', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('368', 'price_float', 'num_type', '值类型', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('369', 'price_float', 'float_type', '浮动类型', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('370', 'price_float', 'week', '星期', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('371', 'price_float', 'start_date', '开始日期', 'dateTime', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('372', 'price_float', 'end_date', '结束日期', 'dateTime', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('373', 'price_float', 'start_time', '开始时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('374', 'price_float', 'end_time', '结束日期', 'dateTime', '1', '1', '1', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('375', 'price_float', 'created_at', '创建日期', 'dateTime', '1', '0', '0', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('376', 'price_float', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('377', 'price_float', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:07:21', '2018-01-03 01:07:21', null);
INSERT INTO `pickup_code` VALUES ('378', 'pickup_price', 'int', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('379', 'pickup_price', 'order', '订单', 'select', '1', '1', '1', '', 'order', 'id', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('380', 'pickup_price', 'pickup_oil_ volume', '取车油量', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('381', 'pickup_price', 'pickup_km', '取车公里数', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('382', 'pickup_price', 'paid', '已付金额', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('383', 'pickup_price', 'oth_fee', '其他费用', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('384', 'pickup_price', 'desc', '备注', 'textarea', '1', '1', '1', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('385', 'pickup_price', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('386', 'pickup_price', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('387', 'pickup_price', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:09:12', '2018-01-03 01:09:12', null);
INSERT INTO `pickup_code` VALUES ('388', 'pickup_price', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 01:12:57', '2018-01-03 01:12:57', null);
INSERT INTO `pickup_code` VALUES ('389', 'pickup_price', 'pickup_time', '取车时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-03 01:12:57', '2018-01-03 01:14:09', null);
INSERT INTO `pickup_code` VALUES ('390', 'pickup_price', 'pickup_oil', '取车油量', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:14:09', '2018-01-03 01:14:09', null);
INSERT INTO `pickup_code` VALUES ('391', 'return_price', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 01:16:10', '2018-01-03 01:16:10', null);
INSERT INTO `pickup_code` VALUES ('392', 'return_price', 'order', '订单', 'number', '1', '1', '1', '', 'order', 'id', '2018-01-03 01:16:10', '2018-01-03 01:16:10', null);
INSERT INTO `pickup_code` VALUES ('393', 'return_price', 'return_km', '还车公里数', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:17:07', null);
INSERT INTO `pickup_code` VALUES ('394', 'return_price', 'return_oil', '还车油量', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:17:07', null);
INSERT INTO `pickup_code` VALUES ('395', 'return_price', 'ultra_hour_fee', '超小时费/每小时', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('396', 'return_price', 'ultra_km_fee', '超公里费/每公里', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('397', 'return_price', 'oil_fee', '燃油费', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('398', 'return_price', 'cleaning_fee', '清洁费', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('399', 'return_price', 'lost_wages', '误工费', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('400', 'return_price', 'oth_fee', '其他费用', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('401', 'return_price', 'desc', '备注', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('402', 'return_price', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('403', 'return_price', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('404', 'return_price', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:16:11', '2018-01-03 01:16:11', null);
INSERT INTO `pickup_code` VALUES ('405', 'return_price', 'return_time', '还车时间', 'dateTime', '1', '1', '1', '', '', '', '2018-01-03 01:16:43', '2018-01-03 01:17:07', null);
INSERT INTO `pickup_code` VALUES ('406', 'additional_service', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 01:18:26', '2018-01-03 01:18:26', null);
INSERT INTO `pickup_code` VALUES ('407', 'additional_service', 'name', '增值服务名', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:18:26', '2018-01-03 01:18:26', null);
INSERT INTO `pickup_code` VALUES ('408', 'additional_service', 'desc', '描述', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:18:27', '2018-01-03 01:18:27', null);
INSERT INTO `pickup_code` VALUES ('409', 'additional_service', 'price', '价格', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:18:27', '2018-01-03 01:18:27', null);
INSERT INTO `pickup_code` VALUES ('410', 'additional_service', 'type', '类型', 'number', '1', '1', '1', '', '', '', '2018-01-03 01:18:27', '2018-01-03 01:18:27', null);
INSERT INTO `pickup_code` VALUES ('411', 'additional_service', 'created_at', '', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:18:27', '2018-01-03 01:18:27', null);
INSERT INTO `pickup_code` VALUES ('412', 'additional_service', 'updated_at', '', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:18:27', '2018-01-03 01:18:27', null);
INSERT INTO `pickup_code` VALUES ('413', 'additional_service', 'deleted_at', '', 'text', '1', '1', '1', '', '', '', '2018-01-03 01:18:27', '2018-01-03 01:18:27', null);
INSERT INTO `pickup_code` VALUES ('414', 'additional_service_price', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 01:19:11', '2018-01-03 01:19:11', null);
INSERT INTO `pickup_code` VALUES ('415', 'additional_service_price', 'additional_service', '增值服务', 'text', '1', '1', '1', '', 'additional_service', 'name', '2018-01-03 01:19:11', '2018-01-03 01:19:11', null);
INSERT INTO `pickup_code` VALUES ('416', 'additional_service_price', 'price', '关联价格', 'number', '1', '1', '1', '', 'price', 'id', '2018-01-03 01:19:11', '2018-01-03 01:19:11', null);
INSERT INTO `pickup_code` VALUES ('417', 'additional_service_price', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:19:11', '2018-01-03 01:19:11', null);
INSERT INTO `pickup_code` VALUES ('418', 'additional_service_price', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:19:11', '2018-01-03 01:19:11', null);
INSERT INTO `pickup_code` VALUES ('419', 'additional_service_price', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 01:19:11', '2018-01-03 01:19:11', null);
INSERT INTO `pickup_code` VALUES ('420', 'tag', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-03 07:57:14', '2018-01-03 07:57:14', null);
INSERT INTO `pickup_code` VALUES ('421', 'tag', 'name', '名', 'text', '1', '1', '1', '', '', '', '2018-01-03 07:57:14', '2018-01-03 07:57:14', null);
INSERT INTO `pickup_code` VALUES ('422', 'tag', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 07:57:14', '2018-01-03 07:57:14', null);
INSERT INTO `pickup_code` VALUES ('423', 'tag', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 07:57:15', '2018-01-03 07:57:15', null);
INSERT INTO `pickup_code` VALUES ('424', 'tag', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-03 07:57:15', '2018-01-03 07:57:15', null);
INSERT INTO `pickup_code` VALUES ('425', 'car_transmission', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-04 11:41:40', '2018-01-04 11:41:40', null);
INSERT INTO `pickup_code` VALUES ('426', 'car_transmission', 'name', '名称', 'text', '1', '1', '1', '', '', '', '2018-01-04 11:41:40', '2018-01-04 11:41:40', null);
INSERT INTO `pickup_code` VALUES ('427', 'car_transmission', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-04 11:41:40', '2018-01-04 11:41:40', null);
INSERT INTO `pickup_code` VALUES ('428', 'car_transmission', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-04 11:41:40', '2018-01-04 11:41:40', null);
INSERT INTO `pickup_code` VALUES ('429', 'car_transmission', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-04 11:41:40', '2018-01-04 11:41:40', null);
INSERT INTO `pickup_code` VALUES ('430', 'transmission', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-04 11:49:22', '2018-01-04 11:49:22', null);
INSERT INTO `pickup_code` VALUES ('431', 'transmission', 'name', '名', 'text', '1', '1', '1', '', '', '', '2018-01-04 11:49:22', '2018-01-04 11:49:22', null);
INSERT INTO `pickup_code` VALUES ('432', 'transmission', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-04 11:49:22', '2018-01-04 11:49:33', null);
INSERT INTO `pickup_code` VALUES ('433', 'transmission', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-04 11:49:22', '2018-01-04 11:49:33', null);
INSERT INTO `pickup_code` VALUES ('434', 'transmission', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-04 11:49:23', '2018-01-04 11:49:33', null);
INSERT INTO `pickup_code` VALUES ('435', 'platform', 'id', 'id', 'text', '1', '0', '0', '', '', '', '2018-01-05 08:54:58', '2018-01-05 08:54:58', null);
INSERT INTO `pickup_code` VALUES ('436', 'platform', 'name', '平台名', 'text', '1', '1', '1', '', '', '', '2018-01-05 08:54:58', '2018-01-05 08:54:58', null);
INSERT INTO `pickup_code` VALUES ('437', 'platform', 'created_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-05 08:54:58', '2018-01-05 08:54:58', null);
INSERT INTO `pickup_code` VALUES ('438', 'platform', 'updated_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-05 08:54:58', '2018-01-05 08:54:58', null);
INSERT INTO `pickup_code` VALUES ('439', 'platform', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-05 08:54:59', '2018-01-05 08:54:59', null);
INSERT INTO `pickup_code` VALUES ('440', 'img', 'id', 'ID', 'text', '1', '0', '0', '', '', '', '2018-01-09 09:06:08', '2018-01-09 09:06:08', null);
INSERT INTO `pickup_code` VALUES ('441', 'img', 'path', '路径', 'text', '1', '1', '1', '', '', '', '2018-01-09 09:06:08', '2018-01-09 09:06:08', null);
INSERT INTO `pickup_code` VALUES ('442', 'img', 'type', '类型', 'text', '1', '1', '1', '', '', '', '2018-01-09 09:06:08', '2018-01-09 09:06:08', null);
INSERT INTO `pickup_code` VALUES ('443', 'img', 'created_at', '创建日期', 'text', '1', '0', '0', '', '', '', '2018-01-09 09:06:08', '2018-01-09 09:06:08', null);
INSERT INTO `pickup_code` VALUES ('444', 'img', 'updated_at', '修改日期', 'text', '1', '0', '0', '', '', '', '2018-01-09 09:06:08', '2018-01-09 09:06:08', null);
INSERT INTO `pickup_code` VALUES ('445', 'img', 'deleted_at', '', 'text', '0', '0', '0', '', '', '', '2018-01-09 09:06:08', '2018-01-09 09:06:08', null);

-- ----------------------------
-- Table structure for pickup_coupon
-- ----------------------------
DROP TABLE IF EXISTS `pickup_coupon`;
CREATE TABLE `pickup_coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `is_new` tinyint(4) DEFAULT NULL,
  `day` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_coupon
-- ----------------------------

-- ----------------------------
-- Table structure for pickup_coupon_product
-- ----------------------------
DROP TABLE IF EXISTS `pickup_coupon_product`;
CREATE TABLE `pickup_coupon_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `store` int(10) unsigned DEFAULT NULL,
  `car_patt` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_coupon_product
-- ----------------------------

-- ----------------------------
-- Table structure for pickup_img
-- ----------------------------
DROP TABLE IF EXISTS `pickup_img`;
CREATE TABLE `pickup_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `type` char(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_img
-- ----------------------------
INSERT INTO `pickup_img` VALUES ('1', 'upload/9WqInK1KBmGt87ib8afxdMehROGbhOGLDoAXBSlC.jpeg', 'img', '2018-01-09 17:11:23', '2018-01-09 17:11:23', null);
INSERT INTO `pickup_img` VALUES ('2', 'upload/AiE6CZidqfpFudgeVh6ROMg3To2VOa2GLVwx4JUQ.jpeg', 'img', '2018-01-09 17:11:39', '2018-01-09 17:11:39', null);
INSERT INTO `pickup_img` VALUES ('3', 'upload/xe0dR1GO6G3XX7nMFs442MBjYI4s4pY4jqFIWHXs.jpeg', 'img', '2018-01-09 17:11:42', '2018-01-09 17:11:42', null);
INSERT INTO `pickup_img` VALUES ('4', 'upload/OENBPDMvx46os7djFo6eS8cKLWkr4NVdlFPLzGBx.jpeg', 'img', '2018-01-09 17:11:44', '2018-01-09 17:11:44', null);
INSERT INTO `pickup_img` VALUES ('5', 'upload/QcAMmcDkustmAQ7glte7SAvQoRw3cD0kKurzZ5GS.jpeg', 'img', '2018-01-09 17:11:52', '2018-01-09 17:11:52', null);
INSERT INTO `pickup_img` VALUES ('6', 'upload/A5sjiqnlYDR0aOR0Xp8rPWbH18VKpMlQI8usgL4C.jpeg', 'img', '2018-01-09 17:11:54', '2018-01-09 17:11:54', null);
INSERT INTO `pickup_img` VALUES ('7', 'upload/fLz22J2MXQMyQtrOD3NiebfeIHqNmAoaJwINJn8S.jpeg', 'img', '2018-01-09 17:11:57', '2018-01-09 17:11:57', null);
INSERT INTO `pickup_img` VALUES ('8', 'upload/TqvbKDaRb9GDikK1FXUV38tgFvtJR98KvZd23Of4.jpeg', 'img', '2018-01-09 17:11:59', '2018-01-09 17:11:59', null);
INSERT INTO `pickup_img` VALUES ('9', 'upload/cjKCoGBkXcF3ahyukO32f2YJXWGcyWaGaepsfpB5.jpeg', 'img', '2018-01-09 17:13:30', '2018-01-09 17:13:30', null);
INSERT INTO `pickup_img` VALUES ('10', 'upload/VQGhEgsf03zSaUyJFbIqrX6zRpWclalyIqKeG3KF.jpeg', 'img', '2018-01-09 17:13:55', '2018-01-09 17:13:55', null);
INSERT INTO `pickup_img` VALUES ('11', 'upload/j9isx0AOjrkZoFV6z6cjGU8DZeIXNeqYH0XxHAEJ.jpeg', 'img', '2018-01-09 17:15:12', '2018-01-09 17:15:12', null);
INSERT INTO `pickup_img` VALUES ('12', 'upload/72EBSTwtzOdSO5NPugGcMGQOnl5AVOXyy9V7gRjo.jpeg', 'img', '2018-01-10 14:19:45', '2018-01-10 14:19:45', null);
INSERT INTO `pickup_img` VALUES ('13', 'upload/oJ55jt2dyQ1Ao7bKLIAgiwVsabqmJvM0T8g4GQ1C.jpeg', 'img', '2018-01-10 14:43:02', '2018-01-10 14:43:02', null);
INSERT INTO `pickup_img` VALUES ('14', 'upload/zYqxT5iSTtHbNbg8y7siiSQPxECkWfDCpFdGqbas.jpeg', 'img', '2018-01-10 14:43:25', '2018-01-10 14:43:25', null);
INSERT INTO `pickup_img` VALUES ('15', 'upload/5BIZbnqNpXfsnuk7lgZrVrRVF2cqaVVIewQKnKia.jpeg', 'img', '2018-01-10 14:44:15', '2018-01-10 14:44:15', null);
INSERT INTO `pickup_img` VALUES ('16', 'upload/5t2o86bU9GgvFMh9ZuyMBhmuQpQLCcfL8nXc5UBH.jpeg', 'img', '2018-01-10 14:44:44', '2018-01-10 14:44:44', null);
INSERT INTO `pickup_img` VALUES ('17', 'upload/gdTBhN4j2JOYJWZl2PwoyxEukHdwveJAV6wn6A83.jpeg', 'img', '2018-01-10 14:44:49', '2018-01-10 14:44:49', null);
INSERT INTO `pickup_img` VALUES ('18', 'upload/iRSP9mzetzLAHYBKUjEaeGxlj0qhmg77zdlkPEtf.jpeg', 'img', '2018-01-19 14:11:00', '2018-01-19 14:11:00', null);
INSERT INTO `pickup_img` VALUES ('19', 'upload/UBDZnCA8jbFmEc5IhFoPkVprHWA2P5f6xm8V1arH.jpeg', 'img', '2018-01-19 14:11:13', '2018-01-19 14:11:13', null);
INSERT INTO `pickup_img` VALUES ('20', 'upload/oH0IFvZQ3o3JbOny9htwU6m7iNEwCfJEFzDNWXzs.jpeg', 'img', '2018-01-19 14:11:20', '2018-01-19 14:11:20', null);
INSERT INTO `pickup_img` VALUES ('21', 'upload/Ash4XKuQaEKBfRPDQHoKpH6WlAzzI5WVZwYOBL1f.jpeg', 'img', '2018-01-19 14:11:35', '2018-01-19 14:11:35', null);

-- ----------------------------
-- Table structure for pickup_log
-- ----------------------------
DROP TABLE IF EXISTS `pickup_log`;
CREATE TABLE `pickup_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `log_group` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `admin` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pickup_log_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='操作日志';

-- ----------------------------
-- Records of pickup_log
-- ----------------------------
INSERT INTO `pickup_log` VALUES ('2', '<table class=\"table table-bordered\">\r\n    <tr>\r\n        <td>admin2</td>\r\n        <td>黑C1234</td>\r\n    </tr>\r\n</table>', 'order', '11', null, '2018-01-19 13:19:09', '2018-01-19 13:19:09', null);
INSERT INTO `pickup_log` VALUES ('3', '<table class=\"table table-bordered\">\r\n    <tr>\r\n        <td align=\"right\">实际取车时间：</td>\r\n        <td colspan=\"3\">2018-01-19 13:23:45</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\">取车油量：</td>\r\n        <td>\r\n            10 升\r\n        </td>\r\n        <td align=\"right\">取车里程：</td>\r\n        <td>666 km</td>\r\n    </tr>\r\n    <tr>\r\n        <td colspan=\"4\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n        <td>预授权(押金)：¥</td>\r\n        <td>违章押金：¥</td>\r\n        <td>订单金额:¥</td>\r\n        <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n        <td colspan=\"4\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\">其他费用：</td>\r\n        <td colspan=\"3\">10</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\">取车备注：</td>\r\n        <td colspan=\"3\">\r\n            \r\n        </td>\r\n    </tr>\r\n    <tr>\r\n        <td colspan=\"\" align=\"right\">\r\n            已支付金额:\r\n        </td>\r\n        <td colspan=\"3\">\r\n            <p>¥231</p>\r\n        </td>\r\n    </tr>\r\n</table>', 'order', '11', null, '2018-01-19 13:23:57', '2018-01-19 13:23:57', null);
INSERT INTO `pickup_log` VALUES ('4', '<table class=\"table table-bordered\">\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">还车时间：</td>\r\n        <td>2018-01-19 13:23:41</td>\r\n        <td align=\"right\" valign=\"middle\">Admin：</td>\r\n        <td>admin2</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">油量差：</td>\r\n        <td>0L</td>\r\n        <td align=\"right\" valign=\"middle\">还车里程：</td>\r\n        <td>700km</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">超公里数：</td>\r\n        <td>0km</td>\r\n        <td align=\"right\" valign=\"middle\">超小时数：</td>\r\n        <td>0.00h</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">违章罚款：</td>\r\n        <td>¥0</td>\r\n        <td align=\"right\" valign=\"middle\">其他费用：</td>\r\n        <td>¥10</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">仍需支付：</td>\r\n        <td> <span class=\"bg-blue\">¥-2010.00</span></td>\r\n        <td align=\"right\" valign=\"middle\"></td>\r\n        <td></td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">备注：</td>\r\n        <td colspan=\"3\">\r\n            <p>\r\n                正常还车\r\n            </p>\r\n        </td>\r\n    </tr>\r\n</table>', 'order', '11', null, '2018-01-19 13:29:38', '2018-01-19 13:29:38', null);
INSERT INTO `pickup_log` VALUES ('5', '<table class=\"table table-bordered\">\r\n    <tr>\r\n        <td colspan=\"2\">分配车辆</td>\r\n    </tr>\r\n    <tr>\r\n        <td>admin2</td>\r\n        <td>黑E8888</td>\r\n    </tr>\r\n</table>', 'order', '11', null, '2018-01-19 13:55:35', '2018-01-19 13:55:35', null);
INSERT INTO `pickup_log` VALUES ('6', '<table class=\"table table-bordered\">\r\n    <tr>\r\n        <td colspan=\"4\">\r\n            取车\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\">实际取车时间：</td>\r\n        <td colspan=\"3\">2018-01-19 13:55:46</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\">取车油量：</td>\r\n        <td>\r\n            50 升\r\n        </td>\r\n        <td align=\"right\">取车里程：</td>\r\n        <td>666 km</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\">其他费用：</td>\r\n        <td colspan=\"3\">0</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\">取车备注：</td>\r\n        <td colspan=\"3\">\r\n            \r\n        </td>\r\n    </tr>\r\n    <tr>\r\n        <td colspan=\"\" align=\"right\">\r\n            已支付金额:\r\n        </td>\r\n        <td colspan=\"3\">\r\n            <p>¥231</p>\r\n        </td>\r\n    </tr>\r\n</table>', 'order', '11', null, '2018-01-19 13:55:55', '2018-01-19 13:55:55', null);
INSERT INTO `pickup_log` VALUES ('7', '<table class=\"table table-bordered\">\r\n    <tr>\r\n        <td colspan=\"4\">\r\n            还车\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">还车时间：</td>\r\n        <td>2018-01-24 20:00:00</td>\r\n        <td align=\"right\" valign=\"middle\">Admin：</td>\r\n        <td>admin2</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">油量差：</td>\r\n        <td>0L</td>\r\n        <td align=\"right\" valign=\"middle\">还车里程：</td>\r\n        <td>0km</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">超公里数：</td>\r\n        <td>0km</td>\r\n        <td align=\"right\" valign=\"middle\">超小时数：</td>\r\n        <td>1.00h</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">违章罚款：</td>\r\n        <td>¥0</td>\r\n        <td align=\"right\" valign=\"middle\">其他费用：</td>\r\n        <td>¥0</td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">仍需支付：</td>\r\n        <td> <span class=\"bg-blue\">¥-2005.00</span></td>\r\n        <td align=\"right\" valign=\"middle\"></td>\r\n        <td></td>\r\n    </tr>\r\n    <tr>\r\n        <td align=\"right\" valign=\"middle\">备注：</td>\r\n        <td colspan=\"3\">\r\n            <p>\r\n                \r\n            </p>\r\n        </td>\r\n    </tr>\r\n</table>', 'order', '11', null, '2018-01-19 13:56:28', '2018-01-19 13:56:28', null);

-- ----------------------------
-- Table structure for pickup_order
-- ----------------------------
DROP TABLE IF EXISTS `pickup_order`;
CREATE TABLE `pickup_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `oth_order_id` varchar(255) DEFAULT NULL,
  `platform` int(11) unsigned DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `paid` double(11,2) DEFAULT '0.00',
  `car` int(10) unsigned DEFAULT NULL,
  `car_patt` int(11) unsigned DEFAULT NULL,
  `license_plate` varchar(30) DEFAULT NULL,
  `store` int(11) unsigned DEFAULT NULL,
  `city` int(11) unsigned DEFAULT NULL,
  `pickup_store` int(11) unsigned DEFAULT NULL,
  `return_store` int(11) unsigned DEFAULT NULL,
  `pickup_time` datetime DEFAULT NULL,
  `return_time` datetime DEFAULT NULL,
  `coupon_code` int(10) unsigned DEFAULT NULL,
  `coupon_price` int(10) unsigned DEFAULT NULL,
  `use_name` varchar(30) DEFAULT NULL,
  `use_phone` varchar(30) DEFAULT NULL,
  `card_type` int(11) unsigned DEFAULT NULL,
  `card_no` varchar(255) DEFAULT NULL,
  `price_mark` int(11) DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `cancel_price` double(11,2) DEFAULT NULL,
  `pay_status` int(11) DEFAULT NULL,
  `pay_method` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `show` int(1) DEFAULT '0',
  `extra` char(32) DEFAULT NULL,
  `search_key` varchar(500) DEFAULT NULL,
  `status_ref` int(11) unsigned DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_order
-- ----------------------------
INSERT INTO `pickup_order` VALUES ('11', '12315654654', '1', '231.00', '231.00', '6', '3', '黑E8888', '1', '230100', '1', '1', '2018-01-18 14:00:00', '2018-01-24 19:00:00', null, null, '郭龙', '13512685663', '1', '555555555555', null, null, null, null, '预付', '666', '1', '0d6541c478cc901c41d3963645a1f5ac', '555555555555福特野马郭龙glguolong135126856631112315654654松北店sbdsongbeidian松北店sbdsongbeidian松北店sbdsongbeidian哈尔滨市hebshaerbinshi黑C5555heiC5555黑C7777heiC7777黑E8888heiE8888黑C7777heiC7777黑C1234heiC1234黑C5555heiC5555黑C1234heiC1234黑C5555heiC5555黑C1234heiC1234黑C7777heiC7777黑C1234heiC1234黑E8888heiE8888', null, '2018-01-19 13:56:28', null, '2018-01-17 14:52:01', '此订单加价100元');

-- ----------------------------
-- Table structure for pickup_order_additional_service
-- ----------------------------
DROP TABLE IF EXISTS `pickup_order_additional_service`;
CREATE TABLE `pickup_order_additional_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `additional_service` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pickup_order_additional_service_id_uindex` (`id`),
  UNIQUE KEY `pickup_order_additional_service_order_uindex` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单和增值服务';

-- ----------------------------
-- Records of pickup_order_additional_service
-- ----------------------------

-- ----------------------------
-- Table structure for pickup_order_status
-- ----------------------------
DROP TABLE IF EXISTS `pickup_order_status`;
CREATE TABLE `pickup_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pickup_order_status_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='订单状态';

-- ----------------------------
-- Records of pickup_order_status
-- ----------------------------
INSERT INTO `pickup_order_status` VALUES ('17', '11', '1', '2018-01-17 14:43:37', '2018-01-17 14:43:37', null);
INSERT INTO `pickup_order_status` VALUES ('18', '11', '1', '2018-01-17 14:52:01', '2018-01-17 14:52:01', null);

-- ----------------------------
-- Table structure for pickup_order_tag
-- ----------------------------
DROP TABLE IF EXISTS `pickup_order_tag`;
CREATE TABLE `pickup_order_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL COMMENT '订单id',
  `tag` int(11) DEFAULT NULL COMMENT 'tag标记',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='关于订单的一些标记，例如途牛会员';

-- ----------------------------
-- Records of pickup_order_tag
-- ----------------------------
INSERT INTO `pickup_order_tag` VALUES ('14', '11', '1', null, null, null);

-- ----------------------------
-- Table structure for pickup_pay_method
-- ----------------------------
DROP TABLE IF EXISTS `pickup_pay_method`;
CREATE TABLE `pickup_pay_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_pay_method
-- ----------------------------
INSERT INTO `pickup_pay_method` VALUES ('1', '预付', 'P', null, null, null);
INSERT INTO `pickup_pay_method` VALUES ('2', '现付', 'C', null, null, null);
INSERT INTO `pickup_pay_method` VALUES ('3', '不限', 'N', null, null, null);

-- ----------------------------
-- Table structure for pickup_pickup_price
-- ----------------------------
DROP TABLE IF EXISTS `pickup_pickup_price`;
CREATE TABLE `pickup_pickup_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pickup_time` datetime DEFAULT NULL,
  `order` int(11) unsigned DEFAULT NULL,
  `oil` double(11,2) DEFAULT '0.00',
  `km` double(11,2) DEFAULT '0.00',
  `paid` int(11) DEFAULT '0',
  `oth_fee` int(11) DEFAULT '0',
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `admin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_pickup_price
-- ----------------------------
INSERT INTO `pickup_pickup_price` VALUES ('2', '2018-01-19 13:55:46', '11', '50.00', '666.00', '2010', '0', null, '2018-01-17 15:58:30', '2018-01-19 13:55:55', null, 'admin2');

-- ----------------------------
-- Table structure for pickup_platform
-- ----------------------------
DROP TABLE IF EXISTS `pickup_platform`;
CREATE TABLE `pickup_platform` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_platform
-- ----------------------------
INSERT INTO `pickup_platform` VALUES ('1', '途牛', null, null, null);

-- ----------------------------
-- Table structure for pickup_price
-- ----------------------------
DROP TABLE IF EXISTS `pickup_price`;
CREATE TABLE `pickup_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `car_patt` int(10) unsigned DEFAULT NULL,
  `store` int(11) unsigned DEFAULT NULL,
  `basic_service_fee` double(11,4) unsigned DEFAULT '0.0000',
  `service_fee` double(11,4) unsigned DEFAULT '0.0000',
  `ultra_hour_fee` double(11,2) unsigned DEFAULT '0.00',
  `ultra_km_fee` double(11,2) unsigned DEFAULT '0.00',
  `pre_authorization_fee` double(11,2) unsigned DEFAULT '0.00',
  `Illegal_deposit` double(11,2) unsigned DEFAULT '0.00',
  `off_site_fee` double(11,2) DEFAULT '0.00',
  `night_give_fee` double(11,2) DEFAULT '0.00',
  `night_return_fee` double(11,2) unsigned DEFAULT '0.00',
  `night_start_time` time DEFAULT '00:00:00',
  `night_end_time` time DEFAULT '00:00:00',
  `platform` int(11) unsigned DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `basic_insurance` double(11,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_price
-- ----------------------------
INSERT INTO `pickup_price` VALUES ('1', '1', '1', '10.0000', '34.0000', '5.00', '5.00', '3000.00', '2000.00', '1.00', '20.00', '20.00', '00:00:00', '05:00:00', '1', '1', '2018-01-05 08:48:34', '2018-01-05 10:23:45', null, '0.00');
INSERT INTO `pickup_price` VALUES ('3', '2', '1', '10.0000', '50.0000', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '00:00:00', '00:00:00', '1', '1', '2018-01-05 10:52:32', '2018-01-05 10:52:42', null, '0.00');
INSERT INTO `pickup_price` VALUES ('4', '3', '1', '0.0000', '60.0000', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '00:00:00', '00:00:00', '1', '1', '2018-01-06 11:16:33', '2018-01-06 11:16:33', null, '0.00');

-- ----------------------------
-- Table structure for pickup_price_float
-- ----------------------------
DROP TABLE IF EXISTS `pickup_price_float`;
CREATE TABLE `pickup_price_float` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` int(10) unsigned DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `num_type` tinyint(1) DEFAULT NULL,
  `float_type` varchar(10) DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_price_float
-- ----------------------------
INSERT INTO `pickup_price_float` VALUES ('6', '1', '1', '1', 'week_range', '1', null, null, null, null, '2018-01-16 12:03:29', '2018-01-16 14:03:09', '2018-01-16 14:03:09');
INSERT INTO `pickup_price_float` VALUES ('15', '1', '4', '1', 'week_range', '1', null, null, null, null, '2018-01-16 14:15:41', '2018-01-16 14:15:41', null);

-- ----------------------------
-- Table structure for pickup_price_info
-- ----------------------------
DROP TABLE IF EXISTS `pickup_price_info`;
CREATE TABLE `pickup_price_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `basic_service_fee` double(11,2) DEFAULT NULL,
  `service_fee` double(11,2) DEFAULT NULL,
  `ultra_hour_fee` double(11,2) DEFAULT NULL,
  `ultra_km_fee` double(11,2) DEFAULT NULL,
  `pre_authorization_fee` double(11,2) DEFAULT NULL,
  `Illegal_deposit` double(11,2) DEFAULT NULL,
  `off_site_fee` double(11,2) DEFAULT NULL,
  `night_give_fee` double(11,2) DEFAULT NULL,
  `night_return_fee` double(11,2) DEFAULT NULL,
  `night_start_time` time DEFAULT NULL,
  `night_end_time` time DEFAULT NULL,
  `platform` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_price_info
-- ----------------------------
INSERT INTO `pickup_price_info` VALUES ('2', '11', '231.00', '10.00', '221.00', '5.00', '5.00', '10.00', '2000.00', '1.00', '20.00', '20.00', null, null, '1', '2018-01-17 14:51:59', '2018-01-17 14:51:59', null);

-- ----------------------------
-- Table structure for pickup_price_item
-- ----------------------------
DROP TABLE IF EXISTS `pickup_price_item`;
CREATE TABLE `pickup_price_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `phpobj` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `price_item_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COMMENT='价格项';

-- ----------------------------
-- Records of pickup_price_item
-- ----------------------------
INSERT INTO `pickup_price_item` VALUES ('58', '11', '服务费', '221.00', 'O:18:\"App\\Lib\\serviceFee\":12:{s:7:\"\0*\0hour\";N;s:8:\"\0*\0price\";O:15:\"App\\Model\\Price\":26:{s:8:\"\0*\0table\";s:5:\"price\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:11:\"\0*\0original\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:13:\"getAdditional\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:2:{i:0;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:3;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:3;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}s:12:\"\0*\0priceInfo\";O:17:\"App\\Lib\\PriceInfo\":5:{s:12:\"priceupStore\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:11:\"returnStore\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}s:10:\"pickupTime\";s:19:\"2018-01-18 14:00:00\";s:10:\"returnTime\";s:19:\"2018-01-24 19:00:00\";s:7:\"carPatt\";a:1:{i:0;i:1;}}s:4:\"name\";s:9:\"服务费\";s:9:\"unitPrice\";s:3:\"项\";s:4:\"code\";s:9:\"服务费\";s:6:\"\0*\0add\";d:221;s:6:\"\0*\0day\";i:6;s:4:\"\0*\0d\";d:6.5;s:4:\"\0*\0h\";i:0;s:4:\"show\";b:1;s:6:\"\0*\0num\";i:1;}', '2018-01-17 14:52:01', '2018-01-17 14:52:01', null);
INSERT INTO `pickup_price_item` VALUES ('59', '11', '超小时费', '0.00', 'O:19:\"App\\Lib\\OverTimeFee\":10:{s:5:\"price\";O:15:\"App\\Model\\Price\":26:{s:8:\"\0*\0table\";s:5:\"price\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:11:\"\0*\0original\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:13:\"getAdditional\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:2:{i:0;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}s:9:\"priceInfo\";N;s:1:\"h\";i:0;s:4:\"name\";s:12:\"超小时费\";s:9:\"unitPrice\";s:1:\"h\";s:4:\"code\";s:65:\"一天按照8计算,超出半天部分按照超小时费用计算\";s:6:\"\0*\0add\";d:0;s:4:\"show\";b:1;s:6:\"\0*\0num\";i:0;s:2:\"pi\";O:17:\"App\\Lib\\PriceInfo\":5:{s:12:\"priceupStore\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:11:\"returnStore\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}s:10:\"pickupTime\";s:19:\"2018-01-18 14:00:00\";s:10:\"returnTime\";s:19:\"2018-01-24 19:00:00\";s:7:\"carPatt\";a:1:{i:0;i:1;}}}', '2018-01-17 14:52:01', '2018-01-17 14:52:01', null);
INSERT INTO `pickup_price_item` VALUES ('60', '11', '基础服务费', '10.00', 'O:23:\"App\\Lib\\basicServiceFee\":8:{s:5:\"price\";O:15:\"App\\Model\\Price\":26:{s:8:\"\0*\0table\";s:5:\"price\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:11:\"\0*\0original\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:13:\"getAdditional\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:2:{i:0;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}s:4:\"name\";s:15:\"基础服务费\";s:12:\"\0*\0now_price\";i:0;s:3:\"add\";d:10;s:4:\"code\";s:15:\"基础服务费\";s:4:\"show\";b:0;s:9:\"unitPrice\";s:3:\"项\";s:6:\"\0*\0num\";i:1;}', '2018-01-17 14:52:01', '2018-01-17 14:52:01', null);
INSERT INTO `pickup_price_item` VALUES ('61', '11', '夜间取车费', '0.00', 'O:24:\"App\\Lib\\nightPickupPrice\":8:{s:8:\"\0*\0price\";O:15:\"App\\Model\\Price\":26:{s:8:\"\0*\0table\";s:5:\"price\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:11:\"\0*\0original\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:13:\"getAdditional\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:2:{i:0;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}s:12:\"\0*\0priceInfo\";O:17:\"App\\Lib\\PriceInfo\":5:{s:12:\"priceupStore\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:11:\"returnStore\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}s:10:\"pickupTime\";s:19:\"2018-01-18 14:00:00\";s:10:\"returnTime\";s:19:\"2018-01-24 19:00:00\";s:7:\"carPatt\";a:1:{i:0;i:1;}}s:4:\"name\";s:15:\"夜间取车费\";s:3:\"add\";i:0;s:4:\"code\";s:15:\"夜间取车费\";s:4:\"show\";b:1;s:9:\"unitPrice\";s:3:\"项\";s:6:\"\0*\0num\";i:1;}', '2018-01-17 14:52:01', '2018-01-17 14:52:01', null);
INSERT INTO `pickup_price_item` VALUES ('62', '11', '夜间换车费', '0.00', 'O:24:\"App\\Lib\\nightReturnPrice\":8:{s:8:\"\0*\0price\";O:15:\"App\\Model\\Price\":26:{s:8:\"\0*\0table\";s:5:\"price\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:11:\"\0*\0original\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:13:\"getAdditional\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:2:{i:0;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}s:12:\"\0*\0priceInfo\";O:17:\"App\\Lib\\PriceInfo\":5:{s:12:\"priceupStore\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:11:\"returnStore\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}s:10:\"pickupTime\";s:19:\"2018-01-18 14:00:00\";s:10:\"returnTime\";s:19:\"2018-01-24 19:00:00\";s:7:\"carPatt\";a:1:{i:0;i:1;}}s:4:\"name\";s:15:\"夜间换车费\";s:3:\"add\";i:0;s:4:\"code\";s:15:\"夜间换车费\";s:4:\"show\";b:1;s:9:\"unitPrice\";s:3:\"项\";s:6:\"\0*\0num\";i:1;}', '2018-01-17 14:52:01', '2018-01-17 14:52:01', null);
INSERT INTO `pickup_price_item` VALUES ('63', '11', '价格浮动', '0.00', 'O:18:\"App\\Lib\\priceFloat\":9:{s:5:\"price\";O:15:\"App\\Model\\Price\":26:{s:8:\"\0*\0table\";s:5:\"price\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:11:\"\0*\0original\";a:20:{s:2:\"id\";i:1;s:8:\"car_patt\";i:1;s:5:\"store\";i:1;s:17:\"basic_service_fee\";d:10;s:11:\"service_fee\";d:34;s:14:\"ultra_hour_fee\";d:5;s:12:\"ultra_km_fee\";d:5;s:21:\"pre_authorization_fee\";d:10;s:15:\"Illegal_deposit\";d:2000;s:12:\"off_site_fee\";d:1;s:14:\"night_give_fee\";d:20;s:16:\"night_return_fee\";d:20;s:16:\"night_start_time\";s:8:\"00:00:00\";s:14:\"night_end_time\";s:8:\"05:00:00\";s:8:\"platform\";i:1;s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 08:48:34\";s:10:\"updated_at\";s:19:\"2018-01-05 10:23:45\";s:10:\"deleted_at\";N;s:15:\"basic_insurance\";d:0;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:13:\"getAdditional\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:2:{i:0;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"午餐\";s:4:\"desc\";s:18:\"提供免费午餐\";s:5:\"price\";i:20;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"updated_at\";s:19:\"2018-01-05 10:36:13\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:3;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:28:\"App\\Model\\Additional_service\":26:{s:8:\"\0*\0table\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:1:{i:0;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"儿童座椅\";s:4:\"desc\";s:18:\"后排儿童座椅\";s:5:\"price\";i:50;s:4:\"type\";i:1;s:10:\"created_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"updated_at\";s:19:\"2018-01-05 10:13:27\";s:10:\"deleted_at\";N;s:11:\"pivot_price\";i:1;s:24:\"pivot_additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":28:{s:6:\"parent\";r:2;s:13:\"\0*\0foreignKey\";s:5:\"price\";s:13:\"\0*\0relatedKey\";s:18:\"additional_service\";s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:24:\"additional_service_price\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:11:\"\0*\0original\";a:2:{s:5:\"price\";i:1;s:18:\"additional_service\";i:1;}s:8:\"\0*\0casts\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:9:\"\0*\0events\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}s:9:\"priceInfo\";O:17:\"App\\Lib\\PriceInfo\":5:{s:12:\"priceupStore\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:11:\"returnStore\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}s:10:\"pickupTime\";s:19:\"2018-01-18 14:00:00\";s:10:\"returnTime\";s:19:\"2018-01-24 19:00:00\";s:7:\"carPatt\";a:1:{i:0;i:1;}}s:8:\"nowPrice\";d:231;s:4:\"name\";s:12:\"价格浮动\";s:3:\"add\";i:0;s:4:\"code\";s:12:\"价格浮动\";s:4:\"show\";b:0;s:9:\"unitPrice\";s:3:\"项\";s:6:\"\0*\0num\";i:1;}', '2018-01-17 14:52:01', '2018-01-17 14:52:01', null);

-- ----------------------------
-- Table structure for pickup_return_price
-- ----------------------------
DROP TABLE IF EXISTS `pickup_return_price`;
CREATE TABLE `pickup_return_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `ultra_km` double(11,2) DEFAULT NULL,
  `return_km` double(11,2) DEFAULT NULL,
  `ultra_hour` double(11,2) DEFAULT NULL,
  `diff_oil` double(11,2) DEFAULT NULL,
  `return_time` datetime DEFAULT NULL,
  `ultra_hour_fee` double(11,2) DEFAULT NULL,
  `ultra_km_fee` double(11,2) DEFAULT NULL,
  `oil_fee` double(11,2) DEFAULT NULL,
  `oth_fee` double(11,2) DEFAULT NULL,
  `desc` text,
  `Illegal_deposit` double(11,2) DEFAULT NULL,
  `need_pay` double(11,2) DEFAULT NULL,
  `paid` double(11,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `admin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_return_price
-- ----------------------------
INSERT INTO `pickup_return_price` VALUES ('1', '11', '0.00', '0.00', '1.00', '0.00', '2018-01-24 20:00:00', '5.00', '5.00', '7.30', '0.00', null, '0.00', '-2005.00', '2241.00', '2018-01-18 16:20:41', '2018-01-19 13:56:28', null, 'admin2');

-- ----------------------------
-- Table structure for pickup_setting
-- ----------------------------
DROP TABLE IF EXISTS `pickup_setting`;
CREATE TABLE `pickup_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pickup_setting_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='设置';

-- ----------------------------
-- Records of pickup_setting
-- ----------------------------
INSERT INTO `pickup_setting` VALUES ('1', '几小时算一天？', 'h', '8', '2018-01-15 12:53:22', '2018-01-15 12:53:24', null);

-- ----------------------------
-- Table structure for pickup_status
-- ----------------------------
DROP TABLE IF EXISTS `pickup_status`;
CREATE TABLE `pickup_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_status
-- ----------------------------

-- ----------------------------
-- Table structure for pickup_store
-- ----------------------------
DROP TABLE IF EXISTS `pickup_store`;
CREATE TABLE `pickup_store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `person` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `location_poi` varchar(50) DEFAULT NULL,
  `location_name` varchar(30) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `rent_pre` int(11) DEFAULT '0',
  `fee` int(11) DEFAULT '0',
  `minimal_advance_booking_time` time DEFAULT '00:00:00',
  `the_larges_advance_scheduled_time` time DEFAULT '00:00:00',
  `payment_method` varchar(10) DEFAULT NULL COMMENT '门店支付方式 N：不限，P：预付，C：现付',
  `store` int(11) DEFAULT '0',
  `diff_store_rank` varchar(10) DEFAULT NULL COMMENT 'SCSS： 表示只支持同城市同门店;SCDS：同城市异门店；DCDS：异城市异门店。',
  `cancel_time` double(11,2) DEFAULT '0.00',
  `cancel_pre` double(11,2) DEFAULT '0.00',
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_store
-- ----------------------------
INSERT INTO `pickup_store` VALUES ('1', '松北店', '松先生', '13512688888', '06:00:00', '23:00:00', '126.562789,45.808394', '哈尔滨机场', '1', '1', '0', '0', '00:30:00', '720:37:00', '1', '0', 'SCSS', null, null, '1', '2018-01-03 07:20:32', '2018-01-03 07:39:07', null);
INSERT INTO `pickup_store` VALUES ('2', '世茂大道', '世', '13512688888', '06:00:00', '19:00:00', '126.502975,45.803443', '四海鲜附近', '1', '2', '10', '10', '01:00:00', '48:00:00', '1', '1', 'SCSS', null, null, '1', '2018-01-03 07:28:09', '2018-01-03 07:28:09', null);
INSERT INTO `pickup_store` VALUES ('3', '松北第二个店', '北', '13512688888', '08:00:00', '23:00:00', '126.607688,45.82487', '松北区政府', '1', '2', '10', '10', '01:00:00', '48:00:00', '1', '1', 'SCSS', '24.00', '100.00', '1', '2018-01-04 10:59:07', '2018-01-04 10:59:07', null);
INSERT INTO `pickup_store` VALUES ('5', '松北区新源店', '新源', '13512685888', '10:00:00', '22:00:00', '126.555458,45.872864', '松北区学院南路', '1', '1', '0', '0', '01:00:00', '48:00:00', '1', '0', 'DCDS', '3.00', '100.00', '1', '2018-01-05 13:13:17', '2018-01-05 13:13:17', null);
INSERT INTO `pickup_store` VALUES ('6', '北京某', '北京某', '18710085663', '05:00:00', '19:00:00', '116.42792,39.902896', '北京站', '4', '1', '0', '0', '00:00:00', '240:00:00', '3', '1', 'SCSS', '0.00', '0.00', '1', '2018-01-19 15:44:12', '2018-01-19 15:44:12', null);
INSERT INTO `pickup_store` VALUES ('7', '北京门店2', '门店2', '186916613518', '06:00:00', '22:00:00', '116.42792,39.902896', '北京西站', '4', '1', '0', '0', '00:00:00', '72:00:00', '3', '1', 'SCSS', '0.00', '0.00', '1', '2018-01-19 15:47:04', '2018-01-19 15:47:04', null);
INSERT INTO `pickup_store` VALUES ('8', '门店3', '门店3', '13512688888', '07:00:00', '23:00:00', '116.42792,39.902896', '北京东站', '4', '1', '0', '0', '00:00:00', '72:00:00', '3', '1', 'SCSS', '0.00', '0.00', '1', '2018-01-19 15:47:55', '2018-01-19 15:47:55', null);

-- ----------------------------
-- Table structure for pickup_store_return
-- ----------------------------
DROP TABLE IF EXISTS `pickup_store_return`;
CREATE TABLE `pickup_store_return` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store` int(11) unsigned DEFAULT NULL,
  `return_store` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pickup_store_return
-- ----------------------------
INSERT INTO `pickup_store_return` VALUES ('5', '1', '1', null, null, null);
INSERT INTO `pickup_store_return` VALUES ('6', '1', '2', null, null, null);
INSERT INTO `pickup_store_return` VALUES ('7', '1', '3', null, null, null);
INSERT INTO `pickup_store_return` VALUES ('9', '5', '5', null, null, null);
INSERT INTO `pickup_store_return` VALUES ('10', '6', '6', null, null, null);
INSERT INTO `pickup_store_return` VALUES ('11', '7', '7', null, null, null);
INSERT INTO `pickup_store_return` VALUES ('12', '8', '8', null, null, null);

-- ----------------------------
-- Table structure for pickup_tag
-- ----------------------------
DROP TABLE IF EXISTS `pickup_tag`;
CREATE TABLE `pickup_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_tag
-- ----------------------------
INSERT INTO `pickup_tag` VALUES ('1', '途牛高星会员', '2018-01-13 09:31:04', '2018-01-13 09:31:06', null);

-- ----------------------------
-- Table structure for pickup_transmission
-- ----------------------------
DROP TABLE IF EXISTS `pickup_transmission`;
CREATE TABLE `pickup_transmission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pickup_transmission
-- ----------------------------
INSERT INTO `pickup_transmission` VALUES ('1', '手动', 'M', null, null, null);
INSERT INTO `pickup_transmission` VALUES ('2', '自动', 'A', null, null, null);
