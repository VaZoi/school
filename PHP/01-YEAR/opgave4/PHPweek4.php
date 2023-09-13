<?php

// 1

for ($x = 0; $x <= 50; $x++) {
    echo "The number is: $x ";
  }

// 2

$name = array("Julie", "Dylan", "Lenny", "Mustapha", "Jaden", "Lucas", "Yasser", "Marlon", "Dejah", "Ridda");
$a = count($name);

for($x = 0; $x < $a; $x++) {
  echo $name[$x];
  echo "<br>";
}

// 3

$maanden = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December']; 
$b = count($maanden);

for($z = 0; $z < $b; $z++) {
    echo $maanden[$z];
    echo "<br>";
}

// 4

$maanden = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December']; 

foreach($maanden as $a) {
    echo $a . "<br>";
}

?>