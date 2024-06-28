<?php
session_start();
include 'connect.php'; 

$id_users = $_SESSION['id_users'];
$id_order = $_SESSION['id_order'];
$total = $_POST['total_harga'];
$status = 1;
    $sql_update = "UPDATE pembelian SET total_bayar = ?, status_pesanan = ? WHERE id_pembeli = ? AND id_order = ?";
    $stmt_update = $connect->prepare($sql_update);
    $stmt_update->bind_param("iiii", $total, $status, $id_users, $id_order);

    if ($stmt_update->execute()) {
        header('Location: pesanan.php?bayar_success=1');
            exit;
    } else {
        echo "Error: " . $stmt_update->error . "<br>";
    }

    $stmt_update->close();
$connect->close();
?>
