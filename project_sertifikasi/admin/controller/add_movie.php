<?php
    include_once '../../connection.php';

    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $sutradara = $_POST['sutradara'];
    $gambar = $_POST['gambar'];


    try{
        $stmt = mysqli_prepare($connection, "INSERT INTO movie (judul, genre, sutradara, gambar) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $judul, $genre, $sutradara, $gambar);
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