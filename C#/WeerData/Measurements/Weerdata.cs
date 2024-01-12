namespace Measurements;

public class Weerdata
{
    public List<Measurement> measurements = [];

    public void ReadFile()
    {
        StreamReader stream = new("Data.txt");

        bool data = false;

        while (!stream.EndOfStream)
        {
            var line = stream.ReadLine();
            if (!string.IsNullOrEmpty(line?.Trim()))
            {
                if (data)
                {
                    try
                    {
                        measurements.Add(new Measurement(line));
                    }
                    catch (Exception ex)
                    {
                        ErrorOccurred?.Invoke(this, new WeatherEventArgs(line));
                    }
                }
                else
                {
                    data = line[0] == '#';
                }
            }
        }
    }
        public event EventHandler<WeatherEventArgs>? ErrorOccurred;
}
