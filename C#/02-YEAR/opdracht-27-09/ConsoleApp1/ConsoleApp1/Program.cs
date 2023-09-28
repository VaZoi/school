using ConsoleApp1;
using System.Text.Json;

class Program
{
    static void Main()
    {
        List<Car> cars = new List<Car>
        {
            new Car
            {
                Bestuurder = new Driver
                {
                    Naam = "Julie",
                    leeftijd = 22,
                    rijbewijsnummer = "G68GD9"
                }
            },

            new Car
            {
                Bestuurder = new Driver
                {
                    Naam = "Martino",
                    leeftijd = 34,
                    rijbewijsnummer = "PD10G7"
                }
            },

            new Car
            {
                Passagiers = new List<Human>
                {
                    new Human
                    {
                        Naam = "Lucas",
                        leeftijd = 15
                    },

                    new Human
                    {
                        Naam = "Myles",
                        leeftijd = 5
                    },

                    new Human
                    {
                        Naam = "Yasser",
                        leeftijd = 6
                    }
                }
            }

        };

        string fileName = "Opdracht_27_09.json";
        string jsonString = JsonSerializer.Serialize(cars);
        File.WriteAllText(fileName, jsonString);
    }
}