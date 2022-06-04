DROP TABLE IF EXISTS branches;

CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO branches VALUES('1','Zvishavane','admin@financialseasonscredit.com','+263774613398','Suite 6, 3/4 Ireland Road, Zvishavane','Your Seasoned Financial Partner','2022-02-04 12:17:54','2022-02-04 12:17:54','');
INSERT INTO branches VALUES('2','Gweru','edwin@gmail.com','n/a','n/a','','2022-03-02 09:53:24','2022-03-02 10:01:38','2022-03-02 10:01:38');



DROP TABLE IF EXISTS currency;

CREATE TABLE `currency` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(10,6) NOT NULL,
  `base_currency` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO currency VALUES('1','USD','1.000000','1','1','','2022-03-02 07:24:19','');
INSERT INTO currency VALUES('2','ZAR','15.300000','0','0','2022-03-02 07:21:36','2022-03-02 09:32:19','');



DROP TABLE IF EXISTS database_backups;

CREATE TABLE `database_backups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO database_backups VALUES('1','DB-BACKUP-1643965260.sql','1','2022-02-04 11:01:00','2022-02-04 11:01:00');
INSERT INTO database_backups VALUES('2','DB-BACKUP-1646192831.sql','1','2022-03-02 05:47:11','2022-03-02 05:47:11');



DROP TABLE IF EXISTS deposit_methods;

CREATE TABLE `deposit_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deposit_methods VALUES('1','Bank','1646198234logo (1).png','1','100.00','1020.00','0.00','1.00','This is to test deposit by bank investors','1','null','2022-03-02 07:17:14','2022-03-02 08:33:18','');



DROP TABLE IF EXISTS deposit_requests;

CREATE TABLE `deposit_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `method_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `transaction_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deposit_requests VALUES('1','2','1','1010.00','My money','null','1646232142New Project (5).png','1','','2022-03-02 16:42:22','2022-03-02 16:42:22');



DROP TABLE IF EXISTS email_templates;

CREATE TABLE `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS faq_translations;

CREATE TABLE `faq_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `faq_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faq_translations_faq_id_locale_unique` (`faq_id`,`locale`),
  CONSTRAINT `faq_translations_faq_id_foreign` FOREIGN KEY (`faq_id`) REFERENCES `faqs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO faq_translations VALUES('1','1','English','How to open an account?','Account opening is very easy. Just need to click Sign Up and enter some initial details for opening account. After that you need to verify your email address and that\'s ready to go.','2021-08-31 10:07:50','2021-09-05 15:37:10');
INSERT INTO faq_translations VALUES('2','2','English','How to deposit money?','You can deposit money via online payment gateway such as PayPal, Stripe, Razorpay, Paystack, Flutterwave as well as BlockChain for bitcoin. You can also deposit money by coming to our office physically.','2021-08-31 10:09:26','2021-09-05 15:38:39');
INSERT INTO faq_translations VALUES('3','3','English','How to withdraw money from my account?','We have different types of withdraw method. You can withdraw money to your bank account as well as your mobile banking account.','2021-08-31 10:09:39','2021-09-05 15:47:11');
INSERT INTO faq_translations VALUES('7','4','English','How to Apply for Loan?','You can apply loan based on your collateral.','2021-09-05 15:47:59','2021-09-05 15:47:59');
INSERT INTO faq_translations VALUES('8','5','English','How to Apply for Fixed Deposit?','If you have available balance in your account then you can apply for fixed deposit.','2021-09-05 15:58:05','2021-09-05 15:58:05');



DROP TABLE IF EXISTS faqs;

CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO faqs VALUES('1','1','','2021-08-31 10:06:18','2021-08-31 10:06:18');
INSERT INTO faqs VALUES('2','1','','2021-08-31 10:09:26','2021-08-31 10:09:26');
INSERT INTO faqs VALUES('3','1','','2021-08-31 10:09:39','2021-08-31 10:09:39');
INSERT INTO faqs VALUES('4','1','','2021-09-05 15:47:59','2021-09-05 15:47:59');
INSERT INTO faqs VALUES('5','1','','2021-09-05 15:58:05','2021-09-05 15:58:05');



DROP TABLE IF EXISTS fdr_plans;

CREATE TABLE `fdr_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `interest_rate` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `duration_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO fdr_plans VALUES('1','Basic','10.00','500.00','8.00','12','month','1','','2021-08-09 14:34:14','2021-09-05 13:39:27');
INSERT INTO fdr_plans VALUES('2','Standard','100.00','1000.00','10.00','24','month','1','','2021-09-05 13:39:11','2021-09-05 13:39:34');
INSERT INTO fdr_plans VALUES('3','Professional','500.00','20000.00','15.00','36','month','1','','2021-09-05 13:40:06','2021-09-05 13:40:06');



DROP TABLE IF EXISTS fdrs;

CREATE TABLE `fdrs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fdr_plan_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) unsigned NOT NULL,
  `deposit_amount` decimal(10,2) NOT NULL,
  `return_amount` decimal(10,2) NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_date` date DEFAULT NULL,
  `mature_date` date DEFAULT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `approved_user_id` bigint(20) DEFAULT NULL,
  `created_user_id` bigint(20) DEFAULT NULL,
  `updated_user_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO fdrs VALUES('1','1','2','1','100.00','108.00','','I want to invest','3','2022-03-02','2023-03-02','9','1','2','1','1','2022-03-02 10:59:22','2022-03-02 16:20:54');



DROP TABLE IF EXISTS gift_cards;

CREATE TABLE `gift_cards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `used_at` datetime DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO gift_cards VALUES('1','QZ36-S5F0-L053-Q7QS','1','100.00','1','2','2022-03-02 10:54:09','1','2022-03-02 10:14:44','2022-03-02 10:54:09');



DROP TABLE IF EXISTS loan_collaterals;

CREATE TABLE `loan_collaterals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `collateral_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_price` decimal(10,2) NOT NULL,
  `attachments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS loan_payments;

CREATE TABLE `loan_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) NOT NULL,
  `paid_at` date NOT NULL,
  `late_penalties` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `repayment_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO loan_payments VALUES('1','1','2022-03-02','10.00','0.21','4.38','','2','7','1','2022-03-02 07:43:09','2022-03-02 07:43:09');



