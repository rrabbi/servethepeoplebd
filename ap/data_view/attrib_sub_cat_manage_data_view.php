<div class="data_list_content" style="max-height:350px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <!--<td style="width:5%">ID </td>-->
            <td style="width:15%">Sub-category</td>            
            <td style="width:80%">Attributs </td>
            <td style="width:5%">Option </td>
        <tr>                                               
        <?php	
            //@$attribute ="SELECT * FROM item_attribute";
			$sub_cat_query = mysql_query("SELECT i_sub_cat_id, sub_category FROM item_sub_category
					ORDER BY i_sub_cat_id ");	
            //$attribute_list = mysql_query($attribute);																	
            while ($row = mysql_fetch_array($sub_cat_query)){
                echo '<tr class="table_data">';
                //echo 	'<td>'.$row['i_sub_cat_id'].'</td>';
				echo 	'<td>'.$row['sub_category'].'</td>';
				echo 	'<td>';
							$query_attrib = "SELECT att.i_attrib_id, att.attribute_name 
										FROM item_attribute AS att
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
				echo '<td style="width:40px" class="center_text">
                        <a class="edit_link" href="attrib_sub_cat_manage.php?i_sub_cat_id='.$row['i_sub_cat_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>
                      </td>';                                  								
               echo '</tr>';	
            }						
        ?>
    </table>                                                       	               
</div><!--End data_list-->