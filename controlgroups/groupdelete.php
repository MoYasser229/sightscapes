<?php 
    session_start();
?>
<!doctype html>
<html>
<body>
<form method = "post" action="">
<?php 
    echo "<h2> Are you sure that you want to delete the below record? </h2>";
    $conn = new mysqli("localhost" , "root" , "" , "project") or die("fatal error - cannot connect to the DB");
    $id=$_GET["id"];
    $query = "SELECT * FROM Groups WHERE GID = '$id'";
    $results = $conn-> query($query) or die("Fatal error in executing the query");

    while($row = $results->fetch_array(MYSQLI_ASSOC)) {
        echo 'Group ID:<br>';
        echo "<input type = text name=GID value = ".$row["GID"]."><br>";
        echo 'Price:<br>';
        echo "<input type = text name=price value = ".$row["price"]."><br>";
        echo 'Rating:<br>';
        echo "<input type = text name=rating value = ".$row["avgrating"]."><br>";
        echo 'Location:<br>';
        echo "<input type = text name=Loc value = ".$row["Loc"]."><br>";
        echo 'Departure Time:<br>';
        echo "<input type = DATE name=departureTime value = ".$row["departureTime"]."><br>";
        echo 'Arrival Time:<br>';
        echo "<input type = DATE name=arrivalTime value = ".$row["arrivalTime"]."><br>";
        echo 'Description:<br>';
        echo "<input type = text name=descrip value = ".$row["descrip"]."><br>";
        echo 'Picture:<br>';
        echo "<input type = text name=pic value = ".$row["pic"]."><br><br>";
    }
    ?>
    <input type="submit" name="submit">   
<?php
if(isset($_POST["submit"])){
    $query = "DELETE from Groups where GID ='$id'";
    $results = $conn-> query($query);
    if($results) header("Location: groupadminview.php");
}
?>
</form>
</body>
</html>