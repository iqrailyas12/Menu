<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}

if (isset($_POST['item_id'])) {
    $itemId = $_POST['item_id'];
  
    $sql = "SELECT price FROM items WHERE id = '$itemId' and DeletedOn is null"; 
    $result = query_exec($sql);
  
  
  
  
    
    if ($row = mysqli_fetch_assoc($result)) {
      $price = $row['price'];
      $responseData = array('price' => $price);
  
      // Set the appropriate response headers
      header('Content-Type: application/json');
  
      // Encode the data as JSON and send the response
      echo json_encode($responseData);
  } else {
      // If item not found, return an error message
      $responseData = array('error' => 'Item not found');
      header('Content-Type: application/json');
      echo json_encode($responseData);
  }
  
  
  
  exit; // Make sure to exit after sending the response
  
  }
?>