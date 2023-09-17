create database shop;

use shop;

create table klanten (
KlantID int primary key auto_increment,
Naam varchar(255),
Stad varchar(255)
);

create table producten (
ProductID int primary key,
Naam varchar(255),
Prijs int);

create table bestellingen (
BestellingID int primary key auto_increment,
KlantID int,
ProductID int,
foreign key (KlantID) references klanten(KlantID),
foreign key (ProductID) references producten(ProductID)
);

insert into klanten (Naam, Stad) values
("Anna", "Amsterdam"),
("David", "Rotterdam"),
("Emma", "Utrecht"),
("John", "Amsterdam"),
("Michelle", "Den Haag"),
("Peter", "Groningen"),
("Sophia", "Eindhoven"),
("Liam", "Amsterdam");

insert into producten (ProductID, Naam, Prijs) values
(101, "Laptop", 800),
(102, "Smartphone", 300),
(103, "Tablet", 150),
(201, "Boek", 15),
(202, "DVD", 8),
(203, "Koptelefoon", 50),
(204, "TV", 600),
(305, "Klok", 25);

insert into bestellingen (KlantID, ProductID) values
(1, 101),
(2, 202),
(3, 305),
(4, 101),
(5, 203),
(6, 201),
(7, 102),
(8, 204);

select * from klanten where Stad="Amsterdam";

select * from producten where Prijs > 50;

select b.BestellingID, k.Naam as KlantNaam, p.Naam as ProductNaam
from bestellingen b
join klanten k on b.KlantID = k.KlantID
join producten p on b.ProductID = p.ProductID
where k.Naam in ("Anna", "David", "Emma");

select * from producten where ProductID in (101, 203, 305);

select b.BestellingID, k.Naam as KlantNaam, p.Naam as ProductNaam
from bestellingen as b
join klanten as k on b.KlantID = k.KlantID
join Producten as p on b.ProductID = p.ProductID
where k.naam in ("John", "Michelle");

select * from producten where Prijs < 20 or Prijs > 100;

select * from producten where Prijs Between 30 and 50;

select * from klanten where Naam not in ("Peter", "Sophia", "Liam");

select b.BestellingID, k.Naam as KlantNaam, p.Naam as ProductNaam
from bestellingen as b
join klanten as k on b.KlantID = k.KlantID
join producten as p on b.ProductID = p.ProductID
where k.KlantID not in (102, 204, 306);

select b.BestellingID, k.Naam as KlantNaam, p.Naam as ProductNaam
from bestellingen as b
join klanten as k on b.KlantID = k.KlantID
join producten as p on b.ProductID = p.ProductID;

select COUNT(b.BestellingID) as AantalBestellingen
from producten as p
left join bestellingen as b on p.ProductID = b.ProductID
where p.Naam = "Laptop";
