namespace MJEM;

internal abstract class Bread
{
    internal Bread(string description)
    {
        Description = description;
    }

    internal Bread(int Points)
    {
        Points = 1;
    }

    public override string ToString()
    {
        return $"{Description} cost {Price}";
    }

    internal decimal Price;

    internal string Description;



}
