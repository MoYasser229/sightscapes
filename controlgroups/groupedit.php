

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

    <form method = "post" action="">


        <?php

            $conn = new mysqli("localhost" , "root" , "" , "project");


            if($conn-> connect_error)
                die("fatal error - cannot connect to the DB");


            $query = "SELECT * FROM Groups WHERE GID=2" ;
            $results = $conn-> query($query);

            if(!$results)
                die("Fatal error in executing the query");

 while($row = $results->fetch_array(MYSQLI_ASSOC)) {

                
                echo 'price:<br>';
                echo "<input type = text name=price value = ".$row["price"] . "><br>";



                echo 'Location:<br>';
                echo "<input type = text name=Loc value = ".$row["Loc"] . "><br>";

                 echo 'departureTime:<br>';
                echo "<input type = DATE name=departureTime value = ".$row["departureTime"] . "><br>";

                 echo 'arrivalTime:<br>';
                echo "<input type = DATE name=arrivalTime value = ".$row["arrivalTime"] . "><br>";
                

                 echo 'Description:<br>';
                echo "<input type = text name=descrip value = ".$row["descrip"] . "><br>";

                echo 'picture:<br>';
                echo "<input type = text name=pic value = ".$row["pic"] . "><br>";
               
            }
        ?>

        <input type="submit" name="submit">
        
    <?php
    
      if(isset($_POST["submit"])){
    $query="update Groups set
    price=\"".$_POST["price"]."\",
    arrivalTime=\"".$_POST["arrivalTime"]."\",
    departureTime=\"".$_POST["departureTime"]."\",
     pic=\"".$_POST["pic"]."\",
     descrip=\"".$_POST["descrip"]."\"
     where GID=1";
    
     $results = $conn-> query($query) or die ($conn->error);
    
     if($results)
    echo "Successfully updated...";
    }
        ?>


    </form>

</body>
</html>