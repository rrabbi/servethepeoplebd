<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <td style="width:5%">ID </td>
            <td style="width:50%">Category</td>
            <td style="width:50%">Sub-category</td>            
            <td style="width:10%">Option </td>
        <tr>                                               
        <?php	
            @$article_cat_query ="SELECT isc.i_sub_cat_id, isc.sub_category, ic.i_cat_name
					FROM item_sub_category AS isc
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					ORDER BY isc.i_sub_cat_id"; 	
            $article_cat_list = mysql_query($article_cat_query);																	
            while ($row = mysql_fetch_array($article_cat_list)){
                echo '<tr class="table_data">';
                echo 	'<td>'.$row['i_sub_cat_id'].'</td>';
				echo 	'<td>'.$row['i_cat_name'].'</td>'; 
				echo 	'<td>'.$row['sub_category'].'</td>';              
                echo 	'<td >
                            <a class="edit_link" href="item_sub_category.php?i_sub_cat_id='.$row['i_sub_cat_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>								
                        </td>';                                   								
               echo '</tr>';	
            }						
        ?>
    </table>                                                       	               
</div><!--End data_list-->