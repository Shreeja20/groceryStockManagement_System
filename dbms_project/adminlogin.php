<?php
session_start();
$db=mysqli_connect('localhost','root','','grocery');


if(isset($_REQUEST['login']))
{
    $user=$_REQUEST['user'];
    $password=$_REQUEST['password'];
    $query=mysqli_query($db,"select * from admin where name='$user' && password='$password'");
    $rowcount=mysqli_num_rows($query);
    if($rowcount==true){
        echo "Welcome!!";
        $_SESSION['adminname'] = $user; 
        //echo  $_SESSION['name'];
        header('Location:adminhome.php');
    }
    else{
        echo "You need to register first or maybe your username or password is wrong!!";
    }
}
?>
<html>
<head>
<title>login </title>
<link rel="stylesheet" type="text/css"href="style.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="login-box">
<div class="row">
<div class="col-md-6 login-left">
<h2>login here</h2>
<form action="" method="post">
<div class="form-group">
<label>username</label>
<input type="text"name="user"class="form-control"required>
</div>
<div class="form-group">
<label>password</label>
<input type="password"name="password"class="form-control"required>
</div>
<button type="submit"name="login" class="btn btn-primary">login</button>
<center><a href="hhome.php">go back</a></center>
</form>
</div>

<script>
            document.onkeydown = function (t) {
             if(t.which == 9){
              return false;
             }
            }
            </script>

