<table>
<table border =1>
<tr> <th> Name </th> <th> GID </th> <th> Price </th> <th> Rating </th> <th> DepartureTime </th> <th> ArrivalTime </th> <th> Description </th> </tr>


<?php
$hn='localhost';
$db='project';
$un='root';
$pw='';
//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db");//conn=object men el database , connection to database


if($conn->connect_error) 
	die ("fatal error cannot connect to DB");
else
//echo "connected successfully to DB";



$query="select * from grptable "; //preperation for query


$result=$conn->query($query); //executes query 3ala el database w returns result
if(!$result) die ("fatal error in executing code");

while($row= $result->fetch_array(MYSQLI_ASSOC)){
	if($row['avgrating']==null){
		$row['avgrating'] = "No customer reviews";
	}
	echo "<tr> <td> ".$row['Name']."</td>";
	echo "<td> ".$row['GID']."</td>";
	echo "<td> ".$row['Price']."</td>";
	echo "<td> ".$row['avgrating']."</td>";
	echo "<td> ".$row['DepartureTime']."</td>";
	echo "<td> ".$row['ArrivalTime']."</td>";
	echo "<td> ".$row['Description']."</td>";
	echo "</tr>";
}
?>
</table>


<form action ='' method ='post'>
 <?php
$conn=new mysqli("localhost","$un","$pw","$db");//conn=object men el database , connection to database
if($conn->connect_error) 
	die ("fatal error cannot connect to DB");
else
//echo "connected successfully to DB";
$query="select * from grptable"; //preperation for query
$result=$conn->query($query); //executes query 3ala el database w returns result
if(!$result) die ("fatal error in executing code");
while($row= $result->fetch_array(MYSQLI_ASSOC))
{
?>
<input type="radio" name="groups" value='<?php echo $row['Name']?>'><?php echo $row['Name'];}?>

 <input type="submit" value="Submit" name="Submit">
</form>
