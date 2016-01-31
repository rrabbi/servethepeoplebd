<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <table class="table">
        <tr class="table_head"> 
            <td style="width:5%">ID</td>
            <td style="width:10%">Status</td>
            <td style="width:15%">Category</td>
            <td style="width:10%">Code</td>
            <td style="width:20%">Title</td>
            <td style="width:10%">Post Date</td>                                           
            <td style="width:10%"><strong>Option</strong></td>
        </tr>                                              
        <?php				
            $doc_query = mysql_query("SELECT a.article_id, a.a_code, a.a_title, a.a_status, a.a_pdate, a.a_mdate, ac.ac_name, ac.ac_code
                    FROM article_mst AS a
                    INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id ");													
            while ($row1 = mysql_fetch_array($doc_query)){
                echo '<tr class="table_data">';
                echo 	'<td class="center_text">'.$row1['article_id'].'</td>';
                echo 	'<td class="center_text">';
                    if($row1['a_status'] == 1){echo 'Show';}elseif($row1['a_status'] == 0){echo 'Hide';}
                echo '</td>';
                echo 	'<td class="center_text">'.$row1['ac_name'].' ('.$row1['ac_code'].')</td>';
                
                echo 	'<td class="center_text">'.$row1['a_code'].'</td>';
                echo 	'<td class="center_text">'.$row1['a_title'].'</td>';
                echo 	'<td class="center_text">'.$row1['a_pdate'].'</td>';
                //echo 	'<td class="center_text"><img style="width:50px;" src="../files/books/'.$row1['b_file'].'"/></td>';
                //echo 	'<td class="center_text">'.get_orginal_file_name($row1['b_file']).'</td>';
                
                echo '<td><table><tr>';
                    echo '<td class="center_text">
                            <a class="edit_link" href="article_mst.php?article_id='.$row1['article_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>
                          </td>';
                echo  '</tr></table></td>';
                echo '</tr>';	
            }					
        ?>
    </table>                                  	               
</div>