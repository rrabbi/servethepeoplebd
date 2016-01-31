<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <td style="width:50%">Item type</td>            
            <td style="width:10%">Option </td>
        <tr>                                               
        <?php	
            @$iut_query ="SELECT * FROM item_type_mst ORDER BY item_type"; 	
            $iut_query_list = mysql_query($iut_query);																	
            while ($row = mysql_fetch_array($iut_query_list)){
                echo '<tr class="table_data">';
				echo 	'<td>'.$row['item_type'].'</td>';              
                echo 	'<td >
                            <a class="edit_link" href="item_type.php?item_type_id='.$row['item_type_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>								
                        </td>';                                   								
               echo '</tr>';	
            }						
        ?>
    </table>                                                       	               
</div><!--End data_list-->