<?php

$wachtwoord = $argv[1];
$hash = password_hash($wachtwoord, PASSWORD_BCRYPT);

echo $hash . PHP_EOL;

$wachtwoordvraag = readline("Wachtwoord ter controle: ");

if (password_verify($wachtwoordvraag, $hash)) {
    echo "Wachtwoord klopt!\n";
} else {
    echo "Wachtwoord klopt niet!\n";
}

?>
