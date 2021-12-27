<html>
    <head>
    </head>
    <body>
        <form method="post" action="">
            sort:<br>
            descending: <input type="radio" value = "DESC" name = "sortArrange"><br>
            ascending: <input type="radio" value = "ASC" name = "sortArrange"><br>
            by:<br>
            id <input type="checkbox" value = "OrderID" name = "sort"><br>
            location <input type="checkbox" value = "loc" name = "sort"><br>
            departure time <input type="checkbox" value = "departureTime" name = "sort"><br>
            arrival time <input type="checkbox" value = "arrivalTime" name = "sort"><br>
            Search <select name="searchlist" id="searchlist">
                <option value="all" selected>All</option>
                <option value="OrderID" >Order ID</option>
                <option value="Loc" >Group Location</option>
                <option value="departureTime" >Departure Date</option>
                <option value="arrivalTime" >Arrival Date</option>
            </select>
            <input name = "search" id="search">
            <input type="submit" name="submit">
        </form>
        <script>
            var select=document.getElementById('searchlist');
            var type=document.getElementById('search')
            select.addEventListener('change', () => {
            if((event.target.value=='departureTime')||(event.target.value=='arrivalTime'))
            document.getElementById("search").type='date';
            else
            document.getElementById("search").type='text';
            })
        </script>
        <?php
            $orderby = "Orders.OrderID";
            $sort = "ASC";
            $narrowedsearch='';
            $tb='';
            $txtsr='';

            if(isset($_POST['submit'])){
                if(isset($_POST['sortArrange']))
                    if($_POST['sortArrange'] === "DESC")
                        $sort = "DESC";
                if(isset($_POST['sort']))
                    if($_POST['sort'] === 'loc' || $_POST['sort'] === 'departureTime' || $_POST['sort'] === 'arrivalTime')
                        $orderby = 'groups.'.$_POST['sort'];
                if(isset($_POST['search'])){
                    if($_POST['searchlist']!='all'){
                        ($_POST['searchlist'] =='OrderID')?($tb='Orders.'):($tb='groups.');
                        $narrowedsearch=$tb.$_POST['searchlist'];
                    }
                    $txtsr=$_POST['search'];
                }
            }

            $host = 'localhost';
            $db = 'project';
            $username = 'root';
            $password = "";
            $conn = mysqli_connect($host, $username, $password,$db);

            if($txtsr=="")
            $sql = "SELECT orders.orderID,groups.loc,groups.departureTime,groups.arrivalTime
            FROM `orders`,`groups` WHERE orders.GID = groups.GID ORDER BY $orderby $sort;";
            else if($txtsr!=""&&($_POST['searchlist']=='all'))
            $sql = "SELECT orders.orderID,groups.loc,groups.departureTime,groups.arrivalTime
            FROM `orders`,`groups` WHERE orders.GID = groups.GID AND concat(orders.orderID,groups.loc,
            groups.departureTime,groups.arrivalTime) LIKE '%$txtsr%'
            ORDER BY $orderby $sort;";
            else if($txtsr!=""&&$narrowedsearch!="")
            $sql = "SELECT orders.orderID,groups.loc,groups.departureTime,groups.arrivalTime
            FROM `orders`,`groups` WHERE orders.GID = groups.GID AND $narrowedsearch='$txtsr'
            ORDER BY $orderby $sort;";
            
            $result = $conn->query($sql) or die($conn->error);
            if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
                echo "There are no results <br> Try searching again";
            else{
                echo "<table border = 1>
                <tr><th>Order ID</th><th>Group Location</th><th>Departure Date</th>
                <th>Arrival Date</th></tr>";
                while($row2 = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>".$row2['orderID']."</td>
                    <td>".$row2['loc']."</td>
                    <td>".$row2['departureTime']."</td>
                    <td>".$row2['arrivalTime']."</td>
                    </tr>";
                }
            }
        ?>
        </table>
        
    </body>
</html>