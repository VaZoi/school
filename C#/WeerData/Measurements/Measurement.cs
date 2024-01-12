namespace Measurements;

public class Measurement
{
    public DateTime Date { get; set; }

    /// <summary>
    /// Windrichting (in graden) 
    /// </summary>
    public int? Wind_direction { get; set; }

    /// <summary>
    /// Windsnelheid (in 0.1 m/s) gemiddeld over het afgelopen uur
    /// </summary>
    public int? Avg_wind_speed_past_hr { get; set; }

    /// <summary>
    /// Windsnelheid (in 0.1 m/s) gemiddeld over de laatste 10 minuten van het afgelopen uur
    /// </summary>
    public int? Avg_windsnelheid_last_10_min { get; set; }

    /// <summary>
    /// Hoogste windstoot (3 seconde gemiddelde windsnelheid; in 0.1 m/s) gemeten in het afgelopen uur
    /// </summary>
    public int? Maximum_wind_gust { get; set; }

    /// <summary>
    /// Temperatuur (in 0.1 graden Celsius) op 1.50 m hoogte tijdens de waarneming
    /// </summary>
    public int? Temperature { get; set; }

    /// <summary>
    /// Minimumtemperatuur (in 0.1 graden Celsius) op 10 cm hoogte in de afgelopen 6 uur
    /// </summary>
    public int? Minimum_temperature { get; set; }

    /// <summary>
    /// Dauwpuntstemperatuur (in 0.1 graden Celsius) op 1.50 m hoogte tijdens de waarneming
    /// </summary>
    public int? Dew_point_temperature { get; set; }

    /// <summary>
    /// Duur van de zonneschijn (in 0.1 uren) per uurvak, berekend uit globale straling  (-1 for <0.05 uur)
    /// </summary>
    public int? Sunshine_duration { get; set; }

    /// <summary>
    /// Globale straling (in J/cm2) per uurvak
    /// </summary>
    public int? Global_radiation { get; set; }

    /// <summary>
    /// Duur van de neerslag (in 0.1 uur) per uurvak
    /// </summary>
    public int? Precipitation_duration { get; set; }

    /// <summary>
    /// Uursom van de neerslag (in 0.1 mm) (-1 voor <0.05 mm)
    /// </summary>
    public int? Hourly_precipitation_amount { get; set; }

    /// <summary>
    /// Luchtdruk (in 0.1 hPa) herleid naar zeeniveau, tijdens de waarneming
    /// </summary>
    public int? Air_Pressure { get; set; }

    /// <summary>
    /// Horizontaal zicht tijdens de waarneming (0=minder dan 100m, 1=100-200m, 2=200-300m,..., 49=4900-5000m, 50=5-6km, 56=6-7km, 57=7-8km, ..., 79=29-30km, 80=30-35km, 81=35-40km,..., 89=meer dan 70km)
    /// </summary>
    public int? Horizontal_visibility_time_observation { get; set; }

    /// <summary>
    /// Bewolking (bedekkingsgraad van de bovenlucht in achtsten), tijdens de waarneming (9=bovenlucht onzichtbaar)
    /// </summary>
    public int? Cloud_cover { get; set; }

    /// <summary>
    /// Relatieve vochtigheid (in procenten) op 1.50 m hoogte tijdens de waarneming
    /// </summary>
    public int? Relative_atmospheric_humidity { get; set; }

    /// <summary>
    /// Weercode (00-99), visueel(WW) of automatisch(WaWa) waargenomen, voor het actuele weer of het weer in het afgelopen uur. Zie https://cdn.knmi.nl/knmi/pdf/bibliotheek/scholierenpdf/weercodes_Nederland.pdf
    /// </summary>
    public int? Present_weather_code { get; set; }

