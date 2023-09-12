USE greenhouse;

INSERT INTO kamers (kamerNO, soort_kamer, bedden, huisdieren) VALUES
("1", "Eenpersoonskamer", "1 groot bed", "huisdieren niet toegestaan"),
("2", "Tweepersoonskamer", "2 aparte bedden", ""),
("3", "Driepersoonskamer", "3 aparte bedden", ""),
("4", "vierpersoonskamer", "2 grote bedden", ""),
("5", "familiekamer", "3 grote bedden", "huisdieren toegestaan");

INSERT INTO medewerkers (naam, werkt_waar, werkt_hoeveel) VALUES
("John Doe", "Servicebaliemedewerker", "Full Time"),
("Jessica", "Horecamedewerker", "Full Time"),
("Jarmo", "Schoonmaakmedewerker", "Part Time");
