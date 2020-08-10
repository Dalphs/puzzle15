
<?php

include 'functions.php';
//Først hentes den string der er sendt med som parameter i HTTP-requesten
$name = filter_input(INPUT_GET, "q");
$level = convertLevel($name);

$isSolvable = isSolvable($level);
//Response er et JSON objekt der sendes retur til klienten med det valgte level
// Og om det level kan løses.
$response = new \stdClass();
$response->isSolvable = $isSolvable;
$response->level = $level;

echo json_encode($response);



