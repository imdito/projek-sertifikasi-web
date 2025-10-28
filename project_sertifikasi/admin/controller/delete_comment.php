<?php
    include_once '../../connection.php';
    session_start();

    // Pastikan hanya admin yang bisa mengakses
    if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
        header("Location: ../../auth/view/login_view.php");
        exit;
    }

    if(!isset($_GET['id'])){
        header("Location: ../view/comments_view.php");
        exit;
    }

    $review_id = intval($_GET['id']);

    try{
        $stmt = mysqli_prepare($connection, "DELETE FROM review WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $review_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // redirect kembali ke daftar komentar
        header("Location: ../view/comments_view.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

?>
