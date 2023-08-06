<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}

function getItemPrice($itemId)
{
    
    $sql = "SELECT price FROM items WHERE id = '$itemId' and DeletedOn is null";
    $result = query_exec($sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['price'];
    } else {
        return null; // Item price not found
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $itemId = $_POST['item_id'];
    $price = getItemPrice($itemId);
    if ($price !== null) {
        echo json_encode(['success' => true, 'price' => $price]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Item price not found.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}
