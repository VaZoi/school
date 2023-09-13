using System.Drawing;

Console.WriteLine("Hello, World!");

car myCar = new car();
myCar.Brand = "Volkswagen";
myCar.Model = "golf 5";
myCar.Color = "Zwart";

Console.WriteLine(myCar.Model);

car bertsCar = new car
{
    Brand = "Volvo",
    Model = "XC - 40",
    Color = "rood",
    Price = 70000
};

Console.WriteLine();