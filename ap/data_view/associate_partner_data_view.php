<div class="data_list_content" style="max-height:360px; overflow:auto;">
    <table class="table">
        <tr class="table_head">            
            <td style="width:10%">Name</td>
            <td style="width:5%">Type</td>
            <td style="width:5%">Status</td> 
            <!--<td style="width:40%">Details</td> -->            
            <td style="width:10%">Contact</td> 
            <td style="width:15%">Image</td>                   
            <td style="width:5%">Option</td>
        </tr>                                               
        <?php						
            $query ="SELECT ap.asso_partner_id, ap.asso_partner_name, ap.asso_partner_details, ap.asso_partner_contact, ap.asso_partner_status, ap.asso_partner_img, at.asso_name
				FROM associate_partner AS ap
				INNER JOIN associate_type AS at ON at.associate_type_id = ap.associate_type_id
				ORDER BY ap.asso_partner_name ASC";
			$query_list = mysql_query($query);				
            while ($row = mysql_fetch_array($query_list)){
                echo '<tr class="table_data">';
				echo 	'<td>'.$row['asso_partner_name'].'</td>';
				echo 	'<td>'.$row['asso_name'].'</td>';
				echo 	'<td class="center_text">';
                    if($row['asso_partner_status'] == 1){echo 'Show';}elseif($row['asso_partner_status']== 0){echo 'Hide';}
                echo '</td>';
				//echo 	'<td>'.$row['asso_partner_details'].'</td>';
				echo 	'<td>'.$row['asso_partner_contact'].'</td>';
				echo 	'<td><img src="';
					if(!empty($row['asso_partner_img'])){ echo '../../files/associate_partner/'.$row['asso_partner_img'];}else{ echo NO_IMG;}
				//../../files/brand_img/'.$row['brand_img'].
				echo '" style="width:45px; max-height:22px;" /></td>';               
				echo '<td><table><tr>';
                echo '       <td><a class="edit_link" href="associate_partner.php?asso_partner_id='.$row['asso_partner_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a></td>';     
                //echo '       <td><a class="delete" href="" OnClick="DeleteUser('.$row['user_id'].');" title="Delete"> <img src="'.TRASH.'" alt="Trash"> </a></td>';
				echo  '</tr></table></td>';               
                echo '</tr>';	
            } // */					
        ?>
    </table>                                	               
</div><!--End data_list_content-->
