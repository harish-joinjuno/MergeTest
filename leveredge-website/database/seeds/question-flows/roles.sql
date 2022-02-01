/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : leveredge

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 29/01/2021 20:30:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'borrower', 'Potential Borrower', '2019-05-21 14:20:41', '2019-05-21 14:20:41', 4);
INSERT INTO `roles` VALUES (2, 'lender', 'Potential Partner Lender', '2019-05-21 14:20:41', '2019-05-21 14:20:41', 3);
INSERT INTO `roles` VALUES (3, 'admin', 'Administrator', '2019-05-21 14:20:41', '2019-05-21 14:20:41', 1);
INSERT INTO `roles` VALUES (4, 'partner', 'Marketing Partner', '2019-11-06 03:28:21', '2019-11-06 03:28:21', 2);
INSERT INTO `roles` VALUES (5, 'nova-user', 'Nova User', '2020-06-02 20:33:46', '2020-06-02 20:33:46', 5);
INSERT INTO `roles` VALUES (6, 'referral-program-user', 'These users have only joined for the referral program', '2020-10-19 14:29:47', '2020-10-19 14:29:47', 6);
INSERT INTO `roles` VALUES (7, 'credible-lender', 'A Role specifically for Credible', '2021-01-07 05:34:49', '2021-01-07 05:34:49', 7);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
