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

 Date: 29/01/2021 21:58:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contents
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of contents
-- ----------------------------
BEGIN;
INSERT INTO `contents` VALUES (1, 'title', 'What kind of loan are you looking for?', 1, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (2, 'title', 'When do you need the loan?', 2, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (3, 'title', 'Personal Information', 3, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (4, 'title', 'Undergraduate Information', 4, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (5, 'title', 'Graduate Information', 5, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (6, 'title', 'Financial Information', 6, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (7, 'title', 'Personal Information', 7, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (8, 'title', 'Financial Information', 8, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (9, 'title', 'Refinancing Information', 9, 'App\\QuestionPage', '2020-11-24 00:09:01', '2020-11-24 00:09:01');
INSERT INTO `contents` VALUES (10, 'title', '<div>Personal Information</div>', 10, 'App\\QuestionPage', '2020-11-24 02:29:22', '2020-11-24 02:29:22');
INSERT INTO `contents` VALUES (11, 'title', '<div>About Your Auto Loan</div>', 11, 'App\\QuestionPage', '2020-11-24 02:32:59', '2020-11-24 20:32:54');
INSERT INTO `contents` VALUES (12, 'title', '<div>About Your Finances</div>', 12, 'App\\QuestionPage', '2020-11-24 02:33:15', '2020-11-24 02:33:15');
INSERT INTO `contents` VALUES (13, 'title', '<div>About your Residence</div>', 13, 'App\\QuestionPage', '2020-11-24 02:33:30', '2020-11-24 20:34:37');
INSERT INTO `contents` VALUES (14, 'title', '<div>Undergraduate Information</div>', 16, 'App\\QuestionPage', '2020-11-24 23:36:22', '2020-11-24 23:36:22');
INSERT INTO `contents` VALUES (15, 'title', '<div>Personal Information</div>', 14, 'App\\QuestionPage', '2020-11-25 00:47:07', '2020-11-25 00:47:07');
INSERT INTO `contents` VALUES (16, 'title', '<div>Financial Information</div>', 18, 'App\\QuestionPage', '2020-11-25 02:35:57', '2020-11-25 02:35:57');
INSERT INTO `contents` VALUES (17, 'title', '<div>Graduate Program Information</div>', 19, 'App\\QuestionPage', '2020-11-25 16:46:50', '2020-11-25 16:46:50');
INSERT INTO `contents` VALUES (18, 'title', '<div>Undergraduate Information</div>', 17, 'App\\QuestionPage', '2020-11-25 16:51:01', '2020-11-25 16:51:01');
INSERT INTO `contents` VALUES (19, 'title', '<div>Personal Information</div>', 20, 'App\\QuestionPage', '2020-11-26 01:40:34', '2020-11-26 01:40:34');
INSERT INTO `contents` VALUES (20, 'title', '<div>Bar Prep</div>', 21, 'App\\QuestionPage', '2020-11-26 01:59:07', '2020-11-26 01:59:07');
INSERT INTO `contents` VALUES (21, 'title', '<div>Bar Prep Info</div>', 22, 'App\\QuestionPage', '2020-11-26 02:13:36', '2020-11-26 02:13:36');
INSERT INTO `contents` VALUES (22, 'title', '<div>Preferences</div>', 23, 'App\\QuestionPage', '2020-11-26 03:08:50', '2020-11-26 03:08:50');
INSERT INTO `contents` VALUES (23, 'sub-heading', '<div>We want to keep the group\'s preferences in mind as we negotiate these deals.<br>If you\'d like to have additional input, shoot a note to <a href=\"mailto:hello@joinjuno.com\">hello@joinjuno.com</a></div>', 23, 'App\\QuestionPage', '2020-11-26 03:09:13', '2020-11-26 03:09:13');
INSERT INTO `contents` VALUES (24, 'title', 'Personal Information', 24, 'App\\QuestionPage', '2020-12-01 19:47:51', '2020-12-01 19:47:51');
INSERT INTO `contents` VALUES (25, 'title', 'Financial Information', 25, 'App\\QuestionPage', '2020-12-01 19:47:51', '2020-12-01 19:47:51');
INSERT INTO `contents` VALUES (26, 'title', 'Refinancing Information', 26, 'App\\QuestionPage', '2020-12-01 19:47:51', '2020-12-01 19:47:51');
INSERT INTO `contents` VALUES (27, 'title', '<div>Join The Group</div>', 31, 'App\\QuestionPage', '2020-12-02 19:42:47', '2020-12-02 19:49:07');
INSERT INTO `contents` VALUES (28, 'title', '<div>About Your Loan</div>', 30, 'App\\QuestionPage', '2020-12-03 02:16:16', '2020-12-03 02:16:16');
INSERT INTO `contents` VALUES (29, 'title', '<div>About Your Education</div>', 27, 'App\\QuestionPage', '2020-12-03 02:16:32', '2020-12-03 02:16:32');
INSERT INTO `contents` VALUES (30, 'title', '<div>About Your Education</div>', 29, 'App\\QuestionPage', '2020-12-03 02:16:44', '2020-12-03 02:16:44');
INSERT INTO `contents` VALUES (31, 'title', 'Refinancing Information', 32, 'App\\QuestionPage', '2020-12-03 02:54:55', '2020-12-03 02:54:55');
INSERT INTO `contents` VALUES (32, 'title', '<div>About You</div>', 33, 'App\\QuestionPage', '2020-12-03 18:21:58', '2020-12-03 18:21:58');
INSERT INTO `contents` VALUES (33, 'title', '<div>Join The Group</div>', 34, 'App\\QuestionPage', '2020-12-12 02:05:44', '2020-12-12 02:05:44');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
