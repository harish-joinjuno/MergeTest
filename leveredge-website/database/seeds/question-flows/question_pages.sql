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

 Date: 29/01/2021 20:31:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for question_pages
-- ----------------------------
DROP TABLE IF EXISTS `question_pages`;
CREATE TABLE `question_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_flow_id` bigint(20) unsigned NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT '99',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skip_policy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hide_submission_button` tinyint(1) NOT NULL DEFAULT '0',
  `pre_render_redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question_pages_slug_unique` (`slug`),
  KEY `question_pages_question_flow_id_foreign` (`question_flow_id`),
  CONSTRAINT `question_pages_question_flow_id_foreign` FOREIGN KEY (`question_flow_id`) REFERENCES `question_flows` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of question_pages
-- ----------------------------
BEGIN;
INSERT INTO `question_pages` VALUES (1, 1, 1, 'What kind of loan are you looking for?', 'loan-type', NULL, NULL, 1, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (2, 1, 2, 'When do you need the loan?', 'when-do-you-need-the-loan', NULL, NULL, 1, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (3, 1, 3, 'Personal Information', 'personal-information', NULL, NULL, 0, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (4, 1, 4, 'Undergraduate Information', 'undergraduate-information', NULL, 'App\\SkipPolicies\\IfLoanTypeGraduate', 0, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (5, 1, 5, 'Graduate Information', 'graduate-information', NULL, 'App\\SkipPolicies\\IfLoanTypeUndergraduate', 0, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (6, 1, 6, 'Financial Information', 'financial-information', NULL, NULL, 0, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (7, 2, 1, 'Personal Information', 'personal-information-refinance', NULL, NULL, 0, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (8, 2, 2, 'Financial Information', 'financial-information-refinance', NULL, NULL, 0, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (9, 2, 3, 'Refinancing Information', 'refinance-information', NULL, NULL, 0, NULL, '2020-11-24 00:09:01', '2020-11-24 00:09:01', NULL);
INSERT INTO `question_pages` VALUES (10, 3, 1, 'Auto Page 1', 'auto-page-1', 'version-1', NULL, 0, NULL, '2020-11-24 00:40:58', '2020-11-24 01:11:33', NULL);
INSERT INTO `question_pages` VALUES (11, 3, 2, 'Auto Page 2', 'auto-page-2', 'version-1', NULL, 0, NULL, '2020-11-24 01:10:31', '2020-11-24 01:10:31', NULL);
INSERT INTO `question_pages` VALUES (12, 3, 3, 'Auto Page 3', 'auto-page-3', 'version-1', NULL, 0, NULL, '2020-11-24 01:47:27', '2020-11-24 01:47:27', NULL);
INSERT INTO `question_pages` VALUES (13, 3, 4, 'Auto Page 4', 'auto-page-4', 'version-1', NULL, 0, NULL, '2020-11-24 01:53:53', '2020-11-24 01:53:53', NULL);
INSERT INTO `question_pages` VALUES (14, 4, 1, 'Personal Information', 'international-personal-information', 'version-1', NULL, 0, NULL, '2020-11-24 22:26:29', '2020-11-24 22:26:29', NULL);
INSERT INTO `question_pages` VALUES (15, 4, 2, 'International Health Insurance', 'international-health-insurance-2-2-2', 'version-1', NULL, 1, NULL, '2020-11-24 22:27:37', '2020-11-30 23:05:13', NULL);
INSERT INTO `question_pages` VALUES (17, 4, 3, 'International Undergraduate Information', 'international-undergraduate-information', 'version-1', 'App\\SkipPolicies\\IfLoanTypeGraduate', 0, NULL, '2020-11-25 02:27:31', '2020-11-25 02:27:31', NULL);
INSERT INTO `question_pages` VALUES (19, 4, 4, 'International Graduate Information', 'international-graduate-information', 'version-1', 'App\\SkipPolicies\\IfLoanTypeUndergraduate', 0, NULL, '2020-11-25 16:46:31', '2020-11-25 16:46:31', NULL);
INSERT INTO `question_pages` VALUES (20, 5, 1, 'Personal Information', 'bar-perp-personal-information', 'version-1', NULL, 0, NULL, '2020-11-26 01:40:03', '2020-11-26 01:40:16', NULL);
INSERT INTO `question_pages` VALUES (21, 5, 2, 'Bar Prep', 'bar-prep', 'version-1', NULL, 0, NULL, '2020-11-26 01:58:53', '2020-11-26 01:58:53', NULL);
INSERT INTO `question_pages` VALUES (22, 5, 3, 'Bar Prep Info', 'bar-prep-info', 'version-1', NULL, 0, NULL, '2020-11-26 02:13:21', '2020-11-26 02:13:21', NULL);
INSERT INTO `question_pages` VALUES (23, 5, 4, 'Preferences', 'preferences', 'version-1', NULL, 0, NULL, '2020-11-26 03:08:37', '2020-11-26 03:08:37', NULL);
INSERT INTO `question_pages` VALUES (24, 6, 1, 'Personal Information', 'personal-information-refinance-with-intl', 'version-1', NULL, 0, NULL, '2020-12-01 19:47:51', '2020-12-03 03:22:57', NULL);
INSERT INTO `question_pages` VALUES (25, 6, 8, 'Financial Information US', 'financial-information-refinance-us', 'version-1', 'App\\SkipPolicies\\IfImmigrationStatusIsNotUsCitizen', 0, NULL, '2020-12-01 19:47:51', '2020-12-03 03:23:38', NULL);
INSERT INTO `question_pages` VALUES (26, 6, 4, 'Refinancing Information Intl', 'refinance-information-intl', 'version-1', 'App\\SkipPolicies\\IfImmigrationStatusIsUsCitizen', 0, NULL, '2020-12-01 19:47:51', '2020-12-03 03:23:38', NULL);
INSERT INTO `question_pages` VALUES (27, 6, 2, 'Undergraduate Information', 'undergraduate-info-refi', 'version-1', 'App\\SkipPolicies\\IfWentToGraduateSchoolIsYes', 0, NULL, '2020-12-01 21:45:09', '2020-12-03 03:22:57', NULL);
INSERT INTO `question_pages` VALUES (28, 2, 4, 'Graduate Information', 'grad-school-refi-2', 'version-1', 'App\\SkipPolicies\\IfLoanTypeGraduate', 0, NULL, '2020-12-01 22:04:36', '2020-12-01 22:06:51', '2020-12-01 22:06:51');
INSERT INTO `question_pages` VALUES (29, 6, 3, 'Graduate Information', 'student-refi-grad-page', 'version-1', 'App\\SkipPolicies\\IfWentToGraduateSchoolIsNo', 0, NULL, '2020-12-01 22:14:16', '2020-12-03 03:22:57', NULL);
INSERT INTO `question_pages` VALUES (30, 6, 7, 'Financials Refi Intl', 'intl-refi-financials-2', 'version-1', 'App\\SkipPolicies\\IfImmigrationStatusIsUsCitizen', 0, NULL, '2020-12-01 22:30:16', '2020-12-03 03:23:38', NULL);
INSERT INTO `question_pages` VALUES (31, 7, 1, 'Personal Information', 'test-prep-intro', 'version-1', NULL, 0, NULL, '2020-12-02 19:42:47', '2020-12-02 19:42:47', NULL);
INSERT INTO `question_pages` VALUES (32, 6, 6, 'Refinancing Information US', 'domestic-refi-comp-2-2', 'version-1', 'App\\SkipPolicies\\IfImmigrationStatusIsNotUsCitizen', 0, NULL, '2020-12-03 02:54:55', '2020-12-03 03:23:38', NULL);
INSERT INTO `question_pages` VALUES (33, 6, 9, 'Refinance Intl 6', 'refi-intl-6', 'version-1', 'App\\SkipPolicies\\IfImmigrationStatusIsUsCitizen', 0, NULL, '2020-12-03 18:21:47', '2020-12-03 18:21:47', NULL);
INSERT INTO `question_pages` VALUES (34, 8, 1, 'Personal Information', 'test-prep-intro-copy', 'version-1', NULL, 0, 'App\\Redirects\\QuestionPageRedirects\\RedirectToCollegeTestPrepV1', '2020-12-12 02:05:44', '2020-12-17 01:00:38', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
