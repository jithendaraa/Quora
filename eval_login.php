<!DOCTYPE html>
<html>
<head>
    <title>lol</title>
</head>
<body>
    <?php
    
    $con=mysqli_connect("localhost","jith","Abhinav1234","quora")
    or die(mysqli_error($con));
    $id=$_POST['lemail'];
    $pwd=$_POST['lpassword'];
    $datau=mysqli_query($con,"SELECT COUNT(*) AS num FROM userlogin WHERE email='$id'") ;
    $row = mysqli_fetch_assoc($datau);

    if($row['num'] != 0)
    {
        
        $datap=mysqli_query($con,"SELECT password FROM userlogin WHERE email='$id'");
        $result=mysqli_fetch_assoc($datap);

        if($result['password'] == md5("$pwd"))
        {
            $username_query=mysqli_query($con,"SELECT username FROM userlogin WHERE email='$id'");
            $username=mysqli_fetch_assoc($username_query);
            session_start();
            $_SESSION['user']=$username['username'];
            header("location: homepage.php");
        }
        else
        {
                header("location: login.php?error=1"); //Invalid password 
            }
        }
        else
        {
        header("location: login.php?error=2"); // Invalid email
    }
    ?>

</body>
</html>