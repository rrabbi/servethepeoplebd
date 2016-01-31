<form method="POST" id="item_mst_form" style="height:350px; margin-top:5px; overflow:auto">
    <div class="form_top"><!--Start Form_top-->     
        <!--Hidden type input for pass item_id for updating  > -->
        <input type="hidden" class="item_id" id="item_id" name="item_id" value="<?php  if(!empty($item_id)){ echo $item_id;} ?>">
        <!--Only for allow Log-->
        <input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
                                     
        <div class="form_left">
        	<div class="field">
                <label>Status:  &nbsp; &nbsp;
                	<input type="checkbox" class="checkbox" <?php if(@$i_available == 1){echo 'checked="checked"';} ?> id="i_available" name="i_available" 
                    value="<?php if(!empty($i_available)){echo $i_available; }else{ echo 0; } ?>"> Show                
                </label>                        	
            </div>                    	
            <div class="field">
                <label>Code: *</label>
                <div class="data">
                    <input type="text" class="a_text" id="i_code" name="i_code" value="<?php  if(!empty($i_code)){ echo $i_code;}else{ if($new_code == 001){echo 'I001';}else{echo $new_code;}}  ?>" 
                    <?php if(!empty($i_code))  echo 'hidden="hidden"'; ?> > <?php if(!empty($i_code)) echo $i_code; ?>
                </div>                        	
            </div>
            <div class="field">
                <label>Name: *</label>
                <div class="data">
                    <input type="text" class="a_text" id="i_name" name="i_name" value="<?php  if(!empty($i_name)){ echo $i_name;} ?>" 
                    placeholder="Enter Item name">
                </div>                        	
            </div>
            <div class="field">
                <label>Price: </label>
                <div class="data">
                    <input type="text" class="a_text" id="i_price" name="i_price" value="<?php  if(!empty($i_price)){ echo $i_price;} ?>" 
                    placeholder="00.00">
                </div>                        	
            </div>
            <div class="field">
                <label>Category: *</label>
                <?php select_item_category($con, @$i_cat_id); ?>                       	
            </div>
            <div class="field">
                <label>Sub-Category: *</label>
                <?php select_item_sub_category($con, @$i_sub_cat_id); ?>                       	
            </div>
            
            <div class="get_item_attrib">
            	<?php 
					if(!empty($item_id)){
						echo '<div style="font-weight:bold; text-align:left">Enter Item Attributes details.....</div></br>';
						while($row = $item_attrib_value_query->fetch(PDO::FETCH_ASSOC)){
							echo '<div class="field">';
								echo '<label>'.$row['attribute_name'].': </label>';
								echo '<input type="hidden" class="input" name="i_attrib_id[]" value="'.$row['i_attrib_id'].'">';
								echo '<div class="data">
										<input type="text" class="a_text" name="attribe_value[]" value="'.$row['attribe_value'].'" style="width:200px;">
										<input type="text" class="a_text" name="attribe_sirial[]" value="'.$row['attribe_sirial'].'" style="width:30px;">						
									';
								echo '</div>';
							echo '</div>';	
						}
					}
				?>
            </div><!--For dispaly item attributes-->
                                                                                                                                                                           
        </div><!--End form_left-->
        
        <div class="form_right">
        	<div class="field">
                <label>Item for: </label>
                <?php select_item_user_type($con, @$i_user_type_id); ?>                         	
            </div>
            <div class="field">
                <label>Item Brand: </label>
                <?php select_item_brand($con, @$brand_id); ?>                         	
            </div>
        	
            <div class="field">
                <label>Quantity: </label>
                <div class="data">
                    <input type="text" class="a_text" id="i_quantity" name="i_quantity" value="<?php  if(!empty($i_quantity)){ echo $i_quantity;} ?>" 
                    placeholder="Quantity">
                </div>                        	
            </div>
            <div class="field">
                <label> Details: </label>
                <div class="data">
                	<textarea class="textarea" id="i_details" name="i_details" placeholder="Enter Details"><?php  if(!empty($i_details)){ echo $i_details;} ?></textarea>
            	</div>
            </div>       
            <div class="field">
                <label>File One:</label>
                <div class="data"><input type="file" class="a_text" id="i_img" name="i_img" onchange="readURL(this);"></div>
            </div>
            <div class="display_img">
           		<img id="show_img" src="<?php 
					if(!empty($i_img)){ echo '../../files/items/'.$i_img;}else{ echo NO_IMG;} ?>" style="width:90px; max-height:90px;"> 
           </div>                                                                                                                                                                               
        </div><!--End form_right--> 
                                                                                           
    </div><!--End Form_top-->
          
    <div class="form_bottom">
        <div class="field">
            <input type="button" class="a_button" value="New Entry" onClick="clearForm();" title="New Entry">
            <input type="submit" class="a_button" id="item_mst_form_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
    <span></span><!--Show message using jquery--> 
