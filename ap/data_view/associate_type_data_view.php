<div class="data_list_content" style="max-height:350px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
            <!--<td style="width:5%">ID </td>-->
            <td style="width:50%">Associate type</td>            
            <td style="width:10%">Option </td>
        <tr>                                               
        <?php	
            @$associate_type_query ="SELECT * FROM associate_type ORDER BY asso_name"; 	
            $associate_type_query_list = mysql_query($associate_type_query);																	
            while ($row = mysql_fetch_array($associate_type_query_list)){
                echo '<tr class="table_data">';
                //echo 	'<td>'.$row['associate_type_id'].'</td>';
				echo 	'<td>'.$row['asso_name'].'</td>';              
                echo 	'<td >
                            <a class="edit_link" href="associate_type.php?associate_type_id='.$row['associate_type_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>								
                        </td>';                                   								
               echo '</tr>';	
            }						
        ?>
    </table>                                                       	               
</div><!--End data_list-->