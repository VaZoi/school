use shop;

select Min(Prijs) from producten;

select max(Prijs) from producten;

select avg(Prijs) from producten;

select count(*) from bestellingen;

select max(BestellingID) from bestellingen;

select count(*) from bestellingen;

-- er is geen column voor leeftijd

select Klanten.Naam, COUNT(Bestellingen.BestellingID)
from Klanten
left join Bestellingen on Klanten.KlantID = Bestellingen.KlantID
group by Klanten.Naam;

select Klanten.Naam, sum(Producten.Prijs)
from Klanten
left join Bestellingen on Klanten.KlantID = Bestellingen.KlantID
left join Producten on Bestellingen.ProductID = Producten.ProductID
group by Klanten.Naam;
