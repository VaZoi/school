using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApp1
{
    internal class opdracht
    {
        public static float convert(float a)
        {
            float cm1;
            cm1 = (float)(a * 2.54);
            return cm1;
        }
        public static void Main(string[] args)
        {
            float inch, cm;
            Console.WriteLine("Enter value in Inch : ");
            inch = float.Parse(Console.ReadLine());
            cm = convert(inch);
            Console.WriteLine("{0} inch is equal to {1} centimeter ", inch, cm);
            Console.ReadLine();
        }
    }
}
