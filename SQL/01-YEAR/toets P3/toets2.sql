use RocSport;

Insert into activiteiten (activiteit_id, activiteit_naam, duur_min, trainer_id) values
("1", "Kickboxing", "40", "1"),
("2", "Vrije fitness", "60", "2"),
("3", "Yoga", "30", "3");

insert into trainers (trainer_id, naam, email, werktijd) values
("1", "Nick", "nick@gmail.com", "Full-Time", "4000"),
("2", "Collins", "collinsemi@gmail.com", "Part-Time", "3000"),
("3", "Guendalina", "Guendalioblue@gmail.com", "Part-Time", "3000");

insert into klanten (klant_id, naam, email, telefoonnummer, abbonement) values
("1", "John", "johnkuye@gmail.com", "06975625768", "6 maanden");

insert into trainingsschema (trainings_code, schema_naam, duur_min, klant_id) values
("1", "kracht", "60", "10", "1");

