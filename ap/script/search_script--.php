<?php
	require_once '../../core/init.php';
?>
<?php

//Search Email for reset Password
	//Instant search for username from email 
		if(isset($_POST['instant_email'])){ //if(isset($_POST['term'])){ //where 'term' is the default keyword in jquery autocomplete api
			$instant_email = mysql_real_escape_string(htmlentities($_POST['instant_email']));
						
				$query = $con->prepare("SELECT email FROM user WHERE email LIKE :instant_email LIMIT 20 ");
				$query->execute(array(':instant_email'=> '%'.$instant_email.'%'));
				//$result = $query->fetch(PDO::FETCH_ASSOC);			
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$results[] = $row['email'];
				}
				echo json_encode($results);//*/			
		}
	
	//search for username from email or date_of_birth (dob)
		if(isset($_POST['s_email'])){ //if(isset($_POST['term'])){ //where 'term' is the default keyword in jquery autocomplete api
			$email = mysql_real_escape_string(htmlentities($_POST['s_email']));
			
			if(!empty($email)){
				$query = $con->prepare("SELECT email FROM user WHERE email=:email");
				$query->execute(array(':email'=>$email));
				$result = $query->fetch(PDO::FETCH_ASSOC);
				echo $result['email'];
							
			}elseif( empty($email)){
				return false;
			}		
		}
//END Search Email for reset Password

