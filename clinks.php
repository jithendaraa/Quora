	<?php
	session_start();
	$user = $_SESSION['user'];
	$r = $_GET['r'];
	$rby = $_GET['rby'];
	$_SESSION['r'] = $r;
	$_SESSION['rby'] = $rby;

	$con = mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Comments</title>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<style type="text/css">
		body{
			background-color: #1a1a1a;
			color: #ff0000;
		}
		.username{
			color: red;
			font-size: 20px;
		}

		.container{
			color: white;
		}
		.entry{
			border-bottom: 1px solid red;
		}
		.response{
			font-size: 25px;
		}
		.small{
			font-size: 10px;
			color: white;
		}
		.small:hover{
			text-decoration: underline;
			cursor: pointer;
		}

		.like,.unlike{
			font-size: 10;
			color: white;
			background-color: red;
			border: none;
			border-radius: 18px;
		}
		.like:hover,.submitBtn:hover,.unlike:hover{
			cursor: pointer;
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
		.submitBtn{
			border-radius: 2px;
			background-color: red;
			color: white;
			border: none;
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
		.search,.btn-primary{
			border-radius: 2px;
			float: right;
		}
		.search{
			width: 275px;
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

		<button class='logout' id='logout' onclick="logout()"><span class="glyphicon glyphicon-log-out"></span>Logout</button><br><br>
		<?php
		$comments_num = mysqli_query($con,"SELECT COUNT(*) AS num FROM comments WHERE comment_to_response='$r' AND comment_to_user='$rby'");
		$num = mysqli_fetch_assoc($comments_num);

		$output = ""; 
		$output .= "<div class='container'><div class='entry'><h2 class='username'><b>".$rby."</b></h2>";
		$output .= "<div class='response'>".$r."</div><br>";
		$output .= "</div></div>";
		$output .= "<div class='container'><div id='count' class='entry1'>".$num['num']." Comments under this response</div></div>";



		if($num['num'] > 0)
		{
			$get_comments = mysqli_query($con,"SELECT * FROM comments WHERE comment_to_response='$r' AND comment_to_user='$rby'");
			$u=0;
			while($comment_result = mysqli_fetch_assoc($get_comments))
			{
				$u += 1;
				$c = $comment_result['comment'];
				$cby = $comment_result['comment_by'];
				$output .= "<div class='container'><div class='entry'><h2 class='username'>".$cby."</h2>";
				$output .= "<div class='comment'>".$c."</div><br>";

				$get_likes=mysqli_query($con,"SELECT COUNT(*) AS likenum FROM likes WHERE comment='$c' AND comment_by='$cby' AND response_by='$rby' AND response='$r' AND liked_by='$user'");
				$likenum=mysqli_fetch_assoc($get_likes);

				
				$total_likes=mysqli_query($con,"SELECT COUNT(*) AS tlikenum FROM likes WHERE comment='$c' AND comment_by='$cby' AND response_by='$rby' AND response='$r'");
				$tlikenum=mysqli_fetch_assoc($total_likes);
				

				if($likenum['likenum'] == 0)
				{
					$output .= "<div><p class='small'>(".$tlikenum['tlikenum'].")Likes</p><button class='like' id='clike".$u."' onclick='clike".$u."()'><span class='glyphicon glyphicon-thumbs-up'></span>Like</button>";
				}

				else if($likenum['likenum'] != 0)
				{
					$output .= "<p class='small'> (".$tlikenum['tlikenum'].")Likes</p><button class='unlike' id='cunlike".$u."' onclick='unlike".$u."()'><span class='glyphicon glyphicon-thumbs-down'></span>Unlike</button>";
				}

				$output .= "<br></div></div></div>";

			}
		} }?>

		<script type="text/javascript">
			
			function logout()
			{
				window.location = "login.php";
			}
			<?php for($z=0;$z<=$u;$z++) { ?>

				function clike<?php echo $z; ?>()
				{
					var clike = 1;
					flag = 0;
					var z=<?php echo $z; ?>;
					var u=<?php echo $u; ?>;  
					console.log(<?php echo $z; ?>)
					$.ajax({
						method: "POST",
						url: "likeresponse.php",
						data: {clike: clike,z: z,u: u,clike: clike,flag: flag},
						success: function(status) {
							$("#success").text(status);
							location.reload();
						}
					});
			//window.location="likeresponse.php";

		}


	<?php } ?>


	<?php for($z=0;$z<=$u;$z++) { ?>

		function unlike<?php echo $z; ?>()
		{
			var clike = 1;
			flag = 1;
			var z=<?php echo $z; ?>;
			var u=<?php echo $u; ?>;  
       //console.log("hm");
       
       $.ajax({
       	method: "POST",
       	url: "likeresponse.php",
       	data: {clike: clike,z: z,u: u,clike: clike,flag: flag},
       	success: function(status) {
       		$("#success").text(status);
       		location.reload();
       	}
       });
   }


<?php } ?>


</script>

<?php
$output .= "<br><div class='container'><textarea class='inp' id='inpComment'></textarea><br><button class='submitBtn' id='submitComment' onclick='submit()'>Submit</button></div>";

?>
<script type="text/javascript">
	
	function submit()
	{
		var comment = document.getElementById('inpComment').value;
		document.getElementById('inpComment').value = "";
		console.log(comment);
		var flag = 1;
		var r="<?php echo $r;?>";
		var rby="<?php echo $rby;?>";

		$.ajax({
			method: "POST",
			url: "inputcomment.php",
			data: {comment: comment,r: r,rby: rby,flag: flag},
			success: function(status) {
				$("#success").text(status);
				location.reload();
			}
		});
	}
</script>

<?php
echo $output;
?>

</body>
</html>