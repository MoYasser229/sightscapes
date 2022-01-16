<?php 
session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler('loginError',E_ALL);
?>
<html>
<body>
<table border =1>
<tr> <th> pswrd</th>  </tr>

<?php
$hn='localhost';
$db='project';
$un='root';
$pw='';
$id=$_SESSION["ID"];
//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");


$sql = "SELECT * FROM users WHERE userID = $id";

 //preperation for query
$result=$conn->query($sql); //executes query 3ala el database w returns result
if(!$result) die ("fatal error in executing code");
	$row= $result->fetch_array(MYSQLI_ASSOC);
echo "<tr> <td> ".$row['pswrd']."</td>";
echo "</tr>";



?>
</table>
<form action ='Editinfopt2.php' method ='post'>
 <button type="submit"> Edit </button>
</form>
</body>
</html>
