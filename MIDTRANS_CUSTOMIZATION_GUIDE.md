# Panduan Kustomisasi Midtrans Snap

## Warna Website KixEra
Berdasarkan analisis landing page, warna utama yang digunakan:
- **Primary**: Emerald/Teal (#10B981 / emerald-500, #14B8A6 / teal-500)
- **Secondary**: Blue (#3B82F6 / blue-500)
- **Accent**: Purple, Orange

## Cara Mengkustomisasi Warna Midtrans Snap

### 1. Login ke Midtrans Dashboard
- Buka: https://dashboard.sandbox.midtrans.com (untuk testing)
- Atau: https://dashboard.midtrans.com (untuk production)
- Login dengan akun Midtrans Anda

### 2. Masuk ke Settings → Snap Preferences
1. Klik menu **Settings** di sidebar
2. Pilih **Snap Preferences**

### 3. Kustomisasi yang Tersedia

#### A. Display Settings
- **Merchant Name**: KixEra
- **Merchant Logo**: Upload logo KixEra (format PNG/JPG, max 500KB, recommended 200x200px)

#### B. Color Theme
- **Primary Color**: `#10B981` (Emerald - sesuai warna website)
- **Button Color**: `#14B8A6` (Teal - untuk tombol bayar)

#### C. Language
- Pilih: **Indonesian** (Bahasa Indonesia)

#### D. Payment Methods
Aktifkan metode pembayaran yang ingin ditampilkan:
- ✅ Credit Card (Kartu Kredit)
- ✅ Bank Transfer (BCA, Mandiri, BNI, BRI, Permata)
- ✅ E-Wallet (GoPay, ShopeePay, QRIS)
- ✅ Convenience Store (Alfamart, Indomaret)

### 4. Simpan Perubahan
Klik tombol **Save** di bagian bawah halaman.

## Kustomisasi Tambahan via Kode (Opsional)

Meskipun warna utama diatur di dashboard, Anda bisa menambahkan beberapa parameter tambahan:

```php
// Di Midtrans_lib.php - method get_snap_token()
$params = [
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
    
    // Kustomisasi tambahan
    'credit_card' => [
        'secure' => true,
        'bank' => 'bca', // Bank yang ditampilkan pertama
        'installment' => [
            'required' => false,
            'terms' => [
                'bca' => [3, 6, 12],
                'mandiri' => [3, 6, 12]
            ]
        ]
    ],
    
    // Custom expiry time
    'custom_expiry' => [
        'order_time' => date('Y-m-d H:i:s O'),
        'expiry_duration' => 60,
        'unit' => 'minute'
    ]
];
```

## Preview Hasil
Setelah mengatur warna di dashboard:
- Popup Midtrans akan menggunakan warna emerald (#10B981)
- Tombol "Bayar" akan berwarna teal (#14B8A6)
- Logo KixEra akan muncul di bagian atas popup
- Bahasa Indonesia untuk semua teks

## Catatan Penting
⚠️ **Perubahan di Dashboard Midtrans berlaku untuk semua transaksi**
⚠️ **Warna yang diset di dashboard akan override warna default Midtrans**
⚠️ **Perubahan mungkin memerlukan waktu 5-10 menit untuk aktif**

## Testing
Setelah mengatur:
1. Buka halaman checkout: `http://localhost/kixera/pembayaran/checkout/2`
2. Klik "Bayar Sekarang"
3. Popup Midtrans seharusnya menampilkan warna dan logo KixEra

---

**Jika memerlukan bantuan lebih lanjut, hubungi support Midtrans:**
- Email: support@midtrans.com
- Dokumentasi: https://docs.midtrans.com/
