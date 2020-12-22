/*
SQLyog Professional v12.14 (64 bit)
MySQL - 10.4.13-MariaDB : Database - desafiopixarron
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`desafiopixarron` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `desafiopixarron`;

/*Table structure for table `address` */

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address_user_id_foreign` (`user_id`),
  CONSTRAINT `address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `address` */

insert  into `address`(`id`,`address`,`created_at`,`updated_at`,`lat`,`lng`,`reference`,`active`,`user_id`) values 
(20,'Urb. Mariscal Luzuariaga  Mz. B Lt-19','2020-12-22 20:58:17','2020-12-22 20:58:17','0','0','A media cuadra de la plaza mayor',1,27),
(21,'Urb. Mariscal Luzuariaga  Mz. B Lt-19','2020-12-22 20:58:17','2020-12-22 20:58:17','0','0','A media cuadra de la plaza mayor',1,28),
(22,'Av. Santiago 356 S/n ','2020-12-22 20:58:17','2020-12-22 20:58:17','0','0','A media cuadra de plaza chimu',1,29),
(23,'Av. Los Uranios','2020-12-22 21:12:55','2020-12-22 21:12:55','0','0','Av. Los Uranios',1,28);

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `item_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_user_id_foreign` (`user_id`),
  KEY `cart_item_id_foreign` (`item_id`),
  CONSTRAINT `cart_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cart` */

insert  into `cart`(`id`,`uuid`,`user_id`,`item_id`,`qty`,`created_at`,`updated_at`) values 
(54,'af43f638-6f05-4316-9419-e940d8f2f0ae',29,13,1,'2020-12-22 20:58:17','2020-12-22 20:58:17'),
(55,'e4eeea7e-dbb2-4548-bfc8-92a17aa9f2f6',29,13,1,'2020-12-22 20:58:17','2020-12-22 20:58:17'),
(56,'866579aa-64c0-4752-81ac-35a471a40b58',29,13,1,'2020-12-22 20:58:17','2020-12-22 20:58:17'),
(57,'0a829a3d-10e5-4da4-9221-8bcf0b75cae7',29,13,1,'2020-12-22 20:58:17','2020-12-22 20:58:17'),
(58,'a327915f-b9b7-4daf-8a82-8ca4a996a837',29,13,1,'2020-12-22 20:58:17','2020-12-22 20:58:17');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(455) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://via.placeholder.com/300x300.png?text=Tu+Imagen+de+Producto%20C/O%20https://placeholder.com/',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `items` */

