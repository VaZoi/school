<?php

$wachtwoord = "password1234";
$Hash = md5($wachtwoord);
echo "Wachtwoord is: {$wachtwoord} en hash is: {$Hash}" . PHP_EOL;

var_dump($argv);
if (isset($argv[0])) {
    echo md5($argv[1]);
}
?>