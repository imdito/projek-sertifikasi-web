<?php
    include_once '../../connection.php';

    session_start(); 

    $review_id = $_GET['id'];

    try{
        $stmt = mysqli_prepare($connection, "SELECT review.id, users.id, review.konten FROM `review` INNER JOIN users on users.id = review.id_user WHERE review.id_movie = ?;");
        mysqli_stmt_bind_param($stmt, "i", $review_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);  
        mysqli_stmt_close($stmt);

        exit();
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
?>