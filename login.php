<?php
if(session_start())
  session_destroy();

if(isset($_GET['error']))
{
	if($_GET['error'] == 1)
	{
		echo "Invalid Password!";
	}

	else if($_GET['error'] == 2)
	{
		echo "Invalid Email!";
	}

	else if($_GET['error'] == 3)
	{
		echo "Password Mismatch!";
	}
}

if(isset($_GET['success']))
{
	if($_GET['success'] == 1)
	{
		echo "New record created successfully!";
	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Login/Signup</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  body{
    background-color: black;
    color: white;
  }

  p{color: white;}

  .panel-body{
    background-color: black;
    color: white;
  }

</style>
</head>
<body>
	<br><br>
  <div class="container">
    <div class="col-lg-6">	
     <form method="post" action="eval_login.php">
      <div class="panel panel-primary" style="width:500px;">
        <div class="panel-heading" style="height:45px;"><center><h3 style="position: relative;bottom: 20px;">Login</h3></center></div>
        <div class="panel-body">
         <b>Email:</b><input class="form form-group form-control" type="text" name="lemail" style="width:250px;"><b>Password:</b><input class="form form-group form-control" type="password" name="lpassword" style="width: 250px;"><input type="submit" value="Login" class="btn btn-primary" style="width: 227px;"><br>				
       </div>
     </div>
   </form>
 </div> 

 <div class="col-lg-6">
   <form method="post" action="eval_signup.php">
     <div class="panel panel-primary" style="width:500px;">
       <div class="panel-heading" style="height:45px; "><h3 style="position: relative;bottom:20px;">SIGN UP</h3></div>
       <div class="panel-body">
         <input class="form-group form-control" type="text" placeholder="Name" name="Name" value="" style="width:250px;">
         <input class="form-group form-control" type="text" placeholder="Email" name="Email" value="" style="width:250px;">
         <input class="form-group form-control" type="Password" placeholder="Password" pattern=".{6,}" name="Password" value="" style="width:250px;">
         <input class="form-group form-control" type="Password" placeholder="Confirm Password" pattern=".{6,}" name="cPassword" value="" style="width:250px;">
         <input type="submit" class="btn btn-primary" value="Submit" style="width:250px;">
       </div>
     </div>
   </form>
 </div>   
</div>  


</body>
</html>

