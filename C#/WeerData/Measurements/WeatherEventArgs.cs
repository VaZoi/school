namespace Measurements;

public class WeatherEventArgs : EventArgs
{
    public WeatherEventArgs(string line)
    {
        Line = line;
    }

    public string Line { get; }
}