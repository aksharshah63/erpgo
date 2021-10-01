-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2021 at 10:37 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erpgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `task_id` int(11) NOT NULL DEFAULT 0,
  `log_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `project_id`, `task_id`, `log_type`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'Create Milestone', '{\"title\":\"milestone1\"}', '2021-03-31 00:42:31', '2021-03-31 00:42:31'),
(2, 1, 1, 1, 'Create Task', '{\"title\":\"task1\"}', '2021-03-31 00:42:57', '2021-03-31 00:42:57'),
(3, 1, 1, 0, 'Invite User', '{\"title\":\"Admin\"}', '2021-03-31 00:43:57', '2021-03-31 00:43:57'),
(4, 1, 1, 0, 'Create Expense', '{\"title\":\"expense\"}', '2021-03-31 00:44:57', '2021-03-31 00:44:57'),
(5, 1, 2, 0, 'Invite User', '{\"title\":\"Admin\"}', '2021-03-31 05:06:15', '2021-03-31 05:06:15'),
(6, 1, 2, 2, 'Create Task', '{\"title\":\"Teegan Chen\"}', '2021-08-27 03:29:31', '2021-08-27 03:29:31'),
(7, 1, 2, 2, 'Move Task', '{\"title\":\"Teegan Chen\",\"old_stage\":\"Todo\",\"new_stage\":\"In Progress\"}', '2021-08-27 03:31:15', '2021-08-27 03:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_announcement_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `select_users` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `by_department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `by_designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `send_announcement_to`, `select_users`, `by_department`, `by_designation`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'announcement', '<p>test</p>', 'by_designation', '0', '0', '1', 1, '2021-03-30 23:52:35', '2021-03-30 23:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` double(15,2) NOT NULL DEFAULT 0.00,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `holder_name`, `bank_name`, `account_number`, `opening_balance`, `contact_number`, `bank_address`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'akshar', 'bob', '1234567890', 10500.00, '123456', 'nsvari', 1, '2021-03-31 00:02:00', '2021-03-31 00:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `due_date` date NOT NULL,
  `send_date` date DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `order_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'discount-percent',
  `discount_value` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `bill_id`, `vendor_id`, `transaction_date`, `due_date`, `send_date`, `category_id`, `order_no`, `billing_address`, `discount_type`, `discount_value`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-03-31', '2021-03-31', '2021-03-31', 2, '', '', 'discount-percent', 0, 4, 1, '2021-03-31 00:28:53', '2021-03-31 00:29:21'),
(2, 2, 1, '2021-03-31', '2021-03-31', NULL, 2, '', '', 'discount-percent', 10, 0, 1, '2021-03-31 00:33:04', '2021-03-31 04:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `bill_payments`
--

CREATE TABLE `bill_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `account_id` int(11) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_payments`
--

INSERT INTO `bill_payments` (`id`, `bill_id`, `date`, `amount`, `account_id`, `payment_method`, `reference`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-03-31', 1200.00, 1, 0, '', '', '2021-03-31 00:29:21', '2021-03-31 00:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `bill_products`
--

CREATE TABLE `bill_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_products`
--

INSERT INTO `bill_products` (`id`, `bill_id`, `product_id`, `quantity`, `tax`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '1,2', 1000.00, '2021-03-31 00:28:53', '2021-03-31 00:28:53'),
(3, 2, 1, 1, '1,2', 1000.00, '2021-03-31 00:33:57', '2021-03-31 00:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `calender_schedules`
--

CREATE TABLE `calender_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calender_schedules`
--

INSERT INTO `calender_schedules` (`id`, `type`, `date`, `time`, `note`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'log_a_call', '2021-03-02', '10:46:00', '', 1, '2021-03-30 23:46:52', '2021-03-30 23:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0,
  `sub_type` int(11) NOT NULL DEFAULT 0,
  `is_enabled` int(11) NOT NULL DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `name`, `code`, `type`, `sub_type`, `is_enabled`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Accounts Receivable', 120, 1, 1, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(2, 'Computer Equipment', 160, 1, 2, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(3, 'Office Equipment', 150, 1, 2, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(4, 'Inventory', 140, 1, 3, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(5, 'Budget - Finance Staff', 857, 1, 6, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(6, 'Accumulated Depreciation', 170, 1, 7, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(7, 'Accounts Payable', 200, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(8, 'Accruals', 205, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(9, 'Office Equipment', 150, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(10, 'Clearing Account', 855, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(11, 'Employee Benefits Payable', 235, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(12, 'Employee Deductions payable', 236, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(13, 'Historical Adjustments', 255, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(14, 'Revenue Received in Advance', 835, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(15, 'Rounding', 260, 2, 8, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(16, 'Costs of Goods Sold', 500, 3, 11, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(17, 'Advertising', 600, 3, 12, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(18, 'Automobile Expenses', 644, 3, 12, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(19, 'Bad Debts', 684, 3, 12, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(20, 'Bank Revaluations', 810, 3, 12, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(21, 'Bank Service Charges', 605, 3, 12, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(22, 'Consulting & Accounting', 615, 3, 12, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(23, 'Depreciation', 700, 3, 12, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(24, 'General Expenses', 628, 3, 12, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(25, 'Interest Income', 460, 4, 13, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(26, 'Other Revenue', 470, 4, 13, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(27, 'Purchase Discount', 475, 4, 13, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(28, 'Sales', 400, 4, 13, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(29, 'Common Stock', 330, 5, 16, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(30, 'Owners Contribution', 300, 5, 16, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(31, 'Owners Draw', 310, 5, 16, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(32, 'Retained Earnings', 320, 5, 16, 1, NULL, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(33, 'test', 1232, 2, 8, 1, '', 1, '2021-03-31 00:35:05', '2021-03-31 00:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_account_sub_types`
