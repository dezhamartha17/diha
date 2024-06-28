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
    $sql_update = "UPDATE pembelian SET alamat = ? , nama_pembeli = ?, phone = ? WHERE id_pembeli = ? AND id_order = ?";
    $stmt_update = $connect->prepare($sql_update);
    $stmt_update->bind_param("sssii", $alamat, $nama, $phone, $id_users, $id_order);

    if ($stmt_update->execute()) {
        header('Location: pesanan.php?address_success=1');
            exit;
    } else {
        echo "Error: " . $stmt_update->error . "<br>";
    }

    // Menutup statement update
    $stmt_update->close();
}
$connect->close();
?>
