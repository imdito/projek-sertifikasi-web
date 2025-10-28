<?php
session_start();
include_once '../../connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];

// Variabel untuk menampung data
$movie = null;
$reviews = [];

// --- BLOK 1: AMBIL DATA FILM ---
try {
    $sql_get_movie = "SELECT * FROM movie WHERE ID = ?;";
    
    // Gunakan nama variabel yang unik, misal $stmt_movie
    $stmt_movie = mysqli_prepare($connection, $sql_get_movie);
    
    mysqli_stmt_bind_param($stmt_movie, "i", $id);
    mysqli_stmt_execute($stmt_movie);
    $result = mysqli_stmt_get_result($stmt_movie);
    $movie = mysqli_fetch_assoc($result);

    // Tutup statement film SETELAH selesai mengambil data
    mysqli_stmt_close($stmt_movie);

} catch (Exception $e) {
    echo "Error saat mengambil film: " . $e->getMessage();
}

// --- BLOK 2: AMBIL DATA REVIEW ---
try {
    $sql_get_reviews = "SELECT review.id AS review_id, users.name, review.konten, review.created_at 
                        FROM `review` 
                        INNER JOIN users ON users.id = review.id_user 
                        WHERE review.id_movie = ?;";

    // Gunakan nama variabel yang unik, misal $stmt_review
    $stmt_review = mysqli_prepare($connection, $sql_get_reviews);
    
    mysqli_stmt_bind_param($stmt_review, "i", $id);
    mysqli_stmt_execute($stmt_review);
    $result_reviews = mysqli_stmt_get_result($stmt_review);
    $reviews = mysqli_fetch_all($result_reviews, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt_review);

} catch (Exception $e) {
    echo "Error saat mengambil review: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Film - MovieMark</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  
  <style>
    /* Sedikit padding untuk konten utama */
    .main-content {
      padding: 60px 0;
    }
    .review-list .list-group-item {
      border-radius: .5rem; /* Membuat item review lebih rounded */
    }
  </style>

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        <i class="bi bi-film"></i> Manajemen Informasi Film
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="boomark_page.php">Bookmark</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../landing_page.php">Tentang</a>
          </li>
          <?php if ($_SESSION['logged_in'] === true) { ?>
            <li class="nav-item">
              <a class="nav-link" href="../../auth/controller/logout.php">Logout</a>
            </li>
          <?php } else { ?>
          <li class="nav-item ms-lg-3">
            <a class="btn btn-outline-light btn-sm me-2" href="../../auth/view/login_view.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light btn-sm text-danger" href="../../auth/view/register_view.php">Daftar</a>
          </li>
            <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <main class="main-content">
    <div class="container">
      
      <header class="mb-5">
        <div class="row g-4">
          <div class="col-md-4">
            <img src="<?php echo $movie['gambar']; ?>" alt="Poster Film" class="img-fluid rounded shadow-lg" style="width: 80%; margin-left: 10%; ">
          </div>
          
          <div class="col-md-8">
            <h1 class="display-5 fw-bold"><?php echo $movie['judul'];?></h1>
            
            <div class="mb-3">
              <span class="badge bg-danger fs-6 me-2"><?php echo $movie['genre']; ?></span>
            </div>

            <h4 class="mt-4">Sinopsis</h4>
            <p class="lead text-muted">
                <?php echo $movie['sinopsis']?>
            </p>

            <ul class="list-unstyled mt-4">
              <li><strong>Sutradara:</strong> <?php echo $movie['sutradara']; ?></li>
            </ul>

            <a href="../controller/add_bookmark.php?id=<?php echo $movie['id']; ?>" class="btn btn-danger btn-lg mt-3 shadow">
              <i class="bi bi-bookmark-plus-fill"></i> Tambah ke Bookmark
            </a>
          </div>
        </div>
      </header>

      <hr class="my-5">

      <section id="reviews">
        <h2 class="fw-bold mb-4">Review Pengguna</h2>

        <div class="card bg-light border-0 shadow-sm p-4 mb-5">
          <h5 class="mb-3"><i class="bi bi-pencil-square text-danger me-2"></i> Tulis Review Anda</h5>
          <form action="../controller/tambah_review.php" method="POST">
            <div class="mb-3">
              <label for="reviewText" class="form-label">Komentar Anda</label>
              <textarea class="form-control" name="review" id="reviewText" rows="4" placeholder="Apa pendapat Anda tentang film ini?"></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $movie['id']; ?>"> 
            <button type="submit" class="btn btn-danger shadow">
              <i class="bi bi-send-fill"></i> Kirim Review
            </button>
          </form>
        </div>

        <h4 class="mb-3">Semua Review (<?php echo count($reviews); ?>)</h4>
        <div class="list-group">
          <?php foreach ($reviews as $review): ?>
            <div class="list-group-item list-group-item-action flex-column align-items-start mb-3 border rounded shadow-sm p-4">
              <div class="d-flex w-100 justify-content-between mb-2">
                <h5 class="mb-1 fw-bold"><?php echo $review['name']; ?></h5>
              </div>
              <p class="mb-1">
                <?php echo $review['konten']; ?>
              </p>
              <small class="text-muted">Diposting pada <?php echo date('d F Y', strtotime($review['created_at'])); ?></small>
            </div>
          <?php endforeach; ?>  
        </div>
      </section>

    </div>
  </main>

  <footer class="py-4 bg-dark text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; 2025 Movie BookMark. Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> oleh Saya.</small>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>