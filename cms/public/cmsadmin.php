<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php $header_content="Admin"; ?>
<?php include("includes/cmsheaders.php"); ?>



<?php
	$query="SELECT * FROM ";
	$query.="subjects ";
	$result=mysqli_query($connection,$query);
	//check_connection($result);
?>
<body>
<h1 id="top">Widget Corp</h1>

	<div class="left-menu">
	<ul>
		<li><a href="manage_content.php">Manage Website Content</a></li>
		<li><a href="manage_admins.php">Manage admins</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
	</div>
	<div class="right-menu-admin">
<?php
	while ($row=mysqli_fetch_assoc($result)) {
		
		?>
		
		<li><?php echo $row['menu_name'];?></li>
		
	<?php
		}
 ?>
 </div>
	

<?php
	mysqli_free_result($result);
?>
<!--<script type="text/javascript">
	$(document).ready(function(){
		//alert("Working");
	});
</script>-->

<?php
	mysqli_close($connection);
?>
</body>
</html>