//Start edit_user search script
	//Instant search for email from email 
		if(isset($_POST['edit_user_s_email'])){ //if(isset($_POST['term'])){ //where 'term' is the default keyword in jquery autocomplete api
			$edit_user_s_email = mysql_real_escape_string(htmlentities($_POST['edit_user_s_email']));
						
				$query = $con->prepare("SELECT email FROM user WHERE email LIKE :email LIMIT 20 ");
				$query->execute(array(':email'=> '%'.$edit_user_s_email.'%'));
				//$result = $query->fetch(PDO::FETCH_ASSOC);			
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$results[] = $row['email'];
				}
				echo json_encode($results);//*/			
		}
		
	//search for username from email or date_of_birth (dob)
		if(isset($_POST['edit_user_role']) && isset($_POST['edit_user_email'])){ //if(isset($_POST['term'])){ //where 'term' is the default keyword in jquery autocomplete api
			$edit_user_role = mysql_real_escape_string(htmlentities(input_validation($_POST['edit_user_role'])));
			$edit_user_email = mysql_real_escape_string(htmlentities(input_validation($_POST['edit_user_email'])));
			
			if(!empty($edit_user_role) && empty($edit_user_email)){
				$query = $con->prepare("SELECT * FROM user WHERE role=:role");
				$query->execute(array(':role'=>$edit_user_role));	
						
			}elseif(!empty($edit_user_email) && empty($edit_user_role)){
				$query = $con->prepare("SELECT * FROM user WHERE email=:email");
				$query->execute(array(':email'=>$edit_user_email));
				
			}elseif(!empty($edit_user_role) && !empty($edit_user_email)){
				$query = $con->prepare("SELECT * FROM user WHERE role=:role AND email=:email");
				$query->execute(array(':role'=>$edit_user_role,':email'=>$edit_user_email));
				
			}elseif( empty($edit_user_role) && empty($edit_user_email) ){
				return false;
			}
			
			echo '<table class="table">
					<tr class="table_head">        	
						<!--<td style="width:5%">Username</td>-->
						<!--<td style="width:20%">Name</td> -->
						<td style="width:20%">Email</td>
						<td style="width:5%">Role</td>
						<td style="width:5%">Active</td>
						<td style="width:5%">Lock</td>
						<td style="width:5%">Allow Email</td>
						<td style="width:5%">T A C</td>                                                       
						<td style="width:5%"><strong>Option</strong></td>
					</tr>';
				while ($row = $query->fetch(PDO::FETCH_ASSOC)){
					echo '<tr class="table_data">';
					//echo 	'<td>'.$row['username'].'</td>';
					//echo 	'<td>'.$row['full_name'].'</td>'; 
					//echo 	'<td></td>';             
					echo 	'<td>'.$row['email'].'</td>';
					echo 	'<td>'.display_role($row['role']).'</td>';
					echo 	'<td>'.display_yes_or_no($row['active']).'</td>';
					echo 	'<td>'.display_user_lock_yes_or_no($row['user_lock']).'</td>';
					echo 	'<td>'.display_yes_or_no($row['allow_email']).'</td>';
					echo 	'<td>'.display_yes_or_no($row['tac']).'</td>';																				
					echo '<td><table><tr>';
					echo '       <td><a class="edit_link" href="edit_user.php?user_id='.$row['user_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a></td>';     
					echo '       <td><a class="delete" href="" OnClick="DeleteUser('.$row['user_id'].');" title="Delete"> <img src="'.TRASH.'" alt="Trash"></a></td>';
					echo  '</tr></table></td>';
					
					echo '</tr>';	
				}
			echo '</table>';		
		}
//End edit_user search script

//Start user_log search script
	//Instant search for email from email 
		if(isset($_POST['user_log_s_email'])){
			$user_log_s_email = mysql_real_escape_string(htmlentities($_POST['user_log_s_email']));
						
				$query = $con->prepare("SELECT email FROM user WHERE email LIKE :email LIMIT 20 ");
				$query->execute(array(':email'=> '%'.$user_log_s_email.'%'));
				//$result = $query->fetch(PDO::FETCH_ASSOC);			
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$results[] = $row['email'];
				}
				echo json_encode($results);//*/work without this			
		}
		
	//search for username from email or date_of_birth (dob)
		if(isset($_POST['user_log_email']) && isset($_POST['select_log_type']) && isset($_POST['user_log_start_date']) && isset($_POST['user_log_end_date'])){
			$email = mysql_real_escape_string(htmlentities(input_validation($_POST['user_log_email'])));
			$log_type = mysql_real_escape_string(htmlentities(input_validation($_POST['select_log_type'])));
			$start_date = mysql_real_escape_string(htmlentities(input_validation($_POST['user_log_start_date'])));
			$end_date = mysql_real_escape_string(htmlentities(input_validation($_POST['user_log_end_date'])));
			
			$user_id = get_user_id_from_email($con, $email);	
			
			
			//single item
			if(!empty($email) && empty($log_type) && empty($start_date) && empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE user_id=:user_id ORDER BY datetime DESC");
				$query->execute(array(':user_id'=>$user_id));	
						
			}elseif(empty($email) && !empty($log_type) && empty($start_date) && empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE log_type=:log_type ORDER BY datetime DESC");
				$query->execute(array(':log_type'=>$log_type));
				
			}elseif(empty($email) && empty($log_type) && !empty($start_date) && empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE datetime LIKE :datetime ORDER BY datetime DESC");
				$query->execute(array(':datetime'=>'%'.$start_date.'%'));
				
			}elseif(empty($email) && empty($log_type) && empty($start_date) && !empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE datetime LIKE :datetime ORDER BY datetime DESC");
				$query->execute(array(':datetime'=>'%'.$end_date.'%'));
				
			}
			//double item
			elseif(!empty($email) && !empty($log_type) && empty($start_date) && empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE user_id=:user_id AND log_type=:log_type ORDER BY datetime DESC");
				$query->execute(array(':user_id'=>$user_id, ':log_type'=>$log_type));
				
			}elseif(!empty($email) && empty($log_type) && !empty($start_date) && empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE user_id=:user_id AND datetime LIKE :datetime ORDER BY datetime DESC");
				$query->execute(array(':user_id'=>$user_id, ':datetime'=>'%'.$start_date.'%'));
				
			}elseif(!empty($email) && empty($log_type) && empty($start_date) && !empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE user_id=:user_id AND datetime LIKE :datetime ORDER BY datetime DESC");
				$query->execute(array(':user_id'=>$user_id, ':datetime'=>'%'.$end_date.'%'));
				
			}elseif(empty($email) && !empty($log_type) && !empty($start_date) && empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE log_type=:log_type AND datetime LIKE :datetime ORDER BY datetime DESC");
				$query->execute(array(':log_type'=>$log_type, ':datetime'=>'%'.$start_date.'%'));
				
			}elseif(empty($email) && !empty($log_type) && empty($start_date) && !empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE log_type=:log_type AND datetime LIKE :datetime ORDER BY datetime DESC");
				$query->execute(array(':log_type'=>$log_type, ':datetime'=>'%'.$end_date.'%'));
				
			}elseif(empty($email) && empty($log_type) && !empty($start_date) && !empty($end_date) ){			
				$query = $con->prepare("SELECT * FROM user_log WHERE date BETWEEN :start_date AND :end_date ORDER BY datetime DESC");
				$query->execute(array(':start_date'=>$start_date, ':end_date'=>$end_date));
				
			}
			//triple itme
			elseif(!empty($email) && !empty($log_type) && !empty($start_date) && empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE user_id=:user_id AND log_type=:log_type AND datetime LIKE :datetime ORDER BY datetime DESC");
				$query->execute(array(':user_id'=>$user_id, ':log_type'=>$log_type, ':datetime'=>'%'.$start_date.'%'));
				
			}elseif(!empty($email) && !empty($log_type) && empty($start_date) && !empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE user_id=:user_id AND log_type=:log_type AND datetime LIKE :datetime ORDER BY datetime DESC");
				$query->execute(array(':user_id'=>$user_id, ':log_type'=>$log_type, ':datetime'=>'%'.$end_date.'%'));
				
			}elseif(empty($email) && !empty($log_type) && !empty($start_date) && !empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE log_type=:log_type AND date BETWEEN :start_date AND :end_date ORDER BY datetime DESC");
				$query->execute(array(':log_type'=>$log_type, ':start_date'=>$start_date, ':end_date'=>$end_date));
				
			}elseif(!empty($email) && empty($log_type) && !empty($start_date) && !empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE user_id=:user_id AND date BETWEEN :start_date AND :end_date ORDER BY datetime DESC");
				$query->execute(array(':user_id'=>$user_id, ':start_date'=>$start_date, ':end_date'=>$end_date));
				
			}
			elseif(!empty($email) && !empty($log_type) && !empty($start_date) && !empty($end_date) ){
				$query = $con->prepare("SELECT * FROM user_log WHERE user_id=:user_id AND log_type=:log_type AND date BETWEEN :start_date AND :end_date ORDER BY datetime DESC");
				$query->execute(array(':user_id'=>$user_id, ':log_type'=>$log_type, ':start_date'=>$start_date, ':end_date'=>$end_date));
				
			}elseif( empty($email) && empty($log_type) && empty($start_date) && empty($end_date) ){
				return false;
			}
			
			echo '<table class="table">
				<tr class="table_head">        	
					<!--<td style="width:5%">Username</td>-->
					<td style="width:15%">User</td> 
					<td style="width:20%">Date Time</td>            
					<td style="width:20%">IP</td>
					<td style="width:5%">Type</td>
					<td style="width:30%">Remark</td>
				</tr>';
				while ($row = $query->fetch(PDO::FETCH_ASSOC)){
					echo '<tr class="table_data">';             
					echo 	'<td>'.display_email_from_user_id($con, $row['user_id']).'</td>';
					echo 	'<td>'.show_date_time($row['datetime']).'</td>';                
					echo 	'<td>'.$row['ip'].'</td>';
					echo 	'<td>'.display_log_type($row['log_type']).'</td>';
					echo 	'<td>'.$row['remark'].'</td>';                
					echo '</tr>';	
				}
			echo '</table>';		
		}
