<?php
session_start();
$db=mysqli_connect('localhost','root','','grocery');


if(isset($_REQUEST['login']))
{
    $user=$_REQUEST['user'];
    $password=$_REQUEST['password'];
    $query=mysqli_query($db,"select * from customer where name='$user' && password='$password'");
    $rowcount=mysqli_num_rows($query);
    if($rowcount==true){
        echo "Welcome!!";
        $_SESSION['name'] = $user; 
        //echo  $_SESSION['name'];
        header('Location:homepage.php');
    }
    else{
        echo "You need to register first or maybe your username or password is wrong!!";
    }
}
?>