<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php $header_content="Public"; ?>
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
	
		<a href="cmsindex.php?subject=<?php echo urlencode($subject_row['id']);?>"> <?php echo $subject_row['menu_name']; ?> </a>
		</li>
<?php
	$pages=get_pages($subject_row['id']);
?>
<ul class="content-list">
		<?php
	while ($pages_row=mysqli_fetch_assoc($pages)) {
		
		?>

		<li>
		<a href="cmsindex.php?page=<?php echo urlencode($pages_row['id']);?>" ><?php echo $pages_row['menu_name'];?></a>
		</li>
		
<?php
}
?>
</ul>
	<?php
		}
 ?>
 </div>
<?php
		if ($sel_page) {
			$content_result=get_page_content_by_id($sel_page);
			echo "<h2>$content_result</h2>";
		}elseif($sel_sub){
			$content_result=get_subject_by_id($sel_sub);
			echo "<h2>$content_result</h2>";
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