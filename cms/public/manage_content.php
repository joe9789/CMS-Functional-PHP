<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php include("../includes/cmsheaders.php") ?>
<?php
	if(isset($_GET["page"])){
		$sel_page=$_GET["page"];
		$sel_sub=null;
	}elseif (isset($_GET["subject"])) {
		$sel_sub=$_GET["subject"];
		$sel_page=null;
	}else{
		$sel_sub=null;
		$sel_page=null;
	}

	//$sel_sub_id=get_subject_by_id($sel_sub);
?>



<?php
	$subjects=get_subject();
    $subject_url;
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
 <ul style="margin-top: 15px;">
 	<li>
 		<a href="new_subject.php">+ Add New Subject</a>
 	</li>
 </ul>
 </div>

 
	<?php
		 if($sel_sub){
		 	//echo "<h1>".$sel_sub."</h1>";
		 	$int_sub=intval($sel_sub);
		 	$disp_sub=get_subject_by_id($int_sub);
		 	$result=$disp_sub;
		 	echo "<h1>".$result."</h1>";
	?>
	<?php
		}elseif($sel_page){
			//echo "<h1>".$sel_page."</h1>";
			$int_page=intval($sel_page);
			$disp_page=get_page_by_id($int_page);
			$result=$disp_page;
			echo "<h1>".$result."</h1>";
	?>
	<?php
		}else{
	?><h2>Please Select a subject or page</h2>
	<?php 
		}
	?>
<?php
 if($sel_sub){
 	echo "<a href=\"edit_subject.php?subject=<?php echo $subject_url; ?>\"><button>Edit Subject</button></a>";
 }elseif($sel_page){
 	echo "<a href=\"edit_subject.php?subject=<?php echo $page_url; ?>\"><button>Edit Page</button></a>";
 }
?>

<!--<script type="text/javascript">
	$(document).ready(function(){
		//alert("Working");
	});
</script>-->
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