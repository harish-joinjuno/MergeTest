/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : localhost:3306
 Source Schema         : leveredge

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 16/02/2021 22:02:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for question_flows
-- ----------------------------
DROP TABLE IF EXISTS `question_flows`;
CREATE TABLE `question_flows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorization_policy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_sequence` json DEFAULT NULL,
  `complete_sequence` json DEFAULT NULL,
  `after_completion_redirect_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question_flows_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of question_flows
-- ----------------------------
BEGIN;
INSERT INTO `question_flows` VALUES (1, 'Student Loan Flow', 'student-loan', 'version-1', NULL, '[]', '[\"App\\\\Jobs\\\\CompleteFlow\\\\CreateUserFromPreAuthStudentLoanFlow\", \"App\\\\Jobs\\\\CompleteFlow\\\\MarkSignUpProgressComplete\", \"App\\\\Jobs\\\\CompleteFlow\\\\AddToAcademicYearStudentLoan\", \"App\\\\Jobs\\\\CompleteFlow\\\\SendLastJoinedNegotiationGroupWelcomeEmail\"]', 'App\\Redirects\\RedirectToUserProfileEndScreen', '2020-11-24 00:09:01', '2021-02-03 18:27:04', NULL);
INSERT INTO `question_flows` VALUES (2, 'Student Loan Refinancing', 'student-loan-refinancing', 'version-1', 'App\\Jobs\\AuthorizationPolicies\\UserLoggedInPolicy', '[]', '[\"App\\\\Jobs\\\\CompleteFlow\\\\MarkSignUpProgressComplete\", \"App\\\\Jobs\\\\CompleteFlow\\\\AddToAcademicYearRefinance\", \"App\\\\Jobs\\\\CompleteFlow\\\\SendLastJoinedNegotiationGroupWelcomeEmail\"]', 'App\\Redirects\\RedirectToRefinanceEndScreen', '2020-11-24 00:09:01', '2020-12-03 23:19:20', NULL);
INSERT INTO `question_flows` VALUES (3, 'Auto Loans - Partner Request', 'auto-loans-partner', 'template-1', NULL, '[\"App\\\\Jobs\\\\StartFlow\\\\AddToAutoRefiApplicationIfNotExists\"]', '[\"App\\\\Jobs\\\\CompleteFlow\\\\CreateUserFromPreAuthAutoLoansPartnerRequest\", \"App\\\\Jobs\\\\StartFlow\\\\AddToAutoRefiApplicationIfNotExists\", \"App\\\\Jobs\\\\CompleteFlow\\\\ReportAutoLoanViewContentToFacebook\", \"App\\\\Jobs\\\\CompleteFlow\\\\MarkSignUpProgressComplete\", \"App\\\\Jobs\\\\CompleteFlow\\\\AddToAcademicYearAutoRefinance\", \"App\\\\Jobs\\\\CompleteFlow\\\\SendLastJoinedNegotiationGroupWelcomeEmail\", \"App\\\\Jobs\\\\CompleteFlow\\\\MarkAutoLoanApplicationCompleted\"]', 'App\\Redirects\\RedirectToAutoLoansPostAuthPage', '2020-11-23 21:00:00', '2021-02-03 18:32:06', NULL);
INSERT INTO `question_flows` VALUES (4, 'International Student Health Insurance', 'international-student-health-insurance', 'version-1', NULL, '[]', '[\"App\\\\Jobs\\\\CompleteFlow\\\\CreateUserFromPreAuthInternationalStudentHealthInsurance\", \"App\\\\Jobs\\\\CompleteFlow\\\\MarkSignUpProgressComplete\", \"App\\\\Jobs\\\\CompleteFlow\\\\AddToAcademicYearHealthInsurance\", \"App\\\\Jobs\\\\CompleteFlow\\\\SendLastJoinedNegotiationGroupWelcomeEmail\", \"App\\\\Jobs\\\\CompleteFlow\\\\ReportInternationalHealthInsuranceViewContentToFacebook\"]', 'App\\Redirects\\RedirectToUserProfileEndScreen', NULL, '2021-02-03 18:37:04', NULL);
INSERT INTO `question_flows` VALUES (5, 'Bar Prep', 'bar-prep', 'version-1', 'App\\Jobs\\AuthorizationPolicies\\UserLoggedInPolicy', '[]', '[\"App\\\\Jobs\\\\CompleteFlow\\\\MarkSignUpProgressComplete\", \"App\\\\Jobs\\\\CompleteFlow\\\\AddToAcademicYearBarPrep\", \"App\\\\Jobs\\\\CompleteFlow\\\\MarkBarPrepAppStarted\", \"App\\\\Jobs\\\\CompleteFlow\\\\SendLastJoinedNegotiationGroupWelcomeEmail\", \"App\\\\Jobs\\\\CompleteFlow\\\\ReportBarPrepViewContentToFacebook\"]', 'App\\Redirects\\RedirectToUserProfileEndScreen', NULL, '2021-01-12 20:55:31', '2021-01-12 20:55:31');
INSERT INTO `question_flows` VALUES (6, 'Student Loan Refinancing with Intl', 'student-refi-with-intl', 'version-1', NULL, '[]', '[\"App\\\\Jobs\\\\CompleteFlow\\\\CreateUserFromPreAuthStudentLoanRefinancingWithIntl\", \"App\\\\Jobs\\\\CompleteFlow\\\\MarkSignUpProgressComplete\", \"App\\\\Jobs\\\\CompleteFlow\\\\AddToAcademicYearRefinance\", \"App\\\\Jobs\\\\CompleteFlow\\\\SendLastJoinedNegotiationGroupWelcomeEmail\"]', 'App\\Redirects\\RedirectToRefinanceEndScreen', '2020-12-01 19:47:51', '2021-02-03 18:27:04', NULL);
INSERT INTO `question_flows` VALUES (7, 'Test Prep (ACT & SAT)', 'test-prep-act-sat', 'Version-1', 'App\\Jobs\\AuthorizationPolicies\\UserLoggedInPolicy', '[]', '[\"App\\\\Jobs\\\\CompleteFlow\\\\MarkSignUpProgressComplete\", \"App\\\\Jobs\\\\CompleteFlow\\\\AddToAcademicYearCollegeTestPrep\", \"App\\\\Jobs\\\\CompleteFlow\\\\SendLastJoinedNegotiationGroupWelcomeEmail\", \"App\\\\Jobs\\\\CompleteFlow\\\\ReportCollegeTestPrepViewContentToFacebook\"]', 'App\\Redirects\\RedirectToPaymentPageForTestPrep', '2020-12-02 21:00:00', '2021-02-03 01:32:51', '2021-02-03 01:32:51');
INSERT INTO `question_flows` VALUES (8, 'Test Prep (ACT & SAT) (Copy)', 'landing-sat-flow', 'Version-1', NULL, '[]', '[\"App\\\\Jobs\\\\CompleteFlow\\\\CreateUserFromPreAuthTestPrepV1Flow\", \"App\\\\Jobs\\\\CompleteFlow\\\\AddToAcademicYearCollegeTestPrep\", \"App\\\\Jobs\\\\CompleteFlow\\\\SendLastJoinedNegotiationGroupWelcomeEmail\", \"App\\\\Jobs\\\\CompleteFlow\\\\ReportCollegeTestPrepViewContentToFacebook\", \"App\\\\Jobs\\\\CompleteFlow\\\\MarkSignUpProgressComplete\"]', 'App\\Redirects\\RedirectToPaymentPageForTestPrep', '2020-12-12 02:05:44', '2021-02-03 01:32:51', '2021-02-03 01:32:51');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
