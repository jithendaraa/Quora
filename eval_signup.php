<?php

$Name = $_POST["Name"];
$Email= $_POST["Email"];
$Password = $_POST["Password"];
$cPassword = $_POST["cPassword"];

if($cPassword==$Password && $Name !== "" && $Email !== "" && $Password !== "")
{
	$con=mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
	$sql = "INSERT INTO userlogin (username, email, password) VALUES ('$Name','$Email',MD5('$Password'))";
	if (mysqli_query($con, $sql)) {
      header("location: login.php?success=1"); //New record created successfully!
  }
  
  
}
else
    header("location: login.php?error=3"); //Password mismatch

?>