class Student
{
    public string Naam 
    { 
        get; set; 
    }
    public int Geboortejaar 
    { 
        get; set; 
    }
    public int Studentennummer 
    { 
        get; set; 
    }

    public float Gemiddeld_Cijfer
    {
        get; set;
    }

    public Student(string naam, int geboortejaar, int studentennummer, float gemiddeld_cijfer)
    {
        Naam = naam;
        Geboortejaar = geboortejaar;
        Studentennummer = studentennummer;
        Gemiddeld_Cijfer = gemiddeld_cijfer;
    }
    public void Print()
    {
        Console.WriteLine($"Naam: {Naam}, Geboortejaar: {Geboortejaar}, Studentennummer: {Studentennummer}, Gemiddelde Cijfer: {Gemiddeld_Cijfer}");
    }
}
