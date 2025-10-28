<?php

    session_start();
    // Jika pengguna belum login, redirect ke login_view.php
    if(!isset($_SESSION['user_id'])){
        header("Location: ../../auth/view/login_view.php");
        exit;
    }

    $username = $_SESSION['user_name'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Manajemen Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
    <style>

    @import url(https://fonts.googleapis.com/css?family=Montserrat:400,500,80);


    body{
    font-family: 'Montserrat', sans-serif;
    }

    .card:hover{
        transform: scale(1.14);
    }

    .card{
        transition: all 0.7s;
        width : 250px;
        
        margin-bottom: 30px;
    }

    a {
        text-decoration: none;
    }

    .card img{
        width: 250px;
        height: 250px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 6%;
        border-radius: 3%;
    }

  </style>
  <body>
    <nav class="navbar navbar-expand-lg bg-danger navbar-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand fw-bolder" href="../../landing_page.php">Manajemen Film</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bookmark_page.php">Bookmark</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../auth/controller/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2 class="fw-bolder" style="margin-left: 15% ">Halo <?php echo $username; ?>👋🏻</h2>
    <center>
        <div class="w-75 mt-4">
            <h3 class="fw-bolder">Daftar Film yang Tersedia</h3>
            <?php
            if(isset($_GET['error'])){
                echo '<h3>Gagal menambahkan bookmark! Film sudah ada di bookmark.</h3>';
            }
            ?>
            <div class="container text-center">
            <div class="row row-cols-2 row-cols-md-3 g-5 g-lg-3 mb-4 mt-4">
                <?php
                include '../../admin/controller/get_movie_data.php';
                foreach($movies as $movie){
                    echo '<div class="col">
                    
                    <div class="card shadow-lg rounded-0 border-light" style="width: 300px  ;">
                        <img src="'.$movie['gambar'].'" class="card-img-top" alt="'. $movie['judul'].'" style="object-fit: contain; ">
                        <div class="card-body">
                            <h4 class="card-text fw-bolder text-dark">'.$movie['judul'].'</h4>
                            <div class="container text-center">
                                <div class="row align-items-end">
                                    <div class="col">
                                        <a href="detail_page.php?id='.$movie['id'].'" class="btn btn-primary text-white fw-bolder " style="width: 100%; margin-top: 10%">Detail</a>
                                    </div>
                                    <div class="col">
                                        <a href="../controller/add_bookmark.php?id='.$movie['id'].'" class="btn btn-success text-white fw-bolder" style="width: 100%; margin-top: 10%">Tambah</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>';
                }
                ?>
                <div class="col">
            </div>
        </div>


    </center>   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>