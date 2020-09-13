-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(5,	'2020_08_26_184434_create_movies_table',	2),
(6,	'2020_09_03_201408_create_roles_table',	3),
(7,	'2020_09_03_201410_create_permissions_table',	3),
(8,	'2020_09_03_201411_create_permission_role_table',	3);

DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overview` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `movies` (`id`, `title`, `category`, `overview`, `release_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Test Movie Lorem Ipsum',	'Drama, Crime',	'Lorem Ipsum',	'2020-01-01',	'2020-08-26 19:21:14',	'2020-09-12 03:39:02',	NULL),
(2,	'The Godfather',	'Crime, Test',	'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',	'1972-08-03',	'2020-08-26 13:01:52',	'2020-09-12 03:38:59',	'2020-09-12 03:38:59'),
(7,	'The Dark Knight',	'Action',	'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',	'2018-07-18',	'2020-08-26 13:04:27',	'2020-09-10 08:11:22',	NULL),
(9,	'Angry Men',	'Crime',	'A jury holdout attempts to prevent a miscarriage of justice by forcing his colleagues to reconsider the evidence.',	'1957-04-10',	'2020-08-26 13:57:02',	'2020-09-10 08:11:23',	NULL),
(10,	'The Lord of the Rings: The Return of the King',	'Adventure',	'Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.',	'2003-12-17',	'2020-08-26 20:38:48',	'2020-09-10 08:11:24',	NULL),
(11,	'Joker',	'Thriller',	'In Gotham City, mentally troubled comedian Arthur Fleck is disregarded and mistreated by society. He then embarks on a downward spiral of revolution and bloody crime. This path brings him face-to-face with his alter-ego: the Joker.',	'2019-10-04',	'2020-08-26 21:18:31',	'2020-09-10 08:11:26',	NULL),
(12,	'Inception',	'Sci-Fi',	'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',	'2010-07-16',	'2020-08-26 21:19:20',	'2020-09-10 08:11:28',	NULL),
(13,	'The Matrix',	'Sci-Fi',	'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',	'1999-03-31',	'2020-08-26 21:20:13',	'2020-09-10 10:27:03',	'2020-09-10 10:27:03'),
(14,	'Saving Private Ryan',	'War',	'Following the Normandy Landings, a group of U.S. soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed in action.',	'1998-07-24',	'2020-08-26 21:21:57',	'2020-09-10 10:27:14',	NULL),
(15,	'Spirited Away',	'Animation',	'During her family\'s move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches, and spirits, and where humans are changed into beasts.',	'2003-03-23',	'2020-08-26 21:22:31',	'2020-09-10 10:27:13',	NULL),
(16,	'Interstellar',	'Sci-Fi',	'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',	'2014-11-07',	'2020-08-26 21:23:13',	'2020-09-10 08:11:10',	'2020-09-10 08:11:10'),
(17,	'Test Movie',	'Adventure',	'Lorem Ipsum',	'2020-01-02',	'2020-08-26 19:21:14',	'2020-09-10 08:04:47',	'2020-09-10 08:04:47'),
(18,	'Test Movie Lalala',	'Drama',	'Lorem Ipsum',	'2020-01-01',	'2020-08-26 21:43:31',	'2020-09-06 11:41:46',	'2020-09-06 11:41:46'),
(19,	'The Dark Joker',	'Drama',	'Lorem ipsum',	'2020-12-31',	'2020-09-06 11:32:50',	'2020-09-10 10:27:11',	NULL);

