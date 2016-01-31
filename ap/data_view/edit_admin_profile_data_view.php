<!--<div class="data_list_head"><h3> Page List</h3></div>-->
<div class="data_list_content" style="max-height:280px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <td style="width:10%">Username</td>
            <td style="width:20%">Email</td>
            <td style="width:5%">Role</td>
            <td style="width:5%">Active</td>
            <td style="width:5%">Lock</td>
            <td style="width:5%">Allow Email</td>
            <td style="width:5%">T A C</td>                                                       
            <td style="width:5%"><strong>Option</strong></td>
        </tr>                                               
        <?php	
			$query = $con->prepare("SELECT * FROM user WHERE role=1");
			$query->execute();
									
            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo '<tr class="table_data">'; 
				echo 	'<td>'.$row['username'].'</td>';             
                echo 	'<td>'.$row['email'].'</td>';
                echo 	'<td>'.display_role($row['role']).'</td>';
                echo 	'<td>'.display_yes_or_no($row['active']).'</td>';
				echo 	'<td>'.display_user_lock_yes_or_no($row['user_lock']).'</td>';
				echo 	'<td>'.display_yes_or_no($row['allow_email']).'</td>';
				echo 	'<td>'.display_yes_or_no($row['tac']).'</td>';																				
                echo '<td><table><tr>';
                echo '       <td><a class="edit_link" href="edit_admin_profile.php?user_id='.$row['user_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a></td>';
				echo  '</tr></table></td>';
                
                echo '</tr>';	
            } // */					
        ?>
    </table>                                 	               
</div><!--End data_list_content-->