    /// <summary>
    ///  Weercode indicator voor de wijze van waarnemen op een bemand of automatisch station (1=bemand gebruikmakend van code uit visuele waarnemingen, 2,3=bemand en weggelaten (geen belangrijk weersverschijnsel, geen gegevens), 4=automatisch en opgenomen (gebruikmakend van code uit visuele waarnemingen), 5,6=automatisch en weggelaten (geen belangrijk weersverschijnsel, geen gegevens), 7=automatisch gebruikmakend van code uit automatische waarnemingen)
    /// </summary>
    public int? Indicator_present_weather_code { get; set; }

    /// <summary>
    /// Mist 0=niet voorgekomen, 1=wel voorgekomen in het voorgaande uur en/of tijdens de waarneming
    /// </summary>
    public int? Fog { get; set; }

    /// <summary>
    /// Regen 0=niet voorgekomen, 1=wel voorgekomen in het voorgaande uur en/of tijdens de waarneming
    /// </summary>
    public int? Rainfall { get; set; }

    /// <summary>
    /// Sneeuw 0=niet voorgekomen, 1=wel voorgekomen in het voorgaande uur en/of tijdens de waarneming
    /// </summary>
    public int? Snow { get; set; }

    /// <summary>
    /// Onweer 0=niet voorgekomen, 1=wel voorgekomen in het voorgaande uur en/of tijdens de waarneming
    /// </summary>
    public int? Thunder { get; set; }

    /// <summary>
    /// IJsvorming 0=niet voorgekomen, 1=wel voorgekomen in het voorgaande uur en/of tijdens de waarneming
    /// </summary>
    public int? Ice { get; set; }

    static int? ParseNumber(string part) => int.TryParse(part, out var number) ? number : null;

    public Measurement() { }

    public Measurement(string line)
    {
        var parts = line.Split([',']);

        var time = ParseNumber(parts[2]);
        if (time == 24)
        {
            time = 0;
        }
        Date = DateTime.Parse(parts[1][0..4] + '-' + parts[1][4..6] + '-' + parts[1][6..8] + ' ' + time + ":00:00");
        Wind_direction = int.Parse(parts[3]);
        Avg_wind_speed_past_hr = ParseNumber(parts[4]);
        Avg_windsnelheid_last_10_min = ParseNumber(parts[5]);
        Maximum_wind_gust = ParseNumber(parts[6]);
        Temperature = ParseNumber(parts[7]);
        Minimum_temperature = ParseNumber(parts[8]);
        Dew_point_temperature = ParseNumber(parts[9]);
        Sunshine_duration = ParseNumber(parts[10]);
        Global_radiation = ParseNumber(parts[11]);
        Precipitation_duration = ParseNumber(parts[12]);
        Hourly_precipitation_amount = ParseNumber(parts[13]);
        Air_Pressure = ParseNumber(parts[14]);
        Horizontal_visibility_time_observation = ParseNumber(parts[15]);
        Cloud_cover = ParseNumber(parts[16]);
        Relative_atmospheric_humidity = ParseNumber(parts[17]);
        Present_weather_code = ParseNumber(parts[18]);
        Indicator_present_weather_code = ParseNumber(parts[19]);
        Fog = ParseNumber(parts[20]);
        Rainfall = ParseNumber(parts[21]);
        Snow = ParseNumber(parts[22]);
        Thunder = ParseNumber(parts[23]);
        Ice = ParseNumber(parts[24]);
    }

    public override string ToString() => $"{Date} {Wind_direction} {Avg_wind_speed_past_hr} {Avg_windsnelheid_last_10_min} {Maximum_wind_gust} {Temperature} {Minimum_temperature} {Dew_point_temperature} {Sunshine_duration} {Global_radiation} {Precipitation_duration} {Hourly_precipitation_amount} {Air_Pressure} {Horizontal_visibility_time_observation} {Cloud_cover} {Relative_atmospheric_humidity} {Present_weather_code} {Indicator_present_weather_code} {Fog} {Rainfall} {Snow} {Thunder} {Ice}";
}
