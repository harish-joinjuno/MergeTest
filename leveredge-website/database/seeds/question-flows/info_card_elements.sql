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

 Date: 29/01/2021 23:18:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for info_card_elements
-- ----------------------------
DROP TABLE IF EXISTS `info_card_elements`;
CREATE TABLE `info_card_elements` (
                                      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                      `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                      `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `description` text COLLATE utf8mb4_unicode_ci,
                                      `info_card_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `info_card_id` bigint(20) unsigned NOT NULL,
                                      `created_at` timestamp NULL DEFAULT NULL,
                                      `updated_at` timestamp NULL DEFAULT NULL,
                                      PRIMARY KEY (`id`),
                                      KEY `info_card_elements_info_card_type_info_card_id_index` (`info_card_type`,`info_card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of info_card_elements
-- ----------------------------
BEGIN;
INSERT INTO `info_card_elements` VALUES (1, 'img/hands-on-laptop-with-coffee.png', 'How this works', '<div>The next step is to check out the deal(s) we recommend for you by clicking below. You will then be able to click through to the lending partner(s)\' site and start the process there!&nbsp;</div>', 'App\\NegotiationGroupEndScreen', 1, '2020-06-17 02:14:50', '2020-08-19 20:10:05');
INSERT INTO `info_card_elements` VALUES (2, 'img/together.png', 'Ask us anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 1, '2020-06-17 02:16:10', '2020-09-25 18:48:02');
INSERT INTO `info_card_elements` VALUES (3, 'img/hands-on-laptop-with-coffee.png', 'How this works', '<div>The next step is to check out the deal(s) we recommend for you by clicking below. You will then be able to click through to the lending partner(s)\' site and start the process there!&nbsp;</div>', 'App\\NegotiationGroupEndScreen', 2, '2020-06-17 23:40:35', '2020-08-19 20:11:42');
INSERT INTO `info_card_elements` VALUES (4, 'img/together.png', 'Ask us anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 2, '2020-06-17 23:44:11', '2020-09-25 18:48:05');
INSERT INTO `info_card_elements` VALUES (5, 'img/hands-on-laptop-with-coffee.png', 'How this works', '<div>The next step is to check out the deal we have for you by clicking below. You will then be able to click through to the lender\'s site and start the process there!&nbsp;</div>', 'App\\NegotiationGroupEndScreen', 3, '2020-06-17 23:45:56', '2020-08-19 20:13:52');
INSERT INTO `info_card_elements` VALUES (6, 'img/together.png', 'Ask us anything!', '<div>We’re happy to chat if there’s anything on your mind. You can<a href=\"https://joinjuno.com/contact\"> email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 3, '2020-06-17 23:48:39', '2020-09-25 18:48:06');
INSERT INTO `info_card_elements` VALUES (7, 'img/hands-on-laptop-with-coffee.png', 'Get help evaluating all your options', '<div>See what Nomad Credit can do for you by clicking through to the dashboard.</div>', 'App\\NegotiationGroupEndScreen', 4, '2020-06-17 23:54:09', '2020-06-17 23:54:09');
INSERT INTO `info_card_elements` VALUES (8, '/img/together.png', 'Ask us anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 4, '2020-06-17 23:55:01', '2020-09-25 18:48:07');
INSERT INTO `info_card_elements` VALUES (9, 'img/hands-on-laptop-with-coffee.png', 'Get help evaluating your options', '<div>See if Nomad Credit can help you by clicking through to your dashboard.</div>', 'App\\NegotiationGroupEndScreen', 5, '2020-06-17 23:56:43', '2020-06-17 23:56:43');
INSERT INTO `info_card_elements` VALUES (10, 'img/together.png', 'Ask us anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 5, '2020-06-17 23:57:36', '2020-09-25 18:48:08');
INSERT INTO `info_card_elements` VALUES (11, 'img/hands-on-laptop-with-coffee.png', 'Deals are ready!', '<div>See if you are eligible for our deals by clicking through to your dashboard.</div>', 'App\\NegotiationGroupEndScreen', 6, '2020-06-18 00:00:52', '2020-06-18 00:01:45');
INSERT INTO `info_card_elements` VALUES (12, 'img/together.png', 'Ask us anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 6, '2020-06-18 00:02:45', '2020-09-25 18:48:09');
INSERT INTO `info_card_elements` VALUES (13, 'img/hands-on-laptop-with-coffee.png', 'Let\'s save some money together', '<div>Click below to check out the campaign page, join the discussion and help grow the group so we can try to get international students an exclusive refinancing deal!</div>', 'App\\NegotiationGroupEndScreen', 9, '2020-06-19 01:29:52', '2020-11-09 20:23:39');
INSERT INTO `info_card_elements` VALUES (14, 'img/together.png', 'Ask us anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 9, '2020-06-19 01:30:30', '2020-09-25 18:48:11');
INSERT INTO `info_card_elements` VALUES (15, 'img/hands-on-laptop-with-coffee.png', 'Check out the deals', '<div>The next step is to fill out a few quick questions by clicking below so we can recommend the best deal(s) for you!</div>', 'App\\NegotiationGroupEndScreen', 8, '2020-06-19 01:31:50', '2020-08-21 02:35:03');
INSERT INTO `info_card_elements` VALUES (16, 'img/together.png', 'Ask us Anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 8, '2020-06-19 01:31:58', '2020-09-25 18:48:14');
INSERT INTO `info_card_elements` VALUES (17, 'img/together.png', 'Please contact us about this error by clicking the button below!', NULL, 'App\\NegotiationGroupEndScreen', 7, '2020-06-19 01:33:43', '2020-06-19 01:33:43');
INSERT INTO `info_card_elements` VALUES (18, 'img/hands-on-laptop-with-coffee.png', 'Check Out the Deal', '<div>To see what we recommend for your situation, fill out a few quick questions by clicking below!</div>', 'App\\NegotiationGroupEndScreen', 10, '2020-07-02 03:12:05', '2020-08-21 02:37:03');
INSERT INTO `info_card_elements` VALUES (19, 'img/together.png', 'Ask us Anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 10, '2020-07-02 03:12:35', '2020-09-25 18:49:36');
INSERT INTO `info_card_elements` VALUES (20, 'img/hands-on-laptop-with-coffee.png', 'Check Out the Deals', '<div>To see what we recommend for your situation, fill out three quick questions by clicking below!</div>', 'App\\NegotiationGroupEndScreen', 11, '2020-07-02 03:13:43', '2020-08-21 02:36:05');
INSERT INTO `info_card_elements` VALUES (21, 'img/together.png', 'Ask us Anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 11, '2020-07-02 03:13:59', '2020-09-25 18:49:38');
INSERT INTO `info_card_elements` VALUES (22, 'img/hands-on-laptop-with-coffee.png', 'Check Out the Deal', '<div>To see what we recommend for your situation, fill out three quick questions by clicking below!</div>', 'App\\NegotiationGroupEndScreen', 12, '2020-07-02 03:16:32', '2020-08-20 04:12:33');
INSERT INTO `info_card_elements` VALUES (23, 'img/together.png', 'Ask us Anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 12, '2020-07-02 03:16:48', '2020-09-25 18:49:39');
INSERT INTO `info_card_elements` VALUES (24, 'img/hands-on-laptop-with-coffee.png', 'Check Out the Deal', '<div>To see what we recommend for your situation, fill out three quick questions by clicking below!</div>', 'App\\NegotiationGroupEndScreen', 13, '2020-07-02 03:18:52', '2020-08-20 04:13:06');
INSERT INTO `info_card_elements` VALUES (25, 'img/together.png', 'Ask us Anything!', '<div>We’re happy to chat if there’s anything on your mind. You can <a href=\"https://joinjuno.com/contact\">email or call us here.</a></div>', 'App\\NegotiationGroupEndScreen', 13, '2020-07-02 03:19:10', '2020-09-25 18:49:41');
INSERT INTO `info_card_elements` VALUES (26, 'img/hands-on-laptop-with-coffee.png', 'How it works', '<div>The next step is with GBG! Click below to start the process with them and save thousands on your health insurance plan.</div>', 'App\\NegotiationGroupEndScreen', 14, '2020-08-18 01:29:20', '2020-08-18 01:53:29');
INSERT INTO `info_card_elements` VALUES (27, 'img/together.png', 'We\'re here for you', '<div>Let us know if you have any questions by emailing <a href=\"mailto:support@joinjuno.com\">support@joinjuno.com</a> or calling <a href=\"tel:3392290910\">(339) 229-0910</a>.</div>', 'App\\NegotiationGroupEndScreen', 14, '2020-08-18 01:31:12', '2020-09-25 18:49:43');
INSERT INTO `info_card_elements` VALUES (28, 'img/hands-on-laptop-with-coffee.png', 'Coming soon!', '<div>We\'re working hard on finding a partner that can provide coverage at your school. Go to your dashboard for updates!</div>', 'App\\NegotiationGroupEndScreen', 15, '2020-08-18 01:35:44', '2020-08-18 01:35:44');
INSERT INTO `info_card_elements` VALUES (29, 'img/together.png', 'Ask us Anything!', '<div>If you have any questions or suggestions, please contact us at <a href=\"mailto:hello@joinjuno.com\">support@joinjuno.com</a>.&nbsp;</div>', 'App\\NegotiationGroupEndScreen', 15, '2020-08-18 01:36:57', '2020-09-25 18:49:55');
INSERT INTO `info_card_elements` VALUES (30, 'img/hands-on-laptop-with-coffee.png', 'How it works', '<div>The next step is going to the insurance provider\'s portal by clicking the button below!&nbsp;</div>', 'App\\NegotiationGroupEndScreen', 17, '2020-08-19 00:50:47', '2020-08-19 00:50:47');
INSERT INTO `info_card_elements` VALUES (31, 'img/together.png', 'We\'re here for you', '<div>If you have any questions, you can contact us at <a href=\"mailto:support@joinjuno.com\">support@joinjuno.com</a>.</div>', 'App\\NegotiationGroupEndScreen', 17, '2020-08-19 00:51:48', '2020-09-25 18:50:03');
INSERT INTO `info_card_elements` VALUES (32, 'img/hands-on-laptop-with-coffee.png', 'We\'re working hard to get you coverage', '<div>You can go to your dashboard by clicking below to view the latest updates.</div>', 'App\\NegotiationGroupEndScreen', 18, '2020-08-19 00:53:23', '2020-08-19 00:53:23');
INSERT INTO `info_card_elements` VALUES (33, 'img/together.png', 'Ask us Anything!', '<div>If you have any questions or suggestions, you can email us at <a href=\"mailto:support@joinjuno.com\">support@joinjuno.com.&nbsp;</a></div>', 'App\\NegotiationGroupEndScreen', 18, '2020-08-19 00:54:16', '2020-09-25 18:50:05');
INSERT INTO `info_card_elements` VALUES (34, 'img/hands-on-laptop-with-coffee.png', 'Let\'s save some money together', '<div>Click below to check out the campaign page, join the discussion and help grow the group!</div>', 'App\\NegotiationGroupEndScreen', 19, '2020-10-22 22:49:09', '2020-10-22 22:49:09');
INSERT INTO `info_card_elements` VALUES (35, 'img/together.png', 'Ask us anything!', '<div>We\'re here to answer any questions, just <a href=\"https://joinjuno.com/contact\">drop us a line or give us a call.</a></div>', 'App\\NegotiationGroupEndScreen', 19, '2020-10-22 22:50:29', '2020-10-22 22:50:29');
INSERT INTO `info_card_elements` VALUES (36, 'img/hands-on-laptop-with-coffee.png', 'Let\'s save some money together', '<div>Click below to check out the Bar Prep campaign page, join the discussion and help grow the group!</div>', 'App\\NegotiationGroupEndScreen', 20, '2020-10-22 22:49:09', '2020-10-30 19:18:42');
INSERT INTO `info_card_elements` VALUES (37, 'img/together.png', 'Ask us anything!', '<div>We\'re here to answer any questions, just <a href=\"https://joinjuno.com/contact\">drop us a line or give us a call.</a></div>', 'App\\NegotiationGroupEndScreen', 20, '2020-10-22 22:50:29', '2020-10-22 22:50:29');
INSERT INTO `info_card_elements` VALUES (38, 'img/hands-on-laptop-with-coffee.png', 'Let\'s save some money together', '<div>Click below to check out the campaign page, join the discussion and help grow the group so we call save more on student loans!</div>', 'App\\NegotiationGroupEndScreen', 21, '2020-10-22 22:49:09', '2020-11-09 20:13:43');
INSERT INTO `info_card_elements` VALUES (39, 'img/together.png', 'Ask us anything!', '<div>We\'re here to answer any questions, just <a href=\"https://joinjuno.com/contact\">drop us a line or give us a call.</a></div>', 'App\\NegotiationGroupEndScreen', 21, '2020-10-22 22:50:29', '2020-10-22 22:50:29');
INSERT INTO `info_card_elements` VALUES (40, 'img/hands-on-laptop-with-coffee.png', 'Let\'s save some money together', '<div>Click below to check out the campaign page, join the discussion and help grow the group so we can try to get international students an exclusive deal this year!</div>', 'App\\NegotiationGroupEndScreen', 22, '2020-10-22 22:49:09', '2020-11-09 20:16:39');
INSERT INTO `info_card_elements` VALUES (41, 'img/together.png', 'Ask us anything!', '<div>We\'re here to answer any questions, just <a href=\"https://joinjuno.com/contact\">drop us a line or give us a call.</a></div>', 'App\\NegotiationGroupEndScreen', 22, '2020-10-22 22:50:29', '2020-10-22 22:50:29');
INSERT INTO `info_card_elements` VALUES (42, 'img/hands-on-laptop-with-coffee.png', 'Let\'s save some money together', '<div>Click below to check out the test prep campaign page, join the discussion and help grow the group!</div>', 'App\\NegotiationGroupEndScreen', 23, '2020-12-02 20:25:32', '2020-12-04 01:39:18');
INSERT INTO `info_card_elements` VALUES (43, 'img/together.png', 'Ask us anything!', '<div>We\'re here to answer any questions, just <a href=\"https://joinjuno.com/contact\">drop us a line or give us a call.</a></div>', 'App\\NegotiationGroupEndScreen', 23, '2020-12-02 20:26:15', '2020-12-02 20:26:15');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
