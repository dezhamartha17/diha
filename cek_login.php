<?php
session_start();
include 'config.php'; // Pastikan file ini termasuk koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan sanitasi input untuk menghindari SQL Injection
    $username = $connect->real_escape_string($username);

    // Lakukan query menggunakan prepared statements untuk keamanan
    $stmt = $connect->prepare("SELECT id_users, password, id_roles FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_users, $hashed_password, $id_roles);
        $stmt->fetch();

        // Verifikasi password
        if (password_verify($password, $hashed_password)) {
            // Simpan id_users, username, dan id_roles ke sesi
            $_SESSION['id_users'] = $id_users;
            $_SESSION['username'] = $username;
            $_SESSION['id_roles'] = $id_roles; // Simpan peran (role) pengguna

            // Redirect berdasarkan peran (role)
            if ($id_roles == 2) {
                // Jika peran (role) adalah admin, arahkan ke halaman admin.php
                header("Location: admin_pesanan.php");
            } else {
                // Jika peran (role) adalah pengguna biasa, arahkan ke halaman dashboard.php
                header("Location: dashboard.php");
            }
            exit();
        } else {
            // Password tidak cocok
            echo "Password yang dimasukkan tidak cocok.";
            exit();
        }
    } else {
        // User tidak ditemukan
        echo "User tidak ditemukan.";
        exit();
    }

    $stmt->close();
}

$connect->close();
?>
