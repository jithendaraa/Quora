   <?php

   session_start();
   $con = $con=mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
   $user = $_SESSION['user'];
   $_SESSION['ansBtn'] = 0;   //$select_query=mysqli_query($con,"SELECT * FROM questions");

   if(isset($_GET['ansBtn']))
   {
     $_SESSION['ansBtn'] = $_GET['ansBtn'];

   }

   ?>   
   <!DOCTYPE html>
   <html>
   <head>
     <title>MyQuora.com</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <style type="text/css">
     body{
      background-color: #1a1a1a;
      color: #ff0000;
    }
    .hide{
      display: none;
    }


    .heading{ 
      font-size: 50px;
      position: relative;
      left: 600px;
    }

    .headingContainer{
      border-bottom: 1px solid #ff0000;
    }

    .logout-btn{
      font-size: 20px;
      position: relative;
      top: 1px;
      left: 515px;
      background-color: red;
      color: white;
      border:none;
      padding-bottom: 5px;
      float:right;
    }

    .logout-btn:hover{
      color: black;
    }

    b{
      color: #ff0000;
    }
    .ask{
      border-radius: 2px;
      background-color: red;
      color: white;
      border: none;
    }
    .ask:hover{
      color: black;
    }

    .bodyContainer{
      padding-left: 75px;
      padding-right: 75px;
    }

    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      border: 1px solid #888;
      width: 40%;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
      -webkit-animation-name: animatetop;
      -webkit-animation-duration: 0.4s;
      animation-name: animatetop;
      animation-duration: 0.4s;
    }


    @-webkit-keyframes animatetop {
      from {top:-300px; opacity:0} 
      to {top:0; opacity:1}
    }

    @keyframes animatetop {
      from {top:-300px; opacity:0}
      to {top:0; opacity:1}
    }


    .close {
      color: white;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    .modal-header {
      padding: 2px 16px;
      background-color: #8b0000;
      color: white;
    }

    .modal-body {
      padding: 2px 16px;
      background-color: gray;
      color: #8b0000;
    }

    .modal-footer {
      padding: 2px 16px;
      background-color: #8b0000;
      color: white;
    }

    .empty{
      height: 150px;
    }
    .hidden-div{
      color: white;
    }
    .username{
      color: red;
    }
    .subtext{
      font-size: 10px;
      padding-left: 10px;
    }
    .container{
      color: white;
    }
    .entry{
      border-bottom: 1px solid red;
    }
    .ans-btn,.submit-ans,.logout{
      border-radius: 2px;
      background-color: red;
      color: white;
      border: none;
    }

    .ans-btn:hover,.submit-ans:hover,.logout:hover{
      color: black;
    }
    .ans-field{
      display: none;
      color: black;
    }
    .submit-ans{
      display: none;
    }

    .small{
      background-color: #1a1a1a;
      color: white;
      font-size: 10px;
      border:none;
    }
    .qlink{
      color: white;
    }

    .small:hover,.qlink:hover{
      text-decoration: underline;
      cursor: pointer;
      color: white;
    }
    .yellow{
      width: 50px;
      height: 50px;
      background-color: yellow;
    }
    .navbar-default{
      background-color: black;
      border-color: red;
      color: red;
      background-color: black;
    }
    
    .logout{
      float: right;
    }
    .search,.btn-primary{
      border-radius: 2px;
      float: right;
    }
    .search{
      width: 275px;
    }


  </style>



  <script type="text/javascript">
    $(document).ready(function(){
      $("#questions").load("load-ques.php");
    });
  </script>

</head>
<body>
 <?php if(isset($_SESSION['user'])) { ?>

  <b style="color: orange;"><?php echo "Logged in as:".$_SESSION['user']; ?> </b>

  <nav class="navbar navbar-default">
   <div class="container-fluid">
    <div class="navbar-header">
     <a class="navbar-brand" href="#">Eureka</a>
   </div>
   <ul class="nav navbar-nav">
     <li class="active" ><a href="#" style="background-color: red; color: black;">Home</a></li>
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

<div class="bodyContainer">
 <div style="border-bottom: 1px solid white;"><button class="ask" id="myBtn">Ask a question</button><br><br></div>    
 <div id="questions">
 </div>

</div>
</div>      



<div id="myModal" class="modal">
 <div class="empty"></div>
 <div class="modal-content">
  <div class="modal-header">
    <b class="hidden-div">Logged in as: <?php echo $_SESSION['user'];?></b>
    <span class="close">&times;</span>
    <h2>Add a question</h2>
  </div>
  <div class="modal-body"><br>

    <textarea class="form form-group form-control" type="text" id="question" name="question" placeholder="Add a question" style="width:70%;"></textarea>

  </div>
  <div class="modal-footer">
   <input type="button" id="submit" onclick="askQues()" class="btn btn-primary" name="askQues" value="Submit">

 </div>
</div>
</div>



<script type="text/javascript">
 var click = 0;
 var modal = document.getElementById('myModal');
 var btn = document.getElementById("myBtn");
 var span = document.getElementsByClassName("close")[0];
 btn.onclick = function() {
   modal.style.display = "block";
 }
 span.onclick = function() {
   modal.style.display = "none";
 }
 window.onclick = function(event) {
   if (event.target == modal) {
     modal.style.display = "none";
   }
 }    
 document.getElementById('logout').onclick=function(){
  window.location="login.php";
}

function askQues()
{
  click += 1;
  var i;
  var ques = document.getElementById("question").value;
  if(ques != "")
  {
    $.ajax({
      method: "POST",
      url: "inputquestion.php",
      data: {ques: ques},
      success: function(status) {
       $("#success").text(status);
       location.reload();
     }
   });
    
  }
  modal.style.display="none";
}


</script>

<?php }
else
 header("location: login.php");
?>
</body>
</html>