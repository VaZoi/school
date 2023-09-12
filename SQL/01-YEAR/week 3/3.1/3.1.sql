use studenten;

create table student (
studentennummer int,
voornaam varchar(255),
achternaam varchar(255)
);

INSERT INTO student (studentennummer, voornaam, achternaam) VALUES
('124768', 'Jay', 'blue'),
('198345', 'Kyro', 'Ronaldo'),
('165920', 'Julie', 'Kraanen'),
('823405', 'Tadi', 'Gray'),
('144768', 'Benja', 'Sea');

ALTER TABLE student
MODIFY studentennummer int PRIMARY KEY,
MODIFY voornaam varchar(255) NOT NULL,
MODIFY achternaam varchar(255) NOT NULL;

SELECT studentennummer, voornaam, achternaam
FROM student;

SELECT voornaam, achternaam
FROM student;

SELECT * FROM student;

SELECT * FROM student
ORDER BY student ASC;

SELECT * FROM student
ORDER BY student DESC;