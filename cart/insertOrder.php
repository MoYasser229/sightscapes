
<html lang="en">
<head>
<title> Checkout </title>
<link rel="stylesheet" type="text/css" href="../../project/styles/checkout.css">
<meta name = "viewport" content="width= device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
   
<?php
session_start();
$cartItems = stripslashes($_COOKIE['GroupsCart']);
$cart = json_decode($cartItems, true);
$conn = new mysqli("localhost","root","","project");
$totalprice=0;
foreach($cart as $cartItem){
   $GID = $cartItem['ID'];
   $hikerID = $_SESSION['ID'];
   $price = $cartItem['price'];
   $totalprice+=$price;
}
foreach($cart as $cartItem){
    $GID = $cartItem['ID'];
    $hikerID = $_SESSION['ID'];
    $sql = "INSERT INTO orders(GID,userID,totalPrice)
     VALUES('$GID','$hikerID','$totalprice')";
    $result = $conn->query($sql) or die($conn->error);
 }
?>


<script>
   $(document).ready(function(){
   $("#flip").click(function(){
   $("#panel").slideDown("slow");
});
});


function validateName(FullName){
   if(FullName=='')
      return 'no FullName was entered.\n';
   else
      return '';
}
function validateEmail(Email){
   if(Email=='')
      return 'no Email was entered.\n';
   else
      return '';
}
function validateMobile(Mobile){
   if(Mobile=='')
      return 'no Mobile was entered.\n';
   else
      return '';
}
function validateAddress(Address){
   if(Address=='')
      return 'no Address was entered.\n';
   else
      return '';
}
function validateCity(City){
   if(City=='')
      return 'no City was entered.\n';
   else
      return '';
}
function validateCN(CN){
   if(CN=='')
      return 'Please check your payment method1\n';
   else
      return '';
}
function validateEM(EM){
   if(EM=='')
      return 'Please check your payment methodEM\n';
   else
      return '';
}
function validateEY(EY){
   if(EY=='')
      return 'Please check your payment methodEY\n';
   else
      return '';
}
function validateCVV(CVV){
   if(CVV=='')
      return 'Please check your payment methodCVV\n';
   else
      return '';
}
function validate(form){
   fail='';
   fail+=validateName(form.FullName.value);
   fail+=validateEmail(form.Email.value);
   fail+=validateMobile(form.Mobile.value);
   fail+=validateAddress(form.Address.value);
   fail+=validateCity(form.City.value);
   fail+=validateCN(form.CN.value);
   fail+=validateEM(form.ED.value);
   fail+=validateEY(form.ED.value);
   fail+=validateCVV(form.ED.value);
   if(fail==''){
      return true;
   }
   else{
      alert(fail);
      return false;
   }
}

</script>

<div class= "container">
<div class= "Checkout"><h1><b> Checkout </b></h1></div>


<div class = "personalinfo"><h2><b> Personal information </b></h2>
   </br>
   <lable for="FullName"><i class="fa fa-user"></i>Full Name</lable>
   <input type="FullName" class="form-control" id="FullName" placeholder="Enter Full Name" name="FullName">

   <lable for="Email">Email</lable>
   <input type="Email" class="form-control" id="Email" placeholder="xxx@example.com" name="Email">

   <lable for="Mobile">Mobile Number</lable>
   <input type="Mobile" class="form-control" id="Mobile" placeholder="+20 Mobile Number" name="Mobile">

   <lable for="City">City</lable>
   <input type="City" class="form-control" id="City" placeholder="*City" name="City">

   <lable for="Address">Address</lable>
   <input type="Address" class="form-control" id="Address" placeholder="st.Name/BuildingNumber/ApartmentNumber" name="Address">
   </br>
   <lable for="Additional info"></lable>
   <input type="Additional info" class="form-control" id="Additional info" placeholder="Additional Info" name="Additional info">
   </br>
</div>



<div class="Payment-method" ><h3><b> Payment method </b></h3>

   <img src="c2.png" alt="cash" width="40" height="40">
   <lable><input type="radio" name="f1[]" value="COD"> <b>Cach On Delivery</b></label>
   </br>
   <img src="v2.png" alt="visa" width="40" height="40">
   <label><input type="radio" name="f1[]"  value="PWC" id="flip"> Pay With Card </label>


   <div id="panel">  
      <lable for="CN"><b>Card number</b></lable>
      <input type="CN" class="c-control" id="CN" placeholder="xxxx xxxx xxxx xxxx" name="CN">
      </br>  
      <lable for="ED"><b>Expiration date</b></lable>

      <input type="EM"class="date" id="EM" placeholder="Month" name="EM">
      <input type="EY" class="date" id="EY" placeholder="Year" name="EY">
      </br> 
      <lable for="cvv"><b> CVV*</b></lable> 
      <input type="CVV" class="CVV" id="CVV" placeholder="xxx" name="CVV">
   </div>
</div>

<div class = "cart-summary"><h3><b> Cart summary </b></h3></div>
<div class="tp"><h5>Total Price:</h5> </div>
<button class="button">Button</button>
</body>
</html>
<?php
$myCartData = stripslashes($_COOKIE['GroupsCart']);
$myCart = json_decode($myCartData, true);
$table = "<table class = 'Top-Table'>";

foreach($myCart as $cartItem){
    if($cartItem['userID'] == $_SESSION['ID']){
    $table .= "<tr>
    <td>
        <p><strong style = 'font-size: 15px;'>LOCATION &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($cartItem['location'])."</span></p>
    </td>
    <td>
        <p><strong style = 'font-size: 15px;'>PRICE &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($cartItem['price'])."</span></p>
      </tr>";
      }
   }
   $table .= "</table>";
   echo $table;

   if($totalprice != 0){ 
   
      echo "<span class = 'totalp'>". $totalprice."</span>";
   }
?>

</form>