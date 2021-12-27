<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
    <table border=1>
<tr>
   <th> Group ID </th>
   <th> Price </th>
   <th> Rating </th>
   <th> Location </th>
   <th> Departure Date </th>
   <th> Arrival Date </th>
   <th> Description </th>
   <th> Picture </th>
</tr>
<?php 
    $conn = new mysqli("localhost" , "root" , "" , "project");
    if($conn-> connect_error) die("fatal error - cannot connect to the DB");
    $x=(isset($_POST['groups']))?($_POST['groups']):'';
    if($x!=''){
    $query = "SELECT * from Groups where GID='$x'";
    $results = $conn-> query($query);
    while($row= $results->fetch_array(MYSQLI_ASSOC)) {
    ?>
<tr>
    <?php  if($row['avgrating']==null){
		$row['avgrating'] = "No customer reviews";
	}?>
    <td> <?php echo $row['GID'] ?></td>
    <td> <?php echo $row['price'] ?></td>
    <td> <?php echo $row['avgrating'] ?></td>
    <td> <?php echo $row['Loc'] ?></td>
    <td> <?php echo $row['departureTime'] ?></td>
    <td> <?php echo $row['arrivalTime'] ?></td>
    <td> <?php echo $row['descrip'] ?></td>
    <td> <?php echo $row['pic'] ?></td>
    <td> <a href=groupedit.php?id=<?php echo $row['GID'] ?> > Edit</a></td>
    <td> <a href=groupdelete.php?id=<?php echo $row['GID'] ?> >Delete</a></td>
</tr>

<?php }} ?>
<table>
</body>
</html>