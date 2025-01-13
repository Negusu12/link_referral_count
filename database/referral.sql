-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: referral
-- ------------------------------------------------------
-- Server version	8.0.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `promoter`
--

DROP TABLE IF EXISTS `promoter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promoter` (
  `promoter_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`promoter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promoter`
--

LOCK TABLES `promoter` WRITE;
/*!40000 ALTER TABLE `promoter` DISABLE KEYS */;
INSERT INTO `promoter` VALUES (24,'Negusu','Solomon','Wondimu','0912608380','negusu01@gmail.com');
/*!40000 ALTER TABLE `promoter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `promoter_count`
--

DROP TABLE IF EXISTS `promoter_count`;
/*!50001 DROP VIEW IF EXISTS `promoter_count`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `promoter_count` AS SELECT 
 1 AS `promoter_id`,
 1 AS `first_name`,
 1 AS `middle_name`,
 1 AS `last_name`,
 1 AS `email`,
 1 AS `phone`,
 1 AS `total_visit_count`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `referral_count`
--

DROP TABLE IF EXISTS `referral_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referral_count` (
  `id` int NOT NULL AUTO_INCREMENT,
  `promoter_id` int DEFAULT NULL,
  `visit_count` int DEFAULT '0',
  `ip_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promoter_id` (`promoter_id`),
  CONSTRAINT `referral_count_ibfk_1` FOREIGN KEY (`promoter_id`) REFERENCES `promoter` (`promoter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referral_count`
--

LOCK TABLES `referral_count` WRITE;
/*!40000 ALTER TABLE `referral_count` DISABLE KEYS */;
/*!40000 ALTER TABLE `referral_count` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,77197383,'Negusu','$2y$10$MhFPYM9dPqtnEZS.6cijOebDxj48kstWXGGj2OlE2MJM6UCnyijl6',NULL,'1'),(2,5795850732425733,'jo','$2y$10$C7o8aY4GtJhN0qzBNO4ujulkKF8SLxLdkCo4k34lqOrqSkApYF6H2',NULL,'1'),(3,98739,'zerihun','$2y$10$aoSvMIkbHZe3Zsg5I5v.RuHds/x4EYZgEpK15aG9V5yUrmPgNSCaO',NULL,'1'),(4,179214487388922,'zerihun','$2y$10$fG7g2Ldt1mGoJqDMhDYSHuq7LH4.x8SzEPY.bfzgR9TNs1qqHWt9O',NULL,'1'),(5,7665617518925476,'zerihun','$2y$10$S3neXDGfKEK.akkmPILOOe9aUWc6km6ZhFZl.XDR7Ec8IIjktLBuu',NULL,'1'),(6,3840,'zerihun','$2y$10$RizPEgyCm8xAqllmbTI.hu3o07quaSvktea37xw1p6xFH37TWeF6i',NULL,'1'),(7,5407172076387660624,'zerihun','$2y$10$o5iGtM89elLt6p52n5DruO2Y.Uc.18fonvLx7J68regx0AYrkjp5W',NULL,'1'),(8,676705729276522913,'tsi','$2y$10$qMWBpB9EnC3z.7ksITDjReHMXawpZCgPiUNDcpiSpyUfuhfZZ7fx6',NULL,'1'),(9,6730114,'kal','$2y$10$F4NL4GRW7YsozKaB1zUPd.uhlZ7bKYdBF6Al6k1yHxe6.K/EhRB6i',NULL,'1'),(10,162606599,'bruk','$2y$10$/T0N0PSZTqXm/l0BU9bZxueXcNrxFFM2YkzGq1wvkHPhdBDRC0bmi',NULL,'1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `promoter_count`
--

/*!50001 DROP VIEW IF EXISTS `promoter_count`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `promoter_count` AS select `p`.`promoter_id` AS `promoter_id`,`p`.`first_name` AS `first_name`,`p`.`middle_name` AS `middle_name`,`p`.`last_name` AS `last_name`,`p`.`email` AS `email`,`p`.`phone` AS `phone`,sum(`r`.`visit_count`) AS `total_visit_count` from (`referral_count` `r` left join `promoter` `p` on((`r`.`promoter_id` = `p`.`promoter_id`))) group by `p`.`promoter_id`,`p`.`first_name` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-13  8:59:01
