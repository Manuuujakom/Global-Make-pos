-- Use the database specified in your previous file.
USE `global_database`;

-- Drop the existing `users` table if it exists to replace it with a new one that includes roles.
-- This is for a fresh setup. Be cautious when running this on an existing database.
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `roles`;

-- Create a table to store user roles.
-- This allows you to easily manage different levels of access (e.g., admin, cashier, manager).
CREATE TABLE `roles` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `role_name` VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert the default roles.
INSERT INTO `roles` (`role_name`) VALUES ('admin'), ('user');

-- Create the users table.
-- It now includes a `role_id` column to link users to their respective roles.
CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `branch` VARCHAR(100) NOT NULL,
    `role_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    -- Create a foreign key constraint to link `role_id` to the `roles` table.
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert the default admin user with the credentials you provided.
-- The password is '2025' and the branch is 'Global Make Traders LTD'.
-- The `role_id` for 'admin' is 1.
-- IMPORTANT: This inserts the password in plain text.
-- In a production application, you should hash the password before storing it.
-- Use PHP's password_hash() function and store the resulting hash here.
INSERT INTO `users` (`username`, `password`, `branch`, `role_id`) VALUES ('admin', '2025', 'Global Make Traders LTD', 1);

