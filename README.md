# Amanah Store — Sistem Kasir & Stok Toko Kelontong

Aplikasi web berbasis **PHP + MySQL** (tanpa framework) untuk manajemen kasir, stok barang, dan kasbon pelanggan. Desain UI/UX **responsif penuh** di seluruh perangkat — Smartphone, Tablet, Layar POS, Laptop, hingga Desktop 4K.

---

## 📁 Struktur Berkas Proyek

```text
sistem-kasir-pos-by-bismillah-amiin-teams/
│
├── 📂 assets/
│   └── images/
│       ├── amanah-store-3d-nbg.png   # Ilustrasi 3D logo Amanah Store (tanpa background)
│       ├── logo.png                  # Logo resmi Amanah Store
│       ├── logo-crest.png            # Varian logo crest / badge
│       └── avatar-pakhaji.jpg        # Avatar default pengguna
│
├── 📂 backend/                       # Backend PHP polos + PDO (tanpa framework)
│   ├── auth.php                      # require_login() & require_role() — proteksi halaman
│   ├── logout.php                    # Proses keluar (POST + CSRF)
│   ├── seed_owner.php                # Membuat akun owner pertama (CLI, sekali pakai)
│   ├── tambah_kasir.php              # Tambah akun kasir (khusus role owner)
│   └── README.md                     # Dokumentasi backend
│
├── 📂 css/
│   ├── global.css                    # Variabel desain, reset, & komponen UI global
│   ├── style.css                     # Styling halaman login (all-device, ambient glow)
│   ├── dashboard.css                 # Styling halaman dashboard utama
│   └── data-barang.css               # Styling halaman manajemen data barang
│
├── 📂 script/
│   ├── script.js                     # Interaktivitas login (toggle password, form state)
│   ├── global.js                     # Helper & utilitas global (siap API backend)
│   └── dashboard.js                  # Logika interaktif halaman dashboard
│
├── 📂 public/                        # Halaman HTML frontend (view layer)
│   ├── index.html                    # Redirect / entry point publik
│   ├── dashboard.html                # Tampilan dashboard kasir & owner
│   └── data-barang.html              # Tampilan manajemen data barang & stok
│
├── 📂 database/
│   └── database.sql                  # Skema & data awal database MySQL
│
├── config.php                        # Koneksi DB, sesi, & token CSRF
├── dashboard.php                     # Dashboard PHP (proteksi sesi, placeholder)
├── index.php                         # Entry point PHP (redirect ke login)
├── login.php                         # Form & proses autentikasi login
├── login.html                        # Tampilan statis halaman login (HTML)
├── index.html                        # Entry point HTML (redirect ke login.php)
├── .env.example                      # Contoh konfigurasi environment variable
├── .gitignore                        # Daftar file yang dikecualikan dari Git
└── README.md                         # Dokumentasi proyek (yang sedang Anda baca)
```

---

## 📱 & 🖥️ Dukungan Responsif Semua Perangkat

| Perangkat | Ukuran Layar | Keterangan |
|---|---|---|
| **Smartphone Kecil** | ≤ 380px | iPhone SE, Galaxy Mini — font & padding fleksibel |
| **Smartphone Modern** | 390px – 480px | iPhone 13/14/15/16/17, Galaxy S — identik desain acuan |
| **Tablet & Kasir POS** | 600px – 1024px | iPad & layar sentuh POS — target sentuh ideal |
| **Laptop & Desktop** | ≥ 1025px | 1080p, 2K, 4K — kartu mengapung di tengah (450px) |

---

## 🗄️ Halaman Aplikasi

| Halaman | File | Deskripsi |
|---|---|---|
| Login | `login.php` / `login.html` | Autentikasi kasir & owner, CSRF token |
| Dashboard | `dashboard.php` / `public/dashboard.html` | Ringkasan penjualan, navigasi utama |
| Data Barang | `public/data-barang.html` | Manajemen stok, tambah/edit/hapus barang |

---

## 🔌 Integrasi Backend

Backend dibangun menggunakan **PHP 8+ + PDO**, terhubung ke **MySQL**. Endpoint login siap dihubungkan dari `script/script.js`:

- **Endpoint**: `POST /api/auth/login`
- **Parameter**: `{ username, password, remember }`
- **Respons**: CSRF Token + Session User → redirect ke Dashboard

---

## ⚙️ Cara Menjalankan

1. Pasang **XAMPP** atau **Laragon**, aktifkan Apache dan MySQL.
2. Salin seluruh folder ini ke `htdocs/` (XAMPP) atau `www/` (Laragon).
3. Buka `config.php`, sesuaikan `DB_USER` dan `DB_PASS` dengan database lokal Anda.
4. Import skema database:
   ```sql
   -- Di phpMyAdmin atau terminal MySQL:
   CREATE DATABASE amanah_store;
   USE amanah_store;
   SOURCE database/database.sql;
   ```
5. Buat akun owner pertama via terminal:
   ```bash
   php backend/seed_owner.php
   # Ikuti instruksi: isi nama, email, dan sandi
   ```
6. Buka browser → `http://localhost/<nama-folder>/login.php`
7. **Hapus** `backend/seed_owner.php` setelah akun owner berhasil dibuat.

---

## 🔐 Keamanan

- Proteksi halaman dengan `require_login()` dan `require_role()` di `backend/auth.php`
- Semua form sensitif dilindungi **CSRF Token**
- Password di-hash menggunakan `password_hash()` (PHP built-in)
- Logout menggunakan metode `POST` + verifikasi CSRF

---

## 👥 Tim Pengembang

Proyek ini dikembangkan oleh **Tim Bismillah Amiin** dalam rangka mata kuliah PPL (Praktik Pemrograman Lanjut).

> _"Sistem kasir yang amanah, berkah untuk semua."_
