/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : cake

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-10-20 00:05:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for active
-- ----------------------------
DROP TABLE IF EXISTS `active`;
CREATE TABLE `active` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active_title` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '活动标题',
  `created_at` datetime DEFAULT NULL,
  `active_img` varchar(255) DEFAULT NULL,
  `begin_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL COMMENT '折扣',
  `money` decimal(10,2) DEFAULT NULL COMMENT '优惠金额',
  `is_fine` tinyint(1) DEFAULT NULL COMMENT '0 不显示主页  1 显示主页',
  `type` tinyint(1) DEFAULT NULL COMMENT '1 折扣  2 减价',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of active
-- ----------------------------
INSERT INTO `active` VALUES ('1', 'ces ', null, '/upload/active/2017101311022959e02cc5c75d7.jpg', '2017-10-13 06:00:00', '2017-10-17 23:00:00', '80.00', '10.00', '1', '1', '2017-10-13 21:31:31');
INSERT INTO `active` VALUES ('2', '抢购', '2017-10-18 20:30:07', '/upload/active/2017101820294159e74935e9840.jpg', '2017-10-18 16:00:00', '2017-10-21 23:00:00', '80.00', '10.00', '1', '1', null);

-- ----------------------------
-- Table structure for active_goods
-- ----------------------------
DROP TABLE IF EXISTS `active_goods`;
CREATE TABLE `active_goods` (
  `id` int(11) NOT NULL,
  `active_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of active_goods
-- ----------------------------

-- ----------------------------
-- Table structure for active_price
-- ----------------------------
DROP TABLE IF EXISTS `active_price`;
CREATE TABLE `active_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `price_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `begin_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of active_price
-- ----------------------------

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(100) DEFAULT NULL COMMENT '手机号',
  `pwd` varchar(50) DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', '18329042977', '123');

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES ('1', '/upload/banner/2017101820241959e747f377672.jpg', '/detail/29', null, '2017-10-18 20:24:34');
INSERT INTO `banner` VALUES ('2', '/upload/banner/2017101820242759e747fbab833.jpg', 'javascript:;', null, '2017-10-18 20:24:34');

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `price_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('10', '1', '33', '92', '1', '2017-10-18 20:43:12', null);

-- ----------------------------
-- Table structure for cart_sku
-- ----------------------------
DROP TABLE IF EXISTS `cart_sku`;
CREATE TABLE `cart_sku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '组套时 多个商品id',
  `sku_value_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cart_sku
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `category` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_parent` smallint(6) DEFAULT '0' COMMENT '1 是父级 2 不是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '0', '蛋糕', '2017-09-29 14:43:13', null, '1');
INSERT INTO `category` VALUES ('2', '0', '饮料', '2017-09-29 14:43:48', null, '1');
INSERT INTO `category` VALUES ('3', '0', '干糕', '2017-09-29 14:44:06', null, '1');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `goods_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `sale_num` int(11) DEFAULT '0' COMMENT '销量',
  `category_id` int(11) DEFAULT NULL,
  `is_hot` tinyint(4) DEFAULT '0' COMMENT '是否热销 1 是 0 不是',
  `show_price` decimal(10,2) DEFAULT NULL COMMENT '缩略图显示价格',
  `is_active` tinyint(1) DEFAULT NULL COMMENT '是否要参与活动， 1 是   0 否  适用于价格比较低的商品',
  `is_onsale` tinyint(1) DEFAULT '1' COMMENT '1  上架 0 不上架',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('28', '奶油蛋糕', '/upload/goods/2017092916332259ce0552ad266.jpg', '2017-09-29 16:36:10', '2017-10-18 20:30:57', '10', '1', '0', '0.00', '1', '1');
INSERT INTO `goods` VALUES ('29', '慕斯蛋糕', '/upload/goods/2017092916420459ce075c42e86.jpg', '2017-09-29 16:42:45', '2017-10-18 20:30:52', '0', '1', '0', '98.00', '1', '0');
INSERT INTO `goods` VALUES ('30', '新蛋糕', '/upload/goods/2017092921314759ce4b43d7c71.jpg', '2017-09-29 21:32:06', '2017-10-18 20:31:03', '0', '1', '0', '0.00', '0', '1');
INSERT INTO `goods` VALUES ('31', '王者荣耀蛋糕', '/upload/goods/2017101820223459e7478a2989f.jpg', '2017-10-18 20:23:52', '0000-00-00 00:00:00', '0', '1', '1', '108.00', '1', '1');
INSERT INTO `goods` VALUES ('32', '面包', '/upload/goods/2017101820251459e7482adee71.jpg', '2017-10-18 20:25:43', '2017-10-18 20:30:45', '0', '3', '0', '0.00', '1', '1');
INSERT INTO `goods` VALUES ('33', '方型小蛋糕', '/upload/goods/2017101820270459e74898ddd94.jpg', '2017-10-18 20:27:54', '2017-10-18 20:30:40', '0', '1', '1', '30.00', '1', '1');
INSERT INTO `goods` VALUES ('34', 'ces ', '/upload/goods/2017101823175759e770a5937d6.png', '2017-10-18 23:18:11', '0000-00-00 00:00:00', '0', '1', '0', '123.00', '1', '1');
INSERT INTO `goods` VALUES ('35', '32', '/upload/goods/2017101823182159e770bdb039c.png', '2017-10-18 23:18:33', '0000-00-00 00:00:00', '0', '1', '0', '123.00', '1', '1');
INSERT INTO `goods` VALUES ('36', '3', '/upload/goods/2017101823184559e770d50aadc.png', '2017-10-18 23:18:53', '0000-00-00 00:00:00', '0', '1', '0', '123.00', '1', '1');
INSERT INTO `goods` VALUES ('37', '324', '/upload/goods/2017101823190859e770ecbde45.png', '2017-10-18 23:19:18', '0000-00-00 00:00:00', '0', '1', '0', '312.00', '1', '1');
INSERT INTO `goods` VALUES ('38', '65', '/upload/goods/2017101823193059e77102b6baf.png', '2017-10-18 23:19:39', '0000-00-00 00:00:00', '0', '1', '0', '0.00', '1', '1');
INSERT INTO `goods` VALUES ('39', '43', '/upload/goods/2017101823195359e77119340ea.png', '2017-10-18 23:20:01', '0000-00-00 00:00:00', '0', '1', '0', '123.00', '1', '1');
INSERT INTO `goods` VALUES ('40', '24', '/upload/goods/2017101823202459e77138e68de.png', '2017-10-18 23:20:34', '0000-00-00 00:00:00', '0', '1', '0', '12.00', '1', '1');
INSERT INTO `goods` VALUES ('41', '43', '/upload/goods/2017101823204559e7714dde6f5.png', '2017-10-18 23:20:54', '0000-00-00 00:00:00', '0', '1', '0', '1.00', '1', '1');
INSERT INTO `goods` VALUES ('42', '342', '/upload/goods/2017101823210859e7716486b0d.png', '2017-10-18 23:21:16', '0000-00-00 00:00:00', '0', '1', '0', '0.00', '1', '1');
INSERT INTO `goods` VALUES ('43', '43', '/upload/goods/2017101823212759e77177b8738.png', '2017-10-18 23:21:38', '0000-00-00 00:00:00', '0', '1', '0', '123.00', '1', '1');

-- ----------------------------
-- Table structure for goods_content
-- ----------------------------
DROP TABLE IF EXISTS `goods_content`;
CREATE TABLE `goods_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of goods_content
-- ----------------------------
INSERT INTO `goods_content` VALUES ('1', '28', '<p>				</p><p>				</p><p>				</p><p>				</p><p>				</p><p style=\"text-align: center;\">奶油蛋糕<img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066740268473.jpg\"/><img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066740358062.png\"/></p><p></p><p>\n				</p><p>\n				</p><p>\n				</p><p>\n				</p><p>\n				</p>', null, '2017-09-30 09:49:47');
INSERT INTO `goods_content` VALUES ('2', '29', '<h1 style=\"text-align: center;\">慕斯蛋糕</h1><p><img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066745434974.jpg\"/>\n			</p>', null, null);
INSERT INTO `goods_content` VALUES ('3', '30', '<p>				</p><p>				</p><p>				</p><p>				</p><p>				</p><p style=\"text-align: center;\"><img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170930/15067535741247.jpg\"/></p><p>\n				</p><p>\n				</p><p>\n				</p><p>\n				</p><p>\n				</p>', null, '2017-10-18 10:19:07');
INSERT INTO `goods_content` VALUES ('4', '31', '<p style=\"text-align: center;\"><span style=\"font-size:18px\"><br/></span></p><p style=\"text-align: center;\"><span style=\"font-size:18px\">推荐蛋糕</span></p><p style=\"text-align: center;\"><span style=\"font-size:18px\">王者荣耀款</span></p><p>\n			</p>', null, null);
INSERT INTO `goods_content` VALUES ('5', '32', '干糕<p>\n				\n				</p>', null, '2017-10-18 20:26:28');
INSERT INTO `goods_content` VALUES ('6', '33', '方型小蛋糕<p>\n			</p>', null, null);
INSERT INTO `goods_content` VALUES ('7', '34', '', null, null);
INSERT INTO `goods_content` VALUES ('8', '35', '', null, null);
INSERT INTO `goods_content` VALUES ('9', '36', '', null, null);
INSERT INTO `goods_content` VALUES ('10', '37', '', null, null);
INSERT INTO `goods_content` VALUES ('11', '38', '', null, null);
INSERT INTO `goods_content` VALUES ('12', '39', '', null, null);
INSERT INTO `goods_content` VALUES ('13', '40', '', null, null);
INSERT INTO `goods_content` VALUES ('14', '41', '', null, null);
INSERT INTO `goods_content` VALUES ('15', '42', '', null, null);
INSERT INTO `goods_content` VALUES ('16', '43', '', null, null);

-- ----------------------------
-- Table structure for goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `goods_sku`;
CREATE TABLE `goods_sku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `sku_value_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_show` int(11) NOT NULL DEFAULT '1' COMMENT '1 显示 0 不显示 当原先已经勾选 之后取消勾选时修改为不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_sku
-- ----------------------------
INSERT INTO `goods_sku` VALUES ('109', '28', '41', '2017-09-30 09:49:47', '1');
INSERT INTO `goods_sku` VALUES ('110', '28', '42', '2017-09-30 09:49:47', '1');
INSERT INTO `goods_sku` VALUES ('111', '28', '44', '2017-09-30 09:49:47', '1');
INSERT INTO `goods_sku` VALUES ('112', '29', '41', '2017-09-29 16:42:45', '1');
INSERT INTO `goods_sku` VALUES ('113', '29', '42', '2017-09-29 16:42:45', '1');
INSERT INTO `goods_sku` VALUES ('114', '29', '45', '2017-09-29 16:42:45', '1');
INSERT INTO `goods_sku` VALUES ('115', '30', '41', '2017-10-18 10:19:07', '1');
INSERT INTO `goods_sku` VALUES ('116', '30', '42', '2017-10-18 10:19:07', '1');
INSERT INTO `goods_sku` VALUES ('117', '30', '44', '2017-10-18 10:19:07', '1');
INSERT INTO `goods_sku` VALUES ('118', '30', '45', '2017-10-18 10:19:07', '1');
INSERT INTO `goods_sku` VALUES ('119', '30', '47', '2017-10-18 10:19:07', '1');
INSERT INTO `goods_sku` VALUES ('120', '30', '48', '2017-10-18 10:19:07', '1');
INSERT INTO `goods_sku` VALUES ('121', '31', '41', '2017-10-18 20:23:52', '1');
INSERT INTO `goods_sku` VALUES ('122', '31', '42', '2017-10-18 20:23:52', '1');
INSERT INTO `goods_sku` VALUES ('123', '31', '44', '2017-10-18 20:23:52', '1');
INSERT INTO `goods_sku` VALUES ('124', '31', '45', '2017-10-18 20:23:52', '1');
INSERT INTO `goods_sku` VALUES ('125', '31', '47', '2017-10-18 20:23:52', '1');
INSERT INTO `goods_sku` VALUES ('126', '31', '48', '2017-10-18 20:23:52', '1');
INSERT INTO `goods_sku` VALUES ('127', '32', '44', '2017-10-18 20:26:28', '1');
INSERT INTO `goods_sku` VALUES ('128', '32', '47', '2017-10-18 20:26:28', '1');
INSERT INTO `goods_sku` VALUES ('129', '33', '41', '2017-10-18 20:27:54', '1');
INSERT INTO `goods_sku` VALUES ('130', '33', '42', '2017-10-18 20:27:54', '1');
INSERT INTO `goods_sku` VALUES ('131', '33', '44', '2017-10-18 20:27:54', '1');
INSERT INTO `goods_sku` VALUES ('132', '33', '45', '2017-10-18 20:27:54', '1');
INSERT INTO `goods_sku` VALUES ('133', '33', '48', '2017-10-18 20:27:54', '1');
INSERT INTO `goods_sku` VALUES ('134', '34', '41', '2017-10-18 23:18:11', '1');
INSERT INTO `goods_sku` VALUES ('135', '35', '41', '2017-10-18 23:18:33', '1');
INSERT INTO `goods_sku` VALUES ('136', '35', '47', '2017-10-18 23:18:33', '1');
INSERT INTO `goods_sku` VALUES ('137', '36', '41', '2017-10-18 23:18:53', '1');
INSERT INTO `goods_sku` VALUES ('138', '37', '42', '2017-10-18 23:19:18', '1');
INSERT INTO `goods_sku` VALUES ('139', '38', '41', '2017-10-18 23:19:39', '1');
INSERT INTO `goods_sku` VALUES ('140', '39', '47', '2017-10-18 23:20:01', '1');
INSERT INTO `goods_sku` VALUES ('141', '40', '41', '2017-10-18 23:20:34', '1');
INSERT INTO `goods_sku` VALUES ('142', '41', '41', '2017-10-18 23:20:54', '1');
INSERT INTO `goods_sku` VALUES ('143', '42', '44', '2017-10-18 23:21:16', '1');
INSERT INTO `goods_sku` VALUES ('144', '43', '44', '2017-10-18 23:21:38', '1');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '订单名称',
  `wx_pay_order` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '订单号微信支付',
  `user_id` int(9) unsigned NOT NULL COMMENT '用户id',
  `price` decimal(10,2) DEFAULT NULL COMMENT '交易金额',
  `pay` tinyint(2) DEFAULT NULL COMMENT '是否支付',
  `status` tinyint(3) unsigned DEFAULT '0' COMMENT '订单状态：0:初始状态;1:未支付;2:已支付;3:取消订单',
  `mark` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户留言',
  `address` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户地址',
  `mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户手机号',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '姓名',
  `send_status` tinyint(3) unsigned DEFAULT '0' COMMENT '配送状态：0:初始 1：待配送;2:配送中；3:配送完成',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `pay_time` datetime DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for orders_detail
-- ----------------------------
DROP TABLE IF EXISTS `orders_detail`;
CREATE TABLE `orders_detail` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL COMMENT '产品id',
  `goods_id` int(9) unsigned NOT NULL COMMENT '产品id',
  `price_id` int(11) DEFAULT NULL COMMENT 'sku名称',
  `price` decimal(10,2) DEFAULT NULL COMMENT '交易金额',
  `buy_count` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL COMMENT '原价',
  PRIMARY KEY (`id`),
  KEY `idx_goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='订单详情表';

-- ----------------------------
-- Records of orders_detail
-- ----------------------------
INSERT INTO `orders_detail` VALUES ('1', '1', '30', '70', '1.00', '1', '2017-10-11 09:44:23', null, null);
INSERT INTO `orders_detail` VALUES ('2', '1', '29', '65', '118.00', '2', '2017-10-11 09:44:23', null, null);
INSERT INTO `orders_detail` VALUES ('3', '2', '28', '63', '108.00', '1', '2017-10-11 10:06:47', null, null);
INSERT INTO `orders_detail` VALUES ('4', '3', '29', '64', '98.00', '1', '2017-10-11 13:24:40', null, null);
INSERT INTO `orders_detail` VALUES ('5', '4', '28', '62', '88.00', '2', '2017-10-11 13:24:58', null, null);
INSERT INTO `orders_detail` VALUES ('6', '5', '28', '63', '108.00', '1', '2017-10-11 13:38:27', null, null);
INSERT INTO `orders_detail` VALUES ('7', '6', '29', '65', '118.00', '1', '2017-10-12 11:25:27', null, null);
INSERT INTO `orders_detail` VALUES ('8', '7', '29', '64', '98.00', '1', '2017-10-12 11:26:33', null, null);
INSERT INTO `orders_detail` VALUES ('9', '8', '29', '64', '98.00', '1', '2017-10-12 11:27:24', null, null);
INSERT INTO `orders_detail` VALUES ('10', '9', '29', '65', '108.00', '1', '2017-10-13 18:01:36', null, null);
INSERT INTO `orders_detail` VALUES ('11', '10', '29', '64', '88.00', '1', '2017-10-13 21:12:52', null, null);
INSERT INTO `orders_detail` VALUES ('12', '11', '29', '65', '98.00', '1', '2017-10-13 21:30:38', null, '108.00');
INSERT INTO `orders_detail` VALUES ('13', '12', '28', '63', '69.12', '1', '2017-10-13 21:31:46', null, '86.40');
INSERT INTO `orders_detail` VALUES ('14', '13', '28', '63', '86.40', '1', '2017-10-13 21:34:34', null, '108.00');
INSERT INTO `orders_detail` VALUES ('15', '14', '30', '70', '1.00', '3', '2017-10-15 22:55:46', null, '1.00');

-- ----------------------------
-- Table structure for price
-- ----------------------------
DROP TABLE IF EXISTS `price`;
CREATE TABLE `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_show` int(11) NOT NULL DEFAULT '1' COMMENT '1 显示 0 不显示 修改货品是 如果已经填过的价格 不填  修改为不显示 填了改为显示',
  PRIMARY KEY (`id`),
  KEY `idx_goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of price
-- ----------------------------
INSERT INTO `price` VALUES ('62', '88.00', '28', '2017-09-30 09:49:47', '1');
INSERT INTO `price` VALUES ('63', '108.00', '28', '2017-09-30 09:49:47', '1');
INSERT INTO `price` VALUES ('64', '98.00', '29', '2017-09-29 16:42:45', '1');
INSERT INTO `price` VALUES ('65', '118.00', '29', '2017-09-29 16:42:45', '1');
INSERT INTO `price` VALUES ('66', '12.00', '30', '2017-10-18 10:19:07', '0');
INSERT INTO `price` VALUES ('67', '32.00', '30', '2017-10-18 10:19:07', '0');
INSERT INTO `price` VALUES ('68', '1.00', '30', '2017-10-18 10:19:07', '0');
INSERT INTO `price` VALUES ('69', '1.00', '30', '2017-10-18 10:19:07', '0');
INSERT INTO `price` VALUES ('70', '1.00', '30', '2017-10-18 10:19:07', '0');
INSERT INTO `price` VALUES ('71', '31.00', '30', '2017-10-18 10:19:07', '1');
INSERT INTO `price` VALUES ('72', '4213.00', '30', '2017-10-18 10:19:07', '1');
INSERT INTO `price` VALUES ('73', '413.00', '30', '2017-10-18 10:19:07', '1');
INSERT INTO `price` VALUES ('74', '14.00', '30', '2017-10-18 10:19:07', '0');
INSERT INTO `price` VALUES ('75', '12.00', '30', '2017-10-18 10:19:07', '1');
INSERT INTO `price` VALUES ('76', '123.00', '30', '2017-10-18 10:19:07', '1');
INSERT INTO `price` VALUES ('77', '17.00', '30', '2017-10-18 10:19:07', '0');
INSERT INTO `price` VALUES ('78', '312.00', '30', '2017-10-18 10:19:07', '1');
INSERT INTO `price` VALUES ('79', '312.00', '30', '2017-10-18 10:19:07', '1');
INSERT INTO `price` VALUES ('80', '314.00', '30', '2017-10-18 10:19:07', '1');
INSERT INTO `price` VALUES ('81', '108.00', '31', '2017-10-18 20:23:52', '1');
INSERT INTO `price` VALUES ('82', '108.00', '31', '2017-10-18 20:23:52', '1');
INSERT INTO `price` VALUES ('83', '108.00', '31', '2017-10-18 20:23:52', '1');
INSERT INTO `price` VALUES ('84', '108.00', '31', '2017-10-18 20:23:52', '1');
INSERT INTO `price` VALUES ('85', '128.00', '31', '2017-10-18 20:23:52', '1');
INSERT INTO `price` VALUES ('86', '128.00', '31', '2017-10-18 20:23:52', '1');
INSERT INTO `price` VALUES ('87', '128.00', '31', '2017-10-18 20:23:52', '1');
INSERT INTO `price` VALUES ('88', '128.00', '31', '2017-10-18 20:23:52', '1');
INSERT INTO `price` VALUES ('89', '98.00', '32', '2017-10-18 20:26:28', '1');
INSERT INTO `price` VALUES ('90', '30.00', '33', '2017-10-18 20:27:54', '1');
INSERT INTO `price` VALUES ('91', '30.00', '33', '2017-10-18 20:27:54', '1');
INSERT INTO `price` VALUES ('92', '40.00', '33', '2017-10-18 20:27:54', '1');
INSERT INTO `price` VALUES ('93', '40.00', '33', '2017-10-18 20:27:54', '1');
INSERT INTO `price` VALUES ('94', '1.00', '34', '2017-10-18 23:18:11', '1');
INSERT INTO `price` VALUES ('95', '1.00', '35', '2017-10-18 23:18:33', '1');
INSERT INTO `price` VALUES ('96', '1.00', '36', '2017-10-18 23:18:53', '1');
INSERT INTO `price` VALUES ('97', '1.00', '37', '2017-10-18 23:19:18', '1');
INSERT INTO `price` VALUES ('98', '1.00', '38', '2017-10-18 23:19:39', '1');
INSERT INTO `price` VALUES ('99', '21.00', '39', '2017-10-18 23:20:01', '1');
INSERT INTO `price` VALUES ('100', '123.00', '40', '2017-10-18 23:20:34', '1');
INSERT INTO `price` VALUES ('101', '123.00', '41', '2017-10-18 23:20:54', '1');
INSERT INTO `price` VALUES ('102', '1.00', '42', '2017-10-18 23:21:16', '1');
INSERT INTO `price` VALUES ('103', '123.00', '43', '2017-10-18 23:21:38', '1');

-- ----------------------------
-- Table structure for red_packet
-- ----------------------------
DROP TABLE IF EXISTS `red_packet`;
CREATE TABLE `red_packet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT NULL COMMENT '红包金额',
  `min_money` decimal(10,2) DEFAULT NULL COMMENT '订单最低金额可用',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL COMMENT '最后时间可用',
  `state` tinyint(4) DEFAULT '1' COMMENT '1 可用 2 已使用 ',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of red_packet
-- ----------------------------

-- ----------------------------
-- Table structure for red_packet_task
-- ----------------------------
DROP TABLE IF EXISTS `red_packet_task`;
CREATE TABLE `red_packet_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '红包任务  为了生成ID 没有别的用处',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `state` tinyint(1) DEFAULT '1' COMMENT '1 进行中 2 已抢完',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of red_packet_task
-- ----------------------------

-- ----------------------------
-- Table structure for red_packet_task_detail
-- ----------------------------
DROP TABLE IF EXISTS `red_packet_task_detail`;
CREATE TABLE `red_packet_task_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL COMMENT '链接 red_packet_task 为了与user_id 组成唯一 抢红包',
  `user_id` int(11) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT NULL,
  `min_money` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL COMMENT '使用 最后期限',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_user_task_id` (`user_id`,`task_id`) USING BTREE COMMENT '抢红包时  唯一字段'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of red_packet_task_detail
-- ----------------------------
INSERT INTO `red_packet_task_detail` VALUES ('1', '1', '1', null, null, null, null, null);
INSERT INTO `red_packet_task_detail` VALUES ('2', '1', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shop_discrib` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '店铺介绍',
  `shop_work` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开店 0 打烊',
  `shop_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '配送区域',
  `img_quality` int(11) DEFAULT NULL COMMENT '图片品质 默认50',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES ('2', 'terentia蛋糕店', '陈文越', '1', '18329042977', '江苏省南通市', '53', '2017-10-18 10:12:27', '2017-10-20 00:03:30');

-- ----------------------------
-- Table structure for sku
-- ----------------------------
DROP TABLE IF EXISTS `sku`;
CREATE TABLE `sku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku_name` varchar(255) NOT NULL COMMENT '属性名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sku
-- ----------------------------
INSERT INTO `sku` VALUES ('13', '尺寸');
INSERT INTO `sku` VALUES ('14', '材料');
INSERT INTO `sku` VALUES ('15', '形状');

-- ----------------------------
-- Table structure for sku_price
-- ----------------------------
DROP TABLE IF EXISTS `sku_price`;
CREATE TABLE `sku_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price_id` int(11) NOT NULL,
  `sku_value_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_price_id` (`price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sku_price
-- ----------------------------
INSERT INTO `sku_price` VALUES ('151', '64', '41', '2017-09-29 16:42:45');
INSERT INTO `sku_price` VALUES ('152', '64', '45', '2017-09-29 16:42:45');
INSERT INTO `sku_price` VALUES ('153', '65', '42', '2017-09-29 16:42:45');
INSERT INTO `sku_price` VALUES ('154', '65', '45', '2017-09-29 16:42:45');
INSERT INTO `sku_price` VALUES ('171', '66', '41', '2017-09-29 21:32:06');
INSERT INTO `sku_price` VALUES ('172', '67', '42', '2017-09-29 21:32:06');
INSERT INTO `sku_price` VALUES ('173', '62', '41', '2017-09-30 09:49:47');
INSERT INTO `sku_price` VALUES ('174', '62', '44', '2017-09-30 09:49:47');
INSERT INTO `sku_price` VALUES ('175', '63', '42', '2017-09-30 09:49:47');
INSERT INTO `sku_price` VALUES ('176', '63', '44', '2017-09-30 09:49:47');
INSERT INTO `sku_price` VALUES ('177', '68', '41', '2017-09-30 14:39:38');
INSERT INTO `sku_price` VALUES ('178', '68', '44', '2017-09-30 14:39:38');
INSERT INTO `sku_price` VALUES ('179', '69', '41', '2017-09-30 14:39:38');
INSERT INTO `sku_price` VALUES ('180', '69', '45', '2017-09-30 14:39:38');
INSERT INTO `sku_price` VALUES ('181', '70', '42', '2017-09-30 14:39:38');
INSERT INTO `sku_price` VALUES ('182', '70', '44', '2017-09-30 14:39:38');
INSERT INTO `sku_price` VALUES ('231', '74', '41', '2017-10-16 17:33:27');
INSERT INTO `sku_price` VALUES ('232', '77', '42', '2017-10-16 17:33:27');
INSERT INTO `sku_price` VALUES ('233', '75', '42', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('234', '75', '44', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('235', '75', '47', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('236', '76', '42', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('237', '76', '44', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('238', '76', '48', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('239', '79', '42', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('240', '79', '45', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('241', '79', '47', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('242', '78', '42', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('243', '78', '45', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('244', '78', '48', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('245', '71', '41', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('246', '71', '44', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('247', '71', '47', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('248', '72', '41', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('249', '72', '44', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('250', '72', '48', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('251', '73', '41', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('252', '73', '45', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('253', '73', '47', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('254', '80', '41', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('255', '80', '45', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('256', '80', '48', '2017-10-18 10:19:07');
INSERT INTO `sku_price` VALUES ('257', '81', '41', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('258', '81', '44', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('259', '81', '47', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('260', '82', '41', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('261', '82', '44', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('262', '82', '48', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('263', '83', '41', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('264', '83', '45', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('265', '83', '47', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('266', '84', '41', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('267', '84', '45', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('268', '84', '48', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('269', '85', '42', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('270', '85', '44', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('271', '85', '47', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('272', '86', '42', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('273', '86', '44', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('274', '86', '48', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('275', '87', '42', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('276', '87', '45', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('277', '87', '47', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('278', '88', '42', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('279', '88', '45', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('280', '88', '48', '2017-10-18 20:23:52');
INSERT INTO `sku_price` VALUES ('283', '89', '44', '2017-10-18 20:26:28');
INSERT INTO `sku_price` VALUES ('284', '89', '47', '2017-10-18 20:26:28');
INSERT INTO `sku_price` VALUES ('285', '90', '41', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('286', '90', '44', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('287', '90', '48', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('288', '91', '41', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('289', '91', '45', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('290', '91', '48', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('291', '92', '42', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('292', '92', '44', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('293', '92', '48', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('294', '93', '42', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('295', '93', '45', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('296', '93', '48', '2017-10-18 20:27:54');
INSERT INTO `sku_price` VALUES ('297', '94', '41', '2017-10-18 23:18:11');
INSERT INTO `sku_price` VALUES ('298', '95', '41', '2017-10-18 23:18:33');
INSERT INTO `sku_price` VALUES ('299', '95', '47', '2017-10-18 23:18:33');
INSERT INTO `sku_price` VALUES ('300', '96', '41', '2017-10-18 23:18:53');
INSERT INTO `sku_price` VALUES ('301', '97', '42', '2017-10-18 23:19:18');
INSERT INTO `sku_price` VALUES ('302', '98', '41', '2017-10-18 23:19:39');
INSERT INTO `sku_price` VALUES ('303', '99', '47', '2017-10-18 23:20:01');
INSERT INTO `sku_price` VALUES ('304', '100', '41', '2017-10-18 23:20:34');
INSERT INTO `sku_price` VALUES ('305', '101', '41', '2017-10-18 23:20:54');
INSERT INTO `sku_price` VALUES ('306', '102', '44', '2017-10-18 23:21:16');
INSERT INTO `sku_price` VALUES ('307', '103', '44', '2017-10-18 23:21:38');

-- ----------------------------
-- Table structure for sku_value
-- ----------------------------
DROP TABLE IF EXISTS `sku_value`;
CREATE TABLE `sku_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sku_value
-- ----------------------------
INSERT INTO `sku_value` VALUES ('40', '13', '无');
INSERT INTO `sku_value` VALUES ('41', '13', '8寸');
INSERT INTO `sku_value` VALUES ('42', '13', '10寸');
INSERT INTO `sku_value` VALUES ('43', '14', '无');
INSERT INTO `sku_value` VALUES ('44', '14', '奶油');
INSERT INTO `sku_value` VALUES ('45', '14', '慕斯');
INSERT INTO `sku_value` VALUES ('46', '15', '无');
INSERT INTO `sku_value` VALUES ('47', '15', '圆形');
INSERT INTO `sku_value` VALUES ('48', '15', '方形');

-- ----------------------------
-- Table structure for stock
-- ----------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `goods_id` int(11) NOT NULL COMMENT '对应价格',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `updated_at` datetime NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price_id` int(11) NOT NULL,
  `is_show` int(11) NOT NULL DEFAULT '1' COMMENT '1显示 0 不显示  如果 货品修改时 已经填过的库存 不填那就不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stock
-- ----------------------------
INSERT INTO `stock` VALUES ('28', '10', '2017-09-30 09:49:47', '76', '62', '1');
INSERT INTO `stock` VALUES ('28', '10', '2017-09-30 09:49:47', '77', '63', '1');
INSERT INTO `stock` VALUES ('29', '10', '2017-09-29 16:42:45', '78', '64', '1');
INSERT INTO `stock` VALUES ('29', '12', '2017-09-29 16:42:45', '79', '65', '1');
INSERT INTO `stock` VALUES ('30', '12', '2017-10-18 10:19:07', '80', '66', '0');
INSERT INTO `stock` VALUES ('30', '32', '2017-10-18 10:19:07', '81', '67', '0');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '82', '68', '0');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '83', '69', '0');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '84', '70', '0');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '85', '71', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '86', '72', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '87', '73', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '88', '74', '0');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '89', '75', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '90', '76', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '91', '77', '0');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '92', '78', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '93', '79', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-10-18 10:19:07', '94', '80', '1');
INSERT INTO `stock` VALUES ('31', '1', '2017-10-18 20:23:52', '95', '81', '1');
INSERT INTO `stock` VALUES ('31', '1', '2017-10-18 20:23:52', '96', '82', '1');
INSERT INTO `stock` VALUES ('31', '1', '2017-10-18 20:23:52', '97', '83', '1');
INSERT INTO `stock` VALUES ('31', '1', '2017-10-18 20:23:52', '98', '84', '1');
INSERT INTO `stock` VALUES ('31', '1', '2017-10-18 20:23:52', '99', '85', '1');
INSERT INTO `stock` VALUES ('31', '1', '2017-10-18 20:23:52', '100', '86', '1');
INSERT INTO `stock` VALUES ('31', '1', '2017-10-18 20:23:52', '101', '87', '1');
INSERT INTO `stock` VALUES ('31', '1', '2017-10-18 20:23:52', '102', '88', '1');
INSERT INTO `stock` VALUES ('32', '1', '2017-10-18 20:26:28', '103', '89', '1');
INSERT INTO `stock` VALUES ('33', '1', '2017-10-18 20:27:54', '104', '90', '1');
INSERT INTO `stock` VALUES ('33', '1', '2017-10-18 20:27:54', '105', '91', '1');
INSERT INTO `stock` VALUES ('33', '1', '2017-10-18 20:27:54', '106', '92', '1');
INSERT INTO `stock` VALUES ('33', '1', '2017-10-18 20:27:54', '107', '93', '1');
INSERT INTO `stock` VALUES ('34', '1', '2017-10-18 23:18:11', '108', '94', '1');
INSERT INTO `stock` VALUES ('35', '1', '2017-10-18 23:18:33', '109', '95', '1');
INSERT INTO `stock` VALUES ('36', '1', '2017-10-18 23:18:53', '110', '96', '1');
INSERT INTO `stock` VALUES ('37', '1', '2017-10-18 23:19:18', '111', '97', '1');
INSERT INTO `stock` VALUES ('38', '1', '2017-10-18 23:19:39', '112', '98', '1');
INSERT INTO `stock` VALUES ('39', '1', '2017-10-18 23:20:01', '113', '99', '1');
INSERT INTO `stock` VALUES ('40', '2', '2017-10-18 23:20:34', '114', '100', '1');
INSERT INTO `stock` VALUES ('41', '32', '2017-10-18 23:20:54', '115', '101', '1');
INSERT INTO `stock` VALUES ('42', '1', '2017-10-18 23:21:16', '116', '102', '1');
INSERT INTO `stock` VALUES ('43', '3', '2017-10-18 23:21:38', '117', '103', '1');

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地址',
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '收货人姓名',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_default` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_address
-- ----------------------------
INSERT INTO `user_address` VALUES ('1', '1', '测试的', '陈文越', '18329042977', '1', '2017-10-10 14:50:19', null);
