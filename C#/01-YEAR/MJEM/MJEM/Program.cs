using MJEM;

internal class Program
{
    private static void Main(string[] args)
    {
        Console.WriteLine("Het winkelen begint");

        var students = new[]
        {
           new Student("Ensar"),
           new Student("Julie")
          {
             HasCard = true,
          },
          new Student("Mustapha")
          {
            HasCard = true,
          },
          new Student("Zakaria"),
          new Student("Lenny")
        };

        foreach (var student in students)
        {
            Console.WriteLine(student);
        }

    }
}