// See https://aka.ms/new-console-template for more information

using studeren;

Console.WriteLine("Hello, World!");

int sum(int a, int b)
{
    return a + b;
}

for (int i = 0; i < 10; i++)
{
    Console.WriteLine(sum(5, i));
}





var student1 = new student
{
    Name = "Bob",
    DateOfBirth = new DateOnly(2000, 12, 1)
};


var student2 = new student
{
    Name = "Bibi",
    DateOfBirth = new DateOnly(2006, 10, 8)
};

var student3 = new student
{
    Name = "Jay",
    DateOfBirth = new DateOnly(2003, 11, 20)
};

var docent1 = new docent
{
    name = "Hugh",
    salary = 80000,
    DateOfBirth = new DateOnly(1970, 10, 12)
};



Console.WriteLine($"{student2.Name} {student2.DateOfBirth}, {student1.Name} {student1.DateOfBirth}, {docent1.name} {docent1.salary} {docent1.DateOfBirth}");


