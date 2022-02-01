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

 Date: 29/01/2021 22:28:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for academic_years
-- ----------------------------
DROP TABLE IF EXISTS `academic_years`;
CREATE TABLE `academic_years` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refinance` tinyint(1) NOT NULL DEFAULT '0',
  `starts_on` date NOT NULL,
  `ends_on` date NOT NULL,
  `progress_stage` tinyint(4) NOT NULL DEFAULT '2',
  `progress_descriptions` text COLLATE utf8mb4_unicode_ci,
  `progress_titles` text COLLATE utf8mb4_unicode_ci,
  `display_count_based_on` tinyint(4) NOT NULL DEFAULT '1',
  `dashboard_update` text COLLATE utf8mb4_unicode_ci,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_group_redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `display_priority` int(10) unsigned NOT NULL DEFAULT '99',
  `dashboard_button_cta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hide_dashboard_button` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of academic_years
-- ----------------------------
BEGIN;
INSERT INTO `academic_years` VALUES (1, 'Refinance', 1, '2019-06-01', '2020-05-31', 2, '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', 1, NULL, 'Refinance student loan negotiation group', 'App\\Redirects\\QuestionFlowRedirects\\RedirectToStudentLoanRefinancingQuestionFlow', '2020-02-07 05:59:24', '2020-11-30 21:42:44', NULL, 3, NULL, 0);
INSERT INTO `academic_years` VALUES (2, 'Spring / Winter 2020', 0, '2019-06-01', '2020-05-31', 2, NULL, NULL, 1, NULL, NULL, NULL, '2020-02-07 05:59:24', '2020-05-01 04:26:31', '2020-05-01 04:26:31', 4, NULL, 0);
INSERT INTO `academic_years` VALUES (3, 'Academic Year 2020-21', 0, '2020-06-01', '2021-05-31', 4, '[\"You have joined the negotiation group\",\"Juno negotiates with lenders\",\"Juno has a deal ready for you\"]', '[\"Now and ongoing\",\"Up until May 15th\",\"By June 15th\"]', 1, '<div><strong>Latest status (6/14) : It\'s Launch Week!</strong><br><br>Thanks for being patient with us throughout the process! There are so many of you that we need to release the deal in phases through Friday 6/19 to avoid technical &amp; capacity issues with our partners. This means that we’re going to release our negotiated deals to those at NYU Stern and Yale School of Management on 6/15, as they have the earliest tuition due dates and need a faster turnaround time. <strong>If, for any reason, you also need to apply for your loans ASAP, email us and we will send you the deals right away. &nbsp;</strong></div><div><br></div>', 'Academic Year 2020-21 student loan negotiation group', 'App\\Redirects\\QuestionFlowRedirects\\RedirectToStudentLoanQuestionFlow', '2020-02-07 05:59:24', '2020-11-30 21:43:03', NULL, 2, NULL, 0);
INSERT INTO `academic_years` VALUES (4, 'Health Insurance', 0, '2019-06-01', '2020-05-31', 4, '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', 1, NULL, 'International Student Health Insurance negotiation group', 'App\\Redirects\\QuestionFlowRedirects\\RedirectToInternationalStudentHealthInsuranceQuestionFlow', '2020-08-19 00:16:15', '2020-11-30 21:43:24', NULL, 1, NULL, 0);
INSERT INTO `academic_years` VALUES (5, 'Auto Loans', 0, '2020-10-22', '2021-10-22', 1, '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', 1, NULL, 'Auto Loan Refinancing Group', 'App\\Redirects\\QuestionFlowRedirects\\RedirectToAutoLoansPartnerQuestionFlow', '2020-10-22 20:53:45', '2020-11-30 21:43:46', NULL, 10, 'Go to Campaign', 0);
INSERT INTO `academic_years` VALUES (6, 'Bar Prep', 0, '2020-10-29', '2021-07-28', 2, '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', 1, '<div>Tyler is going to update this</div>', 'Bar Prep Course Negotiation Group', 'App\\Redirects\\QuestionFlowRedirects\\RedirectToBarPrepQuestionFlow', '2020-10-30 00:30:33', '2021-01-14 01:04:29', '2021-01-14 01:04:29', 99, 'View Campaign', 0);
INSERT INTO `academic_years` VALUES (7, 'Academic Year 2021-22', 0, '2020-11-06', '2021-11-06', 2, NULL, NULL, 1, NULL, 'Academic Year 2021-22', 'App\\Redirects\\QuestionFlowRedirects\\RedirectToStudentLoanQuestionFlow', '2020-11-07 03:06:30', '2020-11-07 03:06:30', NULL, 99, NULL, 0);
INSERT INTO `academic_years` VALUES (8, 'College Test Prep', 0, '2020-12-02', '2021-12-02', 1, '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', 1, NULL, 'College Test Prep', 'App\\Redirects\\QuestionFlowRedirects\\RedirectToCollegeTestPrepQuestionFlow', '2020-12-02 20:15:10', '2020-12-02 20:34:02', NULL, 99, 'Go to Campaign', 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
