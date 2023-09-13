<?php

$a = readline("Vul een getal in" . PHP_EOL);
$b = ($a / 2);
$c = round($b, 0);

$d = $c - $b;

if ($d == 0) {
    echo "Dit is een even getal" . PHP_EOL;
} else {
    echo "Dit is een oneven getal" . PHP_EOL;
}

?>