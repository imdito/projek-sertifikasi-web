<?php
    // Memulai session
    session_start();

    // Jika pengguna sudah login, redirect ke index.php
    if($_SESSION['logged_in'] == true && $_SESSION['user_role'] == 'admin'){
        header("Location:../../admin/view/index.php");
        exit;
    }
    if($_SESSION['logged_in'] == true && $_SESSION['user_role'] == 'user'){
        header("Location:../../user/view/index.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Manajemen Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
          background-color: #f8f8f8;
      }
      .login-container {
          min-height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
      }
      .login-form-card {
          background-color: #fff;
          padding: 30px;
          border-radius: 8px;
          box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); /* Sedikit bayangan halus */
          width: 100%;
          max-width: 380px; /* Ukuran yang mirip dengan gambar */
      }
      .form-control-custom {
          border: 1px solid #ced4da;
          border-radius: 5px; /* Rounded corners */
          padding: 12px 15px;
          font-size: 1rem;
          height: auto; /* Agar padding bekerja */
          box-shadow: none; /* Hilangkan shadow default focus */
      }
      .form-control-custom:focus {
          border-color: #888; /* Border sedikit gelap saat focus */
          box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, 0.1); /* Shadow lebih halus */
      }
      .btn-red {
          background-color: #c1424dff; /* Warna ungu */
          border-color: #c1424dff;
          color: white;
          padding: 12px 0;
          font-size: 1rem;
          font-weight: bold;
      }
      .btn-purple:hover {
          background-color: #5a359b;
          border-color: #5a359b;
          color: white;
      }
      .text-center.login-title {
          font-weight: 900; /* Extra bold */
          font-size: 2.2rem; /* Ukuran font lebih besar */
          margin-bottom: 30px; /* Jarak bawah */
          color: #333;
      }
      .forgot-password {
          font-size: 0.9rem;
      }
      .remember-me {
          font-size: 0.9rem;
      }
    </style>
  </head>
  <body>

    <div class="login-container">
        <div class="login-form-card">
            
            <h2 class="text-center login-title mb-5">LOGIN</h2>

            <?php 
            // Menampilkan pesan error jika ada
            if(isset($_GET['error'])){
                echo '<div class="alert alert-danger" role="alert">Username atau password salah!</div>';
            }
            // Menampilkan pesan sukses registrasi
            if(isset($_GET['success'])){
                echo '<div class="alert alert-success" role="alert">Registrasi berhasil! Silakan login.</div>';
            }
            ?>

            <form action="../controller/login.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control form-control-custom" id="username" placeholder="Username" name="username" required>
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control form-control-custom" id="password" placeholder="Password" name="password" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="rememberMe" name="rememberMe">
                        <label class="form-check-label remember-me" for="rememberMe">
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-red">LOGIN</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <span class="text-muted">Tidak Punya Akun?</span> 
                <a href="register_view.php" class="text-decoration-none" style="color: #c1424dff; font-weight: bold;">Register</a>
            </div>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>