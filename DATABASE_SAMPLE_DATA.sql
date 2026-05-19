-- ====================================
-- SAMPLE DATA FOR TESTING
-- DATABASE: sentra
-- ====================================

-- Insert sample users
INSERT INTO `users` (`name`, `email`, `password`) VALUES
('Admin User', 'admin@sentra.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/KFm'),
('John Doe', 'john@example.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/KFm'),
('Jane Smith', 'jane@example.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/KFm'),
('Bob Wilson', 'bob@example.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/KFm');

-- Note: All passwords are hashed from "password123"
-- To create your own password hash, use: password_hash("yourpassword", PASSWORD_DEFAULT);

-- Insert sample posts/events
INSERT INTO `posts` (`title`, `content`, `user_id`, `image_path`) VALUES
('Web Development Workshop', 'Learn the basics of web development including HTML, CSS, JavaScript, and PHP. Perfect for beginners who want to start their web development journey.', 1, 'assets/foto/1706789456_workshop.jpg'),
('Mobile App Development', 'Introduction to mobile app development using Flutter and Dart. Build cross-platform applications for iOS and Android.', 2, 'assets/foto/1706789567_mobile.jpg'),
('Data Science Fundamentals', 'Get started with data science, learn Python, pandas, matplotlib, and scikit-learn. Understand data analysis and visualization.', 3, 'assets/foto/1706789678_datascience.jpg'),
('UI/UX Design Workshop', 'Learn design principles, wireframing, prototyping, and user research. Master tools like Figma and Adobe XD.', 1, NULL);

-- Insert sample registrations
INSERT INTO `registrations` (`event_id`, `user_id`, `name`, `class`, `phone_number`) VALUES
(1, 2, 'John Doe', 'XI-A', '08123456789'),
(1, 3, 'Jane Smith', 'XI-B', '08134567890'),
(1, 4, 'Bob Wilson', 'X-A', '08145678901'),
(2, 1, 'Admin User', 'XII-A', '08156789012'),
(2, 4, 'Bob Wilson', 'X-A', '08145678901'),
(3, 2, 'John Doe', 'XI-A', '08123456789'),
(3, 3, 'Jane Smith', 'XI-B', '08134567890'),
(4, 2, 'John Doe', 'XI-A', '08123456789');

-- ====================================
-- VERIFICATION QUERIES
-- ====================================

-- View all users
-- SELECT * FROM users;

-- View all posts with creator
-- SELECT p.*, u.name as creator_name FROM posts p JOIN users u ON p.user_id = u.id;

-- View all registrations with details
-- SELECT r.*, p.title as event_name, u.name as user_name FROM registrations r 
-- JOIN posts p ON r.event_id = p.id 
-- JOIN users u ON r.user_id = u.id;

-- Count registrations per event
-- SELECT p.title, COUNT(r.id) as total_participants FROM posts p 
-- LEFT JOIN registrations r ON p.id = r.event_id 
-- GROUP BY p.id, p.title;
