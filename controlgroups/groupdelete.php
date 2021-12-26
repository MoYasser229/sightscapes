<?php 
    session_start();
?>
<!doctype html>
<html>
<head>
<title>Untitled Document</title>
</head>

<body>

    <form method = "post" action="">

        <?php 

            echo "<h2> Are you sure that you want to delete the below record? </h2>";
            $conn = new mysqli("localhost" , "root" , "" , "project") or die("fatal error - cannot connect to the DB");

            $query = "SELECT * FROM Groups WHERE GID = '". $_SESSION["ID"]."'";

            $results = $conn-> query($query) or die("Fatal error in executing the query");

            while($row = $results->fetch_array(MYSQLI_ASSOC)) {
                echo 'GroupID:<br>';
                echo "<input type = text name=GID value = ".$row["GID"] . "><br>";

                echo 'price:<br>';
                echo "<input type = text name=price value = ".$row["price"] . "><br>";

                echo 'rating:<br>';
                echo "<input type = text name=rating value = ".$row["rating"] . "><br>";

                echo 'Location:<br>';
                echo "<input type = text name=Loc value = ".$row["Loc"] . "><br>";

                 echo 'departureTime:<br>';
                echo "<input type = text name=departureTime value = ".$row["departureTime"] . "><br>";

                 echo 'arrivalTime:<br>';
                echo "<input type = text name=arrivalTime value = ".$row["arrivalTime"] . "><br>";
                

                 echo 'Description:<br>';
                echo "<input type = text name=descrip value = ".$row["descrip"] . "><br>";

                echo 'picture:<br>';
                echo "<input type = text name=pic value = ".$row["pic"] . "><br>";
               
            }
         ?>
         <input type="submit" name="submit">   
        <?php
        if(isset($_POST["submit"])){
            $query = "DELETE from Groups where GID ='".$_GET['id']."'";

            $results = $conn-> query($query);

            if($results)
                header("Location: groupadminview.php");
 }
        ?>
    </form>

</body>
</html>