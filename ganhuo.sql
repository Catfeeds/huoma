/*
Navicat MySQL Data Transfer

Source Server         : loca
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : ganhuo

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-15 15:36:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `xhl_admin`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_admin`;
CREATE TABLE `xhl_admin` (
  `admin_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(15) DEFAULT '',
  `realname` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `qq` varchar(15) DEFAULT NULL,
  `passwd` char(32) DEFAULT '',
  `role_id` smallint(6) DEFAULT '0',
  `last_login` int(10) DEFAULT '0',
  `last_ip` varchar(15) DEFAULT '0.0.0.0',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_admin
-- ----------------------------
INSERT INTO `xhl_admin` VALUES ('1', 'admin', null, null, null, '0870813a78b21cea3d029c58ddf873f3', '1', '1533026970', '127.0.0.1', '0', '1416406592');

-- ----------------------------
-- Table structure for `xhl_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_admin_role`;
CREATE TABLE `xhl_admin_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) DEFAULT '',
  `role` enum('editor','admin','system','developer') DEFAULT NULL,
  `priv` mediumtext,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_admin_role
-- ----------------------------
INSERT INTO `xhl_admin_role` VALUES ('1', '系统管理员', 'system', '');
INSERT INTO `xhl_admin_role` VALUES ('2', '开发人员', 'developer', '119,120,121,122,123,124,125,126,128,104,106,108,112,114,107,105,111,110,109,113,116,117,118');
INSERT INTO `xhl_admin_role` VALUES ('3', '管理员', 'admin', '48,49,50,51,52,54,55,56,8,26,28,35,27,9,33,31,32,386,470,471,902,731,733,833,500,888,889,890,506,516,885,886,887,894,895,896,517,287,288,289,290,291,297,298,299,301,302,415,553,577,578,579,326,418,327,328,330,331,223,224,228,229,456,671,142,383,384,385,144,146,189,430,562,419,420,570,602,919,622,623,624,626,627,633,634,636,637,638,639,641,642,643,644,646,658,659,660,662,663,664,665,667,668,703,704,705,707,710,711,712,714,715,716,734,834,835,836,838,628,629,630,632,635,839,840,841,843,648,649,650,651,692,708,709,653,918,654,655,657,717,742,724,725,726,727,728,736,784,785,786,787,789,790,719,735,737,738,739,741,832,850,851,852,720,721,722,730,794,795,796,798,799,827,828,829,830,745,746,747,748,750,792,763,764,765,767,793,821,822,823,825,826,769,770,771,773,774,775,776,778,779,801,802,803,804,806,807,809,810,811,812,813,815,572,573,574,576,581,582,583,584,585,593,587,588,589,590,591,683,684,685,594,595,596,598,619,603,607,620,621,693,694,695,697,698,699,700,702,816,817,818,820,903,904,905,907,908,909,910,911,912,913,914,916,917,608,609,610,612,613,614,615,616,618,844,845,846,848,849,687,688,689,691,672,673,674,676,677,678,679,680,681,682,752,753,754,756,757,758,759,760,762,854,855,856,858,859,861,862,863,865,866,867,868,869,871,872,873,874,875,877,878,879,880,881,883,884,780,781,782,410,411,412,484,485,486,487,488,490,491,492,561,113,114,115,116,119,120,123,124,515,338,339,340,341,333,344,335,337,345,346,347,349,565,566,567,569,586,479,480,481,482,474,475,476,477,502,503,504,275,277,278,343,554,245,560');
INSERT INTO `xhl_admin_role` VALUES ('4', '监理部', 'editor', '1317,1321,1334,1339,1370');
INSERT INTO `xhl_admin_role` VALUES ('12', '商务总监', 'editor', '1284,1285,1286,1327,1328,1338,622,623,624,625,626,627,633,634,638,639,640,641,642,643,644,645,646,991,637,703,704,705,706,707,710,711,712,713,714,715,716,734,1312,1184,1348,1185,1186,1193,1196,1197,1198,1199,1287,1309,1314,1320,1321,1322,1323,1324,1325,1333,1334,1335,1336,1337,1349,1350,1351,1352,1353,1354,1357,1359,1360,1363,1370,1371,1372,1373,1374,1377,1308,1310,1311,1326,1330,1313');
INSERT INTO `xhl_admin_role` VALUES ('5', '客服', 'editor', '1284,1285,1184,1185,1186,1187,1188,1189,1190,1191,1192,1193,1194,1195,1196,1197,1198,1199,1287,1309,1320,1325');
INSERT INTO `xhl_admin_role` VALUES ('6', '设计总监', 'editor', '430,628,629,630,631,632,635,935,839,840,841,842,843,954,1051,1052,1053,1054,1055,1064,1065,1066,1067,1068,1100,1375,1185,1186,1194,1315,1321,1329,1334,1364,1376,608,609,610,611,612,613,614,615,616,617,618,844,845,846,847,848,849,1031,1331,1243,1244,1245,1246,1247,1248,1249,1250,1251,1252,1253,1254,1255,1256,1257,1258,1259,1260,1308,1310,1311,1332,1356,780,781,782,783,410,411,412,413,485,486,487,488,489,490,491,492,561,1023,1024,752,753,754,755,756,757,758,759,760,761,762,854,855,856,857,858,859,1050');
INSERT INTO `xhl_admin_role` VALUES ('7', '工程中心', 'editor', '1313,622,623,624,625,626,627,633,634,638,639,640,641,642,643,644,645,646,991,658,659,660,661,662,663,664,665,666,667,668,956,637,703,704,705,706,707,710,711,712,713,714,715,716,734,834,835,836,837,838,953,957,1312,1185,1193,1196,1309,1316,1320,1321,1322,1324,1325,1308,1310,1311,1326');
INSERT INTO `xhl_admin_role` VALUES ('8', '执行经理', 'editor', '919,1284,1285,1327,1328,1185,1186,1287,1309,1314,1321,1322,1323,1324,1333,1334,1335,1363,1365,1370,1377,1308,1310,1326,1200,1201,1202,1204,1208,1205,1207,1212,1235,1241,1307,1281,1282,1264,1268,1265,1267');
INSERT INTO `xhl_admin_role` VALUES ('9', '财务', 'editor', '1318,1361,1362,1367');
INSERT INTO `xhl_admin_role` VALUES ('10', '老板', 'editor', null);
INSERT INTO `xhl_admin_role` VALUES ('11', '工厂编辑', 'editor', '142,383,919,622,623,624,626,633,634,608,1344,1345,1346,1347,1200,1201,1202,1204,1208,1205,1207,1209,1281,1282,1262,1264,1268,1265,1267,1269,1276,1277,1278,338,339,340,1182,341,992,479,480,481,482,474,475,476,477');
INSERT INTO `xhl_admin_role` VALUES ('13', '运营总监', 'editor', '338,339,340,1182,341,992,342,333,344,335,336,337,586,345,346,347,348,349,565,566,567,568,569,921,479,480,481,482,483,474,475,476,477,478,502,503,504,505');

-- ----------------------------
-- Table structure for `xhl_archives`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_archives`;
CREATE TABLE `xhl_archives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(155) NOT NULL,
  `url` varchar(155) NOT NULL,
  `keywords` varchar(155) DEFAULT '' COMMENT '文章关键词',
  `description` varchar(155) DEFAULT '' COMMENT '文章的描述',
  `typeid` int(5) NOT NULL DEFAULT '1' COMMENT '文章栏目id',
  `sort` int(3) NOT NULL DEFAULT '1' COMMENT '文章权重',
  `cnum` int(10) NOT NULL DEFAULT '2' COMMENT '文章点击次数',
  `writer` varchar(155) NOT NULL DEFAULT 'admin' COMMENT '文章作者',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_archives
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_article`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_article`;
CREATE TABLE `xhl_article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xiangmu_id` int(10) unsigned DEFAULT NULL COMMENT '项目id',
  `city_id` smallint(6) DEFAULT '0',
  `cat_id` mediumint(8) unsigned DEFAULT '0',
  `from` enum('article','about','help','page') DEFAULT 'article',
  `page` varchar(15) DEFAULT '',
  `title` varchar(200) DEFAULT '',
  `thumb` varchar(150) DEFAULT '',
  `desc` varchar(255) DEFAULT '',
  `views` mediumint(8) DEFAULT '0',
  `favorites` mediumint(8) DEFAULT '0',
  `allow_comment` tinyint(1) DEFAULT '0',
  `comments` mediumint(8) DEFAULT '0',
  `photos` smallint(6) DEFAULT '0',
  `linkurl` varchar(255) DEFAULT '',
  `ontime` int(10) DEFAULT '0',
  `hidden` tinyint(1) DEFAULT '0',
  `orderby` smallint(6) unsigned DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) unsigned DEFAULT '0',
  `dateline` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`article_id`),
  KEY `cat_id` (`cat_id`,`from`,`audit`,`closed`,`hidden`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=407 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_article
-- ----------------------------
INSERT INTO `xhl_article` VALUES ('403', null, '0', '114', 'article', '', '博飞特（上海）汽车设备', 'photo/201805/20180525_D8D2B326A09131C82DC711849552195C.png', '博飞特（上海）汽车设备设计', '14', '0', '1', '0', '0', '', '0', '0', '501', '1', '0', '1492995532');
INSERT INTO `xhl_article` VALUES ('404', null, '0', '114', 'article', '', '上海域圆信息科技有限公司', 'photo/201805/20180525_D8D2B326A09131C82DC711849552195C.png', '上海域圆信息科技有限公司深度专注于虚拟现实和增强显示（AVR）技术的高科技公司。域圆科技定位于通过技术品台的商业化打造高质量的快速体验方案', '11', '0', '1', '0', '0', '', '0', '0', '50', '1', '0', '1508480460');
INSERT INTO `xhl_article` VALUES ('405', null, '0', '114', 'article', '', '习近平推崇的英雄精神', 'photo/201805/20180525_D8D2B326A09131C82DC711849552195C.png', '　　缅怀英烈祭忠魂，抚今追昔思奋进。党的十八大以来，习近平总书记踏寻英雄、缅怀英烈的足迹遍布祖国的大江南北。铭记历史、缅怀英烈，一直是习近平总书记情之所牵、行之所至。\r\n\r\n　　英雄精神一直是习近平总书记推崇和倡导的。“党和人民需要我们献身的时候，我们都要毫不犹豫挺身而出，把个人生死置之度外。我们都做不到，让谁去做？”习近平总书记在中共中央政治局民主生活会上的话语直抵人心。', '220', '0', '1', '0', '0', '', '0', '0', '50', '1', '0', '1527243889');
INSERT INTO `xhl_article` VALUES ('406', null, '0', '114', 'article', '', '水源地专项督查曝光第二批环境违法问题', 'photo/201805/20180525_D8D2B326A09131C82DC711849552195C.png', '水源地专项督查曝光第二批环境违法问题', '59', '0', '1', '0', '0', '', '0', '0', '500', '1', '0', '1527474946');

-- ----------------------------
-- Table structure for `xhl_articleinfo`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_articleinfo`;
CREATE TABLE `xhl_articleinfo` (
  `aid` int(11) NOT NULL COMMENT '文章对应的id',
  `body` text NOT NULL,
  `typeid` int(5) NOT NULL DEFAULT '1' COMMENT '文章栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_articleinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_article_cate`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_article_cate`;
CREATE TABLE `xhl_article_cate` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned DEFAULT '0',
  `title` varchar(150) DEFAULT '',
  `level` tinyint(1) unsigned DEFAULT '1',
  `from` enum('about','help','page','article') DEFAULT 'article',
  `seo_title` varchar(255) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(255) DEFAULT '',
  `orderby` smallint(6) unsigned DEFAULT '50',
  `hidden` tinyint(1) DEFAULT '0',
  `dateline` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_article_cate
-- ----------------------------
INSERT INTO `xhl_article_cate` VALUES ('114', '0', '需求文案', '1', 'article', '需求文案 发布需求', '需求文案', '需求文案', '1', '0', '1508480106');

-- ----------------------------
-- Table structure for `xhl_article_collect`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_article_collect`;
CREATE TABLE `xhl_article_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL COMMENT '项目id',
  `uid` int(11) NOT NULL COMMENT '用户名id',
  `dateline` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_article_collect
-- ----------------------------
INSERT INTO `xhl_article_collect` VALUES ('60', '406', '1122', '1527572699');
INSERT INTO `xhl_article_collect` VALUES ('63', '406', '1127', '1527596620');
INSERT INTO `xhl_article_collect` VALUES ('64', '405', '1127', '1528353651');
INSERT INTO `xhl_article_collect` VALUES ('61', '406', '1123', '1527572699');

-- ----------------------------
-- Table structure for `xhl_article_comment`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_article_comment`;
CREATE TABLE `xhl_article_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `content` text,
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_article_comment
-- ----------------------------
INSERT INTO `xhl_article_comment` VALUES ('19', '405', '1127', '<p>测试的<img src=\"/ueditor/php/upload/image/20180529/1527585048227465.png\" title=\"1527585048227465.png\" alt=\"bn3.png\"/></p>', '0', '0.0.0.0', '1527585049');
INSERT INTO `xhl_article_comment` VALUES ('20', '405', '1127', '<p>啊的答案是否定的</p>', '0', '0.0.0.0', '1527585056');
INSERT INTO `xhl_article_comment` VALUES ('21', '405', '1127', '<p>分开撒家乐福会计师的离开了离开房间了看电视付了款浪费类似老扩看风景l水电费科技</p><p>地方隆盛科技</p><p>水电费空间登录</p><p>的斯洛伐克吉林省</p>', '0', '0.0.0.0', '1527585084');
INSERT INTO `xhl_article_comment` VALUES ('22', '403', '1127', '<p>dddd</p>', '0', '0.0.0.0', '1527586064');
INSERT INTO `xhl_article_comment` VALUES ('23', '405', '1127', '<p>sdadasda</p>', '0', '0.0.0.0', '1527586157');
INSERT INTO `xhl_article_comment` VALUES ('24', '406', '1127', '<p>ssadsa</p>', '0', '0.0.0.0', '1527596623');
INSERT INTO `xhl_article_comment` VALUES ('18', '405', '1127', '<p>ttt</p>', '0', '0.0.0.0', '1527585013');
INSERT INTO `xhl_article_comment` VALUES ('25', '406', '1127', '<p>爱上的双丰收</p>', '0', '0.0.0.0', '1529056256');

-- ----------------------------
-- Table structure for `xhl_article_content`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_article_content`;
CREATE TABLE `xhl_article_content` (
  `content_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) NOT NULL,
  `seo_title` varchar(150) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(255) DEFAULT '',
  `content` mediumtext,
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  PRIMARY KEY (`content_id`),
  KEY `article_id` (`article_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=407 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_article_content
-- ----------------------------
INSERT INTO `xhl_article_content` VALUES ('403', '403', '', '', '', '<span> <h2 class=\"det-left-title\" style=\"font-size:12px;color:#333333;font-family:\" background-color:#ffffff;\"=\"\">\r\n	定未品牌策划出品，博飞特画册设计。 博飞特（上海）汽车设备自动化有限公司，成立于2011年，公司经营范围包括汽车车身自动化生产线的生产、研发、销售，汽车零配件等。 画册设计采用现代几何的构图方式，以深灰+蓝色+白色作为主色调，整体简约大气充满科技感，凸显汽车智能化的行业特征。\r\n	</h2>\r\n<img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C1.jpg/origine/977efe8c-bb1b-4cec-8b80-b0b3f13647a9\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C2.jpg/origine/0cc1e475-d0f1-4510-8131-6f9dff5323d3\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C3.jpg/origine/08f40320-5293-4022-aa0c-1fc97fed69ed\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C4.jpg/origine/e5319198-7d38-46c5-8479-c3ca8ea979d8\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C5.jpg/origine/1c450d67-9c4a-455c-9e44-35fb026f6ae3\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C6.jpg/origine/576c5cc1-2318-49b6-a0b3-d0ba6e6a7f9e\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C7.jpg/origine/57baaef1-c183-44ce-9db1-6f85f9b1a608\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C8.jpg/origine/424f4f43-0600-4877-9130-50bac9d1222e\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C9.jpg/origine/4340d11e-e90c-4157-8c0a-805e114c499d\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C10.jpg/origine/e704b1ed-69c3-49b9-b642-0a3cceecf1b4\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/%E5%8D%9A%E9%A3%9E%E7%89%B9%E7%94%BB%E5%86%8C%E6%95%88%E6%9E%9C11.jpg/origine/9b4e8358-a39b-4598-9171-680a0b382d2f\" alt=\"网站建设案例_上海博飞特画册\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /></span> \r\n	<p>\r\n		<br />\r\n	</p>', '127.0.0.1');
INSERT INTO `xhl_article_content` VALUES ('404', '404', '', '', '', '<h2 class=\"det-left-title\" style=\"font-size:12px;color:#333333;font-family:&quot;background-color:#FFFFFF;\">\r\n	客户简介 上海域圆信息科技有限公司（UGION Iechnology）,是一家深度专注于虚拟现实和增强显示（AVR）技术的高科技公司。域圆科技定位于通过技术品台的商业化打造高质量的快速体验方案，让AVR技术以快速简便的应用方式落地到教育培训、展示营销等商业环节。域圆科技的核心团队在虚拟技术开发、人机互动、产品规划、销售等领域拥有十多年的 成功经验。所领导或参与的经典项目都成为各个行业的风向标。总部在上海，在北京、武汉、南京、西安均有分支机构。 案例背景 2016年上海域圆信息科技有限公司发展战略是拓宽线上渠道扩大销售规模，需要建立自己的门户网站，通过多方对比后通过猪八戒网选择了啄木鸟为其设计制作开发企业网站。 实施过程 啄木鸟项目负责人，在接到订单后对域圆科技的网站需求进行了完整的分析，并于客户进行多次沟通，达到意见一致之后开始制作网站效果图，效果图初稿制作完成后与客户多次沟通修改，啄木鸟严格把控设计质量直至客户满意后我们再安排程序员对网站进行程序开发，之后与客户配合进行网站测试，及时处理修复发现网站bug与交互问题。问题解决后网站正式上线。 成果展示\r\n</h2>\r\n<img src=\"http://homesitetask.zbjimg.com/homesite/task/6666666.jpg/origine/b36cbd3b-d0bc-42ee-abc4-0951b7f2f5a3\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/9.jpg/origine/8e67cdb3-b9ef-42d4-aee9-e5de54947cf3\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/6.jpg/origine/ca180670-6c66-448c-9dcc-ed12497a315d\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/2.jpg/origine/88256ff8-8c6c-4d3d-8769-22f9824b3080\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/5555555.png/origine/122aab43-9305-425f-abf3-385db57e9593\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/4444444.png/origine/e225f0af-040a-412a-b4f9-577ed552858f\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/5.jpg/origine/e17c3846-7441-49a2-8200-848193c1b824\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/13.jpg/origine/0ad25825-e0b7-4b26-a79b-a2a78088ee6f\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/12.jpg/origine/f0b31395-3ed6-41a5-82a7-58eabfcbdb89\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/11.jpg/origine/0418a179-6ac1-49db-a2cf-48db2d8c8744\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/10.jpg/origine/17d2d49c-6c3a-46f2-941c-81479631e615\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" /><img src=\"http://homesitetask.zbjimg.com/homesite/task/8888888.png/origine/30dceb5e-8048-4892-9adf-25e0f8670699\" alt=\"网站建设案例_域圆科技—网站建设\" class=\"det-left-img\" style=\"height:auto;width:840px;\" />\r\n<p>\r\n	<br />\r\n</p>', '127.0.0.1');
INSERT INTO `xhl_article_content` VALUES ('405', '405', '', '', '', '<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	原标题：新时代学习工作室 习近平推崇的英雄精神\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　缅怀英烈祭忠魂，抚今追昔思奋进。党的十八大以来，习近平总书记踏寻英雄、缅怀英烈的足迹遍布祖国的大江南北。铭记历史、缅怀英烈，一直是习近平总书记情之所牵、行之所至。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　英雄精神一直是习近平总书记推崇和倡导的。“党和人民需要我们献身的时候，我们都要毫不犹豫挺身而出，把个人生死置之度外。我们都做不到，让谁去做？”习近平总书记在中共中央政治局民主生活会上的话语直抵人心。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“中华民族是崇尚英雄、成就英雄、英雄辈出的民族，和平年代同样需要英雄情怀。”英雄精神就是我们的民族精神，它是激励我们实现中华民族伟大复兴的磅礴力量。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　<span style=\"font-weight:700 !important;\">崇尚英雄精神是从中汲取优秀的品质和精神</span>\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　岁月长河，历史足记不容磨灭；时代变迁，英雄精神熠熠发光。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　英雄，在习近平总书记的心中分量很重。他曾在多个场合向英烈致敬，表达了自己对英雄的看法。一个个深深的鞠躬，一次次深情的仰望，是总书记对历史的缅怀、对英烈的追思。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　——英雄精神是“精忠报国”的爱国精神\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“利于国者爱之，害于国者恶之。”爱国精神是民族精神的脊梁。\r\n</p>\r\n<p>\r\n	<img src=\"http://n.sinaimg.cn/news/crawl/148/w548h400/20180525/JGTT-haysviy5670819.jpg\" alt=\"2014年5月30日，习近平总书记来到北京市海淀区民族小学看望少年儿童。\" /><span class=\"img_descr\" style=\"line-height:20px;font-size:16px;font-weight:700;\">2014年5月30日，习近平总书记来到北京市海淀区民族小学看望少年儿童。</span>\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“精忠报国是我一生追求的目标”。2014年儿童节前夕，习近平来到北京市海淀区民族小学看望少年儿童。当看到正在练书法的孩子们写的“精忠报国”4个字时，他有感而发：“我从小就受这4个字的影响……精忠报国是我一生的目标。”习近平从五六岁的时候，就一直记着“精忠报国”四个字。他铭记在心的，是精忠报国的赤诚和胆略，是镌刻有历史印记的人生志向。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　2014年7月，习近平在纪念全民族抗战爆发77周年仪式上叙说了一个平凡却伟大的故事。北京密云县一位名叫邓玉芬的母亲，把丈夫和5个孩子送上前线，他们全部战死沙场。华北平原上的一个庄户人家写下这样一副对联：“万众一心保障国家独立，百折不挠争取民族解放”；横批是：“抗战到底”。这是中华儿女同日本侵略者血战到底的怒吼，是中华民族抗战必胜的宣言。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　——英雄精神是“砍头不要紧，只要主义真”的精神信仰\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　英雄因为对理想的执着追求、对信仰的忠贞不渝而伟大。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“砍头不要紧，只要主义真”，“敌人只能砍下我们的头颅，决不能动摇我们的信仰”，这些视死如归、大义凛然的誓言生动表达了共产党人对远大理想的坚贞。理想之光不灭，信念之光不灭。我们一定要铭记烈士们的遗愿，永志不忘他们为之流血牺牲的伟大理想。这是习近平在庆祝中国共产党成立95周年大会上的讲话。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“理想因其远大而为理想，信念因其执着而为信念。”在今年全国两会参加山东代表团审议时，习近平强调，红色基因就是要传承。中华民族从站起来、富起来到强起来，经历了多少坎坷，创造了多少奇迹，要让后代牢记，我们要不忘初心，永远不可迷失了方向和道路。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　——英雄精神是“死在戈壁滩、埋在青山头”的奉献精神\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　在崇尚英雄、学习英雄的同时，要学习英雄们夙夜在公、甘于奉献的精神。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“死在戈壁滩、埋在青山头”。习近平曾于2013年2月到酒泉卫星发射中心东风革命烈士陵园，向革命先烈敬献花篮。陵园安葬着聂荣臻元帅和为我国航天科技事业献身的711名革命英烈。\r\n</p>\r\n<p>\r\n	<img src=\"http://n.sinaimg.cn/news/crawl/167/w550h417/20180525/2WDR-haysviy5670916.jpg\" alt=\"2017年5月19日，全国公安系统英雄模范立功集体表彰大会在北京人民大会堂举行。会前，习近平等会见与会代表。 新华社记者鞠鹏摄\" /><span class=\"img_descr\" style=\"line-height:20px;font-size:16px;font-weight:700;\">2017年5月19日，全国公安系统英雄模范立功集体表彰大会在北京人民大会堂举行。会前，习近平等会见与会代表。 新华社记者鞠鹏摄</span>\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　习近平在会见全国公安系统英雄模范立功集体表彰大会代表时说，和平年代，公安队伍是一支牺牲最多、奉献最大的队伍，大家没有节假日、休息日，几乎是时时在流血、天天有牺牲。这些年来，每当看到公安民警舍生忘死、感人肺腑的事迹，我都深受感动；每当听到公安民警在血与火、生与死的考验面前赴汤蹈火、流血牺牲的消息，我都深感心痛。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　——英雄精神是“卧薪尝胆”的奋斗精神\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　英雄是历史中的杰出人物，拥有崇高理想和价值追求，有着百折不挠的奋斗精神。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　2011年，在中央党校秋季学期开学典礼上，习近平引用了颇多古代典籍中的故事：孔子的“学道不倦、诲人不厌”“发愤忘食、乐以忘忧”，越王勾践的卧薪尝胆，汉使苏武的饮雪吞毡，文王拘而演《周易》，屈原逐而赋《离骚》……他总结说，这些无不体现中华民族刚强坚毅、自强不息的优良传统和积极进取的人生态度。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　2016年，在纪念孙中山先生诞辰150周年大会上，习近平高度评价了孙中山的历史功绩：“孙中山先生毕生奋斗，就是期盼中国成为‘世界上顶富强的国家’‘世界上顶安乐的国家’，中国人民成为‘世界上顶享幸福的人民’。”\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　<span style=\"font-weight:700 !important;\">铭记英雄精神是永葆中华民族战斗力的精神力量</span>\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　中国在2014年通过立法增设了3个国家级纪念日：9月3日，中国人民抗日战争胜利纪念日；9月30日，中国烈士纪念日；12月13日，南京大屠杀死难者国家公祭日。这3个纪念日，都与中华民族近现代史上艰苦卓绝的奋斗有关。这3个纪念日在设立当年，都有隆重的高规格纪念活动，习近平都出席，并在胜利日和国家公祭日发表讲话。一年后的抗战胜利70周年纪念日，中国邀请世界政要，举行了举世瞩目的阅兵仪式，习近平检阅部队并讲话。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　今年5月1日，《中华人民共和国英雄烈士保护法》施行。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“今天，中国正在发生日新月异的变化，我们比历史上任何时期都更加接近实现中华民族伟大复兴的目标。实现我们的目标，需要英雄，需要英雄精神。”2015年9月2日，习近平在颁发“中国人民抗日战争胜利70周年”纪念章仪式上说到。\r\n</p>\r\n<p>\r\n	<img src=\"http://n.sinaimg.cn/news/crawl/683/w400h283/20180525/ZQh9-fzrwiaz5892533.jpg\" alt=\"2018年3月12日，中共中央总书记、国家主席、中央军委主席习近平出席十三届全国人大一次会议解放军和武警部队代表团全体会议并发表重要讲话。新华社记者 李 刚摄\" /><span class=\"img_descr\" style=\"line-height:20px;font-size:16px;font-weight:700;\">2018年3月12日，中共中央总书记、国家主席、中央军委主席习近平出席十三届全国人大一次会议解放军和武警部队代表团全体会议并发表重要讲话。新华社记者 李 刚摄</span>\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　习近平总书记在十九大报告中首次提出，组建退役军人管理保障机构，维护军人军属合法权益，让军人成为全社会尊崇的职业。今年全国两会上，习近平动情说道：“不要让英雄既流血又流泪，让军人受到尊崇，这是最基本的，这个要保障。”而后，退役军人事务部随之成立。4月16日上午，退役军人事务部在北京正式挂牌。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“一个有希望的民族不能没有英雄，一个有前途的国家不能没有先锋。” 英雄们的事迹和精神都是激励我们中华民族前行的强大力量。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　<span style=\"font-weight:700 !important;\">传承英雄精神是激励我们实现民族复兴的磅礴力量</span>\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　习近平在《之江新语》中提到，“学所以益才也。砺所以致刃也”。我们就是要善于向先进典型学习，在一点一滴中完善自己，从小事小节上修炼自己，以自己的实际行动学习先进、保持先进、赶超先进。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　见贤思齐，榜样的力量是无穷的。近五年来，我们国家涌现出了航空报国英模罗阳、新时期共产党人的楷模兰辉、勇闯深海的水下核盾海军某潜艇基地官兵、“法治燃灯者”邹碧华、太行山上的新愚公李保国、心系群众的优秀县委书记廖俊波、科技报国的榜样黄大年。这些先进典型，习近平都曾亲自批示，为他们点赞。\r\n</p>\r\n<p>\r\n	<img src=\"http://n.sinaimg.cn/news/crawl/102/w550h352/20180525/9JMc-haysviy5671117.jpg\" alt=\"2017年12月13日，中共中央总书记、国家主席、中央军委主席习近平到第71集团军视察。这是习近平同“王杰班”战士合影。 新华社记者 李刚摄\" /><span class=\"img_descr\" style=\"line-height:20px;font-size:16px;font-weight:700;\">2017年12月13日，中共中央总书记、国家主席、中央军委主席习近平到第71集团军视察。这是习近平同“王杰班”战士合影。 新华社记者 李刚摄</span>\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“一不怕苦、二不怕死是血性胆魄的生动写照，要成为革命军人的座右铭。王杰精神过去是、现在是、将来永远是我们的宝贵精神财富，要学习践行王杰精神，让王杰精神绽放新的时代光芒。”习近平曾在第71集团军视察时说。历史上红军曾为人民利益不惜牺牲自己的一切，具有战胜一切敌人的英雄气概。实现中华民族伟大复兴的圆梦精神同样需要这样的精神元素。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　历史是人民书写的，英雄是人民的优秀代表，他们用英勇无畏的浩然正气，凝聚起引领人民奋进、推动社会进步的强大精神力量。他们的身上，充满了血性和果敢；他们的心里，写满了忠诚和担当。为了国家和民族，为了党和人民，他们随时准备牺牲一切，他们用一身英雄胆，铸就了中华民族魂。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　英雄精神就是民族精神，如何评价英雄，如何看待英烈，反映的是核心价值观，体现的是时代的精气神。对光辉历史的铭记、对英烈的怀念和崇敬，是我们砥砺前行中强有力的鼓舞、鞭策和激励，也是我们义不容辞的责任和使命。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　在中华民族通向伟大复兴的征途中，应将英雄精神牢牢刻写在圣洁的民族精神殿堂，让英雄人物成为引人向前、催人奋斗的精神坐标，让英烈传递过来的火把，照亮我们的脚下之路。\r\n</p>\r\n<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	　　“我们要发扬光荣传统、传承红色基因，不忘初心、继续前进，努力在坚持和发展中国特色社会主义伟大进程中创造无愧于时代、无愧于人民、无愧于先辈的业绩。这是我们对老一辈革命家最好的纪念。”习近平发出铿锵有力的号召。（中国共产党新闻网记者&nbsp;&nbsp;姚茜）\r\n</p>', '127.0.0.1');
INSERT INTO `xhl_article_content` VALUES ('406', '406', '', '', '', '<p style=\"font-size:18px;font-family:微软雅黑;color:#222222;\">\r\n	人民网北京5月27日电 （贺迎春 施麟）据生态环境部消息，目前，273个督查组继续在全国范围内开展集中式饮用水水源地环境保护专项第一轮督查（简称“水源地专项督查”）。\r\n</p>\r\n<p style=\"font-size:18px;font-family:微软雅黑;color:#222222;\">\r\n	　　截至5月25日晚，各督查组已对212个地级市报送的688个水源地2059个问题清单开展了现场核查，并通过12369电话、微信举报以及卫星遥感监测结果提供的线索，新发现45个问题，主要包括工业企业、农业面源污染、生活面源污染等。\r\n</p>\r\n<p style=\"font-size:18px;font-family:微软雅黑;color:#222222;\">\r\n	　　这些问题涉及贵州省毕节市赫章县，云南省临沧市云县、德宏州芒市县，山东省日照市、东营市、莱芜市，陕西省安康市、商洛市，辽宁省本溪市、铁岭市，河北省沧州市，福建省龙岩市，浙江省湖州市长兴县，江苏省南通市、宿迁市、宿迁市泗阳县、苏州市太仓市，内蒙古自治区赤峰市，广东省汕头市，黑龙江省黑河市，河南省开封市、驻马店市、郑州市等地。\r\n</p>\r\n<p style=\"font-size:18px;font-family:微软雅黑;color:#222222;text-align:center;\">\r\n	　　<img alt=\"\" src=\"http://env.people.com.cn/NMediaFile/2018/0527/MAIN201805271335000237004170063.jpg\" width=\"551\" height=\"248\" />\r\n</p>\r\n<p class=\"desc\" style=\"font-size:18px;font-family:微软雅黑;color:#222222;text-align:center;\">\r\n	韩江外砂河饮用水水源一级保护区存在畜禽养殖污染\r\n</p>\r\n<p style=\"font-size:18px;font-family:微软雅黑;color:#222222;\">\r\n	　　督查组现场检查发现，广东省汕头市龙湖区韩江外砂河一级饮用水水源保护区内存在一处无证无照的肉鹅养殖场，未按要求搬迁关闭。该养殖场占地面积约2500㎡，饲养肉鹅600只，大量养殖废水和畜禽粪便直排保护区内。\r\n</p>\r\n<p style=\"font-size:18px;font-family:微软雅黑;color:#222222;\">\r\n	　　5月25日，督查组现场检查发现，河南省驻马店市板桥水库饮用水水源一级保护区内存在一排污企业正在生产。该企业名为河南征途管业工程有限公司，占地约4000平方米，主营范围为管道、桥梁预制品、水泥制品加工销售，主要产品为水泥管，生产过程产生污水、粉尘、噪声污染。\r\n</p>\r\n<p style=\"font-size:18px;font-family:微软雅黑;color:#222222;\">\r\n	　　此次督查还发现，江苏省南通市和宿迁市2个地级水源地排查整治不彻底，未按生态环境部要求于2017年年底前全面完成地级水源地排查整治工作。\r\n</p>', '127.0.0.1');

-- ----------------------------
-- Table structure for `xhl_article_link`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_article_link`;
CREATE TABLE `xhl_article_link` (
  `link_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '',
  `link` varchar(150) DEFAULT '',
  `orderby` smallint(6) unsigned DEFAULT '0',
  `dateline` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_article_link
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_article_photo`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_article_photo`;
CREATE TABLE `xhl_article_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `photo` varchar(150) DEFAULT '',
  `size` mediumint(8) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_article_photo
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_autoreplay`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_autoreplay`;
CREATE TABLE `xhl_autoreplay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_autoreplay
-- ----------------------------
INSERT INTO `xhl_autoreplay` VALUES ('1', '您好，我现在有事不在，一会再和您联系。');
INSERT INTO `xhl_autoreplay` VALUES ('2', '你没发错吧？face[微笑] ');
INSERT INTO `xhl_autoreplay` VALUES ('3', '洗澡中，请勿打扰，偷窥请购票，个体四十，团体八折，订票电话：一般人我不告诉他！face[哈哈] ');
INSERT INTO `xhl_autoreplay` VALUES ('4', '你好，我是主人的美女秘书，有什么事就跟我说吧，等他回来我会转告他的。face[心] face[心] face[心] ');
INSERT INTO `xhl_autoreplay` VALUES ('5', 'face[威武] face[威武] face[威武] face[威武] ');
INSERT INTO `xhl_autoreplay` VALUES ('6', '<（@￣︶￣@）>');
INSERT INTO `xhl_autoreplay` VALUES ('7', '你要和我说话？你真的要和我说话？你确定自己想说吗？你一定非说不可吗？那你说吧，这是自动回复。');
INSERT INTO `xhl_autoreplay` VALUES ('8', 'face[黑线]  你慢慢说，别急……');
INSERT INTO `xhl_autoreplay` VALUES ('9', '(*^__^*) face[嘻嘻] ，是贤心吗？');

-- ----------------------------
-- Table structure for `xhl_block`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_block`;
CREATE TABLE `xhl_block` (
  `block_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `page_id` int(10) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT '排序类型',
  `tmpl` varchar(255) DEFAULT NULL,
  `limit` int(4) DEFAULT NULL COMMENT '调用条数',
  `ttl` int(10) DEFAULT NULL COMMENT '缓存周期',
  `config` varchar(255) DEFAULT NULL,
  `orderby` varchar(255) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_block
-- ----------------------------
INSERT INTO `xhl_block` VALUES ('1', '幻灯头部', '3', 'article', 'default', null, '5', '86400', null, '50', '1527473712');
INSERT INTO `xhl_block` VALUES ('2', '文章推荐', '3', 'article', 'default', null, '9999', '86400', null, '50', '1527474018');

-- ----------------------------
-- Table structure for `xhl_block_item`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_block_item`;
CREATE TABLE `xhl_block_item` (
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `block_id` int(4) NOT NULL,
  `itemId` int(4) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `orderby` varchar(255) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_block_item
-- ----------------------------
INSERT INTO `xhl_block_item` VALUES ('1', '1', '403', '博飞特（上海）汽车设备', '', 'photo/201805/20180525_D8D2B326A09131C82DC711849552195C.png', null, 'a:30:{s:10:\"content_id\";s:3:\"403\";s:10:\"article_id\";s:3:\"403\";s:9:\"seo_title\";s:0:\"\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";s:7:\"content\";s:3561:\"<span> <h2 class=\"det-left-title\" style=\"font-size:12px;color:#333333;font-family:\" backgro', '0', '50', '1527474681');
INSERT INTO `xhl_block_item` VALUES ('2', '1', '405', '习近平推崇的英雄精神', '', 'photo/201805/20180525_D8D2B326A09131C82DC711849552195C.png', null, 'a:30:{s:10:\"content_id\";s:3:\"405\";s:10:\"article_id\";s:3:\"405\";s:9:\"seo_title\";s:0:\"\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";s:7:\"content\";s:15215:\"<p style=\"color:#4D4F53;font-family:&quot;font-size:18px;background-color:#FFFFFF;\">\r\n	原标题', '0', '50', '1527474719');
INSERT INTO `xhl_block_item` VALUES ('3', '2', '404', '上海域圆信息科技有限公司', '', 'photo/201805/20180525_D8D2B326A09131C82DC711849552195C.png', null, 'a:30:{s:10:\"content_id\";s:3:\"404\";s:10:\"article_id\";s:3:\"404\";s:9:\"seo_title\";s:0:\"\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";s:7:\"content\";s:4135:\"<h2 class=\"det-left-title\" style=\"font-size:12px;color:#333333;font-family:&quot;background', '0', '50', '1527474742');
INSERT INTO `xhl_block_item` VALUES ('4', '2', '406', '水源地专项督查曝光第二批环境违法问题', '', 'photo/201805/20180525_D8D2B326A09131C82DC711849552195C.png', null, 'a:30:{s:10:\"content_id\";s:3:\"406\";s:10:\"article_id\";s:3:\"406\";s:9:\"seo_title\";s:0:\"\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";s:7:\"content\";s:2760:\"<p style=\"font-size:18px;font-family:微软雅黑;color:#222222;\">\r\n	人民网北京5月27日电 （贺迎春 施麟）据生态环境部消息，目', '0', '50', '1527474957');

-- ----------------------------
-- Table structure for `xhl_block_page`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_block_page`;
CREATE TABLE `xhl_block_page` (
  `page_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '页面名称',
  `orderby` int(4) NOT NULL COMMENT '排序',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_block_page
-- ----------------------------
INSERT INTO `xhl_block_page` VALUES ('3', '资讯', '50');

-- ----------------------------
-- Table structure for `xhl_case`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_case`;
CREATE TABLE `xhl_case` (
  `case_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `case_name` varchar(50) NOT NULL DEFAULT '' COMMENT '案例名称',
  `case_type` varchar(100) NOT NULL DEFAULT '' COMMENT '案例类型(多个用逗号隔开)',
  `case_pic` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `linkurl` varchar(100) NOT NULL DEFAULT '' COMMENT '案例地址',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '网站简述',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `closed` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0正常 1关闭',
  `hidden` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0不隐藏 1隐藏',
  `orderby` tinyint(3) unsigned NOT NULL DEFAULT '250' COMMENT '排序',
  PRIMARY KEY (`case_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_case
-- ----------------------------
INSERT INTO `xhl_case` VALUES ('62', '创资讯', '', 'photo/201707/20170722_6B27A767CB3148F0E96A3D42DC10EF9C.png', 'http://www.chuangzixun.com/', '(大数据)', '1500694356', '0', '0', '5');
INSERT INTO `xhl_case` VALUES ('61', '中国绿网', '', 'photo/201707/20170722_1850942AAD871DECF1ED6B94C25D624A.png', 'http://www.imfic.com.cn/', '', '1500694239', '0', '0', '2');
INSERT INTO `xhl_case` VALUES ('55', '一路展', '', 'photo/201704/20170425_0E8D8EB2D20640B2265F394A0BB38C2C.png', 'http://www.16-expo.com/', '', '1493098055', '0', '0', '1');
INSERT INTO `xhl_case` VALUES ('56', '中国招标信息网', '', 'photo/201704/20170425_3A875FDEB2CD00A113D7DF3AE809A890.png', 'http://www.cn-bidding.cn/', '', '1493098144', '0', '0', '3');
INSERT INTO `xhl_case` VALUES ('57', '一为文化传媒', '', 'photo/201704/20170425_A7765EBF0A533AFE81883D785A6D970C.png', 'http://www.bjywcm.com/', '', '1493098322', '0', '0', '4');
INSERT INTO `xhl_case` VALUES ('58', '北京艾丽斯医院', '', 'photo/201704/20170425_642E5BD690535122DA2EDEEE5A51AD57.png', 'http://fuke.88565656.com/', '', '1493098392', '0', '0', '6');
INSERT INTO `xhl_case` VALUES ('59', '巍阁月子会所', '', 'photo/201704/20170425_B670BD6E909F2A764B3619417B0CC5DC.png', 'http://www.weige2006.com/portal.php', '', '1493098425', '0', '0', '7');
INSERT INTO `xhl_case` VALUES ('60', '商城', '', 'photo/201704/20170425_45697A7539ADB2655AD260BA680285B9.jpg', 'http://www.jisunet.cn/', '', '1493098474', '0', '0', '8');

-- ----------------------------
-- Table structure for `xhl_category`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_category`;
CREATE TABLE `xhl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tname` varchar(255) NOT NULL COMMENT '类别名称',
  `type` varchar(155) NOT NULL COMMENT '归属分类',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启用 2 禁用',
  `typeid` int(11) NOT NULL COMMENT '父类id',
  PRIMARY KEY (`id`),
  KEY `type` (`type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_category
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_chatgroup`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_chatgroup`;
CREATE TABLE `xhl_chatgroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '群组id',
  `groupname` varchar(155) NOT NULL COMMENT '群组名称',
  `avatar` varchar(155) DEFAULT NULL COMMENT '群组头像',
  `owner_name` varchar(155) DEFAULT NULL COMMENT '群主名称',
  `owner_id` int(11) DEFAULT NULL COMMENT '群主id',
  `owner_avatar` varchar(155) DEFAULT NULL COMMENT '群主头像',
  `owner_sign` varchar(155) DEFAULT NULL COMMENT '群主签名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=420 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_chatgroup
-- ----------------------------
INSERT INTO `xhl_chatgroup` VALUES ('419', '测试项目', 'http://gdh.wordhuo.com/files/photo/201711/20171104_63DB14A2EE6CDB76E961DFB8E3B8FE44.png', '15101573480', '1124', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '');

-- ----------------------------
-- Table structure for `xhl_chatlog`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_chatlog`;
CREATE TABLE `xhl_chatlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) NOT NULL COMMENT '会话来源id',
  `fromname` varchar(155) NOT NULL DEFAULT '' COMMENT '消息来源用户名',
  `fromavatar` varchar(155) NOT NULL DEFAULT '' COMMENT '来源的用户头像',
  `toid` int(11) NOT NULL COMMENT '会话发送的id',
  `content` text NOT NULL COMMENT '发送的内容',
  `timeline` int(10) NOT NULL COMMENT '记录时间',
  `type` varchar(55) NOT NULL COMMENT '聊天类型',
  `needsend` tinyint(1) DEFAULT '0' COMMENT '0 不需要推送 1 需要推送',
  PRIMARY KEY (`id`),
  KEY `fromid` (`fromid`) USING BTREE,
  KEY `toid` (`toid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_chatlog
-- ----------------------------
INSERT INTO `xhl_chatlog` VALUES ('1', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '111', '1522397123', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('2', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '123', '1522397140', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('3', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '1c', '1522397187', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('4', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1124', '123', '1522397269', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('5', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '123', '1522397281', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('6', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '3333', '1522397287', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('7', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '4', '1522397311', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('8', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '1111', '1522397501', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('9', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '111', '1522397622', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('10', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '123', '1522397651', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('11', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '1', '1522397662', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('12', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '111', '1522397690', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('13', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '111', '1522397741', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('14', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '1', '1522398430', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('15', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '2', '1522398453', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('16', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '3', '1522398489', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('17', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '4', '1522398536', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('18', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '5', '1522398588', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('19', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '11', '1522398604', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('20', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '111', '1522399159', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('21', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '111', '1522399188', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('22', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '1', '1522399392', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('23', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '1', '1522399577', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('24', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '123', '1522399591', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('25', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '111', '1522399684', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('26', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '222', '1522399692', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('27', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '333', '1522399724', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('28', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '111', '1522399792', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('29', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '1', '1522399828', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('30', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '2', '1522400077', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('31', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '3', '1522400205', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('32', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '111', '1522400389', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('33', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '1', '1522400397', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('34', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '123', '1522400413', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('35', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '123', '1522400419', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('36', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '123', '1522400426', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('37', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '12', '1522400434', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('38', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '12', '1522400444', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('39', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '123', '1522400453', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('40', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '123', '1522400461', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('41', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '12', '1522400474', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('42', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '23', '1522400478', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('43', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '123', '1522400601', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('44', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '111', '1522401969', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('45', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '111', '1522402006', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('46', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '111', '1522402135', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('47', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '12', '1522402238', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('48', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '123', '1522402257', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('49', '1124', '15101573480', 'http://www.gdh.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', 'aaaaaaaaaaa', '1522402740', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('50', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1124', '12', '1522402768', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('51', '1125', '18204718748', 'http://www.gdh.com/files/face/face.jpg', '1125', '1', '1522404933', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('52', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '1125', '参数', '1522461453', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('53', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '100001', '测试', '1522462032', 'friend', '1');
INSERT INTO `xhl_chatlog` VALUES ('54', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '1125', 'cs', '1522467631', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('55', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '1125', '1', '1522467696', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('56', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '423', 'cs', '1522468098', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('57', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs1', '1522468107', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('58', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs', '1522468188', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('59', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '1125', 'cs', '1522468204', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('60', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '1137', 'cs1', '1522468209', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('61', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs2', '1522468215', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('62', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '423', 'cs3', '1522468223', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('63', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs3', '1522468237', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('64', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs4', '1522468242', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('65', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs5', '1522468247', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('66', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs6', '1522468258', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('67', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs', '1522468551', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('68', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '423', 'cs4', '1522468777', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('69', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '423', 'cs5', '1522468807', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('70', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '423', 'cs', '1522468973', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('71', '1125', '18204718748', 'http://www.gdh.com/files/photo/201803/20180330_C36747264983CC95BE22571B45039A1E.jpg', '423', 'cs 2', '1522468980', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('72', '1137', '18204718749', 'http://www.gdh.com/files/face/face.jpg', '1125', '123', '1522635387', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('73', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', '123', '1522659357', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('74', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', '123', '1522659457', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('75', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '1138', '1', '1522659468', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('76', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', '参数', '1522659497', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('77', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', 'cs ', '1522659511', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('78', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', 'cs 1', '1522659518', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('79', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', '111', '1522660142', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('80', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', '123', '1522660157', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('81', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', '333', '1522660180', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('82', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', '111', '1522660245', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('83', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', '111', '1522660264', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('84', '1138', '18204718748', 'http://www.gdh.com/files/photo/201804/20180402_18C6D1AF1E456CD58389CE961B02354A.png', '433', 'c', '1522660391', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('85', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '1', '1522661057', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('86', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '123', '1522661093', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('87', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '1125', 'cs1', '1522661121', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('88', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '1125', '111', '1522661156', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('89', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '1125', '222', '1522661162', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('90', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '1125', '123', '1522661215', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('91', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '123', '1522662876', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('92', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '234', '1522662882', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('93', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '123', '1522662894', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('94', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '1124', '111', '1522662903', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('95', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '12', '1522662907', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('96', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '1', '1522662948', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('97', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '2', '1522662951', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('98', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '1', '1522663077', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('99', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '2', '1522663079', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('100', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '1125', '1', '1522663140', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('101', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '1124', '2', '1522663146', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('102', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '333', '1522663155', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('103', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '测试', '1522663170', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('104', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '123', '1522663371', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('105', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '123', '1522663397', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('106', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '123', '1522663464', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('107', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '1', '1522663527', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('108', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '1', '1522663578', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('109', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '2', '1522663607', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('110', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '111', '1522663699', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('111', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '12', '1522663813', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('112', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '122', '1522663880', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('113', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '12', '1522663951', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('114', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '123', '1522663975', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('115', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '123', '1522663986', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('116', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '123', '1522664007', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('117', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '123', '1522664010', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('118', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '416', '1', '1522664030', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('119', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '416', '测试', '1522664431', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('120', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '1124', '3', '1522664540', 'friend', '0');
INSERT INTO `xhl_chatlog` VALUES ('121', '1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '419', '123', '1522666128', 'group', '0');
INSERT INTO `xhl_chatlog` VALUES ('122', '1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '419', '234', '1522666131', 'group', '0');

-- ----------------------------
-- Table structure for `xhl_chatuser`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_chatuser`;
CREATE TABLE `xhl_chatuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(155) DEFAULT NULL,
  `pwd` varchar(155) DEFAULT NULL COMMENT '密码',
  `groupid` int(5) DEFAULT NULL COMMENT '所属的分组id',
  `status` varchar(55) DEFAULT NULL,
  `sign` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1126 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_chatuser
-- ----------------------------
INSERT INTO `xhl_chatuser` VALUES ('1125', '18204718748', '96e79218965eb72c92a549dd5a330112', '1', 'online', '', 'http://gdh.wordhuo.com/files/face/face.jpg');
INSERT INTO `xhl_chatuser` VALUES ('1124', '15101573480', '96e79218965eb72c92a549dd5a330112', '1', 'online', '', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png');
INSERT INTO `xhl_chatuser` VALUES ('1123', 'user', '96e79218965eb72c92a549dd5a330112', '1', 'online', '', 'http://www.gdh.com/files/face/face.jpg');

-- ----------------------------
-- Table structure for `xhl_chuangyi`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_chuangyi`;
CREATE TABLE `xhl_chuangyi` (
  `chuangyi_id` int(11) NOT NULL AUTO_INCREMENT,
  `wxopenid` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `chuangyi` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `isshow` tinyint(1) DEFAULT '1',
  `ziyuan` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `xunqiu` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `weixin` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `close` tinyint(1) DEFAULT '0',
  `cityid` int(4) DEFAULT '0',
  PRIMARY KEY (`chuangyi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of xhl_chuangyi
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_codelog`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_codelog`;
CREATE TABLE `xhl_codelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `code` text,
  `time` varchar(50) DEFAULT NULL,
  `chinese` varchar(100) DEFAULT NULL,
  `state` int(11) DEFAULT '2' COMMENT '2未使用，1使用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_codelog
-- ----------------------------
INSERT INTO `xhl_codelog` VALUES ('70', '15101573480', '{\"code\":\"456753\",\"product\":\"人人见\"}', '{\"Message\":\"OK\",\"RequestId\":\"47F2F1CC-605B-472F-AAD3-A46CA47B1D8B\",\"BizId\":\"444623707547266135^0\",\"Code\":\"OK\"}', '1507547264', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('71', '15101573480', '{\"code\":\"792495\",\"product\":\"人人见\"}', '{\"Message\":\"u89e6u53d1u5c0fu65f6u7ea7u6d41u63a7Permits:5\",\"RequestId\":\"4C95CBBD-FB26-49F7-9E3D-44F63522118C\",\"Code\":\"isv.BUSINESS_LIMIT_CONTROL\"}', '1507548481', '业务限流', '2');
INSERT INTO `xhl_codelog` VALUES ('72', '15101573480', '{\"code\":\"638110\",\"product\":\"人人见\"}', '{\"Message\":\"u89e6u53d1u5c0fu65f6u7ea7u6d41u63a7Permits:5\",\"RequestId\":\"52775724-D7C9-436F-9E1B-BEA790464E56\",\"Code\":\"isv.BUSINESS_LIMIT_CONTROL\"}', '1507548772', '业务限流', '2');
INSERT INTO `xhl_codelog` VALUES ('73', '15101573480', '{\"code\":\"208050\",\"product\":\"人人见\"}', '{\"Message\":\"u89e6u53d1u5c0fu65f6u7ea7u6d41u63a7Permits:5\",\"RequestId\":\"E2DBB366-1BC4-4217-AE4A-A7F9D1D1B0FF\",\"Code\":\"isv.BUSINESS_LIMIT_CONTROL\"}', '1507549019', '业务限流', '2');
INSERT INTO `xhl_codelog` VALUES ('74', '15101573480', '{\"code\":\"500479\",\"product\":\"人人见\"}', '{\"Message\":\"u89e6u53d1u5c0fu65f6u7ea7u6d41u63a7Permits:5\",\"RequestId\":\"E4AF69AA-AE96-4B0F-ACE4-24609D08F26C\",\"Code\":\"isv.BUSINESS_LIMIT_CONTROL\"}', '1507549063', '业务限流', '2');
INSERT INTO `xhl_codelog` VALUES ('75', '15101573480', '{\"code\":\"990496\",\"product\":\"人人见\"}', '{\"Message\":\"u89e6u53d1u5c0fu65f6u7ea7u6d41u63a7Permits:5\",\"RequestId\":\"68F749FB-C482-483A-89B2-BB5D976BEE71\",\"Code\":\"isv.BUSINESS_LIMIT_CONTROL\"}', '1507549117', '业务限流', '2');
INSERT INTO `xhl_codelog` VALUES ('76', '15101573480', '{\"code\":\"922381\",\"product\":\"人人见\"}', '{\"Message\":\"u89e6u53d1u5c0fu65f6u7ea7u6d41u63a7Permits:5\",\"RequestId\":\"58898D68-F3BB-4E3F-89E5-740AE7050A95\",\"Code\":\"isv.BUSINESS_LIMIT_CONTROL\"}', '1507549155', '业务限流', '2');
INSERT INTO `xhl_codelog` VALUES ('77', '13522491505', '{\"code\":\"411599\",\"product\":\"人人见\"}', '{\"Message\":\"OK\",\"RequestId\":\"096FD3D2-175E-4A17-B9BF-6D671FB3E259\",\"BizId\":\"173003807549234102^0\",\"Code\":\"OK\"}', '1507549232', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('78', '13522491505', '{\"code\":\"845971\",\"product\":\"人人见\"}', '{\"Message\":\"OK\",\"RequestId\":\"F6EFF14C-DD4E-4BEC-AA3E-CACE622FD0C4\",\"BizId\":\"657604707551309434^0\",\"Code\":\"OK\"}', '1507551307', '请求成功', '1');
INSERT INTO `xhl_codelog` VALUES ('79', '15101573480', '{\"code\":\"525170\",\"product\":\"人人见\"}', 'null', '1507600277', '', '1');
INSERT INTO `xhl_codelog` VALUES ('80', '15101573480', '{\"code\":\"157733\",\"product\":\"人人见\"}', 'null', '1507624284', '', '2');
INSERT INTO `xhl_codelog` VALUES ('81', '15101573480', '{\"code\":\"932791\",\"product\":\"人人见\"}', 'null', '1507624887', '', '2');
INSERT INTO `xhl_codelog` VALUES ('82', '15801508932', '{\"code\":\"341644\",\"product\":\"人人见\"}', 'null', '1509505266', '', '2');
INSERT INTO `xhl_codelog` VALUES ('83', '18204718748', '{\"code\":\"203149\",\"product\":\"干点活\"}', '{\"Message\":\"u7b7eu540du4e0du5408u6cd5(u4e0du5b58u5728u6216u88abu62c9u9ed1)\",\"RequestId\":\"9D8F5058-5556-46D5-B2D8-6F33EDCD8B3E\",\"Code\":\"isv.SMS_SIGNATURE_ILLEGAL\"}', '1521802038', '短信签名不合法', '2');
INSERT INTO `xhl_codelog` VALUES ('84', '18204718748', '{\"code\":\"390514\",\"product\":\"干点活\"}', '{\"Message\":\"u7b7eu540du4e0du5408u6cd5(u4e0du5b58u5728u6216u88abu62c9u9ed1)\",\"RequestId\":\"E782E640-7246-40B1-804D-27EFE6869EA8\",\"Code\":\"isv.SMS_SIGNATURE_ILLEGAL\"}', '1521802231', '短信签名不合法', '2');
INSERT INTO `xhl_codelog` VALUES ('85', '18204718748', '{\"code\":\"166029\",\"product\":\"干点活\"}', '{\"Message\":\"OK\",\"RequestId\":\"ACC4BD22-7762-4E55-9DA9-E71BD25A1863\",\"BizId\":\"386508521802892758^0\",\"Code\":\"OK\"}', '1521802892', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('86', '15810988699', '{\"code\":\"665422\"}', '{\"Message\":\"OK\",\"RequestId\":\"058AD901-1B9F-49FB-A980-D300C0DDF35B\",\"BizId\":\"766409022403322481^0\",\"Code\":\"OK\"}', '1522403322', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('87', '18204718748', '{\"code\":\"736103\",\"product\":\"人人见\"}', 'null', '1522666740', '', '2');
INSERT INTO `xhl_codelog` VALUES ('88', '18204718748', '{\"code\":\"440865\",\"product\":\"人人见\"}', 'null', '1522666772', '', '2');
INSERT INTO `xhl_codelog` VALUES ('89', '15810988699', '{\"code\":\"096311\"}', '{\"Message\":\"OK\",\"RequestId\":\"48A7266F-C990-44DD-B478-30A5185621D4\",\"BizId\":\"360203722667106186^0\",\"Code\":\"OK\"}', '1522667106', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('90', '18204718748', '{\"code\":\"387200\"}', '{\"Message\":\"OK\",\"RequestId\":\"2AD4B486-731D-4F87-8D3A-45BD462A7BC8\",\"BizId\":\"665504222667432263^0\",\"Code\":\"OK\"}', '1522667432', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('91', '15810988699', '{\"code\":\"181063\"}', '{\"Message\":\"OK\",\"RequestId\":\"37122780-6167-488F-804D-32E5C7DC09A4\",\"BizId\":\"653914522742106013^0\",\"Code\":\"OK\"}', '1522742106', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('92', '15810988699', '{\"code\":\"478370\"}', '{\"Message\":\"u89e6u53d1u5206u949fu7ea7u6d41u63a7Permits:1\",\"RequestId\":\"AA643171-7460-4B6C-ADC6-4741A996539F\",\"Code\":\"isv.BUSINESS_LIMIT_CONTROL\"}', '1522742125', '业务限流', '2');
INSERT INTO `xhl_codelog` VALUES ('93', '18204718748', '{\"code\":\"634873\"}', '{\"Message\":\"OK\",\"RequestId\":\"9C5CA460-AD0E-467D-A43B-F9095266B9CF\",\"BizId\":\"913506722742738484^0\",\"Code\":\"OK\"}', '1522742738', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('94', '18204718748', '{\"code\":\"621854\"}', '{\"Message\":\"OK\",\"RequestId\":\"799A0893-FEE2-4CED-BD9D-E12412683557\",\"BizId\":\"921602522749693260^0\",\"Code\":\"OK\"}', '1522749693', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('95', '13141472661', '{\"code\":\"833639\"}', '{\"Message\":\"OK\",\"RequestId\":\"E5140590-F89A-4F38-9970-8475A963C33E\",\"BizId\":\"722913328077103381^0\",\"Code\":\"OK\"}', '1528077116', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('96', '13141472661', '{\"code\":\"126669\"}', '{\"Message\":\"OK\",\"RequestId\":\"049D040E-06B5-4741-9BCE-FA2E14BD8294\",\"BizId\":\"184521328278468823^0\",\"Code\":\"OK\"}', '1528278482', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('97', '13141472661', '{\"code\":\"679171\"}', '{\"Message\":\"OK\",\"RequestId\":\"E44B1761-535C-49FB-A0F0-FC3461DB6D9B\",\"BizId\":\"927710128343685847^0\",\"Code\":\"OK\"}', '1528343700', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('98', '13141472661', '{\"code\":\"848196\"}', '{\"Message\":\"OK\",\"RequestId\":\"07851E43-25DE-44CC-87CB-F778CC999EAB\",\"BizId\":\"415810228426521542^0\",\"Code\":\"OK\"}', '1528426537', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('99', '13141472661', '{\"code\":\"754620\"}', '{\"Message\":\"OK\",\"RequestId\":\"EEFD456F-56E0-4B04-B5EE-BE81C28EECB3\",\"BizId\":\"377415828428248747^0\",\"Code\":\"OK\"}', '1528428264', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('100', '13141472661', '{\"code\":\"457962\"}', '{\"Message\":\"OK\",\"RequestId\":\"06C5D206-57AD-4322-9F94-D54303D2793B\",\"BizId\":\"739702328683691773^0\",\"Code\":\"OK\"}', '1528683691', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('101', '13141472661', '{\"code\":\"923645\"}', '{\"Message\":\"OK\",\"RequestId\":\"341E3ABE-572C-48EA-B4CD-E40E60BBA3EF\",\"BizId\":\"444410128684615519^0\",\"Code\":\"OK\"}', '1528684615', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('102', '13141472661', '{\"code\":\"349938\"}', '{\"Message\":\"OK\",\"RequestId\":\"5771F697-51F2-42F6-8CB8-0354CC561968\",\"BizId\":\"272008328684762251^0\",\"Code\":\"OK\"}', '1528684762', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('103', '13141472661', '{\"code\":\"742864\"}', '{\"Message\":\"OK\",\"RequestId\":\"5C0D9F28-6FCC-4E3A-89AD-EB945DD02957\",\"BizId\":\"677617628685911691^0\",\"Code\":\"OK\"}', '1528685911', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('104', '13141472661', '{\"code\":\"792165\"}', '{\"Message\":\"OK\",\"RequestId\":\"EF1066F9-76B0-4171-9C9E-E7BFB8C0A9F5\",\"BizId\":\"331409830329391899^0\",\"Code\":\"OK\"}', '1530329392', '请求成功', '2');
INSERT INTO `xhl_codelog` VALUES ('105', '13466649862', '{\"code\":\"155186\"}', '{\"Message\":\"OK\",\"RequestId\":\"53BD7955-E7B9-4AD5-AB70-970B891D630B\",\"BizId\":\"754903530848534820^0\",\"Code\":\"OK\"}', '1530848534', '请求成功', '2');

-- ----------------------------
-- Table structure for `xhl_component`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_component`;
CREATE TABLE `xhl_component` (
  `component_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '项目id',
  `cat_id` mediumint(6) unsigned DEFAULT '0' COMMENT '分类id',
  `from` enum('component','about','help','page') DEFAULT 'component',
  `page` varchar(15) DEFAULT '',
  `title` varchar(15) DEFAULT '' COMMENT '标题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `yuyan` varchar(200) DEFAULT '' COMMENT '源码语言',
  `hangye` varchar(150) DEFAULT '' COMMENT '企业行业',
  `chajian` varchar(255) DEFAULT '' COMMENT '插件情况',
  `huanjing` varchar(128) DEFAULT '' COMMENT '运行环境',
  `ontime` int(10) DEFAULT '0' COMMENT '更新时间',
  `size` varchar(5) DEFAULT '0' COMMENT '软件大小',
  `xingzhi` varchar(8) DEFAULT '' COMMENT '网页性质',
  `gurl` varchar(64) DEFAULT '' COMMENT '官方主页',
  `xnum` int(20) unsigned DEFAULT '0' COMMENT '下载次数',
  `url` varchar(64) DEFAULT NULL COMMENT '下载地址',
  `linkurl` varchar(255) DEFAULT NULL COMMENT '跳转url',
  `desc` varchar(255) DEFAULT '' COMMENT '描述',
  `views` mediumint(8) DEFAULT '0' COMMENT '浏览数',
  `favorites` mediumint(8) DEFAULT '0' COMMENT '收藏数',
  `comments` mediumint(8) DEFAULT '0' COMMENT '留言数',
  `orderby` smallint(6) unsigned DEFAULT '50',
  `dateline` int(10) unsigned DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0' COMMENT '状态',
  `hidden` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) unsigned DEFAULT '0',
  `uid` int(10) unsigned DEFAULT NULL COMMENT '设计师id',
  `infourl` varchar(255) DEFAULT '' COMMENT '介绍url',
  `xmprice` tinyint(1) unsigned DEFAULT '0' COMMENT '项目收费',
  PRIMARY KEY (`component_id`)
) ENGINE=MyISAM AUTO_INCREMENT=419 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_component
-- ----------------------------
INSERT INTO `xhl_component` VALUES ('416', '12', 'component', '', '千米电商云平台', 'photo/201701/20170104_D001E0B7A29ED9CF79E1A08E51A04159.jpg', 'php', '', '', '', '0', '', '', 'http://www.qianmi.com/', '1', null, '', '江苏千米网络科技股份有限公司是一个专注于中小企业电商化运营之道的公司提供电商系统支撑，以及同客户携手探索行业最佳实践通过一站式SaaS电商解决方案帮助中小企业提升经营能力、作业效率及运营模式升级', '0', '0', '1', '50', '1483496916', '1', '0', '0', '1083', 'http://www.qianmi.com/reg?us=%E5%8D%83%E7%B1%B3%E5%AE%98%E7%BD%91-%E5%BE%AE%E4%BF%A1%E6%8E%A8%E5%B9%BF', '0');
INSERT INTO `xhl_component` VALUES ('417', '12', 'component', '', 'BAOCMS本地O2O生活门户', 'photo/201701/20170104_CEC1EC8A0D53ADAD4C41B11150255DDB.jpg', '', '', '', '', '0', '', '', 'http://www.baocms.com/', '0', null, null, '多城市数据统一每个分站的会员和商家数据都在一套数据库，不再需要安装多套程序外卖系统类似饿了么、美团外卖等，本地O2O高频的领域物流系统网站运营者统一配送,商家或者商城的订单，可以请兼职或者全职人员来进行配送商家粉丝系统网站只需要关注过该商家的用户，商家可以随时随地向…', '0', '0', '0', '50', '1483510866', '1', '0', '0', '1084', 'http://www.baocms.cn/', '0');
INSERT INTO `xhl_component` VALUES ('418', '12', 'component', '', '游戏网站', 'photo/201701/20170106_3190B5C4974B73DB120EEE4FC9888747.png', '中文', '', '允许其他插件', '运行环境', '0', '1.569', '网页性质', 'www.16-expo.com', '0', null, null, '描述描述描述描述描述描述', '0', '0', '1', '50', '1483693143', '1', '0', '1', '1087', 'www.16-expo.com', '0');

-- ----------------------------
-- Table structure for `xhl_component_cate`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_component_cate`;
CREATE TABLE `xhl_component_cate` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) DEFAULT NULL,
  `title` varchar(255) DEFAULT '',
  `level` tinyint(1) DEFAULT '1',
  `from` enum('component','page','help','about') DEFAULT 'component',
  `bgimg` varchar(255) DEFAULT NULL COMMENT '背景图片',
  `seo_title` varchar(255) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(255) DEFAULT '',
  `orderby` mediumint(6) unsigned DEFAULT '50',
  `hidden` tinyint(1) DEFAULT NULL,
  `dateline` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_component_cate
-- ----------------------------
INSERT INTO `xhl_component_cate` VALUES ('12', '0', '会员系统', '1', 'component', 'photo/201701/20170104_06B3333E1A72D11E1C2291B3CF1828A0.png', '', '', '', '50', '0', '1483499832');
INSERT INTO `xhl_component_cate` VALUES ('13', '0', '新闻系统', '1', 'component', 'photo/201701/20170104_43DE9D588720988F08AB3029ACF7C901.png', '', '', '', '50', '0', '1483513325');
INSERT INTO `xhl_component_cate` VALUES ('14', '12', '多级别会员', '2', 'component', null, '', '', '比如初级会员，中级会员，高级会员，不同级别的会员对应不同的权限等', '50', '0', '1487922071');
INSERT INTO `xhl_component_cate` VALUES ('15', '14', 'asdfsadf', '3', 'component', null, '', '', '', '50', '0', '1487933532');
INSERT INTO `xhl_component_cate` VALUES ('16', '12', '多类别会员', '2', 'component', null, '', '', '比如不同类型的用户，如：个人用户、企业用户等，不同用户类型对应不同的用户功能', '50', '0', '1487933729');
INSERT INTO `xhl_component_cate` VALUES ('17', '12', '支持第三方登录', '2', 'component', null, '', '', '支持第三方登录，如微信登录，QQ登录等', '50', '0', '1487933840');
INSERT INTO `xhl_component_cate` VALUES ('18', '12', '多系统连合登录', '2', 'component', null, '', '', '比如ucenter 集成', '50', '0', '1487933924');
INSERT INTO `xhl_component_cate` VALUES ('19', '13', '分类管理', '2', 'component', null, '', '', '', '50', '0', '1487933993');
INSERT INTO `xhl_component_cate` VALUES ('20', '13', '权限管理', '2', 'component', null, '', '', '', '50', '0', '1487934154');
INSERT INTO `xhl_component_cate` VALUES ('21', '13', '评论/回复', '2', 'component', null, '', '', '', '50', '0', '1487934194');
INSERT INTO `xhl_component_cate` VALUES ('22', '13', '会员发布', '2', 'component', null, '', '', '', '50', '0', '1487934226');
INSERT INTO `xhl_component_cate` VALUES ('23', '0', '产品系统', '1', 'component', null, '', '', '', '50', '0', '1487934319');
INSERT INTO `xhl_component_cate` VALUES ('24', '23', '购物车、订单、在线支付', '2', 'component', null, '', '', '', '50', '0', '1487934341');
INSERT INTO `xhl_component_cate` VALUES ('25', '23', '评论/回复', '2', 'component', null, '', '', '', '50', '0', '1487934398');
INSERT INTO `xhl_component_cate` VALUES ('26', '0', '案例管理', '1', 'component', null, '', '', '', '50', '0', '1487934519');
INSERT INTO `xhl_component_cate` VALUES ('27', '0', '会展', '1', 'component', null, '', '', '', '50', '0', '1487934675');
INSERT INTO `xhl_component_cate` VALUES ('28', '0', '订单系统', '1', 'component', null, '', '', '', '50', '0', '1487934687');
INSERT INTO `xhl_component_cate` VALUES ('29', '0', '广告管理', '1', 'component', null, '', '', '', '50', '0', '1487934722');
INSERT INTO `xhl_component_cate` VALUES ('30', '0', '友情连接', '1', 'component', null, '', '', '', '50', '0', '1487934742');
INSERT INTO `xhl_component_cate` VALUES ('31', '0', '个人博客', '1', 'component', null, '', '', '', '50', '0', '1487934760');
INSERT INTO `xhl_component_cate` VALUES ('32', '0', '企业站', '1', 'component', null, '', '', '', '50', '0', '1487934791');

-- ----------------------------
-- Table structure for `xhl_component_comment`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_component_comment`;
CREATE TABLE `xhl_component_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `component_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `content` varchar(512) DEFAULT '',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  `dateline` int(10) DEFAULT '0',
  `reply` varchar(255) DEFAULT NULL,
  `replyip` varchar(255) DEFAULT NULL,
  `replytime` int(10) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_component_comment
-- ----------------------------
INSERT INTO `xhl_component_comment` VALUES ('7', '416', '1085', '12312312312', '0', '106.39.152.253', '1483691857', null, null, null);
INSERT INTO `xhl_component_comment` VALUES ('8', '418', '1087', '游戏游戏游戏游戏游戏', '1', '106.39.152.253', '1483693210', '12454545', null, null);
INSERT INTO `xhl_component_comment` VALUES ('9', '418', '1087', '1111111111111111111111', '1', '106.39.152.253', '1483693390', '1111134444444444555555555555555', '106.39.152.253', '1483741959');

-- ----------------------------
-- Table structure for `xhl_component_content`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_component_content`;
CREATE TABLE `xhl_component_content` (
  `content_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `component_id` int(10) NOT NULL,
  `seo_title` varchar(150) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(255) DEFAULT '',
  `content` mediumtext,
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  PRIMARY KEY (`content_id`),
  KEY `article_id` (`component_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=418 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_component_content
-- ----------------------------
INSERT INTO `xhl_component_content` VALUES ('415', '416', '', '', '', '<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">江苏千米网络科技股份有限公司</span><br />\r\n<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">是一个专注于中小企业电商化运营之道的公司</span><br />\r\n<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">提供电商系统支撑，以及同客户携手探索行业最佳实践</span><br />\r\n<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">通过一站式SaaS电商解决方案</span><br />\r\n<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">帮助中小企业提升经营能力、作业效率及运营模式升级</span>', '106.39.152.253');
INSERT INTO `xhl_component_content` VALUES ('416', '417', '', '', '', '<p>\r\n	多城市数据统一\r\n</p>\r\n<p>\r\n	每个分站的会员和商家数据都在一套数据库，不再需要安装多套程序\r\n</p>\r\n<p>\r\n	外卖系统\r\n</p>\r\n<p>\r\n	类似饿了么、美团外卖等，本地O2O高频的领域\r\n</p>\r\n<p>\r\n	物流系统\r\n</p>\r\n<p>\r\n	网站运营者统一配送,商家或者商城的订单，可以请兼职或者全职人员来进行配送\r\n</p>\r\n<p>\r\n	商家粉丝系统\r\n</p>\r\n<p>\r\n	网站只需要关注过该商家的用户，商家可以随时随地向自己的粉丝推送自己最新的优惠信息;营销性可见强大\r\n</p>\r\n<p>\r\n	订座系统\r\n</p>\r\n<p>\r\n	解决了白领或者家庭聚餐定饭店的烦恼;提前搞定您的就餐需求，吃饭没烦恼!\r\n</p>\r\n<p>\r\n	团购系统\r\n</p>\r\n<p>\r\n	无团购不O2O，哪里实惠去哪里\r\n</p>\r\n<p>\r\n	评价系统\r\n</p>\r\n<p>\r\n	商家的信用体系十分完善，让消费者体验最真实的消费\r\n</p>\r\n<p>\r\n	优惠券系统\r\n</p>\r\n<p>\r\n	无优惠不消费，哪里有优惠，就哪里去消费\r\n</p>\r\n<p>\r\n	家政系统\r\n</p>\r\n<p>\r\n	类似于阿姨帮的家政功能，本地O2O一块比较大的蛋糕\r\n</p>\r\n<p>\r\n	商城系统\r\n</p>\r\n<p>\r\n	本地O2O重要一环，可以无限的延伸到各种本地O2O\r\n</p>\r\n<p>\r\n	同城信息\r\n</p>\r\n<p>\r\n	收集本地生活需求信息，流量飙升不是梦\r\n</p>\r\n<p>\r\n	多渠道支付\r\n</p>\r\n<p>\r\n	支付宝微信 网银在线 银联 财付通 余额支付，真正意义上的解决了客户支付问题\r\n</p>\r\n<p>\r\n	数据分析系统\r\n</p>\r\n<p>\r\n	强大的数据分析系统分析了网站的重要运营数据，让运营者一目了然\r\n</p>', '106.39.152.253');
INSERT INTO `xhl_component_content` VALUES ('417', '418', '', '关键词,关键词,关键词,关键词', '', '内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容', '106.39.152.253');

-- ----------------------------
-- Table structure for `xhl_component_photo`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_component_photo`;
CREATE TABLE `xhl_component_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `component_id` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo` varchar(150) DEFAULT '',
  `size` mediumint(8) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_component_photo
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_component_sheji`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_component_sheji`;
CREATE TABLE `xhl_component_sheji` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `component_id` int(11) unsigned NOT NULL COMMENT '项目id',
  `uid` int(11) NOT NULL COMMENT '用户名id',
  `dateline` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_component_sheji
-- ----------------------------
INSERT INTO `xhl_component_sheji` VALUES ('14', '416', '1085', '1483691824');
INSERT INTO `xhl_component_sheji` VALUES ('15', '418', '1087', '1483693227');

-- ----------------------------
-- Table structure for `xhl_data_area`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_data_area`;
CREATE TABLE `xhl_data_area` (
  `area_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `area_name` varchar(50) DEFAULT '',
  `orderby` smallint(6) DEFAULT '50',
  PRIMARY KEY (`area_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1726 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_data_area
-- ----------------------------
INSERT INTO `xhl_data_area` VALUES ('3', '7', '新站区', '50');
INSERT INTO `xhl_data_area` VALUES ('4', '7', '庐阳区', '50');
INSERT INTO `xhl_data_area` VALUES ('5', '7', '蜀山区', '50');
INSERT INTO `xhl_data_area` VALUES ('6', '7', '瑶海区', '50');
INSERT INTO `xhl_data_area` VALUES ('7', '7', '包河区', '50');
INSERT INTO `xhl_data_area` VALUES ('8', '7', '政务区', '50');
INSERT INTO `xhl_data_area` VALUES ('9', '7', '高新区', '50');
INSERT INTO `xhl_data_area` VALUES ('10', '7', '经开区', '50');
INSERT INTO `xhl_data_area` VALUES ('11', '7', '政务区', '50');
INSERT INTO `xhl_data_area` VALUES ('12', '8', '东城', '1');
INSERT INTO `xhl_data_area` VALUES ('13', '8', '西城', '2');
INSERT INTO `xhl_data_area` VALUES ('14', '8', '朝阳', '4');
INSERT INTO `xhl_data_area` VALUES ('15', '8', '丰台', '6');
INSERT INTO `xhl_data_area` VALUES ('16', '8', '石景山', '5');
INSERT INTO `xhl_data_area` VALUES ('17', '8', '海淀', '3');
INSERT INTO `xhl_data_area` VALUES ('18', '8', '门头沟', '9');
INSERT INTO `xhl_data_area` VALUES ('19', '8', '房山', '10');
INSERT INTO `xhl_data_area` VALUES ('20', '8', '大兴', '12');
INSERT INTO `xhl_data_area` VALUES ('21', '8', '昌平', '7');
INSERT INTO `xhl_data_area` VALUES ('22', '8', '顺义', '11');
INSERT INTO `xhl_data_area` VALUES ('23', '8', '通州', '8');
INSERT INTO `xhl_data_area` VALUES ('24', '8', '延庆县', '16');
INSERT INTO `xhl_data_area` VALUES ('25', '8', '怀柔区', '15');
INSERT INTO `xhl_data_area` VALUES ('26', '8', '密云县', '14');
INSERT INTO `xhl_data_area` VALUES ('27', '8', '平谷区', '13');
INSERT INTO `xhl_data_area` VALUES ('28', '9', '宝山', '50');
INSERT INTO `xhl_data_area` VALUES ('29', '9', '长宁', '50');
INSERT INTO `xhl_data_area` VALUES ('30', '9', '奉贤', '50');
INSERT INTO `xhl_data_area` VALUES ('31', '9', '虹口', '50');
INSERT INTO `xhl_data_area` VALUES ('32', '9', '黄浦', '50');
INSERT INTO `xhl_data_area` VALUES ('33', '9', '嘉定', '50');
INSERT INTO `xhl_data_area` VALUES ('34', '9', '金山', '50');
INSERT INTO `xhl_data_area` VALUES ('35', '9', '静安', '50');
INSERT INTO `xhl_data_area` VALUES ('36', '9', '卢湾', '50');
INSERT INTO `xhl_data_area` VALUES ('37', '9', '闵行', '50');
INSERT INTO `xhl_data_area` VALUES ('38', '9', '南汇', '50');
INSERT INTO `xhl_data_area` VALUES ('39', '9', '浦东新区', '50');
INSERT INTO `xhl_data_area` VALUES ('40', '9', '普陀', '50');
INSERT INTO `xhl_data_area` VALUES ('41', '9', '青浦', '50');
INSERT INTO `xhl_data_area` VALUES ('42', '9', '松江', '50');
INSERT INTO `xhl_data_area` VALUES ('43', '9', '徐汇', '50');
INSERT INTO `xhl_data_area` VALUES ('44', '9', '杨浦', '50');
INSERT INTO `xhl_data_area` VALUES ('45', '9', '闸北', '50');
INSERT INTO `xhl_data_area` VALUES ('46', '9', '崇明县', '50');
INSERT INTO `xhl_data_area` VALUES ('47', '9', '浦东新区周边', '50');
INSERT INTO `xhl_data_area` VALUES ('48', '9', '南汇周边', '50');
INSERT INTO `xhl_data_area` VALUES ('49', '11', '静海县', '50');
INSERT INTO `xhl_data_area` VALUES ('50', '11', '宁河县', '50');
INSERT INTO `xhl_data_area` VALUES ('51', '11', '蓟县', '50');
INSERT INTO `xhl_data_area` VALUES ('52', '11', '宝坻', '50');
INSERT INTO `xhl_data_area` VALUES ('53', '11', '北辰', '50');
INSERT INTO `xhl_data_area` VALUES ('54', '11', '大港', '50');
INSERT INTO `xhl_data_area` VALUES ('55', '11', '东丽', '50');
INSERT INTO `xhl_data_area` VALUES ('56', '11', '汉沽', '50');
INSERT INTO `xhl_data_area` VALUES ('57', '11', '和平', '50');
INSERT INTO `xhl_data_area` VALUES ('58', '11', '河北', '50');
INSERT INTO `xhl_data_area` VALUES ('59', '11', '河东', '50');
INSERT INTO `xhl_data_area` VALUES ('60', '11', '河西', '50');
INSERT INTO `xhl_data_area` VALUES ('61', '11', '红桥', '50');
INSERT INTO `xhl_data_area` VALUES ('62', '11', '津南', '50');
INSERT INTO `xhl_data_area` VALUES ('63', '11', '南开', '50');
INSERT INTO `xhl_data_area` VALUES ('64', '11', '塘沽', '50');
INSERT INTO `xhl_data_area` VALUES ('65', '11', '武清', '50');
INSERT INTO `xhl_data_area` VALUES ('66', '11', '西青', '50');
INSERT INTO `xhl_data_area` VALUES ('67', '12', '海珠', '50');
INSERT INTO `xhl_data_area` VALUES ('68', '12', '白云', '50');
INSERT INTO `xhl_data_area` VALUES ('69', '12', '花都 ', '50');
INSERT INTO `xhl_data_area` VALUES ('70', '12', '黄埔 ', '50');
INSERT INTO `xhl_data_area` VALUES ('71', '12', '荔湾 ', '50');
INSERT INTO `xhl_data_area` VALUES ('72', '12', '萝岗 ', '50');
INSERT INTO `xhl_data_area` VALUES ('73', '12', '南沙 ', '50');
INSERT INTO `xhl_data_area` VALUES ('74', '12', '天河 ', '50');
INSERT INTO `xhl_data_area` VALUES ('75', '12', '越秀 ', '50');
INSERT INTO `xhl_data_area` VALUES ('76', '12', '从化市 ', '50');
INSERT INTO `xhl_data_area` VALUES ('77', '12', '增城市 ', '50');
INSERT INTO `xhl_data_area` VALUES ('78', '12', '番禺', '50');
INSERT INTO `xhl_data_area` VALUES ('79', '13', '南山', '50');
INSERT INTO `xhl_data_area` VALUES ('80', '13', '宝安', '50');
INSERT INTO `xhl_data_area` VALUES ('81', '13', '福田', '50');
INSERT INTO `xhl_data_area` VALUES ('82', '13', '龙岗', '50');
INSERT INTO `xhl_data_area` VALUES ('83', '13', '罗湖', '50');
INSERT INTO `xhl_data_area` VALUES ('84', '13', '盐田', '50');
INSERT INTO `xhl_data_area` VALUES ('85', '13', '龙华新区', '50');
INSERT INTO `xhl_data_area` VALUES ('86', '13', '光明新区', '50');
INSERT INTO `xhl_data_area` VALUES ('87', '13', '坪山新区', '50');
INSERT INTO `xhl_data_area` VALUES ('88', '13', '大鹏新区', '50');
INSERT INTO `xhl_data_area` VALUES ('89', '13', '龙岗周边', '50');
INSERT INTO `xhl_data_area` VALUES ('90', '13', '宝安周边', '50');
INSERT INTO `xhl_data_area` VALUES ('91', '14', '永川', '50');
INSERT INTO `xhl_data_area` VALUES ('92', '14', '合川', '50');
INSERT INTO `xhl_data_area` VALUES ('93', '14', '江津', '50');
INSERT INTO `xhl_data_area` VALUES ('94', '14', '南川', '50');
INSERT INTO `xhl_data_area` VALUES ('95', '14', '綦江县', '50');
INSERT INTO `xhl_data_area` VALUES ('96', '14', '潼南县', '50');
INSERT INTO `xhl_data_area` VALUES ('97', '14', '荣昌县', '50');
INSERT INTO `xhl_data_area` VALUES ('98', '14', '璧山县', '50');
INSERT INTO `xhl_data_area` VALUES ('99', '14', '大足县', '50');
INSERT INTO `xhl_data_area` VALUES ('100', '14', '梁平县', '50');
INSERT INTO `xhl_data_area` VALUES ('101', '14', '城口县', '50');
INSERT INTO `xhl_data_area` VALUES ('102', '14', '垫江县', '50');
INSERT INTO `xhl_data_area` VALUES ('103', '14', '武隆县', '50');
INSERT INTO `xhl_data_area` VALUES ('104', '14', '丰都县', '50');
INSERT INTO `xhl_data_area` VALUES ('105', '14', '奉节县', '50');
INSERT INTO `xhl_data_area` VALUES ('106', '14', '开县', '50');
INSERT INTO `xhl_data_area` VALUES ('107', '14', '云阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('108', '14', '忠县', '50');
INSERT INTO `xhl_data_area` VALUES ('109', '14', '巫溪县', '50');
INSERT INTO `xhl_data_area` VALUES ('110', '14', '巫山县', '50');
INSERT INTO `xhl_data_area` VALUES ('111', '14', '石柱土家族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('112', '14', '秀山土家族苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('113', '15', '白下', '50');
INSERT INTO `xhl_data_area` VALUES ('114', '15', '鼓楼', '50');
INSERT INTO `xhl_data_area` VALUES ('115', '15', '建邺', '50');
INSERT INTO `xhl_data_area` VALUES ('116', '15', '江宁', '50');
INSERT INTO `xhl_data_area` VALUES ('117', '15', '六合', '50');
INSERT INTO `xhl_data_area` VALUES ('118', '15', '浦口', '50');
INSERT INTO `xhl_data_area` VALUES ('119', '15', '栖霞', '50');
INSERT INTO `xhl_data_area` VALUES ('120', '15', '秦淮', '50');
INSERT INTO `xhl_data_area` VALUES ('121', '15', '下关', '50');
INSERT INTO `xhl_data_area` VALUES ('122', '15', '玄武', '50');
INSERT INTO `xhl_data_area` VALUES ('123', '15', '雨花台', '50');
INSERT INTO `xhl_data_area` VALUES ('124', '15', '溧水县', '50');
INSERT INTO `xhl_data_area` VALUES ('125', '15', '高淳县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('126', '16', '高陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('127', '16', '蓝田县', '50');
INSERT INTO `xhl_data_area` VALUES ('128', '16', '户县', '50');
INSERT INTO `xhl_data_area` VALUES ('129', '16', '周至县', '50');
INSERT INTO `xhl_data_area` VALUES ('130', '16', '灞桥', '50');
INSERT INTO `xhl_data_area` VALUES ('131', '16', '长安', '50');
INSERT INTO `xhl_data_area` VALUES ('132', '16', '莲湖', '50');
INSERT INTO `xhl_data_area` VALUES ('133', '16', '临潼', '50');
INSERT INTO `xhl_data_area` VALUES ('134', '16', '未央', '50');
INSERT INTO `xhl_data_area` VALUES ('135', '16', '新城', '50');
INSERT INTO `xhl_data_area` VALUES ('136', '16', '阎良', '50');
INSERT INTO `xhl_data_area` VALUES ('137', '16', '雁塔', '50');
INSERT INTO `xhl_data_area` VALUES ('138', '16', '碑林', '50');
INSERT INTO `xhl_data_area` VALUES ('139', '16', '西安南', '50');
INSERT INTO `xhl_data_area` VALUES ('140', '17', '建德市', '50');
INSERT INTO `xhl_data_area` VALUES ('141', '17', '富阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('142', '17', '临安市', '50');
INSERT INTO `xhl_data_area` VALUES ('143', '17', '桐庐县', '50');
INSERT INTO `xhl_data_area` VALUES ('144', '17', '淳安县', '50');
INSERT INTO `xhl_data_area` VALUES ('145', '17', '滨江', '50');
INSERT INTO `xhl_data_area` VALUES ('146', '17', '拱墅', '50');
INSERT INTO `xhl_data_area` VALUES ('147', '17', '江干', '50');
INSERT INTO `xhl_data_area` VALUES ('148', '17', '上城', '50');
INSERT INTO `xhl_data_area` VALUES ('149', '17', '西湖', '50');
INSERT INTO `xhl_data_area` VALUES ('150', '17', '下城', '50');
INSERT INTO `xhl_data_area` VALUES ('151', '17', '上萧山', '50');
INSERT INTO `xhl_data_area` VALUES ('152', '17', '余杭', '50');
INSERT INTO `xhl_data_area` VALUES ('153', '17', '新余杭', '50');
INSERT INTO `xhl_data_area` VALUES ('154', '17', '下萧山', '50');
INSERT INTO `xhl_data_area` VALUES ('155', '18', '都江堰市', '50');
INSERT INTO `xhl_data_area` VALUES ('156', '18', '彭州市', '50');
INSERT INTO `xhl_data_area` VALUES ('157', '18', '邛崃市', '50');
INSERT INTO `xhl_data_area` VALUES ('158', '18', '崇州市', '50');
INSERT INTO `xhl_data_area` VALUES ('159', '18', '金堂县', '50');
INSERT INTO `xhl_data_area` VALUES ('160', '18', '郫县', '50');
INSERT INTO `xhl_data_area` VALUES ('161', '18', '新津县', '50');
INSERT INTO `xhl_data_area` VALUES ('162', '18', '双流县', '50');
INSERT INTO `xhl_data_area` VALUES ('163', '18', '蒲江县', '50');
INSERT INTO `xhl_data_area` VALUES ('164', '18', '大邑县', '50');
INSERT INTO `xhl_data_area` VALUES ('165', '18', '成华', '50');
INSERT INTO `xhl_data_area` VALUES ('166', '18', '金牛', '50');
INSERT INTO `xhl_data_area` VALUES ('167', '18', '锦江', '50');
INSERT INTO `xhl_data_area` VALUES ('168', '18', '龙泉驿', '50');
INSERT INTO `xhl_data_area` VALUES ('169', '18', '青白江', '50');
INSERT INTO `xhl_data_area` VALUES ('170', '18', '青羊', '50');
INSERT INTO `xhl_data_area` VALUES ('171', '18', '温江', '50');
INSERT INTO `xhl_data_area` VALUES ('172', '18', '武侯', '50');
INSERT INTO `xhl_data_area` VALUES ('173', '18', '新都', '50');
INSERT INTO `xhl_data_area` VALUES ('174', '18', '高新区', '50');
INSERT INTO `xhl_data_area` VALUES ('175', '18', '天府新区', '50');
INSERT INTO `xhl_data_area` VALUES ('176', '19', '长乐市', '50');
INSERT INTO `xhl_data_area` VALUES ('177', '19', '仓山', '50');
INSERT INTO `xhl_data_area` VALUES ('178', '19', '晋安', '50');
INSERT INTO `xhl_data_area` VALUES ('179', '19', '马尾', '50');
INSERT INTO `xhl_data_area` VALUES ('180', '19', '台江', '50');
INSERT INTO `xhl_data_area` VALUES ('181', '19', '鼓楼', '50');
INSERT INTO `xhl_data_area` VALUES ('182', '19', '福清市', '50');
INSERT INTO `xhl_data_area` VALUES ('183', '19', '闽侯县', '50');
INSERT INTO `xhl_data_area` VALUES ('184', '19', '闽清县', '50');
INSERT INTO `xhl_data_area` VALUES ('185', '19', '永泰县', '50');
INSERT INTO `xhl_data_area` VALUES ('186', '19', '连江县', '50');
INSERT INTO `xhl_data_area` VALUES ('187', '19', '罗源县', '50');
INSERT INTO `xhl_data_area` VALUES ('188', '19', '平潭县', '50');
INSERT INTO `xhl_data_area` VALUES ('189', '20', '江岸', '50');
INSERT INTO `xhl_data_area` VALUES ('190', '20', '蔡甸', '50');
INSERT INTO `xhl_data_area` VALUES ('191', '20', '东西湖', '50');
INSERT INTO `xhl_data_area` VALUES ('192', '20', '汉南', '50');
INSERT INTO `xhl_data_area` VALUES ('193', '20', '汉阳', '50');
INSERT INTO `xhl_data_area` VALUES ('194', '20', '洪山', '50');
INSERT INTO `xhl_data_area` VALUES ('195', '20', '黄陂', '50');
INSERT INTO `xhl_data_area` VALUES ('196', '20', '江汉', '50');
INSERT INTO `xhl_data_area` VALUES ('197', '20', '江夏', '50');
INSERT INTO `xhl_data_area` VALUES ('198', '20', '硚口', '50');
INSERT INTO `xhl_data_area` VALUES ('199', '20', '青山', '50');
INSERT INTO `xhl_data_area` VALUES ('200', '20', '武昌', '50');
INSERT INTO `xhl_data_area` VALUES ('201', '20', '新洲', '50');
INSERT INTO `xhl_data_area` VALUES ('202', '21', '大东', '50');
INSERT INTO `xhl_data_area` VALUES ('203', '21', '东陵', '50');
INSERT INTO `xhl_data_area` VALUES ('204', '21', '和平', '50');
INSERT INTO `xhl_data_area` VALUES ('205', '21', '皇姑', '50');
INSERT INTO `xhl_data_area` VALUES ('206', '21', '沈北新区', '50');
INSERT INTO `xhl_data_area` VALUES ('207', '21', '沈河', '50');
INSERT INTO `xhl_data_area` VALUES ('208', '21', '苏家屯', '50');
INSERT INTO `xhl_data_area` VALUES ('209', '21', '于洪', '50');
INSERT INTO `xhl_data_area` VALUES ('210', '21', '铁西', '50');
INSERT INTO `xhl_data_area` VALUES ('211', '21', '新民市', '50');
INSERT INTO `xhl_data_area` VALUES ('212', '21', '法库县', '50');
INSERT INTO `xhl_data_area` VALUES ('213', '21', '辽中县', '50');
INSERT INTO `xhl_data_area` VALUES ('214', '21', '康平县', '50');
INSERT INTO `xhl_data_area` VALUES ('215', '21', '浑南新区', '50');
INSERT INTO `xhl_data_area` VALUES ('216', '22', '甘井子', '50');
INSERT INTO `xhl_data_area` VALUES ('217', '22', '金州', '50');
INSERT INTO `xhl_data_area` VALUES ('218', '22', '沙河口', '50');
INSERT INTO `xhl_data_area` VALUES ('219', '22', '西岗', '50');
INSERT INTO `xhl_data_area` VALUES ('220', '22', '中山', '50');
INSERT INTO `xhl_data_area` VALUES ('221', '22', '旅顺口', '50');
INSERT INTO `xhl_data_area` VALUES ('222', '22', '瓦房店市', '50');
INSERT INTO `xhl_data_area` VALUES ('223', '22', '普兰店市', '50');
INSERT INTO `xhl_data_area` VALUES ('224', '22', '庄河市', '50');
INSERT INTO `xhl_data_area` VALUES ('225', '22', '长海县', '50');
INSERT INTO `xhl_data_area` VALUES ('226', '22', '开发高新园', '50');
INSERT INTO `xhl_data_area` VALUES ('227', '23', '行唐县', '50');
INSERT INTO `xhl_data_area` VALUES ('228', '23', '桥西', '50');
INSERT INTO `xhl_data_area` VALUES ('229', '23', '长安', '50');
INSERT INTO `xhl_data_area` VALUES ('230', '23', '井陉矿', '50');
INSERT INTO `xhl_data_area` VALUES ('231', '23', '桥东', '50');
INSERT INTO `xhl_data_area` VALUES ('232', '23', '新华', '50');
INSERT INTO `xhl_data_area` VALUES ('233', '23', '裕华', '50');
INSERT INTO `xhl_data_area` VALUES ('234', '23', '辛集市', '50');
INSERT INTO `xhl_data_area` VALUES ('235', '23', '藁城市', '50');
INSERT INTO `xhl_data_area` VALUES ('236', '23', '晋州市', '50');
INSERT INTO `xhl_data_area` VALUES ('237', '23', '新乐市', '50');
INSERT INTO `xhl_data_area` VALUES ('238', '23', '鹿泉市', '50');
INSERT INTO `xhl_data_area` VALUES ('239', '23', '平山县', '50');
INSERT INTO `xhl_data_area` VALUES ('240', '23', '井陉县', '50');
INSERT INTO `xhl_data_area` VALUES ('241', '23', '栾城县', '50');
INSERT INTO `xhl_data_area` VALUES ('242', '23', '正定县', '50');
INSERT INTO `xhl_data_area` VALUES ('243', '23', '灵寿县', '50');
INSERT INTO `xhl_data_area` VALUES ('244', '23', '高邑县', '50');
INSERT INTO `xhl_data_area` VALUES ('245', '23', '赵县', '50');
INSERT INTO `xhl_data_area` VALUES ('246', '23', '赞皇县', '50');
INSERT INTO `xhl_data_area` VALUES ('247', '23', '深泽县', '50');
INSERT INTO `xhl_data_area` VALUES ('248', '23', '无极县', '50');
INSERT INTO `xhl_data_area` VALUES ('249', '23', '元氏县', '50');
INSERT INTO `xhl_data_area` VALUES ('250', '27', '肇源县', '50');
INSERT INTO `xhl_data_area` VALUES ('251', '27', '大同', '50');
INSERT INTO `xhl_data_area` VALUES ('252', '27', '红岗', '50');
INSERT INTO `xhl_data_area` VALUES ('253', '27', '龙凤', '50');
INSERT INTO `xhl_data_area` VALUES ('254', '27', '让胡路', '50');
INSERT INTO `xhl_data_area` VALUES ('255', '27', '萨尔图', '50');
INSERT INTO `xhl_data_area` VALUES ('256', '27', '林甸县', '50');
INSERT INTO `xhl_data_area` VALUES ('257', '27', '肇州县', '50');
INSERT INTO `xhl_data_area` VALUES ('258', '27', '杜尔伯特蒙古族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('259', '28', '南岗', '50');
INSERT INTO `xhl_data_area` VALUES ('260', '28', '道里', '50');
INSERT INTO `xhl_data_area` VALUES ('261', '28', '道外', '50');
INSERT INTO `xhl_data_area` VALUES ('262', '28', '平房', '50');
INSERT INTO `xhl_data_area` VALUES ('263', '28', '松北', '50');
INSERT INTO `xhl_data_area` VALUES ('264', '28', '香坊', '50');
INSERT INTO `xhl_data_area` VALUES ('265', '28', '阿城', '50');
INSERT INTO `xhl_data_area` VALUES ('266', '28', '尚志市', '50');
INSERT INTO `xhl_data_area` VALUES ('267', '28', '双城市', '50');
INSERT INTO `xhl_data_area` VALUES ('268', '28', '五常市', '50');
INSERT INTO `xhl_data_area` VALUES ('269', '28', '呼兰', '50');
INSERT INTO `xhl_data_area` VALUES ('270', '28', '方正县', '50');
INSERT INTO `xhl_data_area` VALUES ('271', '28', '宾县', '50');
INSERT INTO `xhl_data_area` VALUES ('272', '28', '依兰县', '50');
INSERT INTO `xhl_data_area` VALUES ('273', '28', '巴彦县', '50');
INSERT INTO `xhl_data_area` VALUES ('274', '28', '通河县', '50');
INSERT INTO `xhl_data_area` VALUES ('275', '28', '木兰县', '50');
INSERT INTO `xhl_data_area` VALUES ('276', '28', '延寿县', '50');
INSERT INTO `xhl_data_area` VALUES ('277', '29', '德惠市', '50');
INSERT INTO `xhl_data_area` VALUES ('278', '29', '南关', '50');
INSERT INTO `xhl_data_area` VALUES ('279', '29', '朝阳', '50');
INSERT INTO `xhl_data_area` VALUES ('280', '29', '二道', '50');
INSERT INTO `xhl_data_area` VALUES ('281', '29', '宽城', '50');
INSERT INTO `xhl_data_area` VALUES ('282', '29', '绿园', '50');
INSERT INTO `xhl_data_area` VALUES ('283', '29', '双阳', '50');
INSERT INTO `xhl_data_area` VALUES ('284', '29', '九台市', '50');
INSERT INTO `xhl_data_area` VALUES ('285', '29', '榆树市', '50');
INSERT INTO `xhl_data_area` VALUES ('286', '29', '农安县', '50');
INSERT INTO `xhl_data_area` VALUES ('287', '30', '北戴河', '50');
INSERT INTO `xhl_data_area` VALUES ('288', '30', '海港', '50');
INSERT INTO `xhl_data_area` VALUES ('289', '30', '山海关', '50');
INSERT INTO `xhl_data_area` VALUES ('290', '30', '昌黎县', '50');
INSERT INTO `xhl_data_area` VALUES ('291', '30', '卢龙县', '50');
INSERT INTO `xhl_data_area` VALUES ('292', '30', '抚宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('293', '30', '青龙满族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('294', '31', '集宁', '50');
INSERT INTO `xhl_data_area` VALUES ('295', '31', '丰镇市', '50');
INSERT INTO `xhl_data_area` VALUES ('296', '31', '兴和县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('297', '31', '卓资县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('298', '31', '商都县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('299', '31', '凉城县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('300', '31', '化德县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('301', '31', '察哈尔右翼前旗 ', '50');
INSERT INTO `xhl_data_area` VALUES ('302', '31', '察哈尔右翼中旗 ', '50');
INSERT INTO `xhl_data_area` VALUES ('303', '31', '察哈尔右翼后旗 ', '50');
INSERT INTO `xhl_data_area` VALUES ('304', '31', '四子王旗', '50');
INSERT INTO `xhl_data_area` VALUES ('305', '32', '清河', '50');
INSERT INTO `xhl_data_area` VALUES ('306', '32', '银州', '50');
INSERT INTO `xhl_data_area` VALUES ('307', '32', '调兵山市', '50');
INSERT INTO `xhl_data_area` VALUES ('308', '32', '开原市', '50');
INSERT INTO `xhl_data_area` VALUES ('309', '32', '铁岭县', '50');
INSERT INTO `xhl_data_area` VALUES ('310', '32', '昌图县', '50');
INSERT INTO `xhl_data_area` VALUES ('311', '32', '西丰县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('312', '33', '安国市', '50');
INSERT INTO `xhl_data_area` VALUES ('313', '33', '望都县', '50');
INSERT INTO `xhl_data_area` VALUES ('314', '33', '北市', '50');
INSERT INTO `xhl_data_area` VALUES ('315', '33', '南市', '50');
INSERT INTO `xhl_data_area` VALUES ('316', '33', '新市', '50');
INSERT INTO `xhl_data_area` VALUES ('317', '33', '涿州市', '50');
INSERT INTO `xhl_data_area` VALUES ('318', '33', '定州市', '50');
INSERT INTO `xhl_data_area` VALUES ('319', '33', '高碑店市', '50');
INSERT INTO `xhl_data_area` VALUES ('320', '33', '满城县', '50');
INSERT INTO `xhl_data_area` VALUES ('321', '33', '清苑县', '50');
INSERT INTO `xhl_data_area` VALUES ('322', '33', '涞水县', '50');
INSERT INTO `xhl_data_area` VALUES ('323', '33', '阜平县', '50');
INSERT INTO `xhl_data_area` VALUES ('324', '33', '徐水县', '50');
INSERT INTO `xhl_data_area` VALUES ('325', '33', '定兴县', '50');
INSERT INTO `xhl_data_area` VALUES ('326', '33', '唐县', '50');
INSERT INTO `xhl_data_area` VALUES ('327', '33', '高阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('328', '33', '容城县', '50');
INSERT INTO `xhl_data_area` VALUES ('329', '33', '涞源县', '50');
INSERT INTO `xhl_data_area` VALUES ('330', '33', '安新县', '50');
INSERT INTO `xhl_data_area` VALUES ('331', '33', '易县', '50');
INSERT INTO `xhl_data_area` VALUES ('332', '33', '曲阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('333', '33', '蠡县', '50');
INSERT INTO `xhl_data_area` VALUES ('334', '33', '顺平县', '50');
INSERT INTO `xhl_data_area` VALUES ('335', '33', '博野县', '50');
INSERT INTO `xhl_data_area` VALUES ('336', '33', '雄县', '50');
INSERT INTO `xhl_data_area` VALUES ('337', '34', '丛台', '50');
INSERT INTO `xhl_data_area` VALUES ('338', '34', '峰峰矿', '50');
INSERT INTO `xhl_data_area` VALUES ('339', '34', '复兴', '50');
INSERT INTO `xhl_data_area` VALUES ('340', '34', '邯山', '50');
INSERT INTO `xhl_data_area` VALUES ('341', '34', '安市', '50');
INSERT INTO `xhl_data_area` VALUES ('342', '34', '邯郸县', '50');
INSERT INTO `xhl_data_area` VALUES ('343', '34', '永年县', '50');
INSERT INTO `xhl_data_area` VALUES ('344', '34', '曲周县', '50');
INSERT INTO `xhl_data_area` VALUES ('345', '34', '馆陶县', '50');
INSERT INTO `xhl_data_area` VALUES ('346', '34', '魏县', '50');
INSERT INTO `xhl_data_area` VALUES ('347', '34', '成安县', '50');
INSERT INTO `xhl_data_area` VALUES ('348', '34', '大名县', '50');
INSERT INTO `xhl_data_area` VALUES ('349', '34', '涉县', '50');
INSERT INTO `xhl_data_area` VALUES ('350', '34', '鸡泽县', '50');
INSERT INTO `xhl_data_area` VALUES ('351', '34', '邱县', '50');
INSERT INTO `xhl_data_area` VALUES ('352', '34', '广平县', '50');
INSERT INTO `xhl_data_area` VALUES ('353', '34', '肥乡县', '50');
INSERT INTO `xhl_data_area` VALUES ('354', '34', '临漳县', '50');
INSERT INTO `xhl_data_area` VALUES ('355', '34', '磁县', '50');
INSERT INTO `xhl_data_area` VALUES ('356', '35', '昌邑', '50');
INSERT INTO `xhl_data_area` VALUES ('357', '35', '船营', '50');
INSERT INTO `xhl_data_area` VALUES ('358', '35', '丰满', '50');
INSERT INTO `xhl_data_area` VALUES ('359', '35', '龙潭', '50');
INSERT INTO `xhl_data_area` VALUES ('360', '35', '舒兰市', '50');
INSERT INTO `xhl_data_area` VALUES ('361', '35', '桦甸市', '50');
INSERT INTO `xhl_data_area` VALUES ('362', '35', '蛟河市', '50');
INSERT INTO `xhl_data_area` VALUES ('363', '35', '磐石市', '50');
INSERT INTO `xhl_data_area` VALUES ('364', '35', '永吉县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('365', '36', '东昌', '50');
INSERT INTO `xhl_data_area` VALUES ('366', '36', '二道江', '50');
INSERT INTO `xhl_data_area` VALUES ('367', '36', '梅河口市', '50');
INSERT INTO `xhl_data_area` VALUES ('368', '36', '集安市', '50');
INSERT INTO `xhl_data_area` VALUES ('369', '36', '通化县', '50');
INSERT INTO `xhl_data_area` VALUES ('370', '36', '辉南县', '50');
INSERT INTO `xhl_data_area` VALUES ('371', '36', '柳河县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('372', '37', '隆尧县', '50');
INSERT INTO `xhl_data_area` VALUES ('373', '37', '桥东', '50');
INSERT INTO `xhl_data_area` VALUES ('374', '37', '桥西', '50');
INSERT INTO `xhl_data_area` VALUES ('375', '37', '南宫市', '50');
INSERT INTO `xhl_data_area` VALUES ('376', '37', '沙河市', '50');
INSERT INTO `xhl_data_area` VALUES ('377', '37', '邢台县', '50');
INSERT INTO `xhl_data_area` VALUES ('378', '37', '柏乡县', '50');
INSERT INTO `xhl_data_area` VALUES ('379', '37', '任县', '50');
INSERT INTO `xhl_data_area` VALUES ('380', '37', '清河', '50');
INSERT INTO `xhl_data_area` VALUES ('381', '37', '县宁', '50');
INSERT INTO `xhl_data_area` VALUES ('382', '37', '晋县', '50');
INSERT INTO `xhl_data_area` VALUES ('383', '37', '威县', '50');
INSERT INTO `xhl_data_area` VALUES ('384', '37', '临城县', '50');
INSERT INTO `xhl_data_area` VALUES ('385', '37', '广宗县', '50');
INSERT INTO `xhl_data_area` VALUES ('386', '37', '临西县', '50');
INSERT INTO `xhl_data_area` VALUES ('387', '37', '内丘县', '50');
INSERT INTO `xhl_data_area` VALUES ('388', '37', '平乡县', '50');
INSERT INTO `xhl_data_area` VALUES ('389', '37', '巨鹿县', '50');
INSERT INTO `xhl_data_area` VALUES ('390', '37', '新河县', '50');
INSERT INTO `xhl_data_area` VALUES ('391', '37', '南和县', '50');
INSERT INTO `xhl_data_area` VALUES ('392', '38', '沧浪', '50');
INSERT INTO `xhl_data_area` VALUES ('393', '38', '虎丘', '50');
INSERT INTO `xhl_data_area` VALUES ('394', '38', '金阊', '50');
INSERT INTO `xhl_data_area` VALUES ('395', '38', '平江', '50');
INSERT INTO `xhl_data_area` VALUES ('396', '38', '吴中', '50');
INSERT INTO `xhl_data_area` VALUES ('397', '38', '相城', '50');
INSERT INTO `xhl_data_area` VALUES ('398', '38', '吴江市', '50');
INSERT INTO `xhl_data_area` VALUES ('399', '38', '高新区工业园', '50');
INSERT INTO `xhl_data_area` VALUES ('400', '10', '长清', '50');
INSERT INTO `xhl_data_area` VALUES ('401', '10', '槐荫', '50');
INSERT INTO `xhl_data_area` VALUES ('402', '10', '历城', '50');
INSERT INTO `xhl_data_area` VALUES ('403', '10', '市中', '50');
INSERT INTO `xhl_data_area` VALUES ('404', '10', '天桥', '50');
INSERT INTO `xhl_data_area` VALUES ('405', '10', '历下', '50');
INSERT INTO `xhl_data_area` VALUES ('406', '10', '章丘市', '50');
INSERT INTO `xhl_data_area` VALUES ('407', '10', '平阴县', '50');
INSERT INTO `xhl_data_area` VALUES ('408', '10', '济阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('409', '10', '商河县', '50');
INSERT INTO `xhl_data_area` VALUES ('410', '39', '张家港市', '50');
INSERT INTO `xhl_data_area` VALUES ('411', '39', '太仓市', '50');
INSERT INTO `xhl_data_area` VALUES ('412', '40', '北塘', '50');
INSERT INTO `xhl_data_area` VALUES ('413', '40', '滨湖', '50');
INSERT INTO `xhl_data_area` VALUES ('414', '40', '崇安', '50');
INSERT INTO `xhl_data_area` VALUES ('415', '40', '惠山', '50');
INSERT INTO `xhl_data_area` VALUES ('416', '40', '南长', '50');
INSERT INTO `xhl_data_area` VALUES ('417', '40', '锡山', '50');
INSERT INTO `xhl_data_area` VALUES ('418', '40', '宜兴市', '50');
INSERT INTO `xhl_data_area` VALUES ('419', '40', '其他', '50');
INSERT INTO `xhl_data_area` VALUES ('420', '41', '城阳', '50');
INSERT INTO `xhl_data_area` VALUES ('421', '41', '黄岛', '50');
INSERT INTO `xhl_data_area` VALUES ('422', '41', '崂山', '50');
INSERT INTO `xhl_data_area` VALUES ('423', '41', '李沧', '50');
INSERT INTO `xhl_data_area` VALUES ('424', '41', '市北', '50');
INSERT INTO `xhl_data_area` VALUES ('425', '41', '四方', '50');
INSERT INTO `xhl_data_area` VALUES ('426', '41', '市南', '50');
INSERT INTO `xhl_data_area` VALUES ('427', '41', '胶南市', '50');
INSERT INTO `xhl_data_area` VALUES ('428', '41', '胶州市', '50');
INSERT INTO `xhl_data_area` VALUES ('429', '41', '平度市', '50');
INSERT INTO `xhl_data_area` VALUES ('430', '41', '莱西市', '50');
INSERT INTO `xhl_data_area` VALUES ('431', '41', '即墨市', '50');
INSERT INTO `xhl_data_area` VALUES ('432', '41', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('433', '42', '余姚市', '50');
INSERT INTO `xhl_data_area` VALUES ('434', '42', '慈溪市', '50');
INSERT INTO `xhl_data_area` VALUES ('435', '42', '奉化市', '50');
INSERT INTO `xhl_data_area` VALUES ('436', '42', '宁海县', '50');
INSERT INTO `xhl_data_area` VALUES ('437', '42', '象山县', '50');
INSERT INTO `xhl_data_area` VALUES ('438', '42', '北仑', '50');
INSERT INTO `xhl_data_area` VALUES ('439', '42', '海曙', '50');
INSERT INTO `xhl_data_area` VALUES ('440', '42', '江北', '50');
INSERT INTO `xhl_data_area` VALUES ('441', '42', '江东', '50');
INSERT INTO `xhl_data_area` VALUES ('442', '42', '鄞州', '50');
INSERT INTO `xhl_data_area` VALUES ('443', '42', '镇海', '50');
INSERT INTO `xhl_data_area` VALUES ('444', '42', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('445', '43', '瑞安市', '50');
INSERT INTO `xhl_data_area` VALUES ('446', '43', '乐清市', '50');
INSERT INTO `xhl_data_area` VALUES ('447', '43', '永嘉县', '50');
INSERT INTO `xhl_data_area` VALUES ('448', '43', '洞头县', '50');
INSERT INTO `xhl_data_area` VALUES ('449', '43', '平阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('450', '43', '苍南县', '50');
INSERT INTO `xhl_data_area` VALUES ('451', '43', '文成县', '50');
INSERT INTO `xhl_data_area` VALUES ('452', '43', '泰顺县', '50');
INSERT INTO `xhl_data_area` VALUES ('453', '43', '龙湾', '50');
INSERT INTO `xhl_data_area` VALUES ('454', '43', '鹿城', '50');
INSERT INTO `xhl_data_area` VALUES ('455', '43', '瓯海', '50');
INSERT INTO `xhl_data_area` VALUES ('456', '43', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('457', '44', '义乌市区', '50');
INSERT INTO `xhl_data_area` VALUES ('458', '44', '其他', '50');
INSERT INTO `xhl_data_area` VALUES ('459', '45', '坊子', '50');
INSERT INTO `xhl_data_area` VALUES ('460', '45', '寒亭', '50');
INSERT INTO `xhl_data_area` VALUES ('461', '45', '潍城', '50');
INSERT INTO `xhl_data_area` VALUES ('462', '45', '奎文', '50');
INSERT INTO `xhl_data_area` VALUES ('463', '45', '青州市', '50');
INSERT INTO `xhl_data_area` VALUES ('464', '45', '诸城市', '50');
INSERT INTO `xhl_data_area` VALUES ('465', '45', '寿光市', '50');
INSERT INTO `xhl_data_area` VALUES ('466', '45', '安丘市', '50');
INSERT INTO `xhl_data_area` VALUES ('467', '45', '高密市', '50');
INSERT INTO `xhl_data_area` VALUES ('468', '45', '昌邑市', '50');
INSERT INTO `xhl_data_area` VALUES ('469', '45', '昌乐县', '50');
INSERT INTO `xhl_data_area` VALUES ('470', '45', '临朐县', '50');
INSERT INTO `xhl_data_area` VALUES ('471', '45', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('472', '46', '任城', '50');
INSERT INTO `xhl_data_area` VALUES ('473', '46', '市中', '50');
INSERT INTO `xhl_data_area` VALUES ('474', '46', '曲阜市', '50');
INSERT INTO `xhl_data_area` VALUES ('475', '46', '兖州市', '50');
INSERT INTO `xhl_data_area` VALUES ('476', '46', '邹城市', '50');
INSERT INTO `xhl_data_area` VALUES ('477', '46', '鱼台县', '50');
INSERT INTO `xhl_data_area` VALUES ('478', '46', '金乡县', '50');
INSERT INTO `xhl_data_area` VALUES ('479', '46', '嘉祥县', '50');
INSERT INTO `xhl_data_area` VALUES ('480', '46', '微山县', '50');
INSERT INTO `xhl_data_area` VALUES ('481', '46', '汶上县', '50');
INSERT INTO `xhl_data_area` VALUES ('482', '46', '泗水县', '50');
INSERT INTO `xhl_data_area` VALUES ('483', '46', '梁山县', '50');
INSERT INTO `xhl_data_area` VALUES ('484', '46', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('485', '47', '福山', '50');
INSERT INTO `xhl_data_area` VALUES ('486', '47', '莱山', '50');
INSERT INTO `xhl_data_area` VALUES ('487', '47', '牟平', '50');
INSERT INTO `xhl_data_area` VALUES ('488', '47', '芝罘', '50');
INSERT INTO `xhl_data_area` VALUES ('489', '47', '龙口市', '50');
INSERT INTO `xhl_data_area` VALUES ('490', '47', '莱阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('491', '47', '莱州市', '50');
INSERT INTO `xhl_data_area` VALUES ('492', '47', '招远市', '50');
INSERT INTO `xhl_data_area` VALUES ('493', '47', '蓬莱市', '50');
INSERT INTO `xhl_data_area` VALUES ('494', '47', '栖霞市', '50');
INSERT INTO `xhl_data_area` VALUES ('495', '47', '海阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('496', '47', '长岛县', '50');
INSERT INTO `xhl_data_area` VALUES ('497', '47', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('498', '48', '崇川', '50');
INSERT INTO `xhl_data_area` VALUES ('499', '48', '港闸', '50');
INSERT INTO `xhl_data_area` VALUES ('500', '48', '如皋市', '50');
INSERT INTO `xhl_data_area` VALUES ('501', '48', '通州市', '50');
INSERT INTO `xhl_data_area` VALUES ('502', '48', '海门市', '50');
INSERT INTO `xhl_data_area` VALUES ('503', '48', '启东市', '50');
INSERT INTO `xhl_data_area` VALUES ('504', '48', '海安县', '50');
INSERT INTO `xhl_data_area` VALUES ('505', '48', '如东县', '50');
INSERT INTO `xhl_data_area` VALUES ('506', '48', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('507', '49', '溧阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('508', '49', '钟楼', '50');
INSERT INTO `xhl_data_area` VALUES ('509', '49', '戚墅堰', '50');
INSERT INTO `xhl_data_area` VALUES ('510', '49', '天宁', '50');
INSERT INTO `xhl_data_area` VALUES ('511', '49', '武进', '50');
INSERT INTO `xhl_data_area` VALUES ('512', '49', '新北', '50');
INSERT INTO `xhl_data_area` VALUES ('513', '49', '金坛市', '50');
INSERT INTO `xhl_data_area` VALUES ('514', '49', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('515', '50', '新沂市', '50');
INSERT INTO `xhl_data_area` VALUES ('516', '50', '鼓楼', '50');
INSERT INTO `xhl_data_area` VALUES ('517', '50', '贾汪', '50');
INSERT INTO `xhl_data_area` VALUES ('518', '50', '泉山', '50');
INSERT INTO `xhl_data_area` VALUES ('519', '50', '云龙', '50');
INSERT INTO `xhl_data_area` VALUES ('520', '50', '九里', '50');
INSERT INTO `xhl_data_area` VALUES ('521', '50', '邳州市', '50');
INSERT INTO `xhl_data_area` VALUES ('522', '50', '铜山县', '50');
INSERT INTO `xhl_data_area` VALUES ('523', '50', '睢宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('524', '50', '沛县', '50');
INSERT INTO `xhl_data_area` VALUES ('525', '50', '丰县', '50');
INSERT INTO `xhl_data_area` VALUES ('526', '50', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('527', '51', '温岭市', '50');
INSERT INTO `xhl_data_area` VALUES ('528', '51', '玉环县', '50');
INSERT INTO `xhl_data_area` VALUES ('529', '51', '天台县', '50');
INSERT INTO `xhl_data_area` VALUES ('530', '51', '仙居县', '50');
INSERT INTO `xhl_data_area` VALUES ('531', '51', '三门县', '50');
INSERT INTO `xhl_data_area` VALUES ('532', '51', '临海市', '50');
INSERT INTO `xhl_data_area` VALUES ('533', '51', '黄岩', '50');
INSERT INTO `xhl_data_area` VALUES ('534', '51', '椒江', '50');
INSERT INTO `xhl_data_area` VALUES ('535', '51', '路桥', '50');
INSERT INTO `xhl_data_area` VALUES ('536', '51', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('537', '52', '海宁市', '50');
INSERT INTO `xhl_data_area` VALUES ('538', '52', '平湖市', '50');
INSERT INTO `xhl_data_area` VALUES ('539', '52', '桐乡市', '50');
INSERT INTO `xhl_data_area` VALUES ('540', '52', '嘉善县', '50');
INSERT INTO `xhl_data_area` VALUES ('541', '52', '海盐县', '50');
INSERT INTO `xhl_data_area` VALUES ('542', '52', '南湖', '50');
INSERT INTO `xhl_data_area` VALUES ('543', '52', '秀洲', '50');
INSERT INTO `xhl_data_area` VALUES ('544', '52', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('545', '53', '兰溪市', '50');
INSERT INTO `xhl_data_area` VALUES ('546', '53', '东阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('547', '53', '永康市', '50');
INSERT INTO `xhl_data_area` VALUES ('548', '53', '武义县', '50');
INSERT INTO `xhl_data_area` VALUES ('549', '53', '浦江县', '50');
INSERT INTO `xhl_data_area` VALUES ('550', '53', '磐安县', '50');
INSERT INTO `xhl_data_area` VALUES ('551', '53', '金东', '50');
INSERT INTO `xhl_data_area` VALUES ('552', '53', '婺城', '50');
INSERT INTO `xhl_data_area` VALUES ('553', '53', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('554', '54', '丰泽', '50');
INSERT INTO `xhl_data_area` VALUES ('555', '54', '鲤城', '50');
INSERT INTO `xhl_data_area` VALUES ('556', '54', '洛江', '50');
INSERT INTO `xhl_data_area` VALUES ('557', '54', '泉港', '50');
INSERT INTO `xhl_data_area` VALUES ('558', '54', '石狮市', '50');
INSERT INTO `xhl_data_area` VALUES ('559', '54', '晋江市', '50');
INSERT INTO `xhl_data_area` VALUES ('560', '54', '南安市', '50');
INSERT INTO `xhl_data_area` VALUES ('561', '54', '惠安县', '50');
INSERT INTO `xhl_data_area` VALUES ('562', '54', '永春县', '50');
INSERT INTO `xhl_data_area` VALUES ('563', '54', '安溪县', '50');
INSERT INTO `xhl_data_area` VALUES ('564', '54', '德化县', '50');
INSERT INTO `xhl_data_area` VALUES ('565', '54', '金门县', '50');
INSERT INTO `xhl_data_area` VALUES ('566', '54', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('567', '55', '东湖', '50');
INSERT INTO `xhl_data_area` VALUES ('568', '55', '青山湖', '50');
INSERT INTO `xhl_data_area` VALUES ('569', '55', '青云谱', '50');
INSERT INTO `xhl_data_area` VALUES ('570', '55', '湾里', '50');
INSERT INTO `xhl_data_area` VALUES ('571', '55', '西湖', '50');
INSERT INTO `xhl_data_area` VALUES ('572', '55', '新建县', '50');
INSERT INTO `xhl_data_area` VALUES ('573', '55', '南昌县', '50');
INSERT INTO `xhl_data_area` VALUES ('574', '55', '进贤县', '50');
INSERT INTO `xhl_data_area` VALUES ('575', '55', '安义县', '50');
INSERT INTO `xhl_data_area` VALUES ('576', '55', '红谷滩', '50');
INSERT INTO `xhl_data_area` VALUES ('577', '55', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('578', '56', '章贡', '50');
INSERT INTO `xhl_data_area` VALUES ('579', '56', '瑞金市', '50');
INSERT INTO `xhl_data_area` VALUES ('580', '56', '南康市', '50');
INSERT INTO `xhl_data_area` VALUES ('581', '56', '石城县', '50');
INSERT INTO `xhl_data_area` VALUES ('582', '56', '安远县', '50');
INSERT INTO `xhl_data_area` VALUES ('583', '56', '赣县宁', '50');
INSERT INTO `xhl_data_area` VALUES ('584', '56', '都县寻', '50');
INSERT INTO `xhl_data_area` VALUES ('585', '56', '乌县', '50');
INSERT INTO `xhl_data_area` VALUES ('586', '56', '兴国县', '50');
INSERT INTO `xhl_data_area` VALUES ('587', '56', '定南县', '50');
INSERT INTO `xhl_data_area` VALUES ('588', '56', '上犹县', '50');
INSERT INTO `xhl_data_area` VALUES ('589', '56', '于都县', '50');
INSERT INTO `xhl_data_area` VALUES ('590', '56', '龙南县', '50');
INSERT INTO `xhl_data_area` VALUES ('591', '56', '崇义县', '50');
INSERT INTO `xhl_data_area` VALUES ('592', '56', '信丰县', '50');
INSERT INTO `xhl_data_area` VALUES ('593', '56', '全南县', '50');
INSERT INTO `xhl_data_area` VALUES ('594', '56', '大余县', '50');
INSERT INTO `xhl_data_area` VALUES ('595', '56', '会昌县', '50');
INSERT INTO `xhl_data_area` VALUES ('596', '57', '连云', '50');
INSERT INTO `xhl_data_area` VALUES ('597', '57', '新浦', '50');
INSERT INTO `xhl_data_area` VALUES ('598', '57', '海州', '50');
INSERT INTO `xhl_data_area` VALUES ('599', '57', '东海县', '50');
INSERT INTO `xhl_data_area` VALUES ('600', '57', '灌云县', '50');
INSERT INTO `xhl_data_area` VALUES ('601', '57', '赣榆县', '50');
INSERT INTO `xhl_data_area` VALUES ('602', '57', '灌南县', '50');
INSERT INTO `xhl_data_area` VALUES ('603', '58', '玉山镇', '50');
INSERT INTO `xhl_data_area` VALUES ('604', '58', '周市镇', '50');
INSERT INTO `xhl_data_area` VALUES ('605', '58', '陆家镇', '50');
INSERT INTO `xhl_data_area` VALUES ('606', '58', '张浦镇', '50');
INSERT INTO `xhl_data_area` VALUES ('607', '58', '周庄镇', '50');
INSERT INTO `xhl_data_area` VALUES ('608', '58', '巴城镇', '50');
INSERT INTO `xhl_data_area` VALUES ('609', '58', '花桥镇', '50');
INSERT INTO `xhl_data_area` VALUES ('610', '58', '千灯镇', '50');
INSERT INTO `xhl_data_area` VALUES ('611', '59', '宿城', '50');
INSERT INTO `xhl_data_area` VALUES ('612', '59', '宿豫', '50');
INSERT INTO `xhl_data_area` VALUES ('613', '59', '沭阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('614', '59', '泗阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('615', '59', '泗洪县', '50');
INSERT INTO `xhl_data_area` VALUES ('616', '60', '广陵', '50');
INSERT INTO `xhl_data_area` VALUES ('617', '60', '邗江', '50');
INSERT INTO `xhl_data_area` VALUES ('618', '60', '维扬', '50');
INSERT INTO `xhl_data_area` VALUES ('619', '60', '高邮市', '50');
INSERT INTO `xhl_data_area` VALUES ('620', '60', '江都市', '50');
INSERT INTO `xhl_data_area` VALUES ('621', '60', '仪征市', '50');
INSERT INTO `xhl_data_area` VALUES ('622', '60', '宝应县', '50');
INSERT INTO `xhl_data_area` VALUES ('623', '62', '涟水县', '50');
INSERT INTO `xhl_data_area` VALUES ('624', '62', '淮安', '50');
INSERT INTO `xhl_data_area` VALUES ('625', '62', '淮阴', '50');
INSERT INTO `xhl_data_area` VALUES ('626', '62', '清河', '50');
INSERT INTO `xhl_data_area` VALUES ('627', '62', '清浦 ', '50');
INSERT INTO `xhl_data_area` VALUES ('628', '62', '洪泽县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('629', '62', '金湖县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('630', '62', '盱眙县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('631', '63', '江山市', '50');
INSERT INTO `xhl_data_area` VALUES ('632', '63', '龙游县', '50');
INSERT INTO `xhl_data_area` VALUES ('633', '63', '常山县', '50');
INSERT INTO `xhl_data_area` VALUES ('634', '63', '开化县', '50');
INSERT INTO `xhl_data_area` VALUES ('635', '63', '柯城', '50');
INSERT INTO `xhl_data_area` VALUES ('636', '63', '衢江 ', '50');
INSERT INTO `xhl_data_area` VALUES ('637', '64', '长兴县', '50');
INSERT INTO `xhl_data_area` VALUES ('638', '64', '德清县', '50');
INSERT INTO `xhl_data_area` VALUES ('639', '64', '安吉县', '50');
INSERT INTO `xhl_data_area` VALUES ('640', '64', '南浔', '50');
INSERT INTO `xhl_data_area` VALUES ('641', '64', '吴兴 ', '50');
INSERT INTO `xhl_data_area` VALUES ('642', '65', '岱山县', '50');
INSERT INTO `xhl_data_area` VALUES ('643', '65', '嵊泗县', '50');
INSERT INTO `xhl_data_area` VALUES ('644', '65', '定海', '50');
INSERT INTO `xhl_data_area` VALUES ('645', '65', '普陀 ', '50');
INSERT INTO `xhl_data_area` VALUES ('646', '66', '诸暨市', '50');
INSERT INTO `xhl_data_area` VALUES ('647', '66', '嵊州市', '50');
INSERT INTO `xhl_data_area` VALUES ('648', '66', '绍兴县', '50');
INSERT INTO `xhl_data_area` VALUES ('649', '66', '新昌县', '50');
INSERT INTO `xhl_data_area` VALUES ('650', '66', '上虞市', '50');
INSERT INTO `xhl_data_area` VALUES ('651', '66', '越城 ', '50');
INSERT INTO `xhl_data_area` VALUES ('652', '67', '镜湖', '50');
INSERT INTO `xhl_data_area` VALUES ('653', '67', '鸠江', '50');
INSERT INTO `xhl_data_area` VALUES ('654', '67', '三山', '50');
INSERT INTO `xhl_data_area` VALUES ('655', '67', '弋江', '50');
INSERT INTO `xhl_data_area` VALUES ('656', '67', '芜湖县', '50');
INSERT INTO `xhl_data_area` VALUES ('657', '67', '南陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('658', '67', '繁昌县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('659', '68', '浔阳', '50');
INSERT INTO `xhl_data_area` VALUES ('660', '68', '庐山', '50');
INSERT INTO `xhl_data_area` VALUES ('661', '68', '瑞昌市', '50');
INSERT INTO `xhl_data_area` VALUES ('662', '68', '九江县', '50');
INSERT INTO `xhl_data_area` VALUES ('663', '68', '星子县', '50');
INSERT INTO `xhl_data_area` VALUES ('664', '68', '武宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('665', '68', '彭泽县', '50');
INSERT INTO `xhl_data_area` VALUES ('666', '68', '永修县', '50');
INSERT INTO `xhl_data_area` VALUES ('667', '68', '修水县', '50');
INSERT INTO `xhl_data_area` VALUES ('668', '68', '湖口县', '50');
INSERT INTO `xhl_data_area` VALUES ('669', '68', '德安县', '50');
INSERT INTO `xhl_data_area` VALUES ('670', '68', '都昌县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('671', '69', '东台市', '50');
INSERT INTO `xhl_data_area` VALUES ('672', '69', '亭湖', '50');
INSERT INTO `xhl_data_area` VALUES ('673', '69', '大丰市', '50');
INSERT INTO `xhl_data_area` VALUES ('674', '69', '盐都', '50');
INSERT INTO `xhl_data_area` VALUES ('675', '69', '建湖县', '50');
INSERT INTO `xhl_data_area` VALUES ('676', '69', '响水县', '50');
INSERT INTO `xhl_data_area` VALUES ('677', '69', '阜宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('678', '69', '射阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('679', '69', '滨海县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('680', '70', '歙县', '50');
INSERT INTO `xhl_data_area` VALUES ('681', '70', '黄山', '50');
INSERT INTO `xhl_data_area` VALUES ('682', '70', '徽州', '50');
INSERT INTO `xhl_data_area` VALUES ('683', '70', '屯溪', '50');
INSERT INTO `xhl_data_area` VALUES ('684', '70', '休宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('685', '70', '祁门县', '50');
INSERT INTO `xhl_data_area` VALUES ('686', '70', '黟县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('687', '71', '河墉镇', '50');
INSERT INTO `xhl_data_area` VALUES ('688', '71', '青阳镇', '50');
INSERT INTO `xhl_data_area` VALUES ('689', '71', '周庄镇 ', '50');
INSERT INTO `xhl_data_area` VALUES ('690', '72', '龙文', '50');
INSERT INTO `xhl_data_area` VALUES ('691', '72', '芗城', '50');
INSERT INTO `xhl_data_area` VALUES ('692', '72', '龙海市', '50');
INSERT INTO `xhl_data_area` VALUES ('693', '72', '平和县', '50');
INSERT INTO `xhl_data_area` VALUES ('694', '72', '南靖县', '50');
INSERT INTO `xhl_data_area` VALUES ('695', '72', '诏安县', '50');
INSERT INTO `xhl_data_area` VALUES ('696', '72', '漳浦县', '50');
INSERT INTO `xhl_data_area` VALUES ('697', '72', '华安县', '50');
INSERT INTO `xhl_data_area` VALUES ('698', '72', '东山县', '50');
INSERT INTO `xhl_data_area` VALUES ('699', '72', '长泰县', '50');
INSERT INTO `xhl_data_area` VALUES ('700', '72', '云霄县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('701', '73', '博山', '50');
INSERT INTO `xhl_data_area` VALUES ('702', '73', '临淄', '50');
INSERT INTO `xhl_data_area` VALUES ('703', '73', '张店', '50');
INSERT INTO `xhl_data_area` VALUES ('704', '73', '周村', '50');
INSERT INTO `xhl_data_area` VALUES ('705', '73', '淄川', '50');
INSERT INTO `xhl_data_area` VALUES ('706', '73', '桓台县', '50');
INSERT INTO `xhl_data_area` VALUES ('707', '73', '高青县', '50');
INSERT INTO `xhl_data_area` VALUES ('708', '73', '沂源县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('709', '74', '沂水县', '50');
INSERT INTO `xhl_data_area` VALUES ('710', '74', '苍山县', '50');
INSERT INTO `xhl_data_area` VALUES ('711', '74', '平邑县', '50');
INSERT INTO `xhl_data_area` VALUES ('712', '74', '莒南县', '50');
INSERT INTO `xhl_data_area` VALUES ('713', '74', '蒙阴县', '50');
INSERT INTO `xhl_data_area` VALUES ('714', '74', '临沭县', '50');
INSERT INTO `xhl_data_area` VALUES ('715', '74', '费县', '50');
INSERT INTO `xhl_data_area` VALUES ('716', '74', '兰山', '50');
INSERT INTO `xhl_data_area` VALUES ('717', '74', '罗庄', '50');
INSERT INTO `xhl_data_area` VALUES ('718', '74', '河东', '50');
INSERT INTO `xhl_data_area` VALUES ('719', '74', '沂南县', '50');
INSERT INTO `xhl_data_area` VALUES ('720', '74', '郯城县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('721', '75', '大观 ', '50');
INSERT INTO `xhl_data_area` VALUES ('722', '75', '宜秀', '50');
INSERT INTO `xhl_data_area` VALUES ('723', '75', '迎江', '50');
INSERT INTO `xhl_data_area` VALUES ('724', '75', '桐城市', '50');
INSERT INTO `xhl_data_area` VALUES ('725', '75', '宿松县', '50');
INSERT INTO `xhl_data_area` VALUES ('726', '75', '枞阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('727', '75', '太湖县', '50');
INSERT INTO `xhl_data_area` VALUES ('728', '75', '怀宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('729', '75', '岳西县', '50');
INSERT INTO `xhl_data_area` VALUES ('730', '75', '望江县', '50');
INSERT INTO `xhl_data_area` VALUES ('731', '75', '潜山县 ', '50');
INSERT INTO `xhl_data_area` VALUES ('732', '76', '高港', '50');
INSERT INTO `xhl_data_area` VALUES ('733', '76', '海陵', '50');
INSERT INTO `xhl_data_area` VALUES ('734', '76', '泰兴市', '50');
INSERT INTO `xhl_data_area` VALUES ('735', '76', '姜堰市', '50');
INSERT INTO `xhl_data_area` VALUES ('736', '76', '靖江市', '50');
INSERT INTO `xhl_data_area` VALUES ('737', '76', '兴化市 ', '50');
INSERT INTO `xhl_data_area` VALUES ('738', '77', '鄄城县', '50');
INSERT INTO `xhl_data_area` VALUES ('739', '77', '单县', '50');
INSERT INTO `xhl_data_area` VALUES ('740', '77', '郓城县', '50');
INSERT INTO `xhl_data_area` VALUES ('741', '77', '曹县', '50');
INSERT INTO `xhl_data_area` VALUES ('742', '77', '定陶县', '50');
INSERT INTO `xhl_data_area` VALUES ('743', '77', '巨野县', '50');
INSERT INTO `xhl_data_area` VALUES ('744', '77', '东明县', '50');
INSERT INTO `xhl_data_area` VALUES ('745', '77', '成武县', '50');
INSERT INTO `xhl_data_area` VALUES ('746', '77', '牡丹', '50');
INSERT INTO `xhl_data_area` VALUES ('747', '78', '山亭', '50');
INSERT INTO `xhl_data_area` VALUES ('748', '78', '市中', '50');
INSERT INTO `xhl_data_area` VALUES ('749', '78', '薛城', '50');
INSERT INTO `xhl_data_area` VALUES ('750', '78', '峄城', '50');
INSERT INTO `xhl_data_area` VALUES ('751', '78', '台儿庄', '50');
INSERT INTO `xhl_data_area` VALUES ('752', '78', '滕州市', '50');
INSERT INTO `xhl_data_area` VALUES ('753', '79', '龙泉市', '50');
INSERT INTO `xhl_data_area` VALUES ('754', '79', '缙云县', '50');
INSERT INTO `xhl_data_area` VALUES ('755', '79', '青田县', '50');
INSERT INTO `xhl_data_area` VALUES ('756', '79', '云和县', '50');
INSERT INTO `xhl_data_area` VALUES ('757', '79', '遂昌县', '50');
INSERT INTO `xhl_data_area` VALUES ('758', '79', '松阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('759', '79', '庆元县', '50');
INSERT INTO `xhl_data_area` VALUES ('760', '79', '景宁畲族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('761', '79', '莲都', '50');
INSERT INTO `xhl_data_area` VALUES ('762', '80', '月湖', '50');
INSERT INTO `xhl_data_area` VALUES ('763', '80', '贵溪市', '50');
INSERT INTO `xhl_data_area` VALUES ('764', '80', '余江县', '50');
INSERT INTO `xhl_data_area` VALUES ('765', '81', '环翠', '50');
INSERT INTO `xhl_data_area` VALUES ('766', '81', '乳山市', '50');
INSERT INTO `xhl_data_area` VALUES ('767', '81', '文登市', '50');
INSERT INTO `xhl_data_area` VALUES ('768', '81', '荣成市', '50');
INSERT INTO `xhl_data_area` VALUES ('769', '82', '城厢', '50');
INSERT INTO `xhl_data_area` VALUES ('770', '82', '荔城', '50');
INSERT INTO `xhl_data_area` VALUES ('771', '82', '秀屿', '50');
INSERT INTO `xhl_data_area` VALUES ('772', '82', '涵江', '50');
INSERT INTO `xhl_data_area` VALUES ('773', '82', '仙游县', '50');
INSERT INTO `xhl_data_area` VALUES ('774', '83', '新罗', '50');
INSERT INTO `xhl_data_area` VALUES ('775', '83', '漳平市', '50');
INSERT INTO `xhl_data_area` VALUES ('776', '83', '长汀县', '50');
INSERT INTO `xhl_data_area` VALUES ('777', '83', '武平县', '50');
INSERT INTO `xhl_data_area` VALUES ('778', '83', '上杭县', '50');
INSERT INTO `xhl_data_area` VALUES ('779', '83', '永定县', '50');
INSERT INTO `xhl_data_area` VALUES ('780', '83', '连城县', '50');
INSERT INTO `xhl_data_area` VALUES ('781', '84', '岱岳', '50');
INSERT INTO `xhl_data_area` VALUES ('782', '84', '泰山', '50');
INSERT INTO `xhl_data_area` VALUES ('783', '84', '新泰市', '50');
INSERT INTO `xhl_data_area` VALUES ('784', '84', '肥城市', '50');
INSERT INTO `xhl_data_area` VALUES ('785', '84', '宁阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('786', '84', '东平县', '50');
INSERT INTO `xhl_data_area` VALUES ('787', '85', '井冈山市', '50');
INSERT INTO `xhl_data_area` VALUES ('788', '85', '吉州', '50');
INSERT INTO `xhl_data_area` VALUES ('789', '85', '青原', '50');
INSERT INTO `xhl_data_area` VALUES ('790', '85', '吉安县', '50');
INSERT INTO `xhl_data_area` VALUES ('791', '85', '永丰县', '50');
INSERT INTO `xhl_data_area` VALUES ('792', '85', '永新县', '50');
INSERT INTO `xhl_data_area` VALUES ('793', '85', '新干县', '50');
INSERT INTO `xhl_data_area` VALUES ('794', '85', '泰和县', '50');
INSERT INTO `xhl_data_area` VALUES ('795', '85', '峡江县', '50');
INSERT INTO `xhl_data_area` VALUES ('796', '85', '遂川县', '50');
INSERT INTO `xhl_data_area` VALUES ('797', '85', '安福县', '50');
INSERT INTO `xhl_data_area` VALUES ('798', '85', '吉水县', '50');
INSERT INTO `xhl_data_area` VALUES ('799', '85', '万安县', '50');
INSERT INTO `xhl_data_area` VALUES ('800', '86', '昌江', '50');
INSERT INTO `xhl_data_area` VALUES ('801', '86', '珠山', '50');
INSERT INTO `xhl_data_area` VALUES ('802', '86', '乐平市', '50');
INSERT INTO `xhl_data_area` VALUES ('803', '86', '浮梁县', '50');
INSERT INTO `xhl_data_area` VALUES ('804', '87', '莞城', '50');
INSERT INTO `xhl_data_area` VALUES ('805', '87', '南城', '50');
INSERT INTO `xhl_data_area` VALUES ('806', '87', '万江', '50');
INSERT INTO `xhl_data_area` VALUES ('807', '87', '东城', '50');
INSERT INTO `xhl_data_area` VALUES ('808', '87', '石碣镇', '50');
INSERT INTO `xhl_data_area` VALUES ('809', '87', '石龙镇', '50');
INSERT INTO `xhl_data_area` VALUES ('810', '87', '茶山镇', '50');
INSERT INTO `xhl_data_area` VALUES ('811', '87', '石排镇', '50');
INSERT INTO `xhl_data_area` VALUES ('812', '87', '企石镇', '50');
INSERT INTO `xhl_data_area` VALUES ('813', '87', '横沥镇', '50');
INSERT INTO `xhl_data_area` VALUES ('814', '87', '桥头镇', '50');
INSERT INTO `xhl_data_area` VALUES ('815', '87', '谢岗镇', '50');
INSERT INTO `xhl_data_area` VALUES ('816', '87', '东坑镇', '50');
INSERT INTO `xhl_data_area` VALUES ('817', '87', '常平镇', '50');
INSERT INTO `xhl_data_area` VALUES ('818', '87', '寮步镇', '50');
INSERT INTO `xhl_data_area` VALUES ('819', '87', '大朗镇', '50');
INSERT INTO `xhl_data_area` VALUES ('820', '87', '黄江镇', '50');
INSERT INTO `xhl_data_area` VALUES ('821', '87', '清溪镇', '50');
INSERT INTO `xhl_data_area` VALUES ('822', '87', '塘厦镇', '50');
INSERT INTO `xhl_data_area` VALUES ('823', '87', '凤岗镇', '50');
INSERT INTO `xhl_data_area` VALUES ('824', '87', '长安镇', '50');
INSERT INTO `xhl_data_area` VALUES ('825', '87', '虎门镇', '50');
INSERT INTO `xhl_data_area` VALUES ('826', '87', '厚街镇', '50');
INSERT INTO `xhl_data_area` VALUES ('827', '87', '沙田镇', '50');
INSERT INTO `xhl_data_area` VALUES ('828', '87', '道滘镇', '50');
INSERT INTO `xhl_data_area` VALUES ('829', '88', '禅城', '50');
INSERT INTO `xhl_data_area` VALUES ('830', '88', '高明', '50');
INSERT INTO `xhl_data_area` VALUES ('831', '88', '南海', '50');
INSERT INTO `xhl_data_area` VALUES ('832', '88', '三水', '50');
INSERT INTO `xhl_data_area` VALUES ('833', '88', '顺德', '50');
INSERT INTO `xhl_data_area` VALUES ('834', '88', '南海二', '50');
INSERT INTO `xhl_data_area` VALUES ('835', '88', '南海三', '50');
INSERT INTO `xhl_data_area` VALUES ('836', '88', '顺德二', '50');
INSERT INTO `xhl_data_area` VALUES ('837', '88', '顺德三', '50');
INSERT INTO `xhl_data_area` VALUES ('838', '89', '惠城', '50');
INSERT INTO `xhl_data_area` VALUES ('839', '89', '惠阳', '50');
INSERT INTO `xhl_data_area` VALUES ('840', '89', '惠东县', '50');
INSERT INTO `xhl_data_area` VALUES ('841', '89', '博罗县', '50');
INSERT INTO `xhl_data_area` VALUES ('842', '89', '龙门县', '50');
INSERT INTO `xhl_data_area` VALUES ('843', '89', '大亚湾', '50');
INSERT INTO `xhl_data_area` VALUES ('844', '89', '仲恺', '50');
INSERT INTO `xhl_data_area` VALUES ('845', '90', '国营农场', '50');
INSERT INTO `xhl_data_area` VALUES ('846', '90', '海棠湾镇', '50');
INSERT INTO `xhl_data_area` VALUES ('847', '90', '吉阳镇', '50');
INSERT INTO `xhl_data_area` VALUES ('848', '90', '凤凰镇', '50');
INSERT INTO `xhl_data_area` VALUES ('849', '90', '河西', '50');
INSERT INTO `xhl_data_area` VALUES ('850', '90', '河东', '50');
INSERT INTO `xhl_data_area` VALUES ('851', '90', '崖城镇', '50');
INSERT INTO `xhl_data_area` VALUES ('852', '90', '天涯镇', '50');
INSERT INTO `xhl_data_area` VALUES ('853', '90', '育才镇', '50');
INSERT INTO `xhl_data_area` VALUES ('854', '91', '石岐', '50');
INSERT INTO `xhl_data_area` VALUES ('855', '91', '五桂山', '50');
INSERT INTO `xhl_data_area` VALUES ('856', '91', '火炬开发', '50');
INSERT INTO `xhl_data_area` VALUES ('857', '91', '黄圃镇', '50');
INSERT INTO `xhl_data_area` VALUES ('858', '91', '南头镇', '50');
INSERT INTO `xhl_data_area` VALUES ('859', '91', '东凤镇', '50');
INSERT INTO `xhl_data_area` VALUES ('860', '91', '阜沙镇', '50');
INSERT INTO `xhl_data_area` VALUES ('861', '91', '小榄镇', '50');
INSERT INTO `xhl_data_area` VALUES ('862', '91', '东升镇', '50');
INSERT INTO `xhl_data_area` VALUES ('863', '91', '古镇镇', '50');
INSERT INTO `xhl_data_area` VALUES ('864', '91', '横栏镇', '50');
INSERT INTO `xhl_data_area` VALUES ('865', '91', '三角镇', '50');
INSERT INTO `xhl_data_area` VALUES ('866', '91', '民众镇', '50');
INSERT INTO `xhl_data_area` VALUES ('867', '91', '南朗镇', '50');
INSERT INTO `xhl_data_area` VALUES ('868', '91', '港口镇', '50');
INSERT INTO `xhl_data_area` VALUES ('869', '91', '大涌镇', '50');
INSERT INTO `xhl_data_area` VALUES ('870', '91', '沙溪镇', '50');
INSERT INTO `xhl_data_area` VALUES ('871', '91', '三乡镇', '50');
INSERT INTO `xhl_data_area` VALUES ('872', '91', '板芙镇', '50');
INSERT INTO `xhl_data_area` VALUES ('873', '91', '神湾镇', '50');
INSERT INTO `xhl_data_area` VALUES ('874', '91', '坦洲镇', '50');
INSERT INTO `xhl_data_area` VALUES ('875', '92', '斗门', '50');
INSERT INTO `xhl_data_area` VALUES ('876', '92', '金湾', '50');
INSERT INTO `xhl_data_area` VALUES ('877', '92', '香洲', '50');
INSERT INTO `xhl_data_area` VALUES ('878', '93', '潮南', '50');
INSERT INTO `xhl_data_area` VALUES ('879', '93', '潮阳', '50');
INSERT INTO `xhl_data_area` VALUES ('880', '93', '澄海', '50');
INSERT INTO `xhl_data_area` VALUES ('881', '93', '濠江', '50');
INSERT INTO `xhl_data_area` VALUES ('882', '93', '金平', '50');
INSERT INTO `xhl_data_area` VALUES ('883', '93', '龙湖', '50');
INSERT INTO `xhl_data_area` VALUES ('884', '93', '南澳县', '50');
INSERT INTO `xhl_data_area` VALUES ('885', '94', '清城', '50');
INSERT INTO `xhl_data_area` VALUES ('886', '94', '英德市', '50');
INSERT INTO `xhl_data_area` VALUES ('887', '94', '连州市', '50');
INSERT INTO `xhl_data_area` VALUES ('888', '94', '佛冈县', '50');
INSERT INTO `xhl_data_area` VALUES ('889', '94', '阳山县', '50');
INSERT INTO `xhl_data_area` VALUES ('890', '94', '清新县', '50');
INSERT INTO `xhl_data_area` VALUES ('891', '94', '连山壮族瑶族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('892', '94', '连南瑶族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('893', '95', '江海', '50');
INSERT INTO `xhl_data_area` VALUES ('894', '95', '蓬江', '50');
INSERT INTO `xhl_data_area` VALUES ('895', '95', '新会', '50');
INSERT INTO `xhl_data_area` VALUES ('896', '95', '台山市', '50');
INSERT INTO `xhl_data_area` VALUES ('897', '95', '开平市', '50');
INSERT INTO `xhl_data_area` VALUES ('898', '95', '鹤山市', '50');
INSERT INTO `xhl_data_area` VALUES ('899', '95', '恩平市', '50');
INSERT INTO `xhl_data_area` VALUES ('900', '96', '鼎湖', '50');
INSERT INTO `xhl_data_area` VALUES ('901', '96', '端州', '50');
INSERT INTO `xhl_data_area` VALUES ('902', '96', '高要市', '50');
INSERT INTO `xhl_data_area` VALUES ('903', '96', '四会市', '50');
INSERT INTO `xhl_data_area` VALUES ('904', '96', '广宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('905', '96', '德庆县', '50');
INSERT INTO `xhl_data_area` VALUES ('906', '96', '封开县', '50');
INSERT INTO `xhl_data_area` VALUES ('907', '96', '怀集县', '50');
INSERT INTO `xhl_data_area` VALUES ('908', '97', '钦南', '50');
INSERT INTO `xhl_data_area` VALUES ('909', '97', '江南', '50');
INSERT INTO `xhl_data_area` VALUES ('910', '97', '良庆', '50');
INSERT INTO `xhl_data_area` VALUES ('911', '97', '青秀', '50');
INSERT INTO `xhl_data_area` VALUES ('912', '97', '西乡塘', '50');
INSERT INTO `xhl_data_area` VALUES ('913', '97', '兴宁', '50');
INSERT INTO `xhl_data_area` VALUES ('914', '97', '钦北', '50');
INSERT INTO `xhl_data_area` VALUES ('915', '97', '长洲', '50');
INSERT INTO `xhl_data_area` VALUES ('916', '97', '蝶山', '50');
INSERT INTO `xhl_data_area` VALUES ('917', '97', '万秀', '50');
INSERT INTO `xhl_data_area` VALUES ('918', '97', '玉州', '50');
INSERT INTO `xhl_data_area` VALUES ('919', '97', '邕宁', '50');
INSERT INTO `xhl_data_area` VALUES ('920', '97', '武鸣县', '50');
INSERT INTO `xhl_data_area` VALUES ('921', '97', '隆安县', '50');
INSERT INTO `xhl_data_area` VALUES ('922', '97', '马山县', '50');
INSERT INTO `xhl_data_area` VALUES ('923', '97', '上林县', '50');
INSERT INTO `xhl_data_area` VALUES ('924', '97', '宾阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('925', '97', '横县', '50');
INSERT INTO `xhl_data_area` VALUES ('926', '98', '柳南', '50');
INSERT INTO `xhl_data_area` VALUES ('927', '98', '城中', '50');
INSERT INTO `xhl_data_area` VALUES ('928', '98', '柳北', '50');
INSERT INTO `xhl_data_area` VALUES ('929', '98', '鱼峰', '50');
INSERT INTO `xhl_data_area` VALUES ('930', '98', '柳江县', '50');
INSERT INTO `xhl_data_area` VALUES ('931', '98', '柳城县', '50');
INSERT INTO `xhl_data_area` VALUES ('932', '98', '鹿寨县', '50');
INSERT INTO `xhl_data_area` VALUES ('933', '98', '融安县', '50');
INSERT INTO `xhl_data_area` VALUES ('934', '98', '融水苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('935', '98', '三江侗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('936', '99', '海沧', '50');
INSERT INTO `xhl_data_area` VALUES ('937', '99', '湖里', '50');
INSERT INTO `xhl_data_area` VALUES ('938', '99', '集美', '50');
INSERT INTO `xhl_data_area` VALUES ('939', '99', '思明', '50');
INSERT INTO `xhl_data_area` VALUES ('940', '99', '同安', '50');
INSERT INTO `xhl_data_area` VALUES ('941', '99', '翔安', '50');
INSERT INTO `xhl_data_area` VALUES ('942', '100', '龙华', '50');
INSERT INTO `xhl_data_area` VALUES ('943', '100', '美兰', '50');
INSERT INTO `xhl_data_area` VALUES ('944', '100', '琼山', '50');
INSERT INTO `xhl_data_area` VALUES ('945', '100', '秀英', '50');
INSERT INTO `xhl_data_area` VALUES ('946', '101', '海城', '50');
INSERT INTO `xhl_data_area` VALUES ('947', '101', '铁山港', '50');
INSERT INTO `xhl_data_area` VALUES ('948', '101', '银海', '50');
INSERT INTO `xhl_data_area` VALUES ('949', '101', '合浦县', '50');
INSERT INTO `xhl_data_area` VALUES ('950', '102', '象山', '50');
INSERT INTO `xhl_data_area` VALUES ('951', '102', '叠彩', '50');
INSERT INTO `xhl_data_area` VALUES ('952', '102', '七星', '50');
INSERT INTO `xhl_data_area` VALUES ('953', '102', '秀峰', '50');
INSERT INTO `xhl_data_area` VALUES ('954', '102', '雁山', '50');
INSERT INTO `xhl_data_area` VALUES ('955', '102', '阳朔县', '50');
INSERT INTO `xhl_data_area` VALUES ('956', '102', '临桂县', '50');
INSERT INTO `xhl_data_area` VALUES ('957', '102', '灵川县', '50');
INSERT INTO `xhl_data_area` VALUES ('958', '102', '全州县', '50');
INSERT INTO `xhl_data_area` VALUES ('959', '102', '平乐县', '50');
INSERT INTO `xhl_data_area` VALUES ('960', '102', '兴安县', '50');
INSERT INTO `xhl_data_area` VALUES ('961', '102', '灌阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('962', '102', '荔蒲县', '50');
INSERT INTO `xhl_data_area` VALUES ('963', '102', '资源县', '50');
INSERT INTO `xhl_data_area` VALUES ('964', '102', '永福县', '50');
INSERT INTO `xhl_data_area` VALUES ('965', '102', '龙胜各族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('966', '102', '恭城瑶族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('967', '103', '江城', '50');
INSERT INTO `xhl_data_area` VALUES ('968', '103', '阳春市', '50');
INSERT INTO `xhl_data_area` VALUES ('969', '103', '阳西县', '50');
INSERT INTO `xhl_data_area` VALUES ('970', '103', '阳东县', '50');
INSERT INTO `xhl_data_area` VALUES ('971', '104', '黔西县', '50');
INSERT INTO `xhl_data_area` VALUES ('972', '104', '大方县', '50');
INSERT INTO `xhl_data_area` VALUES ('973', '104', '织金县', '50');
INSERT INTO `xhl_data_area` VALUES ('974', '104', '金沙县', '50');
INSERT INTO `xhl_data_area` VALUES ('975', '104', '赫章县', '50');
INSERT INTO `xhl_data_area` VALUES ('976', '104', '纳雍县', '50');
INSERT INTO `xhl_data_area` VALUES ('977', '104', '威宁彝族回族苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('978', '104', '七星关', '50');
INSERT INTO `xhl_data_area` VALUES ('979', '105', '福安市', '50');
INSERT INTO `xhl_data_area` VALUES ('980', '105', '蕉城', '50');
INSERT INTO `xhl_data_area` VALUES ('981', '105', '福鼎市', '50');
INSERT INTO `xhl_data_area` VALUES ('982', '105', '寿宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('983', '105', '霞浦县', '50');
INSERT INTO `xhl_data_area` VALUES ('984', '105', '柘荣县', '50');
INSERT INTO `xhl_data_area` VALUES ('985', '105', '屏南县', '50');
INSERT INTO `xhl_data_area` VALUES ('986', '105', '古田县', '50');
INSERT INTO `xhl_data_area` VALUES ('987', '105', '周宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('988', '106', '云城', '50');
INSERT INTO `xhl_data_area` VALUES ('989', '106', '罗定市', '50');
INSERT INTO `xhl_data_area` VALUES ('990', '106', '云安县', '50');
INSERT INTO `xhl_data_area` VALUES ('991', '106', '新兴县', '50');
INSERT INTO `xhl_data_area` VALUES ('992', '106', '郁南县', '50');
INSERT INTO `xhl_data_area` VALUES ('993', '107', '武江', '50');
INSERT INTO `xhl_data_area` VALUES ('994', '107', '浈江', '50');
INSERT INTO `xhl_data_area` VALUES ('995', '107', '乐昌市', '50');
INSERT INTO `xhl_data_area` VALUES ('996', '107', '南雄市', '50');
INSERT INTO `xhl_data_area` VALUES ('997', '107', '仁化县', '50');
INSERT INTO `xhl_data_area` VALUES ('998', '107', '始兴县', '50');
INSERT INTO `xhl_data_area` VALUES ('999', '107', '翁源县', '50');
INSERT INTO `xhl_data_area` VALUES ('1000', '107', '曲江', '50');
INSERT INTO `xhl_data_area` VALUES ('1001', '107', '新丰县', '50');
INSERT INTO `xhl_data_area` VALUES ('1002', '107', '乳源瑶族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1003', '108', '茂港', '50');
INSERT INTO `xhl_data_area` VALUES ('1004', '108', '茂南', '50');
INSERT INTO `xhl_data_area` VALUES ('1005', '108', '高州市', '50');
INSERT INTO `xhl_data_area` VALUES ('1006', '108', '化州市', '50');
INSERT INTO `xhl_data_area` VALUES ('1007', '108', '信宜市', '50');
INSERT INTO `xhl_data_area` VALUES ('1008', '108', '电白县', '50');
INSERT INTO `xhl_data_area` VALUES ('1009', '109', '防城', '50');
INSERT INTO `xhl_data_area` VALUES ('1010', '109', '港口', '50');
INSERT INTO `xhl_data_area` VALUES ('1011', '109', '东兴市', '50');
INSERT INTO `xhl_data_area` VALUES ('1012', '109', '上思县', '50');
INSERT INTO `xhl_data_area` VALUES ('1013', '110', '港北', '50');
INSERT INTO `xhl_data_area` VALUES ('1014', '110', '港南', '50');
INSERT INTO `xhl_data_area` VALUES ('1015', '110', '覃塘', '50');
INSERT INTO `xhl_data_area` VALUES ('1016', '110', '桂平市', '50');
INSERT INTO `xhl_data_area` VALUES ('1017', '110', '平南县', '50');
INSERT INTO `xhl_data_area` VALUES ('1018', '111', '市区', '50');
INSERT INTO `xhl_data_area` VALUES ('1019', '111', '其他', '50');
INSERT INTO `xhl_data_area` VALUES ('1020', '112', '安宁市', '50');
INSERT INTO `xhl_data_area` VALUES ('1021', '112', '富民县', '50');
INSERT INTO `xhl_data_area` VALUES ('1022', '112', '嵩明县', '50');
INSERT INTO `xhl_data_area` VALUES ('1023', '112', '呈贡县', '50');
INSERT INTO `xhl_data_area` VALUES ('1024', '112', '晋宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1025', '112', '宜良县', '50');
INSERT INTO `xhl_data_area` VALUES ('1026', '112', '禄劝彝族苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1027', '112', '石林彝族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1028', '112', '寻甸回族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1029', '112', '东川', '50');
INSERT INTO `xhl_data_area` VALUES ('1030', '112', '官渡', '50');
INSERT INTO `xhl_data_area` VALUES ('1031', '112', '盘龙', '50');
INSERT INTO `xhl_data_area` VALUES ('1032', '112', '五华', '50');
INSERT INTO `xhl_data_area` VALUES ('1033', '112', '西山', '50');
INSERT INTO `xhl_data_area` VALUES ('1034', '113', '皋兰县', '50');
INSERT INTO `xhl_data_area` VALUES ('1035', '113', '七里河', '50');
INSERT INTO `xhl_data_area` VALUES ('1036', '113', '安宁', '50');
INSERT INTO `xhl_data_area` VALUES ('1037', '113', '城关', '50');
INSERT INTO `xhl_data_area` VALUES ('1038', '113', '红古', '50');
INSERT INTO `xhl_data_area` VALUES ('1039', '113', '西固', '50');
INSERT INTO `xhl_data_area` VALUES ('1040', '113', '永登县', '50');
INSERT INTO `xhl_data_area` VALUES ('1041', '113', '榆中县', '50');
INSERT INTO `xhl_data_area` VALUES ('1042', '114', '娄烦县', '50');
INSERT INTO `xhl_data_area` VALUES ('1043', '114', '尖草坪', '50');
INSERT INTO `xhl_data_area` VALUES ('1044', '114', '晋源', '50');
INSERT INTO `xhl_data_area` VALUES ('1045', '114', '万柏林', '50');
INSERT INTO `xhl_data_area` VALUES ('1046', '114', '小店', '50');
INSERT INTO `xhl_data_area` VALUES ('1047', '114', '杏花岭', '50');
INSERT INTO `xhl_data_area` VALUES ('1048', '114', '迎泽', '50');
INSERT INTO `xhl_data_area` VALUES ('1049', '114', '古交市', '50');
INSERT INTO `xhl_data_area` VALUES ('1050', '114', '阳曲县', '50');
INSERT INTO `xhl_data_area` VALUES ('1051', '114', '清徐县', '50');
INSERT INTO `xhl_data_area` VALUES ('1052', '115', '清镇市', '50');
INSERT INTO `xhl_data_area` VALUES ('1053', '115', '南明', '50');
INSERT INTO `xhl_data_area` VALUES ('1054', '115', '白云', '50');
INSERT INTO `xhl_data_area` VALUES ('1055', '115', '花溪', '50');
INSERT INTO `xhl_data_area` VALUES ('1056', '115', '乌当', '50');
INSERT INTO `xhl_data_area` VALUES ('1057', '115', '小河', '50');
INSERT INTO `xhl_data_area` VALUES ('1058', '115', '云岩', '50');
INSERT INTO `xhl_data_area` VALUES ('1059', '115', '开阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1060', '115', '修文县', '50');
INSERT INTO `xhl_data_area` VALUES ('1061', '115', '息烽县', '50');
INSERT INTO `xhl_data_area` VALUES ('1062', '115', '金阳新区', '50');
INSERT INTO `xhl_data_area` VALUES ('1063', '115', '贵阳周边', '50');
INSERT INTO `xhl_data_area` VALUES ('1064', '116', '宁乡县', '50');
INSERT INTO `xhl_data_area` VALUES ('1065', '116', '芙蓉', '50');
INSERT INTO `xhl_data_area` VALUES ('1066', '116', '开福', '50');
INSERT INTO `xhl_data_area` VALUES ('1067', '116', '天心', '50');
INSERT INTO `xhl_data_area` VALUES ('1068', '116', '雨花', '50');
INSERT INTO `xhl_data_area` VALUES ('1069', '116', '岳麓', '50');
INSERT INTO `xhl_data_area` VALUES ('1070', '116', '浏阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('1071', '116', '长沙一', '50');
INSERT INTO `xhl_data_area` VALUES ('1072', '116', '望城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1073', '116', '长沙二', '50');
INSERT INTO `xhl_data_area` VALUES ('1074', '116', '长沙三', '50');
INSERT INTO `xhl_data_area` VALUES ('1075', '117', '赛罕', '50');
INSERT INTO `xhl_data_area` VALUES ('1076', '117', '新城', '50');
INSERT INTO `xhl_data_area` VALUES ('1077', '117', '玉泉', '50');
INSERT INTO `xhl_data_area` VALUES ('1078', '117', '回民', '50');
INSERT INTO `xhl_data_area` VALUES ('1079', '117', '托克托县', '50');
INSERT INTO `xhl_data_area` VALUES ('1080', '117', '清水河县', '50');
INSERT INTO `xhl_data_area` VALUES ('1081', '117', '武川县', '50');
INSERT INTO `xhl_data_area` VALUES ('1082', '117', '和林格尔县', '50');
INSERT INTO `xhl_data_area` VALUES ('1083', '117', '土默特左旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1084', '118', '乌鲁木齐县', '50');
INSERT INTO `xhl_data_area` VALUES ('1085', '118', '达坂城', '50');
INSERT INTO `xhl_data_area` VALUES ('1086', '118', '米东', '50');
INSERT INTO `xhl_data_area` VALUES ('1087', '118', '沙依巴克', '50');
INSERT INTO `xhl_data_area` VALUES ('1088', '118', '水磨沟', '50');
INSERT INTO `xhl_data_area` VALUES ('1089', '118', '天山', '50');
INSERT INTO `xhl_data_area` VALUES ('1090', '118', '头屯', '50');
INSERT INTO `xhl_data_area` VALUES ('1091', '118', '河新市', '50');
INSERT INTO `xhl_data_area` VALUES ('1092', '119', '二七', '50');
INSERT INTO `xhl_data_area` VALUES ('1093', '119', '管城回族', '50');
INSERT INTO `xhl_data_area` VALUES ('1094', '119', '惠济', '50');
INSERT INTO `xhl_data_area` VALUES ('1095', '119', '金水', '50');
INSERT INTO `xhl_data_area` VALUES ('1096', '119', '上街', '50');
INSERT INTO `xhl_data_area` VALUES ('1097', '119', '中原', '50');
INSERT INTO `xhl_data_area` VALUES ('1098', '119', '巩义市', '50');
INSERT INTO `xhl_data_area` VALUES ('1099', '119', '新郑市', '50');
INSERT INTO `xhl_data_area` VALUES ('1100', '119', '新密市', '50');
INSERT INTO `xhl_data_area` VALUES ('1101', '119', '登封市', '50');
INSERT INTO `xhl_data_area` VALUES ('1102', '119', '荥阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('1103', '119', '中牟县', '50');
INSERT INTO `xhl_data_area` VALUES ('1104', '119', '高新区', '50');
INSERT INTO `xhl_data_area` VALUES ('1105', '119', '郑东新区', '50');
INSERT INTO `xhl_data_area` VALUES ('1106', '119', '经济开发', '50');
INSERT INTO `xhl_data_area` VALUES ('1107', '120', '金凤', '50');
INSERT INTO `xhl_data_area` VALUES ('1108', '120', '西夏', '50');
INSERT INTO `xhl_data_area` VALUES ('1109', '120', '兴庆', '50');
INSERT INTO `xhl_data_area` VALUES ('1110', '120', '永宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1111', '120', '贺兰县', '50');
INSERT INTO `xhl_data_area` VALUES ('1112', '120', '灵武市', '50');
INSERT INTO `xhl_data_area` VALUES ('1113', '121', '东河', '50');
INSERT INTO `xhl_data_area` VALUES ('1114', '121', '九原', '50');
INSERT INTO `xhl_data_area` VALUES ('1115', '121', '昆都仑', '50');
INSERT INTO `xhl_data_area` VALUES ('1116', '121', '青山', '50');
INSERT INTO `xhl_data_area` VALUES ('1117', '121', '石拐', '50');
INSERT INTO `xhl_data_area` VALUES ('1118', '121', '白云矿', '50');
INSERT INTO `xhl_data_area` VALUES ('1119', '121', '固阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1120', '121', '土默特右旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1121', '121', '达尔罕茂明安联合旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1122', '121', '滨河新区', '50');
INSERT INTO `xhl_data_area` VALUES ('1123', '122', '南阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('1124', '122', '其他区域', '50');
INSERT INTO `xhl_data_area` VALUES ('1125', '123', '廛河回族', '50');
INSERT INTO `xhl_data_area` VALUES ('1126', '123', '吉利', '50');
INSERT INTO `xhl_data_area` VALUES ('1127', '123', '涧西', '50');
INSERT INTO `xhl_data_area` VALUES ('1128', '123', '老城', '50');
INSERT INTO `xhl_data_area` VALUES ('1129', '123', '洛龙', '50');
INSERT INTO `xhl_data_area` VALUES ('1130', '123', '西工', '50');
INSERT INTO `xhl_data_area` VALUES ('1131', '123', '偃师市', '50');
INSERT INTO `xhl_data_area` VALUES ('1132', '123', '孟津县', '50');
INSERT INTO `xhl_data_area` VALUES ('1133', '123', '汝阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1134', '123', '伊川县', '50');
INSERT INTO `xhl_data_area` VALUES ('1135', '123', '洛宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1136', '123', '嵩县', '50');
INSERT INTO `xhl_data_area` VALUES ('1137', '123', '宜阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1138', '123', '新安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1139', '123', '栾川县', '50');
INSERT INTO `xhl_data_area` VALUES ('1140', '124', '解放', '50');
INSERT INTO `xhl_data_area` VALUES ('1141', '124', '马村', '50');
INSERT INTO `xhl_data_area` VALUES ('1142', '124', '山阳', '50');
INSERT INTO `xhl_data_area` VALUES ('1143', '124', '中站', '50');
INSERT INTO `xhl_data_area` VALUES ('1144', '124', '沁阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('1145', '124', '孟州市', '50');
INSERT INTO `xhl_data_area` VALUES ('1146', '124', '修武县', '50');
INSERT INTO `xhl_data_area` VALUES ('1147', '124', '温县', '50');
INSERT INTO `xhl_data_area` VALUES ('1148', '124', '武陟县', '50');
INSERT INTO `xhl_data_area` VALUES ('1149', '124', '博爱县', '50');
INSERT INTO `xhl_data_area` VALUES ('1150', '124', '济源市', '50');
INSERT INTO `xhl_data_area` VALUES ('1151', '125', '泸县', '50');
INSERT INTO `xhl_data_area` VALUES ('1152', '125', '合江县', '50');
INSERT INTO `xhl_data_area` VALUES ('1153', '125', '叙永县', '50');
INSERT INTO `xhl_data_area` VALUES ('1154', '125', '古蔺县', '50');
INSERT INTO `xhl_data_area` VALUES ('1155', '125', '江阳', '50');
INSERT INTO `xhl_data_area` VALUES ('1156', '125', '龙马潭', '50');
INSERT INTO `xhl_data_area` VALUES ('1157', '125', '纳溪', '50');
INSERT INTO `xhl_data_area` VALUES ('1158', '126', '荣县', '50');
INSERT INTO `xhl_data_area` VALUES ('1159', '126', '富顺县', '50');
INSERT INTO `xhl_data_area` VALUES ('1160', '126', '大安', '50');
INSERT INTO `xhl_data_area` VALUES ('1161', '126', '贡井', '50');
INSERT INTO `xhl_data_area` VALUES ('1162', '126', '沿滩', '50');
INSERT INTO `xhl_data_area` VALUES ('1163', '126', '自流井', '50');
INSERT INTO `xhl_data_area` VALUES ('1164', '127', '广汉市', '50');
INSERT INTO `xhl_data_area` VALUES ('1165', '127', '什邡市', '50');
INSERT INTO `xhl_data_area` VALUES ('1166', '127', '绵竹市', '50');
INSERT INTO `xhl_data_area` VALUES ('1167', '127', '罗江县', '50');
INSERT INTO `xhl_data_area` VALUES ('1168', '127', '中江县', '50');
INSERT INTO `xhl_data_area` VALUES ('1169', '127', '旌阳', '50');
INSERT INTO `xhl_data_area` VALUES ('1170', '128', '江油市', '50');
INSERT INTO `xhl_data_area` VALUES ('1171', '128', '盐亭县', '50');
INSERT INTO `xhl_data_area` VALUES ('1172', '128', '三台县', '50');
INSERT INTO `xhl_data_area` VALUES ('1173', '128', '平武县', '50');
INSERT INTO `xhl_data_area` VALUES ('1174', '128', '北川羌族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1175', '128', '安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1176', '128', '梓潼县', '50');
INSERT INTO `xhl_data_area` VALUES ('1177', '128', '涪城', '50');
INSERT INTO `xhl_data_area` VALUES ('1178', '128', '游仙', '50');
INSERT INTO `xhl_data_area` VALUES ('1179', '129', '清涧县', '50');
INSERT INTO `xhl_data_area` VALUES ('1180', '129', '绥德县', '50');
INSERT INTO `xhl_data_area` VALUES ('1181', '129', '神木县', '50');
INSERT INTO `xhl_data_area` VALUES ('1182', '129', '佳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1183', '129', '子洲县', '50');
INSERT INTO `xhl_data_area` VALUES ('1184', '129', '靖边县', '50');
INSERT INTO `xhl_data_area` VALUES ('1185', '129', '横山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1186', '129', '米脂县', '50');
INSERT INTO `xhl_data_area` VALUES ('1187', '129', '吴堡县', '50');
INSERT INTO `xhl_data_area` VALUES ('1188', '129', '定边县', '50');
INSERT INTO `xhl_data_area` VALUES ('1189', '129', '府谷县', '50');
INSERT INTO `xhl_data_area` VALUES ('1190', '129', '榆阳', '50');
INSERT INTO `xhl_data_area` VALUES ('1191', '130', '点军', '50');
INSERT INTO `xhl_data_area` VALUES ('1192', '130', '伍家岗', '50');
INSERT INTO `xhl_data_area` VALUES ('1193', '130', '西陵', '50');
INSERT INTO `xhl_data_area` VALUES ('1194', '130', '猇亭', '50');
INSERT INTO `xhl_data_area` VALUES ('1195', '130', '夷陵', '50');
INSERT INTO `xhl_data_area` VALUES ('1196', '130', '宜都市', '50');
INSERT INTO `xhl_data_area` VALUES ('1197', '130', '当阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('1198', '130', '枝江市', '50');
INSERT INTO `xhl_data_area` VALUES ('1199', '130', '秭归县', '50');
INSERT INTO `xhl_data_area` VALUES ('1200', '130', '远安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1201', '130', '兴山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1202', '130', '五峰土家族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1203', '130', '长阳土家族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1204', '131', '兴平市', '50');
INSERT INTO `xhl_data_area` VALUES ('1205', '131', '礼泉县', '50');
INSERT INTO `xhl_data_area` VALUES ('1206', '131', '泾阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1207', '131', '三原县', '50');
INSERT INTO `xhl_data_area` VALUES ('1208', '131', '彬县', '50');
INSERT INTO `xhl_data_area` VALUES ('1209', '131', '旬邑县', '50');
INSERT INTO `xhl_data_area` VALUES ('1210', '131', '长武县', '50');
INSERT INTO `xhl_data_area` VALUES ('1211', '131', '乾县', '50');
INSERT INTO `xhl_data_area` VALUES ('1212', '131', '武功县', '50');
INSERT INTO `xhl_data_area` VALUES ('1213', '131', '淳化县', '50');
INSERT INTO `xhl_data_area` VALUES ('1214', '131', '永寿县', '50');
INSERT INTO `xhl_data_area` VALUES ('1215', '131', '秦都', '50');
INSERT INTO `xhl_data_area` VALUES ('1216', '131', '渭城', '50');
INSERT INTO `xhl_data_area` VALUES ('1217', '131', '杨凌', '50');
INSERT INTO `xhl_data_area` VALUES ('1218', '132', '天元', '50');
INSERT INTO `xhl_data_area` VALUES ('1219', '132', '荷塘', '50');
INSERT INTO `xhl_data_area` VALUES ('1220', '132', '芦淞', '50');
INSERT INTO `xhl_data_area` VALUES ('1221', '132', '石峰', '50');
INSERT INTO `xhl_data_area` VALUES ('1222', '132', '醴陵市', '50');
INSERT INTO `xhl_data_area` VALUES ('1223', '132', '株洲县', '50');
INSERT INTO `xhl_data_area` VALUES ('1224', '132', '炎陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1225', '132', '茶陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1226', '132', '攸县', '50');
INSERT INTO `xhl_data_area` VALUES ('1227', '133', '鼓楼', '50');
INSERT INTO `xhl_data_area` VALUES ('1228', '133', '金明', '50');
INSERT INTO `xhl_data_area` VALUES ('1229', '133', '龙亭', '50');
INSERT INTO `xhl_data_area` VALUES ('1230', '133', '顺河回族', '50');
INSERT INTO `xhl_data_area` VALUES ('1231', '133', '禹王台', '50');
INSERT INTO `xhl_data_area` VALUES ('1232', '133', '开封县', '50');
INSERT INTO `xhl_data_area` VALUES ('1233', '133', '尉氏县', '50');
INSERT INTO `xhl_data_area` VALUES ('1234', '133', '兰考县', '50');
INSERT INTO `xhl_data_area` VALUES ('1235', '133', '杞县', '50');
INSERT INTO `xhl_data_area` VALUES ('1236', '133', '通许县', '50');
INSERT INTO `xhl_data_area` VALUES ('1237', '134', '商城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1238', '134', '平桥', '50');
INSERT INTO `xhl_data_area` VALUES ('1239', '134', '浉河', '50');
INSERT INTO `xhl_data_area` VALUES ('1240', '134', '潢川县', '50');
INSERT INTO `xhl_data_area` VALUES ('1241', '134', '淮滨县', '50');
INSERT INTO `xhl_data_area` VALUES ('1242', '134', '息县', '50');
INSERT INTO `xhl_data_area` VALUES ('1243', '134', '新县', '50');
INSERT INTO `xhl_data_area` VALUES ('1244', '134', '固始县', '50');
INSERT INTO `xhl_data_area` VALUES ('1245', '134', '罗山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1246', '134', '光山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1247', '135', '仁怀市', '50');
INSERT INTO `xhl_data_area` VALUES ('1248', '135', '红花岗', '50');
INSERT INTO `xhl_data_area` VALUES ('1249', '135', '汇川', '50');
INSERT INTO `xhl_data_area` VALUES ('1250', '135', '赤水市', '50');
INSERT INTO `xhl_data_area` VALUES ('1251', '135', '遵义县', '50');
INSERT INTO `xhl_data_area` VALUES ('1252', '135', '绥阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1253', '135', '桐梓县', '50');
INSERT INTO `xhl_data_area` VALUES ('1254', '135', '习水县', '50');
INSERT INTO `xhl_data_area` VALUES ('1255', '135', '凤冈县', '50');
INSERT INTO `xhl_data_area` VALUES ('1256', '135', '正安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1257', '135', '余庆县', '50');
INSERT INTO `xhl_data_area` VALUES ('1258', '135', '湄潭县', '50');
INSERT INTO `xhl_data_area` VALUES ('1259', '135', '道真仡佬族苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1260', '135', '务川仡佬族苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1261', '136', '张湾', '50');
INSERT INTO `xhl_data_area` VALUES ('1262', '136', '茅箭', '50');
INSERT INTO `xhl_data_area` VALUES ('1263', '136', '丹江口市', '50');
INSERT INTO `xhl_data_area` VALUES ('1264', '136', '郧县', '50');
INSERT INTO `xhl_data_area` VALUES ('1265', '136', '竹山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1266', '136', '房县', '50');
INSERT INTO `xhl_data_area` VALUES ('1267', '136', '郧西县', '50');
INSERT INTO `xhl_data_area` VALUES ('1268', '136', '竹溪县', '50');
INSERT INTO `xhl_data_area` VALUES ('1269', '137', '南漳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1270', '137', '襄城', '50');
INSERT INTO `xhl_data_area` VALUES ('1271', '137', '樊城', '50');
INSERT INTO `xhl_data_area` VALUES ('1272', '137', '襄州', '50');
INSERT INTO `xhl_data_area` VALUES ('1273', '137', '老河口市', '50');
INSERT INTO `xhl_data_area` VALUES ('1274', '137', '枣阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('1275', '137', '宜城市', '50');
INSERT INTO `xhl_data_area` VALUES ('1276', '137', '谷城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1277', '137', '保康县', '50');
INSERT INTO `xhl_data_area` VALUES ('1639', '138', '韶山市', '50');
INSERT INTO `xhl_data_area` VALUES ('1638', '138', '湘乡市', '50');
INSERT INTO `xhl_data_area` VALUES ('1637', '138', '岳塘', '50');
INSERT INTO `xhl_data_area` VALUES ('1636', '138', '雨湖', '50');
INSERT INTO `xhl_data_area` VALUES ('1283', '139', '汨罗市', '50');
INSERT INTO `xhl_data_area` VALUES ('1284', '139', '君山', '50');
INSERT INTO `xhl_data_area` VALUES ('1285', '139', '岳阳楼', '50');
INSERT INTO `xhl_data_area` VALUES ('1286', '139', '云溪', '50');
INSERT INTO `xhl_data_area` VALUES ('1287', '139', '临湘市', '50');
INSERT INTO `xhl_data_area` VALUES ('1288', '139', '岳阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1289', '139', '湘阴县', '50');
INSERT INTO `xhl_data_area` VALUES ('1290', '139', '平江县', '50');
INSERT INTO `xhl_data_area` VALUES ('1291', '139', '华容县', '50');
INSERT INTO `xhl_data_area` VALUES ('1292', '140', '南岳', '50');
INSERT INTO `xhl_data_area` VALUES ('1293', '140', '石鼓', '50');
INSERT INTO `xhl_data_area` VALUES ('1294', '140', '雁峰', '50');
INSERT INTO `xhl_data_area` VALUES ('1295', '140', '蒸湘', '50');
INSERT INTO `xhl_data_area` VALUES ('1296', '140', '珠晖', '50');
INSERT INTO `xhl_data_area` VALUES ('1297', '140', '耒阳市', '50');
INSERT INTO `xhl_data_area` VALUES ('1298', '140', '常宁市', '50');
INSERT INTO `xhl_data_area` VALUES ('1299', '140', '衡阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1300', '140', '衡东县', '50');
INSERT INTO `xhl_data_area` VALUES ('1301', '140', '衡山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1302', '140', '衡南县', '50');
INSERT INTO `xhl_data_area` VALUES ('1303', '140', '祁东县', '50');
INSERT INTO `xhl_data_area` VALUES ('1304', '141', '琅琊', '50');
INSERT INTO `xhl_data_area` VALUES ('1305', '141', '南谯', '50');
INSERT INTO `xhl_data_area` VALUES ('1306', '141', '天长市', '50');
INSERT INTO `xhl_data_area` VALUES ('1307', '141', '明光市', '50');
INSERT INTO `xhl_data_area` VALUES ('1308', '141', '全椒县', '50');
INSERT INTO `xhl_data_area` VALUES ('1309', '141', '来安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1310', '141', '定远县', '50');
INSERT INTO `xhl_data_area` VALUES ('1311', '141', '凤阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1312', '142', '封丘县', '50');
INSERT INTO `xhl_data_area` VALUES ('1313', '142', '凤泉', '50');
INSERT INTO `xhl_data_area` VALUES ('1314', '142', '红旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1315', '142', '牧野', '50');
INSERT INTO `xhl_data_area` VALUES ('1316', '142', '卫滨', '50');
INSERT INTO `xhl_data_area` VALUES ('1317', '142', '卫辉市', '50');
INSERT INTO `xhl_data_area` VALUES ('1318', '142', '辉县市', '50');
INSERT INTO `xhl_data_area` VALUES ('1319', '142', '新乡县', '50');
INSERT INTO `xhl_data_area` VALUES ('1320', '142', '获嘉县', '50');
INSERT INTO `xhl_data_area` VALUES ('1321', '142', '原阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1322', '142', '长垣县', '50');
INSERT INTO `xhl_data_area` VALUES ('1323', '142', '延津县', '50');
INSERT INTO `xhl_data_area` VALUES ('1324', '143', '八公山', '50');
INSERT INTO `xhl_data_area` VALUES ('1325', '143', '大通', '50');
INSERT INTO `xhl_data_area` VALUES ('1326', '143', '潘集', '50');
INSERT INTO `xhl_data_area` VALUES ('1327', '143', '田家庵', '50');
INSERT INTO `xhl_data_area` VALUES ('1328', '143', '谢家集', '50');
INSERT INTO `xhl_data_area` VALUES ('1329', '143', '凤台县', '50');
INSERT INTO `xhl_data_area` VALUES ('1330', '144', '六枝特', '50');
INSERT INTO `xhl_data_area` VALUES ('1331', '144', '钟山', '50');
INSERT INTO `xhl_data_area` VALUES ('1332', '144', '水城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1333', '144', '盘县', '50');
INSERT INTO `xhl_data_area` VALUES ('1334', '145', '留坝县', '50');
INSERT INTO `xhl_data_area` VALUES ('1335', '145', '镇巴县', '50');
INSERT INTO `xhl_data_area` VALUES ('1336', '145', '城固县', '50');
INSERT INTO `xhl_data_area` VALUES ('1337', '145', '南郑县', '50');
INSERT INTO `xhl_data_area` VALUES ('1338', '145', '洋县', '50');
INSERT INTO `xhl_data_area` VALUES ('1339', '145', '宁强县', '50');
INSERT INTO `xhl_data_area` VALUES ('1340', '145', '佛坪县', '50');
INSERT INTO `xhl_data_area` VALUES ('1341', '145', '勉县', '50');
INSERT INTO `xhl_data_area` VALUES ('1342', '145', '西乡县', '50');
INSERT INTO `xhl_data_area` VALUES ('1343', '145', '略阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1344', '145', '汉台', '50');
INSERT INTO `xhl_data_area` VALUES ('1345', '146', '宣威市', '50');
INSERT INTO `xhl_data_area` VALUES ('1346', '146', '陆良县', '50');
INSERT INTO `xhl_data_area` VALUES ('1347', '146', '会泽县', '50');
INSERT INTO `xhl_data_area` VALUES ('1348', '146', '富源县', '50');
INSERT INTO `xhl_data_area` VALUES ('1349', '146', '罗平县', '50');
INSERT INTO `xhl_data_area` VALUES ('1350', '146', '马龙县', '50');
INSERT INTO `xhl_data_area` VALUES ('1351', '146', '师宗县', '50');
INSERT INTO `xhl_data_area` VALUES ('1352', '146', '沾益县', '50');
INSERT INTO `xhl_data_area` VALUES ('1353', '146', '麒麟', '50');
INSERT INTO `xhl_data_area` VALUES ('1354', '147', '颍东', '50');
INSERT INTO `xhl_data_area` VALUES ('1355', '147', '颍泉', '50');
INSERT INTO `xhl_data_area` VALUES ('1356', '147', '颍州', '50');
INSERT INTO `xhl_data_area` VALUES ('1357', '147', '界首市', '50');
INSERT INTO `xhl_data_area` VALUES ('1358', '147', '临泉县', '50');
INSERT INTO `xhl_data_area` VALUES ('1359', '147', '颍上县', '50');
INSERT INTO `xhl_data_area` VALUES ('1360', '147', '阜南县', '50');
INSERT INTO `xhl_data_area` VALUES ('1361', '147', '太和县', '50');
INSERT INTO `xhl_data_area` VALUES ('1362', '148', '金安', '50');
INSERT INTO `xhl_data_area` VALUES ('1363', '148', '裕安', '50');
INSERT INTO `xhl_data_area` VALUES ('1364', '148', '寿县', '50');
INSERT INTO `xhl_data_area` VALUES ('1365', '148', '霍山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1366', '148', '霍邱县', '50');
INSERT INTO `xhl_data_area` VALUES ('1367', '148', '舒城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1368', '148', '金寨县', '50');
INSERT INTO `xhl_data_area` VALUES ('1369', '149', '安乡县', '50');
INSERT INTO `xhl_data_area` VALUES ('1370', '149', '鼎城', '50');
INSERT INTO `xhl_data_area` VALUES ('1371', '149', '武陵', '50');
INSERT INTO `xhl_data_area` VALUES ('1372', '149', '津市市', '50');
INSERT INTO `xhl_data_area` VALUES ('1373', '149', '澧县', '50');
INSERT INTO `xhl_data_area` VALUES ('1374', '149', '临澧县', '50');
INSERT INTO `xhl_data_area` VALUES ('1375', '149', '桃源县', '50');
INSERT INTO `xhl_data_area` VALUES ('1376', '149', '汉寿县', '50');
INSERT INTO `xhl_data_area` VALUES ('1377', '149', '石门县', '50');
INSERT INTO `xhl_data_area` VALUES ('1378', '150', '城北', '50');
INSERT INTO `xhl_data_area` VALUES ('1379', '150', '城东', '50');
INSERT INTO `xhl_data_area` VALUES ('1380', '150', '城西', '50');
INSERT INTO `xhl_data_area` VALUES ('1381', '150', '城中', '50');
INSERT INTO `xhl_data_area` VALUES ('1382', '150', '湟源县', '50');
INSERT INTO `xhl_data_area` VALUES ('1383', '150', '湟中县', '50');
INSERT INTO `xhl_data_area` VALUES ('1384', '150', '大通回族土族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1385', '151', '仁寿县', '50');
INSERT INTO `xhl_data_area` VALUES ('1386', '151', '洪雅县', '50');
INSERT INTO `xhl_data_area` VALUES ('1387', '151', '丹棱县', '50');
INSERT INTO `xhl_data_area` VALUES ('1388', '151', '青神县', '50');
INSERT INTO `xhl_data_area` VALUES ('1389', '151', '彭山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1390', '151', '东坡', '50');
INSERT INTO `xhl_data_area` VALUES ('1391', '152', '铜仁地万山特', '50');
INSERT INTO `xhl_data_area` VALUES ('1392', '152', '德江县', '50');
INSERT INTO `xhl_data_area` VALUES ('1393', '152', '江口县', '50');
INSERT INTO `xhl_data_area` VALUES ('1394', '152', '思南县', '50');
INSERT INTO `xhl_data_area` VALUES ('1395', '152', '石阡县', '50');
INSERT INTO `xhl_data_area` VALUES ('1396', '152', '玉屏侗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1397', '152', '松桃苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1398', '152', '印江土家族苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1399', '152', '沿河土家族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1400', '152', '万山特', '50');
INSERT INTO `xhl_data_area` VALUES ('1401', '153', '宁洱哈尼族彝族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1402', '153', '景东彝族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1403', '153', '镇沅彝族哈尼族拉祜族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1404', '153', '景谷傣族彝族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1405', '153', '墨江哈尼族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1406', '153', '澜沧拉祜族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1407', '153', '西盟佤族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1408', '153', '江城哈尼族彝族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1409', '153', '孟连傣族拉祜族佤族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1410', '153', '思茅', '50');
INSERT INTO `xhl_data_area` VALUES ('1411', '154', '施甸县', '50');
INSERT INTO `xhl_data_area` VALUES ('1412', '154', '龙陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1413', '154', '腾冲县', '50');
INSERT INTO `xhl_data_area` VALUES ('1414', '154', '昌宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1415', '154', '隆阳', '50');
INSERT INTO `xhl_data_area` VALUES ('1416', '155', '孝南', '50');
INSERT INTO `xhl_data_area` VALUES ('1417', '155', '应城市', '50');
INSERT INTO `xhl_data_area` VALUES ('1418', '155', '安陆市', '50');
INSERT INTO `xhl_data_area` VALUES ('1419', '155', '汉川市', '50');
INSERT INTO `xhl_data_area` VALUES ('1420', '155', '云梦县', '50');
INSERT INTO `xhl_data_area` VALUES ('1421', '155', '大悟县', '50');
INSERT INTO `xhl_data_area` VALUES ('1422', '155', '孝昌县', '50');
INSERT INTO `xhl_data_area` VALUES ('1423', '156', '城区', '50');
INSERT INTO `xhl_data_area` VALUES ('1424', '156', '矿区', '50');
INSERT INTO `xhl_data_area` VALUES ('1425', '156', '南郊', '50');
INSERT INTO `xhl_data_area` VALUES ('1426', '156', '新荣', '50');
INSERT INTO `xhl_data_area` VALUES ('1427', '156', '大同县', '50');
INSERT INTO `xhl_data_area` VALUES ('1428', '156', '天镇县', '50');
INSERT INTO `xhl_data_area` VALUES ('1429', '156', '灵丘县', '50');
INSERT INTO `xhl_data_area` VALUES ('1430', '156', '阳高县', '50');
INSERT INTO `xhl_data_area` VALUES ('1431', '156', '左云县', '50');
INSERT INTO `xhl_data_area` VALUES ('1432', '156', '广灵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1433', '156', '浑源县', '50');
INSERT INTO `xhl_data_area` VALUES ('1434', '157', '赫山', '50');
INSERT INTO `xhl_data_area` VALUES ('1435', '157', '资阳', '50');
INSERT INTO `xhl_data_area` VALUES ('1436', '157', '沅江市', '50');
INSERT INTO `xhl_data_area` VALUES ('1437', '157', '桃江县', '50');
INSERT INTO `xhl_data_area` VALUES ('1438', '157', '南县', '50');
INSERT INTO `xhl_data_area` VALUES ('1439', '157', '安化县', '50');
INSERT INTO `xhl_data_area` VALUES ('1440', '158', '苏仙', '50');
INSERT INTO `xhl_data_area` VALUES ('1441', '158', '北湖', '50');
INSERT INTO `xhl_data_area` VALUES ('1442', '158', '资兴市', '50');
INSERT INTO `xhl_data_area` VALUES ('1443', '158', '宜章县', '50');
INSERT INTO `xhl_data_area` VALUES ('1444', '158', '汝城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1445', '158', '安仁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1446', '158', '嘉禾县', '50');
INSERT INTO `xhl_data_area` VALUES ('1447', '158', '临武县', '50');
INSERT INTO `xhl_data_area` VALUES ('1448', '158', '桂东县', '50');
INSERT INTO `xhl_data_area` VALUES ('1449', '158', '永兴县', '50');
INSERT INTO `xhl_data_area` VALUES ('1450', '158', '桂阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1451', '159', '鹤城', '50');
INSERT INTO `xhl_data_area` VALUES ('1452', '159', '洪江市', '50');
INSERT INTO `xhl_data_area` VALUES ('1453', '159', '会同县', '50');
INSERT INTO `xhl_data_area` VALUES ('1454', '159', '沅陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1455', '159', '辰溪县', '50');
INSERT INTO `xhl_data_area` VALUES ('1456', '159', '溆浦县', '50');
INSERT INTO `xhl_data_area` VALUES ('1457', '159', '中方县', '50');
INSERT INTO `xhl_data_area` VALUES ('1458', '159', '新晃侗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1459', '159', '芷江侗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1460', '159', '通道侗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1461', '159', '靖州苗族侗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1462', '159', '麻阳苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1463', '160', '娄星', '50');
INSERT INTO `xhl_data_area` VALUES ('1464', '160', '冷水江市', '50');
INSERT INTO `xhl_data_area` VALUES ('1465', '160', '涟源市', '50');
INSERT INTO `xhl_data_area` VALUES ('1466', '160', '新化县', '50');
INSERT INTO `xhl_data_area` VALUES ('1467', '160', '双峰县', '50');
INSERT INTO `xhl_data_area` VALUES ('1468', '161', '北塔', '50');
INSERT INTO `xhl_data_area` VALUES ('1469', '161', '大祥', '50');
INSERT INTO `xhl_data_area` VALUES ('1470', '161', '双清', '50');
INSERT INTO `xhl_data_area` VALUES ('1471', '161', '武冈市', '50');
INSERT INTO `xhl_data_area` VALUES ('1472', '161', '邵东县', '50');
INSERT INTO `xhl_data_area` VALUES ('1473', '161', '洞口县', '50');
INSERT INTO `xhl_data_area` VALUES ('1474', '161', '新邵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1475', '161', '绥宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1476', '161', '新宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1477', '161', '邵阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1478', '161', '隆回县', '50');
INSERT INTO `xhl_data_area` VALUES ('1479', '161', '城步苗族自治县', '50');
INSERT INTO `xhl_data_area` VALUES ('1480', '162', '武陵源', '50');
INSERT INTO `xhl_data_area` VALUES ('1481', '162', '永定', '50');
INSERT INTO `xhl_data_area` VALUES ('1482', '162', '慈利县', '50');
INSERT INTO `xhl_data_area` VALUES ('1483', '162', '桑植县', '50');
INSERT INTO `xhl_data_area` VALUES ('1484', '163', '咸安', '50');
INSERT INTO `xhl_data_area` VALUES ('1485', '163', '赤壁市', '50');
INSERT INTO `xhl_data_area` VALUES ('1486', '163', '嘉鱼县', '50');
INSERT INTO `xhl_data_area` VALUES ('1487', '163', '通山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1488', '163', '崇阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1489', '163', '通城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1490', '164', '湖滨', '50');
INSERT INTO `xhl_data_area` VALUES ('1491', '164', '义马市', '50');
INSERT INTO `xhl_data_area` VALUES ('1492', '164', '灵宝市', '50');
INSERT INTO `xhl_data_area` VALUES ('1493', '164', '渑池县', '50');
INSERT INTO `xhl_data_area` VALUES ('1494', '164', '卢氏县', '50');
INSERT INTO `xhl_data_area` VALUES ('1495', '164', '陕县', '50');
INSERT INTO `xhl_data_area` VALUES ('1496', '165', '黄州', '50');
INSERT INTO `xhl_data_area` VALUES ('1497', '165', '麻城市', '50');
INSERT INTO `xhl_data_area` VALUES ('1498', '165', '武穴市', '50');
INSERT INTO `xhl_data_area` VALUES ('1499', '165', '红安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1500', '165', '罗田县', '50');
INSERT INTO `xhl_data_area` VALUES ('1501', '165', '浠水县', '50');
INSERT INTO `xhl_data_area` VALUES ('1502', '165', '蕲春县', '50');
INSERT INTO `xhl_data_area` VALUES ('1503', '165', '黄梅县', '50');
INSERT INTO `xhl_data_area` VALUES ('1504', '165', '英山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1505', '165', '团风县', '50');
INSERT INTO `xhl_data_area` VALUES ('1506', '166', '沈丘县', '50');
INSERT INTO `xhl_data_area` VALUES ('1507', '166', '川汇', '50');
INSERT INTO `xhl_data_area` VALUES ('1508', '166', '项城市', '50');
INSERT INTO `xhl_data_area` VALUES ('1509', '166', '商水县', '50');
INSERT INTO `xhl_data_area` VALUES ('1510', '166', '淮阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1511', '166', '太康县', '50');
INSERT INTO `xhl_data_area` VALUES ('1512', '166', '鹿邑县', '50');
INSERT INTO `xhl_data_area` VALUES ('1513', '166', '西华县', '50');
INSERT INTO `xhl_data_area` VALUES ('1514', '166', '扶沟县', '50');
INSERT INTO `xhl_data_area` VALUES ('1515', '166', '郸城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1516', '167', '宁陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1517', '167', '梁园', '50');
INSERT INTO `xhl_data_area` VALUES ('1518', '167', '睢阳', '50');
INSERT INTO `xhl_data_area` VALUES ('1519', '167', '永城市', '50');
INSERT INTO `xhl_data_area` VALUES ('1520', '167', '虞城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1521', '167', '民权县', '50');
INSERT INTO `xhl_data_area` VALUES ('1522', '167', '夏邑县', '50');
INSERT INTO `xhl_data_area` VALUES ('1523', '167', '柘城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1524', '167', '睢县', '50');
INSERT INTO `xhl_data_area` VALUES ('1525', '168', '阆中市', '50');
INSERT INTO `xhl_data_area` VALUES ('1526', '168', '营山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1527', '168', '蓬安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1528', '168', '仪陇县', '50');
INSERT INTO `xhl_data_area` VALUES ('1529', '168', '南部县', '50');
INSERT INTO `xhl_data_area` VALUES ('1530', '168', '西充县', '50');
INSERT INTO `xhl_data_area` VALUES ('1531', '168', '高坪', '50');
INSERT INTO `xhl_data_area` VALUES ('1532', '168', '嘉陵', '50');
INSERT INTO `xhl_data_area` VALUES ('1533', '168', '顺庆', '50');
INSERT INTO `xhl_data_area` VALUES ('1534', '169', '石龙', '50');
INSERT INTO `xhl_data_area` VALUES ('1535', '169', '卫东', '50');
INSERT INTO `xhl_data_area` VALUES ('1536', '169', '新华', '50');
INSERT INTO `xhl_data_area` VALUES ('1537', '169', '湛河', '50');
INSERT INTO `xhl_data_area` VALUES ('1538', '169', '汝州市', '50');
INSERT INTO `xhl_data_area` VALUES ('1539', '169', '舞钢市', '50');
INSERT INTO `xhl_data_area` VALUES ('1540', '169', '宝丰县', '50');
INSERT INTO `xhl_data_area` VALUES ('1541', '169', '叶县', '50');
INSERT INTO `xhl_data_area` VALUES ('1542', '169', '郏县', '50');
INSERT INTO `xhl_data_area` VALUES ('1543', '169', '鲁山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1544', '170', '巴林右旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1545', '170', '红山', '50');
INSERT INTO `xhl_data_area` VALUES ('1546', '170', '松山', '50');
INSERT INTO `xhl_data_area` VALUES ('1547', '170', '元宝山', '50');
INSERT INTO `xhl_data_area` VALUES ('1548', '170', '宁城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1549', '170', '林西县', '50');
INSERT INTO `xhl_data_area` VALUES ('1550', '170', '喀喇沁旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1551', '170', '巴林左旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1552', '170', '敖汉旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1553', '170', '阿鲁科尔沁旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1554', '170', '翁牛特旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1555', '170', '克什克腾旗', '50');
INSERT INTO `xhl_data_area` VALUES ('1556', '171', '宜宾县', '50');
INSERT INTO `xhl_data_area` VALUES ('1557', '171', '兴文县', '50');
INSERT INTO `xhl_data_area` VALUES ('1558', '171', '南溪县', '50');
INSERT INTO `xhl_data_area` VALUES ('1559', '171', '珙县', '50');
INSERT INTO `xhl_data_area` VALUES ('1560', '171', '长宁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1561', '171', '高县', '50');
INSERT INTO `xhl_data_area` VALUES ('1562', '171', '江安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1563', '171', '筠连县', '50');
INSERT INTO `xhl_data_area` VALUES ('1564', '171', '屏山县', '50');
INSERT INTO `xhl_data_area` VALUES ('1565', '171', '翠屏', '50');
INSERT INTO `xhl_data_area` VALUES ('1566', '172', '和顺县', '50');
INSERT INTO `xhl_data_area` VALUES ('1567', '172', '榆次', '50');
INSERT INTO `xhl_data_area` VALUES ('1568', '172', '介休市', '50');
INSERT INTO `xhl_data_area` VALUES ('1569', '172', '昔阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1570', '172', '灵石县', '50');
INSERT INTO `xhl_data_area` VALUES ('1571', '172', '祁县', '50');
INSERT INTO `xhl_data_area` VALUES ('1572', '172', '左权县', '50');
INSERT INTO `xhl_data_area` VALUES ('1573', '172', '寿阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1574', '172', '太谷县', '50');
INSERT INTO `xhl_data_area` VALUES ('1575', '172', '平遥县', '50');
INSERT INTO `xhl_data_area` VALUES ('1576', '172', '榆社县', '50');
INSERT INTO `xhl_data_area` VALUES ('1577', '173', '魏都', '50');
INSERT INTO `xhl_data_area` VALUES ('1578', '173', '禹州市', '50');
INSERT INTO `xhl_data_area` VALUES ('1579', '173', '长葛市', '50');
INSERT INTO `xhl_data_area` VALUES ('1580', '173', '许昌县', '50');
INSERT INTO `xhl_data_area` VALUES ('1581', '173', '鄢陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1582', '173', '襄城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1583', '174', '谯城', '50');
INSERT INTO `xhl_data_area` VALUES ('1584', '174', '利辛县', '50');
INSERT INTO `xhl_data_area` VALUES ('1585', '174', '涡阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1586', '174', '蒙城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1587', '175', '洪湖市', '50');
INSERT INTO `xhl_data_area` VALUES ('1588', '175', '荆州', '50');
INSERT INTO `xhl_data_area` VALUES ('1589', '175', '沙市', '50');
INSERT INTO `xhl_data_area` VALUES ('1590', '175', '石首市', '50');
INSERT INTO `xhl_data_area` VALUES ('1591', '175', '松滋市', '50');
INSERT INTO `xhl_data_area` VALUES ('1592', '175', '监利县', '50');
INSERT INTO `xhl_data_area` VALUES ('1593', '175', '公安县', '50');
INSERT INTO `xhl_data_area` VALUES ('1594', '175', '江陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1595', '176', '资中县', '50');
INSERT INTO `xhl_data_area` VALUES ('1596', '176', '隆昌县', '50');
INSERT INTO `xhl_data_area` VALUES ('1597', '176', '威远县', '50');
INSERT INTO `xhl_data_area` VALUES ('1598', '176', '东兴', '50');
INSERT INTO `xhl_data_area` VALUES ('1599', '176', '市中', '50');
INSERT INTO `xhl_data_area` VALUES ('1600', '177', '紫阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1601', '177', '岚皋县', '50');
INSERT INTO `xhl_data_area` VALUES ('1602', '177', '旬阳县', '50');
INSERT INTO `xhl_data_area` VALUES ('1603', '177', '平利县', '50');
INSERT INTO `xhl_data_area` VALUES ('1604', '177', '石泉县', '50');
INSERT INTO `xhl_data_area` VALUES ('1605', '177', '宁陕县', '50');
INSERT INTO `xhl_data_area` VALUES ('1606', '177', '白河县', '50');
INSERT INTO `xhl_data_area` VALUES ('1607', '177', '汉阴县', '50');
INSERT INTO `xhl_data_area` VALUES ('1608', '177', '镇坪县', '50');
INSERT INTO `xhl_data_area` VALUES ('1609', '177', '汉滨', '50');
INSERT INTO `xhl_data_area` VALUES ('1610', '178', '鄂城', '50');
INSERT INTO `xhl_data_area` VALUES ('1611', '178', '华容', '50');
INSERT INTO `xhl_data_area` VALUES ('1612', '178', '梁子湖', '50');
INSERT INTO `xhl_data_area` VALUES ('1711', '179', '禹城市', '50');
INSERT INTO `xhl_data_area` VALUES ('1710', '179', '乐陵市', '50');
INSERT INTO `xhl_data_area` VALUES ('1709', '179', '庆云', '50');
INSERT INTO `xhl_data_area` VALUES ('1708', '179', '宁津', '50');
INSERT INTO `xhl_data_area` VALUES ('1707', '179', '临邑', '50');
INSERT INTO `xhl_data_area` VALUES ('1706', '179', '陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1705', '179', '武城', '50');
INSERT INTO `xhl_data_area` VALUES ('1704', '179', '夏津', '50');
INSERT INTO `xhl_data_area` VALUES ('1703', '179', '平原', '50');
INSERT INTO `xhl_data_area` VALUES ('1702', '179', '齐河', '50');
INSERT INTO `xhl_data_area` VALUES ('1701', '179', '德城区', '50');
INSERT INTO `xhl_data_area` VALUES ('1720', '180', '兴隆', '50');
INSERT INTO `xhl_data_area` VALUES ('1719', '180', '丰宁', '50');
INSERT INTO `xhl_data_area` VALUES ('1718', '180', '平泉', '50');
INSERT INTO `xhl_data_area` VALUES ('1717', '180', '隆化', '50');
INSERT INTO `xhl_data_area` VALUES ('1716', '180', '宽城', '50');
INSERT INTO `xhl_data_area` VALUES ('1715', '180', '双滦', '50');
INSERT INTO `xhl_data_area` VALUES ('1714', '180', '营子', '50');
INSERT INTO `xhl_data_area` VALUES ('1713', '180', '开发区', '50');
INSERT INTO `xhl_data_area` VALUES ('1712', '180', '双桥', '50');
INSERT INTO `xhl_data_area` VALUES ('1633', '181', '景洪市', '50');
INSERT INTO `xhl_data_area` VALUES ('1634', '181', '勐海县', '50');
INSERT INTO `xhl_data_area` VALUES ('1635', '181', '勐腊县', '50');
INSERT INTO `xhl_data_area` VALUES ('1640', '138', '湘潭县', '50');
INSERT INTO `xhl_data_area` VALUES ('1641', '185', '莱城区', '50');
INSERT INTO `xhl_data_area` VALUES ('1642', '185', '莱钢区', '50');
INSERT INTO `xhl_data_area` VALUES ('1643', '185', '开发区', '50');
INSERT INTO `xhl_data_area` VALUES ('1644', '185', '雪野旅游区', '50');
INSERT INTO `xhl_data_area` VALUES ('1645', '186', '景洪市', '50');
INSERT INTO `xhl_data_area` VALUES ('1646', '186', '勐海县', '50');
INSERT INTO `xhl_data_area` VALUES ('1647', '186', '勐腊县', '50');
INSERT INTO `xhl_data_area` VALUES ('1648', '187', '冠县', '50');
INSERT INTO `xhl_data_area` VALUES ('1649', '187', '莘县', '50');
INSERT INTO `xhl_data_area` VALUES ('1650', '187', '阳谷', '50');
INSERT INTO `xhl_data_area` VALUES ('1651', '187', '东阿', '50');
INSERT INTO `xhl_data_area` VALUES ('1652', '187', '茌平', '50');
INSERT INTO `xhl_data_area` VALUES ('1653', '187', '高唐', '50');
INSERT INTO `xhl_data_area` VALUES ('1654', '187', '东昌府区', '50');
INSERT INTO `xhl_data_area` VALUES ('1655', '187', '经济技术开发区', '50');
INSERT INTO `xhl_data_area` VALUES ('1656', '187', '临清市', '50');
INSERT INTO `xhl_data_area` VALUES ('1657', '188', '德城区', '50');
INSERT INTO `xhl_data_area` VALUES ('1658', '188', '乐陵市', '50');
INSERT INTO `xhl_data_area` VALUES ('1659', '188', '禹城市', '50');
INSERT INTO `xhl_data_area` VALUES ('1660', '188', '陵县', '50');
INSERT INTO `xhl_data_area` VALUES ('1661', '188', '平原县', '50');
INSERT INTO `xhl_data_area` VALUES ('1662', '188', '武城县', '50');
INSERT INTO `xhl_data_area` VALUES ('1663', '188', '夏津县', '50');
INSERT INTO `xhl_data_area` VALUES ('1664', '188', '齐河县', '50');
INSERT INTO `xhl_data_area` VALUES ('1665', '188', '临邑县', '50');
INSERT INTO `xhl_data_area` VALUES ('1666', '188', '宁津县', '50');
INSERT INTO `xhl_data_area` VALUES ('1667', '188', '庆云县', '50');
INSERT INTO `xhl_data_area` VALUES ('1668', '189', '市区', '50');
INSERT INTO `xhl_data_area` VALUES ('1669', '189', '其他', '50');
INSERT INTO `xhl_data_area` VALUES ('1670', '190', '东港区', '50');
INSERT INTO `xhl_data_area` VALUES ('1671', '190', '日照开发区', '50');
INSERT INTO `xhl_data_area` VALUES ('1672', '190', '岚山区', '50');
INSERT INTO `xhl_data_area` VALUES ('1673', '190', '五连县', '50');
INSERT INTO `xhl_data_area` VALUES ('1674', '190', '莒县', '50');
INSERT INTO `xhl_data_area` VALUES ('1675', '190', '其他', '50');
INSERT INTO `xhl_data_area` VALUES ('1676', '30', '开发区', '50');
INSERT INTO `xhl_data_area` VALUES ('1677', '24', '迁西县', '50');
INSERT INTO `xhl_data_area` VALUES ('1678', '24', '丰南', '50');
INSERT INTO `xhl_data_area` VALUES ('1679', '24', '丰润', '50');
INSERT INTO `xhl_data_area` VALUES ('1680', '24', '古冶', '50');
INSERT INTO `xhl_data_area` VALUES ('1681', '24', '开平', '50');
INSERT INTO `xhl_data_area` VALUES ('1682', '24', '路北', '50');
INSERT INTO `xhl_data_area` VALUES ('1683', '24', '路南', '50');
INSERT INTO `xhl_data_area` VALUES ('1684', '24', '遵化市', '50');
INSERT INTO `xhl_data_area` VALUES ('1685', '24', '迁安市', '50');
INSERT INTO `xhl_data_area` VALUES ('1686', '24', '滦南县', '50');
INSERT INTO `xhl_data_area` VALUES ('1687', '24', '玉田县', '50');
INSERT INTO `xhl_data_area` VALUES ('1688', '24', '唐海县', '50');
INSERT INTO `xhl_data_area` VALUES ('1689', '24', '乐亭县', '50');
INSERT INTO `xhl_data_area` VALUES ('1690', '24', '滦县', '50');
INSERT INTO `xhl_data_area` VALUES ('1691', '25', '三河', '50');
INSERT INTO `xhl_data_area` VALUES ('1692', '25', '霸州', '50');
INSERT INTO `xhl_data_area` VALUES ('1693', '25', '永清县', '50');
INSERT INTO `xhl_data_area` VALUES ('1694', '25', '大厂', '50');
INSERT INTO `xhl_data_area` VALUES ('1695', '25', '固安', '50');
INSERT INTO `xhl_data_area` VALUES ('1696', '25', '文安', '50');
INSERT INTO `xhl_data_area` VALUES ('1697', '25', '香河', '50');
INSERT INTO `xhl_data_area` VALUES ('1698', '25', '大城', '50');
INSERT INTO `xhl_data_area` VALUES ('1699', '25', '其他', '50');
INSERT INTO `xhl_data_area` VALUES ('1700', '8', '燕郊', '50');
INSERT INTO `xhl_data_area` VALUES ('1721', '180', '围场', '50');
INSERT INTO `xhl_data_area` VALUES ('1722', '180', '滦平', '50');
INSERT INTO `xhl_data_area` VALUES ('1723', '180', '承德县', '50');
INSERT INTO `xhl_data_area` VALUES ('1724', '180', '承德市', '50');
INSERT INTO `xhl_data_area` VALUES ('1725', '180', '承德周边', '50');

-- ----------------------------
-- Table structure for `xhl_data_city`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_data_city`;
CREATE TABLE `xhl_data_city` (
  `city_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `province_id` smallint(6) DEFAULT '0',
  `city_name` varchar(50) DEFAULT '',
  `pinyin` varchar(50) DEFAULT '',
  `theme_id` smallint(6) DEFAULT '0',
  `logo` varchar(150) DEFAULT '',
  `weixinqr` varchar(150) DEFAULT '',
  `phone` varchar(15) DEFAULT '',
  `mail` varchar(30) DEFAULT '',
  `kfqq` varchar(30) DEFAULT '',
  `seo_title` varchar(255) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(255) DEFAULT '',
  `tongji` mediumtext,
  `orderby` smallint(6) DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=677 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_data_city
-- ----------------------------
INSERT INTO `xhl_data_city` VALUES ('7', '5', '合肥', 'hf', '1', '', '', '', '', '', '', '', '', null, '50', '1', '0');
INSERT INTO `xhl_data_city` VALUES ('8', '1', '北京', 'bj', '13', '', '', '', '', '', '', '', '', null, '1', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('9', '3', '上海', 'sh', '15', '', '', '', '', '', '', '', '', null, '2', '1', '1418205614');
INSERT INTO `xhl_data_city` VALUES ('10', '19', '济南', 'jn', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418407045');
INSERT INTO `xhl_data_city` VALUES ('11', '2', '天津', 'tj', '14', '', '', '', '', '', '', '', '', null, '3', '1', '1418428345');
INSERT INTO `xhl_data_city` VALUES ('40', '17', '无锡', 'wuxi', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422662063');
INSERT INTO `xhl_data_city` VALUES ('12', '8', '广州', 'gz', '1', '', '', '', '', '', '', '', '', null, '4', '1', '1418429122');
INSERT INTO `xhl_data_city` VALUES ('13', '8', '深圳', 'sz', '1', '', '', '', '', '', '', '', '', null, '5', '1', '1418988967');
INSERT INTO `xhl_data_city` VALUES ('14', '4', '重庆', 'cq', '1', '', '', '', '', '', '', '', '', null, '6', '1', '1418989963');
INSERT INTO `xhl_data_city` VALUES ('15', '17', '南京', 'nanjing', '1', '', '', '', '', '', '', '', '', null, '7', '1', '1418990232');
INSERT INTO `xhl_data_city` VALUES ('16', '20', '西安', 'xian', '1', '', '', '', '', '', '', '', '', null, '8', '1', '1418990568');
INSERT INTO `xhl_data_city` VALUES ('17', '24', '杭州', 'hangzhou', '1', '', '', '', '', '', '', '', '', null, '9', '1', '1418990758');
INSERT INTO `xhl_data_city` VALUES ('18', '22', '成都', 'chengdu', '1', '', '', '', '', '', '', '', '', null, '10', '1', '1418991013');
INSERT INTO `xhl_data_city` VALUES ('19', '6', '福州', 'fuzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418995472');
INSERT INTO `xhl_data_city` VALUES ('20', '13', '武汉', 'wuhan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418995761');
INSERT INTO `xhl_data_city` VALUES ('21', '18', '沈阳', 'shenyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418996004');
INSERT INTO `xhl_data_city` VALUES ('22', '18', '大连', 'dalian', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418996152');
INSERT INTO `xhl_data_city` VALUES ('23', '10', '石家庄', 'shijiazhuang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418996279');
INSERT INTO `xhl_data_city` VALUES ('24', '10', '唐山', 'tangshan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418996461');
INSERT INTO `xhl_data_city` VALUES ('25', '10', '廊坊', 'lanfang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418996542');
INSERT INTO `xhl_data_city` VALUES ('26', '18', ' 鞍山', 'anshan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418996717');
INSERT INTO `xhl_data_city` VALUES ('27', '11', '大庆', 'daqing', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418996778');
INSERT INTO `xhl_data_city` VALUES ('28', '11', '哈尔滨', 'haerbin', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418996832');
INSERT INTO `xhl_data_city` VALUES ('29', '15', '长春', 'changchun', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418997092');
INSERT INTO `xhl_data_city` VALUES ('30', '10', '秦皇岛', 'qinhuangdao', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1418997210');
INSERT INTO `xhl_data_city` VALUES ('31', '28', '乌兰察布', 'wulanchabu', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419033267');
INSERT INTO `xhl_data_city` VALUES ('32', '18', '铁岭', 'tieling', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419033421');
INSERT INTO `xhl_data_city` VALUES ('33', '10', '保定', 'baoding', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419033520');
INSERT INTO `xhl_data_city` VALUES ('34', '10', '邯郸', 'handan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419034010');
INSERT INTO `xhl_data_city` VALUES ('35', null, '吉林', 'jilin', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419034196');
INSERT INTO `xhl_data_city` VALUES ('36', '15', '通化', 'tonghua', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419034292');
INSERT INTO `xhl_data_city` VALUES ('37', '10', '邢台', 'xingtai', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419034471');
INSERT INTO `xhl_data_city` VALUES ('38', '17', '苏州', 'suzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419034891');
INSERT INTO `xhl_data_city` VALUES ('39', '10', '沧州', 'cangzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1419035039');
INSERT INTO `xhl_data_city` VALUES ('41', '19', '青岛', 'qingdao', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422662299');
INSERT INTO `xhl_data_city` VALUES ('42', '24', '宁波', 'ningbo', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422662515');
INSERT INTO `xhl_data_city` VALUES ('43', '24', '温州', 'wenzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422662652');
INSERT INTO `xhl_data_city` VALUES ('44', '24', '义乌', 'yiwu', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422662751');
INSERT INTO `xhl_data_city` VALUES ('45', '19', '潍坊', 'weifang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422667614');
INSERT INTO `xhl_data_city` VALUES ('46', '19', '济宁', 'jining', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422667808');
INSERT INTO `xhl_data_city` VALUES ('47', '19', '烟台', 'yantai', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422667908');
INSERT INTO `xhl_data_city` VALUES ('48', '17', '南通', 'nantong', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668009');
INSERT INTO `xhl_data_city` VALUES ('49', '17', '常州', 'changzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668115');
INSERT INTO `xhl_data_city` VALUES ('50', '17', '徐州', 'xuzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668218');
INSERT INTO `xhl_data_city` VALUES ('51', '24', '台州', 'taizhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668323');
INSERT INTO `xhl_data_city` VALUES ('52', '24', '嘉兴', 'jiaxing', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668416');
INSERT INTO `xhl_data_city` VALUES ('53', '24', '金华', 'jinhua', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668504');
INSERT INTO `xhl_data_city` VALUES ('54', '6', '泉州', 'quanzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668587');
INSERT INTO `xhl_data_city` VALUES ('55', '16', '南昌', 'nanchang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668688');
INSERT INTO `xhl_data_city` VALUES ('56', '16', '赣州', 'ganzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668827');
INSERT INTO `xhl_data_city` VALUES ('57', '17', '连云港', 'lianyungang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668929');
INSERT INTO `xhl_data_city` VALUES ('58', '17', '昆山', 'kunshan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422668998');
INSERT INTO `xhl_data_city` VALUES ('59', '17', '宿迁', 'suqian', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422669071');
INSERT INTO `xhl_data_city` VALUES ('60', '17', '扬州', 'yangzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422669586');
INSERT INTO `xhl_data_city` VALUES ('61', '17', '镇江', 'zhenjiang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422669673');
INSERT INTO `xhl_data_city` VALUES ('62', '17', '淮安', 'huaian', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422705836');
INSERT INTO `xhl_data_city` VALUES ('63', '24', '衢州', 'quzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422705951');
INSERT INTO `xhl_data_city` VALUES ('64', '24', '湖州', 'huzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706096');
INSERT INTO `xhl_data_city` VALUES ('65', '24', '舟山', 'zhoushan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706185');
INSERT INTO `xhl_data_city` VALUES ('66', '24', '绍兴', 'shaoxing', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706281');
INSERT INTO `xhl_data_city` VALUES ('67', '5', '芜湖', 'wuhu', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706357');
INSERT INTO `xhl_data_city` VALUES ('68', '16', '九江', 'jiujiang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706438');
INSERT INTO `xhl_data_city` VALUES ('69', '17', '盐城', 'yancheng', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706530');
INSERT INTO `xhl_data_city` VALUES ('70', '5', '黄山', 'huangshan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706765');
INSERT INTO `xhl_data_city` VALUES ('71', '17', '江阴', 'jiangyin', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706864');
INSERT INTO `xhl_data_city` VALUES ('72', '6', '漳州', 'zhanzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422706978');
INSERT INTO `xhl_data_city` VALUES ('73', '19', '淄博', 'zibo', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707081');
INSERT INTO `xhl_data_city` VALUES ('74', '19', '临沂', 'linyi', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707169');
INSERT INTO `xhl_data_city` VALUES ('75', '5', '安庆', 'anqing', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707254');
INSERT INTO `xhl_data_city` VALUES ('76', '17', '泰州', 'taizhoushi', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707349');
INSERT INTO `xhl_data_city` VALUES ('77', '19', '菏泽', 'heze', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707431');
INSERT INTO `xhl_data_city` VALUES ('78', '19', '枣庄', 'zaozhuang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707539');
INSERT INTO `xhl_data_city` VALUES ('79', '24', '丽水', 'lishui', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707642');
INSERT INTO `xhl_data_city` VALUES ('80', '16', '鹰潭', 'yingtan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707732');
INSERT INTO `xhl_data_city` VALUES ('81', '19', '威海', 'weihai', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707863');
INSERT INTO `xhl_data_city` VALUES ('82', '22', '攀枝花', 'panzhihua', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707926');
INSERT INTO `xhl_data_city` VALUES ('83', '6', '龙岩', 'longyan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422707998');
INSERT INTO `xhl_data_city` VALUES ('84', '19', '泰安', 'taian', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422708062');
INSERT INTO `xhl_data_city` VALUES ('85', '16', '吉安', 'jian', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422708137');
INSERT INTO `xhl_data_city` VALUES ('86', '16', '景德镇', 'jingdezhen', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422708220');
INSERT INTO `xhl_data_city` VALUES ('87', '8', '东莞', 'dongguan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422708576');
INSERT INTO `xhl_data_city` VALUES ('88', '8', '佛山', 'foshan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422708674');
INSERT INTO `xhl_data_city` VALUES ('89', '8', '惠州', 'huizhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709040');
INSERT INTO `xhl_data_city` VALUES ('90', '26', '三亚', 'sanya', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709130');
INSERT INTO `xhl_data_city` VALUES ('91', '8', '中山', 'zhongshan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709212');
INSERT INTO `xhl_data_city` VALUES ('92', '8', '珠海', 'zhuhai', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709353');
INSERT INTO `xhl_data_city` VALUES ('93', '8', '汕头', 'shantou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709417');
INSERT INTO `xhl_data_city` VALUES ('94', '8', '清远', 'qingyuan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709491');
INSERT INTO `xhl_data_city` VALUES ('95', '8', '江门', 'jaingmen', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709566');
INSERT INTO `xhl_data_city` VALUES ('96', '8', '肇庆', 'zhaoqing', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709639');
INSERT INTO `xhl_data_city` VALUES ('97', '27', '南宁', 'nanning', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709706');
INSERT INTO `xhl_data_city` VALUES ('98', '27', '柳州', 'liuzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709796');
INSERT INTO `xhl_data_city` VALUES ('99', '6', '厦门', 'xiamen', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709893');
INSERT INTO `xhl_data_city` VALUES ('100', '26', '海口', 'haikou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422709963');
INSERT INTO `xhl_data_city` VALUES ('101', '27', '北海', 'beihai', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422710030');
INSERT INTO `xhl_data_city` VALUES ('102', '27', '桂林', 'guilin', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422710117');
INSERT INTO `xhl_data_city` VALUES ('103', '8', '阳江', 'yangjiang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422710213');
INSERT INTO `xhl_data_city` VALUES ('104', '5', '蚌埠', 'bengbu', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422710272');
INSERT INTO `xhl_data_city` VALUES ('105', '6', '宁德', 'ningde', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422712980');
INSERT INTO `xhl_data_city` VALUES ('106', '8', '云浮', 'yunfu', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713066');
INSERT INTO `xhl_data_city` VALUES ('107', '8', '韶关', 'shaoguan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713140');
INSERT INTO `xhl_data_city` VALUES ('108', '8', '茂名', 'maoming', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713323');
INSERT INTO `xhl_data_city` VALUES ('109', '27', '防城港', 'fangchenggan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713402');
INSERT INTO `xhl_data_city` VALUES ('110', '27', '贵港', 'guigan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713470');
INSERT INTO `xhl_data_city` VALUES ('111', '11', '齐齐哈尔', 'qiqihar', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713536');
INSERT INTO `xhl_data_city` VALUES ('112', '23', '昆明', 'kunming', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713709');
INSERT INTO `xhl_data_city` VALUES ('113', '7', '兰州', 'lanzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713833');
INSERT INTO `xhl_data_city` VALUES ('114', '21', '太原', 'taiyuan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422713905');
INSERT INTO `xhl_data_city` VALUES ('115', '9', '贵阳', 'guiyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714019');
INSERT INTO `xhl_data_city` VALUES ('116', '14', '长沙', 'changsha', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714108');
INSERT INTO `xhl_data_city` VALUES ('117', '28', '呼和浩特', 'huhehaote', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714198');
INSERT INTO `xhl_data_city` VALUES ('118', '31', '乌鲁木齐', 'wulumuqi', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714275');
INSERT INTO `xhl_data_city` VALUES ('119', '12', '郑州', 'zhengzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714359');
INSERT INTO `xhl_data_city` VALUES ('120', '29', '银川', 'yinchuan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714444');
INSERT INTO `xhl_data_city` VALUES ('121', '28', '包头', 'baotou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714513');
INSERT INTO `xhl_data_city` VALUES ('122', '12', '南阳', 'nanyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714603');
INSERT INTO `xhl_data_city` VALUES ('123', '12', '洛阳', 'luoyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714698');
INSERT INTO `xhl_data_city` VALUES ('124', '12', '焦作', 'jiaozuo', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714804');
INSERT INTO `xhl_data_city` VALUES ('125', '22', '泸州', 'luzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714882');
INSERT INTO `xhl_data_city` VALUES ('126', '22', '自贡', 'zigong', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422714962');
INSERT INTO `xhl_data_city` VALUES ('127', '22', '德阳', 'deyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422715027');
INSERT INTO `xhl_data_city` VALUES ('128', '22', '绵阳', 'mianyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422715099');
INSERT INTO `xhl_data_city` VALUES ('129', '20', '榆林', 'yulin', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422715187');
INSERT INTO `xhl_data_city` VALUES ('130', '13', '宜昌', 'yichang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422715261');
INSERT INTO `xhl_data_city` VALUES ('131', '20', '咸阳', 'xianyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422748097');
INSERT INTO `xhl_data_city` VALUES ('132', '14', '株洲', 'zhuzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422748204');
INSERT INTO `xhl_data_city` VALUES ('133', '12', '开封', 'kaifeng', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422748335');
INSERT INTO `xhl_data_city` VALUES ('134', '12', '信阳', 'xinyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422748431');
INSERT INTO `xhl_data_city` VALUES ('135', '9', '遵义', 'zunyi', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422748513');
INSERT INTO `xhl_data_city` VALUES ('136', '13', '十堰', 'shiyan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422748600');
INSERT INTO `xhl_data_city` VALUES ('137', '13', '襄阳', 'xiangyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422748709');
INSERT INTO `xhl_data_city` VALUES ('666', '31', '昌吉', 'changji', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('667', '31', '阜康', 'fukang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('668', '31', '米泉', 'miquan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('669', '31', '库尔勒', 'kuerle', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('670', '31', '伊宁', 'yining', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('671', '31', '奎屯', 'kuitun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('672', '31', '塔城', 'tacheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('673', '31', '乌苏', 'wusu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('674', '31', '阿勒泰', 'aletai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('675', '32', '香港', 'xianggang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('676', '33', '澳门', 'aomen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('138', '14', '湘潭', 'xiangtan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749084');
INSERT INTO `xhl_data_city` VALUES ('655', '31', '阿拉尔', 'alaer', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('656', '31', '图木舒克', 'tumushuke', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('657', '31', '五家渠', 'wujiaqu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('658', '31', '北屯', 'beitun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('659', '31', '喀什', 'kashi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('660', '31', '阿克苏', 'akesu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('661', '31', '和田', 'hetian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('662', '31', '吐鲁番', 'tulufan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('663', '31', '哈密', 'hami', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('664', '31', '阿图什', 'atushi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('665', '31', '博乐', 'bole', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('139', '14', '岳阳', 'yueyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749156');
INSERT INTO `xhl_data_city` VALUES ('644', '28', '丰镇', 'fengzhen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('645', '29', '石嘴山', 'shizuishan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('646', '29', '吴忠', 'wuzhong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('647', '29', '中卫', 'zhongwei', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('648', '29', '固原', 'guyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('649', '29', '灵武', 'lingwu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('650', '29', '青铜峡', 'qingtongxia', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('651', '30', '拉萨', 'lasa', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('652', '30', '日喀则', 'rikaze', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('653', '31', '克拉玛依', 'kelamayi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('654', '31', '石河子', 'shihezi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('140', '14', '衡阳', 'henyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749239');
INSERT INTO `xhl_data_city` VALUES ('634', '28', '满洲里', 'manzhouli', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('635', '28', '扎兰屯', 'zhalantun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('636', '28', '牙克石', 'yakeshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('637', '28', '根河', 'genhe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('638', '28', '额尔古纳', 'eerguna', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('639', '28', '乌兰浩特', 'wulanhaote', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('640', '28', '阿尔山', 'aershan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('641', '28', '霍林郭勒', 'huolinguole', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('642', '28', '锡林浩特', 'xilinhaote', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('643', '28', '二连浩特', 'erlianhaote', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('141', '5', '滁州', 'chuzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749325');
INSERT INTO `xhl_data_city` VALUES ('623', '27', '桂平', 'guiping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('624', '27', '北流', 'beiliu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('625', '27', '东兴', 'dongxing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('626', '27', '凭祥', 'pingxiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('627', '27', '宜州', 'yizhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('628', '27', '合山', 'heshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('629', '28', '乌海', 'wuhai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('630', '28', '呼伦贝尔', 'hulunbeier', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('631', '28', '通辽', 'tongliao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('632', '28', '鄂尔多斯', 'eerduosi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('633', '28', '巴彦淖尔', 'bayannaoer', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('142', '12', '新乡', 'xinxiang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749395');
INSERT INTO `xhl_data_city` VALUES ('612', '26', '儋州市', 'zuozhoushi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('613', '26', '五指山市', 'wuzhishanshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('614', '27', '梧州', 'wuzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('615', '27', '玉林', 'yulin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('616', '27', '钦州', 'qinzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('617', '27', '崇左', 'chongzuo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('618', '27', '百色', 'baise', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('619', '27', '河池', 'hechi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('620', '27', '来宾', 'laibin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('621', '27', '贺州', 'hezhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('622', '27', '岑溪', 'zuoxi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('143', '5', '淮南', 'huainan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749478');
INSERT INTO `xhl_data_city` VALUES ('601', '24', '瑞安', 'ruian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('602', '24', '乐清', 'leqing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('603', '24', '龙泉', 'longquan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('604', '25', '格尔木', 'geermu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('605', '25', '德令哈', 'delingha', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('606', '26', '海口市', 'haikoushi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('607', '26', '三亚市', 'sanyashi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('608', '26', '文昌市', 'wenchangshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('609', '26', '琼海市', 'qionghaishi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('610', '26', '万宁市', 'wanningshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('611', '26', '东方市', 'dongfangshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('144', '9', '六盘水', 'liupanshui', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749544');
INSERT INTO `xhl_data_city` VALUES ('589', '24', '平湖', 'pinghu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('590', '24', '海宁', 'haining', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('591', '24', '桐乡', 'tongxiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('592', '24', '诸暨', 'zhuzuo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('593', '24', '上虞', 'shangyu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('594', '24', '嵊州', 'zuozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('595', '24', '江山', 'jiangshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('596', '24', '兰溪', 'lanxi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('597', '24', '永康', 'yongkang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('598', '24', '东阳', 'dongyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('599', '24', '临海', 'linhai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('600', '24', '温岭', 'wenling', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('145', '20', '汉中', 'hanzhong', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749623');
INSERT INTO `xhl_data_city` VALUES ('578', '23', '大理', 'dali', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('579', '23', '楚雄', 'chuxiong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('580', '23', '个旧', 'gejiu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('581', '23', '开远', 'kaiyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('582', '23', '景洪', 'jinghong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('583', '24', '临安', 'linan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('584', '24', '富阳', 'fuyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('585', '24', '建德', 'jiande', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('586', '24', '慈溪', 'cixi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('587', '24', '余姚', 'yuyao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('588', '24', '奉化', 'fenghua', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('146', '23', '曲靖', 'qujing', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749697');
INSERT INTO `xhl_data_city` VALUES ('567', '22', '西昌', 'xichang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('568', '23', '玉溪', 'yuxi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('569', '23', '丽江', 'lijiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('570', '23', '昭通', 'zhaotong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('571', '23', '思茅', 'simao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('572', '23', '临沧', 'lincang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('573', '23', '保山', 'baoshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('574', '23', '安宁', 'anning', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('575', '23', '宣威', 'xuanwei', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('576', '23', '芒市', 'mangshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('577', '23', '瑞丽', 'ruili', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('147', '5', '阜阳', 'fuyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749760');
INSERT INTO `xhl_data_city` VALUES ('556', '22', '都江堰', 'dujiangyan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('557', '22', '彭州', 'pengzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('558', '22', '江油', 'jiangyou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('559', '22', '什邡', 'shizuo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('560', '22', '广汉', 'guanghan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('561', '22', '绵竹', 'mianzhu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('562', '22', '阆中', 'zuozhong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('563', '22', '华蓥', 'huazuo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('564', '22', '峨眉山', 'emeishan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('565', '22', '万源', 'wanyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('566', '22', '简阳', 'jianyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('148', '5', '六安', 'liuan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749864');
INSERT INTO `xhl_data_city` VALUES ('545', '22', '广元', 'guangyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('546', '22', '广安', 'guangan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('547', '22', '遂宁', 'suining', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('548', '22', '乐山', 'leshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('549', '22', '巴中', 'bazhong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('550', '22', '达州', 'dazhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('551', '22', '资阳', 'ziyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('552', '22', '眉山', 'meishan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('553', '22', '雅安', 'yaan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('554', '22', '崇州', 'chongzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('555', '22', '邛崃', 'zuozuo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('149', '14', '常德', 'changde', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422749942');
INSERT INTO `xhl_data_city` VALUES ('534', '21', '古交', 'gujiao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('535', '21', '潞城', 'lucheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('536', '21', '高平', 'gaoping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('537', '21', '原平', 'yuanping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('538', '21', '孝义', 'xiaoyi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('539', '21', '汾阳', 'fenyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('540', '21', '介休', 'jiexiu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('541', '21', '侯马', 'houma', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('542', '21', '霍州', 'huozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('543', '21', '永济', 'yongji', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('544', '21', '河津', 'hejin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('150', '25', '西宁', 'xining', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750031');
INSERT INTO `xhl_data_city` VALUES ('523', '20', '韩城', 'hancheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('524', '20', '华阴', 'huayin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('525', '20', '兴平', 'xingping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('526', '21', '朔州', 'shuozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('527', '21', '阳泉', 'yangquan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('528', '21', '长治', 'changzhi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('529', '21', '晋城', 'jincheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('530', '21', '忻州', 'xinzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('531', '21', '吕梁', 'lvliang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('532', '21', '临汾', 'linfen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('533', '21', '运城', 'yuncheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('151', '5', '马鞍山', 'maanshan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750097');
INSERT INTO `xhl_data_city` VALUES ('512', '19', '乳山', 'rushan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('513', '19', '滕州', 'zuozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('514', '19', '曲阜', 'qufu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('515', '19', '兖州', 'zuozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('516', '19', '邹城', 'zoucheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('517', '19', '新泰', 'xintai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('518', '19', '肥城', 'feicheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('519', '20', '延安', 'yanan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('520', '20', '铜川', 'tongchuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('521', '20', '渭南', 'weinan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('522', '20', '商洛', 'shangluo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('152', '9', '铜仁', 'tongren', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750162');
INSERT INTO `xhl_data_city` VALUES ('501', '19', '诸城', 'zhucheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('502', '19', '寿光', 'shouguang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('503', '19', '栖霞', 'qixia', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('504', '19', '海阳', 'haiyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('505', '19', '龙口', 'longkou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('506', '19', '莱阳', 'laiyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('507', '19', '莱州', 'laizhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('508', '19', '蓬莱', 'penglai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('509', '19', '招远', 'zhaoyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('510', '19', '文登', 'wendeng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('511', '19', '荣成', 'rongcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('153', '12', '濮阳', 'puyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750248');
INSERT INTO `xhl_data_city` VALUES ('490', '19', '胶南', 'jiaonan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('491', '19', '即墨', 'jimo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('492', '19', '平度', 'pingdu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('493', '19', '莱西', 'laixi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('494', '19', '临清', 'linqing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('495', '19', '乐陵', 'leling', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('496', '19', '禹城', 'yucheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('497', '19', '安丘', 'anqiu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('498', '19', '昌邑', 'changyi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('499', '19', '高密', 'gaomi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('500', '19', '青州', 'qingzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('154', '20', '宝鸡', 'baoji', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750331');
INSERT INTO `xhl_data_city` VALUES ('479', '18', '凤城', 'fengcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('480', '18', '东港', 'donggang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('481', '18', '大石桥', 'dashiqiao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('482', '18', '盖州', 'gaizhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('483', '18', '凌海', 'linghai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('484', '18', '北宁', 'beining', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('485', '18', '兴城', 'xingcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('486', '19', '东营', 'dongying', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('487', '19', '滨州', 'binzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('488', '19', '章丘', 'zhangqiu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('489', '19', '胶州', 'jiaozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('155', '13', '孝感', 'xiaogan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750399');
INSERT INTO `xhl_data_city` VALUES ('468', '18', '葫芦岛', 'huludao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('469', '18', '新民', 'xinmin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('470', '18', '瓦房店', 'wafangdian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('471', '18', '普兰店', 'pulandian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('472', '18', '庄河', 'zhuanghe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('473', '18', '北票', 'beipiao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('474', '18', '凌源', 'lingyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('475', '18', '调兵山', 'diaobingshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('476', '18', '开原', 'kaiyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('477', '18', '灯塔', 'dengta', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('478', '18', '海城', 'haicheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('156', '21', '大同', 'datong', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750460');
INSERT INTO `xhl_data_city` VALUES ('457', '17', '靖江', 'jingjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('458', '18', '朝阳', 'chaoyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('459', '18', '阜新', 'fuxin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('460', '18', '抚顺', 'fushun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('461', '18', '本溪', 'benxi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('462', '18', '辽阳', 'liaoyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('463', '18', '鞍山', 'anshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('464', '18', '丹东', 'dandong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('465', '18', '营口', 'yingkou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('466', '18', '盘锦', 'panjin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('467', '18', '锦州', 'jinzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('157', '14', '益阳', 'yiyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750560');
INSERT INTO `xhl_data_city` VALUES ('446', '17', '启东', 'qidong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('447', '17', '大丰', 'dafeng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('448', '17', '东台', 'dongtai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('449', '17', '高邮', 'gaoyou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('450', '17', '仪征', 'yizheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('451', '17', '扬中', 'yangzhong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('452', '17', '句容', 'jurong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('453', '17', '丹阳', 'danyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('454', '17', '兴化', 'xinghua', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('455', '17', '姜堰', 'jiangyan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('456', '17', '泰兴', 'taixing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('158', '14', '郴州', 'chenzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750641');
INSERT INTO `xhl_data_city` VALUES ('435', '17', '宜兴', 'yixing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('436', '17', '邳州', 'zuozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('437', '17', '新沂', 'xinyi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('438', '17', '金坛', 'jintan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('439', '17', '溧阳', 'zuoyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('440', '17', '常熟', 'changshu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('441', '17', '张家港', 'zhangjiagang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('442', '17', '太仓', 'taicang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('443', '17', '吴江', 'wujiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('444', '17', '如皋', 'rugao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('445', '17', '海门', 'haimen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('159', '14', '怀化', 'huaihua', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750713');
INSERT INTO `xhl_data_city` VALUES ('424', '16', '宜春', 'yichun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('425', '16', '瑞昌', 'ruichang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('426', '16', '乐平', 'leping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('427', '16', '瑞金', 'ruijin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('428', '16', '南康', 'nankang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('429', '16', '德兴', 'dexing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('430', '16', '丰城', 'fengcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('431', '16', '樟树', 'zhangshu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('432', '16', '高安', 'gaoan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('433', '16', '井冈山', 'jinggangshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('434', '16', '贵溪', 'guixi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('160', '14', '娄底', 'loudi', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750799');
INSERT INTO `xhl_data_city` VALUES ('413', '15', '临江', 'linjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('414', '15', '延吉', 'yanji', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('415', '15', '图们', 'tumen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('416', '15', '敦化', 'dunhua', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('417', '15', '珲春', 'zuochun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('418', '15', '龙井', 'longjing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('419', '15', '和龙', 'helong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('420', '16', '新余', 'xinyu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('421', '16', '萍乡', 'pingxiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('422', '16', '上饶', 'shangrao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('423', '16', '抚州', 'fuzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('161', '14', '邵阳', 'shaoyang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750867');
INSERT INTO `xhl_data_city` VALUES ('402', '15', '榆树', 'yushu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('403', '15', '磐石', 'panshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('404', '15', '蛟河', 'zuohe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('405', '15', '桦甸', 'zuodian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('406', '15', '舒兰', 'shulan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('407', '15', '洮南', 'zuonan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('408', '15', '大安', 'daan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('409', '15', '双辽', 'shuangliao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('410', '15', '公主岭', 'gongzhuling', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('411', '15', '梅河口', 'meihekou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('412', '15', '集安', 'jian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('162', '14', '张家界', 'zhangjiajie', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422750937');
INSERT INTO `xhl_data_city` VALUES ('390', '14', '洪江', 'hongjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('391', '14', '冷水江', 'lengshuijiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('392', '14', '涟源', 'lianyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('393', '14', '吉首', 'jishou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('394', '15', '吉林市', 'jilinshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('395', '15', '白城', 'baicheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('396', '15', '松原', 'songyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('397', '15', '四平', 'siping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('398', '15', '辽源', 'liaoyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('399', '15', '白山', 'baishan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('400', '15', '德惠', 'dehui', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('401', '15', '九台', 'jiutai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('163', '13', '咸宁', 'xianning', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751010');
INSERT INTO `xhl_data_city` VALUES ('379', '14', '常宁', 'changning', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('380', '14', '浏阳', 'zuoyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('381', '14', '津市', 'jinshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('382', '14', '沅江', 'zuojiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('383', '14', '汨罗', 'zuoluo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('384', '14', '临湘', 'linxiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('385', '14', '醴陵', 'zuoling', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('386', '14', '湘乡', 'xiangxiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('387', '14', '韶山', 'shaoshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('388', '14', '资兴', 'zixing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('389', '14', '武冈', 'wugang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('164', '12', '三门峡', 'sanmenxia', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751069');
INSERT INTO `xhl_data_city` VALUES ('367', '13', '大冶', 'daye', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('368', '13', '赤壁', 'chibi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('369', '13', '石首', 'shishou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('370', '13', '洪湖', 'honghu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('371', '13', '松滋', 'songzi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('372', '13', '宜都', 'yidu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('373', '13', '枝江', 'zhijiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('374', '13', '当阳', 'dangyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('375', '13', '恩施', 'enshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('376', '13', '利川', 'lichuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('377', '14', '永州', 'yongzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('378', '14', '耒阳', 'zuoyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('165', '13', '黄冈', 'huanggang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751142');
INSERT INTO `xhl_data_city` VALUES ('356', '13', '丹江口', 'danjiangkou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('357', '13', '老河口', 'laohekou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('358', '13', '枣阳', 'zaoyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('359', '13', '宜城', 'yicheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('360', '13', '钟祥', 'zhongxiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('361', '13', '汉川', 'hanchuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('362', '13', '应城', 'yingcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('363', '13', '安陆', 'anlu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('364', '13', '广水', 'guangshui', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('365', '13', '麻城', 'macheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('366', '13', '武穴', 'wuxue', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('166', '12', '周口', 'zhoukou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751209');
INSERT INTO `xhl_data_city` VALUES ('345', '12', '舞钢', 'wugang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('346', '12', '义马', 'yima', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('347', '12', '灵宝', 'lingbao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('348', '12', '项城', 'xiangcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('349', '13', '襄樊', 'xiangfan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('350', '13', '荆门', 'jingmen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('351', '13', '黄石', 'huangshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('352', '13', '随州', 'suizhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('353', '13', '仙桃', 'xiantao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('354', '13', '天门', 'tianmen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('355', '13', '潜江', 'qianjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('167', '12', '商丘', 'shanqiu', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751284');
INSERT INTO `xhl_data_city` VALUES ('334', '12', '新郑', 'xinzheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('335', '12', '登封', 'dengfeng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('336', '12', '新密', 'xinmi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('337', '12', '偃师', 'zuoshi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('338', '12', '孟州', 'mengzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('339', '12', '沁阳', 'qinyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('340', '12', '卫辉', 'weihui', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('341', '12', '辉县', 'huixian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('342', '12', '林州', 'linzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('343', '12', '禹州', 'yuzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('344', '12', '长葛', 'changge', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('168', '22', '南充', 'nanchong', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751352');
INSERT INTO `xhl_data_city` VALUES ('324', '12', '安阳', 'anyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('325', '12', '鹤壁', 'hebi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('326', '12', '漯河', 'zuohe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('327', '12', '驻马店', 'zhumadian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('328', '12', '济源', 'jiyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('329', '12', '巩义', 'gongyi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('330', '12', '邓州', 'dengzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('331', '12', '永城', 'yongcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('332', '12', '汝州', 'ruzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('333', '12', '荥阳', 'zuoyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('169', '12', '平顶山', 'pingdingshan', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751425');
INSERT INTO `xhl_data_city` VALUES ('312', '11', '五大连池', 'wudalianchi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('313', '11', '铁力', 'tieli', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('314', '11', '同江', 'tongjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('315', '11', '富锦', 'fujin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('316', '11', '虎林', 'hulin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('317', '11', '密山', 'mishan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('318', '11', '绥芬河', 'suifenhe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('319', '11', '海林', 'hailin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('320', '11', '宁安', 'ningan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('321', '11', '安达', 'anda', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('322', '11', '肇东', 'zhaodong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('323', '11', '海伦', 'hailun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('170', '28', '赤峰', 'chifeng', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751489');
INSERT INTO `xhl_data_city` VALUES ('301', '11', '双鸭山', 'shuangyashan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('302', '11', '七台河', 'qitaihe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('303', '11', '鸡西', 'jixi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('304', '11', '牡丹江', 'mudanjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('305', '11', '绥化', 'suihua', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('306', '11', '双城', 'shuangcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('307', '11', '尚志', 'shangzhi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('308', '11', '五常', 'wuchang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('309', '11', '阿城', 'acheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('310', '11', '讷河', 'zuohe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('311', '11', '北安', 'beian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('171', '22', '宜宾', 'yibin', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751567');
INSERT INTO `xhl_data_city` VALUES ('290', '10', '黄骅', 'huangzuo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('291', '10', '河间', 'hejian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('292', '10', '冀州', 'jizhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('293', '10', '深州', 'shenzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('294', '10', '南宫', 'nangong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('295', '10', '沙河', 'shahe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('296', '10', '武安', 'wuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('297', '11', '黑河', 'heihe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('298', '11', '伊春', 'yichun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('299', '11', '鹤岗', 'hegang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('300', '11', '佳木斯', 'jiamusi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('172', '21', '晋中', 'jinzhong', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751653');
INSERT INTO `xhl_data_city` VALUES ('279', '10', '鹿泉', 'luquan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('280', '10', '遵化', 'zunhua', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('281', '10', '迁安', 'qianan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('282', '10', '霸州', 'bazhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('283', '10', '三河', 'sanhe', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('284', '10', '定州', 'dingzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('285', '10', '涿州', 'zuozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('286', '10', '安国', 'anguo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('287', '10', '高碑店', 'gaobeidian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('288', '10', '泊头', 'botou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('289', '10', '任丘', 'renqiu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('173', '12', '许昌', 'xuchang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751733');
INSERT INTO `xhl_data_city` VALUES ('268', '9', '仁怀', 'renhuai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('269', '9', '凯里', 'kaili', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('270', '9', '都匀', 'duyun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('271', '9', '兴义', 'xingyi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('272', '9', '福泉', 'fuquan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('273', '10', '张家口', 'zhangjiakou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('274', '10', '衡水', 'hengshui', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('275', '10', '辛集', 'xinji', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('276', '10', '藁城', 'zuocheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('277', '10', '晋州', 'jinzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('278', '10', '新乐', 'xinle', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('174', '5', '亳州', 'bozhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751795');
INSERT INTO `xhl_data_city` VALUES ('257', '8', '阳春', 'yangchun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('258', '8', '化州', 'huazhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('259', '8', '信宜', 'xinyi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('260', '8', '高州', 'gaozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('261', '8', '吴川', 'wuchuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('262', '8', '廉江', 'lianjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('263', '8', '雷州', 'leizhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('264', '9', '安顺', 'anshun', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('265', '9', '毕节', 'bijie', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('266', '9', '清镇', 'qingzhen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('267', '9', '赤水', 'chishui', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('175', '13', '荆州', 'jingzhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422751863');
INSERT INTO `xhl_data_city` VALUES ('246', '8', '南雄', 'nanxiong', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('247', '8', '兴宁', 'xingning', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('248', '8', '普宁', 'puning', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('249', '8', '陆丰', 'lufeng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('250', '8', '恩平', 'enping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('251', '8', '台山', 'taishan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('252', '8', '开平', 'kaiping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('253', '8', '鹤山', 'heshan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('254', '8', '高要', 'gaoyao', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('255', '8', '四会', 'sihui', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('256', '8', '罗定', 'luoding', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('176', '22', '内江', 'neijiang', '1', '', '', '', '', '', '', '', '', null, '50', '0', '1422751946');
INSERT INTO `xhl_data_city` VALUES ('235', '8', '河源', 'heyuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('236', '8', '梅州', 'meizhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('237', '8', '潮州', 'chaozhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('238', '8', '揭阳', 'jieyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('239', '8', '汕尾', 'shanwei', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('240', '8', '湛江', 'zhanjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('241', '8', '从化', 'conghua', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('242', '8', '增城', 'zengcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('243', '8', '英德', 'yingde', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('244', '8', '连州', 'lianzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('245', '8', '乐昌', 'lechang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('177', '20', '安康', 'ankang', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422752020');
INSERT INTO `xhl_data_city` VALUES ('224', '7', '酒泉', 'jiuquan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('225', '7', '张掖', 'zhangye', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('226', '7', '武威', 'wuwei', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('227', '7', '庆阳', 'qingyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('228', '7', '平凉', 'pingliang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('229', '7', '定西', 'dingxi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('230', '7', '陇南', 'longnan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('231', '7', '玉门', 'yumen', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('232', '7', '敦煌', 'dunhuang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('233', '7', '临夏', 'linxia', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('234', '7', '合作', 'hezuo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('178', '13', '鄂州', 'ezhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422752087');
INSERT INTO `xhl_data_city` VALUES ('213', '6', '石狮', 'shishi', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('214', '6', '晋江', 'jinjiang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('215', '6', '南安', 'nanan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('216', '6', '龙海', 'longhai', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('217', '6', '漳平', 'zhangping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('218', '6', '福安', 'fuan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('219', '6', '福鼎', 'fuding', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('220', '7', '嘉峪关', 'jiayuguan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('221', '7', '金昌', 'jinchang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('222', '7', '白银', 'baiyin', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('223', '7', '天水', 'tianshui', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('179', '19', '德州', 'dezhou', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422752143');
INSERT INTO `xhl_data_city` VALUES ('202', '5', '巢湖', 'chaohu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('203', '6', '南平', 'nanping', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('204', '6', '三明', 'sanming', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('205', '6', '莆田', 'putian', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('206', '6', '福清', 'fuqing', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('207', '6', '长乐', 'changle', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('208', '6', '邵武', 'shaowu', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('209', '6', '武夷山', 'wuyishan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('210', '6', '建瓯', 'jianzuo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('211', '6', '建阳', 'jianyang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('212', '6', '永安', 'yongan', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('180', '10', '承德', 'chengde', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1422752214');
INSERT INTO `xhl_data_city` VALUES ('192', '5', '宿州', 'suzhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('193', '5', '淮北', 'huaibei', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('194', '5', '铜陵', 'tongling', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('195', '5', '池州', 'chizhou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('196', '5', '宣城', 'xuancheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('197', '5', '界首', 'jieshou', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('198', '5', '明光', 'mingguang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('199', '5', '天长', 'tianchang', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('200', '5', '桐城', 'tongcheng', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('201', '5', '宁国', 'ningguo', '1', '', '', '', '', '', '', '', '', '', '50', '1', '1418199801');
INSERT INTO `xhl_data_city` VALUES ('185', '19', '莱芜', 'laiwu', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1423145203');
INSERT INTO `xhl_data_city` VALUES ('187', '19', '聊城', 'liaocheng', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1423145413');
INSERT INTO `xhl_data_city` VALUES ('190', '19', '日照', 'rizhao', '1', '', '', '', '', '', '', '', '', null, '50', '1', '1424859320');

-- ----------------------------
-- Table structure for `xhl_data_hangye`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_data_hangye`;
CREATE TABLE `xhl_data_hangye` (
  `hangye_id` int(11) NOT NULL AUTO_INCREMENT,
  `hangye2` varchar(150) DEFAULT NULL,
  `hangye` varchar(150) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  PRIMARY KEY (`hangye_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_data_hangye
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_data_province`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_data_province`;
CREATE TABLE `xhl_data_province` (
  `province_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `province_name` varchar(30) DEFAULT '',
  `province_name2` varchar(30) DEFAULT NULL,
  `orderby` smallint(6) DEFAULT '50',
  PRIMARY KEY (`province_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_data_province
-- ----------------------------
INSERT INTO `xhl_data_province` VALUES ('1', '北京市', '北京', '15');
INSERT INTO `xhl_data_province` VALUES ('2', '天津市', '天津', '4');
INSERT INTO `xhl_data_province` VALUES ('3', '上海市', '上海', '12');
INSERT INTO `xhl_data_province` VALUES ('4', '重庆市', '重庆', '7');
INSERT INTO `xhl_data_province` VALUES ('5', '安徽省', '安徽', '6');
INSERT INTO `xhl_data_province` VALUES ('6', '福建省', '福建', '9');
INSERT INTO `xhl_data_province` VALUES ('7', '甘肃省', '甘肃', '3');
INSERT INTO `xhl_data_province` VALUES ('8', '广东省', '广东', '46');
INSERT INTO `xhl_data_province` VALUES ('9', '贵州省', '贵州', '3');
INSERT INTO `xhl_data_province` VALUES ('10', '河北省', '河北', '8');
INSERT INTO `xhl_data_province` VALUES ('11', '黑龙江', '黑龙江', '6');
INSERT INTO `xhl_data_province` VALUES ('12', '河南省', '河南', '4');
INSERT INTO `xhl_data_province` VALUES ('13', '湖北省', '湖北', '7');
INSERT INTO `xhl_data_province` VALUES ('14', '湖南省', '湖南', '5');
INSERT INTO `xhl_data_province` VALUES ('15', '吉林省', '吉林', '5');
INSERT INTO `xhl_data_province` VALUES ('16', '江西省', '江西', '3');
INSERT INTO `xhl_data_province` VALUES ('17', '江苏省', '江苏', '30');
INSERT INTO `xhl_data_province` VALUES ('18', '辽宁省', '辽宁', '10');
INSERT INTO `xhl_data_province` VALUES ('19', '山东省', '山东', '25');
INSERT INTO `xhl_data_province` VALUES ('20', '陕西省', '陕西', '6');
INSERT INTO `xhl_data_province` VALUES ('21', '山西省', '山西', '4');
INSERT INTO `xhl_data_province` VALUES ('22', '四川省', '四川', '4');
INSERT INTO `xhl_data_province` VALUES ('23', '云南省', '云南', '2');
INSERT INTO `xhl_data_province` VALUES ('24', '浙江省', '浙江', '22');
INSERT INTO `xhl_data_province` VALUES ('25', '青海省', '青海', '1');
INSERT INTO `xhl_data_province` VALUES ('26', '海南省', '海南', '3');
INSERT INTO `xhl_data_province` VALUES ('27', '广西省', '广西', '6');
INSERT INTO `xhl_data_province` VALUES ('28', '内蒙古', '内蒙古', '6');
INSERT INTO `xhl_data_province` VALUES ('29', '宁夏省', '宁夏', '3');
INSERT INTO `xhl_data_province` VALUES ('30', '西藏', '西藏', '2');
INSERT INTO `xhl_data_province` VALUES ('31', '新疆', '新疆', '4');
INSERT INTO `xhl_data_province` VALUES ('32', '香港', '香港', '3');
INSERT INTO `xhl_data_province` VALUES ('33', '澳门', '澳门', '2');
INSERT INTO `xhl_data_province` VALUES ('34', '台湾省', '台湾', '3');
INSERT INTO `xhl_data_province` VALUES ('35', '亚洲', '亚洲', '41');
INSERT INTO `xhl_data_province` VALUES ('36', '非洲', '非洲', '8');
INSERT INTO `xhl_data_province` VALUES ('37', '北美洲', '北美洲', '18');
INSERT INTO `xhl_data_province` VALUES ('38', '南美洲', '南美洲', '5');
INSERT INTO `xhl_data_province` VALUES ('39', '大洋洲', '大洋洲', '1');
INSERT INTO `xhl_data_province` VALUES ('40', '欧洲', '欧洲', '57');
INSERT INTO `xhl_data_province` VALUES ('41', '美国', '美国', '1');

-- ----------------------------
-- Table structure for `xhl_data_province123`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_data_province123`;
CREATE TABLE `xhl_data_province123` (
  `province_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `province_name` varchar(30) DEFAULT '',
  `province_name2` varchar(30) DEFAULT NULL,
  `orderby` smallint(6) DEFAULT '50',
  PRIMARY KEY (`province_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_data_province123
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_demand`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_demand`;
CREATE TABLE `xhl_demand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `thumb` varchar(100) DEFAULT NULL COMMENT '缩略图',
  `label` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `uname` varchar(20) DEFAULT NULL COMMENT '用户名',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `demandtype` int(11) DEFAULT NULL COMMENT '需求类型',
  `money` decimal(10,0) DEFAULT NULL COMMENT '金额',
  `state` int(11) DEFAULT '2' COMMENT '状态 1审核通过 2待审核 3逻辑删除',
  `look` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_demand
-- ----------------------------
INSERT INTO `xhl_demand` VALUES ('1', '第一个需求', '<p>\r\n	<span>1.松松散散少时诵诗书所所所试试所</span> \r\n</p>\r\n<p>\r\n	<span><span>1.松松散散少时诵</span></span> \r\n</p>\r\n<p>\r\n	<span><span>1.松松散散少时诵诗书所所所试</span></span> \r\n</p>\r\n<p>\r\n	<span><span>1.松松散散少时诵诗书所所所试试所</span></span> \r\n</p>\r\n<p>\r\n	<span><span>1.松松散散少时诵诗书试试所</span><br />\r\n</span> \r\n</p>\r\n<p>\r\n	<span><br />\r\n</span> \r\n</p>', 'photo/201701/20170104_D001E0B7A29ED9CF79E1A08E51A04159.jpg', '4,3,2,1', '1124', '15101573480', '1509355201', '13', '444', '1', '144');
INSERT INTO `xhl_demand` VALUES ('2', '测试文案', '<strong><em><u>事实上事实上事实上</u></em></strong>没啥要求没啥要求没啥要求没啥要求没啥要求没啥要求没啥要求没啥要求没啥要求', 'photo/201710/20171024_79220806842D37576E6CD940A5D00854.png', '4,3,1', '1124', null, null, '13', '44', '2', '9');
INSERT INTO `xhl_demand` VALUES ('3', '测试标题', '', null, '', '1124', null, null, '12', '0', '2', '9');
INSERT INTO `xhl_demand` VALUES ('4', '淡定淡定', '呃呃呃呃呃呃鹅鹅鹅鹅鹅鹅饿鹅鹅鹅鹅鹅鹅饿', 'photo/201710/20171030_24157CE7EB53A11573B6E84758C77E1A.png', '4,2,1', '1124', null, null, '13', '222', '2', '9');
INSERT INTO `xhl_demand` VALUES ('5', '飞凤飞飞凤飞飞凤飞飞', '柔柔弱弱若若若日日日若若若若若若', 'photo/201710/20171030_D2420B53EDE51EAB3FE1B57039A79966.png', '3,1', '1124', '15101573480', '1509334940', '13', '33', '2', '9');
INSERT INTO `xhl_demand` VALUES ('6', '', '', null, '', '1124', '15101573480', '1509335009', '12', '0', '2', '0');
INSERT INTO `xhl_demand` VALUES ('7', '的点点滴滴', '飞', 'photo/201710/20171030_C0FCD76372FAA870625819BEB29DD1E8.png', '4,1', '1124', '15101573480', '1509335642', '13', '4', '2', '0');
INSERT INTO `xhl_demand` VALUES ('8', 'fffffff', '333333333', 'photo/201710/20171030_A3106EEB48FF69EEA2B301B9DCBA5CDE.png', '1,3', '1124', '15101573480', '1509344080', '13', '33', '2', '9');
INSERT INTO `xhl_demand` VALUES ('9', 'ddddddddd', 'rerrr', 'photo/201710/20171030_ADC257DAC61687733F43560A0050DB19.png', '4', '1124', '15101573480', '1509345511', '13', '4', '2', '8');
INSERT INTO `xhl_demand` VALUES ('10', 'ddddddddd', 'rerrr', null, '', '1124', '15101573480', '1509346486', '13', '4', '2', '7');
INSERT INTO `xhl_demand` VALUES ('11', 'ffffffffff', 'rerrr', 'photo/201710/20171030_DD60A2E7343D8DDA553F7D400AD9F9E9.png', '3,2', '1124', '15101573480', '1509346980', '13', '4', '2', '6');
INSERT INTO `xhl_demand` VALUES ('12', null, null, null, null, null, null, null, null, null, '2', '0');
INSERT INTO `xhl_demand` VALUES ('13', '123', '13', 'photo/201806/20180605_60799BA2AA76B6FFA8BCB2C7F8E2644F.png', '4,3', '1127', '测试', '1528170723', '13', '1', '2', '0');

-- ----------------------------
-- Table structure for `xhl_demand_label`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_demand_label`;
CREATE TABLE `xhl_demand_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `labelid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_demand_label
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_designer`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_designer`;
CREATE TABLE `xhl_designer` (
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `group_id` smallint(6) DEFAULT '0',
  `company_id` mediumint(8) DEFAULT '0',
  `province_id` smallint(6) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `name` varchar(50) DEFAULT '',
  `school` varchar(100) DEFAULT '',
  `qq` varchar(15) DEFAULT '',
  `qqpas` varchar(20) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT '',
  `attention_num` mediumint(8) DEFAULT '0',
  `case_num` smallint(6) DEFAULT '0',
  `blog_num` mediumint(6) DEFAULT '0',
  `chao_num` mediumint(6) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  `tenders_num` mediumint(8) DEFAULT '0',
  `tenders_sign` mediumint(8) DEFAULT '0',
  `comments` mediumint(8) DEFAULT '0',
  `score` mediumint(8) DEFAULT '0',
  `score1` mediumint(8) DEFAULT '0',
  `score2` mediumint(8) DEFAULT '0',
  `score3` mediumint(8) DEFAULT '0',
  `yuyue_num` mediumint(8) DEFAULT '0',
  `slogan` varchar(150) DEFAULT NULL,
  `about` mediumtext,
  `orderby` smallint(6) DEFAULT '50',
  `is_qian` tinyint(1) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `flushtime` int(10) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  `skills` varchar(255) DEFAULT NULL COMMENT '个人技能',
  `group_name` varchar(255) DEFAULT NULL COMMENT '职务',
  PRIMARY KEY (`uid`),
  KEY `company_id` (`uid`,`company_id`,`orderby`,`audit`,`closed`,`city_id`,`area_id`) USING BTREE,
  KEY `orderby` (`views`,`score`,`orderby`,`flushtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_designer
-- ----------------------------
INSERT INTO `xhl_designer` VALUES ('1082', '0', '0', '0', '0', '0', 'wwww', '', '', null, '18811579962', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, null, '50', '0', '0', '0', '1483494190', '1483494190', null, null);
INSERT INTO `xhl_designer` VALUES ('1083', '0', '0', '0', '0', '0', '千米电商云2', '', '', null, '18612037194', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, null, '50', '0', '0', '0', '1483494371', '1483494371', null, null);
INSERT INTO `xhl_designer` VALUES ('1084', '0', '0', '0', '0', '0', 'BAOCMS', '', '', null, '18612037142', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, null, '50', '0', '0', '0', '1483510402', '1483510402', null, null);
INSERT INTO `xhl_designer` VALUES ('1085', '0', '0', '0', '8', '0', '江湖信息科技', '', '', null, '18612037426', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '50', '0', '0', '0', '1483511561', '1483511561', 'ui,mysql', null);
INSERT INTO `xhl_designer` VALUES ('1086', '0', '0', '0', '8', '0', '张三123', '北京大学', '565785452', null, '18811579975', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '设计理念设计理念', '个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介', '50', '0', '0', '0', '1483524216', '1483524216', 'php,css', null);
INSERT INTO `xhl_designer` VALUES ('1087', '0', '0', '0', '8', '0', '游戏网站', '北京大学', '5648787546', null, '18536256329', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '设计理念设计理念', '个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介', '50', '0', '0', '0', '1483692792', '1483692792', 'php,css', null);
INSERT INTO `xhl_designer` VALUES ('1099', '0', '0', '0', '0', '0', 'zyn0803', '', '', null, '15801504326', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, null, '50', '0', '0', '0', '1493868305', '1493868305', null, null);
INSERT INTO `xhl_designer` VALUES ('1124', '0', '0', '0', '8', '0', '15101573480', '', '', null, '15101573480', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '50', '0', '0', '0', '1507624911', '1507624911', 'php,css', null);
INSERT INTO `xhl_designer` VALUES ('1125', '0', '0', '0', '0', '0', '乌云图', '', '', null, '18204718748', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '50', '0', '1', '0', '1521802921', '1521802921', 'ui,mysql', null);
INSERT INTO `xhl_designer` VALUES ('1126', '15', '0', '0', '14', '0', '15810988699', '', '41787632', null, '15810988699', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '身边的技术合伙人', '<p class=\"f-font-26\" style=\"color:#FE552E;font-size:40px;font-family:å¾®è½¯é›…é»‘, &quot;background-color:#FFF9ED;\">\r\n	我们的优势\r\n</p>\r\n<p class=\"f-font-default s-grey\" style=\"color:#FE552E;font-size:16px;font-family:å¾®è½¯é›…é»‘, &quot;background-color:#FFF9ED;\">\r\n	15年网站开发工程师带领成熟的技术团队，为您解决各种“疑难杂症”;\r\n</p>\r\n<p class=\"f-font-default s-grey\" style=\"color:#FE552E;font-size:16px;font-family:å¾®è½¯é›…é»‘, &quot;background-color:#FFF9ED;\">\r\n	成熟安全的自研的项目框架，帮您的项目快速从0到1;\r\n</p>\r\n<p class=\"f-font-default s-grey\" style=\"color:#FE552E;font-size:16px;font-family:å¾®è½¯é›…é»‘, &quot;background-color:#FFF9ED;\">\r\n	多家共养模式保障我们团队的供给，并且分担了多家公司的技术成本;\r\n</p>\r\n<p class=\"f-font-default s-grey\" style=\"color:#FE552E;font-size:16px;font-family:å¾®è½¯é›…é»‘, &quot;background-color:#FFF9ED;\">\r\n	干点活累并快乐的成长!\r\n</p>', '50', '0', '1', '0', '1522403369', '1522403369', 'asp,php', 'CTO');
INSERT INTO `xhl_designer` VALUES ('1127', '2', '0', '0', '8', '21', '测试qq23', '', '', null, '18204718748', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '大道至简', '12344', '50', '0', '1', '0', '1522667446', '1522667446', 'php,css', 'dddd');
INSERT INTO `xhl_designer` VALUES ('1132', '0', '0', '0', '0', '0', 'yu123', '', '', null, '13141472661', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '50', '0', '1', '0', '1528343714', '1528343714', '', null);
INSERT INTO `xhl_designer` VALUES ('1133', '6', '0', '0', '8', '0', '测试1', '无', '1', null, '13141472661', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '高效,简洁', '无', '50', '0', '1', '0', '1528428292', '1528428292', 'PHP,CSS,MYSQL', 'php');
INSERT INTO `xhl_designer` VALUES ('1131', '60', '0', '0', '8', '12', '测', 'wu', '1', null, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'wu', '12344', '50', '0', '1', '0', '1528773469', '1528773469', 'css,php', 'dddd');
INSERT INTO `xhl_designer` VALUES ('1134', '0', '0', '0', '0', '0', '13466649862', '', '', null, '13466649862', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, null, '50', '0', '1', '0', '1530848569', '1530848569', null, null);

-- ----------------------------
-- Table structure for `xhl_designer_article`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_designer_article`;
CREATE TABLE `xhl_designer_article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xiangmu_id` int(10) unsigned DEFAULT '0' COMMENT '项目id',
  `city_id` smallint(6) unsigned DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `title` varchar(80) DEFAULT '',
  `content` mediumtext,
  `is_top` tinyint(1) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`article_id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `__INDEX` (`city_id`,`is_top`,`audit`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_designer_article
-- ----------------------------
INSERT INTO `xhl_designer_article` VALUES ('19', '418', '0', '1087', '111111', '1111111111111111111111111111111111111', '0', '0', '0', '', '1483693536');
INSERT INTO `xhl_designer_article` VALUES ('20', '417', '0', '0', '工工工工工', '工工工工工工工工工工工工工', '0', '0', '0', '', '1506914240');

-- ----------------------------
-- Table structure for `xhl_designer_attr`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_designer_attr`;
CREATE TABLE `xhl_designer_attr` (
  `uid` mediumint(8) unsigned NOT NULL,
  `attr_id` smallint(6) unsigned DEFAULT NULL,
  `attr_value_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_designer_attr
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_designer_comment`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_designer_comment`;
CREATE TABLE `xhl_designer_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `designer_id` mediumint(8) DEFAULT '0',
  `score1` tinyint(3) DEFAULT '0',
  `score2` tinyint(3) DEFAULT '0',
  `score3` tinyint(3) DEFAULT '0',
  `content` varchar(1024) DEFAULT '',
  `reply` varchar(1024) DEFAULT '',
  `replyip` varchar(15) DEFAULT '',
  `replytime` int(10) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_designer_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_designer_preference`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_designer_preference`;
CREATE TABLE `xhl_designer_preference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `industry` varchar(1000) DEFAULT NULL COMMENT '领域/行业',
  `skill` varchar(1000) DEFAULT NULL COMMENT '专业技能',
  `edu` varchar(1000) DEFAULT NULL COMMENT '教育经历',
  `job` varchar(1000) DEFAULT NULL COMMENT '工作经历',
  `edit_time` int(20) DEFAULT NULL COMMENT '最后一次修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_designer_preference
-- ----------------------------
INSERT INTO `xhl_designer_preference` VALUES ('6', '1125', '{\"0\":\"\\u6d4b\\u8bd54\",\"1\":\"\\u6d4b\\u8bd5\"}', null, null, null, null);
INSERT INTO `xhl_designer_preference` VALUES ('15', '0', null, null, null, null, null);
INSERT INTO `xhl_designer_preference` VALUES ('16', '1126', null, null, null, null, null);
INSERT INTO `xhl_designer_preference` VALUES ('17', '1127', '{\"0\":\"12222\",\"2\":\"1121\"}', null, '{\"0\":{\"schoolname\":\"\\u5510\\u5c71\\u79d1\\u6280\",\"majorstr\":\"\\u8ba1\\u7b97\\u673a\\u5e94\\u7528\\u6280\\u672f\",\"degree\":\"\\u5927\\u4e13\",\"date_start\":\"2018-05-11\",\"date_end\":\"2018-05-24\"}}', '{}', null);
INSERT INTO `xhl_designer_preference` VALUES ('18', '1133', null, null, null, null, null);
INSERT INTO `xhl_designer_preference` VALUES ('19', '1131', null, null, null, null, null);

-- ----------------------------
-- Table structure for `xhl_designer_sheji`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_designer_sheji`;
CREATE TABLE `xhl_designer_sheji` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `xiangmu_id` int(11) unsigned NOT NULL COMMENT '项目id',
  `uid` int(11) NOT NULL COMMENT '用户名id',
  `dateline` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_designer_sheji
-- ----------------------------
INSERT INTO `xhl_designer_sheji` VALUES ('18', '1125', '1125', '1516617122');

-- ----------------------------
-- Table structure for `xhl_designer_yuyue`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_designer_yuyue`;
CREATE TABLE `xhl_designer_yuyue` (
  `yuyue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` mediumint(8) DEFAULT '0',
  `uid` mediumint(9) DEFAULT '0',
  `designer_id` mediumint(9) DEFAULT '0',
  `company_id` mediumint(9) DEFAULT '0',
  `mobile` varchar(20) DEFAULT NULL,
  `contact` varchar(32) DEFAULT NULL,
  `content` varchar(1024) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  `clientip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`yuyue_id`),
  KEY `designer_id` (`designer_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_designer_yuyue
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_groupdetail`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_groupdetail`;
CREATE TABLE `xhl_groupdetail` (
  `userid` int(11) NOT NULL,
  `username` varchar(155) NOT NULL,
  `useravatar` varchar(155) NOT NULL,
  `usersign` varchar(155) NOT NULL,
  `groupid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_groupdetail
-- ----------------------------
INSERT INTO `xhl_groupdetail` VALUES ('1125', '18204718748', 'http://gdh.wordhuo.com/files/face/face.jpg', '', '419');
INSERT INTO `xhl_groupdetail` VALUES ('1124', '15101573480', 'http://gdh.wordhuo.com/files/photo/201710/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '', '419');

-- ----------------------------
-- Table structure for `xhl_guan`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_guan`;
CREATE TABLE `xhl_guan` (
  `guan_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `province_id` smallint(6) DEFAULT '0',
  `province` varchar(30) DEFAULT NULL,
  `city_id` smallint(6) DEFAULT '0',
  `city` varchar(30) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `thumb` varchar(150) DEFAULT NULL,
  `lng` varchar(20) DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `views` mediumint(8) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `laiyuan` varchar(150) DEFAULT NULL,
  `laiyuan_url` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`guan_id`),
  KEY `city_id` (`city_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=412 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_guan
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_guan_caiji`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_guan_caiji`;
CREATE TABLE `xhl_guan_caiji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) COLLATE utf8_bin NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`url`)
) ENGINE=MyISAM AUTO_INCREMENT=411 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of xhl_guan_caiji
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_guan_data`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_guan_data`;
CREATE TABLE `xhl_guan_data` (
  `guan_id` int(11) NOT NULL,
  `data` text,
  `dateline` int(11) DEFAULT '0',
  PRIMARY KEY (`guan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_guan_data
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_huizhan`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_huizhan`;
CREATE TABLE `xhl_huizhan` (
  `zhan_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `guan_id` int(8) DEFAULT '0',
  `guanname` varchar(100) DEFAULT NULL,
  `catid` int(10) DEFAULT '0',
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fromtime` int(10) DEFAULT '0',
  `totime` int(10) DEFAULT '0',
  `keyword` varchar(255) DEFAULT NULL,
  `content` text,
  `fanwei` text,
  `views` mediumint(8) DEFAULT '0',
  `photos` mediumint(8) DEFAULT '0',
  `url` varchar(150) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  `laiyuan` varchar(150) DEFAULT NULL,
  `laiyuan_url` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`zhan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_huizhan
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_ims_account`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_account`;
CREATE TABLE `xhl_ims_account` (
  `acid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `hash` varchar(8) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `isconnect` tinyint(4) NOT NULL,
  `isdeleted` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_account
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_ims_account_wxapp`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_account_wxapp`;
CREATE TABLE `xhl_ims_account_wxapp` (
  `acid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `token` varchar(32) NOT NULL,
  `encodingaeskey` varchar(43) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `account` varchar(30) NOT NULL,
  `original` varchar(50) NOT NULL,
  `key` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `appdomain` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `default_acid` tinyint(2) unsigned NOT NULL DEFAULT '2',
  `rank` int(11) NOT NULL DEFAULT '0' COMMENT '排名',
  `title_initial` varchar(1) NOT NULL,
  `groupid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hash` varchar(100) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL,
  `isconnect` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`acid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_account_wxapp
-- ----------------------------
INSERT INTO `xhl_ims_account_wxapp` VALUES ('2', '2', 'q13W1sswzM9q3s3pi3235Ws2W3M22Is1', 'Zu4bJKuTF8U2tT1FdwMIZkIDmTEe3u82mkf1T1ZV1uZ', '1', 'gdh2019@126.com', 'gh_c1da2e3e7e9e', 'wx72f74d80d9d3ad78', 'fc87a45be3f356b2cc382a29b315dc99', '干点活名片', '', '', '2', '0', 'G', '0', 'EEee8BeL', '4', '0', '0');

-- ----------------------------
-- Table structure for `xhl_ims_amouse_wxapp_card`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_amouse_wxapp_card`;
CREATE TABLE `xhl_ims_amouse_wxapp_card` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `avater` varchar(255) NOT NULL,
  `mobile` varchar(18) DEFAULT '' COMMENT '手机号',
  `username` varchar(100) DEFAULT '' COMMENT '用户名',
  `email` varchar(100) DEFAULT '' COMMENT '邮箱',
  `weixin` varchar(100) DEFAULT '' COMMENT '微信号',
  `weixinImg` varchar(100) DEFAULT '' COMMENT '微信号',
  `company` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `imgs` text,
  `zan` int(10) DEFAULT '0',
  `view` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0' COMMENT '0表示已审核，1表示未审核，2表示禁用',
  `collect` int(10) DEFAULT '0',
  `qrcode` varchar(200) DEFAULT NULL COMMENT '二维码',
  `service` text COMMENT '服务介绍',
  `product` text,
  `cimgs` text COMMENT '公司图片',
  `pimgs` text COMMENT '产品图片',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_amouse_wxapp_card
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_ims_amouse_wxapp_card_history`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_amouse_wxapp_card_history`;
CREATE TABLE `xhl_ims_amouse_wxapp_card_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `cardid` int(10) NOT NULL,
  `from_user` varchar(255) NOT NULL COMMENT '自己',
  `zan_mid` int(10) NOT NULL,
  `zan_cid` int(10) NOT NULL,
  `to_user` varchar(255) NOT NULL COMMENT '好友',
  `sms_type` tinyint(2) NOT NULL COMMENT '0:看，1:赞 2:收藏',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_amouse_wxapp_card_history
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_ims_amouse_wxapp_card_slide`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_amouse_wxapp_card_slide`;
CREATE TABLE `xhl_ims_amouse_wxapp_card_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '2' COMMENT '所属帐号',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_amouse_wxapp_card_slide
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_ims_amouse_wxapp_member`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_amouse_wxapp_member`;
CREATE TABLE `xhl_ims_amouse_wxapp_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `vip` tinyint(1) DEFAULT '0' COMMENT '0vip，1非vip',
  `sex` tinyint(1) DEFAULT '0' COMMENT '1男，2女',
  `myattention` varchar(255) DEFAULT NULL,
  `myfocus` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `companyAddress` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0表示已审核，1表示未审核，2表示禁用',
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_amouse_wxapp_member
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_ims_amouse_wxapp_sysset`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_amouse_wxapp_sysset`;
CREATE TABLE `xhl_ims_amouse_wxapp_sysset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `mobile_verify_status` tinyint(1) DEFAULT '1' COMMENT '短信验证码',
  `logo` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT '' COMMENT '版权',
  `systel` varchar(255) DEFAULT '' COMMENT '联系电话',
  `enable` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否官方客服',
  `sms_user` varchar(50) NOT NULL DEFAULT '',
  `sms_secret` varchar(80) NOT NULL,
  `sms_type` tinyint(2) NOT NULL COMMENT '0阿里大于老接口，1新接口',
  `sms_template_code` text NOT NULL COMMENT '短信模板Code',
  `sms_free_sign_name` text NOT NULL COMMENT '阿里大鱼短信签名',
  `reg_sms_code` varchar(50) NOT NULL,
  `isshare` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启分享',
  `iscreate` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否开启分享',
  `public_status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否开启分享',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_amouse_wxapp_sysset
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_ims_mc_mapping_fans`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_mc_mapping_fans`;
CREATE TABLE `xhl_ims_mc_mapping_fans` (
  `fanid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `groupid` varchar(30) NOT NULL,
  `salt` char(8) NOT NULL,
  `follow` tinyint(1) unsigned NOT NULL,
  `followtime` int(10) unsigned NOT NULL,
  `unfollowtime` int(10) unsigned NOT NULL,
  `tag` varchar(1000) NOT NULL,
  `updatetime` int(10) unsigned DEFAULT NULL,
  `unionid` varchar(64) NOT NULL,
  PRIMARY KEY (`fanid`),
  UNIQUE KEY `openid_2` (`openid`),
  KEY `acid` (`acid`),
  KEY `uniacid` (`uniacid`),
  KEY `nickname` (`nickname`),
  KEY `updatetime` (`updatetime`),
  KEY `uid` (`uid`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_mc_mapping_fans
-- ----------------------------
INSERT INTO `xhl_ims_mc_mapping_fans` VALUES ('1', '2', '2', '1130', 'ol_oP5aG-9KXToUAiph9_yOlUYtM', '干点活', '', 'Mnndw4JN', '1', '1525917995', '0', 'YTo5OntzOjk6InN1YnNjcmliZSI7aToxO3M6Njoib3BlbmlkIjtzOjI4OiJvbF9vUDVhRy05S1hUb1VBaXBoOV95T2xVWXRNIjtzOjg6Im5pY2tuYW1lIjtzOjk6IuW5sueCuea0uyI7czozOiJzZXgiO2k6MTtzOjg6Imxhbmd1YWdlIjtzOjU6InpoX0NOIjtzOjQ6ImNpdHkiO3M6NzoiRmVuZ3RhaSI7czo4OiJwcm92aW5jZSI7czo3OiJCZWlqaW5nIjtzOjc6ImNvdW50cnkiO3M6NToiQ2hpbmEiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwczovL3d4LnFsb2dvLmNuL21tb3Blbi92aV8zMi92NE54RW0xS1RYS0x4aWJ4NXdpYWd3S0FpYm9UR2xpYzF1WVBUTGxUUGszQ05EaWNUUHpnQ2tGVGJnRElxMWliYzE0SGx0VmlheWd2QWZEUDFyRUNMZFQ3WGhJWFEvMTMyIjt9', '1525917995', 'oQcp70p8ZqW6l3fxW-uKcvdWM3Uw');

-- ----------------------------
-- Table structure for `xhl_ims_mc_oauth_fans`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_mc_oauth_fans`;
CREATE TABLE `xhl_ims_mc_oauth_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oauth_openid` varchar(50) NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_oauthopenid_acid` (`oauth_openid`,`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_mc_oauth_fans
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_ims_wxapp_versions`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_ims_wxapp_versions`;
CREATE TABLE `xhl_ims_wxapp_versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `version` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `modules` varchar(1000) NOT NULL,
  `design_method` tinyint(1) NOT NULL,
  `template` int(10) NOT NULL,
  `quickmenu` varchar(2500) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `version` (`version`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_ims_wxapp_versions
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_items`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_items`;
CREATE TABLE `xhl_items` (
  `items_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `keywords` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`items_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of xhl_items
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_label`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_label`;
CREATE TABLE `xhl_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `labelname` varchar(255) DEFAULT NULL COMMENT '标签名',
  `state` int(11) DEFAULT NULL COMMENT '状态 1显示2隐藏',
  `type` int(11) DEFAULT NULL COMMENT '类型1项目/需求标签',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_label
-- ----------------------------
INSERT INTO `xhl_label` VALUES ('1', 'php', '1', '1');
INSERT INTO `xhl_label` VALUES ('2', 'java', '1', '1');
INSERT INTO `xhl_label` VALUES ('3', 'js', '1', '1');
INSERT INTO `xhl_label` VALUES ('4', 'C++', '1', '1');

-- ----------------------------
-- Table structure for `xhl_member`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member`;
CREATE TABLE `xhl_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` smallint(6) DEFAULT '0',
  `uname` varchar(100) DEFAULT '',
  `passwd` char(32) DEFAULT '',
  `from` enum('member','shang','shop','company','zhu','designer','unknown','gz') DEFAULT 'member',
  `from_id` int(10) DEFAULT '0',
  `mail` varchar(100) DEFAULT '@',
  `mobile` varchar(15) DEFAULT '',
  `credits` mediumint(8) DEFAULT '0',
  `gold` mediumint(8) DEFAULT '0',
  `alipay` varchar(50) DEFAULT NULL,
  `rmb` float(10,2) DEFAULT '0.00',
  `rmb_zhi` float(10,2) DEFAULT '0.00',
  `rmb_yu` float(10,2) DEFAULT '0.00',
  `gender` enum('man','woman') NOT NULL,
  `city_id` smallint(6) DEFAULT '0',
  `realname` varchar(50) DEFAULT '',
  `face` varchar(150) DEFAULT '',
  `face_80` varchar(150) DEFAULT '',
  `face_32` varchar(150) DEFAULT '',
  `Y` smallint(4) DEFAULT '0',
  `M` tinyint(2) DEFAULT '0',
  `D` tinyint(2) DEFAULT '0',
  `verify` tinyint(1) unsigned DEFAULT '0',
  `uc_uid` mediumint(8) DEFAULT '0',
  `cart` varchar(1024) DEFAULT '',
  `lastlogin` int(10) unsigned DEFAULT '0',
  `loginip` char(15) DEFAULT '0.0.0.0',
  `closed` tinyint(1) unsigned DEFAULT '0',
  `app` varchar(10) DEFAULT NULL,
  `unionid` varchar(50) DEFAULT '',
  `openid` varchar(50) DEFAULT NULL,
  `islogin` tinyint(1) DEFAULT '0',
  `regip` char(15) DEFAULT '0.0.0.0',
  `dateline` int(10) unsigned DEFAULT '0',
  `status` varchar(50) DEFAULT NULL COMMENT '登录状态',
  `groupid` int(11) DEFAULT NULL COMMENT '聊天分组ID',
  `identity` tinyint(2) DEFAULT '1' COMMENT '身份 1 个人 2 公司',
  PRIMARY KEY (`uid`),
  KEY `uname` (`uname`) USING BTREE,
  KEY `mail` (`mail`) USING BTREE,
  KEY `mobile` (`mobile`) USING BTREE,
  KEY `uc_uid` (`uc_uid`) USING BTREE,
  KEY `__INDEX` (`verify`,`closed`,`dateline`,`from`,`city_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1135 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member
-- ----------------------------
INSERT INTO `xhl_member` VALUES ('1123', '0', 'user', '96e79218965eb72c92a549dd5a330112', 'member', '0', '123@qq.com', '15801508932', '0', '0', null, '0.00', '0.00', '0.00', '', '0', '', 'photo/201805/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '', '', '0', '0', '0', '0', '0', '', '1513649209', '113.46.130.79', '0', null, null, null, '0', '116.243.130.118', '1500706257', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1124', '0', '15101573480', '96e79218965eb72c92a549dd5a330112', 'designer', '0', '1062329969@qq.com', '15101573480', '0', '0', null, '0.00', '0.00', '0.00', '', '0', '', 'photo/201805/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '', '', '0', '0', '0', '0', '0', '', '1522661200', '118.144.55.190', '0', null, null, null, '0', '127.0.0.1', '1507624911', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1125', '0', '18204718748', '86a375aacb17606c185d31c8d3e320ce', 'designer', '0', '18204718748@jisunet.com', '18204718749', '0', '0', null, '0.00', '0.00', '0.00', '', '0', '', 'photo/201805/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '', '', '0', '0', '0', '0', '0', '', '1522666697', '118.144.55.190', '0', null, null, null, '0', '118.144.55.162', '1521802921', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1126', '15', '15810988699', '0870813a78b21cea3d029c58ddf873f3', 'designer', '0', '15810988699@jisunet.com', '15810988699', '0', '0', null, '0.00', '0.00', '0.00', '', '0', '', 'photo/201807/20180723_4E3ECF4A024DB808E06B932EB4502A00.jpg', '', '', '0', '0', '0', '0', '0', '', '1532392935', '127.0.0.1', '0', null, null, null, '0', '118.144.55.150', '1522403369', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1127', '2', '测试', '86a375aacb17606c185d31c8d3e320ce', 'designer', '0', '532031004@qq.com', '13141472661', '0', '0', null, '0.00', '0.00', '0.00', '', '0', '', 'photo/201806/20180614_6377E62FDB99B9E8E207BA83FCFD8F7C.jpg', '', '', '0', '0', '0', '0', '0', '', '1531130698', '116.243.99.125', '0', null, null, null, '0', '118.144.55.190', '1522667446', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1129', '0', 'card_15258269091395', '58f93b6c92b994c4f60345d810a6b3f5', 'unknown', '0', '', '18204718748', '0', '0', null, '0.00', '0.00', '0.00', 'man', '0', '', 'photo/201805/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '', '', '0', '0', '0', '0', '0', '', '1525826908', '118.144.55.247', '0', null, '', 'ol_oP5ZKk072vGerevwGOcYtaH7A', '0', '118.144.55.247', '1525826908', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1130', '0', 's', '58f93b6c92b994c4f60345d810a6b3f5', 'unknown', '0', '', '', '0', '0', null, '0.00', '0.00', '0.00', 'man', '0', '', 'photo/201805/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '', '', '0', '0', '0', '0', '0', '', '1525917994', '118.144.55.247', '0', null, '', 'ol_oP5aG-9KXToUAiph9_yOlUYtM', '0', '118.144.55.247', '1525917994', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1131', '60', 'admin', '86a375aacb17606c185d31c8d3e320ce', 'designer', '0', '532031004@qq.com', '13141472661', '0', '0', null, '0.00', '0.00', '0.00', 'man', '0', '', 'photo/201807/20180712_BF0FBE7C06EFA6590CA7BD80E1F02284.jpg', '', '', '0', '0', '0', '0', '0', '', '1531376447', '116.243.107.142', '0', null, '', null, '0', '118.144.55.247', '1525917994', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1132', '0', '13141472661', '86a375aacb17606c185d31c8d3e320ce', 'designer', '0', '', '13141472662', '0', '0', null, '0.00', '0.00', '0.00', 'man', '0', '', 'photo/201805/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '', '', '0', '0', '0', '0', '0', '', '1528361970', '127.0.0.1', '0', null, '', null, '0', '127.0.0.1', '1528343714', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1133', '6', '测试1', '86a375aacb17606c185d31c8d3e320ce', 'designer', '0', '', '13141472661', '0', '0', null, '0.00', '0.00', '0.00', 'man', '0', '', 'photo/201805/20171020_2DF58FD0AC62F1313BD1A42AE203A40F.png', '', '', '0', '0', '0', '0', '0', '', '1528773366', '127.0.0.1', '0', null, '', null, '0', '127.0.0.1', '1528428292', null, null, '1');
INSERT INTO `xhl_member` VALUES ('1134', '0', '13466649862', 'd04be495b99739fda99ea7c0c7fceeb5', 'designer', '0', '', '13466649862', '0', '0', null, '0.00', '0.00', '0.00', 'man', '0', '', '', '', '', '0', '0', '0', '0', '0', '', '1530848569', '116.243.99.125', '0', null, '', null, '0', '116.243.99.125', '1530848569', null, null, '1');

-- ----------------------------
-- Table structure for `xhl_member_favorite`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member_favorite`;
CREATE TABLE `xhl_member_favorite` (
  `fav_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `from` enum('case','shop','gz','designer','product','company') DEFAULT NULL,
  `itemId` int(10) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`fav_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member_favorite
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_member_fields`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member_fields`;
CREATE TABLE `xhl_member_fields` (
  `uid` int(10) NOT NULL DEFAULT '0',
  `addr` varchar(255) DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member_fields
-- ----------------------------
INSERT INTO `xhl_member_fields` VALUES ('1080', '');
INSERT INTO `xhl_member_fields` VALUES ('1081', '');
INSERT INTO `xhl_member_fields` VALUES ('1082', '');
INSERT INTO `xhl_member_fields` VALUES ('1083', '');
INSERT INTO `xhl_member_fields` VALUES ('1084', '');
INSERT INTO `xhl_member_fields` VALUES ('1085', '');
INSERT INTO `xhl_member_fields` VALUES ('1086', '');
INSERT INTO `xhl_member_fields` VALUES ('1087', '');
INSERT INTO `xhl_member_fields` VALUES ('1088', '');
INSERT INTO `xhl_member_fields` VALUES ('1089', '');
INSERT INTO `xhl_member_fields` VALUES ('1090', '');
INSERT INTO `xhl_member_fields` VALUES ('1091', '');
INSERT INTO `xhl_member_fields` VALUES ('1092', '');
INSERT INTO `xhl_member_fields` VALUES ('1093', '');
INSERT INTO `xhl_member_fields` VALUES ('1094', '');
INSERT INTO `xhl_member_fields` VALUES ('1095', '');
INSERT INTO `xhl_member_fields` VALUES ('1096', '');
INSERT INTO `xhl_member_fields` VALUES ('1097', '');
INSERT INTO `xhl_member_fields` VALUES ('1098', '');
INSERT INTO `xhl_member_fields` VALUES ('1099', '');
INSERT INTO `xhl_member_fields` VALUES ('1100', '');
INSERT INTO `xhl_member_fields` VALUES ('1101', '');
INSERT INTO `xhl_member_fields` VALUES ('1102', '');
INSERT INTO `xhl_member_fields` VALUES ('1103', '');
INSERT INTO `xhl_member_fields` VALUES ('1104', '');
INSERT INTO `xhl_member_fields` VALUES ('1105', '');
INSERT INTO `xhl_member_fields` VALUES ('1106', '');
INSERT INTO `xhl_member_fields` VALUES ('1107', '');
INSERT INTO `xhl_member_fields` VALUES ('1108', '');
INSERT INTO `xhl_member_fields` VALUES ('1109', '');
INSERT INTO `xhl_member_fields` VALUES ('1110', '');
INSERT INTO `xhl_member_fields` VALUES ('1111', '');
INSERT INTO `xhl_member_fields` VALUES ('1112', '');
INSERT INTO `xhl_member_fields` VALUES ('1113', '');
INSERT INTO `xhl_member_fields` VALUES ('1114', '');
INSERT INTO `xhl_member_fields` VALUES ('1115', '');
INSERT INTO `xhl_member_fields` VALUES ('1116', '');
INSERT INTO `xhl_member_fields` VALUES ('1117', '');
INSERT INTO `xhl_member_fields` VALUES ('1118', '');
INSERT INTO `xhl_member_fields` VALUES ('1119', '');
INSERT INTO `xhl_member_fields` VALUES ('1120', '');
INSERT INTO `xhl_member_fields` VALUES ('1121', '');
INSERT INTO `xhl_member_fields` VALUES ('1122', '');
INSERT INTO `xhl_member_fields` VALUES ('1123', '');
INSERT INTO `xhl_member_fields` VALUES ('1124', '');
INSERT INTO `xhl_member_fields` VALUES ('1125', '');
INSERT INTO `xhl_member_fields` VALUES ('1126', '');
INSERT INTO `xhl_member_fields` VALUES ('1127', '');
INSERT INTO `xhl_member_fields` VALUES ('1128', '');
INSERT INTO `xhl_member_fields` VALUES ('1129', '');
INSERT INTO `xhl_member_fields` VALUES ('1130', '');
INSERT INTO `xhl_member_fields` VALUES ('1132', '');
INSERT INTO `xhl_member_fields` VALUES ('1133', '');
INSERT INTO `xhl_member_fields` VALUES ('1134', '');

-- ----------------------------
-- Table structure for `xhl_member_flush`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member_flush`;
CREATE TABLE `xhl_member_flush` (
  `flush_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT '0',
  `gold` mediumint(8) DEFAULT '0',
  `from` varchar(10) NOT NULL DEFAULT '',
  `itemId` int(10) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`flush_id`,`from`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member_flush
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_member_group`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member_group`;
CREATE TABLE `xhl_member_group` (
  `group_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) DEFAULT '',
  `from` enum('member','mechanic','foreman','designer','company','shop','gz') DEFAULT 'member',
  `icon` varchar(150) DEFAULT '',
  `free_count` smallint(6) DEFAULT '0',
  `priv` mediumtext,
  `orderby` smallint(5) DEFAULT '50',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member_group
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_member_log`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member_log`;
CREATE TABLE `xhl_member_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT '0',
  `from` enum('credits','gold','money') DEFAULT NULL,
  `action` varchar(10) DEFAULT '',
  `number` int(10) DEFAULT '0',
  `log` varchar(255) DEFAULT '',
  `admin` varchar(255) DEFAULT '',
  `clientip` char(15) DEFAULT '0.0.0.0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1046 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member_log
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_member_verify`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member_verify`;
CREATE TABLE `xhl_member_verify` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `id_number` varchar(50) DEFAULT '',
  `id_photo` varchar(150) DEFAULT '',
  `mobile` varchar(50) DEFAULT NULL,
  `verify` tinyint(1) DEFAULT '0',
  `refuse` varchar(255) DEFAULT '',
  `verify_time` int(10) DEFAULT '0',
  `request_ip` varchar(15) DEFAULT '0.0.0.0',
  `request_time` int(10) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member_verify
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_member_weixin`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member_weixin`;
CREATE TABLE `xhl_member_weixin` (
  `uid` mediumint(8) DEFAULT '0',
  `openid` char(32) DEFAULT '',
  `info` mediumtext,
  `status` tinyint(1) DEFAULT '0',
  `datelin` int(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member_weixin
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_member_zhi`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_member_zhi`;
CREATE TABLE `xhl_member_zhi` (
  `zhi_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `rmb` float(10,2) DEFAULT '0.00',
  `alipay` varchar(50) DEFAULT NULL,
  `realname` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  `adminid` int(10) DEFAULT '0',
  `shui` float(6,2) DEFAULT NULL,
  `shouxu` float(6,2) DEFAULT NULL,
  `shifu` float(10,2) DEFAULT '0.00',
  `admintime` int(10) DEFAULT '0',
  `adminip` varchar(15) DEFAULT '0',
  `intor` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`zhi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_member_zhi
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_message`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_message`;
CREATE TABLE `xhl_message` (
  `message_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '留言人姓名',
  `phone` varchar(15) NOT NULL DEFAULT '' COMMENT '留言人手机',
  `contactqq` varchar(15) NOT NULL DEFAULT '' COMMENT '联系qq',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `clientip` varchar(15) NOT NULL DEFAULT '' COMMENT '留言人ip',
  `audit` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1正常 0待处理',
  `closed` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 1删除 0正常',
  `content` text COMMENT '留言内容',
  `reply` varchar(255) NOT NULL DEFAULT '' COMMENT '回复信息',
  `replyip` varchar(15) NOT NULL DEFAULT '' COMMENT '回复人ip',
  `replytime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
  `service` varchar(255) NOT NULL DEFAULT '' COMMENT '留言类型',
  `relname` varchar(50) NOT NULL DEFAULT '' COMMENT '真实姓名',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_message
-- ----------------------------
INSERT INTO `xhl_message` VALUES ('1', '你好', '1580150893', '', '1492839747', '127.0.0.1', '1', '1', '121', '131', '127.0.0.1', '1492840705', '', '');
INSERT INTO `xhl_message` VALUES ('2', '你好', '15801508932', '', '1492840551', '127.0.0.1', '1', '1', '121', '', '127.0.0.1', '1492840551', '', '');
INSERT INTO `xhl_message` VALUES ('3', '你好', '15801508932', '', '1492840561', '127.0.0.1', '1', '1', '121', '12312', '127.0.0.1', '1492840561', '', '');
INSERT INTO `xhl_message` VALUES ('4', '你好', '15801508932', '', '1492840584', '127.0.0.1', '1', '1', '121', '12312', '127.0.0.1', '1492840584', '', '');
INSERT INTO `xhl_message` VALUES ('5', '你好', '1580150893', '12', '1492842335', '127.0.0.1', '0', '1', '312', '', '', '0', '定制网站', '');
INSERT INTO `xhl_message` VALUES ('6', '大的', '89264940', '312', '1492842405', '127.0.0.1', '0', '1', '12333', '', '127.0.0.1', '1492848977', 'H5网站', '');
INSERT INTO `xhl_message` VALUES ('7', '', '89264940', '', '1492842603', '127.0.0.1', '0', '1', '', '', '', '0', '', '');
INSERT INTO `xhl_message` VALUES ('8', '123', '15801508932', '31', '1492848696', '127.0.0.1', '0', '1', '312', '', '127.0.0.1', '1492848696', '定制网站', '');
INSERT INTO `xhl_message` VALUES ('9', 'zhaoyunan', '15801508932', '', '1492848773', '127.0.0.1', '0', '1', '', '', '', '0', '', '');
INSERT INTO `xhl_message` VALUES ('10', '', '15801508932', '', '1492848790', '127.0.0.1', '0', '1', '', '', '127.0.0.1', '1492848790', '', '');
INSERT INTO `xhl_message` VALUES ('11', '', '15801508932', '', '1492849169', '127.0.0.1', '0', '1', '', '', '127.0.0.1', '1492849169', '', '');
INSERT INTO `xhl_message` VALUES ('12', '', '15801508932', '', '1492857334', '127.0.0.1', '0', '1', '', '', '127.0.0.1', '1492857334', '', '');
INSERT INTO `xhl_message` VALUES ('13', '', '15801508932', '', '1492857347', '127.0.0.1', '0', '1', '', '', '127.0.0.1', '1492857347', '', '');
INSERT INTO `xhl_message` VALUES ('14', '', '15801508932', '', '1492857513', '127.0.0.1', '0', '1', '', '', '127.0.0.1', '1492857513', '', '');
INSERT INTO `xhl_message` VALUES ('15', '', '15801508932', '0', '1492857948', '127.0.0.1', '0', '1', '', '', '127.0.0.1', '1492857948', '', '');
INSERT INTO `xhl_message` VALUES ('16', '', '15801508932', '0', '1492857972', '127.0.0.1', '0', '1', '', '', '127.0.0.1', '1492857972', '', '');
INSERT INTO `xhl_message` VALUES ('17', '', '15801508932', '0', '1492858238', '127.0.0.1', '0', '1', '', '', '127.0.0.1', '1492858238', '', '');
INSERT INTO `xhl_message` VALUES ('18', '123', '12', '', '1492995420', '127.0.0.1', '0', '1', '321', '', '127.0.0.1', '1492995420', '', '');
INSERT INTO `xhl_message` VALUES ('19', '', '15801508932', '', '1498550682', '127.0.0.1', '0', '1', '1233123', '', '', '0', '', '赵宇楠');
INSERT INTO `xhl_message` VALUES ('20', '', '15801508932', '', '1500689471', '127.0.0.1', '0', '1', '1234123', '', '127.0.0.1', '1500690874', '', '赵玉楠11');
INSERT INTO `xhl_message` VALUES ('21', '', '15801508932', '', '1500706308', '116.243.130.118', '0', '1', '你哈哦', '', '', '0', '', '赵玉楠');
INSERT INTO `xhl_message` VALUES ('22', '', '15801508932', '', '1500718503', '116.243.130.118', '0', '1', '1233', '', '', '0', '', '赵玉楠');
INSERT INTO `xhl_message` VALUES ('23', '', '15801508932', '', '1500880302', '116.243.122.20', '0', '1', '大大大', '', '', '0', '', '赵玉楠');
INSERT INTO `xhl_message` VALUES ('24', '', '15801508932', '', '1500880371', '116.243.122.20', '0', '1', '大大大', '', '', '0', '', '赵玉楠');
INSERT INTO `xhl_message` VALUES ('25', '', '15801508932', '', '1500880458', '116.243.122.20', '0', '0', '大大大', '', '', '0', '', '赵玉楠');
INSERT INTO `xhl_message` VALUES ('26', '', '14511111111', '', '1506510967', '116.243.115.251', '0', '0', '事', '', '', '0', '', '阿萨');

-- ----------------------------
-- Table structure for `xhl_node`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_node`;
CREATE TABLE `xhl_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `module_name` varchar(155) NOT NULL DEFAULT '' COMMENT '模块名',
  `control_name` varchar(155) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `typeid` int(11) NOT NULL COMMENT '父级节点id',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_node
-- ----------------------------
INSERT INTO `xhl_node` VALUES ('1', '用户管理', '#', '#', '#', '2', '0', 'fa fa-users');
INSERT INTO `xhl_node` VALUES ('2', '用户列表', 'admin', 'user', 'index', '2', '1', '');
INSERT INTO `xhl_node` VALUES ('3', '添加用户', 'admin', 'user', 'useradd', '1', '2', '');
INSERT INTO `xhl_node` VALUES ('4', '编辑用户', 'admin', 'user', 'useredit', '1', '2', '');
INSERT INTO `xhl_node` VALUES ('5', '删除用户', 'admin', 'user', 'userdel', '1', '2', '');
INSERT INTO `xhl_node` VALUES ('6', '角色列表', 'admin', 'role', 'index', '2', '1', '');
INSERT INTO `xhl_node` VALUES ('7', '添加角色', 'admin', 'role', 'roleadd', '1', '6', '');
INSERT INTO `xhl_node` VALUES ('8', '编辑角色', 'admin', 'role', 'roleedit', '1', '6', '');
INSERT INTO `xhl_node` VALUES ('9', '删除角色', 'admin', 'role', 'roledel', '1', '6', '');
INSERT INTO `xhl_node` VALUES ('10', '分配权限', 'admin', 'role', 'giveaccess', '1', '6', '');
INSERT INTO `xhl_node` VALUES ('11', '系统管理', '#', '#', '#', '2', '0', 'fa fa-desktop');
INSERT INTO `xhl_node` VALUES ('12', '数据备份/还原', 'admin', 'data', 'index', '2', '11', '');
INSERT INTO `xhl_node` VALUES ('13', '备份数据', 'admin', 'data', 'importdata', '1', '12', '');
INSERT INTO `xhl_node` VALUES ('14', '还原数据', 'admin', 'data', 'backdata', '1', '12', '');
INSERT INTO `xhl_node` VALUES ('15', '采集管理', 'admin', '#', '#', '2', '0', 'fa fa-hdd-o');
INSERT INTO `xhl_node` VALUES ('16', '采集测试', 'admin', 'tcollect', 'index', '2', '15', '');
INSERT INTO `xhl_node` VALUES ('17', '测试列表', 'admin', 'tcollect', 'testlist', '1', '17', '');
INSERT INTO `xhl_node` VALUES ('18', '测试文章', 'admin', 'tcollect', 'testarc', '1', '17', '');
INSERT INTO `xhl_node` VALUES ('19', '采集规则列表', 'admin', 'rulelist', 'index', '2', '15', '');
INSERT INTO `xhl_node` VALUES ('20', '添加采集规则', 'admin', 'rulelist', 'ruleadd', '1', '20', '');
INSERT INTO `xhl_node` VALUES ('21', '编辑采集规则', 'admin', 'rulelist', 'ruleedit', '1', '20', '');
INSERT INTO `xhl_node` VALUES ('22', '删除采集规则', 'admin', 'rulelist', 'ruledel', '1', '20', '');
INSERT INTO `xhl_node` VALUES ('23', 'LayChat管理', '#', '#', '#', '2', '0', 'fa fa-paw');
INSERT INTO `xhl_node` VALUES ('24', 'laychat用户管理', 'admin', 'layuser', 'index', '2', '23', '');
INSERT INTO `xhl_node` VALUES ('25', 'laychat消息记录', 'admin', 'laymsg', 'index', '2', '23', '');
INSERT INTO `xhl_node` VALUES ('26', 'laychat用户添加', 'admin', 'layuser', 'useradd', '1', '24', '');
INSERT INTO `xhl_node` VALUES ('27', 'laychat用户删除', 'admin', 'layuser', 'userdel', '1', '24', '');
INSERT INTO `xhl_node` VALUES ('28', 'laychat用户编辑', 'admin', 'layuser', 'useredit', '1', '24', '');

-- ----------------------------
-- Table structure for `xhl_role`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_role`;
CREATE TABLE `xhl_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `rolename` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_role
-- ----------------------------
INSERT INTO `xhl_role` VALUES ('1', '超级管理员', '');
INSERT INTO `xhl_role` VALUES ('2', '系统维护员', '1,2,3,4,5,6,7,8,9,10');
INSERT INTO `xhl_role` VALUES ('3', '新闻发布员', '1,2,3,4,5');

-- ----------------------------
-- Table structure for `xhl_rule`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_rule`;
CREATE TABLE `xhl_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rulename` varchar(155) NOT NULL COMMENT '规则标题',
  `baseurl` varchar(155) NOT NULL COMMENT '采集站点的地址',
  `listurl` varchar(155) NOT NULL COMMENT '列表页地址',
  `ismore` tinyint(1) NOT NULL COMMENT '是否批量采集 1 否 2是',
  `start` int(11) DEFAULT '0' COMMENT '列表页开始地址',
  `end` int(11) DEFAULT '0' COMMENT '列表页结束地址',
  `titlediv` varchar(155) NOT NULL COMMENT '标题父层地址',
  `title` varchar(155) NOT NULL COMMENT '文章标题内容规则',
  `titleurl` varchar(155) NOT NULL COMMENT '标题地址规则',
  `body` varchar(155) NOT NULL COMMENT '文章内容规则',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_rule
-- ----------------------------
INSERT INTO `xhl_rule` VALUES ('1', '脚本之家php文章采集', 'http://www.jb51.net', 'http://www.jb51.net/list/list_15_1.htm', '1', '0', '0', '.artlist dl dt a', 'text', 'href', '#content', '1471244221');
INSERT INTO `xhl_rule` VALUES ('2', 'thinkphp官网文章规则', 'http://www.thinkphp.cn', 'http://www.thinkphp.cn/code/system/p/1.html', '1', '0', '0', '.extend ul li .hd a', 'text', 'href', '.wrapper .detail-bd', '1471244221');
INSERT INTO `xhl_rule` VALUES ('3', '果壳网科学人采集规则', 'http://www.guokr.com', 'http://www.guokr.com/scientific/', '1', '0', '0', '#waterfall .article h3 a', 'text', 'href', '.document div:eq(0)', '1471247277');

-- ----------------------------
-- Table structure for `xhl_session`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_session`;
CREATE TABLE `xhl_session` (
  `SSID` char(35) NOT NULL,
  `uid` mediumint(8) DEFAULT '0',
  `city_id` mediumint(8) DEFAULT '0',
  `ip` char(15) DEFAULT '0.0.0.0',
  `data` varchar(1024) DEFAULT NULL,
  `lastupdate` int(10) DEFAULT '0',
  PRIMARY KEY (`SSID`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_session
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_shang`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_shang`;
CREATE TABLE `xhl_shang` (
  `shang_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) DEFAULT NULL,
  `province_id` int(4) DEFAULT '0',
  `province` varchar(30) DEFAULT NULL,
  `city_id` int(4) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `hangye` varchar(90) DEFAULT NULL,
  `dizhi` varchar(200) DEFAULT NULL,
  `lianxiren` varchar(30) DEFAULT NULL,
  `dianhua` varchar(30) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `uptime` int(11) DEFAULT '0',
  `url` varchar(150) DEFAULT NULL,
  `laiyuan` varchar(30) DEFAULT NULL,
  `laiyuan_url` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`shang_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1876 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_shang
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_shang_caiji`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_shang_caiji`;
CREATE TABLE `xhl_shang_caiji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) COLLATE utf8_bin NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`url`)
) ENGINE=MyISAM AUTO_INCREMENT=1876 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of xhl_shang_caiji
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_shang_data`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_shang_data`;
CREATE TABLE `xhl_shang_data` (
  `shang_id` int(11) NOT NULL,
  `data` text,
  `dateline` int(11) DEFAULT '0',
  PRIMARY KEY (`shang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_shang_data
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_sms_log`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_sms_log`;
CREATE TABLE `xhl_sms_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(50) DEFAULT '',
  `content` varchar(255) DEFAULT '',
  `sms` varchar(20) DEFAULT '',
  `message` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `clientip` char(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70456 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_sms_log
-- ----------------------------
INSERT INTO `xhl_sms_log` VALUES ('70443', '18204718748', 'reg_mobile', 'eee1', '0,2018031911343682970927622,0,1,0,提交成功', '1', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70444', '18204718748', 'reg_mobile', 'eee1', '0,2018031911362287302829527,0,1,0,提交成功', '1', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70445', '18204718748', 'reg_mobile', 'eee1', '0,2018031911524419457502137,0,1,0,提交成功', '1', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70446', '18204718748', 'reg_mobile', 'eee1', '', '0', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70447', '18204718748', 'reg_mobile', 'eee1', '', '0', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70448', '18204718748', 'reg_mobile', 'eee1', '', '0', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70449', '18204718748', 'reg_mobile', 'eee1', '', '0', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70450', '18204718748', 'reg_mobile', 'eee1', '', '1', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70451', '18204718748', 'reg_mobile', 'eee1', '', '0', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70452', '18204718748', 'reg_mobile', 'eee1', '', '0', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70453', '18204718748', 'reg_mobile', 'eee1', '', '1', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70454', '15810988699', 'reg_mobile', 'eee1', '', '1', '', '0');
INSERT INTO `xhl_sms_log` VALUES ('70455', '15810988699', 'reg_mobile', 'eee1', '', '1', '', '0');

-- ----------------------------
-- Table structure for `xhl_system_config`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_system_config`;
CREATE TABLE `xhl_system_config` (
  `k` varchar(30) NOT NULL,
  `v` mediumtext,
  `title` varchar(30) DEFAULT '',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_system_config
-- ----------------------------
INSERT INTO `xhl_system_config` VALUES ('attach', 'a:20:{s:3:\"dir\";s:7:\"./files\";s:3:\"url\";s:7:\"./files\";s:10:\"allow_exts\";s:71:\"doc,docx,txt,pdf,rtf,xls,xlsx,ppt,pptx,zip,tar,rar,gif,jpg,png,jpeg,bmp\";s:10:\"allow_size\";s:6:\"204800\";s:13:\"watermarktype\";s:3:\"png\";s:13:\"watermarktext\";a:4:{s:4:\"font\";s:8:\"cyzt.ttf\";s:4:\"size\";s:2:\"14\";s:5:\"color\";s:7:\"#000000\";s:4:\"text\";s:7:\"@{name}\";}s:15:\"watermarkstatus\";s:1:\"5\";s:16:\"watermarkquality\";s:2:\"90\";s:12:\"thumbquality\";s:2:\"90\";s:5:\"thumb\";s:3:\"200\";s:4:\"site\";a:1:{s:5:\"photo\";s:3:\"200\";}s:6:\"youhui\";a:1:{s:5:\"photo\";s:7:\"428X200\";}s:5:\"diary\";a:1:{s:5:\"photo\";s:3:\"200\";}s:7:\"company\";a:2:{s:4:\"logo\";s:7:\"200X100\";s:5:\"thumb\";s:7:\"200X200\";}s:4:\"shop\";a:2:{s:4:\"logo\";s:7:\"200X100\";s:5:\"thumb\";s:7:\"200X200\";}s:8:\"homepics\";a:3:{s:5:\"photo\";s:3:\"250\";s:9:\"watermark\";s:1:\"1\";s:5:\"thumb\";s:3:\"200\";}s:9:\"chaophoto\";a:3:{s:5:\"photo\";s:9:\"2000X1200\";s:5:\"thumb\";s:8:\"1000X600\";s:5:\"small\";s:7:\"400X240\";}s:9:\"casephoto\";a:4:{s:5:\"photo\";s:4:\"2000\";s:9:\"watermark\";s:1:\"1\";s:5:\"thumb\";s:4:\"1500\";s:5:\"small\";s:7:\"400X240\";}s:7:\"product\";a:4:{s:5:\"photo\";s:3:\"720\";s:9:\"watermark\";s:1:\"1\";s:5:\"thumb\";s:3:\"200\";s:5:\"small\";s:5:\"60X60\";}s:6:\"editor\";a:2:{s:5:\"photo\";s:3:\"750\";s:5:\"thumb\";s:3:\"200\";}}', '附件设置', '1482830131');
INSERT INTO `xhl_system_config` VALUES ('booking', 'a:2:{s:8:\"max_look\";s:1:\"5\";s:9:\"look_gold\";s:3:\"200\";}', '预约设置', '1382086167');
INSERT INTO `xhl_system_config` VALUES ('bulletin', 'a:6:{s:9:\"open_site\";s:1:\"0\";s:4:\"site\";s:119:\"\r\n<a href=\"http://www.huisw.com/article/main/84.html\" target=\"_blank\">赶紧滴</a>\";s:11:\"open_member\";s:1:\"1\";s:6:\"member\";s:119:\"\r\n<a href=\"http://www.huisw.com/article/main/84.html\" target=\"_blank\">赶紧滴</a>\";s:12:\"open_company\";s:1:\"1\";s:7:\"company\";s:119:\"布\r\n<a href=\"http://www.huisw.com/article/main/84.html\" target=\"_blank\">赶紧滴</a>\";}', '公告管理', '1404116190');
INSERT INTO `xhl_system_config` VALUES ('config', 'a:2:{s:4:\"hash\";s:8360:\"6956424F5277304B47676F414141414E535568455567414141483041414141744341594141414344446D545341414141475852465748525462325A30643246795A5142425A4739695A53424A6257466E5A564A6C5957523563636C6C5041414141794270564668305745314D4F6D4E76625335685A4739695A53353462584141414141414144772F654842685932746C644342695A576470626A30693737752F496942705A443069567A564E4D4531775132566F61556836636D5654656B355559337072597A6C6B496A382B494478344F6E68746347316C6447456765473173626E4D366544306959575276596D5536626E4D366257563059533869494867366547317764477339496B466B62324A6C4946684E5543424462334A6C494455754D43316A4D445977494459784C6A457A4E4463334E7977674D6A41784D4338774D6938784D6930784E7A6F7A4D6A6F774D4341674943416749434167496A346750484A6B5A6A70535245596765473173626E4D36636D526D50534A6F644852774F693876643364334C6E637A4C6D39795A7938784F546B354C7A41794C7A49794C584A6B5A69317A6557353059586774626E4D6A496A346750484A6B5A6A70455A584E6A636D6C7764476C76626942795A47593659574A76645851394969496765473173626E4D366547317750534A6F644852774F693876626E4D7559575276596D5575593239744C336868634338784C6A41764969423462577875637A70346258424E545430696148523063446F764C32357A4C6D466B62324A6C4C6D4E7662533934595841764D5334774C3231744C79496765473173626E4D36633352535A575939496D6830644841364C793975637935685A4739695A53356A62323076654746774C7A45754D43397A56486C775A5339535A584E7664584A6A5A564A6C5A694D694948687463447044636D566864473979564739766244306951575276596D5567554768766447397A6147397749454E544E5342586157356B6233647A496942346258424E5454704A626E4E305957356A5A556C4550534A346258417561576C6B4F6B55334D3055784E5459354D4449314D7A457852544D344D554933516A46475154597A4D304E474E54597A496942346258424E5454704562324E316257567564456C4550534A34625841755A476C6B4F6B55334D3055784E545A424D4449314D7A457852544D344D554933516A46475154597A4D304E474E54597A496A3467504868746345314E4F6B526C636D6C325A575247636D397449484E30556D566D4F6D6C7563335268626D4E6C53555139496E687463433570615751365254637A525445314E6A63774D6A557A4D5446464D7A6778516A64434D555A424E6A4D7A513059314E6A4D6949484E30556D566D4F6D5276593356745A57353053555139496E68746343356B615751365254637A525445314E6A67774D6A557A4D5446464D7A6778516A64434D555A424E6A4D7A513059314E6A4D694C7A3467504339795A4759365247567A59334A70634852706232342B49447776636D526D4F6C4A45526A3467504339344F6E68746347316C6447452B4944772F654842685932746C6443426C626D5139496E4969507A3637555966634141414973306C455156523432757963435778555652534737394253704341574B6367715167566B4559774C6771675246526663514E77696F6B614A476F4F4345414B4B454E53344C776949714B43345339474943305A6C55304645525648454254634552634343624E307330426E50795879547555376554476435725A33704F386B665A715A33376E74392F7A336E2F4F666357337942514D4234567265736E766349504E493971774F5737665468707930364C704A2F7567744B424B483466364267676D424F457466704C356774714C546D79784E4D45647A482B317A42564D4641727175574A64677347437A34323658662B5148426C594C6476506478543663497471517A6D58324B316964504F6F53336376673850386E37306539316450693870665736767143396F4858456D4F61434269343946795734726541515946754475754C7030634C376E69696637302F794F6E756A6646345A4D66632B687A4737557268757041556972686B7966355450367854705070657645306A524F394D3566576F61797947534A4B4B686369496963564E425A794B692B7A6E64737971745144444D656E34484343714961493073687970414F3477426D6C71755A6B777246725366434A654E686A466F69387346707775755A5137564F6A634A7A6955715855737139494F66304530653664566B536C4B7834414C4262344C56676D50514A4F3944666E394536445245714936355158417933766F59337277586B56784247744D46385A54674C6347744546384D3259634C68677132436B594B31676932735A412B396B69765874744346644F485A2F6763336A684F734A44586C776B32436A62786E666459454630456379464E506251584663564D5153454C5142665348337A6E43464A45415A4867524261514C6F345A6771386850653677373547656E4A306D6D43676F6F3953635473376542664768614B4135654A35674F4A4667752B424651536D457170587A37317242523959312B754C397A374D414E4C5350596E354E4854634B7A684A305A66772F48756E56613430463751526E514C6147315256346279346575524E767635586E6E45756531716A776854565845367350596C734A65587768704A636A695064772F517036437A7572714A4138306C32796475545338594B444254305156354E3570714671705A6D675348437334485842434D4751434E49445553716364594950436576614E376D436E6F55756F70645A57453879626F6B6C4944335371386D576B713956694E30702B453777454747335067547551356A5651316D586F514F614A4341575A3050305145546934344B4C5341586C7A4E553030624C59497A303557774D47556A6239535A342F694964665A676D725279444A494D4B557141666A764D346F7776347977537242766554362B6F542F3639415242703251556E5047733672744A4254336C3552515778427068586A34554A523371655667787A4457746C416E30422F78755771464671687A5031476C6B516E7646655251447437442B4E784D496A3151432B63376E5470374A74366D684A354E6E6A3059676155352F427A4272337A6E65484C384E31616E7271455645587A776B516668756C665267667A7649304963537268767866632B45587A5039373253725970636D597070447531484C746664794A6155583770622B424C50564A73793879476E495648675849685A5338672F6A43695154376C316965426F76486B444B554A562B6C6551337078726170672F4370337743796B6A4951644F42394C56632B36694A4D6C4B5952342F586E35696976657A682F745251716579434A5338682F464B62636B6542346B5863392B6643546F4A6E6F5845504479336B6B553446652F4F73577075726345585543573853636374744F6855775539423155394135622B61536151334A6F54574671753069486D47686F7432335971744D51735164666C34614448452F5955487678584864565A796A5A416D4B4C49453233693067597249735A527432377A775876326D2F66546C4D58362B472F7961355078626F337865616932457A53416838306833787A547474454773395351482B2F432B5A6554666B67546E31507A666D547A666C66546B4939392F79707756796478734F704475783674533356635057436F3478385837302F7738686B35625163546341547A324D334C77736A6A6E624D2B633535746739363965784A792F6D324158376C4772423542527043766877784651716478764A62684E634B5A4C3936596B7A7A4C42625653316E386E6E4A64787244387137515361344933647A48494A4C782B6E57367047385830325673426552714C582B71594A7271434B4757794976593067764A357756755454664D4A666D3055375A45784375432F4A75453978523232434E30584B744E2B57636B6A6B643062637978694A365774414E62353473654463697636757748574343323746643642634D5355513770454E7A7875336A556765344E4D38497646684C726B6D51734D46687758364556796F706568687A5A49773578304C344473624E635242304A66514164477456643968363862706A4A70466547303037613166772B6732384C5A62394948694E31307071573463783355674461724F5A4E35597449712B7261542F2B6C4E6F57336E305A527271325634394149377874346A744A4F34327846535A38357436327755534362656943654777636A5A31792B675731697653444D6F7A30546B544A55506B556A315656552F65306F734B33636336354869526B4E5258656D325559366145393742304F6554775A613244432B2B786254666730544C5659545A462B574977794B74314D6857432B31554E77347738783871786F754C2B3666344761494C304A3559715437557044306A556E6C3771735638704E2B49436B79515453727A6242566D4B6B3653624539326C49656F4377486C7251725632596334384A2F796D5A6274446B70697670326F3638586E4248464D476F4175547A4E4D3370577932437569547776577A6746423143352B50316F455337424B71696248697339332B51376D4F46366731664B486A424250764E655648477A7A644A37424456456C744F616455306766705939396631464B73656F476A7638504F6C704137645A446B687A6A6E314C487768356542464E5647797153635070337A52666439474E42303649647761782F6975486A61596C51626B617175314F7753764E2B476A567039547170316E676D31645863437234346836326A50586B374F5448635973354764484D3361523566314F316F5A783274545263335172616F4A304C544F754D73486563694B6D44334253476E693552693039665871704352353348686E7859505641596A385450707173326D56646C416734326F6F494C31716177445956682F634C586A48424C567074757478676E413948364C314E685042396647392B545A44754E346B664D7452636549734A62694C556468764751382B69524E4E652B306F54507257716E71363938686D51744A685157326A436634335346636359514370645243694F5A7270686F7A747A453069522B6C722F4975596436376F614366516B55562F65617871646D3867766C6831446F6361725A4F4E644942712B376A54526435685376556171696A7A534F70762F6E736C7235694441394C6855475637664159386537544458667367627A2F6859707566766444763564753768627542552F6378454B42733353473855682F4372536A4671324E6B4F79664D67665763566F6A4972536A5045546348704E466557772B63616A6654736575692F4B666B71536A4E704C6C36764278354F516F5346446C4C6F6D6267503850444663524165656D355447542B492B5871623843455131526136632F63323139336E46756D62574E6E466C68646F54567269554B2B57574D304B502B383349745A556B61364B73776E6A5A373479457A356B4744704F3747626E626A6371655A655663774D4F6E62416C654A76757076316F676E766830577744595675397552574C794D647A325779534F39623048564165576C7233716F35545A4649347975337A2F765041756D666566727048756D6365365A356C705030727741444766685A7833374E41374141414141424A52553545726B4A6767673D3D\";s:4:\"host\";s:132:\"687474703A2F2F77777725732E696A682E63632F696E6465782E7068703F63746C3D6C697374656E26686F73743D2573266B65793D25732676657273696F6E3D2573\";}', '系统设置', null);
INSERT INTO `xhl_system_config` VALUES ('mail', 'a:4:{s:6:\"sender\";s:19:\"jisunet_com@126.com\";s:4:\"mode\";s:4:\"smtp\";s:4:\"smtp\";a:4:{s:4:\"host\";s:19:\"jisunet_com@126.com\";s:4:\"port\";s:2:\"25\";s:5:\"uname\";s:19:\"jisunet_com@126.com\";s:6:\"passwd\";s:11:\"huaxingli@#\";}s:5:\"email\";s:19:\"jisunet_com@126.com\";}', '邮件设置', '1440144174');
INSERT INTO `xhl_system_config` VALUES ('site', 'a:19:{s:5:\"title\";s:0:\"\";s:7:\"siteurl\";s:22:\"http://www.wordhuo.com\";s:6:\"secret\";s:0:\"\";s:4:\"mail\";s:10:\"123@qq.com\";s:4:\"kfqq\";s:7:\"1234123\";s:5:\"phone\";s:0:\"\";s:4:\"logo\";s:0:\"\";s:8:\"weixinqr\";s:0:\"\";s:6:\"mobile\";s:1:\"0\";s:7:\"ucenter\";s:1:\"0\";s:7:\"xiangmu\";s:1:\"0\";s:7:\"project\";s:1:\"0\";s:7:\"city_id\";s:2:\"40\";s:10:\"multi_city\";s:1:\"1\";s:6:\"domain\";s:0:\"\";s:7:\"rewrite\";s:1:\"0\";s:5:\"intro\";s:0:\"\";s:6:\"tongji\";s:0:\"\";s:3:\"icp\";s:0:\"\";}', '基本设置', '1529053811');
INSERT INTO `xhl_system_config` VALUES ('sms', 'a:7:{s:10:\"show_error\";s:1:\"1\";s:5:\"comid\";s:2:\"70\";s:9:\"smsnumber\";s:4:\"1000\";s:8:\"qianming\";s:9:\"一路展\";s:5:\"uname\";s:11:\"13466689622\";s:6:\"passwd\";s:28:\"C74502E73261254CEB11016DC233\";s:6:\"mobile\";s:11:\"13466649862\";}', '短信设置', '1450428368');
INSERT INTO `xhl_system_config` VALUES ('connect', 'a:6:{s:10:\"qq_is_open\";s:1:\"1\";s:9:\"qq_app_id\";s:9:\"101308221\";s:10:\"qq_app_key\";s:32:\"1d4083c769c55f135d00d6d76afd038b\";s:13:\"weibo_is_open\";s:1:\"0\";s:12:\"weibo_app_id\";s:0:\"\";s:13:\"weibo_app_key\";s:0:\"\";}', '账号互联', '1461742557');
INSERT INTO `xhl_system_config` VALUES ('site_config', 'a:2:{s:4:\"hash\";s:8360:\"6956424F5277304B47676F414141414E535568455567414141483041414141744341594141414344446D545341414141475852465748525462325A30643246795A5142425A4739695A53424A6257466E5A564A6C5957523563636C6C5041414141794270564668305745314D4F6D4E76625335685A4739695A53353462584141414141414144772F654842685932746C644342695A576470626A30693737752F496942705A443069567A564E4D4531775132566F61556836636D5654656B355559337072597A6C6B496A382B494478344F6E68746347316C6447456765473173626E4D366544306959575276596D5536626E4D366257563059533869494867366547317764477339496B466B62324A6C4946684E5543424462334A6C494455754D43316A4D445977494459784C6A457A4E4463334E7977674D6A41784D4338774D6938784D6930784E7A6F7A4D6A6F774D4341674943416749434167496A346750484A6B5A6A70535245596765473173626E4D36636D526D50534A6F644852774F693876643364334C6E637A4C6D39795A7938784F546B354C7A41794C7A49794C584A6B5A69317A6557353059586774626E4D6A496A346750484A6B5A6A70455A584E6A636D6C7764476C76626942795A47593659574A76645851394969496765473173626E4D366547317750534A6F644852774F693876626E4D7559575276596D5575593239744C336868634338784C6A41764969423462577875637A70346258424E545430696148523063446F764C32357A4C6D466B62324A6C4C6D4E7662533934595841764D5334774C3231744C79496765473173626E4D36633352535A575939496D6830644841364C793975637935685A4739695A53356A62323076654746774C7A45754D43397A56486C775A5339535A584E7664584A6A5A564A6C5A694D694948687463447044636D566864473979564739766244306951575276596D5567554768766447397A6147397749454E544E5342586157356B6233647A496942346258424E5454704A626E4E305957356A5A556C4550534A346258417561576C6B4F6B55334D3055784E5459354D4449314D7A457852544D344D554933516A46475154597A4D304E474E54597A496942346258424E5454704562324E316257567564456C4550534A34625841755A476C6B4F6B55334D3055784E545A424D4449314D7A457852544D344D554933516A46475154597A4D304E474E54597A496A3467504868746345314E4F6B526C636D6C325A575247636D397449484E30556D566D4F6D6C7563335268626D4E6C53555139496E687463433570615751365254637A525445314E6A63774D6A557A4D5446464D7A6778516A64434D555A424E6A4D7A513059314E6A4D6949484E30556D566D4F6D5276593356745A57353053555139496E68746343356B615751365254637A525445314E6A67774D6A557A4D5446464D7A6778516A64434D555A424E6A4D7A513059314E6A4D694C7A3467504339795A4759365247567A59334A70634852706232342B49447776636D526D4F6C4A45526A3467504339344F6E68746347316C6447452B4944772F654842685932746C6443426C626D5139496E4969507A3637555966634141414973306C455156523432757963435778555652534737394253704341574B6367715167566B4559774C6771675246526663514E77696F6B614A476F4F4345414B4B454E53344C776949714B43345339474943305A6C55304645525648454254634552634343624E307330426E50795879547555376554476435725A33704F386B665A715A33376E74392F7A336E2F4F666357337942514D4234567265736E766349504E493971774F5737665468707930364C704A2F7567744B424B483466364267676D424F457466704C356774714C546D79784E4D45647A482B317A42564D4641727175574A64677347437A34323658662B5148426C594C6476506478543663497471517A6D58324B316964504F6F53336376673850386E37306539316450693870665736767143396F4858456D4F61434269343946795734726541515946754475754C7030634C376E69696637302F794F6E756A6646345A4D66632B687A4737557268757041556972686B7966355450367854705070657645306A524F394D3566576F61797947534A4B4B686369496963564E425A794B692B7A6E64737971745144444D656E34484343714961493073687970414F3477426D6C71755A6B777246725366434A654E686A466F69387346707775755A5137564F6A634A7A6955715855737139494F66304530653664566B536C4B7834414C4262344C56676D50514A4F3944666E394536445245714936355158417933766F59337277586B56784247744D46385A54674C6347744546384D3259634C68677132436B594B31676932735A412B396B69765874744346644F485A2F6763336A684F734A44586C776B32436A62786E666459454630456379464E506251584663564D5153454C5142665348337A6E43464A45415A4867524261514C6F345A6771386850653677373547656E4A306D6D43676F6F3953635473376542664768614B4135654A35674F4A4667752B424651536D457170587A37317242523959312B754C397A374D414E4C5350596E354E4854634B7A684A305A66772F48756E56613430463751526E514C6147315256346279346575524E767635586E6E45756531716A776854565845367350596C734A65587768704A636A695064772F517036437A7572714A4138306C32796475545338594B444254305156354E3570714671705A6D675348437334485842434D4751434E49445553716364594950436576614E376D436E6F55756F70645A57453879626F6B6C4944335371386D576B713956694E30702B453777454747335067547551356A5651316D586F514F614A4341575A3050305145546934344B4C5341586C7A4E553030624C59497A303557774D47556A6239535A342F694964665A676D725279444A494D4B557141666A764D346F7776347977537242766554362B6F542F3639415242703251556E5047733672744A4254336C3552515778427068586A34554A523371655667787A4457746C416E30422F78755771464671687A5031476C6B516E7646655251447437442B4E784D496A3151432B63376E5470374A74366D684A354E6E6A3059676155352F427A4272337A6E65484C384E31616E7271455645587A776B516668756C665267667A7649304963537268767866632B45587A5039373253725970636D597070447531484C746664794A6155583770622B424C50564A73793879476E495648675849685A5338672F6A43695154376C316965426F76486B444B554A562B6C6551337078726170672F4370337743796B6A4951644F42394C56632B36694A4D6C4B5952342F586E35696976657A682F745251716579434A5338682F464B62636B6542346B5863392B6643546F4A6E6F5845504479336B6B553446652F4F73577075726345585543573853636374744F6855775539423155394135622B61536151334A6F54574671753069486D47686F7432335971744D51735164666C34614448452F5955487678584864565A796A5A416D4B4C49453233693067597249735A527432377A775876326D2F66546C4D58362B472F7961355078626F337865616932457A53416838306833787A547474454773395351482B2F432B5A6554666B67546E31507A666D547A666C66546B4939392F79707756796478734F704475783674533356635057436F3478385837302F7738686B35625163546341547A324D334C77736A6A6E624D2B633535746739363965784A792F6D324158376C4772423542527043766877784651716478764A62684E634B5A4C3936596B7A7A4C42625653316E386E6E4A64787244387137515361344933647A48494A4C782B6E57367047385830325673426552714C582B71594A7271434B4757794976593067764A357756755454664D4A666D3055375A45784375432F4A75453978523232434E30584B744E2B57636B6A6B643062637978694A365774414E62353473654463697636757748574343323746643642634D5355513770454E7A7875336A556765344E4D38497646684C726B6D51734D46687758364556796F706568687A5A49773578304C344473624E635242304A66514164477456643968363862706A4A70466547303037613166772B6732384C5A62394948694E31307071573463783355674461724F5A4E35597449712B7261542F2B6C4E6F57336E305A527271325634394149377874346A744A4F34327846535A38357436327755534362656943654777636A5A31792B675731697653444D6F7A30546B544A55506B556A315656552F65306F734B33636336354869526B4E5258656D325559366145393742304F6554775A613244432B2B786254666730544C5659545A462B574977794B74314D6857432B31554E77347738783871786F754C2B3666344761494C304A3559715437557044306A556E6C3771735638704E2B49436B79515453727A6242566D4B6B3653624539326C49656F4377486C7251725632596334384A2F796D5A6274446B70697670326F3638586E4248464D476F4175547A4E4D3370577932437569547776577A6746423143352B50316F455337424B71696248697339332B51376D4F46366731664B486A424250764E655648477A7A644A37424456456C744F616455306766705939396631464B73656F476A7638504F6C704137645A446B687A6A6E314C487768356542464E5647797153635070337A52666439474E42303649647761782F6975486A61596C51626B617175314F7753764E2B476A567039547170316E676D31645863437234346836326A50586B374F5448635973354764484D3361523566314F316F5A783274545263335172616F4A304C544F754D73486563694B6D44334253476E693552693039665871704352353348686E7859505641596A385450707173326D56646C416734326F6F494C31716177445956682F634C586A48424C567074757478676E413948364C314E685042396647392B545A44754E346B664D7452636549734A62694C556468764751382B69524E4E652B306F54507257716E71363938686D51744A685157326A436634335346636359514370645243694F5A7270686F7A747A453069522B6C722F4975596436376F614366516B55562F65617871646D3867766C6831446F6361725A4F4E644942712B376A54526435685376556171696A7A534F70762F6E736C7235694441394C6855475637664159386537544458667367627A2F6859707566766444763564753768627542552F6378454B42733353473855682F4372536A4671324E6B4F79664D67665763566F6A4972536A5045546348704E466557772B63616A6654736575692F4B666B71536A4E704C6C36764278354F516F5346446C4C6F6D6267503850444663524165656D355447542B492B5871623843455131526136632F63323139336E46756D62574E6E466C68646F54567269554B2B57574D304B502B383349745A556B61364B73776E6A5A373479457A356B4744704F3747626E626A6371655A655663774D4F6E62416C654A76757076316F676E766830577744595675397552574C794D647A325779534F39623048564165576C7233716F35545A4649347975337A2F765041756D666566727048756D6365365A356C705030727741444766685A7833374E41374141414141424A52553545726B4A6767673D3D\";s:4:\"host\";s:114:\"687474703A2F2F7777772E696A682E63632F696E6465782E7068703F63746C3D6D6F6E69746F72696E6726686F73743D2573266B65793D2573\";}', '配置设置', '1389324222');
INSERT INTO `xhl_system_config` VALUES ('locoyspider', 'a:3:{s:9:\"Authorize\";s:14:\"XFxDEZpbGb21tm\";s:9:\"Autothumb\";s:1:\"1\";s:9:\"Loadimage\";s:1:\"1\";}', '火车头采集', '1403262374');
INSERT INTO `xhl_system_config` VALUES ('score', 'a:3:{s:7:\"company\";a:5:{s:6:\"score1\";s:6:\"服务\";s:6:\"score2\";s:6:\"价格\";s:6:\"score3\";s:6:\"设计\";s:6:\"score4\";s:6:\"施工\";s:6:\"score5\";s:6:\"售后\";}s:8:\"designer\";a:3:{s:6:\"score1\";s:6:\"设计\";s:6:\"score2\";s:6:\"服务\";s:6:\"score3\";s:6:\"贴心\";}s:2:\"gz\";a:3:{s:6:\"score1\";s:6:\"施工\";s:6:\"score2\";s:6:\"服务\";s:6:\"score3\";s:6:\"贴心\";}}', '评论配置', '1414511280');
INSERT INTO `xhl_system_config` VALUES ('integral', 'a:12:{s:4:\"case\";s:1:\"1\";s:4:\"site\";s:1:\"1\";s:3:\"ask\";s:1:\"1\";s:6:\"answer\";s:1:\"1\";s:6:\"youhui\";s:3:\"-10\";s:6:\"coupon\";s:3:\"-10\";s:13:\"certification\";s:2:\"10\";s:7:\"product\";s:1:\"1\";s:5:\"email\";s:2:\"10\";s:6:\"mobile\";s:2:\"10\";s:5:\"diary\";s:1:\"1\";s:4:\"news\";s:1:\"1\";}', '积分设置', '1419235218');
INSERT INTO `xhl_system_config` VALUES ('audit', 'a:92:{s:12:\"ask_member_N\";s:1:\"1\";s:12:\"ask_member_Y\";s:1:\"1\";s:15:\"answer_member_N\";s:1:\"1\";s:15:\"answer_member_Y\";s:1:\"1\";s:14:\"diary_member_N\";s:1:\"0\";s:14:\"diary_member_Y\";s:1:\"1\";s:17:\"dianping_member_N\";s:1:\"0\";s:17:\"dianping_member_Y\";s:1:\"1\";s:20:\"caseComment_member_N\";s:1:\"0\";s:20:\"caseComment_member_Y\";s:1:\"1\";s:21:\"diaryComment_member_N\";s:1:\"0\";s:21:\"diaryComment_member_Y\";s:1:\"1\";s:23:\"productComment_member_N\";s:1:\"1\";s:23:\"productComment_member_Y\";s:1:\"1\";s:20:\"shopComment_member_N\";s:1:\"1\";s:20:\"shopComment_member_Y\";s:1:\"1\";s:13:\"ask_company_N\";s:1:\"1\";s:13:\"ask_company_Y\";s:1:\"1\";s:13:\"ask_company_V\";s:1:\"1\";s:16:\"answer_company_N\";s:1:\"1\";s:16:\"answer_company_Y\";s:1:\"1\";s:16:\"answer_company_V\";s:1:\"1\";s:15:\"diary_company_N\";s:1:\"0\";s:15:\"diary_company_Y\";s:1:\"1\";s:15:\"diary_company_V\";s:1:\"1\";s:14:\"case_company_N\";s:2:\"-1\";s:14:\"case_company_Y\";s:1:\"0\";s:14:\"case_company_V\";s:1:\"1\";s:14:\"site_company_N\";s:2:\"-1\";s:14:\"site_company_Y\";s:1:\"0\";s:14:\"site_company_V\";s:1:\"1\";s:16:\"youhui_company_N\";s:2:\"-1\";s:16:\"youhui_company_Y\";s:1:\"0\";s:16:\"youhui_company_V\";s:1:\"1\";s:14:\"news_company_N\";s:1:\"0\";s:14:\"news_company_Y\";s:1:\"0\";s:14:\"news_company_V\";s:1:\"1\";s:21:\"caseComment_company_N\";s:1:\"0\";s:21:\"caseComment_company_Y\";s:1:\"1\";s:21:\"caseComment_company_V\";s:1:\"1\";s:22:\"diaryComment_company_N\";s:1:\"0\";s:22:\"diaryComment_company_Y\";s:1:\"0\";s:22:\"diaryComment_company_V\";s:1:\"1\";s:24:\"productComment_company_N\";s:1:\"0\";s:24:\"productComment_company_Y\";s:1:\"0\";s:24:\"productComment_company_V\";s:1:\"0\";s:21:\"shopComment_company_N\";s:1:\"0\";s:21:\"shopComment_company_Y\";s:1:\"0\";s:21:\"shopComment_company_V\";s:1:\"0\";s:14:\"ask_designer_N\";s:1:\"1\";s:14:\"ask_designer_Y\";s:1:\"1\";s:17:\"answer_designer_N\";s:1:\"1\";s:17:\"answer_designer_Y\";s:1:\"1\";s:16:\"diary_designer_N\";s:1:\"0\";s:16:\"diary_designer_Y\";s:1:\"1\";s:15:\"case_designer_N\";s:1:\"0\";s:15:\"case_designer_Y\";s:1:\"1\";s:22:\"caseComment_designer_N\";s:1:\"0\";s:22:\"caseComment_designer_Y\";s:1:\"1\";s:23:\"diaryComment_designer_N\";s:1:\"0\";s:23:\"diaryComment_designer_Y\";s:1:\"1\";s:25:\"productComment_designer_N\";s:1:\"0\";s:25:\"productComment_designer_Y\";s:1:\"0\";s:22:\"shopComment_designer_N\";s:1:\"0\";s:22:\"shopComment_designer_Y\";s:1:\"0\";s:14:\"product_shop_N\";s:1:\"0\";s:14:\"product_shop_Y\";s:1:\"0\";s:14:\"product_shop_V\";s:1:\"0\";s:11:\"news_shop_N\";s:1:\"0\";s:11:\"news_shop_Y\";s:1:\"0\";s:11:\"news_shop_V\";s:1:\"0\";s:13:\"coupon_shop_N\";s:1:\"0\";s:13:\"coupon_shop_Y\";s:1:\"0\";s:13:\"coupon_shop_V\";s:1:\"0\";s:10:\"ask_shop_N\";s:1:\"1\";s:10:\"ask_shop_Y\";s:1:\"1\";s:10:\"ask_shop_V\";s:1:\"1\";s:13:\"answer_shop_N\";s:1:\"1\";s:13:\"answer_shop_Y\";s:1:\"1\";s:13:\"answer_shop_V\";s:1:\"1\";s:18:\"caseComment_shop_N\";s:1:\"0\";s:18:\"caseComment_shop_Y\";s:1:\"0\";s:18:\"caseComment_shop_V\";s:1:\"1\";s:19:\"diaryComment_shop_N\";s:1:\"0\";s:19:\"diaryComment_shop_Y\";s:1:\"0\";s:19:\"diaryComment_shop_V\";s:1:\"1\";s:21:\"productComment_shop_N\";s:1:\"0\";s:21:\"productComment_shop_Y\";s:1:\"0\";s:21:\"productComment_shop_V\";s:1:\"0\";s:18:\"shopComment_shop_N\";s:1:\"1\";s:18:\"shopComment_shop_Y\";s:1:\"0\";s:18:\"shopComment_shop_V\";s:1:\"0\";}', '审核权限', '1404981160');
INSERT INTO `xhl_system_config` VALUES ('mobile', 'a:5:{s:5:\"title\";s:27:\"参展平台系统手机版\";s:3:\"url\";s:0:\"\";s:7:\"forward\";s:1:\"0\";s:12:\"down_android\";s:0:\"\";s:11:\"down_iphone\";s:0:\"\";}', '3G版设置', '1502877315');
INSERT INTO `xhl_system_config` VALUES ('gold', 'a:4:{s:4:\"open\";s:1:\"1\";s:5:\"onpay\";s:1:\"1\";s:5:\"huilv\";s:1:\"1\";s:6:\"minpay\";s:1:\"1\";}', '金币设置', '1419061736');
INSERT INTO `xhl_system_config` VALUES ('shop_rank', 'a:20:{s:6:\"rank_1\";s:1:\"1\";s:6:\"rank_2\";s:1:\"2\";s:6:\"rank_3\";s:1:\"3\";s:6:\"rank_4\";s:1:\"4\";s:6:\"rank_5\";s:1:\"5\";s:6:\"rank_6\";s:2:\"10\";s:6:\"rank_7\";s:2:\"20\";s:6:\"rank_8\";s:2:\"30\";s:6:\"rank_9\";s:2:\"40\";s:7:\"rank_10\";s:2:\"50\";s:7:\"rank_11\";s:3:\"100\";s:7:\"rank_12\";s:3:\"200\";s:7:\"rank_13\";s:3:\"300\";s:7:\"rank_14\";s:3:\"400\";s:7:\"rank_15\";s:3:\"500\";s:7:\"rank_16\";s:4:\"1000\";s:7:\"rank_17\";s:4:\"2000\";s:7:\"rank_18\";s:4:\"3000\";s:7:\"rank_19\";s:4:\"4000\";s:7:\"rank_20\";s:4:\"5000\";}', '诚信规则', '1388470066');
INSERT INTO `xhl_system_config` VALUES ('access', 'a:12:{s:11:\"signup_type\";a:1:{s:4:\"shop\";s:4:\"shop\";}s:12:\"signup_count\";s:1:\"0\";s:11:\"signup_time\";s:1:\"0\";s:12:\"retain_uname\";s:0:\"\";s:6:\"denyip\";s:0:\"\";s:12:\"mobile_count\";s:2:\"10\";s:11:\"mobile_time\";s:2:\"10\";s:12:\"tender_count\";s:5:\"10000\";s:11:\"tender_time\";s:1:\"0\";s:10:\"verifycode\";a:4:{s:6:\"signup\";s:6:\"signup\";s:5:\"login\";s:5:\"login\";s:5:\"yuyue\";s:5:\"yuyue\";s:7:\"comment\";s:7:\"comment\";}s:6:\"closed\";s:1:\"0\";s:13:\"closed_reason\";s:0:\"\";}', '访问设置', '1493085241');
INSERT INTO `xhl_system_config` VALUES ('comment', 'a:4:{s:12:\"article_type\";s:7:\"comment\";s:9:\"case_type\";s:7:\"comment\";s:10:\"diary_type\";s:7:\"comment\";s:10:\"snscomment\";s:597:\"<script type=\"text/javascript\">\r\n(function(){\r\nvar url = \"http://widget.weibo.com/distribution/comments.php?width=0&url=auto&border=1&brandline=y&dpc=1\";\r\nurl = url.replace(\"url=auto\", \"url=\" + encodeURIComponent(document.URL)); \r\ndocument.write(\'<iframe id=\"WBCommentFrame\" src=\"\' + url + \'\" scrolling=\"no\" frameborder=\"0\" style=\"width:100%\"></iframe>\');\r\n})();\r\n</script>\r\n<script src=\"http://tjs.sjs.sinajs.cn/open/widget/js/widget/comment.js\" type=\"text/javascript\" charset=\"utf-8\"></script>\r\n<script type=\"text/javascript\">\r\nwindow.WBComment.init({\r\n    \"id\": \"WBCommentFrame\"\r\n});\r\n</script>\";}', '评论设置', '1420012656');
INSERT INTO `xhl_system_config` VALUES ('routeurl', 'a:19:{s:10:\"route_type\";s:1:\"1\";s:7:\"tenders\";s:7:\"canzhan\";s:2:\"gs\";s:9:\"gongchang\";s:8:\"designer\";s:8:\"shejishi\";s:8:\"mechanic\";s:0:\"\";s:4:\"home\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"ask\";s:0:\"\";s:5:\"diray\";s:0:\"\";s:6:\"youhui\";s:0:\"\";s:8:\"activity\";s:0:\"\";s:7:\"article\";s:7:\"xuetang\";s:4:\"news\";s:0:\"\";s:10:\"mall/store\";s:0:\"\";s:7:\"product\";s:0:\"\";s:4:\"case\";s:4:\"anli\";s:4:\"blog\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"mall/shop\";s:0:\"\";}', 'URL设置', '1439886322');
INSERT INTO `xhl_system_config` VALUES ('domain', 'a:6:{s:4:\"case\";s:19:\"anli.jisunet.com\";s:7:\"article\";s:22:\"xuetang.jisunet.com\";s:4:\"home\";s:21:\"xiaoqu.jisunet.com\";s:3:\"ask\";s:18:\"ask.jisunet.com\";s:4:\"mall\";s:19:\"shop.jisunet.com\";s:7:\"product\";s:19:\"shop.jisunet.com\";}', '域名设置', '1436929802');
INSERT INTO `xhl_system_config` VALUES ('wechat', 'a:4:{s:12:\"wechat_token\";s:3:\"123\";s:10:\"robot_open\";s:1:\"1\";s:10:\"tuling_key\";s:32:\"1fc91a84759da32183c0ffcdbd4ce45a\";s:10:\"rand_reply\";s:128:\"我今天累了，明天再陪你聊天吧\r\n哈哈~~\r\n你话好多啊，不跟你聊了\r\n虽然不懂，但觉得你说得很对\";}', '微信配置', '1420420894');

-- ----------------------------
-- Table structure for `xhl_system_module`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_system_module`;
CREATE TABLE `xhl_system_module` (
  `mod_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `module` enum('top','menu','module') DEFAULT 'module',
  `level` tinyint(1) DEFAULT '3',
  `ctl` varchar(20) DEFAULT '',
  `act` varchar(20) DEFAULT '',
  `title` varchar(20) DEFAULT '',
  `visible` tinyint(1) DEFAULT '1',
  `parent_id` smallint(6) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`mod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1450 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_system_module
-- ----------------------------
INSERT INTO `xhl_system_module` VALUES ('1', 'top', '1', '', '', '网站设置', '1', '0', '90', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('5', 'top', '1', '', '', '内容管理', '1', '0', '60', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('6', 'menu', '2', '', '', '权限管理', '1', '1', '60', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('7', 'menu', '2', '', '', '系统模块', '1', '1', '60', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('8', 'module', '3', 'module/menu', 'index', '导航菜单管理', '1', '7', '1', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('9', 'module', '3', 'module/ctl', 'index', '控制模型管理', '1', '7', '11', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('26', 'module', '3', 'module/menu', 'create', '添加导航菜单', '0', '7', '2', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('27', 'module', '3', 'module/menu', 'save', '保存导航菜单', '0', '7', '6', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('28', 'module', '3', 'module/menu', 'edit', '编辑导航菜单', '0', '7', '3', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('31', 'module', '3', 'module/ctl', 'batch', '指量添加控制模块', '0', '7', '13', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('32', 'module', '3', 'module/ctl', 'save', '保存控制模块', '0', '7', '14', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('33', 'module', '3', 'module/ctl', 'detail', '管理控制模型', '0', '7', '12', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('35', 'module', '3', 'module/menu', 'update', '更新导航菜单', '0', '7', '4', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('37', 'module', '3', 'module/ctl', 'remove', '删除控制模块', '0', '7', '15', '1356434427');
INSERT INTO `xhl_system_module` VALUES ('44', 'module', '3', 'module/menu', 'remove', '删除导航菜单', '0', '7', '5', '1356437401');
INSERT INTO `xhl_system_module` VALUES ('48', 'module', '3', 'admin/role', 'index', '角色管理', '1', '6', '1', '1356437591');
INSERT INTO `xhl_system_module` VALUES ('49', 'module', '3', 'admin/admin', 'index', '管理员管理', '1', '6', '2', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('50', 'module', '3', 'admin/role', 'create', '创建角色', '0', '6', '50', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('51', 'module', '3', 'admin/role', 'detail', '管理角色', '0', '6', '50', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('52', 'module', '3', 'admin/role', 'save', '保存角色', '0', '6', '50', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('53', 'module', '3', 'admin/role', 'delete', '删除角色', '0', '6', '50', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('54', 'module', '3', 'admin/admin', 'create', '创建管理员', '0', '6', '50', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('55', 'module', '3', 'admin/admin', 'edit', '修改管理员', '0', '6', '50', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('56', 'module', '3', 'admin/admin', 'save', '保存管理员', '0', '6', '50', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('57', 'module', '3', 'admin/admin', 'delete', '删除管理员', '0', '6', '50', '1356437975');
INSERT INTO `xhl_system_module` VALUES ('1425', 'menu', '2', '', '', '梦想管理', '1', '5', '50', '1493030686');
INSERT INTO `xhl_system_module` VALUES ('68', 'menu', '2', '', '', '广告管理', '1', '5', '10', '1356513698');
INSERT INTO `xhl_system_module` VALUES ('69', 'menu', '2', '', '', '内容推荐', '1', '5', '5', '1356513708');
INSERT INTO `xhl_system_module` VALUES ('70', 'menu', '2', '', '', '基础数据', '1', '1', '6', '1356513719');
INSERT INTO `xhl_system_module` VALUES ('71', 'top', '1', '', '', '会员管理', '1', '0', '20', '1356513738');
INSERT INTO `xhl_system_module` VALUES ('72', 'menu', '2', '', '', '会员管理', '1', '71', '1', '1356513776');
INSERT INTO `xhl_system_module` VALUES ('85', 'menu', '2', '', '', '文章管理', '1', '5', '20', '1356600322');
INSERT INTO `xhl_system_module` VALUES ('113', 'module', '3', 'adv/adv', 'index', '广告位管理', '1', '68', '50', '1357460157');
INSERT INTO `xhl_system_module` VALUES ('114', 'module', '3', 'adv/adv', 'detail', '管理广告位', '0', '68', '50', '1357460260');
INSERT INTO `xhl_system_module` VALUES ('115', 'module', '3', 'adv/adv', 'edit', '编辑广告位', '0', '68', '50', '1357460260');
INSERT INTO `xhl_system_module` VALUES ('116', 'module', '3', 'adv/adv', 'create', '创建广告位', '1', '68', '50', '1357460260');
INSERT INTO `xhl_system_module` VALUES ('117', 'module', '3', 'adv/adv', 'delete', '删除广告位', '0', '68', '50', '1357460260');
INSERT INTO `xhl_system_module` VALUES ('119', 'module', '3', 'adv/item', 'create', '添加广告', '0', '68', '50', '1357460574');
INSERT INTO `xhl_system_module` VALUES ('120', 'module', '3', 'adv/item', 'edit', '修改广告', '0', '68', '50', '1357460574');
INSERT INTO `xhl_system_module` VALUES ('122', 'module', '3', 'adv/item', 'delete', '删除广告', '0', '68', '50', '1357460574');
INSERT INTO `xhl_system_module` VALUES ('123', 'module', '3', 'adv/adv', 'update', '更新广告位', '0', '68', '50', '1357462189');
INSERT INTO `xhl_system_module` VALUES ('124', 'module', '3', 'adv/item', 'update', '更新广告内容', '0', '68', '50', '1357463273');
INSERT INTO `xhl_system_module` VALUES ('127', 'top', '1', '', '', '插件管理', '1', '0', '70', '1357609135');
INSERT INTO `xhl_system_module` VALUES ('142', 'module', '3', 'member/member', 'index', '会员列表', '1', '72', '10', '1357714750');
INSERT INTO `xhl_system_module` VALUES ('144', 'module', '3', 'member/member', 'ulock', '锁定会员', '0', '72', '14', '1357714750');
INSERT INTO `xhl_system_module` VALUES ('146', 'module', '3', 'member/member', 'recycle', '会员回收站', '1', '72', '15', '1357714750');
INSERT INTO `xhl_system_module` VALUES ('188', 'module', '3', 'member/member', 'delete', '删除会员', '0', '72', '16', '1358501680');
INSERT INTO `xhl_system_module` VALUES ('189', 'module', '3', 'member/member', 'regain', '恢复会员', '0', '72', '17', '1358501680');
INSERT INTO `xhl_system_module` VALUES ('223', 'module', '3', 'data/censor', 'index', '过滤词列表', '1', '70', '50', '1365701714');
INSERT INTO `xhl_system_module` VALUES ('224', 'module', '3', 'data/censor', 'create', '添加过滤词', '0', '70', '50', '1365701714');
INSERT INTO `xhl_system_module` VALUES ('228', 'module', '3', 'data/censor', 'edit', '修改过滤词', '0', '70', '50', '1366300235');
INSERT INTO `xhl_system_module` VALUES ('229', 'module', '3', 'data/censor', 'update', '更新过滤词', '0', '70', '50', '1366300235');
INSERT INTO `xhl_system_module` VALUES ('230', 'module', '3', 'data/censor', 'delete', '删除过滤词', '0', '70', '50', '1366300235');
INSERT INTO `xhl_system_module` VALUES ('244', 'menu', '2', '', '', '站长工具', '1', '127', '52', '1366388132');
INSERT INTO `xhl_system_module` VALUES ('245', 'module', '3', 'tools/cache', 'clean', '清空缓存', '1', '244', '50', '1366388194');
INSERT INTO `xhl_system_module` VALUES ('269', 'menu', '2', '', '', '网站设置', '1', '1', '1', '1370085075');
INSERT INTO `xhl_system_module` VALUES ('274', 'menu', '2', '', '', '开发工具', '1', '127', '50', '1371316254');
INSERT INTO `xhl_system_module` VALUES ('279', 'menu', '2', '', '', '数据库管理', '1', '127', '50', '1371537222');
INSERT INTO `xhl_system_module` VALUES ('287', 'module', '3', 'data/city', 'index', '城市管理', '1', '296', '20', '1371721154');
INSERT INTO `xhl_system_module` VALUES ('288', 'module', '3', 'data/city', 'create', '添加城市', '0', '296', '20', '1371721154');
INSERT INTO `xhl_system_module` VALUES ('289', 'module', '3', 'data/city', 'edit', '修改城市', '0', '296', '20', '1371721154');
INSERT INTO `xhl_system_module` VALUES ('290', 'module', '3', 'data/city', 'detail', '查看城市', '0', '296', '20', '1371721154');
INSERT INTO `xhl_system_module` VALUES ('291', 'module', '3', 'data/city', 'so', '搜索城市', '0', '296', '20', '1371721154');
INSERT INTO `xhl_system_module` VALUES ('292', 'module', '3', 'data/city', 'delete', '删除城市', '0', '296', '20', '1371721154');
INSERT INTO `xhl_system_module` VALUES ('296', 'menu', '2', '', '', '城市管理', '1', '1', '2', '1371724682');
INSERT INTO `xhl_system_module` VALUES ('297', 'module', '3', 'data/area', 'index', '地区管理', '1', '296', '30', '1371724826');
INSERT INTO `xhl_system_module` VALUES ('298', 'module', '3', 'data/area', 'create', '添加地区', '0', '296', '30', '1371724826');
INSERT INTO `xhl_system_module` VALUES ('299', 'module', '3', 'data/area', 'edit', '修改地区', '0', '296', '30', '1371724826');
INSERT INTO `xhl_system_module` VALUES ('300', 'module', '3', 'data/area', 'delete', '删除地区', '0', '296', '30', '1371724826');
INSERT INTO `xhl_system_module` VALUES ('301', 'module', '3', 'data/area', 'so', '搜索地区', '0', '296', '30', '1371724826');
INSERT INTO `xhl_system_module` VALUES ('302', 'module', '3', 'data/area', 'detail', '查看地区', '0', '296', '30', '1371724945');
INSERT INTO `xhl_system_module` VALUES ('325', 'menu', '2', '', '', '属性管理', '1', '1', '4', '1372043122');
INSERT INTO `xhl_system_module` VALUES ('326', 'module', '3', 'data/attr', 'index', '属性列表', '1', '325', '10', '1372043187');
INSERT INTO `xhl_system_module` VALUES ('327', 'module', '3', 'data/attr', 'create', '添加属性', '1', '325', '12', '1372043187');
INSERT INTO `xhl_system_module` VALUES ('328', 'module', '3', 'data/attr', 'update', '更新属性', '0', '325', '13', '1372043187');
INSERT INTO `xhl_system_module` VALUES ('329', 'module', '3', 'data/attr', 'delete', '删除属性', '0', '325', '14', '1372043187');
INSERT INTO `xhl_system_module` VALUES ('330', 'module', '3', 'data/attr', 'detail', '管理属性', '0', '325', '15', '1372053817');
INSERT INTO `xhl_system_module` VALUES ('331', 'module', '3', 'data/attr', 'updatevalue', '更新选项', '0', '325', '16', '1372053880');
INSERT INTO `xhl_system_module` VALUES ('332', 'module', '3', 'data/attr', 'delvalue', '删除选项', '0', '325', '17', '1372053880');
INSERT INTO `xhl_system_module` VALUES ('333', 'module', '3', 'article/cate', 'index', '分类列表', '1', '85', '20', '1372065450');
INSERT INTO `xhl_system_module` VALUES ('335', 'module', '3', 'article/cate', 'edit', '编辑分类', '0', '85', '22', '1372065450');
INSERT INTO `xhl_system_module` VALUES ('336', 'module', '3', 'article/cate', 'delete', '删除分类', '0', '85', '23', '1372065450');
INSERT INTO `xhl_system_module` VALUES ('337', 'module', '3', 'article/cate', 'update', '更新分类', '0', '85', '24', '1372065450');
INSERT INTO `xhl_system_module` VALUES ('338', 'module', '3', 'article/article', 'index', '文章列表', '1', '85', '10', '1372087400');
INSERT INTO `xhl_system_module` VALUES ('339', 'module', '3', 'article/article', 'so', '搜索文章', '0', '85', '11', '1372087400');
INSERT INTO `xhl_system_module` VALUES ('340', 'module', '3', 'article/article', 'create', '添加文章', '1', '85', '12', '1372087400');
INSERT INTO `xhl_system_module` VALUES ('341', 'module', '3', 'article/article', 'edit', '修改文章', '0', '85', '13', '1372087400');
INSERT INTO `xhl_system_module` VALUES ('342', 'module', '3', 'article/article', 'delete', '删除文章', '0', '85', '14', '1372087400');
INSERT INTO `xhl_system_module` VALUES ('344', 'module', '3', 'article/cate', 'create', '添加分类', '0', '85', '21', '1372153529');
INSERT INTO `xhl_system_module` VALUES ('345', 'module', '3', 'article/comment', 'index', '评论列表', '1', '85', '50', '1372154080');
INSERT INTO `xhl_system_module` VALUES ('346', 'module', '3', 'article/comment', 'create', '添加评论', '0', '85', '50', '1372154613');
INSERT INTO `xhl_system_module` VALUES ('347', 'module', '3', 'article/comment', 'edit', '修改评论', '0', '85', '50', '1372154613');
INSERT INTO `xhl_system_module` VALUES ('348', 'module', '3', 'article/comment', 'delete', '删除评论', '0', '85', '50', '1372154613');
INSERT INTO `xhl_system_module` VALUES ('349', 'module', '3', 'article/comment', 'so', '搜索评论', '0', '85', '50', '1372154635');
INSERT INTO `xhl_system_module` VALUES ('383', 'module', '3', 'member/member', 'create', '添加会员', '0', '72', '11', '1372437934');
INSERT INTO `xhl_system_module` VALUES ('384', 'module', '3', 'member/member', 'edit', '修改会员', '0', '72', '12', '1372437934');
INSERT INTO `xhl_system_module` VALUES ('385', 'module', '3', 'member/member', 'so', '搜索会员', '0', '72', '13', '1372438141');
INSERT INTO `xhl_system_module` VALUES ('386', 'module', '3', 'system/config', 'site', '基本设置', '1', '269', '1', '1372869314');
INSERT INTO `xhl_system_module` VALUES ('392', 'top', '1', '', '', '功能模块', '1', '0', '40', '1373427427');
INSERT INTO `xhl_system_module` VALUES ('410', 'module', '3', 'block/block', 'index', '推荐位列表', '1', '69', '50', '1373537610');
INSERT INTO `xhl_system_module` VALUES ('411', 'module', '3', 'block/block', 'create', '添加推荐位', '0', '69', '50', '1373537610');
INSERT INTO `xhl_system_module` VALUES ('412', 'module', '3', 'block/block', 'edit', '修改推荐位', '0', '69', '50', '1373537610');
INSERT INTO `xhl_system_module` VALUES ('413', 'module', '3', 'block/block', 'delete', '删除推荐位', '0', '69', '50', '1373537610');
INSERT INTO `xhl_system_module` VALUES ('415', 'module', '3', 'data/area', 'city', '城市地区', '0', '296', '30', '1373597863');
INSERT INTO `xhl_system_module` VALUES ('418', 'module', '3', 'data/attr', 'so', '搜索属性', '0', '325', '11', '1373645218');
INSERT INTO `xhl_system_module` VALUES ('419', 'module', '3', 'member/log', 'index', '积分日志', '1', '72', '50', '1373683486');
INSERT INTO `xhl_system_module` VALUES ('420', 'module', '3', 'member/log', 'so', '日志搜索', '0', '72', '50', '1373683486');
INSERT INTO `xhl_system_module` VALUES ('430', 'module', '3', 'member/member', 'gold', '充值金币', '0', '72', '18', '1373792200');
INSERT INTO `xhl_system_module` VALUES ('456', 'module', '3', 'data/censor', 'so', '搜索过滤词', '0', '70', '50', '1374220064');
INSERT INTO `xhl_system_module` VALUES ('470', 'module', '3', 'system/config', 'attach', '附件设置', '1', '269', '2', '1374459620');
INSERT INTO `xhl_system_module` VALUES ('471', 'module', '3', 'system/config', 'bulletin', '公告管理', '1', '269', '3', '1375237497');
INSERT INTO `xhl_system_module` VALUES ('472', 'menu', '2', '', '', '帮助中心', '1', '5', '30', '1375412896');
INSERT INTO `xhl_system_module` VALUES ('473', 'menu', '2', '', '', '关于我们', '1', '5', '40', '1375412919');
INSERT INTO `xhl_system_module` VALUES ('474', 'module', '3', 'article/about', 'index', '内容列表', '1', '473', '50', '1375413188');
INSERT INTO `xhl_system_module` VALUES ('475', 'module', '3', 'article/about', 'so', '搜索内容', '1', '473', '50', '1375413188');
INSERT INTO `xhl_system_module` VALUES ('476', 'module', '3', 'article/about', 'create', '添加内容', '0', '473', '50', '1375413188');
INSERT INTO `xhl_system_module` VALUES ('477', 'module', '3', 'article/about', 'edit', '修改内容', '0', '473', '50', '1375413188');
INSERT INTO `xhl_system_module` VALUES ('478', 'module', '3', 'article/about', 'delete', '删除内容', '0', '473', '50', '1375413188');
INSERT INTO `xhl_system_module` VALUES ('479', 'module', '3', 'article/help', 'index', '帮助管理', '1', '472', '50', '1375413284');
INSERT INTO `xhl_system_module` VALUES ('480', 'module', '3', 'article/help', 'so', '搜索帮助', '1', '472', '50', '1375413284');
INSERT INTO `xhl_system_module` VALUES ('481', 'module', '3', 'article/help', 'create', '添加帮助', '0', '472', '50', '1375413284');
INSERT INTO `xhl_system_module` VALUES ('482', 'module', '3', 'article/help', 'edit', '修改帮助', '0', '472', '50', '1375413284');
INSERT INTO `xhl_system_module` VALUES ('483', 'module', '3', 'article/help', 'delete', '删除帮助', '0', '472', '50', '1375413284');
INSERT INTO `xhl_system_module` VALUES ('1128', 'module', '3', 'weixin/weixin', 'keyword', '公众号关键字', '0', '1002', '50', '1419945038');
INSERT INTO `xhl_system_module` VALUES ('485', 'module', '3', 'block/item', 'index', '内容列表', '1', '69', '50', '1375416112');
INSERT INTO `xhl_system_module` VALUES ('486', 'module', '3', 'block/item', 'push', '推送内容', '0', '69', '50', '1375416112');
INSERT INTO `xhl_system_module` VALUES ('487', 'module', '3', 'block/item', 'create', '添加内容', '0', '69', '50', '1375416112');
INSERT INTO `xhl_system_module` VALUES ('488', 'module', '3', 'block/item', 'edit', '修改内容', '0', '69', '50', '1375416112');
INSERT INTO `xhl_system_module` VALUES ('489', 'module', '3', 'block/item', 'delete', '删除内容', '0', '69', '50', '1375416112');
INSERT INTO `xhl_system_module` VALUES ('490', 'module', '3', 'block/item', 'update', '更新内容', '0', '69', '50', '1375416112');
INSERT INTO `xhl_system_module` VALUES ('491', 'module', '3', 'block/item', 'so', '搜索内容', '0', '69', '50', '1375416112');
INSERT INTO `xhl_system_module` VALUES ('492', 'module', '3', 'block/block', 'detail', '管理推荐位', '0', '69', '50', '1375455988');
INSERT INTO `xhl_system_module` VALUES ('500', 'module', '3', 'system/config', 'mail', '邮件设置', '1', '951', '40', '1375789137');
INSERT INTO `xhl_system_module` VALUES ('501', 'menu', '2', '', '', '友情连接', '1', '5', '50', '1376153711');
INSERT INTO `xhl_system_module` VALUES ('502', 'module', '3', 'market/links', 'index', '友链管理', '1', '501', '50', '1376153822');
INSERT INTO `xhl_system_module` VALUES ('503', 'module', '3', 'market/links', 'create', '添加友链', '0', '501', '50', '1376153822');
INSERT INTO `xhl_system_module` VALUES ('504', 'module', '3', 'market/links', 'edit', '修改友链', '0', '501', '50', '1376153822');
INSERT INTO `xhl_system_module` VALUES ('505', 'module', '3', 'market/links', 'delete', '删除友链', '0', '501', '50', '1376153822');
INSERT INTO `xhl_system_module` VALUES ('506', 'module', '3', 'system/config', 'sms', '短信设置', '1', '951', '50', '1376155472');
INSERT INTO `xhl_system_module` VALUES ('515', 'module', '3', 'adv/adv', 'so', '搜索广告位', '0', '68', '50', '1376479539');
INSERT INTO `xhl_system_module` VALUES ('516', 'module', '3', 'magic/upload', 'editor', '编辑器上传图片', '0', '269', '50', '1376590326');
INSERT INTO `xhl_system_module` VALUES ('517', 'module', '3', 'system/config', 'ucenter', 'UCenter设置', '1', '930', '10', '1377316741');
INSERT INTO `xhl_system_module` VALUES ('551', 'menu', '2', '', '', '支付配置', '1', '1', '3', '1380438926');
INSERT INTO `xhl_system_module` VALUES ('553', 'module', '3', 'payment/payment', 'index', '支付接口', '1', '551', '50', '1380440527');
INSERT INTO `xhl_system_module` VALUES ('554', 'module', '3', 'tools/database', 'index', '数据库管理', '1', '279', '50', '1380561710');
INSERT INTO `xhl_system_module` VALUES ('560', 'module', '3', 'system/config', 'locoyspider', '火车头采集', '1', '244', '50', '1381539714');
INSERT INTO `xhl_system_module` VALUES ('561', 'module', '3', 'block/item', 'batch', '批量推荐', '0', '69', '50', '1381723258');
INSERT INTO `xhl_system_module` VALUES ('562', 'module', '3', 'member/member', 'ucard', '会员卡片层', '0', '72', '19', '1381942505');
INSERT INTO `xhl_system_module` VALUES ('564', 'menu', '2', '', '', '案例管理', '1', '5', '2', '1383012925');
INSERT INTO `xhl_system_module` VALUES ('565', 'module', '3', 'article/link', 'index', '连接标签', '1', '85', '50', '1383104861');
INSERT INTO `xhl_system_module` VALUES ('566', 'module', '3', 'article/link', 'create', '添加标签', '0', '85', '50', '1383104861');
INSERT INTO `xhl_system_module` VALUES ('567', 'module', '3', 'article/link', 'edit', '修改标签', '0', '85', '50', '1383104861');
INSERT INTO `xhl_system_module` VALUES ('568', 'module', '3', 'article/link', 'delete', '删除标签', '0', '85', '50', '1383104861');
INSERT INTO `xhl_system_module` VALUES ('569', 'module', '3', 'article/link', 'update', '更新标签', '0', '85', '50', '1383104861');
INSERT INTO `xhl_system_module` VALUES ('570', 'module', '3', 'member/member', 'face', '更新头像', '0', '72', '50', '1383112630');
INSERT INTO `xhl_system_module` VALUES ('571', 'menu', '2', '', '', '活动管理', '1', '743', '10', '1383291798');
INSERT INTO `xhl_system_module` VALUES ('572', 'module', '3', 'activity/cate', 'index', '活动分类', '1', '571', '1', '1383291929');
INSERT INTO `xhl_system_module` VALUES ('573', 'module', '3', 'activity/cate', 'create', '新增分类', '0', '571', '2', '1383291929');
INSERT INTO `xhl_system_module` VALUES ('574', 'module', '3', 'activity/cate', 'edit', '修改分类', '0', '571', '3', '1383291929');
INSERT INTO `xhl_system_module` VALUES ('575', 'module', '3', 'activity/cate', 'delete', '删除分类', '0', '571', '4', '1383291929');
INSERT INTO `xhl_system_module` VALUES ('576', 'module', '3', 'activity/cate', 'so', '搜索分类', '0', '571', '5', '1383291929');
INSERT INTO `xhl_system_module` VALUES ('577', 'module', '3', 'data/attr', 'attrfrom', '属性分类', '1', '325', '5', '1383357607');
INSERT INTO `xhl_system_module` VALUES ('578', 'module', '3', 'data/attr', 'createfrom', '添加分类', '0', '325', '6', '1383357607');
INSERT INTO `xhl_system_module` VALUES ('579', 'module', '3', 'data/attr', 'editfrom', '修改分类', '0', '325', '7', '1383357607');
INSERT INTO `xhl_system_module` VALUES ('580', 'module', '3', 'data/attr', 'deletefrom', '删除分类', '0', '325', '8', '1383357607');
INSERT INTO `xhl_system_module` VALUES ('581', 'module', '3', 'activity/activity', 'index', '活动管理', '1', '571', '6', '1383526842');
INSERT INTO `xhl_system_module` VALUES ('582', 'module', '3', 'activity/activity', 'create', '新增活动', '0', '571', '7', '1383526842');
INSERT INTO `xhl_system_module` VALUES ('583', 'module', '3', 'activity/activity', 'edit', '编辑活动', '0', '571', '8', '1383526842');
INSERT INTO `xhl_system_module` VALUES ('584', 'module', '3', 'activity/activity', 'delete', '下架活动', '0', '571', '9', '1383526842');
INSERT INTO `xhl_system_module` VALUES ('585', 'module', '3', 'activity/activity', 'so', '活动搜索', '0', '571', '10', '1383526842');
INSERT INTO `xhl_system_module` VALUES ('586', 'module', '3', 'article/article', 'dialog', '选择文章', '0', '85', '25', '1383553687');
INSERT INTO `xhl_system_module` VALUES ('587', 'module', '3', 'activity/sign', 'index', '报名管理', '1', '571', '11', '1383615344');
INSERT INTO `xhl_system_module` VALUES ('588', 'module', '3', 'activity/sign', 'create', '新增报名', '0', '571', '12', '1383615344');
INSERT INTO `xhl_system_module` VALUES ('589', 'module', '3', 'activity/sign', 'edit', '编辑报名', '0', '571', '13', '1383615344');
INSERT INTO `xhl_system_module` VALUES ('590', 'module', '3', 'activity/sign', 'so', '搜索报名', '0', '571', '14', '1383615344');
INSERT INTO `xhl_system_module` VALUES ('591', 'module', '3', 'activity/sign', 'download', '下载报名', '0', '571', '15', '1383615344');
INSERT INTO `xhl_system_module` VALUES ('592', 'module', '3', 'activity/sign', 'delete', '删除报名', '0', '571', '16', '1383615344');
INSERT INTO `xhl_system_module` VALUES ('593', 'module', '3', 'activity/activity', 'renew', '上架活动', '0', '571', '10', '1383619796');
INSERT INTO `xhl_system_module` VALUES ('600', 'menu', '2', '', '', '商家管理', '1', '743', '50', '1383820117');
INSERT INTO `xhl_system_module` VALUES ('602', 'module', '3', 'member/member', 'dialog', '选择用户', '0', '72', '50', '1383980953');
INSERT INTO `xhl_system_module` VALUES ('1431', 'module', '3', 'case/case', 'index', '案例列表', '1', '564', '1', '1493111035');
INSERT INTO `xhl_system_module` VALUES ('609', 'module', '3', 'case/case', 'create', '添加案例', '0', '564', '50', '1384156683');
INSERT INTO `xhl_system_module` VALUES ('610', 'module', '3', 'case/case', 'edit', '修改案例', '0', '564', '50', '1384156683');
INSERT INTO `xhl_system_module` VALUES ('611', 'module', '3', 'case/case', 'delete', '删除案例', '0', '564', '50', '1384156683');
INSERT INTO `xhl_system_module` VALUES ('612', 'module', '3', 'case/case', 'so', '搜索案例', '0', '564', '50', '1384156683');
INSERT INTO `xhl_system_module` VALUES ('613', 'module', '3', 'case/case', 'update', '更新案例', '0', '564', '50', '1384156683');
INSERT INTO `xhl_system_module` VALUES ('614', 'module', '3', 'case/case', 'audit', '审核案例', '1', '564', '50', '1384156683');
INSERT INTO `xhl_system_module` VALUES ('615', 'module', '3', 'case/case', 'detail', '案例图片', '0', '564', '50', '1384156757');
INSERT INTO `xhl_system_module` VALUES ('616', 'module', '3', 'case/photo', 'upload', '上传图片', '0', '564', '50', '1384156757');
INSERT INTO `xhl_system_module` VALUES ('617', 'module', '3', 'case/photo', 'delete', '删除图片', '0', '564', '50', '1384156757');
INSERT INTO `xhl_system_module` VALUES ('618', 'module', '3', 'case/photo', 'update', '更新图片', '0', '564', '50', '1384156757');
INSERT INTO `xhl_system_module` VALUES ('636', 'module', '3', 'system/config', 'score', '评分配置', '1', '269', '50', '1384416441');
INSERT INTO `xhl_system_module` VALUES ('647', 'menu', '2', '', '', '认证管理', '1', '127', '50', '1384573205');
INSERT INTO `xhl_system_module` VALUES ('648', 'module', '3', 'member/verify', 'index', '认证管理', '1', '647', '50', '1384573242');
INSERT INTO `xhl_system_module` VALUES ('649', 'module', '3', 'member/verify', 'audit', '审核认证', '1', '647', '50', '1384573463');
INSERT INTO `xhl_system_module` VALUES ('650', 'module', '3', 'member/verify', 'edit', '修改认证', '0', '647', '50', '1384573463');
INSERT INTO `xhl_system_module` VALUES ('651', 'module', '3', 'member/verify', 'update', '更新认证', '0', '647', '50', '1384573463');
INSERT INTO `xhl_system_module` VALUES ('652', 'module', '3', 'member/verify', 'delete', '删除认证', '0', '647', '50', '1384573463');
INSERT INTO `xhl_system_module` VALUES ('653', 'module', '3', 'shop/shop', 'index', '商家管理', '1', '600', '10', '1384583708');
INSERT INTO `xhl_system_module` VALUES ('654', 'module', '3', 'shop/shop', 'create', '添加商家', '0', '600', '11', '1384583708');
INSERT INTO `xhl_system_module` VALUES ('655', 'module', '3', 'shop/shop', 'edit', '修改商家', '0', '600', '12', '1384583708');
INSERT INTO `xhl_system_module` VALUES ('656', 'module', '3', 'shop/shop', 'delete', '删除商家', '0', '600', '13', '1384583708');
INSERT INTO `xhl_system_module` VALUES ('657', 'module', '3', 'shop/shop', 'so', '搜索商家', '0', '600', '14', '1384583708');
INSERT INTO `xhl_system_module` VALUES ('669', 'menu', '2', '', '', '设计招标', '1', '743', '1', '1384746196');
INSERT INTO `xhl_system_module` VALUES ('670', 'menu', '2', '', '', '模板设置', '1', '1', '50', '1384760168');
INSERT INTO `xhl_system_module` VALUES ('671', 'module', '3', 'system/theme', 'index', '模板管理', '1', '670', '50', '1384760203');
INSERT INTO `xhl_system_module` VALUES ('672', 'module', '3', 'tenders/tenders', 'index', '招标管理', '1', '669', '50', '1384826638');
INSERT INTO `xhl_system_module` VALUES ('673', 'module', '3', 'tenders/tenders', 'create', '新增招标', '0', '669', '50', '1384826638');
INSERT INTO `xhl_system_module` VALUES ('674', 'module', '3', 'tenders/tenders', 'edit', '编辑招标', '0', '669', '50', '1384826638');
INSERT INTO `xhl_system_module` VALUES ('675', 'module', '3', 'tenders/tenders', 'delete', '删除招标', '0', '669', '50', '1384826638');
INSERT INTO `xhl_system_module` VALUES ('676', 'module', '3', 'tenders/tenders', 'so', '搜索招标', '0', '669', '50', '1384826638');
INSERT INTO `xhl_system_module` VALUES ('677', 'module', '3', 'tenders/look', 'index', '竞标管理', '0', '669', '50', '1384845748');
INSERT INTO `xhl_system_module` VALUES ('678', 'module', '3', 'tenders/look', 'create', '分标操作', '0', '669', '50', '1384845748');
INSERT INTO `xhl_system_module` VALUES ('679', 'module', '3', 'tenders/look', 'update', '更新分标', '0', '669', '50', '1384910383');
INSERT INTO `xhl_system_module` VALUES ('680', 'module', '3', 'tenders/track', 'index', '招标跟踪', '0', '669', '50', '1384930525');
INSERT INTO `xhl_system_module` VALUES ('681', 'module', '3', 'tenders/track', 'create', '新增跟踪', '0', '669', '50', '1384930525');
INSERT INTO `xhl_system_module` VALUES ('682', 'module', '3', 'tenders/track', 'edit', '编辑跟踪', '0', '669', '50', '1384930525');
INSERT INTO `xhl_system_module` VALUES ('683', 'module', '3', 'activity/lanmu', 'activity', '活动栏目', '0', '571', '50', '1384938340');
INSERT INTO `xhl_system_module` VALUES ('684', 'module', '3', 'activity/lanmu', 'create', '活动栏目', '0', '571', '50', '1384938340');
INSERT INTO `xhl_system_module` VALUES ('685', 'module', '3', 'activity/lanmu', 'edit', '活动栏目', '0', '571', '50', '1384938340');
INSERT INTO `xhl_system_module` VALUES ('686', 'module', '3', 'activity/lanmu', 'delete', '活动栏目', '0', '571', '50', '1384938340');
INSERT INTO `xhl_system_module` VALUES ('687', 'module', '3', 'tenders/setting', 'index', '招标配置', '1', '669', '1', '1385006173');
INSERT INTO `xhl_system_module` VALUES ('688', 'module', '3', 'tenders/setting', 'create', '新增配置', '0', '669', '2', '1385006173');
INSERT INTO `xhl_system_module` VALUES ('689', 'module', '3', 'tenders/setting', 'edit', '修改配置', '0', '669', '3', '1385006173');
INSERT INTO `xhl_system_module` VALUES ('690', 'module', '3', 'tenders/setting', 'delete', '删除配置', '0', '669', '4', '1385006173');
INSERT INTO `xhl_system_module` VALUES ('691', 'module', '3', 'tenders/setting', 'so', '搜索配置', '0', '669', '5', '1385006173');
INSERT INTO `xhl_system_module` VALUES ('692', 'module', '3', 'member/verify', 'so', '搜索认证', '0', '647', '50', '1385018429');
INSERT INTO `xhl_system_module` VALUES ('708', 'module', '3', 'member/verify', 'dopass', '认证通过', '0', '647', '50', '1385609706');
INSERT INTO `xhl_system_module` VALUES ('709', 'module', '3', 'member/verify', 'dorefuse', '认证拒绝', '0', '647', '50', '1385609706');
INSERT INTO `xhl_system_module` VALUES ('717', 'module', '3', 'shop/shop', 'doaudit', '审核商家', '0', '600', '15', '1385631233');
INSERT INTO `xhl_system_module` VALUES ('719', 'module', '3', 'shop/brand', 'index', '品牌管理', '1', '600', '50', '1385634400');
INSERT INTO `xhl_system_module` VALUES ('720', 'module', '3', 'shop/brand', 'create', '添加品牌', '0', '600', '51', '1385634400');
INSERT INTO `xhl_system_module` VALUES ('721', 'module', '3', 'shop/brand', 'edit', '修改品牌', '0', '600', '52', '1385634400');
INSERT INTO `xhl_system_module` VALUES ('722', 'module', '3', 'shop/brand', 'doaudit', '审核品牌', '0', '600', '53', '1385634400');
INSERT INTO `xhl_system_module` VALUES ('723', 'module', '3', 'shop/brand', 'delete', '删除品牌', '0', '600', '54', '1385634400');
INSERT INTO `xhl_system_module` VALUES ('724', 'module', '3', 'shop/cate', 'index', '分类管理', '1', '600', '20', '1385634862');
INSERT INTO `xhl_system_module` VALUES ('725', 'module', '3', 'shop/cate', 'create', '添加分类', '0', '600', '21', '1385634862');
INSERT INTO `xhl_system_module` VALUES ('726', 'module', '3', 'shop/cate', 'edit', '修改分类', '0', '600', '22', '1385634862');
INSERT INTO `xhl_system_module` VALUES ('727', 'module', '3', 'shop/cate', 'so', '搜索分类', '0', '600', '23', '1385634862');
INSERT INTO `xhl_system_module` VALUES ('728', 'module', '3', 'shop/cate', 'doaudit', '审核分类', '0', '600', '24', '1385634862');
INSERT INTO `xhl_system_module` VALUES ('729', 'module', '3', 'shop/cate', 'delete', '删除分类', '0', '600', '25', '1385634862');
INSERT INTO `xhl_system_module` VALUES ('730', 'module', '3', 'shop/brand', 'so', '搜索品牌', '0', '600', '55', '1385634862');
INSERT INTO `xhl_system_module` VALUES ('731', 'module', '3', 'system/config', 'integral', '积分设置', '1', '269', '7', '1385779123');
INSERT INTO `xhl_system_module` VALUES ('735', 'module', '3', 'shop/shop', 'vip', '设置VIP', '0', '600', '50', '1385801113');
INSERT INTO `xhl_system_module` VALUES ('736', 'module', '3', 'shop/cate', 'children', '商家子分类', '0', '600', '25', '1385977686');
INSERT INTO `xhl_system_module` VALUES ('737', 'module', '3', 'shop/vcate', 'index', '虚拟分类', '1', '600', '50', '1386065840');
INSERT INTO `xhl_system_module` VALUES ('738', 'module', '3', 'shop/vcate', 'create', '添加虚拟分类', '0', '600', '50', '1386065840');
INSERT INTO `xhl_system_module` VALUES ('739', 'module', '3', 'shop/vcate', 'edit', '修改虚拟分类', '0', '600', '50', '1386065840');
INSERT INTO `xhl_system_module` VALUES ('740', 'module', '3', 'shop/vcate', 'delete', '删除虚拟分类', '0', '600', '50', '1386065840');
INSERT INTO `xhl_system_module` VALUES ('741', 'module', '3', 'shop/vcate', 'so', '搜索虚拟分类', '0', '600', '50', '1386065840');
INSERT INTO `xhl_system_module` VALUES ('742', 'module', '3', 'shop/shop', 'dialog', '选择商铺', '0', '600', '16', '1386066147');
INSERT INTO `xhl_system_module` VALUES ('743', 'menu', '2', '', '', '其它', '0', '600', '100', '1386120170');
INSERT INTO `xhl_system_module` VALUES ('744', 'menu', '2', '', '', '商品管理', '1', '743', '50', '1386120210');
INSERT INTO `xhl_system_module` VALUES ('745', 'module', '3', 'product/product', 'index', '商品管理', '1', '744', '10', '1386120480');
INSERT INTO `xhl_system_module` VALUES ('746', 'module', '3', 'product/product', 'create', '添加商品', '0', '744', '11', '1386120480');
INSERT INTO `xhl_system_module` VALUES ('747', 'module', '3', 'product/product', 'edit', '修改商品', '0', '744', '12', '1386120480');
INSERT INTO `xhl_system_module` VALUES ('748', 'module', '3', 'product/product', 'doaudit', '审核商品', '0', '744', '13', '1386120480');
INSERT INTO `xhl_system_module` VALUES ('749', 'module', '3', 'product/product', 'delete', '删除商品', '0', '744', '14', '1386120480');
INSERT INTO `xhl_system_module` VALUES ('750', 'module', '3', 'product/product', 'so', '搜索商品', '0', '744', '15', '1386120480');
INSERT INTO `xhl_system_module` VALUES ('751', 'menu', '2', '', '', '设计日记', '1', '5', '50', '1386141057');
INSERT INTO `xhl_system_module` VALUES ('752', 'module', '3', 'diary/diary', 'index', '日记管理', '1', '751', '50', '1386141326');
INSERT INTO `xhl_system_module` VALUES ('753', 'module', '3', 'diary/diary', 'create', '写日记', '0', '751', '50', '1386141326');
INSERT INTO `xhl_system_module` VALUES ('754', 'module', '3', 'diary/diary', 'edit', '修改日记', '0', '751', '50', '1386141326');
INSERT INTO `xhl_system_module` VALUES ('755', 'module', '3', 'diary/diary', 'delete', '删除日记', '0', '751', '50', '1386141326');
INSERT INTO `xhl_system_module` VALUES ('756', 'module', '3', 'diary/diary', 'so', '搜索日记', '0', '751', '50', '1386141326');
INSERT INTO `xhl_system_module` VALUES ('757', 'module', '3', 'diary/diary', 'doaudit', '审核日记', '0', '751', '50', '1386141326');
INSERT INTO `xhl_system_module` VALUES ('758', 'module', '3', 'diary/item', 'index', '日记文章', '0', '751', '50', '1386150589');
INSERT INTO `xhl_system_module` VALUES ('759', 'module', '3', 'diary/item', 'create', '新增日记文章', '0', '751', '50', '1386150589');
INSERT INTO `xhl_system_module` VALUES ('760', 'module', '3', 'diary/item', 'edit', '修改日记文章', '0', '751', '50', '1386150589');
INSERT INTO `xhl_system_module` VALUES ('761', 'module', '3', 'diary/item', 'delete', '删除日记文章', '0', '751', '50', '1386150589');
INSERT INTO `xhl_system_module` VALUES ('762', 'module', '3', 'diary/item', 'so', '搜索日记文章', '0', '751', '50', '1386150589');
INSERT INTO `xhl_system_module` VALUES ('763', 'module', '3', 'product/photo', 'index', '相册管理', '1', '744', '50', '1386152379');
INSERT INTO `xhl_system_module` VALUES ('764', 'module', '3', 'product/photo', 'upload', '上传图片', '0', '744', '50', '1386152379');
INSERT INTO `xhl_system_module` VALUES ('765', 'module', '3', 'product/photo', 'update', '更新图片', '0', '744', '50', '1386152379');
INSERT INTO `xhl_system_module` VALUES ('766', 'module', '3', 'product/photo', 'delete', '删除图片', '0', '744', '50', '1386152379');
INSERT INTO `xhl_system_module` VALUES ('767', 'module', '3', 'product/photo', 'product', '商品图片', '0', '744', '50', '1386152379');
INSERT INTO `xhl_system_module` VALUES ('768', 'menu', '2', '', '', '优惠券管理', '1', '743', '50', '1386215618');
INSERT INTO `xhl_system_module` VALUES ('769', 'module', '3', 'shop/coupon', 'index', '优惠券管理', '1', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('770', 'module', '3', 'shop/coupon', 'create', '添加优惠券', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('771', 'module', '3', 'shop/coupon', 'edit', '修改优惠券', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('772', 'module', '3', 'shop/coupon', 'delete', '删除优惠券', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('773', 'module', '3', 'shop/coupon', 'so', '搜索优惠券', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('774', 'module', '3', 'shop/coupon', 'doaudit', '审核优惠券', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('775', 'module', '3', 'shop/coupon', 'downloads', '下载日志', '1', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('776', 'module', '3', 'shop/coupon', 'downloadEdit', '修改日志', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('777', 'module', '3', 'shop/coupon', 'downloadDelete', '删除日志', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('778', 'module', '3', 'shop/coupon', 'downloadSo', '搜索日志', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('779', 'module', '3', 'shop/coupon', 'downloadCoupon', '优惠券日志', '0', '768', '50', '1386215832');
INSERT INTO `xhl_system_module` VALUES ('780', 'module', '3', 'block/page', 'index', '推荐页面', '1', '69', '10', '1386236761');
INSERT INTO `xhl_system_module` VALUES ('781', 'module', '3', 'block/page', 'create', '添加页面', '0', '69', '11', '1386236761');
INSERT INTO `xhl_system_module` VALUES ('782', 'module', '3', 'block/page', 'edit', '修改页面', '0', '69', '12', '1386236761');
INSERT INTO `xhl_system_module` VALUES ('783', 'module', '3', 'block/page', 'delete', '删除页面', '0', '69', '13', '1386236761');
INSERT INTO `xhl_system_module` VALUES ('784', 'module', '3', 'shop/attr', 'index', '属性管理', '1', '600', '41', '1386561013');
INSERT INTO `xhl_system_module` VALUES ('785', 'module', '3', 'shop/attr', 'so', '搜索属性', '0', '600', '42', '1386561013');
INSERT INTO `xhl_system_module` VALUES ('786', 'module', '3', 'shop/attr', 'create', '添加属性', '0', '600', '43', '1386561013');
INSERT INTO `xhl_system_module` VALUES ('787', 'module', '3', 'shop/attr', 'update', '更新属性', '0', '600', '44', '1386561013');
INSERT INTO `xhl_system_module` VALUES ('788', 'module', '3', 'shop/attr', 'delete', '删除属性', '0', '600', '45', '1386561013');
INSERT INTO `xhl_system_module` VALUES ('789', 'module', '3', 'shop/attr', 'detail', '管理属性', '0', '600', '46', '1386561013');
INSERT INTO `xhl_system_module` VALUES ('790', 'module', '3', 'shop/attr', 'updatevalue', '更新选项', '0', '600', '47', '1386561013');
INSERT INTO `xhl_system_module` VALUES ('791', 'module', '3', 'shop/attr', 'delvalue', '删除选项', '0', '600', '48', '1386561013');
INSERT INTO `xhl_system_module` VALUES ('792', 'module', '3', 'product/product', 'shop', '商铺商品', '0', '744', '16', '1386570663');
INSERT INTO `xhl_system_module` VALUES ('793', 'module', '3', 'product/photo', 'so', '搜索图片', '0', '744', '50', '1386578582');
INSERT INTO `xhl_system_module` VALUES ('794', 'module', '3', 'shop/news', 'index', '活动资讯', '1', '600', '61', '1386580627');
INSERT INTO `xhl_system_module` VALUES ('795', 'module', '3', 'shop/news', 'create', '添加活动资讯', '0', '600', '62', '1386580627');
INSERT INTO `xhl_system_module` VALUES ('796', 'module', '3', 'shop/news', 'edit', '修改活动资讯', '0', '600', '63', '1386580627');
INSERT INTO `xhl_system_module` VALUES ('797', 'module', '3', 'shop/news', 'delete', '删除活动资讯', '0', '600', '64', '1386580627');
INSERT INTO `xhl_system_module` VALUES ('798', 'module', '3', 'shop/news', 'so', '搜索活动资讯', '0', '600', '65', '1386580627');
INSERT INTO `xhl_system_module` VALUES ('799', 'module', '3', 'shop/news', 'doaudit', '审核活动资讯', '0', '600', '66', '1386580627');
INSERT INTO `xhl_system_module` VALUES ('800', 'menu', '2', '', '', '订单管理', '1', '743', '50', '1386581725');
INSERT INTO `xhl_system_module` VALUES ('801', 'module', '3', 'trade/order', 'index', '订单管理', '1', '800', '10', '1386654631');
INSERT INTO `xhl_system_module` VALUES ('802', 'module', '3', 'trade/order', 'detail', '查看订单', '0', '800', '11', '1386654631');
INSERT INTO `xhl_system_module` VALUES ('803', 'module', '3', 'trade/order', 'edit', '修改订单', '0', '800', '12', '1386654631');
INSERT INTO `xhl_system_module` VALUES ('804', 'module', '3', 'trade/order', 'doaudit', '审核订单', '0', '800', '13', '1386654631');
INSERT INTO `xhl_system_module` VALUES ('805', 'module', '3', 'trade/order', 'delete', '删除订单', '0', '800', '14', '1386654631');
INSERT INTO `xhl_system_module` VALUES ('806', 'module', '3', 'trade/order', 'so', '搜索订单', '0', '800', '15', '1386654631');
INSERT INTO `xhl_system_module` VALUES ('807', 'module', '3', 'trade/product', 'create', '添加商品', '0', '800', '20', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('808', 'module', '3', 'trade/product', 'delete', '删除商品', '0', '800', '21', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('809', 'module', '3', 'trade/product', 'edit', '修改商品', '0', '800', '22', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('810', 'module', '3', 'trade/product', 'update', '更新商品', '0', '800', '23', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('811', 'module', '3', 'shop/yuyue', 'index', '预约管理', '1', '800', '50', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('812', 'module', '3', 'shop/yuyue', 'create', '添加预约', '0', '800', '50', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('813', 'module', '3', 'shop/yuyue', 'edit', '修改预约', '0', '800', '50', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('814', 'module', '3', 'shop/yuyue', 'delete', '删除预约', '0', '800', '50', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('815', 'module', '3', 'shop/yuyue', 'so', '搜索预约', '0', '800', '50', '1386660909');
INSERT INTO `xhl_system_module` VALUES ('821', 'module', '3', 'product/comment', 'index', '评论管理', '1', '744', '50', '1386670456');
INSERT INTO `xhl_system_module` VALUES ('822', 'module', '3', 'product/comment', 'reply', '回复评论', '0', '744', '50', '1386670456');
INSERT INTO `xhl_system_module` VALUES ('823', 'module', '3', 'product/comment', 'edit', '修改评论', '0', '744', '50', '1386670456');
INSERT INTO `xhl_system_module` VALUES ('824', 'module', '3', 'product/comment', 'delete', '删除评论', '0', '744', '50', '1386670456');
INSERT INTO `xhl_system_module` VALUES ('825', 'module', '3', 'product/comment', 'doaudit', '审核评论', '0', '744', '50', '1386670456');
INSERT INTO `xhl_system_module` VALUES ('826', 'module', '3', 'product/comment', 'so', '搜索评论', '0', '744', '50', '1386670456');
INSERT INTO `xhl_system_module` VALUES ('827', 'module', '3', 'shop/comment', 'index', '留言管理', '1', '600', '100', '1386670559');
INSERT INTO `xhl_system_module` VALUES ('828', 'module', '3', 'shop/comment', 'reply', '回复留言', '0', '600', '101', '1386670559');
INSERT INTO `xhl_system_module` VALUES ('829', 'module', '3', 'shop/comment', 'edit', '修改留言', '0', '600', '102', '1386670559');
INSERT INTO `xhl_system_module` VALUES ('830', 'module', '3', 'shop/comment', 'doaudit', '审核留言', '0', '600', '103', '1386670559');
INSERT INTO `xhl_system_module` VALUES ('831', 'module', '3', 'shop/comment', 'delete', '删除留言', '0', '600', '104', '1386670559');
INSERT INTO `xhl_system_module` VALUES ('832', 'module', '3', 'shop/comment', 'so', '搜索留言', '0', '600', '50', '1386670559');
INSERT INTO `xhl_system_module` VALUES ('833', 'module', '3', 'system/config', 'mobile', '3G版设置', '1', '269', '9', '1386842790');
INSERT INTO `xhl_system_module` VALUES ('844', 'module', '3', 'case/comment', 'index', '案例评论', '1', '564', '50', '1387184758');
INSERT INTO `xhl_system_module` VALUES ('845', 'module', '3', 'case/comment', 'create', '新增评论', '0', '564', '50', '1387184758');
INSERT INTO `xhl_system_module` VALUES ('846', 'module', '3', 'case/comment', 'edit', '修改评论', '0', '564', '50', '1387184758');
INSERT INTO `xhl_system_module` VALUES ('847', 'module', '3', 'case/comment', 'delete', '删除评论', '0', '564', '50', '1387184758');
INSERT INTO `xhl_system_module` VALUES ('848', 'module', '3', 'case/comment', 'so', '搜索评论', '0', '564', '50', '1387184758');
INSERT INTO `xhl_system_module` VALUES ('849', 'module', '3', 'case/comment', 'doaudit', '审核评论', '0', '564', '50', '1387184758');
INSERT INTO `xhl_system_module` VALUES ('850', 'module', '3', 'shop/banner', 'shop', '商铺轮转', '0', '600', '50', '1387186049');
INSERT INTO `xhl_system_module` VALUES ('851', 'module', '3', 'shop/banner', 'upload', '上传轮转', '0', '600', '50', '1387186049');
INSERT INTO `xhl_system_module` VALUES ('852', 'module', '3', 'shop/banner', 'update', '更新轮转', '0', '600', '50', '1387186049');
INSERT INTO `xhl_system_module` VALUES ('853', 'module', '3', 'shop/banner', 'delete', '删除轮转', '0', '600', '50', '1387186049');
INSERT INTO `xhl_system_module` VALUES ('854', 'module', '3', 'diary/comment', 'index', '日记评论', '1', '751', '50', '1387438194');
INSERT INTO `xhl_system_module` VALUES ('855', 'module', '3', 'diary/comment', 'create', '新增评论', '0', '751', '50', '1387438194');
INSERT INTO `xhl_system_module` VALUES ('856', 'module', '3', 'diary/comment', 'edit', '修改评论', '0', '751', '50', '1387438194');
INSERT INTO `xhl_system_module` VALUES ('857', 'module', '3', 'diary/comment', 'delete', '删除评论', '0', '751', '50', '1387438194');
INSERT INTO `xhl_system_module` VALUES ('858', 'module', '3', 'diary/comment', 'so', '搜索评论', '0', '751', '50', '1387438194');
INSERT INTO `xhl_system_module` VALUES ('859', 'module', '3', 'diary/comment', 'doaudit', '审核评论', '0', '751', '50', '1387438194');
INSERT INTO `xhl_system_module` VALUES ('860', 'menu', '2', '', '', '问答管理', '1', '743', '50', '1387440138');
INSERT INTO `xhl_system_module` VALUES ('861', 'module', '3', 'ask/cate', 'index', '问答分类', '1', '860', '50', '1387443701');
INSERT INTO `xhl_system_module` VALUES ('862', 'module', '3', 'ask/cate', 'create', '新增分类', '0', '860', '50', '1387443701');
INSERT INTO `xhl_system_module` VALUES ('863', 'module', '3', 'ask/cate', 'edit', '修改分类', '0', '860', '50', '1387443701');
INSERT INTO `xhl_system_module` VALUES ('864', 'module', '3', 'ask/cate', 'delete', '删除分类', '0', '860', '50', '1387443701');
INSERT INTO `xhl_system_module` VALUES ('865', 'module', '3', 'ask/cate', 'so', '搜索分类', '0', '860', '50', '1387443701');
INSERT INTO `xhl_system_module` VALUES ('866', 'module', '3', 'ask/cate', 'children', '查询下级分类', '0', '860', '50', '1387444648');
INSERT INTO `xhl_system_module` VALUES ('867', 'module', '3', 'ask/ask', 'index', '问题管理', '1', '860', '50', '1387445353');
INSERT INTO `xhl_system_module` VALUES ('868', 'module', '3', 'ask/ask', 'create', '新增问题', '0', '860', '50', '1387445353');
INSERT INTO `xhl_system_module` VALUES ('869', 'module', '3', 'ask/ask', 'edit', '修改问题', '0', '860', '50', '1387445353');
INSERT INTO `xhl_system_module` VALUES ('870', 'module', '3', 'ask/ask', 'delete', '删除问题', '0', '860', '50', '1387445353');
INSERT INTO `xhl_system_module` VALUES ('871', 'module', '3', 'ask/ask', 'so', '搜索问题', '0', '860', '50', '1387445353');
INSERT INTO `xhl_system_module` VALUES ('872', 'module', '3', 'ask/ask', 'doaudit', '审核问题', '0', '860', '50', '1387445353');
INSERT INTO `xhl_system_module` VALUES ('873', 'module', '3', 'ask/answer', 'index', '答案管理', '1', '860', '50', '1387502613');
INSERT INTO `xhl_system_module` VALUES ('874', 'module', '3', 'ask/answer', 'create', '新增答案', '0', '860', '50', '1387502613');
INSERT INTO `xhl_system_module` VALUES ('875', 'module', '3', 'ask/answer', 'edit', '修改答案', '0', '860', '50', '1387502613');
INSERT INTO `xhl_system_module` VALUES ('876', 'module', '3', 'ask/answer', 'delete', '删除答案', '0', '860', '50', '1387502613');
INSERT INTO `xhl_system_module` VALUES ('877', 'module', '3', 'ask/answer', 'doaudit', '审核答案', '0', '860', '50', '1387502613');
INSERT INTO `xhl_system_module` VALUES ('878', 'module', '3', 'ask/answer', 'so', '搜索答案', '0', '860', '50', '1387502613');
INSERT INTO `xhl_system_module` VALUES ('879', 'module', '3', 'ask/answer', 'good', '问题补充', '0', '860', '50', '1387504178');
INSERT INTO `xhl_system_module` VALUES ('885', 'module', '3', 'system/smstmpl', 'index', '短信模板', '0', '951', '50', '1387875598');
INSERT INTO `xhl_system_module` VALUES ('886', 'module', '3', 'system/smstmpl', 'create', '新增模板', '0', '951', '50', '1387875598');
INSERT INTO `xhl_system_module` VALUES ('887', 'module', '3', 'system/smstmpl', 'edit', '修改模板', '0', '951', '50', '1387875598');
INSERT INTO `xhl_system_module` VALUES ('888', 'module', '3', 'system/emailtmpl', 'index', '邮件模板', '0', '951', '41', '1388025272');
INSERT INTO `xhl_system_module` VALUES ('889', 'module', '3', 'system/emailtmpl', 'create', '新增模板', '0', '951', '41', '1388025272');
INSERT INTO `xhl_system_module` VALUES ('890', 'module', '3', 'system/emailtmpl', 'edit', '修改模板', '0', '951', '41', '1388025272');
INSERT INTO `xhl_system_module` VALUES ('891', 'module', '3', 'payment/payment', 'config', '配置接口', '0', '551', '50', '1388027577');
INSERT INTO `xhl_system_module` VALUES ('892', 'module', '3', 'payment/payment', 'install', '安装接口', '0', '551', '50', '1388027577');
INSERT INTO `xhl_system_module` VALUES ('893', 'module', '3', 'payment/payment', 'uninstall', '卸载接口', '0', '551', '50', '1388027577');
INSERT INTO `xhl_system_module` VALUES ('894', 'module', '3', 'system/seotmpl', 'index', '全站SEO', '1', '269', '60', '1388044619');
INSERT INTO `xhl_system_module` VALUES ('895', 'module', '3', 'system/seotmpl', 'create', '新增模板', '0', '269', '60', '1388044619');
INSERT INTO `xhl_system_module` VALUES ('896', 'module', '3', 'system/seotmpl', 'edit', '修改模板', '0', '269', '60', '1388044619');
INSERT INTO `xhl_system_module` VALUES ('897', 'module', '3', 'payment/log', 'index', '支付流水', '1', '551', '50', '1388048090');
INSERT INTO `xhl_system_module` VALUES ('899', 'module', '3', 'payment/log', 'so', '修改流水', '0', '551', '50', '1388048090');
INSERT INTO `xhl_system_module` VALUES ('901', 'module', '3', 'payment/log', 'status', '更改状态', '0', '551', '50', '1388048090');
INSERT INTO `xhl_system_module` VALUES ('902', 'module', '3', 'system/config', 'gold', '金币设置', '1', '269', '6', '1388070822');
INSERT INTO `xhl_system_module` VALUES ('918', 'module', '3', 'system/config', 'shop_rank', '诚信规则', '1', '600', '10', '1388411905');
INSERT INTO `xhl_system_module` VALUES ('919', 'module', '3', 'member/member', 'manager', '管理会员', '0', '72', '50', '1388485506');
INSERT INTO `xhl_system_module` VALUES ('920', 'module', '3', 'tenders/look', 'tongji', '分单统计', '1', '669', '50', '1389060265');
INSERT INTO `xhl_system_module` VALUES ('921', 'module', '3', 'article/link', 'so', '搜索标签', '0', '85', '50', '1389168755');
INSERT INTO `xhl_system_module` VALUES ('922', 'module', '3', 'system/theme', 'detail', '管理模板', '0', '670', '50', '1389258144');
INSERT INTO `xhl_system_module` VALUES ('923', 'module', '3', 'system/theme', 'install', '安装模板', '0', '670', '50', '1389258144');
INSERT INTO `xhl_system_module` VALUES ('924', 'module', '3', 'system/theme', 'uninstall', '卸载模板', '0', '670', '50', '1389258144');
INSERT INTO `xhl_system_module` VALUES ('925', 'module', '3', 'system/theme', 'setdefault', '设置默认模板', '0', '670', '50', '1389258144');
INSERT INTO `xhl_system_module` VALUES ('927', 'module', '3', 'system/seotmpl', 'config', '配置SEO', '0', '269', '60', '1390032700');
INSERT INTO `xhl_system_module` VALUES ('929', 'module', '3', 'system/config', 'connect', '接口参数设置', '1', '930', '20', '1390186485');
INSERT INTO `xhl_system_module` VALUES ('930', 'menu', '2', '', '', '登录接口', '1', '1', '50', '1390188148');
INSERT INTO `xhl_system_module` VALUES ('931', 'module', '3', 'connect/connect', 'index', '账号绑定记录', '1', '930', '50', '1390188435');
INSERT INTO `xhl_system_module` VALUES ('932', 'module', '3', 'connect/connect', 'delete', '删除绑定记录', '0', '930', '50', '1390188435');
INSERT INTO `xhl_system_module` VALUES ('933', 'module', '3', 'connect/connect', 'so', '搜索绑定记录', '0', '930', '50', '1390188435');
INSERT INTO `xhl_system_module` VALUES ('934', 'module', '3', 'connect/connect', 'edit', '修改绑定记录', '0', '930', '50', '1390188609');
INSERT INTO `xhl_system_module` VALUES ('1426', 'module', '3', 'dream/dream', 'index', '梦想列表', '1', '1425', '1', '1493031256');
INSERT INTO `xhl_system_module` VALUES ('1427', 'module', '3', 'dream/dream', 'create', '梦想添加', '0', '1425', '2', '1493031341');
INSERT INTO `xhl_system_module` VALUES ('1428', 'module', '3', 'dream/dream', 'edit', '梦想编辑', '0', '1425', '3', '1493031341');
INSERT INTO `xhl_system_module` VALUES ('1429', 'module', '3', 'dream/dream', 'delete', '梦想删除', '0', '1425', '4', '1493031341');
INSERT INTO `xhl_system_module` VALUES ('1430', 'module', '3', 'dream/dream', 'so', '梦想搜索', '0', '1425', '5', '1493031341');
INSERT INTO `xhl_system_module` VALUES ('942', 'module', '3', 'system/emailtmpl', 'config', '配置模板', '0', '951', '41', '1401358903');
INSERT INTO `xhl_system_module` VALUES ('943', 'module', '3', 'system/smstmpl', 'config', '配置模板', '0', '951', '50', '1401358950');
INSERT INTO `xhl_system_module` VALUES ('951', 'menu', '2', '', '', '通知设置', '1', '1', '50', '1403261297');
INSERT INTO `xhl_system_module` VALUES ('952', 'module', '3', 'activity/sign', 'activity', '活动报名', '0', '571', '11', '1403681287');
INSERT INTO `xhl_system_module` VALUES ('958', 'module', '3', 'shop/yuyue', 'detail', '查看预约', '0', '800', '50', '1403834030');
INSERT INTO `xhl_system_module` VALUES ('1014', 'module', '3', 'tools/database', 'restore', '还原数据库', '0', '279', '50', '1413193393');
INSERT INTO `xhl_system_module` VALUES ('1005', 'module', '3', 'data/province', 'index', '省份管理', '1', '296', '10', '1413173592');
INSERT INTO `xhl_system_module` VALUES ('1025', 'module', '3', 'member/group', 'index', '管理用户组', '1', '72', '50', '1413947742');
INSERT INTO `xhl_system_module` VALUES ('1024', 'module', '3', 'block/block', 'code', '推荐位代码', '0', '69', '50', '1413784156');
INSERT INTO `xhl_system_module` VALUES ('1023', 'module', '3', 'block/block', 'config', '模板修改', '0', '69', '50', '1413776658');
INSERT INTO `xhl_system_module` VALUES ('1022', 'module', '3', 'system/theme', 'tmplsave', '修改入库', '0', '670', '50', '1413447673');
INSERT INTO `xhl_system_module` VALUES ('1021', 'module', '3', 'system/theme', 'tmpldelbak', '删除备份', '0', '670', '50', '1413429794');
INSERT INTO `xhl_system_module` VALUES ('1020', 'module', '3', 'system/theme', 'tmplrestore', '还原模板', '0', '670', '50', '1413429248');
INSERT INTO `xhl_system_module` VALUES ('1019', 'module', '3', 'system/theme', 'tmplbak', '查看备份', '0', '670', '50', '1413429248');
INSERT INTO `xhl_system_module` VALUES ('1015', 'module', '3', 'tools/database', 'optimize', '优化数据库', '0', '279', '50', '1413193393');
INSERT INTO `xhl_system_module` VALUES ('1016', 'module', '3', 'adv/adv', 'config', '广告位设置', '0', '68', '50', '1413384837');
INSERT INTO `xhl_system_module` VALUES ('1018', 'module', '3', 'system/theme', 'tmpledit', '编辑模板', '0', '670', '50', '1413429248');
INSERT INTO `xhl_system_module` VALUES ('1017', 'module', '3', 'adv/adv', 'code', '调用代码', '0', '68', '50', '1413384837');
INSERT INTO `xhl_system_module` VALUES ('1013', 'module', '3', 'tools/database', 'backdel', '删除备份', '0', '279', '50', '1413193393');
INSERT INTO `xhl_system_module` VALUES ('1012', 'module', '3', 'tools/database', 'backlist', '备份列表', '0', '279', '50', '1413193393');
INSERT INTO `xhl_system_module` VALUES ('1011', 'module', '3', 'tools/database', 'backup', '备份数据库', '0', '279', '50', '1413193393');
INSERT INTO `xhl_system_module` VALUES ('1010', 'module', '3', 'data/city', 'province', '省份城市', '0', '296', '20', '1413173592');
INSERT INTO `xhl_system_module` VALUES ('1009', 'module', '3', 'data/province', 'so', '搜索省份', '0', '296', '20', '1413173592');
INSERT INTO `xhl_system_module` VALUES ('1008', 'module', '3', 'data/province', 'delete', '删除省份', '0', '296', '10', '1413173592');
INSERT INTO `xhl_system_module` VALUES ('1007', 'module', '3', 'data/province', 'edit', '修改省份', '0', '296', '10', '1413173592');
INSERT INTO `xhl_system_module` VALUES ('1006', 'module', '3', 'data/province', 'create', '添加省份', '0', '296', '10', '1413173592');
INSERT INTO `xhl_system_module` VALUES ('1102', 'module', '3', 'weixin/weixin', 'index', '会员公众号', '1', '1002', '50', '1419677951');
INSERT INTO `xhl_system_module` VALUES ('992', 'module', '3', 'article/article', 'doaudit', '审核文章', '0', '85', '13', '1407937297');
INSERT INTO `xhl_system_module` VALUES ('993', 'module', '3', 'adv/item', 'doaudit', '审核广告', '0', '68', '50', '1250176349');
INSERT INTO `xhl_system_module` VALUES ('994', 'menu', '2', '', '', '商家结算', '1', '743', '50', '1409191163');
INSERT INTO `xhl_system_module` VALUES ('995', 'module', '3', 'shop/money', 'index', '商家余额', '1', '994', '50', '1409191244');
INSERT INTO `xhl_system_module` VALUES ('996', 'module', '3', 'shop/money', 'shop', '商铺日志', '0', '994', '50', '1409191244');
INSERT INTO `xhl_system_module` VALUES ('997', 'module', '3', 'shop/money', 'log', '收支日志', '1', '994', '50', '1409191244');
INSERT INTO `xhl_system_module` VALUES ('998', 'module', '3', 'shop/money', 'tixian', '商铺提现', '0', '994', '50', '1409191244');
INSERT INTO `xhl_system_module` VALUES ('999', 'module', '3', 'shop/money', 'chongzhi', '充值现金', '0', '994', '50', '1409191244');
INSERT INTO `xhl_system_module` VALUES ('1103', 'module', '3', 'weixin/weixin', 'create', '添加公众号', '0', '1002', '50', '1419677951');
INSERT INTO `xhl_system_module` VALUES ('1104', 'module', '3', 'weixin/weixin', 'edit', '修改公众号', '0', '1002', '50', '1419677951');
INSERT INTO `xhl_system_module` VALUES ('1026', 'module', '3', 'member/group', 'create', '添加用户组', '0', '72', '50', '1413947742');
INSERT INTO `xhl_system_module` VALUES ('1027', 'module', '3', 'member/group', 'edit', '编辑用户组', '0', '72', '50', '1413947742');
INSERT INTO `xhl_system_module` VALUES ('1028', 'module', '3', 'member/group', 'priv', '用户组权限', '0', '72', '50', '1413947742');
INSERT INTO `xhl_system_module` VALUES ('1029', 'module', '3', 'member/group', 'delete', '删除用户组', '0', '72', '50', '1413947742');
INSERT INTO `xhl_system_module` VALUES ('1030', 'module', '3', 'tenders/tenders', 'detail', '查看招标', '0', '669', '50', '1414213829');
INSERT INTO `xhl_system_module` VALUES ('1031', 'module', '3', 'case/case', 'dialog', '案例列表', '0', '564', '50', '1414373760');
INSERT INTO `xhl_system_module` VALUES ('1046', 'module', '3', 'data/cate', 'index', '分类设置', '1', '70', '10', '1414490528');
INSERT INTO `xhl_system_module` VALUES ('1047', 'module', '3', 'data/cate', 'create', '添加分类', '0', '70', '10', '1414490528');
INSERT INTO `xhl_system_module` VALUES ('1048', 'module', '3', 'data/cate', 'update', '更新分类', '0', '70', '10', '1414490528');
INSERT INTO `xhl_system_module` VALUES ('1049', 'module', '3', 'data/cate', 'delete', '删除分类', '0', '70', '10', '1414490528');
INSERT INTO `xhl_system_module` VALUES ('1050', 'module', '3', 'diary/diary', 'dialog', '选择日记', '0', '751', '50', '1414498105');
INSERT INTO `xhl_system_module` VALUES ('1093', 'module', '3', 'product/spec', 'update', '更新规格', '0', '744', '50', '1418355094');
INSERT INTO `xhl_system_module` VALUES ('1092', 'module', '3', 'product/spec', 'product', '商品规格', '0', '744', '50', '1418355094');
INSERT INTO `xhl_system_module` VALUES ('1094', 'module', '3', 'product/spec', 'delete', '删除规格', '0', '744', '50', '1418355094');
INSERT INTO `xhl_system_module` VALUES ('1096', 'module', '3', 'system/config', 'access', '访问设置', '1', '269', '50', '1419059027');
INSERT INTO `xhl_system_module` VALUES ('1097', 'module', '3', 'system/config', 'comment', '评论设置', '1', '269', '8', '1419222593');
INSERT INTO `xhl_system_module` VALUES ('1098', 'module', '3', 'system/config', 'routeurl', 'URL设置', '1', '269', '50', '1419417345');
INSERT INTO `xhl_system_module` VALUES ('1099', 'module', '3', 'system/config', 'domain', '域名设置', '1', '269', '50', '1419418242');
INSERT INTO `xhl_system_module` VALUES ('1127', 'module', '3', 'weixin/weixin', 'reply', '公众号素材', '0', '1002', '50', '1419945038');
INSERT INTO `xhl_system_module` VALUES ('1126', 'module', '3', 'weixin/weixin', 'welcome', '欢迎页设置', '0', '1002', '50', '1419942869');
INSERT INTO `xhl_system_module` VALUES ('1120', 'module', '3', 'weixin/menu', 'delete', '删除菜单', '0', '1002', '50', '1419746154');
INSERT INTO `xhl_system_module` VALUES ('1119', 'module', '3', 'weixin/menu', 'edit', '修改菜单', '0', '1002', '50', '1419746154');
INSERT INTO `xhl_system_module` VALUES ('1118', 'module', '3', 'weixin/menu', 'create', '添加菜单', '0', '1002', '50', '1419746154');
INSERT INTO `xhl_system_module` VALUES ('1117', 'module', '3', 'weixin/weixin', 'menu', '公众号菜单', '0', '1002', '50', '1419745674');
INSERT INTO `xhl_system_module` VALUES ('1116', 'module', '3', 'weixin/keyword', 'so', '搜索关键字', '0', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1115', 'module', '3', 'weixin/keyword', 'delete', '删除关键字', '0', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1114', 'module', '3', 'weixin/keyword', 'edit', '修改关键字', '0', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1113', 'module', '3', 'weixin/keyword', 'create', '添加关键字', '0', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1112', 'module', '3', 'weixin/keyword', 'index', '关键字管理', '1', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1111', 'module', '3', 'weixin/reply', 'dialog', '选择素材', '0', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1110', 'module', '3', 'weixin/reply', 'delete', '删除素材', '0', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1109', 'module', '3', 'weixin/reply', 'edit', '修改素材', '0', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1108', 'module', '3', 'weixin/reply', 'create', '添加素材', '0', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1107', 'module', '3', 'weixin/reply', 'index', '素材管理', '1', '1002', '50', '1419678104');
INSERT INTO `xhl_system_module` VALUES ('1122', 'module', '3', 'activity/activity', 'doaudit', '批量审核', '0', '571', '50', '1419848467');
INSERT INTO `xhl_system_module` VALUES ('1106', 'module', '3', 'weixin/weixin', 'leaflets', '推广页设置', '0', '1002', '50', '1419677951');
INSERT INTO `xhl_system_module` VALUES ('1105', 'module', '3', 'weixin/weixin', 'delete', '删除公众号', '0', '1002', '50', '1419677951');
INSERT INTO `xhl_system_module` VALUES ('1129', 'module', '3', 'tenders/track', 'reply', '跟踪回复', '0', '669', '50', '1420078992');
INSERT INTO `xhl_system_module` VALUES ('1002', 'menu', '2', '', '', '微信应用', '1', '127', '50', '1412492369');
INSERT INTO `xhl_system_module` VALUES ('1125', 'module', '3', 'weixin/weixin', 'admin', '网站公众号', '1', '1002', '10', '1419942069');
INSERT INTO `xhl_system_module` VALUES ('1182', 'module', '3', 'article/article', 'upload', '上传图片', '0', '85', '12', '1419942069');
INSERT INTO `xhl_system_module` VALUES ('1288', 'menu', '2', '', '', '展会实况', '1', '743', '50', '1448957133');
INSERT INTO `xhl_system_module` VALUES ('1302', 'module', '3', 'kuang/comment', 'delete', '删除评论', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1289', 'module', '3', 'kuang/kuang', 'index', '展会实况', '1', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1306', 'module', '3', 'kuang/kuang', 'create', '添加实况', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1301', 'module', '3', 'kuang/comment', 'edit', '修改评论', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1300', 'module', '3', 'kuang/comment', 'create', '新增评论', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1299', 'module', '3', 'kuang/comment', 'index', '实况评论', '1', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1298', 'module', '3', 'kuang/photo', 'update', '更新图片', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1297', 'module', '3', 'kuang/photo', 'delete', '删除图片', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1296', 'module', '3', 'kuang/photo', 'upload', '上传图片', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1295', 'module', '3', 'kuang/kuang', 'detail', '实况图片', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1294', 'module', '3', 'kuang/kuang', 'audit', '审核实况', '1', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1293', 'module', '3', 'kuang/kuang', 'update', '更新实况', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1292', 'module', '3', 'kuang/kuang', 'so', '搜索实况', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1291', 'module', '3', 'kuang/kuang', 'delete', '删除实况', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1290', 'module', '3', 'kuang/kuang', 'edit', '修改实况', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1303', 'module', '3', 'kuang/comment', 'so', '搜索评论', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1304', 'module', '3', 'kuang/comment', 'doaudit', '审核评论', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1305', 'module', '3', 'kuang/kuang', 'dialog', '实况列表', '0', '1288', '50', '1448957624');
INSERT INTO `xhl_system_module` VALUES ('1313', 'module', '3', 'admin/admin', 'dialog', '选择执行', '0', '6', '50', '1453719124');
INSERT INTO `xhl_system_module` VALUES ('1331', 'module', '3', 'case/photo', 'defaultphoto', '修改封面', '0', '564', '50', '1458011281');
INSERT INTO `xhl_system_module` VALUES ('1340', 'menu', '2', '', '', '电子名片', '1', '71', '50', '1466070756');
INSERT INTO `xhl_system_module` VALUES ('1341', 'module', '3', 'mingpian/mingpian', 'index', '名片列表', '1', '1340', '50', '1466070808');
INSERT INTO `xhl_system_module` VALUES ('1342', 'module', '3', 'mingpian/mingpian', 'create', '添加', '0', '1340', '50', '1466070858');
INSERT INTO `xhl_system_module` VALUES ('1343', 'module', '3', 'mingpian/mingpian', 'edit', '修改', '0', '1340', '50', '1466070858');
INSERT INTO `xhl_system_module` VALUES ('1344', 'module', '3', 'case/case', 'anliyuan', '案例源', '0', '564', '50', '1466749766');
INSERT INTO `xhl_system_module` VALUES ('1345', 'module', '3', 'case/case', 'daoru', '导入', '0', '564', '50', '1466750071');
INSERT INTO `xhl_system_module` VALUES ('1346', 'module', '3', 'case/case', 'aly_detail', '查看案例源', '0', '564', '50', '1466750071');
INSERT INTO `xhl_system_module` VALUES ('1347', 'module', '3', 'case/case', 'aly_delete', '删除案例源', '0', '564', '50', '1466750107');
INSERT INTO `xhl_system_module` VALUES ('1355', 'menu', '2', '', '', '订单效果图', '1', '392', '50', '1475986711');
INSERT INTO `xhl_system_module` VALUES ('1356', 'module', '3', 'orderpic/orderpic', 'index', '效果图', '1', '1355', '50', '1475986762');
INSERT INTO `xhl_system_module` VALUES ('1394', 'module', '3', 'xiangmu/xiangmu', 'doaudit', '审核项目', '0', '1384', '10', '1482739011');
INSERT INTO `xhl_system_module` VALUES ('1384', 'menu', '2', '', '', '项目管理', '1', '392', '50', '1482716309');
INSERT INTO `xhl_system_module` VALUES ('1385', 'module', '3', 'xiangmu/xiangmu', 'index', '项目列表', '1', '1384', '1', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1386', 'module', '3', 'xiangmu/xiangmu', 'create', '添加项目', '1', '1384', '2', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1387', 'module', '3', 'xiangmu/xiangmu', 'edit', '修改项目', '0', '1384', '3', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1388', 'module', '3', 'xiangmu/xiangmu', 'delete', '删除项目', '0', '1384', '4', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1389', 'module', '3', 'xiangmu/cate', 'index', '分类列表', '1', '1384', '5', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1390', 'module', '3', 'xiangmu/cate', 'create', '添加分类', '0', '1384', '6', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1391', 'module', '3', 'xiangmu/cate', 'edit', '修改分类', '0', '1384', '7', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1392', 'module', '3', 'xiangmu/cate', 'delete', '删除分类', '0', '1384', '8', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1393', 'module', '3', 'xiangmu/comment', 'index', '评论列表', '1', '1384', '9', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1395', 'module', '3', 'xiangmu/xiangmu', 'so', '搜索项目', '0', '1384', '11', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1396', 'module', '3', 'xiangmu/comment', 'create', '添加评论', '0', '1384', '12', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1397', 'module', '3', 'xiangmu/comment', 'edit', '修改评论', '0', '1384', '13', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1398', 'module', '3', 'xiangmu/comment', 'delete', '删除评论', '0', '1384', '14', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1399', 'module', '3', 'xiangmu/comment', 'so', '搜索评论', '0', '1384', '15', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1400', 'module', '3', 'xiangmu/xiangmu', 'dialog', '选择项目', '0', '1384', '50', '1483692607');
INSERT INTO `xhl_system_module` VALUES ('1401', 'menu', '2', '', '', '模块管理', '1', '392', '50', '1482716309');
INSERT INTO `xhl_system_module` VALUES ('1402', 'module', '3', 'component/component', 'index', '模块列表', '1', '1401', '1', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1403', 'module', '3', 'component/component', 'create', '添加模块', '1', '1401', '2', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1404', 'module', '3', 'component/component', 'edit', '修改模块', '0', '1401', '3', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1405', 'module', '3', 'component/component', 'delete', '删除模块', '0', '1401', '4', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1406', 'module', '3', 'component/cate', 'index', '分类列表', '1', '1401', '5', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1407', 'module', '3', 'component/cate', 'create', '添加分类', '0', '1401', '6', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1408', 'module', '3', 'component/cate', 'edit', '修改分类', '0', '1401', '7', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1409', 'module', '3', 'component/cate', 'delete', '删除分类', '0', '1401', '8', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1410', 'module', '3', 'component/comment', 'index', '评论列表', '1', '1401', '9', '1482716687');
INSERT INTO `xhl_system_module` VALUES ('1411', 'module', '3', 'component/component', 'doaudit', '审核模块', '0', '1401', '10', '1482739011');
INSERT INTO `xhl_system_module` VALUES ('1412', 'module', '3', 'component/component', 'so', '搜索模块', '0', '1401', '11', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1413', 'module', '3', 'component/comment', 'create', '添加评论', '0', '1401', '12', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1414', 'module', '3', 'component/comment', 'edit', '修改评论', '0', '1401', '13', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1415', 'module', '3', 'component/comment', 'delete', '删除评论', '0', '1401', '14', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1416', 'module', '3', 'component/comment', 'so', '搜索评论', '0', '1401', '15', '1482739968');
INSERT INTO `xhl_system_module` VALUES ('1417', 'module', '3', 'component/component', 'dialog', '选择模块', '0', '1401', '50', '1483692607');
INSERT INTO `xhl_system_module` VALUES ('1419', 'menu', '2', '', '', '留言管理', '1', '5', '50', '1492765250');
INSERT INTO `xhl_system_module` VALUES ('1420', 'module', '3', 'message/message', 'index', '留言列表', '1', '1419', '1', '1492765360');
INSERT INTO `xhl_system_module` VALUES ('1421', 'module', '3', 'message/message', 'create', '留言添加', '1', '1419', '2', '1492765408');
INSERT INTO `xhl_system_module` VALUES ('1422', 'module', '3', 'message/message', 'edit', '留言编辑', '0', '1419', '3', '1492765432');
INSERT INTO `xhl_system_module` VALUES ('1423', 'module', '3', 'message/message', 'delete', '留言删除', '0', '1419', '4', '1492765460');
INSERT INTO `xhl_system_module` VALUES ('1424', 'module', '3', 'message/message', 'so', '留言搜索', '1', '1419', '5', '1492995738');
INSERT INTO `xhl_system_module` VALUES ('1432', 'menu', '2', '', '', '名片管理', '1', '71', '50', '1525771373');
INSERT INTO `xhl_system_module` VALUES ('1433', 'module', '3', 'card/card', 'index', '名片列表', '1', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1434', 'module', '3', 'card/card', 'edit', '名片编辑', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1435', 'module', '3', 'card/card', 'delete', '名片删除', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1436', 'module', '3', 'card/card', 'so', '名片搜索', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1437', 'module', '3', 'card/fans', 'index', '用户列表', '1', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1438', 'module', '3', 'card/fans', 'edit', '用户编辑', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1439', 'module', '3', 'card/fans', 'delete', '用户删除', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1440', 'module', '3', 'card/slide', 'index', '广告列表', '1', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1441', 'module', '3', 'card/slide', 'create', '广告添加', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1442', 'module', '3', 'card/slide', 'delete', '广告删除', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1443', 'module', '3', 'card/slide', 'edit', '广告修改', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1444', 'module', '3', 'card/site', 'index', '小程序设置', '1', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1445', 'module', '3', 'card/site', 'create', '小程序添加', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1446', 'module', '3', 'card/site', 'edit', '小程序编辑', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1447', 'module', '3', 'card/site', 'delete', '小程序删除', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1448', 'module', '3', 'card/fans', 'cardinfo', '名片详情', '0', '1432', '50', '1525771557');
INSERT INTO `xhl_system_module` VALUES ('1449', 'module', '3', 'card/fans', 'so', '用户搜索', '0', '1432', '50', '1525771557');

-- ----------------------------
-- Table structure for `xhl_test`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_test`;
CREATE TABLE `xhl_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_test
-- ----------------------------
INSERT INTO `xhl_test` VALUES ('1', '1', '44');
INSERT INTO `xhl_test` VALUES ('2', '1', '44');
INSERT INTO `xhl_test` VALUES ('3', '1', '44');
INSERT INTO `xhl_test` VALUES ('4', '1', '44');
INSERT INTO `xhl_test` VALUES ('5', '1', '44');
INSERT INTO `xhl_test` VALUES ('6', '1', '44');
INSERT INTO `xhl_test` VALUES ('7', '1', '44');
INSERT INTO `xhl_test` VALUES ('8', '1', '44');
INSERT INTO `xhl_test` VALUES ('9', '1', '44');
INSERT INTO `xhl_test` VALUES ('10', '1', '44');
INSERT INTO `xhl_test` VALUES ('11', '1', '44');
INSERT INTO `xhl_test` VALUES ('12', '1', '44');

-- ----------------------------
-- Table structure for `xhl_themes`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_themes`;
CREATE TABLE `xhl_themes` (
  `theme_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) DEFAULT '',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(150) DEFAULT '',
  `config` mediumtext,
  `default` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`theme_id`),
  KEY `theme` (`theme`,`default`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_themes
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_user`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_user`;
CREATE TABLE `xhl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '密码',
  `loginnum` int(11) DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '真实姓名',
  `status` int(1) DEFAULT '0' COMMENT '状态',
  `typeid` int(11) DEFAULT '1' COMMENT '用户角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of xhl_user
-- ----------------------------
INSERT INTO `xhl_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '64', '127.0.0.1', '1473228905', 'admin', '1', '1');
INSERT INTO `xhl_user` VALUES ('2', 'xiaobai', '4297f44b13955235245b2497399d7a93', '6', '127.0.0.1', '1470368260', '小白', '1', '2');

-- ----------------------------
-- Table structure for `xhl_website`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_website`;
CREATE TABLE `xhl_website` (
  `website_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `generator` varchar(50) DEFAULT NULL,
  `charset` varchar(10) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `xiangmu_id` int(11) DEFAULT '0',
  `iscai` tinyint(1) DEFAULT '0',
  `isfen` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`website_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_website
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_workerman_message`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_workerman_message`;
CREATE TABLE `xhl_workerman_message` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL COMMENT '类型',
  `from_client_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `from_client_name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `message` varchar(500) DEFAULT NULL COMMENT '聊天内容',
  `room_id` int(11) DEFAULT NULL COMMENT '房间号',
  `time` int(11) DEFAULT NULL COMMENT '发送时间',
  `to_client_id` varchar(50) DEFAULT '0' COMMENT '私聊ID，0为所有人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_workerman_message
-- ----------------------------
INSERT INTO `xhl_workerman_message` VALUES ('1', null, null, null, null, null, null, '111');

-- ----------------------------
-- Table structure for `xhl_xiangmu`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu`;
CREATE TABLE `xhl_xiangmu` (
  `xiangmu_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '项目id',
  `cat_id` mediumint(6) unsigned DEFAULT '0' COMMENT '分类id',
  `from` enum('xiangmu','about','help','page') DEFAULT 'xiangmu',
  `page` varchar(15) DEFAULT '',
  `title` varchar(15) DEFAULT '' COMMENT '标题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `yuyan` varchar(200) DEFAULT '' COMMENT '源码语言',
  `hangye` varchar(150) DEFAULT '' COMMENT '企业行业',
  `chajian` varchar(255) DEFAULT '' COMMENT '插件情况',
  `huanjing` varchar(128) DEFAULT '' COMMENT '运行环境',
  `ontime` int(10) DEFAULT '0' COMMENT '更新时间',
  `size` varchar(5) DEFAULT '0' COMMENT '软件大小',
  `xingzhi` varchar(8) DEFAULT '' COMMENT '网页性质',
  `gurl` varchar(64) DEFAULT '' COMMENT '官方主页',
  `xnum` int(20) unsigned DEFAULT '0' COMMENT '下载次数',
  `url` varchar(64) DEFAULT NULL COMMENT '下载地址',
  `linkurl` varchar(255) DEFAULT NULL COMMENT '跳转url',
  `desc` varchar(255) DEFAULT '' COMMENT '描述',
  `views` mediumint(8) DEFAULT '0' COMMENT '浏览数',
  `favorites` mediumint(8) DEFAULT '0' COMMENT '收藏数',
  `comments` varchar(255) DEFAULT '0' COMMENT '留言数',
  `orderby` smallint(6) unsigned DEFAULT '50',
  `dateline` int(10) unsigned DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0' COMMENT '状态',
  `hidden` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) unsigned DEFAULT '0',
  `uid` int(10) unsigned DEFAULT NULL COMMENT '设计师id',
  `infourl` varchar(255) DEFAULT '' COMMENT '介绍url',
  `xmprice` tinyint(1) unsigned DEFAULT '0' COMMENT '项目收费',
  `teamid` varchar(500) DEFAULT NULL,
  `check_str` varchar(255) NOT NULL DEFAULT '' COMMENT '验证str',
  `ischeck` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证过 1验证0未验证',
  `content` text NOT NULL COMMENT '内容',
  `seo_keywords` varchar(100) DEFAULT NULL COMMENT '关键词',
  `photo` varchar(255) DEFAULT NULL COMMENT '简介图片id',
  `introduce` tinyint(5) DEFAULT NULL,
  `property` tinyint(2) NOT NULL DEFAULT '1' COMMENT '属性 1 个人项目 2 开源项目',
  `label` tinyint(10) DEFAULT NULL COMMENT '项目标签',
  PRIMARY KEY (`xiangmu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=464 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu
-- ----------------------------
INSERT INTO `xhl_xiangmu` VALUES ('447', '12', 'xiangmu', '', '干点活', 'photo/201805/20180522_0912871B7551EBCCDF4DF346817F9625.png', '16', '25', '', '', '0', '0', '', 'gdh12.com', '0', null, null, '技术合伙人', '251', '27', '0', '50', '1526969823', '1', '0', '0', '1127', '', '0', '9,10,11,12', '201806071442259a96876e2f8f3dc4f3cf45f02c61c0c1', '1', '<p>团的介绍2222</p>', '亮点', '120,121', '20', '1', null);
INSERT INTO `xhl_xiangmu` VALUES ('448', '0', 'xiangmu', '', '项目名称', 'photo/201805/20180522_D9DEF6A219A10BCE42CD1C0DEF9976A9.png', '14', '22', '', '', '0', '0', '', 'gdh21.com', '0', null, null, '介绍', '41', '1', '0', '50', '1526969866', '1', '0', '0', '1131', '', '0', '10,11', '', '0', '项目介绍', '联动', '122,123', '20', '1', null);
INSERT INTO `xhl_xiangmu` VALUES ('450', '12', 'xiangmu', '', '干点活测试', 'photo/201805/20180525_6E4B7A73CF3ADA07D073C2125A51BA74.png', '15', '23', '', '', '0', '0', '', '55555555555', '0', null, null, '1222222222222', '45', '2', '0', '50', '1527216169', '1', '0', '0', '1127', '', '0', '10,11', '', '0', '444444444444444``2', '3333333333333', '130', '20', '1', null);
INSERT INTO `xhl_xiangmu` VALUES ('451', '0', 'xiangmu', '', '通票干点活', 'photo/201805/20180525_6E4B7A73CF3ADA07D073C2125A51BA74.png', '15', '23', '', '', '0', '0', '', '55555555555', '0', null, null, '1222222222222', '23', '0', '0', '50', '1527216264', '1', '0', '0', '1127', '', '0', '10', '', '0', '444444444444444', '3333333333333', '130', '19', '1', null);
INSERT INTO `xhl_xiangmu` VALUES ('452', '0', 'xiangmu', '', '试', 'photo/201805/20180525_99223E3C726B66A6AA4A27D38CC24CDD.png', '14', '22', '', '', '0', '0', '', 'gdh1.com', '0', null, null, '555555552222', '40', '10', '0', '50', '1527216432', '1', '0', '0', '1127', '', '0', '10,11', '', '0', '555', '555', '131', '18', '2', null);
INSERT INTO `xhl_xiangmu` VALUES ('449', '0', 'xiangmu', '', '测试', 'photo/201805/20180524_D003FC7C40813AA316CB195E2513469D.png', '14', '22', '', '', '0', '0', '', 'gdh1.com', '0', null, null, '结束自己', '366', '0', '0', '50', '1527134384', '1', '0', '0', '1127', '', '0', '11,13', 'd61e4bbd6393c9111e6526ea173a7c8b', '1', '项目说明', '亮点介绍', '127,128', '20', '1', null);
INSERT INTO `xhl_xiangmu` VALUES ('454', '0', 'xiangmu', '', '测试123', 'photo/201806/20180615_9A3D9EC920EF27499F968AA8F555310C.jpg', '15', '24', '', '', '0', '0', '', 'gdh1.com', '0', null, null, '网站介绍', '28', '1', '0', '50', '1528438064', '1', '0', '0', '1127', '', '0', null, 'e44fea3bec53bcea3b7513ccef5857ac', '1', '<p>网站详细介绍</p>', '亮点说明', '132,133', '18', '1', '29');
INSERT INTO `xhl_xiangmu` VALUES ('462', '0', 'xiangmu', '', '的股份', 'photo/201806/20180619_087AD57B84419F3FED6E34312DA9F9EB.jpg', '14', '22', '', '', '0', '0', '', 'sdfsdf', '0', null, null, '分为发生的股份讽德诵功', '26', '0', '0', '50', '1529390955', '1', '0', '0', '1127', '', '0', null, '51d92be1c60d1db1d2e5e7a07da55b26', '0', '<p>胜多负少的广东省高</p>', '的郭德纲第三个', '', '18', '1', '27');
INSERT INTO `xhl_xiangmu` VALUES ('463', '0', 'xiangmu', '', 'DedeCMS内容管理系统', 'photo/201807/20180723_395AC504B3A0F9E8582167B35253B9D5.png', '14', '25', '', '', '0', '0', '', 'http://www.dedecms.com/', '0', null, null, 'DedeCMS最适合应用企业网站', '12', '0', '0', '50', '1532342870', '1', '0', '0', '1126', '', '0', null, '', '0', '<h2 style=\"margin: 0px; padding: 0px; font-size: 12px; line-height: 22px; color: rgb(11, 102, 168); font-family: Tahoma, Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">DedeCMS内容管理系统软件简介</h2><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\">欢迎使用国内最专业的PHP网站内容管理系统-织梦内容管理系统，他将是您轻松建站的首选利器。采用XML名字空间风格核心模板：模板全部使用文件形式保存，对用户设计模板、网站升级转移均提供很大的便利，健壮的模板标签为站长DIY 自己的网站提供了强有力的支持。高效率标签缓存机制：允许对类同的标签进行缓存，在生成 HTML的时候，有利于提高系统反应速度，降低系统消耗的资源。模型与模块概念并存：在模型不能满足用户所有需求的情况下，DedeCMS推出一些互动的模块对系统进行补充，尽量满足用户的需求。众多的应用支持：为用户提供了各类网站建设的一体化解决方案，在本版本中，增加了分类、书库、黄页、圈子、问答等模块，补充一些用户的特殊要求。面向未来过渡：织梦团队的组建为织梦CMS的发展提供坚实的基础，在织梦团队未来的构想中，它以后将会具有更大的灵活性和稳定的性能。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><h2 style=\"margin: 0px; padding: 0px; font-size: 12px; line-height: 22px; color: rgb(11, 102, 168); font-family: Tahoma, Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">DedeCMS应用领域</h2><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\">DedeCMS最适合应用于以下领域：<br/>•企业网站，无论大型还是中小型企业，利用网络传递信息在一定程度上提高了办事的效率，提高企业的竞争力；<br/>•政府机关，通过建立政府门户，有利于各种信息和资源的整合，为政府和社会公众之间加强联系和沟通，从而使政府可以更快、更便捷、更有效开展工作；<br/>•教育机构，通过网络信息的引入，使得教育机构之间及教育机构内部和教育者之间进行信息传递，全面提升教育类网站的层面；<br/>•媒体机构，互联网这种新媒体已经强而有力的冲击了传统媒体，在这个演变过程中，各类媒体机构应对自己核心有一个重新认识和重新发展的过程，建立一个数字技术平台以适应数字化时代的需求；<br/>•行业网站，针对不同行业，强化内部的信息划分，体现行业的特色，网站含有行业的动态信息、产品、市场、技术、人才等信息，树立行业信息权威形象，为行业内产品供应链管理，提供实际的商业机会；<br/>•个人站长，兴趣为主导，建立各种题材新颖，内容丰富的网站，通过共同兴趣的信息交流，可以让您形成自己具有特色的用户圈，产生个人需求，并为其服务；<br/>•收费网站，内容收费类型的网站，用户可以在线提供产品销售，或者内容收费，简单清晰的盈利模式，确保您以最小的投资，取得最大的回报；</p><p><br/></p>', '轻松建站的首选利器', '140', '19', '2', '28');

-- ----------------------------
-- Table structure for `xhl_xiangmu_cate`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_cate`;
CREATE TABLE `xhl_xiangmu_cate` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) DEFAULT NULL,
  `title` varchar(255) DEFAULT '',
  `level` tinyint(1) DEFAULT '1',
  `from` enum('xiangmu','page','help','about') DEFAULT 'xiangmu',
  `bgimg` varchar(255) DEFAULT NULL COMMENT '背景图片',
  `seo_title` varchar(255) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(255) DEFAULT '',
  `orderby` mediumint(6) unsigned DEFAULT '50',
  `hidden` tinyint(1) DEFAULT NULL,
  `dateline` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_cate
-- ----------------------------
INSERT INTO `xhl_xiangmu_cate` VALUES ('12', '0', '开发语言', '1', 'xiangmu', 'photo/201701/20170104_06B3333E1A72D11E1C2291B3CF1828A0.png', '', '', '', '50', '0', '1483499832');
INSERT INTO `xhl_xiangmu_cate` VALUES ('13', '0', '项目环境', '1', 'xiangmu', 'photo/201701/20170104_43DE9D588720988F08AB3029ACF7C901.png', '', '', '', '50', '0', '1483513325');
INSERT INTO `xhl_xiangmu_cate` VALUES ('14', '12', 'PHP', '2', 'xiangmu', null, 'OK', '好吧', '', '50', '0', '1487922071');
INSERT INTO `xhl_xiangmu_cate` VALUES ('15', '12', 'JSP', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533221');
INSERT INTO `xhl_xiangmu_cate` VALUES ('16', '12', '.NET', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533234');
INSERT INTO `xhl_xiangmu_cate` VALUES ('17', '12', 'ASP', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533251');
INSERT INTO `xhl_xiangmu_cate` VALUES ('18', '13', '原始取得', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533804');
INSERT INTO `xhl_xiangmu_cate` VALUES ('19', '13', 'CMS', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533871');
INSERT INTO `xhl_xiangmu_cate` VALUES ('20', '13', '其他', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533884');
INSERT INTO `xhl_xiangmu_cate` VALUES ('21', '0', '行业领域', '1', 'xiangmu', null, '', '', '', '50', '0', '1526533939');
INSERT INTO `xhl_xiangmu_cate` VALUES ('22', '21', '人工智能', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533954');
INSERT INTO `xhl_xiangmu_cate` VALUES ('23', '21', '大数据', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533963');
INSERT INTO `xhl_xiangmu_cate` VALUES ('24', '21', '教育', '2', 'xiangmu', null, '', '', '', '50', '0', '1526533996');
INSERT INTO `xhl_xiangmu_cate` VALUES ('25', '21', '电商', '2', 'xiangmu', null, '', '', '', '50', '0', '1526534007');
INSERT INTO `xhl_xiangmu_cate` VALUES ('26', '0', '项目标签', '1', 'xiangmu', null, '', '', '', '50', '0', '1528860620');
INSERT INTO `xhl_xiangmu_cate` VALUES ('27', '26', '微商', '2', 'xiangmu', null, '', '', '', '50', '0', '1528860890');
INSERT INTO `xhl_xiangmu_cate` VALUES ('28', '26', 'CMS系统', '2', 'xiangmu', null, '', '', '', '50', '0', '1528860938');
INSERT INTO `xhl_xiangmu_cate` VALUES ('29', '26', '教育', '2', 'xiangmu', null, '', '', '', '50', '0', '1528860962');

-- ----------------------------
-- Table structure for `xhl_xiangmu_comment`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_comment`;
CREATE TABLE `xhl_xiangmu_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xiangmu_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `content` varchar(512) DEFAULT '',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  `dateline` int(10) DEFAULT '0',
  `reply` varchar(255) DEFAULT NULL,
  `replyip` varchar(255) DEFAULT NULL,
  `replytime` int(10) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_comment
-- ----------------------------
INSERT INTO `xhl_xiangmu_comment` VALUES ('7', '416', '1085', '12312312312', '0', '106.39.152.253', '1483691857', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('8', '418', '1087', '游戏游戏游戏游戏游戏', '1', '106.39.152.253', '1483693210', '12454545', null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('9', '418', '1087', '1111111111111111111111', '1', '106.39.152.253', '1483693390', '1111134444444444555555555555555', '106.39.152.253', '1483741959');
INSERT INTO `xhl_xiangmu_comment` VALUES ('10', '417', '1124', '呜呜呜呜', '0', '127.0.0.1', '1507628019', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('11', '417', '1124', '添加评论333333', '0', '127.0.0.1', '1507628034', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('12', '419', '1085', '添加评论呜呜呜', '0', '127.0.0.1', '1507628260', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('13', '447', '1127', '<p>112233c</p>', '0', '127.0.0.1', '1527647316', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('14', '447', '1127', '<p>cc</p>', '0', '127.0.0.1', '1527647381', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('15', '447', '1127', '<p>ceaaaaa</p>', '0', '127.0.0.1', '1527648468', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('16', '448', '1127', '<p>将军金甲夜不脱</p>', '0', '127.0.0.1', '1527761039', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('17', '447', '1127', '<p>很快很快会尽快还款&nbsp;</p>', '0', '127.0.0.1', '1527761077', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('18', '447', '1127', '<p>ccd</p>', '0', '127.0.0.1', '1527766873', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('19', '447', '1127', '<pre class=\"brush:php;toolbar:false\">&lt;?&nbsp;php\necho&nbsp;111;\n?&gt;</pre><p><br/></p>', '0', '127.0.0.1', '1528084915', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('20', '447', '1127', '<pre class=\"brush:html;toolbar:false\">&lt;b&gt;1&lt;/b&gt;</pre><p><br/></p>', '0', '127.0.0.1', '1528084999', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('21', '28', '1127', '<p>cac</p>', '0', '127.0.0.1', '1528108823', null, null, null);
INSERT INTO `xhl_xiangmu_comment` VALUES ('22', '452', '1127', '<p>现在分词是打发</p>', '0', '118.144.55.9', '1529056035', null, null, null);

-- ----------------------------
-- Table structure for `xhl_xiangmu_content`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_content`;
CREATE TABLE `xhl_xiangmu_content` (
  `content_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xiangmu_id` int(10) NOT NULL,
  `seo_title` varchar(150) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(255) DEFAULT '',
  `content` mediumtext,
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  PRIMARY KEY (`content_id`),
  KEY `article_id` (`xiangmu_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=459 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_content
-- ----------------------------
INSERT INTO `xhl_xiangmu_content` VALUES ('415', '416', '', '', '', '<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">江苏千米网络科技股份有限公司</span><br />\r\n<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">是一个专注于中小企业电商化运营之道的公司</span><br />\r\n<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">提供电商系统支撑，以及同客户携手探索行业最佳实践</span><br />\r\n<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">通过一站式SaaS电商解决方案</span><br />\r\n<span style=\"color:#333333;font-family:微软雅黑;font-size:18px;line-height:36px;background-color:#FFFFFF;\">帮助中小企业提升经营能力、作业效率及运营模式升级</span>', '106.39.152.253');
INSERT INTO `xhl_xiangmu_content` VALUES ('416', '417', '', '', '', '<p>\r\n	多城市数据统一\r\n</p>\r\n<p>\r\n	每个分站的会员和商家数据都在一套数据库，不再需要安装多套程序\r\n</p>\r\n<p>\r\n	外卖系统\r\n</p>\r\n<p>\r\n	类似饿了么、美团外卖等，本地O2O高频的领域\r\n</p>\r\n<p>\r\n	物流系统\r\n</p>\r\n<p>\r\n	网站运营者统一配送,商家或者商城的订单，可以请兼职或者全职人员来进行配送\r\n</p>\r\n<p>\r\n	商家粉丝系统\r\n</p>\r\n<p>\r\n	网站只需要关注过该商家的用户，商家可以随时随地向自己的粉丝推送自己最新的优惠信息;营销性可见强大\r\n</p>\r\n<p>\r\n	订座系统\r\n</p>\r\n<p>\r\n	解决了白领或者家庭聚餐定饭店的烦恼;提前搞定您的就餐需求，吃饭没烦恼!\r\n</p>\r\n<p>\r\n	团购系统\r\n</p>\r\n<p>\r\n	无团购不O2O，哪里实惠去哪里\r\n</p>\r\n<p>\r\n	评价系统\r\n</p>\r\n<p>\r\n	商家的信用体系十分完善，让消费者体验最真实的消费\r\n</p>\r\n<p>\r\n	优惠券系统\r\n</p>\r\n<p>\r\n	无优惠不消费，哪里有优惠，就哪里去消费\r\n</p>\r\n<p>\r\n	家政系统\r\n</p>\r\n<p>\r\n	类似于阿姨帮的家政功能，本地O2O一块比较大的蛋糕\r\n</p>\r\n<p>\r\n	商城系统\r\n</p>\r\n<p>\r\n	本地O2O重要一环，可以无限的延伸到各种本地O2O\r\n</p>\r\n<p>\r\n	同城信息\r\n</p>\r\n<p>\r\n	收集本地生活需求信息，流量飙升不是梦\r\n</p>\r\n<p>\r\n	多渠道支付\r\n</p>\r\n<p>\r\n	支付宝微信 网银在线 银联 财付通 余额支付，真正意义上的解决了客户支付问题\r\n</p>\r\n<p>\r\n	数据分析系统\r\n</p>\r\n<p>\r\n	强大的数据分析系统分析了网站的重要运营数据，让运营者一目了然\r\n</p>', '106.39.152.253');
INSERT INTO `xhl_xiangmu_content` VALUES ('417', '418', '', '关键词,关键词,关键词,关键词', '', '内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容', '106.39.152.253');
INSERT INTO `xhl_xiangmu_content` VALUES ('418', '419', '', '大', '', '未知未知未知未知未知未知未知', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('419', '422', '', '', '', '2', '118.144.55.190');
INSERT INTO `xhl_xiangmu_content` VALUES ('420', '424', '', '', '', '34', '118.144.55.190');
INSERT INTO `xhl_xiangmu_content` VALUES ('421', '426', '', '', '', '4', '118.144.55.190');
INSERT INTO `xhl_xiangmu_content` VALUES ('422', '427', '', '', '', '5', '118.144.55.190');
INSERT INTO `xhl_xiangmu_content` VALUES ('423', '428', '', '大大大大大大大大大', '', '大大大大大大大大大大大大 <br />', '118.144.55.190');
INSERT INTO `xhl_xiangmu_content` VALUES ('424', '429', '', '121', '', '121', '118.144.55.79');
INSERT INTO `xhl_xiangmu_content` VALUES ('425', '430', '', 'aaa', '', 'bbb', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('426', '431', '', '亮点', '', '项目介绍', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('427', '432', '', '心动项目亮点', '', '心动项目介绍', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('428', '433', '', '亮点', '', '项目介绍', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('429', '434', '', '亮点', '', '介绍', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('430', '435', '', '亮点222333344444', '', '项目介绍', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('431', '436', '', '正常亮点', '', '正常介绍', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('432', '437', '', '22', '', '22', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('433', '438', '', '33', '', '333', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('434', '439', '', '444', '', '444', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('435', '440', '', '555', '', '555', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('436', '441', '', '干点活亮点', '', '干点活', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('437', '442', '', '发送', '', '是的是的', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('438', '443', '', 'sdfsdf', '', 'sdfsd', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('439', '444', '', 'ld', '', 'jies', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('440', '445', '', '联动删除', '', '介绍删除', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('441', '446', '', '联动', '', '介绍', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('442', '447', '', '亮点', '', '<p>团的介绍2222</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('443', '448', '', '联动', '', '项目介绍', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('444', '449', '', '亮点介绍', '', '项目说明', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('445', '450', '', '3333333333333', '', '444444444444444``2', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('446', '451', '', '3333333333333', '', '444444444444444', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('447', '452', '', '555', '', '555', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('448', '453', '1', '2', '3', '内容', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('449', '454', '', '亮点说明', '', '<p>网站详细介绍</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('450', '455', '', '亮点', '', '<p>擦擦擦</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('451', '456', '', '22', '', '<p>33</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('452', '457', '', '23', '', '<p>ffff</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('453', '458', '', '33', '', '<p>的双丰收</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('454', '459', '', '1', '', '<p>4</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('455', '460', '', '3', '', '<p>444</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('456', '461', '', '请回答1988', '', '<hr/><p>请回答1988</p>', '127.0.0.1');
INSERT INTO `xhl_xiangmu_content` VALUES ('457', '462', '', '的郭德纲第三个', '', '<p>胜多负少的广东省高</p>', '118.144.55.9');
INSERT INTO `xhl_xiangmu_content` VALUES ('458', '463', '', '轻松建站的首选利器', '', '<h2 style=\"margin: 0px; padding: 0px; font-size: 12px; line-height: 22px; color: rgb(11, 102, 168); font-family: Tahoma, Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">DedeCMS内容管理系统软件简介</h2><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\">欢迎使用国内最专业的PHP网站内容管理系统-织梦内容管理系统，他将是您轻松建站的首选利器。采用XML名字空间风格核心模板：模板全部使用文件形式保存，对用户设计模板、网站升级转移均提供很大的便利，健壮的模板标签为站长DIY 自己的网站提供了强有力的支持。高效率标签缓存机制：允许对类同的标签进行缓存，在生成 HTML的时候，有利于提高系统反应速度，降低系统消耗的资源。模型与模块概念并存：在模型不能满足用户所有需求的情况下，DedeCMS推出一些互动的模块对系统进行补充，尽量满足用户的需求。众多的应用支持：为用户提供了各类网站建设的一体化解决方案，在本版本中，增加了分类、书库、黄页、圈子、问答等模块，补充一些用户的特殊要求。面向未来过渡：织梦团队的组建为织梦CMS的发展提供坚实的基础，在织梦团队未来的构想中，它以后将会具有更大的灵活性和稳定的性能。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><h2 style=\"margin: 0px; padding: 0px; font-size: 12px; line-height: 22px; color: rgb(11, 102, 168); font-family: Tahoma, Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">DedeCMS应用领域</h2><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\">DedeCMS最适合应用于以下领域：<br/>•企业网站，无论大型还是中小型企业，利用网络传递信息在一定程度上提高了办事的效率，提高企业的竞争力；<br/>•政府机关，通过建立政府门户，有利于各种信息和资源的整合，为政府和社会公众之间加强联系和沟通，从而使政府可以更快、更便捷、更有效开展工作；<br/>•教育机构，通过网络信息的引入，使得教育机构之间及教育机构内部和教育者之间进行信息传递，全面提升教育类网站的层面；<br/>•媒体机构，互联网这种新媒体已经强而有力的冲击了传统媒体，在这个演变过程中，各类媒体机构应对自己核心有一个重新认识和重新发展的过程，建立一个数字技术平台以适应数字化时代的需求；<br/>•行业网站，针对不同行业，强化内部的信息划分，体现行业的特色，网站含有行业的动态信息、产品、市场、技术、人才等信息，树立行业信息权威形象，为行业内产品供应链管理，提供实际的商业机会；<br/>•个人站长，兴趣为主导，建立各种题材新颖，内容丰富的网站，通过共同兴趣的信息交流，可以让您形成自己具有特色的用户圈，产生个人需求，并为其服务；<br/>•收费网站，内容收费类型的网站，用户可以在线提供产品销售，或者内容收费，简单清晰的盈利模式，确保您以最小的投资，取得最大的回报；</p><p><br/></p>', '127.0.0.1');

-- ----------------------------
-- Table structure for `xhl_xiangmu_exp`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_exp`;
CREATE TABLE `xhl_xiangmu_exp` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '项目经验文章id',
  `xiangmu_id` int(11) DEFAULT NULL COMMENT '项目id',
  `exp_title` varchar(100) DEFAULT NULL COMMENT '项目经验标题',
  `exp_content` text COMMENT '项目经验内容',
  `exp_look` int(11) DEFAULT NULL COMMENT '项目经验浏览量',
  `exp_money` int(11) DEFAULT NULL COMMENT '项目经验收费',
  `exp_time` int(11) DEFAULT NULL COMMENT '项目经验发表时间',
  `exp_state` int(11) DEFAULT NULL COMMENT '项目经验审核  1审核中2通过3审核未通过',
  PRIMARY KEY (`exp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_exp
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_xiangmu_faq`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_faq`;
CREATE TABLE `xhl_xiangmu_faq` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xiangmu_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `content` varchar(512) DEFAULT '',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  `dateline` int(10) DEFAULT '0',
  `reply` varchar(255) DEFAULT NULL,
  `replyip` varchar(255) DEFAULT NULL,
  `replytime` int(10) DEFAULT NULL,
  `parent_id` mediumint(8) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_faq
-- ----------------------------
INSERT INTO `xhl_xiangmu_faq` VALUES ('16', '447', '1131', '44', '<p>2222</p>', '0', '0.0.0.0', '1527738775', null, null, null, '0', '194');
INSERT INTO `xhl_xiangmu_faq` VALUES ('17', '447', '1127', '33', '<p>444</p>', '0', '0.0.0.0', '1527738899', null, null, null, '0', '239');
INSERT INTO `xhl_xiangmu_faq` VALUES ('18', '447', '1127', '22', '<p>66</p>', '0', '0.0.0.0', '1527739054', null, null, null, '0', '29');
INSERT INTO `xhl_xiangmu_faq` VALUES ('19', '447', '1127', '分', '<p>44444</p>', '0', '0.0.0.0', '1527745650', null, null, null, '0', '566');
INSERT INTO `xhl_xiangmu_faq` VALUES ('20', '447', '1127', '1二分法', '<p>防守打法</p>', '0', '0.0.0.0', '1527745729', null, null, null, '0', '219');
INSERT INTO `xhl_xiangmu_faq` VALUES ('21', '447', '1127', '放入大使馆', '<p>的身高多少</p>', '0', '0.0.0.0', '1527747014', null, null, null, '0', '20');
INSERT INTO `xhl_xiangmu_faq` VALUES ('22', '0', '1127', '', '<p>发送生防守打法</p>', '0', '0.0.0.0', '1527748696', null, null, null, '21', null);
INSERT INTO `xhl_xiangmu_faq` VALUES ('23', '0', '1127', '', '<p>撒打算</p>', '0', '0.0.0.0', '1527749108', null, null, null, '21', null);
INSERT INTO `xhl_xiangmu_faq` VALUES ('24', '0', '1127', '', '<p>了考核合格</p>', '0', '0.0.0.0', '1527750606', null, null, null, '21', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('25', '449', '1127', '发的郭德纲', '<p>的法国队</p>', '0', '0.0.0.0', '1527754167', null, null, null, '0', '7');
INSERT INTO `xhl_xiangmu_faq` VALUES ('26', '0', '1127', '', '<p>ww</p>', '0', '0.0.0.0', '1528109684', null, null, null, '0', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('27', '0', '1127', '', '<p>gdgdf</p>', '0', '0.0.0.0', '1528109873', null, null, null, '0', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('28', '0', '1127', '', '<p>adasdas</p>', '0', '0.0.0.0', '1528110112', null, null, null, '16', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('29', '0', '1127', '', '<p>12313</p>', '0', '0.0.0.0', '1528689693', null, null, null, '16', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('30', '0', '1127', '', '<p>让人</p>', '0', '0.0.0.0', '1528689724', null, null, null, '16', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('31', '0', '1127', '', '<p>lll</p>', '0', '0.0.0.0', '1528698774', null, null, null, '16', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('32', '0', '1127', '', '<p>2<br/></p>', '0', '0.0.0.0', '1528699355', null, null, null, '20', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('33', '452', '1131', '2342', '<p>4444</p>', '0', '0.0.0.0', '1528798812', null, null, null, '0', '6');
INSERT INTO `xhl_xiangmu_faq` VALUES ('34', '0', '1127', '', '<p>eeee</p>', '0', '0.0.0.0', '1528798845', null, null, null, '33', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('35', '0', '1127', '', '<p>&nbsp;&nbsp;&nbsp;&nbsp;qq<br/></p>', '0', '0.0.0.0', '1528798942', null, null, null, '16', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('36', '0', '1127', '', '<p>2222</p>', '0', '0.0.0.0', '1529055472', null, null, null, '16', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('37', '0', '1127', '', '<p>氧化亚铜</p>', '0', '0.0.0.0', '1529055986', null, null, null, '16', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('38', '450', '1127', '特特特吧', '<p>第三个风格</p>', '0', '0.0.0.0', '1529056439', null, null, null, '0', '2');
INSERT INTO `xhl_xiangmu_faq` VALUES ('39', '454', '1127', '尔特瑞股份', '<p>个发广告的风格地方</p>', '0', '0.0.0.0', '1529057683', null, null, null, '0', '26');
INSERT INTO `xhl_xiangmu_faq` VALUES ('40', '0', '1127', '', '<p>Z擦试生产sad</p>', '0', '0.0.0.0', '1529057742', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('41', '0', '1127', '', '<p>阿萨德撒的撒</p>', '0', '0.0.0.0', '1529057779', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('42', '0', '1127', '', '<p>阿萨德撒的撒</p>', '0', '0.0.0.0', '1529057779', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('43', '0', '1127', '', '<p>阿萨德撒的撒</p>', '0', '0.0.0.0', '1529057779', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('44', '0', '1127', '', '<p>反倒是</p>', '0', '0.0.0.0', '1529058047', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('45', '0', '1127', '', '<p>反倒是</p>', '0', '0.0.0.0', '1529058047', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('46', '0', '1127', '', '<p>擦擦擦上海</p>', '0', '0.0.0.0', '1529058097', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('47', '0', '1127', '', '<p>v</p>', '0', '0.0.0.0', '1529058140', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('48', '0', '1127', '', '<p>打的</p>', '0', '0.0.0.0', '1529058187', null, null, null, '17', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('49', '0', '1', '', '<p>哦if是司法考试</p>', '0', '0.0.0.0', '1529058246', null, null, null, '39', '0');
INSERT INTO `xhl_xiangmu_faq` VALUES ('50', '462', '1127', '程序包迟迟不', '<p>根深蒂固反倒是给对方</p>', '0', '0.0.0.0', '1529391009', null, null, null, '0', '4');
INSERT INTO `xhl_xiangmu_faq` VALUES ('51', '463', '1126', '如何修改自己的栏目', '<table width=\"95%\" align=\"center\"><tbody><tr class=\"firstRow\"><td style=\"line-height: 18px; font-size: 12px; word-wrap: break-word;\"><span style=\"color:#ff0000\">DedeCMS的栏目设置有相当丰富的参数，当然如果你想使用更简单些，你可以不理会多余的参数，只填写红色字提示的表单项即可，在介绍栏目管理操作之前，先把栏目操作的相关界面图片列出来，以便提升直观性。</span></td></tr></tbody></table><p style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; tex', '0', '0.0.0.0', '1532393977', null, null, null, '0', '4');
INSERT INTO `xhl_xiangmu_faq` VALUES ('52', '463', '1126', '如何html更新数据', '<p style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"color:#ff0000\">为了减轻网站负载，提高搜索引擎的友好度，DedeCMS大多数内容都需要生成HTML，一般的操作如下：<br/>1、发布内容', '0', '0.0.0.0', '1532397258', null, null, null, '0', '1');

-- ----------------------------
-- Table structure for `xhl_xiangmu_faq_collect`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_faq_collect`;
CREATE TABLE `xhl_xiangmu_faq_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) unsigned NOT NULL COMMENT '项目id',
  `uid` int(11) NOT NULL COMMENT '用户名id',
  `dateline` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_faq_collect
-- ----------------------------
INSERT INTO `xhl_xiangmu_faq_collect` VALUES ('72', '21', '1127', '1527750594');
INSERT INTO `xhl_xiangmu_faq_collect` VALUES ('74', '16', '1127', '1528109859');

-- ----------------------------
-- Table structure for `xhl_xiangmu_label`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_label`;
CREATE TABLE `xhl_xiangmu_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `labelid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_label
-- ----------------------------

-- ----------------------------
-- Table structure for `xhl_xiangmu_photo`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_photo`;
CREATE TABLE `xhl_xiangmu_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xiangmu_id` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo` varchar(150) DEFAULT '',
  `size` mediumint(8) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_photo
-- ----------------------------
INSERT INTO `xhl_xiangmu_photo` VALUES ('1', null, '项目图片', '', '36704', '1526872259');
INSERT INTO `xhl_xiangmu_photo` VALUES ('2', null, '项目图片', '', '124445', '1526872358');
INSERT INTO `xhl_xiangmu_photo` VALUES ('3', null, '项目图片', 'files/photo/201805/1526872406.png', '36704', '1526872406');
INSERT INTO `xhl_xiangmu_photo` VALUES ('4', null, '项目图片', 'files/photo/201805/1526872460.png', '36704', '1526872460');
INSERT INTO `xhl_xiangmu_photo` VALUES ('5', null, '项目图片', 'files/photo/201805/1526872491.png', '36704', '1526872491');
INSERT INTO `xhl_xiangmu_photo` VALUES ('6', null, '项目图片', 'files/photo/201805/1526872691.png', '36704', '1526872691');
INSERT INTO `xhl_xiangmu_photo` VALUES ('7', null, '项目图片', 'files/photo/201805/1526872713.png', '36704', '1526872713');
INSERT INTO `xhl_xiangmu_photo` VALUES ('8', null, '项目图片', 'files/photo/201805/1526872763.png', '36704', '1526872763');
INSERT INTO `xhl_xiangmu_photo` VALUES ('9', null, '项目图片', 'files/photo/201805/1526873082.png', '36704', '1526873082');
INSERT INTO `xhl_xiangmu_photo` VALUES ('10', null, '项目图片', 'files/photo/201805/1526873128.png', '36704', '1526873128');
INSERT INTO `xhl_xiangmu_photo` VALUES ('11', null, '项目图片', 'files/photo/201805/1526873160.png', '124445', '1526873160');
INSERT INTO `xhl_xiangmu_photo` VALUES ('12', null, '项目图片', 'files/photo/201805/1526873193.png', '36704', '1526873193');
INSERT INTO `xhl_xiangmu_photo` VALUES ('13', null, '项目图片', 'files/photo/201805/1526873314.png', '124445', '1526873314');
INSERT INTO `xhl_xiangmu_photo` VALUES ('14', null, '项目图片', 'files/photo/201805/1526873351.png', '124445', '1526873351');
INSERT INTO `xhl_xiangmu_photo` VALUES ('15', null, '项目图片', 'files/photo/201805/1526873362.png', '36704', '1526873362');
INSERT INTO `xhl_xiangmu_photo` VALUES ('16', null, '项目图片', 'files/photo/201805/1526873427.png', '36704', '1526873427');
INSERT INTO `xhl_xiangmu_photo` VALUES ('17', null, '项目图片', 'files/photo/201805/1526873775.png', '124445', '1526873775');
INSERT INTO `xhl_xiangmu_photo` VALUES ('18', null, '项目图片', 'files/photo/201805/1526873825.png', '124445', '1526873825');
INSERT INTO `xhl_xiangmu_photo` VALUES ('19', null, '项目图片', 'files/photo/201805/1526873925.png', '36704', '1526873925');
INSERT INTO `xhl_xiangmu_photo` VALUES ('20', null, '项目图片', 'files/photo/201805/1526873978.png', '36704', '1526873978');
INSERT INTO `xhl_xiangmu_photo` VALUES ('21', null, '项目图片', 'files/photo/201805/1526874530.png', '36704', '1526874530');
INSERT INTO `xhl_xiangmu_photo` VALUES ('22', null, '项目图片', 'files/photo/201805/1526874570.png', '36704', '1526874570');
INSERT INTO `xhl_xiangmu_photo` VALUES ('23', null, '项目图片', 'files/photo/201805/1526874572.png', '124445', '1526874572');
INSERT INTO `xhl_xiangmu_photo` VALUES ('24', null, '项目图片', 'files/photo/201805/1526875232.png', '36704', '1526875232');
INSERT INTO `xhl_xiangmu_photo` VALUES ('25', null, '项目图片', 'files/photo/201805/1526878703.png', '36704', '1526878703');
INSERT INTO `xhl_xiangmu_photo` VALUES ('26', null, '项目图片', 'files/photo/201805/1526879188.png', '36704', '1526879188');
INSERT INTO `xhl_xiangmu_photo` VALUES ('27', null, '项目图片', 'files/photo/201805/1526879770.png', '36704', '1526879770');
INSERT INTO `xhl_xiangmu_photo` VALUES ('28', null, '项目图片', 'files/photo/201805/1526879785.png', '124445', '1526879785');
INSERT INTO `xhl_xiangmu_photo` VALUES ('29', null, '项目图片', 'files/photo/201805/1526879899.png', '36704', '1526879899');
INSERT INTO `xhl_xiangmu_photo` VALUES ('30', null, '项目图片', 'files/photo/201805/1526879901.png', '124445', '1526879901');
INSERT INTO `xhl_xiangmu_photo` VALUES ('31', null, '项目图片', 'files/photo/201805/1526879968.png', '36704', '1526879968');
INSERT INTO `xhl_xiangmu_photo` VALUES ('32', null, '项目图片', 'files/photo/201805/1526879970.png', '124445', '1526879970');
INSERT INTO `xhl_xiangmu_photo` VALUES ('33', null, '项目图片', 'files/photo/201805/1526880059.png', '36704', '1526880059');
INSERT INTO `xhl_xiangmu_photo` VALUES ('34', null, '项目图片', 'files/photo/201805/1526880060.png', '124445', '1526880060');
INSERT INTO `xhl_xiangmu_photo` VALUES ('35', null, '项目图片', 'files/photo/201805/1526880716.png', '36704', '1526880716');
INSERT INTO `xhl_xiangmu_photo` VALUES ('36', null, '项目图片', 'files/photo/201805/1526880718.png', '124445', '1526880718');
INSERT INTO `xhl_xiangmu_photo` VALUES ('37', null, '项目图片', 'files/photo/201805/1526880947.png', '36704', '1526880947');
INSERT INTO `xhl_xiangmu_photo` VALUES ('38', null, '项目图片', 'files/photo/201805/1526880949.png', '124445', '1526880949');
INSERT INTO `xhl_xiangmu_photo` VALUES ('39', null, '项目图片', 'files/photo/201805/1526881105.png', '36704', '1526881105');
INSERT INTO `xhl_xiangmu_photo` VALUES ('40', null, '项目图片', 'files/photo/201805/1526881106.png', '124445', '1526881106');
INSERT INTO `xhl_xiangmu_photo` VALUES ('41', null, '项目图片', 'files/photo/201805/1526881193.png', '36704', '1526881193');
INSERT INTO `xhl_xiangmu_photo` VALUES ('42', null, '项目图片', 'files/photo/201805/1526881195.png', '124445', '1526881195');
INSERT INTO `xhl_xiangmu_photo` VALUES ('43', null, '项目图片', 'files/photo/201805/1526881247.png', '36704', '1526881247');
INSERT INTO `xhl_xiangmu_photo` VALUES ('44', null, '项目图片', 'files/photo/201805/1526881250.png', '124445', '1526881250');
INSERT INTO `xhl_xiangmu_photo` VALUES ('45', null, '项目图片', 'files/photo/201805/1526881432.png', '36704', '1526881432');
INSERT INTO `xhl_xiangmu_photo` VALUES ('46', null, '项目图片', 'files/photo/201805/1526881434.png', '124445', '1526881434');
INSERT INTO `xhl_xiangmu_photo` VALUES ('47', null, '项目图片', 'files/photo/201805/1526881506.png', '36704', '1526881506');
INSERT INTO `xhl_xiangmu_photo` VALUES ('48', null, '项目图片', 'files/photo/201805/1526881507.png', '124445', '1526881507');
INSERT INTO `xhl_xiangmu_photo` VALUES ('49', null, '项目图片', 'files/photo/201805/1526881560.png', '36704', '1526881560');
INSERT INTO `xhl_xiangmu_photo` VALUES ('50', null, '项目图片', 'files/photo/201805/1526881562.png', '124445', '1526881562');
INSERT INTO `xhl_xiangmu_photo` VALUES ('51', null, '项目图片', 'files/photo/201805/1526881868.png', '36704', '1526881868');
INSERT INTO `xhl_xiangmu_photo` VALUES ('52', null, '项目图片', 'files/photo/201805/1526881869.png', '124445', '1526881869');
INSERT INTO `xhl_xiangmu_photo` VALUES ('53', null, '项目图片', 'files/photo/201805/1526881977.png', '36704', '1526881977');
INSERT INTO `xhl_xiangmu_photo` VALUES ('54', null, '项目图片', 'files/photo/201805/1526881978.png', '124445', '1526881978');
INSERT INTO `xhl_xiangmu_photo` VALUES ('55', null, '项目图片', 'files/photo/201805/1526882107.png', '36704', '1526882107');
INSERT INTO `xhl_xiangmu_photo` VALUES ('56', null, '项目图片', 'files/photo/201805/1526882109.png', '124445', '1526882109');
INSERT INTO `xhl_xiangmu_photo` VALUES ('57', null, '项目图片', 'files/photo/201805/1526882212.png', '36704', '1526882212');
INSERT INTO `xhl_xiangmu_photo` VALUES ('58', null, '项目图片', 'files/photo/201805/1526882214.png', '124445', '1526882214');
INSERT INTO `xhl_xiangmu_photo` VALUES ('59', null, '项目图片', 'files/photo/201805/1526882342.png', '36704', '1526882342');
INSERT INTO `xhl_xiangmu_photo` VALUES ('60', null, '项目图片', 'files/photo/201805/1526882344.png', '124445', '1526882344');
INSERT INTO `xhl_xiangmu_photo` VALUES ('61', null, '项目图片', 'files/photo/201805/1526883951.png', '36704', '1526883951');
INSERT INTO `xhl_xiangmu_photo` VALUES ('62', null, '项目图片', 'files/photo/201805/1526884078.png', '124445', '1526884078');
INSERT INTO `xhl_xiangmu_photo` VALUES ('63', null, '项目图片', 'files/photo/201805/1526886016.png', '36704', '1526886016');
INSERT INTO `xhl_xiangmu_photo` VALUES ('64', null, '项目图片', 'files/photo/201805/1526886018.png', '124445', '1526886018');
INSERT INTO `xhl_xiangmu_photo` VALUES ('65', null, '项目图片', 'files/photo/201805/1526886289.png', '36704', '1526886289');
INSERT INTO `xhl_xiangmu_photo` VALUES ('66', null, '项目图片', 'files/photo/201805/1526886708.png', '124445', '1526886708');
INSERT INTO `xhl_xiangmu_photo` VALUES ('67', null, '项目图片', 'files/photo/201805/1526886711.png', '36704', '1526886711');
INSERT INTO `xhl_xiangmu_photo` VALUES ('68', null, '项目图片', 'files/photo/201805/1526888430.png', '36704', '1526888430');
INSERT INTO `xhl_xiangmu_photo` VALUES ('69', null, '项目图片', 'files/photo/201805/1526888434.png', '124445', '1526888434');
INSERT INTO `xhl_xiangmu_photo` VALUES ('70', null, '项目图片', 'files/photo/201805/1526890838.png', '36704', '1526890838');
INSERT INTO `xhl_xiangmu_photo` VALUES ('71', null, '项目图片', 'files/photo/201805/1526890839.png', '124445', '1526890840');
INSERT INTO `xhl_xiangmu_photo` VALUES ('72', null, '项目图片', 'files/photo/201805/1526891449.png', '36704', '1526891449');
INSERT INTO `xhl_xiangmu_photo` VALUES ('73', null, '项目图片', 'files/photo/201805/1526891451.png', '124445', '1526891451');
INSERT INTO `xhl_xiangmu_photo` VALUES ('74', null, '项目图片', 'files/photo/201805/1526891457.png', '36704', '1526891457');
INSERT INTO `xhl_xiangmu_photo` VALUES ('75', null, '项目图片', 'files/photo/201805/1526891459.png', '36704', '1526891459');
INSERT INTO `xhl_xiangmu_photo` VALUES ('76', null, '项目图片', 'files/photo/201805/1526891462.png', '36704', '1526891462');
INSERT INTO `xhl_xiangmu_photo` VALUES ('77', null, '项目图片', 'files/photo/201805/1526891467.png', '36704', '1526891467');
INSERT INTO `xhl_xiangmu_photo` VALUES ('78', null, '项目图片', 'files/photo/201805/1526891528.png', '36704', '1526891528');
INSERT INTO `xhl_xiangmu_photo` VALUES ('79', null, '项目图片', 'files/photo/201805/1526891530.png', '124445', '1526891530');
INSERT INTO `xhl_xiangmu_photo` VALUES ('80', null, '项目图片', 'files/photo/201805/1526891532.png', '36704', '1526891532');
INSERT INTO `xhl_xiangmu_photo` VALUES ('81', null, '项目图片', 'files/photo/201805/1526953870.png', '36704', '1526953870');
INSERT INTO `xhl_xiangmu_photo` VALUES ('82', null, '项目图片', 'files/photo/201805/1526955864.png', '36704', '1526955864');
INSERT INTO `xhl_xiangmu_photo` VALUES ('83', null, '项目图片', 'files/photo/201805/1526956261.png', '124445', '1526956261');
INSERT INTO `xhl_xiangmu_photo` VALUES ('84', null, '项目图片', 'files/photo/201805/1526956424.png', '36704', '1526956424');
INSERT INTO `xhl_xiangmu_photo` VALUES ('85', null, '项目图片', 'files/photo/201805/1526956472.png', '36704', '1526956472');
INSERT INTO `xhl_xiangmu_photo` VALUES ('86', null, '项目图片', 'files/photo/201805/1526956780.png', '36704', '1526956780');
INSERT INTO `xhl_xiangmu_photo` VALUES ('87', null, '项目图片', 'files/photo/201805/1526958190.png', '36704', '1526958190');
INSERT INTO `xhl_xiangmu_photo` VALUES ('88', null, '项目图片', 'files/photo/201805/1526958340.png', '124445', '1526958340');
INSERT INTO `xhl_xiangmu_photo` VALUES ('89', null, '项目图片', 'files/photo/201805/1526958350.png', '36704', '1526958350');
INSERT INTO `xhl_xiangmu_photo` VALUES ('90', null, '项目图片', 'files/photo/201805/1526958676.png', '124445', '1526958676');
INSERT INTO `xhl_xiangmu_photo` VALUES ('91', null, '项目图片', 'files/photo/201805/1526958821.png', '36704', '1526958821');
INSERT INTO `xhl_xiangmu_photo` VALUES ('92', null, '项目图片', 'files/photo/201805/1526958880.png', '36704', '1526958880');
INSERT INTO `xhl_xiangmu_photo` VALUES ('93', null, '项目图片', 'files/photo/201805/1526958899.png', '36704', '1526958899');
INSERT INTO `xhl_xiangmu_photo` VALUES ('94', null, '项目图片', 'files/photo/201805/1526958930.png', '36704', '1526958930');
INSERT INTO `xhl_xiangmu_photo` VALUES ('95', null, '项目图片', 'files/photo/201805/1526958949.png', '124445', '1526958949');
INSERT INTO `xhl_xiangmu_photo` VALUES ('96', null, '项目图片', 'files/photo/201805/1526959041.png', '124445', '1526959041');
INSERT INTO `xhl_xiangmu_photo` VALUES ('97', null, '项目图片', 'files/photo/201805/1526959054.png', '36704', '1526959054');
INSERT INTO `xhl_xiangmu_photo` VALUES ('98', null, '项目图片', 'files/photo/201805/1526959118.png', '36704', '1526959118');
INSERT INTO `xhl_xiangmu_photo` VALUES ('99', null, '项目图片', 'files/photo/201805/1526959186.png', '36704', '1526959186');
INSERT INTO `xhl_xiangmu_photo` VALUES ('100', null, '项目图片', 'files/photo/201805/1526959202.png', '124445', '1526959202');
INSERT INTO `xhl_xiangmu_photo` VALUES ('101', null, '项目图片', 'files/photo/201805/1526959296.png', '36704', '1526959296');
INSERT INTO `xhl_xiangmu_photo` VALUES ('102', null, '项目图片', 'files/photo/201805/1526959309.png', '36704', '1526959309');
INSERT INTO `xhl_xiangmu_photo` VALUES ('103', null, '项目图片', 'files/photo/201805/1526959387.png', '36704', '1526959387');
INSERT INTO `xhl_xiangmu_photo` VALUES ('104', null, '项目图片', 'files/photo/201805/1526959425.png', '36704', '1526959425');
INSERT INTO `xhl_xiangmu_photo` VALUES ('105', null, '项目图片', 'files/photo/201805/1526959428.png', '124445', '1526959428');
INSERT INTO `xhl_xiangmu_photo` VALUES ('106', null, '项目图片', 'files/photo/201805/1526959530.png', '36704', '1526959530');
INSERT INTO `xhl_xiangmu_photo` VALUES ('107', null, '项目图片', 'files/photo/201805/1526959615.png', '36704', '1526959615');
INSERT INTO `xhl_xiangmu_photo` VALUES ('108', null, '项目图片', 'files/photo/201805/1526959616.png', '124445', '1526959616');
INSERT INTO `xhl_xiangmu_photo` VALUES ('109', null, '项目图片', 'files/photo/201805/1526959620.png', '36704', '1526959620');
INSERT INTO `xhl_xiangmu_photo` VALUES ('110', null, '项目图片', 'files/photo/201805/1526959964.png', '36704', '1526959964');
INSERT INTO `xhl_xiangmu_photo` VALUES ('111', null, '项目图片', 'files/photo/201805/1526959965.png', '36704', '1526959965');
INSERT INTO `xhl_xiangmu_photo` VALUES ('112', null, '项目图片', 'files/photo/201805/1526959967.png', '36704', '1526959967');
INSERT INTO `xhl_xiangmu_photo` VALUES ('113', null, '项目图片', 'files/photo/201805/1526959970.png', '36704', '1526959970');
INSERT INTO `xhl_xiangmu_photo` VALUES ('114', null, '项目图片', 'files/photo/201805/1526959972.png', '36704', '1526959972');
INSERT INTO `xhl_xiangmu_photo` VALUES ('115', null, '项目图片', 'files/photo/201805/1526961049.png', '36704', '1526961049');
INSERT INTO `xhl_xiangmu_photo` VALUES ('116', null, '项目图片', 'files/photo/201805/1526961056.png', '36704', '1526961056');
INSERT INTO `xhl_xiangmu_photo` VALUES ('117', null, '项目图片', 'files/photo/201805/1526961058.png', '124445', '1526961058');
INSERT INTO `xhl_xiangmu_photo` VALUES ('118', null, '项目图片', 'files/photo/201805/1526961063.png', '124445', '1526961063');
INSERT INTO `xhl_xiangmu_photo` VALUES ('119', null, '项目图片', 'files/photo/201805/1526961063.png', '36704', '1526961063');
INSERT INTO `xhl_xiangmu_photo` VALUES ('120', null, '项目图片', 'files/photo/201805/1526969820.png', '36704', '1526969820');
INSERT INTO `xhl_xiangmu_photo` VALUES ('121', null, '项目图片', 'files/photo/201805/1526969823.png', '124445', '1526969823');
INSERT INTO `xhl_xiangmu_photo` VALUES ('122', null, '项目图片', 'files/photo/201805/1526969863.png', '36704', '1526969863');
INSERT INTO `xhl_xiangmu_photo` VALUES ('123', null, '项目图片', 'files/photo/201805/1526969865.png', '36704', '1526969865');
INSERT INTO `xhl_xiangmu_photo` VALUES ('124', null, '项目图片', 'files/photo/201805/1527133938.rar', '99135', '1527133938');
INSERT INTO `xhl_xiangmu_photo` VALUES ('125', null, '项目图片', 'files/photo/201805/1527134174.png', '124445', '1527134174');
INSERT INTO `xhl_xiangmu_photo` VALUES ('126', null, '项目图片', 'files/photo/201805/1527134204.rar', '99135', '1527134204');
INSERT INTO `xhl_xiangmu_photo` VALUES ('127', null, '项目图片', 'files/photo/201805/1527134381.png', '36704', '1527134381');
INSERT INTO `xhl_xiangmu_photo` VALUES ('128', null, '项目图片', 'files/photo/201805/1527134383.png', '36704', '1527134383');
INSERT INTO `xhl_xiangmu_photo` VALUES ('129', null, '项目图片', 'files/photo/201805/1527216141.png', '36704', '1527216141');
INSERT INTO `xhl_xiangmu_photo` VALUES ('130', null, '项目图片', 'files/photo/201805/1527216168.png', '36704', '1527216168');
INSERT INTO `xhl_xiangmu_photo` VALUES ('131', null, '项目图片', 'files/photo/201805/1527216431.png', '36704', '1527216431');
INSERT INTO `xhl_xiangmu_photo` VALUES ('132', null, '项目图片', 'files/photo/201806/1528438048.png', '124445', '1528438048');
INSERT INTO `xhl_xiangmu_photo` VALUES ('133', null, '项目图片', 'files/photo/201806/1528438063.png', '36704', '1528438063');
INSERT INTO `xhl_xiangmu_photo` VALUES ('134', null, '项目图片', 'files/photo/201806/1528880140.jpg', '18658', '1528880140');
INSERT INTO `xhl_xiangmu_photo` VALUES ('135', null, '项目图片', 'files/photo/201806/1528880143.jpg', '30131', '1528880143');
INSERT INTO `xhl_xiangmu_photo` VALUES ('136', null, '项目图片', 'files/photo/201806/1528881980.jpg', '18658', '1528881980');
INSERT INTO `xhl_xiangmu_photo` VALUES ('137', null, '项目图片', 'files/photo/201806/1528881985.jpg', '31577', '1528881986');
INSERT INTO `xhl_xiangmu_photo` VALUES ('138', null, '项目图片', 'files/photo/201806/1528882046.jpg', '31577', '1528882046');
INSERT INTO `xhl_xiangmu_photo` VALUES ('139', null, '项目图片', 'files/photo/201806/1528882048.jpg', '18658', '1528882048');
INSERT INTO `xhl_xiangmu_photo` VALUES ('140', null, '项目图片', 'files/photo/201807/1532342867.jpg', '48080', '1532342868');

-- ----------------------------
-- Table structure for `xhl_xiangmu_project`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_project`;
CREATE TABLE `xhl_xiangmu_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '方案id',
  `xiangmu_id` int(11) DEFAULT NULL COMMENT '对应项目id',
  `project_title` varchar(20) DEFAULT NULL COMMENT '对应项目title',
  `project_content` text COMMENT '项目内容',
  `project_mobile` varchar(20) DEFAULT NULL COMMENT '手机号',
  `project_email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `project_img` varchar(200) DEFAULT NULL COMMENT '项目缩略图',
  `project_dateline` varchar(255) DEFAULT NULL COMMENT '日期',
  `closed` int(5) DEFAULT '1',
  `project_url` varchar(255) DEFAULT NULL COMMENT '附件地址url',
  `views` mediumint(8) DEFAULT '1',
  `uid` int(10) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1' COMMENT '状态 1 正常 2 隐藏',
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_project
-- ----------------------------
INSERT INTO `xhl_xiangmu_project` VALUES ('3', '461', 'lkui', '1111', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_1B882848B02A20C16311744B0E2051B9.png', '1507691031', '1', null, '3', '1127', '2');
INSERT INTO `xhl_xiangmu_project` VALUES ('4', '447', 'www', '11111111', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_212318AAC340356DEF8B80A9C6C3A1D7.png', '1507697405', '1', null, '3', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('5', '447', '11', '11111', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_3DAA4A1E151FB2743F63E992EDE62CC7.png', '1507697551', '1', null, '2', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('7', '447', '222222233333333333', '4444444444444', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_2A7E01C6EDD98C641BE92FEE8522C2A0.png', '1507706173', '1', null, '1', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('8', '447', '7777777777', '88888888', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_7C4778F025FF6865C4A236BAAD998787.png', '1507706970', '1', null, '2', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('9', '447', '测试1', '<span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span><span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span><span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span><span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span><span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span><span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span>', '18204718777', '532031004@qq.com', 'photo/201801/20180122_0C40CF965093345E5B8DA36A4C295A10.gif', '1516607247', '1', null, '3', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('10', '447', '测试2', '<span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span><span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span><span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span><span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">团队用户任务负责</span>', '18204718888', '532031004@qq.com', 'photo/201801/20180122_0C40CF965093345E5B8DA36A4C295A10.gif', '1516607584', '1', null, '1', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('11', '447', '1', '1', null, null, null, '1527038720', '1', null, '1', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('12', '447', '23132', '312321', null, null, null, '1527038720', '1', null, '1', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('13', '447', '23132', '312321', null, null, null, '1516607584', '1', null, '3', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('14', '447', '项目标签', '项目内容', null, null, null, '1527055325', '1', null, '1', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('15', '447', 'ccccc', '', null, null, null, '1527056468', '1', null, '1', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('16', '449', 'ccccc', 'ddddd', null, null, null, '1507697551', '1', null, '7', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('17', '448', '1231231', '132123123132', null, null, null, '1527133340', '1', null, '2', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('19', '448', '1', '2', null, null, null, '1527039880', '1', null, '1', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('20', '448', '2222', '2222', null, null, null, '1527055325', '1', null, '3', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('21', '447', '333', '4444', null, null, null, '1527056468', '1', null, '17', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('27', '447', '测试111222', '测试111222', null, null, null, '1527129904', '1', 'files/photo/201805/1527130102.rar', '25', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('28', '447', '百度文本编辑器1', '<p>111222</p>', null, null, null, '1527133340', '1', 'files/photo/201805/1527133340.docx', '149', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('30', '447', '测试', '<p>简述</p>', null, null, null, '1528784796', '0', null, '15', '1131', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('32', '455', '测试', '<p>222</p>', null, null, null, '1528880809', '1', null, '4', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('31', '450', '干点活测', '<p>啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊</p>', null, null, null, '1528791899', '0', null, '6', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('33', '455', '同意', '<p>好的</p>', null, null, null, '1528881559', '0', null, '8', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('34', '455', '222', '<p>333</p>', null, null, null, '1528881599', '0', null, '3', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('35', '447', '3', '<p>4</p>', null, null, null, '1528881926', '1', null, '42', '1131', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('36', '458', '3221', '<p>4123</p>', null, null, null, '1528882097', '1', null, '2', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('37', '458', '请回答', '<p>12313</p>', null, null, null, '1528882249', '0', null, '6', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('38', '457', '12', '<p>123</p>', null, null, null, '1528882275', '1', null, '2', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('39', '447', 'nanye', '<p>nanye</p>', null, null, null, '1529054118', '1', null, '11', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('42', '450', '突然有人要投入和', '<p>挺好挺好认</p>', null, null, null, '1529055933', '1', 'files/photo/201806/1529055933.jpg', '10', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('46', '454', 'o大家都在发大家都在发斗图应答', '<p>的过分过分了看见的路口监控</p>', null, null, null, '1529388543', '1', 'files/photo/201806/1529388543.jpg', '5', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('44', '454', '二维', '<p>胜多负少的股份</p>', null, null, null, '1529057606', '1', 'files/photo/201806/1529057606.jpg', '11', '1127', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('47', '463', 'DedeCMS简介-DedeCMS V5', '<p><strong style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">DedeCMS简介：</strong><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">织梦内容管理系统(DedeCMS)是国内最流行的CMS解决方案之一，基于现时最流行的LAMP架构开发，具有很强的可扩展性，并且完全开放源代码。自从发布以来，DedeCMS就一直以简单易用，灵活扩展而闻名，目前已有超过十万个站点正在使用本系统。基于3.5代架构的DedeCMS V5.3版本，在扩展性方便更加突出，具有如下的特点：</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　1、主信息使用微表进行索引，从而杜绝单一主表效率低下的缺点，又保留其方便信息集中调用的优点；</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　2、全新的勾子技术，使DedeCMS里的标签与特定格式的文件存在一一对应关系，这意味着如果要增加一个系统调用标签，只需把相应该格式的文件放在指定文件夹即可，大大提高程序的扩展性；</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　3、解析式引擎与编译式引擎并存，由于在生成HTML时，解析式引擎拥有具大的优势，但对于动态浏览的互动性质的页面，编译式引擎更实用高效，织梦CMS采用双引擎并存的模式，在保持标签风格一致性的同时，也保证将来开发更多互动模块时有更好的性能；</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　4、完全开放源码，简洁、稳定的内核为高级用户进行二次开发提供了一个更实用健壮的平台；</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　5、经过严格审核的前台源码，更合理的目录结构，确保你的网站具有更高的安全性；</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　6、改进的采集系统在增强易用性的同时，还提供了各种更人性化的选项；</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　7、灵活的栏目交叉技术，为你在做IT数码、地方资讯、多级机构等站点时对内容进行交叉提供更大的便利性。</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　8、会员系统允许用户在精简模式与全功能模式中作选择，对于个别仅需要简单投稿功能的网站，采用精简版能降低互动程序本身具有的风险性。</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">　　9、强大的模块安装功能，使用户开发的模块、插件都能更简单的安装到你的系统上，并可以轻松的卸载，不影响主系统的使用。</span></p><hr/><p><strong style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">使用手册更新</strong><br/></p><hr/><p><strong style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">DEDE文档团队</strong><br/>寂寞天涯<span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">&nbsp;</span>自由心<span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">&nbsp;</span>天工开物<br/><br/><strong style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">手册说明：</strong><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">1、本手册由DedeCMS官方发起编写，但允许用户对相关内容进行补充，我们会定期把用户的意见、经验或常见问题的FAQ收录到本手册中；</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">2、本手册适用于DedeCMS V5.3 以上版本，部份功能也适用于V5.1或更低的版本；</span><br/><span style=\"color: rgb(0, 0, 0); font-family: 宋体, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">3、本手册所有内容版权归织梦官方所有，但允许第三方无条件进行任意转载。</span></p><p><br/></p>', null, null, null, '1532393128', '1', null, '1', '1126', '1');
INSERT INTO `xhl_xiangmu_project` VALUES ('48', '463', '安装配置', '<ul class=\" list-paddingleft-2\"><li style=\"\"><p>系统环境需求及注意事项：</p></li><li style=\"\"><table><tbody><tr class=\"firstRow\"><td style=\"line-height: 18px; font-size: 12px;\"><p>DedeCMS 居于PHP和MySQL技术开发，可同时使用于Windows、Linux、Unix平台，环境需求如下：</p><p><strong>1、Windows 平台：</strong><br/>IIS/Apache + PHP4/PHP5 + MySQL4/5<br/>如果在windows环境中使用，建议用DedeCMS提供的DedeAMPZ套件以达到最佳使用性能。</p><p><strong>2、Linux/Unix 平台</strong><br/>Apache + PHP4/PHP5 + MySQL3/4/5 (PHP必须在非安全模式下运行)</p><p>建议使用平台：Linux + Apache2.2 + PHP5.2 + MySQL5.0</p><p><strong>3、PHP必须环境或启用的系统函数：<br/></strong>allow_url_fopen<br/>GD扩展库<br/>MySQL扩展库<br/>系统函数 —— phpinfo、dir</p><p><strong>4、基本目录结构</strong><br/>/<br/>..../install&nbsp;&nbsp;&nbsp;&nbsp; 安装程序目录，安装完后可删除[安装时必须有可写入权限]<br/>..../dede&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 默认后台管理目录（可任意改名）<br/>..../include&nbsp;&nbsp;&nbsp;&nbsp; 类库文件目录<br/>..../plus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 附助程序目录<br/>..../member&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 会员目录<br/>..../images&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 系统默认模板图片存放目录<br/>..../uploads&nbsp;&nbsp;&nbsp;&nbsp; 默认上传目录[必须可写入]<br/>..../html&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 默认HTML文件存放目录[必须可写入]<br/>..../templets&nbsp;&nbsp;&nbsp; 系统默认内核模板目录<br/>..../data&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 系统缓存或其它可写入数据存放目录[必须可写入]<br/>..../special&nbsp;&nbsp;&nbsp;&nbsp; 专题目录[生成一次专题后可以删除special/index.php，必须可写入]</p><p><strong>5、PHP环境容易碰到的不兼容性问题</strong><br/>(1) data目录没写入权限，导致系统session无法使用，这将导致无法登录管理后台（直接表现为验证码不能正常显示）；<br/>(2) php的上传的临时文件夹没设置好或没写入权限，这会导致文件上传的功能无法使用；<br/>(3) 出现莫名的错误，如安装时显示空白，这样能是由于系统没装载mysql扩展导致的，对于初级用户，可以下载dede的php套件包，以方便简单的使用。<br/></p><p>&nbsp;</p></td></tr></tbody></table></li></ul><ul class=\" list-paddingleft-2\"><li style=\"\"><p>Win平台使用DedeAMPZ快速安装：</p></li><li style=\"\"><table><tbody><tr class=\"firstRow\"><td style=\"line-height: 18px; font-size: 12px;\"><p>DedeAMPZ 是快速配置php+mysql环境的一个整合套件，包含php5.2、Apache2.2、MySql5，下载地址：&nbsp;<br/>http://www.dedecms.com/html/chanpinxiazai/20080905/39481.html&nbsp;<br/>对于没经验的用户，下载 [服务器环境使用版] 版本。&nbsp;<br/>DedeAMPZ 的安装过程十分简单：&nbsp;<br/></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p><strong>根据使用过本软件的用户反映的情况，有部份用户可能会遇到下面的问题：</strong></p><p>1、在点击“点击安装”按钮在最后一步时可能会提示指定控件不存在的错误，那是因为有些盗版的操作系统禁用了一些组件，不过这不会影响软件的正常使用，仅是无法创建桌面图标而已，可以手工点击“DedeAMPZ.exe”运行客户端；</p><p>2、在安装DedeCMS的时候，数据库名称随意填写，不过要选择“自动创建”的选项。</p><p>&nbsp;</p></td></tr></tbody></table></li></ul><p><br/></p>', null, null, null, '1532393490', '1', null, '5', '1126', '1');

-- ----------------------------
-- Table structure for `xhl_xiangmu_project_collect`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_project_collect`;
CREATE TABLE `xhl_xiangmu_project_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) unsigned NOT NULL COMMENT '项目id',
  `uid` int(11) NOT NULL COMMENT '用户名id',
  `dateline` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_project_collect
-- ----------------------------
INSERT INTO `xhl_xiangmu_project_collect` VALUES ('66', '27', '1127', '1527667094');
INSERT INTO `xhl_xiangmu_project_collect` VALUES ('67', '27', '1122', '1527667094');

-- ----------------------------
-- Table structure for `xhl_xiangmu_project_comment`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_project_comment`;
CREATE TABLE `xhl_xiangmu_project_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `content` text,
  `closed` tinyint(1) DEFAULT '1',
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_project_comment
-- ----------------------------
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('25', '27', '1127', '<p>111<br/></p>', '1', '0.0.0.0', '1527664162');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('26', '27', '1127', '<p>3333</p>', '1', '0.0.0.0', '1527664188');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('27', '27', '1127', '<p>不错!很棒</p>', '1', '0.0.0.0', '1527664220');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('28', '27', '1127', '<p>12122</p>', '1', '0.0.0.0', '1527667145');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('29', '28', '1127', '<p>订单</p>', '1', '0.0.0.0', '1527667150');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('30', '28', '1127', '<p>休息休息</p>', '1', '0.0.0.0', '1527667223');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('31', '28', '1127', '<p>qwqw</p>', '1', '0.0.0.0', '1528109273');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('32', '31', '1127', '<p>1<br/></p>', '1', '0.0.0.0', '1528791994');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('33', '30', '1131', '<p>xxx</p>', '1', '0.0.0.0', '1528798952');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('34', '39', '1127', '<p>222</p>', '1', '0.0.0.0', '1529054366');
INSERT INTO `xhl_xiangmu_project_comment` VALUES ('35', '39', '1127', '<p>发广告黄飞鸿</p>', '1', '0.0.0.0', '1529055972');

-- ----------------------------
-- Table structure for `xhl_xiangmu_sheji`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_sheji`;
CREATE TABLE `xhl_xiangmu_sheji` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `xiangmu_id` int(11) unsigned NOT NULL COMMENT '项目id',
  `uid` int(11) NOT NULL COMMENT '用户名id',
  `dateline` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_sheji
-- ----------------------------
INSERT INTO `xhl_xiangmu_sheji` VALUES ('62', '447', '1127', '1529489700');
INSERT INTO `xhl_xiangmu_sheji` VALUES ('60', '454', '1127', '1529057733');

-- ----------------------------
-- Table structure for `xhl_xiangmu_team`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_team`;
CREATE TABLE `xhl_xiangmu_team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '团队id',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `team_name` varchar(20) DEFAULT NULL COMMENT '团队用户name',
  `team_task` text COMMENT '团队用户任务负责',
  `team_mobile` varchar(20) DEFAULT NULL COMMENT '团队用户手机号',
  `team_email` varchar(50) DEFAULT NULL COMMENT '团队用户邮箱',
  `team_img` varchar(200) DEFAULT NULL COMMENT '团队用户头像',
  `team_dateline` varchar(255) DEFAULT NULL,
  `team_position` varchar(200) DEFAULT NULL COMMENT '职位',
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xhl_xiangmu_team
-- ----------------------------
INSERT INTO `xhl_xiangmu_team` VALUES ('3', '1124', 'lkui', '1111', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_1B882848B02A20C16311744B0E2051B9.png', '1507691031', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('4', '1124', 'www', '11111111', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_212318AAC340356DEF8B80A9C6C3A1D7.png', '1507697405', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('5', '1124', '11', '11111', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_3DAA4A1E151FB2743F63E992EDE62CC7.png', '1507697551', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('7', '1124', '222222233333333333', '4444444444444', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_2A7E01C6EDD98C641BE92FEE8522C2A0.png', '1507706173', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('8', '1124', '7777777777', '88888888', '15101573480', '1062329969@qq.com', 'photo/201710/20171011_7C4778F025FF6865C4A236BAAD998787.png', '1507706970', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('9', '1127', '图图', null, null, null, 'photo/201806/20180601_E3389F94897364504E7292C09B8D7CD7.png', '1522577857', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('10', '1127', '团队', '<span><span style=\"background-color:#FFFFFF;\">sdsss</span></span>', '18204718777', '532031004@qq.com', 'photo/201805/20180530_695469A46E04D821E1C657D339A4F9CC.png', '1522737534', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('11', '1127', '傅鹏宇', '借助三维软件进行制作游戏数字资产，依托游戏引擎，由程序员编写代码最后 在各个平台发布的整个过程。游戏开发：游戏引擎、三维软件', '12312312311', '', 'photo/201805/20180530_695469A46E04D821E1C657D339A4F9CC.png', '1527673004', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('12', '1127', '111', '44', '22', '33', 'photo/201806/20180601_E3389F94897364504E7292C09B8D7CD7.png', '1527753172', null);
INSERT INTO `xhl_xiangmu_team` VALUES ('13', '1127', '干点活', 'lamp', '13141472661', '', 'photo/201806/20180601_E3389F94897364504E7292C09B8D7CD7.png', '1527840072', null);

-- ----------------------------
-- Table structure for `xhl_xiangmu_team_group`
-- ----------------------------
DROP TABLE IF EXISTS `xhl_xiangmu_team_group`;
CREATE TABLE `xhl_xiangmu_team_group` (
  `team_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `uid` int(10) DEFAULT NULL COMMENT '用户id',
  `xiangmu_id` int(10) DEFAULT NULL COMMENT '项目id',
  `dateline` int(11) DEFAULT NULL COMMENT '添加时间',
  `ischeck` tinyint(10) DEFAULT '0' COMMENT '团员是否验证 1 已审核 0 未审核',
  `name` varchar(255) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='项目团队成员申请表';

-- ----------------------------
-- Records of xhl_xiangmu_team_group
-- ----------------------------
INSERT INTO `xhl_xiangmu_team_group` VALUES ('17', '1131', '449', '1529027167', '0', 'ce', 'ss', 'dff');
INSERT INTO `xhl_xiangmu_team_group` VALUES ('18', '1127', '448', '1529055771', '0', '南野', 'php工程师', '驱蚊器翁群无额');
