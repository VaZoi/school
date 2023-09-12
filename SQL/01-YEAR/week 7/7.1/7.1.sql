CREATE DATABASE restaurant;

USE restaurant;

CREATE TABLE producten (
product_id int NOT NULL AUTO_INCREMENT,
product_naam VARCHAR(45),
omschrijving VARCHAR(45),
prijs_per_stuk DECIMAL(6,2),
PRIMARY KEY (product_id)
);

CREATE TABLE bestellingen (
bestelling_id INT NOT NULL AUTO_INCREMENT,
tafel_code INT NOT NULL,
totaal_prijs DECIMAL(6,2),
product_id INT NOT NULL,
PRIMARY KEY (bestelling_id),
FOREIGN KEY (product_id) REFERENCES producten(product_id),
FOREIGN KEY (tafel_code) REFERENCES tafels(tafel_code)
);

CREATE TABLE tafels (
tafel_code INT NOT NULL AUTO_INCREMENT,
omschrijving VARCHAR(45),
PRIMARY KEY (tafel_code)
);
