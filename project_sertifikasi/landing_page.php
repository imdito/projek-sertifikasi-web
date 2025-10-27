<?php

    session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<style>
    /* Sedikit kustomisasi untuk menonjolkan tema */
    .hero-section {
      padding: 100px 0;
      background-color: #f8f9fa; /* Latar belakang abu-abu muda agar merah menonjol */
    }
    .section-padding {
      padding: 80px 0;
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
                        <a class="nav-link active" aria-current="page" href="user/view/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user/view/bookmark_page.php">Bookmark</a>
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
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
                            <a class="nav-link" href="auth/controller/logout.php">Logout</a>
                        <?php }else{ ?>
                            <a class="nav-link" href="auth/view/login_view.php">Login</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
    <div class="container text-center">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="display-4 fw-bold text-danger">Jangan Kehilangan Jejak Film Anda</h1>
          <p class="lead my-4 text-muted">
            Selamat datang di MovieMark. Tempat terbaik untuk mengelola, melacak, dan mem-bookmark semua film yang ingin Anda tonton. Buat daftar tontonan pribadi Anda hari ini.
          </p>
          <a href="user/view/bookmark_page.php" class="btn btn-danger btn-lg shadow">
            <i class="bi bi-plus-circle-fill"></i> Mulai Bookmark Sekarang
          </a>
        </div>
      </div>
    </div>
  </header>

  <section id="fitur" class="section-padding">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold">Fitur Utama</h2>
        <p class="text-muted">Semua yang Anda butuhkan untuk mengatur koleksi film Anda.</p>
      </div>
      
      <div class="row text-center g-4">
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-danger-subtle">
            <div class="card-body p-4">
              <i class="bi bi-bookmark-plus-fill fs-1 text-danger"></i>
              <h4 class="card-title my-3">Bookmark Sekali Klik</h4>
              <p class="card-text">Simpan film apa pun ke daftar Anda dengan mudah. Tidak akan ada lagi film yang terlupakan.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-danger-subtle">
            <div class="card-body p-4">
              <i class="bi bi-search-heart fs-1 text-danger"></i>
              <h4 class="card-title my-3">Pencarian Cepat</h4>
              <p class="card-text">Temukan film dari database kami yang luas. Cari berdasarkan judul, genre, atau tahun rilis.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-danger-subtle">
            <div class="card-body p-4">
              <i class="bi bi-list-check fs-1 text-danger"></i>
              <h4 class="card-title my-3">Kelola Daftar Tontonan</h4>
              <p class="card-text">Buat koleksi kustom, tandai film yang sudah ditonton, dan urutkan daftar Anda sesuka hati.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="tentang" class="section-padding bg-danger text-white">
    <div class="container text-center">
      <h2 class="display-6 fw-light mb-4">Siap Membangun Perpustakaan Film Digital Anda?</h2>
      <p class="lead mb-4">Bergabunglah dengan ribuan pecinta film lainnya. Daftar gratis dan mulailah mengoleksi film favorit Anda hari ini.</p>
      <a href="auth/view/register_view.php" class="btn btn-light btn-lg text-danger fw-bold shadow">
        <i class="bi bi-box-arrow-in-right"></i> Daftar Gratis
      </a>
    </div>
  </section>

  <footer class="py-4 bg-dark text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; 2025 MovieMark. Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> oleh Anda.</small>
    </div>
  </footer>                        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>