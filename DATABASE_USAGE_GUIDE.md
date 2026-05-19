# 📋 DATABASE USAGE DOCUMENTATION

## File yang Berkaitan dengan Database

### Configuration Files
- [app/config/app.php](app/config/app.php) - Define constants untuk DB credentials
- [app/config/db-connection.php](app/config/db-connection.php) - MySQLi connection
- [app/core/Database.php](app/core/Database.php) - Database class wrapper
- [app/core/db-connection.php](app/core/db-connection.php) - Alternative db-connection

### Models/Logic Files
- [app/models/register.php](app/models/register.php) - User registration logic
- [app/models/login.php](app/models/login.php) - User login logic
- [app/models/create.php](app/models/create.php) - Create post/event
- [app/models/edit_controller.php](app/models/edit_controller.php) - Edit post/event
- [app/models/delete.php](app/models/delete.php) - Delete post/event
- [app/models/detail_controller.php](app/models/detail_controller.php) - Event detail & registration
- [app/models/update.php](app/models/update.php) - Update post/event

---

## Operational Data Flow

### 1. User Registration Flow
```
HTML Form (register.html)
    ↓
app/models/register.php
    ├─ Validate input (name, email, password)
    ├─ Check if email exists
    ├─ Hash password with password_hash()
    ├─ INSERT INTO users (name, email, password)
    └─ Store user data in $_SESSION['user']
```

**File:** [app/models/register.php](app/models/register.php)  
**Query:**
```php
INSERT INTO users (name, email, password) VALUES (?, ?, ?)
```

---

### 2. User Login Flow
```
HTML Form (login.html)
    ↓
app/models/login.php
    ├─ Get email & password from form
    ├─ SELECT * FROM users WHERE email = ?
    ├─ Verify password with password_verify()
    └─ Set $_SESSION['user'] with user data
```

**File:** [app/models/login.php](app/models/login.php)  
**Query:**
```php
SELECT * FROM users WHERE email = ?
```

---

### 3. Create Post/Event Flow
```
HTML Form (create.html) with file upload
    ↓
app/models/create.php
    ├─ Get title, content from form
    ├─ Get user_id from $_SESSION['user']['id']
    ├─ Upload gambar ke public/assets/foto/
    ├─ Rename file dengan timestamp
    ├─ INSERT INTO posts (title, content, user_id, image_path)
    └─ Redirect ke homepage
```

**File:** [app/models/create.php](app/models/create.php)  
**Query:**
```php
INSERT INTO posts (title, content, user_id, image_path) 
VALUES ('$title', '$content', '$user_id', '$image_path')
```

---

### 4. View Event Detail & Register Flow
```
URL: /detail?id=X
    ↓
app/models/detail_controller.php
    ├─ SELECT * FROM posts WHERE id = ?
    ├─ SELECT * FROM registrations WHERE event_id = ? ORDER BY id DESC
    │
    └─ If POST register_event:
       ├─ Get name, class, phone_number from form
       ├─ Get post_id dari form
       ├─ Get user_id dari $_SESSION['user']['id']
       ├─ INSERT INTO registrations (event_id, user_id, name, class, phone_number)
       └─ Redirect to detail page
```

**File:** [app/models/detail_controller.php](app/models/detail_controller.php)  
**Queries:**
```php
SELECT * FROM posts WHERE id = ?
INSERT INTO registrations (event_id, user_id, name, class, phone_number) VALUES (?, ?, ?, ?, ?)
SELECT * FROM registrations WHERE event_id = ? ORDER BY id DESC
```

---

### 5. Edit Post/Event Flow
```
URL: /edit?id=X
    ↓
app/models/edit_controller.php
    ├─ Check user_id matches (owner check)
    ├─ SELECT * FROM posts WHERE id = ? AND user_id = ?
    │
    └─ If POST update:
       ├─ Get title, content, gambar
       ├─ Handle image upload if new image
       ├─ UPDATE posts SET title = ?, content = ?, image_path = ? WHERE id = ?
       └─ Redirect to homepage
```

