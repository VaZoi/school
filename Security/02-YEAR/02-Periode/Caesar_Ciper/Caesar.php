<?php

$lijst = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

$a = readline("enter shift number: " . PHP_EOL);
    $b = readline("enter message: " . PHP_EOL);

    $Cipher = '';

    for ($i = 0; $i < strlen($b); $i++) {
        $d = $b[$i];

        if (in_array($d, $lijst)) {
            $index = (array_search($d, $lijst) + $a) % count($lijst);
            $Cipher .= $lijst[$index];
        } else {
            $Cipher .= $d;
        }
    }

    echo $Cipher . PHP_EOL;

?>