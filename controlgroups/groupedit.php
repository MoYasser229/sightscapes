<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<form method = "post" action="">
<?php
    $conn = new mysqli("localhost" , "root" , "" , "project");
    if($conn-> connect_error) die("fatal error - cannot connect to the DB");
    $id=$_GET["id"];
    $query = "SELECT * FROM Groups WHERE GID=$id";
    $results = $conn-> query($query);
    if(!$results) die("Fatal error in executing the query");

    while($row = $results->fetch_array(MYSQLI_ASSOC)) {
        echo 'Price:<br>';
        echo "<input type = text name=price value = ".$row["price"] . "><br>";
        echo 'Location:<br>';
        echo "<input type = text name=Loc value = ".$row["Loc"] . "><br>";
        echo 'Departure Time:<br>';
        echo "<input type = DATE name=departureTime value = ".$row["departureTime"] . "><br>";
        echo 'Arrival Time:<br>';
        echo "<input type = DATE name=arrivalTime value = ".$row["arrivalTime"] . "><br>";
        echo 'Description:<br>';
        echo "<input type = text name=descrip value = ".$row["descrip"] . "><br>";
        echo 'Picture:<br>';
        echo "<input type = text name=pic value = ".$row["pic"] . "><br><br>";
    }
?>
<input type="submit" name="submit">    
<?php
    if(isset($_POST["submit"])){
        $query="UPDATE Groups set
        price=\"".$_POST["price"]."\",
        arrivalTime=\"".$_POST["arrivalTime"]."\",
        departureTime=\"".$_POST["departureTime"]."\",
        pic=\"".$_POST["pic"]."\",
        descrip=\"".$_POST["descrip"]."\"
        where GID=$id";
        $results = $conn-> query($query) or die ($conn->error);
        if($results) echo "<br><br>Successfully updated...<br><br>";
        ?>
        <input type="button" onclick="location.href='groupadminview.php';" value="Return to the data management page."/>
        <?php
    }
?>
</form>
</body>
</html>