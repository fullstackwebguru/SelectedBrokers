/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.53-0ubuntu0.14.04.1 : Database - brokers
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`brokers` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `brokers`;

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('admin','1',1478614467),('admin','2',1478614588),('catalogManager','2',1478614467),('catalogManager','3',1478614589);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('admin',1,NULL,NULL,NULL,1478614467,1478614467),('catalogManager',1,NULL,NULL,NULL,1478614467,1478614467),('createCatalog',2,'Create a catalog',NULL,NULL,1478614467,1478614467),('updateCatalog',2,'Update catalog',NULL,NULL,1478614467,1478614467),('updateUser',2,'Update user',NULL,NULL,1478614467,1478614467);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values ('admin','catalogManager'),('catalogManager','createCatalog'),('catalogManager','updateCatalog'),('admin','updateUser');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `cate_comp` */

DROP TABLE IF EXISTS `cate_comp`;

CREATE TABLE `cate_comp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-catecomp-category_id-category-id` (`category_id`),
  KEY `fk-catecomp-company_id-company-id` (`company_id`),
  CONSTRAINT `fk-catecomp-company_id-company-id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-catecomp-category_id-category-id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cate_comp` */

insert  into `cate_comp`(`id`,`category_id`,`rank`,`company_id`,`created_at`,`updated_at`) values (1,1,1,1,1485713469,1485716116),(2,1,0,2,1485716113,1485716116);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `self_rank` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  `slider_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Top 10 Brokers for #name#',
  `slider_description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_title` varchar(300) COLLATE utf8_unicode_ci DEFAULT 'Top 10 Brokers for #name#',
  `table_risk` text COLLATE utf8_unicode_ci,
  `table_risk_short` varchar(800) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_advisor_disclosure` varchar(800) COLLATE utf8_unicode_ci DEFAULT NULL,
  `how_to_choose_title` varchar(300) COLLATE utf8_unicode_ci DEFAULT 'How to Choose the Best Online Broker for #name#',
  `how_to_choose` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`id`,`title`,`short_title`,`short_description`,`description`,`image_url`,`self_rank`,`status`,`slider_title`,`slider_description`,`table_title`,`table_risk`,`table_risk_short`,`table_advisor_disclosure`,`how_to_choose_title`,`how_to_choose`,`slug`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`) values (1,'Forex  Trading','Forex','wefwewefewf',NULL,'k6ero4ico61amnwfmgoh',1,1,'Forex Trading #name#','Default trader','Forex Trading #name#','* Individual Brokers T&Cs Apply Risk Warning: Trading Forex (FX), Commodities, Options, and CFDs are a high-risk activity and you may lose more than your initial deposit. Please be sure you thoroughly understand the risks involved and do not invest money you cannot afford to lose. Your capital is at risk. Advertiser Disclosure: TopBrokers.Trade is an independent specialized comparison site funded from the referral fees from the sites that it promotes. TopBrokers.Trade receives compensation from the brokers sites and advertisements it features. Thanks to this compensation, we can provide you a free comparison tool. TopBrokers.Trade is not able to display and feature information about all the available broker sites or broker site offers.','Trading Forex, Commodities, Options, and CFDs are a high-risk activity and you may lose more than your initial deposit.\r\nPlease be sure you thoroughly understand the risks involved and do not invest money you cannot afford to lose. Your capital is at risk.','TopBrokers.Trade is an independent specialized comparison site funded from the referral fees from the sites that it promotes. TopBrokers.Trade receives compensation from the brokers sites and advertisements it features. Thanks to this compensation, we can provide you a free comparison tool. TopBrokers.Trade is not able to display and feature information about all the available broker sites or broker site offers.','fwefwef #name#','Because there’s so much competition in the Forex (FX) market as well as having countless brokers to choose from, it can be difficult to know which online FX Broker will be best for you. Beginners have different needs than more advanced traders, so these are a few key points we suggest keeping in mind when making your decision:\r\n\r\n**Regulation:**  \r\nEach country has its own regulatory body such as the Financial Conduct Authority (FCA), here in the UK. The regulatory body develops rules, services and programs to protect the integrity of the market, traders, and investors as well as the brokers themselves, and to help members meet regulatory responsibilities. Due to potential safety concerns regarding deposit, accounts should exclusively be opened with firms that are regulated.\r\n\r\n**Customer Service:**  \r\nOnline FX Trading takes place 24 hrs a day, so customer support should be available at all times. Ideally, you will want to speak with a live support person rather than a time-consuming auto-attendant. Perhaps give a quick call to the customer service center so you can get an idea of the type of customer service provided. Check on wait times and find out the representative’s ability to answer questions regarding spreads and leverage, their trade volume, as well as company details.\r\n\r\nAccount Types:\r\n\r\nYour ideal FX broker should be able to offer either multiple account options or an element of customizability. Look for an online Forex Broker that offers competitive spreads and easy deposits/withdrawals. Find out if there are account options specifically for beginners and if so what that account offers to benefit new traders.\r\n\r\n**Currency Pairs:**  \r\nAn online Forex Broker can provide a huge selection of forex pairs. However, it is most important is that they provide the variety of pairs that interest you. While there are many currencies available for trading, there are only a few get the majority of the attention, and as the result, trade with the highest liquidity.\r\n\r\n**Tradeable Assets:**  \r\nWhile selecting the best FX Trading Broker for you, it’s possible just to concentrate on Forex trading. However, you should keep in mind there are many types of investment alternatives offered as well, such as Bitcoin, Stocks, CFDs, ETFs, or trading in options or futures.\r\n\r\n','forex-trading','afeafaef','aefaefaefaf',1485712185,1485713965);

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `logo_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `review` text COLLATE utf8_unicode_ci,
  `bonus_as_value` int(255) NOT NULL DEFAULT '0',
  `bonus_offer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `established` int(11) DEFAULT NULL,
  `regulation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_deposit` int(255) DEFAULT NULL,
  `max_leverage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spreads_from` double NOT NULL,
  `pairs_offered` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `us_allowed` int(2) DEFAULT NULL,
  `self_rank` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `button_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Visit Site',
  `link_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Get Bonus',
  `promotion_link_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Get Deal',
  `bonus_link_heading` varchar(255) COLLATE utf8_unicode_ci DEFAULT '#bonus# Welcome Bonus',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `company` */

