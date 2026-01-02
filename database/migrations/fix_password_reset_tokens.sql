-- Fix: Add 'used' column to existing password_reset_tokens table
-- Run this in phpMyAdmin

ALTER TABLE password_reset_tokens ADD COLUMN used TINYINT(1) DEFAULT 0 AFTER expires_at;
