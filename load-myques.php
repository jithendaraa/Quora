<?php


session_start();
$con = $con=mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
$user = $_SESSION['user'];
$select_query=mysqli_query($con,"SELECT * FROM questions WHERE question_by='$user'");
$i = 1;

if(!isset($_GET['q']) || !isset($_GET['qby']))
{
  while($result = mysqli_fetch_assoc($select_query))
  {
    $qby=$user;
    $q=$result['question'];
    $response_query = mysqli_query($con,"SELECT COUNT(*) AS num FROM response WHERE response_to_user='$qby' AND response_to_question='$q' ");
    $responses=mysqli_fetch_assoc($response_query);
    ?><script type="text/javascript">console.log(<?php echo $responses['num'];?>);</script><?php
    $output = ""; 
    $output .= "<div class='entry'><h2 class='username' style='color: orange;'><span class='glyphicon glyphicon-user'></span> ".$result['question_by']."</h2><input id='q_by".$i."' style='display: none;' value='".$result['question_by']."'><div class='container'>";
    $output .= "<h3 id='qlink".$i."'><a class='qlink' href='qlinks.php?q=".$result['question']."&qby=".$result['question_by']."'>".$result['question']."</a>";
    $output .= "</h3><input id='q".$i."' style='display: none;' value='".$result['question']."'>";
    $output .= "<button id='ansBtn".$i."' class='ans-btn'><span class='glyphicon glyphicon-pencil'></span>Answer</button>";
    $output .= "<div class='small'>(".$responses['num'].")Answers</div>";
    $output .= "<textarea name='ans' class='ans-field' id='inpAns".$i."'></textarea><button type='submit' class='submit-ans' id='submitAns".$i."'>Submit</button></div><br><div id='success'></div></div>";
    echo $output;
    $i += 1;
    
  }
}

?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"> 
  var flag = 0;


  <?php 

  if(!isset($_GET['q']) || !isset($_GET['qby']))
  { 
   for($k = 1;$k <= $i;$k++) { ?>

    document.getElementById("ansBtn"+<?php echo $k; ?>).onclick=function()
    {
      if(flag == 0)
      {   
        var ansBtn = document.getElementById("ansBtn"+<?php echo $k; ?>);
        ansBtn.style.display = "none";
        var inpAns = document.getElementById("inpAns"+<?php echo $k; ?>);
        inpAns.style.display = "block";
        var submitAnsBtn = document.getElementById("submitAns"+<?php echo $k; ?>);
        submitAnsBtn.style.display = "block";
        flag = 1;
      }
    };

    document.getElementById("submitAns"+<?php echo $k; ?>).onclick = function()
    {
      var response = $("#inpAns"+<?php echo $k; ?>).val();
      var response_to_user = $("#q_by"+<?php echo $k; ?>).val();
      var response_to_question = $("#q"+<?php echo $k; ?>).val();
      var ansBtn = document.getElementById("ansBtn"+<?php echo $k; ?>);
      ansBtn.style.display = "block";
      var inpAns = document.getElementById("inpAns"+<?php echo $k; ?>);
      inpAns.style.display = "none";
      var submitAnsBtn = document.getElementById("submitAns"+<?php echo $k; ?>);
      submitAnsBtn.style.display = "none";
      inpAns.value="";
      flag = 0;


      $.ajax({
        method: "POST",
        url: "inputresponse.php",
        data: {response: response,response_to_user: response_to_user,response_to_question: response_to_question,flag: flag},
        success: function(status) {
          $("#success").text(status);
        }
      });
      location.reload();
    };    

    <?php 
  }
}
?>

</script>



