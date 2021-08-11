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
);

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
);

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
);

-- --------------------------------------------------------

--
-- Table structure for table `Expedition`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Expedition` {
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `website` VARCHAR(255)
};

-- --------------------------------------------------------

--
-- Table structure for table `Expedition_Around`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Expedition_Around` {
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `account_id` VARCHAR(16) NOT NULL,
    `expedition_id` VARCHAR(8) NOT NULL,
    FOREIGN KEY (`account_id`) REFERENCES `Account`(`id`),
    FOREIGN KEY (`expedition_id`) REFERENCES `Expedition`(`id`)
};

-- --------------------------------------------------------

--
-- Table structure for table `Transaction_Method`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Transaction_Method` (
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `Address`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Address` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `account_id` VARCHAR(16) NOT NULL,
    `province` VARCHAR(200) NOT NULL,
    `district` VARCHAR(200) NOT NULL,
    `subdistrict` VARCHAR(200) NOT NULL,
    `village` VARCHAR(200) NOT NULL,
    `postal_code` VARCHAR(5) NOT NULL,
    `street` TEXT NOT NULL,
    FOREIGN KEY (`account_id`) REFERENCES `Account`(`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `Payment_Method`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Payment_Method` (
    `id` VARCHAR(8) PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) PRIMARY KEY NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `Offer`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Offer` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `account_id` VARCHAR(16) NOT NULL,
    `address_id` VARCHAR(18) NOT NULL,
    `transaction_method` VARCHAR(8) NOT NULL,
    `payment_used` VARCHAR(8) NOT NULL,
    `shipping_used` VARCHAR(8) NOT NULL,
    `is_accepted` BOOLEAN,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (`account_id`) REFERENCES `Account`(`id`),
    FOREIGN KEY (`address_id`) REFERENCES `Address`(`id`),
    FOREIGN KEY (`transaction_method`) REFERENCES `Transaction_Method`(`id`),
    FOREIGN KEY (`payment_used`) REFERENCES `Payment_Method`(`id`),
    FOREIGN KEY (`shipping_used`) REFERENCES `Expedition_Around`(`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `Rejected_Offer`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Rejected_Offer` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `offer_id` VARCHAR(18) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (`offer_id`) REFERENCES `Offer`(`id`)
);

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
);

-- --------------------------------------------------------

--
-- Table structure for table `Purchase`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Purchase` (
    `id` VARCHAR(18) PRIMARY KEY NOT NULL,
    `offer_id` VARCHAR(18) NOT NULL,
    `shipping_receipt` VARCHAR(255) NOT NULL DEFAULT '',
    `shipping_cost` INTEGER DEFAULT 0,
    `shipped_at` TIMESTAMP DEFAULT NULL,
    `received_at` TIMESTAMP DEFAULT NULL,
    `total_payment` INTEGER NOT NULL DEFAULT 0,
    `has_paid` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `completed_at` TIMESTAMP DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `Book_Offer`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Offer` (
    `id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `offer_id` VARCHAR(18) NOT NULL,
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
);

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
    `buyer_price` INTEGER DEFAULT 0,
    `deals_price` INTEGER DEFAULT 0,
    FOREIGN KEY (`book_id`) REFERENCES `Book_Offer`(`id`)
);

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
);

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
);

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
);

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
);

-- --------------------------------------------------------

--
-- Table structure for table `Book_Condition_Assessment`
-- *not executed yet
--

CREATE TABLE IF NOT EXISTS `Book_Condition_Assessment` (
    `id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `book_id` VARCHAR(20) NOT NULL,
    `criteria` VARCHAR(8) NOT NULL
    `value` INTEGER NOT NULL,
    FOREIGN KEY (`book_id`) REFERENCES `Book_Condition`(`id`),
    FOREIGN KEY (`criteria`) REFERENCES `Book_Condition_Criteria`(`id`)
);

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