--

CREATE TABLE `chart_of_account_sub_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_account_sub_types`
--

INSERT INTO `chart_of_account_sub_types` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Current Asset', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(2, 'Fixed Asset', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(3, 'Inventory', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(4, 'Non-current Asset', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(5, 'Prepayment', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(6, 'Bank & Cash', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(7, 'Depreciation', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(8, 'Current Liability', 2, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(9, 'Liability', 2, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(10, 'Non-current Liability', 2, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(11, 'Direct Costs', 3, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(12, 'Expense', 3, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(13, 'Revenue', 4, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(14, 'Sales', 4, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(15, 'Other Income', 4, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(16, 'Equity', 5, '2021-03-30 23:12:43', '2021-03-30 23:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_account_types`
--

CREATE TABLE `chart_of_account_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_account_types`
--

INSERT INTO `chart_of_account_types` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Assets', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(2, 'Liabilities', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(3, 'Expenses', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(4, 'Income', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(5, 'Equity', 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'rajodiya', 'rajodiya@gmail.com', 1, '2021-03-30 23:33:00', '2021-03-30 23:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `life_stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign_group` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_plus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `company_id`, `phone_no`, `image`, `life_stage`, `contact_owner`, `mobile_no`, `website`, `fax_no`, `address1`, `address2`, `city`, `country`, `state`, `zip_code`, `assign_group`, `contact_source`, `others`, `notes`, `facebook`, `twitter`, `google_plus`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 1, '12223456', NULL, 'Customers', '3', '', '', '', '', '', '', '', '', '', 'contact group1', '', '', '', '', '', '', '', '2021-03-30 23:33:00', '2021-03-30 23:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'preyansh', 'preyansh@gmai.com', 1, '2021-03-30 23:21:05', '2021-03-30 23:21:05'),
(2, 'akshar', 'akshar@gmail.com', 1, '2021-03-30 23:42:13', '2021-03-30 23:42:13'),
(3, 'Melodie Little', 'sudoq@mailinator.com', 1, '2021-08-24 01:42:09', '2021-08-24 01:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_companies`
--

CREATE TABLE `contacts_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts_companies`
--

