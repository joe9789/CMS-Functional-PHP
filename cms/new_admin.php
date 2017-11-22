<?php require_once("includes/db_connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php include("includes/cmsheaders.php") ?>
<?php include("includes/sessions.php") ?>


<body>

<h1 id="top">Widget Corp</h1>

<?php
    if(!isset($_SESSION['userId'])){
        redirect_to('login.php');
    }
?>
<div class="admin-form">
 	<form action="new_admin.php" method="POST">
 		<p>User Name <input type="text" name="userName" placeholder="Enter a username"><br><br></p>
 		<p>Password:- <input type="password" name="password" placeholder="Enter a password"><br><br></p>
 		<p><input type="submit" value="Create Admin" name="submitAdmin"><br><br></p>
 		</form>
 </div>

<?php
 
 if (isset($_POST['submitAdmin'])) {
 	$hashed_password=password_to_hash($_POST['password']);
    $result=create_admin($_POST['userName'],$hashed_password);
    if ($result) {
    	$prompt= "<script type=\"text/javascript\">";
    	$prompt.="alert('Admin Created')";
    	$prompt.="</script>";

    	echo $prompt;
    }else{
    	$prompt= "<script type=\"text/javascript\">";
    	$prompt.="alert('ERROR')";
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