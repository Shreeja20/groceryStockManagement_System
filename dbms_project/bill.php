<?php
session_start();

if (!isset($_SESSION['name'])) 
{
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) 
{
  session_destroy();
  unset($_SESSION['name']);
  header("location: login.php");
}


$con=mysqli_connect('localhost','root','','grocery');
?>
<html>
<style>
h1 { 
            text-align: center; 
            color: <div id="8a2be2"></div>; 
            font-size: xx-large; 
            font-family: 'sans-serif'; 
}
    	.img-container {
		display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
      }
      .limit{
    width:50px;
}
    .card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
}
.card-image {
 
  width: 300px;
  height: 300px;
  display: flex;
  justify-content: center;
  flex-direction: row;
}
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: block;
  position: fixed;
  bottom: 600;
  left:700;
  top: 400;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */

/* Add styles to the form container */
.form-container {
  max-width: 500px;
  display: none;
  padding: 10px;
  background-color: white;
  position: fixed;
  bottom:350;
  left: 700px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color:red;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
<script> 
   function clickAndDisable(link) {
     // disable subsequent clicks
     link.onclick = function(event) {
        event.preventDefault();
        alert("Your bill has been generated")
        
     }
   }   
</script>
<!--a href="bill.php" onclick="clickAndDisable(this);" target="_blank">Click here to generate bill</a>-->
<h1>CONFIRM YOUR ORDER</h1> 
<form action="" id="myForm" method="POST" class="form-container" style="display:block;">
  
  <button type="submit" class="btn" id="ok" name="placeorder"> Submit Order </input><br>
  <button type="button" class="btn cancel" onclick="Pagedirect()">Go Back</button>
  </form>
  <script>
  function Pagedirect() {
   window.location.href = "cart.php";
      }
      </script>
<?php
if (isset($_SESSION['name'])) 
{
    $uname= $_SESSION['name'];
     $idquery="select cust_id from `customer` where `name`='$uname'";
     $result = mysqli_query($con, $idquery);
     $val=mysqli_fetch_array($result);
     $uid= $val['cust_id'];
     
if(isset($_POST["placeorder"]))
{
   ?>
   <script>"ok".disabled = true;</script>
   <?php
  echo "<script>alert('Order Placed')</script>";
  
  $date=date("Y-m-d");
  $pur_amt=0;
  $insert2 = mysqli_query($con,"INSERT INTO orderplaced(cust_id,order_date,payment,purchase_amount) VALUES ('$uid','$date',0,$pur_amt);");
  $odq="select max(id) as maxid from `orderplaced` where `cust_id`='$uid'";
  $r = mysqli_query($con, $odq);
  $vals=mysqli_fetch_array($r);
  $ordid= $vals["maxid"];
  $total = 0;
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
   
    foreach($cart_data as $keys => $values)
    {
     $dish=$values["item_name"];
     $qty= $values["item_quantity"]; 
     $price= ($values["item_quantity"] * $values["item_price"]);
     $insert = mysqli_query($con,"INSERT INTO orderitems(order_id,qty,cust_id,product_name,price) VALUES ('$ordid','$qty','$uid','$dish',$price);");
     $total = $total + ($values["item_quantity"] * $values["item_price"]);
     $call=mysqli_query($con,"CALL calc_amt('$price','$ordid')");
    }
    //header("location:billpr.php?success=1");
    //header("location:Delivery_form.php?cnno=".$cnno."&copies=".$nocopy);
  
    //$date=date("Y-m-d");
    //$update = mysqli_query($con,"UPDATE orderplaced set purchase_amount=$total where id=$ordid;");
    //echo $total;
    //$call=mysqli_query($con,"CALL calc_amt('$total','$ordid')");
    setcookie("shopping_cart", "", time() - 3600);
    $_SESSION['count']=0;
    ?>
    <script>
    window.location.href='recipt.php';
	</script>
	<?php
  die();
  
    
     
}
}

