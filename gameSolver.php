<?php
include ("Dao.php");
//set_time_limit(360);

$dao = new Dao();

$initialBoard = [[1, 2, 3, 4],[0, 'x', 'x', 'x'],['x', 'x', 'x', 'x'],['x', 'x', 'x', 'x']];
$counter = 0;
set_time_limit(100);
$dao->insert($initialBoard, "");

function discoverTheWorld($livingMutations, $dao, $counter){
    $nextGen = [];
    foreach ($livingMutations as $mut) {    
        
        $newMutations = split($mut);
        foreach ($newMutations as $new) {
            if(!($dao->find($new[0]))){
                echo "<br>";
                $dao->insert($new[0], $new[1]);
                array_push($nextGen, $new);
            }
        }
    }
    if (sizeof($nextGen) != 0){
        $counter++;
        discoverTheWorld($nextGen, $dao, $counter);
    } else {
        
    }
}

function split($mutation){
    $new = [];
    $startingPoint = locateBlank($mutation[0]);
    if ($startingPoint[0] > 0){
        $moves = $mutation[1];
        $moves .= "l";
        $board = $mutation[0];
        $board = swapValues($board, $startingPoint, [$startingPoint[0] - 1, $startingPoint[1]]);
        array_push($new, [$board, $moves]);
    }
    if ($startingPoint[0] < 3){
        $moves = $mutation[1];
        $moves .= "r";
        $board = $mutation[0];
        $board = swapValues($board, $startingPoint, [$startingPoint[0] + 1, $startingPoint[1]]);
        array_push($new, [$board, $moves]);
    }
    if ($startingPoint[1] > 0){
        $moves = $mutation[1];
        $moves .= "u";
        $board = $mutation[0];
        $board = swapValues($board, $startingPoint, [$startingPoint[0], $startingPoint[1] - 1]);
        array_push($new, [$board, $moves]);
    }
    if ($startingPoint[1] < 3){
        $moves = $mutation[1];
        $moves .= "d";
        $board = $mutation[0];
        $board = swapValues($board, $startingPoint, [$startingPoint[0], $startingPoint[1] + 1]);
        array_push($new, [$board, $moves]);
    }
    echo "<br><br>";
    print_r($new);
    echo "<br>";
    return $new;
}

function swapValues($board, $coordinate1, $coordinate2){
    $temp = $board[$coordinate1[1]][$coordinate1[0]];
    $board[$coordinate1[1]][$coordinate1[0]] = $board[$coordinate2[1]][$coordinate2[0]];
    $board[$coordinate2[1]][$coordinate2[0]] = $temp;
    return $board;
}

function locateBlank($board){
    for ($i=0; $i < 4; $i++) { 
        for ($j=0; $j < 4; $j++) {
            if($board[$i][$j] === 0){
                return [$j, $i];
            }
        }
    }
}
discoverTheWorld([[$initialBoard, ""]], $dao, $counter);
$dao->closeConn();

?>