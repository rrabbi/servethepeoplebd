<form method="POST" id="item_category_add_edit">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //select_item_category($con, @$i_cat_id); //echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="i_cat_id" name="i_cat_id" value="<?php  if(!empty($i_cat_id)){ echo $i_cat_id;} ?>">
            
            <div class="field">
                <label>Category name: *</label>
                <div class="data"><input type="text" class="a_text" id="i_cat_name" name="i_cat_name" value="<?php if(!empty($i_cat_name)){ echo $i_cat_name; }?>" placeholder="Category name"></div>
            </div>
            
            <div class="field">
                <label>File One:</label>
                <div class="data"><input type="file" class="a_text" id="i_cat_img" name="i_cat_img" onchange="readURL(this);"></div>
            </div>
            <div class="display_img">
           		<img id="show_img" src="<?php 
					if(!empty($i_cat_img)){ echo '../../files/items/'.$i_cat_img;}else{ echo NO_IMG;} ?>" style="width:90px; max-height:90px;"> 
           </div></br>
                                                                                                 
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="item_category_button" value="Update" title="Update category">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
