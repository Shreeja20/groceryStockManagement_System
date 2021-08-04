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
    <a href="order.php">
    <button>Products</button>
</a>
<a href="cart.php">
    <button>Cart </button>
    </a>
    <!--<button>About Us</button>-->
    <a href="userlogout.php">
   <button>logout</button>
    </a>
   </ul>
   
  </div>
 </nav>
 <section>
  <div class="leftside"> 
   <img src="bg3.jpg">
  </div>
  <div class="rightside"> 
   <h1>Your favorite neighbourhood store ...now ONLINE</h1>
   <p>Eat the best and healthy food, unadulterated, Up to your standards at best low prices!! </p>
   
  </div>
  
 </section>

</header>


</body>
</html>
