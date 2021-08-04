<?php 
  session_start();
  if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: adminlogin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['adminname']);
    header("location: adminlogin.php");
  }
  ?>
<!DOCTYPE html>
<html>
<head>
 <title></title>
 <link rel="stylesheet" type="text/css" href="style2.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>

<header class="site-header clearfix">
 <nav>
  <div class="logo">
   <h1>Vikata Grocery Store</h1>
  </div>
  <div class="menu"> 
   <ul>
    <a href="product.php">
    Add Products
</a>
<a href="orders.php">
    Order
    </a>
    

<a href="customer.php">
    Customer
    </a>
    <a href="adminproduct.php">
    Stock
    </a>
    
    <a href="adminlogout.php">
    logout
    </a>
    
   </ul>
  </div>
 </nav>
 <section>
  <div class="leftside"> 
   <img src="pic1.jpg">
  </div>
  <div class="rightside"> 
   <h1>Your favorite neighbourhood store ...now ONLINE</h1>
   <p>Eat the best and healthy food, unadulterated, Up to your standards at best low prices!! </p>
   
  </div>
  
 </section>

</header>


</body>
</html>
