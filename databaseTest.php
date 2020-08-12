<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "puzzle15";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

function createDB($conn, $name){
    $sql = "CREATE DATABASE " . $name;
    if ($conn->query($sql  ) === TRUE){
        echo "Database created succesfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}

function createTable($conn){
    $sql = "CREATE TABLE firstrow ("
            . "id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, "
            . "board char(255) NOT NULL, "
            . "moves char(255) NOT NULL)";
    if ($conn->query($sql  ) === TRUE){
        echo "table created succesfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

function insert($conn, $board, $moves){
    $sql = "INSERT INTO firstrow(board, moves) VALUES ('" . boardToString($board) . "', '" . movesToString($moves) . "')";
    if ($conn->query($sql  ) === TRUE){
        echo "table created succesfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

function find($conn, $board){
    $sql = "SELECT board, moves FROM firstrow WHERE board = '" . boardToString($board) . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "exists";
    } else {
        echo "doesnt exists";
    }
}
find($conn, [[3,2,1], [6,5,4], [9,8,6]]);

function boardToString($board){
    $temp = "";
    for ($i = 0; $i < 3; $i++){
        for ($j = 0; $j < 3; $j++){
            $temp .= $board[$i][$j];
        }
    }
    return $temp;
}

function movesToString($moves){
    $string = "";   
    foreach ($moves as $move){
        $string .= $move;
    }
    return $string;
}



$conn->close();
?>