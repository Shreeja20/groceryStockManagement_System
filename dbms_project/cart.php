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



//index.php
$_SESSION['count']=0;
$count=0;
$connect=mysqli_connect('localhost','root','','grocery');
$message = '';
if(isset($_POST["proceedtopay"]))
{
  ?>
	<script>
	window.location.href='bill.php';
	</script>
	<?php
   die();
}

if(isset($_POST["add_to_cart"]))
{
 if(isset($_COOKIE["shopping_cart"]))
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);

  $cart_data = json_decode($cookie_data, true);
 }
 else
 {
  $cart_data = array();
 }

 $item_id_list = array_column($cart_data, 'item_id');

 if(in_array($_POST["hidden_id"], $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
   {
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
   }
  }
 }
 else
 {
  $item_array = array(
   'item_id'   => $_POST["hidden_id"],
   'item_name'   => $_POST["hidden_name"],
   'item_price'  => $_POST["hidden_price"],
   'item_quantity'  => $_POST["quantity"]
  );
  $cart_data[] = $item_array;
 }

 
 $item_data = json_encode($cart_data);
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:cart.php?success=1");
}

if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
   $count--;
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['item_id'] == $_GET["id"])
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:cart.php?remove=1");
   }
  }
 }
 if($_GET["action"] == "clear")
 {
  $_SESSION['count']=0;
  setcookie("shopping_cart", "", time() - 3600);
  header("location:cart.php?clearall=1");
  
 }
}

if(isset($_GET["success"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item Added into Cart
 </div>
 ';
}

if(isset($_GET["remove"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Item removed from Cart
 </div>
 ';
}
if(isset($_GET["clearall"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Your Shopping Cart has been clear...
 </div>
 ';
}


?>
<!DOCTYPE html>
<html>
 <head>
  <title>Shopping Cart</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link "  href="homepage.php"><h2>Home</h2></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order.php"><h2>Products</h2></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="cart.php"><h2>Cart</h2></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" ><h2>&nbsp;Welcome &nbsp; <?php echo $_SESSION['name'] ?> !!</h2></a>
        </li>
        
        
      </ul>
     
  
    </div>
  </div>
</nav>
 </head>
 <body>

   
   
   <div style="clear:both"></div>
   <br />
   <h3>Order Details</h3>
   <div class="table-responsive">
   <?php echo $message; ?>
   <div align="right">
    <a href="cart.php?action=clear"><b>Clear Cart</b></a>
   </div>
   <table class="table table-bordered"style="table-layout: fixed; width: 50%; margin: auto;">
    <tr>
     <th width="20%">Item Name</th>
     <th width="10%">Quantity</th>
     <th width="10%">Price</th>
     <th width="15%">Total</th>
     <th width="10%">Action</th>
    </tr>
   <?php
   if(isset($_COOKIE["shopping_cart"]))
   {
    $total = 0;
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
   ?>
    <tr>
     <td><?php echo $values["item_name"]; ?></td>
     <td><?php echo $values["item_quantity"]; ?></td>
     <td>Rs <?php echo $values["item_price"]; ?></td>
     <td>Rs <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
     <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
    </tr>
   <?php 
     $total = $total + ($values["item_quantity"] * $values["item_price"]);
     $count++;
     $_SESSION['count']= $count;
  
    }
   ?>
    <tr>
     <td colspan="3" align="right">Total</td>
     <td align="right">Rs <?php echo number_format($total, 2); ?></td>
     <td></td>
    </tr>
   <?php
   }
   else
   {
    echo '
    <tr>
     <td colspan="5" align="center">No Item in Cart</td>
    </tr>
    ';
   }
   ?>
   </table>
   <form method="post" action="">
  <?php //echo  $_SESSION['count']?>
<input type="submit" name="proceedtopay" style="margin-top:5px;" class="button" value="Place Order" <?php echo  ($_SESSION['count']<=0)? 'disabled' :''?> />
</form>
   </div>
  </div>
  <br />
 </body>
</html>