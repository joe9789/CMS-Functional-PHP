<?php require_once("includes/db_connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php include("includes/cmsheaders.php") ?>
<?php include("includes/sessions.php") ?>


<body>

<h1 id="top">Widget Corp</h1>


<div class="admin-form">
 	<form action="login.php" method="POST">
 		<p>User Name <input type="text" name="userName" placeholder="Enter a username"><br><br></p>
 		<p>Password:- <input type="password" name="password" placeholder="Enter a password"><br><br></p>
 		<p><input type="submit" value="Create Admin" name="submitLogin"><br><br></p>
 		</form>
 </div>

<?php
 
 if (isset($_POST['submitLogin'])) {
 	$username=$_POST['userName'];
 	$password=$_POST['password'];
 	$result=attempt_login($username,$password);

    if ($result) {
    	$prompt= "<script type=\"text/javascript\">";
    	$prompt.="alert('Login SuccesFull')";
    	$prompt.="</script>";

    	echo $prompt;
    	redirect_to("cmsadmin.php");
    	$_SESSION['userId']=$result['id'];
    }else{
    	$prompt= "<script type=\"text/javascript\">";
    	$prompt.="alert('Usename/Password Not Found Or Else Some Field Left Blank')";
    	$prompt.="</script>";

    	echo $prompt;
    }

    
}
?>



<footer>
	This is a footer
</footer>
<?php
	mysqli_close($connection);
?>
</body>
</html>