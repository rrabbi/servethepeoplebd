<div class="data_list_content" style="max-height:360px; overflow:auto;">
    <table class="table">
        <tr class="table_head">            
            <td style="width:15%">Brand Name</td> 
            <td style="width:40%">Details</td>
            <td style="width:15%">Logo</td>                     
            <td style="width:15%">Option</td>
        </tr>                                               
        <?php						
            $query ="SELECT * FROM item_brand ORDER BY brand_name ASC";
			$query_list = mysql_query($query);				
            while ($row = mysql_fetch_array($query_list)){
                echo '<tr class="table_data">';
				echo 	'<td>'.$row['brand_name'].'</td>';
				echo 	'<td>'.$row['brand_details'].'</td>';
				echo 	'<td><img src="';
					if(!empty($row['brand_img'])){ echo '../../files/brand/'.$row['brand_img'];}else{ echo NO_IMG;}
				//../../files/brand_img/'.$row['brand_img'].
				echo '" style="width:45px; max-height:22px;" /></td>';               
				echo '<td><table><tr>';
                echo '       <td><a class="edit_link" href="item_brand.php?brand_id='.$row['brand_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a></td>';     
                //echo '       <td><a class="delete" href="" OnClick="DeleteUser('.$row['user_id'].');" title="Delete"> <img src="'.TRASH.'" alt="Trash"> </a></td>';
				echo  '</tr></table></td>';               
                echo '</tr>';	
            } // */					
        ?>
    </table>                                	               
</div><!--End data_list_content-->
