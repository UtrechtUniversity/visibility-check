-- MySQL dump 10.13  Distrib 9.5.0, for macos26.0 (arm64)
--
-- Host: 127.0.0.1    Database: visibilitycheck
-- ------------------------------------------------------
-- Server version	12.0.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,11,1,'yes'),(2,1,1,'no'),(3,2,1,'yesandaddedsomelinks'),(4,3,1,'scopusid'),(5,7,1,'no'),(6,8,1,'some'),(7,4,1,'academia'),(8,4,1,'researchgate'),(9,5,1,'twitter'),(10,5,1,'website'),(11,9,1,'no'),(12,12,1,'no'),(13,12,1,'sometimes'),(14,6,1,'research-data'),(15,6,1,'research-code'),(16,10,1,'no'),(17,10,1,'dontknow'),(18,13,1,'downloadsorreaders'),(19,13,1,'mentionsinmediaaltmetrics');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_01_27_130410_create_questions_table',1),(6,'2022_01_27_130525_create_respondents_table',1),(7,'2022_01_27_130559_create_answers_table',1),(8,'2022_01_28_090234_create_question_values_table',1),(9,'2022_01_28_090510_create_topics_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `question_values`
--

LOCK TABLES `question_values` WRITE;
/*!40000 ALTER TABLE `question_values` DISABLE KEYS */;
INSERT INTO `question_values` VALUES (1,1,2,'yes','Yes',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(2,1,1,'no','No',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(3,2,1,'yes','Yes',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(4,2,2,'no','No',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(5,3,1,'googlescholarid ','Google Scholar ID ',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(6,3,2,'researcherid','ResearcherID',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(7,3,3,'scopusid','Scopus Author ID',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(8,3,5,'other','Other',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(9,4,1,'academia','Academia.edu',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(10,4,2,'researchgate','Researchgate',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(11,4,3,'mendeley','Mendeley',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09','2022-07-27 12:01:08'),(12,4,5,'other','Other',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(13,5,1,'linkedin','LinkedIn',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(14,5,2,'twitter','Twitter and or Mastodon',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(15,5,3,'website','Personal website or Blog',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(16,5,4,'blog','Blog',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09','2022-07-27 12:06:28'),(17,5,5,'youtube','Youtube Channel',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(18,6,1,'articles','Articles or books',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(19,6,2,'books','Data Code and Software',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(20,6,3,'research-data','Posters Presentations or Conf Abstracts',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(21,6,4,'research-code','Preprints',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(22,7,1,'yes','Yes',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(23,7,2,'no','No',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(24,7,3,'some','Some',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09','2023-04-26 08:47:51'),(25,8,1,'yes','Yes',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(26,8,2,'no','No',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(27,8,3,'some','Some',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(28,9,1,'yes','Yes',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(29,9,2,'no','No',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(30,10,1,'yes','A persistent identifier',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(31,10,2,'no','An open reuse license',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(32,3,4,'publons','Publons',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(33,6,7,'dontpublish','I don\'t publish open access',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09','2023-04-26 08:57:12'),(34,10,3,'dontknow','A plain language summary',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(35,11,2,'yes','Yes',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09','2023-04-26 07:32:50'),(36,11,1,'no','No',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09','2023-04-26 07:32:53'),(37,11,3,'afterpublishing','Only after publishing',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09','2023-04-26 07:32:57'),(38,12,1,'yes','posting on non academic venues blogs ets',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(39,12,2,'no','appearing in media like tv or radio',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(40,12,3,'sometimes','creating video',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(41,5,6,'other','TikTok Insta or similar',NULL,NULL,'2022-03-31 08:22:09','2022-03-31 08:22:09',NULL),(42,6,5,'posters','Posters',NULL,NULL,NULL,NULL,'2023-04-26 08:57:35'),(43,6,6,'presentations','Presentations',NULL,NULL,NULL,NULL,'2023-04-26 08:57:16'),(44,11,1,'yes','I need one and want it to be complete',NULL,NULL,NULL,NULL,NULL),(45,11,2,'no','I believe I dont need one',NULL,NULL,NULL,NULL,NULL),(46,11,3,'why','I need one but dont want to spend time on it',NULL,NULL,NULL,NULL,NULL),(47,8,4,'none','None',NULL,NULL,NULL,NULL,NULL),(48,1,3,'alongtimeago','A long time ago',NULL,NULL,NULL,NULL,NULL),(49,1,4,'nonotyet','Not sure if I have',NULL,NULL,NULL,NULL,NULL),(50,1,5,'yesididindeed','Yes I did indeed',NULL,NULL,NULL,NULL,'2023-04-26 08:44:49'),(51,1,6,'magjenuwelallesinvullen','mag je nu wel alles invullen',NULL,NULL,NULL,NULL,'2023-04-26 08:44:53'),(52,2,3,'yesandaddedsomelinks','Yes and added some links',NULL,NULL,NULL,NULL,NULL),(53,2,4,'yesandsetupalllinksandaddedabio','Yes and set up all links and added a bio',NULL,NULL,NULL,NULL,NULL),(54,4,4,'humanitiescommons','HumanitiesCommons',NULL,NULL,NULL,NULL,NULL),(55,5,7,'other','Other',NULL,NULL,NULL,NULL,NULL),(56,12,4,'creatingpodcasts','creating podcasts',NULL,NULL,NULL,NULL,NULL),(57,12,5,'providingplainlanguageaccountsofmyresearch','providing plain language accounts of my research',NULL,NULL,NULL,NULL,NULL),(58,13,1,'citationdata','Citation data',NULL,NULL,NULL,NULL,NULL),(59,13,2,'downloadsorreaders','Downloads or Readers',NULL,NULL,NULL,NULL,NULL),(60,13,3,'mentionsinmediaaltmetrics','Mentions in media Altmetrics',NULL,NULL,NULL,NULL,NULL),(61,13,4,'qualitativefeedbackviadirectrepliesandcommentsonandoffline','Qualitative feedback via direct replies and comments on and offline',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `question_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,2,'institutional-profile','radio',1,'I have set up and customised my institutional profile page for example at UU or UMCU.','institutional profile','','2022-03-31 08:18:10','2023-04-26 08:46:36',NULL),(2,3,'orcid','radio',1,'I have an ORCID ID','ORCID ID','','2022-03-31 08:18:10','2023-04-26 08:46:30',NULL),(3,4,'research-profiles','checkbox',1,'I have these research profiles','research profiles','','2022-03-31 08:18:10','2023-04-26 08:46:54',NULL),(4,7,'academic-social-networks','checkbox',2,'I have an account on these academic social networks','','','2022-03-31 08:18:10','2023-04-26 07:59:51',NULL),(5,8,'social-media','checkbox',3,'I have these social media accounts and/or channels','','','2022-03-31 08:18:10','2023-04-26 08:49:19',NULL),(6,11,'open-access','checkbox',4,'I share the following output from my research:','','','2022-03-31 08:18:10','2023-04-26 08:57:58',NULL),(7,5,'up-to-date-profiles','radio',1,'I make sure my profiles are up to date.','','','2022-03-31 08:18:10','2023-04-26 08:48:11',NULL),(8,6,'profiles-reference','radio',1,'All my profiles refer to each other','','','2022-03-31 08:18:10','2023-04-26 07:41:41',NULL),(9,9,'post-messages','radio',3,'I post new messages about my research at least three times per year in my social media accounts','','','2022-03-31 08:18:10','2023-04-26 08:51:42',NULL),(10,12,'doi','checkbox',4,'I try to ensure my (research) ouput has:','','','2022-03-31 08:18:10','2023-04-26 08:58:26',NULL),(11,1,'planning','radio',5,'What is your view, as a researcher, on the need for an online presence?','','','2022-03-31 08:18:10','2023-04-26 08:21:31',NULL),(12,10,'valorization','checkbox',3,'I try to foster societal engagement with my research by …','','','2022-03-31 08:18:10','2023-04-26 08:52:46',NULL),(13,13,'interactions','checkbox',5,'I actively keep track of interactions with my output by looking at:','','','2023-04-26 08:59:52','2023-04-26 08:59:52',NULL);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `respondents`
--

LOCK TABLES `respondents` WRITE;
/*!40000 ALTER TABLE `respondents` DISABLE KEYS */;
INSERT INTO `respondents` VALUES (1,'S7rSrJGcnfICAIy7pZKgP4XWNmfKq3eJEvKTwfftWZQatEMSAS','2025-11-03 10:34:09','2025-11-03 10:34:09');
/*!40000 ALTER TABLE `respondents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (1,2,'identity','Research profiles','2022-03-31 08:23:53','2022-03-31 08:23:53'),(2,3,'communities','Academic social networks','2022-03-31 08:23:53','2022-03-31 08:23:53'),(3,4,'personal','Personal Channels','2022-03-31 08:23:53','2022-03-31 08:23:53'),(4,5,'openaccess','Open Access','2022-03-31 08:23:53','2022-03-31 08:23:53'),(5,1,'planning','Planning','2022-03-31 08:23:53','2022-03-31 08:23:53');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2025-11-03 09:32:10','$2y$10$dLiBc.WZtw4wxssfToUYSuIdrMymhpsbupfVQZ0MWuQA.yCiV2kKa','kvCq0zhtvO','2025-11-03 09:32:10','2025-11-03 09:32:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-03 11:40:36
