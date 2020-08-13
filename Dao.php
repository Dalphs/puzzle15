<?php
class Dao{
    
    public $conn;

    // Create connection
    function __construct(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "puzzle15";
    $this->conn = new mysqli($servername, $username, $password, $dbName);
    // Check connection
    if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
        }
        echo "Connected successfully";    

    }

    function createDB($name){
        $sql = "CREATE DATABASE " . $name;
        if ($this->conn->query($sql  ) === TRUE){
            echo "Database created succesfully";
        } else {
            echo "Error creating database: " . $this->conn->error;
        }
    }

    function createTable(){
        $sql = "CREATE TABLE firstrow ("
                . "id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, "
                . "board char(255) NOT NULL, "
                . "moves char(255) NOT NULL)";
        if ($this->conn->query($sql  ) === TRUE){
            echo "table created succesfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    function insert($board, $moves){
        $sql = "INSERT INTO firstrow(board, moves) VALUES ('" . $this->boardToString($board) . "', '" . $moves . "')";
        if ($this->conn->query($sql  ) === TRUE){
            echo "table created succesfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    function find($board){
        $sql = "SELECT board, moves FROM firstrow WHERE board = '" . $this->boardToString($board) . "'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function boardToString($board){
        $temp = "";
        for ($i = 0; $i < 4; $i++){
            for ($j = 0; $j < 4; $j++){
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

    function closeConn(){
        $this->conn->close();
    }
}
?>