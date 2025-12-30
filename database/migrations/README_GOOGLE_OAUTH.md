# Panduan Google OAuth - KixEra

## Masalah yang Diperbaiki

### Error Sebelumnya:
1. ❌ `Call to undefined method User_model::get_user_by_google_id()`
2. ❌ `Unknown column 'p.google_id' in 'where clause'`

### Solusi yang Diterapkan:
✅ Menambahkan method Google OAuth di `User_model.php`
✅ Memperbaiki query untuk mencari `google_id` di tabel `users` (bukan `pemilik`/`admin`)

---

## Langkah-Langkah Setup

### 1. Tambahkan Kolom Google OAuth ke Database

**Buka phpMyAdmin**, pilih database `kixera`, lalu jalankan SQL ini:

```sql
-- Add Google OAuth columns to users table
ALTER TABLE `users` 
ADD COLUMN `google_id` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Google User ID' AFTER `status`,
ADD COLUMN `google_email` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Google Email' AFTER `google_id`,
ADD COLUMN `google_name` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Google Display Name' AFTER `google_email`,
ADD COLUMN `google_picture` TEXT NULL DEFAULT NULL COMMENT 'Google Profile Picture URL' AFTER `google_name`,
ADD UNIQUE INDEX `idx_google_id` (`google_id`);
```

**Catatan:** Jika kolom sudah ada, skip langkah ini.

---

### 2. Verifikasi Konfigurasi Google OAuth

Pastikan file `application/config/google_config.php` sudah diisi dengan:

- `google_client_id` - dari Google Cloud Console
- `google_client_secret` - dari Google Cloud Console  
- `google_redirect_uri` - URL callback Anda (contoh: `http://localhost/KixEra/auth/google_callback`)

---

### 3. Cara Kerja Google OAuth

#### **Untuk User Baru (Registrasi):**
1. User klik "Login dengan Google"
2. Redirect ke Google untuk login
3. Google redirect kembali dengan authorization code
4. Sistem membuat akun baru dengan role **owner** (default)
5. Auto-login dan redirect ke dashboard

#### **Untuk User Existing (Merge/Link):**
1. Jika email Google sudah terdaftar di sistem → akun otomatis di-link
2. Jika Google ID sudah terdaftar → langsung login
3. Jika belum ada → buat akun baru

---

## Fitur yang Tersedia

### ✅ Method yang Ditambahkan di User_model:

1. **`get_user_by_google_id($google_id)`**
   - Mencari user berdasarkan Google ID
   - Return: User data lengkap atau false

2. **`link_google_account($id_user, $google_user)`**
   - Menghubungkan akun Google ke user existing
   - Menyimpan: google_id, google_email, google_name, google_picture

3. **`create_user_from_google($google_user)`**
   - Membuat user baru dari data Google OAuth
   - Auto-create: user → pemilik → cabang default
   - Status: Trial 7 hari

4. **`create_reset_token($email)`**
   - Generate token untuk reset password

5. **`validate_reset_token($token)`**
   - Validasi token reset password

6. **`reset_password_with_token($token, $new_password)`**
   - Reset password menggunakan token

---

## Admin & Google OAuth

### ⚠️ Catatan Penting untuk Admin:

Saat ini, **registrasi via Google OAuth hanya untuk role Owner**.

**Untuk Admin login dengan Google:**

#### Opsi 1: Manual Link (Recommended)
1. Admin sudah punya akun di sistem
2. Update database manual:
```sql
UPDATE users 
SET google_id = 'GOOGLE_ID_ADMIN', 
    google_email = 'email@gmail.com',
    google_name = 'Nama Admin'
WHERE id_user = ID_ADMIN;
```
3. Admin bisa login via Google OAuth

#### Opsi 2: Buat Fitur Link Account
- Tambahkan halaman di dashboard admin untuk link Google account
- Admin klik "Link Google Account" → redirect ke Google OAuth
- Callback akan update google_id di tabel users

---

## Testing

### Test Login dengan Google:
1. Buka: `http://localhost/KixEra/auth/google_login`
2. Login dengan akun Google
3. Seharusnya auto-create akun atau auto-merge dengan akun existing

### Test Password Reset:
1. Buka: `http://localhost/KixEra/auth/forgot_password`
2. Masukkan email
3. Akan generate reset link (di development, link ditampilkan di halaman)

---

## Troubleshooting

### Error: "Unknown column 'google_id'"
✅ **Sudah diperbaiki!** Jalankan migration SQL di atas.

### Error: "Call to undefined method"
✅ **Sudah diperbaiki!** Semua method sudah ditambahkan.

### Admin tidak bisa registrasi via Google
⚠️ **By design.** Gunakan Opsi 1 atau 2 di bagian "Admin & Google OAuth" di atas.

### Token reset password expired
Cek tabel `password_reset_tokens` - token berlaku 1 jam.

---

## Database Schema

### Tabel `users` - Kolom Google OAuth:
| Column | Type | Description |
|--------|------|-------------|
| `google_id` | VARCHAR(255) | Google User ID (unique) |
| `google_email` | VARCHAR(255) | Google Email |
| `google_name` | VARCHAR(255) | Google Display Name |
| `google_picture` | TEXT | Google Profile Picture URL |

### Tabel `password_reset_tokens`:
| Column | Type | Description |
|--------|------|-------------|
| `id` | INT(11) | Primary Key |
| `id_user` | INT(11) | Foreign Key to users |
| `token` | VARCHAR(64) | Reset token (unique) |
| `expires_at` | DATETIME | Expiration time |
| `used` | TINYINT(1) | 0 = unused, 1 = used |
| `used_at` | DATETIME | When token was used |
| `created_at` | DATETIME | Creation time |

---

## Keamanan

✅ **CSRF Protection** - State parameter untuk validasi OAuth callback
✅ **Token Expiration** - Reset token berlaku 1 jam
✅ **Unique Google ID** - Satu akun Google hanya bisa link ke satu user
✅ **Password Hashing** - Menggunakan bcrypt (PASSWORD_DEFAULT)
✅ **Verified Email Only** - Hanya email Google yang terverifikasi

---

## Selesai! 🎉

Semua error sudah diperbaiki. Silakan test Google OAuth login.

Jika masih ada error, cek:
1. ✅ Migration SQL sudah dijalankan?
2. ✅ Google credentials sudah dikonfigurasi?
3. ✅ Redirect URI sudah didaftarkan di Google Cloud Console?
