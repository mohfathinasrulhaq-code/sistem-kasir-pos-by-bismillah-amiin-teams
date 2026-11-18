# Frontend Halaman Login - Amanah Store (Universal Responsive)

Implementasi Frontend Halaman Login untuk **Amanah Store (Sistem Kasir & Stok Toko Kelontong)** dengan desain UI/UX yang **100% identik dengan desain acuan** di folder `Assets/Amanah Store - Login.png` dan **sepenuhnya responsif** di seluruh perangkat (Mobile, Tablet, Layar POS, Laptop, dan Desktop 4K).

---

## 📁 Struktur Berkas Proyek

```text
sistem-kasir-pos-by-bismillah-amiin-teams/
├── assets/
│   └── images/
│       └── logo.png         # Logo resmi Amanah Store (gradien squircle + badge petir)
├── backend/                 # <‑‑ Backend PHP (tanpa framework)
│   ├── config.php
│   ├── auth.php
│   ├── login.php
│   ├── logout.php
│   ├── dashboard.php
│   ├── tambah_kasir.php
│   └── seed_owner.php
├── css/style.css            # Styling universal all-device, responsive breakpoints, & ambient glow
├── script/script.js          # Interaktivitas (toggle password, form state, siap API Backend)
├── index.html               # Struktur semantik HTML5, SVG icons, & tipografi Plus Jakarta Sans
├── README.md                # Dokumentasi proyek (yang sedang Anda baca)
└── backend/README.md       # Dokumentasi backend (digabung di sini)
```

---

## 📱 & 🖥️ Dukungan Responsif Semua Perangkat

- **Smartphone Kecil (≤ 380px)**: iPhone SE, Galaxy Mini — ukuran font & padding fleksibel, bebas dari scroll samping.
- **Smartphone Modern (390px - 480px)**: iPhone 13/14/15/16/17, Galaxy S — rasio visual 1:1 identik dengan desain acuan.
- **Tablet & Mesin Kasir POS (600px - 1024px)**: iPad & Layar Sentuh POS kasir — tombol & input empuk dengan target sentuh ideal.
- **Laptop & Desktop (≥ 1025px)**: Layar 1080p, 2K, 4K — kartu mengapung anggun di tengah (lebar ideal 450px) dengan latar ambient glow.

---

## 🔌 Integrasi Backend (Frontend)

Endpoint backend siap dihubungkan di berkas `script/script.js`:
- **Endpoint**: `POST /api/auth/login`
- **Parameter**: `{ username, password, remember }`
- **Dukungan respons**: CSRF Token & Session User redirect ke Dashboard Kasir.

---

# Backend Login Amanah Store (PHP)

PHP polos + PDO, tanpa framework. Cukup PHP 8+ dan MySQL.

## Isi

| File | Fungsi |
|---|---|
| `config.php` | Setelan database, sesi, koneksi, token CSRF |
| `auth.php` | `require_login()` dan `require_role()` untuk melindungi halaman |
| `login.php` | Form dan proses login |
| `logout.php` | Keluar (POST + CSRF) |
| `dashboard.php` | Placeholder, hanya bisa dibuka setelah login |
| `tambah_kasir.php` | Tambah kasir, khusus owner |
| `seed_owner.php` | Membuat owner pertama (CLI, sekali pakai) |

## Cara menjalankan
1. Pasang XAMPP atau Laragon, aktifkan Apache dan MySQL.
2. Pastikan database `amanah_store` sudah ada (impor `database.sql` dan `data_barang.sql`).
3. Salin folder ini ke `htdocs` (XAMPP) atau `www` (Laragon).
4. Buka `config.php`, sesuaikan `DB_USER` dan `DB_PASS`.
5. Di terminal, dari folder ini: `php seed_owner.php` lalu isi nama, email, sandi.
6. Buka `http://localhost/amanah-backend/login.php` dan masuk.
7. Hapus `seed_owner.php` setelah dipakai.
