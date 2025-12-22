-- Cek struktur tabel users - apakah field OAuth sudah ada?
DESCRIBE users;

-- Atau dengan query ini:
SHOW COLUMNS FROM users LIKE 'google%';
SHOW COLUMNS FROM users LIKE 'oauth%';
