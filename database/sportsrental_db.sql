CREATE DATABASE sportsrental_db;
USE sportsrental_db;

-- tabel dafter alat olahraga
CREATE TABLE equipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    brand VARCHAR(100),
    stock INT NOT NULL DEFAULT 0
);

-- tabel dafter member
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(15)
);

-- tabel peminjam alat
-- jdnya di tabel ini, peminjam dateng dari tabel members, dan alat yang dipinjam dateng dr tabel equipment
CREATE TABLE rentals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipment_id INT NOT NULL,
    member_id INT NOT NULL,
    rent_date DATE NOT NULL,
    return_date DATE,
    FOREIGN KEY (equipment_id) REFERENCES equipments(id),
    FOREIGN KEY (member_id) REFERENCES members(id)
);

-- data yg udh ada
-- list alat olahraga
INSERT INTO equipments (name, type, brand, stock) VALUES
('Bola Sepak', 'Outdoor', 'Adidas', 10),
('Raket Badminton', 'Indoor', 'Yonex', 8),
('Matras Yoga', 'Indoor', 'Reebok', 6);

-- list member
INSERT INTO members (name, email, phone) VALUES
('Aldi Nugraha', 'aldi@sportmail.com', '081234567890'),
('Siti Rahmawati', 'siti@sportmail.com', '082145678901'),
('Bima Santoso', 'bima@sportmail.com', '083256789012');

-- list data peminjaman
INSERT INTO rentals (equipment_id, member_id, rent_date, return_date) VALUES
(1, 1, '2025-11-05', '2025-11-07'),
(2, 2, '2025-11-06', NULL),
(3, 3, '2025-11-07', NULL);