DROP TABLE IF EXISTS loan_products;

CREATE TABLE `loan_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest_rate` decimal(10,2) NOT NULL,
  `interest_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` int(11) NOT NULL,
  `term_period` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO loan_products VALUES('1','Student Loan','100.00','1000.00','','5.00','flat_rate','24','+1 month','1','2021-08-09 11:06:19','2021-08-10 07:47:20');
INSERT INTO loan_products VALUES('2','Business Loan','1000.00','100000.00','','12.00','mortgage','12','+1 month','1','2021-08-09 11:05:37','2021-08-10 07:47:10');
INSERT INTO loan_products VALUES('3','Enterprise Loan','5000.00','50000.00','','12.00','mortgage','36','+1 month','1','2021-09-05 13:42:11','2021-09-05 13:42:11');



DROP TABLE IF EXISTS loan_repayments;

CREATE TABLE `loan_repayments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) NOT NULL,
  `repayment_date` date NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `principal_amount` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO loan_repayments VALUES('1','1','2022-02-25','4.38','10.00','4.17','0.21','100.63','1','2022-02-04 12:34:56','2022-03-02 07:43:09');
INSERT INTO loan_repayments VALUES('2','1','2022-03-25','4.38','10.00','4.17','0.21','96.25','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('3','1','2022-04-25','4.38','10.00','4.17','0.21','91.88','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('4','1','2022-05-25','4.38','10.00','4.17','0.21','87.50','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('5','1','2022-06-25','4.38','10.00','4.17','0.21','83.13','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('6','1','2022-07-25','4.38','10.00','4.17','0.21','78.75','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('7','1','2022-08-25','4.38','10.00','4.17','0.21','74.38','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('8','1','2022-09-25','4.38','10.00','4.17','0.21','70.00','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('9','1','2022-10-25','4.38','10.00','4.17','0.21','65.63','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('10','1','2022-11-25','4.38','10.00','4.17','0.21','61.25','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('11','1','2022-12-25','4.38','10.00','4.17','0.21','56.88','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('12','1','2023-01-25','4.38','10.00','4.17','0.21','52.50','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('13','1','2023-02-25','4.38','10.00','4.17','0.21','48.13','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('14','1','2023-03-25','4.38','10.00','4.17','0.21','43.75','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('15','1','2023-04-25','4.38','10.00','4.17','0.21','39.38','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('16','1','2023-05-25','4.38','10.00','4.17','0.21','35.00','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('17','1','2023-06-25','4.38','10.00','4.17','0.21','30.63','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('18','1','2023-07-25','4.38','10.00','4.17','0.21','26.25','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('19','1','2023-08-25','4.38','10.00','4.17','0.21','21.88','0','2022-02-04 12:34:56','2022-02-04 12:34:56');
INSERT INTO loan_repayments VALUES('20','1','2023-09-25','4.38','10.00','4.17','0.21','17.50','0','2022-02-04 12:34:57','2022-02-04 12:34:57');
INSERT INTO loan_repayments VALUES('21','1','2023-10-25','4.38','10.00','4.17','0.21','13.13','0','2022-02-04 12:34:57','2022-02-04 12:34:57');
INSERT INTO loan_repayments VALUES('22','1','2023-11-25','4.38','10.00','4.17','0.21','8.75','0','2022-02-04 12:34:57','2022-02-04 12:34:57');
INSERT INTO loan_repayments VALUES('23','1','2023-12-25','4.38','10.00','4.17','0.21','4.38','0','2022-02-04 12:34:57','2022-02-04 12:34:57');
INSERT INTO loan_repayments VALUES('24','1','2024-01-25','4.38','10.00','4.17','0.21','0.00','0','2022-02-04 12:34:57','2022-02-04 12:34:57');
INSERT INTO loan_repayments VALUES('25','2','2022-03-31','177.70','0.00','157.70','20.00','1842.30','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('26','2','2022-05-01','177.70','0.00','159.27','18.42','1683.03','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('27','2','2022-06-01','177.70','0.00','160.87','16.83','1522.16','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('28','2','2022-07-01','177.70','0.00','162.48','15.22','1359.68','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('29','2','2022-08-01','177.70','0.00','164.10','13.60','1195.58','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('30','2','2022-09-01','177.70','0.00','165.74','11.96','1029.84','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('31','2','2022-10-01','177.70','0.00','167.40','10.30','862.44','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('32','2','2022-11-01','177.70','0.00','169.07','8.62','693.37','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('33','2','2022-12-01','177.70','0.00','170.76','6.93','522.61','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('34','2','2023-01-01','177.70','0.00','172.47','5.23','350.13','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('35','2','2023-02-01','177.70','0.00','174.20','3.50','175.94','0','2022-03-02 17:05:00','2022-03-02 17:05:00');
INSERT INTO loan_repayments VALUES('36','2','2023-03-01','177.70','0.00','175.94','1.76','0.00','0','2022-03-02 17:05:00','2022-03-02 17:05:00');



DROP TABLE IF EXISTS loans;

CREATE TABLE `loans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_product_id` bigint(20) unsigned NOT NULL,
  `borrower_id` bigint(20) unsigned NOT NULL,
  `first_payment_date` date NOT NULL,
  `release_date` date DEFAULT NULL,
  `currency_id` bigint(20) NOT NULL,
  `applied_amount` decimal(10,2) NOT NULL,
  `total_payable` decimal(10,2) DEFAULT NULL,
  `total_paid` decimal(10,2) DEFAULT NULL,
  `late_payment_penalties` decimal(10,2) NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_date` date DEFAULT NULL,
  `approved_user_id` bigint(20) DEFAULT NULL,
  `created_user_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO loans VALUES('1','123','1','2','2022-02-25','2022-02-04','1','100.00','105.00','4.38','10.00','1643970889Liberty Mutabvuri CV.pdf','Must pay from Mimosa','','1','2022-02-04','1','1','','2022-02-04 12:34:49','2022-03-02 07:43:09');
INSERT INTO loans VALUES('2','1245','2','2','2022-03-31','2022-03-02','1','2000.00','2132.37','','0.00','1646199923rain_statement.pdf','','','1','2022-03-02','1','2','','2022-03-02 07:45:23','2022-03-02 17:05:00');



DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('1','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('2','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('3','2018_11_12_152015_create_email_templates_table','1');
INSERT INTO migrations VALUES('4','2019_08_19_000000_create_failed_jobs_table','1');
INSERT INTO migrations VALUES('5','2019_09_01_080940_create_settings_table','1');
INSERT INTO migrations VALUES('6','2020_07_02_145857_create_database_backups_table','1');
INSERT INTO migrations VALUES('7','2020_07_06_142817_create_roles_table','1');
INSERT INTO migrations VALUES('8','2020_07_06_143240_create_permissions_table','1');
INSERT INTO migrations VALUES('9','2021_03_22_071324_create_setting_translations','1');
INSERT INTO migrations VALUES('10','2021_07_02_145504_create_pages_table','1');
INSERT INTO migrations VALUES('11','2021_07_02_145952_create_page_translations_table','1');
INSERT INTO migrations VALUES('12','2021_08_06_104648_create_branches_table','1');
INSERT INTO migrations VALUES('13','2021_08_07_100944_create_other_banks_table','1');
INSERT INTO migrations VALUES('14','2021_08_07_111236_create_currency_table','1');
INSERT INTO migrations VALUES('15','2021_08_08_132702_create_payment_gateways_table','1');
INSERT INTO migrations VALUES('16','2021_08_08_152535_create_deposit_methods_table','1');
INSERT INTO migrations VALUES('17','2021_08_08_164152_create_withdraw_methods_table','1');
INSERT INTO migrations VALUES('18','2021_08_09_064023_create_transactions_table','1');
INSERT INTO migrations VALUES('19','2021_08_09_132854_create_fdr_plans_table','1');
INSERT INTO migrations VALUES('20','2021_08_10_075622_create_gift_cards_table','1');
INSERT INTO migrations VALUES('21','2021_08_10_095536_create_fdrs_table','1');
INSERT INTO migrations VALUES('22','2021_08_10_102503_create_support_tickets_table','1');
INSERT INTO migrations VALUES('23','2021_08_10_102527_create_support_ticket_messages_table','1');
INSERT INTO migrations VALUES('24','2021_08_20_092846_create_payment_requests_table','1');
INSERT INTO migrations VALUES('25','2021_08_20_150101_create_deposit_requests_table','1');
INSERT INTO migrations VALUES('26','2021_08_20_160124_create_withdraw_requests_table','1');
INSERT INTO migrations VALUES('27','2021_08_23_160216_create_notifications_table','1');
INSERT INTO migrations VALUES('28','2021_08_31_070908_create_services_table','1');
INSERT INTO migrations VALUES('29','2021_08_31_071002_create_service_translations_table','1');
INSERT INTO migrations VALUES('30','2021_08_31_075115_create_news_table','1');
INSERT INTO migrations VALUES('31','2021_08_31_075125_create_news_translations_table','1');
INSERT INTO migrations VALUES('32','2021_08_31_094252_create_faqs_table','1');
INSERT INTO migrations VALUES('33','2021_08_31_094301_create_faq_translations_table','1');
INSERT INTO migrations VALUES('34','2021_08_31_101309_create_testimonials_table','1');
INSERT INTO migrations VALUES('35','2021_08_31_101319_create_testimonial_translations_table','1');
INSERT INTO migrations VALUES('36','2021_08_31_201125_create_navigations_table','1');
INSERT INTO migrations VALUES('37','2021_08_31_201126_create_navigation_items_table','1');
INSERT INTO migrations VALUES('38','2021_08_31_201127_create_navigation_item_translations_table','1');
INSERT INTO migrations VALUES('39','2021_09_04_142110_create_teams_table','1');
INSERT INTO migrations VALUES('40','2021_10_04_082019_create_loan_products_table','1');
INSERT INTO migrations VALUES('41','2021_10_06_070947_create_loans_table','1');
INSERT INTO migrations VALUES('42','2021_10_06_071153_create_loan_collaterals_table','1');
INSERT INTO migrations VALUES('43','2021_10_12_104151_create_loan_repayments_table','1');
INSERT INTO migrations VALUES('44','2021_10_14_065743_create_loan_payments_table','1');
INSERT INTO migrations VALUES('45','2022_03_02_030855_add_softdeletes_to_users_table','2');
INSERT INTO migrations VALUES('46','2022_03_02_062904_add_softdeletes_to_withdraw_methods_table','3');
INSERT INTO migrations VALUES('47','2022_03_02_063154_add_softdeletes_to_deposit_methods_table','4');
INSERT INTO migrations VALUES('48','2022_03_02_073125_add_softdeletes_to_currency_table','5');
INSERT INTO migrations VALUES('49','2022_03_02_073447_add_softdeletes_to_other_banks_table','6');
INSERT INTO migrations VALUES('50','2022_03_02_075532_add_softdeletes_to_branches_table','7');



DROP TABLE IF EXISTS navigation_item_translations;

CREATE TABLE `navigation_item_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_item_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `navigation_item_translations_navigation_item_id_locale_unique` (`navigation_item_id`,`locale`),
  CONSTRAINT `navigation_item_translations_navigation_item_id_foreign` FOREIGN KEY (`navigation_item_id`) REFERENCES `navigation_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO navigation_item_translations VALUES('6','6','English','Home','2021-08-31 17:17:46','2021-08-31 17:17:46');
INSERT INTO navigation_item_translations VALUES('7','7','English','About','2021-08-31 17:17:58','2021-08-31 17:17:58');
INSERT INTO navigation_item_translations VALUES('8','8','English','Services','2021-08-31 17:18:44','2021-08-31 17:18:44');
INSERT INTO navigation_item_translations VALUES('10','10','English','FAQ','2021-08-31 17:19:27','2021-08-31 17:19:27');
INSERT INTO navigation_item_translations VALUES('11','11','English','Contact','2021-08-31 17:19:43','2021-08-31 17:19:43');
INSERT INTO navigation_item_translations VALUES('15','15','English','Contact','2021-08-31 18:12:42','2021-09-04 16:22:15');
INSERT INTO navigation_item_translations VALUES('26','20','English','About','2021-09-04 16:21:32','2021-09-04 16:21:32');
INSERT INTO navigation_item_translations VALUES('27','21','English','Services','2021-09-04 16:22:06','2021-09-04 16:22:06');
INSERT INTO navigation_item_translations VALUES('28','22','English','Terms & Condition','2021-09-04 16:22:58','2021-09-04 16:22:58');
INSERT INTO navigation_item_translations VALUES('29','23','English','Privacy Policy','2021-09-04 16:23:10','2021-09-04 16:23:10');
INSERT INTO navigation_item_translations VALUES('30','24','English','FAQ','2021-09-04 16:23:20','2021-09-04 16:23:20');



DROP TABLE IF EXISTS navigation_items;

CREATE TABLE `navigation_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_id` bigint(20) unsigned NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` bigint(20) unsigned DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `css_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `navigation_items_parent_id_foreign` (`parent_id`),
  KEY `navigation_items_page_id_foreign` (`page_id`),
  KEY `navigation_items_navigation_id_index` (`navigation_id`),
  CONSTRAINT `navigation_items_navigation_id_foreign` FOREIGN KEY (`navigation_id`) REFERENCES `navigations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `navigation_items_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `navigation_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `navigation_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO navigation_items VALUES('6','1','dynamic_url','','/','','_self','','1','1','','','2021-08-31 17:17:46','2021-08-31 17:28:52');
INSERT INTO navigation_items VALUES('7','1','dynamic_url','','/about','','_self','','2','1','','','2021-08-31 17:17:58','2021-08-31 17:28:52');
INSERT INTO navigation_items VALUES('8','1','dynamic_url','','/services','','_self','','3','1','','','2021-08-31 17:18:44','2021-08-31 17:28:52');
INSERT INTO navigation_items VALUES('10','1','dynamic_url','','faq','','_self','','4','1','','','2021-08-31 17:19:27','2021-09-04 16:20:28');
INSERT INTO navigation_items VALUES('11','1','dynamic_url','','/contact','','_self','','5','1','','','2021-08-31 17:19:43','2021-09-04 16:20:28');
INSERT INTO navigation_items VALUES('15','2','dynamic_url','','/contact','','_self','','1','1','','','2021-08-31 18:12:42','2021-09-04 16:22:17');
INSERT INTO navigation_items VALUES('20','2','dynamic_url','','/about','','_self','','2','1','','','2021-09-04 16:21:32','2021-09-04 16:22:17');
INSERT INTO navigation_items VALUES('21','2','dynamic_url','','/services','','_self','','3','1','','','2021-09-04 16:22:06','2021-09-04 16:22:17');
INSERT INTO navigation_items VALUES('22','3','page','2','','','_self','','2','1','','','2021-09-04 16:22:58','2021-09-04 16:23:26');
INSERT INTO navigation_items VALUES('23','3','page','1','','','_self','','1','1','','','2021-09-04 16:23:10','2021-09-04 16:23:26');
INSERT INTO navigation_items VALUES('24','3','dynamic_url','','/faq','','_self','','3','1','','','2021-09-04 16:23:20','2021-09-04 16:23:26');



DROP TABLE IF EXISTS navigations;

CREATE TABLE `navigations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO navigations VALUES('1','Primary Menu','1','2021-08-31 11:11:31','2021-08-31 11:11:31');
INSERT INTO navigations VALUES('2','Quick Explore','1','2021-08-31 18:11:36','2021-08-31 18:11:36');
INSERT INTO navigations VALUES('3','Pages','1','2021-08-31 18:11:43','2021-09-04 16:22:30');



