<?php
$con=mysqli_connect('localhost','root','','grocery');
static $c=0;
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
}?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="myweb.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<?php
if(isset($_POST["searchbtn"]))
{
  $searchproduct=$_POST["search"];
  $idquery="select * from `menu_table` where `product_name` like '%$searchproduct%' and aval_status=0";
  $result34 = mysqli_query($con, $idquery);
  while($val=mysqli_fetch_array($result34))
  {if($val){
    $c++;?>
  <div class="card" style="width: 18rem;">
  <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($val['image'] );?>" height="250" width="250" class="card-img-top" />
  <div class="card-body">
  <form method="post" action="cart.php">
    <h5 class="card-title"><?php echo $val['product_name']?></h5>
    
    <input type="hidden" name="hidden_name" value="<?php echo $val['product_name'];?>" />  
          <input type="hidden" name="hidden_price" value="<?php echo $val['price']; ?>" />
          <input type="hidden" name="hidden_id" value="<?php echo $val["product_id"]; ?>" />  
          <div class= abc >Rs. <?php echo $val['price']?></div>
          <input type="text" name="quantity" value="1" size="3"/>
          <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
          </div>
</div>
<?php
}
  }
  if($c<=0){
    ?><center><?php echo "No results Found";?></center><?php
  } 
}
  