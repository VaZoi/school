using Measurements;

int errors = 0;
var weather = new Weerdata();
weather.ErrorOccurred += Weather_ErrorOccurred;

void Weather_ErrorOccurred(object? sender, WeatherEventArgs e)
{
    Console.WriteLine($"Error: {e.Line}");
    errors++;
}

weather.ReadFile();

Console.WriteLine($"{errors} errors");

foreach (var measurement in weather.measurements)
{
    Console.WriteLine($"{measurement}");
}