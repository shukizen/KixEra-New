# Railway Deploy Notes

Project ini adalah CodeIgniter 3.1.13. Config sudah dibuat tetap kompatibel dengan lokal, tetapi bisa membaca environment variable Railway saat deploy.

## Minimal Variables

Set variable berikut di service aplikasi Railway:

```text
CI_ENV=production
BASE_URL=https://your-domain.up.railway.app
CI_ENCRYPTION_KEY=change-me-to-a-long-random-string
COOKIE_SECURE=true
CI_LOG_THRESHOLD=1
```

Jika memakai MySQL Railway, hubungkan service MySQL ke aplikasi dan expose variable berikut dari service MySQL:

```text
MYSQLHOST
MYSQLPORT
MYSQLUSER
MYSQLPASSWORD
MYSQLDATABASE
MYSQL_URL
```

## Optional Integration Variables

```text
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=
SMTP_PASS=
SMTP_CRYPTO=tls
MAIL_FROM_EMAIL=
MAIL_FROM_NAME=KixEra

# Recommended when Railway cannot connect to SMTP ports
MAIL_DRIVER=brevo_api
BREVO_API_KEY=
BREVO_API_URL=https://api.brevo.com/v3/smtp/email

FONNTE_API_TOKEN=
FONNTE_API_URL=https://api.fonnte.com/send

MIDTRANS_SERVER_KEY=
MIDTRANS_CLIENT_KEY=
MIDTRANS_IS_PRODUCTION=false

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=https://your-domain.up.railway.app/auth/google_callback

GEMINI_API_KEY=
GEMINI_API_URL=https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent
```

## Storage

Folder `uploads/` dan `backups/` ditulis ke filesystem aplikasi. Untuk production Railway, gunakan Volume atau pindahkan file upload ke object storage agar data tidak hilang saat redeploy.

## Database

Import SQL dari `database/migrations/` ke MySQL Railway sebelum login memakai fitur utama aplikasi.
