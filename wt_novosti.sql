-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: wt
-- ------------------------------------------------------
-- Server version	5.7.12-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `novosti`
--

DROP TABLE IF EXISTS `novosti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `novosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tekst` varchar(250) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `komentari` tinyint(4) DEFAULT NULL,
  `linkSlike` varchar(150) DEFAULT NULL,
  `naslov` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `autori_idx` (`idAutor`),
  CONSTRAINT `autori` FOREIGN KEY (`idAutor`) REFERENCES `autori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novosti`
--

LOCK TABLES `novosti` WRITE;
/*!40000 ALTER TABLE `novosti` DISABLE KEYS */;
INSERT INTO `novosti` VALUES (1,'test','2012-01-16 12:32:00',1,0,'http://www.startutorial.com/img/logo.png','naslov1'),(3,'neki tekst nesto','2016-05-31 12:50:20',1,0,'http://www.etf.unsa.ba/etf/css/images/univerzitet.gif','Naslov3'),(4,'dakle sad treba da rade komentari','2016-05-31 15:38:18',1,0,'eeeee','Naslov za 4'),(5,'tekst o necemu i moguce ostaviti komentare','2016-05-31 17:38:30',1,0,'linkSlike','5. Naslov'),(6,'tekst sa mogucnosti komentarisanja','2016-05-31 17:40:19',1,1,'linkslibe','naslov'),(7,'drugi autor','2016-05-31 17:45:19',NULL,NULL,'linkSLike','Drugi autor'),(8,'neki tekst','2016-05-31 18:19:09',1,0,'linnkslikeeee','naslov8'),(9,'zrzrzrr','2016-05-31 23:05:58',1,0,'zrzrzr','zrzrzr'),(10,'fasfasfas','2016-05-31 23:07:00',1,0,'fsafasfas','fsafasf'),(11,'teteete','2016-05-31 23:11:21',1,1,'tetete','tetet'),(12,'zrzrzr','2016-05-31 23:49:27',1,1,'zrzrzr','trrzrzr');
/*!40000 ALTER TABLE `novosti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-05 22:40:40
