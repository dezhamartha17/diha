<?php
session_start();
include 'config.php'; // Pastikan file ini termasuk koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan sanitasi input untuk menghindari SQL Injection
    $username = $connect->real_escape_string($username);

    // Lakukan query menggunakan prepared statements untuk keamanan
    $stmt = $connect->prepare("SELECT id_users, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_users, $hashed_password);
        $stmt->fetch();
        
        // Verifikasi password
if (password_verify($password, $hashed_password)) {
    // Simpan id_users dan username ke sesi
    $_SESSION['id_users'] = $id_users;
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("Location: dashboard.php");
    exit();
} else {
    // Password tidak cocok
    echo "Password yang dimasukkan: " . $password . "<br>";
    echo "Password di database: " . $hashed_password . "<br>";
    // header("Location: login.php?pesan=Password tidak cocok");
    exit();
}
    } else {
        // User tidak ditemukan
        header("Location: login.php?pesan=user tidak ditemukan");
        exit();
    }

    $stmt->close();
}

$connect->close();
?>
