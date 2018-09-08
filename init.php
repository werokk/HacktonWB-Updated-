<<?php
session_start();



$db = mysqli_connect('localhost','id4813571_rocco1991','rocco1991');


mysqli_select_db($con, 'id4813571_hackatondb');

$username = $_POST ['username'];
$password = $_POST ['password'];
$s = " select * from usertable where username = '$username' ";
$result = mysqli_query($db, $s);


if($num == 1){
  $_SESSION['username']= $username;
}else{
  die('You are not signed in.');
}

 ?>
