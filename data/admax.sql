/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : admax

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 08/01/2021 19:23:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admax_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admax_admin_user`;
CREATE TABLE `admax_admin_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `last_login_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `group_id` int(11) NULL DEFAULT NULL,
  `create_time` int(11) NOT NULL DEFAULT 0,
  `update_time` int(11) NOT NULL DEFAULT 0,
  `last_login_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx_username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admax_admin_user
-- ----------------------------
INSERT INTO `admax_admin_user` VALUES (10, 'test', '$2y$10$UOifTkcVoxf5x7VPx0E1KeiN7x/yOGMuL5M.G/TFpzmAAsUlneqvq', 1, '127.0.0.1', 5, 1609160318, 1610097306, 1610097306);
INSERT INTO `admax_admin_user` VALUES (12, 'admin', '$2y$10$EP5JnOt8IjM/QDuuAX/EPugFIcg1XnXS7lhvdnlwtkBnUvcbEjP3i', 1, '127.0.0.1', 1, 1609321195, 1610097359, 1610097341);

-- ----------------------------
-- Table structure for admax_article
-- ----------------------------
DROP TABLE IF EXISTS `admax_article`;
CREATE TABLE `admax_article`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` int(11) NULL DEFAULT 0,
  `title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '????????????',
  `introduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '??????',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '????????????',
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '?????????',
  `is_recommend` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '????????????',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '????????????',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '????????????',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx_title`(`title`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admax_article
-- ----------------------------
INSERT INTO `admax_article` VALUES (2, 1, '??????1', '??????', '??????', '', 0, 1609408385, 1609408385);
INSERT INTO `admax_article` VALUES (3, 1, '??????1', '??????1', '', '', 0, 1609419635, 1609419635);
INSERT INTO `admax_article` VALUES (4, 1, '??????12', '??????1', '<p>??????1</p>', '', 1, 1609423058, 1609423632);

-- ----------------------------
-- Table structure for admax_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `admax_auth_group`;
CREATE TABLE `admax_auth_group`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` tinyint(1) NULL DEFAULT NULL,
  `rules` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `create_time` int(11) NULL DEFAULT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admax_auth_group
-- ----------------------------
INSERT INTO `admax_auth_group` VALUES (1, '???????????????', 1, '1,2,4,5,6,10,11,32,3,12,13,14,15,17,9,18,19,20,21,22,23,24,25,26,27,28,29,30,48,51,52,33,34,35,36,7,8,37,38,39,40,41,42,50,43,44,45,46,47,49', 1609056756, 1609734094);
INSERT INTO `admax_auth_group` VALUES (5, '?????????', 1, '1,24,25,26,27,28,29,30,7,8', 1609149369, 1609213485);

-- ----------------------------
-- Table structure for admax_auth_menu
-- ----------------------------
DROP TABLE IF EXISTS `admax_auth_menu`;
CREATE TABLE `admax_auth_menu`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '???id',
  `title` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '??????',
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '????????????',
  `href` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '??????',
  `params` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '????????????',
  `target` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '_iframe' COMMENT '??????????????????',
  `sort` int(11) NULL DEFAULT 0 COMMENT '????????????',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '??????(0:??????,1:??????)',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '??????',
  `create_time` int(11) NOT NULL COMMENT '????????????',
  `update_time` int(11) NOT NULL COMMENT '????????????',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `title`(`title`) USING BTREE,
  INDEX `href`(`href`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '???????????????' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of admax_auth_menu
-- ----------------------------
INSERT INTO `admax_auth_menu` VALUES (1, 0, '????????????', 'layui-icon layui-icon-set-fill', '', '', '_iframe', 0, 1, '', 1607173577, 1607185793);
INSERT INTO `admax_auth_menu` VALUES (2, 1, '????????????', 'layui-icon', 'menu/index', '', '_iframe', 0, 1, NULL, 1607173577, 1607184550);
INSERT INTO `admax_auth_menu` VALUES (3, 1, '???????????????', 'layui-icon', 'admin_user/index', '', '_iframe', 0, 1, NULL, 1607173577, 1607173577);
INSERT INTO `admax_auth_menu` VALUES (4, 2, '????????????', '', 'menu/create', '', '_iframe', 0, 0, NULL, 1607173577, 1607185687);
INSERT INTO `admax_auth_menu` VALUES (5, 2, '????????????', '', 'menu/index', '', '_iframe', 0, 0, NULL, 1607173577, 1607173577);
INSERT INTO `admax_auth_menu` VALUES (6, 2, '????????????', 'layui-icon-face-smile-fine', 'menu/edit', '', '_iframe', 0, 0, '', 1607173577, 1607184572);
INSERT INTO `admax_auth_menu` VALUES (7, 0, '????????????', 'layui-icon layui-icon-app', '', '', '_iframe', 0, 1, '', 1609042970, 1609043247);
INSERT INTO `admax_auth_menu` VALUES (8, 7, '????????????', 'layui-icon-face-smile-fine', 'tool/build', '', '_iframe', 0, 1, '', 1609043040, 1609043052);
INSERT INTO `admax_auth_menu` VALUES (9, 1, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'auth_group/index', '', '_iframe', 0, 1, '', 1609065316, 1609065316);
INSERT INTO `admax_auth_menu` VALUES (10, 2, '????????????', 'layui-icon layui-icon-face-smile-fine', 'menu/save', '', '_iframe', 0, 0, '', 1609166773, 1609166773);
INSERT INTO `admax_auth_menu` VALUES (11, 2, '????????????', 'layui-icon layui-icon-face-smile-fine', 'menu/update', '', '_iframe', 0, 0, '', 1609167061, 1609167061);
INSERT INTO `admax_auth_menu` VALUES (12, 3, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'admin_user/create', '', '_iframe', 0, 0, '', 1609167150, 1609167150);
INSERT INTO `admax_auth_menu` VALUES (13, 3, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'admin_user/delete', '', '_iframe', 0, 0, '', 1609167249, 1609167249);
INSERT INTO `admax_auth_menu` VALUES (14, 3, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'admin_user/save', '', '_iframe', 0, 0, '', 1609167292, 1609167292);
INSERT INTO `admax_auth_menu` VALUES (15, 3, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'admin_user/edit', '', '_iframe', 0, 0, '', 1609167310, 1609167310);
INSERT INTO `admax_auth_menu` VALUES (17, 3, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'admin_user/update', '', '_iframe', 0, 0, '', 1609167378, 1609167378);
INSERT INTO `admax_auth_menu` VALUES (18, 9, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'auth_group/create', '', '_iframe', 0, 0, '', 1609167502, 1609167502);
INSERT INTO `admax_auth_menu` VALUES (19, 9, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'auth_group/delete', '', '_iframe', 0, 0, '', 1609167528, 1609167528);
INSERT INTO `admax_auth_menu` VALUES (20, 9, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'auth_group/save', '', '_iframe', 0, 0, '', 1609167546, 1609167546);
INSERT INTO `admax_auth_menu` VALUES (21, 9, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'auth_group/update', '', '_iframe', 0, 0, '', 1609167587, 1609167587);
INSERT INTO `admax_auth_menu` VALUES (22, 9, '???????????????', 'layui-icon layui-icon-face-smile-fine', 'auth_group/edit', '', '_iframe', 0, 0, '', 1609167618, 1609167618);
INSERT INTO `admax_auth_menu` VALUES (23, 9, '????????????', 'layui-icon layui-icon-face-smile-fine', 'auth_group/menu', '', '_iframe', 0, 0, '', 1609167700, 1609167700);
INSERT INTO `admax_auth_menu` VALUES (24, 1, '????????????', 'layui-icon layui-icon layui-icon-face-smile-fine', '', '', '_iframe', 0, 0, '', 1609167772, 1609167788);
INSERT INTO `admax_auth_menu` VALUES (25, 24, '??????', 'layui-icon layui-icon-face-smile-fine', 'index/index', '', '_iframe', 0, 0, '', 1609167857, 1609167857);
INSERT INTO `admax_auth_menu` VALUES (26, 24, '?????????', 'layui-icon layui-icon layui-icon-face-smile-fine', 'index/welcome', '', '_iframe', 0, 0, '', 1609167875, 1609167890);
INSERT INTO `admax_auth_menu` VALUES (27, 24, '?????????', 'layui-icon layui-icon-face-smile-fine', 'index/initadmin', '', '_iframe', 0, 0, '', 1609167905, 1609167905);
INSERT INTO `admax_auth_menu` VALUES (28, 24, '?????????', 'layui-icon layui-icon-face-smile-fine', 'menu/initmenu', '', '_iframe', 0, 0, '', 1609167934, 1609167934);
INSERT INTO `admax_auth_menu` VALUES (29, 24, '??????', 'layui-icon layui-icon-face-smile-fine', 'login/logout', '', '_iframe', 0, 0, '', 1609167951, 1609167951);
INSERT INTO `admax_auth_menu` VALUES (30, 24, '????????????', 'layui-icon layui-icon-face-smile-fine', 'index/clear', '', '_iframe', 0, 0, '', 1609168067, 1609168067);
INSERT INTO `admax_auth_menu` VALUES (32, 2, '????????????', 'layui-icon layui-icon-face-smile-fine', 'menu/delete', '', '_iframe', 0, 0, '', 1609172291, 1609172291);
INSERT INTO `admax_auth_menu` VALUES (33, 1, '????????????', 'layui-icon layui-icon-face-smile-fine', 'system/index', '', '_iframe', 0, 1, '', 1609314005, 1609314005);
INSERT INTO `admax_auth_menu` VALUES (34, 33, '????????????', 'layui-icon layui-icon-face-smile-fine', 'system/update', '', '_iframe', 0, 0, '', 1609314151, 1609314151);
INSERT INTO `admax_auth_menu` VALUES (35, 1, '????????????', 'layui-icon layui-icon layui-icon-face-smile-fine', 'optimization/index', '', '_iframe', 0, 1, '', 1609340256, 1609340279);
INSERT INTO `admax_auth_menu` VALUES (36, 35, '????????????', 'layui-icon layui-icon-face-smile-fine', 'optimization/maintain', '', '_iframe', 0, 0, '', 1609341900, 1609341900);
INSERT INTO `admax_auth_menu` VALUES (37, 0, '????????????', 'layui-icon layui-icon-list', '', '', '_iframe', 0, 1, '', 1609399286, 1609399286);
INSERT INTO `admax_auth_menu` VALUES (38, 37, '????????????', 'layui-icon layui-icon-face-smile-fine', 'category/index', '', '_iframe', 0, 1, '', 1609399322, 1609399322);
INSERT INTO `admax_auth_menu` VALUES (39, 38, '????????????', 'layui-icon layui-icon-face-smile-fine', 'category/create', '', '_iframe', 0, 0, '', 1609399364, 1609399364);
INSERT INTO `admax_auth_menu` VALUES (40, 38, '????????????', 'layui-icon layui-icon-face-smile-fine', 'category/save', '', '_iframe', 0, 0, '', 1609399385, 1609399385);
INSERT INTO `admax_auth_menu` VALUES (41, 38, '????????????', 'layui-icon layui-icon-face-smile-fine', 'category/edit', '', '_iframe', 0, 0, '', 1609399408, 1609399408);
INSERT INTO `admax_auth_menu` VALUES (42, 38, '????????????', 'layui-icon layui-icon-face-smile-fine', 'category/update', '', '_iframe', 0, 0, '', 1609399441, 1609399441);
INSERT INTO `admax_auth_menu` VALUES (43, 37, '????????????', 'layui-icon layui-icon-face-smile-fine', 'article/index', '', '_iframe', 0, 1, '', 1609399482, 1609399482);
INSERT INTO `admax_auth_menu` VALUES (44, 43, '????????????', 'layui-icon layui-icon-face-smile-fine', 'article/create', '', '_iframe', 0, 0, '', 1609399503, 1609399503);
INSERT INTO `admax_auth_menu` VALUES (45, 43, '????????????', 'layui-icon layui-icon-face-smile-fine', 'article/save', '', '_iframe', 0, 0, '', 1609399532, 1609399532);
INSERT INTO `admax_auth_menu` VALUES (46, 43, '????????????', 'layui-icon layui-icon-face-smile-fine', 'article/edit', '', '_iframe', 0, 0, '', 1609399561, 1609399561);
INSERT INTO `admax_auth_menu` VALUES (47, 43, '????????????', 'layui-icon layui-icon-face-smile-fine', 'article/update', '', '_iframe', 0, 0, '', 1609399582, 1609399582);
INSERT INTO `admax_auth_menu` VALUES (48, 24, '????????????', 'layui-icon layui-icon-face-smile-fine', 'upload/upload', '', '_iframe', 0, 0, '', 1609406768, 1609406768);
INSERT INTO `admax_auth_menu` VALUES (49, 43, '????????????', 'layui-icon layui-icon-face-smile-fine', 'article/delete', '', '_iframe', 0, 0, '', 1609409885, 1609409885);
INSERT INTO `admax_auth_menu` VALUES (50, 38, '????????????', 'layui-icon layui-icon-face-smile-fine', 'category/delete', '', '_iframe', 0, 0, '', 1609409906, 1609409906);
INSERT INTO `admax_auth_menu` VALUES (51, 24, '????????????', 'layui-icon layui-icon-face-smile-fine', 'password/index', '', '_iframe', 0, 0, '', 1609732192, 1609732192);
INSERT INTO `admax_auth_menu` VALUES (52, 51, '????????????', 'layui-icon layui-icon-face-smile-fine', 'password/update', '', '_iframe', 0, 0, '', 1609732234, 1609732234);

-- ----------------------------
-- Table structure for admax_category
-- ----------------------------
DROP TABLE IF EXISTS `admax_category`;
CREATE TABLE `admax_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '????????????',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '??????',
  `status` tinyint(1) UNSIGNED NULL DEFAULT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx_title`(`title`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admax_category
-- ----------------------------
INSERT INTO `admax_category` VALUES (1, '?????????', 0, '', 0, 1, 1609408385, 1609423088);
INSERT INTO `admax_category` VALUES (2, '?????????', 1, '', 0, 1, 1609409098, 1609409098);

-- ----------------------------
-- Table structure for admax_system
-- ----------------------------
DROP TABLE IF EXISTS `admax_system`;
CREATE TABLE `admax_system`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '??????',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admax_system
-- ----------------------------
INSERT INTO `admax_system` VALUES (1, '{\"site_title\":\"Admax\",\"keywords\":\"Admax\",\"description\":\"Admax\",\"is_sms\":\"0\",\"is_oss\":\"0\"}');

-- ----------------------------
-- Table structure for admax_system_log
-- ----------------------------
DROP TABLE IF EXISTS `admax_system_log`;
CREATE TABLE `admax_system_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `url` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 75 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admax_system_log
-- ----------------------------
INSERT INTO `admax_system_log` VALUES (69, 12, 'index/index', 'GET', '127.0.0.1', 1609339887);
INSERT INTO `admax_system_log` VALUES (70, 12, 'index/initadmin', 'GET', '127.0.0.1', 1609339887);
INSERT INTO `admax_system_log` VALUES (71, 12, 'menu/initmenu', 'GET', '127.0.0.1', 1609339888);
INSERT INTO `admax_system_log` VALUES (72, 12, 'index/welcome', 'GET', '127.0.0.1', 1609339888);
INSERT INTO `admax_system_log` VALUES (73, 12, 'admin_user/index', 'GET', '127.0.0.1', 1609339892);
INSERT INTO `admax_system_log` VALUES (74, 12, 'admin_user/index', 'GET', '127.0.0.1', 1609339893);

SET FOREIGN_KEY_CHECKS = 1;
