using Measurements;
using Microsoft.AspNetCore.Mvc;

namespace WeerData.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class WeatherForecastController : ControllerBase
    {
        public WeatherForecastController() => weer.ReadFile();

        [HttpGet("GetAllWeather")]
        public Microsoft.AspNetCore.Http.HttpResults.Ok<List<Measurement>> GetAllWeather() => TypedResults.Ok(weer.measurements);

        readonly Weerdata weer = new();
    }
}
