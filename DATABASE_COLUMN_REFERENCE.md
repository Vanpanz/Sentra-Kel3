# 🔍 DETAILED COLUMN REFERENCE

## Table: USERS

| Column | Type | Null | Default | Key | Description |
|--------|------|------|---------|-----|-------------|
| id | INT | NO | AUTO_INCREMENT | PK | ID unik untuk setiap user |
| name | VARCHAR(255) | NO | - | - | Nama pengguna lengkap |
| email | VARCHAR(255) | NO | - | UNI | Email (harus unik, tidak boleh duplikat) |
| password | VARCHAR(255) | NO | - | - | Password yang sudah di-hash dengan bcrypt |
| created_at | TIMESTAMP | NO | CURRENT_TIMESTAMP | - | Waktu user account dibuat |
| updated_at | TIMESTAMP | NO | CURRENT_TIMESTAMP | - | Waktu account terakhir diupdate |

### Example Data
```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "password": "$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/KFm",
  "created_at": "2024-02-01 10:30:00",
  "updated_at": "2024-02-01 10:30:00"
}
```

### Validation Rules
- `name`: Required, max 255 chars
- `email`: Required, valid email format, unique
- `password`: Min 8 chars, must use bcrypt hashing

### Usage
```php
// Register user
$name = "John Doe";
$email = "john@example.com";
$hashedPassword = password_hash("password123", PASSWORD_DEFAULT);

INSERT INTO users (name, email, password) VALUES (?, ?, ?)

// Login user
SELECT * FROM users WHERE email = ?
password_verify($inputPassword, $hashInDatabase)
```

---

## Table: POSTS

| Column | Type | Null | Default | Key | Description |
|--------|------|------|---------|-----|-------------|
| id | INT | NO | AUTO_INCREMENT | PK | ID unik untuk setiap post/event |
| title | VARCHAR(255) | NO | - | - | Judul event/postingan |
| content | LONGTEXT | NO | - | - | Deskripsi lengkap event |
| user_id | INT | NO | - | FK | ID pembuat event (referensi ke users.id) |
| image_path | VARCHAR(255) | YES | NULL | - | Path relatif ke gambar banner (dari public/) |
| created_at | TIMESTAMP | NO | CURRENT_TIMESTAMP | - | Waktu event dibuat |
| updated_at | TIMESTAMP | NO | CURRENT_TIMESTAMP | - | Waktu event terakhir diupdate |

### Example Data
```json
{
  "id": 1,
  "title": "Web Development Workshop",
  "content": "Learn HTML, CSS, JavaScript, and PHP...",
  "user_id": 1,
  "image_path": "assets/foto/1706789456_workshop.jpg",
  "created_at": "2024-02-01 11:00:00",
  "updated_at": "2024-02-01 11:00:00"
}
```

### Validation Rules
- `title`: Required, max 255 chars
- `content`: Required, can be very long
- `user_id`: Required, must exist in users table
- `image_path`: Optional, relative path format

### Image Upload
```php
// File upload format:
// Original: "workshop.jpg" uploaded at timestamp 1706789456
// Saved as: "1706789456_workshop.jpg"
// Path stored: "assets/foto/1706789456_workshop.jpg"

// Directory structure:
// public/
// └── assets/
//     └── foto/           // <- Images stored here
//         ├── 1706789456_workshop.jpg
//         ├── 1706789567_mobile.jpg
//         └── ...
```

### Usage
```php
// Create event
INSERT INTO posts (title, content, user_id, image_path) 
VALUES ('Web Workshop', 'Learn web dev...', 1, 'assets/foto/123_image.jpg')

// Get all events
SELECT p.*, u.name as creator FROM posts p 
JOIN users u ON p.user_id = u.id 
ORDER BY p.created_at DESC

// Update event
UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?

// Delete event (cascade to registrations)
DELETE FROM posts WHERE id = ?
```

---

## Table: REGISTRATIONS

| Column | Type | Null | Default | Key | Description |
|--------|------|------|---------|-----|-------------|
| id | INT | NO | AUTO_INCREMENT | PK | ID unik untuk setiap registrasi |
| event_id | INT | NO | - | FK | ID event yang diikuti (referensi ke posts.id) |
| user_id | INT | NO | - | FK | ID user yang mendaftar (referensi ke users.id) |
| name | VARCHAR(255) | NO | - | - | Nama lengkap peserta |
| class | VARCHAR(100) | YES | NULL | - | Kelas/tingkat peserta (XI-A, XII-B, dll) |
| phone_number | VARCHAR(20) | YES | NULL | - | Nomor telepon kontak peserta |
| created_at | TIMESTAMP | NO | CURRENT_TIMESTAMP | - | Waktu pendaftaran |

### Example Data
```json
{
  "id": 1,
  "event_id": 1,
  "user_id": 2,
  "name": "Jane Smith",
  "class": "XI-A",
  "phone_number": "08123456789",
  "created_at": "2024-02-01 14:30:00"
}
```

### Validation Rules
- `event_id`: Required, must exist in posts table
- `user_id`: Required, must exist in users table
- `name`: Required, max 255 chars (bisa berbeda dari nama di users table)
- `class`: Optional, max 100 chars
- `phone_number`: Optional, max 20 chars

### Usage
```php
// Register to event
INSERT INTO registrations (event_id, user_id, name, class, phone_number) 
VALUES (?, ?, ?, ?, ?)

// Get all participants for an event
SELECT r.* FROM registrations r 
WHERE r.event_id = ? 
ORDER BY r.created_at DESC

// Get all registrations for a user
SELECT r.*, p.title as event_name FROM registrations r 
JOIN posts p ON r.event_id = p.id 
WHERE r.user_id = ?

// Count participants
SELECT COUNT(*) as total FROM registrations WHERE event_id = ?
```

