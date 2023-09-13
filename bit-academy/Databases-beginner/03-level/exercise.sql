USE sterrenstelsel;

TRUNCATE TABLE planeten;

ALTER TABLE planeten
ADD Diameter int NOT NULL,
ADD Afstand int NOT NULL,
ADD Massa int NOT NULL;

ALTER TABLE planeten
modify bezoek_datum DATE;


INSERT INTO planeten (naam, Diameter, Afstand, Massa, bezoek_datum) VALUES
('zon', '1392000', '0', '332946', '2000-02-08'),
('Mercurious', '4880', '57910000', '0', '2005-12-06'),
('Venus', '12104', '108208930', '1', '2012-03-01'),
('Aarde', '12756', '149597870', '1', '2016-05-01'),
('Mars', '6794', '227936640', '0', '2023-01-01');

SELECT *
FROM planeten;

ALTER TABLE planeten
add id int primary key auto_increment;