DROP TABLE IF EXISTS `navigations`;
CREATE TABLE `navigations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) CHARACTER SET utf8 NOT NULL,
  `type` int(1) NOT NULL DEFAULT 1,
  `sort` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT 2,
  `icon` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `data` text CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `id_name_route_slug_type_sort_order_status` (`id`,`name`,`route`,`type`,`sort`,`status`),
  CONSTRAINT `navigations_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `navigations` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `navigations` (`id`, `name`, `parent`, `route`, `type`, `sort`, `status`, `icon`, `data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Setting',	NULL,	'/parent/setting',	1,	3,	1,	'fa fa-cog',	NULL,	NULL,	NULL,	NULL),
(2,	'Role',	1,	'/role/index',	1,	3,	1,	'fa  fa-users',	NULL,	NULL,	NULL,	NULL),
(3,	'Permission',	1,	'/permission/index',	1,	1,	1,	'fa fa-retweet',	NULL,	NULL,	NULL,	NULL),
(4,	'User',	1,	'/user/index',	1,	4,	1,	'fa fa-user',	NULL,	NULL,	NULL,	NULL),
(6,	'Navigation',	1,	'/navigation/index',	1,	2,	1,	'fa  fa-bars',	NULL,	NULL,	NULL,	NULL),
(7,	'Dashboard',	NULL,	'/home',	1,	1,	0,	'fa  fa-home',	NULL,	NULL,	'2020-09-12 12:52:08',	NULL),
(8,	'Master Data',	NULL,	'parent/masterdata',	2,	4,	1,	'fa  fa-th',	NULL,	NULL,	NULL,	NULL),
(9,	'Movie',	NULL,	'/movie',	1,	7,	0,	'fa fa-book',	NULL,	NULL,	'2020-09-12 03:39:48',	NULL),
(10,	'Permission List',	3,	'/permission/index',	2,	1,	1,	'fa fa-list',	NULL,	NULL,	NULL,	NULL),
(11,	'Create Permission',	3,	'/permission/create',	2,	2,	0,	'fa  fa-plus',	NULL,	NULL,	NULL,	NULL),
(12,	'Generate',	3,	'/permission/generate',	2,	3,	1,	'fa fa-retweet',	NULL,	NULL,	NULL,	NULL),
(14,	'Role List',	2,	'/role/index',	2,	1,	1,	'fa fa-list',	NULL,	NULL,	NULL,	NULL),
(15,	'Create Role',	2,	'/role/create',	2,	2,	1,	'fa fa-plus',	NULL,	NULL,	NULL,	NULL),
(17,	'Navigation List',	6,	'/navigation/index',	2,	1,	1,	'fa fa-list',	NULL,	NULL,	NULL,	NULL),
(18,	'Create Navigation',	6,	'/navigation/create',	2,	2,	0,	'fa fa-plus',	NULL,	NULL,	NULL,	NULL),
(19,	'Trash',	6,	'/navigation/history',	2,	3,	1,	'fas fa-trash',	NULL,	NULL,	NULL,	NULL),
(20,	'User List',	4,	'/user/index',	2,	1,	0,	'fa fa-list',	NULL,	NULL,	NULL,	NULL),
(21,	'Create User',	4,	'/user/create',	2,	2,	1,	'fa fa-plus',	NULL,	NULL,	NULL,	NULL),
(22,	'Trash',	4,	'/user/history',	2,	3,	1,	'fa fa-trash',	NULL,	NULL,	NULL,	NULL),
(23,	'VIQ Category',	8,	'viqCategory/index',	1,	7,	1,	'fa fa-book',	NULL,	NULL,	NULL,	NULL),
(24,	'Vessel Operation',	8,	'vesselJob/index',	2,	8,	1,	'fa fa-book',	NULL,	NULL,	'2020-09-12 10:59:28',	NULL),
(25,	'Profile',	NULL,	'profile/index',	1,	2,	1,	'fa fa-address-card',	NULL,	NULL,	NULL,	NULL),
(26,	'Flag',	8,	'flag/index',	1,	10,	1,	'fa fa-book',	NULL,	NULL,	NULL,	NULL),
(27,	'Vessel',	NULL,	'vessel/index',	1,	5,	1,	'icon ion-md-boat',	NULL,	NULL,	NULL,	NULL),
(28,	'Class Society',	8,	'classSociety/index',	1,	10,	1,	'fa fa-book',	NULL,	NULL,	NULL,	NULL),
(29,	'DP Class',	8,	'dpClass/index',	1,	11,	1,	'fa fa-book',	NULL,	NULL,	NULL,	NULL),
(30,	'Vessel Variant',	8,	'vesselVariant/index',	1,	9,	1,	'fa fa-book',	NULL,	NULL,	NULL,	NULL),
(31,	'Inspection',	NULL,	'inspection/index',	1,	6,	1,	'fa fa-list-ol',	NULL,	NULL,	NULL,	NULL),
(32,	'Create Movie',	9,	'/movie/create',	2,	2,	0,	'fa fa-book',	NULL,	NULL,	NULL,	NULL),
(33,	'Trash',	9,	'/movie/history',	2,	3,	0,	'fa fa-book',	NULL,	NULL,	NULL,	NULL),
(34,	'Movie List',	9,	'/movie',	2,	1,	0,	'fa fa-book',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `params` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `controller`, `action`, `method`, `params`, `alias`, `type`, `created_at`, `updated_at`) VALUES
(1,	'/home',	'Home',	'index',	'get',	NULL,	NULL,	0,	'2020-09-09 09:20:15',	'2020-09-12 12:34:12'),
(2,	'/home/index',	'Home',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(3,	'/movie',	'Movie',	'index',	'get',	NULL,	NULL,	0,	'2020-09-09 09:20:15',	'2020-09-10 09:22:56'),
(4,	'/movie/index',	'Movie',	'index',	'get',	NULL,	NULL,	0,	'2020-09-09 09:20:15',	'2020-09-10 09:22:46'),
(5,	'/movie/history',	'Movie',	'history',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(6,	'/movie/create',	'Movie',	'create',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(7,	'/movie/store',	'Movie',	'store',	'post',	'',	'create-movie',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(8,	'/movie/show',	'Movie',	'show',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(9,	'/movie/edit',	'Movie',	'edit',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(10,	'/movie/update',	'Movie',	'update',	'put',	'{id}',	'edit-movie',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(11,	'/movie/destroy',	'Movie',	'destroy',	'delete',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(12,	'/movie/recover',	'Movie',	'recover',	'patch',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(13,	'/navigation',	'Navigation',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(14,	'/navigation/index',	'Navigation',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(15,	'/navigation/history',	'Navigation',	'history',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(16,	'/navigation/create',	'Navigation',	'create',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(17,	'/navigation/store',	'Navigation',	'store',	'post',	'',	'create-navigation',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(18,	'/navigation/show',	'Navigation',	'show',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(19,	'/navigation/edit',	'Navigation',	'edit',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(20,	'/navigation/update',	'Navigation',	'update',	'put',	'{id}',	'edit-navigation',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(21,	'/navigation/destroy',	'Navigation',	'destroy',	'delete',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(22,	'/navigation/recover',	'Navigation',	'recover',	'patch',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(23,	'/permission',	'Permission',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(24,	'/permission/generate',	'Permission',	'generate',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(25,	'/permission/index',	'Permission',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(26,	'/permission/create',	'Permission',	'create',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(27,	'/permission/store',	'Permission',	'store',	'post',	'',	'create-permission',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(28,	'/permission/show',	'Permission',	'show',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(29,	'/permission/edit',	'Permission',	'edit',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(30,	'/permission/update',	'Permission',	'update',	'put',	'{id}',	'edit-permission',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(31,	'/permission/destroy',	'Permission',	'destroy',	'delete',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(32,	'/role',	'Role',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(33,	'/role/index',	'Role',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(34,	'/role/create',	'Role',	'create',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(35,	'/role/store',	'Role',	'store',	'post',	'',	'create-role',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(36,	'/role/show',	'Role',	'show',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(37,	'/role/edit',	'Role',	'edit',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(38,	'/role/update',	'Role',	'update',	'put',	'{id}',	'edit-role',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(39,	'/role/destroy',	'Role',	'destroy',	'delete',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(40,	'/user',	'User',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(41,	'/user/index',	'User',	'index',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(42,	'/user/history',	'User',	'history',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(43,	'/user/create',	'User',	'create',	'get',	'',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(44,	'/user/store',	'User',	'store',	'post',	'',	'create-user',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(45,	'/user/show',	'User',	'show',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(46,	'/user/edit',	'User',	'edit',	'get',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(47,	'/user/update',	'User',	'update',	'put',	'{id}',	'edit-user',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(48,	'/user/destroy',	'User',	'destroy',	'delete',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(49,	'/user/recover',	'User',	'recover',	'patch',	'{id}',	'',	0,	'2020-09-09 09:20:15',	'2020-09-09 09:20:15'),
(50,	'/parent/setting',	'',	'',	'',	'',	'',	1,	NULL,	NULL),
(57,	'/role/permission',	'Role',	'permission',	'patch',	'{id}',	NULL,	0,	'2020-09-10 11:03:45',	'2020-09-10 11:04:13'),
(58,	'/navigation/routes',	'Navigation',	'routes',	'get',	NULL,	NULL,	0,	'2020-09-12 09:52:41',	'2020-09-12 11:23:52'),
(59,	'/navigation/parents',	'Navigation',	'parents',	'get',	'',	'',	0,	'2020-09-12 10:38:52',	'2020-09-12 10:38:52');

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  KEY `permission_id` (`permission_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `permission_role_ibfk_5` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_ibfk_6` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1,	2),
(1,	3),
(1,	4),
(1,	5),
(1,	6),
(1,	7),
(1,	8),
(1,	9),
(1,	10),
(1,	11),
(1,	12),
(1,	13),
(1,	14),
(1,	15),
(1,	16),
(1,	17),
(1,	18),
(1,	19),
(1,	20),
(1,	21),
(1,	22),
(1,	23),
(1,	24),
(1,	25),
(1,	26),
(1,	27),
(1,	28),
(1,	29),
(1,	30),
(1,	31),
(1,	32),
(1,	33),
(1,	34),
(1,	35),
(1,	36),
(1,	37),
(1,	38),
(1,	39),
(1,	40),
(1,	41),
(1,	42),
(1,	43),
(1,	44),
(1,	45),
(1,	46),
(1,	47),
(1,	48),
(1,	49),
(1,	50),
(1,	57),
(2,	2),
(1,	1),
(2,	1),
(2,	3),
(2,	4),
(2,	5),
(2,	6),
(2,	8),
(2,	7),
(2,	12),
(2,	11),
(2,	9),
(2,	10),
(1,	58),
(1,	59);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'heathcliff',	'2020-09-06 17:01:03',	NULL),
(2,	'admin',	NULL,	'2020-09-12 12:40:14');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `api_token`, `email_verified_at`, `password`, `remember_token`, `role_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'ROOT',	'root@mail.com',	'NDZkNzE0ZjRhZjMwZjA2ZmU4NzliMjAyMjZhNDRhZTEwYjNiNzE2Mw==',	NULL,	'$2y$10$YfgDTC1UvjgrL3LVBZVLGuS1KLInv4wtCB.4QIWQFzubMdRSelE6m',	'iiNiOaa8hvByC55ZAKjeioo0wYxLSi70jQZCbcC32Yh6c7UcNyO63NtSAc9R',	1,	1,	'2020-08-26 11:25:55',	'2020-09-12 03:33:40',	NULL),
(2,	'Adminer',	'adminer@mail.com',	NULL,	NULL,	'$2y$10$oQgohG4KtbwuMj8QMqDqeumIClaaYxZgbkMbGaYqWib3Kh/mQUAR.',	NULL,	2,	NULL,	'2020-09-12 03:35:34',	'2020-09-13 09:12:20',	NULL);

-- 2020-09-13 16:37:13
