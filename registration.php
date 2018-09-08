<?php

session_start();



$con = mysqli_connect('localhost','id4813571_rocco1991','rocco1991');


mysqli_select_db($con, 'id4813571_hackatondb');

$username = $_POST ['username'];
$password = $_POST ['password'];
$password1 = $_POST ['password1'];
$email =  $_POST ['email'];
$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);



$s = " select * from usertable1 where username = '$username'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result); 


if($num == 1){
$message1 = "Username already taken";
 echo "<script type='text/javascript'>alert('Username taken!');</script>";
$URL="register.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="3;URL=' . $URL . '">';}elseif($password != $password1 || $password == ""){
     echo "<script type='text/javascript'>alert('Password don't match!);</script>";
$URL="register.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="3;URL=' . $URL . '">';


 }else{
          mkdir("Images/$username", 0777, true);

move_uploaded_file($image_tmp,"Images/$username/$image");
  $reg= "insert into usertable1(username, password, email,imagename) values ('$username', '$hashed_password', '$email','$image')";
  mysqli_query($con, $reg);
  
   echo "<script type='text/javascript'>alert('Registration successful');</script>";
$URL="index.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="4;URL=' . $URL . '">';
}



 ?>
 <script>
function myFunction() {
    alert("Oops! Password did not match or empty Try again!");
}
</script>
