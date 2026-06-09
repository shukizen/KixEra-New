-- ============================================
-- KIXERA - OAuth Verification Queries
-- File: oauth_verification_queries.sql
-- Deskripsi: Query untuk memverifikasi hasil migrasi OAuth
-- ============================================

-- 1. Cek struktur tabel users
SELECT 
    'STRUKTUR TABEL USERS' AS Info;
    
DESCRIBE users;

-- 2. Cek kolom OAuth di tabel users
SELECT 
    'KOLOM OAUTH DI TABEL USERS' AS Info;

SELECT 
    COLUMN_NAME,
    COLUMN_TYPE,
    IS_NULLABLE,
    COLUMN_DEFAULT,
    COLUMN_COMMENT
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'users'
  AND COLUMN_NAME IN (
    'google_id', 
    'google_email', 
    'google_avatar', 
    'oauth_provider',
    'oauth_access_token',
    'oauth_refresh_token',
    'oauth_token_expires'
  )
ORDER BY ORDINAL_POSITION;

-- 3. Cek struktur tabel oauth_sessions
SELECT 
    'STRUKTUR TABEL OAUTH_SESSIONS' AS Info;
    
DESCRIBE oauth_sessions;

-- 4. Cek struktur tabel oauth_state_tokens
SELECT 
    'STRUKTUR TABEL OAUTH_STATE_TOKENS' AS Info;
    
DESCRIBE oauth_state_tokens;

-- 5. Cek indexes di tabel users (OAuth related)
SELECT 
    'INDEXES DI TABEL USERS (OAuth Related)' AS Info;

SELECT 
    INDEX_NAME,
    COLUMN_NAME,
    NON_UNIQUE,
    SEQ_IN_INDEX
FROM INFORMATION_SCHEMA.STATISTICS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'users'
  AND INDEX_NAME IN ('idx_google_id', 'idx_oauth_provider')
ORDER BY INDEX_NAME, SEQ_IN_INDEX;

-- 6. Cek indexes di tabel oauth_sessions
SELECT 
    'INDEXES DI TABEL OAUTH_SESSIONS' AS Info;

SELECT 
    INDEX_NAME,
    COLUMN_NAME,
    NON_UNIQUE,
    SEQ_IN_INDEX
FROM INFORMATION_SCHEMA.STATISTICS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'oauth_sessions'
ORDER BY INDEX_NAME, SEQ_IN_INDEX;

-- 7. Cek indexes di tabel oauth_state_tokens
SELECT 
    'INDEXES DI TABEL OAUTH_STATE_TOKENS' AS Info;

SELECT 
    INDEX_NAME,
    COLUMN_NAME,
    NON_UNIQUE,
    SEQ_IN_INDEX
FROM INFORMATION_SCHEMA.STATISTICS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'oauth_state_tokens'
ORDER BY INDEX_NAME, SEQ_IN_INDEX;

-- 8. Cek foreign keys
SELECT 
    'FOREIGN KEYS' AS Info;

SELECT 
    CONSTRAINT_NAME,
    TABLE_NAME,
    COLUMN_NAME,
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = DATABASE()
  AND REFERENCED_TABLE_NAME IS NOT NULL
  AND TABLE_NAME IN ('oauth_sessions', 'oauth_state_tokens')
ORDER BY TABLE_NAME, CONSTRAINT_NAME;

-- 9. Summary verification
SELECT 
    'SUMMARY VERIFICATION' AS Info;

SELECT 
    'Users Table - OAuth Columns' AS Category,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_schema = DATABASE() 
     AND table_name = 'users' 
     AND column_name IN ('google_id', 'google_email', 'google_avatar', 'oauth_provider', 
                         'oauth_access_token', 'oauth_refresh_token', 'oauth_token_expires')) AS Count,
    '7 expected' AS Expected
UNION ALL
SELECT 
    'OAuth Sessions Table' AS Category,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES 
     WHERE table_schema = DATABASE() 
     AND table_name = 'oauth_sessions') AS Count,
    '1 expected' AS Expected
UNION ALL
SELECT 
    'OAuth State Tokens Table' AS Category,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES 
     WHERE table_schema = DATABASE() 
     AND table_name = 'oauth_state_tokens') AS Count,
    '1 expected' AS Expected
UNION ALL
SELECT 
    'Indexes on Users Table (OAuth)' AS Category,
    (SELECT COUNT(DISTINCT INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS 
     WHERE table_schema = DATABASE() 
     AND table_name = 'users' 
     AND INDEX_NAME IN ('idx_google_id', 'idx_oauth_provider')) AS Count,
    '2 expected' AS Expected;

-- ============================================
-- SELESAI!
-- ============================================
