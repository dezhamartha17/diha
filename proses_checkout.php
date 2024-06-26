<?php
session_start();
include 'connect.php'; // pastikan untuk menghubungkan ke database Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_cart'])) {
        $id_carts = $_POST['id_cart'];

        if (isset($_SESSION['id_users'])) {
            $id_pembeli = $_SESSION['id_users'];
        } else {
            echo "User is not logged in.";
            exit;
        }
        
        $alamat = '0'; // Contoh alamat, sesuaikan dengan data pembeli
        $status_pembayaran = 1; // Contoh status pembayaran, sesuaikan dengan kebutuhan Anda
        $status_pesanan = 1; // Contoh status pesanan, sesuaikan dengan kebutuhan Anda

        try {
            // Mulai transaksi
            $connect->begin_transaction();

            // Hitung total bayar
            $id_cart_list = implode(",", array_map('intval', array_unique($id_carts))); // Menggunakan array_unique untuk menghilangkan duplikasi
            $query = "SELECT SUM(produk.harga_produk * cart.jumlah) AS total FROM cart INNER JOIN produk ON cart.id_product = produk.id_produk WHERE cart.id_cart IN ($id_cart_list)";
            $result = $connect->query($query);

            if (!$result) {
                throw new Exception("Error calculating total: " . $connect->error);
            }

            $row = $result->fetch_assoc();
            $total_bayar = $row['total'];

            if ($total_bayar === null) {
                throw new Exception("Total bayar is null. Query: $query");
            }

            // Insert data ke tabel pembelian
            $stmt = $connect->prepare("INSERT INTO pembelian (id_pembeli, id_cart, total_harga, alamat) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error preparing insert statement: " . $connect->error);
            }

            // Insert hanya satu kali dengan id_cart yang digabungkan
            $stmt->bind_param("isis", $id_pembeli, $id_cart_list, $total_bayar, $alamat);
            if (!$stmt->execute()) {
                throw new Exception("Error executing insert statement: " . $stmt->error);
            }


            // Commit transaksi
            $connect->commit();
            // Redirect dengan parameter checkout_success
            header('Location: cart.php?checkout_success=1');
            exit;
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $connect->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid products data.";
    }
} else {
    echo "Invalid request method.";
}

$connect->close();
?>
