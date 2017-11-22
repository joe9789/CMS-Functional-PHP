<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php $header_content="Admin"; ?>
<?php include("includes/cmsheaders.php"); ?>
<?php include("includes/sessions.php") ?>



<?php
	$query="SELECT * FROM ";
	$query.="admins ";
	$result=mysqli_query($connection,$query);
	//check_connection($result);
?>
<body>
<h1 id="top">Widget Corp</h1>

	<div class="left-menu-content">
	<ul>
		<li><a href="edit_admin.php">Edit</a></li>
		<li><a href="delete_admin.php">Delete</a></li>
		<li><a href="new_admin.php">+Add New Admin</a></li>
	</ul>
	</div>
	<div class="right-menu-admin">
		<h3>Admins</h3>
		<?php
			while ($admin_row=mysqli_fetch_assoc($result)) {
				$string= "<table>";
				$string.= "<tr><td>Id:-  {$admin_row['id']}</td></tr>";
				$string.= "<tr><td>Name:- {$admin_row['username']}</td></tr>";
				$string.= "<table>";
				echo $string;
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