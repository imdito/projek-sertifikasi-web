<?php
    include_once '../../connection.php';

    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $sutradara = $_POST['sutradara'];
    $gambar = $_POST['gambar'];
    $sinopsis = $_POST['sinopsis'];


    try{
        $stmt = mysqli_prepare($connection, "INSERT INTO movie (judul, genre, sutradara, gambar, sinopsis) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $judul, $genre, $sutradara, $gambar, $sinopsis);
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