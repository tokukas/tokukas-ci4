-- --------------------------------------------------------
-- TABLES CREATION
-- --------------------------------------------------------

--
-- Table structure for table `Email_Verification`
-- *already yet
--

CREATE TABLE IF NOT EXISTS `Email_Verification` (
    `id` VARCHAR(20) PRIMARY KEY NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `code` VARCHAR(6) NOT NULL,
    `verified` BOOLEAN NOT NULL DEFAULT FALSE,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

-- --------------------------------------------------------

--
-- Table structure for table `Account`
-- *already yet
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
-- The triggers that will affect the `Email_Verification` table
-- --------------------------------------------------------

--
-- trigger `avoid_date_created_changed_in_acc`
-- *already executed
--

DELIMITER //
CREATE TRIGGER IF NOT EXISTS `avoid_date_created_changed_in_email_verif`
    BEFORE UPDATE ON `Email_Verification`
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
    BEFORE UPDATE ON `Email_Verification`
FOR EACH ROW
BEGIN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP();
END //
DELIMITER ;

-- --------------------------------------------------------
