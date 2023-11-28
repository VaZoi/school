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

        public override string ToString() => $"{Date} {Hour} {Wind_direction} {Avg_wind_speed_past_hr} {Avg_windsnelheid_last_10_min} {Maximum_wind_gust} {Temperature} {Minimum_temperature} {Dew_point_temperature} {Sunshine_duration} {Global_radiation} {Precipitation_duration} {Hourly_precipitation_amount}";
    }
}
