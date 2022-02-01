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

 Date: 06/01/2021 22:42:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for experiments
-- ----------------------------
DROP TABLE IF EXISTS `experiments`;
CREATE TABLE `experiments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `experiment_type_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `feature_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_five` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `experiments_experiment_type_id_foreign` (`experiment_type_id`),
  CONSTRAINT `experiments_experiment_type_id_foreign` FOREIGN KEY (`experiment_type_id`) REFERENCES `experiment_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of experiments
-- ----------------------------
BEGIN;
INSERT INTO `experiments` VALUES (1, 4, 'Control or Normal Flow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `experiments` VALUES (2, 4, 'Optional Book Time with Team', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `experiments` VALUES (3, 4, 'Deals Up Front Landing Page', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `experiments` VALUES (4, 4, 'Long Form Landing Page', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-17 21:17:12', 0);
INSERT INTO `experiments` VALUES (5, 5, 'Emails to Dentists From Up Work', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `experiments` VALUES (6, 5, 'Emails to Surgeons From Up Work', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `experiments` VALUES (7, 5, 'Emails to Urgent Care From Up Work', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `experiments` VALUES (8, 5, 'Emails to Eye Care From Up Work', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `experiments` VALUES (9, 4, 'Long Form Landing Page with Video', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `experiments` VALUES (10, 4, 'Long Form Landing Page with Video in Body', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `experiments` VALUES (11, 4, 'Home Page as Landing Page', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `experiments` VALUES (12, 7, 'Option to Register for Referral Program Only', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `experiments` VALUES (13, 7, 'Control to Option to Register for Referral Program Only', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `experiments` VALUES (14, 4, 'Long Form Landing Page with Email Capture and Video in Body', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-23 03:46:56', 0);
INSERT INTO `experiments` VALUES (15, 1, 'Missing Experiment', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-20 20:25:26', '2020-10-20 20:25:26', 1);
INSERT INTO `experiments` VALUES (16, 3, 'Auto Refinance Sign Up - Control', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 21:00:00', '2020-10-23 21:00:00', 0);
INSERT INTO `experiments` VALUES (17, 3, 'Auto Refinance Sign Up - Skip Password', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 21:00:00', '2020-10-23 21:00:00', 0);
INSERT INTO `experiments` VALUES (18, 3, 'Auto Refinance Sign Up - Get Last 4 SSN', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 21:00:00', '2020-10-23 21:00:00', 0);
INSERT INTO `experiments` VALUES (19, 3, 'Auto Refinance Sign Up - Minimum Questions', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 21:00:00', '2020-10-23 21:00:00', 0);
INSERT INTO `experiments` VALUES (20, 2, 'Auto Refinance Landing Page - Control', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 21:00:00', '2020-10-23 21:00:00', 0);
INSERT INTO `experiments` VALUES (21, 2, 'Auto Refinance Landing Page - V2', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 21:00:00', '2020-10-23 21:00:00', 0);
INSERT INTO `experiments` VALUES (22, 3, 'Auto Refinance Sign Up - Extreme Minimum Questions', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 20:38:26', '2020-10-26 20:38:26', 0);
INSERT INTO `experiments` VALUES (23, 2, 'Auto Refinance Landing Page - V3', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28 03:46:17', '2020-11-17 21:18:21', 0);
INSERT INTO `experiments` VALUES (24, 2, 'Auto Refinance Landing Page - V4', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28 03:46:20', '2020-10-28 03:46:20', 0);
INSERT INTO `experiments` VALUES (25, 2, 'Auto Refinance Landing Page - V5', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28 03:46:23', '2020-10-28 03:46:23', 0);
INSERT INTO `experiments` VALUES (26, 2, 'Auto Refinance Landing Page - V6', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28 03:46:30', '2020-10-28 03:46:30', 1);
INSERT INTO `experiments` VALUES (27, 2, 'Auto Refinance Landing Page - V7', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28 03:46:35', '2020-10-28 03:46:35', 0);
INSERT INTO `experiments` VALUES (28, 4, 'SLR Landing Page - Auto Play Video in Body', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-02 21:19:11', '2020-11-02 21:19:11', 0);
INSERT INTO `experiments` VALUES (29, 3, 'Auto Refinance Sign Up Flow - v6', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-03 02:49:59', '2020-11-03 02:49:59', 1);
INSERT INTO `experiments` VALUES (30, 3, 'Auto Refinance Sign Up Flow - v7', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-03 02:50:04', '2020-11-03 02:50:04', 1);
INSERT INTO `experiments` VALUES (31, 6, 'Post Reward Claim - Control', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-05 06:32:30', '2020-11-05 06:32:30', 1);
INSERT INTO `experiments` VALUES (32, 6, 'Post Reward Claim - V2', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-05 06:32:35', '2020-11-05 06:32:35', 1);
INSERT INTO `experiments` VALUES (33, 6, 'Post Reward Claim - V3', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-05 06:32:40', '2020-11-05 06:32:40', 1);
INSERT INTO `experiments` VALUES (34, 8, 'Auto Refinance Post Auth - Control', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-10 02:02:47', '2020-11-10 21:24:36', 1);
INSERT INTO `experiments` VALUES (35, 8, 'Auto Refinance Post Auth - Leaderboard', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-10 02:02:56', '2020-11-10 21:24:46', 1);
INSERT INTO `experiments` VALUES (36, 8, 'Auto Refinance Post Auth - Visualized', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-10 02:03:03', '2020-11-10 21:24:59', 1);
INSERT INTO `experiments` VALUES (37, 4, 'Long Form Landing Page with Animated Video 15s in Body - Auto Play', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-11 01:34:08', '2020-11-23 21:31:35', 1);
INSERT INTO `experiments` VALUES (38, 4, 'Long Form Landing Page with Video Matt in Body - Auto Play', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-11 06:48:50', '2020-11-23 21:31:47', 1);
INSERT INTO `experiments` VALUES (39, 2, 'Auto Refinance Landing Page - V8', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-19 01:54:25', '2020-11-19 18:16:13', 1);
INSERT INTO `experiments` VALUES (40, 2, 'Auto Refinance Landing Page - V9', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-19 01:54:39', '2020-11-19 18:16:17', 1);
INSERT INTO `experiments` VALUES (41, 9, 'RRP - Control', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-30 22:38:18', '2020-11-30 22:39:23', 1);
INSERT INTO `experiments` VALUES (42, 9, 'RRP - Signing Bonus', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-30 22:38:34', '2020-11-30 22:39:20', 1);
INSERT INTO `experiments` VALUES (43, 9, 'RRP - Deals Guarantee', NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-30 22:38:59', '2020-12-28 21:25:58', 0);
INSERT INTO `experiments` VALUES (44, 10, 'Control', NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-16 21:09:56', '2020-12-17 02:12:34', 1);
INSERT INTO `experiments` VALUES (45, 10, 'Version 1 - Circles', NULL, 'Has Form On Landing Page', NULL, NULL, NULL, NULL, '2020-12-16 21:10:08', '2020-12-17 21:22:06', 1);
INSERT INTO `experiments` VALUES (46, 10, 'Version 2 - Slider', NULL, 'Has Form On Landing Page', NULL, NULL, NULL, NULL, '2020-12-16 21:10:16', '2020-12-17 21:21:53', 1);
INSERT INTO `experiments` VALUES (47, 9, 'RRP - Dynamic Rewards', NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-20 00:18:09', '2020-12-28 21:22:28', 1);
INSERT INTO `experiments` VALUES (48, 4, 'Version 8 - Added Typical Questions', NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-23 03:08:42', '2020-12-23 03:46:19', 1);
INSERT INTO `experiments` VALUES (49, 11, 'Control', NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-05 21:40:44', '2021-01-06 02:39:18', 1);
INSERT INTO `experiments` VALUES (50, 11, 'V2 - CTA Button', NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-05 21:41:04', '2021-01-06 02:39:12', 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
