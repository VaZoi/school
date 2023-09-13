class Program
{
    static void Main()
    {
        Student student1 = new Student("Julie", 2006, 2169020);
        Student student2 = new Student("Lucas", 2005, 2154727);
        Student student3 = new Student("Martino", 2007, 2167346);

        student1.Print();
        student2.Print();
        student3.Print();
    }
}