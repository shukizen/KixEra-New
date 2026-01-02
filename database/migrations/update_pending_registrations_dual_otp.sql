-- Migration: Update pending_registrations for dual OTP verification
-- Run this in phpMyAdmin

-- Add email verification columns
ALTER TABLE `pending_registrations` 
ADD COLUMN `email_verification_code` varchar(6) NULL AFTER `verification_code`,
ADD COLUMN `email_code_expires_at` datetime NULL AFTER `code_expires_at`,
ADD COLUMN `email_code_sent_at` datetime NULL AFTER `code_sent_at`,
ADD COLUMN `wa_verified` tinyint(1) DEFAULT 0 AFTER `attempts`,
ADD COLUMN `email_verified` tinyint(1) DEFAULT 0 AFTER `wa_verified`;

-- Rename columns for clarity
ALTER TABLE `pending_registrations` 
CHANGE COLUMN `verification_code` `wa_verification_code` varchar(6) NOT NULL,
CHANGE COLUMN `code_expires_at` `wa_code_expires_at` datetime NOT NULL,
CHANGE COLUMN `code_sent_at` `wa_code_sent_at` datetime NOT NULL;
