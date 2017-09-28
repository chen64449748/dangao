/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : cake

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-09-28 23:10:30
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
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_number` varchar(255) NOT NULL COMMENT '货号',
  `goods_desc` varchar(255) DEFAULT NULL COMMENT '货物 描述  圆领 尖领',
  `company_id` int(11) NOT NULL,
  `company_sign_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

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
-- Table structure for price
-- ----------------------------
DROP TABLE IF EXISTS `price`;
CREATE TABLE `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_show` int(11) NOT NULL DEFAULT '1' COMMENT '1 显示 0 不显示 修改货品是 如果已经填过的价格 不填  修改为不显示 填了改为显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sku
-- ----------------------------
DROP TABLE IF EXISTS `sku`;
CREATE TABLE `sku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku_name` varchar(255) NOT NULL COMMENT '属性名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sku_price
-- ----------------------------
DROP TABLE IF EXISTS `sku_price`;
CREATE TABLE `sku_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price_id` int(11) NOT NULL,
  `sku_value_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sku_value
-- ----------------------------
DROP TABLE IF EXISTS `sku_value`;
CREATE TABLE `sku_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;
