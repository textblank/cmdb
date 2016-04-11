/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50622
Source Host           : localhost:3306
Source Database       : cmdb

Target Server Type    : MYSQL
Target Server Version : 50622
File Encoding         : 65001

Date: 2015-11-02 16:29:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for askforresource
-- ----------------------------
DROP TABLE IF EXISTS `askforresource`;
CREATE TABLE `askforresource` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `product` varchar(32) DEFAULT '' COMMENT '产品',
  `module` varchar(32) DEFAULT '' COMMENT '模块',
  `owner` varchar(32) DEFAULT '' COMMENT '接口人',
  `purpose` text COMMENT '用途',
  `os` varchar(32) DEFAULT 'linux' COMMENT '操作系统',
  `osver` varchar(32) DEFAULT 'centos6.5' COMMENT '系统版本',
  `machineType` tinyint(3) unsigned DEFAULT '2' COMMENT '机器类型 1 实机 2 虚机',
  `num` int(11) unsigned DEFAULT '1' COMMENT '数量',
  `cpu` int(11) unsigned DEFAULT '1' COMMENT 'cpu(核)',
  `mem` int(11) unsigned DEFAULT '4' COMMENT '内存(GB)',
  `sysdisk` int(11) unsigned DEFAULT '50' COMMENT '系统盘(GB)',
  `userdisk` int(11) unsigned DEFAULT '200' COMMENT '数据盘(GB)',
  `insideBandwidth` int(11) unsigned DEFAULT '200' COMMENT '内网带宽(Mb)',
  `outsideBandwidth` int(11) unsigned zerofill DEFAULT '00000000000' COMMENT '外网带宽(Mb)',
  `expectDate` date DEFAULT NULL COMMENT '期望交付日期',
  `explan` text COMMENT '资源使用说明',
  `memo` varchar(256) DEFAULT '' COMMENT '备注',
  `status` tinyint(3) unsigned DEFAULT '1' COMMENT '状态 1 审核中 2 交付中 3 已交付',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hostnametag
-- ----------------------------
DROP TABLE IF EXISTS `hostnametag`;
CREATE TABLE `hostnametag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hostname` varchar(128) NOT NULL DEFAULT '',
  `tag` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for machine
