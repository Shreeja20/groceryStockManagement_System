<?php

session_start();
$con = mysqli_connect('localhost','root','','grocery');


$name=$_POST['user'];
$password=$_POST['password'];
$email=$_POST['email-id'];
$address=$_POST['address'];
$contact_no=$_POST['contact_no'];

$s="select * from customer where name='$name'";
$result=mysqli_query($con,$s);
$num=mysqli_num_rows($result);
if($num>=1){
    echo"Username already taken";
}
else{
    $reg="insert into customer(name,password,email,address,contact_no) values('$name','$password','$email','$address','$contact_no')";
    mysqli_query($con,$reg);
    echo"Registration Successful";
}

?>