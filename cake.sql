/*
Navicat MySQL Data Transfer

Source Server         : lzh
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cake

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-29 18:04:01
*/

SET FOREIGN_KEY_CHECKS=0;

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

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `category` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_parent` smallint(6) DEFAULT '0' COMMENT '1 是父级 2 不是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
  `goods_title` varchar(255) NOT NULL COMMENT '标题',
  `goods_img` varchar(255) DEFAULT NULL COMMENT '图片',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `sale_num` int(11) DEFAULT '0' COMMENT '销量',
  `category_id` int(11) DEFAULT NULL,
  `is_hot` tinyint(4) DEFAULT '0' COMMENT '是否热销 1 是 0 不是',
  `show_price` decimal(10,2) DEFAULT NULL COMMENT '缩略图显示价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('28', '奶油蛋糕', '/upload/goods/2017092916332259ce0552ad266.jpg', '2017-09-29 16:36:10', '2017-09-29 17:40:39', '10', '1', '1', '88.00');
INSERT INTO `goods` VALUES ('29', '慕斯蛋糕', '/upload/goods/2017092916420459ce075c42e86.jpg', '2017-09-29 16:42:45', '2017-09-29 17:40:41', '0', '1', '1', '98.00');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of goods_content
-- ----------------------------
INSERT INTO `goods_content` VALUES ('1', '28', '<p>				</p><p>				</p><p>				</p><p>				</p><p style=\"text-align: center;\">奶油蛋糕<img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066740268473.jpg\"/><img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066740358062.png\"/></p><p></p><p>\n				</p><p>\n				</p><p>\n				</p><p>\n				</p>', null, '2017-09-29 17:36:13');
INSERT INTO `goods_content` VALUES ('2', '29', '<h1 style=\"text-align: center;\">慕斯蛋糕</h1><p><img src=\"http://dangaox.com/js/umeditor1.2.3/php/upload/20170929/15066745434974.jpg\"/>\n			</p>', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_sku
-- ----------------------------
INSERT INTO `goods_sku` VALUES ('109', '28', '41', '2017-09-29 17:36:13', '1');
INSERT INTO `goods_sku` VALUES ('110', '28', '42', '2017-09-29 17:36:13', '1');
INSERT INTO `goods_sku` VALUES ('111', '28', '44', '2017-09-29 17:36:13', '1');
INSERT INTO `goods_sku` VALUES ('112', '29', '41', '2017-09-29 16:42:45', '1');
INSERT INTO `goods_sku` VALUES ('113', '29', '42', '2017-09-29 16:42:45', '1');
INSERT INTO `goods_sku` VALUES ('114', '29', '45', '2017-09-29 16:42:45', '1');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) DEFAULT NULL COMMENT '订单号',
  `uid` int(9) unsigned NOT NULL COMMENT '用户id',
  `price` decimal(5,2) DEFAULT NULL COMMENT '交易金额',
  `pay` varchar(100) DEFAULT NULL COMMENT '是否支付',
  `status` tinyint(3) unsigned DEFAULT '0' COMMENT '订单状态：0:初始状态;1:未支付;2:已支付;3:取消订单',
  `mark` varchar(1000) DEFAULT NULL COMMENT '用户留言',
  `address` varchar(1000) DEFAULT NULL COMMENT '用户地址',
  `mobile` varchar(50) DEFAULT NULL COMMENT '用户手机号',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `send_status` tinyint(3) unsigned DEFAULT '0' COMMENT '配送状态：0:初始 1：待配送;2:配送中；3:配送完成',
  `create_time` time DEFAULT NULL COMMENT '创建时间',
  `pay_time` time DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for orders_detail
-- ----------------------------
DROP TABLE IF EXISTS `orders_detail`;
CREATE TABLE `orders_detail` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `oid` varchar(100) DEFAULT NULL COMMENT '产品id',
  `pid` int(9) unsigned NOT NULL COMMENT '产品id',
  `image` varchar(500) DEFAULT NULL COMMENT '图片',
  `sku_id` varchar(500) DEFAULT NULL COMMENT 'sku名称',
  `sku_name` varchar(100) DEFAULT NULL COMMENT 'skuid',
  `price` decimal(5,2) DEFAULT NULL COMMENT '交易金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单详情表';

-- ----------------------------
-- Records of orders_detail
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of price
-- ----------------------------
INSERT INTO `price` VALUES ('62', '88.00', '28', '2017-09-29 17:36:13', '1');
INSERT INTO `price` VALUES ('63', '108.00', '28', '2017-09-29 17:36:13', '1');
INSERT INTO `price` VALUES ('64', '98.00', '29', '2017-09-29 16:42:45', '1');
INSERT INTO `price` VALUES ('65', '118.00', '29', '2017-09-29 16:42:45', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sku_price
-- ----------------------------
INSERT INTO `sku_price` VALUES ('151', '64', '41', '2017-09-29 16:42:45');
INSERT INTO `sku_price` VALUES ('152', '64', '45', '2017-09-29 16:42:45');
INSERT INTO `sku_price` VALUES ('153', '65', '42', '2017-09-29 16:42:45');
INSERT INTO `sku_price` VALUES ('154', '65', '45', '2017-09-29 16:42:45');
INSERT INTO `sku_price` VALUES ('167', '62', '41', '2017-09-29 17:36:13');
INSERT INTO `sku_price` VALUES ('168', '62', '44', '2017-09-29 17:36:13');
INSERT INTO `sku_price` VALUES ('169', '63', '42', '2017-09-29 17:36:13');
INSERT INTO `sku_price` VALUES ('170', '63', '44', '2017-09-29 17:36:13');

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stock
-- ----------------------------
INSERT INTO `stock` VALUES ('28', '10', '2017-09-29 17:36:13', '76', '62', '1');
INSERT INTO `stock` VALUES ('28', '10', '2017-09-29 17:36:13', '77', '63', '1');
INSERT INTO `stock` VALUES ('29', '10', '2017-09-29 16:42:45', '78', '64', '1');
INSERT INTO `stock` VALUES ('29', '12', '2017-09-29 16:42:45', '79', '65', '1');
