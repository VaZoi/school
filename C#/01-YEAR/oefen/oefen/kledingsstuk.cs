using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace oefen
{
    internal class kledingsstuk
    {
        internal string? soort
        {
            get; set; 
        }

        internal string? merk
        {
            get; set;
        }

        internal string? MadeIn
        {
            get; set;
        }

        internal size maat
        {
            get; set;
        }

        internal decimal prijs
        {
            get; set;
        }

        internal string? kleur
        {
            get; set;
        }

        internal enum size
        {
            XS,
            S,
            M,
            L,
            XL,
            XXL,
        }
    }
}
