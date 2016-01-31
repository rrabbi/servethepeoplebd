<?php
	require_once '../../core/init.php';
?>
<?php

	
/*//search item attribute for change sub-category option
	if(isset($_POST['search_i_sub_cat_id'])){
		$search_i_sub_cat_id = mysql_real_escape_string($_POST['search_i_sub_cat_id']);
		if(!empty($search_i_sub_cat_id)){
			//echo $search_i_sub_cat_id;
			echo '<div class="data_list_content" style="max-height:100px; overflow:auto;">
				<table class="table">
					<tr class="table_head">
						<!--<td style="width:5%">ID </td>-->
						<td style="width:15%">Sub-category</td>            
						<td style="width:80%">Attributs </td>
					<tr>';                                              
					
					$sub_cat_query = mysql_query("SELECT i_sub_cat_id, sub_category FROM item_sub_category WHERE i_sub_cat_id='$search_i_sub_cat_id'");																	
					while ($row = mysql_fetch_array($sub_cat_query)){
						echo '<tr class="table_data">';
						//echo 	'<td>'.$row['i_sub_cat_id'].'</td>';
						echo 	'<td>'.$row['sub_category'].'</td>';
						echo 	'<td>';
									$query_attrib = "SELECT att.i_attrib_id, att.attribute_name FROM item_attribute AS att
												INNER JOIN j_sub_cat_attrib AS jsca ON jsca.i_attrib_id = att.i_attrib_id
												INNER JOIN item_sub_category AS sc ON sc.i_sub_cat_id = jsca.i_sub_cat_id
												WHERE jsca.i_sub_cat_id =".$row['i_sub_cat_id']."
												ORDER BY att.attribute_name";
									$attrib_list = mysql_query($query_attrib);
									$str = '';
									while($row1 = mysql_fetch_array($attrib_list)){
										$str .= $row1['attribute_name'].', '; //here i use coma and space after each result
									}
									echo trim($str, ', ');	//here i also remove comma and space ( rtrim() also work same)										
						echo 	'</td>';                                   								
					   echo '</tr>';	
					}						
				   
			echo '    </table>';                                                       	               
			echo '</div><!--End data_list-->';		
			
		}
	}//*/

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
			echo '</table>';//*/		
		}
//End user_log search script

?>