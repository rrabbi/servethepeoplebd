<!--<div class="data_list_head"><h3> Page List</h3></div>-->
<div class="data_list_content" style="max-height:360px; overflow:auto;">
    <table class="table">
        <tr class="table_head">
        	<!--<td style="width:3%">ID</td>-->
            <td style="width:5%">code</td> 
            <td style="width:15%">Page Name</td>                   		
            <td style="width:15%">Title</td>
            <td style="width:5%">log</td>
            <td style="width:25%">Keywords</td>
            <td style="width:30%">Details</td>                                                       
            <td style="width:5%"><strong>Option</strong></td>
        </tr>                                               
        <?php
			$query ="SELECT * FROM page_setup ORDER BY p_code ASC";
			$query_list = mysql_query($query);				
            while ($row = mysql_fetch_array($query_list)){
                echo '<tr class="table_data">';
				//echo 	'<td>'.$row['page_id'].'</td>';								
                echo 	'<td>'.$row['p_code'].'</td>';
                echo 	'<td>'.$row['page_name'].'</td>';
                echo 	'<td>'.$row['title'].'</td>';
				echo 	'<td>'.display_yes_or_no($row['allow_log']).'</td>';
                echo 	'<td>'.$row['keywords'].'</td>';
                echo 	'<td>'.$row['page_desc'].'</td>';																				
                echo '<td><table><tr>';
                echo '       <td><a class="edit_link" href="config_page.php?page_id='.$row['page_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a></td>';     
                echo  '</tr></table></td>';
                
                echo '</tr>';	
            } // */					
        ?>
    </table>
    <!--<div class="page_nav">
        <?php //this code show all page number //Show total page and current page
            //echo $first.' '.$prev.' Showing page '.$pageNum.' of '.$max_page.' pages '.$next.' '.$last; 
        ?>
    </div> -->                                 	               
</div><!--End data_list_content-->
