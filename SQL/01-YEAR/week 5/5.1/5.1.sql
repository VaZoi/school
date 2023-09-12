USE studenten;

DELETE FROM student WHERE voornaam = 'Benja';

CREATE TABLE klanten (
id int NOT NULL AUTO_INCREMENT,
naam varchar(255),
achternaam varchar(255),
email varchar(255),
PRIMARY KEY (id)
);

INSERT INTO klanten (naam, achternaam, email) VALUES
('SIMON', 'Riley', 'ghostriley@gmail.com');

SELECT * FROM klanten;

DELETE FROM klanten WHERE id = '1';

INSERT INTO klanten (naam, achternaam, email) VALUES
('Sky', 'Blue', 'Skylerblue@gmail.com');

SELECT * FROM klanten;

DELETE FROM klanten WHERE id = '2';
