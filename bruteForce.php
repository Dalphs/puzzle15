<?php

include 'functions.php';
//Først hentes den string der er sendt med som parameter i HTTP-requesten
$name = 'solvable2';
$level = convertLevel($name);
$blankTile = locateBlank($level);

function locateBlank($level){
    for($i = 0; $i < 4; $i++){
        for($j = 0; $j < 4; $j++){
            if($level[$i][$j] == 16){
                return [$i, $j];
            }
        }
    }
    return -1;
}

function checkBoard($board) {
    $counter = 1;
    for ($i = 0; $i < sizeof($board); $i++) {
        for ($j = 0; $j < sizeof($board[0]); $j++) {
            if ($board[$i][$j] != $counter){
                return false;
            }
            $counter++;
        }
    }
    return true;
}
//swapping random values
function swapValues($board, $blank){
    $x = $blank[0];
    $y = $blank[1];
    // 1 = op, 2 = ned, 3 = venstre, 4 = højre
    $direction = rand(1,4);
    if ($direction == 1 && $y == 0){
        $direction = 2;
    } else if ($direction == 2 && $y == 3) {
        $direction = 1;
    } else if ($direction == 3 && $x == 0) {
        $direction = 4;
    } else if ($direction == 4 && $x == 3) {
        $direction = 3;
    }
    $temp = $board[$x][$y];
    if ($direction == 1){
        $board[$x][$y] = $board[$x][$y - 1];
        $board[$x][$y - 1] = $temp;
        $y -= 1;
    } else if ($direction == 2){
        $board[$x][$y] = $board[$x][$y + 1];
        $board[$x][$y + 1] = $temp;
        $y += 1;
    } else if ($direction == 3){
        $board[$x][$y] = $board[$x - 1][$y];
        $board[$x - 1][$y] = $temp;
        $x -= 1;
    } else if ($direction == 4) {
        $board[$x][$y] = $board[$x + 1][$y];
        $board[$x + 1][$y] = $temp;
        $x += 1;
    }
    $obj = new \stdClass();
    $obj->board = $board;
    $obj->blank = [$x,$y];
    return $obj;
}
$timeStart = microtime(true);
for ($j = 0; $j < 1000; $j++){
    for ($i = 0; $i < 40; $i++) {
        $resp = swapValues($level, $blankTile);
        $level = $resp->board;
        $blankTile = $resp->blank;
        
        if ($level[0][0] == 1 && $level[0][1] == 2){
            echo "WOWOW<br>";
            print_r($level);
        }
    }
}
echo checkBoard($level) ? "true" : "false";
$timeEnd = microtime(true);

echo ($timeEnd - $timeStart);
