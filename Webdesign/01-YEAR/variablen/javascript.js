let voornaam = "Carl";
let achternaam = "Petersen";
let schoolgeld = 1000;
let boekengeld = 100;
let bedrag = schoolgeld + boekengeld;
let studiefinanciering = 600;
let totaal = bedrag - studiefinanciering;
let volledigenaam = voornaam + " " + achternaam;
document.getElementById('rekenkundig').innerHTML =
    (volledigenaam + "<br>Totaal te betalen:" + '&euro;' + totaal);