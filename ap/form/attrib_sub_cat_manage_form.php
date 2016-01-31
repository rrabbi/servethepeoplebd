<form method="POST" id="attrib_sub_cat_manage_form">
	<?php if(!empty($i_sub_cat_id)){?>
        <div class="form_top">
                <!--Only for allow Log-->            
                <input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
                               
                <div class="field">
                    <label>Sub-Category: *
                        <input type="hidden" id="i_sub_cat_id" name="i_sub_cat_id" value="<?php  if(!empty($i_sub_cat_id)){ echo $i_sub_cat_id;} ?>" />
                        <?php  if(!empty($i_sub_cat_id)){ echo get_item_sub_category_name($con, $i_sub_cat_id);} ?>
                    </label>
                </div>
                
                <!--<div class="field">
                    <label>Sub-Category: *</label>
                    <?php //select_item_sub_category($con, @$i_sub_cat_id); ?>
                </div>-->
                <div class="field">
                    <label>Select Attribute: *</label>
                    <?php select_item_attribute($con, @$i_attrib_id); ?>
                </div>
                <div class="field">
                    <label>Selected Attribute's list: *</label>
                    <div id="attributes_container"></div><!--All selected attributes are shwon inside attributes_container area using jquery-->
                   
                </div>               
                                                                                                     
        </div><!--End form_top--> 
                     
        <div class="form_bottom">                   
            <div class="form_btn">
                <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
                <input type="submit" class="a_button" id="attrib_sub_cat_manage_button" value="Update" title="Update">                     
            </div>                                            
        </div> <!--End form_bottom --> 
    
    <?php }else{ echo 'Please select a sub-category from \'List view\' by clicking on \'Edit\' link';} ?>
    
</form>
<span></span><!--Show message using jquery--> 
         
