CREATE DATABASE club;
USE club;

CREATE table Leden (
lidnummer int NOT NULL auto_increment,
naam varchar(255),
leeftijd int,
lidmaatschapsdatum DATE,
PRIMARY KEY(lidnummer)
);

INSERT INTO Leden (naam, leeftijd, lidmaatschapsdatum) VALUES
("Julie", "17", '2018-02-18'),
("Lucas", "22", '2016-12-05'),
("Jaden", "38", '2010-01-24'),
("Manoy", "58", '2005-08-13');

SELECT * FROM Leden;

SELECT * FROM Leden WHERE leeftijd < 30;

SELECT * FROM Leden WHERE lidmaatschapsdatum > "2012-01-02";


