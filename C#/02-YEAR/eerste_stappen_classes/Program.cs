class Program
{
    static void Main()
    {
        Student student1 = new Student("Julie", 2006, 2169020, 8.7F);
        Student student2 = new Student("Lucas", 2005, 2154727, 7.9F);
        Student student3 = new Student("Martino", 2007, 2167346, 8.5F);

        student1.Print();
        student2.Print();
        student3.Print();
    }
}