USE studenten;

SET SQL_SAFE_UPDATES=0;

SELECT * from student;

INSERT INTO student (studentennummer, voornaam, achternaam) VALUES
('365425', 'Michael', 'Linea');

UPDATE student SET voornaam = 'Milena' WHERE studentennummer = '365425';

INSERT INTO student (studentennummer, voornaam, achternaam) VALUES
('035789', 'Milena', 'Lisbon');

SELECT * FROM student;

UPDATE student SET voornaam = 'Lisa' WHERE studentennummer = '035789';

