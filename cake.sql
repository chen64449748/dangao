/*
Navicat MySQL Data Transfer

Source Server         : lzh
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cake

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-10-16 14:00:40
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of active
-- ----------------------------
INSERT INTO `active` VALUES ('1', 'ces ', null, '/upload/active/2017101311022959e02cc5c75d7.jpg', '2017-10-13 06:00:00', '2017-10-17 23:00:00', '80.00', '10.00', '1', '1', '2017-10-13 21:31:31');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `banner_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('8', '1', '28', '63', '1', '2017-10-13 21:22:45', '2017-10-15 22:28:08');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('28', '奶油蛋糕', '/upload/goods/2017092916332259ce0552ad266.jpg', '2017-09-29 16:36:10', '2017-10-15 23:20:30', '10', '1', '1', '0.00', '1', '1');
INSERT INTO `goods` VALUES ('29', '慕斯蛋糕', '/upload/goods/2017092916420459ce075c42e86.jpg', '2017-09-29 16:42:45', '2017-10-15 23:20:01', '0', '1', '1', '98.00', '1', '0');
INSERT INTO `goods` VALUES ('30', '新蛋糕', '/upload/goods/2017092921314759ce4b43d7c71.jpg', '2017-09-29 21:32:06', '2017-10-15 23:39:11', '0', '1', '1', '0.00', '0', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of goods_content
-- ----------------------------
INSERT INTO `goods_content` VALUES ('1', '28', '<p>				</p><p>				</p><p>				</p><p>				</p><p>				</p><p style=\"text-align: center;\">奶油蛋糕<img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066740268473.jpg\"/><img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066740358062.png\"/></p><p></p><p>\n				</p><p>\n				</p><p>\n				</p><p>\n				</p><p>\n				</p>', null, '2017-09-30 09:49:47');
INSERT INTO `goods_content` VALUES ('2', '29', '<h1 style=\"text-align: center;\">慕斯蛋糕</h1><p><img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066745434974.jpg\"/>\n			</p>', null, null);
INSERT INTO `goods_content` VALUES ('3', '30', '<p>				</p><p style=\"text-align: center;\"><img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170930/15067535741247.jpg\"/></p><p>\n				</p>', null, '2017-09-30 14:39:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_sku
-- ----------------------------
INSERT INTO `goods_sku` VALUES ('109', '28', '41', '2017-09-30 09:49:47', '1');
INSERT INTO `goods_sku` VALUES ('110', '28', '42', '2017-09-30 09:49:47', '1');
INSERT INTO `goods_sku` VALUES ('111', '28', '44', '2017-09-30 09:49:47', '1');
INSERT INTO `goods_sku` VALUES ('112', '29', '41', '2017-09-29 16:42:45', '1');
INSERT INTO `goods_sku` VALUES ('113', '29', '42', '2017-09-29 16:42:45', '1');
INSERT INTO `goods_sku` VALUES ('114', '29', '45', '2017-09-29 16:42:45', '1');
INSERT INTO `goods_sku` VALUES ('115', '30', '41', '2017-09-30 14:39:38', '1');
INSERT INTO `goods_sku` VALUES ('116', '30', '42', '2017-09-30 14:39:38', '1');
INSERT INTO `goods_sku` VALUES ('117', '30', '44', '2017-09-30 14:39:38', '1');
INSERT INTO `goods_sku` VALUES ('118', '30', '45', '2017-09-30 14:39:38', '1');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
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
INSERT INTO `orders` VALUES ('1', null, '1', '119.00', '0', '1', null, '炒菜', '12321412', '炒菜', '0', '2017-10-13 22:17:57', '2017-10-11 09:44:24', null);
INSERT INTO `orders` VALUES ('2', null, '1', '108.00', '0', '1', null, '测试的', '18329042977', '陈文越', '0', '2017-10-13 22:17:57', '2017-10-11 10:06:47', null);
INSERT INTO `orders` VALUES ('3', null, '1', '98.00', '0', '1', null, '测试的', '18329042977', '陈文越', '0', '2017-10-13 22:17:57', '2017-10-11 13:24:40', null);
INSERT INTO `orders` VALUES ('4', null, '1', '88.00', '0', '1', null, '测试的', '18329042977', '陈文越', '0', '2017-10-13 22:17:57', '2017-10-11 13:24:58', null);
INSERT INTO `orders` VALUES ('5', null, '1', '108.00', '0', '1', null, '测试的', '18329042977', '陈文越', '0', '2017-10-13 22:17:57', '2017-10-11 13:38:27', null);
INSERT INTO `orders` VALUES ('6', '20171012112527159dee0a77cff9', '1', '118.00', '0', '1', null, '等我', '213124221', '默认地址', '0', '2017-10-13 22:17:57', '2017-10-12 11:25:27', null);
INSERT INTO `orders` VALUES ('7', '201710121126336159dee0e951f8e', '1', '98.00', '0', '1', null, '等我', '213124221', '默认地址', '0', '2017-10-13 22:17:57', '2017-10-12 11:26:33', null);
INSERT INTO `orders` VALUES ('8', 'f06920fcaa0456e5316207984cbd07a9', '1', '98.00', '0', '1', null, '等我', '213124221', '默认地址', '0', '2017-10-13 22:17:57', '2017-10-12 11:27:24', null);
INSERT INTO `orders` VALUES ('9', '201710131801363117', '1', '108.00', '0', '1', null, '等我', '213124221', '默认地址', '0', '2017-10-13 22:17:57', '2017-10-13 18:01:36', null);
INSERT INTO `orders` VALUES ('10', '201710132112527809', '1', '88.00', '0', '1', null, '等我', '213124221', '默认地址', '0', '2017-10-13 22:17:57', '2017-10-13 21:12:52', null);
INSERT INTO `orders` VALUES ('11', '201710132130383020', '1', '98.00', '0', '1', null, '等我', '213124221', '默认地址', '0', '2017-10-13 22:17:57', '2017-10-13 21:30:38', null);
INSERT INTO `orders` VALUES ('12', '201710132131464075', '1', '69.12', '0', '1', null, '等我', '213124221', '默认地址', '0', '2017-10-13 22:17:57', '2017-10-13 21:31:46', null);
INSERT INTO `orders` VALUES ('13', '201710132134342121', '1', '86.40', '0', '3', null, '炒菜', '12321412', '炒菜', '0', '2017-10-13 22:18:57', '2017-10-13 21:34:34', null);
INSERT INTO `orders` VALUES ('14', '201710152255476039', '1', '3.00', '0', '3', null, '测试的', '18329042977', '陈文越', '0', '2017-10-15 23:02:25', '2017-10-15 22:55:47', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of price
-- ----------------------------
INSERT INTO `price` VALUES ('62', '88.00', '28', '2017-09-30 09:49:47', '1');
INSERT INTO `price` VALUES ('63', '108.00', '28', '2017-09-30 09:49:47', '1');
INSERT INTO `price` VALUES ('64', '98.00', '29', '2017-09-29 16:42:45', '1');
INSERT INTO `price` VALUES ('65', '118.00', '29', '2017-09-29 16:42:45', '1');
INSERT INTO `price` VALUES ('66', '12.00', '30', '2017-09-30 14:39:38', '0');
INSERT INTO `price` VALUES ('67', '32.00', '30', '2017-09-30 14:39:38', '0');
INSERT INTO `price` VALUES ('68', '1.00', '30', '2017-09-30 14:39:38', '1');
INSERT INTO `price` VALUES ('69', '1.00', '30', '2017-09-30 14:39:38', '1');
INSERT INTO `price` VALUES ('70', '1.00', '30', '2017-09-30 14:39:38', '1');

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shop_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shop
-- ----------------------------

-- ----------------------------
-- Table structure for sku
-- ----------------------------
DROP TABLE IF EXISTS `sku`;
CREATE TABLE `sku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku_name` varchar(255) NOT NULL COMMENT '属性名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sku
-- ----------------------------
INSERT INTO `sku` VALUES ('13', '尺寸');
INSERT INTO `sku` VALUES ('14', '材料');

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
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8;

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

-- ----------------------------
-- Table structure for sku_value
-- ----------------------------
DROP TABLE IF EXISTS `sku_value`;
CREATE TABLE `sku_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sku_value
-- ----------------------------
INSERT INTO `sku_value` VALUES ('40', '13', '无');
INSERT INTO `sku_value` VALUES ('41', '13', '8寸');
INSERT INTO `sku_value` VALUES ('42', '13', '10寸');
INSERT INTO `sku_value` VALUES ('43', '14', '无');
INSERT INTO `sku_value` VALUES ('44', '14', '奶油');
INSERT INTO `sku_value` VALUES ('45', '14', '慕斯');

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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stock
-- ----------------------------
INSERT INTO `stock` VALUES ('28', '10', '2017-09-30 09:49:47', '76', '62', '1');
INSERT INTO `stock` VALUES ('28', '10', '2017-09-30 09:49:47', '77', '63', '1');
INSERT INTO `stock` VALUES ('29', '10', '2017-09-29 16:42:45', '78', '64', '1');
INSERT INTO `stock` VALUES ('29', '12', '2017-09-29 16:42:45', '79', '65', '1');
INSERT INTO `stock` VALUES ('30', '12', '2017-09-30 14:39:38', '80', '66', '0');
INSERT INTO `stock` VALUES ('30', '32', '2017-09-30 14:39:38', '81', '67', '0');
INSERT INTO `stock` VALUES ('30', '1', '2017-09-30 14:39:38', '82', '68', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-09-30 14:39:38', '83', '69', '1');
INSERT INTO `stock` VALUES ('30', '1', '2017-09-30 14:39:38', '84', '70', '1');

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
