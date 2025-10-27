<?php
    include_once '../../connection.php';
    

    session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../view/login_view.php');
    exit;
    }

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
    header('Location: ../public/login.php?error=' . urlencode('Username & password wajib diisi'));
    exit;
    }

    try{
        
        // ambil user berdasarkan username
        echo $username;
        $stmt = mysqli_prepare($connection, "SELECT id, name, email, password_hash, role FROM users WHERE name = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $name, $email, $password_hash, $role);
        $found = mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        echo "test2";

    }catch (Error $e){
        echo "Koneksi gagal: " . $e->getMessage();
    }

    if (!$found) {
    // jangan jelaskan lebih detil (keamanan)
    header('Location: ../view/login_view.php?error=' . urlencode('Username atau password tidak ada'));
    exit;
    }

    if (!password_verify($password, $password_hash)) {
    header('Location: ../view/login_view.php?error=' . urlencode('Username atau password salah'));
    exit;
    }

    // login sukses: set session
    session_regenerate_id(true);
    $_SESSION['user_id'] = $id;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_role'] = $role;
    $_SESSION['logged_in'] = true;

    // redirect berdasarkan role
    if ($role === 'admin') {      
    header('Location: ../../admin/view/index.php');
    exit;
    } else {
    header('Location: ../../user/view/index.php');
    exit;
    }


?>