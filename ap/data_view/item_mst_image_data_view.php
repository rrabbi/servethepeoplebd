<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <div class="image_data_view_container">
    	<ul> 
    	<?php
			$item_id = '';
			if(isset($_GET['item_id'])){ 
				@$item_id = mysql_real_escape_string(htmlentities(input_validation($_GET['item_id'])));
			}elseif(isset($_SESSION['session_item_id'])){
				@$item_id = mysql_real_escape_string(htmlentities(input_validation($_SESSION['session_item_id'])));
			}
			
		   	$image_query = mysql_query("SELECT item_id, i_img FROM item_images WHERE item_id ='$item_id'");		   													
            while ($row = mysql_fetch_array($image_query)){
               echo '<div class="uploded_i_img_area">';
			   echo 	'<div class="remove_img_link_area">
			   <a data-id="'.$row['item_id'].'" data-img="'.$row['i_img'].'" class="remove_img_link" title="Delete">&nbsp; X &nbsp;</a></div>';
			   echo 	'<div class="uploded_i_img" ><img src="'.ITEMS_PATH.$row['i_img'].'" alt=""></div>';
			   echo '</div>';	
            }					
        ?>
    
    </div>                                 	               
</div>