CREATE DATABASE software;
USE software;

CREATE TABLE boeken (
    ISBN varchar(255),
    Naam varchar(255),
    Prijs decimal(6,2),
    Auteur varchar(255),
    PRIMARY KEY(ISBN)
    );
    
    INSERT INTO boeken (ISBN, Naam, Prijs, Auteur) Values 
    ("123ABC", "Software", "10.99", "Catatay"),
    ("124ABC", "IT", "20.99", "Malik");
    
    Select * FROM boeken;
    
SELECT * FROM boeken WHERE Auteur = "Catatay";
SELECT * FROM boeken WHERE naam LIKE "S%";

SELECT SUM(Prijs) FROM boeken;