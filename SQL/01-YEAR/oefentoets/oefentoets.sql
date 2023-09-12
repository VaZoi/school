CREATE DATABASE GREENHOUSE;

USE GREENHOUSE;

CREATE TABLE reserveringen (
reserveringNO int NOT NULL AUTO_INCREMENT,
klant_id int NOT NULL,
kamerNO int NOT NULL,
check_in_datum datetime,
check_out_datum datetime,
aantal_personen int,
totaal_prijs decimal,
PRIMARY KEY (reserveringNO),
FOREIGN KEY (klant_id) REFERENCES contactgegevens(klant_id),
FOREIGN KEY (kamerNO) REFERENCES kamers(kamerNO)
);

CREATE TABLE kamers (
KamerNO int NOT NULL,
soort_kamer varchar(255),
bedden varchar(255),
huisdieren varchar(255),
PRIMARY KEY (kamerNO)
);

CREATE TABLE contactgegevens (
klant_id int NOT NULL,
naam varchar(255),
achternaam varchar(255),
adres varchar(255),
telefoonnummer int,
email varchar(255),
PRIMARY KEY (klant_id)
);

CREATE TABLE medewerkers (
medewerkerNO int NOT NULL AUTO_INCREMENT,
naam varchar(255),
werkt_waar varchar(255),
werkt_hoeveel varchar(255),
PRIMARY KEY (medewerkerNO)
);

