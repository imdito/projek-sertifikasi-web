<?php
    try{
        require_once '../../connection.php';

        $sql = "SELECT review.id AS review_id, review.konten, review.created_at, users.name, movie.judul FROM review INNER JOIN users ON users.id = review.id_user INNER JOIN movie ON movie.id = review.id_movie ORDER BY review.created_at DESC";
        $comments = $connection->query($sql);

        $connection->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

?>
