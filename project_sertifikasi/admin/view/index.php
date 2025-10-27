<?php

    session_start();
    // Periksa apakah pengguna sudah login dan memiliki peran admin
    if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
        header("Location: ../../auth/view/login_view.php");
        exit;
    }

    include '../controller/get_movie_data.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

    <!--navbar-->
    <nav class="navbar navbar-expand-lg bg-danger navbar-dark fw-bolder">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Manajemen Film</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="tambah_view.php">Tambah Film</a>
                </div>
            </div>
           <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../auth/controller/logout.php">Logout</a>
                  </li>
            </ul>
        </div>
    </nav>

    <div class="container text-center mt-5" style="margin-left:8%">
        <div class="row align-items">
            <div class="col">
                <div class="fw-bold text-start">
                    <h2>Selamat Datang di Manajemen Film</h2>
                    <p>Ini adalah daftar film Anda.</p>
                </div>
                <table class="table table-striped table-bordered mt-4">
                    <thead class="table-danger">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Film</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Sutradara</th>
                            <th scope="col">Link Gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($movies->num_rows > 0) {
                                $no = 1;
                                while($row = $movies->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $no++ . "</th>";
                                    echo "<td>" . $row['judul'] . "</td>";
                                    echo "<td>" . $row['genre'] . "</td>";
                                    echo "<td>" . $row['sutradara'] . "</td>";
                                    echo "<td> <a href='" . $row['gambar'] . "'>Link</a></td>";
                                    echo "<td>
                                            <a href='edit.php?id=" . $row['id'] . "&judul=" . $row['judul'] . "&genre=" . $row['genre'] . "&sutradara=" . $row['sutradara'] . "&tahun=" . $row['tahun'] . "' class='btn btn-primary btn-sm mt-2 mb-2'>Edit</a>
                                            <a href='../controller/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus film ini?');\">Delete</a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>Tidak ada data film.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/35mm_movie_negative.jpg/1280px-35mm_movie_negative.jpg" class="img-fluid rounded" style="width:350px;height:500px; object-fit:cover;" alt="Film Image">
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>