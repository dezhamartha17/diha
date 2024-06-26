<?php
include "connect.php";
// Simpan produk ke dalam database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['productId']) && isset($_POST['quantity'])) {
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];
        $dummyUserId = 0; // ID user dummy, sesuaikan dengan kebutuhan Anda

        // Query untuk menyimpan data ke database
        $sql = "INSERT INTO cart (id_product, jumlah, status_cart) VALUES ('$productId', '$quantity', '$dummyUserId')";

        if ($connect->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $connect->error]);
        }

        $connect->close();
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing productId or quantity']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}
?>
