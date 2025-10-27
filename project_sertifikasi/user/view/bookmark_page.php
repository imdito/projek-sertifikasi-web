<?php

    session_start();
    // Jika pengguna belum login, redirect ke login_view.php
    if(!isset($_SESSION['user_id'])){
        header("Location: ../../auth/view/login_view.php");
        exit;
    }

    include '../controller/bookmark_controller.php';
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
    <!--navbar-->
    <nav class="navbar navbar-expand-lg bg-danger navbar-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand fw-bolder" href="../../landing_page.php">Manajemen Film</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="bookmark_page.php">Bookmark</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
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

    <h2 class="fw-bolder" style="margin-left: 15% ">Daftar Film yang kamu masukkan ke dalam Bookmark</h2>

    <!--Table-->
    <table class="table table-striped table-bordered mt-4" style="width: 80%; margin-left: 10%;">
                    <thead class="table-danger">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Film</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Sutradara</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($result->num_rows > 0) {
                                $no = 1;
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $no++ . "</th>";
                                    echo "<td>" . $row['judul'] . "</td>";
                                    echo "<td>" . $row['genre'] . "</td>";
                                    echo "<td>" . $row['sutradara'] . "</td>";
                                    echo "<td> <img src='" . $row['gambar'] . "' alt='" . $row['judul'] . "' style='width: 100px; height: auto;'></td>";
                                    echo "<td>
                                            <a href='../controller/delete_bookmark.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus film ini?');\">Delete</a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>Tidak ada data film.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>