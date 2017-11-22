<?php
	function redirect_to($new_loc){
		header("Location: ".$new_loc);
		exit;
	}

	function check_connection($res){
		
		if(!$result){
			die("Failed To Connect");
	}

	}

	function get_subject(){
		global $connection;

		$query="SELECT * FROM ";
		$query.="subjects ";
		$query.="WHERE visible=1 ";
		$query.=" ORDER BY position ASC";
		$subjects=mysqli_query($connection,$query);
		//check_connection($result);

		return $subjects;
	}

	function get_pages($subject_row_id){
			global $connection;
			
			$query="SELECT * FROM ";
			$query.="pages ";
			$query.="WHERE visible=1 ";
			$query.="AND subject_id={$subject_row_id} ";
			$query.="ORDER BY position ASC ";
			$pages=mysqli_query($connection,$query);

			return $pages;
	}

	/*function get_main_body($subjects,$subject_row_id,$subject_row_mname,$pages_row,$pages_row){
		$string_builder='';
	while ($subject_row=mysqli_fetch_assoc($subjects)) {
		
	
			if ($subject_row_id==$sel_sub) {
				 $string_builder.='<li class="selected">';
			}else{
				$string_builder.=echo "<li>";
			}
			
		
		
		$string_builder.="<a href=\"manage_content.php?subject="
		 $string_builder.={$subject_row_mname};
		  urlencode($subject_row_id); 
		  </a>;
		 $string_builder.={$subject_row_mname}; 
		$string_builder.='</li>';
	$pages=get_pages($subject_row_id);

$string_builder.="<ul class=\"content-list\">"
		
		<?php
	while ($pages_row=mysqli_fetch_assoc($pages)) {
		
	

		$string_builder.="<li>";

		$string_builder.="<a href=\"manage_content.php?page=<?php echo urlencode($pages_row['id']);?>"; $string_builder.=$pages_row['menu_name'];

		$string_builder.="</a></li></ul>";
		
		

}

		}

	mysqli_free_result($subjects);
	mysqli_free_result($pages);
 $string_builder.="</div>";

 $string_builder.="<p class=\"top2\"> ManageContent</p>";
		$string_builder.= $sel_sub;
		$string_builder.= $sel_page;
	mysqli_close($connection);

	}*/

	function get_subject_by_id($subId){
		global $connection;
        
		//$safe_sub_id=mysql_real_escape_string($connection,$subId);
		$query="SELECT * FROM";
		$query.="  subjects ";
		$query.=" WHERE  id={$subId} ";
		$query.="LIMIT 1";
		$result_set=mysqli_query($connection,$query);
		if($subject=mysqli_fetch_assoc($result_set)){
			return $subject['menu_name'];
		}else{
			return null;
		}
		
	}

	function get_page_by_id($sel_page){
		global $connection;
        
		//$safe_sub_id=mysql_real_escape_string($connection,$subId);
		$query="SELECT * FROM";
		$query.="  pages ";
		$query.=" WHERE  id={$sel_page} ";
		$query.="LIMIT 1";
		$result_set=mysqli_query($connection,$query);
		if($pages=mysqli_fetch_assoc($result_set)){
			return $pages['menu_name'];
		}else{
			return null;
		}
		
	}
	

	function get_page_content_by_id($sel_page){
		global $connection;
        
		//$safe_sub_id=mysql_real_escape_string($connection,$subId);
		$query="SELECT * FROM";
		$query.="  pages ";
		$query.=" WHERE  id={$sel_page} ";
		$query.="LIMIT 1";
		$result_set=mysqli_query($connection,$query);
		if($pages=mysqli_fetch_assoc($result_set)){
			return $pages['content'];
		}else{
			return null;
		}
		
	}

	function find_admin_by_username($username){
		global $connection;

		$query="SELECT * FROM admins WHERE username='{$username}' LIMIT 1 ";
		$result=mysqli_query($connection,$query);

		if($admin=mysqli_fetch_assoc($result)){
			return $admin;
		}else{
			return null;
		}
	}
	

	function password_to_hash($password){
		$blowfish="$2y$10$";
		$salt="Salt22CharactersOrMore";
		$formatted_password=$blowfish.$salt;
		$hashed_password=crypt($password,$formatted_password);
		return $hashed_password;
	}

	function create_admin($username,$password){
		global $connection;
		$parse_id=(int)$id;
		$query=" INSERT  INTO  admins (username,hashed_passwrd) VALUES ('{$username}','{$password}') ";

		$result=mysqli_query($connection,$query);

		return $result;

	}

	function check_password($password,$existing_hash){
		$hash=crypt($password,$existing_hash);

		if ($hash == $existing_hash) {
			return true;
		}else{
			return false;
		}
	}

	function attempt_login ($username,$password){
		$admin=find_admin_by_username($username);
		
		if($admin){
			//username valid check for password

			if (check_password($password,$admin['hashed_passwrd'])) {
				return $admin;
			}else{
				return false;
			}
		}else{
			return false;
		}	
	}
