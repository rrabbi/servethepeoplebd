<?php
	require_once '../../core/init.php';
?>
<?php 


//Delete User from edit_user form
		if(isset($_POST['delete_user_id'])){ //if(isset($_POST['term'])){ //where 'term' is the default keyword in jquery autocomplete api
			$delete_user_id = mysql_real_escape_string(htmlentities(input_validation($_POST['delete_user_id'])));
			
			//use for get role and also log
			$query = $con->prepare("SELECT email, role FROM user WHERE user_id=:user_id");
			$query->execute(array(':user_id'=>$delete_user_id));
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$get_email = $result['email'];
			$get_role = $result['role'];
			
			
			if(!empty($get_email)){
				
				//delete query
				$delete = $con->prepare("DELETE FROM user where user_id=:user_id");
				$delete = $delete->execute(array(':user_id'=>$delete_user_id));
				
				if($delete){
					if($get_role == 1){
						$query = $con->prepare("SELECT admin_img FROM admin_dtl WHERE user_id=:user_id");
						$query->execute(array(':user_id'=>$delete_user_id));
						$result = $query->fetch(PDO::FETCH_ASSOC);
						$get_img = $result['admin_img'];
						if($get_img){
							@unlink('../../files/profile/'.$get_img); //delete img
							
							$delete_dtl = $con->prepare("DELETE FROM admin_dtl where user_id=:user_id");
							$delete_dtl->execute(array(':user_id'=>$delete_user_id));
						}						
					}elseif($get_role == 2){
						$query = $con->prepare("SELECT employer_img FROM employer_dtl WHERE user_id=:user_id");
						$query->execute(array(':user_id'=>$delete_user_id));
						$result = $query->fetch(PDO::FETCH_ASSOC);
						$get_img = $result['employer_img'];
						if($get_img){
							@unlink(GALLERY_PATH.$get_img); //delete img
							$delete_dtl = $con->prepare("DELETE FROM employer_dtl where user_id=:user_id");
							$delete_dtl = $delete_dtl->execute(array(':user_id'=>$delete_user_id));
						}
					}elseif($get_role == 3){
						$query = $con->prepare("SELECT js_img FROM job_seeker_dtl WHERE user_id=:user_id");
						$query->execute(array(':user_id'=>$delete_user_id));
						$result = $query->fetch(PDO::FETCH_ASSOC);
						$get_img = $result['js_img'];
						if($get_img){
							@unlink(GALLERY_PATH.$get_img); //delete img
							$delete_dtl = $con->prepare("DELETE FROM job_seeker_dtl where user_id=:user_id");
							$delete_dtl = $delete_dtl->execute(array(':user_id'=>$delete_user_id));
						}
					}
					
					//for Delete user log;
					$remark = 'User \''.$get_email.'\' was deleted.';
					insert_user_log($con, $_SESSION['user_id'], 6, REMOTE_IP, $remark );
									
					echo 1; //return to jquery
				}
			}
		}
		
//Clear log table
		if(isset($_POST['clear_all_log'])){
			$query = $con->prepare("DELETE from user_log");
			$query = $query->execute();
			if($query){
				echo 1;
			}
		}
		
//remover item images
	if(isset($_POST['del_i_sub_cat_id']) && isset($_POST['del_i_attrib_id'])){
		$del_i_sub_cat_id = mysql_real_escape_string($_POST['del_i_sub_cat_id']);
		$del_i_attrib_id = mysql_real_escape_string($_POST['del_i_attrib_id']);
		
		$query = $con->prepare("DELETE FROM j_sub_cat_attrib WHERE i_sub_cat_id=:i_sub_cat_id AND i_attrib_id=:i_attrib_id");
		$query->execute(array(':i_sub_cat_id'=>$del_i_sub_cat_id, ':i_attrib_id'=>$del_i_attrib_id ));
				
	}



?>