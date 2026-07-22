<?php

/**
 * One-shot: create schema matching apogeeagrotech_backup.sql and import data.
 * Usage: php database/schema_and_seed.php
 */

$mysqlBin = 'C:\\xampp\\mysql\\bin\\mysql.exe';
$dbName = 'apogeeagrotech';
$user = 'root';
$pass = '';
$root = dirname(__DIR__);
$dump = $root . DIRECTORY_SEPARATOR . 'apogeeagrotech_backup.sql';
$schemaFile = $root . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'schema.sql';

$schema = <<<'SQL'
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `admins`;
DROP TABLE IF EXISTS `areas`;
DROP TABLE IF EXISTS `become_a_dealers`;
DROP TABLE IF EXISTS `blogs`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `dealers`;
DROP TABLE IF EXISTS `enquiries`;
DROP TABLE IF EXISTS `farmer_registrations`;
DROP TABLE IF EXISTS `find_a_dealers`;
DROP TABLE IF EXISTS `galleries`;
DROP TABLE IF EXISTS `geo_locations`;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS `header_contents`;
DROP TABLE IF EXISTS `migrations`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `sub_categories`;
DROP TABLE IF EXISTS `subscribes`;
DROP TABLE IF EXISTS `testimonials`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `video_galleries`;

CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `full_description` longtext DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `become_a_dealers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `intersted_in` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `full_description` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `head_content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `show_in_home` varchar(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `head_content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `dealers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `enquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `farmer_registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `leveller_manufacturer` varchar(255) DEFAULT NULL,
  `leveller_model_no` varchar(255) DEFAULT NULL,
  `leveller_purchase_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `card_ganrate_status` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `find_a_dealers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `group_id` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `geo_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `location_code` varchar(255) DEFAULT NULL,
  `location_type` varchar(255) NOT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `geo_locations_parent_id_index` (`parent_id`),
  KEY `geo_locations_location_type_index` (`location_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `header_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `head_content` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `subcategory_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` longtext DEFAULT NULL,
  `features_advantages` longtext DEFAULT NULL,
  `technical_specifications` longtext DEFAULT NULL,
  `product_image` longtext DEFAULT NULL,
  `brochure` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `show_in_home` varchar(255) DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `head_content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `session` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `head_content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `subscribes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `video_galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
SQL;

file_put_contents($schemaFile, $schema);
echo "Wrote schema to {$schemaFile}\n";

$passArg = $pass === '' ? '' : '-p' . $pass;

function runMysql($mysqlBin, $user, $passArg, $dbName, $file)
{
    $cmd = sprintf(
        '"%s" -u %s %s %s < "%s"',
        $mysqlBin,
        escapeshellarg($user),
        $passArg,
        $dbName !== '' ? escapeshellarg($dbName) : '',
        $file
    );
    // Use cmd redirection for Windows
    $cmd = 'cmd /c ' . sprintf(
        '"%s" -u %s %s %s < "%s"',
        $mysqlBin,
        $user,
        $passArg,
        $dbName,
        $file
    );
    echo "Running: import {$file}\n";
    passthru($cmd, $code);
    return $code;
}

$code = runMysql($mysqlBin, $user, $passArg, $dbName, $schemaFile);
if ($code !== 0) {
    fwrite(STDERR, "Schema import failed with code {$code}\n");
    exit($code);
}
echo "Schema imported.\n";

$code = runMysql($mysqlBin, $user, $passArg, $dbName, $dump);
if ($code !== 0) {
    fwrite(STDERR, "Data import failed with code {$code}\n");
    exit($code);
}
echo "Data imported.\n";

// Update admin password to Qwertyuiop
$hash = password_hash('Qwertyuiop', PASSWORD_BCRYPT);
$hashEsc = addslashes($hash);
$updateSql = "UPDATE admins SET email='admin@gmail.com', username='admin@gmail.com', password='{$hashEsc}', name='Admin' WHERE id=1;";
$tmp = $root . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . '_update_admin.sql';
file_put_contents($tmp, $updateSql);
$code = runMysql($mysqlBin, $user, $passArg, $dbName, $tmp);
@unlink($tmp);
if ($code !== 0) {
    fwrite(STDERR, "Admin update failed with code {$code}\n");
    exit($code);
}

echo "Admin updated: admin@gmail.com / Qwertyuiop\n";

// Verify counts
$verify = 'cmd /c "' . $mysqlBin . '" -u ' . $user . ' ' . $passArg . ' ' . $dbName . ' -e "SELECT \'admins\' t, COUNT(*) c FROM admins UNION ALL SELECT \'blogs\', COUNT(*) FROM blogs UNION ALL SELECT \'products\', COUNT(*) FROM products UNION ALL SELECT \'categories\', COUNT(*) FROM categories;"';
passthru($verify);
echo "Done.\n";
