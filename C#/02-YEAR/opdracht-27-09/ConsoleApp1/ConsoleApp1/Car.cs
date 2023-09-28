namespace ConsoleApp1
{
    internal class Car
    {
        public List<Human> Passagiers
        {
            get; set;
        }

        public Car()
        {
            Passagiers = new List<Human>();
        }

        public Driver? Bestuurder
        {
            get; set;
        }
    }
}
