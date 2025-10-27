<?php
    include_once '../../connection.php';

    session_start();

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
        header("Location: ../../auth/view/login_view.php");
        exit();
    }   

    $bookmark_id = $_GET['id'];

    try{
        $stmt = mysqli_prepare($connection, "DELETE FROM bookmark WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $bookmark_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // redirect ke halaman daftar film setelah penghapusan
        header("Location: ../view/bookmark_page.php");
        exit();
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }

?>