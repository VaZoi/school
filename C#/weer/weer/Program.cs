using weer;

var stream = new StreamReader("Data.txt");
var data = false;

while (!stream.EndOfStream)
{
    var line = stream.ReadLine();
    if (!string.IsNullOrEmpty(line?.Trim()))
    {
        if (data)
        {
            Decode(line);
        }
        else
        {
            data = line[0] == '#';
        }
        
    }
}

void Decode(string line)
{
    List<Measurement> measurements = new()
    {
                new Measurement
                {
                    Date = DateTime.Parse(line[6..10] + '-' + line[11..12] + '-' + line[13..14]),
                    Hour = int.Parse(line[18..20]),
                    Wind_direction = int.Parse(line[25..27]),
                    Avg_wind_speed_past_hr = int.Parse(line[31..32]),
                    Avg_windsnelheid_last_10_min = int.Parse(line[37..38]),
                    Maximum_wind_gust = int.Parse(line[42..45]),
                    Temperature = int.Parse(line[48..51]),
                    Minimum_temperature = int.Parse(line[54..57]),
                    Dew_point_temperature = int.Parse(line[60..63]),
                    Sunshine_duration = int.Parse(line[69..70]),
                    Global_radiation = int.Parse(line[75..76]),
                    Precipitation_duration = int.Parse(line[80..81]),
                    Hourly_precipitation_amount = int.Parse(line[84..87])
                }
            };
    Console.WriteLine($"{measurements}");

}