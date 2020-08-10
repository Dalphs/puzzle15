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

// Oversætter det indlæste level til html
function parseBoard($board) {
    $counter = 1;    
    $htmlString = 
            '<div id="board">' .
            '  <div id="grid">';
    for ($i = 0; $i < 4; $i++) {
        for($j = 0; $j < 4; $j++) {
            //Div får hver et unikt id efter deres placering på boardet, og tallene som Div'en viser
            // afhænger af det indlæste level. Den neutrale får klassen tile-n og alle andre får klassen tile
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


function isSolvable($level){
    $invCount = getInvCount($level);


    $blankRow = -1;

    //Finder ud af hvilken række det blanke felt befinder sig på talt fra bunden startende fra 1
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 4; $j++) {
            if ($level[3 - $i][$j] == 16){
                $blankRow = $i + 1;
            }
        }
    }
    //For at regne ud om et puzzle15 kan løses skal man vide inverted count og hvilken række x er placeret i
    //talt fra bunden startende på 1. Hvis den ene variabel er lige, skal den anden være ulige.
    //Det betyder at den ene varibel % 2 skal være 1 og den anden 0. Derfor skal de to lagt sammen give 1
    return $invCount % 2 + $blankRow % 2 == 1;
}

// Inverted count regnes ved at lave det to dimnesionelle array om til et et dimensionelt. Herefter gennemgås tallene
// fra start til slut. Lad os sige at 5 er det første tal. Antallet af invertions det antal tal der kommer efter 5 som
// som er lavere. denne process gennemgås med alle tallene og til sidst vil man have det samlede antal invertions
function getInvCount($level) {
    $oneD = [];
    $counter = 0;
    // laver to dimensionelt array om til et dimensionelt
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $oneD[$counter] = $level[$i][$j];
            $counter++;
        }
    }

    //tæller antallet af invertions
    $invCount = 0;
    for ($i = 0; $i < count($oneD); $i++) {
        for ($j = $i; $j < count($oneD); $j++) {
            $oneD[$i] > $oneD[$j] ? $invCount++ : "";
        }
    }
    return $invCount;
}
