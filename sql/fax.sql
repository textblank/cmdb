/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50709
 Source Host           : localhost
 Source Database       : pms

 Target Server Type    : MySQL
 Target Server Version : 50709
 File Encoding         : utf-8

 Date: 04/13/2016 10:52:45 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `fax`
-- ----------------------------
DROP TABLE IF EXISTS `fax`;
CREATE TABLE `fax` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sn` varchar(32) NOT NULL DEFAULT '' COMMENT '传真编号',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '主题',
  `content` text NOT NULL COMMENT '内容',
  `project_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属项目',
  `company_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属公司',
  `major_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '专业',
  `to_company_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '致公司id',
  `to_company_title` varchar(64) NOT NULL DEFAULT '' COMMENT '致',
  `attention` varchar(32) NOT NULL DEFAULT '' COMMENT '呈交',
  `fax_no` varchar(32) NOT NULL DEFAULT '' COMMENT '传真',
  `page` varchar(32) NOT NULL DEFAULT '' COMMENT '页数',
  `auditor_id` varchar(32) NOT NULL DEFAULT '' COMMENT '审核人',
  `signer_id` varchar(32) NOT NULL DEFAULT '' COMMENT '签发人',
  `send` varchar(32) NOT NULL DEFAULT '' COMMENT '敬送',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT '类型 1 紧急 请审阅 请批注 请答复 请传阅',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态：0-登记 1-审核中 2-已通过 3-未通过',
  `creator` varchar(32) NOT NULL DEFAULT '' COMMENT '创建人',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `on_use` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '在用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `fax`
-- ----------------------------
BEGIN;
INSERT INTO `fax` VALUES ('1', 'ZH[2016]-0001', '新建传真', '<p>111111111111111111111111111111</p>', '43', '11', '11', '12', '', '呈交', '111', '1', '101', '101', '', '1', '2', 'zs', '2016-03-20 08:50:54', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
