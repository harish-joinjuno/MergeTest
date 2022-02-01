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

 Date: 29/01/2021 20:30:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for referral_program_eligible_profiles
-- ----------------------------
DROP TABLE IF EXISTS `referral_program_eligible_profiles`;
CREATE TABLE `referral_program_eligible_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referral_program_id` bigint(20) unsigned NOT NULL,
  `university_id` int(10) unsigned DEFAULT NULL,
  `degree_id` int(10) unsigned DEFAULT NULL,
  `grad_degree_id` int(10) unsigned DEFAULT NULL,
  `grad_university_id` int(10) unsigned DEFAULT NULL,
  `created_on_or_after` date DEFAULT NULL,
  `created_before` date DEFAULT NULL,
  `immigration_status` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referral_program_eligible_profiles_referral_program_id_foreign` (`referral_program_id`),
  CONSTRAINT `referral_program_eligible_profiles_referral_program_id_foreign` FOREIGN KEY (`referral_program_id`) REFERENCES `referral_programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of referral_program_eligible_profiles
-- ----------------------------
BEGIN;
INSERT INTO `referral_program_eligible_profiles` VALUES (1, 1, NULL, NULL, NULL, NULL, '2019-01-01', NULL, NULL, '2020-02-20 06:52:07', '2020-09-22 20:54:29');
INSERT INTO `referral_program_eligible_profiles` VALUES (2, 2, NULL, NULL, NULL, NULL, '2020-02-20', '2020-09-22', NULL, '2020-02-20 06:52:07', '2020-09-22 20:54:29');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