insert  into `company`(`id`,`category_id`,`title`,`short_description`,`description`,`logo_url`,`image_url`,`website_url`,`rating`,`review`,`bonus_as_value`,`bonus_offer`,`telephone`,`established`,`regulation`,`min_deposit`,`max_leverage`,`spreads_from`,`pairs_offered`,`us_allowed`,`self_rank`,`slug`,`status`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`,`button_text`,`link_text`,`promotion_link_text`,`bonus_link_heading`) values (1,0,'Company','afeaf','weffafeawfawfe','fnomzyk2gz3ufeqpnypp','ybzaikr8rofdnvt6j3es','https://google.com',5,'wefwefwefwef',14,'afeafaewf','1234234',220,'wefewf',3,'1:220',134,'324324 ave',1,1,'company',1,'fwef','wefwefewf',1485713446,1485719332,'Visit Site','Get Bonus','Get Deal','#bonus# Welcome Bonus'),(2,0,'Company2','afaewfawef','awfeaewfawef','ozmvne938x0ntquw9vy2','d0ihsshoxrglc0fhiiyp','https://google.com',8,'afeaefawfaewf',14,'afeawef','234324',NULL,'234234324',3,NULL,12343,'1423',1,2,'company2',1,'afeaefa','afeafaewf',1485716091,1485716091,'Visit Site','Get Bonus','Get Deal','#bonus# Welcome Bonus');

/*Table structure for table `feature_company` */

DROP TABLE IF EXISTS `feature_company`;

CREATE TABLE `feature_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-featurecomp-company_id-company-id` (`company_id`),
  CONSTRAINT `fk-featurecomp-company_id-company-id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `feature_company` */

insert  into `feature_company`(`id`,`company_id`,`value`,`created_at`,`updated_at`) values (1,1,'wefwefwf',1485713458,1485713458);

/*Table structure for table `guide` */

DROP TABLE IF EXISTS `guide`;

CREATE TABLE `guide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'jone_doe',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `self_rank` int(11) DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `guide` */

insert  into `guide`(`id`,`title`,`author`,`slug`,`description`,`image_url`,`self_rank`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`) values (1,'awefawef','jone_doe','awefawef','Mark Carney, the Governor of the Bank of England, will probably not take up the three-year extension option for his term at the central bank. According to the reports by the British newspapers this weekend, there is the chance that he make the announcement about his decision as early as Thursday.\r\n\r\nCarney had noted in public that he will reach a decision by the end of the year as to if he will stay past his five-year term as originally committed to in July 2013 when he joined the Bank of England (BoE). On Thursday, he is set to hold a quarterly news conference.\r\n\r\nAs reported by The Sunday Times, Carney has been unhappy with the office of Prime Minister Theresa May. Carney recruited by and had a closer relationship with George Osborne, the predecessor of finance minister Philip Hammond.\r\n\r\nAs published in the Time’s Saturday edition, that there was a personal reason for Carney’s motivation to leave in 2018.\r\nThe Times said: “The Senior City figures believe, because they know Carney, that he is more likely to choose to head back to Canada in 2018. They added that the feelings of his family were a concern.” Also, the Times stated: “The suggestions of his leaving before 2018 were firmly rejected.” This announcement will come at the news conference on Thursday or at a future appearance in front of the committee of lawmakers which oversees the central bank.\r\n\r\nThe Bank of England declined to make a comment on the article in the Times. Instead, the BoE gave reference to the previous public statements of Carney on the topic. Carney said, last week, which his decision is a personal one as to whether he would stay, rather than considerations that are political. He stated that he needs to have some time to reach a decision.\r\n\r\nThe Sunday Times reported that the statement of Carney’s displeasure in the office of May came from the information of two senior figures. These two top figures had known Carney since 2013 when he moved to Britain. Someone, described as being a friend of Carney, was quoted by the Sunday Times saying about the Office of the Prime Minister, “I am not convinced that he has been very impressed by the professionalism of the office of the Prime Minister.” The government officials did not anticipate an announcement by Carnet with regards to his departures as early as Thursday, said the Sunday Times. Friends of Carney believe that he will stay in his position until 2018.\r\n\r\n','wgvh9apdewtroojpz4ik',1,'afeafaw','awefaewf',1485536788,1485723022),(2,'wefwefwe','jone_doe','wefwefwe','Mark Carney, the Governor of the Bank of England, will probably not take up the three-year extension option for his term at the central bank. According to the reports by the British newspapers this weekend, there is the chance that he make the announcement about his decision as early as Thursday.\r\n\r\nCarney had noted in public that he will reach a decision by the end of the year as to if he will stay past his five-year term as originally committed to in July 2013 when he joined the Bank of England (BoE). On Thursday, he is set to hold a quarterly news conference.\r\n\r\nAs reported by The Sunday Times, Carney has been unhappy with the office of Prime Minister Theresa May. Carney recruited by and had a closer relationship with George Osborne, the predecessor of finance minister Philip Hammond.\r\n\r\nAs published in the Time’s Saturday edition, that there was a personal reason for Carney’s motivation to leave in 2018.\r\nThe Times said: “The Senior City figures believe, because they know Carney, that he is more likely to choose to head back to Canada in 2018. They added that the feelings of his family were a concern.” Also, the Times stated: “The suggestions of his leaving before 2018 were firmly rejected.” This announcement will come at the news conference on Thursday or at a future appearance in front of the committee of lawmakers which oversees the central bank.\r\n\r\nThe Bank of England declined to make a comment on the article in the Times. Instead, the BoE gave reference to the previous public statements of Carney on the topic. Carney said, last week, which his decision is a personal one as to whether he would stay, rather than considerations that are political. He stated that he needs to have some time to reach a decision.\r\n\r\nThe Sunday Times reported that the statement of Carney’s displeasure in the office of May came from the information of two senior figures. These two top figures had known Carney since 2013 when he moved to Britain. Someone, described as being a friend of Carney, was quoted by the Sunday Times saying about the Office of the Prime Minister, “I am not convinced that he has been very impressed by the professionalism of the office of the Prime Minister.” The government officials did not anticipate an announcement by Carnet with regards to his departures as early as Thursday, said the Sunday Times. Friends of Carney believe that he will stay in his position until 2018.\r\n\r\n','ufne4ley5bbkhcgnbik3',3,'qwfwe','fqwefqwefweqf',1485719995,1485723037),(3,'qwefwefewf','jone_doe','qwefwefewf','Mark Carney, the Governor of the Bank of England, will probably not take up the three-year extension option for his term at the central bank. According to the reports by the British newspapers this weekend, there is the chance that he make the announcement about his decision as early as Thursday.\r\n\r\nCarney had noted in public that he will reach a decision by the end of the year as to if he will stay past his five-year term as originally committed to in July 2013 when he joined the Bank of England (BoE). On Thursday, he is set to hold a quarterly news conference.\r\n\r\nAs reported by The Sunday Times, Carney has been unhappy with the office of Prime Minister Theresa May. Carney recruited by and had a closer relationship with George Osborne, the predecessor of finance minister Philip Hammond.\r\n\r\nAs published in the Time’s Saturday edition, that there was a personal reason for Carney’s motivation to leave in 2018.\r\nThe Times said: “The Senior City figures believe, because they know Carney, that he is more likely to choose to head back to Canada in 2018. They added that the feelings of his family were a concern.” Also, the Times stated: “The suggestions of his leaving before 2018 were firmly rejected.” This announcement will come at the news conference on Thursday or at a future appearance in front of the committee of lawmakers which oversees the central bank.\r\n\r\nThe Bank of England declined to make a comment on the article in the Times. Instead, the BoE gave reference to the previous public statements of Carney on the topic. Carney said, last week, which his decision is a personal one as to whether he would stay, rather than considerations that are political. He stated that he needs to have some time to reach a decision.\r\n\r\nThe Sunday Times reported that the statement of Carney’s displeasure in the office of May came from the information of two senior figures. These two top figures had known Carney since 2013 when he moved to Britain. Someone, described as being a friend of Carney, was quoted by the Sunday Times saying about the Office of the Prime Minister, “I am not convinced that he has been very impressed by the professionalism of the office of the Prime Minister.” The government officials did not anticipate an announcement by Carnet with regards to his departures as early as Thursday, said the Sunday Times. Friends of Carney believe that he will stay in his position until 2018.\r\n\r\n','ghehyuoeu4xmfd3z6jfg',2,'wfwefw','wefwefewf',1485720009,1485723030),(4,'qwfwef','jone_doe','qwfwef','qefqwefewf','sjnfjvgnbgboe6cvnlg9',4,'qfeqef','qfewefwef',1485720030,1485720030),(5,'1535325','jone_doe','1535325','wfwefwf','cq64w3dbgilqafmokwfs',5,'qfwef','wfwefewf',1485720055,1485720055);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1478614396),('m130524_201442_init',1478614399),('m140506_102106_rbac_init',1478614435),('m161108_142834_create_company_table',1485712138),('m161109_180719_create_category_table',1485712138),('m161109_190347_create_cate_comp_table',1485712138),('m161110_170051_create_guide_table',1485531271),('m161110_172805_create_page_table',1485531051),('m161120_210544_create_feature_company_table',1485712138);

