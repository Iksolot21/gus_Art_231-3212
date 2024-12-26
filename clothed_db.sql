-- Создание базы данных
CREATE DATABASE IF NOT EXISTS clothing_store;
USE clothing_store;

-- Создание таблицы категорий
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

-- Создание таблицы товаров
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    category_id INT,
    stock_quantity INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Создание таблицы пользователей
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

-- Добавление категорий 
INSERT INTO categories (name) VALUES
('Футболки'),
('Джинсы'),
('Платья'),
('Куртки');

-- Добавление товаров 
INSERT INTO products (name, description, price, image, category_id, stock_quantity) VALUES
('Футболка мужская', 'Стильная мужская футболка из хлопка.', 25.99, 'images/tshirt_man.jpg', 1, 50),
('Джинсы женские', 'Классические женские джинсы.', 49.99, 'images/jeans_woman.jpg', 2, 30),
('Платье летнее', 'Легкое летнее платье из вискозы.', 35.50, 'images/dress.jpg', 3, 20),
('Куртка демисезонная', 'Утепленная куртка на весну/осень.', 75.00, 'images/jacket.jpg', 4, 15),
('Футболка женская', 'Женская футболка с принтом.', 22.00, 'images/tshirt_woman.jpg', 1, 40);