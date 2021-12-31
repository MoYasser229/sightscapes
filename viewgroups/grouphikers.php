<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "project";
	$conn = mysqli_connect($servername, $username, $password, $db);

	echo "<form method='post' action=''>
			sort:<br>
			descending: <input type='radio' value = 'DESC' name = 'sortArrange'><br>
			ascending: <input type='radio' value = 'ASC' name = 'sortArrange'><br>
			by:<br>
			ID <input type='checkbox' value = 'GID' name = sort><br>
			Price <input type='checkbox' value = 'Price' name = sort><br>
			rating <input type='checkbox' value = 'rating' name = 'sort'><br>
			departure Time <input type='checkbox' value = 'departureTime' name = 'sort'><br>
			arrival Time <input type='checkbox' value = 'arrivalTime' name = 'sort'><br>
			Location <input type='checkbox' value = 'loc' name = 'sort'><br>
			Search <select name='searchlist' id='searchlist'>
			<option value='all' selected>All</option>
			<option value='GID' >Group ID</option>
			<option value='price' >Price</option>
			<option value='avgrating' >Rating</option>
			<option value='departureTime' >Departure Date</option>
			<option value='arrivalTime' >Arrival Date</option>
			<option value='descrip' >Description</option>
			<option value='Loc' >Location</option>
			</select>
			<input name = 'search' id='search'>
			<input type='submit' name='sortCheck'>
			</form>";
?>
	<script>
		var select=document.getElementById('searchlist');
		var type=document.getElementById('search')
		select.addEventListener('change', () => {
		if((event.target.value=='departureTime')||(event.target.value=='arrivalTime'))
		document.getElementById("search").type='date';
		else
		document.getElementById("search").type='text';
		})
	</script>
<?php
	$orderby = "GID";
	$sort = "ASC";
	$narrowedsearch='';
    $txtsr='';
	if(isset($_POST['sortCheck'])){
		if(isset($_POST['sortArrange']))
			if($_POST['sortArrange'] === "DESC")
				$sort = "DESC";
		if(isset($_POST['sort']))
			if($_POST['sort'] === 'Price' || $_POST['sort'] === 'rating' || $_POST['sort'] === 'departureTime' || $_POST['sort'] === 'arrivalTime' || $_POST['sort'] === 'loc')
				$orderby = $_POST['sort'];
		if(isset($_POST['search'])){
			if($_POST['searchlist']!='all'){
				$narrowedsearch=$_POST['searchlist'];
			}
			$txtsr=$_POST['search'];
		}
	}

	if($txtsr=="")
    	$query="SELECT * from Groups ORDER BY $orderby $sort"; 
	else if($txtsr!=""&&($_POST['searchlist']=='all'))
		$query = "SELECT * from Groups WHERE concat(GID,price,avgrating,Loc,departureTime,arrivalTime,descrip)
		LIKE '%$txtsr%' ORDER BY $orderby $sort;";
	else if($txtsr!=""&&$narrowedsearch!="")
		$query = "SELECT * from Groups WHERE $narrowedsearch='$txtsr'
		ORDER BY $orderby $sort;";

	$result=$conn->query($query) or die ($conn->error);

	if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
    	echo "There are no results <br> Try searching again";
	else{
		echo "<table border =1><tr><th> Group ID </th><th> Price </th><th> Rating 
		</th><th> Departure Date </th><th> Arrival Date 
		</th><th> Description </th><th> Location </th><th> Picture </th></tr>";
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
			echo "<td> ".$row['pic']."</td>";
			echo "</tr>";
		}
	}
?>
</table>
<form action ='' method ='post'>
<?php
	include_once '../../project/cart/insertCart.php';

	$query="SELECT * FROM Groups"; 
	$result=$conn->query($query) or die ("fatal error in executing code");
	while($row= $result->fetch_array(MYSQLI_ASSOC))
	{
?>
	<input type="radio" name="groups" value='<?php echo $row['GID']?>'><?php echo $row['Loc'];}?>
	<input type="submit" value="Submit" name="Submit">
</form>
<?php
	
	if(isset($_POST['Submit'])&&(isset($_POST['groups']))){
		$groups = $_POST['groups'];
		
		$sql = "SELECT * FROM groups WHERE GID = '$groups'";
		$result = $conn->query($sql);
		$found = false;
		if($row = $result->fetch_assoc()) {
			if(isset($_COOKIE['GroupsCart'])){
				$cartItems = stripslashes($_COOKIE['GroupsCart']);
        		$cart = json_decode($cartItems, true);
				foreach($cart as $cartItem){
					if($cartItem['ID'] == $groups && $cartItem['hikerID'] == $_SESSION['ID']){
						$found = true;
						break;
					}
				}
			}
			else{
				$cart = array();
			}
			if($found === false){
				$location = $row['Loc'];
				$price = $row['price'];
				$item = array(
					'ID' => $groups,
					'hikerID' => $_SESSION['ID'],
					'location' => $location,
					'price' => $price,
				);
				$cart[] = $item;
				$jsonString = json_encode($cart);
				insert($_SESSION['ID'],$jsonString);
			}
			else{
				//header("Location: grouphikers.php");
				echo "<script>alert('Item is already in Cart')</script>";
			}
		}
		
	}
?>
