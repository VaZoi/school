<?php

$a = readline("Welke operatie wil je uitvoeren? (+, -, %)" . PHP_EOL);
$b = readline("Eerste getal?" . PHP_EOL);
$c = readline("Tweede getal?" . PHP_EOL);

if($a=="+")
{
    echo "De resultaten zijn: " . (is_numeric($b) + is_numeric($c)) . PHP_EOL;
} elseif ($a=="-") {
    echo "De resultaten zijn: " . (is_numeric($b) - is_numeric($c)) . PHP_EOL;
} elseif ($a=="%") {
    echo "De resultaten zijn: " . (is_numeric($b) % is_numeric($c)) . PHP_EOL;
} else {
    exit("Dit is geen geldige operatie");
}
?>