<?php

session_start();
$user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>My Answers</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
	body{
		background-color: #1a1a1a;
		color: #ff0000;
	}
	.logout{
		border-radius: 2px;
		background-color: red;
		color: white;
		border: none;
		float: right;
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

	.logout:hover{
		color: black;
	}
	.navbar-default{
		background-color: black;
		border-color: red;
		color: red;
		background-color: black;
	}
	.bodyContainer{
		padding-left: 75px;
		padding-right: 75px;
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
	.title{
		color: white;
		font-size: 25px;
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
	.ans-field{
		display: none;
		color: black;
	}
	.submit-ans{
		display: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myans").load("load-myans.php");
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
					<li><a href="homepage.php" >Home</a></li>
					<li><a href="myquestions.php" >My Questions</a></li>
					<li class="active"><a href="#" style="background-color: red; color: black;">My Answers</a></li>
					

				</ul>
			</div>
		</nav>
		<button class='logout' id='logout' onclick="logout()"><span class="glyphicon glyphicon-log-out"></span>Logout</button><br><br>

		<div class="bodyContainer">
			<div style="border-bottom: 1px solid white;"><p class="title">My Answers</p></div>
			<div id="myans"></div>
		<?php } ?>



		<script type="text/javascript">
			function logout()
			{
				window.location = "login.php";
			}
		</script>
	</body>
	</html>