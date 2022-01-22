<?php
session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler('customError',E_ALL);
$userID = 0;
if(isset($_SESSION['ID']))
  $userID = $_SESSION['ID'];
$id = $_POST['GID'];
$conn = new mysqli("localhost","root","","project");
$select = "SELECT * FROM reviews WHERE GID = $id and userID = $userID and reviewText = ''";
$selectResult = $conn->query($select);
  if($userID === 0){
    echo "error";
  }
  else if($selectRow = $selectResult->fetch_assoc()) {
    echo "errorAlreadyAdded";
  }
  else{
    $rating=$_POST['rating'];
    $sql="INSERT INTO reviews(GID,userID,rating,reviewText) VALUES ((SELECT GID FROM groups WHERE GID='$id'),
    (SELECT userID FROM Users WHERE userID='$userID'),'$rating','')";
    $result=mysqli_query($conn,$sql) or die($conn->error);
    $sql1="SELECT AVG(rating) FROM reviews WHERE GID='$id'"; 
    $result=mysqli_query($conn,$sql1) or die($conn->error);
    $row= implode($result->fetch_array(MYSQLI_ASSOC));
    $sql2="UPDATE groups SET avgrating='$row' WHERE  GID='$id'";
    $result=mysqli_query($conn,$sql2) or die($conn->error);
  }

  ?>