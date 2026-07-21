/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: archx_01
-- ------------------------------------------------------
-- Server version	10.11.18-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `archx_01`
--


--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT '',
  `approved` enum('1') DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`category_id`, `user_id`, `category`, `approved`) VALUES (1,NULL,'Residential','1'),
(2,NULL,'Commercial','1'),
(3,NULL,'office',NULL),
(4,NULL,'skyscraper',NULL),
(5,NULL,'museum',NULL),
(6,NULL,'airport',NULL),
(7,NULL,'monument',NULL),
(8,NULL,'historical',NULL),
(9,NULL,'institutional',NULL),
(10,NULL,'hospitality',NULL),
(11,NULL,'educational',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `comment_id` int(12) NOT NULL AUTO_INCREMENT,
  `parent_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `type` int(2) NOT NULL DEFAULT 0,
  `comment` text NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`comment_id`),
  KEY `project_id` (`parent_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`comment_id`, `parent_id`, `user_id`, `type`, `comment`, `stamp`) VALUES (1,1,100022,1,'This is the first test comment. This is a great museum, isn&#039;t it! (2)','2006-05-04 09:03:38'),
(2,1,100022,1,'No it&#039;s not a great museum, it&#039;s pretty bad. What is this museum look like anyways? Wasn&#039;t this a Kahn building? I don&#039;t remember. Can someone post the correct architect and location for this building?','2006-05-04 09:05:46'),
(3,3,100022,1,'This is bulshit! there are no cantilevers! except for the roof overhang. Get a life Edward :)','2006-05-08 04:26:53'),
(4,6,100022,1,'This is a test comment','2006-05-10 02:50:03'),
(5,12,100022,1,'this is the first comment','2006-05-17 01:00:44'),
(6,13,100022,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','2006-05-17 01:01:54'),
(7,8,0,1,'thi sis a teat;lkj; ad;f asdf','2006-05-24 22:50:07'),
(8,14,100022,1,'this is a test comment','2006-05-29 04:04:48'),
(9,1,0,1,'','2006-06-03 03:44:13'),
(10,1,0,1,'','2006-06-03 03:44:21'),
(11,1,0,1,'','2006-06-03 03:47:05'),
(12,1,0,1,'','2006-06-03 04:13:12'),
(13,10028,0,1,'','2006-06-03 04:21:33'),
(14,10028,0,3,'this is atest comment for team architect 10028','2006-06-03 04:27:38'),
(15,10028,0,3,'and another test comment','2006-06-03 04:27:52'),
(16,9,0,1,'test comment','2006-06-03 04:45:19'),
(17,3,100022,0,'I think this should be called The Chrysler Building','2006-06-07 04:22:46'),
(18,10029,100022,3,'This guy is not an architect! and there is no landscaping on this building!','2006-06-08 06:12:47'),
(19,9,100022,1,'another test comment, yes again!','2006-06-08 06:13:56'),
(20,3,100022,0,'really that is a good idea. i second that motion. yeah...ok......yeah....see you later.','2006-06-11 04:26:53'),
(21,22,100022,0,'NO.......','2006-06-11 04:27:49'),
(22,1,0,0,'Is office a category? or is this commercial?','2006-06-12 15:10:33'),
(23,1,0,7,'great buildings suck, archxchange is way better!','2006-06-12 15:46:48'),
(24,29,100022,1,'Yes that is a beautiful house! Hey we have to come and visit some day. Obviously this is not the type of comments that would go here. So you should vote No to have it removed. It is a democratic system, if enough people vote no for some element of the proejct, it will eventually be hidden.','2006-06-20 05:44:11'),
(25,33,100022,1,'I think it actually does have a dash','2006-07-16 18:57:35'),
(26,9,100022,3,'no I think public','2006-07-16 18:59:16'),
(27,7,0,4,'What was this person thinking!','2007-01-19 01:13:42'),
(28,9,0,3,'test','2009-12-14 23:07:15'),
(29,8,0,3,'test','2009-12-14 23:07:24'),
(30,8,0,3,'test','2009-12-14 23:07:29'),
(31,10,0,3,'WTF! This Science. What are you thinking.. You call yourself an architect','2009-12-14 23:22:43'),
(32,10,100022,3,'test','2009-12-15 01:38:54'),
(33,16,0,3,'What are you thinking... This is not a museum. That&#039;s across the street.','2022-02-25 23:31:43');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(64) NOT NULL DEFAULT '',
  `country_iso_code_2` char(2) NOT NULL DEFAULT '',
  `country_iso_code_3` char(3) NOT NULL DEFAULT '',
  `address_format_id` int(11) NOT NULL DEFAULT 0,
  `inactive` enum('1') DEFAULT NULL,
  PRIMARY KEY (`country_id`),
  KEY `IDX_COUNTRIES_NAME` (`country_name`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`country_id`, `country_name`, `country_iso_code_2`, `country_iso_code_3`, `address_format_id`, `inactive`) VALUES (1,'Afghanistan','AF','AFG',1,NULL),
(2,'Albania','AL','ALB',1,NULL),
(3,'Algeria','DZ','DZA',1,NULL),
(4,'American Samoa','AS','ASM',1,NULL),
(5,'Andorra','AD','AND',1,NULL),
(6,'Angola','AO','AGO',1,NULL),
(7,'Anguilla','AI','AIA',1,NULL),
(8,'Antarctica','AQ','ATA',1,NULL),
(9,'Antigua and Barbuda','AG','ATG',1,NULL),
(10,'Argentina','AR','ARG',1,NULL),
(11,'Armenia','AM','ARM',1,NULL),
(12,'Aruba','AW','ABW',1,NULL),
(13,'Australia','AU','AUS',1,NULL),
(14,'Austria','AT','AUT',5,NULL),
(15,'Azerbaijan','AZ','AZE',1,NULL),
(16,'Bahamas','BS','BHS',1,NULL),
(17,'Bahrain','BH','BHR',1,NULL),
(18,'Bangladesh','BD','BGD',1,NULL),
(19,'Barbados','BB','BRB',1,NULL),
(20,'Belarus','BY','BLR',1,NULL),
(21,'Belgium','BE','BEL',1,NULL),
(22,'Belize','BZ','BLZ',1,NULL),
(23,'Benin','BJ','BEN',1,NULL),
(24,'Bermuda','BM','BMU',1,NULL),
(25,'Bhutan','BT','BTN',1,NULL),
(26,'Bolivia','BO','BOL',1,NULL),
(27,'Bosnia and Herzegowina','BA','BIH',1,NULL),
(28,'Botswana','BW','BWA',1,NULL),
(29,'Bouvet Island','BV','BVT',1,NULL),
(30,'Brazil','BR','BRA',1,NULL),
(31,'British Indian Ocean Territory','IO','IOT',1,NULL),
(32,'Brunei Darussalam','BN','BRN',1,NULL),
(33,'Bulgaria','BG','BGR',1,NULL),
(34,'Burkina Faso','BF','BFA',1,NULL),
(35,'Burundi','BI','BDI',1,NULL),
(36,'Cambodia','KH','KHM',1,NULL),
(37,'Cameroon','CM','CMR',1,NULL),
(38,' Canada','CA','CAN',1,NULL),
(39,'Cape Verde','CV','CPV',1,NULL),
(40,'Cayman Islands','KY','CYM',1,NULL),
(41,'Central African Republic','CF','CAF',1,NULL),
(42,'Chad','TD','TCD',1,NULL),
(43,'Chile','CL','CHL',1,NULL),
(44,'China','CN','CHN',1,NULL),
(45,'Christmas Island','CX','CXR',1,NULL),
(46,'Cocos (Keeling) Islands','CC','CCK',1,NULL),
(47,'Colombia','CO','COL',1,NULL),
(48,'Comoros','KM','COM',1,NULL),
(49,'Congo','CG','COG',1,NULL),
(50,'Cook Islands','CK','COK',1,NULL),
(51,'Costa Rica','CR','CRI',1,NULL),
(52,'Cote D\'Ivoire','CI','CIV',1,NULL),
(53,'Croatia','HR','HRV',1,NULL),
(54,'Cuba','CU','CUB',1,NULL),
(55,'Cyprus','CY','CYP',1,NULL),
(56,'Czech Republic','CZ','CZE',1,NULL),
(57,'Denmark','DK','DNK',1,NULL),
(58,'Djibouti','DJ','DJI',1,NULL),
(59,'Dominica','DM','DMA',1,NULL),
(60,'Dominican Republic','DO','DOM',1,NULL),
(61,'East Timor','TP','TMP',1,NULL),
(62,'Ecuador','EC','ECU',1,NULL),
(63,'Egypt','EG','EGY',1,NULL),
(64,'El Salvador','SV','SLV',1,NULL),
(65,'Equatorial Guinea','GQ','GNQ',1,NULL),
(66,'Eritrea','ER','ERI',1,NULL),
(67,'Estonia','EE','EST',1,NULL),
(68,'Ethiopia','ET','ETH',1,NULL),
(69,'Falkland Islands (Malvinas)','FK','FLK',1,NULL),
(70,'Faroe Islands','FO','FRO',1,NULL),
(71,'Fiji','FJ','FJI',1,NULL),
(72,'Finland','FI','FIN',1,NULL),
(73,' France','FR','FRA',1,NULL),
(74,'France, Metropolitan','FX','FXX',1,NULL),
(75,'French Guiana','GF','GUF',1,NULL),
(76,'French Polynesia','PF','PYF',1,NULL),
(77,'French Southern Territories','TF','ATF',1,NULL),
(78,'Gabon','GA','GAB',1,NULL),
(79,'Gambia','GM','GMB',1,NULL),
(80,'Georgia','GE','GEO',1,NULL),
(81,' Germany','DE','DEU',5,NULL),
(82,'Ghana','GH','GHA',1,NULL),
(83,'Gibraltar','GI','GIB',1,NULL),
(84,'Greece','GR','GRC',1,NULL),
(85,'Greenland','GL','GRL',1,NULL),
(86,'Grenada','GD','GRD',1,NULL),
(87,'Guadeloupe','GP','GLP',1,NULL),
(88,'Guam','GU','GUM',1,NULL),
(89,'Guatemala','GT','GTM',1,NULL),
(90,'Guinea','GN','GIN',1,NULL),
(91,'Guinea-bissau','GW','GNB',1,NULL),
(92,'Guyana','GY','GUY',1,NULL),
(93,'Haiti','HT','HTI',1,NULL),
(94,'Heard and Mc Donald Islands','HM','HMD',1,NULL),
(95,'Honduras','HN','HND',1,NULL),
(96,'Hong Kong','HK','HKG',1,NULL),
(97,'Hungary','HU','HUN',1,NULL),
(98,'Iceland','IS','ISL',1,NULL),
(99,'India','IN','IND',1,NULL),
(100,'Indonesia','ID','IDN',1,NULL),
(101,'Iran (Islamic Republic of)','IR','IRN',1,NULL),
(102,'Iraq','IQ','IRQ',1,NULL),
(103,'Ireland','IE','IRL',1,NULL),
(104,'Israel','IL','ISR',1,NULL),
(105,'Italy','IT','ITA',1,NULL),
(106,'Jamaica','JM','JAM',1,NULL),
(107,'Japan','JP','JPN',1,NULL),
(108,'Jordan','JO','JOR',1,NULL),
(109,'Kazakhstan','KZ','KAZ',1,NULL),
(110,'Kenya','KE','KEN',1,NULL),
(111,'Kiribati','KI','KIR',1,NULL),
(112,'Korea, Democratic People\'s Republic of','KP','PRK',1,NULL),
(113,'Korea, Republic of','KR','KOR',1,NULL),
(114,'Kuwait','KW','KWT',1,NULL),
(115,'Kyrgyzstan','KG','KGZ',1,NULL),
(116,'Lao People\'s Democratic Republic','LA','LAO',1,NULL),
(117,'Latvia','LV','LVA',1,NULL),
(118,'Lebanon','LB','LBN',1,NULL),
(119,'Lesotho','LS','LSO',1,NULL),
(120,'Liberia','LR','LBR',1,NULL),
(121,'Libyan Arab Jamahiriya','LY','LBY',1,NULL),
(122,'Liechtenstein','LI','LIE',1,NULL),
(123,'Lithuania','LT','LTU',1,NULL),
(124,'Luxembourg','LU','LUX',1,NULL),
(125,'Macau','MO','MAC',1,NULL),
(126,'Macedonia, The Former Yugoslav Republic of','MK','MKD',1,NULL),
(127,'Madagascar','MG','MDG',1,NULL),
(128,'Malawi','MW','MWI',1,NULL),
(129,'Malaysia','MY','MYS',1,NULL),
(130,'Maldives','MV','MDV',1,NULL),
(131,'Mali','ML','MLI',1,NULL),
(132,'Malta','MT','MLT',1,NULL),
(133,'Marshall Islands','MH','MHL',1,NULL),
(134,'Martinique','MQ','MTQ',1,NULL),
(135,'Mauritania','MR','MRT',1,NULL),
(136,'Mauritius','MU','MUS',1,NULL),
(137,'Mayotte','YT','MYT',1,NULL),
(138,'Mexico','MX','MEX',1,NULL),
(139,'Micronesia, Federated States of','FM','FSM',1,NULL),
(140,'Moldova, Republic of','MD','MDA',1,NULL),
(141,'Monaco','MC','MCO',1,NULL),
(142,'Mongolia','MN','MNG',1,NULL),
(143,'Montserrat','MS','MSR',1,NULL),
(144,'Morocco','MA','MAR',1,NULL),
(145,'Mozambique','MZ','MOZ',1,NULL),
(146,'Myanmar','MM','MMR',1,NULL),
(147,'Namibia','NA','NAM',1,NULL),
(148,'Nauru','NR','NRU',1,NULL),
(149,'Nepal','NP','NPL',1,NULL),
(150,'Netherlands','NL','NLD',1,NULL),
(151,'Netherlands Antilles','AN','ANT',1,NULL),
(152,'New Caledonia','NC','NCL',1,NULL),
(153,'New Zealand','NZ','NZL',1,NULL),
(154,'Nicaragua','NI','NIC',1,NULL),
(155,'Niger','NE','NER',1,NULL),
(156,'Nigeria','NG','NGA',1,NULL),
(157,'Niue','NU','NIU',1,NULL),
(158,'Norfolk Island','NF','NFK',1,NULL),
(159,'Northern Mariana Islands','MP','MNP',1,NULL),
(160,'Norway','NO','NOR',1,NULL),
(161,'Oman','OM','OMN',1,NULL),
(162,'Pakistan','PK','PAK',1,NULL),
(163,'Palau','PW','PLW',1,NULL),
(164,'Panama','PA','PAN',1,NULL),
(165,'Papua New Guinea','PG','PNG',1,NULL),
(166,'Paraguay','PY','PRY',1,NULL),
(167,'Peru','PE','PER',1,NULL),
(168,'Philippines','PH','PHL',1,NULL),
(169,'Pitcairn','PN','PCN',1,NULL),
(170,'Poland','PL','POL',1,NULL),
(171,'Portugal','PT','PRT',1,NULL),
(172,'Puerto Rico','PR','PRI',1,NULL),
(173,'Qatar','QA','QAT',1,NULL),
(174,'Reunion','RE','REU',1,NULL),
(175,'Romania','RO','ROM',1,NULL),
(176,'Russian Federation','RU','RUS',1,NULL),
(177,'Rwanda','RW','RWA',1,NULL),
(178,'Saint Kitts and Nevis','KN','KNA',1,NULL),
(179,'Saint Lucia','LC','LCA',1,NULL),
(180,'Saint Vincent and the Grenadines','VC','VCT',1,NULL),
(181,'Samoa','WS','WSM',1,NULL),
(182,'San Marino','SM','SMR',1,NULL),
(183,'Sao Tome and Principe','ST','STP',1,NULL),
(184,'Saudi Arabia','SA','SAU',1,NULL),
(185,'Senegal','SN','SEN',1,NULL),
(186,'Seychelles','SC','SYC',1,NULL),
(187,'Sierra Leone','SL','SLE',1,NULL),
(188,'Singapore','SG','SGP',4,NULL),
(189,'Slovakia (Slovak Republic)','SK','SVK',1,NULL),
(190,'Slovenia','SI','SVN',1,NULL),
(191,'Solomon Islands','SB','SLB',1,NULL),
(192,'Somalia','SO','SOM',1,NULL),
(193,'South Africa','ZA','ZAF',1,NULL),
(194,'South Georgia and the South Sandwich Islands','GS','SGS',1,NULL),
(195,'Spain','ES','ESP',3,NULL),
(196,'Sri Lanka','LK','LKA',1,NULL),
(197,'St. Helena','SH','SHN',1,NULL),
(198,'St. Pierre and Miquelon','PM','SPM',1,NULL),
(199,'Sudan','SD','SDN',1,NULL),
(200,'Suriname','SR','SUR',1,NULL),
(201,'Svalbard and Jan Mayen Islands','SJ','SJM',1,NULL),
(202,'Swaziland','SZ','SWZ',1,NULL),
(203,'Sweden','SE','SWE',1,NULL),
(204,'Switzerland','CH','CHE',1,'1'),
(205,'Syrian Arab Republic','SY','SYR',1,NULL),
(206,'Taiwan','TW','TWN',1,NULL),
(207,'Tajikistan','TJ','TJK',1,NULL),
(208,'Tanzania, United Republic of','TZ','TZA',1,NULL),
(209,'Thailand','TH','THA',1,NULL),
(210,'Togo','TG','TGO',1,NULL),
(211,'Tokelau','TK','TKL',1,NULL),
(212,'Tonga','TO','TON',1,NULL),
(213,'Trinidad and Tobago','TT','TTO',1,NULL),
(214,'Tunisia','TN','TUN',1,NULL),
(215,'Turkey','TR','TUR',1,NULL),
(216,'Turkmenistan','TM','TKM',1,NULL),
(217,'Turks and Caicos Islands','TC','TCA',1,NULL),
(218,'Tuvalu','TV','TUV',1,NULL),
(219,'Uganda','UG','UGA',1,NULL),
(220,'Ukraine','UA','UKR',1,NULL),
(221,'United Arab Emirates','AE','ARE',1,NULL),
(222,' United Kingdom','GB','GBR',1,NULL),
(223,' United States','US','USA',2,NULL),
(224,'United States Minor Outlying Islands','UM','UMI',1,NULL),
(225,'Uruguay','UY','URY',1,NULL),
(226,'Uzbekistan','UZ','UZB',1,NULL),
(227,'Vanuatu','VU','VUT',1,NULL),
(228,'Vatican City State (Holy See)','VA','VAT',1,NULL),
(229,'Venezuela','VE','VEN',1,NULL),
(230,'Viet Nam','VN','VNM',1,NULL),
(231,'Virgin Islands (British)','VG','VGB',1,NULL),
(232,'Virgin Islands (U.S.)','VI','VIR',1,NULL),
(233,'Wallis and Futuna Islands','WF','WLF',1,NULL),
(234,'Western Sahara','EH','ESH',1,NULL),
(235,'Yemen','YE','YEM',1,NULL),
(236,'Yugoslavia','YU','YUG',1,NULL),
(237,'Zaire','ZR','ZAR',1,NULL),
(238,'Zambia','ZM','ZMB',1,NULL),
(239,'Zimbabwe','ZW','ZWE',1,NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries_zones`
--

DROP TABLE IF EXISTS `countries_zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries_zones` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL DEFAULT 0,
  `zone_code` varchar(32) NOT NULL DEFAULT '',
  `zone_name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries_zones`
--

LOCK TABLES `countries_zones` WRITE;
/*!40000 ALTER TABLE `countries_zones` DISABLE KEYS */;
INSERT INTO `countries_zones` (`zone_id`, `zone_country_id`, `zone_code`, `zone_name`) VALUES (1,223,'AL','Alabama'),
(2,223,'AK','Alaska'),
(3,223,'AS','American Samoa'),
(4,223,'AZ','Arizona'),
(5,223,'AR','Arkansas'),
(6,223,'AF','Armed Forces Africa'),
(7,223,'AA','Armed Forces Americas'),
(8,223,'AC','Armed Forces Canada'),
(9,223,'AE','Armed Forces Europe'),
(10,223,'AM','Armed Forces Middle East'),
(11,223,'AP','Armed Forces Pacific'),
(12,223,'CA','California'),
(13,223,'CO','Colorado'),
(14,223,'CT','Connecticut'),
(15,223,'DE','Delaware'),
(16,223,'DC','District of Columbia'),
(17,223,'FM','Federated States Of Micronesia'),
(18,223,'FL','Florida'),
(19,223,'GA','Georgia'),
(20,223,'GU','Guam'),
(21,223,'HI','Hawaii'),
(22,223,'ID','Idaho'),
(23,223,'IL','Illinois'),
(24,223,'IN','Indiana'),
(25,223,'IA','Iowa'),
(26,223,'KS','Kansas'),
(27,223,'KY','Kentucky'),
(28,223,'LA','Louisiana'),
(29,223,'ME','Maine'),
(30,223,'MH','Marshall Islands'),
(31,223,'MD','Maryland'),
(32,223,'MA','Massachusetts'),
(33,223,'MI','Michigan'),
(34,223,'MN','Minnesota'),
(35,223,'MS','Mississippi'),
(36,223,'MO','Missouri'),
(37,223,'MT','Montana'),
(38,223,'NE','Nebraska'),
(39,223,'NV','Nevada'),
(40,223,'NH','New Hampshire'),
(41,223,'NJ','New Jersey'),
(42,223,'NM','New Mexico'),
(43,223,'NY','New York'),
(44,223,'NC','North Carolina'),
(45,223,'ND','North Dakota'),
(46,223,'MP','Northern Mariana Islands'),
(47,223,'OH','Ohio'),
(48,223,'OK','Oklahoma'),
(49,223,'OR','Oregon'),
(50,223,'PW','Palau'),
(51,223,'PA','Pennsylvania'),
(52,223,'PR','Puerto Rico'),
(53,223,'RI','Rhode Island'),
(54,223,'SC','South Carolina'),
(55,223,'SD','South Dakota'),
(56,223,'TN','Tennessee'),
(57,223,'TX','Texas'),
(58,223,'UT','Utah'),
(59,223,'VT','Vermont'),
(60,223,'VI','Virgin Islands'),
(61,223,'VA','Virginia'),
(62,223,'WA','Washington'),
(63,223,'WV','West Virginia'),
(64,223,'WI','Wisconsin'),
(65,223,'WY','Wyoming'),
(66,38,'AB','Alberta'),
(67,38,'BC','British Columbia'),
(68,38,'MB','Manitoba'),
(69,38,'NF','Newfoundland'),
(70,38,'NB','New Brunswick'),
(71,38,'NS','Nova Scotia'),
(72,38,'NT','Northwest Territories'),
(73,38,'NU','Nunavut'),
(74,38,'ON','Ontario'),
(75,38,'PE','Prince Edward Island'),
(76,38,'QC','Quebec'),
(77,38,'SK','Saskatchewan'),
(78,38,'YT','Yukon Territory'),
(79,81,'NDS','Niedersachsen'),
(80,81,'BAW','Baden-Württemberg'),
(81,81,'BAY','Bayern'),
(82,81,'BER','Berlin'),
(83,81,'BRG','Brandenburg'),
(84,81,'BRE','Bremen'),
(85,81,'HAM','Hamburg'),
(86,81,'HES','Hessen'),
(87,81,'MEC','Mecklenburg-Vorpommern'),
(88,81,'NRW','Nordrhein-Westfalen'),
(89,81,'RHE','Rheinland-Pfalz'),
(90,81,'SAR','Saarland'),
(91,81,'SAS','Sachsen'),
(92,81,'SAC','Sachsen-Anhalt'),
(93,81,'SCN','Schleswig-Holstein'),
(94,81,'THE','Thüringen'),
(95,14,'WI','Wien'),
(96,14,'NO','Niederösterreich'),
(97,14,'OO','Oberösterreich'),
(98,14,'SB','Salzburg'),
(99,14,'KN','Kärnten'),
(100,14,'ST','Steiermark'),
(101,14,'TI','Tirol'),
(102,14,'BL','Burgenland'),
(103,14,'VB','Voralberg'),
(104,204,'AG','Aargau'),
(105,204,'AI','Appenzell Innerrhoden'),
(106,204,'AR','Appenzell Ausserrhoden'),
(107,204,'BE','Bern'),
(108,204,'BL','Basel-Landschaft'),
(109,204,'BS','Basel-Stadt'),
(110,204,'FR','Freiburg'),
(111,204,'GE','Genf'),
(112,204,'GL','Glarus'),
(113,204,'JU','Graubünden'),
(114,204,'JU','Jura'),
(115,204,'LU','Luzern'),
(116,204,'NE','Neuenburg'),
(117,204,'NW','Nidwalden'),
(118,204,'OW','Obwalden'),
(119,204,'SG','St. Gallen'),
(120,204,'SH','Schaffhausen'),
(121,204,'SO','Solothurn'),
(122,204,'SZ','Schwyz'),
(123,204,'TG','Thurgau'),
(124,204,'TI','Tessin'),
(125,204,'UR','Uri'),
(126,204,'VD','Waadt'),
(127,204,'VS','Wallis'),
(128,204,'ZG','Zug'),
(129,204,'ZH','Zürich'),
(130,195,'A Coruña','A Coruña'),
(131,195,'Alava','Alava'),
(132,195,'Albacete','Albacete'),
(133,195,'Alicante','Alicante'),
(134,195,'Almeria','Almeria'),
(135,195,'Asturias','Asturias'),
(136,195,'Avila','Avila'),
(137,195,'Badajoz','Badajoz'),
(138,195,'Baleares','Baleares'),
(139,195,'Barcelona','Barcelona'),
(140,195,'Burgos','Burgos'),
(141,195,'Caceres','Caceres'),
(142,195,'Cadiz','Cadiz'),
(143,195,'Cantabria','Cantabria'),
(144,195,'Castellon','Castellon'),
(145,195,'Ceuta','Ceuta'),
(146,195,'Ciudad Real','Ciudad Real'),
(147,195,'Cordoba','Cordoba'),
(148,195,'Cuenca','Cuenca'),
(149,195,'Girona','Girona'),
(150,195,'Granada','Granada'),
(151,195,'Guadalajara','Guadalajara'),
(152,195,'Guipuzcoa','Guipuzcoa'),
(153,195,'Huelva','Huelva'),
(154,195,'Huesca','Huesca'),
(155,195,'Jaen','Jaen'),
(156,195,'La Rioja','La Rioja'),
(157,195,'Las Palmas','Las Palmas'),
(158,195,'Leon','Leon'),
(159,195,'Lleida','Lleida'),
(160,195,'Lugo','Lugo'),
(161,195,'Madrid','Madrid'),
(162,195,'Malaga','Malaga'),
(163,195,'Melilla','Melilla'),
(164,195,'Murcia','Murcia'),
(165,195,'Navarra','Navarra'),
(166,195,'Ourense','Ourense'),
(167,195,'Palencia','Palencia'),
(168,195,'Pontevedra','Pontevedra'),
(169,195,'Salamanca','Salamanca'),
(170,195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife'),
(171,195,'Segovia','Segovia'),
(172,195,'Sevilla','Sevilla'),
(173,195,'Soria','Soria'),
(174,195,'Tarragona','Tarragona'),
(175,195,'Teruel','Teruel'),
(176,195,'Toledo','Toledo'),
(177,195,'Valencia','Valencia'),
(178,195,'Valladolid','Valladolid'),
(179,195,'Vizcaya','Vizcaya'),
(180,195,'Zamora','Zamora'),
(181,195,'Zaragoza','Zaragoza');
/*!40000 ALTER TABLE `countries_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries_zones_metros`
--

DROP TABLE IF EXISTS `countries_zones_metros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries_zones_metros` (
  `metro_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) DEFAULT NULL,
  `metro_country_id` int(12) NOT NULL DEFAULT 0,
  `metro_zone_id` int(12) NOT NULL DEFAULT 0,
  `metro_code` varchar(12) DEFAULT NULL,
  `metro_name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`metro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries_zones_metros`
--

LOCK TABLES `countries_zones_metros` WRITE;
/*!40000 ALTER TABLE `countries_zones_metros` DISABLE KEYS */;
INSERT INTO `countries_zones_metros` (`metro_id`, `user_id`, `metro_country_id`, `metro_zone_id`, `metro_code`, `metro_name`) VALUES (1,NULL,223,12,NULL,'Los Angeles'),
(4,NULL,223,43,NULL,'New York'),
(5,NULL,223,0,NULL,'San Francisco'),
(6,NULL,223,57,NULL,'Dallas Fort-Worth'),
(7,NULL,223,12,NULL,'San Diego'),
(8,NULL,13,0,NULL,'Melbourne'),
(9,NULL,223,64,NULL,'Milwaukee'),
(10,NULL,223,33,NULL,'Detroit'),
(11,NULL,107,0,NULL,'Kyoto');
/*!40000 ALTER TABLE `countries_zones_metros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_resources`
--

DROP TABLE IF EXISTS `dev_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dev_resources` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `collate` int(12) DEFAULT NULL,
  `current_date` date DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `completed` varchar(255) DEFAULT NULL,
  `hours` varchar(100) DEFAULT NULL,
  `inactive` enum('1') DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_resources`
--

LOCK TABLES `dev_resources` WRITE;
/*!40000 ALTER TABLE `dev_resources` DISABLE KEYS */;
INSERT INTO `dev_resources` (`id`, `collate`, `current_date`, `item`, `website`, `description`, `notes`, `completed`, `hours`, `inactive`, `stamp`) VALUES (1,1,'2004-07-03','user points system','http://discussions.info.apple.com/webx?13@151.NLwiaLr1q4v.4@.599dc782','points system for user forum','The points system: \r\n\r\nA post can gain or lose points in the following ways: \r\n\r\nUser vote (either + or -). A user may vote as many times as they wish as long as they have the votes (see the chart below).\r\nA user may only vote up to 5 times per day on any one individual\'s posts.\r\nAfter 6 points are accumulated, the post will show a ratio of the positive and negative votes.   \r\n\r\nA user can gain or lose points in the following ways: \r\n\r\nEach new post gives one point to the author. If the post is later deleted, that one point is lost. If a post is directly removed as a result of violating the Terms of Use, 25 points will be deducted from the author\'s total.\r\nAny suspension of posting privileges for violation of the Terms of Use may result in the loss of enough points to reduce the user up to 2 full levels.\r\n20% chance to gain 1 point every time you cast a vote for someone else\'s post - whether that vote be positive or negative.\r\nA chance of an author gaining or losing one point if the author’s post is voted up or down by another user.\r\nEvery day, all users will be granted a certain number of votes to cast. \r\n\r\nThe levels and associated privileges: \r\n\r\n\r\nLevel\r\nRequired for level\r\nVotes Given\r\nper day\r\nPrivileges\r\n\r\nPoints\r\nPosts\r\nMonths\r\n\r\n0\r\n0\r\n0\r\n0\r\n5 *\r\n* Voting on responses to their own topics.\r\n\r\n1\r\n20\r\n5\r\n0\r\n5\r\nAbility to vote on any post.\r\n\r\n2\r\n60\r\n25\r\n0\r\n10\r\nAbility to add personal information to profile page.\r\n\r\n3\r\n600\r\n200\r\n6\r\n15\r\nCustom user icons. (Note: currently disabled)\r\n\r\n4\r\n4000\r\n500\r\n12\r\n35\r\nInappropriate post Notify; Lounge access\r\n\r\n5\r\n50000\r\n10000\r\n18\r\n75\r\n\r\nNotes: \r\n\r\nA user must meet point, length of membership and post requirements to reach a level, and they lose the level if they drop below any requirement.\r\nPosts required are \"total posts\" not \"posts currently online.\"\r\nAll leveling normally happens between 10 am and 6 pm CDT Daily.\r\nUsers may not move up more than one level per week. However, they can drop down a level each day.\r\nPrivileges are automatically assigned but may be removed on a user-by-user basis if the privilege is abused.\r\nVotes are logged. Abuse of the voting system will result in the loss of voting privileges.',NULL,NULL,NULL,'2005-12-20 05:53:48');
/*!40000 ALTER TABLE `dev_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office`
--

DROP TABLE IF EXISTS `office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `office` (
  `office_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`office_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office`
--

LOCK TABLES `office` WRITE;
/*!40000 ALTER TABLE `office` DISABLE KEYS */;
INSERT INTO `office` (`office_id`, `user_id`, `stamp`) VALUES (1,100022,'2006-04-14 19:23:27'),
(2,100022,'2006-04-14 19:23:27');
/*!40000 ALTER TABLE `office` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office_name`
--

DROP TABLE IF EXISTS `office_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `office_name` (
  `office_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `office` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_name`
--

LOCK TABLES `office_name` WRITE;
/*!40000 ALTER TABLE `office_name` DISABLE KEYS */;
INSERT INTO `office_name` (`office_id`, `user_id`, `office`, `stamp`) VALUES (1,100022,'Mark Mack Architects','2006-04-15 02:44:01'),
(2,100022,'Neil Denari Architects','2006-04-15 02:44:01');
/*!40000 ALTER TABLE `office_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professions`
--

DROP TABLE IF EXISTS `professions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `professions` (
  `profession_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) DEFAULT NULL,
  `profession` varchar(255) NOT NULL DEFAULT '',
  `approved` enum('1') DEFAULT NULL,
  PRIMARY KEY (`profession_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professions`
--

LOCK TABLES `professions` WRITE;
/*!40000 ALTER TABLE `professions` DISABLE KEYS */;
INSERT INTO `professions` (`profession_id`, `user_id`, `profession`, `approved`) VALUES (1,NULL,'architect','1'),
(2,NULL,'landscape architect','1'),
(3,NULL,'structural engineer','1'),
(4,NULL,'contractor','1'),
(5,NULL,'lighting consultant','1'),
(7,NULL,'mechanical engineer',NULL);
/*!40000 ALTER TABLE `professions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `project_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10034 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`project_id`, `user_id`, `stamp`) VALUES (1,100022,'2006-04-14 18:34:56'),
(10018,100022,'2006-05-10 01:51:20'),
(3,100022,'2006-04-24 14:56:28'),
(10004,100022,'2006-04-24 22:43:58'),
(10021,100022,'2006-05-24 23:02:17'),
(10020,100022,'2006-05-17 20:47:27'),
(10019,100022,'2006-05-17 00:59:40'),
(10015,100022,'2006-04-26 01:23:37'),
(10016,100022,'2006-05-08 04:22:23'),
(10017,100022,'2006-05-09 21:22:35'),
(10022,100023,'2006-06-15 18:25:11'),
(10029,100022,'2006-07-15 06:02:47'),
(10028,100024,'2006-06-20 04:00:26'),
(10027,100022,'2006-06-17 15:35:39'),
(10026,100023,'2006-06-15 18:31:07'),
(10030,100022,'2006-07-16 06:19:32'),
(10031,100022,'2006-07-16 19:07:55'),
(10032,100022,'2009-12-14 23:41:30'),
(10033,100022,'2011-02-23 01:12:29');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_category`
--

DROP TABLE IF EXISTS `projects_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_category` (
  `projects_category_id` int(12) NOT NULL AUTO_INCREMENT,
  `category_id` int(12) NOT NULL DEFAULT 0,
  `project_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) DEFAULT 0,
  `vote_yes` int(6) NOT NULL DEFAULT 0,
  `vote_no` int(6) NOT NULL DEFAULT 0,
  `vote_direction` int(6) NOT NULL DEFAULT 0,
  `vote_ip` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`projects_category_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `profession_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_category`
--

LOCK TABLES `projects_category` WRITE;
/*!40000 ALTER TABLE `projects_category` DISABLE KEYS */;
INSERT INTO `projects_category` (`projects_category_id`, `category_id`, `project_id`, `user_id`, `vote_yes`, `vote_no`, `vote_direction`, `vote_ip`, `stamp`) VALUES (1,3,3,0,0,0,0,'','2006-06-12 05:58:55'),
(2,4,3,0,0,0,0,'','2006-06-12 15:43:05'),
(6,7,10027,0,0,0,0,'','2006-06-18 05:48:35'),
(4,5,10015,0,0,0,0,'','2006-06-12 23:04:46'),
(5,6,10020,0,0,0,0,'','2006-06-12 23:11:24'),
(7,1,10028,0,0,0,0,'','2006-06-20 04:01:18'),
(8,1,10030,0,1,0,1,'70.95.117.33','2006-07-16 06:35:32'),
(9,8,10030,0,2,0,2,'96.251.49.85','2006-07-16 18:59:01'),
(10,9,10018,0,1,0,1,'99.5.111.219','2009-12-14 23:22:07'),
(11,10,10032,0,1,0,1,'99.5.111.219','2009-12-14 23:42:44'),
(12,11,10018,0,0,0,0,'','2009-12-15 01:39:17'),
(13,2,10019,0,2,0,2,'76.83.168.40','2011-02-23 00:38:57'),
(14,1,10033,0,0,0,0,'','2011-02-23 01:22:11'),
(15,3,10019,0,1,0,1,'76.83.168.40','2022-02-25 23:30:31'),
(16,5,10019,0,0,1,-1,'76.83.168.40','2022-02-25 23:31:05'),
(17,2,10029,0,0,0,0,'','2022-02-25 23:33:50');
/*!40000 ALTER TABLE `projects_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_description`
--

DROP TABLE IF EXISTS `projects_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_description` (
  `projects_description_id` int(12) NOT NULL AUTO_INCREMENT,
  `project_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `vote_yes` int(6) NOT NULL DEFAULT 0,
  `vote_no` int(6) NOT NULL DEFAULT 0,
  `vote_direction` int(6) NOT NULL DEFAULT 0,
  `vote_ip` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`projects_description_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_description`
--

LOCK TABLES `projects_description` WRITE;
/*!40000 ALTER TABLE `projects_description` DISABLE KEYS */;
INSERT INTO `projects_description` (`projects_description_id`, `project_id`, `user_id`, `title`, `description`, `vote_yes`, `vote_no`, `vote_direction`, `vote_ip`, `stamp`) VALUES (1,10015,100022,NULL,'This is a test description. That Kimbell museum is great! This is a test description. That Kimbell museum is great! This is a test description. That Kimbell museum is great! This is a test description. That Kimbell museum is great! This is a test description. That Kimbell museum is great! This is a test description. That Kimbell museum is great! ',0,0,0,'','2006-05-01 03:02:09'),
(2,10015,100022,NULL,'\"The Kimbell Art Museum by Louis Kahn is also a disciplined, coherent, and visually clear statement, but here the aesthetics derive from the more classically oriented sensiblity of its architect. It has an austere yet rich simplicity that comes from the repetition of a vaultlike form, given a dull sheen from its lead-covered exterior, and a beautifully articulated concrete structural frame with infill paneled walls of travertine. Its classic sense of timelessness is ennobled by a reverence for material and detail. Its interior form, bathed in a diffused natural light that enters the space via continuous interior suspended screen and reflected downward off the curve of the vault.\"\r\n\r\n— from Paul Heyer. American Architecture: Ideas and Ideologies in the Late Twentieth Century. p278-279.\r\n\r\n\"...Louis Kahn...was perhaps the best among the architects of this century to illustrate expressive honesty and integrity with regard to the coordination of materials with a total architectural vision.\r\n\r\n\"Louis Kahn\'s Kimbell Art museum in Fort Worth is a masterpiece in this respect. A survey of the numerous studies of the building demonstrate a care for \'fit\' that can only be compared to the perfection of the classics, especially the Greek classics. Kahn put the use of tools and machines to the ultimate architectonic end; with them he produced buildings that were composites of parts working in total harmony among themselves and with the whole. There is no Kahn building that does not give evidence of his genius in the use of materials. He has achieved perfection in buildings with all sorts of budgetary constraints, from the most modest to the monumental....\"',0,0,0,'','2006-05-09 21:07:52'),
(3,10016,100022,NULL,'The wolf House is a great project by John Lautner, located in the hills above Hollywood California. The majority of the house is tucked into the hillside foliage but the appearance of the canitlevering main living room space jumps out at you as you drive up the winding roads towards the house.',0,0,0,'','2006-05-08 04:26:00'),
(4,10018,100022,NULL,'The Neurosciences Institute is an independent, not-for-profit, privately supported, scientific research organization dedicated to studying the workings of the brain at the most fundamental level. Its goal is to illuminate the biological principles that form the very essence of conscious life: sensory perception, physical movement, memory, emotion, and communication.\r\n\r\nThe Institute is dedicated to a research environment that encourages creativity and innovation in a collaborative atmosphere with true freedom of scientific inquiry, in the expectation that such an environment provides the best chance for making vital advances for the benefit of mankind.\r\n\r\nUnder the leadership of Gerald M. Edelman, M.D., Ph.D., the Institute was founded in New York in 1981, moved to temporary quarters in La Jolla in 1993, and in 1995 to this award-winning architectural complex designed by Tod Williams Billie Tsien and Associates.\r\n\r\nNeurosciences Research Foundation, Inc., is the publicly supported, tax-exempt organization that operates The Neurosciences Institute.',0,0,0,'','2006-05-10 01:59:40'),
(5,10018,100022,NULL,'There&#039;s no place in the world like The Neurosciences Institute. It is, in effect, a scientific monastery, where extremely gifted and dedicated people from all over the world can do fundamental work, experimental and theoretical, undistracted by the demands of an academic or industrial setting.',0,0,0,'','2006-05-10 02:02:23'),
(6,1,100022,NULL,'Designed by architect Frank Gehry, Walt Disney Concert Hall, new home of the Los Angeles Philharmonic, is designed to be one of the most acoustically sophisticated concert halls in the world, providing both visual and aural intimacy for an unparalleled musical experience.\r\n\r\nThrough the vision and generosity of Lillian Disney, the Disney family, and many other individual and corporate donors, the city will enjoy one of the finest concert halls in the world, as well as an internationally recognized architectural landmark.\r\n\r\nFrom the stainless steel curves of its striking exterior to the state-of-the-art acoustics of the hardwood-paneled main auditorium, the 3.6-acre complex embodies the unique energy and creative spirit of the city of Los Angeles and its orchestra.',0,0,0,'','2006-05-10 02:49:34'),
(7,1,100022,NULL,'The Vision\r\n \r\nIn 1987, the late Lillian Disney made an initial gift of $50 million to build a world-class performance venue as a gift to the people of Los Angeles and a tribute to Walt Disney&#039;s devotion to the arts. Since then, other gifts and accumulated interest bring the Disney family&#039;s total contribution to over $100 million. The County of Los Angeles agreed to provide the land and significant additional funding to finance Walt Disney Concert Hall&#039;s six-level subterranean parking garage.\r\n\r\nIn 1988, renowned architect Frank Gehry was selected to design the complex, whose final shape he unveiled in 1991. The County initiated construction of the parking garage in 1992, completing it in 1996. Construction on the Concert Hall itself began in November 1999. Also that year, the Music Center launched a capital campaign to complete the construction funding. Many corporate, foundation, and individual partners, along with the State of California, have contributed generously to the campaign due to the remarkable leadership of Andrea L. Van de Kamp, Chairman of the Music Center, Eli Broad, Chairman of SunAmerica, Inc., and former Los Angeles Mayor Richard J. Riordan. The Los Angeles Philharmonic provided additional funding for the core project and full funding for the Los Angeles Philharmonic Center.',0,0,0,'','2006-05-10 02:49:49'),
(15,3,100022,'Test Description','blah blah blah!',0,1,-1,'70.23.236.64','2006-06-08 06:15:08'),
(9,3,100022,'','Completed in 1930, the Chrysler Building is a distinctive symbol of New York City, standing 1,046 feet (319 m) high on the east side of Manhattan at the intersection of 42nd Street and Lexington Avenue. Originally built for the Chrysler Corporation, the building is presently co-owned by TMW Real Estate (75%) and Tishman Speyer Properties (25%). The Chrysler Building was the first structure in the world to surpass the 1,000 foot (305 m) threshold. Despite being overtaken by the Empire State Building as the tallest building in the world during the 1930s, the Chrysler Building is still the tallest brick building in the world.',0,0,0,'','2006-05-13 12:10:42'),
(10,3,100022,'History','The Chrysler building was designed by William van Alen for a contractor, William H. Reynolds, the same man who dreamed up Dreamland, a by-gone amusement park of Coney Island&#039;s heyday. The design was subsequently sold to Walter P. Chrysler as a home for his company&#039;s headquarters.\r\nGroundbreaking was on September 19, 1928. At the time the building was erected, the builders of New York were in the throes of a stiff competition to build the world&#039;s tallest skyscraper. The Chrysler building was constructed at an average rate of 4 floors per week, and no workers were killed during construction. Just prior to completion, the building stood even with H. Craig Severance&#039;s 40 Wall Street. Mr. Severance subsequently added two feet to his building, and claimed the title of the world&#039;s tallest building (this distinction excluded &quot;structures&quot;, such as the Eiffel Tower.)\r\nNot one to be outdone, Mr. van Alen had already secretly obtained permission to build a 185 foot (58.4 m) spire, which was being constructed inside of the building. The spire, composed of &#039;Nirosta&#039; stainless steel, was hoisted to the top of the building on October 23, 1929, making the Chrysler Building not only the world&#039;s tallest building, but also the world&#039;s tallest structure. The steel chosen to cap the building was Krupp KA2 &quot;Enduro&quot; Steel. Van Alen and Chrysler enjoyed this distinction for less than a year, before it was surrendered to the Empire State Building. Unfortunately, Mr. van Alen&#039;s satisfaction was muted by Walter Chrysler&#039;s refusal to pay his fee. The Chrysler Building opened to the public on May 27, 1930 with an opening ceremony.',0,0,0,'','2006-05-13 12:12:32'),
(11,3,100022,'Architecture','The Chrysler Building is an example of Art Deco architecture, and the distinctive ornamentation of the tower is based on features that were then being used on Chrysler automobiles. The corners of the 61st floors are graced with eagles, replicas of the 1929 Chrysler hood ornaments[1]. On the 31st floors the corner ornamentation are replicas of the 1929 Chrysler radiator caps[2]. The building is also arguably the best example of the Art Deco period of New York architecture, which was noted as perhaps the most beautiful period of development of buildings in the city.\r\nThe lobby is similarly elegant. When the building first opened it contained a public viewing gallery near the top, which a few years later was changed into a restaurant, but neither of these enterprises was able to be financially self sustaining during the Great Depression and the former observation floor became a private club. The very top stories of the building are narrow with low sloped ceilings, designed mostly for exterior appearance with interiors useful only to hold radio broadcasting and other mechanical and electrical equipment.\r\nIn more recent years the Chrysler Building has continued to be a favorite among New Yorkers. In the summer of 2005, New York&#039;s own Skyscraper Museum asked one hundred architects, builders, critics, engineers, historians, and scholars, among others, to choose their 10 favorites among 25 New York towers. The Chrysler Building came in first place as 90% of them placed the building in their top 10 favorite buildings.',0,0,0,'','2006-05-13 12:12:24'),
(12,10019,100022,'Structure','The structualfajsdfl a asdaele lj sdf',0,0,0,'','2006-05-17 01:00:08'),
(13,10019,100022,'Design','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',1,0,1,'68.166.232.94','2006-05-17 01:01:45'),
(14,10021,100022,'About The Salk','Jonas Salk, the developer of the polio vaccine, established the Salk Institute for Biological Studies more than 40 years ago. His goal was to create an institute that would serve as a &quot;crucible for creativity&quot; to pursue questions about the basic principles of life. He wanted biologists and others to work together to explore the wider implications of their discoveries for the future of humanity.\r\nIn 1959, Salk and architect Louis Kahn began a unique partnership to design a truly distinguished research facility. Seed money was provided by the March of Dimes, which has continuously and generously supported the Salk Institute over its history. The San Diego City Council gifted the Institute with the land on which to build the facility, and this decision was approved and affirmed overwhelmingly by the people of San Diego in a special referendum.\r\n\r\nToday, the Salk Institute conducts its biological research under the guidance of 58 faculty investigators, employing a scientific staff of more than 850, including visiting scientists, postdoctoral fellows, and graduate students. This group, recruited throughout the world, receives advice from nine distinguished nonresident fellows—influential scientists at similar institutions throughout the world.\r\n\r\nMajor areas of study focus within three areas: Molecular Biology and Genetics; Neurosciences; and Plant Biology. Knowledge acquired in Salk laboratories provides new understanding and potential new therapies and treatments for a range of diseases—from cancer to AIDS, from Alzheimer’s disease to cardiovascular disorders, from anomalies of the brain to birth defects. Studies in plant biology at the Salk may one day help improve the quality and quantity of the world’s food supply.\r\n\r\nWith the completion of the Human Genome Project, the Salk Institute is strengthening its existing programs while also moving in exciting new directions. Six key areas represent strategic research priorities: Chemistry and Proteomics; Stem Cell Biology; Cell Biology; Regulatory Biology; Metabolic Research; and Computational and Theoretical Biology.\r\n\r\nThe Salk Institute consistently ranks among the leading research institutions in the world in objective measures of the contributions of faculty and the impact of their findings. The Institute has trained more than 2,000 scientists, many of whom have gone on to positions of leadership in other prominent research centers worldwide. Five scientists trained at the Institute have won Nobel prizes, and three current resident faculty members are Nobel Laureates.\r\n\r\nJonas Salk&#039;s vision, coupled with the hard work and dedication of former and present Salk investigators has resulted in a unique environment where scientific discoveries have an important impact on our understanding of human health.\r\n\r\nBasic research is truly &quot;where cures begin .&quot; Discoveries of the principles governing cellular activity have frequently illuminated the path toward therapies and cures. In this, Jonas Salk’s noble vision impels us still.',1,0,1,'70.23.236.64','2006-05-24 23:08:59');
/*!40000 ALTER TABLE `projects_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_image`
--

DROP TABLE IF EXISTS `projects_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_image` (
  `projects_image_id` int(12) NOT NULL AUTO_INCREMENT,
  `project_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` int(12) DEFAULT NULL,
  `file_width` int(4) DEFAULT NULL,
  `file_height` int(4) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `vote_yes` int(6) NOT NULL DEFAULT 0,
  `vote_no` int(6) NOT NULL DEFAULT 0,
  `vote_direction` int(6) NOT NULL DEFAULT 0,
  `vote_ip` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`projects_image_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_image`
--

LOCK TABLES `projects_image` WRITE;
/*!40000 ALTER TABLE `projects_image` DISABLE KEYS */;
INSERT INTO `projects_image` (`projects_image_id`, `project_id`, `user_id`, `file_name`, `file_type`, `file_size`, `file_width`, `file_height`, `title`, `tags`, `caption`, `date`, `vote_yes`, `vote_no`, `vote_direction`, `vote_ip`, `stamp`) VALUES (1,10015,100022,'cid_1860922.jpg','image/jpeg',88763,NULL,NULL,'Exterior Sunken Courtyard',NULL,'this is the caption','2006-05-07',0,0,0,'','2006-05-09 23:27:19'),
(2,10015,100022,'cid_1878411.jpg','image/jpeg',100920,NULL,NULL,'Interior Lobby Entrance',NULL,NULL,'2006-05-01',0,0,0,'','2006-05-09 23:30:56'),
(3,1,100022,'DSC05182.JPG','image/jpeg',926804,NULL,NULL,'Disney Concert Hall',NULL,NULL,NULL,0,0,0,'','2006-05-10 01:43:33'),
(4,1,100022,'DSC05188.JPG','image/jpeg',1793838,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:45:54'),
(5,1,100022,'DSC05189.JPG','image/jpeg',899810,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:46:29'),
(6,1,100022,'DSC05195.JPG','image/jpeg',845163,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:46:57'),
(7,1,100022,'DSC05213.JPG','image/jpeg',1527202,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:48:22'),
(8,1,100022,'DSC05194.JPG','image/jpeg',597178,NULL,NULL,'Panel Detail',NULL,NULL,NULL,0,0,0,'','2006-05-10 01:48:55'),
(9,10018,100022,'DSC02272.JPG','image/jpeg',1878039,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:52:09'),
(10,10018,100022,'DSC02281.JPG','image/jpeg',909550,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:52:59'),
(11,10018,100022,'DSC02402.JPG','image/jpeg',795928,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:55:46'),
(12,10018,100022,'DSC02289.JPG','image/jpeg',1043722,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:57:23'),
(13,10018,100022,'DSC02294.JPG','image/jpeg',992806,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:57:48'),
(14,10018,100022,'DSC02282.JPG','image/jpeg',1609134,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 01:58:54'),
(15,3,100022,'cid_2919350.jpg','image/jpeg',43862,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 02:57:41'),
(16,3,100022,'cid_1068573398_P8295176.jpg','image/jpeg',66430,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 02:57:52'),
(17,3,100022,'cid_1133816832_cb8.jpg','image/jpeg',68743,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-05-10 02:58:22'),
(21,10020,100022,'DSC04537.JPG','image/jpeg',2036616,NULL,NULL,'during renovation',NULL,'View of the terminal from the AirTrain pass over','2006-03-30',0,0,0,'','2006-06-12 23:10:56'),
(28,10027,100022,'DSC06478.JPG','image/jpeg',2115944,NULL,NULL,'at Sunset',NULL,'The Statue of Liberty at Sunset from the Staten Island Ferry','2006-06-16',0,0,0,'','2006-06-17 20:41:42'),
(29,10027,100022,'DSC06174.JPG','image/jpeg',1893894,NULL,NULL,NULL,NULL,NULL,'2006-06-16',0,0,0,'','2006-06-17 23:06:09'),
(30,10019,100022,'DSC03133.JPG','image/jpeg',2434355,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-06-18 20:07:57'),
(31,10028,100024,'16-Monroe-PLace.jpg','image/pjpeg',127242,NULL,NULL,'front',NULL,'very cool!','2006-08-15',0,0,0,'','2006-06-20 04:04:43'),
(32,10029,100022,'DSC08223.JPG','image/jpeg',2002715,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-07-15 06:04:12'),
(33,10030,100022,'DSC08387.JPG','image/jpeg',2292897,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-07-16 06:27:14'),
(34,10030,100022,'DSC08357.JPG','image/jpeg',2259073,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-07-16 06:30:18'),
(35,10030,100022,'DSC08381.JPG','image/jpeg',2317743,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-07-16 06:32:44'),
(36,10031,100022,'DSC07732.JPG','image/jpeg',2048985,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'','2006-07-16 19:09:07'),
(37,10032,100022,'Crystal Lagoon Peddle Boat - 17_big.jpg','image/jpeg',57630,NULL,NULL,'Foot Peddle Boats',NULL,NULL,NULL,0,0,0,'','2009-12-14 23:42:17'),
(38,10033,100022,'worlds-best-gardens-04-g.jpg','image/jpeg',81165,NULL,NULL,'Katsura Imperial Villa Garden',NULL,NULL,NULL,0,0,0,'','2011-02-23 01:15:35'),
(39,10033,100022,'Katsura_Site_Plan.jpg','image/jpeg',70481,NULL,NULL,'Katsura Imperial Villa Site Plan',NULL,NULL,NULL,0,0,0,'','2011-02-23 01:15:48'),
(40,10033,100022,'Katsura_Plan_2.jpg','image/jpeg',54079,NULL,NULL,'Katsura Imperial Villa Floor Plan',NULL,NULL,NULL,0,0,0,'','2011-02-23 01:16:02'),
(41,10033,100022,'Katsura_Site_Axon.jpg','image/jpeg',150701,NULL,NULL,'Katsura Imperial Villa Axon',NULL,NULL,NULL,0,0,0,'','2011-02-23 01:18:08'),
(42,10033,100022,'0903katsuraGP.gif','image/gif',32977,NULL,NULL,'Katsura Imperial Villa Site Plan Colored',NULL,NULL,NULL,0,0,0,'','2011-02-23 01:18:20');
/*!40000 ALTER TABLE `projects_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_link`
--

DROP TABLE IF EXISTS `projects_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_link` (
  `projects_link_id` int(12) NOT NULL AUTO_INCREMENT,
  `project_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `url` text NOT NULL,
  `vote_yes` int(6) NOT NULL DEFAULT 0,
  `vote_no` int(6) NOT NULL DEFAULT 0,
  `vote_direction` int(6) NOT NULL DEFAULT 0,
  `vote_ip` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`projects_link_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_link`
--

LOCK TABLES `projects_link` WRITE;
/*!40000 ALTER TABLE `projects_link` DISABLE KEYS */;
INSERT INTO `projects_link` (`projects_link_id`, `project_id`, `user_id`, `title`, `url`, `vote_yes`, `vote_no`, `vote_direction`, `vote_ip`, `stamp`) VALUES (1,3,0,'Great Buildings','http://www.greatbuildings.com/buildings/Chrysler_Building.html',0,0,0,'','2006-06-12 15:45:29'),
(2,10015,0,'www.greatbuildings.com','http://www.greatbuildings.com/buildings/Kimbell_Museum.html',0,0,0,'','2006-06-12 23:03:33'),
(3,10020,100022,'GreatBuildings.com','http://www.greatbuildings.com/buildings/TWA_at_New_York.html',0,0,0,'','2006-06-12 23:13:12'),
(4,10029,100022,'http://www.scjohnson.com/','',0,0,0,'','2006-07-15 06:05:49'),
(5,1,0,'Greatbuilsing.com','Greatbuilsing.com',0,1,-1,'99.5.111.219','2009-12-14 23:26:21'),
(6,10033,100022,'http://maps.google.com/maps?ll=34.98408,135.70968&amp;spn=0.002637,0.004292&amp;t=k&amp;z=18&amp;key=ABQIAAAAeO8Vsp519nJ9BERi3M1mFhRxkKXXB96AacGyMvQ6t4ebDRjQShSyY5A1aVqGwHNymBi0ggoWD7Az2Q&amp;mapclient=jsapi&amp;oi=map_misc&amp;ct=api_logo','Google Map Location',0,0,0,'','2011-02-23 01:23:34'),
(7,10033,100022,'http://www.greatbuildings.com/buildings/Imperial_Villa_Katsura.html','',0,0,0,'','2011-02-23 01:24:03');
/*!40000 ALTER TABLE `projects_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_location`
--

DROP TABLE IF EXISTS `projects_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_location` (
  `projects_location_id` int(12) NOT NULL AUTO_INCREMENT,
  `project_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `country_id` int(12) DEFAULT NULL,
  `zone_id` int(12) DEFAULT NULL,
  `metro_id` int(12) DEFAULT NULL,
  `address_01` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(12) DEFAULT NULL,
  `vote_yes` int(6) NOT NULL DEFAULT 0,
  `vote_no` int(6) NOT NULL DEFAULT 0,
  `vote_direction` int(6) NOT NULL DEFAULT 0,
  `vote_ip` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`projects_location_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_location`
--

LOCK TABLES `projects_location` WRITE;
/*!40000 ALTER TABLE `projects_location` DISABLE KEYS */;
INSERT INTO `projects_location` (`projects_location_id`, `project_id`, `user_id`, `country_id`, `zone_id`, `metro_id`, `address_01`, `city`, `postal_code`, `vote_yes`, `vote_no`, `vote_direction`, `vote_ip`, `stamp`) VALUES (1,3,100022,223,43,4,NULL,'Manhattan','10008',3,5,-2,'192.168.15.101','2006-04-24 14:56:29'),
(16,10018,100022,223,12,7,NULL,'La Jolla',NULL,0,0,0,'','2006-05-10 01:51:20'),
(18,10020,100022,223,43,4,NULL,'Brooklyn',NULL,0,0,0,'','2006-05-17 20:47:27'),
(19,10021,100022,223,12,7,'10010 North Torrey Pines Road','La Jolla','92037',0,0,0,'','2006-05-24 23:02:17'),
(17,10019,100022,223,43,4,NULL,'Manhattan',NULL,0,0,0,'','2006-05-17 00:59:40'),
(13,10015,100022,223,57,6,NULL,NULL,NULL,0,0,0,'','2006-04-26 01:23:37'),
(14,10016,100022,223,12,1,NULL,'Hollywood',NULL,0,0,0,'','2006-05-08 04:22:23'),
(15,10017,100022,223,12,1,NULL,'Hollywood',NULL,0,0,0,'','2006-05-09 21:22:35'),
(20,10022,100023,13,NULL,8,'Federation Square','Melbourne',NULL,0,0,0,'','2006-06-15 18:25:11'),
(21,10023,100023,13,NULL,NULL,'Federation Square','Melbourne',NULL,0,0,0,'','2006-06-15 18:25:36'),
(22,10024,100023,13,NULL,8,'Federation Square','Melbourne',NULL,0,0,0,'','2006-06-15 18:25:55'),
(23,10025,100023,13,NULL,8,'Federation Square','Melbourne',NULL,0,0,0,'','2006-06-15 18:26:13'),
(24,10026,100023,223,43,4,NULL,NULL,NULL,0,0,0,'','2006-06-15 18:31:07'),
(25,10027,100022,223,43,4,NULL,NULL,NULL,0,0,0,'','2006-06-17 15:35:39');
/*!40000 ALTER TABLE `projects_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_style`
--

DROP TABLE IF EXISTS `projects_style`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_style` (
  `projects_style_id` int(12) NOT NULL AUTO_INCREMENT,
  `style_id` int(12) NOT NULL DEFAULT 0,
  `project_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) DEFAULT 0,
  `vote_yes` int(6) NOT NULL DEFAULT 0,
  `vote_no` int(6) NOT NULL DEFAULT 0,
  `vote_direction` int(6) NOT NULL DEFAULT 0,
  `vote_ip` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`projects_style_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `profession_id` (`style_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_style`
--

LOCK TABLES `projects_style` WRITE;
/*!40000 ALTER TABLE `projects_style` DISABLE KEYS */;
INSERT INTO `projects_style` (`projects_style_id`, `style_id`, `project_id`, `user_id`, `vote_yes`, `vote_no`, `vote_direction`, `vote_ip`, `stamp`) VALUES (1,3,3,0,0,0,0,'','2006-06-12 05:59:46'),
(2,2,10015,0,0,0,0,'','2006-06-12 23:04:36'),
(3,7,10020,0,0,0,0,'','2006-06-12 23:11:44'),
(4,4,10028,0,0,0,0,'','2006-06-20 04:01:32'),
(5,8,10030,0,0,0,0,'','2006-09-07 17:55:46'),
(6,9,1,0,0,0,0,'','2007-01-19 01:12:05'),
(7,2,1,0,0,1,-1,'76.174.42.36','2007-01-19 01:13:19'),
(8,10,10033,0,0,0,0,'','2011-02-23 01:22:26');
/*!40000 ALTER TABLE `projects_style` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_team`
--

DROP TABLE IF EXISTS `projects_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_team` (
  `projects_team_id` int(12) NOT NULL AUTO_INCREMENT,
  `profession_id` int(12) NOT NULL DEFAULT 0,
  `project_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `vote_yes` int(6) NOT NULL DEFAULT 0,
  `vote_no` int(6) NOT NULL DEFAULT 0,
  `vote_direction` int(6) NOT NULL DEFAULT 0,
  `vote_ip` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`projects_team_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `profession_id` (`profession_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10037 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_team`
--

LOCK TABLES `projects_team` WRITE;
/*!40000 ALTER TABLE `projects_team` DISABLE KEYS */;
INSERT INTO `projects_team` (`projects_team_id`, `profession_id`, `project_id`, `user_id`, `name`, `vote_yes`, `vote_no`, `vote_direction`, `vote_ip`, `stamp`) VALUES (10023,2,10021,100022,'Kathrine Spitz',0,1,-1,'70.23.236.64','2006-05-25 08:11:19'),
(10024,1,10021,NULL,'Edward Anastas',0,1,-1,'70.23.236.64','2006-05-25 08:14:47'),
(10025,7,10021,NULL,'Lisa Someting',0,1,-1,'70.23.236.64','2006-05-25 08:17:53'),
(10026,1,10018,NULL,'Tod Williams',1,0,1,'99.5.111.219','2006-06-01 06:58:41'),
(10027,1,10018,NULL,'Billy Tsien',1,0,1,'99.5.111.219','2006-06-01 06:58:51'),
(10028,1,3,NULL,'Joe Architect',0,1,-1,'70.23.236.64','2006-06-02 05:57:34'),
(10029,2,3,100022,'Edward Anastas',0,1,-1,'70.23.236.64','2006-06-08 06:00:02'),
(10030,1,10015,NULL,'Louis Kahn',1,0,1,'207.224.59.133','2006-06-12 23:03:10'),
(10031,1,10020,NULL,'Eero Saarinen',0,0,0,'','2006-06-12 23:12:19'),
(10032,1,10029,NULL,'Frank Lloyd Wright',0,0,0,'','2006-07-15 06:06:09'),
(10033,1,10030,NULL,'Frank Lloyd Wright',0,0,0,'','2006-07-16 06:33:44'),
(10034,4,10030,NULL,'ROMAN JANCZAK  CONSTRUCTION',0,1,-1,'96.251.49.85','2006-07-16 19:00:49'),
(10035,1,10033,NULL,'Kobori Enshu',0,0,0,'','2011-02-23 01:22:55'),
(10036,1,10029,0,'Shubin Donaldson Architects',0,1,-1,'76.83.168.40','2022-02-25 23:34:30');
/*!40000 ALTER TABLE `projects_team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_title`
--

DROP TABLE IF EXISTS `projects_title`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_title` (
  `projects_title_id` int(12) NOT NULL AUTO_INCREMENT,
  `project_id` int(12) NOT NULL DEFAULT 0,
  `user_id` int(12) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `vote_yes` int(6) NOT NULL DEFAULT 0,
  `vote_no` int(6) NOT NULL DEFAULT 0,
  `vote_direction` int(6) NOT NULL DEFAULT 0,
  `vote_ip` varchar(255) NOT NULL DEFAULT '',
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`projects_title_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_title`
--

LOCK TABLES `projects_title` WRITE;
/*!40000 ALTER TABLE `projects_title` DISABLE KEYS */;
INSERT INTO `projects_title` (`projects_title_id`, `project_id`, `user_id`, `title`, `vote_yes`, `vote_no`, `vote_direction`, `vote_ip`, `stamp`) VALUES (1,1,100022,'Disney Concert Hall',1,0,1,'68.166.232.94','2006-04-24 14:57:23'),
(18,10018,100022,'Neuroscience Institute San Diego',0,0,0,'','2006-05-10 01:51:20'),
(3,3,100022,'Chrysler Building',2,5,-3,'70.23.236.64','2006-04-24 14:57:10'),
(4,10004,100022,'Flatiron Building',0,0,0,'','2006-04-24 22:43:58'),
(22,3,100022,'The Chrysler Building',1,2,-1,'70.23.236.64','2006-06-08 06:18:10'),
(21,10021,100022,'The Salk Institute',13,0,11,'70.23.236.64','2006-05-24 23:02:17'),
(20,10020,100022,'TWA World Flight Center',0,0,0,'','2006-05-17 20:47:27'),
(19,10019,100022,'Christian Dior Building',0,1,-1,'99.126.40.113','2006-05-17 00:59:40'),
(15,10015,100022,'Kimbell Museum',0,0,0,'','2006-04-26 01:23:37'),
(16,10016,100022,'The Wolf House',0,0,0,'','2006-05-08 04:22:23'),
(17,10017,100022,'Hollyhock House',0,0,0,'','2006-05-09 21:22:35'),
(23,10022,100023,'Federation Square',0,0,0,'','2006-06-15 18:25:11'),
(28,10027,100022,'The Statue of Liberty',1,0,1,'166.205.139.49','2006-06-17 15:35:39'),
(27,10026,100023,'Test',0,0,0,'','2006-06-15 18:31:07'),
(29,10028,100024,'Beautiful House',0,0,0,'','2006-06-20 04:00:55'),
(32,10030,100022,'Dana-Thomas House',1,2,-1,'99.5.111.219','2006-07-16 06:24:57'),
(31,10029,100022,'SC Johnson Wax Administration Building',0,0,0,'','2006-07-15 06:09:23'),
(33,10030,100022,'Dana Thomas Residence',1,0,1,'99.5.111.219','2006-07-16 18:56:23'),
(34,10031,100022,'Biomedical Science Research Building',1,0,1,'70.95.117.33','2006-07-16 19:07:55'),
(35,10032,100022,'Columbia University Student Union Building',0,2,-2,'96.251.49.85','2009-12-14 23:41:30'),
(36,10032,100022,'Crystal Lagoon',1,0,1,'99.5.111.219','2009-12-14 23:43:27'),
(37,10033,100022,'Katsura Imperial Villa',0,0,0,'','2011-02-23 01:12:29');
/*!40000 ALTER TABLE `projects_title` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `samples`
--

DROP TABLE IF EXISTS `samples`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `samples` (
  `sample_id` int(12) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `error` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `checkbox` enum('1') DEFAULT NULL,
  `manual` varchar(255) DEFAULT NULL,
  `menu` int(2) DEFAULT NULL,
  `textarea` text DEFAULT NULL,
  PRIMARY KEY (`sample_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `samples`
--

LOCK TABLES `samples` WRITE;
/*!40000 ALTER TABLE `samples` DISABLE KEYS */;
INSERT INTO `samples` (`sample_id`, `fieldname`, `error`, `style`, `checkbox`, `manual`, `menu`, `textarea`) VALUES (1,'kontrastlabs.com','admin@kontrastlabs.com','','',NULL,0,NULL),
(2,'fieldname_test','','colorSecondary','1','manual entry',0,'this has a custom height to six rows, but the width throughout the form is constant via a style sheet setting which can be adjusted for the whole site.'),
(3,'fieldname_test','','colorSecondary','1','manual entry',0,'this has a custom height to six rows, but the width throughout the form is constant via a style sheet setting which can be adjusted for the whole site.'),
(4,'fieldname_test','','colorSecondary','1','manual entry',0,'this has a custom height to six rows, but the width throughout the form is constant via a style sheet setting which can be adjusted for the whole site.'),
(5,'fieldname_test','','colorSecondary','1','manual entry',0,'this has a custom height to six rows, but the width throughout the form is constant via a style sheet setting which can be adjusted for the whole site.'),
(6,'','','','','',0,''),
(7,'','','','','',0,''),
(8,'','','','','',0,'');
/*!40000 ALTER TABLE `samples` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styles`
--

DROP TABLE IF EXISTS `styles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `styles` (
  `style_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) DEFAULT NULL,
  `style` varchar(255) NOT NULL DEFAULT '',
  `approved` enum('1') DEFAULT NULL,
  PRIMARY KEY (`style_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styles`
--

LOCK TABLES `styles` WRITE;
/*!40000 ALTER TABLE `styles` DISABLE KEYS */;
INSERT INTO `styles` (`style_id`, `user_id`, `style`, `approved`) VALUES (1,NULL,'Minimalism','1'),
(2,NULL,'Post Modernism','1'),
(3,NULL,'Classical','1'),
(4,NULL,'Victorian','1'),
(5,NULL,'Vernacular','1'),
(7,NULL,'Art Deco',NULL),
(8,NULL,'usonian',NULL),
(9,NULL,'test',NULL),
(10,NULL,'traditional japanese',NULL);
/*!40000 ALTER TABLE `styles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sustainable`
--

DROP TABLE IF EXISTS `sustainable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sustainable` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `category_id` int(2) NOT NULL DEFAULT 0,
  `sustainable` varchar(255) NOT NULL DEFAULT '',
  `standard` varchar(255) NOT NULL DEFAULT '',
  `cost_installation` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cost_standard_installation` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cost_annual` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cost_standard_annual` decimal(12,2) NOT NULL DEFAULT 0.00,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sustainable`
--

LOCK TABLES `sustainable` WRITE;
/*!40000 ALTER TABLE `sustainable` DISABLE KEYS */;
/*!40000 ALTER TABLE `sustainable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_categories`
--

DROP TABLE IF EXISTS `template_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_categories` (
  `category_id` int(12) NOT NULL AUTO_INCREMENT,
  `domain_id` int(12) DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT '',
  `notes` text NOT NULL,
  `inactive` enum('1') DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `domain_id` (`domain_id`,`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_categories`
--

LOCK TABLES `template_categories` WRITE;
/*!40000 ALTER TABLE `template_categories` DISABLE KEYS */;
INSERT INTO `template_categories` (`category_id`, `domain_id`, `category`, `notes`, `inactive`) VALUES (1,NULL,'residential','',NULL),
(2,NULL,'commercial','',NULL),
(3,NULL,'institutional','',NULL),
(4,NULL,'recreational','',NULL),
(8,1,'Historical Renovation','this is a test note',NULL),
(7,1,'Educational','',NULL),
(10,1,'Inactive Category','','1');
/*!40000 ALTER TABLE `template_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_contacts`
--

DROP TABLE IF EXISTS `template_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_id` int(4) DEFAULT NULL,
  `type` enum('architect','client','consultant','contractor','photographer') DEFAULT NULL,
  `access` int(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_contacts`
--

LOCK TABLES `template_contacts` WRITE;
/*!40000 ALTER TABLE `template_contacts` DISABLE KEYS */;
INSERT INTO `template_contacts` (`contact_id`, `domain_id`, `type`, `access`, `email`, `contact`) VALUES (1,1,NULL,3,'admin@kontrastlabs.com',''),
(12,1,'client',NULL,'','Test Client'),
(11,1,'architect',NULL,'frank@anastas.org','Frank Lloyd Wright'),
(10,1,'client',NULL,'','Pennsylvania Conservancy'),
(13,1,'architect',NULL,'','Test Architect');
/*!40000 ALTER TABLE `template_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_css`
--

DROP TABLE IF EXISTS `template_css`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_css` (
  `css_id` int(12) NOT NULL AUTO_INCREMENT,
  `domain_id` int(12) NOT NULL DEFAULT 0,
  `css` text NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`css_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_css`
--

LOCK TABLES `template_css` WRITE;
/*!40000 ALTER TABLE `template_css` DISABLE KEYS */;
INSERT INTO `template_css` (`css_id`, `domain_id`, `css`, `stamp`) VALUES (1,1,'html {\r\n	/*\r\n	min-width:450px;\r\n	*/\r\n}\r\n\r\n\r\nbody {\r\n	/*\r\n	font-family:\"arial\",\"Helvetica\",\"sans-serif\";\r\n	vertical-align:middle;\r\n	text-align:center;\r\n	color:#555555;\r\n	background-image: url(../images/bg_halftone.gif);\r\n	margin:auto;\r\n	\r\n	background-color: #cccccc;\r\n	*/\r\n	font:13px/14px \"Verdana\",\"Helvetica\",\"sans-serif\";\r\n}\r\n\r\n\r\na,a:link,a:visited,a:active {\r\n	/*\r\n	text-transform:uppercase;\r\n	background-color:white;\r\n	color:#5EA936;\r\n	font-weight:700;\r\n	color:#5EA936;\r\n	*/\r\n	color:#004c91;\r\n	background-color:white;\r\n	text-decoration:underline;\r\n	padding:0px 2px 1px 2px;\r\n}\r\n\r\na:hover {\r\n	/*\r\n	display:block;\r\n	text-decoration:underline;\r\n	color:white;\r\n	padding:0px 12px 1px 12px;\r\n	background-color:#004c91;\r\n	*/\r\n	color:#ffffff;\r\n	background-color:#2A6EAC;\r\n	text-decoration:none;\r\n}\r\n\r\n/****************** LAYOUT *******************/\r\n\r\n#header {\r\n/*\r\n	vertical-align:middle;\r\n	height:750px;\r\n	text-align:center;\r\n	\r\n	background:url(girl.jpg) top right no-repeat;\r\n	text-align:center;\r\n	height:80;\r\n	\r\n	\r\n	vertical-align:middle;\r\n	background-color:#EEEEEE;\r\n	border:dotted gray 1px;\r\n	margin:auto;\r\n	background-color:#ffffff;\r\n	\r\n	\r\n	width:100%;\r\n	\r\n	background-color: #ffffff;\r\n	height:23px;\r\n*/\r\n	padding:4px;\r\n	position:relative;\r\n}\r\n\r\n\r\n\r\n#imageLogoBox {\r\n	/*\r\n	width:250;\r\n	height:50;\r\n	\r\n	right:-1px;\r\n	top:-1px;\r\n	\r\n	background-color:white;\r\n	background-color:#cccccc;\r\n	*/\r\n	position:absolute;\r\n	right:0px;\r\n	top:0px;\r\n	padding:2px 10px 2px 10px;\r\n	border-left:1px dotted gray;\r\n	border-bottom:1px dotted gray;\r\n}\r\n\r\n#imageLogo {\r\n	height:25px;\r\n}\r\n	\r\n	\r\n/*\r\n#imageBox {\r\n	position:absolute;\r\n	right:0px;\r\n	top:0px;\r\n	background-color:white;\r\n	padding:0px 12px 1px 24px;\r\n	border-left:4px solid black;\r\n	border-bottom:2px solid black;\r\n	width:300;\r\n}\r\n*/\r\n\r\n#imageResize {\r\n/*\r\n	max-height:100px;\r\n*/\r\n	width:100%;\r\n	margin:0 auto;\r\n}\r\n\r\n\r\n\r\n\r\n#container {\r\n	/*\r\n		vertical-align:middle;\r\n		height:750px;\r\n		text-align:center;\r\n		\r\n	background:url(girl.jpg) top right no-repeat;\r\n	width:80%;\r\n	padding:30px 18px 10px 8px;\r\n	text-align:center;\r\n	background-image: url(../images/bg_halftone.gif);\r\n	vertical-align:middle;\r\n	\r\n	\r\n	width:650px;\r\n	margin-right:auto;\r\n	margin-left:auto;\r\n	margin-top:10px;\r\n	padding:0px;\r\n	text-align:left;\r\n	*/\r\n	\r\n	width:700;\r\n	position:relative;\r\n	margin:auto;\r\n}\r\n\r\n#content {\r\n	/*\r\n	\r\n	width:400px;\r\n	vertical-align:middle;\r\n	text-align:center;\r\n	background-color:transparent;\r\n	text-align:center;\r\n	width:700;\r\n	margin:auto;\r\n	width:700;\r\n	\r\n	background-color:#ffffff;\r\n	*/\r\n\r\n	width:100%;\r\n	height:95%;\r\n	margin-left:auto;\r\n	margin-right:auto;\r\n	\r\n}\r\n\r\n.colorSecondary {\r\n	color:#96AC20;\r\n}\r\n\r\n\r\nh1 {\r\n	\r\n	/*\r\n	font-size: larger;\r\n	color:#890814;\r\n	color:#0066b3;\r\n	*/\r\n	color:#0066b3;\r\n	margin:0px;\r\n	margin-bottom:3px;\r\n}\r\n\r\nh2 {\r\n	/*\r\n	margin-bottom:2px;\r\n	*/\r\n	color:#596D74;\r\n	margin:0px;\r\n	margin-bottom:8px;\r\n}\r\n\r\nh3 {\r\n	/*\r\n	color:#0B91FF; // lighter blue\r\n	*/\r\n	color:#596D74;\r\n	margin:0px;\r\n}\r\n\r\nh4 {\r\n	\r\n	margin:0px;\r\n}\r\n\r\nh5 {\r\n	font-weight:normal;\r\n	margin:0px;\r\n}\r\n\r\nh6 {\r\n	\r\n	margin:0px;\r\n}\r\n\r\nul {\r\n	/*\r\n	content: \"\\0020 \\0020 \\0020 \\00BB \\0020\";\r\n	display: inline;\r\n	&#187;\r\n	list-style: rectangle;\r\n	\r\n	list-style-position: outside;\r\n	padding-left:0px;\r\n	text-indent:20px;\r\n	list-style: none;\r\n	*/\r\n	list-style-position: outside;\r\n	padding-left:20px;\r\n}\r\n\r\nli.spacer {\r\n	/*\r\nul li:before {\r\n	list-style: none;\r\n	list-style: \"\\00BB \\0020\"; // did not work\r\n	content: \"\\00BB \\0020\";\r\n	*/\r\n	padding-bottom:10px;\r\n}\r\n\r\n.TextGray {\r\n	color: #777777; }\r\n\r\n\r\n\r\n#text {\r\n/*\r\n\r\n	width:400px;\r\n	vertical-align:middle;\r\n	text-align:center;\r\n*/\r\n	width:100%;\r\n	text-align:center;\r\n	margin:auto;\r\n	border:solid white 1px;\r\n	background-image: url(../images/bg_halftone.gif);\r\n	background-color:gray;\r\n	color:white;\r\n	padding:0 10 10 10;\r\n}\r\n\r\n\r\n/**********  **********/\r\n\r\n.packagesBoxes {\r\n	/*\r\n	padding:10px;border:solid gray 1px;background-color:lightgray;text-align:center\r\n	\r\n	background-color: #FFED6F;\r\n	border: 1px solid #B7A000;\r\n	height:200px;\r\n	*/\r\n	border: 1px solid #B7A000;\r\n	position:relative;\r\n	\r\n	height:100%;\r\n	padding: 10px;\r\n	text-align:center;\r\n	vertical-align:center;\r\n}\r\n\r\n.packagesPrices {\r\n	/*\r\n	padding:10px;border:solid gray 1px;background-color:lightgray;text-align:center\r\n	*/\r\n	position:absolute;\r\n	bottom:70px;\r\n	text-align:center;\r\n	width:90%;\r\n	border:red 1px dotted;\r\n}\r\n\r\n\r\n.packagesRadio {\r\n	/*\r\n	padding:10px;border:solid gray 1px;background-color:lightgray;text-align:center\r\n	\r\n	border:red 1px dotted;\r\n	\r\n	position:absolute;\r\n	width:90%;\r\n	bottom:20px;\r\n	text-align:center;\r\n	display:block;\r\n	\r\n	border:red 1px dotted;\r\n	*/\r\n	\r\n	position:absolute;\r\n	width:90%;\r\n	bottom:15px;\r\n	text-align:center;\r\n	display:block;\r\n}\r\n\r\nh3.packageFeatures {\r\n	/*\r\n	text-decoration:underline;\r\n	*/\r\n	color:#314551;\r\n}\r\n\r\n.packageDetailsBox {\r\n	/*\r\n	height:250px;\r\n	*/\r\n	\r\n	position:relative;\r\n}\r\n\r\n.packageDetails {\r\n	/*\r\n	position:absolute;\r\n	vertical-align:middle;\r\n	position:absolute;\r\n	visibility:hidden;\r\n	width:90%;\r\n	height:300px;\r\n	height:100%;\r\n	\r\n	border:solid gray 1px;\r\n	background-color:#BFDDFF;\r\n	*/\r\n	position:absolute;\r\n	top:0px;\r\n	left:0px;\r\n	padding:15px;\r\n	border:solid gray 1px;\r\n	background-color:#BFDDFF;\r\n	visibility:hidden;\r\n}\r\n\r\n.packageContinue {\r\n	/*\r\n	*/\r\n	\r\n	float:right;\r\n	padding-top:10px;\r\n	padding-right:40px;\r\n}\r\n\r\n\r\n.packagePromotion {\r\n	/*\r\n	height:50px;\r\n	*/\r\n	padding:8px;\r\n	margin:4px;\r\n	background-color:#D9ECFF;\r\n	border:dotted gray thin;\r\n	text-align:center;\r\n}\r\n\r\n\r\n\r\n.packageSale {\r\n	/*\r\n	height:50px;\r\n	padding:8px;\r\n	margin:4px;\r\n	background-color:#D9ECFF;\r\n	border:dotted gray thin;\r\n	text-align:center;\r\n	*/\r\n	position:absolute;\r\n	top:53px;\r\n	left:70px;\r\n}\r\n\r\n','2006-01-08 05:39:30');
/*!40000 ALTER TABLE `template_css` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_departments`
--

DROP TABLE IF EXISTS `template_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_departments` (
  `department_id` int(12) NOT NULL AUTO_INCREMENT,
  `domain_id` int(12) DEFAULT NULL,
  `department` varchar(255) NOT NULL DEFAULT '',
  `notes` text DEFAULT NULL,
  `inactive` enum('1') DEFAULT NULL,
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `domain_id` (`domain_id`,`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_departments`
--

LOCK TABLES `template_departments` WRITE;
/*!40000 ALTER TABLE `template_departments` DISABLE KEYS */;
INSERT INTO `template_departments` (`department_id`, `domain_id`, `department`, `notes`, `inactive`) VALUES (1,NULL,'architecture',NULL,NULL),
(2,NULL,'landscape architecture',NULL,NULL),
(3,NULL,'interior',NULL,NULL),
(4,NULL,'engineering',NULL,NULL),
(5,NULL,'construction',NULL,NULL),
(6,NULL,'graphic design',NULL,NULL),
(7,NULL,'visualization',NULL,NULL),
(17,1,'3D Animation',NULL,NULL),
(30,1,'Visual Effects 2','This category is for...',NULL),
(16,1,'Visual Effects','This category is for...',NULL),
(31,1,'Inactive Department','','1');
/*!40000 ALTER TABLE `template_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_domains`
--

DROP TABLE IF EXISTS `template_domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_domains` (
  `domain_id` int(4) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL DEFAULT '',
  `address_id` int(12) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`domain_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_domains`
--

LOCK TABLES `template_domains` WRITE;
/*!40000 ALTER TABLE `template_domains` DISABLE KEYS */;
INSERT INTO `template_domains` (`domain_id`, `domain`, `address_id`, `company`) VALUES (1,'archtemplate.com',NULL,'Kontrast Labs Demo');
/*!40000 ALTER TABLE `template_domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_errors`
--

DROP TABLE IF EXISTS `template_errors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_errors` (
  `error_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `domain_id` int(2) DEFAULT NULL,
  `error` text DEFAULT NULL,
  `error_mysql` text DEFAULT NULL,
  `sql` text DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `posted` text DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `line` int(10) DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  `session_id` int(32) DEFAULT NULL,
  `http_host` varchar(255) DEFAULT NULL,
  `remote_addr` varchar(255) DEFAULT NULL,
  `http_user_agent` varchar(255) DEFAULT NULL,
  `debug` text DEFAULT NULL,
  `server` text DEFAULT NULL,
  `requested` text DEFAULT NULL,
  `session` text DEFAULT NULL,
  `saved` enum('1') DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`error_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_errors`
--

LOCK TABLES `template_errors` WRITE;
/*!40000 ALTER TABLE `template_errors` DISABLE KEYS */;
INSERT INTO `template_errors` (`error_id`, `user_id`, `admin_id`, `level`, `domain_id`, `error`, `error_mysql`, `sql`, `action`, `posted`, `filename`, `file`, `line`, `function`, `session_id`, `http_host`, `remote_addr`, `http_user_agent`, `debug`, `server`, `requested`, `session`, `saved`, `stamp`) VALUES (1,100022,NULL,NULL,NULL,'there was an error searching for matching projects while trying to add a new project','Table \'archx_01.projects_titles\' doesn\'t exist','SELECT * FROM projects_titles \n			WHERE title LIKE \'%Biomedical Science Research Building%\'',NULL,'Array\n(\n    [title] => Biomedical Science Research Building\n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',368,'error',457927,'www.archxchange.com','66.146.215.39','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 368\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error searching for matching projects while trying to add a new project\n                    [1] => SELECT * FROM projects_titles \n			WHERE title LIKE \'%Biomedical Science Research Building%\'\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:2:\"63\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"PHPSESSID=457927fd6a1f8d910c7a75150c983b32; id=b8c06e4a8168ede86fcf689a91daaad919cd51eb\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:48:\"http://www.archxchange.com/add_project.php?start\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:13:\"66.146.215.39\";s:11:\"REMOTE_PORT\";s:5:\"60143\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Biomedical Science Research Building\n    [CONTINUE] => Continue...\n    [PHPSESSID] => 457927fd6a1f8d910c7a75150c983b32\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n)\n','Array\n(\n    [config_redirect] => \n    [user_id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [password] => 700a3e8b88ea352b657e444dfdbee10134c7238c\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Biomedical Science Research Building\n                )\n\n        )\n\n)\n',NULL,'2006-07-15 05:50:32'),
(2,100022,NULL,NULL,NULL,'there was an error searching for matching projects while trying to add a new project','Table \'archx_01.projects_titles\' doesn\'t exist','SELECT * FROM projects_titles \n			WHERE title LIKE \'%Biomedical Science Research Building%\'',NULL,'Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => \n    [metro_id] => \n)\n','add_project.php','add_project.php',368,'error',457927,'www.archxchange.com','66.146.215.39','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 368\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error searching for matching projects while trying to add a new project\n                    [1] => SELECT * FROM projects_titles \n			WHERE title LIKE \'%Biomedical Science Research Building%\'\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:2:\"64\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"PHPSESSID=457927fd6a1f8d910c7a75150c983b32; id=b8c06e4a8168ede86fcf689a91daaad919cd51eb\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:13:\"66.146.215.39\";s:11:\"REMOTE_PORT\";s:5:\"60148\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => \n    [metro_id] => \n    [PHPSESSID] => 457927fd6a1f8d910c7a75150c983b32\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n)\n','Array\n(\n    [config_redirect] => \n    [user_id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [password] => 700a3e8b88ea352b657e444dfdbee10134c7238c\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Biomedical Science Research Building\n                )\n\n        )\n\n)\n',NULL,'2006-07-15 05:50:36'),
(3,100022,NULL,NULL,NULL,'there was an error searching for matching projects while trying to add a new project','Table \'archx_01.projects_titles\' doesn\'t exist','SELECT * FROM projects_titles \n			WHERE title LIKE \'%Biomedical Science Research Building%\'',NULL,'Array\n(\n    [title] => Biomedical Science Research Building\n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',368,'error',457927,'www.archxchange.com','66.146.215.39','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 368\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error searching for matching projects while trying to add a new project\n                    [1] => SELECT * FROM projects_titles \n			WHERE title LIKE \'%Biomedical Science Research Building%\'\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:2:\"63\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"PHPSESSID=457927fd6a1f8d910c7a75150c983b32; id=b8c06e4a8168ede86fcf689a91daaad919cd51eb\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:48:\"http://www.archxchange.com/add_project.php?start\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:13:\"66.146.215.39\";s:11:\"REMOTE_PORT\";s:5:\"60183\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Biomedical Science Research Building\n    [CONTINUE] => Continue...\n    [PHPSESSID] => 457927fd6a1f8d910c7a75150c983b32\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n)\n','Array\n(\n    [config_redirect] => \n    [user_id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [password] => 700a3e8b88ea352b657e444dfdbee10134c7238c\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Biomedical Science Research Building\n                )\n\n        )\n\n)\n',NULL,'2006-07-15 06:01:38'),
(4,100022,NULL,NULL,NULL,'there was an error searching for matching projects while trying to add a new project','Table \'archx_01.projects_titles\' doesn\'t exist','SELECT * FROM projects_titles \n			WHERE title LIKE \'%Biomedical Science Research Building%\'',NULL,'Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => 223\n    [metro_id] => \n)\n','add_project.php','add_project.php',368,'error',457927,'www.archxchange.com','66.146.215.39','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 368\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error searching for matching projects while trying to add a new project\n                    [1] => SELECT * FROM projects_titles \n			WHERE title LIKE \'%Biomedical Science Research Building%\'\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:2:\"67\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"PHPSESSID=457927fd6a1f8d910c7a75150c983b32; id=b8c06e4a8168ede86fcf689a91daaad919cd51eb\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:13:\"66.146.215.39\";s:11:\"REMOTE_PORT\";s:5:\"60187\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => 223\n    [metro_id] => \n    [PHPSESSID] => 457927fd6a1f8d910c7a75150c983b32\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n)\n','Array\n(\n    [config_redirect] => \n    [user_id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [password] => 700a3e8b88ea352b657e444dfdbee10134c7238c\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Biomedical Science Research Building\n                )\n\n        )\n\n)\n',NULL,'2006-07-15 06:01:42'),
(5,100022,NULL,NULL,NULL,'there was an error inserting the new project TITLE','Table \'archx_01.projects_titles\' doesn\'t exist','INSERT INTO projects_titles SET \n					project_id = \'10029\', \n					user_id = \'100022\', \n					title = \'Biomedical Science Research Building\'',NULL,'Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => 223\n    [zone_id] => 64\n    [metro_id] => Milwaukee\n    [address_01] => 1525 Howe St\n    [city] => Racine\n    [postal_code] => 53403\n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',167,'error',457927,'www.archxchange.com','66.146.215.39','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 167\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error inserting the new project TITLE\n                    [1] => INSERT INTO projects_titles SET \n					project_id = \'10029\', \n					user_id = \'100022\', \n					title = \'Biomedical Science Research Building\'\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:3:\"162\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"PHPSESSID=457927fd6a1f8d910c7a75150c983b32; id=b8c06e4a8168ede86fcf689a91daaad919cd51eb\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:13:\"66.146.215.39\";s:11:\"REMOTE_PORT\";s:5:\"60201\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => 223\n    [zone_id] => 64\n    [metro_id] => Milwaukee\n    [address_01] => 1525 Howe St\n    [city] => Racine\n    [postal_code] => 53403\n    [CONTINUE] => Continue...\n    [PHPSESSID] => 457927fd6a1f8d910c7a75150c983b32\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n)\n','Array\n(\n    [config_redirect] => \n    [user_id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [password] => 700a3e8b88ea352b657e444dfdbee10134c7238c\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Biomedical Science Research Building\n                )\n\n        )\n\n)\n',NULL,'2006-07-15 06:02:47'),
(6,100022,NULL,NULL,NULL,'there was an error inserting the new project LOCATION','Table \'archx_01.projects_locations\' doesn\'t exist','INSERT INTO projects_locations SET \n					project_id = \'10029\', \n					user_id = \'100022\', country_id = \'223\',zone_id = \'64\',metro_id = \'9\',address_01 = \'1525 Howe St\',city = \'Racine\',postal_code = \'53403\',stamp = NOW()',NULL,'Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => 223\n    [zone_id] => 64\n    [metro_id] => Milwaukee\n    [address_01] => 1525 Howe St\n    [city] => Racine\n    [postal_code] => 53403\n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',187,'error',457927,'www.archxchange.com','66.146.215.39','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 187\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error inserting the new project LOCATION\n                    [1] => INSERT INTO projects_locations SET \n					project_id = \'10029\', \n					user_id = \'100022\', country_id = \'223\',zone_id = \'64\',metro_id = \'9\',address_01 = \'1525 Howe St\',city = \'Racine\',postal_code = \'53403\',stamp = NOW()\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:3:\"162\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"PHPSESSID=457927fd6a1f8d910c7a75150c983b32; id=b8c06e4a8168ede86fcf689a91daaad919cd51eb\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:13:\"66.146.215.39\";s:11:\"REMOTE_PORT\";s:5:\"60201\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => 223\n    [zone_id] => 64\n    [metro_id] => Milwaukee\n    [address_01] => 1525 Howe St\n    [city] => Racine\n    [postal_code] => 53403\n    [CONTINUE] => Continue...\n    [PHPSESSID] => 457927fd6a1f8d910c7a75150c983b32\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n)\n','Array\n(\n    [config_redirect] => \n    [user_id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [password] => 700a3e8b88ea352b657e444dfdbee10134c7238c\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Biomedical Science Research Building\n                )\n\n        )\n\n)\n',NULL,'2006-07-15 06:02:47'),
(7,100022,NULL,NULL,NULL,'there was an error searching for matching projects while trying to add a new project','Table \'archx_01.projects_titles\' doesn\'t exist','SELECT * FROM projects_titles \n			WHERE title LIKE \'%Dana Thomas Residence%\'',NULL,'Array\n(\n    [title] => Dana Thomas Residence\n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',368,'error',832,'www.archxchange.com','66.146.212.9','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 368\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error searching for matching projects while trying to add a new project\n                    [1] => SELECT * FROM projects_titles \n			WHERE title LIKE \'%Dana Thomas Residence%\'\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:2:\"48\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"id=b8c06e4a8168ede86fcf689a91daaad919cd51eb; PHPSESSID=832a2252958a48075bb12530f7eb62a5\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:48:\"http://www.archxchange.com/add_project.php?start\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:12:\"66.146.212.9\";s:11:\"REMOTE_PORT\";s:5:\"63077\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Dana Thomas Residence\n    [CONTINUE] => Continue...\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [PHPSESSID] => 832a2252958a48075bb12530f7eb62a5\n)\n','Array\n(\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Dana Thomas Residence\n                )\n\n        )\n\n)\n',NULL,'2006-07-16 06:16:10'),
(8,100022,NULL,NULL,NULL,'there was an error searching for matching projects while trying to add a new project','Table \'archx_01.projects_titles\' doesn\'t exist','SELECT * FROM projects_titles \n			WHERE title LIKE \'%Dana-Thomas House%\'',NULL,'Array\n(\n    [title] => Dana-Thomas House\n    [country_id] => 223\n    [metro_id] => \n)\n','add_project.php','add_project.php',368,'error',832,'www.archxchange.com','66.146.212.9','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 368\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error searching for matching projects while trying to add a new project\n                    [1] => SELECT * FROM projects_titles \n			WHERE title LIKE \'%Dana-Thomas House%\'\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:2:\"48\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"id=b8c06e4a8168ede86fcf689a91daaad919cd51eb; PHPSESSID=832a2252958a48075bb12530f7eb62a5\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:12:\"66.146.212.9\";s:11:\"REMOTE_PORT\";s:5:\"63085\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Dana-Thomas House\n    [country_id] => 223\n    [metro_id] => \n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [PHPSESSID] => 832a2252958a48075bb12530f7eb62a5\n)\n','Array\n(\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Dana Thomas Residence\n                    [1] => Dana-Thomas House\n                )\n\n        )\n\n)\n',NULL,'2006-07-16 06:17:34'),
(9,100022,NULL,NULL,NULL,'there was an error inserting the new project TITLE','Table \'archx_01.projects_titles\' doesn\'t exist','INSERT INTO projects_titles SET \n					project_id = \'10030\', \n					user_id = \'100022\', \n					title = \'Dana-Thomas House\'',NULL,'Array\n(\n    [title] => Dana-Thomas House\n    [country_id] => 223\n    [zone_id] => 23\n    [metro_id] => 9\n    [address_01] => 301 East Lawrence\n    [city] => Springfield\n    [postal_code] => 62703\n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',167,'error',832,'www.archxchange.com','66.146.212.9','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 167\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error inserting the new project TITLE\n                    [1] => INSERT INTO projects_titles SET \n					project_id = \'10030\', \n					user_id = \'100022\', \n					title = \'Dana-Thomas House\'\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:3:\"145\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"id=b8c06e4a8168ede86fcf689a91daaad919cd51eb; PHPSESSID=832a2252958a48075bb12530f7eb62a5\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:12:\"66.146.212.9\";s:11:\"REMOTE_PORT\";s:5:\"63159\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Dana-Thomas House\n    [country_id] => 223\n    [zone_id] => 23\n    [metro_id] => 9\n    [address_01] => 301 East Lawrence\n    [city] => Springfield\n    [postal_code] => 62703\n    [CONTINUE] => Continue...\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [PHPSESSID] => 832a2252958a48075bb12530f7eb62a5\n)\n','Array\n(\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Dana Thomas Residence\n                    [1] => Dana-Thomas House\n                )\n\n        )\n\n)\n',NULL,'2006-07-16 06:19:32'),
(10,100022,NULL,NULL,NULL,'there was an error inserting the new project LOCATION','Table \'archx_01.projects_locations\' doesn\'t exist','INSERT INTO projects_locations SET \n					project_id = \'10030\', \n					user_id = \'100022\', country_id = \'223\',zone_id = \'23\',metro_id = \'9\',address_01 = \'301 East Lawrence\',city = \'Springfield\',postal_code = \'62703\',stamp = NOW()',NULL,'Array\n(\n    [title] => Dana-Thomas House\n    [country_id] => 223\n    [zone_id] => 23\n    [metro_id] => 9\n    [address_01] => 301 East Lawrence\n    [city] => Springfield\n    [postal_code] => 62703\n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',187,'error',832,'www.archxchange.com','66.146.212.9','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 187\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error inserting the new project LOCATION\n                    [1] => INSERT INTO projects_locations SET \n					project_id = \'10030\', \n					user_id = \'100022\', country_id = \'223\',zone_id = \'23\',metro_id = \'9\',address_01 = \'301 East Lawrence\',city = \'Springfield\',postal_code = \'62703\',stamp = NOW()\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:3:\"145\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"id=b8c06e4a8168ede86fcf689a91daaad919cd51eb; PHPSESSID=832a2252958a48075bb12530f7eb62a5\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:12:\"66.146.212.9\";s:11:\"REMOTE_PORT\";s:5:\"63159\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Dana-Thomas House\n    [country_id] => 223\n    [zone_id] => 23\n    [metro_id] => 9\n    [address_01] => 301 East Lawrence\n    [city] => Springfield\n    [postal_code] => 62703\n    [CONTINUE] => Continue...\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [PHPSESSID] => 832a2252958a48075bb12530f7eb62a5\n)\n','Array\n(\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Dana Thomas Residence\n                    [1] => Dana-Thomas House\n                )\n\n        )\n\n)\n',NULL,'2006-07-16 06:19:32'),
(11,100022,NULL,NULL,NULL,'there was an error inserting the new project LOCATION','Table \'archx_01.projects_locations\' doesn\'t exist','INSERT INTO projects_locations SET \n					project_id = \'10031\', \n					user_id = \'100022\', country_id = \'223\',zone_id = \'33\',metro_id = \'10\',address_01 = \'109 Zina Pitcher\',city = \'Ann Arbor\',stamp = NOW()',NULL,'Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => 223\n    [zone_id] => 33\n    [metro_id] => Detroit\n    [address_01] => 109 Zina Pitcher\n    [city] => Ann Arbor\n    [postal_code] => \n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',187,'error',832,'www.archxchange.com','66.146.215.159','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 187\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error inserting the new project LOCATION\n                    [1] => INSERT INTO projects_locations SET \n					project_id = \'10031\', \n					user_id = \'100022\', country_id = \'223\',zone_id = \'33\',metro_id = \'10\',address_01 = \'109 Zina Pitcher\',city = \'Ann Arbor\',stamp = NOW()\n                )\n\n        )\n\n)\n','a:31:{s:4:\"PATH\";s:28:\"/usr/local/bin:/usr/bin:/bin\";s:14:\"CONTENT_LENGTH\";s:3:\"162\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"HTTP_ACCEPT\";s:3:\"*/*\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:2:\"en\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"id=b8c06e4a8168ede86fcf689a91daaad919cd51eb; PHPSESSID=832a2252958a48075bb12530f7eb62a5\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:95:\"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:12:\"REDIRECT_URL\";s:16:\"/add_project.php\";s:11:\"REMOTE_ADDR\";s:14:\"66.146.215.159\";s:11:\"REMOTE_PORT\";s:5:\"63221\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SERVER_ADDR\";s:12:\"69.56.171.56\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:12:\"QUERY_STRING\";s:0:\"\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Biomedical Science Research Building\n    [country_id] => 223\n    [zone_id] => 33\n    [metro_id] => Detroit\n    [address_01] => 109 Zina Pitcher\n    [city] => Ann Arbor\n    [postal_code] => \n    [CONTINUE] => Continue...\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [PHPSESSID] => 832a2252958a48075bb12530f7eb62a5\n)\n','Array\n(\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Biomedical Science Research Building\n                )\n\n        )\n\n)\n',NULL,'2006-07-16 19:07:55'),
(12,100022,NULL,NULL,NULL,'there was an error inserting the new project LOCATION','Table \'archx_01.projects_locations\' doesn\'t exist','INSERT INTO projects_locations SET \n					project_id = \'10032\', \n					user_id = \'100022\', country_id = \'223\',zone_id = \'43\',metro_id = \'4\',stamp = NOW()',NULL,'Array\n(\n    [title] => Columbia University Student Union Building\n    [country_id] => 223\n    [zone_id] => 43\n    [metro_id] => 4\n    [address_01] => \n    [city] => \n    [postal_code] => \n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',187,'error',84,'www.archxchange.com','99.5.111.219','Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 (.NET CLR 3.5.30729)','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 187\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error inserting the new project LOCATION\n                    [1] => INSERT INTO projects_locations SET \n					project_id = \'10032\', \n					user_id = \'100022\', country_id = \'223\',zone_id = \'43\',metro_id = \'4\',stamp = NOW()\n                )\n\n        )\n\n)\n','a:35:{s:14:\"CONTENT_LENGTH\";s:3:\"137\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:17:\"GATEWAY_INTERFACE\";s:7:\"CGI/1.1\";s:11:\"HTTP_ACCEPT\";s:63:\"text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\";s:19:\"HTTP_ACCEPT_CHARSET\";s:30:\"ISO-8859-1,utf-8;q=0.7,*;q=0.7\";s:20:\"HTTP_ACCEPT_ENCODING\";s:12:\"gzip,deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:14:\"en-us,en;q=0.5\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:11:\"HTTP_COOKIE\";s:87:\"PHPSESSID=84bb04e28ad27c9e741e61160c34f885; id=b8c06e4a8168ede86fcf689a91daaad919cd51eb\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:15:\"HTTP_KEEP_ALIVE\";s:3:\"300\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:109:\"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 (.NET CLR 3.5.30729)\";s:4:\"PATH\";s:13:\"/bin:/usr/bin\";s:12:\"QUERY_STRING\";s:0:\"\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:11:\"REMOTE_ADDR\";s:12:\"99.5.111.219\";s:11:\"REMOTE_PORT\";s:4:\"2813\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:11:\"SERVER_ADDR\";s:14:\"75.126.166.160\";s:12:\"SERVER_ADMIN\";s:25:\"webmaster@archxchange.com\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:16:\"SERVER_SIGNATURE\";s:0:\"\";s:15:\"SERVER_SOFTWARE\";s:6:\"Apache\";s:9:\"UNIQUE_ID\";s:24:\"SybNKkt@kEoAAGP0caMAAACQ\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:12:\"REQUEST_TIME\";i:1260834090;s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Columbia University Student Union Building\n    [country_id] => 223\n    [zone_id] => 43\n    [metro_id] => 4\n    [address_01] => \n    [city] => \n    [postal_code] => \n    [CONTINUE] => Continue...\n    [PHPSESSID] => 84bb04e28ad27c9e741e61160c34f885\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n)\n','Array\n(\n    [config_redirect] => \n    [user_id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [password] => 700a3e8b88ea352b657e444dfdbee10134c7238c\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Columbia University Student Union Building\n                )\n\n        )\n\n)\n',NULL,'2009-12-14 23:41:30'),
(13,100022,NULL,NULL,NULL,'there was an error inserting the new project LOCATION','Table \'archx_01.projects_locations\' doesn\'t exist','INSERT INTO projects_locations SET \n					project_id = \'10033\', \n					user_id = \'100022\', country_id = \'107\',metro_id = \'11\',city = \'Kyoto\',stamp = NOW()',NULL,'Array\n(\n    [title] => Katsura Imperial Villa\n    [country_id] => 107\n    [metro_id] => Kyoto\n    [address_01] => \n    [city] => Kyoto\n    [postal_code] => \n    [CONTINUE] => Continue...\n)\n','add_project.php','add_project.php',187,'error',50,'www.archxchange.com','99.126.40.113','Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.98 Safari/534.13','Array\n(\n    [0] => Array\n        (\n            [file] => /home/archx/public_html/add_project.php\n            [line] => 187\n            [function] => error\n            [args] => Array\n                (\n                    [0] => there was an error inserting the new project LOCATION\n                    [1] => INSERT INTO projects_locations SET \n					project_id = \'10033\', \n					user_id = \'100022\', country_id = \'107\',metro_id = \'11\',city = \'Kyoto\',stamp = NOW()\n                )\n\n        )\n\n)\n','a:34:{s:11:\"HTTP_ACCEPT\";s:90:\"application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\";s:19:\"HTTP_ACCEPT_CHARSET\";s:30:\"ISO-8859-1,utf-8;q=0.7,*;q=0.3\";s:20:\"HTTP_ACCEPT_ENCODING\";s:17:\"gzip,deflate,sdch\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:14:\"en-US,en;q=0.8\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:12:\"CONTENT_TYPE\";s:33:\"application/x-www-form-urlencoded\";s:14:\"CONTENT_LENGTH\";s:3:\"115\";s:11:\"HTTP_COOKIE\";s:87:\"PHPSESSID=50d0cae3b355a5394dd966b7404966ca; id=b8c06e4a8168ede86fcf689a91daaad919cd51eb\";s:9:\"HTTP_HOST\";s:19:\"www.archxchange.com\";s:12:\"HTTP_REFERER\";s:42:\"http://www.archxchange.com/add_project.php\";s:15:\"HTTP_USER_AGENT\";s:118:\"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.98 Safari/534.13\";s:18:\"HTTP_CACHE_CONTROL\";s:9:\"max-age=0\";s:11:\"HTTP_ORIGIN\";s:26:\"http://www.archxchange.com\";s:13:\"DOCUMENT_ROOT\";s:23:\"/home/archx/public_html\";s:11:\"REMOTE_ADDR\";s:13:\"99.126.40.113\";s:11:\"REMOTE_PORT\";s:5:\"12555\";s:11:\"SERVER_ADDR\";s:14:\"75.126.166.160\";s:11:\"SERVER_NAME\";s:19:\"www.archxchange.com\";s:11:\"SERVER_PORT\";s:2:\"80\";s:11:\"REQUEST_URI\";s:16:\"/add_project.php\";s:15:\"REDIRECT_STATUS\";s:3:\"200\";s:15:\"SCRIPT_FILENAME\";s:39:\"/home/archx/public_html/add_project.php\";s:12:\"QUERY_STRING\";s:0:\"\";s:10:\"SCRIPT_URI\";s:42:\"http://www.archxchange.com/add_project.php\";s:10:\"SCRIPT_URL\";s:16:\"/add_project.php\";s:11:\"SCRIPT_NAME\";s:16:\"/add_project.php\";s:15:\"SERVER_PROTOCOL\";s:8:\"HTTP/1.1\";s:15:\"SERVER_SOFTWARE\";s:9:\"LiteSpeed\";s:14:\"REQUEST_METHOD\";s:4:\"POST\";s:8:\"PHP_SELF\";s:16:\"/add_project.php\";s:5:\"PHPRC\";s:23:\"/home/archx/public_html\";s:12:\"REQUEST_TIME\";i:1298423549;s:4:\"argv\";a:0:{}s:4:\"argc\";i:0;}','Array\n(\n    [title] => Katsura Imperial Villa\n    [country_id] => 107\n    [metro_id] => Kyoto\n    [address_01] => \n    [city] => Kyoto\n    [postal_code] => \n    [CONTINUE] => Continue...\n    [PHPSESSID] => 50d0cae3b355a5394dd966b7404966ca\n    [id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n)\n','Array\n(\n    [user_id] => b8c06e4a8168ede86fcf689a91daaad919cd51eb\n    [password] => 700a3e8b88ea352b657e444dfdbee10134c7238c\n    [project] => Array\n        (\n            [title] => Array\n                (\n                    [0] => Katsura Imperial Villa\n                )\n\n        )\n\n)\n',NULL,'2011-02-23 01:12:29');
/*!40000 ALTER TABLE `template_errors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_images`
--

DROP TABLE IF EXISTS `template_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_images` (
  `image_id` int(12) NOT NULL AUTO_INCREMENT,
  `domain_id` int(12) NOT NULL DEFAULT 0,
  `project_id` int(12) DEFAULT NULL,
  `type_id` int(2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `contact_id` int(12) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` int(12) DEFAULT NULL,
  `file_width` int(4) DEFAULT NULL,
  `file_height` int(4) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_images`
--

LOCK TABLES `template_images` WRITE;
/*!40000 ALTER TABLE `template_images` DISABLE KEYS */;
INSERT INTO `template_images` (`image_id`, `domain_id`, `project_id`, `type_id`, `type`, `contact_id`, `file_type`, `file_size`, `file_width`, `file_height`, `file_name`, `title`, `caption`, `date`, `stamp`) VALUES (15,1,0,1,NULL,0,'image/png',4304,NULL,NULL,'all_things_organic.png',NULL,'this is a test caption','2006-01-11','2006-01-17 21:34:09'),
(25,1,8,1,NULL,0,'image/jpeg',5304,NULL,NULL,'usa_bio_organic.jpg',NULL,NULL,'2006-01-01','2006-01-18 03:40:17'),
(62,1,8,1,NULL,0,'image/png',2175,NULL,NULL,'24.png',NULL,NULL,NULL,'2006-01-22 07:23:18'),
(63,1,10,3,NULL,0,'image/png',327163,NULL,NULL,'Picture 4.png','BSA Architects Screenshots','These are the screenshots of BSA architects website','2006-01-01','2006-01-22 07:26:08'),
(23,1,8,1,NULL,0,'image/png',4304,NULL,NULL,'all_things_organic.png',NULL,NULL,'2006-01-01','2006-01-18 03:40:17'),
(28,1,2,4,NULL,NULL,'image/jpeg',28823,NULL,NULL,'fw_h320.jpg',NULL,'what is falling water doing with this project?','2006-01-18','2006-01-18 22:25:16'),
(30,1,8,1,NULL,NULL,'image/jpeg',133375,NULL,NULL,'fw_h700.jpg','this is a title','700 height --> changed to bio green','2006-12-31','2006-01-21 16:17:03'),
(51,1,1,1,NULL,0,'image/png',373420,NULL,NULL,'pugh-scarpa.com-project browser.png',NULL,NULL,NULL,'2006-01-19 19:24:42'),
(34,1,8,1,NULL,0,'image/png',4304,NULL,NULL,'all_things_organic.png',NULL,NULL,NULL,'2006-01-18 05:32:35'),
(52,1,1,1,NULL,0,'image/png',415565,NULL,NULL,'pugh-scarpa.com-office.png','pugh-scarp office','office page','2006-01-01','2006-01-19 19:35:13'),
(54,1,1,1,NULL,0,'image/png',304455,NULL,NULL,'pugh-scarpa.com-project info.png',NULL,NULL,NULL,'2006-01-19 23:56:53'),
(55,1,1,1,NULL,0,'image/png',493061,NULL,NULL,'pugh-scarpa.com-portfolio.png',NULL,NULL,NULL,'2006-01-20 00:01:26'),
(56,1,1,1,NULL,0,'image/png',415565,NULL,NULL,'pugh-scarpa.com-office.png',NULL,NULL,NULL,'2006-01-20 00:31:22'),
(57,1,2,2,NULL,0,'image/jpeg',175181,NULL,NULL,'mail.jpg','Just a title of the convention LA','test','2006-02-01','2006-01-22 02:32:03'),
(58,1,2,1,NULL,0,'image/jpeg',11435,NULL,NULL,'victor horta_tassel house_03.jpg','Test images for the front end','This are just test images  for large size test uploads','2001-01-01','2006-01-22 02:34:48'),
(59,1,2,1,NULL,0,'image/jpeg',30081,NULL,NULL,'victor horta_tassel house_02.jpg','Test images for the front end','This are just test images  for large size test uploads','2001-01-01','2006-01-22 02:34:48'),
(60,1,2,1,NULL,0,'image/jpeg',8722,NULL,NULL,'Model_60.jpg','Test images for the front end','This are just test images  for large size test uploads','2001-01-01','2006-01-22 02:34:49'),
(61,1,2,1,NULL,0,'image/jpeg',1144638,NULL,NULL,'DSC04459.JPG','Test images for the front end','This are just test images  for large size test uploads','2001-01-01','2006-01-22 02:34:49'),
(64,1,10,3,NULL,0,'image/png',381661,NULL,NULL,'Picture 2.png','BSA Architects Screenshots','These are the screenshots of BSA architects website','2006-01-01','2006-01-22 07:26:10'),
(65,1,10,3,NULL,0,'image/png',244942,NULL,NULL,'Picture 5.png','BSA Architects Screenshots','These are the screenshots of BSA architects website','2006-01-01','2006-01-22 07:26:12'),
(66,1,10,3,NULL,0,'image/png',134517,NULL,NULL,'Picture 7.png','BSA Architects Screenshots','These are the screenshots of BSA architects website','2006-01-01','2006-01-22 07:26:14'),
(67,1,10,3,NULL,0,'image/png',393011,NULL,NULL,'Picture 10.png','BSA Architects Screenshots','These are the screenshots of BSA architects website','2006-01-01','2006-01-22 07:26:16'),
(68,1,11,1,NULL,0,'image/png',240107,NULL,NULL,'Picture 2.png','These are the screenshots from re4a.com','yes they are','2006-04-01','2006-01-22 07:29:23'),
(69,1,11,1,NULL,0,'image/png',239883,NULL,NULL,'Picture 3.png','These are the screenshots from re4a.com','yes they are','2006-04-01','2006-01-22 07:29:24'),
(70,1,11,1,NULL,0,'image/png',470182,NULL,NULL,'Picture 4.png','These are the screenshots from re4a.com','yes they are','2006-04-01','2006-01-22 07:29:25'),
(72,1,12,1,NULL,0,'image/png',337841,NULL,NULL,'Picture 2.png','hksinc.com screenshot','this is a test caption for hks architecture website hks.com','2006-07-01','2006-01-22 07:31:05'),
(73,1,12,1,NULL,0,'image/png',323985,NULL,NULL,'Picture 3.png','hksinc.com screenshot','this is a test caption for hks architecture website hks.com','2006-07-01','2006-01-22 07:31:07'),
(74,1,12,1,NULL,0,'image/png',148135,NULL,NULL,'Picture 4.png','hksinc.com screenshot','this is a test caption for hks architecture website hks.com','2006-07-01','2006-01-22 07:31:10'),
(75,1,12,1,NULL,0,'image/png',116904,NULL,NULL,'Picture 5.png','hksinc.com screenshot','this is a test caption for hks architecture website hks.com','2006-07-01','2006-01-22 07:31:12');
/*!40000 ALTER TABLE `template_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_members`
--

DROP TABLE IF EXISTS `template_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_id` int(4) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `access` int(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `custnum` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_members`
--

LOCK TABLES `template_members` WRITE;
/*!40000 ALTER TABLE `template_members` DISABLE KEYS */;
INSERT INTO `template_members` (`member_id`, `domain_id`, `username`, `password`, `access`, `email`, `firstname`, `lastname`, `phone`) VALUES (1,1,'kontrast','238a6a532a6e06f74d11d671e30aa4d6d4e81fb3',NULL,'admin@kontrastlabs.com','edward','anastas',NULL);
/*!40000 ALTER TABLE `template_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_notifications`
--

DROP TABLE IF EXISTS `template_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_notifications` (
  `notification_id` int(12) NOT NULL AUTO_INCREMENT,
  `dismissed` enum('1') NOT NULL DEFAULT '1',
  `notification` text NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_notifications`
--

LOCK TABLES `template_notifications` WRITE;
/*!40000 ALTER TABLE `template_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `template_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_project_departments`
--

DROP TABLE IF EXISTS `template_project_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_project_departments` (
  `project_id` int(12) NOT NULL DEFAULT 0,
  `department_id` int(12) NOT NULL DEFAULT 0,
  UNIQUE KEY `project_id` (`project_id`,`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_project_departments`
--

LOCK TABLES `template_project_departments` WRITE;
/*!40000 ALTER TABLE `template_project_departments` DISABLE KEYS */;
INSERT INTO `template_project_departments` (`project_id`, `department_id`) VALUES (0,1),
(2,1),
(2,16),
(2,17),
(2,30),
(8,1),
(8,3),
(8,5),
(8,7),
(8,17);
/*!40000 ALTER TABLE `template_project_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_projects`
--

DROP TABLE IF EXISTS `template_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_projects` (
  `project_id` int(12) NOT NULL AUTO_INCREMENT,
  `domain_id` int(12) NOT NULL DEFAULT 0,
  `category_id` int(12) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `client_id` int(12) NOT NULL DEFAULT 0,
  `architect_id` int(12) NOT NULL DEFAULT 0,
  `site` text NOT NULL,
  `design` text NOT NULL,
  `construction` text NOT NULL,
  `date_design` date DEFAULT NULL,
  `date_completion` date DEFAULT NULL,
  `date_construction` date DEFAULT NULL,
  `stamp` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_projects`
--

LOCK TABLES `template_projects` WRITE;
/*!40000 ALTER TABLE `template_projects` DISABLE KEYS */;
INSERT INTO `template_projects` (`project_id`, `domain_id`, `category_id`, `title`, `client_id`, `architect_id`, `site`, `design`, `construction`, `date_design`, `date_completion`, `date_construction`, `stamp`) VALUES (1,1,1,'Pugh-Scarpa',12,13,'This is the site description','This is the Design description','This is the construction description is this YES!','2006-01-01',NULL,NULL,'2006-01-12 01:38:39'),
(2,1,7,'Sample project',12,13,'This is the site description of the project which maybe should go at the end of these descriptions. The Design description is the most important, therefor it maybe should go first.','THESE ARE CAPITALS AND...\r\n\r\nThe design description should go here which will probably be the longest description, so the edit box is the larges. There could be an option to adjust the size of this box manually if someone need it larger.\r\n\r\nConsider changing this to be like the flickr mousover where a new window pops up over the text that is very large with plenty of space to edit the descriptions.\r\n\r\nTest the length of the description.','There is no construction description for this project.','2006-01-01','2006-01-03','2006-01-02','2006-01-12 01:38:39'),
(8,1,3,'Falling Water Residence',10,11,'The site is located over a waterfall where you can hear the water.','design','Tokyo International Forum','2006-08-24','2007-09-12','2007-01-18','2006-01-12 22:31:05'),
(9,1,1,'Another Project',12,13,'do you really need a site description too! Make this not required','this is a design description','',NULL,NULL,NULL,'2006-01-20 06:22:25'),
(10,1,1,'BSA Architects Website',12,13,'something else','something','',NULL,NULL,NULL,'2006-01-22 07:24:31'),
(11,1,1,'Resolution for Archtiecture',12,13,'found at re4a.com','This is teh website for resolution for architecure','',NULL,NULL,NULL,'2006-01-22 07:28:16'),
(12,1,1,'hksinc.com',12,13,'test','test','',NULL,NULL,NULL,'2006-01-22 07:30:07');
/*!40000 ALTER TABLE `template_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_tickets`
--

DROP TABLE IF EXISTS `template_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_tickets` (
  `ticket_id` int(12) NOT NULL AUTO_INCREMENT,
  `domain_id` int(12) NOT NULL DEFAULT 0,
  `admin_id` int(12) NOT NULL DEFAULT 0,
  `email` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `priority` int(1) NOT NULL DEFAULT 3,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `question` text NOT NULL,
  `closed` enum('1') DEFAULT NULL,
  `viewed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_tickets`
--

LOCK TABLES `template_tickets` WRITE;
/*!40000 ALTER TABLE `template_tickets` DISABLE KEYS */;
INSERT INTO `template_tickets` (`ticket_id`, `domain_id`, `admin_id`, `email`, `category`, `priority`, `subject`, `question`, `closed`, `viewed`, `created`) VALUES (1,1,0,'edward@anastas.org','CSS/Template',1,'Just a test Ticket','This is a test ticket for the second time! comm&#039;n man!\r\n\r\nFollowing the introduction of the new Discussions the old links from my original User Tips thread no longer work.\r\n\r\nSince all the User Tips, now in the User Tips Library, are in no particular order and spread over 9 pages, I have sorted them in order based on the Knowledge Base Keywords.\r\n\r\nEach section will be posted as a new post in this thread, the title of the section will be in the Subject field of the post and will be in alphabetical order. So it should be easier to zero in on a particular User Tip.\r\n\r\nUndoubtably, in the months to come they will be a Rev. C, Rev. D... etc. We\'ll worry about that at that time ;-)\r\n',NULL,'2006-03-09 07:40:11','2006-03-09 01:58:29'),
(2,1,0,'edward@anastas.org','General',2,'another test ticket','rank Canzolino - kair: AirPort Express (AX) FAQ Part 1\r\nhttp://discussions.apple.com/thread.jspa?threadID=224189\r\n\r\nModem Geek - kair: What\'s the best way to use Profiles?\r\nhttp://discussions.apple.com/thread.jspa?threadID=121763\r\n\r\nSteve Newstrum - kair: Why can\'t I connect to my D-Link DI-514?\r\nhttp://discussions.apple.com/thread.jspa?threadID=121757\r\n\r\nsathomasga - kair: How to Disable DHCP while Maintaining NA\r\nhttp://discussions.apple.com/thread.jspa?threadID=121990\r\n\r\nDuane - kair: Can I Fax from the AirPort Base Station?\r\nhttp://discussions.apple.com/thread.jspa?threadID=122595\r\n\r\nFrank Canzolino - kair: Tiger and Lost Wireless Network Connectivity\r\nhttp://discussions.apple.com/thread.jspa?threadID=121824\r\n\r\nFrank Canzolino - kair: Locations, Port Configurations and Manual IP Addressing\r\nhttp://discussions.apple.com/thread.jspa?threadID=121802',NULL,'2006-03-09 07:40:11','2006-03-07 02:21:02');
/*!40000 ALTER TABLE `template_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_tickets_responses`
--

DROP TABLE IF EXISTS `template_tickets_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_tickets_responses` (
  `ticket_id` int(12) NOT NULL DEFAULT 0,
  `response` text NOT NULL,
  `viewed` timestamp NULL DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_tickets_responses`
--

LOCK TABLES `template_tickets_responses` WRITE;
/*!40000 ALTER TABLE `template_tickets_responses` DISABLE KEYS */;
/*!40000 ALTER TABLE `template_tickets_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `translations` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('word','phrase','form','faq','error','product','description') NOT NULL DEFAULT 'word',
  `notes` text DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `en` text NOT NULL,
  `fr` text NOT NULL,
  `de` text NOT NULL,
  `es` text NOT NULL,
  PRIMARY KEY (`trans_id`)
) ENGINE=MyISAM AUTO_INCREMENT=179 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `access` int(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `timezone_id` int(11) DEFAULT NULL,
  `profession_id` int(12) DEFAULT NULL,
  `logins` int(11) DEFAULT NULL,
  `email_date` date NOT NULL DEFAULT '0000-00-00',
  `no_email` enum('1') DEFAULT NULL,
  `reg_date` date NOT NULL DEFAULT '0000-00-00',
  `comments` text DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `language_code` char(2) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `custnum` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=100025 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `username`, `access`, `email`, `password`, `firstname`, `lastname`, `timezone_id`, `profession_id`, `logins`, `email_date`, `no_email`, `reg_date`, `comments`, `stamp`, `language_code`) VALUES (100014,'admin',9,'admin@kontrastlabs.com','a92820567fa370954178a7dfd0ea5901e8cfa333','System','Administrator',11,NULL,NULL,'0000-00-00',NULL,'2004-05-19',NULL,'2006-05-01 03:13:42','en'),
(100022,'anastas',7,'edward@anastas.org','a92820567fa370954178a7dfd0ea5901e8cfa333','edward','anastas',NULL,1,NULL,'0000-00-00',NULL,'2006-04-12',NULL,'2006-04-14 11:32:05','en'),
(100023,'frisbee32',NULL,'frisbee32@yahoo.com','55b5a0f748d3a82dce10b205ecb0a0d8916c66a1','Naomi','Herskovic',NULL,0,NULL,'0000-00-00',NULL,'2006-06-15',NULL,'2006-06-15 18:22:30','en'),
(100024,'username',NULL,'ade@twbta.com','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','James','Bond',NULL,1,NULL,'0000-00-00',NULL,'2006-06-19',NULL,'2006-06-20 03:58:16','en');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'archx_01'
--

--
-- Dumping routines for database 'archx_01'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-18  2:41:07
