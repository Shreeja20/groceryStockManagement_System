<?php
include('function.php');
$con=mysqli_connect('localhost','root','','grocery');
session_start();
if (!isset($_SESSION['adminname'])) 
{
  $_SESSION['msg'] = "You must log in first";
  header('location: adminlogin.php');
}
if (isset($_GET['logout'])) 
{
  session_destroy();
  unset($_SESSION['adminname']);
  header("location: adminlogin.php");
}


?>
<?php
 if(isset($_POST['submit']))
 {		
     $newproduct = $_POST['name'];
     $price = $_POST['price'];
     $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); 
     $qty=$_POST['qty'];
     $menu_check_query = "select * from menu_table where 'product_name'='$newproduct' limit 1 ";
     $result = mysqli_query($con, $menu_check_query);
     $product = mysqli_fetch_assoc($result);
   
   if ($product) { // if dish exists
     if(strcasecmp($product['product_name'],$newproduct)==0){
         echo '<script>alert("Product already exists")</script>'; 

     }
   }
   else{
    if($qty>0 && $price>0 && preg_match('/^[0-9]+$/', $qty) && preg_match('/^[0-9]+$/', $price))
    {
     $insert ="insert into menu_table(product_name,price,image,qty,aval_status) values('$newproduct','$price','$file' ,'$qty',0)";
     $s=mysqli_query($con,$insert);
     echo '<script>alert("Product added successfully")</script>'; 
     if($s)  
       {  
            echo '<script>alert("Image Inserted into Database")</script>';  
       } 
       ?>
	<script>
	window.location.href='product.php';
	</script>
	<?php
  die();
      }
      else{
        echo '<script>alert("Price and Quantity must be numeric and  greater than 0")</script>'; 
        redirect('product.php');
       }
    
 
     
 }
}

?>

 <html>
   <head>
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
<style>
.form-group{
			margin:0 auto;
      width:210px;
}
</style>
</head>
<body>
<form action="product.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
		<label>
			PRODUCT NAME <input type="text" id="name" name="name" required>
		</label>
        <br><br>
		<label>
			PRICE <input type="text" id="price" name="price" required>
		</label>
        <br><br>
		<label>
			IMAGE <input type="file" id="image" name="image">
		</label>
        <br>
        <label>
			QUANTITY<input type="text" id="qty" name="qty" required>
		</label>
        <br><br>
		<input type="submit" id="desc" name="submit" value="submit">
	</div>
	</form>
    <script>
	$(document).ready(function(){  
  $('#desc').click(function(){  
       var image_name = $('#image').val();  
       if(image_name == '')  
       {  
            alert("Please Select Image");  
            return false;  
       }  
       else  
       {  
            var extension = $('#image').val().split('.').pop().toLowerCase();  
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
            {  
                 alert('Invalid Image File');  
                 $('#image').val('');  
                 return false;  
            }  
       }  
  });  
}); 
</script>
</body>
<script>
            document.onkeydown = function (t) {
             if(t.which == 9){
              return false;
             }
            }
            </script>
</html>
