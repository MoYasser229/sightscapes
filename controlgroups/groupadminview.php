<form method="post" action="">
            sort:<br>
            descending: <input type="checkbox" value = "DESC" name = "sortArrange"><br>
            ascending: <input type="checkbox" value = "ASC" name = "sortArrange"><br>
            by:<br>
            id <input type="checkbox" value = "GID" name = "sort"><br>
			Price <input type="checkbox" value = "price" name = "sort"><br>
            location <input type="checkbox" value = "loc" name = "sort"><br>
            departure time <input type="checkbox" value = "departureTime" name = "sort"><br>
            arrival time <input type="checkbox" value = "arrivalTime" name = "sort"><br>
            rating <input type="checkbox" value = "rating" name = "sort"><br>
			<input type="submit" name="submit">
        </form>
        <?php
            $orderby = "GID";
            $sort = "ASC";
            if(isset($_POST['submit']))
                if(isset($_POST['sortArrange']))
                    if($_POST['sortArrange'] === "DESC")
                        $sort = "DESC";
                if(isset($_POST['sort']))
                    if($_POST['sort'] === 'loc' || $_POST['sort'] === 'departureTime' || $_POST['sort'] === 'arrivalTime' || $_POST['sort'] === 'price' || $_POST['sort'] === 'rating')
                        $orderby = $_POST['sort'];

        ?>

<table>
<table border =1>
<tr> <th> GID </th> <th> price </th> <th> rating </th> <th> Loc </th> <th> departureTime </th> <th> arrivalTime </th> <th> descrip </th> 
<th> pic </th></tr>

<?php
$hn='localhost';
$db='project';
$un='root';
$pw='';
//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db") or die("ERROR");



$query="SELECT * from Groups ORDER BY $orderby $sort"; //preperation for query


$result=$conn->query($query); //executes query 3ala el database w returns result
if(!$result) die ("fatal error in executing code");

while($row= $result->fetch_array(MYSQLI_ASSOC)){
    if($row['avgrating']==null){
		$row['avgrating'] = "No customer reviews";
	}
    echo "<td> ".$row['GID']."</td>";
    echo "<td> ".$row['price']."</td>";
    echo "<td> ".$row['avgrating']."</td>";
    echo "<td> ".$row['Loc']."</td>";
    echo "<td> ".$row['departureTime']."</td>";
    echo "<td> ".$row['arrivalTime']."</td>";
    echo "<td> ".$row['descrip']."</td>";
    echo "<td> ".$row['pic']."</td>";
    echo "</tr>";
}
?>
 </table>
<form action ='groupadmin.php' method ='post'>


<?php
$conn=new mysqli("localhost","$un","$pw","$db");//conn=object men el database , connection to database
if($conn->connect_error) 
	die ("fatal error cannot connect to DB");
else
//echo "connected successfully to DB";
$query="select * from Groups"; //preperation for query
$result=$conn->query($query); //executes query 3ala el database w returns result
if(!$result) die ("fatal error in executing code");
while($row= $result->fetch_array(MYSQLI_ASSOC))
{
?>
<input type="radio" name="groups" value='<?php echo $row['GID']?>'><?php echo $row['GID'];}?>

 <input type="submit" value="Submit" name="Submit">
</form>

<form action ='addgroup.php' method ='post'>
 <button type="submit"> Add Table</button>
</form>

