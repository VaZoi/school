CREATE DATABASE RocSport;
use RocSport;

Create table trainingsschema (
trainings_code int Primary key,
schema_naam VARCHAR(45),
duur_min int,
aantal_sets int,
klant_id int,
FOREIGN KEY (klant_id) REFERENCES klanten(klant_id)
);

Create table klanten (
klant_id int primary key,
naam varchar(45),
email varchar(45),
telefoonnummer int,
abbonement varchar(45),
activiteit_id int,
Foreign key (activiteit_id) references activiteiten(activiteit_id)
);

create table activiteiten (
activiteit_id int primary key,
activiteit_naam varchar(45),
duur_min int,
trainer_id int,
foreign key (trainer_id) references trainers(trainer_id)
);

create table trainers (
trainer_id int primary key,
naam varchar(45),
email varchar(45),
werktijd varchar(45),
salaris int
);

