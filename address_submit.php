<?php
session_start();
include 'connect.php'; // Sesuaikan dengan nama file yang sesuai dengan koneksi database Anda
// Memeriksa apakah semua data form telah disediakan
if (!isset($_POST['nama'], $_POST['phone'], $_POST['alamat'], $_SESSION['id_users'], $_POST['id_order'])) {
    die("Semua field wajib diisi dan setidaknya satu item harus dipilih.");
}

// Mendapatkan data dari form
$nama = $_POST['nama'];
$phone = $_POST['phone'];
$alamat = $_POST['alamat'];
$id_users = $_SESSION['id_users'];
$id_order_list = $_POST['id_order']; // Mendapatkan array id_order

// Gabungkan semua id_order menjadi satu string dipisahkan koma
$id_order_string = implode(',', $id_order_list);

// Loop melalui setiap id_order untuk memperbarui tabel pembelian
foreach ($id_order_list as $id_order) {
    // Update data di tabel pembelian
    $sql_update = "UPDATE pembelian SET alamat = ? WHERE id_pembeli = ? AND id_order = ?";
    $stmt_update = $connect->prepare($sql_update);
    $stmt_update->bind_param("sii", $alamat, $id_users, $id_order);

    if ($stmt_update->execute()) {
        echo "Data updated successfully in pembelian table for id_order: $id_order.<br>";
    } else {
        echo "Error: " . $stmt_update->error . "<br>";
    }

    // Menutup statement update
    $stmt_update->close();
}

// Nilai lainnya yang akan diinsert ke tabel pengiriman
$harga = 0; // Gantilah sesuai kebutuhan
$status_pembayaran = 0; // Gantilah sesuai kebutuhan
$status_pesanan = 0; // Gantilah sesuai kebutuhan
$metode_pengiriman = 0; // Gantilah sesuai kebutuhan

// Insert data ke tabel pengiriman sekali saja
$sql_insert = "INSERT INTO pembayaran (nama, phone, alamat, id_pembeli, id_order, harga, status_pembayaran, status_pesanan, metode_pengiriman) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $connect->prepare($sql_insert);
$stmt_insert->bind_param("sisisiiii", $nama, $phone, $alamat, $id_users, $id_order_string, $harga, $status_pembayaran, $status_pesanan, $metode_pengiriman);

if ($stmt_insert->execute()) {
    header('Location: pesanan.php?address_success=1');
            exit;

} else {
    echo "Error: " . $stmt_insert->error . "<br>";
}

// Menutup statement insert dan koneksi
$stmt_insert->close();
$connect->close();
?>
