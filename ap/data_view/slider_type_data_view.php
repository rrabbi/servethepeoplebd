<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <!--<td style="width:5%">ID </td>-->
            <td style="width:25%">Code</td>
            <td style="width:50%">Name</td>            
            <td style="width:10%">Option </td>
        <tr>                                               
        <?php	
            @$article_cat_query ="SELECT * FROM slider_type"; 	
            $article_cat_list = mysql_query($article_cat_query);																	
            while ($row = mysql_fetch_array($article_cat_list)){
                echo '<tr class="table_data">';
                //echo 	'<td>'.$row['slider_type_id'].'</td>';
				echo 	'<td>'.$row['st_code'].'</td>';
                echo 	'<td>'.$row['st_name'].'</td>';                
                echo 	'<td >
                            <a class="edit_link" href="slider_type.php?slider_type_id='.$row['slider_type_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>								
                        </td>';                                   								
               echo '</tr>';	
            }						
        ?>
    </table>                                                       	               
</div><!--End data_list-->