<?php
session_start();
$userID = 0;
if(isset($_SESSION['ID']))
  $userID = $_SESSION['ID'];
$id = $_POST['GID'];
$conn = new mysqli("localhost","root","","project");
if($userID === 0){
    echo "error";
  }
  else{
    $rating=$_POST['rating'];
    $sql="INSERT INTO reviews(GID,userID,rating) VALUES ((SELECT GID FROM groups WHERE GID='$id'),
    (SELECT userID FROM Users WHERE userID='$userID'),'$rating')";
    $result=mysqli_query($conn,$sql) or die($conn->error);
    $sql1="SELECT AVG(rating) FROM reviews WHERE GID='$id'"; 
    $result=mysqli_query($conn,$sql1) or die($conn->error);
    $row= implode($result->fetch_array(MYSQLI_ASSOC));
    $sql2="UPDATE groups SET avgrating='$row' WHERE  GID='$id'";
    $result=mysqli_query($conn,$sql2) or die($conn->error);
  }

  ?>