<div class="data_list_content" style="max-height:350px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <!--<td style="width:5%">ID </td>-->
            <td style="width:50%">Name</td>            
            <td style="width:10%">Option </td>
        <tr>                                               
        <?php	
            @$attribute ="SELECT * FROM item_attribute ORDER BY attribute_name"; 	
            $attribute_list = mysql_query($attribute);																	
            while ($row = mysql_fetch_array($attribute_list)){
                echo '<tr class="table_data">';
                //echo 	'<td>'.$row['i_attrib_id'].'</td>';
				echo 	'<td>'.$row['attribute_name'].'</td>';              
                echo 	'<td >
                            <a class="edit_link" href="item_attribute.php?i_attrib_id='.$row['i_attrib_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>								
                        </td>';                                   								
               echo '</tr>';	
            }						
        ?>
    </table>                                                       	               
</div><!--End data_list-->