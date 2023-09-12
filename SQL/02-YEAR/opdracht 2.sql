Create database takenbeheer;
use takenbeheer;

create table taken (
taaknaam varchar(255),
status varchar(255),
wie_doet_taak varchar(255),
einddatum date
);

insert into taken (taaknaam, status, einddatum) values
("laptop bestellen", "incomplete", "2023-09-14"),
("Boeken bestellen", "incomplete", "2023-09-18"),
("Huiswerk maken", "complete", "2023-09-11");

delete from taken where taaknaam="laptop bestellen";

delete from taken where status="complete";