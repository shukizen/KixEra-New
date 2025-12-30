-- Migration: Add Google OAuth columns
-- Date: 2025-12-22
-- Description: Add columns to support Google OAuth login in users table

-- Add Google OAuth columns to users table
ALTER TABLE `users` 
ADD COLUMN `google_id` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Google User ID' AFTER `status`,
ADD COLUMN `google_email` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Google Email' AFTER `google_id`,
ADD COLUMN `google_name` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Google Display Name' AFTER `google_email`,
ADD COLUMN `google_picture` TEXT NULL DEFAULT NULL COMMENT 'Google Profile Picture URL' AFTER `google_name`,
ADD UNIQUE INDEX `idx_google_id` (`google_id`);

-- Note: The UNIQUE index ensures that one Google account can only be linked to one user account
-- NULL values are allowed for users who don't use Google OAuth
