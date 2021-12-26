<html>
    <head>
    </head>
    <body>
        <form method="post" action="">
            sort:<br>
            descending: <input type="checkbox" value = "DESC" name = "sortArrange"><br>
            ascending: <input type="checkbox" value = "ASC" name = "sortArrange"><br>
            by:<br>
            id <input type="checkbox" value = "OrderID" name = "sort"><br>
            location <input type="checkbox" value = "loc" name = "sort"><br>
            departure time <input type="checkbox" value = "departureTime" name = "sort"><br>
            arrival time <input type="checkbox" value = "arrivalTime" name = "sort"><br>
            <input type="submit" name="submit">
        </form>
        <?php
            $orderby = "Orders.OrderID";
            $sort = "ASC";
            if(isset($_POST['submit'])){
                if(isset($_POST['sortArrange']))
                    if($_POST['sortArrange'] === "DESC")
                        $sort = "DESC";
                if(isset($_POST['sort']))
                    if($_POST['sort'] === 'loc' || $_POST['sort'] === 'departureTime' || $_POST['sort'] === 'arrivalTime')
                        $orderby = 'groups.'.$_POST['sort'];
            }
        ?>
        <table border = 1>
            <tr><th>Order ID</th><th>Group Location</th><th>Departure Date</th><th>Arrival Date</th></tr>
        <?php
            $host = 'localhost';
            $db = 'project';
            $username = 'root';
            $password = "";
            $conn = mysqli_connect($host, $username, $password,$db);
            $sql = "SELECT orders.orderID,groups.loc,groups.departureTime,groups.arrivalTime FROM `orders`,`groups` WHERE orders.GID = groups.GID ORDER BY $orderby $sort;";
            $result2 = $conn->query($sql) or die($conn->error);
            while($row2 = $result2->fetch_assoc()) {
                echo "<tr>
                <td>".$row2['orderID']."</td>
                <td>".$row2['loc']."</td>
                <td>".$row2['departureTime']."</td>
                <td>".$row2['arrivalTime']."</td>
                </tr>";
            }
        ?>
        </table>
        
    </body>
</html>