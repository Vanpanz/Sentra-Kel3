# 📊 DATABASE STRUCTURE - SENTRA

## Database Information
- **Database Name**: `sentra`
- **Host**: `localhost`
- **User**: `root`
- **Password**: (kosong/empty)
- **Charset**: `utf8mb4`

---

## Tables Structure

### 1. **USERS** Table
Menyimpan data pengguna yang terdaftar di sistem.

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

**Kolom Utama:**
- `id` - ID unik pengguna (Primary Key)
- `name` - Nama pengguna
- `email` - Email pengguna (unik, tidak boleh duplikat)
- `password` - Password terenkripsi dengan PASSWORD_DEFAULT (bcrypt)
- `created_at` - Waktu akun dibuat
- `updated_at` - Waktu akun terakhir diupdate

**Fitur:**
- Password di-hash menggunakan `password_hash()` dengan algoritma bcrypt
- Email dijadikan UNIQUE constraint

---

### 2. **POSTS** Table
Menyimpan semua postingan/event yang dibuat pengguna.

```sql
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content LONGTEXT NOT NULL,
  user_id INT NOT NULL,
  image_path VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

**Kolom Utama:**
- `id` - ID unik postingan (Primary Key)
- `title` - Judul postingan/event
- `content` - Isi postingan/deskripsi event
- `user_id` - ID pengguna yang membuat postingan (Foreign Key)
- `image_path` - Path relatif ke gambar banner/header event (misal: `assets/foto/timestamp_nama.jpg`)
- `created_at` - Waktu postingan dibuat
- `updated_at` - Waktu postingan terakhir diupdate

**Fitur:**
- `ON DELETE CASCADE` - Jika user dihapus, semua postingannya juga terhapus
- Menyimpan path relatif gambar dari folder `public/assets/foto/`
- Gambar upload di-rename dengan timestamp untuk menghindari duplikasi

---

### 3. **REGISTRATIONS** Table
Menyimpan data pendaftaran peserta untuk setiap event/postingan.

```sql
CREATE TABLE registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_id INT NOT NULL,
  user_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  class VARCHAR(100),
  phone_number VARCHAR(20),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (event_id) REFERENCES posts(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

**Kolom Utama:**
- `id` - ID unik registrasi (Primary Key)
- `event_id` - ID event/postingan yang diikuti (Foreign Key ke posts)
- `user_id` - ID pengguna yang mendaftar (Foreign Key ke users)
- `name` - Nama peserta (bisa berbeda dari nama di tabel users)
- `class` - Kelas/tingkat peserta (misal: XI-A, XII-B)
- `phone_number` - Nomor telepon peserta
- `created_at` - Waktu pendaftaran

**Fitur:**
- `ON DELETE CASCADE` - Jika event dihapus, registrasi terhapus juga
- `ON DELETE CASCADE` - Jika user dihapus, registrasi terhapus juga

---

## Relationships Diagram

```
┌─────────────┐
│   USERS     │
├─────────────┤
│ id (PK)     │
│ name        │
│ email       │
│ password    │
└──────┬──────┘
       │
       │ 1:N (one user has many posts)
       │
       ▼
┌─────────────────┐
│     POSTS       │
├─────────────────┤
│ id (PK)         │
│ title           │
│ content         │
│ user_id (FK)    │──────┐
│ image_path      │      │
└────────┬────────┘      │
         │               │
         │ 1:N (one post has many registrations)
         │               │
         ▼               │
┌──────────────────────┐ │
│  REGISTRATIONS       │ │
├──────────────────────┤ │
│ id (PK)              │ │
│ event_id (FK)  ──────┼─┘
│ user_id (FK)   ──────┼────────────┐
│ name                 │            │
│ class                │            │
│ phone_number         │            │
└──────────────────────┘            │
                                    │
                                   (FK to USERS)
```

---

## Sample SQL Queries

### Insert User (Register)
```sql
INSERT INTO users (name, email, password)
VALUES ('John Doe', 'john@email.com', '$2y$10$...(hashed password)...');
```

### Insert Post (Create Event)
```sql
INSERT INTO posts (title, content, user_id, image_path)
VALUES ('Web Development Workshop', 'Learn HTML, CSS, JavaScript...', 1, 'assets/foto/1706789456_workshop.jpg');
```

### Insert Registration
```sql
INSERT INTO registrations (event_id, user_id, name, class, phone_number)
VALUES (1, 2, 'Jane Smith', 'XI-A', '08123456789');
```

### Get All Posts with Creator Info
```sql
SELECT p.id, p.title, p.content, p.image_path, u.name as creator, u.email
FROM posts p
JOIN users u ON p.user_id = u.id
ORDER BY p.created_at DESC;
```

### Get Event Registrants
```sql
SELECT r.*, u.email as user_email
FROM registrations r
JOIN users u ON r.user_id = u.id
WHERE r.event_id = 1
ORDER BY r.created_at DESC;
```

---

## Konfigurasi Database Connection

File koneksi database tersimpan di:
- [app/config/app.php](app/config/app.php) - Konfigurasi dengan define constants
- [app/config/db-connection.php](app/config/db-connection.php) - Connection menggunakan mysqli
- [app/core/Database.php](app/core/Database.php) - Database class wrapper

Contoh konfigurasi:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sentra');
```

---

## File Upload Directory

Gambar-gambar yang di-upload disimpan di:
- **Posts Image**: `public/assets/foto/`
- **User Avatar**: `public/assets/foto-users/`

File di-rename dengan timestamp untuk menghindari duplikasi:
```
{timestamp}_{original_filename}
Contoh: 1706789456_workshop.jpg
```

---

## Catatan Penting

1. **Password Hashing**: Semua password di-hash dengan `password_hash()` menggunakan algoritma bcrypt (PASSWORD_DEFAULT)
2. **Security**: Gunakan prepared statements untuk mencegah SQL injection
3. **Validasi Email**: Email harus unik (UNIQUE constraint)
4. **Cascade Delete**: Penghapusan data parent akan otomatis menghapus data child
5. **Charset**: Database menggunakan utf8mb4 untuk support emoji dan karakter spesial

---

## Next Steps untuk Setup Database

Jika database belum ada, jalankan query di atas untuk membuat tables. Atau gunakan command MySQL:

```bash
mysql -u root -p < DATABASE_STRUCTURE.sql
```

Atau login ke phpMyAdmin dan execute SQL commands secara manual.
