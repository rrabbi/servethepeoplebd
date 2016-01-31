<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <td style="width:5%">ID </td>
            <td style="width:40%">Name</td> 
            <td style="width:20%">Img</td>             
            <td style="width:10%">Option </td>
        <tr>                                               
        <?php	
            @$article_cat_query ="SELECT * FROM item_category"; 	
            $article_cat_list = mysql_query($article_cat_query);																	
            while ($row = mysql_fetch_array($article_cat_list)){
                echo '<tr class="table_data">';
                echo 	'<td>'.$row['i_cat_id'].'</td>';
				echo 	'<td>'.$row['i_cat_name'].'</td>';
				echo 	'<td class="center_text"><img style="width:80px; height:30px;" src="';
					if(!empty($row['i_cat_img'])){ echo '../../files/items/'.$row['i_cat_img'];}else{ echo NO_IMG;}
				echo '"/></td>';              
                echo 	'<td >
                            <a class="edit_link" href="item_category.php?i_cat_id='.$row['i_cat_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>								
                        </td>';                                   								
               echo '</tr>';	
            }						
        ?>
    </table>                                                       	               
</div><!--End data_list-->