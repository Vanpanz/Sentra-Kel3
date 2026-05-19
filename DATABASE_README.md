# 🗄️ DATABASE DOCUMENTATION - QUICK REFERENCE

## 📁 Files Created

### 1. **DATABASE_STRUCTURE.md** 
📄 [Baca Dokumentasi](DATABASE_STRUCTURE.md)
- Penjelasan lengkap struktur 3 tables utama (users, posts, registrations)
- ERD (Entity Relationship Diagram)
- Sample SQL queries
- Informasi tentang konfigurasi dan file upload
- Catatan penting tentang security

### 2. **DATABASE_STRUCTURE.sql**
🔧 [File SQL](DATABASE_STRUCTURE.sql)
- SQL script siap pakai untuk membuat semua tables dari nol
- Includes indexes untuk performa
- Comments lengkap untuk setiap column
- Bisa langsung dijalankan di MySQL/phpMyAdmin

### 3. **DATABASE_USAGE_GUIDE.md**
📚 [Panduan Lengkap](DATABASE_USAGE_GUIDE.md)
- Penjelasan data flow untuk setiap feature
- File-file PHP yang terlibat di setiap operation
- Query details untuk setiap action
- Security issues yang ditemukan
- Recommendations untuk improvement

### 4. **DATABASE_SAMPLE_DATA.sql**
🎯 [Data Test](DATABASE_SAMPLE_DATA.sql)
- Sample users, posts, dan registrations untuk testing
- Semua password sudah di-hash dengan bcrypt
- Query verification untuk checking data

---

## 🚀 Quick Start

### Setup Database (First Time)

#### Method 1: Via MySQL Command Line
```bash
mysql -u root -p < DATABASE_STRUCTURE.sql
```

#### Method 2: Via phpMyAdmin
1. Buka phpMyAdmin (biasanya: http://localhost/phpmyadmin)
2. Click tab "SQL"
3. Copy-paste isi file `DATABASE_STRUCTURE.sql`
4. Click "Go"

#### Method 3: Manual
Login ke MySQL dan execute queries dari [DATABASE_STRUCTURE.sql](DATABASE_STRUCTURE.sql)

### Insert Sample Data

Setelah database terbuat, jalankan sample data:

```bash
mysql -u root -p sentra < DATABASE_SAMPLE_DATA.sql
```

Atau via phpMyAdmin, execute queries dari [DATABASE_SAMPLE_DATA.sql](DATABASE_SAMPLE_DATA.sql)

---

## 📊 Current Database State

| Table | Rows | Status |
|-------|------|--------|
| users | 4 | ✓ Ready (setelah insert sample data) |
| posts | 4 | ✓ Ready (setelah insert sample data) |
| registrations | 8 | ✓ Ready (setelah insert sample data) |

### Database Connection Info
- **Host**: localhost
- **User**: root
- **Password**: (empty)
- **Database**: sentra
- **Charset**: utf8mb4

---

## 🔑 Key Information

### Users Table
```
ID | Name | Email | Password
1  | Admin User | admin@sentra.com | (hashed: password123)
2  | John Doe | john@example.com | (hashed: password123)
3  | Jane Smith | jane@example.com | (hashed: password123)
4  | Bob Wilson | bob@example.com | (hashed: password123)
```

### Posts/Events (4 Events)
- Web Development Workshop
- Mobile App Development
- Data Science Fundamentals
- UI/UX Design Workshop

### Registrations (8 Pendaftaran)
- User mendaftar ke berbagai events
- Data: nama, kelas, nomor telepon

---

## ⚠️ Important Notes

### Database Relationships
```
Users (1) ──────> (N) Posts
  ↓                    ↓
  └────> (N) Registrations <─┘
```

- Jika User dihapus → semua Posts & Registrations juga terhapus
- Jika Post dihapus → semua Registrations untuk post itu terhapus

### Current Issues
1. ❌ SQL Injection vulnerability di beberapa file
2. ⚠️ Mixed connection methods (MySQLi + PDO)
3. 📝 Recommend refactor dengan prepared statements

---

## 📖 Related Files in Project

### Configuration
- [app/config/app.php](app/config/app.php)
- [app/config/db-connection.php](app/config/db-connection.php)

### Database Logic
- [app/models/register.php](app/models/register.php) - User registration
- [app/models/login.php](app/models/login.php) - User login
- [app/models/create.php](app/models/create.php) - Create event
- [app/models/edit_controller.php](app/models/edit_controller.php) - Edit event
- [app/models/delete.php](app/models/delete.php) - Delete event
- [app/models/detail_controller.php](app/models/detail_controller.php) - Event detail & register

---

## 🛠️ Useful SQL Commands

### View all data
```sql
SELECT * FROM users;
SELECT * FROM posts;
SELECT * FROM registrations;
```

### Check indexes
```sql
SHOW INDEXES FROM users;
SHOW INDEXES FROM posts;
SHOW INDEXES FROM registrations;
```

### Count data
```sql
SELECT COUNT(*) as total_users FROM users;
SELECT COUNT(*) as total_posts FROM posts;
SELECT COUNT(*) as total_registrations FROM registrations;
```

### Export database
```bash
mysqldump -u root -p sentra > backup.sql
```

### Import database
```bash
mysql -u root -p sentra < backup.sql
```

---

## 📞 Testing Credentials

After inserting sample data, you can test login with:

```
Email: john@example.com
Password: password123
```

Or any of the 4 test users with same password.

---

## ✅ Checklist

- [ ] Database "sentra" created
- [ ] 3 tables created (users, posts, registrations)
- [ ] Relationships configured (foreign keys)
- [ ] Sample data inserted
- [ ] Can connect from PHP application
- [ ] Can insert/update/delete data
- [ ] Backups created

---

## 📚 Additional Resources

- [MySQL Documentation](https://dev.mysql.com/doc/)
- [PHP MySQLi Documentation](https://www.php.net/manual/en/book.mysqli.php)
- [SQL Best Practices](https://en.wikipedia.org/wiki/SQL)

---

**Last Updated**: May 19, 2026  
**Database Version**: 1.0  
**Status**: ✓ Complete & Ready to Use