/*Table structure for table `page` */

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `page` */

insert  into `page`(`id`,`page_id`,`title`,`slug`,`description`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`) values (1,'home','home','home','home','home','home',1234234324,1234234324),(2,'categories','categories','categories','categories','categories','categories',134234324,1423423432),(3,'reviews','reviews','reviews','afeafe','reviews','reviews',2147483647,2147483647),(4,'news','news','news','3f2f2f3f','news','news',23432432,2147483647),(5,'about','about','about','about','about','about',324324324,2147483647),(6,'privacy','privacy','privacy','privacy','privacy','privacy',2147483647,2147483647),(7,'tos','Tos','Tos','Tos','Tos','Tos',324234234,234324234),(8,'disclaimer','disclaimer','disclaimer','disclaimer','disclaimer','disclaimer',324324234,234324234),(9,'contact','contact','contact','contact','contact','contact',234234324,2147483647);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values (2,'admin','Yf-o2mMa1kvDaH12Gv9ZzCrRzQM2IlOf','$2y$13$de.zBrS.yG7rYUA1Q5Qp0.e1rE5.DbpgDSOmFfZ6HGZIIKFiHhXA6',NULL,'admin@top5bestcasinos.today	',10,1478614588,1478614588),(3,'support','087HOunXey9yXcHWt8UkvhUO_s7lm5_6','$2y$13$fqRPYM7KRInlWqGgv//LneQEn4F202FlBaf9v7JK1y/rm9QuVhfOS',NULL,'support@top5bestcasinos.today	',10,1478614589,1478614589);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
