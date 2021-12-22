<table>
<table border =1>
<tr> <th> Mobile </th> <th> password </th>  </tr>

<?php
//session
$hn='localhost';
$db='projectF';
$un='root';
$pw='';
session_start();

//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db");//conn=object men el database , connection to database


if($conn->connect_error) 
	die ("fatal error cannot connect to DB");

//echo "connected successfully to DB";



$query="select Mobile, password from trial1 where ID = 4"; //preperation for query

$result=$conn->query($query); //executes query 3ala el database w returns result
if(!$result) die ("fatal error in executing code");

$row= $result->fetch_array(MYSQLI_ASSOC);
echo "<tr> <td> Mobile is  ".$row['Mobile']."</td>";
echo "<td> password is ".$row['password']."</td>";

echo "</tr>";

?>
</table>
<?php
$_SESSION["password"]=$row["password"];
	$_SESSION["Mobile"]=$row["Mobile"];
?>

 <form action ='Editinfopt2.php' method ='post'>
 <button type="submit"> Edit </button>
