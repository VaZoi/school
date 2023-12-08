using weer;

var stream = new StreamReader("Data.txt");
var data = false;
List<Measurement> measurements = new();

while (!stream.EndOfStream)
{
    var line = stream.ReadLine();
    if (!string.IsNullOrEmpty(line?.Trim()))
    {
        if (data)
        {
            try
            {
                Decode(line);
            }
            catch (Exception ex)
            {
                Console.WriteLine($"Error: {line}");
            }
        }
        else
        {
            data = line[0] == '#';
        }

    }
}


void Decode(string line)
{

    measurements.Add(
                new Measurement
                {
                    Date = DateTime.Parse(line[6..10] + '-' + line[10..12] + '-' + line[12..14] + ' ' + line[18..20] + ":00:00"),
                    Wind_direction = int.Parse(line[23..26]),
                    Avg_wind_speed_past_hr = int.Parse(line[30..32]),
                    Avg_windsnelheid_last_10_min = int.Parse(line[36..38]),
                    Maximum_wind_gust = int.Parse(line[41..44]),
                    Temperature = int.Parse(line[47..50]),
                    Minimum_temperature = int.Parse(line[53..56]),
                    Dew_point_temperature = int.Parse(line[59..62]),
                    Sunshine_duration = int.Parse(line[67..68]),
                    Global_radiation = int.Parse(line[73..74]),
                    Precipitation_duration = int.Parse(line[79..80]),
                    Hourly_precipitation_amount = int.Parse(line[83..86]),
                    Air_Pressure = int.Parse(line[87..92]),
                    Horizontal_visibility_time_observation = int.Parse(line[96..98]),
                    Cloud_cover = int.Parse(line[103..104]),
                    Relative_atmospheric_humidity = int.Parse(line[108..110]),
                    Present_weather_code = int.Parse(line[114..116]),
                    Indicator_present_weather_code = int.Parse(line[121..122]),
                    Fog = int.Parse(line[127..128]),
                    Rainfall = int.Parse(line[133..134]),
                    Snow = int.Parse(line[139..140]),
                    Thunder = int.Parse(line[145..146]),
                    Ice = int.Parse(line[151..152])
                });
}

foreach (var measurement in measurements)
{
    Console.WriteLine($"{measurement}");
}