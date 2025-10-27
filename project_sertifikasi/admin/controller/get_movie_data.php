<?php


    try{

        require_once '../../connection.php';
        $sql = "SELECT * FROM movie";
        $movies = $connection->query($sql);   
    
        $connection->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }



?>