/*
Navicat MySQL Data Transfer

Source Server         : 信用卡
Source Server Version : 50638
Source Host           : 47.96.129.71:3306
Source Database       : xyk

Target Server Type    : MYSQL
Target Server Version : 50638
File Encoding         : 65001

Date: 2017-12-12 20:31:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xyk_adminlog
-- ----------------------------
DROP TABLE IF EXISTS `xyk_adminlog`;
CREATE TABLE `xyk_adminlog` (
  `LogId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserId` int(10) unsigned DEFAULT NULL,
  `LogType` int(11) DEFAULT '0',
  `Description` text,
  `LoginIp` varchar(15) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`LogId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='后台用户日志表';

-- ----------------------------
-- Records of xyk_adminlog
-- ----------------------------
INSERT INTO `xyk_adminlog` VALUES ('1', '1', '1', '登录', '127.0.0.1', '2017-11-20 20:08:17', null, null, null);
INSERT INTO `xyk_adminlog` VALUES ('2', '1', '1', '登录', '127.0.0.1', '2017-11-30 20:38:00', null, null, null);
INSERT INTO `xyk_adminlog` VALUES ('3', '1', '1', '登录', '127.0.0.1', '2017-12-09 14:18:22', null, null, null);
INSERT INTO `xyk_adminlog` VALUES ('4', '1', '1', '登录', '127.0.0.1', '2017-12-09 14:18:33', null, null, null);
INSERT INTO `xyk_adminlog` VALUES ('5', '3', '1', '登录', '127.0.0.1', '2017-12-09 14:45:24', null, null, null);
INSERT INTO `xyk_adminlog` VALUES ('6', '1', '1', '登录', '127.0.0.1', '2017-12-09 14:46:04', null, null, null);
INSERT INTO `xyk_adminlog` VALUES ('7', '1', '1', '登录', '127.0.0.1', '2017-12-12 16:29:03', null, null, null);

-- ----------------------------
-- Table structure for xyk_adminuser
-- ----------------------------
DROP TABLE IF EXISTS `xyk_adminuser`;
CREATE TABLE `xyk_adminuser` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MerchantId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户Id',
  `Username` varchar(60) NOT NULL,
  `RealName` varchar(20) NOT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `Password` varchar(32) NOT NULL,
  `UsertypeId` int(11) unsigned DEFAULT NULL,
  `Ip` varchar(15) DEFAULT NULL,
  `AddTime` datetime NOT NULL,
  `IsUsed` int(11) NOT NULL DEFAULT '0',
  `LastLogin` datetime DEFAULT NULL,
  `LastIp` varchar(15) DEFAULT NULL,
  `AttemptTime` int(10) unsigned DEFAULT '0' COMMENT '尝试登录时间(时间戳)',
  `AttemptNums` tinyint(2) unsigned DEFAULT '0' COMMENT '尝试登录次数',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- ----------------------------
-- Records of xyk_adminuser
-- ----------------------------
INSERT INTO `xyk_adminuser` VALUES ('1', '5', 'admin', '超级管理员', '', '3d298b4523118a814e0250ad5e2964ee', '1', '192.168.0.14', '2017-03-23 09:54:23', '1', null, null, '0', '0', null, null, null);
INSERT INTO `xyk_adminuser` VALUES ('2', '5', 'admin1', 'adss', 'sds', '3d298b4523118a814e0250ad5e2964ee', '2', '127.0.0.1', '2017-11-30 20:47:17', '1', null, null, '0', '0', null, null, null);
INSERT INTO `xyk_adminuser` VALUES ('3', '5', 'test1', 'test1name', '6515@qq.com', '3d298b4523118a814e0250ad5e2964ee', '22', '127.0.0.1', '2017-12-09 14:45:13', '1', null, null, '0', '0', null, null, null);

-- ----------------------------
-- Table structure for xyk_adminuser1
-- ----------------------------
DROP TABLE IF EXISTS `xyk_adminuser1`;
CREATE TABLE `xyk_adminuser1` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MerchantId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户Id',
  `Username` varchar(60) NOT NULL,
  `RealName` varchar(20) NOT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `Password` varchar(32) NOT NULL,
  `UsertypeId` int(11) unsigned DEFAULT NULL,
  `Ip` varchar(15) DEFAULT NULL,
  `AddTime` datetime NOT NULL,
  `IsUsed` int(11) NOT NULL DEFAULT '0',
  `LastLogin` datetime DEFAULT NULL,
  `LastIp` varchar(15) DEFAULT NULL,
  `AttemptTime` int(10) unsigned DEFAULT '0' COMMENT '尝试登录时间(时间戳)',
  `AttemptNums` tinyint(2) unsigned DEFAULT '0' COMMENT '尝试登录次数',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- ----------------------------
-- Records of xyk_adminuser1
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_apiresponselog
-- ----------------------------
DROP TABLE IF EXISTS `xyk_apiresponselog`;
CREATE TABLE `xyk_apiresponselog` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `RequestId` int(11) unsigned DEFAULT NULL,
  `ResultCode` varchar(10) NOT NULL COMMENT '响应码',
  `ErrorCode` varchar(10) DEFAULT NULL COMMENT '错误编码',
  `Message` varchar(255) DEFAULT NULL COMMENT '描述',
  `Content` text NOT NULL COMMENT '响应内容',
  `AddTime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=117579 DEFAULT CHARSET=utf8 COMMENT='接口响应日志';

-- ----------------------------
-- Records of xyk_apiresponselog
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_area
-- ----------------------------
DROP TABLE IF EXISTS `xyk_area`;
CREATE TABLE `xyk_area` (
  `AreaID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AreaName` varchar(50) NOT NULL,
  `RootID` int(10) unsigned NOT NULL,
  `ChildAmount` int(10) unsigned NOT NULL,
  `Depth` int(11) NOT NULL,
  `Sort` int(11) NOT NULL,
  `IsOpen` tinyint(1) NOT NULL DEFAULT '0',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`AreaID`)
) ENGINE=InnoDB AUTO_INCREMENT=46647 DEFAULT CHARSET=utf8 COMMENT='地区表';

-- ----------------------------
-- Records of xyk_area
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_bankcard
-- ----------------------------
DROP TABLE IF EXISTS `xyk_bankcard`;
CREATE TABLE `xyk_bankcard` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '银行卡ID',
  `BankName` varchar(100) DEFAULT NULL COMMENT '银行卡名称',
  `statue` int(11) DEFAULT '0' COMMENT '银行卡设置状态; 0|正常；1|限制',
  `Isvalid` tinyint(1) DEFAULT '1' COMMENT '是否有效（1|有效，0|无效）',
  `AddTime` int(50) DEFAULT '0',
  `BankCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '银行卡编号',
  `Image` varchar(100) DEFAULT NULL,
  `BackGroud` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COMMENT='银行卡列表';

-- ----------------------------
-- Records of xyk_bankcard
-- ----------------------------
INSERT INTO `xyk_bankcard` VALUES ('1', '工商银行', '0', '1', '0', 'ICBC', 'http://47.96.129.71/upload/bankcard/bankcard_icon_2.png', '#C8394D');
INSERT INTO `xyk_bankcard` VALUES ('2', '农业银行', '0', '1', '0', 'ABC', 'http://47.96.129.71/upload/bankcard/bankcard_icon_9.png', '#049982');
INSERT INTO `xyk_bankcard` VALUES ('3', '中国银行', '0', '1', '0', 'BOC', 'http://47.96.129.71/upload/bankcard/bankcard_icon_16.png', '#C8394D');
INSERT INTO `xyk_bankcard` VALUES ('4', '建设银行', '0', '1', '0', 'CCB', 'http://47.96.129.71/upload/bankcard/bankcard_icon_6.png', '#3F74BD');
INSERT INTO `xyk_bankcard` VALUES ('5', '招商银行', '0', '1', '0', 'CMBCHINA', 'http://47.96.129.71/upload/bankcard/bankcard_icon_15.png', '#C8394D');
INSERT INTO `xyk_bankcard` VALUES ('6', '邮政储蓄', '0', '1', '0', 'POST', 'http://47.96.129.71/upload/bankcard/bankcard_icon_14.png', '#049982');
INSERT INTO `xyk_bankcard` VALUES ('7', '中信银行', '0', '1', '0', 'ECITIC', 'http://47.96.129.71/upload/bankcard/bankcard_icon_17.png', '#C8394D');
INSERT INTO `xyk_bankcard` VALUES ('8', '光大银行', '0', '1', '0', 'CEB', 'http://47.96.129.71/upload/bankcard/bankcard_icon_3.png', '#641E7C');
INSERT INTO `xyk_bankcard` VALUES ('9', '交通银行', '0', '1', '0', 'BOCO', 'http://47.96.129.71/upload/bankcard/bankcard_icon_7.png', '#3F74BD');
INSERT INTO `xyk_bankcard` VALUES ('10', '兴业银行', '0', '1', '0', 'CIB', 'http://47.96.129.71/upload/bankcard/bankcard_icon_13.png', '#3F74BD');
INSERT INTO `xyk_bankcard` VALUES ('11', '民生银行', '0', '1', '0', 'CMBC', 'http://47.96.129.71/upload/bankcard/bankcard_icon_8.png', '#3F74BD');
INSERT INTO `xyk_bankcard` VALUES ('12', '平安银行', '0', '1', '0', 'PINGAN', 'http://47.96.129.71/upload/bankcard/bankcard_icon_10.png', '#C8394D');
INSERT INTO `xyk_bankcard` VALUES ('13', '广发银行', '0', '1', '0', 'CGB', 'http://47.96.129.71/upload/bankcard/bankcard_icon_4.png', '#C8394D');
INSERT INTO `xyk_bankcard` VALUES ('14', '北京银行', '0', '1', '0', 'BCCB', 'http://47.96.129.71/upload/bankcard/bankcard_icon_1.png', '#C8394D');
INSERT INTO `xyk_bankcard` VALUES ('15', '华夏银行', '0', '1', '0', 'HXB', 'http://47.96.129.71/upload/bankcard/bankcard_icon_5.png', '#C8394D');
INSERT INTO `xyk_bankcard` VALUES ('16', '浦发银行', '0', '1', '0', 'SPDB', 'http://47.96.129.71/upload/bankcard/bankcard_icon_11.png', '#3F74BD');
INSERT INTO `xyk_bankcard` VALUES ('17', '上海银行', '0', '1', '0', 'SHB', 'http://47.96.129.71/upload/bankcard/bankcard_icon_12.png', '#3F74BD');
INSERT INTO `xyk_bankcard` VALUES ('18', '渤海银行', '0', '0', '0', 'CBHB', '', null);
INSERT INTO `xyk_bankcard` VALUES ('19', '江苏银行', '0', '0', '0', 'JSB', '', null);

-- ----------------------------
-- Table structure for xyk_billdetails
-- ----------------------------
DROP TABLE IF EXISTS `xyk_billdetails`;
CREATE TABLE `xyk_billdetails` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `BillId` int(11) unsigned NOT NULL COMMENT '账单ID',
  `CreditId` int(11) unsigned DEFAULT '0' COMMENT '信用卡id',
  `BankId` int(11) unsigned DEFAULT '0' COMMENT '银行卡id',
  `UserId` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `OrderNum` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '订单编号',
  `CardId` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '交易卡号',
  `CreateTime` int(50) unsigned DEFAULT '0' COMMENT '创建时间',
  `AddTime` int(50) unsigned DEFAULT '0',
  `Amount` decimal(10,2) unsigned DEFAULT NULL COMMENT '交易金额',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='账单详情表';

-- ----------------------------
-- Records of xyk_billdetails
-- ----------------------------
INSERT INTO `xyk_billdetails` VALUES ('45', '48', '1', '0', '82', '20171206100035733189', '6225768758046880', '1512525635', '1512525635', '2427.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('46', '49', '1', '0', '82', '20171206100035171319', '6225768758046880', '1512525635', '1512525635', '1170.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('47', '50', '1', '0', '82', '20171206100035620097', '6225768758046880', '1512525635', '1512525635', '1257.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('48', '51', '1', '0', '82', '20171206100035514584', '6225768758046880', '1512525635', '1512525635', '1785.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('49', '52', '1', '0', '82', '20171206100035295648', '6225768758046880', '1512525635', '1512525635', '765.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('50', '53', '1', '0', '82', '20171206100035132869', '6225768758046880', '1512525635', '1512525635', '1020.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('51', '54', '1', '0', '82', '20171206100035241232', '6225768758046880', '1512525635', '1512525635', '788.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('52', '55', '1', '0', '82', '20171206100035833501', '6225768758046880', '1512525635', '1512525635', '384.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('53', '56', '1', '0', '82', '20171206100035670439', '6225768758046880', '1512525635', '1512525635', '404.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('55', '58', '1', '0', '82', '20171206172119180134', '6225768758046880', '1512552079', '1512552079', '2500.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('56', '59', '1', '0', '82', '20171207123356634596', '6225768758046880', '1512621236', '1512621236', '1.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('57', '60', '1', '0', '82', '20171207123713264932', '6225768758046880', '1512621433', '1512621433', '0.50', null, null);
INSERT INTO `xyk_billdetails` VALUES ('58', '61', '1', '0', '82', '20171207123745976700', '6225768758046880', '1512621465', '1512621465', '1.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('59', '62', '1', '0', '82', '20171207123922244107', '6225768758046880', '1512621562', '1512621562', '1.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('60', '63', '1', '0', '82', '20171207123940190725', '6225768758046880', '1512621580', '1512621580', '1.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('61', '64', '1', '0', '82', '20171207123941777760', '6225768758046880', '1512621581', '1512621581', '1.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('62', '65', '1', '0', '82', '20171207123945302799', '6225768758046880', '1512621585', '1512621585', '1.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('63', '66', '1', '0', '82', '20171207124028735956', '6225768758046880', '1512621628', '1512621628', '1.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('64', '67', '1', '0', '82', '20171207124237436638', '6225768758046880', '1512621757', '1512621757', '1.00', null, null);
INSERT INTO `xyk_billdetails` VALUES ('65', '68', '1', '0', '82', '20171207124254207970', '6225768758046880', '1512621774', '1512621774', '1.00', null, null);

-- ----------------------------
-- Table structure for xyk_billlistlog
-- ----------------------------
DROP TABLE IF EXISTS `xyk_billlistlog`;
CREATE TABLE `xyk_billlistlog` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '账单ID',
  `CreditId` int(11) DEFAULT NULL COMMENT '交易卡 id  ',
  `BankId` int(11) DEFAULT NULL COMMENT '结算卡 id',
  `UserId` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `BackTime` int(50) unsigned DEFAULT '0' COMMENT '还款时间',
  `status` int(11) unsigned DEFAULT '0' COMMENT '还款状态; 0|失败；1|成功; 2|处理中',
  `AddTime` int(50) unsigned DEFAULT '0',
  `Amount` decimal(10,2) unsigned DEFAULT NULL COMMENT '账单金额',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `Type` int(11) DEFAULT NULL COMMENT '1 充值 2 提现 3 还款 4 还款消费 5 保证金收取 6 保证金返还',
  `feeType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手续费类型',
  `TableId` int(11) DEFAULT NULL COMMENT '业务表ID',
  `PayBankId` int(11) DEFAULT NULL COMMENT '如果设置了 使用银行卡来收取保证金 字段为银行卡id',
  `SysFee` decimal(10,2) DEFAULT NULL COMMENT '系统手续费',
  `From` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '钱来源',
  `To` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '钱 去向',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='账单列表';

-- ----------------------------
-- Records of xyk_billlistlog
-- ----------------------------
INSERT INTO `xyk_billlistlog` VALUES ('49', '1', '0', '82', '0', '1', '1512525635', '1170.00', '2017-12-06 10:00:35', '2017-12-06 15:41:33', '4', '', '180', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('58', '1', '0', '82', '0', '2', '1512552079', '2500.00', '2017-12-06 17:21:19', '2017-12-06 17:24:52', '5', '', '180', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('59', '1', '0', '82', '0', '2', '1512621236', '1.00', '2017-12-07 12:33:56', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('60', '1', '0', '82', '0', '2', '1512621433', '0.50', '2017-12-07 12:37:13', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('61', '1', '0', '82', '0', '2', '1512621465', '1.00', '2017-12-07 12:37:45', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('62', '1', '0', '82', '0', '2', '1512621562', '1.00', '2017-12-07 12:39:22', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('63', '1', '0', '82', '0', '2', '1512621580', '1.00', '2017-12-07 12:39:40', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('64', '1', '0', '82', '0', '2', '1512621581', '1.00', '2017-12-07 12:39:41', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('65', '1', '0', '82', '0', '2', '1512621585', '1.00', '2017-12-07 12:39:45', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('66', '1', '0', '82', '0', '2', '1512621628', '1.00', '2017-12-07 12:40:28', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('67', '1', '0', '82', '0', '2', '1512621757', '1.00', '2017-12-07 12:42:37', null, '1', '', '0', null, null, null, null);
INSERT INTO `xyk_billlistlog` VALUES ('68', '1', '0', '82', '0', '2', '1512621774', '1.00', '2017-12-07 12:42:54', null, '1', '', '0', null, null, null, null);

-- ----------------------------
-- Table structure for xyk_category
-- ----------------------------
DROP TABLE IF EXISTS `xyk_category`;
CREATE TABLE `xyk_category` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Cid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `ParentCid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级分类ID',
  `Name` varchar(50) NOT NULL COMMENT '分类名称',
  `IsLeaf` tinyint(1) unsigned DEFAULT NULL COMMENT '是否为页子类目(true/false)',
  `SortOrder` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '类目建议排序号',
  `FeatureList` varchar(20) DEFAULT NULL COMMENT '特征列表',
  `DateRequire` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要选择日期',
  `Isvalid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `UpdateTime` int(10) unsigned DEFAULT '0' COMMENT '修改时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UK_CATEGORY_CID` (`Cid`),
  KEY `parent_cid` (`ParentCid`),
  KEY `is_leaf` (`IsLeaf`),
  KEY `I_SortOrder` (`SortOrder`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='票分类表';

-- ----------------------------
-- Records of xyk_category
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_centerlog
-- ----------------------------
DROP TABLE IF EXISTS `xyk_centerlog`;
CREATE TABLE `xyk_centerlog` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `DomainUri` varchar(50) DEFAULT NULL COMMENT '请求域名',
  `LogType` tinyint(1) DEFAULT '1' COMMENT '日志类型(1分发请求 2分发响应 3分发异步通知)',
  `Content` text COMMENT '内容',
  `AddTime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='分发日志';

-- ----------------------------
-- Records of xyk_centerlog
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_creditcard
-- ----------------------------
DROP TABLE IF EXISTS `xyk_creditcard`;
CREATE TABLE `xyk_creditcard` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '银行卡ID',
  `CreditCard` varchar(100) DEFAULT NULL COMMENT '银行卡名称',
  `statue` int(11) DEFAULT '0' COMMENT '信用卡设置状态; 0|正常；1|限制',
  `Isvalid` tinyint(1) DEFAULT '0' COMMENT '是否有效（1|有效，0|无效）',
  `AddTime` int(50) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='信用卡列表列表';

-- ----------------------------
-- Records of xyk_creditcard
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_dic
-- ----------------------------
DROP TABLE IF EXISTS `xyk_dic`;
CREATE TABLE `xyk_dic` (
  `DicId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DicKey` smallint(5) unsigned NOT NULL COMMENT '键',
  `DicValue` varchar(50) NOT NULL COMMENT '值',
  `EnumName` varchar(50) NOT NULL DEFAULT '' COMMENT '枚举名称',
  `DicTypeId` int(10) unsigned NOT NULL COMMENT '字典分类ID',
  `Description` varchar(500) NOT NULL COMMENT '描述',
  `DicOrder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `AddDate` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`DicId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='字典表';

-- ----------------------------
-- Records of xyk_dic
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_dictype
-- ----------------------------
DROP TABLE IF EXISTS `xyk_dictype`;
CREATE TABLE `xyk_dictype` (
  `DicTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `TypeName` varchar(100) NOT NULL COMMENT '字典分类名',
  `TypeEnumName` varchar(50) NOT NULL DEFAULT '' COMMENT '字典类型英文名',
  `Description` varchar(500) NOT NULL COMMENT '描述',
  `DictypeOrder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `CreateTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`DicTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='字典分类表';

-- ----------------------------
-- Records of xyk_dictype
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_fee
-- ----------------------------
DROP TABLE IF EXISTS `xyk_fee`;
CREATE TABLE `xyk_fee` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PlanFee` decimal(10,2) DEFAULT '0.00' COMMENT '计划手续费 百分比',
  `SettleFee` decimal(10,2) DEFAULT '0.00' COMMENT '提现手续费 百分比',
  `PayFee` decimal(10,2) DEFAULT '0.00' COMMENT '充值手续费 百分比',
  `RepayFee` decimal(10,2) DEFAULT '0.00' COMMENT '还款费率',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xyk_fee
-- ----------------------------
INSERT INTO `xyk_fee` VALUES ('1', '1.00', '1.00', '1.00', '1.00');

-- ----------------------------
-- Table structure for xyk_Invitationcode
-- ----------------------------
DROP TABLE IF EXISTS `xyk_Invitationcode`;
CREATE TABLE `xyk_Invitationcode` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '邀请码ID',
  `MerchantId` int(11) DEFAULT '0' COMMENT '代理商id(平台也属于代理商)',
  `invcode` varchar(100) DEFAULT NULL COMMENT '邀请码',
  `source` int(11) DEFAULT '0',
  `Isuse` tinyint(1) DEFAULT '0' COMMENT '是否被使用默认0,(0,未使用，1已使用)',
  `Isvalid` tinyint(1) DEFAULT '1' COMMENT '是否有效；默认1（1|有效，0|无效）',
  `AddTime` int(50) DEFAULT '0',
  `BankCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '银行卡编号',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COMMENT='邀请码表';

-- ----------------------------
-- Records of xyk_Invitationcode
-- ----------------------------
INSERT INTO `xyk_Invitationcode` VALUES ('1', '5', null, '0', '0', '0', '0', null);

-- ----------------------------
-- Table structure for xyk_jyexception
-- ----------------------------
DROP TABLE IF EXISTS `xyk_jyexception`;
CREATE TABLE `xyk_jyexception` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ExceptionType` smallint(5) unsigned NOT NULL COMMENT '异常/错误 类型(1.阿里大于发送短信)',
  `Content` text COMMENT '异常/错误内容(请求的内容与返回的异常内容一起写入该字段)',
  `AddTime` int(10) unsigned DEFAULT NULL COMMENT '数据添加时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `I_EXCEPTION_TYPE` (`ExceptionType`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COMMENT='异常表';

-- ----------------------------
-- Records of xyk_jyexception
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_labelcontent
-- ----------------------------
DROP TABLE IF EXISTS `xyk_labelcontent`;
CREATE TABLE `xyk_labelcontent` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `UserId` int(11) unsigned NOT NULL COMMENT '用户Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `LabelId` int(11) unsigned NOT NULL COMMENT '标签Id',
  `Content` varchar(100) DEFAULT '' COMMENT '标签内容',
  `OptionId` varchar(200) NOT NULL DEFAULT '' COMMENT '标签对应选项的id，单选则为空',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`Id`),
  KEY `INDEX_USERID` (`UserId`),
  KEY `INDEX_MERCHANT` (`MerchantId`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COMMENT='商户自定义标签的用户内容表';

-- ----------------------------
-- Records of xyk_labelcontent
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_labeloption
-- ----------------------------
DROP TABLE IF EXISTS `xyk_labeloption`;
CREATE TABLE `xyk_labeloption` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `LabelId` int(11) unsigned NOT NULL COMMENT '标签Id',
  `Sort` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `Name` varchar(100) DEFAULT '' COMMENT '选项内容',
  `Isvalid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效(1有效 0无效)',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`Id`),
  KEY `INDEX_LCMERCHANTID` (`MerchantId`),
  KEY `INDEX_LABELID` (`LabelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商户自定义标签选项表';

-- ----------------------------
-- Records of xyk_labeloption
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_menu
-- ----------------------------
DROP TABLE IF EXISTS `xyk_menu`;
CREATE TABLE `xyk_menu` (
  `MenuId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MenuName` varchar(20) NOT NULL,
  `MenuDes` varchar(300) DEFAULT NULL,
  `Url` varchar(100) DEFAULT NULL,
  `NewUrl` varchar(255) DEFAULT NULL COMMENT '菜单地址',
  `RootId` int(11) NOT NULL DEFAULT '0',
  `ParentId` int(11) NOT NULL DEFAULT '0',
  `RankId` int(11) DEFAULT NULL COMMENT '菜单级别',
  `MenuOrder` smallint(6) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '菜单类型',
  `Addtime` datetime NOT NULL,
  PRIMARY KEY (`MenuId`),
  UNIQUE KEY `RootId` (`RootId`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
-- Records of xyk_menu
-- ----------------------------
INSERT INTO `xyk_menu` VALUES ('39', '商户概况', '', '/back/index/index', '/back/index/index', '100001', '0', '0', '0', '1', '2017-06-12 21:28:18');
INSERT INTO `xyk_menu` VALUES ('40', '账号与权限', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100002', '0', '0', '0', '1', '2017-06-12 21:28:41');
INSERT INTO `xyk_menu` VALUES ('41', '场馆管理', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100003', '0', '0', '0', '1', '2017-06-12 21:28:55');
INSERT INTO `xyk_menu` VALUES ('42', '票务管理', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100004', '0', '0', '0', '1', '2017-06-12 21:29:05');
INSERT INTO `xyk_menu` VALUES ('43', '订单管理', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100005', '0', '0', '0', '1', '2017-06-12 21:29:15');
INSERT INTO `xyk_menu` VALUES ('44', '数据统计', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100006', '0', '0', '0', '1', '2017-06-12 21:29:26');
INSERT INTO `xyk_menu` VALUES ('45', '会员管理', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100007', '0', '0', '0', '1', '2017-06-12 21:29:36');
INSERT INTO `xyk_menu` VALUES ('46', '基本信息', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100008', '39', '0', '0', '1', '2017-06-12 21:30:00');
INSERT INTO `xyk_menu` VALUES ('47', '微信公众号', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100009', '39', '0', '0', '1', '2017-06-12 21:30:16');
INSERT INTO `xyk_menu` VALUES ('48', '员工账号', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100010', '40', '0', '0', '1', '2017-06-13 09:13:42');
INSERT INTO `xyk_menu` VALUES ('49', '角色管理', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100011', '40', '0', '0', '1', '2017-06-13 09:22:28');
INSERT INTO `xyk_menu` VALUES ('50', '菜单权限管理', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100012', '40', '0', '0', '1', '2017-06-13 09:22:46');
INSERT INTO `xyk_menu` VALUES ('51', '场馆列表', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100013', '41', '0', '0', '1', '2017-06-13 09:23:17');
INSERT INTO `xyk_menu` VALUES ('52', '添加场馆', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100014', '41', '0', '0', '1', '2017-06-13 09:25:00');
INSERT INTO `xyk_menu` VALUES ('53', '票务列表', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100015', '42', '0', '0', '1', '2017-06-13 09:26:31');
INSERT INTO `xyk_menu` VALUES ('54', '添加票务', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100016', '42', '0', '0', '1', '2017-06-13 09:26:46');
INSERT INTO `xyk_menu` VALUES ('55', '订单列表', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100017', '43', '0', '0', '1', '2017-06-13 09:26:59');
INSERT INTO `xyk_menu` VALUES ('56', '退款列表', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100018', '43', '0', '0', '1', '2017-06-13 09:27:29');
INSERT INTO `xyk_menu` VALUES ('59', '会员列表', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100021', '45', '0', '0', '1', '2017-06-13 09:28:03');
INSERT INTO `xyk_menu` VALUES ('60', '电子票列表', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100022', '44', '0', '0', '1', '2017-06-13 09:28:13');
INSERT INTO `xyk_menu` VALUES ('61', '修改商户信息', '', '/back/index/index', '/back/index/index', '100023', '46', '0', '0', '1', '2017-06-13 09:28:56');
INSERT INTO `xyk_menu` VALUES ('62', '修改配置', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100024', '47', '0', '0', '1', '2017-06-13 09:29:09');
INSERT INTO `xyk_menu` VALUES ('63', '新增员工', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100025', '48', '0', '0', '1', '2017-06-13 09:29:27');
INSERT INTO `xyk_menu` VALUES ('64', '启用/停用', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100026', '48', '0', '0', '1', '2017-06-13 09:29:52');
INSERT INTO `xyk_menu` VALUES ('65', '修改员工信息', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100027', '48', '0', '0', '1', '2017-06-13 09:30:05');
INSERT INTO `xyk_menu` VALUES ('67', '增加角色', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100029', '49', '0', '0', '1', '2017-06-13 09:30:37');
INSERT INTO `xyk_menu` VALUES ('68', '编辑角色信息', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100030', '49', '0', '0', '1', '2017-06-13 09:30:51');
INSERT INTO `xyk_menu` VALUES ('69', '删除角色', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100031', '49', '0', '0', '1', '2017-06-13 09:31:08');
INSERT INTO `xyk_menu` VALUES ('70', '增加新菜单', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100032', '50', '0', '0', '1', '2017-06-13 09:31:22');
INSERT INTO `xyk_menu` VALUES ('71', '添加子菜单', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100033', '50', '0', '0', '1', '2017-06-13 09:31:37');
INSERT INTO `xyk_menu` VALUES ('72', '编辑菜单', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100034', '50', '0', '0', '1', '2017-06-13 09:31:50');
INSERT INTO `xyk_menu` VALUES ('73', '删除菜单', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100035', '50', '0', '0', '1', '2017-06-13 09:32:01');
INSERT INTO `xyk_menu` VALUES ('74', '查看场馆详情', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100036', '51', '0', '0', '1', '2017-06-13 09:33:32');
INSERT INTO `xyk_menu` VALUES ('75', '编辑场馆信息', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100037', '51', '0', '0', '1', '2017-06-13 09:33:44');
INSERT INTO `xyk_menu` VALUES ('76', '删除场馆', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100038', '51', '0', '0', '1', '2017-06-13 09:33:57');
INSERT INTO `xyk_menu` VALUES ('77', '查看厅区列表', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100039', '51', '0', '0', '1', '2017-06-13 09:34:11');
INSERT INTO `xyk_menu` VALUES ('78', '编辑票务信息', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100040', '53', '0', '0', '1', '2017-06-13 09:34:42');
INSERT INTO `xyk_menu` VALUES ('79', '删除票务信息', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100041', '53', '0', '0', '1', '2017-06-13 09:34:53');
INSERT INTO `xyk_menu` VALUES ('80', '赠票', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100042', '53', '0', '0', '1', '2017-06-13 09:35:05');
INSERT INTO `xyk_menu` VALUES ('81', '演出座位设置', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100043', '53', '0', '0', '1', '2017-06-13 09:35:14');
INSERT INTO `xyk_menu` VALUES ('82', '查看详情', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100044', '55', '0', '0', '1', '2017-06-13 09:35:32');
INSERT INTO `xyk_menu` VALUES ('83', '查看详情', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100045', '56', '0', '0', '1', '2017-06-13 09:35:45');
INSERT INTO `xyk_menu` VALUES ('86', '删除员工账号', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100047', '48', '0', '0', '1', '2017-06-16 10:04:17');
INSERT INTO `xyk_menu` VALUES ('88', '价格设置', '', 'http://jytest.com/back/index/index', 'http://jytest.com/back/index/index', '100048', '53', '0', '0', '1', '2017-06-21 14:13:43');
INSERT INTO `xyk_menu` VALUES ('95', '短信服务', ' ', 'http://ticketyun.jytest.com/back/index/index', 'http://ticketyun.jytest.com/back/index/index', '100060', '0', '0', '0', '1', '2017-07-07 17:49:28');
INSERT INTO `xyk_menu` VALUES ('96', '短信模板', ' ', 'http://ticketyun.jytest.com/back/index/index', 'http://ticketyun.jytest.com/back/index/index', '100061', '95', '0', '0', '1', '2017-07-07 17:50:29');
INSERT INTO `xyk_menu` VALUES ('97', '短信接口', ' ', 'http://ticketyun.jytest.com/back/index/index', 'http://ticketyun.jytest.com/back/index/index', '100062', '95', '0', '0', '1', '2017-07-07 17:51:10');
INSERT INTO `xyk_menu` VALUES ('98', '服务类型修改', ' ', 'http://ticketyun.jytest.com/back/index/index', 'http://ticketyun.jytest.com/back/index/index', '100063', '96', '0', '0', '1', '2017-07-07 17:53:26');
INSERT INTO `xyk_menu` VALUES ('99', '短信模板编辑', ' ', 'http://ticketyun.jytest.com/back/index/index', 'http://ticketyun.jytest.com/back/index/index', '100064', '96', '0', '0', '1', '2017-07-07 17:54:40');
INSERT INTO `xyk_menu` VALUES ('100', '修改转赠次数', null, 'http://ticketyun.jytest.com/back/index/index', 'http://ticketyun.jytest.com/back/index/index', '100065', '53', '0', '0', '1', '2017-07-11 15:16:08');
INSERT INTO `xyk_menu` VALUES ('101', '查询票务数据', null, 'http://ticketyun.juyanabc.net/back/index/index', 'http://ticketyun.juyanabc.net/back/index/index', '100066', '53', '0', '0', '1', '2017-07-18 16:03:08');
INSERT INTO `xyk_menu` VALUES ('103', '发送测试短信', null, 'http://ticketyun.jytest.com/back/index/index', 'http://ticketyun.jytest.com/back/index/index', '100067', '96', '0', '0', '1', '2017-07-18 16:58:29');
INSERT INTO `xyk_menu` VALUES ('104', '票务统计', '', '/back/statistics/ticketstatistics', '/back/statistics/ticketstatistics', '100068', '44', '0', '0', '1', '2017-07-19 13:21:13');
INSERT INTO `xyk_menu` VALUES ('105', '查看数据', '', 'http://yp.com/back/index/index', 'http://yp.com/back/index/index', '100069', '104', '0', '0', '1', '2017-07-19 13:21:56');
INSERT INTO `xyk_menu` VALUES ('109', '会员资料标签管理', null, '/back/label/index', '/back/label/index', '100070', '45', '0', '0', '1', '2017-07-25 15:02:56');
INSERT INTO `xyk_menu` VALUES ('110', '新增标签', null, '/back/label/index', '/back/label/index', '100071', '109', '0', '0', '1', '2017-07-25 15:06:11');
INSERT INTO `xyk_menu` VALUES ('111', '编辑标签', null, '/back/label/index', '/back/label/index', '100072', '109', '0', '0', '1', '2017-07-25 15:09:36');
INSERT INTO `xyk_menu` VALUES ('112', '删除标签', null, '/back/label/index', '/back/label/index', '100073', '109', '0', '0', '1', '2017-07-25 15:10:10');
INSERT INTO `xyk_menu` VALUES ('113', '购票问题设置', null, '/back/index/index', '/index/index', '100074', '42', '0', '0', '1', '2017-07-26 15:23:08');
INSERT INTO `xyk_menu` VALUES ('114', '购票问题添加', null, '/back/index/index', '/index/index', '100075', '113', '0', '0', '1', '2017-07-26 15:23:08');
INSERT INTO `xyk_menu` VALUES ('115', '购票问题编辑', null, '/back/index/index', '/index/index', '100076', '113', '0', '0', '1', '2017-07-26 15:23:08');
INSERT INTO `xyk_menu` VALUES ('116', '购票问题删除', null, '/back/index/index', '/index/index', '100077', '113', '0', '0', '1', '2017-07-26 15:23:08');
INSERT INTO `xyk_menu` VALUES ('117', '购票回答问题', null, '/back/index/index', '/index/index', '100078', '53', '0', '0', '1', '2017-07-26 15:23:08');
INSERT INTO `xyk_menu` VALUES ('118', '内容管理', '', '/back/index/index', '/back/index/index', '100079', '0', '0', '0', '1', '2017-08-11 13:36:17');
INSERT INTO `xyk_menu` VALUES ('119', '资讯管理', '', '/back/news/newslist', '/back/news/newslist', '100080', '118', '0', '0', '1', '2017-08-11 13:36:41');
INSERT INTO `xyk_menu` VALUES ('120', '添加资讯', '', '/back/news/newsadd', '/back/news/newsadd', '100081', '119', '0', '0', '1', '2017-08-11 13:37:49');
INSERT INTO `xyk_menu` VALUES ('121', '编辑资讯', '', '/back/news/newsedit', '/back/news/newsedit', '100082', '119', '0', '0', '1', '2017-08-11 13:38:25');
INSERT INTO `xyk_menu` VALUES ('122', '删除资讯', '', '/back/news/ajaxdelnews', '/back/news/ajaxdelnews', '100083', '119', '0', '0', '1', '2017-08-11 13:39:21');
INSERT INTO `xyk_menu` VALUES ('123', '查看资讯', '', '/back/news/newsdetail', '/back/news/newsdetail', '100084', '119', '0', '0', '1', '2017-08-11 13:41:00');
INSERT INTO `xyk_menu` VALUES ('124', '置顶操作', '', '/back/news/ajaxsettop', '/back/news/ajaxsettop', '100085', '119', '0', '0', '1', '2017-08-11 13:41:38');
INSERT INTO `xyk_menu` VALUES ('125', '广告管理', null, '/back/banner/catelist', '/back/banner/catelist', '100086', '118', '0', '0', '1', '2017-08-11 14:35:24');
INSERT INTO `xyk_menu` VALUES ('126', '添加广告', null, '/back/banner/add', '/back/banner/add', '100087', '125', '0', '0', '1', '2017-08-11 14:36:54');
INSERT INTO `xyk_menu` VALUES ('127', '编辑广告', null, '/back/banner/edit', '/back/banner/edit', '100088', '125', '0', '0', '1', '2017-08-11 14:37:54');
INSERT INTO `xyk_menu` VALUES ('128', '删除广告', null, '/back/banner/delete', '/back/banner/delete', '100089', '125', '0', '0', '1', '2017-08-11 14:38:50');
INSERT INTO `xyk_menu` VALUES ('129', '详情', '', '/back/index/index', '/back/index/index', '100090', '53', '0', '0', '1', '2017-08-25 16:08:02');
INSERT INTO `xyk_menu` VALUES ('130', '修改打印模板', null, '/back/printtemp/setprinttemp', '/back/printtemp/setprinttemp', '100091', '53', '0', '0', '1', '2017-10-23 17:25:30');
INSERT INTO `xyk_menu` VALUES ('131', '打印模板', null, '/back/printtemp/index', '/back/printtemp/index', '100092', '42', '0', '0', '1', '2017-10-23 17:28:32');
INSERT INTO `xyk_menu` VALUES ('132', '添加打印模板', null, '/back/printtemp/add', '/back/printtemp/add', '100093', '131', '0', '0', '1', '2017-10-23 17:30:08');
INSERT INTO `xyk_menu` VALUES ('133', '编辑打印模板', null, '/back/printtemp/edit', '/back/printtemp/edit', '100094', '131', '0', '0', '1', '2017-10-23 17:30:55');
INSERT INTO `xyk_menu` VALUES ('134', '删除打印模板', null, '/back/printtemp/delete', '/back/printtemp/delete', '100095', '131', '0', '0', '1', '2017-10-23 17:31:54');

-- ----------------------------
-- Table structure for xyk_merchant
-- ----------------------------
DROP TABLE IF EXISTS `xyk_merchant`;
CREATE TABLE `xyk_merchant` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商户Id',
  `Name` varchar(100) NOT NULL COMMENT '商户名称',
  `MerchantNo` varchar(20) DEFAULT NULL COMMENT '商户编号',
  `Tel` varchar(50) DEFAULT NULL COMMENT '电话（可填多个）',
  `Logo` varchar(150) DEFAULT NULL COMMENT '商户logo',
  `ImageTime` int(10) unsigned DEFAULT NULL COMMENT '图片时间',
  `DomainKey` varchar(20) DEFAULT '' COMMENT '图片服务器二级域名',
  `Address` varchar(150) DEFAULT '' COMMENT '具体地址',
  `Contact` varchar(50) DEFAULT '' COMMENT '联系人',
  `Summary` text COMMENT '商户简介',
  `TicketType` varchar(100) DEFAULT '' COMMENT '票务类型，多个用逗号隔开,id取category',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `UpdateTime` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  `Ext4` varchar(50) DEFAULT NULL,
  `Ext5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='商户表';

-- ----------------------------
-- Records of xyk_merchant
-- ----------------------------
INSERT INTO `xyk_merchant` VALUES ('5', '卡邦', '', '400-123456', 'f6ef66cb17aa9b5f9c568e0e56c3c70f.jpg', '1512800940', '', '斯蒂芬斯蒂芬是的', '测试', '123', '', '1490250031', '1512800940', null, null, null, null, null);

-- ----------------------------
-- Table structure for xyk_merchantaccount
-- ----------------------------
DROP TABLE IF EXISTS `xyk_merchantaccount`;
CREATE TABLE `xyk_merchantaccount` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商户Id',
  `MerchantNo` varchar(20) DEFAULT NULL COMMENT '商户编号',
  `TotalBalance` decimal(17,3) DEFAULT '0.000' COMMENT '帐户余额(包含冻结的)',
  `Balance` decimal(17,3) DEFAULT '0.000' COMMENT '帐户可用余额',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `UpdateTime` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户账户表';

-- ----------------------------
-- Records of xyk_merchantaccount
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_merchantaccountlog
-- ----------------------------
DROP TABLE IF EXISTS `xyk_merchantaccountlog`;
CREATE TABLE `xyk_merchantaccountlog` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `Amount` decimal(17,3) DEFAULT '0.000' COMMENT '金额',
  `FundType` tinyint(1) NOT NULL DEFAULT '0' COMMENT '收支类型(0支出 1收入)',
  `Des` varchar(200) DEFAULT NULL COMMENT '账户金额变动描述',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户账户日志表';

-- ----------------------------
-- Records of xyk_merchantaccountlog
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_merchantad
-- ----------------------------
DROP TABLE IF EXISTS `xyk_merchantad`;
CREATE TABLE `xyk_merchantad` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `ImageUrl` varchar(200) DEFAULT NULL COMMENT '广告图片地址',
  `LinkUrl` varchar(200) DEFAULT NULL COMMENT '广告跳转地址',
  `AdType` smallint(5) DEFAULT '0' COMMENT '广告类型',
  `Des` varchar(200) DEFAULT NULL COMMENT '描述说明',
  `Isvalid` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效',
  `Sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `UpdateTime` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='商户广告/轮播图表';

-- ----------------------------
-- Records of xyk_merchantad
-- ----------------------------
INSERT INTO `xyk_merchantad` VALUES ('31', '5', '/uploads/m/2017/12/678224efd8b56effee1bf34c19d725c8.jpg', '', '10001', '1', '1', '0', '1513068500', '0', null, null);
INSERT INTO `xyk_merchantad` VALUES ('32', '5', '/uploads/m/2017/12/ebb69e0f54d0ae8c191b8c74735111dc.jpg', '', '10001', '2', '1', '0', '1513068512', '0', null, null);
INSERT INTO `xyk_merchantad` VALUES ('33', '5', '/uploads/m/2017/12/d463912c724c4052412320ef61d1b4a1.jpg', '', '10001', '3', '1', '0', '1513068527', '0', null, null);

-- ----------------------------
-- Table structure for xyk_merchantlabel
-- ----------------------------
DROP TABLE IF EXISTS `xyk_merchantlabel`;
CREATE TABLE `xyk_merchantlabel` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `MerchantId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `Label` varchar(50) NOT NULL COMMENT '自定义标签名称',
  `Required` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `Sort` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用(1启用 0禁用)',
  `Isvalid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效(1有效 0已删除)',
  `Type` varchar(20) NOT NULL DEFAULT 'text' COMMENT '标签内容类型(text:文本框 optional:下拉框 optionaltext:下拉文本 multicheck:多选 radio:单选)',
  `AddTime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`Id`),
  KEY `INDEX_MERCHANTID` (`MerchantId`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COMMENT='商户自定义标签表';

-- ----------------------------
-- Records of xyk_merchantlabel
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_merchantusers
-- ----------------------------
DROP TABLE IF EXISTS `xyk_merchantusers`;
CREATE TABLE `xyk_merchantusers` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商户用户Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `Username` varchar(50) NOT NULL COMMENT '商户用户名',
  `Password` varchar(32) NOT NULL COMMENT '登录密码',
  `RealName` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  `MainUser` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是主用户(0不是 1是)',
  `Status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '帐号状态(0停用 1启用)',
  `Isvalid` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0账户删除 1账户存在',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `UpdateTime` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  `Ext4` varchar(50) DEFAULT NULL,
  `Ext5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UK_VENUEUSERS_USERNAME` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户用户表';

-- ----------------------------
-- Records of xyk_merchantusers
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_news
-- ----------------------------
DROP TABLE IF EXISTS `xyk_news`;
CREATE TABLE `xyk_news` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `MerchantId` int(11) unsigned NOT NULL COMMENT '所属商户Id',
  `Title` varchar(200) NOT NULL COMMENT '资讯标题',
  `SubTitle` varchar(100) DEFAULT '' COMMENT '子标题',
  `KeyWords` varchar(100) DEFAULT '' COMMENT '关键词',
  `Author` varchar(50) DEFAULT NULL COMMENT '作者',
  `Description` varchar(1000) DEFAULT NULL COMMENT '描述',
  `Content` longtext NOT NULL COMMENT '资讯内容',
  `PublishSource` varchar(50) DEFAULT '' COMMENT '来源',
  `NewsType` int(11) DEFAULT '0' COMMENT '资讯类型',
  `Isvalid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效',
  `Top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶显示',
  `IsDisplay` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `Image` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT '图片名',
  `ImageTime` int(10) unsigned DEFAULT NULL COMMENT '图片时间',
  `DomainKey` varchar(20) CHARACTER SET utf8 DEFAULT '' COMMENT '图片服务器二级域名',
  `EffectiveTime` int(10) unsigned NOT NULL COMMENT '生效时间',
  `AddTime` int(10) unsigned DEFAULT NULL COMMENT '资讯添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '资讯修改时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `I_ZIXUN_MERCHANTID` (`MerchantId`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COMMENT='资讯表';

-- ----------------------------
-- Records of xyk_news
-- ----------------------------
INSERT INTO `xyk_news` VALUES ('72', '5', 'aaa', '', '', null, null, '<p>11</p>', '', '0', '1', '0', '1', '3f3029bc832e274c1f50f876f537ca2d.jpg', '1513068542', '', '1513068542', '1513068542', '1513068542', null, null, null);
INSERT INTO `xyk_news` VALUES ('73', '5', 'bbb', '', '', null, null, '<p>bbb</p>', '', '0', '1', '0', '1', 'e756e939089c9805c91ec14217313bd5.jpg', '1513068555', '', '1513068555', '1513068555', '1513068555', null, null, null);
INSERT INTO `xyk_news` VALUES ('74', '5', '美驱逐舰再怼商船致5伤10失踪 美军舰为啥总撞？', '', '', null, null, '<p>							</p><p><br/></p><p style=\"margin-top: 1.8em; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(51, 51, 51); font-family: &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, 宋体; white-space: normal; background-color: rgb(255, 255, 255);\">据美国太平洋舰队官网消息，美国“麦凯恩”号导弹驱逐舰于北京时间21日早上7点24分在新加坡东部和马六甲海峡附近与一艘商船Alnic MC发生碰撞。初步报告显示，“麦凯恩”号驱逐舰左舷受损。目前搜救工作正在进行中。除了拖船外，新加坡方面已派出海军舰艇、直升机和海岸警卫队船只在相关区域提供援助。</p><p style=\"margin-top: 1.8em; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(51, 51, 51); font-family: &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, 宋体; white-space: normal; background-color: rgb(255, 255, 255);\">就美国“麦凯恩”号导弹驱逐舰与一艘商船发生碰撞一事，美国海军方面表示，在与商船发生碰撞后，&quot;麦凯恩&quot;号驱逐舰依靠自身的力量继续航行，前往港口。相关方面称正在确认驱逐舰受损程度和人员伤亡情况。这一事件也将会被调查。美联社援引海军方面消息称，目前已有10名海员失踪，5人受伤。</p><p style=\"margin-top: 1.8em; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(51, 51, 51); font-family: &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, 宋体; white-space: normal; background-color: rgb(255, 255, 255);\">“麦凯恩”号驱逐舰以亚利桑那州参议员约翰·麦凯恩的父亲和祖父的名字命名，他们都是海军上将。约翰·麦凯恩也针对此事发推称会为这艘驱逐舰上的美国水兵祈祷。</p><p><br/></p><p><img src=\"http://ticketyun.jytest.com/uploads/s/2017/09/08/1504847863372339.jpg\" title=\"1504847863372339.jpg\"/></p><p></p><p><img src=\"http://ticketyun.jytest.com/uploads/s/2017/09/08/1504857959119723.png\" title=\"1504857959119723.png\" alt=\"bg.png\"/></p><p><br/></p><p>\n						</p>', '', '0', '1', '0', '1', '44eb8e0e75535af8d6cf67c2977a85a7.jpg', '1504847837', '', '1503300628', '1503300582', '1504857981', null, null, null);

-- ----------------------------
-- Table structure for xyk_newseffect
-- ----------------------------
DROP TABLE IF EXISTS `xyk_newseffect`;
CREATE TABLE `xyk_newseffect` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NewsId` int(11) unsigned NOT NULL COMMENT '资讯Id',
  `UserId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户Id,游客为0',
  `ActionType` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '资讯动作类型，参考字典',
  `Content` varchar(500) DEFAULT NULL COMMENT '内容(如果是评论，即为评论内容，其他的可不填)',
  `AddTime` int(10) unsigned DEFAULT NULL COMMENT '数据添加时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `I_INFEFFECT_INFID` (`NewsId`) USING BTREE,
  KEY `I_INFEFFECT_TYPE` (`ActionType`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户对资讯的影响表';

-- ----------------------------
-- Records of xyk_newseffect
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_newsstatistics
-- ----------------------------
DROP TABLE IF EXISTS `xyk_newsstatistics`;
CREATE TABLE `xyk_newsstatistics` (
  `NewsId` int(11) unsigned NOT NULL COMMENT 'information表中的id',
  `ReadTimes` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `LikeTimes` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '资讯被赞的次数',
  `UnLikeTimes` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '资讯被"踩"的次数',
  `CommentTimes` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '评论次数',
  `AddTime` int(10) unsigned DEFAULT NULL COMMENT '数据添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '数据修改时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`NewsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资讯统计表（阅读次数、被赞次数、被踩次数等）';

-- ----------------------------
-- Records of xyk_newsstatistics
-- ----------------------------
INSERT INTO `xyk_newsstatistics` VALUES ('72', '0', '0', '0', '0', '1513068542', '1513068542', null, null, null);
INSERT INTO `xyk_newsstatistics` VALUES ('73', '0', '0', '0', '0', '1513068555', '1513068555', null, null, null);
INSERT INTO `xyk_newsstatistics` VALUES ('74', '0', '0', '0', '0', '1513068567', '1513068567', null, null, null);

-- ----------------------------
-- Table structure for xyk_order
-- ----------------------------
DROP TABLE IF EXISTS `xyk_order`;
CREATE TABLE `xyk_order` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `OrderNum` varchar(30) NOT NULL COMMENT '交易编号',
  `hUserId` int(11) unsigned NOT NULL COMMENT '合利宝用户ID',
  `Mobile` int(11) DEFAULT NULL COMMENT '手机号',
  `OrderName` varchar(255) DEFAULT '' COMMENT '合利宝姓名',
  `OrderUserId` int(11) unsigned NOT NULL COMMENT '下单者的用户Id',
  `UserId` int(11) unsigned NOT NULL COMMENT '普通用户Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `MerchantNum` varchar(50) DEFAULT NULL COMMENT '合利宝商户订单号',
  `Num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '购买数量',
  `TotalFee` decimal(11,3) DEFAULT '0.000' COMMENT '订单总金额',
  `OrderSource` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1信用卡；2储蓄卡',
  `Status` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '订单状态（参考字典）',
  `dealType` tinyint(1) NOT NULL COMMENT '交易类型',
  `RefundTime` int(10) unsigned DEFAULT '0' COMMENT '退票时间',
  `Isvalid` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0无效 1有效)订单超时未支付置为无效',
  `PayTime` int(10) unsigned DEFAULT '0' COMMENT '付款时间',
  `PayType` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '支付途径,1|信用卡 ；2|储蓄卡',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `ORDERNUM` (`OrderNum`)
) ENGINE=InnoDB AUTO_INCREMENT=1129 DEFAULT CHARSET=utf8 COMMENT='票订单表';

-- ----------------------------
-- Records of xyk_order
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_plan
-- ----------------------------
DROP TABLE IF EXISTS `xyk_plan`;
CREATE TABLE `xyk_plan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '计划表',
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 初始化 ； 1 保证金已打， 计划执行中 ； 2 计划完成，等待退保证金； 3 保证金退还完成; 4 保证金收取中； 5 失败； 6 计划为创建',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `BankId` int(11) DEFAULT NULL,
  `TotalMoney` decimal(10,2) DEFAULT NULL COMMENT '还款总金额',
  `fee` decimal(10,0) DEFAULT NULL COMMENT '手续费',
  `CashDeposit` decimal(10,2) DEFAULT NULL COMMENT '保证金',
  `res` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '失败原因 只有状态5 出现',
  `PayBankId` int(11) DEFAULT NULL COMMENT '扣款的银行卡  如果是0  走余额',
  `SysFee` decimal(10,2) DEFAULT '0.00' COMMENT '系统统计 调用接口使用费率 总合',
  `times` int(11) DEFAULT '0' COMMENT '笔数',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=404 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xyk_plan
-- ----------------------------
INSERT INTO `xyk_plan` VALUES ('402', '2017-12-05 00:00:00', '2017-12-06 23:59:59', '6', '2017-12-08 00:16:18', '2017-12-08 00:16:18', '82', '1', '10000.00', '75', '2500.00', null, '0', '225.00', '3');
INSERT INTO `xyk_plan` VALUES ('403', '2017-12-05 00:00:00', '2017-12-06 23:59:59', '6', '2017-12-08 10:37:50', '2017-12-08 10:37:50', '82', '1', '10000.00', '75', '2500.00', null, '0', '225.00', '3');

-- ----------------------------
-- Table structure for xyk_plan_detail
-- ----------------------------
DROP TABLE IF EXISTS `xyk_plan_detail`;
CREATE TABLE `xyk_plan_detail` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PlanId` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `Money` decimal(10,2) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL COMMENT '1 还款  2 套现',
  `PayTime` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 准备中  1已完成  2 处理中 ',
  `OrderNum` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BankId` int(11) DEFAULT NULL COMMENT 'bankdcard 表ID',
  `SerialNum` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '平台流水',
  `Batch` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '批次 用于标注  哪个套现跟哪个还款是一组的',
  `sort` int(11) DEFAULT NULL,
  `SysFee` decimal(10,2) DEFAULT '0.00' COMMENT '每次接口收取费用 总合添加到 plan表',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3727 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xyk_plan_detail
-- ----------------------------
INSERT INTO `xyk_plan_detail` VALUES ('3709', '402', '2017-12-08 00:16:18', null, '1955.00', '1', '2017-12-05 11:35:35', '0', null, '1', null, '201712080016185492390', '1', '19.55');
INSERT INTO `xyk_plan_detail` VALUES ('3710', '402', '2017-12-08 00:16:18', '2017-12-08 00:16:18', '793.00', '2', '2017-12-05 12:08:49', '0', null, '1', null, '201712080016185492390', '2', '7.93');
INSERT INTO `xyk_plan_detail` VALUES ('3711', '402', '2017-12-08 00:16:18', '2017-12-08 00:16:18', '1162.00', '2', '2017-12-05 12:12:31', '0', null, '1', null, '201712080016185492390', '3', '11.62');
INSERT INTO `xyk_plan_detail` VALUES ('3712', '402', '2017-12-08 00:16:18', null, '2418.00', '1', '2017-12-05 12:44:09', '0', null, '1', null, '201712080016185165841', '4', '24.18');
INSERT INTO `xyk_plan_detail` VALUES ('3713', '402', '2017-12-08 00:16:18', '2017-12-08 00:16:18', '884.00', '2', '2017-12-05 18:45:17', '0', null, '1', null, '201712080016185165841', '5', '8.84');
INSERT INTO `xyk_plan_detail` VALUES ('3714', '402', '2017-12-08 00:16:18', '2017-12-08 00:16:18', '1534.00', '2', '2017-12-05 20:59:41', '0', null, '1', null, '201712080016185165841', '6', '15.34');
INSERT INTO `xyk_plan_detail` VALUES ('3715', '402', '2017-12-08 00:16:18', null, '5627.00', '1', '2017-12-06 15:11:16', '0', null, '1', null, '201712080016182702262', '7', '56.27');
INSERT INTO `xyk_plan_detail` VALUES ('3716', '402', '2017-12-08 00:16:18', '2017-12-08 00:16:18', '2748.00', '2', '2017-12-06 16:37:59', '0', null, '1', null, '201712080016182702262', '8', '27.48');
INSERT INTO `xyk_plan_detail` VALUES ('3717', '402', '2017-12-08 00:16:18', '2017-12-08 00:16:18', '2879.00', '2', '2017-12-06 16:40:20', '0', null, '1', null, '201712080016182702262', '9', '28.79');
INSERT INTO `xyk_plan_detail` VALUES ('3718', '403', '2017-12-08 10:37:50', null, '2374.00', '1', '2017-12-05 07:48:01', '0', null, '1', null, '201712081037508178850', '1', '23.74');
INSERT INTO `xyk_plan_detail` VALUES ('3719', '403', '2017-12-08 10:37:50', '2017-12-08 10:37:50', '910.00', '2', '2017-12-05 08:00:24', '0', null, '1', null, '201712081037508178850', '2', '9.10');
INSERT INTO `xyk_plan_detail` VALUES ('3720', '403', '2017-12-08 10:37:50', '2017-12-08 10:37:50', '1464.00', '2', '2017-12-05 08:31:18', '0', null, '1', null, '201712081037508178850', '3', '14.64');
INSERT INTO `xyk_plan_detail` VALUES ('3721', '403', '2017-12-08 10:37:50', null, '1726.00', '1', '2017-12-05 09:57:40', '0', null, '1', null, '201712081037506552141', '4', '17.26');
INSERT INTO `xyk_plan_detail` VALUES ('3722', '403', '2017-12-08 10:37:50', '2017-12-08 10:37:50', '742.00', '2', '2017-12-05 18:48:54', '0', null, '1', null, '201712081037506552141', '5', '7.42');
INSERT INTO `xyk_plan_detail` VALUES ('3723', '403', '2017-12-08 10:37:50', '2017-12-08 10:37:50', '984.00', '2', '2017-12-05 19:47:15', '0', null, '1', null, '201712081037506552141', '6', '9.84');
INSERT INTO `xyk_plan_detail` VALUES ('3724', '403', '2017-12-08 10:37:50', null, '5900.00', '1', '2017-12-06 17:09:02', '0', null, '1', null, '201712081037502418792', '7', '59.00');
INSERT INTO `xyk_plan_detail` VALUES ('3725', '403', '2017-12-08 10:37:50', '2017-12-08 10:37:50', '2827.00', '2', '2017-12-06 19:53:31', '0', null, '1', null, '201712081037502418792', '8', '28.27');
INSERT INTO `xyk_plan_detail` VALUES ('3726', '403', '2017-12-08 10:37:50', '2017-12-08 10:37:50', '3073.00', '2', '2017-12-06 20:38:48', '0', null, '1', null, '201712081037502418792', '9', '30.73');

-- ----------------------------
-- Table structure for xyk_plan_sys
-- ----------------------------
DROP TABLE IF EXISTS `xyk_plan_sys`;
CREATE TABLE `xyk_plan_sys` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PlanDayTimes` int(11) DEFAULT '2' COMMENT '计划每日还款笔数',
  `TaoTimes` int(11) DEFAULT '2' COMMENT '套现笔数',
  `OpenPlanFeePay` int(11) DEFAULT '0' COMMENT '1 打开计划支付费率 0 关闭计划支付费率',
  `OpenPlanFeeRepay` int(11) DEFAULT '0' COMMENT '1 打开计划还款费率 0 关闭计划还款费率',
  `OpenPlanProfit` int(11) DEFAULT NULL COMMENT '0 关  1开  计划中分销调用',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xyk_plan_sys
-- ----------------------------
INSERT INTO `xyk_plan_sys` VALUES ('1', '2', '2', '1', '1', null);

-- ----------------------------
-- Table structure for xyk_profit
-- ----------------------------
DROP TABLE IF EXISTS `xyk_profit`;
CREATE TABLE `xyk_profit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '获取收益用户',
  `first_user_id` int(11) DEFAULT NULL COMMENT '一级邀请人',
  `second_user_id` int(11) DEFAULT NULL COMMENT '二级邀请人',
  `money` float(11,2) DEFAULT NULL COMMENT '收益金额',
  `time` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT '收益说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xyk_profit
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_refund
-- ----------------------------
DROP TABLE IF EXISTS `xyk_refund`;
CREATE TABLE `xyk_refund` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `OrderNum` varchar(30) NOT NULL COMMENT '交易编号',
  `UserId` int(11) unsigned NOT NULL COMMENT '普通用户Id',
  `RefundAmount` decimal(11,3) DEFAULT '0.000' COMMENT '退款金额',
  `Remark` varchar(255) DEFAULT '' COMMENT '说明',
  `RefundStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '退款是否成功:0失败 1成功',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `ORDERNUM` (`OrderNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='退款表';

-- ----------------------------
-- Records of xyk_refund
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_repay
-- ----------------------------
DROP TABLE IF EXISTS `xyk_repay`;
CREATE TABLE `xyk_repay` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `OrderNum` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Money` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `SerialNum` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BankId` int(11) DEFAULT NULL COMMENT '连接 bankdcard表的 id ',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 等待执行 1  成功  2 失败',
  `FeeType` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手续费付款  PAYER 付款方指用户  RECEIVER 指自己 商户',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xyk_repay
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_rights
-- ----------------------------
DROP TABLE IF EXISTS `xyk_rights`;
CREATE TABLE `xyk_rights` (
  `RightsId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RightsName` varchar(100) DEFAULT NULL,
  `RightsDes` varchar(300) DEFAULT NULL,
  `MarkingId` int(6) unsigned NOT NULL DEFAULT '0',
  `MenuId` int(10) unsigned NOT NULL DEFAULT '0',
  `Addtime` datetime NOT NULL,
  PRIMARY KEY (`RightsId`),
  UNIQUE KEY `MarkingId` (`MarkingId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台权限表';

-- ----------------------------
-- Records of xyk_rights
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_role
-- ----------------------------
DROP TABLE IF EXISTS `xyk_role`;
CREATE TABLE `xyk_role` (
  `RoleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MerchantId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属商户id',
  `RoleName` varchar(30) NOT NULL,
  `RoleDes` varchar(300) NOT NULL,
  `Addtime` datetime NOT NULL,
  PRIMARY KEY (`RoleId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='后台角色表';

-- ----------------------------
-- Records of xyk_role
-- ----------------------------
INSERT INTO `xyk_role` VALUES ('1', '5', '超级管理员', '最高权限', '2017-06-13 09:38:35');
INSERT INTO `xyk_role` VALUES ('2', '5', '财务', '', '2017-06-13 09:39:21');
INSERT INTO `xyk_role` VALUES ('3', '5', '客服', '', '2017-06-13 09:41:51');
INSERT INTO `xyk_role` VALUES ('11', '5', 'aaa', '', '2017-06-13 14:01:46');
INSERT INTO `xyk_role` VALUES ('12', '5', '技术', '查看管理', '2017-06-13 14:08:53');
INSERT INTO `xyk_role` VALUES ('13', '5', '审计员', '数据观察', '2017-06-13 14:09:41');
INSERT INTO `xyk_role` VALUES ('14', '5', '默认角色', '无任何权限', '2017-06-13 14:11:56');
INSERT INTO `xyk_role` VALUES ('20', '5', 'sss', '', '2017-06-19 10:07:30');
INSERT INTO `xyk_role` VALUES ('21', '5', '11', '11', '2017-11-20 20:17:46');
INSERT INTO `xyk_role` VALUES ('22', '5', 'test1', '只有 用户概况 权限', '2017-12-09 14:38:31');

-- ----------------------------
-- Table structure for xyk_rolerightsrelation
-- ----------------------------
DROP TABLE IF EXISTS `xyk_rolerightsrelation`;
CREATE TABLE `xyk_rolerightsrelation` (
  `RelationId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RoleId` int(10) unsigned NOT NULL DEFAULT '0',
  `RightsId` varchar(45) DEFAULT NULL,
  `Addtime` datetime NOT NULL,
  PRIMARY KEY (`RelationId`),
  KEY `I_RoleId` (`RoleId`),
  KEY `I_RightsId` (`RightsId`)
) ENGINE=InnoDB AUTO_INCREMENT=2422 DEFAULT CHARSET=utf8 COMMENT='后台 权限-角色 关联表';

-- ----------------------------
-- Records of xyk_rolerightsrelation
-- ----------------------------
INSERT INTO `xyk_rolerightsrelation` VALUES ('515', '3', '38', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('516', '3', '39', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('517', '3', '46', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('518', '3', '47', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('519', '3', '40', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('520', '3', '48', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('521', '3', '41', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('522', '3', '51', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('523', '3', '74', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('524', '3', '77', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('525', '3', '42', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('526', '3', '53', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('527', '3', '43', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('528', '3', '55', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('529', '3', '82', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('530', '3', '56', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('531', '3', '83', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('532', '3', '44', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('533', '3', '57', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('534', '3', '58', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('535', '3', '84', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('536', '3', '45', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('537', '3', '59', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('538', '3', '60', '2017-06-13 13:30:34');
INSERT INTO `xyk_rolerightsrelation` VALUES ('604', '13', '44', '2017-06-13 14:09:41');
INSERT INTO `xyk_rolerightsrelation` VALUES ('605', '13', '57', '2017-06-13 14:09:41');
INSERT INTO `xyk_rolerightsrelation` VALUES ('606', '13', '58', '2017-06-13 14:09:41');
INSERT INTO `xyk_rolerightsrelation` VALUES ('607', '13', '84', '2017-06-13 14:09:41');
INSERT INTO `xyk_rolerightsrelation` VALUES ('608', '14', '38', '2017-06-13 14:11:56');
INSERT INTO `xyk_rolerightsrelation` VALUES ('798', '11', '41', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('799', '11', '51', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('800', '11', '75', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('801', '11', '76', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('802', '11', '77', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('803', '11', '52', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('804', '11', '42', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('805', '11', '53', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('806', '11', '78', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('807', '11', '79', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('808', '11', '54', '2017-06-19 10:34:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2080', '12', '39', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2081', '12', '46', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2082', '12', '61', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2083', '12', '47', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2084', '12', '62', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2085', '12', '41', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2086', '12', '51', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2087', '12', '74', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2088', '12', '75', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2089', '12', '76', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2090', '12', '77', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2091', '12', '43', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2092', '12', '55', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2093', '12', '82', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2094', '12', '56', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2095', '12', '83', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2096', '12', '95', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2097', '12', '96', '2017-07-11 14:13:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2158', '2', '39', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2159', '2', '46', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2160', '2', '61', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2161', '2', '47', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2162', '2', '62', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2163', '2', '42', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2164', '2', '53', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2165', '2', '100', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2166', '2', '43', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2167', '2', '55', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2168', '2', '82', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2169', '2', '56', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2170', '2', '83', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2171', '2', '44', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2175', '2', '45', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2176', '2', '59', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2177', '2', '60', '2017-07-11 15:21:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2179', '1', '39', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2180', '1', '46', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2181', '1', '61', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2182', '1', '47', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2183', '1', '62', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2184', '1', '40', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2185', '1', '48', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2186', '1', '63', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2187', '1', '64', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2188', '1', '65', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2189', '1', '86', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2190', '1', '49', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2191', '1', '67', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2192', '1', '68', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2193', '1', '69', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2194', '1', '50', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2195', '1', '70', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2196', '1', '71', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2197', '1', '72', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2198', '1', '73', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2199', '1', '41', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2200', '1', '51', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2201', '1', '74', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2202', '1', '75', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2203', '1', '76', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2204', '1', '77', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2205', '1', '52', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2206', '1', '42', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2207', '1', '53', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2208', '1', '78', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2209', '1', '79', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2210', '1', '80', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2211', '1', '81', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2212', '1', '88', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2213', '1', '100', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2214', '1', '54', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2215', '1', '43', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2216', '1', '55', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2217', '1', '82', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2218', '1', '56', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2219', '1', '83', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2220', '1', '44', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2224', '1', '45', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2225', '1', '59', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2226', '1', '60', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2232', '1', '95', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2233', '1', '96', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2234', '1', '98', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2235', '1', '99', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2236', '1', '97', '2017-07-12 11:57:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2284', '20', '39', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2285', '20', '46', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2286', '20', '47', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2287', '20', '40', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2288', '20', '48', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2289', '20', '63', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2290', '20', '64', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2291', '20', '65', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2292', '20', '49', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2293', '20', '67', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2294', '20', '68', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2295', '20', '50', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2296', '20', '70', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2297', '20', '71', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2298', '20', '72', '2017-07-12 17:45:13');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2319', '2', '40', '2017-07-13 13:40:44');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2320', '2', '48', '2017-07-13 13:40:44');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2321', '2', '63', '2017-07-13 13:40:44');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2322', '2', '64', '2017-07-13 13:40:44');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2323', '2', '65', '2017-07-13 13:40:44');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2324', '2', '86', '2017-07-13 13:40:44');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2325', '1', '101', '2017-07-18 16:03:08');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2326', '1', '103', '2017-07-18 17:01:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2327', '12', '103', '2017-07-18 17:13:55');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2328', '12', '99', '2017-07-18 17:16:25');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2334', '12', '98', '2017-07-19 09:50:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2335', '12', '97', '2017-07-19 09:50:37');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2336', '1', '104', '2017-07-19 13:25:50');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2337', '1', '105', '2017-07-19 13:25:50');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2338', '12', '45', '2017-07-25 15:15:03');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2339', '12', '59', '2017-07-25 15:15:03');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2347', '1', '109', '2017-07-25 16:27:15');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2348', '1', '110', '2017-07-25 16:27:15');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2349', '1', '111', '2017-07-25 16:27:15');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2350', '1', '112', '2017-07-25 16:27:15');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2351', '1', '113', '2017-07-19 13:21:56');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2352', '1', '114', '2017-07-19 13:21:56');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2353', '1', '115', '2017-07-19 13:21:56');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2354', '1', '116', '2017-07-19 13:21:56');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2355', '2', '113', '2017-07-26 15:32:05');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2356', '2', '114', '2017-07-26 15:34:00');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2357', '2', '115', '2017-07-26 15:34:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2358', '2', '116', '2017-07-26 15:34:30');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2359', '1', '117', '2017-07-19 13:21:56');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2364', '12', '109', '2017-07-27 09:23:46');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2369', '12', '110', '2017-07-27 09:46:40');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2370', '12', '111', '2017-07-27 09:46:40');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2371', '12', '112', '2017-07-27 09:46:40');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2372', '1', '118', '2017-08-11 14:00:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2373', '1', '119', '2017-08-11 14:00:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2374', '1', '120', '2017-08-11 14:00:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2375', '1', '121', '2017-08-11 14:00:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2376', '1', '122', '2017-08-11 14:00:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2377', '1', '123', '2017-08-11 14:00:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2378', '1', '124', '2017-08-11 14:00:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2379', '1', '125', '2017-08-11 14:40:42');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2380', '1', '126', '2017-08-11 14:40:42');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2381', '1', '127', '2017-08-11 14:40:42');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2382', '1', '128', '2017-08-11 14:40:42');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2383', '20', '118', '2017-08-11 17:20:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2384', '20', '119', '2017-08-11 17:20:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2385', '20', '123', '2017-08-11 17:20:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2386', '20', '124', '2017-08-11 17:20:24');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2387', '20', '120', '2017-08-11 17:23:47');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2388', '20', '121', '2017-08-11 17:23:47');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2389', '20', '122', '2017-08-11 17:23:47');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2390', '20', '125', '2017-08-11 17:24:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2391', '20', '126', '2017-08-11 17:24:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2392', '20', '127', '2017-08-11 17:24:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2393', '20', '128', '2017-08-11 17:24:04');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2394', '1', '129', '2017-08-25 16:09:32');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2395', '1', '130', '2017-10-23 17:35:21');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2396', '1', '131', '2017-10-23 17:35:21');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2397', '1', '132', '2017-10-23 17:35:21');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2398', '1', '133', '2017-10-23 17:35:21');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2399', '1', '134', '2017-10-23 17:35:21');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2400', '12', '42', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2401', '12', '53', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2402', '12', '78', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2403', '12', '79', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2404', '12', '80', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2405', '12', '81', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2406', '12', '88', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2407', '12', '100', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2408', '12', '101', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2409', '12', '117', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2410', '12', '129', '2017-10-23 17:36:59');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2411', '12', '130', '2017-10-23 17:37:11');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2412', '21', '39', '2017-11-20 20:17:46');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2413', '21', '46', '2017-11-20 20:17:46');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2414', '21', '61', '2017-11-20 20:17:46');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2415', '21', '47', '2017-11-20 20:17:46');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2416', '21', '62', '2017-11-20 20:17:46');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2417', '22', '39', '2017-12-09 14:38:31');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2418', '22', '46', '2017-12-09 14:38:31');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2419', '22', '61', '2017-12-09 14:38:31');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2420', '22', '47', '2017-12-09 14:38:31');
INSERT INTO `xyk_rolerightsrelation` VALUES ('2421', '22', '62', '2017-12-09 14:38:31');

-- ----------------------------
-- Table structure for xyk_sessions
-- ----------------------------
DROP TABLE IF EXISTS `xyk_sessions`;
CREATE TABLE `xyk_sessions` (
  `SessionId` varchar(32) NOT NULL,
  `UserId` int(10) unsigned NOT NULL DEFAULT '0',
  `Ip` varchar(100) DEFAULT NULL,
  `LastVisit` int(10) unsigned NOT NULL DEFAULT '0',
  `Expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `SessionData` varchar(500) NOT NULL,
  PRIMARY KEY (`SessionId`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 COMMENT='session表';

-- ----------------------------
-- Records of xyk_sessions
-- ----------------------------
INSERT INTO `xyk_sessions` VALUES ('v001n0dpjurd84knakqpvvdt63', '0', '127.0.0.1', '1513066627', '1513068067', '');
INSERT INTO `xyk_sessions` VALUES ('iph6el531ftos828maoh535n01', '0', '127.0.0.1', '1513066627', '1513068067', 'DEMOCODE|s:4:\"VHxT\";');
INSERT INTO `xyk_sessions` VALUES ('945dljegl7o7t8eo9ki5aqq6a0', '0', '127.0.0.1', '1513066628', '1513068068', '');
INSERT INTO `xyk_sessions` VALUES ('t3418d7sg089oet1kpdf1kuds5', '0', '127.0.0.1', '1513066628', '1513068068', 'DEMOCODE|s:4:\"uwDk\";');
INSERT INTO `xyk_sessions` VALUES ('8k9t0isu1phht90fm0f2nvidf7', '0', '127.0.0.1', '1513066628', '1513068068', '');
INSERT INTO `xyk_sessions` VALUES ('7rfupbkke4us3lp2h5bei183j3', '0', '127.0.0.1', '1513066628', '1513068068', 'DEMOCODE|s:4:\"K71r\";');
INSERT INTO `xyk_sessions` VALUES ('jshbiat1qrg77ohm494hfhl803', '0', '127.0.0.1', '1513066629', '1513068069', '');
INSERT INTO `xyk_sessions` VALUES ('r6fhsoviff7285eaf6bad3qde1', '0', '127.0.0.1', '1513066629', '1513068069', 'DEMOCODE|s:4:\"yjbM\";');
INSERT INTO `xyk_sessions` VALUES ('9fgbjbr68jbqvmno26dl8t3sl3', '0', '127.0.0.1', '1513066629', '1513068069', '');
INSERT INTO `xyk_sessions` VALUES ('84nkk8ir4vcjtp79ai9vagmu91', '0', '127.0.0.1', '1513066629', '1513068069', 'DEMOCODE|s:4:\"HXa9\";');
INSERT INTO `xyk_sessions` VALUES ('pinflor74ptlm021qjplr66960', '0', '127.0.0.1', '1513066630', '1513068070', '');
INSERT INTO `xyk_sessions` VALUES ('ficujebs82capdghgb53opbk03', '0', '127.0.0.1', '1513066630', '1513068070', 'DEMOCODE|s:4:\"j8GR\";');
INSERT INTO `xyk_sessions` VALUES ('ln0h69m0u8qkh9n5pqbpqqspu4', '0', '127.0.0.1', '1513066630', '1513068070', '');
INSERT INTO `xyk_sessions` VALUES ('8i75h9c380ls6aq2jr3kadt053', '0', '127.0.0.1', '1513066630', '1513068070', 'DEMOCODE|s:4:\"wCJ3\";');
INSERT INTO `xyk_sessions` VALUES ('hgk7cpo9pv0cqnoilkq97v2ct0', '0', '127.0.0.1', '1513066630', '1513068070', '');
INSERT INTO `xyk_sessions` VALUES ('c0lpqsjct26j8farfbod3j5e16', '0', '127.0.0.1', '1513066630', '1513068070', 'DEMOCODE|s:4:\"GbNU\";');
INSERT INTO `xyk_sessions` VALUES ('9rcq11stl78a72f9ep1e2ti703', '0', '127.0.0.1', '1513066637', '1513068077', '');
INSERT INTO `xyk_sessions` VALUES ('ie81nanmhjn42dldrbgn0m9q80', '0', '127.0.0.1', '1513066637', '1513068077', 'DEMOCODE|s:4:\"rw4M\";');
INSERT INTO `xyk_sessions` VALUES ('n368mg357bdgphcl5opedb69b1', '0', '127.0.0.1', '1513066641', '1513068081', '');
INSERT INTO `xyk_sessions` VALUES ('3cgtri6e710md7d7e6434c9j73', '0', '127.0.0.1', '1513066641', '1513068081', 'DEMOCODE|s:4:\"UDyj\";');
INSERT INTO `xyk_sessions` VALUES ('tavhmk3f00jdlutokspuid7am5', '0', '127.0.0.1', '1513072625', '1513074065', 'DEMOCODE|s:4:\"fSrF\";BACKUSERID|s:1:\"1\";');
INSERT INTO `xyk_sessions` VALUES ('10p1vmjhro9tbq4d2mkj3s5l66', '0', '127.0.0.1', '1513063340', '1513064780', '');
INSERT INTO `xyk_sessions` VALUES ('eluv4tj122aj505492f7ho4cc1', '0', '127.0.0.1', '1513063342', '1513064782', '');
INSERT INTO `xyk_sessions` VALUES ('6uith4ulpogu7c5snnjk76mlm5', '0', '127.0.0.1', '1513063345', '1513064785', 'DEMOCODE|s:4:\"5KY5\";');
INSERT INTO `xyk_sessions` VALUES ('jmbeoqhng0v7voupnlijif5ql7', '0', '127.0.0.1', '1513063858', '1513065298', '');
INSERT INTO `xyk_sessions` VALUES ('ssp02kmvk2o03s2a20fntdstr7', '0', '127.0.0.1', '1513063860', '1513065300', 'DEMOCODE|s:4:\"CDJU\";');
INSERT INTO `xyk_sessions` VALUES ('lvl2egsjs2p7c0vts981sirpd2', '0', '127.0.0.1', '1513063864', '1513065304', '');
INSERT INTO `xyk_sessions` VALUES ('87as7vmv57esubfqbe4ofl9tf2', '0', '127.0.0.1', '1513063866', '1513065306', 'DEMOCODE|s:4:\"btny\";');
INSERT INTO `xyk_sessions` VALUES ('55lsuua1vjnqavofe5h68mplq2', '0', '127.0.0.1', '1513063869', '1513065309', '');
INSERT INTO `xyk_sessions` VALUES ('o63qbs9gau8bisg1m7ungv5oe5', '0', '127.0.0.1', '1513063871', '1513065311', 'DEMOCODE|s:4:\"PKc8\";');
INSERT INTO `xyk_sessions` VALUES ('f8c9ji4qlreob3jt8tljt5h697', '0', '127.0.0.1', '1513063871', '1513065311', '');
INSERT INTO `xyk_sessions` VALUES ('ft2o7jqcc2chqll35oq4ftf4g0', '0', '127.0.0.1', '1513063873', '1513065313', '');
INSERT INTO `xyk_sessions` VALUES ('86jepcf3rfs6gpqghj97n6fuh7', '0', '127.0.0.1', '1513063873', '1513065313', 'DEMOCODE|s:4:\"qgk7\";');
INSERT INTO `xyk_sessions` VALUES ('gf1jii526uti8g45u81am71hu0', '0', '127.0.0.1', '1513063875', '1513065315', 'DEMOCODE|s:4:\"Cpef\";');
INSERT INTO `xyk_sessions` VALUES ('b4nt8gdeeldno54cspoe1nbjn7', '0', '127.0.0.1', '1513063879', '1513065319', '');
INSERT INTO `xyk_sessions` VALUES ('koi04bq0jfjp1od486bjgj7sg5', '0', '127.0.0.1', '1513063882', '1513065322', 'DEMOCODE|s:4:\"Dbhm\";');
INSERT INTO `xyk_sessions` VALUES ('mu6c4f9531cgp2n5krd6aa4bc7', '0', '127.0.0.1', '1513063881', '1513065321', 'DEMOCODE|s:4:\"6WH8\";');

-- ----------------------------
-- Table structure for xyk_sms
-- ----------------------------
DROP TABLE IF EXISTS `xyk_sms`;
CREATE TABLE `xyk_sms` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Mobile` varchar(30) NOT NULL COMMENT '接收短信的手机号码',
  `SmsType` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '短信类型(登录验证码、电子票转增.参考字典)',
  `SmsPlatform` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '短信平台(阿里大于 沃动等.参考字典,默认阿里大于)',
  `TemplateId` varchar(50) DEFAULT NULL COMMENT '模板Id',
  `SmsParam` varchar(255) DEFAULT '' COMMENT '短信参数,json格式存放',
  `BackId` varchar(50) DEFAULT '' COMMENT '短信接口返回ID',
  `Content` varchar(255) DEFAULT '' COMMENT '实际发送的短信内容',
  `AddTime` int(11) unsigned DEFAULT '0' COMMENT '添加时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `SMS_MOBILE` (`Mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=529 DEFAULT CHARSET=utf8 COMMENT='短信发送记录';

-- ----------------------------
-- Records of xyk_sms
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_smsbasictemplates
-- ----------------------------
DROP TABLE IF EXISTS `xyk_smsbasictemplates`;
CREATE TABLE `xyk_smsbasictemplates` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '短信模板名称',
  `SmsType` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '短信类型(绑定微信公众好验证码、电子票转增等.参考字典)',
  `ParamKey` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT '短信模板变量，多个用逗号隔开',
  `SmsTemplate` varchar(500) CHARACTER SET utf8 DEFAULT '' COMMENT '短信模板内容',
  `TemplateId` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '模板Id',
  `Isvalid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1有效 0无效',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '数据添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '数据更新时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of xyk_smsbasictemplates
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_smsparam
-- ----------------------------
DROP TABLE IF EXISTS `xyk_smsparam`;
CREATE TABLE `xyk_smsparam` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `SmsType` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '短信类型(绑定微信公众好验证码、电子票转增等.参考字典)',
  `ParamCn` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '变量中文名',
  `ParamEn` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '变量名(英文)',
  `Required` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必须(0:非必须 1必须)',
  `Isvalid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0无效  1有效',
  `AddTime` int(10) unsigned DEFAULT NULL COMMENT '数据添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '数据更新时间',
  PRIMARY KEY (`Id`),
  KEY `KEY_SMSTYPE` (`SmsType`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of xyk_smsparam
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_smstemplates
-- ----------------------------
DROP TABLE IF EXISTS `xyk_smstemplates`;
CREATE TABLE `xyk_smstemplates` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT '' COMMENT '模板名称',
  `TemplateId` varchar(50) DEFAULT NULL COMMENT '模板Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `SmsType` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '短信类型(登录验证码、电子票转增.参考字典)',
  `ParamKey` varchar(255) DEFAULT '' COMMENT '短信模板变量，多个用逗号隔开,和短信队列表的ParamValue组成一对',
  `SmsTemplate` varchar(500) DEFAULT '' COMMENT '短信模板内容',
  `Isvalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否有效(0无效 1有效) 同一个类型的，只能有一个有效',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `UpdateTime` int(10) unsigned DEFAULT '0' COMMENT '修改时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='短信模板';

-- ----------------------------
-- Records of xyk_smstemplates
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_sys
-- ----------------------------
DROP TABLE IF EXISTS `xyk_sys`;
CREATE TABLE `xyk_sys` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `mac` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mac地址',
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xyk_sys
-- ----------------------------
INSERT INTO `xyk_sys` VALUES ('1', '00-50-56-C0-00-08', '127.0.0.1', 'api.dev');

-- ----------------------------
-- Table structure for xyk_userbindccard
-- ----------------------------
DROP TABLE IF EXISTS `xyk_userbindccard`;
CREATE TABLE `xyk_userbindccard` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '银行卡ID',
  `BankId` varchar(50) DEFAULT '0' COMMENT '银行卡id',
  `UserId` int(11) unsigned NOT NULL COMMENT '用户id',
  `BankName` varchar(100) DEFAULT NULL COMMENT '银行卡名称',
  `BankNumber` varchar(50) NOT NULL DEFAULT '0' COMMENT '银行卡号',
  `IsDefault` tinyint(1) DEFAULT '0' COMMENT '是否默认（1|默认，0|不默认）',
  `status` int(11) DEFAULT '0' COMMENT '状态; 0|正常 ； 1|冻结',
  `AddTime` int(50) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='用户绑定的银行卡';

-- ----------------------------
-- Records of xyk_userbindccard
-- ----------------------------
INSERT INTO `xyk_userbindccard` VALUES ('6', '8a6019b556ad4cf7a79a61d388989a68', '81', '中信银行', '6217710804856110', '0', '1', '1512121593');
INSERT INTO `xyk_userbindccard` VALUES ('8', '54a53654de5b411aa9f6d7dc7d630891', '81', '农业银行', '6228480470768361318', '0', '0', '1513080763');

-- ----------------------------
-- Table structure for xyk_userbinddcard
-- ----------------------------
DROP TABLE IF EXISTS `xyk_userbinddcard`;
CREATE TABLE `xyk_userbinddcard` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '银行卡ID',
  `CreditId` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '交易卡id',
  `UserId` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `CreditName` varchar(100) DEFAULT NULL COMMENT '信用卡名称',
  `CreditNumber` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '信用卡号',
  `status` int(11) unsigned DEFAULT '0' COMMENT '状态; 0|正常 ； 1|冻结  2|解绑',
  `IsDefault` tinyint(1) unsigned DEFAULT '0' COMMENT '是否默认（1|默认；0|不默认）',
  `AddTime` int(50) DEFAULT '0',
  `CVN` int(10) unsigned DEFAULT NULL COMMENT 'SVN2码',
  `Quota` decimal(10,2) unsigned DEFAULT NULL COMMENT '信用卡额度',
  `AccountDate` datetime DEFAULT NULL COMMENT '账号日',
  `RepaymentDate` datetime DEFAULT NULL COMMENT '还款日',
  `Type` int(11) DEFAULT NULL COMMENT '1 借记卡 2 贷记卡',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='用户绑定的信用卡';

-- ----------------------------
-- Records of xyk_userbinddcard
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_userblacklist
-- ----------------------------
DROP TABLE IF EXISTS `xyk_userblacklist`;
CREATE TABLE `xyk_userblacklist` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `UserId` int(11) unsigned NOT NULL COMMENT '用户Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `Mobile` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '手机号码',
  `Isvalid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '数据是否有效(1:禁止购票启用 0:禁止购票关闭)',
  `AddTime` int(10) unsigned DEFAULT NULL COMMENT '数据添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '数据更新时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of xyk_userblacklist
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_usercontact
-- ----------------------------
DROP TABLE IF EXISTS `xyk_usercontact`;
CREATE TABLE `xyk_usercontact` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `UserId` int(11) unsigned NOT NULL COMMENT '用户Id',
  `MerchantId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户Id(建议插入数据的时候填上此值)',
  `Contact` varchar(50) NOT NULL COMMENT '联系人姓名',
  `CertType` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '证件类型(参考字典)',
  `CertNo` varchar(50) NOT NULL COMMENT '证件号码',
  `Isvalid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效',
  `IsActivated` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已激活(初期程序插入数据填已激活，以后可能是默认未激活，需要认证通过后置为已激活)',
  `AddTime` int(10) unsigned DEFAULT NULL COMMENT '数据添加时间',
  `UpdateTime` int(10) unsigned DEFAULT NULL COMMENT '数据更新时间',
  `Ext1` varchar(255) DEFAULT NULL,
  `Ext2` varchar(255) DEFAULT NULL,
  `Ext3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `CONTACT_KEY_USERID` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COMMENT='购票实名认证常用联系人表';

-- ----------------------------
-- Records of xyk_usercontact
-- ----------------------------
INSERT INTO `xyk_usercontact` VALUES ('111', '81', '0', '王波', '1', '500226199404090334', '1', '1', '1513067393', '1513067393', null, null, null);
INSERT INTO `xyk_usercontact` VALUES ('114', '83', '0', '陈子介', '1', '210202198910115915', '1', '1', '1513068848', '1513068848', null, null, null);

-- ----------------------------
-- Table structure for xyk_userrolerelation
-- ----------------------------
DROP TABLE IF EXISTS `xyk_userrolerelation`;
CREATE TABLE `xyk_userrolerelation` (
  `UserrelationId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RoleId` int(10) unsigned NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Addtime` datetime NOT NULL,
  PRIMARY KEY (`UserrelationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台 用户-角色 关联表';

-- ----------------------------
-- Records of xyk_userrolerelation
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_users
-- ----------------------------
DROP TABLE IF EXISTS `xyk_users`;
CREATE TABLE `xyk_users` (
  `UserId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `MerchantId` int(11) unsigned DEFAULT '0' COMMENT '代理商ID',
  `Mobile` varchar(20) DEFAULT NULL COMMENT '手机号（作为登录用户名）',
  `Password` varchar(32) DEFAULT '' COMMENT '密码',
  `PayPassword` varchar(32) DEFAULT '' COMMENT '支付密码',
  `Email` varchar(80) DEFAULT '' COMMENT '邮箱',
  `Username` varchar(50) DEFAULT NULL COMMENT '用户名、昵称',
  `UserAvatar` varchar(200) DEFAULT NULL,
  `Account` decimal(10,2) DEFAULT '0.00' COMMENT '账户余额',
  `bindBankId` varchar(255) DEFAULT '0' COMMENT '绑定的银行卡id，多个用,号隔开。',
  `IP` varchar(30) DEFAULT '' COMMENT '用户注册IP',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '帐号状态(0.相当于未激活 1.正常 2.禁用)',
  `AreaId` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '区域Id,参见字典',
  `InviteOne` int(11) unsigned DEFAULT '0' COMMENT '一级会员',
  `InviteTwo` int(11) unsigned DEFAULT '0' COMMENT '二级会员',
  `InviteThree` int(11) unsigned DEFAULT '0' COMMENT '三级会员',
  `InviterId` int(11) unsigned DEFAULT '0' COMMENT '邀请人ID',
  `BankId` varchar(100) DEFAULT NULL COMMENT '银行卡id,多个用，号分割',
  `CreditId` varchar(100) DEFAULT NULL COMMENT '信用卡id,多个用，号分割',
  `invcode` varchar(50) DEFAULT NULL COMMENT '邀请码',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `IDCard` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '身份证号码',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UK_USERS_MOBILE` (`Mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COMMENT='普通用户表';

-- ----------------------------
-- Records of xyk_users
-- ----------------------------
INSERT INTO `xyk_users` VALUES ('81', '0', '15178889347', '96bdf4f97e473adff48bf632d2f9693d', '', '', '王波', null, '0.00', '0', '', '1', '10001', '0', '0', '0', '0', null, null, null, '1512965796', null, null, null, null, '1513076813303T4FSD82');
INSERT INTO `xyk_users` VALUES ('83', '0', '13889544242', '7fa8282ad93047a4d6fe6111c93b308a', '', '', '陈子介', 'http://47.96.129.71/upload/user/201712121732525a2fa24417108.jpg', '0.00', '0', '', '1', '10001', '0', '0', '0', '0', null, null, null, '1513057562', null, null, null, null, '15130688735HVDGBAB83');

-- ----------------------------
-- Table structure for xyk_usertickets
-- ----------------------------
DROP TABLE IF EXISTS `xyk_usertickets`;
CREATE TABLE `xyk_usertickets` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '票Id',
  `UserId` int(11) unsigned NOT NULL COMMENT '普通用户Id',
  `MerchantId` int(11) unsigned NOT NULL COMMENT '商户Id',
  `VenueId` int(11) unsigned NOT NULL COMMENT '场馆Id',
  `VenueHallId` int(11) unsigned NOT NULL COMMENT '演出厅(区)Id',
  `OrderNum` varchar(30) DEFAULT '' COMMENT '订单号',
  `TicketNo` varchar(30) NOT NULL COMMENT '电子票编号',
  `ShowId` int(11) unsigned DEFAULT NULL COMMENT '演出Id',
  `ShowName` varchar(255) NOT NULL COMMENT '演出名称',
  `SeatId` int(11) DEFAULT '0' COMMENT '座位表关联id',
  `Seat` varchar(50) DEFAULT '' COMMENT '座位信息',
  `Cid` int(11) DEFAULT '0' COMMENT '票分类',
  `StartTime` int(10) unsigned DEFAULT '0' COMMENT '演出开始时间（时间戳格式）',
  `EndTime` int(10) unsigned DEFAULT '0' COMMENT '演出结束时间（时间戳格式）',
  `Amount` decimal(11,3) DEFAULT '0.000' COMMENT '票价',
  `ParValue` decimal(11,3) unsigned DEFAULT '0.000' COMMENT '票面价格',
  `Transferable` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '可转赠次数',
  `TicketFrom` varchar(20) DEFAULT NULL COMMENT '赠送方(手机号)',
  `TicketTo` varchar(20) DEFAULT NULL COMMENT '受赠方(手机号)',
  `Status` smallint(5) unsigned NOT NULL DEFAULT '10001' COMMENT '票状态（参考字典）',
  `Active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否激活(0未激活 1已激活)',
  `SysGive` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '通过后台赠予的票(0:否 1:是)',
  `TransferTime` int(10) unsigned DEFAULT '0' COMMENT '转出时间',
  `UseTime` int(10) unsigned DEFAULT '0' COMMENT '使用时间',
  `ContactId` int(10) unsigned DEFAULT '0' COMMENT '实名认证联系人表中的Id',
  `Contact` varchar(50) DEFAULT NULL COMMENT '实名认证购票-姓名',
  `CertType` smallint(5) unsigned DEFAULT NULL COMMENT '实名认证购票-证件类型(参考字典)',
  `CertNo` varchar(50) DEFAULT NULL COMMENT '实名认证购票-证件号码',
  `TicketType` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '票类型：1电子票 2纸票',
  `Printed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已打印(0未打印 1已打印[电子票一直为0])',
  `TicketCode` varchar(64) DEFAULT '' COMMENT '纸票识别码',
  `AddTime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `Ext1` varchar(50) DEFAULT NULL,
  `Ext2` varchar(50) DEFAULT NULL,
  `Ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `UTSTATUS` (`Status`),
  KEY `UTMERCHANTID` (`MerchantId`),
  KEY `UT_SID_CTYPE_CNO` (`ShowId`,`CertType`,`CertNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户票表';

-- ----------------------------
-- Records of xyk_usertickets
-- ----------------------------

-- ----------------------------
-- Table structure for xyk_verify
-- ----------------------------
DROP TABLE IF EXISTS `xyk_verify`;
CREATE TABLE `xyk_verify` (
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号',
  `code` varchar(6) DEFAULT NULL COMMENT '验证码',
  `time` int(11) DEFAULT NULL COMMENT '过期时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xyk_verify
-- ----------------------------
INSERT INTO `xyk_verify` VALUES ('13889544242', '211143', '1513057762');
INSERT INTO `xyk_verify` VALUES ('13889544242', '993792', '1513059394');
INSERT INTO `xyk_verify` VALUES ('13889544242', '201687', '1513059474');
