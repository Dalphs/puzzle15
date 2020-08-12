<?php

include 'functions.php';
//Først hentes den string der er sendt med som parameter i HTTP-requesten
$name = 'solvable2';
$level = convertLevel($name);
$blankTile = locateBlank($level);
$lockedTiles = [];

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
function swapValues($board, $blank, $locked){
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
    
    if ($direction == 1 && !in_array([$x, $y - 1], $locked)){
        $board[$x][$y] = $board[$x][$y - 1];
        $board[$x][$y - 1] = $temp;
        $y -= 1;   
    } else if ($direction == 2 && !in_array([$x, $y + 1], $locked)){
        $board[$x][$y] = $board[$x][$y + 1];
        $board[$x][$y + 1] = $temp;
        $y += 1;
    } else if ($direction == 3 && !in_array([$x - 1, $y], $locked)){
        $board[$x][$y] = $board[$x - 1][$y];
        $board[$x - 1][$y] = $temp;
        $x -= 1;
    } else if ($direction == 4 && !in_array([$x + 1, $y], $locked)) {
        $board[$x][$y] = $board[$x + 1][$y];
        $board[$x + 1][$y] = $temp;
        $x += 1;
    }
    $obj = new \stdClass();
    $obj->board = $board;
    $obj->blank = [$x,$y];
    return $obj;
}

function updateLocked($board, $locked) {
        
    switch (sizeof($locked)){
        case 0:
            if ($board[0][0] == 1){
            array_push($locked, [0, 0]);
            echo "<br>locked 1";
            print_r($board);
            }
            break;
        case 1:
            if ($board[0][1] == 2){
                array_push($locked, [0, 1]);
                echo "<br>locked 2";
                print_r($board);
            }
            break;
        case 2:
            if ($board[0][2] == 3 && $board[0][3] == 4){
                array_push($locked, [0, 2]);
                array_push($locked, [0, 3]);
                echo "<br>locked 3 and 4";
                print_r($board);
            }else if($board[1][0] == 5){
                array_push($locked, [1, 0]);
                echo "<br>locked 5";
                print_r($board);
            }
            break;
        case 3:
             if ($board[0][2] == 3 && $board[0][3] == 4){
                array_push($locked, [0, 2]);
                array_push($locked, [0, 3]);
                echo "<br>locked 2 and 3";
                print_r($board);
            }
            break;
        case 4:
            if($board[1][0] == 5){
                array_push($locked, [1, 0]);
                echo "<br>locked 5";
            }
            break;
        case 5: 
            if($board[2][0] == 9 && $board[3][0] == 13){
                array_push($locked, [2, 0]);
                array_push($locked, [3, 0]);
                echo "<br>locked 9 and 13";
                print_r($board);
            }
        case 7:
            if($board[1][1] == 6 && $board[1][2] == 7 && $board[1][3] == 8 &&
                    $board[2][1] == 10 && $board[2][2] == 11 && $board[2][3] == 12 &&
                    $board[3][1] = 14 && $board[3][2] == 15 && $board[3][3] == 16){
                array_push($locked, [1, 1]);
                array_push($locked, [1, 2]);
                array_push($locked, [1, 3]);
                array_push($locked, [2, 1]);
                array_push($locked, [2, 2]);
                array_push($locked, [2, 3]);
                array_push($locked, [3, 1]);
                array_push($locked, [3, 2]);
                array_push($locked, [3, 3]);
            }
    }
    return $locked;
    
        
    
}
$timeStart = microtime(true);
$counter = 0;
while (sizeof($lockedTiles) < 12){
    
    $resp = swapValues($level, $blankTile, $lockedTiles);
    $level = $resp->board;
    $blankTile = $resp->blank;
    $lockedTiles = updateLocked($level, $lockedTiles);

    
    $counter++;
}
echo parseBoard($level);
echo "Counter: " . $counter;
$timeEnd = microtime(true);

echo ($timeEnd - $timeStart);
