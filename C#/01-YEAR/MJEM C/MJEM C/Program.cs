using System;
using System.Collections.Generic;

class Program
{
    static void Main(string[] args)
    {
        // Aanvang van de simulatie
        Winkel winkel = new Winkel();
        winkel.VulSchappen();

        // Simuleer de verkoop voor 4 studenten gedurende een week
        for (int i = 1; i <= 4; i++)
        {
            Student student = new Student("Student " + i);
            int aantalBezoeken = new Random().Next(1, 6);

            for (int j = 1; j <= aantalBezoeken; j++)
            {
                student.BezoekWinkel(winkel);
            }

            student.PrintKassabonnen();
        }

        // Eindstand van de kassa
        Console.WriteLine("Eindstand kassa:");
        Console.WriteLine("Totaal verkocht broodjes: " + winkel.Kassa.TotaalVerkochtBroodjes);
        Console.WriteLine("Totaal verkocht drankjes: " + winkel.Kassa.TotaalVerkochtDrankjes);
        Console.WriteLine("Totaal ontvangen bedrag: " + winkel.Kassa.TotaalOntvangenBedrag.ToString("C"));
    }
}

class Student
{
    public string Naam { get; set; }
    public int SpaarPunten { get; set; }
    public List<Kassabon> Kassabonnen { get; set; }

    public Student(string naam)
    {
        Naam = naam;
        SpaarPunten = 0;
        Kassabonnen = new List<Kassabon>();
    }

    public void BezoekWinkel(Winkel winkel)
    {
        Broodjeszak broodjeszak = new Broodjeszak();
        int aantalBroodjes = new Random().Next(1, 5);

        for (int i = 0; i < aantalBroodjes; i++)
        {
            Broodje broodje = winkel.PakWillekeurigBroodje();
            broodjeszak.VoegBroodjeToe(broodje);
        }

        Drank drank = null;
        if (new Random().Next(0, 2) == 1)
        {
            drank = winkel.PakWillekeurigeDrank();
        }

        Kassa kassa = winkel.KiesWillekeurigeKassa();
        Kassabon kassabon = kassa.ScanArtikelen(broodjeszak, drank);

        SpaarPunten += kassabon.BerekendPunten;
        Kassabonnen.Add(kassabon);

        winkel.Kassa.TotaalVerkochtBroodjes += kassabon.BerekendAantalBroodjes;
        winkel.Kassa.TotaalVerkochtDrankjes += kassabon.BerekendAantalDrankjes;
        winkel.Kassa.TotaalOntvangenBedrag += kassabon.BerekendTotaalBedrag;
    }

    public void PrintKassabonnen()
    {
        Console.WriteLine("Kassabonnen voor " + Naam + ":");
        foreach (Kassabon kassabon in Kassabonnen)
        {
            kassabon.Print();
        }
        Console.WriteLine();
    }
}

class Winkel
{
    private List<Broodje> gezondeBroodjes;
    private List<Broodje> minderGezondeBroodjes;
    private List<Drank> drankjes;

    public Kassa Kassa { get; set; }

    public Winkel()
    {
        gezondeBroodjes = new List<Broodje>();
        minderGezondeBroodjes = new List<Broodje>();
        drankjes = new List<Drank>();
        Kassa = new Kassa();
    }

    public void VulSchappen()
    {
        for (int i = 1; i <= 50; i++)
        {
            gezondeBroodjes.Add(new Broodje("Gezond Broodje " + i, 0.50));
        }

        for (int i = 1; i <= 25; i++)
        {
            minderGezondeBroodjes.Add(new Broodje("Minder Gezond Broodje " + i, 0.75));
        }

        for (int i = 1; i <= 25; i++)
        {
            drankjes.Add(new Drank("Drank " + i, 0.75));
        }
    }

    public Broodje PakWillekeurigBroodje()
    {
        if (gezondeBroodjes.Count == 0 && minderGezondeBroodjes.Count == 0)
        {
            throw new Exception("Er zijn geen broodjes meer beschikbaar.");
        }

        int index = new Random().Next(0, 2);
        if (index == 0 && gezondeBroodjes.Count > 0)
        {
            int gezondeIndex = new Random().Next(0, gezondeBroodjes.Count);
            Broodje broodje = gezondeBroodjes[gezondeIndex];
            gezondeBroodjes.RemoveAt(gezondeIndex);
            return broodje;
        }
        else if (minderGezondeBroodjes.Count > 0)
        {
            int minderGezondeIndex = new Random().Next(0, minderGezondeBroodjes.Count);
            Broodje broodje = minderGezondeBroodjes[minderGezondeIndex];
            minderGezondeBroodjes.RemoveAt(minderGezondeIndex);
            return broodje;
        }

        return null;
    }

