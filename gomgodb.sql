-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2015 at 10:18 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gomgodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aid_budget`
--

CREATE TABLE IF NOT EXISTS `aid_budget` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `year` year(4) NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aid_exchange`
--

CREATE TABLE IF NOT EXISTS `aid_exchange` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `request` int(11) NOT NULL,
  `financial_user` int(10) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL,
  `exchange_way` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `request` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exchange_way`
--

CREATE TABLE IF NOT EXISTS `exchange_way` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exchange_way`
--

INSERT INTO `exchange_way` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ايداع في الحساب البنكي', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'شيك', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'نقدا', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `first_check`
--

CREATE TABLE IF NOT EXISTS `first_check` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `request` int(10) unsigned NOT NULL,
  `checker` int(10) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `aid_amount` double(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_check`
--

CREATE TABLE IF NOT EXISTS `last_check` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `request` int(10) unsigned NOT NULL,
  `checker` int(10) unsigned NOT NULL,
  `not` text COLLATE utf8_unicode_ci,
  `aide_amount` double(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

CREATE TABLE IF NOT EXISTS `marital_status` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id`, `created_at`, `updated_at`, `title`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'اعزب'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'متزوج'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'مطلق'),
(4, '0000-00-00 00:00:00', '2015-09-13 21:27:36', 'ارمل');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2015_08_26_024912_create_aid_budget_table', 1),
('2015_08_26_024912_create_aid_exchange_table', 1),
('2015_08_26_024912_create_document_table', 1),
('2015_08_26_024912_create_exchange_way_table', 1),
('2015_08_26_024912_create_first_check_table', 1),
('2015_08_26_024912_create_last_check_table', 1),
('2015_08_26_024912_create_marital_status_table', 1),
('2015_08_26_024912_create_muscat_state_table', 1),
('2015_08_26_024912_create_request_reasone_table', 1),
('2015_08_26_024912_create_request_status_table', 1),
('2015_08_26_024912_create_request_table', 1),
('2015_08_26_024912_create_role_table', 1),
('2015_08_26_024912_create_saved_request_table', 1),
('2015_08_26_024912_create_system_page_table', 1),
('2015_08_26_024912_create_user_page_auth_table', 1),
('2015_08_26_024912_create_user_table', 1),
('2015_08_26_024922_create_foreign_keys', 1),
('2015_09_20_171657_create_request_operation_auth_table', 2),
('2015_09_20_171657_create_request_operation_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `muscat_state`
--

CREATE TABLE IF NOT EXISTS `muscat_state` (
  `id` int(10) unsigned NOT NULL,
  `state_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `muscat_state`
--

INSERT INTO `muscat_state` (`id`, `state_name`, `created_at`, `updated_at`) VALUES
(1, 'مسقط', '0000-00-00 00:00:00', '2015-09-13 21:17:04'),
(2, 'مطرح', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'بوشر', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'السيب', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'قريات', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'العامرات', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(10) unsigned NOT NULL,
  `requester_first_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `requester_middle_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `requester_last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requester_sair_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requester_bod` date NOT NULL,
  `requester_civil_id` int(11) NOT NULL,
  `requester_bank_acount_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requester_gender` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'M',
  `requester_marital_status` int(10) unsigned NOT NULL,
  `address_state` int(10) unsigned NOT NULL,
  `requester_address_district` varchar(85) COLLATE utf8_unicode_ci NOT NULL,
  `requester_phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `reasone` int(10) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `creator` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_operation`
--

CREATE TABLE IF NOT EXISTS `request_operation` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_operation_auth`
--

CREATE TABLE IF NOT EXISTS `request_operation_auth` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` int(10) unsigned NOT NULL,
  `operation` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_reasone`
--

CREATE TABLE IF NOT EXISTS `request_reasone` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request_reasone`
--

INSERT INTO `request_reasone` (`id`, `created_at`, `updated_at`, `type`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'تعليمي'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'صحي'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'قروض'),
(4, '0000-00-00 00:00:00', '2015-09-13 21:28:10', 'اسكاني');

-- --------------------------------------------------------

--
-- Table structure for table `request_status`
--

CREATE TABLE IF NOT EXISTS `request_status` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request_status`
--

INSERT INTO `request_status` (`id`, `created_at`, `updated_at`, `title`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'انتظار المراجعة'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'الحفظ'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'انتظار الموافقة'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'انتظار الصرف'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'تم الصرف');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `created_at`, `updated_at`, `type`, `note`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'مدير الموقع', ''),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'مدخل بيانات', ''),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'مدير قسم المساعدات المالية', ''),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'المحافظ', ''),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'قسم  المالية', '');

