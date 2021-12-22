<table>
<table border =1>
<tr> <th> name </th> <th> Email </th>  <th> ID </th> </tr>

<?php
$hn='localhost';
$db='projectF';
$un='root';
$pw='';
session_start();

//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db");//conn=object men el database , connection to database
if($conn->connect_error) 
	die ("fatal error cannot connect to DB");
else
//echo "connected successfully to DB";

$query="select Name, Email,ID from trial1 where ID = 4 "; //preperation for query

$result=$conn->query($query); //executes query 3ala el database w returns result
if(!$result) die ("fatal error in executing code");
	$row= $result->fetch_array(MYSQLI_ASSOC);
echo "<tr> <td> Name is  ".$row['Name']."</td>";
echo "<td> Email is ".$row['Email']."</td>";
echo "<td> ID is ".$row['ID']."</td>";
echo "</tr>";
?>
</table>
<?php
$_SESSION["Name"]=$row['Name'];
	$_SESSION["Email"]=$row['Email'];

?>
<form action ='Editinfo.php' method ='post'>
 <button type="submit"> Edit </button>
