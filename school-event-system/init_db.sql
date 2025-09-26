-- init_db.sql
CREATE DATABASE IF NOT EXISTS school_events_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE school_events_db;

-- users table (admin)
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- events table
CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  location VARCHAR(255),
  start_datetime DATETIME,
  end_datetime DATETIME,
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Insert sample admin user
-- password = admin123 (hashed)
INSERT INTO users (name, email, password, role) VALUES
('Administrator','admin@example.com','$2y$10$8a6vL9Qqgk3vN0FQ1sJ2eONzU4cG9yKq6JqldN4w6hI2vQ/0rF9mK','admin');

-- Insert sample events
INSERT INTO events (title, description, location, start_datetime, end_datetime, created_by) VALUES
('Orientation Day','Welcome new students and parents','Main Hall','2025-10-01 08:00:00','2025-10-01 12:00:00',1),
('Science Fair','Student projects and exhibition','Gym','2025-11-15 09:00:00','2025-11-15 15:00:00',1);
