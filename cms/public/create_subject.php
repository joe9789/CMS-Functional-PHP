<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php $header_content="New Subject"; ?>
<?php include("../includes/cmsheaders.php") ?>
<?php
$errors_array= array('menu_name',"postion","visible");

if(isset($_POST['submit'])){
	$menu_name=$_POST['new'];
	$position=(int)$_POST['position'];
	$visible=(int)$_POST['visible'];
	$query="INSERT INTO  ";
	$query.="subjects(menu_name,position,visible) ";
	$query.="VALUES(";
	$query.="'{$menu_name}',{$position},{$visible}";
	$query.=")";
	$result=mysqli_query($connection,$query);
	echo "<body>";
	if($result){
		echo "<script type=\"text/javascript\">";
		echo "alert('Subject Added');";
		echo "</script>";
	}else{
		echo "<script type=\"text/javascript\">";
		echo "alert('Error Inserting Subject')";
		echo "</script>";
	}
}
?>

</body>
</html>

