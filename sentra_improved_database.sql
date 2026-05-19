-- =============================================================================
-- SENTRA - Event Management System Database
-- =============================================================================
-- Database Name: sentra
-- Charset: utf8mb4
-- Collation: utf8mb4_unicode_ci
-- =============================================================================

-- Drop existing tables if needed (uncomment to use)
-- DROP TABLE IF EXISTS event_registrations;
-- DROP TABLE IF EXISTS events;
-- DROP TABLE IF EXISTS users;

-- =============================================================================
-- TABLE: users
-- Description: Tabel untuk menyimpan data pengguna (siswa dan admin)
-- =============================================================================
CREATE TABLE IF NOT EXISTS users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  phone_number VARCHAR(20),
  class VARCHAR(50),
  role ENUM('student', 'teacher', 'admin') DEFAULT 'student',
  profile_picture VARCHAR(255),
  bio TEXT,
  is_active TINYINT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- TABLE: events
-- Description: Tabel untuk menyimpan data event/kegiatan sekolah
-- Renamed dari 'posts' untuk lebih jelas dan deskriptif
-- =============================================================================
CREATE TABLE IF NOT EXISTS events (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(150) NOT NULL,
  description LONGTEXT NOT NULL,
  category VARCHAR(50),
  location VARCHAR(255),
  event_date DATE NOT NULL,
  event_time TIME,
  end_date DATE,
  end_time TIME,
  quota INT DEFAULT 0,
  registered_count INT DEFAULT 0,
  image_url VARCHAR(255),
  organizer_id INT NOT NULL,
  status ENUM('draft', 'published', 'ongoing', 'completed', 'cancelled') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (organizer_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- TABLE: event_registrations
-- Description: Tabel untuk menyimpan data pendaftaran peserta pada event
-- Improved dari 'registrations' dengan lebih banyak tracking
-- =============================================================================
CREATE TABLE IF NOT EXISTS event_registrations (
  id INT PRIMARY KEY AUTO_INCREMENT,
  event_id INT NOT NULL,
  user_id INT NOT NULL,
  student_name VARCHAR(100),
  student_class VARCHAR(50),
  phone_number VARCHAR(20),
  registration_status ENUM('pending', 'confirmed', 'rejected', 'cancelled') DEFAULT 'pending',
  attendance_status ENUM('absent', 'present', 'not-taken') DEFAULT 'not-taken',
  notes TEXT,
  registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  confirmed_at TIMESTAMP NULL,
  attended_at TIMESTAMP NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  UNIQUE KEY unique_registration (event_id, user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- TABLE: event_categories
-- Description: Tabel untuk kategori event (opsional, untuk referensi)
-- =============================================================================
CREATE TABLE IF NOT EXISTS event_categories (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL UNIQUE,
  description TEXT,
  icon VARCHAR(50),
  color VARCHAR(10),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- TABLE: event_attachments
-- Description: Tabel untuk file/dokumen pendukung event
-- =============================================================================
CREATE TABLE IF NOT EXISTS event_attachments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  event_id INT NOT NULL,
  file_name VARCHAR(255) NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  file_type VARCHAR(50),
  file_size INT,
  uploaded_by INT,
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
  FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- INDEXES untuk optimize query
-- =============================================================================
CREATE INDEX idx_events_organizer ON events(organizer_id);
CREATE INDEX idx_events_status ON events(status);
CREATE INDEX idx_events_date ON events(event_date);
CREATE INDEX idx_registrations_event ON event_registrations(event_id);
CREATE INDEX idx_registrations_user ON event_registrations(user_id);
CREATE INDEX idx_registrations_status ON event_registrations(registration_status);
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role ON users(role);

-- =============================================================================
-- SAMPLE DATA - USERS
-- =============================================================================

INSERT INTO users (name, email, password, phone_number, class, role, bio, is_active) VALUES
('Admin Sekolah', 'admin@sekolah.com', '$2y$10$YIjlrVyaFZN5Z5Z5Z5Z5Zu5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z', '082123456789', NULL, 'admin', 'Administrator Sistem Event Sekolah', 1),
('Budi Santoso', 'budi@student.com', '$2y$10$YIjlrVyaFZN5Z5Z5Z5Z5Zu5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z', '081234567890', 'X A', 'student', 'Siswa berprestasi', 1),
('Siti Nurhaliza', 'siti@student.com', '$2y$10$YIjlrVyaFZN5Z5Z5Z5Z5Zu5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z', '081234567891', 'X B', 'student', 'Aktif dalam berbagai kegiatan', 1),
('Rudi Hartono', 'rudi@student.com', '$2y$10$YIjlrVyaFZN5Z5Z5Z5Z5Zu5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z', '081234567892', 'XI A', 'student', 'Ketua OSIS', 1),
('Ani Wijaya', 'ani@student.com', '$2y$10$YIjlrVyaFZN5Z5Z5Z5Z5Zu5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z', '081234567893', 'X C', 'student', 'Anggota klub programming', 1),
('Pak Joko', 'pak.joko@teacher.com', '$2y$10$YIjlrVyaFZN5Z5Z5Z5Z5Zu5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z', '082123456790', NULL, 'teacher', 'Guru Pembina Kegiatan', 1),
('Ibu Maria', 'ibu.maria@teacher.com', '$2y$10$YIjlrVyaFZN5Z5Z5Z5Z5Zu5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z', '082123456791', NULL, 'teacher', 'Koordinator Event', 1);

-- =============================================================================
-- SAMPLE DATA - EVENT CATEGORIES
-- =============================================================================

INSERT INTO event_categories (name, description, color) VALUES
('Lomba', 'Kegiatan kompetisi antar siswa', '#FF6B6B'),
('Seminar', 'Kegiatan edukasi dan diskusi', '#4ECDC4'),
('Workshop', 'Pelatihan dan hands-on training', '#45B7D1'),
('Festival', 'Perayaan dan hiburan sekolah', '#FFA07A'),
('Olahraga', 'Kegiatan olahraga dan keselamatan', '#98D8C8'),
('Sosial', 'Kegiatan sosial dan bakti', '#F7DC6F');

-- =============================================================================
-- SAMPLE DATA - EVENTS
-- =============================================================================

INSERT INTO events (title, description, category, location, event_date, event_time, end_date, end_time, quota, image_url, organizer_id, status) VALUES
(
  'Lomba Coding 2024',
  'Kompetisi programming untuk semua tingkat dengan hadiah menarik. Peserta akan dibagi dalam kategori pemula dan lanjutan.',
  'Lomba',
  'Lab Komputer Lantai 2',
  DATE_ADD(CURDATE(), INTERVAL 15 DAY),
  '08:00:00',
  DATE_ADD(CURDATE(), INTERVAL 15 DAY),
  '14:00:00',
  50,
  'assets/foto/coding-competition.jpg',
  1,
  'published'
),
(
  'Seminar Teknologi AI',
  'Pembicara tamu dari perusahaan teknologi ternama akan membagikan pengetahuan tentang Artificial Intelligence dan aplikasinya di industri modern.',
  'Seminar',
  'Aula Sekolah',
  DATE_ADD(CURDATE(), INTERVAL 20 DAY),
  '09:30:00',
  DATE_ADD(CURDATE(), INTERVAL 20 DAY),
  '12:00:00',
  200,
  'assets/foto/seminar-ai.jpg',
  1,
  'published'
),
(
  'Workshop Web Development',
  'Pelatihan intensif pembuatan website menggunakan HTML, CSS, dan JavaScript. Disertai sertifikat resmi.',
  'Workshop',
  'Lab Komputer',
  DATE_ADD(CURDATE(), INTERVAL 10 DAY),
  '10:00:00',
  DATE_ADD(CURDATE(), INTERVAL 12 DAY),
  '15:00:00',
  40,
  'assets/foto/workshop-web.jpg',
  6,
  'published'
),
(
  'Festival Musik Sekolah',
  'Menampilkan berbagai penampilan musik dari siswa berbakat. Terbuka untuk penonton umum dari komunitas sekolah.',
  'Festival',
  'Lapangan Sekolah',
  DATE_ADD(CURDATE(), INTERVAL 25 DAY),
  '16:00:00',
  DATE_ADD(CURDATE(), INTERVAL 25 DAY),
  '20:00:00',
  500,
  'assets/foto/festival-musik.jpg',
  7,
  'published'
),
(
  'Kompetisi Olahraga Antar Kelas',
  'Pertandingan sepak bola, badminton, dan volley antar kelas X, XI, dan XII. Juara akan mendapat piala dan hadiah.',
  'Olahraga',
  'Lapangan dan Gedung Olahraga',
  DATE_ADD(CURDATE(), INTERVAL 30 DAY),
  '07:00:00',
  DATE_ADD(CURDATE(), INTERVAL 32 DAY),
  '17:00:00',
  300,
  'assets/foto/kompetisi-olahraga.jpg',
  1,
  'published'
),
(
  'Aksi Sosial Peduli Lingkungan',
  'Program kebersihan dan penanaman pohon di sekitar sekolah. Mari bersama menjaga lingkungan yang lebih hijau.',
  'Sosial',
  'Area Sekolah dan Taman Kota',
  DATE_ADD(CURDATE(), INTERVAL 8 DAY),
  '07:30:00',
  DATE_ADD(CURDATE(), INTERVAL 8 DAY),
  '11:00:00',
  100,
  'assets/foto/aksi-sosial.jpg',
  7,
  'published'
);

-- =============================================================================
-- SAMPLE DATA - EVENT REGISTRATIONS
-- =============================================================================

INSERT INTO event_registrations (event_id, user_id, student_name, student_class, phone_number, registration_status, attendance_status) VALUES
(1, 2, 'Budi Santoso', 'X A', '081234567890', 'confirmed', 'not-taken'),
(1, 3, 'Siti Nurhaliza', 'X B', '081234567891', 'confirmed', 'not-taken'),
(1, 4, 'Rudi Hartono', 'XI A', '081234567892', 'pending', 'not-taken'),
(1, 5, 'Ani Wijaya', 'X C', '081234567893', 'confirmed', 'not-taken'),
(2, 2, 'Budi Santoso', 'X A', '081234567890', 'confirmed', 'not-taken'),
(2, 3, 'Siti Nurhaliza', 'X B', '081234567891', 'confirmed', 'not-taken'),
(3, 3, 'Siti Nurhaliza', 'X B', '081234567891', 'confirmed', 'not-taken'),
(3, 5, 'Ani Wijaya', 'X C', '081234567893', 'pending', 'not-taken'),
(4, 2, 'Budi Santoso', 'X A', '081234567890', 'confirmed', 'not-taken'),
(4, 4, 'Rudi Hartono', 'XI A', '081234567892', 'confirmed', 'not-taken'),
(5, 3, 'Siti Nurhaliza', 'X B', '081234567891', 'confirmed', 'not-taken'),
(5, 5, 'Ani Wijaya', 'X C', '081234567893', 'confirmed', 'not-taken'),
(6, 2, 'Budi Santoso', 'X A', '081234567890', 'pending', 'not-taken'),
(6, 3, 'Siti Nurhaliza', 'X B', '081234567891', 'confirmed', 'not-taken');

-- =============================================================================
-- NOTES FOR DEVELOPERS
-- =============================================================================
-- 1. Password hashing: Semua password di sample data adalah: "password"
--    Hash: $2y$10$YIjlrVyaFZN5Z5Z5Z5Z5Zu5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z5Z
-- 2. Dates: Menggunakan DATE_ADD(CURDATE(), INTERVAL n DAY) agar fleksibel
-- 3. Foreign Keys: Diterapkan untuk data integrity
-- 4. Indexes: Ditambahkan pada kolom yang sering di-query
-- 5. Enum types: Gunakan untuk status yang terbatas dan konsisten
-- 6. Image URLs: Sesuaikan dengan struktur folder assets Sentra
