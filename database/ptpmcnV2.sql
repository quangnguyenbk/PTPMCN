CREATE DATABASE  IF NOT EXISTS `ptpmcn` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ptpmcn`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ptpmcn
-- ------------------------------------------------------
-- Server version	5.7.19-log

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
-- Table structure for table `contact_mechanism`
--

DROP TABLE IF EXISTS `contact_mechanism`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_mechanism` (
  `contact_id` int(11) NOT NULL,
  `contact_type` varchar(45) NOT NULL,
  `contact_value` varchar(45) NOT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `fk_contact_type_idx` (`contact_type`),
  CONSTRAINT `fk_contact_type` FOREIGN KEY (`contact_type`) REFERENCES `contact_mechanism_type` (`contact_mechanism_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_mechanism`
--

LOCK TABLES `contact_mechanism` WRITE;
/*!40000 ALTER TABLE `contact_mechanism` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_mechanism` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_mechanism_type`
--

DROP TABLE IF EXISTS `contact_mechanism_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_mechanism_type` (
  `contact_mechanism_type_id` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`contact_mechanism_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_mechanism_type`
--

LOCK TABLES `contact_mechanism_type` WRITE;
/*!40000 ALTER TABLE `contact_mechanism_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_mechanism_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature_type`
--

DROP TABLE IF EXISTS `feature_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feature_type` (
  `feature_type_id` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`feature_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature_type`
--

LOCK TABLES `feature_type` WRITE;
/*!40000 ALTER TABLE `feature_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `feature_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laptop`
--

DROP TABLE IF EXISTS `laptop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laptop` (
  `laptop_id` varchar(45) NOT NULL,
  `laptop_name` varchar(45) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`laptop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laptop`
--

LOCK TABLES `laptop` WRITE;
/*!40000 ALTER TABLE `laptop` DISABLE KEYS */;
/*!40000 ALTER TABLE `laptop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laptop_feature`
--

DROP TABLE IF EXISTS `laptop_feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laptop_feature` (
  `product_feature_id` varchar(45) NOT NULL,
  `feature_type` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`product_feature_id`),
  KEY `fk_feature_idx` (`feature_type`),
  CONSTRAINT `fk_feature` FOREIGN KEY (`feature_type`) REFERENCES `feature_type` (`feature_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laptop_feature`
--

LOCK TABLES `laptop_feature` WRITE;
/*!40000 ALTER TABLE `laptop_feature` DISABLE KEYS */;
/*!40000 ALTER TABLE `laptop_feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laptop_feature_applicability`
--

DROP TABLE IF EXISTS `laptop_feature_applicability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laptop_feature_applicability` (
  `apply_id` varchar(45) NOT NULL,
  `laptop_id` varchar(45) NOT NULL,
  `feature_id` varchar(45) DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `thru_date` datetime DEFAULT NULL,
  PRIMARY KEY (`apply_id`),
  KEY `fk_laptop_idx` (`laptop_id`),
  KEY `fk_feature_idx` (`feature_id`),
  CONSTRAINT `fk_feature_id` FOREIGN KEY (`feature_id`) REFERENCES `laptop_feature` (`product_feature_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_laptop` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`laptop_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laptop_feature_applicability`
--

LOCK TABLES `laptop_feature_applicability` WRITE;
/*!40000 ALTER TABLE `laptop_feature_applicability` DISABLE KEYS */;
/*!40000 ALTER TABLE `laptop_feature_applicability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laptop_price`
--

DROP TABLE IF EXISTS `laptop_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laptop_price` (
  `laptop_price_id` varchar(45) NOT NULL,
  `laptop_id` varchar(45) NOT NULL,
  `base_price` varchar(45) NOT NULL,
  `sales_price` varchar(45) NOT NULL,
  `from_date` varchar(45) NOT NULL,
  `thru_date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`laptop_price_id`),
  KEY `fk_price_laptop_idx` (`laptop_id`),
  CONSTRAINT `fk_price_laptop` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`laptop_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laptop_price`
--

LOCK TABLES `laptop_price` WRITE;
/*!40000 ALTER TABLE `laptop_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `laptop_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organization` (
  `organization_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `tax_id` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `comment` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`organization_id`),
  CONSTRAINT `organization_party` FOREIGN KEY (`organization_id`) REFERENCES `party` (`party_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `party`
--

DROP TABLE IF EXISTS `party`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `party` (
  `party_id` varchar(45) NOT NULL,
  `party_type` varchar(45) NOT NULL,
  PRIMARY KEY (`party_id`),
  UNIQUE KEY `unique_index` (`party_id`,`party_type`),
  KEY `fk_party_type_idx` (`party_type`),
  CONSTRAINT `fk_party_type` FOREIGN KEY (`party_type`) REFERENCES `party_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `party`
--

LOCK TABLES `party` WRITE;
/*!40000 ALTER TABLE `party` DISABLE KEYS */;
/*!40000 ALTER TABLE `party` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `party_contact_mechanism`
--

DROP TABLE IF EXISTS `party_contact_mechanism`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `party_contact_mechanism` (
  `party_contact_id` varchar(45) NOT NULL,
  `party_id` varchar(45) NOT NULL,
  `contact_id` varchar(45) NOT NULL,
  `from_date` datetime NOT NULL,
  `thru_date` datetime DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`party_contact_id`),
  KEY `fk_contact_idx` (`contact_id`),
  CONSTRAINT `fk_contact` FOREIGN KEY (`contact_id`) REFERENCES `party_contact_mechanism` (`party_contact_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `party_contact_mechanism`
--

LOCK TABLES `party_contact_mechanism` WRITE;
/*!40000 ALTER TABLE `party_contact_mechanism` DISABLE KEYS */;
/*!40000 ALTER TABLE `party_contact_mechanism` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `party_permission`
--

DROP TABLE IF EXISTS `party_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `party_permission` (
  `party_permission_id` int(11) NOT NULL,
  `party_id` varchar(45) NOT NULL,
  `permission` varchar(45) NOT NULL,
  `from_date` datetime NOT NULL,
  `thru_date` datetime DEFAULT NULL,
  `comment` text,
  `group_permission` int(11) DEFAULT NULL,
  PRIMARY KEY (`party_permission_id`,`from_date`,`party_id`,`permission`),
  KEY `fk_permission_party_idx` (`party_id`),
  KEY `fk_group_permission_idx` (`group_permission`),
  CONSTRAINT `fk_group_permission` FOREIGN KEY (`group_permission`) REFERENCES `party_permission` (`party_permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permission_party` FOREIGN KEY (`party_id`) REFERENCES `party` (`party_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `party_permission`
--

LOCK TABLES `party_permission` WRITE;
/*!40000 ALTER TABLE `party_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `party_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `party_role`
--

DROP TABLE IF EXISTS `party_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `party_role` (
  `party_role_id` int(11) NOT NULL,
  `party_id` varchar(45) NOT NULL,
  `role_id` varchar(45) NOT NULL,
  `from_date` datetime NOT NULL,
  `thru_date` datetime DEFAULT NULL,
  `comment` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`party_role_id`),
  KEY `fk_role_party_idx` (`party_id`),
  KEY `fk_role_type_idx` (`role_id`),
  CONSTRAINT `fk_role_party` FOREIGN KEY (`party_id`) REFERENCES `party` (`party_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_type` FOREIGN KEY (`role_id`) REFERENCES `role_type` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `party_role`
--

LOCK TABLES `party_role` WRITE;
/*!40000 ALTER TABLE `party_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `party_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `party_type`
--

DROP TABLE IF EXISTS `party_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `party_type` (
  `type_id` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `party_type`
--

LOCK TABLES `party_type` WRITE;
/*!40000 ALTER TABLE `party_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `party_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `person_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `number_id` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `comment` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  CONSTRAINT `person_party` FOREIGN KEY (`person_id`) REFERENCES `party` (`party_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preference_type`
--

DROP TABLE IF EXISTS `preference_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preference_type` (
  `preference_type_id` varchar(45) NOT NULL,
  `desciption` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`preference_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preference_type`
--

LOCK TABLES `preference_type` WRITE;
/*!40000 ALTER TABLE `preference_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `preference_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_invoice`
--

DROP TABLE IF EXISTS `purchase_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_invoice` (
  `invoice_id` int(11) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `total_money` varchar(45) DEFAULT NULL,
  `tax` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `comment` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_purchase_author_idx` (`author`),
  KEY `fk_invoice_supplier_idx` (`supplier_id`),
  CONSTRAINT `fk_invoice_purchase_author` FOREIGN KEY (`author`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_invoice_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_invoice`
--

LOCK TABLES `purchase_invoice` WRITE;
/*!40000 ALTER TABLE `purchase_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_invoice_item`
--

DROP TABLE IF EXISTS `purchase_invoice_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_invoice_item` (
  `item_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `laptop_id` varchar(45) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `comment` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `fk_item_purchase_invoice_idx` (`invoice_id`),
  KEY `fk_purchase_laptop_idx` (`laptop_id`),
  CONSTRAINT `fk_item_purchase_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `purchase_invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_laptop` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`laptop_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_invoice_item`
--

LOCK TABLES `purchase_invoice_item` WRITE;
/*!40000 ALTER TABLE `purchase_invoice_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_invoice_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order`
--

DROP TABLE IF EXISTS `purchase_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order` (
  `order_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `total_money` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`order_id`),
  KEY `fk_author_purchase_order_idx` (`author`),
  KEY `fk_supplier_id_idx` (`supplier_id`),
  CONSTRAINT `fk_author_purchase_order` FOREIGN KEY (`author`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order`
--

LOCK TABLES `purchase_order` WRITE;
/*!40000 ALTER TABLE `purchase_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order_item`
--

DROP TABLE IF EXISTS `purchase_order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order_item` (
  `item_id` int(11) NOT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `laptop_id` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `comment` text,
  `status` varchar(45) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `fk_item_purchase_idx` (`purchase_order_id`),
  KEY `fk_laptop_id_idx` (`laptop_id`),
  KEY `fk_item_purchase_laptop_idx` (`laptop_id`),
  CONSTRAINT `fk_item_purchase` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_purchase_laptop` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`laptop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order_item`
--

LOCK TABLES `purchase_order_item` WRITE;
/*!40000 ALTER TABLE `purchase_order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating_type`
--

DROP TABLE IF EXISTS `rating_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating_type` (
  `rating_type_id` varchar(45) NOT NULL,
  `desciption` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rating_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating_type`
--

LOCK TABLES `rating_type` WRITE;
/*!40000 ALTER TABLE `rating_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `rating_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_order`
--

DROP TABLE IF EXISTS `return_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_order` (
  `return_order_id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `author` varchar(45) NOT NULL,
  `create_date` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`return_order_id`),
  KEY `fk_return_order_author_idx` (`author`),
  KEY `fk_return_sales_order_idx` (`sales_order_id`),
  CONSTRAINT `fk_return_order_author` FOREIGN KEY (`author`) REFERENCES `party` (`party_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_return_sales_order` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_order`
--

LOCK TABLES `return_order` WRITE;
/*!40000 ALTER TABLE `return_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_order_item`
--

DROP TABLE IF EXISTS `return_order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_order_item` (
  `item_id` int(11) NOT NULL,
  `return_order_id` int(11) DEFAULT NULL,
  `sales_item` int(11) DEFAULT NULL,
  `reason` varchar(45) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `fk_sales_item_idx` (`sales_item`),
  CONSTRAINT `fk_sales_item` FOREIGN KEY (`sales_item`) REFERENCES `sales_order_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_order_item`
--

LOCK TABLES `return_order_item` WRITE;
/*!40000 ALTER TABLE `return_order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_type`
--

DROP TABLE IF EXISTS `role_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_type` (
  `role_id` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_type`
--

LOCK TABLES `role_type` WRITE;
/*!40000 ALTER TABLE `role_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_invoice`
--

DROP TABLE IF EXISTS `sales_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_invoice` (
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `author` int(11) NOT NULL,
  `total_money` varchar(45) DEFAULT NULL,
  `tax` varchar(45) DEFAULT NULL,
  `money_paid` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_customer_idx` (`customer_id`),
  KEY `fk_invoice_sales_author_idx` (`author`),
  CONSTRAINT `fk_invoice_customer` FOREIGN KEY (`customer_id`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_invoice_sales_author` FOREIGN KEY (`author`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_invoice`
--

LOCK TABLES `sales_invoice` WRITE;
/*!40000 ALTER TABLE `sales_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_invoice_item`
--

DROP TABLE IF EXISTS `sales_invoice_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_invoice_item` (
  `item_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `laptop_id` varchar(45) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`item_id`),
  KEY `fk_item_invoice_idx` (`invoice_id`),
  KEY `fk_invoice_sales_laptop_idx` (`laptop_id`),
  CONSTRAINT `fk_invoice_sales_laptop` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`laptop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `sales_invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_invoice_item`
--

LOCK TABLES `sales_invoice_item` WRITE;
/*!40000 ALTER TABLE `sales_invoice_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_invoice_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order`
--

DROP TABLE IF EXISTS `sales_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `staff_confirm` int(11) NOT NULL,
  `tax` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `total_money` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`order_id`),
  KEY `fk_customer_id_idx` (`customer_id`),
  KEY `fk_receiver_id_idx` (`receiver_id`),
  KEY `fk_staff_confirm_idx` (`staff_confirm`),
  CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_staff_confirm` FOREIGN KEY (`staff_confirm`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order`
--

LOCK TABLES `sales_order` WRITE;
/*!40000 ALTER TABLE `sales_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order_item`
--

DROP TABLE IF EXISTS `sales_order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_order_item` (
  `item_id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `laptop_id` varchar(45) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`item_id`),
  KEY `fk_item_sales_product_idx` (`laptop_id`),
  KEY `fk_item_sales_idx` (`sales_order_id`),
  CONSTRAINT `fk_item_sales` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_sales_product` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`laptop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order_item`
--

LOCK TABLES `sales_order_item` WRITE;
/*!40000 ALTER TABLE `sales_order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ship_schedule`
--

DROP TABLE IF EXISTS `ship_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ship_schedule` (
  `schedule_id` int(11) NOT NULL,
  `shipper_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date_ship` datetime NOT NULL,
  `estimate_time` datetime DEFAULT NULL,
  `actual_time` datetime DEFAULT NULL,
  `shipper_chosen_by` int(11) DEFAULT NULL,
  `shipper_replaced_with` int(11) DEFAULT NULL,
  `comment` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `fk_ship_order_idx` (`order_id`),
  KEY `fk_shipper_id_idx` (`shipper_id`),
  KEY `fk_shipper_chosen_by_idx` (`shipper_chosen_by`),
  KEY `fk_shipper_replace_with_idx` (`shipper_replaced_with`),
  CONSTRAINT `fk_ship_order` FOREIGN KEY (`order_id`) REFERENCES `sales_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_shipper_chosen_by` FOREIGN KEY (`shipper_chosen_by`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_shipper_id` FOREIGN KEY (`shipper_id`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_shipper_replace_with` FOREIGN KEY (`shipper_replaced_with`) REFERENCES `party_role` (`party_role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ship_schedule`
--

LOCK TABLES `ship_schedule` WRITE;
/*!40000 ALTER TABLE `ship_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `ship_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_item`
--

DROP TABLE IF EXISTS `status_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_item` (
  `status_id` varchar(45) NOT NULL,
  `status_type` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`),
  KEY `fk_status_type_idx` (`status_type`),
  CONSTRAINT `fk_status_type` FOREIGN KEY (`status_type`) REFERENCES `status_type` (`status_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_item`
--

LOCK TABLES `status_item` WRITE;
/*!40000 ALTER TABLE `status_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_type`
--

DROP TABLE IF EXISTS `status_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_type` (
  `status_type_id` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_type`
--

LOCK TABLES `status_type` WRITE;
/*!40000 ALTER TABLE `status_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_laptop`
--

DROP TABLE IF EXISTS `supplier_laptop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_laptop` (
  `supllier_laptop_id` varchar(45) NOT NULL,
  `laptop_id` varchar(45) NOT NULL,
  `organization_id` varchar(45) NOT NULL,
  `preference_type` varchar(45) DEFAULT NULL,
  `rating_type` varchar(45) DEFAULT NULL,
  `available_from_date` datetime DEFAULT NULL,
  `available_thru_date` datetime DEFAULT NULL,
  `standard_lead_time` date DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`supllier_laptop_id`),
  KEY `fk_laptop_id_idx` (`laptop_id`),
  KEY `fk_organization_idx` (`organization_id`),
  KEY `fk_preference_type_idx` (`preference_type`),
  KEY `fk_rating_type_idx` (`rating_type`),
  CONSTRAINT `fk_laptop_id` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`laptop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_organization` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`organization_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_preference_type` FOREIGN KEY (`preference_type`) REFERENCES `preference_type` (`preference_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rating_type` FOREIGN KEY (`rating_type`) REFERENCES `rating_type` (`rating_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_laptop`
--

LOCK TABLES `supplier_laptop` WRITE;
/*!40000 ALTER TABLE `supplier_laptop` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_laptop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `party_id` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `from_date` datetime DEFAULT NULL,
  `thru_date` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_party_idx` (`party_id`),
  CONSTRAINT `fk_user_party` FOREIGN KEY (`party_id`) REFERENCES `party` (`party_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login_log`
--

DROP TABLE IF EXISTS `user_login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_login_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` datetime DEFAULT NULL,
  `thru_date` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_user_log_idx` (`user_id`),
  CONSTRAINT `fk_user_log` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login_log`
--

LOCK TABLES `user_login_log` WRITE;
/*!40000 ALTER TABLE `user_login_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_login_log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-07 14:23:38
