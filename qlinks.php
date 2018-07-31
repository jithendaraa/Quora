  <?php 
  session_start();
  $con = mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
  $q = $_GET['q'];
  $qby = $_GET['qby'];
  $_SESSION['q'] = $q;
  $_SESSION['qby'] = $qby;
  $user=$_SESSION['user'];
  $count = 0;


  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title><?php echo $q; ?> </title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style type="text/css">
    body{
      background-color: #1a1a1a;
      color: #ff0000;
    }

    .username,.usernamea,.username-add{
      color: red;
      font-size: 25px;
    }

    .container,.container-add{
      color: white;
    }
    .entry,.entry-add{
      border-bottom: 1px solid red;
    }

    .question{
      font-size: 25px;
    }        

    .ansBtn,.submitBtn{
      border-radius: 2px;
      background-color: red;
      color: white;
      border: none;
    }
    .ansBtn:hover{
      color: black;
    }
    .entry1{
      border-bottom: 1px solid white;
      font-size: 20px;
    }

    .inp{
      color: black; 
      width: 80%;
      height: 100px;
    }
    .hidden{
      display: none;
    }
    .like,.comment,.unlike,.submit-comment{
      font-size: 10;
      color: white;
      background-color: red;
      border: none;
      border-radius: 18px;
    }
    .like:hover,.comment:hover,.unlike:hover,.submit-comment:hover{
      cursor: pointer;
      color: black;
    }

    .small:hover{
      text-decoration: underline;
      cursor: pointer;
    }

    .small{
      font-size: 10px;
      color: white;
    }

    .logout{
     float: right;
     border-radius: 2px;
     background-color: red;
     color: white;
     border: none;
   }

   .logout:hover{
    color: black;
  }

  .navbar-default{
   background-color: black;
   border-color: red;
   color: orange;
   background-color: black;
 }

 .comment-field,.submit-comment,.commentDisp{
   display: none;
 }
 .link{
  color: white;
}
.link:hover
{
  color: white;
}
.search,.btn-primary{
  border-radius: 2px;
  float: right;
}
.search{
  width: 275px;
}


