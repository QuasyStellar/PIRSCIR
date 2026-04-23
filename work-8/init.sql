SET NAMES 'utf8mb4';
CREATE DATABASE IF NOT EXISTS restaurant_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE restaurant_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$jbUEVhcSdKO3Izs8XbmIg.rIBl974EIyCkmdcC/950raLGz91QE72');

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
INSERT INTO categories (name) VALUES ('Супы'), ('Напитки'), ('Десерты');

CREATE TABLE dishes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
INSERT INTO dishes (category_id, name, price) VALUES (1, 'Борщ', 5.00), (2, 'Кофе', 2.50), (3, 'Торт', 4.00);

CREATE TABLE statistics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    rating INT NOT NULL,
    created_at DATETIME NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
INSERT INTO statistics (name, category_id, price, rating, created_at) VALUES 
('Борщ', 1, 5.00, 5, NOW()),
('Кофе', 2, 2.50, 4, NOW()),
('Торт', 3, 4.00, 5, NOW());
