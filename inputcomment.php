<?php

session_start();
$con = mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
$user = $_SESSION['user'];
$comment = $_POST['comment'];


if(!isset($_POST['flag']))
{
	$z = $_POST['z'];
  $u = $_POST['u'];
  $q = $_SESSION['q'];
  $qby = $_SESSION['qby'];
  

  $get_responses = mysqli_query($con,"SELECT * FROM response WHERE response_to_user='$qby' AND response_to_question='$q'");
  $k = 0;
  while($response_result = mysqli_fetch_assoc($get_responses))
  {
   $k += 1;
   if($k == $z)
   {
    $comment_to_response = $response_result['response'];
    $comment_to_user = $response_result['response_by'];
  }
}
if($comment != "")
{
 $insert_comment = mysqli_query($con,"INSERT INTO comments (comment,comment_to_response,comment_to_user,comment_by) VALUES ('$comment','$comment_to_response','$comment_to_user','$user')");
}
}

else if(isset($_POST['flag']) && $_POST['flag'] == 1)
{
	$comment_to_user = $_POST['rby'];
  $comment_to_response = $_POST['r'];
  $insert_comment = mysqli_query($con,"INSERT INTO comments (comment,comment_to_response,comment_to_user,comment_by) VALUES ('$comment','$comment_to_response','$comment_to_user','$user')");
  
}


?>