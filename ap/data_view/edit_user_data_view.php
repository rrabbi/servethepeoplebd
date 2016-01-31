<!--<div class="data_list_head"><h3> Page List</h3></div>-->
<div class="data_list_content" style="max-height:280px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <td style="width:10%">username</td>
            <td style="width:20%">Email</td>
            <td style="width:5%">Role</td>
            <td style="width:5%">Active</td>
            <td style="width:5%">Lock</td>
            <td style="width:5%">Allow Email</td>
            <td style="width:5%">T A C</td>                                                       
            <td style="width:5%"><strong>Option</strong></td>
        </tr>                                               
        <?php							
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
                echo '       <td><a class="edit_link" href="edit_user.php?user_id='.$row['user_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a></td>';     
                echo '       <td><a class="delete" href="" OnClick="DeleteUser('.$row['user_id'].');" title="Delete"> <img src="'.TRASH.'" alt="Trash"> </a></td>';
				echo  '</tr></table></td>';
                
                echo '</tr>';	
            } // */					
        ?>
    </table>
    <div class="page_nav" style="padding:5px; text-align:center; margin:10px 0px 10px 0px;">
        <?php //this code show all page number //Show total page and current page
			//echo $first.' '.$prev.' Showing page '.$pageNum.' of '.$max_page.' pages '.$next.' '.$last; 
			echo $first.' '.$prev.' '; 
			for ($i=1; $i<=$max_page; $i++) {
				echo '<a class="page_no" href="'.$self.'?page='.$i.'">'.$i.'</a> '; 
				
			};
			echo ' '.$next.' '.$last;
		?>
    </div>                                 	               
</div><!--End data_list_content-->
