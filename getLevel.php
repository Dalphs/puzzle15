
<?php

include 'functions.php';
$name = filter_input(INPUT_GET, "q");

$new = convertLevel($name);


echo json_encode($new);



