<table>
<table border=1>
   <tr>
   <th>name</th> 
   <th>course</th>
   </tr>
<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$DB = "users";
		
		$conn =new mysqli($servername, $username, $password, $DB);
		
		if(!$conn)
		{
			die("connection failed: " .mysqli_connect_error());
		}
		echo "connected successfully <br>";
		$query="SELECT name,course from users"; 
		$result=$conn->query($query);
		if(!$result)
			die("fatal error in excuting code");
		
		while($row= $result->fetch_array(MYSQLI_ASSOC))
		{
			echo "<tr> <td>".$row['name']."</td>";
			echo "<td>".$row['course']."</td> </tr>";
		}
		?>
</table>
		