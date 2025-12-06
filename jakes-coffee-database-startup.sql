Create Database jakesCoffee;
use jakesCoffee;

create table menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL, 
    price_medium INT NOT NULL, 
    price_large INT NULL, 
    addition VARCHAR(30) NULL, 
    category VARCHAR(50) NOT NULL, 
    status VARCHAR(20) NOT NULL DEFAULT 'active'
);
INSERT INTO menu (name, price_medium, price_large, addition, category, status) VALUES
('Jccocino', 155, 170, 'w/ free glazed donut x1', 'coffee', 'active'),
('White Choco Espresso', 175, 190, 'w/ free glazed donut x1', 'coffee', 'active'),
('Caramel', 150, 165, 'w/ free glazed donut x1', 'coffee', 'active'),
('Mocha Espresso', 150, 165, 'w/ free glazed donut x1', 'coffee', 'active'),
('Cappuccino Chip', 150, 165, 'w/ free glazed donut x1', 'coffee', 'active'),
('Hazelnut Chocolate', 157, 174, 'w/ free glazed donut x1', 'coffee', 'active'),
('Chocolate Croissant', 85, NULL, NULL, 'pastry', 'active'),
('Blueberry Muffin', 75, NULL, NULL, 'pastry', 'active'),
('Cinnamon Roll', 95, NULL, NULL, 'pastry', 'active'),
('Apple Turnover', 70, NULL, NUll, 'pastry', 'active'),
('Cheese Danish', 80, NULL, NULL, 'pastry', 'active'),
('Almond Biscotti', 65, NULL, NULL, 'pastry', 'active');

CREATE TABLE music_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'active'
);
INSERT INTO music_table (title, status) VALUES
('Tensionado', 'active'),
('Multo', 'active'),
('Pag-ibig ay Kanibalismo', 'active'),
('Estranghero', 'active');

ALTER TABLE menu
MODIFY COLUMN status ENUM('active','archived') NOT NULL DEFAULT 'active';
ALTER TABLE music_table
MODIFY COLUMN status ENUM('active','archived') NOT NULL DEFAULT 'active';