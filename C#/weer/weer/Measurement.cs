namespace weer
{
    internal class Measurement
    {
        public DateTime Date;
        public int Hour;
        public int Wind_direction;
        public int Avg_wind_speed_past_hr;
        public int Avg_windsnelheid_last_10_min;
        public int Maximum_wind_gust;
        public int Temperature;
        public int Minimum_temperature;
        public int Dew_point_temperature;
        public int Sunshine_duration;
        public int Global_radiation;
        public int Precipitation_duration;
        public int Hourly_precipitation_amount;
        public int Air_Pressure;
        public int Horizontal_visibility_time_observation;
        public int Cloud_cover;
        public int Relative_atmospheric_humidity;
        public int Present_weather_code;
        public int Indicator_present_weather_code;
        public int Fog;
        public int Rainfall;
        public int Snow;
        public int Thunder;
        public int Ice;

        public override string ToString() => $"{Date} {Hour} {Wind_direction} {Avg_wind_speed_past_hr} {Avg_windsnelheid_last_10_min} {Maximum_wind_gust} {Temperature} {Minimum_temperature} {Dew_point_temperature} {Sunshine_duration} {Global_radiation} {Precipitation_duration} {Hourly_precipitation_amount} {Air_Pressure} {Horizontal_visibility_time_observation} {Cloud_cover} {Relative_atmospheric_humidity} {Present_weather_code} {Indicator_present_weather_code} {Fog} {Rainfall} {Snow} {Thunder} {Ice}";
    }
}
