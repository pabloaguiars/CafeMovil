-- MySQL Script generated by MySQL Workbench
-- Tue Apr 23 19:09:22 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema cafemovildb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cafemovildb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cafemovildb` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `cafemovildb` ;

-- -----------------------------------------------------
-- Table `cafemovildb`.`migrations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`migrations` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`schools`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`schools` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`schools` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `schools_phone_unique` (`phone` ASC) VISIBLE,
  UNIQUE INDEX `schools_email_unique` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`students`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`students` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`students` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_at_school` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `father_last_name` VARCHAR(255) NOT NULL,
  `mother_last_name` VARCHAR(255) NOT NULL,
  `curp` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `status` TINYINT(1) NOT NULL,
  `imag_url` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `id_school` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `students_id_at_school_unique` (`id_at_school` ASC) VISIBLE,
  UNIQUE INDEX `students_curp_unique` (`curp` ASC) VISIBLE,
  UNIQUE INDEX `students_email_unique` (`email` ASC) VISIBLE,
  UNIQUE INDEX `students_phone_unique` (`phone` ASC) VISIBLE,
  INDEX `students_id_school_foreign` (`id_school` ASC) VISIBLE,
  CONSTRAINT `students_id_school_foreign`
    FOREIGN KEY (`id_school`)
    REFERENCES `cafemovildb`.`schools` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`sellers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`sellers` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`sellers` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_at_school` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `father_last_name` VARCHAR(255) NOT NULL,
  `mother_last_name` VARCHAR(255) NOT NULL,
  `curp` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `status` TINYINT(1) NOT NULL,
  `imag_url` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `id_school` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `sellers_id_at_school_unique` (`id_at_school` ASC) VISIBLE,
  UNIQUE INDEX `sellers_curp_unique` (`curp` ASC) VISIBLE,
  UNIQUE INDEX `sellers_email_unique` (`email` ASC) VISIBLE,
  UNIQUE INDEX `sellers_phone_unique` (`phone` ASC) VISIBLE,
  INDEX `sellers_id_school_foreign` (`id_school` ASC) VISIBLE,
  CONSTRAINT `sellers_id_school_foreign`
    FOREIGN KEY (`id_school`)
    REFERENCES `cafemovildb`.`schools` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`orders` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`orders` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_client` BIGINT(20) UNSIGNED NOT NULL,
  `id_seller` BIGINT(20) UNSIGNED NOT NULL,
  `ordered_at` TIMESTAMP NOT NULL,
  `delivered_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `orders_id_client_foreign` (`id_client` ASC) VISIBLE,
  INDEX `orders_id_seller_foreign` (`id_seller` ASC) VISIBLE,
  CONSTRAINT `orders_id_client_foreign`
    FOREIGN KEY (`id_client`)
    REFERENCES `cafemovildb`.`students` (`id`),
  CONSTRAINT `orders_id_seller_foreign`
    FOREIGN KEY (`id_seller`)
    REFERENCES `cafemovildb`.`sellers` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`products` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`products` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `unit_price` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `imag_url` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `id_seller` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `products_id_seller_foreign` (`id_seller` ASC) VISIBLE,
  CONSTRAINT `products_id_seller_foreign`
    FOREIGN KEY (`id_seller`)
    REFERENCES `cafemovildb`.`sellers` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`orders_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`orders_details` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`orders_details` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_order` BIGINT(20) UNSIGNED NOT NULL,
  `id_product` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `orders_details_id_id_order_id_product_index` (`id` ASC, `id_order` ASC, `id_product` ASC) VISIBLE,
  INDEX `orders_details_id_order_foreign` (`id_order` ASC) VISIBLE,
  INDEX `orders_details_id_product_foreign` (`id_product` ASC) VISIBLE,
  CONSTRAINT `orders_details_id_order_foreign`
    FOREIGN KEY (`id_order`)
    REFERENCES `cafemovildb`.`orders` (`id`),
  CONSTRAINT `orders_details_id_product_foreign`
    FOREIGN KEY (`id_product`)
    REFERENCES `cafemovildb`.`products` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`password_resets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`password_resets` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`schools_administrators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`schools_administrators` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`schools_administrators` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_at_school` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `father_last_name` VARCHAR(255) NOT NULL,
  `mother_last_name` VARCHAR(255) NOT NULL,
  `curp` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `status` TINYINT(1) NOT NULL,
  `imag_url` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `id_school` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `schools_administrators_id_at_school_unique` (`id_at_school` ASC) VISIBLE,
  UNIQUE INDEX `schools_administrators_curp_unique` (`curp` ASC) VISIBLE,
  UNIQUE INDEX `schools_administrators_email_unique` (`email` ASC) VISIBLE,
  UNIQUE INDEX `schools_administrators_phone_unique` (`phone` ASC) VISIBLE,
  INDEX `schools_administrators_id_school_foreign` (`id_school` ASC) VISIBLE,
  CONSTRAINT `schools_administrators_id_school_foreign`
    FOREIGN KEY (`id_school`)
    REFERENCES `cafemovildb`.`schools` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`users_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`users_types` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`users_types` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cafemovildb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cafemovildb`.`users` ;

CREATE TABLE IF NOT EXISTS `cafemovildb`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `id_user_type` BIGINT(20) UNSIGNED NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) VISIBLE,
  INDEX `users_id_user_type_foreign` (`id_user_type` ASC) VISIBLE,
  CONSTRAINT `users_id_user_type_foreign`
    FOREIGN KEY (`id_user_type`)
    REFERENCES `cafemovildb`.`users_types` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
