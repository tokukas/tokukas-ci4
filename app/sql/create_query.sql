-- --------------------------------------------------------
-- TABLES CREATION
-- --------------------------------------------------------

--
-- Table structure for table `Variable`
-- *already executed
--

CREATE TABLE IF NOT EXISTS `Variable` (
    `id` INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `value` VARCHAR(255) NOT NULL
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Email_Verificator`
-- *already executed
--

CREATE TABLE IF NOT EXISTS `Email_Verificator` (
    `id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `code` TEXT NOT NULL,
    `verified` BOOLEAN NOT NULL DEFAULT FALSE,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Email`
-- *already executed
--

CREATE TABLE IF NOT EXISTS `Company_Email` (
    `id` INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(100) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `password` TEXT NOT NULL,
    `host` VARCHAR(255) NOT NULL,
    `protocol` VARCHAR(255) NOT NULL,
    `port` INTEGER NOT NULL,
    `crypto` VARCHAR(50) DEFAULT ''
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FAQ`
-- *already executed
--

CREATE TABLE IF NOT EXISTS `FAQ` (
    `id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `topic` VARCHAR(100) NOT NULL,
    `question` VARCHAR(255) NOT NULL,
    `answer` TEXT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Account`
-- *already executed
--

CREATE TABLE IF NOT EXISTS `Account` (
    `id` VARCHAR(16) PRIMARY KEY NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `password` TEXT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Expedition`
-- *already executed
--

CREATE TABLE IF NOT EXISTS `Expedition` (
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `website` VARCHAR(255),
    `tracking_url` VARCHAR(255)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Expedition_Logo`
-- *already executed
--

CREATE TABLE IF NOT EXISTS `Expedition_Logo` (
    `id` VARCHAR(10) PRIMARY KEY NOT NULL,
    `expedition_id` VARCHAR(8) NOT NULL,
    `file_name` VARCHAR(255),
    FOREIGN KEY(`expedition_id`) REFERENCES `Expedition`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Transaction_Method`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Transaction_Method` (
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Address`
-- *already executed
--

CREATE TABLE IF NOT EXISTS `Address` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `account_id` VARCHAR(16) NOT NULL,
    `label` VARCHAR(25) NOT NULL,
    `province` VARCHAR(255) NOT NULL,
    `regency` VARCHAR(255) NOT NULL,
    `district` VARCHAR(255) NOT NULL,
    `village` VARCHAR(255) NOT NULL,
    `postal_code` VARCHAR(5) NOT NULL,
    `street` TEXT NOT NULL,
    `is_default` BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (`account_id`) REFERENCES `Account`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Payment_Service`
--

CREATE TABLE IF NOT EXISTS `Payment_Service` (
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `use_phone_number` BOOLEAN DEFAULT NULL
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Payment_Service_Logo`
--

CREATE TABLE IF NOT EXISTS `Payment_Service_Logo` (
    `id` VARCHAR(10) PRIMARY KEY NOT NULL,
    `payment_service_id` VARCHAR(8) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`payment_service_id`) REFERENCES `Payment_Service`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Bank`
--

CREATE TABLE IF NOT EXISTS `Bank` (
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `fullname` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Bank_Logo`
--

CREATE TABLE IF NOT EXISTS `Bank_Logo` (
    `id` VARCHAR(10) PRIMARY KEY NOT NULL,
    `bank_id` VARCHAR(8) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`bank_id`) REFERENCES `Bank`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Payment_Service_Bank_Transfer`
--

CREATE TABLE IF NOT EXISTS `Payment_Service_Bank_Transfer` (
    `id` VARCHAR(10) PRIMARY KEY NOT NULL,
    `payment_service_id` VARCHAR(8) NOT NULL,
    `bank_id` VARCHAR(8) NOT NULL,
    `admin_fee` INTEGER NOT NULL DEFAULT 0,
    `transfer_limit` INTEGER NOT NULL DEFAULT 0,
    FOREIGN KEY (`payment_service_id`) REFERENCES `Payment_Service`(`id`),
    FOREIGN KEY (`bank_id`) REFERENCES `Bank`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Offer`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Offer` (
    `id` VARCHAR(16) PRIMARY KEY NOT NULL,
    `account_id` VARCHAR(16) NOT NULL,
    `address` TEXT NOT NULL,
    `transaction_method` VARCHAR(100) NOT NULL,
    `payment_used` VARCHAR(100) NOT NULL,
    `shipping_used` VARCHAR(100) NOT NULL,
    `is_accepted` BOOLEAN,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (`account_id`) REFERENCES `Account`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Book_Offer`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Offer` (
    `id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `offer_id` VARCHAR(16) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `writer` VARCHAR(255) NOT NULL,
    `publisher` VARCHAR(255) NOT NULL,
    `language` VARCHAR(50) NOT NULL,
    `width` FLOAT NOT NULL,
    `height` FLOAT NOT NULL,
    `num_of_pages` INTEGER NOT NULL,
    `isbn` VARCHAR(20) NOT NULL,
    FOREIGN KEY (`offer_id`) REFERENCES `Offer`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Book_Price`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Price` (
    `book_id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `selling_price` INTEGER NOT NULL,
    `physical_price` INTEGER NOT NULL DEFAULT 0,
    `purchase_price` INTEGER DEFAULT 0,
    FOREIGN KEY (`book_id`) REFERENCES `Book_Offer`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Book_Photo_Criteria`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Photo_Criteria` (
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `required` BOOLEAN NOT NULL,
    `description` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Book_Photo`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Photo` (
    `id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `book_id` VARCHAR(20) NOT NULL,
    `criteria` VARCHAR(8) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`book_id`) REFERENCES `Book_Offer`(`id`),
    FOREIGN KEY (`criteria`) REFERENCES `Book_Photo_Criteria`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Book_Condition`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Condition` (
    `book_id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `quality_percentage` INTEGER NOT NULL,
    `description` TEXT NOT NULL,
    FOREIGN KEY (`book_id`) REFERENCES `Book_Offer`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Book_Condition_Criteria`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Condition_Criteria` (
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `point` INTEGER NOT NULL,
    `description` VARCHAR(255)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Book_Condition_Assessment`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Condition_Assessment` (
    `id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `book_id` VARCHAR(20) NOT NULL,
    `criteria` VARCHAR(8) NOT NULL,
    `value` INTEGER NOT NULL,
    FOREIGN KEY (`book_id`) REFERENCES `Book_Condition`(`book_id`),
    FOREIGN KEY (`criteria`) REFERENCES `Book_Condition_Criteria`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Rejected_Offer`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Rejected_Offer` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `offer_id` VARCHAR(16) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (`offer_id`) REFERENCES `Offer`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Rejected_Offer_Reason`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Rejected_Offer_Reason` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `rejected_offer_id` VARCHAR(18) NOT NULL,
    `reason` TEXT NOT NULL,
    `file_image` VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (`rejected_offer_id`) REFERENCES `Rejected_Offer`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Purchase`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Purchase` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `offer_id` VARCHAR(16) NOT NULL,
    `total_payment` INTEGER NOT NULL DEFAULT 0,
    `has_paid` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `completed_at` TIMESTAMP,
    FOREIGN KEY (`offer_id`) REFERENCES `Offer`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Book_Price_Deals`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Price_Deals` (
    `book_id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `purchase_id` VARCHAR(18) NOT NULL,
    `deals_selling_price` INTEGER NOT NULL,
    FOREIGN KEY (`book_id`) REFERENCES `Book_Offer`(`id`),
    FOREIGN KEY (`purchase_id`) REFERENCES `Purchase`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Payment_Details`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Payment_Details` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `purchase_id` VARCHAR(18) NOT NULL,
    `payment_receipt` VARCHAR(255) DEFAULT '',
    `paid_at` TIMESTAMP,
    FOREIGN KEY (`purchase_id`) REFERENCES `Purchase`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Shipping_Details`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Shipping_Details` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `purchase_id` VARCHAR(18) NOT NULL,
    `shipping_receipt` VARCHAR(255) DEFAULT '',
    `shipping_cost` INTEGER DEFAULT 0,
    `shipped_at` TIMESTAMP,
    `received_at` TIMESTAMP,
    FOREIGN KEY (`purchase_id`) REFERENCES `Purchase`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Receipt_Photo`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Receipt_Photo` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `shipping_id` VARCHAR(18) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`shipping_id`) REFERENCES `Shipping_Details`(`id`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


-- --------------------------------------------------------
-- TRIGGERS CREATION
-- --------------------------------------------------------

-- --------------------------------------------------------
-- The triggers that will affect the `Account` table
-- --------------------------------------------------------

--
-- trigger `avoid_date_created_changed_in_acc`
-- *already executed
--

DELIMITER //
CREATE TRIGGER IF NOT EXISTS `avoid_date_created_changed_in_acc`
    BEFORE UPDATE ON `Account`
FOR EACH ROW
BEGIN
    IF (OLD.`created_at` != NEW.`created_at`) THEN
        SIGNAL SQLSTATE '42808'
            SET MESSAGE_TEXT = 'date creation value cannot be changed';
    END IF;
END //
DELIMITER ;

-- --------------------------------------------------------

--
-- trigger `update_last_modif_acc`
-- *already executed
--

DELIMITER //
CREATE TRIGGER IF NOT EXISTS `update_last_modif_acc`
    BEFORE UPDATE ON `Account`
FOR EACH ROW
BEGIN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP();
END //
DELIMITER ;

-- --------------------------------------------------------


-- --------------------------------------------------------
-- The triggers that will affect the `Email_Verificator` table
-- --------------------------------------------------------

--
-- trigger `avoid_date_created_changed_in_acc`
-- *already executed
--

DELIMITER //
CREATE TRIGGER IF NOT EXISTS `avoid_date_created_changed_in_email_verif`
    BEFORE UPDATE ON `Email_Verificator`
FOR EACH ROW
BEGIN
    IF (OLD.`created_at` != NEW.`created_at`) THEN
        SIGNAL SQLSTATE '42808'
            SET MESSAGE_TEXT = 'date creation value cannot be changed';
    END IF;
END //
DELIMITER ;

-- --------------------------------------------------------

--
-- trigger `update_last_modif_acc`
-- *already executed
--

DELIMITER //
CREATE TRIGGER IF NOT EXISTS `update_last_modif_email_verif`
    BEFORE UPDATE ON `Email_Verificator`
FOR EACH ROW
BEGIN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP();
END //
DELIMITER ;

-- --------------------------------------------------------

-- --------------------------------------------------------
-- The triggers that will affect the `FAQ` table
-- --------------------------------------------------------

--
-- trigger `avoid_date_created_changed_in_faq`
-- *already executed
--

DELIMITER //
CREATE TRIGGER IF NOT EXISTS `avoid_date_created_changed_in_faq`
    BEFORE UPDATE ON `FAQ`
FOR EACH ROW
BEGIN
    IF (OLD.`created_at` != NEW.`created_at`) THEN
        SIGNAL SQLSTATE '42808'
            SET MESSAGE_TEXT = 'date creation value cannot be changed';
    END IF;
END //
DELIMITER ;
