<form method="POST" id="item_sub_category_add_edit">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //select_item_category($con, @$i_sub_cat_id); //echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="i_sub_cat_id" name="i_sub_cat_id" value="<?php  if(!empty($i_sub_cat_id)){ echo $i_sub_cat_id;} ?>">
            
            <div class="field">
                <label>Category name: *</label>
                <?php select_item_category($con, @$i_cat_id);?>
            </div>
            
            <div class="field">
                <label>Sub-Category name: *</label>
                <div class="data"><input type="text" class="a_text" id="sub_category" name="sub_category" value="<?php if(!empty($sub_category)){ echo $sub_category; }?>" placeholder="Sub-Category name"></div>
            </div>
                                                                                                 
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="item_sub_category_button" value="Update" title="Update sub-category">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
