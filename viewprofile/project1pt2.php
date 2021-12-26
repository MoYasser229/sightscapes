<html>
<body>
<table border =1>
<tr> <th> pswrd</th>  </tr>

<?php
$hn='localhost';
$db='project';
$un='root';
$pw='';
session_start();
$id=$_SESSION["ID"];
//role
$role = $_SESSION["Role"];
//role id
$roleid = substr($role,0,strlen($role)-1) . "ID";
//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");


$sql = "SELECT * FROM $role WHERE $roleid = $id";

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
