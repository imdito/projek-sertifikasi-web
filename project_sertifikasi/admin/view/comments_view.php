<?php
    session_start();
    // Periksa apakah pengguna sudah login dan memiliki peran admin
    if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
        header("Location: ../../auth/view/login_view.php");
        exit;
    }

    include '../controller/get_comments.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Komentar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg bg-danger navbar-dark fw-bolder">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Manajemen Film</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="tambah_view.php">Tambah Film</a>
                    <a class="nav-link active" href="comments_view.php">Komentar</a>
                </div>
            </div>
           <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../auth/controller/logout.php">Logout</a>
                  </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5" style="margin-left:8%">
        <h2 class="mb-3">Daftar Komentar</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-danger">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">User</th>
                    <th scope="col">Film</th>
                    <th scope="col">Komentar</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($comments && $comments->num_rows > 0) {
                        $no = 1;
                        while($row = $comments->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $no++ . "</th>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['konten']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                            echo "<td><a href='../controller/delete_comment.php?id=" . $row['review_id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus komentar ini?');\">Hapus</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Tidak ada komentar.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
