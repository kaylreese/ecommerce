/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : ecomerce_laravel10

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 25/02/2024 11:24:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `deleted` int NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brands
-- ----------------------------
INSERT INTO `brands` VALUES (1, 'dadas', 'asd', 'dasdas fasd as', 'das dasdd a', 'd sadafsfgdgh fhfhghfg', 1, 1, '2023-12-17 22:31:10', '2023-12-17 22:31:15', 1);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Deleted',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Health & Wellness', 'health-wellness', 'Health & Wellness', 'Health & Wellness', 'Health & Wellness', 1, '2023-12-17 16:56:46', '2024-01-07 04:41:15', 1);
INSERT INTO `categories` VALUES (2, 'Shopping', 'shopping', 'Shopping', 'shopping', 'shopping, shopping cloth', 1, '2023-12-17 17:37:44', '2024-01-07 04:41:19', 0);
INSERT INTO `categories` VALUES (3, 'Lifestyle', 'lifestyle', 'Lifestyle', 'Lifestyle', 'Lifestyle, Lifestyle Care', 1, '2023-12-17 17:38:19', '2023-12-17 17:42:37', 0);
INSERT INTO `categories` VALUES (4, 'Home & Furnitures', 'home-furnitures', 'Home & Furnitures', 'Home & Furnitures', 'Home, Furnitures', 1, '2023-12-17 17:38:47', '2024-01-06 00:50:32', 1);
INSERT INTO `categories` VALUES (5, 'Fashion', 'fashion', 'Fashion', 'Fashion', 'Fashion, Fashion Day', 1, '2023-12-17 17:42:11', '2023-12-17 17:42:11', 1);
INSERT INTO `categories` VALUES (6, 'Jewelry & Watches', 'jewelry-watches', 'Jewelry & Watches', 'Jewelry & Watches', 'Jewelry, Watches', 1, '2024-01-06 00:34:41', '2024-01-06 00:35:07', 1);
INSERT INTO `categories` VALUES (7, 'Sport & Outdoors', 'sport-outdoors', 'Sport & Outdoors', 'Sport & Outdoors', 'Sport, Outdoors', 1, '2024-01-06 00:35:48', '2024-01-06 00:35:48', 1);
INSERT INTO `categories` VALUES (8, 'Toys & Games', 'toys-games', 'Toys & Games', 'Toys & Games', 'Toys, Games', 1, '2024-01-06 00:36:22', '2024-01-06 00:36:22', 1);
INSERT INTO `categories` VALUES (9, 'Book, Movies & Music', 'book-movies-music', 'Book, Movies & Music', 'Book, Movies & Music', 'Book, Movies & Music', 1, '2024-01-06 00:36:54', '2024-01-06 00:36:54', 1);
INSERT INTO `categories` VALUES (10, 'Beauty & Personal Care', 'beauty-personal-care', 'Beauty & Personal Care', 'Beauty & Personal Care', 'Beauty & Personal Care', 1, '2024-01-06 00:37:43', '2024-01-06 00:37:43', 1);
INSERT INTO `categories` VALUES (11, 'Electronics', 'electronics', 'Electronics', 'Electronics', 'Electronics', 1, '2024-01-06 00:39:44', '2024-01-06 00:39:44', 1);

