

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

    <form method = "post" action="">


        <?php

            $conn = new mysqli("localhost" , "root" , "" , "projectF");


            if($conn-> connect_error)
                die("fatal error - cannot connect to the DB");


            $query = "SELECT * FROM grptable WHERE GID=1" ;
            $results = $conn-> query($query);

            if(!$results)
                die("Fatal error in executing the query");


            while($row = $results->fetch_array(MYSQLI_ASSOC)) {
                echo 'Name:<br>';
                echo "<input type = text name=Name value = ".$row["Name"] . "><br>";
                echo 'Price:<br>';
                echo "<input type = text name=Price value = ".$row["Price"] . "><br>";
                 echo 'ArrivalTime:<br>';
                echo "<input type = text name=ArrivalTime value = ".$row["ArrivalTime"] . "><br>";
                 echo 'DepartureTime:<br>';
                echo "<input type = text name=DepartureTime value = ".$row["DepartureTime"] . "><br>";
                 echo 'Description:<br>';
                echo "<input type = text name=Description value = ".$row["Description"] . "><br>";
            }

        ?>

        <input type="submit" name="submit">
        
    <?php
    
      if(isset($_POST["submit"])){
    $query="update grptable set Name=\"".$_POST["Name"]."\",
    Price=\"".$_POST["Price"]."\",
    ArrivalTime=\"".$_POST["ArrivalTime"]."\",
    DepartureTime=\"".$_POST["DepartureTime"]."\",
     Description=\"".$_POST["Description"]."\"
     where GID=1";
    
     $results = $conn-> query($query) or die ($conn->error);
    
     if($results)
    echo "Successfully updated...";
	  }
        ?>


    </form>

</body>
</html>