<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="script.js"></script>
    </head>
    <body>
        <?php
        include "functions.php";
       
        $new = convertLevel("solvable2");
        $board = parseBoard($new);
        $solvable = '<div class="wait" id="solvableContainer" >'
                . '<h1 id="solvableString">Waiting for server</h1></div>';
        
        $html = $board . $solvable;
        echo $html;
        ?>
    </body>
</html>
