<?php

    session_start();

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_role'] !== 'user'){
        header("Location: ../../auth/view/login_view.php");
        exit();
    }

    $username = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    include_once '../../connection.php';

    // Ambil daftar bookmark dari database
    try {
        $stmt = mysqli_prepare($connection, "SELECT bookmark.id, movie.judul, movie.genre, movie.sutradara, movie.gambar, created_at FROM `bookmark` INNER JOIN movie ON movie.id = bookmark.id_movie WHERE id_user = ?;");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } catch (Exception $e) {
        // Tangani kesalahan
        echo "Error: " . $e->getMessage();
    }
?>