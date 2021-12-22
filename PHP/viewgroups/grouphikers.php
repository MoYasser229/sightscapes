<?php session_start(); ?>
<table>
<table border =1>
<tr> <th> GID </th> <th> PRICE </th> <th> RATING </th> <th> DEPARTURETIME </th> <th> ARRIVALTIME </th> <th> DESCRIPTION </th> <th> LOCATION </th> </tr>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "project";
$conn = mysqli_connect($servername, $username, $password, $db);


// if($conn->connect_error) 
// 	die ("fatal error cannot connect to DB");
// else
// //echo "connected successfully to DB";



$query="SELECT * FROM groups"; //preperation for query


$result=$conn->query($query) or die ("fatal error in executing code");

while($row= $result->fetch_array(MYSQLI_ASSOC)){
echo "<td> ".$row['GID']."</td>";
echo "<td> ".$row['price']."</td>";
echo "<td> ".$row['rating']."</td>";
echo "<td> ".$row['departureTime']."</td>";
echo "<td> ".$row['arrivalTime']."</td>";
echo "<td> ".$row['descrip']."</td>";
echo "<td> ".$row['Loc']."</td>";
echo "</tr>";
}
?>
</table>


<form action ='' method ='post'>
 <?php
 include_once '../../project/cart/insertCart.php';
//echo "connected successfully to DB";
$query="SELECT * FROM groups"; //preperation for query
$result=$conn->query($query) or die ("fatal error in executing code");
while($row= $result->fetch_array(MYSQLI_ASSOC))
{
?>
<input type="radio" name="groups" value='<?php echo $row['GID']?>'><?php echo $row['Loc'];}?>
 <input type="submit" value="Submit" name="Submit">
</form>
<?php
	if(isset($_POST['Submit'])){
		insert($_SESSION['ID'],$_POST['groups']);
	}
?>
