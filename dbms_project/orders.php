<?php
session_start();
$con=mysqli_connect('localhost','root','','grocery');
/*if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: admin_login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: admin_login.php");
}*/


// Checking for connections 
if ($con->connect_error) { 
	die('Connect Error (' . 
	$con->connect_errno . ') '. 
	$con->connect_error); 
} 

// SQL query to select data from database 
$sql = "select u.cust_id as userid ,u.name,o.id as orderid,o.purchase_amount,o.order_date FROM 
        customer u, orderplaced o
        where u.cust_id=o.cust_id "; 
$result = $con->query($sql); 
$con->close(); 
?> 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
 
	<title>Orders</title> 
	<style> 
       
      .img-container {
		display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
      }
    
  
        h1 { 
            text-align: center; 
            color: Red; 
            font-size: xx-large; 
            font-family: 'Gill Sans', 'Gill Sans MT',  
            ' Calibri', 'Trebuchet MS', 'sans-serif'; 
		} 
		.form-group{
			margin:0 auto;
			width:210px;
		}
		.form input{
			display: inline-block;
			text-align:left;
			float:right;
			height: 20px;
  flex: 0 0 200px;
  margin-left: 10px;
		}
		.form label {
  display: flex;
  flex-direction: row;
  justify-content: flex-end;
  text-align: right;
  width: 400px;
  line-height: 26px;
  margin-bottom: 10px;
}
.button {
  display: inline-block;
  padding: 15px 30px;
  font-size: 15px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  margin: 0;
  position:relative;
  
  
}

		
		
  </style>
  </head>
  <body>
 

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link "  href="adminhome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="product.php">Add Products</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="customer.php">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orders.php">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminproduct.php">Stock</a>
        </li>


		<li class="nav-item">
          <a class="nav-link" >&nbsp;Welcome &nbsp;Admin!!</a>
        </li>
        
        
      </ul>
     
  
    </div>
  </div>
</nav>
	<section> 
		<h1>ORDER DETAILS</h1> 
		<!-- TABLE CONSTRUCTION--> 
		<table class="table table-bordered table-light" id="tableMain" style="table-layout: fixed; width: 70%">
  <thead>
    <tr>
    
                
				<th>CUSTOMER ID</th> 
				<th>CUSTOMER NAME</th> 
				<th>ORDER ID</th>
                <th>ORDER AMOUNT</th>
                <th>DATE</th>
				
    </tr>
  </thead>
  <tbody>
  </tr> 
			<!-- PHP CODE TO FETCH DATA FROM ROWS--> 
			<?php // LOOP TILL END OF DATA 
				while($rows=$result->fetch_assoc()) 
				{ 
			?> 
			<tr> 
				<!--FETCHING DATA FROM EACH 
					ROW OF EVERY COLUMN--> 
		
				<form method="post" action="">
				<td><div style="word-wrap: break-word;"><?php echo $rows['userid'];?></div></td> 
				<td><div style="word-wrap: break-word;"><?php echo $rows['name'];?></div></td> 
				<td><div style="word-wrap: break-word;"><?php echo $rows['orderid'];?></div></td> 
        <td><div style="word-wrap: break-word;"><?php echo $rows['purchase_amount'];?></div></td> 
				<td><div style="word-wrap: break-word;"><?php echo $rows['order_date'];?></div></td> 
        </form>
			</tr> 



			<?php 
				
                }
?>
</table> 
	</section> 
	
	
  </body>
  <script>
            document.onkeydown = function (t) {
             if(t.which == 9){
              return false;
             }
            }
            </script>
</html> 
