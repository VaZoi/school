use webwinkel;

CREATE TABLE Contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    voornaam VARCHAR(255),
    achternaam VARCHAR(255),
    geboortedatum DATE,
    email VARCHAR(255),
    telefoonnummer VARCHAR(20)
);

insert into Contacts (id, voornaam, achternaam, geboortedatum, email, telefoonnummer) values
(9, "Osman", "Oz", "1995-04-12", "os@gmail.com", 61234321),
(10, "TestUser", "Test", "2000-03-21", "test@gmail.com", 12345678);
