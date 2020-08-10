<?php


//Indlæser level fra .txt fil med vilkårligt navn og konverterer til 4x4 array
function convertLevel($name) {
    if ($file = fopen($name . ".txt", "r")) {
        
        $data = fgets($file);
        $numbers = explode("-", $data);
        
        $counter = 0;
        $board;
        for ($i = 0; $i < 4; $i++) {
            for($j = 0; $j < 4; $j++) {
                $board[$i][$j] = $numbers[$counter];
                $counter++;
            }
        }
        return $board;
    }else {
        return -1;
    }
}

function parseBoard($board) {
    $counter = 1;    
    $htmlString = 
            '<div id="board">' .
            '  <div id="grid">';
    for ($i = 0; $i < 4; $i++) {
        for($j = 0; $j < 4; $j++) {
            $htmlString .= '<div class="' . (($board[$i][$j] == 16) ? 'tile-n' : 'tile') .
                    '" id="t' . $counter . '" onclick="tileClicked(' . $counter . ')">' . 
                    (($board[$i][$j] == 16) ? '-' : $board[$i][$j]) . '</div>';
            $counter++;
        }
    }
    $htmlString .= 
            "  </div>" .
            "</div>";
    return $htmlString;
}

