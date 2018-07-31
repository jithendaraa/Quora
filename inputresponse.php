  <?php

  session_start();
  $con = mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
  if(isset($_POST['flag']))
  {
   $response = $_POST['response'];
   $response_by = $_SESSION['user'];
   $response_to_user = $_POST['response_to_user'];
   $response_to_question = $_POST['response_to_question'];

   if($response != "")
   {
     $insert_response = mysqli_query($con,"INSERT INTO response (response,response_to_question,response_to_user,response_by) VALUES('$response','$response_to_question','$response_to_user','$response_by')");
   }
 }

 else if(!isset($_POST['flag']))
 {
   if(isset($_SESSION['q']) && isset($_SESSION['qby']))
   {
     $response = $_POST['response'];
     $response_by = $_SESSION['user'];
     $response_to_user = $_SESSION['qby'];
     $response_to_question = $_SESSION['q'];
     if($response != "")
     {
      $insert_response = mysqli_query($con,"INSERT INTO response (response,response_to_question,response_to_user,response_by) VALUES('$response','$response_to_question','$response_to_user','$response_by')");
      
    }
  }
}  

?>



