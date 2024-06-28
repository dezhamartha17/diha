<?php
session_start();
include 'connect.php'; // pastikan untuk menghubungkan ke database Anda
// Ambil data yang dikirimkan melalui AJAX
$id_order = $_POST['id_order'];
$status_pesanan = 2;

// Lakukan sanitasi data jika diperlukan
$id_order = filter_var($id_order, FILTER_SANITIZE_NUMBER_INT);
$status_pesanan = filter_var($status_pesanan, FILTER_SANITIZE_NUMBER_INT);

// Lakukan koneksi ke database (sesuaikan dengan konfigurasi Anda)

// Periksa koneksi
if ($connect->connect_error) {
    die("Koneksi Gagal: " . $connect->connect_error);
}

// Query UPDATE untuk mengubah status pesanan
$sql = "UPDATE pembelian SET status_pesanan = ? WHERE id_order = ?";

// Persiapkan statement
$stmt = $connect->prepare($sql);

// Bind parameter dan eksekusi statement
if ($stmt) {
    $stmt->bind_param("ii", $status_pesanan, $id_order);
    $stmt->execute();

    // Periksa apakah query berhasil dijalankan
    if ($stmt->affected_rows > 0) {
        header('Location: admin_pesanan.php?success=1');
        exit;
    } else {
        echo "Gagal memperbarui status pesanan.";
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "Terjadi kesalahan dalam persiapan statement SQL.";
}

// Tutup koneksi ke database
$connect->close();
?>