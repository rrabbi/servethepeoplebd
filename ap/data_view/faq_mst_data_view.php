<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <table class="table">
        <tr class="table_head"> 
            <!--<td style="width:5%">ID</td>-->
            <td style="width:5%">Status</td>
            <td style="width:5%">Type</td>
            <td style="width:30%">Question</td>
            <td style="width:45%">Answer</td>                                           
            <td style="width:5%"><strong>Option</strong></td>
        </tr>                                              
        <?php				
            $faq_query = mysql_query("SELECT * FROM faq_mst");													
            while ($row1 = mysql_fetch_array($faq_query)){
                echo '<tr class="table_data">';
                //echo 	'<td class="center_text">'.$row1['faq_id'].'</td>';
                echo 	'<td class="center_text">';
                    if($row1['faq_status'] == 1){echo 'Show';}elseif($row1['faq_status'] == 0){echo 'Hide';}
                echo '</td>';
				echo 	'<td class="center_text">';
                    if($row1['faq_type'] == 1){echo 'User';}elseif($row1['faq_type'] == 2){echo 'Visitor';}
                echo '</td>';                
                echo 	'<td class="center_text">'.$row1['faq_question'].'</td>';
                echo 	'<td class="center_text">'.$row1['faq_answer'].'</td>';
                
                echo '<td><table><tr>';
                    echo '<td class="center_text">
                            <a class="edit_link" href="faq_mst.php?faq_id='.$row1['faq_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>
                          </td>';
                echo  '</tr></table></td>';
                echo '</tr>';	
            }					
        ?>
    </table>                                  	               
</div>