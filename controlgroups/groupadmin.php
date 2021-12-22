<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>

    <table border=1>
<tr>
  <th> Name </th>
  <th> GID </th>
  <th> Rating </th>
  <th> Price </th>
  <th> DepartureTime</th>
   <th> ArrivalTime</th>
   <th> Description</th>
   
  
</tr>

<form action ='addgroup.php' method ='post'>
 <button type="submit"> Add</button>

    <?php 
 

        $conn = new mysqli("localhost" , "root" , "" , "projectf");

        if($conn-> connect_error)
            die("fatal error - cannot connect to the DB");

        $query = "select * from grptable where Name='".$_POST['groups']."'";
        $results = $conn-> query($query);


       while($row= $results->fetch_array(MYSQLI_ASSOC)) {
     ?>


             <tr>
                 <td> <?php echo $row['Name'] ?></td>
                 <td> <?php echo $row['GID'] ?></td>
                 <td> <?php echo $row['Rating'] ?></td>
                 <td> <?php echo $row['Price'] ?></td>
                 <td> <?php echo $row['DepartureTime'] ?></td>
                 <td> <?php echo $row['ArrivalTime'] ?></td>
                  <td> <?php echo $row['Description'] ?></td>
                 <td> <a href=groupedit.php?id=<?php echo $row['GID'] ?> > Edit</a></td>
                 <td> <a href=groupdelete.php?id=<?php echo $row['GID'] ?> >Delete</a></td>
                
             </tr>

             <?php
			
        }
        ?>
<table>
</body>
</html>