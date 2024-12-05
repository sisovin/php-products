-- MySQL dump 10.13  Distrib 9.0.1, for Win64 (x86_64)
--
-- Host: localhost    Database: phpproducts
-- ------------------------------------------------------
-- Server version	9.0.1

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Books'),(2,'Fashion & Beauty'),(3,'Kids & Babies Clothes'),(4,'Men & Women Clothes'),(5,'Gadgets & Accessories'),(6,'Electronics & Accessories'),(7,'Mobile Phones'),(8,'Computers'),(9,'Games'),(10,'Tablets');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `cat_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category` (`cat_id`),
  CONSTRAINT `fk_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'img/javascript-02.jpg','Learn JavaScript Quickly: A Complete Beginner’s Guide to Learning JavaScript',15.99,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',1),(2,'img/node.jpg','Node.js: Novice to Ninja 1st Edition',39.95,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',1),(3,'img/machine-learning.jpg','JavaScript from Beginner to Professional: Learn JavaScript quickly',34.95,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',1),(4,'img/coding.jpg','Coding All-in-One For Dummies',19.99,'orem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',1),(5,'img/star-wars.jpg','Star Wars Squadrons',39.99,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',9),(6,'img/tank.jpg','M4 Tank Brigade',14.95,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',9),(7,'img/farcry.jpg','Far Cry Primal - PC Standard Edition',34.95,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',9),(8,'img/batlefield.jpg','Battlefield 3 [Download]',49.99,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',9),(9,'img/phone-1.jpg','AMSUNG Galaxy S22 Ultra Cell Phone',1136,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',7),(10,'img/phone-2.jpg','Apple iPhone 12 Pro, 512GB',919.99,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',7),(11,'img/phone-3.jpg','Moto G Power | 2021 | 3-Day battery',160.95,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',7),(12,'img/phone-4.jpg','Moto G7 Plus | Unlocked | Made for US by Motorola',201,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',7),(13,'img/mic-1.jpg','Rode PodMic Cardioid Dynamic Broadcast Microphone',99,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',6),(14,'img/mic-2.jpg','Audio-Technica AT2020 Cardioid',99,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',6),(15,'img/mic-3.jpg','Elgato Wave:3 - Premium Studio Quality USB',149.95,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',6),(16,'img/mic-4.jpg','Razer Seiren X USB Streaming Microphone: Professional Grade',59,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',6),(17,'img/tablet-1.jpg','SAMSUNG SM-T290NZKAXAR, Galaxy Tab A 8.0 32 GB',99,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',10),(18,'img/tablet-2.jpg','Lectrus Tablet Customized Cover, Android 9.0',119,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',10),(19,'img/tablet-3.jpg','10 Inch Tablet and Tablet Case Bundle, Android 9.0 Tablet 2GB RAM',149.95,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',10),(20,'img/tablet-4.jpg','Lenovo IdeaTab A2109 9-Inch 16 GB Tablet',199,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione eligendi quas eius quod.','product description','product keywords',10);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-31 14:58:11
