
<?php 
  session_start();
$connect = new PDO("mysql:host=localhost;dbname=grocery", "root", "");

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
  <title>PRODUCTS</title>
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
          <!--<a class="nav-link" href="search.php",method=""><h2>search</h2></a>-->
          <form method="post">
         


</form>

         
        </li>
		<li class="nav-item">
          <a class="nav-link" ><h2>&nbsp;Welcome &nbsp; <?php echo $_SESSION['name'] ?> !!</h2></a>
        </li>
        
        
      </ul>
     
  
    </div>
  </div>
</nav>
</head>
<form method="post" action="search.php">  
<br><br><center><input type="text" name="search" placeholder="Search for products" required><input type="submit" name="searchbtn" value="Search"></input></center><br><br>
</form>

 <body>
  <br />
  <div class="container">
   <br />
   <h3 align="center">OUR PRODUCTS!!<br /><br /> FRESH AND HEALTHY</h3><br />
   <br /><br />
   <?php
   $query = "SELECT * FROM menu_table where aval_status=0";
   $statement = $connect->prepare($query);
   $statement->execute();
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
   ?>
   <div class="col-md-3">
    <form method="post" action="cart.php">
     <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
	 <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row['image'] );?>" height="200" width="200" class="card-img-top" />
          

      <h4 class="text-info"><?php echo $row["product_name"]; ?></h4>

      <h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4>

      <input type="text" name="quantity" value="1" class="form-control" />
      <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
      <input type="hidden" name="hidden_id" value="<?php echo $row["product_id"]; ?>" />
      <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
     </div>
    </form>
   </div>
   <?php
   }
   ?>
   
   
   
   </table>
   </div>
  </div>
  <br />
 </body>
</html>