-- ----------------------------
DROP TABLE IF EXISTS `machine`;
CREATE TABLE `machine` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '服务器ID',
  `hostname` varchar(128) NOT NULL DEFAULT '' COMMENT 'hostname',
  `assetId` varchar(16) DEFAULT NULL COMMENT '固资编号',
  `busi1Id` varchar(128) DEFAULT '' COMMENT '一级业务',
  `idc` varchar(32) DEFAULT '' COMMENT '机房',
  `machineClass` varchar(32) DEFAULT '' COMMENT '机型',
  `machineType` tinyint(3) DEFAULT '1' COMMENT '1:实机,2:虚机',
  `entityHostname` varchar(128) DEFAULT '0' COMMENT '宿主机',
  `ip1` varchar(15) DEFAULT '' COMMENT 'ip1',
  `ip2` varchar(15) DEFAULT '' COMMENT 'ip2',
  `ip3` varchar(15) DEFAULT '' COMMENT 'ip3',
  `ip4` varchar(15) DEFAULT '' COMMENT 'ip4',
  `ip5` varchar(15) DEFAULT '' COMMENT 'ip5',
  `ip6` varchar(15) DEFAULT '',
  `ip7` varchar(15) DEFAULT '',
  `opAdmin` varchar(128) DEFAULT NULL COMMENT 'ops',
  `devAdmin` varchar(128) DEFAULT NULL,
  `shelf` varchar(32) DEFAULT '' COMMENT '机架',
  `onShelfTime` date DEFAULT NULL COMMENT '上架时间',
  `switchIp1` varchar(15) DEFAULT '',
  `switchPort1` varchar(6) DEFAULT '',
  `switchIp2` varchar(15) DEFAULT '',
  `switchPort2` varchar(6) DEFAULT '',
  `swichIp3` varchar(15) DEFAULT '',
  `switchPort3` varchar(6) DEFAULT '',
  `switchIp4` varchar(15) DEFAULT '',
  `switchPort4` varchar(6) DEFAULT '',
  `switchIp5` varchar(15) DEFAULT '',
  `switchPort5` varchar(6) DEFAULT '',
  `switch6` varchar(15) DEFAULT '',
  `switchPort6` varchar(6) DEFAULT '',
  `switchIp7` varchar(15) DEFAULT '',
  `switchPort7` varchar(6) DEFAULT NULL,
  `networkOperator` varchar(16) DEFAULT NULL COMMENT '运营商',
  `currentStatus` tinyint(4) DEFAULT NULL COMMENT '状态',
  `importantLevel` tinyint(4) DEFAULT NULL COMMENT '重要级别',
  `osName` varchar(64) DEFAULT NULL,
  `raid` varchar(16) DEFAULT NULL,
  `speed7` varchar(128) DEFAULT '',
  `speed6` varchar(128) DEFAULT '',
  `speed5` varchar(128) DEFAULT '',
  `speed4` varchar(128) DEFAULT '',
  `speed3` varchar(128) DEFAULT '',
  `speed2` varchar(128) DEFAULT '',
  `speed1` varchar(128) DEFAULT '',
  `gateway7` varchar(128) DEFAULT '',
  `gateway6` varchar(128) DEFAULT '',
  `gateway5` varchar(128) DEFAULT '',
  `gateway4` varchar(128) DEFAULT '',
  `gateway3` varchar(128) DEFAULT '',
  `gateway2` varchar(128) DEFAULT '',
  `gateway1` varchar(128) DEFAULT '',
  `netmask7` varchar(128) DEFAULT '',
  `netmask6` varchar(128) DEFAULT '',
  `netmask5` varchar(128) DEFAULT '',
  `netmask4` varchar(128) DEFAULT '',
  `netmask3` varchar(128) DEFAULT '',
  `netmask2` varchar(128) DEFAULT '',
  `netmask1` varchar(128) DEFAULT '',
  `mac7` varchar(128) DEFAULT '',
  `mac6` varchar(128) DEFAULT '',
  `mac5` varchar(128) DEFAULT '',
  `mac4` varchar(128) DEFAULT '',
  `mac3` varchar(128) DEFAULT '',
  `mac2` varchar(128) DEFAULT '',
  `mac1` varchar(128) DEFAULT '',
  `ethernet7` varchar(128) DEFAULT '',
  `ethernet6` varchar(128) DEFAULT '',
  `ethernet5` varchar(128) DEFAULT '',
  `ethernet4` varchar(128) DEFAULT '',
  `ethernet3` varchar(128) DEFAULT '',
  `ethernet2` varchar(128) DEFAULT '',
  `ethernet1` varchar(128) DEFAULT '',
  `memorySize` varchar(128) DEFAULT '' COMMENT '内存',
  `diskSize` varchar(256) DEFAULT '',
  `disks` varchar(512) DEFAULT '',
  `uuid` varchar(128) DEFAULT '',
  `serialNumber` varchar(128) DEFAULT '',
  `productName` varchar(128) DEFAULT '' COMMENT '产品',
  `manufacturer` varchar(128) DEFAULT '',
  `vender` varchar(128) DEFAULT '',
  `cpuHz` varchar(128) DEFAULT '',
  `cpuInfo` varchar(256) DEFAULT '',
  `cpuNum` tinyint(3) unsigned DEFAULT '0',
  `price` varchar(32) DEFAULT '',
  `buyDate` date DEFAULT NULL,
  `majorService` varchar(256) DEFAULT '' COMMENT '主服务',
  `memo` varchar(256) DEFAULT '' COMMENT '备注',
  `hwInfoReportTime` datetime DEFAULT NULL,
  `lastModify` datetime DEFAULT NULL,
  `switchBoard1` varchar(32) DEFAULT '',
  `switchBoard2` varchar(32) DEFAULT '',
  `switchBoard3` varchar(32) DEFAULT '',
  `switchBoard4` varchar(32) DEFAULT '',
  `switchBoard5` varchar(32) DEFAULT '',
  `switchBoard6` varchar(32) DEFAULT '',
  `switchBoard7` varchar(32) DEFAULT '',
  `needMonitor` tinyint(3) DEFAULT '1' COMMENT '需监控？',
  `shelfPlace` varchar(32) DEFAULT '' COMMENT '机位',
  `maintenancePeriod` date DEFAULT NULL COMMENT '保修期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hostname` (`hostname`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
