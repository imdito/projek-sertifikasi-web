<?php
    include_once '../../connection.php';
    session_start();
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
        header("Location: ../../auth/view/login_view.php");
        exit();
    }
    $movie_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    $review_text = $_POST['review'];
    try{
        $stmt = mysqli_prepare($connection, "INSERT INTO review (id_user, id_movie, konten, created_at) VALUES (?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "iis", $user_id, $movie_id, $review_text);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // redirect ke halaman detail film
        header("Location: ../view/detail_page.php?id=" . $movie_id);
        exit();
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }

?>