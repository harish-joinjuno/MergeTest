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

 Date: 29/01/2021 22:27:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for negotiation_group_end_screens
-- ----------------------------
DROP TABLE IF EXISTS `negotiation_group_end_screens`;
CREATE TABLE `negotiation_group_end_screens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `negotiation_group_id` bigint(20) unsigned NOT NULL,
  `heading` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cta_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `negotiation_group_end_screens_negotiation_group_id_foreign` (`negotiation_group_id`),
  CONSTRAINT `negotiation_group_end_screens_negotiation_group_id_foreign` FOREIGN KEY (`negotiation_group_id`) REFERENCES `negotiation_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of negotiation_group_end_screens
-- ----------------------------
BEGIN;
INSERT INTO `negotiation_group_end_screens` VALUES (1, 8, 'We have deals for you', 'Here are the next steps!', 'Go to the deals', '/member/negotiation-group/8', '2020-06-17 02:13:00', '2020-08-19 20:10:58');
INSERT INTO `negotiation_group_end_screens` VALUES (2, 9, 'We have deals for you', 'Here are the next steps!', 'Go to the deals', '/member/negotiation-group/9', '2020-06-17 23:39:28', '2020-08-19 20:11:16');
INSERT INTO `negotiation_group_end_screens` VALUES (3, 10, 'We have a deal for you', 'Here are the next steps!', 'See the deal', '/member/negotiation-group/10', '2020-06-17 23:45:13', '2020-08-19 20:12:36');
INSERT INTO `negotiation_group_end_screens` VALUES (4, 12, 'Juno has partnered with Nomad Credit', 'Here are the next steps!', 'Go to Dashboard', '/member/dashboard', '2020-06-17 23:52:11', '2020-09-25 18:50:10');
INSERT INTO `negotiation_group_end_screens` VALUES (5, 13, 'Juno has partnered with Nomad Credit', 'Here are the next steps!', 'Go to Dashboard', '/member/dashboard', '2020-06-17 23:56:02', '2020-09-25 18:50:12');
INSERT INTO `negotiation_group_end_screens` VALUES (6, 11, 'We are ready to share the deals we negotiated', 'Here are the next steps!', 'Go to Dashboard', '/member/dashboard', '2020-06-17 23:59:54', '2020-06-19 01:57:13');
INSERT INTO `negotiation_group_end_screens` VALUES (7, 7, 'Hmm, please contact us', 'Something went wrong here, but we have a home for you in one of our negotiation groups!', 'Contact us', '/contact', '2020-06-19 01:27:29', '2020-06-19 01:27:29');
INSERT INTO `negotiation_group_end_screens` VALUES (8, 2, 'We have a deal ready for you', 'Here are the next steps!', 'Go to the deals', '/member/academic-year/1', '2020-06-19 01:28:27', '2020-08-21 02:34:17');
INSERT INTO `negotiation_group_end_screens` VALUES (9, 1, 'Thanks for joining Juno!', 'Welcome to the community', 'Go to Campaign', '/member/international-refi/post-auth', '2020-06-19 01:28:54', '2020-11-10 00:07:51');
INSERT INTO `negotiation_group_end_screens` VALUES (10, 14, 'We are ready to share a deal with you', 'Here are the next steps!', 'Go to the deal', '/member/academic-year/1', '2020-07-01 11:30:49', '2020-07-02 22:52:07');
INSERT INTO `negotiation_group_end_screens` VALUES (11, 15, 'We have deals ready for you', 'Here are the next steps!', 'Go to the deals', '/member/academic-year/1', '2020-07-01 11:30:49', '2020-08-21 02:35:41');
INSERT INTO `negotiation_group_end_screens` VALUES (12, 16, 'We are ready to share a deal with you', 'Here are the next steps!', 'Go to the deal', '/member/academic-year/1', '2020-07-01 11:30:49', '2020-07-03 03:11:24');
INSERT INTO `negotiation_group_end_screens` VALUES (13, 17, 'We are ready to share a deal with you', 'Here are the next steps!', 'Go to the deals', '/member/academic-year/1', '2020-07-01 11:30:49', '2020-08-21 02:38:43');
INSERT INTO `negotiation_group_end_screens` VALUES (17, 18, 'We have a health insurance deal for you!', 'Get ready to save on your student health insurance', 'Go to the deal', '/member/negotiation-group/18', '2020-08-18 01:23:05', '2020-08-18 01:51:11');
INSERT INTO `negotiation_group_end_screens` VALUES (18, 19, 'Welcome to Juno!', 'Unfortunately, you\'re not eligible for our health insurance deal at this time.', 'Go to Dashboard', '/member/dashboard', '2020-08-18 01:24:28', '2020-09-25 18:50:14');
INSERT INTO `negotiation_group_end_screens` VALUES (19, 20, 'Welcome to the community!', 'Track our progress & help grow the group', 'Go to Campaign', '/loans/auto-refinance/post-auth', '2020-10-22 22:44:38', '2020-10-22 23:39:09');
INSERT INTO `negotiation_group_end_screens` VALUES (20, 21, 'Welcome to the Bar Prep community!', 'Track our progress & help grow the group', 'Go to Campaign', '/test-prep/bar-prep/success', '2020-10-22 22:44:38', '2020-10-30 19:16:48');
INSERT INTO `negotiation_group_end_screens` VALUES (21, 22, 'Thanks for joining Juno!', 'Welcome to the community', 'Go to Campaign', '/member/academic-year-21-22/post-auth', '2020-11-08 21:55:50', '2020-11-24 00:16:32');
INSERT INTO `negotiation_group_end_screens` VALUES (22, 23, 'Thanks for joining Juno!', 'Welcome to the community', 'Go to Campaign', '/international-academic-year-21-22/post-auth', '2020-11-08 21:55:50', '2020-11-19 20:45:22');
INSERT INTO `negotiation_group_end_screens` VALUES (23, 24, 'Welcome to the community!', 'Track our progress & help grow the group', 'Go to Campaign', 'member/test-prep/college-test-prep/post-auth', '2020-12-02 20:23:04', '2020-12-04 01:18:04');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
