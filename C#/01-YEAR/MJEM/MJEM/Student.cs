namespace MJEM;

internal class Student
{
    internal Student(string name)
    {
        Name = name;
    }

    public string Name
    {
        get; set; 
    }

    public bool HasCard
    {
        get; set; 
    }

    public int Points 
    {
        get; set; 
    }

    public override string ToString()
    {
        return Name + ' ' + Points + ' ' + HasCard;
    }
}
