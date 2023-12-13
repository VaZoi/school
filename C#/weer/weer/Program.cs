
using WeerData;

var weather = new Weerdata();
weather.ReadFile();


foreach (var measurement in weather.measurements)
{
    Console.WriteLine($"{measurement}");
}