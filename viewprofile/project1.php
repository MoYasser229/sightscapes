<?php 
session_start();
?>
<html>
<body>
<table border =1>
<tr> <th> firstname </th> <th> lastname </th>  <th> Email </th> <th> picture </th> </tr>

<?php
$hn='localhost';
$db='project';
$un='root';
$pw='';

$id=$_SESSION["ID"];
//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");
//role
$role = $_SESSION["Role"];
//role id
$roleid = substr($role,0,strlen($role)-1) . "ID";

$sql = "SELECT * FROM $role WHERE $roleid = $id";
 //preperation for query
$result=$conn->query($sql) or die ("fatal error in executing code");
if($row= $result->fetch_array(MYSQLI_ASSOC)){
echo "<tr> <td> ".$row['fname']."</td>";
echo "<td>  ".$row['lname']."</td>";
echo "<td> ".$row['email']."</td>";
echo "<td>  ".$row['pic']."</td>";
echo "</tr>";
}
?>
</table>
<form action ='Editinfo.php' method ='post'>
 <button type="submit"> Edit </button>
</body>
</html>