-- ============================================
-- KIXERA DATABASE - INSERT TEST ACCOUNTS
-- ============================================
-- Password: admin123
-- Hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
-- ============================================

-- ============================================
-- 1. ADMIN ACCOUNT
-- ============================================
-- Login: admin / admin123 atau admin@kixera.com / admin123
-- ============================================

INSERT INTO `users` (
    `username`, 
    `password`, 
    `role`, 
    `status`, 
    `created_at`,
    `updated_at`,
    `deleted_at`
) VALUES (
    'admin',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin',
    'aktif',
    NOW(),
    NULL,
    NULL
);

SET @id_user_admin = LAST_INSERT_ID();

INSERT INTO `admin` (
    `id_user`,
    `nama`,
    `email`,
    `no_telp`,
    `foto_profil`,
    `created_at`,
    `updated_at`,
    `deleted_at`
) VALUES (
    @id_user_admin,
    'Admin KixEra',
    'admin@kixera.com',
    '081234567890',
    NULL,
    NOW(),
    NULL,
    NULL
);

-- ============================================
-- 2. OWNER ACCOUNT - TRIAL (John Doe)
-- ============================================
-- Login: john / admin123 atau john@example.com / admin123
-- ============================================

INSERT INTO `users` (
    `username`,
    `password`,
    `role`,
    `status`,
    `created_at`,
    `updated_at`,
    `deleted_at`
) VALUES (
    'john',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'owner',
    'aktif',
    NOW(),
    NULL,
    NULL
);

SET @id_user_john = LAST_INSERT_ID();

INSERT INTO `pemilik` (
    `id_user`,
    `nama`,
    `email`,
    `no_telp`,
    `foto_profil`,
    `nama_usaha`,
    `alamat_usaha`,
    `status_langganan`,
    `id_paket`,
    `created_at`,
    `updated_at`,
    `deleted_at`
) VALUES (
    @id_user_john,
    'John Doe',
    'john@example.com',
    '081234567891',
    NULL,
    'John Shoe Care',
    'Jl. Testing No. 456, Bandung',
    'trial',
    NULL,
    NOW(),
    NULL,
    NULL
);
23
-- ============================================
-- 3. OWNER ACCOUNT - PREMIUM (Premium User)
-- ============================================
-- Login: premium / admin123 atau premium@kixera.com / admin1

INSERT INTO `users` (
    `username`,
    `password`,
    `role`,
    `status`,
    `created_at`,
    `updated_at`,
    `deleted_at`
) VALUES (
    'premium',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'owner',
    'aktif',
    NOW(),
    NULL,
    NULL
);

SET @id_user_premium = LAST_INSERT_ID();

INSERT INTO `pemilik` (
    `id_user`,
    `nama`,
    `email`,
    `no_telp`,
    `foto_profil`,
    `nama_usaha`,
    `alamat_usaha`,
    `status_langganan`,
    `id_paket`,
    `created_at`,
    `updated_at`,
    `deleted_at`
) VALUES (
    @id_user_premium,
    'Premium User',
    'premium@kixera.com',
    '081234567892',
    NULL,
    'Premium Shoe Spa',
    'Jl. Premium No. 789, Surabaya',
    'aktif',
    NULL,
    NOW(),
    NULL,
    NULL
);

-- ============================================
-- SUMMARY - TEST ACCOUNTS
-- ============================================
/*
┌──────────────────────────────────────────────────────────────┐
│ ADMIN ACCOUNT                                                │
├──────────────────────────────────────────────────────────────┤
│ Username : admin                                             │
│ Password : admin123                                          │
│ Email    : admin@kixera.com                                  │
│ Phone    : 081234567890                                      │
│ Role     : admin                                             │
└──────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────┐
│ OWNER ACCOUNT 1 - TRIAL                                      │
├──────────────────────────────────────────────────────────────┤
│ Username : john                                              │
│ Password : admin123                                          │
│ Email    : john@example.com                                  │
│ Phone    : 081234567891                                      │
│ Role     : owner                                             │
│ Business : John Shoe Care                                    │
│ Status   : trial                                             │
└──────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────┐
│ OWNER ACCOUNT 2 - PREMIUM                                    │
├──────────────────────────────────────────────────────────────┤
│ Username : premium                                           │
│ Password : admin123                                          │
│ Email    : premium@kixera.com                                │
│ Phone    : 081234567892                                      │
│ Role     : owner                                             │
│ Business : Premium Shoe Spa                                  │
│ Status   : aktif                                             │
└──────────────────────────────────────────────────────────────┘

INSTRUKSI MENJALANKAN QUERY:
═══════════════════════════════════════════════════════════════
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Pilih database: kixera_db
3. Klik tab: SQL
4. Copy semua query di atas (termasuk SET @id_user)
5. Paste di SQL editor
6. Klik tombol: Go / Kirim

CARA LOGIN:
═══════════════════════════════════════════════════════════════
URL Login: http://localhost/kixera/auth/login

Opsi 1 - Login dengan Username:
  Username: admin
  Password: admin123

Opsi 2 - Login dengan Email:
  Email: admin@kixera.com
  Password: admin123

CATATAN:
═══════════════════════════════════════════════════════════════
- Kolom foto_profil, id_paket: NULL (belum diisi)
- Kolom updated_at, deleted_at: NULL (default)
- Login support username ATAU email di semua role
- Password hash compatible dengan password_verify() PHP
*/
