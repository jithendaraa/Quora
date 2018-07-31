<?php

$con = mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
session_start();
$user = $_SESSION['user'];
$u = $_POST['u'];
$z = $_POST['z'];


if(!isset($_POST['clike']))
{
 $flag = $_POST['flag'];
 $q = $_SESSION['q'];
 $qby = $_SESSION['qby'];
 $get_resp = mysqli_query($con,"SELECT * FROM response WHERE response_to_user='$qby' AND response_to_question='$q'"); 

 $i = 0;
 while($resp_result = mysqli_fetch_assoc($get_resp))
 {
  $i += 1;
  if($i == $z)
  {
   $reqd_q = $q;
   $reqd_qby = $qby;
   $reqd_resp = $resp_result['response'];
   $reqd_resp_by = $resp_result['response_by'];
 }
}
if($flag == 0)
  $insert_likes=mysqli_query($con,"INSERT INTO likes (question,question_by,response,response_by,liked_by) VALUES('$q','$qby','$reqd_resp','$reqd_resp_by','$user')");
else if($flag == 1)
  $delete_like=mysqli_query($con,"DELETE FROM likes WHERE liked_by='$user' AND question='$q' AND question_by='$qby' AND response='$reqd_resp' AND response_by='$reqd_resp_by'");
}

else if(isset($_POST['clike']))
{
 
  $r = $_SESSION['r'];
  $rby = $_SESSION['rby'];
  $flag = $_POST['flag'];
  $get_comments = mysqli_query($con,"SELECT * FROM comments WHERE comment_to_response='$r' AND comment_to_user='$rby' ");
  $i = 0;
  while($results=mysqli_fetch_assoc($get_comments))
  {
    $i += 1;
    if($i == $z)
    {
     $c = $results['comment'];
     $cby = $results['comment_by'];
   }
 }
 if($flag == 0)
  $insert_likes=mysqli_query($con,"INSERT INTO likes (response,response_by,comment,comment_by,liked_by) VALUES('$r','$rby','$c','$cby','$user')");
else if($flag == 1)
  $delete_like=mysqli_query($con,"DELETE FROM likes WHERE liked_by='$user' AND response='$r' AND response_by='$rby' AND comment='$c' AND comment_by='$cby'");
}


?>