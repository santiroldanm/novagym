-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: novagym
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'NovaGym Sede Central','Av. Diagonal 450, Barcelona','+34 932 112 233','Lunes a Domingo: 6:00 AM - 11:00 PM','active','2026-05-30 07:11:41','2026-05-30 07:11:41'),(2,'NovaGym Sede Norte','Calle de la Industria 89, Barcelona','+34 932 445 566','Lunes a Sábado: 7:00 AM - 10:00 PM','active','2026-05-30 07:11:41','2026-05-30 07:11:41'),(3,'NovaGym Sede Sur','Avenida del Sol 12, L\'Hospitalet','+34 932 778 899','Lunes a Viernes: 6:00 AM - 10:00 PM, Sábados: 8:00 AM - 2:00 PM','active','2026-05-30 07:11:41','2026-05-30 07:11:41');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `branch_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`),
  KEY `clients_user_id_foreign` (`user_id`),
  KEY `clients_branch_id_foreign` (`branch_id`),
  CONSTRAINT `clients_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,1,3,'Lucas Rivera','lucas.rivera@example.com','+34 612 345 678','https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200','active','2025-10-28 23:11:41','2025-10-28 23:11:41'),(2,1,2,'Sofía Medina','sofia.medina@example.com','+34 623 456 789','https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=200','active','2025-10-21 20:11:41','2025-10-21 20:11:41'),(3,1,NULL,'Mateo Silva','mateo.silva@example.com','+34 634 567 890','https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=200','active','2025-11-07 06:11:41','2025-11-07 06:11:41'),(4,1,1,'Valentina Rojas','valentina.rojas@example.com','+34 645 678 901','https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=200','active','2025-11-28 20:11:41','2025-11-28 20:11:41'),(5,1,1,'Alejandro Torres','alejandro.torres@example.com','+34 656 789 012',NULL,'active','2025-12-06 23:11:41','2025-12-06 23:11:41'),(6,1,2,'Camila Castro','camila.castro@example.com','+34 667 890 123','https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=200','active','2025-12-24 17:11:41','2025-12-24 17:11:41'),(7,1,3,'Santiago Delgado','santiago.delgado@example.com','+34 678 901 234','https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200','active','2025-12-14 00:11:41','2025-12-14 00:11:41'),(8,1,2,'Isabella Ortega','isabella.ortega@example.com','+34 689 012 345','https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=200','active','2026-01-27 11:11:41','2026-01-27 11:11:41'),(9,1,3,'Daniel Mendoza','daniel.mendoza@example.com','+34 690 123 456',NULL,'active','2026-01-18 14:11:41','2026-01-18 14:11:41'),(10,1,1,'Mariana Guerrero','mariana.guerrero@example.com','+34 601 234 567','https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&q=80&w=200','active','2026-02-03 20:11:41','2026-02-03 20:11:41'),(11,1,1,'Sebastián Valenzuela','sebastian.val@example.com','+34 611 223 344',NULL,'active','2026-02-01 17:11:41','2026-02-01 17:11:41'),(12,1,NULL,'Lucía Beltrán','lucia.beltran@example.com','+34 622 334 455','https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&q=80&w=200','active','2026-03-24 13:11:41','2026-03-24 13:11:41'),(13,1,2,'Andrés Peña','andres.pena@example.com','+34 633 445 566',NULL,'active','2026-03-27 00:11:41','2026-03-27 00:11:41'),(14,1,2,'Gabriela Fuentes','gabriela.fuentes@example.com','+34 644 556 677','https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&q=80&w=200','inactive','2026-03-21 16:11:41','2026-03-21 16:11:41'),(15,1,3,'Joaquín Herrera','joaquin.herrera@example.com','+34 655 667 788','https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&q=80&w=200','active','2026-04-21 16:11:41','2026-04-21 16:11:41'),(16,1,3,'Paula Vargas','paula.vargas@example.com','+34 666 778 899',NULL,'active','2026-04-10 13:11:41','2026-04-10 13:11:41'),(17,1,1,'Benjamín Navarro','benjamin.nav@example.com','+34 677 889 900','https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=200','active','2026-05-16 16:11:41','2026-05-16 16:11:41'),(18,1,1,'Emilia Santillán','emilia.s@example.com','+34 688 990 011','https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?auto=format&fit=crop&q=80&w=200','active','2026-05-06 22:11:41','2026-05-06 22:11:41');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `instructors_email_unique` (`email`),
  KEY `instructors_user_id_foreign` (`user_id`),
  CONSTRAINT `instructors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors`
--

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
INSERT INTO `instructors` VALUES (1,1,'Admin Nova (Coach)','admin@novagym.com','+34 600 111 222','Entrenamiento Funcional & GPP','https://images.unsplash.com/photo-1568602471122-7832951cc4c5?auto=format&fit=crop&q=80&w=200','active','2026-05-30 07:11:41','2026-05-30 07:11:41'),(2,NULL,'Carlos Mendoza','carlos.mendoza@novagym.com','+34 611 222 333','Powerlifting & Fuerza Máxima','https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?auto=format&fit=crop&q=80&w=200','active','2026-05-30 07:11:41','2026-05-30 07:11:41'),(3,NULL,'Elena Rostova','elena.rostova@novagym.com','+34 622 333 444','Nutrición Deportiva & Recomposición','https://images.unsplash.com/photo-1594381898411-846e7d193883?auto=format&fit=crop&q=80&w=200','active','2026-05-30 07:11:41','2026-05-30 07:11:41'),(4,NULL,'Marcus Vance','marcus.vance@novagym.com','+34 633 444 555','CrossFit Coach & HIIT','https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200','active','2026-05-30 07:11:41','2026-05-30 07:11:41'),(5,NULL,'Silvia Guerrero','silvia.guerrero@novagym.com','+34 644 555 666','Yoga, Flexibilidad & Movilidad','https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=200','active','2026-05-30 07:11:41','2026-05-30 07:11:41'),(6,NULL,'Daniela Ortiz','daniela.ortiz@novagym.com','+34 655 666 777','Pilates & Recuperación Lesiones','https://images.unsplash.com/photo-1548690312-e3b507d8c110?auto=format&fit=crop&q=80&w=200','inactive','2026-05-30 07:11:41','2026-05-30 07:11:41');
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meal_plans`
--

