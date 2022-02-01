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

 Date: 06/01/2021 22:42:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for experiment_types
-- ----------------------------
DROP TABLE IF EXISTS `experiment_types`;
CREATE TABLE `experiment_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of experiment_types
-- ----------------------------
BEGIN;
INSERT INTO `experiment_types` VALUES (1, 'Default Experiment Type', '2020-11-05 08:43:56', '2020-11-05 08:43:56');
INSERT INTO `experiment_types` VALUES (2, 'Auto Refinance Landing Page', '2020-11-05 08:43:56', '2020-11-05 08:43:56');
INSERT INTO `experiment_types` VALUES (3, 'Auto Refinance Sign Up', '2020-11-05 08:43:56', '2020-11-05 08:43:56');
INSERT INTO `experiment_types` VALUES (4, 'SLR Landing Page', '2020-11-05 08:43:56', '2020-11-05 08:43:56');
INSERT INTO `experiment_types` VALUES (5, 'Upwork Emails', '2020-11-05 08:43:56', '2020-11-05 08:43:56');
INSERT INTO `experiment_types` VALUES (6, 'Post Reward Claim', '2020-11-05 08:43:56', '2020-11-05 08:43:56');
INSERT INTO `experiment_types` VALUES (7, 'Referral Program Direct Access', '2020-11-05 08:43:56', '2020-11-05 08:43:56');
INSERT INTO `experiment_types` VALUES (8, 'Auto Refinance Post Auth', '2020-11-10 02:02:38', '2020-11-10 02:02:38');
INSERT INTO `experiment_types` VALUES (9, 'Refinance Recommendation Page', '2020-11-30 22:37:59', '2020-11-30 22:37:59');
INSERT INTO `experiment_types` VALUES (10, 'College Test Prep - Landing Pages', '2020-12-16 21:09:46', '2020-12-16 21:09:46');
INSERT INTO `experiment_types` VALUES (11, 'Temple Landing Page Experiments', '2021-01-05 21:40:32', '2021-01-05 21:40:32');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
