# OAuth Google - Database Migration Guide

## 📋 Daftar File

1. **oauth_google_complete_migration.sql** - File migrasi utama
2. **oauth_verification_queries.sql** - Query untuk verifikasi hasil migrasi
3. **README_OAUTH_MIGRATION.md** - Dokumentasi ini

## 🎯 Tujuan

Menambahkan dukungan lengkap untuk Google OAuth authentication di database KixEra, termasuk:
- Kolom OAuth di tabel `users`
- Tabel `oauth_sessions` untuk tracking OAuth sessions
- Tabel `oauth_state_tokens` untuk CSRF protection

## 📊 Perubahan Database

### Tabel `users` - Kolom Baru

| Kolom | Tipe | Nullable | Deskripsi |
|-------|------|----------|-----------|
| `google_id` | VARCHAR(255) | YES | ID unik dari Google |
| `google_email` | VARCHAR(255) | YES | Email dari Google account |
| `google_avatar` | TEXT | YES | URL avatar dari Google |
| `oauth_provider` | VARCHAR(50) | YES | Provider OAuth (google, facebook, dll) |
| `oauth_access_token` | TEXT | YES | Access token dari OAuth |
| `oauth_refresh_token` | TEXT | YES | Refresh token dari OAuth |
| `oauth_token_expires` | DATETIME | YES | Waktu kadaluarsa token |

**Perubahan Existing:**
- Kolom `password` diubah menjadi NULLABLE (untuk user yang login via OAuth)

**Indexes:**
- `idx_google_id` pada kolom `google_id`
- `idx_oauth_provider` pada kolom `oauth_provider`

### Tabel Baru: `oauth_sessions`

Tabel untuk tracking OAuth sessions dari berbagai provider.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| `id_session` | INT | Primary key (auto increment) |
| `id_user` | INT | Foreign key ke `users.id_user` |
| `provider` | VARCHAR(50) | Provider OAuth (google, facebook, dll) |
| `provider_user_id` | VARCHAR(255) | ID user dari provider |
| `access_token` | TEXT | Access token |
| `refresh_token` | TEXT | Refresh token |
| `token_expires_at` | DATETIME | Waktu kadaluarsa token |
| `scope` | TEXT | OAuth scopes yang diberikan |
| `last_used_at` | DATETIME | Terakhir kali digunakan |
| `created_at` | DATETIME | Waktu dibuat |
| `updated_at` | DATETIME | Waktu diupdate |

**Indexes:**
- `idx_user` pada `id_user`
- `idx_provider` pada `provider`
- `idx_provider_user_id` pada `provider_user_id`
- `idx_last_used` pada `last_used_at`

**Foreign Keys:**
- `id_user` → `users(id_user)` ON DELETE CASCADE

### Tabel Baru: `oauth_state_tokens`

Tabel untuk CSRF protection menggunakan state tokens.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| `id_state` | INT | Primary key (auto increment) |
| `state_token` | VARCHAR(64) | State token (UNIQUE) |
| `redirect_uri` | VARCHAR(500) | URI redirect setelah OAuth |
| `is_used` | TINYINT(1) | Status apakah sudah digunakan |
| `expires_at` | DATETIME | Waktu kadaluarsa |
| `created_at` | DATETIME | Waktu dibuat |

**Indexes:**
- `idx_state_token` pada `state_token`
- `idx_expires` pada `expires_at`
- `idx_is_used` pada `is_used`

## 🚀 Cara Menjalankan Migrasi

### Opsi 1: Via phpMyAdmin (Recommended)

1. Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
2. Pilih database KixEra Anda
3. Klik tab "SQL"
4. Buka file `oauth_google_complete_migration.sql`
5. Copy seluruh isi file
6. Paste ke SQL query box di phpMyAdmin
7. Klik tombol "Go" atau "Kirim"
8. Tunggu hingga selesai (akan muncul pesan sukses)

### Opsi 2: Via MySQL Command Line

```bash
# Masuk ke MySQL
mysql -u root -p

# Pilih database
USE nama_database_kixera;

# Jalankan migrasi
source C:/xampp/htdocs/KixEra/database/oauth_google_complete_migration.sql;
```

### Opsi 3: Via Command Line (Windows)

```bash
# Dari direktori xampp/mysql/bin
cd C:\xampp\mysql\bin

# Jalankan migrasi
mysql -u root -p nama_database_kixera < C:\xampp\htdocs\KixEra\database\oauth_google_complete_migration.sql
```

