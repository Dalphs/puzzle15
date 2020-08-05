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
        //Opgave 1: Filformatet er en txt hvor tallene skirves på første linje
        // og alle tal adskilles af "-". Derudover remgår den blanke som 16.
        // Tallene skrives på række i stedet for 4x4 format.
        //Eksempel:
        // 1  2  3  4
        // 5  6  7  8
        // 9  10 11 12
        // 13 14 15
        //konverteret til filformatet vil det se ud som følgende:
        //1-2-3-4-5-6-7-8-9-10-11-12-13-14-15-16
       
        $new = convertLevel("solvable");
        $html = parseBoard($new);
        echo $html;
        ?>
    </body>
</html>