    public Drank PakWillekeurigeDrank()
    {
        if (drankjes.Count == 0)
        {
            throw new Exception("Er zijn geen drankjes meer beschikbaar.");
        }

        int index = new Random().Next(0, drankjes.Count);
        Drank drank = drankjes[index];
        drankjes.RemoveAt(index);
        return drank;
    }

    public Kassa KiesWillekeurigeKassa()
    {
        return new Kassa();
    }
}

class Schap
{
    // Niet gebruikt in deze simulatie
}

class Broodjeszak
{
    public List<Broodje> Broodjes { get; set; }

    public Broodjeszak()
    {
        Broodjes = new List<Broodje>();
    }

    public void VoegBroodjeToe(Broodje broodje)
    {
        Broodjes.Add(broodje);
    }
}

class Broodje
{
    public string Naam { get; set; }
    public double Prijs { get; set; }

    public Broodje(string naam, double prijs)
    {
        Naam = naam;
        Prijs = prijs;
    }
}

class Drank
{
    public string Naam { get; set; }
    public double Prijs { get; set; }

    public Drank(string naam, double prijs)
    {
        Naam = naam;
        Prijs = prijs;
    }
}

class Kassa
{
    public int TotaalVerkochtBroodjes { get; set; }
    public int TotaalVerkochtDrankjes { get; set; }
    public decimal TotaalOntvangenBedrag { get; set; }

    public Kassa()
    {
        TotaalVerkochtBroodjes = 0;
        TotaalVerkochtDrankjes = 0;
        TotaalOntvangenBedrag = 0;
    }

    public Kassabon ScanArtikelen(Broodjeszak broodjeszak, Drank drank)
    {
        Kassabon kassabon = new Kassabon();

        foreach (Broodje broodje in broodjeszak.Broodjes)
        {
            if (broodje.Prijs == 0.50)
            {
                kassabon.BerekendAantalBroodjes++;
                kassabon.BerekendTotaalBedrag += 0.50m;
            }
            else if (broodje.Prijs == 0.75)
            {
                kassabon.BerekendAantalBroodjes++;
                kassabon.BerekendTotaalBedrag += 0.75m;
            }
        }

        if (drank != null)
        {
            kassabon.BerekendAantalDrankjes++;
            kassabon.BerekendTotaalBedrag += 0.75m;
        }

        if (kassabon.BerekendAantalBroodjes >= 10)
        {
            kassabon.BerekendAantalBroodjes--;
            kassabon.BerekendPunten -= 10;
        }

        if (kassabon.BerekendPunten < 0)
        {
            kassabon.BerekendPunten = 0;
        }

        return kassabon;
    }
}

class Kassabon
{
    public int BerekendAantalBroodjes { get; set; }
    public int BerekendAantalDrankjes { get; set; }
    public decimal BerekendTotaalBedrag { get; set; }
    public int BerekendPunten { get; set; }

    public Kassabon()
    {
        BerekendAantalBroodjes = 0;
        BerekendAantalDrankjes = 0;
        BerekendTotaalBedrag = 0;
        BerekendPunten = BerekendAantalBroodjes + (BerekendAantalDrankjes * 2);
    }

    public void Print()
    {
        Console.WriteLine("============= MJEM =============");
        Console.WriteLine(DateTime.Now.ToString("dd-MM-yyyy HH:mm"));
        Console.WriteLine(BerekendAantalBroodjes + " gezonde broodjes à 0,50");
        Console.WriteLine(BerekendAantalBroodjes + " broodje(s) à 0,75");
        Console.WriteLine(BerekendAantalDrankjes + " drankje(s) à 0,75");
        Console.WriteLine("1 bonusbroodje");
        Console.WriteLine("TOTAAL " + BerekendTotaalBedrag.ToString("C"));
        Console.WriteLine("U heeft " + BerekendPunten + " punten gespaard.");
        Console.WriteLine("===============================");
    }
}