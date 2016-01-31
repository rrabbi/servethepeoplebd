<div class="data_list_content" style="max-height:350px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
        	<!--<td style="width:2%">ID</td>--> 
            <td style="width:5%">Code</td>
            <td style="width:10%">Type</td>
            <td style="width:15%">Name</td>
            <td style="width:5%">Available</td>
            <td style="width:10%">Category</td>
            <td style="width:10%">Sub-Cat</td>                          
            <td style="width:5%"><strong>Option</strong></td>
        </tr>                                              
        <?php				
            //$slider_query = mysql_query("SELECT * FROM slider");													
            while ($row1 = mysql_fetch_array($item_list)){
                echo '<tr class="table_data">';
				//echo 	'<td class="center_text">'.$row1['item_id'].'</td>';
                echo 	'<td class="center_text">'.$row1['i_code'].'</td>';
				echo 	'<td class="center_text">'.$row1['item_type'].'</td>';
                echo 	'<td class="center_text">'.$row1['i_name'].'</td>';
                echo 	'<td class="center_text">';
                    if($row1['i_available'] == 1){echo 'Yes';}elseif($row1['i_available'] == 0){echo 'No';}
                echo '</td>';
                echo 	'<td class="center_text">'.$row1['i_cat_name'].'</td>';
                echo 	'<td class="center_text">'.$row1['sub_category'].'</td>';
                /*echo 	'<td class="center_text"><img style="width:80px; height:30px;" src="';
					if(!empty($row1['i_img'])){ echo '../../files/items/'.$row1['i_img'];}else{ echo NO_IMG;}
				echo '"/></td>';*/
                echo '<td style="width:40px" class="center_text">
                        <a class="edit_link" href="item_mst.php?item_id='.$row1['item_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>
                      </td>';
                echo '</tr>';	
            }					
        ?>
    </table>                                  	               
</div><!--End data_list_content-->