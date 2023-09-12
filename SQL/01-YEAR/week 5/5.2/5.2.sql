CREATE DATABASE Winkel;

USE Winkel;

CREATE TABLE klant (
klantID int NOT NULL AUTO_INCREMENT,
naam varchar(255),
achternaam varchar(255),
email varchar(255),
PRIMARY KEY (klantID)
);

CREATE TABLE bestelling (
bestellingID int NOT NULL AUTO_INCREMENT,
klantID int NOT NULL,
PRIMARY KEY (bestellingID),
FOREIGN KEY (klantID) REFERENCES klant(klantID)
);

CREATE TABLE product (
productID int NOT NULL AUTO_INCREMENT,
bestellingID int NOT NULL,
product varchar (255) NOT NULL,
PRIMARY KEY (productID),
FOREIGN KEY (bestellingID) REFERENCES bestelling(bestellingID)
);

CREATE TABLE voorraad (
voorraadID int NOT NULL,
productID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (voorraadID),
FOREIGN KEY (productID) REFERENCES product(productID)
);

