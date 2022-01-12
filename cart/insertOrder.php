<?php
session_start();
$cartItems = stripslashes($_COOKIE['GroupsCart']);
$cart = json_decode($cartItems, true);
$conn = new mysqli("localhost","root","","project");
foreach($cart as $cartItem){
   $GID = $cartItem['ID'];
   $hikerID = $_SESSION['ID'];
   $price = $cartItem['price'];
    $sql = "INSERT INTO orders(GID,userID,orderStatus,totalPrice) VALUES('$GID','$hikerID','paid','$price')";
    $result = $conn->query($sql) or die($conn->error);
}

