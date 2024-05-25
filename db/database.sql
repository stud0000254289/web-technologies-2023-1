CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    parent_id INT DEFAULT NULL
);

INSERT INTO menu_items (name, parent_id) VALUES
('Каталог товаров', NULL),
('Мойки', 1),
('Ulgran', 2),
('Smth', 3),
('Smth', 3),
('Vigro Mramor', 3),
('Handmade', 2),
('Smth', 7),
('Smth', 7),
('Vigro Glass', 7),
('Фильтры', 1),
('Ulgran', 11),
('Smth', 12),
('Smth', 12),
('Vigro Mramor', 12);