-- --------------------------------------------------------

--
-- Table structure for table `saved_request`
--

CREATE TABLE IF NOT EXISTS `saved_request` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `request` int(10) unsigned NOT NULL,
  `saved_by` int(10) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `last_status` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_page`
--

CREATE TABLE IF NOT EXISTS `system_page` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `path` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system_page`
--

INSERT INTO `system_page` (`id`, `created_at`, `updated_at`, `path`, `title`, `note`) VALUES
(1, '0000-00-00 00:00:00', '2015-09-10 10:39:44', 'financial-aids-system/statistics', 'الصفحة الرئيسية لنظام المساعدات المالية', 'الصفحة الرئيسية لنظام المساعدات المالية'),
(2, '0000-00-00 00:00:00', '2015-09-13 16:22:39', 'financial-aids-system/new-request', 'صفحة إنشاء طلب مساعدة جديد', 'صفحة إنشاء طلب مساعدة جديد حيث يتم من هذه الصفحة ادخال المعلومات الاساسية لصاحب الطلب وطبيعة الطلب ثم اسباب الطب مع ارفاق المستندات المطلوبة '),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'financial-aids-system/new-requests-list', 'قائمة الطلبات الجديدة', 'قائمة الطلبات الجديدة'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'financial-aids-system/checked-requests-list', 'قائمة الطلبات في انتظار الموافقة', 'في هذه الصفحة يتم استعراض الطلبات التي تم مراجعتها وينتظر الموافقة عليها من قبل المحافظ'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'financial-aids-system/approved-requests-list', 'قائمة الطلبات الموافق عليها', 'خلال هذه الصفحة يتم استعراض الطلبات التي تمت الموافقة عليها سواء تم صرفها أو لم يتم'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'financial-aids-system/saved-requests-list', 'قائمة الطلبات المحفوظة', 'في هذه الصفحة يتم استعراض الطلبات التي تمت إحالتها للحفظ '),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'financial-aids-system/waiting-exchange-requests-list', 'قائمة الطلبات في انتظار الصرف', 'الطلبات التي تمت الموافقة عليها ولازلت في انتظار صرفها'),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'financial-aids-system/exchange-requests-list', 'قائمة الطلبات المصروفة', 'قائمة الطلبات الموفق عليها والتي تم صرفها فعليا'),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'financial-aids-system/requests-info', 'صفحة معلومات الطلب', 'في هذه الصفحة يتم استعراض المعلومات الكاملة للطلب كالمعلومات الاساسية للطلب و المستندات المرفقة وتفاصيل الموافقة والحفظ والصرف وغيرها'),
(11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'financial-aids-system/exchange-requestso', 'صفحة صرف المساعدة المالية', 'من خلال هذه الصفحة يتم تسجيل بيانات صرف المساعدة المالية, قيمة المبلغ المصروف وطريقة الصرف'),
(12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'system-control/users', 'صفحة اعدادت المستخدمين', 'من خلال هذه الصفحة يمكن انشاء مستخدمين جدد لإستخدام النظام كما يتم فيه استعراض المستخدمين الحالين مع امكانية استعراض بيانات المستخدمين كلا على حدة لتعديل البيانات الاساسية للمستخدم وتعديل صلاحيات الوصول'),
(13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'system-control/user-info', 'صفحة معلومات المستخدم', 'من خلال هذه الصفحة يتم عرض معلومات المستخدم كما يتاح صلاحية تعديلها مع امكانية تعديل صلاحيات وصول المستخدم لصفحات النظام'),
(14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'user/profile', 'صفحة المستخدم الشخصية', 'من خلال هذه الصفحة يستطيع المستخدم استعراض بياناته الاساسية كما يستطيع تعديلها'),
(15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'user/profile/requests-list', 'قائمة الطلبات التي تعامل معها المستخدم/المستخدم', 'من خلال هذه الصفحة يتم استعراض الطلبات التي قام المستخدم بالتعامل معها '),
(16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'system-control/user-info/requests-list', 'قائمة الطلبات التي تعامل معها المستخدم/الإدارة', 'من خلال هذه القائمة يستطيع الاداري التعرف على طلبات المساعدة التي قام الممستخدم بالتعامل معها'),
(17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'system-control/budget', 'صفحة اعدادات ميزانية المساعدات', 'خلال هذه الصفحة يتم استعراض الميزانيات المخصصة للمساعدات على اساس سنوي وتوضح القائمة المبالغ المصروفة ومبالغ المساعدات في انتظار الصرف كما تتيح هذه الصحفة انشاء الميزانيات السنوية');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `first_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sair_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `created_at`, `updated_at`, `first_name`, `middle_name`, `last_name`, `sair_name`, `password`, `email`, `role`, `remember_token`) VALUES
(1, '2015-08-25 23:02:53', '2015-09-20 17:49:02', 'غيث', 'حمود', 'علي', 'الرواحي', '$2y$10$GjLKHe2sViQqOrZ0F2600egy9n4abZKBdj0Ko/U/ceB1ifuYcp4K.', 'root@gomgo.com', 1, 'Q9u8R73CCMO9GgOsRexdne3j57MBzyzwAzphMvsRZEda6B5aKHW5R2B1RaV4');

-- --------------------------------------------------------

--
-- Table structure for table `user_page_auth`
--

CREATE TABLE IF NOT EXISTS `user_page_auth` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `page` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=763 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_page_auth`
--

