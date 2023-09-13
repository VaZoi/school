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

    public Student(string naam, int geboortejaar, int studentennummer)
    {
        Naam = naam;
        Geboortejaar = geboortejaar;
        Studentennummer = studentennummer;
    }
    public void Print()
    {
        Console.WriteLine($"Naam: {Naam}, Geboortejaar: {Geboortejaar}, Studentennummer: {Studentennummer}");
    }
}
