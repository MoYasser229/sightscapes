<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>

    <table border=1>
<tr>
 
  <th> GID </th>
   <th> price </th>
  <th> rating </th>
  <th> Loc </th>
  <th> departureTime</th>
   <th> arrivalTime</th>
   <th> descrip</th>
   <th> pic</th>
   
  
</tr>



    <?php 
 

        $conn = new mysqli("localhost" , "root" , "" , "project");

        if($conn-> connect_error)
            die("fatal error - cannot connect to the DB");

        $query = "select * from Groups where GID='".$_POST['groups']."'";
        $results = $conn-> query($query);


       while($row= $results->fetch_array(MYSQLI_ASSOC)) {
     ?>


             <tr>
                 <td> <?php echo $row['GID'] ?></td>
                 <td> <?php echo $row['price'] ?></td>
                 <td> <?php echo $row['rating'] ?></td>
                  <td> <?php echo $row['Loc'] ?></td>
                 <td> <?php echo $row['departureTime'] ?></td>
                 <td> <?php echo $row['arrivalTime'] ?></td>
                  <td> <?php echo $row['descrip'] ?></td>
                  <td> <?php echo $row['pic'] ?></td>
                 <td> <a href=groupedit.php?id=<?php echo $row['GID'] ?> > Edit</a></td>
                 <td> <a href=groupdelete.php?id=<?php echo $row['GID'] ?> >Delete</a></td>
                
             </tr>

             <?php
      
        }
        ?>
<table>
</body>
</html>