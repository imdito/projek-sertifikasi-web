<?php
    include_once '../../connection.php';

    session_start();

    if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
        header("Location: ../view/admin_login_view.php");
        exit();
    }   

    $movie_id = $_GET['id'];

    try{
        $stmt = mysqli_prepare($connection, "DELETE FROM movie WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $movie_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // redirect ke halaman daftar film
        header("Location: ../view/index.php");
        exit();
    } catch (Exception $e) {
        // Tangani error
        echo "Error: " . $e->getMessage();
    }

?>