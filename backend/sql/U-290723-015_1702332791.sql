-- MySQL dump 10.13  Distrib 8.0.22, for Linux (aarch64)
--
-- Host: localhost    Database: aero
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

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
-- Table structure for table `wp_s3cu_form_on_landing`
--

DROP TABLE IF EXISTS `wp_s3cu_form_on_landing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_s3cu_form_on_landing`
(
    `id`                        int NOT NULL AUTO_INCREMENT,
    `main_point`                int                                                           DEFAULT NULL,
    `sex`                       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `age`                       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `params`                    text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `created_at`                timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`                timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_s3cu_form_on_landing`
--

LOCK
TABLES `wp_s3cu_form_on_landing` WRITE;
/*!40000 ALTER TABLE `wp_s3cu_form_on_landing` DISABLE KEYS */;
INSERT INTO `wp_s3cu_form_on_landing`
VALUES (1, 6, 'male', '36-50',
        NULL, '2023-11-29 22:06:47', '2023-11-29 22:06:47'),
       (2, 10, 'male', '36-50', NULL, '2023-11-29 22:10:07', '2023-11-29 22:10:07'),
       (3, 2, 'male', '14-22', NULL, '2023-11-29 22:13:59', '2023-11-29 22:13:59'),
       (4, 9, 'male', '36-50', NULL, '2023-11-30 08:10:53', '2023-11-30 08:10:53'),
       (5, 4, 'male', '36-50', NULL,
        '2023-12-04 18:49:03', '2023-12-04 18:49:03'),
       (6, 4, 'male', '36-50', NULL,
        '2023-12-04 18:49:06', '2023-12-04 18:49:06'),
       (7, 4, 'female', '50+',
        NULL, '2023-12-04 18:55:20', '2023-12-04 18:55:20'),
       (8, 4, 'male', '50+', NULL,
        '2023-12-05 08:44:51', '2023-12-05 08:44:51');
/*!40000 ALTER TABLE `wp_s3cu_form_on_landing` ENABLE KEYS */;
UNLOCK
TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-12  1:13:12
