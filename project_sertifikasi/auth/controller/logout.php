<?php

    session_start();
    // Hapus semua data sesi
    $_SESSION = array();
    session_destroy();

    // Redirect ke halaman login setelah logout
    header("Location: ../view/login_view.php");
    exit;


?>