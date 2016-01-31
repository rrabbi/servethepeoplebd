<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <table class="table">
        <tr class="table_head"> 
            <!--<td style="width:5%">ID</td>-->            
            <td style="width:15%">Type</td>
            <td style="width:5%">Serial</td>
            <td style="width:10%">Status</td>
            <td style="width:35%">Title</td>
            <!--<td style="width:20%">Text 1</td>
            <td style="width:20%">Text 2</td>-->
            <td style="width:20%">Img</td>                           
            <td style="width:10%"><strong>Option</strong></td>
        </tr>                                              
        <?php				
            $slider_query = mysql_query("SELECT s.slider_id, s.s_title, s.s_serial, s.s_status, s.s_img1, st.st_name, st.st_code
								FROM slider AS s
								INNER JOIN slider_type AS st ON st.slider_type_id = s.slider_type_id
								ORDER BY st.st_name");													
            while ($row1 = mysql_fetch_array($slider_query)){
                echo '<tr class="table_data">';
                //echo 	'<td class="center_text">'.$row1['slider_id'].'</td>';                
				echo 	'<td class="center_text">'.$row1['st_name'].' ('.$row1['st_code'].')</td>';
				echo 	'<td class="center_text">'.$row1['s_serial'].'</td>';
                echo 	'<td class="center_text">';
                    if($row1['s_status'] == 1){echo 'Show';}elseif($row1['s_status'] == 0){echo 'Hide';}
                echo '</td>';
                echo 	'<td class="center_text">'.$row1['s_title'].'</td>';
                //echo 	'<td class="center_text">'.$row1['s_text1'].'</td>';
                //echo 	'<td class="center_text">'.$row1['s_text2'].'</td>';
                echo 	'<td class="center_text"><img style="width:100px; height:50px;" src="../../files/slider/'.$row1['s_img1'].'"/></td>';
                echo '<td style="width:40px" class="center_text">
                        <a class="edit_link" href="slider.php?slider_id='.$row1['slider_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>
                      </td>';
                echo '</tr>';	
            }					
        ?>
    </table>                                  	               
</div><!--End data_list_content-->