insert  into `items`(`id`,`uuid`,`name`,`description`,`active`,`price`,`image`,`created_at`,`updated_at`) values 
(1,'8b5689d6-a1a3-457c-aa5c-1ccb96a2a56b','Caprese Salad (350gr)','peeled tomatoes, mozzarella salad, Genovese pesto',1,9.99,'https://devmarcoestrada.com/assets/proyectos/tienda_taglio.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(2,'e746ad84-8f85-4376-8afb-83d7f442ada4','Caesar Salad (400g)','iceberg, bacon, chicken breast, parmesan, Caesar sauce',1,10.99,'https://devmarcoestrada.com/assets/proyectos/tienda_joeburguer.png','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(3,'0da666de-1152-492f-b85f-ff1e49aed74f','Salad Napoli (350g)','iceberg, arugula, cherry tomatoes, mozzarella salad, salad dressing: (Extra Virgin olive oil, Modena balsamic vinegar, honey and mustard)',1,9.99,'https://devmarcoestrada.com/assets/proyectos/wordpress_casascruz.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(4,'2b5e4ab4-8d35-4d09-a098-0ec9317b5739','Green tuna salad (400g)','lettuce, cucumbers, tuna, olive, corn, lemon, salad dressing: (Extra Virgin olive oil, Modena balsamic vinegar, honey and mustard)',1,9.99,'https://devmarcoestrada.com/assets/proyectos/wordpress_costabella.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(5,'26b60cec-4242-4034-9412-32b02b1d5cde','Green salad (350g)','lettuce, cucumbers, radishes, onions, egg, salad dressing: (Extra Virgin olive oil, Modena balsamic vinegar, honey and mustard)',1,7.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(6,'82ddb354-0f3a-4ea3-875d-04f0676a9903','Greek Salad (500g)','tomatoes, cucumbers, green pepper, red onion, olive, feta cheese, extra virgin olive oil',1,9.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(7,'2a5cf890-b392-499f-ba53-53a3732a4a7c','Mozzarella Pizza','tomato sauce, mozzarella sabelli, cherry tomatoes, olives, pesto sauce, extra virgin olive oil',1,10.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(8,'11cde48b-c79f-48f7-b303-81fc5a5a4072','Prosciutto crust pizza','tomato sauce, mozzarella sabelli, prosciutto, arugula, extra virgin olive oil',1,14.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(9,'d3d4b1ac-7ab2-4d90-b499-bc3ca48b043c','Pepperoni Pizza','tomato sauce, mozzarella Sabelli, Calabro salad (spicy), extra virgin olive oil',1,14.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(10,'1a60a3e8-379e-4110-b59f-98c4ca274451','Carriola Pizza','tomato sauce, mozzarella sabelli, bacon, red onion, olives, extra virgin olive oil',1,14.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(11,'c73ea17e-72a3-4781-b3b0-56378a1da02c','Perugia Pizza','tomato sauce, mozzarella sabelli, chicken fillet, red onion, fresh peppers, extra virgin olive oil',1,14.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(12,'f0098037-b196-44ec-aa46-c7097ef1ec82','Pizza Napoli','tomato sauce, mozzarella sabelli, ham, cherry tomatoes, emmental, arugula, extra virgin olive oil',1,14.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(13,'94a402bf-07b9-430c-9beb-06a4dc88951d','Margarita Pizza','tomato sauce, mozzarella Sabelli, extra virgin olive oil',1,10.49,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(14,'f587cc7a-0ed0-4fd0-a4b8-69ea4ee27469','Combo Pizza 50/50 (70cm)','tomato sauce, mozzarella Sabelli, extra virgin olive oil',1,39.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(15,'a1fbb4f4-be22-491c-b73c-ca6138b0069e','Capricciosa Pizza','tomato sauce, mozzarella sabelli, ham, fresh mushrooms, extra virgin olive oil',1,14.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(16,'ba292222-100f-44bf-b139-81feaea6964b','Quattro Formaggi Pizza','cream (animal), mozzarella Sabelli, blue cheese, emmental, parmesan, extra virgin olive oil',1,14.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(17,'e55ccfb0-953d-4878-9cf6-a5b4aacc03a8','Marco Polo Pizza','tomato sauce, Sabelli mozzarella, chicken fillet, smoked cheese, corn, extra virgin olive oil',1,14.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(18,'7b382365-fb1b-4a3f-b7e4-27ec1084485d','Spaghetti Carbonara (450g)','fresh pasta, cream (animal), onion, pancakes (smoked bacon), egg, parmesan',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(19,'67908814-7ebf-4bb8-9da5-d85da18e453f','Spaghetti Formaggi (450g)','fresh pasta, cream (animal), blue cheese, emmental, parmesan',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(20,'f1145d22-b8de-4e99-9789-9a89b1d2c8a8','Tagliatelle with mushrooms (400g)','fresh pasta, cream (animal), mushrooms, parmesan',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(21,'9f6ca887-2794-4c1e-9b74-6edead8a05af','Chicken risotto (450g)','Arborio rice, chicken breast, onion, parmesan',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(22,'c96611d3-76fa-4d8a-b396-d3c08a89913f','Risotto with mushrooms (450g)','Arborio rice, mushrooms, garlic, parmesan',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(23,'60be9957-582d-4e6c-a168-7391647170d7','Tagliatelle with Bolognese Sauce (400g)','fresh pasta, bolognese sauce, parmesan',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(24,'56d8748b-778d-45b8-9cf0-92e2a8d08ceb','Lasagna Classic (450g)','Bolognese sauce, mozzarella Sabelli',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(25,'400b2bac-ab83-4823-b0a9-ada5dd0b015f','Napoli Lasagna (450g)','chicken fillet, cream (animal), corn, blue cheese, mozzarella Sabelli',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17'),
(26,'7291ca68-a918-4f88-a0ac-5b355532b4aa','Lasagna Formagio (450g)','smoked cheese, blue cheese, emmental, cream (animal), mozzarella Sabelli',1,11.99,'https://devmarcoestrada.com/assets/proyectos/web_marcoestrada.PNG','2020-12-22 20:58:17','2020-12-22 20:58:17');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2016_06_01_000001_create_oauth_auth_codes_table',1),
(3,'2016_06_01_000002_create_oauth_access_tokens_table',1),
(4,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),
(5,'2016_06_01_000004_create_oauth_clients_table',1),
(6,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),
(7,'2019_08_19_000000_create_failed_jobs_table',1),
(8,'2020_12_20_194710_add_uuid_users',2),
(9,'2020_12_20_231301_create_permission_tables',3),
(10,'2020_12_20_231454_add_roles_data',4),
(11,'2020_12_21_001913_create_tables_address',5),
(12,'2020_12_21_010419_create_table_items',6),
(13,'2020_12_21_011300_create_table_orders',7),
(14,'2020_12_21_011450_create_table_order_details',8),
(16,'2020_12_21_222934_create_table_cart',9),
(22,'2020_12_22_150621_demo_data',10),
(23,'2020_12_22_211332_add_admin_user',11);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values 
(4,'App\\User',9),
(4,'App\\User',32),
(5,'App\\User',10),
(5,'App\\User',11),
(5,'App\\User',12),
(5,'App\\User',13),
(5,'App\\User',14),
(5,'App\\User',15),
(5,'App\\User',16),
(5,'App\\User',17),
(5,'App\\User',18),
(5,'App\\User',19),
(5,'App\\User',20),
(5,'App\\User',21),
(5,'App\\User',22),
(5,'App\\User',23),
(5,'App\\User',24),
(5,'App\\User',25),
(5,'App\\User',26),
(5,'App\\User',27),
(5,'App\\User',28),
(5,'App\\User',29);

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_access_tokens` */

insert  into `oauth_access_tokens`(`id`,`user_id`,`client_id`,`name`,`scopes`,`revoked`,`created_at`,`updated_at`,`expires_at`) values 
('0c17d0e5bde643d7737b47c20c4f46c52fdc9ecaec6d4006c2b21f6d03f8c6866dbbf32710215eab',20,1,'Personal Access Token','[]',0,'2020-12-22 17:17:47','2020-12-22 17:17:47','2021-06-22 17:17:47'),
('1161f0a73ca5d269de0c769028cb2f723e97b1b51b04d7762c4ce129e6fea653e711f61df444721f',20,1,'Personal Access Token','[]',0,'2020-12-22 17:13:19','2020-12-22 17:13:19','2021-06-22 17:13:19'),
('19102d3796dc1fbbc5cdb122d0167021548b6318dd21f4435e46f5609b18128abb507196ee397083',20,1,'Personal Access Token','[]',0,'2020-12-22 17:35:48','2020-12-22 17:35:48','2021-06-22 17:35:48'),
('30df5c30d97f85ad637717f5c20ba38deecf443c13e2bae69bf4f126addc5d0c11a250416b3509c2',26,1,'Personal Access Token','[]',0,'2020-12-22 18:27:33','2020-12-22 18:27:33','2021-01-05 18:27:33'),
('38689b43388da09dfb13fb531209977e15a52c7714f9858dd66c8d8281db1ab20e72b0d610d498aa',20,1,'Personal Access Token','[]',0,'2020-12-22 17:25:50','2020-12-22 17:25:50','2021-06-22 17:25:49'),
('39420f3290f626c52dbc3f8c6ad485a74a6ac46d9185459947466a442d476917585cc5c0ed21b832',15,1,'Personal Access Token','[]',0,'2020-12-22 16:55:01','2020-12-22 16:55:01','2021-06-22 16:55:01'),
('40da528c40c22f7fe62dc9e0668df546c72eedd358f1dfd8b6fdf7eb305e79db1bd1f294c16f80be',4,1,'Personal Access Token','[]',0,'2020-12-20 22:24:21','2020-12-20 22:24:21','2021-06-20 22:24:21'),
('43d9cb19df471668192a6e4c889702cc01072091e732824cb444c0442cd919a481e6d90d75eedd94',27,1,'Personal Access Token','[]',0,'2020-12-22 20:58:44','2020-12-22 20:58:44','2021-06-22 20:58:43'),
('44ed7faf24a7c32fbe777e3dc8a0debf98abbda383222044307fab0859e72aee895d586df8c6443c',20,1,'Personal Access Token','[]',0,'2020-12-22 17:32:17','2020-12-22 17:32:17','2021-06-22 17:32:17'),
('524026e6e2e23753740d178bdb4bf1f2a100e1a2f4014e04c9e14eb26dd7a9299871fda648f1fbbb',20,1,'Personal Access Token','[]',0,'2020-12-22 18:35:21','2020-12-22 18:35:21','2021-06-22 18:35:21'),
('56d75c07bbb82a72cf4fcd745649ce3863016e9fb7ae6e7bc0cb761f4a00360e94a10dea474ac519',4,1,'Personal Access Token','[]',0,'2020-12-20 22:34:33','2020-12-20 22:34:33','2021-06-20 22:34:33'),
('5da8808d371457e65732a8c5ae3da84bb41c23a4ec138f0e04bb9ea0fe8769f4e9b3ad20ebfbc702',20,1,'Personal Access Token','[]',0,'2020-12-22 18:06:35','2020-12-22 18:06:35','2021-06-22 18:06:35'),
('63dd7c18cf2eb66549a7dd33e28076933b00825a7485e4a968624229a2d4b9f48403995af20e5450',1,1,'Personal Access Token','[]',0,'2020-12-20 19:37:25','2020-12-20 19:37:25','2021-06-20 19:37:24'),
('69b1aab5120048fe9b8e7ad5308d1c3690a33e79eb729cfa61498880ca2ca28f10a02b64cf9ab284',20,1,'Personal Access Token','[]',0,'2020-12-22 17:26:00','2020-12-22 17:26:00','2021-06-22 17:26:00'),
('6c7e1e7074eb135a927fd72083f6a4e317cc2e08d677225831b79e1ae53b1d4df70d6580245e1b0b',20,1,'Personal Access Token','[]',0,'2020-12-22 17:17:37','2020-12-22 17:17:37','2021-06-22 17:17:36'),
('78bff5f5ef5d81ff771575e9bdb93d61fc2f903c247e4763d829c03cee4185302ba5abab1d83f8e7',20,1,'Personal Access Token','[]',0,'2020-12-22 18:27:53','2020-12-22 18:27:53','2021-06-22 18:27:53'),
('793744bafe53a7914fb1239c6ebfcacf748e1c675e635a4a429310a77f835e38fa14ba4854d0bb1c',4,1,'Personal Access Token','[]',0,'2020-12-20 19:57:22','2020-12-20 19:57:22','2021-06-20 19:57:22'),
('8423fcc34bc4cbda5ccf052f164c761a1085d1fc2417efeb5b24223dab9a4ea40bf0fe692550c719',27,1,'Personal Access Token','[]',0,'2020-12-22 21:02:49','2020-12-22 21:02:49','2021-06-22 21:02:49'),
('8e67b7d1c549e54a9b44903bde3044f76cf1e0d8639dbce2b58a0e4599ec7716ef069762f7513522',20,1,'Personal Access Token','[]',0,'2020-12-22 17:32:55','2020-12-22 17:32:55','2021-06-22 17:32:55'),
('abf649dae4268bcb3150421db6290c2d938549d40220fa821ee1305e762cd87afd055d7b44e44b95',24,1,'Personal Access Token','[]',0,'2020-12-22 17:58:53','2020-12-22 17:58:53','2021-01-05 17:58:53'),
('aeb5e42c9a44dc5971bdfbbdaa9f465b01f29bb3e50f8184291c45afde9a8246df29f048c87449c7',20,1,'Personal Access Token','[]',0,'2020-12-22 18:27:08','2020-12-22 18:27:08','2021-06-22 18:27:08'),
('c049a527dd0c9f6bfe486066ee51513c73ea80894e8695a96f0890d6a7546538b11d8ae8efb91c52',32,1,'Personal Access Token','[]',0,'2020-12-22 21:20:27','2020-12-22 21:20:27','2021-06-22 21:20:27'),
('c7991cfce8fcd2040980edfe76c0b702e1275a3015eb1409947d124e66980f0422f563e5a4653471',28,1,'Personal Access Token','[]',0,'2020-12-22 21:12:39','2020-12-22 21:12:39','2021-06-22 21:12:39'),
('d3cddd89a3c481f60c37043072e72bc3f212415acbdb104f6ee150e4013dda5d9effc80904ed7455',25,1,'Personal Access Token','[]',0,'2020-12-22 18:08:54','2020-12-22 18:08:54','2021-01-05 18:08:54'),
('dd2969eb2bd60464bdef5fc997437b06c8dfcb253e064b3115da97ee4b5e936e2985482232e3aa92',20,1,'Personal Access Token','[]',0,'2020-12-22 17:18:59','2020-12-22 17:18:59','2021-06-22 17:18:59'),
('f963f3dbb856e8dffb13c18d91527909af732bb8ae447c4a7b53ab598633668a9d1e7690f2f34ed7',20,1,'Personal Access Token','[]',0,'2020-12-22 17:33:04','2020-12-22 17:33:04','2021-06-22 17:33:03');

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_clients` */

insert  into `oauth_clients`(`id`,`user_id`,`name`,`secret`,`provider`,`redirect`,`personal_access_client`,`password_client`,`revoked`,`created_at`,`updated_at`) values 
(1,NULL,'Desafio Pixarron Personal Access Client','hO9GQ35M9JwuaTCwCOEgjhLwOXThVaFa8r9t6nY6',NULL,'http://localhost',1,0,0,'2020-12-20 12:51:14','2020-12-20 12:51:14'),
(2,NULL,'Desafio Pixarron Password Grant Client','cZ7YhbGexdB8YRBEdu7rAaC6uKd7PGGL2uBdLBc0','users','http://localhost',0,1,0,'2020-12-20 12:51:14','2020-12-20 12:51:14');

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

insert  into `oauth_personal_access_clients`(`id`,`client_id`,`created_at`,`updated_at`) values 
(1,1,'2020-12-20 12:51:14','2020-12-20 12:51:14');

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `order_has_items` */

DROP TABLE IF EXISTS `order_has_items`;

CREATE TABLE `order_has_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `item_id` bigint(20) unsigned NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `order_has_items_order_id_foreign` (`order_id`),
  KEY `order_has_items_item_id_foreign` (`item_id`),
  CONSTRAINT `order_has_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `order_has_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_has_items` */

insert  into `order_has_items`(`id`,`created_at`,`updated_at`,`order_id`,`item_id`,`price`,`qty`) values 
(9,'2020-12-22 21:04:10','2020-12-22 21:04:10',7,1,9.99,1),
(10,'2020-12-22 21:09:42','2020-12-22 21:09:42',8,2,10.99,1),
(11,'2020-12-22 21:09:42','2020-12-22 21:09:42',8,3,9.99,1),
(12,'2020-12-22 21:11:07','2020-12-22 21:11:07',9,5,7.99,1),
(13,'2020-12-22 21:11:07','2020-12-22 21:11:07',9,6,9.99,1),
(14,'2020-12-22 21:12:55','2020-12-22 21:12:55',10,22,11.99,1),
(15,'2020-12-22 21:12:55','2020-12-22 21:12:55',10,22,11.99,1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `order_price` double(8,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `orders_address_id_foreign` (`address_id`),
  KEY `orders_client_id_foreign` (`client_id`),
  CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`),
  CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`uuid`,`created_at`,`updated_at`,`address_id`,`client_id`,`order_price`,`payment_method`,`payment_status`,`comment`,`active`) values 
(7,'50f095bf-789d-4e7f-b202-2d6344e4f3b7','2020-12-22 21:04:10','2020-12-22 21:04:10',20,27,9.99,'Contra Entrega','registrado','',1),
(8,'7682bfc9-d6f5-4c4f-ab97-827994e9f2bb','2020-12-22 21:09:42','2020-12-22 21:09:42',20,27,20.98,'Contra Entrega','registrado','',1),
(9,'5fdee006-09d1-4d34-9230-af4bff83156a','2020-12-22 21:11:07','2020-12-22 21:11:07',20,27,17.98,'Contra Entrega','registrado','',1),
(10,'ad1dc5b9-9cc0-4a94-a2bd-3a3d1074b343','2020-12-22 21:12:55','2020-12-22 21:12:55',23,28,23.98,'Contra Entrega','registrado','',1);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(4,'admin','web','2020-12-20 23:27:04','2020-12-20 23:27:04'),
(5,'client','web','2020-12-20 23:27:04','2020-12-20 23:27:04');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`uuid`,`name`,`email`,`email_verified_at`,`password`,`active`,`remember_token`,`created_at`,`updated_at`) values 
(27,'1ec81c24-9666-4396-87e8-e49c31e6187b','Marco Estrada','info@devmarcoestrada.com',NULL,'$2y$10$CZ.DWLTkvPxd3rltRKu22.wFzvGC5HOpSnn/I.kh7tFNQ/4Hw.u46',1,NULL,'2020-12-22 20:58:17','2020-12-22 20:58:17'),
(28,'ac8eb79d-cf9a-4b2a-9d6e-f003e71c3471','Elizabeth Zavaleta','ezvaletal14@devmarcoestrada.com',NULL,'$2y$10$ee7RzYIcUmVK1GXe4kwZ3.iW9OirlBRW6RMOUDmjxf7/nxIovReYK',1,NULL,'2020-12-22 20:58:17','2020-12-22 20:58:17'),
(29,'d2977030-c5f3-4c38-9fd5-4bb7334b06a9','Demo Client','Demo Client@devmarcoestrada.com',NULL,'$2y$10$O9pJ.qRQyKM7Ayf6ow7XNeZ1Tk6EnEgW7jhrv6AEIbSI16Gbxpos.',1,NULL,'2020-12-22 20:58:17','2020-12-22 20:58:17'),
(32,'ae68d8c4-b977-487d-9c2f-dc7abf7bef6f','Marco Administrador','admin@devmarcoestrada.com',NULL,'$2y$10$UmYpHasKRduCWnv4l8Dqz.W933ORtPrfMn1iScBGew2ELAcPb.nsC',1,NULL,'2020-12-22 21:20:01','2020-12-22 21:20:01');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
