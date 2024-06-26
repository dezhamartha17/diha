<?php
session_start();
include 'connect.php'; // Sesuaikan dengan nama file yang sesuai dengan koneksi database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form pengiriman
    $id_users = $_SESSION['id_users'];
    $id_pengiriman = $_SESSION['id_pengiriman'];
    $shipping_type = $_POST['shipping_type']; // Nilai dari radio button pengiriman
    $payment_option = $_POST['options'];     // Nilai dari radio button metode pembayaran

    // Query SQL untuk menyimpan data ke dalam tabel pengiriman
    $sql_select = "SELECT id_pengiriman FROM pembayaran WHERE id_pembeli = '$id_users' ORDER BY id_pengiriman DESC LIMIT 1";

    // Eksekusi query untuk mendapatkan id_pembayaran terbaru
    $result = $connect->query($sql_select);

    if ($result->num_rows > 0) {
        // Ambil id_pembayaran terbaru
        $row = $result->fetch_assoc();
        $id_pengiriman = $row['id_pengiriman'];

        // Query SQL untuk melakukan update ke tabel pembayaran
        $sql_update = "UPDATE pembayaran SET status_pembayaran = '$payment_option', metode_pengiriman = '$shipping_type' WHERE id_pengiriman = '$id_pengiriman'";

        if ($connect->query($sql_update) === TRUE) {
            header('Location: pesanan.php?payment_success=1');
            exit;
        } else {
            echo "Error: " . $sql_update . "<br>" . $connect->error;
        }
    } else {
        echo "Tidak ada data pembayaran yang ditemukan untuk id_users ini.<br>";
    }


    // Tutup koneksi ke database
    $connect->close();

}
?>
