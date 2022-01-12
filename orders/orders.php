<html>
    <head>
    </head>
    <body>
        <form method="post" action="">
            SORT:<br>
            descending: <input type="radio" value = "DESC" name = "sortArrange"><br>
            ascending: <input type="radio" value = "ASC" name = "sortArrange"><br>
            by:<br>
            hiker name <input type="checkbox" value = "fname" name = "sort"><br>
            location <input type="checkbox" value = "loc" name = "sort"><br>
            price <input type="checkbox" value = "totalPrice" name = "sort"><br>
            Search <select name="searchlist" id="searchlist">
                <option value="all" selected>All</option>
                <option value="fname" >Hiker name</option>
                <option value="loc" >Group Location</option>
                <option value="totalPrice" >price</option>
            </select>
            <input name = "search" id="search">
            <input type="submit" name="submit">
        </form>
        <script>
            var select=document.getElementById('searchlist');
            var type=document.getElementById('search')
            select.addEventListener('change', () => {
                document.getElementById("search").type='text';
            })
        </script>
        <?php
            $orderby = "users.userID";
            $sort = "ASC";
            $narrowedsearch='';
            $tb='';
            $txtsr='';

            if(isset($_POST['submit'])){
                if(isset($_POST['sortArrange']))
                    if($_POST['sortArrange'] === "DESC")
                        $sort = "DESC";
                if(isset($_POST['sort']))
                    if($_POST['sort'] === 'loc' )
                        $orderby = 'groups.'.$_POST['sort'];
                    else if($_POST['sort'] === 'totalPrice')
                        $orderby = "orders.{$_POST['sort']}";
                if(isset($_POST['search'])){
                    if($_POST['searchlist']!='all'){
                        ($_POST['searchlist'] =='fname')?($tb='users.'):($tb='groups.');
                        if($_POST['searchlist'] === 'totalPrice')
                            $tb = 'orders.';
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
                $sql = "SELECT groups.GID,users.fname,orders.totalPrice,groups.loc
                FROM `orders`,`groups`,`users` WHERE orders.GID = groups.GID AND orders.userID = users.userID ORDER BY $orderby $sort;";
            else if($txtsr!=""&&($_POST['searchlist']=='all'))
                $sql = "SELECT groups.GID,users.fname,orders.totalPrice,groups.loc
                FROM `orders`,`groups`,`users` WHERE orders.GID = groups.GID AND orders.userID = users.userID AND concat(users.userID,groups.loc
                ) LIKE '%$txtsr%'
                ORDER BY $orderby $sort;";
            else if($txtsr!=""&&$narrowedsearch!="")
                $sql = "SELECT groups.GID,groups.loc,users.fname,orders.totalPrice
                FROM `orders`,`groups`,`users` WHERE orders.GID = groups.GID AND orders.userID = users.userID AND $narrowedsearch='$txtsr'
                ORDER BY $orderby $sort;";
            
            $result = $conn->query($sql) or die($conn->error);
            if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
                echo "There are no results <br> Try searching again";
            else{
                echo "<table border = 1>
                <tr><th>Hiker Name</th><th>Group ID</th><th>Location</th><th>Group Price</th></tr>";
                while($row2 = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>".$row2['fname']."</td>
                    <td>".$row2['GID']."</td>
                    <td>".$row2['loc']."</td>
                    <td>".$row2['totalPrice']."</td>
                    </tr>";
                }
            }
        ?>
        </table>
        
    </body>
</html>