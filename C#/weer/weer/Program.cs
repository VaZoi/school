
using WeerData;

var weather = new Weerdata();
weather.ErrorOccurred += Weather_ErrorOccurred;

void Weather_ErrorOccurred(object? sender, WeatherEventArgs e)
{
    Console.WriteLine($"Error: {e.Line}");
}

weather.ReadFile();


foreach (var measurement in weather.measurements)
{
    Console.WriteLine($"{measurement}");
}