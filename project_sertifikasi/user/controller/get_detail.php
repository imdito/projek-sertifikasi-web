<?php
    include_once '../../connection.php';
    $id= $_GET['id'];
    echo 'test';
    try{

        $sql ="SELECT * FROM movie WHERE ID = ?;";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $movie = mysqli_fetch_assoc($result);
        echo $movie;
    }catch(Exception $e){
        echo $e->getMessage();
    }
    mysqli_stmt_close($stmt);
?>