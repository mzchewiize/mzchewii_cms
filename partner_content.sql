/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : wizcationc

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2015-12-23 16:07:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for partner_content
-- ----------------------------
DROP TABLE IF EXISTS `partner_content`;
CREATE TABLE `partner_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content_subject` varchar(255) DEFAULT NULL,
  `content_hilight` text,
  `content_detail` text,
  `content_address` text,
  `content_price` int(100) DEFAULT NULL,
  `content_discount` int(100) DEFAULT NULL,
  `content_website` varchar(200) DEFAULT NULL,
  `created` varchar(100) DEFAULT NULL,
  `content_status` int(10) DEFAULT NULL,
  `content_type` int(11) DEFAULT NULL,
  `property_code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
