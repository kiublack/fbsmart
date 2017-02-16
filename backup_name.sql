-- MySQL dump 10.13  Distrib 5.6.33, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: phoneget
-- ------------------------------------------------------
-- Server version	5.6.33-0ubuntu0.14.04.1

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
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pid` varchar(100) NOT NULL,
  `facebookAccessToken` varchar(1000) NOT NULL,
  `sheetId` varchar(50) DEFAULT NULL,
  `userFid` varchar(100) NOT NULL,
  `active` int(1) DEFAULT '0',
  `googleAccessToken` varchar(500) DEFAULT NULL,
  `userId` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (2,'Thải độc Giảm cân An toàn, Hiệu quả','1263790890377522','EAANpIyXnIw0BABEyBzZAeEcIDe6wreciWJZB1K0pZAyfb0o5q1kVBeaUtaFMaaIl1jqIjtjBQwBZArOSTedwKWjkfSTi4LyqZCuHMcOBhuMC0OBlEE4lzuNLZCkmUuDBujaVuMOr4lIu5sAZApGiQLyhV9aqLJNiAIZD','1TgS-IIb_pcbwMP32w4CnskGKBJ4H67UGUiBj54jYreg','175495219606247',1,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(3,'Dầu Đông Y Thu Hương - Đặc Trị Rụng Tóc, Kích Thích Mọc Tóc, Chữa Tóc Bạc','168445716842247','EAANpIyXnIw0BAMZCs7aTD28BOXbTElZC28zwPypi04IAVn4OZCeRybSW8E5ZBQ2ZAb869abK08qXctJK7VFtwQxwxXL0geSikUFhn8CP803HaGITEo3Ax8dLz7hYwfzTLTCUgxRWEDE0X9fDb0layX24HZB3ijyQEZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(4,'Hanoi Lab','1427452364201837','EAANpIyXnIw0BACBU40hWGAaHB22Qmd3jvBN2lLTK3EdunMVnS6WiZAegPjApZAETpZB2iJnCqictiAB1MA6TtZAQEln4WQezYKO4I1yiRR9cywpYrgIauKwCSqpL6kKdUX87z7qqJVtZCKrJKpRe910ao5jcirf8ZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(5,'Lương Y Thu Hương- Đặc Trị Rụng Tóc, Kích Thích Mọc Tóc, Chữa Tóc Bạc','1029993940380385','EAANpIyXnIw0BABvDoNEj0r6Mtkn6mVW7U8lSJaw4UsFdyDTHE3K4CNBGcMV86RZCtMb8N5FyZArlBwakDJNBjTfYmGAorvrAZBClHL3fgfUbgFskd70KpjpE16AmpKTZB9ohZB1hZBuPKVqMkkBtKFAToEsE1mQGoZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(6,'Viet Hearts','248613405241451','EAANpIyXnIw0BAAlboExrT6w3eGZCRlmrEaLP2dftkDwviQxD63xsEAMS7BjH5gNiyvdi7mjQiMJd3mc5Nrp8lbZBehbrN7SbAUCK121i24mWeCAnZAF204D3UuQlO3knsfbob0Ps8Smkzh4bZAo9AVZAnqkdfryQZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(7,'Hanoi Lab - Chuyên Laptop Nhập Mỹ Chính hãng loại 1','1139335622840719','EAANpIyXnIw0BADLIKd694yukyrTqQCGiINwL13kZAGnEHqmShJLJChHagZCayrZCvtxjaGjF8FqdvZBILKamAIGn2Ca1QxmZB2KZBDn8dD1uAzrkG4Wsx5sJOPdgZBf5eDHWJ3xUTdg3M3w8DtnMCgNWlkX3qK2IHcZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(8,'Thuốc Đặc Trị Viêm-Loét Dạ Dày,Tá Tràng,Đại Tràng- BS Đông Y Nguyễn Khoa.','1926230740938131','EAANpIyXnIw0BAATnFXK3uZBq8KpZCgsAZAzeeiQSaMcMnfxuwR8VekvU04tQ6E9bwCNStCL9mUH7peyueAKyIL8yy3g2ERYHfnXIWnrZAv6IwMqC6LxurtOSjDUBXnQkLplu74RPnBzC4dbsuBDZAYr5uMkqrr3IZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(9,'Đào Hoàng Cường','1676751735876208','EAANpIyXnIw0BALsbYoUj3YUDj1Vu562TEvlhbZA1PZA9175k1YzYlcTeuRXWeOn7lLqbs3oyZCZBu8qxEoskilJPT7ZBK9SsxMznMBXDShlvYosZBZAZBSiILMQUXA4vgzGEJvpS5yza9o6CZBZADPqWQJcZBtVSsOyPr8ZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(10,'Bí Kíp Doanh Nhân','999827966829924','EAANpIyXnIw0BAGtDauAgqui37h3ZArDFg9kH8aFwBsvjRctdcMT0D0n5GSRZCeoKAh6BzBeV3kBUoWLExTt1YNfI06KrxkJtxGC8N08PuntimmhwIAaZA6eLZAgJwZAO1GFQEAPAZCoWpeL10OamLsehjEsZC1a15cZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(11,'Thải độc Giảm béo Phiên Hồng Hoa Tây Tạng','615198411993779','EAANpIyXnIw0BAAMUNnBJ4vHdyPWUoF5Vtl2ntrFHvIBydLc6zF5eZCCuzZAD80bk8DD6RqoNZCEWN0ZA4sxDuo22ITIfLDt3ZCPTMEd3XUpdZCE2HKxvyMN6CZC7o21BurIaiYyshzwV6CAPeHbsAmEsvjUFcwyBpYZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(12,'USAOrder.vn - Chuyên gia đặt hàng Mỹ số 1 Việt Nam','536617783202986','EAANpIyXnIw0BAEVXT8a3I4Eh2yCMeVVTb36SJx0xau4c7wZAUBsHbiQVwjL4W21uZAQmvlfuxbMCZC2yM4h8Q1MqVPnFiDxMpQVa6pJzZClQbC6vhy1H62YqTQ8BPr9ooIlbsL4VA5fUSlkTIis2nYGZAi0y8uOkZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(13,'Minh Y Đường - Phiên hồng hoa Tây Tạng - Đặc Trị Nám, Tàn Nhang','317910825214115','EAANpIyXnIw0BAE94TC281wM0ZAwgOwXtHkmmR6mp78i405yZBvGZAouk1z7vCwkT6JF78andel2EulazY4QlvQGVxup6XMEd41UEZB5CotBLi1gSzO9Nm5ORM1EwblVZBOgl9gJrUkX72A9ZCyzPAxXCWUfoAZCxWcZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(14,'Minh Y Đường- Điều Trị Từ Gốc Bệnh','428519543939444','EAANpIyXnIw0BADsRDhJ51mOKxhqOv6lL2MPYvBUZAcdlmJ9MKYPNHBXSXqhUDPyA1cFjQOg5ZAaqYDoe818z3WuO4fSz6ksVd0Jlwcu7ZBbbOPn1T4orcbSjQcb3UkEJgFbUrzlRsCKaQBoYlhXWGnEkdbvFUkZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15'),(15,'ONNET','360975620722842','EAANpIyXnIw0BAM4ZBwwWmUSnWZC6NfLuSypK1B6UMhbWSJu8EcWFVWQljgry7GF6mS5r0rSD2St5YxD66UPzi5L0zPP2wOTM7zjOLVxEZAza3YJB7cjXsy3UOVhZBqf0BG3eYZCB43isLSHA14ZCmlnZCiCkMfZCGakZD',NULL,'175495219606247',0,'{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','15');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `facebookToken` varchar(200) NOT NULL DEFAULT '',
  `googleToken` varchar(2000) DEFAULT NULL,
  `session` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'1272593462833383','Dương Văn Ba','Updated','{\"access_token\":\"ya29.GlzxA2XRa6n7Q8vhnHzMxeg0rNPRt8HV_txBa6APpTCicqeOohGPX4E-A7zo16de9V11qppuyoX9ENmE2CsXo2T5KtKujIwJaH8CV9TQ8SVj-K1HmYi7hZJI-eZ1Ig\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1486995996,\"refresh_token\":\"1\\/-w7Oszv_Bl9Ke_Lz9A2PRvRuCWcckE5a3yRgXpR7m60\"}','o8uj6ads36fq8kt2v2kveo6rf2'),(15,'175495219606247','Cuong Hoang','Updated','{\"access_token\":\"ya29.GlzzA4bpa-2MUPjzxiND5ouDFXcNmZOZEBS2PLg-oxBHAHCPJ-ymHguSEu7e5s3Jz1qbPpRD0DPDR9J1NKJKU73pNb26puUXa5_wafTlx7WCHn1dy47einJTX6ojpw\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1487182312,\"refresh_token\":\"1\\/YxFyPU-vlQYyhygZY3-fYmfPxal_5TsMCCRvlpYpwSU\"}','aginl4cg2cniefdhm67234kov5'),(16,'101550340368387','Nhật Quang','Updated','{\"access_token\":\"ya29.GlvxAxv7wHNM_SUrOZOn1UZlVaBg-PPYAjZNydq_OJsk49WTUGWNJJi9xwwDj7mNSR8mlw2NTNY-QIrtyzyLY5cVnkSXft_iddp9cyi-i7OQEWQyaOPCTws79DhX\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"refresh_token\":\"1\\/aqiJsFf88zJMAPwqcpzv45XOPDkdo-vVrFnMAcz4W1k\",\"created\":1486960701}','hq5tj0gmpofese8nq587tv7j76');
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

-- Dump completed on 2017-02-15 18:13:36
