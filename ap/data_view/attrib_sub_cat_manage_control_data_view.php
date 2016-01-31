<div class="data_list_content" style="max-height:370px; overflow:auto;">
    <div class="image_data_view_container">
    	
    	<ul> 
    	<?php
			//$i_sub_cat_id = '';
			if(isset($_GET['i_sub_cat_id'])){ 
				echo '<h3>Updated Attribute list</h3>';
				@$i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_GET['i_sub_cat_id'])));
				
				
				$query = "SELECT att.i_attrib_id, att.attribute_name 
						FROM item_attribute AS att
						INNER JOIN j_sub_cat_attrib AS jsca ON jsca.i_attrib_id = att.i_attrib_id
						INNER JOIN item_sub_category AS sc ON sc.i_sub_cat_id = jsca.i_sub_cat_id
						WHERE jsca.i_sub_cat_id =".$i_sub_cat_id."
						ORDER BY att.attribute_name";
				$attrib_list = mysql_query($query);
				
				while($row = mysql_fetch_array($attrib_list)){
					echo '<div class="updated_attrib_area">
							<div class="updated_attrib_value">'.$row['attribute_name'].' &nbsp; 
								<a data-i_sub_cat_id="'.$i_sub_cat_id.'" data-i_attrib_id="'.$row['i_attrib_id'].'" class="remove_updated_attrib"> X </a>
							</div>						
						</div>';				
				}
			}
			
			
		   	/*$image_query = mysql_query("SELECT item_id, i_img FROM item_images WHERE item_id ='$item_id'");		   													
            while ($row = mysql_fetch_array($image_query)){
               echo '<div class="uploded_i_img_area">';
			   echo 	'<div class="remove_img_link_area">
			   <a data-id="'.$row['item_id'].'" data-img="'.$row['i_img'].'" class="remove_img_link" title="Delete">&nbsp; X &nbsp;</a></div>';
			   echo 	'<div class="uploded_i_img" ><img src="'.ITEMS_PATH.$row['i_img'].'" alt=""></div>';
			   echo '</div>';	
            }*/					
        ?>
    
    </div>                                 	               
</div>