</style>
</head>
<body>

  <b style="color: orange;"><?php

  if(isset($_SESSION['user'])){  
    echo "Logged in as:".$_SESSION['user']; ?></b>
    <nav class="navbar navbar-default">
     <div class="container-fluid">
      <div class="navbar-header">
       <a class="navbar-brand" href="#">Eureka</a>
     </div>
     <ul class="nav navbar-nav">
       <li><a href="homepage.php">Home</a></li>
       <li><a href="myquestions.php">My Questions</a></li>
       <li><a href="myanswers.php">My Answers</a></li>
     </ul>
     <form method="POST" action="search.php">
      <div style="padding-top: 10px;">
        <button type="submit" class="btn btn-primary" name="srchbtn">Go</button>
      </div>
      <div style="padding-top: 4px;">
        <input type="text" style="color: black;" class="search" name="srch" placeholder="Search for a question">
      </div>
    </form>
  </div>
</nav>

<button class='logout' id='logout'><span class="glyphicon glyphicon-log-out"></span>Logout</button><br><br>
<?php
$responses_query = mysqli_query($con,"SELECT COUNT(*) AS num FROM response WHERE response_to_user='$qby' AND response_to_question='$q'");
$no_response = mysqli_fetch_assoc($responses_query);
$responses = $no_response['num'];
$output = ""; 
$output .= "<div class='container'><div class='entry'><h2 class='username' style='color: orange;'><b><span class='glyphicon glyphicon-user'></span> ".$qby."</b></h2>";
$output .= "<div class='question'>".$q."</div><br>";
$output .= "</div></div>";
$output .= "<div class='container'><div id='count' class='entry1'>".$responses." Answers under this question</div></div>";
$output .= "<input class='hidden' id='hidden' value='".$_SESSION['user']."'>";


if($responses > 0)
{
  $get_responses = mysqli_query($con,"SELECT * FROM response WHERE response_to_user='$qby' AND response_to_question='$q'"); 
  $u=0;
  while($response_result = mysqli_fetch_assoc($get_responses))
  {
    $u += 1;
    $r = $response_result['response'];
    $rby = $response_result['response_by'];
    $output .= "<div class='container'><div class='entry'><h2 class='usernamea'>".$rby."</h2>";
    $output .= "<div class='answer'><a class='link' href='clinks.php?r=".$r."&rby=".$rby."'>".$r."</a></div><br>";
    
    $get_likes=mysqli_query($con,"SELECT COUNT(*) AS likenum FROM likes WHERE liked_by='$user' AND response='$r' AND response_by='$rby'");
    $total_likes=mysqli_query($con,"SELECT COUNT(*) AS tlikenum FROM likes WHERE question='$q' AND question_by='$qby' AND response='$r' AND response_by='$rby'");
    $tlikenum=mysqli_fetch_assoc($total_likes);
    $likenum=mysqli_fetch_assoc($get_likes);
    
    $get_comments_num=mysqli_query($con,"SELECT COUNT(*) AS commentnum FROM comments WHERE comment_to_response='$r'");
    $commentnum=mysqli_fetch_assoc($get_comments_num);
    
    if($likenum['likenum'] == 0)
    {
      $output .= "<div><p class='small'>(".$tlikenum['tlikenum'].")Likes     (".$commentnum['commentnum'].")Comments</p><button class='like' id='rlike".$u."' onclick='rlike".$u."()'><span class='glyphicon glyphicon-thumbs-up'></span>Like</button>";
    }
    
    else if($likenum['likenum'] != 0)
    {
      $output .= "<div><p class='small'> (".$tlikenum['tlikenum'].")Likes     (".$commentnum['commentnum'].")Comments</p><button class='unlike' id='runlike".$u."' onclick='runlike".$u."()'><span class='glyphicon glyphicon-thumbs-down'></span>Unlike</button>";
    }

    $output .= "<button class='comment' id='rcomment".$u."' onclick='rcomment".$u."()'><span class='glyphicon glyphicon-comment'></span>Comment</button>";
    $output .= "<textarea class='comment-field' id='commentBox".$u."' style='color: black;'></textarea><button type='submit' class='submit-comment' id='submitComment".$u."' onclick='submitComment".$u."()'>Submit</button></div><br></div>";
    $output .= "</div></div>";
    
  }
} 

?>
<?php } ?>
<script type="text/javascript">	



  document.getElementById('logout').onclick=function(){
    window.location="login.php";
  };
  var flag;
  var count=0;
  
  <?php for($z=0;$z<=$u;$z++) { ?>

   function rlike<?php echo $z; ?>()
   {
     var z=<?php echo $z; ?>;
     var u=<?php echo $u; ?>;
     flag = 0;

     $.ajax({
       method: "POST",
       url: "likeresponse.php",
       data: {z: z,u: u,flag: flag},
       success: function(status) {
         $("#success").text(status);
         location.reload();
       }
     });
   }
 <?php } ?>


 <?php for($z=0;$z<=$u;$z++) { ?>

   function runlike<?php echo $z; ?>()
   {
     var z=<?php echo $z; ?>;
     var u=<?php echo $u; ?>;
     flag = 1;

     $.ajax({
       method: "POST",
       url: "likeresponse.php",
       data: {z: z,u: u,flag: flag},
       success: function(status) {
         $("#success").text(status);
         location.reload();
       }
     });
   }
 <?php } ?>



 <?php for($z=0;$z<=$u;$z++) { ?>

   function rcomment<?php echo $z; ?>()
   {
     document.getElementById('rcomment<?php echo $z;?>').style.display = "none";
     document.getElementById('commentBox<?php echo $z;?>').style.display = "block";
     document.getElementById('submitComment<?php echo $z;?>').style.display = "block";

   }
 <?php } ?>



 <?php for($z=0;$z<=$u;$z++) { ?>

   function submitComment<?php echo $z; ?>()
   {
     var z=<?php echo $z; ?>;
     var u=<?php echo $u; ?>;
     var comment = document.getElementById("commentBox<?php echo $z; ?>").value;
     

     $.ajax({
       method: "POST",
       url: "inputcomment.php",
       data: {z: z,u: u,comment: comment},
       success: function(status) {
         $("#success").text(status);
         location.reload();
       }
     });
   }
 <?php } ?>


</script>

<?php

$output .= "<br><div class='container'><textarea class='inp' id='inpAns'></textarea><br><button class='submitBtn' id='submitAns' onclick='submit()'>Submit</button></div>";

?>
<script type="text/javascript">

 function submit()
 {
   var response=document.getElementById("inpAns").value;
   document.getElementById("inpAns").value = "";
   console.log(response);
   var user=document.getElementById("hidden").value;   
   if(response != "")
   {
     $.ajax({
       method: "POST",
       url: "inputresponse.php",
       data: {response: response},
       success: function(status) {
         $("#success").text(status);
         location.reload();
       }
     });
   }
 }

</script>
<?php echo $output; ?>
</body>
</html>