<form action ='' method ='post'>
 Name:<br>
  <input type="text" name="Name"><br> 
  GroupID:<br>
  <input type="text" name="GroupID"><br>
Price:<br>
  <input type="text" name="Price"><br>
  Rating:<br>
  <input type="text" name="Rating"><br>
  DepartureTime:<br>
  <input type="text" name="DepartureTime"><br>
  ArrivalTime:<br>
  <input type="text" name="ArrivalTime"><br>
  Description:<br>
  <input type="text" name="Description"><br>
  <input type="submit" value="Submit" name="Submit">
  <input type="reset">
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
if(isset($_POST['Submit'])){
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql="INSERT INTO grptable (Name,GID,Price,Rating,DepartureTime,ArrivalTime,Description) VALUES ('".$_POST['Name']."','".$_POST['GroupID']."','".$_POST['Price']."','".$_POST['Rating']."','".$_POST['DepartureTime']."','".$_POST['ArrivalTime']."','".$_POST['Description']."')";

if ($conn->query($sql) === TRUE) {
  echo "Group created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
$conn->close();
}
?>