INSERT INTO `user_page_auth` (`id`, `created_at`, `updated_at`, `page`, `user`) VALUES
(747, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 1, 1),
(748, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 2, 1),
(749, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 3, 1),
(750, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 4, 1),
(751, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 5, 1),
(752, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 6, 1),
(753, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 8, 1),
(754, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 9, 1),
(755, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 10, 1),
(756, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 11, 1),
(757, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 12, 1),
(758, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 13, 1),
(759, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 14, 1),
(760, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 15, 1),
(761, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 16, 1),
(762, '2015-09-20 14:21:05', '2015-09-20 14:21:05', 17, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aid_budget`
--
ALTER TABLE `aid_budget`
  ADD PRIMARY KEY (`id`), ADD KEY `aid_budget_creator_foreign` (`creator`);

--
-- Indexes for table `aid_exchange`
--
ALTER TABLE `aid_exchange`
  ADD PRIMARY KEY (`id`), ADD KEY `aid_exchange_financial_user_foreign` (`financial_user`), ADD KEY `aid_exchange_exchange_way_foreign` (`exchange_way`), ADD KEY `request` (`request`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `document_name_unique` (`name`), ADD KEY `document_request_foreign` (`request`);

--
-- Indexes for table `exchange_way`
--
ALTER TABLE `exchange_way`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `exchange_way_name_unique` (`name`);

--
-- Indexes for table `first_check`
--
ALTER TABLE `first_check`
  ADD PRIMARY KEY (`id`), ADD KEY `first_check_request_foreign` (`request`), ADD KEY `first_check_checker_foreign` (`checker`);

--
-- Indexes for table `last_check`
--
ALTER TABLE `last_check`
  ADD PRIMARY KEY (`id`), ADD KEY `last_check_request_foreign` (`request`), ADD KEY `last_check_checker_foreign` (`checker`);

--
-- Indexes for table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `marital_status_title_unique` (`title`);

--
-- Indexes for table `muscat_state`
--
ALTER TABLE `muscat_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`), ADD KEY `request_requester_marital_status_foreign` (`requester_marital_status`), ADD KEY `request_address_state_foreign` (`address_state`), ADD KEY `request_creator_foreign` (`creator`), ADD KEY `request_status_foreign` (`status`), ADD KEY `request_reasone_foreign` (`reasone`);

--
-- Indexes for table `request_operation`
--
ALTER TABLE `request_operation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_operation_auth`
--
ALTER TABLE `request_operation_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_reasone`
--
ALTER TABLE `request_reasone`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `request_reasone_type_unique` (`type`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_request`
--
ALTER TABLE `saved_request`
  ADD PRIMARY KEY (`id`), ADD KEY `saved_request_request_foreign` (`request`), ADD KEY `saved_request_saved_by_foreign` (`saved_by`);

--
-- Indexes for table `system_page`
--
ALTER TABLE `system_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_email_unique` (`email`), ADD KEY `user_role_foreign` (`role`);

--
-- Indexes for table `user_page_auth`
--
ALTER TABLE `user_page_auth`
  ADD PRIMARY KEY (`id`), ADD KEY `user_page_auth_page_foreign` (`page`), ADD KEY `user_page_auth_user_foreign` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aid_budget`
--
ALTER TABLE `aid_budget`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `aid_exchange`
--
ALTER TABLE `aid_exchange`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `exchange_way`
--
ALTER TABLE `exchange_way`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `first_check`
--
ALTER TABLE `first_check`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `last_check`
--
ALTER TABLE `last_check`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `muscat_state`
--
ALTER TABLE `muscat_state`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `request_operation`
--
ALTER TABLE `request_operation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request_operation_auth`
--
ALTER TABLE `request_operation_auth`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request_reasone`
--
ALTER TABLE `request_reasone`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `request_status`
--
ALTER TABLE `request_status`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `saved_request`
--
ALTER TABLE `saved_request`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `system_page`
--
ALTER TABLE `system_page`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_page_auth`
--
ALTER TABLE `user_page_auth`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=763;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aid_budget`
--
ALTER TABLE `aid_budget`
ADD CONSTRAINT `aid_budget_creator_foreign` FOREIGN KEY (`creator`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `aid_exchange`
--
ALTER TABLE `aid_exchange`
ADD CONSTRAINT `aid_exchange_exchange_way_foreign` FOREIGN KEY (`exchange_way`) REFERENCES `exchange_way` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `aid_exchange_financial_user_foreign` FOREIGN KEY (`financial_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
ADD CONSTRAINT `document_request_foreign` FOREIGN KEY (`request`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `first_check`
--
ALTER TABLE `first_check`
ADD CONSTRAINT `first_check_checker_foreign` FOREIGN KEY (`checker`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `first_check_request_foreign` FOREIGN KEY (`request`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `last_check`
--
ALTER TABLE `last_check`
ADD CONSTRAINT `last_check_checker_foreign` FOREIGN KEY (`checker`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `last_check_request_foreign` FOREIGN KEY (`request`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
ADD CONSTRAINT `request_address_state_foreign` FOREIGN KEY (`address_state`) REFERENCES `muscat_state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `request_creator_foreign` FOREIGN KEY (`creator`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `request_reasone_foreign` FOREIGN KEY (`reasone`) REFERENCES `request_reasone` (`id`),
ADD CONSTRAINT `request_requester_marital_status_foreign` FOREIGN KEY (`requester_marital_status`) REFERENCES `marital_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `request_status_foreign` FOREIGN KEY (`status`) REFERENCES `request_status` (`id`);

--
-- Constraints for table `saved_request`
--
ALTER TABLE `saved_request`
ADD CONSTRAINT `saved_request_request_foreign` FOREIGN KEY (`request`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `saved_request_saved_by_foreign` FOREIGN KEY (`saved_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_role_foreign` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_page_auth`
--
ALTER TABLE `user_page_auth`
ADD CONSTRAINT `user_page_auth_page_foreign` FOREIGN KEY (`page`) REFERENCES `system_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_page_auth_user_foreign` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
