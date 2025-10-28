<?php
    include_once '../../connection.php';

    session_start();

    if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
        header("Location: ../../auth/view/login_view.php");
        exit;
    }

    $movie_id = $_POST['movie_id'];
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $sutradara = $_POST['sutradara'];
    $sinopsis = $_POST['sinopsis'];
    $gambar = $_POST['gambar'];

    try{
        $stmt = mysqli_prepare($connection, "UPDATE movie SET judul = ?, genre = ?, sutradara = ?, sinopsis = ?, gambar = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sssssi", $judul, $genre, $sutradara, $sinopsis, $gambar, $movie_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "Movie updated successfully.";
        // redirect ke halaman daftar film setelah penghapusan
        header("Location: ../view/index.php");
        exit();
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
?>