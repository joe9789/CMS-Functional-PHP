<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php include("../includes/cmsheaders.php") ?>
<?php include("includes/sessions.php") ?>

<?php
if(isset($_GET["subject"])){
		$sel_sub=$_GET["subject"];
	}
?>

<?php
$subject_id;
$subject_menu;
$subject_visible;
$subject_position;

?>
<?php
	$subjects=get_subject();
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
		if ($subject_row['id']==$sel_sub){
			$subject_id=$subject_row['id'];
			$subject_menu=$subject_row['menu_name'];
			$subject_visible=$subject_row['visible'];
			$subject_position=$subject_row['position'];
		}
		?>
		<a href="manage_content.php?subject=<?php echo urlencode($subject_row['id']); ?>"> <?php echo $subject_row['menu_name']; ?> </a>
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
 	<form action="edit_subject.php" method="POST">
 		<p>Menu Name:- <input type="text" name="newMenu" value="<?php echo $subject_menu;?>"><br><br></p>
 		<p>Position:- <select name="position">
 		<?php
 		$return_count=get_subject();
 		$count=mysqli_num_rows($return_count);
 	  
 			for ($i=1; $i<=($count+1);$i++) { 
 			  echo "<option value=\"{$i}\" ";
 			  if ($subject_position==$i) {
 			  	echo "selected ";
 			  }
 			  echo ">{$i}</option>";	
 			}
 		?>
 		
 		</select><br><br></p>
 		<p>Subject Id:- <input type="text" name="currentId" value="<?php echo $subject_id; ?>" size=1 readonly></p>
 		<p>Visiblity:- </p>
 		<p><input type="radio" name="visible" value="1" <?php 
 		if($subject_visible==1)echo "checked";?>>Yes<br><br>&nbsp
 		<input type="radio" name="visible" value="0" <?php 
 		if($subject_visible==0)echo "checked";?> >No<br><br></p>
 		<p><input type="submit" value="Edit Subject" name="submitEdit"><br><br></p>
 		<a href="manage_content.php">Cancel</a>
 		<?php
 		if (isset($_POST['submitEdit'])) {
		 	//echo $_POST['newMenu'].' '.$_POST['position'].' '.$_POST['visible']." ".$_POST['currentId'];
		 	$menu_name=$_POST['newMenu'];
		 	$visible=(int)$_POST['visible'];
		 	$position=(int)$_POST['position'];
		 	$id=$_POST['currentId'];
			$query="UPDATE subjects ";
			$query.="SET ";
			$query.=" menu_name='{$menu_name}',  ";
			$query.=" visible={$visible}, ";
			$query.=" position={$position}";
			$query.=" WHERE id={$id}";
			echo $query;
			$result=mysqli_query($connection,$query);
			if($result){
			     echo "<script type=\"text/javascript\">";
				echo "alert('Subject Added');";
				echo "</script>";
			}else{
				echo "<script type=\"text/javascript\">";
				echo "alert('Subject Added');";
				echo "</script>";
			}
 		}
	
?>
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