**File:** [app/models/edit_controller.php](app/models/edit_controller.php)  
**Query:**
```php
SELECT * FROM posts WHERE id = $id AND user_id = $user_id
UPDATE posts SET ... WHERE id = ?
```

---

### 6. Delete Post/Event Flow
```
URL: /delete (POST)
    ↓
app/models/delete.php
    ├─ Get id dari $_POST['id']
    ├─ SELECT image_path FROM posts WHERE id = ?
    ├─ Delete file dari filesystem
    ├─ DELETE FROM posts WHERE id = ?
    └─ Redirect to homepage
```

**File:** [app/models/delete.php](app/models/delete.php)  
**Queries:**
```php
SELECT image_path FROM posts WHERE id = ?
DELETE FROM posts WHERE id = ?
```

---

## Database Relationship

### User to Posts (1:N)
- 1 User bisa membuat banyak Posts
- Ketika user dihapus, semua posts-nya juga terhapus (ON DELETE CASCADE)

### User to Registrations (1:N)
- 1 User bisa mendaftar ke banyak Events
- Ketika user dihapus, semua registrasi-nya terhapus (ON DELETE CASCADE)

### Post to Registrations (1:N)
- 1 Post/Event bisa memiliki banyak Registrations
- Ketika post dihapus, semua registrasi untuk event itu terhapus (ON DELETE CASCADE)

---

## Current Limitations & Notes

### ⚠️ Security Issues Found
1. **SQL Injection Risk**: File `edit_controller.php` dan `delete.php` menggunakan string interpolation langsung
   ```php
   $query = mysqli_query($connection, "SELECT * FROM posts WHERE id = $id AND user_id = $user_id");
   ```
   **Should be:**
   ```php
   $stmt = $connection->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
   $stmt->bind_param("ii", $id, $user_id);
   $stmt->execute();
   ```

2. **Inconsistent Connection Methods**: Mix antara MySQLi dan PDO
   - Lebih baik standardkan ke satu method

### 📝 Recommendations
1. Gunakan prepared statements di semua queries
2. Standardisasi connection method (gunakan MySQLi atau PDO, jangan campur)
3. Tambah `created_at` dan `updated_at` columns di semua tables
4. Tambah validasi email format sebelum insert
5. Tambah error handling yang lebih baik
6. Implementasi soft deletes jika diperlukan untuk audit trail

### 🔄 Missing Features
1. **Migrations** - Tidak ada sistem migration untuk version control database
2. **Backup** - Tidak ada automated backup
3. **Logging** - Tidak ada audit log untuk changes
4. **Transactions** - Tidak digunakan, berisiko data inconsistency

---

## Testing Database Connection

Untuk test koneksi database:

```php
<?php
require_once __DIR__ . '/app/config/db-connection.php';

if ($connection) {
    echo "✓ Database connection successful!";
    
    // Check tables
    $result = mysqli_query($connection, "SHOW TABLES");
    echo "<br>Tables in database:<br>";
    while ($row = mysqli_fetch_row($result)) {
        echo "- " . $row[0] . "<br>";
    }
} else {
    echo "✗ Database connection failed: " . mysqli_connect_error();
}
?>
```

---

## Backup & Export Commands

### Export Database (via Command Line)
```bash
# Export dengan struktur dan data
mysqldump -u root -p sentra > sentra_backup.sql

# Export hanya struktur
mysqldump -u root -p --no-data sentra > sentra_structure.sql

# Export hanya data
mysqldump -u root -p --no-create-info sentra > sentra_data.sql
```

### Import Database
```bash
mysql -u root -p sentra < sentra_backup.sql
```

### Via phpMyAdmin
1. Buka phpMyAdmin
2. Select database `sentra`
3. Tab "Export"
4. Pilih format SQL
5. Click "Go"

---

## Summary

**Database Name**: sentra  
**Tables**: 3 (users, posts, registrations)  
**Total Relationships**: 4 (user→posts, user→registrations, posts→registrations)  
**Connection**: MySQLi (primary), PDO (emergency fallback)  
**Status**: ✓ Fully Operational

Saat ini semua fitur core (register, login, create post, register event) berjalan dengan baik, tapi perlu improvement dari segi security dan best practices.
