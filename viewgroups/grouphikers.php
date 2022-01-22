
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="../styles/groupStyles.css" rel="stylesheet" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscape</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
	<body style="background-color: #071a20;">
	<?php
		session_start();
		function checkLogin(){
			if(!isset($_SESSION['ID']) && !isset($_SESSION['userRole'])){
			?>
			<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
						<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
							<ul class="navbar-nav mr-auto">
							<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
									</li>
									<li class="nav-item">
									<a class="nav-link" href="../viewGroups/grouphikers.php"><h6>GROUP</h6></a>
									</li>
							</ul>
						</div>
						<div class="mx-auto order-0">
						<a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
							<ul class="navbar-nav ml-auto">
							<li class="nav-item">
									<a class="nav-link" href="../users/Login.php"><h6>LOGIN</h6></a>
									</li>
									<li class="nav-item">
									<a class="nav-link" href="../users/Signup.php"><h6>SIGN UP</h6></a>
									</li>
							</ul>
						</div>
						</nav>
								<?php
								}
								else if ($_SESSION['userRole'] === "admin"){
									?>
											<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../admincontrol/admin.php"><h6>DATA MANAGEMENT</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="orders/orders.php"><h6>ORDERS</h6></a>
											</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
											<li class="nav-item">
											<a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
								else if($_SESSION['userRole'] === 'hiker'){
									?>
									<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../viewgroups/grouphikers.php"><h6>GROUPS</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../cart/cart.php"><h6>CART</h6></a>
											</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
											<li class="nav-item">
											<a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
								else if($_SESSION['userRole'] === "auditor"){
									?>
									<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
											<a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
										</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
								else if($_SESSION['userRole'] == 'hr'){
									?>
									<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
											<a class="nav-link" href=""><h6>CHAT REPORTS</h6></a>
										</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
			}
		checkLogin();
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "project";
		$conn = mysqli_connect($servername, $username, $password, $db);
	?>
	<div class="topClass">
		<h1>SEARCH FOR <h1>AN ADVENTURE</h1>
		<div class="formStyle">
			<div class="sortArea">
				
					<div class="searchBarContainer">
						<select name='searchlist' id='searchlist'>
						<option value='all' selected>All</option>
						<option value='price' >Price</option>
						<option value='avgrating' >Rating</option>
						<option value='departureTime' >Departure Date</option>
						<option value='arrivalTime' >Arrival Date</option>
						<option value='descrip' >Description</option>
						<option value='Loc' >Location</option>
						</select>
						<input name = 'search' id='search' class="searchBar" placeHolder = "SEARCH HERE"><br>
						
					</div>
					<!--<i class="fas fa-filter"></i>-->
					<div class="filterArea">
						<select name = "filterList" id = "filter" placeholder = "FILTER">
							<option value = "Price">Price </option>
							<option value = "rating">Rating </option>
							<option value = "departureTime">Departure Date </option>
							<option value = "arrivalTime">ArrivalTime </option>
							<option value = "loc">Location </option>
						</select>
						<!-- ID <input type='checkbox' value = 'GID' name = sort><br>
						Price <input type='checkbox' value = 'Price' name = sort><br>
						rating <input type='checkbox' value = 'rating' name = 'sort'><br>
						departure Time <input type='checkbox' value = 'departureTime' name = 'sort'><br>
						arrival Time <input type='checkbox' value = 'arrivalTime' name = 'sort'><br>
						Location <input type='checkbox' value = 'loc' name = 'sort'><br> -->
						<select name = "sortArrange" id = "order">
							<option value = "DESC">DESCENDING</option>
							<option value = "ASC">ASCENDING </option>
						</select><br>
						<a href="#div1"id="submitSearch"><i class="fas fa-angle-down"></i></a>
					</div>
			</div>
		</div>
	</div>
	
	<script>
		var select=document.getElementById('searchlist');
		var type=document.getElementById('search')
		select.addEventListener('change', () => {
		if((event.target.value=='departureTime')||(event.target.value=='arrivalTime'))
		document.getElementById("search").type='date';
		else
		document.getElementById("search").type='text';
		})
		$(document).ready(function(){
			loadAll()
			$('#submitSearch').click(function(){
				filterList = $('#filter').val();
				orderList = $('#order').val()
				searchItem = $('#search').val()
				searchListItem = $('#searchlist').val()
					$.ajax({
							type: 'POST',
							url: 'groupsBackEnd.php',
							data: { 
								'filter': filterList, 
								'order':orderList,
								'search':searchItem,
								'searchlist': searchListItem,
								'checkAjax': '1'
							},
							success: function(groups){
								$('#div1').html(groups);
							}
					});
			});
		})
		function loadAll(){
			$.ajax({
							type: 'POST',
							url: 'groupsBackEnd.php',
							data: { 
								'filter': '', 
								'order':'',
								'search':'',
								'searchlist': '',
								'checkAjax': '1'
							},
							success: function(groups){
								$('#div1').html(groups);
							}
					});
		}
		var myTimeout = setTimeout(timeout, 5000);
		function timeout(){ $("#Db").fadeOut("slow");}; 
		$(document).ready(function(){
		$("button").click(function (){
			// $("#Db").fadeOut();
			$("#Db").fadeOut("slow");
			// $("#Db").fadeOut(3000);
		});
		});
	</script>
<div id="div1"></div>
<footer class="container-fluid bg-grey py-5">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="logo-part">
                                <img src="../bckgrnd/logo.png" class="w-75 logo-footer" >
                            </div>
                            </div>
                            <div class="col-md-6 px-4">
                            <h6> About Company</h6>
                            <p>A website that connects all hikers in one place. We are here to give all hikers opportunity to view various hiking groups to different locations.</p>
                            <p>Our goal is to provide a service that organize hiking trips to all hikers on earth.</p>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <h6> Newsletter</h6>
                            <div class="social">
                                <a href="https://facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="https://twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="https://youtube.com"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </footer>
	</body>
</html>
<?php
  $message = '';
  if(isset($_GET["success"]))
{

    $message = '
			  <div class="text-center fixed-top" style="margin-top:75px;">
                <button class="btn btn-success" id="Db" style="width:50%"><i class="fa fa-cart-plus" aria-hidden="true"></i> Group is successfully added to your cart</button>
              </div>
    ';

} 
if(isset($_GET["errorCart"]))
{

    $message = '
    <div class="text-center fixed-top" style="margin-top:75px;">
                <button class="btn btn-danger" id="Db" style="width:30%">Item is already in cart</button>
              </div>
    ';

} 
if(isset($_GET["errorRegister"]))
{

    $message = '
    <div class="text-center fixed-top" style="margin-top:75px;">
                <button class="btn btn-danger" id="Db" style="width:30%">You need to register to add to cart</button>
              </div>
    ';

} 
echo $message;

  ?>
