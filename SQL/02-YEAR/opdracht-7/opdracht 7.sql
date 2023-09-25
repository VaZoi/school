use webwinkel;

CREATE TABLE Contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    voornaam VARCHAR(255),
    achternaam VARCHAR(255),
    geboortedatum DATE,
    email VARCHAR(255),
    telefoonnummer VARCHAR(20)
);
