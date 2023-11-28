<?php

if (isset($argv[1])) {
    $salt = "nmuioas912fdfsf32";
    $hashed = md5($argv[1] . $salt);
    echo $hashed;
}
?>
