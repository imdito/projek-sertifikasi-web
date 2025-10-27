<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Manajemen Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body { background-color: #f8f8f8; }
      .login-container { min-height: 100vh; display: flex; justify-content: center; align-items: center; }
      .login-form-card { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); width: 100%; max-width: 380px; }
      .form-control-custom { border: 1px solid #ced4da; border-radius: 5px; padding: 12px 15px; font-size: 1rem; height: auto; box-shadow: none; }
      .form-control-custom:focus { border-color: #888; box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, 0.1); }
      .btn-purple { background-color: #c1424dff; border-color: #c1424dff; color: white; padding: 12px 0; font-size: 1rem; font-weight: bold; }
      .btn-purple:hover { background-color: #c1424dff; border-color: #c1424dff; color: white; }
      .text-center.login-title { font-weight: 900; font-size: 2.2rem; margin-bottom: 30px; color: #333; }
    </style>
  </head>
  <body>

    <div class="login-container">
        <div class="login-form-card">
            
            <h2 class="text-center login-title mb-5">REGISTER</h2>

            <?php 
            // Menampilkan pesan error jika ada
            if(isset($_GET['error'])){
                if($_GET['error'] == 'password'){
                    echo '<div class="alert alert-danger" role="alert">Password tidak cocok!</div>';
                } else if($_GET['error'] == 'exists'){
                    echo '<div class="alert alert-danger" role="alert">Username sudah digunakan!</div>';
                }
            }
            ?>

            <form action="../controller/register_controller.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control form-control-custom" id="username" placeholder="Username" name="username" required>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control form-control-custom" id="email" placeholder="Email@youremail.com" name="email" required>
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control form-control-custom" id="password" placeholder="Password" name="password" required>
                </div>

                <div class="mb-4">
                    <input type="password" class="form-control form-control-custom" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-purple">REGISTER</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <span class="text-muted">Already have an account?</span> 
                <a href="login_view.php" class="text-decoration-none" style="color: #c1424dff; font-weight: bold;">Login</a>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>