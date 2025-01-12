CREATE DATABASE IF NOT EXISTS rpgproject;

USE rpgproject;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, email) VALUES 
('admin', '$2y$10$eImiTXuWVxfD1uFqg1sZ1Oe5Y5b5g5g5g5g5g5g5g5g5g5g5g5', 'admin@example.com');  -- Password: admin123