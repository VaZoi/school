create database school;
use school;

create table Studenten (
StudentID int primary key auto_increment,
Naam varchar(45),
Geboortedatum date
);

create table Cursussen (
CursusID int primary key,
Naam varchar(45),
Docent varchar(45)
);

create table Volgt (
StudentID int,
CursusID int,
Inschrijvingsdatum date,
foreign key (StudentID) references Studenten(StudentID),
foreign key (CursusID) references Cursussen(CursusID)
);

insert into Studenten (Naam, Geboortedatum) values
("Anna", '1999-05-15'),
("David", '2000-03-08'),
("Emma", '2001-09-22');

insert into Cursussen (CursusID, Naam, Docent) values
(101, "Wiskunde", "Smith"),
(102, "Geschiedenis", "Johnson"),
(103, "Biologie", "Anderson");

insert into Volgt (StudentID, CursusID, Inschrijvingsdatum) values
(1, 101, '2023-01-15'),
(1, 103, '2023-01-15'),
(2, 102, '2023-02-01'),
(3, 101, '2023-02-10');
