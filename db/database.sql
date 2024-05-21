CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    parent_id INT DEFAULT NULL,
    has_children BOOLEAN NOT NULL DEFAULT 0
);

INSERT INTO menu_items (name, parent_id, has_children) VALUES
('Каталог товаров', NULL, 1),
('Мойки', 1, 1),
('Ulgran', 2, 1),
('Smth', 3, 0),
('Smth', 3, 0),
('Vigro Mramor', 3, 0),
('Handmade', 2, 1),
('Smth', 7, 0),
('Smth', 7, 0),
('Vigro Glass', 7, 0),
('Фильтры', 1, 1),
('Ulgran', 11, 1),
('Smth', 12, 0),
('Smth', 12, 0),
('Vigro Mramor', 12, 0);

