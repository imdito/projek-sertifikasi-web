<?php
    include_once '../../connection.php';

    session_start();

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
        header("Location: ../../auth/view/login_view.php");
        exit();
    }   

    $movie_id = $_GET['id'];

        $stmt = $connection->prepare("SELECT id FROM bookmark WHERE id_user = ? AND id_movie = ?");
        $stmt->bind_param("ii", $_SESSION['user_id'], $movie_id);
        if($stmt->execute()){
            echo "berhasil";
            $stmt->store_result();
            if($stmt->num_rows > 0){
                // Name sudah digunakan
                header("Location: ../view/index.php?error=exists");
                exit();
            }
        } else {
            echo "gagal";
            echo $stmt->error;
        }

    try{
        $stmt = mysqli_prepare($connection, "INSERT INTO bookmark (id_user, id_movie, created_at) VALUES (?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "ii", $_SESSION['user_id'], $movie_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // redirect ke halaman daftar film
        header("Location: ../view/index.php");
        exit();
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
?>