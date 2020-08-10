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
       
        $new = convertLevel("solvable");
        $html = parseBoard($new);
        echo $html;
        ?>
    </body>
</html>
