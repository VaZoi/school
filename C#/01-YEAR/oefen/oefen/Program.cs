// See https://aka.ms/new-console-template for more information

using oefen;

var kledingsstuk1 = new kledingsstuk
{
    soort = "t-shirt",
    merk = "Nike",
    MadeIn = "USA",
    maat = kledingsstuk.size.M,
    prijs = 60,
    kleur = "Zwart"
};

var kledingsstuk2 = new kledingsstuk
{
    soort = "broek",
    merk = "Nike",
    MadeIn = "USA",
    maat = kledingsstuk.size.S,
    prijs = 50,
    kleur = "Grijs"
};

var kledingsstuk3 = new kledingsstuk
{
    soort = "trui",
    merk = "Nike",
    MadeIn = "USA",
    maat = kledingsstuk.size.L,
    prijs = 100,
    kleur = "Zwart/Grijs"
};

Console.WriteLine($"{kledingsstuk1.soort} {kledingsstuk1.merk} {kledingsstuk1.MadeIn} {kledingsstuk1.maat} {kledingsstuk1.prijs} {kledingsstuk1.kleur}, " +
    $"{kledingsstuk2.soort}   {kledingsstuk2.merk} {kledingsstuk2.MadeIn} {kledingsstuk2.maat} {kledingsstuk2.prijs} {kledingsstuk2.kleur}, " +
    $"{kledingsstuk3.soort} {kledingsstuk3.merk} {kledingsstuk3.MadeIn} {kledingsstuk3.maat} {kledingsstuk3.prijs} {kledingsstuk3.kleur}");