DROP TABLE IF EXISTS `meal_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meal_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `calories` int DEFAULT NULL,
  `proteins_g` int DEFAULT NULL,
  `carbs_g` int DEFAULT NULL,
  `fats_g` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meal_plans_client_id_foreign` (`client_id`),
  KEY `meal_plans_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `meal_plans_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `meal_plans_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meal_plans`
--

LOCK TABLES `meal_plans` WRITE;
/*!40000 ALTER TABLE `meal_plans` DISABLE KEYS */;
INSERT INTO `meal_plans` VALUES (1,6,2,'Volumen Limpio Estructurado','Comida 1: Cereal de avena con proteínas, plátano y nueces.\nComida 2: Tortilla de 4 claras y 1 huevo entero con espinacas y arroz integral.\nComida 3: Pechuga de pollo a la plancha, patata dulce al horno y brócoli al vapor.\nComida 4: Batido de proteína de suero y una manzana.\nComida 5: Salmón fresco con quinoa y ensalada verde mixta.',3200,200,450,80,'2025-12-25 17:11:41','2025-12-25 17:11:41'),(2,16,4,'Déficit Calórico Definición','Comida 1: Claras de huevo revueltas, una rebanada de pan integral tostado y té verde.\nComida 2: Yogur griego desnatado con frutos rojos y semillas de chía.\nComida 3: Pechuga de pavo con ensalada de espinacas, tomates cherry y aguacate.\nComida 4: Un puñado de almendras y una porción de piña.\nComida 5: Merluza al horno con espárragos trigueros.',1900,170,160,55,'2026-04-11 13:11:41','2026-04-11 13:11:41'),(3,10,1,'Mantenimiento Energético Funcional','Comida 1: Huevos revueltos, tostadas integrales con aguacate y café.\nComida 2: Fruta de temporada y queso fresco bajo en grasa.\nComida 3: Ternera magra guisada con patatas y verduras variadas.\nComida 4: Queso batido con nueces.\nComida 5: Filete de atún con arroz basmati y ensalada.',2500,180,280,70,'2026-02-04 20:11:41','2026-02-04 20:11:41'),(4,7,5,'Dieta Cetogénica Adaptada','Comida 1: Huevos con bacon y aguacate.\nComida 2: Batido de proteínas con leche de almendras y crema de cacahuete.\nComida 3: Ensalada César con pollo, panceta y aderezo de aceite de oliva.\nComida 4: Apio con queso crema.\nComida 5: Costillas de cerdo asadas con brócoli gratinado.',2200,140,25,170,'2025-12-17 00:11:41','2025-12-17 00:11:41'),(5,8,2,'Volumen Limpio Estructurado','Comida 1: Cereal de avena con proteínas, plátano y nueces.\nComida 2: Tortilla de 4 claras y 1 huevo entero con espinacas y arroz integral.\nComida 3: Pechuga de pollo a la plancha, patata dulce al horno y brócoli al vapor.\nComida 4: Batido de proteína de suero y una manzana.\nComida 5: Salmón fresco con quinoa y ensalada verde mixta.',3200,200,450,80,'2026-01-28 11:11:41','2026-01-28 11:11:41'),(6,13,3,'Déficit Calórico Definición','Comida 1: Claras de huevo revueltas, una rebanada de pan integral tostado y té verde.\nComida 2: Yogur griego desnatado con frutos rojos y semillas de chía.\nComida 3: Pechuga de pavo con ensalada de espinacas, tomates cherry y aguacate.\nComida 4: Un puñado de almendras y una porción de piña.\nComida 5: Merluza al horno con espárragos trigueros.',1900,170,160,55,'2026-03-28 00:11:41','2026-03-28 00:11:41'),(7,2,5,'Mantenimiento Energético Funcional','Comida 1: Huevos revueltos, tostadas integrales con aguacate y café.\nComida 2: Fruta de temporada y queso fresco bajo en grasa.\nComida 3: Ternera magra guisada con patatas y verduras variadas.\nComida 4: Queso batido con nueces.\nComida 5: Filete de atún con arroz basmati y ensalada.',2500,180,280,70,'2025-10-23 20:11:41','2025-10-23 20:11:41'),(8,15,2,'Dieta Cetogénica Adaptada','Comida 1: Huevos con bacon y aguacate.\nComida 2: Batido de proteínas con leche de almendras y crema de cacahuete.\nComida 3: Ensalada César con pollo, panceta y aderezo de aceite de oliva.\nComida 4: Apio con queso crema.\nComida 5: Costillas de cerdo asadas con brócoli gratinado.',2200,140,25,170,'2026-04-24 16:11:41','2026-04-24 16:11:41'),(9,14,5,'Volumen Limpio Estructurado','Comida 1: Cereal de avena con proteínas, plátano y nueces.\nComida 2: Tortilla de 4 claras y 1 huevo entero con espinacas y arroz integral.\nComida 3: Pechuga de pollo a la plancha, patata dulce al horno y brócoli al vapor.\nComida 4: Batido de proteína de suero y una manzana.\nComida 5: Salmón fresco con quinoa y ensalada verde mixta.',3200,200,450,80,'2026-03-23 16:11:41','2026-03-23 16:11:41'),(10,11,1,'Déficit Calórico Definición','Comida 1: Claras de huevo revueltas, una rebanada de pan integral tostado y té verde.\nComida 2: Yogur griego desnatado con frutos rojos y semillas de chía.\nComida 3: Pechuga de pavo con ensalada de espinacas, tomates cherry y aguacate.\nComida 4: Un puñado de almendras y una porción de piña.\nComida 5: Merluza al horno con espárragos trigueros.',1900,170,160,55,'2026-02-04 17:11:41','2026-02-04 17:11:41'),(11,1,2,'Mantenimiento Energético Funcional','Comida 1: Huevos revueltos, tostadas integrales con aguacate y café.\nComida 2: Fruta de temporada y queso fresco bajo en grasa.\nComida 3: Ternera magra guisada con patatas y verduras variadas.\nComida 4: Queso batido con nueces.\nComida 5: Filete de atún con arroz basmati y ensalada.',2500,180,280,70,'2025-10-30 23:11:41','2025-10-30 23:11:41'),(12,12,1,'Dieta Cetogénica Adaptada','Comida 1: Huevos con bacon y aguacate.\nComida 2: Batido de proteínas con leche de almendras y crema de cacahuete.\nComida 3: Ensalada César con pollo, panceta y aderezo de aceite de oliva.\nComida 4: Apio con queso crema.\nComida 5: Costillas de cerdo asadas con brócoli gratinado.',2200,140,25,170,'2026-03-25 13:11:41','2026-03-25 13:11:41');
/*!40000 ALTER TABLE `meal_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memberships` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_type` enum('monthly','quarterly','annual','custom') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `price` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','expired','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `memberships_client_id_foreign` (`client_id`),
  KEY `memberships_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `memberships_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `memberships_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES (1,1,5,'Nova Plan Quarterly','quarterly',120.00,'2026-05-21','2026-08-21','active','Suscripción inicial generada por el sistema.','2025-10-28 23:11:41','2025-10-28 23:11:41'),(2,2,4,'Nova Plan Quarterly','quarterly',120.00,'2026-05-24','2026-08-24','active','Suscripción inicial generada por el sistema.','2025-10-21 20:11:41','2025-10-21 20:11:41'),(3,3,2,'Nova Plan Monthly','monthly',45.00,'2026-05-19','2026-06-19','active','Suscripción inicial generada por el sistema.','2025-11-07 06:11:41','2025-11-07 06:11:41'),(4,4,3,'Nova Plan Quarterly','quarterly',120.00,'2026-05-22','2026-08-22','active','Suscripción inicial generada por el sistema.','2025-11-28 20:11:41','2025-11-28 20:11:41'),(5,5,4,'Nova Plan Quarterly','quarterly',120.00,'2026-05-28','2026-08-28','active','Suscripción inicial generada por el sistema.','2025-12-06 23:11:41','2025-12-06 23:11:41'),(6,6,3,'Nova Plan Monthly','monthly',45.00,'2026-05-22','2026-06-22','active','Suscripción inicial generada por el sistema.','2025-12-24 17:11:41','2025-12-24 17:11:41'),(7,7,4,'Nova Plan Annual','annual',400.00,'2026-05-18','2027-05-18','active','Suscripción inicial generada por el sistema.','2025-12-14 00:11:41','2025-12-14 00:11:41'),(8,8,2,'Nova Plan Quarterly','quarterly',120.00,'2026-05-15','2026-08-15','active','Suscripción inicial generada por el sistema.','2026-01-27 11:11:41','2026-01-27 11:11:41'),(9,9,4,'Nova Plan Monthly','monthly',45.00,'2026-05-23','2026-06-23','active','Suscripción inicial generada por el sistema.','2026-01-18 14:11:41','2026-01-18 14:11:41'),(10,10,2,'Nova Plan Quarterly','quarterly',120.00,'2026-05-22','2026-08-22','active','Suscripción inicial generada por el sistema.','2026-02-03 20:11:41','2026-02-03 20:11:41'),(11,11,5,'Nova Plan Quarterly','quarterly',120.00,'2026-05-20','2026-08-20','active','Suscripción inicial generada por el sistema.','2026-02-01 17:11:41','2026-02-01 17:11:41'),(12,12,2,'Nova Plan Quarterly','quarterly',120.00,'2026-05-27','2026-08-27','active','Suscripción inicial generada por el sistema.','2026-03-24 13:11:41','2026-03-24 13:11:41'),(13,13,2,'Nova Plan Annual','annual',400.00,'2026-05-28','2027-05-28','active','Suscripción inicial generada por el sistema.','2026-03-27 00:11:41','2026-03-27 00:11:41'),(14,14,3,'Nova Plan Monthly','monthly',45.00,'2026-03-21','2026-04-21','cancelled','Suscripción inicial generada por el sistema.','2026-03-21 16:11:41','2026-03-21 16:11:41'),(15,15,3,'Nova Plan Annual','annual',400.00,'2026-05-21','2027-05-21','active','Suscripción inicial generada por el sistema.','2026-04-21 16:11:41','2026-04-21 16:11:41'),(16,16,5,'Nova Plan Annual','annual',400.00,'2026-05-22','2027-05-22','active','Suscripción inicial generada por el sistema.','2026-04-10 13:11:41','2026-04-10 13:11:41'),(17,17,3,'Nova Plan Monthly','monthly',45.00,'2026-05-16','2026-06-16','active','Suscripción inicial generada por el sistema.','2026-05-16 16:11:41','2026-05-16 16:11:41'),(18,18,4,'Nova Plan Annual','annual',400.00,'2026-05-20','2027-05-20','active','Suscripción inicial generada por el sistema.','2026-05-06 22:11:41','2026-05-06 22:11:41');
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_05_28_000000_create_clients_table',1),(6,'2026_05_28_010000_create_instructors_table',1),(7,'2026_05_28_020000_create_memberships_table',1),(8,'2026_05_28_100000_create_routines_table',1),(9,'2026_05_29_050603_add_user_id_to_instructors_table',1),(10,'2026_05_29_050647_add_instructor_id_to_routines_table',1),(11,'2026_05_30_014608_create_branches_table',1),(12,'2026_05_30_014612_add_branch_id_to_clients_table',1),(13,'2026_05_30_014616_create_meal_plans_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routines`
--

DROP TABLE IF EXISTS `routines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `routines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `difficulty` enum('beginner','intermediate','advanced') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `instructor_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `routines_client_id_foreign` (`client_id`),
  KEY `routines_instructor_id_index` (`instructor_id`),
  CONSTRAINT `routines_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `routines_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routines`
--

LOCK TABLES `routines` WRITE;
/*!40000 ALTER TABLE `routines` DISABLE KEYS */;
INSERT INTO `routines` VALUES (1,8,'Hipertrofia Funcional X','Enfoque en fuerza máxima y volumen muscular empleando patrones de movimiento compuestos y alta densidad de entrenamiento. Ideal para atletas avanzados.','advanced','2026-01-30 11:11:41','2026-01-30 11:11:41',3),(2,6,'Fuerza Básica 5x5','Rutina clásica de fuerza basada en ejercicios multiarticulares: Sentadilla, Press Banca, Peso Muerto, Press Militar y Remo con Barra.','beginner','2025-12-27 17:11:41','2025-12-27 17:11:41',1),(3,18,'Acondicionamiento Nova H.I.I.T','Circuito metabólico de alta intensidad para optimizar el consumo de oxígeno (VO2 máx) y acelerar la oxidación de lípidos.','intermediate','2026-05-09 22:11:41','2026-05-09 22:11:41',1),(4,1,'Powerbuilding Pro','Combinación perfecta de levantamientos de fuerza para powerlifting y ejercicios de aislamiento de culturismo para estética.','advanced','2025-11-02 23:11:41','2025-11-02 23:11:41',4),(5,13,'Movilidad y Core Start','Enfoque en mejorar los rangos de movimiento articular, flexibilidad dinámica y estabilización de la zona media.','beginner','2026-04-01 00:11:41','2026-04-01 00:11:41',5),(6,14,'Full Body Nova Athlete','Rutina cuerpo completo de tres días por semana, optimizada para deportistas que buscan rendimiento y desarrollo atlético equilibrado.','intermediate','2026-03-26 16:11:41','2026-03-26 16:11:41',5),(7,12,'Empuje / Tirón / Pierna (PPL)','División clásica para hipertrofia, distribuyendo los días en patrones de empuje, tirón y tren inferior para máxima recuperación.','intermediate','2026-03-29 13:11:41','2026-03-29 13:11:41',4),(8,9,'Acondicionamiento Cardiovascular GPP','Preparación física general enfocada en resistencia cardiovascular mediante remo, bicicleta estática y kettlebell swings.','beginner','2026-01-21 14:11:41','2026-01-21 14:11:41',5),(9,5,'Fuerza Explosiva y Pliometría','Rutina avanzada para el desarrollo de potencia vertical, aceleración y transferencia de fuerza mediante saltos y lanzamientos.','advanced','2025-12-08 23:11:41','2025-12-08 23:11:41',2),(10,3,'Rutina Definición Estética','Volumen de trabajo medio-alto con descansos cortos e inclusión de superseries para optimizar la definición muscular manteniendo la fuerza.','intermediate','2025-11-09 06:11:41','2025-11-09 06:11:41',4);
/*!40000 ALTER TABLE `routines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Nova','admin@novagym.com',NULL,'$2y$12$Z8bCk4pWZsPeaK0m1IvxmOkkFw7LVXYXcO7za2PzMru.WR2NQXSDO',NULL,'2026-05-30 07:11:41','2026-05-30 07:11:41');
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

-- Dump completed on 2026-05-29 23:03:29
