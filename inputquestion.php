<?php
session_start();
$con = mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
$q = $_POST['ques'];
$qby = $_SESSION['user'];
if($q != "")
	$insert_question = mysqli_query($con,"INSERT INTO questions (question_by,question) VALUES('$qby','$q')"); 

?>