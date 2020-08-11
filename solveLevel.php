<?php

include 'functions.php';
define("RIGHT", "right");
define("LEFT", "left");
define("UP", "up");
define("DOWN", "down");

//Først hentes den string der er sendt med som parameter i HTTP-requesten
$name = filter_input(INPUT_GET, "q");

$board = convertLevel($name);
$moves = [];

$part1 = [13, 9 , 5, 1, 2, 3, 4];

function moveBlank($coordinate, $board, $moves) {
    $current = getCoordinate(16, $board);
    $up = $current[0] - $coordinate[0];
    $right = $current[1] - $coordinate[1];
    while($up != 0) {
        if ($up < 0) {
            $temp = 2;
            array_push($moves, $temp);
            $up++;
        }else {
            $temp = 8;
            array_push($moves, $temp);
            $up--;
        }
    }
    while($right != 0){
        if ($right > 0) {
            $temp = 6;
            array_push($moves, $temp);
            $right--;
        }else {
            $temp = 4;
            array_push($moves, $temp);
            $right++;
        }
    }
    
}

function getCoordinate($number, $board) {
    $x = -1;
    $y = -1;
    for ($i = 0; $i < sizeof($board); $i++) {
        for ($j = 0; $j < sizeof($board[0]); $j++) {
            if ($board[$i][$j] == $number){
                $x = $i;
                $y = $j;
            }
        }
    }
    return [$x, $y];
}
$moves = moveBlank([1,2], $board, $moves);
$response = new \stdClass();
$response->moves = $moves;
echo json_encode($response);


