USE studenten;

INSERT INTO student (studentennummer, voornaam, achternaam) VALUES
('123456', 'Mike', 'Groot');

SELECT * FROM student;

SELECT * FROM student WHERE voornaam = 'Mike';

SELECT * FROM student WHERE voornaam = 'Mike' and achternaam = 'Groot';

SELECT voornaam and achternaam FROM student WHERE studentennummer = '12345';

SELECT voornaam and achternaam FROM student WHERE voornaam = 'Mike' or achternaam = 'Groot';

SELECT * FROM student WHERE voornaam like 'M%';

SELECT * FROM student WHERE voornaam like '%E';

SELECT * FROM student WHERE voornaam != 'Mike';
