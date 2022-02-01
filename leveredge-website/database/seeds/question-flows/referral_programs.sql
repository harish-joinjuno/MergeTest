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

 Date: 29/01/2021 20:31:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for referral_programs
-- ----------------------------
DROP TABLE IF EXISTS `referral_programs`;
CREATE TABLE `referral_programs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `referral_programs_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of referral_programs
-- ----------------------------
BEGIN;
INSERT INTO `referral_programs` VALUES (1, 'Two Side 25 With Milestone Prizes', 'MBA Referral Program', 'two-side-with-milestone-prizes', 2, '2020-02-20 06:52:07', '2020-02-20 06:52:07');
INSERT INTO `referral_programs` VALUES (2, 'Two Side 25 With Scholarship Pot Option', 'Default Referral Program', 'two-side-with-scholarship-pot', 3, '2020-02-20 06:52:07', '2020-02-20 06:52:07');
INSERT INTO `referral_programs` VALUES (3, 'Quarter percent of first loan', 'Quarter percent of first loan', 'quarter-percent-of-first-loan', 1, '2020-07-21 07:16:29', '2020-07-21 07:16:29');
INSERT INTO `referral_programs` VALUES (4, 'One Sided Two Hundred Dollars', '$200 per loan above $20K', 'two-hundred-per-loan', 4, '2020-10-19 14:29:47', '2020-10-19 14:29:47');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
