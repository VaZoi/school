USE studenten;

CREATE TABLE boeken (
ISBN int PRIMARY KEY,
naam varchar(255),
auteur varchar(255),
prijs DECIMAL(6,2)
);

INSERT INTO boeken (ISBN, naam, auteur, prijs) VALUES
('0188908536', 'Manu vries', 'Eiichiro Oda', '6'),
('0337765596', 'Lois Maas', 'J.K.Rowling', '10'),
('0760639566', 'Nika Groot', 'Rick Riordian', '10'),
('0358193702', 'Duco Smits', 'Lewis Carroll', '8'),
('0778490491', 'Malik Bruin', 'J.R.R. Tolkien', '16'),
('0465058329', 'Lara Brink', 'Suzanne Collins', '18'),
('0697310620', 'Kent Will', 'Stephen King', '10'),
('0693277262', 'Kathryn Rohan', 'C.S.Lewis', '10'),
('0389474657', 'Luz Nicolas', 'Charles Dickens', '10'),
('0134879645', 'Aaron Mertz', 'Bram Stoker', '7');

SELECT * FROM boeken WHERE prijs < 15;

SELECT * FROM boeken WHERE prijs > 13 and prijs <20;

SELECT MIN(prijs) FROM boeken;

SELECT MAX(prijs) FROM boeken;

SELECT COUNT(*) FROM boeken;

SELECT AVG(prijs) FROM boeken;

SELECT SUM(prijs) FROM boeken;


