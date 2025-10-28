<?php
    include(__DIR__ . '/../../connection.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $confirm_password = $_POST['confirm_password'];
        echo $username;
        echo $password;
        echo $email;
        echo $confirm_password;
        echo "<br>";
        // Cek apakah password dan konfirmasi password cocok
        if($password !== $confirm_password){
            header("Location: ../view/register_view.php?error=password");
            exit();
        }
        
        // Cek apakah email sudah ada
        $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        if($stmt->execute()){
            echo "berhasil";
            $stmt->store_result();
            if($stmt->num_rows > 0){
                // Name sudah digunakan
                header("Location: ../view/register_view.php?error=exists");
                exit();
            }
        } else {
            echo "gagal";
            echo $stmt->error;
        }
 
        
        $stmt->close();


        //cek apakah username sudah ada
        $stmt = $connection->prepare("SELECT id FROM users WHERE name = ?");
        $stmt->bind_param("s", $username);
        if($stmt->execute()){
            echo "berhasil";
            $stmt->store_result();
            if($stmt->num_rows > 0){
                // Name sudah digunakan
                header("Location: ../view/register_view.php?error=exists");
                exit();
            }
        } else {
            echo "gagal";
            echo $stmt->error;
        }

        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        // Simpan user baru ke database
        $sql = "INSERT INTO users (name, password_hash, email) VALUES (?, ?, ?)";
        try{
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("sss", $username, $hashed_password, $email);
            if($stmt->execute()){
                // Registrasi berhasil, redirect ke halaman login
                header("Location: ../view/login_view.php?success=registered");
                exit();
            } else {
                // Terjadi kesalahan saat menyimpan
                echo "Error: " . $stmt->error;
                header("Location: ../view/register_view.php?error=unknown");
                exit();
            }

        }catch (mysqli_sql_exception $e){
            echo "Koneksi gagal: " . $e->getMessage();
        }

        $stmt->close();
        $connection->close();
    } else {
        // Jika bukan POST request, redirect ke halaman register
        header("Location: register_view.php");
        exit();
    }


?>