INSERT INTO `contacts_companies` (`id`, `contact_id`, `company_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2021-03-30 23:33:14', '2021-03-30 23:33:14'),
(2, 2, 1, 1, '2021-03-30 23:43:01', '2021-03-30 23:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `life_stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign_group` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_plus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `contact_id`, `phone_no`, `image`, `life_stage`, `contact_owner`, `date_of_birth`, `age`, `mobile_no`, `website`, `fax_no`, `address1`, `address2`, `city`, `country`, `state`, `zip_code`, `assign_group`, `contact_source`, `others`, `notes`, `facebook`, `twitter`, `google_plus`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 1, '12345678', 'contacts/1617166316.jpeg', 'Customers', '3', NULL, '', '', '', '', '', '', '', '', '', '', 'contact group1', '', '', '', '', '', '', '', '2021-03-30 23:21:05', '2021-03-30 23:22:44'),
(2, 2, '123456', NULL, 'Leads', '3', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2021-03-30 23:42:13', '2021-03-30 23:42:13'),
(3, 3, '+1 (352) 707-7377', NULL, 'Opportunities', '4', NULL, '', '', '', '', '', '', '', '', '', '', 'contact group1', '', '', '', '', '', '', '', '2021-08-24 01:42:09', '2021-08-24 01:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `contact_groups`
--

CREATE TABLE `contact_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `private` tinyint(1) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_groups`
--

INSERT INTO `contact_groups` (`id`, `name`, `description`, `private`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'contact group1', 'test', 1, 1, '2021-03-30 23:22:28', '2021-03-30 23:22:34'),
(2, 'Yuri Fleming', 'Anim quia molestiae', 2, 1, '2021-08-24 01:41:56', '2021-08-24 01:41:56'),
(3, 'Jordan Conway', 'Quidem consequuntur', 2, 1, '2021-08-24 01:42:01', '2021-08-24 01:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `first_name`, `last_name`, `email`, `balance`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'hitesh', 'shah', 'tojac41577@bombaya.com', 0, 1, '2021-03-30 23:56:56', '2021-03-31 00:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `customer_id`, `phone_no`, `image`, `company`, `mobile_no`, `website`, `notes`, `fax_no`, `address1`, `address2`, `city`, `country`, `state`, `post_code`, `created_at`, `updated_at`) VALUES
(1, 1, '123456', NULL, '', '', '', '', '', 'infinity tower', '', 'surat', 'India', 'gujarat', '123456', '2021-03-30 23:56:56', '2021-03-30 23:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_leads` bigint(20) UNSIGNED DEFAULT 0,
  `parent_department` bigint(20) UNSIGNED DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `description`, `department_leads`, `parent_department`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'dept', 'test', 3, 0, 1, '2021-03-30 23:50:54', '2021-03-30 23:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `title`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'designation1', 'test', 1, '2021-03-30 23:51:23', '2021-03-30 23:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_of_study` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_of_completion` year(4) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `school_name`, `degree`, `field_of_study`, `year_of_completion`, `description`, `user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'agrawal', 'mca', 'php', 2016, '', 3, 1, '2021-03-30 23:16:27', '2021-03-30 23:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`, `subject`, `description`, `module_type`, `module_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'tojac41577@bombaya.com', 'subject1', '<p>note</p>', 'contact', 1, 1, '2021-03-30 23:26:04', '2021-03-30 23:26:04'),
(2, 'fenab@mailinator.com', 'Est numquam anim re', '<p>qweqwe</p>', 'contact', 2, 1, '2021-08-10 01:29:24', '2021-08-10 01:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_hire` date NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `task_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `date`, `description`, `amount`, `attachment`, `project_id`, `task_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'expense', '1970-01-01', '', 10, NULL, 1, 1, 1, '2021-03-31 00:44:57', '2021-03-31 00:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holiday_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `range` tinyint(1) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `holiday_name`, `start_date`, `range`, `end_date`, `description`, `days`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'holiday1', '2021-03-30', 1, '2021-03-31', '', 1, 1, '2021-03-30 23:53:58', '2021-03-30 23:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `due_date` date NOT NULL,
  `send_date` date DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'discount-percent',
  `discount_value` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `customer_id`, `transaction_date`, `due_date`, `send_date`, `category_id`, `reference_no`, `billing_address`, `discount_type`, `discount_value`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-03-31', '2021-03-31', '2021-03-31', 1, '', '', 'discount-percent', 10, 4, 1, '2021-03-30 23:58:49', '2021-03-31 00:02:11'),
(2, 2, 1, '2021-03-31', '2021-03-31', NULL, 1, '', '', 'discount-value', 10, 0, 1, '2021-03-31 00:02:33', '2021-03-31 03:59:52'),
(3, 3, 1, '2021-03-31', '2021-03-31', NULL, 1, '', '', 'discount-percent', 10, 0, 1, '2021-03-31 03:27:26', '2021-03-31 03:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE `invoice_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `account_id` int(11) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `invoice_id`, `date`, `amount`, `account_id`, `payment_method`, `reference`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-03-31', 1800.00, 1, 0, '', '', '2021-03-31 00:02:11', '2021-03-31 00:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_products`
--

INSERT INTO `invoice_products` (`id`, `invoice_id`, `product_id`, `quantity`, `tax`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '', 1000.00, '2021-03-30 23:58:49', '2021-03-30 23:59:16'),
(2, 2, 1, 2, '1,2', 1000.00, '2021-03-31 00:02:33', '2021-03-31 00:06:10'),
(3, 3, 1, 2, '1,2', 100.00, '2021-03-31 03:27:26', '2021-03-31 03:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `journal_id` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `date`, `reference`, `description`, `journal_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2021-03-31', '', '', 1, 1, '2021-03-31 00:34:41', '2021-03-31 00:34:41'),
(2, '2021-03-31', '', '', 2, 1, '2021-03-31 00:51:11', '2021-03-31 00:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `journal_items`
--

CREATE TABLE `journal_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal` int(11) NOT NULL DEFAULT 0,
  `account` int(11) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit` double(8,2) NOT NULL DEFAULT 0.00,
  `credit` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_items`
--

INSERT INTO `journal_items` (`id`, `journal`, `account`, `description`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '', 100.00, 0.00, '2021-03-31 00:34:41', '2021-03-31 00:34:41'),
(2, 1, 4, '', 0.00, 100.00, '2021-03-31 00:34:41', '2021-03-31 00:34:41'),
(3, 2, 33, '', 100.00, 0.00, '2021-03-31 00:51:11', '2021-03-31 00:51:11'),
(4, 2, 1, '', 0.00, 100.00, '2021-03-31 00:51:11', '2021-03-31 00:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_id`, `from`, `to`, `reason`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '2021-03-31', '2021-04-01', 'medical', 1, 'Approve', '2021-03-30 23:53:12', '2021-03-30 23:53:15'),
(2, 3, '2021-03-31', '2021-03-31', 'ijij', 1, 'Reject', '2021-03-31 03:15:35', '2021-03-31 03:15:38'),
(3, 3, '2021-07-28', '2021-07-29', 'tgdfg', 1, 'Pending', '2021-07-28 04:09:39', '2021-07-28 04:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `time` time NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id`, `type`, `start_date`, `time`, `note`, `module_type`, `module_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'log_a_call', '2021-03-30', '10:23:00', '<p>log1</p>', 'contact', 1, 1, '2021-03-30 23:23:46', '2021-03-30 23:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_28_102009_create_settings_table', 1),
(5, '2020_12_01_110244_create_contacts_table', 1),
(6, '2021_01_16_060646_create_contact_groups_table', 1),
(7, '2021_01_18_062641_create_contact_details_table', 1),
(8, '2021_01_20_091800_create_notes_table', 1),
(9, '2021_01_20_113044_create_log_activities_table', 1),
(10, '2021_01_21_074832_create_schedules_table', 1),
(11, '2021_01_22_061122_create_companies_table', 1),
(12, '2021_01_22_061656_create_company_details_table', 1),
(13, '2021_01_22_105125_create_contacts_companies_table', 1),
(14, '2021_01_23_054217_create_emails_table', 1),
(15, '2021_01_25_043714_create_tags_table', 1),
(16, '2021_01_25_055840_create_calender_schedules_table', 1),
(17, '2021_01_27_055337_create_tasks_table', 1),
(18, '2021_01_27_065231_create_departments_table', 1),
(19, '2021_01_27_101326_create_designations_table', 1),
(20, '2021_01_27_104237_create_employees_table', 1),
(21, '2021_01_27_105110_create_user_details_table', 1),
(22, '2021_01_29_034920_create_work_experience_table', 1),
(23, '2021_01_29_044745_create_education_table', 1),
(24, '2021_01_29_095440_create_performance_reviews_table', 1),
(25, '2021_01_30_033923_create_performance_comments_table', 1),
(26, '2021_01_30_040524_create_performance_goals_table', 1),
(27, '2021_02_01_040652_create_announcements_table', 1),
(28, '2021_02_01_082644_create_holidays_table', 1),
(29, '2021_02_01_112431_create_policies_table', 1),
(30, '2021_02_02_091412_create_leave_requests_table', 1),
(31, '2021_02_08_034522_create_customers_table', 1),
(32, '2021_02_08_035115_create_customer_details_table', 1),
(33, '2021_02_08_045515_create_vendors_table', 1),
(34, '2021_02_08_045626_create_vendor_details_table', 1),
(35, '2021_02_08_054631_create_product_categories_table', 1),
(36, '2021_02_08_062613_create_product_and_services_table', 1),
(37, '2021_02_08_111551_create_payment_methods_table', 1),
(38, '2021_02_09_035510_create_taxrates_table', 1),
(39, '2021_02_09_092125_create_invoices_table', 1),
(40, '2021_02_10_044940_create_invoice_products_table', 1),
(41, '2021_02_11_093902_create_invoice_payments_table', 1),
(42, '2021_02_11_100531_create_bank_accounts_table', 1),
(43, '2021_02_11_105518_create_transactions_table', 1),
(44, '2021_02_12_034429_create_transfers_table', 1),
(45, '2021_02_12_072355_create_chart_of_accounts_table', 1),
(46, '2021_02_12_073108_create_chart_of_account_types_table', 1),
(47, '2021_02_12_073121_create_chart_of_account_sub_types_table', 1),
(48, '2021_02_16_040805_create_journal_entries_table', 1),
(49, '2021_02_16_041313_create_journal_items_table', 1),
(50, '2021_02_16_095713_create_proposals_table', 1),
(51, '2021_02_16_100453_create_proposal_products_table', 1),
(52, '2021_02_17_100239_create_bills_table', 1),
(53, '2021_02_17_100759_create_bill_products_table', 1),
(54, '2021_02_17_100929_create_bill_payments_table', 1),
(55, '2021_02_19_054243_create_payments_table', 1),
(56, '2021_03_08_055330_create_permission_tables', 1),
(57, '2021_03_17_100224_create_projects_table', 1),
(58, '2021_03_17_120948_create_task_stages_table', 1),
(59, '2021_03_18_060536_create_project_tasks_table', 1),
(60, '2021_03_18_070146_create_milestones_table', 1),
(61, '2021_03_18_091547_create_task_checklists_table', 1),
(62, '2021_03_18_092113_create_task_files_table', 1),
(63, '2021_03_18_092400_create_task_comments_table', 1),
(64, '2021_03_18_102517_create_activity_logs_table', 1),
(65, '2021_03_19_053350_create_project_users_table', 1),
(66, '2021_03_22_100636_create_expenses_table', 1),
(67, '2021_03_23_032633_create_timesheets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `project_id`, `title`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'milestone1', 'complete', '', '2021-03-31 00:42:31', '2021-03-31 00:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 4),
(3, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `note`, `module_type`, `module_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '<p><s><em><strong>notes1</strong></em></s></p>', 'user', 3, 1, '2021-03-30 23:17:54', '2021-03-30 23:17:54'),
(2, '<p>note</p>', 'contact', 1, 1, '2021-03-30 23:23:28', '2021-03-30 23:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double(15,2) NOT NULL DEFAULT 0.00,
  `account_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `recurring` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `date`, `amount`, `account_id`, `vendor_id`, `description`, `category_id`, `recurring`, `payment_method`, `reference`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2021-03-31', 100.00, 1, 0, '', 2, NULL, 0, '', 1, '2021-03-31 00:49:22', '2021-03-31 00:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performance_comments`
--

CREATE TABLE `performance_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reference_date` date NOT NULL,
  `reviwer` bigint(20) UNSIGNED DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `performance_comments`
--

INSERT INTO `performance_comments` (`id`, `user_id`, `reference_date`, `reviwer`, `comments`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, '2021-03-30', 3, '', 1, '2021-03-30 23:18:44', '2021-03-30 23:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `performance_goals`
--

CREATE TABLE `performance_goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `set_date` date NOT NULL,
  `completion_date` date NOT NULL,
  `goal_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_assessment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` bigint(20) UNSIGNED DEFAULT NULL,
  `supervisor_assessment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `performance_goals`
--

INSERT INTO `performance_goals` (`id`, `user_id`, `set_date`, `completion_date`, `goal_description`, `employee_assessment`, `supervisor`, `supervisor_assessment`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, '2021-03-30', '2004-07-31', '', '', 3, '', 1, '2021-03-30 23:19:09', '2021-03-30 23:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `performance_reviews`
--

CREATE TABLE `performance_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `review_date` date NOT NULL,
  `reporting_to` bigint(20) UNSIGNED DEFAULT NULL,
  `job_knowledge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_quality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendence_punctuality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `communication_listening` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dependability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `performance_reviews`
--

INSERT INTO `performance_reviews` (`id`, `user_id`, `review_date`, `reporting_to`, `job_knowledge`, `work_quality`, `attendence_punctuality`, `communication_listening`, `dependability`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, '2021-03-30', 3, 'very bad', 'very bad', 'very bad', 'very bad', 'very bad', 1, '2021-03-30 23:18:33', '2021-03-30 23:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Manage Roles', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(2, 'Create Role', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(3, 'Edit Role', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(4, 'Delete Role', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(5, 'Manage Contacts', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(6, 'Create Contact', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(7, 'View Contact', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(8, 'Edit Contact', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(9, 'Delete Contact', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(10, 'Manage Companies', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(11, 'Create Company', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(12, 'View Company', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(13, 'Edit Company', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(14, 'Delete Company', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(15, 'Manage Schedules', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(16, 'Create Schedule', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(17, 'View Schedule', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(18, 'View CRM Activity', 'web', '2021-03-30 23:12:35', '2021-03-30 23:12:35'),
(19, 'Manage Contact Groups', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(20, 'Create Contact Group', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(21, 'Edit Contact Group', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(22, 'Delete Contact Group', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(23, 'View CRM Activity Report', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(24, 'View CRM Customer Report', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(25, 'View CRM Growth Report', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(26, 'Manage Employees', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(27, 'Create Employee', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(28, 'View Employee', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(29, 'Edit Employee', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(30, 'Delete Employee', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(31, 'Manage Departments', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(32, 'Create Department', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(33, 'View Department', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(34, 'Edit Department', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(35, 'Delete Department', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(36, 'Manage Designations', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(37, 'Create Designation', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(38, 'View Designation', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(39, 'Edit Designation', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(40, 'Delete Designation', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(41, 'Manage Announcements', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(42, 'Create Announcement', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(43, 'Edit Announcement', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(44, 'Delete Announcement', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(45, 'Manage Leave Requests', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(46, 'Create Leave Request', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(47, 'Edit Leave Request', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(48, 'Manage Holidays', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(49, 'Create Holiday', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(50, 'Edit Holiday', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(51, 'Delete Holiday', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(52, 'Manage Policies', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(53, 'Create Policy', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(54, 'Edit Policy', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(55, 'Delete Policy', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(56, 'View HR Leave Calender', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(57, 'View HR Gender Profile Report', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(58, 'View HR Head Count Report', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(59, 'View HR Age Profile Report', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(60, 'View HR Leave Report', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(61, 'Manage Customers', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(62, 'Create Customer', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(63, 'View Customer', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(64, 'Edit Customer', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(65, 'Delete Customer', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(66, 'Manage Vendors', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(67, 'Create Vendor', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(68, 'View Vendor', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(69, 'Edit Vendor', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(70, 'Delete Vendor', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(71, 'Manage Invoices', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(72, 'Create Invoice', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(73, 'Duplicate Invoice', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(74, 'View Invoice', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(75, 'Edit Invoice', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(76, 'Delete Invoice', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(77, 'Delete Invoice Product', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(78, 'Send Invoice', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(79, 'Create Payment Invoice', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(80, 'Delete Payment Invoice', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(81, 'Manage Invoice Proposals', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(82, 'Create Invoice Proposal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(83, 'Duplicate Invoice Proposal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(84, 'View Invoice Proposal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(85, 'Edit Invoice Proposal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(86, 'Delete Invoice Proposal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(87, 'Delete Proposal Product', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(88, 'Send Invoice Proposal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(89, 'Manage Bills', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(90, 'Create Bill', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(91, 'Duplicate Bill', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(92, 'View Bill', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(93, 'Edit Bill', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(94, 'Delete Bill', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(95, 'Delete Bill Product', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(96, 'Send Bill', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(97, 'Create Payment Bill', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(98, 'Delete Payment Bill', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(99, 'Manage Bill Payments', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(100, 'Create Bill Payment', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(101, 'Edit Bill Payment', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(102, 'Delete Bill Payment', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(103, 'Manage Journals', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(104, 'Create Journal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(105, 'View Journal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(106, 'Edit Journal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(107, 'Delete Journal', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(108, 'Manage Chart of Accounts', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(109, 'Create Chart of Account', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(110, 'View Chart of Account', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(111, 'Edit Chart of Account', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(112, 'Delete Chart of Account', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(113, 'Manage Bank Accounts', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(114, 'Create Bank Account', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(115, 'Edit Bank Account', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(116, 'Delete Bank Account', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(117, 'Manage Bank Transfers', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(118, 'Create Bank Transfer', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(119, 'Edit Bank Transfer', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(120, 'Delete Bank Transfer', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(121, 'Manage Payment Methods', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(122, 'Create Payment Method', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(123, 'Edit Payment Method', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(124, 'Delete Payment Method', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(125, 'Manage Product Categories', 'web', '2021-03-30 23:12:36', '2021-03-30 23:12:36'),
(126, 'Create Product Category', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(127, 'Edit Product Category', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(128, 'Delete Product Category', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(129, 'Manage Products', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(130, 'Create Product', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(131, 'Edit Product', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(132, 'Delete Product', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(133, 'Manage Taxs', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(134, 'Create Tax', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(135, 'Edit Tax', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(136, 'Delete Tax', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(137, 'View Accounting Transaction Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(138, 'View Accounting Account Statement Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(139, 'View Accounting Income Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(140, 'View Accounting Expense Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(141, 'View Accounting IncomeVSExpense Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(142, 'View Accounting Tax Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(143, 'View Accounting ProfitLoss Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(144, 'View Accounting Invoice Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(145, 'View Accounting Bill Report', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(146, 'Manage Languages', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(147, 'Create Language', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(148, 'Edit Language', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(149, 'Delete Language', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(150, 'Manage System Settings', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(151, 'Manage Stripe Settings', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(152, 'Manage Projects', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(153, 'Create Project', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(154, 'Edit Project', 'web', '2021-03-30 23:12:37', '2021-03-30 23:12:37'),
(155, 'Delete Project', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(156, 'View Project', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(157, 'Create Milestone', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(158, 'Edit Milestone', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(159, 'Delete Milestone', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(160, 'View Milestone', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(161, 'Manage Tasks', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(162, 'Create Task', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(163, 'Edit Task', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(164, 'Delete Task', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(165, 'View Task', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(166, 'Move Task', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(167, 'Manage Timesheets', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(168, 'Create Timesheet', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(169, 'Edit Timesheet', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(170, 'View Timesheet', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(171, 'View Grant Chart', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(172, 'Manage Expenses', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(173, 'Create Expense', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(174, 'Edit Expense', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(175, 'View Expense', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(176, 'Delete Expense', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(177, 'View Activity', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(178, 'Manage Task Stages', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(179, 'Create Task Stage', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38'),
(180, 'Delete Task Stage', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `policy_name`, `description`, `department`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'policy1', '', 1, 1, '2021-03-30 23:54:05', '2021-03-30 23:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_and_services`
--

CREATE TABLE `product_and_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` bigint(20) UNSIGNED DEFAULT NULL,
  `cost_price` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_price` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_and_services`
--

INSERT INTO `product_and_services` (`id`, `product_name`, `product_type`, `category`, `cost_price`, `sale_price`, `tax_rate_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'laptop', 'inventory', 0, 1000, 1000, '1,2', 1, '2021-03-30 23:57:38', '2021-03-31 00:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#fc544b',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `type`, `color`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'category1', '1', '#4f2240', 1, '2021-03-30 23:58:16', '2021-03-30 23:58:16'),
(2, 'category2', '2', '#30224f', 1, '2021-03-31 00:22:29', '2021-03-31 00:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `project_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `start_date`, `end_date`, `project_image`, `budget`, `description`, `status`, `tags`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'project1', '2021-03-31', '2021-04-01', NULL, 0, '', 'on_hold', '', 1, '2021-03-31 00:42:15', '2021-03-31 00:42:15'),
(2, 'Tyrone Cain', '1975-08-03', '2013-10-31', NULL, 92, 'Harum dolore unde at', 'in_progress', 'Voluptate in facere', 1, '2021-03-31 04:56:02', '2021-08-27 03:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `project_tasks`
--

CREATE TABLE `project_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_hrs` int(11) NOT NULL DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `priority` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `priority_color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign_to` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `milestone_id` int(11) NOT NULL DEFAULT 0,
  `stage_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `is_favourite` int(11) NOT NULL DEFAULT 0,
  `is_complete` int(11) NOT NULL DEFAULT 0,
  `marked_at` date DEFAULT NULL,
  `progress` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_tasks`
--

INSERT INTO `project_tasks` (`id`, `name`, `description`, `estimated_hrs`, `start_date`, `end_date`, `priority`, `priority_color`, `assign_to`, `project_id`, `milestone_id`, `stage_id`, `order`, `created_by`, `is_favourite`, `is_complete`, `marked_at`, `progress`, `created_at`, `updated_at`) VALUES
(1, 'task1', '', 10, '2021-03-31', '2021-04-07', 'critical', '#d35400', '1', 1, 1, 4, 0, 1, 1, 1, '2021-03-31', '0', '2021-03-31 00:42:57', '2021-03-31 00:45:19'),
(2, 'Teegan Chen', 'Velit asperiores nat', 38, '1998-06-15', '1975-09-17', 'low', '#f39c12', '3', 2, 0, 2, 1, 1, 1, 0, NULL, '0', '2021-08-27 03:29:31', '2021-08-27 03:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE `project_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invited_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `project_id`, `user_id`, `invited_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2021-03-31 00:42:15', '2021-03-31 00:42:15'),
(2, 1, 3, 1, '2021-03-31 00:43:57', '2021-03-31 00:43:57'),
(3, 2, 1, 0, '2021-03-31 04:56:02', '2021-03-31 04:56:02'),
(4, 2, 3, 1, '2021-03-31 05:06:15', '2021-03-31 05:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `send_date` date DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'discount-percent',
  `discount_value` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `proposal_id`, `customer_id`, `transaction_date`, `send_date`, `category_id`, `billing_address`, `discount_type`, `discount_value`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-03-31', NULL, 1, '', 'discount-value', 10, 4, 1, '2021-03-31 00:12:45', '2021-03-31 00:18:53'),
(2, 2, 1, '2021-03-31', NULL, 1, '', 'discount-value', 10, 0, 1, '2021-03-31 00:15:26', '2021-03-31 00:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_products`
--

CREATE TABLE `proposal_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_products`
--

INSERT INTO `proposal_products` (`id`, `proposal_id`, `product_id`, `quantity`, `tax`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '1,2', 1000.00, '2021-03-31 00:12:45', '2021-03-31 00:12:45'),
(2, 2, 1, 1, '1,2', 1000.00, '2021-03-31 00:15:26', '2021-03-31 00:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Admin', 'web', '2021-03-30 23:12:38', '2021-03-30 23:12:38', 0),
(2, 'Employee', 'web', '2021-03-30 23:12:43', '2021-03-30 23:12:43', 1),
(3, 'customer', 'web', '2021-03-31 00:47:52', '2021-03-31 00:47:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(152, 3),
(153, 1),
(153, 3),
(154, 1),
(154, 3),
(155, 1),
(155, 3),
(156, 1),
(156, 3),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all_day` tinyint(1) DEFAULT NULL,
  `start_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date NOT NULL,
  `end_time` time DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent_or_manager` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all_notification` tinyint(1) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `title`, `all_day`, `start_date`, `start_time`, `end_date`, `end_time`, `note`, `agent_or_manager`, `schedule_type`, `all_notification`, `email`, `module_type`, `module_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'schedule1', 0, '2021-03-30', '10:25:00', '2021-03-31', '10:25:00', '<p>note1</p>', 'preyansh', 'meeting', 1, 'tojac41577@bombaya.com', 'contact', 1, 1, '2021-03-30 23:25:20', '2021-03-30 23:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'rajodiya infotech', 1, NULL, NULL),
(2, 'company_address', 'infinity tower,station road', 1, NULL, NULL),
(3, 'company_city', 'surat', 1, NULL, NULL),
(4, 'company_state', 'gujarat', 1, NULL, NULL),
(5, 'company_zipcode', '123456', 1, NULL, NULL),
(6, 'company_country', 'India', 1, NULL, NULL),
(7, 'company_telephone', '123456', 1, NULL, NULL),
(8, 'company_email', 'rajodiya@gmail.com', 1, NULL, NULL),
(9, 'company_email_from_name', 'rajodiya', 1, NULL, NULL),
(10, 'bill_template', 'template1', 1, NULL, NULL),
(11, 'bill_color', '3baeff', 1, NULL, NULL),
(12, 'title_text', 'ErpGo NonSaas12', 1, NULL, NULL),
(13, 'site_currency', 'USD', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(14, 'site_currency_symbol', '$', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(15, 'site_currency_symbol_position', 'pre', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(16, 'site_date_format', 'd-m-Y', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(17, 'site_time_format', 'g:i A', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(18, 'invoice_prefix', '#INVO', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(19, 'proposal_prefix', '#PROP', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(20, 'bill_prefix', '#BILL', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(21, 'customer_prefix', '#CUST', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(22, 'vender_prefix', '#VEND', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(23, 'user_prefix', '#USER', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(24, 'journal_prefix', '#JUR', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(25, 'footer_title', 'ErpGo', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(26, 'decimal_number', '2', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(27, 'footer_notes', 'notes', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(28, 'footer_link_title_1', 'Support', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(29, 'footer_link_href_1', '#', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(30, 'footer_link_title_2', 'Terms', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(31, 'footer_link_href_2', '#', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(32, 'footer_link_title_3', 'Privacy', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(33, 'footer_link_href_3', '#', 1, '2021-03-31 00:51:54', '2021-03-31 00:51:54'),
(55, 'proposal_template', 'template10', 1, NULL, NULL),
(56, 'proposal_color', '37a4e4', 1, NULL, NULL),
(59, 'invoice_template', 'template10', 1, NULL, NULL),
(60, 'invoice_color', '6a737b', 1, NULL, NULL),
(178, 'enable_landing', 'yes', 1, NULL, NULL),
(200, 'company_favicon', '1_favicon.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `text`, `module_type`, `module_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 'contact', 1, 1, '2021-03-30 23:22:07', '2021-03-30 23:22:07'),
(2, 'test', 'company', 1, 1, '2021-03-30 23:33:58', '2021-03-30 23:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent_or_manager` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `agent_or_manager`, `date`, `time`, `description`, `module_type`, `module_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'task1', 'preyansh', '2021-03-30', '10:26:00', '<p>desc1</p>', 'contact', 1, 1, '2021-03-30 23:26:50', '2021-03-30 23:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `task_checklists`
--

CREATE TABLE `task_checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_checklists`
--

INSERT INTO `task_checklists` (`id`, `name`, `task_id`, `user_type`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ffsdf', 2, 'User', 1, 1, '2021-08-27 03:29:59', '2021-08-27 03:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE `task_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_files`
--

CREATE TABLE `task_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_stages`
--

CREATE TABLE `task_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_stages`
--

INSERT INTO `task_stages` (`id`, `name`, `order`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Todo', 0, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(2, 'In Progress', 1, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(3, 'Review', 2, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43'),
(4, 'Done', 3, 1, '2021-03-30 23:12:43', '2021-03-30 23:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `taxrates`
--

CREATE TABLE `taxrates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxrates`
--

INSERT INTO `taxrates` (`id`, `name`, `tax_rate`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'SGST', 10, 1, '2021-03-31 00:05:05', '2021-03-31 00:05:05'),
(2, 'CGST', 10, 1, '2021-03-31 00:05:15', '2021-03-31 00:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timesheets`
--

INSERT INTO `timesheets` (`id`, `project_id`, `task_id`, `date`, `time`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-03-29', '03:00:00', '', 1, '2021-03-31 00:44:29', '2021-03-31 00:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL DEFAULT 0,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `user_type`, `account`, `type`, `amount`, `description`, `date`, `created_by`, `payment_id`, `category`, `created_at`, `updated_at`) VALUES
(1, 1, 'Customer', 1, 'Partial', 1800.00, '', '2021-03-31', 1, 1, 'Invoice', '2021-03-31 00:02:11', '2021-03-31 00:02:11'),
(2, 1, 'Vendor', 1, 'Partial', 1200.00, '', '2021-03-31', 1, 1, 'Bill', '2021-03-31 00:29:21', '2021-03-31 00:29:21'),
(3, 0, 'Vendor', 1, 'Payment', 100.00, '', '2021-03-31', 1, 1, 'category2', '2021-03-31 00:49:22', '2021-03-31 00:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_account` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `to_account` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `amount` double(15,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL,
  `payment_method` int(11) DEFAULT 0,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_hire` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_id`, `user_type`, `user_status`, `date_of_hire`, `email`, `email_verified_at`, `password`, `type`, `lang`, `website`, `profile`, `username`, `created_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL, 'admin@example.com', NULL, '$2y$10$367dmO.YtrPjKWQ9/HBKCu/L7ZqS.upVWXiIBdmTztBFvRv3Li/3O', 'Admin', 'en', NULL, NULL, NULL, 0, NULL, '2021-03-30 23:12:43', '2021-07-28 05:43:56'),
(2, 'Employee', NULL, NULL, NULL, NULL, 'employee@example.com', NULL, '$2y$10$qZPgDUWVFLw59qO7tcNF2.a9CQlwgNVvrIZ0aXhv7M9sDK4vPytna', 'User', 'en', NULL, NULL, NULL, 0, NULL, '2021-03-30 23:12:44', '2021-03-30 23:12:44'),
(3, 'akshar', '1', 'permanent', 'active', '2021-03-31', 'akshar@gmail.com', NULL, '$2y$10$bCnarFT.GGdAgrpv/HxC/.DSdIbvtkdSxJsT42NZ06xyZEAnHW1Sa', 'customer', 'en', NULL, NULL, NULL, 1, NULL, '2021-03-30 23:14:29', '2021-04-01 00:36:55'),
(4, 'Daphne Massey', '2', 'contract', 'inactive', '1992-03-25', 'newato@mailinator.com', NULL, '$2y$10$K.JBPHXaKzI7YM2dZqX/oOaFx6D0wvTEwne515HAbFiFC42uysSRG', 'Employee', 'en', NULL, NULL, NULL, 1, NULL, '2021-07-28 04:17:41', '2021-07-28 04:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.png',
  `department` bigint(20) UNSIGNED DEFAULT NULL,
  `designation` bigint(20) UNSIGNED DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_of_hire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobbies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `image`, `department`, `designation`, `location`, `reporting_to`, `source_of_hire`, `pay_rate`, `pay_type`, `father_name`, `mother_name`, `mobile`, `phone`, `date_of_birth`, `nationality`, `gender`, `marital_status`, `hobbies`, `website`, `address1`, `address2`, `city`, `country`, `state`, `zip_code`, `biography`, `policy_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'users/1617189955.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-30 23:12:43', '2021-03-31 05:55:55'),
(2, 2, 'avatar.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-30 23:12:44', '2021-03-30 23:12:44'),
(3, 3, 'users/1617165999.jpeg', 1, 1, '', '0', '', '', '', '', '', '', '', NULL, '', 'male', '', '', '', '', '', '', '', '', '', '', '1', '2021-03-30 23:14:29', '2021-04-01 00:36:55'),
(4, 4, 'avatar.png', 1, 0, '', '0', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', NULL, '2021-07-28 04:17:41', '2021-07-28 04:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_id`, `first_name`, `last_name`, `email`, `balance`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'sanket', 'shah', 'tojac41577@bombaya.com', 0, 1, '2021-03-31 00:28:19', '2021-03-31 00:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_details`
--

CREATE TABLE `vendor_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_details`
--

INSERT INTO `vendor_details` (`id`, `vendor_id`, `phone_no`, `image`, `company`, `mobile_no`, `website`, `notes`, `fax_no`, `address1`, `address2`, `city`, `country`, `state`, `post_code`, `created_at`, `updated_at`) VALUES
(1, 1, '123456', NULL, '', '123456', '', '', '', 'mumbai', '', 'mumbai', 'in', 'guj', '123456', '2021-03-31 00:28:19', '2021-03-31 00:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `previous_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `job_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`id`, `previous_company`, `job_title`, `from`, `to`, `job_description`, `user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'arham', 'php', '2021-03-29', '2021-03-30', 'TEST', 3, 1, '2021-03-30 23:15:34', '2021-03-30 23:15:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_payments`
--
ALTER TABLE `bill_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_products`
--
ALTER TABLE `bill_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calender_schedules`
--
ALTER TABLE `calender_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_account_sub_types`
--
ALTER TABLE `chart_of_account_sub_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_account_types`
--
ALTER TABLE `chart_of_account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_details_company_id_foreign` (`company_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contacts_email_unique` (`email`);

--
-- Indexes for table `contacts_companies`
--
ALTER TABLE `contacts_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_details_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `contact_groups`
--
ALTER TABLE `contact_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_details_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_items`
--
ALTER TABLE `journal_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_comments`
--
ALTER TABLE `performance_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_goals`
--
ALTER TABLE `performance_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_reviews`
--
ALTER TABLE `performance_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_and_services`
--
ALTER TABLE `product_and_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_users`
--
ALTER TABLE `project_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal_products`
--
ALTER TABLE `proposal_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_created_by_unique` (`name`,`created_by`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_checklists`
--
ALTER TABLE `task_checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_comments`
--
ALTER TABLE `task_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_files`
--
ALTER TABLE `task_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_stages`
--
ALTER TABLE `task_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxrates`
--
ALTER TABLE `taxrates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `vendor_details`
--
ALTER TABLE `vendor_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_details_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill_payments`
--
ALTER TABLE `bill_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill_products`
--
ALTER TABLE `bill_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `calender_schedules`
--
ALTER TABLE `calender_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `chart_of_account_sub_types`
--
ALTER TABLE `chart_of_account_sub_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `chart_of_account_types`
--
ALTER TABLE `chart_of_account_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts_companies`
--
ALTER TABLE `contacts_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_groups`
--
ALTER TABLE `contact_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `journal_items`
--
ALTER TABLE `journal_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performance_comments`
--
ALTER TABLE `performance_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `performance_goals`
--
ALTER TABLE `performance_goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `performance_reviews`
--
ALTER TABLE `performance_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_and_services`
--
ALTER TABLE `product_and_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_tasks`
--
ALTER TABLE `project_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_users`
--
ALTER TABLE `project_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proposal_products`
--
ALTER TABLE `proposal_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_checklists`
--
ALTER TABLE `task_checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_comments`
--
ALTER TABLE `task_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_files`
--
ALTER TABLE `task_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_stages`
--
ALTER TABLE `task_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxrates`
--
ALTER TABLE `taxrates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_details`
--
ALTER TABLE `vendor_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_details`
--
ALTER TABLE `company_details`
  ADD CONSTRAINT `company_details_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD CONSTRAINT `contact_details_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD CONSTRAINT `customer_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_details`
--
ALTER TABLE `vendor_details`
  ADD CONSTRAINT `vendor_details_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
