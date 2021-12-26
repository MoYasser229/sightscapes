<?php
$conn=new mysqli("localhost","root","","project");
echo "<form method='post' action=''>
sort:<br>
descending: <input type='checkbox' value = 'DESC' name = 'sortArrange'><br>
ascending: <input type='checkbox' value = 'ASC' name = 'sortArrange'><br>
by:<br>
ID <input type='checkbox' value = 'hikerID' name = sort><br>
First Name <input type='checkbox' value = 'fname' name = sort><br>
Last Name <input type='checkbox' value = 'lname' name = 'sort'><br>
Email <input type='checkbox' value = 'email' name = 'sort'><br>
<input type='submit' name='submit'>
</form>";
$orderby = "hikerID";
$sort = "ASC";
if(isset($_POST['submit']))
if(isset($_POST['sortArrange']))
if($_POST['sortArrange'] === "DESC")
$sort = "DESC";
if(isset($_POST['sort']))
if($_POST['sort'] === 'fname' || $_POST['sort'] === 'lname' || $_POST['sort'] === 'email')
$orderby = $_POST['sort'];
$sql="SELECT * FROM Hikers ORDER BY $orderby $sort";
$result=$conn->query($sql) or die($conn->error);

echo "<table border = '1'><tr><th>Hiker ID</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Password</th></tr>";
while($row=$result->fetch_assoc()){
echo "<tr><td>" .$row['hikerID']. "</td><td>" .$row['fname']. "</td><td>" .$row['lname'] . "</td><td>" .$row['email'] . "</td><td>" .$row['pswrd'] . "</td></tr>";
}
echo "</table>";
?>