-- ----------------------------
-- Table structure for colors
-- ----------------------------
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `deleted` int NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of colors
-- ----------------------------
INSERT INTO `colors` VALUES (1, 'Blue', '#0000ff', 1, 1, '2023-12-18 14:10:30', '2023-12-18 14:39:49', 1);
INSERT INTO `colors` VALUES (2, 'Red', '#ff0000', 1, 1, '2023-12-18 14:11:30', '2023-12-18 14:30:06', 1);
INSERT INTO `colors` VALUES (3, 'Yellow', '#ffff00', 1, 1, '2023-12-18 14:11:45', '2023-12-18 14:30:18', 1);
INSERT INTO `colors` VALUES (4, 'White', '#ffffff', 1, 1, '2023-12-18 14:12:04', '2023-12-18 14:37:55', 1);
INSERT INTO `colors` VALUES (5, 'Marron', '#804000', 1, 1, '2023-12-18 14:12:19', '2023-12-18 14:12:19', 1);
INSERT INTO `colors` VALUES (6, 'Orange', '#ff8000', 1, 1, '2023-12-18 14:12:38', '2023-12-18 14:29:10', 1);
INSERT INTO `colors` VALUES (7, 'Black', '#000000', 1, 1, '2023-12-18 14:13:02', '2023-12-18 14:13:02', 1);
INSERT INTO `colors` VALUES (8, 'Violet', '#8000ff', 1, 1, '2023-12-18 14:13:21', '2023-12-18 14:13:21', 1);
INSERT INTO `colors` VALUES (9, 'Cian', '#00ffff', 1, 1, '2023-12-18 14:13:38', '2023-12-18 14:13:38', 1);
INSERT INTO `colors` VALUES (10, 'Green', '#008000', 1, 1, '2023-12-18 14:13:57', '2023-12-18 14:13:57', 1);
INSERT INTO `colors` VALUES (11, 'LightSalmon', '#d62e32', 1, 1, '2023-12-18 14:15:39', '2023-12-18 14:15:39', 1);
INSERT INTO `colors` VALUES (12, 'Orange', '#ff8000', 1, 0, '2023-12-18 14:26:03', '2023-12-18 14:27:35', 1);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (19, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (20, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (21, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (22, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (23, '2023_12_17_150826_add_isadmin_user', 1);
INSERT INTO `migrations` VALUES (24, '2023_12_17_151624_create_categories_table', 1);
INSERT INTO `migrations` VALUES (25, '2023_12_17_180113_create_subcategories_table', 1);
INSERT INTO `migrations` VALUES (26, '2023_12_17_200134_create_products_table', 2);
INSERT INTO `migrations` VALUES (29, '2023_12_17_213501_create_brands_table', 3);
INSERT INTO `migrations` VALUES (32, '2023_12_17_223650_create_colors_table', 4);
INSERT INTO `migrations` VALUES (33, '2023_12_30_154843_create_product_color_table', 5);
INSERT INTO `migrations` VALUES (34, '2023_12_30_194906_create_product_size_table', 6);
INSERT INTO `migrations` VALUES (36, '2023_12_30_222130_create_product_images_table', 7);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for product_color
-- ----------------------------
DROP TABLE IF EXISTS `product_color`;
CREATE TABLE `product_color`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `color_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_color_product_id_foreign`(`product_id`) USING BTREE,
  INDEX `product_color_color_id_foreign`(`color_id`) USING BTREE,
  CONSTRAINT `product_color_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `product_color_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_color
-- ----------------------------
INSERT INTO `product_color` VALUES (42, 3, 9, '2024-01-03 03:23:58', '2024-01-03 03:23:58');
INSERT INTO `product_color` VALUES (43, 3, 10, '2024-01-03 03:23:58', '2024-01-03 03:23:58');
INSERT INTO `product_color` VALUES (44, 3, 2, '2024-01-03 03:23:58', '2024-01-03 03:23:58');

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_by` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_images_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (1, 3, '3nzt5ig6ugq.jpeg', 'jpeg', 2, '2023-12-30 22:36:14', '2024-01-03 04:25:37');
INSERT INTO `product_images` VALUES (3, 3, '3ddnwzxo7o5.jpeg', 'jpeg', 1, '2024-01-03 03:23:58', '2024-01-03 03:23:58');

-- ----------------------------
-- Table structure for product_size
-- ----------------------------
DROP TABLE IF EXISTS `product_size`;
CREATE TABLE `product_size`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_size_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_size
-- ----------------------------
INSERT INTO `product_size` VALUES (19, 3, 'S', 43, '2024-01-03 03:23:58', '2024-01-03 03:23:58');
INSERT INTO `product_size` VALUES (20, 3, 'M', 46, '2024-01-03 03:23:58', '2024-01-03 03:23:58');
INSERT INTO `product_size` VALUES (21, 3, 'L', 50, '2024-01-03 03:23:58', '2024-01-03 03:23:58');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subcategory_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `brand_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `old_price` double NULL DEFAULT 0,
  `price` double NULL DEFAULT 0,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `additional_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `shipping_returns` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Deleted',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Dark yellow lace cut out swing dress', 'Dark-yellow-lace-cut-out-swing-dress', '1', '1', NULL, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1);
INSERT INTO `products` VALUES (2, 'prueba product', NULL, '2', '2', NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2023-12-17 21:16:25', '2023-12-17 21:16:25', 1);
INSERT INTO `products` VALUES (3, 'prueba product', 'prueba-product', '4', '2', '1', 4, 43, 'sfsdsdfsdf sf sd fds', '<p>sgffdh j hjkh jkhjkhkh<br></p>', '<p>iuiyui ui yuiyui uyiyuiy<br></p>', '<p>&nbsp;ljkljkljkl mbmvbnvbncvn<br></p>', 1, '2023-12-17 21:17:11', '2023-12-30 19:28:02', 1);

-- ----------------------------
-- Table structure for subcategories
-- ----------------------------
DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE `subcategories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Deleted',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subcategories
-- ----------------------------
INSERT INTO `subcategories` VALUES (1, '4', 'Kitchen & Dining', 'kitchen-dining', 'Kitchen & Dining', 'Kitchen & Dining', 'Kitchen & Dining', 1, '2023-12-17 18:45:15', '2024-01-06 00:55:34', 1);
INSERT INTO `subcategories` VALUES (2, '4', 'Furniture', 'furniture', 'Furniture', 'Furniture', 'Furniture', 1, '2023-12-17 18:48:00', '2024-01-06 00:54:48', 1);
INSERT INTO `subcategories` VALUES (3, '11', 'Gaming', 'gaming', 'Gaming', 'Gaming', 'Gaming', 1, '2024-01-06 00:40:41', '2024-01-06 00:40:41', 1);
INSERT INTO `subcategories` VALUES (4, '11', 'Audio & Headphones', 'audio-headphones', 'Audio & Headphones', 'Audio & Headphones', 'Audio, Headphones', 1, '2024-01-06 00:41:14', '2024-01-06 00:41:14', 1);
INSERT INTO `subcategories` VALUES (5, '11', 'Wearable Technology', 'wearable-technology', 'Wearable Technology', 'Wearable Technology', 'Wearable, Technology', 1, '2024-01-06 00:43:09', '2024-01-06 00:43:09', 1);
INSERT INTO `subcategories` VALUES (6, '11', 'Cameras & Photography', 'cameras-photography', 'Cameras & Photography', 'Cameras & Photography', 'Cameras & Photography', 1, '2024-01-06 00:43:45', '2024-01-06 00:43:45', 1);
INSERT INTO `subcategories` VALUES (7, '11', 'Laptops & Computers', 'laptops-computers', 'Laptops & Computers', 'Laptops & Computers', 'Laptops, Computers', 1, '2024-01-06 00:44:22', '2024-01-06 00:44:22', 1);
INSERT INTO `subcategories` VALUES (8, '11', 'Smartphones & Accessories', 'smartphones-accessories', 'Smartphones & Accessories', 'Smartphones & Accessories', 'Smartphones, Accessories', 1, '2024-01-06 00:45:09', '2024-01-06 00:45:09', 1);
INSERT INTO `subcategories` VALUES (9, '5', 'Men\'s Clothing', 'men-clothing', 'Men\'s Clothing', 'Men\'s Clothing', 'Men\'s Clothing', 1, '2024-01-06 00:45:46', '2024-01-06 00:45:46', 1);
INSERT INTO `subcategories` VALUES (10, '5', 'Women\'s Clothing', 'women-clothing', 'Women\'s Clothing', 'Women\'s Clothing', 'Women\'s Clothing', 1, '2024-01-06 00:46:22', '2024-01-06 00:46:22', 1);
INSERT INTO `subcategories` VALUES (11, '5', 'Kits Clothing', 'kits-clothing', 'Kits Clothing', 'Kits Clothing', 'Kits Clothing', 1, '2024-01-06 00:47:00', '2024-01-06 00:47:00', 1);
INSERT INTO `subcategories` VALUES (12, '5', 'Shoes & Footwear', 'shoes-footwear', 'Shoes & Footwear', 'Shoes & Footwear', 'Shoes, Footwear', 1, '2024-01-06 00:47:49', '2024-01-06 00:47:49', 1);
INSERT INTO `subcategories` VALUES (13, '5', 'Activewear', 'activewear', 'Activewear', 'Activewear', 'Activewear', 1, '2024-01-06 00:48:27', '2024-01-06 00:48:27', 1);
INSERT INTO `subcategories` VALUES (14, '5', 'Lingerie & Sleepwear', 'lingerie-sleepwear', 'Lingerie & Sleepwear', 'Lingerie & Sleepwear', 'Lingerie & Sleepwear', 1, '2024-01-06 00:49:08', '2024-01-06 00:49:08', 1);
INSERT INTO `subcategories` VALUES (15, '4', 'Home Decor', 'home-decor', 'Home Decor', 'Home Decor', 'Home Decor', 1, '2024-01-07 04:57:49', '2024-01-07 04:57:49', 1);
INSERT INTO `subcategories` VALUES (16, '4', 'Bedding & Bath', 'bedding-bath', 'Bedding & Bath', 'Bedding & Bath', 'Bedding & Bath', 1, '2024-01-07 04:58:28', '2024-01-07 04:58:28', 1);
INSERT INTO `subcategories` VALUES (17, '4', 'Appliances', 'appliances', 'Appliances', 'Appliances', 'Appliances', 1, '2024-01-07 04:58:48', '2024-01-07 04:58:48', 1);
INSERT INTO `subcategories` VALUES (18, '4', 'Lighting', 'lighting', 'Lighting', 'Lighting', 'Lighting', 1, '2024-01-07 04:59:10', '2024-01-07 04:59:10', 1);
INSERT INTO `subcategories` VALUES (19, '4', 'Storage & Organization', 'storage-organization', 'Storage & Organization', 'Storage & Organization', 'Storage, Organization', 1, '2024-01-07 04:59:44', '2024-01-07 04:59:44', 1);
INSERT INTO `subcategories` VALUES (20, '10', 'Skincare', 'skincare', 'Skincare', 'Skincare', 'Skincare', 1, '2024-01-07 05:00:55', '2024-01-07 05:00:55', 1);
INSERT INTO `subcategories` VALUES (21, '10', 'Makeup', 'makeup', 'Makeup', 'Makeup', 'Makeup', 1, '2024-01-07 05:01:15', '2024-01-07 05:01:15', 1);
INSERT INTO `subcategories` VALUES (22, '10', 'Haircare', 'haircare', 'Haircare', 'Haircare', 'Haircare', 1, '2024-01-07 05:01:39', '2024-01-07 05:01:39', 1);
INSERT INTO `subcategories` VALUES (23, '10', 'Fragrances', 'fragrances', 'Fragrances', 'Fragrances', 'Fragrances', 1, '2024-01-07 05:01:58', '2024-01-07 05:01:58', 1);
INSERT INTO `subcategories` VALUES (24, '10', 'Bath & Body', 'bath-body', 'Bath & Body', 'Bath & Body', 'Bath, Body', 1, '2024-01-07 05:02:34', '2024-01-07 05:02:34', 1);
INSERT INTO `subcategories` VALUES (25, '10', 'Men\'s Grooming', 'mens-grooming', 'Men\'s Grooming', 'Men\'s Grooming', 'Men\'s Grooming', 1, '2024-01-07 05:03:05', '2024-01-07 05:03:05', 1);
INSERT INTO `subcategories` VALUES (26, '9', 'Books', 'books', 'Books', 'Books', 'Books', 1, '2024-01-07 05:05:12', '2024-01-07 05:05:12', 1);
INSERT INTO `subcategories` VALUES (27, '9', 'eBooks', 'ebooks', 'eBooks', 'eBooks', 'eBooks', 1, '2024-01-07 05:05:41', '2024-01-07 05:05:41', 1);
INSERT INTO `subcategories` VALUES (28, '9', 'Movies & TV Shows', 'movies-tv-shows', 'Movies & TV Shows', 'Movies & TV Shows', 'Movies & TV Shows', 1, '2024-01-07 05:06:24', '2024-01-07 05:06:24', 1);
INSERT INTO `subcategories` VALUES (29, '9', 'Music', 'music', 'Music', 'Music', 'Music', 1, '2024-01-07 05:06:43', '2024-01-07 05:06:43', 1);
INSERT INTO `subcategories` VALUES (30, '9', 'Audiobooks', 'audiobooks', 'Audiobooks', 'Audiobooks', 'Audiobooks', 1, '2024-01-07 05:07:24', '2024-01-07 05:07:24', 1);
INSERT INTO `subcategories` VALUES (31, '9', 'Sheet Music', 'sheet-music', 'Sheet Music', 'Sheet Music', 'Sheet Music', 1, '2024-01-07 05:07:53', '2024-01-07 05:07:53', 1);
INSERT INTO `subcategories` VALUES (32, '1', 'Vitamins & Supplements', 'vitamins-supplements', 'Vitamins & Supplements', 'Vitamins & Supplements', 'Vitamins & Supplements', 1, '2024-01-07 05:12:20', '2024-01-07 05:12:20', 1);
INSERT INTO `subcategories` VALUES (33, '1', 'Fitness Equipment', 'fitness-equipment', 'Fitness Equipment', 'Fitness Equipment', 'Fitness Equipment', 1, '2024-01-07 05:13:00', '2024-01-07 05:13:00', 1);
INSERT INTO `subcategories` VALUES (34, '1', 'Personal Care Devices', 'personal-care-devices', 'Personal Care Devices', 'Personal Care Devices', 'Personal Care Devices', 1, '2024-01-07 05:16:54', '2024-01-07 05:16:54', 1);
INSERT INTO `subcategories` VALUES (35, '1', 'Health Monitors', 'health-monitors', 'Health Monitors', 'Health Monitors', 'Health Monitors', 1, '2024-01-07 05:17:40', '2024-01-07 05:17:40', 1);
INSERT INTO `subcategories` VALUES (36, '1', 'Sports Nutrition', 'sports-nutrition', 'Sports Nutrition', 'Sports Nutrition', 'Sports Nutrition', 1, '2024-01-07 05:18:31', '2024-01-07 05:18:31', 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_admin` int NOT NULL DEFAULT 0 COMMENT '1: Admin, 0: Customer',
  `is_delete` int NOT NULL DEFAULT 0 COMMENT '1: Deleted, 0: Not',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Inactive',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', '2023-12-17 13:20:39', '$2y$12$VS4SsfTLdBNd.s3GBqNsvOiyXazK6H/july9CiN0DmUc41c5O5I8i', NULL, 1, 0, '2023-12-17 13:20:31', NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;
