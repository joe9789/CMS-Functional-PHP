<?php session_start(); ?>
<?php require_once("../includes/db_connection.php") ?>
<?php $header_content="New Subject"; ?>
<?php require_once("../includes/functions.php") ?>
<?php include("../includes/cmsheaders.php") ?>
<?php include("includes/sessions.php") ?>



<?php
	$subjects=get_subject();
	$subject_url=0;
?>

<body>
<h1 id="top">Widget Corp</h1>

	
		<div class="left-menu-content" style="padding-top: 25px; padding-left: 15px;">
<!--$subjects,$subject_row['id'],$subject_row['menu_name'],$pages_row['id'],$pages_row['menu_name'] -->
<?php
	while ($subject_row=mysqli_fetch_assoc($subjects)) {
		
		?>
		<?php
			if ($subject_row['id']==$sel_sub) {
				echo '<li class="selected">';
			}else{
				echo "<li>";
			}
			
		?>
		<?php 
				$subject_url=$subject_row['id']; 
			?>
		
		<a href="manage_content.php?subject=<?php echo urlencode($subject_row['id']);?>"> <?php echo $subject_row['menu_name']; ?> </a>
		</li>
<?php
	$pages=get_pages($subject_row['id']);
?>
<ul class="content-list">
		<?php
	while ($pages_row=mysqli_fetch_assoc($pages)) {
		
		?>

		<li>
		<a href="manage_content.php?page=<?php echo urlencode($pages_row['id']);?>" ><?php echo $pages_row['menu_name'];?></a>
		</li>
		
<?php
}
?>
</ul>
	<?php
		}
 ?>
 </div>

 <div class="subject-form">
 	<form action="create_subject.php" method="POST">
 		<p>Menu Name:- <input type="text" name="new" placeholder="Enter a new subject"><br><br></p>
 		<p>Position:- <select name="position">
 		<?php
 		$return_count=get_subject();
 		$count=mysqli_num_rows($return_count);
 	  
 			for ($i=1; $i <=($count+1) ; $i++) { 
 			  echo "<option value=\"{$i}\">{$i}</option>";	
 			}
 		?>
 		
 		</select><br><br></p>
 		<p>Visiblity:- </p>
 		<p><input type="radio" name="visible" value="1">Yes<br><br>&nbsp
 		<input type="radio" name="visible" value="0">No<br><br></p>
 		<p><input type="submit" value="Create Subject" name="submit"><br><br></p>
 		<a href="manage_content.php">Cancel</a>
 	</form>
 </div>

 

<?php
	mysqli_free_result($subjects);
	mysqli_free_result($pages);
?>
<footer>
	This is a footer
</footer>
<?php
	mysqli_close($connection);
?>
</body>
</html>