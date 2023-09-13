using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace studeren
{
    internal class docent : human
    {
        internal string? name 
        {
            get; set;
        }

        internal int salary
        {
            get; set;
        }

        internal DateOnly DateOfBirth
        {
            get; set;
        }
    }
}