## ✅ Verifikasi Hasil

Setelah menjalankan migrasi, verifikasi hasilnya:

### Via phpMyAdmin

1. Buka phpMyAdmin
2. Pilih database KixEra
3. Klik tab "SQL"
4. Buka file `oauth_verification_queries.sql`
5. Copy dan paste ke SQL query box
6. Klik "Go"
7. Review hasil query

### Via MySQL Command Line

```bash
mysql -u root -p nama_database_kixera < C:\xampp\htdocs\KixEra\database\oauth_verification_queries.sql
```

### Checklist Verifikasi

- [ ] Tabel `users` memiliki 7 kolom OAuth baru
- [ ] Kolom `password` di tabel `users` adalah NULLABLE
- [ ] Tabel `oauth_sessions` terbuat dengan 11 kolom
- [ ] Tabel `oauth_state_tokens` terbuat dengan 6 kolom
- [ ] Index `idx_google_id` ada di tabel `users`
- [ ] Index `idx_oauth_provider` ada di tabel `users`
- [ ] Foreign key dari `oauth_sessions.id_user` ke `users.id_user` terbuat

## 🔒 Keamanan

### CSRF Protection

Tabel `oauth_state_tokens` digunakan untuk mencegah CSRF attacks dengan:
- State token yang unique untuk setiap OAuth request
- Expiration time untuk membatasi waktu validitas
- Flag `is_used` untuk mencegah reuse

### Token Storage

- Access tokens dan refresh tokens disimpan di tabel `oauth_sessions`
- Sebaiknya di-encrypt sebelum disimpan (implementasi di aplikasi layer)
- Token expires ditrack untuk automatic refresh

## 📝 Catatan Penting

1. **Idempotent Migration**: File migrasi ini aman dijalankan berulang kali. Jika kolom/tabel sudah ada, akan di-skip.

2. **Backward Compatibility**: User yang sudah ada dengan password tradisional tetap bisa login seperti biasa.

3. **Password NULL**: User yang login via OAuth akan memiliki `password = NULL` dan `oauth_provider = 'google'`.

4. **Multiple OAuth Providers**: Struktur ini mendukung multiple OAuth providers (Google, Facebook, dll) di masa depan.

5. **Session Tracking**: Tabel `oauth_sessions` memungkinkan tracking multiple sessions per user dan per provider.

## 🔄 Rollback (Jika Diperlukan)

Jika perlu rollback, jalankan query berikut:

```sql
-- Hapus tabel baru
DROP TABLE IF EXISTS `oauth_state_tokens`;
DROP TABLE IF EXISTS `oauth_sessions`;

-- Hapus indexes
ALTER TABLE `users` DROP INDEX IF EXISTS `idx_google_id`;
ALTER TABLE `users` DROP INDEX IF EXISTS `idx_oauth_provider`;

-- Hapus kolom OAuth (HATI-HATI: akan menghapus data OAuth yang sudah ada)
ALTER TABLE `users` 
  DROP COLUMN IF EXISTS `oauth_token_expires`,
  DROP COLUMN IF EXISTS `oauth_refresh_token`,
  DROP COLUMN IF EXISTS `oauth_access_token`,
  DROP COLUMN IF EXISTS `oauth_provider`,
  DROP COLUMN IF EXISTS `google_avatar`,
  DROP COLUMN IF EXISTS `google_email`,
  DROP COLUMN IF EXISTS `google_id`;

-- Kembalikan password menjadi NOT NULL (HATI-HATI: pastikan semua user punya password)
-- ALTER TABLE `users` MODIFY COLUMN `password` VARCHAR(255) NOT NULL;
```

⚠️ **WARNING**: Rollback akan menghapus semua data OAuth yang sudah tersimpan!

## 📞 Support

Jika ada masalah saat migrasi:
1. Cek error message di phpMyAdmin atau MySQL console
2. Pastikan user MySQL memiliki privilege untuk CREATE TABLE dan ALTER TABLE
3. Backup database sebelum menjalankan migrasi
4. Cek log MySQL untuk detail error

## 📚 Referensi

- [Google OAuth 2.0 Documentation](https://developers.google.com/identity/protocols/oauth2)
- [CodeIgniter Database Documentation](https://codeigniter.com/userguide3/database/index.html)
- [MySQL ALTER TABLE Documentation](https://dev.mysql.com/doc/refman/8.0/en/alter-table.html)