---

## Data Types Explained

### VARCHAR(n)
- Variable length string, max n characters
- `VARCHAR(255)` adalah standar untuk names, titles, emails
- `VARCHAR(20)` untuk phone numbers
- Lebih efisien dari CHAR karena hanya menyimpan string yang dibutuhkan

### LONGTEXT
- Untuk text yang sangat panjang (hingga 4GB)
- Digunakan untuk `content` di table posts untuk deskripsi yang detail

### INT
- Integer numbers
- Range: -2,147,483,648 to 2,147,483,647
- Digunakan untuk IDs dan foreign keys

### TIMESTAMP
- Otomatis merekam waktu (format: YYYY-MM-DD HH:MM:SS)
- `DEFAULT CURRENT_TIMESTAMP` - otomatis terisi waktu sekarang
- `ON UPDATE CURRENT_TIMESTAMP` - otomatis update saat data berubah

---

## Indexes & Performance

### Indexes Created
```sql
-- Users table
INDEX idx_email (email)

-- Posts table
INDEX idx_user_id (user_id)
INDEX idx_created_at (created_at)

-- Registrations table
INDEX idx_event_id (event_id)
INDEX idx_user_id (user_id)
INDEX idx_created_at (created_at)
```

### Why Indexes?
- **idx_email**: User login menggunakan email, frequent lookup
- **idx_user_id**: Sering filter by user
- **idx_created_at**: Sering sort by tanggal, untuk pagination
- **idx_event_id**: Sering cari participants untuk satu event

### Impact
- ✓ Query lebih cepat (especially dengan JOIN)
- ✓ Lookup by email jadi O(log n) instead of O(n)
- ✗ Insert/update sedikit lebih lambat (update index juga)
- ✗ Lebih banyak disk space

---

## Relationships & Constraints

### Foreign Key: posts.user_id → users.id
```
When user is deleted:
- action: ON DELETE CASCADE
- result: All posts from that user are deleted
- impact: registrations for those posts are also deleted
```

### Foreign Key: registrations.event_id → posts.id
```
When post is deleted:
- action: ON DELETE CASCADE
- result: All registrations for that event are deleted
```

### Foreign Key: registrations.user_id → users.id
```
When user is deleted:
- action: ON DELETE CASCADE
- result: All registrations by that user are deleted
```

### Cascade Chain Example
```
Delete User ID=1
  ↓
CASCADE Delete all Posts where user_id=1
  ↓
CASCADE Delete all Registrations where event_id in (deleted posts)
```

---

## NULL vs NOT NULL

### NOT NULL Columns
- `users.name` - User harus punya nama
- `users.email` - Email wajib untuk login
- `users.password` - Password wajib
- `posts.title` - Event harus punya judul
- `posts.content` - Deskripsi event wajib
- `posts.user_id` - Harus tahu siapa creator
- `registrations.event_id` - Harus register ke event tertentu
- `registrations.user_id` - Harus register sebagai user tertentu
- `registrations.name` - Nama peserta wajib

### NULLABLE Columns
- `posts.image_path` - Image optional, bisa NULL
- `registrations.class` - Kelas mungkin tidak diketahui
- `registrations.phone_number` - Phone optional

---

## Query Examples

### Basic CRUD

#### CREATE
```sql
-- Insert user
INSERT INTO users (name, email, password) 
VALUES ('John Doe', 'john@example.com', '$2y$10$...');

-- Insert post
INSERT INTO posts (title, content, user_id, image_path) 
VALUES ('Workshop', 'Learn...', 1, 'assets/foto/123_img.jpg');

-- Insert registration
INSERT INTO registrations (event_id, user_id, name, class, phone_number) 
VALUES (1, 2, 'Jane Smith', 'XI-A', '08123456789');
```

#### READ
```sql
-- Get user by email
SELECT * FROM users WHERE email = 'john@example.com';

-- Get all posts with creator info
SELECT p.*, u.name as creator_name 
FROM posts p 
JOIN users u ON p.user_id = u.id 
ORDER BY p.created_at DESC;

-- Get registrations for event
SELECT * FROM registrations 
WHERE event_id = 1 
ORDER BY created_at DESC;
```

#### UPDATE
```sql
-- Update post
UPDATE posts 
SET title = 'New Title', updated_at = CURRENT_TIMESTAMP 
WHERE id = 1 AND user_id = 1;

-- Update user
UPDATE users 
SET name = 'New Name' 
WHERE id = 1;
```

#### DELETE
```sql
-- Delete post (cascades to registrations)
DELETE FROM posts WHERE id = 1;

-- Delete registration
DELETE FROM registrations WHERE id = 1;

-- Delete user (cascades to posts and registrations)
DELETE FROM users WHERE id = 1;
```

---

## Stats & Queries

### Count data
```sql
SELECT 
  (SELECT COUNT(*) FROM users) as total_users,
  (SELECT COUNT(*) FROM posts) as total_posts,
  (SELECT COUNT(*) FROM registrations) as total_registrations;
```

### Posts per user
```sql
SELECT u.name, COUNT(p.id) as post_count 
FROM users u 
LEFT JOIN posts p ON u.id = p.user_id 
GROUP BY u.id, u.name;
```

### Registrations per event
```sql
SELECT p.title, COUNT(r.id) as participant_count 
FROM posts p 
LEFT JOIN registrations r ON p.id = r.event_id 
GROUP BY p.id, p.title;
```

---

**Last Updated**: May 19, 2026  
**Reference Version**: 1.0
