<?php

// Deel 1 

$myArray = ['auto', 'fiets', 'brommer', 'bus', 'vliegtuig', 'trein'];
array_push($myArray, "metro");
echo print_r($myArray);

// Deel 2

$myArray = ['auto', 'fiets', 'brommer', 'bus', 'vliegtuig', 'trein'];
$n = count($myArray);
echo "Het array heeft " . $n . " elementen";
array_push($myArray, "metro");
echo "Het array heeft " . $n . " elementen";

// Deel 3

// regel 2 print bar uit.
// regel 5 print 4 uit.
// regel 8 print Toyota uit.
// regel 9 print 3 uit.
// regel 12 print 5 uit.
// regel 19 print five uit.


// Deel 4

$cijfersPHP = [4.4, 4.6, 5.6, 6.1, 7.6, 7.2];

// bereken gemiddelde door alle cijfers op te tellen en te delen door het aantal
$gemiddelde = array_sum($cijfersPHP) / count($cijfersPHP);
echo "Gemiddelde is: " . round($gemiddelde, 1);

//Deel 4B
//comment samenvoegen vind ik het beter want het is kleiner en duidelijker geschreven.

?>