DROP TABLE IF EXISTS news;

CREATE TABLE `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS news_translations;

CREATE TABLE `news_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_translations_news_id_locale_unique` (`news_id`,`locale`),
  CONSTRAINT `news_translations_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS notifications;

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS other_banks;

CREATE TABLE `other_banks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `swift_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_currency` bigint(20) NOT NULL,
  `minimum_transfer_amount` decimal(10,2) NOT NULL,
  `maximum_transfer_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO other_banks VALUES('1','CABS','555','Zimbabwe','1','10.00','50000.00','0.00','2.00','Please contact us after making your payment','1','2022-02-04 12:19:17','2022-02-04 12:19:17','');



DROP TABLE IF EXISTS page_translations;

CREATE TABLE `page_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_translations_page_id_locale_unique` (`page_id`,`locale`),
  CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO page_translations VALUES('1','1','English','Privacy Policy','<h1>Privacy Policy for Livo Bank</h1>
<p>At LivoBank, accessible from https://livo-bank.trickycode.xyz, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by LivoBank and how we use it.</p>
<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>
<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in LivoBank. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the <a href=\"https://www.termsfeed.com/privacy-policy-generator/\">TermsFeed Privacy Policy Generator</a>.</p>
<h2>Consent</h2>
<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>
<h2>Information we collect</h2>
<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>
<h2>How we use your information</h2>
<p>We use the information we collect in various ways, including to:</p>
<ul>
<li>Provide, operate, and maintain our website</li>
<li>Improve, personalize, and expand our website</li>
<li>Understand and analyze how you use our website</li>
<li>Develop new products, services, features, and functionality</li>
<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
<li>Send you emails</li>
<li>Find and prevent fraud</li>
</ul>
<h2>Log Files</h2>
<p>LivoBank follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services\' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users\' movement on the website, and gathering demographic information.</p>
<h2>Advertising Partners Privacy Policies</h2>
<p>You may consult this list to find the Privacy Policy for each of the advertising partners of LivoBank.</p>
<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on LivoBank, which are sent directly to users\' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>
<p>Note that LivoBank has no access to or control over these cookies that are used by third-party advertisers.</p>
<h2>Third Party Privacy Policies</h2>
<p>LivoBank\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.</p>
<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers\' respective websites.</p>
<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>
<p>Under the CCPA, among other rights, California consumers have the right to:</p>
<p>Request that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
<p>Request that a business delete any personal data about the consumer that a business has collected.</p>
<p>Request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>
<h2>GDPR Data Protection Rights</h2>
<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
<p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
<p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
<p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
<p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
<p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
<p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>
<h2>Children\'s Information</h2>
<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>
<p>LivoBank does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>','2021-08-31 10:42:32','2021-09-05 14:27:37');
INSERT INTO page_translations VALUES('2','2','English','Terms & Condition','<h2><strong>Terms and Conditions</strong></h2>
<p>Welcome to LivoBank!</p>
<p>These terms and conditions outline the rules and regulations for the use of Livo Bank\'s Website, located at https://livo-bank.trickycode.xyz.</p>
<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use LivoBank if you do not agree to take all of the terms and conditions stated on this page.</p>
<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company’s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>
<h3><strong>Cookies</strong></h3>
<p>We employ the use of cookies. By accessing LivoBank, you agreed to use cookies in agreement with the Livo Bank\'s Privacy Policy.</p>
<p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>
<h3><strong>License</strong></h3>
<p>Unless otherwise stated, Livo Bank and/or its licensors own the intellectual property rights for all material on LivoBank. All intellectual property rights are reserved. You may access this from LivoBank for your own personal use subjected to restrictions set in these terms and conditions.</p>
<p>You must not:</p>
<ul>
<li>Republish material from LivoBank</li>
<li>Sell, rent or sub-license material from LivoBank</li>
<li>Reproduce, duplicate or copy material from LivoBank</li>
<li>Redistribute content from LivoBank</li>
</ul>
<p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the <a href=\"https://www.termsandconditionsgenerator.com\">Terms And Conditions Generator</a>.</p>
<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Livo Bank does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Livo Bank,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Livo Bank shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>
<p>Livo Bank reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>
<p>You warrant and represent that:</p>
<ul>
<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
</ul>
<p>You hereby grant Livo Bank a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>
<h3><strong>Hyperlinking to our Content</strong></h3>
<p>The following organizations may link to our Website without prior written approval:</p>
<ul>
<li>Government agencies;</li>
<li>Search engines;</li>
<li>News organizations;</li>
<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
</ul>
<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>
<p>We may consider and approve other link requests from the following types of organizations:</p>
<ul>
<li>commonly-known consumer and/or business information sources;</li>
<li>dot.com community sites;</li>
<li>associations or other groups representing charities;</li>
<li>online directory distributors;</li>
<li>internet portals;</li>
<li>accounting, law and consulting firms; and</li>
<li>educational institutions and trade associations.</li>
</ul>
<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Livo Bank; and (d) the link is in the context of general resource information.</p>
<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>
<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Livo Bank. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>
<p>Approved organizations may hyperlink to our Website as follows:</p>
<ul>
<li>By use of our corporate name; or</li>
<li>By use of the uniform resource locator being linked to; or</li>
<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>
</ul>
<p>No use of Livo Bank\'s logo or other artwork will be allowed for linking absent a trademark license agreement.</p>
<h3><strong>iFrames</strong></h3>
<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>
<h3><strong>Content Liability</strong></h3>
<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>
<h3><strong>Your Privacy</strong></h3>
<p>Please read Privacy Policy</p>
<h3><strong>Reservation of Rights</strong></h3>
<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>
<h3><strong>Removal of links from our website</strong></h3>
<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>
<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>
<h3><strong>Disclaimer</strong></h3>
<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>
<ul>
<li>limit or exclude our or your liability for death or personal injury;</li>
<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
</ul>
<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>
<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>','2021-08-31 10:44:42','2021-09-05 14:34:10');



DROP TABLE IF EXISTS pages;

CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO pages VALUES('1','privacy-policy','1','2021-08-31 10:42:32','2021-08-31 10:42:32');
INSERT INTO pages VALUES('2','terms-condition','1','2021-08-31 10:44:42','2021-08-31 10:44:42');



DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS payment_gateways;

CREATE TABLE `payment_gateways` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` decimal(10,6) DEFAULT NULL,
  `fixed_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `charge_in_percentage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `minimum_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `maximum_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS payment_requests;

CREATE TABLE `payment_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `currency_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS permissions;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) NOT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO permissions VALUES('14','2','dashboard.pending_tickets_widget','2022-03-02 07:23:38','2022-03-02 07:23:38');
INSERT INTO permissions VALUES('15','2','dashboard.deposit_requests_widget','2022-03-02 07:23:38','2022-03-02 07:23:38');
INSERT INTO permissions VALUES('16','2','dashboard.withdraw_requests_widget','2022-03-02 07:23:38','2022-03-02 07:23:38');
INSERT INTO permissions VALUES('17','2','dashboard.loan_requests_widget','2022-03-02 07:23:38','2022-03-02 07:23:38');
INSERT INTO permissions VALUES('18','2','dashboard.fdr_requests_widget','2022-03-02 07:23:38','2022-03-02 07:23:38');
INSERT INTO permissions VALUES('19','2','dashboard.wire_transfer_widget','2022-03-02 07:23:38','2022-03-02 07:23:38');
INSERT INTO permissions VALUES('20','2','dashboard.total_deposit_widget','2022-03-02 07:23:38','2022-03-02 07:23:38');



DROP TABLE IF EXISTS roles;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES('1','System Admin','Run the system','2022-02-04 12:23:46','2022-02-04 12:23:46');
INSERT INTO roles VALUES('2','Loans Officer','Disburse loans and make repayments','2022-03-02 09:02:10','2022-03-02 09:02:10');



DROP TABLE IF EXISTS service_translations;

CREATE TABLE `service_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_translations_service_id_locale_unique` (`service_id`,`locale`),
  CONSTRAINT `service_translations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO service_translations VALUES('1','2','English','Money Transfer','Paragraph of text beneath the heading to explain the heading.','2021-08-31 07:34:38','2021-08-31 07:34:38');
INSERT INTO service_translations VALUES('2','3','English','Multi Currency','Paragraph of text beneath the heading to explain the heading.','2021-08-31 07:35:33','2021-09-05 11:34:07');
INSERT INTO service_translations VALUES('3','4','English','Exchange Currency','Paragraph of text beneath the heading to explain the heading.','2021-08-31 07:38:26','2021-08-31 07:38:26');
INSERT INTO service_translations VALUES('4','5','English','Fixed Deposit','Paragraph of text beneath the heading to explain the heading.','2021-08-31 07:38:44','2021-08-31 07:38:44');
INSERT INTO service_translations VALUES('5','6','English','Apply Loan','Paragraph of text beneath the heading to explain the heading.','2021-08-31 07:39:01','2021-08-31 07:39:01');
INSERT INTO service_translations VALUES('6','7','English','Payment Request','Paragraph of text beneath the heading to explain the heading.','2021-08-31 07:39:19','2021-08-31 07:50:50');



DROP TABLE IF EXISTS services;

CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO services VALUES('2','<i class=\"icofont-paper-plane\"></i>','2021-08-31 07:34:38','2021-09-05 15:33:22');
INSERT INTO services VALUES('3','<i class=\"icofont-money\"></i>','2021-08-31 07:35:33','2021-09-05 11:29:47');
INSERT INTO services VALUES('4','<i class=\"icofont-exchange\"></i>','2021-08-31 07:38:26','2021-09-05 11:30:04');
INSERT INTO services VALUES('5','<i class=\"icofont-bank-alt\"></i>','2021-08-31 07:38:44','2021-09-05 11:30:19');
INSERT INTO services VALUES('6','<i class=\"icofont-file-text\"></i>','2021-08-31 07:39:01','2021-09-05 11:30:32');
INSERT INTO services VALUES('7','<i class=\"icofont-pay\"></i>','2021-08-31 07:39:19','2021-09-05 11:30:43');



DROP TABLE IF EXISTS setting_translations;

CREATE TABLE `setting_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `setting_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_translations_setting_id_locale_unique` (`setting_id`,`locale`),
  CONSTRAINT `setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES('1','company_name','Financial Seasons Credit','2022-02-04 06:42:07','2022-03-02 05:45:10');
INSERT INTO settings VALUES('2','site_title','Financial Seasons Credit','2022-02-04 06:42:07','2022-03-02 05:45:10');
INSERT INTO settings VALUES('3','phone','+263 774 613 398','2022-02-04 06:42:07','2022-03-02 05:45:11');
INSERT INTO settings VALUES('4','email','support@financialseasonscredit.com','2022-02-04 06:42:07','2022-03-02 05:45:11');
INSERT INTO settings VALUES('5','timezone','Africa/Harare','2022-02-04 06:42:07','2022-03-02 05:45:11');
INSERT INTO settings VALUES('38','main_heading','Smart way to keep your money safe and secure','2021-08-31 15:38:10','2021-09-05 11:47:17');
INSERT INTO settings VALUES('39','sub_heading','Transfer money within minutes and save money for your future. All of your desired service in single platform.','2021-08-31 15:39:15','2021-09-05 11:47:17');
INSERT INTO settings VALUES('40','about_us','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-08-31 15:39:15','2021-08-31 15:57:30');
INSERT INTO settings VALUES('41','copyright','Copyright © 2021 <a href=\"#\" target=\"_blank\">Tricky Code</a>  -  All Rights Reserved.','2021-08-31 15:39:15','2021-09-05 11:24:45');
INSERT INTO settings VALUES('46','meta_keywords','','2021-08-31 15:39:15','2021-08-31 15:39:15');
INSERT INTO settings VALUES('47','meta_content','','2021-08-31 15:39:15','2021-08-31 15:39:15');
INSERT INTO settings VALUES('48','our_mission','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.</p>','2021-08-31 15:54:44','2021-08-31 15:54:44');
INSERT INTO settings VALUES('49','footer_about_us','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-08-31 15:58:14','2021-09-05 11:24:45');
INSERT INTO settings VALUES('51','primary_menu','1','2021-08-31 17:30:14','2021-08-31 17:30:14');
INSERT INTO settings VALUES('52','footer_menu_1','2','2021-08-31 17:30:14','2021-08-31 18:13:31');
INSERT INTO settings VALUES('53','footer_menu_1_title','Quick Explore','2021-09-01 06:50:56','2021-09-01 06:50:56');
INSERT INTO settings VALUES('54','footer_menu_2_title','Pages','2021-09-01 06:50:56','2021-09-05 11:24:45');
INSERT INTO settings VALUES('55','footer_menu_2','3','2021-09-01 06:50:56','2021-09-01 06:50:56');
INSERT INTO settings VALUES('56','home_about_us_heading','About Us','2021-09-05 10:52:18','2021-09-05 10:54:38');
INSERT INTO settings VALUES('57','home_about_us','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-09-05 10:52:18','2021-09-05 10:52:18');
INSERT INTO settings VALUES('58','home_service_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 10:52:18','2021-09-05 11:12:10');
INSERT INTO settings VALUES('59','home_fixed_deposit_heading','Fixed Deposit Plans','2021-09-05 10:52:18','2021-09-05 11:19:41');
INSERT INTO settings VALUES('60','home_fixed_deposit_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 10:52:18','2021-09-05 11:19:41');
INSERT INTO settings VALUES('61','home_loan_heading','Loan Packages','2021-09-05 10:52:18','2021-09-05 11:19:41');
INSERT INTO settings VALUES('62','home_loan_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 10:52:18','2021-09-05 11:19:41');
INSERT INTO settings VALUES('63','home_testimonial_heading','We served over 500+ Customers','2021-09-05 10:52:18','2021-09-05 11:19:41');
INSERT INTO settings VALUES('64','home_testimonial_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 10:52:18','2021-09-05 11:19:41');
INSERT INTO settings VALUES('65','home_partner_heading','Partners who support us','2021-09-05 10:52:18','2021-09-05 11:19:41');
INSERT INTO settings VALUES('66','home_partner_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 10:52:18','2021-09-05 11:19:41');
INSERT INTO settings VALUES('67','home_about_us_content','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-09-05 10:54:15','2021-09-05 10:54:15');
INSERT INTO settings VALUES('68','home_service_heading','Our Services','2021-09-05 10:54:38','2021-09-05 11:12:10');
INSERT INTO settings VALUES('69','total_customer','500','2021-09-05 11:06:39','2021-09-05 11:08:10');
INSERT INTO settings VALUES('70','total_branch','5','2021-09-05 11:06:39','2021-09-05 11:11:53');
INSERT INTO settings VALUES('71','total_transactions','1','2021-09-05 11:06:39','2021-09-05 11:11:53');
INSERT INTO settings VALUES('72','total_countries','200','2021-09-05 11:06:39','2021-09-05 11:11:53');
INSERT INTO settings VALUES('73','about_page_title',' Who We Are','2021-09-05 15:07:18','2021-09-05 15:07:18');
INSERT INTO settings VALUES('74','our_team_title','Meet Our Team','2021-09-05 15:07:18','2021-09-05 15:07:18');
INSERT INTO settings VALUES('75','our_team_sub_title','Today’s users expect effortless experiences. Don’t let essential people and processes stay stuck in the past. Speed it up, skip the hassles','2021-09-05 15:07:18','2021-09-05 15:07:18');
INSERT INTO settings VALUES('76','about_us_content','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>','2021-09-05 15:08:15','2021-09-05 15:08:15');
INSERT INTO settings VALUES('77','language','English','2022-02-04 11:07:46','2022-03-02 05:45:11');
INSERT INTO settings VALUES('78','address','Suite 6, 3/4 Ireland Road, Zvishavane','2022-02-04 11:07:46','2022-03-02 05:45:11');
INSERT INTO settings VALUES('79','website_enable','no','2022-02-04 11:08:49','2022-03-02 05:53:00');
INSERT INTO settings VALUES('80','backend_direction','ltr','2022-02-04 11:08:50','2022-03-02 05:53:00');
INSERT INTO settings VALUES('81','currency_position','left','2022-02-04 11:08:51','2022-03-02 05:53:01');
INSERT INTO settings VALUES('82','date_format','m-d-Y','2022-02-04 11:08:51','2022-03-02 05:53:01');
INSERT INTO settings VALUES('83','time_format','24','2022-02-04 11:08:51','2022-03-02 05:53:01');
INSERT INTO settings VALUES('84','allow_singup','no','2022-02-04 11:08:51','2022-03-02 05:53:01');
INSERT INTO settings VALUES('85','email_verification','disabled','2022-02-04 11:08:51','2022-03-02 05:53:01');
INSERT INTO settings VALUES('86','mobile_verification','disabled','2022-02-04 11:08:51','2022-03-02 05:53:01');
INSERT INTO settings VALUES('87','mail_type','smtp','2022-02-04 11:12:01','2022-02-04 11:12:01');
INSERT INTO settings VALUES('88','from_email','support@fsc.co.zw','2022-02-04 11:12:01','2022-02-04 11:12:01');
INSERT INTO settings VALUES('89','from_name','FSC','2022-02-04 11:12:01','2022-02-04 11:12:01');
INSERT INTO settings VALUES('90','smtp_host','smtp.mailtrap.io','2022-02-04 11:12:01','2022-02-04 11:12:01');
INSERT INTO settings VALUES('91','smtp_port','587','2022-02-04 11:12:02','2022-02-04 11:12:02');
INSERT INTO settings VALUES('92','smtp_username','ddfa7acd5deaba','2022-02-04 11:12:02','2022-02-04 11:12:02');
INSERT INTO settings VALUES('93','smtp_password','2f55a3cd62675a','2022-02-04 11:12:02','2022-02-04 11:12:02');
INSERT INTO settings VALUES('94','smtp_encryption','tls','2022-02-04 11:12:02','2022-02-04 11:12:02');
INSERT INTO settings VALUES('95','logo','logo.png','2022-02-04 12:14:02','2022-02-04 12:14:02');
INSERT INTO settings VALUES('96','favicon','file_1643969644.png','2022-02-04 12:14:04','2022-02-04 12:14:04');
INSERT INTO settings VALUES('97','google_login','disabled','2022-03-02 05:55:25','2022-03-02 05:59:25');
INSERT INTO settings VALUES('98','GOOGLE_CLIENT_ID','','2022-03-02 05:55:26','2022-03-02 05:59:25');
INSERT INTO settings VALUES('99','GOOGLE_CLIENT_SECRET','','2022-03-02 05:55:26','2022-03-02 05:59:25');
INSERT INTO settings VALUES('100','facebook_login','enabled','2022-03-02 05:55:26','2022-03-02 05:59:25');
INSERT INTO settings VALUES('101','FACEBOOK_CLIENT_ID','149503318964787','2022-03-02 05:55:26','2022-03-02 05:59:25');
INSERT INTO settings VALUES('102','FACEBOOK_CLIENT_SECRET','mutabvuri$8','2022-03-02 05:55:26','2022-03-02 05:59:25');
INSERT INTO settings VALUES('103','enable_recaptcha','0','2022-03-02 06:08:41','2022-03-02 07:00:06');
INSERT INTO settings VALUES('104','recaptcha_site_key','6LcU4KseAAAAAA4jVepykLq2gAtstyUkll9cJ5ex','2022-03-02 06:08:42','2022-03-02 07:00:06');
INSERT INTO settings VALUES('105','recaptcha_secret_key','6LcU4KseAAAAALg0JFhHv2kEsTQ-d0wCN8Z0vBEB','2022-03-02 06:08:42','2022-03-02 07:00:06');



DROP TABLE IF EXISTS support_ticket_messages;

CREATE TABLE `support_ticket_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `support_ticket_id` bigint(20) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO support_ticket_messages VALUES('1','1','I can\'t see my balance update. What happened?','2','1646208364Forex_Traders_Cheat_Sheet.pdf','2022-03-02 10:06:04','2022-03-02 10:06:04');
INSERT INTO support_ticket_messages VALUES('2','1','Let me check for you','1','1646208691Modern Business Trading Investment Instagram Post.png','2022-03-02 10:11:31','2022-03-02 10:11:31');



DROP TABLE IF EXISTS support_tickets;

CREATE TABLE `support_tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `priority` tinyint(4) NOT NULL DEFAULT 0,
  `created_user_id` bigint(20) NOT NULL,
  `operator_id` bigint(20) DEFAULT NULL,
  `closed_user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO support_tickets VALUES('1','2','What happened','1','0','1','3','','2022-03-02 10:06:04','2022-03-02 10:10:47');



DROP TABLE IF EXISTS teams;

CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS testimonial_translations;

CREATE TABLE `testimonial_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `testimonial_translations_testimonial_id_locale_unique` (`testimonial_id`,`locale`),
  CONSTRAINT `testimonial_translations_testimonial_id_foreign` FOREIGN KEY (`testimonial_id`) REFERENCES `testimonials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS testimonials;

CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS transactions;

CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `currency_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `dr_cr` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_id` bigint(20) DEFAULT NULL,
  `ref_id` bigint(20) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `other_bank_id` bigint(20) DEFAULT NULL,
  `gateway_id` bigint(20) DEFAULT NULL,
  `created_user_id` bigint(20) DEFAULT NULL,
  `updated_user_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `transaction_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO transactions VALUES('1','2','1','600.00','0.00','cr','Deposit','Manual','2','Capital Injection','','','','','','1','','','','2022-02-04 12:31:39','2022-02-04 12:31:39');
INSERT INTO transactions VALUES('2','2','1','300.00','0.00','dr','Withdraw','Manual','2','Need cash','','','','','','1','','','','2022-02-04 12:32:39','2022-02-04 12:32:39');
INSERT INTO transactions VALUES('3','2','1','100.00','0.00','cr','Loan','Manual','2','Loan Approved','1','','','','','1','','','','2022-02-04 12:34:57','2022-02-04 12:34:57');
INSERT INTO transactions VALUES('4','2','1','10.00','0.00','cr','Deposit','Manual','2','Refund','','','','','','1','','','','2022-03-02 05:40:00','2022-03-02 05:40:00');
INSERT INTO transactions VALUES('5','2','1','1520.00','0.00','cr','Deposit','Manual','2','Refund plus interest','','','','','','1','','','','2022-03-02 05:40:50','2022-03-02 05:40:50');
INSERT INTO transactions VALUES('6','2','2','12000.00','0.00','cr','Deposit','Manual','2','','','','','','','1','','','','2022-03-02 07:22:39','2022-03-02 07:22:39');
INSERT INTO transactions VALUES('7','2','1','14.38','0.00','dr','Loan_Repayment','Online','2','Loan Repayment','1','','','','','2','','1','','2022-03-02 07:43:09','2022-03-02 07:43:09');
INSERT INTO transactions VALUES('8','2','1','100.00','0.00','cr','Deposit','GiftCard','2','Redeem Gift Card','','','','','','2','','1','','2022-03-02 10:54:09','2022-03-02 10:54:09');
INSERT INTO transactions VALUES('9','2','1','100.00','0.00','dr','Fixed_Deposit','Online','2','','','','','','','2','','1','','2022-03-02 10:59:21','2022-03-02 16:20:44');
INSERT INTO transactions VALUES('10','2','1','108.00','0.00','cr','Deposit','Online','2','Return of Fixed deposit','','','','','','1','','1','','2022-03-02 16:20:54','2022-03-02 16:20:54');
INSERT INTO transactions VALUES('11','2','1','450.00','0.00','dr','Withdraw','Manual','2','','','','','','','2','','1','','2022-03-02 16:59:11','2022-03-02 17:07:39');
INSERT INTO transactions VALUES('12','2','1','1224.00','24.00','dr','Wire_Transfer','Manual','2','Check Invest','','','','1','','2','','1','{\"account_number\":\"6688799709809900\",\"account_holder_name\":\"Liberty\"}','2022-03-02 17:02:07','2022-03-02 17:10:40');
INSERT INTO transactions VALUES('13','2','1','200.00','0.00','dr','Exchange','Online','2','Test exchange','','','','','','2','','1','','2022-03-02 17:02:39','2022-03-02 17:02:39');
INSERT INTO transactions VALUES('14','2','1','200.00','0.00','cr','Exchange','Online','2','Test exchange','','','13','','','2','','1','','2022-03-02 17:02:39','2022-03-02 17:02:39');
INSERT INTO transactions VALUES('15','2','1','2000.00','0.00','cr','Loan','Manual','2','Loan Approved','2','','','','','1','','','','2022-03-02 17:05:00','2022-03-02 17:05:00');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `sms_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Leereal','leereal08@ymail.com','774211493','admin','1','1','1','profile_1643970130.jpg','2022-02-04 06:39:48','','$2y$10$WuQOKIRotNAPW4F.lC8/BeERKQLZvt1UHsJhSrxYxYgKLUgFxWxmW','','','263','','2022-02-04 06:39:48','2022-03-02 08:36:30','');
INSERT INTO users VALUES('2','Jael Jayleen','jaeljayleen@gmail.com','+27691926852','customer','','1','1','1643970630pexels-andrea-piacquadio-874158.jpg','','','$2y$10$x2K8VNqVyhx3UQQdK9cusOoBneevn/f.RH9Gq2g9g.Mg4P92PSvCK','','','263','','2022-02-04 12:30:30','2022-02-04 12:30:30','');
INSERT INTO users VALUES('3','Edwin Mutangara','edwin@gmail.com','','user','2','','1','1646204222photo1632590200.jpeg','2022-03-02 08:57:02','','$2y$10$DFarc5EyXvtuWyFz.7FT0.EyswLJDqrVsTAIgNNwwqjFzwYTVNkni','','','','','2022-03-02 08:57:02','2022-03-02 09:01:26','');



DROP TABLE IF EXISTS withdraw_methods;

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO withdraw_methods VALUES('2','Ecocash','default.png','1','100.00','500.00','0.00','0.00','','1','null','2022-03-02 08:10:47','2022-03-02 08:30:19','');



DROP TABLE IF EXISTS withdraw_requests;

CREATE TABLE `withdraw_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `method_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `transaction_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO withdraw_requests VALUES('1','2','2','450.00','Need cash','null','1646233151carbon (1).png','2','11','2022-03-02 16:59:11','2022-03-02 17:07:39');