//End user_log search script

//Start Edit employer search script
	//Instant search for email from email only for employer
		if(isset($_POST['edit_search_employer_email'])){
			$edit_search_employer_email = mysql_real_escape_string(htmlentities($_POST['edit_search_employer_email']));
						
				$query = $con->prepare("SELECT email FROM user WHERE role=:role AND email LIKE :email LIMIT 20 ");
				$query->execute(array(':role'=> 2, ':email'=> '%'.$edit_search_employer_email.'%'));
				//$result = $query->fetch(PDO::FETCH_ASSOC);			
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$results[] = $row['email'];
				}
				echo json_encode($results);//*/work without this			
		}
		
	//Instant search for email from email only for employer
		if(isset($_POST['edit_search_employer_name'])){
			$edit_search_employer_name = mysql_real_escape_string(htmlentities($_POST['edit_search_employer_name']));
						
				$query = $con->prepare("SELECT u.user_id, u.role, ed.employer_name 
									FROM user AS u
									INNER JOIN employer_dtl AS ed ON u.user_id = ed.user_id
									WHERE u.role=:role AND ed.employer_name LIKE :employer_name LIMIT 20 "); //u.role=:role AND
				$query->execute(array(':role'=> 2, ':employer_name'=> '%'.$edit_search_employer_name.'%')); //':role'=> 2,
				//$result = $query->fetch(PDO::FETCH_ASSOC);			
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$results[] = $row['employer_name'];
				}
				echo json_encode($results);//*/work without this			
		}
	//search for username from email or date_of_birth (dob)
		if(isset($_POST['value_edit_search_employer_email']) && isset($_POST['value_edit_search_employer_name'])){
			$email = mysql_real_escape_string(htmlentities(input_validation($_POST['value_edit_search_employer_email'])));
			$employer_name = mysql_real_escape_string(htmlentities(input_validation($_POST['value_edit_search_employer_name'])));
			
			$user_id = get_user_id_from_email($con, $email);	
			
			
			//single item
			if(!empty($email) && empty($employer_name) ){
				$query = $con->prepare("SELECT * FROM user WHERE user_id=:user_id AND role=:role ORDER BY email ASC");
				$query->execute(array(':user_id'=>$user_id, ':role'=>2 ));	
						
			}elseif(empty($email) && !empty($employer_name) ){
				$query = $con->prepare("SELECT u.user_id, u.email, u.role, u.active, u.user_lock, u.allow_email, u.tac, ed.employer_name
					  FROM user AS u
					  INNER JOIN employer_dtl AS ed ON ed.user_id = u.user_id
					  WHERE role=:role AND ed.employer_name LIKE :employer_name ");
				$query->execute(array(':role'=>2, ':employer_name'=>'%'.$employer_name.'%'));
				
			}elseif(!empty($email) && !empty($employer_name) ){
				$query = $con->prepare("SELECT u.user_id, u.email, u.role, u.active, u.user_lock, u.allow_email, u.tac, ed.employer_name
					  FROM user AS u
					  INNER JOIN employer_dtl AS ed ON ed.user_id = u.user_id
					  WHERE u.user_id=:user_id AND role=:role AND ed.employer_name LIKE :employer_name ");
				$query->execute(array(':user_id'=>$user_id, ':role'=>2, ':employer_name'=>'%'.$employer_name.'%'));
				
			}elseif( empty($email) && empty($employer_name) ){
				return false;
			}
					
			echo '<table class="table">
				<tr class="table_head">
					<td style="width:20%">Email</td>
					<td style="width:5%">Role</td>
					<td style="width:5%">Active</td>
					<td style="width:5%">Lock</td>
					<td style="width:5%">Allow Email</td>
					<td style="width:5%">T A C</td>                                                       
					<td style="width:5%"><strong>Option</strong></td>
				</tr>';	
				//$query = $con->prepare("SELECT * FROM user WHERE role=2");
				//$query->execute();
										
				while ($row = $query->fetch(PDO::FETCH_ASSOC)){
					echo '<tr class="table_data">';             
					echo 	'<td>'.$row['email'].'</td>';
					echo 	'<td>'.display_role($row['role']).'</td>';
					echo 	'<td>'.display_yes_or_no($row['active']).'</td>';
					echo 	'<td>'.display_user_lock_yes_or_no($row['user_lock']).'</td>';
					echo 	'<td>'.display_yes_or_no($row['allow_email']).'</td>';
					echo 	'<td>'.display_yes_or_no($row['tac']).'</td>';																				
					echo '<td><table><tr>';
					echo '       <td><a class="edit_link" href="edit_employer_profile.php?user_id='.$row['user_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a></td>';
					echo  '</tr></table></td>';
					
					echo '</tr>';	
				} 
			echo '</table>';
		}
		
//End Edit employer search script


?>