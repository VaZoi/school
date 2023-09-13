var myName = "Julie";
var yourName = "blabla";
Console.WriteLine(myName + yourName);

for (var i = 1; i < 5; i++)
{
    Console.WriteLine("test" + i);
}

static int Add(int i)
{
    return i + 1;
}



int Minus(int k)
{
    return k - 1;
}

var j = 1;
while (j < 5)
{
    Console.WriteLine("j=" + Minus(Add(j)));
    j++;
}