<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
	session_start();
	$orderby = "GID";
	$sort = "ASC";
	$narrowedsearch='';
    $txtsr='';
    $conn = new mysqli("localhost","root","","project");
	if(isset($_POST['order'])){
		if(isset($_POST['order']))
			if($_POST['order'] === "DESC")
				$sort = "DESC";
		if(isset($_POST['filter']))
			if($_POST['filter'] === 'Price' || $_POST['filter'] === 'rating' || $_POST['filter'] === 'departureTime' || $_POST['filter'] === 'arrivalTime' || $_POST['filter'] === 'loc')
				$orderby = $_POST['filter'];
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
    $query = "SELECT * FROM Groups WHERE concat(Loc,GID,price,departureTime,arrivalTime,descrip) LIKE '%$txtsr%'
    ORDER BY $orderby $sort;";
	else if($txtsr!=""&&$narrowedsearch!="")
		$query = "SELECT * from Groups WHERE $narrowedsearch='$txtsr'
		ORDER BY $orderby $sort;";

	$result=$conn->query($query) or die ($conn->error);

	if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
    	echo "There are no results <br> Try searching again";
	else{
		echo "<style>
		.viewGroups{
			background-color: #071a20;
			color: white;
		}
		.viewGroups a{
			color: white;
			font-size: 20px;
			padding: 10px;
			display: flex;
			justify-content: center;
			background-color: #173f53;
		}
		.viewGroups a:hover{
			text-decoration: none;
			background-color: #4c6b6e;
		}
		.ViewGroups h1{
			font-size: 50px;
			margin-bottom: 100px;
			text-align: center;
		}
		.grid-container{
			display: grid;
			grid-template-columns: auto auto;
			grid-gap: 100px;
			place-items: center;
		}
		.item{
			width: 500px;
			background-color: #071a20;
			box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.5);
		}
		.rating{
			margin-left: 10px;
			margin-top: -60px;
			line-height: 1px;
		}
		@media only screen and (min-width: 1900px) {
			.grid-container{
				grid-template-columns: auto auto auto;
			}
		}
		</style>
		
		<div class= 'viewGroups'>
		<h1>GROUPS</h1>
		<div class = 'grid-container' >";
		$selectGroups = "SELECT GID FROM orders WHERE userID = {$_SESSION['ID']}";
		$groupsBought = $conn->query($selectGroups);
		$groupsArray = [];
		while($group = $groupsBought->fetch_assoc()){
			array_push($groupsArray,$group['GID']);
		}
		$bought = false;
			while($row= $result->fetch_array(MYSQLI_ASSOC)){
				if($row['avgrating']==0){
					$row['avgrating'] = "NO CUSTOMER REVIEWS";
				}
				foreach($groupsArray as $group){
					if($group === $row['GID']){
						$bought = true;
						break;
					}
				}
				//<img src='../controlgroups/images/
				if($bought === false){
					echo "<div class = 'item'>";
					echo "<a href='groupPage.php?GID={$row['GID']}'></a>".$row['pic']."' width= 500px height= 400px>";
					echo "<p class='rating'> ".$row['avgrating']."</p>";
					echo "<h2> <span style='margin-left: 10px; font-size: 12px'>LOCATION:</span>&nbsp".$row['loc']."</h2>";
					echo "<p><span style='margin-left: 130px;font-size: 30px'>AT ONLY <strong>".$row['price']." EGP</strong></span></p>";
					if(isset($row['diffLevel']))
						echo "<p style='margin-left: 150px;'>DIFFICULTY: <strong>{$row['diffLevel']}</strong></p>";
					else
						echo "<p style='margin-left: 150px;'>DIFFICULTY: NOT SPECIFIED</p>";
					if(!empty($row['distance']))
						echo "<p style='margin-left: 150px;'>DISTANCE: <strong>{$row['distance']} KM</strong></p>";
					else
						echo "<p style='margin-left: 150px;'>DISTANCE: NOT SPECIFIED</p>";
					// if(isset($row['distance']))
					// 	echo "<p style='margin-left: 10px;'>GROUP SIZE: <strong>{$row['distance']} KM</strong></p>";
					// else
					// 	echo "<p style='margin-left: 10px;'>DISTANCE: NOT SPECIFIED</p>";
					echo "<a href = 'groupAddToCart.php?groups={$row['GID']}'>ADD TO CART</a>";
					echo "</div>";
				}
				else{
					$bought = false;
				}
			}
			echo "</div></div>";
		}
		
		
?>


