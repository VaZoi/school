create database webwinkel;

use webwinkel;

CREATE TABLE klanten (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    telefoon VARCHAR(15)
);
