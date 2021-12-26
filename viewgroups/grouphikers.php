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
echo "<form method='post' action=''>
sort:<br>
descending: <input type='checkbox' value = 'DESC' name = 'sortArrange'><br>
ascending: <input type='checkbox' value = 'ASC' name = 'sortArrange'><br>
by:<br>
ID <input type='checkbox' value = 'GID' name = sort><br>
Price <input type='checkbox' value = 'Price' name = sort><br>
rating <input type='checkbox' value = 'rating' name = 'sort'><br>
departure Time <input type='checkbox' value = 'departureTime' name = 'sort'><br>
arrival Time <input type='checkbox' value = 'arrivalTime' name = 'sort'><br>
Location <input type='checkbox' value = 'loc' name = 'sort'><br>
<input type='submit' name='sortCheck'>
</form>";
$orderby = "GID";
$sort = "ASC";
if(isset($_POST['sortCheck'])){
	if(isset($_POST['sortArrange']))
		if($_POST['sortArrange'] === "DESC")
			$sort = "DESC";
	if(isset($_POST['sort']))
		if($_POST['sort'] === 'Price' || $_POST['sort'] === 'rating' || $_POST['sort'] === 'departureTime' || $_POST['sort'] === 'arrivalTime' || $_POST['sort'] === 'loc')
			$orderby = $_POST['sort'];
}

$query="SELECT * FROM groups ORDER BY $orderby $sort"; //preperation for query


$result=$conn->query($query) or die ($conn->error);

while($row= $result->fetch_array(MYSQLI_ASSOC)){
	if($row['avgrating']==null){
		$row['avgrating'] = "No customer reviews";
	}
	echo "<td> ".$row['GID']."</td>";
	echo "<td> ".$row['price']."</td>";
	echo "<td> ".$row['avgrating']."</td>";
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
