<div class="data_list_content" style="max-height:360px; overflow:auto;">
    <table class="table">
        <tr class="table_head">        	
            <!--<td style="width:5%">Username</td>-->
            <td style="width:5%">ID</td> 
            <td style="width:55%">Log type Name</td>          
            <td style="width:15%">Option</td>
        </tr>                                               
        <?php						
            $query ="SELECT * FROM log_type ORDER BY log_type_id ASC";
			$query_list = mysql_query($query);				
            while ($row = mysql_fetch_array($query_list)){
                echo '<tr class="table_data">';
				echo 	'<td>'.$row['log_type_id'].'</td>';            
                echo 	'<td>'.$row['log_type_name'].'</td>';
				echo '<td><table><tr>';
                echo '       <td><a class="edit_link" href="log_type.php?log_type_id='.$row['log_type_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a></td>';     
                //echo '       <td><a class="delete" href="" OnClick="DeleteUser('.$row['user_id'].');" title="Delete"> <img src="'.TRASH.'" alt="Trash"> </a></td>';
				echo  '</tr></table></td>';               
                echo '</tr>';	
            } // */					
        ?>
    </table>                                	               
</div><!--End data_list_content-->
