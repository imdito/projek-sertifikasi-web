# Manajemen Film 

adalah aplikasi web untuk manajemen film digital yang memungkinkan admin mengelola katalog film dan user (pengguna) untuk membrowse, memberikan review, dan membuat bookmark film favorit mereka.

---

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Direktori](#struktur-direktori)
- [Konfigurasi Database](#konfigurasi-database)
- [Panduan Pengguna](#panduan-pengguna)
- [Dokumentasi API](#dokumentasi-api)
- [Troubleshooting](#troubleshooting)

---

## Fitur Utama

### Untuk Admin
- **Manajemen Film**: Tambah, edit, dan hapus film dari katalog
- **Manajemen Komentar**: Lihat dan hapus komentar/review yang disubmit user
- **Dashboard**: Tampilan ringkas daftar semua film
- **Authentikasi**: Login dengan role admin

### Untuk User
- **Browsing Film**: Lihat daftar film yang tersedia dengan detail lengkap
- **Review/Komentar**: Berikan review/komentar pada film favorit
- **Bookmark**: Simpan film favorit ke dalam bookmark pribadi
- **Profil**: Kelola akun user dengan sistem login/register
- **Authentikasi**: Register dan login sebagai user biasa

### Fitur Umum
- **Sistem Autentikasi Berbasis Session** dengan role (admin/user)
- **UI Responsif** menggunakan Bootstrap 5
- **Database MySQL** untuk penyimpanan data

---

## Persyaratan Sistem

- **PHP**: 7.4 atau lebih baru
- **MySQL**: 5.7 atau lebih baru
- **Web Server**: Apache (XAMPP/LAMP Stack)
- **Browser**: Modern browser dengan JavaScript enabled

---

## Instalasi

### 1. Clone/Copy Project
```bash
# Copy project ke directory webserver
cp -r project_sertifikasi /path/to/htdocs/
```

### 2. Setup Database

#### Buat Database
```sql
CREATE DATABASE db_movie;
USE db_movie;
```

#### Buat Tabel Users
```sql
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role VARCHAR(20) DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### Buat Tabel Movie
```sql
CREATE TABLE movie (
  id INT PRIMARY KEY AUTO_INCREMENT,
  judul VARCHAR(255) NOT NULL,
  genre VARCHAR(50) NOT NULL,
  sutradara VARCHAR(100) NOT NULL,
  gambar LONGTEXT,
  sinopsis TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### Buat Tabel Review/Komentar
```sql
CREATE TABLE review (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_user INT NOT NULL,
  id_movie INT NOT NULL,
  konten TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (id_movie) REFERENCES movie(id) ON DELETE CASCADE
);
```

#### Buat Tabel Bookmark
```sql
CREATE TABLE bookmark (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_user INT NOT NULL,
  id_movie INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_bookmark (id_user, id_movie),
  FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (id_movie) REFERENCES movie(id) ON DELETE CASCADE
);
```

### 3. Konfigurasi Koneksi Database

Edit file `connection.php`:
```php
<?php
$hostname = "localhost";
$port = "3306";
$username = "root";      // Sesuaikan dengan user MySQL Anda
$password = "";          // Sesuaikan dengan password MySQL Anda
$database = "db_movie";  // Sesuaikan dengan nama database
?>
```

### 4. Buat Admin User (Optional)
```sql
INSERT INTO users (name, email, password_hash, role) 
VALUES ('admin', 'admin@moviemark.com', '$2y$10$...', 'admin');
```

> **Note**: Password hash harus dihasilkan menggunakan `password_hash()` dengan algo BCRYPT

---

## Struktur Direktori

```
project_sertifikasi/
├── connection.php              # Koneksi database
├── landing_page.php            # Halaman utama/home
│
├── auth/                       # Modul Autentikasi
│   ├── controller/
│   │   ├── login.php           # Proses login
│   │   ├── logout.php          # Proses logout
│   │   └── register_controller.php  # Proses registrasi
│   └── view/
│       ├── login_view.php      # Halaman login
│       └── register_view.php   # Halaman registrasi
│
├── admin/                      # Modul Admin
│   ├── controller/
│   │   ├── add_movie.php       # Tambah film
│   │   ├── update_movie.php    # Edit film
│   │   ├── delete.php          # Hapus film
│   │   ├── get_movie_data.php  # Ambil data film
│   │   ├── get_comments.php    # Ambil data komentar
│   │   └── delete_comment.php  # Hapus komentar
│   └── view/
│       ├── index.php           # Dashboard admin
│       ├── tambah_view.php     # Form tambah film
│       ├── edit_view.php       # Form edit film
│       └── comments_view.php   # Halaman manajemen komentar
│
├── user/                       # Modul User
│   ├── controller/
│   │   ├── add_bookmark.php    # Tambah bookmark
│   │   ├── delete_bookmark.php # Hapus bookmark
│   │   ├── bookmark_controller.php  # Ambil data bookmark
│   │   ├── get_detail.php      # Ambil detail film
│   │   ├── get_review.php      # Ambil review film
│   │   └── tambah_review.php   # Tambah review/komentar
│   └── view/
│       ├── index.php           # Halaman dashboard user
│       ├── detail_page.php     # Halaman detail film
│       └── bookmark_page.php   # Halaman bookmark user
│
└── README.md                   # File dokumentasi ini
```

---

## Konfigurasi Database

### Tabel `users`
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | INT | Primary key, auto increment |
| name | VARCHAR(100) | Username (unique) |
| email | VARCHAR(100) | Email (unique) |
| password_hash | VARCHAR(255) | Password terenkripsi (BCRYPT) |
| role | VARCHAR(20) | 'admin' atau 'user' (default: 'user') |
| created_at | TIMESTAMP | Tanggal pembuatan akun |

### Tabel `movie`
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | INT | Primary key, auto increment |
| judul | VARCHAR(255) | Judul film |
| genre | VARCHAR(50) | Genre film (romance, action, comedy, horror) |
| sutradara | VARCHAR(100) | Nama sutradara |
| gambar | LONGTEXT | URL gambar poster |
| sinopsis | TEXT | Deskripsi/sinopsis film |
| created_at | TIMESTAMP | Tanggal penambahan |

### Tabel `review`
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | INT | Primary key, auto increment |
| id_user | INT | Foreign key ke users.id |
| id_movie | INT | Foreign key ke movie.id |
| konten | TEXT | Isi review/komentar |
| created_at | TIMESTAMP | Tanggal review dibuat |

### Tabel `bookmark`
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | INT | Primary key, auto increment |
| id_user | INT | Foreign key ke users.id |
| id_movie | INT | Foreign key ke movie.id |
| created_at | TIMESTAMP | Tanggal bookmark dibuat |
| UNIQUE | (id_user, id_movie) | Prevent duplicate bookmarks |

---

## Panduan Pengguna

### Untuk Admin

#### 1. Login
- Buka `/project_sertifikasi/` → klik **LOGIN**
- Masukkan username dan password admin
- Anda akan diarahkan ke **Admin Dashboard**

#### 2. Tambah Film
- Di dashboard, klik **Tambah Film**
- Isi form dengan detail film (judul, genre, sutradara, gambar, sinopsis)
- Klik **Submit Film**

#### 3. Edit Film
- Di dashboard, klik tombol **Edit** pada film yang ingin diubah
- Ubah data film di form
- Klik **Update**

#### 4. Hapus Film
- Di dashboard, klik tombol **Delete** pada film yang ingin dihapus
- Konfirmasi penghapusan di dialog

#### 5. Manajemen Komentar
- Di navbar, klik **Komentar**
- Lihat semua komentar dari user
- Klik **Hapus** untuk menghapus komentar yang tidak sesuai
- Konfirmasi penghapusan

#### 6. Logout
- Klik **Logout** di navbar

---

### Untuk User

#### 1. Register
- Buka `/project_sertifikasi/` → klik **REGISTER**
- Isi form (username, email, password, konfirmasi password)
- Klik **Submit**
- Redirect ke halaman login, login dengan akun baru

#### 2. Login
- Buka `/project_sertifikasi/` → klik **LOGIN**
- Masukkan email dan password
- Anda akan diarahkan ke **User Dashboard**

#### 3. Browse Film
- Di dashboard user, lihat daftar film yang tersedia
- Setiap film ditampilkan sebagai card dengan gambar poster
- Hover di atas card akan zoom efek

#### 4. Lihat Detail Film
- Klik pada card film untuk melihat detail
- Halaman detail menampilkan: poster, judul, genre, sutradara, sinopsis
- Lihat review dari user lain

#### 5. Tambah Review/Komentar
- Di halaman detail film, scroll ke bawah ke form review
- Tulis review/komentar Anda di textarea
- Klik **Submit Review**
- Review akan ditampilkan di halaman detail film

#### 6. Bookmark Film
- Di halaman detail film, klik tombol **Bookmark** (hati icon)
- Film akan disimpan di bookmark pribadi Anda

#### 7. Lihat Bookmark
- Di navbar, klik **Bookmark Saya**
- Lihat daftar film yang sudah di-bookmark
- Klik film untuk melihat detail
- Klik **Hapus dari Bookmark** untuk menghapus

#### 8. Logout
- Klik **Logout** di navbar

---

## Dokumentasi API

### Session Variables
```php
$_SESSION['user_id']      // ID user yang login
$_SESSION['user_name']    // Nama user
$_SESSION['user_role']    // Role user ('admin' atau 'user')
$_SESSION['logged_in']    // Status login (true/false)
```

### Controllers & Fungsi

#### Auth Module

**`login.php`**
- Method: POST
- Input: `username`, `password`
- Output: Set session dan redirect ke dashboard
- Error: redirect ke login dengan parameter error

**`register_controller.php`**
- Method: POST
- Input: `username`, `email`, `password`, `confirm_password`
- Validasi: password match, email unique, username unique
- Output: Insert ke database dan redirect ke login

**`logout.php`**
- Method: GET
- Output: Destroy session dan redirect ke landing page

---

#### Admin Module

**`add_movie.php`**
- Method: POST
- Input: `judul`, `genre`, `sutradara`, `gambar`, `sinopsis`
- Output: Insert film ke database
- Protection: Admin only

**`update_movie.php`**
- Method: POST
- Input: `movie_id`, `judul`, `genre`, `sutradara`, `gambar`, `sinopsis`
- Output: Update film di database
- Protection: Admin only

**`delete.php`**
- Method: GET
- Input: `id` (movie_id)
- Output: Delete film dari database
- Protection: Admin only

**`get_comments.php`**
- Method: Include (no direct call)
- Query: SELECT review dengan JOIN users dan movie
- Output: $comments (hasil query)

**`delete_comment.php`**
- Method: GET
- Input: `id` (review_id)
- Output: Delete review dari database
- Protection: Admin only

---

#### User Module

**`tambah_review.php`**
- Method: POST
- Input: `id` (movie_id), `review` (konten)
- Output: Insert review ke database
- Protection: User login only

**`add_bookmark.php`**
- Method: GET/POST
- Input: `id` (movie_id)
- Output: Insert bookmark ke database
- Validasi: Prevent duplicate bookmark
- Protection: User login only

**`delete_bookmark.php`**
- Method: GET
- Input: `id` (bookmark_id)
- Output: Delete bookmark dari database
- Protection: User login only

---

## 🔒 Keamanan

### Best Practices yang Diimplementasikan
- Password hashing 
- Session-based authentication
- SQL Injection prevention menggunakan prepared statements
- Role-based access control (admin vs user)
- Input sanitization menggunakan `htmlspecialchars()`


## 📄 License

Project ini dibuat untuk keperluan sertifikasi. Penggunaan dan modifikasi bebas sesuai kebutuhan.

---

## ✨ Changelog

### v2.0 (Current)
- Core functionality: add/edit/delete film
- User authentication & registration
- Review/komentar system
- Bookmark feature
- Admin comment management
- Responsive UI dengan Bootstrap 5

---

**Terima kasih telah menggunakan MovieMark! 🎬**

Last updated: October 2025
