<?php
include "connect.php";

// Get the ID of the cart item to delete
$id_cart = $_POST['id_cart'];

// Prepare the SQL statement to delete the item
$sql = "DELETE FROM cart WHERE id_cart = ?";

$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id_cart);

if ($stmt->execute()) {
    echo "Item deleted successfully";
} else {
    echo "Error deleting item: " . $connect->error;
}

$stmt->close();
$connect->close();
?>
